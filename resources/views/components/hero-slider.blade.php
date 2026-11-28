@props(['slides' => []])

{{-- Hero Section Container --}}
<section id="hero-section-wrap"
    class="relative z-20 w-full px-3 sm:px-5 lg:px-8 pt-3 sm:pt-4 pb-2">

    {{-- Hero Container --}}
    <div id="hero-shrink-container"
        class="relative w-full h-[calc(100vh-80px)] overflow-hidden"
        x-data="{
            currentSlide: 0,

            slides: {{ json_encode($slides ?? []) }},

            timer: null,

            init() {
                if (this.slides?.length > 1) {
                    this.startAutoplay();
                }
            },

            next() {
                if (!this.slides?.length) return;
                this.currentSlide =
                    (this.currentSlide + 1) % this.slides.length;
                this.resetAutoplay();
            },

            prev() {
                if (!this.slides?.length) return;
                this.currentSlide =
                    (this.currentSlide - 1 + this.slides.length) % this.slides.length;
                this.resetAutoplay();
            },

            startAutoplay() {
                if (this.slides?.length <= 1) return;
                this.timer = setInterval(() => {
                    this.next();
                }, 4500);
            },

            resetAutoplay() {
                clearInterval(this.timer);
                if (this.slides?.length > 1) {
                    this.startAutoplay();
                }
            }
        }">

        {{-- Hero Card --}}
        <div id="hero-card"
            class="relative w-full h-full rounded-2xl md:rounded-[28px]
                   overflow-hidden shadow-xs border border-gray-100 bg-white">

            {{-- Hero Slides --}}
            <template x-for="(slide, index) in (slides || [])" :key="slide?.id || index">

                <div x-show="currentSlide === index"
                    x-transition:enter="transition-opacity duration-500 ease-out"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-300 ease-in absolute inset-0"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="absolute inset-0 w-full h-full">

                    {{-- Image Cover --}}
                    <img
                        :src="slide?.image_url || slide?.img || ''"
                        :alt="slide?.image_alt || slide?.alt || slide?.title || 'Hero Slide'"
                        class="absolute inset-0 w-full h-full object-cover object-center block select-none pointer-events-none"
                        draggable="false">

                </div>

            </template>

            {{-- Navigation Buttons Cutout (Only shown when there are 2 or more slides) --}}
            <div x-show="slides?.length > 1"
                class="absolute bottom-0 right-0 bg-white
                        p-1.5 sm:p-2 md:p-2.5
                        rounded-tl-2xl sm:rounded-tl-3xl
                        z-20 flex items-center
                        space-x-1.5 sm:space-x-2">

                {{-- Top Inverted Fillet --}}
                <svg
                    class="absolute -top-4 sm:-top-5 right-0
                           w-4 h-4 sm:w-5 sm:h-5
                           text-white fill-current pointer-events-none"
                    viewBox="0 0 20 20">
                    <path d="M20 0 C20 11.0457 11.0457 20 0 20 H20 V0 Z" />
                </svg>

                {{-- Left Inverted Fillet --}}
                <svg
                    class="absolute bottom-0 -left-4 sm:-left-5
                           w-4 h-4 sm:w-5 sm:h-5
                           text-white fill-current pointer-events-none"
                    viewBox="0 0 20 20">
                    <path d="M0 20 C11.0457 20 20 11.0457 20 0 V20 H0 Z" />
                </svg>

                {{-- Previous Button --}}
                <button type="button"
                    @click="prev()"
                    class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10
                           rounded-lg sm:rounded-xl
                           bg-[#2E8B3D] hover:bg-[#237836]
                           text-white flex items-center justify-center
                           font-bold text-sm sm:text-base shadow-xs
                           hover:scale-105 active:scale-95
                           transition-all focus:outline-none cursor-pointer"
                    title="Previous Slide"
                    aria-label="Previous Slide">
                    &laquo;
                </button>

                {{-- Next Button --}}
                <button type="button"
                    @click="next()"
                    class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10
                           rounded-lg sm:rounded-xl
                           bg-[#2E8B3D] hover:bg-[#237836]
                           text-white flex items-center justify-center
                           font-bold text-sm sm:text-base shadow-xs
                           hover:scale-105 active:scale-95
                           transition-all focus:outline-none cursor-pointer"
                    title="Next Slide"
                    aria-label="Next Slide">
                    &raquo;
                </button>

            </div>

        </div>
    </div>
</section>
