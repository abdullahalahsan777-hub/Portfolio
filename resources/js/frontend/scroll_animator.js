/**
 * =========================================================================
 * GLOBAL SCROLL ANIMATION ENGINE (All Frontend Themes)
 * High-performance, butter-smooth scroll-to-animation system for sections
 * and content cards with automatic staggered cascading reveals.
 * =========================================================================
 */

export function initScrollAnimator() {
    // Respect user's accessibility preferences
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.querySelectorAll('.reveal-init, section').forEach(el => {
            el.classList.add('revealed', 'section-revealed');
        });
        return;
    }

    if (!('IntersectionObserver' in window)) {
        // Fallback for older browsers
        document.querySelectorAll('.reveal-init, section').forEach(el => {
            el.classList.add('revealed', 'section-revealed');
        });
        return;
    }

    // 1. Core Intersection Observer for content elements
    const elementObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                el.classList.add('revealed');
                observer.unobserve(el);
            }
        });
    }, {
        root: null,
        rootMargin: '0px 0px -60px 0px',
        threshold: 0.1
    });

    // 2. Observer for top-level section containers
    const sectionObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('section-revealed');
                observer.unobserve(entry.target);
            }
        });
    }, {
        root: null,
        rootMargin: '0px 0px -40px 0px',
        threshold: 0.05
    });

    // Auto-discover and prepare sections
    const sections = document.querySelectorAll('main section, body > div > section, section:not([data-no-reveal])');
    sections.forEach((sec, secIdx) => {
        if (!sec.classList.contains('section-reveal-init') && !sec.hasAttribute('data-no-reveal')) {
            sec.classList.add('section-reveal-init');
            sectionObserver.observe(sec);
        }

        // Auto-discover section headers & titles
        const headers = sec.querySelectorAll(':scope > div > div > h1, :scope > div > div > h2, :scope > div > h2, :scope > div > div > .section-name, :scope h1, :scope h2, :scope .dev-hero-tag, :scope .section-heading');
        headers.forEach((h, hIdx) => {
            if (!h.classList.contains('reveal-init')) {
                h.classList.add('reveal-init', 'reveal-fade-up');
                h.style.setProperty('--reveal-delay', `${Math.min(hIdx * 80, 240)}ms`);
                elementObserver.observe(h);
            }
        });

        // Auto-discover grids and list items for staggered cascade
        const grids = sec.querySelectorAll('.grid, .grid-cols-1, .grid-cols-2, .grid-cols-3, .grid-cols-4, [class*="grid-cols-"]');
        grids.forEach(grid => {
            const cards = grid.children;
            const count = cards.length;
            Array.from(cards).forEach((card, idx) => {
                if (!card.classList.contains('reveal-init') && !card.hasAttribute('data-no-reveal')) {
                    card.classList.add('reveal-init', 'reveal-fade-up');
                    // Compute staggered wave delay (cycles for large grids)
                    const stagger = (idx % 6) * 90;
                    card.style.setProperty('--reveal-delay', `${stagger}ms`);
                    elementObserver.observe(card);
                }
            });
        });

        // Auto-discover standalone feature cards, banners & CTA blocks
        const specificCards = sec.querySelectorAll('.blayden-card, .illustrator-card, .portfolio-card, .software-card, .service-card, .stat-card, .testimonial-card, .faq-card, .pricing-card, .timeline-card, .feature-card');
        specificCards.forEach((c, idx) => {
            if (!c.classList.contains('reveal-init') && !c.hasAttribute('data-no-reveal')) {
                c.classList.add('reveal-init', 'reveal-fade-up');
                if (!c.style.getPropertyValue('--reveal-delay')) {
                    c.style.setProperty('--reveal-delay', `${(idx % 4) * 80}ms`);
                }
                elementObserver.observe(c);
            }
        });

        // Two-column side-by-side elements (e.g. Hero Left Column vs Right Image)
        const leftCols = sec.querySelectorAll('.lg\\:col-span-7, .lg\\:col-span-6:first-child, .md\\:w-1\\/2:first-child');
        leftCols.forEach(col => {
            if (!col.classList.contains('reveal-init')) {
                col.classList.add('reveal-init', 'reveal-fade-left');
                elementObserver.observe(col);
            }
        });

        const rightCols = sec.querySelectorAll('.lg\\:col-span-5, .lg\\:col-span-6:last-child, .md\\:w-1\\/2:last-child');
        rightCols.forEach(col => {
            if (!col.classList.contains('reveal-init')) {
                col.classList.add('reveal-init', 'reveal-fade-right');
                col.style.setProperty('--reveal-delay', '120ms');
                elementObserver.observe(col);
            }
        });
    });

    // Explicitly tagged manual elements [data-reveal]
    document.querySelectorAll('[data-reveal]').forEach(el => {
        const type = el.getAttribute('data-reveal') || 'fade-up';
        const delay = el.getAttribute('data-reveal-delay') || '0ms';
        el.classList.add('reveal-init', `reveal-${type}`);
        el.style.setProperty('--reveal-delay', delay);
        elementObserver.observe(el);
    });

    // Check elements already visible in initial viewport and reveal immediately
    setTimeout(() => {
        const initialVisible = document.querySelectorAll('.reveal-init:not(.revealed)');
        const windowHeight = window.innerHeight || document.documentElement.clientHeight;

        initialVisible.forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.top <= windowHeight - 40 && rect.bottom >= 0) {
                el.classList.add('revealed');
                elementObserver.unobserve(el);
            }
        });

        document.querySelectorAll('section.section-reveal-init:not(.section-revealed)').forEach(sec => {
            const rect = sec.getBoundingClientRect();
            if (rect.top <= windowHeight - 40 && rect.bottom >= 0) {
                sec.classList.add('section-revealed');
                sectionObserver.unobserve(sec);
            }
        });
    }, 60);

    // Re-scan when tab or filter changes (e.g. portfolio category switch)
    window.addEventListener('resize', debounce(() => {
        const unrevealed = document.querySelectorAll('.reveal-init:not(.revealed)');
        unrevealed.forEach(el => elementObserver.observe(el));
    }, 200));
}

function debounce(func, wait) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}
