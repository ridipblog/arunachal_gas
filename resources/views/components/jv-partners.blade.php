<section id="about" class="py-12 sm:py-16 bg-white relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            {{-- Left Column: Gas Station Visual Card with Floating Badge --}}
            <div class="lg:col-span-5 relative jv-anim-left will-change-transform">
                <div class="relative w-full rounded-3xl md:rounded-[32px] overflow-hidden shadow-xs border border-gray-100 aspect-[4/5] max-w-md mx-auto lg:max-w-none">
                    <img src="{{ asset('images/assets/gas_station.png') }}" 
                         alt="Arunachal Gas CNG Dispensing Station" 
                         class="w-full h-full object-cover block jv-station-img will-change-transform">
                </div>
            </div>

            {{-- Right Column: Typography & Content (Exact Figma Copy) --}}
            <div class="lg:col-span-7 space-y-5 jv-anim-right will-change-transform">
                
                {{-- Headline --}}
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight">
                    Bringing Clean Energy to the <br>
                    <span class="text-[#2E8B3D]">Land of the Rising Sun</span>
                </h2>

                {{-- Lead Paragraph --}}
                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Arunachal Gas Private Limited (AGPL) is committed to developing a modern and reliable City Gas Distribution (CGD) network across Arunachal Pradesh, bringing the benefits of natural gas closer to households, businesses, industries and the transport sector.
                </p>

                {{-- Paragraph with Green Border Accent 1 --}}
                <div class="border-l-3 border-[#2E8B3D] pl-3.5">
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                        A joint venture of Oil India Limited (OIL) and Bharat Petroleum Corporation Limited (BPCL), AGPL aims to establish a safe, efficient and accessible natural gas distribution network that supports the state's economic development while promoting cleaner energy choices.
                    </p>
                </div>

                {{-- Paragraph with Green Border Accent 2 --}}
                <div class="border-l-3 border-[#2E8B3D] pl-3.5">
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                        Through the development of Piped Natural Gas (PNG) infrastructure and Compressed Natural Gas (CNG) facilities, AGPL seeks to contribute towards a more sustainable, convenient and energy-efficient future for Arunachal Pradesh.
                    </p>
                </div>

                {{-- Mission & Vision Panel with Custom Illustrated Background matching 2nd screenshot --}}
                <div class="relative rounded-2xl md:rounded-[22px] p-4 sm:p-5 shadow-xs border border-gray-100/90 overflow-hidden bg-cover bg-center bg-no-repeat space-y-3 sm:space-y-3.5"
                     style="background-image: url('{{ asset('images/assets/mission_vission_background.png') }}');">
                    
                    {{-- Mission Row --}}
                    <div class="flex flex-col sm:flex-row sm:items-center gap-1.5 sm:gap-6">
                        <div class="flex items-center space-x-2.5 sm:w-28 shrink-0">
                            <img src="{{ asset('images/assets/mission.png') }}" 
                                 alt="Mission" 
                                 class="w-6 h-6 object-contain shrink-0">
                            <span class="text-sm font-bold text-gray-900">Mission</span>
                        </div>
                        <p class="text-[11.5px] sm:text-xs text-gray-600 leading-relaxed flex-1">
                            To develop a safe, reliable and customer-focused City Gas Distribution network that delivers the benefits of natural gas to the people and businesses of Arunachal Pradesh.
                        </p>
                    </div>

                    {{-- Horizontal Divider --}}
                    <div class="border-t border-green-200/50"></div>

                    {{-- Vision Row --}}
                    <div class="flex flex-col sm:flex-row sm:items-center gap-1.5 sm:gap-6">
                        <div class="flex items-center space-x-2.5 sm:w-28 shrink-0">
                            <img src="{{ asset('images/assets/vission.png') }}" 
                                 alt="Vision" 
                                 class="w-6 h-6 object-contain shrink-0">
                            <span class="text-sm font-bold text-gray-900">Vision</span>
                        </div>
                        <p class="text-[11.5px] sm:text-xs text-gray-600 leading-relaxed flex-1">
                            To emerge as a trusted City Gas Distribution company, enabling cleaner energy access and contributing to the sustainable development of Arunachal Pradesh.
                        </p>
                    </div>
                </div>

                {{-- Discover More CTA Button --}}
                <div class="pt-2">
                    <a href="#services" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full text-xs sm:text-sm font-semibold text-white bg-[#0B5CAB] hover:bg-[#094785] shadow-xs hover:shadow-md transition-all duration-200">
                        <span>Discover More</span>
                        <span class="ml-1.5">&rarr;</span>
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>
