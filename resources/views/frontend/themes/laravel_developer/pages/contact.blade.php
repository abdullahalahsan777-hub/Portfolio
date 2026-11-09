@extends('frontend.layouts.frontend')

@section('content')
<style>
    :root {
        --theme-primary: #00e5ff;
        --theme-primary-hover: #00b4d8;
        --theme-primary-glow: rgba(0, 229, 255, 0.25);
        --theme-on-primary: #000000;
    }
</style>

<div class="laravel-dev-wrapper bg-slate-50 dark:bg-[#070b14] text-slate-900 dark:text-slate-100 min-h-screen selection:bg-[var(--theme-primary)] selection:text-black font-['Plus_Jakarta_Sans'] transition-colors duration-300 relative">

    <!-- Header Partial -->
    @include('frontend.themes.laravel_developer.partials.header')

    <!-- Page Title / Hero -->
    <section class="py-16 sm:py-20 border-b border-slate-200 dark:border-white/5 relative overflow-hidden bg-slate-100/60 dark:bg-[#0a0f1d]/60">
        <!-- Ambient Cyber Glows -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-[var(--theme-primary)]/10 rounded-full blur-[140px] pointer-events-none -z-10"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 bg-blue-600/10 rounded-full blur-[140px] pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-[var(--theme-primary)] text-xs font-mono font-bold w-fit mb-4">
                <span>&lt;connect:channels&gt;</span>
                <span>// CLIENT INQUIRIES &amp; COMMUNICATIONS</span>
            </div>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-slate-900 dark:text-white">
                LET'S BUILD <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500">RESILIENT SYSTEMS</span>
            </h1>
            <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-3 max-w-3xl leading-relaxed">
                Whether you need a ground-up enterprise web platform, legacy Laravel modernization, high-concurrency database optimization, or a dedicated contract architect, I am ready to collaborate.
            </p>
        </div>
    </section>

    <!-- Contact Info Cards & Form Section -->
    <section class="py-16 sm:py-20 border-b border-slate-200 dark:border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Left Column (5 cols): Direct Channels from Resume -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <!-- Direct Email -->
                    <div class="p-6 rounded-3xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-mono font-bold text-[var(--theme-primary)] uppercase tracking-wider block">// DIRECT EMAIL</span>
                            <span class="w-8 h-8 rounded-xl bg-cyan-500/10 border border-cyan-500/20 text-[var(--theme-primary)] flex items-center justify-center">
                                <svg class="w-4 h-4 text-[var(--theme-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                        </div>
                        <h4 class="text-lg sm:text-xl font-bold font-['Outfit'] text-slate-900 dark:text-white">
                            <a href="mailto:{{ $settings['contact_email'] ?? 'abdullahalahsan@hotmail.com' }}" class="hover:text-[var(--theme-primary)] transition-colors break-all">
                                {{ $settings['contact_email'] ?? 'abdullahalahsan@hotmail.com' }}
                            </a>
                        </h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-mono">Response time: under 2 business hours.</p>
                    </div>

                    <!-- Direct Line & WhatsApp -->
                    <div class="p-6 rounded-3xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-mono font-bold text-cyan-400 uppercase tracking-wider block">// TELEPHONE / WHATSAPP</span>
                            <span class="w-8 h-8 rounded-xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 flex items-center justify-center">
                                <svg class="w-4 h-4 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </span>
                        </div>
                        <h4 class="text-xl font-bold font-['Outfit'] text-slate-900 dark:text-white">
                            <a href="tel:{{ $settings['contact_phone'] ?? '+8801718926673' }}" class="hover:text-[var(--theme-primary)] transition-colors font-mono">
                                {{ $settings['contact_phone'] ?? '+8801718926673' }}
                            </a>
                        </h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-mono">Available 9:00 AM – 9:00 PM (GMT+6) &amp; worldwide timezones.</p>
                    </div>

                    <!-- Headquarters / Location -->
                    <div class="p-6 rounded-3xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-mono font-bold text-blue-400 uppercase tracking-wider block">// WORKPLACE &amp; LOCATION</span>
                            <span class="w-8 h-8 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                        </div>
                        <h4 class="text-base font-bold font-['Outfit'] text-slate-900 dark:text-white leading-relaxed">
                            {!! $settings['contact_location'] ?? '53/20, Razbollovpur, Sherpur Town, Sherpur, Bangladesh' !!}
                        </h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-mono">Open for 100% remote worldwide contracts &amp; on-site consulting.</p>
                    </div>

                    <!-- Professional Cert Badge -->
                    <div class="p-6 rounded-3xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 space-y-2">
                        <div class="flex items-center gap-2 text-xs font-mono font-bold uppercase">
                            <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span>GOVERNMENT NSDA CERTIFIED</span>
                        </div>
                        <p class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed">
                            NSDA Level-3 Certified in Web Development (National Skills Standard - 2025). High security and industry-standard coding assured.
                        </p>
                    </div>

                </div>

                <!-- Right Column (7 cols): Interactive Contact Form -->
                <div class="lg:col-span-7">
                    <div class="p-8 sm:p-10 rounded-3xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-xl space-y-6">
                        <div>
                            <span class="text-xs font-mono font-bold text-[var(--theme-primary)] uppercase tracking-wider block mb-1">
                                // PROJECT ESTIMATION &amp; INQUIRY FORM
                            </span>
                            <h3 class="text-2xl font-bold font-['Outfit'] text-slate-900 dark:text-white uppercase">
                                Send A Project Specification
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                Fill out the details below. All inquiries receive a comprehensive technical proposal.
                            </p>
                        </div>

                        <form id="contactPageForm" onsubmit="handleContactPageSubmit(event)" class="space-y-4">
                            @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label for="contact_name" class="text-xs font-mono text-slate-600 dark:text-slate-300">Your Name *</label>
                                    <input type="text" id="contact_name" name="name" required placeholder="e.g. John Doe"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:border-[var(--theme-primary)] transition-all">
                                </div>
                                <div class="space-y-1.5">
                                    <label for="contact_email" class="text-xs font-mono text-slate-600 dark:text-slate-300">Your Email *</label>
                                    <input type="email" id="contact_email" name="email" required placeholder="e.g. john@enterprise.com"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:border-[var(--theme-primary)] transition-all">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label for="contact_phone" class="text-xs font-mono text-slate-600 dark:text-slate-300">Phone / WhatsApp</label>
                                    <input type="text" id="contact_phone" name="phone" placeholder="e.g. +1 555 019 2831"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:border-[var(--theme-primary)] transition-all">
                                </div>
                                <div class="space-y-1.5">
                                    <label for="contact_service" class="text-xs font-mono text-slate-600 dark:text-slate-300">Service Category</label>
                                    <select id="contact_service" name="service_type"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-[#0f172a] border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-none focus:border-[var(--theme-primary)] transition-all">
                                        <option value="Enterprise Laravel ERP">Enterprise Laravel ERP</option>
                                        <option value="Multi-Store POS & Inventory">Multi-Store POS &amp; Inventory</option>
                                        <option value="RESTful API & Microservices">RESTful API &amp; Microservices</option>
                                        <option value="Database Tuning & Performance">Database Tuning &amp; Performance</option>
                                        <option value="PDF Invoice Engine">Dynamic PDF Invoice Backend</option>
                                        <option value="Full-Time Contract Engineer">Full-Time Contract Engineer</option>
                                    </select>
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label for="contact_subject" class="text-xs font-mono text-slate-600 dark:text-slate-300">Subject</label>
                                <input type="text" id="contact_subject" name="subject" placeholder="e.g. New Project Inquiry: Multi-Tenant Laravel Architecture"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:border-[var(--theme-primary)] transition-all">
                            </div>

                            <div class="space-y-1.5">
                                <label for="contact_message" class="text-xs font-mono text-slate-600 dark:text-slate-300">Project Overview &amp; Requirements *</label>
                                <textarea id="contact_message" name="message" rows="5" required placeholder="Describe your business needs, technical specs, timelines, or existing bottlenecks..."
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:border-[var(--theme-primary)] transition-all"></textarea>
                            </div>

                            <button type="submit" id="contactSubmitBtn"
                                class="w-full py-4 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-cyan-500/25 active:scale-95 transition-all cursor-pointer flex items-center justify-center gap-2">
                                <span>Transmit Inquiry</span>
                                <span>↗</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer Partial -->
    @include('frontend.themes.laravel_developer.partials.footer')

</div>

<script>
    async function handleContactPageSubmit(e) {
        e.preventDefault();
        const form = e.target;
        const btn = document.getElementById('contactSubmitBtn');
        const formData = new FormData(form);

        btn.disabled = true;
        btn.innerHTML = '<span>Transmitting...</span>';

        try {
            const res = await fetch("{{ route('contact.submit') }}", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            });
            const data = await res.json();
            if (res.ok && data.success) {
                if (typeof toastr !== 'undefined') {
                    toastr.success(data.message || 'Thank you! Your message was sent.');
                } else {
                    alert(data.message || 'Thank you! Your message was sent.');
                }
                form.reset();
            } else {
                const msg = data.message || 'Failed to submit inquiry. Please review your fields.';
                if (typeof toastr !== 'undefined') toastr.error(msg); else alert(msg);
            }
        } catch (err) {
            if (typeof toastr !== 'undefined') toastr.error('An unexpected error occurred. Please try again.'); else alert('An error occurred.');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<span>Transmit Inquiry</span><span>↗</span>';
        }
    }
</script>
@endsection

