@extends('admin.layout')

@section('title', 'Add Service')
@section('page_title', 'Create Service')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="w-full space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <h1 class="text-xl font-bold text-white">Create New Service Offering</h1>
            <a href="{{ route('admin.services.index') }}" class="text-xs text-slate-400 hover:text-white inline-flex items-center gap-1.5">&larr; Back to
                Services</a>
        </div>

        <form action="{{ route('admin.services.store') }}" method="POST"
            class="p-4 sm:p-6 lg:p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Service Title *</label>
                    <input type="text" name="title" required placeholder="e.g. Website Development"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Category Label *</label>
                    <input type="text" name="category" required placeholder="e.g. Development, Design, UI/UX"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Description *</label>
                <textarea name="description" rows="5" required data-height="200" placeholder="Describe what clients receive..."
                    class="summernote w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500"></textarea>
            </div>


            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Display Theme</label>
                    @php
                        $targetTheme = request('theme', $selectedTheme ?? \App\Models\SiteSetting::getActiveTheme());
                    @endphp
                    <select name="theme"
                        class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                        <option value="all" {{ $targetTheme === 'all' ? 'selected' : '' }}>All Themes</option>
                        <option value="developer" {{ $targetTheme === 'developer' ? 'selected' : '' }}>Developer</option>
                        <option value="graphic_designer" {{ $targetTheme === 'graphic_designer' ? 'selected' : '' }}>Graphic
                            Designer</option>
                        <option value="uiux_designer" {{ $targetTheme === 'uiux_designer' ? 'selected' : '' }}>UI/UX
                            Designer</option>
                        <option value="app_developer" {{ $targetTheme === 'app_developer' ? 'selected' : '' }}>App Developer
                        </option>
                        <option value="app_software_developer"
                            {{ $targetTheme === 'app_software_developer' ? 'selected' : '' }}>App &amp; Software Developer
                        </option>
                        <option value="digital_designer_illustrator"
                            {{ $targetTheme === 'digital_designer_illustrator' ? 'selected' : '' }}>Digital Designer &amp;
                            Illustrator</option>
                        <option value="laravel_developer"
                            {{ $targetTheme === 'laravel_developer' ? 'selected' : '' }}>Full-Stack Laravel Developer</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Display Order</label>
                    <input type="number" name="sort_order" value="1"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div class="pt-4 flex flex-col-reverse sm:flex-row items-center justify-end gap-3 border-t border-white/10">
                <a href="{{ route('admin.services.index') }}"
                    class="w-full sm:w-auto px-4 py-2.5 rounded-xl text-xs text-slate-400 hover:text-white text-center">Cancel</a>
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg text-center">Save
                    Service</button>
            </div>
        </form>
    </div>
@endsection
