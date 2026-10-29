@extends('admin.layout')

@section('title', 'Notifications')
@section('page_title', 'Notifications')
@section('page_subtitle', 'System / Alerts')

@push('styles')
    <style>
        /* Pro-Grade Obsidian Pagination Micro-interactions */
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
        <!-- Header with Global Actions -->
        <div
            class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl">
            <div class="space-y-1">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-2xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center border border-indigo-500/30 shadow-inner">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-black text-white tracking-tight flex items-center gap-2">
                            <span>Notifications</span>
                            @if ($unreadCount > 0)
                                <span
                                    class="px-2 py-0.5 rounded-full text-xs font-mono font-bold bg-rose-500/20 text-rose-300 border border-rose-500/30 animate-pulse">
                                    {{ $unreadCount }} Unread
                                </span>
                            @endif
                        </h1>
                        <p class="text-xs text-slate-400 font-mono">
                            {{ auth()->check() && auth()->user()->isAdmin() ? 'Viewing all system, user, and administrative activities' : 'Viewing your activity alerts and notices' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2 flex-wrap">
                @if ($unreadCount > 0)
                    <form action="{{ route('admin.notifications.markAllRead') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-3.5 py-2 rounded-xl text-xs font-semibold bg-indigo-600/20 hover:bg-indigo-600/30 text-indigo-300 border border-indigo-500/30 flex items-center gap-2 transition-all cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Mark All Read</span>
                        </button>
                    </form>
                @endif

                @if ($readCount > 0)
                    <form action="{{ route('admin.notifications.clearRead') }}" method="POST"
                        onsubmit="return confirm('Clear all read notifications?')">
                        @csrf
                        <button type="submit"
                            class="px-3.5 py-2 rounded-xl text-xs font-semibold bg-white/5 hover:bg-rose-500/20 text-slate-400 hover:text-rose-300 border border-white/10 hover:border-rose-500/30 flex items-center gap-2 transition-all cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span>Clear Read</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- 1. Top Small Cards (4 in a Row) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card 1: Total Notifications -->
            <a href="{{ route('admin.notifications.index', ['status' => 'all'] + request()->except('status', 'filter', 'page')) }}"
                class="p-4 rounded-2xl bg-[#09101d] border {{ $status === 'all' || !$status ? 'border-indigo-500/60 shadow-lg shadow-indigo-500/10 bg-gradient-to-br from-[#09101d] to-indigo-950/20' : 'border-white/10 hover:border-white/20' }} transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-[11px] font-mono text-slate-400 uppercase tracking-wider block">Total
                        Notifications</span>
                    <div class="text-2xl font-black font-mono text-white">{{ $totalCount }}</div>
                    <span class="text-[10px] font-mono text-slate-500">All activity records</span>
                </div>
                <div
                    class="w-11 h-11 rounded-2xl bg-indigo-500/15 border border-indigo-500/30 text-indigo-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-inner">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
            </a>

            <!-- Card 2: Unread Notifications -->
            <a href="{{ route('admin.notifications.index', ['status' => 'unread'] + request()->except('status', 'filter', 'page')) }}"
                class="p-4 rounded-2xl bg-[#09101d] border {{ $status === 'unread' ? 'border-amber-500/60 shadow-lg shadow-amber-500/10 bg-gradient-to-br from-[#09101d] to-amber-950/20' : 'border-white/10 hover:border-white/20' }} transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-[11px] font-mono text-slate-400 uppercase tracking-wider block">Unread</span>
                    <div class="text-2xl font-black font-mono {{ $unreadCount > 0 ? 'text-amber-400' : 'text-slate-300' }}">
                        {{ $unreadCount }}</div>
                    <span
                        class="text-[10px] font-mono {{ $unreadCount > 0 ? 'text-amber-400/90 font-bold' : 'text-slate-500' }}">
                        {{ $unreadCount > 0 ? 'Requires attention' : 'All caught up' }}
                    </span>
                </div>
                <div
                    class="w-11 h-11 rounded-2xl bg-amber-500/15 border border-amber-500/30 text-amber-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-inner">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </a>

            <!-- Card 3: Read Notifications -->
            <a href="{{ route('admin.notifications.index', ['status' => 'read'] + request()->except('status', 'filter', 'page')) }}"
                class="p-4 rounded-2xl bg-[#09101d] border {{ $status === 'read' ? 'border-emerald-500/60 shadow-lg shadow-emerald-500/10 bg-gradient-to-br from-[#09101d] to-emerald-950/20' : 'border-white/10 hover:border-white/20' }} transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-[11px] font-mono text-slate-400 uppercase tracking-wider block">Read / Archived</span>
                    <div class="text-2xl font-black font-mono text-emerald-400">{{ $readCount }}</div>
                    <span class="text-[10px] font-mono text-slate-500">Processed alerts</span>
                </div>
                <div
                    class="w-11 h-11 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-inner">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </a>

            <!-- Card 4: Today's Alerts -->
            <a href="{{ route('admin.notifications.index', ['status' => 'today'] + request()->except('status', 'filter', 'page')) }}"
                class="p-4 rounded-2xl bg-[#09101d] border {{ $status === 'today' ? 'border-cyan-500/60 shadow-lg shadow-cyan-500/10 bg-gradient-to-br from-[#09101d] to-cyan-950/20' : 'border-white/10 hover:border-white/20' }} transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-[11px] font-mono text-slate-400 uppercase tracking-wider block">Today's
                        Activity</span>
                    <div class="text-2xl font-black font-mono text-cyan-400">{{ $todayCount }}</div>
                    <span class="text-[10px] font-mono text-slate-500">Received last 24h</span>
                </div>
                <div
                    class="w-11 h-11 rounded-2xl bg-cyan-500/15 border border-cyan-500/30 text-cyan-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-inner">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </a>
        </div>

        <!-- 2. Separated Filter Card (Top of Datalist Card) -->
        <div class="p-5 sm:p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-white/5">
                <div class="flex items-center gap-2.5">
                    <div
                        class="w-8 h-8 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white tracking-tight">Filter Notifications</h3>
                        <p class="text-[11px] font-mono text-slate-400">Search and narrow results by search term, assigned
                            users, and status</p>
                    </div>
                </div>

                <button type="button" id="resetFiltersBtn" onclick="resetAllFilters()" title="Reset all filters"
                    class="{{ request('search') || (request('status') && request('status') !== 'all') || request('user_id') ? '' : 'hidden' }} text-[11px] font-mono text-indigo-400 hover:text-indigo-300 flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-indigo-500/10 border border-indigo-500/20 transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span>Reset Filters</span>
                </button>
            </div>

            <form id="filterForm" action="{{ route('admin.notifications.index') }}" method="GET"
                onsubmit="event.preventDefault(); triggerFilterUpdate();">
                <!-- Three filters in a row: 1st Searchbox, 2nd Users, 3rd Status -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- 1st: Searchbox -->
                    <div class="space-y-1.5">
                        <label for="notificationSearchInput"
                            class="block text-[11px] font-mono text-slate-400 uppercase tracking-wider">
                            Searchbox
                        </label>
                        <div class="relative">
                            <input type="text" id="notificationSearchInput" name="search"
                                value="{{ request('search') }}" placeholder="Search notifications..." autocomplete="off"
                                class="w-full bg-[#0c1424] border border-white/10 rounded-xl pl-9 pr-8 py-2.5 text-xs text-white placeholder:text-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all font-sans">
                            <svg class="w-4 h-4 text-slate-500 absolute left-3 top-3 pointer-events-none" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <button type="button" id="clearSearchBtn" onclick="clearSearch()" title="Clear search"
                                class="{{ request('search') ? '' : 'hidden' }} absolute right-2.5 top-2.5 text-slate-500 hover:text-white text-base w-5 h-5 flex items-center justify-center cursor-pointer transition-colors">
                                &times;
                            </button>
                        </div>
                    </div>

                    <!-- 2nd: Users -->
                    <div class="space-y-1.5">
                        <label for="userFilter"
                            class="block text-[11px] font-mono text-slate-400 uppercase tracking-wider">
                            Users
                        </label>
                        <div class="relative">
                            @if (auth()->check() && auth()->user()->isAdmin())
                                <select id="userFilter" name="user_id" onchange="triggerFilterUpdate()"
                                    class="w-full bg-[#0c1424] border border-white/10 rounded-xl px-3 py-2.5 text-xs text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 font-sans cursor-pointer transition-all">
                                    <option value="">All Users & System</option>
                                    <option value="system" {{ request('user_id') === 'system' ? 'selected' : '' }}>System
                                        Broadcasts Only</option>
                                    @foreach ($users as $u)
                                        <option value="{{ $u->id }}"
                                            {{ request('user_id') == $u->id ? 'selected' : '' }}>
                                            {{ $u->name }} ({{ $u->role }})
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <select id="userFilter" name="user_id" disabled
                                    class="w-full bg-[#0c1424]/60 border border-white/5 rounded-xl px-3 py-2.5 text-xs text-slate-400 font-sans cursor-not-allowed">
                                    <option value="">{{ auth()->user()->name ?? 'Current User' }} (You)</option>
                                </select>
                            @endif
                        </div>
                    </div>

                    <!-- 3rd: Status -->
                    <div class="space-y-1.5">
                        <label for="statusFilter"
                            class="block text-[11px] font-mono text-slate-400 uppercase tracking-wider">
                            Status
                        </label>
                        <div class="relative">
                            <select id="statusFilter" name="status" onchange="triggerFilterUpdate()"
                                class="w-full bg-[#0c1424] border border-white/10 rounded-xl px-3 py-2.5 text-xs text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 font-sans cursor-pointer transition-all">
                                <option value="all" {{ $status === 'all' || !$status ? 'selected' : '' }}>All Status
                                    ({{ $totalCount }})</option>
                                <option value="unread" {{ $status === 'unread' ? 'selected' : '' }}>Unread
                                    ({{ $unreadCount }})</option>
                                <option value="read" {{ $status === 'read' ? 'selected' : '' }}>Read
                                    ({{ $readCount }})</option>
                                <option value="today" {{ $status === 'today' ? 'selected' : '' }}>Today's Alerts
                                    ({{ $todayCount }})</option>
                                @if (auth()->check() && auth()->user()->isAdmin())
                                    <option value="mine" {{ $status === 'mine' ? 'selected' : '' }}>My Notifications
                                    </option>
                                @endif
                                    <option value="inquiries" {{ $status === 'inquiries' ? 'selected' : '' }}>Inquiries &
                                        Replies</option>
                                    <option value="users" {{ $status === 'users' ? 'selected' : '' }}>Users & Auth
                                    </option>
                                    <option value="project" {{ $status === 'project' ? 'selected' : '' }}>Projects
                                    </option>
                                    <option value="blog" {{ $status === 'blog' ? 'selected' : '' }}>Blog Articles
                                    </option>
                                    <option value="service" {{ $status === 'service' ? 'selected' : '' }}>Services
                                    </option>
                                    <option value="skill" {{ $status === 'skill' ? 'selected' : '' }}>Skills</option>
                                    <option value="resume" {{ $status === 'resume' ? 'selected' : '' }}>Resume Timeline
                                    </option>
                                    <option value="pricing" {{ $status === 'pricing' ? 'selected' : '' }}>Pricing Plans
                                    </option>
                                    <option value="testimonial" {{ $status === 'testimonial' ? 'selected' : '' }}>
                                        Testimonials</option>
                                    <option value="faq" {{ $status === 'faq' ? 'selected' : '' }}>FAQs</option>
                                    <option value="content" {{ $status === 'content' ? 'selected' : '' }}>Website Content
                                    </option>
                                    <option value="system" {{ $status === 'system' ? 'selected' : '' }}>Settings &
                                        Maintenance</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- 3. Datalist Card -->
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
                        <h2 class="text-base font-bold text-white tracking-tight">Notifications List</h2>
                        <span id="datalistCountBadge"
                            class="px-2.5 py-0.5 rounded-full text-xs font-mono font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                            {{ $notifications->total() }} {{ Str::plural('result', $notifications->total()) }}
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
                            <select id="perPageFilter" name="per_page" onchange="triggerFilterUpdate()"
                                class="no-select2 appearance-none bg-transparent hover:bg-white/5 focus:bg-white/10 text-xs font-semibold text-white cursor-pointer pr-6 pl-2 py-0.5 rounded-lg border border-transparent focus:border-indigo-500/40 focus:outline-none transition-all">
                                <option value="10" class="bg-[#0c1424] text-slate-200" {{ $perPage == 10 ? 'selected' : '' }}>10 / page</option>
                                <option value="20" class="bg-[#0c1424] text-slate-200" {{ $perPage == 20 ? 'selected' : '' }}>20 / page</option>
                                <option value="50" class="bg-[#0c1424] text-slate-200" {{ $perPage == 50 ? 'selected' : '' }}>50 / page</option>
                                <option value="100" class="bg-[#0c1424] text-slate-200" {{ $perPage == 100 ? 'selected' : '' }}>100 / page</option>
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

            <!-- Bulk Action Form Container -->
            <form id="bulkActionForm" action="{{ route('admin.notifications.bulk') }}" method="POST"
                class="py-2.5 px-3.5 rounded-xl bg-white/[0.02] border border-white/5 flex items-center justify-between gap-3 text-xs">
                @csrf
                <div class="flex items-center gap-3">
                    <label class="flex items-center gap-2 cursor-pointer select-none text-slate-400 hover:text-white">
                        <input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)"
                            class="rounded bg-[#0c1424] border-white/20 text-indigo-600 focus:ring-0 w-3.5 h-3.5 cursor-pointer">
                        <span class="font-medium text-xs">Select All</span>
                    </label>
                    <span id="selectedCountBadge"
                        class="hidden px-2 py-0.5 rounded-full bg-indigo-500/20 text-indigo-300 font-mono text-[10px]">
                        0 selected
                    </span>
                </div>

                <!-- Action buttons: DEFAULT HIDDEN! Shown only when Select All or items are checked! -->
                <div id="bulkActionButtons" class="hidden flex items-center gap-2 transition-all">
                    <button type="submit" name="action" value="mark_read"
                        class="px-3 py-1.5 rounded-lg bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white transition-colors cursor-pointer flex items-center gap-1.5 font-medium">
                        <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Mark Read</span>
                    </button>
                    <button type="submit" name="action" value="mark_unread"
                        class="px-3 py-1.5 rounded-lg bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white transition-colors cursor-pointer flex items-center gap-1.5 font-medium">
                        <svg class="w-3.5 h-3.5 text-amber-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Mark Unread</span>
                    </button>
                    <button type="submit" name="action" value="delete"
                        onclick="return confirm('Delete selected notifications?')"
                        class="px-3 py-1.5 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 hover:text-rose-200 transition-colors cursor-pointer flex items-center gap-1.5 font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span>Delete</span>
                    </button>
                </div>
            </form>

            <!-- Notification Cards List -->
            <div id="notificationsListContainer" class="space-y-2.5 transition-opacity duration-200">
                @forelse($notifications as $item)
                    @php
                        $colorClasses = match ($item->color) {
                            'emerald' => 'bg-emerald-500/15 text-emerald-400 border-emerald-500/20',
                            'rose' => 'bg-rose-500/15 text-rose-400 border-rose-500/20',
                            'amber' => 'bg-amber-500/15 text-amber-400 border-amber-500/20',
                            'cyan' => 'bg-cyan-500/15 text-cyan-400 border-cyan-500/20',
                            'purple' => 'bg-purple-500/15 text-purple-400 border-purple-500/20',
                            'blue' => 'bg-blue-500/15 text-blue-400 border-blue-500/20',
                            default => 'bg-indigo-500/15 text-indigo-400 border-indigo-500/20',
                        };
                    @endphp

                    <div id="notification-card-{{ $item->id }}"
                        class="p-4 rounded-2xl border transition-all flex items-start justify-between gap-4 relative {{ $item->is_read ? 'bg-[#09101d]/60 border-white/5 opacity-80' : 'bg-[#0d1627] border-indigo-500/30 shadow-lg shadow-indigo-600/5' }}">
                        <div class="flex items-start gap-3.5 flex-1 min-w-0">
                            <!-- Bulk Checkbox -->
                            <div class="pt-1">
                                <input type="checkbox" name="ids[]" value="{{ $item->id }}" form="bulkActionForm"
                                    onchange="updateSelectedCount()"
                                    class="item-checkbox rounded bg-[#0c1424] border-white/20 text-indigo-600 focus:ring-0 w-3.5 h-3.5 cursor-pointer">
                            </div>

                            <!-- Type Icon Badge -->
                            <div
                                class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 border {{ $colorClasses }}">
                                @if ($item->icon === 'mail')
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                @elseif($item->icon === 'send')
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                @elseif($item->icon === 'user')
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                @elseif($item->icon === 'folder')
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                    </svg>
                                @elseif($item->icon === 'book')
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                @elseif($item->icon === 'check')
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                @elseif($item->icon === 'settings')
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                @elseif($item->icon === 'server')
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                                    </svg>
                                @elseif($item->icon === 'globe')
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                @else
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                @endif
                            </div>

                            <!-- Details Content -->
                            <div class="space-y-1 flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="font-bold text-sm text-white">{{ $item->title }}</span>

                                    @if (!$item->is_read)
                                        <span class="w-2 h-2 rounded-full bg-indigo-400 animate-ping"></span>
                                        <span
                                            class="px-1.5 py-0.2 rounded text-[9px] font-mono font-bold bg-indigo-500/20 text-indigo-300">NEW</span>
                                    @endif

                                    <!-- User identification badge for admin view -->
                                    @if (auth()->check() && auth()->user()->isAdmin())
                                        @if ($item->user)
                                            <span
                                                class="px-2 py-0.5 rounded-full text-[10px] font-mono bg-white/5 border border-white/10 text-slate-300 flex items-center gap-1">
                                                <svg class="w-2.5 h-2.5 text-cyan-400" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>{{ $item->user->name }} ({{ $item->user->role }})</span>
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-0.5 rounded-full text-[10px] font-mono bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                                                System Broadcast
                                            </span>
                                        @endif
                                    @endif
                                </div>

                                <p class="text-xs text-slate-300 line-clamp-2 leading-relaxed">
                                    {{ $item->message }}
                                </p>

                                <div class="flex items-center gap-3 text-[11px] font-mono text-slate-500 pt-1">
                                    <span>{{ $item->created_at->diffForHumans() }}</span>
                                    <span>•</span>
                                    <span>{{ $item->created_at->format('M d, Y h:i A') }}</span>
                                    @if ($item->action_url)
                                        <span>•</span>
                                        <a href="{{ route('admin.notifications.show', $item) }}"
                                            class="text-indigo-400 hover:text-indigo-300 hover:underline flex items-center gap-1 font-sans">
                                            <span>Open related page</span> &rarr;
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Actions Dropdown Menu (3-dots kebab button) -->
                        <div class="relative shrink-0" id="notification-dropdown-wrapper-{{ $item->id }}">
                            <button type="button"
                                id="notification-actions-btn-{{ $item->id }}"
                                onclick="toggleNotificationActionsDropdown(event, {{ $item->id }})"
                                class="w-9 h-9 rounded-xl bg-white/5 hover:bg-white/10 active:bg-white/15 border border-white/5 hover:border-white/15 flex items-center justify-center text-slate-400 hover:text-white transition-all cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                                title="Actions"
                                aria-label="Notification actions">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="5" r="1.75" />
                                    <circle cx="12" cy="12" r="1.75" />
                                    <circle cx="12" cy="19" r="1.75" />
                                </svg>
                            </button>

                            <!-- Floating Dropdown Popover Menu -->
                            <div id="notification-actions-menu-{{ $item->id }}"
                                class="notification-dropdown-menu hidden absolute right-0 mt-2 w-52 rounded-2xl bg-[#0d1627] border border-white/10 shadow-2xl shadow-black/80 py-1.5 z-50 backdrop-blur-xl">
                                
                                <div class="px-3.5 py-2 border-b border-white/5">
                                    <p class="text-[10px] font-mono uppercase tracking-wider text-slate-400">Notification</p>
                                    <p class="text-xs font-semibold text-white truncate">{{ $item->title }}</p>
                                </div>

                                <div class="py-1">
                                    <!-- View Modal Trigger -->
                                    <button type="button"
                                        onclick="closeAllNotificationDropdowns(); openViewModal({{ json_encode($item) }})"
                                        class="w-[calc(100%-8px)] group flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-slate-300 hover:text-white hover:bg-white/5 rounded-xl mx-1 transition-colors text-left cursor-pointer">
                                        <svg class="w-4 h-4 text-slate-400 group-hover:text-cyan-400 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>View Details</span>
                                    </button>

                                    <!-- Toggle Read / Unread -->
                                    <form action="{{ route('admin.notifications.toggleRead', $item) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-[calc(100%-8px)] group flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-slate-300 hover:text-white hover:bg-white/5 rounded-xl mx-1 transition-colors text-left cursor-pointer">
                                            @if ($item->is_read)
                                                <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-400 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5" />
                                                </svg>
                                                <span>Mark as Unread</span>
                                            @else
                                                <svg class="w-4 h-4 text-emerald-400 group-hover:text-emerald-300 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Mark as Read</span>
                                            @endif
                                        </button>
                                    </form>

                                    @if ($item->action_url)
                                        <a href="{{ route('admin.notifications.show', $item) }}"
                                            class="group flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-slate-300 hover:text-white hover:bg-white/5 rounded-xl mx-1 transition-colors">
                                            <svg class="w-4 h-4 text-indigo-400 group-hover:text-indigo-300 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                            <span>Open Related Page</span>
                                        </a>
                                    @endif
                                </div>

                                <div class="py-1 border-t border-white/5">
                                    <!-- Delete Single Notification -->
                                    <form action="{{ route('admin.notifications.destroy', $item) }}" method="POST"
                                        onsubmit="return confirm('Delete this notification?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-[calc(100%-8px)] group flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-rose-400 hover:text-rose-200 hover:bg-rose-500/15 rounded-xl mx-1 transition-colors text-left cursor-pointer">
                                            <svg class="w-4 h-4 text-rose-400 group-hover:text-rose-300 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <span>Delete Notification</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-16 text-center rounded-3xl bg-[#09101d] border border-white/10 space-y-3">
                        <div
                            class="w-16 h-16 rounded-full bg-white/5 border border-white/10 mx-auto flex items-center justify-center text-slate-500">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-white">No notifications found</h3>
                        <p class="text-xs text-slate-400 font-mono max-w-sm mx-auto">
                            You're all caught up! When actions or events happen across the application, they will appear
                            here in real-time.
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- Bottom Stats & Pagination (Datalist Card Footer) -->
            <div
                class="pt-5 mt-4 grid grid-cols-1 border-t border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div id="showingCountContainer" class="flex flex-wrap items-center justify-center gap-2.5">
                    @if ($notifications->total() > 0)
                        <!-- Primary Range Badge -->
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-white/[0.03] border border-white/10 text-xs font-mono text-slate-300 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                            <span class="text-slate-400">Showing</span>
                            <span
                                class="px-2 py-0.5 rounded-lg bg-indigo-500/20 text-indigo-300 font-bold border border-indigo-500/30">
                                {{ $notifications->firstItem() }}&ndash;{{ $notifications->lastItem() }}
                            </span>
                            <span class="text-slate-400">of</span>
                            <span class="text-white font-extrabold">{{ $notifications->total() }}</span>
                            <span class="text-slate-400">items</span>
                        </div>

                        <!-- Secondary Page Position & Database Context -->
                        <div
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-black/40 border border-white/5 text-[11px] font-mono text-slate-400">
                            <span>Page <strong class="text-white">{{ $notifications->currentPage() }}</strong> of <strong
                                    class="text-white">{{ $notifications->lastPage() }}</strong></span>
                            <span class="text-slate-600">&bull;</span>
                            <span class="text-slate-400">{{ $notifications->count() }} on page</span>
                            <span class="text-slate-600">&bull;</span>
                            <span class="text-slate-500">Total: {{ $totalCount }}</span>
                        </div>
                    @else
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-white/[0.03] border border-white/10 text-xs font-mono text-slate-400">
                            <span class="w-2 h-2 rounded-full bg-slate-600"></span>
                            <span>Showing <strong>0</strong> items</span>
                        </div>
                    @endif
                </div>

                <!-- Bottom Right: Pro Pagination Controls -->
                <div id="paginationContainer" class="flex items-center justify-center">
                    {{ $notifications->links('admin.components.pagination') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div id="notificationDetailsModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
        <div class="w-full max-w-md rounded-3xl bg-[#0d1627] border border-white/10 shadow-2xl p-6 space-y-4">
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div id="modal_icon_container"
                        class="w-10 h-10 rounded-2xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center border border-indigo-500/30">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <div>
                        <h3 id="modal_title" class="text-base font-bold text-white"></h3>
                        <span id="modal_type_badge"
                            class="px-2 py-0.5 rounded text-[10px] font-mono uppercase font-bold bg-white/10 text-slate-300"></span>
                    </div>
                </div>
                <button type="button" onclick="closeViewModal()"
                    class="text-slate-400 hover:text-white text-lg cursor-pointer">&times;</button>
            </div>

            <div class="space-y-2">
                <div class="p-4 rounded-2xl bg-black/40 border border-white/5 text-xs text-slate-200 leading-relaxed whitespace-pre-wrap font-sans"
                    id="modal_message"></div>

                <div class="text-[11px] font-mono text-slate-400 space-y-1 pt-1">
                    <div class="flex items-center justify-between">
                        <span>Timestamp:</span>
                        <span id="modal_timestamp" class="text-white"></span>
                    </div>
                    <div id="modal_user_row" class="hidden flex items-center justify-between">
                        <span>Associated User:</span>
                        <span id="modal_user" class="text-cyan-400"></span>
                    </div>
                </div>
            </div>

            <div class="pt-2 flex items-center justify-end gap-2 border-t border-white/10">
                <button type="button" onclick="closeViewModal()"
                    class="px-4 py-2 rounded-xl text-xs font-semibold bg-white/5 hover:bg-white/10 text-slate-300 cursor-pointer">
                    Close
                </button>
                <a id="modal_action_btn" href="#"
                    class="hidden px-4 py-2 rounded-xl text-xs font-semibold bg-indigo-600 hover:bg-indigo-500 text-white flex items-center gap-1.5 shadow-lg shadow-indigo-600/30">
                    <span>Go to Resource</span> &rarr;
                </a>
            </div>
        </div>
    </div>

    <script>
        // ----------------------------------------------------
        // Select All & Bulk Action Buttons Visibility Control
        // ----------------------------------------------------
        function toggleSelectAll(master) {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            checkboxes.forEach(cb => cb.checked = master.checked);
            updateSelectedCount();
        }

        function updateSelectedCount() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const checked = document.querySelectorAll('.item-checkbox:checked').length;
            const total = checkboxes.length;
            const master = document.getElementById('selectAllCheckbox');
            const badge = document.getElementById('selectedCountBadge');
            const bulkButtons = document.getElementById('bulkActionButtons');

            // Sync master checkbox state
            if (master && total > 0) {
                master.checked = (checked === total);
                master.indeterminate = (checked > 0 && checked < total);
            }

            // Show/hide count badge
            if (checked > 0) {
                badge.textContent = `${checked} selected`;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }

            // Show bulk buttons only when select all or checkboxes are selected; default hide
            if (bulkButtons) {
                if (checked > 0) {
                    bulkButtons.classList.remove('hidden');
                } else {
                    bulkButtons.classList.add('hidden');
                }
            }
        }

        // ----------------------------------------------------
        // Live Search (Keyup) & Dynamic Filter Updating
        // ----------------------------------------------------
        let searchDebounceTimer = null;
        const searchInput = document.getElementById('notificationSearchInput');

        if (searchInput) {
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchDebounceTimer);
                    triggerFilterUpdate();
                    return;
                }
                clearTimeout(searchDebounceTimer);
                searchDebounceTimer = setTimeout(() => {
                    triggerFilterUpdate();
                }, 300);
            });

            searchInput.addEventListener('input', function() {
                const clearBtn = document.getElementById('clearSearchBtn');
                if (this.value.trim().length > 0) {
                    clearBtn?.classList.remove('hidden');
                } else {
                    clearBtn?.classList.add('hidden');
                }
            });
        }

        function clearSearch() {
            if (searchInput) {
                searchInput.value = '';
                document.getElementById('clearSearchBtn')?.classList.add('hidden');
                triggerFilterUpdate();
            }
        }

        function resetAllFilters() {
            if (searchInput) {
                searchInput.value = '';
                document.getElementById('clearSearchBtn')?.classList.add('hidden');
            }
            const statusSelect = document.getElementById('statusFilter');
            if (statusSelect) statusSelect.value = 'all';
            const userSelect = document.getElementById('userFilter');
            if (userSelect && !userSelect.disabled) userSelect.value = '';
            triggerFilterUpdate();
        }

        function triggerFilterUpdate(page = 1) {
            const search = document.getElementById('notificationSearchInput') ? document.getElementById(
                'notificationSearchInput').value.trim() : '';
            const status = document.getElementById('statusFilter') ? document.getElementById('statusFilter').value : 'all';
            const userSelect = document.getElementById('userFilter');
            const userId = userSelect ? userSelect.value : '';
            const perPage = document.getElementById('perPageFilter') ? document.getElementById('perPageFilter').value :
                '20';

            const params = new URLSearchParams();
            if (search) params.set('search', search);
            if (status && status !== 'all') params.set('status', status);
            if (userId) params.set('user_id', userId);
            if (perPage && perPage !== '20') params.set('per_page', perPage);
            if (page > 1) params.set('page', page);

            const newUrl = `${window.location.pathname}${params.toString() ? '?' + params.toString() : ''}`;
            window.history.pushState({
                path: newUrl
            }, '', newUrl);

            // Toggle Reset Filters button visibility
            const resetBtn = document.getElementById('resetFiltersBtn');
            if (resetBtn) {
                const hasFilters = Boolean(search || (status && status !== 'all') || userId);
                if (hasFilters) {
                    resetBtn.classList.remove('hidden');
                } else {
                    resetBtn.classList.add('hidden');
                }
            }

            // Subtle loading indicator
            const listContainer = document.getElementById('notificationsListContainer');
            if (listContainer) {
                listContainer.style.opacity = '0.5';
            }

            fetch(newUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    // Swap notification cards
                    const newList = doc.getElementById('notificationsListContainer');
                    if (newList && listContainer) {
                        listContainer.innerHTML = newList.innerHTML;
                        listContainer.style.opacity = '1';
                    }

                    // Swap datalist title count badge
                    const newCountBadge = doc.getElementById('datalistCountBadge');
                    const countBadge = document.getElementById('datalistCountBadge');
                    if (newCountBadge && countBadge) {
                        countBadge.innerHTML = newCountBadge.innerHTML;
                    }

                    // Swap bottom counter
                    const newCount = doc.getElementById('showingCountContainer');
                    const countContainer = document.getElementById('showingCountContainer');
                    if (newCount && countContainer) {
                        countContainer.innerHTML = newCount.innerHTML;
                    }

                    // Swap pagination
                    const newPagination = doc.getElementById('paginationContainer');
                    const paginationContainer = document.getElementById('paginationContainer');
                    if (newPagination && paginationContainer) {
                        paginationContainer.innerHTML = newPagination.innerHTML;
                        attachPaginationListeners();
                    }

                    // Reset bulk actions state
                    const master = document.getElementById('selectAllCheckbox');
                    if (master) master.checked = false;
                    updateSelectedCount();
                })
                .catch(err => {
                    console.error('Filter update error:', err);
                    if (listContainer) listContainer.style.opacity = '1';
                });
        }

        function attachPaginationListeners() {
            const links = document.querySelectorAll('#paginationContainer a');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    try {
                        const url = new URL(this.href);
                        const page = url.searchParams.get('page') || 1;
                        triggerFilterUpdate(page);
                    } catch (e) {
                        window.location.href = this.href;
                    }
                });
            });
        }

        // Initialize pagination ajax hooks on load
        document.addEventListener('DOMContentLoaded', function() {
            attachPaginationListeners();
            updateSelectedCount();
        });

        window.addEventListener('popstate', function() {
            window.location.reload();
        });

        // ----------------------------------------------------
        // Dropdown Actions Menu Handlers
        // ----------------------------------------------------
        function toggleNotificationActionsDropdown(event, itemId) {
            if (event) {
                event.stopPropagation();
            }
            const menu = document.getElementById(`notification-actions-menu-${itemId}`);
            const card = document.getElementById(`notification-card-${itemId}`);
            if (!menu) return;

            const isCurrentlyOpen = !menu.classList.contains('hidden');

            closeAllNotificationDropdowns();

            if (!isCurrentlyOpen) {
                menu.classList.remove('hidden');
                if (card) {
                    card.classList.add('z-30');
                }
            }
        }

        function closeAllNotificationDropdowns() {
            document.querySelectorAll('.notification-dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
            document.querySelectorAll('[id^="notification-card-"]').forEach(card => {
                card.classList.remove('z-30');
            });
        }

        // Close on outside click
        document.addEventListener('click', function(e) {
            if (!e.target.closest('[id^="notification-dropdown-wrapper-"]')) {
                closeAllNotificationDropdowns();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAllNotificationDropdowns();
            }
        });

        // ----------------------------------------------------
        // Details Modal Logic
        // ----------------------------------------------------
        function openViewModal(item) {
            document.getElementById('modal_title').textContent = item.title;
            document.getElementById('modal_type_badge').textContent = item.type;
            document.getElementById('modal_message').textContent = item.message;
            document.getElementById('modal_timestamp').textContent = item.created_at;

            const actionBtn = document.getElementById('modal_action_btn');
            if (item.action_url) {
                actionBtn.href = item.action_url;
                actionBtn.classList.remove('hidden');
            } else {
                actionBtn.classList.add('hidden');
            }

            const userRow = document.getElementById('modal_user_row');
            if (item.user) {
                document.getElementById('modal_user').textContent = `${item.user.name} (${item.user.email})`;
                userRow.classList.remove('hidden');
            } else {
                userRow.classList.add('hidden');
            }

            document.getElementById('notificationDetailsModal').classList.remove('hidden');

            // Mark as read in background if unread
            if (!item.is_read) {
                fetch(`/admin/notifications/${item.id}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(() => {
                    if (typeof checkLiveNotifications === 'function') checkLiveNotifications();
                });
            }
        }

        function closeViewModal() {
            document.getElementById('notificationDetailsModal').classList.add('hidden');
        }
    </script>
@endsection
