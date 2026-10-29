@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#080808] text-[#ffffff] min-h-screen selection:bg-[#ff6b00] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.app_software_developer.partials.header')

    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative overflow-hidden bg-gradient-to-b from-[#0a0a0a] to-[#080808]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <span class="badge-bracket-orange mb-3 block">{{ $settings['contact_hero_tag'] ?? 'Get In Touch' }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-white">
                {{ $settings['contact_hero_title_line1'] ?? 'START A' }} <span class="text-[#ff6b00]">{{ $settings['contact_hero_title_highlight'] ?? 'PROJECT' }}</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['contact_hero_description'] ?? "Have a mobile application or enterprise software project in mind? Let's discuss architecture, scope, and timeline." }}
            </p>
        </div>
    </section>

    <!-- Contact Form & Info -->
    <section class="py-20 bg-[#0a0a0a]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-5 space-y-6">
                <span class="badge-bracket-orange">{{ $settings['contact_sidebar_tag'] ?? 'Direct Contacts' }}</span>
                <h2 class="text-2xl font-bold font-['Outfit'] text-white">{{ $settings['contact_form_title'] ?? "Let's build something extraordinary together." }}</h2>
                <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed">
                    {{ $settings['contact_sidebar_desc'] ?? 'Available for contract mobile development, full stack engineering, cloud architecture consulting, and long-term team collaboration.' }}
                </p>

                <div class="space-y-4 pt-4">
                    <div class="p-5 rounded-2xl bg-[#111111] border border-white/5 flex items-center gap-4">
                        <span class="w-10 h-10 rounded-xl bg-[#1a0e05] text-[#ff6b00] flex items-center justify-center font-bold">📍</span>
                        <div>
                            <span class="text-[10px] font-mono text-neutral-400 uppercase block">Location</span>
                            <span class="font-bold text-white text-xs">{{ $settings['contact_location'] ?? 'San Francisco, CA & Remote' }}</span>
                        </div>
                    </div>
                    <div class="p-5 rounded-2xl bg-[#111111] border border-white/5 flex items-center gap-4">
                        <span class="w-10 h-10 rounded-xl bg-[#1a0e05] text-[#ff6b00] flex items-center justify-center font-bold">✉</span>
                        <div>
                            <span class="text-[10px] font-mono text-neutral-400 uppercase block">Email</span>
                            <span class="font-bold text-white text-xs">{{ $settings['contact_email'] ?? 'hello@portfolio.me' }}</span>
                        </div>
                    </div>
                    <div class="p-5 rounded-2xl bg-[#111111] border border-white/5 flex items-center gap-4">
                        <span class="w-10 h-10 rounded-xl bg-[#1a0e05] text-[#ff6b00] flex items-center justify-center font-bold">☎</span>
                        <div>
                            <span class="text-[10px] font-mono text-neutral-400 uppercase block">Phone</span>
                            <span class="font-bold text-white text-xs">{{ $settings['contact_phone'] ?? '+1 (555) 382-9012' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="soft-card p-8 sm:p-10 rounded-3xl shadow-2xl">
                    @if(session('success'))
                        <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-mono text-neutral-400 mb-2">Name *</label>
                                <input type="text" name="name" required class="w-full px-4 py-3.5 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff6b00]" placeholder="Your Name">
                            </div>
                            <div>
                                <label class="block text-xs font-mono text-neutral-400 mb-2">Email *</label>
                                <input type="email" name="email" required class="w-full px-4 py-3.5 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff6b00]" placeholder="Your Email">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-neutral-400 mb-2">Subject</label>
                            <input type="text" name="subject" class="w-full px-4 py-3.5 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff6b00]" placeholder="Project Subject">
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-neutral-400 mb-2">Message *</label>
                            <textarea name="message" rows="4" required class="w-full px-4 py-3.5 rounded-xl bg-black/60 border border-white/10 text-white text-xs focus:outline-none focus:border-[#ff6b00]" placeholder="Project details..."></textarea>
                        </div>

                        <button type="submit" class="btn-orange-outline w-full py-4 rounded-xl text-xs font-black uppercase tracking-wider font-['Outfit']">
                            Send Message &rarr;
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.app_software_developer.partials.footer')

</div>
@endsection
