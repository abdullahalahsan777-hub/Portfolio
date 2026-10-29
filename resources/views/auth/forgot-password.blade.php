<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php
        $settings = $settings ?? \App\Models\SiteSetting::all()->pluck('value', 'key')->toArray();
        $siteName = $settings['site_name'] ?? ($settings['site_title'] ?? 'Abdullah Al Ahsan');
        $siteLogoText = $settings['site_logo_text'] ?? 'Ahsan';
        $siteTitle = $settings['site_title'] ?? $siteName;
        $themeMode = \App\Models\SiteSetting::get('theme_mode', 'system');

        $hasCustomLogo =
            !empty($settings['software_logo']) &&
            file_exists(public_path($settings['software_logo'])) &&
            !str_contains($settings['software_logo'], 'defaults');
        $hasMiniLogo =
            !empty($settings['mini_logo']) &&
            file_exists(public_path($settings['mini_logo'])) &&
            !str_contains($settings['mini_logo'], 'defaults');

        $logoImage = $hasCustomLogo
            ? asset($settings['software_logo'])
            : ($hasMiniLogo
                ? asset($settings['mini_logo'])
                : null);

        $initialMonogram = strtoupper(substr($siteLogoText, 0, 1) ?: substr($siteName, 0, 1) ?: 'A');
    @endphp

    <title>Reset Password &mdash; {{ $siteName }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&family=JetBrains+Mono:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- Theme Mode strictly retrieved from Database -->
    <script>
        (function() {
            const dbThemeMode = "{{ $themeMode }}";

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

            applyThemeMode(dbThemeMode);

            if (dbThemeMode === 'system' && window.matchMedia) {
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function() {
                    applyThemeMode('system');
                });
            }

            document.addEventListener('DOMContentLoaded', function() {
                applyThemeMode(dbThemeMode);
            });
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Blueprint Grid in Dark Mode */
        html.dark .blueprint-grid,
        [color-scheme="dark"] .blueprint-grid {
            background-image:
                radial-gradient(rgba(255, 255, 255, 0.08) 1.2px, transparent 1.2px),
                linear-gradient(to right, rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 26px 26px, 130px 130px, 130px 130px;
        }

        /* Blueprint Grid in Light Mode */
        html.light .blueprint-grid,
        [color-scheme="light"] .blueprint-grid {
            background-image:
                radial-gradient(rgba(15, 23, 42, 0.08) 1.2px, transparent 1.2px),
                linear-gradient(to right, rgba(15, 23, 42, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(15, 23, 42, 0.03) 1px, transparent 1px);
            background-size: 26px 26px, 130px 130px, 130px 130px;
        }

        @keyframes pulseAura {
            0%, 100% { opacity: 0.28; transform: scale(1); }
            50% { opacity: 0.55; transform: scale(1.12); }
        }
        .anim-pulse-aura {
            animation: pulseAura 10s ease-in-out infinite;
        }
    </style>
</head>

<body
    class="bg-[#f0f3f8] dark:bg-[#05070c] text-[#0f172a] dark:text-slate-100 min-h-screen relative flex items-center justify-center p-4 sm:p-6 overflow-x-hidden font-['Plus_Jakarta_Sans'] selection:bg-[#e26d9b] selection:text-white transition-colors duration-300">

    <!-- Blueprint Canvas Background -->
    <div class="fixed inset-0 blueprint-grid pointer-events-none opacity-80 transition-opacity duration-500"></div>

    <!-- Dual Ambient Lighting -->
    <div
        class="fixed -top-32 -left-32 w-[600px] h-[600px] bg-gradient-to-tr from-[#e26d9b]/20 dark:from-[#e26d9b]/25 via-[#a855f7]/15 dark:via-[#a855f7]/20 to-transparent rounded-full blur-[140px] pointer-events-none anim-pulse-aura">
    </div>
    <div
        class="fixed -bottom-32 -right-32 w-[650px] h-[650px] bg-gradient-to-bl from-[#059669]/15 dark:from-[#00ff88]/20 via-[#06b6d4]/10 dark:via-[#06b6d4]/15 to-transparent rounded-full blur-[150px] pointer-events-none anim-pulse-aura"
        style="animation-delay: -5s;"></div>

    <!-- Central Password Reset Container -->
    <div class="w-full max-w-md relative z-20 space-y-6">

        <!-- Brand Header -->
        <div class="text-center space-y-3">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3.5 group">
                <div
                    class="w-13 h-13 rounded-2xl bg-gradient-to-tr from-[#e26d9b] via-[#a855f7] to-[#00ff88] p-[1.5px] shadow-xl group-hover:scale-105 group-hover:shadow-[0_0_25px_rgba(226,109,155,0.4)] transition-all duration-300">
                    <div
                        class="w-full h-full rounded-[14px] bg-white dark:bg-[#090c13] flex items-center justify-center p-2 overflow-hidden shadow-inner transition-colors duration-300">
                        @if (!empty($logoImage))
                            <img src="{{ $logoImage }}" alt="{{ $siteLogoText }}" class="w-full h-full object-contain">
                        @else
                            <span
                                class="font-extrabold text-2xl font-['Outfit'] text-transparent bg-clip-text bg-gradient-to-tr from-[#e26d9b] via-[#a855f7] to-[#00ff88]">
                                {{ $initialMonogram }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="text-left">
                    <span
                        class="font-bold text-2xl sm:text-3xl tracking-tight text-[#0f172a] dark:text-white font-['Outfit'] block leading-tight transition-colors duration-300">
                        {{ $siteName }}<span class="text-[#e26d9b]">.</span>
                    </span>
                    <span
                        class="text-[11px] font-mono text-slate-500 dark:text-white/50 tracking-wider uppercase block">
                        Password Recovery &bull; Account Access
                    </span>
                </div>
            </a>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                Enter your registered email address to receive password reset instructions.
            </p>
        </div>

        <!-- Main Glass Card Container -->
        <div
            class="relative p-7 sm:p-9 rounded-3xl bg-white/85 dark:bg-[#0b0e14]/90 backdrop-blur-2xl border border-black/10 dark:border-white/10 shadow-[0_25px_70px_rgba(15,23,42,0.08)] dark:shadow-[0_25px_70px_rgba(0,0,0,0.7)] space-y-6 overflow-hidden transition-all duration-300">

            <!-- Card Top Iridescent Glow Line -->
            <div
                class="absolute top-0 left-0 right-0 h-[2.5px] bg-gradient-to-r from-[#e26d9b] via-[#a855f7] to-[#00ff88]">
            </div>

            <!-- Lock Icon Visual Badge -->
            <div class="flex items-center justify-center pt-1">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#e26d9b]/20 to-[#a855f7]/20 border border-[#e26d9b]/30 flex items-center justify-center text-[#e26d9b] text-2xl shadow-inner">
                    <i class="ph ph-shield-check"></i>
                </div>
            </div>

            <!-- Session Status Alert -->
            @if (session('status'))
                <div
                    class="p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-700 dark:text-emerald-400 text-xs font-medium flex items-center gap-2">
                    <i class="ph ph-check-circle text-base"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="p-3.5 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-700 dark:text-rose-400 text-xs font-medium flex items-center gap-2">
                    <i class="ph ph-warning-circle text-base"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Forgot Password Request Form -->
            <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email"
                        class="block text-xs font-mono text-slate-700 dark:text-slate-300 mb-1.5 font-medium">Email
                        Address</label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500 text-base">
                            <i class="ph ph-envelope"></i>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            autofocus placeholder="name@example.com"
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-black/[0.03] dark:bg-black/40 border border-black/15 dark:border-white/10 text-[#0f172a] dark:text-white placeholder-slate-400 dark:placeholder-slate-500 text-sm focus:outline-none focus:bg-white dark:focus:bg-black/60 focus:border-[#e26d9b] focus:ring-1 focus:ring-[#e26d9b] transition-all">
                    </div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1.5">
                        We will send a single-use verification link valid for 60 minutes.
                    </p>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3.5 px-5 rounded-xl font-extrabold text-xs uppercase tracking-wider text-white bg-gradient-to-r from-[#e26d9b] via-[#9333ea] to-[#00ff88] hover:opacity-95 shadow-xl hover:shadow-[0_0_30px_rgba(226,109,155,0.4)] transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0 cursor-pointer flex items-center justify-center gap-2">
                    <i class="ph ph-paper-plane-tilt text-base font-bold"></i>
                    <span>Email Password Reset Link</span>
                </button>
            </form>

            <!-- Footer Navigation Links -->
            <div
                class="pt-5 border-t border-black/5 dark:border-white/10 text-xs text-slate-500 dark:text-slate-400 flex items-center justify-between">
                <a href="{{ route('login') }}"
                    class="hover:text-[#0f172a] dark:hover:text-white transition-colors flex items-center gap-1 group font-medium">
                    <span class="group-hover:-translate-x-1 transition-transform">&larr;</span>
                    <span>Back to Sign In</span>
                </a>
                <a href="{{ route('home') }}"
                    class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 font-medium">
                    <span>Back to Home</span>
                </a>
            </div>
        </div>
    </div>

    <!-- jQuery & Toastr Notification Component -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @include('partials.toastr')
</body>

</html>

