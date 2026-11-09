@extends('admin.layout')

@section('title', 'Manage FAQs')
@section('page_title', 'Frequently Asked Questions')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="space-y-6">

        <!-- Header & Action -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-white">Frequently Asked Questions</h1>
                <p class="text-xs text-slate-400 mt-1">Manage client questions and answers displayed in the accordion section across all themes.</p>
            </div>
            <a href="{{ route('admin.faqs.create') }}"
                class="theme-aware-create-btn w-full sm:w-auto justify-center px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span> Add FAQ Question</span>
            </a>
        </div>

        <!-- TOP THEME FILTER COMPONENT (Select2 / Selectpicker / AngularJS Style) -->
        @include('admin.components.theme-filter')

        @php
            $themeFaqs = $faqs->filter(fn($f) => $f->theme !== 'all');
            $globalFaqs = $faqs->filter(fn($f) => $f->theme === 'all');
            $selectedThemeMeta = \App\Models\SiteSetting::getThemeDetails($selectedTheme ?? \App\Models\SiteSetting::getActiveTheme());
        @endphp

        <!-- 1. Active Theme Specific FAQs Section -->
        <div id="activeThemeSection" class="space-y-4">
            <div class="flex items-center justify-between pb-2 border-b border-white/5">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-cyan-400"></span>
                    <h2 class="text-xs sm:text-sm font-bold text-white uppercase tracking-wider font-mono">
                        Theme Elements: <span class="text-cyan-300" id="activeThemeSectionLabel">{{ $selectedThemeMeta['name'] ?? 'Active Theme' }}</span>
                    </h2>
                </div>
                <span class="text-[11px] font-mono text-slate-400 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7 2a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 14zm6-12a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 14z"></path>
                    </svg>
                    Drag to reorder
                </span>
            </div>

            <div class="space-y-4" data-sortable-grid="faq" id="activeFaqsList">
                @forelse($themeFaqs as $faq)
                    @php
                        $themeMeta = \App\Models\SiteSetting::getThemeDetails($faq->theme);
                    @endphp
                    <div data-id="{{ $faq->id }}" data-theme="{{ $faq->theme }}"
                        class="p-6 rounded-2xl bg-[#09101d] border border-white/10 hover:border-indigo-500/40 transition-all duration-300 flex flex-col justify-between space-y-3 shadow-lg group">
                        <div class="flex items-start justify-between gap-4">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <button type="button" class="drag-handle p-1 rounded text-slate-400 hover:text-white hover:bg-white/5 transition-all cursor-grab active:cursor-grabbing mr-1" title="Drag to reorder">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M7 2a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 14zm6-12a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 14z"></path>
                                        </svg>
                                    </button>
                                    <span class="px-2 py-0.5 rounded font-mono text-[10px] font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">{{ $faq->category }}</span>

                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold border {{ $themeMeta['badge'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full" style="background-color: {{ $themeMeta['color'] }}"></span>
                                        <span>{{ $themeMeta['short'] }}</span>
                                    </span>

                                    <span class="order-badge text-[11px] font-mono text-slate-400">Order: #{{ $faq->sort_order }}</span>
                                    @if (!$faq->is_published)
                                        <span class="px-2 py-0.5 rounded font-mono text-[10px] font-bold bg-amber-500/20 text-amber-300">Hidden</span>
                                    @endif
                                </div>
                                <h3 class="text-base font-bold text-white pt-1">{{ $faq->question }}</h3>
                                <p class="text-xs text-slate-300 leading-relaxed pt-1">{{ $faq->answer }}</p>
                            </div>

                            <div class="flex items-center gap-1.5 shrink-0">
                                <a href="{{ route('admin.faqs.edit', $faq) }}" title="Edit"
                                    class="p-1.5 rounded-lg text-indigo-400 hover:text-white hover:bg-indigo-600/30 transition-all">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST"
                                    onsubmit="return confirm('Delete this FAQ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete"
                                        class="p-1.5 rounded-lg text-rose-400 hover:text-white hover:bg-rose-500/30 transition-all">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-[11px] font-mono text-slate-500 pt-2 border-t border-white/5">
                            <span>Visibility: <strong class="{{ $faq->is_published ? 'text-emerald-400' : 'text-amber-400' }}">{{ $faq->is_published ? 'Active Public' : 'Draft Hidden' }}</strong></span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 bg-[#09101d] rounded-2xl border border-white/5 text-slate-400 text-xs">
                        No theme-specific FAQs created yet.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- 2. Global FAQs Section (All Themes) -->
        <div id="globalThemeSection" class="space-y-4 pt-6">
            <div class="flex items-center justify-between pb-2 border-b border-white/5">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-400"></span>
                    <h2 class="text-xs sm:text-sm font-bold text-white uppercase tracking-wider font-mono">
                        Global Elements: <span class="text-indigo-300">Shared Across All Themes</span>
                    </h2>
                </div>
                <span class="text-[11px] font-mono text-slate-400 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7 2a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 14zm6-12a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 14z"></path>
                    </svg>
                    Drag to reorder
                </span>
            </div>

            <div class="space-y-4" data-sortable-grid="faq" id="globalFaqsList">
                @forelse($globalFaqs as $faq)
                    @php
                        $themeMeta = \App\Models\SiteSetting::getThemeDetails('all');
                    @endphp
                    <div data-id="{{ $faq->id }}" data-theme="all"
                        class="p-6 rounded-2xl bg-[#09101d] border border-white/10 hover:border-indigo-500/40 transition-all duration-300 flex flex-col justify-between space-y-3 shadow-lg group">
                        <div class="flex items-start justify-between gap-4">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <button type="button" class="drag-handle p-1 rounded text-slate-400 hover:text-white hover:bg-white/5 transition-all cursor-grab active:cursor-grabbing mr-1" title="Drag to reorder">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M7 2a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 7 14zm6-12a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 2zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 8zm0 6a2 2 0 1 0 .001 4.001A2 2 0 0 0 13 14z"></path>
                                        </svg>
                                    </button>
                                    <span class="px-2 py-0.5 rounded font-mono text-[10px] font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">{{ $faq->category }}</span>

                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold border {{ $themeMeta['badge'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full" style="background-color: {{ $themeMeta['color'] }}"></span>
                                        <span>{{ $themeMeta['short'] }}</span>
                                    </span>

                                    <span class="order-badge text-[11px] font-mono text-slate-400">Order: #{{ $faq->sort_order }}</span>
                                    @if (!$faq->is_published)
                                        <span class="px-2 py-0.5 rounded font-mono text-[10px] font-bold bg-amber-500/20 text-amber-300">Hidden</span>
                                    @endif
                                </div>
                                <h3 class="text-base font-bold text-white pt-1">{{ $faq->question }}</h3>
                                <p class="text-xs text-slate-300 leading-relaxed pt-1">{{ $faq->answer }}</p>
                            </div>

                            <div class="flex items-center gap-1.5 shrink-0">
                                <a href="{{ route('admin.faqs.edit', $faq) }}" title="Edit"
                                    class="p-1.5 rounded-lg text-indigo-400 hover:text-white hover:bg-indigo-600/30 transition-all">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST"
                                    onsubmit="return confirm('Delete this FAQ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete"
                                        class="p-1.5 rounded-lg text-rose-400 hover:text-white hover:bg-rose-500/30 transition-all">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-[11px] font-mono text-slate-500 pt-2 border-t border-white/5">
                            <span>Visibility: <strong class="{{ $faq->is_published ? 'text-emerald-400' : 'text-amber-400' }}">{{ $faq->is_published ? 'Active Public' : 'Draft Hidden' }}</strong></span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 bg-[#09101d] rounded-2xl border border-white/5 text-slate-400 text-xs">
                        No global FAQs created yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
