<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="{{ $settings['site_title'] ?? 'Alex Rivera — Visual & Digital Designer' }}">

        <title>{{ $settings['site_title'] ?? 'Alex Rivera — Visual & Digital Designer' }}</title>

        <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Phosphor Icons -->
        <script src="https://unpkg.com/@phosphor-icons/web"></script>

        <!-- Theme Mode Initialization (Dark / Light / System) -->
        <script>
            (function() {
                const mode = "{{ $themeMode ?? 'system' }}";
                function resolveMode(m) {
                    if (m === 'system') {
                        return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
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
    </head>
    <body class="theme-{{ $activeTheme }} antialiased selection:bg-[#7c3aed] selection:text-white min-h-screen relative overflow-x-clip">
        
        <!-- Frontend Content (Theme is selected solely in the Admin Panel) -->
        @yield('content')

        <!-- jQuery & Toastr Handler Component -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        @include('partials.toastr')
    </body>
</html>
