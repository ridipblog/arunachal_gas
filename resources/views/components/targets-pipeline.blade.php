<section id="joint-venture" class="py-16 sm:py-20 relative overflow-hidden bg-white will-change-transform">
    {{-- Parallax Background Image Layer (Exact Fit across all screens matching Photo 2) --}}
    <div class="absolute inset-0 w-full h-full pointer-events-none overflow-hidden z-0">
        <img src="{{ asset('images/assets/Misty Mountain Wave Landscape 1.png') }}" 
             alt="Misty Mountain Wave Landscape" 
             class="news-bg-parallax w-full h-full object-cover block select-none pointer-events-none will-change-transform scale-105"
             style="object-position: 70% top;">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
            
            {{-- Left Column: A 50:50 Joint Venture Built for the North East (Spans 7 cols on lg) --}}
            <div class="lg:col-span-7 jv-cards-parallax will-change-transform">
                {{-- Heading --}}
                <div class="mb-6">
                    <span class="text-sm font-bold text-[#2E8B3D] tracking-wide block">
                        A 50:50 Joint Venture
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight mt-1">
                        Built for the North East
                    </h2>
                </div>

                {{-- 2 Partner Cards Side by Side --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    
                    {{-- Card 1: OIL INDIA --}}
                    <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-xs border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow duration-200">
                        <div>
                            {{-- OIL Logo --}}
                            <div class="h-14 flex items-center mb-4">
                                <img src="{{ asset('images/assets/OILLOGOWITHBACKGROUND 1.png') }}" 
                                     alt="Oil India Limited (OIL)" 
                                     class="h-12 w-auto object-contain">
                            </div>
                            <p class="text-xs font-medium text-gray-700 leading-relaxed">
                                An integrated energy company with extensive experience in exploring for, developing and producing crude oil and natural gas, giving AGPL a strong technical foundation.
                            </p>
                        </div>
                    </div>

                    {{-- Card 2: Bharat Petroleum --}}
                    <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-xs border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow duration-200">
                        <div>
                            {{-- BPCL Logo --}}
                            <div class="h-14 flex items-center mb-4">
                                <img src="{{ asset('images/assets/Bharat_Petroleum_logo 1.png') }}" 
                                     alt="Bharat Petroleum Corporation Limited (BPCL)" 
                                     class="h-12 w-auto object-contain">
                            </div>
                            <p class="text-xs font-medium text-gray-700 leading-relaxed">
                                A major Indian energy company in refining, marketing and distribution of petroleum products, bringing experience in fuel marketing, distribution networks and customer service.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Right Column: News, Events and Notices (Spans 5 cols on lg) --}}
            <div class="lg:col-span-5 news-content-parallax will-change-transform">
                {{-- Heading --}}
                <div class="mb-6">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                        News, Events and Notices
                    </h2>
                </div>

                {{-- Notices Card Container with 4 Items --}}
                <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-xs border border-gray-100 divide-y divide-gray-100">
                    
                    {{-- Notice 1: Quarterly Safety Audit --}}
                    <div class="py-3 first:pt-1 last:pb-1 flex items-start space-x-3">
                        <img src="{{ asset('images/assets/Quarterly Safety Audit.png') }}" 
                             alt="Quarterly Safety Audit" 
                             class="w-7 h-7 flex-shrink-0 mt-0.5 object-contain">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-bold text-gray-900 leading-tight">Quarterly Safety Audit</h4>
                            <p class="text-[11px] text-gray-500 leading-snug mt-0.5">Scheduled for 24th Oct. All personnel are required to participate.</p>
                            <span class="text-[10px] text-gray-400 block mt-1">23 Oct 2026 - 10:00 AM</span>
                        </div>
                        <span class="text-[10px] font-bold text-[#16A34A] tracking-wider uppercase flex-shrink-0 bg-[#F0F9F3] px-2.5 py-0.5 rounded-[999px]">
                            NEW
                        </span>
                    </div>

                    {{-- Notice 2: New Compliance Guidelines --}}
                    <div class="py-3 flex items-start space-x-3">
                        <img src="{{ asset('images/assets/New Compliance Guidelines.png') }}" 
                             alt="New Compliance Guidelines" 
                             class="w-7 h-7 flex-shrink-0 mt-0.5 object-contain">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-bold text-gray-900 leading-tight">New Compliance Guidelines</h4>
                            <p class="text-[11px] text-gray-500 leading-snug mt-0.5">Updated policy documents are now available on the internal portal.</p>
                            <span class="text-[10px] text-gray-400 block mt-1">22 Oct 2026 - 02:30 PM</span>
                        </div>
                        <span class="text-[10px] font-bold text-[#16A34A] tracking-wider uppercase flex-shrink-0 bg-[#F0F9F3] px-2.5 py-0.5 rounded-[999px]">
                            NEW
                        </span>
                    </div>

                    {{-- Notice 3: Town Hall Meeting --}}
                    <div class="py-3 flex items-start space-x-3">
                        <img src="{{ asset('images/assets/Town Hall Meeting.png') }}" 
                             alt="Town Hall Meeting" 
                             class="w-7 h-7 flex-shrink-0 mt-0.5 object-contain">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-bold text-gray-900 leading-tight">Town Hall Meeting</h4>
                            <p class="text-[11px] text-gray-500 leading-snug mt-0.5">Join us for the Q3 performance review and future roadmap discussion.</p>
                            <span class="text-[10px] text-gray-400 block mt-1">21 Oct 2026 - 11:00 AM</span>
                        </div>
                        <span class="text-[10px] font-bold text-[#16A34A] tracking-wider uppercase flex-shrink-0 bg-[#F0F9F3] px-2.5 py-0.5 rounded-[999px]">
                            NEW
                        </span>
                    </div>

                    {{-- Notice 4: IT System Maintenance --}}
                    <div class="py-3 last:pb-1 flex items-start space-x-3">
                        <img src="{{ asset('images/assets/IT System Maintenance.png') }}" 
                             alt="IT System Maintenance" 
                             class="w-7 h-7 flex-shrink-0 mt-0.5 object-contain">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-bold text-gray-900 leading-tight">IT System Maintenance</h4>
                            <p class="text-[11px] text-gray-500 leading-snug mt-0.5">Scheduled downtime for system upgrades. Expect service interruptions.</p>
                            <span class="text-[10px] text-gray-400 block mt-1">25 Oct 2026 - 08:00 PM</span>
                        </div>
                        <span class="text-[10px] font-bold text-[#16A34A] tracking-wider uppercase flex-shrink-0 bg-[#F0F9F3] px-2.5 py-0.5 rounded-[999px]">
                            UPCOMING
                        </span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
