<!-- =========================================================================
     TOP INFO BAR & STICKY HEADER (Full-Stack Laravel Developer Theme)
     Featuring Md. Abdullah Al Ahsan's resume contact, Right Fixed Material Palette Switcher,
     clean header bar without theme mode toggle button (per user specification).
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
    class="sticky top-0 z-40 w-full transition-all duration-300 py-3 bg-white/95 dark:bg-[#070b14]/95 backdrop-blur-xl border-b border-slate-200 dark:border-white/10 shadow-sm dark:shadow-2xl font-['Plus_Jakarta_Sans']">
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

            <!-- Actions Header Group: Admin Shortcut Button & Mobile Menu Toggle (Theme mode & Palette removed per specification) -->
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Admin Dashboard Shortcut -->
                <a href="{{ route('admin.dashboard') }}" title="Open Admin Panel"
                    class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl border border-cyan-500/30 bg-cyan-500/10 hover:bg-cyan-500/20 text-[var(--theme-primary)] text-xs font-mono font-bold transition-all">
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

<!-- =========================================================================
     RIGHT FIXED SMALL BUTTON: Material Color Palette Switcher
     Fixed on right side of screen with sleek popout color picker
     Shows 6-tooth gear settings SVG with the active theme color in both Dark & Light mode
     ========================================================================= -->
<div id="fixedPaletteWidget" class="fixed right-3 sm:right-5 top-1/2 -translate-y-1/2 z-50 flex items-center">
    <!-- Palette Popout Menu (opens to the left of the button) -->
    <div id="paletteMenu" class="hidden mr-3 w-64 rounded-2xl bg-white/95 dark:bg-[#0b1220]/95 backdrop-blur-xl border border-slate-200 dark:border-white/10 shadow-2xl p-3.5 space-y-3 transition-all duration-300">
        <div class="flex items-center justify-between pb-2 border-b border-slate-100 dark:border-white/10 text-[10px] font-mono uppercase tracking-wider text-slate-500 dark:text-slate-400">
            <span class="inline-flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" style="color: var(--theme-primary); stroke: var(--theme-primary);">
                    <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
                <span>Material Palette</span>
            </span>
            <span class="text-[var(--theme-primary)] font-bold">Accent</span>
        </div>
        <div class="grid grid-cols-3 gap-2">
            <!-- 1. Cyan (Default Cyber) -->
            <button type="button" onclick="applyMaterialColor('#00e5ff', 'Cyan')" data-color="#00e5ff"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer" title="Cyber Cyan">
                <span class="w-5 h-5 rounded-full bg-[#00e5ff] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Cyan</span>
            </button>
            <!-- 2. Deep Orange (Laravel Flame) -->
            <button type="button" onclick="applyMaterialColor('#ff5722', 'Laravel Orange')" data-color="#ff5722"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer" title="Laravel Deep Orange">
                <span class="w-5 h-5 rounded-full bg-[#ff5722] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Orange</span>
            </button>
            <!-- 3. Teal -->
            <button type="button" onclick="applyMaterialColor('#00bfa5', 'Teal')" data-color="#00bfa5"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer" title="Teal Green">
                <span class="w-5 h-5 rounded-full bg-[#00bfa5] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Teal</span>
            </button>
            <!-- 4. Indigo / Deep Blue -->
            <button type="button" onclick="applyMaterialColor('#3d5afe', 'Indigo')" data-color="#3d5afe"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer" title="Electric Indigo">
                <span class="w-5 h-5 rounded-full bg-[#3d5afe] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Indigo</span>
            </button>
            <!-- 5. Amber -->
            <button type="button" onclick="applyMaterialColor('#ffc107', 'Amber')" data-color="#ffc107"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer" title="Amber Gold">
                <span class="w-5 h-5 rounded-full bg-[#ffc107] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Amber</span>
            </button>
            <!-- 6. Pink -->
            <button type="button" onclick="applyMaterialColor('#ff4081', 'Pink')" data-color="#ff4081"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer" title="Neon Pink">
                <span class="w-5 h-5 rounded-full bg-[#ff4081] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Pink</span>
            </button>
            <!-- 7. Deep Purple -->
            <button type="button" onclick="applyMaterialColor('#7c4dff', 'Deep Purple')" data-color="#7c4dff"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer" title="Deep Purple">
                <span class="w-5 h-5 rounded-full bg-[#7c4dff] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Purple</span>
            </button>
            <!-- 8. Lime Accent -->
            <button type="button" onclick="applyMaterialColor('#aeea00', 'Lime Accent')" data-color="#aeea00"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer" title="Lime Accent">
                <span class="w-5 h-5 rounded-full bg-[#aeea00] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Lime</span>
            </button>
            <!-- 9. Electric Blue -->
            <button type="button" onclick="applyMaterialColor('#2979ff', 'Electric Blue')" data-color="#2979ff"
                class="palette-color-btn flex flex-col items-center gap-1 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer" title="Electric Blue">
                <span class="w-5 h-5 rounded-full bg-[#2979ff] shadow-sm transition-transform"></span>
                <span class="text-[9px] font-mono text-slate-600 dark:text-slate-300">Blue</span>
            </button>
        </div>
    </div>

    <!-- Right Fixed Small Button: 6-Tooth Settings Gear SVG in Active Color (Dark & Light Mode) -->
    <button type="button" onclick="togglePaletteMenu()" title="Theme Accent Color & Settings" aria-label="Theme Accent Color & Settings"
        class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white/95 dark:bg-[#070b14]/95 border-2 border-slate-200 dark:border-white/20 hover:border-[var(--theme-primary)] flex items-center justify-center shadow-lg shadow-slate-900/10 dark:shadow-2xl dark:shadow-black/70 hover:scale-110 active:scale-95 transition-all cursor-pointer backdrop-blur-md group">
        <svg class="w-5 h-5 sm:w-5.5 sm:h-5.5 transition-transform duration-500 ease-out group-hover:rotate-90 pointer-events-none drop-shadow-sm"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2.3"
            stroke-linecap="round"
            stroke-linejoin="round"
            style="color: var(--theme-primary); stroke: var(--theme-primary);">
            <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
            <circle cx="12" cy="12" r="3"></circle>
        </svg>
    </button>
</div>

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
                    swatch.classList.add('ring-2', 'ring-offset-2', 'ring-offset-white', 'dark:ring-offset-slate-900', 'ring-[var(--theme-primary)]', 'scale-110');
                } else {
                    swatch.classList.remove('ring-2', 'ring-offset-2', 'ring-offset-white', 'dark:ring-offset-slate-900', 'ring-[var(--theme-primary)]', 'scale-110');
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
