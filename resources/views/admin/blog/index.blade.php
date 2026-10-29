@extends('admin.layout')

@section('title', 'Manage Blog Articles')
@section('page_title', 'Articles & Insights')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="space-y-6">

        <!-- Header & Action -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-white">Blog Articles & Publications</h1>
                <p class="text-xs text-slate-400 mt-1">Manage thought leadership, case study posts, and technical articles
                    shown across all themes.</p>
            </div>
            <a href="{{ route('admin.blog.create') }}"
                class="theme-aware-create-btn px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span> Write Article</span>
            </a>
        </div>

        <!-- TOP THEME FILTER COMPONENT (Select2 / Selectpicker / AngularJS Style) -->
        @include('admin.components.theme-filter')

        <!-- Articles Grid with data-theme filtering -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="blogGrid">
            @forelse($posts as $post)
                @php
                    $themeMeta = \App\Models\SiteSetting::getThemeDetails($post->theme);
                @endphp
                <div data-theme="{{ $post->theme }}"
                    class="rounded-3xl bg-[#09101d] border border-white/10 overflow-hidden flex flex-col justify-between shadow-xl group hover:border-indigo-500/40 transition-all duration-300">
                    <div class="relative aspect-video w-full overflow-hidden bg-slate-900">
                        @if (!empty($post->image))
                            <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-600 font-mono text-xs">No
                                Cover Image</div>
                        @endif

                        <div class="absolute top-3 left-3 flex items-center gap-1.5">
                            <span
                                class="px-2.5 py-1 rounded-full text-[10px] font-mono font-bold bg-black/70 backdrop-blur-md text-indigo-300 border border-white/10">
                                {{ $post->category }}
                            </span>

                            <!-- Theme Badge -->
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold bg-black/80 backdrop-blur border {{ $themeMeta['badge'] }}">
                                <span class="w-1.5 h-1.5 rounded-full"
                                    style="background-color: {{ $themeMeta['color'] }}"></span>
                                <span>{{ $themeMeta['short'] }}</span>
                            </span>
                        </div>

                        @if (!$post->is_published)
                            <span
                                class="absolute top-3 right-3 px-2.5 py-1 rounded-full text-[10px] font-mono font-bold bg-amber-500/80 text-black">
                                Draft
                            </span>
                        @endif
                    </div>

                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <div class="flex items-center gap-2 text-[11px] font-mono text-slate-400 mb-2">
                                <span>{{ $post->date }}</span>
                                <span>&bull;</span>
                                <span>{{ $post->read_time }}</span>
                            </div>
                            <h3
                                class="text-base font-bold text-white leading-snug line-clamp-2 hover:text-indigo-300 transition-colors">
                                {{ $post->title }}
                            </h3>
                            <p class="text-xs text-slate-400 mt-2 line-clamp-3 leading-relaxed">
                                {{ $post->excerpt }}
                            </p>
                        </div>

                        <div
                            class="pt-4 border-t border-white/5 flex items-center justify-between text-[11px] font-mono text-slate-400">
                            <span>Order: #{{ $post->sort_order }}</span>
                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('admin.blog.edit', $post) }}" title="Edit"
                                    class="p-1.5 rounded-lg text-indigo-400 hover:text-white hover:bg-indigo-600/30 transition-all">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.blog.destroy', $post) }}" method="POST"
                                    onsubmit="return confirm('Delete this article?')">
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
                    </div>
                </div>
            @empty
                <div
                    class="col-span-3 text-center py-12 bg-[#09101d] rounded-3xl border border-white/5 text-slate-400 text-xs">
                    No blog articles published yet. Click <strong>+ Write Article</strong> to publish your first post.
                </div>
            @endforelse
        </div>

    </div>
@endsection
