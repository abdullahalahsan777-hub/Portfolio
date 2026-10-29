<!-- =========================================================================
     SECTION 04: FEATURED PROJECTS SHOWCASE
     ========================================================================= -->
<div class="rounded-3xl bg-[#09101d] border border-white/10 shadow-2xl overflow-hidden transition-all duration-300 hover:border-white/15">
    <!-- Top Accent Gradient Line -->
    <div class="h-1 w-full" style="background: linear-gradient(90deg, {{ $themeColor }}, #8b5cf6, #ec4899);"></div>

    <!-- Section Card Header -->
    <div class="p-5 sm:p-6 border-b border-white/10 bg-white/[0.015] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5 min-w-0">
            <span class="w-9 h-9 rounded-xl flex items-center justify-center font-bold font-mono text-xs shadow-md shrink-0"
                style="background: {{ $themeColor }}20; color: {{ $themeColor }}; border: 1px solid {{ $themeColor }}40;">
                04
            </span>
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <h2 class="text-base sm:text-lg font-bold text-white tracking-tight truncate">Featured Projects Showcase</h2>
                    <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400 font-bold shrink-0">Section: projects</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5 truncate">Section badge, featured portfolio headline, subtitle, and CTA navigation buttons.</p>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">
            <button type="button" onclick="switchSectionTab('services')"
                class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all text-xs font-mono flex items-center gap-1 cursor-pointer">
                &larr; Prev
            </button>
            <button type="button" onclick="switchSectionTab('resume')"
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
        <input type="hidden" name="section_name" value="Featured Projects Showcase">


        <div class="space-y-6">
            <!-- Shortcut to Projects Manager -->
            <div class="p-4 rounded-2xl bg-indigo-950/20 border border-indigo-500/20 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-white">Manage Portfolio Projects</h4>
                        <p class="text-[11px] text-slate-400">Add, reorder, or update individual case studies and images in the Project Manager.</p>
                    </div>
                </div>
                <a href="{{ route('admin.projects.index') }}"
                    class="px-3.5 py-1.5 rounded-xl bg-indigo-600/20 hover:bg-indigo-600/30 border border-indigo-500/30 text-indigo-300 font-semibold text-xs transition-colors flex items-center justify-center gap-1.5 self-start sm:self-auto">
                    <span>Project Manager &rarr;</span>
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
                        <input type="text" name="portfolio_tag"
                            value="{{ $contents['portfolio_tag'] ?? 'SELECTED WORKS' }}"
                            placeholder="e.g. SELECTED WORKS"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-purple-400 font-mono text-xs font-bold focus:border-purple-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Title (Headline)</label>
                        <input type="text" name="portfolio_title"
                            value="{{ $contents['portfolio_title'] ?? 'Featured Projects' }}"
                            placeholder="e.g. Featured Projects"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Subtitle / Description</label>
                    <textarea name="portfolio_subtitle" rows="2"
                        placeholder="A curated selection of client commissions and venture creations."
                        class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm leading-relaxed focus:border-indigo-500 focus:outline-none transition-colors">{{ $contents['portfolio_subtitle'] ?? 'A curated selection of client commissions, self-initiated ventures, and digital craft.' }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Explore All Button Label</label>
                        <input type="text" name="portfolio_cta_text"
                            value="{{ $contents['portfolio_cta_text'] ?? 'View All Projects' }}"
                            placeholder="e.g. View All Projects"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Explore All Target URL</label>
                        <input type="text" name="portfolio_cta_url"
                            value="{{ $contents['portfolio_cta_url'] ?? route('portfolio') }}"
                            placeholder="{{ route('portfolio') }}"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-indigo-300 font-mono text-xs focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2 border-t border-white/5">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Bottom Callout Button Label</label>
                        <input type="text" name="portfolio_bottom_cta_text"
                            value="{{ $contents['portfolio_bottom_cta_text'] ?? 'Have A Project In Mind?' }}"
                            placeholder="e.g. Have A Project In Mind?"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Bottom Callout Target URL</label>
                        <input type="text" name="portfolio_bottom_cta_url"
                            value="{{ $contents['portfolio_bottom_cta_url'] ?? route('contact') }}"
                            placeholder="{{ route('contact') }}"
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
                <span>Save Projects Section</span>
            </button>
        </div>
    </form>
</div>
