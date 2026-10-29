@extends('admin.layout')

@section('title', 'Edit Service')
@section('page_title', 'Edit Service')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="w-full space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-white">Edit Service: {{ $service->title }}</h1>
            <a href="{{ route('admin.services.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Back to
                Services</a>
        </div>

        <form action="{{ route('admin.services.update', $service) }}" method="POST"
            class="p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Service Title *</label>
                    <input type="text" name="title" required value="{{ old('title', $service->title) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Category Label *</label>
                    <input type="text" name="category" required value="{{ old('category', $service->category) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Description *</label>
                <textarea name="description" rows="5" required data-height="200"
                    class="summernote w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Display Theme</label>
                    <select name="theme"
                        class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                        <option value="all" {{ $service->theme === 'all' ? 'selected' : '' }}>All Themes</option>
                        <option value="developer" {{ $service->theme === 'developer' ? 'selected' : '' }}>Developer</option>
                        <option value="graphic_designer" {{ $service->theme === 'graphic_designer' ? 'selected' : '' }}>
                            Graphic Designer</option>
                        <option value="uiux_designer" {{ $service->theme === 'uiux_designer' ? 'selected' : '' }}>UI/UX
                            Designer</option>
                        <option value="app_developer" {{ $service->theme === 'app_developer' ? 'selected' : '' }}>App
                            Developer</option>
                        <option value="app_software_developer"
                            {{ $service->theme === 'app_software_developer' ? 'selected' : '' }}>App &amp; Software
                            Developer</option>
                        <option value="digital_designer_illustrator"
                            {{ $service->theme === 'digital_designer_illustrator' ? 'selected' : '' }}>Digital Designer
                            &amp; Illustrator</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Display Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3">
                <a href="{{ route('admin.services.index') }}"
                    class="px-4 py-2 rounded-xl text-xs text-slate-400 hover:text-white">Cancel</a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg">Update
                    Service</button>
            </div>
        </form>
    </div>
@endsection
