<!-- =========================================================================
     SECTION 02: DIRECT CHANNELS & INFO
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
                    <h2 class="text-base sm:text-lg font-bold text-white tracking-tight truncate">Direct Channels & Info
                    </h2>
                    <span
                        class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400 font-bold shrink-0">Section:
                        channels</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5 truncate">Direct email, telephone number, studio address, and
                    responsive support subtext.</p>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">
            <button type="button" onclick="switchSectionTab('hero')"
                class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all text-xs font-mono flex items-center gap-1 cursor-pointer">
                &larr; Prev
            </button>
            <button type="button" onclick="switchSectionTab('form')"
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
        <input type="hidden" name="section_name" value="Direct Channels & Info">


        <div class="space-y-6">
            <!-- Group: Direct Information Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Channel 1: Email -->
                <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                        <span class="w-2.5 h-2.5 rounded-full bg-indigo-400"></span>
                        <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-indigo-300">Email Channel
                        </h4>
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Email Address</label>
                        <input type="email" name="contact_email"
                            value="{{ $contents['contact_email'] ?? 'contact@william.design' }}"
                            placeholder="contact@william.design"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white font-mono text-xs focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Response Time / Subtext</label>
                        <input type="text" name="contact_email_subtext"
                            value="{{ $contents['contact_email_subtext'] ?? 'Typically replied within 24 hours.' }}"
                            placeholder="e.g. Typically replied within 24 hours."
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-slate-300 text-xs focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>

                <!-- Channel 2: Phone -->
                <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                        <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-emerald-300">Phone Channel
                        </h4>
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Phone Number</label>
                        <input type="text" name="contact_phone"
                            value="{{ $contents['contact_phone'] ?? '+1-234-567-8901' }}" placeholder="+1-234-567-8901"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white font-mono text-xs focus:border-emerald-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Working Hours / Subtext</label>
                        <input type="text" name="contact_phone_subtext"
                            value="{{ $contents['contact_phone_subtext'] ?? 'Mon - Fri, 9am - 6pm EST' }}"
                            placeholder="e.g. Mon - Fri, 9am - 6pm EST"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-slate-300 text-xs focus:border-emerald-500 focus:outline-none transition-colors">
                    </div>
                </div>

                <!-- Channel 3: Location -->
                <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                        <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-amber-300">Studio Location
                        </h4>
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Studio Address</label>
                        <input type="text" name="contact_address"
                            value="{{ $contents['contact_address'] ?? '121 King Street, Melbourne, Australia' }}"
                            placeholder="e.g. 121 King Street, Melbourne, Australia"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs focus:border-amber-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Work Modality / Subtext</label>
                        <input type="text" name="contact_address_subtext"
                            value="{{ $contents['contact_address_subtext'] ?? 'Available for worldwide remote contracts.' }}"
                            placeholder="e.g. Available for worldwide remote contracts."
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-slate-300 text-xs focus:border-amber-500 focus:outline-none transition-colors">
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
                <span>Save Contact Channels</span>
            </button>
        </div>
    </form>
</div>
