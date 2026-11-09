@extends('admin.layout')

@section('title', 'Edit Skill')
@section('page_title', 'Edit Skill')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="w-full space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <h1 class="text-xl font-bold text-white">Edit Skill: {{ $skill->name }}</h1>
            <a href="{{ route('admin.skills.index') }}"
                class="text-xs text-slate-400 hover:text-white inline-flex items-center gap-1.5">&larr; Back to
                Skills</a>
        </div>

        <form action="{{ route('admin.skills.update', $skill) }}" method="POST"
            class="p-4 sm:p-6 lg:p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Skill Name *</label>
                        <input type="text" name="name" required value="{{ old('name', $skill->name) }}"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Percentage (1-100) *</label>
                        <input type="number" min="1" max="100" name="percentage" required
                            value="{{ old('percentage', $skill->percentage) }}"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Display Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order) }}"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Display Theme</label>
                        @php
                            $targetTheme = old('theme', $skill->theme ?? request('theme', $selectedTheme ?? \App\Models\SiteSetting::getActiveTheme()));
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

                <div>
                    <label class="block text-xs font-mono text-slate-300 font-semibold mb-1.5">Category * (Select or Type
                        New)</label>
                    <div class="relative custom-category-wrapper">
                        <select name="category" id="skillCategorySelect" required
                            class="select2-category-tags no-select2 w-full px-4 py-2.5 rounded-xl bg-[#0d1627] border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-500 transition-colors"
                            data-placeholder="Select or type a category...">
                            @php
                                $categoryOptions = collect($categories ?? \App\Models\Skill::getCategories())
                                    ->push($skill->category)
                                    ->map(fn($c) => trim($c))
                                    ->filter()
                                    ->unique()
                                    ->sort()
                                    ->values();
                                $quickPills = collect($quickCategories ?? \App\Models\Skill::getQuickCategories());
                                $selectedCat = old('category', $skill->category);
                            @endphp
                            @foreach ($categoryOptions as $cat)
                                <option value="{{ $cat }}" {{ $selectedCat === $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Quick Category Pills -->
                    @if ($quickPills->isNotEmpty())
                        <div class="flex items-center gap-1.5 flex-nowrap overflow-hidden mt-2.5 max-w-full">
                            <span
                                class="text-[10px] font-mono text-slate-500 uppercase tracking-wider shrink-0">Quick:</span>
                            @foreach ($quickPills as $pill)
                                <button type="button"
                                    onclick="setSelectCategory('skillCategorySelect', '{{ addslashes($pill) }}')"
                                    title="{{ $pill }}"
                                    class="whitespace-nowrap shrink-0 px-2.5 py-1 rounded-full text-[10px] font-mono bg-white/5 hover:bg-cyan-500/20 text-slate-400 hover:text-cyan-300 border border-white/10 hover:border-cyan-500/30 transition-all cursor-pointer">
                                    {{ $pill }}
                                </button>
                            @endforeach
                        </div>
                    @endif
                    @error('category')
                        <p class="text-[11px] text-rose-400 mt-1 font-mono">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <div class="pt-4 flex flex-col-reverse sm:flex-row items-center justify-end gap-3 border-t border-white/10">
                <a href="{{ route('admin.skills.index') }}"
                    class="w-full sm:w-auto px-4 py-2.5 rounded-xl text-xs text-slate-400 hover:text-white text-center">Cancel</a>
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg text-center">Update
                    Skill</button>
            </div>
        </form>
    </div>
@endsection
