<!-- =========================================================================
     SECTION 01: HERO INTRODUCTION & PROFILE SHOWCASE
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
                01
            </span>
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <h2 class="text-base sm:text-lg font-bold text-white tracking-tight truncate">Hero Introduction &
                        Profile Showcase</h2>
                    <span
                        class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400 font-bold shrink-0">Section:
                        hero</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5 truncate">Primary hero banner headline, profile avatar portrait,
                    biography text, CTA buttons, and experience badges.</p>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">

            <button type="button" onclick="switchSectionTab('stats')"
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
        <input type="hidden" name="section_name" value="Hero Introduction & Profile Showcase">


        <div class="space-y-6">

            <!-- Group 1: Headlines & Bio -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-indigo-300">Hero Headlines &
                        Biography</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Pill Tag</label>
                        <input type="text" name="hero_tag" value="{{ $contents['hero_tag'] ?? 'HELLO, I AM' }}"
                            placeholder="e.g. HELLO, I AM"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-purple-400 font-mono text-xs font-bold focus:border-purple-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Floating Experience Badge
                            Text</label>
                        <input type="text" name="hero_exp_badge"
                            value="{{ $contents['hero_exp_badge'] ?? '12+ Years Of Excellence' }}"
                            placeholder="e.g. 12+ Years Of Excellence"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-emerald-400 font-mono text-xs font-bold focus:border-emerald-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Headline Prefix / Greeting Lead</label>
                        <input type="text" name="hero_title_1"
                            value="{{ $contents['hero_title_1'] ?? '' }}" placeholder="e.g. I'M A FREELANCE"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-emerald-300 font-mono text-xs font-bold focus:border-emerald-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Headline Line 1 (Name /
                            Greeting)</label>
                        <input type="text" name="hero_title_line1"
                            value="{{ $contents['hero_title_line1'] ?? 'William' }}" placeholder="e.g. William"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-base font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Headline Line 2 (Role /
                            Title)</label>
                        <input type="text" name="hero_title_line2"
                            value="{{ $contents['hero_title_line2'] ?? 'Creative' }}" placeholder="e.g. Creative"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-indigo-300 text-base font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Headline Line 3 (Specialty)</label>
                        <input type="text" name="hero_title_line3"
                            value="{{ $contents['hero_title_line3'] ?? 'Director & Designer' }}"
                            placeholder="e.g. Director & Designer"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-purple-300 text-base font-bold italic focus:border-purple-500 focus:outline-none transition-colors">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Mastered Software / Tools Stack Text</label>
                        <input type="text" name="hero_software_text"
                            value="{{ $contents['hero_software_text'] ?? '' }}"
                            placeholder="e.g. Photoshop, Illustrator, Figma, After Effects, Cinema 4D"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-slate-200 text-xs font-mono focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Hero Lead Bio / Introduction</label>
                    <textarea name="hero_description" rows="3" data-height="160" placeholder="Crafting high-impact digital experiences..."
                        class="summernote w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm leading-relaxed focus:border-indigo-500 focus:outline-none transition-colors">{{ $contents['hero_description'] ?? 'Crafting high-impact digital experiences, award-winning visual identities, and interactive web applications.' }}</textarea>
                </div>
            </div>

            <!-- Group 2: Portrait Avatar & Accent Graphics -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-6">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-pink-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-pink-300">Avatar Portrait & Accent Artwork</h3>
                </div>
                <!-- Avatar Portrait -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                    <div
                        class="flex flex-col items-center justify-center p-4 rounded-xl bg-[#060b13] border border-white/5">
                        <div
                            class="w-24 h-24 sm:w-28 sm:h-28 rounded-full overflow-hidden bg-white/5 border-2 border-indigo-500/40 relative shadow-lg mb-2">
                            <img id="home-hero-preview"
                                src="{{ !empty($contents['hero_image']) ? (str_starts_with($contents['hero_image'], 'http') ? $contents['hero_image'] : asset($contents['hero_image'])) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80' }}"
                                alt="Hero Avatar" class="w-full h-full object-cover">
                        </div>
                        <span class="text-[10px] font-mono text-slate-500">Avatar Preview</span>
                    </div>

                    <div class="md:col-span-2 space-y-4">
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1.5">Upload Hero Photo</label>
                            <input type="file" name="hero_image_file" accept="image/*"
                                onchange="previewHomeHeroImage(event)"
                                class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-slate-300 text-xs file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600/20 file:text-indigo-300 hover:file:bg-indigo-600/30 cursor-pointer">
                            <p class="text-[10px] text-slate-500 mt-1">Recommended: Square PNG/JPG (800x800px), under 2MB.</p>
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1.5">Or Direct Image URL</label>
                            <input type="text" name="hero_image" value="{{ $contents['hero_image'] ?? '' }}"
                                placeholder="https://..."
                                class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none transition-colors">
                        </div>
                    </div>
                </div>

                <!-- Secondary Accent Artwork / Sticker Graphic -->
                <div class="pt-4 border-t border-white/5 grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                    <div
                        class="flex flex-col items-center justify-center p-4 rounded-xl bg-[#060b13] border border-white/5">
                        <div
                            class="w-20 h-20 rounded-2xl overflow-hidden bg-white/5 border border-purple-500/30 relative shadow-lg mb-2 flex items-center justify-center">
                            <img id="home-accent-preview"
                                src="{{ !empty($contents['hero_accent_image']) ? (str_starts_with($contents['hero_accent_image'], 'http') ? $contents['hero_accent_image'] : asset($contents['hero_accent_image'])) : 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=400&q=80' }}"
                                alt="Hero Accent Graphic" class="w-full h-full object-cover">
                        </div>
                        <span class="text-[10px] font-mono text-purple-400">Accent Graphic Preview</span>
                    </div>

                    <div class="md:col-span-2 space-y-4">
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1.5">Upload Hero Accent / Floating Graphic</label>
                            <input type="file" name="hero_accent_image_file" accept="image/*"
                                onchange="previewHomeAccentImage(event)"
                                class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-slate-300 text-xs file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-purple-600/20 file:text-purple-300 hover:file:bg-purple-600/30 cursor-pointer">
                            <p class="text-[10px] text-slate-500 mt-1">Floating badge / decorative sticker used in creative & illustrator themes.</p>
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1.5">Or Accent Graphic URL</label>
                            <input type="text" name="hero_accent_image" value="{{ $contents['hero_accent_image'] ?? '' }}"
                                placeholder="https://..."
                                class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-purple-500 focus:outline-none transition-colors">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Group 3: Call-To-Action Buttons -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-cyan-300">Call-To-Action
                        Buttons</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl bg-[#060b13] border border-white/5 space-y-3">
                        <span class="text-[11px] font-mono font-bold text-indigo-400">Primary CTA Button</span>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Button Label</label>
                            <input type="text" name="hero_cta_text"
                                value="{{ $contents['hero_cta_text'] ?? 'Explore My Works' }}"
                                placeholder="e.g. Explore My Works"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Target URL</label>
                            <input type="text" name="hero_cta_url"
                                value="{{ $contents['hero_cta_url'] ?? route('portfolio') }}"
                                placeholder="{{ route('portfolio') }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-indigo-300 font-mono text-xs focus:border-indigo-500 focus:outline-none transition-colors">
                        </div>
                    </div>

                    <div class="p-4 rounded-xl bg-[#060b13] border border-white/5 space-y-3">
                        <span class="text-[11px] font-mono font-bold text-purple-400">Secondary CTA Button</span>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Button Label</label>
                            <input type="text" name="hero_cta2_text"
                                value="{{ $contents['hero_cta2_text'] ?? 'Get In Touch' }}"
                                placeholder="e.g. Get In Touch"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-bold focus:border-purple-500 focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Target URL</label>
                            <input type="text" name="hero_cta2_url"
                                value="{{ $contents['hero_cta2_url'] ?? route('contact') }}"
                                placeholder="{{ route('contact') }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-purple-300 font-mono text-xs focus:border-purple-500 focus:outline-none transition-colors">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Group 4: Continuous Marquee Headline -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-amber-300">Ticker Marquee Headline</h3>
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Continuous Marquee Text</label>
                    <textarea name="marquee_text" rows="2"
                        placeholder="e.g. * CREATIVE DIRECTION * UI/UX DESIGN * FRONTEND ENGINEERING * MOTION DESIGN"
                        class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-amber-300 font-mono text-xs font-bold focus:border-amber-500 focus:outline-none transition-colors">{{ $contents['marquee_text'] ?? '* CREATIVE DIRECTION * UI/UX DESIGN * FRONTEND ARCHITECTURE * DIGITAL EXPERIENCES' }}</textarea>
                    <p class="text-[10px] text-slate-500 mt-1">Displayed in the infinite running marquee ticker bar across pages.</p>
                </div>
            </div>
        </div>

        <script>
            function previewHomeHeroImage(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const preview = document.getElementById('home-hero-preview');
                    if (preview) preview.src = reader.result;
                };
                if (event.target.files && event.target.files[0]) {
                    reader.readAsDataURL(event.target.files[0]);
                }
            }

            function previewHomeAccentImage(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const preview = document.getElementById('home-accent-preview');
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
                <span class="w-2 h-2 rounded-full animate-pulse"
                    style="background-color: {{ $themeColor }};"></span>
                <span>Active Theme: <strong class="text-white font-mono">{{ $themeName }}</strong> • Saved to <code
                        class="text-indigo-300 font-mono">theme_contents</code></span>
            </div>
            <button type="submit"
                class="w-full sm:w-auto px-6 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-white shadow-lg transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2 cursor-pointer"
                style="background: linear-gradient(135deg, {{ $themeColor }}, #4f46e5);">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Save Hero Section</span>
            </button>
        </div>
    </form>
</div>
