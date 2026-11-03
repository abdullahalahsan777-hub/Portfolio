@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#0f0c1b] text-white min-h-screen selection:bg-[#7c3aed] selection:text-white font-['Plus_Jakarta_Sans']">

    <!-- Header Partial -->
    @include('frontend.themes.graphic_designer.partials.header')

    <!-- Page Header -->
    <section class="py-20 border-b border-white/5 relative overflow-hidden">
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-[#7c3aed]/10 rounded-full blur-[140px] pointer-events-none -z-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#c084fc] uppercase tracking-widest block mb-2">// CREATIVE PORTFOLIO &amp; VISUAL ARCHIVE</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight">
                VISUAL <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#a855f7] via-[#c084fc] to-[#f472b6]">GALLERY</span>
            </h1>
            <p class="text-slate-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                Brand identity suites, kinetic typographic posters, package mockups, and tactile studio craft. Inspect every detail with <span class="text-[#c084fc] font-mono">Pictureflect Photo Viewer</span>.
            </p>

            <!-- Category Filter Pills -->
            <div class="flex flex-wrap items-center gap-2 pt-8" id="gdGalleryFilter">
                <button type="button" onclick="filterGdGallery('all')" data-cat="all"
                    class="gd-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-gradient-to-r from-[#7c3aed] to-[#a855f7] text-white font-bold shadow-md shadow-[#7c3aed]/25">
                    All Works ({{ $galleries->count() }})
                </button>
                @foreach($categories as $category)
                    @php
                        $count = $galleries->where('category', $category)->count();
                    @endphp
                    <button type="button" onclick="filterGdGallery('{{ addslashes($category) }}')" data-cat="{{ $category }}"
                        class="gd-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-[#181329] text-slate-300 hover:text-white border border-white/10">
                        {{ $category }} ({{ $count }})
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="gdGalleryGrid">
                @forelse($galleries as $item)
                    <div data-category="{{ $item->category }}"
                        class="gd-gallery-card rounded-2xl bg-[#181329] border border-white/10 overflow-hidden hover:border-[#a855f7]/40 transition-all group flex flex-col justify-between cursor-pointer"
                        data-pictureflect
                        data-gallery="gd-gallery"
                        data-src="{{ $item->image_url }}"
                        data-title="{{ $item->title }}"
                        data-category="{{ $item->category }}"
                        data-caption="{{ $item->caption }}">

                        <div>
                            <!-- Aspect Photo -->
                            <div class="relative aspect-4/3 w-full overflow-hidden bg-[#0d0a17]">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>

                                <div class="absolute top-2.5 left-2.5 z-10">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase bg-black/75 text-[#c084fc] border border-[#a855f7]/30 backdrop-blur">
                                        {{ $item->category }}
                                    </span>
                                </div>

                                <!-- Hover Pictureflect Pill -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                    <span class="px-3.5 py-1.5 rounded-full bg-gradient-to-r from-[#7c3aed] to-[#c084fc] text-white text-xs font-bold font-mono tracking-wider uppercase shadow-xl flex items-center gap-1.5">
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
                                <h3 class="text-sm font-bold text-white group-hover:text-[#c084fc] transition-colors line-clamp-1">
                                    {{ $item->title }}
                                </h3>
                                @if (!empty($item->caption))
                                    <p class="text-xs text-slate-400 line-clamp-2 leading-relaxed">
                                        {{ $item->caption }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="px-4 py-3 border-t border-white/5 flex items-center justify-between text-[11px] font-mono text-slate-500">
                            <span class="text-[#c084fc]">#{{ $item->sort_order }}</span>
                            <span class="text-slate-400 group-hover:text-[#c084fc] transition-colors">Inspect &rarr;</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-slate-400 font-mono text-sm">
                        No photos available in gallery.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer Partial -->
    @include('frontend.themes.graphic_designer.partials.footer')

</div>

<script>
    function filterGdGallery(cat) {
        const cards = document.querySelectorAll('.gd-gallery-card');
        const buttons = document.querySelectorAll('.gd-filter-btn');

        buttons.forEach(btn => {
            if (btn.getAttribute('data-cat') === cat) {
                btn.className = 'gd-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-gradient-to-r from-[#7c3aed] to-[#a855f7] text-white font-bold shadow-md shadow-[#7c3aed]/25';
            } else {
                btn.className = 'gd-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-[#181329] text-slate-300 hover:text-white border border-white/10';
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
