<!-- =========================================================================
     FOOTER SECTION (Full-Stack Laravel Developer Theme)
     Matching the modern 5-column design from App Developer:
     Column 1: Brand Logo with accent dot, Bio, and 5 Social circular icon buttons
     Column 2: MENU (Home, About, Portfolio, Blog, FAQ, Contact)
     Column 3: FOLLOW (Facebook, Instagram, Pinterest, TikTok, YouTube)
     Column 4: CONTACT (Location, Phone, Email)
     Column 5: ABOUT (Bio snippet)
     Newsletter Subscription Card
     Floating Back-To-Top button
     Bottom Sub-Footer copyright bar
     ========================================================================= -->
<style>
    /* Footer Social Buttons: High contrast hover, crisp white default, and immunity to browser visited link discoloration */
    .footer-social-btn {
        background-color: #121212 !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        color: #ffffff !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .footer-social-btn svg {
        fill: #ffffff !important;
        color: #ffffff !important;
        transition: fill 0.25s ease, color 0.25s ease, transform 0.25s ease !important;
    }

    /* Prevent visited links from turning into browser default purple */
    .footer-social-btn:visited {
        background-color: #121212 !important;
        border-color: rgba(255, 255, 255, 0.12) !important;
        color: #ffffff !important;
    }

    .footer-social-btn:visited svg {
        fill: #ffffff !important;
        color: #ffffff !important;
    }

    /* Active hover state: dynamic high-contrast icon against active accent background */
    .footer-social-btn:hover,
    .footer-social-btn:visited:hover {
        background-color: var(--theme-primary) !important;
        border-color: var(--theme-primary) !important;
        color: var(--theme-on-primary, #000000) !important;
        transform: scale(1.12) !important;
        box-shadow: 0 4px 16px var(--theme-primary-glow, rgba(0, 229, 255, 0.35)) !important;
    }

    .footer-social-btn:hover svg,
    .footer-social-btn:visited:hover svg {
        fill: var(--theme-on-primary, #000000) !important;
        color: var(--theme-on-primary, #000000) !important;
    }

    /* Footer text links (Menu & Follow) visited protection */
    .footer-nav-link,
    .footer-nav-link:visited {
        color: #a3a3a3 !important;
        transition: color 0.2s ease !important;
    }

    .footer-nav-link:hover,
    .footer-nav-link:visited:hover {
        color: var(--theme-primary) !important;
    }

    /* Back To Top Button High Contrast Hover */
    #backToTopBtn:hover {
        background-color: var(--theme-primary) !important;
        border-color: var(--theme-primary) !important;
        color: var(--theme-on-primary, #000000) !important;
    }

    #backToTopBtn:hover svg {
        color: var(--theme-on-primary, #000000) !important;
        stroke: var(--theme-on-primary, #000000) !important;
    }
</style>

<footer
    class="bg-[#070707] text-[#8c8c8c] pt-20 pb-10 border-t border-white/10 relative overflow-hidden font-['Plus_Jakarta_Sans']">

    <!-- Ambient Glow -->
    <div
        class="absolute bottom-0 right-1/4 w-[400px] h-[300px] bg-[var(--theme-primary)]/5 rounded-full blur-[140px] pointer-events-none">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Main Footer Row (5 Columns) -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-12 gap-10 pb-2 border-b border-white/10 relative">

            <!-- Column 1 (3 cols): Brand Logo with accent dot & social icons -->
            <div class="col-span-2 lg:col-span-3 space-y-4">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 group">
                    <div
                        class="w-8 h-8 rounded-lg bg-gradient-to-tr from-[var(--theme-primary)] to-blue-600 text-black font-black flex items-center justify-center text-sm shadow-md shadow-[var(--theme-primary)]/20 group-hover:scale-105 transition-transform">
                        ◈
                    </div>
                    <span class="text-2xl font-black tracking-tight text-white font-['Outfit'] lowercase">
                        abdullah ahsan<span
                            class="text-[var(--theme-primary)] inline-block font-black text-3xl leading-none">.</span>
                    </span>
                </a>
                <p class="text-xs text-neutral-400 leading-relaxed max-w-xs">
                    Engineering scalable full-stack Laravel architectures, mission-critical ERP &amp; POS systems,
                    sub-second backend APIs, and modern digital platforms.
                </p>

                <!-- Social Circle Icon Buttons (Boxed in red in image 2) -->
                <div class="flex items-center gap-3 pt-2">
                    <!-- GitHub -->
                    <a href="{{ $settings['social_github'] ?? 'https://github.com' }}" target="_blank"
                        rel="noopener noreferrer"
                        class="footer-social-btn w-8 h-8 rounded-full flex items-center justify-center shadow-sm"
                        title="GitHub" aria-label="GitHub">
                        <svg class="w-3.5 h-3.5 pointer-events-none" viewBox="0 0 24 24">
                            <path
                                d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z" />
                        </svg>
                    </a>

                    <!-- LinkedIn -->
                    <a href="{{ $settings['social_linkedin'] ?? 'https://linkedin.com' }}" target="_blank"
                        rel="noopener noreferrer"
                        class="footer-social-btn w-8 h-8 rounded-full flex items-center justify-center shadow-sm"
                        title="LinkedIn" aria-label="LinkedIn">
                        <svg class="w-3.5 h-3.5 pointer-events-none" viewBox="0 0 24 24">
                            <path
                                d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                        </svg>
                    </a>

                    <!-- X / Twitter -->
                    <a href="{{ $settings['social_twitter'] ?? 'https://twitter.com' }}" target="_blank"
                        rel="noopener noreferrer"
                        class="footer-social-btn w-8 h-8 rounded-full flex items-center justify-center shadow-sm"
                        title="Twitter / X" aria-label="Twitter / X">
                        <svg class="w-3.5 h-3.5 pointer-events-none" viewBox="0 0 24 24">
                            <path
                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                    </a>

                    <!-- Web / Globe -->
                    <a href="https://abdullah.dev" target="_blank" rel="noopener noreferrer"
                        class="footer-social-btn w-8 h-8 rounded-full flex items-center justify-center shadow-sm"
                        title="Personal Website" aria-label="Personal Website">
                        <svg class="w-3.5 h-3.5 pointer-events-none" viewBox="0 0 24 24">
                            <path
                                d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm1 2.06c4.54.49 8.16 4.11 8.65 8.65h-3.69c-.31-3.23-1.63-6.15-4.96-8.65zm-2 0c-3.33 2.5-4.65 5.42-4.96 8.65H2.35C2.84 6.17 6.46 2.55 11 2.06zM2.06 13h3.69c.31 3.23 1.63 6.15 4.96 8.65-4.54-.49-8.16-4.11-8.65-8.65zm10.94 8.94c3.33-2.5 4.65-5.42 4.96-8.65h3.69c-.49 4.54-4.11 8.16-8.65 8.65zM12 4.09c1.9 2.2 2.94 4.86 3.09 7.91H8.91C9.06 8.95 10.1 6.29 12 4.09zm-3.09 9.91h6.18c-.15 3.05-1.19 5.71-3.09 7.91-1.9-2.2-2.94-4.86-3.09-7.91z" />
                        </svg>
                    </a>

                    <!-- Behance / Dribbble -->
                    <a href="{{ $settings['social_behance'] ?? 'https://behance.net' }}" target="_blank"
                        rel="noopener noreferrer"
                        class="footer-social-btn w-8 h-8 rounded-full flex items-center justify-center shadow-sm"
                        title="Portfolio Profiles" aria-label="Portfolio Profiles">
                        <svg class="w-3.5 h-3.5 pointer-events-none" viewBox="0 0 24 24">
                            <path
                                d="M22 7h-7v-2h7v2zm1.726 10c-.442 1.297-2.029 3-4.971 3-3.467 0-5.834-2.544-5.834-5.917 0-3.468 2.457-6.083 5.763-6.083 3.42 0 5.474 2.518 5.474 6.083h-8.24c.063 1.782 1.341 3.076 2.977 3.076 1.408 0 2.277-.696 2.673-1.624l2.158 1.465zm-2.316-4.437c-.073-1.258-.87-2.42-2.463-2.42-1.542 0-2.378 1.118-2.543 2.42h5.006zm-13.41 7.437h-8v-16h8.217c2.68 0 4.783 1.354 4.783 3.864 0 1.552-.806 2.766-2.091 3.393 1.737.587 2.591 2.052 2.591 3.93 0 2.871-2.298 4.813-5.5 4.813zm-5-10h4.316c1.19 0 2.184-.57 2.184-1.636 0-1.137-.927-1.636-2.184-1.636h-4.316v3.272zm0 7h4.783c1.378 0 2.422-.658 2.422-1.892 0-1.282-1.077-1.975-2.422-1.975h-4.783v3.867z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Column 2 (2 cols): MENU (Boxed in red in image 2) -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs font-bold uppercase tracking-wider text-white font-['Outfit']">MENU</h4>
                <ul class="space-y-2.5 text-xs text-neutral-400">
                    <li>
                        <a href="{{ route('home') }}" class="footer-nav-link">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="footer-nav-link">
                            About
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('portfolio') }}" class="footer-nav-link">
                            Portfolio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog') }}" class="footer-nav-link">
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('faq') }}" class="footer-nav-link">
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="footer-nav-link">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 3 (2 cols): FOLLOW (Boxed in red in image 2) -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs font-bold uppercase tracking-wider text-white font-['Outfit']">FOLLOW</h4>
                <ul class="space-y-2.5 text-xs text-neutral-400">
                    <li>
                        <a href="{{ $settings['social_facebook'] ?? 'https://facebook.com' }}" target="_blank"
                            rel="noopener noreferrer" class="footer-nav-link">
                            Facebook
                        </a>
                    </li>
                    <li>
                        <a href="{{ $settings['social_instagram'] ?? 'https://instagram.com' }}" target="_blank"
                            rel="noopener noreferrer" class="footer-nav-link">
                            Instagram
                        </a>
                    </li>
                    <li>
                        <a href="{{ $settings['social_pinterest'] ?? 'https://pinterest.com' }}" target="_blank"
                            rel="noopener noreferrer" class="footer-nav-link">
                            Pinterest
                        </a>
                    </li>
                    <li>
                        <a href="{{ $settings['social_tiktok'] ?? 'https://tiktok.com' }}" target="_blank"
                            rel="noopener noreferrer" class="footer-nav-link">
                            TikTok
                        </a>
                    </li>
                    <li>
                        <a href="{{ $settings['social_youtube'] ?? 'https://youtube.com' }}" target="_blank"
                            rel="noopener noreferrer" class="footer-nav-link">
                            YouTube
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 4 & 5 (5 cols): CONTACT, ABOUT & NEWSLETTER -->
            <div class="col-span-2 md:col-span-3 lg:col-span-5 space-y-6">
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-6">
                    <!-- Contact (2 cols) -->
                    <div class="sm:col-span-2 space-y-4">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-white font-['Outfit']">CONTACT</h4>
                        <div class="space-y-2.5 text-xs leading-relaxed text-neutral-400">
                            <p>
                                {!! $settings['contact_location'] ?? 'Sherpur Town,<br>Bangladesh' !!}
                            </p>
                            <p>
                                <a href="tel:{{ $settings['contact_phone'] ?? '+8801718926673' }}"
                                    class="text-[var(--theme-primary)] hover:underline font-mono">
                                    {{ $settings['contact_phone'] ?? '+8801718926673' }}
                                </a>
                            </p>
                            <p>
                                <a href="mailto:{{ $settings['contact_email'] ?? 'abdullahalahsan@hotmail.com' }}"
                                    class="text-white border-b border-dotted border-white/40 pb-0.5 hover:text-[var(--theme-primary)] hover:border-[var(--theme-primary)] transition-colors break-all">
                                    {{ $settings['contact_email'] ?? 'abdullahalahsan@hotmail.com' }}
                                </a>
                            </p>
                        </div>
                    </div>

                    <!-- About (3 cols) -->
                    <div class="sm:col-span-3 space-y-4">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-white font-['Outfit']">ABOUT</h4>
                        <p class="text-xs text-neutral-400 leading-relaxed">
                            Full-Stack Laravel Architect dedicated to building high-performance ERP, POS, and
                            cross-platform systems with scalable cloud backends.
                        </p>
                    </div>
                </div>

                <!-- Newsletter Card (Under Contact & About) -->
                @include('frontend.partials.newsletter', [
                    'accent' => 'var(--theme-primary)',
                    'btnText' => 'text-black font-bold',
                    'inputBg' => 'bg-[#121212]',
                    'borderColor' => 'border-white/10',
                ])
            </div>

            <!-- Floating Back to Top Button (Smooth scroll to top) -->
            <a href="#mainHeader" id="backToTopBtn"
                onclick="
                    event.preventDefault();
                    const target = document.getElementById('mainHeader') || document.body;
                    if (target) { target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
                    else { window.scrollTo({ top: 0, behavior: 'smooth' }); }
                "
                class="fixed right-4 sm:right-6 md:right-10 bottom-4 sm:bottom-6 md:bottom-10 w-11 h-11
                       sm:w-12 sm:h-12 rounded-xl bg-[#141414] hover:bg-[var(--theme-primary)] text-[var(--theme-primary)]
                       hover:text-black border border-white/10 flex items-center justify-center transition-all duration-300
                       hover:-translate-y-1 shadow-2xl shadow-black/80 cursor-pointer z-50 opacity-0 invisible translate-y-4
                       pointer-events-none"
                title="Back to top" aria-label="Back to top">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" />
                </svg>
            </a>
        </div>

        <!-- Bottom Copyright Sub-Footer Bar (Matching Image 2) -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-neutral-500 gap-4">
            <div>
                &copy; {{ date('Y') }} Abdullah Al Ahsan / All rights reserved
            </div>
            <div>
                Built for <span class="text-[var(--theme-primary)] font-bold">Full-Stack Laravel Developers</span>
                &amp; Modern System Architects
            </div>
        </div>

    </div>
</footer>

<!-- Scroll Listener for Back to Top Button -->
<script>
    (function() {
        const btn = document.getElementById('backToTopBtn');
        if (!btn) return;

        let scrollTimeout = null;
        let isHovered = false;

        function showBtn() {
            btn.classList.remove('opacity-0', 'invisible', 'translate-y-4', 'pointer-events-none');
            btn.classList.add('opacity-100', 'visible', 'translate-y-0', 'pointer-events-auto');
        }

        function hideBtn() {
            btn.classList.remove('opacity-100', 'visible', 'translate-y-0', 'pointer-events-auto');
            btn.classList.add('opacity-0', 'invisible', 'translate-y-4', 'pointer-events-none');
        }

        function onScroll() {
            if (window.scrollY > 250) {
                showBtn();
                if (scrollTimeout) clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(function() {
                    if (!isHovered) hideBtn();
                }, 2000);
            } else {
                if (scrollTimeout) clearTimeout(scrollTimeout);
                hideBtn();
            }
        }

        btn.addEventListener('mouseenter', function() {
            isHovered = true;
            if (scrollTimeout) clearTimeout(scrollTimeout);
        });

        btn.addEventListener('mouseleave', function() {
            isHovered = false;
            if (window.scrollY > 250) {
                scrollTimeout = setTimeout(hideBtn, 1500);
            } else {
                hideBtn();
            }
        });

        window.addEventListener('scroll', onScroll, {
            passive: true
        });
    })();
</script>
