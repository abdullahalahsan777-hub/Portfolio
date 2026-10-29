@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#070707] text-[#ffffff] min-h-screen selection:bg-[#00ff88] selection:text-[#070707] font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.developer.partials.header')


    <!-- Article Content -->
    <article class="py-16 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="space-y-4 mb-8">
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 rounded-full text-xs font-mono font-bold bg-[#00ff88] text-[#070707] uppercase">
                    {{ $post['category'] }}
                </span>
                <span class="text-xs font-mono text-neutral-400">{{ $post['date'] }} &bull; {{ $post['read_time'] }}</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-black font-['Outfit'] text-white uppercase leading-tight">
                {{ $post['title'] }}
            </h1>
        </div>

        <div class="rounded-3xl overflow-hidden border border-white/10 mb-10 shadow-2xl aspect-[16/9]">
            <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover">
        </div>

        <div class="space-y-6 text-sm text-neutral-300 leading-relaxed font-sans">
            <p class="text-base text-neutral-200 font-medium leading-relaxed">
                {{ $post['excerpt'] }}
            </p>

            <h2 class="text-2xl font-bold font-['Outfit'] text-white uppercase pt-4">1. Architectural Foundations</h2>
            <p>
                When building high-traffic web applications, database query optimization and efficient memory management are far more critical than micro-benchmarks. Every connection pool, Redis cache key, and asynchronous queue worker must be engineered with fault tolerance in mind.
            </p>

            <!-- Code block mockup -->
            <div class="rounded-2xl bg-[#111111] border border-white/10 p-5 font-mono text-xs text-[#00ff88] overflow-x-auto">
                <div class="text-neutral-500 mb-2">// Sample Redis Pipeline Dispatcher</div>
                <div>Redis::pipeline(function ($pipe) use ($payload) {</div>
                <div class="pl-4">$pipe->setex("session:{$payload['id']}", 3600, json_encode($payload));</div>
                <div class="pl-4">$pipe->rpush("telemetry:events", $payload['event']);</div>
                <div>});</div>
            </div>

            <h2 class="text-2xl font-bold font-['Outfit'] text-white uppercase pt-4">2. Benchmarks and Real-World Results</h2>
            <p>
                By switching from monolithic synchronous processing to decoupled event queues, response latencies dropped from 450ms down to sub-45ms across 10,000 concurrent socket connections.
            </p>
        </div>

        <!-- Author / Footer Box -->
        <div class="mt-12 p-6 rounded-2xl bg-[#111111] border border-white/10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-[#00ff88] text-[#070707] font-black flex items-center justify-center font-['Outfit'] text-lg">
                    G
                </div>
                <div>
                    <h4 class="text-sm font-bold text-white uppercase font-['Outfit']">Published by Glint Engineering</h4>
                    <span class="text-xs text-neutral-400 font-mono">Lead Architecture &amp; DevOps</span>
                </div>
            </div>
            <a href="{{ route('blog') }}" class="dev-btn-outline text-xs">← Back to Blog</a>
        </div>

    </article>

    <!-- Footer -->
    @include('frontend.themes.developer.partials.footer')

</div>
@endsection
