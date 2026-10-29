<!-- =========================================================================
     SECTION 05: CAREER & EXPERIENCE TIMELINE
     ========================================================================= -->
<div class="rounded-3xl bg-[#09101d] border border-white/10 shadow-2xl overflow-hidden transition-all duration-300 hover:border-white/15">
    <!-- Top Accent Gradient Line -->
    <div class="h-1 w-full" style="background: linear-gradient(90deg, {{ $themeColor }}, #8b5cf6, #ec4899);"></div>

    <!-- Section Card Header -->
    <div class="p-5 sm:p-6 border-b border-white/10 bg-white/[0.015] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5 min-w-0">
            <span class="w-9 h-9 rounded-xl flex items-center justify-center font-bold font-mono text-xs shadow-md shrink-0"
                style="background: {{ $themeColor }}20; color: {{ $themeColor }}; border: 1px solid {{ $themeColor }}40;">
                05
            </span>
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <h2 class="text-base sm:text-lg font-bold text-white tracking-tight truncate">Career & Experience Timeline</h2>
                    <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400 font-bold shrink-0">Section: resume</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5 truncate">Section badge, timeline headlines, and link to complete resume / CV document.</p>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">
            <button type="button" onclick="switchSectionTab('projects')"
                class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all text-xs font-mono flex items-center gap-1 cursor-pointer">
                &larr; Prev
            </button>
            <button type="button" onclick="switchSectionTab('skills')"
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
        <input type="hidden" name="section_name" value="Career & Experience Timeline">


        <div class="space-y-6">
            <!-- Shortcut to Timeline Manager -->
            <div class="p-4 rounded-2xl bg-indigo-950/20 border border-indigo-500/20 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-white">Manage Experience & Education Entries</h4>
                        <p class="text-[11px] text-slate-400">Add or reorder individual career timeline items in the Resume Manager.</p>
                    </div>
                </div>
                <a href="{{ route('admin.resume.index') }}"
                    class="px-3.5 py-1.5 rounded-xl bg-indigo-600/20 hover:bg-indigo-600/30 border border-indigo-500/30 text-indigo-300 font-semibold text-xs transition-colors flex items-center justify-center gap-1.5 self-start sm:self-auto">
                    <span>Resume Manager &rarr;</span>
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
                        <input type="text" name="resume_tag"
                            value="{{ $contents['resume_tag'] ?? 'MY EXPERIENCE' }}"
                            placeholder="e.g. MY EXPERIENCE"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-purple-400 font-mono text-xs font-bold focus:border-purple-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Title (Headline)</label>
                        <input type="text" name="resume_title"
                            value="{{ $contents['resume_title'] ?? 'Education & Experience' }}"
                            placeholder="e.g. Education & Experience"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Subtitle / Description</label>
                    <textarea name="resume_subtitle" rows="2"
                        placeholder="A summary of education and professional career milestones."
                        class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm leading-relaxed focus:border-indigo-500 focus:outline-none transition-colors">{{ $contents['resume_subtitle'] ?? 'A summary of formal design education and leadership positions at venture-backed studios.' }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">View Full Resume Button Label</label>
                        <input type="text" name="resume_btn_text"
                            value="{{ $contents['resume_btn_text'] ?? 'View Full Resume' }}"
                            placeholder="e.g. View Full Resume"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Button Target URL</label>
                        <input type="text" name="resume_btn_url"
                            value="{{ $contents['resume_btn_url'] ?? url('/#resume') }}"
                            placeholder="{{ url('/#resume') }}"
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
                <span>Save Resume Section</span>
            </button>
        </div>
    </form>
</div>
