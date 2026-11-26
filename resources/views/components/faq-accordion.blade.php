<section id="faq" class="py-16 sm:py-24 bg-white relative z-20 border-b border-gray-100 will-change-transform" x-data="{ activeFaq: 1 }">
    <div class="faq-content-wrapper max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 will-change-transform">
        
        {{-- Top Section: 2 Columns (Left: Title & Bus Illustration, Right: Accordion FAQs) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
            
            {{-- Left Column: Title, Subtext & Eco CNG Bus Illustration --}}
            <div class="lg:col-span-5 flex flex-col justify-between h-full space-y-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight">
                        Frequently Asked <br>
                        <span class="text-[#2E8B3D]">Questions</span>
                    </h2>
                    <p class="mt-4 text-xs sm:text-sm text-gray-600 leading-relaxed max-w-sm">
                        Have questions about natural gas connections in Arunachal Pradesh? We've compiled answers to the most common queries to help you get started.
                    </p>
                </div>

                {{-- Bottom Eco Transit Line Art (Frequently Asked.png) --}}
                <div class="pt-4 sm:pt-8">
                    <img src="{{ asset('images/assets/Frequently Asked.png') }}" 
                         alt="Green CNG Bus Transit" 
                         class="w-full max-w-[340px] h-auto object-contain">
                </div>
            </div>

            {{-- Right Column: Interactive FAQ Accordion List --}}
            <div class="lg:col-span-7 divide-y divide-gray-200/80">
                
                {{-- FAQ 1: What is Piped Natural Gas (PNG)? (Open by default) --}}
                <div class="py-3.5 first:pt-0">
                    <div :class="activeFaq === 1 ? 'bg-[#f2f8f4] rounded-2xl p-5 sm:p-6 transition-all duration-200' : 'p-2 sm:p-3 transition-all duration-200'">
                        <button type="button" 
                                @click="activeFaq = activeFaq === 1 ? null : 1" 
                                class="w-full flex items-center justify-between text-left focus:outline-hidden group">
                            <span class="text-sm sm:text-base font-bold text-gray-900 group-hover:text-[#2E8B3D] transition-colors pr-4">
                                What is Piped Natural Gas (PNG)?
                            </span>
                            <svg class="w-4 h-4 text-[#2E8B3D] shrink-0 transition-transform duration-200" 
                                 :class="activeFaq === 1 ? 'rotate-180' : ''" 
                                 fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="activeFaq === 1" x-collapse>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mt-2.5">
                                Piped Natural Gas (PNG) is natural gas supplied directly to your home or business through a pipeline network. It is a safe, convenient and eco-friendly fuel used for cooking and heating.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- FAQ 2: How can I get a PNG connection for my home or business? --}}
                <div class="py-3.5">
                    <div :class="activeFaq === 2 ? 'bg-[#f2f8f4] rounded-2xl p-5 sm:p-6 transition-all duration-200' : 'p-2 sm:p-3 transition-all duration-200'">
                        <button type="button" 
                                @click="activeFaq = activeFaq === 2 ? null : 2" 
                                class="w-full flex items-center justify-between text-left focus:outline-hidden group">
                            <span class="text-sm sm:text-base font-bold text-gray-900 group-hover:text-[#2E8B3D] transition-colors pr-4">
                                How can I get a PNG connection for my home or business?
                            </span>
                            <svg class="w-4 h-4 text-[#2E8B3D] shrink-0 transition-transform duration-200" 
                                 :class="activeFaq === 2 ? 'rotate-180' : ''" 
                                 fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="activeFaq === 2" x-collapse>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mt-2.5">
                                You can apply online through our official portal or visit our nearest customer facilitation centre in your district with your identity and property ownership documents.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- FAQ 3: Is natural gas a safe and environment-friendly fuel? --}}
                <div class="py-3.5">
                    <div :class="activeFaq === 3 ? 'bg-[#f2f8f4] rounded-2xl p-5 sm:p-6 transition-all duration-200' : 'p-2 sm:p-3 transition-all duration-200'">
                        <button type="button" 
                                @click="activeFaq = activeFaq === 3 ? null : 3" 
                                class="w-full flex items-center justify-between text-left focus:outline-hidden group">
                            <span class="text-sm sm:text-base font-bold text-gray-900 group-hover:text-[#2E8B3D] transition-colors pr-4">
                                Is natural gas a safe and environment-friendly fuel?
                            </span>
                            <svg class="w-4 h-4 text-[#2E8B3D] shrink-0 transition-transform duration-200" 
                                 :class="activeFaq === 3 ? 'rotate-180' : ''" 
                                 fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="activeFaq === 3" x-collapse>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mt-2.5">
                                Yes, natural gas is lighter than air and dissipates quickly into the atmosphere without accumulation in case of a leak. It produces up to 70% fewer harmful emissions than traditional fossil fuels.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- FAQ 4: Where will AGPL provide PNG and CNG services? --}}
                <div class="py-3.5 last:pb-0">
                    <div :class="activeFaq === 4 ? 'bg-[#f2f8f4] rounded-2xl p-5 sm:p-6 transition-all duration-200' : 'p-2 sm:p-3 transition-all duration-200'">
                        <button type="button" 
                                @click="activeFaq = activeFaq === 4 ? null : 4" 
                                class="w-full flex items-center justify-between text-left focus:outline-hidden group">
                            <span class="text-sm sm:text-base font-bold text-gray-900 group-hover:text-[#2E8B3D] transition-colors pr-4">
                                Where will AGPL provide PNG and CNG services?
                            </span>
                            <svg class="w-4 h-4 text-[#2E8B3D] shrink-0 transition-transform duration-200" 
                                 :class="activeFaq === 4 ? 'rotate-180' : ''" 
                                 fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="activeFaq === 4" x-collapse>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mt-2.5">
                                AGPL is actively executing the City Gas Distribution network across designated Geographical Areas (GA-12.01) in Arunachal Pradesh, connecting major towns, administrative centres, and highway corridors.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        {{-- Bottom Banner: Still Have Questions? Card --}}
        <div class="mt-14 sm:mt-18 rounded-3xl border border-gray-200/90 bg-white p-6 sm:p-8 md:p-10 shadow-xs flex flex-col md:flex-row items-center justify-between gap-6 sm:gap-8">
            
            {{-- Left Side: Text --}}
            <div class="text-center md:text-left">
                <h3 class="text-xl sm:text-2xl font-extrabold text-gray-900 tracking-tight">
                    Still Have Questions?
                </h3>
                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mt-1.5 max-w-md">
                    We're here to help you with anything you need. Reach out to our team for quick and reliable support anytime.
                </p>
            </div>

            {{-- Center: Gas Stove & Meter Asset (Still Have Questions.png) --}}
            <div class="shrink-0">
                <img src="{{ asset('images/assets/Still Have Questions.png') }}" 
                     alt="Gas Meter and Safe Flame" 
                     class="w-56 sm:w-64 h-auto object-contain">
            </div>

            {{-- Right: Find Your Answer CTA Button --}}
            <div class="shrink-0">
                <a href="#contact" 
                   class="inline-flex items-center space-x-2 px-6 py-3 rounded-lg bg-[#0B5CAB] hover:bg-[#094785] text-white text-xs sm:text-sm font-semibold shadow-xs hover:shadow-md transition-all duration-200">
                    <span>Find Your Answer</span>
                    <span class="text-base">&rarr;</span>
                </a>
            </div>

        </div>

    </div>
</section>
