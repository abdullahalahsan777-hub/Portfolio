<!-- =========================================================================
     MODERN FOOTER SECTION (Developer Theme - GLINT)
     Modern Web & UI/UX Designer Inspired Architecture:
     1. Hero Call-To-Action (Statement Invitation & Direct Contact Pills)
     2. Focused 3-Column Architecture (Brand, Navigation, Newsletter)
     3. Minimalist Colophon Bar (Copyright, Live Local Clock, Back to Top)
     ========================================================================= -->
@php
    $accentColor = '#00ff88';
    $accentDark = '#070707';
    $siteName = $settings['site_logo_text'] ?? ($settings['site_title'] ?? 'glint');
    $siteEmail = $settings['contact_email'] ?? 'glint.info@gmail.com';
    $sitePhone = $settings['contact_phone'] ?? '+1 234 567 8900';
    $siteLocation = $settings['contact_location'] ?? 'San Francisco, CA / Remote';
    $siteBio = $settings['footer_bio'] ?? ($settings['site_description'] ?? 'Engineering scalable backend architectures, sub-second APIs, cloud infrastructure, and modern digital platforms.');
@endphp

<footer class="bg-[#070707] text-[#8c8c8c] pt-20 pb-12 border-t border-white/10 relative overflow-hidden font-['Plus_Jakarta_Sans']">
    <!-- Ambient Green Background Glow -->
    <div class="absolute bottom-0 right-1/4 w-[500px] h-[350px] bg-[#00ff88]/[0.06] rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute top-12 left-10 w-[300px] h-[200px] bg-[#00ff88]/[0.03] rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-16">

        <!-- =========================================================================
             1. HERO CTA BANNER (Statement Invitation)
             ========================================================================= -->
        <div class="p-8 sm:p-12 lg:p-14 rounded-3xl bg-gradient-to-br from-white/[0.04] via-[#0d0d0d] to-white/[0.02] border border-white/10 relative overflow-hidden shadow-2xl backdrop-blur-md">
            <div class="absolute top-0 right-0 w-72 h-72 bg-[#00ff88]/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <!-- Left: Headline & Availability -->
                <div class="lg:col-span-8 space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#00ff88]/10 border border-[#00ff88]/30 text-xs font-mono font-medium text-[#00ff88]">
                        <span class="w-2 h-2 rounded-full bg-[#00ff88] animate-pulse"></span>
                        <span>STATUS: AVAILABLE FOR NEW OPPORTUNITIES</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight font-['Outfit'] leading-[1.15]">
                        Have an ambitious system in mind?<br class="hidden sm:inline">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-neutral-400">Let's engineer something resilient.</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-neutral-400 max-w-xl leading-relaxed">
                        Specialized in full-stack Laravel engineering, decoupled cloud microservices, and sub-second mission-critical web APIs.
                    </p>
                </div>

                <!-- Right: Magnetic Action Buttons -->
                <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3.5 lg:items-end justify-center">
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#00ff88] hover:bg-[#00df76] text-[#070707] shadow-lg shadow-[#00ff88]/20 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-[#00ff88]/30 cursor-pointer">
                        <span>Initiate Project</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>

                    <!-- Copy Email Pill Button -->
                    <button type="button"
                        onclick="copyFooterEmail('{{ $siteEmail }}', this)"
                        class="group inline-flex items-center justify-between gap-3 px-5 py-3 rounded-full bg-white/5 hover:bg-white/10 border border-white/10 hover:border-[#00ff88]/40 text-xs font-mono text-neutral-300 hover:text-white transition-all duration-300 cursor-pointer"
                        title="Click to copy email">
                        <div class="flex items-center gap-2 truncate">
                            <svg class="w-4 h-4 text-[#00ff88] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="truncate">{{ $siteEmail }}</span>
                        </div>
                        <span class="copy-badge px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-white/10 group-hover:bg-[#00ff88] group-hover:text-black transition-colors shrink-0">Copy</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- =========================================================================
             2. MAIN 3-COLUMN ARCHITECTURAL GRID (Clean, Focused, Not Crowded)
             ========================================================================= -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-10 pb-12 border-b border-white/10">

            <!-- Column 1 (5 cols): Brand Identity, Coordinates & Social Cluster -->
            <div class="lg:col-span-5 space-y-6">
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 group">
                    @if (!empty($settings['two_word_logo_image']))
                        <img src="{{ asset($settings['two_word_logo_image']) }}" alt="{{ $siteName }}" class="h-8 max-w-[160px] object-contain">
                    @else
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-[#00ff88] to-[#00df76] text-[#070707] flex items-center justify-center font-black text-sm shadow-md shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                            ⬢
                        </div>
                        <span class="text-2xl font-black tracking-tight text-white font-['Outfit'] lowercase">
                            {{ $siteName }}<span class="text-[#00ff88] inline-block font-black text-3xl leading-none">.</span>
                        </span>
                    @endif
                </a>

                <!-- Bio Snippet -->
                <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed max-w-md">
                    {{ $siteBio }}
                </p>

                <!-- Location & Contact Chips -->
                <div class="flex flex-wrap items-center gap-2.5 pt-1 text-xs font-mono text-neutral-300">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/[0.03] border border-white/10">
                        <svg class="w-3.5 h-3.5 text-[#00ff88]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{!! strip_tags($siteLocation) !!}</span>
                    </span>

                    @if (!empty($sitePhone))
                        <a href="tel:{{ $sitePhone }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/[0.03] border border-white/10 hover:border-[#00ff88]/40 hover:text-[#00ff88] transition-colors">
                            <svg class="w-3.5 h-3.5 text-[#00ff88]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>{{ $sitePhone }}</span>
                        </a>
                    @endif
                </div>

                <!-- Modern Social Icon Cluster -->
                <div class="flex items-center gap-2.5 pt-2">
                    @php
                        $socials = [
                            ['key' => 'social_github', 'default' => 'https://github.com', 'title' => 'GitHub', 'svg' => 'M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z'],
                            ['key' => 'social_linkedin', 'default' => 'https://linkedin.com', 'title' => 'LinkedIn', 'svg' => 'M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z'],
                            ['key' => 'social_twitter', 'default' => 'https://twitter.com', 'title' => 'Twitter / X', 'svg' => 'M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z'],
                            ['key' => 'social_dribbble', 'default' => null, 'title' => 'Dribbble', 'svg' => 'M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm7.98 5.7c1.32 1.68 2.13 3.78 2.25 6.09-.54-.12-2.82-.57-5.46-.24-.09-.21-.18-.45-.27-.69-.72-1.74-1.53-3.39-2.28-4.71 2.76-.36 4.77-.45 5.76-.45zm-7.98-3.93c2.43 0 4.65.84 6.42 2.25-.9.03-2.79.12-5.4.45-.96-1.59-1.89-3.06-2.58-4.08 1.14-.39 2.37-.62 3.56-.62zm-5.76 1.83c.72.99 1.62 2.43 2.55 3.96-3.36 1.05-6.96 1.77-7.98 1.83 1.05-2.61 3.09-4.71 5.43-5.79zm-4.47 7.89c.75-.06 4.02-.72 7.23-1.68.21.48.42.96.6 1.47-2.7 1.05-5.58 3.57-7.29 5.85-.45-1.68-.69-3.48-.54-5.64zm2.13 7.56c1.5-1.98 4.05-4.26 6.54-5.25.96 2.52 1.47 5.16 1.68 6.78-2.64 1.2-5.61 1.02-8.22-1.53zm9.84.15c-.21-1.47-.69-3.87-1.56-6.27 2.4-.36 4.47.09 5.01.21-.6 2.64-2.07 4.89-4.08 6.27-.09-.09-.18-.15-.27-.21z'],
                            ['key' => 'social_behance', 'default' => null, 'title' => 'Behance', 'svg' => 'M22 7h-7v-2h7v2zm1.726 10c-.442 1.297-2.029 3-4.971 3-3.467 0-5.834-2.544-5.834-5.917 0-3.468 2.457-6.083 5.763-6.083 3.42 0 5.474 2.518 5.474 6.083h-8.24c.063 1.782 1.341 3.076 2.977 3.076 1.408 0 2.277-.696 2.673-1.624l2.158 1.465zm-2.316-4.437c-.073-1.258-.87-2.42-2.463-2.42-1.542 0-2.378 1.118-2.543 2.42h5.006zm-13.41 7.437h-8v-16h8.217c2.68 0 4.783 1.354 4.783 3.864 0 1.552-.806 2.766-2.091 3.393 1.737.587 2.591 2.052 2.591 3.93 0 2.871-2.298 4.813-5.5 4.813zm-5-10h4.316c1.19 0 2.184-.57 2.184-1.636 0-1.137-.927-1.636-2.184-1.636h-4.316v3.272zm0 7h4.783c1.378 0 2.422-.658 2.422-1.892 0-1.282-1.077-1.975-2.422-1.975h-4.783v3.867z'],
                        ];
                    @endphp
                    @foreach ($socials as $soc)
                        @php $url = $settings[$soc['key']] ?? $soc['default']; @endphp
                        @if (!empty($url))
                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                                class="w-9 h-9 rounded-xl bg-white/[0.04] hover:bg-[#00ff88] text-neutral-300 hover:text-black border border-white/10 hover:border-[#00ff88] flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-[#00ff88]/25"
                                title="{{ $soc['title'] }}">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="{{ $soc['svg'] }}" />
                                </svg>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Column 2 (3 cols): Navigation Hub -->
            <div class="lg:col-span-3 space-y-4">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#00ff88]"></span>
                    <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-white">// EXPLORE</h4>
                </div>
                <div class="grid grid-cols-2 gap-y-2.5 gap-x-6 text-xs text-neutral-400">
                    <div>
                        <a href="{{ route('home') }}" class="group flex items-center gap-1.5 hover:text-[#00ff88] transition-colors py-1">
                            <span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors font-mono">&rarr;</span>
                            <span>Home</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('about') }}" class="group flex items-center gap-1.5 hover:text-[#00ff88] transition-colors py-1">
                            <span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors font-mono">&rarr;</span>
                            <span>About</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('portfolio') }}" class="group flex items-center gap-1.5 hover:text-[#00ff88] transition-colors py-1">
                            <span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors font-mono">&rarr;</span>
                            <span>Portfolio</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('gallery') }}" class="group flex items-center gap-1.5 hover:text-[#00ff88] transition-colors py-1">
                            <span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors font-mono">&rarr;</span>
                            <span>Gallery</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('blog') }}" class="group flex items-center gap-1.5 hover:text-[#00ff88] transition-colors py-1">
                            <span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors font-mono">&rarr;</span>
                            <span>Articles</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('faq') }}" class="group flex items-center gap-1.5 hover:text-[#00ff88] transition-colors py-1">
                            <span class="text-neutral-600 group-hover:text-[#00ff88] transition-colors font-mono">&rarr;</span>
                            <span>FAQs</span>
                        </a>
                    </div>
                    <div class="col-span-2">
                        <a href="{{ route('contact') }}" class="group flex items-center gap-1.5 hover:text-[#00ff88] transition-colors py-1 font-semibold text-white">
                            <span class="text-[#00ff88] font-mono">&rarr;</span>
                            <span>Contact & Inquiries</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Column 3 (4 cols): Newsletter & Response Commitment -->
            <div class="lg:col-span-4 space-y-4">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#00ff88]"></span>
                    <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-white">// STAY IN THE LOOP</h4>
                </div>
                <p class="text-xs text-neutral-400 leading-relaxed">
                    Subscribe for curated articles on backend system design, Laravel scalability, and modern software craft.
                </p>

                <!-- Newsletter Form -->
                @include('frontend.partials.newsletter', [
                    'accent' => '#00ff88',
                    'btnText' => 'text-[#070707] font-bold',
                    'inputBg' => 'bg-[#121212]',
                    'borderColor' => 'border-white/10',
                ])

                <!-- Turnaround Badge -->
                <div class="flex items-center gap-2 text-[11px] font-mono text-neutral-400 pt-1">
                    <span class="w-2 h-2 rounded-full bg-[#00ff88]/60"></span>
                    <span>Average reply speed: under 24 hours</span>
                </div>
            </div>

        </div>

        <!-- =========================================================================
             3. COLOPHON & MICRO-INTERACTIONS SUB-FOOTER
             ========================================================================= -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-mono text-neutral-400">
            <div>
                &copy; {{ date('Y') }} <strong class="text-white">{{ $settings['site_copyright'] ?? ($settings['site_title'] ?? 'Abdullah Al Ahsan') }}</strong>. All rights reserved.
            </div>

            <!-- Real-Time Local Time Indicator -->
            <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/[0.03] border border-white/5 text-[11px] text-neutral-300">
                <span class="w-1.5 h-1.5 rounded-full bg-[#00ff88] animate-pulse"></span>
                <span id="footer-dev-clock">Loading local time...</span>
            </div>

            <!-- Smooth Back to Top Trigger -->
            <div>
                <a href="#mainContent"
                    onclick="event.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' });"
                    class="group inline-flex items-center gap-1.5 text-neutral-400 hover:text-[#00ff88] transition-colors cursor-pointer">
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
        class="fixed right-4 sm:right-6 md:right-10 bottom-4 sm:bottom-6 md:bottom-10 w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-[#141414] hover:bg-[#00ff88] text-[#00ff88] hover:text-[#070707] border border-white/15 hover:border-[#00ff88] flex items-center justify-center transition-all duration-300 hover:-translate-y-1 shadow-2xl shadow-black/80 cursor-pointer z-50 opacity-0 invisible translate-y-4 pointer-events-none"
        title="Back to top" aria-label="Back to top">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" />
        </svg>
    </a>
</footer>

<!-- Shared JavaScript Helpers for Modern Footer -->
<script>
    // 1. Email Clipboard Copy Helper
    function copyFooterEmail(email, btn) {
        if (!email) return;
        navigator.clipboard.writeText(email).then(() => {
            const badge = btn.querySelector('.copy-badge');
            if (badge) {
                const oldText = badge.textContent;
                badge.textContent = 'Copied! ✓';
                badge.classList.add('bg-[#00ff88]', 'text-black');
                setTimeout(() => {
                    badge.textContent = oldText;
                    badge.classList.remove('bg-[#00ff88]', 'text-black');
                }, 2000);
            }
            if (typeof toastr !== 'undefined') {
                toastr.success('Email address copied to clipboard.', 'Copied!');
            }
        }).catch(err => {
            console.error('Copy failed:', err);
        });
    }

    // 2. Real-Time Local Time Clock (Sherpur / Dhaka BD - UTC+6 default)
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

    // 3. Floating Back to Top Button Auto-Show / Auto-Hide on Scroll
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
