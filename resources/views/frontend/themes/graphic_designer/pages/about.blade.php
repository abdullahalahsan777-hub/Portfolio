@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#0c0a18] text-[#f5f3ff] min-h-screen selection:bg-[#7c3aed] selection:text-white font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.graphic_designer.partials.header')


    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-widest block mb-2">
                {{ $settings['about_hero_tag'] ?? ($settings['about_tag'] ?? 'ABOUT THE STUDIO') }}
            </span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] tracking-tight">
                {{ $settings['about_hero_title_line1'] ?? 'Crafting Visual Legacies &' }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-fuchsia-400">{{ $settings['about_hero_title_highlight'] ?? 'Digital Art' }}</span>
            </h1>
            <p class="text-slate-300 text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['about_hero_description'] ?? 'Transforming brand stories into iconic visual narratives through thoughtful creative direction, brand identity systems, and interactive digital design.' }}
            </p>
        </div>
    </section>

    <!-- Bio & Visual Experience -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-5 relative">
                <div class="rounded-3xl overflow-hidden border border-[#a855f7]/30 bg-[#150f2c] aspect-[4/5] shadow-2xl">
                    <img
                        src="{{ !empty($settings['about_portrait_image']) ? (str_starts_with($settings['about_portrait_image'], 'http') ? $settings['about_portrait_image'] : asset($settings['about_portrait_image'])) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=80' }}"
                        alt="Studio Designer Portrait"
                        class="w-full h-full object-cover"
                    >
                </div>
            </div>
            <div class="lg:col-span-7 space-y-6">
                <span class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-widest block">
                    {{ $settings['about_narrative_tag'] ?? 'Artistic Journey' }}
                </span>
                <h2 class="text-3xl font-extrabold font-['Outfit']">
                    {{ $settings['about_narrative_title'] ?? ($settings['about_heading'] ?? 'Rooted in Typography, Elevated by Interaction') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    {{ $settings['about_narrative_description'] ?? ($settings['about_description'] ?? 'With over a decade dedicated to branding and visual identity, I believe every great digital product begins with a strong point of view. From bespoke typography treatments to fluid micro-animations, every touchpoint must evoke emotion and inspire action.') }}
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="p-5 rounded-2xl bg-[#150f2c] border border-white/5">
                        <span class="text-3xl font-black text-white font-['Outfit']">{{ $settings['about_stat1_value'] ?? '680+' }}</span>
                        <h4 class="text-xs font-bold text-white mt-1">{{ $settings['about_stat1_title'] ?? 'Creative Deliverables' }}</h4>
                        <p class="text-[11px] text-slate-400 mt-0.5">{{ $settings['about_stat1_subtext'] ?? 'Identities, packaging, and interactive design.' }}</p>
                    </div>
                    <div class="p-5 rounded-2xl bg-[#150f2c] border border-white/5">
                        <span class="text-3xl font-black text-white font-['Outfit']">{{ $settings['about_stat2_value'] ?? '18+' }}</span>
                        <h4 class="text-xs font-bold text-white mt-1">{{ $settings['about_stat2_title'] ?? 'Design Awards' }}</h4>
                        <p class="text-[11px] text-slate-400 mt-0.5">{{ $settings['about_stat2_subtext'] ?? 'Awwwards, FWA, and Behance Curator Picks.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer matching uploaded design image -->
    @include('frontend.themes.graphic_designer.partials.footer')

</div>
@endsection
