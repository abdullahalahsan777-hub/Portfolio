@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#0c0a18] text-[#f5f3ff] min-h-screen selection:bg-[#7c3aed] selection:text-white font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.graphic_designer.partials.header')


    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-widest block mb-2">
                {{ $settings['blog_hero_tag'] ?? ($settings['blog_tag'] ?? 'THOUGHTS & PROCESS') }}
            </span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] tracking-tight">
                {{ $settings['blog_hero_title_line1'] ?? 'Design Articles &' }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-fuchsia-400">{{ $settings['blog_hero_title_highlight'] ?? 'Creative Insights' }}</span>
            </h1>
            <p class="text-slate-300 text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['blog_hero_description'] ?? ($settings['blog_subtitle'] ?? 'Essays and case reflections covering typography balance, color psychology, and interactive branding.') }}
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
                        $category = is_array($post) ? ($post['category'] ?? '') : ($post->category ?? '');
                        $date = is_array($post) ? ($post['date'] ?? '') : ($post->date ?? '');
                        $readTime = is_array($post) ? ($post['read_time'] ?? '') : ($post->read_time ?? '');
                        $author = is_array($post) ? ($post['author'] ?? '') : ($post->author ?? '');
                        $excerpt = is_array($post) ? ($post['excerpt'] ?? '') : ($post->excerpt ?? '');
                    @endphp
                    <article class="p-6 rounded-3xl bg-[#150f2c] border border-white/10 hover:border-[#a855f7]/40 transition-all group flex flex-col justify-between">
                        <div>
                            <div class="aspect-[16/10] rounded-2xl overflow-hidden bg-black/40 mb-6 relative">
                                @if(!empty($image))
                                    <img
                                        src="{{ str_starts_with($image, 'http') ? $image : asset($image) }}"
                                        alt="{{ $title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-900/40 to-black text-slate-500 font-mono text-xs">
                                        Article Cover
                                    </div>
                                @endif
                                @if(!empty($category))
                                    <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-mono font-bold bg-[#7c3aed] text-white">
                                        {{ $category }}
                                    </span>
                                @endif
                            </div>
                            <div class="space-y-3">
                                <span class="text-[11px] font-mono text-slate-400">
                                    {{ $date }} &bull; {{ $readTime }} &bull; By {{ $author }}
                                </span>
                                <h2 class="text-2xl font-bold font-['Outfit'] text-white group-hover:text-[#c084fc] transition-colors leading-snug">
                                    <a href="{{ route('blog.detail', $slug) }}">{{ $title }}</a>
                                </h2>
                                <p class="text-xs text-slate-400 leading-relaxed">{{ $excerpt }}</p>
                            </div>
                        </div>
                        <div class="pt-6 border-t border-white/5 mt-6 flex items-center justify-between">
                            <a href="{{ route('blog.detail', $slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#a855f7] hover:text-[#c084fc]">
                                <span>{{ $settings['blog_read_more_text'] ?? 'Read Full Article' }}</span>
                                <span>↗</span>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-2 text-center py-12 text-slate-400 text-sm">
                        No articles published yet. Check back soon!
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer matching uploaded design image -->
    @include('frontend.themes.graphic_designer.partials.footer')

</div>
@endsection
