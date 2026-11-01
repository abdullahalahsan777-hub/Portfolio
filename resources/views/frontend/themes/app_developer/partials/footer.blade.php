<!-- =========================================================================
     FOOTER SECTION (App Developer Theme)
     Consistent with developer & graphic designer themes: 5-column layout
     (Brand Logo with colored dot, Menu, Follow, Contact, About),
     floating back-to-top button, and bottom copyright sub-footer bar.
     ========================================================================= -->
<footer
    class="bg-[#070707] text-[#8c8c8c] pt-20 pb-10 border-t border-white/10 relative overflow-hidden font-['Plus_Jakarta_Sans']">

    <!-- Ambient Red Background Glow -->
    <div
        class="absolute bottom-0 right-1/4 w-[400px] h-[300px] bg-[#ff0033]/5 rounded-full blur-[140px] pointer-events-none">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Main Footer Row (5 Columns) -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-12 gap-10 border-b border-white/10 relative">

            <!-- Column 1 (3 cols): Brand Logo with red dot -->
            <div class="col-span-2 lg:col-span-3 space-y-4">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 group">
                    <div
                        class="w-8 h-8 rounded-lg bg-gradient-to-tr from-[#ff0033] to-[#ff2a4b] text-white flex items-center justify-center font-black text-sm shadow-md shadow-[#ff0033]/20 group-hover:scale-105 transition-transform">
                        ◈
                    </div>
                    <span class="text-2xl font-black tracking-tight text-white font-['Outfit'] lowercase">
                        {{ $settings['site_logo_text'] ?? 'alex' }}<span
                            class="text-[#ff0033] inline-block font-black text-3xl leading-none">.</span>
                    </span>
                </a>
                <p class="text-xs text-neutral-400 leading-relaxed max-w-xs">
                    Engineering scalable mobile app architectures, native iOS &amp; Android systems, sub-second backend
                    APIs, and modern digital platforms.
                </p>
                <div class="flex items-center gap-3 pt-2">
                    <a href="{{ $settings['social_github'] ?? 'https://github.com' }}" target="_blank"
                        class="w-8 h-8 rounded-full bg-[#121212] border border-white/10 text-neutral-400 hover:text-white hover:bg-[#ff0033] hover:border-[#ff0033] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                        title="GitHub">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z" />
                        </svg>
                    </a>
                    <a href="{{ $settings['social_linkedin'] ?? 'https://linkedin.com' }}" target="_blank"
                        class="w-8 h-8 rounded-full bg-[#121212] border border-white/10 text-neutral-400 hover:text-white hover:bg-[#ff0033] hover:border-[#ff0033] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                        title="LinkedIn">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                        </svg>
                    </a>
                    <a href="{{ $settings['social_twitter'] ?? 'https://twitter.com' }}" target="_blank"
                        class="w-8 h-8 rounded-full bg-[#121212] border border-white/10 text-neutral-400 hover:text-white hover:bg-[#ff0033] hover:border-[#ff0033] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                        title="Twitter / X">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                    </a>
                    <a href="{{ $settings['social_dribbble'] ?? 'https://dribbble.com' }}" target="_blank"
                        class="w-8 h-8 rounded-full bg-[#121212] border border-white/10 text-neutral-400 hover:text-white hover:bg-[#ff0033] hover:border-[#ff0033] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                        title="Dribbble">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm7.98 5.7c1.32 1.68 2.13 3.78 2.25 6.09-.54-.12-2.82-.57-5.46-.24-.09-.21-.18-.45-.27-.69-.72-1.74-1.53-3.39-2.28-4.71 2.76-.36 4.77-.45 5.76-.45zm-7.98-3.93c2.43 0 4.65.84 6.42 2.25-.9.03-2.79.12-5.4.45-.96-1.59-1.89-3.06-2.58-4.08 1.14-.39 2.37-.62 3.56-.62zm-5.76 1.83c.72.99 1.62 2.43 2.55 3.96-3.36 1.05-6.96 1.77-7.98 1.83 1.05-2.61 3.09-4.71 5.43-5.79zm-4.47 7.89c.75-.06 4.02-.72 7.23-1.68.21.48.42.96.6 1.47-2.7 1.05-5.58 3.57-7.29 5.85-.45-1.68-.69-3.48-.54-5.64zm2.13 7.56c1.5-1.98 4.05-4.26 6.54-5.25.96 2.52 1.47 5.16 1.68 6.78-2.64 1.2-5.61 1.02-8.22-1.53zm9.84.15c-.21-1.47-.69-3.87-1.56-6.27 2.4-.36 4.47.09 5.01.21-.6 2.64-2.07 4.89-4.08 6.27-.09-.09-.18-.15-.27-.21z" />
                        </svg>
                    </a>
                    <a href="{{ $settings['social_behance'] ?? 'https://behance.net' }}" target="_blank"
                        class="w-8 h-8 rounded-full bg-[#121212] border border-white/10 text-neutral-400 hover:text-white hover:bg-[#ff0033] hover:border-[#ff0033] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                        title="Behance">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M22 7h-7v-2h7v2zm1.726 10c-.442 1.297-2.029 3-4.971 3-3.467 0-5.834-2.544-5.834-5.917 0-3.468 2.457-6.083 5.763-6.083 3.42 0 5.474 2.518 5.474 6.083h-8.24c.063 1.782 1.341 3.076 2.977 3.076 1.408 0 2.277-.696 2.673-1.624l2.158 1.465zm-2.316-4.437c-.073-1.258-.87-2.42-2.463-2.42-1.542 0-2.378 1.118-2.543 2.42h5.006zm-13.41 7.437h-8v-16h8.217c2.68 0 4.783 1.354 4.783 3.864 0 1.552-.806 2.766-2.091 3.393 1.737.587 2.591 2.052 2.591 3.93 0 2.871-2.298 4.813-5.5 4.813zm-5-10h4.316c1.19 0 2.184-.57 2.184-1.636 0-1.137-.927-1.636-2.184-1.636h-4.316v3.272zm0 7h4.783c1.378 0 2.422-.658 2.422-1.892 0-1.282-1.077-1.975-2.422-1.975h-4.783v3.867z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Column 2 (2 cols): Menu -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs font-bold uppercase tracking-wider text-white font-['Outfit']">Menu</h4>
                <ul class="space-y-2.5 text-xs text-neutral-400">
                    <li><a href="{{ route('home') }}" class="hover:text-[#ff0033] transition-colors">Home</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-[#ff0033] transition-colors">About</a></li>
                    <li><a href="{{ route('portfolio') }}" class="hover:text-[#ff0033] transition-colors">Portfolio</a>
                    </li>
                    <li><a href="{{ route('blog') }}" class="hover:text-[#ff0033] transition-colors">Blog</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-[#ff0033] transition-colors">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-[#ff0033] transition-colors">Contact</a>
                    </li>
                </ul>
            </div>

            <!-- Column 3 (2 cols): Follow -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs font-bold uppercase tracking-wider text-white font-['Outfit']">Follow</h4>
                <ul class="space-y-2.5 text-xs text-neutral-400">
                    @if (!empty($settings['social_facebook']))
                        <li><a href="{{ $settings['social_facebook'] }}" target="_blank"
                                class="hover:text-[#ff0033] transition-colors">Facebook</a></li>
                    @endif
                    @if (!empty($settings['social_instagram']))
                        <li><a href="{{ $settings['social_instagram'] }}" target="_blank"
                                class="hover:text-[#ff0033] transition-colors">Instagram</a></li>
                    @endif
                    @if (!empty($settings['social_linkedin']))
                        <li><a href="{{ $settings['social_linkedin'] }}" target="_blank"
                                class="hover:text-[#ff0033] transition-colors">LinkedIn</a></li>
                    @endif
                    @if (!empty($settings['social_pinterest']))
                        <li><a href="{{ $settings['social_pinterest'] }}" target="_blank"
                                class="hover:text-[#ff0033] transition-colors">Pinterest</a></li>
                    @endif
                    @if (!empty($settings['social_tiktok']))
                        <li><a href="{{ $settings['social_tiktok'] }}" target="_blank"
                                class="hover:text-[#ff0033] transition-colors">TikTok</a></li>
                    @endif
                    @if (!empty($settings['social_youtube']))
                        <li><a href="{{ $settings['social_youtube'] }}" target="_blank"
                                class="hover:text-[#ff0033] transition-colors">YouTube</a></li>
                    @endif
                    @if (!empty($settings['social_twitter']))
                        <li><a href="{{ $settings['social_twitter'] }}" target="_blank"
                                class="hover:text-[#ff0033] transition-colors">Twitter / X</a></li>
                    @endif
                    @if (!empty($settings['social_github']))
                        <li><a href="{{ $settings['social_github'] }}" target="_blank"
                                class="hover:text-[#ff0033] transition-colors">GitHub</a></li>
                    @endif
                    @if (!empty($settings['social_dribbble']))
                        <li><a href="{{ $settings['social_dribbble'] }}" target="_blank"
                                class="hover:text-[#ff0033] transition-colors">Dribbble</a></li>
                    @endif
                </ul>
            </div>

            <!-- Column 4 & 5 (5 cols): Contact, About & Newsletter -->
            <div class="col-span-2 md:col-span-3 lg:col-span-5 space-y-6">
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-6">
                    <!-- Contact (2 cols) -->
                    <div class="sm:col-span-2 space-y-4">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-white font-['Outfit']">Contact</h4>
                        <div class="space-y-2.5 text-xs leading-relaxed text-neutral-400">
                            <p>{!! $settings['contact_location'] ?? '742 Market Street,<br>San Francisco, CA' !!}</p>
                            <p><a href="tel:{{ $settings['contact_phone'] ?? '+15553829012' }}"
                                    class="text-[#ff0033] hover:underline font-mono">{{ $settings['contact_phone'] ?? '+1 (555) 382-9012' }}</a>
                            </p>
                            <p><a href="mailto:{{ $settings['contact_email'] ?? 'hello@portfolio.me' }}"
                                    class="text-white border-b border-dotted border-white/40 pb-0.5 hover:text-[#ff0033] hover:border-[#ff0033] transition-colors">{{ $settings['contact_email'] ?? 'hello@portfolio.me' }}</a>
                            </p>
                        </div>
                    </div>

                    <!-- About (3 cols) -->
                    <div class="sm:col-span-3 space-y-4">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-white font-['Outfit']">About</h4>
                        <p class="text-xs text-neutral-400 leading-relaxed">
                            Lead Mobile &amp; App Architect dedicated to building high-performance iOS, Android, and
                            cross-platform systems with scalable cloud backends.
                        </p>
                    </div>
                </div>

                <!-- Newsletter (Under Contact & About with subscriber count) -->
                @include('frontend.partials.newsletter', [
                    'accent' => '#ff0033',
                    'btnText' => 'text-white',
                    'inputBg' => 'bg-[#121212]',
                    'borderColor' => 'border-white/10',
                ])
            </div>

            <!-- Floating Back to Top Button (Smooth scroll to website main menu header) -->
            <a href="#mainContent" id="backToTopBtn"
                onclick="
                    event.preventDefault(); 
                    const target = document.getElementById('mainContent') || document.getElementById('mainHeader'); 
                    if (target) { target.scrollIntoView({ behavior: 'smooth', block: 'start' }); } 
                    else { window.scrollTo({ top: 0, behavior: 'smooth' }); }
                "
                class="fixed right-4 sm:right-6 md:right-10 bottom-4 sm:bottom-6 md:bottom-10 w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-[#141414] hover:bg-[#ff0033] text-[#ff0033] hover:text-white border border-white/10 flex items-center justify-center transition-all duration-300 hover:-translate-y-1 shadow-2xl shadow-black/80 cursor-pointer z-50 opacity-0 invisible translate-y-4 pointer-events-none"
                title="Back to top" aria-label="Back to top of main menu">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" />
                </svg>
            </a>

            <!-- Scroll Listener to Show on Scroll & Auto-Hide when Scrolling Stops -->
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

                            if (scrollTimeout) {
                                clearTimeout(scrollTimeout);
                            }

                            // Auto-hide button when scrolling stops
                            scrollTimeout = setTimeout(function() {
                                if (!isHovered) {
                                    hideBtn();
                                }
                            }, 1800);
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
        </div>

        <!-- Bottom Copyright Sub-Footer -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-neutral-500 gap-4">
            <div>
                &copy; {{ date('Y') }} {{ $settings['site_title'] ?? 'Alex Rivera' }} / All rights reserved
            </div>
            <div>
                Built for <span class="text-[#ff0033] font-bold">App Developers</span> &amp; Modern Mobile Engineers
            </div>
        </div>

    </div>
</footer>
