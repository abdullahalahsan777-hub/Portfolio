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
                <span>&lt;visual:archive&gt;</span>
                <span>// ARCHITECTURAL &amp; PHOTOGRAPHY SHOWCASE</span>
            </div>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-slate-900 dark:text-white">
                PHOTO &amp; SYSTEM <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500">GALLERY</span>
            </h1>
            <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-3 max-w-3xl leading-relaxed">
                Explore visual documentation of backend architectures, high-concurrency database models, command workstations, and certifications. Click any photo to launch the interactive <span class="text-[var(--theme-primary)] font-mono font-bold">Pictureflect Photo Viewer</span> with fluid zoom, pan, and technical inspector.
            </p>

            <!-- Category Filter Pills -->
            <div class="flex flex-wrap items-center gap-2 pt-8" id="galleryCategoryFilter">
                <button type="button" onclick="filterFrontendGallery('all')" data-cat="all"
                    class="gallery-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-[var(--theme-primary)] text-black font-bold shadow-md shadow-cyan-500/20">
                    All Photos ({{ $galleries->count() }})
                </button>
                @foreach($categories as $category)
                    @php
                        $count = $galleries->where('category', $category)->count();
                    @endphp
                    <button type="button" onclick="filterFrontendGallery('{{ addslashes($category) }}')" data-cat="{{ $category }}"
                        class="gallery-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-white dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:text-white border border-slate-200 dark:border-white/10">
                        {{ $category }} ({{ $count }})
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Gallery Grid Section -->
    <section class="py-16 sm:py-20 border-b border-slate-200 dark:border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="galleryCardsGrid">
                @forelse($galleries as $item)
                    <div data-category="{{ $item->category }}"
                        class="gallery-item-card rounded-2xl bg-white dark:bg-[#0c1222] border border-slate-200 dark:border-white/10 overflow-hidden shadow-lg hover:shadow-cyan-500/10 hover:border-cyan-500/40 transition-all duration-300 flex flex-col justify-between group cursor-pointer"
                        data-pictureflect
                        data-gallery="laravel-gallery"
                        data-src="{{ $item->image_url }}"
                        data-title="{{ $item->title }}"
                        data-category="{{ $item->category }}"
                        data-caption="{{ $item->caption }}">

                        <div>
                            <!-- Aspect Photo Container with Hover Effect -->
                            <div class="relative aspect-4/3 w-full overflow-hidden bg-slate-900">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>

                                <!-- Top Badges -->
                                <div class="absolute top-3 left-3 z-10 flex items-center gap-1.5">
                                    <span class="px-2.5 py-1 rounded-md text-[10px] font-mono font-bold uppercase bg-black/70 backdrop-blur border border-cyan-500/30 text-cyan-300 shadow">
                                        {{ $item->category }}
                                    </span>
                                </div>

                                @if ($item->is_featured)
                                    <div class="absolute top-3 right-3 z-10">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase bg-amber-500/20 text-amber-300 border border-amber-500/40 backdrop-blur">
                                            ★ Featured
                                        </span>
                                    </div>
                                @endif

                                <!-- Pictureflect Quick-View Hover Badge -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                    <span class="px-3.5 py-1.5 rounded-full bg-cyan-400 text-black text-xs font-bold font-mono tracking-wider uppercase shadow-xl shadow-cyan-500/40 flex items-center gap-1.5 transform translate-y-2 group-hover:translate-y-0 transition-transform">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                            <line x1="11" y1="8" x2="11" y2="14"></line>
                                            <line x1="8" y1="11" x2="14" y2="11"></line>
                                        </svg>
                                        <span>Pictureflect View</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-5 space-y-2">
                                <h3 class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-[var(--theme-primary)] transition-colors line-clamp-1">
                                    {{ $item->title }}
                                </h3>
                                @if (!empty($item->caption))
                                    <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                        {{ $item->caption }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="px-5 pb-4 pt-0 flex items-center justify-between text-[11px] font-mono text-slate-500 border-t border-slate-100 dark:border-white/5 pt-3">
                            <span class="text-[var(--theme-primary)]">#{{ $item->sort_order }}</span>
                            <span class="inline-flex items-center gap-1 text-slate-400 group-hover:text-[var(--theme-primary)] transition-colors">
                                <span>Inspect</span> &rarr;
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center space-y-4">
                        <div class="w-16 h-16 rounded-3xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 flex items-center justify-center mx-auto text-2xl">
                            📷
                        </div>
                        <h3 class="text-lg font-bold text-white">No Photos Added Yet</h3>
                        <p class="text-xs text-slate-400">Please check back shortly or visit the admin panel to upload photos.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer Partial -->
    @include('frontend.themes.laravel_developer.partials.footer')

</div>

<!-- Filter JavaScript -->
<script>
    function filterFrontendGallery(category) {
        const cards = document.querySelectorAll('.gallery-item-card');
        const buttons = document.querySelectorAll('.gallery-filter-btn');

        buttons.forEach(btn => {
            if (btn.getAttribute('data-cat') === category) {
                btn.className = 'gallery-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-[var(--theme-primary)] text-black font-bold shadow-md shadow-cyan-500/20';
            } else {
                btn.className = 'gallery-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-white dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:text-white border border-slate-200 dark:border-white/10';
            }
        });

        cards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            if (category === 'all' || cardCat === category) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endsection
