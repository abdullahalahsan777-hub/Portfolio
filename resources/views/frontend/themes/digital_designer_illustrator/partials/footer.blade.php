<!-- =========================================================================
     STANDARDIZED FOOTER PARTIAL (Digital Designer & Illustrator Theme)
     - 5-Column Grid Layout (Brand, Menu, Follow, Contact, About)
     - Floating Back-to-Top Button
     - Bottom Sub-Footer Copyright Bar
     ========================================================================= -->
<footer class="bg-[#c5c9d0] dark:bg-[#0c0d10] text-[#4e535e] dark:text-[#9aa0aa] pt-20 pb-10 border-t border-black/10 dark:border-white/10 relative overflow-hidden font-['Plus_Jakarta_Sans'] transition-colors duration-300">
    
    <!-- Subtle Botanical Floral Glow Backdrop -->
    <div class="absolute bottom-0 right-10 w-96 h-96 opacity-15 dark:opacity-5 pointer-events-none">
        <img src="{{ asset('images/digital_designer_illustrator/flower.jpg') }}" alt="" class="w-full h-full object-contain filter grayscale contrast-125">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Main Footer Row (5 Columns) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-16 border-b border-black/10 dark:border-white/10 relative">
            
            <!-- Column 1 (3 cols): Brand Logo -->
            <div class="lg:col-span-3 space-y-4">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-[#ffffff] to-[#fff0f5] text-[#e26d9b] border border-[#e26d9b]/30 dark:from-white/15 dark:to-white/5 dark:text-white dark:border-white/10 flex items-center justify-center font-serif italic text-base shadow-sm group-hover:scale-105 transition-transform">
                        AW
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-[#111215] dark:text-white font-['Outfit']">
                        {{ $settings['site_logo_text'] ?? 'Alex' }}<span class="text-[#e26d9b] inline-block font-black text-3xl leading-none">.</span>
                    </span>
                </a>
                <p class="text-xs text-[#555a64] dark:text-[#9aa0aa] leading-relaxed max-w-xs">
                    Crafting bespoke digital interfaces, modern 3D brand experiences, typography systems, and expressive editorial illustrations.
                </p>
                <div class="flex items-center gap-3 pt-2">
                    <a href="{{ $settings['social_dribbble'] ?? 'https://dribbble.com' }}" target="_blank" class="footer-social-btn w-10 h-10 rounded-full bg-white/70 dark:bg-[#13151b] border border-black/10 dark:border-white/10 text-[#111215] dark:text-white hover:text-white hover:bg-[#e26d9b] dark:hover:bg-[#e26d9b] hover:border-[#e26d9b] dark:hover:border-[#e26d9b] flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow-lg hover:shadow-[#e26d9b]/25 hover:-translate-y-1 text-base" title="Dribbble">
                        <i class="ph ph-dribbble-logo"></i>
                    </a>
                    <a href="{{ $settings['social_behance'] ?? 'https://behance.net' }}" target="_blank" class="footer-social-btn w-10 h-10 rounded-full bg-white/70 dark:bg-[#13151b] border border-black/10 dark:border-white/10 text-[#111215] dark:text-white hover:text-white hover:bg-[#e26d9b] dark:hover:bg-[#e26d9b] hover:border-[#e26d9b] dark:hover:border-[#e26d9b] flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow-lg hover:shadow-[#e26d9b]/25 hover:-translate-y-1 text-base" title="Behance">
                        <i class="ph ph-behance-logo"></i>
                    </a>
                    <a href="{{ $settings['social_linkedin'] ?? 'https://linkedin.com' }}" target="_blank" class="footer-social-btn w-10 h-10 rounded-full bg-white/70 dark:bg-[#13151b] border border-black/10 dark:border-white/10 text-[#111215] dark:text-white hover:text-white hover:bg-[#e26d9b] dark:hover:bg-[#e26d9b] hover:border-[#e26d9b] dark:hover:border-[#e26d9b] flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow-lg hover:shadow-[#e26d9b]/25 hover:-translate-y-1 text-base" title="LinkedIn">
                        <i class="ph ph-linkedin-logo"></i>
                    </a>
                    <a href="{{ $settings['social_github'] ?? 'https://github.com' }}" target="_blank" class="footer-social-btn w-10 h-10 rounded-full bg-white/70 dark:bg-[#13151b] border border-black/10 dark:border-white/10 text-[#111215] dark:text-white hover:text-white hover:bg-[#e26d9b] dark:hover:bg-[#e26d9b] hover:border-[#e26d9b] dark:hover:border-[#e26d9b] flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow-lg hover:shadow-[#e26d9b]/25 hover:-translate-y-1 text-base" title="GitHub">
                        <i class="ph ph-github-logo"></i>
                    </a>
                </div>
            </div>

            <!-- Column 2 (2 cols): Menu -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs font-bold uppercase tracking-wider text-[#111215] dark:text-white font-['Outfit']">Menu</h4>
                <ul class="space-y-2.5 text-xs text-[#555a64] dark:text-[#9aa0aa]">
                    <li><a href="{{ route('home') }}" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">Home</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">About</a></li>
                    <li><a href="{{ route('portfolio') }}" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">Works</a></li>
                    <li><a href="{{ route('blog') }}" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">Blog</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Column 3 (2 cols): Follow -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs font-bold uppercase tracking-wider text-[#111215] dark:text-white font-['Outfit']">Follow</h4>
                <ul class="space-y-2.5 text-xs text-[#555a64] dark:text-[#9aa0aa]">
                    @if(!empty($settings['social_facebook']))
                        <li><a href="{{ $settings['social_facebook'] }}" target="_blank" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">Facebook</a></li>
                    @endif
                    @if(!empty($settings['social_instagram']))
                        <li><a href="{{ $settings['social_instagram'] }}" target="_blank" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">Instagram</a></li>
                    @endif
                    @if(!empty($settings['social_linkedin']))
                        <li><a href="{{ $settings['social_linkedin'] }}" target="_blank" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">LinkedIn</a></li>
                    @endif
                    @if(!empty($settings['social_pinterest']))
                        <li><a href="{{ $settings['social_pinterest'] }}" target="_blank" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">Pinterest</a></li>
                    @endif
                    @if(!empty($settings['social_tiktok']))
                        <li><a href="{{ $settings['social_tiktok'] }}" target="_blank" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">TikTok</a></li>
                    @endif
                    @if(!empty($settings['social_youtube']))
                        <li><a href="{{ $settings['social_youtube'] }}" target="_blank" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">YouTube</a></li>
                    @endif
                    @if(!empty($settings['social_twitter']))
                        <li><a href="{{ $settings['social_twitter'] }}" target="_blank" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">Twitter / X</a></li>
                    @endif
                    @if(!empty($settings['social_behance']))
                        <li><a href="{{ $settings['social_behance'] }}" target="_blank" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">Behance</a></li>
                    @endif
                    @if(!empty($settings['social_dribbble']))
                        <li><a href="{{ $settings['social_dribbble'] }}" target="_blank" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">Dribbble</a></li>
                    @endif
                </ul>
            </div>

            <!-- Column 4 (2.5 cols): Contact -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs font-bold uppercase tracking-wider text-[#111215] dark:text-white font-['Outfit']">Contact</h4>
                <div class="space-y-2.5 text-xs leading-relaxed text-[#555a64] dark:text-[#9aa0aa]">
                    <p>{{ $settings['contact_location'] ?? 'London, UK & Available Worldwide' }}</p>
                    <p><a href="tel:{{ $settings['contact_phone'] ?? '+1 (555) 782-9011' }}" class="text-[#111215] dark:text-white hover:text-[#e26d9b] dark:hover:text-[#e26d9b] font-mono">{{ $settings['contact_phone'] ?? '+1 (555) 782-9011' }}</a></p>
                    <p><a href="mailto:{{ $settings['contact_email'] ?? 'alex.walker@design.me' }}" class="text-[#111215] dark:text-white border-b border-dotted border-black/40 dark:border-white/40 pb-0.5 hover:text-[#e26d9b] dark:hover:text-[#e26d9b] hover:border-[#e26d9b] dark:hover:border-[#e26d9b] transition-colors">{{ $settings['contact_email'] ?? 'alex.walker@design.me' }}</a></p>
                </div>
            </div>

            <!-- Column 5 (2.5 cols): About -->
            <div class="lg:col-span-3 space-y-4">
                <h4 class="text-xs font-bold uppercase tracking-wider text-[#111215] dark:text-white font-['Outfit']">About</h4>
                <p class="text-xs text-[#555a64] dark:text-[#9aa0aa] leading-relaxed">
                    Senior Digital Designer &amp; Illustrator specializing in high-concept brand systems, digital art direction, and interactive 3D web experiences.
                </p>
            </div>

            <!-- Floating Back to Top Button -->
            <a href="#mainHeader" class="absolute right-0 bottom-4 w-10 h-10 rounded-xl bg-white/80 dark:bg-white/10 hover:bg-[#e26d9b] dark:hover:bg-[#e26d9b] text-[#111215] dark:text-white hover:text-white border border-black/10 dark:border-white/10 flex items-center justify-center transition-all hover:-translate-y-1 shadow-md" title="Back to top">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/>
                </svg>
            </a>

        </div>

        <!-- Bottom Copyright Sub-Footer -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-[#6e7480] dark:text-[#808794] gap-4">
            <div>
                &copy; {{ date('Y') }} {{ $settings['site_title'] ?? 'Alex Walker' }} — All rights reserved
            </div>
            <div>
                Designed for <span class="text-[#111215] dark:text-white font-bold">Digital Designers &amp; Illustrators</span>
            </div>
        </div>

    </div>
</footer>
