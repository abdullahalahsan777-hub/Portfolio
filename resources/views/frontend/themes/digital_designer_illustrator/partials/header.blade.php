<!-- =========================================================================
     TOP INFO BAR & STICKY MAIN HEADER (Digital Designer & Illustrator Theme)
     Standardized matching other themes: Desktop Top Info Bar with Download CV,
     Sticky Navigation bar with active route highlight, Admin Panel shortcut,
     and mobile drawer.
     ========================================================================= -->
<!-- Top Info Bar (Desktop) -->
<div class="bg-[#f1f5f9] dark:bg-[#111216] border-b border-black/5 dark:border-white/10 py-2 text-xs text-[#64748b] dark:text-[#9aa0aa] hidden lg:block font-['Plus_Jakarta_Sans'] transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <div class="flex items-center gap-6">
            <a href="mailto:{{ $settings['contact_email'] ?? 'alex.walker@design.me' }}" class="flex items-center gap-2 hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">
                <span class="text-[#e26d9b]">✉</span>
                <span>{{ $settings['contact_email'] ?? 'alex.walker@design.me' }}</span>
            </a>
            <a href="tel:{{ $settings['contact_phone'] ?? '+1 (555) 782-9011' }}" class="flex items-center gap-2 hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors font-mono">
                <span class="text-[#e26d9b]">☎</span>
                <span>{{ $settings['contact_phone'] ?? '+1 (555) 782-9011' }}</span>
            </a>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3 pr-4 border-r border-black/10 dark:border-white/10 text-[#64748b] dark:text-[#9aa0aa]">
                <a href="{{ $settings['social_github'] ?? 'https://github.com' }}" target="_blank" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">GitHub</a>
                <span>•</span>
                <a href="{{ $settings['social_linkedin'] ?? 'https://linkedin.com' }}" target="_blank" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">LinkedIn</a>
                <span>•</span>
                <a href="{{ $settings['social_twitter'] ?? 'https://twitter.com' }}" target="_blank" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">Twitter</a>
                <span>•</span>
                <a href="{{ $settings['social_dribbble'] ?? 'https://dribbble.com' }}" target="_blank" class="hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">Dribbble</a>
            </div>
            <a href="{{ route('cv.download') }}" download class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-[#e26d9b] text-white font-bold text-[11px] uppercase tracking-wider hover:bg-[#cf5685] shadow-md shadow-[#e26d9b]/25 transition-all">
                <span>DOWNLOAD CV</span>
                <span>↓</span>
            </a>
        </div>
    </div>
</div>

<!-- Main Sticky Navigation Bar -->
<header id="mainHeader" class="sticky top-0 z-50 w-full transition-all duration-300 py-3.5 bg-white/90 dark:bg-[#0c0d10]/90 backdrop-blur-xl border-b border-black/5 dark:border-white/10 shadow-sm font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            
            <!-- Brand Logo: Botanical Monogram + Editorial Name -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-[#ffffff] to-[#fff0f5] text-[#e26d9b] border border-[#e26d9b]/30 dark:from-white/15 dark:to-white/5 dark:text-white dark:border-white/10 flex items-center justify-center font-serif italic text-base shadow-sm group-hover:scale-105 transition-transform">
                    {{ strtoupper(substr($settings['logo_word_one'] ?? 'A', 0, 1) . substr($settings['logo_word_two'] ?? 'A', 0, 1)) }}
                </div>
                <span class="font-bold text-2xl tracking-tight text-[#111215] dark:text-white font-['Outfit']">
                    @if(!empty($settings['two_word_logo_image']) && file_exists(public_path($settings['two_word_logo_image'])))
                        <img src="{{ asset($settings['two_word_logo_image']) }}" alt="{{ $settings['site_logo_text'] ?? 'Logo' }}" class="h-8 max-w-[160px] object-contain">
                    @elseif(!empty($settings['logo_word_one']) || !empty($settings['logo_word_two']))
                        {{ $settings['logo_word_one'] ?? '' }}<span class="text-[#e26d9b] ml-1">{{ $settings['logo_word_two'] ?? '' }}.</span>
                    @else
                        {{ $settings['site_logo_text'] ?? 'Alex' }}<span class="text-[#e26d9b]">.</span>
                    @endif
                </span>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-6 lg:gap-7 text-xs font-semibold tracking-wider uppercase font-['Outfit']">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#e26d9b] font-bold' : 'text-[#444955] dark:text-[#a0a6b2] hover:text-[#e26d9b] dark:hover:text-[#e26d9b]' }} transition-colors">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-[#e26d9b] font-bold' : 'text-[#444955] dark:text-[#a0a6b2] hover:text-[#e26d9b] dark:hover:text-[#e26d9b]' }} transition-colors">About</a>
                <a href="{{ route('home') }}#services" class="text-[#444955] dark:text-[#a0a6b2] hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">Services</a>
                <a href="{{ route('portfolio') }}" class="{{ request()->routeIs('portfolio') ? 'text-[#e26d9b] font-bold' : 'text-[#444955] dark:text-[#a0a6b2] hover:text-[#e26d9b] dark:hover:text-[#e26d9b]' }} transition-colors">Works</a>
                <a href="{{ route('home') }}#journey" class="text-[#444955] dark:text-[#a0a6b2] hover:text-[#e26d9b] dark:hover:text-[#e26d9b] transition-colors">Journey</a>
                <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog*') ? 'text-[#e26d9b] font-bold' : 'text-[#444955] dark:text-[#a0a6b2] hover:text-[#e26d9b] dark:hover:text-[#e26d9b]' }} transition-colors">Blog</a>
                <a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'text-[#e26d9b] font-bold' : 'text-[#444955] dark:text-[#a0a6b2] hover:text-[#e26d9b] dark:hover:text-[#e26d9b]' }} transition-colors">FAQ</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-[#e26d9b] font-bold' : 'text-[#444955] dark:text-[#a0a6b2] hover:text-[#e26d9b] dark:hover:text-[#e26d9b]' }} transition-colors">Contact</a>
            </nav>

            <!-- Header Actions -->
            <div class="flex items-center gap-3">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-black/5 dark:bg-white/10 hover:bg-black/10 dark:hover:bg-white/20 text-[#111215] dark:text-white border border-black/10 dark:border-white/10 transition-all">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>Admin Panel</span>
                        </a>
                    @endif
                @endauth

                <!-- Editorial CTA Button -->
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 py-2 px-5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#e26d9b] text-white hover:bg-[#cf5685] shadow-md shadow-[#e26d9b]/25 transition-all hover:scale-105 active:scale-95">
                    <span>Let's Talk</span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>

                <!-- Mobile Menu Hamburger Button -->
                <button id="digiMobileToggle" type="button" class="md:hidden w-9 h-9 rounded-lg bg-white/70 dark:bg-white/10 border border-black/10 dark:border-white/10 text-[#111215] dark:text-white flex items-center justify-center hover:bg-[#e26d9b] hover:text-white transition-colors cursor-pointer" title="Toggle Navigation">
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
        <div id="digiMobileMenu" class="hidden md:hidden pt-4 pb-2 border-t border-black/5 dark:border-white/10 mt-3 space-y-2">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('home') ? 'bg-[#e26d9b]/15 text-[#e26d9b]' : 'text-[#111215] dark:text-white hover:bg-black/5 dark:hover:bg-white/5' }}">Home</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('about') ? 'bg-[#e26d9b]/15 text-[#e26d9b]' : 'text-[#111215] dark:text-white hover:bg-black/5 dark:hover:bg-white/5' }}">About</a>
            <a href="{{ route('home') }}#services" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider text-[#111215] dark:text-white hover:bg-black/5 dark:hover:bg-white/5">Services</a>
            <a href="{{ route('portfolio') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('portfolio') ? 'bg-[#e26d9b]/15 text-[#e26d9b]' : 'text-[#111215] dark:text-white hover:bg-black/5 dark:hover:bg-white/5' }}">Works</a>
            <a href="{{ route('home') }}#journey" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider text-[#111215] dark:text-white hover:bg-black/5 dark:hover:bg-white/5">Journey</a>
            <a href="{{ route('blog') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('blog*') ? 'bg-[#e26d9b]/15 text-[#e26d9b]' : 'text-[#111215] dark:text-white hover:bg-black/5 dark:hover:bg-white/5' }}">Blog</a>
            <a href="{{ route('faq') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('faq') ? 'bg-[#e26d9b]/15 text-[#e26d9b]' : 'text-[#111215] dark:text-white hover:bg-black/5 dark:hover:bg-white/5' }}">FAQ</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('contact') ? 'bg-[#e26d9b]/15 text-[#e26d9b]' : 'text-[#111215] dark:text-white hover:bg-black/5 dark:hover:bg-white/5' }}">Contact</a>
        </div>
    </div>
</header>

<script>
    (function() {
        const toggleBtn = document.getElementById('digiMobileToggle');
        const mobileMenu = document.getElementById('digiMobileMenu');
        if (toggleBtn && mobileMenu) {
            toggleBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    })();
</script>
