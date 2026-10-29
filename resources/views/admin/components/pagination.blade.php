@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="inline-flex items-center gap-1.5 p-1.5 rounded-2xl bg-[#070d18] border border-white/10 shadow-2xl backdrop-blur-xl">
        {{-- First Page Button (1st position) --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="First Page"
                  class="inline-flex items-center gap-1.5 px-3 h-8 rounded-xl text-xs font-mono text-slate-600 bg-white/[0.02] border border-white/5 cursor-not-allowed select-none opacity-50">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
                <span class="hidden sm:inline font-medium text-[11px]">First</span>
            </span>
        @else
            <a href="{{ $paginator->url(1) }}" aria-label="First Page" title="Go to First Page"
               class="inline-flex items-center gap-1.5 px-3 h-8 rounded-xl text-xs font-mono text-slate-300 hover:text-white bg-white/5 hover:bg-indigo-600/20 border border-white/10 hover:border-indigo-500/40 transition-all shadow-sm group">
                <svg class="w-3.5 h-3.5 transition-transform group-hover:-translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
                <span class="hidden sm:inline font-medium text-[11px]">First</span>
            </a>
        @endif

        {{-- Previous Page Button --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="Previous Page"
                  class="inline-flex items-center gap-1.5 px-3 h-8 rounded-xl text-xs font-mono text-slate-600 bg-white/[0.02] border border-white/5 cursor-not-allowed select-none opacity-50">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="hidden sm:inline font-medium text-[11px]">Prev</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous Page" title="Go to Previous Page"
               class="inline-flex items-center gap-1.5 px-3 h-8 rounded-xl text-xs font-mono text-slate-300 hover:text-white bg-white/5 hover:bg-indigo-600/20 border border-white/10 hover:border-indigo-500/40 transition-all shadow-sm group">
                <svg class="w-3.5 h-3.5 transition-transform group-hover:-translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="hidden sm:inline font-medium text-[11px]">Prev</span>
            </a>
        @endif

        <div class="h-4 w-[1px] bg-white/10 mx-0.5 hidden sm:block"></div>

        {{-- Pagination Number Elements --}}
        <div class="flex items-center gap-1">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true" class="inline-flex items-center justify-center w-7 h-8 text-xs font-mono text-slate-500 tracking-widest select-none">
                        &hellip;
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" 
                                  class="inline-flex items-center justify-center min-w-[2.1rem] h-8 px-2.5 rounded-xl text-xs font-mono font-black text-white bg-gradient-to-tr from-indigo-600 via-indigo-500 to-indigo-600 border border-indigo-400/60 shadow-lg shadow-indigo-600/40 ring-2 ring-indigo-500/25 scale-105">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" aria-label="Go to page {{ $page }}"
                               class="inline-flex items-center justify-center min-w-[2.1rem] h-8 px-2.5 rounded-xl text-xs font-mono text-slate-400 hover:text-white bg-transparent hover:bg-white/10 border border-transparent hover:border-white/15 transition-all active:scale-95">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        <div class="h-4 w-[1px] bg-white/10 mx-0.5 hidden sm:block"></div>

        {{-- Next Page Button --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next Page" title="Go to Next Page"
               class="inline-flex items-center gap-1.5 px-3 h-8 rounded-xl text-xs font-mono text-slate-300 hover:text-white bg-white/5 hover:bg-indigo-600/20 border border-white/10 hover:border-indigo-500/40 transition-all shadow-sm group">
                <span class="hidden sm:inline font-medium text-[11px]">Next</span>
                <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @else
            <span aria-disabled="true" aria-label="Next Page"
                  class="inline-flex items-center gap-1.5 px-3 h-8 rounded-xl text-xs font-mono text-slate-600 bg-white/[0.02] border border-white/5 cursor-not-allowed select-none opacity-50">
                <span class="hidden sm:inline font-medium text-[11px]">Next</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </span>
        @endif

        {{-- Last Page Button (last position) --}}
        @if ($paginator->currentPage() < $paginator->lastPage())
            <a href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="Last Page" title="Go to Last Page ({{ $paginator->lastPage() }})"
               class="inline-flex items-center gap-1.5 px-3 h-8 rounded-xl text-xs font-mono text-slate-300 hover:text-white bg-white/5 hover:bg-indigo-600/20 border border-white/10 hover:border-indigo-500/40 transition-all shadow-sm group">
                <span class="hidden sm:inline font-medium text-[11px]">Last</span>
                <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </a>
        @else
            <span aria-disabled="true" aria-label="Last Page"
                  class="inline-flex items-center gap-1.5 px-3 h-8 rounded-xl text-xs font-mono text-slate-600 bg-white/[0.02] border border-white/5 cursor-not-allowed select-none opacity-50">
                <span class="hidden sm:inline font-medium text-[11px]">Last</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </span>
        @endif
    </nav>
@endif
