<!-- Global Browser Event & Error Logger -->
<script>
(function() {
    if (window.__browserLoggerActive) return;
    window.__browserLoggerActive = true;

    const errorEndpoint = "{{ route('log.browser.error') }}";
    const reportedSignatures = new Set();
    const maxEntriesBeforePurge = 40;

    function captureAndTransmit(errorPayload) {
        try {
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
        captureAndTransmit({
            message: 'Unhandled Promise Rejection: ' + (reason.message || String(reason)),
            source: window.location.href,
            lineno: reason.lineNumber || 0,
            colno: reason.columnNumber || 0,
            stack: reason.stack || null
        });
    });
})();
</script>

