@extends('admin.layout')

@section('title', 'Manage Photo Gallery')
@section('page_title', 'Photo Gallery')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="space-y-6">

        <!-- Top Header Banner -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-white flex items-center gap-3">
                    <span
                        class="w-10 h-10 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 flex items-center justify-center text-lg shadow-lg shadow-cyan-500/10 shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </span>
                    <span>Photo Gallery Manager</span>
                </h1>
                <p class="text-xs text-slate-400 mt-1">
                    Manage visual showcase items across all themes with categories, home featured status, and high-res
                    Pictureflect Viewer preview.
                </p>
            </div>
            <!-- Header Action Buttons in One Single Line -->
            <div class="flex items-center gap-2.5 shrink-0 flex-nowrap">
                <a href="{{ route('gallery') }}" target="_blank"
                    class="whitespace-nowrap shrink-0 px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-white/5 hover:bg-white/10 text-slate-300 border border-white/10 transition-all inline-flex items-center gap-2">
                    <svg class="w-4 h-4 text-cyan-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    <span class="whitespace-nowrap">Frontend View</span>
                </a>
                <a href="{{ route('admin.galleries.create') }}"
                    class="theme-aware-create-btn whitespace-nowrap shrink-0 px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white shadow-lg shadow-cyan-500/20 transition-all inline-flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="whitespace-nowrap">Add New Photo</span>
                </a>
            </div>
        </div>

        <!-- TOP THEME FILTER COMPONENT -->
        @include('admin.components.theme-filter')

        <!-- Theme-Specific Categories Bar (Clean single-line pill design, no broken layout) -->
        <div id="categoryFilterContainer" class="p-3.5 rounded-2xl bg-[#09101d] border border-white/10 shadow-lg">
            <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none text-xs flex-nowrap sm:flex-wrap"
                id="categoryFilterBar">
                <span
                    class="text-[11px] font-mono text-slate-400 uppercase tracking-wider font-semibold mr-1 shrink-0 inline-flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <span>Categories:</span>
                </span>

                <button type="button" onclick="filterGalleryCategory('all')" id="catBtn_all"
                    class="cat-filter-btn active whitespace-nowrap shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full font-mono text-xs font-bold bg-cyan-500/20 text-cyan-300 border border-cyan-500/40 transition-all">
                    <span>All</span>
                    <span id="catCount_all"
                        class="px-1.5 py-0.2 rounded-full text-[10px] bg-cyan-500/30 text-white font-mono">0</span>
                </button>

                <div id="dynamicThemeCategories" class="inline-flex items-center gap-2 shrink-0 flex-nowrap sm:flex-wrap">
                    <!-- Populated dynamically for selected theme -->
                </div>
            </div>
        </div>

        <!-- Galleries Grid with data-theme & data-cat filtering -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="galleriesGrid">
            @forelse($galleries as $item)
                @php
                    $themeMeta = \App\Models\SiteSetting::getThemeDetails($item->theme);
                @endphp
                <div data-theme="{{ $item->theme }}" data-category="{{ $item->category }}"
                    class="gallery-admin-card rounded-2xl bg-[#09101d] border border-white/10 overflow-hidden shadow-xl flex flex-col justify-between hover:border-cyan-500/40 transition-all duration-300 group">

                    <!-- Image Showcase Area with Pictureflect Trigger -->
                    <div class="relative w-full h-52 sm:h-56 bg-slate-900 overflow-hidden cursor-pointer group/img shrink-0"
                        data-pictureflect data-gallery="theme-{{ $item->theme }}" data-src="{{ $item->image_url }}"
                        data-title="{{ $item->title }}" data-category="{{ $item->category }}"
                        data-pf-theme="{{ $themeMeta['name'] ?? $item->theme }}"
                        data-pf-theme-key="{{ $item->theme }}">

                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                            class="absolute inset-0 w-full h-full object-cover block transition-transform duration-500 group-hover/img:scale-110 z-0"
                            onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'600\' height=\'400\' viewBox=\'0 0 600 400\'%3E%3Crect width=\'600\' height=\'400\' fill=\'%230b101e\'/%3E%3Ccircle cx=\'300\' cy=\'180\' r=\'40\' fill=\'%2306b6d4\' opacity=\'0.2\'/%3E%3Ctext x=\'50%25\' y=\'65%25\' text-anchor=\'middle\' fill=\'%2364748b\' font-family=\'sans-serif\' font-size=\'14\'%3EImage Preview%3C/text%3E%3C/svg%3E';">

                        <!-- Top Floating Theme Badge -->
                        <div class="absolute top-2.5 left-2.5 flex items-center gap-1.5 flex-wrap z-10 pointer-events-none">
                            <span
                                class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[10px] font-mono font-bold bg-black/80 backdrop-blur border {{ $themeMeta['badge'] }}">
                                <span class="w-1.5 h-1.5 rounded-full"
                                    style="background-color: {{ $themeMeta['color'] }}"></span>
                                <span>{{ $themeMeta['short'] }}</span>
                            </span>
                        </div>

                        <!-- Top Right Status Badges -->
                        <div class="absolute top-2.5 right-2.5 flex items-center gap-1 z-10 pointer-events-none">
                            @if ($item->is_featured)
                                <span title="Featured on Home Page"
                                    class="px-2 py-0.5 rounded-md text-[10px] font-mono font-bold uppercase bg-amber-500/20 text-amber-300 border border-amber-500/40 backdrop-blur flex items-center gap-1">
                                    ★ Home
                                </span>
                            @endif
                            <span
                                class="px-2 py-0.5 rounded-md text-[10px] font-mono font-bold uppercase {{ $item->is_active ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-rose-500/20 text-rose-300 border border-rose-500/30' }} backdrop-blur">
                                {{ $item->is_active ? 'Live' : 'Hidden' }}
                            </span>
                        </div>

                        <!-- Hover Pictureflect Preview Pill -->
                        <div
                            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity z-10 pointer-events-none bg-black/30">
                            <span
                                class="px-3 py-1.5 rounded-full bg-cyan-500 text-black text-xs font-bold tracking-wider uppercase font-mono shadow-lg shadow-cyan-500/30 flex items-center gap-1.5 transform translate-y-2 group-hover/img:translate-y-0 transition-transform">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    <line x1="11" y1="8" x2="11" y2="14"></line>
                                    <line x1="8" y1="11" x2="14" y2="11"></line>
                                </svg>
                                <span>Pictureflect View</span>
                            </span>
                        </div>

                        <!-- Image Title overlaid at bottom of image with blur background -->
                        <div
                            class="absolute bottom-0 inset-x-0 p-3 bg-gradient-to-t from-black/95 via-black/80 to-transparent backdrop-blur-md border-t border-white/10 z-10 flex flex-col gap-1">
                            <div class="flex items-center justify-between gap-1.5">
                                <span
                                    class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 shrink-0">
                                    {{ $item->category }}
                                </span>
                            </div>
                            <h3 class="text-xs sm:text-sm font-bold text-white truncate drop-shadow leading-snug"
                                title="{{ $item->title }}">
                                {{ $item->title }}
                            </h3>
                        </div>
                    </div>

                    <!-- Footer Action Controls (Remaining Same) -->
                    <div class="p-3 bg-[#09101d] border-t border-white/5 flex items-center justify-between text-xs">
                        <span class="font-mono text-[10px] text-slate-500">#{{ $item->sort_order }}</span>

                        <div class="flex items-center gap-1">
                            <!-- Toggle Featured -->
                            <form action="{{ route('admin.galleries.toggleFeatured', $item) }}" method="POST"
                                class="inline">
                                @csrf
                                <button type="submit"
                                    title="{{ $item->is_featured ? 'Remove from Home Showcase' : 'Feature on Home Showcase' }}"
                                    class="p-1.5 rounded-lg {{ $item->is_featured ? 'text-amber-400 bg-amber-500/10 hover:bg-amber-500/20' : 'text-slate-500 hover:text-amber-300 hover:bg-white/5' }} transition-all">
                                    <svg class="w-4 h-4" fill="{{ $item->is_featured ? 'currentColor' : 'none' }}"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </button>
                            </form>

                            <!-- Toggle Active -->
                            <form action="{{ route('admin.galleries.toggleActive', $item) }}" method="POST"
                                class="inline">
                                @csrf
                                <button type="submit" title="{{ $item->is_active ? 'Hide Photo' : 'Publish Photo' }}"
                                    class="p-1.5 rounded-lg {{ $item->is_active ? 'text-emerald-400 bg-emerald-500/10 hover:bg-emerald-500/20' : 'text-slate-500 hover:text-emerald-300 hover:bg-white/5' }} transition-all">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $item->is_active ? 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z' : 'M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18' }}" />
                                    </svg>
                                </button>
                            </form>

                            <!-- Edit -->
                            <a href="{{ route('admin.galleries.edit', $item) }}" title="Edit Photo"
                                class="p-1.5 rounded-lg text-cyan-400 hover:text-white hover:bg-cyan-600/30 transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to permanently delete this photo?')"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete Photo"
                                    class="p-1.5 rounded-lg text-rose-400 hover:text-white hover:bg-rose-600/30 transition-all">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center rounded-3xl bg-[#09101d] border border-white/10 space-y-4">
                    <div
                        class="w-16 h-16 rounded-3xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 flex items-center justify-center mx-auto text-2xl shadow-xl shadow-cyan-500/10">
                        📷
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-white">No Gallery Photos Yet</h3>
                        <p class="text-xs text-slate-400 max-w-sm mx-auto mt-1">
                            Upload high-resolution photography, system architectures, UI previews, or project screenshots.
                        </p>
                    </div>
                    <a href="{{ route('admin.galleries.create') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-cyan-600 hover:bg-cyan-500 text-white shadow-lg transition-all">
                        <span>Upload First Photo</span>
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Category Filter & Reactive Theme Category Script -->
    <script>
        let currentActiveCategory = 'all';
        let currentActiveTheme = '{{ $selectedTheme ?? $activeTheme }}';

        function getCurrentFilterTheme() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('theme') || '{{ $selectedTheme ?? $activeTheme }}';
        }

        // Dynamically compute and refresh category buttons for the active/selected theme
        function refreshCategoriesForTheme(themeKey) {
            currentActiveTheme = themeKey || getCurrentFilterTheme();
            window.currentActiveTheme = currentActiveTheme;
            const cards = document.querySelectorAll('.gallery-admin-card');
            const catCounts = {};
            let totalThemeCount = 0;

            cards.forEach(card => {
                const cardTheme = (card.getAttribute('data-theme') || '').toLowerCase().trim();
                const cardCat = card.getAttribute('data-category') || 'General';

                let match = false;
                if (currentActiveTheme === 'everything') {
                    match = true;
                } else if (currentActiveTheme === 'all') {
                    match = (cardTheme === 'all');
                } else {
                    match = (cardTheme === currentActiveTheme || cardTheme === 'all');
                }

                if (match) {
                    totalThemeCount++;
                    catCounts[cardCat] = (catCounts[cardCat] || 0) + 1;
                }
            });

            // Update "All" counter
            const allCountEl = document.getElementById('catCount_all');
            if (allCountEl) allCountEl.textContent = totalThemeCount;

            // Render theme-only category pill buttons
            const container = document.getElementById('dynamicThemeCategories');
            if (!container) return;
            container.innerHTML = '';

            const sortedCats = Object.keys(catCounts).sort();
            sortedCats.forEach(cat => {
                const count = catCounts[cat];
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className =
                    'cat-filter-btn whitespace-nowrap shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full font-mono text-xs font-medium bg-[#060b13] text-slate-300 border border-white/10 hover:border-cyan-500/40 hover:text-white transition-all';
                btn.setAttribute('data-category', cat);
                btn.onclick = function() {
                    filterGalleryCategory(cat);
                };
                btn.innerHTML =
                    `<span>${cat}</span><span class="cat-pill-count px-1.5 py-0.2 rounded-full text-[10px] bg-white/10 text-slate-400 font-mono">${count}</span>`;
                container.appendChild(btn);
            });
        }

        // Filter cards by category within the current theme
        function filterGalleryCategory(cat) {
            currentActiveCategory = cat;
            const cards = document.querySelectorAll('.gallery-admin-card');
            const buttons = document.querySelectorAll('.cat-filter-btn');

            buttons.forEach(b => {
                b.classList.remove('bg-cyan-500/20', 'text-cyan-300', 'border-cyan-500/40', 'font-bold');
                b.classList.add('bg-[#060b13]', 'text-slate-300', 'border-white/10');
            });

            if (cat === 'all') {
                const allBtn = document.getElementById('catBtn_all');
                if (allBtn) {
                    allBtn.classList.add('bg-cyan-500/20', 'text-cyan-300', 'border-cyan-500/40', 'font-bold');
                    allBtn.classList.remove('bg-[#060b13]', 'text-slate-300', 'border-white/10');
                }
            } else {
                const activeBtn = document.querySelector(`.cat-filter-btn[data-category="${cat}"]`);
                if (activeBtn) {
                    activeBtn.classList.add('bg-cyan-500/20', 'text-cyan-300', 'border-cyan-500/40', 'font-bold');
                    activeBtn.classList.remove('bg-[#060b13]', 'text-slate-300', 'border-white/10');
                }
            }

            cards.forEach(card => {
                const cardTheme = (card.getAttribute('data-theme') || '').toLowerCase().trim();
                const cardCat = card.getAttribute('data-category');

                let themeMatch = false;
                if (currentActiveTheme === 'everything') {
                    themeMatch = true;
                } else if (currentActiveTheme === 'all') {
                    themeMatch = (cardTheme === 'all');
                } else {
                    themeMatch = (cardTheme === currentActiveTheme || cardTheme === 'all');
                }

                const catMatch = (cat === 'all' || cardCat === cat);

                if (themeMatch && catMatch) {
                    card.style.display = '';
                    card.classList.remove('hidden');
                } else {
                    card.style.display = 'none';
                    card.classList.add('hidden');
                }
            });
        }

        // Initialize and listen to theme switch
        document.addEventListener('DOMContentLoaded', function() {
            const initialTheme = getCurrentFilterTheme();
            refreshCategoriesForTheme(initialTheme);
            filterGalleryCategory('all');

            // Hook into window.selectTheme to update categories when theme changes
            if (typeof window.selectTheme === 'function') {
                const originalSelectTheme = window.selectTheme;
                window.selectTheme = function(themeKey) {
                    originalSelectTheme(themeKey);
                    refreshCategoriesForTheme(themeKey);
                    filterGalleryCategory('all');
                };
            }
        });
    </script>
@endsection
