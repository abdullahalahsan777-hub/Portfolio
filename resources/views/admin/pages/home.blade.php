@extends('admin.layout')

@section('title', 'Home Page Elements — ' . ucfirst(str_replace('_', ' ', $selectedTheme)))
@section('page_title', 'Home Page Elements')
@section('page_subtitle', 'Table: theme_contents • Theme: ' . ucfirst(str_replace('_', ' ', $selectedTheme)))

@section('content')
    @php
        $themeDetails = \App\Models\SiteSetting::getThemeDetails($selectedTheme);
        $themeName = $themeDetails['name'] ?? ucfirst(str_replace('_', ' ', $selectedTheme));
        $themeColor = $themeDetails['color'] ?? '#6366f1';
    @endphp

    <div class="space-y-6 pb-16">
        @include('admin.pages._header', ['pageTitle' => 'Home Page', 'pageSlug' => 'home'])

        <!-- Two-column Layout: Section Tab Panels on Left, Sticky Sidebar with Tabs on Right -->
        <div class="page-elements-wrapper w-full">
            <!-- Main Content Area: Section Tab Panels -->
            <div class="page-elements-main">
            <!-- Tab Panel: 01 - Hero Introduction & Profile Showcase -->
            <div id="tab-panel-hero" class="section-tab-panel">
                @include('admin.pages.home.hero')
            </div>

            <!-- Tab Panel: About Me & Narrative -->
            <div id="tab-panel-about" class="section-tab-panel hidden">
                @include('admin.pages.home.about')
            </div>

            <!-- Tab Panel: 02 - Key Metrics & Achievement Statistics -->
            <div id="tab-panel-stats" class="section-tab-panel hidden">
                @include('admin.pages.home.stats')
            </div>

            <!-- Tab Panel: 03 - Services Section Headlines -->
            <div id="tab-panel-services" class="section-tab-panel hidden">
                @include('admin.pages.home.services')
            </div>

            <!-- Tab Panel: 04 - Featured Projects Showcase -->
            <div id="tab-panel-projects" class="section-tab-panel hidden">
                @include('admin.pages.home.projects')
            </div>

            <!-- Tab Panel: 05 - Career & Experience Timeline -->
            <div id="tab-panel-resume" class="section-tab-panel hidden">
                @include('admin.pages.home.resume')
            </div>

            <!-- Tab Panel: 06 - Skills & Competencies -->
            <div id="tab-panel-skills" class="section-tab-panel hidden">
                @include('admin.pages.home.skills')
            </div>

            <!-- Tab Panel: 07 - Client Endorsements & Testimonials -->
            <div id="tab-panel-testimonials" class="section-tab-panel hidden">
                @include('admin.pages.home.testimonials')
            </div>

            <!-- Tab Panel: 08 - Transparent Pricing & Packages -->
            <div id="tab-panel-pricing" class="section-tab-panel hidden">
                @include('admin.pages.home.pricing')
            </div>

            <!-- Tab Panel: 09 - Articles & Insights Section -->
            <div id="tab-panel-blog" class="section-tab-panel hidden">
                @include('admin.pages.home.blog')
            </div>

            <!-- Tab Panel: FAQ Section -->
            <div id="tab-panel-faq" class="section-tab-panel hidden">
                @include('admin.pages.home.faq')
            </div>

            <!-- Tab Panel: 10 - Call-To-Action & Contact Section -->
            <div id="tab-panel-contact" class="section-tab-panel hidden">
                @include('admin.pages.home.contact')
            </div>

            <!-- Tab Panel: 11 - Website Global Footer & Socials -->
            <div id="tab-panel-footer" class="section-tab-panel hidden">
                @include('admin.pages.home.footer')
            </div>

            {{-- Dynamic Panels for any additional sections from theme_contents --}}
            @php
                $renderedHomeSections = ['hero', 'about', 'stats', 'services', 'projects', 'portfolio', 'resume', 'skills', 'testimonials', 'pricing', 'blog', 'faq', 'contact', 'footer', 'general', 'marquee'];
            @endphp
            @foreach ($themeSectionsData as $secKey => $rows)
                @if (!in_array($secKey, $renderedHomeSections, true))
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

            <!-- Right Sidebar Panel with Tabs (Dynamically retrieved from database table theme_contents) -->
            @include('admin.pages._sidebar', [
                'pageTitle' => 'Home Page',
                'pageSlug' => 'home',
                'selectedTheme' => $selectedTheme,
                'sections' => $sidebarSections,
            ])
        </div>
    </div>
@endsection
