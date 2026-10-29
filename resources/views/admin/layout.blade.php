<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') — Portfolio Studio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap"
        rel="stylesheet">

    <link rel="icon"
        href="{{ asset(\App\Models\SiteSetting::get('site_favicon', 'images/defaults/favicon.svg')) }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        /* Dark Obsidian Select2 Custom Styling */
        .select2-container {
            width: 100% !important;
            font-family: inherit;
        }

        .select2-container--default .select2-selection--single {
            background-color: rgba(13, 22, 39, 0.9) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            border-radius: 0.75rem !important;
            height: 42px !important;
            display: flex !important;
            align-items: center;
            padding: 0 0.5rem;
            transition: all 0.2s ease;
            outline: none !important;
        }

        .select2-container--default .select2-selection--single:hover {
            border-color: rgba(255, 255, 255, 0.2) !important;
        }

        .select2-container--default.select2-container--open .select2-selection--single,
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #6366f1 !important;
            background-color: #0d1627 !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25) !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #f1f5f9 !important;
            font-size: 0.8125rem !important;
            font-weight: 500;
            padding-left: 0.5rem !important;
            padding-right: 2rem !important;
            line-height: 40px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #64748b !important;
            font-size: 0.8125rem !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
            right: 0.75rem !important;
            top: 0 !important;
            width: 20px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #94a3b8 transparent transparent transparent !important;
            border-width: 5px 4px 0 4px !important;
            transition: transform 0.2s ease;
        }

        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent #818cf8 transparent !important;
            border-width: 0 4px 5px 4px !important;
        }

        .select2-dropdown {
            background-color: #0d1627 !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            border-radius: 0.85rem !important;
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.7), 0 10px 15px -3px rgba(0, 0, 0, 0.5) !important;
            backdrop-filter: blur(20px);
            overflow: hidden !important;
            z-index: 99999 !important;
            margin-top: 4px;
        }

        .select2-dropdown--above {
            margin-top: -4px;
        }

        .select2-search--dropdown {
            padding: 0.6rem !important;
            background-color: rgba(255, 255, 255, 0.02);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .select2-search--dropdown .select2-search__field {
            background-color: #060b13 !important;
            color: #f1f5f9 !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            border-radius: 0.6rem !important;
            padding: 0.45rem 0.75rem !important;
            font-size: 0.75rem !important;
            font-family: inherit;
            outline: none !important;
            transition: all 0.2s ease;
        }

        .select2-search--dropdown .select2-search__field:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2) !important;
        }

        .select2-results__options {
            padding: 0.4rem !important;
            max-height: 260px !important;
        }

        /* Custom sleek scrollbar for Select2 */
        .select2-results__options::-webkit-scrollbar {
            width: 5px;
        }

        .select2-results__options::-webkit-scrollbar-track {
            background: transparent;
        }

        .select2-results__options::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 9999px;
        }

        .select2-results__options::-webkit-scrollbar-thumb:hover {
            background: rgba(99, 102, 241, 0.5);
        }

        /* Select2 Option Item Styling */
        .select2-container--default .select2-results__option[role="group"] {
            display: block !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .select2-container--default .select2-results__group {
            display: none !important;
        }

        .select2-container--default .select2-results__options--nested {
            padding: 0 !important;
            margin: 0 !important;
        }

        .select2-container--default .select2-results__option[role="option"] {
            padding: 0.55rem 0.85rem !important;
            font-size: 0.8125rem !important;
            color: #cbd5e1 !important;
            border-radius: 0.55rem !important;
            margin: 1px 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
        }

        /* Hover / Highlighted State */
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background: linear-gradient(90deg, #4f46e5 0%, #4338ca 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 2px 8px -1px rgba(79, 70, 229, 0.35);
        }

        /* Active / Selected State with subtle checkmark indicator */
        .select2-container--default .select2-results__option[aria-selected="true"] {
            background-color: rgba(99, 102, 241, 0.18) !important;
            color: #c7d2fe !important;
            font-weight: 600;
            border: 1px solid rgba(99, 102, 241, 0.3) !important;
        }

        .select2-container--default .select2-results__option[aria-selected="true"]::after {
            content: "";
            display: inline-block;
            width: 5px;
            height: 9px;
            border: solid #818cf8;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
            margin-left: auto;
            margin-right: 2px;
            flex-shrink: 0;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected="true"]::after {
            border-color: #ffffff;
        }

        /* Disabled State */
        .select2-container--default .select2-results__option--disabled {
            color: #64748b !important;
            opacity: 0.45;
            cursor: not-allowed !important;
        }

        .select2-results__message {
            color: #64748b !important;
            font-size: 0.75rem !important;
            padding: 0.75rem 1rem !important;
            text-align: center;
        }

        /* -------------------------------------------------------------------------
         * Dark Obsidian Summernote WYSIWYG Custom Theme
         * ------------------------------------------------------------------------- */
        .note-editor.note-frame {
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            border-radius: 0.875rem !important;
            background-color: #060b13 !important;
            overflow: hidden !important;
            transition: all 0.2s ease;
        }

        .note-editor.note-frame.focus,
        .note-editor.note-frame:focus-within {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25) !important;
        }

        .note-toolbar {
            background-color: rgba(13, 22, 39, 0.95) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            padding: 6px 8px !important;
            color: #f1f5f9 !important;
        }

        .note-toolbar .note-btn-group {
            margin-right: 6px !important;
            margin-bottom: 4px !important;
        }

        .note-btn {
            background-color: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: #cbd5e1 !important;
            border-radius: 0.5rem !important;
            padding: 5px 10px !important;
            font-size: 0.8125rem !important;
            transition: all 0.15s ease;
            cursor: pointer !important;
        }

        .note-btn:hover,
        .note-btn:focus {
            background-color: rgba(255, 255, 255, 0.12) !important;
            color: #ffffff !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
        }

        .note-btn.active {
            background-color: rgba(99, 102, 241, 0.25) !important;
            border-color: #6366f1 !important;
            color: #a5b4fc !important;
        }

        .note-editing-area {
            background-color: #060b13 !important;
            color: #f1f5f9 !important;
        }

        .note-editable {
            background-color: #060b13 !important;
            color: #f1f5f9 !important;
            font-family: inherit !important;
            font-size: 0.875rem !important;
            line-height: 1.7 !important;
            padding: 16px !important;
            caret-color: #818cf8 !important;
        }

        .note-editable p {
            margin-bottom: 0.75rem !important;
        }

        .note-editable h1,
        .note-editable h2,
        .note-editable h3,
        .note-editable h4,
        .note-editable h5,
        .note-editable h6 {
            color: #ffffff !important;
            font-weight: 700 !important;
            margin-top: 1rem !important;
            margin-bottom: 0.5rem !important;
        }

        .note-editable a {
            color: #818cf8 !important;
            text-decoration: underline !important;
        }

        .note-editable blockquote {
            border-left: 3px solid #6366f1 !important;
            padding-left: 1rem !important;
            color: #94a3b8 !important;
            margin: 1rem 0 !important;
        }

        .note-editable pre,
        .note-editable code {
            background-color: rgba(255, 255, 255, 0.06) !important;
            color: #a5b4fc !important;
            border-radius: 0.375rem !important;
            font-family: 'JetBrains Mono', monospace !important;
            padding: 2px 6px !important;
        }

        .note-editable ul,
        .note-editable ol {
            padding-left: 1.5rem !important;
            margin-bottom: 0.75rem !important;
        }

        .note-editable ul {
            list-style-type: disc !important;
        }

        .note-editable ol {
            list-style-type: decimal !important;
        }

        .note-placeholder {
            color: #64748b !important;
            font-size: 0.875rem !important;
            padding: 16px !important;
        }

        .note-statusbar {
            background-color: rgba(13, 22, 39, 0.95) !important;
            border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
        }

        .note-statusbar .note-resizebar {
            height: 9px !important;
        }

        .note-statusbar .note-resizebar .note-icon-bar {
            border-top: 1px solid rgba(255, 255, 255, 0.2) !important;
            width: 24px !important;
            margin: 1px auto !important;
        }

        .note-popover,
        .note-dropdown-menu {
            background-color: #0d1627 !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            border-radius: 0.75rem !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.6), 0 8px 10px -6px rgba(0, 0, 0, 0.5) !important;
            backdrop-filter: blur(20px) !important;
            color: #f1f5f9 !important;
            padding: 6px 0 !important;
            z-index: 99999 !important;
        }

        .note-dropdown-menu .note-dropdown-item,
        .note-dropdown-menu a {
            color: #cbd5e1 !important;
            padding: 6px 14px !important;
            font-size: 0.8125rem !important;
            display: block !important;
            transition: all 0.15s ease;
        }

        .note-dropdown-menu .note-dropdown-item:hover,
        .note-dropdown-menu a:hover {
            background-color: rgba(255, 255, 255, 0.08) !important;
            color: #ffffff !important;
        }

        .note-modal .note-modal-content {
            background-color: #0d1627 !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            border-radius: 1rem !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8) !important;
            color: #f1f5f9 !important;
        }

        .note-modal .note-modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            padding: 1rem 1.25rem !important;
        }

        .note-modal .note-modal-title {
            color: #ffffff !important;
            font-size: 1rem !important;
            font-weight: 700 !important;
        }

        .note-modal .close {
            color: #94a3b8 !important;
            opacity: 0.8 !important;
            font-size: 1.25rem !important;
        }

        .note-modal .close:hover {
            color: #ffffff !important;
            opacity: 1 !important;
        }

        .note-modal .note-modal-body {
            padding: 1.25rem !important;
            color: #cbd5e1 !important;
        }

        .note-modal .note-modal-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
            padding: 1rem 1.25rem !important;
        }

        .note-modal .note-input {
            background-color: #060b13 !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            color: #f8fafc !important;
            border-radius: 0.5rem !important;
            padding: 0.5rem 0.75rem !important;
        }

        .note-modal .note-input:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.25) !important;
        }

        .note-modal .note-btn-primary {
            background-color: #4f46e5 !important;
            border-color: #6366f1 !important;
            color: #ffffff !important;
            border-radius: 0.5rem !important;
            font-weight: 600 !important;
            padding: 0.5rem 1rem !important;
        }

        .note-modal .note-btn-primary:hover {
            background-color: #4338ca !important;
        }

        .note-modal-backdrop {
            background-color: rgba(3, 7, 18, 0.8) !important;
            backdrop-filter: blur(4px) !important;
        }
    </style>

    @stack('styles')
</head>

<body ng-app="adminApp"
    class="admin-body bg-[#060b13] text-slate-100 min-h-screen antialiased flex selection:bg-indigo-500 selection:text-white">
    <!-- Sidebar Navigation -->
    <aside id="adminSidebar"
        class="w-64 bg-[#09101d] border-r border-white/10 flex flex-col shrink-0 min-h-screen sticky top-0 h-screen z-40">
        <!-- Scrollable Navigation Area -->
        <div class="flex-1 overflow-y-auto">
            <!-- Admin Studio Brand & Profile Header (Sidebar Top) -->
            <div class="p-0.5 border-b border-white/10 space-y-3.5 bg-gradient-to-b from-white/[0.03] to-transparent">
                <!-- Sidebar Top Profile Info Card -->
                <div class="flex items-center gap-3 p-2.5 rounded-2xl transition-all group">
                    <div class="relative shrink-0">
                        @if (!empty(auth()->user()->avatar) && file_exists(public_path(auth()->user()->avatar)))
                            <img src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                                class="w-10 h-10 rounded-xl object-cover border border-indigo-500/40 shadow-md">
                        @else
                            <div
                                class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-500 text-white font-extrabold text-xs flex items-center justify-center shadow-md">
                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                            </div>
                        @endif
                        <span
                            class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full bg-emerald-500 border-2 border-[#09101d]"
                            title="Online"></span>
                    </div>
                    <div class="overflow-hidden flex-1 text-left min-w-0">
                        <span
                            class="block text-xs font-bold text-white truncate transition-colors">{{ auth()->user()->name }}</span>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span
                                class="text-[9px] font-mono uppercase tracking-wider px-1.5 py-0.2 rounded bg-indigo-500/20 text-indigo-300 font-semibold">Admin</span>
                            <span class="text-[10px] text-slate-400 truncate">Online</span>
                            <span
                                class="text-[9px] font-mono px-1.5 py-0.2 rounded bg-[#0090e7]/15 text-[#0090e7] font-semibold">v{{ config('app.version', '1.0.0') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="p-4 space-y-6 text-xs">
                <!-- Section: General -->
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard Overview</span>
                    </a>
                    <a href="{{ route('home') }}" target="_blank"
                        class="flex items-center justify-between px-3 py-2 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            <span>View Live Website</span>
                        </div>
                        <span class="text-[10px] font-mono text-emerald-400">:8044</span>
                    </a>
                </div>

                <!-- EXPLICIT GROUP: Website (For all website element to editable) -->
                <div class="space-y-1">
                    <div
                        class="px-3 text-[10px] font-mono font-bold uppercase tracking-wider text-indigo-400 flex items-center justify-between">
                        <span>Website</span>
                        <span class="text-[9px] px-1.5 py-0.2 rounded bg-indigo-500/20 text-indigo-300">Editable</span>
                    </div>

                    <!-- Page Elements with Dynamic Submenu (Theme-wise derived from theme_contents) -->
                    @php
                        $isPageElementsActive =
                            request()->routeIs('admin.pages.*') || request()->routeIs('admin.website.*');
                        $currentThemeQuery = request('theme', \App\Models\SiteSetting::getActiveTheme());

                        // Dynamically retrieve distinct pages from theme_contents for this theme
                        $themePageRecords = \App\Models\ThemeContent::where('theme', $currentThemeQuery)
                            ->where('page', '!=', 'general')
                            ->select('page')
                            ->selectRaw('count(distinct section) as section_count')
                            ->groupBy('page')
                            ->pluck('section_count', 'page')
                            ->toArray();

                        $standardPages = [
                            'home' => ['title' => 'Home Page', 'route' => 'admin.pages.home'],
                            'about' => ['title' => 'About Page', 'route' => 'admin.pages.about'],
                            'contact' => ['title' => 'Contact Page', 'route' => 'admin.pages.contact'],
                            'service' => ['title' => 'Service Page', 'route' => 'admin.pages.service'],
                            'project' => ['title' => 'Project Page', 'route' => 'admin.pages.project'],
                            'resume' => ['title' => 'Resume Page', 'route' => 'admin.pages.resume'],
                            'blog' => ['title' => 'Blog Page', 'route' => 'admin.pages.blog'],
                            'faq' => ['title' => 'FAQ Page', 'route' => 'admin.pages.faq'],
                        ];

                        // Build dynamic pages list
                        $pagesList = [];
                        foreach ($standardPages as $slug => $meta) {
                            if (empty($themePageRecords) || isset($themePageRecords[$slug])) {
                                $pagesList[$slug] = [
                                    'title' => $meta['title'],
                                    'route' => $meta['route'],
                                    'count' => $themePageRecords[$slug] ?? 0,
                                ];
                            }
                        }
                        foreach ($themePageRecords as $slug => $count) {
                            if (!isset($pagesList[$slug])) {
                                $pagesList[$slug] = [
                                    'title' => ucfirst(str_replace('_', ' ', $slug)) . ' Page',
                                    'route' => \Illuminate\Support\Facades\Route::has('admin.pages.' . $slug)
                                        ? 'admin.pages.' . $slug
                                        : 'admin.pages.home',
                                    'count' => $count,
                                ];
                            }
                        }
                    @endphp
                    <div class="space-y-1">
                        <button type="button" onclick="togglePageElementsMenu()"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-xl font-medium {{ $isPageElementsActive ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-all group">
                            <div class="flex items-center gap-3">
                                <svg class="w-4 h-4 {{ $isPageElementsActive ? 'text-indigo-400' : 'text-slate-400 group-hover:text-white' }}"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <span>Page Elements</span>
                            </div>
                            <svg id="pageElementsChevron"
                                class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200 {{ $isPageElementsActive ? 'rotate-90 text-indigo-300' : '' }}"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <!-- Dynamic Submenu -->
                        <div id="pageElementsSubmenu"
                            class="{{ $isPageElementsActive ? 'block' : 'hidden' }} pl-3 pr-1 py-1 space-y-0.5 border-l-2 border-indigo-500/20 ml-4">
                            @foreach ($pagesList as $pSlug => $pMeta)
                                @php
                                    $isActive =
                                        request()->routeIs('admin.pages.' . $pSlug) ||
                                        ($pSlug === 'home' && request()->routeIs('admin.website.content'));
                                @endphp
                                <a href="{{ route($pMeta['route'], ['theme' => $currentThemeQuery]) }}"
                                    class="flex items-center justify-between px-2.5 py-1.5 rounded-lg text-xs font-medium {{ $isActive ? 'bg-indigo-600/30 text-indigo-200 font-bold border border-indigo-500/30 shadow-sm' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-all group">
                                    <div class="flex items-center gap-2 truncate">
                                        <span class="truncate">{{ $pMeta['title'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 shrink-0">
                                        @if ($pMeta['count'] > 0)
                                            <span
                                                class="text-[9px] font-mono px-1.5 py-0.2 rounded bg-white/5 border border-white/5 text-slate-400 group-hover:text-slate-300">
                                                {{ $pMeta['count'] }}
                                            </span>
                                        @endif
                                        @if ($isActive)
                                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Services Manager -->
                    <a href="{{ route('admin.services.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium {{ request()->routeIs('admin.services.*') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Services</span>
                    </a>

                    <!-- Projects Manager -->
                    <a href="{{ route('admin.projects.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium {{ request()->routeIs('admin.projects.*') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Projects / Portfolio</span>
                    </a>

                    <!-- Skills Manager -->
                    <a href="{{ route('admin.skills.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium {{ request()->routeIs('admin.skills.*') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                        <span>Skills & Tools</span>
                    </a>

                    <!-- Resume (Education & Work Experience) -->
                    <a href="{{ route('admin.resume.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium {{ request()->routeIs('admin.resume.*') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        </svg>
                        <span>Resume & Experience</span>
                    </a>

                    <!-- Pricing Plans -->
                    <a href="{{ route('admin.pricing.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium {{ request()->routeIs('admin.pricing.*') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Pricing Plans</span>
                    </a>

                    <!-- Testimonials -->
                    <a href="{{ route('admin.testimonials.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium {{ request()->routeIs('admin.testimonials.*') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        <span>Testimonials</span>
                    </a>

                    <!-- Blog Articles -->
                    <a href="{{ route('admin.blog.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium {{ request()->routeIs('admin.blog.*') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <span>Articles & Blog</span>
                    </a>

                    <!-- FAQs -->
                    <a href="{{ route('admin.faqs.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium {{ request()->routeIs('admin.faqs.*') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>FAQs & Answers</span>
                    </a>

                    <!-- Contact Inquiries -->
                    <a href="{{ route('admin.messages.index') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl font-medium {{ request()->routeIs('admin.messages.*') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-all">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>Inquiries</span>
                        </div>
                        @php
                            $unread = \App\Models\ContactMessage::where('is_read', false)->count();
                        @endphp
                        @if ($unread > 0)
                            <span
                                class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-amber-500 text-black">
                                {{ $unread }}
                            </span>
                        @endif
                    </a>
                </div>

                <!-- Section: System & Maintenance -->
                <div class="space-y-1">
                    <div class="px-3 text-[10px] font-mono font-bold uppercase tracking-wider text-slate-500">
                        SYSTEM
                    </div>

                    <!-- Notifications -->
                    <a href="{{ route('admin.notifications.index') }}"
                        class="flex items-center justify-between px-3 py-2 rounded-xl font-medium {{ request()->routeIs('admin.notifications.*') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-all">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-amber-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span>Notifications</span>
                        </div>
                        <span id="sidebar_notification_badge"
                            class="hidden px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-rose-500 text-white animate-pulse">
                            0
                        </span>
                    </a>

                    @if (auth()->check() && auth()->user()->isAdmin())
                        <!-- Maintenance & Health -->
                        <a href="{{ route('admin.maintenance.index') }}"
                            class="flex items-center justify-between px-3 py-2 rounded-xl font-medium {{ request()->routeIs('admin.maintenance.*') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-all">
                            <div class="flex items-center gap-3">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                </svg>
                                <span>System Maintenance</span>
                            </div>
                            @if (
                                \App\Models\SiteSetting::get('maintenance_mode', '0') === '1' ||
                                    \App\Models\SiteSetting::get('server_status', 'up') === 'maintenance')
                                <span
                                    class="px-1.5 py-0.5 rounded text-[9px] font-mono font-bold bg-amber-500 text-black animate-pulse">503</span>
                            @endif
                        </a>

                        <!-- User Management -->
                        <a href="{{ route('admin.users.index') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl font-medium {{ request()->routeIs('admin.users.*') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }} transition-all">
                            <svg class="w-4 h-4 text-cyan-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span>User Management</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar User Profile Footer with Right-Absolute Flyout Menu -->
        <div class="p-3 border-t border-white/10 bg-[#070c16] relative shrink-0">
            <!-- Flyout Dropdown Menu (Opens to the RIGHT of sidebar, absolute positioned) -->
            <div id="profileDropdownMenu"
                class="hidden absolute left-[calc(100%+0.75rem)] bottom-0 w-80 rounded-2xl bg-[#0c1424] border border-white/10 shadow-[0_20px_60px_rgba(0,0,0,0.85)] backdrop-blur-2xl p-3 z-50 space-y-1.5 text-xs transition-all max-h-[calc(100vh-2rem)] overflow-y-auto">

                <!-- 1. User Header Details -->
                <div class="p-3 bg-white/[0.03] rounded-xl border border-white/5 flex items-center gap-3">
                    <div class="relative shrink-0">
                        @if (!empty(auth()->user()->avatar) && file_exists(public_path(auth()->user()->avatar)))
                            <img src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                                class="w-11 h-11 rounded-full object-cover border border-rose-500/40 shadow-md">
                        @else
                            <div
                                class="w-11 h-11 rounded-full bg-gradient-to-tr from-rose-500 to-orange-500 flex items-center justify-center font-bold text-white text-base shadow-md">
                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                            </div>
                        @endif
                        <span
                            class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 border-2 border-[#0c1424]"></span>
                    </div>
                    <div class="overflow-hidden flex-1 min-w-0">
                        <span
                            class="font-extrabold text-white text-sm truncate block leading-tight">{{ auth()->user()->name }}</span>
                        <div class="mt-1 flex items-center gap-1.5">
                            <span
                                class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-500/20 text-rose-300 border border-rose-500/30 leading-none">
                                <svg class="w-2.5 h-2.5 text-rose-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ auth()->user()->isAdmin() ? 'Super Admin' : auth()->user()->role ?? 'User' }}
                            </span>
                        </div>
                        <span
                            class="text-[11px] text-slate-400 font-mono block truncate mt-1">{{ auth()->user()->email }}</span>
                    </div>
                </div>

                <!-- Section Divider -->
                <div class="my-1 border-t border-white/10"></div>

                <!-- 2. Account Settings -->
                <a href="{{ route('admin.account') }}"
                    class="flex items-center justify-between p-2.5 rounded-xl hover:bg-white/[0.06] transition-all group border border-transparent hover:border-white/10 {{ request()->routeIs('admin.account*') ? 'bg-indigo-600/20 border-indigo-500/30 text-white' : 'text-slate-300 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 rounded-xl bg-purple-500/15 text-purple-400 flex items-center justify-center shrink-0 border border-purple-500/20 group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <span
                                class="block text-xs font-bold text-white group-hover:text-purple-300 transition-colors">Account
                                Settings</span>
                            <span class="block text-[10px] text-slate-400">Profile & security preferences</span>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-500 group-hover:text-white group-hover:translate-x-0.5 transition-all shrink-0"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <!-- 3. General Settings -->
                <a href="{{ route('admin.settings.general') }}"
                    class="flex items-center justify-between p-2.5 rounded-xl hover:bg-white/[0.06] transition-all group border border-transparent hover:border-white/10 {{ request()->routeIs('admin.settings.general') ? 'bg-indigo-600/20 border-indigo-500/30 text-white' : 'text-slate-300 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 rounded-xl bg-indigo-500/15 text-indigo-400 flex items-center justify-center shrink-0 border border-indigo-500/20 group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <span
                                class="block text-xs font-bold text-white group-hover:text-indigo-300 transition-colors">General
                                Settings</span>
                            <span class="block text-[10px] text-slate-400">App title, logos & metadata</span>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-500 group-hover:text-white group-hover:translate-x-0.5 transition-all shrink-0"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <!-- 4. Image Upload -->
                <a href="{{ route('admin.settings.images') }}"
                    class="flex items-center justify-between p-2.5 rounded-xl hover:bg-white/[0.06] transition-all group border border-transparent hover:border-white/10 {{ request()->routeIs('admin.settings.images') ? 'bg-emerald-600/20 border-emerald-500/30 text-white' : 'text-slate-300 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 rounded-xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0 border border-emerald-500/20 group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <span
                                class="block text-xs font-bold text-white group-hover:text-emerald-300 transition-colors">Image
                                Upload</span>
                            <span class="block text-[10px] text-slate-400">Upload drivers & sizes</span>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-500 group-hover:text-white group-hover:translate-x-0.5 transition-all shrink-0"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <!-- 5. Social Media -->
                <a href="{{ route('admin.settings.social') }}"
                    class="flex items-center justify-between p-2.5 rounded-xl hover:bg-white/[0.06] transition-all group border border-transparent hover:border-white/10 {{ request()->routeIs('admin.settings.social') ? 'bg-amber-600/20 border-amber-500/30 text-white' : 'text-slate-300 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 rounded-xl bg-amber-500/15 text-amber-400 flex items-center justify-center shrink-0 border border-amber-500/20 group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                        </div>
                        <div>
                            <span
                                class="block text-xs font-bold text-white group-hover:text-amber-300 transition-colors">Social
                                Media</span>
                            <span class="block text-[10px] text-slate-400">Social links & integrations</span>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-500 group-hover:text-white group-hover:translate-x-0.5 transition-all shrink-0"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <!-- 6. Theme Settings -->
                <a href="{{ route('admin.settings.theme') }}"
                    class="flex items-center justify-between p-2.5 rounded-xl hover:bg-white/[0.06] transition-all group border border-transparent hover:border-white/10 {{ request()->routeIs('admin.settings.theme') ? 'bg-pink-600/20 border-pink-500/30 text-white' : 'text-slate-300 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 rounded-xl bg-pink-500/15 text-pink-400 flex items-center justify-center shrink-0 border border-pink-500/20 group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21a4 4 0 01-4-4 5 5 0 015-5 4 4 0 014 4 5 5 0 01-5 5zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                        </div>
                        <div>
                            <span
                                class="block text-xs font-bold text-white group-hover:text-pink-300 transition-colors">Theme
                                Settings</span>
                            <span class="block text-[10px] text-slate-400">Themes, colors & visual modes</span>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-500 group-hover:text-white group-hover:translate-x-0.5 transition-all shrink-0"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <!-- 7. Section Divider: Logout -->
                <div class="pt-1 border-t border-white/10">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-between p-2.5 rounded-xl hover:bg-rose-500/10 transition-all group border border-transparent hover:border-rose-500/20 text-left cursor-pointer">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-rose-500/15 text-rose-400 flex items-center justify-center shrink-0 border border-rose-500/20 group-hover:scale-105 transition-transform">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold text-rose-300">Logout</span>
                                    <span class="block text-[10px] text-slate-400">End your active session</span>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-500 group-hover:text-rose-400 group-hover:translate-x-0.5 transition-all shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Profile Trigger Button (Bottom of Sidebar) -->
            <button type="button" id="profileDropdownTrigger" onclick="toggleProfileDropdown(event)"
                class="w-full flex items-center justify-between p-2.5 rounded-2xl border transition-all cursor-pointer {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.account*') || request()->routeIs('admin.profile') ? 'bg-indigo-600/15 border-indigo-500/40 text-white shadow-lg shadow-indigo-600/10' : 'bg-black/30 hover:bg-white/5 border-white/10 text-slate-300 hover:text-white' }}">
                <div class="flex items-center gap-2.5 overflow-hidden text-left min-w-0 flex-1">
                    <div class="relative shrink-0">
                        @if (!empty(auth()->user()->avatar) && file_exists(public_path(auth()->user()->avatar)))
                            <img src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                                class="w-9 h-9 rounded-xl object-cover border border-white/10 shadow-md">
                        @else
                            <div
                                class="w-9 h-9 rounded-xl bg-gradient-to-tr from-rose-500 to-orange-500 flex items-center justify-center font-bold text-white text-xs shrink-0 shadow-md">
                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                            </div>
                        @endif
                        <span
                            class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-emerald-500 border-2 border-[#0c1424]"></span>
                    </div>
                    <div class="overflow-hidden min-w-0 flex-1">
                        <span class="block text-xs font-bold text-white truncate">{{ auth()->user()->name }}</span>
                        <span
                            class="block text-[10px] font-mono text-slate-400 truncate">{{ auth()->user()->email }}</span>
                    </div>
                </div>
                <div class="p-1 text-slate-400 group-hover:text-white shrink-0">
                    <!-- 3 Vertical Dots icon as in image -->
                    <svg class="w-4 h-4 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                    </svg>
                </div>
            </button>

            <!-- Sidebar Bottom Version Indicator -->
            <div class="mt-2 pt-2 border-t border-white/5 flex items-center justify-between text-[10px] font-mono text-slate-500 px-1">
                <span class="truncate">Portfolio Studio</span>
                <a href="https://github.com/abdullahalahsan777-hub/Portfolio" target="_blank"
                    class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded bg-white/5 hover:bg-[#0090e7]/15 text-slate-400 hover:text-[#0090e7] transition-all font-semibold"
                    title="GitHub Repository & Release">
                    <span>v{{ config('app.version', '1.0.0') }}</span>
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-h-screen overflow-x-hidden">
        <!-- Topbar -->
        <header
            class="h-16 border-b border-white/10 bg-[#09101d]/60 backdrop-blur-md px-8 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-3">
                <h2 class="text-base font-bold text-white">@yield('page_title', 'Dashboard')</h2>
                <span class="text-xs text-slate-500 font-mono">/ @yield('page_subtitle', 'Overview')</span>
                <span class="hidden sm:inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-[#0090e7]/15 text-[#0090e7] border border-[#0090e7]/30 shadow-sm"
                    title="Current Release">
                    v{{ config('app.version', '1.0.0') }}
                </span>
            </div>

            <div class="flex items-center gap-3">
                @php
                    $isServerMaintenance =
                        \App\Models\SiteSetting::get('maintenance_mode', '0') === '1' ||
                        \App\Models\SiteSetting::get('server_status', 'up') === 'maintenance';
                @endphp
                @if ($isServerMaintenance)
                    @if (auth()->check() && auth()->user()->isAdmin())
                        <a href="{{ route('admin.maintenance.index') }}"
                            class="flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/20 border border-amber-500/40 text-amber-300 hover:bg-amber-500/30 transition-all shadow-lg shadow-amber-500/10 text-xs font-mono"
                            title="Click to upgrade server status">
                            <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                            <span class="font-bold">503 Maintenance</span>
                            <span class="text-[10px] bg-amber-400 text-black px-1.5 py-0.5 rounded font-black">UPGRADE
                                &rarr;</span>
                        </a>
                    @else
                        <div
                            class="flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/20 border border-amber-500/40 text-amber-300 text-xs font-mono">
                            <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                            <span class="font-bold">Maintenance Mode</span>
                        </div>
                    @endif
                @endif

                <!-- Topbar Notifications Bell & Dropdown (Left of Profile Button) -->
                <div class="relative" id="topbarNotificationContainer">
                    <button type="button" id="topbarNotificationTrigger" onclick="toggleNotificationDropdown(event)"
                        title="Notifications"
                        class="relative w-9 h-9 rounded-full bg-[#0c1424] hover:bg-white/10 border border-white/10 text-slate-300 hover:text-white flex items-center justify-center transition-all shadow-md group cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500/40">
                        <svg id="topbar_bell_icon"
                            class="w-4 h-4 text-slate-300 group-hover:text-amber-400 transition-colors" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <!-- Live Unread Badge -->
                        <span id="topbar_notification_badge"
                            class="hidden absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 rounded-full bg-rose-500 text-white font-mono font-bold text-[10px] flex items-center justify-center border-2 border-[#09101d] shadow-sm animate-pulse">
                            0
                        </span>
                    </button>

                    <!-- Notifications Dropdown Popover -->
                    <div id="topbarNotificationMenu"
                        class="hidden absolute right-0 top-full mt-2 w-80 sm:w-96 rounded-2xl bg-[#0c1424] border border-white/10 shadow-[0_16px_50px_rgba(0,0,0,0.85)] backdrop-blur-2xl z-50 text-xs transition-all overflow-hidden font-sans">

                        <!-- Header -->
                        <div
                            class="px-4 py-3 border-b border-white/10 flex items-center justify-between bg-white/[0.02]">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-white text-sm">Notifications</span>
                                <span id="topbar_menu_unread_count"
                                    class="hidden px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                                    0 unread
                                </span>
                            </div>
                            <button type="button" onclick="markAllNotificationsRead(event)"
                                class="text-[11px] text-indigo-400 hover:text-indigo-300 font-semibold cursor-pointer hover:underline">
                                Mark all read
                            </button>
                        </div>

                        <!-- Notifications list container -->
                        <div id="topbarNotificationList"
                            class="max-h-80 overflow-y-auto divide-y divide-white/5 scrollbar-thin">
                            <div class="py-8 text-center text-slate-500 text-xs">
                                Loading notifications...
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="p-2.5 border-t border-white/10 bg-[#070c16] text-center">
                            <a href="{{ route('admin.notifications.index') }}"
                                class="block py-1.5 text-xs font-semibold text-indigo-400 hover:text-indigo-300 transition-colors">
                                View all notifications &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Topbar Profile Dropdown Button -->
                <div class="relative">
                    <button type="button" id="topbarProfileTrigger" onclick="toggleTopbarProfile(event)"
                        class="flex items-center gap-2.5 py-1.5 px-3 rounded-full bg-[#0c1424] hover:bg-white/10 border border-white/10 text-slate-300 hover:text-white transition-all shadow-md group cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500/40">
                        @if (!empty(auth()->user()->avatar) && file_exists(public_path(auth()->user()->avatar)))
                            <img src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                                class="w-7 h-7 rounded-full object-cover border border-indigo-500/40 shadow-sm shrink-0">
                        @else
                            <div
                                class="w-7 h-7 rounded-full bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-500 text-white font-extrabold text-[11px] flex items-center justify-center shadow-sm shrink-0">
                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                            </div>
                        @endif
                        <div class="text-left hidden sm:block">
                            <span
                                class="block text-xs font-bold text-white leading-tight">{{ auth()->user()->name ?? 'Admin' }}</span>
                            <span
                                class="block text-[9px] font-mono text-indigo-400 uppercase tracking-wider leading-none">{{ auth()->user()->role ?? 'Admin' }}</span>
                        </div>
                        <svg id="topbarProfileChevron"
                            class="w-3.5 h-3.5 text-slate-400 group-hover:text-white transition-transform duration-200"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Profile Dropdown Menu (Opens downwards) -->
                    <div id="topbarProfileMenu"
                        class="hidden absolute right-0 top-full mt-2 w-64 rounded-2xl bg-[#0c1424] border border-white/10 shadow-[0_12px_40px_rgba(0,0,0,0.85)] backdrop-blur-xl p-2 z-50 text-xs transition-all space-y-1">

                        <!-- User Header Details -->
                        <div
                            class="p-3 border-b border-white/10 bg-white/[0.02] rounded-xl mb-1.5 flex items-center gap-3">
                            @if (!empty(auth()->user()->avatar) && file_exists(public_path(auth()->user()->avatar)))
                                <img src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                                    class="w-10 h-10 rounded-xl object-cover border border-indigo-500/40 shrink-0 shadow-md">
                            @else
                                <div
                                    class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-500 text-white font-extrabold text-sm flex items-center justify-center shrink-0 shadow-md">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                                </div>
                            @endif
                            <div class="overflow-hidden">
                                <span
                                    class="block text-xs font-bold text-white truncate">{{ auth()->user()->name ?? 'Admin' }}</span>
                                <span
                                    class="block text-[11px] text-slate-400 truncate font-mono">{{ auth()->user()->email ?? '' }}</span>
                                <span
                                    class="inline-block mt-1 px-1.5 py-0.5 rounded text-[9px] font-mono font-bold uppercase bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                                    {{ auth()->user()->role ?? 'Admin' }}
                                </span>
                            </div>
                        </div>

                        <!-- 1. Profile Button -->
                        <a href="{{ route('admin.profile') }}"
                            class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.profile') ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30' : 'text-slate-200 hover:text-white hover:bg-white/5' }}">
                            <div
                                class="w-7 h-7 rounded-lg bg-indigo-500/10 text-indigo-400 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="block font-medium">Profile</span>
                                <span class="block text-[10px] text-slate-400">View personal profile</span>
                            </div>
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>

                        <!-- 2. Account Settings Button -->
                        <a href="{{ route('admin.account') }}"
                            class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.account*') ? 'bg-purple-600/20 text-purple-300 font-bold border border-purple-500/30' : 'text-slate-200 hover:text-white hover:bg-white/5' }}">
                            <div
                                class="w-7 h-7 rounded-lg bg-purple-500/10 text-purple-400 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="block font-medium">Account Settings</span>
                                <span class="block text-[10px] text-slate-400">Security & credentials</span>
                            </div>
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>

                        <div class="my-1.5 border-t border-white/10"></div>

                        <!-- 3. Logout Button -->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 transition-all font-medium text-left cursor-pointer">
                                <div
                                    class="w-7 h-7 rounded-lg bg-rose-500/10 text-rose-400 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <span class="block font-medium">Logout</span>
                                    <span class="block text-[10px] text-rose-400/70">Sign out of session</span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Body -->
        <main class="p-8 flex-1">
            @yield('content')
        </main>

        <!-- Admin Studio Footer -->
        <footer class="px-8 py-4 border-t border-white/5 bg-[#070c16]/80 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
            <div class="flex items-center gap-2">
                <span class="font-bold text-slate-300">Portfolio Studio</span>
                <span>&bull;</span>
                <span>All rights reserved.</span>
            </div>
            <div class="flex items-center gap-3 font-mono text-[11px]">
                <span class="flex items-center gap-1.5 text-slate-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    Operational
                </span>
                <span class="text-slate-600">&bull;</span>
                <a href="https://github.com/abdullahalahsan777-hub/Portfolio" target="_blank"
                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-[#0090e7]/10 text-[#0090e7] border border-[#0090e7]/30 hover:bg-[#0090e7]/20 transition-all font-semibold"
                    title="GitHub Repository & Release Notes">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                    </svg>
                    v{{ config('app.version', '1.0.0') }}
                </a>
            </div>
        </footer>
    </div>

    <!-- Global Libraries: jQuery, Select2, AngularJS (1.x), Summernote Lite, Toastr -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // AngularJS Module for Admin Studio
        var adminApp = angular.module('adminApp', []);

        // Avoid collision between Blade brackets and AngularJS brackets
        adminApp.config(['$interpolateProvider', function($interpolateProvider) {
            $interpolateProvider.startSymbol('[[');
            $interpolateProvider.endSymbol(']]');
        }]);

        // Helper to initialize Select2 on a jQuery/Angular element
        function applySelect2ToElement($el) {
            if (!$el || !$el.length) return;
            if ($el.hasClass('no-select2') || $el.closest('.dataTables_length').length) return;
            if ($el.hasClass('select2-hidden-accessible')) return;

            var numOptions = $el.find('option').length;
            $el.select2({
                width: '100%',
                minimumResultsForSearch: numOptions > 6 ? 0 : -1,
                placeholder: $el.attr('placeholder') || 'Select an option'
            });
        }

        // 1. Universal AngularJS Directive for all <select> elements
        adminApp.directive('select', ['$timeout', function($timeout) {
            return {
                restrict: 'E',
                link: function(scope, element, attrs) {
                    $timeout(function() {
                        applySelect2ToElement(angular.element(element));
                    }, 0);

                    // If ngModel is present, keep AngularJS scope and Select2 in two-way sync
                    if (attrs.ngModel) {
                        element.on('change', function() {
                            scope.$evalAsync(function() {
                                scope[attrs.ngModel] = element.val();
                            });
                        });
                        scope.$watch(attrs.ngModel, function(newVal) {
                            if (newVal !== undefined) {
                                element.val(newVal).trigger('change.select2');
                            }
                        });
                    }

                    element.on('$destroy', function() {
                        if (element.hasClass('select2-hidden-accessible')) {
                            element.select2('destroy');
                        }
                    });
                }
            };
        }]);

        // 2. Explicit AngularJS ui-select2 / select2 directive
        adminApp.directive('select2', ['$timeout', function($timeout) {
            return {
                restrict: 'A',
                link: function(scope, element, attrs) {
                    $timeout(function() {
                        applySelect2ToElement(angular.element(element));
                    }, 0);
                }
            };
        }]);

        // 3. Fallback on DOM ready for any select element
        $(document).ready(function() {
            $('select:not(.no-select2):not(.dataTables_length select)').each(function() {
                applySelect2ToElement($(this));
            });
        });

        // -------------------------------------------------------------------------
        // Summernote WYSIWYG Editor Auto-Initialization for Long Text Areas
        // -------------------------------------------------------------------------
        function initSummernoteEditors() {
            if (typeof $.fn.summernote === 'undefined') return;

            $('textarea.summernote, textarea.summernote-editor, textarea[data-summernote]').each(function() {
                var $textarea = $(this);
                if ($textarea.hasClass('summernote-initialized') || $textarea.next('.note-editor').length) {
                    return;
                }

                var customHeight = parseInt($textarea.data('height')) || (parseInt($textarea.attr('rows')) ? Math
                    .max(parseInt($textarea.attr('rows')) * 32, 180) : 220);
                var placeholder = $textarea.attr('placeholder') || 'Write your content here...';

                // Prevent native HTML5 constraint validation error on hidden textarea
                var isRequired = $textarea.prop('required');
                if (isRequired) {
                    $textarea.removeAttr('required').attr('data-was-required', 'true');
                }

                $textarea.summernote({
                    placeholder: placeholder,
                    tabsize: 2,
                    height: customHeight,
                    minHeight: 140,
                    dialogsInBody: true,
                    dialogsFade: true,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video', 'hr']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ],
                    callbacks: {
                        onChange: function(contents) {
                            $textarea.val(contents);
                        },
                        onBlur: function() {
                            $textarea.val($textarea.summernote('code'));
                        }
                    }
                });

                $textarea.addClass('summernote-initialized');

                // Bind sync on parent form submit
                var $form = $textarea.closest('form');
                if ($form.length && !$form.data('summernote-bound')) {
                    $form.data('summernote-bound', true);
                    $form.on('submit', function(e) {
                        $form.find('textarea.summernote-initialized').each(function() {
                            var $ed = $(this);
                            var code = $ed.summernote('code');
                            $ed.val(code);

                            // Validate required fields if previously required
                            if ($ed.attr('data-was-required') === 'true' && $ed.summernote(
                                    'isEmpty')) {
                                e.preventDefault();
                                $ed.next('.note-editor').css('border-color', '#f43f5e');
                                $ed.summernote('focus');
                                return false;
                            }
                        });
                    });
                }
            });
        }

        // Summernote AngularJS directive
        adminApp.directive('summernote', ['$timeout', function($timeout) {
            return {
                restrict: 'AC',
                link: function(scope, element, attrs) {
                    $timeout(function() {
                        initSummernoteEditors();
                    }, 0);
                }
            };
        }]);

        // Auto-initialize on DOM ready
        $(document).ready(function() {
            initSummernoteEditors();
        });
        window.initSummernoteEditors = initSummernoteEditors;


        function togglePageElementsMenu() {
            const submenu = document.getElementById('pageElementsSubmenu');
            const chevron = document.getElementById('pageElementsChevron');
            if (submenu) {
                submenu.classList.toggle('hidden');
            }
            if (chevron) {
                chevron.classList.toggle('rotate-90');
            }
        }

        function toggleTopbarProfile(e) {
            if (e) e.stopPropagation();
            const menu = document.getElementById('topbarProfileMenu');
            const chevron = document.getElementById('topbarProfileChevron');
            if (menu) {
                menu.classList.toggle('hidden');
            }
            if (chevron) {
                chevron.classList.toggle('rotate-180');
            }
        }

        function toggleProfileDropdown(e) {
            if (e) e.stopPropagation();
            const menu = document.getElementById('profileDropdownMenu');
            const chevron = document.getElementById('profileChevron');
            if (menu) {
                menu.classList.toggle('hidden');
            }
            if (chevron) {
                chevron.classList.toggle('rotate-180');
            }
        }

        // Notifications Dropdown Management
        function toggleNotificationDropdown(e) {
            if (e) e.stopPropagation();
            const menu = document.getElementById('topbarNotificationMenu');
            if (!menu) return;

            // Close profile dropdowns if open
            const topProfile = document.getElementById('topbarProfileMenu');
            if (topProfile) topProfile.classList.add('hidden');
            const topChevron = document.getElementById('topbarProfileChevron');
            if (topChevron) topChevron.classList.remove('rotate-180');

            const isOpening = menu.classList.contains('hidden');
            menu.classList.toggle('hidden');

            if (isOpening) {
                fetchLatestNotifications();
            }
        }

        async function fetchLatestNotifications() {
            const listEl = document.getElementById('topbarNotificationList');
            if (!listEl) return;

            try {
                const res = await fetch("{{ route('admin.notifications.unreadCount') }}", {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) return;
                const data = await res.json();
                renderNotificationItems(data.latest || []);
                updateBadgeCounts(data.unread_count || 0);
            } catch (err) {
                console.error('Failed to load notifications:', err);
            }
        }

        function renderNotificationItems(items) {
            const listEl = document.getElementById('topbarNotificationList');
            if (!listEl) return;

            if (!items || items.length === 0) {
                listEl.innerHTML = `
                    <div class="py-8 text-center text-slate-500 text-xs space-y-1">
                        <svg class="w-6 h-6 mx-auto opacity-40 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span>No recent notifications</span>
                    </div>
                `;
                return;
            }

            let html = '';
            items.forEach(item => {
                const isUnread = !item.is_read;
                const bgClass = isUnread ? 'bg-indigo-500/10 hover:bg-indigo-500/15' : 'hover:bg-white/[0.03]';
                const unreadDot = isUnread ? '<span class="w-2 h-2 rounded-full bg-indigo-400 shrink-0"></span>' :
                    '';
                const clickUrl = item.action_url ? item.view_url : "{{ route('admin.notifications.index') }}";

                html += `
                    <a href="${clickUrl}" class="p-3.5 flex items-start gap-3 transition-colors ${bgClass} block">
                        <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center shrink-0 text-indigo-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0 space-y-0.5">
                            <div class="flex items-center justify-between gap-2">
                                <span class="font-bold text-white truncate text-xs">${item.title}</span>
                                ${unreadDot}
                            </div>
                            <p class="text-[11px] text-slate-300 truncate">${item.message}</p>
                            <span class="text-[10px] text-slate-500 font-mono block">${item.time_ago}</span>
                        </div>
                    </a>
                `;
            });
            listEl.innerHTML = html;
        }

        async function markAllNotificationsRead(e) {
            if (e) e.stopPropagation();
            try {
                const res = await fetch("{{ route('admin.notifications.markAllRead') }}", {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                if (res.ok) {
                    updateBadgeCounts(0);
                    fetchLatestNotifications();
                }
            } catch (err) {
                console.error(err);
            }
        }

        function updateBadgeCounts(count) {
            const topbarBadge = document.getElementById('topbar_notification_badge');
            const sidebarBadge = document.getElementById('sidebar_notification_badge');
            const menuUnreadText = document.getElementById('topbar_menu_unread_count');

            if (count > 0) {
                if (topbarBadge) {
                    topbarBadge.textContent = count > 99 ? '99+' : count;
                    topbarBadge.classList.remove('hidden');
                }
                if (sidebarBadge) {
                    sidebarBadge.textContent = count > 99 ? '99+' : count;
                    sidebarBadge.classList.remove('hidden');
                }
                if (menuUnreadText) {
                    menuUnreadText.textContent = `${count} unread`;
                    menuUnreadText.classList.remove('hidden');
                }
            } else {
                if (topbarBadge) topbarBadge.classList.add('hidden');
                if (sidebarBadge) sidebarBadge.classList.add('hidden');
                if (menuUnreadText) menuUnreadText.classList.add('hidden');
            }
        }

        function playNotificationChime() {
            try {
                const audioCtx = new(window.AudioContext || window.webkitAudioContext)();
                const osc = audioCtx.createOscillator();
                const gain = audioCtx.createGain();
                osc.connect(gain);
                gain.connect(audioCtx.destination);
                osc.type = 'sine';
                osc.frequency.setValueAtTime(587.33, audioCtx.currentTime);
                osc.frequency.exponentialRampToValueAtTime(880, audioCtx.currentTime + 0.15);
                gain.gain.setValueAtTime(0.08, audioCtx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 0.35);
                osc.start();
                osc.stop(audioCtx.currentTime + 0.36);
            } catch (e) {}
        }

        function showLiveToast(item) {
            const container = document.getElementById('liveNotificationToastContainer');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className =
                'pointer-events-auto p-4 rounded-2xl bg-[#0d1627] border border-indigo-500/40 shadow-[0_10px_30px_rgba(0,0,0,0.8)] backdrop-blur-xl flex items-start gap-3 transition-all duration-300 transform translate-y-2 opacity-0 text-xs font-sans';

            toast.innerHTML = `
                <div class="w-8 h-8 rounded-xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0 border border-indigo-500/30">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-2">
                        <span class="font-bold text-white text-xs">${item.title}</span>
                        <span class="text-[9px] font-mono text-indigo-400">JUST NOW</span>
                    </div>
                    <p class="text-slate-300 text-[11px] mt-0.5 line-clamp-2">${item.message}</p>
                    ${item.action_url ? `<a href="${item.action_url}" class="inline-block mt-1 text-[11px] text-indigo-400 hover:underline font-semibold">View details &rarr;</a>` : ''}
                </div>
                <button type="button" class="text-slate-400 hover:text-white font-bold text-sm leading-none ml-1 cursor-pointer">&times;</button>
            `;

            toast.querySelector('button').onclick = () => {
                toast.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => toast.remove(), 300);
            };

            container.appendChild(toast);

            // Animate in
            requestAnimationFrame(() => {
                toast.classList.remove('translate-y-2', 'opacity-0');
            });

            // Auto dismiss after 6 seconds
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.classList.add('opacity-0', 'translate-y-2');
                    setTimeout(() => toast.remove(), 300);
                }
            }, 6000);
        }

        // Live Real-Time Polling for instant updates without page reload
        let previousUnreadCount = null;
        let knownLatestNotificationId = null;

        async function checkLiveNotifications() {
            try {
                const res = await fetch("{{ route('admin.notifications.unreadCount') }}", {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) return;
                const data = await res.json();
                const count = data.unread_count || 0;
                const latest = data.latest || [];

                updateBadgeCounts(count);

                if (previousUnreadCount !== null && count > previousUnreadCount && latest.length > 0) {
                    const newest = latest[0];
                    if (newest && newest.id !== knownLatestNotificationId) {
                        knownLatestNotificationId = newest.id;
                        playNotificationChime();
                        showLiveToast(newest);

                        // If dropdown is open, re-render
                        const menu = document.getElementById('topbarNotificationMenu');
                        if (menu && !menu.classList.contains('hidden')) {
                            renderNotificationItems(latest);
                        }
                    }
                }

                previousUnreadCount = count;
                if (latest.length > 0 && knownLatestNotificationId === null) {
                    knownLatestNotificationId = latest[0].id;
                }
            } catch (err) {}
        }

        // Check on initial page load and every 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            checkLiveNotifications();
            setInterval(checkLiveNotifications, 5000);
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            // Notification popover dropdown
            const notifMenu = document.getElementById('topbarNotificationMenu');
            const notifTrigger = document.getElementById('topbarNotificationTrigger');
            if (notifMenu && !notifMenu.classList.contains('hidden')) {
                if (!notifMenu.contains(e.target) && !notifTrigger.contains(e.target)) {
                    notifMenu.classList.add('hidden');
                }
            }

            // Topbar profile dropdown
            const topMenu = document.getElementById('topbarProfileMenu');
            const topTrigger = document.getElementById('topbarProfileTrigger');
            const topChevron = document.getElementById('topbarProfileChevron');
            if (topMenu && !topMenu.classList.contains('hidden')) {
                if (!topMenu.contains(e.target) && !topTrigger.contains(e.target)) {
                    topMenu.classList.add('hidden');
                    if (topChevron) topChevron.classList.remove('rotate-180');
                }
            }

            // Sidebar profile dropup
            const menu = document.getElementById('profileDropdownMenu');
            const trigger = document.getElementById('profileDropdownTrigger');
            const chevron = document.getElementById('profileChevron');
            if (menu && !menu.classList.contains('hidden')) {
                if (!menu.contains(e.target) && !trigger.contains(e.target)) {
                    menu.classList.add('hidden');
                    if (chevron) chevron.classList.remove('rotate-180');
                }
            }
        });

        // Close dropdowns on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const notifMenu = document.getElementById('topbarNotificationMenu');
                if (notifMenu) notifMenu.classList.add('hidden');

                const topMenu = document.getElementById('topbarProfileMenu');
                const topChevron = document.getElementById('topbarProfileChevron');
                if (topMenu && !topMenu.classList.contains('hidden')) {
                    topMenu.classList.add('hidden');
                    if (topChevron) topChevron.classList.remove('rotate-180');
                }
                const menu = document.getElementById('profileDropdownMenu');
                const chevron = document.getElementById('profileChevron');
                if (menu && !menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                    if (chevron) chevron.classList.remove('rotate-180');
                }
            }
        });
    </script>

    <!-- Global Toastr Configuration & Notification Handler -->
    @include('partials.toastr')

    @stack('scripts')

    <!-- Live Real-Time Toast Container -->
    <div id="liveNotificationToastContainer"
        class="fixed top-20 right-8 z-50 flex flex-col gap-2.5 pointer-events-none max-w-sm w-full"></div>
</body>

</html>
