@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#070707] text-[#ffffff] min-h-screen selection:bg-[#00ff88] selection:text-[#070707] font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.developer.partials.header')

    <!-- Page Header -->
    <section class="py-20 border-b border-white/5 relative overflow-hidden">
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-[#00ff88]/5 rounded-full blur-[140px] pointer-events-none -z-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block mb-2">// VISUAL ARCHIVE &amp; SYSTEM PHOTOS</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight">
                PHOTO <span class="text-[#00ff88]">GALLERY</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                Visual documentation of cloud architectures, terminal setups, server deployments, and software engineering workspaces. Powered by <span class="text-[#00ff88] font-mono">Pictureflect Photo Viewer</span> with fluid zoom and inspection tools.
            </p>

            <!-- Category Filter Pills -->
            <div class="flex flex-wrap items-center gap-2 pt-8" id="devGalleryFilter">
                <button type="button" onclick="filterDevGallery('all')" data-cat="all"
                    class="dev-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-[#00ff88] text-[#070707] font-bold shadow-md shadow-[#00ff88]/20">
                    All Photos ({{ $galleries->count() }})
                </button>
                @foreach($categories as $category)
                    @php
                        $count = $galleries->where('category', $category)->count();
                    @endphp
                    <button type="button" onclick="filterDevGallery('{{ addslashes($category) }}')" data-cat="{{ $category }}"
                        class="dev-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-[#141414] text-neutral-300 hover:text-white border border-white/10">
                        {{ $category }} ({{ $count }})
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="devGalleryGrid">
                @forelse($galleries as $item)
                    <div data-category="{{ $item->category }}"
                        class="dev-gallery-card rounded-2xl bg-[#111111] border border-white/10 overflow-hidden hover:border-[#00ff88]/40 transition-all group flex flex-col justify-between cursor-pointer"
                        data-pictureflect
                        data-gallery="developer-gallery"
                        data-src="{{ $item->image_url }}"
                        data-title="{{ $item->title }}"
                        data-category="{{ $item->category }}"
                        data-caption="{{ $item->caption }}">

                        <div>
                            <!-- Mockup Header -->
                            <div class="px-3 py-2 bg-[#171717] border-b border-white/5 flex items-center justify-between">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-rose-500/80"></span>
                                    <span class="w-2 h-2 rounded-full bg-amber-500/80"></span>
                                    <span class="w-2 h-2 rounded-full bg-emerald-500/80"></span>
                                </div>
                                <span class="text-[10px] font-mono text-neutral-500 uppercase">{{ $item->category }}</span>
                            </div>

                            <!-- Image Container -->
                            <div class="relative aspect-4/3 w-full overflow-hidden bg-black">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>

                                <!-- Hover Pictureflect Pill -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                    <span class="px-3.5 py-1.5 rounded-full bg-[#00ff88] text-[#070707] text-xs font-bold font-mono tracking-wider uppercase shadow-xl flex items-center gap-1.5">
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
                            <div class="p-4 space-y-1.5">
                                <h3 class="text-sm font-bold text-white group-hover:text-[#00ff88] transition-colors line-clamp-1">
                                    {{ $item->title }}
                                </h3>
                                @if (!empty($item->caption))
                                    <p class="text-xs text-neutral-400 line-clamp-2 leading-relaxed">
                                        {{ $item->caption }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="px-4 py-3 border-t border-white/5 flex items-center justify-between text-[11px] font-mono text-neutral-500">
                            <span class="text-[#00ff88]">#{{ $item->sort_order }}</span>
                            <span class="text-neutral-400 group-hover:text-[#00ff88] transition-colors">Inspect &rarr;</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-neutral-400">
                        <p class="font-mono text-sm">No photos available in gallery.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer Partial -->
    @include('frontend.themes.developer.partials.footer')

</div>

<script>
    function filterDevGallery(cat) {
        const cards = document.querySelectorAll('.dev-gallery-card');
        const buttons = document.querySelectorAll('.dev-filter-btn');

        buttons.forEach(btn => {
            if (btn.getAttribute('data-cat') === cat) {
                btn.className = 'dev-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-[#00ff88] text-[#070707] font-bold shadow-md shadow-[#00ff88]/20';
            } else {
                btn.className = 'dev-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-[#141414] text-neutral-300 hover:text-white border border-white/10';
            }
        });

        cards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            if (cat === 'all' || cardCat === cat) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endsection
