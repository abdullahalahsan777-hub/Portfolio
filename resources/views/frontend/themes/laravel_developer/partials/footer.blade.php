<!-- =========================================================================
     ULTRA-MODERN EDITORIAL FOOTER (Full-Stack Laravel Developer Theme)
     Claude AI & Awwwards Inspired Architecture:
     1. Kinetic Hero Statement (Unboxed, Magnetic, High-Impact)
     2. Statement Brand Wordmark Divider (Positioned as central architectural bridge)
     3. Balanced 4-Column Grid with Newsletter & 5 Social Icon Buttons
     4. Refined Minimalist Colophon Bar (Live local clock & smooth back to top)
     ========================================================================= -->
@php
    $siteName = $settings['site_logo_text'] ?? ($settings['site_title'] ?? 'abdullah ahsan');
    $siteEmail = $settings['contact_email'] ?? 'abdullahalahsan@hotmail.com';
    $sitePhone = $settings['contact_phone'] ?? '+8801718926673';
    $siteLocation = $settings['contact_location'] ?? '53/20, Razbollovpur, Sherpur Town, Bangladesh';
    $siteBio = $settings['footer_bio'] ?? 'Highly motivated and detail-oriented Full-Stack Laravel Developer with 8+ years of expertise in enterprise backend architecture, RESTful API design, database modeling, and modern web application development. Certified Level-3 NSDA professional.';
    $cleanLocation = strip_tags(str_replace(['<br>', '<br/>', '<br />'], ', ', $siteLocation));
@endphp

<footer class="relative bg-[#050505] text-[#999999] pt-20 pb-12 overflow-hidden font-['Plus_Jakarta_Sans'] border-t border-white/[0.08]">
    <!-- Ambient Radial Glow Centered at Top Edge -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[850px] h-[350px] bg-[var(--theme-primary,#00e5ff)]/[0.07] rounded-full blur-[170px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-14">

        <!-- =========================================================================
             1. THE KINETIC HERO STATEMENT (Unboxed, Magnetic, High-Impact)
             ========================================================================= -->
        <div class="space-y-6">
            <!-- Live Availability Pill -->
            <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-white/[0.03] border border-white/10 text-xs font-mono text-neutral-300">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[var(--theme-primary,#00e5ff)] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-[var(--theme-primary,#00e5ff)]"></span>
                </span>
                <span class="tracking-wide">Available for enterprise systems &amp; contracts</span>
            </div>

            <!-- Bold Invitation Heading & Magnetic Action Buttons -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end justify-between">
                <div class="lg:col-span-8 space-y-4">
                    <h2 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight font-['Outfit'] leading-[1.1]">
                        Have an ambitious vision?<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-neutral-200 to-[var(--theme-primary,#00e5ff)]">
                            Let's build something exceptional.
                        </span>
                    </h2>
                    <p class="text-sm sm:text-base text-neutral-400 max-w-2xl leading-relaxed">
                        Full-stack architectural engineering, mission-critical Laravel backends, high-throughput micro-APIs, and enterprise POS/ERP systems.
                    </p>
                </div>

                <!-- Primary Action & Direct Contact -->
                <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col items-start lg:items-end gap-3.5">
                    <a href="{{ route('contact') }}"
                        class="group inline-flex items-center gap-3 px-8 py-4 rounded-full bg-[var(--theme-primary,#00e5ff)] text-[var(--theme-on-primary,#000000)] font-bold text-xs uppercase tracking-wider transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-[var(--theme-primary,#00e5ff)]/25">
                        <span>Initiate Project</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1 group-hover:-translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>

                    <!-- Minimalist Copy Email Pill -->
                    <button type="button"
                        onclick="copyFooterEmail('{{ $siteEmail }}', this)"
                        class="group inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-white/[0.03] hover:bg-white/[0.08] border border-white/10 hover:border-[var(--theme-primary,#00e5ff)]/40 text-xs font-mono text-neutral-300 hover:text-white transition-all cursor-pointer">
                        <svg class="w-3.5 h-3.5 text-[var(--theme-primary,#00e5ff)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $siteEmail }}</span>
                        <span class="copy-badge ml-1 text-[10px] text-neutral-400 group-hover:text-[var(--theme-primary,#00e5ff)] transition-colors">copy</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- =========================================================================
             2. STATEMENT BRAND WORDMARK DIVIDER (Positioned as Central Bridge)
             ========================================================================= -->
        <div class="py-4 sm:py-6 border-y border-white/[0.08] overflow-hidden select-none pointer-events-none text-center relative">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-[var(--theme-primary,#00e5ff)]/[0.03] to-transparent pointer-events-none"></div>
            <span class="text-[8vw] sm:text-[9.5vw] font-black tracking-tighter uppercase font-['Outfit'] leading-none block whitespace-nowrap text-transparent bg-clip-text bg-gradient-to-r from-white/10 via-[var(--theme-primary,#00e5ff)]/25 to-white/10">
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
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-[var(--theme-primary,#00e5ff)] to-blue-600 text-black flex items-center justify-center font-black text-sm shadow-md shadow-[var(--theme-primary,#00e5ff)]/20 group-hover:scale-105 transition-transform">
                        ◈
                    </div>
                    <span class="text-2xl font-black tracking-tight text-white font-['Outfit'] lowercase">
                        {{ $siteName }}<span class="text-[var(--theme-primary,#00e5ff)] inline-block font-black text-3xl leading-none">.</span>
                    </span>
                </a>

                <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed max-w-sm">
                    {{ $siteBio }}
                </p>

                <!-- Location & Direct Coordinates -->
                <div class="space-y-1 text-xs text-neutral-400 pt-1">
                    <div class="flex items-start gap-2">
                        <span class="text-neutral-500 font-mono shrink-0">Location:</span>
                        <span class="text-neutral-300 font-medium">{{ $cleanLocation }}</span>
                    </div>
                    @if (!empty($sitePhone))
                        <div class="flex items-center gap-2">
                            <span class="text-neutral-500 font-mono shrink-0">Direct:</span>
                            <a href="tel:{{ $sitePhone }}" class="text-neutral-300 hover:text-[var(--theme-primary,#00e5ff)] transition-colors font-mono">{{ $sitePhone }}</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Column 2 (2 cols): Sitemap / Navigation Hub -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-white">Sitemap</h4>
                <ul class="space-y-2 text-xs text-neutral-400">
                    <li><a href="{{ route('home') }}" class="hover:text-[var(--theme-primary,#00e5ff)] transition-colors inline-flex items-center gap-1 group"><span>Home</span><span class="text-neutral-600 group-hover:text-[var(--theme-primary,#00e5ff)] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-[var(--theme-primary,#00e5ff)] transition-colors inline-flex items-center gap-1 group"><span>About</span><span class="text-neutral-600 group-hover:text-[var(--theme-primary,#00e5ff)] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('portfolio') }}" class="hover:text-[var(--theme-primary,#00e5ff)] transition-colors inline-flex items-center gap-1 group"><span>Portfolio</span><span class="text-neutral-600 group-hover:text-[var(--theme-primary,#00e5ff)] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('gallery') }}" class="hover:text-[var(--theme-primary,#00e5ff)] transition-colors inline-flex items-center gap-1 group"><span>Gallery</span><span class="text-neutral-600 group-hover:text-[var(--theme-primary,#00e5ff)] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('blog') }}" class="hover:text-[var(--theme-primary,#00e5ff)] transition-colors inline-flex items-center gap-1 group"><span>Articles</span><span class="text-neutral-600 group-hover:text-[var(--theme-primary,#00e5ff)] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-[var(--theme-primary,#00e5ff)] transition-colors inline-flex items-center gap-1 group"><span>FAQ</span><span class="text-neutral-600 group-hover:text-[var(--theme-primary,#00e5ff)] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    <li><a href="{{ route('contact') }}" class="text-white hover:text-[var(--theme-primary,#00e5ff)] font-semibold transition-colors inline-flex items-center gap-1 group"><span>Contact</span><span class="text-[var(--theme-primary,#00e5ff)] transition-colors">&nearr;</span></a></li>
                </ul>
            </div>

            <!-- Column 3 (2 cols): Network / Channels -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-white">Network</h4>
                <ul class="space-y-2 text-xs text-neutral-400">
                    @if (!empty($settings['social_github']))
                        <li><a href="{{ $settings['social_github'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[var(--theme-primary,#00e5ff)] transition-colors inline-flex items-center gap-1 group"><span>GitHub</span><span class="text-neutral-600 group-hover:text-[var(--theme-primary,#00e5ff)] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    @endif
                    @if (!empty($settings['social_linkedin']))
                        <li><a href="{{ $settings['social_linkedin'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[var(--theme-primary,#00e5ff)] transition-colors inline-flex items-center gap-1 group"><span>LinkedIn</span><span class="text-neutral-600 group-hover:text-[var(--theme-primary,#00e5ff)] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    @endif
                    @if (!empty($settings['social_twitter']))
                        <li><a href="{{ $settings['social_twitter'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[var(--theme-primary,#00e5ff)] transition-colors inline-flex items-center gap-1 group"><span>Twitter / X</span><span class="text-neutral-600 group-hover:text-[var(--theme-primary,#00e5ff)] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    @endif
                    @if (!empty($settings['social_behance']))
                        <li><a href="{{ $settings['social_behance'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[var(--theme-primary,#00e5ff)] transition-colors inline-flex items-center gap-1 group"><span>Behance</span><span class="text-neutral-600 group-hover:text-[var(--theme-primary,#00e5ff)] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    @endif
                    @if (!empty($settings['social_facebook']))
                        <li><a href="{{ $settings['social_facebook'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[var(--theme-primary,#00e5ff)] transition-colors inline-flex items-center gap-1 group"><span>Facebook</span><span class="text-neutral-600 group-hover:text-[var(--theme-primary,#00e5ff)] transition-colors opacity-0 group-hover:opacity-100">&nearr;</span></a></li>
                    @endif
                </ul>
            </div>

            <!-- Column 4 (4 cols): Dispatch & 5 Social Icons (As shown in image markup!) -->
            <div class="lg:col-span-4 space-y-4">
                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-white">System Dispatch</h4>
                <p class="text-xs text-neutral-400 leading-relaxed">
                    Subscribe for occasional engineering memos on high-concurrency Laravel architecture, distributed systems, and modern web craft.
                </p>

                <!-- Seamless Integrated Newsletter Input -->
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-2 pt-1">
                    @csrf
                    <div class="relative flex items-center">
                        <input type="email" name="email" required placeholder="Enter your email address..."
                            class="w-full pl-4 pr-12 py-3 rounded-xl bg-white/[0.04] border border-white/10 text-xs text-white placeholder-neutral-500 focus:outline-none focus:border-[var(--theme-primary,#00e5ff)]/60 focus:bg-white/[0.06] transition-all">
                        <button type="submit"
                            class="absolute right-1.5 w-9 h-9 rounded-lg bg-[var(--theme-primary,#00e5ff)] hover:opacity-90 text-[var(--theme-on-primary,#000000)] flex items-center justify-center transition-transform hover:scale-105 cursor-pointer"
                            title="Subscribe">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </form>

                <div class="flex items-center gap-2 text-[11px] font-mono text-neutral-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-[var(--theme-primary,#00e5ff)]"></span>
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
                            class="w-9 h-9 rounded-xl bg-white/[0.04] hover:bg-[var(--theme-primary,#00e5ff)] text-neutral-300 hover:text-black border border-white/10 hover:border-[var(--theme-primary,#00e5ff)] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                            title="GitHub" aria-label="GitHub">
                            <svg class="w-4 h-4 fill-current pointer-events-none" viewBox="0 0 24 24">
                                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z" />
                            </svg>
                        </a>

                        <!-- 2. LinkedIn -->
                        <a href="{{ $settings['social_linkedin'] ?? 'https://linkedin.com' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-xl bg-white/[0.04] hover:bg-[var(--theme-primary,#00e5ff)] text-neutral-300 hover:text-black border border-white/10 hover:border-[var(--theme-primary,#00e5ff)] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                            title="LinkedIn" aria-label="LinkedIn">
                            <svg class="w-4 h-4 fill-current pointer-events-none" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                            </svg>
                        </a>

                        <!-- 3. Twitter / X -->
                        <a href="{{ $settings['social_twitter'] ?? 'https://twitter.com' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-xl bg-white/[0.04] hover:bg-[var(--theme-primary,#00e5ff)] text-neutral-300 hover:text-black border border-white/10 hover:border-[var(--theme-primary,#00e5ff)] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                            title="Twitter / X" aria-label="Twitter / X">
                            <svg class="w-4 h-4 fill-current pointer-events-none" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>

                        <!-- 4. Behance -->
                        <a href="{{ $settings['social_behance'] ?? 'https://behance.net' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-xl bg-white/[0.04] hover:bg-[var(--theme-primary,#00e5ff)] text-neutral-300 hover:text-black border border-white/10 hover:border-[var(--theme-primary,#00e5ff)] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                            title="Behance" aria-label="Behance">
                            <svg class="w-4 h-4 fill-current pointer-events-none" viewBox="0 0 24 24">
                                <path d="M22 7h-7v-2h7v2zm1.726 10c-.442 1.297-2.029 3-4.971 3-3.467 0-5.834-2.544-5.834-5.917 0-3.468 2.457-6.083 5.763-6.083 3.42 0 5.474 2.518 5.474 6.083h-8.24c.063 1.782 1.341 3.076 2.977 3.076 1.408 0 2.277-.696 2.673-1.624l2.158 1.465zm-2.316-4.437c-.073-1.258-.87-2.42-2.463-2.42-1.542 0-2.378 1.118-2.543 2.42h5.006zm-13.41 7.437h-8v-16h8.217c2.68 0 4.783 1.354 4.783 3.864 0 1.552-.806 2.766-2.091 3.393 1.737.587 2.591 2.052 2.591 3.93 0 2.871-2.298 4.813-5.5 4.813zm-5-10h4.316c1.19 0 2.184-.57 2.184-1.636 0-1.137-.927-1.636-2.184-1.636h-4.316v3.272zm0 7h4.783c1.378 0 2.422-.658 2.422-1.892 0-1.282-1.077-1.975-2.422-1.975h-4.783v3.867z" />
                            </svg>
                        </a>

                        <!-- 5. Facebook -->
                        <a href="{{ $settings['social_facebook'] ?? 'https://facebook.com' }}" target="_blank" rel="noopener noreferrer"
                            class="w-9 h-9 rounded-xl bg-white/[0.04] hover:bg-[var(--theme-primary,#00e5ff)] text-neutral-300 hover:text-black border border-white/10 hover:border-[var(--theme-primary,#00e5ff)] flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-sm"
                            title="Facebook" aria-label="Facebook">
                            <svg class="w-4 h-4 fill-current pointer-events-none" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
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
                <span class="w-1.5 h-1.5 rounded-full bg-[var(--theme-primary,#00e5ff)] animate-pulse"></span>
                <span id="footer-lar-clock">Sherpur, BD &bull; Loading local time...</span>
            </div>

            <!-- Smooth Back to Top Trigger -->
            <div>
                <a href="#mainContent"
                    onclick="event.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' });"
                    class="group inline-flex items-center gap-1 text-neutral-400 hover:text-[var(--theme-primary,#00e5ff)] transition-colors cursor-pointer">
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
        class="fixed right-4 sm:right-6 md:right-10 bottom-4 sm:bottom-6 md:bottom-10 w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-[#141414] hover:bg-[var(--theme-primary,#00e5ff)] text-[var(--theme-primary,#00e5ff)] hover:text-black border border-white/15 hover:border-[var(--theme-primary,#00e5ff)] flex items-center justify-center transition-all duration-300 hover:-translate-y-1 shadow-2xl shadow-black/80 cursor-pointer z-50 opacity-0 invisible translate-y-4 pointer-events-none"
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
                badge.classList.add('text-[var(--theme-primary,#00e5ff)]');
                setTimeout(() => {
                    badge.textContent = oldText;
                    badge.classList.remove('text-[var(--theme-primary,#00e5ff)]');
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
        const el = document.getElementById('footer-lar-clock');
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
