<!-- =========================================================================
     SECTION 02: EDITORIAL NARRATIVE & PORTRAIT
     ========================================================================= -->
<div
    class="rounded-3xl bg-[#09101d] border border-white/10 shadow-2xl overflow-hidden transition-all duration-300 hover:border-white/15">
    <!-- Top Accent Gradient Line -->
    <div class="h-1 w-full" style="background: linear-gradient(90deg, {{ $themeColor }}, #8b5cf6, #ec4899);"></div>

    <!-- Section Card Header -->
    <div
        class="p-5 sm:p-6 border-b border-white/10 bg-white/[0.015] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5 min-w-0">
            <span
                class="w-9 h-9 rounded-xl flex items-center justify-center font-bold font-mono text-xs shadow-md shrink-0"
                style="background: {{ $themeColor }}20; color: {{ $themeColor }}; border: 1px solid {{ $themeColor }}40;">
                02
            </span>
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <h2 class="text-base sm:text-lg font-bold text-white tracking-tight truncate">Editorial Narrative &
                        Portrait</h2>
                    <span
                        class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400 font-bold shrink-0">Section:
                        narrative</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5 truncate">Editorial story paragraphs and high-resolution
                    portrait photograph showcase.</p>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">
            <button type="button" onclick="switchSectionTab('hero')"
                class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all text-xs font-mono flex items-center gap-1 cursor-pointer">
                &larr; Prev
            </button>
            <button type="button" onclick="switchSectionTab('metrics')"
                class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all text-xs font-mono flex items-center gap-1 cursor-pointer">
                Next &rarr;
            </button>
        </div>
    </div>

    <!-- Edit Form -->
    <form action="{{ route('admin.pages.update') }}" method="POST" enctype="multipart/form-data"
        class="p-6 sm:p-7 space-y-6">
        @csrf
        <input type="hidden" name="theme" value="{{ $selectedTheme }}">
        <input type="hidden" name="page" value="{{ $pageSlug }}">
        <input type="hidden" name="section_name" value="Editorial Narrative & Portrait">


        <div class="space-y-6">
            <!-- Group 1: Portrait Photo Upload -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-emerald-300">Portrait Image
                        Showcase</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                    <div
                        class="flex flex-col items-center justify-center p-4 rounded-xl bg-[#060b13] border border-white/5">
                        <div
                            class="w-28 h-36 rounded-xl overflow-hidden bg-white/5 border border-white/10 relative shadow-inner mb-3">
                            <img id="about-portrait-preview"
                                src="{{ !empty($contents['about_portrait_image']) ? (str_starts_with($contents['about_portrait_image'], 'http') ? $contents['about_portrait_image'] : asset($contents['about_portrait_image'])) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=80' }}"
                                alt="Portrait Preview" class="w-full h-full object-cover">
                        </div>
                        <span class="text-[10px] font-mono text-slate-500">Current Preview</span>
                    </div>

                    <div class="md:col-span-2 space-y-4">
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1.5">Upload New Portrait
                                Photo</label>
                            <input type="file" name="about_portrait_image_file" accept="image/*"
                                onchange="previewAboutPortrait(event)"
                                class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-slate-300 text-xs file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-purple-600/20 file:text-purple-300 hover:file:bg-purple-600/30 cursor-pointer">
                            <p class="text-[10px] text-slate-500 mt-1">Recommended: JPG/PNG, 800x1000px, under 2MB.</p>
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1.5">Or External Image URL</label>
                            <input type="text" name="about_portrait_image"
                                value="{{ $contents['about_portrait_image'] ?? '' }}"
                                placeholder="https://images.unsplash.com/photo-..."
                                class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none transition-colors">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Group 2: Narrative Text -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-purple-300">Narrative Story
                        Copy</h3>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Story Badge / Section Tag</label>
                        <input type="text" name="about_narrative_tag"
                            value="{{ $contents['about_narrative_tag'] ?? 'MY JOURNEY' }}" placeholder="e.g. MY JOURNEY"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-purple-400 font-mono text-xs font-bold focus:border-purple-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Story Title / Headline</label>
                        <input type="text" name="about_narrative_title"
                            value="{{ $contents['about_narrative_title'] ?? 'Bridging art, technology, and user psychology.' }}"
                            placeholder="e.g. Bridging art, technology, and user psychology."
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Full Narrative Description
                        (Paragraphs)</label>
                    <textarea name="about_narrative_description" rows="5" data-height="240"
                        placeholder="Detailed narrative about career, approach, and craft..."
                        class="summernote w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm leading-relaxed focus:border-indigo-500 focus:outline-none transition-colors">{{ $contents['about_narrative_description'] ?? 'I believe every great product begins with deep empathy and relentless attention to detail. Over the years, I have helped early-stage founders turn ambitious visions into award-winning interfaces, and scaled design systems for established tech leaders.' }}</textarea>
                </div>
            </div>
        </div>

        <script>
            function previewAboutPortrait(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const preview = document.getElementById('about-portrait-preview');
                    if (preview) preview.src = reader.result;
                };
                if (event.target.files && event.target.files[0]) {
                    reader.readAsDataURL(event.target.files[0]);
                }
            }
        </script>


        <!-- Bottom Action Bar -->
        <div
            class="pt-5 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-3 bg-white/[0.01] -mx-6 sm:-mx-7 -mb-6 sm:-mb-7 p-5 sm:p-6 rounded-b-3xl">
            <div class="flex items-center gap-2 text-xs text-slate-400">
                <span class="w-2 h-2 rounded-full animate-pulse" style="background-color: {{ $themeColor }};"></span>
                <span>Active Theme: <strong class="text-white font-mono">{{ $themeName }}</strong> • Saved to <code
                        class="text-indigo-300 font-mono">theme_contents</code></span>
            </div>
            <button type="submit"
                class="w-full sm:w-auto px-6 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-white shadow-lg transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2 cursor-pointer"
                style="background: linear-gradient(135deg, {{ $themeColor }}, #4f46e5);">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Save Narrative & Portrait</span>
            </button>
        </div>
    </form>
</div>
