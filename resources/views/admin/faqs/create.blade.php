@extends('admin.layout')

@section('title', 'Add FAQ')
@section('page_title', 'Create FAQ')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="w-full space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <h1 class="text-xl font-bold text-white">Create FAQ Question</h1>
            <a href="{{ route('admin.faqs.index') }}"
                class="text-xs text-slate-400 hover:text-white inline-flex items-center gap-1.5">&larr; Back to FAQs</a>
        </div>

        <form action="{{ route('admin.faqs.store') }}" method="POST"
            class="p-4 sm:p-6 lg:p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-5">
            @csrf

            <!-- Question -->
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Question *</label>
                <input type="text" name="question" required value="{{ old('question') }}"
                    placeholder="e.g. What is your typical project timeline?"
                    class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <!-- Category -->
                <div>
                    <label class="block text-xs font-mono text-slate-300 font-semibold mb-1.5">Category * (Select or Type
                        New)</label>
                    <div class="relative custom-category-wrapper">
                        <select name="category" id="faqCategorySelect" required
                            class="select2-category-tags no-select2 w-full px-4 py-2.5 rounded-xl bg-[#0d1627] border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-500 transition-colors"
                            data-placeholder="Select or type a category...">
                            @php
                                $categoryOptions = collect($categories ?? \App\Models\Faq::getCategories())
                                    ->map(fn($c) => trim($c))
                                    ->filter()
                                    ->unique()
                                    ->values();
                                $quickPills = collect($quickCategories ?? \App\Models\Faq::getQuickCategories());
                                $defaultCat = old('category', $categoryOptions->first() ?? 'General');
                            @endphp
                            @foreach ($categoryOptions as $cat)
                                <option value="{{ $cat }}" {{ $defaultCat === $cat ? 'selected' : '' }}>
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
                                    onclick="setSelectCategory('faqCategorySelect', '{{ addslashes($pill) }}')"
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

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Display Theme</label>
                    @php
                        $targetTheme = request('theme', $selectedTheme ?? \App\Models\SiteSetting::getActiveTheme());
                    @endphp
                    <select name="theme"
                        class="w-full px-3 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                        <option value="all" {{ $targetTheme === 'all' ? 'selected' : '' }}>All Themes</option>
                        <option value="developer" {{ $targetTheme === 'developer' ? 'selected' : '' }}>Developer</option>
                        <option value="graphic_designer" {{ $targetTheme === 'graphic_designer' ? 'selected' : '' }}>
                            Graphic
                            Designer</option>
                        <option value="uiux_designer" {{ $targetTheme === 'uiux_designer' ? 'selected' : '' }}>UI/UX
                            Designer</option>
                        <option value="app_developer" {{ $targetTheme === 'app_developer' ? 'selected' : '' }}>App
                            Developer
                        </option>
                        <option value="app_software_developer"
                            {{ $targetTheme === 'app_software_developer' ? 'selected' : '' }}>App &amp; Software Developer
                        </option>
                        <option value="digital_designer_illustrator"
                            {{ $targetTheme === 'digital_designer_illustrator' ? 'selected' : '' }}>Digital Designer &amp;
                            Illustrator</option>
                        <option value="laravel_developer" {{ $targetTheme === 'laravel_developer' ? 'selected' : '' }}>
                            Full-Stack Laravel Developer</option>
                    </select>
                </div>
            </div>

            <!-- Answer -->
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Detailed Answer *</label>
                <textarea name="answer" rows="5" required data-height="220"
                    placeholder="Write the complete answer provided to clients..."
                    class="summernote w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm leading-relaxed focus:outline-none focus:border-indigo-500">{{ old('answer') }}</textarea>
            </div>

            <div class="w-full flex justify-between items-center gap-10 border-t border-white/10">
                <div class="flex items-center pt-5">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" checked
                            class="w-4 h-4 rounded text-indigo-600 bg-black/40 border-white/10 focus:ring-0">
                        <span class="text-xs text-white font-medium">Published / Visible</span>
                    </label>
                </div>

                <div class="pt-4 flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                    <a href="{{ route('admin.faqs.index') }}"
                        class="w-full sm:w-auto px-4 py-2.5 rounded-xl text-xs text-slate-400 hover:text-white text-center">Cancel</a>
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all text-center">Save
                        FAQ</button>
                </div>
            </div>
        </form>
    </div>
@endsection
