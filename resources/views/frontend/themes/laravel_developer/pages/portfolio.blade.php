@extends('frontend.layouts.frontend')

@section('content')
<style>
    :root {
        --theme-primary: #00e5ff;
        --theme-primary-hover: #00b4d8;
        --theme-primary-glow: rgba(0, 229, 255, 0.25);
    }
</style>

<!-- Load AngularJS -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>

<div ng-app="portfolioApp" ng-controller="PortfolioPageController"
    class="laravel-dev-wrapper bg-slate-50 dark:bg-[#070b14] text-slate-900 dark:text-slate-100 min-h-screen selection:bg-[var(--theme-primary)] selection:text-black font-['Plus_Jakarta_Sans'] transition-colors duration-300 relative">

    <!-- Header Partial -->
    @include('frontend.themes.laravel_developer.partials.header')

    <!-- Page Title / Hero -->
    <section class="py-16 sm:py-20 border-b border-slate-200 dark:border-white/5 relative overflow-hidden bg-slate-100/60 dark:bg-[#0a0f1d]/60">
        <!-- Ambient Cyber Glows -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-[var(--theme-primary)]/10 rounded-full blur-[140px] pointer-events-none -z-10"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 bg-blue-600/10 rounded-full blur-[140px] pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-[var(--theme-primary)] text-xs font-mono font-bold w-fit mb-4">
                <span>&lt;code:deployments&gt;</span>
                <span>// ARCHITECTURAL PORTFOLIO</span>
            </div>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-slate-900 dark:text-white">
                FEATURED <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500">PROJECTS &amp;</span> SYSTEMS
            </h1>
            <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-3 max-w-3xl leading-relaxed">
                Mission-critical enterprise ERPs, high-traffic multi-store POS engines, dynamic invoice backends, and decoupled RESTful APIs engineered by Md. Abdullah Al Ahsan.
            </p>

            <!-- AngularJS Interactive Filter Tabs -->
            <div class="flex flex-wrap items-center gap-2 pt-8">
                <button type="button" ng-click="setCategory('all')"
                    ng-class="{'bg-[var(--theme-primary)] text-black font-bold shadow-md shadow-cyan-500/20': selectedCategory === 'all', 'bg-white dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:text-white border border-slate-200 dark:border-white/10': selectedCategory !== 'all'}"
                    class="px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer">
                    All Systems ({{ count($projects) }})
                </button>
                <button type="button" ng-click="setCategory('ERP Systems')"
                    ng-class="{'bg-[var(--theme-primary)] text-black font-bold shadow-md shadow-cyan-500/20': selectedCategory === 'ERP Systems', 'bg-white dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:text-white border border-slate-200 dark:border-white/10': selectedCategory !== 'ERP Systems'}"
                    class="px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer">
                    ERP &amp; Management
                </button>
                <button type="button" ng-click="setCategory('POS & Retail')"
                    ng-class="{'bg-[var(--theme-primary)] text-black font-bold shadow-md shadow-cyan-500/20': selectedCategory === 'POS & Retail', 'bg-white dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:text-white border border-slate-200 dark:border-white/10': selectedCategory !== 'POS & Retail'}"
                    class="px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer">
                    POS &amp; Inventory
                </button>
                <button type="button" ng-click="setCategory('Backend Engines')"
                    ng-class="{'bg-[var(--theme-primary)] text-black font-bold shadow-md shadow-cyan-500/20': selectedCategory === 'Backend Engines', 'bg-white dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:text-white border border-slate-200 dark:border-white/10': selectedCategory !== 'Backend Engines'}"
                    class="px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer">
                    Backend Engines
                </button>
                <button type="button" ng-click="setCategory('E-Commerce')"
                    ng-class="{'bg-[var(--theme-primary)] text-black font-bold shadow-md shadow-cyan-500/20': selectedCategory === 'E-Commerce', 'bg-white dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:text-white border border-slate-200 dark:border-white/10': selectedCategory !== 'E-Commerce'}"
                    class="px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider transition-all cursor-pointer">
                    E-Commerce
                </button>
            </div>
        </div>
    </section>

    <!-- Projects Grid -->
    <section class="py-16 sm:py-20 border-b border-slate-200 dark:border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                    @php
                        $projCategory = $project->category ?? 'Web Application';
                        $catMatch = match(true) {
                            str_contains(strtolower($projCategory), 'erp') => 'ERP Systems',
                            str_contains(strtolower($projCategory), 'pos') || str_contains(strtolower($projCategory), 'retail') => 'POS & Retail',
                            str_contains(strtolower($projCategory), 'backend') || str_contains(strtolower($projCategory), 'api') || str_contains(strtolower($projCategory), 'engine') => 'Backend Engines',
                            str_contains(strtolower($projCategory), 'commerce') => 'E-Commerce',
                            default => 'Other'
                        };
                    @endphp
                    <div ng-show="selectedCategory === 'all' || selectedCategory === '{{ $catMatch }}'"
                        class="p-5 rounded-3xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm hover:border-[var(--theme-primary)]/50 hover:shadow-xl dark:hover:shadow-cyan-500/5 transition-all duration-300 flex flex-col justify-between group">
                        
                        <div>
                            <!-- Project Image -->
                            <div class="aspect-[16/10] rounded-2xl overflow-hidden bg-slate-900 border border-slate-200 dark:border-white/10 relative mb-5">
                                <img
                                    src="{{ $project->image_url ?? 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80' }}"
                                    alt="{{ $project->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                                
                                <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-[10px] font-mono font-bold bg-slate-950/80 backdrop-blur-md text-[var(--theme-primary)] border border-cyan-500/30">
                                    {{ $project->category }}
                                </span>
                            </div>

                            <!-- Title & Subtitle -->
                            <h3 class="text-xl font-bold font-['Outfit'] text-slate-900 dark:text-white group-hover:text-[var(--theme-primary)] transition-colors">
                                {{ $project->title }}
                            </h3>
                            <p class="text-xs text-slate-600 dark:text-slate-300 mt-2 leading-relaxed">
                                {{ $project->description }}
                            </p>
                        </div>

                        <!-- Footer Meta & Tech Stack -->
                        <div class="pt-5 mt-5 border-t border-slate-100 dark:border-white/10 flex items-center justify-between">
                            <div class="flex items-center gap-1.5 text-[11px] font-mono text-cyan-600 dark:text-cyan-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-[var(--theme-primary)]"></span>
                                <span>Laravel / MySQL / Vue / Tailwind</span>
                            </div>

                            @if(!empty($project->live_preview_url))
                                <a href="{{ $project->live_preview_url }}" target="_blank" rel="noopener noreferrer"
                                    class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-white/10 hover:bg-[var(--theme-primary)] hover:text-black flex items-center justify-center text-xs transition-colors"
                                    title="View Live Demo">
                                    ↗
                                </a>
                            @else
                                <a href="{{ route('contact') }}"
                                    class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-white/10 hover:bg-[var(--theme-primary)] hover:text-black flex items-center justify-center text-xs transition-colors"
                                    title="Inquire Details">
                                    ℹ
                                </a>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Architecture Callout / Technical Blueprint Section -->
    <section class="py-16 sm:py-20 border-b border-slate-200 dark:border-white/5 bg-slate-100/50 dark:bg-[#0a0f1d]/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="p-8 sm:p-12 rounded-3xl bg-slate-900 border border-cyan-500/30 text-white relative overflow-hidden shadow-2xl">
                <!-- Cyber Background Ambient -->
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-[var(--theme-primary)]/10 rounded-full blur-[100px] pointer-events-none"></div>

                <div class="max-w-2xl space-y-4 relative z-10">
                    <span class="text-xs font-mono font-bold text-[var(--theme-primary)] uppercase tracking-wider block">
                        // ENTERPRISE READY ARCHITECTURES
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black font-['Outfit'] uppercase leading-tight">
                        Need A Custom High-Performance Laravel Architecture?
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Whether you need an asynchronous background job processing system, high-speed multi-database sharding, or an enterprise billing microservice, I build production-grade solutions configured for zero downtime.
                    </p>
                    <div class="pt-2 flex flex-wrap items-center gap-4">
                        <a href="{{ route('contact') }}"
                            class="px-6 py-3 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-cyan-500/25 active:scale-95 transition-all">
                            Start An Enterprise Inquiry
                        </a>
                        <a href="{{ route('about') }}"
                            class="px-6 py-3 rounded-full bg-white/10 hover:bg-white/20 text-white font-bold text-xs uppercase tracking-wider transition-all">
                            View Career Experience
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Partial -->
    @include('frontend.themes.laravel_developer.partials.footer')

</div>

<script>
    angular.module('portfolioApp', [])
        .controller('PortfolioPageController', ['$scope', function($scope) {
            $scope.selectedCategory = 'all';
            $scope.setCategory = function(cat) {
                $scope.selectedCategory = cat;
            };
        }]);
</script>
@endsection
