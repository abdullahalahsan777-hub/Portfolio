<!DOCTYPE html>
<html lang="en" class="scroll-smooth" data-theme-mode="{{ $themeMode ?? 'system' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings['site_title'] ?? 'Alex Walker — Digital Designer & Illustrator' }}</title>
    <meta name="description" content="Portfolio of Alex Walker, digital designer & illustrator crafting refined brand systems, editorial visual design, and interactive 3D digital experiences.">

    <!-- Google Fonts: Urbanist (Blayden Original), Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Urbanist:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

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
        /* Blayden Design System Tokens */
        :root {
            --accent-rose: #e26d9b;
            --accent-rose-hover: #cf5685;
            --font-display: 'Urbanist', 'Plus Jakarta Sans', sans-serif;
        }

        /* Light Mode Defaults (Clean, Radiant Canvas) */
        html.light, [color-scheme="light"] {
            --bg-main: #f8fafc;
            --bg-subtle: #f1f5f9;
            --bg-card: rgba(255, 255, 255, 0.9);
            --bg-card-hover: #ffffff;
            --border-card: rgba(0, 0, 0, 0.08);
            --text-main: #1e293b;
            --text-muted: #64748b;
            --text-heading: #0f172a;
            --stroke-color: rgba(0, 0, 0, 0.15);
            --section-line: rgba(0, 0, 0, 0.06);
        }

        /* Dark Mode Overrides (Deep Onyx Charcoal Aesthetic) */
        html.dark, [color-scheme="dark"] {
            --bg-main: #141416;
            --bg-subtle: #1c1c20;
            --bg-card: rgba(30, 30, 36, 0.7);
            --bg-card-hover: rgba(40, 40, 48, 0.85);
            --border-card: rgba(255, 255, 255, 0.12);
            --text-main: #F2F5FC;
            --text-muted: #9ba1b0;
            --text-heading: #ffffff;
            --stroke-color: #535762;
            --section-line: rgba(255, 255, 255, 0.1);
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .font-editorial {
            font-family: var(--font-display);
            letter-spacing: -0.025em;
        }

        /* Left-side section indicator pill matching Blayden template */
        .section-name {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            color: var(--text-muted);
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
        }
        .section-name i {
            font-size: 0.875rem;
            color: var(--accent-rose);
        }

        /* Blayden Stacking & Frosted Cards */
        .blayden-card {
            background: var(--bg-card);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid var(--border-card);
            box-shadow: 0 16px 36px -12px rgba(0, 0, 0, 0.08);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .blayden-card:hover {
            background: var(--bg-card-hover);
            border-color: rgba(226, 109, 155, 0.5);
            box-shadow: 0 20px 45px -12px rgba(226, 109, 155, 0.25);
            transform: translateY(-4px);
        }

        /* Template Buttons */
        .btn-blayden-line {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            border: 1px solid var(--stroke-color);
            color: var(--text-heading);
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            transition: all 0.3s ease;
        }
        .btn-blayden-line:hover {
            border-color: var(--accent-rose);
            color: #ffffff;
            background: var(--accent-rose);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(226, 109, 155, 0.4);
        }

        .btn-blayden-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 0.85rem 1.75rem;
            border-radius: 9999px;
            background: var(--accent-rose);
            color: #ffffff;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 0.8125rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            box-shadow: 0 10px 25px -4px rgba(226, 109, 155, 0.4);
            transition: all 0.3s ease;
        }
        .btn-blayden-primary:hover {
            background: var(--accent-rose-hover);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 14px 30px -4px rgba(226, 109, 155, 0.6);
        }

        html.light .btn-blayden-line,
        [color-scheme="light"] .btn-blayden-line {
            background: #ffffff;
            border: 1.5px solid rgba(0, 0, 0, 0.12);
            color: #0f172a;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        html.light .btn-blayden-line:hover,
        [color-scheme="light"] .btn-blayden-line:hover {
            background: var(--accent-rose);
            border-color: var(--accent-rose);
            color: #ffffff;
        }

        /* Parallax Floating Shapes */
        @keyframes floatSlow1 {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-16px) rotate(3deg); }
        }
        @keyframes floatSlow2 {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(20px) rotate(-4deg); }
        }
        .animate-float-1 {
            animation: floatSlow1 9s ease-in-out infinite;
        }
        .animate-float-2 {
            animation: floatSlow2 11s ease-in-out infinite;
        }

    </style>
</head>
<body class="theme-digital_designer_illustrator antialiased selection:bg-[#e26d9b] selection:text-white min-h-screen relative overflow-x-clip">
    @include('frontend.themes.digital_designer_illustrator.partials.header')

    <main class="relative">

        <!-- =========================================================================
             1. HERO / INTRO SECTION (Matches Blayden Template index-demo-1.html)
             - Parallax background floating objects (bg01, bg02)
             - Headline: "Hello! I am Alex Walker", "Digital designer & illustrator"
             - Scroll for more button with icon
             - Media Divider Image & Lewis Carroll Blockquote
             ========================================================================= -->
        <section id="home" class="relative pt-12 pb-16 lg:pt-20 lg:pb-24 overflow-hidden border-b border-[var(--section-line)]">
            
            <!-- Parallax Floating Background Objects from Blayden Template -->
            <div class="absolute -top-10 -left-10 w-72 sm:w-96 lg:w-[480px] pointer-events-none opacity-40 dark:opacity-20 animate-float-1 z-0">
                <img src="{{ asset('blayden/img/backgrounds/1200x1200_bg01.webp') }}" alt="Background Art" class="w-full h-auto">
            </div>
            <div class="absolute top-20 right-0 sm:right-6 lg:right-16 w-80 sm:w-[420px] lg:w-[520px] pointer-events-none opacity-50 dark:opacity-25 animate-float-2 z-0">
                <img src="{{ asset('blayden/img/backgrounds/1200x1200_bg02.webp') }}" alt="Background Art" class="w-full h-auto">
            </div>
            <div class="absolute -top-6 right-2 sm:right-8 lg:right-20 w-44 sm:w-64 lg:w-80 pointer-events-none z-10 opacity-85 drop-shadow-lg">
                <img src="{{ !empty($settings['hero_accent_image']) ? asset($settings['hero_accent_image']) : asset('images/digital_designer_illustrator/flower.jpg') }}" alt="Poppy Bloom" class="w-full h-auto object-contain">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <!-- 12-Column Layout matching Blayden Template (col-xl-2 left indicator, col-xl-8 main content) -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left Section Indicator (col-2) -->
                    <div class="lg:col-span-2 hidden lg:block pt-4">
                        <span class="section-name">
                            <span>Intro</span>
                            <i class="ph ph-arrow-down-right"></i>
                        </span>
                    </div>

                    <!-- Main Headline Content (col-8) -->
                    <div class="lg:col-span-8 space-y-8">
                        <div class="space-y-4">
                            <p class="text-sm sm:text-base font-bold uppercase tracking-widest text-[#e26d9b] font-['Outfit']">
                                {{ $settings['hero_tag'] ?? 'Hello! I am Alex Walker' }}
                            </p>
                            <h1 class="text-5xl sm:text-7xl lg:text-8xl font-normal font-editorial tracking-tight text-[var(--text-heading)] leading-[1.05]">
                                {!! nl2br(e($settings['hero_title_line1'] ?? 'Digital designer')) !!}<br>
                                <span class="italic font-light text-[var(--text-muted)]">&amp; {!! nl2br(e($settings['hero_title_line2'] ?? 'illustrator')) !!}</span>
                                <span class="text-[#e26d9b] inline-block hover:scale-110 transition-transform">⤡</span>
                            </h1>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap items-center gap-4 pt-2">
                            <a href="{{ $settings['hero_cta_url'] ?? '#portfolio' }}" class="btn-blayden-line">
                                <span>{{ $settings['hero_cta_text'] ?? 'Scroll for more' }}</span>
                                <i class="ph ph-arrow-down-right"></i>
                            </a>
                            <a href="{{ $settings['hero_cta2_url'] ?? '#contact' }}" class="btn-blayden-primary">
                                <span>{{ $settings['hero_cta2_text'] ?? 'Get In Touch' }}</span>
                                <i class="ph ph-envelope-simple"></i>
                            </a>
                        </div>

                        <!-- Content Block: Image Divider matching Blayden .main-image-1 / Floating Cards -->
                        <div class="pt-8">
                            <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-[var(--border-card)] blayden-card group">
                                <img 
                                    src="{{ !empty($settings['hero_image']) ? asset($settings['hero_image']) : asset('images/digital_designer_illustrator/hero_cards.jpg') }}" 
                                    onerror="this.src='{{ asset('blayden/img/backgrounds/1400x1000_d02.webp') }}'"
                                    alt="Creative Showcase" 
                                    class="w-full h-auto object-cover max-h-[600px] group-hover:scale-102 transition-transform duration-1000"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-[var(--bg-main)]/50 via-transparent to-transparent pointer-events-none"></div>
                            </div>
                        </div>

                        <!-- Content Block: Large Quote Block matching Blayden Template -->
                        <div class="pt-6">
                            <blockquote class="p-8 sm:p-10 rounded-3xl blayden-card border-l-4 border-l-[#e26d9b] space-y-4">
                                <p class="text-xl sm:text-2xl lg:text-3xl font-light italic font-editorial leading-snug text-[var(--text-heading)]">
                                    "{{ $settings['quote_text'] ?? 'Here we must run as fast as we can, just to stay in place. And if you wish to go anywhere you must run twice as fast as that.' }}"
                                </p>
                                <footer class="text-xs font-mono tracking-widest uppercase text-[#e26d9b]">
                                    &mdash; {{ $settings['quote_author'] ?? 'Lewis Carroll / Through the Looking-Glass' }}
                                </footer>
                            </blockquote>
                        </div>

                    </div>

                    <!-- Right Empty Column (col-2) -->
                    <div class="lg:col-span-2 hidden lg:block"></div>

                </div>

            </div>

        </section>

        <!-- =========================================================================
             2. PORTFOLIO / WORKS SECTION (Matches Blayden Template)
             - Section name on left "Portfolio"
             - H2 Title: "Design, tech & some magic"
             - Dynamic Masonry Project Cards from Database
             ========================================================================= -->
        <section id="portfolio" class="py-20 lg:py-28 relative border-b border-[var(--section-line)]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left Section Name -->
                    <div class="lg:col-span-2 pt-2">
                        <span class="section-name">
                            <span>Portfolio</span>
                            <i class="ph ph-arrow-down-right"></i>
                        </span>
                    </div>

                    <!-- Main Portfolio Content -->
                    <div class="lg:col-span-8 space-y-12">
                        
                        <!-- Section Heading -->
                        <div class="space-y-3">
                            <h2 class="text-4xl sm:text-6xl font-normal font-editorial text-[var(--text-heading)] leading-tight">
                                {{ $settings['portfolio_title'] ?? 'Design, tech &' }}<br>
                                <span class="italic font-light text-[var(--text-muted)]">some magic</span>
                            </h2>
                            <p class="text-sm sm:text-base text-[var(--text-muted)] leading-relaxed max-w-2xl">
                                {{ $settings['portfolio_subtitle'] ?? 'Curated selected projects crafted with precision, purpose, and attention to detail. Blending aesthetic typography with technical excellence.' }}
                            </p>
                        </div>

                        <!-- Dynamic Project Grid (Loaded from Database) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @forelse($projects as $project)
                                <div class="blayden-card rounded-3xl overflow-hidden p-4 group">
                                    <div class="relative h-64 sm:h-80 rounded-2xl overflow-hidden bg-black/10">
                                        <img 
                                            src="{{ $project->image_url ?? $project->image ?? 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=800&q=80' }}" 
                                            alt="{{ $project->title }}" 
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        >
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex items-end p-6">
                                            <div class="space-y-1">
                                                <span class="text-[10px] font-mono uppercase tracking-widest !text-[#e26d9b]">
                                                    {{ $project->category ?? 'Visual Design' }}
                                                </span>
                                                <h3 class="text-xl font-bold font-editorial !text-white">
                                                    {{ $project->title }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-4 pt-5 space-y-3">
                                        <p class="text-xs text-[var(--text-muted)] line-clamp-2">
                                            {{ $project->description }}
                                        </p>
                                        <div class="flex items-center justify-between pt-2 border-t border-[var(--section-line)]">
                                            <span class="text-[11px] font-mono text-[var(--text-muted)]">
                                                {{ $project->theme ?? 'Featured Work' }}
                                            </span>
                                            <a href="{{ $project->project_url ?? route('portfolio') }}" target="_blank" class="text-xs font-bold font-['Outfit'] text-[var(--text-heading)] hover:text-[#e26d9b] inline-flex items-center gap-1 transition-colors">
                                                <span>View Project</span>
                                                <i class="ph ph-arrow-up-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-2 p-8 text-center rounded-3xl blayden-card text-xs text-[var(--text-muted)]">
                                    No portfolio projects found. Add projects from the Admin Panel.
                                </div>
                            @endforelse
                        </div>

                        <!-- External Portfolio CTA matching Blayden Template -->
                        <div class="p-8 rounded-3xl blayden-card flex flex-col sm:flex-row items-center justify-between gap-6">
                            <div>
                                <h4 class="text-lg font-bold font-editorial text-[var(--text-heading)]">Looking for more client showcases?</h4>
                                <p class="text-xs text-[var(--text-muted)] mt-1">Discover comprehensive case studies and interactive 3D prototypes on our creative channels.</p>
                            </div>
                            <div class="flex items-center gap-3 shrink-0">
                                <a href="{{ $settings['social_behance'] ?? 'https://behance.net' }}" target="_blank" class="btn-blayden-line">
                                    <span>Behance</span>
                                    <i class="ph ph-arrow-up-right"></i>
                                </a>
                                <a href="{{ $settings['social_dribbble'] ?? 'https://dribbble.com' }}" target="_blank" class="btn-blayden-line">
                                    <span>Dribbble</span>
                                    <i class="ph ph-arrow-up-right"></i>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="lg:col-span-2 hidden lg:block"></div>

                </div>

            </div>
        </section>

        <!-- =========================================================================
             3. ABOUT ME SECTION (Matches Blayden Template)
             - Section name on left "About Me"
             - H2 Title: "Digital presence with charismatic touch"
             - Bio paragraphs and 4 Key Stats Counters
             ========================================================================= -->
        <section id="about" class="py-20 lg:py-28 relative border-b border-[var(--section-line)]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left Section Name -->
                    <div class="lg:col-span-2 pt-2">
                        <span class="section-name">
                            <span>About Me</span>
                            <i class="ph ph-arrow-down-right"></i>
                        </span>
                    </div>

                    <!-- Main About Content -->
                    <div class="lg:col-span-8 space-y-10">
                        
                        <!-- Heading -->
                        <div class="space-y-4">
                            <h2 class="text-4xl sm:text-6xl font-normal font-editorial text-[var(--text-heading)] leading-tight">
                                {{ $settings['about_heading'] ?? 'Digital presence with charismatic touch' }}
                            </h2>
                        </div>

                        <!-- Description Paragraphs -->
                        <div class="space-y-6 text-sm sm:text-base text-[var(--text-muted)] leading-relaxed font-light">
                            <p class="text-base sm:text-lg text-[var(--text-main)] font-normal">
                                {{ $settings['about_description'] ?? 'With over 6+ years of specialized experience in crafting pixel-perfect interfaces and solid backend architectures, I transform complex business challenges into seamless web applications with measurable impact.' }}
                            </p>
                            <p>
                                {{ $settings['about_bio_extended'] ?? 'Bridging the sweet spot between clean aesthetic minimalism and technical robustness. Every interaction is designed with purpose and micro-interaction fluidity, establishing deep emotional connection between brands and their audiences.' }}
                            </p>
                        </div>

                        <!-- 4 Stat Counters matching Blayden achievements feature -->
                        @php
                            $parseStat = function($rawVal, $defaultNum, $defaultTitle) {
                                $raw = trim((string)($rawVal ?? $defaultNum));
                                if (preg_match('/^([0-9\+\-\%\<\>\s]+)(.*)$/u', $raw, $m)) {
                                    $num = trim($m[1]);
                                    $label = trim($m[2]);
                                    return [
                                        'num' => !empty($num) ? $num : $defaultNum,
                                        'label' => !empty($label) ? $label : $defaultTitle
                                    ];
                                }
                                return ['num' => $raw, 'label' => $defaultTitle];
                            };
                            $stat1 = $parseStat($settings['experience_years'] ?? '06+', '06+', $settings['counter1_title'] ?? 'Years Experience');
                            $stat2 = $parseStat($settings['completed_projects'] ?? '120+', '120+', $settings['counter2_title'] ?? 'Completed Works');
                            $stat3 = $parseStat($settings['satisfied_clients'] ?? '85+', '85+', $settings['counter3_title'] ?? 'Happy Clients');
                            $stat4 = $parseStat($settings['awards_count'] ?? '14', '14', $settings['counter4_title'] ?? 'Design Honors');
                        @endphp
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4">
                            <div class="p-6 rounded-3xl blayden-card flex flex-col justify-between text-center min-h-[135px]">
                                <span class="text-3xl sm:text-4xl font-extrabold font-editorial text-[#e26d9b] block leading-none mb-2">
                                    {{ $stat1['num'] }}
                                </span>
                                <span class="text-[11px] font-mono text-[var(--text-muted)] uppercase tracking-wider block">
                                    {{ $stat1['label'] }}
                                </span>
                            </div>
                            <div class="p-6 rounded-3xl blayden-card flex flex-col justify-between text-center min-h-[135px]">
                                <span class="text-3xl sm:text-4xl font-extrabold font-editorial text-[#e26d9b] block leading-none mb-2">
                                    {{ $stat2['num'] }}
                                </span>
                                <span class="text-[11px] font-mono text-[var(--text-muted)] uppercase tracking-wider block">
                                    {{ $stat2['label'] }}
                                </span>
                            </div>
                            <div class="p-6 rounded-3xl blayden-card flex flex-col justify-between text-center min-h-[135px]">
                                <span class="text-3xl sm:text-4xl font-extrabold font-editorial text-[#e26d9b] block leading-none mb-2">
                                    {{ $stat3['num'] }}
                                </span>
                                <span class="text-[11px] font-mono text-[var(--text-muted)] uppercase tracking-wider block">
                                    {{ $stat3['label'] }}
                                </span>
                            </div>
                            <div class="p-6 rounded-3xl blayden-card flex flex-col justify-between text-center min-h-[135px]">
                                <span class="text-3xl sm:text-4xl font-extrabold font-editorial text-[#e26d9b] block leading-none mb-2">
                                    {{ $stat4['num'] }}
                                </span>
                                <span class="text-[11px] font-mono text-[var(--text-muted)] uppercase tracking-wider block">
                                    {{ $stat4['label'] }}
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="lg:col-span-2 hidden lg:block"></div>

                </div>

            </div>
        </section>

        <!-- =========================================================================
             4. SERVICES SECTION (Matches Blayden Template Stacking Cards)
             - Section name on left "Services"
             - H2 Title: "Turn complex problems into simple designs"
             - Dynamic Stacking Feature Cards from Database
             ========================================================================= -->
        <section id="services" class="py-20 lg:py-28 relative border-b border-[var(--section-line)]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left Section Name -->
                    <div class="lg:col-span-2 pt-2">
                        <span class="section-name">
                            <span>Services</span>
                            <i class="ph ph-arrow-down-right"></i>
                        </span>
                    </div>

                    <!-- Main Services Content -->
                    <div class="lg:col-span-8 space-y-12">
                        
                        <div class="space-y-3">
                            <h2 class="text-4xl sm:text-6xl lg:text-7xl font-normal font-editorial text-[var(--text-heading)] leading-[1.08]">
                                @php
                                    $titleFull = $settings['services_title'] ?? 'Creating impactful projects';
                                    $parts = explode(' ', $titleFull, 2);
                                @endphp
                                @if(count($parts) > 1)
                                    {{ $parts[0] }}<br>
                                    <span class="italic font-light text-[var(--text-muted)]">{{ $parts[1] }}</span>
                                @else
                                    {{ $titleFull }}
                                @endif
                            </h2>
                            @if(!empty($settings['services_subtitle']))
                                <p class="text-sm sm:text-base text-[var(--text-muted)] leading-relaxed max-w-2xl">
                                    {{ $settings['services_subtitle'] }}
                                </p>
                            @endif
                        </div>

                        <!-- 2-Column Services Cards Grid matching Digital Designer & Illustrator Mockup -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                            @forelse($services as $index => $service)
                                @php
                                    $imageMap = [
                                        0 => 'blayden/img/services/1200x1000_s02.webp', // Rock (Frontend development)
                                        1 => 'blayden/img/services/1200x1000_s01.webp', // Flower (Graphic design)
                                        2 => 'blayden/img/services/1200x1000_s03.webp', // Diamond (Brand identity)
                                        3 => 'blayden/img/services/1200x1000_s04.webp', // Silk fabric (Digital marketing)
                                    ];
                                    $templateImg = asset($imageMap[$index % 4] ?? 'blayden/img/services/1200x1000_s01.webp');
                                @endphp
                                <div class="blayden-card p-8 sm:p-10 rounded-[32px] group overflow-hidden border border-[var(--border-card)] hover:border-[#e26d9b]/50 transition-all duration-500 flex flex-col justify-between min-h-[460px] sm:min-h-[520px]">
                                    
                                    <!-- Top Text Content -->
                                    <div class="space-y-3">
                                        <h3 class="text-3xl sm:text-4xl font-normal font-editorial text-[var(--text-heading)] leading-snug">
                                            {{ $service->title }}
                                        </h3>
                                        <p class="text-sm text-[var(--text-muted)] leading-relaxed max-w-sm">
                                            {{ $service->description }}
                                        </p>
                                        @if(!empty($service->features))
                                            <div class="flex flex-wrap gap-2 pt-2">
                                                @foreach(is_array($service->features) ? $service->features : explode(',', $service->features) as $feat)
                                                    <span class="px-3 py-1 rounded-full bg-[var(--bg-subtle)] border border-[var(--border-card)] text-xs font-mono text-[var(--text-muted)]">
                                                        {{ trim($feat) }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="pt-6 mt-auto flex items-end justify-center overflow-hidden">
                                        <img 
                                            src="{{ $templateImg }}" 
                                            alt="{{ $service->title }}" 
                                            class="w-full max-h-[240px] sm:max-h-[280px] object-contain object-bottom mx-auto group-hover:scale-105 transition-transform duration-700"
                                            loading="lazy"
                                        >
                                    </div>

                                </div>
                            @empty
                                <div class="col-span-1 md:col-span-2 p-8 text-center rounded-3xl blayden-card text-xs text-[var(--text-muted)]">
                                    No services configured. Add services in the Admin Panel.
                                </div>
                            @endforelse
                        </div>

                    </div>

                    <div class="lg:col-span-2 hidden lg:block"></div>

                </div>

            </div>
        </section>

        <!-- =========================================================================
             5. RESUME, EXPERIENCE & TOOLS SECTION (Matches Blayden Template)
             - Education Timeline & Work Experience Timeline
             - Tools Cards from Database ($skills)
             - Testimonials Carousel from Database ($testimonials)
             ========================================================================= -->
        <section id="resume" class="py-20 lg:py-28 relative border-b border-[var(--section-line)]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left Section Name -->
                    <div class="lg:col-span-2 pt-2">
                        <span class="section-name">
                            <span>Resume</span>
                            <i class="ph ph-arrow-down-right"></i>
                        </span>
                    </div>

                    <!-- Main Resume Content -->
                    <div class="lg:col-span-8 space-y-16">
                        
                        <!-- Heading -->
                        <div class="space-y-3">
                            <h2 class="text-4xl sm:text-6xl font-normal font-editorial text-[var(--text-heading)] leading-tight">
                                {{ $settings['resume_title'] ?? 'Education & work experience' }}
                            </h2>
                            <p class="text-sm sm:text-base text-[var(--text-muted)] leading-relaxed max-w-2xl">
                                {{ $settings['resume_subtitle'] ?? 'A decade of hands-on digital creation, academic honors, and engineering leadership across leading digital agencies.' }}
                            </p>
                        </div>

                        <!-- Two Columns: Education & Work Experience matching Blayden Resume Lines V1 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <!-- Education Block -->
                            <div class="space-y-6">
                                <h3 class="text-xs font-mono font-bold uppercase tracking-widest text-[#e26d9b] flex items-center gap-2">
                                    <i class="ph ph-graduation-cap text-base"></i>
                                    <span>Education</span>
                                </h3>
                                <div class="space-y-4">
                                    @foreach($resumeEducation as $edu)
                                        <div class="blayden-card p-6 rounded-2xl space-y-2">
                                            <span class="text-xs font-mono text-[#e26d9b] block">{{ $edu['period'] }}</span>
                                            <h4 class="text-base font-bold font-editorial text-[var(--text-heading)]">{{ $edu['title'] }}</h4>
                                            <p class="text-xs text-[var(--text-muted)]">{{ $edu['institution'] }} &bull; {{ $edu['grade'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Work Experience Block -->
                            <div class="space-y-6">
                                <h3 class="text-xs font-mono font-bold uppercase tracking-widest text-[#e26d9b] flex items-center gap-2">
                                    <i class="ph ph-briefcase text-base"></i>
                                    <span>Work Experience</span>
                                </h3>
                                <div class="space-y-4">
                                    @foreach($resumeExperience as $exp)
                                        <div class="blayden-card p-6 rounded-2xl space-y-2">
                                            <span class="text-xs font-mono text-[#e26d9b] block">{{ $exp['period'] }}</span>
                                            <h4 class="text-base font-bold font-editorial text-[var(--text-heading)]">{{ $exp['title'] }}</h4>
                                            <p class="text-xs text-[var(--text-muted)] font-semibold">{{ $exp['company'] }}</p>
                                            <p class="text-xs text-[var(--text-muted)] leading-relaxed pt-1">{{ $exp['description'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        <!-- Tools & Mastered Software Cards matching Blayden Features Tools -->
                        <div class="space-y-6 pt-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-xs font-mono font-bold uppercase tracking-widest text-[#e26d9b] flex items-center gap-2">
                                    <i class="ph ph-cpu text-base"></i>
                                    <span>{{ $settings['skills_title'] ?? 'Tools & Technologies I Use' }}</span>
                                </h3>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                @forelse($skills as $skill)
                                    @php
                                        $sName = strtolower($skill->name);
                                        $customIcon = $skill->icon ?? null;
                                    @endphp
                                    <div class="blayden-card p-5 rounded-2xl space-y-3 group text-center flex flex-col items-center">
                                        <div class="w-12 h-12 rounded-xl bg-[var(--bg-subtle)] border border-[var(--border-card)] flex items-center justify-center text-xl text-[#e26d9b] group-hover:scale-110 transition-transform overflow-hidden">
                                            @if(!empty($customIcon) && (str_contains($customIcon, 'ph-') || str_starts_with($customIcon, 'ph ')))
                                                <i class="{{ $customIcon }} text-2xl text-[#e26d9b]"></i>
                                            @elseif(!empty($customIcon) && str_starts_with($customIcon, '<svg'))
                                                {!! $customIcon !!}
                                            @elseif(!empty($customIcon) && (str_ends_with($customIcon, '.png') || str_ends_with($customIcon, '.jpg') || str_ends_with($customIcon, '.svg') || str_ends_with($customIcon, '.webp')))
                                                <img src="{{ asset($customIcon) }}" alt="{{ $skill->name }}" class="w-7 h-7 object-contain">
                                            @elseif(str_contains($sName, 'figma'))
                                                <svg class="w-6 h-6" viewBox="0 0 38 57" fill="none">
                                                    <path d="M19 28.5C19 23.2533 23.2533 19 28.5 19C33.7467 19 38 23.2533 38 28.5C38 33.7467 33.7467 38 28.5 38C23.2533 38 19 33.7467 19 28.5Z" fill="#1ABCFE"/>
                                                    <path d="M0 47.5C0 42.2533 4.25329 38 9.5 38H19V47.5C19 52.7467 14.7467 57 9.5 57C4.25329 57 0 52.7467 0 47.5Z" fill="#0ACF83"/>
                                                    <path d="M19 0V19H28.5C33.7467 19 38 14.7467 38 9.5C38 4.25329 33.7467 0 28.5 0H19Z" fill="#FF7262"/>
                                                    <path d="M0 9.5C0 14.7467 4.25329 19 9.5 19H19V0H9.5C4.25329 0 0 4.25329 0 9.5Z" fill="#F24E1E"/>
                                                    <path d="M0 28.5C0 33.7467 4.25329 38 9.5 38H19V19H9.5C4.25329 19 0 23.2533 0 28.5Z" fill="#A259FF"/>
                                                </svg>
                                            @elseif(str_contains($sName, 'photoshop') || str_contains($sName, 'ps'))
                                                <div class="w-8 h-8 rounded-lg bg-[#001E36] border border-[#31A8FF]/60 flex items-center justify-center font-bold text-xs text-[#31A8FF] font-sans shadow-sm tracking-tight">Ps</div>
                                            @elseif(str_contains($sName, 'illustrator') || str_contains($sName, 'ai'))
                                                <div class="w-8 h-8 rounded-lg bg-[#330000] border border-[#FF9A00]/60 flex items-center justify-center font-bold text-xs text-[#FF9A00] font-sans shadow-sm tracking-tight">Ai</div>
                                            @elseif(str_contains($sName, 'cinema') || str_contains($sName, 'c4d'))
                                                <div class="w-8 h-8 rounded-lg bg-[#05162E] border border-[#00D4FF]/60 flex items-center justify-center font-bold text-[10px] text-[#00D4FF] font-mono shadow-sm tracking-tighter">C4D</div>
                                            @elseif(str_contains($sName, 'after effect') || str_contains($sName, 'ae'))
                                                <div class="w-8 h-8 rounded-lg bg-[#00005B] border border-[#9999FF]/60 flex items-center justify-center font-bold text-xs text-[#9999FF] font-sans shadow-sm tracking-tight">Ae</div>
                                            @elseif(str_contains($sName, 'blender'))
                                                <div class="w-8 h-8 rounded-lg bg-[#222B35] border border-[#EA7600]/60 flex items-center justify-center font-bold text-xs text-[#EA7600] font-sans shadow-sm tracking-tight">Bl</div>
                                            @elseif(str_contains($sName, 'indesign') || str_contains($sName, 'id'))
                                                <div class="w-8 h-8 rounded-lg bg-[#49021F] border border-[#FF3366]/60 flex items-center justify-center font-bold text-xs text-[#FF3366] font-sans shadow-sm tracking-tight">Id</div>
                                            @elseif(str_contains($sName, 'premiere') || str_contains($sName, 'pr'))
                                                <div class="w-8 h-8 rounded-lg bg-[#00005B] border border-[#9999FF]/60 flex items-center justify-center font-bold text-xs text-[#9999FF] font-sans shadow-sm tracking-tight">Pr</div>
                                            @elseif(str_contains($sName, 'react') || str_contains($sName, 'vue'))
                                                <i class="ph ph-atom text-2xl text-[#61DAFB]"></i>
                                            @elseif(str_contains($sName, 'wordpress'))
                                                <i class="ph ph-globe-hemisphere-west text-2xl text-[#21759B]"></i>
                                            @elseif(str_contains($sName, 'php') || str_contains($sName, 'laravel') || str_contains($sName, 'code') || str_contains($sName, 'html') || str_contains($sName, 'css'))
                                                <i class="ph ph-code text-2xl text-[#e26d9b]"></i>
                                            @else
                                                <i class="ph ph-sparkle text-2xl text-[#e26d9b]"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold font-editorial text-[var(--text-heading)]">{{ $skill->name }}</h4>
                                            <span class="text-[11px] font-mono text-[var(--text-muted)]">{{ $skill->proficiency ?? $skill->percentage ?? '90' }}% Proficiency</span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-4 p-6 text-center blayden-card text-xs text-[var(--text-muted)]">
                                        Configure skills & tools in Admin Panel.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Testimonials Slider matching Blayden Feature 26: 2 items in one row, auto-slide 1 item every 5 seconds -->
                        @php
                            $allTestimonials = $testimonials->count() > 0 ? $testimonials : collect([
                                (object)[
                                    'content' => 'Alex delivered an extraordinary website that increased our client conversion by 48%. His eye for detail and clean code architecture are unmatched.',
                                    'client_name' => 'Marcus Vance',
                                    'client_position' => 'Founder & CEO'
                                ],
                                (object)[
                                    'content' => 'Alex brought a rare poetic sensibility to our brand launch. The delicate interplay between minimalism and emotional richness transformed our identity.',
                                    'client_name' => 'Sophia Laurent',
                                    'client_position' => 'Creative Director'
                                ],
                                (object)[
                                    'content' => 'Working with Alex was the best decision we made for our SaaS re-launch. The animations, speed, and backend responsiveness are truly world-class.',
                                    'client_name' => 'Sophia Chen',
                                    'client_position' => 'VP of Product'
                                ],
                                (object)[
                                    'content' => 'Uncompromising craft and meticulous attention to detail. Alex delivered stunning visual systems well ahead of schedule.',
                                    'client_name' => 'Julian Vance',
                                    'client_position' => 'Head of Design'
                                ],
                            ]);

                            if ($allTestimonials->count() < 4) {
                                $allTestimonials = $allTestimonials->concat($allTestimonials);
                            }
                        @endphp

                        <div class="space-y-6 pt-6">
                            <div class="space-y-2">
                                <h3 class="text-xs font-mono font-bold uppercase tracking-widest text-[#e26d9b] flex items-center gap-2">
                                    <i class="ph ph-chat-centered-text text-base"></i>
                                    <span>{{ $settings['testimonials_title'] ?? 'What Amazing people Say About me' }}</span>
                                </h3>
                            </div>

                            <div class="testimonials-slider-container relative overflow-hidden" data-autoplay="5000">
                                <div class="testimonials-slider-track flex transition-transform duration-700 ease-out -mx-3">
                                    @foreach($allTestimonials as $testimony)
                                        <div class="testimonials-slide w-full md:w-1/2 flex-shrink-0 px-3">
                                            <div class="blayden-card p-8 rounded-3xl space-y-4 h-full flex flex-col justify-between">
                                                <div>
                                                    <div class="text-[#e26d9b] text-2xl font-serif leading-none mb-3">“</div>
                                                    <p class="text-sm text-[var(--text-muted)] leading-relaxed italic">
                                                        {{ $testimony->content ?? $testimony->feedback }}
                                                    </p>
                                                </div>
                                                <div class="flex items-center gap-3 pt-3 border-t border-[var(--section-line)]">
                                                    <div class="w-10 h-10 rounded-full bg-[var(--bg-subtle)] border border-[var(--border-card)] flex items-center justify-center font-bold text-xs text-[#e26d9b]">
                                                        {{ substr($testimony->client_name ?? $testimony->name ?? 'A', 0, 2) }}
                                                    </div>
                                                    <div>
                                                        <h4 class="text-xs font-bold font-editorial text-[var(--text-heading)]">
                                                            {{ $testimony->client_name ?? $testimony->name }}
                                                        </h4>
                                                        <span class="text-[10px] text-[var(--text-muted)]">
                                                            {{ $testimony->client_position ?? $testimony->client_role ?? ($testimony->position ?? 'Founder') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Slider Controls: Prev/Next & Dots -->
                                <div class="flex items-center justify-center gap-6 mt-8">
                                    <button type="button" class="testimonials-prev-btn w-10 h-10 rounded-full bg-white/70 dark:bg-white/10 hover:bg-[#e26d9b] hover:text-white border border-[var(--border-card)] text-[var(--text-heading)] flex items-center justify-center transition-all cursor-pointer shadow-sm" aria-label="Previous testimonial">
                                        &#8592;
                                    </button>
                                    <div class="testimonials-dots flex items-center gap-2 text-[#e26d9b]"></div>
                                    <button type="button" class="testimonials-next-btn w-10 h-10 rounded-full bg-white/70 dark:bg-white/10 hover:bg-[#e26d9b] hover:text-white border border-[var(--border-card)] text-[var(--text-heading)] flex items-center justify-center transition-all cursor-pointer shadow-sm" aria-label="Next testimonial">
                                        &#8594;
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="lg:col-span-2 hidden lg:block"></div>

                </div>

            </div>
        </section>

        <!-- =========================================================================
             6. CONTACT SECTION (Matches Blayden Template index-demo-1.html)
             - Section name on left "Contact"
             - H2 Title: "Let's make something amazing together!"
             - Working AJAX Contact Form + Direct Contact Details
             ========================================================================= -->
        <section id="contact" class="py-20 lg:py-28 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left Section Name -->
                    <div class="lg:col-span-2 pt-2">
                        <span class="section-name">
                            <span>Contact</span>
                            <i class="ph ph-arrow-down-right"></i>
                        </span>
                    </div>

                    <!-- Main Contact Content -->
                    <div class="lg:col-span-8 space-y-12">
                        
                        <!-- Heading -->
                        <div class="space-y-3">
                            <h2 class="text-4xl sm:text-6xl font-normal font-editorial text-[var(--text-heading)] leading-tight">
                                {{ $settings['contact_title'] ?? "Let's make something" }}<br>
                                <span class="italic font-light text-[var(--text-muted)]">amazing together!</span>
                            </h2>
                            <p class="text-sm sm:text-base text-[var(--text-muted)] leading-relaxed max-w-2xl">
                                {{ $settings['contact_subtitle'] ?? 'Have a project in mind or need creative direction? Send a message and let\'s turn your vision into reality.' }}
                            </p>
                        </div>

                        <!-- Form & Info Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
                            
                            <!-- Left: Contact Data -->
                            <div class="md:col-span-5 space-y-6">
                                <div class="blayden-card p-6 rounded-3xl space-y-4">
                                    <div>
                                        <span class="text-[10px] font-mono uppercase tracking-widest text-[#e26d9b] block">Email Inquiries</span>
                                        <a href="mailto:{{ $settings['contact_email'] ?? 'alex.walker@design.me' }}" class="text-sm font-bold font-editorial text-[var(--text-heading)] hover:text-[#e26d9b] transition-colors break-all">
                                            {{ $settings['contact_email'] ?? 'alex.walker@design.me' }}
                                        </a>
                                    </div>
                                    <div class="pt-2 border-t border-[var(--section-line)]">
                                        <span class="text-[10px] font-mono uppercase tracking-widest text-[#e26d9b] block">Telephone</span>
                                        <a href="tel:{{ $settings['contact_phone'] ?? '+15557829011' }}" class="text-sm font-bold font-editorial text-[var(--text-heading)] hover:text-[#e26d9b] transition-colors">
                                            {{ $settings['contact_phone'] ?? '+1 (555) 782-9011' }}
                                        </a>
                                    </div>
                                    <div class="pt-2 border-t border-[var(--section-line)]">
                                        <span class="text-[10px] font-mono uppercase tracking-widest text-[#e26d9b] block">Studio Location</span>
                                        <span class="text-xs font-semibold text-[var(--text-heading)] block">
                                            {{ $settings['contact_location'] ?? 'London, UK • Available Worldwide' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Contact Form -->
                            <div class="md:col-span-7 blayden-card p-8 sm:p-10 rounded-3xl space-y-6">
                                
                                <div id="contactFormStatus" class="hidden p-4 rounded-xl text-xs font-bold"></div>

                                @if(session('success'))
                                    <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-800 dark:text-emerald-300 text-xs font-bold">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form id="contactForm" action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-[11px] font-mono text-[var(--text-muted)] mb-1">Your Name *</label>
                                            <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl bg-[var(--bg-subtle)] border border-[var(--border-card)] text-[var(--text-heading)] text-xs focus:outline-none focus:border-[#e26d9b]" placeholder="Eleanor Vance">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-mono text-[var(--text-muted)] mb-1">Your Email *</label>
                                            <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl bg-[var(--bg-subtle)] border border-[var(--border-card)] text-[var(--text-heading)] text-xs focus:outline-none focus:border-[#e26d9b]" placeholder="eleanor@studio.co">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-[11px] font-mono text-[var(--text-muted)] mb-1">Project Discipline</label>
                                        <input type="text" name="subject" class="w-full px-4 py-3 rounded-xl bg-[var(--bg-subtle)] border border-[var(--border-card)] text-[var(--text-heading)] text-xs focus:outline-none focus:border-[#e26d9b]" placeholder="Brand Identity &amp; Digital Launch">
                                    </div>

                                    <div>
                                        <label class="block text-[11px] font-mono text-[var(--text-muted)] mb-1">Message *</label>
                                        <textarea name="message" rows="4" required class="w-full px-4 py-3 rounded-xl bg-[var(--bg-subtle)] border border-[var(--border-card)] text-[var(--text-heading)] text-xs focus:outline-none focus:border-[#e26d9b]" placeholder="Share your vision, timeline, and goals..."></textarea>
                                    </div>

                                    <button type="submit" class="btn-blayden-primary w-full py-4 text-xs font-bold">
                                        <span>Dispatch Message</span>
                                        <i class="ph ph-paper-plane-tilt"></i>
                                    </button>
                                </form>

                            </div>

                        </div>

                    </div>

                    <div class="lg:col-span-2 hidden lg:block"></div>

                </div>

            </div>

        </section>

    </main>
    @include('frontend.themes.digital_designer_illustrator.partials.footer')

    <!-- AJAX Form Handling -->
    <script>
        document.getElementById('contactForm')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            const form = this;
            const statusBox = document.getElementById('contactFormStatus');
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalContent = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span>Sending Message...</span>';

            try {
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const data = await response.json();
                statusBox.classList.remove('hidden', 'bg-red-500/10', 'border-red-500/30', 'text-red-600', 'bg-emerald-500/10', 'border-emerald-500/30', 'text-emerald-700');

                if (response.ok && data.success) {
                    statusBox.classList.add('bg-emerald-500/10', 'border', 'border-emerald-500/30', 'text-emerald-700', 'dark:text-emerald-300');
                    statusBox.textContent = data.message || 'Thank you! Your message has been sent successfully.';
                    form.reset();
                } else {
                    statusBox.classList.add('bg-red-500/10', 'border', 'border-red-500/30', 'text-red-600', 'dark:text-red-400');
                    statusBox.textContent = data.message || 'Validation failed. Please verify your fields.';
                }
            } catch (err) {
                statusBox.classList.remove('hidden');
                statusBox.classList.add('bg-red-500/10', 'border', 'border-red-500/30', 'text-red-600');
                statusBox.textContent = 'A network error occurred. Please try again.';
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalContent;
            }
        });
    </script>

</body>
</html>
