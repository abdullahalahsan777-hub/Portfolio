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

                @php
                    $authorName = is_array($post)
                        ? $post['author'] ?? 'Md. Abdullah Al Ahsan'
                        : $post->author ?? 'Md. Abdullah Al Ahsan';
                    $authorEmail =
                        $settings['contact_email'] ?? ($settings['email'] ?? 'abdullahalahsan1990@gmail.com');
                    $authorPhone = $settings['contact_phone'] ?? ($settings['whatsapp'] ?? '+8801718926673');
                @endphp

                <!-- Bottom Section: Article Author & Related Architectural Reads -->
                <div class="mt-16 pt-12 border-t border-slate-200 dark:border-white/10">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                        <!-- Left Column (5 cols): Redesigned ARTICLE AUTHOR Card -->
                        <div class="lg:col-span-5 space-y-4">
                            <h3
                                class="text-xl font-black font-['Outfit'] text-slate-900 dark:text-white uppercase tracking-tight flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-[var(--theme-primary)]"></span>
                                <span>Article Author</span>
                            </h3>

                            <div
                                class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-[#09101d] border border-slate-200 dark:border-white/10 hover:border-cyan-500/40 shadow-xl transition-all duration-300 relative overflow-hidden group">
                                <!-- Ambient Glow -->
                                <div
                                    class="absolute -top-12 -right-12 w-36 h-36 bg-cyan-500/10 rounded-full blur-2xl pointer-events-none group-hover:bg-cyan-500/20 transition-all duration-500">
                                </div>

                                <!-- Profile Identity -->
                                <div class="flex items-center gap-4">
                                    <div
                                        class="relative w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-tr from-[var(--theme-primary)] via-blue-600 to-indigo-700 text-white flex items-center justify-center font-mono font-black text-xl shadow-lg shadow-cyan-500/25 ring-2 ring-[var(--theme-primary)]/30 overflow-hidden shrink-0">
                                        <span>&lt;/&gt;</span>
                                        <span
                                            class="absolute bottom-1 right-1 w-3 h-3 rounded-full bg-emerald-400 border-2 border-[#09101d]"></span>
                                    </div>
                                    <div class="min-w-0">
                                        <h4
                                            class="text-lg sm:text-xl font-black text-slate-900 dark:text-white font-['Outfit'] leading-tight tracking-tight truncate">
                                            {{ $authorName }}
                                        </h4>
                                        <p
                                            class="text-xs font-mono text-[var(--theme-primary)] font-semibold mt-1 flex items-center gap-1">
                                            <span>⚡</span> Laravel Developer &amp; System Architect
                                        </p>
                                    </div>
                                </div>

                                <!-- Contact Chips -->
                                <div
                                    class="pt-4 border-t border-slate-100 dark:border-white/5 mt-5 flex flex-wrap items-center gap-2">
                                    <a href="mailto:{{ $authorEmail }}"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-white/5 hover:bg-cyan-500/15 border border-slate-200 dark:border-white/10 hover:border-cyan-500/40 text-xs font-mono text-slate-700 dark:text-slate-300 hover:text-cyan-400 transition-all">
                                        <svg class="w-3.5 h-3.5 text-cyan-400 shrink-0" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <span class="truncate max-w-[190px] sm:max-w-none">{{ $authorEmail }}</span>
                                    </a>
                                    <a href="tel:{{ $authorPhone }}"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-white/5 hover:bg-emerald-500/15 border border-slate-200 dark:border-white/10 hover:border-emerald-500/40 text-xs font-mono text-slate-700 dark:text-slate-300 hover:text-emerald-400 transition-all">
                                        <svg class="w-3.5 h-3.5 text-emerald-400 shrink-0" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <span>{{ $authorPhone }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column (7 cols): Related Architectural Reads with Prev & Next Badges -->
                        <div class="lg:col-span-7 space-y-4">
                            @if (!empty($relatedPosts) && count($relatedPosts) > 0)
                                <h3
                                    class="text-xl font-black font-['Outfit'] text-slate-900 dark:text-white uppercase tracking-tight flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-cyan-400"></span>
                                    <span>Related Architectural Reads</span>
                                </h3>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach ($relatedPosts as $index => $r)
                                        @php
                                            $rSlug = is_array($r) ? $r['slug'] ?? '' : $r->slug ?? '';
                                            $rTitle = is_array($r) ? $r['title'] ?? '' : $r->title ?? '';
                                            $rCategory = is_array($r)
                                                ? $r['category'] ?? 'Architecture'
                                                : $r->category ?? 'Architecture';
                                            $rReadTime = is_array($r)
                                                ? $r['read_time'] ?? '5 min read'
                                                : $r->read_time ?? '5 min read';
                                            $isPrev = $index === 0;
                                        @endphp
                                        <a href="{{ route('blog.detail', $rSlug) }}"
                                            class="p-5 sm:p-6 rounded-3xl bg-white dark:bg-[#09101d] border border-slate-200 dark:border-white/10 hover:border-cyan-500/40 shadow-xl transition-all duration-300 flex flex-col justify-between group relative overflow-hidden min-h-[170px]">

                                            <!-- Top Badges Row matching screenshot positions -->
                                            <div class="flex items-center justify-between gap-2 mb-3">
                                                @if ($isPrev)
                                                    <!-- Prev Badge at Top-Left (Screenshot red box) -->
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-bold bg-cyan-500/20 text-cyan-300 border border-cyan-500/40 shadow-sm shadow-cyan-500/20 group-hover:bg-cyan-500/30 group-hover:border-cyan-400 transition-all">
                                                        <svg class="w-3 h-3 text-cyan-400 transition-transform group-hover:-translate-x-0.5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2.5" d="M15 19l-7-7 7-7" />
                                                        </svg>
                                                        <span>Prev</span>
                                                    </span>
                                                    <span
                                                        class="text-[10px] font-mono uppercase text-slate-500 dark:text-slate-400 font-semibold">{{ $rReadTime }}</span>
                                                @else
                                                    <!-- Next Badge at Top-Right (Screenshot red box) -->
                                                    <span
                                                        class="text-[10px] font-mono uppercase text-slate-500 dark:text-slate-400 font-semibold">{{ $rReadTime }}</span>
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/40 shadow-sm shadow-indigo-500/20 group-hover:bg-indigo-500/30 group-hover:border-indigo-400 transition-all">
                                                        <span>Next</span>
                                                        <svg class="w-3 h-3 text-indigo-400 transition-transform group-hover:translate-x-0.5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2.5" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="mt-auto">
                                                <span
                                                    class="text-[10px] font-mono text-[var(--theme-primary)] uppercase font-bold tracking-wider block mb-1.5">
                                                    {{ $rCategory }}
                                                </span>
                                                <h4
                                                    class="text-sm sm:text-base font-bold text-slate-900 dark:text-white group-hover:text-[var(--theme-primary)] transition-colors font-['Outfit'] leading-snug line-clamp-3">
                                                    {{ $rTitle }}
                                                </h4>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </article>

        <!-- Footer Partial -->
        @include('frontend.themes.laravel_developer.partials.footer')

    </div>
@endsection
