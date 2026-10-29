@extends('admin.layout')

@section('title', 'About Page Elements — ' . ucfirst(str_replace('_', ' ', $selectedTheme)))
@section('page_title', 'About Page Elements')
@section('page_subtitle', 'Table: theme_contents • Theme: ' . ucfirst(str_replace('_', ' ', $selectedTheme)))

@section('content')
    @php
        $themeDetails = \App\Models\SiteSetting::getThemeDetails($selectedTheme);
        $themeName = $themeDetails['name'] ?? ucfirst(str_replace('_', ' ', $selectedTheme));
        $themeColor = $themeDetails['color'] ?? '#6366f1';
    @endphp

    <div class="space-y-6 pb-16">
        @include('admin.pages._header', ['pageTitle' => 'About Page', 'pageSlug' => 'about'])

        <!-- Two-column Layout: Section Tab Panels on Left, Sticky Sidebar with Tabs on Right -->
        <div class="page-elements-wrapper w-full">
            <!-- Main Content Area: Section Tab Panels -->
            <div class="page-elements-main">
            <!-- Tab Panel: 01 - About Hero Header -->
            <div id="tab-panel-hero" class="section-tab-panel">
                @include('admin.pages.about.hero')
            </div>

            <!-- Tab Panel: 02 - Editorial Narrative & Portrait -->
            <div id="tab-panel-narrative" class="section-tab-panel hidden">
                @include('admin.pages.about.narrative')
            </div>

            <!-- Tab Panel: 03 - Achievement Metrics & Deliverables -->
            <div id="tab-panel-metrics" class="section-tab-panel hidden">
                @include('admin.pages.about.metrics')
            </div>

            <!-- Tab Panel: 04 - Philosophy Quote & Bio -->
            <div id="tab-panel-philosophy" class="section-tab-panel hidden">
                @include('admin.pages.about.philosophy')
            </div>

            {{-- Dynamic Panels for any additional sections from theme_contents --}}
            @php
                $renderedAboutSections = ['hero', 'narrative', 'metrics', 'philosophy', 'general'];
            @endphp
            @foreach ($themeSectionsData as $secKey => $rows)
                @if (!in_array($secKey, $renderedAboutSections, true))
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
                'pageTitle' => 'About Page',
                'pageSlug' => 'about',
                'selectedTheme' => $selectedTheme,
                'sections' => $sidebarSections,
            ])
        </div>
    </div>
@endsection
