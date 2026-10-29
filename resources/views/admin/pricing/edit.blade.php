@extends('admin.layout')

@section('title', 'Edit Pricing Plan')
@section('page_title', 'Edit Plan')
@section('page_subtitle', 'Group: Website')

@section('content')
<div class="w-full space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold text-white">Edit: {{ $pricing->name }}</h1>
        <a href="{{ route('admin.pricing.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Back to Pricing</a>
    </div>

    <form action="{{ route('admin.pricing.update', $pricing) }}" method="POST" class="p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Plan Name *</label>
                <input type="text" name="name" required value="{{ old('name', $pricing->name) }}" class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Price ($) *</label>
                <input type="number" step="0.01" name="price" required value="{{ old('price', $pricing->price) }}" class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Billing Period *</label>
                <input type="text" name="billing_period" required value="{{ old('billing_period', $pricing->billing_period) }}" class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $pricing->subtitle) }}" class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
        </div>

        <div>
            <label class="block text-xs font-mono text-slate-400 mb-1">Features (one item per line) *</label>
            <textarea name="features" rows="5" required class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">{{ old('features', $pricing->features) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Button Text *</label>
                <input type="text" name="button_text" required value="{{ old('button_text', $pricing->button_text) }}" class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Button Target Link *</label>
                <input type="text" name="button_url" required value="{{ old('button_url', $pricing->button_url) }}" class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1">Display Theme</label>
                <select name="theme" class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs">
                    <option value="all" {{ $pricing->theme === 'all' ? 'selected' : '' }}>All Themes</option>
                    <option value="developer" {{ $pricing->theme === 'developer' ? 'selected' : '' }}>Developer</option>
                    <option value="graphic_designer" {{ $pricing->theme === 'graphic_designer' ? 'selected' : '' }}>Graphic Designer</option>
                    <option value="uiux_designer" {{ $pricing->theme === 'uiux_designer' ? 'selected' : '' }}>UI/UX Designer</option>
                    <option value="app_developer" {{ $pricing->theme === 'app_developer' ? 'selected' : '' }}>App Developer</option>
                    <option value="app_software_developer" {{ $pricing->theme === 'app_software_developer' ? 'selected' : '' }}>App &amp; Software Developer</option>
                    <option value="digital_designer_illustrator" {{ $pricing->theme === 'digital_designer_illustrator' ? 'selected' : '' }}>Digital Designer &amp; Illustrator</option>
                </select>
            </div>
            <div class="flex items-center gap-2 pt-6">
                <input type="checkbox" name="is_featured" value="1" id="is_featured" {{ $pricing->is_featured ? 'checked' : '' }} class="rounded bg-black/40 border-white/20 text-indigo-500">
                <label for="is_featured" class="text-xs text-white cursor-pointer font-medium">Mark as Featured / Most Popular</label>
            </div>
        </div>

        <div class="pt-4 flex items-center justify-end gap-3">
            <a href="{{ route('admin.pricing.index') }}" class="px-4 py-2 rounded-xl text-xs text-slate-400 hover:text-white">Cancel</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg">Update Plan</button>
        </div>
    </form>
</div>
@endsection
