<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-6">
    {{-- Contained Rounded Hero Card Matching Figma 1:1 using proper assets --}}
    <div class="relative w-full rounded-2xl md:rounded-[28px] overflow-hidden shadow-xs border border-gray-100 bg-white" x-data="heroSlider">
        
        {{-- High-Resolution Hero Visual from public/images/assets/Group 1000002719.png --}}
        <div class="relative w-full overflow-hidden">
            <img src="{{ asset('images/assets/Group 1000002719.png') }}" 
                 alt="Connecting Arunachal Pradesh to a Cleaner Energy Future" 
                 class="w-full h-auto object-cover block select-none">

            {{-- White Cutout Pocket with Inverted Fillet Radii matching Figma 2nd screenshot 1:1 --}}
            <div class="absolute bottom-0 right-0 bg-white p-1.5 sm:p-2 md:p-2.5 rounded-tl-2xl sm:rounded-tl-3xl z-20 flex items-center space-x-1.5 sm:space-x-2">
                {{-- Top Inverted Concave Fillet --}}
                <svg class="absolute -top-4 sm:-top-5 right-0 w-4 h-4 sm:w-5 sm:h-5 text-white fill-current pointer-events-none" viewBox="0 0 20 20">
                    <path d="M20 0 C20 11.0457 11.0457 20 0 20 H20 V0 Z"/>
                </svg>

                {{-- Left Inverted Concave Fillet --}}
                <svg class="absolute bottom-0 -left-4 sm:-left-5 w-4 h-4 sm:w-5 sm:h-5 text-white fill-current pointer-events-none" viewBox="0 0 20 20">
                    <path d="M0 20 C11.0457 20 20 11.0457 20 0 V20 H0 Z"/>
                </svg>

                <button type="button" @click="prev()" 
                        class="w-7 h-7 sm:w-9 sm:h-9 md:w-10 md:h-10 rounded-lg sm:rounded-xl bg-[#2E8B3D] hover:bg-[#237836] text-white flex items-center justify-center font-bold text-sm sm:text-base shadow-xs hover:scale-105 active:scale-95 transition-all focus:outline-none cursor-pointer" 
                        title="Previous Slide" 
                        aria-label="Previous">
                    &laquo;
                </button>
                <button type="button" @click="next()" 
                        class="w-7 h-7 sm:w-9 sm:h-9 md:w-10 md:h-10 rounded-lg sm:rounded-xl bg-[#2E8B3D] hover:bg-[#237836] text-white flex items-center justify-center font-bold text-sm sm:text-base shadow-xs hover:scale-105 active:scale-95 transition-all focus:outline-none cursor-pointer" 
                        title="Next Slide" 
                        aria-label="Next">
                    &raquo;
                </button>
            </div>
        </div>

    </div>
</section>
