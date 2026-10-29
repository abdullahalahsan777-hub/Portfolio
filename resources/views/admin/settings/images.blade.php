@extends('admin.layout')

@section('title', 'Image Upload Settings')
@section('page_title', 'Image Upload')
@section('page_subtitle', 'Branding & Assets')

@section('content')
    <div class="w-full space-y-8">
        <div>
            <h1 class="text-2xl font-extrabold text-white">Image Upload &amp; Brand Assets</h1>
            <p class="text-xs text-slate-400 mt-1">Upload and configure your brand logo, favicon, mini icon, and default
                profile placeholder.</p>
        </div>

        <form action="{{ route('admin.settings.images.update') }}" method="POST" enctype="multipart/form-data"
            class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 items-center justify-center gap-6">

                <!-- 1. Software Logo Card -->
                <div
                    class="p-5 rounded-2xl bg-[#09101d] border border-white/10 flex flex-col justify-between space-y-4 shadow-xl">
                    <div class="space-y-3">
                        <h3 class="text-base font-bold text-white tracking-wide">Software Logo</h3>

                        <!-- Preview Box -->
                        <div
                            class="h-44 w-full rounded-xl bg-[#050912] border border-white/10 flex items-center justify-center p-4 relative overflow-hidden group">
                            @php
                                $softwareLogo = $settings['software_logo'] ?? 'images/defaults/software_logo.svg';
                            @endphp
                            <img id="software_logo_preview" src="{{ asset($softwareLogo) }}" alt="Software Logo"
                                class="max-h-24 max-w-full object-contain filter drop-shadow transition-transform group-hover:scale-105">
                        </div>
                    </div>

                    <!-- Hidden File Input & Upload Trigger Button -->
                    <div class="pt-2">
                        <input type="file" name="software_logo" id="software_logo_input" accept="image/*" class="hidden"
                            onchange="previewSelectedImage(this, 'software_logo_preview')">
                        <button type="button" onclick="document.getElementById('software_logo_input').click()"
                            class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl font-bold text-xs bg-[#0090e7] hover:bg-[#007cd0] text-white shadow-md shadow-[#0090e7]/25 transition-all">
                            <svg class="w-4 h-4 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Upload</span>
                        </button>
                    </div>
                </div>

                <!-- 2. Favicon Card -->
                <div
                    class="p-5 rounded-2xl bg-[#09101d] border border-white/10 flex flex-col justify-between space-y-4 shadow-xl">
                    <div class="space-y-3">
                        <h3 class="text-base font-bold text-white tracking-wide">Favicon</h3>

                        <!-- Preview Box -->
                        <div
                            class="h-44 w-full rounded-xl bg-[#050912] border border-white/10 flex items-center justify-center p-4 relative overflow-hidden group">
                            @php
                                $faviconImg = $settings['site_favicon'] ?? 'images/defaults/favicon.svg';
                            @endphp
                            <img id="site_favicon_preview" src="{{ asset($faviconImg) }}" alt="Favicon"
                                class="h-20 w-20 object-contain rounded-2xl filter drop-shadow transition-transform group-hover:scale-105">
                        </div>
                    </div>

                    <!-- Hidden File Input & Upload Trigger Button -->
                    <div class="pt-2">
                        <input type="file" name="site_favicon" id="site_favicon_input" accept="image/*,.ico"
                            class="hidden" onchange="previewSelectedImage(this, 'site_favicon_preview')">
                        <button type="button" onclick="document.getElementById('site_favicon_input').click()"
                            class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl font-bold text-xs bg-[#0090e7] hover:bg-[#007cd0] text-white shadow-md shadow-[#0090e7]/25 transition-all">
                            <svg class="w-4 h-4 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Upload</span>
                        </button>
                    </div>
                </div>

                <!-- 3. Mini Logo Card -->
                <div
                    class="p-5 rounded-2xl bg-[#09101d] border border-white/10 flex flex-col justify-between space-y-4 shadow-xl">
                    <div class="space-y-3">
                        <h3 class="text-base font-bold text-white tracking-wide">Mini Logo</h3>

                        <!-- Preview Box -->
                        <div
                            class="h-44 w-full rounded-xl bg-[#050912] border border-white/10 flex items-center justify-center p-4 relative overflow-hidden group">
                            @php
                                $miniLogo = $settings['mini_logo'] ?? 'images/defaults/mini_logo.svg';
                            @endphp
                            <img id="mini_logo_preview" src="{{ asset($miniLogo) }}" alt="Mini Logo"
                                class="h-20 w-20 object-contain filter drop-shadow transition-transform group-hover:scale-105">
                        </div>
                    </div>

                    <!-- Hidden File Input & Upload Trigger Button -->
                    <div class="pt-2">
                        <input type="file" name="mini_logo" id="mini_logo_input" accept="image/*" class="hidden"
                            onchange="previewSelectedImage(this, 'mini_logo_preview')">
                        <button type="button" onclick="document.getElementById('mini_logo_input').click()"
                            class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl font-bold text-xs bg-[#0090e7] hover:bg-[#007cd0] text-white shadow-md shadow-[#0090e7]/25 transition-all">
                            <svg class="w-4 h-4 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Upload</span>
                        </button>
                    </div>
                </div>

                <!-- 4. Placeholder Card -->
                <div
                    class="p-5 rounded-2xl bg-[#09101d] border border-white/10 flex flex-col justify-between space-y-4 shadow-xl">
                    <div class="space-y-3">
                        <h3 class="text-base font-bold text-white tracking-wide">Placeholder</h3>

                        <!-- Preview Box -->
                        <div
                            class="h-44 w-full rounded-xl bg-[#050912] border border-white/10 flex items-center justify-center p-3 relative overflow-hidden group">
                            @php
                                $placeholderImg = $settings['site_placeholder'] ?? 'images/defaults/placeholder.jpg';
                            @endphp
                            <img id="site_placeholder_preview" src="{{ asset($placeholderImg) }}" alt="Placeholder Avatar"
                                class="h-32 w-32 object-cover rounded-xl border border-white/20 filter drop-shadow transition-transform group-hover:scale-105">
                        </div>
                    </div>

                    <!-- Hidden File Input & Upload Trigger Button -->
                    <div class="pt-2">
                        <input type="file" name="site_placeholder" id="site_placeholder_input" accept="image/*"
                            class="hidden" onchange="previewSelectedImage(this, 'site_placeholder_preview')">
                        <button type="button" onclick="document.getElementById('site_placeholder_input').click()"
                            class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl font-bold text-xs bg-[#0090e7] hover:bg-[#007cd0] text-white shadow-md shadow-[#0090e7]/25 transition-all">
                            <svg class="w-4 h-4 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Upload</span>
                        </button>
                    </div>
                </div>

                <!-- 5. Two-Word Logo Card -->
                <div
                    class="p-5 rounded-2xl bg-[#09101d] border border-white/10 flex flex-col justify-between space-y-4 shadow-xl">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="text-base font-bold text-white tracking-wide">Word Logo</h3>
                            <span
                                class="text-[10px] font-mono uppercase tracking-wider text-[#0090e7] bg-[#0090e7]/10 border border-[#0090e7]/20 px-2 py-0.5 rounded-full font-bold">Navbar
                                Mark</span>
                        </div>

                        <!-- Preview Box -->
                        <div
                            class="h-28 w-full rounded-xl bg-[#050912] border border-white/10 flex items-center justify-center p-4 relative overflow-hidden group">
                            @php
                                $wordOne = $settings['logo_word_one'] ?? 'Abdullah';
                                $wordTwo = $settings['logo_word_two'] ?? 'Ahsan';
                                $hasTwoWordImg =
                                    !empty($settings['two_word_logo_image']) &&
                                    file_exists(public_path($settings['two_word_logo_image']));
                                $b1 = strtoupper(substr($wordOne ?: 'A', 0, 1));
                                $b2 = strtoupper(substr($wordTwo ?: 'A', 0, 1));
                            @endphp

                            <!-- Live Two-Word Text Logo Display -->
                            <div id="two_word_text_container"
                                class="flex flex-col items-center justify-center text-center space-y-2.5 transition-transform group-hover:scale-105 {{ $hasTwoWordImg ? 'hidden' : '' }}">
                                <!-- Top Brand Monogram/Icon Badge -->
                                <div
                                    class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#0090e7] to-[#00d4ff] text-white flex items-center justify-center font-black text-sm shadow-lg shadow-[#0090e7]/30 transition-transform">
                                    <span id="two_word_preview_badge">{{ $b1 . $b2 }}</span>
                                </div>
                                <!-- Two Words Live Preview -->
                                <div
                                    class="flex items-baseline justify-center font-['Outfit'] font-black text-2xl tracking-tight">
                                    <span id="two_word_preview_one"
                                        class="text-white drop-shadow">{{ $wordOne }}</span>
                                    <span id="two_word_preview_two"
                                        class="text-[#0090e7] ml-1.5 drop-shadow">{{ $wordTwo }}</span>
                                    <span class="text-[#00d4ff] text-2xl animate-pulse">.</span>
                                </div>
                            </div>

                            <!-- Optional Uploaded Graphic Image Logo Preview -->
                            <img id="two_word_logo_img_preview"
                                src="{{ $hasTwoWordImg ? asset($settings['two_word_logo_image']) : '' }}"
                                alt="Two Word Logo"
                                class="max-h-24 max-w-full object-contain filter drop-shadow transition-transform group-hover:scale-105 {{ $hasTwoWordImg ? '' : 'hidden' }}">
                        </div>

                        <!-- Two Word Inputs -->
                        <div class="space-y-1.5 pt-1">
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label
                                        class="block text-[10px] font-mono uppercase tracking-wider text-slate-400 mb-1">Brand
                                        Name
                                        (Primary)</label>
                                    <input type="text" name="logo_word_one" id="logo_word_one_input"
                                        value="{{ $wordOne }}" placeholder="e.g. Abdullah"
                                        class="w-full px-3 py-2 rounded-xl bg-[#050912] border border-white/10 text-white text-xs font-semibold focus:outline-none focus:border-[#0090e7] transition-all"
                                        oninput="updateTwoWordPreview()">
                                </div>
                                <div>
                                    <label
                                        class="block text-[10px] font-mono uppercase tracking-wider text-slate-400 mb-1">Brand
                                        Name
                                        (Accent)</label>
                                    <input type="text" name="logo_word_two" id="logo_word_two_input"
                                        value="{{ $wordTwo }}" placeholder="e.g. Ahsan"
                                        class="w-full px-3 py-2 rounded-xl bg-[#050912] border border-white/10 text-white text-xs font-semibold focus:outline-none focus:border-[#0090e7] transition-all"
                                        oninput="updateTwoWordPreview()">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden File Input & Upload Trigger Button -->
                    <div class="pt-2 flex items-center gap-2">
                        <input type="file" name="two_word_logo_image" id="two_word_logo_input" accept="image/*"
                            class="hidden" onchange="previewSelectedTwoWordImage(this)">
                        <button type="button" onclick="document.getElementById('two_word_logo_input').click()"
                            class="flex-1 inline-flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl font-bold text-xs bg-[#0090e7] hover:bg-[#007cd0] text-white shadow-md shadow-[#0090e7]/25 transition-all"
                            title="Upload custom graphic logo (optional)">
                            <svg class="w-4 h-4 fill-none stroke-current" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Upload</span>
                        </button>
                    </div>
                </div>

            </div>

            <!-- Submit Bar matching previous design -->
            <div
                class="pt-4 flex items-center justify-end gap-3 sticky bottom-6 p-4 rounded-2xl bg-black/80 backdrop-blur-md border border-white/15 shadow-2xl">
                <a href="{{ route('admin.dashboard') }}"
                    class="px-4 py-2 rounded-xl text-xs text-slate-400 hover:text-white transition-colors">Cancel</a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg shadow-indigo-600/30 transition-all hover:scale-105">SAVE
                    IMAGES</button>
            </div>
        </form>
    </div>

    <!-- Real-time Image Preview Script -->
    <script>
        function previewSelectedImage(input, previewId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgElement = document.getElementById(previewId);
                    if (imgElement) {
                        imgElement.src = e.target.result;
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function updateTwoWordPreview() {
            const wordOne = document.getElementById('logo_word_one_input')?.value.trim() || 'Your';
            const wordTwo = document.getElementById('logo_word_two_input')?.value.trim() || 'Brand';

            const previewOne = document.getElementById('two_word_preview_one');
            const previewTwo = document.getElementById('two_word_preview_two');
            const badge = document.getElementById('two_word_preview_badge');
            const textContainer = document.getElementById('two_word_text_container');
            const imgPreview = document.getElementById('two_word_logo_img_preview');

            if (previewOne) previewOne.textContent = wordOne;
            if (previewTwo) previewTwo.textContent = wordTwo;
            if (badge) {
                const b1 = (wordOne.charAt(0) || 'A').toUpperCase();
                const b2 = (wordTwo.charAt(0) || 'B').toUpperCase();
                badge.textContent = b1 + b2;
            }
            if (textContainer && imgPreview) {
                textContainer.classList.remove('hidden');
                imgPreview.classList.add('hidden');
            }
        }

        function previewSelectedTwoWordImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgPreview = document.getElementById('two_word_logo_img_preview');
                    const textContainer = document.getElementById('two_word_text_container');
                    if (imgPreview) {
                        imgPreview.src = e.target.result;
                        imgPreview.classList.remove('hidden');
                    }
                    if (textContainer) {
                        textContainer.classList.add('hidden');
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function resetToTextLogo() {
            const fileInput = document.getElementById('two_word_logo_input');
            if (fileInput) fileInput.value = '';
            const imgPreview = document.getElementById('two_word_logo_img_preview');
            const textContainer = document.getElementById('two_word_text_container');
            if (imgPreview) imgPreview.classList.add('hidden');
            if (textContainer) textContainer.classList.remove('hidden');
            updateTwoWordPreview();
        }
    </script>
@endsection
