@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#080808] text-white min-h-screen selection:bg-[#ccff00] selection:text-[#080808] font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.uiux_designer.partials.header')


    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block mb-2">{{ $settings['portfolio_hero_tag'] ?? ($settings['portfolio_tag'] ?? 'Showcase') }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] tracking-tight">
                {{ $settings['portfolio_hero_title_line1'] ?? 'Curated Works &' }} <span class="text-[#ccff00]">{{ $settings['portfolio_hero_title_highlight'] ?? 'Case Studies' }}</span>
            </h1>
            <p class="text-neutral-400 text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['portfolio_hero_description'] ?? ($settings['portfolio_subtitle'] ?? 'A selection of digital products, mobile applications, and enterprise design systems engineered for scale, usability, and business impact.') }}
            </p>
        </div>
    </section>

    <!-- Projects Grid -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($projects as $p)
                    <div class="uiux-project-item group p-6 rounded-3xl bg-[#111111] border border-white/10 hover:border-[#ccff00]/40 transition-all">
                        <div class="aspect-[16/10] rounded-2xl overflow-hidden bg-black/40 mb-6 relative">
                            <img
                                src="{{ $p->image_url ?? ($p->image ?? 'https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=800&q=80') }}"
                                alt="{{ $p->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                            <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-mono font-bold bg-[#ccff00] text-[#080808]">
                                {{ $p->category }}
                            </span>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-2xl font-bold font-['Outfit'] text-white group-hover:text-[#ccff00] transition-colors">{{ $p->title }}</h3>
                            <p class="text-xs text-neutral-400 leading-relaxed">{{ $p->description ?? $p->subtitle }}</p>
                            @if(!empty($p->tags))
                                <div class="flex flex-wrap gap-2 pt-3">
                                    @foreach(explode(',', (string) $p->tags) as $tag)
                                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-white/5 text-neutral-300">{{ trim($tag) }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-12 text-neutral-500 text-xs font-mono">
                        No projects found.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    @include('frontend.themes.uiux_designer.partials.footer')

</div>
@endsection
