<x-layouts.app>
    {{-- 1. Hero Carousel Slider --}}
    <x-hero-slider :slides="$heroSlides ?? []" />

    {{-- 2. Bringing Clean Energy to the Land of the Rising Sun --}}
    <x-jv-partners />

    {{-- 3. A 50:50 Joint Venture & News Notices --}}
    <x-targets-pipeline :notices="$notices ?? []" />

    {{-- 4. Our Key Development Targets --}}
    <x-services-grid />

    {{-- 5. Explore Our Services (Interactive Accordion) --}}
    <x-journey-timeline :services="$services ?? []" />

    {{-- 6. Journey So Far - Key Milestones (Alternating Timeline) --}}
    <x-values :milestones="$milestones ?? []" />

    {{-- 7. Our Way of Working (6 Principles Grid) --}}
    <x-why-choose-us />

    {{-- 8. Why Choose AGPL (PNG & CNG Solutions Hub) --}}
    <x-enquiry-section />

    {{-- 9. Clean, Reliable Natural Gas (4 Segments) --}}
    <x-gallery />

    {{-- 10. Capturing Our Journey (5-Photo Bento Grid) --}}
    <x-capturing-journey :cards="$journeyCards ?? []" />

    {{-- 11. Frequently Asked Questions & Still Have Questions Banner --}}
    <x-faq-accordion />
</x-layouts.app>
