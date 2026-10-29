@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#0c0a18] text-[#f5f3ff] min-h-screen selection:bg-[#7c3aed] selection:text-white font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.graphic_designer.partials.header')


    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-widest block mb-2">
                {{ $settings['portfolio_hero_tag'] ?? ($settings['portfolio_tag'] ?? 'FEATURED WORKS') }}
            </span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] tracking-tight">
                {{ $settings['portfolio_hero_title_line1'] ?? 'Selected Works &' }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-fuchsia-400">{{ $settings['portfolio_hero_title_highlight'] ?? 'Design Systems' }}</span>
            </h1>
            <p class="text-slate-300 text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['portfolio_hero_description'] ?? ($settings['portfolio_subtitle'] ?? 'Explore recent visual identities, mobile interfaces, art direction, and typography projects built for forward-thinking clients.') }}
            </p>
        </div>
    </section>

    <!-- Works Grid -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($projects as $p)
                    <div class="gd-project-card group">
                        <div class="aspect-[16/10] overflow-hidden bg-black/40 relative">
                            <img
                                src="{{ $p->image_url ?? 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=800&q=80' }}"
                                alt="{{ $p->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 gd-project-img"
                            >
                            <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-mono font-bold bg-[#7c3aed] text-white">
                                {{ $p->category }}
                            </span>
                        </div>
                        <div class="p-6 flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-white group-hover:text-[#c084fc] transition-colors font-['Outfit']">{{ $p->title }}</h3>
                                <p class="text-xs text-slate-400 mt-1">{{ $p->subtitle ?? $p->description }}</p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-white/5 border border-white/10 group-hover:bg-[#7c3aed] flex items-center justify-center text-slate-300 group-hover:text-white transition-all gd-arrow-circle shrink-0">
                                ↗
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('frontend.themes.graphic_designer.partials.footer')

</div>
@endsection
