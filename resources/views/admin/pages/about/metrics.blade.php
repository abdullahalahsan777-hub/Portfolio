<!-- =========================================================================
     SECTION 03: ACHIEVEMENT METRICS & DELIVERABLES
     ========================================================================= -->
<div class="rounded-3xl bg-[#09101d] border border-white/10 shadow-2xl overflow-hidden transition-all duration-300 hover:border-white/15">
    <!-- Top Accent Gradient Line -->
    <div class="h-1 w-full" style="background: linear-gradient(90deg, {{ $themeColor }}, #8b5cf6, #ec4899);"></div>

    <!-- Section Card Header -->
    <div class="p-5 sm:p-6 border-b border-white/10 bg-white/[0.015] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5 min-w-0">
            <span class="w-9 h-9 rounded-xl flex items-center justify-center font-bold font-mono text-xs shadow-md shrink-0"
                style="background: {{ $themeColor }}20; color: {{ $themeColor }}; border: 1px solid {{ $themeColor }}40;">
                03
            </span>
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <h2 class="text-base sm:text-lg font-bold text-white tracking-tight truncate">Achievement Metrics & Deliverables</h2>
                    <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400 font-bold shrink-0">Section: metrics</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5 truncate">High-impact stat counters and deliverable summaries highlighting milestones.</p>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">
            <button type="button" onclick="switchSectionTab('narrative')"
                class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all text-xs font-mono flex items-center gap-1 cursor-pointer">
                &larr; Prev
            </button>
            <button type="button" onclick="switchSectionTab('philosophy')"
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
        <input type="hidden" name="section_name" value="Achievement Metrics & Deliverables">


        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Stat Card 1 -->
                <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-white/5">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-cyan-400"></span>
                            <span class="text-xs font-mono font-bold text-cyan-300 uppercase tracking-wider">Metric Card 1</span>
                        </div>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-white/5 text-slate-400">Stat 1</span>
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Metric Value / Big Number</label>
                        <input type="text" name="about_stat1_value"
                            value="{{ $contents['about_stat1_value'] ?? '240+' }}"
                            placeholder="e.g. 240+"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-cyan-400 text-2xl font-black font-mono tracking-tight focus:border-cyan-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Card Title / Label</label>
                        <input type="text" name="about_stat1_title"
                            value="{{ $contents['about_stat1_title'] ?? 'Successful Deliverables' }}"
                            placeholder="e.g. Successful Deliverables"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Subtitle / Description</label>
                        <input type="text" name="about_stat1_subtext"
                            value="{{ $contents['about_stat1_subtext'] ?? 'Identities, packaging, and interactive design.' }}"
                            placeholder="e.g. Identities, packaging, and interactive design."
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-slate-300 text-xs focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-white/5">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-fuchsia-400"></span>
                            <span class="text-xs font-mono font-bold text-fuchsia-300 uppercase tracking-wider">Metric Card 2</span>
                        </div>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-white/5 text-slate-400">Stat 2</span>
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Metric Value / Big Number</label>
                        <input type="text" name="about_stat2_value"
                            value="{{ $contents['about_stat2_value'] ?? '18+' }}"
                            placeholder="e.g. 18+"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-fuchsia-400 text-2xl font-black font-mono tracking-tight focus:border-fuchsia-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Card Title / Label</label>
                        <input type="text" name="about_stat2_title"
                            value="{{ $contents['about_stat2_title'] ?? 'Design Awards' }}"
                            placeholder="e.g. Design Awards"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Subtitle / Description</label>
                        <input type="text" name="about_stat2_subtext"
                            value="{{ $contents['about_stat2_subtext'] ?? 'Awwwards, FWA, and Behance Curator Picks.' }}"
                            placeholder="e.g. Awwwards, FWA, and Behance Curator Picks."
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-slate-300 text-xs focus:border-indigo-500 focus:outline-none transition-colors">
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
                <span>Save Achievement Metrics</span>
            </button>
        </div>
    </form>
</div>
