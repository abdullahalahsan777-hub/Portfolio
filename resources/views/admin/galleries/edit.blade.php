@extends('admin.layout')

@section('title', 'Edit Gallery Photo')
@section('page_title', 'Edit Photo')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="w-full space-y-6 max-w-5xl">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h1 class="text-xl font-bold text-white flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 flex items-center justify-center text-sm">
                        ✎
                    </span>
                    <span>Edit Photo: {{ $gallery->title }}</span>
                </h1>
                <p class="text-xs text-slate-400 mt-0.5">Update photo details, replace high-res asset, or adjust category and theme routing.</p>
            </div>
            <a href="{{ route('admin.galleries.index') }}"
                class="text-xs text-slate-400 hover:text-white inline-flex items-center gap-1.5 transition-colors">
                &larr; Back to Photo Gallery
            </a>
        </div>

        <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data"
            class="p-4 sm:p-6 lg:p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-6">
            @csrf
            @method('PUT')

            <!-- Title & Category Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-300 font-semibold mb-1.5">Photo Title *</label>
                    <input type="text" name="title" required value="{{ old('title', $gallery->title) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-500 transition-colors">
                    @error('title')
                        <p class="text-[11px] text-rose-400 mt-1 font-mono">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-300 font-semibold mb-1.5">Category *</label>
                    <input type="text" name="category" id="gallery_category_input" required value="{{ old('category', $gallery->category) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-500 transition-colors">
                    
                    <!-- Quick Category Pills -->
                    <div class="flex items-center gap-1.5 flex-wrap mt-2">
                        <span class="text-[10px] font-mono text-slate-500">Suggestions:</span>
                        @php
                            $suggestedCats = ['Architecture & Systems', 'UI/UX Designs', 'Photography', 'Workspace', 'Certificates', 'Events', 'Mobile Apps', 'Branding'];
                        @endphp
                        @foreach ($suggestedCats as $sc)
                            <button type="button" onclick="document.getElementById('gallery_category_input').value = '{{ $sc }}'"
                                class="px-2 py-0.5 rounded text-[10px] font-mono bg-white/5 hover:bg-cyan-500/20 text-slate-400 hover:text-cyan-300 border border-white/5 hover:border-cyan-500/30 transition-all">
                                {{ $sc }}
                            </button>
                        @endforeach
                    </div>
                    @error('category')
                        <p class="text-[11px] text-rose-400 mt-1 font-mono">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Target Theme & Ordering -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-300 font-semibold mb-1.5">Target Theme *</label>
                    <select name="theme"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-500 transition-colors">
                        <option value="all" {{ old('theme', $gallery->theme) === 'all' ? 'selected' : '' }}>
                            🌟 Global Showcase (All Themes)
                        </option>
                        <option value="laravel_developer" {{ old('theme', $gallery->theme) === 'laravel_developer' ? 'selected' : '' }}>
                            ⚡ Full-Stack Laravel Developer
                        </option>
                        <option value="developer" {{ old('theme', $gallery->theme) === 'developer' ? 'selected' : '' }}>
                            💻 Modern Software Engineer / Developer
                        </option>
                        <option value="uiux_designer" {{ old('theme', $gallery->theme) === 'uiux_designer' ? 'selected' : '' }}>
                            🎨 UI/UX Product Designer
                        </option>
                        <option value="graphic_designer" {{ old('theme', $gallery->theme) === 'graphic_designer' ? 'selected' : '' }}>
                            ✒️ Creative Graphic Designer
                        </option>
                        <option value="digital_designer_illustrator" {{ old('theme', $gallery->theme) === 'digital_designer_illustrator' ? 'selected' : '' }}>
                            ✨ Digital Designer & Illustrator
                        </option>
                        <option value="app_developer" {{ old('theme', $gallery->theme) === 'app_developer' ? 'selected' : '' }}>
                            📱 Mobile App Developer (iOS & Android)
                        </option>
                        <option value="app_software_developer" {{ old('theme', $gallery->theme) === 'app_software_developer' ? 'selected' : '' }}>
                            🚀 Application & Software Specialist
                        </option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-300 font-semibold mb-1.5">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-500 transition-colors">
                </div>
            </div>

            <!-- Current Photo & Replacement Box -->
            <div class="p-5 rounded-2xl bg-[#060b13] border border-white/10 space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-white/5">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                        <label class="text-xs font-mono font-bold uppercase tracking-wider text-cyan-300">Current Photo &amp; Replace Asset</label>
                    </div>
                    <span class="text-[10px] font-mono text-slate-500">Click photo to launch in Pictureflect Viewer</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-center">
                    <!-- Image Preview Area with Pictureflect Trigger -->
                    <div class="md:col-span-5">
                        <div class="relative w-full aspect-4/3 rounded-xl bg-[#09101d] border border-white/10 flex items-center justify-center overflow-hidden group shadow-inner cursor-pointer"
                            data-pictureflect
                            data-gallery="edit-preview"
                            data-src="{{ $gallery->image_url }}"
                            data-title="{{ $gallery->title }}"
                            data-category="{{ $gallery->category }}"
                            data-caption="{{ $gallery->caption }}">
                            
                            <span id="preview_badge" class="absolute top-2 left-2 z-10 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-black/70 text-cyan-300 backdrop-blur border border-cyan-500/30">
                                Current Asset
                            </span>

                            <img id="gallery_image_preview"
                                src="{{ $gallery->image_url }}"
                                alt="{{ $gallery->title }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">

                            <!-- Hover Pictureflect Preview Pill -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/40 z-10">
                                <span class="px-3 py-1.5 rounded-full bg-cyan-500 text-black text-xs font-bold tracking-wider uppercase font-mono shadow-lg flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        <line x1="11" y1="8" x2="11" y2="14"></line>
                                        <line x1="8" y1="11" x2="14" y2="11"></line>
                                    </svg>
                                    <span>Preview with Pictureflect</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Replace Controls -->
                    <div class="md:col-span-7 space-y-4">
                        <div>
                            <label class="block text-xs font-mono text-slate-300 font-semibold mb-1">Replace Image File</label>
                            <input type="file" name="image_file" id="gallery_image_file" accept="image/*" onchange="handleGalleryImagePreview(this)"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-slate-300 text-xs file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-cyan-600/30 file:text-cyan-300 hover:file:bg-cyan-600/50 cursor-pointer">
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="h-px bg-white/10 flex-1"></span>
                            <span class="text-[10px] font-mono uppercase text-slate-500">OR External Image URL</span>
                            <span class="h-px bg-white/10 flex-1"></span>
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-slate-300 font-semibold mb-1">Image URL</label>
                            <input type="url" name="image_url" id="gallery_image_url" value="{{ old('image_url', $gallery->getRawOriginal('image_url')) }}"
                                oninput="handleGalleryUrlPreview(this.value)"
                                class="w-full px-4 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono focus:outline-none focus:border-cyan-500">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Caption / Story Description -->
            <div>
                <label class="block text-xs font-mono text-slate-300 font-semibold mb-1.5">Caption &amp; Story Description (Optional)</label>
                <textarea name="caption" rows="3" placeholder="Context, technical specifications, or notes..."
                    class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-500 transition-colors">{{ old('caption', $gallery->caption) }}</textarea>
            </div>

            <!-- Toggles: Featured & Active -->
            <div class="flex flex-wrap items-center gap-6 p-4 rounded-2xl bg-black/20 border border-white/5">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $gallery->is_featured) ? 'checked' : '' }}
                        class="w-4 h-4 rounded text-cyan-600 focus:ring-cyan-500 bg-black/40 border-white/20">
                    <span class="text-xs font-mono text-slate-300 font-bold flex items-center gap-1.5">
                        <span class="text-amber-400">★</span> Feature on Home Page Gallery Section
                    </span>
                </label>

                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}
                        class="w-4 h-4 rounded text-cyan-600 focus:ring-cyan-500 bg-black/40 border-white/20">
                    <span class="text-xs font-mono text-slate-300 font-bold">
                        Publish to Live Gallery
                    </span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between gap-3 pt-4 border-t border-white/10">
                <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST"
                    onsubmit="return confirm('Permanently delete this photo?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 rounded-xl font-bold text-xs uppercase tracking-wider text-rose-400 hover:text-white hover:bg-rose-600/20 transition-all flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span>Delete Photo</span>
                    </button>
                </form>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.galleries.index') }}"
                        class="px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider text-slate-400 hover:text-white transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-7 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white shadow-lg shadow-cyan-500/20 active:scale-95 transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Update Photo</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Live Preview Script -->
    <script>
        function handleGalleryImagePreview(input) {
            const preview = document.getElementById('gallery_image_preview');
            const badge = document.getElementById('preview_badge');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    badge.textContent = 'New Selected File';
                    badge.classList.remove('text-slate-400');
                    badge.classList.add('text-amber-300', 'border-amber-500/40');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function handleGalleryUrlPreview(url) {
            const preview = document.getElementById('gallery_image_preview');
            const badge = document.getElementById('preview_badge');

            if (url && url.trim().length > 5) {
                preview.src = url;
                badge.textContent = 'New Remote URL';
                badge.classList.remove('text-slate-400');
                badge.classList.add('text-amber-300', 'border-amber-500/40');
            }
        }
    </script>
@endsection
