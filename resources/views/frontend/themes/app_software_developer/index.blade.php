<!DOCTYPE html>
<html lang="en" class="scroll-smooth" data-theme-mode="{{ $themeMode ?? 'system' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings['site_title'] ?? 'Tanu — App & Software Developer' }}</title>
    <meta name="description" content="Portfolio of Tanu, elite App & Software Developer specializing in enterprise software architecture, mobile apps, high-throughput cloud backends, and responsive digital products.">

    <!-- Google Fonts: Outfit (Display & Headlines), Plus Jakarta Sans (Body), JetBrains Mono (Technical Details) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">

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
        .font-display {
            font-family: 'Outfit', sans-serif;
        }

        /* Ambient Amber Orange Pulsing Glow */
        @keyframes amberPulse {
            0%, 100% { opacity: 0.2; transform: scale(1); }
            50% { opacity: 0.35; transform: scale(1.08); }
        }
        .amber-pulse {
            animation: amberPulse 8s ease-in-out infinite;
        }

        /* Software Dev Glassmorphism Card Utility */
        .soft-card {
            background: linear-gradient(180deg, rgba(20, 20, 20, 0.85) 0%, rgba(10, 10, 10, 0.95) 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .soft-card:hover {
            border-color: rgba(255, 107, 0, 0.5);
            box-shadow: 0 15px 35px -10px rgba(255, 107, 0, 0.25);
            transform: translateY(-4px);
        }

        /* Orange primary pill/rectangle button */
        .btn-soft-orange {
            background: linear-gradient(135deg, #ff6b00 0%, #e05600 100%);
            color: #ffffff;
            box-shadow: 0 8px 25px -4px rgba(255, 107, 0, 0.45);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .btn-soft-orange:hover {
            background: linear-gradient(135deg, #ff7a1a 0%, #ff6b00 100%);
            box-shadow: 0 12px 30px -4px rgba(255, 107, 0, 0.65);
            transform: scale(1.02);
        }
    </style>
</head>
<body class="theme-app_software_developer bg-[#080808] text-[#ffffff] min-h-screen antialiased selection:bg-[#ff6b00] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip relative">

    <!-- Sticky Main Header (Standardized across themes) -->
    @include('frontend.themes.app_software_developer.partials.header')

    <main>
        <!-- =========================================================================
             1. HERO SECTION (Matches Reference Image)
             - Giant faint watermark "DEVELOPER"
             - App & Software Developer stacked headline
             - Studio developer portrait with amber rim light
             ========================================================================= -->
        <section class="relative pt-12 pb-20 lg:pt-20 lg:pb-32 overflow-hidden bg-gradient-to-b from-[#0a0a0a] via-[#080808] to-[#0a0a0a]">
            <!-- Giant Faint Background Watermark -->
            <div class="absolute -top-10 left-1/2 -translate-x-1/2 watermark-text z-0">
                DEVELOPER
            </div>

            <!-- Ambient Amber Spotlights -->
            <div class="absolute top-1/4 -left-36 w-[550px] h-[550px] bg-[#ff6b00]/10 rounded-full blur-[170px] pointer-events-none amber-pulse"></div>
            <div class="absolute top-1/3 right-4 w-[600px] h-[600px] bg-[#ff6b00]/15 rounded-full blur-[180px] pointer-events-none"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    
                    <!-- Left: Hero Headline & Subtitle -->
                    <div class="lg:col-span-7 space-y-6">
                        
                        <!-- Small Role Subtitle -->
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#181008] border border-[#ff6b00]/30 text-[#ff6b00] text-xs font-mono font-bold tracking-widest uppercase">
                            <span class="w-2 h-2 rounded-full bg-[#ff6b00] animate-pulse"></span>
                            <span>{{ $settings['hero_tag'] ?? 'EXPERT DEVELOPER' }}</span>
                        </div>
                        <h1 class="text-5xl sm:text-7xl lg:text-8xl font-black font-display uppercase tracking-tight text-white leading-none">
                            {{ $settings['hero_title_line1'] ?? ($settings['hero_title'] ?? 'App & Software') }}<br>
                            <span class="text-white">{{ $settings['hero_title_line2'] ?? ($settings['hero_subtitle'] ?? 'Developer') }}</span>
                        </h1>

                        <!-- Bio Description -->
                        <p class="text-sm sm:text-base text-neutral-400 max-w-xl leading-relaxed">
                            {{ $settings['hero_description'] ?? 'Architecting resilient software systems, native & cross-platform mobile apps, and scalable cloud microservices engineered for high velocity and sub-second performance.' }}
                        </p>
                        <div class="pt-4 flex flex-wrap items-center gap-5">
                            <a href="{{ $settings['hero_cta_url'] ?? route('contact') }}" class="btn-orange-outline inline-flex items-center gap-3 px-8 py-4 rounded-xl text-xs font-black uppercase tracking-wider font-display">
                                <span>{{ $settings['hero_cta_text'] ?? 'Contact Me' }}</span>
                                <span>&rarr;</span>
                            </a>
                            <a href="{{ $settings['hero_cta2_url'] ?? route('portfolio') }}" class="inline-flex items-center gap-2 px-6 py-4 rounded-xl bg-white/5 hover:bg-white/10 text-white text-xs font-bold uppercase tracking-wider transition-all border border-white/10">
                                <span>{{ $settings['hero_cta2_text'] ?? 'View Projects' }}</span>
                            </a>
                        </div>

                    </div>
                    <div class="lg:col-span-5 relative flex items-center justify-center">
                        <div class="relative w-full max-w-md">
                            <!-- Amber Rim Glow Backdrop -->
                            <div class="absolute inset-0 bg-gradient-to-tr from-[#ff6b00]/30 via-orange-600/10 to-transparent rounded-3xl blur-3xl transform scale-105 pointer-events-none"></div>

                            <!-- Cutout portrait image -->
                            <div class="relative rounded-3xl overflow-hidden border border-white/10 shadow-2xl bg-[#0d0d0d] group">
                                <img 
                                    src="{{ !empty($settings['hero_image']) ? asset($settings['hero_image']) : asset('images/app_software_developer/hero.jpg') }}" 
                                    alt="{{ $settings['hero_title'] ?? 'App & Software Developer' }}" 
                                    class="w-full h-auto object-cover transform group-hover:scale-102 transition-transform duration-700"
                                >
                                <!-- Bottom ambient fade -->
                                <div class="absolute inset-0 bg-gradient-to-t from-[#080808] via-transparent to-transparent opacity-60"></div>
                            </div>

                            <!-- Bottom Floating Circular Badge (Matches Reference Image) -->
                            <div class="absolute -bottom-4 -right-4 w-14 h-14 rounded-full bg-[#181008] border-2 border-[#ff6b00] flex items-center justify-center text-[#ff6b00] font-bold text-lg shadow-xl shadow-[#ff6b00]/30">
                                ◈
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- =========================================================================
             2. ABOUT SECTION ("Welcome to Tanu, Best Software Services")
             Matches reference image with [About Me] orange bracket tag
             ========================================================================= -->
        <section id="about" class="py-20 lg:py-28 relative bg-[#0a0a0a] border-t border-white/5 overflow-hidden">
            <!-- Background Watermark -->
            <div class="absolute -top-12 left-1/2 -translate-x-1/2 watermark-text z-0">
                ABOUT
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    
                    <!-- Left: Developer Photo -->
                    <div class="lg:col-span-5 relative">
                        <div class="rounded-3xl overflow-hidden border border-white/10 shadow-2xl bg-[#111111] group">
                            <img 
                                src="{{ !empty($settings['about_image']) ? asset($settings['about_image']) : (!empty($settings['hero_image']) ? asset($settings['hero_image']) : asset('images/app_software_developer/hero.jpg')) }}" 
                                alt="{{ $settings['hero_title'] ?? 'Software Developer' }}" 
                                class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-700"
                            >
                        </div>
                    </div>

                    <!-- Right: Welcome & Bio Info -->
                    <div class="lg:col-span-7 space-y-6">
                        
                        <!-- Orange Bracket Tag -->
                        <div>
                            <span class="badge-bracket-orange">About Me</span>
                        </div>

                        <!-- Section Title -->
                        <h2 class="text-3xl sm:text-5xl font-black font-display text-white tracking-tight leading-tight">
                            {{ $settings['about_heading'] ?? ('Welcome to ' . ($settings['site_title'] ?? 'Software Developer') . ', Best Software Services') }}
                        </h2>

                        <!-- Subtitle Highlight -->
                        <p class="text-sm sm:text-base font-semibold text-neutral-200">
                            I have {{ $settings['experience_years'] ?? '8' }}+ years of experience in Software Development to give you better services.
                        </p>

                        <!-- Paragraph Description -->
                        <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed">
                            {{ $settings['about_description'] ?? 'Over ' . ($settings['experience_years'] ?? '8') . '+ years building enterprise web and mobile software platforms, microservices architectures, reactive user interfaces, and secure cloud infrastructures. I transform complex engineering hurdles into clean, scalable software systems.' }}
                        </p>

                        <!-- 4 Stat Badges in a Row (Matches Reference Image) -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4">
                            <div class="p-4 rounded-2xl bg-[#111111] border border-white/5 text-center">
                                <span class="text-2xl sm:text-3xl font-black font-display text-[#ff6b00] block">{{ sprintf('%02d', $settings['experience_years'] ?? 8) }}+</span>
                                <span class="text-[11px] font-mono text-neutral-400 mt-1 block">{{ $settings['counter1_title'] ?? 'Years Exp.' }}</span>
                            </div>
                            <div class="p-4 rounded-2xl bg-[#111111] border border-white/5 text-center">
                                <span class="text-2xl sm:text-3xl font-black font-display text-[#ff6b00] block">{{ $settings['completed_projects'] ?? '150' }}+</span>
                                <span class="text-[11px] font-mono text-neutral-400 mt-1 block">{{ $settings['counter2_title'] ?? 'Projects' }}</span>
                            </div>
                            <div class="p-4 rounded-2xl bg-[#111111] border border-white/5 text-center">
                                <span class="text-2xl sm:text-3xl font-black font-display text-[#ff6b00] block">99%</span>
                                <span class="text-[11px] font-mono text-neutral-400 mt-1 block">{{ $settings['counter3_title'] ?? 'Satisfied' }}</span>
                            </div>
                            <div class="p-4 rounded-2xl bg-[#111111] border border-white/5 text-center">
                                <span class="text-2xl sm:text-3xl font-black font-display text-[#ff6b00] block">{{ $settings['awards_count'] ?? '12' }}+</span>
                                <span class="text-[11px] font-mono text-neutral-400 mt-1 block">{{ $settings['counter4_title'] ?? 'Awards' }}</span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- =========================================================================
             3. SERVICES SECTION ("My Best Services")
             Matches reference image: [Services] bracket tag, 4 cards with orange line icons
             ========================================================================= -->
        <section id="services" class="py-20 lg:py-28 relative bg-[#080808] border-t border-white/5 overflow-hidden">
            <!-- Background Watermark -->
            <div class="absolute -top-12 left-1/2 -translate-x-1/2 watermark-text z-0">
                SERVICES
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <!-- Section Header -->
                <div class="text-center max-w-xl mx-auto mb-16 space-y-2">
                    <span class="badge-bracket-orange">{{ $settings['services_tag'] ?? 'Services' }}</span>
                    <h2 class="text-3xl sm:text-5xl font-black font-display text-white tracking-tight">
                        {{ $settings['services_heading'] ?? 'My Best Services' }}
                    </h2>
                </div>

                <!-- 4 Services Cards Grid with Visual Preview Images -->
                @php
                    $softwareServiceImages = [
                        'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=700&q=80', // Web Development & Code
                        'https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=700&q=80', // Mobile & App Platforms
                        'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=700&q=80', // Cloud & DevOps Architecture
                        'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=700&q=80', // Data Analytics & Microservices
                    ];
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($services->take(4) as $index => $service)
                        @php
                            $serviceImg = $softwareServiceImages[$index % 4];
                        @endphp
                        <div class="soft-card p-6 sm:p-7 rounded-2xl flex flex-col justify-between group">
                            <div>
                                <!-- Visual Service Illustration Image -->
                                <div class="relative rounded-xl overflow-hidden aspect-[16/10] mb-5 border border-black/5 dark:border-white/10 bg-black/10 shadow-sm group-hover:border-[#ff6b00]/40 transition-colors">
                                    <img 
                                        src="{{ $serviceImg }}" 
                                        alt="{{ $service->title }}" 
                                        class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700"
                                        loading="lazy"
                                    >
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent pointer-events-none"></div>
                                    <div class="absolute top-3 left-3 w-8 h-8 rounded-lg bg-[#1a0e05]/90 border border-[#ff6b00]/40 text-[#ff6b00] flex items-center justify-center font-bold text-sm shadow-md">
                                        ◈
                                    </div>
                                </div>

                                <h3 class="text-lg font-bold font-display text-white group-hover:text-[#ff6b00] transition-colors mb-2">
                                    {{ $service->title }}
                                </h3>
                                <p class="text-xs text-neutral-400 leading-relaxed line-clamp-3">
                                    {{ $service->description }}
                                </p>
                            </div>
                            <div class="pt-5 mt-4 border-t border-black/5 dark:border-white/5 flex items-center justify-between">
                                <span class="text-[11px] font-mono font-bold text-[#ff6b00] uppercase tracking-wider">
                                    {{ sprintf('%02d', $index + 1) }}
                                </span>
                                <a href="{{ route('contact') }}" class="w-9 h-9 rounded-lg bg-black/5 dark:bg-white/5 hover:bg-[#ff6b00] text-neutral-700 dark:text-neutral-300 hover:text-white flex items-center justify-center transition-colors">
                                    &rarr;
                                </a>
                            </div>
                        </div>
                    @empty
                        @php
                            $defaultSoftwareServices = [
                                ['title' => 'Web Development', 'desc' => 'High-performance responsive web applications built with modern frameworks and resilient cloud APIs.'],
                                ['title' => 'App Development', 'desc' => 'Native iOS, Android, and cross-platform Flutter and React Native mobile applications.'],
                                ['title' => 'Software Architecture', 'desc' => 'Scalable microservices, database design, Docker containerization, and distributed cloud systems.'],
                                ['title' => 'Cloud & DevOps', 'desc' => 'CI/CD automated deployment pipelines, performance audits, container orchestration, and server security.'],
                            ];
                        @endphp
                        @foreach($defaultSoftwareServices as $index => $dSoftService)
                            @php
                                $serviceImg = $softwareServiceImages[$index % 4];
                            @endphp
                            <div class="soft-card p-6 sm:p-7 rounded-2xl flex flex-col justify-between group">
                                <div>
                                    <!-- Visual Service Illustration Image -->
                                    <div class="relative rounded-xl overflow-hidden aspect-[16/10] mb-5 border border-black/5 dark:border-white/10 bg-black/10 shadow-sm group-hover:border-[#ff6b00]/40 transition-colors">
                                        <img 
                                            src="{{ $serviceImg }}" 
                                            alt="{{ $dSoftService['title'] }}" 
                                            class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700"
                                            loading="lazy"
                                        >
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent pointer-events-none"></div>
                                        <div class="absolute top-3 left-3 w-8 h-8 rounded-lg bg-[#1a0e05]/90 border border-[#ff6b00]/40 text-[#ff6b00] flex items-center justify-center font-bold text-sm shadow-md">
                                            ◈
                                        </div>
                                    </div>

                                    <h3 class="text-lg font-bold font-display text-white group-hover:text-[#ff6b00] transition-colors mb-2">
                                        {{ $dSoftService['title'] }}
                                    </h3>
                                    <p class="text-xs text-neutral-400 leading-relaxed">
                                        {{ $dSoftService['desc'] }}
                                    </p>
                                </div>
                                <div class="pt-5 mt-4 border-t border-black/5 dark:border-white/5 flex items-center justify-between">
                                    <span class="text-[11px] font-mono font-bold text-[#ff6b00] uppercase tracking-wider">
                                        {{ sprintf('%02d', $index + 1) }}
                                    </span>
                                    <a href="{{ route('contact') }}" class="w-9 h-9 rounded-lg bg-black/5 dark:bg-white/5 hover:bg-[#ff6b00] text-neutral-700 dark:text-neutral-300 hover:text-white flex items-center justify-center transition-colors">
                                        &rarr;
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endforelse
                </div>

            </div>
        </section>


        <!-- =========================================================================
             5. LATEST PROJECTS SECTION ("My Latest Project")
             Matches reference image: [Portfolio] tag, 3 project cards, "View All Project"
             ========================================================================= -->
        <section id="portfolio" class="py-20 lg:py-28 relative bg-[#0a0a0a] border-t border-white/5 overflow-hidden">
            <!-- Background Watermark -->
            <div class="absolute -top-12 left-1/2 -translate-x-1/2 watermark-text z-0">
                PROJECT
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <!-- Section Header -->
                <div class="text-center max-w-xl mx-auto mb-16 space-y-2">
                    <span class="badge-bracket-orange">{{ $settings['portfolio_tag'] ?? 'Portfolio' }}</span>
                    <h2 class="text-3xl sm:text-5xl font-black font-display text-white tracking-tight">
                        {{ $settings['portfolio_heading'] ?? 'My Latest Project' }}
                    </h2>
                </div>

                <!-- 3 Projects in a row -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($projects->take(3) as $project)
                        <div class="soft-card rounded-2xl overflow-hidden group">
                            <div class="relative h-64 overflow-hidden bg-black/80">
                                <img 
                                    src="{{ $project->image_url ?? 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80' }}" 
                                    alt="{{ $project->title }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0d0d0d] via-transparent to-transparent opacity-80"></div>
                            </div>
                            <div class="p-6 space-y-2">
                                <span class="text-[10px] font-mono text-[#ff6b00] uppercase font-bold tracking-wider block">{{ $project->category ?? 'Software' }}</span>
                                <h3 class="text-lg font-bold font-display text-white group-hover:text-[#ff6b00] transition-colors">
                                    {{ $project->title }}
                                </h3>
                                <p class="text-xs text-neutral-400 line-clamp-2 leading-relaxed">
                                    {{ $project->description ?? 'Custom software architecture and mobile app ecosystem.' }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="soft-card rounded-2xl overflow-hidden group">
                            <div class="relative h-64 overflow-hidden bg-black/80">
                                <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80" alt="Code Workspace" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            </div>
                            <div class="p-6 space-y-2">
                                <span class="text-[10px] font-mono text-[#ff6b00] uppercase font-bold tracking-wider block">Web Application</span>
                                <h3 class="text-lg font-bold font-display text-white group-hover:text-[#ff6b00] transition-colors">Enterprise Cloud Dashboard</h3>
                                <p class="text-xs text-neutral-400">High throughput real-time metrics dashboard for cloud telemetry.</p>
                            </div>
                        </div>

                        <div class="soft-card rounded-2xl overflow-hidden group">
                            <div class="relative h-64 overflow-hidden bg-black/80">
                                <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80" alt="Mobile Setup" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            </div>
                            <div class="p-6 space-y-2">
                                <span class="text-[10px] font-mono text-[#ff6b00] uppercase font-bold tracking-wider block">Mobile App</span>
                                <h3 class="text-lg font-bold font-display text-white group-hover:text-[#ff6b00] transition-colors">Cross-Platform Fintech Suite</h3>
                                <p class="text-xs text-neutral-400">Secure banking application built with Flutter and Go microservices.</p>
                            </div>
                        </div>

                        <div class="soft-card rounded-2xl overflow-hidden group">
                            <div class="relative h-64 overflow-hidden bg-black/80">
                                <img src="https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=800&q=80" alt="Terminal" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            </div>
                            <div class="p-6 space-y-2">
                                <span class="text-[10px] font-mono text-[#ff6b00] uppercase font-bold tracking-wider block">Architecture</span>
                                <h3 class="text-lg font-bold font-display text-white group-hover:text-[#ff6b00] transition-colors">Vortex Microservices Hub</h3>
                                <p class="text-xs text-neutral-400">Distributed event-driven backend handling 50M+ monthly transactions.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Centered View All Project Button -->
                <div class="mt-14 text-center">
                    <a href="{{ route('portfolio') }}" class="btn-orange-outline inline-flex items-center gap-2 px-8 py-3.5 rounded-xl text-xs font-bold uppercase tracking-wider font-display">
                        <span>View All Project</span> &rarr;
                    </a>
                </div>

            </div>
        </section>

        <!-- =========================================================================
             6. TESTIMONIALS SECTION ("What My Clients Say.")
             Matches reference image: [Testimonial] tag, 2 quote cards
             ========================================================================= -->
        <section class="py-20 lg:py-28 relative bg-[#080808] border-t border-white/5 overflow-hidden">
            <!-- Background Watermark -->
            <div class="absolute -top-12 left-1/2 -translate-x-1/2 watermark-text z-0">
                REVIEWS
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <!-- Section Header -->
                <div class="text-center max-w-xl mx-auto mb-16 space-y-2">
                    <span class="badge-bracket-orange">{{ $settings['testimonials_tag'] ?? 'Testimonial' }}</span>
                    <h2 class="text-3xl sm:text-5xl font-black font-display text-white tracking-tight">
                        {{ $settings['testimonials_heading'] ?? 'What My Clients Say.' }}
                    </h2>
                </div>

                <!-- Testimonials Slider: 2 items in one row on desktop, 1 on mobile, auto-slides 1 item every 5s -->
                @php
                    $allTestimonials = $testimonials->count() > 0 ? $testimonials : collect([
                        (object)[
                            'content' => 'Tanu engineered our mobile and web platform with phenomenal execution speed and structural cleanliness. Our users love the smooth touch performance.',
                            'client_name' => 'Marcus Vance',
                            'client_role' => 'CTO, Apex Cloud Labs'
                        ],
                        (object)[
                            'content' => 'Working with Tanu on our distributed backend was the best engineering decision we made. High uptime, zero database latency, and spotless code documentation.',
                            'client_name' => 'Helena Rostova',
                            'client_role' => 'VP Engineering, FinGlobal'
                        ],
                        (object)[
                            'content' => 'Alex brought a rare poetic sensibility to our brand launch. The delicate interplay between minimalism and emotional richness transformed our identity.',
                            'client_name' => 'Sophia Laurent',
                            'client_role' => 'Creative Director, Atelier Nord'
                        ],
                        (object)[
                            'content' => 'Uncompromising craft and meticulous attention to detail. Outstanding software engineering leadership and delivery ahead of schedule.',
                            'client_name' => 'Julian Vance',
                            'client_role' => 'Head of Product, Lumina Form'
                        ],
                    ]);

                    // Ensure minimum 4 slides so carousel has items to slide 1 item every 5 seconds seamlessly
                    if ($allTestimonials->count() < 4) {
                        $allTestimonials = $allTestimonials->concat($allTestimonials);
                    }
                @endphp

                <div class="testimonials-slider-container relative overflow-hidden max-w-6xl mx-auto" data-autoplay="5000">
                    <div class="testimonials-slider-track flex transition-transform duration-700 ease-out -mx-3">
                        @foreach($allTestimonials as $testimonial)
                            <div class="testimonials-slide w-full md:w-1/2 flex-shrink-0 px-3">
                                <div class="soft-card p-8 sm:p-9 rounded-2xl relative h-full flex flex-col justify-between">
                                    <div>
                                        <span class="text-4xl text-[#ff6b00] font-serif leading-none block mb-4">“</span>
                                        <p class="text-xs sm:text-sm text-neutral-300 leading-relaxed mb-6 italic">
                                            {{ $testimonial->content }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-4 pt-4 border-t border-white/5">
                                        <div class="w-10 h-10 rounded-full bg-[#ff6b00]/15 border border-[#ff6b00]/30 text-[#ff6b00] flex items-center justify-center font-bold text-xs uppercase font-mono">
                                            {{ substr($testimonial->client_name ?? $testimonial->name ?? 'C', 0, 2) }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-white text-sm font-display">{{ $testimonial->client_name ?? $testimonial->name }}</h4>
                                            <span class="text-xs text-neutral-500">{{ $testimonial->client_role ?? $testimonial->position ?? 'Founder' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Slider Controls: Prev/Next & Dots -->
                    <div class="flex items-center justify-center gap-6 mt-10">
                        <button type="button" class="testimonials-prev-btn w-10 h-10 rounded-full bg-white/5 hover:bg-[#ff6b00] hover:text-white border border-white/10 text-neutral-300 flex items-center justify-center transition-all cursor-pointer shadow-md" aria-label="Previous testimonial">
                            &#8592;
                        </button>
                        <div class="testimonials-dots flex items-center gap-2 text-[#ff6b00]"></div>
                        <button type="button" class="testimonials-next-btn w-10 h-10 rounded-full bg-white/5 hover:bg-[#ff6b00] hover:text-white border border-white/10 text-neutral-300 flex items-center justify-center transition-all cursor-pointer shadow-md" aria-label="Next testimonial">
                            &#8594;
                        </button>
                    </div>
                </div>

            </div>
        </section>

        <!-- =========================================================================
             7. BLOG SECTION ("My Latest News")
             Matches reference image: [Latest Blog] tag, 3 cards with orange category badges
             ========================================================================= -->
        <section id="blog" class="py-20 lg:py-28 relative bg-[#0a0a0a] border-t border-white/5 overflow-hidden">
            <!-- Background Watermark -->
            <div class="absolute -top-12 left-1/2 -translate-x-1/2 watermark-text z-0">
                BLOG
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <!-- Section Header -->
                <div class="text-center max-w-xl mx-auto mb-16 space-y-2">
                    <span class="badge-bracket-orange">Latest Blog</span>
                    <h2 class="text-3xl sm:text-5xl font-black font-display text-white tracking-tight">
                        My Latest News
                    </h2>
                </div>

                <!-- 3 Blog Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach((is_array($blogPosts) ? array_slice($blogPosts, 0, 3) : $blogPosts->take(3)) as $post)
                        <div class="soft-card rounded-2xl overflow-hidden group">
                            <div class="relative h-56 overflow-hidden bg-black/80">
                                <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                <span class="absolute top-4 left-4 px-3 py-1 rounded bg-[#ff6b00] text-white text-[10px] font-mono font-bold uppercase tracking-wider shadow-md">
                                    {{ $post['category'] }}
                                </span>
                            </div>
                            <div class="p-6 space-y-2.5">
                                <span class="text-[11px] font-mono text-neutral-400 block">{{ $post['date'] }}</span>
                                <h3 class="text-base font-bold font-display text-white group-hover:text-[#ff6b00] transition-colors leading-snug">
                                    {{ $post['title'] }}
                                </h3>
                                <p class="text-xs text-neutral-400 line-clamp-2 leading-relaxed">
                                    {{ $post['excerpt'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Centered View All Blog Button -->
                <div class="mt-14 text-center">
                    <a href="{{ route('blog') }}" class="btn-orange-outline inline-flex items-center gap-2 px-8 py-3.5 rounded-xl text-xs font-bold uppercase tracking-wider font-display">
                        <span>View All Blog</span> &rarr;
                    </a>
                </div>

            </div>
        </section>

        <!-- =========================================================================
             8. PRICING PLANS SECTION ("My Pricing Plans")
             Matches reference image: [Pricing] tag, 3 pricing tiers ($120, $210, $370)
             ========================================================================= -->
        <section id="pricing" class="py-20 lg:py-28 relative bg-[#080808] border-t border-white/5 overflow-hidden">
            <!-- Background Watermark -->
            <div class="absolute -top-12 left-1/2 -translate-x-1/2 watermark-text z-0">
                PRICING
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <!-- Section Header -->
                <div class="text-center max-w-xl mx-auto mb-16 space-y-2">
                    <span class="badge-bracket-orange">Pricing</span>
                    <h2 class="text-3xl sm:text-5xl font-black font-display text-white tracking-tight">
                        My Pricing Plans
                    </h2>
                </div>

                <!-- Pricing Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto items-center">
                    @forelse($pricingPlans as $plan)
                        @php
                            $features = is_array($plan->features) ? $plan->features : (json_decode($plan->features, true) ?? array_filter(array_map('trim', explode("\n", $plan->features ?? ''))));
                            $isFeatured = $plan->is_popular || $loop->iteration === 2;
                        @endphp
                        <div class="soft-card p-8 rounded-2xl text-center space-y-6 {{ $isFeatured ? 'border-[#ff6b00]/50 shadow-xl shadow-[#ff6b00]/15 relative' : '' }}">
                            @if($isFeatured)
                                <span class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-0.5 rounded-full bg-[#ff6b00] text-white text-[10px] font-mono font-bold uppercase">Popular</span>
                            @endif
                            <span class="text-sm font-mono font-bold uppercase tracking-wider {{ $isFeatured ? 'text-[#ff6b00]' : 'text-neutral-400' }}">{{ $plan->name }}</span>
                            <div>
                                <span class="text-4xl sm:text-5xl font-black font-display text-white">{{ $plan->price ? ('$' . number_format($plan->price, 0)) : 'Custom' }}</span>
                                <span class="text-xs text-neutral-400 block mt-1">/ {{ $plan->billing_period ?? 'Monthly Retainer' }}</span>
                            </div>
                            @if(!empty($features))
                                <ul class="space-y-3 text-xs text-neutral-300 border-y border-white/5 py-6">
                                    @foreach($features as $feature)
                                        <li>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <a href="{{ $plan->button_url ?? route('contact') }}" class="{{ $isFeatured ? 'btn-soft-orange' : 'btn-orange-outline' }} block w-full py-3.5 rounded-xl text-xs font-bold uppercase tracking-wider font-display">
                                {{ $plan->button_text ?? 'Choose Plan' }}
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12 text-neutral-500">
                            <p class="text-sm">No pricing plans configured yet. Add them in the Admin Panel.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </section>

        <!-- =========================================================================
             9. CONTACT SECTION ("Send Me A Message")
             Matches reference image: Centered form with direct contact info
             ========================================================================= -->
        <section id="contact" class="py-20 lg:py-28 relative bg-[#0a0a0a] border-t border-white/5 overflow-hidden">
            <!-- Background Watermark -->
            <div class="absolute -top-12 left-1/2 -translate-x-1/2 watermark-text z-0">
                CONTACT
            </div>

            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <!-- Section Header -->
                <div class="text-center max-w-xl mx-auto mb-14 space-y-2">
                    <h2 class="text-3xl sm:text-5xl font-black font-display text-white tracking-tight">
                        Send Me A Message
                    </h2>
                    <p class="text-xs sm:text-sm text-neutral-400">
                        Feel free to contact with me for your next project. We love to hear from you.
                    </p>
                </div>

                <!-- Contact Form Card -->
                <div class="soft-card p-8 sm:p-12 rounded-3xl shadow-2xl space-y-8">
                    @if(session('success'))
                        <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-mono text-neutral-400 mb-2">Name *</label>
                                <input type="text" name="name" required class="w-full px-4 py-3.5 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff6b00]" placeholder="Your Name">
                            </div>
                            <div>
                                <label class="block text-xs font-mono text-neutral-400 mb-2">Email *</label>
                                <input type="email" name="email" required class="w-full px-4 py-3.5 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff6b00]" placeholder="Your Email">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-neutral-400 mb-2">Subject</label>
                            <input type="text" name="subject" class="w-full px-4 py-3.5 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff6b00]" placeholder="Project Subject">
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-neutral-400 mb-2">Message *</label>
                            <textarea name="message" rows="4" required class="w-full px-4 py-3.5 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff6b00]" placeholder="Tell me about your project..."></textarea>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-2">
                            <button type="submit" class="btn-orange-outline px-8 py-3.5 rounded-xl text-xs font-black uppercase tracking-wider font-display">
                                Send Message &rarr;
                            </button>

                            <!-- Direct info badges -->
                            <div class="flex flex-wrap items-center gap-4 text-xs font-mono text-neutral-400">
                                <span class="flex items-center gap-1.5"><span class="text-[#ff6b00]">✉</span> {{ $settings['contact_email'] ?? 'hello@portfolio.me' }}</span>
                                <span class="flex items-center gap-1.5"><span class="text-[#ff6b00]">☎</span> {{ $settings['contact_phone'] ?? '+1 (555) 382-9012' }}</span>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </section>

    </main>

    <!-- Footer (Standardized layout across themes) -->
    @include('frontend.themes.app_software_developer.partials.footer')

</body>
</html>
