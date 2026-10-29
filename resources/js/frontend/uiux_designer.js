/**
 * UI/UX Designer Theme JavaScript
 * Handles interactive counters, tool hover states, and smooth UI/UX micro-interactions.
 */

export function initUiUxDesignerTheme() {
    // 1. Tool Percentage Counters & Intersection Observer
    const counters = document.querySelectorAll('.theme-uiux_designer [data-counter-target]');
    if (counters.length > 0 && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.getAttribute('data-counter-target'), 10);
                    const suffix = el.getAttribute('data-counter-suffix') || '+';
                    let current = 0;
                    const duration = 1400;
                    const stepTime = Math.max(Math.floor(duration / (target || 1)), 15);

                    const timer = setInterval(() => {
                        current += Math.ceil(target / 35);
                        if (current >= target) {
                            el.textContent = target + suffix;
                            clearInterval(timer);
                        } else {
                            el.textContent = current + suffix;
                        }
                    }, stepTime);

                    obs.unobserve(el);
                }
            });
        }, { threshold: 0.2 });

        counters.forEach(counter => observer.observe(counter));
    }

    // 2. Interactive Service Card Focus
    const serviceCards = document.querySelectorAll('.uiux-service-card');
    serviceCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            serviceCards.forEach(c => {
                if (c !== card) c.style.opacity = '0.6';
            });
        });
        card.addEventListener('mouseleave', () => {
            serviceCards.forEach(c => c.style.opacity = '1');
        });
    });
}
