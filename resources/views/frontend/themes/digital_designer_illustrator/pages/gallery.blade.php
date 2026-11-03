@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#f8f9fc] dark:bg-[#0c0d10] text-[#111215] dark:text-white min-h-screen selection:bg-[#e26d9b] selection:text-white font-['Plus_Jakarta_Sans'] transition-colors">

    <!-- Header Partial -->
    @include('frontend.themes.digital_designer_illustrator.partials.header')

    <!-- Page Header -->
    <section class="py-20 border-b border-black/5 dark:border-white/5 relative overflow-hidden bg-white dark:bg-transparent">
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-[#e26d9b]/10 rounded-full blur-[140px] pointer-events-none -z-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#e26d9b] uppercase tracking-widest block mb-2">// DIGITAL ART &amp; ILLUSTRATION ARCHIVE</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-[#111215] dark:text-white">
                ART &amp; <span class="text-[#e26d9b]">GALLERY</span>
            </h1>
            <p class="text-[#596070] dark:text-[#a0a6b2] text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                Cyberpunk concepts, isometric game asset studies, digital brush experimentation, and illustration workstation equipment. Inspect in high-definition with <span class="text-[#e26d9b] font-mono">Pictureflect Photo Viewer</span>.
            </p>

            <!-- Category Filter Pills -->
            <div class="flex flex-wrap items-center gap-2 pt-8" id="digiGalleryFilter">
                <button type="button" onclick="filterDigiGallery('all')" data-cat="all"
                    class="digi-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-[#e26d9b] text-white font-bold shadow-md shadow-[#e26d9b]/25">
                    All Artworks ({{ $galleries->count() }})
                </button>
                @foreach($categories as $category)
                    @php
                        $count = $galleries->where('category', $category)->count();
                    @endphp
                    <button type="button" onclick="filterDigiGallery('{{ addslashes($category) }}')" data-cat="{{ $category }}"
                        class="digi-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-white dark:bg-[#14151a] text-[#596070] dark:text-neutral-300 hover:text-[#e26d9b] border border-black/5 dark:border-white/10">
                        {{ $category }} ({{ $count }})
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="digiGalleryGrid">
                @forelse($galleries as $item)
                    <div data-category="{{ $item->category }}"
                        class="digi-gallery-card rounded-2xl bg-white dark:bg-[#15161c] border border-slate-200 dark:border-white/10 overflow-hidden hover:border-[#e26d9b]/40 transition-all group flex flex-col justify-between cursor-pointer"
                        data-pictureflect
                        data-gallery="digi-gallery"
                        data-src="{{ $item->image_url }}"
                        data-title="{{ $item->title }}"
                        data-category="{{ $item->category }}"
                        data-caption="{{ $item->caption }}">

                        <div>
                            <!-- Aspect Photo -->
                            <div class="relative aspect-4/3 w-full overflow-hidden bg-slate-900">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>

                                <div class="absolute top-2.5 left-2.5 z-10">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase bg-black/75 text-[#e26d9b] border border-[#e26d9b]/30 backdrop-blur">
                                        {{ $item->category }}
                                    </span>
                                </div>

                                <!-- Hover Pictureflect Pill -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                    <span class="px-3.5 py-1.5 rounded-full bg-[#e26d9b] text-white text-xs font-bold font-mono tracking-wider uppercase shadow-xl flex items-center gap-1.5">
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

                            <!-- Body -->
                            <div class="p-4 space-y-1.5">
                                <h3 class="text-sm font-bold text-[#111215] dark:text-white group-hover:text-[#e26d9b] transition-colors line-clamp-1">
                                    {{ $item->title }}
                                </h3>
                                @if (!empty($item->caption))
                                    <p class="text-xs text-[#596070] dark:text-neutral-400 line-clamp-2 leading-relaxed">
                                        {{ $item->caption }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="px-4 py-3 border-t border-slate-100 dark:border-white/5 flex items-center justify-between text-[11px] font-mono text-slate-400">
                            <span class="text-[#e26d9b]">#{{ $item->sort_order }}</span>
                            <span class="group-hover:text-[#e26d9b] transition-colors">Inspect &rarr;</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-neutral-400 font-mono text-sm">
                        No artworks available in gallery.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer Partial -->
    @include('frontend.themes.digital_designer_illustrator.partials.footer')

</div>

<script>
    function filterDigiGallery(cat) {
        const cards = document.querySelectorAll('.digi-gallery-card');
        const buttons = document.querySelectorAll('.digi-filter-btn');

        buttons.forEach(btn => {
            if (btn.getAttribute('data-cat') === cat) {
                btn.className = 'digi-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-[#e26d9b] text-white font-bold shadow-md shadow-[#e26d9b]/25';
            } else {
                btn.className = 'digi-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-white dark:bg-[#14151a] text-[#596070] dark:text-neutral-300 hover:text-[#e26d9b] border border-black/5 dark:border-white/10';
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
