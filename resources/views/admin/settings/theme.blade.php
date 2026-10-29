@extends('admin.layout')

@section('title', 'Theme Settings')
@section('page_title', 'Theme Settings')
@section('page_subtitle', 'Visual Appearance & Layout')

@section('content')
    <div class="w-full space-y-8">
        <div>
            <h1 class="text-2xl font-extrabold text-white">Theme &amp; Visual Appearance</h1>
            <p class="text-xs text-slate-400 mt-1">Select the live aesthetic presented to visitors and define color scheme behavior (Dark / Light / System).</p>
        </div>

        <form action="{{ route('admin.settings.theme.update') }}" method="POST" class="space-y-8">
            @csrf

            <!-- THEME SELECTION MODULE -->
            <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 space-y-6 shadow-xl">
                <div class="border-b border-white/10 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <span class="text-xs font-mono font-bold text-sky-400 uppercase tracking-widest">Theme Customizer</span>
                        <h2 class="text-xl font-bold text-white mt-1">Select Active Portfolio Theme</h2>
                        <p class="text-xs text-slate-400">Choose which visual aesthetic is presented to visitors by default.</p>
                    </div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-500/10 border border-sky-500/20 text-sky-300 text-[11px] font-mono">
                        <svg class="w-3.5 h-3.5 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>Controlled from Admin</span>
                    </div>
                </div>

                <div class="p-3.5 rounded-xl bg-sky-950/40 border border-sky-500/20 text-xs text-sky-200 flex items-start gap-2.5">
                    <svg class="w-4 h-4 text-sky-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span><strong>Active Theme Note:</strong> All frontend visitors immediately see the chosen theme layout, color tokens, and custom components upon saving.</span>
                </div>

                @php
                    $currentTheme = $settings['active_theme'] ?? 'developer';
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Option 1: Graphic Designer Theme -->
                    <label class="relative cursor-pointer rounded-2xl p-5 border-2 transition-all flex flex-col justify-between space-y-4 {{ $currentTheme === 'graphic_designer' ? 'border-[#7c3aed] bg-[#140f2b] shadow-xl shadow-[#7c3aed]/20' : 'border-white/10 bg-black/40 hover:border-white/30' }}">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="w-3.5 h-3.5 rounded-full bg-[#7c3aed] border-2 border-[#140f2b] inline-block"></span>
                                <input type="radio" name="active_theme" value="graphic_designer"
                                    {{ $currentTheme === 'graphic_designer' ? 'checked' : '' }}
                                    class="text-[#7c3aed] focus:ring-0">
                            </div>
                            <div class="flex items-center gap-1.5">
                                <h3 class="font-extrabold text-white text-base">Graphic Designer</h3>
                            </div>
                            <p class="text-[11px] text-[#a59cc0] leading-relaxed">
                                Deep cosmic violet (<code class="text-purple-300">#0c0a18</code>), organic floral badge shape, electric violet &amp; neon fuchsia accents, "Crafting Intuitive Digital Experiences", stats ribbon, resume, skills, &amp; testimonials.
                            </p>
                        </div>
                        <div class="flex items-center gap-1.5 pt-2 border-t border-white/10">
                            <span class="w-4 h-4 rounded-full bg-[#0c0a18] border border-white/20"></span>
                            <span class="w-4 h-4 rounded-full bg-[#7c3aed]"></span>
                            <span class="w-4 h-4 rounded-full bg-[#ec4899]"></span>
                            <span class="text-[10px] font-mono text-purple-300 ml-auto">Electric Violet</span>
                        </div>
                    </label>

                    <!-- Option 2: Developer Theme (GLINT) -->
                    <label class="relative cursor-pointer rounded-2xl p-5 border-2 transition-all flex flex-col justify-between space-y-4 {{ $currentTheme === 'developer' ? 'border-[#00ff88] bg-[#070707] shadow-xl shadow-[#00ff88]/20' : 'border-white/10 bg-black/40 hover:border-white/30' }}">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="w-3.5 h-3.5 rounded-full bg-[#00ff88] border-2 border-[#070707] inline-block"></span>
                                <input type="radio" name="active_theme" value="developer"
                                    {{ $currentTheme === 'developer' ? 'checked' : '' }}
                                    class="text-[#00ff88] focus:ring-0">
                            </div>
                            <div class="flex items-center gap-1.5">
                                <h3 class="font-extrabold text-white text-base">Developer Theme (GLINT)</h3>
                            </div>
                            <p class="text-[11px] text-neutral-400 leading-relaxed">
                                Deep tech pitch black (<code class="text-[#00ff88]">#070707</code>), vibrant neon emerald green (<code class="text-[#00ff88]">#00ff88</code>), cube logo (<code class="text-[#00ff88]">⬢ GLINT</code>), circular skill dials, and clean agency architecture.
                            </p>
                        </div>
                        <div class="flex items-center gap-1.5 pt-2 border-t border-white/10">
                            <span class="w-4 h-4 rounded-full bg-[#070707] border border-white/20"></span>
                            <span class="w-4 h-4 rounded-full bg-[#00ff88]"></span>
                            <span class="text-[10px] font-mono text-[#00ff88] ml-auto">Neon Emerald</span>
                        </div>
                    </label>

                    <!-- Option 3: UI/UX Designer Theme -->
                    <label class="relative cursor-pointer rounded-2xl p-5 border-2 transition-all flex flex-col justify-between space-y-4 {{ $currentTheme === 'uiux_designer' ? 'border-[#ccff00] bg-[#121212] shadow-xl shadow-[#ccff00]/20' : 'border-white/10 bg-black/40 hover:border-white/30' }}">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="w-3.5 h-3.5 rounded-full bg-[#ccff00] border-2 border-[#121212] inline-block"></span>
                                <input type="radio" name="active_theme" value="uiux_designer"
                                    {{ $currentTheme === 'uiux_designer' ? 'checked' : '' }}
                                    class="text-[#ccff00] focus:ring-0">
                            </div>
                            <div class="flex items-center gap-1.5">
                                <h3 class="font-extrabold text-white text-base">UI/UX Designer</h3>
                            </div>
                            <p class="text-[11px] text-neutral-400 leading-relaxed">
                                Pitch black &amp; onyx backdrop (<code class="text-[#ccff00]">#080808</code>), electric neon lime (<code class="text-[#ccff00]">#ccff00</code>), half-lime split circle, 01-06 service cards, and modern project showcases.
                            </p>
                        </div>
                        <div class="flex items-center gap-1.5 pt-2 border-t border-white/10">
                            <span class="w-4 h-4 rounded-full bg-[#080808] border border-white/20"></span>
                            <span class="w-4 h-4 rounded-full bg-[#ccff00]"></span>
                            <span class="text-[10px] font-mono text-[#ccff00] ml-auto">Neon Lime</span>
                        </div>
                    </label>

                    <!-- Option 4: App Developer Theme -->
                    <label class="relative cursor-pointer rounded-2xl p-5 border-2 transition-all flex flex-col justify-between space-y-4 {{ $currentTheme === 'app_developer' ? 'border-[#ff0033] bg-[#140608] shadow-xl shadow-[#ff0033]/25' : 'border-white/10 bg-black/40 hover:border-white/30' }}">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="w-3.5 h-3.5 rounded-full bg-[#ff0033] border-2 border-[#140608] inline-block"></span>
                                <input type="radio" name="active_theme" value="app_developer"
                                    {{ $currentTheme === 'app_developer' ? 'checked' : '' }}
                                    class="text-[#ff0033] focus:ring-0">
                            </div>
                            <div class="flex items-center gap-1.5">
                                <h3 class="font-extrabold text-white text-base">App Developer</h3>
                            </div>
                            <p class="text-[11px] text-neutral-400 leading-relaxed">
                                Pitch black backdrop (<code class="text-[#ff0033]">#070707</code>), vibrant crimson red accents (<code class="text-[#ff0033]">#ff0033</code>), bold condensed typography, 15k+ 3D red bar chart, and modern app architecture cards.
                            </p>
                        </div>
                        <div class="flex items-center gap-1.5 pt-2 border-t border-white/10">
                            <span class="w-4 h-4 rounded-full bg-[#070707] border border-white/20"></span>
                            <span class="w-4 h-4 rounded-full bg-[#ff0033]"></span>
                            <span class="w-4 h-4 rounded-full bg-white"></span>
                            <span class="text-[10px] font-mono text-[#ff0033] ml-auto">Crimson Red</span>
                        </div>
                    </label>

                    <!-- Option 5: App & Software Developer Theme -->
                    <label class="relative cursor-pointer rounded-2xl p-5 border-2 transition-all flex flex-col justify-between space-y-4 {{ $currentTheme === 'app_software_developer' ? 'border-[#ff6b00] bg-[#140b05] shadow-xl shadow-[#ff6b00]/25' : 'border-white/10 bg-black/40 hover:border-white/30' }}">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="w-3.5 h-3.5 rounded-full bg-[#ff6b00] border-2 border-[#140b05] inline-block"></span>
                                <input type="radio" name="active_theme" value="app_software_developer"
                                    {{ $currentTheme === 'app_software_developer' ? 'checked' : '' }}
                                    class="text-[#ff6b00] focus:ring-0">
                            </div>
                            <div class="flex items-center gap-1.5">
                                <h3 class="font-extrabold text-white text-base">App &amp; Software Developer</h3>
                            </div>
                            <p class="text-[11px] text-neutral-400 leading-relaxed">
                                Deep onyx charcoal (<code class="text-[#ff6b00]">#080808</code>), warm amber orange accents (<code class="text-[#ff6b00]">#ff6b00</code>), studio developer portrait with amber backlighting, [Services] brackets, and dark message module.
                            </p>
                        </div>
                        <div class="flex items-center gap-1.5 pt-2 border-t border-white/10">
                            <span class="w-4 h-4 rounded-full bg-[#080808] border border-white/20"></span>
                            <span class="w-4 h-4 rounded-full bg-[#ff6b00]"></span>
                            <span class="w-4 h-4 rounded-full bg-white"></span>
                            <span class="text-[10px] font-mono text-[#ff6b00] ml-auto">Amber Orange</span>
                        </div>
                    </label>

                    <!-- Option 6: Digital Designer & Illustrator Theme -->
                    <label class="relative cursor-pointer rounded-2xl p-5 border-2 transition-all flex flex-col justify-between space-y-4 {{ $currentTheme === 'digital_designer_illustrator' ? 'border-[#e26d9b] bg-[#1a141b] shadow-xl shadow-[#e26d9b]/25' : 'border-white/10 bg-black/40 hover:border-white/30' }}">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="w-3.5 h-3.5 rounded-full bg-[#e26d9b] border-2 border-[#1a141b] inline-block"></span>
                                <input type="radio" name="active_theme" value="digital_designer_illustrator"
                                    {{ $currentTheme === 'digital_designer_illustrator' ? 'checked' : '' }}
                                    class="text-[#e26d9b] focus:ring-0">
                            </div>
                            <div class="flex items-center gap-1.5">
                                <h3 class="font-extrabold text-white text-base">Digital Designer &amp; Illustrator</h3>
                            </div>
                            <p class="text-[11px] text-neutral-400 leading-relaxed">
                                Refined silver-stone backdrop (<code class="text-[#e26d9b]">#cfd3d8</code>), delicate botanical watercolor poppy accents (<code class="text-[#e26d9b]">#e26d9b</code>), 3D floating business cards, and editorial design showcase.
                            </p>
                        </div>
                        <div class="flex items-center gap-1.5 pt-2 border-t border-white/10">
                            <span class="w-4 h-4 rounded-full bg-[#cfd3d8] border border-white/20"></span>
                            <span class="w-4 h-4 rounded-full bg-[#e26d9b]"></span>
                            <span class="w-4 h-4 rounded-full bg-[#1f2127]"></span>
                            <span class="text-[10px] font-mono text-[#e26d9b] ml-auto">Rose Poppy &amp; Stone</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- THEME MODE MODULE (Dark, Light, System) -->
            <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 space-y-6 shadow-xl">
                <div class="border-b border-white/10 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <span class="text-xs font-mono font-bold text-amber-400 uppercase tracking-widest">Color Scheme Preference</span>
                        <h2 class="text-xl font-bold text-white mt-1">Theme Mode</h2>
                        <p class="text-xs text-slate-400">Configure how the active theme renders: strictly Dark, strictly Light, or automatically synced with the visitor's System preferences.</p>
                    </div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-300 text-[11px] font-mono">
                        <svg class="w-3.5 h-3.5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <span>Applies Across Website</span>
                    </div>
                </div>

                @php
                    $currentMode = $settings['theme_mode'] ?? 'system';
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Option 1: Dark Mode -->
                    <label class="relative cursor-pointer rounded-2xl p-5 border-2 transition-all flex flex-col justify-between space-y-4 {{ $currentMode === 'dark' ? 'border-amber-400 bg-[#16130d] shadow-xl shadow-amber-500/20' : 'border-white/10 bg-black/40 hover:border-white/30' }}">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="w-9 h-9 rounded-xl bg-slate-900 border border-white/20 flex items-center justify-center text-amber-400 shadow-inner">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                    </svg>
                                </div>
                                <input type="radio" name="theme_mode" value="dark" {{ $currentMode === 'dark' ? 'checked' : '' }} class="text-amber-400 focus:ring-0">
                            </div>
                            <div>
                                <h3 class="font-extrabold text-white text-base flex items-center gap-2">
                                    <span>Dark Mode</span>
                                    @if($currentMode === 'dark')
                                        <span class="px-2 py-0.5 rounded-full bg-amber-400/20 text-amber-300 text-[10px] font-mono">Active</span>
                                    @endif
                                </h3>
                                <p class="text-[11px] text-slate-400 leading-relaxed mt-1">
                                    Forces a deep, high-contrast dark aesthetic across all cards, typography, and backgrounds. Perfect for modern dev portfolios.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 pt-3 border-t border-white/10 text-[11px] font-mono text-slate-400">
                            <span class="w-3.5 h-3.5 rounded-full bg-[#0b0c10] border border-white/30 inline-block"></span>
                            <span>Dark Backgrounds</span>
                        </div>
                    </label>

                    <!-- Option 2: Light Mode -->
                    <label class="relative cursor-pointer rounded-2xl p-5 border-2 transition-all flex flex-col justify-between space-y-4 {{ $currentMode === 'light' ? 'border-amber-400 bg-[#16130d] shadow-xl shadow-amber-500/20' : 'border-white/10 bg-black/40 hover:border-white/30' }}">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="w-9 h-9 rounded-xl bg-amber-400/20 border border-amber-400/30 flex items-center justify-center text-amber-300 shadow-inner">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <input type="radio" name="theme_mode" value="light" {{ $currentMode === 'light' ? 'checked' : '' }} class="text-amber-400 focus:ring-0">
                            </div>
                            <div>
                                <h3 class="font-extrabold text-white text-base flex items-center gap-2">
                                    <span>Light Mode</span>
                                    @if($currentMode === 'light')
                                        <span class="px-2 py-0.5 rounded-full bg-amber-400/20 text-amber-300 text-[10px] font-mono">Active</span>
                                    @endif
                                </h3>
                                <p class="text-[11px] text-slate-400 leading-relaxed mt-1">
                                    Renders a bright, editorial light aesthetic with crisp dark typography, soft frosted panels, and refined border contrast.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 pt-3 border-t border-white/10 text-[11px] font-mono text-slate-400">
                            <span class="w-3.5 h-3.5 rounded-full bg-[#f1f5f9] border border-slate-300 inline-block"></span>
                            <span>Light Backgrounds</span>
                        </div>
                    </label>

                    <!-- Option 3: System Mode (Adaptive) -->
                    <label class="relative cursor-pointer rounded-2xl p-5 border-2 transition-all flex flex-col justify-between space-y-4 {{ $currentMode === 'system' ? 'border-amber-400 bg-[#16130d] shadow-xl shadow-amber-500/20' : 'border-white/10 bg-black/40 hover:border-white/30' }}">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="w-9 h-9 rounded-xl bg-indigo-500/20 border border-indigo-400/30 flex items-center justify-center text-indigo-300 shadow-inner">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="radio" name="theme_mode" value="system" {{ $currentMode === 'system' ? 'checked' : '' }} class="text-amber-400 focus:ring-0">
                            </div>
                            <div>
                                <h3 class="font-extrabold text-white text-base flex items-center gap-2">
                                    <span>System Default</span>
                                    @if($currentMode === 'system')
                                        <span class="px-2 py-0.5 rounded-full bg-amber-400/20 text-amber-300 text-[10px] font-mono">Active</span>
                                    @endif
                                </h3>
                                <p class="text-[11px] text-slate-400 leading-relaxed mt-1">
                                    Dynamically detects visitor's OS &amp; browser preference via <code class="text-amber-300">prefers-color-scheme</code>. Automatically updates in real-time.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 pt-3 border-t border-white/10 text-[11px] font-mono text-slate-400">
                            <span class="w-3.5 h-3.5 rounded-full bg-gradient-to-r from-[#0b0c10] to-[#f1f5f9] border border-white/30 inline-block"></span>
                            <span>Auto Synced</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Submit Bar matching previous design -->
            <div class="pt-4 flex items-center justify-end gap-3 sticky bottom-6 p-4 rounded-2xl bg-black/80 backdrop-blur-md border border-white/15 shadow-2xl">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl text-xs text-slate-400 hover:text-white transition-colors">Cancel</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg shadow-indigo-600/30 transition-all hover:scale-105">SAVE THEME</button>
            </div>
        </form>
    </div>
@endsection
