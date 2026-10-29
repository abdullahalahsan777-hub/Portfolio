@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#0c0a18] text-[#f5f3ff] min-h-screen selection:bg-[#7c3aed] selection:text-white font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.graphic_designer.partials.header')


    <!-- Post Article -->
    <article class="py-20 border-b border-white/5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 text-xs font-mono text-[#a855f7] mb-6 hover:underline">
                <span>&larr;</span> Back to All Articles
            </a>

            <div class="flex items-center gap-3 text-xs font-mono text-slate-400 mb-4">
                <span class="px-3 py-1 rounded-full bg-[#7c3aed] text-white font-bold">{{ $post['category'] }}</span>
                <span>&bull;</span>
                <span>{{ $post['date'] }}</span>
                <span>&bull;</span>
                <span>{{ $post['read_time'] }}</span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-black font-['Outfit'] tracking-tight leading-tight">
                {{ $post['title'] }}
            </h1>

            <div class="mt-8 rounded-3xl overflow-hidden aspect-[16/9] bg-neutral-900 border border-[#a855f7]/25 shadow-2xl">
                <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover">
            </div>

            <div class="mt-12 space-y-6 text-sm sm:text-base text-slate-300 leading-relaxed font-normal">
                <p class="text-lg text-white font-medium leading-relaxed">
                    {{ $post['excerpt'] }}
                </p>
                <div class="p-6 rounded-2xl bg-[#150f2c] border-l-4 border-[#7c3aed] text-sm text-purple-200 italic my-6">
                    "True visual identity is not an ornament; it is the distillation of a brand's unique ethos into unmistakable visual clarity."
                </div>
                <p>
                    {!! nl2br(e($post['content'])) !!}
                </p>
            </div>

            <!-- Author Card -->
            <div class="mt-16 p-8 rounded-3xl bg-[#150f2c] border border-white/10 flex items-center gap-6">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80" class="w-16 h-16 rounded-2xl object-cover border-2 border-[#7c3aed]">
                <div>
                    <span class="text-[10px] font-mono text-[#a855f7] uppercase font-bold">Author</span>
                    <h4 class="text-base font-bold text-white font-['Outfit']">{{ $post['author'] }}</h4>
                    <p class="text-xs text-slate-400 mt-1">Award-winning Visual & Brand Identity Director crafting distinctive creative legacies.</p>
                </div>
            </div>

            <!-- Related Articles -->
            @if(!empty($relatedPosts))
                <div class="mt-20 pt-12 border-t border-white/10">
                    <h3 class="text-2xl font-bold font-['Outfit'] text-white mb-8">Related Reads</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($relatedPosts as $r)
                            <a href="{{ route('blog.detail', $r['slug']) }}" class="p-5 rounded-2xl bg-[#150f2c] border border-white/5 hover:border-[#a855f7]/40 transition-all block group">
                                <span class="text-[10px] font-mono text-[#a855f7] uppercase">{{ $r['category'] }} &bull; {{ $r['read_time'] }}</span>
                                <h4 class="text-base font-bold text-white group-hover:text-[#c084fc] transition-colors font-['Outfit'] mt-2">{{ $r['title'] }}</h4>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </article>

    <!-- Footer matching uploaded design image -->
    @include('frontend.themes.graphic_designer.partials.footer')

</div>
@endsection
