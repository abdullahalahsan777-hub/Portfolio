@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#070707] text-[#ffffff] min-h-screen selection:bg-[#00ff88] selection:text-[#070707] font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.developer.partials.header')


    <!-- Page Header -->
    <section class="py-20 border-b border-white/5 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block mb-2">// {{ $settings['contact_hero_tag'] ?? ($settings['contact_tag'] ?? 'INITIATE CONTACT') }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight">
                {{ $settings['contact_hero_title_line1'] ?? "LET'S BUILD SOMETHING" }} <span class="text-[#00ff88]">{{ $settings['contact_hero_title_highlight'] ?? 'EXTRAORDINARY' }}</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['contact_hero_description'] ?? ($settings['contact_subtitle'] ?? 'Have a new application idea, an architecture bottleneck, or an enterprise software project? Drop a message below and expect a response within 24 hours.') }}
            </p>
        </div>
    </section>

    <!-- Contact Form & Info Grid -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Left 5 cols: Details -->
            <div class="lg:col-span-5 space-y-6">
                <div class="p-8 rounded-3xl bg-[#111111] border border-white/10 space-y-6 shadow-2xl">
                    <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block">// {{ $settings['contact_channels_tag'] ?? 'DIRECT CHANNELS' }}</span>
                    
                    <div class="space-y-4 text-xs">
                        <div>
                            <span class="text-neutral-400 block mb-1">Email Address</span>
                            <a href="mailto:{{ $settings['contact_email'] ?? 'glint.info@gmail.com' }}" class="text-white hover:text-[#00ff88] font-bold text-sm transition-colors">
                                {{ $settings['contact_email'] ?? 'glint.info@gmail.com' }}
                            </a>
                        </div>
                        <div>
                            <span class="text-neutral-400 block mb-1">Direct Phone</span>
                            <a href="tel:{{ $settings['contact_phone'] ?? '+1234567890' }}" class="text-white hover:text-[#00ff88] font-bold text-sm font-mono transition-colors">
                                {{ $settings['contact_phone'] ?? '+1 234 567 8900' }}
                            </a>
                        </div>
                        <div>
                            <span class="text-neutral-400 block mb-1">Work Location</span>
                            <p class="text-neutral-300 font-medium">
                                {!! $settings['contact_location'] ?? ($settings['contact_address'] ?? 'Silicon Valley, California, United States') !!}
                            </p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-white/5 space-y-2">
                        <span class="text-[11px] font-mono text-[#00ff88] uppercase block">AVAILABLE FOR CONTRACT SPRINTS</span>
                        <p class="text-[11px] text-neutral-400 leading-relaxed">
                            Open for Q4 architecture design sprints, full-stack builds, and long-term retainer engagements.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right 7 cols: Interactive Form -->
            <div class="lg:col-span-7">
                <div class="p-8 sm:p-10 rounded-3xl bg-[#111111] border border-white/10 shadow-2xl space-y-6">
                    <h3 class="text-2xl font-bold font-['Outfit'] text-white uppercase">{{ $settings['contact_form_title'] ?? ($settings['contact_title'] ?? 'SEND A DIRECT MESSAGE') }}</h3>
                    
                    @if(session('success'))
                        <div class="p-4 rounded-2xl bg-[#00ff88]/10 border border-[#00ff88]/30 text-[#00ff88] text-xs font-mono">
                            ✓ {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-mono text-neutral-400 mb-1.5 uppercase">Full Name *</label>
                                <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#00ff88] transition-colors" placeholder="e.g. John Doe">
                            </div>
                            <div>
                                <label class="block text-xs font-mono text-neutral-400 mb-1.5 uppercase">Work Email *</label>
                                <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#00ff88] transition-colors" placeholder="e.g. john@company.com">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-neutral-400 mb-1.5 uppercase">Project Subject *</label>
                            <input type="text" name="subject" required class="w-full px-4 py-3 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#00ff88] transition-colors" placeholder="e.g. Full-Stack Web Architecture Sprint">
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-neutral-400 mb-1.5 uppercase">Project Scope / Details *</label>
                            <textarea name="message" rows="5" required class="w-full px-4 py-3 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#00ff88] transition-colors" placeholder="Describe your technical requirements, goals, timelines, and stack preferences..."></textarea>
                        </div>

                        <button type="submit" class="dev-btn-primary w-full justify-center py-3.5 text-xs">
                            <span>{{ $settings['contact_btn_text'] ?? 'TRANSMIT MESSAGE' }}</span> ➔
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.developer.partials.footer')

</div>
@endsection
