@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-white dark:bg-[#0b0f17] text-slate-800 dark:text-white min-h-screen selection:bg-[#ff6b00] selection:text-white font-['Plus_Jakarta_Sans'] transition-colors">

    <!-- Header Partial -->
    @include('frontend.themes.app_software_developer.partials.header')

    <!-- Page Header -->
    <section class="py-20 border-b border-black/5 dark:border-white/5 relative overflow-hidden bg-slate-50 dark:bg-transparent">
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-[#ff6b00]/10 rounded-full blur-[140px] pointer-events-none -z-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#ff6b00] uppercase tracking-widest block mb-2">// APPLICATION &amp; SYSTEM ARCHIVE</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-slate-900 dark:text-white">
                PHOTO <span class="text-[#ff6b00]">GALLERY</span>
            </h1>
            <p class="text-slate-600 dark:text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                Visual showcase of application prototypes, embedded system dashboards, software engineering workstations, and POS environments. Powered by <span class="text-[#ff6b00] font-mono">Pictureflect Photo Viewer</span>.
            </p>

            <!-- Category Filter Pills -->
            <div class="flex flex-wrap items-center gap-2 pt-8" id="appSoftDevGalleryFilter">
                <button type="button" onclick="filterAppSoftDevGallery('all')" data-cat="all"
                    class="appsoft-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-[#ff6b00] text-white font-bold shadow-md shadow-[#ff6b00]/25">
                    All Photos ({{ $galleries->count() }})
                </button>
                @foreach($categories as $category)
                    @php
                        $count = $galleries->where('category', $category)->count();
                    @endphp
                    <button type="button" onclick="filterAppSoftDevGallery('{{ addslashes($category) }}')" data-cat="{{ $category }}"
                        class="appsoft-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-slate-100 dark:bg-[#141414] text-slate-700 dark:text-neutral-300 hover:text-[#ff6b00] border border-black/5 dark:border-white/10">
                        {{ $category }} ({{ $count }})
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="appSoftDevGalleryGrid">
                @forelse($galleries as $item)
                    <div data-category="{{ $item->category }}"
                        class="gallery-item-card appsoft-gallery-card rounded-2xl bg-slate-50 dark:bg-[#121826] border border-slate-200 dark:border-white/10 overflow-hidden hover:border-[#ff6b00]/40 transition-all group flex flex-col justify-between cursor-pointer"
                        data-pictureflect
                        data-gallery="appsoft-gallery"
                        data-src="{{ $item->image_url }}"
                        data-title="{{ $item->title }}"
                        data-category="{{ $item->category }}">

                        <div>
                            <!-- Photo Container -->
                            <div class="relative h-56 w-full overflow-hidden bg-slate-900">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                    onerror="this.closest('.gallery-item-card')?.remove();">

                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>

                                <div class="absolute top-2.5 left-2.5 z-10">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase bg-black/75 text-[#ff6b00] border border-[#ff6b00]/30 backdrop-blur">
                                        {{ $item->category }}
                                    </span>
                                </div>

                                <!-- Hover Pictureflect Pill -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                    <span class="px-3.5 py-1.5 rounded-full bg-[#ff6b00] text-white text-xs font-bold font-mono tracking-wider uppercase shadow-xl flex items-center gap-1.5">
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
                            <div class="p-4 space-y-1">
                                <h3 class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-[#ff6b00] transition-colors line-clamp-2">
                                    {{ $item->title }}
                                </h3>
                            </div>
                        </div>

                        <div class="px-4 py-3 border-t border-slate-200 dark:border-white/5 flex items-center justify-between text-[11px] font-mono text-slate-500">
                            <span class="text-[#ff6b00]">#{{ $item->sort_order }}</span>
                            <span class="text-slate-500 group-hover:text-[#ff6b00] transition-colors">Inspect &rarr;</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-slate-500 font-mono text-sm">
                        No photos available in gallery.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer Partial -->
    @include('frontend.themes.app_software_developer.partials.footer')

</div>

<script>
    function filterAppSoftDevGallery(cat) {
        const cards = document.querySelectorAll('.appsoft-gallery-card');
        const buttons = document.querySelectorAll('.appsoft-filter-btn');

        buttons.forEach(btn => {
            if (btn.getAttribute('data-cat') === cat) {
                btn.className = 'appsoft-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-[#ff6b00] text-white font-bold shadow-md shadow-[#ff6b00]/25';
            } else {
                btn.className = 'appsoft-filter-btn px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer bg-slate-100 dark:bg-[#141414] text-slate-700 dark:text-neutral-300 hover:text-[#ff6b00] border border-black/5 dark:border-white/10';
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

