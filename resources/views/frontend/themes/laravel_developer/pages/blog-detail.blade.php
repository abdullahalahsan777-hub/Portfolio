@extends('frontend.layouts.frontend')

@section('content')
    <style>
        :root {
            --theme-primary: #00e5ff;
            --theme-primary-hover: #00b4d8;
            --theme-primary-glow: rgba(0, 229, 255, 0.25);
            --theme-on-primary: #000000;
        }
    </style>

    <div
        class="laravel-dev-wrapper bg-slate-50 dark:bg-[#070b14] text-slate-900 dark:text-slate-100 min-h-screen selection:bg-[var(--theme-primary)] selection:text-black font-['Plus_Jakarta_Sans'] transition-colors duration-300 relative">

        <!-- Header Partial -->
        @include('frontend.themes.laravel_developer.partials.header')

        <!-- Post Article Body -->
        <article class="py-16 sm:py-20 border-b border-slate-200 dark:border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">

                <!-- Breadcrumbs -->
                <a href="{{ route('blog') }}"
                    class="inline-flex items-center gap-2 text-xs font-mono font-bold text-[var(--theme-primary)] mb-6 hover:underline">
                    <span>&larr;</span> Back to All Technical Articles
                </a>

                <!-- Meta Tags -->
                <div class="flex flex-wrap items-center gap-3 text-xs font-mono text-slate-500 dark:text-slate-400 mb-4">
                    <span
                        class="px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-[var(--theme-primary)] font-bold">
                        {{ is_array($post) ? $post['category'] ?? 'Architecture' : $post->category ?? 'Architecture' }}
                    </span>
                    <span>•</span>
                    <span>{{ is_array($post) ? $post['date'] ?? 'Recently' : $post->date ?? 'Recently' }}</span>
                    <span>•</span>
                    <span>{{ is_array($post) ? $post['read_time'] ?? '6 min read' : $post->read_time ?? '6 min read' }}</span>
                </div>

                <!-- Title -->
                <h1
                    class="text-3xl sm:text-5xl font-black font-['Outfit'] tracking-tight text-slate-900 dark:text-white leading-tight">
                    {{ is_array($post) ? $post['title'] : $post->title }}
                </h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Featured Image -->
                    @php
                        $img = is_array($post) ? $post['image'] ?? '' : $post->image ?? '';

                        $excerpt = is_array($post) ? $post['excerpt'] ?? '' : $post->excerpt ?? '';
                        $content = is_array($post) ? $post['content'] ?? '' : $post->content ?? '';
                    @endphp

                    <div>
                        @if (!empty($img))
                            <div
                                class="mt-8 rounded-3xl overflow-hidden aspect-[16/9] bg-slate-900 border border-slate-200 dark:border-white/10 shadow-2xl">
                                <img src="{{ str_starts_with($img, 'http') ? $img : asset($img) }}"
                                    alt="{{ is_array($post) ? $post['title'] : $post->title }}"
                                    class="w-full h-full object-cover">

                            </div>
                        @endif

                        @if (!empty($excerpt))
                            <div class="mt-8">
                                <p
                                    class="text-base sm:text-lg text-slate-900 dark:text-white font-medium leading-relaxed p-6 rounded-2xl bg-cyan-500/5 border-l-4 border-[var(--theme-primary)]">
                                    {{ $excerpt }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Article Content -->
                    <div
                        class="mt-8 mb-4 space-y-6 text-sm sm:text-base text-slate-700 dark:text-slate-300 leading-relaxed font-normal">
                        <div class="prose dark:prose-invert max-w-none space-y-4">
                            {!! nl2br(e($content)) !!}
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Author Card -->
                    <div
                        class="mt-16 p-8 rounded-3xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm flex flex-col sm:flex-row items-center sm:items-start gap-6">
                        <div
                            class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-[var(--theme-primary)] via-blue-600 to-indigo-700 text-white flex items-center justify-center font-mono font-black text-xl shrink-0 shadow-lg shadow-cyan-500/20">
                            &lt;/&gt;
                        </div>
                        <div class="space-y-2 text-center sm:text-left">
                            <span
                                class="text-[10px] font-mono text-[var(--theme-primary)] uppercase font-bold tracking-widest block">
                                ARTICLE AUTHOR
                            </span>
                            <h4 class="text-lg font-bold text-slate-900 dark:text-white font-['Outfit']">
                                {{ is_array($post) ? $post['author'] ?? 'Md. Abdullah Al Ahsan' : $post->author ?? 'Md. Abdullah Al Ahsan' }}
                                <small class="text-[10px] text-[var(--theme-primary)]">(Laravel Developer & System
                                    Architect)</small>
                            </h4>
                            <div class="text-xs font-mono">
                                <a href="mailto:abdullahalahsan1990@gmail.com"
                                    class="text-[var(--theme-primary)] hover:underline">abdullahalahsan1990@gmail.com</a>
                                <br />
                                <a href="tel:+8801718926673"
                                    class="mt-2text-slate-500 dark:text-slate-400 hover:text-white">+8801718926673</a>
                            </div>
                        </div>
                    </div>

                    <!-- Related Articles -->
                    <div>
                        @if (!empty($relatedPosts) && count($relatedPosts) > 0)
                            <h3 class="text-2xl font-bold font-['Outfit'] text-slate-900 dark:text-white uppercase mb-8">
                                Related
                                Architectural Reads</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                @foreach ($relatedPosts as $r)
                                    @php
                                        $rSlug = is_array($r) ? $r['slug'] ?? '' : $r->slug ?? '';
                                        $rTitle = is_array($r) ? $r['title'] ?? '' : $r->title ?? '';
                                        $rCategory = is_array($r)
                                            ? $r['category'] ?? 'Architecture'
                                            : $r->category ?? 'Architecture';
                                        $rReadTime = is_array($r)
                                            ? $r['read_time'] ?? '5 min read'
                                            : $r->read_time ?? '5 min read';
                                    @endphp
                                    <a href="{{ route('blog.detail', $rSlug) }}"
                                        class="p-6 rounded-2xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 hover:border-[var(--theme-primary)]/50 shadow-sm transition-all block group">
                                        <span
                                            class="text-[10px] font-mono text-[var(--theme-primary)] uppercase">{{ $rCategory }}
                                            • {{ $rReadTime }}</span>
                                        <h4
                                            class="text-base font-bold text-slate-900 dark:text-white group-hover:text-[var(--theme-primary)] transition-colors font-['Outfit'] mt-2">
                                            {{ $rTitle }}
                                        </h4>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </article>

        <!-- Footer Partial -->
        @include('frontend.themes.laravel_developer.partials.footer')

    </div>
@endsection
