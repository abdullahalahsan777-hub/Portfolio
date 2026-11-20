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
                    class="w-5 h-5 rounded-md bg-cyan-500/10 text-[var(--theme-primary)] flex items-center justify-center text-xs group-hover:scale-110 transition-transform">
                    <svg class="w-3 h-3 text-[var(--theme-primary)]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </span>
                <span class="font-mono text-[11px]">
                    {{ $settings['contact_email'] ?? 'abdullahalahsan@hotmail.com' }}
                </span>
            </a>
            <a href="tel:{{ $settings['contact_phone'] ?? '+8801718926673' }}"
                class="flex items-center gap-2 hover:text-[var(--theme-primary)] transition-colors group">
                <span
                    class="w-5 h-5 rounded-md bg-cyan-500/10 text-[var(--theme-primary)] flex items-center justify-center text-xs group-hover:scale-110 transition-transform">
                    <svg class="w-3 h-3 text-[var(--theme-primary)]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </span>
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
            <span class="text-[11px] font-mono text-[var(--theme-primary)] font-semibold">
                NSDA Level-3 Certified
            </span>
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
    function toggleMobileDrawer() {
        const drawer = document.getElementById('mobileDrawer');
        if (drawer) drawer.classList.toggle('hidden');
    }
</script>
