<!-- =========================================================================
     SECTION 03: NEWSLETTER & SUBSCRIPTION BANNER
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
                    <h2 class="text-base sm:text-lg font-bold text-white tracking-tight truncate">Newsletter & Subscription Banner</h2>
                    <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400 font-bold shrink-0">newsletter</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5 truncate">Settings for the reader newsletter opt-in card displayed above or below the blog feed</p>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">
            <button type="button" onclick="switchSectionTab('feed')"
                class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all text-xs font-mono flex items-center gap-1 cursor-pointer">
                &larr; Prev
            </button>
            <button type="button" onclick="switchSectionTab('footer')"
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
        <input type="hidden" name="section_name" value="Newsletter & Subscription Banner">

        <div class="p-5 sm:p-6 rounded-2xl bg-white/[0.02] border border-white/5 space-y-4">
            <div class="flex items-center gap-2.5 pb-3 border-b border-white/5">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center font-bold text-xs" style="background: {{ $themeColor }}15; color: {{ $themeColor }};">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-white uppercase tracking-wider">Email Opt-in Settings</h3>
                    <p class="text-[10px] text-slate-400">Headlines and subscription button text</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-mono uppercase tracking-wider text-slate-300 font-semibold mb-1.5">Newsletter Title</label>
                    <input type="text" name="newsletter_title"
                        value="{{ $contents['newsletter_title'] ?? 'Subscribe to Monthly Design Dispatches' }}"
                        placeholder="e.g. Subscribe to Monthly Design Dispatches"
                        class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white placeholder-slate-500 text-xs sm:text-sm font-bold focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-mono uppercase tracking-wider text-slate-300 font-semibold mb-1.5">Subscribe Button Text</label>
                    <input type="text" name="newsletter_btn_text"
                        value="{{ $contents['newsletter_btn_text'] ?? 'SUBSCRIBE' }}"
                        placeholder="SUBSCRIBE"
                        class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white placeholder-slate-500 text-xs sm:text-sm font-semibold focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition-all">
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-mono uppercase tracking-wider text-slate-300 font-semibold mb-1.5">Newsletter Subtitle / Privacy Notice</label>
                <textarea name="newsletter_subtitle" rows="2"
                    placeholder="e.g. No spam, only thoughtful architectural reflections..."
                    class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white placeholder-slate-500 text-xs sm:text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition-all font-medium resize-none">{{ $contents['newsletter_subtitle'] ?? 'No spam, only thoughtful architectural reflections, typography tips, and curated tools directly in your inbox.' }}</textarea>
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
                <span>Save Newsletter Banner</span>
            </button>
        </div>
    </form>
</div>
