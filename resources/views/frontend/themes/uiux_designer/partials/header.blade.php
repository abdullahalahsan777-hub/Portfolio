<!-- =========================================================================
     STICKY MAIN HEADER (UI/UX Designer Theme - Portfo.)
     Sticky navigation bar with neon lime accents, active route detection,
     and mobile drawer.
     ========================================================================= -->
<header id="mainHeader" class="sticky top-0 z-50 w-full transition-all duration-300 py-4 bg-[#080808]/95 backdrop-blur-xl border-b border-white/5 shadow-2xl shadow-black/80 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            
            <!-- Brand Logo: Portfo with Lime Star -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <span class="text-[#ccff00] text-xl font-bold font-mono group-hover:rotate-45 transition-transform">✦</span>
                <span class="font-extrabold text-2xl tracking-tight text-white font-['Outfit']">
                    @if(!empty($settings['two_word_logo_image']) && file_exists(public_path($settings['two_word_logo_image'])))
                        <img src="{{ asset($settings['two_word_logo_image']) }}" alt="{{ $settings['site_logo_text'] ?? 'Logo' }}" class="h-8 max-w-[160px] object-contain">
                    @elseif(!empty($settings['logo_word_one']) || !empty($settings['logo_word_two']))
                        {{ $settings['logo_word_one'] ?? 'Portfo' }}<span class="text-[#ccff00] ml-1">{{ $settings['logo_word_two'] ?? 'lio' }}.</span>
                    @else
                        Portfo<span class="text-[#ccff00]">.</span>
                    @endif
                </span>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-7 text-xs font-semibold tracking-wide font-['Outfit']">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#ccff00] font-bold' : 'text-neutral-400 hover:text-[#ccff00]' }} transition-colors">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-[#ccff00] font-bold' : 'text-neutral-400 hover:text-[#ccff00]' }} transition-colors">About</a>
                <a href="{{ route('home') }}#services" class="text-neutral-400 hover:text-[#ccff00] transition-colors">Services</a>
                <a href="{{ route('home') }}#tools" class="text-neutral-400 hover:text-[#ccff00] transition-colors">Tools</a>
                <a href="{{ route('portfolio') }}" class="{{ request()->routeIs('portfolio') ? 'text-[#ccff00] font-bold' : 'text-neutral-400 hover:text-[#ccff00]' }} transition-colors">Portfolio</a>
                <a href="{{ route('home') }}#pricing" class="text-neutral-400 hover:text-[#ccff00] transition-colors">Pricing</a>
                <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog*') ? 'text-[#ccff00] font-bold' : 'text-neutral-400 hover:text-[#ccff00]' }} transition-colors">Blog</a>
                <a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'text-[#ccff00] font-bold' : 'text-neutral-400 hover:text-[#ccff00]' }} transition-colors">FAQ</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-[#ccff00] font-bold' : 'text-neutral-400 hover:text-[#ccff00]' }} transition-colors">Contact</a>
            </nav>

            <!-- Header Actions (CTA + Admin Access) -->
            <div class="flex items-center gap-3">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-white/10 hover:bg-white/20 text-white border border-white/15 transition-all">
                            <span class="w-2 h-2 rounded-full bg-[#ccff00]"></span>
                            <span>Admin Panel</span>
                        </a>
                    @endif
                @endauth

                <a href="{{ route('contact') }}" class="uiux-btn-primary py-2 px-5 text-xs">
                    <span>Let's Talk</span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>

                <!-- Mobile Menu Hamburger Button -->
                <button id="uiuxMobileToggle" type="button" class="md:hidden w-9 h-9 rounded-lg bg-[#141414] border border-white/10 text-[#ccff00] flex items-center justify-center hover:bg-[#ccff00] hover:text-[#080808] transition-colors cursor-pointer" title="Toggle Navigation">
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
        <div id="uiuxMobileMenu" class="hidden md:hidden pt-4 pb-2 border-t border-white/5 mt-3 space-y-2">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('home') ? 'bg-[#ccff00]/10 text-[#ccff00]' : 'text-neutral-300 hover:bg-white/5' }}">Home</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('about') ? 'bg-[#ccff00]/10 text-[#ccff00]' : 'text-neutral-300 hover:bg-white/5' }}">About</a>
            <a href="{{ route('home') }}#services" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider text-neutral-300 hover:bg-white/5">Services</a>
            <a href="{{ route('home') }}#tools" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider text-neutral-300 hover:bg-white/5">Tools</a>
            <a href="{{ route('portfolio') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('portfolio') ? 'bg-[#ccff00]/10 text-[#ccff00]' : 'text-neutral-300 hover:bg-white/5' }}">Portfolio</a>
            <a href="{{ route('home') }}#pricing" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider text-neutral-300 hover:bg-white/5">Pricing</a>
            <a href="{{ route('blog') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('blog*') ? 'bg-[#ccff00]/10 text-[#ccff00]' : 'text-neutral-300 hover:bg-white/5' }}">Blog</a>
            <a href="{{ route('faq') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('faq') ? 'bg-[#ccff00]/10 text-[#ccff00]' : 'text-neutral-300 hover:bg-white/5' }}">FAQ</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('contact') ? 'bg-[#ccff00]/10 text-[#ccff00]' : 'text-neutral-300 hover:bg-white/5' }}">Contact</a>
        </div>

    </div>
</header>
