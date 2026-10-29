<!-- Toastr Pro Dark Mode Notification Handler Component -->
<!-- Configured Types: Success, Warning, danger, error, info, Important -->

<!-- Toastr Core CSS (if not already included) -->
@once
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endonce

<style>
    :root {
        /* Dark Mode Core Palette */
        --toaster-dark-bg: #0b1120;
        --toaster-dark-card: rgba(11, 17, 32, 0.96);
        --toaster-dark-text-title: #f8fafc;
        --toaster-dark-text-body: #e2e8f0;
        --toaster-dark-border: rgba(255, 255, 255, 0.1);
        --toaster-dark-accent: rgba(255, 255, 255, 0.08);

        /* Status Accents (Vibrant Dark-Mode Luminance) */
        --toaster-success: #34d399;
        --toaster-warning: #fbbf24;
        --toaster-danger: #f87171;
        --toaster-error: #fb7185;
        --toaster-info: #60a5fa;
        --toaster-important: #c084fc;
    }

    #toast-container {
        top: 1.5rem !important;
        right: 1.5rem !important;
        z-index: 9999999 !important;
        pointer-events: auto !important;
    }

    /* 1. Global Reset (Eliminates all default Toastr PNG icons and base64 styles) */
    #toast-container > div,
    #toast-container > .toast,
    #toast-container > .toast-success,
    #toast-container > .toast-warning,
    #toast-container > .toast-danger,
    #toast-container > .toast-error,
    #toast-container > .toast-info,
    #toast-container > .toast-important,
    #toast-container > div:hover,
    #toast-container > .toast:hover,
    #toast-container > .toast-success:hover,
    #toast-container > .toast-warning:hover,
    #toast-container > .toast-danger:hover,
    #toast-container > .toast-error:hover,
    #toast-container > .toast-info:hover,
    #toast-container > .toast-important:hover,
    #toast-container > :hover {
        background-image: none !important;
        background-repeat: no-repeat !important;
        cursor: default !important;
    }

    /* 2. Glassmorphic Dark Card Base */
    #toast-container > div.toast {
        position: relative !important;
        opacity: 1 !important;
        width: 420px !important;
        max-width: calc(100vw - 2rem) !important;
        margin: 0 0 12px 0 !important;
        padding: 16px 44px 16px 72px !important;
        min-height: 72px !important;
        border-radius: 14px !important;
        font-family: inherit !important;
        background: rgba(11, 17, 32, 0.96) !important;
        backdrop-filter: blur(20px) saturate(180%) !important;
        -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        box-shadow: 0 20px 45px -10px rgba(0, 0, 0, 0.7), 0 0 0 1px rgba(255, 255, 255, 0.05), 0 8px 20px -4px rgba(0, 0, 0, 0.5) !important;
        overflow: hidden !important;
        transition: transform 0.2s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.2s ease, border-color 0.2s ease !important;
    }

    #toast-container > div.toast:hover {
        transform: translateY(-2px) !important;
        border-color: rgba(255, 255, 255, 0.2) !important;
        box-shadow: 0 24px 50px -10px rgba(0, 0, 0, 0.85), 0 0 0 1px rgba(255, 255, 255, 0.1) !important;
    }

    /* 3. Dedicated Squircle Icon Badge Base */
    #toast-container > div.toast::before {
        content: "" !important;
        position: absolute !important;
        left: 16px !important;
        top: 16px !important;
        width: 40px !important;
        height: 40px !important;
        border-radius: 12px !important;
        display: block !important;
        box-sizing: border-box !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        background-size: 20px 20px !important;
        flex-shrink: 0 !important;
    }

    /* -------------------------------------------------------------------------
     * 1. Success Variant (Dark Emerald Jade)
     * ------------------------------------------------------------------------- */
    #toast-container > .toast-success {
        background: linear-gradient(135deg, rgba(6, 32, 22, 0.96) 0%, rgba(4, 20, 14, 0.98) 60%, rgba(2, 12, 8, 0.99) 100%) !important;
        border: 1px solid rgba(52, 211, 153, 0.4) !important;
        box-shadow: 0 20px 45px -10px rgba(0, 0, 0, 0.8), 0 0 0 1px rgba(52, 211, 153, 0.18), 0 8px 24px -4px rgba(16, 185, 129, 0.28) !important;
    }
    #toast-container > .toast-success:hover {
        border-color: rgba(52, 211, 153, 0.65) !important;
    }
    #toast-container > .toast-success::before {
        background-color: rgba(16, 185, 129, 0.18) !important;
        border: 1px solid rgba(52, 211, 153, 0.45) !important;
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3), inset 0 1px 1px rgba(255, 255, 255, 0.15) !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2334d399' stroke-width='2.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='20 6 9 17 4 12'%3E%3C/polyline%3E%3C/svg%3E") !important;
    }
    #toast-container > .toast-success .toast-title {
        color: #34d399 !important;
    }
    #toast-container > .toast-success > .toast-progress {
        background: linear-gradient(90deg, #059669 0%, #10b981 50%, #34d399 100%) !important;
        box-shadow: 0 0 10px rgba(16, 185, 129, 0.6) !important;
    }

    /* -------------------------------------------------------------------------
     * 2. Warning Variant (Dark Amber Honey)
     * ------------------------------------------------------------------------- */
    #toast-container > .toast-warning {
        background: linear-gradient(135deg, rgba(40, 24, 4, 0.96) 0%, rgba(26, 15, 2, 0.98) 60%, rgba(14, 8, 1, 0.99) 100%) !important;
        border: 1px solid rgba(245, 158, 11, 0.4) !important;
        box-shadow: 0 20px 45px -10px rgba(0, 0, 0, 0.8), 0 0 0 1px rgba(245, 158, 11, 0.18), 0 8px 24px -4px rgba(245, 158, 11, 0.28) !important;
    }
    #toast-container > .toast-warning:hover {
        border-color: rgba(251, 191, 36, 0.65) !important;
    }
    #toast-container > .toast-warning::before {
        background-color: rgba(245, 158, 11, 0.18) !important;
        border: 1px solid rgba(251, 191, 36, 0.45) !important;
        box-shadow: 0 4px 14px rgba(245, 158, 11, 0.3), inset 0 1px 1px rgba(255, 255, 255, 0.15) !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23fbbf24' stroke-width='2.4' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'%3E%3C/path%3E%3Cline x1='12' y1='9' x2='12' y2='13'%3E%3C/line%3E%3Cline x1='12' y1='17' x2='12.01' y2='17'%3E%3C/line%3E%3C/svg%3E") !important;
    }
    #toast-container > .toast-warning .toast-title {
        color: #fbbf24 !important;
    }
    #toast-container > .toast-warning > .toast-progress {
        background: linear-gradient(90deg, #d97706 0%, #f59e0b 50%, #fbbf24 100%) !important;
        box-shadow: 0 0 10px rgba(245, 158, 11, 0.6) !important;
    }

    /* -------------------------------------------------------------------------
     * 3. Danger Variant (Dark Crimson High Alert)
     * ------------------------------------------------------------------------- */
    #toast-container > .toast-danger {
        background: linear-gradient(135deg, rgba(45, 10, 15, 0.96) 0%, rgba(28, 5, 8, 0.98) 60%, rgba(16, 2, 4, 0.99) 100%) !important;
        border: 1px solid rgba(239, 68, 68, 0.45) !important;
        box-shadow: 0 20px 45px -10px rgba(0, 0, 0, 0.8), 0 0 0 1px rgba(239, 68, 68, 0.2), 0 8px 24px -4px rgba(239, 68, 68, 0.3) !important;
    }
    #toast-container > .toast-danger:hover {
        border-color: rgba(248, 113, 113, 0.7) !important;
    }
    #toast-container > .toast-danger::before {
        background-color: rgba(239, 68, 68, 0.18) !important;
        border: 1px solid rgba(248, 113, 113, 0.48) !important;
        box-shadow: 0 4px 14px rgba(239, 68, 68, 0.3), inset 0 1px 1px rgba(255, 255, 255, 0.15) !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23f87171' stroke-width='2.4' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z'%3E%3C/path%3E%3Cline x1='12' y1='8' x2='12' y2='12'%3E%3C/line%3E%3Cline x1='12' y1='16' x2='12.01' y2='16'%3E%3C/line%3E%3C/svg%3E") !important;
    }
    #toast-container > .toast-danger .toast-title {
        color: #f87171 !important;
    }
    #toast-container > .toast-danger > .toast-progress {
        background: linear-gradient(90deg, #dc2626 0%, #ef4444 50%, #f87171 100%) !important;
        box-shadow: 0 0 10px rgba(239, 68, 68, 0.6) !important;
    }

    /* -------------------------------------------------------------------------
     * 4. Error Variant (Dark Ruby Rose)
     * ------------------------------------------------------------------------- */
    #toast-container > .toast-error {
        background: linear-gradient(135deg, rgba(45, 10, 22, 0.96) 0%, rgba(28, 5, 13, 0.98) 60%, rgba(16, 2, 7, 0.99) 100%) !important;
        border: 1px solid rgba(244, 63, 94, 0.4) !important;
        box-shadow: 0 20px 45px -10px rgba(0, 0, 0, 0.8), 0 0 0 1px rgba(244, 63, 94, 0.18), 0 8px 24px -4px rgba(244, 63, 94, 0.28) !important;
    }
    #toast-container > .toast-error:hover {
        border-color: rgba(251, 113, 133, 0.65) !important;
    }
    #toast-container > .toast-error::before {
        background-color: rgba(244, 63, 94, 0.18) !important;
        border: 1px solid rgba(251, 113, 133, 0.45) !important;
        box-shadow: 0 4px 14px rgba(244, 63, 94, 0.3), inset 0 1px 1px rgba(255, 255, 255, 0.15) !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23fb7185' stroke-width='2.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cline x1='18' y1='6' x2='6' y2='18'%3E%3C/line%3E%3Cline x1='6' y1='6' x2='18' y2='18'%3E%3C/line%3E%3C/svg%3E") !important;
    }
    #toast-container > .toast-error .toast-title {
        color: #fb7185 !important;
    }
    #toast-container > .toast-error > .toast-progress {
        background: linear-gradient(90deg, #e11d48 0%, #f43f5e 50%, #fb7185 100%) !important;
        box-shadow: 0 0 10px rgba(244, 63, 94, 0.6) !important;
    }

    /* -------------------------------------------------------------------------
     * 5. Info Variant (Dark Sapphire Ice)
     * ------------------------------------------------------------------------- */
    #toast-container > .toast-info {
        background: linear-gradient(135deg, rgba(10, 24, 52, 0.96) 0%, rgba(6, 14, 34, 0.98) 60%, rgba(3, 7, 20, 0.99) 100%) !important;
        border: 1px solid rgba(59, 130, 246, 0.4) !important;
        box-shadow: 0 20px 45px -10px rgba(0, 0, 0, 0.8), 0 0 0 1px rgba(59, 130, 246, 0.18), 0 8px 24px -4px rgba(59, 130, 246, 0.28) !important;
    }
    #toast-container > .toast-info:hover {
        border-color: rgba(96, 165, 250, 0.65) !important;
    }
    #toast-container > .toast-info::before {
        background-color: rgba(59, 130, 246, 0.18) !important;
        border: 1px solid rgba(96, 165, 250, 0.45) !important;
        box-shadow: 0 4px 14px rgba(59, 130, 246, 0.3), inset 0 1px 1px rgba(255, 255, 255, 0.15) !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2360a5fa' stroke-width='2.4' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='12' cy='12' r='10'%3E%3C/circle%3E%3Cline x1='12' y1='16' x2='12' y2='12'%3E%3C/line%3E%3Cline x1='12' y1='8' x2='12.01' y2='8'%3E%3C/line%3E%3C/svg%3E") !important;
    }
    #toast-container > .toast-info .toast-title {
        color: #60a5fa !important;
    }
    #toast-container > .toast-info > .toast-progress {
        background: linear-gradient(90deg, #2563eb 0%, #3b82f6 50%, #60a5fa 100%) !important;
        box-shadow: 0 0 10px rgba(59, 130, 246, 0.6) !important;
    }

    /* -------------------------------------------------------------------------
     * 6. Important Variant (Dark Royal Amethyst)
     * ------------------------------------------------------------------------- */
    #toast-container > .toast-important {
        background: linear-gradient(135deg, rgba(35, 12, 58, 0.96) 0%, rgba(20, 6, 36, 0.98) 60%, rgba(11, 3, 20, 0.99) 100%) !important;
        border: 1px solid rgba(139, 92, 246, 0.4) !important;
        box-shadow: 0 20px 45px -10px rgba(0, 0, 0, 0.8), 0 0 0 1px rgba(139, 92, 246, 0.18), 0 8px 24px -4px rgba(139, 92, 246, 0.28) !important;
    }
    #toast-container > .toast-important:hover {
        border-color: rgba(192, 132, 252, 0.65) !important;
    }
    #toast-container > .toast-important::before {
        background-color: rgba(139, 92, 246, 0.18) !important;
        border: 1px solid rgba(192, 132, 252, 0.45) !important;
        box-shadow: 0 4px 14px rgba(139, 92, 246, 0.3), inset 0 1px 1px rgba(255, 255, 255, 0.15) !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23c084fc' stroke-width='2.4' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9'%3E%3C/path%3E%3Cpath d='M13.73 21a2 2 0 0 1-3.46 0'%3E%3C/path%3E%3C/svg%3E") !important;
    }
    #toast-container > .toast-important .toast-title {
        color: #c084fc !important;
    }
    #toast-container > .toast-important > .toast-progress {
        background: linear-gradient(90deg, #7c3aed 0%, #8b5cf6 50%, #c084fc 100%) !important;
        box-shadow: 0 0 10px rgba(139, 92, 246, 0.6) !important;
    }

    /* -------------------------------------------------------------------------
     * Dark Mode Typography & Interactive Controls
     * ------------------------------------------------------------------------- */
    #toast-container .toast-title {
        font-size: 0.92rem !important;
        font-weight: 700 !important;
        letter-spacing: -0.015em !important;
        margin: 0 0 4px 0 !important;
        line-height: 1.3 !important;
        text-transform: capitalize !important;
    }
    #toast-container .toast-message {
        color: #e2e8f0 !important;
        font-size: 0.835rem !important;
        line-height: 1.55 !important;
        font-weight: 400 !important;
        word-break: break-word !important;
    }
    #toast-container .toast-close-button {
        position: absolute !important;
        top: 14px !important;
        right: 14px !important;
        width: 24px !important;
        height: 24px !important;
        border-radius: 6px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background-color: rgba(255, 255, 255, 0.08) !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        color: #94a3b8 !important;
        font-size: 15px !important;
        font-weight: 400 !important;
        line-height: 1 !important;
        text-shadow: none !important;
        opacity: 0.9 !important;
        transition: all 0.15s cubic-bezier(0.16, 1, 0.3, 1) !important;
        cursor: pointer !important;
        outline: none !important;
    }
    #toast-container .toast-close-button:hover {
        background-color: rgba(255, 255, 255, 0.2) !important;
        border-color: rgba(255, 255, 255, 0.3) !important;
        color: #ffffff !important;
        opacity: 1 !important;
        transform: scale(1.08) !important;
    }
    #toast-container > div > .toast-progress {
        opacity: 0.95 !important;
        height: 3px !important;
        position: absolute !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        border-radius: 0 0 14px 14px !important;
    }
</style>

<!-- Toastr Core Scripts (if not already included) -->
@once
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endonce

<script>
    (function() {
        if (typeof toastr === 'undefined') return;

        // Apply Global Toastr Configuration
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            preventDuplicates: false,
            onclick: null,
            showDuration: '300',
            hideDuration: '1000',
            timeOut: '5000',
            extendedTimeOut: '1500',
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut',
            escapeHtml: false
        };

        // Custom config method: danger (High Alert Red)
        toastr.danger = function(message, title, optionsOverride) {
            return toastr.error(message, title || 'Danger', Object.assign({
                iconClass: 'toast-danger',
                timeOut: 6000
            }, optionsOverride || {}));
        };

        // Custom config method: important (Purple / Amethyst notice)
        toastr.important = function(message, title, optionsOverride) {
            return toastr.info(message, title || 'Important Notice', Object.assign({
                iconClass: 'toast-important',
                timeOut: 8000,
                extendedTimeOut: 3000
            }, optionsOverride || {}));
        };

        // Universal Toast Dispatcher function by config name: Success, Warning, danger, error, info, Important
        window.flashToast = function(type, message, title) {
            var norm = (type || 'info').toLowerCase();
            if (norm === 'success') {
                return toastr.success(message, title || 'Success');
            } else if (norm === 'warning' || norm === 'warn') {
                return toastr.warning(message, title || 'Warning');
            } else if (norm === 'danger' || norm === 'delete' || norm === 'destroy') {
                return toastr.danger(message, title || 'Danger');
            } else if (norm === 'error') {
                return toastr.error(message, title || 'Error');
            } else if (norm === 'important') {
                return toastr.important(message, title || 'Important Notice');
            } else {
                return toastr.info(message, title || 'Notice');
            }
        };

        // Backward compatibility bridge
        window.notifyAdmin = function(type, message, title) {
            window.flashToast(type, message, title);
        };

        // Dispatch Flash Messages Sent from Laravel Controllers
        @if (session('toastr_notifications'))
            @foreach (session('toastr_notifications') as $toast)
                window.flashToast({!! json_encode($toast['type']) !!}, {!! json_encode($toast['message']) !!}, {!! json_encode($toast['title']) !!});
            @endforeach
        @else
            @if (session('success'))
                toastr.success({!! json_encode(session('success')) !!}, 'Success');
            @endif

            @if (session('warning'))
                toastr.warning({!! json_encode(session('warning')) !!}, 'Warning');
            @endif

            @if (session('danger') || session('delete'))
                toastr.danger({!! json_encode(session('danger') ?? session('delete')) !!}, 'Danger');
            @endif

            @if (session('error'))
                toastr.error({!! json_encode(session('error')) !!}, 'Error');
            @endif

            @if (session('info'))
                toastr.info({!! json_encode(session('info')) !!}, 'Notice');
            @endif

            @if (session('important'))
                toastr.important({!! json_encode(session('important')) !!}, 'Important Notice');
            @endif

            @if (session('status'))
                toastr.info({!! json_encode(session('status')) !!}, 'Status');
            @endif
        @endif

        // Validation Errors
        @if (isset($errors) && $errors->any())
            @foreach ($errors->all() as $error)
                toastr.error({!! json_encode($error) !!}, 'Validation Error');
            @endforeach
        @endif

        // Check for pending toastr stored in sessionStorage across page reloads
        try {
            const pendingToast = sessionStorage.getItem('pending_toastr');
            if (pendingToast) {
                sessionStorage.removeItem('pending_toastr');
                const parsed = JSON.parse(pendingToast);
                if (parsed && parsed.message) {
                    const fn = toastr[parsed.type] || toastr.success;
                    fn(parsed.message, parsed.title || '');
                }
            }
        } catch (e) {}
    })();
</script>
