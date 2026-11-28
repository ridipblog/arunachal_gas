@props(['services' => []])

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
            
            @forelse(($services ?? []) as $service)
                {{-- Service Accordion Item --}}
                <div class="py-5 sm:py-6 transition-all duration-200">
                    <button type="button" 
                            @click="activeTab = activeTab === {{ $loop->iteration }} ? null : {{ $loop->iteration }}" 
                            class="w-full flex items-center justify-between text-left focus:outline-hidden group cursor-pointer">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <span class="text-xl sm:text-2xl font-bold text-[#2E8B3D] tracking-tight">
                                {{ $service?->number_label ?? '' }}
                            </span>
                            <span class="text-base sm:text-lg font-bold text-gray-900 group-hover:text-[#2E8B3D] transition-colors">
                                {{ $service?->title ?? '' }}
                            </span>
                        </div>
                        <div>
                            {{-- Active Blue Down Arrow Button --}}
                            <div x-show="activeTab === {{ $loop->iteration }}" 
                                 class="w-8 h-8 rounded-full bg-[#0B5CAB] text-white flex items-center justify-center shadow-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                </svg>
                            </div>
                            {{-- Inactive White Right Arrow Button --}}
                            <div x-show="activeTab !== {{ $loop->iteration }}" 
                                 class="w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-600 flex items-center justify-center shadow-2xs group-hover:border-gray-400 group-hover:text-gray-900 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </div>
                    </button>

                    {{-- Expanded Drawer (Side-by-Side Horizontal Layout) --}}
                    <div x-show="activeTab === {{ $loop->iteration }}" 
                         x-collapse 
                         class="mt-4 pt-1">
                        <div class="flex flex-col md:flex-row gap-5 items-stretch">
                            
                            {{-- Left Green Card --}}
                            <div class="w-full md:w-[38%] bg-[#2E8B3D] rounded-3xl p-7 sm:p-9 flex flex-col justify-between text-white shadow-xs">
                                <div>
                                    <h3 class="text-2xl sm:text-[26px] font-bold text-white leading-tight tracking-tight">
                                        {{ $service?->card_heading ?? '' }}
                                    </h3>
                                </div>
                                @if(!empty($service?->badges) && is_array($service?->badges))
                                    <div class="pt-6 sm:pt-8 flex flex-wrap items-center gap-2.5">
                                        @foreach(($service?->badges ?? []) as $badge)
                                            <span class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-white/15 backdrop-blur-xs border border-white/40 text-xs sm:text-[13px] text-white font-medium">
                                                <svg class="w-3.5 h-3.5 text-white stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                                <span>{{ $badge ?? '' }}</span>
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            {{-- Right Photo Card with Service Image --}}
                            <div class="w-full md:w-[62%] rounded-2xl overflow-hidden shadow-xs border border-gray-100 bg-white min-h-[220px]">
                                <img src="{{ $service?->image_url ?? asset('images/assets/domestic_png_kitchen.png') }}" 
                                     alt="{{ $service?->image_alt ?? ($service?->title ?? 'Arunachal Gas Service') }}" 
                                     loading="lazy"
                                     class="w-full h-full object-cover block">
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="py-12 text-center text-gray-500 text-sm">
                    No services currently available.
                </div>
            @endforelse

        </div>

    </div>
</section>
