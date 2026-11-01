<!-- =========================================================================
     FOOTER SECTION (Graphic Designer Theme)
     Matches design image: Logo with colored dot, 4-column menu/links/contact/about,
     floating back-to-top button, and copyright bar.
     ========================================================================= -->
<footer
    class="bg-[#090714] text-[#948ba8] pt-20 pb-10 border-t border-[#a855f7]/15 relative overflow-hidden font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Main Footer Row (5 Columns) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-16 border-b border-white/5 relative">

            <!-- Column 1 (3 cols): Brand Logo -->
            <div class="lg:col-span-3 space-y-4">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1 group">
                    <span
                        class="text-3xl font-black tracking-tight text-white font-['Outfit'] lowercase">{{ $settings['footer_logo_text'] ?? ($settings['site_logo_text'] ?? 'ahsan') }}<span
                            class="text-[#a855f7] inline-block font-black text-4xl leading-none">.</span></span>
                </a>
                <p class="text-xs text-[#8a80a2] leading-relaxed max-w-xs">
                    {{ $settings['footer_bio'] ?? 'Crafting intuitive digital experiences, brand identity systems, and human-centered design for ambitious brands.' }}
                </p>
            </div>

            <!-- Column 2 (2 cols): Menu -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-sm font-bold text-white tracking-wide font-['Outfit']">Menu</h4>
                <ul class="space-y-2.5 text-xs">
                    <li><a href="{{ route('about') }}"
                            class="hover:text-[#7c3aed] dark:hover:text-[#c084fc] transition-colors">About</a></li>
                    <li><a href="{{ route('portfolio') }}"
                            class="hover:text-[#7c3aed] dark:hover:text-[#c084fc] transition-colors">Portfolio</a></li>
                    <li><a href="{{ route('blog') }}"
                            class="hover:text-[#7c3aed] dark:hover:text-[#c084fc] transition-colors">Blog</a></li>
                    <li><a href="{{ route('faq') }}"
                            class="hover:text-[#7c3aed] dark:hover:text-[#c084fc] transition-colors">FAQ</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="hover:text-[#7c3aed] dark:hover:text-[#c084fc] transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Column 3 (2 cols): Follow -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-sm font-bold text-white tracking-wide font-['Outfit']">Follow</h4>
                <ul class="space-y-2.5 text-xs">
                    <li><a href="{{ $settings['social_facebook'] ?? '#' }}" target="_blank"
                            class="hover:text-[#7c3aed] dark:hover:text-[#c084fc] transition-colors">Facebook</a></li>
                    <li><a href="{{ $settings['social_instagram'] ?? '#' }}" target="_blank"
                            class="hover:text-[#7c3aed] dark:hover:text-[#c084fc] transition-colors">Instagram</a></li>
                    <li><a href="{{ $settings['social_pinterest'] ?? '#' }}" target="_blank"
                            class="hover:text-[#7c3aed] dark:hover:text-[#c084fc] transition-colors">Pinterest</a></li>
                    <li><a href="{{ $settings['social_tiktok'] ?? '#' }}" target="_blank"
                            class="hover:text-[#7c3aed] dark:hover:text-[#c084fc] transition-colors">TikTok</a></li>
                    <li><a href="{{ $settings['social_youtube'] ?? '#' }}" target="_blank"
                            class="hover:text-[#7c3aed] dark:hover:text-[#c084fc] transition-colors">YouTube</a></li>
                    @if (!empty($settings['social_linkedin']))
                        <li><a href="{{ $settings['social_linkedin'] }}" target="_blank"
                                class="hover:text-[#7c3aed] dark:hover:text-[#c084fc] transition-colors">LinkedIn</a>
                        </li>
                    @endif
                    @if (!empty($settings['social_twitter']))
                        <li><a href="{{ $settings['social_twitter'] }}" target="_blank"
                                class="hover:text-[#7c3aed] dark:hover:text-[#c084fc] transition-colors">Twitter / X</a>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- Column 4 & 5 (5 cols): Contact, About & Newsletter -->
            <div class="lg:col-span-5 space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-5 gap-6">
                    <!-- Contact (2 cols) -->
                    <div class="sm:col-span-2 space-y-4">
                        <h4 class="text-sm font-bold text-white tracking-wide font-['Outfit']">Contact</h4>
                        <div class="space-y-2.5 text-xs leading-relaxed">
                            <p class="text-[#a59cc0]">{!! nl2br(
                                e($settings['footer_address'] ?? ($settings['contact_location'] ?? "121 King Street,\nMelbourne, Australia")),
                            ) !!}</p>
                            <p><a href="tel:{{ $settings['footer_phone'] ?? ($settings['contact_phone'] ?? '+1-234-567-8901') }}"
                                    class="text-[#c084fc] hover:underline">{{ $settings['footer_phone'] ?? ($settings['contact_phone'] ?? '+1-234-567-8901') }}</a>
                            </p>
                            <p><a href="mailto:{{ $settings['footer_email'] ?? ($settings['contact_email'] ?? 'contact@william.design') }}"
                                    class="text-slate-300 hover:text-white border-b border-dotted border-white/40 pb-0.5">{{ $settings['footer_email'] ?? ($settings['contact_email'] ?? 'contact@william.design') }}</a>
                            </p>
                        </div>
                    </div>

                    <!-- About Paragraph (3 cols) -->
                    <div class="sm:col-span-3 space-y-4">
                        <h4 class="text-sm font-bold text-white tracking-wide font-['Outfit']">
                            {{ $settings['footer_about_heading'] ?? 'About' }}</h4>
                        <p class="text-xs text-[#a59cc0] leading-relaxed">
                            {{ $settings['footer_about_text'] ?? 'Sed non auctor magna. Nunc eu ultrices orci. Donec commodo ligula in massa ultricies volutpat. Fusce vel cursus lectus.' }}
                        </p>
                    </div>
                </div>

                <!-- Newsletter (Under Contact & About with subscriber count) -->
                @include('frontend.partials.newsletter', [
                    'accent' => '#7c3aed',
                    'btnText' => 'text-white',
                    'inputBg' => 'bg-[#150f29]',
                    'borderColor' => 'border-[#a855f7]/20',
                ])
            </div>

            <!-- Floating Back to Top Button (Smooth scroll to website main menu header) -->
            <a href="#mainContent"
                id="backToTopBtn"
                onclick="
                    event.preventDefault(); 
                    const target = document.getElementById('mainContent') || document.getElementById('mainHeader'); 
                    if (target) { target.scrollIntoView({ behavior: 'smooth', block: 'start' }); } 
                    else { window.scrollTo({ top: 0, behavior: 'smooth' }); }
                "
                class="fixed right-4 sm:right-6 md:right-10 bottom-4 sm:bottom-6 md:bottom-10 w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-[#181233] hover:bg-[#7c3aed] text-[#c084fc] hover:text-white border border-white/10 flex items-center justify-center transition-all duration-300 hover:-translate-y-1 shadow-2xl shadow-black/80 cursor-pointer z-50 opacity-0 invisible translate-y-4 pointer-events-none"
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

                    window.addEventListener('scroll', onScroll, { passive: true });
                })();
            </script>

        </div>

        <!-- Bottom Copyright Sub-Footer -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-[#756d8a] gap-4">
            <div>
                {{ $settings['copyright_text'] ?? '© ' . ($settings['footer_logo_text'] ?? ($settings['site_logo_text'] ?? 'Ahsan')) . ' / All rights reserved' }}
            </div>
            <div>
                Design by: <span
                    class="text-slate-300 font-medium">{{ $settings['footer_credits'] ?? 'Themetorium' }}</span>
            </div>
        </div>

    </div>
</footer>
