@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#080808] text-[#ffffff] min-h-screen selection:bg-[#ff6b00] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.app_software_developer.partials.header')

    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative overflow-hidden bg-gradient-to-b from-[#0a0a0a] to-[#080808]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <span class="badge-bracket-orange mb-3 block">{{ $settings['about_hero_tag'] ?? 'About Me' }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-white">
                {{ $settings['about_hero_title_line1'] ?? 'APP & SOFTWARE' }} <span class="text-[#ff6b00]">{{ $settings['about_hero_title_highlight'] ?? 'DEVELOPER' }}</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['about_hero_description'] ?? 'Over 8+ years designing and engineering high-load software applications, cloud microservices, and cross-platform mobile solutions.' }}
            </p>
        </div>
    </section>

    <!-- Biography & Collage -->
    <section class="py-20 bg-[#0a0a0a]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-5 relative">
                <div class="rounded-3xl overflow-hidden border border-white/10 shadow-2xl bg-[#111111]">
                    @php
                        $aboutImg = $settings['about_portrait_image'] ?? $settings['hero_image'] ?? null;
                    @endphp
                    @if($aboutImg && \Illuminate\Support\Str::startsWith($aboutImg, 'uploads/'))
                        <img src="{{ asset('storage/' . $aboutImg) }}" alt="{{ $settings['site_name'] ?? 'Software Developer' }}" class="w-full h-auto object-cover">
                    @elseif($aboutImg)
                        <img src="{{ asset($aboutImg) }}" alt="{{ $settings['site_name'] ?? 'Software Developer' }}" class="w-full h-auto object-cover">
                    @else
                        <img src="{{ asset('images/app_software_developer/hero.jpg') }}" alt="Developer" class="w-full h-auto object-cover">
                    @endif
                </div>
            </div>

            <div class="lg:col-span-7 space-y-6">
                <span class="badge-bracket-orange">{{ $settings['about_narrative_tag'] ?? 'Core Expertise' }}</span>
                <h2 class="text-3xl font-extrabold font-['Outfit'] text-white">{{ $settings['about_narrative_title'] ?? 'Engineering Next-Generation Software Ecosystems' }}</h2>
                <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed">
                    {{ $settings['about_narrative_description'] ?? 'Dedicated to architecting resilient software solutions with modern tech stacks. We implement strict domain-driven architectures, automated testing, containerized Docker pipelines, and sub-second API performance.' }}
                </p>

                <!-- Metadata Highlights -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs pt-2">
                    <div class="p-3.5 rounded-xl bg-[#111111] border border-white/5 flex items-center justify-between">
                        <span class="text-neutral-400 font-mono">Location:</span>
                        <span class="font-bold text-white">{{ $settings['contact_location'] ?? 'San Francisco, CA & Remote' }}</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-[#111111] border border-white/5 flex items-center justify-between">
                        <span class="text-neutral-400 font-mono">Availability:</span>
                        <span class="font-bold text-[#ff6b00] uppercase">{{ $settings['about_availability_status'] ?? 'Accepting Contracts' }}</span>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="{{ route('contact') }}" class="btn-orange-primary inline-flex items-center gap-2 px-8 py-3.5 rounded-xl text-xs font-black uppercase tracking-wider font-['Outfit']">
                        <span>{{ $settings['about_cta_btn_text'] ?? 'Get In Touch' }}</span> &rarr;
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.app_software_developer.partials.footer')

</div>
@endsection
