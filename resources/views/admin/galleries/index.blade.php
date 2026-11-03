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
                    <span class="w-10 h-10 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 flex items-center justify-center text-lg shadow-lg shadow-cyan-500/10">
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
                    Manage visual showcase items across all themes with categories, home featured status, and high-res Pictureflect Viewer preview.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('gallery') }}" target="_blank"
                    class="px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-white/5 hover:bg-white/10 text-slate-300 border border-white/10 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    <span>Frontend View</span>
                </a>
                <a href="{{ route('admin.galleries.create') }}"
                    class="theme-aware-create-btn px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white shadow-lg shadow-cyan-500/20 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Add New Photo</span>
                </a>
            </div>
        </div>

        <!-- TOP THEME FILTER COMPONENT -->
        @include('admin.components.theme-filter')

        <!-- Category Filter Pills Bar -->
        @if ($categories->isNotEmpty())
            <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none text-xs">
                <span class="text-[11px] font-mono text-slate-400 uppercase tracking-wider font-semibold mr-1">Categories:</span>
                <button type="button" onclick="filterGalleryCategory('all')" id="catBtn_all"
                    class="cat-filter-btn px-3 py-1.5 rounded-xl font-mono text-[11px] font-bold bg-cyan-500/20 text-cyan-300 border border-cyan-500/40 transition-all">
                    All ({{ $galleries->count() }})
                </button>
                @foreach ($categories as $cat)
                    @php
                        $catCount = $galleries->where('category', $cat)->count();
                    @endphp
                    <button type="button" onclick="filterGalleryCategory('{{ addslashes($cat) }}')" id="catBtn_{{ md5($cat) }}"
                        class="cat-filter-btn px-3 py-1.5 rounded-xl font-mono text-[11px] font-medium bg-[#09101d] text-slate-400 border border-white/10 hover:border-white/25 hover:text-white transition-all">
                        {{ $cat }} ({{ $catCount }})
                    </button>
                @endforeach
            </div>
        @endif

        <!-- Galleries Grid with data-theme & data-cat filtering -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="galleriesGrid">
            @forelse($galleries as $item)
                @php
                    $themeMeta = \App\Models\SiteSetting::getThemeDetails($item->theme);
                @endphp
                <div data-theme="{{ $item->theme }}" data-category="{{ $item->category }}"
                    class="gallery-admin-card rounded-2xl bg-[#09101d] border border-white/10 overflow-hidden shadow-xl flex flex-col justify-between hover:border-cyan-500/40 transition-all duration-300 group">
                    <div>
                        <!-- Image Container with Pictureflect trigger -->
                        <div class="aspect-4/3 w-full bg-slate-900 overflow-hidden relative cursor-pointer group/img"
                            data-pictureflect
                            data-gallery="admin-galleries"
                            data-src="{{ $item->image_url }}"
                            data-title="{{ $item->title }}"
                            data-category="{{ $item->category }}"
                            data-theme="{{ $themeMeta['name'] ?? $item->theme }}"
                            data-caption="{{ $item->caption }}">
                            
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-110">
                            
                            <!-- Dark Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/30 opacity-70 group-hover/img:opacity-90 transition-opacity"></div>

                            <!-- Top Badges -->
                            <div class="absolute top-2.5 left-2.5 flex items-center gap-1.5 flex-wrap z-10">
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[10px] font-mono font-bold bg-black/80 backdrop-blur border {{ $themeMeta['badge'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full" style="background-color: {{ $themeMeta['color'] }}"></span>
                                    <span>{{ $themeMeta['short'] }}</span>
                                </span>
                            </div>

                            <div class="absolute top-2.5 right-2.5 flex items-center gap-1 z-10">
                                @if ($item->is_featured)
                                    <span title="Featured on Home Page"
                                        class="px-2 py-0.5 rounded-md text-[10px] font-mono font-bold uppercase bg-amber-500/20 text-amber-300 border border-amber-500/40 backdrop-blur flex items-center gap-1">
                                        ★ Home
                                    </span>
                                @endif
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-mono font-bold uppercase {{ $item->is_active ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-rose-500/20 text-rose-300 border border-rose-500/30' }} backdrop-blur">
                                    {{ $item->is_active ? 'Live' : 'Hidden' }}
                                </span>
                            </div>

                            <!-- Hover Pictureflect Preview Pill -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity z-10">
                                <span class="px-3 py-1.5 rounded-full bg-cyan-500/90 text-black text-xs font-bold tracking-wider uppercase font-mono shadow-lg shadow-cyan-500/30 flex items-center gap-1.5 transform translate-y-2 group-hover/img:translate-y-0 transition-transform">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        <line x1="11" y1="8" x2="11" y2="14"></line>
                                        <line x1="8" y1="11" x2="14" y2="11"></line>
                                    </svg>
                                    <span>Pictureflect View</span>
                                </span>
                            </div>

                            <!-- Category Bottom Floating Tag -->
                            <div class="absolute bottom-2.5 left-2.5 z-10">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase bg-black/75 text-cyan-300 border border-cyan-500/30 backdrop-blur">
                                    {{ $item->category }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-4 space-y-1.5">
                            <h3 class="text-sm font-bold text-white truncate" title="{{ $item->title }}">{{ $item->title }}</h3>
                            @if (!empty($item->caption))
                                <p class="text-xs text-slate-400 line-clamp-2 leading-relaxed">{{ $item->caption }}</p>
                            @else
                                <p class="text-xs text-slate-500 italic">No description provided</p>
                            @endif
                        </div>
                    </div>

                    <!-- Footer Controls -->
                    <div class="p-4 pt-2 border-t border-white/5 flex items-center justify-between text-xs mt-2">
                        <span class="font-mono text-[10px] text-slate-500">#{{ $item->sort_order }}</span>

                        <div class="flex items-center gap-1">
                            <!-- Toggle Featured -->
                            <form action="{{ route('admin.galleries.toggleFeatured', $item) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" title="{{ $item->is_featured ? 'Remove from Home Showcase' : 'Feature on Home Showcase' }}"
                                    class="p-1.5 rounded-lg {{ $item->is_featured ? 'text-amber-400 bg-amber-500/10 hover:bg-amber-500/20' : 'text-slate-500 hover:text-amber-300 hover:bg-white/5' }} transition-all">
                                    <svg class="w-4 h-4" fill="{{ $item->is_featured ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </button>
                            </form>

                            <!-- Toggle Active -->
                            <form action="{{ route('admin.galleries.toggleActive', $item) }}" method="POST" class="inline">
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
                                onsubmit="return confirm('Are you sure you want to permanently delete this photo?')" class="inline">
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
                    <div class="w-16 h-16 rounded-3xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 flex items-center justify-center mx-auto text-2xl shadow-xl shadow-cyan-500/10">
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

    <!-- Category Filter Script -->
    <script>
        function filterGalleryCategory(cat) {
            const cards = document.querySelectorAll('.gallery-admin-card');
            const buttons = document.querySelectorAll('.cat-filter-btn');

            buttons.forEach(b => {
                b.classList.remove('bg-cyan-500/20', 'text-cyan-300', 'border-cyan-500/40');
                b.classList.add('bg-[#09101d]', 'text-slate-400', 'border-white/10');
            });

            const activeBtn = cat === 'all' 
                ? document.getElementById('catBtn_all') 
                : document.querySelector(`[onclick*="${cat}"]`);
            if (activeBtn) {
                activeBtn.classList.add('bg-cyan-500/20', 'text-cyan-300', 'border-cyan-500/40');
                activeBtn.classList.remove('bg-[#09101d]', 'text-slate-400', 'border-white/10');
            }

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
