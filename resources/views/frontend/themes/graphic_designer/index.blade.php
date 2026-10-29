@extends('frontend.layouts.frontend')

@section('content')
    <div class="bg-[#0c0a18] text-[#f5f3ff] min-h-screen selection:bg-[#7c3aed] selection:text-white relative">

        <!-- Subtle Background Ambient Glows -->
        <div
            class="fixed top-0 left-1/4 w-[600px] h-[600px] bg-purple-900/15 rounded-full blur-[140px] pointer-events-none -z-10">
        </div>
        <div
            class="fixed bottom-1/4 right-10 w-[500px] h-[500px] bg-violet-800/10 rounded-full blur-[160px] pointer-events-none -z-10">
        </div>

        <!-- Header Partial (Sticky Navigation) -->
        @include('frontend.themes.graphic_designer.partials.header')


        <!-- =========================================================================
             2. HERO SECTION
             ========================================================================= -->
        <section id="hero" class="pt-16 pb-20 overflow-hidden relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                    <!-- Left Column: Copy & CTAs -->
                    <div class="lg:col-span-7 space-y-7 z-10">
                        <!-- Greeting Badge -->
                        <div
                            class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#181233] border border-[#a855f7]/30 text-[#c084fc] text-xs font-medium shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                            <span>👋 {{ $settings['hero_tag'] ?? 'Hello, I am William' }}</span>
                        </div>

                        <!-- Main Catchy Title -->
                        <h1
                            class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white font-['Outfit'] leading-[1.08]">
                            {!! $settings['hero_title_line1'] ?? 'Crafting' !!}<br>
                            <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-[#a855f7] via-[#c084fc] to-[#f472b6]">{!! $settings['hero_title_line2'] ?? 'Intuitive Digital' !!}</span><br>
                            {!! $settings['hero_title_line3'] ?? 'Experiences' !!}
                        </h1>

                        <!-- Description -->
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-xl font-normal">
                            {{ $settings['hero_description'] ?? 'I am a visual & UI/UX designer focusing on crafting memorable digital experiences, brand identity systems, mobile applications, and interactive storytelling for innovative brands.' }}
                        </p>

                        <!-- CTA Buttons -->
                        <div class="flex flex-wrap items-center gap-4 pt-2">
                            <a href="{{ $settings['hero_cta_url'] ?? '#works' }}" class="gd-btn-primary">
                                <span>{{ $settings['hero_cta_text'] ?? 'My Works' }}</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M7 17L17 7M17 7H7M17 7V17" />
                                </svg>
                            </a>
                            <a href="{{ $settings['hero_cta2_url'] ?? '#contact' }}" class="gd-btn-outline">
                                <span>{{ $settings['hero_cta2_text'] ?? 'Hire Me' }}</span>
                            </a>
                        </div>

                        <!-- Social Icons Pill Row -->
                        <div class="flex items-center gap-3 pt-4">
                            <a href="{{ $settings['social_behance'] ?? 'https://behance.net' }}" target="_blank"
                                class="w-10 h-10 rounded-full bg-[#181233] hover:bg-[#7c3aed] text-slate-300 hover:text-white border border-white/10 hover:border-[#7c3aed] flex items-center justify-center transition-all hover:-translate-y-1"
                                title="Behance">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M22 7h-7v-2h7v2zm1.726 10c-.442 1.297-2.029 3-4.971 3-3.467 0-5.834-2.544-5.834-5.917 0-3.468 2.457-6.083 5.763-6.083 3.42 0 5.474 2.518 5.474 6.083h-8.24c.063 1.782 1.341 3.076 2.977 3.076 1.408 0 2.277-.696 2.673-1.624l2.158 1.465zm-2.316-4.437c-.073-1.258-.87-2.42-2.463-2.42-1.542 0-2.378 1.118-2.543 2.42h5.006zm-13.41 7.437h-8v-16h8.217c2.68 0 4.783 1.354 4.783 3.864 0 1.552-.806 2.766-2.091 3.393 1.737.587 2.591 2.052 2.591 3.93 0 2.871-2.298 4.813-5.5 4.813zm-5-10h4.316c1.19 0 2.184-.57 2.184-1.636 0-1.137-.927-1.636-2.184-1.636h-4.316v3.272zm0 7h4.783c1.378 0 2.422-.658 2.422-1.892 0-1.282-1.077-1.975-2.422-1.975h-4.783v3.867z" />
                                </svg>
                            </a>
                            <a href="{{ $settings['social_dribbble'] ?? 'https://dribbble.com' }}" target="_blank"
                                class="w-10 h-10 rounded-full bg-[#181233] hover:bg-[#ea4c89] text-slate-300 hover:text-white border border-white/10 hover:border-[#ea4c89] flex items-center justify-center transition-all hover:-translate-y-1"
                                title="Dribbble">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm9.849 10.708a10.024 10.024 0 0 0-4.088-.868c-.201 0-.404.009-.607.027a18.337 18.337 0 0 0-2.023-4.492 10.038 10.038 0 0 1 6.718 5.333zM12 1.996c2.348 0 4.502.81 6.222 2.164a16.275 16.275 0 0 1-1.897 4.197 22.868 22.868 0 0 0-6.19-2.073A10.04 10.04 0 0 1 12 1.996zm-3.693.992c.381.564.739 1.157 1.072 1.776a21.144 21.144 0 0 1-5.074 1.838 10.057 10.057 0 0 1 4.002-3.614zm-6.31 5.922a19.227 19.227 0 0 0 5.397-1.859c.773 1.637 1.396 3.398 1.854 5.234-3.957 1.153-7.227 1.171-7.251 1.171-.005 0-.011 0-.016-.002A9.972 9.972 0 0 1 1.997 12c0-1.127.186-2.211.528-3.228a10.01 10.01 0 0 1-.528.138zm.414 5.326c.491-.01 3.528-.088 7.42-1.229.418 1.488.73 3.012.928 4.542-4.006 1.802-7.28 1.258-7.346 1.246a10.009 10.009 0 0 1-1.002-4.559zm3.435 5.946c.307-.066 3.14-.658 6.945-2.296.721 1.678 1.264 3.447 1.609 5.263a10.024 10.024 0 0 1-8.554-2.967zm10.741 2.222a22.25 22.25 0 0 0-1.63-5.048c1.393-.243 2.825-.371 4.285-.371.492 0 .977.016 1.455.046a10.004 10.004 0 0 1-4.11 5.373zm3.729-4.225a17.472 17.472 0 0 0-1.397-.042c-1.587 0-3.149.146-4.66.425a20.24 20.24 0 0 1-.951-4.707 19.82 19.82 0 0 1 4.414-.075c.676.082 1.332.203 1.966.362a9.982 9.982 0 0 1 .628 4.037z" />
                                </svg>
                            </a>
                            <a href="https://instagram.com" target="_blank"
                                class="w-10 h-10 rounded-full bg-[#181233] hover:bg-[#c13584] text-slate-300 hover:text-white border border-white/10 hover:border-[#c13584] flex items-center justify-center transition-all hover:-translate-y-1"
                                title="Instagram">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                            <a href="{{ $settings['social_linkedin'] ?? 'https://linkedin.com' }}" target="_blank"
                                class="w-10 h-10 rounded-full bg-[#181233] hover:bg-[#0077b5] text-slate-300 hover:text-white border border-white/10 hover:border-[#0077b5] flex items-center justify-center transition-all hover:-translate-y-1"
                                title="LinkedIn">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Right Column: Visual Portrait with Organic Flower Backdrop -->
                    <div class="lg:col-span-5 relative flex items-center justify-center">

                        <!-- Iconic Multi-Petal Organic Violet Flower Backdrop (Matches user screenshot) -->
                        <div
                            class="absolute w-[360px] h-[360px] sm:w-[460px] sm:h-[460px] -z-0 animate-pulse duration-1000 opacity-90">
                            <svg viewBox="0 0 200 200"
                                class="w-full h-full text-[#7c3aed]/85 filter drop-shadow-[0_20px_50px_rgba(124,58,237,0.5)]">
                                <g fill="currentColor" transform="translate(100, 100)">
                                    <!-- 8 Smooth Flower Petals -->
                                    <circle cx="0" cy="-60" r="38" />
                                    <circle cx="42" cy="-42" r="38" />
                                    <circle cx="60" cy="0" r="38" />
                                    <circle cx="42" cy="42" r="38" />
                                    <circle cx="0" cy="60" r="38" />
                                    <circle cx="-42" cy="42" r="38" />
                                    <circle cx="-60" cy="0" r="38" />
                                    <circle cx="-42" cy="-42" r="38" />
                                    <circle cx="0" cy="0" r="50" />
                                </g>
                            </svg>
                        </div>

                        <!-- Cutout Photo of Designer Gesturing OK / Thumbs Up -->
                        <div class="relative z-10 w-full max-w-[420px] aspect-[4/5] flex items-end justify-center">
                            <img src="{{ !empty($settings['hero_image']) ? asset($settings['hero_image']) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=85' }}"
                                alt="{{ $settings['hero_title_line1'] ?? 'Lead Graphic Designer' }}"
                                class="w-full h-full object-cover object-top rounded-3xl filter contrast-105 brightness-105 shadow-2xl border border-[#a855f7]/30">
                        </div>
                    </div>

                </div>

                <!-- Stats Counter Bar (Matches uploaded design) -->
                <div class="mt-16 pt-10 border-t border-white/10 grid grid-cols-2 md:grid-cols-4 gap-6 text-left">
                    <div class="gd-stat-item px-4">
                        <span class="text-3xl sm:text-5xl font-extrabold text-white block font-['Outfit']"
                            data-counter-target="{{ $settings['experience_years'] ?? 12 }}"
                            data-counter-suffix="+">{{ $settings['experience_years'] ?? '12' }}+</span>
                        <span
                            class="text-xs font-medium text-slate-400 uppercase tracking-wider mt-1 block">{{ $settings['counter1_title'] ?? 'Years Experience' }}</span>
                    </div>
                    <div class="gd-stat-item px-4">
                        <span class="text-3xl sm:text-5xl font-extrabold text-white block font-['Outfit']"
                            data-counter-target="{{ $settings['satisfied_clients'] ?? 250 }}"
                            data-counter-suffix="+">{{ $settings['satisfied_clients'] ?? '250' }}+</span>
                        <span
                            class="text-xs font-medium text-slate-400 uppercase tracking-wider mt-1 block">{{ $settings['counter2_title'] ?? 'Happy Clients' }}</span>
                    </div>
                    <div class="gd-stat-item px-4">
                        <span class="text-3xl sm:text-5xl font-extrabold text-white block font-['Outfit']"
                            data-counter-target="{{ $settings['completed_projects'] ?? 680 }}"
                            data-counter-suffix="+">{{ $settings['completed_projects'] ?? '680' }}+</span>
                        <span
                            class="text-xs font-medium text-slate-400 uppercase tracking-wider mt-1 block">{{ $settings['counter3_title'] ?? 'Projects Completed' }}</span>
                    </div>
                    <div class="gd-stat-item px-4">
                        <span class="text-3xl sm:text-5xl font-extrabold text-white block font-['Outfit']"
                            data-counter-target="{{ $settings['awards_count'] ?? 18 }}"
                            data-counter-suffix="+">{{ $settings['awards_count'] ?? '18' }}+</span>
                        <span
                            class="text-xs font-medium text-slate-400 uppercase tracking-wider mt-1 block">{{ $settings['counter4_title'] ?? 'Awards Won' }}</span>
                    </div>
                </div>

            </div>
        </section>

        <!-- =========================================================================
             3. WHAT DO I OFFER? (SERVICES)
             ========================================================================= -->
        <section id="services" class="py-24 border-t border-white/5 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Section Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
                    <div>
                        <span
                            class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-widest block mb-2">{{ $settings['services_tag'] ?? 'Capabilities' }}</span>
                        <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-['Outfit'] tracking-tight">
                            {{ $settings['services_heading'] ?? 'What do I offer?' }}</h2>
                        <p class="text-slate-400 text-sm mt-2 max-w-lg">
                            {{ $settings['services_description'] ?? 'Tailored creative design and digital solution services designed for ambitious modern brands.' }}
                        </p>
                    </div>
                    <div>
                        <a href="#contact" class="gd-btn-primary">
                            <span>See All Services</span>
                        </a>
                    </div>
                </div>

                <!-- Service Rows from Database -->
                <div class="space-y-4">
                    @forelse($services as $index => $item)
                        <div
                            class="gd-service-row flex flex-col md:flex-row md:items-center justify-between gap-6 group cursor-pointer">
                            <div class="flex items-center gap-6 md:w-1/3">
                                <span class="text-lg font-mono font-bold text-[#a855f7]">0{{ $index + 1 }}</span>
                                <h3
                                    class="text-xl sm:text-2xl font-bold text-white group-hover:text-[#c084fc] transition-colors font-['Outfit']">
                                    {{ $item->title }}</h3>
                            </div>
                            <div class="md:w-1/2">
                                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">{{ $item->description }}</p>
                            </div>
                            <div class="flex justify-end md:w-auto">
                                <div
                                    class="w-11 h-11 rounded-full bg-white/5 border border-white/10 group-hover:bg-[#7c3aed] group-hover:border-[#7c3aed] flex items-center justify-center text-slate-300 group-hover:text-white transition-all gd-arrow-icon">
                                    <svg class="w-5 h-5 transition-transform" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                            d="M7 17L17 7M17 7H7M17 7V17" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center rounded-2xl bg-[#150f2c] text-xs text-slate-500">Services can be
                            configured in the Admin Panel.</div>
                    @endforelse
                </div>

            </div>
        </section>

        <!-- =========================================================================
             4. MY LATEST WORKS (PORTFOLIO)
             ========================================================================= -->
        <section id="works" class="py-24 bg-[#0e0b1d] border-t border-white/5 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Section Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
                    <div>
                        <span
                            class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-widest block mb-2">{{ $settings['portfolio_tag'] ?? 'Portfolio' }}</span>
                        <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-['Outfit'] tracking-tight">
                            {{ $settings['portfolio_heading'] ?? 'My Latest Works' }}</h2>
                        <p class="text-slate-400 text-sm mt-2 max-w-lg">
                            {{ $settings['portfolio_description'] ?? 'Explore featured design projects across branding, web interfaces, and mobile applications.' }}
                        </p>
                    </div>
                    <div>
                        <a href="#contact" class="gd-btn-primary">
                            <span>View All Works</span>
                        </a>
                    </div>
                </div>

                <!-- Filter Tabs -->
                <div class="flex flex-wrap items-center gap-2 mb-12">
                    <button type="button" data-gd-filter="all"
                        class="px-5 py-2 rounded-full text-xs font-bold transition-all bg-[#7c3aed] text-white shadow-lg shadow-purple-900/30">
                        All Works
                    </button>
                    <button type="button" data-gd-filter="uiux"
                        class="px-5 py-2 rounded-full text-xs font-semibold text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                        UI/UX Design
                    </button>
                    <button type="button" data-gd-filter="branding"
                        class="px-5 py-2 rounded-full text-xs font-semibold text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                        Branding
                    </button>
                    <button type="button" data-gd-filter="mobile"
                        class="px-5 py-2 rounded-full text-xs font-semibold text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                        Mobile Apps
                    </button>
                    <button type="button" data-gd-filter="graphic"
                        class="px-5 py-2 rounded-full text-xs font-semibold text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                        Graphic Art
                    </button>
                </div>

                <!-- Grid of Projects from Database -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($projects->take(4) as $proj)
                        @php
                            $pImg = $proj->image_url ?? ($proj->image ?? null);
                            if ($pImg && !str_starts_with($pImg, 'http')) {
                                $pImg = asset($pImg);
                            }
                        @endphp
                        <div class="gd-project-card group" data-gd-category="{{ strtolower($proj->category) }}">
                            <div class="aspect-[16/10] overflow-hidden bg-black/40 relative">
                                @if ($pImg)
                                    <img src="{{ $pImg }}" alt="{{ $proj->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 gd-project-img">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#1c1236] to-[#0c0a18] text-[#a855f7]">
                                        <i class="ph ph-paint-brush text-4xl"></i>
                                    </div>
                                @endif
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-[#150f2b] via-transparent to-transparent opacity-80">
                                </div>
                            </div>
                            <div class="p-6 flex items-center justify-between">
                                <div>
                                    <span
                                        class="text-[11px] font-mono text-[#a855f7] uppercase tracking-wider block">{{ $proj->category }}</span>
                                    <h3
                                        class="text-xl font-bold text-white group-hover:text-[#c084fc] transition-colors font-['Outfit'] mt-1">
                                        {{ $proj->title }}</h3>
                                </div>
                                <a href="{{ $proj->demo_url ?? route('portfolio') }}"
                                    target="{{ $proj->demo_url ? '_blank' : '_self' }}"
                                    class="w-10 h-10 rounded-full bg-white/5 border border-white/10 group-hover:bg-[#7c3aed] flex items-center justify-center text-slate-300 group-hover:text-white transition-all gd-arrow-circle">
                                    <svg class="w-4 h-4 transition-transform" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M7 17L17 7M17 7H7M17 7V17" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center text-xs text-slate-500 py-8 bg-[#150f2c] rounded-2xl">Projects
                            can be managed from Admin Panel.</div>
                    @endforelse
                </div>

                <!-- Central Explore More Button -->
                <div class="mt-14 text-center">
                    <a href="#contact"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#181233] hover:bg-[#7c3aed] text-white border border-white/10 hover:border-[#7c3aed] text-xs font-bold transition-all hover:scale-105 shadow-xl">
                        <span>Explore More Projects</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                </div>

            </div>
        </section>

        <!-- =========================================================================
             5. MY RESUME (EDUCATION & WORK EXPERIENCE)
             ========================================================================= -->
        <section id="resume" class="py-24 border-t border-white/5 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Section Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
                    <div>
                        <span
                            class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-widest block mb-2">{{ $settings['experience_tag'] ?? 'Career Journey' }}</span>
                        <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-['Outfit'] tracking-tight">
                            {{ $settings['experience_heading'] ?? 'My Resume' }}</h2>
                        <p class="text-slate-400 text-sm mt-2 max-w-lg">
                            {{ $settings['experience_description'] ?? 'A chronicle of academic foundations and professional creative milestones.' }}
                        </p>
                    </div>
                    <div>
                        <a href="{{ $settings['resume_btn_url'] ?? route('cv.download') }}" download
                            class="gd-btn-primary">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <span>{{ $settings['resume_btn_text'] ?? 'Download CV' }}</span>
                        </a>
                    </div>
                </div>

                <!-- 2 Columns: Education & Experience -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                    <!-- Column 1: Education -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-2 mb-6 text-white font-bold text-lg font-['Outfit']">
                            <svg class="w-5 h-5 text-[#a855f7]" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                            <span>Education</span>
                        </div>

                        @foreach ($resumeEducation as $edu)
                            <div class="gd-resume-card flex flex-col justify-between">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-mono font-bold text-[#a855f7]">{{ $edu['period'] }}</span>
                                    <span
                                        class="text-[10px] font-mono px-2 py-0.5 rounded-full bg-[#7c3aed]/20 text-[#c084fc] font-semibold">{{ $edu['grade'] }}</span>
                                </div>
                                <h4 class="text-base font-bold text-white font-['Outfit']">{{ $edu['title'] }}</h4>
                                <p class="text-xs text-slate-400 mt-1">{{ $edu['institution'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Column 2: Work Experience -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-2 mb-6 text-white font-bold text-lg font-['Outfit']">
                            <svg class="w-5 h-5 text-[#a855f7]" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>Work Experience</span>
                        </div>

                        @foreach ($resumeExperience as $exp)
                            <div class="gd-resume-card flex flex-col justify-between">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-mono font-bold text-[#a855f7]">{{ $exp['period'] }}</span>
                                    <span class="text-[10px] font-mono text-slate-400">{{ $exp['company'] }}</span>
                                </div>
                                <h4 class="text-base font-bold text-white font-['Outfit']">{{ $exp['title'] }}</h4>
                                <p class="text-xs text-slate-300 mt-1 leading-relaxed">{{ $exp['description'] }}</p>
                            </div>
                        @endforeach
                    </div>

                </div>

            </div>
        </section>

        <!-- =========================================================================
             6. MY SKILLS (SOFTWARE & TOOLS)
             ========================================================================= -->
        <section id="skills" class="py-24 bg-[#0e0b1d] border-t border-white/5 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

                <!-- Section Header -->
                <div class="max-w-2xl mx-auto mb-14">
                    <span
                        class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-widest block mb-2">{{ $settings['skills_tag'] ?? 'Arsenal' }}</span>
                    <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-['Outfit'] tracking-tight">
                        {{ $settings['skills_title'] ?? ($settings['skills_heading'] ?? 'My Skills') }}</h2>
                    <p class="text-slate-400 text-sm mt-2">
                        {{ $settings['skills_subtitle'] ?? ($settings['skills_description'] ?? 'Tools and software I rely on every day to craft pixel-perfect visual experiences.') }}
                    </p>
                </div>

                <!-- Skills Row Cards from Database -->
                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
                    @forelse($skills as $skill)
                        @php
                            $sName = strtolower($skill->name);
                        @endphp
                        <div
                            class="gd-skill-badge group p-4 rounded-2xl bg-[#150f2c] border border-white/5 hover:border-[#a855f7]/40 transition-all flex flex-col items-center text-center shadow-lg hover:shadow-[#a855f7]/10 hover:-translate-y-1 duration-300">
                            <div
                                class="w-12 h-12 rounded-2xl bg-[#0c0a18] flex items-center justify-center text-[#a855f7] font-bold text-base group-hover:scale-110 transition-transform mb-3 border border-white/10 shrink-0">
                                @if (
                                    !empty($skill->icon) &&
                                        (str_contains($skill->icon, '<svg') ||
                                            str_starts_with($skill->icon, '<i') ||
                                            str_starts_with($skill->icon, 'http') ||
                                            str_starts_with($skill->icon, '/')))
                                    @if (str_contains($skill->icon, '<svg') || str_starts_with($skill->icon, '<i'))
                                        {!! $skill->icon !!}
                                    @else
                                        <img src="{{ $skill->icon }}" alt="{{ $skill->name }}"
                                            class="w-7 h-7 object-contain">
                                    @endif
                                @elseif(!empty($skill->icon) && (str_contains($skill->icon, 'ph-') || str_starts_with($skill->icon, 'ph ')))
                                    <i class="{{ $skill->icon }} text-2xl"></i>
                                @elseif(str_contains($sName, 'figma') || str_contains($sName, 'figjam'))
                                    <!-- Figma Multi-Color Brand SVG -->
                                    <svg class="w-6 h-6" viewBox="0 0 38 57" fill="none">
                                        <path
                                            d="M19 28.5C19 23.2533 23.2533 19 28.5 19C33.7467 19 38 23.2533 38 28.5C38 33.7467 33.7467 38 28.5 38C23.2533 38 19 33.7467 19 28.5Z"
                                            fill="#1ABCFE" />
                                        <path
                                            d="M0 47.5C0 42.2533 4.25329 38 9.5 38H19V47.5C19 52.7467 14.7467 57 9.5 57C4.25329 57 0 52.7467 0 47.5Z"
                                            fill="#0ACF83" />
                                        <path d="M19 0V19H28.5C33.7467 19 38 14.7467 38 9.5C38 4.25329 33.7467 0 28.5 0H19Z"
                                            fill="#FF7262" />
                                        <path d="M0 9.5C0 14.7467 4.25329 19 9.5 19H19V0H9.5C4.25329 0 0 4.25329 0 9.5Z"
                                            fill="#F24E1E" />
                                        <path d="M0 28.5C0 33.7467 4.25329 38 9.5 38H19V19H9.5C4.25329 19 0 23.2533 0 28.5Z"
                                            fill="#A259FF" />
                                    </svg>
                                @elseif(str_contains($sName, 'illustrator') && str_contains($sName, 'photoshop'))
                                    <!-- Adobe Ai & Ps Dual Brand Badge -->
                                    <svg class="w-7 h-7" viewBox="0 0 46 24">
                                        <rect x="0" y="0" width="21" height="24" rx="4" fill="#2b0000"
                                            stroke="#FF9A00" stroke-width="1.2" />
                                        <text x="10.5" y="16" font-family="'Outfit', sans-serif" font-weight="900"
                                            font-size="11" fill="#FF9A00" text-anchor="middle">Ai</text>
                                        <rect x="25" y="0" width="21" height="24" rx="4" fill="#001429"
                                            stroke="#31A8FF" stroke-width="1.2" />
                                        <text x="35.5" y="16" font-family="'Outfit', sans-serif" font-weight="900"
                                            font-size="11" fill="#31A8FF" text-anchor="middle">Ps</text>
                                    </svg>
                                @elseif(str_contains($sName, 'illustrator'))
                                    <!-- Adobe Illustrator Brand SVG -->
                                    <svg class="w-6 h-6" viewBox="0 0 24 24">
                                        <rect width="24" height="24" rx="5" fill="#2b0000"
                                            stroke="#FF9A00" stroke-width="1.2" />
                                        <text x="12" y="16" font-family="'Outfit', sans-serif" font-weight="900"
                                            font-size="11" fill="#FF9A00" text-anchor="middle">Ai</text>
                                    </svg>
                                @elseif(str_contains($sName, 'photoshop'))
                                    <!-- Adobe Photoshop Brand SVG -->
                                    <svg class="w-6 h-6" viewBox="0 0 24 24">
                                        <rect width="24" height="24" rx="5" fill="#001429"
                                            stroke="#31A8FF" stroke-width="1.2" />
                                        <text x="12" y="16" font-family="'Outfit', sans-serif" font-weight="900"
                                            font-size="11" fill="#31A8FF" text-anchor="middle">Ps</text>
                                    </svg>
                                @elseif(str_contains($sName, 'after effect'))
                                    <!-- Adobe After Effects Brand SVG -->
                                    <svg class="w-6 h-6" viewBox="0 0 24 24">
                                        <rect width="24" height="24" rx="5" fill="#0c0029"
                                            stroke="#9999FF" stroke-width="1.2" />
                                        <text x="12" y="16" font-family="'Outfit', sans-serif" font-weight="900"
                                            font-size="11" fill="#9999FF" text-anchor="middle">Ae</text>
                                    </svg>
                                @elseif(str_contains($sName, 'cinema 4d') || str_contains($sName, 'c4d'))
                                    <!-- Cinema 4D Brand SVG -->
                                    <svg class="w-6 h-6" viewBox="0 0 24 24">
                                        <rect width="24" height="24" rx="5" fill="#001026"
                                            stroke="#0070BA" stroke-width="1.2" />
                                        <text x="12" y="16" font-family="'Outfit', sans-serif" font-weight="900"
                                            font-size="9" fill="#2EA3F2" text-anchor="middle">C4D</text>
                                    </svg>
                                @elseif(str_contains($sName, 'blender'))
                                    <!-- Blender 3D Brand SVG -->
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M12 2a4 4 0 0 0-4 4c0 .4.06.8.18 1.17L2.4 10.4a1 1 0 0 0-.25.86 1 1 0 0 0 .5.74l8.8 4.4a1 1 0 0 0 1-.05l7-4.5a1 1 0 0 0 .45-.85 1 1 0 0 0-.45-.85l-7.2-4.6A4 4 0 0 0 12 2z"
                                            fill="#EA7600" />
                                        <circle cx="12" cy="14" r="3.5" fill="#225B99" />
                                        <circle cx="12" cy="14" r="1.5" fill="#FFFFFF" />
                                    </svg>
                                @elseif(str_contains($sName, 'laravel') || str_contains($sName, 'php'))
                                    <!-- Laravel Brand SVG -->
                                    <svg class="w-6 h-6 fill-[#FF2D20]" viewBox="0 0 24 24">
                                        <path
                                            d="M23.642 5.373a.747.747 0 0 0-.372-.647L13.882.164a.754.754 0 0 0-.745 0L3.75 5.568a.746.746 0 0 0-.373.647v10.8a.75.75 0 0 0 .373.648l9.387 5.405a.748.748 0 0 0 .745 0l9.387-5.405a.747.747 0 0 0 .373-.648V5.373zM13.51 1.74l7.986 4.6-3.328 1.916-7.986-4.6 3.328-1.916zm-1.02.588v7.868l-3.328-1.916V2.328l3.328-1.916zm-4.348 2.502v5.952l-3.328-1.916V4.83l3.328-1.916zm-3.328 8.454 3.328 1.916v5.952l-3.328-1.916v-5.952zm4.348 2.502 3.328 1.916v7.868l-3.328-1.916v-7.868zm12.334-1.914-3.328 1.916-7.986-4.6 3.328-1.916 7.986 4.6z" />
                                    </svg>
                                @elseif(str_contains($sName, 'flutter') || str_contains($sName, 'dart'))
                                    <!-- Flutter Brand SVG -->
                                    <svg class="w-6 h-6 fill-[#02569B]" viewBox="0 0 24 24">
                                        <path
                                            d="M14.314 0L2.3 12 6 15.7 21.684.013h-7.37zM6.015 15.69l3.684 3.685 4.615-4.615-3.685-3.685L6.015 15.69zm8.3 8.31h7.37l-6.84-6.84-3.685 3.684 3.155 3.156z" />
                                    </svg>
                                @elseif(str_contains($sName, 'wordpress') || str_contains($sName, 'woocommerce'))
                                    <!-- WordPress Brand SVG -->
                                    <svg class="w-6 h-6 fill-[#21759B]" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0C5.373 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387L3.652 10.82a9.55 9.55 0 0 1 8.348-5.32c1.986 0 3.82.604 5.334 1.637L12 0zm0 24c-.958 0-1.888-.112-2.783-.324l4.577-13.31 4.673 12.796A11.954 11.954 0 0 1 12 24zm9.324-7.464c.433-1.373.676-2.836.676-4.536 0-2.39-.817-4.593-2.186-6.347l4.475 12.302c-.894.498-1.887.892-2.965 1.171zM1.026 12c0 1.93.513 3.738 1.41 5.314l5.632-15.42A11.947 11.947 0 0 0 1.026 12z" />
                                    </svg>
                                @elseif(str_contains($sName, 'typography') || str_contains($sName, 'brand'))
                                    <!-- Brand Identity & Typography SVG -->
                                    <svg class="w-6 h-6 text-[#a855f7]" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M4 20h16M12 4L5 18h3.5l1.5-3.5h4l1.5 3.5H19L12 4z" />
                                        <path d="M10.8 12.5h2.4" />
                                    </svg>
                                @elseif(str_contains($sName, 'research') || str_contains($sName, 'wirefram') || str_contains($sName, 'ux'))
                                    <!-- User Research & Wireframing SVG -->
                                    <svg class="w-6 h-6 text-[#a855f7]" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="3" ry="3" />
                                        <line x1="3" y1="9" x2="21" y2="9" />
                                        <line x1="9" y1="21" x2="9" y2="9" />
                                    </svg>
                                @elseif(str_contains($sName, 'react') || str_contains($sName, 'native'))
                                    <!-- React Brand SVG -->
                                    <svg class="w-6 h-6 fill-[#61DAFB]" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="2.5" />
                                        <ellipse cx="12" cy="12" rx="10" ry="4"
                                            transform="rotate(30 12 12)" fill="none" stroke="#61DAFB"
                                            stroke-width="1.5" />
                                        <ellipse cx="12" cy="12" rx="10" ry="4"
                                            transform="rotate(90 12 12)" fill="none" stroke="#61DAFB"
                                            stroke-width="1.5" />
                                        <ellipse cx="12" cy="12" rx="10" ry="4"
                                            transform="rotate(150 12 12)" fill="none" stroke="#61DAFB"
                                            stroke-width="1.5" />
                                    </svg>
                                @elseif(str_contains($sName, 'vue'))
                                    <!-- Vue.js Brand SVG -->
                                    <svg class="w-6 h-6" viewBox="0 0 24 24">
                                        <path d="M2 3h3.5L12 14.5 18.5 3H22L12 21 2 3z" fill="#41B883" />
                                        <path d="M6.5 3h3.5L12 7 14 3h3.5L12 13 6.5 3z" fill="#35495E" />
                                    </svg>
                                @elseif(str_contains($sName, 'tailwind') || str_contains($sName, 'sass') || str_contains($sName, 'css'))
                                    <!-- Tailwind CSS SVG -->
                                    <svg class="w-6 h-6 fill-[#06B6D4]" viewBox="0 0 24 24">
                                        <path
                                            d="M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.336 6.182 14.975 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.336 13.382 8.975 12 6.001 12z" />
                                    </svg>
                                @elseif(str_contains($sName, 'sql') || str_contains($sName, 'redis') || str_contains($sName, 'database'))
                                    <!-- Database SVG -->
                                    <svg class="w-6 h-6 text-[#a855f7]" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <ellipse cx="12" cy="5" rx="9" ry="3" />
                                        <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3" />
                                        <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5" />
                                    </svg>
                                @elseif(str_contains($sName, 'docker') || str_contains($sName, 'cloud') || str_contains($sName, 'api'))
                                    <!-- Docker / Cloud SVG -->
                                    <svg class="w-6 h-6 fill-[#2496ED]" viewBox="0 0 24 24">
                                        <path
                                            d="M13.983 11.078h2.119a.186.186 0 0 0 .186-.185V9.006a.186.186 0 0 0-.186-.186h-2.119a.185.185 0 0 0-.185.185v1.888c0 .102.083.185.185.185m-2.954-5.43h2.118a.186.186 0 0 0 .186-.186V3.574a.186.186 0 0 0-.186-.185h-2.118a.185.185 0 0 0-.185.185v1.888c0 .102.082.186.185.186m0 2.716h2.118a.187.187 0 0 0 .186-.186V6.29a.186.186 0 0 0-.186-.185h-2.118a.185.185 0 0 0-.185.185v1.887c0 .102.082.186.185.186m-2.93 0h2.12a.186.186 0 0 0 .184-.186V6.29a.185.185 0 0 0-.185-.185H8.1a.185.185 0 0 0-.185.185v1.887c0 .102.083.186.185.186m-2.954 0h2.119a.186.186 0 0 0 .185-.186V6.29a.185.185 0 0 0-.185-.185H5.146a.185.185 0 0 0-.185.185v1.887c0 .102.083.186.185.186m11.808 2.714h2.119a.186.186 0 0 0 .186-.185V9.006a.186.186 0 0 0-.186-.186h-2.119a.186.186 0 0 0-.186.185v1.888c0 .102.083.185.186.185m-8.854 0h2.119a.186.186 0 0 0 .185-.185V9.006a.185.185 0 0 0-.185-.186H8.1a.185.185 0 0 0-.185.185v1.888c0 .102.083.185.185.185m-2.954 0h2.119a.186.186 0 0 0 .185-.185V9.006a.185.185 0 0 0-.185-.186H5.146a.185.185 0 0 0-.185.185v1.888c0 .102.083.185.185.185m-2.93 0h2.12a.185.185 0 0 0 .184-.185V9.006a.185.185 0 0 0-.184-.186h-2.12a.185.185 0 0 0-.185.185v1.888c0 .102.083.185.185.185M23.77 9.89c-.446-.353-1.638-.507-2.613-.23-.153-.87-.723-1.488-1.554-1.748-.683-.213-1.503-.092-2.198.318-.088-.046-.178-.088-.27-.128l-.512-.224a.534.534 0 0 0-.214-.044H.576a.54.54 0 0 0-.54.54c0 3.298.813 6.136 2.416 8.435 1.56 2.238 3.82 3.585 6.716 4.004.81.117 1.636.177 2.457.177 6.42 0 11.66-3.882 12.145-9.45.023-.264.04-.53.05-.798.37-.215.717-.502.96-.85z" />
                                    </svg>
                                @elseif(str_contains($sName, 'swift') || str_contains($sName, 'ios'))
                                    <!-- Swift SVG -->
                                    <svg class="w-6 h-6 fill-[#F05138]" viewBox="0 0 24 24">
                                        <path
                                            d="M22.094 15.65c-.092.174-.187.348-.285.518-1.39 2.39-3.75 4.34-6.47 5.37 3.39-1.92 5.62-5.41 5.9-9.35.03-.45.02-.91-.03-1.36.42.74.72 1.54.88 2.37.1.52.12 1.05.07 1.58-.02.3-.04.59-.07.87zM12.924 1.15c2.72 2.31 4.54 5.62 4.96 9.29-1.51-2.18-3.7-3.83-6.26-4.69 1.19 1.76 1.83 3.84 1.83 5.98 0 1.54-.33 3.03-.96 4.39-.77 1.64-1.98 3-3.48 3.93-1.91 1.19-4.14 1.73-6.38 1.54 4.51-.73 8.35-3.5 10.32-7.5.95-1.93 1.25-4.11.87-6.24-.31-1.74-1.14-3.35-2.38-4.63-.44-.45-.92-.86-1.43-1.22z" />
                                    </svg>
                                @elseif(str_contains($sName, 'kotlin') || str_contains($sName, 'android'))
                                    <!-- Kotlin / Android SVG -->
                                    <svg class="w-6 h-6 fill-[#3DDC84]" viewBox="0 0 24 24">
                                        <path
                                            d="M17.523 15.3414c-.5511 0-.9993-.4486-.9993-.9997s.4482-.9993.9993-.9993c.551 0 .9993.4482.9993.9993.0001.5511-.4482.9997-.9993.9997m-11.046 0c-.5511 0-.9993-.4486-.9993-.9997s.4482-.9993.9993-.9993c.5511 0 .9993.4482.9993.9993 0 .5511-.4482.9997-.9993.9997m11.4045-6.02l1.9973-3.4592a.416.416 0 00-.1521-.5676.416.416 0 00-.5676.1521l-2.0223 3.503C15.5902 8.411 13.8564 8.084 12 8.084s-3.5902.327-5.1368.8657L4.8409 5.4467a.4161.4161 0 00-.5677-.1521.4157.4157 0 00-.1521.5676l1.9973 3.4592C2.6889 11.1867.3432 14.6589 0 18.761h24c-.3432-4.1021-2.6889-7.5743-6.1185-9.4396" />
                                    </svg>
                                @elseif(str_contains($sName, 'system') || str_contains($sName, 'atomic'))
                                    <!-- Design Systems SVG -->
                                    <svg class="w-6 h-6 text-[#a855f7]" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                        <polyline points="2 17 12 22 22 17"></polyline>
                                        <polyline points="2 12 12 17 22 12"></polyline>
                                    </svg>
                                @elseif(str_contains($sName, 'test') || str_contains($sName, 'analytic'))
                                    <!-- Usability Testing SVG -->
                                    <svg class="w-6 h-6 text-[#a855f7]" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <line x1="18" y1="20" x2="18" y2="10"></line>
                                        <line x1="12" y1="20" x2="12" y2="4"></line>
                                        <line x1="6" y1="20" x2="6" y2="14"></line>
                                    </svg>
                                @else
                                    <!-- Creative Design Fallback SVG -->
                                    <svg class="w-6 h-6 text-[#a855f7]" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                    </svg>
                                @endif
                            </div>
                            <span
                                class="text-xs font-bold text-white block w-full text-center leading-snug break-words line-clamp-2 px-1 min-h-[2rem] flex items-center justify-center"
                                title="{{ $skill->name }}">{{ $skill->name }}</span>
                            <span
                                class="text-[11px] font-mono font-bold text-[#a855f7] mt-1">{{ $skill->percentage }}%</span>
                        </div>
                    @empty
                        <div class="col-span-6 text-center text-xs text-slate-500 py-6">Skills can be managed from Admin
                            Panel.</div>
                    @endforelse
                </div>

                <!-- Subtext Banner -->
                <p class="text-xs text-slate-400 mt-10 max-w-xl mx-auto italic">
                    {{ $settings['skills_footer_note'] ?? ($settings['skills_quote'] ?? '"Every design is carefully crafted with pixel-perfect attention to detail and human empathy."') }}
                </p>

            </div>
        </section>


        <!-- =========================================================================
             8. CLIENTS TESTIMONIALS
             ========================================================================= -->
        <section id="testimonials" class="py-24 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Section Header -->
                <div class="max-w-2xl mb-14">
                    <span
                        class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-widest block mb-2">{{ $settings['testimonials_tag'] ?? 'Social Proof' }}</span>
                    <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-['Outfit'] tracking-tight">
                        {{ $settings['testimonials_heading'] ?? 'Clients Testimonials' }}</h2>
                    <p class="text-slate-400 text-sm mt-2">
                        {{ $settings['testimonials_description'] ?? 'What creative directors and product leaders say about working together.' }}
                    </p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

                    <!-- Left 8 cols: Testimonial Cards Slider -->
                    <div class="lg:col-span-8">
                        @php
                            $allTestimonials =
                                $testimonials->count() > 0
                                    ? $testimonials
                                    : collect([
                                        (object) [
                                            'content' =>
                                                'Working with William was an absolute pleasure. His attention to detail and user-focused design approach significantly improved our product\'s usability.',
                                            'client_name' => 'John Doe',
                                            'client_role' => 'Head of Legal & Compliance',
                                            'company' => 'Tech Innovators',
                                            'avatar' => null,
                                        ],
                                        (object) [
                                            'content' =>
                                                'The brand assets, 3D typography, and marketing illustrations gave our startup an ultra-premium visual edge. Conversion increased by 35%.',
                                            'client_name' => 'Sophia Laurent',
                                            'client_role' => 'Creative Director',
                                            'company' => 'Atelier Studio',
                                            'avatar' => null,
                                        ],
                                        (object) [
                                            'content' =>
                                                'Exceptional visual polish and quick turnaround. The complete identity system was delivered ahead of our international product launch.',
                                            'client_name' => 'Marcus Vance',
                                            'client_role' => 'VP Marketing',
                                            'company' => 'HyperScale',
                                            'avatar' => null,
                                        ],
                                        (object) [
                                            'content' =>
                                                'Unmatched creative energy and aesthetic mastery. Truly one of the finest graphic design partners we have ever collaborated with.',
                                            'client_name' => 'Elena Rostova',
                                            'client_role' => 'Product Lead',
                                            'company' => 'FinTrack Global',
                                            'avatar' => null,
                                        ],
                                    ]);

                            if ($allTestimonials->count() < 4) {
                                $allTestimonials = $allTestimonials->concat($allTestimonials);
                            }
                        @endphp

                        <div class="testimonials-slider-container relative overflow-hidden" data-autoplay="5000">
                            <div class="testimonials-slider-track flex transition-transform duration-700 ease-out -mx-3">
                                @foreach ($allTestimonials as $testimony)
                                    <div class="testimonials-slide w-full sm:w-1/2 flex-shrink-0 px-3">
                                        <div
                                            class="p-7 rounded-3xl bg-[#150f2c] border border-[#a855f7]/20 flex flex-col justify-between space-y-6 shadow-xl relative h-full">
                                            <div>
                                                <div
                                                    class="text-[#a855f7] text-4xl font-serif leading-none font-bold mb-3">
                                                    “</div>
                                                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                                                    "{{ $testimony->content }}"
                                                </p>
                                            </div>
                                            <div class="flex items-center gap-4 pt-4 border-t border-white/10">
                                                @if (!empty($testimony->avatar))
                                                    <img src="{{ $testimony->avatar }}"
                                                        alt="{{ $testimony->client_name }}"
                                                        class="w-11 h-11 rounded-full object-cover border-2 border-[#a855f7]">
                                                @else
                                                    <div
                                                        class="w-11 h-11 rounded-full bg-[#1e1338] border-2 border-[#a855f7] flex items-center justify-center font-bold text-white uppercase text-xs">
                                                        {{ substr($testimony->client_name ?? 'C', 0, 2) }}
                                                    </div>
                                                @endif
                                                <div>
                                                    <h4 class="text-sm font-bold text-white font-['Outfit']">
                                                        {{ $testimony->client_name }}</h4>
                                                    <span
                                                        class="text-[11px] text-slate-400">{{ $testimony->client_role ?? 'Client' }}
                                                        {{ !empty($testimony->company) ? '• ' . $testimony->company : '' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Slider Controls: Prev/Next & Dots -->
                            <div class="flex items-center justify-start gap-5 mt-8">
                                <button type="button"
                                    class="testimonials-prev-btn w-9 h-9 rounded-full bg-white/5 hover:bg-[#a855f7] hover:text-white border border-[#a855f7]/30 text-white flex items-center justify-center transition-all cursor-pointer shadow-sm text-xs"
                                    aria-label="Previous testimonial">
                                    &#8592;
                                </button>
                                <div class="testimonials-dots flex items-center gap-2 text-[#a855f7]"></div>
                                <button type="button"
                                    class="testimonials-next-btn w-9 h-9 rounded-full bg-white/5 hover:bg-[#a855f7] hover:text-white border border-[#a855f7]/30 text-white flex items-center justify-center transition-all cursor-pointer shadow-sm text-xs"
                                    aria-label="Next testimonial">
                                    &#8594;
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Right 4 cols: Cutout portrait pointing towards reviews with flower backdrop (Matches screenshot) -->
                    <div class="lg:col-span-4 relative flex items-center justify-center">

                        <div class="absolute w-[280px] h-[280px] -z-0 opacity-80">
                            <svg viewBox="0 0 200 200" class="w-full h-full text-[#7c3aed]">
                                <g fill="currentColor" transform="translate(100, 100)">
                                    <circle cx="0" cy="-50" r="32" />
                                    <circle cx="35" cy="-35" r="32" />
                                    <circle cx="50" cy="0" r="32" />
                                    <circle cx="35" cy="35" r="32" />
                                    <circle cx="0" cy="50" r="32" />
                                    <circle cx="-35" cy="35" r="32" />
                                    <circle cx="-50" cy="0" r="32" />
                                    <circle cx="-35" cy="-35" r="32" />
                                    <circle cx="0" cy="0" r="40" />
                                </g>
                            </svg>
                        </div>

                        <div class="relative z-10 w-full max-w-[280px] aspect-[3/4]">
                            <img src="{{ !empty($settings['testimonials_image']) ? (str_starts_with($settings['testimonials_image'], 'http') ? $settings['testimonials_image'] : asset($settings['testimonials_image'])) : (!empty($settings['about_image']) ? (str_starts_with($settings['about_image'], 'http') ? $settings['about_image'] : asset($settings['about_image'])) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=700&q=80') }}"
                                alt="{{ $settings['testimonials_title'] ?? 'Clients Testimonials' }}"
                                class="w-full h-full object-cover object-top rounded-3xl border border-[#a855f7]/30 shadow-2xl filter contrast-105">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================================================================
             9. RECENT BLOG
             ========================================================================= -->
        <section id="blog" class="py-24 bg-[#0e0b1d] border-t border-white/5 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Section Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
                    <div>
                        <span
                            class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-widest block mb-2">{{ $settings['blog_tag'] ?? 'Articles & Insights' }}</span>
                        <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-['Outfit'] tracking-tight">
                            {{ $settings['blog_heading'] ?? 'Recent blog' }}</h2>
                        <p class="text-slate-400 text-sm mt-2 max-w-lg">
                            {{ $settings['blog_description'] ?? 'Thoughts on design engineering, user psychology, and creative direction.' }}
                        </p>
                    </div>
                    <div>
                        <a href="{{ $settings['blog_btn_url'] ?? route('blog') }}" class="gd-btn-primary">
                            <span>{{ $settings['blog_btn_text'] ?? 'Visit Blog' }}</span>
                        </a>
                    </div>
                </div>

                <!-- Blog 3-Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($blogPosts as $post)
                        <article
                            class="p-4 rounded-3xl bg-[#150f2c] border border-white/10 hover:border-[#a855f7]/40 transition-all hover:-translate-y-2 group shadow-xl">
                            <div class="aspect-[16/10] rounded-2xl overflow-hidden bg-black/40 mb-5 relative">
                                <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <span
                                    class="absolute top-3 left-3 px-3 py-1 rounded-full text-[10px] font-mono font-bold bg-[#7c3aed] text-white shadow-md">
                                    {{ $post['category'] }}
                                </span>
                            </div>
                            <div class="px-2 space-y-2">
                                <span class="text-[11px] font-mono text-slate-400">{{ $post['date'] }} &bull;
                                    {{ $post['read_time'] }}</span>
                                <h3
                                    class="text-base font-bold text-white group-hover:text-[#c084fc] transition-colors font-['Outfit'] line-clamp-2 leading-snug">
                                    {{ $post['title'] }}
                                </h3>
                                <div class="pt-2">
                                    <a href="#contact"
                                        class="inline-flex items-center gap-1.5 text-xs font-bold text-[#a855f7] hover:text-[#c084fc] transition-colors">
                                        <span>Read Article</span>
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

            </div>
        </section>

        <!-- =========================================================================
             10. GET IN TOUCH (CONTACT) & WATERMARK FOOTER
             ========================================================================= -->
        <section id="contact" class="pt-24 pb-14 border-t border-white/5 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-20">

                    <!-- Left 5 cols: Contact Info -->
                    <div class="lg:col-span-5 space-y-8">
                        <div>
                            <span
                                class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-widest block mb-2">{{ $settings['contact_tag'] ?? 'Reach Out' }}</span>
                            <h2 class="text-3xl sm:text-5xl font-extrabold text-white font-['Outfit'] tracking-tight">
                                {{ $settings['contact_heading'] ?? 'Get in touch' }}</h2>
                            <p class="text-slate-300 text-sm mt-3 leading-relaxed">
                                {{ $settings['contact_description'] ?? "Have a new project or an ambitious brand overhaul? Drop me a message and let's create something extraordinary together." }}
                            </p>
                        </div>

                        <div class="space-y-5">
                            <div class="flex items-center gap-4">
                                <div
                                    class="gd-contact-badge w-12 h-12 rounded-2xl bg-[#181233] border border-[#a855f7]/30 flex items-center justify-center text-[#a855f7] shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-[11px] font-mono text-slate-400 block">Email Me At</span>
                                    <a href="mailto:{{ $settings['contact_email'] ?? 'alex@designstudio.me' }}"
                                        class="text-sm font-bold text-white hover:text-[#c084fc] transition-colors">
                                        {{ $settings['contact_email'] ?? 'alex@designstudio.me' }}
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div
                                    class="gd-contact-badge w-12 h-12 rounded-2xl bg-[#181233] border border-[#a855f7]/30 flex items-center justify-center text-[#a855f7] shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-[11px] font-mono text-slate-400 block">Direct Line</span>
                                    <a href="tel:{{ $settings['contact_phone'] ?? '+15553897241' }}"
                                        class="text-sm font-bold text-white hover:text-[#c084fc] transition-colors">
                                        {{ $settings['contact_phone'] ?? '+1 (555) 389-7241' }}
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div
                                    class="gd-contact-badge w-12 h-12 rounded-2xl bg-[#181233] border border-[#a855f7]/30 flex items-center justify-center text-[#a855f7] shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-[11px] font-mono text-slate-400 block">Studio Location</span>
                                    <span class="text-sm font-bold text-white">{!! $settings['contact_location'] ?? 'San Francisco, CA &bull; Worldwide' !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right 7 cols: Contact Form -->
                    <div class="lg:col-span-7">
                        <div
                            class="gd-contact-card p-8 sm:p-10 rounded-3xl bg-[#140f2b] border border-[#a855f7]/25 shadow-2xl">

                            <div id="contactFeedback" class="hidden mb-6"></div>

                            <form id="contactForm" action="{{ route('contact.submit') }}" method="POST"
                                class="space-y-5">
                                @csrf

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-xs font-mono text-slate-400 mb-1.5 font-semibold">Your
                                            Name *</label>
                                        <input type="text" name="name" required placeholder="Alex Morgan"
                                            class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-[#7c3aed] transition-colors">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-mono text-slate-400 mb-1.5 font-semibold">Your
                                            Email *</label>
                                        <input type="email" name="email" required placeholder="alex@company.com"
                                            class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-[#7c3aed] transition-colors">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label
                                            class="block text-xs font-mono text-slate-400 mb-1.5 font-semibold">Subject</label>
                                        <input type="text" name="subject" placeholder="New Project Inquiry"
                                            class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-[#7c3aed] transition-colors">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-mono text-slate-400 mb-1.5 font-semibold">Service
                                            Needed</label>
                                        <select name="service_type"
                                            class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-[#7c3aed] transition-colors">
                                            <option value="UI/UX Design" class="bg-[#140f2b]">UI/UX Design</option>
                                            <option value="Branding & Identity" class="bg-[#140f2b]">Branding & Identity
                                            </option>
                                            <option value="Mobile App Design" class="bg-[#140f2b]">Mobile App Design
                                            </option>
                                            <option value="Web Development" class="bg-[#140f2b]">Web Development</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-mono text-slate-400 mb-1.5 font-semibold">Your Message
                                        *</label>
                                    <textarea name="message" required rows="4"
                                        placeholder="Tell me about your project goals, timelines, and scope..."
                                        class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-[#7c3aed] transition-colors resize-none"></textarea>
                                </div>

                                <div class="pt-2">
                                    <button type="submit" class="gd-btn-primary w-full justify-center py-3.5 text-sm">
                                        <span>Send Message</span>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>

                <!-- Huge Watermark Typography at bottom (Matches uploaded design) -->
                <div class="w-full text-center py-10 overflow-hidden">
                    <div class="gd-watermark-text select-none">
                        {{ strtoupper($settings['footer_watermark'] ?? 'CRAFTING') }}
                    </div>
                </div>

            </div>
        </section>

        <!-- Dedicated Footer Section (Matches uploaded image design) -->
        @include('frontend.themes.graphic_designer.partials.footer')

    </div>
@endsection
