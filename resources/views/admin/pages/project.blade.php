@extends('admin.layout')

@section('title', 'Project Page Elements — ' . ucfirst(str_replace('_', ' ', $selectedTheme)))
@section('page_title', 'Project Page Elements')
@section('page_subtitle', 'Table: theme_contents • Theme: ' . ucfirst(str_replace('_', ' ', $selectedTheme)))

@section('content')
    @php
        $themeDetails = \App\Models\SiteSetting::getThemeDetails($selectedTheme);
        $themeName = $themeDetails['name'] ?? ucfirst(str_replace('_', ' ', $selectedTheme));
        $themeColor = $themeDetails['color'] ?? '#6366f1';
    @endphp

    <div class="space-y-6 pb-16">
        @include('admin.pages._header', ['pageTitle' => 'Project Page', 'pageSlug' => 'project'])

        <!-- Quick link to dynamic projects list -->
        <div class="p-4 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
            <div class="flex items-center gap-3">
                <span class="w-8 h-8 rounded-xl bg-indigo-600/30 text-indigo-400 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <span class="text-slate-300">
                    Looking to add or reorder individual portfolio case studies? Manage them directly in the
                    <strong class="text-white">Projects Resource Manager</strong>.
                </span>
            </div>
            <a href="{{ route('admin.projects.index') }}"
                class="px-3.5 py-1.5 rounded-lg font-bold text-white bg-indigo-600 hover:bg-indigo-500 transition-all shrink-0">
                Manage Projects &rarr;
            </a>
        </div>

        <!-- Two-column Layout: Section Tab Panels on Left, Sticky Sidebar with Tabs on Right -->
        <div class="page-elements-wrapper w-full">
            <!-- Main Content Area: Section Tab Panels -->
            <div class="page-elements-main">
            <!-- Tab Panel: 01 - Project Page Hero Header -->
            <div id="tab-panel-hero" class="section-tab-panel">
                @include('admin.pages.project.hero')
            </div>

            <!-- Tab Panel: 02 - Portfolio Grid Settings -->
            <div id="tab-panel-grid" class="section-tab-panel hidden">
                @include('admin.pages.project.grid')
            </div>

            <!-- Tab Panel: 03 - Project Inquiry CTA Banner -->
            <div id="tab-panel-footer" class="section-tab-panel hidden">
                @include('admin.pages.project.footer')
            </div>

            {{-- Dynamic Panels for any additional sections from theme_contents --}}
            @php
                $renderedProjectSections = ['hero', 'grid', 'footer', 'general'];
            @endphp
            @foreach ($themeSectionsData as $secKey => $rows)
                @if (!in_array($secKey, $renderedProjectSections, true))
                    <div id="tab-panel-{{ $secKey }}" class="section-tab-panel hidden">
                        @include('admin.pages._dynamic_section', [
                            'sectionKey' => $secKey,
                            'sectionTitle' => ucfirst(str_replace('_', ' ', $secKey)),
                            'rows' => $rows,
                        ])
                    </div>
                @endif
            @endforeach
            </div>

            <!-- Right Sidebar Panel with Tabs -->
            @include('admin.pages._sidebar', [
                'pageTitle' => 'Project Page',
                'pageSlug' => 'project',
                'selectedTheme' => $selectedTheme,
                'sections' => $sidebarSections,
            ])
        </div>
    </div>
@endsection
