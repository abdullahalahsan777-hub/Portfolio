@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#070707] text-[#ffffff] min-h-screen selection:bg-[#ff0033] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.app_developer.partials.header')

    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative overflow-hidden bg-gradient-to-b from-[#0a0a0a] to-[#070707]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <span class="text-xs font-mono font-bold text-[#ff0033] uppercase tracking-widest block mb-2">{{ $settings['faq_hero_tag'] ?? '// KNOWLEDGE BASE' }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-white">
                {{ $settings['faq_hero_title_line1'] ?? 'FREQUENTLY ASKED' }} <span class="text-[#ff0033]">{{ $settings['faq_hero_title_highlight'] ?? 'QUESTIONS' }}</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['faq_hero_description'] ?? 'Answers to common questions regarding our mobile app engineering process, cross-platform choices, store releases, and milestone deliverables.' }}
            </p>
        </div>
    </section>

    <!-- FAQ Accordion -->
    <section class="py-20 bg-[#0a0a0a]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4" id="appDevFaqContainer">
            @foreach($faqs as $index => $faq)
                <div class="rounded-2xl bg-[#0f0f0f] border border-white/5 hover:border-[#ff0033]/30 transition-all overflow-hidden {{ $index === 0 ? 'is-open' : '' }}" data-faq-item>
                    <button type="button" class="w-full text-left p-6 flex items-center justify-between gap-4 cursor-pointer focus:outline-none faq-trigger group" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                        <h3 class="text-base font-bold font-['Outfit'] text-white group-hover:text-[#ff0033] transition-colors leading-snug pr-3">
                            {{ is_array($faq) ? $faq['question'] : $faq->question }}
                        </h3>
                        <span class="faq-icon text-[#ff0033] text-base font-bold shrink-0 transition-transform duration-300 {{ $index === 0 ? 'rotate-180' : '' }}">▾</span>
                    </button>
                    <div class="faq-collapse grid transition-[grid-template-rows] duration-300 ease-out {{ $index === 0 ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]' }}">
                        <div class="overflow-hidden">
                            <div class="px-6 pb-6 pt-0">
                                <p class="text-xs text-neutral-400 leading-relaxed pt-2 border-t border-white/5">
                                    {{ is_array($faq) ? $faq['answer'] : $faq->answer }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const items = document.querySelectorAll('#appDevFaqContainer [data-faq-item]');
                items.forEach(item => {
                    const btn = item.querySelector('.faq-trigger');
                    const collapse = item.querySelector('.faq-collapse');
                    const icon = item.querySelector('.faq-icon');

                    btn.addEventListener('click', () => {
                        const isOpen = item.classList.contains('is-open');
                        items.forEach(other => {
                            other.classList.remove('is-open');
                            other.querySelector('.faq-trigger')?.setAttribute('aria-expanded', 'false');
                            const oc = other.querySelector('.faq-collapse');
                            if (oc) { oc.classList.remove('grid-rows-[1fr]'); oc.classList.add('grid-rows-[0fr]'); }
                            const oi = other.querySelector('.faq-icon');
                            if (oi) oi.classList.remove('rotate-180');
                        });
                        if (!isOpen) {
                            item.classList.add('is-open');
                            btn.setAttribute('aria-expanded', 'true');
                            collapse.classList.remove('grid-rows-[0fr]');
                            collapse.classList.add('grid-rows-[1fr]');
                            icon.classList.add('rotate-180');
                        }
                    });
                });
            });
        </script>
    <!-- CTA Section -->
    <section class="py-16 bg-[#070707] border-t border-white/5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-br from-[#120406] via-[#0f0f0f] to-[#070707] border border-[#ff0033]/30 shadow-2xl relative overflow-hidden">
                <span class="text-xs font-mono font-bold text-[#ff0033] uppercase tracking-widest block mb-2">{{ $settings['faq_cta_tag'] ?? '// TAILORED ARCHITECTURE' }}</span>
                <h3 class="text-2xl sm:text-3xl font-black font-['Outfit'] text-white uppercase tracking-tight mb-3">
                    {{ $settings['faq_cta_title'] ?? 'HAVE A CUSTOM APP REQUIREMENT?' }}
                </h3>
                <p class="text-xs sm:text-sm text-neutral-400 max-w-xl mx-auto mb-6">
                    {{ $settings['faq_cta_subtitle'] ?? 'Our engineering team is ready to evaluate your architectural specs, build roadmap, and tech stack requirements.' }}
                </p>
                <a href="{{ $settings['faq_cta_btn_url'] ?? route('contact') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl bg-gradient-to-r from-[#ff0033] to-[#cc0029] text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-[#ff0033]/25 hover:scale-105 transition-all">
                    {{ $settings['faq_cta_btn_text'] ?? 'Schedule An Architecture Call' }} &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.app_developer.partials.footer')

</div>
@endsection
