@extends('admin.layout')

@section('title', 'Contact Page Elements — ' . ucfirst(str_replace('_', ' ', $selectedTheme)))
@section('page_title', 'Contact Page Elements')
@section('page_subtitle', 'Table: theme_contents • Theme: ' . ucfirst(str_replace('_', ' ', $selectedTheme)))

@section('content')
    @php
        $themeDetails = \App\Models\SiteSetting::getThemeDetails($selectedTheme);
        $themeName = $themeDetails['name'] ?? ucfirst(str_replace('_', ' ', $selectedTheme));
        $themeColor = $themeDetails['color'] ?? '#6366f1';
    @endphp

    <div class="space-y-6 pb-16">
        @include('admin.pages._header', ['pageTitle' => 'Contact Page', 'pageSlug' => 'contact'])

        <!-- Two-column Layout: Section Tab Panels on Left, Sticky Sidebar with Tabs on Right -->
        <div class="page-elements-wrapper w-full">
            <!-- Main Content Area: Section Tab Panels -->
            <div class="page-elements-main">
            <!-- Tab Panel: 01 - Contact Hero Header -->
            <div id="tab-panel-hero" class="section-tab-panel">
                @include('admin.pages.contact.hero')
            </div>

            <!-- Tab Panel: 02 - Direct Channels & Info -->
            <div id="tab-panel-channels" class="section-tab-panel hidden">
                @include('admin.pages.contact.channels')
            </div>

            <!-- Tab Panel: 03 - Project Inquiry Form Settings -->
            <div id="tab-panel-form" class="section-tab-panel hidden">
                @include('admin.pages.contact.form')
            </div>

            <!-- Tab Panel: 04 - Footer Copyright & Notice -->
            <div id="tab-panel-footer" class="section-tab-panel hidden">
                @include('admin.pages.contact.footer')
            </div>

            {{-- Dynamic Panels for any additional sections from theme_contents --}}
            @php
                $renderedContactSections = ['hero', 'channels', 'form', 'footer', 'general'];
            @endphp
            @foreach ($themeSectionsData as $secKey => $rows)
                @if (!in_array($secKey, $renderedContactSections, true))
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
                'pageTitle' => 'Contact Page',
                'pageSlug' => 'contact',
                'selectedTheme' => $selectedTheme,
                'sections' => $sidebarSections,
            ])
        </div>
    </div>
@endsection
