@php
    $themeDetails = \App\Models\SiteSetting::getThemeDetails($selectedTheme ?? 'developer');
    $themeColor = $themeDetails['color'] ?? '#00ff88';
    $themeName = $themeDetails['name'] ?? ucfirst(str_replace('_', ' ', $selectedTheme ?? 'developer'));

    // Section Icon & Theme Metadata Mapping
    $secLower = strtolower($sectionKey ?? '');
    $sectionMetaMap = [
        'stats' => ['icon' => 'metrics', 'badge' => 'Statistics & Highlights', 'accent' => '#10b981'],
        'metrics' => ['icon' => 'metrics', 'badge' => 'Key Metrics & Deliverables', 'accent' => '#10b981'],
        'about' => ['icon' => 'user', 'badge' => 'Biography & Narrative', 'accent' => '#6366f1'],
        'narrative' => ['icon' => 'user', 'badge' => 'Editorial Story', 'accent' => '#6366f1'],
        'philosophy' => ['icon' => 'quote', 'badge' => 'Philosophy & Vision', 'accent' => '#f59e0b'],
        'contact' => ['icon' => 'mail', 'badge' => 'Channels & Engagement', 'accent' => '#06b6d4'],
        'channels' => ['icon' => 'mail', 'badge' => 'Direct Channels', 'accent' => '#06b6d4'],
        'services' => ['icon' => 'sparkles', 'badge' => 'Services & Offerings', 'accent' => '#a855f7'],
        'portfolio' => ['icon' => 'briefcase', 'badge' => 'Featured Works & Studies', 'accent' => '#3b82f6'],
        'projects' => ['icon' => 'briefcase', 'badge' => 'Project Showcase', 'accent' => '#3b82f6'],
        'grid' => ['icon' => 'grid', 'badge' => 'Portfolio Grid', 'accent' => '#3b82f6'],
        'hero' => ['icon' => 'rocket', 'badge' => 'Hero Banner & Intro', 'accent' => '#f43f5e'],
        'skills' => ['icon' => 'code', 'badge' => 'Skills & Capabilities', 'accent' => '#10b981'],
        'testimonials' => ['icon' => 'quote', 'badge' => 'Client Endorsements', 'accent' => '#ec4899'],
        'pricing' => ['icon' => 'tag', 'badge' => 'Packages & Rates', 'accent' => '#eab308'],
        'blog' => ['icon' => 'book', 'badge' => 'Articles & Insights', 'accent' => '#6366f1'],
        'faq' => ['icon' => 'help', 'badge' => 'Frequently Asked Questions', 'accent' => '#8b5cf6'],
        'footer' => ['icon' => 'globe', 'badge' => 'Global Footer Notice', 'accent' => '#64748b'],
    ];

    $matchedMeta = $sectionMetaMap[$secLower] ?? [
        'icon' => 'cube',
        'badge' => 'Dynamic Content Elements',
        'accent' => $themeColor,
    ];
@endphp

<!-- Scoped Summernote Dark Theme & Element Polish -->
<style>
    .summernote-wrapper .note-editor.note-frame {
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        border-radius: 14px !important;
        overflow: hidden !important;
        background: #060b14 !important;
    }
    .summernote-wrapper .note-toolbar {
        background: #09101d !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        padding: 8px 10px !important;
    }
    .summernote-wrapper .note-btn {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #e2e8f0 !important;
        border-radius: 8px !important;
        padding: 4px 8px !important;
        font-size: 12px !important;
        transition: all 0.15s ease !important;
    }
    .summernote-wrapper .note-btn:hover,
    .summernote-wrapper .note-btn.active {
        background: rgba(255, 255, 255, 0.15) !important;
        border-color: rgba(255, 255, 255, 0.25) !important;
        color: #ffffff !important;
    }
    .summernote-wrapper .note-editable {
        background: #060b14 !important;
        color: #f1f5f9 !important;
        min-height: 140px !important;
        padding: 14px 16px !important;
        font-size: 13px !important;
        line-height: 1.6 !important;
    }
    .summernote-wrapper .note-statusbar {
        background: #09101d !important;
        border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
    }
    .summernote-wrapper .note-resizebar .note-icon-bar {
        border-top-color: rgba(255, 255, 255, 0.2) !important;
    }
    .summernote-wrapper .note-dropdown-menu {
        background: #09101d !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        border-radius: 12px !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7) !important;
        padding: 6px !important;
    }
    .summernote-wrapper .note-dropdown-item {
        color: #cbd5e1 !important;
        border-radius: 6px !important;
        padding: 6px 10px !important;
        font-size: 12px !important;
    }
    .summernote-wrapper .note-dropdown-item:hover {
        background: rgba(255, 255, 255, 0.08) !important;
        color: #ffffff !important;
    }
</style>

<!-- =========================================================================
     DYNAMIC SECTION: {{ strtoupper($sectionTitle ?? $sectionKey) }}
     ========================================================================= -->
<div class="rounded-3xl bg-[#09101d] border border-white/10 shadow-2xl overflow-hidden transition-all duration-300 hover:border-white/15">
    <!-- Top Accent Gradient Line -->
    <div class="h-1 w-full" style="background: linear-gradient(90deg, {{ $themeColor }}, #6366f1, #ec4899);"></div>

    <!-- Section Card Header -->
    <div class="p-5 sm:p-6 border-b border-white/10 bg-white/[0.015] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5 min-w-0">
            <!-- Dynamic Section Category Icon Badge -->
            <span class="w-10 h-10 rounded-2xl flex items-center justify-center font-bold text-sm shadow-lg shrink-0"
                style="background: {{ $themeColor }}20; color: {{ $themeColor }}; border: 1px solid {{ $themeColor }}40;">
                @if($matchedMeta['icon'] === 'metrics')
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                @elseif($matchedMeta['icon'] === 'user')
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                @elseif($matchedMeta['icon'] === 'mail')
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                @elseif($matchedMeta['icon'] === 'sparkles')
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                @elseif($matchedMeta['icon'] === 'briefcase')
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                @elseif($matchedMeta['icon'] === 'rocket')
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                @elseif($matchedMeta['icon'] === 'code')
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                @elseif($matchedMeta['icon'] === 'quote')
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                @else
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                @endif
            </span>

            <div class="min-w-0">
                <div class="flex items-center flex-wrap gap-2">
                    <h2 class="text-base sm:text-lg font-bold text-white tracking-tight">{{ $sectionTitle }}</h2>
                    <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-300 font-bold shrink-0">
                        Section: {{ $sectionKey }}
                    </span>
                    <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-indigo-500/10 border border-indigo-500/30 text-indigo-300 font-bold shrink-0 flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                        {{ count($rows ?? []) }} elements
                    </span>
                    <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400 hidden sm:inline">
                        {{ $matchedMeta['badge'] }}
                    </span>
                </div>
                <p class="text-xs text-slate-400 mt-0.5 truncate">
                    Manage dynamic content elements for the <strong class="text-white">{{ $sectionTitle }}</strong> section from database table <code class="text-indigo-300 bg-black/40 px-1 py-0.5 rounded font-mono">theme_contents</code>.
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2 shrink-0 self-end sm:self-auto">
            <span class="text-[11px] font-mono px-2.5 py-1 rounded-xl bg-white/[0.03] border border-white/10 text-slate-400">
                Theme: <strong class="text-white">{{ $themeName }}</strong>
            </span>
        </div>
    </div>

    <!-- Edit Form -->
    <form action="{{ route('admin.pages.update') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-7 space-y-6">
        @csrf
        <input type="hidden" name="theme" value="{{ $selectedTheme }}">
        <input type="hidden" name="page" value="{{ $pageSlug }}">
        <input type="hidden" name="section" value="{{ $sectionKey }}">
        <input type="hidden" name="section_name" value="{{ $sectionTitle }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @foreach($rows as $item)
                @php
                    $key = $item->key;
                    $val = $contents[$key] ?? $item->value;
                    $type = $item->type ?? 'text';
                    $label = ucwords(str_replace(['_', '-'], ' ', $key));
                    $lowerKey = strtolower($key);
                    $valStr = (string)$val;

                    // Image / Media Detection
                    $isImage = ($type === 'image') || 
                               str_contains($lowerKey, 'image') || 
                               str_contains($lowerKey, 'avatar') || 
                               str_contains($lowerKey, 'banner') || 
                               str_contains($lowerKey, 'artwork') || 
                               str_contains($lowerKey, 'photo') || 
                               str_contains($lowerKey, 'portrait') || 
                               str_contains($lowerKey, 'logo') || 
                               str_contains($lowerKey, 'thumbnail') || 
                               str_contains($lowerKey, 'bg');

                    // Metric / Counter Detection (Addresses red box in Screenshot 1)
                    $isCounter = !$isImage && (
                        $type === 'number' || 
                        str_contains($lowerKey, 'count') || 
                        str_contains($lowerKey, 'stat') || 
                        str_contains($lowerKey, 'years') || 
                        str_contains($lowerKey, 'clients') || 
                        str_contains($lowerKey, 'projects') || 
                        str_contains($lowerKey, 'awards') || 
                        str_contains($lowerKey, 'metric') || 
                        (strlen($valStr) > 0 && strlen($valStr) <= 8 && preg_match('/^[0-9]+[+\%kKmM\s]?$/', trim($valStr)))
                    );

                    // Tag / Pill Badge Detection (Screenshot 2, 3, 5)
                    $isTagOrBadge = !$isImage && !$isCounter && (
                        str_contains($lowerKey, 'tag') || 
                        str_contains($lowerKey, 'badge') || 
                        str_contains($lowerKey, 'pill') || 
                        str_starts_with(trim($valStr), '//')
                    );

                    // URL / External Link Detection (Screenshot 5)
                    $isUrl = !$isImage && !$isCounter && !$isTagOrBadge && (
                        $type === 'url' || 
                        str_contains($lowerKey, 'url') || 
                        str_contains($lowerKey, 'link') || 
                        str_contains($lowerKey, 'href') || 
                        str_starts_with(trim($valStr), 'http://') || 
                        str_starts_with(trim($valStr), 'https://')
                    );

                    // Button / CTA Text Detection (Screenshot 5)
                    $isButtonText = !$isImage && !$isCounter && !$isTagOrBadge && !$isUrl && (
                        str_contains($lowerKey, 'btn_text') || 
                        str_contains($lowerKey, 'cta_text') || 
                        str_contains($lowerKey, 'button')
                    );

                    // Location / Address / Direct Contact Info (Screenshot 3)
                    $isLocationOrContact = !$isImage && !$isCounter && !$isTagOrBadge && !$isUrl && !$isButtonText && (
                        str_contains($lowerKey, 'location') || 
                        str_contains($lowerKey, 'address') || 
                        str_contains($lowerKey, 'phone') || 
                        str_contains($lowerKey, 'tel') || 
                        str_contains($lowerKey, 'email')
                    );

                    // Rich Text / WYSIWYG Summernote Detection
                    $isSummernote = !$isImage && (
                        $type === 'rich_text' ||
                        str_contains($lowerKey, 'narrative') ||
                        str_contains($lowerKey, 'description') ||
                        str_contains($lowerKey, 'bio') ||
                        str_contains($lowerKey, 'body') ||
                        str_contains($lowerKey, 'content') ||
                        strlen($valStr) > 130
                    );

                    // Standard Multi-line Textarea Detection
                    $isTextarea = !$isImage && !$isSummernote && (
                        $type === 'textarea' || 
                        strlen($valStr) > 65 || 
                        str_contains($lowerKey, 'subtitle') || 
                        str_contains($lowerKey, 'quote') || 
                        str_contains($lowerKey, 'lead') || 
                        str_contains($lowerKey, 'details') || 
                        str_contains($lowerKey, 'notice')
                    );
                @endphp

                @if($isImage)
                    {{-- =========================================================================
                         1. PREMIUM MEDIA & IMAGE CARD
                         ========================================================================= --}}
                    <div class="md:col-span-2 p-5 sm:p-6 rounded-2xl bg-gradient-to-br from-white/[0.03] to-black/40 border border-white/10 hover:border-white/20 transition-all space-y-4 shadow-lg">
                        <div class="flex items-center justify-between pb-3 border-b border-white/5">
                            <div class="flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-pink-500/10 border border-pink-500/30 text-pink-400 flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <div>
                                    <label class="block text-xs font-mono font-bold text-white uppercase tracking-wider">
                                        {{ $label }}
                                    </label>
                                    <span class="text-[10px] text-slate-400 font-mono">Media Asset & Live Preview</span>
                                </div>
                            </div>
                            <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400">
                                {{ $key }}
                            </span>
                        </div>

                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                            <!-- Preview Frame -->
                            <div class="relative group/preview w-24 h-24 sm:w-28 sm:h-28 rounded-2xl overflow-hidden border border-white/20 bg-black/70 shrink-0 shadow-2xl flex items-center justify-center p-1.5">
                                @if(!empty($val) && file_exists(public_path($val)))
                                    <img src="{{ asset($val) }}" alt="{{ $label }}" class="w-full h-full object-cover rounded-xl transition-transform duration-300 group-hover/preview:scale-110">
                                    <a href="{{ asset($val) }}" target="_blank" class="absolute inset-0 bg-black/60 opacity-0 group-hover/preview:opacity-100 flex items-center justify-center text-white text-xs font-mono font-bold transition-opacity">
                                        View &nearr;
                                    </a>
                                @elseif(!empty($val))
                                    <img src="{{ asset($val) }}" alt="{{ $label }}" class="w-full h-full object-cover rounded-xl transition-transform duration-300 group-hover/preview:scale-110" onerror="this.parentElement.innerHTML='<div class=\'text-center p-2\'><span class=\'text-[10px] text-slate-500 font-mono block\'>Not Found</span></div>'">
                                    <a href="{{ asset($val) }}" target="_blank" class="absolute inset-0 bg-black/60 opacity-0 group-hover/preview:opacity-100 flex items-center justify-center text-white text-xs font-mono font-bold transition-opacity">
                                        View &nearr;
                                    </a>
                                @else
                                    <div class="w-full h-full rounded-xl border border-dashed border-white/20 bg-white/[0.02] flex flex-col items-center justify-center text-slate-500 text-[10px] font-mono gap-1">
                                        <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>No Image</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Controls: File Picker + Relative Path -->
                            <div class="flex-1 w-full space-y-3">
                                <div>
                                    <label class="block text-[11px] font-mono text-slate-400 mb-1.5 flex items-center justify-between">
                                        <span>Upload New File</span>
                                        <span class="text-[10px] text-slate-500">Formats: PNG, JPG, WEBP, SVG</span>
                                    </label>
                                    <div class="relative">
                                        <input type="file" name="{{ $key }}_file" accept="image/*"
                                            class="w-full text-xs text-slate-300 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border file:border-white/10 file:text-xs file:font-bold file:bg-white/10 file:text-white hover:file:bg-white/20 file:cursor-pointer cursor-pointer bg-[#060b14] border border-white/15 rounded-xl p-1.5">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[11px] font-mono text-slate-400 mb-1.5">Asset Path (Relative to public/)</label>
                                    <div class="flex items-center rounded-xl bg-[#060b14] border border-white/15 focus-within:border-indigo-400 transition-all px-3 py-1.5 shadow-inner">
                                        <span class="text-slate-500 font-mono text-xs mr-2">/</span>
                                        <input type="text" name="{{ $key }}" value="{{ $val }}"
                                            placeholder="e.g. images/templates/uiux_designer.png"
                                            class="w-full px-1 text-xs font-mono text-white placeholder:text-slate-600 bg-transparent border-0 focus:outline-none focus:ring-0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($isCounter)
                    {{-- =========================================================================
                         2. EXECUTIVE METRIC / STAT COUNTER CARD (Directly solves Screenshot 1)
                         ========================================================================= --}}
                    <div class="p-5 sm:p-6 rounded-2xl bg-gradient-to-br from-white/[0.04] via-black/40 to-black/60 border border-white/10 hover:border-white/20 transition-all duration-300 relative group overflow-hidden shadow-lg space-y-4">
                        <!-- Top Accent Line inside the card -->
                        <div class="h-0.5 w-16 absolute top-0 left-6 rounded-full" style="background-color: {{ $themeColor }};"></div>

                        <!-- Card Header -->
                        <div class="flex items-center justify-between pb-3.5 border-b border-white/5">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0 shadow-md"
                                    style="background: {{ $themeColor }}15; color: {{ $themeColor }}; border: 1px solid {{ $themeColor }}35;">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </span>
                                <div>
                                    <label class="block text-xs font-mono font-bold text-white uppercase tracking-wider">
                                        {{ $label }}
                                    </label>
                                    <span class="text-[10px] text-slate-400 font-mono">Metric KPI Counter</span>
                                </div>
                            </div>
                            <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400">
                                {{ $key }}
                            </span>
                        </div>

                        <!-- Big Number Input Box -->
                        <div class="relative flex items-center rounded-2xl bg-[#060b14] border border-white/15 focus-within:border-emerald-400 focus-within:ring-2 focus-within:ring-emerald-400/20 transition-all px-4 py-3 shadow-inner">
                            <input type="text" name="{{ $key }}" value="{{ $val }}"
                                placeholder="e.g. 9+, 80+, 150k"
                                class="w-full text-2xl sm:text-3xl font-black font-mono tracking-tight text-white placeholder:text-slate-600 bg-transparent border-0 focus:outline-none focus:ring-0">
                            <div class="flex items-center gap-2 shrink-0">
                                <span class="px-2.5 py-1 rounded-lg text-[10px] font-mono font-bold uppercase tracking-wider bg-white/5 border border-white/10 text-slate-300">
                                    Counter
                                </span>
                            </div>
                        </div>
                        <p class="text-[11px] text-slate-400 font-sans flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Displayed prominently as a key metric milestone on the live page</span>
                        </p>
                    </div>

                @elseif($isSummernote)
                    {{-- =========================================================================
                         3. VISUAL WYSIWYG SUMMERNOTE EDITOR (Screenshots 2, 4, 5)
                         ========================================================================= --}}
                    <div class="md:col-span-2 p-5 sm:p-6 rounded-2xl bg-white/[0.02] border border-white/10 hover:border-white/20 transition-all space-y-3.5 shadow-lg">
                        <div class="flex items-center justify-between pb-3 border-b border-white/5">
                            <div class="flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-indigo-500/10 border border-indigo-500/30 text-indigo-400 flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </span>
                                <div>
                                    <label class="block text-xs font-mono font-bold text-white uppercase tracking-wider">
                                        {{ $label }}
                                    </label>
                                    <span class="text-[10px] text-slate-400 font-mono">Visual WYSIWYG Content Editor</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-indigo-500/15 border border-indigo-500/30 text-indigo-300 font-bold">
                                    Rich Text
                                </span>
                                <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400">
                                    {{ $key }}
                                </span>
                            </div>
                        </div>

                        <div class="summernote-wrapper rounded-2xl overflow-hidden border border-white/15 shadow-inner">
                            <textarea name="{{ $key }}" rows="5" class="summernote w-full">{{ $val }}</textarea>
                        </div>
                    </div>

                @elseif($isTextarea)
                    {{-- =========================================================================
                         4. POLISHED MULTI-LINE TEXTAREA (Screenshot 3)
                         ========================================================================= --}}
                    <div class="md:col-span-2 p-5 rounded-2xl bg-white/[0.02] border border-white/10 hover:border-white/20 transition-all space-y-3 shadow-lg">
                        <div class="flex items-center justify-between pb-2.5 border-b border-white/5">
                            <div class="flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h11" />
                                    </svg>
                                </span>
                                <div>
                                    <label class="block text-xs font-mono font-bold text-white uppercase tracking-wider">
                                        {{ $label }}
                                    </label>
                                    <span class="text-[10px] text-slate-400 font-mono">Multi-line Paragraph Text</span>
                                </div>
                            </div>
                            <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400">
                                {{ $key }}
                            </span>
                        </div>

                        <div class="rounded-2xl overflow-hidden border border-white/15 focus-within:border-cyan-400 focus-within:ring-2 focus-within:ring-cyan-400/20 transition-all shadow-inner bg-[#060b14]">
                            <textarea name="{{ $key }}" rows="3"
                                placeholder="Enter {{ strtolower($label) }}..."
                                class="w-full p-4 text-xs sm:text-sm text-slate-100 placeholder:text-slate-600 bg-transparent border-0 focus:outline-none focus:ring-0 leading-relaxed resize-y min-h-[85px]">{{ $val }}</textarea>
                        </div>
                    </div>

                @elseif($isTagOrBadge)
                    {{-- =========================================================================
                         5. TAG & PILL BADGE COMPONENT (Screenshots 2, 3, 5)
                         ========================================================================= --}}
                    <div class="p-4 sm:p-5 rounded-2xl bg-white/[0.02] border border-white/10 hover:border-white/20 transition-all space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 flex items-center justify-center font-mono font-bold text-xs shrink-0 select-none">#</span>
                                <label class="block text-xs font-mono font-bold text-slate-200 uppercase tracking-wider">
                                    {{ $label }}
                                </label>
                            </div>
                            <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400">
                                {{ $key }}
                            </span>
                        </div>

                        <div class="flex items-center rounded-xl bg-[#060b14] border border-white/15 focus-within:border-emerald-400 focus-within:ring-2 focus-within:ring-emerald-400/20 transition-all px-3 py-1.5 shadow-inner gap-2">
                            <span class="px-2 py-0.5 rounded font-mono font-bold text-xs text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 shrink-0 select-none">//</span>
                            <input type="text" name="{{ $key }}" value="{{ $val }}"
                                placeholder="e.g. // PRODUCT DESIGN CRAFT"
                                class="w-full text-xs sm:text-sm font-mono font-bold text-white placeholder:text-slate-600 bg-transparent border-0 focus:outline-none focus:ring-0">
                        </div>
                    </div>

                @elseif($isUrl)
                    {{-- =========================================================================
                         6. URL & EXTERNAL LINK COMPONENT (Screenshot 5)
                         ========================================================================= --}}
                    <div class="p-4 sm:p-5 rounded-2xl bg-white/[0.02] border border-white/10 hover:border-white/20 transition-all space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-indigo-500/10 border border-indigo-500/30 text-indigo-400 flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                </span>
                                <label class="block text-xs font-mono font-bold text-slate-200 uppercase tracking-wider">
                                    {{ $label }}
                                </label>
                            </div>
                            <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400">
                                {{ $key }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between rounded-xl bg-[#060b14] border border-white/15 focus-within:border-indigo-400 focus-within:ring-2 focus-within:ring-indigo-400/20 transition-all px-3 py-1.5 shadow-inner gap-2">
                            <span class="px-2 py-0.5 rounded font-mono text-[11px] text-indigo-300 bg-indigo-500/10 border border-indigo-500/20 shrink-0 select-none">https://</span>
                            <input type="text" name="{{ $key }}" value="{{ $val }}"
                                placeholder="e.g. https://figma.com"
                                class="w-full text-xs font-mono text-indigo-200 placeholder:text-slate-600 bg-transparent border-0 focus:outline-none focus:ring-0">
                            @if(!empty($val) && (str_starts_with($val, 'http://') || str_starts_with($val, 'https://')))
                                <a href="{{ $val }}" target="_blank" rel="noopener noreferrer"
                                    class="px-2 py-1 rounded-lg text-[10px] font-mono font-bold text-slate-300 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition-colors flex items-center gap-1 shrink-0"
                                    title="Test link in new window">
                                    <span>Open</span>
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>

                @elseif($isButtonText)
                    {{-- =========================================================================
                         7. BUTTON / CTA TEXT COMPONENT (Screenshot 5)
                         ========================================================================= --}}
                    <div class="p-4 sm:p-5 rounded-2xl bg-white/[0.02] border border-white/10 hover:border-white/20 transition-all space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-purple-500/10 border border-purple-500/30 text-purple-400 flex items-center justify-center shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                                    </svg>
                                </span>
                                <label class="block text-xs font-mono font-bold text-slate-200 uppercase tracking-wider">
                                    {{ $label }}
                                </label>
                            </div>
                            <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400">
                                {{ $key }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between rounded-xl bg-[#060b14] border border-white/15 focus-within:border-purple-400 focus-within:ring-2 focus-within:ring-purple-400/20 transition-all px-3.5 py-2 shadow-inner gap-3">
                            <input type="text" name="{{ $key }}" value="{{ $val }}"
                                placeholder="e.g. EXPLORE CASE STUDY"
                                class="w-full text-xs sm:text-sm font-bold uppercase tracking-wider text-white placeholder:text-slate-600 bg-transparent border-0 focus:outline-none focus:ring-0">
                            <span class="hidden sm:inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider text-slate-400 bg-white/5 border border-white/10 shrink-0 select-none">
                                CTA Label
                            </span>
                        </div>
                    </div>

                @elseif($isLocationOrContact)
                    {{-- =========================================================================
                         8. LOCATION & DIRECT CONTACT COMPONENT (Screenshot 3)
                         ========================================================================= --}}
                    <div class="p-4 sm:p-5 rounded-2xl bg-white/[0.02] border border-white/10 hover:border-white/20 transition-all space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded-lg bg-teal-500/10 border border-teal-500/30 text-teal-400 flex items-center justify-center shrink-0">
                                    @if(str_contains($lowerKey, 'location') || str_contains($lowerKey, 'address'))
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    @elseif(str_contains($lowerKey, 'phone') || str_contains($lowerKey, 'tel'))
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    @else
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                    @endif
                                </span>
                                <label class="block text-xs font-mono font-bold text-slate-200 uppercase tracking-wider">
                                    {{ $label }}
                                </label>
                            </div>
                            <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400">
                                {{ $key }}
                            </span>
                        </div>

                        <div class="flex items-center rounded-xl bg-[#060b14] border border-white/15 focus-within:border-teal-400 focus-within:ring-2 focus-within:ring-teal-400/20 transition-all px-3.5 py-2 shadow-inner">
                            <input type="text" name="{{ $key }}" value="{{ $val }}"
                                placeholder="e.g. 500 Pike Street, Seattle, WA"
                                class="w-full text-xs sm:text-sm font-medium text-white placeholder:text-slate-600 bg-transparent border-0 focus:outline-none focus:ring-0">
                        </div>
                    </div>

                @else
                    {{-- =========================================================================
                         9. STANDARD TEXT INPUT FIELD
                         ========================================================================= --}}
                    <div class="p-4 sm:p-5 rounded-2xl bg-white/[0.02] border border-white/10 hover:border-white/20 transition-all space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-mono font-bold text-slate-200 uppercase tracking-wider">
                                {{ $label }}
                            </label>
                            <span class="text-[10px] font-mono px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-slate-400">
                                {{ $key }}
                            </span>
                        </div>

                        <div class="flex items-center rounded-xl bg-[#060b14] border border-white/15 focus-within:border-indigo-400 focus-within:ring-2 focus-within:ring-indigo-400/20 transition-all px-3.5 py-2 shadow-inner">
                            <input type="text" name="{{ $key }}" value="{{ $val }}"
                                placeholder="Enter {{ strtolower($label) }}..."
                                class="w-full text-xs sm:text-sm font-medium text-white placeholder:text-slate-600 bg-transparent border-0 focus:outline-none focus:ring-0">
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Section Save Action Bar -->
        <div class="pt-5 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 bg-white/[0.01] -mx-6 sm:-mx-7 -mb-6 sm:-mb-7 p-5 sm:p-6 rounded-b-3xl">
            <div class="flex items-center gap-2.5 text-xs text-slate-400">
                <span class="w-2.5 h-2.5 rounded-full animate-pulse shrink-0" style="background-color: {{ $themeColor }};"></span>
                <span>
                    Active Theme: <strong class="text-white font-mono">{{ $themeName }}</strong> &bull; Saved to <code class="text-indigo-300 font-mono">theme_contents</code>
                </span>
            </div>
            <button type="submit"
                class="w-full sm:w-auto px-6 py-2.5 rounded-xl text-xs sm:text-sm font-bold uppercase tracking-wider text-black transition-all duration-200 shadow-xl hover:scale-105 active:scale-95 cursor-pointer flex items-center justify-center gap-2"
                style="background-color: {{ $themeColor }}; box-shadow: 0 4px 24px -4px {{ $themeColor }}80;">
                <svg class="w-4 h-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
                <span>Save {{ $sectionTitle }}</span>
            </button>
        </div>
    </form>
</div>
