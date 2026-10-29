@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#080808] text-[#ffffff] min-h-screen selection:bg-[#ff6b00] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.app_software_developer.partials.header')

    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative overflow-hidden bg-gradient-to-b from-[#0a0a0a] to-[#080808]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <span class="badge-bracket-orange mb-3 block">{{ $settings['blog_hero_tag'] ?? 'Insights & Engineering' }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-white">
                {{ $settings['blog_hero_title_line1'] ?? 'SOFTWARE' }} <span class="text-[#ff6b00]">{{ $settings['blog_hero_title_highlight'] ?? 'INSIGHTS' }}</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['blog_hero_description'] ?? 'Deep dives into distributed architecture, mobile development workflows, and modern cloud engineering.' }}
            </p>
        </div>
    </section>

    <!-- Blog Articles Grid -->
    <section class="py-20 bg-[#0a0a0a]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $displayPosts = $blogPosts ?? ($posts ?? collect());
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($displayPosts as $post)
                    @php
                        $isArr = is_array($post);
                        $title = $isArr ? ($post['title'] ?? '') : $post->title;
                        $slug = $isArr ? ($post['slug'] ?? '#') : ($post->slug ?? '#');
                        $image = $isArr ? ($post['image'] ?? '') : ($post->featured_image_url ?? $post->image ?? '');
                        $category = $isArr ? ($post['category'] ?? 'Engineering') : ($post->category->name ?? 'Engineering');
                        $date = $isArr ? ($post['date'] ?? '') : ($post->created_at ? $post->created_at->format('M d, Y') : '');
                        $readTime = $isArr ? ($post['read_time'] ?? '5 min read') : '5 min read';
                        $excerpt = $isArr ? ($post['excerpt'] ?? '') : ($post->excerpt ?? Str::limit(strip_tags($post->content ?? ''), 120));
                    @endphp
                    <div class="soft-card rounded-2xl overflow-hidden group flex flex-col justify-between">
                        <div>
                            <div class="relative h-56 overflow-hidden bg-black/80">
                                <img src="{{ $image ?: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                <span class="absolute top-4 left-4 px-3 py-1 rounded bg-[#ff6b00] text-white text-[10px] font-mono font-bold uppercase">
                                    {{ $category }}
                                </span>
                            </div>
                            <div class="p-6 space-y-2.5">
                                <span class="text-[11px] font-mono text-neutral-400 block">{{ $date }} &bull; {{ $readTime }}</span>
                                <h3 class="text-base font-bold font-['Outfit'] text-white group-hover:text-[#ff6b00] transition-colors leading-snug">
                                    {{ $title }}
                                </h3>
                                <p class="text-xs text-neutral-400 line-clamp-3 leading-relaxed">
                                    {{ $excerpt }}
                                </p>
                            </div>
                        </div>
                        <div class="p-6 pt-0 border-t border-white/5 mt-2">
                            <a href="{{ route('blog.detail', $slug) }}" class="inline-flex items-center gap-1.5 text-xs font-mono uppercase tracking-wider text-[#ff6b00] font-bold hover:underline">
                                <span>{{ $settings['blog_read_more_text'] ?? 'Read Article' }}</span> &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-neutral-500">
                        No articles published yet.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.app_software_developer.partials.footer')

</div>
@endsection
