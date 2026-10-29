<!-- =========================================================================
     STICKY MAIN HEADER (Graphic Designer Theme)
     Sticky navigation bar with cosmic violet accents, active route detection,
     and mobile drawer.
     ========================================================================= -->
<header id="mainHeader" class="sticky top-0 z-50 w-full transition-all duration-300 py-4 bg-[#0c0a18]/95 backdrop-blur-xl border-b border-white/5 shadow-2xl shadow-purple-950/40 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#7c3aed] to-[#a855f7] text-white flex items-center justify-center font-extrabold text-lg shadow-lg shadow-purple-900/40 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L2 19.7778H22L12 2ZM12 6.44444L17.7778 16.6667H6.22222L12 6.44444Z"/>
                    </svg>
                </div>
                <div>
                    <span class="font-extrabold text-xl tracking-tight text-white block leading-none font-['Outfit']">
                        @if(!empty($settings['two_word_logo_image']) && file_exists(public_path($settings['two_word_logo_image'])))
                            <img src="{{ asset($settings['two_word_logo_image']) }}" alt="{{ $settings['site_logo_text'] ?? 'Logo' }}" class="h-6 max-w-[140px] object-contain">
                        @elseif(!empty($settings['logo_word_one']) || !empty($settings['logo_word_two']))
                            {{ $settings['logo_word_one'] ?? '' }} <span class="text-[#a855f7]">{{ $settings['logo_word_two'] ?? '' }}</span>
                        @else
                            {{ $settings['site_logo_text'] ?? 'Alex' }}
                        @endif
                    </span>
                    <span class="text-[10px] font-mono tracking-wider text-[#a855f7] uppercase font-semibold">Visual &amp; UI/UX</span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-7 text-xs font-semibold tracking-wide font-['Outfit']">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#7c3aed] dark:text-[#c084fc] font-bold' : 'text-slate-600 dark:text-slate-300 hover:text-[#7c3aed] dark:hover:text-[#c084fc]' }} transition-colors">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-[#7c3aed] dark:text-[#c084fc] font-bold' : 'text-slate-600 dark:text-slate-300 hover:text-[#7c3aed] dark:hover:text-[#c084fc]' }} transition-colors">About</a>
                <a href="{{ route('home') }}#services" class="text-slate-600 dark:text-slate-300 hover:text-[#7c3aed] dark:hover:text-[#c084fc] transition-colors">Services</a>
                <a href="{{ route('portfolio') }}" class="{{ request()->routeIs('portfolio') ? 'text-[#7c3aed] dark:text-[#c084fc] font-bold' : 'text-slate-600 dark:text-slate-300 hover:text-[#7c3aed] dark:hover:text-[#c084fc]' }} transition-colors">Works</a>
                <a href="{{ route('home') }}#resume" class="text-slate-600 dark:text-slate-300 hover:text-[#7c3aed] dark:hover:text-[#c084fc] transition-colors">Resume</a>
                <a href="{{ route('home') }}#skills" class="text-slate-600 dark:text-slate-300 hover:text-[#7c3aed] dark:hover:text-[#c084fc] transition-colors">Skills</a>
                <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog*') ? 'text-[#7c3aed] dark:text-[#c084fc] font-bold' : 'text-slate-600 dark:text-slate-300 hover:text-[#7c3aed] dark:hover:text-[#c084fc]' }} transition-colors">Blog</a>
                <a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'text-[#7c3aed] dark:text-[#c084fc] font-bold' : 'text-slate-600 dark:text-slate-300 hover:text-[#7c3aed] dark:hover:text-[#c084fc]' }} transition-colors">FAQ</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-[#7c3aed] dark:text-[#c084fc] font-bold' : 'text-slate-600 dark:text-slate-300 hover:text-[#7c3aed] dark:hover:text-[#c084fc]' }} transition-colors">Contact</a>
            </nav>

            <!-- Header Actions (CTA + Auth) -->
            <div class="flex items-center gap-3">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-white/10 hover:bg-white/20 text-white border border-white/15 transition-all">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span>Admin Panel</span>
                        </a>
                    @endif
                @endauth

                <a href="{{ route('contact') }}" class="gd-btn-primary py-2 px-5 text-xs">
                    <span>Let's Talk</span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>

                <!-- Mobile Menu Hamburger Button -->
                <button id="gdMobileToggle" type="button" class="md:hidden w-9 h-9 rounded-lg bg-[#191530] border border-white/10 text-[#c084fc] flex items-center justify-center hover:bg-[#7c3aed] hover:text-white transition-colors cursor-pointer" title="Toggle Navigation">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                        <rect width="6" height="6" rx="1" x="1" y="1"/>
                        <rect width="6" height="6" rx="1" x="9" y="1"/>
                        <rect width="6" height="6" rx="1" x="1" y="9"/>
                        <rect width="6" height="6" rx="1" x="9" y="9"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Responsive Mobile Drawer / Menu -->
        <div id="gdMobileMenu" class="hidden md:hidden pt-4 pb-2 border-t border-white/5 mt-3 space-y-2">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('home') ? 'bg-[#7c3aed]/10 text-[#7c3aed] dark:bg-[#7c3aed]/20 dark:text-[#c084fc]' : 'text-neutral-700 dark:text-neutral-300 hover:bg-black/5 dark:hover:bg-white/5 hover:text-[#7c3aed]' }}">Home</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('about') ? 'bg-[#7c3aed]/10 text-[#7c3aed] dark:bg-[#7c3aed]/20 dark:text-[#c084fc]' : 'text-neutral-700 dark:text-neutral-300 hover:bg-black/5 dark:hover:bg-white/5 hover:text-[#7c3aed]' }}">About</a>
            <a href="{{ route('home') }}#services" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider text-neutral-700 dark:text-neutral-300 hover:bg-black/5 dark:hover:bg-white/5 hover:text-[#7c3aed]">Services</a>
            <a href="{{ route('portfolio') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('portfolio') ? 'bg-[#7c3aed]/10 text-[#7c3aed] dark:bg-[#7c3aed]/20 dark:text-[#c084fc]' : 'text-neutral-700 dark:text-neutral-300 hover:bg-black/5 dark:hover:bg-white/5 hover:text-[#7c3aed]' }}">Works</a>
            <a href="{{ route('home') }}#resume" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider text-neutral-700 dark:text-neutral-300 hover:bg-black/5 dark:hover:bg-white/5 hover:text-[#7c3aed]">Resume</a>
            <a href="{{ route('home') }}#skills" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider text-neutral-700 dark:text-neutral-300 hover:bg-black/5 dark:hover:bg-white/5 hover:text-[#7c3aed]">Skills</a>
            <a href="{{ route('blog') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('blog*') ? 'bg-[#7c3aed]/10 text-[#7c3aed] dark:bg-[#7c3aed]/20 dark:text-[#c084fc]' : 'text-neutral-700 dark:text-neutral-300 hover:bg-black/5 dark:hover:bg-white/5 hover:text-[#7c3aed]' }}">Blog</a>
            <a href="{{ route('faq') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('faq') ? 'bg-[#7c3aed]/10 text-[#7c3aed] dark:bg-[#7c3aed]/20 dark:text-[#c084fc]' : 'text-neutral-700 dark:text-neutral-300 hover:bg-black/5 dark:hover:bg-white/5 hover:text-[#7c3aed]' }}">FAQ</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('contact') ? 'bg-[#7c3aed]/10 text-[#7c3aed] dark:bg-[#7c3aed]/20 dark:text-[#c084fc]' : 'text-neutral-700 dark:text-neutral-300 hover:bg-black/5 dark:hover:bg-white/5 hover:text-[#7c3aed]' }}">Contact</a>
        </div>

    </div>
</header>
