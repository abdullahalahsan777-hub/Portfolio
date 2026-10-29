@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#0c0a18] text-[#f5f3ff] min-h-screen selection:bg-[#7c3aed] selection:text-white font-['Plus_Jakarta_Sans']">

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.graphic_designer.partials.header')


    <!-- Page Title / Hero -->
    <section class="py-20 border-b border-white/5 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-widest block mb-2">
                {{ $settings['faq_hero_tag'] ?? ($settings['faq_tag'] ?? 'INQUIRIES & DETAILS') }}
            </span>
            <h1 class="text-4xl sm:text-6xl font-black font-['Outfit'] tracking-tight">
                {{ $settings['faq_hero_title_line1'] ?? 'Frequently Asked' }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-fuchsia-400">{{ $settings['faq_hero_title_highlight'] ?? 'Questions' }}</span>
            </h1>
            <p class="text-slate-300 text-sm mt-3 max-w-2xl leading-relaxed">
                {{ $settings['faq_hero_description'] ?? ($settings['faq_subtitle'] ?? 'Clear answers regarding project timelines, brand identity guidelines, deliverable formats, and retainer agreements.') }}
            </p>
        </div>
    </section>

    <!-- FAQs Accordion List -->
    <section class="py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            @php
                $faqList = $faqs ?? collect();
            @endphp
            <div class="space-y-4" id="gdFaqContainer">
                @forelse($faqList as $index => $faq)
                    <div class="rounded-2xl bg-[#150f2c] border border-white/10 hover:border-[#a855f7]/40 transition-all overflow-hidden {{ $index === 0 ? 'is-open' : '' }}" data-faq-item>
                        <button type="button" class="w-full text-left p-6 flex items-center justify-between gap-4 cursor-pointer focus:outline-none faq-trigger group" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                            <div class="space-y-1.5 pr-2">
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-mono font-bold text-[#a855f7] uppercase tracking-wider">{{ is_array($faq) ? ($faq['category'] ?? 'General') : ($faq->category ?? 'General') }}</span>
                                    <span class="text-xs font-mono text-slate-500">Q{{ $index + 1 }}</span>
                                </div>
                                <h3 class="text-lg font-bold font-['Outfit'] text-white group-hover:text-[#a855f7] transition-colors leading-snug">
                                    {{ is_array($faq) ? $faq['question'] : $faq->question }}
                                </h3>
                            </div>
                            <div class="faq-icon shrink-0 w-8 h-8 rounded-full border border-white/10 flex items-center justify-center text-white transition-all duration-300 {{ $index === 0 ? 'bg-[#a855f7] border-[#a855f7]' : '' }}">
                                <i class="ph ph-plus text-sm transition-transform duration-300 {{ $index === 0 ? 'rotate-45' : '' }}"></i>
                            </div>
                        </button>
                        <div class="faq-collapse grid transition-[grid-template-rows] duration-300 ease-out {{ $index === 0 ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]' }}">
                            <div class="overflow-hidden">
                                <div class="px-6 pb-6 pt-0">
                                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed pt-3 border-t border-white/5">
                                        {{ is_array($faq) ? $faq['answer'] : $faq->answer }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 rounded-2xl border border-dashed border-white/10 text-center text-slate-400 text-sm">
                        No FAQ entries found.
                    </div>
                @endforelse
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const items = document.querySelectorAll('#gdFaqContainer [data-faq-item]');
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
                                if (ob) ob.classList.remove('bg-[#a855f7]', 'border-[#a855f7]');
                                const oi = other.querySelector('.faq-icon i');
                                if (oi) oi.classList.remove('rotate-45');
                            });
                            if (!isOpen) {
                                item.classList.add('is-open');
                                btn.setAttribute('aria-expanded', 'true');
                                collapse.classList.remove('grid-rows-[0fr]');
                                collapse.classList.add('grid-rows-[1fr]');
                                badge.classList.add('bg-[#a855f7]', 'border-[#a855f7]');
                                icon.classList.add('rotate-45');
                            }
                        });
                    });
                });
            </script>

            <!-- Still Have Questions CTA -->
            <div class="mt-16 p-8 sm:p-12 rounded-3xl bg-[#181233] border border-[#a855f7]/30 text-center space-y-4 shadow-xl">
                <span class="text-xs font-mono font-bold text-[#a855f7] uppercase tracking-wider block">
                    {{ $settings['faq_cta_tag'] ?? 'CUSTOM REQUIREMENTS' }}
                </span>
                <h3 class="text-2xl sm:text-3xl font-bold font-['Outfit'] text-white">
                    {{ $settings['faq_cta_title'] ?? ($settings['faq_support_title'] ?? 'Have a unique branding or motion design requirement?') }}
                </h3>
                <p class="text-xs sm:text-sm text-slate-300 max-w-lg mx-auto leading-relaxed">
                    {{ $settings['faq_cta_subtitle'] ?? ($settings['faq_support_subtitle'] ?? "Get in touch directly and let's craft a tailored creative proposal for your brand.") }}
                </p>
                <div class="pt-2">
                    <a href="{{ $settings['faq_cta_btn_url'] ?? ($settings['faq_support_btn_url'] ?? route('contact')) }}"
                        class="inline-flex items-center gap-2 px-8 py-3 rounded-full text-xs font-bold text-white shadow-lg shadow-purple-600/30 hover:shadow-purple-600/50 hover:scale-105 active:scale-95 transition-all cursor-pointer"
                        style="background: linear-gradient(135deg, #a855f7, #6366f1);">
                        <span>{{ $settings['faq_cta_btn_text'] ?? ($settings['faq_support_btn_text'] ?? 'Get In Touch ↗') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.themes.graphic_designer.partials.footer')

</div>
@endsection
