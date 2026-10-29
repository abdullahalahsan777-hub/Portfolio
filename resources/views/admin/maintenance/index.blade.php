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
                            onclick="return confirm('Are you sure you want to activate Service Unavailable mode for frontend and user panel? An email notification will be broadcast to all registered users.')"
                            class="w-full sm:w-auto px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-wider bg-amber-500 hover:bg-amber-400 text-black shadow-xl shadow-amber-500/20 transition-all hover:scale-105 active:scale-95 flex items-center justify-center gap-2.5"
                        >
                            <svg class="w-5 h-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <span>Enable 503 Service Unavailable</span>
                        </button>
                    @endif

                    <!-- Automatic Email Dispatch Toggle -->
                    <label class="flex items-center justify-center sm:justify-start gap-2 pt-2 text-[11px] font-mono text-slate-300 cursor-pointer select-none">
                        <input type="checkbox" name="send_email" value="1" checked class="rounded border-white/20 bg-black/40 text-amber-500 focus:ring-0 w-3.5 h-3.5">
                        <span>📧 Send {{ $isDown ? 'Server Live / Up' : 'Service Unavailable (503)' }} email to all {{ $systemInfo['registered_users_count'] ?? 0 }} users</span>
                    </label>
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

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2">
                <label class="flex items-center gap-2 text-xs text-slate-300 font-mono cursor-pointer select-none">
                    <input type="checkbox" name="send_email" value="1" class="rounded border-white/20 bg-black/40 text-indigo-500 focus:ring-0 w-3.5 h-3.5">
                    <span>📧 Also broadcast this updated 503 notice to all registered users</span>
                </label>
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

    <!-- 4. EMAIL BROADCAST NOTIFICATION TEMPLATES (SERVER DOWN & UP) -->
    <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-6">
        <div class="border-b border-white/10 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-mono uppercase tracking-widest text-indigo-400">Automated Mail Alerts</span>
                <h2 class="text-xl font-bold text-white mt-1">Server Status Email Broadcast Templates</h2>
                <p class="text-xs text-slate-400">
                    Dispatched automatically to all registered users ({{ $systemInfo['registered_users_count'] }} accounts) when server maintenance is triggered or restored.
                </p>
            </div>
            <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-black/40 border border-white/10 text-xs font-mono text-slate-300">
                <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                <span>Target: <strong>{{ $systemInfo['registered_users_count'] }} Registered Users</strong></span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Server Down (503) Email Card -->
            <div class="p-6 rounded-2xl bg-black/40 border border-amber-500/20 hover:border-amber-500/40 transition-all flex flex-col justify-between space-y-5 relative overflow-hidden group">
                <div class="absolute -right-8 -top-8 w-32 h-32 bg-amber-500/5 rounded-full blur-2xl pointer-events-none"></div>

                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase bg-amber-500/10 text-amber-400 border border-amber-500/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                            HTTP 503 &bull; Server Down Alert
                        </span>
                        <span class="text-[11px] font-mono text-slate-500">emails.server-down</span>
                    </div>

                    <h3 class="font-extrabold text-base text-white flex items-center gap-2">
                        <span>⚠️ Scheduled Maintenance Notice</span>
                    </h3>

                    <p class="text-xs text-slate-300 leading-relaxed">
                        Sent when clicking <strong>Enable 503 Service Unavailable</strong>. Informs users about planned upgrades, estimated downtime, data safety guarantees, and provides a live status page link.
                    </p>

                    <!-- Mock Subject / Details Preview -->
                    <div class="p-3 rounded-xl bg-slate-950/70 border border-white/5 space-y-1.5 text-[11px] font-mono">
                        <div class="text-slate-400 truncate">
                            <span class="text-slate-500">Subject:</span> ⚠️ [Maintenance Notice] {{ $systemInfo['maintenance_title'] }} &mdash; {{ config('app.name') }}
                        </div>
                        <div class="text-slate-400 truncate">
                            <span class="text-slate-500">Timeline:</span> {{ $systemInfo['maintenance_estimated_time'] }}
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <a 
                        href="{{ route('admin.maintenance.previewEmail', ['type' => 'down']) }}" 
                        target="_blank" 
                        class="px-4 py-2 rounded-xl text-xs font-bold font-mono bg-amber-500/15 hover:bg-amber-500/25 text-amber-300 border border-amber-500/30 transition-all flex items-center gap-1.5"
                    >
                        <span>Preview HTML Template</span>
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>

                    <form action="{{ route('admin.maintenance.sendTestEmail') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="type" value="down">
                        <button 
                            type="submit" 
                            class="px-4 py-2 rounded-xl text-xs font-mono font-medium bg-slate-800 hover:bg-slate-700 text-slate-300 border border-white/5 transition-all"
                            title="Send a sample email to your admin address"
                        >
                            Send Test to My Inbox
                        </button>
                    </form>
                </div>
            </div>

            <!-- Server Up (200) Email Card -->
            <div class="p-6 rounded-2xl bg-black/40 border border-emerald-500/20 hover:border-emerald-500/40 transition-all flex flex-col justify-between space-y-5 relative overflow-hidden group">
                <div class="absolute -right-8 -top-8 w-32 h-32 bg-emerald-500/5 rounded-full blur-2xl pointer-events-none"></div>

                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            HTTP 200 &bull; System Restored Alert
                        </span>
                        <span class="text-[11px] font-mono text-slate-500">emails.server-up</span>
                    </div>

                    <h3 class="font-extrabold text-base text-white flex items-center gap-2">
                        <span>🚀 Service Restored &amp; Live Notice</span>
                    </h3>

                    <p class="text-xs text-slate-300 leading-relaxed">
                        Sent when clicking <strong>Upgrade Server Status (Bring Server UP)</strong>. Confirms systems are back online, caches refreshed, and invites users back to their dashboard.
                    </p>

                    <!-- Mock Subject / Details Preview -->
                    <div class="p-3 rounded-xl bg-slate-950/70 border border-white/5 space-y-1.5 text-[11px] font-mono">
                        <div class="text-slate-400 truncate">
                            <span class="text-slate-500">Subject:</span> 🚀 [Service Restored] System Back Online &amp; Fully Operational &mdash; {{ config('app.name') }}
                        </div>
                        <div class="text-slate-400 truncate">
                            <span class="text-slate-500">Status:</span> HTTP 200 OK &bull; All Portals Operational
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <a 
                        href="{{ route('admin.maintenance.previewEmail', ['type' => 'up']) }}" 
                        target="_blank" 
                        class="px-4 py-2 rounded-xl text-xs font-bold font-mono bg-emerald-500/15 hover:bg-emerald-500/25 text-emerald-300 border border-emerald-500/30 transition-all flex items-center gap-1.5"
                    >
                        <span>Preview HTML Template</span>
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>

                    <form action="{{ route('admin.maintenance.sendTestEmail') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="type" value="up">
                        <button 
                            type="submit" 
                            class="px-4 py-2 rounded-xl text-xs font-mono font-medium bg-slate-800 hover:bg-slate-700 text-slate-300 border border-white/5 transition-all"
                            title="Send a sample email to your admin address"
                        >
                            Send Test to My Inbox
                        </button>
                    </form>
                </div>
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
