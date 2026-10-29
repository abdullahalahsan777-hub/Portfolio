@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#070707] text-[#ffffff] min-h-screen selection:bg-[#ff0033] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.app_developer.partials.header')

    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative overflow-hidden bg-gradient-to-b from-[#0a0a0a] to-[#070707]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <span class="text-xs font-mono font-bold text-[#ff0033] uppercase tracking-widest block mb-2">{{ $settings['contact_hero_tag'] ?? '// DIRECT COMMUNICATION' }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-white">
                {{ $settings['contact_hero_title_line1'] ?? 'GET IN TOUCH' }} <span class="text-[#ff0033]">{{ $settings['contact_hero_title_highlight'] ?? ('WITH ' . ($settings['site_name'] ?? 'ALEX RIVERA')) }}</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['contact_hero_description'] ?? "Have a mobile app concept, an upcoming iOS/Android migration, or an enterprise cloud system that needs engineering leadership? Let's talk." }}
            </p>
        </div>
    </section>

    <!-- Contact Form & Info -->
    <section class="py-20 bg-[#0a0a0a]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                <!-- Contact Info Cards -->
                <div class="lg:col-span-5 space-y-4">
                    <div class="p-6 rounded-2xl bg-[#0f0f0f] border-l-4 border-l-[#ff0033] border border-white/5 flex items-center gap-4">
                        <span class="w-10 h-10 rounded-xl bg-[#1c080b] text-[#ff0033] flex items-center justify-center font-bold text-sm">📍</span>
                        <div>
                            <span class="text-[10px] font-mono text-neutral-500 uppercase block">Office Location</span>
                            <span class="font-bold text-white text-sm">{{ $settings['contact_location'] ?? 'San Francisco, CA & Remote' }}</span>
                        </div>
                    </div>

                    <div class="p-6 rounded-2xl bg-[#0f0f0f] border-l-4 border-l-[#ff0033] border border-white/5 flex items-center gap-4">
                        <span class="w-10 h-10 rounded-xl bg-[#1c080b] text-[#ff0033] flex items-center justify-center font-bold text-sm">✉</span>
                        <div>
                            <span class="text-[10px] font-mono text-neutral-500 uppercase block">Direct Email</span>
                            <span class="font-bold text-white text-sm">{{ $settings['contact_email'] ?? 'hello@portfolio.me' }}</span>
                        </div>
                    </div>

                    <div class="p-6 rounded-2xl bg-[#0f0f0f] border-l-4 border-l-[#ff0033] border border-white/5 flex items-center gap-4">
                        <span class="w-10 h-10 rounded-xl bg-[#1c080b] text-[#ff0033] flex items-center justify-center font-bold text-sm">☎</span>
                        <div>
                            <span class="text-[10px] font-mono text-neutral-500 uppercase block">Phone / WhatsApp</span>
                            <span class="font-bold text-white text-sm">{{ $settings['contact_phone'] ?? '+1 (555) 382-9012' }}</span>
                        </div>
                    </div>

                    <div class="p-6 rounded-2xl bg-[#0f0f0f] border-l-4 border-l-[#ff0033] border border-white/5 space-y-2">
                        <span class="text-xs font-mono font-bold text-[#ff0033] uppercase">Guaranteed Response Window</span>
                        <p class="text-xs text-neutral-400 leading-relaxed">
                            All prospective inquiries receive a technical assessment and timeline response within 24 business hours.
                        </p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-7 p-8 rounded-3xl bg-[#0f0f0f] border border-white/10 shadow-2xl">
                    @if(session('success'))
                        <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-mono text-neutral-400 mb-1">Your Name *</label>
                                <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl bg-black/50 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff0033]" placeholder="Sarah Connor">
                            </div>
                            <div>
                                <label class="block text-xs font-mono text-neutral-400 mb-1">Your Email *</label>
                                <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl bg-black/50 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff0033]" placeholder="sarah@enterprise.io">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-neutral-400 mb-1">Subject / Platform Scope</label>
                            <input type="text" name="subject" class="w-full px-4 py-3 rounded-xl bg-black/50 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff0033]" placeholder="iOS & Android Cross-Platform App">
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-neutral-400 mb-1">Project Details *</label>
                            <textarea name="message" rows="5" required class="w-full px-4 py-3 rounded-xl bg-black/50 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff0033]" placeholder="Outline your requirements, target platforms, and target launch window..."></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 rounded-xl font-black text-xs uppercase tracking-wider bg-gradient-to-r from-[#ff0033] to-[#e60026] text-white shadow-xl shadow-[#ff0033]/25 hover:scale-[1.01] transition-all">
                            Send Message &rarr;
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.app_developer.partials.footer')

</div>
@endsection
