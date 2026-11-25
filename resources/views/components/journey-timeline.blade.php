<section id="services-interactive" class="py-16 sm:py-20 bg-[#f4f9f5] relative z-30 shadow-[0_-15px_30px_-5px_rgba(0,0,0,0.06)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Section Title --}}
        <div class="mb-10 sm:mb-12">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                Explore <span class="text-[#2E8B3D]">Our Services</span>
            </h2>
        </div>

        {{-- Interactive Services Accordion (Alpine.js) --}}
        <div x-data="{ activeTab: 1 }" class="divide-y divide-gray-200/80 border-t border-b border-gray-200/80">
            
            {{-- 01/ Domestic PNG --}}
            <div class="py-5 sm:py-6 transition-all duration-200">
                <button type="button" 
                        @click="activeTab = activeTab === 1 ? null : 1" 
                        class="w-full flex items-center justify-between text-left focus:outline-hidden group">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <span class="text-xl sm:text-2xl font-bold text-[#2E8B3D] tracking-tight">
                            01/
                        </span>
                        <span class="text-base sm:text-lg font-bold text-gray-900 group-hover:text-[#2E8B3D] transition-colors">
                            Domestic PNG
                        </span>
                    </div>
                    <div>
                        {{-- Active Blue Down Arrow Button --}}
                        <div x-show="activeTab === 1" 
                             class="w-8 h-8 rounded-full bg-[#0B5CAB] text-white flex items-center justify-center shadow-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </div>
                        {{-- Inactive White Right Arrow Button --}}
                        <div x-show="activeTab !== 1" 
                             class="w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center shadow-2xs group-hover:border-gray-400 group-hover:text-gray-900 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </button>

                {{-- Expanded Drawer (Side-by-Side Horizontal Layout) --}}
                <div x-show="activeTab === 1" 
                     x-collapse 
                     class="mt-4 pt-1">
                    <div class="flex flex-col md:flex-row gap-5 items-stretch">
                        
                        {{-- Left Green Card --}}
                        <div class="w-full md:w-[38%] bg-[#2E8B3D] rounded-3xl p-7 sm:p-9 flex flex-col justify-between text-white shadow-xs">
                            <div>
                                <h3 class="text-2xl sm:text-[26px] font-bold text-white leading-tight tracking-tight">
                                    Convenient piped natural gas for everyday cooking
                                </h3>
                            </div>
                            <div class="pt-8 space-y-2.5">
                                <div class="flex flex-wrap items-center gap-2.5">
                                    <span class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-white/15 backdrop-blur-xs border border-white/40 text-xs sm:text-[13px] text-white font-medium">
                                        <svg class="w-3.5 h-3.5 text-white stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                        <span>Safe &amp; Reliable</span>
                                    </span>
                                    <span class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-white/15 backdrop-blur-xs border border-white/40 text-xs sm:text-[13px] text-white font-medium">
                                        <svg class="w-3.5 h-3.5 text-white stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                        <span>Continuous Supply</span>
                                    </span>
                                </div>
                                <div>
                                    <span class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-white/15 backdrop-blur-xs border border-white/40 text-xs sm:text-[13px] text-white font-medium">
                                        <svg class="w-3.5 h-3.5 text-white stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                        <span>Safe &amp; Reliable</span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Right Kitchen Cooking Photo with AGPL Meter --}}
                        <div class="w-full md:w-[62%] rounded-2xl overflow-hidden shadow-xs border border-gray-100 bg-white min-h-[220px]">
                            <img src="{{ asset('images/assets/domestic_png_kitchen.png') }}" 
                                 alt="AGPL Domestic PNG Kitchen Connection with Safe Blue Gas Flame" 
                                 class="w-full h-full object-cover block">
                        </div>

                    </div>
                </div>
            </div>

            {{-- 02/ Commercial and Industrial PNG --}}
            <div class="py-5 sm:py-6 transition-all duration-200">
                <button type="button" 
                        @click="activeTab = activeTab === 2 ? null : 2" 
                        class="w-full flex items-center justify-between text-left focus:outline-hidden group">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <span class="text-xl sm:text-2xl font-bold text-[#2E8B3D] tracking-tight">
                            02/
                        </span>
                        <span class="text-base sm:text-lg font-bold text-gray-900 group-hover:text-[#2E8B3D] transition-colors">
                            Commercial and Industrial PNG
                        </span>
                    </div>
                    <div>
                        <div x-show="activeTab === 2" 
                             class="w-8 h-8 rounded-full bg-[#0B5CAB] text-white flex items-center justify-center shadow-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </div>
                        <div x-show="activeTab !== 2" 
                             class="w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center shadow-2xs group-hover:border-gray-400 group-hover:text-gray-900 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </button>

                <div x-show="activeTab === 2" 
                     x-collapse 
                     class="mt-4 pt-1">
                    <div class="flex flex-col md:flex-row gap-5 items-stretch">
                        <div class="w-full md:w-[38%] bg-[#2E8B3D] rounded-2xl p-6 sm:p-7 flex flex-col justify-between text-white shadow-xs">
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-white leading-snug">
                                    High-calorific uninterrupted fuel for hotels, hospitals, and industrial facilities
                                </h3>
                            </div>
                            <div class="flex flex-wrap gap-2 pt-6">
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs border border-white/30 text-xs text-white font-medium">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>High Calorific Value</span>
                                </span>
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs border border-white/30 text-xs text-white font-medium">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Zero Storage Hassle</span>
                                </span>
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs border border-white/30 text-xs text-white font-medium">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Accurate Metering</span>
                                </span>
                            </div>
                        </div>
                        <div class="w-full md:w-[62%] rounded-2xl overflow-hidden shadow-xs border border-gray-100 bg-white min-h-[220px]">
                            <img src="{{ asset('images/assets/Pipeline Construction in Green Mountains 1.png') }}" 
                                 alt="Commercial and Industrial Natural Gas Connection" 
                                 class="w-full h-full object-cover block">
                        </div>
                    </div>
                </div>
            </div>

            {{-- 03/ CNG for Transportation --}}
            <div class="py-5 sm:py-6 transition-all duration-200">
                <button type="button" 
                        @click="activeTab = activeTab === 3 ? null : 3" 
                        class="w-full flex items-center justify-between text-left focus:outline-hidden group">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <span class="text-xl sm:text-2xl font-bold text-[#2E8B3D] tracking-tight">
                            03/
                        </span>
                        <span class="text-base sm:text-lg font-bold text-gray-900 group-hover:text-[#2E8B3D] transition-colors">
                            CNG for Transportation
                        </span>
                    </div>
                    <div>
                        <div x-show="activeTab === 3" 
                             class="w-8 h-8 rounded-full bg-[#0B5CAB] text-white flex items-center justify-center shadow-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </div>
                        <div x-show="activeTab !== 3" 
                             class="w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center shadow-2xs group-hover:border-gray-400 group-hover:text-gray-900 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </button>

                <div x-show="activeTab === 3" 
                     x-collapse 
                     class="mt-4 pt-1">
                    <div class="flex flex-col md:flex-row gap-5 items-stretch">
                        <div class="w-full md:w-[38%] bg-[#2E8B3D] rounded-2xl p-6 sm:p-7 flex flex-col justify-between text-white shadow-xs">
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-white leading-snug">
                                    Economical and eco-friendly automotive fuel for public and private mobility
                                </h3>
                            </div>
                            <div class="flex flex-wrap gap-2 pt-6">
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs border border-white/30 text-xs text-white font-medium">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Up to 40% Fuel Savings</span>
                                </span>
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs border border-white/30 text-xs text-white font-medium">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Zero Adulteration</span>
                                </span>
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs border border-white/30 text-xs text-white font-medium">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Fast &amp; Safe Refueling</span>
                                </span>
                            </div>
                        </div>
                        <div class="w-full md:w-[62%] rounded-2xl overflow-hidden shadow-xs border border-gray-100 bg-white min-h-[220px]">
                            <img src="{{ asset('images/assets/gas_station.png') }}" 
                                 alt="AGPL Modern CNG Station Dispenser" 
                                 class="w-full h-full object-cover block">
                        </div>
                    </div>
                </div>
            </div>

            {{-- 04/ CGD Infrastructure --}}
            <div class="py-5 sm:py-6 transition-all duration-200">
                <button type="button" 
                        @click="activeTab = activeTab === 4 ? null : 4" 
                        class="w-full flex items-center justify-between text-left focus:outline-hidden group">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <span class="text-xl sm:text-2xl font-bold text-[#2E8B3D] tracking-tight">
                            04/
                        </span>
                        <span class="text-base sm:text-lg font-bold text-gray-900 group-hover:text-[#2E8B3D] transition-colors">
                            CGD Infrastructure
                        </span>
                    </div>
                    <div>
                        <div x-show="activeTab === 4" 
                             class="w-8 h-8 rounded-full bg-[#0B5CAB] text-white flex items-center justify-center shadow-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </div>
                        <div x-show="activeTab !== 4" 
                             class="w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center shadow-2xs group-hover:border-gray-400 group-hover:text-gray-900 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </button>

                <div x-show="activeTab === 4" 
                     x-collapse 
                     class="mt-4 pt-1">
                    <div class="flex flex-col md:flex-row gap-5 items-stretch">
                        <div class="w-full md:w-[38%] bg-[#2E8B3D] rounded-2xl p-6 sm:p-7 flex flex-col justify-between text-white shadow-xs">
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-white leading-snug">
                                    Building long-term regional assets: City Gate Stations, MDPE pipelines and trunk networks
                                </h3>
                            </div>
                            <div class="flex flex-wrap gap-2 pt-6">
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs border border-white/30 text-xs text-white font-medium">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>SCADA Monitored</span>
                                </span>
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs border border-white/30 text-xs text-white font-medium">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>High Pressure Steel</span>
                                </span>
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs border border-white/30 text-xs text-white font-medium">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Cascade Refueling</span>
                                </span>
                            </div>
                        </div>
                        <div class="w-full md:w-[62%] rounded-2xl overflow-hidden shadow-xs border border-gray-100 bg-white min-h-[220px]">
                            <img src="{{ asset('images/assets/Pipeline Construction in Green Mountains 1.png') }}" 
                                 alt="CGD Infrastructure Development in Arunachal Pradesh" 
                                 class="w-full h-full object-cover block">
                        </div>
                    </div>
                </div>
            </div>

            {{-- 05/ Tenders and Procurement --}}
            <div class="py-5 sm:py-6 transition-all duration-200">
                <button type="button" 
                        @click="activeTab = activeTab === 5 ? null : 5" 
                        class="w-full flex items-center justify-between text-left focus:outline-hidden group">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <span class="text-xl sm:text-2xl font-bold text-[#2E8B3D] tracking-tight">
                            05/
                        </span>
                        <span class="text-base sm:text-lg font-bold text-gray-900 group-hover:text-[#2E8B3D] transition-colors">
                            Tenders and Procurement
                        </span>
                    </div>
                    <div>
                        <div x-show="activeTab === 5" 
                             class="w-8 h-8 rounded-full bg-[#0B5CAB] text-white flex items-center justify-center shadow-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </div>
                        <div x-show="activeTab !== 5" 
                             class="w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center shadow-2xs group-hover:border-gray-400 group-hover:text-gray-900 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </button>

                <div x-show="activeTab === 5" 
                     x-collapse 
                     class="mt-4 pt-1">
                    <div class="flex flex-col md:flex-row gap-5 items-stretch">
                        <div class="w-full md:w-[38%] bg-[#2E8B3D] rounded-2xl p-6 sm:p-7 flex flex-col justify-between text-white shadow-xs">
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-white leading-snug">
                                    Transparent e-procurement portal for contractors, suppliers, and engineering partners
                                </h3>
                            </div>
                            <div class="flex flex-wrap gap-2 pt-6">
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs border border-white/30 text-xs text-white font-medium">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>E-Tendering Portal</span>
                                </span>
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs border border-white/30 text-xs text-white font-medium">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Vendor Empanelment</span>
                                </span>
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs border border-white/30 text-xs text-white font-medium">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Fair &amp; Transparent</span>
                                </span>
                            </div>
                        </div>
                        <div class="w-full md:w-[62%] rounded-2xl overflow-hidden shadow-xs border border-gray-100 bg-white min-h-[220px]">
                            <img src="{{ asset('images/assets/Misty Mountain Wave Landscape 1.png') }}" 
                                 alt="AGPL Transparent Tenders and Procurement" 
                                 class="w-full h-full object-cover block">
                        </div>
                    </div>
                </div>
            </div>

            {{-- 06/ Customer Support --}}
            <div class="py-5 sm:py-6 transition-all duration-200">
                <button type="button" 
                        @click="activeTab = activeTab === 6 ? null : 6" 
                        class="w-full flex items-center justify-between text-left focus:outline-hidden group">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <span class="text-xl sm:text-2xl font-bold text-[#2E8B3D] tracking-tight">
                            06/
                        </span>
                        <span class="text-base sm:text-lg font-bold text-gray-900 group-hover:text-[#2E8B3D] transition-colors">
                            Customer Support
                        </span>
                    </div>
                    <div>
                        <div x-show="activeTab === 6" 
                             class="w-8 h-8 rounded-full bg-[#0B5CAB] text-white flex items-center justify-center shadow-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </div>
                        <div x-show="activeTab !== 6" 
                             class="w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center shadow-2xs group-hover:border-gray-400 group-hover:text-gray-900 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </button>

                <div x-show="activeTab === 6" 
                     x-collapse 
                     class="mt-4 pt-1">
                    <div class="flex flex-col md:flex-row gap-5 items-stretch">
                        <div class="w-full md:w-[38%] bg-[#2E8B3D] rounded-2xl p-6 sm:p-7 flex flex-col justify-between text-white shadow-xs">
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-white leading-snug">
                                    Round-the-clock emergency response, billing assistance, and grievance resolution
                                </h3>
                            </div>
                            <div class="flex flex-wrap gap-2 pt-6">
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs border border-white/30 text-xs text-white font-medium">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>24x7 Emergency Line</span>
                                </span>
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs border border-white/30 text-xs text-white font-medium">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Rapid Grievance Redressal</span>
                                </span>
                                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-xs border border-white/30 text-xs text-white font-medium">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Consumer Safety Camps</span>
                                </span>
                            </div>
                        </div>
                        <div class="w-full md:w-[62%] rounded-2xl overflow-hidden shadow-xs border border-gray-100 bg-white min-h-[220px]">
                            <img src="{{ asset('images/assets/gas_station.png') }}" 
                                 alt="AGPL Customer Care & Emergency Services" 
                                 class="w-full h-full object-cover block">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
