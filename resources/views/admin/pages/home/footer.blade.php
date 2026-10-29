<!-- =========================================================================
     SECTION 11: WEBSITE GLOBAL FOOTER & SOCIALS
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
                11
            </span>
            <div class="min-w-0">
                <div class="flex items-center gap-2">
                    <h2 class="text-base sm:text-lg font-bold text-white tracking-tight truncate">Website Global Footer &
                        Socials</h2>
                    <span
                        class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400 font-bold shrink-0">Section:
                        footer</span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5 truncate">Brand text, editorial about paragraph, contact
                    details, social media URLs, and copyright attribution.</p>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">
            <button type="button" onclick="switchSectionTab('contact')"
                class="px-2.5 py-1.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all text-xs font-mono flex items-center gap-1 cursor-pointer">
                &larr; Prev
            </button>

        </div>
    </div>

    <!-- Edit Form -->
    <form action="{{ route('admin.pages.update') }}" method="POST" class="p-6 sm:p-7 space-y-6">
        @csrf
        <input type="hidden" name="theme" value="{{ $selectedTheme }}">
        <input type="hidden" name="page" value="{{ $pageSlug }}">
        <input type="hidden" name="section_name" value="Website Global Footer & Socials">


        <div class="space-y-6">
            <!-- Brand & Tagline -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-purple-300">Brand Identity &
                        Short Tagline</h3>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Footer Logo / Name</label>
                        <input type="text" name="footer_logo_text"
                            value="{{ $contents['footer_logo_text'] ?? ($contents['site_logo_text'] ?? 'William') }}"
                            placeholder="e.g. William"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-sm font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Footer Bio / Tagline</label>
                        <textarea name="footer_about_text" rows="2"
                            placeholder="{{ $contents['footer_about_text'] ?? 'Crafting meaningful digital experiences and timeless brand systems.' }}"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs resize-none focus:border-indigo-500 
                            focus:outline-none transition-colors">{{ $contents['footer_about_text'] ?? 'Crafting meaningful digital experiences and timeless brand systems.' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Direct Contact Info -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-indigo-300">Footer Direct
                        Contacts</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Footer Physical Address</label>
                        <input type="text" name="footer_address"
                            value="{{ $contents['footer_address'] ?? ($contents['contact_location'] ?? '121 King Street, Melbourne, Australia') }}"
                            placeholder="121 King Street, Melbourne, Australia"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Footer Direct Phone</label>
                        <input type="text" name="footer_phone"
                            value="{{ $contents['footer_phone'] ?? ($contents['contact_phone'] ?? '+1-234-567-8901') }}"
                            placeholder="+1-234-567-8901"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Footer Email Address</label>
                        <input type="email" name="footer_email"
                            value="{{ $contents['footer_email'] ?? ($contents['contact_email'] ?? 'contact@william.design') }}"
                            placeholder="contact@william.design"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>
            </div>

            <!-- About Column -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-emerald-300">Footer About
                        Column</h3>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">About Column Heading</label>
                        <input type="text" name="footer_about_heading"
                            value="{{ $contents['footer_about_heading'] ?? 'About' }}" placeholder="e.g. About"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-bold focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">About Column Paragraph</label>
                        <textarea name="footer_about_text" rows="2"
                            placeholder="e.g. Dedicated to creating bespoke interactive experiences..."
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs resize-none focus:border-indigo-500 focus:outline-none transition-colors">{{ $contents['footer_about_text'] ?? 'Dedicated to creating bespoke interactive experiences and digital products that stand out with poise and clarity.' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Social Media Channels -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-white/5">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                        <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-cyan-300">Social Media
                            Profiles</h3>
                    </div>
                    <div class="flex items-center gap-2">
                        <label class="text-[10px] font-mono text-slate-400">Socials Section Label:</label>
                        <input type="text" name="follow_title"
                            value="{{ $contents['follow_title'] ?? 'Follow Me:' }}" placeholder="e.g. Follow Me:"
                            class="px-2.5 py-1 rounded-lg bg-[#060b13] border border-white/10 text-white text-xs font-bold font-mono focus:border-cyan-500 focus:outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <span class="block text-[10px] font-mono text-slate-400 mb-1.5">Facebook URL</span>
                        <input type="text" name="social_facebook"
                            value="{{ $contents['social_facebook'] ?? 'https://facebook.com' }}"
                            placeholder="https://facebook.com"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <span class="block text-[10px] font-mono text-slate-400 mb-1.5">Instagram URL</span>
                        <input type="text" name="social_instagram"
                            value="{{ $contents['social_instagram'] ?? 'https://instagram.com' }}"
                            placeholder="https://instagram.com"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <span class="block text-[10px] font-mono text-slate-400 mb-1.5">Pinterest URL</span>
                        <input type="text" name="social_pinterest"
                            value="{{ $contents['social_pinterest'] ?? 'https://pinterest.com' }}"
                            placeholder="https://pinterest.com"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <span class="block text-[10px] font-mono text-slate-400 mb-1.5">TikTok URL</span>
                        <input type="text" name="social_tiktok"
                            value="{{ $contents['social_tiktok'] ?? 'https://tiktok.com' }}"
                            placeholder="https://tiktok.com"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <span class="block text-[10px] font-mono text-slate-400 mb-1.5">YouTube URL</span>
                        <input type="text" name="social_youtube"
                            value="{{ $contents['social_youtube'] ?? 'https://youtube.com' }}"
                            placeholder="https://youtube.com"
                            class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-mono focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                </div>
            </div>

            <!-- Footer Philosophical Quote (Developer & Graphic Designer Themes) -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-amber-300">Footer Editorial
                        Quote (Developer & Graphic Themes)</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Philosophical Quote Text</label>
                        <input type="text" name="quote_text"
                            value="{{ $contents['quote_text'] ?? 'Perfection is achieved, not when there is nothing more to add, but when there is nothing left to take away.' }}"
                            placeholder="Quote text..."
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs italic focus:border-amber-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Quote Author Attribution</label>
                        <input type="text" name="quote_author"
                            value="{{ $contents['quote_author'] ?? 'Antoine de Saint-Exupéry' }}"
                            placeholder="Author (e.g. Antoine de Saint-Exupéry)"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-amber-300 text-xs font-bold font-mono focus:border-amber-500 focus:outline-none transition-colors">
                    </div>
                </div>
            </div>

            <!-- Copyright & Credits -->
            <div class="p-5 sm:p-6 rounded-2xl bg-black/40 border border-white/10 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                    <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                    <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-slate-300">Copyright Notice &
                        Credits</h3>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Footer Copyright Notice</label>
                        <input type="text" name="copyright_text"
                            value="{{ $contents['copyright_text'] ?? '© ' . ($contents['footer_logo_text'] ?? ($contents['site_logo_text'] ?? 'William')) . ' / All rights reserved' }}"
                            placeholder="e.g. © William / All rights reserved"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs focus:border-indigo-500 focus:outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5">Footer Design Credits
                            Attribution</label>
                        <input type="text" name="footer_credits"
                            value="{{ $contents['footer_credits'] ?? 'Themetorium' }}" placeholder="e.g. Themetorium"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#060b13] border border-white/10 text-white text-xs font-bold focus:border-purple-500 focus:outline-none transition-colors">
                    </div>
                </div>
            </div>
        </div>


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
                <span>Save Footer Section</span>
            </button>
        </div>
    </form>
</div>
