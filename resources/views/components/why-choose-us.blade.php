<section id="our-way-of-working" class="py-16 sm:py-20 md:py-24 relative z-20 overflow-hidden border-b border-gray-100 bg-[#EFF5FF]">
    {{-- Parallax Background Left (Mountains & Monastery) --}}
    <div class="absolute inset-y-0 left-0 w-1/2 overflow-hidden pointer-events-none z-0">
        <img src="{{ asset('images/assets/our_way_bg_left.png') }}" 
             alt="Mountains Landscape" 
             class="our-way-bg-left w-full h-[130%] object-cover object-left will-change-transform -translate-y-12" />
    </div>

    {{-- Parallax Background Right (Refinery & Pipeline - goes to right on scroll) --}}
    <div class="absolute inset-y-0 right-0 w-1/2 overflow-hidden pointer-events-none z-0">
        <img src="{{ asset('images/assets/our_way_bg_right.png') }}" 
             alt="Refinery and Pipeline" 
             class="our-way-bg-right w-full h-[130%] object-cover object-right will-change-transform -translate-y-12" />
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Section Title --}}
        <div class="text-center mb-10 sm:mb-14 our-way-title-parallax will-change-transform">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                Our Way of <span class="text-[#2E8B3D]">Working</span>
            </h2>
        </div>

        {{-- 6 Cards in 2 Columns Grid (Matching Figma Design) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6 max-w-4xl mx-auto our-way-cards-container">
            
            {{-- Card 1: Safety first (Row 1) --}}
            <div class="our-way-card our-way-row-1 bg-white/95 backdrop-blur-xs rounded-2xl p-5 sm:p-6 shadow-xs border border-gray-100 hover:shadow-md transition-shadow duration-200 flex items-start space-x-4 will-change-transform">
                <div class="w-12 h-12 rounded-xl bg-green-50 border border-green-200 flex items-center justify-center shrink-0 mt-0.5">
                    <img src="{{ asset('images/assets/Safety first.png') }}" 
                         alt="Safety first" 
                         class="w-7 h-7 object-contain">
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-900 leading-snug">
                        Safety first
                    </h3>
                    <p class="text-xs text-gray-600 leading-relaxed mt-1.5 font-normal">
                        Prioritising the safety of people, assets and the environment in every activity.
                    </p>
                </div>
            </div>

            {{-- Card 2: Integrity and transparency (Row 1) --}}
            <div class="our-way-card our-way-row-1 bg-white/95 backdrop-blur-xs rounded-2xl p-5 sm:p-6 shadow-xs border border-gray-100 hover:shadow-md transition-shadow duration-200 flex items-start space-x-4 will-change-transform">
                <div class="w-12 h-12 rounded-xl bg-green-50 border border-green-200 flex items-center justify-center shrink-0 mt-0.5">
                    <img src="{{ asset('images/assets/Integrity and transparency.png') }}" 
                         alt="Integrity and transparency" 
                         class="w-7 h-7 object-contain">
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-900 leading-snug">
                        Integrity and transparency
                    </h3>
                    <p class="text-xs text-gray-600 leading-relaxed mt-1.5 font-normal">
                        Ethical practices, accountability and openness in business operations.
                    </p>
                </div>
            </div>

            {{-- Card 3: Customer focus (Row 2) --}}
            <div class="our-way-card our-way-row-2 bg-white/95 backdrop-blur-xs rounded-2xl p-5 sm:p-6 shadow-xs border border-gray-100 hover:shadow-md transition-shadow duration-200 flex items-start space-x-4 will-change-transform">
                <div class="w-12 h-12 rounded-xl bg-green-50 border border-green-200 flex items-center justify-center shrink-0 mt-0.5">
                    <img src="{{ asset('images/assets/Town Hall Meeting.png') }}" 
                         alt="Customer focus" 
                         class="w-7 h-7 object-contain">
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-900 leading-snug">
                        Customer focus
                    </h3>
                    <p class="text-xs text-gray-600 leading-relaxed mt-1.5 font-normal">
                        Reliable services and responsive customer support.
                    </p>
                </div>
            </div>

            {{-- Card 4: Operational excellence (Row 2) --}}
            <div class="our-way-card our-way-row-2 bg-white/95 backdrop-blur-xs rounded-2xl p-5 sm:p-6 shadow-xs border border-gray-100 hover:shadow-md transition-shadow duration-200 flex items-start space-x-4 will-change-transform">
                <div class="w-12 h-12 rounded-xl bg-green-50 border border-green-200 flex items-center justify-center shrink-0 mt-0.5">
                    <img src="{{ asset('images/assets/Operational excellence.png') }}" 
                         alt="Operational excellence" 
                         class="w-7 h-7 object-contain">
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-900 leading-snug">
                        Operational excellence
                    </h3>
                    <p class="text-xs text-gray-600 leading-relaxed mt-1.5 font-normal">
                        Efficient technology, engineering and continuous improvement.
                    </p>
                </div>
            </div>

            {{-- Card 5: Sustainability (Row 3) --}}
            <div class="our-way-card our-way-row-3 bg-white/95 backdrop-blur-xs rounded-2xl p-5 sm:p-6 shadow-xs border border-gray-100 hover:shadow-md transition-shadow duration-200 flex items-start space-x-4 will-change-transform">
                <div class="w-12 h-12 rounded-xl bg-green-50 border border-green-200 flex items-center justify-center shrink-0 mt-0.5">
                    <img src="{{ asset('images/assets/Sustainability.png') }}" 
                         alt="Sustainability" 
                         class="w-7 h-7 object-contain">
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-900 leading-snug">
                        Sustainability
                    </h3>
                    <p class="text-xs text-gray-600 leading-relaxed mt-1.5 font-normal">
                        Responsible use of natural gas as part of India's wider energy transition.
                    </p>
                </div>
            </div>

            {{-- Card 6: Collaboration (Row 3) --}}
            <div class="our-way-card our-way-row-3 bg-white/95 backdrop-blur-xs rounded-2xl p-5 sm:p-6 shadow-xs border border-gray-100 hover:shadow-md transition-shadow duration-200 flex items-start space-x-4 will-change-transform">
                <div class="w-12 h-12 rounded-xl bg-green-50 border border-green-200 flex items-center justify-center shrink-0 mt-0.5">
                    <img src="{{ asset('images/assets/Collaboration.png') }}" 
                         alt="Collaboration" 
                         class="w-7 h-7 object-contain">
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-900 leading-snug">
                        Collaboration
                    </h3>
                    <p class="text-xs text-gray-600 leading-relaxed mt-1.5 font-normal">
                        Working with authorities, communities, industry partners and stakeholders.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>


