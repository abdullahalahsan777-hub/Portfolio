@extends('admin.layout')

@section('title', 'Add Resume Item')
@section('page_title', 'Create Resume Entry')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="w-full space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-white">Create New Career Milestone</h1>
            <a href="{{ route('admin.resume.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Back to
                Resume</a>
        </div>

        <form action="{{ route('admin.resume.store') }}" method="POST"
            class="p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-5">
            @csrf

            <!-- Milestone Type Selector -->
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1.5">Entry Type *</label>
                <div class="grid grid-cols-2 gap-3">
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
            </div>


            <!-- Description (Experience) -->
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Description / Key Responsibilities (Optional, for
                    Experience)</label>
                <textarea name="description" rows="5" data-height="200" placeholder="Describe role achievements, responsibilities, or impact..."
                    class="summernote w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">{{ old('description') }}</textarea>
            </div>

            <!-- Display Theme & Sort Order -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Display Theme</label>
                    <select name="theme"
                        class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                        <option value="all">All Themes</option>
                        <option value="graphic_designer">Graphic Designer</option>
                        <option value="digital_designer_illustrator">Digital Designer &amp; Illustrator</option>
                        <option value="app_developer">App Developer</option>
                        <option value="developer">Developer</option>
                        <option value="uiux_designer">UI/UX Designer</option>
                        <option value="app_software_developer">App &amp; Software Developer</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Display Order</label>
                    <input type="number" name="sort_order" value="1"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-white/10">
                <a href="{{ route('admin.resume.index') }}"
                    class="px-4 py-2 rounded-xl text-xs text-slate-400 hover:text-white">Cancel</a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all">Save
                    Entry</button>
            </div>
        </form>
    </div>
@endsection
