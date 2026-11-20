<!-- =========================================================================
     ULTRA-MODERN EDITORIAL FOOTER (Developer Theme - GLINT)
     Inspired by Awwwards, Linear.app & Studio Freight:
     - Unified single-canvas architectural surface (no clunky floating boxes)
     - High-impact kinetic hero invitation with large interactive email hook
     - Clean 4-column balanced architectural grid with delicate hairline dividers
     - Dramatic "Ghost Wordmark" backdrop anchor (Awwwards signature aesthetic)
     - Live local clock & smooth colophon micro-interactions
     ========================================================================= -->
@php
    $siteName = $settings['site_logo_text'] ?? ($settings['site_title'] ?? 'glint');
    $siteEmail = $settings['contact_email'] ?? 'glint.info@gmail.com';
    $sitePhone = $settings['contact_phone'] ?? '+1 234 567 8900';
    $siteLocation = $settings['contact_location'] ?? 'San Francisco, CA / Remote';
    $siteBio = $settings['footer_bio'] ?? ($settings['site_description'] ?? 'Engineering scalable backend architectures, sub-second APIs, cloud infrastructure, and modern digital platforms.');
    $cleanLocation = strip_tags(str_replace(['<br>', '<br/>', '<br />'], ', ', $siteLocation));
@endphp

<footer class="relative bg-[#050505] text-[#999999] pt-24 pb-12 overflow-hidden font-['Plus_Jakarta_Sans'] border-t border-white/[0.08]">
    <!-- Ambient Radial Glow Centered at Top Edge -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[350px] bg-[#00ff88]/[0.06] rounded-full blur-[160px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-20">

        <!-- =========================================================================
             1. THE KINETIC HERO STATEMENT (Unboxed, Magnetic, High-Impact)
             ========================================================================= -->
        <div class="space-y-8 pb-16 border-b border-white/[0.08]">
            <!-- Live Availability Pill -->
            <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-white/[0.03] border border-white/10 text-xs font-mono text-neutral-300">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#00ff88] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-[#00ff88]"></span>
                </span>
                <span class="tracking-wide">Available for backend architectures &amp; cloud systems</span>
            </div>

            <!-- Bold Invitation Heading & Magnetic Email -->
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
                <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col items-start lg:items-end gap-4">
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
             2. CLEAN 4-COLUMN BALANCED ARCHITECTURAL GRID
             ========================================================================= -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 pb-16 border-b border-white/[0.08]">

            <!-- Column 1 (4 cols): Brand & Elevator Bio -->
            <div class="lg:col-span-4 space-y-5">
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

                <!-- Location & Coordinates text -->
                <div class="space-y-1.5 text-xs text-neutral-400 pt-1">
                    <div class="flex items-center gap-2">
                        <span class="text-neutral-500 font-mono">Location:</span>
                        <span class="text-neutral-300 font-medium">{{ $cleanLocation }}</span>
                    </div>
                    @if (!empty($sitePhone))
                        <div class="flex items-center gap-2">
                            <span class="text-neutral-500 font-mono">Direct:</span>
                            <a href="tel:{{ $sitePhone }}" class="text-neutral-300 hover:text-[#00ff88] transition-colors font-mono">{{ $sitePhone }}</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Column 2 (2 cols): Explore / Navigation Hub -->
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

            <!-- Column 3 (2 cols): Social & Network -->
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

            <!-- Column 4 (4 cols): Dispatch & Newsletter -->
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

                <div class="flex items-center gap-2 text-[11px] font-mono text-neutral-400 pt-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#00ff88]"></span>
                    <span>No spam. One-click unsubscribe anytime.</span>
                </div>
            </div>

        </div>

        <!-- =========================================================================
             3. DRAMATIC "GHOST WORDMARK" ANCHOR (Awwwards / Studio Freight Signature)
             ========================================================================= -->
        <div class="pt-8 pb-4 text-center overflow-hidden select-none pointer-events-none opacity-[0.06] hover:opacity-[0.10] transition-opacity duration-700">
            <span class="text-[12vw] font-black tracking-tighter uppercase font-['Outfit'] leading-none block whitespace-nowrap text-transparent bg-clip-text bg-gradient-to-b from-white to-transparent">
                {{ $siteName }}
            </span>
        </div>

        <!-- =========================================================================
             4. MINIMALIST COLOPHON BAR
             ========================================================================= -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-mono text-neutral-400 pt-4 border-t border-white/[0.08]">
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
