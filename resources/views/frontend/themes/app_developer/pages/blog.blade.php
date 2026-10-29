@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#070707] text-[#ffffff] min-h-screen selection:bg-[#ff0033] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.app_developer.partials.header')

    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative overflow-hidden bg-gradient-to-b from-[#0a0a0a] to-[#070707]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <span class="text-xs font-mono font-bold text-[#ff0033] uppercase tracking-widest block mb-2">// {{ $settings['blog_hero_tag'] ?? ($settings['blog_tag'] ?? 'TECHNICAL ARTICLES') }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-white">
                {{ $settings['blog_hero_title_line1'] ?? 'APP DEV &' }} <span class="text-[#ff0033]">{{ $settings['blog_hero_title_highlight'] ?? 'ENGINEERING BLOG' }}</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['blog_hero_description'] ?? ($settings['blog_subtitle'] ?? 'Deep dives into Flutter state management, React Native bridge architecture, Swift concurrency, and high-scale cloud backend performance.') }}
            </p>
        </div>
    </section>

    <!-- Blog Posts Grid -->
    <section class="py-20 bg-[#0a0a0a]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $displayPosts = $blogPosts ?? ($posts ?? collect());
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($displayPosts as $post)
                    @php
                        $image = is_array($post) ? ($post['image'] ?? '') : ($post->image ?? '');
                        $title = is_array($post) ? ($post['title'] ?? '') : ($post->title ?? '');
                        $slug = is_array($post) ? ($post['slug'] ?? '') : ($post->slug ?? '');
                        $category = is_array($post) ? ($post['category'] ?? '') : ($post->category ?? 'Tech');
                        $date = is_array($post) ? ($post['date'] ?? '') : ($post->date ?? '');
                        $readTime = is_array($post) ? ($post['read_time'] ?? '') : ($post->read_time ?? '5 min read');
                        $excerpt = is_array($post) ? ($post['excerpt'] ?? '') : ($post->excerpt ?? '');
                    @endphp
                    <div class="rounded-3xl bg-[#111111] border border-white/5 hover:border-[#ff0033]/40 transition-all overflow-hidden shadow-xl group flex flex-col justify-between">
                        <div>
                            <div class="relative h-52 overflow-hidden bg-black/40">
                                <img src="{{ !empty($image) ? (str_starts_with($image, 'http') ? $image : asset($image)) : 'https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=800&q=80' }}"
                                    alt="{{ $title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-mono font-bold uppercase bg-[#ff0033] text-white">
                                    {{ $category }}
                                </span>
                            </div>
                            <div class="p-6 space-y-2.5">
                                <span class="text-[11px] font-mono text-neutral-500 block">{{ $date }} &bull; {{ $readTime }}</span>
                                <h3 class="text-lg font-bold font-['Outfit'] text-white group-hover:text-[#ff0033] transition-colors leading-snug">
                                    {{ $title }}
                                </h3>
                                <p class="text-xs text-neutral-400 line-clamp-3 leading-relaxed">
                                    {{ $excerpt }}
                                </p>
                            </div>
                        </div>
                        <div class="p-6 pt-0">
                            <a href="{{ route('blog.detail', $slug) }}" class="inline-flex items-center gap-1.5 text-xs font-mono uppercase tracking-wider text-[#ff0033] font-bold hover:underline">
                                <span>{{ $settings['blog_read_more_text'] ?? 'Read Article' }}</span> &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-neutral-500 text-xs font-mono">
                        No articles published yet.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.app_developer.partials.footer')

</div>
@endsection
