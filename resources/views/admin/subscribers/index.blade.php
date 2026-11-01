@extends('admin.layout')

@section('title', 'Newsletter Subscribers')
@section('page_title', 'Subscribers')
@section('page_subtitle', 'Newsletter Audience')

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
        <!-- 1. Top Header with Stats -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl">
            <div class="space-y-1">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center border border-indigo-500/30 shadow-inner">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-black text-white tracking-tight flex items-center gap-2">
                            <span>Newsletter Subscribers</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-mono font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                                {{ $totalSubscribers }} {{ Str::plural('subscriber', $totalSubscribers) }}
                            </span>
                        </h1>
                        <p class="text-xs text-slate-400 font-mono">
                            Registered newsletter emails, host info, avatars, and audience details
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="px-3.5 py-2 rounded-xl bg-white/5 border border-white/10 text-xs font-mono text-slate-300 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Active: <strong class="text-white">{{ $activeCount }}</strong></span>
                </div>
            </div>
        </div>

        <!-- 2. Filter Bar -->
        <div class="p-5 sm:p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-white/5">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white tracking-tight">Filter Subscribers</h3>
                        <p class="text-[11px] font-mono text-slate-400">Search by email, name, host, or client IP address</p>
                    </div>
                </div>

                <button type="button" id="resetFiltersBtn" onclick="resetAllFilters()" title="Reset all filters"
                    class="{{ request('search') || (request('sort') && request('sort') !== 'latest') ? '' : 'hidden' }} text-[11px] font-mono text-indigo-400 hover:text-indigo-300 flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-indigo-500/10 border border-indigo-500/20 transition-all cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span>Reset Filters</span>
                </button>
            </div>

            <form id="filterForm" action="{{ route('admin.subscribers.index') }}" method="GET" onsubmit="event.preventDefault(); triggerFilterUpdate();">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Search Input -->
                    <div class="space-y-1.5">
                        <label for="subscriberSearchInput" class="block text-[11px] font-mono text-slate-400 uppercase tracking-wider">
                            Searchbox
                        </label>
                        <div class="relative">
                            <input type="text" id="subscriberSearchInput" name="search" value="{{ request('search') }}"
                                placeholder="Search email, name, host, IP..." autocomplete="off"
                                class="w-full bg-[#0c1424] border border-white/10 rounded-xl pl-9 pr-8 py-2.5 text-xs text-white placeholder:text-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all font-sans">
                            <svg class="w-4 h-4 text-slate-500 absolute left-3 top-3 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <button type="button" id="clearSearchBtn" onclick="clearSearch()" title="Clear search"
                                class="{{ request('search') ? '' : 'hidden' }} absolute right-2.5 top-2.5 text-slate-500 hover:text-white text-base w-5 h-5 flex items-center justify-center cursor-pointer transition-colors">
                                &times;
                            </button>
                        </div>
                    </div>

                    <!-- Sort Filter -->
                    <div class="space-y-1.5">
                        <label for="sortFilter" class="block text-[11px] font-mono text-slate-400 uppercase tracking-wider">
                            Sort Order
                        </label>
                        <div class="relative">
                            <select id="sortFilter" name="sort" onchange="triggerFilterUpdate()"
                                class="w-full bg-[#0c1424] border border-white/10 rounded-xl px-3 py-2.5 text-xs text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 font-sans cursor-pointer transition-all">
                                <option value="latest" {{ $sort === 'latest' || !$sort ? 'selected' : '' }}>Newest Subscribed First</option>
                                <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oldest Subscribed First</option>
                                <option value="name" {{ $sort === 'name' ? 'selected' : '' }}>Name (A to Z)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- 3. Datalist Card (Matching Image 1 Top & Image 2 Bottom) -->
        <div id="datalistCard" class="p-5 sm:p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
            
            <!-- Datalist Card Top: Title with Count Result (Left) & Per Page Select (Right) (Matches Image 1) -->
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
                        <h2 class="text-base font-bold text-white tracking-tight">Newsletter Subscribers</h2>
                        <span id="datalistCountBadge"
                            class="px-2.5 py-0.5 rounded-full text-xs font-mono font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                            {{ $subscribers->total() }} {{ Str::plural('result', $subscribers->total()) }}
                        </span>
                    </div>
                </div>

                <!-- Top Right: Enhanced Per Page capsule (Matches Image 1) -->
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
                                <option value="5" class="bg-[#0c1424] text-slate-200" {{ $perPage == 5 ? 'selected' : '' }}>5 / page</option>
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

            <!-- Card-Row List Container -->
            <div id="subscribersListContainer" class="space-y-3 transition-opacity duration-200">
                @forelse($subscribers as $subscriber)
                    <div class="p-4 sm:p-5 rounded-2xl bg-white/[0.02] hover:bg-white/[0.04] border border-white/5 hover:border-white/10 transition-all flex flex-col md:flex-row md:items-center justify-between gap-4 group relative">
                        <!-- Left: Avatar + Details -->
                        <div class="flex items-start md:items-center gap-3.5 flex-1 min-w-0">
                            <!-- Avatar Retrieved from Email Host / Gravatar -->
                            <div class="w-11 h-11 rounded-xl border border-white/10 bg-[#0c1424] overflow-hidden shrink-0 shadow-inner flex items-center justify-center">
                                <img src="{{ $subscriber->avatar_url }}" alt="{{ $subscriber->display_name }}"
                                    class="w-full h-full object-cover"
                                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($subscriber->display_name) }}&background=6366f1&color=fff'">
                            </div>

                            <!-- Details -->
                            <div class="space-y-1 flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="font-bold text-sm text-white">{{ $subscriber->display_name }}</span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-mono bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                        {{ $subscriber->status }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-300 font-mono flex items-center gap-2 flex-wrap">
                                    <span class="text-indigo-400 break-all">{{ $subscriber->email }}</span>
                                    @if($subscriber->email_host)
                                        <span class="text-slate-600">&bull;</span>
                                        <span class="text-slate-400 break-all">Host: {{ $subscriber->email_host }}</span>
                                    @endif
                                    @if($subscriber->ip_address)
                                        <span class="text-slate-600">&bull;</span>
                                        <span class="text-slate-500">IP: {{ $subscriber->ip_address }}</span>
                                    @endif
                                </p>
                                <div class="flex items-center gap-2 flex-wrap text-[11px] font-mono text-slate-500 pt-0.5">
                                    <span class="whitespace-nowrap">Subscribed {{ $subscriber->created_at->diffForHumans() }}</span>
                                    <span class="text-slate-600">&bull;</span>
                                    <span class="whitespace-nowrap">{{ $subscriber->created_at->format('M d, Y h:i A') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Actions -->
                        <div class="shrink-0 flex items-center gap-1.5 self-end md:self-auto">
                            <!-- Copy Email -->
                            <button type="button"
                                onclick="navigator.clipboard.writeText('{{ e($subscriber->email) }}'); alert('Email copied: {{ e($subscriber->email) }}');"
                                class="w-8 h-8 rounded-xl bg-white/5 hover:bg-white/10 text-slate-400 hover:text-white border border-white/10 flex items-center justify-center transition-all cursor-pointer"
                                title="Copy Email Address">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </button>

                            <!-- Send Mail -->
                            <a href="mailto:{{ e($subscriber->email) }}"
                                class="w-8 h-8 rounded-xl bg-indigo-500/10 hover:bg-indigo-500/20 text-indigo-300 hover:text-white border border-indigo-500/20 flex items-center justify-center transition-all cursor-pointer"
                                title="Compose Email">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="POST"
                                onsubmit="return confirm('Permanently remove subscriber [{{ $subscriber->email }}]?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-8 h-8 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/20 flex items-center justify-center transition-all cursor-pointer"
                                    title="Delete Subscriber">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="py-16 text-center rounded-3xl bg-[#09101d] border border-white/10 space-y-3">
                        <div class="w-16 h-16 rounded-full bg-white/5 border border-white/10 mx-auto flex items-center justify-center text-slate-500">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-white">No subscribers found</h3>
                        <p class="text-xs text-slate-400 font-mono max-w-sm mx-auto">
                            No newsletter subscribers match your search filter or parameters.
                        </p>
                        <button type="button" onclick="resetAllFilters()"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-indigo-500/10 hover:bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 text-xs font-mono transition-colors">
                            <span>Clear Filters</span>
                        </button>
                    </div>
                @endforelse
            </div>

            <!-- Bottom Stats & Pagination (Matches Image 2) -->
            <div class="pt-6 mt-4 border-t border-white/10 flex flex-col items-center justify-center gap-4">
                <!-- Unified Stats Capsule -->
                <div id="showingCountContainer" class="flex flex-wrap items-center justify-center gap-2.5">
                    @if ($subscribers->total() > 0)
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#0c1424] border border-white/10 text-xs font-mono text-slate-300 shadow-inner whitespace-nowrap">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                            <span>Showing <strong class="text-white font-semibold">{{ $subscribers->firstItem() ?? 0 }}–{{ $subscribers->lastItem() ?? 0 }}</strong> of <strong class="text-white font-semibold">{{ $subscribers->total() }}</strong></span>
                            <span class="text-slate-600">•</span>
                            <span>Page <strong class="text-white font-semibold">{{ $subscribers->currentPage() }}</strong> of <strong class="text-white font-semibold">{{ $subscribers->lastPage() }}</strong></span>
                        </div>
                    @else
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#0c1424] border border-white/10 text-xs font-mono text-slate-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-600"></span>
                            <span>Showing <strong>0</strong> items</span>
                        </div>
                    @endif
                </div>

                <!-- Pro Pagination Controls (Centered below, matches Image 2) -->
                <div id="paginationContainer" class="flex items-center justify-center overflow-x-auto max-w-full py-1">
                    {{ $subscribers->links('admin.components.pagination') }}
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Live search input debounce
        let searchDebounceTimeout = null;
        const searchInput = document.getElementById('subscriberSearchInput');
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
            const sortSelect = document.getElementById('sortFilter');
            if (sortSelect) sortSelect.value = 'latest';
            triggerFilterUpdate();
        }

        function triggerFilterUpdate(page = 1) {
            const search = document.getElementById('subscriberSearchInput') 
                ? document.getElementById('subscriberSearchInput').value.trim() 
                : '';
            const sort = document.getElementById('sortFilter') 
                ? document.getElementById('sortFilter').value 
                : 'latest';
            const perPage = document.getElementById('perPageFilter') 
                ? document.getElementById('perPageFilter').value 
                : '20';

            const params = new URLSearchParams();
            if (search) params.set('search', search);
            if (sort && sort !== 'latest') params.set('sort', sort);
            if (perPage && perPage !== '20') params.set('per_page', perPage);
            if (page > 1) params.set('page', page);

            const newUrl = `${window.location.pathname}${params.toString() ? '?' + params.toString() : ''}`;
            window.history.pushState({ path: newUrl }, '', newUrl);

            // Toggle Reset Filters button
            const resetBtn = document.getElementById('resetFiltersBtn');
            if (resetBtn) {
                const hasFilters = Boolean(search || (sort && sort !== 'latest'));
                if (hasFilters) {
                    resetBtn.classList.remove('hidden');
                } else {
                    resetBtn.classList.add('hidden');
                }
            }

            // Subtle loading indicator
            const listContainer = document.getElementById('subscribersListContainer');
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
                const newList = doc.getElementById('subscribersListContainer');
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
            })
            .catch(err => {
                console.error('Subscriber filter error:', err);
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
        });

        window.addEventListener('popstate', function() {
            window.location.reload();
        });
    </script>
@endpush
