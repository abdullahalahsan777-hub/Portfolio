@extends('admin.layout')

@section('title', 'Manage Skills')
@section('page_title', 'Technical Skills')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-white">Skills & Competencies</h1>
                <p class="text-xs text-slate-400">Manage tool proficiency percentages shown in the skills section across all
                    themes.</p>
            </div>
            <a href="{{ route('admin.skills.create') }}"
                class="theme-aware-create-btn px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span> New Skill </span>
            </a>
        </div>

        <!-- TOP THEME FILTER COMPONENT (Select2 / Selectpicker / AngularJS Style) -->
        @include('admin.components.theme-filter')

        <!-- Skills Grid with data-theme filtering -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="skillsGrid">
            @forelse($skills as $skill)
                @php
                    $themeMeta = \App\Models\SiteSetting::getThemeDetails($skill->theme);
                @endphp
                <div data-theme="{{ $skill->theme }}"
                    class="p-5 rounded-2xl bg-[#09101d] border border-white/10 shadow-lg flex flex-col justify-between space-y-3 hover:border-indigo-500/40 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-white truncate max-w-[140px]">{{ $skill->name }}</span>
                        <span
                            class="px-2 py-0.5 rounded font-mono text-xs font-bold bg-indigo-500/20 text-indigo-300">{{ $skill->percentage }}%</span>
                    </div>

                    <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500"
                            style="width: {{ $skill->percentage }}%; background-color: {{ $themeMeta['color'] }}"></div>
                    </div>

                    <div
                        class="flex items-center justify-between text-[11px] font-mono text-slate-500 pt-1 border-t border-white/5">
                        <span
                            class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[9px] font-bold border {{ $themeMeta['badge'] }}">
                            <span class="w-1 h-1 rounded-full" style="background-color: {{ $themeMeta['color'] }}"></span>
                            <span>{{ $themeMeta['short'] }}</span>
                        </span>

                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('admin.skills.edit', $skill) }}" title="Edit"
                                class="p-1 rounded-lg text-indigo-400 hover:text-white hover:bg-indigo-600/30 transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST"
                                onsubmit="return confirm('Delete this skill?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete"
                                    class="p-1 rounded-lg text-rose-400 hover:text-white hover:bg-rose-500/30 transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-8 text-xs text-slate-400">No skills added yet.</div>
            @endforelse
        </div>
    </div>
@endsection
