@extends('admin.layout')

@section('title', 'Dashboard Overview')
@section('page_title', 'Dashboard Overview')
@section('page_subtitle', 'System Metrics & Operations Overview')

@section('content')
    <div class="space-y-8">

        <!-- System Status Banner -->
        <div
            class="p-6 rounded-3xl bg-gradient-to-r from-[#09101d] via-[#0d1627] to-[#09101d] border border-white/10 shadow-2xl relative overflow-hidden">
            <div class="absolute -top-24 -right-24 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none">
            </div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none">
            </div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <!-- Left Info -->
                <div class="space-y-2">
                    <div class="flex flex-wrap items-center gap-2.5">
                        <!-- Operational Server Status Pill -->
                        @if ($stats['is_maintenance'])
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-bold bg-amber-500/15 text-amber-400 border border-amber-500/30">
                                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                                MAINTENANCE / UPGRADE MODE
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-bold bg-emerald-500/15 text-emerald-400 border border-emerald-500/30">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                SYSTEM OPERATIONAL &bull; LIVE
                            </span>
                        @endif

                        <!-- Active Theme Pill -->
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-mono bg-indigo-500/15 text-indigo-300 border border-indigo-500/30">
                            <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                            Theme: <strong class="capitalize">{{ str_replace('_', ' ', $stats['active_theme']) }}</strong>
                        </span>

                        <!-- Mode Pill -->
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-mono bg-slate-800/80 text-slate-300 border border-white/10">
                            Mode: <strong class="capitalize">{{ $stats['theme_mode'] }}</strong>
                        </span>

                        <!-- Environment Pill -->
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[11px] font-mono bg-slate-800/80 text-slate-400 border border-white/5">
                            Env: <span class="text-white font-semibold">{{ ucfirst($stats['app_env']) }}</span>
                        </span>

                        <!-- Version Release Pill -->
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-bold bg-[#0090e7]/15 text-[#0090e7] border border-[#0090e7]/30 shadow-sm shadow-[#0090e7]/10"
                            title="Official Release Version">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Version: <strong>v{{ $stats['app_version'] ?? config('app.version', '1.0.0') }}</strong>
                        </span>

                        @if ($stats['unread_notifications'] > 0)
                            <a href="{{ route('admin.notifications.index') }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-bold bg-rose-500/15 text-rose-300 border border-rose-500/30 hover:bg-rose-500/25 transition-all">
                                <span class="w-2 h-2 rounded-full bg-rose-400 animate-pulse"></span>
                                {{ $stats['unread_notifications'] }} Unread Alerts
                            </a>
                        @endif
                    </div>

                    <h2 class="text-xl lg:text-2xl font-extrabold text-white tracking-tight">Platform Overview & System Status</h2>
                    <p class="text-xs text-slate-400 max-w-2xl leading-relaxed">
                        System status tracking <strong
                            class="text-indigo-400">{{ $stats['total_content_assets'] }}</strong> content assets,
                        <strong class="text-cyan-400">{{ $stats['total_users'] }}</strong> registered user accounts,
                        <strong class="text-emerald-400">{{ $stats['total_messages'] }}</strong> client inquiries, and
                        <strong class="text-rose-400">{{ $stats['unread_notifications'] }}</strong> unread alerts across the
                        application.
                    </p>
                </div>

                <div class="flex flex-wrap lg:flex-col items-start lg:items-end gap-3 shrink-0">
                    <div class="flex flex-wrap items-center gap-2">
                        <span
                            class="px-2.5 py-1 rounded-lg bg-[#0090e7]/10 border border-[#0090e7]/30 text-[10px] font-mono text-[#0090e7] font-semibold"
                            title="Official Release Version">
                            Release <span class="font-bold">v{{ $stats['app_version'] ?? config('app.version', '1.0.0') }}</span>
                        </span>
                        <span
                            class="px-2.5 py-1 rounded-lg bg-black/40 border border-white/10 text-[10px] font-mono text-slate-300">
                            PHP <span class="text-indigo-300 font-bold">{{ $stats['php_version'] }}</span>
                        </span>
                        <span
                            class="px-2.5 py-1 rounded-lg bg-black/40 border border-white/10 text-[10px] font-mono text-slate-300">
                            Laravel <span class="text-red-400 font-bold">{{ $stats['laravel_version'] }}</span>
                        </span>
                        <span
                            class="px-2.5 py-1 rounded-lg bg-black/40 border border-white/10 text-[10px] font-mono text-slate-300">
                            DB <span class="text-emerald-400 font-bold">{{ $stats['db_size'] }}</span>
                        </span>
                    </div>

                    <!-- Action Controls -->
                    <div class="flex items-center gap-2">
                        @if (auth()->check() && auth()->user()->isAdmin())
                            <!-- Toggle Maintenance Button -->
                            <form action="{{ route('admin.maintenance.toggle') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    title="{{ $stats['is_maintenance'] ? 'Resume Live Operations' : 'Put Website in Maintenance' }}"
                                    class="px-3 py-1.5 rounded-xl text-xs font-semibold {{ $stats['is_maintenance'] ? 'bg-emerald-600 hover:bg-emerald-500 text-white' : 'bg-slate-800 hover:bg-slate-700 text-slate-200 border border-white/10' }} transition-all flex items-center gap-1.5 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    <span>{{ $stats['is_maintenance'] ? 'Go Live' : 'Toggle Maintenance' }}</span>
                                </button>
                            </form>

                            <!-- Quick Cache Purge -->
                            <form action="{{ route('admin.maintenance.clearCache') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="type" value="optimize">
                                <button type="submit" title="Purge system caches"
                                    class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-800 hover:bg-slate-700 text-slate-300 border border-white/10 transition-all flex items-center gap-1.5 shadow-sm">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    <span>Purge Cache</span>
                                </button>
                            </form>
                        @endif

                        <!-- Live Site Link -->
                        <a href="{{ route('home') }}" target="_blank"
                            class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-indigo-600 hover:bg-indigo-500 text-white transition-all flex items-center gap-1.5 shadow-md shadow-indigo-600/30">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            <span>Live Site</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Primary Executive KPI Reporting Cards (4 Columns) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            <!-- Card 1: Client Inquiries & Response Velocity -->
            <div
                class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl relative overflow-hidden flex flex-col justify-between group hover:border-amber-500/40 transition-all">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                            Client Inquiries
                        </span>
                        @if ($stats['unread_messages'] > 0)
                            <span
                                class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-amber-500/20 text-amber-300 border border-amber-500/40 animate-pulse">
                                {{ $stats['unread_messages'] }} Action Needed
                            </span>
                        @else
                            <span
                                class="px-2 py-0.5 rounded-full text-[10px] font-mono font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                All Caught Up
                            </span>
                        @endif
                    </div>

                    <div class="flex items-baseline gap-2">
                        <div
                            class="text-3xl font-extrabold font-mono {{ $stats['unread_messages'] > 0 ? 'text-amber-400' : 'text-white' }}">
                            {{ $stats['unread_messages'] }}
                        </div>
                        <span class="text-xs text-slate-400 font-mono">unread / {{ $stats['total_messages'] }} total</span>
                    </div>

                    <!-- Response Rate Progress Bar -->
                    <div class="space-y-1">
                        <div class="flex items-center justify-between text-[11px] font-mono text-slate-400">
                            <span>Read Rate</span>
                            <span class="text-white font-bold">{{ $stats['read_percentage'] }}%</span>
                        </div>
                        <div class="w-full h-1.5 rounded-full bg-white/5 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-amber-500 to-emerald-400 transition-all duration-500"
                                style="width: {{ $stats['read_percentage'] }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 mt-4 border-t border-white/5 flex items-center justify-between">
                    <a href="{{ route('admin.messages.index') }}"
                        class="text-xs font-semibold text-amber-400 hover:text-amber-300 flex items-center gap-1 transition-colors">
                        Manage Inquiries Inbox &rarr;
                    </a>
                    <span class="text-[10px] font-mono text-slate-400">{{ $stats['read_messages'] }} Read</span>
                </div>
            </div>

            <!-- Card 2: Total Content Volume Matrix -->
            <div
                class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl relative overflow-hidden flex flex-col justify-between group hover:border-indigo-500/40 transition-all">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                            Content Portfolio
                        </span>
                        <span
                            class="px-2 py-0.5 rounded-full text-[10px] font-mono font-medium bg-indigo-500/10 text-indigo-300 border border-indigo-500/20">
                            8 Subsystems
                        </span>
                    </div>

                    <div class="flex items-baseline gap-2">
                        <div class="text-3xl font-extrabold text-white font-mono">
                            {{ $stats['total_content_assets'] }}
                        </div>
                        <span class="text-xs text-slate-400 font-mono">total records</span>
                    </div>

                    <!-- Mini Metrics Chips -->
                    <div class="flex flex-wrap items-center gap-1.5 text-[10px] font-mono text-slate-300">
                        <span class="px-1.5 py-0.5 rounded bg-white/5">{{ $stats['total_projects'] }} Works</span>
                        <span class="px-1.5 py-0.5 rounded bg-white/5">{{ $stats['total_articles'] }} Articles</span>
                        <span class="px-1.5 py-0.5 rounded bg-white/5">{{ $stats['total_services'] }} Services</span>
                        <span class="px-1.5 py-0.5 rounded bg-white/5">{{ $stats['total_skills'] }} Skills</span>
                    </div>
                </div>

                <div class="pt-4 mt-4 border-t border-white/5 flex items-center justify-between">
                    <a href="{{ route('admin.website.content') }}"
                        class="text-xs font-semibold text-indigo-400 hover:text-indigo-300 flex items-center gap-1 transition-colors">
                        Website Studio Hub &rarr;
                    </a>
                    <span class="text-[10px] font-mono text-slate-400">{{ $stats['published_articles'] }} Pub.
                        Posts</span>
                </div>
            </div>

            <!-- Card 3: User Accounts & Access Matrix -->
            <div
                class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl relative overflow-hidden flex flex-col justify-between group hover:border-cyan-500/40 transition-all">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                            Registered Users
                        </span>
                        <span
                            class="px-2 py-0.5 rounded-full text-[10px] font-mono font-medium bg-cyan-500/10 text-cyan-300 border border-cyan-500/20">
                            {{ $stats['admin_users'] }} Admins
                        </span>
                    </div>

                    <div class="flex items-baseline gap-2">
                        <div class="text-3xl font-extrabold text-cyan-400 font-mono">
                            {{ $stats['total_users'] }}
                        </div>
                        <span class="text-xs text-slate-400 font-mono">active accounts</span>
                    </div>

                    <!-- Users Breakdown Bar -->
                    <div class="space-y-1">
                        <div class="flex items-center justify-between text-[11px] font-mono text-slate-400">
                            <span>Role Spread</span>
                            <span class="text-slate-300">{{ $stats['admin_users'] }} Adm &bull;
                                {{ $stats['client_users'] }} User</span>
                        </div>
                        <div class="w-full h-1.5 rounded-full bg-white/5 overflow-hidden flex">
                            <div class="h-full bg-indigo-500"
                                style="width: {{ $stats['total_users'] > 0 ? ($stats['admin_users'] / $stats['total_users']) * 100 : 0 }}%">
                            </div>
                            <div class="h-full bg-cyan-400"
                                style="width: {{ $stats['total_users'] > 0 ? ($stats['client_users'] / $stats['total_users']) * 100 : 0 }}%">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 mt-4 border-t border-white/5 flex items-center justify-between">
                    @if (auth()->check() && auth()->user()->isAdmin())
                        <a href="{{ route('admin.users.index') }}"
                            class="text-xs font-semibold text-cyan-400 hover:text-cyan-300 flex items-center gap-1 transition-colors">
                            Manage User Accounts &rarr;
                        </a>
                    @else
                        <span class="text-xs font-semibold text-slate-400">
                            Community Accounts
                        </span>
                    @endif
                    <span class="text-[10px] font-mono text-slate-400">{{ $stats['social_users'] }} OAuth</span>
                </div>
            </div>

            <!-- Card 4: Live Theme & Engine Engine -->
            <div
                class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl relative overflow-hidden flex flex-col justify-between group hover:border-purple-500/40 transition-all">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                            Active Theme
                        </span>
                        <span
                            class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-purple-500/20 text-purple-300 border border-purple-500/30 capitalize">
                            {{ $stats['theme_mode'] }} Mode
                        </span>
                    </div>

                    <div>
                        <div class="text-2xl font-extrabold text-purple-300 capitalize tracking-tight">
                            {{ str_replace('_', ' ', $stats['active_theme']) }}
                        </div>
                        <span class="text-xs text-slate-400 font-mono">Portfolio Theme Engine</span>
                    </div>

                    <div class="flex items-center gap-2 text-[11px] font-mono text-slate-400">
                        <span class="flex items-center gap-1 text-emerald-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            Storage: {{ $stats['storage_status'] }}
                        </span>
                        <span>&bull;</span>
                        <span>Cache: {{ $stats['cache_driver'] }}</span>
                    </div>
                </div>

                <div class="pt-4 mt-4 border-t border-white/5 flex items-center justify-between">
                    <a href="{{ route('admin.settings.theme') }}"
                        class="text-xs font-semibold text-purple-400 hover:text-purple-300 flex items-center gap-1 transition-colors">
                        Theme Engine Settings &rarr;
                    </a>
                    <span class="text-[10px] font-mono text-slate-400">Synced</span>
                </div>
            </div>

            <!-- Card 5: Notifications & Operational Activity Matrix -->
            <div
                class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl relative overflow-hidden flex flex-col justify-between group hover:border-indigo-500/40 transition-all">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full {{ $stats['unread_notifications'] > 0 ? 'bg-rose-400 animate-pulse' : 'bg-indigo-400' }}"></span>
                            Notifications
                        </span>
                        @if ($stats['unread_notifications'] > 0)
                            <span
                                class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-rose-500/20 text-rose-300 border border-rose-500/40 animate-pulse">
                                {{ $stats['unread_notifications'] }} Unread
                            </span>
                        @else
                            <span
                                class="px-2 py-0.5 rounded-full text-[10px] font-mono font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                All Caught Up
                            </span>
                        @endif
                    </div>

                    <div class="flex items-baseline gap-2">
                        <div
                            class="text-3xl font-extrabold font-mono {{ $stats['unread_notifications'] > 0 ? 'text-rose-400' : 'text-white' }}">
                            {{ $stats['unread_notifications'] }}
                        </div>
                        <span class="text-xs text-slate-400 font-mono">unread / {{ $stats['total_notifications'] }} total</span>
                    </div>

                    <!-- Read Rate Progress Bar -->
                    <div class="space-y-1">
                        <div class="flex items-center justify-between text-[11px] font-mono text-slate-400">
                            <span>Read Rate</span>
                            <span class="text-white font-bold">{{ $stats['notification_read_percentage'] }}%</span>
                        </div>
                        <div class="w-full h-1.5 rounded-full bg-white/5 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-rose-500 via-indigo-500 to-emerald-400 transition-all duration-500"
                                style="width: {{ $stats['notification_read_percentage'] }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 mt-4 border-t border-white/5 flex items-center justify-between">
                    <a href="{{ route('admin.notifications.index') }}"
                        class="text-xs font-semibold text-indigo-400 hover:text-indigo-300 flex items-center gap-1 transition-colors">
                        Manage Notifications &rarr;
                    </a>
                    <span class="text-[10px] font-mono text-slate-400">{{ $stats['today_notifications'] }} Today</span>
                </div>
            </div>
        </div>

        <!-- 3. Subsystems Content Reporting Grid (8 Comprehensive Subsystems) -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-extrabold text-white tracking-tight flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Content & Resources Overview
                    </h3>
                    <p class="text-xs text-slate-400">Inventory and breakdown across all portfolio modules</p>
                </div>
                <a href="{{ route('admin.website.content') }}"
                    class="text-xs font-mono text-indigo-400 hover:text-indigo-300 flex items-center gap-1">
                    Website Editor &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

                <!-- 1. Projects -->
                <div
                    class="p-5 rounded-2xl bg-[#09101d] border border-white/10 hover:border-indigo-500/40 transition-all flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div
                                class="w-8 h-8 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] font-mono px-2 py-0.5 rounded bg-indigo-500/10 text-indigo-300 border border-indigo-500/20">
                                {{ $stats['featured_projects'] }} Featured
                            </span>
                        </div>
                        <div>
                            <div class="text-2xl font-bold font-mono text-white">{{ $stats['total_projects'] }}</div>
                            <span class="text-xs font-semibold text-slate-300">Portfolio Projects</span>
                            <p class="text-[11px] text-slate-400">Showcased works & case studies</p>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-white/5 flex items-center justify-between text-xs">
                        <a href="{{ route('admin.projects.index') }}"
                            class="font-mono text-slate-400 hover:text-white">View All &rarr;</a>
                        <a href="{{ route('admin.projects.create') }}"
                            class="font-bold text-indigo-400 hover:text-indigo-300">+ New</a>
                    </div>
                </div>

                <!-- 2. Blog Posts & Articles -->
                <div
                    class="p-5 rounded-2xl bg-[#09101d] border border-white/10 hover:border-pink-500/40 transition-all flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div
                                class="w-8 h-8 rounded-xl bg-pink-500/10 border border-pink-500/20 text-pink-400 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] font-mono px-2 py-0.5 rounded bg-pink-500/10 text-pink-300 border border-pink-500/20">
                                {{ $stats['published_articles'] }} Live &bull; {{ $stats['draft_articles'] }} Draft
                            </span>
                        </div>
                        <div>
                            <div class="text-2xl font-bold font-mono text-white">{{ $stats['total_articles'] }}</div>
                            <span class="text-xs font-semibold text-slate-300">Articles & Blog</span>
                            <p class="text-[11px] text-slate-400">Insights, news and publications</p>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-white/5 flex items-center justify-between text-xs">
                        <a href="{{ route('admin.blog.index') }}" class="font-mono text-slate-400 hover:text-white">View
                            All &rarr;</a>
                        <a href="{{ route('admin.blog.create') }}" class="font-bold text-pink-400 hover:text-pink-300">+
                            New</a>
                    </div>
                </div>

                <!-- 3. Core Services -->
                <div
                    class="p-5 rounded-2xl bg-[#09101d] border border-white/10 hover:border-emerald-500/40 transition-all flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div
                                class="w-8 h-8 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-300 border border-emerald-500/20">
                                Active Offerings
                            </span>
                        </div>
                        <div>
                            <div class="text-2xl font-bold font-mono text-white">{{ $stats['total_services'] }}</div>
                            <span class="text-xs font-semibold text-slate-300">Offered Services</span>
                            <p class="text-[11px] text-slate-400">Client solutions and capabilities</p>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-white/5 flex items-center justify-between text-xs">
                        <a href="{{ route('admin.services.index') }}"
                            class="font-mono text-slate-400 hover:text-white">View All &rarr;</a>
                        <a href="{{ route('admin.services.create') }}"
                            class="font-bold text-emerald-400 hover:text-emerald-300">+ New</a>
                    </div>
                </div>

                <!-- 4. Skills & Tech Stack -->
                <div
                    class="p-5 rounded-2xl bg-[#09101d] border border-white/10 hover:border-cyan-500/40 transition-all flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div
                                class="w-8 h-8 rounded-xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] font-mono px-2 py-0.5 rounded bg-cyan-500/10 text-cyan-300 border border-cyan-500/20">
                                Avg: {{ $stats['avg_skill_level'] }}%
                            </span>
                        </div>
                        <div>
                            <div class="text-2xl font-bold font-mono text-white">{{ $stats['total_skills'] }}</div>
                            <span class="text-xs font-semibold text-slate-300">Technical Skills</span>
                            <p class="text-[11px] text-slate-400">Tools, frameworks & proficiencies</p>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-white/5 flex items-center justify-between text-xs">
                        <a href="{{ route('admin.skills.index') }}"
                            class="font-mono text-slate-400 hover:text-white">View All &rarr;</a>
                        <a href="{{ route('admin.skills.create') }}"
                            class="font-bold text-cyan-400 hover:text-cyan-300">+ New</a>
                    </div>
                </div>

                <!-- 5. Resume & Career Timeline -->
                <div
                    class="p-5 rounded-2xl bg-[#09101d] border border-white/10 hover:border-amber-500/40 transition-all flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div
                                class="w-8 h-8 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] font-mono px-2 py-0.5 rounded bg-amber-500/10 text-amber-300 border border-amber-500/20">
                                {{ $stats['experience_count'] }} Exp &bull; {{ $stats['education_count'] }} Edu
                            </span>
                        </div>
                        <div>
                            <div class="text-2xl font-bold font-mono text-white">{{ $stats['total_resume'] }}</div>
                            <span class="text-xs font-semibold text-slate-300">Resume & Experience</span>
                            <p class="text-[11px] text-slate-400">Career journey and credentials</p>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-white/5 flex items-center justify-between text-xs">
                        <a href="{{ route('admin.resume.index') }}"
                            class="font-mono text-slate-400 hover:text-white">View All &rarr;</a>
                        <a href="{{ route('admin.resume.create') }}"
                            class="font-bold text-amber-400 hover:text-amber-300">+ New</a>
                    </div>
                </div>

                <!-- 6. Pricing Packages & Plans -->
                <div
                    class="p-5 rounded-2xl bg-[#09101d] border border-white/10 hover:border-violet-500/40 transition-all flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div
                                class="w-8 h-8 rounded-xl bg-violet-500/10 border border-violet-500/20 text-violet-400 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] font-mono px-2 py-0.5 rounded bg-violet-500/10 text-violet-300 border border-violet-500/20">
                                {{ $stats['featured_pricing_plans'] }} Featured Tier
                            </span>
                        </div>
                        <div>
                            <div class="text-2xl font-bold font-mono text-white">{{ $stats['total_pricing_plans'] }}</div>
                            <span class="text-xs font-semibold text-slate-300">Pricing Packages</span>
                            <p class="text-[11px] text-slate-400">Subscription and project tiers</p>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-white/5 flex items-center justify-between text-xs">
                        <a href="{{ route('admin.pricing.index') }}"
                            class="font-mono text-slate-400 hover:text-white">View All &rarr;</a>
                        <a href="{{ route('admin.pricing.create') }}"
                            class="font-bold text-violet-400 hover:text-violet-300">+ New</a>
                    </div>
                </div>

                <!-- 7. Testimonials & Client Reviews -->
                <div
                    class="p-5 rounded-2xl bg-[#09101d] border border-white/10 hover:border-yellow-500/40 transition-all flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div
                                class="w-8 h-8 rounded-xl bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] font-mono px-2 py-0.5 rounded bg-yellow-500/10 text-yellow-300 border border-yellow-500/20">
                                {{ $stats['top_rating_testimonials'] }} 5-Star Reviews
                            </span>
                        </div>
                        <div>
                            <div class="text-2xl font-bold font-mono text-white">{{ $stats['total_testimonials'] }}</div>
                            <span class="text-xs font-semibold text-slate-300">Client Testimonials</span>
                            <p class="text-[11px] text-slate-400">Social proof & client ratings</p>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-white/5 flex items-center justify-between text-xs">
                        <a href="{{ route('admin.testimonials.index') }}"
                            class="font-mono text-slate-400 hover:text-white">View All &rarr;</a>
                        <a href="{{ route('admin.testimonials.create') }}"
                            class="font-bold text-yellow-400 hover:text-yellow-300">+ New</a>
                    </div>
                </div>

                <!-- 8. Frequently Asked Questions -->
                <div
                    class="p-5 rounded-2xl bg-[#09101d] border border-white/10 hover:border-blue-500/40 transition-all flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div
                                class="w-8 h-8 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-[10px] font-mono px-2 py-0.5 rounded bg-blue-500/10 text-blue-300 border border-blue-500/20">
                                Help Center
                            </span>
                        </div>
                        <div>
                            <div class="text-2xl font-bold font-mono text-white">{{ $stats['total_faqs'] }}</div>
                            <span class="text-xs font-semibold text-slate-300">Frequently Asked (FAQ)</span>
                            <p class="text-[11px] text-slate-400">Questions and guided answers</p>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-white/5 flex items-center justify-between text-xs">
                        <a href="{{ route('admin.faqs.index') }}" class="font-mono text-slate-400 hover:text-white">View
                            All &rarr;</a>
                        <a href="{{ route('admin.faqs.create') }}" class="font-bold text-blue-400 hover:text-blue-300">+
                            New</a>
                    </div>
                </div>

            </div>
        </div>

        <!-- 4. Client Inquiries Dispatch & Communications Log -->
        <div class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2">
                        <h3 class="text-base font-bold text-white">Client Inquiries & Communications Stream</h3>
                        @if ($stats['unread_messages'] > 0)
                            <span
                                class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-amber-500/20 text-amber-300 border border-amber-500/30">
                                {{ $stats['unread_messages'] }} Unread
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-slate-400">Incoming inquiries submitted through the frontend portfolio contact
                        touchpoints</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.messages.index') }}"
                        class="px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-white/5 hover:bg-white/10 text-slate-200 border border-white/10 transition-all flex items-center gap-1.5">
                        <span>Open Inquiries Inbox ({{ $stats['total_messages'] }})</span>
                        &rarr;
                    </a>
                </div>
            </div>

            <div class="space-y-3">
                @forelse($recentMessages as $msg)
                    <div
                        class="p-4 rounded-2xl bg-black/40 border {{ $msg->is_read ? 'border-white/5' : 'border-amber-500/30 bg-amber-500/5' }} flex flex-col md:flex-row md:items-center justify-between gap-4 transition-all hover:border-white/20">
                        <!-- Sender Details -->
                        <div class="flex items-start sm:items-center gap-3 overflow-hidden">
                            <!-- Avatar Initials -->
                            <div
                                class="w-10 h-10 rounded-xl {{ $msg->is_read ? 'bg-slate-800 text-slate-300' : 'bg-gradient-to-tr from-amber-600 to-amber-400 text-white shadow-md' }} font-bold text-xs flex items-center justify-center shrink-0 font-mono">
                                {{ strtoupper(substr($msg->name, 0, 2)) }}
                            </div>
                            <div class="space-y-1 overflow-hidden min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-xs font-bold text-white">{{ $msg->name }}</span>
                                    <span class="text-[11px] font-mono text-slate-400">{{ $msg->email }}</span>
                                    @if ($msg->phone)
                                        <span class="text-[10px] font-mono text-slate-400">&bull;
                                            {{ $msg->phone }}</span>
                                    @endif
                                    @if ($msg->service_type)
                                        <span
                                            class="px-2 py-0.2 rounded text-[10px] font-mono bg-indigo-500/10 text-indigo-300 border border-indigo-500/20">
                                            {{ $msg->service_type }}
                                        </span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-300 truncate max-w-2xl">
                                    @if ($msg->subject)
                                        <strong class="text-white">{{ $msg->subject }}:</strong>
                                    @endif
                                    {{ $msg->message }}
                                </p>
                            </div>
                        </div>

                        <!-- Meta & Actions -->
                        <div class="flex items-center gap-3 shrink-0 self-end md:self-center">
                            <span class="text-[10px] font-mono text-slate-400">
                                {{ $msg->created_at ? $msg->created_at->diffForHumans() : 'Recent' }}
                            </span>

                            <span
                                class="px-2 py-0.5 rounded text-[10px] font-mono font-medium {{ $msg->is_read ? 'bg-slate-800 text-slate-400' : 'bg-amber-500/20 text-amber-300 border border-amber-500/30' }}">
                                {{ $msg->is_read ? 'Read' : 'New' }}
                            </span>

                            <!-- 1-Click Toggle Read -->
                            <form action="{{ route('admin.messages.toggleRead', $msg) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" title="{{ $msg->is_read ? 'Mark as Unread' : 'Mark as Read' }}"
                                    class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-all text-xs font-mono">
                                    {{ $msg->is_read ? 'Mark Unread' : 'Mark Read' }}
                                </button>
                            </form>

                            <a href="{{ route('admin.messages.show', $msg) }}"
                                class="px-3 py-1 rounded-lg text-xs font-semibold bg-indigo-600/30 hover:bg-indigo-600 text-indigo-200 hover:text-white border border-indigo-500/30 transition-all">
                                View &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 rounded-2xl bg-black/20 border border-white/5 space-y-2">
                        <svg class="w-8 h-8 text-slate-400 mx-auto" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <div class="text-xs text-slate-400">No client messages received yet. All new inquiries will be
                            reported here in real time.</div>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <div class="lg:col-span-6 space-y-6">
                <!-- Recent Portfolio Projects -->

                <div class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-bold text-white flex items-center gap-2">
                                <span>Recent Portfolio Works</span>
                                <span class="text-xs font-mono text-slate-400">({{ $stats['total_projects'] }}
                                    total)</span>
                            </h3>
                            <p class="text-[11px] text-slate-400">Latest showcase projects published on the website</p>
                        </div>
                        <a href="{{ route('admin.projects.create') }}"
                            class="text-xs font-semibold text-emerald-400 hover:text-emerald-300">
                            + New Project
                        </a>
                    </div>

                    <div class="space-y-3">
                        @forelse($recentProjects as $proj)
                            <div
                                class="p-3.5 rounded-2xl bg-black/40 border border-white/5 flex items-center justify-between gap-4 hover:border-white/15 transition-all">
                                <div class="flex items-center gap-3 overflow-hidden">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-slate-900 border border-white/10 overflow-hidden shrink-0">
                                        @if ($proj->image_url)
                                            <img src="{{ $proj->image_url }}" alt=""
                                                class="w-full h-full object-cover">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center text-[10px] font-mono text-slate-400">
                                                Works</div>
                                        @endif
                                    </div>
                                    <div class="overflow-hidden min-w-0">
                                        <h4 class="text-xs font-bold text-white truncate">{{ $proj->title }}</h4>
                                        <div
                                            class="flex items-center gap-2 text-[10px] font-mono text-indigo-400 uppercase">
                                            <span>{{ $proj->category }}</span>
                                            <span>&bull;</span>
                                            <span class="text-slate-400">{{ $proj->theme ?: 'All Themes' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 shrink-0">
                                    @if ($proj->is_featured)
                                        <span
                                            class="px-2 py-0.5 rounded text-[9px] font-mono bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                                            Featured
                                        </span>
                                    @endif
                                    <a href="{{ route('admin.projects.edit', $proj) }}" title="Edit Project"
                                        class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-xs text-slate-400">No projects added yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="lg:col-span-6 space-y-6">
                <!-- Recent Blog Articles -->
                <div class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-bold text-white flex items-center gap-2">
                                <span>Recent Articles & Publications</span>
                                <span class="text-xs font-mono text-slate-400">({{ $stats['total_articles'] }}
                                    total)</span>
                            </h3>
                            <p class="text-[11px] text-slate-400">Insights, technology articles, and updates</p>
                        </div>
                        <a href="{{ route('admin.blog.create') }}"
                            class="text-xs font-semibold text-pink-400 hover:text-pink-300">
                            + Write Article
                        </a>
                    </div>

                    <div class="space-y-3">
                        @forelse($recentArticles as $article)
                            <div
                                class="p-3.5 rounded-2xl bg-black/40 border border-white/5 flex items-center justify-between gap-4 hover:border-white/15 transition-all">
                                <div class="space-y-0.5 overflow-hidden min-w-0">
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-xs font-bold text-white truncate">{{ $article->title }}</h4>
                                    </div>
                                    <div class="flex items-center gap-2 text-[10px] font-mono text-slate-400">
                                        <span class="text-pink-400 uppercase">{{ $article->category }}</span>
                                        <span>&bull;</span>
                                        <span>{{ $article->read_time ?: '5 min read' }}</span>
                                        <span>&bull;</span>
                                        <span>{{ $article->date }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 shrink-0">
                                    <span
                                        class="px-2 py-0.5 rounded text-[9px] font-mono {{ $article->is_published ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-slate-800 text-slate-400' }}">
                                        {{ $article->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                    <a href="{{ route('admin.blog.edit', $article) }}" title="Edit Article"
                                        class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-all">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-xs text-slate-400">No blog articles published yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <div class="lg:col-span-6 space-y-6">
                <!-- User Community & Auth Distribution -->
                <div class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-bold text-white flex items-center gap-2">
                                <span>User Accounts & Security</span>
                                <span class="text-xs font-mono text-cyan-400">({{ $stats['total_users'] }} total)</span>
                            </h3>
                            <p class="text-[11px] text-slate-400">Registration logs, role assignments & auth providers</p>
                        </div>
                        @if (auth()->check() && auth()->user()->isAdmin())
                            <a href="{{ route('admin.users.index') }}"
                                class="text-xs font-semibold text-cyan-400 hover:text-cyan-300">
                                Manage &rarr;
                            </a>
                        @endif
                    </div>

                    <!-- Auth Breakdown Metrics -->
                    <div class="grid grid-cols-3 gap-3 text-center">
                        <div class="p-3 rounded-2xl bg-black/40 border border-white/5 space-y-1">
                            <span class="text-[10px] font-mono text-slate-400 uppercase">Admins</span>
                            <div class="text-xl font-bold font-mono text-indigo-400">{{ $stats['admin_users'] }}</div>
                        </div>
                        <div class="p-3 rounded-2xl bg-black/40 border border-white/5 space-y-1">
                            <span class="text-[10px] font-mono text-slate-400 uppercase">Clients</span>
                            <div class="text-xl font-bold font-mono text-cyan-400">{{ $stats['client_users'] }}</div>
                        </div>
                        <div class="p-3 rounded-2xl bg-black/40 border border-white/5 space-y-1">
                            <span class="text-[10px] font-mono text-slate-400 uppercase">Social OAuth</span>
                            <div class="text-xl font-bold font-mono text-amber-400">{{ $stats['social_users'] }}</div>
                        </div>
                    </div>

                    <!-- Recent Registered Users List -->
                    <div class="space-y-3">
                        <div class="text-[11px] font-mono text-slate-400 uppercase tracking-wider">Recently Registered
                            Users</div>
                        @forelse($recentUsers as $usr)
                            <div
                                class="p-3 rounded-2xl bg-black/30 border border-white/5 flex items-center justify-between gap-3">
                                <div class="flex items-center gap-3 overflow-hidden">
                                    <div
                                        class="w-9 h-9 rounded-xl bg-slate-800 border border-white/10 overflow-hidden flex items-center justify-center shrink-0">
                                        @if ($usr->avatar)
                                            <img src="{{ asset($usr->avatar) }}" alt="{{ $usr->name }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <span
                                                class="text-xs font-bold text-slate-300 font-mono">{{ strtoupper(substr($usr->name, 0, 1)) }}</span>
                                        @endif
                                    </div>
                                    <div class="overflow-hidden min-w-0">
                                        <div class="flex items-center gap-1.5">
                                            <h4 class="text-xs font-bold text-white truncate">{{ $usr->name }}</h4>
                                            @if ($usr->isAdmin())
                                                <span
                                                    class="px-1.5 py-0.2 rounded text-[9px] font-mono bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 font-bold">Admin</span>
                                            @else
                                                <span
                                                    class="px-1.5 py-0.2 rounded text-[9px] font-mono bg-slate-800 text-slate-400">User</span>
                                            @endif
                                        </div>
                                        <p class="text-[10px] font-mono text-slate-400 truncate">{{ $usr->email }}</p>
                                    </div>
                                </div>

                                <div class="text-right shrink-0">
                                    @if ($usr->provider)
                                        <span
                                            class="px-1.5 py-0.5 rounded text-[9px] font-mono bg-amber-500/10 text-amber-300 border border-amber-500/20 capitalize">
                                            {{ $usr->provider }}
                                        </span>
                                    @else
                                        <span class="text-[9px] font-mono text-slate-400">
                                            {{ $usr->created_at ? $usr->created_at->format('M d') : 'Recent' }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-xs text-slate-400">No users registered yet.</div>
                        @endforelse
                    </div>

                    @if (auth()->check() && auth()->user()->isAdmin())
                        <div class="pt-2">
                            <a href="{{ route('admin.users.create') }}"
                                class="w-full py-2.5 rounded-xl text-xs font-semibold bg-white/5 hover:bg-white/10 text-slate-200 border border-white/10 flex items-center justify-center gap-2 transition-all">
                                <svg class="w-4 h-4 text-cyan-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                <span>Create New User Account</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-6 space-y-6">
                <!-- Server & Environment Specifications Card -->
                <div class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-bold text-white flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span>System Health & Runtime</span>
                        </h3>
                        @if (auth()->check() && auth()->user()->isAdmin())
                            <a href="{{ route('admin.maintenance.index') }}"
                                class="text-xs text-indigo-400 hover:text-indigo-300">
                                Maintenance Center &rarr;
                            </a>
                        @endif
                    </div>

                    <div class="space-y-2.5 text-xs">
                        <div class="flex items-center justify-between py-1.5 border-b border-white/5">
                            <span class="text-slate-400 font-mono">Portfolio Release</span>
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-[#0090e7]/15 border border-[#0090e7]/30 text-[#0090e7] font-mono font-bold text-[11px]">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                v{{ $stats['app_version'] ?? config('app.version', '1.0.0') }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between py-1.5 border-b border-white/5">
                            <span class="text-slate-400 font-mono">PHP Runtime</span>
                            <span class="text-white font-mono font-bold">{{ $stats['php_version'] }}</span>
                        </div>
                        <div class="flex items-center justify-between py-1.5 border-b border-white/5">
                            <span class="text-slate-400 font-mono">Laravel Framework</span>
                            <span class="text-white font-mono font-bold">{{ $stats['laravel_version'] }}</span>
                        </div>
                        <div class="flex items-center justify-between py-1.5 border-b border-white/5">
                            <span class="text-slate-400 font-mono">Database Connection</span>
                            <span class="text-emerald-400 font-mono font-bold">{{ strtoupper($stats['db_connection']) }}
                                ({{ $stats['db_size'] }})</span>
                        </div>
                        <div class="flex items-center justify-between py-1.5 border-b border-white/5">
                            <span class="text-slate-400 font-mono">Storage Permissions</span>
                            <span class="text-emerald-400 font-mono font-bold">{{ $stats['storage_status'] }}</span>
                        </div>
                        <div class="flex items-center justify-between py-1.5">
                            <span class="text-slate-400 font-mono">Cache & Sessions</span>
                            <span class="text-slate-200 font-mono">{{ $stats['cache_driver'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
