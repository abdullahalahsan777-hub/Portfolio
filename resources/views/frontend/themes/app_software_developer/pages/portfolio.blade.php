@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#080808] text-[#ffffff] min-h-screen selection:bg-[#ff6b00] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.app_software_developer.partials.header')

    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative overflow-hidden bg-gradient-to-b from-[#0a0a0a] to-[#080808]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <span class="badge-bracket-orange mb-3 block">{{ $settings['portfolio_hero_tag'] ?? 'Selected Works' }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-white">
                {{ $settings['portfolio_hero_title_line1'] ?? 'SOFTWARE & APP' }} <span class="text-[#ff6b00]">{{ $settings['portfolio_hero_title_highlight'] ?? 'PORTFOLIO' }}</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['portfolio_hero_description'] ?? 'Featured mobile, web, and cloud software solutions built for fast-growing startups and global enterprises.' }}
            </p>
        </div>
    </section>

    <!-- Projects Grid -->
    <section class="py-20 bg-[#0a0a0a]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects as $project)
                    <div class="soft-card rounded-2xl overflow-hidden group">
                        <div class="relative h-64 overflow-hidden bg-black/80">
                            <img src="{{ $project->image_url ?? 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <span class="absolute top-4 left-4 px-3 py-1 rounded bg-[#ff6b00] text-white text-[10px] font-mono font-bold uppercase">
                                {{ $project->category ?? 'Software' }}
                            </span>
                        </div>
                        <div class="p-6 space-y-2">
                            <h3 class="text-lg font-bold font-['Outfit'] text-white group-hover:text-[#ff6b00] transition-colors">
                                {{ $project->title }}
                            </h3>
                            <p class="text-xs text-neutral-400 line-clamp-2 leading-relaxed">
                                {{ $project->description ?? 'Full-scale software development with seamless cloud database synchronization.' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-neutral-500">
                        No projects found.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.app_software_developer.partials.footer')

</div>
@endsection
