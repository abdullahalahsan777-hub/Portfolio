@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#080808] text-[#ffffff] min-h-screen selection:bg-[#ff6b00] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.app_software_developer.partials.header')

    <!-- Article Header -->
    <section class="py-20 border-b border-white/5 relative overflow-hidden bg-gradient-to-b from-[#0a0a0a] to-[#080808]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4">
            <div class="flex items-center gap-3">
                <span class="badge-bracket-orange">{{ $post['category'] }}</span>
                <span class="text-xs font-mono text-neutral-400">&bull; {{ $post['date'] }} &bull; {{ $post['read_time'] }}</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-black font-['Outfit'] uppercase tracking-tight text-white leading-tight">
                {{ $post['title'] }}
            </h1>
        </div>
    </section>

    <!-- Article Body -->
    <section class="py-16 bg-[#0a0a0a]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="rounded-3xl overflow-hidden border border-white/10 shadow-2xl bg-black">
                <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-auto object-cover max-h-[500px]">
            </div>

            <div class="prose prose-invert max-w-none text-neutral-300 text-sm leading-relaxed space-y-6">
                <p class="text-base text-neutral-200 font-medium leading-relaxed">
                    {{ $post['excerpt'] }}
                </p>
                <div class="border-t border-white/5 pt-6 whitespace-pre-line">
                    {{ $post['content'] }}
                </div>
            </div>

            <div class="pt-8 border-t border-white/10 flex items-center justify-between">
                <a href="{{ route('blog') }}" class="btn-orange-outline inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider font-['Outfit']">
                    &larr; Back to Articles
                </a>
                <a href="{{ route('contact') }}" class="btn-orange-primary inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider font-['Outfit']">
                    Discuss A Project &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.app_software_developer.partials.footer')

</div>
@endsection
