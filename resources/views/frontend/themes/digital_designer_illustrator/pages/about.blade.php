@extends('frontend.layouts.frontend')

@section('content')
<div class="ddi-page-wrap bg-[#cfd3d8] dark:bg-[#07080b] text-[#151618] dark:text-[#f1f5f9] min-h-screen selection:bg-[#e26d9b] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip relative transition-colors duration-300">

    <!-- Top Poppy Decoration Background -->
    <div class="absolute top-0 right-0 w-80 h-80 opacity-40 dark:opacity-15 pointer-events-none z-0">
        <img src="{{ asset('images/digital_designer_illustrator/flower.jpg') }}" alt="Poppy accent" class="w-full h-full object-contain">
    </div>

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.digital_designer_illustrator.partials.header')

    <!-- Hero / Title -->
    <section class="py-20 border-b border-black/10 dark:border-white/10 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block text-[11px] font-bold tracking-[0.25em] uppercase text-[#e26d9b] font-mono mb-3">
                {{ $settings['about_hero_tag'] ?? ('— About ' . ($settings['site_name'] ?? 'Alex Walker')) }}
            </span>
            <h1 class="text-4xl sm:text-6xl font-normal font-editorial tracking-tight text-[#151618] dark:text-white">
                {{ $settings['about_hero_title_line1'] ?? 'Crafting digital experiences &' }} <span class="italic text-[#e26d9b]">{{ $settings['about_hero_title_highlight'] ?? 'poetic visuals' }}</span>
            </h1>
            <p class="text-[#555a64] dark:text-[#9aa0aa] text-sm sm:text-base mt-4 max-w-2xl leading-relaxed">
                {{ $settings['about_hero_description'] ?? 'A multidisciplinary digital designer and illustrator specializing in brand identity, editorial layouts, 3D explorations, and interactive art direction.' }}
            </p>
        </div>
    </section>

    <!-- Biography & Philosophy Section -->
    <section class="py-20 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-5 relative">
                <div class="rounded-3xl overflow-hidden border border-black/10 dark:border-white/10 shadow-xl bg-white/40 dark:bg-white/[0.03] backdrop-blur-md p-2">
                    @php
                        $aboutImg = $settings['about_portrait_image'] ?? $settings['hero_image'] ?? null;
                    @endphp
                    @if($aboutImg && \Illuminate\Support\Str::startsWith($aboutImg, 'uploads/'))
                        <img src="{{ asset('storage/' . $aboutImg) }}" alt="{{ $settings['site_name'] ?? 'Alex Walker' }}" class="w-full h-auto rounded-2xl object-cover shadow-inner">
                    @elseif($aboutImg)
                        <img src="{{ asset($aboutImg) }}" alt="{{ $settings['site_name'] ?? 'Alex Walker' }}" class="w-full h-auto rounded-2xl object-cover shadow-inner">
                    @else
                        <img src="{{ asset('images/digital_designer_illustrator/hero_cards.jpg') }}" onerror="this.src='{{ asset('blayden/img/backgrounds/1400x1000_d02.webp') }}'" alt="Alex Walker Studio" class="w-full h-auto rounded-2xl object-cover shadow-inner">
                    @endif
                </div>
            </div>

            <div class="lg:col-span-7 space-y-6">
                <span class="inline-block text-[11px] font-bold tracking-[0.25em] uppercase text-[#e26d9b] font-mono">
                    {{ $settings['about_narrative_tag'] ?? '— Approach and philosophy' }}
                </span>
                <h2 class="text-3xl sm:text-4xl font-normal font-editorial text-[#151618] dark:text-white leading-tight">
                    {{ $settings['about_narrative_title'] ?? 'Where technological precision meets human emotion.' }}
                </h2>
                <p class="text-xs sm:text-sm text-[#4b505c] dark:text-[#9aa0aa] leading-relaxed">
                    {{ $settings['about_narrative_description'] ?? ($settings['about_bio'] ?? 'I believe memorable digital products come from deliberate restraint and unexpected warmth. From subtle micro-animations to tactile 3D elements, every detail serves to evoke joy and elevate the brand dialogue.') }}
                </p>

                <!-- Metadata Highlights -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs pt-4">
                    <div class="p-5 rounded-2xl bg-white/70 dark:bg-white/[0.04] backdrop-blur-md border border-black/10 dark:border-white/10 shadow-sm">
                        <span class="text-[#7d8492] dark:text-[#8d94a2] font-mono block text-[10px] uppercase tracking-wider mb-1">Studio Base</span>
                        <span class="font-bold text-[#151618] dark:text-white text-sm">{{ $settings['contact_location'] ?? 'London & Remote' }}</span>
                    </div>
                    <div class="p-5 rounded-2xl bg-white/70 dark:bg-white/[0.04] backdrop-blur-md border border-black/10 dark:border-white/10 shadow-sm">
                        <span class="text-[#7d8492] dark:text-[#8d94a2] font-mono block text-[10px] uppercase tracking-wider mb-1">Availability</span>
                        <span class="font-bold text-[#e26d9b] text-sm">{{ $settings['about_availability_status'] ?? 'Accepting Commissions' }}</span>
                    </div>
                </div>

                <div class="pt-4 flex items-center gap-4">
                    <a href="{{ route('contact') }}" class="btn-illustrator inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#111215] dark:bg-white !text-white dark:!text-[#111215] font-bold text-xs uppercase tracking-wider hover:bg-[#e26d9b] dark:hover:bg-[#e26d9b] dark:hover:!text-white transition-all shadow-md hover:-translate-y-0.5">
                        <span class="!text-white dark:!text-[#111215]">Get In Touch</span>
                        <i class="ph ph-arrow-right !text-white dark:!text-[#111215]"></i>
                    </a>
                    <a href="{{ route('portfolio') }}" class="px-6 py-3 rounded-full border border-black/15 dark:border-white/15 text-xs font-bold uppercase tracking-wider text-[#151618] dark:text-white hover:bg-black/5 dark:hover:bg-white/5 transition-all">
                        View Projects
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- Skills & Tools (Software & Creative Stack) -->
    <section class="toolkit-section py-20 lg:py-24 border-t border-black/10 dark:border-white/10 bg-[#c8ccd2]/70 dark:bg-[#06070a] relative z-10 backdrop-blur-md transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block text-[11px] font-bold tracking-[0.25em] uppercase text-[#e26d9b] font-mono mb-3">
                &mdash; Technical Toolkit
            </span>
            <h2 class="text-3xl sm:text-4xl font-normal font-editorial text-[#151618] dark:text-white mb-10">Software &amp; Creative Stack</h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">
                @foreach($skills as $skill)
                @php
                    $nameLower = strtolower($skill->name);
                    $iconConfig = [
                        'bg' => 'bg-[#181a20]',
                        'border' => 'border-white/15',
                        'text' => '!text-white',
                        'badge' => strtoupper(substr($skill->name, 0, 2)),
                        'sub' => ''
                    ];

                    if (str_contains($nameLower, 'figma')) {
                        $iconConfig = ['bg' => 'bg-[#1E1E1E]', 'border' => 'border-[#F24E1E]/40', 'text' => '!text-[#0ACF83]', 'badge' => 'Fg', 'sub' => 'Figma'];
                    } elseif (str_contains($nameLower, 'photoshop')) {
                        $iconConfig = ['bg' => 'bg-[#001E36]', 'border' => 'border-[#31A8FF]/40', 'text' => '!text-[#31A8FF]', 'badge' => 'Ps', 'sub' => 'Photoshop'];
                    } elseif (str_contains($nameLower, 'illustrator')) {
                        $iconConfig = ['bg' => 'bg-[#330000]', 'border' => 'border-[#FF9A00]/40', 'text' => '!text-[#FF9A00]', 'badge' => 'Ai', 'sub' => 'Illustrator'];
                    } elseif (str_contains($nameLower, 'cinema') || str_contains($nameLower, 'c4d')) {
                        $iconConfig = ['bg' => 'bg-[#05162E]', 'border' => 'border-[#00D4FF]/40', 'text' => '!text-[#00D4FF]', 'badge' => 'C4D', 'sub' => 'Cinema 4D'];
                    } elseif (str_contains($nameLower, 'after effect')) {
                        $iconConfig = ['bg' => 'bg-[#00005B]', 'border' => 'border-[#9999FF]/40', 'text' => '!text-[#9999FF]', 'badge' => 'Ae', 'sub' => 'After Effects'];
                    } elseif (str_contains($nameLower, 'blender')) {
                        $iconConfig = ['bg' => 'bg-[#222B35]', 'border' => 'border-[#EA7600]/40', 'text' => '!text-[#EA7600]', 'badge' => 'Bl', 'sub' => 'Blender'];
                    } elseif (str_contains($nameLower, 'html')) {
                        $iconConfig = ['bg' => 'bg-[#2d120a]', 'border' => 'border-[#E34F26]/60', 'text' => '!text-[#E34F26]', 'badge' => 'HT', 'sub' => 'HTML5'];
                    } elseif (str_contains($nameLower, 'css')) {
                        $iconConfig = ['bg' => 'bg-[#08182b]', 'border' => 'border-[#1572B6]/60', 'text' => '!text-[#2965f1]', 'badge' => 'CS', 'sub' => 'CSS3'];
                    } elseif (str_contains($nameLower, 'notion')) {
                        $iconConfig = ['bg' => 'bg-[#18181b]', 'border' => 'border-white/30', 'text' => '!text-white', 'badge' => 'NO', 'sub' => 'Notion'];
                    } elseif (str_contains($nameLower, 'indesign')) {
                        $iconConfig = ['bg' => 'bg-[#49021F]', 'border' => 'border-[#FF3366]/60', 'text' => '!text-[#FF3366]', 'badge' => 'Id', 'sub' => 'InDesign'];
                    } elseif (str_contains($nameLower, 'premiere')) {
                        $iconConfig = ['bg' => 'bg-[#00005B]', 'border' => 'border-[#9999FF]/60', 'text' => '!text-[#9999FF]', 'badge' => 'Pr', 'sub' => 'Premiere'];
                    } elseif (str_contains($nameLower, 'javascript') || str_contains($nameLower, 'js')) {
                        $iconConfig = ['bg' => 'bg-[#2b2705]', 'border' => 'border-[#F7DF1E]/60', 'text' => '!text-[#F7DF1E]', 'badge' => 'JS', 'sub' => 'JavaScript'];
                    } elseif (str_contains($nameLower, 'react')) {
                        $iconConfig = ['bg' => 'bg-[#062029]', 'border' => 'border-[#61DAFB]/60', 'text' => '!text-[#61DAFB]', 'badge' => 'Re', 'sub' => 'React'];
                    }
                @endphp
                <div class="software-card group relative p-6 rounded-3xl bg-white/70 dark:bg-[#0d0f14] backdrop-blur-xl border border-black/10 dark:border-white/10 hover:border-[#e26d9b]/50 dark:hover:border-[#e26d9b]/50 text-center hover:-translate-y-2 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-[#e26d9b]/10 transition-all duration-300 flex flex-col items-center">
                    
                    <!-- Creative Stack Icon Badge -->
                    <div class="w-14 h-14 mb-3.5 rounded-2xl {{ $iconConfig['bg'] }} {{ $iconConfig['border'] }} border shadow-md flex items-center justify-center font-bold text-base {{ $iconConfig['text'] }} group-hover:scale-110 transition-transform duration-300 relative overflow-hidden">
                        <span class="tracking-tight {{ $iconConfig['text'] }}">{{ $iconConfig['badge'] }}</span>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-white/15 pointer-events-none"></div>
                    </div>

                    <h4 class="text-xs sm:text-sm font-bold text-[#151618] dark:text-white truncate w-full group-hover:text-[#e26d9b] dark:group-hover:text-[#e26d9b] transition-colors">
                        {{ $skill->name }}
                    </h4>

                    <!-- Mastery Progress Bar -->
                    <div class="w-full bg-black/10 dark:bg-white/10 h-1 rounded-full overflow-hidden mt-3">
                        <div class="h-full bg-gradient-to-r from-[#e26d9b] to-[#f58eb2] rounded-full transition-all duration-700" style="width: {{ $skill->level ?? 90 }}%"></div>
                    </div>

                    <span class="text-[10px] text-[#7d8492] dark:text-[#9aa0aa] font-mono mt-2 block font-medium">
                        {{ $skill->level ?? 90 }}% Mastery
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.digital_designer_illustrator.partials.footer')

</div>
@endsection
