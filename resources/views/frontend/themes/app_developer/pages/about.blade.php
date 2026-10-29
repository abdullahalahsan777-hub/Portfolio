@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#070707] text-[#ffffff] min-h-screen selection:bg-[#ff0033] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.app_developer.partials.header')

    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative overflow-hidden bg-gradient-to-b from-[#0a0a0a] to-[#070707]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <span class="text-xs font-mono font-bold text-[#ff0033] uppercase tracking-widest block mb-2">// {{ $settings['about_hero_tag'] ?? ($settings['about_tag'] ?? 'WHO AM I ?') }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-white">
                {{ $settings['about_hero_title_line1'] ?? 'MOBILE & APP' }} <span class="text-[#ff0033]">{{ $settings['about_hero_title_highlight'] ?? 'DEVELOPMENT ARCHITECT' }}</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['about_hero_description'] ?? ($settings['about_description'] ?? 'Engineering seamless, touch-first mobile experiences on iOS and Android with scalable cloud backends, real-time sync, and fluid animations.') }}
            </p>
        </div>
    </section>

    <!-- Biography & Collage -->
    <section class="py-20 bg-[#0a0a0a]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-6 grid grid-cols-2 gap-4">
                <!-- 1. Collab Team Photo -->
                <div class="rounded-3xl overflow-hidden border border-white/10 shadow-xl bg-[#111111] h-48 sm:h-56 group">
                    <img src="{{ !empty($settings['about_image']) ? asset($settings['about_image']) : (!empty($settings['about_collab_image']) ? asset($settings['about_collab_image']) : asset('images/app_developer/collab.jpg')) }}" alt="Engineering Collaboration" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>

                <!-- 2. PROJECT COMPLETED Stat Card (Centered 15K & PROJECT COMPLETED) -->
                <div class="p-6 sm:p-8 rounded-3xl bg-[#0f0f0f] border border-white/10 shadow-xl flex flex-col items-center justify-center text-center space-y-2 hover:border-[#ff0033]/50 transition-colors h-48 sm:h-56">
                    <span class="text-6xl sm:text-7xl font-black font-headline text-white leading-none tracking-tight">{{ strtoupper($settings['about_stat1_value'] ?? ($settings['completed_projects'] ?? '15K')) }}</span>
                    <span class="text-xs sm:text-sm font-headline uppercase tracking-wider text-[#ff0033] font-bold block mt-1">{{ $settings['about_stat1_label'] ?? ($settings['completed_projects_label'] ?? ($settings['counter1_title'] ?? 'PROJECT COMPLETED')) }}</span>
                </div>

                <!-- 3. OUR HAPPY CLIENTS Stat Card (Centered 99 & OUR HAPPY CLIENTS) -->
                <div class="p-6 sm:p-8 rounded-3xl bg-[#0f0f0f] border border-white/10 shadow-xl flex flex-col items-center justify-center text-center space-y-2 hover:border-[#ff0033]/50 transition-colors h-48 sm:h-56">
                    <span class="text-6xl sm:text-7xl font-black font-headline text-white leading-none tracking-tight">{{ $settings['about_stat2_value'] ?? ($settings['satisfied_clients'] ?? '99') }}</span>
                    <span class="text-xs sm:text-sm font-headline uppercase tracking-wider text-[#ff0033] font-bold block mt-1">{{ $settings['about_stat2_label'] ?? ($settings['satisfied_clients_label'] ?? ($settings['counter2_title'] ?? 'OUR HAPPY CLIENTS')) }}</span>
                </div>

                <!-- 4. 3D Isometric Red Bar Chart -->
                <div class="rounded-3xl overflow-hidden border border-white/10 shadow-xl bg-[#111111] h-48 sm:h-56 group">
                    <img src="{{ !empty($settings['about_chart_image']) ? asset($settings['about_chart_image']) : asset('images/app_developer/chart.jpg') }}" alt="3D Red Bar Chart Metrics" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
            </div>

            <div class="lg:col-span-6 space-y-6">
                <span class="text-xs font-mono font-bold text-[#ff0033] uppercase tracking-widest block">// {{ $settings['about_narrative_tag'] ?? 'CORE EXPERTISE' }}</span>
                <h2 class="text-3xl font-extrabold font-['Outfit'] uppercase text-white">{{ $settings['about_narrative_title'] ?? ($settings['about_heading'] ?? 'Delivering World-Class App Ecosystems') }}</h2>
                <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed">
                    {{ $settings['about_narrative_description'] ?? ($settings['about_description'] ?? 'Over 8+ years building enterprise and consumer apps with Flutter, React Native, Swift, Kotlin, and Laravel cloud APIs. Every project adheres to strict design tokens, clean modular codebases, automated unit tests, and rigorous security standards.') }}
                </p>

                <!-- Metadata Highlights -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs pt-2">
                    <div class="p-3.5 rounded-xl bg-[#111111] border border-white/5 flex items-center justify-between">
                        <span class="text-neutral-500 font-mono">Location:</span>
                        <span class="font-bold text-white">San Francisco, CA &amp; Remote</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-[#111111] border border-white/5 flex items-center justify-between">
                        <span class="text-neutral-500 font-mono">Availability:</span>
                        <span class="font-bold text-[#ff0033] uppercase">Accepting Contracts</span>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full text-xs font-black uppercase tracking-wider bg-gradient-to-r from-[#ff0033] to-[#e60026] text-white shadow-xl shadow-[#ff0033]/25 hover:scale-105 transition-all">
                        <span>Get In Touch</span> &rarr;
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.app_developer.partials.footer')

</div>
@endsection
