@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#cfd3d8] dark:bg-[#0c0d10] text-[#151618] dark:text-[#f1f5f9] min-h-screen selection:bg-[#e26d9b] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip relative transition-colors duration-300">

    <!-- Top Poppy Decoration Background -->
    <div class="absolute top-0 right-0 w-80 h-80 opacity-40 pointer-events-none z-0">
        <img src="{{ asset('images/digital_designer_illustrator/flower.jpg') }}" alt="Poppy accent" class="w-full h-full object-contain">
    </div>

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.digital_designer_illustrator.partials.header')

    <!-- Hero / Title -->
    <section class="py-20 border-b border-black/5 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block text-[11px] font-bold tracking-[0.25em] uppercase text-[#6f7582] mb-3">
                {{ $settings['blog_hero_tag'] ?? '— Journal & Notes' }}
            </span>
            <h1 class="text-4xl sm:text-6xl font-normal font-['Syne'] tracking-tight text-[#151618] dark:text-white">
                {{ $settings['blog_hero_title_line1'] ?? 'Thoughts on design,' }} <span class="italic text-[#e26d9b]">{{ $settings['blog_hero_title_highlight'] ?? 'art & culture' }}</span>
            </h1>
            <p class="text-[#555a64] dark:text-[#9aa0aa] text-sm sm:text-base mt-4 max-w-2xl leading-relaxed">
                {{ $settings['blog_hero_description'] ?? 'Essays, technical insights, and visual experiments exploring typography, spatial design, and creative direction.' }}
            </p>
        </div>
    </section>

    <!-- Blog Posts Grid -->
    <section class="py-20 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $displayPosts = $blogPosts ?? ($posts ?? collect());
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($displayPosts as $post)
                    @php
                        $isArr = is_array($post);
                        $title = $isArr ? ($post['title'] ?? '') : $post->title;
                        $slug = $isArr ? ($post['slug'] ?? '#') : ($post->slug ?? '#');
                        $image = $isArr ? ($post['image'] ?? '') : ($post->featured_image_url ?? $post->image ?? '');
                        $category = $isArr ? ($post['category'] ?? 'Design') : ($post->category->name ?? 'Design');
                        $date = $isArr ? ($post['date'] ?? '') : ($post->created_at ? $post->created_at->format('M d, Y') : '');
                        $readTime = $isArr ? ($post['read_time'] ?? '5 min read') : '5 min read';
                        $excerpt = $isArr ? ($post['excerpt'] ?? '') : ($post->excerpt ?? Str::limit(strip_tags($post->content ?? ''), 120));
                        $author = $isArr ? ($post['author'] ?? ($settings['site_name'] ?? 'Alex Walker')) : ($settings['site_name'] ?? 'Alex Walker');
                    @endphp
                    <article class="ddi-card-frost rounded-3xl overflow-hidden p-4 group transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl flex flex-col justify-between">
                        <div>
                            <div class="relative rounded-2xl overflow-hidden aspect-[16/10] bg-[#bcc1c9] mb-4">
                                <img src="{{ $image ?: 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-white/80 backdrop-blur-md text-[10px] font-bold uppercase tracking-wider text-[#151618]">
                                    {{ $category }}
                                </span>
                            </div>
                            <div class="px-2">
                                <div class="flex items-center gap-3 text-[11px] text-[#787f8d] mb-2 font-mono">
                                    <span>{{ $date }}</span>
                                    <span>•</span>
                                    <span>{{ $readTime }}</span>
                                </div>
                                <h3 class="font-normal font-['Syne'] text-xl text-[#151618] dark:text-white group-hover:text-[#e26d9b] transition-colors leading-snug">
                                    <a href="{{ route('blog.detail', $slug) }}">
                                        {{ $title }}
                                    </a>
                                </h3>
                                <p class="text-xs text-[#595f6c] dark:text-[#9aa0aa] mt-2 line-clamp-2 leading-relaxed">
                                    {{ $excerpt }}
                                </p>
                            </div>
                        </div>
                        <div class="px-2 pt-4 mt-4 border-t border-black/5 dark:border-white/5 flex items-center justify-between">
                            <span class="text-xs font-bold text-[#151618] dark:text-white">{{ $author }}</span>
                            <a href="{{ route('blog.detail', $slug) }}" class="text-xs font-bold text-[#e26d9b] hover:underline flex items-center gap-1">
                                {{ $settings['blog_read_more_text'] ?? 'Read Essay' }} &rarr;
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-12 text-neutral-500">
                        No articles published yet.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.digital_designer_illustrator.partials.footer')

</div>
@endsection
