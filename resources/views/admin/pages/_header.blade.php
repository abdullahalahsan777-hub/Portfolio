@php
    $themeDetails = \App\Models\SiteSetting::getThemeDetails($selectedTheme);
    $themeName = $themeDetails['name'] ?? ucfirst(str_replace('_', ' ', $selectedTheme));
    $themeColor = $themeDetails['color'] ?? '#6366f1';
@endphp

<!-- Header with Breadcrumb & Live Preview -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <div class="flex items-center gap-2 text-xs text-slate-400 mb-1">
            <span>Page Elements</span>
            <span>&bull;</span>
            <span class="text-white font-medium">{{ $pageTitle }}</span>
        </div>
        <h1 class="text-2xl font-extrabold text-white flex items-center gap-3">
            <span>{{ $pageTitle }} Elements</span>
            <span class="text-xs px-2.5 py-1 rounded-lg border font-mono font-bold"
                style="border-color: {{ $themeColor }}40; color: {{ $themeColor }}; background-color: {{ $themeColor }}15;">
                {{ $themeName }}
            </span>
        </h1>
        <p class="text-xs text-slate-400 mt-1">
            Edit content elements for this page. Each section can be updated and submitted independently. Saved into the <code
                class="text-indigo-300 bg-black/40 px-1 py-0.5 rounded font-mono">theme_contents</code> table.
        </p>
    </div>

    <!-- Live Preview Button -->
    <a href="/{{ $pageSlug === 'home' ? '' : ($pageSlug === 'project' ? 'portfolio' : $pageSlug) }}?theme={{ $selectedTheme }}" target="_blank"
        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-slate-800 hover:bg-slate-700 border border-white/10 hover:border-white/20 transition-all shrink-0 shadow-md">
        <span>View Live {{ $pageTitle }}</span>
        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
        </svg>
    </a>
</div>

<!-- Current Selected Theme Tracker for Dropdown Reload -->
<input type="hidden" id="formCurrentTheme" value="{{ $selectedTheme }}">

<!-- TOP THEME FILTER COMPONENT (Instant Theme Switcher) -->
@include('admin.components.theme-filter', [
    'showGlobalOptions' => false,
    'elementName' => 'Content Fields',
])

<!-- Active Theme Notification Banner -->
<div class="p-3.5 rounded-2xl border flex items-center justify-between gap-3 text-xs"
    style="background-color: {{ $themeColor }}10; border-color: {{ $themeColor }}30;">
    <div class="flex items-center gap-2.5">
        <span class="w-2.5 h-2.5 rounded-full animate-pulse shrink-0"
            style="background-color: {{ $themeColor }};"></span>
        <span class="text-slate-200">
            Editing <strong class="text-white">{{ $pageTitle }}</strong> elements for theme: <strong class="text-white">{{ $themeName }}</strong>.
            Submit any individual section below to update it.
        </span>
    </div>
    <span class="text-[11px] font-mono text-slate-400 shrink-0 hidden sm:inline">Theme Key: <code
            class="text-white">{{ $selectedTheme }}</code></span>
</div>
