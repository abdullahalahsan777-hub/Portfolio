/**
 * Graphic Designer Theme JavaScript
 * Handles portfolio filtering, animated counters, and interactive UI micro-animations.
 */

export function initGraphicDesignerTheme() {
    // 1. Portfolio Filter Tabs
    const filterButtons = document.querySelectorAll('[data-gd-filter]');
    const projectCards = document.querySelectorAll('[data-gd-category]');

    if (filterButtons.length > 0 && projectCards.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetFilter = button.getAttribute('data-gd-filter');

                // Update active tab styles
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-[#7c3aed]', 'text-white', 'shadow-lg');
                    btn.classList.add('text-slate-400', 'hover:text-white', 'hover:bg-white/5');
                });

                button.classList.add('bg-[#7c3aed]', 'text-white', 'shadow-lg');
                button.classList.remove('text-slate-400', 'hover:text-white', 'hover:bg-white/5');

                // Filter Cards with smooth opacity
                projectCards.forEach(card => {
                    const cardCategory = card.getAttribute('data-gd-category');
                    if (targetFilter === 'all' || cardCategory === targetFilter || cardCategory.includes(targetFilter)) {
                        card.style.display = 'block';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'scale(1)';
                        }, 20);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 250);
                    }
                });
            });
        });
    }

    // 2. Animated Stats Counters
    const counters = document.querySelectorAll('[data-counter-target]');
    if (counters.length > 0 && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.getAttribute('data-counter-target'), 10);
                    const suffix = el.getAttribute('data-counter-suffix') || '+';
                    let current = 0;
                    const duration = 1500;
                    const stepTime = Math.max(Math.floor(duration / (target || 1)), 15);

                    const timer = setInterval(() => {
                        current += Math.ceil(target / 40);
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
}
