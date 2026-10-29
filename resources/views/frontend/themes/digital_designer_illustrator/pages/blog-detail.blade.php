@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#cfd3d8] dark:bg-[#0c0d10] text-[#151618] dark:text-[#f1f5f9] min-h-screen selection:bg-[#e26d9b] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip relative transition-colors duration-300">

    <!-- Top Poppy Decoration Background -->
    <div class="absolute top-0 right-0 w-80 h-80 opacity-40 pointer-events-none z-0">
        <img src="{{ asset('images/digital_designer_illustrator/flower.jpg') }}" alt="Poppy accent" class="w-full h-full object-contain">
    </div>

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.digital_designer_illustrator.partials.header')

    <!-- Article Header -->
    <article class="py-16 relative z-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#6f7582] hover:text-[#e26d9b] transition-colors mb-6">
                &larr; Back to Journal
            </a>

            <div class="flex items-center gap-3 text-xs text-[#787f8d] font-mono mb-4">
                <span class="px-3 py-1 rounded-full bg-white/70 text-[#151618] font-sans font-bold uppercase text-[10px]">
                    {{ $post['category'] }}
                </span>
                <span>{{ $post['date'] }}</span>
                <span>•</span>
                <span>{{ $post['read_time'] }}</span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-normal font-['Syne'] text-[#151618] leading-tight mb-8">
                {{ $post['title'] }}
            </h1>

            <div class="rounded-3xl overflow-hidden shadow-2xl mb-12 border border-white/60">
                <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-auto object-cover max-h-[500px]">
            </div>

            <!-- Content -->
            <div class="prose prose-neutral max-w-none text-[#2d3139] leading-relaxed text-sm sm:text-base space-y-6">
                <p class="text-lg text-[#151618] font-medium leading-relaxed">
                    {{ $post['excerpt'] }}
                </p>
                <div class="whitespace-pre-line text-[#4a505d] leading-loose">
                    {{ $post['content'] }}
                </div>
            </div>

            <!-- Author signature -->
            <div class="mt-12 pt-8 border-t border-black/10 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-mono uppercase tracking-widest text-[#787f8d] block">Written By</span>
                    <span class="font-bold text-[#151618] text-sm">{{ $post['author'] }}</span>
                </div>
                <a href="{{ route('contact') }}" class="ddi-btn-pill">
                    <span>Discuss this post</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>
    </article>

    <!-- Footer -->
    @include('frontend.themes.digital_designer_illustrator.partials.footer')

</div>
@endsection
