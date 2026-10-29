@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#080808] text-white min-h-screen selection:bg-[#ccff00] selection:text-[#080808] font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.uiux_designer.partials.header')


    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block mb-2">{{ $settings['blog_hero_tag'] ?? ($settings['blog_tag'] ?? 'Editorial') }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] tracking-tight">
                {{ $settings['blog_hero_title_line1'] ?? 'Insights, Research &' }} <span class="text-[#ccff00]">{{ $settings['blog_hero_title_highlight'] ?? 'Design Thinking' }}</span>
            </h1>
            <p class="text-neutral-400 text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['blog_hero_description'] ?? ($settings['blog_subtitle'] ?? 'Reflections on interface ergonomics, design token architecture, usability testing methodologies, and digital product strategy.') }}
            </p>
        </div>
    </section>

    <!-- Blog Articles Grid -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $displayPosts = $blogPosts ?? ($posts ?? collect());
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($displayPosts as $post)
                    @php
                        $image = is_array($post) ? ($post['image'] ?? '') : ($post->image ?? '');
                        $title = is_array($post) ? ($post['title'] ?? '') : ($post->title ?? '');
                        $slug = is_array($post) ? ($post['slug'] ?? '') : ($post->slug ?? '');
                        $category = is_array($post) ? ($post['category'] ?? '') : ($post->category ?? 'Design');
                        $date = is_array($post) ? ($post['date'] ?? '') : ($post->date ?? '');
                        $readTime = is_array($post) ? ($post['read_time'] ?? '') : ($post->read_time ?? '5 min read');
                        $author = is_array($post) ? ($post['author'] ?? '') : ($post->author ?? 'Roy C. Jones');
                        $excerpt = is_array($post) ? ($post['excerpt'] ?? '') : ($post->excerpt ?? '');
                    @endphp
                    <article class="p-6 rounded-3xl bg-[#111111] border border-white/10 hover:border-[#ccff00]/40 transition-all group flex flex-col justify-between">
                        <div>
                            <div class="aspect-[16/10] rounded-2xl overflow-hidden bg-black/40 mb-6 relative">
                                <img
                                    src="{{ !empty($image) ? (str_starts_with($image, 'http') ? $image : asset($image)) : 'https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=800&q=80' }}"
                                    alt="{{ $title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                                <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-mono font-bold bg-[#ccff00] text-[#080808]">
                                    {{ $category }}
                                </span>
                            </div>
                            <div class="space-y-3">
                                <span class="text-[11px] font-mono text-neutral-400">{{ $date }} &bull; {{ $readTime }} &bull; By {{ $author }}</span>
                                <h2 class="text-2xl font-bold font-['Outfit'] text-white group-hover:text-[#ccff00] transition-colors leading-snug">
                                    <a href="{{ route('blog.detail', $slug) }}">{{ $title }}</a>
                                </h2>
                                <p class="text-xs text-neutral-400 leading-relaxed">{{ $excerpt }}</p>
                            </div>
                        </div>
                        <div class="pt-6 border-t border-white/5 mt-6 flex items-center justify-between">
                            <a href="{{ route('blog.detail', $slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#ccff00] hover:underline">
                                <span>{{ $settings['blog_read_more_text'] ?? 'Read Full Article' }}</span>
                                <span>↗</span>
                            </a>
                            <span class="text-xs text-neutral-500">Share ↗</span>
                        </div>
                    </article>
                @empty
                    <div class="col-span-2 text-center py-12 text-neutral-500 text-xs font-mono">
                        No articles published yet.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer matching uploaded design image -->
    @include('frontend.themes.uiux_designer.partials.footer')

</div>
@endsection
