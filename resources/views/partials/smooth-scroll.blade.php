<!-- =========================================================================
     MODERN ULTRA-SMOOTH SCROLL ENGINE & ANIME.JS INTEGRATION
     - Universal native scrollbar elimination across root window
     - Dynamic sleek custom scrollbar for Sidebar and Modals (appears when scrolling/hovered)
     - Kinetic momentum requestAnimationFrame linear interpolation (lerp) for 60-144fps smooth wheel scroll
     - Anime.js cubic-bezier anchor, modal, and programmatic scroll animations
     - Sleek, ultra-thin (3px) floating glowing accent indicator with zero layout shift
     - Auto-hides when stationary; strictly no horizontal scrollbar or chunky native rails
     ========================================================================= -->

<style>
    /* Universal elimination of root native browser scrollbars */
    html,
    body {
        scrollbar-width: none !important; /* Firefox */
        -ms-overflow-style: none !important; /* IE 10+, Edge */
    }

    html::-webkit-scrollbar,
    body::-webkit-scrollbar {
        width: 0px !important;
        height: 0px !important;
        display: none !important;
        background: transparent !important;
    }

    /* Ultra-thin floating scroll indicator for window */
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

    /* =========================================================================
       DYNAMIC SLEEK SCROLLBAR: Sidebar & AI Modals (Appears when scrolling)
       ========================================================================= */
    #adminSidebar .overflow-y-auto,
    #previewModal .overflow-y-auto,
    .sidebar-scroll,
    .ai-modal-scroll {
        scrollbar-width: thin !important;
        scrollbar-color: transparent transparent !important;
        transition: scrollbar-color 0.35s ease;
    }

    #adminSidebar .overflow-y-auto::-webkit-scrollbar,
    #previewModal .overflow-y-auto::-webkit-scrollbar,
    .sidebar-scroll::-webkit-scrollbar,
    .ai-modal-scroll::-webkit-scrollbar {
        width: 5px !important;
        height: 5px !important;
        display: block !important;
    }

    #adminSidebar .overflow-y-auto::-webkit-scrollbar-track,
    #previewModal .overflow-y-auto::-webkit-scrollbar-track,
    .sidebar-scroll::-webkit-scrollbar-track,
    .ai-modal-scroll::-webkit-scrollbar-track {
        background: transparent !important;
    }

    #adminSidebar .overflow-y-auto::-webkit-scrollbar-thumb,
    #previewModal .overflow-y-auto::-webkit-scrollbar-thumb,
    .sidebar-scroll::-webkit-scrollbar-thumb,
    .ai-modal-scroll::-webkit-scrollbar-thumb {
        background: transparent !important;
        border-radius: 9999px !important;
        border: none !important;
        transition: background 0.3s ease, box-shadow 0.3s ease;
    }

    /* When actively scrolling or hovered: sleek glowing cyan scrollbar illuminates smoothly */
    #adminSidebar .overflow-y-auto.is-scrolling,
    #previewModal .overflow-y-auto.is-scrolling,
    .sidebar-scroll.is-scrolling,
    .ai-modal-scroll.is-scrolling,
    #adminSidebar .overflow-y-auto:hover,
    #previewModal .overflow-y-auto:hover,
    .sidebar-scroll:hover,
    .ai-modal-scroll:hover {
        scrollbar-color: rgba(6, 182, 212, 0.85) transparent !important;
    }

    #adminSidebar .overflow-y-auto.is-scrolling::-webkit-scrollbar-thumb,
    #previewModal .overflow-y-auto.is-scrolling::-webkit-scrollbar-thumb,
    .sidebar-scroll.is-scrolling::-webkit-scrollbar-thumb,
    .ai-modal-scroll.is-scrolling::-webkit-scrollbar-thumb,
    #adminSidebar .overflow-y-auto:hover::-webkit-scrollbar-thumb,
    #previewModal .overflow-y-auto:hover::-webkit-scrollbar-thumb,
    .sidebar-scroll:hover::-webkit-scrollbar-thumb,
    .ai-modal-scroll:hover::-webkit-scrollbar-thumb {
        background: rgba(6, 182, 212, 0.85) !important;
        box-shadow: 0 0 10px rgba(6, 182, 212, 0.5) !important;
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
    let rafId = null;
    let activeAnchorAnimation = null;
    let isProgrammaticWheelScroll = false;
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
        indicator.style.opacity = '';
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
            isProgrammaticWheelScroll = true;
            window.scrollTo(0, Math.round(currentY * 10) / 10);
            isProgrammaticWheelScroll = false;
            updateIndicator();
            rafId = requestAnimationFrame(renderSmoothStep);
        } else {
            currentY = targetY;
            isProgrammaticWheelScroll = true;
            window.scrollTo(0, currentY);
            isProgrammaticWheelScroll = false;
            updateIndicator();
            isTicking = false;
            rafId = null;
        }
    }

    // Smooth wheel listener for main window
    window.addEventListener('wheel', function(e) {
        // Return early on pinch-zoom / Ctrl+wheel before interception or preventDefault
        if (e.ctrlKey) return;

        // If active element is an input or editable, do not hijack
        const activeTag = document.activeElement ? document.activeElement.tagName.toLowerCase() : '';
        if (['input', 'textarea', 'select'].includes(activeTag) || (document.activeElement && document.activeElement.isContentEditable)) {
            return;
        }

        // Check if cursor is inside an internal scrollable container
        let el = e.target;
        let isInsideScrollContainer = false;
        while (el && el !== document.body && el !== document.documentElement) {
            const style = window.getComputedStyle(el);
            const hasVerticalOverflow = (style.overflowY === 'auto' || style.overflowY === 'scroll') && el.scrollHeight > el.clientHeight;
            const hasHorizontalOverflow = (style.overflowX === 'auto' || style.overflowX === 'scroll') && el.scrollWidth > el.clientWidth;

            if (hasVerticalOverflow || (hasHorizontalOverflow && Math.abs(e.deltaX) > 0)) {
                isInsideScrollContainer = true;
                break;
            }
            el = el.parentElement;
        }

        if (isInsideScrollContainer) {
            // Allow internal container to scroll natively without page hijack
            return;
        }

        // Cancel active anchor animation before wheel takes ownership
        if (activeAnchorAnimation) {
            activeAnchorAnimation.pause();
            activeAnchorAnimation = null;
            targetY = window.pageYOffset;
            currentY = window.pageYOffset;
        }

        const maxScroll = Math.max(
            document.body.scrollHeight,
            document.documentElement.scrollHeight
        ) - window.innerHeight;

        if (maxScroll <= 5) return;

        // Only hijack vertical scrolling
        if (Math.abs(e.deltaY) === 0) return;

        let delta = e.deltaY;
        if (e.deltaMode === 1) delta *= 32;
        else if (e.deltaMode === 2) delta *= window.innerHeight;

        targetY = Math.max(0, Math.min(targetY + delta * 0.9, maxScroll));

        if (!isTicking) {
            isTicking = true;
            currentY = window.pageYOffset;
            rafId = requestAnimationFrame(renderSmoothStep);
        }

        e.preventDefault();
    }, { passive: false });

    // Sync state on external scroll (e.g. keyboard arrows, scrollbar drag)
    window.addEventListener('scroll', function() {
        if (isTicking) {
            // If scroll was triggered by an external source (keyboard/scrollbar), cancel active wheel interpolation
            if (!isProgrammaticWheelScroll && Math.abs(window.pageYOffset - currentY) > 2) {
                if (rafId) {
                    cancelAnimationFrame(rafId);
                    rafId = null;
                }
                isTicking = false;
                targetY = window.pageYOffset;
                currentY = window.pageYOffset;
            }
        } else {
            targetY = window.pageYOffset;
            currentY = window.pageYOffset;
        }
        updateIndicator();
    }, { passive: true });

    // 2. Dynamic Scroll-Activated Scrollbars for Sidebar and Modals
    document.addEventListener('scroll', function(e) {
        const target = e.target;
        if (target && target.nodeType === 1 && target !== document && target !== document.documentElement && target !== document.body) {
            target.classList.add('is-scrolling');
            clearTimeout(target._scrollActivityTimer);
            target._scrollActivityTimer = setTimeout(function() {
                target.classList.remove('is-scrolling');
            }, 650);
        }
    }, true); // useCapture: true captures scroll on ALL elements

    // 3. Anime.js Anchor & Programmatic Smooth Scrolling
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
            // Preserve URL fragment and session-history behavior for Back navigation
            if (window.history && window.history.pushState) {
                window.history.pushState(null, '', href);
            } else {
                window.location.hash = href;
            }

            // Cancel any pending wheel interpolation frame before taking ownership
            if (rafId) {
                cancelAnimationFrame(rafId);
                rafId = null;
            }
            isTicking = false;

            if (activeAnchorAnimation) {
                activeAnchorAnimation.pause();
                activeAnchorAnimation = null;
            }

            const topOffset = targetElem.getBoundingClientRect().top + window.pageYOffset - 75;
            targetY = topOffset;
            currentY = window.pageYOffset;

            if (typeof anime !== 'undefined') {
                activeAnchorAnimation = anime({
                    targets: [document.scrollingElement || document.documentElement, document.body],
                    scrollTop: topOffset,
                    duration: 750,
                    easing: 'easeInOutCubic',
                    complete: function() {
                        activeAnchorAnimation = null;
                        targetY = window.pageYOffset;
                        currentY = window.pageYOffset;
                        updateIndicator();
                    }
                });
            } else {
                window.scrollTo({ top: topOffset, behavior: 'smooth' });
                targetY = topOffset;
                currentY = topOffset;
                updateIndicator();
            }
        }
    });

    // 4. Dynamic Material Palette Color Synchronization
    window.addEventListener('theme-color-changed', function(e) {
        if (e.detail && e.detail.color && indicator) {
            indicator.style.backgroundColor = e.detail.color;
            indicator.style.boxShadow = `0 0 10px ${e.detail.color}80`;
        }
    });

    // 5. Initial layout sync
    window.addEventListener('resize', updateIndicator, { passive: true });
    document.addEventListener('DOMContentLoaded', updateIndicator);
})();
</script>