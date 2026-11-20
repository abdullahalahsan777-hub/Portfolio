<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $settings['site_title'] ?? 'Alex Rivera — Visual & Digital Designer' }}">

    <title>{{ $settings['site_title'] ?? 'Alex Rivera — Visual & Digital Designer' }}</title>

    <!-- Google Fonts: Modern Professional Typography Suite -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Italiana&family=JetBrains+Mono:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&family=Syne:wght@600;700;800&family=Urbanist:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
        rel="stylesheet">

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- Theme Mode & Material Palette Color Initialization -->
    <script>
        (function() {
            // 1. Material Palette Custom Accent Initialization (Instant Zero-FOUC)
            try {
                const savedAccent = localStorage.getItem('portfolio_theme_color') || localStorage.getItem('laravel_theme_color') || '#00e5ff';
                const root = document.documentElement;
                root.style.setProperty('--theme-primary', savedAccent);
                const hex = savedAccent.replace('#', '');
                const r = parseInt(hex.substr(0, 2), 16) || 0;
                const g = parseInt(hex.substr(2, 2), 16) || 0;
                const b = parseInt(hex.substr(4, 2), 16) || 0;
                root.style.setProperty('--theme-primary-rgb', `${r}, ${g}, ${b}`);
                root.style.setProperty('--theme-primary-glow', `rgba(${r}, ${g}, ${b}, 0.35)`);
                const yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;
                root.style.setProperty('--theme-on-primary', (yiq >= 120) ? '#000000' : '#ffffff');
            } catch (e) {}

            // 2. Light / Dark / System Mode Initialization
            const mode = "{{ $themeMode ?? 'system' }}";

            function resolveMode(m) {
                if (m === 'system') {
                    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' :
                        'light';
                }
                return m === 'light' ? 'light' : 'dark';
            }

            function applyThemeMode(m) {
                const resolved = resolveMode(m);
                const root = document.documentElement;
                root.setAttribute('data-theme-mode', m);
                root.setAttribute('color-scheme', resolved);
                if (resolved === 'dark') {
                    root.classList.add('dark');
                    root.classList.remove('light');
                    if (document.body) {
                        document.body.classList.add('dark-mode');
                        document.body.classList.remove('light-mode');
                    }
                } else {
                    root.classList.add('light');
                    root.classList.remove('dark');
                    if (document.body) {
                        document.body.classList.add('light-mode');
                        document.body.classList.remove('dark-mode');
                    }
                }
            }
            applyThemeMode(mode);
            if (mode === 'system' && window.matchMedia) {
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function() {
                    applyThemeMode('system');
                });
            }
            document.addEventListener('DOMContentLoaded', function() {
                applyThemeMode(mode);
            });
        })();
    </script>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Pictureflect Photo Viewer Plugin -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/pictureflect/pictureflect.css') }}?v=1.2.4">
</head>

<body
    class="theme-{{ $activeTheme }} antialiased selection:bg-[#7c3aed] selection:text-white min-h-screen relative overflow-x-clip">

    <!-- Frontend Content (Theme is selected solely in the Admin Panel) -->
    <div id="mainContent">
        @yield('content')
    </div>

    <!-- Global Material Palette Switcher for All Themes -->
    @include('frontend.partials.palette-switcher')

    <!-- jQuery & Toastr Handler Component -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @include('partials.toastr')
    @include('partials.browser-logger')
    <!-- Pictureflect Photo Viewer Plugin -->
    <script src="{{ asset('assets/plugins/pictureflect/pictureflect.js') }}?v=1.2.4"></script>
</body>

</html>
