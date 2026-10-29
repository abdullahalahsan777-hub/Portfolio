<!-- =========================================================================
     FOOTER SECTION (UI/UX Designer Theme)
     Matches design image: Logo with colored dot, 5-column menu/links/contact/about,
     floating back-to-top button, and copyright bar.
     ========================================================================= -->
<footer class="bg-[#050505] text-neutral-400 pt-20 pb-10 border-t border-white/10 relative overflow-hidden font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Main Footer Row (5 Columns) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-16 border-b border-white/5 relative">
            
            <!-- Column 1 (3 cols): Brand Logo with colored dot -->
            <div class="lg:col-span-3 space-y-4">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1 group">
                    <span class="text-3xl font-black tracking-tight text-white font-['Outfit'] lowercase">{{ $settings['site_logo_text'] ?? 'aivo' }}<span class="text-[#ccff00] inline-block font-black text-4xl leading-none">.</span></span>
                </a>
                <p class="text-xs text-neutral-500 leading-relaxed max-w-xs">
                    Transforming complex digital ecosystems into intuitive, tested, and high-converting user interfaces with atomic Figma design systems.
                </p>
            </div>

            <!-- Column 2 (2 cols): Menu -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-sm font-bold text-white tracking-wide font-['Outfit']">Menu</h4>
                <ul class="space-y-2.5 text-xs">
                    <li><a href="{{ route('about') }}" class="hover:text-[#ccff00] transition-colors">About</a></li>
                    <li><a href="{{ route('portfolio') }}" class="hover:text-[#ccff00] transition-colors">Portfolio</a></li>
                    <li><a href="{{ route('blog') }}" class="hover:text-[#ccff00] transition-colors">Blog</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-[#ccff00] transition-colors">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-[#ccff00] transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Column 3 (2 cols): Follow -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-sm font-bold text-white tracking-wide font-['Outfit']">Follow</h4>
                <ul class="space-y-2.5 text-xs">
                    @if(!empty($settings['social_facebook']))
                        <li><a href="{{ $settings['social_facebook'] }}" target="_blank" class="hover:text-[#ccff00] transition-colors">Facebook</a></li>
                    @endif
                    @if(!empty($settings['social_instagram']))
                        <li><a href="{{ $settings['social_instagram'] }}" target="_blank" class="hover:text-[#ccff00] transition-colors">Instagram</a></li>
                    @endif
                    @if(!empty($settings['social_linkedin']))
                        <li><a href="{{ $settings['social_linkedin'] }}" target="_blank" class="hover:text-[#ccff00] transition-colors">LinkedIn</a></li>
                    @endif
                    @if(!empty($settings['social_pinterest']))
                        <li><a href="{{ $settings['social_pinterest'] }}" target="_blank" class="hover:text-[#ccff00] transition-colors">Pinterest</a></li>
                    @endif
                    @if(!empty($settings['social_tiktok']))
                        <li><a href="{{ $settings['social_tiktok'] }}" target="_blank" class="hover:text-[#ccff00] transition-colors">TikTok</a></li>
                    @endif
                    @if(!empty($settings['social_youtube']))
                        <li><a href="{{ $settings['social_youtube'] }}" target="_blank" class="hover:text-[#ccff00] transition-colors">YouTube</a></li>
                    @endif
                    @if(!empty($settings['social_twitter']))
                        <li><a href="{{ $settings['social_twitter'] }}" target="_blank" class="hover:text-[#ccff00] transition-colors">Twitter / X</a></li>
                    @endif
                    @if(!empty($settings['social_behance']))
                        <li><a href="{{ $settings['social_behance'] }}" target="_blank" class="hover:text-[#ccff00] transition-colors">Behance</a></li>
                    @endif
                    @if(!empty($settings['social_dribbble']))
                        <li><a href="{{ $settings['social_dribbble'] }}" target="_blank" class="hover:text-[#ccff00] transition-colors">Dribbble</a></li>
                    @endif
                </ul>
            </div>

            <!-- Column 4 (2.5 cols): Contact -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-sm font-bold text-white tracking-wide font-['Outfit']">Contact</h4>
                <div class="space-y-2.5 text-xs leading-relaxed">
                    <p class="text-neutral-400">{!! $settings['contact_location'] ?? '121 King Street,<br>Melbourne, Australia' !!}</p>
                    <p><a href="tel:{{ $settings['contact_phone'] ?? '+123456789000' }}" class="text-[#ccff00] hover:underline">{{ $settings['contact_phone'] ?? '+123 456 789 000' }}</a></p>
                    <p><a href="mailto:{{ $settings['contact_email'] ?? 'info@youremail.com' }}" class="text-white border-b border-dotted border-white/50 pb-0.5 hover:text-[#ccff00] hover:border-[#ccff00] transition-colors">{{ $settings['contact_email'] ?? 'info@youremail.com' }}</a></p>
                </div>
            </div>

            <!-- Column 5 (2.5 cols): About Paragraph -->
            <div class="lg:col-span-3 space-y-4">
                <h4 class="text-sm font-bold text-white tracking-wide font-['Outfit']">About</h4>
                <p class="text-xs text-neutral-400 leading-relaxed">
                    Sed non auctor magna. Nunc eu ultrices orci. Donec commodo ligula in massa ultricies volutpat. Fusce vel cursus lectus.
                </p>
            </div>

            <!-- Floating Back to Top Button (Matches Image: square dark button with chevron up) -->
            <a href="#mainHeader" class="absolute right-0 bottom-4 w-9 h-9 rounded-md bg-[#171717] hover:bg-[#ccff00] text-neutral-300 hover:text-[#080808] border border-white/10 flex items-center justify-center transition-all hover:-translate-y-1 shadow-lg" title="Back to top">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/>
                </svg>
            </a>

        </div>

        <!-- Bottom Copyright Sub-Footer -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-neutral-500 gap-4">
            <div>
                &copy; {{ $settings['site_logo_text'] ?? 'Aivo' }} / All rights reserved
            </div>
            <div>
                Design by: <span class="text-neutral-300 font-medium">Themetorium</span>
            </div>
        </div>

    </div>
</footer>
