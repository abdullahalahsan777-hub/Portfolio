<!-- =========================================================================
     STANDARDIZED MODERN FOOTER (Digital Designer & Illustrator Theme)
     Modern Web & UI/UX Designer Inspired Architecture (Dual Light/Dark Mode):
     1. Hero Call-To-Action (Statement Art & Creative Collaboration)
     2. Focused 3-Column Architecture (Brand, Navigation, Newsletter)
     3. Minimalist Colophon Bar (Copyright, Live Local Clock, Back to Top)
     ========================================================================= -->
@php
    $accentColor = '#e26d9b';
    $siteName = $settings['site_logo_text'] ?? ($settings['site_title'] ?? 'Alex');
    $siteEmail = $settings['contact_email'] ?? 'contact@alexdesign.studio';
    $sitePhone = $settings['contact_phone'] ?? '+1 234 567 8900';
    $siteLocation = $settings['contact_location'] ?? 'Paris, France / Worldwide';
    $siteBio = $settings['footer_bio'] ?? ($settings['site_description'] ?? 'Crafting bespoke digital interfaces, expressive 3D brand experiences, typography systems, and modern editorial illustrations.');
@endphp

<footer class="bg-[#eef1f5] dark:bg-[#0c0d10] text-[#4b5563] dark:text-[#9aa0aa] pt-20 pb-12 border-t border-black/10 dark:border-white/10 relative overflow-hidden font-['Plus_Jakarta_Sans'] transition-colors duration-300">
    <!-- Subtle Botanical Floral Backdrop -->
    <div class="absolute bottom-0 right-10 w-96 h-96 opacity-10 dark:opacity-5 pointer-events-none">
        <img src="{{ asset('images/digital_designer_illustrator/flower.jpg') }}" alt="" class="w-full h-full object-contain filter grayscale contrast-125">
    </div>

    <!-- Ambient Pink Glow Backdrop -->
    <div class="absolute bottom-0 right-1/4 w-[450px] h-[300px] bg-[#e26d9b]/[0.08] dark:bg-[#e26d9b]/[0.05] rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-16">

        <!-- =========================================================================
             1. HERO CTA BANNER (Creative Studio Collaboration)
             ========================================================================= -->
        <div class="p-8 sm:p-12 lg:p-14 rounded-3xl bg-white/70 dark:bg-white/[0.03] border border-black/10 dark:border-white/10 relative overflow-hidden shadow-xl dark:shadow-2xl backdrop-blur-md">
            <div class="absolute top-0 right-0 w-72 h-72 bg-[#e26d9b]/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <!-- Left: Headline & Availability -->
                <div class="lg:col-span-8 space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#e26d9b]/10 border border-[#e26d9b]/30 text-xs font-mono font-medium text-[#e26d9b]">
                        <span class="w-2 h-2 rounded-full bg-[#e26d9b] animate-pulse"></span>
                        <span>3D ART &bull; DIGITAL CRAFT &bull; EDITORIAL ILLUSTRATION</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl lg:text-5xl font-bold text-[#111215] dark:text-white tracking-tight font-serif leading-[1.15]">
                        Looking for standout creative direction?<br class="hidden sm:inline">
                        <span class="italic font-normal text-[#e26d9b]">Let's craft something unforgettable.</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4b5563] dark:text-neutral-400 max-w-xl leading-relaxed">
                        Available for select brand commissions, 3D character design, digital art direction, and immersive web experiences.
                    </p>
                </div>

                <!-- Right: Action Buttons -->
                <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3.5 lg:items-end justify-center">
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#e26d9b] hover:bg-[#d65b89] text-white shadow-lg shadow-[#e26d9b]/25 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-[#e26d9b]/35 cursor-pointer">
                        <span>Say Hello</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>

                    <!-- Copy Email Pill Button -->
                    <button type="button"
                        onclick="copyFooterEmail('{{ $siteEmail }}', this)"
                        class="group inline-flex items-center justify-between gap-3 px-5 py-3 rounded-full bg-black/5 dark:bg-white/5 hover:bg-black/10 dark:hover:bg-white/10 border border-black/10 dark:border-white/10 hover:border-[#e26d9b]/40 text-xs font-mono text-[#111215] dark:text-neutral-300 transition-all duration-300 cursor-pointer"
                        title="Click to copy email">
                        <div class="flex items-center gap-2 truncate">
                            <svg class="w-4 h-4 text-[#e26d9b] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="truncate">{{ $siteEmail }}</span>
                        </div>
                        <span class="copy-badge px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-black/10 dark:bg-white/10 group-hover:bg-[#e26d9b] group-hover:text-white transition-colors shrink-0">Copy</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- =========================================================================
             2. MAIN 3-COLUMN ARCHITECTURAL GRID
             ========================================================================= -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-10 pb-12 border-b border-black/10 dark:border-white/10">

            <!-- Column 1 (5 cols): Brand Identity & Coordinates -->
            <div class="lg:col-span-5 space-y-6">
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 group">
                    @if (!empty($settings['two_word_logo_image']))
                        <img src="{{ asset($settings['two_word_logo_image']) }}" alt="{{ $siteName }}" class="h-8 max-w-[160px] object-contain">
                    @else
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-[#ffffff] to-[#fff0f5] text-[#e26d9b] border border-[#e26d9b]/30 dark:from-white/15 dark:to-white/5 dark:text-white dark:border-white/10 flex items-center justify-center font-serif italic text-base shadow-sm group-hover:scale-105 transition-transform">
                            AW
                        </div>
                        <span class="text-2xl font-bold tracking-tight text-[#111215] dark:text-white font-['Outfit']">
                            {{ $siteName }}<span class="text-[#e26d9b] inline-block font-black text-3xl leading-none">.</span>
                        </span>
                    @endif
                </a>

                <!-- Bio Snippet -->
                <p class="text-xs sm:text-sm text-[#4b5563] dark:text-neutral-400 leading-relaxed max-w-md">
                    {{ $siteBio }}
                </p>

                <!-- Location & Contact Chips -->
                <div class="flex flex-wrap items-center gap-2.5 pt-1 text-xs font-mono text-[#374151] dark:text-neutral-300">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-black/[0.04] dark:bg-white/[0.03] border border-black/10 dark:border-white/10">
                        <svg class="w-3.5 h-3.5 text-[#e26d9b]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{!! strip_tags($siteLocation) !!}</span>
                    </span>

                    @if (!empty($sitePhone))
                        <a href="tel:{{ $sitePhone }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-black/[0.04] dark:bg-white/[0.03] border border-black/10 dark:border-white/10 hover:border-[#e26d9b]/40 hover:text-[#e26d9b] transition-colors">
                            <svg class="w-3.5 h-3.5 text-[#e26d9b]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                            ['key' => 'social_dribbble', 'default' => 'https://dribbble.com', 'title' => 'Dribbble', 'icon' => 'ph ph-dribbble-logo'],
                            ['key' => 'social_behance', 'default' => 'https://behance.net', 'title' => 'Behance', 'icon' => 'ph ph-behance-logo'],
                            ['key' => 'social_instagram', 'default' => null, 'title' => 'Instagram', 'icon' => 'ph ph-instagram-logo'],
                            ['key' => 'social_linkedin', 'default' => 'https://linkedin.com', 'title' => 'LinkedIn', 'icon' => 'ph ph-linkedin-logo'],
                            ['key' => 'social_github', 'default' => null, 'title' => 'GitHub', 'icon' => 'ph ph-github-logo'],
                        ];
                    @endphp
                    @foreach ($socials as $soc)
                        @php $url = $settings[$soc['key']] ?? $soc['default']; @endphp
                        @if (!empty($url))
                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                                class="w-9 h-9 rounded-xl bg-black/[0.04] dark:bg-white/[0.04] hover:bg-[#e26d9b] text-[#111215] dark:text-neutral-300 hover:text-white border border-black/10 dark:border-white/10 hover:border-[#e26d9b] flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-[#e26d9b]/25"
                                title="{{ $soc['title'] }}">
                                <i class="{{ $soc['icon'] }} text-base"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Column 2 (3 cols): Navigation Hub -->
            <div class="lg:col-span-3 space-y-4">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#e26d9b]"></span>
                    <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-[#111215] dark:text-white">// EXPLORE</h4>
                </div>
                <div class="grid grid-cols-2 gap-y-2.5 gap-x-6 text-xs text-[#4b5563] dark:text-neutral-400">
                    <div>
                        <a href="{{ route('home') }}" class="group flex items-center gap-1.5 hover:text-[#e26d9b] transition-colors py-1">
                            <span class="text-neutral-400 group-hover:text-[#e26d9b] transition-colors font-mono">&rarr;</span>
                            <span>Home</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('about') }}" class="group flex items-center gap-1.5 hover:text-[#e26d9b] transition-colors py-1">
                            <span class="text-neutral-400 group-hover:text-[#e26d9b] transition-colors font-mono">&rarr;</span>
                            <span>About</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('portfolio') }}" class="group flex items-center gap-1.5 hover:text-[#e26d9b] transition-colors py-1">
                            <span class="text-neutral-400 group-hover:text-[#e26d9b] transition-colors font-mono">&rarr;</span>
                            <span>Works</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('gallery') }}" class="group flex items-center gap-1.5 hover:text-[#e26d9b] transition-colors py-1">
                            <span class="text-neutral-400 group-hover:text-[#e26d9b] transition-colors font-mono">&rarr;</span>
                            <span>Gallery</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('blog') }}" class="group flex items-center gap-1.5 hover:text-[#e26d9b] transition-colors py-1">
                            <span class="text-neutral-400 group-hover:text-[#e26d9b] transition-colors font-mono">&rarr;</span>
                            <span>Journal</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('faq') }}" class="group flex items-center gap-1.5 hover:text-[#e26d9b] transition-colors py-1">
                            <span class="text-neutral-400 group-hover:text-[#e26d9b] transition-colors font-mono">&rarr;</span>
                            <span>FAQs</span>
                        </a>
                    </div>
                    <div class="col-span-2">
                        <a href="{{ route('contact') }}" class="group flex items-center gap-1.5 hover:text-[#e26d9b] transition-colors py-1 font-semibold text-[#111215] dark:text-white">
                            <span class="text-[#e26d9b] font-mono">&rarr;</span>
                            <span>Contact & Studio</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Column 3 (4 cols): Newsletter & Response Commitment -->
            <div class="lg:col-span-4 space-y-4">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#e26d9b]"></span>
                    <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-[#111215] dark:text-white">// STUDIO NEWSLETTER</h4>
                </div>
                <p class="text-xs text-[#4b5563] dark:text-neutral-400 leading-relaxed">
                    Exclusive previews of new 3D artwork, design resources, and digital craft reflections.
                </p>

                <!-- Newsletter Form -->
                @include('frontend.partials.newsletter', [
                    'accent' => '#e26d9b',
                    'btnText' => 'text-white font-bold',
                    'inputBg' => 'bg-white dark:bg-[#12141c]',
                    'borderColor' => 'border-black/10 dark:border-white/10',
                ])

                <!-- Turnaround Badge -->
                <div class="flex items-center gap-2 text-[11px] font-mono text-[#4b5563] dark:text-neutral-400 pt-1">
                    <span class="w-2 h-2 rounded-full bg-[#e26d9b]/60"></span>
                    <span>Average reply speed: under 24 hours</span>
                </div>
            </div>

        </div>

        <!-- =========================================================================
             3. COLOPHON & SUB-FOOTER
             ========================================================================= -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-mono text-[#4b5563] dark:text-neutral-400">
            <div>
                &copy; {{ date('Y') }} <strong class="text-[#111215] dark:text-white">{{ $settings['site_copyright'] ?? ($settings['site_title'] ?? 'Alex') }}</strong>. All rights reserved.
            </div>

            <!-- Real-Time Local Time Indicator -->
            <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-black/[0.04] dark:bg-white/[0.03] border border-black/10 dark:border-white/5 text-[11px] text-[#374151] dark:text-neutral-300">
                <span class="w-1.5 h-1.5 rounded-full bg-[#e26d9b] animate-pulse"></span>
                <span id="footer-illustrator-clock">Loading local time...</span>
            </div>

            <!-- Smooth Back to Top Trigger -->
            <div>
                <a href="#mainContent"
                    onclick="event.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' });"
                    class="group inline-flex items-center gap-1.5 text-[#4b5563] dark:text-neutral-400 hover:text-[#e26d9b] transition-colors cursor-pointer">
                    <span>Back to top</span>
                    <span class="group-hover:-translate-y-0.5 transition-transform font-bold">&uarr;</span>
                </a>
            </div>
        </div>

    </div>

    <!-- Floating Back to Top Button -->
    <a href="#mainContent"
        id="backToTopBtn"
        onclick="event.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' });"
        class="fixed right-4 sm:right-6 md:right-10 bottom-4 sm:bottom-6 md:bottom-10 w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-white dark:bg-[#151722] hover:bg-[#e26d9b] dark:hover:bg-[#e26d9b] text-[#e26d9b] hover:text-white border border-black/10 dark:border-white/15 flex items-center justify-center transition-all duration-300 hover:-translate-y-1 shadow-2xl shadow-black/20 dark:shadow-black/80 cursor-pointer z-50 opacity-0 invisible translate-y-4 pointer-events-none"
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
                badge.classList.add('bg-[#e26d9b]', 'text-white');
                setTimeout(() => {
                    badge.textContent = oldText;
                    badge.classList.remove('bg-[#e26d9b]', 'text-white');
                }, 2000);
            }
            if (typeof toastr !== 'undefined') {
                toastr.success('Email address copied to clipboard.', 'Copied!');
            }
        }).catch(err => {
            console.error('Copy failed:', err);
        });
    }

    // 2. Real-Time Local Time Clock
    (function initFooterClock() {
        const el = document.getElementById('footer-illustrator-clock');
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
