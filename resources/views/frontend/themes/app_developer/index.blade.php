<!DOCTYPE html>
<html lang="en" class="scroll-smooth" data-theme-mode="{{ $themeMode ?? 'system' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings['site_title'] ?? 'Alex Rivera — Full Stack & App Developer' }}</title>
    <meta name="description" content="Portfolio of Alex Rivera, elite Full Stack Developer and Mobile App Architect specializing in iOS, Android, Flutter, React Native, and high-concurrency cloud backend architectures.">

    <!-- Google Fonts: Bebas Neue (Condensed Headlines matching reference), Outfit (Modern Display), Plus Jakarta Sans (Readable Body), JetBrains Mono (Telemetry) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Theme Mode Initialization (Dark / Light / System) -->
    <script>
        (function() {
            const mode = "{{ $themeMode ?? 'system' }}";
            function resolveMode(m) {
                if (m === 'system') {
                    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                }
                return m === 'light' ? 'light' : 'dark';
            }
            function applyThemeMode(m) {
                const resolved = resolveMode(m);
                const root = document.documentElement;
                root.setAttribute('data-theme-mode', m);
                root.setAttribute('color-scheme', resolved);
                if (resolved === 'dark') {
                    root.classList.add('dark');
                    root.classList.remove('light');
                    if (document.body) {
                        document.body.classList.add('dark-mode');
                        document.body.classList.remove('light-mode');
                    }
                } else {
                    root.classList.add('light');
                    root.classList.remove('dark');
                    if (document.body) {
                        document.body.classList.add('light-mode');
                        document.body.classList.remove('dark-mode');
                    }
                }
            }
            applyThemeMode(mode);
            if (mode === 'system' && window.matchMedia) {
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function() {
                    applyThemeMode('system');
                });
            }
            document.addEventListener('DOMContentLoaded', function() {
                applyThemeMode(mode);
            });
        })();
    </script>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Bebas Neue Condensed Impact Headlines */
        .font-headline {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 0.04em;
        }
        .font-display {
            font-family: 'Outfit', sans-serif;
        }

        /* Ambient glowing pulse */
        @keyframes pulseGlow {
            0%, 100% { opacity: 0.25; transform: scale(1); }
            50% { opacity: 0.45; transform: scale(1.06); }
        }
        .pulse-ambient {
            animation: pulseGlow 7s ease-in-out infinite;
        }

        /* Expert Glassmorphism Card Utility */
        .app-card {
            background: linear-gradient(180deg, rgba(22, 22, 22, 0.85) 0%, rgba(11, 11, 11, 0.95) 100%);
            border: 1px solid rgba(255, 255, 255, 0.07);
            box-shadow: 0 10px 30px -15px rgba(0, 0, 0, 0.8);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .app-card:hover {
            border-color: rgba(255, 0, 51, 0.5);
            box-shadow: 0 15px 35px -10px rgba(255, 0, 51, 0.25), 0 0 15px rgba(255, 0, 51, 0.1);
            transform: translateY(-4px);
        }

        /* Red pill primary CTA button */
        .btn-pill-red {
            background: linear-gradient(135deg, #ff0033 0%, #e60026 100%);
            color: #ffffff;
            box-shadow: 0 8px 25px -4px rgba(255, 0, 51, 0.5);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-pill-red:hover {
            background: linear-gradient(135deg, #ff1a44 0%, #ff0033 100%);
            box-shadow: 0 12px 30px -4px rgba(255, 0, 51, 0.7);
            transform: scale(1.03);
        }
        .btn-pill-red:active {
            transform: scale(0.98);
        }

        /* 3D Metallic Medal Badges for Follow Us Ribbon */
        .metallic-badge {
            background: radial-gradient(circle at 35% 30%, #3a3a3a 0%, #1c1c1c 55%, #0a0a0a 100%);
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: inset 0 2px 4px rgba(255, 255, 255, 0.35), inset 0 -2px 6px rgba(0, 0, 0, 0.8), 0 10px 25px rgba(0, 0, 0, 0.7);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .metallic-badge:hover {
            border-color: #ff0033;
            box-shadow: inset 0 2px 6px rgba(255, 255, 255, 0.5), 0 0 25px rgba(255, 0, 51, 0.6), 0 12px 30px rgba(0, 0, 0, 0.9);
            transform: translateY(-6px) scale(1.08);
        }

        /* Soft fade for developer hero cutout */
        .hero-portrait-mask {
            mask-image: linear-gradient(to bottom, black 85%, transparent 100%);
            -webkit-mask-image: linear-gradient(to bottom, black 85%, transparent 100%);
        }
    </style>
</head>
<body class="theme-app_developer bg-[#070707] text-[#ffffff] min-h-screen antialiased selection:bg-[#ff0033] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip relative">

    <!-- Sticky Main Header (Kept consistent with other themes as requested) -->
    @include('frontend.themes.app_developer.partials.header')

    <main>
        <!-- =========================================================================
             1. HERO SECTION (Polished to Expert Standards matching Reference Image)
             - Small vertical rail indicators on far left
             - HELLO, I AM pill tag
             - ALEX RIVERA in Crimson Red & FULL STACK DEVELOPER in Pure White (Bebas Neue)
             - Fluid bio paragraph
             - Red pill button HIRE ME with circular arrow
             - Free-standing Developer portrait with deep crimson ambient backlight
             ========================================================================= -->
        <section class="relative pt-8 pb-16 lg:pt-14 lg:pb-24 overflow-hidden bg-gradient-to-b from-[#0a0a0a] via-[#070707] to-[#0a0a0a]">
            <!-- Atmospheric Red Ambient Spotlights -->
            <div class="absolute top-1/4 -left-36 w-[550px] h-[550px] bg-[#ff0033]/15 rounded-full blur-[170px] pointer-events-none pulse-ambient"></div>
            <div class="absolute top-1/3 right-4 w-[650px] h-[650px] bg-[#ff0033]/25 rounded-full blur-[200px] pointer-events-none"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                    
                    <!-- Left: Hero Text & Information -->
                    <div class="lg:col-span-7 relative">
                        
                        <!-- Mini Rail Marker Dots on the Far Left (Matches Reference Image) -->
                        <div class="hidden sm:flex flex-col items-center gap-3 absolute -left-7 top-4">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#ff0033] shadow-[0_0_6px_#ff0033]"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-white/20"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-white/20"></span>
                        </div>

                        <div class="space-y-6 sm:pl-3">
                            <!-- Small Red Pill Badge -->
                            <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-[#180508] border border-[#ff0033]/50 text-[#ff0033] text-xs font-mono font-bold tracking-widest uppercase shadow-md shadow-[#ff0033]/15">
                                <span class="w-2 h-2 rounded-full bg-[#ff0033] animate-ping"></span>
                                <span>HELLO, I AM</span>
                            </div>

                            <!-- Impactful Title Stack (Condensed Bebas Neue Matching Reference Image) -->
                            <div class="space-y-1">
                                <h2 class="text-5xl sm:text-7xl lg:text-8xl font-black font-headline uppercase tracking-wide text-[#ff0033] leading-none drop-shadow-sm">
                                    {{ $settings['hero_title'] ?? 'ALEX RIVERA' }}
                                </h2>
                                <h1 class="text-5xl sm:text-7xl lg:text-8xl font-black font-headline uppercase tracking-wide text-white leading-none">
                                    {{ $settings['hero_subtitle'] ?? 'FULL STACK DEVELOPER' }}
                                </h1>
                            </div>

                            <!-- Divider Dash & Subtitle -->
                            <div class="flex items-center gap-3">
                                <span class="w-10 h-1 bg-[#ff0033] rounded-full"></span>
                                <span class="text-xs font-mono font-bold tracking-wider uppercase text-neutral-400">{{ $settings['hero_badge'] ?? 'Mobile Architect • Cloud Engineer • Cross-Platform Specialist' }}</span>
                            </div>

                            <!-- Brief Bio -->
                            <p class="text-sm sm:text-base text-neutral-400 max-w-xl leading-relaxed">
                                {{ $settings['hero_description'] ?? 'Crafting high-velocity mobile ecosystems on iOS and Android, sub-second API microservices, and reactive user interfaces. Transforming complex operational challenges into elegant, production-grade applications.' }}
                            </p>

                            <!-- CTA Row with Red Pill Button + Social Icons -->
                            <div class="pt-2 flex flex-wrap items-center gap-5 sm:gap-6">
                                
                                <!-- Red Pill HIRE ME with Circular Arrow Badge -->
                                <a href="{{ $settings['hero_cta_url'] ?? route('contact') }}" class="btn-pill-red py-3.5 px-8 rounded-full text-xs font-black uppercase tracking-wider font-display gap-3 group">
                                    <span>{{ $settings['hero_cta_text'] ?? 'Hire Me' }}</span>
                                    <span class="w-6 h-6 rounded-full bg-black/30 group-hover:bg-black/50 flex items-center justify-center text-white text-xs transition-colors">
                                        &rarr;
                                    </span>
                                </a>

                                <!-- Social Icons with Red Hover Ring -->
                                <div class="flex items-center gap-2.5">
                                    <a href="{{ $settings['social_github'] ?? 'https://github.com' }}" target="_blank" class="w-11 h-11 rounded-xl bg-[#141414] border border-white/10 hover:border-[#ff0033] text-neutral-300 hover:text-[#ff0033] flex items-center justify-center transition-all hover:scale-105 shadow-md" title="GitHub">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                                    </a>
                                    <a href="{{ $settings['social_linkedin'] ?? 'https://linkedin.com' }}" target="_blank" class="w-11 h-11 rounded-xl bg-[#141414] border border-white/10 hover:border-[#ff0033] text-neutral-300 hover:text-[#ff0033] flex items-center justify-center transition-all hover:scale-105 shadow-md" title="LinkedIn">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                    </a>
                                    <a href="{{ $settings['social_twitter'] ?? 'https://twitter.com' }}" target="_blank" class="w-11 h-11 rounded-xl bg-[#141414] border border-white/10 hover:border-[#ff0033] text-neutral-300 hover:text-[#ff0033] flex items-center justify-center transition-all hover:scale-105 shadow-md" title="Twitter / X">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Right: Developer Hero Portrait (Seamless cutout with crimson rim backlight matching reference image) -->
                    <div class="lg:col-span-5 relative flex items-center justify-center">
                        <div class="relative w-full max-w-lg">
                            <!-- Radiant Crimson Rim Spotlight -->
                            <div class="absolute inset-0 bg-gradient-to-tr from-[#ff0033]/45 via-red-600/20 to-transparent rounded-full blur-3xl transform scale-110 pointer-events-none"></div>
                            
                            <!-- Free-standing developer portrait with subtle rim glow and bottom soft fade -->
                            <div class="relative overflow-hidden group hero-portrait-mask">
                                <img 
                                    src="{{ !empty($settings['hero_image']) ? asset($settings['hero_image']) : asset('images/app_developer/hero.jpg') }}" 
                                    alt="{{ $settings['hero_title'] ?? 'Alex Rivera Full Stack & App Developer' }}" 
                                    class="w-full h-auto object-cover transform group-hover:scale-102 transition-transform duration-700 drop-shadow-[0_20px_50px_rgba(255,0,51,0.25)]"
                                >
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- =========================================================================
             3. ABOUT SECTION ("WHO AM I ?")
             Left: 4-Element Mosaic Collage matching reference image
             - Collab Team Photo
             - 15k PROJECT COMPLETED (Red & White font)
             - 99 OUR HAPPY CLIENTS
             - 3D Isometric Red Bar Chart
             Right: Bio + Structured Metadata Table + Download CV button
             ========================================================================= -->
        <section id="about" class="py-20 lg:py-28 relative bg-[#0a0a0a]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    
                    <!-- Left: 4-Element Mosaic Collage (Matches Reference Image) -->
                    <div class="lg:col-span-6 grid grid-cols-2 gap-4">
                        
                        <!-- 1. Collab Team Photo -->
                        <div class="rounded-3xl overflow-hidden border border-white/10 shadow-xl bg-[#111111] h-48 sm:h-56 group">
                            <img src="{{ !empty($settings['about_image']) ? asset($settings['about_image']) : (!empty($settings['about_collab_image']) ? asset($settings['about_collab_image']) : asset('images/app_developer/collab.jpg')) }}" alt="Engineering Collaboration" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </div>

                        <!-- 2. PROJECT COMPLETED Stat Card (Centered 15K & PROJECT COMPLETED) -->
                        <div class="p-6 sm:p-8 rounded-3xl bg-[#0f0f0f] border border-white/10 shadow-xl flex flex-col items-center justify-center text-center space-y-2 hover:border-[#ff0033]/50 transition-colors h-48 sm:h-56">
                            <span class="text-6xl sm:text-7xl font-black font-headline text-white leading-none tracking-tight">{{ strtoupper($settings['completed_projects'] ?? '15K') }}</span>
                            <span class="text-xs sm:text-sm font-headline uppercase tracking-wider text-[#ff0033] font-bold block mt-1">{{ $settings['completed_projects_label'] ?? ($settings['counter1_title'] ?? 'PROJECT COMPLETED') }}</span>
                        </div>

                        <!-- 3. OUR HAPPY CLIENTS Stat Card (Centered 99 & OUR HAPPY CLIENTS) -->
                        <div class="p-6 sm:p-8 rounded-3xl bg-[#0f0f0f] border border-white/10 shadow-xl flex flex-col items-center justify-center text-center space-y-2 hover:border-[#ff0033]/50 transition-colors h-48 sm:h-56">
                            <span class="text-6xl sm:text-7xl font-black font-headline text-white leading-none tracking-tight">{{ $settings['satisfied_clients'] ?? '99' }}</span>
                            <span class="text-xs sm:text-sm font-headline uppercase tracking-wider text-[#ff0033] font-bold block mt-1">{{ $settings['satisfied_clients_label'] ?? ($settings['counter2_title'] ?? 'OUR HAPPY CLIENTS') }}</span>
                        </div>

                        <!-- 4. 3D Isometric Red Bar Chart -->
                        <div class="rounded-3xl overflow-hidden border border-white/10 shadow-xl bg-[#111111] h-48 sm:h-56 group">
                            <img src="{{ !empty($settings['about_chart_image']) ? asset($settings['about_chart_image']) : asset('images/app_developer/chart.jpg') }}" alt="3D Red Bar Chart Metrics" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </div>

                    </div>

                    <!-- Right: Bio Information -->
                    <div class="lg:col-span-6 space-y-6">
                        
                        <!-- Section Badge -->
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#ff0033] shadow-[0_0_8px_#ff0033]"></span>
                            <span class="text-xs font-mono font-bold uppercase tracking-widest text-[#ff0033]">ABOUT ME</span>
                        </div>

                        <h2 class="text-5xl sm:text-7xl font-black font-headline uppercase text-white tracking-wide leading-none">
                            {{ $settings['about_heading'] ?? 'WHO AM I ?' }}
                        </h2>

                        <p class="text-sm sm:text-base text-neutral-400 leading-relaxed">
                            {{ $settings['about_description'] ?? 'I am an established Full Stack Engineer & Mobile Architect with over 8 years of dedicated experience building high-throughput consumer apps, scalable cloud microservices, and bespoke software design systems.' }}
                        </p>

                        <!-- Key-Value Information List with Red Dots (Matches Reference Image) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs pt-2">
                            <div class="p-3 rounded-xl bg-[#111111] border border-white/5 flex items-center justify-between">
                                <span class="text-neutral-400 flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#ff0033]"></span> Name:</span>
                                <span class="font-bold text-white">{{ $settings['hero_title'] ?? 'Alex Rivera' }}</span>
                            </div>
                            <div class="p-3 rounded-xl bg-[#111111] border border-white/5 flex items-center justify-between">
                                <span class="text-neutral-400 flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#ff0033]"></span> Experience:</span>
                                <span class="font-bold text-white">{{ $settings['experience_years'] ?? '8' }}+ Years</span>
                            </div>
                            <div class="p-3 rounded-xl bg-[#111111] border border-white/5 flex items-center justify-between">
                                <span class="text-neutral-400 flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#ff0033]"></span> Location:</span>
                                <span class="font-bold text-white">{{ $settings['contact_location'] ?? 'San Francisco, CA' }}</span>
                            </div>
                            <div class="p-3 rounded-xl bg-[#111111] border border-white/5 flex items-center justify-between">
                                <span class="text-neutral-400 flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#ff0033]"></span> Phone:</span>
                                <span class="font-bold text-white">{{ $settings['contact_phone'] ?? '+1 (555) 382-9012' }}</span>
                            </div>
                            <div class="p-3 rounded-xl bg-[#111111] border border-white/5 flex items-center justify-between">
                                <span class="text-neutral-400 flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#ff0033]"></span> Email:</span>
                                <span class="font-bold text-white">{{ $settings['contact_email'] ?? 'hello@portfolio.me' }}</span>
                            </div>
                            <div class="p-3 rounded-xl bg-[#111111] border border-white/5 flex items-center justify-between">
                                <span class="text-neutral-400 flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#ff0033]"></span> Experience:</span>
                                <span class="font-bold text-white">8+ Years Senior</span>
                            </div>
                            <div class="sm:col-span-2 p-3.5 rounded-xl bg-[#180508] border border-[#ff0033]/30 flex items-center justify-between">
                                <span class="text-neutral-400 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-[#ff0033] animate-pulse"></span> Freelance Contracts:</span>
                                <span class="font-black text-[#ff0033] uppercase tracking-wider">Available Now</span>
                            </div>
                        </div>

                        <!-- Download CV Button with Circular Arrow Badge (Matches Reference Image) -->
                        <div class="pt-2">
                            <a href="{{ route('cv.download') }}" download class="btn-pill-red py-3.5 px-8 rounded-full text-xs font-black uppercase tracking-wider font-display gap-3 group">
                                <span>Download CV</span>
                                <span class="w-6 h-6 rounded-full bg-black/30 group-hover:bg-black/50 flex items-center justify-center text-white text-xs transition-colors">
                                    &darr;
                                </span>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- =========================================================================
             4. SERVICES SECTION ("THE BEST SERVICE PROCESS")
             6 Dark Sleek Cards with Red Circular Icons & Centered Layout matching image
             ========================================================================= -->
        <section id="services" class="py-20 lg:py-28 relative bg-[#070707] border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <!-- Section Header -->
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-14">
                    <div class="space-y-2">
                        <span class="text-xs font-mono uppercase tracking-widest text-[#ff0033] font-bold block">// {{ $settings['services_tag'] ?? 'WHAT I DO' }}</span>
                        <h2 class="text-4xl sm:text-6xl font-black font-headline uppercase text-white tracking-wide">
                            {{ $settings['services_heading'] ?? 'THE BEST SERVICE PROCESS' }}
                        </h2>
                    </div>
                    <a href="{{ route('contact') }}" class="btn-pill-red py-2.5 px-6 rounded-full text-xs font-bold uppercase tracking-wider font-display gap-2 group">
                        <span>View All Services</span>
                        <span class="w-5 h-5 rounded-full bg-black/30 flex items-center justify-center text-white text-[10px]">&rarr;</span>
                    </a>
                </div>

                <!-- 6 Service Cards Grid (Centered icons and clean cards matching reference image) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($services as $service)
                        <div class="app-card p-8 rounded-3xl flex flex-col items-center text-center justify-between group">
                            <div class="flex flex-col items-center">
                                <!-- Red Circular Icon Badge with white/red border -->
                                <div class="w-14 h-14 rounded-full bg-[#1c080b] border-2 border-[#ff0033] text-[#ff0033] flex items-center justify-center font-bold text-xl mb-6 group-hover:scale-110 group-hover:bg-[#ff0033] group-hover:text-white transition-all shadow-lg shadow-[#ff0033]/25">
                                    ◈
                                </div>
                                <h3 class="text-xl font-bold font-display text-white group-hover:text-[#ff0033] transition-colors mb-3">
                                    {{ $service->title }}
                                </h3>
                                <p class="text-xs text-neutral-400 leading-relaxed line-clamp-3">
                                    {{ $service->description }}
                                </p>
                            </div>
                            <div class="pt-6 mt-4 border-t border-white/5 w-full flex justify-center">
                                <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-white/5 group-hover:bg-[#ff0033] group-hover:text-white hover:bg-[#ff0033] text-neutral-300 hover:text-white text-xs font-mono uppercase tracking-wider font-bold transition-all">
                                    <span>Read More</span> &rarr;
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12 text-neutral-500">
                            <p class="text-sm">No services configured yet. Add them in the Admin Panel.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </section>

        <!-- =========================================================================
             5. FEATURED PORTFOLIO ("FEATURED PORTFOLIO")
             3-Card Showcase Grid with Dark Metallic Preview, Red Category Tag & Slider Dots
             ========================================================================= -->
        <section id="portfolio" class="py-20 lg:py-28 relative bg-[#0a0a0a] border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <!-- Section Header -->
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-14">
                    <div class="space-y-2">
                        <span class="text-xs font-mono uppercase tracking-widest text-[#ff0033] font-bold block">// SELECTED WORKS</span>
                        <h2 class="text-4xl sm:text-6xl font-black font-headline uppercase text-white tracking-wide">
                            FEATURED PORTFOLIO
                        </h2>
                    </div>
                    <a href="{{ route('portfolio') }}" class="btn-pill-red py-2.5 px-6 rounded-full text-xs font-bold uppercase tracking-wider font-display gap-2 group">
                        <span>View All Projects</span>
                        <span class="w-5 h-5 rounded-full bg-black/30 flex items-center justify-center text-white text-[10px]">&rarr;</span>
                    </a>
                </div>

                <!-- Portfolio Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($projects as $project)
                        <div class="app-card rounded-3xl overflow-hidden flex flex-col justify-between group">
                            <div>
                                <div class="relative h-64 overflow-hidden bg-black/80">
                                    <img 
                                        src="{{ $project->image_url ?? 'https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=800&q=80' }}" 
                                        alt="{{ $project->title }}" 
                                        class="w-full h-full object-cover grayscale contrast-125 group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700"
                                    >
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#0e0e0e] via-transparent to-transparent opacity-80"></div>
                                    <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-mono font-bold uppercase bg-[#ff0033] text-white shadow-lg">
                                        {{ $project->category }}
                                    </span>
                                </div>
                                <div class="p-6 space-y-3">
                                    <h3 class="text-lg font-bold font-display text-white group-hover:text-[#ff0033] transition-colors">
                                        {{ $project->title }}
                                    </h3>
                                    <p class="text-xs text-neutral-400 line-clamp-2 leading-relaxed">
                                        {{ $project->description ?? $project->subtitle ?? 'Full stack client mobile app with real-time cloud data synchronization.' }}
                                    </p>
                                </div>
                            </div>

                            <div class="p-6 pt-0 border-t border-white/5 flex items-center justify-between text-xs mt-2">
                                <span class="text-neutral-400 font-mono text-[11px]">{{ $project->tags ?? 'Mobile App' }}</span>
                                <a href="{{ $project->demo_url ?? route('contact') }}" target="_blank" class="text-[#ff0033] font-bold font-mono hover:underline inline-flex items-center gap-1">
                                    <span>Explore</span> &rarr;
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12 text-neutral-500">
                            <p class="text-sm">No projects published yet. Add them in the Admin Panel.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Slider Pagination Indicator Dots (Matches Reference Image) -->
                <div class="flex items-center justify-center gap-2 mt-10">
                    <span class="w-6 h-2 rounded-full bg-[#ff0033] shadow-[0_0_8px_#ff0033]"></span>
                    <span class="w-2 h-2 rounded-full bg-white/20"></span>
                    <span class="w-2 h-2 rounded-full bg-white/20"></span>
                </div>

            </div>
        </section>

        <!-- =========================================================================
             6. RESUME SECTION ("OUR RESUME")
             Education & Experience columns with continuous red timeline indicators
             ========================================================================= -->
        <section id="resume" class="py-20 lg:py-28 relative bg-[#070707] border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <!-- Center Header -->
                <div class="text-center max-w-2xl mx-auto mb-16 space-y-2">
                    <span class="w-8 h-1 bg-[#ff0033] rounded-full mx-auto block mb-3"></span>
                    <h2 class="text-4xl sm:text-6xl font-black font-headline uppercase text-white tracking-wide">
                        OUR RESUME
                    </h2>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    
                    <!-- Column 1: Education -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-white/10">
                            <span class="w-3.5 h-3.5 rounded-full bg-[#ff0033] shadow-[0_0_10px_#ff0033]"></span>
                            <h3 class="text-2xl font-black font-headline uppercase text-white tracking-wider">Education</h3>
                        </div>

                        <div class="space-y-4 relative border-l-2 border-[#ff0033]/30 ml-3 pl-6">
                            @foreach($resumeEducation as $edu)
                                <div class="app-card p-6 rounded-2xl relative group">
                                    <!-- Connected Timeline Glowing Red Dot -->
                                    <span class="absolute -left-[31px] top-6 w-3 h-3 rounded-full bg-[#ff0033] group-hover:scale-125 transition-transform shadow-[0_0_8px_#ff0033] ring-4 ring-[#070707]"></span>
                                    <span class="text-[11px] font-mono text-[#ff0033] uppercase font-bold">{{ $edu['period'] }}</span>
                                    <h4 class="text-base font-bold text-white mt-1 font-display">{{ $edu['title'] }}</h4>
                                    <p class="text-xs text-neutral-400 mt-0.5">{{ $edu['institution'] }}</p>
                                    <span class="inline-block mt-2 text-[10px] font-mono px-2 py-0.5 rounded bg-white/5 text-neutral-300">{{ $edu['grade'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Column 2: Experience -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-white/10">
                            <span class="w-3.5 h-3.5 rounded-full bg-[#ff0033] shadow-[0_0_10px_#ff0033]"></span>
                            <h3 class="text-2xl font-black font-headline uppercase text-white tracking-wider">Experience</h3>
                        </div>

                        <div class="space-y-4 relative border-l-2 border-[#ff0033]/30 ml-3 pl-6">
                            @foreach($resumeExperience as $exp)
                                <div class="app-card p-6 rounded-2xl relative group">
                                    <!-- Connected Timeline Glowing Red Dot -->
                                    <span class="absolute -left-[31px] top-6 w-3 h-3 rounded-full bg-[#ff0033] group-hover:scale-125 transition-transform shadow-[0_0_8px_#ff0033] ring-4 ring-[#070707]"></span>
                                    <span class="text-[11px] font-mono text-[#ff0033] uppercase font-bold">{{ $exp['period'] }}</span>
                                    <h4 class="text-base font-bold text-white mt-1 font-display">{{ $exp['title'] }}</h4>
                                    <p class="text-xs font-semibold text-neutral-300 mt-0.5">{{ $exp['company'] }}</p>
                                    <p class="text-xs text-neutral-400 mt-1 leading-relaxed">{{ $exp['description'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- =========================================================================
             7. SKILLS SECTION ("OUR SKILLS")
             Progress bars with Red Glowing Indicators Matching Reference
             ========================================================================= -->
        <section id="skills" class="py-20 lg:py-28 relative bg-[#0a0a0a] border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <!-- Center Header -->
                <div class="text-center max-w-2xl mx-auto mb-16 space-y-2">
                    <span class="w-8 h-1 bg-[#ff0033] rounded-full mx-auto block mb-3"></span>
                    <h2 class="text-4xl sm:text-6xl font-black font-headline uppercase text-white tracking-wide">
                        OUR SKILLS
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    @forelse($skills as $skill)
                        <div class="app-card p-6 rounded-2xl space-y-2.5">
                            <div class="flex items-center justify-between text-xs font-mono">
                                <span class="font-bold text-white uppercase">{{ $skill->name }}</span>
                                <span class="text-[#ff0033] font-bold">{{ $skill->percentage }}%</span>
                            </div>
                            <div class="w-full h-2.5 rounded-full bg-black/80 overflow-hidden border border-white/10 relative">
                                <div class="h-full bg-gradient-to-r from-[#ff0033] via-red-500 to-[#ff0033] rounded-full transition-all duration-1000 shadow-[0_0_12px_rgba(255,0,51,0.8)]" style="width: {{ $skill->percentage }}%;"></div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8 text-neutral-500">
                            <p class="text-xs">No skills configured yet. Add them in the Admin Panel.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </section>

        <!-- =========================================================================
             8. ACHIEVEMENT COUNTER BANNER (Vibrant Red Banner Matching Reference)
             5 Stat Columns with Crisp Divider Lines
             ========================================================================= -->
        <div class="w-full bg-[#ff0033] py-12 shadow-2xl shadow-[#ff0033]/30 font-display border-y border-[#ff1a3c]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-white/20 text-center text-white">
                    <div class="p-4">
                        <span class="text-5xl sm:text-6xl font-black font-headline block leading-none">{{ $settings['experience_years'] ?? '8' }}+</span>
                        <span class="text-xs uppercase tracking-widest font-bold font-mono opacity-90 mt-2 block">Years Experience</span>
                    </div>
                    <div class="p-4">
                        <span class="text-5xl sm:text-6xl font-black font-headline block leading-none">{{ $settings['completed_projects'] ?? '150' }}+</span>
                        <span class="text-xs uppercase tracking-widest font-bold font-mono opacity-90 mt-2 block">Mobile &amp; Web Apps</span>
                    </div>
                    <div class="p-4">
                        <span class="text-5xl sm:text-6xl font-black font-headline block leading-none">99%</span>
                        <span class="text-xs uppercase tracking-widest font-bold font-mono opacity-90 mt-2 block">Client Satisfaction</span>
                    </div>
                    <div class="p-4">
                        <span class="text-5xl sm:text-6xl font-black font-headline block leading-none">{{ $settings['awards_count'] ?? '24' }}+</span>
                        <span class="text-xs uppercase tracking-widest font-bold font-mono opacity-90 mt-2 block">Industry Awards</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- =========================================================================
             9. FAQ SECTION ("HAVE ANY QUESTIONS?")
             Interactive Accordion matching Reference Image
             ========================================================================= -->
        <section id="faq" class="py-20 lg:py-28 relative bg-[#070707]">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <div class="text-center mb-16 space-y-2">
                    <span class="w-8 h-1 bg-[#ff0033] rounded-full mx-auto block mb-3"></span>
                    <h2 class="text-4xl sm:text-6xl font-black font-headline uppercase text-white tracking-wide">
                        HAVE ANY QUESTIONS?
                    </h2>
                </div>

                <div class="space-y-4" id="faqAccordionContainer">
                    @forelse($faqs as $idx => $item)
                        <div class="app-card rounded-2xl overflow-hidden transition-all duration-300 {{ $idx === 0 ? 'border-[#ff0033]/40' : '' }}">
                            <button 
                                type="button" 
                                onclick="toggleFaq('faq-item-{{ $idx }}')"
                                class="w-full p-6 text-left flex items-center justify-between text-white hover:text-[#ff0033] transition-colors focus:outline-none"
                            >
                                <span class="text-base font-bold font-display">{{ is_array($item) ? $item['question'] : $item->question }}</span>
                                <span id="faq-icon-{{ $idx }}" class="text-[#ff0033] text-lg font-bold transition-transform duration-300 {{ $idx === 0 ? 'rotate-180' : '' }}">
                                    ▾
                                </span>
                            </button>
                            <div 
                                id="faq-item-{{ $idx }}" 
                                class="{{ $idx === 0 ? 'block' : 'hidden' }} px-6 pb-6 text-xs text-neutral-400 leading-relaxed border-t border-white/5 pt-4"
                            >
                                {{ is_array($item) ? $item['answer'] : $item->answer }}
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-neutral-500">
                            <p class="text-xs">No questions found.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </section>

        <!-- =========================================================================
             10. BLOG SECTION ("CHECK OUT MY ARTICLES")
             ========================================================================= -->
        <section id="blog" class="py-20 lg:py-28 relative bg-[#0a0a0a] border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-14">
                    <div class="space-y-2">
                        <span class="text-xs font-mono uppercase tracking-widest text-[#ff0033] font-bold block">// INSIGHTS &amp; CASE STUDIES</span>
                        <h2 class="text-4xl sm:text-6xl font-black font-headline uppercase text-white tracking-wide">
                            CHECK OUT MY ARTICLES
                        </h2>
                    </div>
                    <a href="{{ route('blog') }}" class="btn-pill-red py-2.5 px-6 rounded-full text-xs font-bold uppercase tracking-wider font-display gap-2 group">
                        <span>View All Articles</span>
                        <span class="w-5 h-5 rounded-full bg-black/30 flex items-center justify-center text-white text-[10px]">&rarr;</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach((is_array($blogPosts) ? array_slice($blogPosts, 0, 3) : $blogPosts->take(3)) as $post)
                        <div class="app-card rounded-3xl overflow-hidden flex flex-col justify-between group">
                            <div>
                                <div class="relative h-56 overflow-hidden bg-black/80">
                                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover grayscale contrast-125 group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700">
                                    <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-mono font-bold uppercase bg-[#ff0033] text-white">
                                        {{ $post['category'] }}
                                    </span>
                                </div>
                                <div class="p-6 space-y-2.5">
                                    <span class="text-[11px] font-mono text-neutral-400 block">{{ $post['date'] }} &bull; {{ $post['read_time'] }}</span>
                                    <h3 class="text-lg font-bold font-display text-white group-hover:text-[#ff0033] transition-colors leading-snug">
                                        {{ $post['title'] }}
                                    </h3>
                                    <p class="text-xs text-neutral-400 line-clamp-3 leading-relaxed">
                                        {{ $post['excerpt'] }}
                                    </p>
                                </div>
                            </div>
                            <div class="p-6 pt-0 border-t border-white/5 mt-2">
                                <a href="{{ route('blog.detail', $post['slug']) }}" class="inline-flex items-center gap-1.5 text-xs font-mono uppercase tracking-wider text-[#ff0033] font-bold hover:underline">
                                    <span>Read Article</span> &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>

        <!-- =========================================================================
             11. CONTACT SECTION ("GET IN TOUCH NOW")
             Left: Info cards with red left border, Right: Sleek contact form
             Header with vertical divider matching reference image
             ========================================================================= -->
        <section id="contact" class="py-20 lg:py-28 relative bg-[#070707] border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <!-- Section Header with Vertical Divider (Matches Reference Image) -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-16 pb-8 border-b border-white/10">
                    <div>
                        <span class="text-xs font-mono uppercase tracking-widest text-[#ff0033] font-bold block mb-1">// {{ $settings['contact_tag'] ?? 'CONNECT' }}</span>
                        <h2 class="text-4xl sm:text-6xl font-black font-headline uppercase text-white tracking-wide">
                            {{ $settings['contact_heading'] ?? 'GET IN TOUCH NOW' }}
                        </h2>
                    </div>
                    <div class="hidden md:block w-px h-16 bg-white/15"></div>
                    <p class="text-xs sm:text-sm text-neutral-400 max-w-md leading-relaxed">
                        {{ $settings['contact_description'] ?? 'Have a project in mind or need high-velocity mobile app architecture? Send a direct dispatch to start engineering.' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                    
                    <!-- Left: Contact Cards with Red Left Border (Matches Reference Image) -->
                    <div class="lg:col-span-5 space-y-4">
                        <div class="p-6 rounded-2xl bg-[#0f0f0f] border-l-4 border-l-[#ff0033] border border-white/5 flex items-center gap-4 shadow-lg hover:border-[#ff0033]/40 transition-colors">
                            <span class="w-12 h-12 rounded-xl bg-[#1c080b] text-[#ff0033] flex items-center justify-center font-bold text-lg">📍</span>
                            <div>
                                <span class="text-[10px] font-mono text-neutral-400 uppercase block">Office Location</span>
                                <span class="font-bold text-white text-sm">{{ $settings['contact_location'] ?? 'San Francisco, CA & Remote' }}</span>
                            </div>
                        </div>

                        <div class="p-6 rounded-2xl bg-[#0f0f0f] border-l-4 border-l-[#ff0033] border border-white/5 flex items-center gap-4 shadow-lg hover:border-[#ff0033]/40 transition-colors">
                            <span class="w-12 h-12 rounded-xl bg-[#1c080b] text-[#ff0033] flex items-center justify-center font-bold text-lg">✉</span>
                            <div>
                                <span class="text-[10px] font-mono text-neutral-400 uppercase block">Direct Email</span>
                                <span class="font-bold text-white text-sm">{{ $settings['contact_email'] ?? 'hello@portfolio.me' }}</span>
                            </div>
                        </div>

                        <div class="p-6 rounded-2xl bg-[#0f0f0f] border-l-4 border-l-[#ff0033] border border-white/5 flex items-center gap-4 shadow-lg hover:border-[#ff0033]/40 transition-colors">
                            <span class="w-12 h-12 rounded-xl bg-[#1c080b] text-[#ff0033] flex items-center justify-center font-bold text-lg">☎</span>
                            <div>
                                <span class="text-[10px] font-mono text-neutral-400 uppercase block">Phone / WhatsApp</span>
                                <span class="font-bold text-white text-sm">{{ $settings['contact_phone'] ?? '+1 (555) 382-9012' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Contact Form -->
                    <div class="lg:col-span-7 app-card p-8 rounded-3xl shadow-2xl relative">
                        <!-- Ambient form spotlight -->
                        <div class="absolute -top-12 -right-12 w-48 h-48 bg-[#ff0033]/15 rounded-full blur-3xl pointer-events-none"></div>

                        @if(session('success'))
                            <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-6">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4 relative z-10">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-mono text-neutral-400 mb-1">Your Name *</label>
                                    <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff0033]" placeholder="Sarah Connor">
                                </div>
                                <div>
                                    <label class="block text-xs font-mono text-neutral-400 mb-1">Your Email *</label>
                                    <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff0033]" placeholder="sarah@enterprise.io">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-mono text-neutral-400 mb-1">Subject / Platform Scope</label>
                                <input type="text" name="subject" class="w-full px-4 py-3 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff0033]" placeholder="iOS & Android Cross-Platform Application">
                            </div>

                            <div>
                                <label class="block text-xs font-mono text-neutral-400 mb-1">Project Details *</label>
                                <textarea name="message" rows="4" required class="w-full px-4 py-3 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff0033]" placeholder="Outline your requirements, target platforms, and launch window..."></textarea>
                            </div>

                            <button type="submit" class="btn-pill-red w-full py-4 rounded-xl font-black text-xs uppercase tracking-wider font-display gap-2 group">
                                <span>Send Message</span>
                                <span class="w-5 h-5 rounded-full bg-black/30 group-hover:bg-black/50 flex items-center justify-center text-white text-xs">&rarr;</span>
                            </button>
                        </form>
                    </div>

                </div>

            </div>
        </section>

        <!-- =========================================================================
             12. "FOLLOW US" CIRCULAR 3D METALLIC BADGES RIBBON
             Row of 6 Metallic Circular Showcase Badges with Chrome Rings matching image
             ========================================================================= -->
        <section class="py-16 bg-[#0a0a0a] border-t border-white/5 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8 relative z-10">
                
                <h3 class="text-2xl sm:text-3xl font-black font-headline uppercase tracking-widest text-neutral-200">
                    FOLLOW US
                </h3>

                <!-- 6 Circular 3D Metallic Emblems matching reference image -->
                <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-8">
                    
                    <!-- GitHub -->
                    <a href="{{ $settings['social_github'] ?? 'https://github.com' }}" target="_blank" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full metallic-badge flex items-center justify-center text-white hover:text-[#ff0033] group" title="GitHub">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 transition-transform group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                    </a>

                    <!-- LinkedIn -->
                    <a href="{{ $settings['social_linkedin'] ?? 'https://linkedin.com' }}" target="_blank" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full metallic-badge flex items-center justify-center text-white hover:text-[#ff0033] group" title="LinkedIn">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 transition-transform group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>

                    <!-- Twitter / X -->
                    <a href="{{ $settings['social_twitter'] ?? 'https://twitter.com' }}" target="_blank" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full metallic-badge flex items-center justify-center text-white hover:text-[#ff0033] group" title="Twitter / X">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 transition-transform group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>

                    <!-- Dribbble -->
                    <a href="{{ $settings['social_dribbble'] ?? 'https://dribbble.com' }}" target="_blank" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full metallic-badge flex items-center justify-center text-white hover:text-[#ff0033] group" title="Dribbble">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 transition-transform group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm7.98 5.7c1.32 1.68 2.13 3.78 2.25 6.09-.54-.12-2.82-.57-5.46-.24-.09-.21-.18-.45-.27-.69-.72-1.74-1.53-3.39-2.28-4.71 2.76-.36 4.77-.45 5.76-.45zm-7.98-3.93c2.43 0 4.65.84 6.42 2.25-.9.03-2.79.12-5.4.45-.96-1.59-1.89-3.06-2.58-4.08 1.14-.39 2.37-.62 3.56-.62zm-5.76 1.83c.72.99 1.62 2.43 2.55 3.96-3.36 1.05-6.96 1.77-7.98 1.83 1.05-2.61 3.09-4.71 5.43-5.79zm-4.47 7.89c.75-.06 4.02-.72 7.23-1.68.21.48.42.96.6 1.47-2.7 1.05-5.58 3.57-7.29 5.85-.45-1.68-.69-3.48-.54-5.64zm2.13 7.56c1.5-1.98 4.05-4.26 6.54-5.25.96 2.52 1.47 5.16 1.68 6.78-2.64 1.2-5.61 1.02-8.22-1.53zm9.84.15c-.21-1.47-.69-3.87-1.56-6.27 2.4-.36 4.47.09 5.01.21-.6 2.64-2.07 4.89-4.08 6.27-.09-.09-.18-.15-.27-.21z"/></svg>
                    </a>

                    <!-- Behance -->
                    <a href="{{ $settings['social_behance'] ?? 'https://behance.net' }}" target="_blank" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full metallic-badge flex items-center justify-center text-white hover:text-[#ff0033] group" title="Behance">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 transition-transform group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24"><path d="M22 7h-7v-2h7v2zm1.726 10c-.442 1.297-2.029 3-4.971 3-3.467 0-5.834-2.544-5.834-5.917 0-3.468 2.457-6.083 5.763-6.083 3.42 0 5.474 2.518 5.474 6.083h-8.24c.063 1.782 1.341 3.076 2.977 3.076 1.408 0 2.277-.696 2.673-1.624l2.158 1.465zm-2.316-4.437c-.073-1.258-.87-2.42-2.463-2.42-1.542 0-2.378 1.118-2.543 2.42h5.006zm-13.41 7.437h-8v-16h8.217c2.68 0 4.783 1.354 4.783 3.864 0 1.552-.806 2.766-2.091 3.393 1.737.587 2.591 2.052 2.591 3.93 0 2.871-2.298 4.813-5.5 4.813zm-5-10h4.316c1.19 0 2.184-.57 2.184-1.636 0-1.137-.927-1.636-2.184-1.636h-4.316v3.272zm0 7h4.783c1.378 0 2.422-.658 2.422-1.892 0-1.282-1.077-1.975-2.422-1.975h-4.783v3.867z"/></svg>
                    </a>

                    <!-- YouTube -->
                    <a href="{{ $settings['social_youtube'] ?? 'https://youtube.com' }}" target="_blank" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full metallic-badge flex items-center justify-center text-white hover:text-[#ff0033] group" title="YouTube">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 transition-transform group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>

                </div>

            </div>
        </section>

    </main>

    <!-- Footer (Kept consistent with other themes as requested) -->
    @include('frontend.themes.app_developer.partials.footer')

    <!-- Interactive Scripts for FAQ Accordion -->
    <script>
        function toggleFaq(id) {
            const el = document.getElementById(id);
            const iconId = id.replace('faq-item-', 'faq-icon-');
            const icon = document.getElementById(iconId);
            
            if (el.classList.contains('hidden')) {
                el.classList.remove('hidden');
                el.classList.add('block');
                if (icon) icon.classList.add('rotate-180');
            } else {
                el.classList.remove('block');
                el.classList.add('hidden');
                if (icon) icon.classList.remove('rotate-180');
            }
        }
    </script>

</body>
</html>
