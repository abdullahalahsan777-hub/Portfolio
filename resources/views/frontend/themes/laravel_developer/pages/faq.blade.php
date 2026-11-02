@extends('frontend.layouts.frontend')

@section('content')
<style>
    :root {
        --theme-primary: #00e5ff;
        --theme-primary-hover: #00b4d8;
        --theme-primary-glow: rgba(0, 229, 255, 0.25);
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
                <span>&lt;knowledgebase:faqs&gt;</span>
                <span>// CLIENT INQUIRIES &amp; ARCHITECTURE</span>
            </div>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-slate-900 dark:text-white">
                FREQUENTLY ASKED <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500">QUESTIONS</span>
            </h1>
            <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-3 max-w-3xl leading-relaxed">
                Clear answers regarding enterprise Laravel development, schema migrations, API performance benchmarks, code quality guarantees, and retainer contracts.
            </p>
        </div>
    </section>

    <!-- FAQs Accordion Section -->
    <section class="py-16 sm:py-20 border-b border-slate-200 dark:border-white/5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            @php
                $faqList = $faqs ?? collect();
            @endphp

            <div class="space-y-4" id="laravelFaqList">
                @forelse($faqList as $index => $faq)
                    @php
                        $question = is_array($faq) ? $faq['question'] : $faq->question;
                        $answer = is_array($faq) ? $faq['answer'] : $faq->answer;
                        $category = is_array($faq) ? ($faq['category'] ?? 'Architecture') : ($faq->category ?? 'Architecture');
                    @endphp
                    <div class="rounded-2xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm hover:border-[var(--theme-primary)]/50 transition-all overflow-hidden" data-faq-item>
                        <button type="button" onclick="toggleLaravelFaq(this)"
                            class="w-full text-left p-6 flex items-center justify-between gap-4 cursor-pointer focus:outline-none group"
                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                            <div class="space-y-1.5 pr-2">
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-mono font-bold text-[var(--theme-primary)] uppercase tracking-wider">{{ $category }}</span>
                                    <span class="text-xs font-mono text-slate-400">Q{{ $index + 1 }}</span>
                                </div>
                                <h3 class="text-base sm:text-lg font-bold font-['Outfit'] text-slate-900 dark:text-white group-hover:text-[var(--theme-primary)] transition-colors leading-snug">
                                    {{ $question }}
                                </h3>
                            </div>
                            <div class="faq-icon-pill shrink-0 w-8 h-8 rounded-full border border-slate-200 dark:border-white/10 bg-slate-100 dark:bg-white/5 flex items-center justify-center text-slate-700 dark:text-white transition-all duration-300 {{ $index === 0 ? 'bg-[var(--theme-primary)] text-black font-bold' : '' }}">
                                <span class="text-sm font-mono font-bold leading-none">{{ $index === 0 ? '−' : '+' }}</span>
                            </div>
                        </button>
                        <div class="faq-content-pane transition-all duration-300 {{ $index === 0 ? 'block' : 'hidden' }}">
                            <div class="px-6 pb-6 pt-0">
                                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed pt-4 border-t border-slate-100 dark:border-white/5">
                                    {{ $answer }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 rounded-2xl border border-dashed border-slate-300 dark:border-white/10 text-center text-slate-500 text-xs font-mono">
                        No FAQ entries registered at the moment.
                    </div>
                @endforelse
            </div>

            <!-- Have More Questions Card -->
            <div class="mt-16 p-8 rounded-3xl bg-slate-900 border border-cyan-500/30 text-white text-center space-y-4 shadow-xl">
                <span class="text-xs font-mono font-bold text-[var(--theme-primary)] uppercase tracking-wider block">
                    HAVE A SPECIFIC SYSTEM ARCHITECTURE QUESTION?
                </span>
                <h3 class="text-2xl font-black font-['Outfit'] uppercase">
                    Schedule A Technical Discovery Call
                </h3>
                <p class="text-xs sm:text-sm text-slate-300 max-w-xl mx-auto leading-relaxed">
                    Have inquiries about database sharding, payment gateway integrations, or legacy code refactoring? Let's discuss your system requirements directly.
                </p>
                <div class="pt-2">
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-cyan-500/25 active:scale-95 transition-all">
                        <span>Get In Touch</span>
                        <span>→</span>
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer Partial -->
    @include('frontend.themes.laravel_developer.partials.footer')

</div>

<script>
    function toggleLaravelFaq(button) {
        const item = button.closest('[data-faq-item]');
        const pane = item.querySelector('.faq-content-pane');
        const icon = button.querySelector('.faq-icon-pill span');
        const isExpanded = button.getAttribute('aria-expanded') === 'true';

        if (isExpanded) {
            button.setAttribute('aria-expanded', 'false');
            pane.classList.add('hidden');
            icon.textContent = '+';
            button.querySelector('.faq-icon-pill').classList.remove('bg-[var(--theme-primary)]', 'text-black');
        } else {
            button.setAttribute('aria-expanded', 'true');
            pane.classList.remove('hidden');
            icon.textContent = '−';
            button.querySelector('.faq-icon-pill').classList.add('bg-[var(--theme-primary)]', 'text-black');
        }
    }
</script>
@endsection
