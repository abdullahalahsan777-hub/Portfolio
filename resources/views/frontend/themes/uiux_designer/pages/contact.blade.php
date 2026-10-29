@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#080808] text-white min-h-screen selection:bg-[#ccff00] selection:text-[#080808] font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.uiux_designer.partials.header')


    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block mb-2">{{ $settings['contact_hero_tag'] ?? ($settings['contact_tag'] ?? 'Connect') }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] tracking-tight">
                {{ $settings['contact_hero_title_line1'] ?? "Let's Talk For Your" }} <span class="text-[#ccff00]">{{ $settings['contact_hero_title_highlight'] ?? 'Next Product' }}</span>
            </h1>
            <p class="text-neutral-400 text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['contact_hero_description'] ?? ($settings['contact_subtitle'] ?? "Whether you need a full product redesign, an enterprise design system, or a quick UX audit, send a message and let's turn your vision into reality.") }}
            </p>
        </div>
    </section>

    <!-- Contact Details & Form -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Left 5 cols: Direct Channels -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="p-6 rounded-3xl bg-[#111111] border-l-4 border-l-[#ccff00] border border-white/10 space-y-4">
                        <span class="text-xs font-mono font-bold text-[#ccff00] uppercase">Direct Email</span>
                        <h4 class="text-xl font-bold font-['Outfit'] text-white">
                            <a href="mailto:{{ $settings['contact_email'] ?? 'roy.jones@designstudio.me' }}" class="hover:text-[#ccff00] transition-colors">
                                {{ $settings['contact_email'] ?? 'roy.jones@designstudio.me' }}
                            </a>
                        </h4>
                        <p class="text-xs text-neutral-400">Typical response time: under 4 business hours.</p>
                    </div>

                    <div class="p-6 rounded-3xl bg-[#111111] border-l-4 border-l-[#ccff00] border border-white/10 space-y-4">
                        <span class="text-xs font-mono font-bold text-[#ccff00] uppercase">Direct Phone</span>
                        <h4 class="text-xl font-bold font-['Outfit'] text-white">
                            <a href="tel:{{ $settings['contact_phone'] ?? '+15558392019' }}" class="hover:text-[#ccff00] transition-colors">
                                {{ $settings['contact_phone'] ?? '+1 (555) 839-2019' }}
                            </a>
                        </h4>
                        <p class="text-xs text-neutral-400">Available Monday through Friday, 9am - 6pm PST.</p>
                    </div>

                    <div class="p-6 rounded-3xl bg-[#111111] border-l-4 border-l-[#ccff00] border border-white/10 space-y-4">
                        <span class="text-xs font-mono font-bold text-[#ccff00] uppercase">Studio Office</span>
                        <h4 class="text-base font-bold font-['Outfit'] text-white">
                            {!! $settings['contact_location'] ?? '121 King Street, Melbourne, Australia' !!}
                        </h4>
                        <p class="text-xs text-neutral-400">Available for remote engagements globally.</p>
                    </div>
                </div>

                <!-- Right 7 cols: Interactive Form -->
                <div class="lg:col-span-7">
                    <div class="p-8 sm:p-10 rounded-3xl bg-[#111111] border border-white/10 shadow-2xl">
                        <div id="contactFeedback" class="hidden mb-6"></div>

                        <form id="contactForm" action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-mono text-neutral-400 mb-1.5 font-semibold">Your Name *</label>
                                    <input type="text" name="name" required placeholder="Alex Vance" class="w-full px-4 py-3 rounded-xl bg-black/50 border border-white/10 text-white placeholder-neutral-600 text-sm focus:outline-none focus:border-[#ccff00]">
                                </div>
                                <div>
                                    <label class="block text-xs font-mono text-neutral-400 mb-1.5 font-semibold">Your Email *</label>
                                    <input type="email" name="email" required placeholder="alex@company.com" class="w-full px-4 py-3 rounded-xl bg-black/50 border border-white/10 text-white placeholder-neutral-600 text-sm focus:outline-none focus:border-[#ccff00]">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-mono text-neutral-400 mb-1.5 font-semibold">Phone Number</label>
                                    <input type="text" name="phone" placeholder="+1 (555) 000-0000" class="w-full px-4 py-3 rounded-xl bg-black/50 border border-white/10 text-white placeholder-neutral-600 text-sm focus:outline-none focus:border-[#ccff00]">
                                </div>
                                <div>
                                    <label class="block text-xs font-mono text-neutral-400 mb-1.5 font-semibold">Service Needed</label>
                                    <select name="service_type" class="w-full px-4 py-3 rounded-xl bg-black/50 border border-white/10 text-white text-sm focus:outline-none focus:border-[#ccff00]">
                                        <option value="User Interface Design" class="bg-[#111111]">User Interface Design</option>
                                        <option value="Design System Architecture" class="bg-[#111111]">Design System Architecture</option>
                                        <option value="Mobile App Experience" class="bg-[#111111]">Mobile App Experience</option>
                                        <option value="Usability Testing" class="bg-[#111111]">Usability Testing</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-mono text-neutral-400 mb-1.5 font-semibold">Project Scope & Timeline *</label>
                                <textarea name="message" required rows="5" placeholder="Tell me about your product objectives, timeline expectations, and target audience..." class="w-full px-4 py-3 rounded-xl bg-black/50 border border-white/10 text-white placeholder-neutral-600 text-sm focus:outline-none focus:border-[#ccff00] resize-none"></textarea>
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="uiux-btn-primary w-full justify-center py-3.5 text-sm">
                                    <span>Submit Project Inquiry</span>
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

    <!-- Footer matching uploaded design image -->
    @include('frontend.themes.uiux_designer.partials.footer')

</div>
@endsection
