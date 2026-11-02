@extends('frontend.layouts.frontend')

@section('content')
<style>
    :root {
        --theme-primary: #00e5ff;
        --theme-primary-hover: #00b4d8;
        --theme-primary-glow: rgba(0, 229, 255, 0.25);
    }
</style>

<div class="laravel-dev-wrapper bg-slate-50 dark:bg-[#070b14] text-slate-900 dark:text-slate-100 min-h-screen selection:bg-[var(--theme-primary)] selection:text-black font-['Plus_Jakarta_Sans'] transition-colors duration-300 relative">

    <!-- Header Partial -->
    @include('frontend.themes.laravel_developer.partials.header')

    <!-- Page Title / Hero -->
    <section class="py-16 sm:py-20 border-b border-slate-200 dark:border-white/5 relative overflow-hidden bg-slate-100/60 dark:bg-[#0a0f1d]/60">
        <!-- Ambient Cyber Glows -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-[var(--theme-primary)]/10 rounded-full blur-[140px] pointer-events-none -z-10"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 bg-blue-600/10 rounded-full blur-[140px] pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-[var(--theme-primary)] text-xs font-mono font-bold w-fit mb-4">
                <span>&lt;articles:tech_notes&gt;</span>
                <span>// ARCHITECTURAL WRITINGS</span>
            </div>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-slate-900 dark:text-white">
                ENGINEERING <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500">ARTICLES &amp;</span> INSIGHTS
            </h1>
            <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-3 max-w-3xl leading-relaxed">
                In-depth technical writing on Laravel 11 internals, multi-tenant databases, queue worker scaling, and reactive web architecture by Md. Abdullah Al Ahsan.
            </p>
        </div>
    </section>

    <!-- Blog Posts Grid -->
    <section class="py-16 sm:py-20 border-b border-slate-200 dark:border-white/5">
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
                        $category = is_array($post) ? ($post['category'] ?? '') : ($post->category ?? 'Backend');
                        $date = is_array($post) ? ($post['date'] ?? '') : ($post->date ?? 'Recently');
                        $readTime = is_array($post) ? ($post['read_time'] ?? '') : ($post->read_time ?? '5 min read');
                        $author = is_array($post) ? ($post['author'] ?? 'Md. Abdullah Al Ahsan') : ($post->author ?? 'Md. Abdullah Al Ahsan');
                        $excerpt = is_array($post) ? ($post['excerpt'] ?? '') : ($post->excerpt ?? '');
                    @endphp

                    <article class="p-6 rounded-3xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm hover:border-[var(--theme-primary)]/50 hover:shadow-xl dark:hover:shadow-cyan-500/5 transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Article Cover Image -->
                            <div class="aspect-[16/10] rounded-2xl overflow-hidden bg-slate-900 mb-5 relative">
                                @if(!empty($image))
                                    <img
                                        src="{{ str_starts_with($image, 'http') ? $image : asset($image) }}"
                                        alt="{{ $title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-cyan-950 via-slate-900 to-indigo-950 text-slate-400 font-mono text-xs">
                                        &lt;laravel/article&gt;
                                    </div>
                                @endif
                                <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-[10px] font-mono font-bold bg-slate-950/80 backdrop-blur-md text-[var(--theme-primary)] border border-cyan-500/30">
                                    {{ $category }}
                                </span>
                            </div>

                            <!-- Meta Header -->
                            <div class="flex items-center gap-3 text-xs font-mono text-slate-500 dark:text-slate-400 mb-2">
                                <span>{{ $date }}</span>
                                <span>•</span>
                                <span>{{ $readTime }}</span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold font-['Outfit'] text-slate-900 dark:text-white group-hover:text-[var(--theme-primary)] transition-colors leading-snug">
                                <a href="{{ route('blog.detail', $slug) }}">
                                    {{ $title }}
                                </a>
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-xs text-slate-600 dark:text-slate-300 mt-2.5 leading-relaxed line-clamp-3">
                                {{ $excerpt }}
                            </p>
                        </div>

                        <!-- Card Footer -->
                        <div class="pt-5 mt-5 border-t border-slate-100 dark:border-white/10 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-cyan-500/20 text-[var(--theme-primary)] flex items-center justify-center text-[10px] font-bold">
                                    A
                                </div>
                                <span class="text-xs font-mono text-slate-700 dark:text-slate-300">{{ $author }}</span>
                            </div>

                            <a href="{{ route('blog.detail', $slug) }}"
                                class="inline-flex items-center gap-1 text-xs font-mono font-bold text-[var(--theme-primary)] hover:underline">
                                <span>Read Full</span>
                                <span>→</span>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-12 text-slate-500 font-mono text-xs">
                        No articles published yet. Check back soon!
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer Partial -->
    @include('frontend.themes.laravel_developer.partials.footer')

</div>
@endsection

