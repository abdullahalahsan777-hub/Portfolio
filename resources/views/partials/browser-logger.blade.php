<!-- Global Browser Event & Error Logger -->
<script>
(function() {
    if (window.__browserLoggerActive) return;
    window.__browserLoggerActive = true;

    const errorEndpoint = "{{ route('log.browser.error') }}";
    const reportedSignatures = new Set();
    const maxEntriesBeforePurge = 40;

    /**
     * Filter out benign browser noise, ad-blockers, client disconnects, and extension errors.
     * Prevents false alarms in administrative diagnostics logs.
     */
    function isBenignNoise(errorPayload) {
        const msg = String(errorPayload.message || '').toLowerCase();
        const src = String(errorPayload.source || '').toLowerCase();
        const stk = String(errorPayload.stack || '').toLowerCase();

        // 1. Browser extension & ad-blocker noise (AdBlock360, uBlock, Grammarly, etc.)
        if (
            src.includes('chrome-extension://') ||
            src.includes('moz-extension://') ||
            src.includes('safari-extension://') ||
            src.includes('adblock') ||
            src.includes('filtering.') ||
            src.includes('in-browser-notifications') ||
            stk.includes('chrome-extension://') ||
            stk.includes('moz-extension://') ||
            stk.includes('adblock') ||
            stk.includes('in-browser-notifications') ||
            msg.includes('adblock')
        ) {
            return true;
        }

        // 2. Benign client network drop / CORS / offline / user navigation aborts
        if (
            msg.includes('networkerror when attempting to fetch resource') ||
            msg.includes('failed to fetch') ||
            msg.includes('load failed') ||
            msg.includes('aborterror') ||
            msg.includes('the operation was aborted') ||
            msg.includes('network request failed') ||
            msg.includes('err_failed') ||
            msg.includes('err_connection_refused') ||
            msg.includes('err_name_not_resolved') ||
            msg.includes('err_internet_disconnected')
        ) {
            return true;
        }

        // 3. Generic cross-origin opaque script error with no line or stack info
        if ((msg === 'script error' || msg === 'script error.') && (!errorPayload.lineno || errorPayload.lineno === 0)) {
            return true;
        }

        return false;
    }

    function captureAndTransmit(errorPayload) {
        try {
            if (isBenignNoise(errorPayload)) {
                return;
            }

            // Deduplicate to prevent infinite loop error spamming
            const sig = `${errorPayload.message || ''}_${errorPayload.source || ''}_${errorPayload.lineno || 0}`;
            if (reportedSignatures.has(sig)) return;
            reportedSignatures.add(sig);

            if (reportedSignatures.size > maxEntriesBeforePurge) {
                reportedSignatures.clear();
            }

            const data = JSON.stringify({
                message: errorPayload.message || 'Unknown browser error',
                source: errorPayload.source || window.location.href,
                lineno: errorPayload.lineno || 0,
                colno: errorPayload.colno || 0,
                stack: errorPayload.stack || null,
                url: window.location.href,
                viewport: `${window.innerWidth}x${window.innerHeight}`,
                referrer: document.referrer || '',
                timestamp: new Date().toISOString()
            });

            if (navigator.sendBeacon) {
                const blob = new Blob([data], { type: 'application/json' });
                navigator.sendBeacon(errorEndpoint, blob);
            } else {
                fetch(errorEndpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: data,
                    keepalive: true
                }).catch(function() {});
            }
        } catch (e) {
            // Silently suppress logger failure to protect user experience
        }
    }

    // 1. Standard Runtime JavaScript Errors
    window.onerror = function(message, source, lineno, colno, error) {
        captureAndTransmit({
            message: typeof message === 'string' ? message : (error && error.message ? error.message : 'Script Error'),
            source: source,
            lineno: lineno,
            colno: colno,
            stack: error && error.stack ? error.stack : null
        });
        return false;
    };

    // 2. Unhandled Promise Rejections (e.g. failed async fetch, rejected promises)
    window.addEventListener('unhandledrejection', function(event) {
        const reason = event.reason || {};
        const msg = reason.message || String(reason);
        captureAndTransmit({
            message: 'Unhandled Promise Rejection: ' + msg,
            source: reason.fileName || window.location.href,
            lineno: reason.lineNumber || 0,
            colno: reason.columnNumber || 0,
            stack: reason.stack || null
        });
    });
})();
</script>
