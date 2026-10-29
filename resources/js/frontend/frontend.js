import { initTestimonialsSlider } from './testimonials_slider';
import { initScrollAnimator } from './scroll_animator';

export function initFrontend() {
    // 0. Initialize Global Scroll to Animation Engine (All Themes)
    initScrollAnimator();
    // 1. Contact Form AJAX Submission
    const contactForm = document.getElementById('contactForm');
    const contactFeedback = document.getElementById('contactFeedback');

    if (contactForm) {
        contactForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn ? submitBtn.innerHTML : 'Send Message';

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    Sending...
                `;
            }

            const formData = new FormData(contactForm);

            try {
                const response = await fetch(contactForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    if (contactFeedback) {
                        contactFeedback.className = 'p-4 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-xs font-medium block animate-fade-in';
                        contactFeedback.innerHTML = `&#10003; ${data.message || 'Thank you! Your message has been sent successfully.'}`;
                        contactFeedback.classList.remove('hidden');
                    }
                    contactForm.reset();
                } else {
                    throw new Error(data.message || 'Validation error occurred.');
                }
            } catch (err) {
                if (contactFeedback) {
                    contactFeedback.className = 'p-4 rounded-2xl bg-rose-500/15 border border-rose-500/30 text-rose-300 text-xs font-medium block animate-fade-in';
                    contactFeedback.innerHTML = `&#9888; ${err.message || 'Something went wrong. Please check your inputs and try again.'}`;
                    contactFeedback.classList.remove('hidden');
                }
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }
            }
        });
    }

    // 2. Sticky Glass Navbar on Scroll
    const headerNav = document.getElementById('mainHeader');
    if (headerNav) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 40) {
                headerNav.classList.add('shadow-xl', 'border-b', 'border-white/10');
            } else {
                headerNav.classList.remove('shadow-xl');
            }
        });
    }

    // 3. Mobile Navigation Drawer Toggles (All themes)
    const toggleConfigs = [
        { btn: 'devMobileToggle', menu: 'devMobileMenu' },
        { btn: 'uiuxMobileToggle', menu: 'uiuxMobileMenu' },
        { btn: 'gdMobileToggle', menu: 'gdMobileMenu' }
    ];

    toggleConfigs.forEach(cfg => {
        const btnEl = document.getElementById(cfg.btn);
        const menuEl = document.getElementById(cfg.menu);
        if (btnEl && menuEl) {
            btnEl.addEventListener('click', (e) => {
                e.stopPropagation();
                menuEl.classList.toggle('hidden');
            });
        }
    });

    // 4. Initialize Testimonials Sliders (All Themes)
    initTestimonialsSlider();
}
