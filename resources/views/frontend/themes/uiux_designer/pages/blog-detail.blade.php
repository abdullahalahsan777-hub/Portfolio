@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#080808] text-white min-h-screen selection:bg-[#ccff00] selection:text-[#080808] font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.uiux_designer.partials.header')


    <!-- Post Header -->
    <article class="py-20 border-b border-white/5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 text-xs font-mono text-[#ccff00] mb-6 hover:underline">
                <span>&larr;</span> Back to All Articles
            </a>
            
            <div class="flex items-center gap-3 text-xs font-mono text-neutral-400 mb-4">
                <span class="px-3 py-1 rounded-full bg-[#ccff00] text-[#080808] font-bold">{{ $post['category'] }}</span>
                <span>&bull;</span>
                <span>{{ $post['date'] }}</span>
                <span>&bull;</span>
                <span>{{ $post['read_time'] }}</span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-black font-['Outfit'] tracking-tight leading-tight">
                {{ $post['title'] }}
            </h1>

            <div class="mt-8 rounded-3xl overflow-hidden aspect-[16/9] bg-neutral-900 border border-white/10 shadow-2xl">
                <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover">
            </div>

            <!-- Content Body -->
            <div class="mt-12 space-y-6 text-sm sm:text-base text-neutral-300 leading-relaxed font-normal">
                <p class="text-lg text-white font-medium leading-relaxed">
                    {{ $post['excerpt'] }}
                </p>
                <div class="p-6 rounded-2xl bg-[#121212] border-l-4 border-[#ccff00] text-sm text-neutral-200 italic my-6">
                    "Design systems succeed not because of the components in Figma, but because of the shared mental models between designers and engineers."
                </div>
                <p>
                    {!! nl2br(e($post['content'])) !!}
                </p>
                <p>
                    When evaluating usability, always prioritize task completion velocity over visual complexity. A streamlined interaction that removes a single friction step delivers compound dividends in conversion metrics and overall customer satisfaction.
                </p>
            </div>

            <!-- Author Card -->
            <div class="mt-16 p-8 rounded-3xl bg-[#121212] border border-white/10 flex items-center gap-6">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80" class="w-16 h-16 rounded-2xl object-cover border-2 border-[#ccff00]">
                <div>
                    <span class="text-[10px] font-mono text-[#ccff00] uppercase font-bold">Written By</span>
                    <h4 class="text-base font-bold text-white font-['Outfit']">{{ $post['author'] }}</h4>
                    <p class="text-xs text-neutral-400 mt-1">Lead UI/UX & Design Systems Architect with 12+ years of experience crafting enterprise digital products.</p>
                </div>
            </div>

            <!-- Related Articles -->
            @if(!empty($relatedPosts))
                <div class="mt-20 pt-12 border-t border-white/10">
                    <h3 class="text-2xl font-bold font-['Outfit'] text-white mb-8">Related Insights</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($relatedPosts as $r)
                            <a href="{{ route('blog.detail', $r['slug']) }}" class="p-5 rounded-2xl bg-[#111111] border border-white/5 hover:border-[#ccff00]/40 transition-all block group">
                                <span class="text-[10px] font-mono text-[#ccff00] uppercase">{{ $r['category'] }} &bull; {{ $r['read_time'] }}</span>
                                <h4 class="text-base font-bold text-white group-hover:text-[#ccff00] transition-colors font-['Outfit'] mt-2">{{ $r['title'] }}</h4>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </article>

    <!-- Footer matching uploaded design image -->
    @include('frontend.themes.uiux_designer.partials.footer')

</div>
@endsection
