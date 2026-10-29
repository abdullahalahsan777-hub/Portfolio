<!-- =========================================================================
     SECTION 02: ARTICLES FEED & PAGINATION SETTINGS
     ========================================================================= -->
<div class="rounded-3xl bg-[#09101d] border border-white/10 shadow-2xl overflow-hidden transition-all duration-300 hover:border-white/15">
    <!-- Top Accent Gradient Line -->
    <div class="h-1 w-full" style="background: linear-gradient(90deg, {{ $themeColor }}, #8b5cf6, #ec4899);"></div>

    <!-- Section Card Header -->
    <div class="p-5 sm:p-6 border-b border-white/10 bg-white/[0.015] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5 min-w-0">
            <span class="w-9 h-9 rounded-xl flex items-center justify-center font-bold font-mono text-xs shadow-md shrink-0"
                style="background: {{ $themeColor }}20; color: {{ $themeColor }}; border: 1px solid {{ $themeColor }}40;">
                02
            </span>
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <h2 class="text-base sm:text-lg font-bold text-white tracking-tight truncate">Articles Feed & Pagination Settings</h2>
                    <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400 font-bold shrink-0">feed</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5 truncate">Read more link text, pagination limits, and articles listing configurations</p>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">
            <button type="button" onclick="switchSectionTab('hero')"
                class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all text-xs font-mono flex items-center gap-1 cursor-pointer">
                &larr; Prev
            </button>
            <button type="button" onclick="switchSectionTab('newsletter')"
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
        <input type="hidden" name="section_name" value="Articles Feed & Pagination Settings">

        <div class="p-5 sm:p-6 rounded-2xl bg-white/[0.02] border border-white/5 space-y-4">
            <div class="flex items-center gap-2.5 pb-3 border-b border-white/5">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center font-bold text-xs" style="background: {{ $themeColor }}15; color: {{ $themeColor }};">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-white uppercase tracking-wider">Feed Display Options</h3>
                    <p class="text-[10px] text-slate-400">Card read more text and pagination count</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-mono uppercase tracking-wider text-slate-300 font-semibold mb-1.5">"Read More" Link Text</label>
                    <input type="text" name="blog_read_more_text"
                        value="{{ $contents['blog_read_more_text'] ?? 'Read Full Article' }}"
                        placeholder="e.g. Read Full Article"
                        class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white placeholder-slate-500 text-xs sm:text-sm font-semibold focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-mono uppercase tracking-wider text-slate-300 font-semibold mb-1.5">Articles Per Page (Pagination Limit)</label>
                    <input type="number" name="blog_posts_per_page" min="2" max="24"
                        value="{{ $contents['blog_posts_per_page'] ?? '8' }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white placeholder-slate-500 text-xs sm:text-sm font-mono focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition-all">
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
                <span>Save Feed Settings</span>
            </button>
        </div>
    </form>
</div>
