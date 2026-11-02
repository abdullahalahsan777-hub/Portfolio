<!-- =========================================================================
     TOP INFO BAR & STICKY HEADER (Full-Stack Laravel Developer Theme)
     Featuring Md. Abdullah Al Ahsan's resume contact, Material Color Palette Switcher,
     Dark/Light Mode toggle, and reactive AngularJS controller integration.
     ========================================================================= -->

<!-- Top Info Bar (Desktop) -->
<div class="bg-slate-900/90 dark:bg-[#060a12]/95 border-b border-cyan-500/10 text-xs text-slate-300 dark:text-slate-400 hidden lg:block font-['Plus_Jakarta_Sans'] transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex items-center justify-between">
        <!-- Left: Verified Contact Details from Resume -->
        <div class="flex items-center gap-6">
            <a href="mailto:abdullahalahsan1990@gmail.com" class="flex items-center gap-2 hover:text-[var(--theme-primary)] transition-colors group">
                <span class="w-5 h-5 rounded-md bg-cyan-500/10 text-[var(--theme-primary)] flex items-center justify-center text-xs group-hover:scale-110 transition-transform">✉</span>
                <span class="font-mono text-[11px]">abdullahalahsan1990@gmail.com</span>
            </a>
            <a href="tel:+8801718926673" class="flex items-center gap-2 hover:text-[var(--theme-primary)] transition-colors group">
                <span class="w-5 h-5 rounded-md bg-cyan-500/10 text-[var(--theme-primary)] flex items-center justify-center text-xs group-hover:scale-110 transition-transform">☎</span>
                <span class="font-mono text-[11px]">+8801718926673</span>
            </a>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-[10px] font-mono">
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- Main Sticky Navigation Bar -->
<header id="mainHeader"
    class="sticky top-0 z-50 w-full transition-all duration-300 py-3 bg-white/95 dark:bg-[#070b14]/95 backdrop-blur-xl border-b border-slate-200 dark:border-white/10 shadow-sm dark:shadow-2xl font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">

            <!-- Brand Logo: High-Tech Hexagon Emblem + Md. Abdullah Al Ahsan -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="relative w-10 h-10 rounded-xl bg-gradient-to-tr from-[var(--theme-primary)] via-blue-600 to-indigo-700 text-white flex items-center justify-center font-black text-lg shadow-lg shadow-cyan-500/25 group-hover:scale-105 group-hover:rotate-3 transition-transform">
                    <span class="font-mono tracking-tight">&lt;/&gt;</span>
                    <span class="absolute -bottom-1 -right-1 w-3.5 h-3.5 rounded-full bg-emerald-500 border-2 border-[#070b14]"></span>
                </div>
                <div class="flex flex-col">
                    <span class="font-black text-lg sm:text-xl tracking-tight text-slate-900 dark:text-white font-['Outfit'] uppercase leading-none">
                        MD. ABDULLAH<span class="text-[var(--theme-primary)]">.DEV</span>
                    </span>
                    <span class="text-[10px] font-mono tracking-widest text-[var(--theme-primary)] uppercase mt-0.5 font-bold">
                        FULL-STACK LARAVEL ARCHITECT
                    </span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-5 lg:gap-7 text-xs font-bold tracking-wider uppercase font-['Outfit']">
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'text-[var(--theme-primary)]' : 'text-slate-600 dark:text-slate-300 hover:text-[var(--theme-primary)]' }} transition-colors relative py-1">
                    Home
                    @if(request()->routeIs('home'))
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[var(--theme-primary)] rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('about') }}"
                    class="{{ request()->routeIs('about') ? 'text-[var(--theme-primary)]' : 'text-slate-600 dark:text-slate-300 hover:text-[var(--theme-primary)]' }} transition-colors relative py-1">
                    About
                    @if(request()->routeIs('about'))
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[var(--theme-primary)] rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('portfolio') }}"
                    class="{{ request()->routeIs('portfolio') ? 'text-[var(--theme-primary)]' : 'text-slate-600 dark:text-slate-300 hover:text-[var(--theme-primary)]' }} transition-colors relative py-1">
                    Portfolio
                    @if(request()->routeIs('portfolio'))
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[var(--theme-primary)] rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('blog') }}"
                    class="{{ request()->routeIs('blog*') ? 'text-[var(--theme-primary)]' : 'text-slate-600 dark:text-slate-300 hover:text-[var(--theme-primary)]' }} transition-colors relative py-1">
                    Blog
                    @if(request()->routeIs('blog*'))
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[var(--theme-primary)] rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('faq') }}"
                    class="{{ request()->routeIs('faq') ? 'text-[var(--theme-primary)]' : 'text-slate-600 dark:text-slate-300 hover:text-[var(--theme-primary)]' }} transition-colors relative py-1">
                    FAQs
                    @if(request()->routeIs('faq'))
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[var(--theme-primary)] rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('contact') }}"
                    class="{{ request()->routeIs('contact') ? 'text-[var(--theme-primary)]' : 'text-slate-600 dark:text-slate-300 hover:text-[var(--theme-primary)]' }} transition-colors relative py-1">
                    Contact
                    @if(request()->routeIs('contact'))
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[var(--theme-primary)] rounded-full"></span>
                    @endif
                </a>
            </nav>

            <!-- Actions Header Group: Theme Palette Picker + Dark/Light Mode + Admin Button -->
            <div class="flex items-center gap-2 sm:gap-3">

                <!-- Material Design Color Palette Picker (from uploaded user image) -->
                <div class="relative" id="paletteDropdownContainer">
                    <button type="button" onclick="togglePaletteMenu()" title="Material Color Accent Palette"
                        class="w-9 h-9 rounded-xl border border-slate-200 dark:border-white/10 bg-slate-100 dark:bg-white/5 hover:border-[var(--theme-primary)] text-slate-700 dark:text-slate-200 flex items-center justify-center transition-all cursor-pointer">
                        <span class="w-4 h-4 rounded-full bg-[var(--theme-primary)] shadow-sm shadow-[var(--theme-primary)]/50 inline-block"></span>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="paletteMenu" class="hidden absolute right-0 mt-2 w-56 rounded-2xl bg-white dark:bg-[#0f172a] border border-slate-200 dark:border-white/10 shadow-2xl p-3 z-50 space-y-2">
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100 dark:border-white/10 text-[10px] font-mono uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            <span>Material Palette</span>
                            <span class="text-[var(--theme-primary)] font-bold">Accent</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <!-- 1. Cyan (Default Cyber) -->
                            <button type="button" onclick="applyMaterialColor('#00e5ff', 'Cyan')"
                                class="flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer" title="Cyber Cyan">
                                <span class="w-5 h-5 rounded-full bg-[#00e5ff] shadow-sm"></span>
                                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Cyan</span>
                            </button>
                            <!-- 2. Deep Orange (Laravel Flame) -->
                            <button type="button" onclick="applyMaterialColor('#ff5722', 'Laravel Orange')"
                                class="flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer" title="Laravel Deep Orange">
                                <span class="w-5 h-5 rounded-full bg-[#ff5722] shadow-sm"></span>
                                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Orange</span>
                            </button>
                            <!-- 3. Teal -->
                            <button type="button" onclick="applyMaterialColor('#00bfa5', 'Teal')"
                                class="flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer" title="Teal Green">
                                <span class="w-5 h-5 rounded-full bg-[#00bfa5] shadow-sm"></span>
                                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Teal</span>
                            </button>
                            <!-- 4. Indigo / Deep Blue -->
                            <button type="button" onclick="applyMaterialColor('#3d5afe', 'Indigo')"
                                class="flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer" title="Electric Indigo">
                                <span class="w-5 h-5 rounded-full bg-[#3d5afe] shadow-sm"></span>
                                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Indigo</span>
                            </button>
                            <!-- 5. Amber -->
                            <button type="button" onclick="applyMaterialColor('#ffc107', 'Amber')"
                                class="flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer" title="Amber Gold">
                                <span class="w-5 h-5 rounded-full bg-[#ffc107] shadow-sm"></span>
                                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Amber</span>
                            </button>
                            <!-- 6. Pink -->
                            <button type="button" onclick="applyMaterialColor('#ff4081', 'Pink')"
                                class="flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer" title="Neon Pink">
                                <span class="w-5 h-5 rounded-full bg-[#ff4081] shadow-sm"></span>
                                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Pink</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Dark / Light Mode Switcher Toggle Button -->
                <button type="button" onclick="toggleThemeMode()" title="Toggle Dark / Light Mode"
                    class="w-9 h-9 rounded-xl border border-slate-200 dark:border-white/10 bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 text-slate-700 dark:text-amber-400 flex items-center justify-center transition-all cursor-pointer">
                    <!-- Sun Icon for Light Mode -->
                    <svg id="themeIconSun" class="w-4 h-4 hidden dark:block text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <!-- Moon Icon for Dark Mode -->
                    <svg id="themeIconMoon" class="w-4 h-4 block dark:hidden text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <!-- Admin Dashboard Shortcut -->
                <a href="{{ route('admin.dashboard') }}" title="Open Admin Panel"
                    class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl border border-cyan-500/30 bg-cyan-500/10 hover:bg-cyan-500/20 text-[var(--theme-primary)] text-xs font-mono font-bold transition-all">
                    <span>ADMIN</span>
                    <span>⚙</span>
                </a>

                <!-- Mobile Menu Hamburger Button -->
                <button type="button" onclick="toggleMobileDrawer()" class="md:hidden p-2 rounded-xl border border-slate-200 dark:border-white/10 text-slate-800 dark:text-white hover:text-[var(--theme-primary)] focus:outline-none cursor-pointer">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>

        </div>
    </div>
</header>

<!-- Mobile Navigation Drawer -->
<div id="mobileDrawer" class="hidden fixed inset-0 z-50 bg-black/80 backdrop-blur-md md:hidden transition-all duration-300">
    <div class="fixed inset-y-0 right-0 max-w-xs w-full bg-white dark:bg-[#0a0f1d] border-l border-slate-200 dark:border-white/10 p-6 flex flex-col justify-between shadow-2xl">
        <div class="space-y-6">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-white/10">
                <span class="font-extrabold text-base text-slate-900 dark:text-white font-['Outfit'] uppercase">
                    MD. ABDULLAH<span class="text-[var(--theme-primary)]">.DEV</span>
                </span>
                <button type="button" onclick="toggleMobileDrawer()" class="p-1 rounded-lg text-slate-400 hover:text-rose-400 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="flex flex-col space-y-3 font-['Outfit'] text-sm font-bold uppercase tracking-wider">
                <a href="{{ route('home') }}" class="py-2 px-3 rounded-xl {{ request()->routeIs('home') ? 'bg-cyan-500/10 text-[var(--theme-primary)]' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">Home</a>
                <a href="{{ route('about') }}" class="py-2 px-3 rounded-xl {{ request()->routeIs('about') ? 'bg-cyan-500/10 text-[var(--theme-primary)]' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">About</a>
                <a href="{{ route('portfolio') }}" class="py-2 px-3 rounded-xl {{ request()->routeIs('portfolio') ? 'bg-cyan-500/10 text-[var(--theme-primary)]' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">Portfolio</a>
                <a href="{{ route('blog') }}" class="py-2 px-3 rounded-xl {{ request()->routeIs('blog*') ? 'bg-cyan-500/10 text-[var(--theme-primary)]' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">Blog</a>
                <a href="{{ route('faq') }}" class="py-2 px-3 rounded-xl {{ request()->routeIs('faq') ? 'bg-cyan-500/10 text-[var(--theme-primary)]' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">FAQs</a>
                <a href="{{ route('contact') }}" class="py-2 px-3 rounded-xl {{ request()->routeIs('contact') ? 'bg-cyan-500/10 text-[var(--theme-primary)]' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">Contact</a>
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
            <div class="flex items-center justify-between">
                <span class="text-slate-500 dark:text-slate-400">Theme Mode:</span>
                <button type="button" onclick="toggleThemeMode()" class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-white/10 text-slate-800 dark:text-white font-bold">
                    Switch Mode
                </button>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="block text-center py-2 rounded-xl border border-cyan-500/30 bg-cyan-500/10 text-[var(--theme-primary)] font-mono font-bold">
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

    function applyMaterialColor(hex, name) {
        document.documentElement.style.setProperty('--theme-primary', hex);
        localStorage.setItem('laravel_theme_color', hex);
        if (typeof toastr !== 'undefined') {
            toastr.info(`Applied Material ${name} accent!`);
        }
        togglePaletteMenu();
    }

    function toggleThemeMode() {
        const isDark = document.documentElement.classList.contains('dark');
        const newMode = isDark ? 'light' : 'dark';
        if (newMode === 'dark') {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
        } else {
            document.documentElement.classList.add('light');
            document.documentElement.classList.remove('dark');
        }
        localStorage.setItem('laravel_theme_mode', newMode);
        document.cookie = `user_theme_mode=${newMode};path=/;max-age=31536000`;
    }

    // Initialize saved custom palette and mode
    document.addEventListener('DOMContentLoaded', () => {
        const savedColor = localStorage.getItem('laravel_theme_color') || '#00e5ff';
        document.documentElement.style.setProperty('--theme-primary', savedColor);

        const savedMode = localStorage.getItem('laravel_theme_mode');
        if (savedMode === 'light') {
            document.documentElement.classList.add('light');
            document.documentElement.classList.remove('dark');
        } else if (savedMode === 'dark') {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
        }

        // Close palette menu if clicked outside
        document.addEventListener('click', (e) => {
            const container = document.getElementById('paletteDropdownContainer');
            const menu = document.getElementById('paletteMenu');
            if (container && menu && !container.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    });
</script>
