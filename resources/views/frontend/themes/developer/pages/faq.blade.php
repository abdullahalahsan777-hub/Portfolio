@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#070707] text-[#ffffff] min-h-screen selection:bg-[#00ff88] selection:text-[#070707] font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.developer.partials.header')


    <!-- Page Header -->
    <section class="py-20 border-b border-white/5 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-widest block mb-2">// {{ $settings['faq_hero_tag'] ?? ($settings['faq_tag'] ?? 'QUESTIONS & ANSWERS') }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight">
                {{ $settings['faq_hero_title_line1'] ?? 'FREQUENTLY ASKED' }} <span class="text-[#00ff88]">{{ $settings['faq_hero_title_highlight'] ?? 'QUESTIONS' }}</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['faq_hero_description'] ?? ($settings['faq_subtitle'] ?? 'Clear answers regarding engineering contracts, architecture sprints, tech stack selection, and continuous maintenance SLAs.') }}
            </p>
        </div>
    </section>

    <!-- FAQ Accordion List -->
    <section class="py-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-4">
            @php
                $faqList = $faqs ?? collect();
            @endphp
            <div class="space-y-4" id="devFaqContainer">
                @forelse($faqList as $index => $faq)
                    @php
                        $question = is_array($faq) ? ($faq['question'] ?? ($faq['q'] ?? '')) : ($faq->question ?? '');
                        $answer = is_array($faq) ? ($faq['answer'] ?? ($faq['a'] ?? '')) : ($faq->answer ?? '');
                    @endphp
                    <div class="rounded-2xl bg-[#111111] border border-white/10 hover:border-[#00ff88]/30 transition-all overflow-hidden {{ $index === 0 ? 'is-open' : '' }}" data-faq-item>
                        <button type="button" class="w-full text-left p-6 flex items-center justify-between gap-4 cursor-pointer focus:outline-none faq-trigger group" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                            <h3 class="text-base font-bold font-['Outfit'] text-white group-hover:text-[#00ff88] transition-colors leading-snug pr-3">
                                {{ $question }}
                            </h3>
                            <span class="faq-icon text-[#00ff88] font-mono text-xl font-black shrink-0 transition-transform duration-300 {{ $index === 0 ? 'rotate-45' : '' }}">+</span>
                        </button>
                        <div class="faq-collapse grid transition-[grid-template-rows] duration-300 ease-out {{ $index === 0 ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]' }}">
                            <div class="overflow-hidden">
                                <div class="px-6 pb-6 pt-0">
                                    <p class="text-xs text-neutral-400 leading-relaxed pt-2 border-t border-white/5">
                                        {{ $answer }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 rounded-2xl border border-dashed border-white/10 text-center text-neutral-500 text-xs font-mono">
                        No FAQ entries found.
                    </div>
                @endforelse
            </div>

            <!-- Still Have Questions CTA Banner -->
            <div class="mt-16 p-8 sm:p-12 rounded-3xl bg-[#111111] border border-[#00ff88]/30 text-center space-y-4 shadow-2xl">
                <span class="text-xs font-mono font-bold text-[#00ff88] uppercase tracking-wider block">
                    // {{ $settings['faq_cta_tag'] ?? 'CUSTOM ENGINEERING REQUIREMENTS' }}
                </span>
                <h3 class="text-2xl sm:text-3xl font-black font-['Outfit'] uppercase text-white">
                    {{ $settings['faq_cta_title'] ?? ($settings['faq_support_title'] ?? 'Need a custom enterprise architecture or high-load audit?') }}
                </h3>
                <p class="text-xs sm:text-sm text-neutral-400 max-w-lg mx-auto leading-relaxed">
                    {{ $settings['faq_cta_subtitle'] ?? ($settings['faq_support_subtitle'] ?? "Direct inquiry response window: within 24 business hours with comprehensive scoping.") }}
                </p>
                <div class="pt-2">
                    <a href="{{ $settings['faq_cta_btn_url'] ?? ($settings['faq_support_btn_url'] ?? route('contact')) }}"
                        class="dev-btn-primary inline-flex items-center gap-2">
                        <span>{{ $settings['faq_cta_btn_text'] ?? ($settings['faq_support_btn_text'] ?? 'INITIATE CONSULTATION') }}</span>
                        <span>➔</span>
                    </a>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const items = document.querySelectorAll('#devFaqContainer [data-faq-item]');
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
                                if (oi) oi.classList.remove('rotate-45');
                            });
                            if (!isOpen) {
                                item.classList.add('is-open');
                                btn.setAttribute('aria-expanded', 'true');
                                collapse.classList.remove('grid-rows-[0fr]');
                                collapse.classList.add('grid-rows-[1fr]');
                                icon.classList.add('rotate-45');
                            }
                        });
                    });
                });
            </script>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.developer.partials.footer')

</div>
@endsection
