@extends('admin.layout')

@section('title', 'Manage Testimonials')
@section('page_title', 'Client Testimonials')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-white">Client Testimonials</h1>
                <p class="text-xs text-slate-400">Quotes and reviews displayed in the What Amazing people Say section across
                    all themes.</p>
            </div>
            <a href="{{ route('admin.testimonials.create') }}"
                class="theme-aware-create-btn px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span> New Testimonial </span>
            </a>
        </div>

        <!-- TOP THEME FILTER COMPONENT (Select2 / Selectpicker / AngularJS Style) -->
        @include('admin.components.theme-filter')

        <!-- Testimonials Grid with data-theme filtering -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="testimonialsGrid">
            @forelse($testimonials as $testimonial)
                @php
                    $themeMeta = \App\Models\SiteSetting::getThemeDetails($testimonial->theme);
                @endphp
                <div data-theme="{{ $testimonial->theme }}"
                    class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl flex flex-col justify-between space-y-4 hover:border-indigo-500/40 transition-all duration-300">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between flex-wrap gap-2">
                            <div class="flex items-center gap-1 text-[#f5b82e]">
                                @for ($i = 0; $i < $testimonial->rating; $i++)
                                    &starf;
                                @endfor
                            </div>

                            <!-- Theme Badge -->
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold border {{ $themeMeta['badge'] }}">
                                <span class="w-1.5 h-1.5 rounded-full"
                                    style="background-color: {{ $themeMeta['color'] }}"></span>
                                <span>{{ $themeMeta['short'] }}</span>
                            </span>
                        </div>

                        <p class="text-xs sm:text-sm text-slate-300 italic leading-relaxed">
                            &ldquo;{{ $testimonial->content }}&rdquo;</p>
                    </div>

                    <div class="pt-4 border-t border-white/5 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="{{ $testimonial->avatar }}" alt=""
                                class="w-10 h-10 rounded-full object-cover">
                            <div>
                                <h4 class="text-xs font-bold text-white">{{ $testimonial->client_name }}</h4>
                                <span class="text-[10px] font-mono text-slate-400">{{ $testimonial->client_role }} @
                                    {{ $testimonial->company }}</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" title="Edit"
                                class="p-1.5 rounded-lg text-indigo-400 hover:text-white hover:bg-indigo-600/30 transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST"
                                onsubmit="return confirm('Delete this testimonial?')">
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
                <div class="col-span-2 text-center py-12 text-slate-400 text-xs">No testimonials added yet.</div>
            @endforelse
        </div>
    </div>
@endsection
