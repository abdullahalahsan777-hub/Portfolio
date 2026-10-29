<!-- =========================================================================
     SECTION 07: CLIENT ENDORSEMENTS & TESTIMONIALS
     ========================================================================= -->
<div class="rounded-3xl bg-[#09101d] border border-white/10 shadow-2xl overflow-hidden transition-all duration-300 hover:border-white/15">
    <!-- Top Accent Gradient Line -->
    <div class="h-1 w-full" style="background: linear-gradient(90deg, {{ $themeColor }}, #8b5cf6, #ec4899);"></div>

    <!-- Section Card Header -->
    <div class="p-5 sm:p-6 border-b border-white/10 bg-white/[0.015] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5 min-w-0">
            <span class="w-9 h-9 rounded-xl flex items-center justify-center font-bold font-mono text-xs shadow-md shrink-0"
                style="background: {{ $themeColor }}20; color: {{ $themeColor }}; border: 1px solid {{ $themeColor }}40;">
                07
            </span>
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <h2 class="text-base sm:text-lg font-bold text-white tracking-tight truncate">Client Endorsements & Testimonials</h2>
                    <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400 font-bold shrink-0">Section: testimonials</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5 truncate">Section badge, client testimonial headlines, and featured quote artwork.</p>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">
            <button type="button" onclick="switchSectionTab('skills')"
                class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all text-xs font-mono flex items-center gap-1 cursor-pointer">
                &larr; Prev
            </button>
            <button type="button" onclick="switchSectionTab('pricing')"
                class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all text-xs font-mono flex items-center gap-1 cursor-pointer">
                Next &rarr;
            </button>
        </div>
    </div>

    <!-- Edit Form -->
    <form action="{{ route('admin.pages.update') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-7 space-y-6">
        @csrf
        <input type="hidden" name="theme" value="{{ $selectedTheme }}">
        <input type="hidden" name="page" value="{{ $pageSlug }}">
        <input type="hidden" name="section_name" value="Client Endorsements & Testimonials">


        <div class="space-y-6">
            <!-- Shortcut to Testimonials Manager -->
            <div class="p-4 rounded-2xl bg-indigo-950/20 border border-indigo-500/20 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-white">Manage Client Quotes & Reviews</h4>
                        <p class="text-[11px] text-slate-400">Add or edit testimonials, client company names, and avatars in the Testimonials Manager.</p>
                    </div>
                </div>
                <a href="{{ route('admin.testimonials.index') }}"
                    class="px-3.5 py-1.5 rounded-xl bg-indigo-600/20 hover:bg-indigo-600/30 border border-indigo-500/30 text-indigo-300 font-semibold text-xs transition-colors flex items-center justify-center gap-1.5 self-start sm:self-auto">
                    <span>Testimonials Manager &rarr;</span>
                </a>
            </div>

            <!-- Settings Group -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-purple-300">Headlines & Copy</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Pill Tag</label>
                        <input type="text" name="testimonials_tag"
                            value="{{ $contents['testimonials_tag'] ?? 'TESTIMONIALS' }}"
                            placeholder="e.g. TESTIMONIALS"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-purple-400 font-mono text-xs font-bold focus:border-purple-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Title (Headline)</label>
                        <input type="text" name="testimonials_title"
                            value="{{ $contents['testimonials_title'] ?? 'What Clients Say' }}"
                            placeholder="e.g. What Clients Say"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Subtitle / Description</label>
                    <textarea name="testimonials_subtitle" rows="2"
                        placeholder="Direct quotes from founders, product leaders, and design directors."
                        class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm leading-relaxed focus:border-indigo-500 focus:outline-none transition-colors">{{ $contents['testimonials_subtitle'] ?? 'Direct feedback from founders, product managers, and design directors I have collaborated with.' }}</textarea>
                </div>
            </div>

            <!-- Image Upload Group with Left Preview -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-indigo-300">Section Background Artwork / Accent Graphic</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                    <!-- Left: Artwork Image Preview -->
                    <div class="flex flex-col items-center justify-center p-4 rounded-xl bg-[#060b13] border border-white/5">
                        <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-2xl overflow-hidden bg-white/5 border border-white/10 relative shadow-inner mb-2.5 flex items-center justify-center">
                            <img id="testimonials-artwork-preview"
                                src="{{ !empty($contents['testimonials_image']) ? (str_starts_with($contents['testimonials_image'], 'http') ? $contents['testimonials_image'] : asset($contents['testimonials_image'])) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=700&q=80' }}"
                                alt="Testimonials Background Artwork"
                                class="w-full h-full object-cover">
                        </div>
                        <span class="text-[10px] font-mono text-slate-400">Artwork Preview</span>
                    </div>

                    <!-- Right: Upload and Direct URL -->
                    <div class="md:col-span-2 space-y-4">
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1.5">Upload Accent Image</label>
                            <input type="file" name="testimonials_image_file" accept="image/*"
                                onchange="previewTestimonialsArtwork(event)"
                                class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-slate-300 text-xs file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600/20 file:text-indigo-300 hover:file:bg-indigo-600/30 cursor-pointer">
                            <p class="text-[10px] text-slate-500 mt-1">Recommended: JPG/PNG, square or portrait aspect ratio, under 2MB.</p>
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1.5">Or Direct Image URL</label>
                            <input type="text" name="testimonials_image"
                                id="testimonials_image_url_input"
                                value="{{ $contents['testimonials_image'] ?? '' }}"
                                oninput="updateTestimonialsArtworkUrl(this.value)"
                                placeholder="https://..."
                                class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none transition-colors">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function previewTestimonialsArtwork(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const preview = document.getElementById('testimonials-artwork-preview');
                    if (preview) preview.src = reader.result;
                };
                if (event.target.files && event.target.files[0]) {
                    reader.readAsDataURL(event.target.files[0]);
                }
            }

            function updateTestimonialsArtworkUrl(url) {
                if (url && (url.startsWith('http://') || url.startsWith('https://') || url.startsWith('/'))) {
                    const preview = document.getElementById('testimonials-artwork-preview');
                    if (preview) preview.src = url;
                }
            }
        </script>
    

        <!-- Bottom Action Bar -->
        <div class="pt-5 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-3 bg-white/[0.01] -mx-6 sm:-mx-7 -mb-6 sm:-mb-7 p-5 sm:p-6 rounded-b-3xl">
            <div class="flex items-center gap-2 text-xs text-slate-400">
                <span class="w-2 h-2 rounded-full animate-pulse" style="background-color: {{ $themeColor }};"></span>
                <span>Active Theme: <strong class="text-white font-mono">{{ $themeName }}</strong> • Saved to <code class="text-indigo-300 font-mono">theme_contents</code></span>
            </div>
            <button type="submit"
                class="w-full sm:w-auto px-6 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-white shadow-lg transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2 cursor-pointer"
                style="background: linear-gradient(135deg, {{ $themeColor }}, #4f46e5);">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Save Testimonials Section</span>
            </button>
        </div>
    </form>
</div>
