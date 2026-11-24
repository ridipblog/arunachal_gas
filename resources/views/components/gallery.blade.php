<section id="solutions" class="py-20 sm:py-28 relative z-20 overflow-hidden bg-white bg-no-repeat border-b border-gray-100" 
         style="background-image: url('{{ asset('images/assets/PNG & CNG solutions.png') }}'); background-position: center right; background-size: cover;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            {{-- Left Column: Typography & Action Button --}}
            <div class="lg:col-span-6 space-y-5">
                <h2 class="text-3xl sm:text-4xl lg:text-[42px] font-extrabold text-gray-900 tracking-tight leading-[1.15]">
                    Clean, Reliable Natural Gas <br>
                    <span class="text-[#2E8B3D]">for Homes, Businesses</span> <br>
                    <span class="text-[#2E8B3D]">and Industries</span>
                </h2>

                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed max-w-lg">
                    Homes, businesses and industries can enquire about availability and feasibility of natural gas supply in their location.
                </p>

                <div class="pt-2 sm:pt-4">
                    <a href="#contact" 
                       class="inline-flex items-center space-x-2 px-6 py-3 rounded-lg bg-[#0B5CAB] hover:bg-[#094785] text-white text-xs sm:text-sm font-semibold shadow-xs hover:shadow-md transition-all duration-200">
                        <span>Send an Enquiry</span>
                        <span class="text-base">&rarr;</span>
                    </a>
                </div>
            </div>

            {{-- Center/Right Column: 4 Segment Cards (2x2 Grid) --}}
            <div class="lg:col-span-6 flex justify-start lg:justify-center">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 w-full max-w-lg">
                    
                    {{-- 1. Residential --}}
                    <div class="bg-white/70 backdrop-blur-md rounded-2xl p-5 sm:p-6 shadow-xs border border-white/80 hover:bg-white/85 hover:shadow-md transition-all duration-200">
                        <div class="w-10 h-10 rounded-xl bg-green-50/70 border border-green-100/60 flex items-center justify-center mb-4">
                            <img src="{{ asset('images/assets/Residential home.png') }}" 
                                 alt="Residential" 
                                 class="w-5 h-5 object-contain">
                        </div>
                        <h3 class="text-base font-bold text-gray-900 leading-tight">
                            Residential
                        </h3>
                        <p class="text-xs text-gray-500 mt-1.5 leading-snug">
                            Cleaner, safer cooking
                        </p>
                    </div>

                    {{-- 2. Commercial --}}
                    <div class="bg-white/70 backdrop-blur-md rounded-2xl p-5 sm:p-6 shadow-xs border border-white/80 hover:bg-white/85 hover:shadow-md transition-all duration-200">
                        <div class="w-10 h-10 rounded-xl bg-green-50/70 border border-green-100/60 flex items-center justify-center mb-4">
                            <img src="{{ asset('images/assets/Commercial storefront.png') }}" 
                                 alt="Commercial" 
                                 class="w-5 h-5 object-contain">
                        </div>
                        <h3 class="text-base font-bold text-gray-900 leading-tight">
                            Commercial
                        </h3>
                        <p class="text-xs text-gray-500 mt-1.5 leading-snug">
                            Hotels, restaurants and retail
                        </p>
                    </div>

                    {{-- 3. Industrial --}}
                    <div class="bg-white/70 backdrop-blur-md rounded-2xl p-5 sm:p-6 shadow-xs border border-white/80 hover:bg-white/85 hover:shadow-md transition-all duration-200">
                        <div class="w-10 h-10 rounded-xl bg-green-50/70 border border-green-100/60 flex items-center justify-center mb-4">
                            <img src="{{ asset('images/assets/Industrial factory.png') }}" 
                                 alt="Industrial" 
                                 class="w-5 h-5 object-contain">
                        </div>
                        <h3 class="text-base font-bold text-gray-900 leading-tight">
                            Industrial
                        </h3>
                        <p class="text-xs text-gray-500 mt-1.5 leading-snug">
                            Efficient &amp; cost-effective energy
                        </p>
                    </div>

                    {{-- 4. CNG Mobility --}}
                    <div class="bg-white/70 backdrop-blur-md rounded-2xl p-5 sm:p-6 shadow-xs border border-white/80 hover:bg-white/85 hover:shadow-md transition-all duration-200">
                        <div class="w-10 h-10 rounded-xl bg-green-50/70 border border-green-100/60 flex items-center justify-center mb-4">
                            <img src="{{ asset('images/assets/CNG mobility vehicle.png') }}" 
                                 alt="CNG Mobility" 
                                 class="w-5 h-5 object-contain">
                        </div>
                        <h3 class="text-base font-bold text-gray-900 leading-tight">
                            CNG Mobility
                        </h3>
                        <p class="text-xs text-gray-500 mt-1.5 leading-snug">
                            Cleaner fuel for transportation
                        </p>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>
