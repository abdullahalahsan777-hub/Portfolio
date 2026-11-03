<!-- =========================================================================
     TOP INFO BAR & STICKY HEADER (Full-Stack Laravel Developer Theme)
     Featuring Md. Abdullah Al Ahsan's resume contact, Right Fixed Material Palette Switcher,
     clean header bar without theme mode toggle button (per user specification).
     ========================================================================= -->

<!-- Top Info Bar (Desktop) -->
<div
    class="bg-slate-900/90 dark:bg-[#060a12]/95 border-b border-cyan-500/10 text-xs text-slate-300 dark:text-slate-400 hidden lg:block font-['Plus_Jakarta_Sans'] transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex items-center justify-between">
        <!-- Left: Verified Contact Details from Resume -->
        <div class="flex items-center gap-6">
            <a href="mailto:{{ $settings['contact_email'] ?? 'abdullahalahsan@hotmail.com' }}"
                class="flex items-center gap-2 hover:text-[var(--theme-primary)] transition-colors group">
                <span
                    class="w-5 h-5 rounded-md bg-cyan-500/10 text-[var(--theme-primary)] flex items-center justify-center text-xs group-hover:scale-110 transition-transform">✉</span>
                <span class="font-mono text-[11px]">
                    {{ $settings['contact_email'] ?? 'abdullahalahsan@hotmail.com' }}
                </span>
            </a>
            <a href="tel:{{ $settings['contact_phone'] ?? '+8801718926673' }}"
                class="flex items-center gap-2 hover:text-[var(--theme-primary)] transition-colors group">
                <span
                    class="w-5 h-5 rounded-md bg-cyan-500/10 text-[var(--theme-primary)] flex items-center justify-center text-xs group-hover:scale-110 transition-transform">☎</span>
                <span class="font-mono text-[11px]">
                    {{ $settings['contact_phone'] ?? '+8801718926673' }}
                </span>
            </a>
            <span
                class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-[10px] font-mono">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Available for Full-Time &amp; Enterprise Contracts</span>
            </span>
        </div>

        <!-- Right: Location, Certifications & Resume Download -->
        <div class="flex items-center gap-4 text-xs">
            <div class="flex items-center gap-2 text-slate-400">
                <span class="text-[var(--theme-primary)]">📍</span>
                <span>Sherpur Town, Bangladesh</span>
            </div>
            <span class="text-white/20">•</span>
            <span class="text-[11px] font-mono text-[var(--theme-primary)] font-semibold">
                NSDA Level-3 Certified
            </span>
            <span class="text-white/20">•</span>
            <a href="{{ route('cv.download') }}" download
                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-[10px] tracking-wider uppercase shadow-md shadow-cyan-500/20 active:scale-95 transition-all">
                <span>DOWNLOAD CV</span>
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- Main Sticky Navigation Bar -->
<header id="mainHeader"
    class="sticky top-0 z-40 w-full transition-all duration-300 py-3 bg-white/95 dark:bg-[#070b14]/95 backdrop-blur-xl border-b border-slate-200 dark:border-white/10 shadow-sm dark:shadow-2xl font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">

            <!-- Brand Logo: High-Tech Hexagon Emblem + Md. Abdullah Al Ahsan -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div
                    class="relative w-10 h-10 rounded-xl bg-gradient-to-tr from-[var(--theme-primary)] via-blue-600 to-indigo-700 text-white flex items-center justify-center font-black text-lg shadow-lg shadow-cyan-500/25 group-hover:scale-105 group-hover:rotate-3 transition-transform">
                    <span class="font-mono tracking-tight">&lt;/&gt;</span>
                    <span
                        class="absolute -bottom-1 -right-1 w-3.5 h-3.5 rounded-full bg-emerald-500 border-2 border-[#070b14]"></span>
                </div>
                <div class="flex flex-col">
                    <span
                        class="font-black text-lg sm:text-xl tracking-tight text-slate-900 dark:text-white font-['Outfit'] uppercase leading-none">
                        MD. ABDULLAH<span class="text-[var(--theme-primary)]">.DEV</span>
                    </span>
                    <span
                        class="text-[10px] font-mono tracking-widest text-[var(--theme-primary)] uppercase mt-0.5 font-bold">
                        FULL-STACK LARAVEL ARCHITECT
                    </span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <nav
                class="hidden md:flex items-center gap-5 lg:gap-7 text-xs font-bold tracking-wider uppercase font-['Outfit']">
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'text-[var(--theme-primary)]' : 'text-slate-600 dark:text-slate-300 hover:text-[var(--theme-primary)]' }} transition-colors relative py-1">
                    Home
                    @if (request()->routeIs('home'))
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-[var(--theme-primary)] rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('about') }}"
                    class="{{ request()->routeIs('about') ? 'text-[var(--theme-primary)]' : 'text-slate-600 dark:text-slate-300 hover:text-[var(--theme-primary)]' }} transition-colors relative py-1">
                    About
                    @if (request()->routeIs('about'))
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-[var(--theme-primary)] rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('portfolio') }}"
                    class="{{ request()->routeIs('portfolio') ? 'text-[var(--theme-primary)]' : 'text-slate-600 dark:text-slate-300 hover:text-[var(--theme-primary)]' }} transition-colors relative py-1">
                    Portfolio
                    @if (request()->routeIs('portfolio'))
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-[var(--theme-primary)] rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('gallery') }}"
                    class="{{ request()->routeIs('gallery') ? 'text-[var(--theme-primary)]' : 'text-slate-600 dark:text-slate-300 hover:text-[var(--theme-primary)]' }} transition-colors relative py-1">
                    Gallery
                    @if (request()->routeIs('gallery'))
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-[var(--theme-primary)] rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('blog') }}"
                    class="{{ request()->routeIs('blog*') ? 'text-[var(--theme-primary)]' : 'text-slate-600 dark:text-slate-300 hover:text-[var(--theme-primary)]' }} transition-colors relative py-1">
                    Blog
                    @if (request()->routeIs('blog*'))
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-[var(--theme-primary)] rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('faq') }}"
                    class="{{ request()->routeIs('faq') ? 'text-[var(--theme-primary)]' : 'text-slate-600 dark:text-slate-300 hover:text-[var(--theme-primary)]' }} transition-colors relative py-1">
                    FAQs
                    @if (request()->routeIs('faq'))
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-[var(--theme-primary)] rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('contact') }}"
                    class="{{ request()->routeIs('contact') ? 'text-[var(--theme-primary)]' : 'text-slate-600 dark:text-slate-300 hover:text-[var(--theme-primary)]' }} transition-colors relative py-1">
                    Contact
                    @if (request()->routeIs('contact'))
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-[var(--theme-primary)] rounded-full"></span>
                    @endif
                </a>
            </nav>

            <!-- Actions Header Group: Admin Shortcut Button & Mobile Menu Toggle (Theme mode & Palette removed per specification) -->
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Admin Dashboard Shortcut -->
                <a href="{{ route('admin.dashboard') }}" title="Open Admin Panel"
                    class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl border border-cyan-500/30 bg-cyan-500/10 hover:bg-cyan-500/20 text-[var(--theme-primary)] text-xs font-mono font-bold transition-all">
                    <span>ADMIN</span>
                    <span>⚙</span>
                </a>

                <!-- Mobile Menu Hamburger Button -->
                <button type="button" onclick="toggleMobileDrawer()"
                    class="md:hidden p-2 rounded-xl border border-slate-200 dark:border-white/10 text-slate-800 dark:text-white hover:text-[var(--theme-primary)] focus:outline-none cursor-pointer">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>

        </div>
    </div>
</header>

<!-- =========================================================================
     RIGHT FIXED SMALL BUTTON: Material Color Palette Switcher
     Fixed on right side of screen with sleek popout color picker
     Shows Color Swatch Fan SVG with the active theme color in both Dark & Light mode
     ========================================================================= -->
<div id="fixedPaletteWidget" class="fixed right-3 sm:right-5 top-1/2 -translate-y-1/2 z-50 flex items-center">
    <!-- Palette Popout Menu (opens to the left of the button) -->
    <div id="paletteMenu"
        class="hidden mr-3 w-64 rounded-2xl bg-white/95 dark:bg-[#0b1220]/95 backdrop-blur-xl border border-slate-200 dark:border-white/10 shadow-2xl p-3.5 space-y-3 transition-all duration-300">
        <div
            class="flex items-center justify-between pb-2 border-b border-slate-100 dark:border-white/10 text-[10px] font-mono uppercase tracking-wider text-slate-500 dark:text-slate-400">
            <span class="inline-flex items-center gap-1.5">
                <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 143 141" fill="currentColor"
                    style="color: var(--theme-primary);">
                    <path fill-rule="evenodd"
                        d="M 40.2 17.2 L 39.3 17.3 L 38.3 17.7 L 37.1 18.2 L 35.8 19.0 L 34.3 20.0 L 32.8 21.1 L 31.5 22.3 L 30.3 23.6 L 29.2 24.9 L 28.2 26.3 L 27.4 27.6 L 26.8 28.9 L 26.3 30.1 L 25.9 36.4 L 25.6 47.6 L 25.5 63.9 L 25.5 85.1 L 25.7 101.4 L 26.1 112.8 L 26.6 119.3 L 27.4 120.8 L 28.3 122.3 L 29.5 123.8 L 30.9 125.4 L 32.6 127.1 L 34.0 128.4 L 35.3 129.5 L 36.5 130.3 L 37.5 130.8 L 38.4 131.1 L 39.3 131.4 L 40.1 131.5 L 40.9 131.5 L 41.5 131.6 L 42.0 131.7 L 42.4 131.9 L 42.6 132.1 L 43.9 132.3 L 46.1 132.4 L 49.4 132.5 L 53.6 132.5 L 56.9 132.4 L 59.1 132.3 L 60.4 132.1 L 60.6 131.9 L 61.0 131.7 L 61.5 131.6 L 62.1 131.5 L 62.9 131.5 L 63.8 131.3 L 64.8 130.9 L 65.9 130.4 L 67.1 129.6 L 68.4 128.6 L 69.8 127.4 L 71.3 125.9 L 72.8 124.1 L 76.8 121.2 L 83.3 117.1 L 92.3 111.8 L 103.8 105.3 L 112.8 100.0 L 119.3 95.9 L 123.4 93.1 L 125.1 91.4 L 126.4 90.0 L 127.5 88.7 L 128.3 87.5 L 128.8 86.5 L 129.2 85.2 L 129.6 83.6 L 129.9 81.6 L 130.1 79.4 L 130.3 77.6 L 130.3 76.4 L 130.1 75.6 L 129.9 75.4 L 129.7 75.0 L 129.6 74.5 L 129.5 73.9 L 129.5 73.1 L 129.0 71.7 L 128.0 69.6 L 126.5 66.8 L 124.5 63.3 L 122.6 60.3 L 120.9 57.9 L 119.3 56.1 L 117.8 54.9 L 116.6 53.8 L 115.9 52.9 L 115.5 52.3 L 115.5 51.8 L 115.4 51.2 L 115.1 50.6 L 114.8 49.9 L 114.3 49.1 L 113.2 48.0 L 111.5 46.4 L 109.2 44.4 L 106.3 42.1 L 104.0 40.2 L 102.2 38.7 L 100.9 37.8 L 100.1 37.3 L 99.4 36.9 L 98.6 36.6 L 97.9 36.5 L 97.1 36.5 L 96.1 36.1 L 94.9 35.4 L 93.4 34.3 L 91.6 32.8 L 89.6 31.4 L 87.4 30.1 L 84.9 29.0 L 82.1 28.0 L 79.9 27.3 L 78.1 26.8 L 76.9 26.5 L 76.1 26.5 L 75.2 26.1 L 74.1 25.4 L 72.8 24.3 L 71.3 22.8 L 69.8 21.4 L 68.4 20.3 L 67.1 19.4 L 65.9 18.6 L 64.8 18.1 L 63.8 17.7 L 62.9 17.5 L 62.1 17.5 L 61.5 17.4 L 61.0 17.3 L 60.6 17.1 L 60.4 16.9 L 59.1 16.7 L 56.7 16.6 L 53.3 16.5 L 48.8 16.5 L 45.3 16.5 L 43.0 16.6 L 41.8 16.7 L 41.7 16.8 L 41.4 16.9 L 40.9 17.1 Z M 39.4 22.9 L 38.1 23.6 L 36.9 24.2 L 35.9 24.8 L 35.1 25.4 L 34.4 26.1 L 33.7 27.0 L 32.9 28.3 L 32.0 30.0 L 31.0 32.0 L 30.3 38.4 L 29.8 49.1 L 29.5 64.3 L 29.5 83.8 L 29.6 98.8 L 29.9 109.3 L 30.3 115.3 L 30.8 116.8 L 31.5 118.3 L 32.6 119.8 L 33.9 121.4 L 35.6 123.1 L 37.0 124.4 L 38.3 125.5 L 39.5 126.3 L 40.5 126.8 L 42.4 127.1 L 45.1 127.4 L 48.8 127.5 L 53.3 127.5 L 57.0 127.3 L 60.0 126.9 L 62.3 126.4 L 63.8 125.6 L 65.2 124.8 L 66.5 123.8 L 67.7 122.8 L 68.8 121.7 L 69.8 120.5 L 70.6 119.3 L 71.3 118.1 L 71.8 116.9 L 72.1 110.9 L 72.4 100.3 L 72.5 85.0 L 72.5 65.0 L 72.3 49.6 L 71.9 38.7 L 71.4 32.4 L 70.6 30.6 L 69.7 29.0 L 68.5 27.4 L 67.1 25.9 L 65.4 24.6 L 64.0 23.5 L 62.8 22.7 L 61.9 22.1 L 61.1 21.9 L 59.4 21.7 L 56.8 21.6 L 53.3 21.5 L 48.8 21.5 L 45.3 21.5 L 43.0 21.6 L 41.8 21.7 L 41.7 21.8 L 41.3 22.1 L 40.5 22.4 Z M 76.5 31.1 L 76.5 31.9 L 76.6 32.5 L 76.7 33.0 L 76.9 33.4 L 77.1 33.6 L 77.3 38.1 L 77.5 46.8 L 77.7 59.7 L 77.8 76.8 L 78.4 88.1 L 79.6 93.4 L 81.2 92.9 L 83.3 86.6 L 85.0 81.6 L 86.3 78.0 L 87.3 75.9 L 87.8 75.1 L 88.3 73.9 L 88.9 72.1 L 89.6 69.9 L 90.4 67.1 L 91.2 64.5 L 92.1 62.0 L 93.0 59.6 L 94.0 57.4 L 94.8 55.2 L 95.4 53.1 L 95.9 51.0 L 96.1 49.0 L 96.1 47.1 L 95.9 45.2 L 95.4 43.4 L 94.6 41.6 L 93.8 40.0 L 92.8 38.6 L 91.8 37.3 L 90.7 36.2 L 89.1 35.0 L 87.0 33.8 L 84.5 32.6 L 81.5 31.4 L 79.2 30.5 L 77.7 29.9 L 76.8 29.7 L 76.7 29.8 L 76.6 30.1 L 76.5 30.5 Z M 98.9 45.1 L 99.1 47.9 L 99.0 50.9 L 98.5 54.1 L 97.6 57.6 L 96.4 61.4 L 95.3 64.4 L 94.4 66.6 L 93.8 68.1 L 93.3 68.9 L 92.9 69.6 L 92.6 70.4 L 92.5 71.1 L 92.5 71.9 L 92.3 72.9 L 91.8 74.3 L 91.0 76.0 L 90.0 78.0 L 89.1 80.2 L 88.2 82.6 L 87.4 85.1 L 86.6 87.9 L 85.9 90.1 L 85.3 91.9 L 84.8 93.1 L 84.3 93.9 L 83.9 94.6 L 83.6 95.4 L 83.5 96.1 L 83.5 96.9 L 83.3 97.9 L 82.8 99.3 L 82.0 101.0 L 81.0 103.0 L 80.3 104.6 L 79.8 105.8 L 79.7 106.6 L 79.8 106.9 L 81.9 104.8 L 86.1 100.2 L 92.2 93.1 L 100.3 83.4 L 106.5 75.8 L 110.8 70.3 L 113.3 66.8 L 113.8 65.3 L 114.1 63.8 L 114.4 62.4 L 114.5 61.1 L 114.5 59.9 L 114.3 58.5 L 113.9 57.0 L 113.4 55.4 L 112.6 53.6 L 111.3 51.7 L 109.3 49.5 L 106.8 47.1 L 103.7 44.4 L 101.3 42.5 L 99.7 41.3 L 98.8 40.7 L 98.7 40.8 L 98.7 41.6 L 98.7 43.0 Z M 117.5 61.5 L 117.5 62.5 L 117.3 63.8 L 116.9 65.3 L 116.4 67.0 L 115.6 69.0 L 112.9 73.0 L 108.3 79.0 L 101.8 87.0 L 93.3 97.0 L 86.8 104.7 L 82.3 110.2 L 79.9 113.3 L 79.6 114.2 L 81.9 113.3 L 87.0 110.8 L 94.8 106.5 L 105.3 100.5 L 113.4 95.7 L 119.2 92.0 L 122.7 89.4 L 123.8 88.1 L 124.7 86.8 L 125.4 85.8 L 125.9 84.9 L 126.1 84.1 L 126.3 82.9 L 126.4 81.3 L 126.5 79.3 L 126.5 76.8 L 126.0 74.0 L 124.9 71.1 L 123.3 67.9 L 121.2 64.6 L 119.6 62.1 L 118.4 60.4 L 117.8 59.7 L 117.7 59.8 L 117.6 60.2 L 117.5 60.7 Z M 44.1 86.9 L 42.4 87.6 L 40.9 88.3 L 39.6 89.2 L 38.3 90.2 L 37.2 91.3 L 36.2 92.5 L 35.2 93.8 L 34.4 95.3 L 33.6 96.8 L 33.1 98.6 L 32.7 100.7 L 32.5 103.1 L 32.5 105.9 L 32.8 108.4 L 33.3 110.6 L 34.0 112.6 L 35.0 114.4 L 36.1 116.0 L 37.3 117.4 L 38.6 118.7 L 39.9 119.8 L 41.3 120.8 L 42.8 121.6 L 44.3 122.3 L 45.8 122.8 L 47.5 123.1 L 49.5 123.2 L 51.8 123.1 L 54.3 122.9 L 56.4 122.6 L 58.1 122.2 L 59.5 121.8 L 60.5 121.3 L 61.5 120.6 L 62.6 119.8 L 63.7 118.8 L 64.8 117.7 L 65.8 116.5 L 66.8 115.3 L 67.6 114.1 L 68.4 112.9 L 68.9 111.7 L 69.3 110.6 L 69.5 109.5 L 69.5 108.5 L 69.6 107.7 L 69.7 107.1 L 69.9 106.6 L 70.1 106.4 L 70.3 105.7 L 70.3 104.6 L 70.1 103.0 L 69.9 101.0 L 69.6 99.3 L 69.2 97.8 L 68.8 96.5 L 68.3 95.5 L 67.5 94.3 L 66.4 93.0 L 65.1 91.6 L 63.4 89.9 L 61.9 88.6 L 60.5 87.5 L 59.1 86.8 L 57.9 86.3 L 56.4 85.9 L 54.6 85.6 L 52.6 85.5 L 50.4 85.5 L 48.7 85.5 L 47.5 85.6 L 46.8 85.7 L 46.7 85.8 L 46.2 86.1 L 45.3 86.4 Z M 48.8 90.2 L 47.7 90.3 L 46.4 90.8 L 45.1 91.5 L 43.6 92.6 L 41.9 93.9 L 40.6 95.2 L 39.5 96.4 L 38.8 97.5 L 38.3 98.5 L 37.9 99.8 L 37.6 101.4 L 37.5 103.4 L 37.5 105.6 L 37.9 107.8 L 38.7 109.8 L 39.9 111.8 L 41.6 113.7 L 43.0 115.2 L 44.3 116.4 L 45.5 117.3 L 46.5 117.8 L 47.7 118.1 L 49.1 118.4 L 50.6 118.5 L 52.4 118.5 L 53.9 118.4 L 55.3 118.1 L 56.5 117.8 L 57.5 117.3 L 58.5 116.6 L 59.6 115.8 L 60.7 114.8 L 61.8 113.7 L 62.8 112.5 L 63.6 111.3 L 64.3 110.1 L 64.8 108.9 L 65.1 107.6 L 65.4 106.2 L 65.5 104.8 L 65.5 103.3 L 65.2 101.7 L 64.7 100.0 L 63.8 98.2 L 62.7 96.3 L 61.5 94.7 L 60.3 93.4 L 59.1 92.4 L 57.9 91.6 L 56.6 91.0 L 55.4 90.5 L 54.1 90.1 L 52.9 89.9 L 51.9 89.7 L 51.2 89.7 L 50.8 89.7 L 50.7 89.8 L 50.3 89.9 L 49.7 90.1 Z" />
                </svg>
                <span>Material Palette</span>
            </span>
            <span class="text-[var(--theme-primary)] font-bold">Accent</span>
        </div>
        <div class="grid grid-cols-3 gap-2">
            <!-- 1. Cyan (Default Cyber) -->
            <button type="button" onclick="applyMaterialColor('#00e5ff', 'Cyan')" data-color="#00e5ff"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer"
                title="Cyber Cyan">
                <span class="w-5 h-5 rounded-full bg-[#00e5ff] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Cyan</span>
            </button>
            <!-- 2. Deep Orange (Laravel Flame) -->
            <button type="button" onclick="applyMaterialColor('#ff5722', 'Laravel Orange')" data-color="#ff5722"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer"
                title="Laravel Deep Orange">
                <span class="w-5 h-5 rounded-full bg-[#ff5722] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Orange</span>
            </button>
            <!-- 3. Teal -->
            <button type="button" onclick="applyMaterialColor('#00bfa5', 'Teal')" data-color="#00bfa5"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer"
                title="Teal Green">
                <span class="w-5 h-5 rounded-full bg-[#00bfa5] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Teal</span>
            </button>
            <!-- 4. Indigo / Deep Blue -->
            <button type="button" onclick="applyMaterialColor('#3d5afe', 'Indigo')" data-color="#3d5afe"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer"
                title="Electric Indigo">
                <span class="w-5 h-5 rounded-full bg-[#3d5afe] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Indigo</span>
            </button>
            <!-- 5. Amber -->
            <button type="button" onclick="applyMaterialColor('#ffc107', 'Amber')" data-color="#ffc107"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer"
                title="Amber Gold">
                <span class="w-5 h-5 rounded-full bg-[#ffc107] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Amber</span>
            </button>
            <!-- 6. Pink -->
            <button type="button" onclick="applyMaterialColor('#ff4081', 'Pink')" data-color="#ff4081"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer"
                title="Neon Pink">
                <span class="w-5 h-5 rounded-full bg-[#ff4081] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Pink</span>
            </button>
            <!-- 7. Deep Purple -->
            <button type="button" onclick="applyMaterialColor('#7c4dff', 'Deep Purple')" data-color="#7c4dff"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer"
                title="Deep Purple">
                <span class="w-5 h-5 rounded-full bg-[#7c4dff] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Purple</span>
            </button>
            <!-- 8. Lime Accent -->
            <button type="button" onclick="applyMaterialColor('#aeea00', 'Lime Accent')" data-color="#aeea00"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer"
                title="Lime Accent">
                <span class="w-5 h-5 rounded-full bg-[#aeea00] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Lime</span>
            </button>
            <!-- 9. Electric Blue -->
            <button type="button" onclick="applyMaterialColor('#2979ff', 'Electric Blue')" data-color="#2979ff"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer"
                title="Electric Blue">
                <span class="w-5 h-5 rounded-full bg-[#2979ff] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Blue</span>
            </button>
        </div>
    </div>

    <!-- Right Fixed Small Button: Material Palette Color Swatch Fan SVG in Active Color (Dark & Light Mode) -->
    <button type="button" onclick="togglePaletteMenu()" title="Material Color Palette"
        aria-label="Material Color Palette"
        class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/95 dark:bg-[#070b14]/95 border-2 border-slate-200 dark:border-white/20 hover:border-[var(--theme-primary)] flex items-center justify-center shadow-lg shadow-slate-900/10 dark:shadow-2xl dark:shadow-black/70 hover:scale-110 active:scale-95 transition-all cursor-pointer backdrop-blur-md group">
        <svg class="w-5 h-5 sm:w-5.5 sm:h-5.5 transition-transform duration-300 ease-out group-hover:scale-110 pointer-events-none drop-shadow-sm"
            viewBox="0 0 143 141" fill="currentColor" style="color: var(--theme-primary);">
            <path fill-rule="evenodd"
                d="M 40.2 17.2 L 39.3 17.3 L 38.3 17.7 L 37.1 18.2 L 35.8 19.0 L 34.3 20.0 L 32.8 21.1 L 31.5 22.3 L 30.3 23.6 L 29.2 24.9 L 28.2 26.3 L 27.4 27.6 L 26.8 28.9 L 26.3 30.1 L 25.9 36.4 L 25.6 47.6 L 25.5 63.9 L 25.5 85.1 L 25.7 101.4 L 26.1 112.8 L 26.6 119.3 L 27.4 120.8 L 28.3 122.3 L 29.5 123.8 L 30.9 125.4 L 32.6 127.1 L 34.0 128.4 L 35.3 129.5 L 36.5 130.3 L 37.5 130.8 L 38.4 131.1 L 39.3 131.4 L 40.1 131.5 L 40.9 131.5 L 41.5 131.6 L 42.0 131.7 L 42.4 131.9 L 42.6 132.1 L 43.9 132.3 L 46.1 132.4 L 49.4 132.5 L 53.6 132.5 L 56.9 132.4 L 59.1 132.3 L 60.4 132.1 L 60.6 131.9 L 61.0 131.7 L 61.5 131.6 L 62.1 131.5 L 62.9 131.5 L 63.8 131.3 L 64.8 130.9 L 65.9 130.4 L 67.1 129.6 L 68.4 128.6 L 69.8 127.4 L 71.3 125.9 L 72.8 124.1 L 76.8 121.2 L 83.3 117.1 L 92.3 111.8 L 103.8 105.3 L 112.8 100.0 L 119.3 95.9 L 123.4 93.1 L 125.1 91.4 L 126.4 90.0 L 127.5 88.7 L 128.3 87.5 L 128.8 86.5 L 129.2 85.2 L 129.6 83.6 L 129.9 81.6 L 130.1 79.4 L 130.3 77.6 L 130.3 76.4 L 130.1 75.6 L 129.9 75.4 L 129.7 75.0 L 129.6 74.5 L 129.5 73.9 L 129.5 73.1 L 129.0 71.7 L 128.0 69.6 L 126.5 66.8 L 124.5 63.3 L 122.6 60.3 L 120.9 57.9 L 119.3 56.1 L 117.8 54.9 L 116.6 53.8 L 115.9 52.9 L 115.5 52.3 L 115.5 51.8 L 115.4 51.2 L 115.1 50.6 L 114.8 49.9 L 114.3 49.1 L 113.2 48.0 L 111.5 46.4 L 109.2 44.4 L 106.3 42.1 L 104.0 40.2 L 102.2 38.7 L 100.9 37.8 L 100.1 37.3 L 99.4 36.9 L 98.6 36.6 L 97.9 36.5 L 97.1 36.5 L 96.1 36.1 L 94.9 35.4 L 93.4 34.3 L 91.6 32.8 L 89.6 31.4 L 87.4 30.1 L 84.9 29.0 L 82.1 28.0 L 79.9 27.3 L 78.1 26.8 L 76.9 26.5 L 76.1 26.5 L 75.2 26.1 L 74.1 25.4 L 72.8 24.3 L 71.3 22.8 L 69.8 21.4 L 68.4 20.3 L 67.1 19.4 L 65.9 18.6 L 64.8 18.1 L 63.8 17.7 L 62.9 17.5 L 62.1 17.5 L 61.5 17.4 L 61.0 17.3 L 60.6 17.1 L 60.4 16.9 L 59.1 16.7 L 56.7 16.6 L 53.3 16.5 L 48.8 16.5 L 45.3 16.5 L 43.0 16.6 L 41.8 16.7 L 41.7 16.8 L 41.4 16.9 L 40.9 17.1 Z M 39.4 22.9 L 38.1 23.6 L 36.9 24.2 L 35.9 24.8 L 35.1 25.4 L 34.4 26.1 L 33.7 27.0 L 32.9 28.3 L 32.0 30.0 L 31.0 32.0 L 30.3 38.4 L 29.8 49.1 L 29.5 64.3 L 29.5 83.8 L 29.6 98.8 L 29.9 109.3 L 30.3 115.3 L 30.8 116.8 L 31.5 118.3 L 32.6 119.8 L 33.9 121.4 L 35.6 123.1 L 37.0 124.4 L 38.3 125.5 L 39.5 126.3 L 40.5 126.8 L 42.4 127.1 L 45.1 127.4 L 48.8 127.5 L 53.3 127.5 L 57.0 127.3 L 60.0 126.9 L 62.3 126.4 L 63.8 125.6 L 65.2 124.8 L 66.5 123.8 L 67.7 122.8 L 68.8 121.7 L 69.8 120.5 L 70.6 119.3 L 71.3 118.1 L 71.8 116.9 L 72.1 110.9 L 72.4 100.3 L 72.5 85.0 L 72.5 65.0 L 72.3 49.6 L 71.9 38.7 L 71.4 32.4 L 70.6 30.6 L 69.7 29.0 L 68.5 27.4 L 67.1 25.9 L 65.4 24.6 L 64.0 23.5 L 62.8 22.7 L 61.9 22.1 L 61.1 21.9 L 59.4 21.7 L 56.8 21.6 L 53.3 21.5 L 48.8 21.5 L 45.3 21.5 L 43.0 21.6 L 41.8 21.7 L 41.7 21.8 L 41.3 22.1 L 40.5 22.4 Z M 76.5 31.1 L 76.5 31.9 L 76.6 32.5 L 76.7 33.0 L 76.9 33.4 L 77.1 33.6 L 77.3 38.1 L 77.5 46.8 L 77.7 59.7 L 77.8 76.8 L 78.4 88.1 L 79.6 93.4 L 81.2 92.9 L 83.3 86.6 L 85.0 81.6 L 86.3 78.0 L 87.3 75.9 L 87.8 75.1 L 88.3 73.9 L 88.9 72.1 L 89.6 69.9 L 90.4 67.1 L 91.2 64.5 L 92.1 62.0 L 93.0 59.6 L 94.0 57.4 L 94.8 55.2 L 95.4 53.1 L 95.9 51.0 L 96.1 49.0 L 96.1 47.1 L 95.9 45.2 L 95.4 43.4 L 94.6 41.6 L 93.8 40.0 L 92.8 38.6 L 91.8 37.3 L 90.7 36.2 L 89.1 35.0 L 87.0 33.8 L 84.5 32.6 L 81.5 31.4 L 79.2 30.5 L 77.7 29.9 L 76.8 29.7 L 76.7 29.8 L 76.6 30.1 L 76.5 30.5 Z M 98.9 45.1 L 99.1 47.9 L 99.0 50.9 L 98.5 54.1 L 97.6 57.6 L 96.4 61.4 L 95.3 64.4 L 94.4 66.6 L 93.8 68.1 L 93.3 68.9 L 92.9 69.6 L 92.6 70.4 L 92.5 71.1 L 92.5 71.9 L 92.3 72.9 L 91.8 74.3 L 91.0 76.0 L 90.0 78.0 L 89.1 80.2 L 88.2 82.6 L 87.4 85.1 L 86.6 87.9 L 85.9 90.1 L 85.3 91.9 L 84.8 93.1 L 84.3 93.9 L 83.9 94.6 L 83.6 95.4 L 83.5 96.1 L 83.5 96.9 L 83.3 97.9 L 82.8 99.3 L 82.0 101.0 L 81.0 103.0 L 80.3 104.6 L 79.8 105.8 L 79.7 106.6 L 79.8 106.9 L 81.9 104.8 L 86.1 100.2 L 92.2 93.1 L 100.3 83.4 L 106.5 75.8 L 110.8 70.3 L 113.3 66.8 L 113.8 65.3 L 114.1 63.8 L 114.4 62.4 L 114.5 61.1 L 114.5 59.9 L 114.3 58.5 L 113.9 57.0 L 113.4 55.4 L 112.6 53.6 L 111.3 51.7 L 109.3 49.5 L 106.8 47.1 L 103.7 44.4 L 101.3 42.5 L 99.7 41.3 L 98.8 40.7 L 98.7 40.8 L 98.7 41.6 L 98.7 43.0 Z M 117.5 61.5 L 117.5 62.5 L 117.3 63.8 L 116.9 65.3 L 116.4 67.0 L 115.6 69.0 L 112.9 73.0 L 108.3 79.0 L 101.8 87.0 L 93.3 97.0 L 86.8 104.7 L 82.3 110.2 L 79.9 113.3 L 79.6 114.2 L 81.9 113.3 L 87.0 110.8 L 94.8 106.5 L 105.3 100.5 L 113.4 95.7 L 119.2 92.0 L 122.7 89.4 L 123.8 88.1 L 124.7 86.8 L 125.4 85.8 L 125.9 84.9 L 126.1 84.1 L 126.3 82.9 L 126.4 81.3 L 126.5 79.3 L 126.5 76.8 L 126.0 74.0 L 124.9 71.1 L 123.3 67.9 L 121.2 64.6 L 119.6 62.1 L 118.4 60.4 L 117.8 59.7 L 117.7 59.8 L 117.6 60.2 L 117.5 60.7 Z M 44.1 86.9 L 42.4 87.6 L 40.9 88.3 L 39.6 89.2 L 38.3 90.2 L 37.2 91.3 L 36.2 92.5 L 35.2 93.8 L 34.4 95.3 L 33.6 96.8 L 33.1 98.6 L 32.7 100.7 L 32.5 103.1 L 32.5 105.9 L 32.8 108.4 L 33.3 110.6 L 34.0 112.6 L 35.0 114.4 L 36.1 116.0 L 37.3 117.4 L 38.6 118.7 L 39.9 119.8 L 41.3 120.8 L 42.8 121.6 L 44.3 122.3 L 45.8 122.8 L 47.5 123.1 L 49.5 123.2 L 51.8 123.1 L 54.3 122.9 L 56.4 122.6 L 58.1 122.2 L 59.5 121.8 L 60.5 121.3 L 61.5 120.6 L 62.6 119.8 L 63.7 118.8 L 64.8 117.7 L 65.8 116.5 L 66.8 115.3 L 67.6 114.1 L 68.4 112.9 L 68.9 111.7 L 69.3 110.6 L 69.5 109.5 L 69.5 108.5 L 69.6 107.7 L 69.7 107.1 L 69.9 106.6 L 70.1 106.4 L 70.3 105.7 L 70.3 104.6 L 70.1 103.0 L 69.9 101.0 L 69.6 99.3 L 69.2 97.8 L 68.8 96.5 L 68.3 95.5 L 67.5 94.3 L 66.4 93.0 L 65.1 91.6 L 63.4 89.9 L 61.9 88.6 L 60.5 87.5 L 59.1 86.8 L 57.9 86.3 L 56.4 85.9 L 54.6 85.6 L 52.6 85.5 L 50.4 85.5 L 48.7 85.5 L 47.5 85.6 L 46.8 85.7 L 46.7 85.8 L 46.2 86.1 L 45.3 86.4 Z M 48.8 90.2 L 47.7 90.3 L 46.4 90.8 L 45.1 91.5 L 43.6 92.6 L 41.9 93.9 L 40.6 95.2 L 39.5 96.4 L 38.8 97.5 L 38.3 98.5 L 37.9 99.8 L 37.6 101.4 L 37.5 103.4 L 37.5 105.6 L 37.9 107.8 L 38.7 109.8 L 39.9 111.8 L 41.6 113.7 L 43.0 115.2 L 44.3 116.4 L 45.5 117.3 L 46.5 117.8 L 47.7 118.1 L 49.1 118.4 L 50.6 118.5 L 52.4 118.5 L 53.9 118.4 L 55.3 118.1 L 56.5 117.8 L 57.5 117.3 L 58.5 116.6 L 59.6 115.8 L 60.7 114.8 L 61.8 113.7 L 62.8 112.5 L 63.6 111.3 L 64.3 110.1 L 64.8 108.9 L 65.1 107.6 L 65.4 106.2 L 65.5 104.8 L 65.5 103.3 L 65.2 101.7 L 64.7 100.0 L 63.8 98.2 L 62.7 96.3 L 61.5 94.7 L 60.3 93.4 L 59.1 92.4 L 57.9 91.6 L 56.6 91.0 L 55.4 90.5 L 54.1 90.1 L 52.9 89.9 L 51.9 89.7 L 51.2 89.7 L 50.8 89.7 L 50.7 89.8 L 50.3 89.9 L 49.7 90.1 Z" />
        </svg>
    </button>
</div>

<!-- Mobile Navigation Drawer -->
<div id="mobileDrawer"
    class="hidden fixed inset-0 z-50 bg-black/80 backdrop-blur-md md:hidden transition-all duration-300">
    <div
        class="fixed inset-y-0 right-0 max-w-xs w-full bg-white dark:bg-[#0a0f1d] border-l border-slate-200 dark:border-white/10 p-6 flex flex-col justify-between shadow-2xl">
        <div class="space-y-6">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-white/10">
                <span class="font-extrabold text-base text-slate-900 dark:text-white font-['Outfit'] uppercase">
                    MD. ABDULLAH<span class="text-[var(--theme-primary)]">.DEV</span>
                </span>
                <button type="button" onclick="toggleMobileDrawer()"
                    class="p-1 rounded-lg text-slate-400 hover:text-rose-400 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="flex flex-col space-y-3 font-['Outfit'] text-sm font-bold uppercase tracking-wider">
                <a href="{{ route('home') }}"
                    class="py-2 px-3 rounded-xl {{ request()->routeIs('home') ? 'bg-cyan-500/10 text-[var(--theme-primary)]' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">Home</a>
                <a href="{{ route('about') }}"
                    class="py-2 px-3 rounded-xl {{ request()->routeIs('about') ? 'bg-cyan-500/10 text-[var(--theme-primary)]' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">About</a>
                <a href="{{ route('portfolio') }}"
                    class="py-2 px-3 rounded-xl {{ request()->routeIs('portfolio') ? 'bg-cyan-500/10 text-[var(--theme-primary)]' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">Portfolio</a>
                <a href="{{ route('gallery') }}"
                    class="py-2 px-3 rounded-xl {{ request()->routeIs('gallery') ? 'bg-cyan-500/10 text-[var(--theme-primary)]' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">Gallery</a>
                <a href="{{ route('blog') }}"
                    class="py-2 px-3 rounded-xl {{ request()->routeIs('blog*') ? 'bg-cyan-500/10 text-[var(--theme-primary)]' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">Blog</a>
                <a href="{{ route('faq') }}"
                    class="py-2 px-3 rounded-xl {{ request()->routeIs('faq') ? 'bg-cyan-500/10 text-[var(--theme-primary)]' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">FAQs</a>
                <a href="{{ route('contact') }}"
                    class="py-2 px-3 rounded-xl {{ request()->routeIs('contact') ? 'bg-cyan-500/10 text-[var(--theme-primary)]' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">Contact</a>
            </nav>

            <!-- Resume Download Button -->
            <div class="pt-4 border-t border-slate-100 dark:border-white/10">
                <a href="{{ route('cv.download') }}" download
                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-cyan-500/20">
                    <span>DOWNLOAD RESUME CV</span>
                    <span>↓</span>
                </a>
            </div>
        </div>

        <div class="space-y-4 pt-6 border-t border-slate-100 dark:border-white/10 text-xs">
            <a href="{{ route('admin.dashboard') }}"
                class="block text-center py-2 rounded-xl border border-cyan-500/30 bg-cyan-500/10 text-[var(--theme-primary)] font-mono font-bold">
                Admin Panel ⚙
            </a>
        </div>
    </div>
</div>

<script>
    function togglePaletteMenu() {
        const menu = document.getElementById('paletteMenu');
        if (menu) menu.classList.toggle('hidden');
    }

    function toggleMobileDrawer() {
        const drawer = document.getElementById('mobileDrawer');
        if (drawer) drawer.classList.toggle('hidden');
    }

    function updateThemeContrast(hex) {
        if (!hex) return;
        hex = hex.replace('#', '');
        const r = parseInt(hex.substr(0, 2), 16) || 0;
        const g = parseInt(hex.substr(2, 2), 16) || 0;
        const b = parseInt(hex.substr(4, 2), 16) || 0;
        const yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;
        const onPrimary = (yiq >= 120) ? '#000000' : '#ffffff';
        document.documentElement.style.setProperty('--theme-on-primary', onPrimary);
        document.documentElement.style.setProperty('--theme-primary-glow', `rgba(${r}, ${g}, ${b}, 0.35)`);
    }

    function markActiveColorSwatch(hex) {
        if (!hex) return;
        const normalized = hex.toLowerCase();
        document.querySelectorAll('.palette-color-btn').forEach(btn => {
            const btnColor = (btn.getAttribute('data-color') || '').toLowerCase();
            const swatch = btn.querySelector('span:first-child');
            if (swatch) {
                if (btnColor === normalized) {
                    swatch.classList.add('ring-2', 'ring-offset-2', 'ring-offset-white',
                        'dark:ring-offset-slate-900', 'ring-[var(--theme-primary)]', 'scale-110');
                } else {
                    swatch.classList.remove('ring-2', 'ring-offset-2', 'ring-offset-white',
                        'dark:ring-offset-slate-900', 'ring-[var(--theme-primary)]', 'scale-110');
                }
            }
        });
    }

    function applyMaterialColor(hex, name) {
        document.documentElement.style.setProperty('--theme-primary', hex);
        updateThemeContrast(hex);
        markActiveColorSwatch(hex);
        localStorage.setItem('laravel_theme_color', hex);
        if (typeof toastr !== 'undefined') {
            toastr.info(`Applied Material ${name} accent!`);
        }
        togglePaletteMenu();
    }

    // Initialize saved custom palette
    document.addEventListener('DOMContentLoaded', () => {
        const savedColor = localStorage.getItem('laravel_theme_color') || '#00e5ff';
        document.documentElement.style.setProperty('--theme-primary', savedColor);
        updateThemeContrast(savedColor);
        markActiveColorSwatch(savedColor);

        // Close palette menu if clicked outside
        document.addEventListener('click', (e) => {
            const widget = document.getElementById('fixedPaletteWidget');
            const menu = document.getElementById('paletteMenu');
            if (widget && menu && !widget.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    });
</script>
