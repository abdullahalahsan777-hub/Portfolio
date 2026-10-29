@extends('admin.layout')

@section('title', 'System Maintenance & Server Status')
@section('page_title', 'Maintenance Hub')
@section('page_subtitle', 'Server Status & Infrastructure Control')

@section('content')
<div class="w-full space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">Server Status & System Diagnostics</h1>
            <p class="text-xs text-slate-400 mt-1">
                Configure live server status, trigger 503 Service Unavailable for public endpoints, and perform system upgrades.
            </p>
        </div>
        <div class="flex items-center gap-2 px-4 py-2 rounded-2xl bg-black/40 border border-white/10">
            <span class="w-2.5 h-2.5 rounded-full {{ $isDown ? 'bg-amber-400 animate-ping' : 'bg-emerald-400 animate-pulse' }}"></span>
            <span class="text-xs font-mono font-bold uppercase {{ $isDown ? 'text-amber-400' : 'text-emerald-400' }}">
                {{ $isDown ? 'Server Status: UPGRADE / 503 ACTIVE' : 'Server Status: LIVE & OPERATIONAL' }}
            </span>
        </div>
    </div>

    <!-- 1. HERO SERVER STATUS & UPGRADE CONTROL BANNER -->
    <div class="p-8 rounded-3xl bg-[#09101d] border {{ $isDown ? 'border-amber-500/40 bg-gradient-to-br from-[#09101d] via-amber-950/20 to-[#09101d]' : 'border-emerald-500/30 bg-gradient-to-br from-[#09101d] via-emerald-950/20 to-[#09101d]' }} shadow-2xl relative overflow-hidden">
        
        <!-- Ambient decorative glow -->
        <div class="absolute -right-16 -top-16 w-64 h-64 {{ $isDown ? 'bg-amber-500/10' : 'bg-emerald-500/10' }} rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
            <div class="space-y-3 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-mono uppercase tracking-wider {{ $isDown ? 'bg-amber-500/20 border border-amber-500/30 text-amber-300' : 'bg-emerald-500/20 border border-emerald-500/30 text-emerald-300' }}">
                    <span class="w-2 h-2 rounded-full {{ $isDown ? 'bg-amber-400 animate-ping' : 'bg-emerald-400' }}"></span>
                    <span>{{ $isDown ? '503 Service Unavailable Active' : 'HTTP 200 • All Public Services Live' }}</span>
                </div>

                <h2 class="text-2xl font-black text-white">
                    @if($isDown)
                        Server Under Upgrade & Maintenance
                    @else
                        Server Live & Fully Operational
                    @endif
                </h2>

                <p class="text-xs text-slate-300 leading-relaxed">
                    @if($isDown)
                        <strong class="text-amber-400">Frontend visitors &amp; User Dashboard users</strong> receive an HTTP 503 "Service Unavailable" response with dynamic upgrade timeline. 
                        <strong class="text-emerald-400">Administrators retain 100% login access</strong> and can upgrade server status back to live at any moment below.
                    @else
                        All frontend themes, client dashboards, and public routes are serving traffic normally. Toggle into maintenance mode when deploying database migrations or server performance upgrades.
                    @endif
                </p>

                <!-- Status Pills -->
                <div class="pt-2 flex flex-wrap items-center gap-3 text-xs font-mono">
                    <div class="px-3 py-1.5 rounded-xl bg-black/40 border border-white/10 flex items-center gap-2">
                        <span class="text-slate-400">Frontend:</span>
                        <span class="{{ $isDown ? 'text-amber-400 font-bold' : 'text-emerald-400 font-bold' }}">
                            {{ $isDown ? '503 Unavailable' : '200 Online' }}
                        </span>
                    </div>
                    <div class="px-3 py-1.5 rounded-xl bg-black/40 border border-white/10 flex items-center gap-2">
                        <span class="text-slate-400">User Dashboard:</span>
                        <span class="{{ $isDown ? 'text-amber-400 font-bold' : 'text-emerald-400 font-bold' }}">
                            {{ $isDown ? '503 Unavailable' : 'Active' }}
                        </span>
                    </div>
                    <div class="px-3 py-1.5 rounded-xl bg-black/40 border border-white/10 flex items-center gap-2">
                        <span class="text-slate-400">Admin Login &amp; Hub:</span>
                        <span class="text-emerald-400 font-bold">Unrestricted (Always Accessible)</span>
                    </div>
                </div>
            </div>

            <!-- Quick Action 1-Click Upgrade / Toggle Button -->
            <div class="shrink-0 flex flex-col gap-3">
                <form action="{{ route('admin.maintenance.toggle') }}" method="POST">
                    @csrf
                    @if($isDown)
                        <button 
                            type="submit" 
                            class="w-full sm:w-auto px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-wider bg-emerald-500 hover:bg-emerald-400 text-black shadow-xl shadow-emerald-500/25 transition-all hover:scale-105 active:scale-95 flex items-center justify-center gap-2.5"
                        >
                            <svg class="w-5 h-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Upgrade Server Status (Bring Server UP)</span>
                        </button>
                    @else
                        <button 
                            type="submit" 
                            onclick="return confirm('Are you sure you want to activate Service Unavailable mode for frontend and user panel? Administrators can still log in and upgrade server status.')"
                            class="w-full sm:w-auto px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-wider bg-amber-500 hover:bg-amber-400 text-black shadow-xl shadow-amber-500/20 transition-all hover:scale-105 active:scale-95 flex items-center justify-center gap-2.5"
                        >
                            <svg class="w-5 h-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <span>Enable 503 Service Unavailable</span>
                        </button>
                    @endif
                </form>

                <div class="flex items-center justify-center gap-3 text-[11px] font-mono text-slate-400">
                    <a href="{{ route('home') }}" target="_blank" class="hover:text-white underline decoration-white/30" title="Check public frontend behavior">
                        {{ $isDown ? 'Check Public 503 Screen ↗' : 'Check Live Website ↗' }}
                    </a>
                    @if($isDown)
                        <span>&bull;</span>
                        <a href="{{ url('/?preview=1') }}" target="_blank" class="hover:text-amber-300 text-amber-400 underline decoration-amber-400/30" title="Preview frontend bypassing 503 as admin">
                            Admin Preview Live ↗
                        </a>
                    @endif
                    <span>&bull;</span>
                    <a href="{{ route('login') }}" target="_blank" class="hover:text-white underline decoration-white/30">
                        Check Login Page ↗
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. CUSTOMIZE 503 SERVICE UNAVAILABLE MESSAGE & TIMELINE -->
    <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-6">
        <div class="border-b border-white/10 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-mono uppercase tracking-widest text-indigo-400">Message Customization</span>
                <h2 class="text-xl font-bold text-white mt-0.5">503 Service Unavailable Notice &amp; Timeline Details</h2>
                <p class="text-xs text-slate-400">Customize what visitors see on the error page during upgrades.</p>
            </div>
            <div class="text-xs font-mono text-slate-400">
                Template: <span class="text-white">resources/views/errors/503.blade.php</span>
            </div>
        </div>

        <form action="{{ route('admin.maintenance.upgradeStatus') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="action" value="maintenance">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-mono text-slate-300 mb-1.5">503 Page Headline / Title</label>
                    <input 
                        type="text" 
                        name="title" 
                        value="{{ $systemInfo['maintenance_title'] }}"
                        placeholder="System Upgrade in Progress"
                        class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono focus:outline-none focus:border-indigo-500"
                    >
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-300 mb-1.5">Estimated Duration Text</label>
                    <input 
                        type="text" 
                        name="estimated_time" 
                        value="{{ $systemInfo['maintenance_estimated_time'] }}"
                        placeholder="Estimated duration: 15–30 minutes"
                        class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono focus:outline-none focus:border-indigo-500"
                    >
                </div>
            </div>

            <div>
                <label class="block text-xs font-mono text-slate-300 mb-1.5">Notice Message for Visitors</label>
                <textarea 
                    name="message" 
                    rows="3" 
                    class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-sans focus:outline-none focus:border-indigo-500 leading-relaxed"
                >{{ $systemInfo['maintenance_message'] }}</textarea>
            </div>

            <div class="flex items-center justify-between pt-2">
                <span class="text-xs text-slate-400 font-mono">
                    Changes apply immediately to any active or upcoming 503 screen.
                </span>
                <button 
                    type="submit" 
                    class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all"
                >
                    Save Notice &amp; Apply Details
                </button>
            </div>
        </form>
    </div>

    <!-- 3. CACHE PURGE & OPTIMIZATION CONTROL CENTER -->
    <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-6">
        <div class="border-b border-white/10 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-mono uppercase tracking-widest text-indigo-400">Cache Invalidation</span>
                <h2 class="text-xl font-bold text-white mt-1">Application Cache &amp; Speed Management</h2>
                <p class="text-xs text-slate-400">Purge stale compiled files or reset application caches after content adjustments.</p>
            </div>
            <form action="{{ route('admin.maintenance.clearCache') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="optimize">
                <button type="submit" class="px-5 py-2.5 rounded-xl font-extrabold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all">
                    Purge All Caches (Full Optimize)
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- App Data Cache -->
            <div class="p-5 rounded-2xl bg-black/40 border border-white/5 flex flex-col justify-between space-y-4">
                <div>
                    <h3 class="font-bold text-sm text-white">App Cache</h3>
                    <p class="text-[11px] text-slate-400 mt-1">Clears application level cache data store.</p>
                </div>
                <form action="{{ route('admin.maintenance.clearCache') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="data">
                    <button type="submit" class="w-full py-2 px-3 rounded-lg text-xs font-mono bg-slate-800 hover:bg-slate-700 text-slate-300">
                        Clear Cache
                    </button>
                </form>
            </div>

            <!-- Config Cache -->
            <div class="p-5 rounded-2xl bg-black/40 border border-white/5 flex flex-col justify-between space-y-4">
                <div>
                    <h3 class="font-bold text-sm text-white">Config Cache</h3>
                    <p class="text-[11px] text-slate-400 mt-1">Clears cached configuration and env files.</p>
                </div>
                <form action="{{ route('admin.maintenance.clearCache') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="config">
                    <button type="submit" class="w-full py-2 px-3 rounded-lg text-xs font-mono bg-slate-800 hover:bg-slate-700 text-slate-300">
                        Clear Config
                    </button>
                </form>
            </div>

            <!-- Route Cache -->
            <div class="p-5 rounded-2xl bg-black/40 border border-white/5 flex flex-col justify-between space-y-4">
                <div>
                    <h3 class="font-bold text-sm text-white">Route Cache</h3>
                    <p class="text-[11px] text-slate-400 mt-1">Clears compiled route registration map.</p>
                </div>
                <form action="{{ route('admin.maintenance.clearCache') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="routes">
                    <button type="submit" class="w-full py-2 px-3 rounded-lg text-xs font-mono bg-slate-800 hover:bg-slate-700 text-slate-300">
                        Clear Routes
                    </button>
                </form>
            </div>

            <!-- Compiled Views -->
            <div class="p-5 rounded-2xl bg-black/40 border border-white/5 flex flex-col justify-between space-y-4">
                <div>
                    <h3 class="font-bold text-sm text-white">Compiled Views</h3>
                    <p class="text-[11px] text-slate-400 mt-1">Clears compiled Blade template files.</p>
                </div>
                <form action="{{ route('admin.maintenance.clearCache') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="views">
                    <button type="submit" class="w-full py-2 px-3 rounded-lg text-xs font-mono bg-slate-800 hover:bg-slate-700 text-slate-300">
                        Clear Views
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
        <div class="border-b border-white/10 pb-4">
            <span class="text-xs font-mono uppercase tracking-widest text-indigo-400">Diagnostics</span>
            <h2 class="text-xl font-bold text-white mt-1">Server Information &amp; Diagnostics</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div class="p-4 rounded-xl bg-black/30 border border-white/5">
                <span class="text-[11px] font-mono text-slate-500 block">Server Status</span>
                <span class="text-sm font-bold {{ $isDown ? 'text-amber-400' : 'text-emerald-400' }} font-mono uppercase">
                    {{ $isDown ? '503 Maintenance / Upgrading' : 'Live / Operational' }}
                </span>
            </div>
            <div class="p-4 rounded-xl bg-black/30 border border-white/5">
                <span class="text-[11px] font-mono text-slate-500 block">PHP Engine</span>
                <span class="text-sm font-bold text-white font-mono">v{{ $systemInfo['php_version'] }}</span>
            </div>
            <div class="p-4 rounded-xl bg-black/30 border border-white/5">
                <span class="text-[11px] font-mono text-slate-500 block">Laravel Framework</span>
                <span class="text-sm font-bold text-white font-mono">v{{ $systemInfo['laravel_version'] }}</span>
            </div>
            <div class="p-4 rounded-xl bg-black/30 border border-white/5">
                <span class="text-[11px] font-mono text-slate-500 block">Environment</span>
                <span class="text-sm font-bold text-emerald-400 font-mono">{{ $systemInfo['app_env'] }}</span>
            </div>
            <div class="p-4 rounded-xl bg-black/30 border border-white/5">
                <span class="text-[11px] font-mono text-slate-500 block">Database Storage</span>
                <span class="text-sm font-bold text-white font-mono">{{ $systemInfo['database_connection'] }} ({{ $systemInfo['database_size'] }})</span>
            </div>
            <div class="p-4 rounded-xl bg-black/30 border border-white/5">
                <span class="text-[11px] font-mono text-slate-500 block">Storage Writable Status</span>
                <span class="text-sm font-bold text-emerald-400 font-mono">{{ $systemInfo['storage_status'] }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
