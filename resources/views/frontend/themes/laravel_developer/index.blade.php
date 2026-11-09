@extends('frontend.layouts.frontend')

@section('content')
    <style>
        :root {
            --theme-primary: #00e5ff;
            --theme-primary-hover: #00b4d8;
            --theme-primary-glow: rgba(0, 229, 255, 0.25);
            --theme-on-primary: #000000;
        }

        /* Staggered Part-by-Part Hero Slide Animations */
        @keyframes partSlideDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes partSlideLeft {
            0% {
                opacity: 0;
                transform: translateX(-40px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes partSlideRight {
            0% {
                opacity: 0;
                transform: translateX(40px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes partFadeUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes partScaleIn {
            0% {
                opacity: 0;
                transform: scale(0.92);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes partBounceIn {
            0% {
                opacity: 0;
                transform: scale(0.7);
            }

            70% {
                transform: scale(1.05);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .slide-active .anim-part-1 {
            animation: partSlideDown 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards 0.1s;
            opacity: 0;
        }

        .slide-active .anim-part-2 {
            animation: partSlideLeft 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards 0.25s;
            opacity: 0;
        }

        .slide-active .anim-part-3 {
            animation: partSlideRight 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards 0.4s;
            opacity: 0;
        }

        .slide-active .anim-part-4 {
            animation: partFadeUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards 0.55s;
            opacity: 0;
        }

        .slide-active .anim-part-5 {
            animation: partFadeUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards 0.7s;
            opacity: 0;
        }

        .slide-active .anim-part-6 {
            animation: partScaleIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards 0.35s;
            opacity: 0;
        }

        .slide-active .anim-part-7 {
            animation: partBounceIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards 0.85s;
            opacity: 0;
        }

        /* Slider Progress Bar Animation */
        @keyframes progressTimer {
            0% {
                width: 0%;
            }

            100% {
                width: 100%;
            }
        }

        .slider-progress-running {
            animation: progressTimer 6s linear infinite;
        }

        /* Hero Section Fixed Height to prevent jumping between slides */
        .hero-fixed-container {
            height: 880px;
            min-height: 880px;
        }

        @media (min-width: 640px) {
            .hero-fixed-container {
                height: 780px;
                min-height: 780px;
            }
        }

        @media (min-width: 768px) {
            .hero-fixed-container {
                height: 720px;
                min-height: 720px;
            }
        }

        @media (min-width: 1024px) {
            .hero-fixed-container {
                height: 560px;
                min-height: 560px;
            }
        }

        @media (min-width: 1280px) {
            .hero-fixed-container {
                height: 540px;
                min-height: 540px;
            }
        }

        /* Testimonials Progress Bar Animation (5s) */
        @keyframes testimonialProgressTimer {
            0% {
                width: 0%;
            }

            100% {
                width: 100%;
            }
        }

        .testimonial-progress-active {
            animation: testimonialProgressTimer 5s linear infinite;
        }
    </style>

    <!-- Load AngularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>

    <div ng-app="laravelPortfolioApp" ng-controller="LaravelPortfolioController"
        class="laravel-dev-wrapper bg-slate-50 dark:bg-[#070b14] text-slate-900 dark:text-slate-100 min-h-screen selection:bg-[var(--theme-primary)] selection:text-black font-['Plus_Jakarta_Sans'] transition-colors duration-300 relative">

        <!-- Header Partial -->
        @include('frontend.themes.laravel_developer.partials.header')

        <!-- =========================================================================
                     1. HERO SECTION: ANIMATED SLIDER (ANIMATED PART BY PART VIA ANGULARJS)
                     ========================================================================= -->
        <section id="heroSlider"
            class="relative pt-8 sm:pt-12 pb-16 sm:pb-24 overflow-hidden border-b border-slate-200 dark:border-white/5"
            ng-mouseenter="pauseSlider()" ng-mouseleave="resumeSlider()">

            <!-- Ambient Cyber Background Grid & Lighting -->
            <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.05] pointer-events-none"
                style="background-image: radial-gradient(var(--theme-primary) 1px, transparent 1px); background-size: 32px 32px;">
            </div>
            <div
                class="absolute -top-32 left-1/4 w-[500px] h-[500px] bg-[var(--theme-primary)]/10 rounded-full blur-[160px] pointer-events-none -z-10">
            </div>
            <div
                class="absolute top-1/2 right-10 w-[450px] h-[450px] bg-blue-600/10 rounded-full blur-[160px] pointer-events-none -z-10">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

                <!-- Slide Container: Cycles through slides array with FIXED HEIGHT to eliminate slide transition height jumping -->
                <div class="hero-fixed-container w-full relative flex items-center">

                    <!-- SLIDE 1: Enterprise Laravel Backend & Architecture -->
                    <div ng-show="currentSlide === 0" class="w-full h-full flex items-center slide-active">
                        <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                            <!-- Left Column (7 cols): Staggered Animated Elements -->
                            <div class="lg:col-span-7 space-y-6">
                                <!-- Part 1: Top Tag -->
                                <div
                                    class="anim-part-1 inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-500/10 border border-[var(--theme-primary)]/30 text-[var(--theme-primary)] text-xs font-mono font-bold">
                                    <span class="w-2 h-2 rounded-full bg-[var(--theme-primary)] animate-ping"></span>
                                    <span>// FULL-STACK LARAVEL ARCHITECT</span>
                                </div>

                                <!-- Part 2 & 3: Headline with Dual Lines -->
                                <h1
                                    class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-slate-900 dark:text-white font-['Outfit'] uppercase leading-[1.08]">
                                    <span
                                        class="anim-part-2 block text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500">
                                        SCALABLE BACKENDS
                                    </span>
                                    <span class="anim-part-3 block text-slate-800 dark:text-slate-100">
                                        CRAFTED IN LARAVEL 11
                                    </span>
                                </h1>

                                <!-- Part 4: Description & Tech Chips -->
                                <p
                                    class="anim-part-4 text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed max-w-xl">
                                    Hi, I am <strong class="text-slate-900 dark:text-white">Md. Abdullah Al Ahsan</strong>.
                                    I engineer high-concurrency Laravel platforms, decoupled RESTful APIs, multi-tenant
                                    databases, and automated document generation engines built for bulletproof reliability.
                                </p>

                                <!-- Part 5: Tech Pills & CTAs -->
                                <div class="anim-part-5 space-y-6">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span
                                            class="px-3 py-1 rounded-lg bg-slate-200 dark:bg-white/5 border border-slate-300 dark:border-white/10 text-xs font-mono text-[var(--theme-primary)] font-bold">Laravel
                                            11</span>
                                        <span
                                            class="px-3 py-1 rounded-lg bg-slate-200 dark:bg-white/5 border border-slate-300 dark:border-white/10 text-xs font-mono text-cyan-400 font-bold">PHP
                                            8.3</span>
                                        <span
                                            class="px-3 py-1 rounded-lg bg-slate-200 dark:bg-white/5 border border-slate-300 dark:border-white/10 text-xs font-mono text-blue-400 font-bold">MySQL</span>
                                        <span
                                            class="px-3 py-1 rounded-lg bg-slate-200 dark:bg-white/5 border border-slate-300 dark:border-white/10 text-xs font-mono text-indigo-400 font-bold">Tailwind
                                            CSS</span>
                                        <span
                                            class="px-3 py-1 rounded-lg bg-slate-200 dark:bg-white/5 border border-slate-300 dark:border-white/10 text-xs font-mono text-emerald-400 font-bold">AngularJS</span>
                                        <span
                                            class="px-3 py-1 rounded-lg bg-slate-200 dark:bg-white/5 border border-slate-300 dark:border-white/10 text-xs font-mono text-amber-400 font-bold">REST
                                            APIs</span>
                                    </div>

                                    <div class="flex flex-wrap items-center gap-4">
                                        <a href="#contact"
                                            class="px-6 py-3.5 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-xs sm:text-sm uppercase tracking-wider shadow-lg shadow-cyan-500/25 active:scale-95 transition-all flex items-center gap-2">
                                            <span>HIRE ME FOR PROJECTS</span>
                                            <span>➔</span>
                                        </a>
                                        <a href="#portfolio"
                                            class="px-6 py-3.5 rounded-full border-2 border-slate-300 dark:border-white/20 hover:border-[var(--theme-primary)] text-slate-800 dark:text-white font-bold text-xs sm:text-sm uppercase tracking-wider hover:bg-white/5 active:scale-95 transition-all">
                                            <span>VIEW PRODUCTION CODE</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column (5 cols): Interactive Code Terminal Simulator -->
                            <div class="lg:col-span-5 relative">
                                <!-- Part 6: Live Code Terminal Simulator -->
                                <div
                                    class="anim-part-6 rounded-2xl border border-slate-300 dark:border-white/10 bg-slate-900 shadow-2xl p-4 sm:p-5 font-mono text-xs text-slate-300 space-y-3 relative overflow-hidden backdrop-blur-xl">
                                    <!-- Terminal Top Bar -->
                                    <div
                                        class="flex items-center justify-between pb-3 border-b border-white/10 text-[11px] text-slate-400">
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-3 h-3 rounded-full bg-rose-500 inline-block"></span>
                                            <span class="w-3 h-3 rounded-full bg-amber-500 inline-block"></span>
                                            <span class="w-3 h-3 rounded-full bg-emerald-500 inline-block"></span>
                                            <span class="ml-2 font-bold text-slate-300">OrderInvoiceService.php</span>
                                        </div>
                                        <span
                                            class="text-[10px] text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20 font-bold">●
                                            200 OK — 24ms</span>
                                    </div>
                                    <!-- Terminal Code Content -->
                                    <pre class="text-[11px] sm:text-xs leading-relaxed overflow-x-auto text-slate-300"><span class="text-indigo-400">&lt;?php</span>
<span class="text-rose-400">namespace</span> App\Services\Devzet;

<span class="text-cyan-400">class</span> <span class="text-amber-300">OrderInvoiceEngine</span> {
    <span class="text-rose-400">public function</span> <span class="text-blue-400">generate</span>(Order $order): InvoicePdf {
        <span class="text-slate-500">// RBAC Authentication Verification</span>
        $user = auth()-&gt;user();
        abort_unless($user-&gt;can(<span class="text-emerald-300">'manage_invoices'</span>), <span class="text-amber-300">403</span>);

        <span class="text-slate-500">// Dynamic PDF Render &amp; Storage</span>
        $pdf = Pdf::loadView(<span class="text-emerald-300">'invoices.client'</span>, [
            <span class="text-cyan-300">'order'</span> =&gt; $order,
            <span class="text-cyan-300">'developer'</span> =&gt; <span class="text-emerald-300">'Md. Abdullah Al Ahsan'</span>
        ]);

        DispatchInvoiceQueue::dispatch($pdf);
        <span class="text-rose-400">return</span> $pdf-&gt;stream();
    }
}</pre>
                                </div>

                                <!-- Part 7: Floating Metric Badges -->
                                <div
                                    class="anim-part-7 absolute -bottom-4 -left-4 px-4 py-2.5 rounded-2xl bg-white/95 dark:bg-[#0c1220]/95 border border-[var(--theme-primary)]/40 shadow-xl backdrop-blur-md flex items-center gap-3">
                                    <span
                                        class="w-8 h-8 rounded-xl bg-[var(--theme-primary)]/20 text-[var(--theme-primary)] flex items-center justify-center font-bold text-base">⬡</span>
                                    <div>
                                        <div
                                            class="text-xs font-black font-['Outfit'] text-slate-900 dark:text-white uppercase">
                                            8+ YEARS EXPERIENCE</div>
                                        <div class="text-[10px] font-mono text-emerald-400 font-bold">PROVEN PRODUCTION CODE
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SLIDE 2: ERP, POS & Business Software (BBGC, Rafiq Ent, Devzet) -->
                    <div ng-show="currentSlide === 1" class="w-full h-full flex items-center slide-active">
                        <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                            <div class="lg:col-span-7 space-y-6">
                                <div
                                    class="anim-part-1 inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-mono font-bold">
                                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                                    <span>// ENTERPRISE ERP &amp; POS SYSTEMS</span>
                                </div>

                                <h1
                                    class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-slate-900 dark:text-white font-['Outfit'] uppercase leading-[1.08]">
                                    <span
                                        class="anim-part-2 block text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-400 to-cyan-500">
                                        CUSTOM ERP &amp; POS
                                    </span>
                                    <span class="anim-part-3 block text-slate-800 dark:text-slate-100">
                                        AUTOMATED WORKFLOWS
                                    </span>
                                </h1>

                                <p
                                    class="anim-part-4 text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed max-w-xl">
                                    Built real-world systems including the <strong
                                        class="text-slate-900 dark:text-white">BBGC School Management ERP</strong>
                                    (Coordinator pattern), <strong class="text-slate-900 dark:text-white">Rafiq Ent
                                        Point-of-Sale &amp; Inventory</strong>, and <strong
                                        class="text-slate-900 dark:text-white">Devzet Automated PDF Invoicing</strong>
                                    engine.
                                </p>

                                <div class="anim-part-5 flex flex-wrap items-center gap-4">
                                    <a href="#portfolio"
                                        class="px-6 py-3.5 rounded-full bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold text-xs sm:text-sm uppercase tracking-wider shadow-lg shadow-emerald-500/25 active:scale-95 transition-all flex items-center gap-2">
                                        <span>EXPLORE ERP &amp; POS CASE STUDIES</span>
                                        <span>➔</span>
                                    </a>
                                    <a href="#skills"
                                        class="px-6 py-3.5 rounded-full border-2 border-slate-300 dark:border-white/20 hover:border-emerald-400 text-slate-800 dark:text-white font-bold text-xs sm:text-sm uppercase tracking-wider hover:bg-white/5 active:scale-95 transition-all">
                                        <span>VIEW ARCHITECTURE SKILLS</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Right Column: Visual Dashboard Preview Card -->
                            <div class="lg:col-span-5 relative">
                                <div
                                    class="anim-part-6 rounded-2xl border border-emerald-500/30 bg-slate-900 p-6 shadow-2xl space-y-4 font-mono text-xs text-slate-300">
                                    <div class="flex items-center justify-between pb-3 border-b border-white/10">
                                        <span class="text-xs font-bold text-emerald-400 uppercase tracking-wider">Enterprise
                                            POS &amp; ERP Node</span>
                                        <span
                                            class="text-[10px] font-bold text-white bg-emerald-600 px-2.5 py-0.5 rounded-full">ACTIVE
                                            NODE</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3 pt-1">
                                        <div class="p-3 rounded-xl bg-white/5 border border-white/10">
                                            <div class="text-[10px] text-slate-400 uppercase">Orders Processed</div>
                                            <div class="text-xl font-bold text-white mt-1">12,450+</div>
                                            <div class="text-[9px] text-emerald-400">Devzet PDF Engine</div>
                                        </div>
                                        <div class="p-3 rounded-xl bg-white/5 border border-white/10">
                                            <div class="text-[10px] text-slate-400 uppercase">ERP Students</div>
                                            <div class="text-xl font-bold text-white mt-1">3,200+</div>
                                            <div class="text-[9px] text-cyan-400">BBGC Coordinator</div>
                                        </div>
                                    </div>
                                    <div class="p-3 rounded-xl bg-white/5 border border-white/10 space-y-1.5">
                                        <div class="flex justify-between text-[11px]">
                                            <span>System Uptime Reliability</span>
                                            <span class="text-emerald-400 font-bold">99.98%</span>
                                        </div>
                                        <div class="w-full h-2 rounded-full bg-slate-800 overflow-hidden">
                                            <div class="h-full bg-gradient-to-r from-emerald-400 to-cyan-400 rounded-full"
                                                style="width: 99.98%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SLIDE 3: Modern Reactive Frontend Meets High-Performance Backend -->
                    <div ng-show="currentSlide === 2" class="w-full h-full flex items-center slide-active">
                        <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                            <div class="lg:col-span-7 space-y-6">
                                <div
                                    class="anim-part-1 inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/30 text-indigo-400 text-xs font-mono font-bold">
                                    <span class="w-2 h-2 rounded-full bg-indigo-400 animate-ping"></span>
                                    <span>// TAILWIND CSS &amp; ANGULARJS STACK</span>
                                </div>

                                <h1
                                    class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-slate-900 dark:text-white font-['Outfit'] uppercase leading-[1.08]">
                                    <span
                                        class="anim-part-2 block text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-500">
                                        REACTIVE FRONTENDS
                                    </span>
                                    <span class="anim-part-3 block text-slate-800 dark:text-slate-100">
                                        ROBUST BACKENDS
                                    </span>
                                </h1>

                                <p
                                    class="anim-part-4 text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed max-w-xl">
                                    Seamless user experience combining modern <strong
                                        class="text-slate-900 dark:text-white">Tailwind CSS utility design</strong> with
                                    <strong class="text-slate-900 dark:text-white">AngularJS reactive controllers</strong>
                                    for sub-second page transitions, dynamic filters, and real-time state synchronization.
                                </p>

                                <div class="anim-part-5 flex flex-wrap items-center gap-4">
                                    <a href="#contact"
                                        class="px-6 py-3.5 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold text-xs sm:text-sm uppercase tracking-wider shadow-lg shadow-indigo-500/25 active:scale-95 transition-all flex items-center gap-2">
                                        <span>START A PROJECT</span>
                                        <span>➔</span>
                                    </a>
                                    <button type="button" onclick="togglePaletteMenu()"
                                        class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full border-2 border-indigo-500/40 hover:border-indigo-400 text-slate-800 dark:text-white font-bold text-xs sm:text-sm uppercase tracking-wider hover:bg-white/5 active:scale-95 transition-all cursor-pointer">
                                        <svg class="w-4 h-4 text-[var(--theme-primary)]" viewBox="0 0 143 141"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M 40.2 17.2 L 39.3 17.3 L 38.3 17.7 L 37.1 18.2 L 35.8 19.0 L 34.3 20.0 L 32.8 21.1 L 31.5 22.3 L 30.3 23.6 L 29.2 24.9 L 28.2 26.3 L 27.4 27.6 L 26.8 28.9 L 26.3 30.1 L 25.9 36.4 L 25.6 47.6 L 25.5 63.9 L 25.5 85.1 L 25.7 101.4 L 26.1 112.8 L 26.6 119.3 L 27.4 120.8 L 28.3 122.3 L 29.5 123.8 L 30.9 125.4 L 32.6 127.1 L 34.0 128.4 L 35.3 129.5 L 36.5 130.3 L 37.5 130.8 L 38.4 131.1 L 39.3 131.4 L 40.1 131.5 L 40.9 131.5 L 41.5 131.6 L 42.0 131.7 L 42.4 131.9 L 42.6 132.1 L 43.9 132.3 L 46.1 132.4 L 49.4 132.5 L 53.6 132.5 L 56.9 132.4 L 59.1 132.3 L 60.4 132.1 L 60.6 131.9 L 61.0 131.7 L 61.5 131.6 L 62.1 131.5 L 62.9 131.5 L 63.8 131.3 L 64.8 130.9 L 65.9 130.4 L 67.1 129.6 L 68.4 128.6 L 69.8 127.4 L 71.3 125.9 L 72.8 124.1 L 76.8 121.2 L 83.3 117.1 L 92.3 111.8 L 103.8 105.3 L 112.8 100.0 L 119.3 95.9 L 123.4 93.1 L 125.1 91.4 L 126.4 90.0 L 127.5 88.7 L 128.3 87.5 L 128.8 86.5 L 129.2 85.2 L 129.6 83.6 L 129.9 81.6 L 130.1 79.4 L 130.3 77.6 L 130.3 76.4 L 130.1 75.6 L 129.9 75.4 L 129.7 75.0 L 129.6 74.5 L 129.5 73.9 L 129.5 73.1 L 129.0 71.7 L 128.0 69.6 L 126.5 66.8 L 124.5 63.3 L 122.6 60.3 L 120.9 57.9 L 119.3 56.1 L 117.8 54.9 L 116.6 53.8 L 115.9 52.9 L 115.5 52.3 L 115.5 51.8 L 115.4 51.2 L 115.1 50.6 L 114.8 49.9 L 114.3 49.1 L 113.2 48.0 L 111.5 46.4 L 109.2 44.4 L 106.3 42.1 L 104.0 40.2 L 102.2 38.7 L 100.9 37.8 L 100.1 37.3 L 99.4 36.9 L 98.6 36.6 L 97.9 36.5 L 97.1 36.5 L 96.1 36.1 L 94.9 35.4 L 93.4 34.3 L 91.6 32.8 L 89.6 31.4 L 87.4 30.1 L 84.9 29.0 L 82.1 28.0 L 79.9 27.3 L 78.1 26.8 L 76.9 26.5 L 76.1 26.5 L 75.2 26.1 L 74.1 25.4 L 72.8 24.3 L 71.3 22.8 L 69.8 21.4 L 68.4 20.3 L 67.1 19.4 L 65.9 18.6 L 64.8 18.1 L 63.8 17.7 L 62.9 17.5 L 62.1 17.5 L 61.5 17.4 L 61.0 17.3 L 60.6 17.1 L 60.4 16.9 L 59.1 16.7 L 56.7 16.6 L 53.3 16.5 L 48.8 16.5 L 45.3 16.5 L 43.0 16.6 L 41.8 16.7 L 41.7 16.8 L 41.4 16.9 L 40.9 17.1 Z M 39.4 22.9 L 38.1 23.6 L 36.9 24.2 L 35.9 24.8 L 35.1 25.4 L 34.4 26.1 L 33.7 27.0 L 32.9 28.3 L 32.0 30.0 L 31.0 32.0 L 30.3 38.4 L 29.8 49.1 L 29.5 64.3 L 29.5 83.8 L 29.6 98.8 L 29.9 109.3 L 30.3 115.3 L 30.8 116.8 L 31.5 118.3 L 32.6 119.8 L 33.9 121.4 L 35.6 123.1 L 37.0 124.4 L 38.3 125.5 L 39.5 126.3 L 40.5 126.8 L 42.4 127.1 L 45.1 127.4 L 48.8 127.5 L 53.3 127.5 L 57.0 127.3 L 60.0 126.9 L 62.3 126.4 L 63.8 125.6 L 65.2 124.8 L 66.5 123.8 L 67.7 122.8 L 68.8 121.7 L 69.8 120.5 L 70.6 119.3 L 71.3 118.1 L 71.8 116.9 L 72.1 110.9 L 72.4 100.3 L 72.5 85.0 L 72.5 65.0 L 72.3 49.6 L 71.9 38.7 L 71.4 32.4 L 70.6 30.6 L 69.7 29.0 L 68.5 27.4 L 67.1 25.9 L 65.4 24.6 L 64.0 23.5 L 62.8 22.7 L 61.9 22.1 L 61.1 21.9 L 59.4 21.7 L 56.8 21.6 L 53.3 21.5 L 48.8 21.5 L 45.3 21.5 L 43.0 21.6 L 41.8 21.7 L 41.7 21.8 L 41.3 22.1 L 40.5 22.4 Z M 76.5 31.1 L 76.5 31.9 L 76.6 32.5 L 76.7 33.0 L 76.9 33.4 L 77.1 33.6 L 77.3 38.1 L 77.5 46.8 L 77.7 59.7 L 77.8 76.8 L 78.4 88.1 L 79.6 93.4 L 81.2 92.9 L 83.3 86.6 L 85.0 81.6 L 86.3 78.0 L 87.3 75.9 L 87.8 75.1 L 88.3 73.9 L 88.9 72.1 L 89.6 69.9 L 90.4 67.1 L 91.2 64.5 L 92.1 62.0 L 93.0 59.6 L 94.0 57.4 L 94.8 55.2 L 95.4 53.1 L 95.9 51.0 L 96.1 49.0 L 96.1 47.1 L 95.9 45.2 L 95.4 43.4 L 94.6 41.6 L 93.8 40.0 L 92.8 38.6 L 91.8 37.3 L 90.7 36.2 L 89.1 35.0 L 87.0 33.8 L 84.5 32.6 L 81.5 31.4 L 79.2 30.5 L 77.7 29.9 L 76.8 29.7 L 76.7 29.8 L 76.6 30.1 L 76.5 30.5 Z M 98.9 45.1 L 99.1 47.9 L 99.0 50.9 L 98.5 54.1 L 97.6 57.6 L 96.4 61.4 L 95.3 64.4 L 94.4 66.6 L 93.8 68.1 L 93.3 68.9 L 92.9 69.6 L 92.6 70.4 L 92.5 71.1 L 92.5 71.9 L 92.3 72.9 L 91.8 74.3 L 91.0 76.0 L 90.0 78.0 L 89.1 80.2 L 88.2 82.6 L 87.4 85.1 L 86.6 87.9 L 85.9 90.1 L 85.3 91.9 L 84.8 93.1 L 84.3 93.9 L 83.9 94.6 L 83.6 95.4 L 83.5 96.1 L 83.5 96.9 L 83.3 97.9 L 82.8 99.3 L 82.0 101.0 L 81.0 103.0 L 80.3 104.6 L 79.8 105.8 L 79.7 106.6 L 79.8 106.9 L 81.9 104.8 L 86.1 100.2 L 92.2 93.1 L 100.3 83.4 L 106.5 75.8 L 110.8 70.3 L 113.3 66.8 L 113.8 65.3 L 114.1 63.8 L 114.4 62.4 L 114.5 61.1 L 114.5 59.9 L 114.3 58.5 L 113.9 57.0 L 113.4 55.4 L 112.6 53.6 L 111.3 51.7 L 109.3 49.5 L 106.8 47.1 L 103.7 44.4 L 101.3 42.5 L 99.7 41.3 L 98.8 40.7 L 98.7 40.8 L 98.7 41.6 L 98.7 43.0 Z M 117.5 61.5 L 117.5 62.5 L 117.3 63.8 L 116.9 65.3 L 116.4 67.0 L 115.6 69.0 L 112.9 73.0 L 108.3 79.0 L 101.8 87.0 L 93.3 97.0 L 86.8 104.7 L 82.3 110.2 L 79.9 113.3 L 79.6 114.2 L 81.9 113.3 L 87.0 110.8 L 94.8 106.5 L 105.3 100.5 L 113.4 95.7 L 119.2 92.0 L 122.7 89.4 L 123.8 88.1 L 124.7 86.8 L 125.4 85.8 L 125.9 84.9 L 126.1 84.1 L 126.3 82.9 L 126.4 81.3 L 126.5 79.3 L 126.5 76.8 L 126.0 74.0 L 124.9 71.1 L 123.3 67.9 L 121.2 64.6 L 119.6 62.1 L 118.4 60.4 L 117.8 59.7 L 117.7 59.8 L 117.6 60.2 L 117.5 60.7 Z M 44.1 86.9 L 42.4 87.6 L 40.9 88.3 L 39.6 89.2 L 38.3 90.2 L 37.2 91.3 L 36.2 92.5 L 35.2 93.8 L 34.4 95.3 L 33.6 96.8 L 33.1 98.6 L 32.7 100.7 L 32.5 103.1 L 32.5 105.9 L 32.8 108.4 L 33.3 110.6 L 34.0 112.6 L 35.0 114.4 L 36.1 116.0 L 37.3 117.4 L 38.6 118.7 L 39.9 119.8 L 41.3 120.8 L 42.8 121.6 L 44.3 122.3 L 45.8 122.8 L 47.5 123.1 L 49.5 123.2 L 51.8 123.1 L 54.3 122.9 L 56.4 122.6 L 58.1 122.2 L 59.5 121.8 L 60.5 121.3 L 61.5 120.6 L 62.6 119.8 L 63.7 118.8 L 64.8 117.7 L 65.8 116.5 L 66.8 115.3 L 67.6 114.1 L 68.4 112.9 L 68.9 111.7 L 69.3 110.6 L 69.5 109.5 L 69.5 108.5 L 69.6 107.7 L 69.7 107.1 L 69.9 106.6 L 70.1 106.4 L 70.3 105.7 L 70.3 104.6 L 70.1 103.0 L 69.9 101.0 L 69.6 99.3 L 69.2 97.8 L 68.8 96.5 L 68.3 95.5 L 67.5 94.3 L 66.4 93.0 L 65.1 91.6 L 63.4 89.9 L 61.9 88.6 L 60.5 87.5 L 59.1 86.8 L 57.9 86.3 L 56.4 85.9 L 54.6 85.6 L 52.6 85.5 L 50.4 85.5 L 48.7 85.5 L 47.5 85.6 L 46.8 85.7 L 46.7 85.8 L 46.2 86.1 L 45.3 86.4 Z M 48.8 90.2 L 47.7 90.3 L 46.4 90.8 L 45.1 91.5 L 43.6 92.6 L 41.9 93.9 L 40.6 95.2 L 39.5 96.4 L 38.8 97.5 L 38.3 98.5 L 37.9 99.8 L 37.6 101.4 L 37.5 103.4 L 37.5 105.6 L 37.9 107.8 L 38.7 109.8 L 39.9 111.8 L 41.6 113.7 L 43.0 115.2 L 44.3 116.4 L 45.5 117.3 L 46.5 117.8 L 47.7 118.1 L 49.1 118.4 L 50.6 118.5 L 52.4 118.5 L 53.9 118.4 L 55.3 118.1 L 56.5 117.8 L 57.5 117.3 L 58.5 116.6 L 59.6 115.8 L 60.7 114.8 L 61.8 113.7 L 62.8 112.5 L 63.6 111.3 L 64.3 110.1 L 64.8 108.9 L 65.1 107.6 L 65.4 106.2 L 65.5 104.8 L 65.5 103.3 L 65.2 101.7 L 64.7 100.0 L 63.8 98.2 L 62.7 96.3 L 61.5 94.7 L 60.3 93.4 L 59.1 92.4 L 57.9 91.6 L 56.6 91.0 L 55.4 90.5 L 54.1 90.1 L 52.9 89.9 L 51.9 89.7 L 51.2 89.7 L 50.8 89.7 L 50.7 89.8 L 50.3 89.9 L 49.7 90.1 Z" />
                                        </svg>
                                        <span>TRY MATERIAL PALETTES</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Right Column: Interactive UI Components -->
                            <div class="lg:col-span-5 relative">
                                <div
                                    class="anim-part-6 rounded-2xl border border-indigo-500/30 bg-slate-900 p-6 shadow-2xl space-y-4">
                                    <div class="flex items-center justify-between pb-3 border-b border-white/10">
                                        <span class="text-xs font-mono font-bold text-indigo-400 uppercase">Dynamic
                                            Component Deck</span>
                                        <span class="text-[10px] font-mono text-purple-400">AngularJS Reactive</span>
                                    </div>
                                    <div class="space-y-3">
                                        <div
                                            class="p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="w-8 h-8 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center font-bold">⚡</span>
                                                <div>
                                                    <div class="text-xs font-bold text-white">Instant Reactive Filter</div>
                                                    <div class="text-[10px] text-slate-400">Zero page refresh</div>
                                                </div>
                                            </div>
                                            <span class="text-xs font-mono text-emerald-400 font-bold">&lt; 15ms</span>
                                        </div>
                                        <div
                                            class="p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="w-8 h-8 rounded-lg bg-pink-500/20 text-pink-400 flex items-center justify-center font-bold">🎨</span>
                                                <div>
                                                    <div class="text-xs font-bold text-white">Dynamic Material Color System
                                                    </div>
                                                    <div class="text-[10px] text-slate-400">CSS Custom Properties</div>
                                                </div>
                                            </div>
                                            <span class="text-xs font-mono text-indigo-400 font-bold">Live Synced</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Slider Navigation Controls: Prev, Next, Dots & Progress Bar -->
                <div
                    class="mt-8 pt-6 border-t border-slate-200 dark:border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">

                    <!-- Slide Indicators & Progress Timer -->
                    <div class="flex items-center gap-3">
                        <button type="button" ng-click="setSlide(0)"
                            class="w-10 h-2 rounded-full transition-all cursor-pointer"
                            ng-class="currentSlide === 0 ? 'bg-[var(--theme-primary)] w-14' : 'bg-slate-300 dark:bg-white/20'"></button>
                        <button type="button" ng-click="setSlide(1)"
                            class="w-10 h-2 rounded-full transition-all cursor-pointer"
                            ng-class="currentSlide === 1 ? 'bg-emerald-400 w-14' : 'bg-slate-300 dark:bg-white/20'"></button>
                        <button type="button" ng-click="setSlide(2)"
                            class="w-10 h-2 rounded-full transition-all cursor-pointer"
                            ng-class="currentSlide === 2 ? 'bg-indigo-400 w-14' : 'bg-slate-300 dark:bg-white/20'"></button>
                        <span class="text-[11px] font-mono text-slate-500 dark:text-slate-400 ml-2">
                            @{{ currentSlide + 1 }} / 3
                        </span>
                    </div>

                    <!-- Prev / Next Control Buttons -->
                    <div class="flex items-center gap-2">
                        <button type="button" ng-click="prevSlide()" title="Previous slide"
                            class="w-10 h-10 rounded-xl border border-slate-300 dark:border-white/10 hover:border-[var(--theme-primary)] bg-white dark:bg-white/5 hover:text-[var(--theme-primary)] flex items-center justify-center font-bold text-sm shadow-sm active:scale-95 transition-all cursor-pointer">
                            ←
                        </button>
                        <button type="button" ng-click="nextSlide()" title="Next slide"
                            class="w-10 h-10 rounded-xl border border-slate-300 dark:border-white/10 hover:border-[var(--theme-primary)] bg-white dark:bg-white/5 hover:text-[var(--theme-primary)] flex items-center justify-center font-bold text-sm shadow-sm active:scale-95 transition-all cursor-pointer">
                            ➔
                        </button>
                    </div>
                </div>

            </div>
        </section>

        <!-- =========================================================================
                     2. QUICK METRIC STATS RIBBON
                     ========================================================================= -->
        <section class="py-10 bg-slate-100 dark:bg-[#060a12] border-b border-slate-200 dark:border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                    <div
                        class="p-4 rounded-2xl bg-white dark:bg-white/[0.02] border border-slate-200 dark:border-white/5 shadow-sm">
                        <div class="text-3xl sm:text-4xl font-black text-[var(--theme-primary)] font-['Outfit']">8+</div>
                        <div
                            class="text-xs font-mono font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 mt-1">
                            Years Experience</div>
                    </div>
                    <div
                        class="p-4 rounded-2xl bg-white dark:bg-white/[0.02] border border-slate-200 dark:border-white/5 shadow-sm">
                        <div class="text-3xl sm:text-4xl font-black text-cyan-400 font-['Outfit']">45+</div>
                        <div
                            class="text-xs font-mono font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 mt-1">
                            Production Projects</div>
                    </div>
                    <div
                        class="p-4 rounded-2xl bg-white dark:bg-white/[0.02] border border-slate-200 dark:border-white/5 shadow-sm">
                        <div class="text-3xl sm:text-4xl font-black text-emerald-400 font-['Outfit']">30+</div>
                        <div
                            class="text-xs font-mono font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 mt-1">
                            Satisfied Clients</div>
                    </div>
                    <div
                        class="p-4 rounded-2xl bg-white dark:bg-white/[0.02] border border-slate-200 dark:border-white/5 shadow-sm">
                        <div class="text-3xl sm:text-4xl font-black text-amber-400 font-['Outfit']">Level-3</div>
                        <div
                            class="text-xs font-mono font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 mt-1">
                            NSDA National Cert</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================================================================
                     3. ABOUT THE DEVELOPER (MD. ABDULLAH AL AHSAN - FROM PDF)
                     ========================================================================= -->
        <section id="about" class="py-20 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                    <!-- Left Column (5 cols): Verified Profile Card & Personal Info -->
                    <div class="lg:col-span-5 space-y-6">
                        <div
                            class="rounded-3xl border border-slate-200 dark:border-white/10 bg-white dark:bg-[#0a0f1d] p-6 sm:p-8 shadow-xl space-y-6">
                            <div class="flex items-center gap-4 pb-6 border-b border-slate-100 dark:border-white/10">
                                <div
                                    class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-[var(--theme-primary)] via-blue-600 to-indigo-700 text-white flex items-center justify-center font-bold text-2xl font-mono shadow-md">
                                    AA
                                </div>
                                <div>
                                    <h3
                                        class="text-lg font-black text-slate-900 dark:text-white uppercase font-['Outfit']">
                                        Md. Abdullah Al Ahsan</h3>
                                    <p class="text-xs font-mono text-[var(--theme-primary)] font-bold">Full-Stack Laravel
                                        Developer</p>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">Sherpur Town, Sherpur,
                                        Bangladesh</p>
                                </div>
                            </div>

                            <!-- Personal Information Table (Exact Data from PDF) -->
                            <div class="space-y-3 text-xs">
                                <h4
                                    class="font-mono font-bold uppercase tracking-wider text-[var(--theme-primary)] text-[11px]">
                                    Personal Profile</h4>
                                <div class="grid grid-cols-2 gap-2 text-slate-600 dark:text-slate-400">
                                    <div><span class="text-slate-400">Father's Name:</span></div>
                                    <div class="font-semibold text-slate-800 dark:text-slate-200">Md. Abdur Rahman</div>

                                    <div><span class="text-slate-400">Date of Birth:</span></div>
                                    <div class="font-semibold text-slate-800 dark:text-slate-200 font-mono">06-08-1990
                                    </div>

                                    <div><span class="text-slate-400">Nationality:</span></div>
                                    <div class="font-semibold text-slate-800 dark:text-slate-200">Bangladeshi (By Birth)
                                    </div>

                                    <div><span class="text-slate-400">Marital Status:</span></div>
                                    <div class="font-semibold text-slate-800 dark:text-slate-200">Married</div>

                                    <div><span class="text-slate-400">Religion:</span></div>
                                    <div class="font-semibold text-slate-800 dark:text-slate-200">Islam (Sunni)</div>

                                    <div><span class="text-slate-400">Blood Group:</span></div>
                                    <div class="font-semibold text-rose-500 font-bold font-mono">AB+</div>

                                    <div><span class="text-slate-400">Mobile Phone:</span></div>
                                    <div class="font-semibold text-[var(--theme-primary)] font-mono">
                                        {{ $settings['contact_phone'] ?? '+8801718926673' }}
                                    </div>

                                    <div><span class="text-slate-400">Email Address:</span></div>
                                    <div
                                        class="font-semibold text-slate-800 dark:text-slate-200 font-mono text-[11px] break-all">
                                        {{ $settings['contact_email'] ?? 'abdullahalahsan@hotmail.com' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Download CV Action -->
                            <div class="pt-4 border-t border-slate-100 dark:border-white/10">
                                <a href="{{ route('cv.download') }}" download
                                    class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-cyan-500/20 active:scale-95 transition-all">
                                    <span>DOWNLOAD OFFICIAL RESUME (PDF)</span>
                                    <span>↓</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column (7 cols): Professional Biography & Core Strengths -->
                    <div class="lg:col-span-7 space-y-6">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider">
                            <span>About The Developer</span>
                        </div>

                        <h2
                            class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit'] leading-tight">
                            CRAFTING RESILIENT ARCHITECTURES <span class="text-[var(--theme-primary)]">&amp; BUSINESS
                                ENGINES</span>
                        </h2>

                        <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
                            Highly motivated and detail-oriented Full-Stack Laravel Developer and Computer Professional with
                            strong expertise in enterprise backend architecture, RESTful API design, database modeling, and
                            modern web application development. Skilled in maintaining accurate records, supporting digital
                            workflows, and providing reliable technical leadership to ensure smooth administrative and
                            operational processes.
                        </p>

                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                            Extensive hands-on engineering history at <strong>Devzet LLC</strong> (Modhupur) building custom
                            orders and automated PDF invoicing engines, and at <strong>Freelance IT Lab</strong>
                            (Mymensingh) managing school ERP and POS platforms. Dedicated to delivering precision,
                            maintaining data integrity, and contributing to organizational efficiency.
                        </p>

                        <!-- Core Strengths from Resume -->
                        <div class="pt-4 space-y-3">
                            <h4
                                class="font-mono font-bold uppercase tracking-wider text-xs text-slate-900 dark:text-white">
                                Core Strengths &amp; Work Ethic</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div
                                    class="p-3.5 rounded-2xl bg-white dark:bg-white/[0.03] border border-slate-200 dark:border-white/10 flex items-start gap-3">
                                    <span class="text-[var(--theme-primary)] text-base font-bold">✔</span>
                                    <div class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed">
                                        <strong>Precision &amp; Accuracy:</strong> Strong attention to detail and accuracy
                                        in handling mission-critical and sensitive data.
                                    </div>
                                </div>
                                <div
                                    class="p-3.5 rounded-2xl bg-white dark:bg-white/[0.03] border border-slate-200 dark:border-white/10 flex items-start gap-3">
                                    <span class="text-[var(--theme-primary)] text-base font-bold">✔</span>
                                    <div class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed">
                                        <strong>High Pressure Agility:</strong> Proven ability to execute under pressure and
                                        deliver projects within tight production deadlines.
                                    </div>
                                </div>
                                <div
                                    class="p-3.5 rounded-2xl bg-white dark:bg-white/[0.03] border border-slate-200 dark:border-white/10 flex items-start gap-3">
                                    <span class="text-[var(--theme-primary)] text-base font-bold">✔</span>
                                    <div class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed">
                                        <strong>Fast Learner &amp; Adaptable:</strong> Rapidly master new frameworks,
                                        architectural patterns, and cloud infrastructures.
                                    </div>
                                </div>
                                <div
                                    class="p-3.5 rounded-2xl bg-white dark:bg-white/[0.03] border border-slate-200 dark:border-white/10 flex items-start gap-3">
                                    <span class="text-[var(--theme-primary)] text-base font-bold">✔</span>
                                    <div class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed">
                                        <strong>Team Player &amp; Communicator:</strong> Effective collaborator with
                                        transparent communication and training abilities.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 flex flex-wrap items-center gap-4">
                            <a href="#contact"
                                class="px-6 py-3 rounded-full bg-[var(--theme-primary)] text-slate-950 font-bold text-xs uppercase tracking-wider hover:opacity-90 active:scale-95 transition-all shadow-md">
                                Get In Touch
                            </a>
                            <a href="#resume"
                                class="px-6 py-3 rounded-full border border-slate-300 dark:border-white/20 hover:border-[var(--theme-primary)] text-slate-800 dark:text-white font-bold text-xs uppercase tracking-wider hover:bg-white/5 active:scale-95 transition-all">
                                View Career Timeline
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- =========================================================================
                     4. ENGINEERED SERVICES & CAPABILITIES
                     ========================================================================= -->
        <section id="services"
            class="py-20 bg-slate-100/70 dark:bg-[#060a12]/80 border-y border-slate-200 dark:border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
                    <span
                        class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider">
                        Services &amp; Capabilities
                    </span>
                    <h2
                        class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">
                        FULL-SPECTRUM <span class="text-[var(--theme-primary)]">DEVELOPMENT</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Delivering end-to-end web engineering, from database architecture and backend business logic to
                        reactive client-side interfaces.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($services as $service)
                        <div
                            class="group p-8 rounded-3xl bg-white dark:bg-[#0a0f1d] border border-slate-200 dark:border-white/10 hover:border-[var(--theme-primary)]/50 shadow-lg hover:shadow-cyan-500/10 transition-all duration-300 flex flex-col justify-between space-y-6">
                            <div class="space-y-4">
                                <div
                                    class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-cyan-500/20 to-blue-600/20 text-[var(--theme-primary)] flex items-center justify-center text-2xl border border-cyan-500/30 group-hover:scale-110 transition-transform">
                                    ⬢
                                </div>
                                <span
                                    class="text-[10px] font-mono font-bold text-[var(--theme-primary)] uppercase tracking-wider block">
                                    {{ $service->category }}
                                </span>
                                <h3
                                    class="text-lg font-bold text-slate-900 dark:text-white font-['Outfit'] uppercase group-hover:text-[var(--theme-primary)] transition-colors">
                                    {{ $service->title }}
                                </h3>
                                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                    {{ $service->description }}
                                </p>
                            </div>
                            <div
                                class="pt-4 border-t border-slate-100 dark:border-white/10 flex items-center justify-between text-xs font-mono font-bold text-slate-500 dark:text-slate-400">
                                <span>0{{ $loop->iteration }}</span>
                                <a href="#contact"
                                    class="hover:text-[var(--theme-primary)] flex items-center gap-1 transition-colors">
                                    <span>Inquire</span>
                                    <span>➔</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- =========================================================================
                     5. REAL-WORLD PROJECTS & PORTFOLIO (WITH ANGULARJS CATEGORY FILTER)
                     ========================================================================= -->
        <section id="portfolio" class="py-20 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                    <div>
                        <span
                            class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider">
                            Production Portfolio
                        </span>
                        <h2
                            class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit'] mt-2">
                            FEATURED <span class="text-[var(--theme-primary)]">PROJECTS</span>
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-1 max-w-xl">
                            Real-world software built for companies, educational institutions, and e-commerce platforms.
                        </p>
                    </div>

                    <!-- AngularJS Filter Buttons -->
                    <div class="flex flex-wrap items-center gap-2">
                        <button type="button" ng-click="setProjectFilter('all')"
                            class="px-4 py-2 rounded-xl text-xs font-mono font-bold uppercase tracking-wider transition-all cursor-pointer"
                            ng-class="selectedCategory === 'all' ? 'bg-[var(--theme-primary)] text-slate-950 shadow-md' : 'bg-slate-200 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:text-white'">
                            All
                        </button>
                        <button type="button" ng-click="setProjectFilter('ERP')"
                            class="px-4 py-2 rounded-xl text-xs font-mono font-bold uppercase tracking-wider transition-all cursor-pointer"
                            ng-class="selectedCategory === 'ERP' ? 'bg-[var(--theme-primary)] text-slate-950 shadow-md' : 'bg-slate-200 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:text-white'">
                            ERP &amp; POS
                        </button>
                        <button type="button" ng-click="setProjectFilter('Laravel')"
                            class="px-4 py-2 rounded-xl text-xs font-mono font-bold uppercase tracking-wider transition-all cursor-pointer"
                            ng-class="selectedCategory === 'Laravel' ? 'bg-[var(--theme-primary)] text-slate-950 shadow-md' : 'bg-slate-200 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:text-white'">
                            Laravel Backend
                        </button>
                        <button type="button" ng-click="setProjectFilter('Commerce')"
                            class="px-4 py-2 rounded-xl text-xs font-mono font-bold uppercase tracking-wider transition-all cursor-pointer"
                            ng-class="selectedCategory === 'Commerce' ? 'bg-[var(--theme-primary)] text-slate-950 shadow-md' : 'bg-slate-200 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:text-white'">
                            E-Commerce
                        </button>
                    </div>
                </div>

                <!-- Project Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($projects as $project)
                        <div class="project-card group rounded-3xl border border-slate-200 dark:border-white/10 bg-white dark:bg-[#0a0f1d] overflow-hidden shadow-lg hover:border-[var(--theme-primary)]/50 transition-all duration-300 flex flex-col justify-between"
                            data-category="{{ $project->category }}"
                            ng-show="isProjectVisible('{{ $project->category }}')">

                            <!-- Image Container -->
                            <div class="relative h-56 overflow-hidden bg-slate-900">
                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-[#0a0f1d] via-transparent to-transparent opacity-80">
                                </div>

                                <!-- Badges -->
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="px-3 py-1 rounded-full bg-slate-950/80 backdrop-blur-md border border-cyan-500/30 text-[10px] font-mono font-bold text-[var(--theme-primary)] uppercase">
                                        {{ $project->category }}
                                    </span>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-6 sm:p-7 space-y-3 flex-1 flex flex-col justify-between">
                                <div class="space-y-2">
                                    <div class="text-[11px] font-mono text-cyan-400 font-bold uppercase">
                                        {{ $project->subtitle }}
                                    </div>
                                    <h3
                                        class="text-base font-bold text-slate-900 dark:text-white font-['Outfit'] uppercase group-hover:text-[var(--theme-primary)] transition-colors">
                                        {{ $project->title }}
                                    </h3>
                                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                        {{ $project->description }}
                                    </p>
                                </div>

                                <!-- Tags & Action -->
                                <div class="pt-4 border-t border-slate-100 dark:border-white/10 space-y-3">
                                    <div
                                        class="flex flex-wrap gap-1.5 text-[10px] font-mono text-slate-500 dark:text-slate-400">
                                        @foreach (explode(',', $project->tags ?? '') as $tag)
                                            @if (trim($tag))
                                                <span
                                                    class="px-2 py-0.5 rounded bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10">
                                                    #{{ trim($tag) }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                    <a href="{{ route('portfolio') }}"
                                        class="inline-flex items-center gap-1.5 text-xs font-mono font-bold text-[var(--theme-primary)] hover:underline">
                                        <span>View Architecture Specs</span>
                                        <span>➔</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('portfolio') }}"
                        class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full border-2 border-[var(--theme-primary)] text-[var(--theme-primary)] hover:bg-[var(--theme-primary)] hover:text-slate-950 font-bold text-xs uppercase tracking-wider transition-all">
                        <span>View All Portfolio Works</span>
                        <span>➔</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- =========================================================================
                     6. TECHNICAL PROFICIENCIES & SKILLS MATRIX
                     ========================================================================= -->
        <section id="skills"
            class="py-20 bg-slate-100/70 dark:bg-[#060a12]/80 border-y border-slate-200 dark:border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
                    <span
                        class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider">
                        Core Technical Stack
                    </span>
                    <h2
                        class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">
                        SKILLS &amp; <span class="text-[var(--theme-primary)]">COMPETENCIES</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                        Comprehensive proficiencies in backend frameworks, relational databases, frontend styling, and
                        document automation.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($skills as $skill)
                        <div
                            class="p-6 rounded-2xl bg-white dark:bg-[#0a0f1d] border border-slate-200 dark:border-white/10 shadow-sm space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-bold text-slate-900 dark:text-white font-['Outfit'] uppercase">
                                    {{ $skill->name }}
                                </span>
                                <span class="text-xs font-mono font-bold text-[var(--theme-primary)]">
                                    {{ $skill->percentage }}%
                                </span>
                            </div>
                            <div class="w-full h-2 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-cyan-400 to-blue-600 rounded-full transition-all duration-1000"
                                    style="width: {{ $skill->percentage }}%;"></div>
                            </div>
                            <span class="text-[10px] font-mono text-slate-500 uppercase tracking-wider block">
                                {{ $skill->category }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- =========================================================================
                     7. WORK EXPERIENCE & EDUCATION TIMELINE (CHRONOLOGICAL FROM RESUME)
                     ========================================================================= -->
        <section id="resume" class="py-20 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
                    <span
                        class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider">
                        Career Journey
                    </span>
                    <h2
                        class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">
                        WORK EXPERIENCE <span class="text-[var(--theme-primary)]">&amp; EDUCATION</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                        Chronological career history, institutional achievements, and professional certifications from 2010
                        to 2025.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                    <!-- Work Experience Column -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-white/10">
                            <span
                                class="w-8 h-8 rounded-xl bg-cyan-500/20 text-[var(--theme-primary)] flex items-center justify-center font-bold">💼</span>
                            <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">Work
                                Experience</h3>
                        </div>

                        <div class="space-y-6">
                            @foreach ($resumeExperience as $exp)
                                <div
                                    class="p-6 rounded-3xl bg-white dark:bg-[#0a0f1d] border border-slate-200 dark:border-white/10 hover:border-cyan-500/40 transition-all space-y-3 shadow-md">
                                    <div class="flex flex-wrap items-center justify-between gap-2">
                                        <span
                                            class="px-3 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold">
                                            {{ $exp->period }}
                                        </span>
                                        <span class="text-xs font-mono text-slate-500">{{ $exp->grade }}</span>
                                    </div>
                                    <h4
                                        class="text-base font-bold text-slate-900 dark:text-white font-['Outfit'] uppercase">
                                        {{ $exp->title }}
                                    </h4>
                                    <div class="text-xs font-mono text-cyan-400 font-bold">
                                        {{ $exp->company }}
                                    </div>
                                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                        {{ $exp->description }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Education & Certifications Column -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-white/10">
                            <span
                                class="w-8 h-8 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center font-bold">🎓</span>
                            <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">
                                Education &amp; Training</h3>
                        </div>

                        <div class="space-y-6">
                            @foreach ($resumeEducation as $edu)
                                <div
                                    class="p-6 rounded-3xl bg-white dark:bg-[#0a0f1d] border border-slate-200 dark:border-white/10 hover:border-blue-500/40 transition-all space-y-3 shadow-md">
                                    <div class="flex flex-wrap items-center justify-between gap-2">
                                        <span
                                            class="px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 font-mono text-xs font-bold">
                                            {{ $edu->period }}
                                        </span>
                                        <span
                                            class="text-xs font-mono text-emerald-400 font-bold">{{ $edu->grade }}</span>
                                    </div>
                                    <h4
                                        class="text-base font-bold text-slate-900 dark:text-white font-['Outfit'] uppercase">
                                        {{ $edu->title }}
                                    </h4>
                                    <div class="text-xs font-mono text-slate-400 font-bold">
                                        {{ $edu->institution }}
                                    </div>
                                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                        {{ $edu->description }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- =========================================================================
                     7. CLIENT TESTIMONIALS (AUTO SLIDER: 5s INTERVAL, 1 ITEM PER STEP)
                     ========================================================================= -->
        <section id="testimonials"
            class="py-20 bg-slate-100/70 dark:bg-[#060a12]/80 border-t border-slate-200 dark:border-white/5 relative overflow-hidden"
            onmouseenter="pauseTestimonialsSlider()" onmouseleave="resumeTestimonialsSlider()">

            <!-- Ambient Cyber Background Glow -->
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[350px] bg-[var(--theme-primary)]/5 rounded-full blur-[140px] pointer-events-none">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

                <!-- Section Header: Title -->
                <div class="mb-12 text-center sm:text-left space-y-3">
                    <span
                        class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider inline-block">
                        // CLIENT REPUTATION
                    </span>
                    <h2
                        class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">
                        WHAT DIRECTORS &amp; <span class="text-[var(--theme-primary)]">COLLABORATORS SAY</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 max-w-xl">
                        Direct feedback from engineering leads, institutional directors, and enterprise clients who scaled
                        on my backend architectures.
                    </p>
                </div>

                <!-- Testimonials Slider Track Container (Clips overflow) -->
                <div id="testimonialsSliderContainer"
                    class="relative overflow-hidden py-2 -mx-3 select-none cursor-grab active:cursor-grabbing">
                    <div id="testimonialsTrack" class="flex transition-transform duration-500 ease-out"
                        style="transform: translateX(0%);">

                        @php
                            $uniqueCount = count($testimonials);
                            // Repeat loop so there are always enough cards to slide continuously
                            $repeatPasses = $uniqueCount < 4 ? 3 : 2;
                        @endphp

                        @for ($pass = 0; $pass < $repeatPasses; $pass++)
                            @foreach ($testimonials as $idx => $t)
                                <div class="testimonial-slide-item w-full md:w-1/2 lg:w-1/3 flex-shrink-0 px-3 box-border"
                                    data-index="{{ $idx }}">
                                    <div
                                        class="h-full p-6 sm:p-8 rounded-3xl bg-white dark:bg-[#0a0f1d] border border-slate-200 dark:border-white/10 shadow-sm hover:border-[var(--theme-primary)]/50 hover:shadow-xl dark:hover:shadow-cyan-500/5 transition-all duration-300 flex flex-col justify-between group">
                                        <div class="space-y-4">
                                            <!-- Star Rating -->
                                            <div class="flex items-center gap-1 text-[var(--theme-primary)] text-sm">
                                                @for ($i = 0; $i < ($t->rating ?? 5); $i++)
                                                    <span>★</span>
                                                @endfor
                                            </div>

                                            <!-- Quote Content -->
                                            <p
                                                class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed italic">
                                                "{{ strip_tags($t->content) }}"
                                            </p>
                                        </div>

                                        <!-- Client Identity -->
                                        <div
                                            class="pt-6 mt-6 border-t border-slate-100 dark:border-white/10 flex items-center gap-3.5">
                                            <img src="{{ !empty($t->avatar) ? (str_starts_with($t->avatar, 'http') ? $t->avatar : asset($t->avatar)) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80' }}"
                                                alt="{{ $t->client_name }}"
                                                class="w-11 h-11 rounded-full object-cover border border-cyan-500/30 flex-shrink-0">
                                            <div class="min-w-0">
                                                <h4
                                                    class="font-bold text-sm text-slate-900 dark:text-white font-['Outfit'] truncate">
                                                    {{ $t->client_name }}
                                                </h4>
                                                <p class="text-[11px] font-mono text-[var(--theme-primary)] truncate">
                                                    {{ $t->client_role }} @if (!empty($t->company))
                                                        • <span class="text-slate-400">{{ $t->company }}</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endfor

                    </div>
                </div>

                <!-- Bottom Pagination Dots & Auto-Slide Progress Bar -->
                <div class="mt-8 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <!-- Dots Pagination -->
                    <div id="testimonialDots" class="flex items-center gap-2">
                        @foreach ($testimonials as $idx => $t)
                            <button type="button" onclick="goToTestimonialSlide({{ $idx }})"
                                class="testimonial-dot-btn h-2 rounded-full transition-all cursor-pointer {{ $idx === 0 ? 'w-8 bg-[var(--theme-primary)]' : 'w-2.5 bg-slate-300 dark:bg-white/20 hover:bg-slate-400' }}"
                                data-dot="{{ $idx }}" aria-label="Go to testimonial {{ $idx + 1 }}">
                            </button>
                        @endforeach
                    </div>

                    <!-- 5-Second Timer Progress Bar -->
                    <div class="flex items-center gap-3">
                        <div class="text-[10px] font-mono text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            Next slide in 5s
                        </div>
                        <div class="w-24 sm:w-32 h-1.5 rounded-full bg-slate-200 dark:bg-white/10 overflow-hidden">
                            <div id="testimonialProgressBar"
                                class="h-full bg-[var(--theme-primary)] rounded-full testimonial-progress-active"></div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Testimonials Slider Controller Script -->
        <script>
            (function() {
                const totalUnique = {{ count($testimonials) }};
                if (totalUnique === 0) return;

                let currentIndex = 0;
                let isTransitioning = false;
                let autoSlideTimer = null;
                let isHovered = false;

                function getVisibleCount() {
                    if (window.innerWidth >= 1024) return 3;
                    if (window.innerWidth >= 768) return 2;
                    return 1;
                }

                function updateSliderPosition(animate = true) {
                    const track = document.getElementById('testimonialsTrack');
                    if (!track) return;

                    const visibleCount = getVisibleCount();
                    const stepPercent = 100 / visibleCount;

                    if (animate) {
                        track.style.transition = 'transform 0.5s cubic-bezier(0.2, 1, 0.3, 1)';
                    } else {
                        track.style.transition = 'none';
                    }

                    track.style.transform = 'translateX(-' + (currentIndex * stepPercent) + '%)';
                    updateDots(currentIndex % totalUnique);
                    resetProgressBar();
                }

                function updateDots(activeIdx) {
                    const dots = document.querySelectorAll('.testimonial-dot-btn');
                    dots.forEach((dot, i) => {
                        if (i === activeIdx) {
                            dot.classList.remove('w-2.5', 'bg-slate-300', 'dark:bg-white/20');
                            dot.classList.add('w-8', 'bg-[var(--theme-primary)]');
                        } else {
                            dot.classList.remove('w-8', 'bg-[var(--theme-primary)]');
                            dot.classList.add('w-2.5', 'bg-slate-300', 'dark:bg-white/20');
                        }
                    });
                }

                function resetProgressBar() {
                    const bar = document.getElementById('testimonialProgressBar');
                    if (!bar) return;
                    bar.classList.remove('testimonial-progress-active');
                    void bar.offsetWidth; // Force CSS reflow
                    if (!isHovered) {
                        bar.classList.add('testimonial-progress-active');
                    }
                }

                window.nextTestimonialSlide = function() {
                    if (isTransitioning) return;
                    isTransitioning = true;
                    currentIndex++;
                    updateSliderPosition(true);

                    // When we have reached the end of the first loop, silently reset to index 0 after transition
                    if (currentIndex >= totalUnique) {
                        setTimeout(() => {
                            currentIndex = 0;
                            updateSliderPosition(false);
                            isTransitioning = false;
                        }, 520);
                    } else {
                        setTimeout(() => {
                            isTransitioning = false;
                        }, 520);
                    }
                };

                window.prevTestimonialSlide = function() {
                    if (isTransitioning) return;
                    isTransitioning = true;

                    if (currentIndex === 0) {
                        currentIndex = totalUnique;
                        updateSliderPosition(false);
                        const track = document.getElementById('testimonialsTrack');
                        if (track) void track.offsetWidth;
                        setTimeout(() => {
                            currentIndex = totalUnique - 1;
                            updateSliderPosition(true);
                            setTimeout(() => {
                                isTransitioning = false;
                            }, 520);
                        }, 20);
                    } else {
                        currentIndex--;
                        updateSliderPosition(true);
                        setTimeout(() => {
                            isTransitioning = false;
                        }, 520);
                    }
                };

                window.goToTestimonialSlide = function(idx) {
                    if (isTransitioning) return;
                    currentIndex = idx % totalUnique;
                    updateSliderPosition(true);
                };

                function startAutoSlide() {
                    if (autoSlideTimer) clearInterval(autoSlideTimer);
                    autoSlideTimer = setInterval(() => {
                        if (!isHovered) {
                            window.nextTestimonialSlide();
                        }
                    }, 5000);
                }

                window.pauseTestimonialsSlider = function() {
                    isHovered = true;
                    const bar = document.getElementById('testimonialProgressBar');
                    if (bar) bar.style.animationPlayState = 'paused';
                };

                window.resumeTestimonialsSlider = function() {
                    isHovered = false;
                    const bar = document.getElementById('testimonialProgressBar');
                    if (bar) bar.style.animationPlayState = 'running';
                };

                // Window resize handler: recalculate slide width
                window.addEventListener('resize', () => {
                    updateSliderPosition(false);
                });

                // Mouse Drag & Touch Drag to Slide support
                let isDragging = false;
                let startX = 0;
                let currentX = 0;
                let hasMoved = false;

                const container = document.getElementById('testimonialsSliderContainer');
                const track = document.getElementById('testimonialsTrack');

                function getCurrentOffsetPercent() {
                    const visibleCount = getVisibleCount();
                    return -(currentIndex * (100 / visibleCount));
                }

                if (container && track) {
                    // Prevent native image dragging
                    container.addEventListener('dragstart', (e) => e.preventDefault());

                    // Mouse down
                    container.addEventListener('mousedown', (e) => {
                        if (e.button !== 0 || isTransitioning) return;
                        isDragging = true;
                        hasMoved = false;
                        startX = e.clientX;
                        currentX = e.clientX;
                        container.classList.add('cursor-grabbing');
                        container.classList.remove('cursor-grab');
                        pauseTestimonialsSlider();
                    });

                    // Mouse move
                    window.addEventListener('mousemove', (e) => {
                        if (!isDragging) return;
                        currentX = e.clientX;
                        const diffX = currentX - startX;
                        if (Math.abs(diffX) > 6) {
                            hasMoved = true;
                        }
                        const basePercent = getCurrentOffsetPercent();
                        track.style.transition = 'none';
                        track.style.transform = `translateX(calc(${basePercent}% + ${diffX}px))`;
                    });

                    function handleDragFinish() {
                        if (!isDragging) return;
                        isDragging = false;
                        container.classList.remove('cursor-grabbing');
                        container.classList.add('cursor-grab');
                        const diffX = startX - currentX;

                        if (hasMoved && Math.abs(diffX) > 40) {
                            if (diffX > 0) {
                                window.nextTestimonialSlide();
                            } else {
                                window.prevTestimonialSlide();
                            }
                        } else {
                            updateSliderPosition(true);
                        }
                        resumeTestimonialsSlider();
                    }

                    window.addEventListener('mouseup', handleDragFinish);

                    // Touch support
                    container.addEventListener('touchstart', (e) => {
                        if (isTransitioning) return;
                        isDragging = true;
                        hasMoved = false;
                        startX = e.touches[0].clientX;
                        currentX = e.touches[0].clientX;
                        pauseTestimonialsSlider();
                    }, {
                        passive: true
                    });

                    container.addEventListener('touchmove', (e) => {
                        if (!isDragging) return;
                        currentX = e.touches[0].clientX;
                        const diffX = currentX - startX;
                        if (Math.abs(diffX) > 6) {
                            hasMoved = true;
                        }
                        const basePercent = getCurrentOffsetPercent();
                        track.style.transition = 'none';
                        track.style.transform = `translateX(calc(${basePercent}% + ${diffX}px))`;
                    }, {
                        passive: true
                    });

                    container.addEventListener('touchend', handleDragFinish, {
                        passive: true
                    });

                    // Suppress click on card content if drag occurred
                    container.addEventListener('click', (e) => {
                        if (hasMoved) {
                            e.preventDefault();
                            e.stopPropagation();
                            hasMoved = false;
                        }
                    }, true);
                }

                // Start slider on load
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', () => {
                        updateSliderPosition(false);
                        startAutoSlide();
                    });
                } else {
                    updateSliderPosition(false);
                    startAutoSlide();
                }
            })();
        </script>

        <!-- =========================================================================
                     8. TECHNICAL ARTICLES & BLOG (INSIGHTS ON SOFTWARE ARCHITECTURE)
                     ========================================================================= -->
        <section id="blog" class="py-20 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-14">
                    <div class="space-y-2 text-center sm:text-left">
                        <span
                            class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider inline-block">
                            // TECHNICAL DISPATCHES
                        </span>
                        <h2
                            class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">
                            LATEST <span class="text-[var(--theme-primary)]">ENGINEERING ARTICLES</span>
                        </h2>
                    </div>
                    <a href="{{ route('blog') }}"
                        class="px-5 py-2.5 rounded-full border border-slate-200 dark:border-white/10 hover:border-[var(--theme-primary)] text-xs font-mono font-bold uppercase tracking-wider text-slate-800 dark:text-white hover:text-[var(--theme-primary)] transition-all flex items-center gap-2">
                        <span>VIEW ALL ARTICLES</span>
                        <span>→</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($blogPosts->take(4) as $post)
                        <article
                            class="p-5 rounded-3xl bg-white dark:bg-[#0a0f1d] border border-slate-200 dark:border-white/10 shadow-sm hover:border-[var(--theme-primary)]/50 hover:shadow-xl dark:hover:shadow-cyan-500/5 transition-all duration-300 flex flex-col justify-between group">
                            <div>
                                <div class="aspect-[16/10] rounded-2xl overflow-hidden bg-slate-900 mb-4 relative">
                                    <img src="{{ !empty($post->image) ? (str_starts_with($post->image, 'http') ? $post->image : asset($post->image)) : 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80' }}"
                                        alt="{{ $post->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <span
                                        class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full text-[9px] font-mono font-bold bg-slate-950/80 backdrop-blur-md text-[var(--theme-primary)] border border-cyan-500/30">
                                        {{ $post->category }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 text-[10px] font-mono text-slate-400 mb-2">
                                    <span>{{ $post->date }}</span>
                                    <span>•</span>
                                    <span>{{ $post->read_time }}</span>
                                </div>

                                <h3
                                    class="text-base font-bold font-['Outfit'] text-slate-900 dark:text-white group-hover:text-[var(--theme-primary)] transition-colors line-clamp-2 leading-snug">
                                    <a href="{{ route('blog.detail', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 line-clamp-3 leading-relaxed">
                                    {{ $post->excerpt }}
                                </p>
                            </div>

                            <div
                                class="pt-4 mt-4 border-t border-slate-100 dark:border-white/10 flex items-center justify-between text-xs font-mono">
                                <span class="text-slate-400 text-[11px]">{{ $post->author }}</span>
                                <a href="{{ route('blog.detail', $post->slug) }}"
                                    class="text-[var(--theme-primary)] font-bold hover:underline">
                                    Read →
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- =========================================================================
                     8.5. ARCHITECTURE & SYSTEM GALLERY (PHOTO SHOWCASE WITH PICTUREFLECT)
                     ========================================================================= -->
        <section id="gallery" class="py-20 border-b border-slate-200 dark:border-white/5 relative overflow-hidden bg-slate-50/50 dark:bg-[#070b14]/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                    <div>
                        <span class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider inline-block mb-3">
                            &lt;visual:gallery&gt; // PHOTO &amp; SYSTEM SHOWCASE
                        </span>
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">
                            SYSTEM &amp; WORKSPACE <span class="text-[var(--theme-primary)]">GALLERY</span>
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-2 max-w-xl">
                            Visual documentation of high-concurrency database schemas, queue worker dashboards, workstation rigs, and certifications.
                        </p>
                    </div>

                    <a href="{{ route('gallery') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-cyan-500/30 bg-cyan-500/10 hover:bg-cyan-500/20 text-[var(--theme-primary)] font-mono font-bold text-xs uppercase tracking-wider transition-all self-start md:self-auto group">
                        <span>View All Photos</span>
                        <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                </div>

                <!-- Photos Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($recentGalleries->take(8) as $item)
                        <div class="gallery-item-card rounded-2xl bg-white dark:bg-[#0b101e] border border-slate-200 dark:border-white/10 overflow-hidden shadow-md hover:border-cyan-500/50 hover:shadow-cyan-500/10 transition-all duration-300 group cursor-pointer flex flex-col justify-between"
                            data-pictureflect
                            data-gallery="home-gallery"
                            data-src="{{ $item->image_url }}"
                            data-title="{{ $item->title }}"
                            data-category="{{ $item->category }}">
                            
                            <div>
                                <div class="relative h-48 w-full overflow-hidden bg-slate-900">
                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                        onerror="this.closest('.gallery-item-card')?.remove();">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>

                                    <div class="absolute top-2.5 left-2.5 z-10">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase bg-black/75 text-cyan-300 border border-cyan-500/30 backdrop-blur">
                                            {{ $item->category }}
                                        </span>
                                    </div>

                                    <!-- Pictureflect Quick-View Hover Badge -->
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                        <span class="px-3 py-1.5 rounded-full bg-cyan-400 text-black text-xs font-bold font-mono tracking-wider uppercase shadow-lg shadow-cyan-500/30 flex items-center gap-1.5 transform translate-y-2 group-hover:translate-y-0 transition-transform">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                                <line x1="11" y1="8" x2="11" y2="14"></line>
                                                <line x1="8" y1="11" x2="14" y2="11"></line>
                                            </svg>
                                            <span>Pictureflect</span>
                                        </span>
                                    </div>
                                </div>

                                <div class="p-4 space-y-1">
                                    <h3 class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-[var(--theme-primary)] transition-colors line-clamp-2">
                                        {{ $item->title }}
                                    </h3>
                                </div>
                            </div>

                            <div class="px-4 pb-3 pt-0 flex items-center justify-between text-[10px] font-mono text-slate-400 border-t border-slate-100 dark:border-white/5 pt-2 mt-1">
                                <span class="text-[var(--theme-primary)]">#{{ $item->sort_order }}</span>
                                <span class="group-hover:text-[var(--theme-primary)] transition-colors">View Photo &rarr;</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- =========================================================================
                     9. FREQUENTLY ASKED QUESTIONS (ACCORDION POWERED BY ANGULARJS)
                     ========================================================================= -->
        <section id="faqs"
            class="py-20 bg-slate-100/70 dark:bg-[#060a12]/80 border-y border-slate-200 dark:border-white/5">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center space-y-3 mb-14">
                    <span
                        class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider">
                        Common Questions
                    </span>
                    <h2
                        class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">
                        FREQUENTLY ASKED <span class="text-[var(--theme-primary)]">QUESTIONS</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                        Straightforward answers about development process, architecture standards, delivery, and support.
                    </p>
                </div>

                <div class="space-y-4" ng-init="activeFaq = 0">
                    @foreach ($faqs as $faq)
                        <div
                            class="rounded-2xl border border-slate-200 dark:border-white/10 bg-white dark:bg-[#0a0f1d] overflow-hidden shadow-sm transition-all">
                            <button type="button"
                                ng-click="activeFaq = (activeFaq === {{ $loop->index }} ? -1 : {{ $loop->index }})"
                                class="w-full p-5 sm:p-6 text-left flex items-center justify-between gap-4 font-bold text-sm sm:text-base text-slate-900 dark:text-white font-['Outfit'] uppercase hover:text-[var(--theme-primary)] transition-colors cursor-pointer">
                                <span>{{ $faq->question }}</span>
                                <span class="text-lg font-mono text-[var(--theme-primary)]"
                                    ng-bind="activeFaq === {{ $loop->index }} ? '−' : '+'">+</span>
                            </button>
                            <div ng-show="activeFaq === {{ $loop->index }}"
                                class="px-5 sm:px-6 pb-6 text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed border-t border-slate-100 dark:border-white/5 pt-4">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- =========================================================================
                     9. DIRECT CONTACT & INQUIRY FORM (CONNECTED TO BACKEND)
                     ========================================================================= -->
        <section id="contact" class="py-20 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                    <!-- Contact Information Details -->
                    <div class="lg:col-span-5 space-y-6">
                        <span
                            class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider">
                            Get In Touch
                        </span>
                        <h2
                            class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit'] leading-tight">
                            LET'S DISCUSS YOUR <span class="text-[var(--theme-primary)]">NEXT SYSTEM</span>
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                            Have an upcoming enterprise Laravel project, custom ERP system, or need technical leadership?
                            Send an inquiry and I will review and reply within 24 hours.
                        </p>

                        <div class="space-y-4 pt-4">
                            <div
                                class="p-4 rounded-2xl bg-white dark:bg-white/[0.03] border border-slate-200 dark:border-white/10 flex items-center gap-4">
                                <span
                                    class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 text-[var(--theme-primary)] flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-[var(--theme-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-[10px] font-mono text-slate-400 uppercase">Email Directly</div>
                                    <a href="mailto:{{ $settings['contact_email'] ?? 'abdullahalahsan@hotmail.com' }}"
                                        class="text-xs font-mono font-bold text-slate-900 dark:text-white hover:text-[var(--theme-primary)]">
                                        {{ $settings['contact_email'] ?? 'abdullahalahsan@hotmail.com' }}
                                    </a>
                                </div>
                            </div>

                            <div
                                class="p-4 rounded-2xl bg-white dark:bg-white/[0.03] border border-slate-200 dark:border-white/10 flex items-center gap-4">
                                <span
                                    class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 text-[var(--theme-primary)] flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-[var(--theme-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-[10px] font-mono text-slate-400 uppercase">Direct Mobile &amp;
                                        WhatsApp</div>
                                    <a href="tel:{{ $settings['contact_phone'] ?? '+8801718926673' }}"
                                        class="text-xs font-mono font-bold text-slate-900 dark:text-white hover:text-[var(--theme-primary)]">
                                        {{ $settings['contact_phone'] ?? '+8801718926673' }}
                                    </a>
                                </div>
                            </div>

                            <div
                                class="p-4 rounded-2xl bg-white dark:bg-white/[0.03] border border-slate-200 dark:border-white/10 flex items-center gap-4">
                                <span
                                    class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 text-[var(--theme-primary)] flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-[var(--theme-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </span>
                                <div>
                                    <div class="text-[10px] font-mono text-slate-400 uppercase">Present &amp; Permanent
                                        Address</div>
                                    <div class="text-xs font-medium text-slate-900 dark:text-white">
                                        {!! $settings['contact_location'] ?? 'Sherpur Town,<br>Bangladesh' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Message Form -->
                    <div class="lg:col-span-7">
                        <div
                            class="p-8 sm:p-10 rounded-3xl border border-slate-200 dark:border-white/10 bg-white dark:bg-[#0a0f1d] shadow-xl space-y-6">
                            <div class="space-y-1">
                                <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">
                                    Send A Project Message</h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Fill in your specifications and
                                    requirements below.</p>
                            </div>

                            <form method="POST" action="{{ route('contact.submit') }}" class="space-y-4">
                                @csrf
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <label
                                            class="text-[11px] font-mono uppercase text-slate-600 dark:text-slate-400">Your
                                            Full Name *</label>
                                        <input type="text" name="name" required placeholder="e.g. John Doe"
                                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:outline-none focus:border-[var(--theme-primary)] transition-all">
                                    </div>
                                    <div class="space-y-1">
                                        <label
                                            class="text-[11px] font-mono uppercase text-slate-600 dark:text-slate-400">Email
                                            Address *</label>
                                        <input type="email" name="email" required placeholder="john@company.com"
                                            class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:outline-none focus:border-[var(--theme-primary)] transition-all">
                                    </div>
                                </div>

                                <div class="space-y-1">
                                    <label
                                        class="text-[11px] font-mono uppercase text-slate-600 dark:text-slate-400">Subject
                                        / Project Category *</label>
                                    <input type="text" name="subject" required
                                        placeholder="e.g. Enterprise ERP / Custom Laravel Backend"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:outline-none focus:border-[var(--theme-primary)] transition-all">
                                </div>

                                <div class="space-y-1">
                                    <label
                                        class="text-[11px] font-mono uppercase text-slate-600 dark:text-slate-400">Project
                                        Requirements &amp; Details *</label>
                                    <textarea name="message" rows="5" required
                                        placeholder="Tell me about your timeline, scope, existing infrastructure..."
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:outline-none focus:border-[var(--theme-primary)] transition-all resize-none"></textarea>
                                </div>

                                <button type="submit"
                                    class="w-full py-4 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-cyan-500/25 active:scale-95 transition-all cursor-pointer">
                                    <span>SEND MESSAGE DIRECTLY</span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Footer Partial -->
        @include('frontend.themes.laravel_developer.partials.footer')

    </div>

    <!-- AngularJS Controller Definition -->
    <script>
        var app = angular.module('laravelPortfolioApp', []);

        app.controller('LaravelPortfolioController', function($scope, $interval) {
            $scope.currentSlide = 0;
            $scope.totalSlides = 3;
            $scope.selectedCategory = 'all';
            var autoSlideTimer = null;

            // Slide navigation
            $scope.nextSlide = function() {
                $scope.currentSlide = ($scope.currentSlide + 1) % $scope.totalSlides;
            };

            $scope.prevSlide = function() {
                $scope.currentSlide = ($scope.currentSlide - 1 + $scope.totalSlides) % $scope.totalSlides;
            };

            $scope.setSlide = function(idx) {
                $scope.currentSlide = idx;
            };

            // Autoplay timer
            function startAutoSlider() {
                autoSlideTimer = $interval(function() {
                    $scope.nextSlide();
                }, 6000);
            }

            $scope.pauseSlider = function() {
                if (autoSlideTimer) {
                    $interval.cancel(autoSlideTimer);
                }
            };

            $scope.resumeSlider = function() {
                startAutoSlider();
            };

            startAutoSlider();

            // Project filter logic
            $scope.setProjectFilter = function(category) {
                $scope.selectedCategory = category;
            };

            $scope.isProjectVisible = function(projectCategory) {
                if ($scope.selectedCategory === 'all') return true;
                return (projectCategory || '').toLowerCase().indexOf($scope.selectedCategory.toLowerCase()) !==
                    -1;
            };

            // Keyboard arrow listener for slider
            window.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowRight') {
                    $scope.$apply(function() {
                        $scope.nextSlide();
                    });
                } else if (e.key === 'ArrowLeft') {
                    $scope.$apply(function() {
                        $scope.prevSlide();
                    });
                }
            });
        });
    </script>
@endsection
