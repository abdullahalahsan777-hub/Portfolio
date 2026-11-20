<!-- =========================================================================
     ULTRA-MODERN EDITORIAL FOOTER (Digital Designer & Illustrator Theme)
     Claude AI & Awwwards Inspired Architecture:
     1. Kinetic Hero Statement (Unboxed, Magnetic, High-Impact)
     2. Statement Brand Wordmark Divider (Positioned as central architectural bridge)
     3. Balanced 4-Column Grid with Newsletter & 5 Social Icon Buttons
     4. Refined Minimalist Colophon Bar (Live local clock & smooth back to top)
     ========================================================================= -->
@php
    $siteName = $settings['site_logo_text'] ?? ($settings['site_title'] ?? 'elena');
    $siteEmail = $settings['contact_email'] ?? 'elena.art@example.com';
    $sitePhone = $settings['contact_phone'] ?? '+1 234 567 8901';
    $siteLocation = $settings['contact_location'] ?? 'Berlin, Germany & Remote';
    $siteBio = $settings['footer_bio'] ?? 'Visual storyteller, digital illustrator, and editorial brand designer creating immersive worlds and emotive visual craft.';
    $cleanLocation = strip_tags(str_replace(['<br>', '<br/>', '<br />'], ', ', $siteLocation));
@endphp

<footer class="relative bg-slate-100 dark:bg-[#07080a] text-slate-600 dark:text-[#999999] pt-20 pb-12 overflow-hidden font-['Plus_Jakarta_Sans'] border-t border-black/[0.06] dark:border-white/[0.08] transition-colors duration-300">
    <!-- Ambient Radial Glow Centered at Top Edge -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[850px] h-[350px] bg-[#e26d9b]/[0.08] rounded-full blur-[170px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-14">

        <!-- =========================================================================
             1. THE KINETIC HERO STATEMENT (Unboxed, Magnetic, High-Impact)
             ========================================================================= -->
        <div class="space-y-6">
            <!-- Live Availability Pill -->
            <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-black/[0.03] dark:bg-white/[0.03] border border-black/10 dark:border-white/10 text-xs font-mono text-slate-800 dark:text-neutral-300">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#e26d9b] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-[#e26d9b]"></span>
                </span>
                <span class="tracking-wide">Available for editorial illustration &amp; brand art</span>
            </div>

            <!-- Bold Invitation Heading & Magnetic Action Buttons -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end justify-between">
                <div class="lg:col-span-8 space-y-4">
                    <h2 class="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 dark:text-white tracking-tight font-['Outfit'] leading-[1.1]">
                        Have a story to illustrate?<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-900 dark:from-white via-[#e26d9b] to-[#f49dbd]">
                            Let's bring imagination to reality.
                        </span>
                    </h2>
                    <p class="text-sm sm:text-base text-slate-600 dark:text-neutral-400 max-w-2xl leading-relaxed">
                        Character design, editorial visual art, vector iconography, and captivating brand illustration craft.
                    </p>
                </div>

                <!-- Primary Action & Direct Contact -->
                <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col items-start lg:items-end gap-3.5">
                    <a href="{{ route('contact') }}"
                        class="group inline-flex items-center gap-3 px-8 py-4 rounded-full bg-[#e26d9b] text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-[#e26d9b]/25">
                        <span>Commission Work</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1 group-hover:-translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>

                    <!-- Minimalist Copy Email Pill -->
                    <button type="button"
                        onclick="copyFooterEmail('{{ $siteEmail }}', this)"
                        class="group inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-black/[0.03] dark:bg-white/[0.03] hover:bg-black/[0.06] dark:hover:bg-white/[0.08] border border-black/10 dark:border-white/10 hover:border-[#e26d9b]/40 text-xs font-mono text-slate-700 dark:text-neutral-300 hover:text-slate-900 dark:hover:text-white transition-all cursor-pointer">
                        <svg class="w-3.5 h-3.5 text-[#e26d9b]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $siteEmail }}</span>
                        <span class="copy-badge ml-1 text-[10px] text-slate-400 dark:text-neutral-400 group-hover:text-[#e26d9b] transition-colors">copy</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- =========================================================================
             2. STATEMENT BRAND WORDMARK DIVIDER (Positioned as Central Bridge)
             ========================================================================= -->
        <div class="py-4 sm:py-6 border-y border-black/[0.06] dark:border-white/[0.08] overflow-hidden select-none pointer-events-none text-center relative">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-[#e26d9b]/[0.04] to-transparent pointer-events-none"></div>
            <span class="text-[8vw] sm:text-[9.5vw] font-black tracking-tighter uppercase font-['Outfit'] leading-none block whitespace-nowrap text-transparent bg-clip-text bg-gradient-to-r from-black/10 dark:from-white/10 via-[#e26d9b]/30 to-black/10 dark:to-white/10">
                {{ $siteName }}
            </span>
        </div>

        <!-- =========================================================================
             3. BALANCED 4-COLUMN ARCHITECTURAL GRID (With 5 Social Icons in Column 4)
             ========================================================================= -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 pb-12 border-b border-black/[0.06] dark:border-white/[0.08]">

            <!-- Column 1 (4 cols): Brand & Elevator Bio -->
            <div class="lg:col-span-4 space-y-4">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 group">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-[#e26d9b] to-[#f49dbd] text-white flex items-center justify-center font-black text-sm shadow-md shadow-[#e26d9b]/25 group-hover:scale-105 transition-transform">
                        ✿
                    </div>
                    <span class="text-2xl font-black tracking-tight text-slate-900 dark:text-white font-['Outfit'] lowercase">
                        {{ $siteName }}<span class="text-[#e26d9b] inline-block font-black text-3xl leading-none">.</span>
                    </span>
                </a>

                <p class="text-xs sm:text-sm text-slate-600 dark:text-neutral-400 leading-relaxed max-w-sm">
                    {{ $siteBio }}
                </p>

                <!-- Location & Direct Coordinates -->
                <div class="space-y-1 text-xs text-slate-600 dark:text-neutral-400 pt-1">
                    <div class="flex items-start gap-2">
                        <span class="text-slate-400 dark:text-neutral-500 font-mono shrink-0">Location:</span>
                        <span class="text-slate-800 dark:text-neutral-300 font-medium">{{ $cleanLocation }}</span>
                    </div>
                    @if (!empty($sitePhone))
                        <div class="flex items-center gap-2">
                            <span class="text-slate-400 dark:text-neutral-500 font-mono shrink-0">Studio:</span>
                            <a href="tel:{{ $sitePhone }}" class="text-slate-800 dark:text-neutral-300 hover:text-[#e26d9b] transition-colors font-mono">{{ $sitePhone }}</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Column 2 (2 cols): Explore / Navigation Hub -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-slate-900 dark:text-white">Index</h4>
                <ul class="space-y-2 text-xs text-slate-600 dark:text-neutral-400">
                    <li><a href="{{ route('home') }}" class="hover:text-[#e26d9b] transition-colors inline-flex items-center gap-1 group"><span>Home</span><span class="text-slate-400 dark:text-neutral-600 group-hover:text-[#e26d9b] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-[#e26d9b] transition-colors inline-flex items-center gap-1 group"><span>About</span><span class="text-slate-400 dark:text-neutral-600 group-hover:text-[#e26d9b] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('portfolio') }}" class="hover:text-[#e26d9b] transition-colors inline-flex items-center gap-1 group"><span>Artwork</span><span class="text-slate-400 dark:text-neutral-600 group-hover:text-[#e26d9b] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('gallery') }}" class="hover:text-[#e26d9b] transition-colors inline-flex items-center gap-1 group"><span>Illustrations</span><span class="text-slate-400 dark:text-neutral-600 group-hover:text-[#e26d9b] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('blog') }}" class="hover:text-[#e26d9b] transition-colors inline-flex items-center gap-1 group"><span>Journal</span><span class="text-slate-400 dark:text-neutral-600 group-hover:text-[#e26d9b] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-[#e26d9b] transition-colors inline-flex items-center gap-1 group"><span>FAQ</span><span class="text-slate-400 dark:text-neutral-600 group-hover:text-[#e26d9b] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('contact') }}" class="text-slate-900 dark:text-white hover:text-[#e26d9b] font-semibold transition-colors inline-flex items-center gap-1 group"><span>Contact</span><span class="text-[#e26d9b] transition-colors">&nearr;</span></a></li>
                </ul>
            </div>

            <!-- Column 3 (2 cols): Social & Network -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-slate-900 dark:text-white">Galleries</h4>
                <ul class="space-y-2 text-xs text-slate-600 dark:text-neutral-400">
                    @if (!empty($settings['social_instagram']))
                        <li><a href="{{ $settings['social_instagram'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#e26d9b] transition-colors inline-flex items-center gap-1 group"><span>Instagram</span><span class="text-slate-400 dark:text-neutral-600 group-hover:text-[#e26d9b] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    @endif
                    @if (!empty($settings['social_behance']))
                        <li><a href="{{ $settings['social_behance'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#e26d9b] transition-colors inline-flex items-center gap-1 group"><span>Behance</span><span class="text-slate-400 dark:text-neutral-600 group-hover:text-[#e26d9b] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    @endif
                    @if (!empty($settings['social_dribbble']))
                        <li><a href="{{ $settings['social_dribbble'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#e26d9b] transition-colors inline-flex items-center gap-1 group"><span>Dribbble</span><span class="text-slate-400 dark:text-neutral-600 group-hover:text-[#e26d9b] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    @endif
                    @if (!empty($settings['social_pinterest']))
                        <li><a href="{{ $settings['social_pinterest'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#e26d9b] transition-colors inline-flex items-center gap-1 group"><span>Pinterest</span><span class="text-slate-400 dark:text-neutral-600 group-hover:text-[#e26d9b] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    @endif
                    @if (!empty($settings['social_twitter']))
                        <li><a href="{{ $settings['social_twitter'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#e26d9b] transition-colors inline-flex items-center gap-1 group"><span>Twitter / X</span><span class="text-slate-400 dark:text-neutral-600 group-hover:text-[#e26d9b] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    @endif
                </ul>
            </div>

            <!-- Column 4 (4 cols): Dispatch & 5 Social Icons -->
            <div class="lg:col-span-4 space-y-4">
                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-slate-900 dark:text-white">Studio Letters</h4>
                <p class="text-xs text-slate-600 dark:text-neutral-400 leading-relaxed">
                    Subscribe for quarterly art prints, sketchbook insights, creative inspiration, and print shop drops.
                </p>

                <!-- Seamless Integrated Newsletter Input -->
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-2 pt-1">
                    @csrf
                    <div class="relative flex items-center">
                        <input type="email" name="email" required placeholder="Enter your email address..."
                            class="w-full pl-4 pr-12 py-3 rounded-xl bg-black/[0.03] dark:bg-white/[0.04] border border-black/10 dark:border-white/10 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-neutral-500 focus:outline-none focus:border-[#e26d9b]/60 focus:bg-black/[0.05] dark:focus:bg-white/[0.06] transition-all">
                        <button type="submit"
                            class="absolute right-1.5 w-9 h-9 rounded-lg bg-[#e26d9b] hover:bg-[#d85888] text-white flex items-center justify-center transition-transform hover:scale-105 cursor-pointer"
                            title="Subscribe">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </form>

                <div class="flex items-center gap-2 text-[11px] font-mono text-slate-500 dark:text-neutral-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#e26d9b]"></span>
                    <span>No spam. One-click unsubscribe anytime.</span>
                </div>

                <!-- Social Icons (5) - High-Contrast Rounded Magnetic Buttons -->
                <div class="pt-3 border-t border-black/[0.06] dark:border-white/[0.06] space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="text-[11px] font-mono uppercase tracking-wider text-slate-600 dark:text-neutral-400 font-semibold">Social Channels</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <!-- 1. Instagram -->
                        <a href="{{ $settings['social_instagram'] ?? 'https://instagram.com' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-xl bg-black/[0.04] dark:bg-white/[0.04] hover:bg-[#e26d9b] text-slate-700 dark:text-neutral-300 hover:text-white border border-black/10 dark:border-white/10 hover:border-[#e26d9b] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                            title="Instagram" aria-label="Instagram">
                            <svg class="w-4 h-4 fill-current pointer-events-none" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>

                        <!-- 2. Behance -->
                        <a href="{{ $settings['social_behance'] ?? 'https://behance.net' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-xl bg-black/[0.04] dark:bg-white/[0.04] hover:bg-[#e26d9b] text-slate-700 dark:text-neutral-300 hover:text-white border border-black/10 dark:border-white/10 hover:border-[#e26d9b] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                            title="Behance" aria-label="Behance">
                            <svg class="w-4 h-4 fill-current pointer-events-none" viewBox="0 0 24 24">
                                <path d="M22 7h-7v-2h7v2zm1.726 10c-.442 1.297-2.029 3-4.971 3-3.467 0-5.834-2.544-5.834-5.917 0-3.468 2.457-6.083 5.763-6.083 3.42 0 5.474 2.518 5.474 6.083h-8.24c.063 1.782 1.341 3.076 2.977 3.076 1.408 0 2.277-.696 2.673-1.624l2.158 1.465zm-2.316-4.437c-.073-1.258-.87-2.42-2.463-2.42-1.542 0-2.378 1.118-2.543 2.42h5.006zm-13.41 7.437h-8v-16h8.217c2.68 0 4.783 1.354 4.783 3.864 0 1.552-.806 2.766-2.091 3.393 1.737.587 2.591 2.052 2.591 3.93 0 2.871-2.298 4.813-5.5 4.813zm-5-10h4.316c1.19 0 2.184-.57 2.184-1.636 0-1.137-.927-1.636-2.184-1.636h-4.316v3.272zm0 7h4.783c1.378 0 2.422-.658 2.422-1.892 0-1.282-1.077-1.975-2.422-1.975h-4.783v3.867z" />
                            </svg>
                        </a>

                        <!-- 3. Dribbble -->
                        <a href="{{ $settings['social_dribbble'] ?? 'https://dribbble.com' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-xl bg-black/[0.04] dark:bg-white/[0.04] hover:bg-[#e26d9b] text-slate-700 dark:text-neutral-300 hover:text-white border border-black/10 dark:border-white/10 hover:border-[#e26d9b] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                            title="Dribbble" aria-label="Dribbble">
                            <svg class="w-4 h-4 fill-current pointer-events-none" viewBox="0 0 24 24">
                                <path d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm7.98 5.7c1.32 1.68 2.13 3.78 2.25 6.09-.54-.12-2.82-.57-5.46-.24-.09-.21-.18-.45-.27-.69-.72-1.74-1.53-3.39-2.28-4.71 2.76-.36 4.77-.45 5.76-.45zm-7.98-3.93c2.43 0 4.65.84 6.42 2.25-.9.03-2.79.12-5.4.45-.96-1.59-1.89-3.06-2.58-4.08 1.14-.39 2.37-.62 3.56-.62zm-5.76 1.83c.72.99 1.62 2.43 2.55 3.96-3.36 1.05-6.96 1.77-7.98 1.83 1.05-2.61 3.09-4.71 5.43-5.79zm-4.47 7.89c.75-.06 4.02-.72 7.23-1.68.21.48.42.96.6 1.47-2.7 1.05-5.58 3.57-7.29 5.85-.45-1.68-.69-3.48-.54-5.64zm2.13 7.56c1.5-1.98 4.05-4.26 6.54-5.25.96 2.52 1.47 5.16 1.68 6.78-2.64 1.2-5.61 1.02-8.22-1.53zm9.84.15c-.21-1.47-.69-3.87-1.56-6.27 2.4-.36 4.47.09 5.01.21-.6 2.64-2.07 4.89-4.08 6.27-.09-.09-.18-.15-.27-.21z" />
                            </svg>
                        </a>

                        <!-- 4. Pinterest -->
                        <a href="{{ $settings['social_pinterest'] ?? 'https://pinterest.com' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-xl bg-black/[0.04] dark:bg-white/[0.04] hover:bg-[#e26d9b] text-slate-700 dark:text-neutral-300 hover:text-white border border-black/10 dark:border-white/10 hover:border-[#e26d9b] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                            title="Pinterest" aria-label="Pinterest">
                            <svg class="w-4 h-4 fill-current pointer-events-none" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.372-12 12 0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345-.09.375-.291 1.199-.332 1.357-.053.211-.174.256-.402.155-1.498-.698-2.435-2.889-2.435-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146 1.124.347 2.317.535 3.554.535 6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z" />
                            </svg>
                        </a>

                        <!-- 5. Twitter / X -->
                        <a href="{{ $settings['social_twitter'] ?? 'https://twitter.com' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-xl bg-black/[0.04] dark:bg-white/[0.04] hover:bg-[#e26d9b] text-slate-700 dark:text-neutral-300 hover:text-white border border-black/10 dark:border-white/10 hover:border-[#e26d9b] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                            title="Twitter / X" aria-label="Twitter / X">
                            <svg class="w-4 h-4 fill-current pointer-events-none" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- =========================================================================
             4. MINIMALIST COLOPHON BAR
             ========================================================================= -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-mono text-slate-500 dark:text-neutral-400 pt-2">
            <div>
                &copy; {{ date('Y') }} <span class="text-slate-800 dark:text-neutral-300 font-medium">{{ $settings['site_copyright'] ?? ($settings['site_title'] ?? 'Abdullah Al Ahsan') }}</span>. All rights reserved.
            </div>

            <!-- Live Clock -->
            <div class="flex items-center gap-2 text-[11px] text-slate-500 dark:text-neutral-400">
                <span class="w-1.5 h-1.5 rounded-full bg-[#e26d9b] animate-pulse"></span>
                <span id="footer-ddi-clock">Sherpur, BD &bull; Loading local time...</span>
            </div>

            <!-- Smooth Back to Top Trigger -->
            <div>
                <a href="#mainContent"
                    onclick="event.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' });"
                    class="group inline-flex items-center gap-1 text-slate-500 dark:text-neutral-400 hover:text-[#e26d9b] transition-colors cursor-pointer">
                    <span>Back to top</span>
                    <span class="group-hover:-translate-y-0.5 transition-transform font-bold">&uarr;</span>
                </a>
            </div>
        </div>

    </div>

    <!-- Floating Back to Top Button (Smooth scroll to top on page scroll) -->
    <a href="#mainContent"
        id="backToTopBtn"
        onclick="event.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' });"
        class="fixed right-4 sm:right-6 md:right-10 bottom-4 sm:bottom-6 md:bottom-10 w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-white dark:bg-[#141414] hover:bg-[#e26d9b] text-[#e26d9b] hover:text-white border border-black/10 dark:border-white/15 hover:border-[#e26d9b] flex items-center justify-center transition-all duration-300 hover:-translate-y-1 shadow-2xl shadow-black/30 dark:shadow-black/80 cursor-pointer z-50 opacity-0 invisible translate-y-4 pointer-events-none"
        title="Back to top" aria-label="Back to top">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" />
        </svg>
    </a>
</footer>

<!-- Shared JavaScript Helpers for Modern Footer -->
<script>
    function copyFooterEmail(email, btn) {
        if (!email) return;
        navigator.clipboard.writeText(email).then(() => {
            const badge = btn.querySelector('.copy-badge');
            if (badge) {
                const oldText = badge.textContent;
                badge.textContent = 'Copied! ✓';
                badge.classList.add('text-[#e26d9b]');
                setTimeout(() => {
                    badge.textContent = oldText;
                    badge.classList.remove('text-[#e26d9b]');
                }, 2000);
            }
            if (typeof toastr !== 'undefined') {
                toastr.success('Email address copied to clipboard.', 'Copied!');
            }
        }).catch(err => {
            console.error('Copy failed:', err);
        });
    }

    (function initFooterClock() {
        const el = document.getElementById('footer-ddi-clock');
        if (!el) return;

        function updateClock() {
            try {
                const now = new Date();
                const timeStr = new Intl.DateTimeFormat('en-US', {
                    hour: 'numeric',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: true,
                    timeZone: 'Asia/Dhaka'
                }).format(now);
                el.textContent = `Sherpur, BD • ${timeStr} (UTC+6)`;
            } catch (e) {
                el.textContent = 'Sherpur, BD • UTC+6';
            }
        }
        updateClock();
        setInterval(updateClock, 1000);
    })();

    (function initBackToTop() {
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

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
            if (currentScroll > 300) {
                showBtn();
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => {
                    if (!isHovered) hideBtn();
                }, 2200);
            } else {
                hideBtn();
            }
        }, { passive: true });

        btn.addEventListener('mouseenter', () => {
            isHovered = true;
            clearTimeout(scrollTimeout);
            showBtn();
        });

        btn.addEventListener('mouseleave', () => {
            isHovered = false;
            scrollTimeout = setTimeout(hideBtn, 1500);
        });
    })();
</script>
