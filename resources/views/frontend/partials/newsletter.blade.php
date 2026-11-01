@php
    $accent = $accent ?? '#ff0033';
    $btnText = $btnText ?? 'text-white';
    $inputBg = $inputBg ?? 'bg-[#111111]';
    $borderColor = $borderColor ?? 'border-white/10';
    $count = $subscribersCount ?? \App\Models\Subscriber::where('status', 'active')->count();
@endphp

<!-- Newsletter Subscription Card (Matching Footer Grid) -->
<div id="newsletter-widget"
    class="newsletter-card p-4 sm:p-5 rounded-2xl bg-white/[0.03] border {{ $borderColor }} backdrop-blur-sm shadow-xl relative overflow-hidden transition-all duration-300">
    <div class="flex items-center justify-between gap-3 mb-2.5">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full animate-pulse" style="background-color: {{ $accent }}"></span>
            <h4 class="text-xs font-bold uppercase tracking-wider text-white font-['Outfit']">Newsletter</h4>
        </div>
    </div>

    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="newsletter-ajax-form relative"
        onsubmit="handleNewsletterSubmit(event, this)">
        @csrf
        <div class="relative flex items-center">
            <input type="email" name="email" required placeholder="Enter your email..."
                class="w-full {{ $inputBg }} border border-white/15 focus:border-[{{ $accent }}] rounded-xl pl-9 pr-20 sm:pr-24 py-2.5 text-xs text-white placeholder-neutral-500 outline-none transition-all font-sans"
                style="outline-color: {{ $accent }};" aria-label="Email address for newsletter">
            <svg class="w-4 h-4 text-neutral-500 absolute left-3 pointer-events-none" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <button type="submit"
                class="newsletter-submit-btn absolute right-1 px-3 py-1.5 rounded-lg {{ $btnText }} text-xs font-semibold tracking-wide transition-all duration-200 flex items-center gap-1.5 shadow-md cursor-pointer hover:opacity-95"
                style="background-color: {{ $accent }};">
                <span class="btn-text">Join</span>
                <svg class="btn-icon w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
                <svg class="btn-spinner hidden w-3 h-3 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </button>
        </div>
    </form>
</div>

<script>
    if (!window.handleNewsletterSubmit) {
        window.handleNewsletterSubmit = function(event, form) {
            event.preventDefault();
            const emailInput = form.querySelector('input[name="email"]');
            const submitBtn = form.querySelector('.newsletter-submit-btn');
            const btnText = form.querySelector('.btn-text');
            const btnIcon = form.querySelector('.btn-icon');
            const btnSpinner = form.querySelector('.btn-spinner');
            const feedback = form.querySelector('.newsletter-feedback');
            const email = emailInput ? emailInput.value.trim() : '';

            if (!email) return;

            // Loading state
            if (submitBtn) submitBtn.disabled = true;
            if (btnText) btnText.textContent = '...';
            if (btnIcon) btnIcon.classList.add('hidden');
            if (btnSpinner) btnSpinner.classList.remove('hidden');
            if (feedback) feedback.classList.add('hidden');

            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(res => res.json().then(data => ({
                    status: res.status,
                    ok: res.ok,
                    data
                })))
                .then(({
                    ok,
                    data
                }) => {
                    if (ok && data.success) {
                        // Display Toastr Message
                        if (typeof toastr !== 'undefined') {
                            if (data.is_new) {
                                toastr.success(data.message, 'Newsletter');
                            } else {
                                toastr.info(data.message, 'Newsletter Notice');
                            }
                        } else if (typeof window.flashToast === 'function') {
                            window.flashToast(data.is_new ? 'success' : 'info', data.message, 'Newsletter');
                        }

                        if (feedback) {
                            feedback.classList.remove('hidden', 'text-rose-400');
                            feedback.classList.add('text-emerald-400');
                            feedback.innerHTML = `
                            <div class="flex items-center gap-2 p-2 rounded-xl bg-emerald-500/10 border border-emerald-500/20">
                                ${data.subscriber?.avatar ? `<img src="${data.subscriber.avatar}" class="w-5 h-5 rounded-full object-cover border border-emerald-500/30 shrink-0" alt="">` : ''}
                                <span class="truncate">${data.message}</span>
                            </div>
                        `;
                        }
                        if (emailInput) emailInput.value = '';

                        // Update all subscriber counter badges across the page
                        document.querySelectorAll('.newsletter-subscribers-count').forEach(el => {
                            el.textContent = data.total_subscribers;
                        });
                    } else {
                        const errorMsg = data.errors?.email?.[0] || data.message ||
                            'Subscription failed. Please check your email.';

                        // Display Toastr Error
                        if (typeof toastr !== 'undefined') {
                            toastr.error(errorMsg, 'Subscription Failed');
                        } else if (typeof window.flashToast === 'function') {
                            window.flashToast('error', errorMsg, 'Subscription Failed');
                        }

                        if (feedback) {
                            feedback.classList.remove('hidden', 'text-emerald-400');
                            feedback.classList.add('text-rose-400');
                            feedback.innerHTML = `
                            <div class="p-2 rounded-xl bg-rose-500/10 border border-rose-500/20">
                                <span>${errorMsg}</span>
                            </div>
                        `;
                        }
                    }
                })
                .catch(err => {
                    console.error('Newsletter error:', err);
                    const netErrorMsg = 'Network error. Please try again.';

                    if (typeof toastr !== 'undefined') {
                        toastr.error(netErrorMsg, 'Error');
                    } else if (typeof window.flashToast === 'function') {
                        window.flashToast('error', netErrorMsg, 'Error');
                    }

                    if (feedback) {
                        feedback.classList.remove('hidden', 'text-emerald-400');
                        feedback.classList.add('text-rose-400');
                        feedback.innerHTML = `
                        <div class="p-2 rounded-xl bg-rose-500/10 border border-rose-500/20">
                            <span>${netErrorMsg}</span>
                        </div>
                    `;
                    }
                })
                .finally(() => {
                    if (submitBtn) submitBtn.disabled = false;
                    if (btnText) btnText.textContent = 'Join';
                    if (btnIcon) btnIcon.classList.remove('hidden');
                    if (btnSpinner) btnSpinner.classList.add('hidden');
                });
        };
    }
</script>


