@extends('admin.layout')

@section('title', 'Add Resume Item')
@section('page_title', 'Create Resume Entry')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="w-full space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <h1 class="text-xl font-bold text-white">Create New Career Milestone</h1>
            <a href="{{ route('admin.resume.index') }}"
                class="text-xs text-slate-400 hover:text-white inline-flex items-center gap-1.5">&larr; Back to
                Resume</a>
        </div>

        <form action="{{ route('admin.resume.store') }}" method="POST"
            class="p-4 sm:p-6 lg:p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-5">
            @csrf

            <!-- Milestone Type Selector -->
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1.5">Entry Type *</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <label
                        class="cursor-pointer p-3 rounded-xl border border-white/10 bg-black/40 flex items-center gap-2.5 has-[:checked]:border-violet-500 has-[:checked]:bg-violet-600/10">
                        <input type="radio" name="type" value="education"
                            {{ ($defaultType ?? 'education') === 'education' ? 'checked' : '' }}
                            class="text-violet-600 focus:ring-0">
                        <div>
                            <span class="text-xs font-bold text-white block">Education</span>
                            <span class="text-[10px] text-slate-400">Degree, Diploma, Certificate</span>
                        </div>
                    </label>
                    <label
                        class="cursor-pointer p-3 rounded-xl border border-white/10 bg-black/40 flex items-center gap-2.5 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-600/10">
                        <input type="radio" name="type" value="experience"
                            {{ ($defaultType ?? 'education') === 'experience' ? 'checked' : '' }}
                            class="text-indigo-600 focus:ring-0">
                        <div>
                            <span class="text-xs font-bold text-white block">Work Experience</span>
                            <span class="text-[10px] text-slate-400">Job Role, Position, Employment</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Title -->
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1" id="title-label">Degree / Job Title *</label>
                    <input type="text" name="title" required value="{{ old('title') }}"
                        placeholder="e.g. Bachelor in Graphic Design or Senior Product Designer"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <!-- Period -->
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Time Period *</label>
                    <input type="text" name="period" required value="{{ old('period') }}"
                        placeholder="e.g. 2020 - 2024 or 2022 - Present"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <!-- Institution / Company -->
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Institution / School (Education)</label>
                    <input type="text" name="institution" value="{{ old('institution') }}"
                        placeholder="e.g. California Institute of the Arts"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <!-- Company -->
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Company / Studio (Experience)</label>
                    <input type="text" name="company" value="{{ old('company') }}" placeholder="e.g. Apex Digital Studio"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <!-- Grade (Education) -->
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Grade / Distinction / Honors (Optional, for
                        Education)</label>
                    <input type="text" name="grade" value="{{ old('grade') }}"
                        placeholder="e.g. GPA 3.92 / 4.0 or Distinction or Honors"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                {{-- Theme --}}
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Display Theme</label>
                    @php
                        $targetTheme = old('theme', request('theme', $selectedTheme ?? \App\Models\SiteSetting::getActiveTheme()));
                    @endphp
                    <select name="theme"
                        class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                        <option value="all" {{ $targetTheme === 'all' ? 'selected' : '' }}>All Themes</option>
                        <option value="developer" {{ $targetTheme === 'developer' ? 'selected' : '' }}>Developer</option>
                        <option value="graphic_designer" {{ $targetTheme === 'graphic_designer' ? 'selected' : '' }}>Graphic Designer</option>
                        <option value="uiux_designer" {{ $targetTheme === 'uiux_designer' ? 'selected' : '' }}>UI/UX Designer</option>
                        <option value="app_developer" {{ $targetTheme === 'app_developer' ? 'selected' : '' }}>App Developer</option>
                        <option value="app_software_developer" {{ $targetTheme === 'app_software_developer' ? 'selected' : '' }}>App &amp; Software Developer</option>
                        <option value="digital_designer_illustrator" {{ $targetTheme === 'digital_designer_illustrator' ? 'selected' : '' }}>Digital Designer &amp; Illustrator</option>
                        <option value="laravel_developer" {{ $targetTheme === 'laravel_developer' ? 'selected' : '' }}>Full-Stack Laravel Developer</option>
                    </select>
                </div>
            </div>


            <!-- Description (Experience) -->
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Description / Key Responsibilities (Optional, for
                    Experience)</label>
                <textarea name="description" rows="5" data-height="200"
                    placeholder="Describe role achievements, responsibilities, or impact..."
                    class="summernote w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">{{ old('description') }}</textarea>
            </div>

            <div class="pt-4 flex flex-col-reverse sm:flex-row items-center justify-end gap-3 border-t border-white/10">
                <a href="{{ route('admin.resume.index') }}"
                    class="w-full sm:w-auto px-4 py-2.5 rounded-xl text-xs text-slate-400 hover:text-white text-center">Cancel</a>
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all text-center">Save
                    Entry</button>
            </div>
        </form>
    </div>
@endsection
