@extends('admin.layout')

@section('title', 'Add Testimonial')
@section('page_title', 'Create Testimonial')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="w-full space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-white">Create Client Testimonial</h1>
            <a href="{{ route('admin.testimonials.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Back to
                Testimonials</a>
        </div>

        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data"
            class="p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Client Name *</label>
                    <input type="text" name="client_name" value="{{ old('client_name') }}" required placeholder="e.g. Marcus Vance"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Role / Title *</label>
                    <input type="text" name="client_role" value="{{ old('client_role') }}" required placeholder="e.g. Founder & CEO"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Company</label>
                    <input type="text" name="company" value="{{ old('company') }}" placeholder="e.g. Aura Media Studio"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Star Rating (1-5) *</label>
                    <input type="number" name="rating" min="1" max="5" required value="{{ old('rating', 5) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <!-- Client Avatar Image (Upload / URL / Live Preview) -->
            <div class="p-5 rounded-2xl bg-[#060b13] border border-white/10 space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-white/5">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                        <label class="text-xs font-mono font-bold uppercase tracking-wider text-indigo-300">Client Avatar Image</label>
                    </div>
                    <span class="text-[10px] font-mono text-slate-500">Upload a client photo or enter an image URL</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-center">
                    <!-- Live Image Preview Box -->
                    <div class="md:col-span-4 lg:col-span-3 flex justify-center">
                        <div class="relative w-28 h-28 sm:w-32 sm:h-32 rounded-2xl bg-[#09101d] border border-white/10 flex items-center justify-center overflow-hidden group shadow-inner">
                            <span id="preview_badge" class="absolute top-1.5 left-1.5 z-10 px-1.5 py-0.5 rounded text-[9px] font-mono font-bold bg-black/70 text-slate-400 backdrop-blur border border-white/10">
                                No Avatar
                            </span>

                            <img id="testimonial_avatar_preview"
                                src=""
                                alt="Client Avatar Preview"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105 hidden">

                            <div id="preview_placeholder" class="text-center p-3">
                                <svg class="w-8 h-8 mx-auto text-slate-600 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="text-[10px] font-mono text-slate-500 block">No Avatar</span>
                            </div>
                        </div>
                    </div>

                    <!-- Input Controls: File Upload & URL -->
                    <div class="md:col-span-8 lg:col-span-9 space-y-3.5">
                        <!-- Option A: File Upload -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="block text-xs font-mono text-slate-300 font-semibold">Upload Avatar Image File</label>
                                <span class="text-[10px] font-mono text-slate-500">JPG, PNG, WEBP, GIF, SVG (Max: 5MB)</span>
                            </div>
                            <input type="file" name="avatar_file" id="testimonial_avatar_file" accept="image/*" onchange="handleAvatarFile(this)"
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
                                <label class="block text-xs font-mono text-slate-300 font-semibold">Avatar Image URL (Direct / CDN)</label>
                                <button type="button" onclick="clearAvatarImage()" class="text-[10px] font-mono text-rose-400 hover:text-rose-300 transition-colors">Clear</button>
                            </div>
                            <input type="text" name="avatar" id="testimonial_avatar_url_input"
                                value="{{ old('avatar') }}"
                                placeholder="https://images.unsplash.com/... or /uploads/..."
                                oninput="handleAvatarUrl(this.value)"
                                class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono focus:outline-none focus:border-indigo-500 transition-colors">
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    @php
                        $targetTheme = request('theme', $selectedTheme ?? \App\Models\SiteSetting::getActiveTheme());
                    @endphp
                    <label class="block text-xs font-mono text-slate-400 mb-1">Display Theme</label>
                    <select name="theme"
                        class="w-full px-3 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
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
                    <input type="number" name="sort_order" value="{{ old('sort_order', 1) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Review Quote *</label>
                <textarea name="content" rows="4" required data-height="180" placeholder="Enter the client's endorsement quote..."
                    class="summernote w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">{{ old('content') }}</textarea>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3">
                <a href="{{ route('admin.testimonials.index') }}"
                    class="px-4 py-2 rounded-xl text-xs text-slate-400 hover:text-white">Cancel</a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg">Save
                    Testimonial</button>
            </div>
        </form>
    </div>

    <!-- Live Avatar Image Preview Script -->
    <script>
        const defaultAvatar = "";

        function handleAvatarFile(input) {
            const previewImg = document.getElementById('testimonial_avatar_preview');
            const placeholder = document.getElementById('preview_placeholder');
            const badge = document.getElementById('preview_badge');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                    badge.textContent = 'New File to Upload';
                    badge.className = 'absolute top-1.5 left-1.5 z-10 px-1.5 py-0.5 rounded text-[9px] font-mono font-bold bg-emerald-500/80 text-white backdrop-blur shadow border border-emerald-400/30';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function handleAvatarUrl(val) {
            const fileInput = document.getElementById('testimonial_avatar_file');
            const previewImg = document.getElementById('testimonial_avatar_preview');
            const placeholder = document.getElementById('preview_placeholder');
            const badge = document.getElementById('preview_badge');

            if (!fileInput.files.length) {
                const trimmed = val.trim();
                if (trimmed) {
                    previewImg.src = trimmed;
                    previewImg.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                    badge.textContent = 'URL Preview';
                    badge.className = 'absolute top-1.5 left-1.5 z-10 px-1.5 py-0.5 rounded text-[9px] font-mono font-bold bg-indigo-500/80 text-white backdrop-blur shadow border border-indigo-400/30';
                } else if (defaultAvatar) {
                    previewImg.src = defaultAvatar;
                    previewImg.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                    badge.textContent = 'Current Avatar';
                    badge.className = 'absolute top-1.5 left-1.5 z-10 px-1.5 py-0.5 rounded text-[9px] font-mono font-bold bg-black/70 text-slate-400 backdrop-blur border border-white/10';
                } else {
                    previewImg.classList.add('hidden');
                    placeholder.classList.remove('hidden');
                    badge.textContent = 'No Avatar';
                    badge.className = 'absolute top-1.5 left-1.5 z-10 px-1.5 py-0.5 rounded text-[9px] font-mono font-bold bg-black/70 text-slate-500 backdrop-blur border border-white/10';
                }
            }
        }

        function clearAvatarImage() {
            const fileInput = document.getElementById('testimonial_avatar_file');
            const urlInput = document.getElementById('testimonial_avatar_url_input');
            const previewImg = document.getElementById('testimonial_avatar_preview');
            const placeholder = document.getElementById('preview_placeholder');
            const badge = document.getElementById('preview_badge');

            fileInput.value = '';
            urlInput.value = '';
            previewImg.src = '';
            previewImg.classList.add('hidden');
            placeholder.classList.remove('hidden');
            badge.textContent = 'No Avatar';
            badge.className = 'absolute top-1.5 left-1.5 z-10 px-1.5 py-0.5 rounded text-[9px] font-mono font-bold bg-black/70 text-slate-500 backdrop-blur border border-white/10';
        }

        // Handle broken preview URLs gracefully
        document.getElementById('testimonial_avatar_preview')?.addEventListener('error', function() {
            const placeholder = document.getElementById('preview_placeholder');
            const badge = document.getElementById('preview_badge');
            this.classList.add('hidden');
            placeholder.classList.remove('hidden');
            badge.textContent = 'Invalid Image URL';
            badge.className = 'absolute top-1.5 left-1.5 z-10 px-1.5 py-0.5 rounded text-[9px] font-mono font-bold bg-rose-500/80 text-white backdrop-blur border border-rose-400/30';
        });

        // Trigger initial preview if old value exists
        const initialAvatarVal = document.getElementById('testimonial_avatar_url_input')?.value;
        if (initialAvatarVal) {
            handleAvatarUrl(initialAvatarVal);
        }
    </script>
@endsection
