@extends('admin.layout')

@section('title', 'Error & System Logs')
@section('page_title', 'Unified Error & System Logs')
@section('page_subtitle', 'Group: Diagnostics & Runtime Monitoring')

@section('content')
    <div class="space-y-6">

        <!-- 1. Header Toolbar & Quick Diagnostic Actions -->
        <div
            class="flex flex-col md:flex-row md:items-center justify-between gap-4 p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl">
            <div class="space-y-1">
                <div class="flex items-center gap-2.5">
                    <div
                        class="w-9 h-9 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 flex items-center justify-center font-mono font-bold text-sm">
                        LOG
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-white tracking-tight">System &amp; Browser Diagnostics</h2>
                        <p class="text-xs text-slate-400">Capturing all controller runtime exceptions, application events,
                            and client browser console errors.</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2.5">
                <!-- Test Error Generator Form -->
                <form action="{{ route('admin.logs.testError') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="type" value="backend">
                    <button type="submit" title="Generate test controller exception to verify error logging"
                        class="px-3.5 py-2 rounded-xl text-xs font-bold font-mono bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all flex items-center gap-2 cursor-pointer">
                        <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                        <span>Test Backend Error</span>
                    </button>
                </form>

                <form action="{{ route('admin.logs.testError') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="type" value="browser">
                    <button type="submit" title="Generate test browser error in browser.log"
                        class="px-3.5 py-2 rounded-xl text-xs font-bold font-mono bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all flex items-center gap-2 cursor-pointer">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>Test Browser Error</span>
                    </button>
                </form>

                <!-- Download Active Log File -->
                <a href="{{ route('admin.logs.download', ['file' => $currentSource === 'browser' ? 'browser.log' : ($currentSource === 'all' ? 'laravel.log' : $currentSource)]) }}"
                    class="px-3.5 py-2 rounded-xl text-xs font-semibold bg-indigo-600/20 hover:bg-indigo-600/30 text-indigo-300 border border-indigo-500/30 transition-all flex items-center gap-2 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    <span>Download</span>
                </a>

                <!-- Clear Logs Button -->
                <form action="{{ route('admin.logs.clear') }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to clear this log file? All recorded entries will be deleted.');"
                    class="inline">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="file"
                        value="{{ $currentSource === 'browser' ? 'browser.log' : ($currentSource === 'laravel' ? 'laravel.log' : $currentSource) }}">
                    <button type="submit"
                        class="px-3.5 py-2 rounded-xl text-xs font-semibold bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 border border-rose-500/30 transition-all flex items-center gap-1.5 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span>Clear</span>
                    </button>
                </form>

                <!-- Refresh Button -->
                <a href="{{ url()->full() }}"
                    class="p-2 rounded-xl text-xs font-semibold bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all"
                    title="Refresh log viewer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- 2. Diagnostic Summary Metrics Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            <!-- Total Entries -->
            <div class="p-5 rounded-2xl bg-[#09101d] border border-white/10 space-y-1">
                <div class="text-[10px] font-mono uppercase text-slate-400 font-bold tracking-wider">Total Captured</div>
                <div class="text-2xl font-black font-mono text-white">{{ number_format($stats['total']) }}</div>
                <div class="text-[11px] font-mono text-slate-500">Across {{ $stats['file_count'] }} log files</div>
            </div>

            <!-- Errors & Critical -->
            <div class="p-5 rounded-2xl bg-[#09101d] border border-rose-500/20 bg-rose-500/[0.02] space-y-1">
                <div class="text-[10px] font-mono uppercase text-rose-400 font-bold tracking-wider">Exceptions / Errors
                </div>
                <div class="text-2xl font-black font-mono text-rose-400">{{ number_format($stats['errors']) }}</div>
                <div class="text-[11px] font-mono text-rose-300/70">Critical application events</div>
            </div>

            <!-- Warnings -->
            <div class="p-5 rounded-2xl bg-[#09101d] border border-amber-500/20 bg-amber-500/[0.02] space-y-1">
                <div class="text-[10px] font-mono uppercase text-amber-400 font-bold tracking-wider">Warnings</div>
                <div class="text-2xl font-black font-mono text-amber-400">{{ number_format($stats['warnings']) }}</div>
                <div class="text-[11px] font-mono text-amber-300/70">Potential issues flagged</div>
            </div>

            <!-- Browser Errors -->
            <div class="p-5 rounded-2xl bg-[#09101d] border border-emerald-500/20 bg-emerald-500/[0.02] space-y-1">
                <div class="text-[10px] font-mono uppercase text-emerald-400 font-bold tracking-wider">Browser Errors</div>
                <div class="text-2xl font-black font-mono text-emerald-400">{{ number_format($stats['browser']) }}</div>
                <div class="text-[11px] font-mono text-emerald-300/70">Client-side JS exceptions</div>
            </div>

            <!-- Log Storage Footprint -->
            <div class="p-5 rounded-2xl bg-[#09101d] border border-white/10 space-y-1 col-span-2 sm:col-span-1">
                <div class="text-[10px] font-mono uppercase text-slate-400 font-bold tracking-wider">Storage Footprint</div>
                <div class="text-2xl font-black font-mono text-cyan-400">{{ $stats['total_size_mb'] }} <span
                        class="text-sm font-normal text-slate-400">MB</span></div>
                <div class="text-[11px] font-mono text-slate-500">In storage/logs</div>
            </div>
        </div>

        <!-- 3. Source & Level Filter Navigation -->
        <div class="p-4 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">

            <!-- Source Switcher Tabs -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/5 pb-3">
                <div class="flex flex-wrap items-center gap-1.5">
                    <span class="text-xs font-mono text-slate-400 mr-1 font-bold">SOURCE:</span>

                    <!-- All Sources -->
                    <a href="{{ route('admin.logs.index', array_merge(request()->except(['source', 'page']), ['source' => 'all'])) }}"
                        class="px-3 py-1.5 rounded-xl text-xs font-mono font-semibold transition-all {{ $currentSource === 'all' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'bg-white/5 text-slate-400 hover:text-white hover:bg-white/10' }}">
                        All Logs ({{ $stats['total'] }})
                    </a>

                    <!-- Laravel Logs -->
                    <a href="{{ route('admin.logs.index', array_merge(request()->except(['source', 'page']), ['source' => 'laravel'])) }}"
                        class="px-3 py-1.5 rounded-xl text-xs font-mono font-semibold transition-all {{ $currentSource === 'laravel' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'bg-white/5 text-slate-400 hover:text-white hover:bg-white/10' }}">
                        Laravel Backend
                        ({{ isset($logFiles['laravel.log']) ? $logFiles['laravel.log']['size_human'] : '0 B' }})
                    </a>

                    <!-- Browser Logs -->
                    <a href="{{ route('admin.logs.index', array_merge(request()->except(['source', 'page']), ['source' => 'browser'])) }}"
                        class="px-3 py-1.5 rounded-xl text-xs font-mono font-semibold transition-all {{ $currentSource === 'browser' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/30' : 'bg-white/5 text-slate-400 hover:text-white hover:bg-white/10' }}">
                        Browser / Frontend
                        ({{ isset($logFiles['browser.log']) ? $logFiles['browser.log']['size_human'] : '0 B' }})
                    </a>
                </div>

                <!-- Specific Log File Picker Dropdown -->
                <div class="flex items-center gap-2">
                    <label for="log_file_select" class="text-xs font-mono text-slate-400">File:</label>
                    <select id="log_file_select" onchange="location = this.value;"
                        class="px-2.5 py-1.5 rounded-xl text-xs font-mono bg-black/40 border border-white/15 text-slate-200 focus:outline-none focus:border-indigo-500">
                        <option
                            value="{{ route('admin.logs.index', array_merge(request()->except(['source', 'page']), ['source' => 'all'])) }}"
                            {{ $currentSource === 'all' ? 'selected' : '' }}>All Log Files</option>
                        @foreach ($logFiles as $fName => $meta)
                            <option
                                value="{{ route('admin.logs.index', array_merge(request()->except(['source', 'page']), ['source' => $fName])) }}"
                                {{ $currentSource === $fName ? 'selected' : '' }}>
                                {{ $fName }} ({{ $meta['size_human'] }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Level Pills & Search Form -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                <!-- Level Badges -->
                <div class="flex flex-wrap items-center gap-1.5">
                    <span class="text-xs font-mono text-slate-400 mr-1 font-bold">LEVEL:</span>

                    <a href="{{ route('admin.logs.index', array_merge(request()->except(['level', 'page']), ['level' => 'all'])) }}"
                        class="px-2.5 py-1 rounded-lg text-xs font-mono {{ $currentLevel === 'all' ? 'bg-white/20 text-white font-bold' : 'bg-white/5 text-slate-400 hover:text-white' }}">
                        All Levels
                    </a>

                    <a href="{{ route('admin.logs.index', array_merge(request()->except(['level', 'page']), ['level' => 'error'])) }}"
                        class="px-2.5 py-1 rounded-lg text-xs font-mono {{ $currentLevel === 'error' ? 'bg-rose-500 text-white font-bold' : 'bg-rose-500/10 text-rose-300 hover:bg-rose-500/20' }}">
                        Error / Critical ({{ $stats['errors'] }})
                    </a>

                    <a href="{{ route('admin.logs.index', array_merge(request()->except(['level', 'page']), ['level' => 'warning'])) }}"
                        class="px-2.5 py-1 rounded-lg text-xs font-mono {{ $currentLevel === 'warning' ? 'bg-amber-500 text-black font-bold' : 'bg-amber-500/10 text-amber-300 hover:bg-amber-500/20' }}">
                        Warning ({{ $stats['warnings'] }})
                    </a>

                    <a href="{{ route('admin.logs.index', array_merge(request()->except(['level', 'page']), ['level' => 'browser'])) }}"
                        class="px-2.5 py-1 rounded-lg text-xs font-mono {{ $currentLevel === 'browser' ? 'bg-emerald-500 text-black font-bold' : 'bg-emerald-500/10 text-emerald-300 hover:bg-emerald-500/20' }}">
                        Browser ({{ $stats['browser'] }})
                    </a>

                    <a href="{{ route('admin.logs.index', array_merge(request()->except(['level', 'page']), ['level' => 'info'])) }}"
                        class="px-2.5 py-1 rounded-lg text-xs font-mono {{ $currentLevel === 'info' ? 'bg-cyan-500 text-black font-bold' : 'bg-cyan-500/10 text-cyan-300 hover:bg-cyan-500/20' }}">
                        Info ({{ $stats['info'] }})
                    </a>

                    <a href="{{ route('admin.logs.index', array_merge(request()->except(['level', 'page']), ['level' => 'debug'])) }}"
                        class="px-2.5 py-1 rounded-lg text-xs font-mono {{ $currentLevel === 'debug' ? 'bg-violet-500 text-white font-bold' : 'bg-violet-500/10 text-violet-300 hover:bg-violet-500/20' }}">
                        Debug ({{ $stats['debug'] }})
                    </a>
                </div>

                <!-- Search Filter Input -->
                <form action="{{ route('admin.logs.index') }}" method="GET" class="flex items-center gap-2">
                    <input type="hidden" name="source" value="{{ $currentSource }}">
                    <input type="hidden" name="level" value="{{ $currentLevel }}">

                    <div class="relative">
                        <input type="text" name="search" value="{{ $search }}"
                            placeholder="Search message or stack..."
                            class="pl-8 pr-3 py-1.5 rounded-xl text-xs font-mono bg-black/40 border border-white/15 text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 w-48 sm:w-64">
                        <svg class="w-3.5 h-3.5 text-slate-500 absolute left-2.5 top-1/2 -translate-y-1/2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <button type="submit"
                        class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-white/10 hover:bg-white/20 text-white transition-colors cursor-pointer">
                        Filter
                    </button>

                    @if (!empty($search))
                        <a href="{{ route('admin.logs.index', ['source' => $currentSource, 'level' => $currentLevel]) }}"
                            class="text-xs font-mono text-slate-400 hover:text-white px-1">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

        </div>

        <!-- 4. Log Entries Feed Container -->
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
                                <pre class="m-0">{{ json_encode(json_decode($item['context_json']), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
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
                        <svg class="w-6 h-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

        <!-- 5. Pagination Container -->
        @if ($logs->hasPages() || $logs->total() > 0)
            <div
                class="p-4 rounded-2xl bg-[#09101d] border border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs font-mono text-slate-400">
                <div>
                    Showing <span class="text-white font-bold">{{ $logs->firstItem() ?? 0 }}</span>
                    to <span class="text-white font-bold">{{ $logs->lastItem() ?? 0 }}</span>
                    of <span class="text-white font-bold">{{ $logs->total() }}</span> log entries
                    (Page {{ $logs->currentPage() }} of {{ $logs->lastPage() }})
                </div>
                <div>
                    {{ $logs->links() }}
                </div>
            </div>
        @endif

    </div>
@endsection
