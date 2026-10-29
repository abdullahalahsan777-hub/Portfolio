<!-- =========================================================================
     SECTION: ABOUT ME & EDITORIAL NARRATIVE
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
                    <h2 class="text-base sm:text-lg font-bold text-white tracking-tight truncate">About Me & Narrative
                    </h2>
                    <span
                        class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400 font-bold shrink-0">Section:
                        about</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5 truncate">Editorial story copy, bio paragraphs, portrait photo,
                    collaborative graphics, and profile credentials.</p>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">
            <button type="button" onclick="switchSectionTab('hero')"
                class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all text-xs font-mono flex items-center gap-1 cursor-pointer">
                &larr; Prev
            </button>
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
        <input type="hidden" name="section_name" value="About Me & Narrative">

        <div class="space-y-6">
            <!-- Group 1: Headlines & Story Tags -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-purple-300">Headlines &
                        Narrative Lead</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Pill Tag</label>
                        <input type="text" name="about_tag" value="{{ $contents['about_tag'] ?? 'ABOUT ME' }}"
                            placeholder="e.g. ABOUT ME"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-purple-400 font-mono text-xs font-bold focus:border-purple-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Floating Badge Text</label>
                        <input type="text" name="about_badge_text"
                            value="{{ $contents['about_badge_text'] ?? '12+ Years Experience' }}"
                            placeholder="e.g. 12+ Years Experience"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-emerald-400 font-mono text-xs font-bold focus:border-emerald-500 focus:outline-none transition-colors">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Primary Heading</label>
                        <input type="text" name="about_heading"
                            value="{{ $contents['about_heading'] ?? 'I Am Available For Freelance Projects' }}"
                            placeholder="e.g. I Am Available For Freelance Projects"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">About Description (Lead
                        Paragraph)</label>
                    <textarea name="about_description" rows="4" data-height="180"
                        placeholder="Crafting high-impact digital experiences, award-winning visual identities..."
                        class="summernote w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm leading-relaxed focus:border-indigo-500 focus:outline-none transition-colors">{{ $contents['about_description'] ?? 'I am a passionate creator who bridges art, technology, and user psychology. Over the past decade, I have partnered with innovative startups and enterprise leaders.' }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Extended Biography / Detailed
                        Story</label>
                    <textarea name="about_bio_extended" rows="4" data-height="180"
                        placeholder="Additional in-depth story, design ethos, or background notes..."
                        class="summernote w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-slate-300 text-xs leading-relaxed focus:border-indigo-500 focus:outline-none transition-colors">{{ $contents['about_bio_extended'] ?? 'Driven by curiosity and a relentless commitment to craftsmanship, my work spans digital systems, responsive interfaces, and scalable interactive architectures.' }}</textarea>
                </div>
            </div>

            <!-- Group 2: Portrait Photo & Collaborative Artwork -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-6">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-emerald-300">About Portrait &
                        Visual Media</h3>
                </div>

                <!-- Primary About Image -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                    <div
                        class="flex flex-col items-center justify-center p-4 rounded-xl bg-[#060b13] border border-white/5">
                        <div
                            class="w-28 h-36 rounded-2xl overflow-hidden bg-white/5 border border-indigo-500/30 relative shadow-lg mb-2">
                            <img id="home-about-preview"
                                src="{{ !empty($contents['about_image']) ? (str_starts_with($contents['about_image'], 'http') ? $contents['about_image'] : asset($contents['about_image'])) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80' }}"
                                alt="About Image" class="w-full h-full object-cover">
                        </div>
                        <span class="text-[10px] font-mono text-slate-400">About Photo Preview</span>
                    </div>

                    <div class="md:col-span-2 space-y-4">
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1.5">Upload Primary About
                                Photo</label>
                            <input type="file" name="about_image_file" accept="image/*"
                                onchange="previewHomeAboutImage(event)"
                                class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-slate-300 text-xs file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600/20 file:text-indigo-300 hover:file:bg-indigo-600/30 cursor-pointer">
                            <p class="text-[10px] text-slate-500 mt-1">Recommended: Portrait orientation (800x1000px),
                                under 2MB.</p>
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1.5">Or Direct Image URL</label>
                            <input type="text" name="about_image" value="{{ $contents['about_image'] ?? '' }}"
                                placeholder="https://..."
                                class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none transition-colors">
                        </div>
                    </div>
                </div>

                <!-- Secondary Media (Collab Graphic & Chart Artwork) -->
                <div class="pt-4 border-t border-white/5 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl bg-[#060b13] border border-white/5 space-y-2">
                        <span class="text-[11px] font-mono font-bold text-cyan-400">Collaborative Graphic URL /
                            Path</span>
                        <input type="text" name="about_collab_image"
                            value="{{ $contents['about_collab_image'] ?? '' }}"
                            placeholder="uploads/themes/... or https://..."
                            class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono focus:border-cyan-500 focus:outline-none">
                    </div>
                    <div class="p-4 rounded-xl bg-[#060b13] border border-white/5 space-y-2">
                        <span class="text-[11px] font-mono font-bold text-pink-400">Chart / Analytics Graphic URL /
                            Path</span>
                        <input type="text" name="about_chart_image"
                            value="{{ $contents['about_chart_image'] ?? '' }}"
                            placeholder="uploads/themes/... or https://..."
                            class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono focus:border-pink-500 focus:outline-none">
                    </div>
                </div>

                <!-- Video Showcase URL -->
                <div class="pt-2 border-t border-white/5">
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Showcase Video URL (YouTube / Vimeo /
                        MP4)</label>
                    <input type="text" name="about_video_url" value="{{ $contents['about_video_url'] ?? '' }}"
                        placeholder="https://www.youtube.com/watch?v=..."
                        class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-indigo-300 text-xs font-mono focus:border-indigo-500 focus:outline-none transition-colors">
                </div>
            </div>

            <!-- Group 3: CV Download & Action Buttons -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-cyan-300">Resume / CV Download
                        Button</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Button Label</label>
                        <input type="text" name="about_cv_text"
                            value="{{ $contents['about_cv_text'] ?? 'Download CV' }}" placeholder="e.g. Download CV"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">CV File Download URL</label>
                        <input type="text" name="about_cv_url" value="{{ $contents['about_cv_url'] ?? '#' }}"
                            placeholder="e.g. /assets/resume.pdf or https://..."
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-cyan-300 font-mono text-xs focus:border-cyan-500 focus:outline-none transition-colors">
                    </div>
                </div>
            </div>

            <!-- Group 4: Profile Credentials & Specifications (used in App Developer & Creative Themes) -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-indigo-300">Profile
                        Credentials & Info Table</h3>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Full Name</label>
                        <input type="text" name="profile_name"
                            value="{{ $contents['profile_name'] ?? ($contents['about_author'] ?? 'William Anderson') }}"
                            placeholder="e.g. William Anderson"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-bold focus:border-indigo-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Date of Birth</label>
                        <input type="text" name="profile_dob"
                            value="{{ $contents['profile_dob'] ?? '15 May 1994' }}" placeholder="e.g. 15 May 1994"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs focus:border-indigo-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Location Address</label>
                        <input type="text" name="profile_address"
                            value="{{ $contents['profile_address'] ?? 'Melbourne, Australia' }}"
                            placeholder="e.g. Melbourne, Australia"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs focus:border-indigo-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Postal / Zip Code</label>
                        <input type="text" name="profile_zip" value="{{ $contents['profile_zip'] ?? '3000' }}"
                            placeholder="e.g. 3000"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Direct Email</label>
                        <input type="email" name="profile_email"
                            value="{{ $contents['profile_email'] ?? ($contents['about_email'] ?? 'contact@william.design') }}"
                            placeholder="contact@william.design"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Telephone</label>
                        <input type="text" name="profile_phone"
                            value="{{ $contents['profile_phone'] ?? ($contents['about_phone'] ?? '+1-234-567-8901') }}"
                            placeholder="+1-234-567-8901"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Spoken Languages</label>
                        <input type="text" name="profile_language"
                            value="{{ $contents['profile_language'] ?? 'English, German' }}"
                            placeholder="e.g. English, German"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs focus:border-indigo-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Freelance Availability</label>
                        <input type="text" name="profile_freelance"
                            value="{{ $contents['profile_freelance'] ?? 'Available for Hire' }}"
                            placeholder="e.g. Available for Hire"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-emerald-400 font-mono text-xs font-bold focus:border-emerald-500 focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Group 5: Gallery Spotlight Images -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-pink-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-pink-300">Gallery Spotlight
                        Images</h3>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2">
                        <span class="text-[11px] font-mono font-bold text-pink-400">Gallery Spotlight Image 1</span>
                        <input type="text" name="about_gallery_img1"
                            value="{{ $contents['about_gallery_img1'] ?? '' }}"
                            placeholder="uploads/... or https://..."
                            class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono focus:border-pink-500 focus:outline-none">
                    </div>
                    <div class="space-y-2">
                        <span class="text-[11px] font-mono font-bold text-purple-400">Gallery Spotlight Image 2</span>
                        <input type="text" name="about_gallery_img2"
                            value="{{ $contents['about_gallery_img2'] ?? '' }}"
                            placeholder="uploads/... or https://..."
                            class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono focus:border-purple-500 focus:outline-none">
                    </div>
                </div>
            </div>
        </div>

        <script>
            function previewHomeAboutImage(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const preview = document.getElementById('home-about-preview');
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
                <span>Save About Section</span>
            </button>
        </div>
    </form>
</div>
