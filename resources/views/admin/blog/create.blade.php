@extends('admin.layout')

@section('title', 'Write Article')
@section('page_title', 'Create Blog Article')
@section('page_subtitle', 'Group: Website')

@section('content')
<div class="w-full space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold text-white">Publish New Article</h1>
        <a href="{{ route('admin.blog.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Back to Articles</a>
    </div>

    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" class="p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-5">
        @csrf

        <!-- Title -->
        <div>
            <label class="block text-xs font-mono text-slate-400 mb-1">Article Title *</label>
            <input type="text" name="title" required value="{{ old('title') }}" placeholder="e.g. Mastering Typography in Modern Interfaces" class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
        </div>

        <!-- Slug & Category -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Custom Slug (Optional, auto-generated if blank)</label>
                <input type="text" name="slug" value="{{ old('slug') }}" placeholder="mastering-typography" class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Category Label *</label>
                <input type="text" name="category" required value="{{ old('category', 'UI/UX Design') }}" placeholder="e.g. Typography, Branding, Engineering" class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
        </div>

        <!-- Blog Cover Image (Upload / URL / Live Preview) -->
        <div class="p-5 rounded-2xl bg-[#060b13] border border-white/10 space-y-4">
            <div class="flex items-center justify-between pb-2 border-b border-white/5">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                    <label class="text-xs font-mono font-bold uppercase tracking-wider text-indigo-300">Cover / Featured Image</label>
                </div>
                <span class="text-[10px] font-mono text-slate-500">Upload an image file or enter an external image URL</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-center">
                <!-- Live Image Preview Box -->
                <div class="md:col-span-4 lg:col-span-4">
                    <div class="relative w-full aspect-video rounded-xl bg-[#09101d] border border-white/10 flex items-center justify-center overflow-hidden group shadow-inner">
                        <span id="preview_badge" class="absolute top-2 left-2 z-10 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-black/70 text-slate-400 backdrop-blur border border-white/10">
                            No Image
                        </span>

                        <img id="blog_image_preview"
                            src=""
                            alt="Cover Preview"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105 hidden">

                        <div id="preview_placeholder" class="text-center p-4">
                            <svg class="w-10 h-10 mx-auto text-slate-600 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
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
                            <label class="block text-xs font-mono text-slate-300 font-semibold">Upload Cover Image File</label>
                            <span class="text-[10px] font-mono text-slate-500">JPG, PNG, WEBP, GIF, SVG (Max: 5MB)</span>
                        </div>
                        <input type="file" name="image_file" id="blog_image_file" accept="image/*" onchange="handleBlogImageFile(this)"
                            class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-slate-300 text-xs file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600/30 file:text-indigo-300 hover:file:bg-indigo-600/50 cursor-pointer">
                    </div>

                    <!-- Divider -->
                    <div class="flex items-center gap-3">
                        <div class="flex-1 h-px bg-white/10"></div>
                        <span class="text-[10px] font-mono text-slate-500 uppercase tracking-wider font-semibold">OR</span>
                        <div class="flex-1 h-px bg-white/10"></div>
                    </div>

                    <!-- Option B: Image URL -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-xs font-mono text-slate-300 font-semibold">Cover Image URL (Direct / External CDN)</label>
                            <button type="button" onclick="clearBlogImage()" class="text-[10px] font-mono text-rose-400 hover:text-rose-300 transition-colors">Clear</button>
                        </div>
                        <input type="text" name="image" id="blog_image_url_input"
                            value="{{ old('image') }}"
                            placeholder="https://images.unsplash.com/... or /images/..."
                            oninput="handleBlogImageUrl(this.value)"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono focus:outline-none focus:border-indigo-500 transition-colors">
                    </div>
                </div>
            </div>
        </div>

        <!-- Author, Read Time, Date -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Author Name</label>
                <input type="text" name="author" value="{{ old('author', 'Alex Rivera') }}" class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Read Time Estimate</label>
                <input type="text" name="read_time" value="{{ old('read_time', '5 min read') }}" class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Publish Date Display</label>
                <input type="text" name="date" value="{{ old('date', date('M d, Y')) }}" class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
        </div>

        <!-- Excerpt -->
        <div>
            <label class="block text-xs font-mono text-slate-400 mb-1">Summary / Excerpt *</label>
            <textarea name="excerpt" rows="2" required placeholder="A brief one or two sentence teaser for the article card..." class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">{{ old('excerpt') }}</textarea>
        </div>

        <!-- Content -->
        <div>
            <label class="block text-xs font-mono text-slate-400 mb-1">Full Article Body *</label>
            <textarea name="content" rows="8" required data-height="350" placeholder="Write the complete article content..." class="summernote w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white text-sm leading-relaxed focus:outline-none focus:border-indigo-500 font-sans">{{ old('content') }}</textarea>
        </div>

        <!-- Theme, Sort Order & Published Status -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Display Theme</label>
                @php
                    $targetTheme = request('theme', $selectedTheme ?? \App\Models\SiteSetting::getActiveTheme());
                @endphp
                <select name="theme" class="w-full px-3 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                    <option value="all" {{ $targetTheme === 'all' ? 'selected' : '' }}>All Themes</option>
                    <option value="developer" {{ $targetTheme === 'developer' ? 'selected' : '' }}>Developer</option>
                    <option value="graphic_designer" {{ $targetTheme === 'graphic_designer' ? 'selected' : '' }}>Graphic Designer</option>
                    <option value="uiux_designer" {{ $targetTheme === 'uiux_designer' ? 'selected' : '' }}>UI/UX Designer</option>
                    <option value="app_developer" {{ $targetTheme === 'app_developer' ? 'selected' : '' }}>App Developer</option>
                    <option value="app_software_developer" {{ $targetTheme === 'app_software_developer' ? 'selected' : '' }}>App &amp; Software Developer</option>
                    <option value="digital_designer_illustrator" {{ $targetTheme === 'digital_designer_illustrator' ? 'selected' : '' }}>Digital Designer &amp; Illustrator</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Display Order</label>
                <input type="number" name="sort_order" value="1" class="w-full px-3 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
            </div>
            <div class="flex items-center pt-5">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" checked class="w-4 h-4 rounded text-indigo-600 bg-black/40 border-white/10 focus:ring-0">
                    <span class="text-xs text-white font-medium">Published / Visible</span>
                </label>
            </div>
        </div>

        <div class="pt-4 flex items-center justify-end gap-3 border-t border-white/10">
            <a href="{{ route('admin.blog.index') }}" class="px-4 py-2 rounded-xl text-xs text-slate-400 hover:text-white">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all">Publish Article</button>
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
                badge.className = 'absolute top-2 left-2 z-10 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-emerald-500/80 text-white backdrop-blur shadow border border-emerald-400/30';
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
                badge.className = 'absolute top-2 left-2 z-10 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-indigo-500/80 text-white backdrop-blur shadow border border-indigo-400/30';
            } else if (defaultImage) {
                previewImg.src = defaultImage;
                previewImg.classList.remove('hidden');
                placeholder.classList.add('hidden');
                badge.textContent = 'Current Image';
                badge.className = 'absolute top-2 left-2 z-10 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-black/70 text-slate-400 backdrop-blur border border-white/10';
            } else {
                previewImg.classList.add('hidden');
                placeholder.classList.remove('hidden');
                badge.textContent = 'No Image';
                badge.className = 'absolute top-2 left-2 z-10 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-black/70 text-slate-500 backdrop-blur border border-white/10';
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
        badge.className = 'absolute top-2 left-2 z-10 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-black/70 text-slate-500 backdrop-blur border border-white/10';
    }

    // Handle broken preview URLs gracefully
    document.getElementById('blog_image_preview')?.addEventListener('error', function() {
        const placeholder = document.getElementById('preview_placeholder');
        const badge = document.getElementById('preview_badge');
        this.classList.add('hidden');
        placeholder.classList.remove('hidden');
        badge.textContent = 'Invalid Image URL';
        badge.className = 'absolute top-2 left-2 z-10 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-rose-500/80 text-white backdrop-blur border border-rose-400/30';
    });

    // Trigger initial preview if old value exists
    const initialVal = document.getElementById('blog_image_url_input')?.value;
    if (initialVal) {
        handleBlogImageUrl(initialVal);
    }
</script>
@endsection
