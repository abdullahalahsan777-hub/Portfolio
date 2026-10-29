@extends('frontend.layouts.frontend')

@section('content')
<div class="bg-[#cfd3d8] dark:bg-[#07080b] text-[#151618] dark:text-[#f1f5f9] min-h-screen selection:bg-[#e26d9b] selection:text-white font-['Plus_Jakarta_Sans'] overflow-x-clip relative transition-colors duration-300">

    <!-- Top Poppy Decoration Background -->
    <div class="absolute top-0 right-0 w-80 h-80 opacity-40 dark:opacity-20 pointer-events-none z-0">
        <img src="{{ asset('images/digital_designer_illustrator/flower.jpg') }}" alt="Poppy accent" class="w-full h-full object-contain">
    </div>

    <!-- Header Partial (Sticky Navigation) -->
    @include('frontend.themes.digital_designer_illustrator.partials.header')

    <!-- Hero / Title -->
    <section class="py-16 sm:py-20 border-b border-black/5 dark:border-white/10 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block text-[11px] font-bold tracking-[0.25em] uppercase text-[#6f7582] dark:text-[#e26d9b] mb-3">
                {{ $settings['faq_hero_tag'] ?? '— Common Inquiries' }}
            </span>
            <h1 class="text-4xl sm:text-6xl font-normal font-['Urbanist'] tracking-tight text-[#151618] dark:text-white">
                {{ $settings['faq_hero_title_line1'] ?? 'Frequently asked' }} <span class="italic text-[#e26d9b]">{{ $settings['faq_hero_title_highlight'] ?? 'questions' }}</span>
            </h1>
            <p class="text-[#555a64] dark:text-[#9aa0aa] text-sm sm:text-base mt-4 max-w-2xl leading-relaxed">
                {{ $settings['faq_hero_description'] ?? 'Answers to common questions regarding design sprints, deliverables, licensing, and client collaboration.' }}
            </p>
        </div>
    </section>

    <!-- FAQ Accordion List -->
    <section class="py-16 sm:py-20 relative z-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4" id="faqAccordionContainer">
            @foreach($faqs as $index => $faq)
            <div 
                class="faq-accordion-item rounded-3xl bg-white/70 dark:bg-[#12141a] border border-black/10 dark:border-white/10 hover:border-[#e26d9b]/50 dark:hover:border-[#e26d9b]/50 transition-all duration-300 overflow-hidden shadow-sm hover:shadow-md {{ $index === 0 ? 'is-open' : '' }}"
                data-faq-item
            >
                <button 
                    type="button" 
                    class="faq-trigger w-full text-left p-6 sm:p-8 flex items-center justify-between gap-4 cursor-pointer focus:outline-none group"
                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                >
                    <div class="space-y-1.5 pr-3">
                        <span class="text-[10px] sm:text-[11px] font-mono uppercase tracking-widest text-[#787f8d] dark:text-[#9aa0aa] block">
                            {{ is_array($faq) ? ($faq['category'] ?? 'General') : ($faq->category ?? 'General') }}
                        </span>
                        <h3 class="text-lg sm:text-xl font-bold font-['Urbanist'] text-[#151618] dark:text-white group-hover:text-[#e26d9b] dark:group-hover:text-[#e26d9b] transition-colors leading-snug">
                            {{ is_array($faq) ? $faq['question'] : $faq->question }}
                        </h3>
                    </div>
                    <div class="faq-icon shrink-0 w-10 h-10 rounded-full border border-black/15 dark:border-white/15 flex items-center justify-center text-[#151618] dark:text-white group-hover:border-[#e26d9b] group-hover:text-[#e26d9b] transition-all duration-300 {{ $index === 0 ? 'bg-[#e26d9b] text-white border-[#e26d9b]' : '' }}">
                        <i class="ph ph-plus text-base transition-transform duration-300 {{ $index === 0 ? 'rotate-45 text-white' : '' }}"></i>
                    </div>
                </button>

                <div class="faq-collapse grid transition-[grid-template-rows] duration-300 ease-out {{ $index === 0 ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]' }}">
                    <div class="overflow-hidden">
                        <div class="px-6 pb-6 sm:px-8 sm:pb-8 pt-0">
                            <div class="border-t border-black/5 dark:border-white/10 pt-4">
                                <p class="text-xs sm:text-sm text-[#555a64] dark:text-[#9aa0aa] leading-relaxed">
                                    {{ is_array($faq) ? $faq['answer'] : $faq->answer }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Still have questions? -->
            <div class="text-center pt-12">
                <span class="inline-block text-[11px] font-bold tracking-[0.25em] uppercase text-[#6f7582] dark:text-[#e26d9b] mb-2 font-mono block">
                    {{ $settings['faq_cta_tag'] ?? '— Need Clarifications?' }}
                </span>
                <h3 class="text-2xl font-normal font-['Urbanist'] text-[#151618] dark:text-white mb-2">
                    {{ $settings['faq_cta_title'] ?? 'Have a unique scenario or need a custom proposal?' }}
                </h3>
                <p class="text-xs sm:text-sm text-[#555a64] dark:text-[#9aa0aa] mb-5 max-w-lg mx-auto">
                    {{ $settings['faq_cta_subtitle'] ?? 'Our studio is always happy to review bespoke visual briefs and answer technical inquiries.' }}
                </p>
                <a href="{{ $settings['faq_cta_btn_url'] ?? route('contact') }}" class="btn-illustrator inline-flex items-center gap-2.5 px-6 py-3 rounded-full bg-[#111215] dark:bg-white !text-white dark:!text-[#111215] hover:bg-[#e26d9b] dark:hover:bg-[#e26d9b] dark:hover:!text-white text-xs sm:text-sm font-bold transition-all shadow-md hover:-translate-y-0.5">
                    <span class="!text-white dark:!text-[#111215]">{{ $settings['faq_cta_btn_text'] ?? 'Contact Directly' }}</span>
                    <i class="ph ph-arrow-up-right text-base !text-white dark:!text-[#111215]"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.themes.digital_designer_illustrator.partials.footer')

</div>

<!-- FAQ Accordion Interactive Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const accordionItems = document.querySelectorAll('#faqAccordionContainer [data-faq-item]');

        accordionItems.forEach(item => {
            const trigger = item.querySelector('.faq-trigger');
            const collapse = item.querySelector('.faq-collapse');
            const iconBadge = item.querySelector('.faq-icon');
            const icon = item.querySelector('.faq-icon i');

            trigger.addEventListener('click', () => {
                const isCurrentlyOpen = item.classList.contains('is-open');

                // Close all accordion items
                accordionItems.forEach(otherItem => {
                    otherItem.classList.remove('is-open');
                    const otherTrigger = otherItem.querySelector('.faq-trigger');
                    const otherCollapse = otherItem.querySelector('.faq-collapse');
                    const otherBadge = otherItem.querySelector('.faq-icon');
                    const otherIcon = otherItem.querySelector('.faq-icon i');

                    if (otherTrigger) otherTrigger.setAttribute('aria-expanded', 'false');
                    if (otherCollapse) {
                        otherCollapse.classList.remove('grid-rows-[1fr]');
                        otherCollapse.classList.add('grid-rows-[0fr]');
                    }
                    if (otherBadge) {
                        otherBadge.classList.remove('bg-[#e26d9b]', 'text-white', 'border-[#e26d9b]');
                    }
                    if (otherIcon) {
                        otherIcon.classList.remove('rotate-45', 'text-white');
                    }
                });

                // If clicked item wasn't open, open it
                if (!isCurrentlyOpen) {
                    item.classList.add('is-open');
                    trigger.setAttribute('aria-expanded', 'true');
                    collapse.classList.remove('grid-rows-[0fr]');
                    collapse.classList.add('grid-rows-[1fr]');
                    iconBadge.classList.add('bg-[#e26d9b]', 'text-white', 'border-[#e26d9b]');
                    icon.classList.add('rotate-45', 'text-white');
                }
            });
        });
    });
</script>
@endsection

