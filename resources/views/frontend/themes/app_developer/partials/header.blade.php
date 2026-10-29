<!-- =========================================================================
     TOP INFO BAR & STICKY MAIN HEADER (App Developer Theme)
     Consistent with developer & UI/UX themes: Top Info Bar with Download CV,
     Sticky Navigation bar with active route highlight, Admin Panel shortcut,
     and mobile drawer.
     ========================================================================= -->
<!-- Top Info Bar (Desktop) -->
<div
    class="bg-[#0a0a0a] border-b border-white/5 py-2 text-xs text-neutral-400 hidden lg:block font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <div class="flex items-center gap-6">
            <a href="mailto:{{ $settings['contact_email'] ?? 'hello@portfolio.me' }}"
                class="flex items-center gap-2 hover:text-[#ff0033] transition-colors">
                <span class="text-[#ff0033]">✉</span>
                <span>{{ $settings['contact_email'] ?? 'hello@portfolio.me' }}</span>
            </a>
            <a href="tel:{{ $settings['contact_phone'] ?? '+15553829012' }}"
                class="flex items-center gap-2 hover:text-[#ff0033] transition-colors font-mono">
                <span class="text-[#ff0033]">☎</span>
                <span>{{ $settings['contact_phone'] ?? '+1 (555) 382-9012' }}</span>
            </a>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3 pr-4 border-r border-white/10 text-neutral-400">
                <a href="{{ $settings['social_github'] ?? 'https://github.com' }}" target="_blank"
                    class="hover:text-[#ff0033] transition-colors">GitHub</a>
                <span>•</span>
                <a href="{{ $settings['social_linkedin'] ?? 'https://linkedin.com' }}" target="_blank"
                    class="hover:text-[#ff0033] transition-colors">LinkedIn</a>
                <span>•</span>
                <a href="{{ $settings['social_twitter'] ?? 'https://twitter.com' }}" target="_blank"
                    class="hover:text-[#ff0033] transition-colors">Twitter</a>
            </div>
            <a href="{{ route('cv.download') }}" download
                class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-[#ff0033] text-white font-bold text-[11px] uppercase tracking-wider hover:bg-[#e60026] shadow-md shadow-[#ff0033]/25 transition-all">
                <span>DOWNLOAD CV</span>
                <span>↓</span>
            </a>
        </div>
    </div>
</div>

<!-- Main Sticky Navigation Bar -->
<header id="mainHeader"
    class="sticky top-0 z-50 w-full transition-all duration-300 py-3.5 bg-[#070707]/95 backdrop-blur-xl border-b border-white/5 shadow-2xl shadow-black/80 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">

            <!-- Brand Logo: Red Emblem + Bold Title -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <div
                    class="w-9 h-9 rounded-xl bg-gradient-to-tr from-[#ff0033] to-[#ff2a4b] text-white flex items-center justify-center font-black text-base shadow-lg shadow-[#ff0033]/30 group-hover:scale-105 transition-transform">
                    {{ strtoupper(substr($settings['logo_word_one'] ?? 'A', 0, 1)) }}
                </div>
                <span class="font-extrabold text-2xl tracking-wider text-white font-['Outfit'] uppercase">
                    @if(!empty($settings['two_word_logo_image']) && file_exists(public_path($settings['two_word_logo_image'])))
                        <img src="{{ asset($settings['two_word_logo_image']) }}" alt="{{ $settings['site_logo_text'] ?? 'Logo' }}" class="h-8 max-w-[160px] object-contain">
                    @elseif(!empty($settings['logo_word_one']) || !empty($settings['logo_word_two']))
                        {{ $settings['logo_word_one'] ?? '' }}<span class="text-[#ff0033] ml-1">{{ $settings['logo_word_two'] ?? '' }}.</span>
                    @else
                        {{ $settings['site_logo_text'] ?? 'ALEX' }}<span class="text-[#ff0033]">.</span>
                    @endif
                </span>
            </a>

            <!-- Desktop Navigation Links -->
            <nav
                class="hidden md:flex items-center gap-6 lg:gap-7 text-xs font-bold tracking-wider uppercase font-['Outfit']">
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'text-[#ff0033]' : 'text-neutral-400 hover:text-[#ff0033]' }} transition-colors">Home</a>
                <a href="{{ route('about') }}"
                    class="{{ request()->routeIs('about') ? 'text-[#ff0033]' : 'text-neutral-400 hover:text-[#ff0033]' }} transition-colors">About</a>
                <a href="{{ route('home') }}#services"
                    class="text-neutral-400 hover:text-[#ff0033] transition-colors">Services</a>
                <a href="{{ route('portfolio') }}"
                    class="{{ request()->routeIs('portfolio') ? 'text-[#ff0033]' : 'text-neutral-400 hover:text-[#ff0033]' }} transition-colors">Portfolio</a>
                <a href="{{ route('home') }}#resume"
                    class="text-neutral-400 hover:text-[#ff0033] transition-colors">Resume</a>
                <a href="{{ route('home') }}#skills"
                    class="text-neutral-400 hover:text-[#ff0033] transition-colors">Skills</a>
                <a href="{{ route('blog') }}"
                    class="{{ request()->routeIs('blog*') ? 'text-[#ff0033]' : 'text-neutral-400 hover:text-[#ff0033]' }} transition-colors">Blog</a>
                <a href="{{ route('faq') }}"
                    class="{{ request()->routeIs('faq') ? 'text-[#ff0033]' : 'text-neutral-400 hover:text-[#ff0033]' }} transition-colors">FAQ</a>
                <a href="{{ route('contact') }}"
                    class="{{ request()->routeIs('contact') ? 'text-[#ff0033]' : 'text-neutral-400 hover:text-[#ff0033]' }} transition-colors">Contact</a>
            </nav>

            <!-- Header Actions -->
            <div class="flex items-center gap-3">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                            class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-white/10 hover:bg-white/20 text-white border border-white/15 transition-all">
                            <span class="w-2 h-2 rounded-full bg-[#ff0033] animate-pulse"></span>
                            <span>Admin Panel</span>
                        </a>
                    @endif
                @endauth

                <!-- Red CTA Button -->
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 py-2 px-5 rounded-full text-xs font-black uppercase tracking-wider bg-gradient-to-r from-[#ff0033] to-[#e60026] hover:from-[#e60026] hover:to-[#cc0022] text-white shadow-lg shadow-[#ff0033]/25 transition-all hover:scale-105 active:scale-95">
                    <span>Let's Talk</span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>

                <!-- Mobile Menu Hamburger Button -->
                <button id="appDevMobileToggle" type="button"
                    class="md:hidden w-9 h-9 rounded-lg bg-[#141414] border border-white/10 text-[#ff0033] flex items-center justify-center hover:bg-[#ff0033] hover:text-white transition-colors cursor-pointer"
                    title="Toggle Navigation">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                        <rect width="6" height="6" rx="1" x="1" y="1" />
                        <rect width="6" height="6" rx="1" x="9" y="1" />
                        <rect width="6" height="6" rx="1" x="1" y="9" />
                        <rect width="6" height="6" rx="1" x="9" y="9" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Responsive Mobile Drawer / Menu -->
        <div id="appDevMobileMenu" class="hidden md:hidden pt-4 pb-2 border-t border-white/5 mt-3 space-y-2">
            <a href="{{ route('home') }}"
                class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('home') ? 'bg-[#ff0033]/10 text-[#ff0033]' : 'text-neutral-300 hover:bg-white/5' }}">Home</a>
            <a href="{{ route('about') }}"
                class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('about') ? 'bg-[#ff0033]/10 text-[#ff0033]' : 'text-neutral-300 hover:bg-white/5' }}">About</a>
            <a href="{{ route('home') }}#services"
                class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider text-neutral-300 hover:bg-white/5">Services</a>
            <a href="{{ route('portfolio') }}"
                class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('portfolio') ? 'bg-[#ff0033]/10 text-[#ff0033]' : 'text-neutral-300 hover:bg-white/5' }}">Portfolio</a>
            <a href="{{ route('home') }}#resume"
                class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider text-neutral-300 hover:bg-white/5">Resume</a>
            <a href="{{ route('home') }}#skills"
                class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider text-neutral-300 hover:bg-white/5">Skills</a>
            <a href="{{ route('blog') }}"
                class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('blog*') ? 'bg-[#ff0033]/10 text-[#ff0033]' : 'text-neutral-300 hover:bg-white/5' }}">Blog</a>
            <a href="{{ route('faq') }}"
                class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('faq') ? 'bg-[#ff0033]/10 text-[#ff0033]' : 'text-neutral-300 hover:bg-white/5' }}">FAQ</a>
            <a href="{{ route('contact') }}"
                class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('contact') ? 'bg-[#ff0033]/10 text-[#ff0033]' : 'text-neutral-300 hover:bg-white/5' }}">Contact</a>
        </div>
    </div>
</header>

<script>
    (function() {
        const toggleBtn = document.getElementById('appDevMobileToggle');
        const mobileMenu = document.getElementById('appDevMobileMenu');
        if (toggleBtn && mobileMenu) {
            toggleBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    })();
</script>
