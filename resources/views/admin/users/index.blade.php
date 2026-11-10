@extends('admin.layout')

@section('title', 'User Management')
@section('page_title', 'Users & Permissions')
@section('page_subtitle', 'System Accounts')

@push('styles')
    <style>
        /* Pro-Grade Obsidian Pagination Micro-interactions & Zero Scrollbars */
        #paginationContainer {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        #paginationContainer::-webkit-scrollbar {
            display: none;
        }

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

            <div class="flex items-center gap-2.5 flex-wrap w-full sm:w-auto">
                <!-- Export Dropdown -->
                <div class="relative w-full sm:w-auto" id="usersExportDropdownWrapper">
                    <button type="button"
                        id="usersExportDropdownBtn"
                        onclick="toggleUsersExportDropdown(event)"
                        class="w-full sm:w-auto justify-center inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-mono font-bold text-xs uppercase tracking-wider bg-white/5 hover:bg-white/10 text-slate-200 hover:text-white border border-white/10 shadow-lg transition-all cursor-pointer">
                        <svg class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <span>Export</span>
                        <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" id="usersExportChevron" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="usersExportDropdownMenu"
                        class="hidden absolute right-0 mt-2 w-56 rounded-2xl bg-[#09101d] border border-white/10 shadow-2xl p-2 z-50 backdrop-blur-xl space-y-1">
                        <div class="px-3 py-1.5 text-[10px] font-mono uppercase font-bold text-slate-400 border-b border-white/5 mb-1 flex items-center justify-between">
                            <span>Export Formats</span>
                            <span class="text-indigo-400">DataTable JS</span>
                        </div>
                        
                        <!-- 1. Excel (.xlsx) -->
                        <button type="button" onclick="exportUsers('excel')"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-mono text-slate-200 hover:text-white hover:bg-emerald-500/10 hover:border-emerald-500/20 border border-transparent transition-all group cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <span class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-[10px] font-black border border-emerald-500/30 group-hover:scale-105 transition-transform">
                                    XLS
                                </span>
                                <span>Excel Document</span>
                            </div>
                            <span class="text-[10px] text-slate-500 font-mono">.xlsx</span>
                        </button>

                        <!-- 2. Word (.doc) -->
                        <button type="button" onclick="exportUsers('word')"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-mono text-slate-200 hover:text-white hover:bg-blue-500/10 hover:border-blue-500/20 border border-transparent transition-all group cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <span class="w-6 h-6 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center text-[10px] font-black border border-blue-500/30 group-hover:scale-105 transition-transform">
                                    DOC
                                </span>
                                <span>Word Document</span>
                            </div>
                            <span class="text-[10px] text-slate-500 font-mono">.doc</span>
                        </button>

                        <!-- 3. CSV (.csv) -->
                        <button type="button" onclick="exportUsers('csv')"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-mono text-slate-200 hover:text-white hover:bg-cyan-500/10 hover:border-cyan-500/20 border border-transparent transition-all group cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <span class="w-6 h-6 rounded-lg bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-[10px] font-black border border-cyan-500/30 group-hover:scale-105 transition-transform">
                                    CSV
                                </span>
                                <span>CSV Spreadsheet</span>
                            </div>
                            <span class="text-[10px] text-slate-500 font-mono">.csv</span>
                        </button>

                        <!-- 4. PDF (.pdf) -->
                        <button type="button" onclick="exportUsers('pdf')"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-mono text-slate-200 hover:text-white hover:bg-rose-500/10 hover:border-rose-500/20 border border-transparent transition-all group cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <span class="w-6 h-6 rounded-lg bg-rose-500/20 text-rose-400 flex items-center justify-center text-[10px] font-black border border-rose-500/30 group-hover:scale-105 transition-transform">
                                    PDF
                                </span>
                                <span>PDF Document</span>
                            </div>
                            <span class="text-[10px] text-slate-500 font-mono">.pdf</span>
                        </button>

                        <!-- 5. Image (.png) -->
                        <button type="button" onclick="exportUsers('image')"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-xl text-xs font-mono text-slate-200 hover:text-white hover:bg-purple-500/10 hover:border-purple-500/20 border border-transparent transition-all group cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <span class="w-6 h-6 rounded-lg bg-purple-500/20 text-purple-400 flex items-center justify-center text-[10px] font-black border border-purple-500/30 group-hover:scale-105 transition-transform">
                                    PNG
                                </span>
                                <span>High-Res Image</span>
                            </div>
                            <span class="text-[10px] text-slate-500 font-mono">.png</span>
                        </button>
                    </div>
                </div>

                <a href="{{ route('admin.users.create') }}"
                    class="theme-aware-create-btn w-full sm:w-auto justify-center inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white shadow-lg shadow-indigo-600/30 transition-all cursor-pointer">
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

            <!-- Card-Row List Container -->
            <div id="usersListContainer" class="space-y-3 transition-opacity duration-200">
                @forelse ($users as $user)
                    <div id="user-card-{{ $user->id }}"
                        class="p-4 sm:p-5 rounded-2xl bg-white/[0.02] hover:bg-white/[0.04] border border-white/5 hover:border-white/10 transition-all flex flex-col md:flex-row md:items-center justify-between gap-4 group relative">
                        <!-- Left: Avatar + User Details -->
                        <div class="flex items-start md:items-center gap-3 sm:gap-4 flex-1 min-w-0">
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
                                    <span class="font-mono text-slate-300 break-all">{{ $user->email }}</span>
                                    @if ($user->phone)
                                        <span class="text-slate-600">&bull;</span>
                                        <span class="font-mono text-slate-400">{{ $user->phone }}</span>
                                    @endif
                                    @if ($user->location)
                                        <span class="text-slate-600">&bull;</span>
                                        <span class="text-slate-400">{{ $user->location }}</span>
                                    @endif
                                </p>

                                <div class="flex items-center gap-2 flex-wrap text-[11px] font-mono text-slate-500 pt-1">
                                    <span class="whitespace-nowrap">Joined {{ $user->created_at->diffForHumans() }}</span>
                                    <span class="text-slate-600 shrink-0">&bull;</span>
                                    <span class="whitespace-nowrap">{{ $user->created_at->format('M d, Y h:i A') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Actions Dropdown Menu (3-dots kebab button) -->
                        <div class="relative shrink-0 self-end md:self-auto"
                            id="user-dropdown-wrapper-{{ $user->id }}">
                            <button type="button" id="user-actions-btn-{{ $user->id }}"
                                onclick="toggleUserActionsDropdown(event, {{ $user->id }})"
                                class="w-9 h-9 rounded-xl bg-white/5 hover:bg-white/10 active:bg-white/15 border border-white/5 hover:border-white/15 flex items-center justify-center text-slate-400 hover:text-white transition-all cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                                title="Actions" aria-label="User actions">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="5" r="1.75" />
                                    <circle cx="12" cy="12" r="1.75" />
                                    <circle cx="12" cy="19" r="1.75" />
                                </svg>
                            </button>

                            <!-- Floating Dropdown Popover Menu -->
                            <div id="user-actions-menu-{{ $user->id }}"
                                class="user-dropdown-menu hidden absolute right-0 mt-2 w-52 max-w-[calc(100vw-2.5rem)] rounded-2xl bg-[#0d1627] border border-white/10 shadow-2xl shadow-black/80 py-1.5 z-50 backdrop-blur-xl">

                                <div class="px-3.5 py-2 border-b border-white/5">
                                    <p class="text-[10px] font-mono uppercase tracking-wider text-slate-400">User Actions
                                    </p>
                                    <p class="text-xs font-semibold text-white truncate">{{ $user->name }}</p>
                                </div>

                                <div class="py-1">
                                    <!-- View Profile -->
                                    <a href="{{ route('admin.users.show', $user) }}"
                                        class="group flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium text-slate-300 hover:text-white hover:bg-white/5 rounded-xl mx-1 transition-colors">
                                        <svg class="w-4 h-4 text-slate-400 group-hover:text-cyan-400 transition-colors shrink-0"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                        <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-400 transition-colors shrink-0"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                                    <svg class="w-4 h-4 text-amber-400 group-hover:text-amber-300 transition-colors shrink-0"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                    <span>Demote to User</span>
                                                @else
                                                    <svg class="w-4 h-4 text-emerald-400 group-hover:text-emerald-300 transition-colors shrink-0"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 15l7-7 7 7" />
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
                                                <svg class="w-4 h-4 text-rose-400 group-hover:text-rose-300 transition-colors shrink-0"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span>Delete User</span>
                                            </button>
                                        </form>
                                    @else
                                        <div class="px-3.5 py-2 text-[11px] text-slate-500 italic flex items-center gap-2">
                                            <svg class="w-3.5 h-3.5 text-slate-500 shrink-0" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m0 0v2m0-2h2m-2 0H10m4-11a4 4 0 11-8 0 4 4 0 018 0z" />
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

            <!-- Bottom Stats & Pagination (Centered Datalist Card Footer) -->
            <div class="pt-6 mt-4 border-t border-white/10 flex flex-col items-center justify-center gap-3.5">
                <!-- Unified Stats Capsule -->
                <div id="showingCountContainer" class="flex items-center justify-center">
                    @if ($users->total() > 0)
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#0c1424] border border-white/10 text-xs font-mono text-slate-300 shadow-inner whitespace-nowrap">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                            <span>Showing <strong class="text-white font-semibold">{{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }}</strong> of <strong class="text-white font-semibold">{{ $users->total() }}</strong></span>
                            <span class="text-slate-600">•</span>
                            <span>Page <strong class="text-white font-semibold">{{ $users->currentPage() }}</strong> of <strong class="text-white font-semibold">{{ $users->lastPage() }}</strong></span>
                        </div>
                    @else
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#0c1424] border border-white/10 text-xs font-mono text-slate-400 whitespace-nowrap">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-600"></span>
                            <span>Showing <strong>0</strong> items</span>
                        </div>
                    @endif
                </div>

                <!-- Bottom Pro Pagination Controls -->
                <div id="paginationContainer" class="flex items-center justify-center max-w-full py-1">
                    {{ $users->links('admin.components.pagination') }}
                </div>
            </div>
        </div>

        <!-- Dedicated DataTables Export Container (Off-Screen for DataTable JS & html2canvas) -->
        <div id="usersExportContainer" style="position: absolute; left: -99999px; top: 0; width: 1200px; z-index: -100; pointer-events: none;">
            <div id="usersExportVisualCard" style="background-color: #09101d; padding: 32px; border-radius: 24px; color: #f8fafc; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid rgba(255,255,255,0.1); padding-bottom: 16px; margin-bottom: 24px;">
                    <div>
                        <h1 style="font-size: 22px; font-weight: 800; margin: 0; color: #ffffff; letter-spacing: -0.5px;">User Accounts &amp; Directory</h1>
                        <p style="font-size: 12px; color: #94a3b8; margin: 4px 0 0 0; font-family: monospace;">Exported via Portfolio Studio DataTable JS &bull; {{ date('Y-m-d H:i:s') }}</p>
                    </div>
                    <div style="text-align: right;">
                        <span style="display: inline-block; padding: 6px 14px; border-radius: 9999px; background: rgba(99, 102, 241, 0.2); border: 1px solid rgba(99, 102, 241, 0.4); color: #a5b4fc; font-weight: 700; font-size: 12px; font-family: monospace;">
                            Total: {{ count($allUsers ?? $users) }}
                        </span>
                    </div>
                </div>

                <table id="usersExportTable" class="display nowrap" style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background-color: #0f172a; border-bottom: 2px solid rgba(99, 102, 241, 0.4);">
                            <th style="padding: 12px 10px; font-size: 11px; text-transform: uppercase; font-family: monospace; color: #94a3b8; border-bottom: 1px solid rgba(255,255,255,0.1);">#</th>
                            <th style="padding: 12px 10px; font-size: 11px; text-transform: uppercase; font-family: monospace; color: #94a3b8; border-bottom: 1px solid rgba(255,255,255,0.1);">Name</th>
                            <th style="padding: 12px 10px; font-size: 11px; text-transform: uppercase; font-family: monospace; color: #94a3b8; border-bottom: 1px solid rgba(255,255,255,0.1);">Email</th>
                            <th style="padding: 12px 10px; font-size: 11px; text-transform: uppercase; font-family: monospace; color: #94a3b8; border-bottom: 1px solid rgba(255,255,255,0.1);">Role</th>
                            <th style="padding: 12px 10px; font-size: 11px; text-transform: uppercase; font-family: monospace; color: #94a3b8; border-bottom: 1px solid rgba(255,255,255,0.1);">Phone</th>
                            <th style="padding: 12px 10px; font-size: 11px; text-transform: uppercase; font-family: monospace; color: #94a3b8; border-bottom: 1px solid rgba(255,255,255,0.1);">Location</th>
                            <th style="padding: 12px 10px; font-size: 11px; text-transform: uppercase; font-family: monospace; color: #94a3b8; border-bottom: 1px solid rgba(255,255,255,0.1);">Email Verified</th>
                            <th style="padding: 12px 10px; font-size: 11px; text-transform: uppercase; font-family: monospace; color: #94a3b8; border-bottom: 1px solid rgba(255,255,255,0.1);">Registered Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (($allUsers ?? $users) as $u)
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                                <td style="padding: 10px; font-size: 12px; font-family: monospace; color: #64748b;">{{ $loop->iteration }}</td>
                                <td style="padding: 10px; font-size: 13px; font-weight: 600; color: #f1f5f9;">{{ $u->name }}</td>
                                <td style="padding: 10px; font-size: 13px; font-family: monospace; color: #38bdf8;">{{ $u->email }}</td>
                                <td style="padding: 10px; font-size: 12px;">
                                    <span style="color: {{ $u->role === 'admin' ? '#818cf8' : '#38bdf8' }}; font-weight: 700; text-transform: uppercase; font-size: 10px; font-family: monospace;">
                                        {{ $u->role ?? 'user' }}
                                    </span>
                                </td>
                                <td style="padding: 10px; font-size: 12px; font-family: monospace; color: #cbd5e1;">{{ $u->phone ?: 'N/A' }}</td>
                                <td style="padding: 10px; font-size: 12px; font-family: monospace; color: #94a3b8;">{{ $u->location ?: 'N/A' }}</td>
                                <td style="padding: 10px; font-size: 12px;">
                                    <span style="color: {{ $u->email_verified_at ? '#34d399' : '#f87171' }}; font-weight: 700; font-size: 10px; font-family: monospace;">
                                        {{ $u->email_verified_at ? 'Verified' : 'Unverified' }}
                                    </span>
                                </td>
                                <td style="padding: 10px; font-size: 12px; font-family: monospace; color: #94a3b8;">{{ $u->created_at ? $u->created_at->format('M d, Y h:i A') : 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="padding: 20px; text-align: center; color: #94a3b8; font-size: 13px;">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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

                    // Swap export container so export data stays synced with active filters
                    const newExport = doc.getElementById('usersExportContainer');
                    const exportContainer = document.getElementById('usersExportContainer');
                    if (newExport && exportContainer) {
                        exportContainer.innerHTML = newExport.innerHTML;
                        initUsersDataTable();
                    }
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

        // ==========================================
        // DataTable JS & Export Handlers (Users)
        // ==========================================
        let usersDataTable = null;

        function initUsersDataTable() {
            if (typeof $.fn.DataTable === 'undefined') return;

            if ($.fn.DataTable.isDataTable('#usersExportTable')) {
                $('#usersExportTable').DataTable().destroy();
            }

            usersDataTable = $('#usersExportTable').DataTable({
                dom: 'Bfrtip',
                paging: false,
                searching: false,
                info: false,
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'User_Accounts_' + new Date().toISOString().slice(0, 10),
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'User_Accounts_' + new Date().toISOString().slice(0, 10),
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        title: 'User Accounts Directory',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function(doc) {
                            doc.defaultStyle.fontSize = 9;
                            doc.styles.tableHeader.fillColor = '#09101d';
                            doc.styles.tableHeader.color = '#ffffff';
                            doc.styles.tableHeader.alignment = 'left';
                            if (doc.content[1] && doc.content[1].table) {
                                doc.content[1].table.widths = ['4%', '16%', '22%', '10%', '14%', '14%', '10%', '10%'];
                            }
                        }
                    }
                ]
            });
        }

        function toggleUsersExportDropdown(event) {
            if (event) event.stopPropagation();
            const menu = document.getElementById('usersExportDropdownMenu');
            const chevron = document.getElementById('usersExportChevron');
            if (!menu) return;
            const isHidden = menu.classList.contains('hidden');
            if (isHidden) {
                menu.classList.remove('hidden');
                if (chevron) chevron.classList.add('rotate-180');
            } else {
                menu.classList.add('hidden');
                if (chevron) chevron.classList.remove('rotate-180');
            }
        }

        function closeUsersExportDropdown() {
            const menu = document.getElementById('usersExportDropdownMenu');
            const chevron = document.getElementById('usersExportChevron');
            if (menu && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
                if (chevron) chevron.classList.remove('rotate-180');
            }
        }

        function exportUsers(format) {
            closeUsersExportDropdown();

            if (!usersDataTable) {
                initUsersDataTable();
            }

            const table = document.getElementById('usersExportTable');
            const rowCount = table ? table.querySelectorAll('tbody tr').length : 0;
            if (rowCount === 0) {
                if (window.toastr) toastr.warning('No users available to export.');
                return;
            }

            const today = new Date().toISOString().slice(0, 10);
            const filename = `User_Accounts_${today}`;

            if (format === 'excel') {
                if (window.toastr) toastr.info('Exporting users via DataTable Excel (XLSX)...');
                if (usersDataTable) {
                    usersDataTable.button('.buttons-excel').trigger();
                    setTimeout(() => { if (window.toastr) toastr.success('Excel export ready!'); }, 800);
                }
            } else if (format === 'csv') {
                if (window.toastr) toastr.info('Exporting users via DataTable CSV...');
                if (usersDataTable) {
                    usersDataTable.button('.buttons-csv').trigger();
                    setTimeout(() => { if (window.toastr) toastr.success('CSV export ready!'); }, 800);
                }
            } else if (format === 'pdf') {
                if (window.toastr) toastr.info('Generating PDF document via DataTable PDF...');
                if (usersDataTable) {
                    usersDataTable.button('.buttons-pdf').trigger();
                    setTimeout(() => { if (window.toastr) toastr.success('PDF document generated!'); }, 1000);
                }
            } else if (format === 'word') {
                if (window.toastr) toastr.info('Generating Word (.doc) document...');
                exportTableToWord('usersExportTable', filename);
                if (window.toastr) toastr.success('Word document exported successfully!');
            } else if (format === 'image') {
                if (window.toastr) toastr.info('Capturing high-resolution report image (.png)...');
                const card = document.getElementById('usersExportVisualCard');
                if (!card) {
                    if (window.toastr) toastr.error('Export template not found.');
                    return;
                }

                if (typeof html2canvas === 'undefined') {
                    if (window.toastr) toastr.error('Image export renderer is loading. Please try again.');
                    return;
                }

                html2canvas(card, {
                    backgroundColor: '#09101d',
                    scale: 2,
                    useCORS: true,
                    logging: false
                }).then(canvas => {
                    const a = document.createElement('a');
                    a.download = `${filename}.png`;
                    a.href = canvas.toDataURL('image/png');
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    if (window.toastr) toastr.success('Users image exported successfully!');
                }).catch(err => {
                    console.error('Image export capture error:', err);
                    if (window.toastr) toastr.error('Failed to capture image export.');
                });
            }
        }

        function exportTableToWord(tableId, filename) {
            const table = document.getElementById(tableId);
            if (!table) return;

            const html = `
                <html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>
                <head>
                    <meta charset='utf-8'>
                    <title>${filename}</title>
                    <style>
                        body { font-family: 'Segoe UI', Arial, sans-serif; font-size: 10pt; color: #1e293b; margin: 24px; }
                        h2 { font-size: 16pt; color: #0f172a; margin-bottom: 4px; }
                        p.subtitle { color: #64748b; font-size: 9pt; margin-top: 0; margin-bottom: 16px; font-family: monospace; }
                        table { border-collapse: collapse; width: 100%; margin-top: 10px; font-family: sans-serif; }
                        th { background-color: #0f172a; color: #ffffff; padding: 10px 8px; border: 1px solid #cbd5e1; font-size: 9pt; text-align: left; }
                        td { padding: 8px 8px; border: 1px solid #e2e8f0; font-size: 9pt; }
                        tr:nth-child(even) td { background-color: #f8fafc; }
                    </style>
                </head>
                <body>
                    <h2>${filename.replace(/_/g, ' ')}</h2>
                    <p class="subtitle">Generated on ${new Date().toLocaleString()} | Total Records: ${table.querySelectorAll('tbody tr').length}</p>
                    ${table.outerHTML}
                </body>
                </html>
            `;

            const blob = new Blob(['\ufeff' + html], { type: 'application/msword' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `${filename}.doc`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }

        // Initialize pagination and DataTable JS hooks on load
        document.addEventListener('DOMContentLoaded', function() {
            attachPaginationListeners();
            initUsersDataTable();
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
            if (!e.target.closest('#usersExportDropdownWrapper')) {
                closeUsersExportDropdown();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAllUserDropdowns();
                closeUsersExportDropdown();
            }
        });

        window.addEventListener('popstate', function() {
            window.location.reload();
        });
    </script>
@endpush
