@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#070707] text-[#ffffff] min-h-screen selection:bg-[#ff0033] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.app_developer.partials.header')

    <!-- Post Article Header -->
    <section class="py-16 sm:py-24 border-b border-white/5 relative overflow-hidden bg-gradient-to-b from-[#0a0a0a] to-[#070707]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#160507] border border-[#ff0033]/40 text-[#ff0033] text-xs font-mono font-bold uppercase">
                <span>{{ $post['category'] }}</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-black font-['Outfit'] uppercase tracking-tight text-white leading-tight">
                {{ $post['title'] }}
            </h1>
            <div class="flex items-center justify-center gap-4 text-xs font-mono text-neutral-400">
                <span>By {{ $post['author'] ?? 'Alex Rivera' }}</span>
                <span>&bull;</span>
                <span>{{ $post['date'] }}</span>
                <span>&bull;</span>
                <span>{{ $post['read_time'] }}</span>
            </div>
        </div>
    </section>

    <!-- Post Body & Image -->
    <article class="py-16 bg-[#0a0a0a]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="rounded-3xl overflow-hidden border border-white/10 shadow-2xl h-80 sm:h-96">
                <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover">
            </div>

            <div class="prose prose-invert max-w-none text-neutral-300 text-sm sm:text-base leading-relaxed space-y-6">
                <p class="text-lg font-semibold text-white leading-relaxed">
                    {{ $post['excerpt'] }}
                </p>
                <div class="whitespace-pre-line text-neutral-400 leading-loose">
                    {{ $post['content'] }}
                </div>
            </div>

            <div class="pt-8 border-t border-white/5 flex items-center justify-between">
                <a href="{{ route('blog') }}" class="text-xs font-mono text-[#ff0033] font-bold hover:underline">&larr; Back to all articles</a>
                <a href="{{ route('contact') }}" class="px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#ff0033] text-white">Discuss This Project &rarr;</a>
            </div>
        </div>
    </article>

    <!-- Footer -->
    @include('frontend.themes.app_developer.partials.footer')

</div>
@endsection
