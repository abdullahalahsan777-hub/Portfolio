@extends('frontend.layouts.frontend')

@section('content')
<style>
    :root {
        --theme-primary: #00e5ff;
        --theme-primary-hover: #00b4d8;
        --theme-primary-glow: rgba(0, 229, 255, 0.25);
        --theme-on-primary: #000000;
    }
</style>

<div class="laravel-dev-wrapper bg-slate-50 dark:bg-[#070b14] text-slate-900 dark:text-slate-100 min-h-screen selection:bg-[var(--theme-primary)] selection:text-black font-['Plus_Jakarta_Sans'] transition-colors duration-300 relative">

    <!-- Header Partial -->
    @include('frontend.themes.laravel_developer.partials.header')

    <!-- Page Title / Hero -->
    <section class="py-16 sm:py-20 border-b border-slate-200 dark:border-white/5 relative overflow-hidden bg-slate-100/60 dark:bg-[#0a0f1d]/60">
        <!-- Ambient Cyber Glows -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-[var(--theme-primary)]/10 rounded-full blur-[140px] pointer-events-none -z-10"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 bg-blue-600/10 rounded-full blur-[140px] pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-[var(--theme-primary)] text-xs font-mono font-bold w-fit mb-4">
                <span>&lt;developer:profile&gt;</span>
                <span>// PROFESSIONAL DOSSIER</span>
            </div>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-slate-900 dark:text-white">
                ABOUT <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500">MD. ABDULLAH</span> AL AHSAN
            </h1>
            <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-3 max-w-3xl leading-relaxed">
                Full-Stack Laravel Engineer with 8+ years of expertise architecting high-performance enterprise systems, secure payment flows, complex database schemas, and reactive web applications.
            </p>
        </div>
    </section>

    <!-- Bio & Professional Overview -->
    <section class="py-16 sm:py-20 border-b border-slate-200 dark:border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left: Profile Portrait & Quick Badges -->
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-3xl overflow-hidden border border-slate-300 dark:border-white/10 bg-slate-900 aspect-[4/5] shadow-2xl group">
                        <img
                            src="{{ !empty($settings['about_portrait_image']) ? (str_starts_with($settings['about_portrait_image'], 'http') ? $settings['about_portrait_image'] : asset($settings['about_portrait_image'])) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80' }}"
                            alt="Md. Abdullah Al Ahsan - Full-Stack Laravel Developer"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                        
                        <!-- Floating Badge on Avatar -->
                        <div class="absolute bottom-6 left-6 right-6 p-4 rounded-2xl bg-slate-900/90 backdrop-blur-md border border-cyan-500/30 text-white shadow-xl">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-sm font-['Outfit']">Md. Abdullah Al Ahsan</h4>
                                    <p class="text-[11px] font-mono text-[var(--theme-primary)]">Full-Stack Laravel Architect</p>
                                </div>
                                <span class="px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 text-[10px] font-mono font-bold">
                                    AVAILABLE
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Career Narrative & Core Philosophy -->
                <div class="lg:col-span-7 space-y-6">
                    <span class="text-xs font-mono font-bold text-[var(--theme-primary)] uppercase tracking-widest block">
                        // TECHNICAL PHILOSOPHY
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-extrabold font-['Outfit'] text-slate-900 dark:text-white uppercase leading-tight">
                        Clean Architecture, Predictable Schemas, and Resilient Backends.
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        I specialize in building robust enterprise applications with Laravel, PHP 8, and modern relational databases. Having designed mission-critical systems like the <strong>BBGC College Management ERP</strong> and the <strong>Rafiq Enterprise Multi-Store POS</strong>, my development philosophy balances clean, maintainable architecture with uncompromising execution speed.
                    </p>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        Holding a Master's and Bachelor's degree in <strong>Mathematics</strong> from National University provides me with a rigorous foundation in algorithms, relational set theory, data structures, and logical problem solving — translating directly into scalable schema designs and hyper-optimized SQL queries.
                    </p>

                    <!-- Key Metrics Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4">
                        <div class="p-4 rounded-2xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm text-center">
                            <span class="text-2xl sm:text-3xl font-black text-[var(--theme-primary)] font-['Outfit'] block">8+</span>
                            <span class="text-[11px] font-mono text-slate-500 dark:text-slate-400 uppercase mt-1 block">Years Exp.</span>
                        </div>
                        <div class="p-4 rounded-2xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm text-center">
                            <span class="text-2xl sm:text-3xl font-black text-cyan-400 font-['Outfit'] block">60+</span>
                            <span class="text-[11px] font-mono text-slate-500 dark:text-slate-400 uppercase mt-1 block">Projects</span>
                        </div>
                        <div class="p-4 rounded-2xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm text-center">
                            <span class="text-2xl sm:text-3xl font-black text-emerald-400 font-['Outfit'] block">100%</span>
                            <span class="text-[11px] font-mono text-slate-500 dark:text-slate-400 uppercase mt-1 block">NSDA Certified</span>
                        </div>
                        <div class="p-4 rounded-2xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm text-center">
                            <span class="text-2xl sm:text-3xl font-black text-amber-400 font-['Outfit'] block">24/7</span>
                            <span class="text-[11px] font-mono text-slate-500 dark:text-slate-400 uppercase mt-1 block">Reliability</span>
                        </div>
                    </div>

                    <div class="pt-4 flex flex-wrap items-center gap-4">
                        <a href="{{ route('cv.download') }}" download
                            class="px-6 py-3 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-cyan-500/25 active:scale-95 transition-all flex items-center gap-2">
                            <span>Download Official Resume (PDF)</span>
                            <span>↓</span>
                        </a>
                        <a href="{{ route('contact') }}"
                            class="px-6 py-3 rounded-full bg-slate-200 dark:bg-white/5 hover:bg-slate-300 dark:hover:bg-white/10 border border-slate-300 dark:border-white/10 text-slate-900 dark:text-white font-bold text-xs uppercase tracking-wider transition-all">
                            Hire for Project
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Detailed Personal Dossier & Resume Particulars -->
    <section class="py-16 sm:py-20 border-b border-slate-200 dark:border-white/5 bg-slate-100/50 dark:bg-[#0a0f1d]/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-mono font-bold text-[var(--theme-primary)] uppercase tracking-widest block mb-2">
                    // OFFICIAL VERIFIED PARTICULARS
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold font-['Outfit'] text-slate-900 dark:text-white uppercase tracking-tight">
                    Candidate Particulars &amp; Identity
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1: Identity -->
                <div class="p-6 rounded-3xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 text-[var(--theme-primary)] flex items-center justify-center font-bold">
                        <svg class="w-5 h-5 text-[var(--theme-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-base text-slate-900 dark:text-white font-['Outfit']">Personal Identity</h3>
                    <ul class="text-xs space-y-2 text-slate-600 dark:text-slate-300 font-mono">
                        <li><span class="text-slate-400">Full Name:</span> Md. Abdullah Al Ahsan</li>
                        <li><span class="text-slate-400">Father's Name:</span> Md. Abdur Rahman</li>
                        <li><span class="text-slate-400">Date of Birth:</span> 06 August 1990</li>
                        <li><span class="text-slate-400">Nationality:</span> Bangladeshi</li>
                        <li><span class="text-slate-400">Religion:</span> Islam</li>
                        <li><span class="text-slate-400">Marital Status:</span> Married</li>
                    </ul>
                </div>

                <!-- Card 2: Contact & Location -->
                <div class="p-6 rounded-3xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-base text-slate-900 dark:text-white font-['Outfit']">Contact &amp; Location</h3>
                    <ul class="text-xs space-y-2 text-slate-600 dark:text-slate-300 font-mono">
                        <li><span class="text-slate-400">Present Address:</span> 53/20, Razbollovpur, Sherpur Town, Sherpur</li>
                        <li><span class="text-slate-400">Permanent Address:</span> 53/20, Razbollovpur, Sherpur Town, Sherpur</li>
                        <li><span class="text-slate-400">Direct Phone:</span> <a href="tel:{{ $settings['contact_phone'] ?? '+8801718926673' }}" class="hover:text-[var(--theme-primary)] text-slate-900 dark:text-white font-bold">{{ $settings['contact_phone'] ?? '+8801718926673' }}</a></li>
                        <li><span class="text-slate-400">Direct Email:</span> <a href="mailto:{{ $settings['contact_email'] ?? 'abdullahalahsan1990@gmail.com' }}" class="hover:text-[var(--theme-primary)] text-slate-900 dark:text-white font-bold break-all">{{ $settings['contact_email'] ?? 'abdullahalahsan1990@gmail.com' }}</a></li>
                    </ul>
                </div>

                <!-- Card 3: Professional Accreditation -->
                <div class="p-6 rounded-3xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm space-y-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-base text-slate-900 dark:text-white font-['Outfit']">Accreditation</h3>
                    <ul class="text-xs space-y-2 text-slate-600 dark:text-slate-300 font-mono">
                        <li><span class="text-emerald-400 font-bold">NSDA Level-3 Certified</span></li>
                        <li><span class="text-slate-400">Authority:</span> National Skills Development Authority (NSDA)</li>
                        <li><span class="text-slate-400">Standard:</span> Web Development (2025)</li>
                        <li><span class="text-slate-400">Professional Training:</span> Web Development with PHP &amp; Laravel (360 Hours)</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Work Experience & Academic Milestones -->
    <section class="py-16 sm:py-20 border-b border-slate-200 dark:border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <!-- Experience Column -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-[var(--theme-primary)]"></span>
                        <h3 class="text-2xl font-black font-['Outfit'] text-slate-900 dark:text-white uppercase tracking-tight">Work Experience</h3>
                    </div>

                    <div class="relative border-l-2 border-slate-200 dark:border-white/10 pl-6 space-y-8">
                        <!-- Devzet LLC -->
                        <div class="relative group">
                            <span class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full bg-[var(--theme-primary)] border-4 border-slate-50 dark:border-[#070b14]"></span>
                            <span class="text-[11px] font-mono text-[var(--theme-primary)] font-bold">2023 – PRESENT</span>
                            <h4 class="text-lg font-bold text-slate-900 dark:text-white font-['Outfit'] mt-1">Full-Stack Laravel Developer</h4>
                            <p class="text-xs font-mono text-cyan-600 dark:text-cyan-400">Devzet LLC</p>
                            <p class="text-xs text-slate-600 dark:text-slate-300 mt-2 leading-relaxed">
                                Lead engineer for enterprise backend modules, PDF invoice generation systems, high-speed API endpoints, and complex micro-database integrations.
                            </p>
                        </div>

                        <!-- Freelance IT Lab -->
                        <div class="relative group">
                            <span class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full bg-blue-500 border-4 border-slate-50 dark:border-[#070b14]"></span>
                            <span class="text-[11px] font-mono text-blue-500 font-bold">2020 – 2023</span>
                            <h4 class="text-lg font-bold text-slate-900 dark:text-white font-['Outfit'] mt-1">Web Application Developer</h4>
                            <p class="text-xs font-mono text-blue-600 dark:text-blue-400">Freelance IT Lab</p>
                            <p class="text-xs text-slate-600 dark:text-slate-300 mt-2 leading-relaxed">
                                Developed custom web applications, client billing portals, e-commerce stores, and database schemas with PHP, Laravel, MySQL, and Tailwind CSS.
                            </p>
                        </div>

                        <!-- Independent Consultant -->
                        <div class="relative group">
                            <span class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full bg-indigo-500 border-4 border-slate-50 dark:border-[#070b14]"></span>
                            <span class="text-[11px] font-mono text-indigo-500 font-bold">2018 – 2020</span>
                            <h4 class="text-lg font-bold text-slate-900 dark:text-white font-['Outfit'] mt-1">Independent Full-Stack Consultant</h4>
                            <p class="text-xs font-mono text-indigo-600 dark:text-indigo-400">Remote &amp; Contract</p>
                            <p class="text-xs text-slate-600 dark:text-slate-300 mt-2 leading-relaxed">
                                Consulted for diverse businesses building custom CRM integrations, automated reporting pipelines, and interactive web tools.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Education & Academic Foundation Column -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-indigo-500"></span>
                        <h3 class="text-2xl font-black font-['Outfit'] text-slate-900 dark:text-white uppercase tracking-tight">Academic Education</h3>
                    </div>

                    <div class="relative border-l-2 border-slate-200 dark:border-white/10 pl-6 space-y-8">
                        <!-- M.Sc -->
                        <div class="relative group">
                            <span class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full bg-indigo-500 border-4 border-slate-50 dark:border-[#070b14]"></span>
                            <span class="text-[11px] font-mono text-indigo-400 font-bold">MASTER OF SCIENCE (M.SC)</span>
                            <h4 class="text-lg font-bold text-slate-900 dark:text-white font-['Outfit'] mt-1">Mathematics</h4>
                            <p class="text-xs font-mono text-slate-500 dark:text-slate-400">Govt. Ashek Mahmud College (National University)</p>
                            <p class="text-xs text-slate-600 dark:text-slate-300 mt-2 leading-relaxed">
                                Advanced mathematical modeling, abstract algebra, numerical analysis, and complex problem-solving.
                            </p>
                        </div>

                        <!-- B.Sc -->
                        <div class="relative group">
                            <span class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full bg-cyan-500 border-4 border-slate-50 dark:border-[#070b14]"></span>
                            <span class="text-[11px] font-mono text-cyan-400 font-bold">BACHELOR OF SCIENCE (B.SC HONOURS)</span>
                            <h4 class="text-lg font-bold text-slate-900 dark:text-white font-['Outfit'] mt-1">Mathematics</h4>
                            <p class="text-xs font-mono text-slate-500 dark:text-slate-400">Govt. Ashek Mahmud College (National University)</p>
                            <p class="text-xs text-slate-600 dark:text-slate-300 mt-2 leading-relaxed">
                                Rigorous study of discrete mathematics, calculus, linear algebra, and mathematical logic.
                            </p>
                        </div>

                        <!-- HSC & SSC -->
                        <div class="relative group">
                            <span class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full bg-emerald-500 border-4 border-slate-50 dark:border-[#070b14]"></span>
                            <span class="text-[11px] font-mono text-emerald-400 font-bold">SECONDARY &amp; HIGHER SECONDARY</span>
                            <h4 class="text-lg font-bold text-slate-900 dark:text-white font-['Outfit'] mt-1">Science Group</h4>
                            <p class="text-xs font-mono text-slate-500 dark:text-slate-400">HSC: Sherpur Govt. College | SSC: Victoria Academy</p>
                            <p class="text-xs text-slate-600 dark:text-slate-300 mt-2 leading-relaxed">
                                Solid scientific foundation in physics, chemistry, and higher mathematics.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Technical Skills Matrix -->
    <section class="py-16 sm:py-20 border-b border-slate-200 dark:border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-mono font-bold text-[var(--theme-primary)] uppercase tracking-widest block mb-2">
                    // TECHNICAL COMPETENCY
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold font-['Outfit'] text-slate-900 dark:text-white uppercase tracking-tight">
                    Full-Stack Skill Matrix
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $skillSet = $skills ?? collect();
                @endphp
                @forelse($skillSet as $sk)
                    <div class="p-6 rounded-2xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm space-y-3 hover:border-[var(--theme-primary)]/50 transition-all">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-sm text-slate-900 dark:text-white font-['Outfit']">{{ $sk->name }}</span>
                            <span class="text-xs font-mono font-bold text-[var(--theme-primary)]">{{ $sk->percentage ?? 95 }}%</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-cyan-400 to-blue-600" style="width: {{ $sk->percentage ?? 95 }}%"></div>
                        </div>
                        <div class="flex items-center justify-between text-[11px] font-mono text-slate-500 dark:text-slate-400">
                            <span>{{ $sk->category ?? 'Backend Architecture' }}</span>
                            <span>{{ $sk->proficiency_level ?? 'Expert' }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8 text-slate-500 font-mono text-xs">
                        Skills loaded dynamically.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer Partial -->
    @include('frontend.themes.laravel_developer.partials.footer')

</div>
@endsection

