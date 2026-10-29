@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#070707] text-[#ffffff] min-h-screen selection:bg-[#00ff88] selection:text-[#070707] font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.developer.partials.header')


    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block mb-2">// {{ $settings['about_hero_tag'] ?? ($settings['about_tag'] ?? 'TECHNICAL PROFILE') }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight">
                {{ $settings['about_hero_title_line1'] ?? 'FULL-STACK ARCHITECTURE &' }} <span class="text-[#00ff88]">{{ $settings['about_hero_title_highlight'] ?? 'ENGINEERING' }}</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['about_hero_description'] ?? ($settings['about_description'] ?? 'Specialized in building robust Laravel backends, decoupled cloud microservices, performant Vue/React interfaces, and highly-indexed relational databases.') }}
            </p>
        </div>
    </section>

    <!-- Biography & Competencies -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-5">
                <div class="rounded-3xl overflow-hidden border-2 border-white/10 bg-[#111111] aspect-[3/4] shadow-2xl">
                    <img
                        src="{{ !empty($settings['about_portrait_image']) ? (str_starts_with($settings['about_portrait_image'], 'http') ? $settings['about_portrait_image'] : asset($settings['about_portrait_image'])) : (!empty($settings['about_image']) ? (str_starts_with($settings['about_image'], 'http') ? $settings['about_image'] : asset($settings['about_image'])) : (file_exists(public_path('images/themes/developer/hero_portrait.jpg')) ? asset('images/themes/developer/hero_portrait.jpg') : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80')) }}"
                        alt="{{ $settings['about_narrative_title'] ?? 'Developer Portrait' }}"
                        class="w-full h-full object-cover object-top"
                    >
                </div>
            </div>
            <div class="lg:col-span-7 space-y-6">
                <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block">// {{ $settings['about_narrative_tag'] ?? 'CORE EXPERTISE' }}</span>
                <h2 class="text-3xl font-extrabold font-['Outfit'] uppercase">{{ $settings['about_narrative_title'] ?? ($settings['about_heading'] ?? 'Engineering for Scalability, Speed & Security') }}</h2>
                <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed">
                    {{ $settings['about_narrative_description'] ?? ($settings['about_description'] ?? 'Over 10+ years crafting custom web applications with sub-second page loads, automated CI/CD pipelines, and secure database indexing. Whether developing a multi-vendor marketplace or an API-driven SaaS dashboard, clean code and architecture are at the heart of everything.') }}
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="p-5 rounded-2xl bg-[#111111] border border-white/5 space-y-1">
                        <span class="text-3xl font-black text-[#00ff88] font-['Outfit']">{{ $settings['about_stat1_value'] ?? ($settings['completed_projects'] ?? '140+') }}</span>
                        <h4 class="text-xs font-bold text-white uppercase">{{ $settings['about_stat1_label'] ?? 'Web Applications Built' }}</h4>
                        <p class="text-[11px] text-neutral-400">{{ $settings['about_stat1_desc'] ?? 'Custom Laravel, PHP, Docker & Vue systems.' }}</p>
                    </div>
                    <div class="p-5 rounded-2xl bg-[#111111] border border-white/5 space-y-1">
                        <span class="text-3xl font-black text-[#00ff88] font-['Outfit']">{{ $settings['about_stat2_value'] ?? ($settings['satisfied_clients'] ?? '99.9%') }}</span>
                        <h4 class="text-xs font-bold text-white uppercase">{{ $settings['about_stat2_label'] ?? 'Uptime Reliability' }}</h4>
                        <p class="text-[11px] text-neutral-400">{{ $settings['about_stat2_desc'] ?? 'Optimized caching with Redis and AWS CloudFront.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.developer.partials.footer')

</div>
@endsection
