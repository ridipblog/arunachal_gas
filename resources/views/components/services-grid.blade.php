<section id="development-targets" class="py-12 sm:py-16 bg-white relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Contained Rounded Card with 3-Slide Auto-Rotating Background (3s interval, no duplicates) --}}
        <div id="targets-card" class="relative w-full rounded-3xl md:rounded-[36px] overflow-hidden shadow-xs border border-gray-100 bg-white will-change-transform"
             x-data="{
                 currentBg: 0,
                 totalBgs: 3,
                 timer: null,
                 init() {
                     this.timer = setInterval(() => {
                         this.currentBg = (this.currentBg + 1) % this.totalBgs;
                     }, 3000);
                 }
             }">
            
            {{-- Background Slide 1: Pipeline Construction Workers --}}
            <div x-show="currentBg === 0"
                 x-transition:enter="transition-opacity duration-700 ease-in-out"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity duration-700 ease-in-out absolute inset-0"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-cover bg-right sm:bg-center"
                 style="background-image: url('{{ asset('images/assets/Pipeline Construction in Green Mountains 1.png') }}'); background-repeat: no-repeat; background-size: cover;">
            </div>

            {{-- Background Slide 2: CNG Station --}}
            <div x-show="currentBg === 1"
                 x-cloak
                 x-transition:enter="transition-opacity duration-700 ease-in-out"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity duration-700 ease-in-out absolute inset-0"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-cover bg-right sm:bg-center"
                 style="background-image: url('{{ asset('images/assets/Our Key_2.png') }}'); background-repeat: no-repeat; background-size: cover;">
            </div>

            {{-- Background Slide 3: Gas Distribution Infrastructure --}}
            <div x-show="currentBg === 2"
                 x-cloak
                 x-transition:enter="transition-opacity duration-700 ease-in-out"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity duration-700 ease-in-out absolute inset-0"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-cover bg-right sm:bg-center"
                 style="background-image: url('{{ asset('images/assets/Our Key_3.png') }}'); background-repeat: no-repeat; background-size: cover;">
            </div>

            {{-- Left Content Overlay --}}
            <div class="relative z-10 p-6 sm:p-10 md:p-14 lg:p-16 max-w-xl targets-content-parallax will-change-transform">
                
                {{-- Heading --}}
                <div class="mb-8">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight">
                        Our Key <br>
                        <span class="text-[#2E8B3D]">Development Targets</span>
                    </h2>
                </div>

                {{-- 3 Target Stat Rows --}}
                <div class="space-y-6">
                    
                    {{-- Row 1: 26 CNG outlets planned for development --}}
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white/90 backdrop-blur-xs shadow-xs border border-white/80 flex items-center justify-center flex-shrink-0">
                            <img src="{{ asset('images/assets/CNG outlets planned for development.png') }}" 
                                 alt="CNG Outlets" 
                                 class="w-6 h-6 object-contain">
                        </div>
                        <div>
                            <span class="text-2xl sm:text-3xl font-extrabold text-[#2E8B3D] tracking-tight block leading-none">
                                26
                            </span>
                            <span class="text-xs text-gray-600 font-medium block mt-1">
                                CNG outlets planned for development
                            </span>
                        </div>
                    </div>

                    {{-- Row 2: 150 Km of pipeline planned for development --}}
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white/90 backdrop-blur-xs shadow-xs border border-white/80 flex items-center justify-center flex-shrink-0">
                            <img src="{{ asset('images/assets/of pipeline planned for development.png') }}" 
                                 alt="Pipeline Network" 
                                 class="w-6 h-6 object-contain">
                        </div>
                        <div>
                            <span class="text-2xl sm:text-3xl font-extrabold text-[#2E8B3D] tracking-tight block leading-none">
                                150 Km
                            </span>
                            <span class="text-xs text-gray-600 font-medium block mt-1">
                                of pipeline planned for development
                            </span>
                        </div>
                    </div>

                    {{-- Row 3: 26,000 PNG connections targeted --}}
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-white/90 backdrop-blur-xs shadow-xs border border-white/80 flex items-center justify-center flex-shrink-0">
                            <img src="{{ asset('images/assets/PNG connections targeted.png') }}" 
                                 alt="PNG Connections" 
                                 class="w-6 h-6 object-contain">
                        </div>
                        <div>
                            <span class="text-2xl sm:text-3xl font-extrabold text-[#2E8B3D] tracking-tight block leading-none">
                                26,000
                            </span>
                            <span class="text-xs text-gray-600 font-medium block mt-1">
                                PNG connections targeted
                            </span>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>
