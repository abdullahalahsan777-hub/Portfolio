@extends('frontend.layouts.frontend')

@section('content')
<div class="ddi-page-wrap bg-[#cfd3d8] dark:bg-[#07080b] text-[#151618] dark:text-[#f1f5f9] min-h-screen selection:bg-[#e26d9b] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip relative transition-colors duration-300">

    <!-- Top Poppy Decoration Background -->
    <div class="absolute top-0 right-0 w-80 h-80 opacity-40 dark:opacity-10 pointer-events-none z-0">
        <img src="{{ asset('images/digital_designer_illustrator/flower.jpg') }}" alt="Poppy accent" class="w-full h-full object-contain">
    </div>

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.digital_designer_illustrator.partials.header')

    <!-- Hero / Title -->
    <section class="py-20 border-b border-black/10 dark:border-white/10 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block text-[11px] font-bold tracking-[0.25em] uppercase text-[#e26d9b] font-mono mb-3">
                {{ $settings['portfolio_hero_tag'] ?? '— Selected Works' }}
            </span>
            <h1 class="text-4xl sm:text-6xl font-normal font-editorial tracking-tight text-[#151618] dark:text-white">
                {{ $settings['portfolio_hero_title_line1'] ?? 'Design, tech &' }} <span class="italic text-[#e26d9b]">{{ $settings['portfolio_hero_title_highlight'] ?? 'some magic' }}</span>
            </h1>
            <p class="text-[#555a64] dark:text-[#9aa0aa] text-sm sm:text-base mt-4 max-w-2xl leading-relaxed">
                {{ $settings['portfolio_hero_description'] ?? 'A curated archive of digital design, bespoke typography, art direction, and 3D visual campaigns created for brands worldwide.' }}
            </p>
        </div>
    </section>

    <!-- Projects Grid -->
    <section class="py-20 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects as $index => $project)
                @php
                    $img = $project->image_url ?? $project->image ?? null;
                    if ($img && !str_starts_with($img, 'http://') && !str_starts_with($img, 'https://')) {
                        $img = asset($img);
                    }

                    // Curated artistic gradient themes for projects without image thumbnails
                    $gradientThemes = [
                        ['from' => 'from-[#1e1324]', 'via' => 'via-[#14121a]', 'to' => 'to-[#0a0a0e]', 'accent' => '#e26d9b', 'icon' => 'ph-sparkle'],
                        ['from' => 'from-[#0e1c1b]', 'via' => 'via-[#101519]', 'to' => 'to-[#080b0d]', 'accent' => '#2dd4bf', 'icon' => 'ph-palette'],
                        ['from' => 'from-[#221612]', 'via' => 'via-[#181318]', 'to' => 'to-[#0b090a]', 'accent' => '#fb923c', 'icon' => 'ph-cube'],
                    ];
                    $t = $gradientThemes[$index % count($gradientThemes)];
                @endphp
                <div class="portfolio-card group relative rounded-3xl overflow-hidden p-5 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl bg-white/70 dark:bg-[#0c0e13] backdrop-blur-xl border border-black/10 dark:border-white/10 hover:border-[#e26d9b]/50 dark:hover:border-[#e26d9b]/50 flex flex-col justify-between">
                    
                    <div>
                        <!-- Media Card Container -->
                        <div class="relative rounded-2xl overflow-hidden aspect-[4/3] mb-5 shadow-inner">
                            @if($img)
                                <img src="{{ $img }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent pointer-events-none"></div>
                            @else
                                <!-- Elegant Generative Dark Editorial Visual -->
                                <div class="portfolio-card-canvas w-full h-full relative overflow-hidden bg-gradient-to-br {{ $t['from'] }} {{ $t['via'] }} {{ $t['to'] }} flex flex-col justify-between p-6">
                                    <div class="flex items-center justify-between relative z-10">
                                        <span class="text-[10px] font-mono tracking-widest uppercase !text-white/60">
                                            Vol. 0{{ $index + 1 }}
                                        </span>
                                        <i class="ph {{ $t['icon'] }} text-base !text-white drop-shadow-sm"></i>
                                    </div>
                                    <div class="space-y-1 relative z-10">
                                        <span class="text-[10px] font-mono uppercase tracking-widest !text-[#e26d9b] block font-semibold">Concept Archive</span>
                                        <h4 class="font-editorial text-2xl sm:text-3xl font-light italic !text-white leading-tight drop-shadow-md">
                                            {{ $project->title }}
                                        </h4>
                                    </div>
                                    <div class="absolute -bottom-8 -right-8 w-32 h-32 rounded-full bg-[{{ $t['accent'] }}]/20 blur-xl pointer-events-none"></div>
                                </div>
                            @endif

                            <!-- Floating Arrow Badge Pill -->
                            <a href="{{ $project->project_url ?? $project->demo_url ?? '#' }}" class="portfolio-arrow-btn absolute top-3.5 right-3.5 w-10 h-10 rounded-full bg-white/90 dark:bg-[#15171f] backdrop-blur-md text-[#151618] dark:text-white border border-black/10 dark:border-white/15 flex items-center justify-center text-sm shadow-md group-hover:bg-[#e26d9b] dark:group-hover:bg-[#e26d9b] group-hover:text-white group-hover:border-[#e26d9b] group-hover:rotate-45 transition-all duration-300 z-10" title="View Project">
                                <i class="ph ph-arrow-up-right text-base"></i>
                            </a>
                        </div>

                        <!-- Card Meta & Content -->
                        <div class="px-1 space-y-2">
                            <span class="text-[10px] font-mono uppercase tracking-widest text-[#e26d9b] font-semibold block">
                                {{ $project->category ?? 'Brand Identity' }}
                            </span>
                            <h3 class="font-normal font-editorial text-xl sm:text-2xl text-[#151618] dark:text-white group-hover:text-[#e26d9b] dark:group-hover:text-[#e26d9b] transition-colors leading-snug">
                                {{ $project->title }}
                            </h3>
                            <p class="text-xs text-[#595f6c] dark:text-[#9aa0aa] line-clamp-2 leading-relaxed">
                                {{ $project->description }}
                            </p>
                        </div>
                    </div>

                    <!-- Card Footer Row -->
                    <div class="px-1 pt-4 mt-4 border-t border-black/5 dark:border-white/10 flex items-center justify-between text-xs">
                        <span class="text-[11px] font-mono text-[#787f8d] dark:text-[#8d94a2]">
                            {{ $project->theme ?? 'Featured Work' }}
                        </span>
                        <a href="{{ $project->project_url ?? $project->demo_url ?? '#' }}" class="font-bold text-[#151618] dark:text-white hover:text-[#e26d9b] dark:hover:text-[#e26d9b] inline-flex items-center gap-1 transition-colors">
                            <span>Explore Case</span>
                            <i class="ph ph-arrow-up-right text-xs"></i>
                        </a>
                    </div>

                </div>
                @empty
                <div class="col-span-full text-center py-20 rounded-3xl bg-white/60 dark:bg-white/[0.04] border border-black/10 dark:border-white/10 text-xs text-[#6a717e] dark:text-[#888e9b]">
                    No projects found for this theme yet. Add projects from the Admin Panel.
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.digital_designer_illustrator.partials.footer')

</div>
@endsection
