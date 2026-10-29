@php
    use App\Models\SiteSetting;

    $activeTheme = $activeTheme ?? SiteSetting::getActiveTheme();
    $themes = $themes ?? SiteSetting::getAvailableThemes();
    $showGlobalOptions = $showGlobalOptions ?? true;
    $selectedTheme = request()->query('theme', $selectedTheme ?? $activeTheme);
    if (
        (!isset($themes[$selectedTheme]) && !in_array($selectedTheme, ['all', 'everything'], true)) ||
        (!$showGlobalOptions && in_array($selectedTheme, ['all', 'everything'], true))
    ) {
        $selectedTheme = $activeTheme;
    }

    $activeThemeMeta = $themes[$activeTheme] ?? SiteSetting::getThemeDetails($activeTheme);
    $selectedThemeMeta =
        $selectedTheme === 'all'
            ? SiteSetting::getThemeDetails('all')
            : ($selectedTheme === 'everything'
                ? [
                    'name' => 'All Elements (No Filter)',
                    'short' => 'Everything',
                    'color' => '#6366f1',
                    'badge' => 'bg-indigo-500/20 text-indigo-300 border-indigo-500/30',
                    'border' => 'border-indigo-500',
                    'description' => 'Display all elements regardless of theme',
                ]
                : $themes[$selectedTheme] ?? SiteSetting::getThemeDetails($selectedTheme));

    $elementName = $elementName ?? 'Elements';
    $themeCounts = $themeCounts ?? [];
@endphp

<!-- =========================================================================
     TOP THEME FILTER & VISUAL SELECTOR (Select2 / Selectpicker / AngularJS Reactive)
     ========================================================================= -->
<div id="themeFilterContainer"
    class="px-5 py-3 rounded-2xl bg-[#09101d] border border-white/10 shadow-xl mb-6 transition-all relative">

    <div class="flex items-center justify-between gap-3 sm:gap-4 flex-nowrap w-full">

        <!-- Left: Status & Active Theme Badge (Top) + Count (Bottom, where arrow points) -->
        <div class="flex items-center gap-3.5 min-w-0 flex-1">
            <div class="relative shrink-0 flex items-center justify-center">
                <span id="tfStatusDot" class="w-3.5 h-3.5 rounded-full inline-block shrink-0"
                    style="background-color: {{ $selectedThemeMeta['color'] ?? '#6366f1' }};"></span>
                <span id="tfStatusPing"
                    class="w-3.5 h-3.5 rounded-full inline-block animate-ping absolute inset-0 opacity-75 shrink-0"
                    style="background-color: {{ $selectedThemeMeta['color'] ?? '#6366f1' }};"></span>
            </div>

            <div class="space-y-1 min-w-0">
                <!-- Top Row: Status Badges -->
                <div class="flex items-center gap-2 flex-wrap">
                    <span
                        class="text-[10px] font-mono uppercase font-bold tracking-wider px-2 py-0.5 rounded-full bg-white/5 border border-white/10 text-slate-300 shrink-0">
                        Theme Filter
                    </span>
                    <span
                        class="text-[10px] font-mono px-2 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 shrink-0 inline-flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        <span>Active: <strong>{{ $activeThemeMeta['short'] ?? $activeTheme }}</strong></span>
                    </span>
                    <span id="tfStatusBadge"
                        class="text-[10px] font-mono px-2 py-0.5 rounded-full shrink-0 {{ $selectedThemeMeta['badge'] ?? 'bg-indigo-500/20 text-indigo-300' }}">
                        Filtering: {{ $selectedThemeMeta['short'] ?? $selectedTheme }}
                    </span>
                </div>

                <!-- Bottom Row: Element Count Text (Full width, no truncation) -->
                <p class="mt-3 text-xs text-slate-400">
                    <span id="tfCountLabel">Loading elements for <strong
                            class="text-white">{{ $selectedThemeMeta['name'] }}</strong>...</span>
                </p>
            </div>
        </div>

        <!-- Right: Theme Dropdown + Preview Live (Strictly flex-nowrap, never breaking onto 2 lines) -->
        <div class="flex items-center gap-2.5 shrink-0 flex-nowrap">

            <!-- SELECTPICKER / SELECT2 DROPDOWN WRAPPER -->
            <div class="relative shrink-0" id="themeSelectPicker">
                <!-- Dropdown Trigger Button -->
                <button type="button" id="themeSelectBtn" onclick="toggleThemeDropdown()"
                    class="h-10 px-3 rounded-xl bg-black/60 border border-white/15 hover:border-indigo-500/50 text-white text-xs font-semibold flex items-center gap-2.5 transition-all shadow-inner focus:outline-none focus:ring-1 focus:ring-indigo-500/40 w-auto min-w-[190px] max-w-[240px] sm:max-w-[270px] justify-between shrink-0">
                    <div class="flex items-center gap-2 min-w-0 overflow-hidden">
                        <span id="tfSelectedDot" class="w-2.5 h-2.5 rounded-full shrink-0"
                            style="background-color: {{ $selectedThemeMeta['color'] ?? '#6366f1' }}"></span>
                        <div class="text-left min-w-0 overflow-hidden">
                            <span
                                class="block text-[8px] font-mono text-slate-400 uppercase tracking-wider leading-none">Theme</span>
                            <span id="tfSelectedName"
                                class="font-bold text-white text-xs block truncate leading-tight whitespace-nowrap">{{ $selectedThemeMeta['name'] }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 shrink-0 ml-1">
                        <span id="tfLiveTag"
                            class="text-[9px] font-mono font-bold px-1.5 py-0.2 rounded bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 shrink-0 {{ $selectedTheme === $activeTheme ? '' : 'hidden' }}">LIVE</span>
                        <svg id="themeSelectChevron"
                            class="w-3.5 h-3.5 text-slate-400 shrink-0 transition-transform duration-200" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </button>

                <!-- Dropdown Menu (Select2 Style with Search and Rich Options) -->
                <div id="themeSelectMenu"
                    class="hidden absolute right-0 mt-2 w-80 sm:w-96 rounded-2xl bg-[#09101d] border border-white/20 shadow-2xl z-50 overflow-hidden backdrop-blur-xl transition-all duration-200">

                    <!-- Select2 Search Header -->
                    <div class="p-3 border-b border-white/10 bg-black/40">
                        <div class="relative">
                            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" id="themeSearchInput" onkeyup="filterThemeOptions(this.value)"
                                placeholder="Search themes (e.g. Developer, UI/UX)..."
                                class="w-full pl-9 pr-3 py-2 rounded-xl bg-black/60 border border-white/10 text-white text-xs placeholder:text-slate-500 focus:outline-none focus:border-indigo-500 font-sans">
                        </div>

                        <!-- Quick Category Filter Chips -->
                        <div class="flex items-center gap-1.5 mt-2 overflow-x-auto text-[10px] font-mono pb-0.5">
                            <button type="button" onclick="selectTheme('{{ $activeTheme }}')"
                                class="px-2 py-0.5 rounded-md bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 hover:bg-emerald-500/30 shrink-0">
                                Active ({{ $activeThemeMeta['short'] }})
                            </button>
                            @if ($showGlobalOptions)
                                <button type="button" onclick="selectTheme('all')"
                                    class="px-2 py-0.5 rounded-md bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 hover:bg-indigo-500/30 shrink-0">
                                    All Themes
                                </button>
                                <button type="button" onclick="selectTheme('everything')"
                                    class="px-2 py-0.5 rounded-md bg-white/10 text-slate-300 hover:bg-white/20 shrink-0">
                                    Show Everything
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Scrollable Theme Options List -->
                    <div id="themeOptionsList" class="max-h-72 overflow-y-auto p-2 space-y-1 divide-y divide-white/5">

                        <!-- Option: Website Active Theme (Top Priority) -->
                        <div class="pt-1 pb-1">
                            <button type="button" onclick="selectTheme('{{ $activeTheme }}')"
                                data-theme-key="{{ $activeTheme }}"
                                data-theme-name="{{ strtolower($activeThemeMeta['name']) }}"
                                class="theme-option-btn w-full p-2.5 rounded-xl flex items-center justify-between text-left hover:bg-white/5 transition-colors group {{ $selectedTheme === $activeTheme ? 'bg-indigo-600/20 border border-indigo-500/30' : '' }}">
                                <div class="flex items-center gap-3">
                                    <span class="w-3 h-3 rounded-full shrink-0"
                                        style="background-color: {{ $activeThemeMeta['color'] }}"></span>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="text-xs font-bold text-white group-hover:text-indigo-300">{{ $activeThemeMeta['name'] }}</span>
                                            <span
                                                class="text-[9px] font-mono font-bold px-1.5 py-0.2 rounded bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">DEFAULT
                                                ACTIVE</span>
                                        </div>
                                        <span
                                            class="block text-[10px] text-slate-400 mt-0.5 truncate max-w-[200px]">{{ $activeThemeMeta['description'] }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="text-[10px] font-mono px-2 py-0.5 rounded bg-black/40 text-slate-300 border border-white/5 count-badge"
                                        data-for-theme="{{ $activeTheme }}">
                                        {{ $themeCounts[$activeTheme] ?? '' }}
                                    </span>
                                    <svg class="w-4 h-4 text-emerald-400 check-icon {{ $selectedTheme === $activeTheme ? '' : 'hidden' }}"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </button>
                        </div>

                        <!-- All 6 Supported Themes -->
                        <div class="pt-1.5 space-y-1">
                            @foreach ($themes as $key => $meta)
                                @if ($key !== $activeTheme)
                                    <button type="button" onclick="selectTheme('{{ $key }}')"
                                        data-theme-key="{{ $key }}"
                                        data-theme-name="{{ strtolower($meta['name']) }} {{ strtolower($meta['short']) }}"
                                        class="theme-option-btn w-full p-2.5 rounded-xl flex items-center justify-between text-left hover:bg-white/5 transition-colors group {{ $selectedTheme === $key ? 'bg-indigo-600/20 border border-indigo-500/30' : '' }}">
                                        <div class="flex items-center gap-3">
                                            <span class="w-3 h-3 rounded-full shrink-0"
                                                style="background-color: {{ $meta['color'] }}"></span>
                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <span
                                                        class="text-xs font-bold text-white group-hover:text-indigo-300">{{ $meta['name'] }}</span>
                                                </div>
                                                <span
                                                    class="block text-[10px] text-slate-400 mt-0.5 truncate max-w-[200px]">{{ $meta['description'] }}</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="text-[10px] font-mono px-2 py-0.5 rounded bg-black/40 text-slate-300 border border-white/5 count-badge"
                                                data-for-theme="{{ $key }}">
                                                {{ $themeCounts[$key] ?? '' }}
                                            </span>
                                            <svg class="w-4 h-4 text-indigo-400 check-icon {{ $selectedTheme === $key ? '' : 'hidden' }}"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </button>
                                @endif
                            @endforeach
                        </div>

                        @if ($showGlobalOptions)
                            <!-- Global All Themes & Show Everything -->
                            <div class="pt-1.5 space-y-1">
                                <button type="button" onclick="selectTheme('all')" data-theme-key="all"
                                    data-theme-name="all themes shared global elements"
                                    class="theme-option-btn w-full p-2.5 rounded-xl flex items-center justify-between text-left hover:bg-white/5 transition-colors group {{ $selectedTheme === 'all' ? 'bg-indigo-600/20 border border-indigo-500/30' : '' }}">
                                    <div class="flex items-center gap-3">
                                        <span class="w-3 h-3 rounded-full bg-indigo-500 shrink-0"></span>
                                        <div>
                                            <span class="text-xs font-bold text-white group-hover:text-indigo-300">All
                                                Themes (Global Elements Only)</span>
                                            <span class="block text-[10px] text-slate-400 mt-0.5">Elements tagged with
                                                'all'</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="text-[10px] font-mono px-2 py-0.5 rounded bg-black/40 text-slate-300 border border-white/5 count-badge"
                                            data-for-theme="all">
                                            {{ $themeCounts['all'] ?? '' }}
                                        </span>
                                        <svg class="w-4 h-4 text-indigo-400 check-icon {{ $selectedTheme === 'all' ? '' : 'hidden' }}"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </button>

                                <button type="button" onclick="selectTheme('everything')"
                                    data-theme-key="everything"
                                    data-theme-name="everything all elements unfiltered total"
                                    class="theme-option-btn w-full p-2.5 rounded-xl flex items-center justify-between text-left hover:bg-white/5 transition-colors group {{ $selectedTheme === 'everything' ? 'bg-indigo-600/20 border border-indigo-500/30' : '' }}">
                                    <div class="flex items-center gap-3">
                                        <span class="w-3 h-3 rounded-full bg-slate-400 shrink-0"></span>
                                        <div>
                                            <span class="text-xs font-bold text-white group-hover:text-indigo-300">Show
                                                Everything (Unfiltered)</span>
                                            <span class="block text-[10px] text-slate-400 mt-0.5">All elements across
                                                all
                                                themes</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="text-[10px] font-mono px-2 py-0.5 rounded bg-black/40 text-slate-300 border border-white/5">
                                            ALL
                                        </span>
                                        <svg class="w-4 h-4 text-indigo-400 check-icon {{ $selectedTheme === 'everything' ? '' : 'hidden' }}"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Footer of dropdown with helper text -->
                    <div
                        class="p-2.5 border-t border-white/10 bg-black/50 flex items-center justify-between text-[10px] font-mono text-slate-400">
                        <span>Select2 &bull; AngularJS Filter</span>
                        <a href="{{ route('admin.settings.theme') }}"
                            class="text-indigo-400 hover:text-indigo-300 underline">Change Default Active &rarr;</a>
                    </div>
                </div>
            </div>

            <!-- Live Theme Preview Link (In the exact same line, never wrapping) -->
            <a id="tfLivePreviewBtn"
                href="{{ route('home', ['theme' => $selectedTheme === 'all' || $selectedTheme === 'everything' ? $activeTheme : $selectedTheme]) }}"
                target="_blank" title="Preview this theme on the public website"
                class="h-10 px-3 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 hover:border-white/20 text-slate-300 hover:text-white text-xs font-semibold flex items-center gap-1.5 transition-all shrink-0 whitespace-nowrap">
                <svg class="w-3.5 h-3.5 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                <span class="whitespace-nowrap">Preview Live</span>
            </a>

            @if (!empty($createRoute))
                <a id="tfCreateBtn"
                    href="{{ $createRoute }}?theme={{ $selectedTheme === 'all' || $selectedTheme === 'everything' ? $activeTheme : $selectedTheme }}"
                    class="theme-aware-create-btn h-10 px-3.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg shadow-indigo-600/30 transition-all flex items-center gap-1.5 shrink-0 whitespace-nowrap">
                    <span>{{ $createLabel ?? '+ Create' }}</span>
                </a>
            @endif
        </div>

    </div>

</div>

<!-- EMPTY STATE PLACEHOLDER (Dynamically shown when 0 items match) -->
<div id="tfEmptyState"
    class="hidden p-12 text-center rounded-3xl bg-[#09101d] border border-dashed border-white/15 space-y-4 my-6">
    <div
        class="w-12 h-12 rounded-2xl bg-indigo-600/10 text-indigo-400 flex items-center justify-center mx-auto text-xl font-bold">
        ⬡
    </div>
    <div class="space-y-1">
        <h3 class="text-base font-bold text-white" id="tfEmptyTitle">No elements found for this theme</h3>
        <p class="text-xs text-slate-400 max-w-md mx-auto" id="tfEmptyDesc">There are currently no items specifically
            assigned to this theme. You can create one or view global elements.</p>
    </div>
    @if (!empty($createRoute))
        <a id="tfEmptyCreateBtn" href="{{ $createRoute }}?theme={{ $selectedTheme }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all">
            <span>{{ $createLabel ?? '+ Create New Element' }}</span>
        </a>
    @endif
</div>

<!-- =========================================================================
     ANGULARJS-STYLE REACTIVE CLIENT-SIDE FILTERING JAVASCRIPT
     ========================================================================= -->
<script>
    (function() {
        // Theme metadata map
        const themeMetadata = {
            'developer': {
                name: 'Developer (GLINT)',
                short: 'Developer',
                color: '#00ff88',
                badge: 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30'
            },
            'graphic_designer': {
                name: 'Graphic Designer',
                short: 'Graphic',
                color: '#7c3aed',
                badge: 'bg-purple-500/20 text-purple-300 border-purple-500/30'
            },
            'uiux_designer': {
                name: 'UI/UX Designer',
                short: 'UI/UX',
                color: '#ccff00',
                badge: 'bg-lime-500/20 text-lime-300 border-lime-500/30'
            },
            'app_developer': {
                name: 'App Developer',
                short: 'App Dev',
                color: '#ff0033',
                badge: 'bg-rose-500/20 text-rose-300 border-rose-500/30'
            },
            'app_software_developer': {
                name: 'App & Software Developer',
                short: 'Software Dev',
                color: '#ff6b00',
                badge: 'bg-amber-500/20 text-amber-300 border-amber-500/30'
            },
            'digital_designer_illustrator': {
                name: 'Digital Designer & Illustrator',
                short: 'Illustrator',
                color: '#e26d9b',
                badge: 'bg-pink-500/20 text-pink-300 border-pink-500/30'
            }
            @if ($showGlobalOptions)
                ,
                'all': {
                    name: 'All Themes (Global Elements Only)',
                    short: 'All Themes',
                    color: '#6366f1',
                    badge: 'bg-indigo-500/20 text-indigo-300 border-indigo-500/30'
                },
                'everything': {
                    name: 'All Elements (No Filter)',
                    short: 'Everything',
                    color: '#6366f1',
                    badge: 'bg-indigo-500/20 text-indigo-300 border-indigo-500/30'
                }
            @endif
        };

        const activeDefaultTheme = "{{ $activeTheme }}";
        const baseCreateUrl = "{{ $createRoute ?? '' }}";
        const elementName = "{{ $elementName }}";

        // Toggle dropdown
        window.toggleThemeDropdown = function() {
            const menu = document.getElementById('themeSelectMenu');
            const chevron = document.getElementById('themeSelectChevron');
            if (!menu) return;
            const isHidden = menu.classList.contains('hidden');
            if (isHidden) {
                menu.classList.remove('hidden');
                if (chevron) chevron.classList.add('rotate-180');
                const searchInput = document.getElementById('themeSearchInput');
                if (searchInput) {
                    searchInput.value = '';
                    filterThemeOptions('');
                    setTimeout(() => searchInput.focus(), 50);
                }
            } else {
                menu.classList.add('hidden');
                if (chevron) chevron.classList.remove('rotate-180');
            }
        };

        // Close on outside click
        document.addEventListener('click', function(e) {
            const picker = document.getElementById('themeSelectPicker');
            const menu = document.getElementById('themeSelectMenu');
            const chevron = document.getElementById('themeSelectChevron');
            if (picker && menu && !picker.contains(e.target)) {
                menu.classList.add('hidden');
                if (chevron) chevron.classList.remove('rotate-180');
            }
        });

        // Select2 live search filter in dropdown
        window.filterThemeOptions = function(query) {
            const q = (query || '').toLowerCase().trim();
            const options = document.querySelectorAll('.theme-option-btn');
            options.forEach(btn => {
                const name = (btn.getAttribute('data-theme-name') || '').toLowerCase();
                const key = (btn.getAttribute('data-theme-key') || '').toLowerCase();
                if (!q || name.includes(q) || key.includes(q)) {
                    btn.parentElement.classList.remove('hidden');
                } else {
                    btn.parentElement.classList.add('hidden');
                }
            });
        };

        // Main Selection & Instant Reactive Filter
        window.selectTheme = function(themeKey) {
            const meta = themeMetadata[themeKey] || {
                name: themeKey.replace('_', ' '),
                short: themeKey,
                color: '#6366f1',
                badge: 'bg-indigo-500/20 text-indigo-300 border-indigo-500/30'
            };

            // 1. Update trigger UI
            const dot = document.getElementById('tfSelectedDot');
            const statusDot = document.getElementById('tfStatusDot');
            const statusPing = document.getElementById('tfStatusPing');
            const nameEl = document.getElementById('tfSelectedName');
            const statusBadge = document.getElementById('tfStatusBadge');
            const liveTag = document.getElementById('tfLiveTag');
            if (dot) dot.style.backgroundColor = meta.color;
            if (statusDot) statusDot.style.backgroundColor = meta.color;
            if (statusPing) statusPing.style.backgroundColor = meta.color;
            if (nameEl) nameEl.textContent = meta.name;
            if (statusBadge) {
                statusBadge.className =
                    'text-[10px] font-mono px-2 py-0.5 rounded-full shrink-0 ' +
                    meta.badge;
                statusBadge.textContent = 'Filtering: ' + meta.short;
            }
            if (liveTag) {
                if (themeKey === activeDefaultTheme) {
                    liveTag.classList.remove('hidden');
                } else {
                    liveTag.classList.add('hidden');
                }
            }

            // 2. Update active checkmark in dropdown
            document.querySelectorAll('.theme-option-btn').forEach(btn => {
                const btnKey = btn.getAttribute('data-theme-key');
                const check = btn.querySelector('.check-icon');
                if (btnKey === themeKey) {
                    btn.classList.add('bg-indigo-600/20', 'border', 'border-indigo-500/30');
                    if (check) check.classList.remove('hidden');
                } else {
                    btn.classList.remove('bg-indigo-600/20', 'border', 'border-indigo-500/30');
                    if (check) check.classList.add('hidden');
                }
            });

            // Close dropdown
            const menu = document.getElementById('themeSelectMenu');
            const chevron = document.getElementById('themeSelectChevron');
            if (menu) menu.classList.add('hidden');
            if (chevron) chevron.classList.remove('rotate-180');

            // 3. Update Live Preview Button
            const liveBtn = document.getElementById('tfLivePreviewBtn');
            if (liveBtn) {
                const previewTheme = (themeKey === 'all' || themeKey === 'everything') ? activeDefaultTheme :
                    themeKey;
                liveBtn.href = '/?theme=' + encodeURIComponent(previewTheme);
            }

            // 4. Update Create Button href
            const createBtn = document.getElementById('tfCreateBtn');
            const emptyCreateBtn = document.getElementById('tfEmptyCreateBtn');
            const targetThemeForCreate = (themeKey === 'all' || themeKey === 'everything') ?
                activeDefaultTheme : themeKey;
            if (createBtn && baseCreateUrl) {
                createBtn.href = baseCreateUrl + '?theme=' + encodeURIComponent(targetThemeForCreate);
            }
            if (emptyCreateBtn && baseCreateUrl) {
                emptyCreateBtn.href = baseCreateUrl + '?theme=' + encodeURIComponent(targetThemeForCreate);
            }

            // 5. REACTIVE ELEMENT FILTER (Instant DOM filtering)
            const filterableElements = document.querySelectorAll('[data-theme]');
            let matchCount = 0;
            let totalCount = filterableElements.length;

            filterableElements.forEach(el => {
                const elTheme = (el.getAttribute('data-theme') || '').toLowerCase().trim();
                let isMatch = false;

                if (themeKey === 'everything') {
                    isMatch = true;
                } else if (themeKey === 'all') {
                    // Show elements explicitly marked with 'all'
                    isMatch = (elTheme === 'all');
                } else {
                    // Specific theme selected: Show elements for this theme + elements shared across 'all'
                    isMatch = (elTheme === themeKey || elTheme === 'all');
                }

                if (isMatch) {
                    el.style.display = '';
                    el.classList.remove('hidden');
                    el.style.opacity = '1';
                    matchCount++;
                } else {
                    el.style.display = 'none';
                    el.classList.add('hidden');
                }
            });

            // Also check if any card sections in website.content use data-theme-section
            const sectionElements = document.querySelectorAll('[data-theme-section]');
            if (sectionElements.length > 0) {
                sectionElements.forEach(sec => {
                    const secThemes = (sec.getAttribute('data-theme-section') || '').toLowerCase();
                    if (themeKey === 'everything' || secThemes.includes('all') || secThemes.includes(
                            themeKey)) {
                        sec.style.display = '';
                        sec.classList.remove('hidden');
                    } else {
                        sec.style.display = 'none';
                        sec.classList.add('hidden');
                    }
                });
            }

            // 6. Update Counter Label (On bottom row, full details)
            const countLabel = document.getElementById('tfCountLabel');
            if (countLabel) {
                countLabel.innerHTML =
                    `Showing <strong class="text-white">${matchCount}</strong> ${elementName} for <strong class="text-indigo-400">${meta.name}</strong>` +
                    (totalCount > matchCount ?
                        ` <span class="text-slate-500 font-mono text-[11px]">(${totalCount} total elements across all themes)</span>` :
                        ''
                    );
            }

            // 7. Empty State handling
            const emptyState = document.getElementById('tfEmptyState');
            const emptyTitle = document.getElementById('tfEmptyTitle');
            const emptyDesc = document.getElementById('tfEmptyDesc');
            if (emptyState) {
                if (matchCount === 0 && totalCount > 0) {
                    emptyState.classList.remove('hidden');
                    if (emptyTitle) emptyTitle.textContent = `No ${elementName} configured for ${meta.name}`;
                    if (emptyDesc) emptyDesc.textContent =
                        `No items currently match the "${meta.name}" theme filter. Click below to add one or switch to All Themes.`;
                } else {
                    emptyState.classList.add('hidden');
                }
            }

            // 8. If on the Website Elements form page, reload with selected theme to populate form with that theme's elements
            const formCurrentTheme = document.getElementById('formCurrentTheme');
            if (formCurrentTheme && formCurrentTheme.value !== themeKey) {
                const targetUrl = new URL(window.location);
                targetUrl.searchParams.set('theme', themeKey);
                window.location.href = targetUrl.toString();
                return;
            }

            // Otherwise sync URL reactively without page reload
            try {
                const url = new URL(window.location);
                url.searchParams.set('theme', themeKey);
                window.history.replaceState({}, '', url);
            } catch (e) {
                // Ignore history api errors
            }
        };

        // Calculate dynamic counts on page load for badges
        function computeDynamicCounts() {
            const filterableElements = document.querySelectorAll('[data-theme]');
            const counts = {};
            filterableElements.forEach(el => {
                const t = (el.getAttribute('data-theme') || '').toLowerCase().trim();
                counts[t] = (counts[t] || 0) + 1;
            });

            document.querySelectorAll('.count-badge').forEach(badge => {
                const theme = badge.getAttribute('data-for-theme');
                if (theme) {
                    let cnt = 0;
                    if (theme === 'all') {
                        cnt = counts['all'] || 0;
                    } else {
                        // For a theme, count items for that theme + shared 'all' items
                        cnt = (counts[theme] || 0) + (counts['all'] || 0);
                    }
                    badge.textContent = cnt + ' items';
                }
            });
        }

        // Auto-run on load
        document.addEventListener('DOMContentLoaded', function() {
            computeDynamicCounts();

            // Priority: URL query param > server selected theme > default active theme
            const urlParams = new URLSearchParams(window.location.search);
            const urlTheme = urlParams.get('theme');
            const initialTheme = urlTheme || "{{ $selectedTheme }}";

            selectTheme(initialTheme);
        });
    })();
</script>
