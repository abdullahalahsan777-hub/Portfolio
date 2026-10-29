@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#080808] text-[#ffffff] min-h-screen selection:bg-[#ff6b00] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.app_software_developer.partials.header')

    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative overflow-hidden bg-gradient-to-b from-[#0a0a0a] to-[#080808]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <span class="badge-bracket-orange mb-3 block">{{ $settings['faq_hero_tag'] ?? 'Help Center' }}</span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] uppercase tracking-tight text-white">
                {{ $settings['faq_hero_title_line1'] ?? 'FREQUENTLY ASKED' }} <span class="text-[#ff6b00]">{{ $settings['faq_hero_title_highlight'] ?? 'QUESTIONS' }}</span>
            </h1>
            <p class="text-neutral-400 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['faq_hero_description'] ?? 'Everything you need to know about our engineering engagements, software methodologies, and deployment practices.' }}
            </p>
        </div>
    </section>

    <!-- FAQ Accordion -->
    <section class="py-20 bg-[#0a0a0a]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-4" id="softDevFaqContainer">
                @forelse($faqs as $index => $item)
                    <div class="soft-card rounded-2xl overflow-hidden {{ $index === 0 ? 'is-open' : '' }}" data-faq-item>
                        <button type="button" class="w-full text-left p-6 flex items-center justify-between gap-4 cursor-pointer focus:outline-none faq-trigger group" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                            <h3 class="text-base font-bold font-['Outfit'] text-white group-hover:text-[#ff6b00] transition-colors leading-snug pr-3">
                                {{ is_array($item) ? ($item['question'] ?? $item['q'] ?? '') : ($item->question ?? '') }}
                            </h3>
                            <span class="faq-icon text-[#ff6b00] text-lg font-bold shrink-0 transition-transform duration-300 {{ $index === 0 ? 'rotate-180' : '' }}">▾</span>
                        </button>
                        <div class="faq-collapse grid transition-[grid-template-rows] duration-300 ease-out {{ $index === 0 ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]' }}">
                            <div class="overflow-hidden">
                                <div class="px-6 pb-6 pt-0">
                                    <p class="text-xs text-neutral-400 leading-relaxed pt-2 border-t border-white/5">
                                        {{ is_array($item) ? ($item['answer'] ?? $item['a'] ?? '') : ($item->answer ?? '') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-neutral-500">
                        <p class="text-xs">No questions found.</p>
                    </div>
                @endforelse
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const items = document.querySelectorAll('#softDevFaqContainer [data-faq-item]');
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
        </div>
    <!-- CTA Section -->
    <section class="py-16 bg-[#080808] border-t border-white/5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-br from-[#1c0d02] via-[#111111] to-[#080808] border border-[#ff6b00]/30 shadow-2xl relative overflow-hidden">
                <span class="badge-bracket-orange mb-3 inline-block">{{ $settings['faq_cta_tag'] ?? 'Custom Systems' }}</span>
                <h3 class="text-2xl sm:text-3xl font-black font-['Outfit'] text-white uppercase tracking-tight mb-3">
                    {{ $settings['faq_cta_title'] ?? 'NEED A CUSTOM SOFTWARE SOLUTION?' }}
                </h3>
                <p class="text-xs sm:text-sm text-neutral-400 max-w-xl mx-auto mb-6">
                    {{ $settings['faq_cta_subtitle'] ?? 'Our team is ready to evaluate your architectural specs, build roadmap, and tech stack requirements.' }}
                </p>
                <a href="{{ $settings['faq_cta_btn_url'] ?? route('contact') }}" class="btn-orange-primary inline-flex items-center gap-2 px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider">
                    {{ $settings['faq_cta_btn_text'] ?? 'Start Engineering Discussion' }} &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.app_software_developer.partials.footer')

</div>
@endsection
