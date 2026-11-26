{{-- Hero section container — single image at a time with smooth 3-stage scroll-shrink --}}
<section id="hero-section-wrap" class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-3 sm:pt-4 pb-2 relative z-20">
    {{--
        Hero Shrink Container:
        Maintains the exact natural 2.31:1 aspect ratio (2141/928) across ALL screen sizes (desktop, tablet, mobile),
        preventing any image or headline text cropping.
        When scrolling, GSAP ScrollTrigger smoothly shrinks this height down cleanly.
        Only ONE image is visible at a time.
    --}}
    <div id="hero-shrink-container"
        class="relative w-full max-w-full aspect-[2141/928] will-change-[height]"
        x-data="{
             currentSlide: 0,
             slides: [
                 {
                     id: 0,
                     img: '{{ asset('images/assets/Group 1000002719.png') }}',
                     alt: 'Connecting Arunachal Pradesh to a Cleaner Energy Future'
                 },
                 {
                     id: 1,
                     img: '{{ asset('images/assets/hero_2.png') }}',
                     alt: 'Empowering Transportation with Cleaner Energy for a Better Tomorrow'
                 },
                 {
                     id: 2,
                     img: '{{ asset('images/assets/hero_3.png') }}',
                     alt: 'Bringing Safe and Reliable Natural Gas to Your Home'
                 }
             ],
             timer: null,
             init() {
                 this.startAutoplay();
             },
             next() {
                 this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                 this.resetAutoplay();
             },
             prev() {
                 this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
                 this.resetAutoplay();
             },
             startAutoplay() {
                 this.timer = setInterval(() => {
                     this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                 }, 4000);
             },
             resetAutoplay() {
                 clearInterval(this.timer);
                 this.startAutoplay();
             }
         }">

        {{-- Single Active Hero Card (Only One Image Visible at a Time) --}}
        <div id="hero-card" class="relative w-full h-full rounded-2xl md:rounded-[28px] overflow-hidden shadow-xs border border-gray-100 bg-white">
            {{-- Active Slide Image with Smooth Crossfade --}}
            <template x-for="(slide, index) in slides" :key="slide.id">
                <div x-show="currentSlide === index"
                    x-transition:enter="transition-opacity duration-500 ease-out"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-300 ease-in absolute inset-0"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="w-full h-full">
                    <img :src="slide.img"
                        :alt="slide.alt"
                        class="w-full h-full object-cover object-left-top block select-none">
                </div>
            </template>

            {{-- White Cutout Pocket with Inverted Fillets & Navigation Buttons --}}
            <div class="absolute bottom-0 right-0 bg-white p-1.5 sm:p-2 md:p-2.5 rounded-tl-2xl sm:rounded-tl-3xl z-20 flex items-center space-x-1.5 sm:space-x-2">
                {{-- Top Inverted Concave Fillet --}}
                <svg class="absolute -top-4 sm:-top-5 right-0 w-4 h-4 sm:w-5 sm:h-5 text-white fill-current pointer-events-none" viewBox="0 0 20 20">
                    <path d="M20 0 C20 11.0457 11.0457 20 0 20 H20 V0 Z" />
                </svg>

                {{-- Left Inverted Concave Fillet --}}
                <svg class="absolute bottom-0 -left-4 sm:-left-5 w-4 h-4 sm:w-5 sm:h-5 text-white fill-current pointer-events-none" viewBox="0 0 20 20">
                    <path d="M0 20 C11.0457 20 20 11.0457 20 0 V20 H0 Z" />
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