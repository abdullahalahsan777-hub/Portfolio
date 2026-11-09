@extends('admin.layout')

@section('title', 'Write Article')
@section('page_title', 'Create Blog Article')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="w-full space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <h1 class="text-xl font-bold text-white">Publish New Article</h1>
            <a href="{{ route('admin.blog.index') }}"
                class="text-xs text-slate-400 hover:text-white inline-flex items-center gap-1.5">&larr; Back to Articles</a>
        </div>

        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data"
            class="p-4 sm:p-6 lg:p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-5">
            @csrf

            <!-- Title -->
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Article Title *</label>
                <input type="text" name="title" required value="{{ old('title') }}"
                    placeholder="e.g. Mastering Typography in Modern Interfaces"
                    class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <!-- Slug & Category -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Custom Slug (Optional, auto-generated if
                        blank)</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" placeholder="mastering-typography"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono focus:outline-none focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Display Theme</label>
                    @php
                        $targetTheme = request('theme', $selectedTheme ?? \App\Models\SiteSetting::getActiveTheme());
                    @endphp
                    <select name="theme"
                        class="w-full px-3 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                        <option value="all" {{ $targetTheme === 'all' ? 'selected' : '' }}>All Themes</option>
                        <option value="developer" {{ $targetTheme === 'developer' ? 'selected' : '' }}>Developer</option>
                        <option value="graphic_designer" {{ $targetTheme === 'graphic_designer' ? 'selected' : '' }}>
                            Graphic Designer</option>
                        <option value="uiux_designer" {{ $targetTheme === 'uiux_designer' ? 'selected' : '' }}>UI/UX
                            Designer</option>
                        <option value="app_developer" {{ $targetTheme === 'app_developer' ? 'selected' : '' }}>App
                            Developer</option>
                        <option value="app_software_developer"
                            {{ $targetTheme === 'app_software_developer' ? 'selected' : '' }}>App &amp; Software Developer
                        </option>
                        <option value="digital_designer_illustrator"
                            {{ $targetTheme === 'digital_designer_illustrator' ? 'selected' : '' }}>Digital Designer &amp;
                            Illustrator</option>
                        <option value="laravel_developer" {{ $targetTheme === 'laravel_developer' ? 'selected' : '' }}>
                            Full-Stack Laravel Developer</option>
                    </select>
                </div>

                <!-- Excerpt -->
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Summary / Excerpt *</label>
                    <textarea name="excerpt" rows="3" required
                        placeholder="A brief one or two sentence teaser for the article card..."
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">{{ old('excerpt') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-300 font-semibold mb-1.5">Category * (Select or Type
                        New)</label>
                    <div class="relative custom-category-wrapper">
                        <select name="category" id="blogCategorySelect" required
                            class="select2-category-tags no-select2 w-full px-4 py-2.5 rounded-xl bg-[#0d1627] border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-500 transition-colors"
                            data-placeholder="Select or type a category...">
                            @php
                                $categoryOptions = collect($categories ?? \App\Models\BlogPost::getCategories())
                                    ->map(fn($c) => trim($c))
                                    ->filter()
                                    ->unique()
                                    ->values();
                                $quickPills = collect($quickCategories ?? \App\Models\BlogPost::getQuickCategories());
                                $defaultCat = old('category', $categoryOptions->first() ?? 'UI/UX Design');
                            @endphp
                            @foreach ($categoryOptions as $cat)
                                <option value="{{ $cat }}" {{ $defaultCat === $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Quick Category Pills -->
                    @if ($quickPills->isNotEmpty())
                        <div class="flex items-center gap-1.5 flex-nowrap overflow-hidden mt-2.5 max-w-full">
                            <span
                                class="text-[10px] font-mono text-slate-500 uppercase tracking-wider shrink-0">Quick:</span>
                            @foreach ($quickPills as $pill)
                                <button type="button"
                                    onclick="setSelectCategory('blogCategorySelect', '{{ addslashes($pill) }}')"
                                    title="{{ $pill }}"
                                    class="whitespace-nowrap shrink-0 px-2.5 py-1 rounded-full text-[10px] font-mono bg-white/5 hover:bg-cyan-500/20 text-slate-400 hover:text-cyan-300 border border-white/10 hover:border-cyan-500/30 transition-all cursor-pointer">
                                    {{ $pill }}
                                </button>
                            @endforeach
                        </div>
                    @endif
                    @error('category')
                        <p class="text-[11px] text-rose-400 mt-1 font-mono">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Author, Read Time, Date -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Author Name</label>
                    <input type="text" name="author" value="{{ old('author', auth()->user()?->name ?? '') }}"
                        placeholder="Author name..."
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Read Time Estimate</label>
                    <input type="text" name="read_time" value="{{ old('read_time', '5 min read') }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1" for="blog_publish_date">Publish Date
                        Display</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4 text-cyan-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" type="text" name="date"
                            id="blog_publish_date" value="{{ old('date', date('Y-m-d')) }}" placeholder="YYYY-MM-DD"
                            class="flowbite-datepicker ps-9 w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-500 transition-colors">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Display Order</label>
                    <input type="number" name="sort_order" value="1"
                        class="w-full px-3 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                </div>
            </div>

            <!-- Blog Cover Image (Upload / URL / Live Preview) -->
            <div class="p-5 rounded-2xl bg-[#060b13] border border-white/10 space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-white/5">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                        <label class="text-xs font-mono font-bold uppercase tracking-wider text-indigo-300">Cover / Featured
                            Image</label>
                    </div>
                    <span class="text-[10px] font-mono text-slate-500">Upload an image file or enter an external image
                        URL</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-center">
                    <!-- Live Image Preview Box -->
                    <div class="md:col-span-4 lg:col-span-4">
                        <div
                            class="relative w-full aspect-video rounded-xl bg-[#09101d] border border-white/10 flex items-center justify-center overflow-hidden group shadow-inner">
                            <span id="preview_badge"
                                class="absolute top-2 left-2 z-10 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-black/70 text-slate-400 backdrop-blur border border-white/10">
                                No Image
                            </span>

                            <img id="blog_image_preview" src="" alt="Cover Preview"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105 hidden">

                            <div id="preview_placeholder" class="text-center p-4">
                                <svg class="w-10 h-10 mx-auto text-slate-600 mb-1" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-[11px] font-mono text-slate-500 block">No Image Preview</span>
                            </div>
                        </div>
                    </div>

                    <!-- Input Controls: File Upload & URL -->
                    <div class="md:col-span-8 lg:col-span-8 space-y-3.5">
                        <!-- Option A: File Upload -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="block text-xs font-mono text-slate-300 font-semibold">Upload Cover Image
                                    File</label>
                                <span class="text-[10px] font-mono text-slate-500">JPG, PNG, WEBP, GIF, SVG (Max:
                                    5MB)</span>
                            </div>
                            <input type="file" name="image_file" id="blog_image_file" accept="image/*"
                                onchange="handleBlogImageFile(this)"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-slate-300 text-xs file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600/30 file:text-indigo-300 hover:file:bg-indigo-600/50 cursor-pointer">
                        </div>

                        <!-- Divider -->
                        <div class="flex items-center gap-3">
                            <div class="flex-1 h-px bg-white/10"></div>
                            <span
                                class="text-[10px] font-mono text-slate-500 uppercase tracking-wider font-semibold">OR</span>
                            <div class="flex-1 h-px bg-white/10"></div>
                        </div>

                        <!-- Option B: Image URL -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="block text-xs font-mono text-slate-300 font-semibold">Cover Image URL (Direct
                                    / External CDN)</label>
                                <button type="button" onclick="clearBlogImage()"
                                    class="text-[10px] font-mono text-rose-400 hover:text-rose-300 transition-colors">Clear</button>
                            </div>
                            <input type="text" name="image" id="blog_image_url_input" value="{{ old('image') }}"
                                placeholder="https://images.unsplash.com/... or /images/..."
                                oninput="handleBlogImageUrl(this.value)"
                                class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono focus:outline-none focus:border-indigo-500 transition-colors">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Full Article Body *</label>
                <textarea name="content" rows="8" required data-height="350"
                    placeholder="Write the complete article content..."
                    class="summernote w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white text-sm leading-relaxed focus:outline-none focus:border-indigo-500 font-sans">{{ old('content') }}</textarea>
            </div>

            <div class="flex items-center justify-between border-t border-white/10">
                <div class="flex items-center pt-5">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" checked
                            class="w-4 h-4 rounded text-indigo-600 bg-black/40 border-white/10 focus:ring-0">
                        <span class="text-xs text-white font-medium">Published / Visible</span>
                    </label>
                </div>

                <div class="pt-4 flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                    <a href="{{ route('admin.blog.index') }}"
                        class="w-full sm:w-auto px-4 py-2.5 rounded-xl text-xs text-slate-400 hover:text-white text-center">Cancel</a>
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all text-center">Publish
                        Article</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Live Image Preview Script -->
    <script>
        const defaultImage = "";

        function handleBlogImageFile(input) {
            const previewImg = document.getElementById('blog_image_preview');
            const placeholder = document.getElementById('preview_placeholder');
            const badge = document.getElementById('preview_badge');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                    badge.textContent = 'New File to Upload';
                    badge.className =
                        'absolute top-2 left-2 z-10 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-emerald-500/80 text-white backdrop-blur shadow border border-emerald-400/30';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function handleBlogImageUrl(val) {
            const fileInput = document.getElementById('blog_image_file');
            const previewImg = document.getElementById('blog_image_preview');
            const placeholder = document.getElementById('preview_placeholder');
            const badge = document.getElementById('preview_badge');

            if (!fileInput.files.length) {
                const trimmed = val.trim();
                if (trimmed) {
                    previewImg.src = trimmed;
                    previewImg.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                    badge.textContent = 'URL Preview';
                    badge.className =
                        'absolute top-2 left-2 z-10 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-indigo-500/80 text-white backdrop-blur shadow border border-indigo-400/30';
                } else if (defaultImage) {
                    previewImg.src = defaultImage;
                    previewImg.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                    badge.textContent = 'Current Image';
                    badge.className =
                        'absolute top-2 left-2 z-10 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-black/70 text-slate-400 backdrop-blur border border-white/10';
                } else {
                    previewImg.classList.add('hidden');
                    placeholder.classList.remove('hidden');
                    badge.textContent = 'No Image';
                    badge.className =
                        'absolute top-2 left-2 z-10 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-black/70 text-slate-500 backdrop-blur border border-white/10';
                }
            }
        }

        function clearBlogImage() {
            const fileInput = document.getElementById('blog_image_file');
            const urlInput = document.getElementById('blog_image_url_input');
            const previewImg = document.getElementById('blog_image_preview');
            const placeholder = document.getElementById('preview_placeholder');
            const badge = document.getElementById('preview_badge');

            fileInput.value = '';
            urlInput.value = '';
            previewImg.src = '';
            previewImg.classList.add('hidden');
            placeholder.classList.remove('hidden');
            badge.textContent = 'No Image';
            badge.className =
                'absolute top-2 left-2 z-10 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-black/70 text-slate-500 backdrop-blur border border-white/10';
        }

        // Handle broken preview URLs gracefully
        document.getElementById('blog_image_preview')?.addEventListener('error', function() {
            const placeholder = document.getElementById('preview_placeholder');
            const badge = document.getElementById('preview_badge');
            this.classList.add('hidden');
            placeholder.classList.remove('hidden');
            badge.textContent = 'Invalid Image URL';
            badge.className =
                'absolute top-2 left-2 z-10 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-rose-500/80 text-white backdrop-blur border border-rose-400/30';
        });

        // Trigger initial preview if old value exists
        const initialVal = document.getElementById('blog_image_url_input')?.value;
        if (initialVal) {
            handleBlogImageUrl(initialVal);
        }
    </script>
@endsection
