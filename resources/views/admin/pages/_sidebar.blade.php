@php
    $themeDetails = \App\Models\SiteSetting::getThemeDetails($selectedTheme ?? 'dark_luxury');
    $themeColor = $themeDetails['color'] ?? '#6366f1';
    $themeName = $themeDetails['name'] ?? ucfirst(str_replace('_', ' ', $selectedTheme ?? 'dark_luxury'));
    $totalSections = count($sections ?? []);
@endphp

<!-- Right Sidebar: Page Sections Tabs Panel (Docked on Right Side) -->
<aside class="page-elements-sidebar space-y-4">
    <div class="rounded-3xl bg-[#09101d]/95 border border-white/10 p-5 shadow-2xl space-y-4 backdrop-blur-2xl relative overflow-hidden">
        <!-- Top Accent Gradient Line -->
        <div class="h-1 w-full absolute top-0 left-0 right-0"
            style="background: linear-gradient(90deg, {{ $themeColor }}, #6366f1, #ec4899);"></div>

        <!-- Sidebar Header -->
        <div class="flex items-center justify-between pb-3 border-b border-white/10 pt-1">
            <div class="flex items-center gap-2.5 min-w-0">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center font-bold text-xs shrink-0 shadow-md"
                    style="background: {{ $themeColor }}20; color: {{ $themeColor }}; border: 1px solid {{ $themeColor }}40;">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <h3 class="text-xs font-bold text-white uppercase tracking-wider truncate">Page Sections</h3>
                    <p class="text-[10px] text-slate-400 font-mono">{{ $totalSections }} Tabs Available</p>
                </div>
            </div>
            <!-- All Sections Toggle -->
            <button type="button" onclick="switchSectionTab('all')"
                data-tab-id="all"
                class="section-tab-btn text-[11px] font-mono px-2.5 py-1 rounded-xl border border-white/10 hover:border-white/25 text-slate-300 hover:text-white bg-white/[0.03] hover:bg-white/[0.08] transition-all cursor-pointer shrink-0 shadow-sm"
                title="View all sections stacked">
                View All
            </button>
        </div>

        <!-- Search / Filter Tabs (if more than 4 sections) -->
        @if ($totalSections > 4)
            <div class="relative">
                <input type="text" id="tabSearchInput" oninput="filterSidebarTabs(this.value)"
                    placeholder="Search sections..."
                    class="w-full pl-8 pr-3 py-2 rounded-xl bg-black/50 border border-white/10 text-white text-xs placeholder:text-slate-500 focus:outline-none focus:border-white/30 font-sans transition-colors">
                <svg class="w-3.5 h-3.5 text-slate-500 absolute left-2.5 top-3 pointer-events-none" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        @endif

        <!-- Tab Navigation Buttons List -->
        <nav class="space-y-1.5 max-h-[calc(100vh-18rem)] overflow-y-auto pr-1" id="sidebarTabsList">
            @foreach ($sections as $index => $section)
                @php
                    $tabId = $section['id'];
                    $tabNum = $section['num'] ?? sprintf('%02d', $index + 1);
                    $tabTitle = $section['title'];
                    $tabSubtitle = $section['subtitle'] ?? '';
                    $fieldCount = $section['count'] ?? 0;
                @endphp
                <button type="button"
                    onclick="switchSectionTab('{{ $tabId }}')"
                    data-tab-id="{{ $tabId }}"
                    data-tab-title="{{ strtolower($tabTitle) }}"
                    class="section-tab-btn w-full text-left p-3 rounded-2xl border transition-all duration-200 group cursor-pointer flex items-center justify-between gap-2.5 border-white/5 bg-white/[0.02] hover:bg-white/[0.06] hover:border-white/15 relative overflow-hidden">
                    <div class="flex items-center gap-2.5 min-w-0 flex-1">
                        <span class="tab-num-badge w-7 h-7 rounded-lg bg-black/50 border border-white/10 text-slate-400 font-mono font-bold text-[11px] flex items-center justify-center shrink-0 transition-all">
                            {{ $tabNum }}
                        </span>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between gap-1.5">
                                <span class="tab-title block text-xs font-bold text-slate-200 group-hover:text-white transition-colors leading-snug truncate">
                                    {{ $tabTitle }}
                                </span>
                                @if($fieldCount > 0)
                                    <span class="tab-count-pill text-[9px] font-mono px-1.5 py-0.2 rounded bg-white/5 border border-white/10 text-slate-400 group-hover:text-slate-300 shrink-0">
                                        {{ $fieldCount }}
                                    </span>
                                @endif
                            </div>
                            @if (!empty($tabSubtitle))
                                <span class="tab-sub block text-[10px] text-slate-400 group-hover:text-slate-300 mt-0.5 truncate font-sans">
                                    {{ $tabSubtitle }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="tab-arrow shrink-0 text-slate-600 group-hover:text-slate-400 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </button>
            @endforeach
        </nav>

        <!-- Sidebar Footer Action / Live Link -->
        <div class="pt-3 border-t border-white/10 space-y-2.5">
            <div class="p-3 rounded-2xl bg-black/50 border border-white/5 space-y-1">
                <div class="flex items-center justify-between text-[11px]">
                    <span class="text-slate-400 font-mono">Active Theme</span>
                    <span class="font-bold font-mono text-[10px] px-2 py-0.5 rounded-md"
                        style="background: {{ $themeColor }}20; color: {{ $themeColor }}; border: 1px solid {{ $themeColor }}40;">
                        {{ $themeName }}
                    </span>
                </div>
                <p class="text-[10px] text-slate-500 leading-tight">
                    Select any tab to edit that section. Each section saves independently.
                </p>
            </div>

            <!-- View Live Link -->
            <a href="/{{ ($pageSlug ?? 'home') === 'home' ? '' : (($pageSlug ?? '') === 'project' ? 'portfolio' : ($pageSlug ?? '')) }}?theme={{ $selectedTheme }}"
                target="_blank"
                class="w-full flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl text-xs font-semibold text-slate-200 hover:text-white bg-slate-800/80 hover:bg-slate-700/80 border border-white/10 hover:border-white/20 transition-all shadow-md">
                <span>View Live {{ $pageTitle ?? 'Page' }}</span>
                <svg class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
            </a>
        </div>
    </div>
</aside>

<style>
    /* Active Tab Styles */
    .section-tab-btn.active-tab {
        background: linear-gradient(135deg, {{ $themeColor }}20, rgba(255, 255, 255, 0.02)) !important;
        border-color: {{ $themeColor }}70 !important;
        box-shadow: 0 4px 24px -2px {{ $themeColor }}35, inset 0 0 16px {{ $themeColor }}10 !important;
    }
    .section-tab-btn.active-tab .tab-title {
        color: #ffffff !important;
        font-weight: 800 !important;
    }
    .section-tab-btn.active-tab .tab-sub {
        color: {{ $themeColor }} !important;
        opacity: 0.95;
    }
    .section-tab-btn.active-tab .tab-num-badge {
        background: {{ $themeColor }} !important;
        border-color: {{ $themeColor }} !important;
        color: #000000 !important;
        font-weight: 800 !important;
        box-shadow: 0 0 14px {{ $themeColor }}60;
    }
    .section-tab-btn.active-tab .tab-count-pill {
        background: {{ $themeColor }}25 !important;
        border-color: {{ $themeColor }}50 !important;
        color: {{ $themeColor }} !important;
    }
    .section-tab-btn.active-tab .tab-arrow {
        color: {{ $themeColor }} !important;
        transform: translateX(3px);
    }

    /* Custom Sleek Dark Scrollbar */
    #sidebarTabsList::-webkit-scrollbar {
        width: 5px;
    }
    #sidebarTabsList::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 8px;
    }
    #sidebarTabsList::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 8px;
    }
    #sidebarTabsList::-webkit-scrollbar-thumb:hover {
        background: {{ $themeColor }};
    }
</style>

<script>
    // Tab Switching Functionality (Namespaced per page and theme)
    const pageTabStorageKey = 'active_tab_{{ $pageSlug }}_{{ $selectedTheme }}';

    function switchSectionTab(tabId, updateHistory = true) {
        const panels = document.querySelectorAll('.section-tab-panel');
        const buttons = document.querySelectorAll('.section-tab-btn');

        if (tabId === 'all') {
            panels.forEach(p => p.classList.remove('hidden'));
        } else {
            let found = false;
            panels.forEach(p => {
                if (p.id === 'tab-panel-' + tabId) {
                    p.classList.remove('hidden');
                    found = true;
                } else {
                    p.classList.add('hidden');
                }
            });
            // If requested tabId panel wasn't found (fallback), ensure first panel is visible
            if (!found && panels.length > 0) {
                panels[0].classList.remove('hidden');
                tabId = panels[0].id.replace('tab-panel-', '');
            }
        }

        // Update button states
        buttons.forEach(b => {
            if (b.getAttribute('data-tab-id') === tabId) {
                b.classList.add('active-tab');
            } else {
                b.classList.remove('active-tab');
            }
        });

        // Store state in sessionStorage
        try {
            sessionStorage.setItem(pageTabStorageKey, tabId);
        } catch (e) {}

        // Update URL hash without jumping
        if (updateHistory && history.replaceState) {
            history.replaceState(null, '', '#' + tabId);
        }
    }

    // Filter sidebar tabs by search keyword
    function filterSidebarTabs(keyword) {
        const q = (keyword || '').toLowerCase().trim();
        const buttons = document.querySelectorAll('#sidebarTabsList .section-tab-btn');
        buttons.forEach(b => {
            const title = b.getAttribute('data-tab-title') || '';
            if (!q || title.includes(q)) {
                b.classList.remove('hidden');
            } else {
                b.classList.add('hidden');
            }
        });
    }

    // Initialize Active Tab on Page Load
    document.addEventListener('DOMContentLoaded', function() {
        let initialTab = '';

        // 1. Check URL Hash (only if valid panel exists)
        if (window.location.hash) {
            const rawHash = window.location.hash.replace('#', '');
            if (rawHash && (rawHash === 'all' || document.getElementById('tab-panel-' + rawHash))) {
                initialTab = rawHash;
            }
        }

        // 2. Check SessionStorage (only if valid panel exists)
        if (!initialTab) {
            try {
                const saved = sessionStorage.getItem(pageTabStorageKey);
                if (saved && (saved === 'all' || document.getElementById('tab-panel-' + saved))) {
                    initialTab = saved;
                }
            } catch (e) {}
        }

        // 3. Fallback to first panel on this page
        if (!initialTab) {
            const firstPanel = document.querySelector('.section-tab-panel');
            if (firstPanel) {
                initialTab = firstPanel.id.replace('tab-panel-', '');
            }
        }

        if (initialTab) {
            switchSectionTab(initialTab, false);
        } else {
            const firstPanel = document.querySelector('.section-tab-panel');
            if (firstPanel) {
                firstPanel.classList.remove('hidden');
            }
        }

        // Keep active tab upon any form submission inside this page
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const activeBtn = document.querySelector('.section-tab-btn.active-tab');
                if (activeBtn) {
                    const currentTab = activeBtn.getAttribute('data-tab-id');
                    if (currentTab) {
                        try {
                            sessionStorage.setItem(pageTabStorageKey, currentTab);
                        } catch (e) {}
                    }
                }
            });
        });
    });
</script>
