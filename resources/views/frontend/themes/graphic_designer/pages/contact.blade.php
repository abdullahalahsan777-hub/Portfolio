@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#0c0a18] text-[#f5f3ff] min-h-screen selection:bg-[#7c3aed] selection:text-white font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.graphic_designer.partials.header')


    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-widest block mb-2">
                {{ $settings['contact_hero_tag'] ?? ($settings['contact_tag'] ?? 'START A PROJECT') }}
            </span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] tracking-tight">
                {{ $settings['contact_hero_title_line1'] ?? "Let's Build Something" }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-fuchsia-400">{{ $settings['contact_hero_title_highlight'] ?? 'Extraordinary' }}</span>
            </h1>
            <p class="text-slate-300 text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['contact_hero_description'] ?? ($settings['contact_subtitle'] ?? 'Whether you need a complete brand identity revamp, a signature web presence, or ongoing design leadership, I am ready to collaborate.') }}
            </p>
        </div>
    </section>

    <!-- Contact Info & Form -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <div class="lg:col-span-5 space-y-6">
                    <div class="p-6 rounded-3xl bg-[#150f2c] border border-white/10 space-y-3">
                        <span class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-wider block">Direct Email</span>
                        <h4 class="text-xl font-bold font-['Outfit'] text-white">
                            <a href="mailto:{{ $settings['contact_email'] ?? 'contact@william.design' }}" class="hover:text-[#c084fc] transition-colors">
                                {{ $settings['contact_email'] ?? 'contact@william.design' }}
                            </a>
                        </h4>
                        <p class="text-xs text-slate-400">{{ $settings['contact_email_subtext'] ?? 'Response time: under 4 business hours.' }}</p>
                    </div>

                    <div class="p-6 rounded-3xl bg-[#150f2c] border border-white/10 space-y-3">
                        <span class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-wider block">Direct Line</span>
                        <h4 class="text-xl font-bold font-['Outfit'] text-white">
                            <a href="tel:{{ $settings['contact_phone'] ?? '+1-234-567-8901' }}" class="hover:text-[#c084fc] transition-colors">
                                {{ $settings['contact_phone'] ?? '+1-234-567-8901' }}
                            </a>
                        </h4>
                        <p class="text-xs text-slate-400">{{ $settings['contact_phone_subtext'] ?? 'Monday to Friday, 9:00 AM – 6:00 PM EST.' }}</p>
                    </div>

                    <div class="p-6 rounded-3xl bg-[#150f2c] border border-white/10 space-y-3">
                        <span class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-wider block">Studio Headquarters</span>
                        <h4 class="text-base font-bold font-['Outfit'] text-white">
                            {!! $settings['contact_address'] ?? ($settings['contact_location'] ?? '121 King Street, Melbourne, Australia') !!}
                        </h4>
                        <p class="text-xs text-slate-400">{{ $settings['contact_address_subtext'] ?? 'Available worldwide for remote engagements.' }}</p>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div class="p-8 sm:p-10 rounded-3xl bg-[#150f2c] border border-white/10 shadow-2xl">
                        <div id="contactFeedback" class="hidden mb-6"></div>

                        <form id="contactForm" action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-mono text-slate-400 mb-1.5 font-semibold">Your Name *</label>
                                    <input type="text" name="name" required placeholder="Alex Morgan" class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-[#7c3aed]">
                                </div>
                                <div>
                                    <label class="block text-xs font-mono text-slate-400 mb-1.5 font-semibold">Your Email *</label>
                                    <input type="email" name="email" required placeholder="alex@company.com" class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-[#7c3aed]">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-mono text-slate-400 mb-1.5 font-semibold">Subject</label>
                                    <input type="text" name="subject" placeholder="New Brand Identity" class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-[#7c3aed]">
                                </div>
                                <div>
                                    <label class="block text-xs font-mono text-slate-400 mb-1.5 font-semibold">Service Required</label>
                                    <select name="service_type" class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-[#7c3aed]">
                                        <option value="Brand Identity" class="bg-[#150f2c]">Brand Identity</option>
                                        <option value="UI/UX & Product Design" class="bg-[#150f2c]">UI/UX & Product Design</option>
                                        <option value="Mobile App Experience" class="bg-[#150f2c]">Mobile App Experience</option>
                                        <option value="Web Development" class="bg-[#150f2c]">Web Development</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-mono text-slate-400 mb-1.5 font-semibold">Your Message *</label>
                                <textarea name="message" required rows="5" placeholder="Share your brand goals, timelines, and deliverables..." class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-[#7c3aed] resize-none"></textarea>
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="gd-btn-primary w-full justify-center py-3.5 text-sm">
                                    <span>{{ $settings['contact_btn_text'] ?? 'Send Project Inquiry' }}</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @include('frontend.themes.graphic_designer.partials.footer')

</div>
@endsection
