<!-- =========================================================================
     TOP INFO BAR & STICKY MAIN HEADER (Developer Theme - GLINT)
     Sticky navigation bar with active route highlight and mobile support.
     ========================================================================= -->
<!-- Top Info Bar (Desktop) -->
<div class="bg-[#0a0a0a] border-b border-white/5 py-2 text-xs text-neutral-400 hidden lg:block">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <div class="flex items-center gap-6">
            <a href="mailto:{{ $settings['contact_email'] ?? 'glint.info@gmail.com' }}" class="flex items-center gap-2 hover:text-[#00ff88] transition-colors">
                <span class="text-[#00ff88]">✉</span>
                <span>{{ $settings['contact_email'] ?? 'glint.info@gmail.com' }}</span>
            </a>
            <a href="tel:{{ $settings['contact_phone'] ?? '+1234567890' }}" class="flex items-center gap-2 hover:text-[#00ff88] transition-colors font-mono">
                <span class="text-[#00ff88]">☎</span>
                <span>{{ $settings['contact_phone'] ?? '+1 234 567 8900' }}</span>
            </a>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3 pr-4 border-r border-white/10 text-neutral-400">
                <a href="https://github.com" target="_blank" class="hover:text-[#00ff88] transition-colors">GitHub</a>
                <span>•</span>
                <a href="{{ $settings['social_linkedin'] ?? 'https://linkedin.com' }}" target="_blank" class="hover:text-[#00ff88] transition-colors">LinkedIn</a>
                <span>•</span>
                <a href="{{ $settings['social_twitter'] ?? 'https://twitter.com' }}" target="_blank" class="hover:text-[#00ff88] transition-colors">Twitter</a>
            </div>
            <a href="{{ route('cv.download') }}" download class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#00ff88] text-[#070707] font-bold text-[11px] uppercase tracking-wider hover:bg-[#00df76] transition-all">
                <span>DOWNLOAD CV</span>
                <span>↓</span>
            </a>
        </div>
    </div>
</div>

<!-- Main Sticky Navigation Bar -->
<header id="mainHeader" class="sticky top-0 z-50 w-full transition-all duration-300 py-3.5 bg-[#070707]/95 backdrop-blur-xl border-b border-white/5 shadow-2xl shadow-black/60 font-['Plus_Jakarta_Sans']">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                
                <!-- Brand: GLINT with Emerald Hexagon Cube -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-[#00ff88] to-[#00df76] text-[#070707] flex items-center justify-center font-black text-base shadow-lg shadow-emerald-500/30 group-hover:scale-105 transition-transform">
                        {{ strtoupper(substr($settings['logo_word_one'] ?? 'G', 0, 1)) }}
                    </div>
                    <span class="font-extrabold text-2xl tracking-widest text-white font-['Outfit'] uppercase">
                        @if(!empty($settings['two_word_logo_image']) && file_exists(public_path($settings['two_word_logo_image'])))
                            <img src="{{ asset($settings['two_word_logo_image']) }}" alt="{{ $settings['site_logo_text'] ?? 'Logo' }}" class="h-8 max-w-[160px] object-contain">
                        @elseif(!empty($settings['logo_word_one']) || !empty($settings['logo_word_two']))
                            {{ $settings['logo_word_one'] ?? '' }}<span class="text-[#00ff88] ml-1">{{ $settings['logo_word_two'] ?? '' }}.</span>
                        @else
                            {{ $settings['site_logo_text'] ?? 'GLINT' }}<span class="text-[#00ff88]">.</span>
                        @endif
                    </span>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-7 text-xs font-bold tracking-wider uppercase font-['Outfit']">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#00ff88]' : 'text-neutral-400 hover:text-[#00ff88]' }} transition-colors">Home</a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-[#00ff88]' : 'text-neutral-400 hover:text-[#00ff88]' }} transition-colors">About</a>
                    <a href="{{ route('home') }}#services" class="text-neutral-400 hover:text-[#00ff88] transition-colors">Services</a>
                    <a href="{{ route('portfolio') }}" class="{{ request()->routeIs('portfolio') ? 'text-[#00ff88]' : 'text-neutral-400 hover:text-[#00ff88]' }} transition-colors">Portfolio</a>
                    <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog*') ? 'text-[#00ff88]' : 'text-neutral-400 hover:text-[#00ff88]' }} transition-colors">Blog</a>
                    <a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'text-[#00ff88]' : 'text-neutral-400 hover:text-[#00ff88]' }} transition-colors">FAQ</a>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-[#00ff88]' : 'text-neutral-400 hover:text-[#00ff88]' }} transition-colors">Contact</a>
                </nav>

                <!-- Header Actions -->
                <div class="flex items-center gap-3">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-white/10 hover:bg-white/20 text-white border border-white/15 transition-all">
                                <span class="w-2 h-2 rounded-full bg-[#00ff88]"></span>
                                <span>Admin Panel</span>
                            </a>
                        @endif
                    @endauth

                    <a href="{{ route('contact') }}" class="dev-btn-primary py-2 px-5 text-xs">
                        <span>Get In Touch</span>
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    <!-- Mobile Menu Hamburger / Grid Toggle -->
                    <button id="devMobileToggle" type="button" class="md:hidden w-9 h-9 rounded-lg bg-[#141414] border border-white/10 text-[#00ff88] flex items-center justify-center hover:bg-[#00ff88] hover:text-[#070707] transition-colors cursor-pointer" title="Toggle Navigation">
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
            <div id="devMobileMenu" class="hidden md:hidden pt-4 pb-2 border-t border-white/5 mt-3 space-y-2">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('home') ? 'bg-[#00ff88]/10 text-[#00ff88]' : 'text-neutral-300 hover:bg-white/5' }}">Home</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('about') ? 'bg-[#00ff88]/10 text-[#00ff88]' : 'text-neutral-300 hover:bg-white/5' }}">About</a>
                <a href="{{ route('home') }}#services" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider text-neutral-300 hover:bg-white/5">Services</a>
                <a href="{{ route('portfolio') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('portfolio') ? 'bg-[#00ff88]/10 text-[#00ff88]' : 'text-neutral-300 hover:bg-white/5' }}">Portfolio</a>
                <a href="{{ route('blog') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('blog*') ? 'bg-[#00ff88]/10 text-[#00ff88]' : 'text-neutral-300 hover:bg-white/5' }}">Blog</a>
                <a href="{{ route('faq') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('faq') ? 'bg-[#00ff88]/10 text-[#00ff88]' : 'text-neutral-300 hover:bg-white/5' }}">FAQ</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('contact') ? 'bg-[#00ff88]/10 text-[#00ff88]' : 'text-neutral-300 hover:bg-white/5' }}">Contact</a>
            </div>

        </div>
    </header>
