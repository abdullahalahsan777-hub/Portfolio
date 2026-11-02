<!-- =========================================================================
     FOOTER PARTIAL (Full-Stack Laravel Developer Theme)
     Brand logo, resume biography, contact info, technology badges, newsletter
     and smooth scroll-to-top component.
     ========================================================================= -->
<footer class="bg-slate-950 text-slate-300 border-t border-slate-800/80 pt-16 pb-12 font-['Plus_Jakarta_Sans'] relative overflow-hidden">
    <!-- Ambient Cyber Glows -->
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-[var(--theme-primary)]/5 rounded-full blur-[140px] pointer-events-none -z-10"></div>
    <div class="absolute top-10 left-10 w-80 h-80 bg-blue-600/5 rounded-full blur-[140px] pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 pb-12 border-b border-slate-800/60">
            
            <!-- Col 1: Brand & Bio (4 cols) -->
            <div class="lg:col-span-4 space-y-4">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[var(--theme-primary)] via-blue-600 to-indigo-700 text-white flex items-center justify-center font-mono font-black text-lg shadow-lg shadow-cyan-500/25">
                        &lt;/&gt;
                    </div>
                    <div>
                        <span class="font-black text-xl tracking-tight text-white font-['Outfit'] uppercase block leading-none">
                            MD. ABDULLAH<span class="text-[var(--theme-primary)]">.DEV</span>
                        </span>
                        <span class="text-[10px] font-mono tracking-widest text-[var(--theme-primary)] uppercase font-bold mt-0.5 block">
                            FULL-STACK LARAVEL ARCHITECT
                        </span>
                    </div>
                </a>
                <p class="text-xs text-slate-400 leading-relaxed max-w-sm">
                    Highly motivated and detail-oriented Full-Stack Laravel Developer with 8+ years of expertise in enterprise backend architecture, RESTful API design, database modeling, and modern web application development. Certified Level-3 NSDA professional.
                </p>
                <div class="flex flex-wrap items-center gap-2 pt-2">
                    <span class="px-2.5 py-1 rounded-md bg-slate-900 border border-slate-800 text-[10px] font-mono text-[var(--theme-primary)]">Laravel 11</span>
                    <span class="px-2.5 py-1 rounded-md bg-slate-900 border border-slate-800 text-[10px] font-mono text-cyan-300">PHP 8.3</span>
                    <span class="px-2.5 py-1 rounded-md bg-slate-900 border border-slate-800 text-[10px] font-mono text-indigo-300">Tailwind CSS</span>
                    <span class="px-2.5 py-1 rounded-md bg-slate-900 border border-slate-800 text-[10px] font-mono text-emerald-300">AngularJS</span>
                    <span class="px-2.5 py-1 rounded-md bg-slate-900 border border-slate-800 text-[10px] font-mono text-amber-300">MySQL</span>
                </div>
            </div>

            <!-- Col 2: Navigation Links (2 cols) -->
            <div class="lg:col-span-2 space-y-3">
                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-white">Explore</h4>
                <ul class="space-y-2 text-xs text-slate-400">
                    <li><a href="{{ route('home') }}" class="hover:text-[var(--theme-primary)] transition-colors">Home Page</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-[var(--theme-primary)] transition-colors">About &amp; Resume</a></li>
                    <li><a href="{{ route('portfolio') }}" class="hover:text-[var(--theme-primary)] transition-colors">Featured Projects</a></li>
                    <li><a href="{{ route('blog') }}" class="hover:text-[var(--theme-primary)] transition-colors">Technical Blog</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-[var(--theme-primary)] transition-colors">Common FAQs</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-[var(--theme-primary)] transition-colors">Contact Developer</a></li>
                </ul>
            </div>

            <!-- Col 3: Direct Contact Info (3 cols) -->
            <div class="lg:col-span-3 space-y-3">
                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-white">Direct Inquiries</h4>
                <div class="space-y-2.5 text-xs text-slate-400">
                    <div class="flex items-start gap-2.5">
                        <span class="text-[var(--theme-primary)] mt-0.5">✉</span>
                        <a href="mailto:abdullahalahsan1990@gmail.com" class="hover:text-white transition-colors break-all font-mono">
                            abdullahalahsan1990@gmail.com
                        </a>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <span class="text-[var(--theme-primary)] mt-0.5">☎</span>
                        <a href="tel:+8801718926673" class="hover:text-white transition-colors font-mono">
                            +8801718926673
                        </a>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <span class="text-[var(--theme-primary)] mt-0.5">📍</span>
                        <span>53/20, Razbollovpur, Sherpur Town, Sherpur, Bangladesh</span>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <span class="text-emerald-400 mt-0.5">🏆</span>
                        <span class="font-mono text-[11px] text-slate-300">NSDA Level-3 National Skills Certificate (2025)</span>
                    </div>
                </div>
            </div>

            <!-- Col 4: Newsletter & Quick Subscription (3 cols) -->
            <div class="lg:col-span-3 space-y-3">
                <h4 class="text-xs font-mono font-bold uppercase tracking-wider text-white">Newsletter</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Subscribe for occasional updates on enterprise Laravel architecture, database optimization, and open-source tools.
                </p>
                <form onsubmit="handleFooterNewsletter(event)" class="space-y-2">
                    <div class="relative">
                        <input type="email" id="footerNewsletterEmail" required placeholder="Enter your email address"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-slate-900 border border-slate-800 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-[var(--theme-primary)] transition-all">
                    </div>
                    <button type="submit" id="footerNewsletterBtn"
                        class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-xs uppercase tracking-wider shadow-md shadow-cyan-500/20 active:scale-95 transition-all cursor-pointer">
                        <span>Subscribe</span>
                    </button>
                </form>
            </div>

        </div>

        <!-- Bottom Bar -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <div>
                © {{ date('Y') }} <span class="text-white font-bold">Md. Abdullah Al Ahsan</span>. All rights reserved. Full-Stack Laravel Architecture.
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('cv.download') }}" download class="text-[var(--theme-primary)] hover:underline">Download Resume</a>
                <span>•</span>
                <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-300">Admin Login</a>
                <span>•</span>
                <button type="button" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="hover:text-white flex items-center gap-1 cursor-pointer">
                    <span>Back to Top</span>
                    <span>↑</span>
                </button>
            </div>
        </div>
    </div>
</footer>

<script>
    async function handleFooterNewsletter(e) {
        e.preventDefault();
        const input = document.getElementById('footerNewsletterEmail');
        const btn = document.getElementById('footerNewsletterBtn');
        if (!input || !input.value) return;

        btn.disabled = true;
        btn.textContent = 'Subscribing...';

        try {
            const res = await fetch("{{ route('newsletter.subscribe') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: input.value })
            });
            const data = await res.json();
            if (res.ok && data.success) {
                if (typeof toastr !== 'undefined') toastr.success(data.message || 'Subscribed successfully!');
                input.value = '';
            } else {
                if (typeof toastr !== 'undefined') toastr.info(data.message || 'Already subscribed or invalid email.');
            }
        } catch (err) {
            if (typeof toastr !== 'undefined') toastr.error('Failed to subscribe.');
        } finally {
            btn.disabled = false;
            btn.textContent = 'Subscribe';
        }
    }
</script>
