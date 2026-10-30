@extends('admin.layout')

@section('title', 'System & Browser Diagnostics')
@section('page_title', 'System & Browser Diagnostics')
@section('page_subtitle', 'Diagnostics / Runtime Monitoring & Error Tracking')

@push('styles')
    <style>
        #paginationContainer nav a {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #paginationContainer nav a:active {
            transform: scale(0.95);
        }
    </style>
@endpush

@section('content')
    <div class="space-y-6">

        <!-- 1. Header Toolbar & Quick Diagnostic Actions -->
        <div
            class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl">
            <div class="space-y-1">
                <div class="flex items-center gap-2.5">
                    <div
                        class="w-10 h-10 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-400 flex items-center justify-center font-mono font-bold text-sm shadow-inner">
                        LOG
                    </div>
                    <div>
                        <h1 class="text-xl font-black text-white tracking-tight flex items-center gap-2">
                            <span>System &amp; Browser Diagnostics</span>
                        </h1>
                        <p class="text-xs text-slate-400 font-mono">
                            Capturing all controller runtime exceptions, application events, and client browser console
                            errors.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2.5">
                <!-- Download Combined Diagnostics Log File -->
                <a href="{{ route('admin.logs.download') }}"
                    class="px-4 py-2.5 rounded-xl text-xs font-semibold bg-indigo-600/20 hover:bg-indigo-600/30 text-indigo-300 border border-indigo-500/30 transition-all flex items-center gap-2 cursor-pointer shadow-sm group"
                    title="Download all data in one file with datetime wise descending as 'System & Browser Diagnostics.log'">
                    <svg class="w-4 h-4 text-indigo-400 group-hover:-translate-y-0.5 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    <span>Download</span>
                </a>

                <!-- Clear Logs Button (Clears Both Browser & Laravel log files) -->
                <form action="{{ route('admin.logs.clear') }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to clear both Browser and Laravel log files? All recorded diagnostics data will be deleted.');"
                    class="inline">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="file" value="all">
                    <button type="submit"
                        class="px-4 py-2.5 rounded-xl text-xs font-semibold bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 border border-rose-500/30 transition-all flex items-center gap-2 cursor-pointer shadow-sm group"
                        title="Clear both Browser and Laravel log files">
                        <svg class="w-4 h-4 text-rose-400 group-hover:scale-110 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span>Clear</span>
                    </button>
                </form>

                <!-- Refresh Button (Reloads both files to get all data) -->
                <a href="{{ route('admin.logs.index', ['source' => 'all']) }}"
                    class="p-2.5 rounded-xl text-xs font-semibold bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all cursor-pointer shadow-sm flex items-center justify-center group"
                    title="Reload both files to get all data">
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-white group-hover:rotate-180 transition-all duration-300"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- 2. Diagnostic Summary Metrics Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            <!-- Total Entries -->
            <a href="{{ route('admin.logs.index', ['source' => $currentSource, 'level' => 'all'] + request()->except('level', 'page')) }}"
                class="p-5 rounded-2xl bg-[#09101d] border {{ $currentLevel === 'all' ? 'border-indigo-500/60 shadow-lg shadow-indigo-500/10' : 'border-white/10 hover:border-white/20' }} transition-all group space-y-1 block">
                <div class="text-[10px] font-mono uppercase text-slate-400 font-bold tracking-wider">Total Captured</div>
                <div class="text-2xl font-black font-mono text-white">{{ number_format($stats['total']) }}</div>
                <div class="text-[11px] font-mono text-slate-500">Across {{ $stats['file_count'] }} log files</div>
            </a>

            <!-- Errors & Critical -->
            <a href="{{ route('admin.logs.index', ['source' => $currentSource, 'level' => 'error'] + request()->except('level', 'page')) }}"
                class="p-5 rounded-2xl bg-[#09101d] border {{ $currentLevel === 'error' ? 'border-rose-500/60 shadow-lg shadow-rose-500/10' : 'border-rose-500/20 hover:border-rose-500/40' }} bg-rose-500/[0.02] transition-all group space-y-1 block">
                <div class="text-[10px] font-mono uppercase text-rose-400 font-bold tracking-wider">Exceptions / Errors
                </div>
                <div class="text-2xl font-black font-mono text-rose-400">{{ number_format($stats['errors']) }}</div>
                <div class="text-[11px] font-mono text-rose-300/70">Critical application events</div>
            </a>

            <!-- Warnings -->
            <a href="{{ route('admin.logs.index', ['source' => $currentSource, 'level' => 'warning'] + request()->except('level', 'page')) }}"
                class="p-5 rounded-2xl bg-[#09101d] border {{ $currentLevel === 'warning' ? 'border-amber-500/60 shadow-lg shadow-amber-500/10' : 'border-amber-500/20 hover:border-amber-500/40' }} bg-amber-500/[0.02] transition-all group space-y-1 block">
                <div class="text-[10px] font-mono uppercase text-amber-400 font-bold tracking-wider">Warnings</div>
                <div class="text-2xl font-black font-mono text-amber-400">{{ number_format($stats['warnings']) }}</div>
                <div class="text-[11px] font-mono text-amber-300/70">Potential issues flagged</div>
            </a>

            <!-- Browser Errors -->
            <a href="{{ route('admin.logs.index', ['source' => 'browser', 'level' => 'all'] + request()->except('source', 'level', 'page')) }}"
                class="p-5 rounded-2xl bg-[#09101d] border {{ $currentSource === 'browser' ? 'border-emerald-500/60 shadow-lg shadow-emerald-500/10' : 'border-emerald-500/20 hover:border-emerald-500/40' }} bg-emerald-500/[0.02] transition-all group space-y-1 block">
                <div class="text-[10px] font-mono uppercase text-emerald-400 font-bold tracking-wider">Browser Errors</div>
                <div class="text-2xl font-black font-mono text-emerald-400">{{ number_format($stats['browser']) }}</div>
                <div class="text-[11px] font-mono text-emerald-300/70">Client-side JS exceptions</div>
            </a>

            <!-- Storage Footprint -->
            <div class="p-5 rounded-2xl bg-[#09101d] border border-white/10 space-y-1 col-span-2 sm:col-span-1">
                <div class="text-[10px] font-mono uppercase text-slate-400 font-bold tracking-wider">Storage Footprint</div>
                <div class="text-2xl font-black font-mono text-cyan-400">{{ $stats['total_size_mb'] }} <span
                        class="text-sm font-normal text-slate-400">MB</span></div>
                <div class="text-[11px] font-mono text-slate-500">In storage/logs</div>
            </div>
        </div>

        <!-- 3. Separated Filter Card (Image 1 Style) -->
        <div class="p-5 sm:p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-white/5">
                <div class="flex items-center gap-2.5">
                    <div
                        class="w-8 h-8 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0 shadow-inner">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white tracking-tight">Filter Logs</h3>
                        <p class="text-[11px] font-mono text-slate-400">Search and narrow results by search term, log
                            sources, and status</p>
                    </div>
                </div>

                @php
                    $hasActiveFilters =
                        !empty($search) || $currentSource !== 'all' || $currentLevel !== 'all' || $perPage != 20;
                @endphp
                <a href="{{ route('admin.logs.index') }}" id="resetFiltersBtn" title="Reset all filters"
                    class="{{ $hasActiveFilters ? '' : 'hidden' }} text-[11px] font-mono text-indigo-400 hover:text-indigo-300 flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-indigo-500/10 border border-indigo-500/20 transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span>Reset Filters</span>
                </a>
            </div>

            <form id="filterLogsForm" action="{{ route('admin.logs.index') }}" method="GET">
                <input type="hidden" name="per_page" id="formPerPage" value="{{ $perPage }}">

                <!-- Three filters in a row: 1st Searchbox, 2nd Sources/Users, 3rd Status -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- 1st: Searchbox -->
                    <div class="space-y-1.5">
                        <label for="logSearchInput"
                            class="block text-[11px] font-mono text-slate-400 uppercase tracking-wider">
                            Searchbox
                        </label>
                        <div class="relative">
                            <input type="text" id="logSearchInput" name="search" value="{{ $search }}"
                                placeholder="Search logs, exceptions, stacks..." autocomplete="off"
                                class="w-full bg-[#0c1424] border border-white/10 rounded-xl pl-9 pr-8 py-2.5 text-xs text-white placeholder:text-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all font-sans">
                            <svg class="w-4 h-4 text-slate-500 absolute left-3 top-3 pointer-events-none" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            @if (!empty($search))
                                <button type="button" onclick="clearLogSearch()" title="Clear search"
                                    class="absolute right-2.5 top-2.5 text-slate-500 hover:text-white text-base w-5 h-5 flex items-center justify-center cursor-pointer transition-colors">
                                    &times;
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- 2nd: Sources (Matches "USERS" dropdown position) -->
                    <div class="space-y-1.5">
                        <label for="sourceFilter"
                            class="block text-[11px] font-mono text-slate-400 uppercase tracking-wider">
                            Sources
                        </label>
                        <div class="relative">
                            <select id="sourceFilter" name="source"
                                onchange="document.getElementById('filterLogsForm').submit()"
                                class="w-full bg-[#0c1424] border border-white/10 rounded-xl px-3 py-2.5 text-xs text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 font-sans cursor-pointer transition-all">
                                <option value="all" {{ $currentSource === 'all' ? 'selected' : '' }}>
                                    All Log Sources ({{ $stats['total'] }})
                                </option>
                                <option value="laravel" {{ $currentSource === 'laravel' ? 'selected' : '' }}>
                                    Laravel Backend
                                    ({{ isset($logFiles['laravel.log']) ? $logFiles['laravel.log']['size_human'] : '0 B' }})
                                </option>
                                <option value="browser" {{ $currentSource === 'browser' ? 'selected' : '' }}>
                                    Browser Console
                                    ({{ isset($logFiles['browser.log']) ? $logFiles['browser.log']['size_human'] : '0 B' }})
                                </option>
                                @foreach ($logFiles as $fName => $meta)
                                    @if (!in_array($fName, ['laravel.log', 'browser.log']))
                                        <option value="{{ $fName }}"
                                            {{ $currentSource === $fName ? 'selected' : '' }}>
                                            {{ $fName }} ({{ $meta['size_human'] }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- 3rd: Status (Matches "STATUS" dropdown position) -->
                    <div class="space-y-1.5">
                        <label for="statusFilter"
                            class="block text-[11px] font-mono text-slate-400 uppercase tracking-wider">
                            Status
                        </label>
                        <div class="relative">
                            <select id="statusFilter" name="level"
                                onchange="document.getElementById('filterLogsForm').submit()"
                                class="w-full bg-[#0c1424] border border-white/10 rounded-xl px-3 py-2.5 text-xs text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 font-sans cursor-pointer transition-all">
                                <option value="all" {{ $currentLevel === 'all' ? 'selected' : '' }}>
                                    All Status ({{ $stats['total'] }})
                                </option>
                                <option value="error" {{ $currentLevel === 'error' ? 'selected' : '' }}>
                                    Error / Critical ({{ $stats['errors'] }})
                                </option>
                                <option value="warning" {{ $currentLevel === 'warning' ? 'selected' : '' }}>
                                    Warning ({{ $stats['warnings'] }})
                                </option>
                                <option value="browser" {{ $currentLevel === 'browser' ? 'selected' : '' }}>
                                    Browser Errors ({{ $stats['browser'] }})
                                </option>
                                <option value="info" {{ $currentLevel === 'info' ? 'selected' : '' }}>
                                    Info ({{ $stats['info'] }})
                                </option>
                                <option value="debug" {{ $currentLevel === 'debug' ? 'selected' : '' }}>
                                    Debug ({{ $stats['debug'] }})
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- 4. Datalist Card (Image 1 Bottom Card + Image 2 Pagination Footer) -->
        <div id="datalistCard" class="p-5 sm:p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">

            <!-- Datalist Card Top: Title with Count Result (Left) & Per Page Select (Right) -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-white/10">
                <!-- Top Left: Title with count result -->
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0 shadow-inner">
                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    </div>
                    <div class="flex items-center gap-2.5 flex-wrap">
                        <h2 class="text-base font-bold text-white tracking-tight">Diagnostics Logs Feed</h2>
                        <span id="datalistCountBadge"
                            class="px-2.5 py-0.5 rounded-full text-xs font-mono font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                            {{ $logs->total() }} {{ Str::plural('result', $logs->total()) }}
                        </span>
                    </div>
                </div>

                <!-- Top Right: Per page select to change -->
                <div class="flex items-center self-end sm:self-auto shrink-0">
                    <div
                        class="group inline-flex items-center bg-[#0c1424] hover:bg-[#0f182c] border border-white/10 hover:border-white/20 focus-within:border-indigo-500/80 focus-within:ring-2 focus-within:ring-indigo-500/20 rounded-xl px-2.5 py-1.5 shadow-sm transition-all">
                        <label for="perPageFilter"
                            class="flex items-center gap-1.5 text-xs font-medium text-slate-400 group-hover:text-slate-300 select-none cursor-pointer whitespace-nowrap pr-2">
                            <svg class="w-3.5 h-3.5 text-indigo-400 shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h10" />
                            </svg>
                            <span>Per page</span>
                        </label>
                        <div class="h-3.5 w-px bg-white/10"></div>
                        <div class="relative flex items-center pl-1.5">
                            <select id="perPageFilter" name="per_page" onchange="changePerPage(this.value)"
                                class="no-select2 appearance-none bg-transparent hover:bg-white/5 focus:bg-white/10 text-xs font-semibold text-white cursor-pointer pr-6 pl-2 py-0.5 rounded-lg border border-transparent focus:border-indigo-500/40 focus:outline-none transition-all">
                                <option value="10" class="bg-[#0c1424] text-slate-200"
                                    {{ $perPage == 10 ? 'selected' : '' }}>10 / page</option>
                                <option value="20" class="bg-[#0c1424] text-slate-200"
                                    {{ $perPage == 20 ? 'selected' : '' }}>20 / page</option>
                                <option value="50" class="bg-[#0c1424] text-slate-200"
                                    {{ $perPage == 50 ? 'selected' : '' }}>50 / page</option>
                                <option value="100" class="bg-[#0c1424] text-slate-200"
                                    {{ $perPage == 100 ? 'selected' : '' }}>100 / page</option>
                            </select>
                            <svg class="w-3 h-3 text-slate-400 group-hover:text-indigo-400 pointer-events-none absolute right-1.5 transition-colors"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Log Entries List Container -->
            <div class="space-y-3">
                @forelse($logs as $index => $item)
                    @php
                        $lvl = $item['level'];
                        $isErr = in_array($lvl, ['EMERGENCY', 'ALERT', 'CRITICAL', 'ERROR']);
                        $isWarn = $lvl === 'WARNING';
                        $isBrowser = $item['is_browser'];

                        if ($isErr) {
                            $borderClass = 'border-rose-500/30 hover:border-rose-500/50';
                            $badgeClass = 'bg-rose-500/20 text-rose-300 border-rose-500/30';
                        } elseif ($isWarn) {
                            $borderClass = 'border-amber-500/30 hover:border-amber-500/50';
                            $badgeClass = 'bg-amber-500/20 text-amber-300 border-amber-500/30';
                        } elseif ($isBrowser) {
                            $borderClass = 'border-emerald-500/30 hover:border-emerald-500/50';
                            $badgeClass = 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30';
                        } elseif (in_array($lvl, ['INFO', 'NOTICE'])) {
                            $borderClass = 'border-cyan-500/20 hover:border-cyan-500/40';
                            $badgeClass = 'bg-cyan-500/20 text-cyan-300 border-cyan-500/30';
                        } else {
                            $borderClass = 'border-white/10 hover:border-white/20';
                            $badgeClass = 'bg-white/10 text-slate-300 border-white/20';
                        }
                    @endphp

                    <div class="p-4 sm:p-5 rounded-2xl bg-[#09101d] border {{ $borderClass }} shadow-lg transition-all space-y-3"
                        id="log_item_{{ $item['id'] }}">

                        <!-- Entry Top Row: Level, Source, Timestamp -->
                        <div class="flex flex-wrap items-center justify-between gap-2 border-b border-white/5 pb-2.5">
                            <div class="flex flex-wrap items-center gap-2">
                                <!-- Level Badge -->
                                <span
                                    class="px-2.5 py-0.5 rounded-lg text-[10px] font-mono font-bold uppercase tracking-wider border {{ $badgeClass }}">
                                    {{ $lvl }}
                                </span>

                                <!-- Source Badge -->
                                @if ($isBrowser)
                                    <span
                                        class="px-2 py-0.5 rounded-lg text-[10px] font-mono font-bold bg-emerald-500/10 text-emerald-300 border border-emerald-500/20 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <span>Browser Log</span>
                                    </span>
                                @else
                                    <span
                                        class="px-2 py-0.5 rounded-lg text-[10px] font-mono font-bold bg-indigo-500/10 text-indigo-300 border border-indigo-500/20">
                                        {{ $item['file'] }}
                                    </span>
                                @endif

                                <!-- Environment Tag -->
                                <span
                                    class="px-2 py-0.5 rounded-lg text-[10px] font-mono text-slate-400 bg-white/5 border border-white/5">
                                    env: {{ $item['environment'] }}
                                </span>
                            </div>

                            <div class="flex items-center gap-2 text-xs font-mono text-slate-400">
                                <span>{{ $item['time_human'] }}</span>
                                <span class="text-slate-600">&bull;</span>
                                <span class="text-slate-500">{{ $item['time_ago'] }}</span>
                            </div>
                        </div>

                        <!-- Main Log Message Body -->
                        <div
                            class="text-xs sm:text-sm font-mono text-slate-200 leading-relaxed break-words whitespace-pre-wrap select-text bg-black/30 p-3 rounded-xl border border-white/5">
                            {{ $item['message'] }}
                        </div>

                        <!-- Structured Context Display (if present) -->
                        @if (!empty($item['context_json']))
                            <details class="group text-xs font-mono">
                                <summary
                                    class="cursor-pointer text-indigo-400 hover:text-indigo-300 font-semibold select-none flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 transform group-open:rotate-90 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    <span>Inspect Structured Context Metadata</span>
                                </summary>
                                <div
                                    class="mt-2 p-3 rounded-xl bg-black/60 border border-white/10 text-slate-300 overflow-x-auto text-[11px] leading-relaxed">
                                    <pre class="m-0 font-mono">{{ json_encode(json_decode($item['context_json']), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                </div>
                            </details>
                        @endif

                        <!-- Stack Trace Accordion (if present) -->
                        @if (!empty($item['stack_trace']))
                            <details class="group text-xs font-mono">
                                <summary
                                    class="cursor-pointer text-amber-400 hover:text-amber-300 font-semibold select-none flex items-center justify-between">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 transform group-open:rotate-90 transition-transform"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                        <span>Show Full Stack Trace ({{ substr_count($item['stack_trace'], "\n") + 1 }}
                                            lines)</span>
                                    </span>
                                    <span class="text-[10px] text-slate-500 group-open:hidden">Click to expand</span>
                                </summary>
                                <div
                                    class="mt-2.5 p-4 rounded-xl bg-[#050811] border border-white/10 text-slate-300 overflow-x-auto text-[11px] leading-relaxed relative">
                                    <button type="button"
                                        onclick="navigator.clipboard.writeText(this.nextElementSibling.innerText); alert('Stack trace copied to clipboard!');"
                                        class="absolute top-2 right-2 px-2.5 py-1 rounded-lg bg-white/10 hover:bg-white/20 text-[10px] font-mono text-slate-300 transition-colors cursor-pointer">
                                        Copy Trace
                                    </button>
                                    <pre class="m-0 text-slate-300 font-mono select-text">{{ $item['stack_trace'] }}</pre>
                                </div>
                            </details>
                        @endif

                    </div>
                @empty
                    <div
                        class="py-16 text-center rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-3 font-mono">
                        <div
                            class="w-12 h-12 mx-auto rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="text-sm font-bold text-white">No Logs Found</h4>
                        <p class="text-xs text-slate-400 max-w-sm mx-auto">
                            @if (!empty($search))
                                No log entries matched your keyword filter "{{ $search }}".
                            @elseif($currentLevel !== 'all')
                                No entries found with level "{{ strtoupper($currentLevel) }}".
                            @else
                                No errors or events are currently recorded in the selected log source.
                            @endif
                        </p>
                        <div class="pt-2">
                            <a href="{{ route('admin.logs.index') }}"
                                class="px-4 py-2 rounded-xl text-xs font-semibold bg-white/10 hover:bg-white/20 text-white transition-colors inline-block">
                                Reset All Filters
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Bottom Stats & Pagination (Image 2 Pro Style) -->
            <div class="pt-6 mt-4 border-t border-white/10 flex flex-col items-center justify-center gap-4">

                <!-- Range & Position Badges (Top Center in Image 2) -->
                <div id="showingCountContainer" class="flex flex-wrap items-center justify-center gap-2.5">
                    @if ($logs->total() > 0)
                        <!-- Primary Range Badge -->
                        <div
                            class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-2xl bg-[#0c1424] border border-white/10 text-xs font-mono text-slate-300 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                            <span class="text-slate-400">Showing</span>
                            <span
                                class="px-2 py-0.5 rounded-lg bg-indigo-500/20 text-indigo-300 font-bold border border-indigo-500/30">
                                {{ $logs->firstItem() ?? 0 }}&ndash;{{ $logs->lastItem() ?? 0 }}
                            </span>
                            <span class="text-slate-400">of</span>
                            <span class="text-white font-extrabold">{{ $logs->total() }}</span>
                            <span class="text-slate-400">items</span>
                        </div>

                        <!-- Secondary Page Position & Total Context -->
                        <div
                            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-2xl bg-[#0c1424] border border-white/10 text-xs font-mono text-slate-400">
                            <span>Page <strong class="text-white">{{ $logs->currentPage() }}</strong> of <strong
                                    class="text-white">{{ $logs->lastPage() }}</strong></span>
                            <span class="text-slate-600">&bull;</span>
                            <span class="text-slate-300">{{ $logs->count() }} on page</span>
                            <span class="text-slate-600">&bull;</span>
                            <span class="text-slate-400">Total: <strong
                                    class="text-white">{{ $stats['total'] }}</strong></span>
                        </div>
                    @else
                        <div
                            class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-2xl bg-[#0c1424] border border-white/10 text-xs font-mono text-slate-400">
                            <span class="w-2 h-2 rounded-full bg-slate-600"></span>
                            <span>Showing <strong>0</strong> items</span>
                        </div>
                    @endif
                </div>

                <!-- Bottom Pagination Bar (Centered Navigation Links) -->
                @if ($logs->hasPages())
                    <div id="paginationContainer" class="flex items-center justify-center">
                        {{ $logs->links('admin.components.pagination') }}
                    </div>
                @endif
            </div>

        </div>

    </div>

    <!-- Micro Scripts for Filter & Per Page Interactions -->
    <script>
        function clearLogSearch() {
            const input = document.getElementById('logSearchInput');
            if (input) {
                input.value = '';
                document.getElementById('filterLogsForm').submit();
            }
        }

        function changePerPage(value) {
            const form = document.getElementById('filterLogsForm');
            const perPageInput = document.getElementById('formPerPage');
            if (perPageInput && form) {
                perPageInput.value = value;
                form.submit();
            }
        }

        // Search submit on Enter
        const searchInput = document.getElementById('logSearchInput');
        if (searchInput) {
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    document.getElementById('filterLogsForm').submit();
                }
            });
        }
    </script>
@endsection
