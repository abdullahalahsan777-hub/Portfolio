@extends('frontend.layouts.frontend')

@section('content')
<div class="uiux-page-wrapper bg-[#080808] text-[#ffffff] min-h-screen selection:bg-[#ccff00] selection:text-[#080808] relative font-['Plus_Jakarta_Sans']">

    <!-- Ambient Subtle Glows -->
    <div class="fixed top-0 left-1/3 w-[500px] h-[500px] bg-[#ccff00]/5 rounded-full blur-[160px] pointer-events-none -z-10"></div>
    <div class="fixed bottom-1/4 right-10 w-[450px] h-[450px] bg-emerald-500/5 rounded-full blur-[160px] pointer-events-none -z-10"></div>

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.uiux_designer.partials.header')


    <!-- =========================================================================
         2. HERO SECTION
         ========================================================================= -->
    <section id="hero" class="pt-16 pb-20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left Column (5 cols): Intro Copy & CTAs -->
                <div class="lg:col-span-5 space-y-6 z-10">
                    <span class="text-sm font-semibold tracking-wider text-neutral-400 block font-['Outfit']">Hello, I'm</span>
                    
                    <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-white font-['Outfit'] leading-[1.05]">
                        {{ $settings['hero_title'] ?? 'Roy C. Jones' }}<br>
                        <span class="text-neutral-400 font-extrabold text-3xl sm:text-5xl block mt-1">{{ $settings['hero_subtitle'] ?? 'UI/UX designer' }}</span>
                    </h1>

                    <p class="text-neutral-400 text-xs sm:text-sm leading-relaxed max-w-md">
                        {{ $settings['hero_description'] ?? 'I am a visual designer focusing on digital experiences, brand identity, user interfaces, wireframing, and interactive design systems.' }}
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="{{ $settings['hero_cta_url'] ?? '#contact' }}" class="uiux-btn-primary">
                            <span>{{ $settings['hero_cta_text'] ?? 'Hire Me' }}</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                        <a href="{{ $settings['hero_cta2_url'] ?? '#projects' }}" class="uiux-btn-outline">
                            <span>{{ $settings['hero_cta2_text'] ?? 'My Portfolio' }}</span>
                        </a>
                    </div>
                </div>

                <!-- Center Column (4 cols): Split Circle Backdrop & Pointing Designer Cutout -->
                <div class="lg:col-span-4 relative flex items-center justify-center min-h-[380px] sm:min-h-[440px]">
                    <!-- The iconic Split Circle (Half Black, Half Lime as seen in the uploaded design) -->
                    <div class="uiux-split-circle"></div>

                    <!-- Cutout Photo of Designer Pointing in Olive Tee -->
                    <div class="relative z-10 w-full max-w-[340px] aspect-[4/5] flex items-end justify-center">
                        <img
                            src="{{ !empty($settings['hero_image']) ? asset($settings['hero_image']) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=700&q=85' }}"
                            alt="{{ $settings['hero_title'] ?? 'Roy C. Jones' }}"
                            class="w-full h-full object-cover object-top filter brightness-105 contrast-105"
                        >
                    </div>
                </div>

                <!-- Right Column (3 cols): Clean Metrics Badges -->
                <div class="lg:col-span-3 space-y-6 z-10 lg:pl-6 border-l lg:border-white/10 pt-6 lg:pt-0">
                    <div>
                        <div class="flex items-baseline gap-1">
                            <span class="text-4xl sm:text-5xl font-black text-white font-['Outfit']" data-counter-target="{{ $settings['experience_years'] ?? 12 }}" data-counter-suffix="+">{{ $settings['experience_years'] ?? '12' }}+</span>
                        </div>
                        <span class="text-xs font-semibold text-neutral-400 block mt-1">{{ $settings['counter1_title'] ?? 'Years Experience' }}</span>
                    </div>

                    <div class="pt-4 border-t border-white/10">
                        <div class="flex items-baseline gap-1">
                            <span class="text-4xl sm:text-5xl font-black text-white font-['Outfit']" data-counter-target="{{ $settings['completed_projects'] ?? 150 }}" data-counter-suffix="+">{{ $settings['completed_projects'] ?? '150' }}+</span>
                        </div>
                        <span class="text-xs font-semibold text-neutral-400 block mt-1">{{ $settings['counter2_title'] ?? 'Project Completed' }}</span>
                    </div>

                    <div class="pt-4 border-t border-white/10">
                        <div class="flex items-baseline gap-1">
                            <span class="text-4xl sm:text-5xl font-black text-white font-['Outfit']" data-counter-target="{{ $settings['satisfied_clients'] ?? 100 }}" data-counter-suffix="+">{{ $settings['satisfied_clients'] ?? '100' }}+</span>
                        </div>
                        <span class="text-xs font-semibold text-neutral-400 block mt-1">{{ $settings['counter3_title'] ?? 'Happy Clients' }}</span>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- =========================================================================
         3. ABOUT ME SECTION
         ========================================================================= -->
    <section id="about" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left 7 cols: Copy -->
                <div class="lg:col-span-7 space-y-6">
                    <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block">About Me</span>
                    
                    <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-['Outfit'] leading-tight">
                        {{ $settings['about_heading'] ?? 'Professional Problem Solutions For Digital Products' }}
                    </h2>

                    <p class="text-neutral-400 text-xs sm:text-sm leading-relaxed max-w-xl">
                        {{ $settings['about_description'] ?? 'I specialize in deciphering complicated digital ecosystems into frictionless, high-converting product journeys. With a strong foundation in user research, wireframing, and component-based design architecture, I build interfaces that people love to use every day.' }}
                    </p>

                    <!-- Feature checkmarks (Matches uploaded design) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="uiux-about-check-item flex items-center gap-3 p-3 rounded-xl bg-[#121212] border border-white/5">
                            <span class="w-6 h-6 rounded-full bg-[#ccff00] text-[#080808] flex items-center justify-center font-bold text-xs shrink-0">✓</span>
                            <span class="uiux-check-text text-xs font-semibold text-neutral-200">User Research &amp; Personas</span>
                        </div>
                        <div class="uiux-about-check-item flex items-center gap-3 p-3 rounded-xl bg-[#121212] border border-white/5">
                            <span class="w-6 h-6 rounded-full bg-[#ccff00] text-[#080808] flex items-center justify-center font-bold text-xs shrink-0">✓</span>
                            <span class="uiux-check-text text-xs font-semibold text-neutral-200">Figma Design Systems</span>
                        </div>
                        <div class="uiux-about-check-item flex items-center gap-3 p-3 rounded-xl bg-[#121212] border border-white/5">
                            <span class="w-6 h-6 rounded-full bg-[#ccff00] text-[#080808] flex items-center justify-center font-bold text-xs shrink-0">✓</span>
                            <span class="uiux-check-text text-xs font-semibold text-neutral-200">Wireframing &amp; Prototyping</span>
                        </div>
                        <div class="uiux-about-check-item flex items-center gap-3 p-3 rounded-xl bg-[#121212] border border-white/5">
                            <span class="w-6 h-6 rounded-full bg-[#ccff00] text-[#080808] flex items-center justify-center font-bold text-xs shrink-0">✓</span>
                            <span class="uiux-check-text text-xs font-semibold text-neutral-200">High-Conversion UX Audits</span>
                        </div>
                    </div>
                </div>

                <!-- Right 5 cols: Portrait Card with Availability Pill -->
                <div class="lg:col-span-5 relative flex justify-center">
                    <div class="w-full max-w-md rounded-3xl overflow-hidden border border-white/10 bg-[#121212] relative group shadow-2xl">
                        <img
                            src="{{ !empty($settings['about_image']) ? asset($settings['about_image']) : (!empty($settings['hero_image']) ? asset($settings['hero_image']) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=700&q=80') }}"
                            alt="{{ $settings['hero_title'] ?? 'Professional Designer' }}"
                            class="w-full aspect-[4/5] object-cover group-hover:scale-105 transition-transform duration-500"
                        >
                        <!-- Floating Pill Badge (Matches screenshot: Available for project) -->
                        <div class="absolute bottom-6 left-6 right-6 p-4 rounded-2xl bg-black/80 backdrop-blur-md border border-white/15 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#ccff00] animate-ping"></span>
                                <div>
                                    <span class="text-xs font-bold text-white block">Available for project</span>
                                    <span class="text-[10px] font-mono text-neutral-400">Accepting Q4 & Q1 clients</span>
                                </div>
                            </div>
                            <span class="text-xs font-mono font-bold text-[#ccff00]">4.9 ★★★★★</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- =========================================================================
         4. PROBLEM SOLUTIONS EXPERIENCE (METRICS & MILESTONES)
         ========================================================================= -->
    <section class="py-20 bg-[#0c0c0c] relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left 5 cols: 4-Petal Badge / Heading -->
                <div class="lg:col-span-5 flex items-center gap-6">
                    <!-- Radiating 4-Petal Icon Badge (Matches screenshot) -->
                    <div class="w-20 h-20 rounded-full bg-[#171717] border border-white/10 flex items-center justify-center shrink-0 shadow-lg">
                        <svg class="w-10 h-10 text-[#ccff00]" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C12 7.5 7.5 12 2 12C7.5 12 12 16.5 12 22C12 16.5 16.5 12 22 12C16.5 12 12 7.5 12 2Z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block mb-1">Milestones</span>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-white font-['Outfit'] leading-snug">
                            Best <span class="text-[#ccff00]">Problem Solutions</span> Experience
                        </h3>
                    </div>
                </div>

                <!-- Right 7 cols: 4 Stats Columns Grid -->
                <div class="lg:col-span-7 grid grid-cols-2 sm:grid-cols-4 gap-6">
                    <div class="p-4 rounded-2xl bg-[#121212] border border-white/5">
                        <span class="text-2xl sm:text-3xl font-black text-white block font-['Outfit']" data-counter-target="{{ $settings['experience_years'] ?? 12 }}" data-counter-suffix="+">{{ $settings['experience_years'] ?? '12' }}+</span>
                        <span class="text-[11px] font-semibold text-neutral-400 uppercase mt-1 block">Years In Field</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-[#121212] border border-white/5">
                        <span class="text-2xl sm:text-3xl font-black text-white block font-['Outfit']" data-counter-target="{{ $settings['completed_projects'] ?? 250 }}" data-counter-suffix="+">{{ $settings['completed_projects'] ?? '250' }}+</span>
                        <span class="text-[11px] font-semibold text-neutral-400 uppercase mt-1 block">Active Projects</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-[#121212] border border-white/5">
                        <span class="text-2xl sm:text-3xl font-black text-[#ccff00] block font-['Outfit']" data-counter-target="99" data-counter-suffix="%">99%</span>
                        <span class="text-[11px] font-semibold text-neutral-400 uppercase mt-1 block">Satisfaction</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-[#121212] border border-white/5">
                        <span class="text-2xl sm:text-3xl font-black text-white block font-['Outfit']" data-counter-target="{{ $settings['awards_count'] ?? 18 }}" data-counter-suffix="+">{{ $settings['awards_count'] ?? '18' }}+</span>
                        <span class="text-[11px] font-semibold text-neutral-400 uppercase mt-1 block">Awards Won</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- =========================================================================
         5. MY SPECIAL SERVICE FOR YOU (01 to 06)
         ========================================================================= -->
    <section id="services" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block mb-2">Services For you</span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-['Outfit'] tracking-tight">
                    My Special <span class="text-[#ccff00]">Service For you</span>
                </h2>
                <p class="text-neutral-400 text-xs sm:text-sm mt-3">Comprehensive UI/UX and product design services tailored for modern digital ecosystems.</p>
            </div>

            <!-- 6 Services Grid (2 Columns x 3 Rows) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($services as $index => $service)
                    <div class="uiux-service-card flex items-start justify-between gap-6 group cursor-pointer">
                        <div class="space-y-3">
                            <span class="text-xs font-mono font-bold text-[#ccff00]">{{ sprintf('%02d', $index + 1) }}.</span>
                            <h3 class="text-xl font-bold text-white font-['Outfit'] group-hover:text-[#ccff00] transition-colors">{{ $service->title }}</h3>
                            <p class="text-xs text-neutral-400 leading-relaxed">{{ $service->description }}</p>
                        </div>
                        <a href="{{ $service->link ?? '#contact' }}" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 group-hover:bg-[#ccff00] group-hover:border-[#ccff00] flex items-center justify-center text-neutral-300 group-hover:text-[#080808] transition-all shrink-0 uiux-arrow-btn">
                            <svg class="w-4 h-4 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 17L17 7M17 7H7M17 7V17"/>
                            </svg>
                        </a>
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
         6. POPULAR TOOLS & SOFTWARE (SKILLS)
         ========================================================================= -->
    <section id="tools" class="py-24 bg-[#0a0a0a] relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left 5 cols: Copy & CTA -->
                <div class="lg:col-span-5 space-y-6">
                    <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block">Tools</span>
                    
                    <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-['Outfit'] leading-tight">
                        Let's Explore Popular <span class="text-[#ccff00]">Tools & Software</span>
                    </h2>

                    <p class="text-neutral-400 text-xs sm:text-sm leading-relaxed max-w-md">
                        The industry-standard toolchain I leverage to translate ambiguous user challenges into intuitive, tested, and production-ready digital products.
                    </p>

                    <div class="pt-2">
                        <a href="#projects" class="uiux-btn-primary">
                            <span>Explore All Tools</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right 7 cols: Tool Badges Grid (3 in a row with 3 rows = 9 cards) -->
                <div class="lg:col-span-7 grid grid-cols-2 sm:grid-cols-3 gap-3.5 sm:gap-4">
                    @forelse($skills as $skill)
                        @php
                            $sName = strtolower($skill->name);
                        @endphp
                        <div class="uiux-tool-card group w-full min-w-0 overflow-hidden">
                            <div class="w-12 h-12 rounded-2xl bg-[#171717] border border-white/5 flex items-center justify-center text-[#ccff00] group-hover:scale-110 group-hover:border-[#ccff00]/40 transition-all duration-300 mb-2.5 shrink-0 shadow-inner">
                                @if(!empty($skill->icon) && (str_contains($skill->icon, '<svg') || str_starts_with($skill->icon, '<i') || str_starts_with($skill->icon, 'http') || str_starts_with($skill->icon, '/')))
                                    @if(str_contains($skill->icon, '<svg') || str_starts_with($skill->icon, '<i'))
                                        {!! $skill->icon !!}
                                    @else
                                        <img src="{{ $skill->icon }}" alt="{{ $skill->name }}" class="w-7 h-7 object-contain">
                                    @endif
                                @elseif(str_contains($sName, 'figma') || str_contains($sName, 'figjam'))
                                    <!-- Figma Brand SVG -->
                                    <svg class="w-6 h-6" viewBox="0 0 38 57" fill="none">
                                        <path d="M19 28.5C19 23.2533 23.2533 19 28.5 19C33.7467 19 38 23.2533 38 28.5C38 33.7467 33.7467 38 28.5 38C23.2533 38 19 33.7467 19 28.5Z" fill="#1ABCFE"/>
                                        <path d="M0 47.5C0 42.2533 4.25329 38 9.5 38H19V47.5C19 52.7467 14.7467 57 9.5 57C4.25329 57 0 52.7467 0 47.5Z" fill="#0ACF83"/>
                                        <path d="M19 0V19H28.5C33.7467 19 38 14.7467 38 9.5C38 4.25329 33.7467 0 28.5 0H19Z" fill="#FF7262"/>
                                        <path d="M0 9.5C0 14.7467 4.25329 19 9.5 19H19V0H9.5C4.25329 0 0 4.25329 0 9.5Z" fill="#F24E1E"/>
                                        <path d="M0 28.5C0 33.7467 4.25329 38 9.5 38H19V19H9.5C4.25329 19 0 23.2533 0 28.5Z" fill="#A259FF"/>
                                    </svg>
                                @elseif(str_contains($sName, 'illustrator'))
                                    <!-- Adobe Illustrator Brand SVG -->
                                    <svg class="w-6 h-6" viewBox="0 0 24 24">
                                        <rect width="24" height="24" rx="5" fill="#330000"/>
                                        <text x="12" y="16" font-family="'Outfit', sans-serif" font-weight="900" font-size="11" fill="#FF9A00" text-anchor="middle">Ai</text>
                                    </svg>
                                @elseif(str_contains($sName, 'photoshop'))
                                    <!-- Adobe Photoshop Brand SVG -->
                                    <svg class="w-6 h-6" viewBox="0 0 24 24">
                                        <rect width="24" height="24" rx="5" fill="#001E36"/>
                                        <text x="12" y="16" font-family="'Outfit', sans-serif" font-weight="900" font-size="11" fill="#31A8FF" text-anchor="middle">Ps</text>
                                    </svg>
                                @elseif(str_contains($sName, 'laravel') || str_contains($sName, 'php'))
                                    <!-- Laravel Brand SVG -->
                                    <svg class="w-6 h-6 fill-[#FF2D20]" viewBox="0 0 24 24">
                                        <path d="M23.642 5.373a.747.747 0 0 0-.372-.647L13.882.164a.754.754 0 0 0-.745 0L3.75 5.568a.746.746 0 0 0-.373.647v10.8a.75.75 0 0 0 .373.648l9.387 5.405a.748.748 0 0 0 .745 0l9.387-5.405a.747.747 0 0 0 .373-.648V5.373zM13.51 1.74l7.986 4.6-3.328 1.916-7.986-4.6 3.328-1.916zm-1.02.588v7.868l-3.328-1.916V2.328l3.328-1.916zm-4.348 2.502v5.952l-3.328-1.916V4.83l3.328-1.916zm-3.328 8.454 3.328 1.916v5.952l-3.328-1.916v-5.952zm4.348 2.502 3.328 1.916v7.868l-3.328-1.916v-7.868zm12.334-1.914-3.328 1.916-7.986-4.6 3.328-1.916 7.986 4.6z"/>
                                    </svg>
                                @elseif(str_contains($sName, 'flutter') || str_contains($sName, 'dart'))
                                    <!-- Flutter Brand SVG -->
                                    <svg class="w-6 h-6 fill-[#02569B]" viewBox="0 0 24 24">
                                        <path d="M14.314 0L2.3 12 6 15.7 21.684.013h-7.37zM6.015 15.69l3.684 3.685 4.615-4.615-3.685-3.685L6.015 15.69zm8.3 8.31h7.37l-6.84-6.84-3.685 3.684 3.155 3.156z"/>
                                    </svg>
                                @elseif(str_contains($sName, 'wordpress') || str_contains($sName, 'woocommerce'))
                                    <!-- WordPress Brand SVG -->
                                    <svg class="w-6 h-6 fill-[#21759B]" viewBox="0 0 24 24">
                                        <path d="M12 0C5.373 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387L3.652 10.82a9.55 9.55 0 0 1 8.348-5.32c1.986 0 3.82.604 5.334 1.637L12 0zm0 24c-.958 0-1.888-.112-2.783-.324l4.577-13.31 4.673 12.796A11.954 11.954 0 0 1 12 24zm9.324-7.464c.433-1.373.676-2.836.676-4.536 0-2.39-.817-4.593-2.186-6.347l4.475 12.302c-.894.498-1.887.892-2.965 1.171zM1.026 12c0 1.93.513 3.738 1.41 5.314l5.632-15.42A11.947 11.947 0 0 0 1.026 12z"/>
                                    </svg>
                                @elseif(str_contains($sName, 'react') || str_contains($sName, 'native'))
                                    <!-- React Brand SVG -->
                                    <svg class="w-6 h-6 fill-[#61DAFB]" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="2.5"/>
                                        <ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(30 12 12)" fill="none" stroke="#61DAFB" stroke-width="1.5"/>
                                        <ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(90 12 12)" fill="none" stroke="#61DAFB" stroke-width="1.5"/>
                                        <ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(150 12 12)" fill="none" stroke="#61DAFB" stroke-width="1.5"/>
                                    </svg>
                                @elseif(str_contains($sName, 'typography') || str_contains($sName, 'brand'))
                                    <!-- Typography & Brand SVG -->
                                    <svg class="w-6 h-6 text-[#ccff00]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="4 7 4 4 20 4 20 7"></polyline>
                                        <line x1="9" y1="20" x2="15" y2="20"></line>
                                        <line x1="12" y1="4" x2="12" y2="20"></line>
                                    </svg>
                                @elseif(str_contains($sName, 'research') || str_contains($sName, 'wirefram') || str_contains($sName, 'ux'))
                                    <!-- User Research & Wireframe SVG -->
                                    <svg class="w-6 h-6 text-[#ccff00]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="3" ry="3"></rect>
                                        <line x1="3" y1="9" x2="21" y2="9"></line>
                                        <line x1="9" y1="21" x2="9" y2="9"></line>
                                    </svg>
                                @elseif(str_contains($sName, 'system') || str_contains($sName, 'atomic'))
                                    <!-- Design Systems SVG -->
                                    <svg class="w-6 h-6 text-[#ccff00]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                        <polyline points="2 17 12 22 22 17"></polyline>
                                        <polyline points="2 12 12 17 22 12"></polyline>
                                    </svg>
                                @elseif(str_contains($sName, 'test') || str_contains($sName, 'analytic'))
                                    <!-- Usability Analytics SVG -->
                                    <svg class="w-6 h-6 text-[#ccff00]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="20" x2="18" y2="10"></line>
                                        <line x1="12" y1="20" x2="12" y2="4"></line>
                                        <line x1="6" y1="20" x2="6" y2="14"></line>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-[#ccff00]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                    </svg>
                                @endif
                            </div>
                            <span class="text-xs font-bold text-white block w-full text-center leading-snug break-words line-clamp-2 px-1 min-h-[2.25rem] flex items-center justify-center" title="{{ $skill->name }}">{{ $skill->name }}</span>
                            <span class="text-[11px] font-mono font-bold text-[#ccff00] mt-1">{{ $skill->percentage ?? 90 }}%</span>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8 text-neutral-500">
                            <p class="text-xs">No skills configured yet. Add them in the Admin Panel.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </section>


    <!-- =========================================================================
         7. EXPLORE MY POPULAR PROJECTS (ALTERNATING ZIGZAG CARDS)
         ========================================================================= -->
    <section id="projects" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block mb-2">My Portfolio</span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-['Outfit'] tracking-tight">
                    Explore My <span class="text-[#ccff00]">Popular Projects</span>
                </h2>
                <p class="text-neutral-400 text-xs sm:text-sm mt-3">Selected case studies combining rigorous research, wireframing, and polished interaction design.</p>
            </div>

            <!-- Alternating Projects List -->
            <div class="space-y-12">
                @forelse($projects as $index => $proj)
                    @php
                        $isEven = $index % 2 === 1;
                        $projImg = !empty($proj->image) ? (str_starts_with($proj->image, 'http') ? $proj->image : asset($proj->image)) : 'https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=700&q=80';
                    @endphp
                    <div class="uiux-project-item p-6 sm:p-10 grid grid-cols-1 md:grid-cols-12 gap-8 items-center group">
                        @if($isEven)
                            <div class="md:col-span-6 space-y-4 md:pr-6 order-2 md:order-1">
                                <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block">{{ $proj->category ?? 'UI/UX Design' }}</span>
                                <h3 class="text-2xl sm:text-3xl font-extrabold text-white font-['Outfit'] group-hover:text-[#ccff00] transition-colors">
                                    {{ $proj->title }}
                                </h3>
                                <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed">
                                    {{ $proj->description }}
                                </p>
                                <div class="pt-2">
                                    <a href="{{ $proj->link ?? '#contact' }}" class="inline-flex items-center gap-2 text-xs font-bold text-white hover:text-[#ccff00] transition-colors">
                                        <span>View Case Study</span>
                                        <span class="w-7 h-7 rounded-full bg-white/10 flex items-center justify-center text-xs">↗</span>
                                    </a>
                                </div>
                            </div>
                            <div class="md:col-span-6 rounded-2xl overflow-hidden bg-[#181818] p-8 flex items-center justify-center order-1 md:order-2">
                                <img
                                    src="{{ $projImg }}"
                                    alt="{{ $proj->title }}"
                                    class="w-full max-h-[340px] object-cover rounded-xl shadow-2xl transition-transform duration-500 uiux-mockup-img"
                                >
                            </div>
                        @else
                            <div class="md:col-span-6 rounded-2xl overflow-hidden bg-[#181818] p-8 flex items-center justify-center">
                                <img
                                    src="{{ $projImg }}"
                                    alt="{{ $proj->title }}"
                                    class="w-full max-h-[340px] object-cover rounded-xl shadow-2xl transition-transform duration-500 uiux-mockup-img"
                                >
                            </div>
                            <div class="md:col-span-6 space-y-4 md:pl-6">
                                <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block">{{ $proj->category ?? 'UI/UX Design' }}</span>
                                <h3 class="text-2xl sm:text-3xl font-extrabold text-white font-['Outfit'] group-hover:text-[#ccff00] transition-colors">
                                    {{ $proj->title }}
                                </h3>
                                <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed">
                                    {{ $proj->description }}
                                </p>
                                <div class="pt-2">
                                    <a href="{{ $proj->link ?? '#contact' }}" class="inline-flex items-center gap-2 text-xs font-bold text-white hover:text-[#ccff00] transition-colors">
                                        <span>View Case Study</span>
                                        <span class="w-7 h-7 rounded-full bg-white/10 flex items-center justify-center text-xs">↗</span>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-16 text-neutral-500">
                        <p class="text-sm">No projects published yet. Add projects in the Admin Panel.</p>
                    </div>
                @endforelse
            </div>

            <!-- View All Projects Button -->
            <div class="mt-14 text-center">
                <a href="#contact" class="uiux-btn-primary">
                    <span>View All Projects</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

        </div>
    </section>


    <!-- =========================================================================
         8. SEE WHAT CLIENTS FEEDBACK (TESTIMONIALS)
         ========================================================================= -->
    <section class="py-24 bg-[#0a0a0a] relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block mb-2">Testimonials</span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-['Outfit'] tracking-tight">
                    See What <span class="text-[#ccff00]">Clients Feedback!</span>
                </h2>
                <p class="text-neutral-400 text-xs sm:text-sm mt-3">Hear what product executives and founders say about our collaborative partnership.</p>
            </div>

            @php
                $allTestimonials = $testimonials->count() > 0 ? $testimonials : collect([
                    (object)[
                        'content' => 'Alex turned our fragmented product into an intuitive, high-converting design system. Our user satisfaction score skyrocketed by 40%.',
                        'name' => 'Rosalie D. Graham',
                        'role' => 'CEO & Founder',
                        'company' => 'Nox Digital',
                        'rating' => 5,
                        'avatar' => null
                    ],
                    (object)[
                        'content' => 'Exceptional attention to micro-interactions and usability testing. The prototype passed stakeholder sign-off on the first presentation.',
                        'name' => 'Kenneth C. Burton',
                        'role' => 'Lead Product Designer',
                        'company' => 'Creative Minds',
                        'rating' => 5,
                        'avatar' => null
                    ],
                    (object)[
                        'content' => 'The mobile design patterns and tokenized component architecture allowed our engineering team to ship twice as fast.',
                        'name' => 'Sophia Chen',
                        'role' => 'VP of Product',
                        'company' => 'Kinetix Software',
                        'rating' => 5,
                        'avatar' => null
                    ],
                    (object)[
                        'content' => 'A master of aesthetic minimalism and user clarity. Working with Alex was the highlight of our company rebrand.',
                        'name' => 'Marcus Vance',
                        'role' => 'Founder',
                        'company' => 'Aura Studio',
                        'rating' => 5,
                        'avatar' => null
                    ],
                ]);

                if ($allTestimonials->count() < 4) {
                    $allTestimonials = $allTestimonials->concat($allTestimonials);
                }
            @endphp

            <!-- Testimonial Slider: 2 items in one row on desktop, 1 on mobile, auto-slide 1 item every 5s -->
            <div class="testimonials-slider-container relative overflow-hidden" data-autoplay="5000">
                <div class="testimonials-slider-track flex transition-transform duration-700 ease-out -mx-3">
                    @foreach($allTestimonials as $testimony)
                        <div class="testimonials-slide w-full md:w-1/2 flex-shrink-0 px-3">
                            <div class="p-8 rounded-3xl bg-[#111111] border border-white/10 flex flex-col justify-between space-y-6 shadow-xl h-full">
                                <div>
                                    <div class="flex items-center gap-1 text-[#ccff00] text-sm mb-4">
                                        @for($s = 0; $s < ($testimony->rating ?? 5); $s++)
                                            ★
                                        @endfor
                                    </div>
                                    <p class="text-neutral-300 text-xs sm:text-sm leading-relaxed">
                                        "{{ $testimony->content }}"
                                    </p>
                                </div>
                                <div class="flex items-center gap-4 pt-4 border-t border-white/10">
                                    @if(!empty($testimony->avatar))
                                        <img
                                            src="{{ str_starts_with($testimony->avatar, 'http') ? $testimony->avatar : asset($testimony->avatar) }}"
                                            alt="{{ $testimony->name ?? $testimony->client_name }}"
                                            class="w-11 h-11 rounded-full object-cover border-2 border-[#ccff00]"
                                        >
                                    @else
                                        <div class="w-11 h-11 rounded-full bg-neutral-800 border-2 border-[#ccff00] flex items-center justify-center text-white font-bold text-sm">
                                            {{ substr($testimony->name ?? $testimony->client_name ?? 'C', 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="text-sm font-bold text-white font-['Outfit']">{{ $testimony->name ?? $testimony->client_name }}</h4>
                                        <span class="text-[11px] text-neutral-400">{{ $testimony->role ?? $testimony->client_role ?? 'Client' }}{{ !empty($testimony->company) ? ', ' . $testimony->company : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Slider Controls: Prev/Next & Dots -->
                <div class="flex items-center justify-center gap-6 mt-10">
                    <button type="button" class="testimonials-prev-btn w-10 h-10 rounded-full bg-white/5 hover:bg-[#ccff00] hover:text-black border border-white/10 text-white flex items-center justify-center transition-all cursor-pointer shadow-md" aria-label="Previous testimonial">
                        &#8592;
                    </button>
                    <div class="testimonials-dots flex items-center gap-2 text-[#ccff00]"></div>
                    <button type="button" class="testimonials-next-btn w-10 h-10 rounded-full bg-white/5 hover:bg-[#ccff00] hover:text-black border border-white/10 text-white flex items-center justify-center transition-all cursor-pointer shadow-md" aria-label="Next testimonial">
                        &#8594;
                    </button>
                </div>
            </div>

        </div>
    </section>


    <!-- =========================================================================
         9. AMAZING PRICING FOR YOUR PROJECTS
         ========================================================================= -->
    <section id="pricing" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block mb-2">Pricing Plans</span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-['Outfit'] tracking-tight">
                    Amazing <span class="text-[#ccff00]">Pricing For your Projects</span>
                </h2>
                <p class="text-neutral-400 text-xs sm:text-sm mt-3">Transparent project-based pricing tailored to launch or scale your application.</p>
            </div>

            <!-- 3 Pricing Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                @forelse($pricingPlans as $plan)
                    @php
                        $features = is_array($plan->features) ? $plan->features : (json_decode($plan->features, true) ?? array_filter(array_map('trim', explode("\n", $plan->features ?? ''))));
                        $isFeatured = $plan->is_popular || $loop->iteration === 2;
                    @endphp
                    <div class="uiux-pricing-card {{ $isFeatured ? 'featured' : '' }}">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold {{ $isFeatured ? 'text-[#ccff00]' : 'text-white' }} font-['Outfit']">{{ $plan->name }}</h3>
                                @if($isFeatured)
                                    <span class="text-[10px] font-mono px-2 py-0.5 rounded-full bg-[#ccff00] text-[#080808] font-bold">POPULAR</span>
                                @elseif(!empty($plan->billing_period))
                                    <span class="text-[10px] font-mono px-2 py-0.5 rounded-full bg-white/10 text-neutral-300">{{ ucfirst($plan->billing_period) }}</span>
                                @endif
                            </div>
                            <div class="mb-6">
                                <span class="text-4xl font-extrabold text-[#ccff00] font-['Outfit']">{{ $plan->price ? ('$' . number_format($plan->price, 2)) : 'Custom' }}</span>
                                <span class="text-xs text-neutral-400 font-mono">/ {{ $plan->billing_period ?? 'project' }}</span>
                            </div>
                            @if(!empty($features))
                                <ul class="space-y-3 text-xs {{ $isFeatured ? 'text-neutral-200' : 'text-neutral-300' }} pt-4 border-t border-white/10">
                                    @foreach($features as $feature)
                                        <li class="flex items-center gap-2.5">
                                            <span class="text-[#ccff00] font-bold">✓</span> {{ $feature }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="pt-8">
                            <a href="{{ $plan->button_url ?? '#contact' }}" class="{{ $isFeatured ? 'uiux-btn-primary' : 'uiux-btn-outline' }} w-full justify-center">
                                {{ $plan->button_text ?? 'Choose Plan' }}
                            </a>
                        </div>
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
         10. LET'S TALK FOR YOUR NEXT PROJECT (CONTACT SECTION)
         ========================================================================= -->
    <section id="contact" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Left 5 cols: Contact Info -->
                <div class="lg:col-span-5 space-y-8">
                    <div>
                        <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block mb-2">Get In Touch</span>
                        <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-['Outfit'] leading-tight">
                            Let's Talk For your <span class="text-[#ccff00]">Next Project</span>
                        </h2>
                        <p class="text-neutral-400 text-xs sm:text-sm mt-3 leading-relaxed">
                            Have a fresh concept or an existing SaaS application that needs UX leadership? Reach out today and let's craft something remarkable.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-[#111111] border border-white/5">
                            <span class="w-10 h-10 rounded-xl bg-[#ccff00] text-[#080808] flex items-center justify-center font-bold text-sm">✉</span>
                            <div>
                                <span class="text-[10px] font-mono text-neutral-400 block">Direct Email</span>
                                <a href="mailto:{{ $settings['contact_email'] ?? 'roy.jones@designstudio.me' }}" class="text-sm font-bold text-white hover:text-[#ccff00] transition-colors">
                                    {{ $settings['contact_email'] ?? 'roy.jones@designstudio.me' }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-[#111111] border border-white/5">
                            <span class="w-10 h-10 rounded-xl bg-[#ccff00] text-[#080808] flex items-center justify-center font-bold text-sm">☎</span>
                            <div>
                                <span class="text-[10px] font-mono text-neutral-400 block">Phone</span>
                                <a href="tel:{{ $settings['contact_phone'] ?? '+15558392019' }}" class="text-sm font-bold text-white hover:text-[#ccff00] transition-colors">
                                    {{ $settings['contact_phone'] ?? '+1 (555) 839-2019' }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-[#111111] border border-white/5">
                            <span class="w-10 h-10 rounded-xl bg-[#ccff00] text-[#080808] flex items-center justify-center font-bold text-sm">⌖</span>
                            <div>
                                <span class="text-[10px] font-mono text-neutral-400 block">Location</span>
                                <span class="text-sm font-bold text-white">{!! $settings['contact_location'] ?? 'San Francisco, CA &bull; Available Worldwide' !!}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right 7 cols: Contact Form -->
                <div class="lg:col-span-7">
                    <div class="p-8 sm:p-10 rounded-3xl bg-[#111111] border border-white/10 shadow-2xl">
                        
                        <div id="contactFeedback" class="hidden mb-6"></div>

                        <form id="contactForm" action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                            @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-mono text-neutral-400 mb-1.5 font-semibold">Your Name *</label>
                                    <input
                                        type="text"
                                        name="name"
                                        required
                                        placeholder="Roy Jones"
                                        class="w-full px-4 py-3 rounded-xl bg-black/50 border border-white/10 text-white placeholder-neutral-600 text-sm focus:outline-none focus:border-[#ccff00] transition-colors"
                                    >
                                </div>
                                <div>
                                    <label class="block text-xs font-mono text-neutral-400 mb-1.5 font-semibold">Your Email *</label>
                                    <input
                                        type="email"
                                        name="email"
                                        required
                                        placeholder="roy@company.com"
                                        class="w-full px-4 py-3 rounded-xl bg-black/50 border border-white/10 text-white placeholder-neutral-600 text-sm focus:outline-none focus:border-[#ccff00] transition-colors"
                                    >
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-mono text-neutral-400 mb-1.5 font-semibold">Phone Number</label>
                                    <input
                                        type="text"
                                        name="phone"
                                        placeholder="+1 (555) 000-0000"
                                        class="w-full px-4 py-3 rounded-xl bg-black/50 border border-white/10 text-white placeholder-neutral-600 text-sm focus:outline-none focus:border-[#ccff00] transition-colors"
                                    >
                                </div>
                                <div>
                                    <label class="block text-xs font-mono text-neutral-400 mb-1.5 font-semibold">Service Type</label>
                                    <select
                                        name="service_type"
                                        class="w-full px-4 py-3 rounded-xl bg-black/50 border border-white/10 text-white text-sm focus:outline-none focus:border-[#ccff00] transition-colors"
                                    >
                                        <option value="User Interface Design" class="bg-[#111111]">User Interface Design</option>
                                        <option value="Design System & Tokens" class="bg-[#111111]">Design System & Tokens</option>
                                        <option value="Mobile App Experience" class="bg-[#111111]">Mobile App Experience</option>
                                        <option value="Usability Testing" class="bg-[#111111]">Usability Testing</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-mono text-neutral-400 mb-1.5 font-semibold">Your Message *</label>
                                <textarea
                                    name="message"
                                    required
                                    rows="4"
                                    placeholder="Write your project details or vision here..."
                                    class="w-full px-4 py-3 rounded-xl bg-black/50 border border-white/10 text-white placeholder-neutral-600 text-sm focus:outline-none focus:border-[#ccff00] transition-colors resize-none"
                                ></textarea>
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="uiux-btn-primary w-full justify-center py-3.5 text-sm">
                                    <span>Send Message</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- =========================================================================
         11. LATEST NEWS & BLOG
         ========================================================================= -->
    <section id="blog" class="py-24 bg-[#0a0a0a] relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block mb-2">From the Blog</span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-['Outfit'] tracking-tight">
                    Latest News & <span class="text-[#ccff00]">Blog</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse(is_array($blogPosts) ? array_slice($blogPosts, 0, 2) : $blogPosts->take(2) as $post)
                    <article class="p-5 rounded-3xl bg-[#111111] border border-white/10 hover:border-[#ccff00]/40 transition-all group">
                        <div class="aspect-[16/9] rounded-2xl overflow-hidden bg-black/40 mb-5 relative">
                            <img
                                src="{{ $post['image'] ?? 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=700&q=80' }}"
                                alt="{{ $post['title'] ?? 'Blog' }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                            <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-[10px] font-mono font-bold bg-[#ccff00] text-[#080808]">
                                {{ $post['category'] ?? 'Design' }}
                            </span>
                        </div>
                        <div class="space-y-2">
                            <span class="text-[11px] font-mono text-neutral-400">{{ $post['date'] ?? now()->format('M d, Y') }} &bull; {{ $post['read_time'] ?? '4 min read' }}</span>
                            <h3 class="text-xl font-bold text-white group-hover:text-[#ccff00] transition-colors font-['Outfit']">
                                {{ $post['title'] }}
                            </h3>
                            <p class="text-xs text-neutral-400 line-clamp-2">{{ $post['excerpt'] }}</p>
                            <div class="pt-3">
                                <a href="{{ route('blog.detail', $post['slug']) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ccff00]">
                                    <span>Read More</span>
                                    <span>↗</span>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12 text-neutral-500">
                        <p class="text-sm">No blog posts available yet.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    <!-- =========================================================================
         12. FOOTER SECTION
         ========================================================================= -->
    @include('frontend.themes.uiux_designer.partials.footer')

</div>
@endsection
