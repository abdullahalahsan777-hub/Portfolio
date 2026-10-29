@extends('admin.layout')

@section('title', 'Manage Resume')
@section('page_title', 'Education & Experience')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="space-y-6">

        <!-- Top Action Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-white">Resume & Career History</h1>
                <p class="text-xs text-slate-400 mt-1">Manage Education milestones and Work Experience timeline entries shown
                    on the frontend.</p>
            </div>
            <div class="flex items-center gap-2.5">
                <a href="{{ route('admin.resume.create', ['type' => 'education']) }}"
                    class="theme-aware-create-btn px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-violet-600 hover:bg-violet-500 text-white shadow-lg transition-all flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>+ Add Education</span>
                </a>
                <a href="{{ route('admin.resume.create', ['type' => 'experience']) }}"
                    class="theme-aware-create-btn px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>+ Add Experience</span>
                </a>
            </div>
        </div>

        <!-- TOP THEME FILTER COMPONENT (Select2 / Selectpicker / AngularJS Style) -->
        @include('admin.components.theme-filter')

        <!-- Main 2-Column Grid (Education on Left, Experience on Right) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Column 1: Education Section -->
            <div class="space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-white/10">
                    <div class="flex items-center gap-2.5">
                        <div
                            class="w-8 h-8 rounded-lg bg-violet-600/20 text-violet-400 border border-violet-500/30 flex items-center justify-center font-bold">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-white">Education Milestones</h2>
                            <span class="text-[11px] font-mono text-slate-400">Degrees, Diplomas & Certifications</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.resume.create', ['type' => 'education']) }}"
                        class="text-xs text-violet-400 hover:text-violet-300 font-mono">+ Add</a>
                </div>

                <div class="space-y-3" id="educationList">
                    @forelse($education as $edu)
                        @php
                            $themeMeta = \App\Models\SiteSetting::getThemeDetails($edu->theme);
                        @endphp
                        <div data-theme="{{ $edu->theme }}"
                            class="p-5 rounded-2xl bg-[#09101d] border border-white/10 hover:border-violet-500/40 transition-all duration-300 flex flex-col justify-between space-y-3 shadow-lg relative group">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="flex items-center gap-2 flex-wrap mb-1.5">
                                        <span
                                            class="px-2 py-0.5 rounded font-mono text-[11px] font-bold bg-violet-500/20 text-violet-300 border border-violet-500/30 inline-block">{{ $edu->period }}</span>
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[9px] font-mono font-bold border {{ $themeMeta['badge'] }}">
                                            <span class="w-1.5 h-1.5 rounded-full"
                                                style="background-color: {{ $themeMeta['color'] }}"></span>
                                            <span>{{ $themeMeta['short'] }}</span>
                                        </span>
                                    </div>
                                    <h3 class="text-sm font-bold text-white">{{ $edu->title }}</h3>
                                    <p class="text-xs text-slate-400 mt-0.5">{{ $edu->institution }}</p>
                                </div>
                                @if (!empty($edu->grade))
                                    <span
                                        class="text-[10px] font-mono font-semibold px-2 py-0.5 rounded-full bg-slate-800 text-slate-300 shrink-0">{{ $edu->grade }}</span>
                                @endif
                            </div>

                            <div
                                class="flex items-center justify-between text-[11px] font-mono text-slate-500 pt-2 border-t border-white/5">
                                <span class="text-slate-400">Order: #{{ $edu->sort_order }}</span>
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('admin.resume.edit', $edu) }}" title="Edit"
                                        class="p-1.5 rounded-lg text-violet-400 hover:text-white hover:bg-violet-600/30 transition-all">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.resume.destroy', $edu) }}" method="POST"
                                        onsubmit="return confirm('Delete this education entry?')">
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
                        <div class="p-8 text-center bg-[#09101d] rounded-2xl border border-white/5 text-xs text-slate-400">
                            No education records found. Click <strong>+ Add Education</strong> to create one.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Column 2: Experience Section -->
            <div class="space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-white/10">
                    <div class="flex items-center gap-2.5">
                        <div
                            class="w-8 h-8 rounded-lg bg-indigo-600/20 text-indigo-400 border border-indigo-500/30 flex items-center justify-center font-bold">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-white">Work Experience</h2>
                            <span class="text-[11px] font-mono text-slate-400">Career Positions & Key Roles</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.resume.create', ['type' => 'experience']) }}"
                        class="text-xs text-indigo-400 hover:text-indigo-300 font-mono">+ Add</a>
                </div>

                <div class="space-y-3" id="experienceList">
                    @forelse($experience as $exp)
                        @php
                            $themeMeta = \App\Models\SiteSetting::getThemeDetails($exp->theme);
                        @endphp
                        <div data-theme="{{ $exp->theme }}"
                            class="p-5 rounded-2xl bg-[#09101d] border border-white/10 hover:border-indigo-500/40 transition-all duration-300 flex flex-col justify-between space-y-3 shadow-lg relative group">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="flex items-center gap-2 flex-wrap mb-1.5">
                                        <span
                                            class="px-2 py-0.5 rounded font-mono text-[11px] font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 inline-block">{{ $exp->period }}</span>
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[9px] font-mono font-bold border {{ $themeMeta['badge'] }}">
                                            <span class="w-1.5 h-1.5 rounded-full"
                                                style="background-color: {{ $themeMeta['color'] }}"></span>
                                            <span>{{ $themeMeta['short'] }}</span>
                                        </span>
                                    </div>
                                    <h3 class="text-sm font-bold text-white">{{ $exp->title }}</h3>
                                    <p class="text-xs font-semibold text-slate-300 mt-0.5">{{ $exp->company }}</p>
                                </div>
                            </div>

                            @if (!empty($exp->description))
                                <p class="text-xs text-slate-400 leading-relaxed">{{ $exp->description }}</p>
                            @endif

                            <div
                                class="flex items-center justify-between text-[11px] font-mono text-slate-500 pt-2 border-t border-white/5">
                                <span class="text-slate-400">Order: #{{ $exp->sort_order }}</span>
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('admin.resume.edit', $exp) }}" title="Edit"
                                        class="p-1.5 rounded-lg text-indigo-400 hover:text-white hover:bg-indigo-600/30 transition-all">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.resume.destroy', $exp) }}" method="POST"
                                        onsubmit="return confirm('Delete this experience entry?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Delete"
                                            class="p-1.5 rounded-lg text-rose-400 hover:text-white hover:bg-rose-500/30 transition-all">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center bg-[#09101d] rounded-2xl border border-white/5 text-xs text-slate-400">
                            No experience records found. Click <strong>+ Add Experience</strong> to create one.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>
@endsection
