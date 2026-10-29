@php
    $activeTheme = \App\Models\SiteSetting::get('active_theme', 'graphic_designer');
    $allowedThemes = ['graphic_designer', 'developer', 'uiux_designer', 'app_developer', 'app_software_developer', 'digital_designer_illustrator'];
    if (! in_array($activeTheme, $allowedThemes, true)) {
        $activeTheme = 'graphic_designer';
    }
@endphp

@includeIf('frontend.themes.' . $activeTheme . '.index')
