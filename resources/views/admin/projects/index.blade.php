@extends('admin.layout')

@section('title', 'Manage Projects')
@section('page_title', 'Portfolio Works')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-white">Portfolio Projects</h1>
                <p class="text-xs text-slate-400">Showcase items displayed in the portfolio section across all themes.</p>
            </div>
            <a href="{{ route('admin.projects.create') }}"
                class="theme-aware-create-btn px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span> New Project</span>
            </a>
        </div>

        <!-- TOP THEME FILTER COMPONENT (Select2 / Selectpicker / AngularJS Style) -->
        @include('admin.components.theme-filter')

        <!-- Projects Grid with data-theme filtering -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="projectsGrid">
            @forelse($projects as $project)
                @php
                    $themeMeta = \App\Models\SiteSetting::getThemeDetails($project->theme);
                @endphp
                <div data-theme="{{ $project->theme }}"
                    class="rounded-3xl bg-[#09101d] border border-white/10 overflow-hidden shadow-xl flex flex-col justify-between hover:border-indigo-500/40 transition-all duration-300">
                    <div>
                        <div class="aspect-video w-full bg-slate-900 overflow-hidden relative">
                            <img src="{{ $project->image_url }}" alt="" class="w-full h-full object-cover">
                            <div class="absolute top-3 right-3 flex items-center gap-1.5">
                                <span
                                    class="px-2.5 py-0.5 rounded text-[10px] font-mono font-bold uppercase bg-black/70 text-white backdrop-blur">
                                    {{ $project->category }}
                                </span>
                            </div>

                            <!-- Top Left Theme Badge -->
                            <div class="absolute top-3 left-3">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-black/80 backdrop-blur border {{ $themeMeta['badge'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full"
                                        style="background-color: {{ $themeMeta['color'] }}"></span>
                                    <span>{{ $themeMeta['short'] }}</span>
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-2">
                            <h3 class="text-base font-bold text-white">{{ $project->title }}</h3>
                            <p class="text-xs text-indigo-400 font-mono">{{ $project->subtitle }}</p>
                            <p class="text-xs text-slate-400 line-clamp-2 leading-relaxed">{{ $project->description }}</p>
                            @if (!empty($project->tags))
                                <div class="pt-2 text-[10px] font-mono text-slate-500">{{ $project->tags }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="p-6 pt-0 border-t border-white/5 flex items-center justify-between text-xs mt-4">
                        <span class="font-mono text-[11px] text-slate-400">Order: #{{ $project->sort_order }}</span>
                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('admin.projects.edit', $project) }}" title="Edit"
                                class="p-1.5 rounded-lg text-indigo-400 hover:text-white hover:bg-indigo-600/30 transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                                onsubmit="return confirm('Delete this project?')">
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
            @empty
                <div class="col-span-3 text-center py-12 text-slate-400 text-xs">No projects created yet.</div>
            @endforelse
        </div>
    </div>
@endsection
