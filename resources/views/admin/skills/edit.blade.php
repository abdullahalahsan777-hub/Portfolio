@extends('admin.layout')

@section('title', 'Edit Skill')
@section('page_title', 'Edit Skill')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="w-full space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-white">Edit Skill: {{ $skill->name }}</h1>
            <a href="{{ route('admin.skills.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Back to
                Skills</a>
        </div>

        <form action="{{ route('admin.skills.update', $skill) }}" method="POST"
            class="p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Skill Name *</label>
                    <input type="text" name="name" required value="{{ old('name', $skill->name) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Category *</label>
                    <input type="text" name="category" required value="{{ old('category', $skill->category) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Percentage (1-100) *</label>
                    <input type="number" min="1" max="100" name="percentage" required
                        value="{{ old('percentage', $skill->percentage) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Display Theme</label>
                    <select name="theme"
                        class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                        <option value="all" {{ $skill->theme === 'all' ? 'selected' : '' }}>All Themes</option>
                        <option value="developer" {{ $skill->theme === 'developer' ? 'selected' : '' }}>Developer</option>
                        <option value="graphic_designer" {{ $skill->theme === 'graphic_designer' ? 'selected' : '' }}>
                            Graphic Designer</option>
                        <option value="uiux_designer" {{ $skill->theme === 'uiux_designer' ? 'selected' : '' }}>UI/UX
                            Designer</option>
                        <option value="app_developer" {{ $skill->theme === 'app_developer' ? 'selected' : '' }}>App
                            Developer</option>
                        <option value="app_software_developer"
                            {{ $skill->theme === 'app_software_developer' ? 'selected' : '' }}>App &amp; Software Developer
                        </option>
                        <option value="digital_designer_illustrator"
                            {{ $skill->theme === 'digital_designer_illustrator' ? 'selected' : '' }}>Digital Designer &amp;
                            Illustrator</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Display Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3">
                <a href="{{ route('admin.skills.index') }}"
                    class="px-4 py-2 rounded-xl text-xs text-slate-400 hover:text-white">Cancel</a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg">Update
                    Skill</button>
            </div>
        </form>
    </div>
@endsection
