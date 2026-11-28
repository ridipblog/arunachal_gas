@props(['notices' => []])

<section id="joint-venture" class="py-16 sm:py-20 relative overflow-hidden bg-white will-change-transform">
    {{-- Parallax Background Image Layer (Uses only Misty Mountain Wave Landscape 1.png) --}}
    <div class="absolute inset-0 w-full h-full pointer-events-none overflow-hidden z-0">
        <img src="{{ asset('images/assets/Misty Mountain Wave Landscape 1.png') }}" 
             alt="Misty Mountain Wave Landscape" 
             class="news-bg-parallax absolute top-0 left-0 w-full block select-none pointer-events-none will-change-transform"
             style="height: 135%; min-height: 135%; object-fit: cover; object-position: right top;">
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

                {{-- Notices Card Container with Dynamic Items --}}
                <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-xs border border-gray-100 divide-y divide-gray-100">
                    @forelse (($notices ?? []) as $notice)
                        <div class="py-3 first:pt-1 last:pb-1 flex items-start space-x-3">
                            <img src="{{ $notice?->icon_url }}" 
                                 alt="{{ $notice?->title ?? 'Notice' }}" 
                                 class="w-7 h-7 flex-shrink-0 mt-0.5 object-contain">
                            <div class="flex-1 min-w-0">
                                <h4 class="text-xs font-bold text-gray-900 leading-tight">
                                    {{ $notice?->title ?? 'Untitled' }}
                                </h4>
                                <p class="text-[11px] text-gray-500 leading-snug mt-0.5 line-clamp-2">
                                    {{ $notice?->description ?? '' }}
                                </p>
                                <span class="text-[10px] text-gray-400 block mt-1">
                                    {{ $notice?->date_text ?? '' }}
                                </span>
                            </div>
                            @if ($notice?->badge)
                                <span class="text-[10px] font-bold tracking-wider uppercase flex-shrink-0 px-2.5 py-0.5 rounded-[999px] border {{ $notice->badge->colorClasses() }}">
                                    {{ $notice->badge->value }}
                                </span>
                            @endif
                        </div>
                    @empty
                        <div class="py-8 text-center text-xs text-gray-400">
                            No active notices or events at this time.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</section>
