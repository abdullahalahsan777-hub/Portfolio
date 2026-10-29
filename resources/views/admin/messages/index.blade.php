@extends('admin.layout')

@section('title', 'Client Inquiries & Mailbox')
@section('page_title', 'Inbox & Communications')
@section('page_subtitle', 'Group: Website')

@push('styles')
    <style>
        .composer-dark {
            background-color: #09101d !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
            color: #f1f5f9 !important;
        }

        .composer-dark #composer_header {
            background-color: #0d1627 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
        }

        .composer-dark .composer-title {
            color: #ffffff !important;
        }

        .composer-dark .composer-header-actions button {
            color: #94a3b8 !important;
        }

        .composer-dark .composer-header-actions button:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
        }

        .composer-dark #composer_body_section {
            background-color: #09101d !important;
        }

        .composer-dark #row_to,
        .composer-dark #composer_cc_row,
        .composer-dark #composer_bcc_row,
        .composer-dark #row_subject {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        .composer-dark .composer-label {
            color: #94a3b8 !important;
        }

        .composer-dark .composer-input {
            color: #ffffff !important;
        }

        .composer-dark .composer-input::placeholder {
            color: #64748b !important;
        }

        .composer-dark .composer-textarea {
            color: #f1f5f9 !important;
        }

        .composer-dark .composer-textarea::placeholder {
            color: #64748b !important;
        }

        .composer-dark .composer-chip {
            background-color: #0d1627 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #cbd5e1 !important;
        }

        .composer-dark #composer_footer {
            background-color: #09101d !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        .composer-dark .composer-icon-btn {
            color: #94a3b8 !important;
        }

        .composer-dark .composer-icon-btn:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
        }

        /* Light Theme */
        .composer-light {
            background-color: #ffffff !important;
            border-color: #cbd5e1 !important;
            color: #1e293b !important;
        }

        .composer-light #composer_header {
            background-color: #f2f6fc !important;
            border-color: #e2e8f0 !important;
        }

        .composer-light .composer-title {
            color: #1f2937 !important;
        }

        .composer-light .composer-header-actions button {
            color: #4b5563 !important;
        }

        .composer-light .composer-header-actions button:hover {
            background-color: #e2e8f0 !important;
            color: #111827 !important;
        }

        .composer-light #composer_body_section {
            background-color: #ffffff !important;
        }

        .composer-light #row_to,
        .composer-light #composer_cc_row,
        .composer-light #composer_bcc_row,
        .composer-light #row_subject {
            border-color: #f1f5f9 !important;
        }

        .composer-light .composer-label {
            color: #64748b !important;
        }

        .composer-light .composer-input {
            color: #0f172a !important;
        }

        .composer-light .composer-input::placeholder {
            color: #94a3b8 !important;
        }

        .composer-light .composer-textarea {
            color: #1e293b !important;
        }

        .composer-light .composer-textarea::placeholder {
            color: #94a3b8 !important;
        }

        .composer-light .composer-chip {
            background-color: #f8fafc !important;
            border-color: #e2e8f0 !important;
            color: #334155 !important;
        }

        .composer-light #composer_footer {
            background-color: #f8fafc !important;
            border-color: #e2e8f0 !important;
        }

        .composer-light .composer-icon-btn {
            color: #64748b !important;
        }

        .composer-light .composer-icon-btn:hover {
            background-color: #e2e8f0 !important;
            color: #0f172a !important;
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
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-black text-white tracking-tight flex items-center gap-2">
                            <span>Client Inquiries &amp; Communications Hub</span>
                            <span
                                class="px-2.5 py-0.5 rounded-full text-xs font-mono font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                                {{ $counts['all'] }} {{ Str::plural('Mail', $counts['all']) }}
                            </span>
                        </h1>
                        <p class="text-xs text-slate-400 font-mono">
                            Direct visitor inquiries, drafted replies, sent correspondence, and background queued messages
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2.5 flex-wrap">
                <button type="button" onclick="openNewComposer()"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white shadow-lg shadow-indigo-600/30 transition-all cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Compose Mail</span>
                </button>
            </div>
        </div>

        <!-- 2. Top Summary Metrics Cards (4 in a Row - Matching User Management Design) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card 1: Total Inquiries -->
            <a href="{{ route('admin.messages.index', ['type' => 'all'] + request()->except('type', 'page')) }}"
                class="p-4 rounded-2xl bg-[#09101d] border {{ $currentType === 'all' ? 'border-indigo-500/60 shadow-lg shadow-indigo-500/10 bg-gradient-to-br from-[#09101d] to-indigo-950/20' : 'border-white/10 hover:border-white/20' }} transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-[11px] font-mono text-slate-400 uppercase tracking-wider block">Total Messages</span>
                    <div class="text-2xl font-black font-mono text-white">{{ $counts['all'] }}</div>
                    <span class="text-[10px] font-mono text-slate-500">All mailbox records</span>
                </div>
                <div
                    class="w-11 h-11 rounded-2xl bg-indigo-500/15 border border-indigo-500/30 text-indigo-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-inner">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
            </a>

            <!-- Card 2: Inbox & Unread -->
            <a href="{{ route('admin.messages.index', ['type' => 'inbox'] + request()->except('type', 'page')) }}"
                class="p-4 rounded-2xl bg-[#09101d] border {{ $currentType === 'inbox' ? 'border-amber-500/60 shadow-lg shadow-amber-500/10 bg-gradient-to-br from-[#09101d] to-amber-950/20' : 'border-white/10 hover:border-white/20' }} transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-[11px] font-mono text-slate-400 uppercase tracking-wider block">Inbox
                        Submissions</span>
                    <div class="text-2xl font-black font-mono text-amber-400 flex items-center gap-2">
                        <span>{{ $counts['inbox'] }}</span>
                        @if ($counts['unread_inbox'] > 0)
                            <span
                                class="text-[11px] font-mono font-bold px-2 py-0.5 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30">
                                {{ $counts['unread_inbox'] }} New
                            </span>
                        @endif
                    </div>
                    <span class="text-[10px] font-mono text-slate-500">From website forms</span>
                </div>
                <div
                    class="w-11 h-11 rounded-2xl bg-amber-500/15 border border-amber-500/30 text-amber-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-inner">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </a>

            <!-- Card 3: Sent Replies -->
            <a href="{{ route('admin.messages.index', ['type' => 'sent'] + request()->except('type', 'page')) }}"
                class="p-4 rounded-2xl bg-[#09101d] border {{ $currentType === 'sent' ? 'border-emerald-500/60 shadow-lg shadow-emerald-500/10 bg-gradient-to-br from-[#09101d] to-emerald-950/20' : 'border-white/10 hover:border-white/20' }} transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-[11px] font-mono text-slate-400 uppercase tracking-wider block">Sent
                        Correspondence</span>
                    <div class="text-2xl font-black font-mono text-emerald-400">{{ $counts['sent'] }}</div>
                    <span class="text-[10px] font-mono text-slate-500">Dispatched to clients</span>
                </div>
                <div
                    class="w-11 h-11 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-inner">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </div>
            </a>

            <!-- Card 4: Starred & Important -->
            <a href="{{ route('admin.messages.index', ['type' => 'important'] + request()->except('type', 'page')) }}"
                class="p-4 rounded-2xl bg-[#09101d] border {{ $currentType === 'important' ? 'border-yellow-500/60 shadow-lg shadow-yellow-500/10 bg-gradient-to-br from-[#09101d] to-yellow-950/20' : 'border-white/10 hover:border-white/20' }} transition-all group flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-[11px] font-mono text-slate-400 uppercase tracking-wider block">Important &bull;
                        Starred</span>
                    <div class="text-2xl font-black font-mono text-yellow-400 flex items-center gap-2">
                        <span>{{ $counts['important'] }}</span>
                        @if ($counts['draft'] > 0)
                            <span
                                class="text-[10px] font-mono px-2 py-0.5 rounded-full bg-slate-800 text-slate-300 border border-white/10">
                                {{ $counts['draft'] }} {{ Str::plural('Draft', $counts['draft']) }}
                            </span>
                        @endif
                    </div>
                    <span class="text-[10px] font-mono text-slate-500">VIP clients &amp; drafts</span>
                </div>
                <div
                    class="w-11 h-11 rounded-2xl bg-yellow-500/15 border border-yellow-500/30 text-yellow-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-inner">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
            </a>
        </div>

        <!-- 3. Dual-Pane Layout: Left Main Table Area + Right Mailbox Sidebar -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">

            <!-- =====================================================================
                                             LEFT MAIN COLUMN: Filter Card + Data Table + Pagination
                                             ===================================================================== -->
            <div class="lg:col-span-3 space-y-6">

                <!-- Filter Box (Matching User Management) -->
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
                                <h3 class="text-sm font-bold text-white tracking-tight">Filter Messages</h3>
                                <p class="text-[11px] font-mono text-slate-400">Search by client name, email, subject,
                                    keyword, or status</p>
                            </div>
                        </div>

                        @if (request('search') ||
                                (request('status') && request('status') !== 'all') ||
                                (request('sort') && request('sort') !== 'latest') ||
                                (request('per_page') && request('per_page') != 10))
                            <a href="{{ route('admin.messages.index', ['type' => $currentType]) }}"
                                class="text-[11px] font-mono text-indigo-400 hover:text-indigo-300 flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-indigo-500/10 border border-indigo-500/20 transition-all cursor-pointer"
                                title="Reset all active search filters">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <span>Reset Filters</span>
                            </a>
                        @endif
                    </div>

                    <form id="filterForm" action="{{ route('admin.messages.index') }}" method="GET"
                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3.5 text-xs">
                        <input type="hidden" name="type" value="{{ $currentType }}">

                        <!-- Search Input -->
                        <div class="sm:col-span-2 relative">
                            <label class="block text-[10px] font-mono uppercase tracking-wider text-slate-400 mb-1">Search
                                Keywords</label>
                            <div class="relative">
                                <input type="text" name="search" value="{{ $search }}"
                                    placeholder="Search name, email, subject, body..."
                                    class="w-full pl-9 pr-8 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white placeholder-slate-500 text-xs focus:outline-none focus:border-indigo-500 transition-colors">
                                <svg class="w-4 h-4 text-slate-500 absolute left-3 top-3 pointer-events-none"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                @if (!empty($search))
                                    <a href="{{ route('admin.messages.index', request()->except('search', 'page')) }}"
                                        class="absolute right-2.5 top-2.5 text-slate-400 hover:text-white text-xs">&times;</a>
                                @endif
                            </div>
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <label class="block text-[10px] font-mono uppercase tracking-wider text-slate-400 mb-1">Read
                                Status</label>
                            <select name="status" onchange="this.form.submit()"
                                class="w-full px-3 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                                <option value="all" {{ $status === 'all' ? 'selected' : '' }}>All Statuses</option>
                                <option value="unread" {{ $status === 'unread' ? 'selected' : '' }}>Unread / New</option>
                                <option value="read" {{ $status === 'read' ? 'selected' : '' }}>Read</option>
                            </select>
                        </div>

                        <!-- Per Page (Default 10 items) -->
                        <div>
                            <label class="block text-[10px] font-mono uppercase tracking-wider text-slate-400 mb-1">Items
                                Per Page</label>
                            <select name="per_page" onchange="this.form.submit()"
                                class="w-full px-3 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 Per Page (Default)
                                </option>
                                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 Per Page</option>
                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50 Per Page</option>
                                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100 Per Page</option>
                            </select>
                        </div>
                    </form>
                </div>

                <!-- Messages Table Card (Gmail-Style Dark Mode Inbox) -->
                <div class="p-4 sm:p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-3">

                    <!-- Top List Toolbar -->
                    <div class="flex flex-wrap items-center justify-between gap-3 px-3 py-2 border-b border-white/5 bg-white/[0.01] rounded-t-2xl">
                        <div class="flex items-center gap-2.5 sm:gap-3">
                            <!-- Master Select All Checkbox -->
                            <div class="flex items-center">
                                <input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)"
                                    class="w-4 h-4 rounded border-white/20 bg-black/40 text-indigo-500 focus:ring-0 focus:ring-offset-0 cursor-pointer"
                                    title="Select all messages on this page">
                            </div>

                            <!-- Refresh Button -->
                            <a href="{{ url()->full() }}" title="Refresh mailbox"
                                class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/10 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </a>

                            <!-- Folder Header Name (Requested: Header Name of Top) -->
                            <div class="flex items-center gap-2 pl-2 border-l border-white/10">
                                <span class="text-xs sm:text-sm font-bold text-white tracking-tight flex items-center gap-2">
                                    @if ($currentType === 'inbox')
                                        <span>📥 Inbox</span>
                                        @if ($counts['unread_inbox'] > 0)
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-amber-500/20 text-amber-300 border border-amber-500/30">
                                                {{ $counts['unread_inbox'] }} New
                                            </span>
                                        @endif
                                    @elseif($currentType === 'sent')
                                        <span>📤 Sent Correspondence</span>
                                    @elseif($currentType === 'draft')
                                        <span>📝 Drafts</span>
                                    @elseif($currentType === 'important')
                                        <span>⭐ Important &bull; VIP</span>
                                    @elseif($currentType === 'trash')
                                        <span>🗑️ Trash Bin</span>
                                    @else
                                        <span>📬 All Mail</span>
                                    @endif
                                </span>
                            </div>

                            <!-- Batch Actions Bar (Hidden by default, shown when 1+ selected) -->
                            <div id="batch_actions_bar" class="hidden items-center gap-1.5 pl-2 border-l border-white/10">
                                <span id="batch_selected_count"
                                    class="text-[11px] font-mono px-2 py-0.5 rounded-md bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 font-bold">
                                    0 selected
                                </span>

                                <button type="button" onclick="executeBatchAction('mark_read')"
                                    title="Mark selected as read"
                                    class="p-1.5 rounded-lg text-slate-300 hover:text-white hover:bg-white/10 transition-colors cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5" />
                                    </svg>
                                </button>

                                <button type="button" onclick="executeBatchAction('mark_unread')"
                                    title="Mark selected as unread"
                                    class="p-1.5 rounded-lg text-slate-300 hover:text-white hover:bg-white/10 transition-colors cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </button>

                                @if ($currentType === 'trash')
                                    <button type="button" onclick="executeBatchAction('restore')"
                                        title="Restore selected"
                                        class="p-1.5 rounded-lg text-emerald-400 hover:bg-emerald-500/10 transition-colors cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                    </button>

                                    <button type="button" onclick="executeBatchAction('force_delete')"
                                        title="Delete permanently"
                                        class="p-1.5 rounded-lg text-rose-400 hover:bg-rose-500/10 transition-colors cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                @else
                                    <button type="button" onclick="executeBatchAction('trash')"
                                        title="Move selected to Trash"
                                        class="p-1.5 rounded-lg text-rose-400 hover:bg-rose-500/10 transition-colors cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>

                        <!-- Right Folder Title & Trash Emptying -->
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-mono text-slate-400">
                                @if ($messages->total() > 0)
                                    {{ $messages->firstItem() }}-{{ $messages->lastItem() }} of {{ $messages->total() }}
                                @else
                                    0 of 0
                                @endif
                            </span>

                            @if ($currentType === 'trash' && $messages->total() > 0)
                                <form action="{{ route('admin.messages.emptyTrash') }}" method="POST"
                                    onsubmit="return confirm('Empty the entire Trash? All soft-deleted messages will be permanently erased.')">
                                    @csrf
                                    <button type="submit"
                                        class="px-2.5 py-1 rounded-lg text-[11px] font-mono font-bold bg-rose-500/20 text-rose-300 hover:bg-rose-500 hover:text-white border border-rose-500/30 transition-all flex items-center gap-1 cursor-pointer">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>Empty Trash</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <!-- Gmail-Style Message Row List Container -->
                    <div id="messages_list_container"
                        class="divide-y divide-white/[0.06] border border-white/10 rounded-2xl overflow-hidden bg-[#070d18]/60 backdrop-blur-sm">
                        @forelse($messages as $msg)
                            @php
                                $isToday = $msg->created_at->isToday();
                                $isThisYear = $msg->created_at->isCurrentYear();
                                if ($isToday) {
                                    $displayDate = $msg->created_at->format('g:i A');
                                } elseif ($isThisYear) {
                                    $displayDate = $msg->created_at->format('M d');
                                } else {
                                    $displayDate = $msg->created_at->format('m/d/Y');
                                }
                            @endphp

                            <div class="message-row group relative flex items-center gap-2.5 sm:gap-3.5 px-3 sm:px-4 py-3 hover:bg-white/[0.04] transition-colors cursor-pointer select-none {{ !$msg->is_read && $msg->type === 'inbox' ? 'bg-indigo-500/[0.03] is-unread' : 'is-read' }}"
                                id="msg_row_{{ $msg->id }}" data-id="{{ $msg->id }}"
                                onclick="handleRowClick(event, '{{ route('admin.messages.show', $msg) }}')">

                                <!-- 1. Checkbox (Left draggable icon completely removed) -->
                                <input type="checkbox" value="{{ $msg->id }}"
                                    class="msg-checkbox w-4 h-4 rounded border-white/20 bg-black/40 text-indigo-500 focus:ring-0 focus:ring-offset-0 cursor-pointer shrink-0"
                                    onclick="event.stopPropagation();" onchange="updateBatchToolbar()">

                                <!-- 2. Star / Important Toggle Button -->
                                <button type="button"
                                    onclick="event.stopPropagation(); toggleMessageImportant({{ $msg->id }}, this)"
                                    title="{{ $msg->isImportant() ? 'Remove from Important' : 'Mark as Important (Applies to all mail from this sender)' }}"
                                    class="star-toggle-btn p-1 rounded hover:bg-white/10 transition-transform active:scale-90 cursor-pointer shrink-0">
                                    <svg class="w-4 h-4 {{ $msg->isImportant() ? 'text-yellow-400 fill-yellow-400' : 'text-slate-600 hover:text-slate-400' }}"
                                        fill="{{ $msg->isImportant() ? 'currentColor' : 'none' }}" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.784.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </button>

                                <!-- 3. Sender Column (Fixed Width Truncate) -->
                                <div class="w-28 sm:w-40 md:w-44 shrink-0 truncate flex items-center gap-1.5">
                                    @if ($msg->type === 'sent')
                                        <span class="sender-name font-semibold text-slate-200 truncate">me</span>
                                        <span
                                            class="text-[9px] font-mono uppercase px-1.5 py-0.2 rounded bg-emerald-500/15 text-emerald-400 border border-emerald-500/25 shrink-0">Sent</span>
                                    @elseif($msg->type === 'draft')
                                        <span class="sender-name font-semibold text-rose-400 truncate">Draft</span>
                                        <span class="text-[9px] font-mono text-slate-400 truncate hidden md:inline">to:
                                            {{ $msg->email }}</span>
                                    @else
                                        <span
                                            class="sender-name truncate {{ !$msg->is_read ? 'text-white font-bold' : 'text-slate-300 font-medium' }}">
                                            {{ $msg->name ?: 'Visitor' }}
                                        </span>
                                        @if (!$msg->is_read)
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 shrink-0"
                                                title="Unread"></span>
                                        @endif
                                    @endif
                                </div>

                                <!-- 4. Subject (Line 1) & Preview Snippet (Line 2) in Two Lines -->
                                <div class="flex-1 min-w-0 flex flex-col justify-center mr-2 sm:mr-4 overflow-hidden py-0.5">
                                    <!-- Line 1: Subject -->
                                    <div class="flex items-center gap-1.5 truncate">
                                        @if (str_starts_with(trim($msg->subject ?? ''), '🚀'))
                                            <span class="select-none text-xs">🚀</span>
                                        @elseif (str_starts_with(trim($msg->subject ?? ''), '⚠️') || str_starts_with(trim($msg->subject ?? ''), '[Maintenance'))
                                            <span class="select-none text-xs">⚠️</span>
                                        @endif

                                        <span
                                            class="subject-text truncate text-xs {{ !$msg->is_read && $msg->type === 'inbox' ? 'text-white font-bold' : 'text-slate-200 font-semibold' }}">
                                            {{ $msg->subject ?: ($msg->service_type ?: '(No Subject)') }}
                                        </span>
                                    </div>

                                    <!-- Line 2: Message preview snippet -->
                                    <div class="snippet-text truncate text-[11px] text-slate-400 font-normal font-sans opacity-85 mt-0.5">
                                        {{ Str::limit(strip_tags($msg->message), 140) }}
                                    </div>
                                </div>

                                <!-- 5. Right End: Timestamp by Default, Hover Action Buttons on Mouse Over (FIXED POSITION - ZERO JUMPING) -->
                                <div class="w-32 sm:w-36 shrink-0 relative h-8 flex items-center justify-end">

                                    <!-- DEFAULT STATE: Timestamp (Visible normally, FADES OUT on hover with ZERO layout shift) -->
                                    <span
                                        class="msg-time absolute right-0 text-[11px] font-mono text-slate-400 group-hover:opacity-0 transition-opacity duration-150 pointer-events-none whitespace-nowrap">
                                        {{ $displayDate }}
                                    </span>

                                    <!-- HOVER STATE: Action Buttons (Hidden normally, FADES IN on hover in exact spot with ZERO layout shift) -->
                                    <div class="msg-actions absolute right-0 flex items-center gap-1 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-opacity duration-150"
                                        onclick="event.stopPropagation()">
                                        @if ($msg->trashed())
                                            <!-- Trash Mode: Restore Button -->
                                            <button type="button" onclick="restoreSingleMessage({{ $msg->id }})"
                                                title="Restore message to mailbox"
                                                class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg flex items-center justify-center text-emerald-400 hover:text-white hover:bg-emerald-500/20 transition-all cursor-pointer">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                            </button>

                                            <!-- Trash Mode: Force Delete Permanently -->
                                            <button type="button"
                                                onclick="forceDeleteSingleMessage({{ $msg->id }})"
                                                title="Delete permanently"
                                                class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg flex items-center justify-center text-rose-400 hover:text-white hover:bg-rose-500/20 transition-all cursor-pointer">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        @else
                                            <!-- 1. Archive / View Details -->
                                            <a href="{{ route('admin.messages.show', $msg) }}"
                                                title="View message details"
                                                class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-white hover:bg-white/10 transition-all cursor-pointer">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                                </svg>
                                            </a>

                                            <!-- 2. Delete / Move to Trash -->
                                            <button type="button" onclick="deleteSingleMessage({{ $msg->id }})"
                                                title="Move to Trash"
                                                class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 transition-all cursor-pointer">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>

                                            <!-- 3. Mark as Read / Unread -->
                                            <button type="button" onclick="toggleMessageRead({{ $msg->id }}, this)"
                                                title="{{ $msg->is_read ? 'Mark as Unread' : 'Mark as Read' }}"
                                                class="read-toggle-btn w-7 h-7 sm:w-8 sm:h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-indigo-400 hover:bg-indigo-500/10 transition-all cursor-pointer">
                                                @if ($msg->is_read)
                                                    <!-- Closed envelope icon (to mark as unread) -->
                                                    <svg class="w-4 h-4 envelope-icon" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                @else
                                                    <!-- Open envelope icon with dot (to mark as read) -->
                                                    <svg class="w-4 h-4 envelope-icon text-indigo-400" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5" />
                                                    </svg>
                                                @endif
                                            </button>

                                            <!-- 4. Quick Reply via Composer -->
                                            <button type="button"
                                                onclick="openReplyComposer('{{ e($msg->email) }}', '{{ e($msg->name) }}', 'Re: {{ e($msg->subject ?: 'Inquiry') }}', '{{ $msg->id }}')"
                                                title="Quick Reply via Email"
                                                class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-emerald-400 hover:bg-emerald-500/10 transition-all cursor-pointer">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        @empty
                            <div class="py-14 text-center text-slate-400 font-mono">
                                <div
                                    class="w-12 h-12 mx-auto mb-3 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-xl text-slate-400">
                                    @if ($currentType === 'trash')
                                        🗑️
                                    @elseif($currentType === 'draft')
                                        📝
                                    @elseif($currentType === 'sent')
                                        📤
                                    @elseif($currentType === 'important')
                                        ⭐
                                    @else
                                        📥
                                    @endif
                                </div>
                                <p class="text-sm font-semibold text-white">No messages found in {{ ucfirst($currentType) }}</p>
                                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                                    @if (!empty($search))
                                        No results match your search keywords.
                                    @elseif($currentType === 'trash')
                                        Your trash folder is completely clean and empty.
                                    @elseif($currentType === 'draft')
                                        Autosaved drafts from the composer will appear here.
                                    @else
                                        No visitor inquiries have been received yet.
                                    @endif
                                </p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination Container (Tailwind Pro-Grade Pagination) -->
                    @if ($messages->hasPages() || $messages->total() > 0)
                        <div
                            class="pt-3 border-t border-white/5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs font-mono text-slate-400">
                            <div>
                                Showing <span class="text-white font-bold">{{ $messages->firstItem() ?? 0 }}</span>
                                to <span class="text-white font-bold">{{ $messages->lastItem() ?? 0 }}</span>
                                of <span class="text-white font-bold">{{ $messages->total() }}</span> messages
                                (Page {{ $messages->currentPage() }} of {{ $messages->lastPage() }})
                            </div>
                            <div>
                                {{ $messages->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- =====================================================================
                                             RIGHT SIDEBAR: Mailbox Folders Menu & Quick Composer Trigger
                                             ===================================================================== -->
            <div class="lg:col-span-1 space-y-5">

                <!-- Primary Compose Button Card -->
                <button type="button" onclick="openNewComposer()"
                    class="w-full py-3.5 px-5 rounded-2xl font-black text-xs uppercase tracking-wider bg-gradient-to-r from-indigo-600 via-indigo-500 to-indigo-600 hover:from-indigo-500 hover:to-indigo-400 text-white shadow-xl shadow-indigo-600/30 flex items-center justify-center gap-2.5 transition-all hover:scale-[1.02] active:scale-[0.98] cursor-pointer">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    <span> Compose New Mail</span>
                </button>

                <!-- Mailbox Navigation Sidebar Menu -->
                <div class="p-5 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-2">
                    <div
                        class="px-2 pb-2 text-[10px] font-mono uppercase tracking-widest text-slate-500 border-b border-white/5 flex items-center justify-between">
                        <span>Mailbox Folders</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"
                            title="Connected to Mail Server"></span>
                    </div>

                    <nav class="space-y-1 pt-1 font-mono text-xs">
                        <!-- 1. Inbox -->
                        <a href="{{ route('admin.messages.index', ['type' => 'inbox']) }}"
                            class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all {{ $currentType === 'inbox' ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30 font-bold shadow-sm' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <div class="flex items-center gap-2.5">
                                <span class="text-base">📥</span>
                                <span>Inbox</span>
                            </div>
                            @if ($counts['unread_inbox'] > 0)
                                <span
                                    class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/20 text-amber-300 border border-amber-500/30">
                                    {{ $counts['unread_inbox'] }}
                                </span>
                            @else
                                <span class="text-[11px] text-slate-500">{{ $counts['inbox'] }}</span>
                            @endif
                        </a>

                        <!-- 2. Draft -->
                        <a href="{{ route('admin.messages.index', ['type' => 'draft']) }}"
                            class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all {{ $currentType === 'draft' ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30 font-bold shadow-sm' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <div class="flex items-center gap-2.5">
                                <span class="text-base">📝</span>
                                <span>Draft</span>
                            </div>
                            <span
                                class="text-[11px] {{ $counts['draft'] > 0 ? 'text-indigo-400 font-bold' : 'text-slate-500' }}">
                                {{ $counts['draft'] }}
                            </span>
                        </a>

                        <!-- 3. Sent -->
                        <a href="{{ route('admin.messages.index', ['type' => 'sent']) }}"
                            class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all {{ $currentType === 'sent' ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30 font-bold shadow-sm' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <div class="flex items-center gap-2.5">
                                <span class="text-base">📤</span>
                                <span>Sent</span>
                            </div>
                            <span class="text-[11px] text-slate-500">{{ $counts['sent'] }}</span>
                        </a>

                        <!-- 4. Important -->
                        <a href="{{ route('admin.messages.index', ['type' => 'important']) }}"
                            class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all {{ $currentType === 'important' ? 'bg-yellow-500/15 text-yellow-300 border border-yellow-500/30 font-bold shadow-sm' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <div class="flex items-center gap-2.5">
                                <span class="text-base">⭐</span>
                                <span>Important</span>
                            </div>
                            <span
                                class="text-[11px] {{ $counts['important'] > 0 ? 'text-yellow-400 font-bold' : 'text-slate-500' }}">
                                {{ $counts['important'] }}
                            </span>
                        </a>

                        <!-- 5. All Mail -->
                        <a href="{{ route('admin.messages.index', ['type' => 'all']) }}"
                            class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all {{ $currentType === 'all' ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30 font-bold shadow-sm' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <div class="flex items-center gap-2.5">
                                <span class="text-base">📬</span>
                                <span>All Mail</span>
                            </div>
                            <span class="text-[11px] text-slate-500">{{ $counts['all'] }}</span>
                        </a>

                        <!-- 6. Trash (Active SoftDelete) -->
                        <a href="{{ route('admin.messages.index', ['type' => 'trash']) }}"
                            class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all {{ $currentType === 'trash' ? 'bg-rose-500/15 text-rose-300 border border-rose-500/30 font-bold shadow-sm' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <div class="flex items-center gap-2.5">
                                <span class="text-base">🗑️</span>
                                <span>Trash</span>
                            </div>
                            <span
                                class="text-[11px] {{ $counts['trash'] > 0 ? 'text-rose-400 font-bold' : 'text-slate-500' }}">
                                {{ $counts['trash'] }}
                            </span>
                        </a>
                    </nav>
                </div>

                <!-- Background Queue & Autosave Diagnostics Card -->
                <div class="p-5 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-3 text-xs">
                    <div
                        class="text-[10px] font-mono uppercase tracking-widest text-slate-400 flex items-center justify-between">
                        <span>System Sync</span>
                        <span class="text-emerald-400">Live</span>
                    </div>
                    <div class="space-y-2 text-[11px] font-mono text-slate-400">
                        <div class="flex items-center justify-between">
                            <span>Autosave Draft:</span>
                            <span class="text-emerald-400 font-bold">Keyup Enabled</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Background Queue:</span>
                            <span class="text-emerald-400 font-bold">Active Jobs</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>SoftDelete:</span>
                            <span class="text-emerald-400 font-bold">Active</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- =========================================================================
                                     POPUP EMAIL COMPOSER (Supports Temporary ID Autosave & Background Queue)
                                     ========================================================================= -->
    <div id="mail_composer_modal" class="hidden fixed z-50 transition-all duration-200">
        <div id="composer_window"
            class="w-[580px] max-w-[95vw] rounded-t-2xl shadow-2xl border flex flex-col font-sans overflow-hidden transition-all duration-200 composer-dark">

            <!-- Window Title Bar -->
            <div id="composer_header"
                class="px-4 py-2.5 flex items-center justify-between border-b select-none cursor-pointer"
                onclick="handleHeaderBarClick(event)">
                <div class="flex items-center gap-2 overflow-hidden">
                    <span class="text-xs sm:text-sm font-semibold composer-title" id="composer_modal_title">New
                        Message</span>
                    <span id="composer_autosave_badge"
                        class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 hidden">
                        Saved
                    </span>
                    <span id="composer_minimized_snippet" class="hidden text-xs truncate max-w-[240px] opacity-70"></span>
                </div>
                <div class="flex items-center gap-1 composer-header-actions">
                    <!-- Theme Toggle -->
                    <button type="button" onclick="toggleComposerTheme(event)" title="Toggle Dark/Light Theme"
                        class="w-7 h-7 flex items-center justify-center rounded transition-colors cursor-pointer">
                        <svg id="theme_icon_sun" class="w-3.5 h-3.5 text-amber-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg id="theme_icon_moon" class="w-3.5 h-3.5 text-slate-600 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>
                    <!-- Minimize -->
                    <button type="button" onclick="toggleMinimizeComposer(event)" title="Minimize"
                        class="w-7 h-7 flex items-center justify-center rounded transition-colors cursor-pointer">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                    </button>
                    <!-- Maximize -->
                    <button type="button" onclick="toggleMaximizeComposer(event)" title="Full screen"
                        class="w-7 h-7 flex items-center justify-center rounded transition-colors cursor-pointer">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <polyline points="9 21 3 21 3 15"></polyline>
                        </svg>
                    </button>
                    <!-- Close -->
                    <button type="button" onclick="closeComposer(event)" title="Close"
                        class="w-7 h-7 flex items-center justify-center rounded transition-colors cursor-pointer">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Composer Body -->
            <div id="composer_body_section" class="flex flex-col">
                <form id="mail_composer_form" onsubmit="sendComposerMail(event)" class="flex flex-col">
                    @csrf
                    <!-- Hidden Temporary ID for keyup Autosave -->
                    <input type="hidden" name="temp_id" id="composer_temp_id" value="">
                    <input type="hidden" name="message_id" id="composer_reply_message_id" value="">

                    <!-- To Row -->
                    <div id="row_to" class="px-4 py-2 border-b flex items-center gap-2">
                        <span class="text-xs font-medium select-none w-8 composer-label">To</span>
                        <input type="email" name="to" id="composer_to_input" required
                            placeholder="Recipient email address"
                            class="flex-1 bg-transparent text-xs sm:text-sm border-0 focus:outline-none focus:ring-0 p-0 composer-input"
                            onkeyup="triggerDebouncedAutosave()">
                        <div class="flex items-center gap-2 text-xs select-none composer-label">
                            <button type="button" onclick="toggleCcRow()"
                                class="hover:underline font-medium cursor-pointer">Cc</button>
                            <button type="button" onclick="toggleBccRow()"
                                class="hover:underline font-medium cursor-pointer">Bcc</button>
                        </div>
                    </div>

                    <!-- Cc Row -->
                    <div id="composer_cc_row" class="hidden px-4 py-1.5 border-b flex items-center gap-2">
                        <span class="text-xs font-medium select-none w-8 composer-label">Cc</span>
                        <input type="text" name="cc" id="composer_cc_input"
                            placeholder="Recipients (comma separated)"
                            class="flex-1 bg-transparent text-xs sm:text-sm border-0 focus:outline-none focus:ring-0 p-0 composer-input"
                            onkeyup="triggerDebouncedAutosave()">
                    </div>

                    <!-- Bcc Row -->
                    <div id="composer_bcc_row" class="hidden px-4 py-1.5 border-b flex items-center gap-2">
                        <span class="text-xs font-medium select-none w-8 composer-label">Bcc</span>
                        <input type="text" name="bcc" id="composer_bcc_input"
                            placeholder="Recipients (comma separated)"
                            class="flex-1 bg-transparent text-xs sm:text-sm border-0 focus:outline-none focus:ring-0 p-0 composer-input"
                            onkeyup="triggerDebouncedAutosave()">
                    </div>

                    <!-- Subject Row -->
                    <div id="row_subject" class="px-4 py-2 border-b">
                        <input type="text" name="subject" id="composer_subject_input" required placeholder="Subject"
                            class="w-full bg-transparent text-xs sm:text-sm border-0 focus:outline-none focus:ring-0 p-0 font-medium composer-input"
                            onkeyup="triggerDebouncedAutosave()">
                    </div>

                    <!-- Message Body -->
                    <div id="row_body" class="p-4 flex-1">
                        <textarea name="body" id="composer_text_body" rows="9" required
                            class="w-full border-0 focus:outline-none focus:ring-0 p-0 text-xs sm:text-sm leading-relaxed resize-none font-sans composer-textarea"
                            placeholder="Write your email here..." onkeyup="triggerDebouncedAutosave()"></textarea>
                    </div>

                    <!-- Attachment preview chip -->
                    <div id="attachment_preview_chip"
                        class="hidden px-4 py-2 border-t flex items-center justify-between text-xs composer-chip">
                        <div class="flex items-center gap-2 truncate">
                            <svg class="w-3.5 h-3.5 text-blue-500 shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg>
                            <span id="attachment_name" class="font-medium truncate max-w-[280px]">file.pdf</span>
                            <span id="attachment_size" class="text-[10px] opacity-60 font-mono"></span>
                        </div>
                        <button type="button" onclick="removeAttachment()" title="Remove file"
                            class="opacity-60 hover:opacity-100 hover:text-rose-400 text-xs px-1 font-bold cursor-pointer">&times;</button>
                    </div>

                    <!-- Footer Toolbar -->
                    <div id="composer_footer" class="px-4 py-3 border-t flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <button type="submit" id="send_submit_btn"
                                class="px-5 py-2 text-xs sm:text-sm font-semibold rounded-full bg-[#0b57d0] hover:bg-[#0842a0] text-white shadow-md transition-all flex items-center gap-1.5 cursor-pointer">
                                <span id="send_btn_label">Send</span>
                                <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </button>

                            <!-- Attach file button -->
                            <button type="button" onclick="triggerAttachmentPicker()" title="Attach file"
                                class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer composer-icon-btn">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                            </button>
                            <input type="file" id="composer_attachment_input" name="attachment" class="hidden"
                                onchange="handleAttachmentSelected(this)">

                            <span id="autosave_status_text"
                                class="text-[11px] font-mono text-slate-500 hidden sm:inline-block"></span>
                        </div>

                        <!-- Delete draft button -->
                        <button type="button" onclick="discardComposerDraft()" title="Discard draft"
                            class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer composer-icon-btn hover:text-rose-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let isComposerMinimized = false;
            let isComposerMaximized = false;
            let autosaveTimer = null;

            function generateTempId() {
                return 'temp_' + Date.now() + '_' + Math.random().toString(36).substring(2, 9);
            }

            function openNewComposer() {
                const modal = document.getElementById('mail_composer_modal');
                const win = document.getElementById('composer_window');
                const bodySection = document.getElementById('composer_body_section');
                const snippet = document.getElementById('composer_minimized_snippet');

                document.getElementById('mail_composer_form').reset();
                document.getElementById('composer_temp_id').value = generateTempId();
                document.getElementById('composer_reply_message_id').value = '';
                document.getElementById('composer_modal_title').textContent = 'New Message';
                document.getElementById('composer_autosave_badge').classList.add('hidden');
                document.getElementById('attachment_preview_chip').classList.add('hidden');

                modal.classList.remove('hidden');
                modal.className = 'fixed bottom-0 right-4 sm:right-8 z-50 transition-all duration-200';
                win.classList.remove('w-72');
                win.classList.add('w-[580px]');
                bodySection.classList.remove('hidden');
                snippet.classList.add('hidden');
                isComposerMinimized = false;
                isComposerMaximized = false;

                setTimeout(() => {
                    document.getElementById('composer_to_input')?.focus();
                }, 150);
            }

            function openReplyComposer(email, name, subject, messageId) {
                openNewComposer();
                document.getElementById('composer_to_input').value = email;
                document.getElementById('composer_subject_input').value = subject;
                document.getElementById('composer_reply_message_id').value = messageId;
                document.getElementById('composer_modal_title').textContent = 'Reply to ' + name;
                document.getElementById('composer_text_body').value =
                    `Hi ${name},\n\nThank you for reaching out!\n\n\nBest regards,\n{{ auth()->user()->name ?? 'Alex Rivera' }}`;

                triggerDebouncedAutosave();

                setTimeout(() => {
                    document.getElementById('composer_text_body')?.focus();
                }, 150);
            }

            function closeComposer(e) {
                if (e) e.stopPropagation();
                document.getElementById('mail_composer_modal').classList.add('hidden');
            }

            function toggleMinimizeComposer(e) {
                if (e) e.stopPropagation();
                const win = document.getElementById('composer_window');
                const bodySection = document.getElementById('composer_body_section');
                const snippet = document.getElementById('composer_minimized_snippet');
                const toInput = document.getElementById('composer_to_input');

                if (!isComposerMinimized) {
                    bodySection.classList.add('hidden');
                    snippet.textContent = '— ' + (toInput.value || 'Draft');
                    snippet.classList.remove('hidden');
                    win.classList.remove('w-[580px]');
                    win.classList.add('w-72');
                    isComposerMinimized = true;
                } else {
                    bodySection.classList.remove('hidden');
                    snippet.classList.add('hidden');
                    win.classList.remove('w-72');
                    win.classList.add('w-[580px]');
                    isComposerMinimized = false;
                }
            }

            function handleHeaderBarClick(e) {
                if (isComposerMinimized) {
                    toggleMinimizeComposer(e);
                }
            }

            function toggleMaximizeComposer(e) {
                if (e) e.stopPropagation();
                const modal = document.getElementById('mail_composer_modal');
                const win = document.getElementById('composer_window');
                const bodySection = document.getElementById('composer_body_section');
                const snippet = document.getElementById('composer_minimized_snippet');

                if (isComposerMinimized) {
                    bodySection.classList.remove('hidden');
                    snippet.classList.add('hidden');
                    isComposerMinimized = false;
                }

                if (!isComposerMaximized) {
                    modal.className =
                        'fixed inset-4 sm:inset-10 z-50 flex items-center justify-center transition-all duration-200';
                    win.className =
                        'w-full h-full max-w-4xl rounded-2xl shadow-2xl border flex flex-col font-sans overflow-hidden transition-all duration-200 ' +
                        (win.classList.contains('composer-light') ? 'composer-light' : 'composer-dark');
                    isComposerMaximized = true;
                } else {
                    modal.className = 'fixed bottom-0 right-4 sm:right-8 z-50 transition-all duration-200';
                    win.className =
                        'w-[580px] max-w-[95vw] rounded-t-2xl shadow-2xl border flex flex-col font-sans overflow-hidden transition-all duration-200 ' +
                        (win.classList.contains('composer-light') ? 'composer-light' : 'composer-dark');
                    isComposerMaximized = false;
                }
            }

            function toggleCcRow() {
                const row = document.getElementById('composer_cc_row');
                row.classList.toggle('hidden');
                if (!row.classList.contains('hidden')) {
                    document.getElementById('composer_cc_input').focus();
                }
            }

            function toggleBccRow() {
                const row = document.getElementById('composer_bcc_row');
                row.classList.toggle('hidden');
                if (!row.classList.contains('hidden')) {
                    document.getElementById('composer_bcc_input').focus();
                }
            }

            function triggerAttachmentPicker() {
                document.getElementById('composer_attachment_input').click();
            }

            function handleAttachmentSelected(input) {
                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const chip = document.getElementById('attachment_preview_chip');
                    document.getElementById('attachment_name').textContent = file.name;
                    document.getElementById('attachment_size').textContent = `(${ (file.size / 1024).toFixed(1) } KB)`;
                    chip.classList.remove('hidden');
                }
            }

            function removeAttachment() {
                document.getElementById('composer_attachment_input').value = '';
                document.getElementById('attachment_preview_chip').classList.add('hidden');
            }

            function discardComposerDraft() {
                if (confirm('Discard this composer draft?')) {
                    closeComposer();
                    removeAttachment();
                }
            }

            // Keyup Autosave with Temporary ID
            function triggerDebouncedAutosave() {
                clearTimeout(autosaveTimer);
                const statusText = document.getElementById('autosave_status_text');
                statusText.textContent = 'Saving draft...';
                statusText.classList.remove('hidden');

                autosaveTimer = setTimeout(async () => {
                    const tempId = document.getElementById('composer_temp_id').value;
                    if (!tempId) return;

                    const to = document.getElementById('composer_to_input').value;
                    const subject = document.getElementById('composer_subject_input').value;
                    const body = document.getElementById('composer_text_body').value;

                    try {
                        const res = await fetch("{{ route('admin.messages.autosaveDraft') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                temp_id: tempId,
                                to: to,
                                subject: subject,
                                body: body
                            })
                        });

                        const data = await res.json();
                        if (data.success) {
                            statusText.textContent = `Draft saved at ${data.saved_at}`;
                            const badge = document.getElementById('composer_autosave_badge');
                            badge.classList.remove('hidden');
                        }
                    } catch (err) {
                        statusText.textContent = 'Autosave paused';
                    }
                }, 600);
            }

            // Send Mail (Queued in Background, Removes temp_id, Sets type to 'sent')
            async function sendComposerMail(e) {
                e.preventDefault();

                const sendBtn = document.getElementById('send_submit_btn');
                const btnLabel = document.getElementById('send_btn_label');

                const tempId = document.getElementById('composer_temp_id').value;
                const messageId = document.getElementById('composer_reply_message_id').value;
                const to = document.getElementById('composer_to_input').value;
                const subject = document.getElementById('composer_subject_input').value;
                const body = document.getElementById('composer_text_body').value;
                const cc = document.getElementById('composer_cc_input')?.value || '';
                const bcc = document.getElementById('composer_bcc_input')?.value || '';

                const formData = new FormData();
                formData.append('temp_id', tempId);
                formData.append('to', to);
                formData.append('subject', subject);
                formData.append('body', body);
                formData.append('cc', cc);
                formData.append('bcc', bcc);

                const fileInput = document.getElementById('composer_attachment_input');
                if (fileInput && fileInput.files[0]) {
                    formData.append('attachment', fileInput.files[0]);
                }

                sendBtn.disabled = true;
                btnLabel.innerHTML =
                    `<svg class="animate-spin h-3.5 w-3.5 text-white inline-block mr-1" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg> Queueing...`;

                const targetUrl = messageId ? `{{ url('admin/messages') }}/${messageId}/reply` :
                    `{{ route('admin.messages.sendCompose') }}`;

                try {
                    const response = await fetch(targetUrl, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        closeComposer();
                        removeAttachment();

                        // Show toastr notification
                        if (typeof toastr !== 'undefined') {
                            toastr.success(data.message || 'Email queued successfully!');
                        }

                        // Refresh table to reflect sent mail
                        setTimeout(() => {
                            window.location.reload();
                        }, 800);
                    } else {
                        throw new Error(data.message || 'Failed to queue email.');
                    }
                } catch (err) {
                    alert(err.message || 'Email sending failed.');
                } finally {
                    sendBtn.disabled = false;
                    btnLabel.textContent = 'Send';
                }
            }

            // Toggle Important Star on Row
            async function toggleMessageImportant(id, btn) {
                try {
                    const res = await fetch(`{{ url('admin/messages') }}/${id}/toggle-important`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await res.json();
                    if (data.success) {
                        const svg = btn.querySelector('svg');
                        if (data.is_important) {
                            svg.className.baseVal = 'w-4 h-4 text-yellow-400 fill-yellow-400';
                            svg.setAttribute('fill', 'currentColor');
                        } else {
                            svg.className.baseVal = 'w-4 h-4 text-slate-600 hover:text-slate-400';
                            svg.setAttribute('fill', 'none');
                        }

                        if (typeof toastr !== 'undefined') {
                            toastr.info(data.message);
                        }
                    }
                } catch (err) {
                    console.error('Error toggling importance:', err);
                }
            }

            // Theme toggle in composer
            function setComposerTheme(theme) {
                const win = document.getElementById('composer_window');
                const sun = document.getElementById('theme_icon_sun');
                const moon = document.getElementById('theme_icon_moon');

                if (theme === 'light') {
                    win.classList.remove('composer-dark');
                    win.classList.add('composer-light');
                    sun?.classList.add('hidden');
                    moon?.classList.remove('hidden');
                    localStorage.setItem('composer_theme', 'light');
                } else {
                    win.classList.remove('composer-light');
                    win.classList.add('composer-dark');
                    sun?.classList.remove('hidden');
                    moon?.classList.add('hidden');
                    localStorage.setItem('composer_theme', 'dark');
                }
            }

            function toggleComposerTheme(e) {
                if (e) e.stopPropagation();
                const win = document.getElementById('composer_window');
                const current = win.classList.contains('composer-light') ? 'light' : 'dark';
                setComposerTheme(current === 'light' ? 'dark' : 'light');
            }

            document.addEventListener('DOMContentLoaded', () => {
                const saved = localStorage.getItem('composer_theme') || 'dark';
                setComposerTheme(saved);
            });

            // Navigate to message on row click (ignore clicks on interactive child elements)
            function handleRowClick(e, url) {
                if (e.target.closest('button, input, a, form, .msg-actions, .star-toggle-btn')) {
                    return;
                }
                window.location.href = url;
            }

            // Master Select All Checkbox
            function toggleSelectAll(master) {
                const checkboxes = document.querySelectorAll('.msg-checkbox');
                checkboxes.forEach(cb => {
                    cb.checked = master.checked;
                    const row = cb.closest('.message-row');
                    if (row) {
                        if (master.checked) {
                            row.classList.add('bg-indigo-950/30');
                        } else {
                            row.classList.remove('bg-indigo-950/30');
                        }
                    }
                });
                updateBatchToolbar();
            }

            // Update Batch Actions Toolbar visibility and count
            function updateBatchToolbar() {
                const checked = document.querySelectorAll('.msg-checkbox:checked');
                const bar = document.getElementById('batch_actions_bar');
                const countBadge = document.getElementById('batch_selected_count');
                const master = document.getElementById('selectAllCheckbox');

                if (countBadge) {
                    countBadge.textContent = `${checked.length} selected`;
                }

                if (checked.length > 0) {
                    bar?.classList.remove('hidden');
                    bar?.classList.add('flex');
                } else {
                    bar?.classList.add('hidden');
                    bar?.classList.remove('flex');
                    if (master) master.checked = false;
                }

                // Highlight selected rows
                document.querySelectorAll('.message-row').forEach(row => {
                    const cb = row.querySelector('.msg-checkbox');
                    if (cb && cb.checked) {
                        row.classList.add('bg-indigo-950/30');
                    } else {
                        row.classList.remove('bg-indigo-950/30');
                    }
                });
            }

            // Execute batch action (mark read, mark unread, trash, restore, force_delete)
            async function executeBatchAction(action) {
                const checked = Array.from(document.querySelectorAll('.msg-checkbox:checked')).map(cb => parseInt(cb
                    .value));
                if (checked.length === 0) return;

                if (action === 'force_delete' && !confirm(
                        `Permanently delete ${checked.length} selected messages? This cannot be undone.`)) {
                    return;
                }
                if (action === 'trash' && !confirm(`Move ${checked.length} selected messages to Trash?`)) {
                    return;
                }

                try {
                    const res = await fetch("{{ route('admin.messages.batch') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            ids: checked,
                            action: action
                        })
                    });

                    const data = await res.json();
                    if (data.success) {
                        if (typeof toastr !== 'undefined') {
                            toastr.success(data.message);
                        }
                        window.location.reload();
                    }
                } catch (err) {
                    console.error('Batch action error:', err);
                }
            }

            // Toggle Read / Unread Status via AJAX
            async function toggleMessageRead(id, btn) {
                try {
                    const res = await fetch(`{{ url('admin/messages') }}/${id}/toggle-read`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await res.json();
                    if (data.success) {
                        const row = document.getElementById(`msg_row_${id}`);
                        if (row) {
                            const senderName = row.querySelector('.sender-name');
                            const subjectText = row.querySelector('.subject-text');

                            if (data.is_read) {
                                row.classList.remove('bg-indigo-500/[0.03]', 'is-unread');
                                row.classList.add('is-read');
                                senderName?.classList.remove('font-bold', 'text-white');
                                senderName?.classList.add('font-medium', 'text-slate-300');
                                subjectText?.classList.remove('font-bold', 'text-white');
                                subjectText?.classList.add('font-medium', 'text-slate-200');

                                btn.title = 'Mark as Unread';
                                btn.innerHTML = `
                                    <svg class="w-4 h-4 envelope-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                `;
                            } else {
                                row.classList.add('bg-indigo-500/[0.03]', 'is-unread');
                                row.classList.remove('is-read');
                                senderName?.classList.add('font-bold', 'text-white');
                                senderName?.classList.remove('font-medium', 'text-slate-300');
                                subjectText?.classList.add('font-bold', 'text-white');
                                subjectText?.classList.remove('font-medium', 'text-slate-200');

                                btn.title = 'Mark as Read';
                                btn.innerHTML = `
                                    <svg class="w-4 h-4 envelope-icon text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5" />
                                    </svg>
                                `;
                            }
                        }

                        if (typeof toastr !== 'undefined') {
                            toastr.info(data.message);
                        }
                    }
                } catch (err) {
                    console.error('Error toggling read status:', err);
                }
            }

            // Delete single message via hover trash button (smooth fade animation)
            async function deleteSingleMessage(id) {
                if (!confirm('Move this message to Trash?')) return;

                try {
                    const res = await fetch(`{{ url('admin/messages') }}/${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            _method: 'DELETE'
                        })
                    });

                    const data = await res.json();
                    if (data.success) {
                        const row = document.getElementById(`msg_row_${id}`);
                        if (row) {
                            row.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                            row.style.opacity = '0';
                            row.style.transform = 'translateX(30px)';
                            setTimeout(() => row.remove(), 300);
                        }
                        if (typeof toastr !== 'undefined') {
                            toastr.success(data.message || 'Message moved to Trash');
                        }
                    }
                } catch (err) {
                    window.location.reload();
                }
            }

            // Restore single message from Trash
            async function restoreSingleMessage(id) {
                try {
                    const res = await fetch(`{{ url('admin/messages') }}/${id}/restore`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await res.json();
                    if (data.success) {
                        const row = document.getElementById(`msg_row_${id}`);
                        if (row) {
                            row.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                            row.style.opacity = '0';
                            row.style.transform = 'translateX(-30px)';
                            setTimeout(() => row.remove(), 300);
                        }
                        if (typeof toastr !== 'undefined') {
                            toastr.success(data.message);
                        }
                    }
                } catch (err) {
                    window.location.reload();
                }
            }

            // Force delete single message
            async function forceDeleteSingleMessage(id) {
                if (!confirm('Permanently delete this message forever? This cannot be undone.')) return;

                try {
                    const res = await fetch(`{{ url('admin/messages') }}/${id}/force-delete`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            _method: 'DELETE'
                        })
                    });

                    const data = await res.json();
                    if (data.success) {
                        const row = document.getElementById(`msg_row_${id}`);
                        if (row) {
                            row.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                            row.style.opacity = '0';
                            setTimeout(() => row.remove(), 300);
                        }
                        if (typeof toastr !== 'undefined') {
                            toastr.success(data.message);
                        }
                    }
                } catch (err) {
                    window.location.reload();
                }
            }
        </script>
    @endpush
@endsection
