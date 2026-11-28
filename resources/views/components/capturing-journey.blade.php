@props(['cards' => []])

<section id="capturing-journey" class="py-16 sm:py-24 bg-[#f4f9f6] relative z-20 border-b border-gray-100 will-change-transform">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header with Title on Left and Explore Gallery CTA on Right --}}
        <div class="journey-header flex flex-col md:flex-row md:items-end justify-between mb-10 sm:mb-12 gap-5 will-change-transform">
            <div class="max-w-2xl">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                    Capturing Our <span class="text-[#2E8B3D]">Journey</span>
                </h2>
                <p class="mt-2 text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Stories of projects, people and progress as we build a cleaner energy future for Arunachal.
                </p>
            </div>

            <div class="shrink-0">
                <a href="#gallery"
                    class="inline-flex items-center space-x-2 px-6 py-2.5 rounded-lg bg-[#0B5CAB] hover:bg-[#094785] text-white text-xs sm:text-sm font-semibold shadow-xs hover:shadow-md transition-all duration-200">
                    <span>Explore Gallery</span>
                    <span class="text-base">&rarr;</span>
                </a>
            </div>
        </div>

        {{-- 3-Column Photographic Gallery Bento Grid (Matching 5-Photo Showcase) --}}
        <div class="journey-gallery-grid grid grid-cols-1 md:grid-cols-3 md:grid-rows-2 md:grid-flow-col gap-5">
            @foreach ((is_iterable($cards) ? $cards : []) as $index => $card)
                @php
                    $isObject = is_object($card);
                    $imageUrl = $isObject ? ($card->image_url ?? asset('images/assets/journey_' . ($index + 1) . '.png')) : ($card['image_url'] ?? asset('images/assets/journey_' . ($index + 1) . '.png'));
                    $title = $isObject ? ($card->title ?? '') : ($card['title'] ?? '');
                    $description = $isObject ? ($card->description ?? '') : ($card['description'] ?? '');
                    $imageAlt = $isObject ? ($card->image_alt ?? $title) : ($card['image_alt'] ?? $title);
                    $isFirst = $index === 0;
                @endphp
                <div class="journey-card opacity-0 relative w-full rounded-2xl md:rounded-3xl overflow-hidden shadow-xs border border-gray-100 group will-change-transform {{ $isFirst ? 'md:row-span-2 min-h-[380px] md:min-h-full' : 'h-[200px] sm:h-[225px]' }}">
                    <img src="{{ $imageUrl }}"
                        alt="{{ $imageAlt }}"
                        loading="lazy"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 block">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent flex flex-col justify-end p-5 {{ $isFirst ? 'sm:p-6' : '' }} text-white">
                        <h3 class="{{ $isFirst ? 'text-base sm:text-lg line-clamp-2' : 'text-sm sm:text-base line-clamp-1' }} font-bold text-white leading-tight">
                            {{ $title }}
                        </h3>
                        <p class="text-xs text-white/80 mt-1 leading-snug {{ $isFirst ? 'line-clamp-3' : 'line-clamp-2' }}">
                            {{ $description }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
