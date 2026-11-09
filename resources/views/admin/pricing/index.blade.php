@extends('admin.layout')

@section('title', 'Manage Pricing Plans')
@section('page_title', 'Pricing Packages')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-white">Pricing Plans</h1>
                <p class="text-xs text-slate-400 mt-1">Tiers displayed in the Awesome Pricing section across all themes.</p>
            </div>
            <a href="{{ route('admin.pricing.create') }}"
                class="theme-aware-create-btn w-full sm:w-auto justify-center px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span> New Plan</span>
            </a>
        </div>

        <!-- TOP THEME FILTER COMPONENT (Select2 / Selectpicker / AngularJS Style) -->
        @include('admin.components.theme-filter')

        @php
            $themePlans = $plans->filter(fn($p) => $p->theme !== 'all');
            $globalPlans = $plans->filter(fn($p) => $p->theme === 'all');
            $selectedThemeMeta = \App\Models\SiteSetting::getThemeDetails($selectedTheme ?? \App\Models\SiteSetting::getActiveTheme());
        @endphp

        <!-- 1. Active Theme Specific Pricing Plans Section -->
        <div id="activeThemeSection" class="space-y-4">
            <div class="flex items-center justify-between pb-2 border-b border-white/5">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-cyan-400"></span>
                    <h2 class="text-xs sm:text-sm font-bold text-white uppercase tracking-wider font-mono">
                        Theme Elements: <span class="text-cyan-300" id="activeThemeSectionLabel">{{ $selectedThemeMeta['name'] ?? 'Active Theme' }}</span>
                    </h2>
                </div>
                <span class="text-[11px] font-mono text-slate-400 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7 2a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 14zm6-12a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 14z"></path>
                    </svg>
                    Drag to reorder
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6" data-sortable-grid="pricing" id="activePricingGrid">
                @forelse($themePlans as $plan)
                    @php
                        $themeMeta = \App\Models\SiteSetting::getThemeDetails($plan->theme);
                    @endphp
                    <div data-id="{{ $plan->id }}" data-theme="{{ $plan->theme }}"
                        class="p-6 rounded-3xl bg-[#09101d] border-2 {{ $plan->is_featured ? 'border-indigo-500 shadow-xl' : 'border-white/10' }} flex flex-col justify-between space-y-6 hover:border-indigo-500/50 transition-all duration-300 group">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <span class="text-xs font-mono uppercase text-indigo-400 font-bold">{{ $plan->name }}</span>

                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold border {{ $themeMeta['badge'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full" style="background-color: {{ $themeMeta['color'] }}"></span>
                                        <span>{{ $themeMeta['short'] }}</span>
                                    </span>

                                    @if ($plan->is_featured)
                                        <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-indigo-500 text-white font-bold">Featured</span>
                                    @endif
                                </div>
                            </div>

                            <div class="text-3xl font-extrabold text-white font-mono">${{ number_format($plan->price, 0) }}
                                <span class="text-xs font-sans text-slate-400 font-normal">/ {{ $plan->billing_period }}</span>
                            </div>
                            <p class="text-xs text-slate-400">{{ $plan->subtitle }}</p>

                            <div class="pt-2 text-xs space-y-1.5 border-t border-white/5">
                                @foreach ($plan->features_list as $f)
                                    <div class="text-slate-300 flex items-center gap-2">
                                        <span class="text-emerald-400">&check;</span>
                                        <span>{{ $f }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-2">
                                <button type="button" class="drag-handle p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-all cursor-grab active:cursor-grabbing" title="Drag to reorder">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M7 2a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 14zm6-12a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 14z"></path>
                                    </svg>
                                </button>
                                <span class="order-badge font-mono text-slate-400 text-[11px]">Order: #{{ $plan->sort_order }}</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('admin.pricing.edit', $plan) }}" title="Edit"
                                    class="p-1.5 rounded-lg text-indigo-400 hover:text-white hover:bg-indigo-600/30 transition-all">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.pricing.destroy', $plan) }}" method="POST"
                                    onsubmit="return confirm('Delete this pricing plan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete"
                                        class="p-1.5 rounded-lg text-rose-400 hover:text-white hover:bg-rose-500/30 transition-all">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8 text-slate-400 text-xs">No theme-specific pricing plans configured yet.</div>
                @endforelse
            </div>
        </div>

        <!-- 2. Global Pricing Plans Section (All Themes) -->
        <div id="globalThemeSection" class="space-y-4 pt-6">
            <div class="flex items-center justify-between pb-2 border-b border-white/5">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-400"></span>
                    <h2 class="text-xs sm:text-sm font-bold text-white uppercase tracking-wider font-mono">
                        Global Elements: <span class="text-indigo-300">Shared Across All Themes</span>
                    </h2>
                </div>
                <span class="text-[11px] font-mono text-slate-400 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7 2a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 14zm6-12a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 14z"></path>
                    </svg>
                    Drag to reorder
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6" data-sortable-grid="pricing" id="globalPricingGrid">
                @forelse($globalPlans as $plan)
                    @php
                        $themeMeta = \App\Models\SiteSetting::getThemeDetails('all');
                    @endphp
                    <div data-id="{{ $plan->id }}" data-theme="all"
                        class="p-6 rounded-3xl bg-[#09101d] border-2 {{ $plan->is_featured ? 'border-indigo-500 shadow-xl' : 'border-white/10' }} flex flex-col justify-between space-y-6 hover:border-indigo-500/50 transition-all duration-300 group">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <span class="text-xs font-mono uppercase text-indigo-400 font-bold">{{ $plan->name }}</span>

                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold border {{ $themeMeta['badge'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full" style="background-color: {{ $themeMeta['color'] }}"></span>
                                        <span>{{ $themeMeta['short'] }}</span>
                                    </span>

                                    @if ($plan->is_featured)
                                        <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-indigo-500 text-white font-bold">Featured</span>
                                    @endif
                                </div>
                            </div>

                            <div class="text-3xl font-extrabold text-white font-mono">${{ number_format($plan->price, 0) }}
                                <span class="text-xs font-sans text-slate-400 font-normal">/ {{ $plan->billing_period }}</span>
                            </div>
                            <p class="text-xs text-slate-400">{{ $plan->subtitle }}</p>

                            <div class="pt-2 text-xs space-y-1.5 border-t border-white/5">
                                @foreach ($plan->features_list as $f)
                                    <div class="text-slate-300 flex items-center gap-2">
                                        <span class="text-emerald-400">&check;</span>
                                        <span>{{ $f }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-2">
                                <button type="button" class="drag-handle p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-all cursor-grab active:cursor-grabbing" title="Drag to reorder">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M7 2a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 14zm6-12a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 14z"></path>
                                    </svg>
                                </button>
                                <span class="order-badge font-mono text-slate-400 text-[11px]">Order: #{{ $plan->sort_order }}</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('admin.pricing.edit', $plan) }}" title="Edit"
                                    class="p-1.5 rounded-lg text-indigo-400 hover:text-white hover:bg-indigo-600/30 transition-all">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.pricing.destroy', $plan) }}" method="POST"
                                    onsubmit="return confirm('Delete this pricing plan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete"
                                        class="p-1.5 rounded-lg text-rose-400 hover:text-white hover:bg-rose-500/30 transition-all">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8 text-slate-400 text-xs">No global pricing plans configured yet.</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
