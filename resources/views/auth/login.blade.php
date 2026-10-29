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

        // Check for custom uploaded logo or default svg
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

    <title>Sign In &mdash; {{ $siteName }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&family=JetBrains+Mono:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- Theme Mode strictly retrieved from Database (Light / Dark / System) -->
    <script>
        (function() {
            const dbThemeMode = "{{ $themeMode }}";

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

            // Immediately apply database theme mode
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

        @keyframes floatGentle {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-8px) rotate(0.5deg);
            }
        }

        @keyframes floatGentleAlt {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(10px) rotate(-0.5deg);
            }
        }

        @keyframes pulseAura {

            0%,
            100% {
                opacity: 0.28;
                transform: scale(1);
            }

            50% {
                opacity: 0.55;
                transform: scale(1.12);
            }
        }

        @keyframes strokeFlow {
            0% {
                stroke-dashoffset: 260;
            }

            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes spinSlow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes cursorBlink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }
        }

        .anim-float-left {
            animation: floatGentle 8s ease-in-out infinite;
        }

        .anim-float-right {
            animation: floatGentleAlt 9s ease-in-out infinite;
        }

        .anim-pulse-aura {
            animation: pulseAura 10s ease-in-out infinite;
        }

        .bezier-curve-anim {
            stroke-dasharray: 260;
            animation: strokeFlow 4s ease-in-out infinite alternate;
        }

        .anim-spin-slow {
            animation: spinSlow 24s linear infinite;
        }

        .cursor-blink {
            animation: cursorBlink 1s infinite;
        }
    </style>
</head>

<body
    class="bg-[#f0f3f8] dark:bg-[#05070c] text-[#0f172a] dark:text-slate-100 min-h-screen relative flex items-center justify-center p-4 sm:p-6 overflow-x-hidden font-['Plus_Jakarta_Sans'] selection:bg-[#e26d9b] selection:text-white transition-colors duration-300">

    <div class="fixed inset-0 blueprint-grid pointer-events-none opacity-80 transition-opacity duration-500"></div>

    <!-- 2. Dual Ambient Lighting (Designer Rose on Left / Developer Emerald on Right) -->
    <div
        class="fixed -top-32 -left-32 w-[600px] h-[600px] bg-gradient-to-tr from-[#e26d9b]/20 dark:from-[#e26d9b]/25 via-[#a855f7]/15 dark:via-[#a855f7]/20 to-transparent rounded-full blur-[140px] pointer-events-none anim-pulse-aura">
    </div>
    <div class="fixed -bottom-32 -right-32 w-[650px] h-[650px] bg-gradient-to-bl from-[#059669]/15 dark:from-[#00ff88]/20 via-[#06b6d4]/10 dark:via-[#06b6d4]/15 to-transparent rounded-full blur-[150px] pointer-events-none anim-pulse-aura"
        style="animation-delay: -5s;"></div>
    <div
        class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-gradient-to-r from-[#e26d9b]/5 via-[#6366f1]/8 to-[#00ff88]/5 rounded-full blur-[130px] pointer-events-none">
    </div>

    <div
        class="fixed left-5 lg:left-8 2xl:left-14 top-1/2 -translate-y-1/2 hidden xl:block w-84 2xl:w-92 pointer-events-none select-none z-10 anim-float-left">
        <div
            class="relative p-5 rounded-3xl bg-white/85 dark:bg-[#0c0f18]/85 backdrop-blur-2xl border border-slate-200/80 dark:border-white/10 shadow-[0_25px_60px_rgba(226,109,155,0.14)] dark:shadow-[0_25px_60px_rgba(0,0,0,0.65)] space-y-4 transition-all duration-300">

            <!-- Card Top Corner Accent Ribbon -->
            <div
                class="absolute -top-px left-12 right-12 h-[2px] bg-gradient-to-r from-transparent via-[#e26d9b] to-transparent">
            </div>

            <!-- Studio Header with 3D Gradient Icon Badge -->
            <div class="flex items-center justify-between border-b border-black/5 dark:border-white/10 pb-3">
                <div class="flex items-center gap-2.5">
                    <div
                        class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-[#e26d9b] via-[#a855f7] to-[#00ff88] p-[1.5px] shadow-md">
                        <div
                            class="w-full h-full rounded-[14px] bg-white dark:bg-[#0c0f18] flex items-center justify-center text-[#e26d9b] text-lg">
                            <i class="ph ph-cube-transparent"></i>
                        </div>
                    </div>
                    <div>
                        <span
                            class="text-xs font-bold text-[#0f172a] dark:text-white font-['Outfit'] block leading-tight">Spatial
                            Canvas &bull; 3D</span>
                        <span class="text-[10px] font-mono text-slate-500 dark:text-white/50">Spline / WebGL 2.0
                            Engine</span>
                    </div>
                </div>
                <span
                    class="text-[9px] font-mono px-2 py-0.5 rounded-full bg-[#e26d9b]/15 border border-[#e26d9b]/30 text-[#e26d9b] font-bold flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#e26d9b] animate-ping"></span>
                    <span>60 FPS</span>
                </span>
            </div>

            <!-- Live 3D Isometric Viewport & Bezier Spline Canvas -->
            <div
                class="p-4 rounded-2xl bg-slate-50/90 dark:bg-black/40 border border-black/5 dark:border-white/5 relative overflow-hidden transition-colors duration-300">
                <svg viewBox="0 0 250 82" class="w-full h-18 stroke-current">
                    <defs>
                        <linearGradient id="vectorGradCanvas" x1="0%" y1="0%" x2="100%"
                            y2="0%">
                            <stop offset="0%" stop-color="#e26d9b" />
                            <stop offset="45%" stop-color="#a855f7" />
                            <stop offset="100%" stop-color="#00ff88" />
                        </linearGradient>
                        <linearGradient id="cubeFaceGrad" x1="0%" y1="0%" x2="100%"
                            y2="100%">
                            <stop offset="0%" stop-color="#e26d9b" stop-opacity="0.35" />
                            <stop offset="100%" stop-color="#a855f7" stop-opacity="0.1" />
                        </linearGradient>
                    </defs>

                    <!-- Perspective Grid Plane -->
                    <path d="M 0 45 L 250 45" stroke="currentColor" class="text-black/[0.08] dark:text-white/[0.08]"
                        stroke-dasharray="3,3" fill="none" />
                    <path d="M 125 0 L 125 82" stroke="currentColor" class="text-black/[0.05] dark:text-white/[0.05]"
                        stroke-dasharray="2,2" fill="none" />
                    <path d="M 40 82 L 100 0" stroke="currentColor" class="text-black/[0.03] dark:text-white/[0.04]"
                        stroke-dasharray="2,3" fill="none" />
                    <path d="M 210 82 L 150 0" stroke="currentColor" class="text-black/[0.03] dark:text-white/[0.04]"
                        stroke-dasharray="2,3" fill="none" />

                    <!-- Floating 3D Isometric Prism Geometry -->
                    <g transform="translate(198, 14)">
                        <!-- Top Face -->
                        <polygon points="16,0 30,7 16,14 2,7" fill="url(#cubeFaceGrad)" stroke="#a855f7"
                            stroke-width="0.9" />
                        <!-- Left Face -->
                        <polygon points="2,7 16,14 16,28 2,21" fill="rgba(226,109,155,0.2)" stroke="#e26d9b"
                            stroke-width="0.9" />
                        <!-- Right Face -->
                        <polygon points="16,14 30,7 30,21 16,28" fill="rgba(0,255,136,0.15)" stroke="#00ff88"
                            stroke-width="0.9" />
                    </g>

                    <!-- Animated Cubic Spline Wave -->
                    <path class="bezier-curve-anim" d="M 10 58 C 45 10, 85 70, 145 16 S 190 42, 238 22"
                        stroke="url(#vectorGradCanvas)" stroke-width="2.6" fill="none" stroke-linecap="round" />

                    <!-- Tangent Vector Guides -->
                    <line x1="45" y1="10" x2="28" y2="34" stroke="rgba(226,109,155,0.7)"
                        stroke-width="1.2" stroke-dasharray="2,2" />
                    <line x1="145" y1="16" x2="170" y2="4" stroke="rgba(0,255,136,0.7)"
                        stroke-width="1.2" stroke-dasharray="2,2" />

                    <!-- Control Points / Anchors -->
                    <circle cx="45" cy="10" r="4" fill="#e26d9b" stroke="#ffffff" stroke-width="2" />
                    <circle cx="145" cy="16" r="4" fill="#00ff88" stroke="#ffffff" stroke-width="2" />
                </svg>

                <!-- Live Vector Coordinates & Active Tool -->
                <div
                    class="flex items-center justify-between text-[10px] font-mono text-slate-500 dark:text-white/40 mt-1.5 pt-1.5 border-t border-black/5 dark:border-white/5">
                    <span class="flex items-center gap-1 text-[#e26d9b] font-bold">
                        <i class="ph ph-pen-nib"></i> P₁: (45, 12)
                    </span>
                    <span class="px-1.5 py-0.5 rounded bg-black/5 dark:bg-white/5 font-semibold text-[9px] text-[#a855f7]">κ =
                        0.984</span>
                    <span class="text-emerald-600 dark:text-[#00ff88] font-bold">P₂: (145, 16)</span>
                </div>
            </div>

            <!-- Layer & Shader Component Tree -->
            <div class="space-y-1.5 text-xs font-mono">
                <span class="text-[10px] uppercase tracking-wider text-slate-400 dark:text-white/40 block">Component
                    Tree &bull; Layers</span>
                <div class="space-y-1">
                    <div
                        class="px-2.5 py-1.5 rounded-xl bg-black/[0.03] dark:bg-white/[0.04] border border-black/5 dark:border-white/5 flex items-center justify-between text-[11px] text-[#0f172a] dark:text-white/90">
                        <span class="flex items-center gap-2">
                            <i class="ph ph-cube text-[#e26d9b]"></i>
                            <span>Hero_3D_Spline.blend</span>
                        </span>
                        <span class="text-[9px] text-[#a855f7] bg-[#a855f7]/10 px-1.5 py-0.5 rounded font-bold">Mesh ✦
                            PBR</span>
                    </div>
                    <div
                        class="px-2.5 py-1.5 rounded-xl bg-black/[0.02] dark:bg-white/[0.02] border border-black/5 dark:border-white/5 flex items-center justify-between text-[11px] text-slate-600 dark:text-white/70">
                        <span class="flex items-center gap-2">
                            <i class="ph ph-bezier-curve text-sky-500"></i>
                            <span>GoldenRatio_Grid.svg</span>
                        </span>
                        <span class="text-[9px] text-slate-400 font-medium">&phi; 1.618</span>
                    </div>
                </div>
            </div>

            <!-- Dynamic Design Tokens Palette -->
            <div class="space-y-1.5">
                <span
                    class="text-[10px] font-mono uppercase tracking-wider text-slate-400 dark:text-white/40 block">Design
                    Tokens Palette</span>
                <div class="grid grid-cols-4 gap-1.5">
                    <div class="h-8 rounded-xl bg-[#e26d9b] flex flex-col items-center justify-center text-[9px] font-mono font-bold text-white shadow-sm hover:scale-105 transition-transform"
                        title="Poppy Rose">
                        <span>#e26d9b</span>
                    </div>
                    <div class="h-8 rounded-xl bg-[#a855f7] flex flex-col items-center justify-center text-[9px] font-mono font-bold text-white shadow-sm hover:scale-105 transition-transform"
                        title="Cyber Violet">
                        <span>#a855f7</span>
                    </div>
                    <div class="h-8 rounded-xl bg-[#00ff88] flex flex-col items-center justify-center text-[9px] font-mono font-bold text-black shadow-sm hover:scale-105 transition-transform"
                        title="Neon Emerald">
                        <span>#00ff88</span>
                    </div>
                    <div class="h-8 rounded-xl bg-[#38bdf8] flex flex-col items-center justify-center text-[9px] font-mono font-bold text-black shadow-sm hover:scale-105 transition-transform"
                        title="Sky Cyan">
                        <span>#38bdf8</span>
                    </div>
                </div>
            </div>

            <!-- Precision Studio Specs Pill -->
            <div
                class="flex items-center justify-between pt-1 border-t border-black/5 dark:border-white/10 text-[11px] text-slate-600 dark:text-white/60 font-mono">
                <span class="flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#e26d9b]"></span>
                    <span>Kerning: -0.025em</span>
                </span>
                <span class="text-emerald-600 dark:text-[#00ff88] font-bold">100% Studio</span>
            </div>
        </div>
    </div>

    <div
        class="fixed right-5 lg:right-8 2xl:right-14 top-1/2 -translate-y-1/2 hidden xl:block w-88 2xl:w-96 pointer-events-none select-none z-10 anim-float-right">
        <div
            class="relative p-5 rounded-3xl bg-white/90 dark:bg-[#080b13]/90 backdrop-blur-2xl border border-slate-200/80 dark:border-white/10 shadow-[0_25px_60px_rgba(5,150,105,0.12)] dark:shadow-[0_25px_60px_rgba(0,0,0,0.75)] space-y-3.5 font-mono transition-all duration-300">

            <!-- Card Top Corner Accent Ribbon -->
            <div
                class="absolute -top-px left-12 right-12 h-[2px] bg-gradient-to-r from-transparent via-[#00ff88] to-transparent">
            </div>

            <!-- IDE Window Chrome with Traffic Lights and File Tabs -->
            <div class="flex items-center justify-between border-b border-black/5 dark:border-white/10 pb-3">
                <div class="flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#ff5f56] inline-block shadow-sm"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-[#ffbd2e] inline-block shadow-sm"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-[#27c93f] inline-block shadow-sm"></span>
                </div>

                <!-- Active File Ribbon -->
                <div class="flex items-center gap-1">
                    <div
                        class="px-2.5 py-1 rounded-lg bg-black/5 dark:bg-white/10 border border-black/5 dark:border-white/10 text-[11px] font-bold flex items-center gap-1.5 text-sky-600 dark:text-sky-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                        <span>Kernel.ts</span>
                    </div>
                    <div class="px-2 py-1 rounded-lg text-[10px] text-slate-400 dark:text-white/40">
                        <span>pipeline.config</span>
                    </div>
                </div>

                <span
                    class="text-[9px] text-[#00ff88] bg-[#00ff88]/10 px-2 py-0.5 rounded-full border border-[#00ff88]/30 font-bold">HTTP/3</span>
            </div>

            <!-- Syntax-Highlighted Architecture Code Editor -->
            <div
                class="text-[11px] font-['Fira_Code','JetBrains_Mono',monospace] leading-relaxed p-4 rounded-2xl bg-slate-100/90 dark:bg-black/50 border border-black/5 dark:border-white/5 space-y-1 transition-colors duration-300">
                <div class="flex items-center gap-2">
                    <span class="text-slate-400 dark:text-white/20 select-none w-5 text-right">01</span>
                    <div>
                        <span class="text-purple-600 dark:text-[#a855f7] font-semibold">import</span> { <span
                            class="text-sky-600 dark:text-[#38bdf8]">Design</span>, <span
                            class="text-emerald-600 dark:text-[#00ff88]">Engine</span> } <span
                            class="text-purple-600 dark:text-[#a855f7] font-semibold">from</span> <span
                            class="text-rose-600 dark:text-[#e26d9b]">'@portfolio'</span>;
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-slate-400 dark:text-white/20 select-none w-5 text-right">02</span>
                    <div>
                        <span class="text-purple-600 dark:text-[#a855f7] font-semibold">export async function</span>
                        <span class="text-amber-600 dark:text-[#fbbf24] font-bold">synthesize</span>() {
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-slate-400 dark:text-white/20 select-none w-5 text-right">03</span>
                    <div class="pl-4">
                        <span class="text-purple-600 dark:text-[#a855f7] font-semibold">const</span> <span
                            class="text-[#0f172a] dark:text-white font-medium">pipeline</span> = <span
                            class="text-purple-600 dark:text-[#a855f7] font-semibold">await</span> Engine.<span
                            class="text-sky-600 dark:text-[#38bdf8]">ignite</span>({
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-slate-400 dark:text-white/20 select-none w-5 text-right">04</span>
                    <div class="pl-8 text-slate-500 dark:text-white/70">
                        aesthetic: <span class="text-rose-600 dark:text-[#e26d9b] font-medium">'Poetic
                            Precision'</span>,
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-slate-400 dark:text-white/20 select-none w-5 text-right">05</span>
                    <div class="pl-8 text-slate-500 dark:text-white/70">
                        latency: <span class="text-emerald-600 dark:text-[#00ff88] font-bold">'Sub-6ms Global
                            Edge'</span>,
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-slate-400 dark:text-white/20 select-none w-5 text-right">06</span>
                    <div class="pl-8 text-slate-500 dark:text-white/70">
                        lighthouse: <span class="text-amber-600 dark:text-[#fbbf24] font-bold">100</span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-slate-400 dark:text-white/20 select-none w-5 text-right">07</span>
                    <div class="pl-4">
                        });
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-slate-400 dark:text-white/20 select-none w-5 text-right">08</span>
                    <div class="pl-4">
                        <span class="text-purple-600 dark:text-[#a855f7] font-semibold">return</span> pipeline.<span
                            class="text-emerald-600 dark:text-[#00ff88]">render</span>(); <span
                            class="text-slate-400 dark:text-white/40">// 200 OK 🚀</span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-slate-400 dark:text-white/20 select-none w-5 text-right">09</span>
                    <div>}</div>
                </div>
            </div>

            <!-- Live Terminal Interactive Shell Box -->
            <div
                class="p-2.5 rounded-xl bg-black/[0.03] dark:bg-white/[0.03] border border-black/5 dark:border-white/5 flex items-center justify-between text-[11px]">
                <div class="flex items-center gap-2 text-slate-600 dark:text-white/80">
                    <span class="text-emerald-600 dark:text-[#00ff88] font-bold">❯</span>
                    <span>pnpm deploy --prod --turbo</span>
                    <span class="w-2 h-4 bg-emerald-500 dark:bg-[#00ff88] inline-block cursor-blink"></span>
                </div>
                <span class="text-[9px] text-slate-400 dark:text-white/40 font-mono">0.38s</span>
            </div>

            <!-- Telemetry & Edge Health Metrics -->
            <div
                class="pt-2 border-t border-black/5 dark:border-white/10 flex items-center justify-between text-[10px]">
                <span class="text-emerald-600 dark:text-emerald-400 flex items-center gap-1.5 font-bold">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Edge: 6ms &bull; 100/100 Vitals
                </span>
                <span class="text-slate-500 dark:text-white/50">Build: 0 errors</span>
            </div>
        </div>
    </div>

    <!-- Main Login Card -->
    <div class="w-full max-w-md relative z-20 space-y-6">

        <!-- Brand Header (Retrieved from Database) -->
        <div class="text-center space-y-3">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3.5 group">

                <!-- Dynamic Database Logo Badge -->
                <div
                    class="w-13 h-13 rounded-2xl bg-gradient-to-tr from-[#e26d9b] via-[#a855f7] to-[#00ff88] p-[1.5px] shadow-xl group-hover:scale-105 group-hover:shadow-[0_0_25px_rgba(226,109,155,0.4)] transition-all duration-300">
                    <div
                        class="w-full h-full rounded-[14px] bg-white dark:bg-[#090c13] flex items-center justify-center p-2 overflow-hidden shadow-inner transition-colors duration-300">
                        @if (!empty($logoImage))
                            <img src="{{ $logoImage }}" alt="{{ $siteLogoText }}"
                                class="w-full h-full object-contain">
                        @else
                            <span
                                class="font-extrabold text-2xl font-['Outfit'] text-transparent bg-clip-text bg-gradient-to-tr from-[#e26d9b] via-[#a855f7] to-[#00ff88]">
                                {{ $initialMonogram }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Dynamic Database Site Name & Logo Text -->
                <div class="text-left">
                    <span
                        class="font-bold text-2xl sm:text-3xl tracking-tight text-[#0f172a] dark:text-white font-['Outfit'] block leading-tight transition-colors duration-300">
                        {{ $siteName }}<span class="text-[#e26d9b]">.</span>
                    </span>
                    <span
                        class="text-[11px] font-mono text-slate-500 dark:text-white/50 tracking-wider uppercase block">
                        {{ $siteLogoText }} &bull; Portfolio Platform
                    </span>
                </div>
            </a>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Access the Admin Control Panel or Client
                Portal</p>
        </div>

        <!-- Main Glass Card Container (Full Dark & Light Adaptability) -->
        <div
            class="relative p-7 sm:p-9 rounded-3xl bg-white/85 dark:bg-[#0b0e14]/90 backdrop-blur-2xl border border-black/10 dark:border-white/10 shadow-[0_25px_70px_rgba(15,23,42,0.08)] dark:shadow-[0_25px_70px_rgba(0,0,0,0.7)] space-y-6 overflow-hidden transition-all duration-300">

            <!-- Card Top Iridescent Glow Line -->
            <div
                class="absolute top-0 left-0 right-0 h-[2.5px] bg-gradient-to-r from-[#e26d9b] via-[#a855f7] to-[#00ff88]">
            </div>

            <!-- Maintenance Notification (if active) -->
            @if (!empty($isMaintenance))
                <div
                    class="p-4 rounded-2xl bg-amber-500/10 border border-amber-500/30 text-amber-700 dark:text-amber-300 text-xs space-y-1.5">
                    <div class="font-bold flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                        <span>Maintenance Mode Active</span>
                    </div>
                    <p class="text-[11px] text-amber-800/80 dark:text-amber-200/80 leading-relaxed">
                        The public portfolio is currently offline for scheduled maintenance.
                        <strong>Admin login remains active</strong> so administrators can access system controls.
                    </p>
                </div>
            @endif

            <!-- Session Flash Messages -->
            @if (session('status'))
                <div
                    class="p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-700 dark:text-emerald-400 text-xs font-medium flex items-center gap-2">
                    <i class="ph ph-check-circle text-base"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if (session('success'))
                <div
                    class="p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-700 dark:text-emerald-400 text-xs font-medium flex items-center gap-2">
                    <i class="ph ph-check-circle text-base"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="p-3.5 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-700 dark:text-rose-400 text-xs font-medium flex items-center gap-2">
                    <i class="ph ph-warning-circle text-base"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Caps Lock Warning Toast (Live Indicator) -->
            <div id="capsLockWarning"
                class="hidden p-2.5 rounded-xl bg-amber-500/15 border border-amber-500/30 text-amber-700 dark:text-amber-300 text-xs font-mono flex items-center gap-2 animate-pulse">
                <i class="ph ph-warning text-base"></i>
                <span>Notice: Caps Lock is currently ON</span>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
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
                            autofocus placeholder="admin@portfolio.local"
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-black/[0.03] dark:bg-black/40 border border-black/15 dark:border-white/10 text-[#0f172a] dark:text-white placeholder-slate-400 dark:placeholder-slate-500 text-sm focus:outline-none focus:bg-white dark:focus:bg-black/60 focus:border-[#e26d9b] focus:ring-1 focus:ring-[#e26d9b] transition-all">
                    </div>
                </div>

                <!-- Password Field with Interactive Show/Hide Toggle -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password"
                            class="block text-xs font-mono text-slate-700 dark:text-slate-300 font-medium">Password</label>
                        <a href="{{ route('password.request') }}"
                            class="text-xs text-[#e26d9b] hover:text-[#c45380] dark:text-[#f472b6] dark:hover:text-[#f9a8d4] font-medium transition-colors hover:underline">
                            Forgot password?
                        </a>
                    </div>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500 text-base">
                            <i class="ph ph-lock-key"></i>
                        </div>
                        <input type="password" id="password" name="password" required
                            placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                            class="w-full pl-10 pr-11 py-3 rounded-xl bg-black/[0.03] dark:bg-black/40 border border-black/15 dark:border-white/10 text-[#0f172a] dark:text-white placeholder-slate-400 dark:placeholder-slate-500 text-sm focus:outline-none focus:bg-white dark:focus:bg-black/60 focus:border-[#00ff88] focus:ring-1 focus:ring-[#00ff88] transition-all">
                        <!-- Password Toggle Eye Button -->
                        <button type="button" id="togglePasswordBtn"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-700 dark:text-slate-500 dark:hover:text-white transition-colors cursor-pointer"
                            title="Show / Hide Password">
                            <i id="eyeIcon" class="ph ph-eye text-base"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me Option -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label
                        class="flex items-center gap-2 cursor-pointer text-slate-600 dark:text-slate-300 select-none">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-black/20 dark:border-white/20 bg-black/[0.04] dark:bg-black/40 text-[#e26d9b] focus:ring-0 focus:ring-offset-0 cursor-pointer">
                        <span>Keep me signed in</span>
                    </label>
                </div>

                <!-- Dual Gradient Submit Button -->
                <button type="submit"
                    class="w-full py-3.5 px-5 rounded-xl font-extrabold text-xs uppercase tracking-wider text-white bg-gradient-to-r from-[#e26d9b] via-[#9333ea] to-[#00ff88] hover:opacity-95 shadow-xl hover:shadow-[0_0_30px_rgba(226,109,155,0.4)] transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0 cursor-pointer flex items-center justify-center gap-2">
                    <span>Sign In to Account</span>
                    <i class="ph ph-arrow-right text-base font-bold"></i>
                </button>
            </form>

            <!-- Social Login Divider -->
            <div class="relative flex items-center justify-center my-1 pt-1">
                <div class="w-full border-t border-black/10 dark:border-white/10"></div>
                <span
                    class="absolute px-3 bg-[#f6f8fb] dark:bg-[#0c0f17] text-[10px] font-mono text-slate-400 dark:text-slate-500 uppercase tracking-wider rounded-full border border-black/5 dark:border-white/5">
                    or sign in with
                </span>
            </div>

            <!-- Google & Facebook Login Buttons -->
            <div class="grid grid-cols-2 gap-3 pt-2">
                <!-- Google Button -->
                <a href="{{ route('auth.social', 'google') }}"
                    class="flex items-center justify-center gap-2.5 py-3 px-4 rounded-xl bg-white dark:bg-white/[0.04] hover:bg-slate-50 dark:hover:bg-white/[0.08] border border-black/10 dark:border-white/10 text-[#0f172a] dark:text-white text-xs font-bold font-['Outfit'] transition-all duration-200 shadow-sm hover:shadow hover:-translate-y-0.5 active:translate-y-0 group cursor-pointer"
                    title="Sign in with Google">
                    <!-- Official Google Multi-Color SVG Icon -->
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                        <path fill="#4285F4"
                            d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z" />
                        <path fill="#34A853"
                            d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z" />
                        <path fill="#FBBC05"
                            d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z" />
                        <path fill="#EA4335"
                            d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z" />
                    </svg>
                    <span>Google</span>
                </a>

                <!-- Facebook Button -->
                <a href="{{ route('auth.social', 'facebook') }}"
                    class="flex items-center justify-center gap-2.5 py-3 px-4 rounded-xl bg-white dark:bg-white/[0.04] hover:bg-slate-50 dark:hover:bg-white/[0.08] border border-black/10 dark:border-white/10 text-[#0f172a] dark:text-white text-xs font-bold font-['Outfit'] transition-all duration-200 shadow-sm hover:shadow hover:-translate-y-0.5 active:translate-y-0 group cursor-pointer"
                    title="Sign in with Facebook">
                    <!-- Official Facebook Blue SVG Icon -->
                    <svg class="w-4 h-4 shrink-0 fill-[#1877F2]" viewBox="0 0 24 24">
                        <path
                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                    </svg>
                    <span>Facebook</span>
                </a>
            </div>

            <!-- Footer Navigation Links -->
            <div
                class="pt-5 border-t border-black/5 dark:border-white/10 text-xs text-slate-500 dark:text-slate-400 flex items-center justify-between">
                <a href="{{ route('home') }}"
                    class="hover:text-[#0f172a] dark:hover:text-white transition-colors flex items-center gap-1 group font-medium">
                    <span class="group-hover:-translate-x-1 transition-transform">&larr;</span>
                    <span>Back to Home</span>
                </a>
                <a href="{{ route('register') }}"
                    class="text-emerald-600 dark:text-[#00ff88] hover:underline font-bold flex items-center gap-1 group">
                    <span>Register For New Account</span>
                    <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                </a>
            </div>
        </div>

    </div>

    
    <!-- Interactive Script for Password Toggle & Caps Lock Detection -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('togglePasswordBtn');
            const eyeIcon = document.getElementById('eyeIcon');
            const capsLockWarning = document.getElementById('capsLockWarning');

            // 1. Password Visibility Toggle
            if (togglePasswordBtn && passwordInput) {
                togglePasswordBtn.addEventListener('click', function() {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    if (isPassword) {
                        eyeIcon.classList.remove('ph-eye');
                        eyeIcon.classList.add('ph-eye-slash');
                        togglePasswordBtn.classList.add('text-emerald-500');
                    } else {
                        eyeIcon.classList.remove('ph-eye-slash');
                        eyeIcon.classList.add('ph-eye');
                        togglePasswordBtn.classList.remove('text-emerald-500');
                    }
                });
            }

            // 2. Caps Lock Warning Detector
            if (passwordInput && capsLockWarning) {
                passwordInput.addEventListener('keyup', function(e) {
                    if (e.getModifierState && e.getModifierState('CapsLock')) {
                        capsLockWarning.classList.remove('hidden');
                    } else {
                        capsLockWarning.classList.add('hidden');
                    }
                });

                passwordInput.addEventListener('blur', function() {
                    capsLockWarning.classList.add('hidden');
                });
            }
        });
    </script>

    <!-- jQuery & Toastr Notification Component -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @include('partials.toastr')
</body>

</html>
