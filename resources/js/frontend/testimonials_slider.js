/**
 * Unified Testimonials Carousel Slider
 * Shows 2 items in one row on desktop (1 on mobile), slides 1 item every 5 seconds (5000ms).
 * Supports loop, prev/next arrows, dot indicators, hover pause, and touch swiping.
 */
export function initTestimonialsSlider() {
    const sliders = document.querySelectorAll('.testimonials-slider-container');
    if (!sliders.length) return;

    sliders.forEach(container => {
        // Prevent duplicate initializations
        if (container.dataset.sliderInitialized === 'true') return;
        container.dataset.sliderInitialized = 'true';

        const track = container.querySelector('.testimonials-slider-track');
        if (!track) return;

        const slides = Array.from(track.querySelectorAll('.testimonials-slide'));
        if (slides.length <= 1) return;

        const prevBtn = container.querySelector('.testimonials-prev-btn');
        const nextBtn = container.querySelector('.testimonials-next-btn');
        const dotsContainer = container.querySelector('.testimonials-dots');
        const autoPlayInterval = parseInt(container.dataset.autoplay || '5000', 10);

        let currentIndex = 0;
        let timer = null;
        let isTransitioning = false;

        function getVisibleCount() {
            return window.innerWidth >= 768 ? 2 : 1;
        }

        function getMaxIndex() {
            const visible = getVisibleCount();
            return Math.max(0, slides.length - visible);
        }

        function updateDots() {
            if (!dotsContainer) return;
            const maxIdx = getMaxIndex();
            dotsContainer.innerHTML = '';
            
            // Only show dots if there's more than 1 step
            if (maxIdx <= 0) return;

            for (let i = 0; i <= maxIdx; i++) {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.setAttribute('aria-label', `Go to slide ${i + 1}`);
                dot.className = `w-2.5 h-2.5 rounded-full transition-all duration-300 ${
                    i === currentIndex ? 'w-7 bg-current opacity-100' : 'bg-current opacity-30 hover:opacity-60'
                }`;
                dot.addEventListener('click', (e) => {
                    e.preventDefault();
                    goToSlide(i);
                    resetAutoPlay();
                });
                dotsContainer.appendChild(dot);
            }
        }

        function updatePosition(smooth = true) {
            const visible = getVisibleCount();
            const maxIdx = getMaxIndex();
            
            if (currentIndex > maxIdx) {
                currentIndex = 0;
            } else if (currentIndex < 0) {
                currentIndex = maxIdx;
            }

            const stepPercent = 100 / visible;
            const offset = currentIndex * stepPercent;

            if (smooth) {
                track.style.transition = 'transform 0.6s cubic-bezier(0.25, 1, 0.5, 1)';
            } else {
                track.style.transition = 'none';
            }
            track.style.transform = `translateX(-${offset}%)`;

            // Update dots active class
            if (dotsContainer) {
                const dots = dotsContainer.querySelectorAll('button');
                dots.forEach((dot, idx) => {
                    if (idx === currentIndex) {
                        dot.className = 'w-7 h-2.5 rounded-full transition-all duration-300 bg-current opacity-100';
                    } else {
                        dot.className = 'w-2.5 h-2.5 rounded-full transition-all duration-300 bg-current opacity-30 hover:opacity-60';
                    }
                });
            }
        }

        function goToSlide(index, smooth = true) {
            currentIndex = index;
            updatePosition(smooth);
        }

        function nextSlide() {
            const maxIdx = getMaxIndex();
            if (maxIdx <= 0) return;
            if (currentIndex >= maxIdx) {
                currentIndex = 0;
            } else {
                currentIndex += 1; // Slide forward by 1 item
            }
            updatePosition(true);
        }

        function prevSlide() {
            const maxIdx = getMaxIndex();
            if (maxIdx <= 0) return;
            if (currentIndex <= 0) {
                currentIndex = maxIdx;
            } else {
                currentIndex -= 1; // Slide back by 1 item
            }
            updatePosition(true);
        }

        function startAutoPlay() {
            stopAutoPlay();
            if (getMaxIndex() > 0 && autoPlayInterval > 0) {
                timer = setInterval(() => {
                    nextSlide();
                }, autoPlayInterval);
            }
        }

        function stopAutoPlay() {
            if (timer) {
                clearInterval(timer);
                timer = null;
            }
        }

        function resetAutoPlay() {
            stopAutoPlay();
            startAutoPlay();
        }

        // Button Listeners
        if (prevBtn) {
            prevBtn.addEventListener('click', (e) => {
                e.preventDefault();
                prevSlide();
                resetAutoPlay();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', (e) => {
                e.preventDefault();
                nextSlide();
                resetAutoPlay();
            });
        }

        // Pause on Hover
        container.addEventListener('mouseenter', stopAutoPlay);
        container.addEventListener('mouseleave', startAutoPlay);

        // Touch Swipe
        let startX = 0;
        let currentX = 0;
        let isTouching = false;

        container.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            isTouching = true;
            stopAutoPlay();
        }, { passive: true });

        container.addEventListener('touchmove', (e) => {
            if (!isTouching) return;
            currentX = e.touches[0].clientX;
        }, { passive: true });

        container.addEventListener('touchend', () => {
            if (!isTouching) return;
            isTouching = false;
            const diffX = startX - currentX;
            if (Math.abs(diffX) > 40) {
                if (diffX > 0) {
                    nextSlide();
                } else {
                    prevSlide();
                }
            }
            startAutoPlay();
        });

        // Window resize listener
        window.addEventListener('resize', () => {
            updateDots();
            updatePosition(false);
        });

        // Initialize state
        updateDots();
        updatePosition(false);
        startAutoPlay();
    });
}
