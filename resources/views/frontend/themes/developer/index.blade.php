@extends('frontend.layouts.frontend')

@section('content')
    <div
        class="dev-page-wrapper bg-[#070707] text-[#ffffff] min-h-screen selection:bg-[#00ff88] selection:text-[#070707] font-['Plus_Jakarta_Sans'] relative">

        <!-- Ambient Emerald Glows -->
        <div
            class="fixed top-0 right-1/4 w-[500px] h-[500px] bg-[#00ff88]/5 rounded-full blur-[160px] pointer-events-none -z-10">
        </div>
        <div
            class="fixed bottom-1/3 left-10 w-[450px] h-[450px] bg-emerald-600/5 rounded-full blur-[160px] pointer-events-none -z-10">
        </div>

        <!-- Header Partial (Top Info Bar + Sticky Navigation) -->
        @include('frontend.themes.developer.partials.header')


        <!-- =========================================================================
                         2. HERO SECTION (Matches Screenshot: Bold Headline + Developer in Checkered Shirt)
                         ========================================================================= -->
        <section id="hero" class="pt-16 pb-20 relative overflow-hidden">
            <!-- Subtle Topographic Wave SVG Backdrop -->
            <svg class="absolute inset-0 w-full h-full opacity-[0.03] pointer-events-none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="topoGrid" width="60" height="60" patternUnits="userSpaceOnUse">
                        <circle cx="30" cy="30" r="1.5" fill="#00ff88" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#topoGrid)" />
            </svg>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

                    <!-- Left Column (7 cols): Bold Headline & CTA -->
                    <div class="lg:col-span-7 space-y-6">
                        <div
                            class="dev-hero-tag inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#121212] border border-[#00ff88]/30 text-[#00ff88] text-xs font-mono">
                            <span class="w-2 h-2 rounded-full bg-[#00ff88] animate-ping"></span>
                            <span>// {{ $settings['hero_tag'] ?? 'LEAD SOFTWARE ARCHITECT' }}</span>
                        </div>

                        <h1
                            class="dev-hero-title text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight text-white font-['Outfit'] uppercase leading-[1.05]">
                            <span class="text-[#00ff88]">{{ $settings['hero_title_line1'] ?? 'IMAGINATION' }}</span><br>
                            {{ $settings['hero_title_line2'] ?? 'IS MORE IMPORTANT THAN KNOWLEDGE' }}
                        </h1>

                        <p class="dev-hero-desc text-neutral-400 text-xs sm:text-sm leading-relaxed max-w-xl">
                            {{ $settings['hero_description'] ?? 'I build resilient web platforms, decoupled backend APIs, and enterprise cloud solutions engineered for high concurrency, rock-solid stability, and sub-second execution.' }}
                        </p>

                        <!-- Dot Matrix Decorative Accent -->
                        <div class="dev-hero-dots flex items-center gap-2 py-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#00ff88]"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-[#00ff88]/60"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-[#00ff88]/30"></span>
                            <span class="dev-hero-line w-12 h-[1px] bg-white/10"></span>
                            <span
                                class="dev-hero-badge-text text-[11px] font-mono text-neutral-500 uppercase tracking-widest">{{ $settings['hero_badge'] ?? 'PRODUCTION ENGINEER' }}</span>
                        </div>

                        <div class="pt-2 flex flex-wrap items-center gap-4">
                            <a href="{{ $settings['hero_cta_url'] ?? route('contact') }}" class="dev-btn-primary">
                                <span>{{ $settings['hero_cta_text'] ?? 'GET STARTED' }}</span>
                                <span class="w-5 h-5 rounded bg-black/20 flex items-center justify-center text-xs">➔</span>
                            </a>
                            <a href="{{ $settings['hero_cta2_url'] ?? route('portfolio') }}" class="dev-btn-outline">
                                <span>{{ $settings['hero_cta2_text'] ?? 'VIEW PROJECTS' }}</span>
                            </a>
                        </div>
                    </div>

                    <!-- Right Column (5 cols): Developer Cutout Portrait in Checkered Shirt -->
                    <div class="lg:col-span-5 relative flex items-center justify-center">

                        <!-- Decorative Topographic Contour Ring Background -->
                        <div
                            class="dev-hero-ring-1 absolute -inset-6 rounded-full border border-white/5 opacity-50 pointer-events-none scale-110">
                        </div>
                        <div
                            class="dev-hero-ring-2 absolute -inset-14 rounded-full border border-dashed border-[#00ff88]/15 pointer-events-none">
                        </div>

                        <!-- Developer Image Container -->
                        <div
                            class="dev-hero-img-box relative z-10 w-full max-w-[390px] aspect-[3/4] rounded-3xl overflow-hidden border-2 border-white/10 shadow-2xl bg-[#0c0c0c] group">
                            <img src="{{ !empty($settings['hero_image']) ? asset($settings['hero_image']) : (file_exists(public_path('images/themes/developer/hero_portrait.jpg')) ? asset('images/themes/developer/hero_portrait.jpg') : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=85') }}"
                                alt="{{ $settings['hero_title_line1'] ?? 'Lead Software Engineer' }}"
                                class="w-full h-full object-cover object-top filter brightness-105 contrast-105 group-hover:scale-102 transition-transform duration-500">
                            <!-- Emerald Floating Badge -->
                            <div
                                class="dev-hero-exp-badge absolute bottom-4 right-4 px-3 py-1.5 rounded-xl bg-[#070707]/90 border border-[#00ff88]/40 backdrop-blur-md flex items-center gap-2">
                                <span class="dev-badge-icon text-[#00ff88] text-sm">⬢</span>
                                <span class="dev-badge-text text-[10px] font-mono font-bold text-white uppercase">
                                    {{ $settings['experience_years'] ?? '10' }}+
                                    YRS EXP</span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>


        <!-- =========================================================================
                         3. FAILURE IS THE CONDIMENT THAT GIVES SUCCESS (VIDEO / PHILOSOPHY)
                         ========================================================================= -->
        <section class="py-24 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                    <!-- Left 6 cols: Developer at workstation with glowing Play button -->
                    <div class="lg:col-span-6 relative group">
                        <!-- Dot Matrix Underlay -->
                        <div
                            class="absolute -bottom-6 -left-6 w-32 h-32 bg-radial from-[#00ff88]/20 to-transparent -z-10 rounded-full blur-xl">
                        </div>

                        <div
                            class="rounded-3xl overflow-hidden aspect-[16/10] bg-[#121212] border border-white/10 relative shadow-2xl">
                            <img src="{{ !empty($settings['about_image']) ? asset($settings['about_image']) : (file_exists(public_path('images/themes/developer/workspace_video.jpg')) ? asset('images/themes/developer/workspace_video.jpg') : 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=800&q=80') }}"
                                alt="{{ $settings['about_heading'] ?? 'Developer Workspace' }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <!-- Glowing Emerald Play Button (Matches uploaded design) -->
                            <button id="devVideoPlay" type="button"
                                class="absolute inset-0 m-auto w-16 h-16 rounded-full bg-[#00ff88] text-[#070707] flex items-center justify-center font-bold text-lg shadow-xl shadow-emerald-500/50 hover:scale-110 transition-transform cursor-pointer"
                                title="Watch Workspace Tour">
                                ▶
                            </button>
                        </div>
                    </div>

                    <!-- Right 6 cols: Headline & Philosophy Copy -->
                    <div class="lg:col-span-6 space-y-6">
                        <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block">//
                            {{ $settings['about_tag'] ?? 'PHILOSOPHY' }}</span>

                        <h2 class="text-3xl sm:text-5xl font-black text-white font-['Outfit'] uppercase leading-tight">
                            {!! $settings['about_heading'] ??
                                'FAILURE IS THE CONDIMENT THAT GIVES <span class="text-[#00ff88]">SUCCESS</span>' !!}
                        </h2>

                        <p class="text-neutral-400 text-xs sm:text-sm leading-relaxed">
                            {{ $settings['about_description'] ?? 'Every broken build, unhandled exception, and performance bottleneck is an invitation to engineer a better, more resilient architecture. Through persistent refactoring, rigorous automated testing, and obsessive attention to database indexing, we build software that never fails when it matters most.' }}
                        </p>

                        <div class="pt-2">
                            <a href="{{ route('about') }}" class="dev-btn-primary">
                                <span>{{ $settings['about_cta_text'] ?? 'MORE ABOUT ME' }}</span>
                                <span class="w-5 h-5 rounded bg-black/20 flex items-center justify-center text-xs">➔</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- =========================================================================
                         4. EXPERIENCE AND SKILL (4 TIMELINE CARDS + 4 CIRCULAR GAUGES)
                         ========================================================================= -->
        <section class="py-24 bg-[#0a0a0a] relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Section Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                    <div>
                        <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block mb-1">//
                            {{ $settings['experience_tag'] ?? 'MY RESUME & SKILLS' }}</span>
                        <h2 class="text-3xl sm:text-5xl font-black text-white font-['Outfit'] uppercase">
                            {!! $settings['experience_heading'] ?? 'EXPERIENCE AND <span class="text-[#00ff88]">SKILL</span>' !!}
                        </h2>
                    </div>
                    <p class="text-neutral-400 text-xs sm:text-sm max-w-md">
                        {{ $settings['experience_description'] ?? 'A decade of hands-on software engineering, production deployments, and microservice infrastructure architectures.' }}
                    </p>
                </div>

                <!-- 4 Milestone Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                    @if (isset($resumeExperience) && $resumeExperience->count() > 0)
                        @foreach ($resumeExperience->take(4) as $item)
                            <div
                                class="p-6 rounded-2xl bg-[#111111] border border-white/5 space-y-2 hover:border-[#00ff88]/30 transition-colors">
                                <span class="text-xs font-mono font-bold text-[#00ff88]">{{ $item->period }}</span>
                                <h4 class="text-sm font-bold text-white uppercase font-['Outfit']">{{ $item->title }}</h4>
                                <p class="text-[11px] text-neutral-400 font-mono">{{ $item->company }}</p>
                            </div>
                        @endforeach
                    @else
                        <div
                            class="p-6 rounded-2xl bg-[#111111] border border-white/5 space-y-2 hover:border-[#00ff88]/30 transition-colors">
                            <span class="text-xs font-mono font-bold text-[#00ff88]">2020 - 2024</span>
                            <h4 class="text-sm font-bold text-white uppercase font-['Outfit']">SENIOR WEB DEVELOPER</h4>
                            <p class="text-[11px] text-neutral-400 font-mono">TechVision Global Ltd</p>
                        </div>
                        <div
                            class="p-6 rounded-2xl bg-[#111111] border border-white/5 space-y-2 hover:border-[#00ff88]/30 transition-colors">
                            <span class="text-xs font-mono font-bold text-[#00ff88]">2018 - 2020</span>
                            <h4 class="text-sm font-bold text-white uppercase font-['Outfit']">FULL-STACK ENGINEER</h4>
                            <p class="text-[11px] text-neutral-400 font-mono">CloudScale Systems</p>
                        </div>
                        <div
                            class="p-6 rounded-2xl bg-[#111111] border border-white/5 space-y-2 hover:border-[#00ff88]/30 transition-colors">
                            <span class="text-xs font-mono font-bold text-[#00ff88]">2016 - 2018</span>
                            <h4 class="text-sm font-bold text-white uppercase font-['Outfit']">LEAD BACKEND ARCHITECT</h4>
                            <p class="text-[11px] text-neutral-400 font-mono">PixelCraft Studio</p>
                        </div>
                        <div
                            class="p-6 rounded-2xl bg-[#111111] border border-white/5 space-y-2 hover:border-[#00ff88]/30 transition-colors">
                            <span class="text-xs font-mono font-bold text-[#00ff88]">2014 - 2016</span>
                            <h4 class="text-sm font-bold text-white uppercase font-['Outfit']">SOFTWARE SPECIALIST</h4>
                            <p class="text-[11px] text-neutral-400 font-mono">ByteForge Systems</p>
                        </div>
                    @endif
                </div>

                <!-- Circular Skill Gauges from Database -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 text-center pt-8 border-t border-white/5">
                    @forelse($skills->take(4) as $skill)
                        <div class="flex flex-col items-center">
                            <div class="dev-skill-circle mb-4" data-skill-val="{{ $skill->percentage }}"
                                style="--skill-percent: {{ $skill->percentage }}%;">
                                <span
                                    class="text-2xl font-black font-['Outfit'] text-white">{{ $skill->percentage }}%</span>
                            </div>
                            <span
                                class="text-xs font-bold uppercase tracking-wider text-neutral-200">{{ $skill->name }}</span>
                        </div>
                    @empty
                        <div class="col-span-4 text-center text-xs text-neutral-500 py-4">Skills can be managed from Admin
                            Panel.</div>
                    @endforelse
                </div>

            </div>
        </section>


        <!-- =========================================================================
                         5. SERVICES AND SOLUTIONS (3 CARDS, CENTER HIGHLIGHTED IN NEON GREEN)
                         ========================================================================= -->
        <section id="services" class="py-24 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                    <div>
                        <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block mb-1">//
                            {{ $settings['services_tag'] ?? 'WHAT I DO' }}</span>
                        <h2 class="text-3xl sm:text-5xl font-black text-white font-['Outfit'] uppercase">
                            {!! $settings['services_heading'] ?? 'SERVICES AND <span class="text-[#00ff88]">SOLUTIONS</span>' !!}
                        </h2>
                    </div>
                    <p class="text-neutral-400 text-xs sm:text-sm max-w-md">
                        {{ $settings['services_description'] ?? 'End-to-end technical engineering tailored to turn complex software concepts into fast, secure, production-grade applications.' }}
                    </p>
                </div>

                <!-- Featured Service Cards from Database -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                    @forelse($services->take(3) as $idx => $service)
                        @php $isHighlighted = ($idx === 1); @endphp
                        <div
                            class="dev-service-card {{ $isHighlighted ? 'highlighted' : '' }} flex flex-col justify-between">
                            <div class="space-y-4">
                                <div
                                    class="w-12 h-12 rounded-2xl {{ $isHighlighted ? 'bg-black/20 text-[#070707]' : 'bg-[#1a1a1a] text-[#00ff88]' }} flex items-center justify-center text-xl font-black">
                                    ⬢
                                </div>
                                <h3
                                    class="text-xl {{ $isHighlighted ? 'font-black text-[#070707]' : 'font-bold text-white' }} font-['Outfit'] uppercase">
                                    {{ $service->title }}
                                </h3>
                                <p
                                    class="text-xs {{ $isHighlighted ? 'text-[#070707]/90 font-medium' : 'text-neutral-400' }} leading-relaxed">
                                    {{ $service->description }}
                                </p>
                            </div>
                            <div class="pt-6">
                                <a href="{{ route('contact') }}"
                                    class="inline-flex items-center gap-1.5 text-xs {{ $isHighlighted ? 'font-extrabold text-[#070707] underline' : 'font-bold text-[#00ff88]' }} uppercase tracking-wider">
                                    <span>Learn More</span> ➔
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center text-xs text-neutral-500 py-6">Services can be managed from
                            Admin Panel.</div>
                    @endforelse
                </div>

            </div>
        </section>


        <!-- =========================================================================
                         6. LATEST WORKING PROJECT (3 BROWSER FRAME CARDS)
                         ========================================================================= -->
        <section id="projects" class="py-24 bg-[#0a0a0a] relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                    <div>
                        <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block mb-1">//
                            {{ $settings['portfolio_tag'] ?? 'PORTFOLIO' }}</span>
                        <h2 class="text-3xl sm:text-5xl font-black text-white font-['Outfit'] uppercase">
                            {!! $settings['portfolio_heading'] ?? 'LATEST WORKING <span class="text-[#00ff88]">PROJECT</span>' !!}
                        </h2>
                    </div>
                    <p class="text-neutral-400 text-xs sm:text-sm max-w-md">
                        {{ $settings['portfolio_description'] ?? 'Selected modern production websites, web applications, and digital platforms.' }}
                    </p>
                </div>

                <!-- Browser Card Mockups Grid from Database -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($projects->take(3) as $proj)
                        @php
                            $pImg = $proj->image_url ?? ($proj->image ?? null);
                            if ($pImg && !str_starts_with($pImg, 'http')) {
                                $pImg = asset($pImg);
                            }
                        @endphp
                        <div
                            class="rounded-3xl bg-[#111111] border border-white/10 overflow-hidden hover:border-[#00ff88]/40 transition-all group flex flex-col justify-between">
                            <div>
                                <!-- Mockup Browser Header (Red, Yellow, Green dots) -->
                                <div class="px-4 py-2.5 bg-[#171717] border-b border-white/5 flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500/80"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></span>
                                    <span
                                        class="text-[10px] font-mono text-neutral-500 ml-2">{{ $proj->demo_url ?? 'https://project.local' }}</span>
                                </div>
                                <div class="aspect-[16/11] bg-black/50 overflow-hidden relative">
                                    @if ($pImg)
                                        <img src="{{ $pImg }}" alt="{{ $proj->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#111] to-[#1e1e1e] text-[#00ff88]">
                                            <i class="ph ph-laptop text-4xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6 space-y-2">
                                    <span
                                        class="text-[10px] font-mono font-bold text-[#00ff88] uppercase">{{ $proj->category }}</span>
                                    <h3
                                        class="text-xl font-bold font-['Outfit'] text-white group-hover:text-[#00ff88] transition-colors">
                                        {{ $proj->title }}</h3>
                                </div>
                            </div>
                            <div class="p-6 pt-0">
                                <a href="{{ $proj->demo_url ?? route('portfolio') }}"
                                    target="{{ $proj->demo_url ? '_blank' : '_self' }}"
                                    class="inline-flex items-center gap-1.5 text-xs font-bold text-[#00ff88] uppercase tracking-wider">
                                    <span>Inspect Project</span> ➔
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center text-xs text-neutral-500 py-6">Projects can be managed from
                            Admin Panel.</div>
                    @endforelse
                </div>

            </div>
        </section>


        <!-- =========================================================================
                         7. HAPPY CLIENTS TO SAYS (TESTIMONIALS)
                         ========================================================================= -->
        <section class="py-24 relative overflow-hidden">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

                <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block mb-2">//
                    {{ $settings['testimonials_tag'] ?? 'TESTIMONIALS' }}</span>
                <h2 class="text-3xl sm:text-5xl font-black text-white font-['Outfit'] uppercase mb-12">
                    {!! $settings['testimonials_heading'] ?? 'HAPPY CLIENTS TO <span class="text-[#00ff88]">SAYS</span>' !!}
                </h2>

                @php
                    $allTestimonials = $testimonials->count() > 0 ? $testimonials : collect([
                        (object)[
                            'content' => 'GILROY IS A GREAT AND SUPER-PROFESSIONAL SERVICE PROVIDER, WHICH BROUGHT NEW TECHNOLOGIES, NEW METHODOLOGY, AND A FRESH PERSPECTIVE TO OUR PROJECT.',
                            'client_name' => 'Jack Metiyo Shina',
                            'client_role' => 'Founder & Managing Partner',
                            'company' => 'NYC, USA',
                            'avatar' => null
                        ],
                        (object)[
                            'content' => 'Exceptional full-stack execution with sub-second database queries and zero downtime deployment pipeline. Highly recommended for enterprise projects.',
                            'client_name' => 'Marcus Vance',
                            'client_role' => 'VP of Engineering',
                            'company' => 'CloudScale',
                            'avatar' => null
                        ],
                        (object)[
                            'content' => 'The software architecture and microservices design were rock-solid. Handled over 10M daily events with effortless stability.',
                            'client_name' => 'Elena Rostova',
                            'client_role' => 'CTO',
                            'company' => 'FinTrack Global',
                            'avatar' => null
                        ],
                        (object)[
                            'content' => 'Spotless Laravel and Vue.js engineering. Delivered well ahead of our venture round deadline with comprehensive test coverage.',
                            'client_name' => 'Kenneth Burton',
                            'client_role' => 'Tech Lead',
                            'company' => 'Apex Labs',
                            'avatar' => null
                        ],
                    ]);

                    if ($allTestimonials->count() < 4) {
                        $allTestimonials = $allTestimonials->concat($allTestimonials);
                    }
                @endphp

                <div class="testimonials-slider-container relative overflow-hidden" data-autoplay="5000">
                    <div class="testimonials-slider-track flex transition-transform duration-700 ease-out -mx-3">
                        @foreach($allTestimonials as $testimony)
                            <div class="testimonials-slide w-full md:w-1/2 flex-shrink-0 px-3 text-left">
                                <div class="p-8 sm:p-10 rounded-3xl bg-[#111111] border border-white/10 shadow-2xl space-y-6 relative h-full flex flex-col justify-between">
                                    <div>
                                        <div class="text-[#00ff88] text-5xl font-black leading-none font-serif mb-3">“</div>
                                        <p class="text-sm sm:text-base font-bold text-white uppercase font-['Outfit'] tracking-wide leading-relaxed">
                                            "{{ $testimony->content }}"
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-4 pt-4 border-t border-white/5">
                                        @if ($testimony->avatar)
                                            <img src="{{ $testimony->avatar }}"
                                                class="w-12 h-12 rounded-full object-cover border-2 border-[#00ff88]"
                                                alt="{{ $testimony->client_name }}">
                                        @else
                                            <div class="w-12 h-12 rounded-full bg-[#181818] border-2 border-[#00ff88] flex items-center justify-center font-bold text-white uppercase text-sm">
                                                {{ substr($testimony->client_name ?? 'C', 0, 2) }}
                                            </div>
                                        @endif
                                        <div class="text-left">
                                            <h4 class="text-sm font-bold text-white font-['Outfit'] uppercase">
                                                {{ $testimony->client_name }}
                                            </h4>
                                            <span class="text-xs text-[#00ff88] font-mono">
                                                {{ $testimony->client_role ?? 'Client' }}
                                                {{ !empty($testimony->company) ? '• ' . $testimony->company : '' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Slider Controls: Prev/Next & Dots -->
                    <div class="flex items-center justify-center gap-6 mt-10">
                        <button type="button" class="testimonials-prev-btn w-10 h-10 rounded-full bg-white/5 hover:bg-[#00ff88] hover:text-black border border-white/10 text-white flex items-center justify-center transition-all cursor-pointer shadow-md" aria-label="Previous testimonial">
                            &#8592;
                        </button>
                        <div class="testimonials-dots flex items-center gap-2 text-[#00ff88]"></div>
                        <button type="button" class="testimonials-next-btn w-10 h-10 rounded-full bg-white/5 hover:bg-[#00ff88] hover:text-black border border-white/10 text-white flex items-center justify-center transition-all cursor-pointer shadow-md" aria-label="Next testimonial">
                            &#8594;
                        </button>
                    </div>
                </div>

            </div>
        </section>


        <!-- =========================================================================
                         8. ALL OUR PAYMENT OPTIONS (PRICING TIERS)
                         ========================================================================= -->
        <section id="pricing" class="py-24 bg-[#0a0a0a] relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="text-center max-w-xl mx-auto mb-16">
                    <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block mb-2">//
                        {{ $settings['pricing_tag'] ?? 'PRICING PLANS' }}</span>
                    <h2 class="text-3xl sm:text-5xl font-black text-white font-['Outfit'] uppercase">
                        {!! $settings['pricing_heading'] ?? 'ALL OUR PAYMENT <span class="text-[#00ff88]">OPTIONS</span>' !!}
                    </h2>
                </div>

                <!-- Pricing Cards from Database -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                    @forelse($pricingPlans->take(3) as $plan)
                        @php
                            $isFeatured = $plan->is_featured;
                            $features = is_array($plan->features)
                                ? $plan->features
                                : json_decode($plan->features, true) ??
                                    ($plan->features_list ??
                                        array_filter(array_map('trim', explode("\n", $plan->features ?? ''))));
                        @endphp
                        <div
                            class="dev-pricing-card {{ $isFeatured ? 'featured' : '' }} flex flex-col justify-between p-8 sm:p-9 rounded-3xl transition-all duration-300">
                            <div>
                                @if ($isFeatured)
                                    <div class="inline-block mb-4">
                                        <span
                                            class="text-[10px] font-mono font-black uppercase tracking-wider bg-black/20 px-3.5 py-1 rounded-full text-[#070707] inline-flex items-center gap-1.5 shadow-sm">
                                            <span>⚡</span> POPULAR SPRINT
                                        </span>
                                    </div>
                                @endif
                                <h3
                                    class="text-xl font-black {{ $isFeatured ? 'text-[#070707]' : 'text-white' }} uppercase font-['Outfit'] mb-3 tracking-wide">
                                    {{ $plan->name }}</h3>
                                <div class="mb-6 flex items-baseline justify-center gap-1.5">
                                    <span
                                        class="text-4xl sm:text-5xl font-black {{ $isFeatured ? 'text-[#070707]' : 'text-[#00ff88]' }} font-['Outfit'] tracking-tight">${{ number_format($plan->price, 0) }}</span>
                                    <span
                                        class="text-xs {{ $isFeatured ? 'text-[#070707]/80' : 'text-neutral-400' }} font-mono font-semibold">/
                                        {{ $plan->billing_period }}</span>
                                </div>
                                <ul
                                    class="space-y-3.5 text-xs {{ $isFeatured ? 'text-[#070707] font-semibold border-black/15' : 'text-neutral-300 border-white/10' }} pt-6 border-t text-left dev-pricing-features">
                                    @foreach ($features as $feature)
                                        @if (is_string($feature) && trim($feature))
                                            <li class="flex items-start gap-2.5">
                                                <span
                                                    class="w-4 h-4 rounded-full {{ $isFeatured ? 'bg-black/15 text-[#070707]' : 'bg-[#00ff88]/15 text-[#00ff88] dev-feature-check' }} flex items-center justify-center shrink-0 text-[10px] font-black mt-0.5">✓</span>
                                                <span class="leading-relaxed">{{ trim($feature) }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="pt-8">
                                <a href="{{ $plan->button_url ?? route('contact') }}"
                                    class="{{ $isFeatured ? 'w-full py-3.5 rounded-full bg-[#070707] text-[#00ff88] font-black text-xs uppercase tracking-wider hover:bg-black/85 transition-all inline-flex items-center justify-center gap-1.5 shadow-lg shadow-black/30 hover:scale-[1.02]' : 'dev-btn-outline w-full justify-center py-3' }}">
                                    <span>{{ $plan->button_text ?? 'CHOOSE PLAN' }}</span> ➔
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center text-xs text-neutral-500 py-6">Pricing plans can be managed from
                            Admin Panel.</div>
                    @endforelse
                </div>

            </div>
        </section>


        <!-- =========================================================================
                         9. LASTET NEWS & BLOGS (3 BLOG CARDS WITH CRISP WHITE BODY)
                         ========================================================================= -->
        <section id="blog" class="py-24 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                    <div>
                        <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block mb-1">//
                            {{ $settings['blog_tag'] ?? 'BLOG & NEWS' }}</span>
                        <h2 class="text-3xl sm:text-5xl font-black text-white font-['Outfit'] uppercase">
                            {!! $settings['blog_heading'] ?? 'LASTET NEWS & <span class="text-[#00ff88]">BLOGS</span>' !!}
                        </h2>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button"
                            class="w-8 h-8 rounded-full bg-[#181818] border border-white/10 hover:border-[#00ff88] text-neutral-400 hover:text-[#00ff88] flex items-center justify-center transition-colors">‹</button>
                        <button type="button"
                            class="w-8 h-8 rounded-full bg-[#181818] border border-white/10 hover:border-[#00ff88] text-neutral-400 hover:text-[#00ff88] flex items-center justify-center transition-colors">›</button>
                    </div>
                </div>

                <!-- 3 Blog Cards (Matching image with image on top and white card on bottom) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($blogPosts as $post)
                        <article
                            class="rounded-3xl overflow-hidden border border-white/10 hover:border-[#00ff88]/40 transition-all group flex flex-col justify-between shadow-2xl bg-white">
                            <div>
                                <div class="aspect-[16/10] bg-neutral-900 overflow-hidden relative">
                                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <span
                                        class="absolute top-3 left-3 px-3 py-1 rounded-full text-[10px] font-mono font-bold bg-[#00ff88] text-[#070707]">
                                        {{ $post['category'] }}
                                    </span>
                                </div>
                                <!-- Crisp White Card Body as seen in reference image -->
                                <div class="p-6 space-y-2 bg-white text-[#070707]">
                                    <span
                                        class="text-[10px] font-mono text-neutral-500 uppercase tracking-wider block">{{ $post['date'] }}
                                        &bull; BY ADMIN</span>
                                    <h3
                                        class="text-base font-black font-['Outfit'] text-[#070707] group-hover:text-emerald-700 transition-colors uppercase leading-snug line-clamp-2">
                                        {{ $post['title'] }}
                                    </h3>
                                    <p class="text-xs text-neutral-600 line-clamp-2 leading-relaxed">
                                        {{ $post['excerpt'] }}</p>
                                </div>
                            </div>
                            <div class="p-6 pt-0 bg-white">
                                <a href="{{ route('blog.detail', $post['slug']) }}"
                                    class="inline-flex items-center gap-1.5 text-xs font-black text-emerald-600 uppercase tracking-wider hover:text-emerald-800 transition-colors">
                                    <span>READ MORE</span> ➔
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

            </div>
        </section>

        <!-- =========================================================================
                         10. STAY UP TO DATE, SUBSCRIBE (NEWSLETTER BANNER)
                         ========================================================================= -->
        <section class="py-20 bg-[#0a0a0a] border-t border-b border-white/5 relative overflow-hidden">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center space-y-6">
                <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block">//
                    {{ $settings['newsletter_tag'] ?? 'NEWSLETTER' }}</span>
                <h2 class="text-3xl sm:text-5xl font-black text-white font-['Outfit'] uppercase leading-tight">
                    {!! $settings['newsletter_heading'] ??
                        'STAY UP TO DATE, SUBSCRIBE TO THE CODE <span class="text-[#00ff88]">NEWSLETTER</span>' !!}
                </h2>
                <p class="text-xs text-neutral-400 max-w-md mx-auto">
                    {{ $settings['newsletter_description'] ?? 'Get monthly deep dives on backend concurrency, cloud architectures, and full-stack performance directly in your inbox.' }}
                </p>
                <form action="{{ route('contact.submit') }}" method="POST"
                    class="flex flex-col sm:flex-row items-center gap-3 max-w-lg mx-auto pt-2">
                    @csrf
                    <input type="hidden" name="name" value="Newsletter Subscriber">
                    <input type="hidden" name="subject" value="Newsletter Subscription">
                    <input type="hidden" name="message" value="Subscribed to code newsletter">
                    <input type="email" name="email" required placeholder="Enter your work email address..."
                        class="w-full px-5 py-3 rounded-full bg-[#121212] border border-white/10 text-white placeholder-neutral-500 text-xs focus:outline-none focus:border-[#00ff88]">
                    <button type="submit"
                        class="dev-btn-primary shrink-0 w-full sm:w-auto justify-center cursor-pointer">
                        <span>SUBSCRIBE</span> ➔
                    </button>
                </form>
            </div>
        </section>

        <!-- =========================================================================
                         11. PARTNERS / CLIENT LOGOS ROW
                         ========================================================================= -->
        <div class="py-12 bg-[#070707] border-b border-white/5">
            <div class="max-w-7xl mx-auto px-4 flex flex-wrap items-center justify-between gap-8 opacity-50">
                <span class="text-base font-mono font-bold text-neutral-300">LARAVEL</span>
                <span class="text-base font-mono font-bold text-neutral-300">VUE.JS</span>
                <span class="text-base font-mono font-bold text-neutral-300">TAILWIND</span>
                <span class="text-base font-mono font-bold text-neutral-300">DOCKER</span>
                <span class="text-base font-mono font-bold text-neutral-300">AWS CLOUD</span>
                <span class="text-base font-mono font-bold text-neutral-300">REDIS CACHE</span>
            </div>
        </div>

        <!-- 12. FOOTER (5-Column GLINT Footer) -->
        @include('frontend.themes.developer.partials.footer')

    </div>
@endsection
