@extends('frontend.layouts.frontend')

@section('content')
<style>
    :root {
        --theme-primary: #00e5ff;
        --theme-primary-hover: #00b4d8;
        --theme-primary-glow: rgba(0, 229, 255, 0.25);
    }

    /* Staggered Part-by-Part Hero Slide Animations */
    @keyframes partSlideDown {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    @keyframes partSlideLeft {
        0% { opacity: 0; transform: translateX(-40px); }
        100% { opacity: 1; transform: translateX(0); }
    }
    @keyframes partSlideRight {
        0% { opacity: 0; transform: translateX(40px); }
        100% { opacity: 1; transform: translateX(0); }
    }
    @keyframes partFadeUp {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    @keyframes partScaleIn {
        0% { opacity: 0; transform: scale(0.92); }
        100% { opacity: 1; transform: scale(1); }
    }
    @keyframes partBounceIn {
        0% { opacity: 0; transform: scale(0.7); }
        70% { transform: scale(1.05); }
        100% { opacity: 1; transform: scale(1); }
    }

    .slide-active .anim-part-1 { animation: partSlideDown 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards 0.1s; opacity: 0; }
    .slide-active .anim-part-2 { animation: partSlideLeft 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards 0.25s; opacity: 0; }
    .slide-active .anim-part-3 { animation: partSlideRight 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards 0.4s; opacity: 0; }
    .slide-active .anim-part-4 { animation: partFadeUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards 0.55s; opacity: 0; }
    .slide-active .anim-part-5 { animation: partFadeUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards 0.7s; opacity: 0; }
    .slide-active .anim-part-6 { animation: partScaleIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards 0.35s; opacity: 0; }
    .slide-active .anim-part-7 { animation: partBounceIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards 0.85s; opacity: 0; }

    /* Slider Progress Bar Animation */
    @keyframes progressTimer {
        0% { width: 0%; }
        100% { width: 100%; }
    }
    .slider-progress-running {
        animation: progressTimer 6s linear infinite;
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
    <section id="heroSlider" class="relative pt-8 sm:pt-12 pb-16 sm:pb-24 overflow-hidden border-b border-slate-200 dark:border-white/5"
        ng-mouseenter="pauseSlider()" ng-mouseleave="resumeSlider()">
        
        <!-- Ambient Cyber Background Grid & Lighting -->
        <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.05] pointer-events-none"
            style="background-image: radial-gradient(var(--theme-primary) 1px, transparent 1px); background-size: 32px 32px;"></div>
        <div class="absolute -top-32 left-1/4 w-[500px] h-[500px] bg-[var(--theme-primary)]/10 rounded-full blur-[160px] pointer-events-none -z-10"></div>
        <div class="absolute top-1/2 right-10 w-[450px] h-[450px] bg-blue-600/10 rounded-full blur-[160px] pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Slide Container: Cycles through slides array -->
            <div class="min-h-[520px] lg:min-h-[560px] flex items-center">

                <!-- SLIDE 1: Enterprise Laravel Backend & Architecture -->
                <div ng-show="currentSlide === 0" class="w-full slide-active">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                        <!-- Left Column (7 cols): Staggered Animated Elements -->
                        <div class="lg:col-span-7 space-y-6">
                            <!-- Part 1: Top Tag -->
                            <div class="anim-part-1 inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-500/10 border border-[var(--theme-primary)]/30 text-[var(--theme-primary)] text-xs font-mono font-bold">
                                <span class="w-2 h-2 rounded-full bg-[var(--theme-primary)] animate-ping"></span>
                                <span>// FULL-STACK LARAVEL ARCHITECT</span>
                            </div>

                            <!-- Part 2 & 3: Headline with Dual Lines -->
                            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight text-slate-900 dark:text-white font-['Outfit'] uppercase leading-[1.05]">
                                <span class="anim-part-2 block text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500">
                                    SCALABLE BACKENDS
                                </span>
                                <span class="anim-part-3 block text-slate-800 dark:text-slate-100">
                                    CRAFTED IN LARAVEL 11
                                </span>
                            </h1>

                            <!-- Part 4: Description & Tech Chips -->
                            <p class="anim-part-4 text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed max-w-xl">
                                Hi, I am <strong class="text-slate-900 dark:text-white">Md. Abdullah Al Ahsan</strong>. I engineer high-concurrency Laravel platforms, decoupled RESTful APIs, multi-tenant databases, and automated document generation engines built for bulletproof reliability.
                            </p>

                            <!-- Part 5: Tech Pills & CTAs -->
                            <div class="anim-part-5 space-y-6">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="px-3 py-1 rounded-lg bg-slate-200 dark:bg-white/5 border border-slate-300 dark:border-white/10 text-xs font-mono text-[var(--theme-primary)] font-bold">Laravel 11</span>
                                    <span class="px-3 py-1 rounded-lg bg-slate-200 dark:bg-white/5 border border-slate-300 dark:border-white/10 text-xs font-mono text-cyan-400 font-bold">PHP 8.3</span>
                                    <span class="px-3 py-1 rounded-lg bg-slate-200 dark:bg-white/5 border border-slate-300 dark:border-white/10 text-xs font-mono text-blue-400 font-bold">MySQL</span>
                                    <span class="px-3 py-1 rounded-lg bg-slate-200 dark:bg-white/5 border border-slate-300 dark:border-white/10 text-xs font-mono text-indigo-400 font-bold">Tailwind CSS</span>
                                    <span class="px-3 py-1 rounded-lg bg-slate-200 dark:bg-white/5 border border-slate-300 dark:border-white/10 text-xs font-mono text-emerald-400 font-bold">AngularJS</span>
                                    <span class="px-3 py-1 rounded-lg bg-slate-200 dark:bg-white/5 border border-slate-300 dark:border-white/10 text-xs font-mono text-amber-400 font-bold">REST APIs</span>
                                </div>

                                <div class="flex flex-wrap items-center gap-4">
                                    <a href="#contact" class="px-6 py-3.5 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-xs sm:text-sm uppercase tracking-wider shadow-lg shadow-cyan-500/25 active:scale-95 transition-all flex items-center gap-2">
                                        <span>HIRE ME FOR PROJECTS</span>
                                        <span>➔</span>
                                    </a>
                                    <a href="#portfolio" class="px-6 py-3.5 rounded-full border-2 border-slate-300 dark:border-white/20 hover:border-[var(--theme-primary)] text-slate-800 dark:text-white font-bold text-xs sm:text-sm uppercase tracking-wider hover:bg-white/5 active:scale-95 transition-all">
                                        <span>VIEW PRODUCTION CODE</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column (5 cols): Interactive Code Terminal Simulator -->
                        <div class="lg:col-span-5 relative">
                            <!-- Part 6: Live Code Terminal Simulator -->
                            <div class="anim-part-6 rounded-2xl border border-slate-300 dark:border-white/10 bg-slate-900 shadow-2xl p-4 sm:p-5 font-mono text-xs text-slate-300 space-y-3 relative overflow-hidden backdrop-blur-xl">
                                <!-- Terminal Top Bar -->
                                <div class="flex items-center justify-between pb-3 border-b border-white/10 text-[11px] text-slate-400">
                                    <div class="flex items-center gap-1.5">
                                        <span class="w-3 h-3 rounded-full bg-rose-500 inline-block"></span>
                                        <span class="w-3 h-3 rounded-full bg-amber-500 inline-block"></span>
                                        <span class="w-3 h-3 rounded-full bg-emerald-500 inline-block"></span>
                                        <span class="ml-2 font-bold text-slate-300">OrderInvoiceService.php</span>
                                    </div>
                                    <span class="text-[10px] text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20 font-bold">● 200 OK — 24ms</span>
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
                            <div class="anim-part-7 absolute -bottom-4 -left-4 px-4 py-2.5 rounded-2xl bg-white/95 dark:bg-[#0c1220]/95 border border-[var(--theme-primary)]/40 shadow-xl backdrop-blur-md flex items-center gap-3">
                                <span class="w-8 h-8 rounded-xl bg-[var(--theme-primary)]/20 text-[var(--theme-primary)] flex items-center justify-center font-bold text-base">⬡</span>
                                <div>
                                    <div class="text-xs font-black font-['Outfit'] text-slate-900 dark:text-white uppercase">8+ YEARS EXPERIENCE</div>
                                    <div class="text-[10px] font-mono text-emerald-400 font-bold">PROVEN PRODUCTION CODE</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 2: ERP, POS & Business Software (BBGC, Rafiq Ent, Devzet) -->
                <div ng-show="currentSlide === 1" class="w-full slide-active">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                        <div class="lg:col-span-7 space-y-6">
                            <div class="anim-part-1 inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-mono font-bold">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                                <span>// ENTERPRISE ERP &amp; POS SYSTEMS</span>
                            </div>

                            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight text-slate-900 dark:text-white font-['Outfit'] uppercase leading-[1.05]">
                                <span class="anim-part-2 block text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-400 to-cyan-500">
                                    CUSTOM ERP &amp; POS
                                </span>
                                <span class="anim-part-3 block text-slate-800 dark:text-slate-100">
                                    AUTOMATED WORKFLOWS
                                </span>
                            </h1>

                            <p class="anim-part-4 text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed max-w-xl">
                                Built real-world systems including the <strong class="text-slate-900 dark:text-white">BBGC School Management ERP</strong> (Coordinator pattern), <strong class="text-slate-900 dark:text-white">Rafiq Ent Point-of-Sale &amp; Inventory</strong>, and <strong class="text-slate-900 dark:text-white">Devzet Automated PDF Invoicing</strong> engine.
                            </p>

                            <div class="anim-part-5 flex flex-wrap items-center gap-4">
                                <a href="#portfolio" class="px-6 py-3.5 rounded-full bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold text-xs sm:text-sm uppercase tracking-wider shadow-lg shadow-emerald-500/25 active:scale-95 transition-all flex items-center gap-2">
                                    <span>EXPLORE ERP &amp; POS CASE STUDIES</span>
                                    <span>➔</span>
                                </a>
                                <a href="#skills" class="px-6 py-3.5 rounded-full border-2 border-slate-300 dark:border-white/20 hover:border-emerald-400 text-slate-800 dark:text-white font-bold text-xs sm:text-sm uppercase tracking-wider hover:bg-white/5 active:scale-95 transition-all">
                                    <span>VIEW ARCHITECTURE SKILLS</span>
                                </a>
                            </div>
                        </div>

                        <!-- Right Column: Visual Dashboard Preview Card -->
                        <div class="lg:col-span-5 relative">
                            <div class="anim-part-6 rounded-2xl border border-emerald-500/30 bg-slate-900 p-6 shadow-2xl space-y-4 font-mono text-xs text-slate-300">
                                <div class="flex items-center justify-between pb-3 border-b border-white/10">
                                    <span class="text-xs font-bold text-emerald-400 uppercase tracking-wider">Enterprise POS &amp; ERP Node</span>
                                    <span class="text-[10px] font-bold text-white bg-emerald-600 px-2.5 py-0.5 rounded-full">ACTIVE NODE</span>
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
                                        <div class="h-full bg-gradient-to-r from-emerald-400 to-cyan-400 rounded-full" style="width: 99.98%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 3: Modern Reactive Frontend Meets High-Performance Backend -->
                <div ng-show="currentSlide === 2" class="w-full slide-active">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                        <div class="lg:col-span-7 space-y-6">
                            <div class="anim-part-1 inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/30 text-indigo-400 text-xs font-mono font-bold">
                                <span class="w-2 h-2 rounded-full bg-indigo-400 animate-ping"></span>
                                <span>// TAILWIND CSS &amp; ANGULARJS STACK</span>
                            </div>

                            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight text-slate-900 dark:text-white font-['Outfit'] uppercase leading-[1.05]">
                                <span class="anim-part-2 block text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-500">
                                    REACTIVE FRONTENDS
                                </span>
                                <span class="anim-part-3 block text-slate-800 dark:text-slate-100">
                                    ROBUST BACKENDS
                                </span>
                            </h1>

                            <p class="anim-part-4 text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed max-w-xl">
                                Seamless user experience combining modern <strong class="text-slate-900 dark:text-white">Tailwind CSS utility design</strong> with <strong class="text-slate-900 dark:text-white">AngularJS reactive controllers</strong> for sub-second page transitions, dynamic filters, and real-time state synchronization.
                            </p>

                            <div class="anim-part-5 flex flex-wrap items-center gap-4">
                                <a href="#contact" class="px-6 py-3.5 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold text-xs sm:text-sm uppercase tracking-wider shadow-lg shadow-indigo-500/25 active:scale-95 transition-all flex items-center gap-2">
                                    <span>START A PROJECT</span>
                                    <span>➔</span>
                                </a>
                                <button type="button" onclick="togglePaletteMenu()" class="px-6 py-3.5 rounded-full border-2 border-indigo-500/40 hover:border-indigo-400 text-slate-800 dark:text-white font-bold text-xs sm:text-sm uppercase tracking-wider hover:bg-white/5 active:scale-95 transition-all cursor-pointer">
                                    <span>TRY MATERIAL PALETTES</span>
                                </button>
                            </div>
                        </div>

                        <!-- Right Column: Interactive UI Components -->
                        <div class="lg:col-span-5 relative">
                            <div class="anim-part-6 rounded-2xl border border-indigo-500/30 bg-slate-900 p-6 shadow-2xl space-y-4">
                                <div class="flex items-center justify-between pb-3 border-b border-white/10">
                                    <span class="text-xs font-mono font-bold text-indigo-400 uppercase">Dynamic Component Deck</span>
                                    <span class="text-[10px] font-mono text-purple-400">AngularJS Reactive</span>
                                </div>
                                <div class="space-y-3">
                                    <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <span class="w-8 h-8 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center font-bold">⚡</span>
                                            <div>
                                                <div class="text-xs font-bold text-white">Instant Reactive Filter</div>
                                                <div class="text-[10px] text-slate-400">Zero page refresh</div>
                                            </div>
                                        </div>
                                        <span class="text-xs font-mono text-emerald-400 font-bold">&lt; 15ms</span>
                                    </div>
                                    <div class="p-3.5 rounded-xl bg-white/5 border border-white/10 flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <span class="w-8 h-8 rounded-lg bg-pink-500/20 text-pink-400 flex items-center justify-center font-bold">🎨</span>
                                            <div>
                                                <div class="text-xs font-bold text-white">Dynamic Material Color System</div>
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
            <div class="mt-8 pt-6 border-t border-slate-200 dark:border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                
                <!-- Slide Indicators & Progress Timer -->
                <div class="flex items-center gap-3">
                    <button type="button" ng-click="setSlide(0)" class="w-10 h-2 rounded-full transition-all cursor-pointer"
                        ng-class="currentSlide === 0 ? 'bg-[var(--theme-primary)] w-14' : 'bg-slate-300 dark:bg-white/20'"></button>
                    <button type="button" ng-click="setSlide(1)" class="w-10 h-2 rounded-full transition-all cursor-pointer"
                        ng-class="currentSlide === 1 ? 'bg-emerald-400 w-14' : 'bg-slate-300 dark:bg-white/20'"></button>
                    <button type="button" ng-click="setSlide(2)" class="w-10 h-2 rounded-full transition-all cursor-pointer"
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
                <div class="p-4 rounded-2xl bg-white dark:bg-white/[0.02] border border-slate-200 dark:border-white/5 shadow-sm">
                    <div class="text-3xl sm:text-4xl font-black text-[var(--theme-primary)] font-['Outfit']">8+</div>
                    <div class="text-xs font-mono font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 mt-1">Years Experience</div>
                </div>
                <div class="p-4 rounded-2xl bg-white dark:bg-white/[0.02] border border-slate-200 dark:border-white/5 shadow-sm">
                    <div class="text-3xl sm:text-4xl font-black text-cyan-400 font-['Outfit']">45+</div>
                    <div class="text-xs font-mono font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 mt-1">Production Projects</div>
                </div>
                <div class="p-4 rounded-2xl bg-white dark:bg-white/[0.02] border border-slate-200 dark:border-white/5 shadow-sm">
                    <div class="text-3xl sm:text-4xl font-black text-emerald-400 font-['Outfit']">30+</div>
                    <div class="text-xs font-mono font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 mt-1">Satisfied Clients</div>
                </div>
                <div class="p-4 rounded-2xl bg-white dark:bg-white/[0.02] border border-slate-200 dark:border-white/5 shadow-sm">
                    <div class="text-3xl sm:text-4xl font-black text-amber-400 font-['Outfit']">Level-3</div>
                    <div class="text-xs font-mono font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 mt-1">NSDA National Cert</div>
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
                    <div class="rounded-3xl border border-slate-200 dark:border-white/10 bg-white dark:bg-[#0a0f1d] p-6 sm:p-8 shadow-xl space-y-6">
                        <div class="flex items-center gap-4 pb-6 border-b border-slate-100 dark:border-white/10">
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-[var(--theme-primary)] via-blue-600 to-indigo-700 text-white flex items-center justify-center font-bold text-2xl font-mono shadow-md">
                                AA
                            </div>
                            <div>
                                <h3 class="text-lg font-black text-slate-900 dark:text-white uppercase font-['Outfit']">Md. Abdullah Al Ahsan</h3>
                                <p class="text-xs font-mono text-[var(--theme-primary)] font-bold">Full-Stack Laravel Developer</p>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">Sherpur Town, Sherpur, Bangladesh</p>
                            </div>
                        </div>

                        <!-- Personal Information Table (Exact Data from PDF) -->
                        <div class="space-y-3 text-xs">
                            <h4 class="font-mono font-bold uppercase tracking-wider text-[var(--theme-primary)] text-[11px]">Personal Profile</h4>
                            <div class="grid grid-cols-2 gap-2 text-slate-600 dark:text-slate-400">
                                <div><span class="text-slate-400">Father's Name:</span></div>
                                <div class="font-semibold text-slate-800 dark:text-slate-200">Md. Abdur Rahman</div>

                                <div><span class="text-slate-400">Date of Birth:</span></div>
                                <div class="font-semibold text-slate-800 dark:text-slate-200 font-mono">06-08-1990</div>

                                <div><span class="text-slate-400">Nationality:</span></div>
                                <div class="font-semibold text-slate-800 dark:text-slate-200">Bangladeshi (By Birth)</div>

                                <div><span class="text-slate-400">Marital Status:</span></div>
                                <div class="font-semibold text-slate-800 dark:text-slate-200">Married</div>

                                <div><span class="text-slate-400">Religion:</span></div>
                                <div class="font-semibold text-slate-800 dark:text-slate-200">Islam (Sunni)</div>

                                <div><span class="text-slate-400">Blood Group:</span></div>
                                <div class="font-semibold text-rose-500 font-bold font-mono">AB+</div>

                                <div><span class="text-slate-400">Mobile Phone:</span></div>
                                <div class="font-semibold text-[var(--theme-primary)] font-mono">+8801718926673</div>

                                <div><span class="text-slate-400">Email Address:</span></div>
                                <div class="font-semibold text-slate-800 dark:text-slate-200 font-mono text-[11px] break-all">abdullahalahsan1990@gmail.com</div>
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
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider">
                        <span>About The Developer</span>
                    </div>

                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit'] leading-tight">
                        CRAFTING RESILIENT ARCHITECTURES <span class="text-[var(--theme-primary)]">&amp; BUSINESS ENGINES</span>
                    </h2>

                    <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
                        Highly motivated and detail-oriented Full-Stack Laravel Developer and Computer Professional with strong expertise in enterprise backend architecture, RESTful API design, database modeling, and modern web application development. Skilled in maintaining accurate records, supporting digital workflows, and providing reliable technical leadership to ensure smooth administrative and operational processes.
                    </p>

                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 leading-relaxed">
                        Extensive hands-on engineering history at <strong>Devzet LLC</strong> (Modhupur) building custom orders and automated PDF invoicing engines, and at <strong>Freelance IT Lab</strong> (Mymensingh) managing school ERP and POS platforms. Dedicated to delivering precision, maintaining data integrity, and contributing to organizational efficiency.
                    </p>

                    <!-- Core Strengths from Resume -->
                    <div class="pt-4 space-y-3">
                        <h4 class="font-mono font-bold uppercase tracking-wider text-xs text-slate-900 dark:text-white">Core Strengths &amp; Work Ethic</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="p-3.5 rounded-2xl bg-white dark:bg-white/[0.03] border border-slate-200 dark:border-white/10 flex items-start gap-3">
                                <span class="text-[var(--theme-primary)] text-base font-bold">✔</span>
                                <div class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed">
                                    <strong>Precision &amp; Accuracy:</strong> Strong attention to detail and accuracy in handling mission-critical and sensitive data.
                                </div>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-white dark:bg-white/[0.03] border border-slate-200 dark:border-white/10 flex items-start gap-3">
                                <span class="text-[var(--theme-primary)] text-base font-bold">✔</span>
                                <div class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed">
                                    <strong>High Pressure Agility:</strong> Proven ability to execute under pressure and deliver projects within tight production deadlines.
                                </div>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-white dark:bg-white/[0.03] border border-slate-200 dark:border-white/10 flex items-start gap-3">
                                <span class="text-[var(--theme-primary)] text-base font-bold">✔</span>
                                <div class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed">
                                    <strong>Fast Learner &amp; Adaptable:</strong> Rapidly master new frameworks, architectural patterns, and cloud infrastructures.
                                </div>
                            </div>
                            <div class="p-3.5 rounded-2xl bg-white dark:bg-white/[0.03] border border-slate-200 dark:border-white/10 flex items-start gap-3">
                                <span class="text-[var(--theme-primary)] text-base font-bold">✔</span>
                                <div class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed">
                                    <strong>Team Player &amp; Communicator:</strong> Effective collaborator with transparent communication and training abilities.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex flex-wrap items-center gap-4">
                        <a href="#contact" class="px-6 py-3 rounded-full bg-[var(--theme-primary)] text-slate-950 font-bold text-xs uppercase tracking-wider hover:opacity-90 active:scale-95 transition-all shadow-md">
                            Get In Touch
                        </a>
                        <a href="#resume" class="px-6 py-3 rounded-full border border-slate-300 dark:border-white/20 hover:border-[var(--theme-primary)] text-slate-800 dark:text-white font-bold text-xs uppercase tracking-wider hover:bg-white/5 active:scale-95 transition-all">
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
    <section id="services" class="py-20 bg-slate-100/70 dark:bg-[#060a12]/80 border-y border-slate-200 dark:border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
                <span class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider">
                    Services &amp; Capabilities
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">
                    FULL-SPECTRUM <span class="text-[var(--theme-primary)]">DEVELOPMENT</span>
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    Delivering end-to-end web engineering, from database architecture and backend business logic to reactive client-side interfaces.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($services as $service)
                    <div class="group p-8 rounded-3xl bg-white dark:bg-[#0a0f1d] border border-slate-200 dark:border-white/10 hover:border-[var(--theme-primary)]/50 shadow-lg hover:shadow-cyan-500/10 transition-all duration-300 flex flex-col justify-between space-y-6">
                        <div class="space-y-4">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-cyan-500/20 to-blue-600/20 text-[var(--theme-primary)] flex items-center justify-center text-2xl border border-cyan-500/30 group-hover:scale-110 transition-transform">
                                ⬢
                            </div>
                            <span class="text-[10px] font-mono font-bold text-[var(--theme-primary)] uppercase tracking-wider block">
                                {{ $service->category }}
                            </span>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white font-['Outfit'] uppercase group-hover:text-[var(--theme-primary)] transition-colors">
                                {{ $service->title }}
                            </h3>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                {{ $service->description }}
                            </p>
                        </div>
                        <div class="pt-4 border-t border-slate-100 dark:border-white/10 flex items-center justify-between text-xs font-mono font-bold text-slate-500 dark:text-slate-400">
                            <span>0{{ $loop->iteration }}</span>
                            <a href="#contact" class="hover:text-[var(--theme-primary)] flex items-center gap-1 transition-colors">
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
                    <span class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider">
                        Production Portfolio
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit'] mt-2">
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
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0f1d] via-transparent to-transparent opacity-80"></div>
                            
                            <!-- Badges -->
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 rounded-full bg-slate-950/80 backdrop-blur-md border border-cyan-500/30 text-[10px] font-mono font-bold text-[var(--theme-primary)] uppercase">
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
                                <h3 class="text-base font-bold text-slate-900 dark:text-white font-['Outfit'] uppercase group-hover:text-[var(--theme-primary)] transition-colors">
                                    {{ $project->title }}
                                </h3>
                                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                    {{ $project->description }}
                                </p>
                            </div>

                            <!-- Tags & Action -->
                            <div class="pt-4 border-t border-slate-100 dark:border-white/10 space-y-3">
                                <div class="flex flex-wrap gap-1.5 text-[10px] font-mono text-slate-500 dark:text-slate-400">
                                    @foreach (explode(',', $project->tags ?? '') as $tag)
                                        @if(trim($tag))
                                            <span class="px-2 py-0.5 rounded bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10">
                                                #{{ trim($tag) }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                                <a href="{{ route('portfolio') }}" class="inline-flex items-center gap-1.5 text-xs font-mono font-bold text-[var(--theme-primary)] hover:underline">
                                    <span>View Architecture Specs</span>
                                    <span>➔</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('portfolio') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full border-2 border-[var(--theme-primary)] text-[var(--theme-primary)] hover:bg-[var(--theme-primary)] hover:text-slate-950 font-bold text-xs uppercase tracking-wider transition-all">
                    <span>View All Portfolio Works</span>
                    <span>➔</span>
                </a>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         6. TECHNICAL PROFICIENCIES & SKILLS MATRIX
         ========================================================================= -->
    <section id="skills" class="py-20 bg-slate-100/70 dark:bg-[#060a12]/80 border-y border-slate-200 dark:border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
                <span class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider">
                    Core Technical Stack
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">
                    SKILLS &amp; <span class="text-[var(--theme-primary)]">COMPETENCIES</span>
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    Comprehensive proficiencies in backend frameworks, relational databases, frontend styling, and document automation.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($skills as $skill)
                    <div class="p-6 rounded-2xl bg-white dark:bg-[#0a0f1d] border border-slate-200 dark:border-white/10 shadow-sm space-y-3">
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
                <span class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider">
                    Career Journey
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">
                    WORK EXPERIENCE <span class="text-[var(--theme-primary)]">&amp; EDUCATION</span>
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    Chronological career history, institutional achievements, and professional certifications from 2010 to 2025.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <!-- Work Experience Column -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-white/10">
                        <span class="w-8 h-8 rounded-xl bg-cyan-500/20 text-[var(--theme-primary)] flex items-center justify-center font-bold">💼</span>
                        <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">Work Experience</h3>
                    </div>

                    <div class="space-y-6">
                        @foreach ($resumeExperience as $exp)
                            <div class="p-6 rounded-3xl bg-white dark:bg-[#0a0f1d] border border-slate-200 dark:border-white/10 hover:border-cyan-500/40 transition-all space-y-3 shadow-md">
                                <div class="flex flex-wrap items-center justify-between gap-2">
                                    <span class="px-3 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold">
                                        {{ $exp->period }}
                                    </span>
                                    <span class="text-xs font-mono text-slate-500">{{ $exp->grade }}</span>
                                </div>
                                <h4 class="text-base font-bold text-slate-900 dark:text-white font-['Outfit'] uppercase">
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
                        <span class="w-8 h-8 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center font-bold">🎓</span>
                        <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">Education &amp; Training</h3>
                    </div>

                    <div class="space-y-6">
                        @foreach ($resumeEducation as $edu)
                            <div class="p-6 rounded-3xl bg-white dark:bg-[#0a0f1d] border border-slate-200 dark:border-white/10 hover:border-blue-500/40 transition-all space-y-3 shadow-md">
                                <div class="flex flex-wrap items-center justify-between gap-2">
                                    <span class="px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 font-mono text-xs font-bold">
                                        {{ $edu->period }}
                                    </span>
                                    <span class="text-xs font-mono text-emerald-400 font-bold">{{ $edu->grade }}</span>
                                </div>
                                <h4 class="text-base font-bold text-slate-900 dark:text-white font-['Outfit'] uppercase">
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
         8. FREQUENTLY ASKED QUESTIONS (ACCORDION POWERED BY ANGULARJS)
         ========================================================================= -->
    <section id="faqs" class="py-20 bg-slate-100/70 dark:bg-[#060a12]/80 border-y border-slate-200 dark:border-white/5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center space-y-3 mb-14">
                <span class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider">
                    Common Questions
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">
                    FREQUENTLY ASKED <span class="text-[var(--theme-primary)]">QUESTIONS</span>
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                    Straightforward answers about development process, architecture standards, delivery, and support.
                </p>
            </div>

            <div class="space-y-4">
                @foreach ($faqs as $faq)
                    <div class="rounded-2xl border border-slate-200 dark:border-white/10 bg-white dark:bg-[#0a0f1d] overflow-hidden shadow-sm transition-all"
                        ng-init="openFaq_{{ $loop->index }} = {{ $loop->first ? 'true' : 'false' }}">
                        <button type="button" ng-click="openFaq_{{ $loop->index }} = !openFaq_{{ $loop->index }}"
                            class="w-full p-5 sm:p-6 text-left flex items-center justify-between gap-4 font-bold text-sm sm:text-base text-slate-900 dark:text-white font-['Outfit'] uppercase hover:text-[var(--theme-primary)] transition-colors cursor-pointer">
                            <span>{{ $faq->question }}</span>
                            <span class="text-lg font-mono text-[var(--theme-primary)]" ng-bind="openFaq_{{ $loop->index }} ? '−' : '+'">+</span>
                        </button>
                        <div ng-show="openFaq_{{ $loop->index }}" class="px-5 sm:px-6 pb-6 text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed border-t border-slate-100 dark:border-white/5 pt-4">
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
                    <span class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-[var(--theme-primary)] font-mono text-xs font-bold uppercase tracking-wider">
                        Get In Touch
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white uppercase font-['Outfit'] leading-tight">
                        LET'S DISCUSS YOUR <span class="text-[var(--theme-primary)]">NEXT SYSTEM</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        Have an upcoming enterprise Laravel project, custom ERP system, or need technical leadership? Send an inquiry and I will review and reply within 24 hours.
                    </p>

                    <div class="space-y-4 pt-4">
                        <div class="p-4 rounded-2xl bg-white dark:bg-white/[0.03] border border-slate-200 dark:border-white/10 flex items-center gap-4">
                            <span class="w-10 h-10 rounded-xl bg-cyan-500/20 text-[var(--theme-primary)] flex items-center justify-center text-lg">✉</span>
                            <div>
                                <div class="text-[10px] font-mono text-slate-400 uppercase">Email Directly</div>
                                <a href="mailto:abdullahalahsan1990@gmail.com" class="text-xs font-mono font-bold text-slate-900 dark:text-white hover:text-[var(--theme-primary)]">
                                    abdullahalahsan1990@gmail.com
                                </a>
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl bg-white dark:bg-white/[0.03] border border-slate-200 dark:border-white/10 flex items-center gap-4">
                            <span class="w-10 h-10 rounded-xl bg-cyan-500/20 text-[var(--theme-primary)] flex items-center justify-center text-lg">☎</span>
                            <div>
                                <div class="text-[10px] font-mono text-slate-400 uppercase">Direct Mobile &amp; WhatsApp</div>
                                <a href="tel:+8801718926673" class="text-xs font-mono font-bold text-slate-900 dark:text-white hover:text-[var(--theme-primary)]">
                                    +8801718926673
                                </a>
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl bg-white dark:bg-white/[0.03] border border-slate-200 dark:border-white/10 flex items-center gap-4">
                            <span class="w-10 h-10 rounded-xl bg-cyan-500/20 text-[var(--theme-primary)] flex items-center justify-center text-lg">📍</span>
                            <div>
                                <div class="text-[10px] font-mono text-slate-400 uppercase">Present &amp; Permanent Address</div>
                                <div class="text-xs font-medium text-slate-900 dark:text-white">
                                    53/20, Razbollovpur, Sherpur Town, Sherpur, Bangladesh
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Message Form -->
                <div class="lg:col-span-7">
                    <div class="p-8 sm:p-10 rounded-3xl border border-slate-200 dark:border-white/10 bg-white dark:bg-[#0a0f1d] shadow-xl space-y-6">
                        <div class="space-y-1">
                            <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase font-['Outfit']">Send A Project Message</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Fill in your specifications and requirements below.</p>
                        </div>

                        <form method="POST" action="{{ route('contact.submit') }}" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="text-[11px] font-mono uppercase text-slate-600 dark:text-slate-400">Your Full Name *</label>
                                    <input type="text" name="name" required placeholder="e.g. John Doe"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:outline-none focus:border-[var(--theme-primary)] transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[11px] font-mono uppercase text-slate-600 dark:text-slate-400">Email Address *</label>
                                    <input type="email" name="email" required placeholder="john@company.com"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:outline-none focus:border-[var(--theme-primary)] transition-all">
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="text-[11px] font-mono uppercase text-slate-600 dark:text-slate-400">Subject / Project Category *</label>
                                <input type="text" name="subject" required placeholder="e.g. Enterprise ERP / Custom Laravel Backend"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs sm:text-sm text-slate-900 dark:text-white focus:outline-none focus:border-[var(--theme-primary)] transition-all">
                            </div>

                            <div class="space-y-1">
                                <label class="text-[11px] font-mono uppercase text-slate-600 dark:text-slate-400">Project Requirements &amp; Details *</label>
                                <textarea name="message" rows="5" required placeholder="Tell me about your timeline, scope, existing infrastructure..."
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
            return (projectCategory || '').toLowerCase().indexOf($scope.selectedCategory.toLowerCase()) !== -1;
        };

        // Keyboard arrow listener for slider
        window.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowRight') {
                $scope.$apply(function() { $scope.nextSlide(); });
            } else if (e.key === 'ArrowLeft') {
                $scope.$apply(function() { $scope.prevSlide(); });
            }
        });
    });
</script>
@endsection

