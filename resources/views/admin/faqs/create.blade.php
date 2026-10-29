@extends('admin.layout')

@section('title', 'Add FAQ')
@section('page_title', 'Create FAQ')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="w-full space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-white">Create FAQ Question</h1>
            <a href="{{ route('admin.faqs.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Back to FAQs</a>
        </div>

        <form action="{{ route('admin.faqs.store') }}" method="POST"
            class="p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <!-- Question -->
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Question *</label>
                    <input type="text" name="question" required value="{{ old('question') }}"
                        placeholder="e.g. What is your typical project timeline?"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Category / Topic *</label>
                    <input type="text" name="category" required value="{{ old('category', 'General') }}"
                        placeholder="e.g. Process, Pricing, Timeline, Technical"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <!-- Answer -->
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Detailed Answer *</label>
                <textarea name="answer" rows="5" required data-height="220" placeholder="Write the complete answer provided to clients..."
                    class="summernote w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm leading-relaxed focus:outline-none focus:border-indigo-500">{{ old('answer') }}</textarea>
            </div>

            <!-- Theme, Sort Order & Published -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Display Theme</label>
                    @php
                        $targetTheme = request('theme', $selectedTheme ?? \App\Models\SiteSetting::getActiveTheme());
                    @endphp
                    <select name="theme"
                        class="w-full px-3 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
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
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Display Order</label>
                    <input type="number" name="sort_order" value="1"
                        class="w-full px-3 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                </div>
                <div class="flex items-center pt-5">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" checked
                            class="w-4 h-4 rounded text-indigo-600 bg-black/40 border-white/10 focus:ring-0">
                        <span class="text-xs text-white font-medium">Published / Visible</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-white/10">
                <a href="{{ route('admin.faqs.index') }}"
                    class="px-4 py-2 rounded-xl text-xs text-slate-400 hover:text-white">Cancel</a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all">Save
                    FAQ</button>
            </div>
        </form>
    </div>
@endsection
