@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#070707] text-[#ffffff] min-h-screen selection:bg-[#00ff88] selection:text-[#070707] font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.developer.partials.header')


    <!-- Page Header -->
    <section class="py-20 border-b border-white/5 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block mb-2">// {{ $settings['portfolio_hero_tag'] ?? ($settings['portfolio_tag'] ?? 'SELECTED WORKS') }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight">
                {{ $settings['portfolio_hero_title_line1'] ?? 'PRODUCTION SYSTEMS &' }} <span class="text-[#00ff88]">{{ $settings['portfolio_hero_title_highlight'] ?? 'SOFTWARE' }}</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['portfolio_hero_description'] ?? ($settings['portfolio_subtitle'] ?? 'A showcase of deployed cloud platforms, real-time analytics engines, custom e-commerce applications, and high-load web architectures.') }}
            </p>
        </div>
    </section>

    <!-- Projects Grid (Browser Mockup Cards) -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $projectList = (isset($projects) && $projects->count() > 0) ? $projects : [
                    ['title' => 'Nordic Living E-Commerce', 'category' => 'Web Platform', 'tags' => 'Laravel, Vue.js, Tailwind', 'img' => 'https://images.unsplash.com/photo-1507652313519-d4e9174996dd?auto=format&fit=crop&w=700&q=80'],
                    ['title' => 'FinTrack Telemetry Dashboard', 'category' => 'SaaS Dashboard', 'tags' => 'PHP 8.2, MySQL, Redis', 'img' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=700&q=80'],
                    ['title' => 'Aether Cloud Agency Portal', 'category' => 'API & Cloud', 'tags' => 'AWS, Docker, REST API', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=700&q=80'],
                    ['title' => 'Steakhouse & Gourmet Bistro', 'category' => 'Ordering Portal', 'tags' => 'Tailwind, Laravel, Stripe', 'img' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=700&q=80'],
                    ['title' => 'Metropolis Real Estate Portal', 'category' => 'Enterprise System', 'tags' => 'Vue 3, GraphQL, Postgres', 'img' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=700&q=80'],
                    ['title' => 'OmniPulse IoT Telemetry Engine', 'category' => 'Microservice Stack', 'tags' => 'Kafka, Go, Docker', 'img' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=700&q=80'],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projectList as $proj)
                    @php
                        $title = is_array($proj) ? ($proj['title'] ?? '') : ($proj->title ?? '');
                        $category = is_array($proj) ? ($proj['category'] ?? '') : ($proj->category ?? 'Web Platform');
                        $img = is_array($proj) ? ($proj['img'] ?? ($proj['image'] ?? '')) : ($proj->image_url ?? ($proj->image ?? ''));
                        $tagsRaw = is_array($proj) ? ($proj['tags'] ?? '') : ($proj->tags ?? '');
                        $tags = is_array($tagsRaw) ? $tagsRaw : array_filter(array_map('trim', explode(',', (string) $tagsRaw)));
                    @endphp
                    <div class="rounded-3xl bg-[#111111] border border-white/10 overflow-hidden hover:border-[#00ff88]/40 transition-all group flex flex-col justify-between">
                        <div>
                            <!-- Mockup Browser Header -->
                            <div class="px-4 py-2.5 bg-[#171717] border-b border-white/5 flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500/80"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></span>
                                <span class="text-[10px] font-mono text-neutral-500 ml-2">https://app.glint.io/demo</span>
                            </div>
                            <div class="aspect-[16/11] bg-black/50 overflow-hidden relative">
                                <img src="{{ !empty($img) ? (str_starts_with($img, 'http') ? $img : asset($img)) : 'https://images.unsplash.com/photo-1507652313519-d4e9174996dd?auto=format&fit=crop&w=700&q=80' }}"
                                    alt="{{ $title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-6 space-y-3">
                                <span class="text-[10px] font-mono font-bold text-[#00ff88] uppercase">{{ $category }}</span>
                                <h3 class="text-xl font-bold font-['Outfit'] text-white group-hover:text-[#00ff88] transition-colors">{{ $title }}</h3>
                                @if(!empty($tags))
                                    <div class="flex flex-wrap gap-2 pt-1">
                                        @foreach($tags as $tag)
                                            <span class="px-2.5 py-0.5 rounded-md bg-white/5 text-[10px] font-mono text-neutral-400">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="p-6 pt-0">
                            <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#00ff88] uppercase tracking-wider hover:underline">
                                <span>{{ $settings['portfolio_cta_text'] ?? 'Request Architecture Tour' }}</span> ➔
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.developer.partials.footer')

</div>
@endsection
