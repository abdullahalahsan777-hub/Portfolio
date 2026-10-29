@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#080808] text-white min-h-screen selection:bg-[#ccff00] selection:text-[#080808] font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.uiux_designer.partials.header')


    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#ccff00] uppercase tracking-widest block mb-2">{{ $settings['faq_hero_tag'] ?? ($settings['faq_tag'] ?? 'Help Center') }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] tracking-tight">
                {{ $settings['faq_hero_title_line1'] ?? 'Frequently Asked' }} <span class="text-[#ccff00]">{{ $settings['faq_hero_title_highlight'] ?? 'Questions' }}</span>
            </h1>
            <p class="text-neutral-400 text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['faq_hero_description'] ?? ($settings['faq_subtitle'] ?? 'Everything you need to know about our design process, deliverables, timeline expectations, and pricing structure.') }}
            </p>
        </div>
    </section>

    <!-- FAQs Accordion List -->
    <section class="py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            @php
                $faqList = $faqs ?? collect();
            @endphp
            <div class="space-y-4" id="uiuxFaqContainer">
                @forelse($faqList as $index => $faq)
                    @php
                        $category = is_array($faq) ? ($faq['category'] ?? 'General') : ($faq->category ?? 'General');
                        $question = is_array($faq) ? ($faq['question'] ?? '') : ($faq->question ?? '');
                        $answer = is_array($faq) ? ($faq['answer'] ?? '') : ($faq->answer ?? '');
                    @endphp
                    <div class="rounded-2xl bg-[#111111] border border-white/10 hover:border-[#ccff00]/40 transition-all overflow-hidden {{ $index === 0 ? 'is-open' : '' }}" data-faq-item>
                        <button type="button" class="w-full text-left p-6 flex items-center justify-between gap-4 cursor-pointer focus:outline-none faq-trigger group" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                            <div class="space-y-1.5 pr-2">
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-mono font-bold text-[#ccff00] uppercase tracking-wider">{{ $category }}</span>
                                    <span class="text-xs font-mono text-neutral-500">Q{{ $index + 1 }}</span>
                                </div>
                                <h3 class="text-lg font-bold font-['Outfit'] text-white group-hover:text-[#ccff00] transition-colors leading-snug">
                                    {{ $question }}
                                </h3>
                            </div>
                            <div class="faq-icon shrink-0 w-8 h-8 rounded-full border border-white/10 flex items-center justify-center text-white transition-all duration-300 {{ $index === 0 ? 'bg-[#ccff00] text-black border-[#ccff00]' : '' }}">
                                <i class="ph ph-plus text-sm transition-transform duration-300 {{ $index === 0 ? 'rotate-45' : '' }}"></i>
                            </div>
                        </button>
                        <div class="faq-collapse grid transition-[grid-template-rows] duration-300 ease-out {{ $index === 0 ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]' }}">
                            <div class="overflow-hidden">
                                <div class="px-6 pb-6 pt-0">
                                    <p class="text-xs sm:text-sm text-neutral-400 leading-relaxed pt-3 border-t border-white/5">
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

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const items = document.querySelectorAll('#uiuxFaqContainer [data-faq-item]');
                    items.forEach(item => {
                        const btn = item.querySelector('.faq-trigger');
                        const collapse = item.querySelector('.faq-collapse');
                        const badge = item.querySelector('.faq-icon');
                        const icon = item.querySelector('.faq-icon i');

                        btn.addEventListener('click', () => {
                            const isOpen = item.classList.contains('is-open');
                            items.forEach(other => {
                                other.classList.remove('is-open');
                                other.querySelector('.faq-trigger')?.setAttribute('aria-expanded', 'false');
                                const oc = other.querySelector('.faq-collapse');
                                if (oc) { oc.classList.remove('grid-rows-[1fr]'); oc.classList.add('grid-rows-[0fr]'); }
                                const ob = other.querySelector('.faq-icon');
                                if (ob) ob.classList.remove('bg-[#ccff00]', 'text-black', 'border-[#ccff00]');
                                const oi = other.querySelector('.faq-icon i');
                                if (oi) oi.classList.remove('rotate-45');
                            });
                            if (!isOpen) {
                                item.classList.add('is-open');
                                btn.setAttribute('aria-expanded', 'true');
                                collapse.classList.remove('grid-rows-[0fr]');
                                collapse.classList.add('grid-rows-[1fr]');
                                badge.classList.add('bg-[#ccff00]', 'text-black', 'border-[#ccff00]');
                                icon.classList.add('rotate-45');
                            }
                        });
                    });
                });
            </script>

            <!-- Still Have Questions CTA -->
            <div class="mt-16 p-8 rounded-3xl bg-[#141414] border border-[#ccff00]/30 text-center space-y-4">
                <span class="text-xs font-mono font-bold text-[#ccff00] uppercase block">
                    {{ $settings['faq_cta_tag'] ?? 'Need More Answers?' }}
                </span>
                <h3 class="text-2xl font-bold font-['Outfit'] text-white">
                    {{ $settings['faq_cta_title'] ?? ($settings['faq_support_title'] ?? 'Have a specific requirement or custom timeline?') }}
                </h3>
                <p class="text-xs text-neutral-400 max-w-lg mx-auto leading-relaxed">
                    {{ $settings['faq_cta_subtitle'] ?? ($settings['faq_support_subtitle'] ?? 'I am happy to review your project scope or hop on a 15-minute discovery call.') }}
                </p>
                <div class="pt-2">
                    <a href="{{ $settings['faq_cta_btn_url'] ?? ($settings['faq_support_btn_url'] ?? route('contact')) }}" class="uiux-btn-primary">
                        <span>{{ $settings['faq_cta_btn_text'] ?? ($settings['faq_support_btn_text'] ?? 'Book a Discovery Call ↗') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer matching uploaded design image -->
    @include('frontend.themes.uiux_designer.partials.footer')

</div>
@endsection
