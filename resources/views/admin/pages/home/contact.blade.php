<!-- =========================================================================
     SECTION 10: CALL-TO-ACTION & CONTACT SECTION
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
                10
            </span>
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <h2 class="text-base sm:text-lg font-bold text-white tracking-tight truncate">Call-To-Action &
                        Contact Section</h2>
                    <span
                        class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400 font-bold shrink-0">Section:
                        contact</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5 truncate">Closing project inquiry headline, direct communication
                    channels, and background watermark.</p>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">
            <button type="button" onclick="switchSectionTab('blog')"
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
        <input type="hidden" name="section_name" value="Call-To-Action & Contact Section">


        <div class="space-y-6">
            <!-- Headlines Group -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-indigo-300">Headlines &
                        Subtitle</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Pill Tag</label>
                        <input type="text" name="contact_tag"
                            value="{{ $contents['contact_tag'] ?? 'GET IN TOUCH' }}" placeholder="e.g. GET IN TOUCH"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-purple-400 font-mono text-xs font-bold focus:border-purple-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Title (Headline)</label>
                        <input type="text" name="contact_title"
                            value="{{ $contents['contact_title'] ?? 'Let Us Make Something Great Together!' }}"
                            placeholder="e.g. Let Us Make Something Great Together!"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Section Subheading / Lead</label>
                        <input type="text" name="contact_subheading"
                            value="{{ $contents['contact_subheading'] ?? '' }}"
                            placeholder="e.g. Have a project or inquiry? Reach out anytime."
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-indigo-300 text-xs focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Form Box Headline</label>
                        <input type="text" name="contact_form_title"
                            value="{{ $contents['contact_form_title'] ?? 'Send a Message' }}"
                            placeholder="e.g. Send a Message"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Subtitle / Encouraging Intro</label>
                    <textarea name="contact_subtitle" rows="2"
                        placeholder="e.g. Have a project or idea? Let us build something extraordinary."
                        class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm leading-relaxed focus:border-indigo-500 focus:outline-none transition-colors">{{ $contents['contact_subtitle'] ?? 'Have an exciting project, a product to design, or want to collaborate? I would love to hear from you.' }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2 border-t border-white/5">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Form Submit Button Label</label>
                        <input type="text" name="contact_cta_text"
                            value="{{ $contents['contact_cta_text'] ?? 'Send Message' }}"
                            placeholder="e.g. Send Message"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-emerald-400 font-bold text-xs focus:border-emerald-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Newsletter Subscribe Button
                            Label</label>
                        <input type="text" name="newsletter_btn_text"
                            value="{{ $contents['newsletter_btn_text'] ?? 'Subscribe' }}" placeholder="e.g. Subscribe"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-purple-300 font-mono text-xs focus:border-purple-500 focus:outline-none transition-colors">
                    </div>
                </div>
            </div>

            <!-- Direct Details Group -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-emerald-300">Direct Contact
                        Information</h3>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Direct Email</label>
                        <input type="email" name="contact_email"
                            value="{{ $contents['contact_email'] ?? 'contact@william.design' }}"
                            placeholder="contact@william.design"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Phone Number</label>
                        <input type="text" name="contact_phone"
                            value="{{ $contents['contact_phone'] ?? '+1-234-567-8901' }}" placeholder="+1-234-567-8901"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Skype Username</label>
                        <input type="text" name="contact_skype" value="{{ $contents['contact_skype'] ?? '' }}"
                            placeholder="live:william.designer"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-cyan-300 text-xs font-mono focus:border-cyan-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Location / City Tag</label>
                        <input type="text" name="contact_location"
                            value="{{ $contents['contact_location'] ?? 'Melbourne, Australia' }}"
                            placeholder="Melbourne, Australia"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Full Studio Address</label>
                        <input type="text" name="contact_address"
                            value="{{ $contents['contact_address'] ?? '121 King Street, Melbourne, Australia' }}"
                            placeholder="121 King Street, Melbourne, Australia"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>

                <div class="pt-2 border-t border-white/5">
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Background Decorative Watermark
                        Text</label>
                    <input type="text" name="footer_watermark"
                        value="{{ $contents['footer_watermark'] ?? 'LET US TALK' }}" placeholder="e.g. LET US TALK"
                        class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-slate-400 font-mono text-xs uppercase tracking-widest focus:border-purple-500 focus:outline-none transition-colors">
                </div>
            </div>

            <!-- Features / Checkmarks (used in UI/UX Designer Theme) -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-cyan-300">Contact Form
                        Checkpoints (UI/UX Designer Theme)</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Checkpoint 1</label>
                        <input type="text" name="contact_check1"
                            value="{{ $contents['contact_check1'] ?? '100% Guaranteed Quality' }}"
                            placeholder="e.g. 100% Guaranteed Quality"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs focus:border-cyan-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Checkpoint 2</label>
                        <input type="text" name="contact_check2"
                            value="{{ $contents['contact_check2'] ?? 'Flexible Pricing Models' }}"
                            placeholder="e.g. Flexible Pricing Models"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs focus:border-cyan-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Checkpoint 3</label>
                        <input type="text" name="contact_check3"
                            value="{{ $contents['contact_check3'] ?? 'Fast 24/7 Response' }}"
                            placeholder="e.g. Fast 24/7 Response"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs focus:border-cyan-500 focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Highlight Info Boxes (used in App Developer Theme) -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-amber-300">Highlight Info
                        Cards (App Developer Theme)</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Box 1 -->
                    <div class="space-y-2">
                        <span class="text-[11px] font-mono font-bold text-amber-300">Card 01</span>
                        <input type="text" name="contact_box1_title"
                            value="{{ $contents['contact_box1_title'] ?? 'Direct Call' }}"
                            placeholder="Card Title (e.g. Direct Call)"
                            class="w-full px-3 py-1.5 rounded-lg bg-black/40 border border-white/10 text-white text-xs font-bold focus:border-amber-500 focus:outline-none">
                        <input type="text" name="contact_box1_val"
                            value="{{ $contents['contact_box1_val'] ?? '+1-234-567-8901' }}"
                            placeholder="Card Value (e.g. +1-234-567-8901)"
                            class="w-full px-3 py-1.5 rounded-lg bg-black/40 border border-white/10 text-slate-300 text-xs font-mono focus:border-amber-500 focus:outline-none">
                    </div>
                    <!-- Box 2 -->
                    <div class="space-y-2">
                        <span class="text-[11px] font-mono font-bold text-emerald-300">Card 02</span>
                        <input type="text" name="contact_box2_title"
                            value="{{ $contents['contact_box2_title'] ?? 'Email Address' }}"
                            placeholder="Card Title (e.g. Email Address)"
                            class="w-full px-3 py-1.5 rounded-lg bg-black/40 border border-white/10 text-white text-xs font-bold focus:border-emerald-500 focus:outline-none">
                        <input type="text" name="contact_box2_val"
                            value="{{ $contents['contact_box2_val'] ?? 'contact@william.design' }}"
                            placeholder="Card Value (e.g. contact@william.design)"
                            class="w-full px-3 py-1.5 rounded-lg bg-black/40 border border-white/10 text-slate-300 text-xs font-mono focus:border-emerald-500 focus:outline-none">
                    </div>
                    <!-- Box 3 -->
                    <div class="space-y-2">
                        <span class="text-[11px] font-mono font-bold text-indigo-300">Card 03</span>
                        <input type="text" name="contact_box3_title"
                            value="{{ $contents['contact_box3_title'] ?? 'Studio HQ' }}"
                            placeholder="Card Title (e.g. Studio HQ)"
                            class="w-full px-3 py-1.5 rounded-lg bg-black/40 border border-white/10 text-white text-xs font-bold focus:border-indigo-500 focus:outline-none">
                        <input type="text" name="contact_box3_val"
                            value="{{ $contents['contact_box3_val'] ?? 'Melbourne, Australia' }}"
                            placeholder="Card Value (e.g. Melbourne, Australia)"
                            class="w-full px-3 py-1.5 rounded-lg bg-black/40 border border-white/10 text-slate-300 text-xs font-mono focus:border-indigo-500 focus:outline-none">
                    </div>
                </div>
            </div>
        </div>


        <!-- Bottom Action Bar -->
        <div
            class="pt-5 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-2 bg-white/[0.01] -mx-6 sm:-mx-7 -mb-6 sm:-mb-7 p-5 sm:p-6 rounded-b-3xl">
            <div class="flex items-center gap-2 text-xs text-slate-400">
                <span class="w-2 h-2 rounded-full animate-pulse"
                    style="background-color: {{ $themeColor }};"></span>
                <span>Active Theme: <strong class="text-white font-mono">{{ $themeName }}</strong> • Saved to <code
                        class="text-indigo-300 font-mono">theme_contents</code></span>
            </div>
            <button type="submit"
                class="w-full sm:w-auto px-2.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-white shadow-lg transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2 cursor-pointer"
                style="background: linear-gradient(135deg, {{ $themeColor }}, #4f46e5);">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Save Home Contact Section</span>
            </button>
        </div>
    </form>
</div>
