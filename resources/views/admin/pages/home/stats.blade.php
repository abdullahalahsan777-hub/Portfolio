<!-- =========================================================================
     SECTION 02: KEY METRICS & ACHIEVEMENT STATISTICS
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
                    <h2 class="text-base sm:text-lg font-bold text-white tracking-tight truncate">Key Metrics &
                        Achievement Statistics</h2>
                    <span
                        class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400 font-bold shrink-0">Section:
                        stats</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5 truncate">Numerical counters, years of industry experience,
                    satisfied clients, and design awards.</p>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">
            <button type="button" onclick="switchSectionTab('hero')"
                class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all text-xs font-mono flex items-center gap-1 cursor-pointer">
                &larr; Prev
            </button>
            <button type="button" onclick="switchSectionTab('services')"
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
        <input type="hidden" name="section_name" value="Key Metrics & Achievement Statistics">


        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Stat 1 -->
                <div class="p-5 rounded-2xl bg-black/40 border border-white/10 space-y-3">
                    <div class="flex items-center justify-between pb-2 border-b border-white/5">
                        <span class="text-xs font-mono font-bold text-indigo-400 uppercase">Stat 01</span>
                        <span class="text-[10px] font-mono text-slate-500">Experience</span>
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Number / Value</label>
                        <input type="text" name="experience_years"
                            value="{{ $contents['experience_years'] ?? '12+' }}" placeholder="e.g. 12+"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-indigo-400 text-2xl font-black font-mono tracking-tight focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Label / Title</label>
                        <input type="text" name="experience_years_label"
                            value="{{ $contents['experience_years_label'] ?? 'Years Experience' }}"
                            placeholder="e.g. Years Experience"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="p-5 rounded-2xl bg-black/40 border border-white/10 space-y-3">
                    <div class="flex items-center justify-between pb-2 border-b border-white/5">
                        <span class="text-xs font-mono font-bold text-emerald-400 uppercase">Stat 02</span>
                        <span class="text-[10px] font-mono text-slate-500">Clients</span>
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Number / Value</label>
                        <input type="text" name="satisfied_clients"
                            value="{{ $contents['satisfied_clients'] ?? '150+' }}" placeholder="e.g. 150+"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-emerald-400 text-2xl font-black font-mono tracking-tight focus:border-emerald-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Label / Title</label>
                        <input type="text" name="satisfied_clients_label"
                            value="{{ $contents['satisfied_clients_label'] ?? 'Satisfied Clients' }}"
                            placeholder="e.g. Satisfied Clients"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-bold focus:border-emerald-500 focus:outline-none transition-colors">
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="p-5 rounded-2xl bg-black/40 border border-white/10 space-y-3">
                    <div class="flex items-center justify-between pb-2 border-b border-white/5">
                        <span class="text-xs font-mono font-bold text-cyan-400 uppercase">Stat 03</span>
                        <span class="text-[10px] font-mono text-slate-500">Projects</span>
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Number / Value</label>
                        <input type="text" name="completed_projects"
                            value="{{ $contents['completed_projects'] ?? '280+' }}" placeholder="e.g. 280+"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-cyan-400 text-2xl font-black font-mono tracking-tight focus:border-cyan-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Label / Title</label>
                        <input type="text" name="completed_projects_label"
                            value="{{ $contents['completed_projects_label'] ?? 'Completed Projects' }}"
                            placeholder="e.g. Completed Projects"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-bold focus:border-cyan-500 focus:outline-none transition-colors">
                    </div>
                </div>

                <!-- Stat 4 -->
                <div class="p-5 rounded-2xl bg-black/40 border border-white/10 space-y-3">
                    <div class="flex items-center justify-between pb-2 border-b border-white/5">
                        <span class="text-xs font-mono font-bold text-amber-400 uppercase">Stat 04</span>
                        <span class="text-[10px] font-mono text-slate-500">Awards</span>
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Number / Value</label>
                        <input type="text" name="awards_count" value="{{ $contents['awards_count'] ?? '24' }}"
                            placeholder="e.g. 24"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-amber-400 text-2xl font-black font-mono tracking-tight focus:border-amber-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Label / Title</label>
                        <input type="text" name="awards_count_label"
                            value="{{ $contents['awards_count_label'] ?? 'Design Awards' }}"
                            placeholder="e.g. Design Awards"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-bold focus:border-amber-500 focus:outline-none transition-colors">
                    </div>
                </div>
            </div>
        </div>


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
                <span>Save Key Metrics</span>
            </button>
        </div>
    </form>
</div>
