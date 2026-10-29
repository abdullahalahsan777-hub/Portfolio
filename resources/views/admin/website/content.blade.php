@extends('admin.layout')

@section('title', 'Hero & Main Elements — ' . ucfirst(str_replace('_', ' ', $selectedTheme)))
@section('page_title', 'Hero & Main Elements')
@section('page_subtitle', 'Table: theme_contents • Theme: ' . ucfirst(str_replace('_', ' ', $selectedTheme)))

@section('content')
    @php
        $themeDetails = \App\Models\SiteSetting::getThemeDetails($selectedTheme);
        $themeName = $themeDetails['name'] ?? ucfirst(str_replace('_', ' ', $selectedTheme));
        $themeColor = $themeDetails['color'] ?? '#6366f1';
    @endphp

    <div class="w-full space-y-8 pb-16">
        <!-- Header with Breadcrumb & Description -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-white flex items-center gap-3">
                    <span>Hero & Main Elements</span>
                    <span class="text-xs px-2.5 py-1 rounded-lg border font-mono font-bold"
                        style="border-color: {{ $themeColor }}40; color: {{ $themeColor }}; background-color: {{ $themeColor }}15;">
                        {{ $themeName }}
                    </span>
                </h1>
                <p class="text-xs text-slate-400 mt-1">
                    Customize every headline, paragraph, stat counter, and image asset for this portfolio theme. All changes
                    are saved isolated per theme into the <code
                        class="text-indigo-300 bg-black/40 px-1 py-0.5 rounded font-mono">theme_contents</code> database
                    table.
                </p>
            </div>

            <!-- Live Preview Button -->
            <a href="/?theme={{ $selectedTheme }}" target="_blank"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-white bg-slate-800 hover:bg-slate-700 border border-white/10 hover:border-white/20 transition-all shrink-0 shadow-md">
                <span>Live Preview</span>
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
            </a>
        </div>

        <!-- TOP THEME FILTER COMPONENT (Instant Theme Switcher) -->
        @include('admin.components.theme-filter', [
            'showGlobalOptions' => false,
            'elementName' => 'Content Fields',
        ])

        <!-- Notification Bar -->
        <div class="p-4 rounded-2xl border flex items-center justify-between gap-3 text-xs"
            style="background-color: {{ $themeColor }}10; border-color: {{ $themeColor }}30;">
            <div class="flex items-center gap-2.5">
                <span class="w-2.5 h-2.5 rounded-full animate-pulse shrink-0"
                    style="background-color: {{ $themeColor }};"></span>
                <span class="text-slate-200">
                    You are currently editing theme elements for <strong class="text-white">{{ $themeName }}</strong>.
                    Switch theme in the dropdown above to edit another theme.
                </span>
            </div>
            <span class="text-[11px] font-mono text-slate-400 shrink-0 hidden sm:inline">Theme Key: <code
                    class="text-white">{{ $selectedTheme }}</code></span>
        </div>

        <form action="{{ route('admin.website.content.update') }}" method="POST" enctype="multipart/form-data"
            class="space-y-8">
            @csrf
            <input type="hidden" name="theme" id="formCurrentTheme" value="{{ $selectedTheme }}">

            <!-- =========================================================================
                 SECTION 01: HERO SECTION & HEADLINES
                 ========================================================================= -->
            <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 space-y-6 shadow-xl">
                <div class="flex items-center justify-between pb-4 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <span
                            class="w-8 h-8 rounded-lg bg-indigo-600/20 text-indigo-400 flex items-center justify-center font-bold text-xs">01</span>
                        <div>
                            <h2 class="text-base font-bold text-white">Hero Header, Taglines & Main Portrait</h2>
                            <p class="text-xs text-slate-400">Controls the welcome intro, multi-line titles, action buttons,
                                and hero cutout image.</p>
                        </div>
                    </div>
                    <span
                        class="text-[10px] font-mono px-2 py-0.5 rounded bg-white/5 border border-white/10 text-slate-400">Section:
                        hero</span>
                </div>

                <div class="space-y-5">
                    <!-- Small Intro Tag -->
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Small Intro Tag / Status Pill</label>
                        <input type="text" name="hero_tag" value="{{ $contents['hero_tag'] ?? '' }}"
                            placeholder="e.g. // LEAD SOFTWARE ARCHITECT or 👋 Hi there, I'm William"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 font-sans">
                    </div>

                    <!-- 3 Title Lines -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Title Line 1</label>
                            <input type="text" name="hero_title_line1" value="{{ $contents['hero_title_line1'] ?? '' }}"
                                placeholder="e.g. IMAGINATION or Crafting"
                                class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 font-bold">
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Title Line 2 (Accent /
                                Highlight)</label>
                            <input type="text" name="hero_title_line2" value="{{ $contents['hero_title_line2'] ?? '' }}"
                                placeholder="e.g. IS MORE IMPORTANT or Intuitive Digital"
                                class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-[#f5b82e] font-bold text-sm focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Title Line 3</label>
                            <input type="text" name="hero_title_line3" value="{{ $contents['hero_title_line3'] ?? '' }}"
                                placeholder="e.g. THAN KNOWLEDGE or Experiences"
                                class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 font-bold">
                        </div>
                    </div>

                    <!-- Hero Subtitle / Description -->
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Hero Description / Bio Paragraph</label>
                        <textarea name="hero_description" rows="3"
                            placeholder="I build resilient web platforms, decoupled backend APIs, and enterprise cloud solutions..."
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 leading-relaxed">{{ $contents['hero_description'] ?? '' }}</textarea>
                    </div>

                    <!-- Hero Image Upload with Live Preview -->
                    <div class="p-5 rounded-2xl bg-black/30 border border-white/5 space-y-4">
                        <label class="block text-xs font-mono text-indigo-400 font-bold uppercase tracking-wider">Hero
                            Cutout / Portrait Image (Theme-Specific)</label>

                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                            <!-- Current Preview Box -->
                            <div
                                class="relative w-28 h-28 rounded-2xl bg-black/60 border border-white/15 overflow-hidden shrink-0 flex items-center justify-center group shadow-inner">
                                @if (!empty($contents['hero_image']))
                                    <img id="heroImagePreview"
                                        src="{{ str_starts_with($contents['hero_image'], 'http') ? $contents['hero_image'] : asset($contents['hero_image']) }}"
                                        alt="Hero Preview" class="w-full h-full object-cover">
                                @else
                                    <div id="heroImagePlaceholder"
                                        class="text-center p-2 text-slate-500 text-[10px] font-mono">No Image</div>
                                @endif
                            </div>

                            <!-- Upload & Path Controls -->
                            <div class="space-y-3 flex-1 w-full">
                                <div>
                                    <label class="block text-[11px] font-mono text-slate-400 mb-1">Upload New File (JPG,
                                        PNG, WebP, SVG)</label>
                                    <input type="file" name="hero_image_file" accept="image/*"
                                        onchange="previewImageFile(this, 'heroImagePreview', 'heroImagePlaceholder')"
                                        class="w-full text-xs text-slate-300 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 file:cursor-pointer cursor-pointer bg-black/40 rounded-xl p-1 border border-white/10">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-mono text-slate-400 mb-1">Or Direct Path / Remote
                                        URL</label>
                                    <input type="text" name="hero_image" value="{{ $contents['hero_image'] ?? '' }}"
                                        placeholder="images/themes/developer/hero_portrait.jpg"
                                        class="w-full px-3 py-1.5 rounded-lg bg-black/40 border border-white/10 text-slate-300 font-mono text-xs focus:outline-none focus:border-indigo-500">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons & Badges -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Primary Button Text</label>
                            <input type="text" name="hero_cta_text"
                                value="{{ $contents['hero_cta_text'] ?? 'GET STARTED' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-semibold">
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Primary Button URL</label>
                            <input type="text" name="hero_cta_url"
                                value="{{ $contents['hero_cta_url'] ?? '#contact' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-indigo-400 font-mono text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Secondary Button Text</label>
                            <input type="text" name="hero_cta2_text"
                                value="{{ $contents['hero_cta2_text'] ?? 'VIEW PROJECTS' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-semibold">
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Secondary Button URL</label>
                            <input type="text" name="hero_cta2_url"
                                value="{{ $contents['hero_cta2_url'] ?? '#portfolio' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-indigo-400 font-mono text-xs">
                        </div>
                    </div>

                    <!-- Floating Hero Badge / Pill (e.g. 10+ YRS EXP or Software Note) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-1">
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Hero Floating Badge Label
                                (Optional)</label>
                            <input type="text" name="hero_exp_badge"
                                value="{{ $contents['hero_exp_badge'] ?? ($contents['hero_software_text'] ?? '') }}"
                                placeholder="e.g. 10+ YRS EXP or +12 years with professional design software"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Marquee Ticker Banner (Theme
                                Ribbon)</label>
                            <input type="text" name="marquee_text" value="{{ $contents['marquee_text'] ?? '' }}"
                                placeholder="e.g. BRANDING ✺ UI/UX DESIGN ✺ APP DESIGN ✺ FULL STACK"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                        </div>
                    </div>
                </div>
            </div>

            <!-- =========================================================================
                 SECTION 02: ABOUT ME, PHILOSOPHY & MOSAIC MEDIA
                 ========================================================================= -->
            <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 space-y-6 shadow-xl">
                <div class="flex items-center justify-between pb-4 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <span
                            class="w-8 h-8 rounded-lg bg-indigo-600/20 text-indigo-400 flex items-center justify-center font-bold text-xs">02</span>
                        <div>
                            <h2 class="text-base font-bold text-white">About Me, Philosophy & Biography</h2>
                            <p class="text-xs text-slate-400">Biographical narrative, philosophy quotes, CV download
                                button, and about showcase images.</p>
                        </div>
                    </div>
                    <span
                        class="text-[10px] font-mono px-2 py-0.5 rounded bg-white/5 border border-white/10 text-slate-400">Section:
                        about</span>
                </div>

                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Section Tag</label>
                            <input type="text" name="about_tag" value="{{ $contents['about_tag'] ?? 'ABOUT ME' }}"
                                class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-mono text-slate-400 mb-1">About Headline</label>
                            <input type="text" name="about_heading" value="{{ $contents['about_heading'] ?? '' }}"
                                class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm font-bold">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Primary Biography Narrative</label>
                        <textarea name="about_description" rows="5" data-height="220"
                            class="summernote w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 leading-relaxed">{{ $contents['about_description'] ?? '' }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Extended Bio / Philosophy Details
                            (Secondary Paragraph)</label>
                        <textarea name="about_bio_extended" rows="2"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 leading-relaxed">{{ $contents['about_bio_extended'] ?? '' }}</textarea>
                    </div>

                    <!-- About Media / Images Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- About Image 1 -->
                        <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-3">
                            <label class="block text-xs font-mono text-indigo-400 font-bold uppercase">About Primary Image
                                / Video Poster</label>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-16 h-16 rounded-xl bg-black/60 border border-white/10 overflow-hidden shrink-0 flex items-center justify-center">
                                    @if (!empty($contents['about_image']))
                                        <img id="aboutImagePreview"
                                            src="{{ str_starts_with($contents['about_image'], 'http') ? $contents['about_image'] : asset($contents['about_image']) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <span id="aboutImagePlaceholder" class="text-[9px] text-slate-500 font-mono">No
                                            Image</span>
                                    @endif
                                </div>
                                <div class="space-y-1.5 flex-1">
                                    <input type="file" name="about_image_file" accept="image/*"
                                        onchange="previewImageFile(this, 'aboutImagePreview', 'aboutImagePlaceholder')"
                                        class="w-full text-[11px] text-slate-300 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 file:cursor-pointer cursor-pointer bg-black/40 rounded-lg p-1 border border-white/10">
                                    <input type="text" name="about_image"
                                        value="{{ $contents['about_image'] ?? '' }}"
                                        placeholder="images/themes/developer/workspace_video.jpg"
                                        class="w-full px-2.5 py-1 rounded bg-black/40 border border-white/10 text-[11px] text-slate-300 font-mono">
                                </div>
                            </div>
                        </div>

                        <!-- Video URL or CV Download Button -->
                        <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-3">
                            <label class="block text-xs font-mono text-indigo-400 font-bold uppercase">CV Download / Video
                                Play Link</label>
                            <div class="space-y-2">
                                <div>
                                    <label class="block text-[10px] font-mono text-slate-400">Button Label</label>
                                    <input type="text" name="about_cv_text"
                                        value="{{ $contents['about_cv_text'] ?? 'DOWNLOAD CV' }}"
                                        class="w-full px-3 py-1.5 rounded-lg bg-black/40 border border-white/10 text-white text-xs">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-mono text-slate-400">Target File / URL</label>
                                    <input type="text" name="about_cv_url"
                                        value="{{ $contents['about_cv_url'] ?? '#resume' }}"
                                        class="w-full px-3 py-1.5 rounded-lg bg-black/40 border border-white/10 text-indigo-400 font-mono text-xs">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Inspirational Quote (Lewis Carroll / Philosophy) -->
                    <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-3">
                        <label class="block text-xs font-mono text-[#f5b82e] font-bold uppercase">Inspirational Quote Block
                            (Featured in Editorial & Blayden)</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-[10px] font-mono text-slate-400 mb-1">Quote Text</label>
                                <textarea name="quote_text" rows="2"
                                    class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs italic font-serif leading-relaxed">{{ $contents['quote_text'] ?? '' }}</textarea>
                            </div>
                            <div>
                                <label class="block text-[10px] font-mono text-slate-400 mb-1">Author / Attribution</label>
                                <input type="text" name="quote_author" value="{{ $contents['quote_author'] ?? '' }}"
                                    class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- =========================================================================
                 SECTION 03: KEY STATISTICAL METRICS & ACHIEVEMENT COUNTERS
                 ========================================================================= -->
            <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 space-y-6 shadow-xl">
                <div class="flex items-center justify-between pb-4 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <span
                            class="w-8 h-8 rounded-lg bg-indigo-600/20 text-indigo-400 flex items-center justify-center font-bold text-xs">03</span>
                        <div>
                            <h2 class="text-base font-bold text-white">Achievement Statistics & Counter Metrics</h2>
                            <p class="text-xs text-slate-400">The 4 key quantitative achievements displayed prominently
                                across hero ribbons and about modules.</p>
                        </div>
                    </div>
                    <span
                        class="text-[10px] font-mono px-2 py-0.5 rounded bg-white/5 border border-white/10 text-slate-400">Section:
                        stats</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Stat 1: Experience -->
                    <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-2">
                        <label class="block text-xs font-mono text-indigo-400 font-bold uppercase">Stat 1:
                            Experience</label>
                        <input type="text" name="experience_years"
                            value="{{ $contents['experience_years'] ?? '10+' }}"
                            class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-sm font-bold font-mono">
                        <input type="text" name="experience_years_label"
                            value="{{ $contents['experience_years_label'] ?? 'Years Experience' }}"
                            placeholder="Label (e.g. Years Experience)"
                            class="w-full px-3 py-1.5 rounded-lg bg-black/40 border border-white/10 text-slate-300 text-xs">
                    </div>

                    <!-- Stat 2: Projects -->
                    <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-2">
                        <label class="block text-xs font-mono text-emerald-400 font-bold uppercase">Stat 2:
                            Projects</label>
                        <input type="text" name="completed_projects"
                            value="{{ $contents['completed_projects'] ?? '150+' }}"
                            class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-sm font-bold font-mono">
                        <input type="text" name="completed_projects_label"
                            value="{{ $contents['completed_projects_label'] ?? 'Projects Completed' }}"
                            placeholder="Label (e.g. Projects Completed)"
                            class="w-full px-3 py-1.5 rounded-lg bg-black/40 border border-white/10 text-slate-300 text-xs">
                    </div>

                    <!-- Stat 3: Satisfied Clients -->
                    <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-2">
                        <label class="block text-xs font-mono text-amber-400 font-bold uppercase">Stat 3: Happy
                            Clients</label>
                        <input type="text" name="satisfied_clients"
                            value="{{ $contents['satisfied_clients'] ?? '99+' }}"
                            class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-sm font-bold font-mono">
                        <input type="text" name="satisfied_clients_label"
                            value="{{ $contents['satisfied_clients_label'] ?? 'Happy Clients' }}"
                            placeholder="Label (e.g. Happy Clients)"
                            class="w-full px-3 py-1.5 rounded-lg bg-black/40 border border-white/10 text-slate-300 text-xs">
                    </div>

                    <!-- Stat 4: Awards / Honors -->
                    <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-2">
                        <label class="block text-xs font-mono text-purple-400 font-bold uppercase">Stat 4: Awards /
                            Honors</label>
                        <input type="text" name="awards_count" value="{{ $contents['awards_count'] ?? '18+' }}"
                            class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-sm font-bold font-mono">
                        <input type="text" name="awards_count_label"
                            value="{{ $contents['awards_count_label'] ?? 'Awards Received' }}"
                            placeholder="Label (e.g. Awards Received)"
                            class="w-full px-3 py-1.5 rounded-lg bg-black/40 border border-white/10 text-slate-300 text-xs">
                    </div>
                </div>
            </div>

            <!-- =========================================================================
                 SECTION 04: SECTION HEADINGS, SUBTITLES & BUTTON LABELS
                 ========================================================================= -->
            <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 space-y-6 shadow-xl">
                <div class="flex items-center justify-between pb-4 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <span
                            class="w-8 h-8 rounded-lg bg-indigo-600/20 text-indigo-400 flex items-center justify-center font-bold text-xs">04</span>
                        <div>
                            <h2 class="text-base font-bold text-white">Section Headings & Action Buttons</h2>
                            <p class="text-xs text-slate-400">Headings, category pills, and call-to-action buttons for
                                Services, Portfolio, Resume, Skills, and Blog.</p>
                        </div>
                    </div>
                    <span
                        class="text-[10px] font-mono px-2 py-0.5 rounded bg-white/5 border border-white/10 text-slate-400">Section:
                        headings</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Services Headings -->
                    <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-3">
                        <span class="text-xs font-mono font-bold uppercase text-indigo-400">Services Module</span>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Section Title</label>
                            <input type="text" name="services_title" value="{{ $contents['services_title'] ?? '' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-bold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Subtitle / Description</label>
                            <input type="text" name="services_subtitle"
                                value="{{ $contents['services_subtitle'] ?? '' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-slate-300 text-xs">
                        </div>
                    </div>

                    <!-- Portfolio Headings -->
                    <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-3">
                        <span class="text-xs font-mono font-bold uppercase text-indigo-400">Portfolio & Works Module</span>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Section Title</label>
                            <input type="text" name="portfolio_title"
                                value="{{ $contents['portfolio_title'] ?? '' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-bold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Subtitle / Description</label>
                            <input type="text" name="portfolio_subtitle"
                                value="{{ $contents['portfolio_subtitle'] ?? '' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-slate-300 text-xs">
                        </div>
                    </div>

                    <!-- Resume & Experience Headings -->
                    <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-3">
                        <span class="text-xs font-mono font-bold uppercase text-indigo-400">Resume & Career Module</span>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Section Title</label>
                            <input type="text" name="resume_title" value="{{ $contents['resume_title'] ?? '' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-bold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Subtitle / Description</label>
                            <input type="text" name="resume_subtitle"
                                value="{{ $contents['resume_subtitle'] ?? '' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-slate-300 text-xs">
                        </div>
                    </div>

                    <!-- Skills & Tools Headings -->
                    <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-3">
                        <span class="text-xs font-mono font-bold uppercase text-indigo-400">Skills & Technology
                            Module</span>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Section Title</label>
                            <input type="text" name="skills_title" value="{{ $contents['skills_title'] ?? '' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-bold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Subtitle / Additional
                                Note</label>
                            <input type="text" name="skills_subtitle"
                                value="{{ $contents['skills_subtitle'] ?? ($contents['skills_footer_note'] ?? '') }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-slate-300 text-xs">
                        </div>
                    </div>

                    <!-- Testimonials Headings -->
                    <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-3">
                        <span class="text-xs font-mono font-bold uppercase text-indigo-400">Client Testimonials
                            Module</span>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Section Title</label>
                            <input type="text" name="testimonials_title"
                                value="{{ $contents['testimonials_title'] ?? '' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-bold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Subtitle / Description</label>
                            <input type="text" name="testimonials_subtitle"
                                value="{{ $contents['testimonials_subtitle'] ?? '' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-slate-300 text-xs">
                        </div>
                    </div>

                    <!-- Pricing Plans Headings -->
                    <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-3">
                        <span class="text-xs font-mono font-bold uppercase text-indigo-400">Pricing & Packages
                            Module</span>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Section Title</label>
                            <input type="text" name="pricing_title" value="{{ $contents['pricing_title'] ?? '' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-bold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Subtitle / Description</label>
                            <input type="text" name="pricing_subtitle"
                                value="{{ $contents['pricing_subtitle'] ?? '' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-slate-300 text-xs">
                        </div>
                    </div>

                    <!-- Blog Headings -->
                    <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-3">
                        <span class="text-xs font-mono font-bold uppercase text-indigo-400">Articles & Blog Module</span>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Section Title</label>
                            <input type="text" name="blog_title" value="{{ $contents['blog_title'] ?? '' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-bold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Subtitle / Description</label>
                            <input type="text" name="blog_subtitle" value="{{ $contents['blog_subtitle'] ?? '' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-slate-300 text-xs">
                        </div>
                    </div>

                    <!-- FAQs Headings (e.g. for App Developer) -->
                    <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-3">
                        <span class="text-xs font-mono font-bold uppercase text-indigo-400">Frequently Asked
                            Questions</span>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Section Title</label>
                            <input type="text" name="faq_title"
                                value="{{ $contents['faq_title'] ?? 'HAVE ANY QUESTIONS?' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-bold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-mono text-slate-400 mb-1">Subtitle / Category Tag</label>
                            <input type="text" name="faq_tag" value="{{ $contents['faq_tag'] ?? 'FAQ' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-slate-300 text-xs">
                        </div>
                    </div>
                </div>
            </div>

            <!-- =========================================================================
                 SECTION 05: CONTACT, LOCATION & FOOTER COPYRIGHT
                 ========================================================================= -->
            <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 space-y-6 shadow-xl">
                <div class="flex items-center justify-between pb-4 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <span
                            class="w-8 h-8 rounded-lg bg-indigo-600/20 text-indigo-400 flex items-center justify-center font-bold text-xs">05</span>
                        <div>
                            <h2 class="text-base font-bold text-white">Contact Info & Footer Details</h2>
                            <p class="text-xs text-slate-400">Direct communication details, address, and copyright text for
                                this portfolio theme.</p>
                        </div>
                    </div>
                    <span
                        class="text-[10px] font-mono px-2 py-0.5 rounded bg-white/5 border border-white/10 text-slate-400">Section:
                        contact</span>
                </div>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Contact Heading</label>
                            <input type="text" name="contact_title" value="{{ $contents['contact_title'] ?? '' }}"
                                class="w-full px-4 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-bold">
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Contact Subtitle</label>
                            <input type="text" name="contact_subtitle"
                                value="{{ $contents['contact_subtitle'] ?? '' }}"
                                class="w-full px-4 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Contact Email</label>
                            <input type="email" name="contact_email" value="{{ $contents['contact_email'] ?? '' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono">
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Contact Phone</label>
                            <input type="text" name="contact_phone" value="{{ $contents['contact_phone'] ?? '' }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono">
                        </div>
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1">Office / Location Address</label>
                            <input type="text" name="contact_address"
                                value="{{ $contents['contact_address'] ?? ($contents['contact_location'] ?? '') }}"
                                class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Footer Copyright Notice</label>
                        <input type="text" name="copyright_text" value="{{ $contents['copyright_text'] ?? '' }}"
                            placeholder="e.g. © 2024 William.design. All rights reserved."
                            class="w-full px-4 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                    </div>
                </div>
            </div>

            <!-- Sticky Floating Save Bar -->
            <div
                class="sticky bottom-6 z-40 p-4 rounded-2xl bg-black/90 backdrop-blur-xl border border-white/20 shadow-2xl flex items-center justify-between gap-4">
                <div class="flex items-center gap-2.5 text-xs text-slate-300">
                    <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $themeColor }};"></span>
                    <span>Saving to <strong class="text-white">theme_contents</strong> for <strong
                            class="text-indigo-400">{{ $themeName }}</strong></span>
                </div>

                <button type="submit"
                    class="px-8 py-3 rounded-xl font-extrabold text-xs uppercase tracking-wider text-white shadow-xl transition-all hover:scale-105 active:scale-95 flex items-center gap-2"
                    style="background: linear-gradient(135deg, {{ $themeColor }}, #4f46e5);">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Save All {{ $themeName }} Elements</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Live Image Preview Script -->
    <script>
        function previewImageFile(input, previewImgId, placeholderId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById(previewImgId);
                    const placeholder = document.getElementById(placeholderId);
                    if (img) {
                        img.src = e.target.result;
                        img.classList.remove('hidden');
                    }
                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
