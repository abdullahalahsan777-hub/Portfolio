@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#080808] text-white min-h-screen selection:bg-[#ccff00] selection:text-[#080808] font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.uiux_designer.partials.header')


    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block mb-2">{{ $settings['about_hero_tag'] ?? ($settings['about_tag'] ?? 'Who I Am') }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] tracking-tight">
                {{ $settings['about_hero_title_line1'] ?? 'Architecting Frictionless' }} <span class="text-[#ccff00]">{{ $settings['about_hero_title_highlight'] ?? 'Digital Systems' }}</span>
            </h1>
            <p class="text-neutral-400 text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['about_hero_description'] ?? ($settings['about_description'] ?? 'With over a decade of specialized experience in human-computer interaction, I turn complex business requirements into intuitive, tested, and high-conversion product interfaces.') }}
            </p>
        </div>
    </section>

    <!-- Detailed Biography & Philosophy -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-5">
                <div class="rounded-3xl overflow-hidden border border-white/10 bg-[#121212] aspect-[4/5] relative">
                    <img
                        src="{{ !empty($settings['about_portrait_image']) ? (str_starts_with($settings['about_portrait_image'], 'http') ? $settings['about_portrait_image'] : asset($settings['about_portrait_image'])) : (!empty($settings['about_image']) ? (str_starts_with($settings['about_image'], 'http') ? $settings['about_image'] : asset($settings['about_image'])) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=80') }}"
                        alt="{{ $settings['about_narrative_title'] ?? 'Roy C. Jones Biography' }}"
                        class="w-full h-full object-cover filter contrast-105"
                    >
                </div>
            </div>
            <div class="lg:col-span-7 space-y-6">
                <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block">{{ $settings['about_narrative_tag'] ?? 'My Philosophy' }}</span>
                <h2 class="text-3xl font-extrabold font-['Outfit']">{{ $settings['about_narrative_title'] ?? ($settings['about_heading'] ?? 'Design That Anticipates User Needs') }}</h2>
                <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed">
                    {{ $settings['about_narrative_description'] ?? ($settings['about_description'] ?? 'Great product design is not about decoration—it is about clarity, speed, and cognitive ergonomics. Every button position, typography scale ratio, and interaction curve must work harmoniously to guide the user naturally towards their objective.') }}
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="p-4 rounded-2xl bg-[#121212] border border-white/5">
                        <span class="text-2xl font-black text-[#ccff00] font-['Outfit']">{{ $settings['about_stat1_value'] ?? ($settings['experience_years'] ?? '12+') }}</span>
                        <h4 class="text-xs font-bold text-white mt-1">{{ $settings['about_stat1_label'] ?? 'Years Field Leadership' }}</h4>
                        <p class="text-[11px] text-neutral-400 mt-0.5">{{ $settings['about_stat1_desc'] ?? 'Leading design sprints from seed stage to IPO.' }}</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-[#121212] border border-white/5">
                        <span class="text-2xl font-black text-[#ccff00] font-['Outfit']">{{ $settings['about_stat2_value'] ?? ($settings['completed_projects'] ?? '150+') }}</span>
                        <h4 class="text-xs font-bold text-white mt-1">{{ $settings['about_stat2_label'] ?? 'Shipped Interfaces' }}</h4>
                        <p class="text-[11px] text-neutral-400 mt-0.5">{{ $settings['about_stat2_desc'] ?? 'SaaS platforms, mobile apps, and design tokens.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- My Design Process (5 Steps) -->
    <section class="py-20 bg-[#0c0c0c] border-t border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-14">
                <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block mb-2">Methodology</span>
                <h2 class="text-3xl font-extrabold font-['Outfit']">My 5-Step Product Process</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                @php
                    $steps = [
                        ['num' => '01', 'title' => 'Discovery & Audit', 'desc' => 'Stakeholder alignment, analytics review, and competitor benchmarking.'],
                        ['num' => '02', 'title' => 'User Research', 'desc' => 'Personas, user journey maps, and behavioral heuristics.'],
                        ['num' => '03', 'title' => 'Wireframing', 'desc' => 'Rapid iterative low-fidelity flows and spatial architecture.'],
                        ['num' => '04', 'title' => 'Design System', 'desc' => 'Atomic Figma tokens, states, accessibility validation, and prototypes.'],
                        ['num' => '05', 'title' => 'Handoff & Support', 'desc' => 'Engineering spec handoff, QA walk-throughs, and post-launch analytics.'],
                    ];
                @endphp
                @foreach($steps as $s)
                    <div class="p-6 rounded-2xl bg-[#121212] border border-white/5 space-y-3">
                        <span class="text-xs font-mono font-bold text-[#ccff00]">{{ $s['num'] }}</span>
                        <h4 class="text-sm font-bold text-white font-['Outfit']">{{ $s['title'] }}</h4>
                        <p class="text-xs text-neutral-400 leading-relaxed">{{ $s['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('frontend.themes.uiux_designer.partials.footer')

</div>
@endsection
