<!-- =========================================================================
     SECTION 06: SKILLS & COMPETENCIES
     ========================================================================= -->
<div class="rounded-3xl bg-[#09101d] border border-white/10 shadow-2xl overflow-hidden transition-all duration-300 hover:border-white/15">
    <!-- Top Accent Gradient Line -->
    <div class="h-1 w-full" style="background: linear-gradient(90deg, {{ $themeColor }}, #8b5cf6, #ec4899);"></div>

    <!-- Section Card Header -->
    <div class="p-5 sm:p-6 border-b border-white/10 bg-white/[0.015] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5 min-w-0">
            <span class="w-9 h-9 rounded-xl flex items-center justify-center font-bold font-mono text-xs shadow-md shrink-0"
                style="background: {{ $themeColor }}20; color: {{ $themeColor }}; border: 1px solid {{ $themeColor }}40;">
                06
            </span>
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <h2 class="text-base sm:text-lg font-bold text-white tracking-tight truncate">Skills & Competencies</h2>
                    <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400 font-bold shrink-0">Section: skills</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5 truncate">Section badge, skill headlines, and footer competency note.</p>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">
            <button type="button" onclick="switchSectionTab('resume')"
                class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all text-xs font-mono flex items-center gap-1 cursor-pointer">
                &larr; Prev
            </button>
            <button type="button" onclick="switchSectionTab('testimonials')"
                class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all text-xs font-mono flex items-center gap-1 cursor-pointer">
                Next &rarr;
            </button>
        </div>
    </div>

    <!-- Edit Form -->
    <form action="{{ route('admin.pages.update') }}" method="POST" class="p-6 sm:p-7 space-y-6">
        @csrf
        <input type="hidden" name="theme" value="{{ $selectedTheme }}">
        <input type="hidden" name="page" value="{{ $pageSlug }}">
        <input type="hidden" name="section_name" value="Skills & Competencies">


        <div class="space-y-6">
            <!-- Shortcut to Skills Manager -->
            <div class="p-4 rounded-2xl bg-indigo-950/20 border border-indigo-500/20 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-white">Manage Technical & Creative Skills</h4>
                        <p class="text-[11px] text-slate-400">Add or adjust skill proficiency levels and categories in the Skills Manager.</p>
                    </div>
                </div>
                <a href="{{ route('admin.skills.index') }}"
                    class="px-3.5 py-1.5 rounded-xl bg-indigo-600/20 hover:bg-indigo-600/30 border border-indigo-500/30 text-indigo-300 font-semibold text-xs transition-colors flex items-center justify-center gap-1.5 self-start sm:self-auto">
                    <span>Skills Manager &rarr;</span>
                </a>
            </div>

            <!-- Settings Group -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-indigo-300">Headlines & Copy</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Pill Tag</label>
                        <input type="text" name="skills_tag"
                            value="{{ $contents['skills_tag'] ?? 'MY ADVANTAGES' }}"
                            placeholder="e.g. MY ADVANTAGES"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-purple-400 font-mono text-xs font-bold focus:border-purple-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Title (Headline)</label>
                        <input type="text" name="skills_title"
                            value="{{ $contents['skills_title'] ?? 'Skills & Mastery' }}"
                            placeholder="e.g. Skills & Mastery"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Subtitle / Description</label>
                    <textarea name="skills_subtitle" rows="2"
                        placeholder="Core tools, technologies, and creative disciplines."
                        class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm leading-relaxed focus:border-indigo-500 focus:outline-none transition-colors">{{ $contents['skills_subtitle'] ?? 'Proficiency across leading industry tools, design engineering frameworks, and architectural patterns.' }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Bottom Competency Note</label>
                    <input type="text" name="skills_footer_note"
                        value="{{ $contents['skills_footer_note'] ?? 'Non-stop learning and adopting state-of-the-art web capabilities.' }}"
                        placeholder="e.g. Non-stop learning and adopting state-of-the-art web capabilities."
                        class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-slate-300 text-xs focus:border-indigo-500 focus:outline-none transition-colors">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2 border-t border-white/5">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Skills Action Button Label</label>
                        <input type="text" name="skills_cta_text"
                            value="{{ $contents['skills_cta_text'] ?? '' }}"
                            placeholder="e.g. View All Skills / Certifications"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Skills Action Target URL</label>
                        <input type="text" name="skills_cta_url"
                            value="{{ $contents['skills_cta_url'] ?? '' }}"
                            placeholder="e.g. #resume or https://..."
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-indigo-300 font-mono text-xs focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>
            </div>
        </div>
    

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
                <span>Save Skills Section</span>
            </button>
        </div>
    </form>
</div>
