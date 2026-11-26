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

        {{-- 3-Column Photographic Gallery Grid (Matching Figma 5-Photo Showcase) --}}
        <div class="journey-gallery-grid grid grid-cols-1 md:grid-cols-12 gap-5 items-stretch">
            
            {{-- Column 1: Tall Energy Infrastructure Card (Spans 4 cols on md+) --}}
            <div class="md:col-span-4 flex flex-col">
                <div class="journey-card opacity-0 relative w-full h-full min-h-[380px] md:min-h-full rounded-2xl md:rounded-3xl overflow-hidden shadow-xs border border-gray-100 group will-change-transform">
                    <img src="{{ asset('images/assets/journey_1.png') }}" 
                         alt="Energy Infrastructure" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 block">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent flex flex-col justify-end p-5 sm:p-6 text-white">
                        <h3 class="text-base sm:text-lg font-bold text-white leading-tight">
                            Energy Infrastructure
                        </h3>
                        <p class="text-xs text-white/80 mt-1 leading-snug">
                            Building safe energy networks for tomorrow.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Column 2: People Behind Progress & Towards a Greener Future (Spans 4 cols on md+) --}}
            <div class="md:col-span-4 flex flex-col gap-5">
                
                {{-- Card 2: People Behind Progress --}}
                <div class="journey-card opacity-0 relative w-full h-[200px] sm:h-[225px] rounded-2xl md:rounded-3xl overflow-hidden shadow-xs border border-gray-100 group will-change-transform">
                    <img src="{{ asset('images/assets/journey_2.png') }}" 
                         alt="People Behind Progress" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 block">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent flex flex-col justify-end p-5 text-white">
                        <h3 class="text-sm sm:text-base font-bold text-white leading-tight">
                            People Behind Progress
                        </h3>
                        <p class="text-xs text-white/80 mt-1 leading-snug">
                            Our teams making a difference every day.
                        </p>
                    </div>
                </div>

                {{-- Card 3: Towards a Greener Future --}}
                <div class="journey-card opacity-0 relative w-full h-[200px] sm:h-[225px] rounded-2xl md:rounded-3xl overflow-hidden shadow-xs border border-gray-100 group will-change-transform">
                    <img src="{{ asset('images/assets/journey_3.png') }}" 
                         alt="Towards a Greener Future" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 block">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent flex flex-col justify-end p-5 text-white">
                        <h3 class="text-sm sm:text-base font-bold text-white leading-tight">
                            Towards a Greener Future
                        </h3>
                        <p class="text-xs text-white/80 mt-1 leading-snug">
                            Moving towards sustainable energy solutions.
                        </p>
                    </div>
                </div>

            </div>

            {{-- Column 3: Events & Engagements and Collaboration & Planning (Spans 4 cols on md+) --}}
            <div class="md:col-span-4 flex flex-col gap-5">
                
                {{-- Card 4: Events & Engagements --}}
                <div class="journey-card opacity-0 relative w-full h-[200px] sm:h-[225px] rounded-2xl md:rounded-3xl overflow-hidden shadow-xs border border-gray-100 group will-change-transform">
                    <img src="{{ asset('images/assets/journey_4.png') }}" 
                         alt="Events & Engagements" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 block">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent flex flex-col justify-end p-5 text-white">
                        <h3 class="text-sm sm:text-base font-bold text-white leading-tight">
                            Events &amp; Engagements
                        </h3>
                        <p class="text-xs text-white/80 mt-1 leading-snug">
                            Connecting people and ideas.
                        </p>
                    </div>
                </div>

                {{-- Card 5: Collaboration & Planning --}}
                <div class="journey-card opacity-0 relative w-full h-[200px] sm:h-[225px] rounded-2xl md:rounded-3xl overflow-hidden shadow-xs border border-gray-100 group will-change-transform">
                    <img src="{{ asset('images/assets/journey_5.png') }}" 
                         alt="Collaboration & Planning" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 block">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent flex flex-col justify-end p-5 text-white">
                        <h3 class="text-sm sm:text-base font-bold text-white leading-tight">
                            Collaboration &amp; Planning
                        </h3>
                        <p class="text-xs text-white/80 mt-1 leading-snug">
                            Working together towards shared goals.
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>
