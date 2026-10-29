@extends('admin.layout')

@section('title', 'User Management')
@section('page_title', 'Users & Permissions')
@section('page_subtitle', 'System Accounts')

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
        <!-- 1. Header with Global Actions -->
        <div
            class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl">
            <div class="space-y-1">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-2xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center border border-indigo-500/30 shadow-inner">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-black text-white tracking-tight flex items-center gap-2">
                            <span>User Management</span>
                            <span
                                class="px-2.5 py-0.5 rounded-full text-xs font-mono font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                                {{ $totalUsers }} {{ Str::plural('Account', $totalUsers) }}
                            </span>
                        </h1>
                        <p class="text-xs text-slate-400 font-mono">
                            Manage administrative privileges, client portal accounts, and security access
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2.5 flex-wrap">
                <a href="{{ route('admin.users.create') }}"
                    class="theme-aware-create-btn inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white shadow-lg shadow-indigo-600/30 transition-all cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Add New User</span>
                </a>
            </div>
        </div>

        <!-- 2. Top Summary Metrics Cards (4 in a Row) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card 1: Total Users -->
            <a href="{{ route('admin.users.index', ['role' => 'all'] + request()->except('role', 'page')) }}"
                class="p-4 rounded-2xl bg-[#09101d] border {{ $role === 'all' || !$role ? 'border-indigo-500/60 shadow-lg shadow-indigo-500/10 bg-gradient-to-br from-[#09101d] to-indigo-950/20' : 'border-white/10 hover:border-white/20' }} transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-[11px] font-mono text-slate-400 uppercase tracking-wider block">Total Accounts</span>
                    <div class="text-2xl font-black font-mono text-white">{{ $totalUsers }}</div>
                    <span class="text-[10px] font-mono text-slate-500">All registered users</span>
                </div>
                <div
                    class="w-11 h-11 rounded-2xl bg-indigo-500/15 border border-indigo-500/30 text-indigo-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-inner">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </a>

            <!-- Card 2: Administrators -->
            <a href="{{ route('admin.users.index', ['role' => 'admin'] + request()->except('role', 'page')) }}"
                class="p-4 rounded-2xl bg-[#09101d] border {{ $role === 'admin' ? 'border-amber-500/60 shadow-lg shadow-amber-500/10 bg-gradient-to-br from-[#09101d] to-amber-950/20' : 'border-white/10 hover:border-white/20' }} transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-[11px] font-mono text-slate-400 uppercase tracking-wider block">Administrators</span>
                    <div class="text-2xl font-black font-mono text-amber-400">{{ $adminCount }}</div>
                    <span class="text-[10px] font-mono text-slate-500">Full system access</span>
                </div>
                <div
                    class="w-11 h-11 rounded-2xl bg-amber-500/15 border border-amber-500/30 text-amber-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-inner">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </a>

            <!-- Card 3: Standard Users -->
            <a href="{{ route('admin.users.index', ['role' => 'user'] + request()->except('role', 'page')) }}"
                class="p-4 rounded-2xl bg-[#09101d] border {{ $role === 'user' ? 'border-cyan-500/60 shadow-lg shadow-cyan-500/10 bg-gradient-to-br from-[#09101d] to-cyan-950/20' : 'border-white/10 hover:border-white/20' }} transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-[11px] font-mono text-slate-400 uppercase tracking-wider block">Standard Users</span>
                    <div class="text-2xl font-black font-mono text-cyan-400">{{ $regularCount }}</div>
                    <span class="text-[10px] font-mono text-slate-500">Client portal accounts</span>
                </div>
                <div
                    class="w-11 h-11 rounded-2xl bg-cyan-500/15 border border-cyan-500/30 text-cyan-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-inner">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </a>

            <!-- Card 4: Recent Users (Last 30 Days) -->
            <a href="{{ route('admin.users.index', ['role' => 'recent'] + request()->except('role', 'page')) }}"
                class="p-4 rounded-2xl bg-[#09101d] border {{ $role === 'recent' ? 'border-emerald-500/60 shadow-lg shadow-emerald-500/10 bg-gradient-to-br from-[#09101d] to-emerald-950/20' : 'border-white/10 hover:border-white/20' }} transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-[11px] font-mono text-slate-400 uppercase tracking-wider block">Recent Accounts</span>
                    <div class="text-2xl font-black font-mono text-emerald-400">{{ $recentCount }}</div>
                    <span class="text-[10px] font-mono text-slate-500">Joined last 30 days</span>
                </div>
                <div
                    class="w-11 h-11 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-inner">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </a>
        </div>

        <!-- 3. Separated Filter Card (Top of Datalist Card) -->
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
                        <h3 class="text-sm font-bold text-white tracking-tight">Filter Users</h3>
                        <p class="text-[11px] font-mono text-slate-400">Search and narrow accounts by keyword, role, or
                            registration date</p>
                    </div>
                </div>

                <button type="button" id="resetFiltersBtn" onclick="resetAllFilters()" title="Reset all filters"
                    class="{{ request('search') || (request('role') && request('role') !== 'all') || (request('sort') && request('sort') !== 'latest') ? '' : 'hidden' }} text-[11px] font-mono text-indigo-400 hover:text-indigo-300 flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-indigo-500/10 border border-indigo-500/20 transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span>Reset Filters</span>
                </button>
            </div>

            <form id="filterForm" action="{{ route('admin.users.index') }}" method="GET"
                onsubmit="event.preventDefault(); triggerFilterUpdate();">
                <!-- Three filters in a row: 1st Searchbox, 2nd Role, 3rd Sort By -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- 1st: Searchbox -->
                    <div class="space-y-1.5">
                        <label for="userSearchInput"
                            class="block text-[11px] font-mono text-slate-400 uppercase tracking-wider">
                            Searchbox
                        </label>
                        <div class="relative">
                            <input type="text" id="userSearchInput" name="search" value="{{ request('search') }}"
                                placeholder="Search name, email, phone, location..." autocomplete="off"
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

                    <!-- 2nd: Role -->
                    <div class="space-y-1.5">
                        <label for="roleFilter"
                            class="block text-[11px] font-mono text-slate-400 uppercase tracking-wider">
                            Role
                        </label>
                        <div class="relative">
                            <select id="roleFilter" name="role" onchange="triggerFilterUpdate()"
                                class="w-full bg-[#0c1424] border border-white/10 rounded-xl px-3 py-2.5 text-xs text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 font-sans cursor-pointer transition-all">
                                <option value="all" {{ $role === 'all' || !$role ? 'selected' : '' }}>All Roles
                                    ({{ $totalUsers }})</option>
                                <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Administrator
                                    ({{ $adminCount }})</option>
                                <option value="user" {{ $role === 'user' ? 'selected' : '' }}>Standard User
                                    ({{ $regularCount }})</option>
                                <option value="recent" {{ $role === 'recent' ? 'selected' : '' }}>Joined Last 30 Days
                                    ({{ $recentCount }})</option>
                            </select>
                        </div>
                    </div>

                    <!-- 3rd: Sort By -->
                    <div class="space-y-1.5">
                        <label for="sortFilter"
                            class="block text-[11px] font-mono text-slate-400 uppercase tracking-wider">
                            Sort Order
                        </label>
                        <div class="relative">
                            <select id="sortFilter" name="sort" onchange="triggerFilterUpdate()"
                                class="w-full bg-[#0c1424] border border-white/10 rounded-xl px-3 py-2.5 text-xs text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 font-sans cursor-pointer transition-all">
                                <option value="latest" {{ $sort === 'latest' || !$sort ? 'selected' : '' }}>Newest
                                    Registered First</option>
                                <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oldest Registered First
                                </option>
                                <option value="name_asc" {{ $sort === 'name_asc' ? 'selected' : '' }}>Name (A to Z)
                                </option>
                                <option value="name_desc" {{ $sort === 'name_desc' ? 'selected' : '' }}>Name (Z to A)
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- 4. Datalist Card (Card-Row List Layout matching Notifications) -->
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
                        <h2 class="text-base font-bold text-white tracking-tight">Registered Users</h2>
                        <span id="datalistCountBadge"
                            class="px-2.5 py-0.5 rounded-full text-xs font-mono font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                            {{ $users->total() }} {{ Str::plural('result', $users->total()) }}
                        </span>
                    </div>
                </div>

                <!-- Top Right: Enhanced Per Page capsule -->
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
                                <option value="5" class="bg-[#0c1424] text-slate-200"
                                    {{ $perPage == 5 ? 'selected' : '' }}>5 / page</option>
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

            <!-- Select All Container -->
            <div
                class="py-2.5 px-3.5 rounded-xl bg-white/[0.02] border border-white/5 flex items-center justify-between gap-3 text-xs">
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
            </div>

            <!-- Card-Row List Container -->
            <div id="usersListContainer" class="space-y-3 transition-opacity duration-200">
                @forelse ($users as $user)
                    <div id="user-card-{{ $user->id }}"
                        class="p-4 sm:p-5 rounded-2xl bg-white/[0.02] hover:bg-white/[0.04] border border-white/5 hover:border-white/10 transition-all flex flex-col md:flex-row md:items-center justify-between gap-4 group relative">
                        <!-- Left: Checkbox + Avatar + User Details -->
                        <div class="flex items-start md:items-center gap-3 sm:gap-4 flex-1 min-w-0">
                            <!-- Checkbox -->
                            <label class="cursor-pointer shrink-0 mt-1 md:mt-0">
                                <input type="checkbox" name="selected_users[]" value="{{ $user->id }}"
                                    onchange="updateSelectedCount()"
                                    class="user-select-checkbox rounded bg-[#0c1424] border-white/20 text-indigo-600 focus:ring-0 w-3.5 h-3.5 cursor-pointer">
                            </label>

                            <!-- Avatar / Icon Container -->
                            <div
                                class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 border {{ $user->isAdmin() ? 'border-indigo-500/30 bg-indigo-500/10 text-indigo-400' : 'border-cyan-500/20 bg-cyan-500/10 text-cyan-400' }} shadow-inner overflow-hidden">
                                @if (!empty($user->avatar))
                                    <img src="{{ str_starts_with($user->avatar, 'http') ? $user->avatar : asset($user->avatar) }}"
                                        alt="{{ $user->name }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                @endif
                            </div>

                            <!-- User Info -->
                            <div class="space-y-1 flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <a href="{{ route('admin.users.show', $user) }}"
                                        class="font-bold text-sm text-white hover:text-indigo-400 transition-colors">
                                        {{ $user->name }}
                                    </a>

                                    @if ($user->id === auth()->id())
                                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                                        <span
                                            class="px-1.5 py-0.2 rounded text-[9px] font-mono font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                            YOU
                                        </span>
                                    @endif

                                    <!-- Role Badge matching Notification card-row style -->
                                    @if ($user->isAdmin())
                                        <span
                                            class="px-2 py-0.5 rounded-full text-[10px] font-mono bg-white/5 border border-white/10 text-indigo-300 flex items-center gap-1">
                                            <svg class="w-2.5 h-2.5 text-indigo-400" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>Admin</span>
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-0.5 rounded-full text-[10px] font-mono bg-white/5 border border-white/10 text-slate-300 flex items-center gap-1">
                                            <svg class="w-2.5 h-2.5 text-cyan-400" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>User</span>
                                        </span>
                                    @endif
                                </div>

                                <!-- Contact Info / Details Line -->
                                <p
                                    class="text-xs text-slate-300 line-clamp-1 leading-relaxed flex items-center gap-2 flex-wrap">
                                    <span class="font-mono text-slate-300">{{ $user->email }}</span>
                                    @if ($user->phone)
                                        <span class="text-slate-600">&bull;</span>
                                        <span class="font-mono text-slate-400">{{ $user->phone }}</span>
                                    @endif
                                    @if ($user->location)
                                        <span class="text-slate-600">&bull;</span>
                                        <span class="text-slate-400">{{ $user->location }}</span>
                                    @endif
                                </p>

                                <!-- Telemetry Footer -->
                                <div class="flex items-center gap-3 text-[11px] font-mono text-slate-500 pt-1">
                                    <span>Joined {{ $user->created_at->diffForHumans() }}</span>
                                    <span>•</span>
                                    <span>{{ $user->created_at->format('M d, Y h:i A') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Actions Dropdown Menu (3-dots kebab button) -->
                        <div class="relative shrink-0 self-end md:self-auto" id="user-dropdown-wrapper-{{ $user->id }}">
                            <button type="button"
                                id="user-actions-btn-{{ $user->id }}"
                                onclick="toggleUserActionsDropdown(event, {{ $user->id }})"
                                class="w-9 h-9 rounded-xl bg-white/5 hover:bg-white/10 active:bg-white/15 border border-white/5 hover:border-white/15 flex items-center justify-center text-slate-400 hover:text-white transition-all cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                                title="Actions"
                                aria-label="User actions">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="5" r="1.75" />
                                    <circle cx="12" cy="12" r="1.75" />
                                    <circle cx="12" cy="19" r="1.75" />
                                </svg>
                            </button>

                            <!-- Floating Dropdown Popover Menu -->
                            <div id="user-actions-menu-{{ $user->id }}"
                                class="user-dropdown-menu hidden absolute right-0 mt-2 w-52 rounded-2xl bg-[#0d1627] border border-white/10 shadow-2xl shadow-black/80 py-1.5 z-50 backdrop-blur-xl">
                                
                                <div class="px-3.5 py-2 border-b border-white/5">
                                    <p class="text-[10px] font-mono uppercase tracking-wider text-slate-400">User Actions</p>
                                    <p class="text-xs font-semibold text-white truncate">{{ $user->name }}</p>
                                </div>

                                <div class="py-1">
                                    <!-- View Profile -->
                                    <a href="{{ route('admin.users.show', $user) }}"
                                        class="group flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-slate-300 hover:text-white hover:bg-white/5 rounded-xl mx-1 transition-colors">
                                        <svg class="w-4 h-4 text-slate-400 group-hover:text-cyan-400 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>View Profile</span>
                                    </a>

                                    <!-- Edit User -->
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="group flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-slate-300 hover:text-white hover:bg-white/5 rounded-xl mx-1 transition-colors">
                                        <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-400 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span>Edit User</span>
                                    </a>

                                    <!-- Toggle Role -->
                                    @if ($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.toggleRole', $user) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="w-[calc(100%-8px)] group flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-slate-300 hover:text-white hover:bg-white/5 rounded-xl mx-1 transition-colors text-left cursor-pointer">
                                                @if ($user->isAdmin())
                                                    <svg class="w-4 h-4 text-amber-400 group-hover:text-amber-300 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                    <span>Demote to User</span>
                                                @else
                                                    <svg class="w-4 h-4 text-emerald-400 group-hover:text-emerald-300 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                                    </svg>
                                                    <span>Promote to Admin</span>
                                                @endif
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                <div class="py-1 border-t border-white/5">
                                    <!-- Delete User -->
                                    @if ($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                            onsubmit="return confirm('Permanently delete user [{{ $user->name }}]?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-[calc(100%-8px)] group flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-rose-400 hover:text-rose-200 hover:bg-rose-500/15 rounded-xl mx-1 transition-colors text-left cursor-pointer">
                                                <svg class="w-4 h-4 text-rose-400 group-hover:text-rose-300 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span>Delete User</span>
                                            </button>
                                        </form>
                                    @else
                                        <div class="px-3.5 py-2 text-[11px] text-slate-500 italic flex items-center gap-2">
                                            <svg class="w-3.5 h-3.5 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10m4-11a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            <span>Current logged-in user</span>
                                        </div>
                                    @endif
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
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-white">No registered users found</h3>
                        <p class="text-xs text-slate-400 font-mono max-w-sm mx-auto">
                            No accounts match your current filter parameters or search keyword.
                        </p>
                        <button type="button" onclick="resetAllFilters()"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-indigo-500/10 hover:bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 text-xs font-mono transition-colors">
                            <span>Clear Filters</span>
                        </button>
                    </div>
                @endforelse
            </div>

            <!-- Bottom Stats & Pagination (Datalist Card Footer matching Notifications) -->
            <div
                class="pt-5 mt-4 border-t border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <!-- Bottom Left: Pro Telemetry Info & Page Status Badges -->
                <div id="showingCountContainer" class="flex flex-wrap items-center justify-center gap-2.5">
                    @if ($users->total() > 0)
                        <!-- Primary Range Badge -->
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-white/[0.03] border border-white/10 text-xs font-mono text-slate-300 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                            <span class="text-slate-400">Showing</span>
                            <span
                                class="px-2 py-0.5 rounded-lg bg-indigo-500/20 text-indigo-300 font-bold border border-indigo-500/30">
                                {{ $users->firstItem() }}&ndash;{{ $users->lastItem() }}
                            </span>
                            <span class="text-slate-400">of</span>
                            <span class="text-white font-extrabold">{{ $users->total() }}</span>
                            <span class="text-slate-400">items</span>
                        </div>

                        <!-- Secondary Page Position & Database Context -->
                        <div
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-black/40 border border-white/5 text-[11px] font-mono text-slate-400">
                            <span>Page <strong class="text-white">{{ $users->currentPage() }}</strong> of <strong
                                    class="text-white">{{ $users->lastPage() }}</strong></span>
                            <span class="text-slate-600">&bull;</span>
                            <span class="text-slate-400">{{ $users->count() }} on page</span>
                            <span class="text-slate-600">&bull;</span>
                            <span class="text-slate-500">Total: {{ $totalUsers }}</span>
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
                    {{ $users->links('admin.components.pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Live search input debounce
        let searchDebounceTimeout = null;
        const searchInput = document.getElementById('userSearchInput');
        const clearBtn = document.getElementById('clearSearchBtn');

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                if (clearBtn) {
                    if (this.value.trim().length > 0) {
                        clearBtn.classList.remove('hidden');
                    } else {
                        clearBtn.classList.add('hidden');
                    }
                }
                clearTimeout(searchDebounceTimeout);
                searchDebounceTimeout = setTimeout(() => {
                    triggerFilterUpdate();
                }, 350);
            });
        }

        function clearSearch() {
            if (searchInput) {
                searchInput.value = '';
                if (clearBtn) clearBtn.classList.add('hidden');
                triggerFilterUpdate();
            }
        }

        function resetAllFilters() {
            if (searchInput) {
                searchInput.value = '';
                if (clearBtn) clearBtn.classList.add('hidden');
            }
            const roleSelect = document.getElementById('roleFilter');
            if (roleSelect) roleSelect.value = 'all';
            const sortSelect = document.getElementById('sortFilter');
            if (sortSelect) sortSelect.value = 'latest';
            triggerFilterUpdate();
        }

        function triggerFilterUpdate(page = 1) {
            const search = document.getElementById('userSearchInput') ? document.getElementById('userSearchInput').value
                .trim() : '';
            const role = document.getElementById('roleFilter') ? document.getElementById('roleFilter').value : 'all';
            const sort = document.getElementById('sortFilter') ? document.getElementById('sortFilter').value : 'latest';
            const perPage = document.getElementById('perPageFilter') ? document.getElementById('perPageFilter').value :
                '10';

            const params = new URLSearchParams();
            if (search) params.set('search', search);
            if (role && role !== 'all') params.set('role', role);
            if (sort && sort !== 'latest') params.set('sort', sort);
            if (perPage && perPage !== '10') params.set('per_page', perPage);
            if (page > 1) params.set('page', page);

            const newUrl = `${window.location.pathname}${params.toString() ? '?' + params.toString() : ''}`;
            window.history.pushState({
                path: newUrl
            }, '', newUrl);

            // Toggle Reset Filters button
            const resetBtn = document.getElementById('resetFiltersBtn');
            if (resetBtn) {
                const hasFilters = Boolean(search || (role && role !== 'all') || (sort && sort !== 'latest'));
                if (hasFilters) {
                    resetBtn.classList.remove('hidden');
                } else {
                    resetBtn.classList.add('hidden');
                }
            }

            // Subtle loading indicator
            const listContainer = document.getElementById('usersListContainer');
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

                    // Swap list container
                    const newList = doc.getElementById('usersListContainer');
                    if (newList && listContainer) {
                        listContainer.innerHTML = newList.innerHTML;
                        listContainer.style.opacity = '1';
                    }

                    // Swap datalist count badge
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

                    // Reset selection
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

        function toggleSelectAll(master) {
            const checkboxes = document.querySelectorAll('.user-select-checkbox');
            checkboxes.forEach(cb => {
                cb.checked = master.checked;
            });
            updateSelectedCount();
        }

        function updateSelectedCount() {
            const checked = document.querySelectorAll('.user-select-checkbox:checked').length;
            const badge = document.getElementById('selectedCountBadge');
            const selectAll = document.getElementById('selectAllCheckbox');
            const total = document.querySelectorAll('.user-select-checkbox').length;

            if (badge) {
                badge.textContent = `${checked} selected`;
                if (checked > 0) {
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            }
            if (selectAll && total > 0) {
                selectAll.checked = checked === total;
                selectAll.indeterminate = checked > 0 && checked < total;
            }
        }

        // Initialize pagination ajax hooks on load
        document.addEventListener('DOMContentLoaded', function() {
            attachPaginationListeners();
            updateSelectedCount();
        });

        // ----------------------------------------------------
        // Dropdown Actions Menu Handlers
        // ----------------------------------------------------
        function toggleUserActionsDropdown(event, userId) {
            if (event) {
                event.stopPropagation();
            }
            const menu = document.getElementById(`user-actions-menu-${userId}`);
            const card = document.getElementById(`user-card-${userId}`);
            if (!menu) return;

            const isCurrentlyOpen = !menu.classList.contains('hidden');

            closeAllUserDropdowns();

            if (!isCurrentlyOpen) {
                menu.classList.remove('hidden');
                if (card) {
                    card.classList.add('z-30');
                }
            }
        }

        function closeAllUserDropdowns() {
            document.querySelectorAll('.user-dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
            document.querySelectorAll('[id^="user-card-"]').forEach(card => {
                card.classList.remove('z-30');
            });
        }

        // Close on outside click
        document.addEventListener('click', function(e) {
            if (!e.target.closest('[id^="user-dropdown-wrapper-"]')) {
                closeAllUserDropdowns();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAllUserDropdowns();
            }
        });

        window.addEventListener('popstate', function() {
            window.location.reload();
        });
    </script>
@endpush
