@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#cfd3d8] dark:bg-[#0c0d10] text-[#151618] dark:text-[#f1f5f9] min-h-screen selection:bg-[#e26d9b] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip relative transition-colors duration-300">

    <!-- Top Poppy Decoration Background -->
    <div class="absolute top-0 right-0 w-80 h-80 opacity-40 pointer-events-none z-0">
        <img src="{{ asset('images/digital_designer_illustrator/flower.jpg') }}" alt="Poppy accent" class="w-full h-full object-contain">
    </div>

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.digital_designer_illustrator.partials.header')

    <!-- Hero / Title -->
    <section class="py-20 border-b border-black/5 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block text-[11px] font-bold tracking-[0.25em] uppercase text-[#6f7582] mb-3">
                {{ $settings['contact_hero_tag'] ?? '— Direct Inquiry' }}
            </span>
            <h1 class="text-4xl sm:text-6xl font-normal font-['Syne'] tracking-tight text-[#151618] dark:text-white">
                {{ $settings['contact_hero_title_line1'] ?? 'Got an idea?' }} <span class="italic text-[#e26d9b]">{{ $settings['contact_hero_title_highlight'] ?? 'Tell me' }}</span>
            </h1>
            <p class="text-[#555a64] dark:text-[#9aa0aa] text-sm sm:text-base mt-4 max-w-2xl leading-relaxed">
                {{ $settings['contact_hero_description'] ?? 'Whether you have an upcoming branding project, need art direction, or simply want to say hello, feel free to drop a line.' }}
            </p>
        </div>
    </section>

    <!-- Contact Form & Info -->
    <section class="py-20 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-5 space-y-6">
                <span class="inline-block text-[11px] font-bold tracking-[0.25em] uppercase text-[#6f7582]">
                    {{ $settings['contact_sidebar_tag'] ?? '— Studio Info' }}
                </span>
                <h2 class="text-3xl font-normal font-['Syne'] text-[#151618] dark:text-white">
                    {{ $settings['contact_form_title'] ?? "Let's collaborate on meaningful art and design." }}
                </h2>
                <p class="text-xs sm:text-sm text-[#555a64] dark:text-[#9aa0aa] leading-relaxed">
                    {{ $settings['contact_sidebar_desc'] ?? 'Open for select freelance projects, agency partnerships, and collaborative editorial commissions.' }}
                </p>

                <div class="space-y-4 pt-4">
                    <div class="ddi-card-frost p-5 rounded-2xl flex items-center gap-4">
                        <span class="w-10 h-10 rounded-xl bg-white/70 dark:bg-white/10 border border-[#e26d9b]/20 text-[#e26d9b] flex items-center justify-center font-bold shrink-0">
                            <svg class="w-4 h-4 text-[#e26d9b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        <div>
                            <span class="text-[10px] font-mono text-[#787f8d] uppercase block">Location</span>
                            <span class="font-bold text-[#151618] dark:text-white text-xs">{{ $settings['contact_location'] ?? 'London, UK & Worldwide' }}</span>
                        </div>
                    </div>
                    <div class="ddi-card-frost p-5 rounded-2xl flex items-center gap-4">
                        <span class="w-10 h-10 rounded-xl bg-white/70 dark:bg-white/10 border border-[#e26d9b]/20 text-[#e26d9b] flex items-center justify-center font-bold shrink-0">
                            <svg class="w-4 h-4 text-[#e26d9b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <div>
                            <span class="text-[10px] font-mono text-[#787f8d] uppercase block">Direct Email</span>
                            <span class="font-bold text-[#151618] dark:text-white text-xs">{{ $settings['contact_email'] ?? 'alex.walker@design.me' }}</span>
                        </div>
                    </div>
                    <div class="ddi-card-frost p-5 rounded-2xl flex items-center gap-4">
                        <span class="w-10 h-10 rounded-xl bg-white/70 dark:bg-white/10 border border-[#e26d9b]/20 text-[#e26d9b] flex items-center justify-center font-bold shrink-0">
                            <svg class="w-4 h-4 text-[#e26d9b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </span>
                        <div>
                            <span class="text-[10px] font-mono text-[#787f8d] uppercase block">Phone / WhatsApp</span>
                            <span class="font-bold text-[#151618] dark:text-white text-xs">{{ $settings['contact_phone'] ?? '+1 (555) 782-9011' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="ddi-card-frost p-8 sm:p-10 rounded-3xl shadow-xl">
                    @if(session('success'))
                        <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-800 text-xs flex items-center gap-2">
                            <span>✓</span>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(isset($errors) && $errors->any())
                        <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-800 text-xs">
                            <ul class="list-disc pl-4 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[11px] font-mono uppercase tracking-wider text-[#555a64] mb-1.5">Your Name *</label>
                                <input type="text" name="name" required value="{{ old('name') }}" placeholder="Alex Smith"
                                       class="w-full px-4 py-3 rounded-xl bg-white/60 border border-black/10 text-xs text-[#151618] placeholder-neutral-400 focus:outline-none focus:border-[#e26d9b] focus:bg-white transition-all">
                            </div>
                            <div>
                                <label class="block text-[11px] font-mono uppercase tracking-wider text-[#555a64] mb-1.5">Your Email *</label>
                                <input type="email" name="email" required value="{{ old('email') }}" placeholder="alex@company.com"
                                       class="w-full px-4 py-3 rounded-xl bg-white/60 border border-black/10 text-xs text-[#151618] placeholder-neutral-400 focus:outline-none focus:border-[#e26d9b] focus:bg-white transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-mono uppercase tracking-wider text-[#555a64] mb-1.5">Project Scope / Subject</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Brand Identity &amp; 3D Visual Campaign"
                                   class="w-full px-4 py-3 rounded-xl bg-white/60 border border-black/10 text-xs text-[#151618] placeholder-neutral-400 focus:outline-none focus:border-[#e26d9b] focus:bg-white transition-all">
                        </div>

                        <div>
                            <label class="block text-[11px] font-mono uppercase tracking-wider text-[#555a64] mb-1.5">Message / Vision *</label>
                            <textarea name="message" rows="5" required placeholder="Tell me about your project, goals, timeline, and deliverables..."
                                      class="w-full px-4 py-3 rounded-xl bg-white/60 border border-black/10 text-xs text-[#151618] placeholder-neutral-400 focus:outline-none focus:border-[#e26d9b] focus:bg-white transition-all resize-none">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="ddi-btn-pill w-full sm:w-auto">
                            <span>Send Message</span>
                            <span>&rarr;</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.digital_designer_illustrator.partials.footer')

</div>
@endsection
