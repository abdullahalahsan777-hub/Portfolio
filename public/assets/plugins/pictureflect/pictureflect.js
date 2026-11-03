/**
 * Pictureflect Photo Viewer Plugin
 * Elegant, minimalist, folder/gallery-oriented photo viewer with
 * smooth zoom & pan, rotation, flip, slideshow, inspector, and thumbnail drawer.
 */

(function (window, document) {
    'use strict';

    var Pictureflect = {
        items: [],
        currentIndex: 0,
        zoom: 1,
        rotation: 0,
        flipH: 1,
        panX: 0,
        panY: 0,
        isPanning: false,
        startX: 0,
        startY: 0,
        slideshowTimer: null,
        slideshowInterval: 4000,
        isOpen: false,
        isInspectorOpen: false,
        isThumbsCollapsed: false,

        // DOM elements cache
        el: {},

        /**
         * Initialize Pictureflect Photo Viewer DOM structure and event listeners.
         */
        init: function () {
            if (document.getElementById('pictureflect-viewer')) {
                this.bindTriggers();
                return;
            }

            this.createDOM();
            this.bindEvents();
            this.bindTriggers();
        },

        /**
         * Build the viewer HTML structure.
         */
        createDOM: function () {
            var container = document.createElement('div');
            container.id = 'pictureflect-viewer';
            container.innerHTML = [
                '<div class="pf-ambient-glow" id="pfAmbientGlow"></div>',
                
                // TOP BAR
                '<div class="pf-top-bar">',
                '  <div class="pf-brand-group">',
                '    <div class="pf-brand-badge" title="Pictureflect Photo Viewer">',
                '      <svg viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>',
                '      <span>Pictureflect</span>',
                '    </div>',
                '    <div class="pf-info-summary">',
                '      <span class="pf-counter" id="pfCounter">1 / 1</span>',
                '      <span class="pf-title" id="pfTitle">Photo</span>',
                '      <span class="pf-category-pill" id="pfCategory">General</span>',
                '    </div>',
                '  </div>',
                
                '  <div class="pf-tools">',
                '    <button class="pf-btn" id="pfZoomOut" title="Zoom Out (-)"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg></button>',
                '    <div class="pf-zoom-display" id="pfZoomDisplay" title="Click to toggle Fit / 100%">100%</div>',
                '    <button class="pf-btn" id="pfZoomIn" title="Zoom In (+)"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg></button>',
                '    <button class="pf-btn" id="pfResetZoom" title="Fit to Screen (0)"><svg viewBox="0 0 24 24"><polyline points="15 3 21 3 21 9"></polyline><polyline points="9 21 3 21 3 15"></polyline><line x1="21" y1="3" x2="14" y2="10"></line><line x1="3" y1="21" x2="10" y2="14"></line></svg></button>',
                '    <div class="pf-divider"></div>',
                '    <button class="pf-btn" id="pfRotateLeft" title="Rotate Left -90° (Shift+R)"><svg viewBox="0 0 24 24"><polyline points="1 4 1 10 7 10"></polyline><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path></svg></button>',
                '    <button class="pf-btn" id="pfRotateRight" title="Rotate Right +90° (R)"><svg viewBox="0 0 24 24"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg></button>',
                '    <button class="pf-btn" id="pfFlipH" title="Flip Horizontal"><svg viewBox="0 0 24 24"><polyline points="16 3 21 3 21 8"></polyline><line x1="4" y1="20" x2="21" y2="3"></line><polyline points="21 16 21 21 16 21"></polyline><line x1="15" y1="15" x2="21" y2="21"></line><line x1="4" y1="4" x2="9" y2="9"></line></svg></button>',
                '    <div class="pf-divider"></div>',
                '    <button class="pf-btn" id="pfSlideshow" title="Play Slideshow (Space)"><svg id="pfPlayIcon" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg></button>',
                '    <button class="pf-btn" id="pfInspectorBtn" title="Inspect Photo Details (I)"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg></button>',
                '    <button class="pf-btn" id="pfFullscreen" title="Toggle Fullscreen (F)"><svg viewBox="0 0 24 24"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></button>',
                '    <button class="pf-btn pf-btn-close" id="pfClose" title="Close Viewer (Esc)"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>',
                '  </div>',
                '</div>',

                // STAGE / CANVAS
                '<div class="pf-stage" id="pfStage">',
                '  <button class="pf-nav-btn pf-prev-btn" id="pfPrev" title="Previous Image (←)"><svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"></polyline></svg></button>',
                '  <div class="pf-spinner" id="pfSpinner"></div>',
                '  <div class="pf-image-wrapper" id="pfWrapper">',
                '    <img class="pf-image" id="pfImage" src="" alt="Pictureflect Preview" draggable="false" />',
                '  </div>',
                '  <button class="pf-nav-btn pf-next-btn" id="pfNext" title="Next Image (→)"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg></button>',

                // INSPECTOR OVERLAY
                '  <div class="pf-inspector-panel" id="pfInspector">',
                '    <div class="pf-inspector-header">',
                '      <span>Pictureflect Inspector</span>',
                '      <button class="pf-btn" id="pfInspectorClose" style="width:24px;height:24px;"><svg style="width:12px;height:12px;" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>',
                '    </div>',
                '    <div class="pf-inspector-content">',
                '      <div class="pf-inspector-row"><span class="pf-inspector-label">Filename:</span><span class="pf-inspector-value" id="pfInspName">-</span></div>',
                '      <div class="pf-inspector-row"><span class="pf-inspector-label">Category:</span><span class="pf-inspector-value" id="pfInspCat">-</span></div>',
                '      <div class="pf-inspector-row"><span class="pf-inspector-label">Theme:</span><span class="pf-inspector-value" id="pfInspTheme">-</span></div>',
                '      <div class="pf-inspector-row"><span class="pf-inspector-label">Resolution:</span><span class="pf-inspector-value" id="pfInspRes">-</span></div>',
                '      <div class="pf-inspector-row"><span class="pf-inspector-label">Aspect Ratio:</span><span class="pf-inspector-value" id="pfInspRatio">-</span></div>',
                '      <div class="pf-inspector-row"><span class="pf-inspector-label">Zoom Level:</span><span class="pf-inspector-value" id="pfInspZoom">100%</span></div>',
                '    </div>',
                '  </div>',
                '</div>',

                // BOTTOM THUMBNAILS DRAWER
                '<div class="pf-bottom-bar" id="pfBottomBar">',
                '  <div class="pf-bottom-toggle-row">',
                '    <button class="pf-bottom-toggle-btn" id="pfToggleThumbs">',
                '      <span id="pfThumbToggleIcon">▼</span> <span>Thumbnails</span>',
                '    </button>',
                '    <span class="pf-shortcuts-hint">Keys: ← / → Navigate • Scroll Zoom • Space Slideshow • Esc Close</span>',
                '  </div>',
                '  <div class="pf-thumbs-scroll" id="pfThumbsContainer"></div>',
                '</div>'
            ].join('');

            (document.documentElement || document.body).appendChild(container);

            // Cache DOM elements
            this.el = {
                viewer: container,
                stage: document.getElementById('pfStage'),
                wrapper: document.getElementById('pfWrapper'),
                image: document.getElementById('pfImage'),
                glow: document.getElementById('pfAmbientGlow'),
                spinner: document.getElementById('pfSpinner'),
                counter: document.getElementById('pfCounter'),
                title: document.getElementById('pfTitle'),
                category: document.getElementById('pfCategory'),
                zoomDisplay: document.getElementById('pfZoomDisplay'),
                prev: document.getElementById('pfPrev'),
                next: document.getElementById('pfNext'),
                zoomIn: document.getElementById('pfZoomIn'),
                zoomOut: document.getElementById('pfZoomOut'),
                resetZoom: document.getElementById('pfResetZoom'),
                rotateLeft: document.getElementById('pfRotateLeft'),
                rotateRight: document.getElementById('pfRotateRight'),
                flipH: document.getElementById('pfFlipH'),
                slideshow: document.getElementById('pfSlideshow'),
                playIcon: document.getElementById('pfPlayIcon'),
                inspectorBtn: document.getElementById('pfInspectorBtn'),
                inspector: document.getElementById('pfInspector'),
                inspectorClose: document.getElementById('pfInspectorClose'),
                fullscreen: document.getElementById('pfFullscreen'),
                close: document.getElementById('pfClose'),
                bottomBar: document.getElementById('pfBottomBar'),
                toggleThumbs: document.getElementById('pfToggleThumbs'),
                thumbToggleIcon: document.getElementById('pfThumbToggleIcon'),
                thumbsContainer: document.getElementById('pfThumbsContainer'),
                inspName: document.getElementById('pfInspName'),
                inspCat: document.getElementById('pfInspCat'),
                inspTheme: document.getElementById('pfInspTheme'),
                inspRes: document.getElementById('pfInspRes'),
                inspRatio: document.getElementById('pfInspRatio'),
                inspZoom: document.getElementById('pfInspZoom')
            };
        },

        /**
         * Scan page and bind click handlers to all triggers.
         */
        bindTriggers: function () {
            var self = this;
            var triggers = document.querySelectorAll('[data-pictureflect]');

            triggers.forEach(function (trigger) {
                // Prevent duplicate listener
                if (trigger.getAttribute('data-pf-bound') === 'true') return;
                trigger.setAttribute('data-pf-bound', 'true');

                trigger.addEventListener('click', function (e) {
                    e.preventDefault();

                    var triggerCard = trigger.closest('[data-theme], .gallery-admin-card, .gallery-item-card');
                    var triggerThemeKey = trigger.getAttribute('data-pf-theme-key') || 
                                          (triggerCard ? triggerCard.getAttribute('data-theme') : '') || '';
                    var galleryGroup = trigger.getAttribute('data-gallery') || '';

                    // Active theme filter if running in admin or dynamic theme page
                    var activeFilterTheme = '';
                    if (typeof window.currentActiveTheme !== 'undefined' && window.currentActiveTheme) {
                        activeFilterTheme = String(window.currentActiveTheme).toLowerCase().trim();
                    }

                    // Candidate pool: all triggers
                    var allTriggers = document.querySelectorAll('[data-pictureflect]');
                    var groupTriggers = [];

                    allTriggers.forEach(function (el) {
                        // 1. Check visibility: skip any element or parent card that is hidden by filter
                        var card = el.closest('[data-theme], .gallery-admin-card, .gallery-item-card');
                        if (card) {
                            if (card.style.display === 'none' || card.classList.contains('hidden') || card.offsetParent === null) {
                                return;
                            }
                        } else if (el.style.display === 'none' || el.classList.contains('hidden') || el.offsetParent === null) {
                            return;
                        }

                        // 2. Theme-wise grouping:
                        var elThemeKey = (el.getAttribute('data-pf-theme-key') || (card ? card.getAttribute('data-theme') : '') || '').toLowerCase().trim();

                        if (activeFilterTheme && activeFilterTheme !== 'everything') {
                            if (activeFilterTheme === 'all') {
                                if (elThemeKey !== 'all') return;
                            } else {
                                if (elThemeKey !== activeFilterTheme && elThemeKey !== 'all') return;
                            }
                        } else if (triggerThemeKey && triggerThemeKey !== 'all') {
                            if (elThemeKey && elThemeKey !== 'all' && elThemeKey !== triggerThemeKey) {
                                return;
                            }
                        } else if (galleryGroup && galleryGroup !== 'default' && galleryGroup !== 'admin-galleries') {
                            var elGroup = el.getAttribute('data-gallery') || '';
                            if (elGroup && elGroup !== galleryGroup) {
                                return;
                            }
                        }

                        groupTriggers.push(el);
                    });

                    // Ensure at least clicked trigger is present if none matched
                    if (groupTriggers.length === 0 || groupTriggers.indexOf(trigger) === -1) {
                        groupTriggers = [trigger];
                    }

                    var items = [];
                    var clickedIndex = 0;

                    groupTriggers.forEach(function (el, idx) {
                        var src = el.getAttribute('data-src') || el.getAttribute('href') || (el.tagName === 'IMG' ? el.src : '');
                        var title = el.getAttribute('data-title') || el.getAttribute('title') || el.getAttribute('alt') || 'Photo';
                        var category = el.getAttribute('data-category') || 'Gallery';
                        var theme = el.getAttribute('data-pf-theme') || el.getAttribute('data-theme') || '';
                        var thumb = el.getAttribute('data-thumb') || src;

                        items.push({
                            src: src,
                            title: title,
                            category: category,
                            theme: theme,
                            thumb: thumb
                        });

                        if (el === trigger) {
                            clickedIndex = idx;
                        }
                    });

                    self.open(items, clickedIndex);
                });
            });
        },

        /**
         * Bind UI control and interaction events.
         */
        bindEvents: function () {
            var self = this;

            // Navigation
            this.el.prev.addEventListener('click', function () { self.prev(); });
            this.el.next.addEventListener('click', function () { self.next(); });

            // Close
            this.el.close.addEventListener('click', function () { self.close(); });

            // Zoom controls
            this.el.zoomIn.addEventListener('click', function () { self.setZoom(self.zoom * 1.25); });
            this.el.zoomOut.addEventListener('click', function () { self.setZoom(self.zoom / 1.25); });
            this.el.resetZoom.addEventListener('click', function () { self.resetTransform(); });
            this.el.zoomDisplay.addEventListener('click', function () {
                if (self.zoom !== 1) {
                    self.resetTransform();
                } else {
                    self.setZoom(2);
                }
            });

            // Rotations
            this.el.rotateRight.addEventListener('click', function () { self.rotate(90); });
            this.el.rotateLeft.addEventListener('click', function () { self.rotate(-90); });
            this.el.flipH.addEventListener('click', function () { self.toggleFlip(); });

            // Slideshow
            this.el.slideshow.addEventListener('click', function () { self.toggleSlideshow(); });

            // Inspector
            this.el.inspectorBtn.addEventListener('click', function () { self.toggleInspector(); });
            this.el.inspectorClose.addEventListener('click', function () { self.toggleInspector(false); });

            // Fullscreen
            this.el.fullscreen.addEventListener('click', function () { self.toggleFullscreen(); });

            // Thumbnails Drawer Toggle
            this.el.toggleThumbs.addEventListener('click', function () {
                self.isThumbsCollapsed = !self.isThumbsCollapsed;
                self.el.bottomBar.classList.toggle('pf-collapsed', self.isThumbsCollapsed);
                self.el.thumbToggleIcon.textContent = self.isThumbsCollapsed ? '▲' : '▼';
            });

            // Stage Double Click Zoom
            this.el.stage.addEventListener('dblclick', function (e) {
                if (e.target === self.el.prev || e.target === self.el.next || self.el.inspector.contains(e.target)) return;
                if (self.zoom !== 1) {
                    self.resetTransform();
                } else {
                    self.setZoom(2);
                }
            });

            // Mouse Wheel Zoom
            this.el.stage.addEventListener('wheel', function (e) {
                e.preventDefault();
                var delta = e.deltaY > 0 ? 0.85 : 1.15;
                self.setZoom(self.zoom * delta);
            }, { passive: false });

            // Drag to Pan when zoomed
            this.el.stage.addEventListener('mousedown', function (e) {
                if (self.zoom <= 1) return;
                if (e.target === self.el.prev || e.target === self.el.next || self.el.inspector.contains(e.target)) return;
                self.isPanning = true;
                self.startX = e.clientX - self.panX;
                self.startY = e.clientY - self.panY;
                self.el.wrapper.classList.add('pf-panning');
            });

            window.addEventListener('mousemove', function (e) {
                if (!self.isPanning) return;
                self.panX = e.clientX - self.startX;
                self.panY = e.clientY - self.startY;
                self.applyTransform();
            });

            window.addEventListener('mouseup', function () {
                if (self.isPanning) {
                    self.isPanning = false;
                    self.el.wrapper.classList.remove('pf-panning');
                }
            });

            // Keyboard navigation
            window.addEventListener('keydown', function (e) {
                if (!self.isOpen) return;

                switch (e.key) {
                    case 'Escape':
                        self.close();
                        break;
                    case 'ArrowLeft':
                    case 'a':
                    case 'A':
                        self.prev();
                        break;
                    case 'ArrowRight':
                    case 'd':
                    case 'D':
                        self.next();
                        break;
                    case ' ':
                        e.preventDefault();
                        self.toggleSlideshow();
                        break;
                    case '+':
                    case '=':
                        self.setZoom(self.zoom * 1.25);
                        break;
                    case '-':
                    case '_':
                        self.setZoom(self.zoom / 1.25);
                        break;
                    case '0':
                        self.resetTransform();
                        break;
                    case 'r':
                    case 'R':
                        self.rotate(e.shiftKey ? -90 : 90);
                        break;
                    case 'f':
                    case 'F':
                        self.toggleFullscreen();
                        break;
                    case 'i':
                    case 'I':
                        self.toggleInspector();
                        break;
                    case 't':
                    case 'T':
                        self.el.toggleThumbs.click();
                        break;
                }
            });

            // Touch Swipe Support
            var touchStartX = 0;
            var touchStartY = 0;
            this.el.stage.addEventListener('touchstart', function (e) {
                if (e.touches.length === 1) {
                    touchStartX = e.touches[0].clientX;
                    touchStartY = e.touches[0].clientY;
                }
            }, { passive: true });

            this.el.stage.addEventListener('touchend', function (e) {
                if (self.zoom > 1) return;
                if (e.changedTouches.length === 1) {
                    var diffX = e.changedTouches[0].clientX - touchStartX;
                    var diffY = e.changedTouches[0].clientY - touchStartY;
                    if (Math.abs(diffX) > 50 && Math.abs(diffY) < 60) {
                        if (diffX < 0) {
                            self.next();
                        } else {
                            self.prev();
                        }
                    }
                }
            }, { passive: true });
        },

        /**
         * Open the Pictureflect Photo Viewer.
         */
        open: function (items, index) {
            if (!items || items.length === 0) return;
            this.items = items;
            this.currentIndex = typeof index === 'number' && index >= 0 && index < items.length ? index : 0;
            this.isOpen = true;

            if (this.items.length <= 1) {
                if (this.el.prev) this.el.prev.style.display = 'none';
                if (this.el.next) this.el.next.style.display = 'none';
            } else {
                if (this.el.prev) this.el.prev.style.display = 'flex';
                if (this.el.next) this.el.next.style.display = 'flex';
            }

            this.el.viewer.classList.add('pf-active');
            if (document.documentElement) document.documentElement.style.overflow = 'hidden';
            if (document.body) document.body.style.overflow = 'hidden';

            this.renderThumbnails();
            this.loadImage(this.currentIndex);
        },

        /**
         * Close the viewer.
         */
        close: function () {
            this.isOpen = false;
            this.stopSlideshow();
            this.toggleInspector(false);
            this.el.viewer.classList.remove('pf-active');
            if (document.documentElement) document.documentElement.style.overflow = '';
            if (document.body) document.body.style.overflow = '';
            if (document.fullscreenElement) {
                document.exitFullscreen().catch(function () {});
            }
        },

        /**
         * Load photo at given index.
         */
        loadImage: function (index) {
            var self = this;
            if (index < 0) index = this.items.length - 1;
            if (index >= this.items.length) index = 0;
            this.currentIndex = index;

            var item = this.items[index];
            this.resetTransform();

            // Update Header & Ambient Glow
            this.el.title.textContent = item.title || 'Untitled Photo';
            this.el.category.textContent = item.category || 'General';
            this.el.counter.textContent = (index + 1) + ' / ' + this.items.length;
            this.el.glow.style.backgroundImage = 'url("' + item.src + '")';

            // Show Spinner
            this.el.spinner.style.display = 'block';
            this.el.image.style.opacity = '0.3';

            var preloader = new Image();
            preloader.onload = function () {
                self.el.spinner.style.display = 'none';
                self.el.image.src = item.src;
                self.el.image.style.opacity = '1';
                self.updateInspector(item, preloader.naturalWidth, preloader.naturalHeight);
            };
            preloader.onerror = function () {
                self.el.spinner.style.display = 'none';
                self.el.image.src = item.src;
                self.el.image.style.opacity = '1';
            };
            preloader.src = item.src;

            this.updateActiveThumbnail();
        },

        next: function () {
            this.loadImage(this.currentIndex + 1);
        },

        prev: function () {
            this.loadImage(this.currentIndex - 1);
        },

        /**
         * Zoom management.
         */
        setZoom: function (level) {
            // Constrain zoom between 0.3x and 5x
            this.zoom = Math.max(0.3, Math.min(5, level));
            if (this.zoom <= 1) {
                this.panX = 0;
                this.panY = 0;
            }
            this.applyTransform();
        },

        rotate: function (deg) {
            this.rotation = (this.rotation + deg) % 360;
            this.applyTransform();
        },

        toggleFlip: function () {
            this.flipH = this.flipH === 1 ? -1 : 1;
            this.applyTransform();
        },

        resetTransform: function () {
            this.zoom = 1;
            this.rotation = 0;
            this.flipH = 1;
            this.panX = 0;
            this.panY = 0;
            this.applyTransform();
        },

        applyTransform: function () {
            var transform = 'translate(' + this.panX + 'px, ' + this.panY + 'px) ' +
                            'scale(' + this.zoom + ') ' +
                            'rotate(' + this.rotation + 'deg) ' +
                            'scaleX(' + this.flipH + ')';
            this.el.wrapper.style.transform = transform;
            var pct = Math.round(this.zoom * 100) + '%';
            this.el.zoomDisplay.textContent = pct;
            if (this.el.inspZoom) {
                this.el.inspZoom.textContent = pct + (this.rotation !== 0 ? ' (' + this.rotation + '°)' : '');
            }
        },

        /**
         * Slideshow engine.
         */
        toggleSlideshow: function () {
            if (this.slideshowTimer) {
                this.stopSlideshow();
            } else {
                this.startSlideshow();
            }
        },

        startSlideshow: function () {
            var self = this;
            this.el.slideshow.classList.add('pf-active-state');
            this.el.playIcon.innerHTML = '<rect x="6" y="4" width="4" height="16"></rect><rect x="14" y="4" width="4" height="16"></rect>';
            this.slideshowTimer = setInterval(function () {
                self.next();
            }, this.slideshowInterval);
        },

        stopSlideshow: function () {
            if (this.slideshowTimer) {
                clearInterval(this.slideshowTimer);
                this.slideshowTimer = null;
            }
            this.el.slideshow.classList.remove('pf-active-state');
            this.el.playIcon.innerHTML = '<polygon points="5 3 19 12 5 21 5 3"></polygon>';
        },

        /**
         * Inspector Details.
         */
        toggleInspector: function (forceState) {
            this.isInspectorOpen = typeof forceState === 'boolean' ? forceState : !this.isInspectorOpen;
            this.el.inspector.classList.toggle('pf-show', this.isInspectorOpen);
            this.el.inspectorBtn.classList.toggle('pf-active-state', this.isInspectorOpen);
        },

        updateInspector: function (item, naturalW, naturalH) {
            var filename = item.src ? item.src.split('/').pop().split('?')[0] : 'image.jpg';
            this.el.inspName.textContent = filename.length > 25 ? filename.substring(0, 22) + '...' : filename;
            this.el.inspCat.textContent = item.category || 'General';
            this.el.inspTheme.textContent = item.theme || 'Global (All)';
            this.el.inspRes.textContent = naturalW && naturalH ? naturalW + ' × ' + naturalH + ' px' : 'Dynamic';

            if (naturalW && naturalH) {
                var gcd = function (a, b) { return b ? gcd(b, a % b) : a; };
                var divisor = gcd(naturalW, naturalH);
                this.el.inspRatio.textContent = (naturalW / divisor) + ':' + (naturalH / divisor);
            } else {
                this.el.inspRatio.textContent = 'Auto';
            }
        },

        /**
         * Fullscreen toggle.
         */
        toggleFullscreen: function () {
            if (!document.fullscreenElement) {
                this.el.viewer.requestFullscreen().catch(function () {});
            } else {
                document.exitFullscreen().catch(function () {});
            }
        },

        /**
         * Render bottom thumbnail strip.
         */
        renderThumbnails: function () {
            var self = this;
            this.el.thumbsContainer.innerHTML = '';

            this.items.forEach(function (item, idx) {
                var thumb = document.createElement('div');
                thumb.className = 'pf-thumb-item' + (idx === self.currentIndex ? ' pf-thumb-active' : '');
                thumb.setAttribute('data-index', idx);
                thumb.title = (item.title || 'Photo') + ' (' + (item.category || '') + ')';
                thumb.innerHTML = '<img src="' + (item.thumb || item.src) + '" alt="" loading="lazy" />';

                thumb.addEventListener('click', function () {
                    self.loadImage(idx);
                });

                self.el.thumbsContainer.appendChild(thumb);
            });
        },

        updateActiveThumbnail: function () {
            var thumbs = this.el.thumbsContainer.querySelectorAll('.pf-thumb-item');
            var self = this;
            thumbs.forEach(function (thumb, idx) {
                if (idx === self.currentIndex) {
                    thumb.classList.add('pf-thumb-active');
                    thumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                } else {
                    thumb.classList.remove('pf-thumb-active');
                }
            });
        }
    };

    // Expose globally
    window.Pictureflect = Pictureflect;
    window.PictureflectViewer = Pictureflect;

    // Auto-init on DOM loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            Pictureflect.init();
        });
    } else {
        Pictureflect.init();
    }

})(window, document);

