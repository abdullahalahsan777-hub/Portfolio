@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#070707] text-[#ffffff] min-h-screen selection:bg-[#ff0033] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.app_developer.partials.header')

    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative overflow-hidden bg-gradient-to-b from-[#0a0a0a] to-[#070707]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <span class="text-xs font-mono font-bold text-[#ff0033] uppercase tracking-widest block mb-2">// {{ $settings['portfolio_hero_tag'] ?? ($settings['portfolio_tag'] ?? 'SELECTED WORKS') }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-white">
                {{ $settings['portfolio_hero_title_line1'] ?? 'FEATURED' }} <span class="text-[#ff0033]">{{ $settings['portfolio_hero_title_highlight'] ?? 'PORTFOLIO' }}</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['portfolio_hero_description'] ?? ($settings['portfolio_subtitle'] ?? 'Explore production applications deployed to the iOS App Store, Google Play Store, and modern enterprise web environments.') }}
            </p>
        </div>
    </section>

    <!-- Projects Grid -->
    <section class="py-20 bg-[#0a0a0a]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects as $project)
                    <div class="rounded-3xl bg-[#111111] border border-white/5 hover:border-[#ff0033]/50 transition-all overflow-hidden shadow-2xl group flex flex-col justify-between">
                        <div class="relative h-60 overflow-hidden bg-black/40">
                            <img 
                                src="{{ $project->image_url ?? 'https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=800&q=80' }}" 
                                alt="{{ $project->title }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                            >
                            <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-mono font-bold uppercase bg-[#ff0033] text-white">
                                {{ $project->category }}
                            </span>
                        </div>
                        <div class="p-6 space-y-3">
                            <h3 class="text-lg font-bold font-['Outfit'] text-white group-hover:text-[#ff0033] transition-colors">
                                {{ $project->title }}
                            </h3>
                            <p class="text-xs text-neutral-400 line-clamp-2">
                                {{ $project->description ?? $project->subtitle ?? 'Enterprise application with real-time synchronization and offline support.' }}
                            </p>
                            <div class="pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                                <span class="text-neutral-500 font-mono text-[11px]">{{ $project->tags ?? 'Mobile App' }}</span>
                                <a href="{{ $project->demo_url ?? route('contact') }}" target="_blank" class="text-[#ff0033] font-bold font-mono hover:underline inline-flex items-center gap-1">
                                    <span>Explore</span> &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-3 text-center text-neutral-500 text-xs font-mono py-12">No projects found for this theme.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.app_developer.partials.footer')

</div>
@endsection
