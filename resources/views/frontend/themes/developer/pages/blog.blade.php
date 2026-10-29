@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#070707] text-[#ffffff] min-h-screen selection:bg-[#00ff88] selection:text-[#070707] font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.developer.partials.header')


    <!-- Page Header -->
    <section class="py-20 border-b border-white/5 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block mb-2">// {{ $settings['blog_hero_tag'] ?? ($settings['blog_tag'] ?? 'TECHNICAL ARTICLES') }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight">
                {{ $settings['blog_hero_title_line1'] ?? 'CODE, ARCHITECTURE &' }} <span class="text-[#00ff88]">{{ $settings['blog_hero_title_highlight'] ?? 'ENGINEERING' }}</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['blog_hero_description'] ?? ($settings['blog_subtitle'] ?? 'In-depth articles covering PHP & Laravel internals, microservice scalability, query indexing, Docker pipelines, and modern frontend performance.') }}
            </p>
        </div>
    </section>

    <!-- Blog Posts Grid (Matching design with clean white card body) -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $displayPosts = $blogPosts ?? ($posts ?? collect());
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($displayPosts as $post)
                    @php
                        $image = is_array($post) ? ($post['image'] ?? '') : ($post->image ?? '');
                        $title = is_array($post) ? ($post['title'] ?? '') : ($post->title ?? '');
                        $slug = is_array($post) ? ($post['slug'] ?? '') : ($post->slug ?? '');
                        $category = is_array($post) ? ($post['category'] ?? '') : ($post->category ?? 'Engineering');
                        $date = is_array($post) ? ($post['date'] ?? '') : ($post->date ?? '');
                        $readTime = is_array($post) ? ($post['read_time'] ?? '') : ($post->read_time ?? '5 min read');
                        $excerpt = is_array($post) ? ($post['excerpt'] ?? '') : ($post->excerpt ?? '');
                    @endphp
                    <article class="rounded-3xl overflow-hidden border border-white/10 hover:border-[#00ff88]/40 transition-all group flex flex-col justify-between shadow-2xl bg-white">
                        <div>
                            <div class="aspect-[16/10] bg-neutral-900 overflow-hidden relative">
                                <img src="{{ !empty($image) ? (str_starts_with($image, 'http') ? $image : asset($image)) : 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=700&q=80' }}"
                                    alt="{{ $title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-[10px] font-mono font-bold bg-[#00ff88] text-[#070707]">
                                    {{ $category }}
                                </span>
                            </div>
                            <div class="p-6 space-y-2 bg-white text-[#070707]">
                                <span class="text-[10px] font-mono text-neutral-500 uppercase tracking-wider block">{{ $date }} &bull; {{ $readTime }}</span>
                                <h3 class="text-base font-black font-['Outfit'] text-[#070707] group-hover:text-emerald-700 transition-colors uppercase leading-snug line-clamp-2">
                                    {{ $title }}
                                </h3>
                                <p class="text-xs text-neutral-600 line-clamp-2 leading-relaxed">{{ $excerpt }}</p>
                            </div>
                        </div>
                        <div class="p-6 pt-0 bg-white">
                            <a href="{{ route('blog.detail', $slug) }}" class="inline-flex items-center gap-1.5 text-xs font-black text-emerald-600 uppercase tracking-wider hover:text-emerald-800 transition-colors">
                                <span>{{ $settings['blog_read_more_text'] ?? 'READ ARTICLE' }}</span> ➔
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-12 text-neutral-500 text-xs font-mono">
                        No articles published yet.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.developer.partials.footer')

</div>
@endsection
