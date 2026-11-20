<!-- =========================================================================
     ULTRA-MODERN EDITORIAL FOOTER (Developer Theme - GLINT)
     Claude AI & Awwwards Inspired Architecture:
     1. Kinetic Hero Statement (Unboxed, Magnetic, High-Impact)
     2. Statement Brand Wordmark Divider (Positioned as central architectural bridge)
     3. Balanced 4-Column Grid with Newsletter & 5 Social Icon Buttons
     4. Refined Minimalist Colophon Bar (Live local clock & smooth back to top)
     ========================================================================= -->
@php
    $siteName = $settings['site_logo_text'] ?? ($settings['site_title'] ?? 'glint');
    $siteEmail = $settings['contact_email'] ?? 'glint.info@gmail.com';
    $sitePhone = $settings['contact_phone'] ?? '+1 234 567 8900';
    $siteLocation = $settings['contact_location'] ?? 'San Francisco, CA / Remote';
    $siteBio = $settings['footer_bio'] ?? ($settings['site_description'] ?? 'Engineering scalable backend architectures, sub-second APIs, cloud infrastructure, and modern digital platforms.');
    $cleanLocation = strip_tags(str_replace(['<br>', '<br/>', '<br />'], ', ', $siteLocation));
@endphp

<footer class="relative bg-[#050505] text-[#999999] pt-20 pb-12 overflow-hidden font-['Plus_Jakarta_Sans'] border-t border-white/[0.08]">
    <!-- Ambient Radial Glow Centered at Top Edge -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[850px] h-[350px] bg-[#00ff88]/[0.06] rounded-full blur-[170px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-14">

        <!-- =========================================================================
             1. THE KINETIC HERO STATEMENT (Unboxed, Magnetic, High-Impact)
             ========================================================================= -->
        <div class="space-y-6">
            <!-- Live Availability Pill -->
            <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-white/[0.03] border border-white/10 text-xs font-mono text-neutral-300">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#00ff88] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-[#00ff88]"></span>
                </span>
                <span class="tracking-wide">Available for backend architectures &amp; cloud systems</span>
            </div>

            <!-- Bold Invitation Heading & Magnetic Action Buttons -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end justify-between">
                <div class="lg:col-span-8 space-y-4">
                    <h2 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight font-['Outfit'] leading-[1.1]">
                        Have an ambitious system in mind?<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-neutral-200 to-[#00ff88]">
                            Let's engineer something resilient.
                        </span>
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-400 max-w-2xl leading-relaxed">
                        Specialized in full-stack Laravel engineering, decoupled cloud microservices, and sub-second mission-critical web APIs.
                    </p>
                </div>

                <!-- Primary Action & Direct Contact -->
                <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col items-start lg:items-end gap-3.5">
                    <a href="{{ route('contact') }}"
                        class="group inline-flex items-center gap-3 px-8 py-4 rounded-full bg-[#00ff88] text-[#050505] font-bold text-xs uppercase tracking-wider transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-[#00ff88]/25">
                        <span>Initiate Project</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1 group-hover:-translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>

                    <!-- Minimalist Copy Email Pill -->
                    <button type="button"
                        onclick="copyFooterEmail('{{ $siteEmail }}', this)"
                        class="group inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-white/[0.03] hover:bg-white/[0.08] border border-white/10 hover:border-[#00ff88]/40 text-xs font-mono text-neutral-300 hover:text-white transition-all cursor-pointer">
                        <svg class="w-3.5 h-3.5 text-[#00ff88]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $siteEmail }}</span>
                        <span class="copy-badge ml-1 text-[10px] text-neutral-400 group-hover:text-[#00ff88] transition-colors">copy</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- =========================================================================
             2. STATEMENT BRAND WORDMARK DIVIDER (Plane Text with Water Reflection)
             ========================================================================= -->
        <div class="py-6 sm:py-8 border-y border-white/[0.08] overflow-hidden select-none pointer-events-none text-center relative bg-gradient-to-b from-transparent via-white/[0.01] to-transparent">
            <!-- Water Horizon Light Sheen -->
            <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 h-[1px] bg-gradient-to-r from-transparent via-white/10 via-[#00ff88]/30 to-transparent pointer-events-none"></div>

            <span class="font-['Outfit'] font-black uppercase tracking-[-0.03em] leading-[0.95] inline-block whitespace-nowrap text-white/[0.16] select-none"
                style="font-size: clamp(2rem, 7.5vw, 6.2rem); -webkit-box-reflect: below -0.22em linear-gradient(transparent 35%, rgba(255, 255, 255, 0.22)); -webkit-font-smoothing: antialiased;">
                {{ $siteName }}
            </span>
        </div>

        <!-- =========================================================================
             3. BALANCED 4-COLUMN ARCHITECTURAL GRID (With 5 Social Icons in Column 4)
             ========================================================================= -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 pb-12 border-b border-white/[0.08]">

            <!-- Column 1 (4 cols): Brand & Elevator Bio -->
            <div class="lg:col-span-4 space-y-4">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 group">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-[#00ff88] to-[#00df76] text-[#050505] flex items-center justify-center font-black text-sm shadow-md shadow-[#00ff88]/20 group-hover:scale-105 transition-transform">
                        ⬢
                    </div>
                    <span class="text-2xl font-black tracking-tight text-white font-['Outfit'] lowercase">
                        {{ $siteName }}<span class="text-[#00ff88] inline-block font-black text-3xl leading-none">.</span>
                    </span>
                </a>

                <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed max-w-sm">
                    {{ $siteBio }}
                </p>

                <!-- Address, Mobile & Email with Sleek Left Icons -->
                <div class="space-y-2.5 text-xs text-neutral-400 pt-2 font-mono">
                    @if (!empty($cleanLocation))
                        <div class="flex items-start gap-2.5 text-neutral-300">
                            <svg class="w-4 h-4 text-[#00ff88] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="leading-relaxed">{{ $cleanLocation }}</span>
                        </div>
                    @endif
                    @if (!empty($sitePhone))
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-[#00ff88] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <a href="tel:{{ preg_replace('/[^\d+]/', '', $sitePhone) }}" class="text-neutral-300 hover:text-[#00ff88] transition-colors">{{ $sitePhone }}</a>
                        </div>
                    @endif
                    @if (!empty($siteEmail))
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-[#00ff88] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="mailto:{{ $siteEmail }}" class="text-neutral-300 hover:text-[#00ff88] transition-colors truncate">{{ $siteEmail }}</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Column 2 (2 cols): Sitemap / Navigation Hub -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-white">Sitemap</h4>
                <ul class="space-y-2 text-xs text-neutral-400">
                    <li><a href="{{ route('home') }}" class="hover:text-[#00ff88] transition-colors inline-flex items-center gap-1 group"><span>Home</span><span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-[#00ff88] transition-colors inline-flex items-center gap-1 group"><span>About</span><span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('portfolio') }}" class="hover:text-[#00ff88] transition-colors inline-flex items-center gap-1 group"><span>Portfolio</span><span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('gallery') }}" class="hover:text-[#00ff88] transition-colors inline-flex items-center gap-1 group"><span>Gallery</span><span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('blog') }}" class="hover:text-[#00ff88] transition-colors inline-flex items-center gap-1 group"><span>Articles</span><span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-[#00ff88] transition-colors inline-flex items-center gap-1 group"><span>FAQ</span><span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('contact') }}" class="text-white hover:text-[#00ff88] font-semibold transition-colors inline-flex items-center gap-1 group"><span>Contact</span><span class="text-[#00ff88] transition-colors">&nearr;</span></a></li>
                </ul>
            </div>

            <!-- Column 3 (2 cols): Network / Channels -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-white">Network</h4>
                <ul class="space-y-2 text-xs text-neutral-400">
                    @if (!empty($settings['social_github']))
                        <li><a href="{{ $settings['social_github'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#00ff88] transition-colors inline-flex items-center gap-1 group"><span>GitHub</span><span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    @endif
                    @if (!empty($settings['social_linkedin']))
                        <li><a href="{{ $settings['social_linkedin'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#00ff88] transition-colors inline-flex items-center gap-1 group"><span>LinkedIn</span><span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    @endif
                    @if (!empty($settings['social_twitter']))
                        <li><a href="{{ $settings['social_twitter'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#00ff88] transition-colors inline-flex items-center gap-1 group"><span>Twitter / X</span><span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    @endif
                    @if (!empty($settings['social_dribbble']))
                        <li><a href="{{ $settings['social_dribbble'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#00ff88] transition-colors inline-flex items-center gap-1 group"><span>Dribbble</span><span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    @endif
                    @if (!empty($settings['social_behance']))
                        <li><a href="{{ $settings['social_behance'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#00ff88] transition-colors inline-flex items-center gap-1 group"><span>Behance</span><span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    @endif
                </ul>
            </div>

            <!-- Column 4 (4 cols): Dispatch & 5 Social Icons -->
            <div class="lg:col-span-4 space-y-4">
                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-white">System Dispatch</h4>
                <p class="text-xs text-neutral-400 leading-relaxed">
                    Subscribe for occasional engineering memos on high-throughput backend architecture, system design, and scalable infrastructure.
                </p>

                <!-- Seamless Integrated Newsletter Input -->
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-2 pt-1">
                    @csrf
                    <div class="relative flex items-center">
                        <input type="email" name="email" required placeholder="Enter your email address..."
                            class="w-full pl-4 pr-12 py-3 rounded-xl bg-white/[0.04] border border-white/10 text-xs text-white placeholder-neutral-500 focus:outline-none focus:border-[#00ff88]/60 focus:bg-white/[0.06] transition-all">
                        <button type="submit"
                            class="absolute right-1.5 w-9 h-9 rounded-lg bg-[#00ff88] hover:bg-[#00df76] text-[#050505] flex items-center justify-center transition-transform hover:scale-105 cursor-pointer"
                            title="Subscribe">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </form>

                <div class="flex items-center gap-2 text-[11px] font-mono text-neutral-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#00ff88]"></span>
                    <span>No spam. One-click unsubscribe anytime.</span>
                </div>

                <!-- Social Icons (5) - High-Contrast Rounded Magnetic Buttons -->
                <div class="pt-3 border-t border-white/[0.06] space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="text-[11px] font-mono uppercase tracking-wider text-neutral-400 font-semibold">Social Channels</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <!-- 1. GitHub -->
                        <a href="{{ $settings['social_github'] ?? 'https://github.com' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-xl bg-white/[0.04] hover:bg-[#00ff88] text-neutral-300 hover:text-black border border-white/10 hover:border-[#00ff88] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                            title="GitHub" aria-label="GitHub">
                            <svg class="w-4 h-4 fill-current pointer-events-none" viewBox="0 0 24 24">
                                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z" />
                            </svg>
                        </a>

                        <!-- 2. LinkedIn -->
                        <a href="{{ $settings['social_linkedin'] ?? 'https://linkedin.com' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-xl bg-white/[0.04] hover:bg-[#00ff88] text-neutral-300 hover:text-black border border-white/10 hover:border-[#00ff88] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                            title="LinkedIn" aria-label="LinkedIn">
                            <svg class="w-4 h-4 fill-current pointer-events-none" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                            </svg>
                        </a>

                        <!-- 3. Twitter / X -->
                        <a href="{{ $settings['social_twitter'] ?? 'https://twitter.com' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-xl bg-white/[0.04] hover:bg-[#00ff88] text-neutral-300 hover:text-black border border-white/10 hover:border-[#00ff88] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                            title="Twitter / X" aria-label="Twitter / X">
                            <svg class="w-4 h-4 fill-current pointer-events-none" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>

                        <!-- 4. Dribbble -->
                        <a href="{{ $settings['social_dribbble'] ?? 'https://dribbble.com' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-xl bg-white/[0.04] hover:bg-[#00ff88] text-neutral-300 hover:text-black border border-white/10 hover:border-[#00ff88] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                            title="Dribbble" aria-label="Dribbble">
                            <svg class="w-4 h-4 fill-current pointer-events-none" viewBox="0 0 24 24">
                                <path d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm7.98 5.7c1.32 1.68 2.13 3.78 2.25 6.09-.54-.12-2.82-.57-5.46-.24-.09-.21-.18-.45-.27-.69-.72-1.74-1.53-3.39-2.28-4.71 2.76-.36 4.77-.45 5.76-.45zm-7.98-3.93c2.43 0 4.65.84 6.42 2.25-.9.03-2.79.12-5.4.45-.96-1.59-1.89-3.06-2.58-4.08 1.14-.39 2.37-.62 3.56-.62zm-5.76 1.83c.72.99 1.62 2.43 2.55 3.96-3.36 1.05-6.96 1.77-7.98 1.83 1.05-2.61 3.09-4.71 5.43-5.79zm-4.47 7.89c.75-.06 4.02-.72 7.23-1.68.21.48.42.96.6 1.47-2.7 1.05-5.58 3.57-7.29 5.85-.45-1.68-.69-3.48-.54-5.64zm2.13 7.56c1.5-1.98 4.05-4.26 6.54-5.25.96 2.52 1.47 5.16 1.68 6.78-2.64 1.2-5.61 1.02-8.22-1.53zm9.84.15c-.21-1.47-.69-3.87-1.56-6.27 2.4-.36 4.47.09 5.01.21-.6 2.64-2.07 4.89-4.08 6.27-.09-.09-.18-.15-.27-.21z" />
                            </svg>
                        </a>

                        <!-- 5. Behance -->
                        <a href="{{ $settings['social_behance'] ?? 'https://behance.net' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-xl bg-white/[0.04] hover:bg-[#00ff88] text-neutral-300 hover:text-black border border-white/10 hover:border-[#00ff88] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                            title="Behance" aria-label="Behance">
                            <svg class="w-4 h-4 fill-current pointer-events-none" viewBox="0 0 24 24">
                                <path d="M22 7h-7v-2h7v2zm1.726 10c-.442 1.297-2.029 3-4.971 3-3.467 0-5.834-2.544-5.834-5.917 0-3.468 2.457-6.083 5.763-6.083 3.42 0 5.474 2.518 5.474 6.083h-8.24c.063 1.782 1.341 3.076 2.977 3.076 1.408 0 2.277-.696 2.673-1.624l2.158 1.465zm-2.316-4.437c-.073-1.258-.87-2.42-2.463-2.42-1.542 0-2.378 1.118-2.543 2.42h5.006zm-13.41 7.437h-8v-16h8.217c2.68 0 4.783 1.354 4.783 3.864 0 1.552-.806 2.766-2.091 3.393 1.737.587 2.591 2.052 2.591 3.93 0 2.871-2.298 4.813-5.5 4.813zm-5-10h4.316c1.19 0 2.184-.57 2.184-1.636 0-1.137-.927-1.636-2.184-1.636h-4.316v3.272zm0 7h4.783c1.378 0 2.422-.658 2.422-1.892 0-1.282-1.077-1.975-2.422-1.975h-4.783v3.867z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- =========================================================================
             4. MINIMALIST COLOPHON BAR
             ========================================================================= -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-mono text-neutral-400 pt-2">
            <div>
                &copy; {{ date('Y') }} <span class="text-neutral-300 font-medium">{{ $settings['site_copyright'] ?? ($settings['site_title'] ?? 'Abdullah Al Ahsan') }}</span>. All rights reserved.
            </div>

            <!-- Live Clock -->
            <div class="flex items-center gap-2 text-[11px] text-neutral-400">
                <span class="w-1.5 h-1.5 rounded-full bg-[#00ff88] animate-pulse"></span>
                <span id="footer-dev-clock">Sherpur, BD &bull; Loading local time...</span>
            </div>

            <!-- Smooth Back to Top Trigger -->
            <div>
                <a href="#mainContent"
                    onclick="event.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' });"
                    class="group inline-flex items-center gap-1 text-neutral-400 hover:text-[#00ff88] transition-colors cursor-pointer">
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
        class="fixed right-4 sm:right-6 md:right-10 bottom-4 sm:bottom-6 md:bottom-10 w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-[#141414] hover:bg-[#00ff88] text-[#00ff88] hover:text-[#050505] border border-white/15 hover:border-[#00ff88] flex items-center justify-center transition-all duration-300 hover:-translate-y-1 shadow-2xl shadow-black/80 cursor-pointer z-50 opacity-0 invisible translate-y-4 pointer-events-none"
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
                badge.classList.add('text-[#00ff88]');
                setTimeout(() => {
                    badge.textContent = oldText;
                    badge.classList.remove('text-[#00ff88]');
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
        const el = document.getElementById('footer-dev-clock');
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
