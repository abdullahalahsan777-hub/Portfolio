<!-- =========================================================================
     MODERN ULTRA-SMOOTH SCROLL ENGINE & ANIME.JS INTEGRATION
     - Universal native scrollbar elimination across all browsers (Chrome, Firefox, Safari, Edge)
     - Kinetic momentum requestAnimationFrame linear interpolation (lerp) for 60-144fps smooth wheel scroll
     - Anime.js cubic-bezier anchor, modal, and programmatic scroll animations
     - Sleek, ultra-thin (3px) floating glowing accent indicator with zero layout shift
     - Auto-hides when stationary; strictly no horizontal scrollbar or chunky vertical rails
     ========================================================================= -->

<style>
    /* Universal elimination of all native browser scrollbars */
    *,
    *::before,
    *::after {
        scrollbar-width: none !important; /* Firefox: completely suppresses scrollbars everywhere */
        -ms-overflow-style: none !important; /* IE 10+, Edge */
    }

    *::-webkit-scrollbar,
    ::-webkit-scrollbar,
    html::-webkit-scrollbar,
    body::-webkit-scrollbar {
        width: 0px !important;
        height: 0px !important;
        display: none !important; /* WebKit (Chrome, Safari, Edge, Opera) */
        background: transparent !important;
    }

    /* Container specific zero-scrollbar reinforcement */
    #adminSidebar .overflow-y-auto,
    #adminSidebar,
    #previewModal .overflow-y-auto,
    .overflow-y-auto,
    .overflow-x-auto,
    pre,
    code,
    textarea {
        scrollbar-width: none !important;
        -ms-overflow-style: none !important;
    }

    #adminSidebar .overflow-y-auto::-webkit-scrollbar,
    #previewModal .overflow-y-auto::-webkit-scrollbar,
    pre::-webkit-scrollbar {
        width: 0px !important;
        height: 0px !important;
        display: none !important;
    }

    /* Ultra-thin floating scroll indicator */
    #smoothScrollPill {
        position: fixed;
        right: 3px;
        top: 0;
        width: 3px;
        height: 0px;
        border-radius: 9999px;
        background-color: var(--theme-primary, #00e5ff);
        box-shadow: 0 0 10px var(--theme-primary-glow, rgba(0, 229, 255, 0.45));
        z-index: 999999;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.35s ease, background-color 0.3s ease, box-shadow 0.3s ease;
    }

    #smoothScrollPill.scrolling {
        opacity: 0.85;
    }
</style>

<!-- Floating Ultra-Thin Scroll Progress Pill -->
<div id="smoothScrollPill" aria-hidden="true"></div>

<!-- Anime.js Core Engine -->
<script src="{{ asset('assets/plugins/anime/anime.min.js') }}"></script>

<script>
(function() {
    'use strict';

    // 1. Kinetic Momentum Smooth Scroll Engine for Window
    let targetY = window.pageYOffset;
    let currentY = window.pageYOffset;
    let isTicking = false;
    let hideTimer = null;
    const easeFactor = 0.088; // Butter-smooth kinetic damping

    const indicator = document.getElementById('smoothScrollPill');

    function updateIndicator() {
        if (!indicator) return;
        const totalHeight = Math.max(
            document.body.scrollHeight,
            document.documentElement.scrollHeight
        ) - window.innerHeight;

        if (totalHeight <= 10) {
            indicator.style.opacity = '0';
            return;
        }

        const progress = Math.max(0, Math.min(1, window.pageYOffset / totalHeight));
        const viewH = window.innerHeight;
        const pillHeight = Math.max(28, Math.round(viewH * (viewH / (totalHeight + viewH))));
        const maxTop = viewH - pillHeight - 6;
        const pillTop = Math.round(progress * maxTop) + 3;

        indicator.style.height = pillHeight + 'px';
        indicator.style.transform = `translate3d(0, ${pillTop}px, 0)`;
        indicator.classList.add('scrolling');

        clearTimeout(hideTimer);
        hideTimer = setTimeout(() => {
            if (indicator) {
                indicator.classList.remove('scrolling');
            }
        }, 650);
    }

    function renderSmoothStep() {
        const diff = targetY - currentY;
        if (Math.abs(diff) > 0.45) {
            currentY += diff * easeFactor;
            window.scrollTo(0, Math.round(currentY * 10) / 10);
            updateIndicator();
            requestAnimationFrame(renderSmoothStep);
        } else {
            currentY = targetY;
            window.scrollTo(0, currentY);
            updateIndicator();
            isTicking = false;
        }
    }

    // Smooth wheel listener
    window.addEventListener('wheel', function(e) {
        // If cursor is inside an internal scrollable container (e.g. sidebar, modal, code pre, textarea)
        let el = e.target;
        let isInsideScrollContainer = false;
        while (el && el !== document.body && el !== document.documentElement) {
            const style = window.getComputedStyle(el);
            const overflowY = style.overflowY;
            if ((overflowY === 'auto' || overflowY === 'scroll') && el.scrollHeight > el.clientHeight) {
                isInsideScrollContainer = true;
                break;
            }
            el = el.parentElement;
        }

        if (isInsideScrollContainer) {
            // Allow internal container to scroll natively with zero scrollbars
            return;
        }

        let delta = e.deltaY;
        if (e.deltaMode === 1) delta *= 32;
        else if (e.deltaMode === 2) delta *= window.innerHeight;

        const maxScroll = Math.max(
            document.body.scrollHeight,
            document.documentElement.scrollHeight
        ) - window.innerHeight;

        targetY = Math.max(0, Math.min(targetY + delta * 0.9, maxScroll));

        if (!isTicking) {
            isTicking = true;
            currentY = window.pageYOffset;
            requestAnimationFrame(renderSmoothStep);
        }

        e.preventDefault();
    }, { passive: false });

    // Sync state on external scroll (e.g. keyboard arrows, drag)
    window.addEventListener('scroll', function() {
        if (!isTicking) {
            targetY = window.pageYOffset;
            currentY = window.pageYOffset;
            updateIndicator();
        }
    }, { passive: true });

    // 2. Anime.js Anchor & Programmatic Smooth Scrolling
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a[href^="#"]');
        if (!link) return;
        const href = link.getAttribute('href');
        if (!href || href === '#' || href === '#!') return;

        let targetElem = null;
        try {
            targetElem = document.querySelector(href);
        } catch (err) {}

        if (targetElem) {
            e.preventDefault();
            const topOffset = targetElem.getBoundingClientRect().top + window.pageYOffset - 75;
            targetY = topOffset;
            currentY = topOffset;

            if (typeof anime !== 'undefined') {
                anime({
                    targets: [document.scrollingElement || document.documentElement, document.body],
                    scrollTop: topOffset,
                    duration: 750,
                    easing: 'easeInOutCubic',
                    complete: function() {
                        targetY = window.pageYOffset;
                        currentY = window.pageYOffset;
                        updateIndicator();
                    }
                });
            } else {
                window.scrollTo({ top: topOffset, behavior: 'smooth' });
            }
        }
    });

    // 3. Dynamic Material Palette Color Synchronization
    window.addEventListener('theme-color-changed', function(e) {
        if (e.detail && e.detail.color && indicator) {
            indicator.style.backgroundColor = e.detail.color;
            indicator.style.boxShadow = `0 0 10px ${e.detail.color}80`;
        }
    });

    // 4. Initial layout sync
    window.addEventListener('resize', updateIndicator, { passive: true });
    document.addEventListener('DOMContentLoaded', updateIndicator);
})();
</script>