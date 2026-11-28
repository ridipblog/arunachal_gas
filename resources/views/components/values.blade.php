@props(['milestones' => []])

@php
    $items = collect(is_iterable($milestones) ? $milestones : []);
    $count = $items->count();
@endphp

<section id="journey-milestones" class="min-h-[calc(100vh-65px)] flex flex-col justify-center py-10 sm:py-14 relative z-20 overflow-hidden bg-white border-b border-gray-100">
    {{-- Parallax Background Image Layer (Pipeline & Scenic Hills) --}}
    <div class="absolute inset-0 w-full h-full pointer-events-none overflow-hidden z-0">
        <img src="{{ asset('images/assets/Eco Energy Pipeline Landscape 1.png') }}" 
             alt="Eco Energy Pipeline Landscape" 
             class="milestones-bg-parallax w-full h-[75%] min-h-[480px] sm:min-h-[560px] object-cover object-bottom absolute left-0 right-0 will-change-transform"
             style="bottom: -60px;">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        
        {{-- Section Title (Enters first smoothly) --}}
        <div class="text-center mb-10 sm:mb-14 milestones-title-parallax will-change-transform">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                Journey So Far <span class="font-normal text-gray-400">–</span> <span class="text-[#2E8B3D]">Key Milestones</span>
            </h2>
            <p class="hidden xl:block text-xs text-slate-400 mt-2 font-medium">
                Scroll horizontally or drag to explore our chronological milestones from inception to future targets
            </p>
        </div>

        {{-- Timeline Content Track (Rises smoothly from bottom to top with parallax scrub) --}}
        <div class="milestones-timeline-parallax will-change-transform">
            @if ($count > 0)
                {{-- Horizontal Alternating Scrollable Timeline (Desktop Wide: >= xl) --}}
                <div class="hidden xl:block relative"
                     x-data="{
                         track: null,
                         canScrollLeft: false,
                         canScrollRight: false,
                         isDown: false,
                         startX: 0,
                         scrollLeftStart: 0,
                         init() {
                             this.track = this.$refs.timelineScrollTrack;
                             this.$nextTick(() => {
                                 this.checkScroll();
                             });
                             window.addEventListener('resize', () => this.checkScroll());
                         },
                         checkScroll() {
                             if (!this.track) return;
                             this.canScrollLeft = this.track.scrollLeft > 15;
                             this.canScrollRight = this.track.scrollLeft < (this.track.scrollWidth - this.track.clientWidth - 15);
                         },
                         scrollPrev() {
                             if (!this.track) return;
                             this.track.scrollBy({ left: -435, behavior: 'smooth' });
                             setTimeout(() => this.checkScroll(), 350);
                         },
                         scrollNext() {
                             if (!this.track) return;
                             this.track.scrollBy({ left: 435, behavior: 'smooth' });
                             setTimeout(() => this.checkScroll(), 350);
                         },
                         startDrag(e) {
                             if (!this.track) return;
                             this.isDown = true;
                             this.startX = e.pageX - this.track.offsetLeft;
                             this.scrollLeftStart = this.track.scrollLeft;
                         },
                         onDrag(e) {
                             if (!this.isDown || !this.track) return;
                             e.preventDefault();
                             const x = e.pageX - this.track.offsetLeft;
                             const walk = (x - this.startX) * 1.4;
                             this.track.scrollLeft = this.scrollLeftStart - walk;
                             this.checkScroll();
                         },
                         stopDrag() {
                             this.isDown = false;
                             this.checkScroll();
                         }
                     }">
                    
                    {{-- Left Arrow Navigation Button --}}
                    <button type="button" 
                            x-show="canScrollLeft"
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-x-2"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 -translate-x-2"
                            @click="scrollPrev()"
                            aria-label="Previous Milestones"
                            class="absolute -left-4 top-[170px] -translate-y-1/2 z-30 w-11 h-11 rounded-full bg-white shadow-xl border border-slate-200 text-[#0A1E3B] hover:text-[#2E8B3D] hover:scale-105 active:scale-95 transition-all flex items-center justify-center cursor-pointer">
                        <svg class="w-5 h-5 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                        </svg>
                    </button>

                    {{-- Right Arrow Navigation Button --}}
                    <button type="button" 
                            x-show="canScrollRight"
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-x-2"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-x-0"
                            x-transition:leave-end="opacity-0 translate-x-2"
                            @click="scrollNext()"
                            aria-label="Next Milestones"
                            class="absolute -right-4 top-[170px] -translate-y-1/2 z-30 w-11 h-11 rounded-full bg-white shadow-xl border border-slate-200 text-[#0A1E3B] hover:text-[#2E8B3D] hover:scale-105 active:scale-95 transition-all flex items-center justify-center cursor-pointer">
                        <svg class="w-5 h-5 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                        </svg>
                    </button>

                    {{-- Left & Right Edge Fades to indicate scrollable content --}}
                    <div x-show="canScrollLeft" x-cloak class="absolute left-0 top-0 bottom-0 w-12 bg-gradient-to-r from-white/90 to-transparent pointer-events-none z-20"></div>
                    <div x-show="canScrollRight" x-cloak class="absolute right-0 top-0 bottom-0 w-12 bg-gradient-to-l from-white/90 to-transparent pointer-events-none z-20"></div>

                    {{-- Horizontal Scroll Viewport --}}
                    <div x-ref="timelineScrollTrack"
                         @scroll.passive="checkScroll()"
                         @mousedown="startDrag($event)"
                         @mousemove="onDrag($event)"
                         @mouseup="stopDrag()"
                         @mouseleave="stopDrag()"
                         class="overflow-x-auto scroll-smooth py-6 select-none cursor-grab active:cursor-grabbing [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                        
                        @php
                            $trackMinWidth = max($count * 145 + 96, 1100);
                            $trackWidth = $count * 145 + 96;
                        @endphp

                        {{-- Linear Track with Dynamic Min-Width (balanced 145px per milestone slot) --}}
                        <div class="relative h-[340px] flex items-center px-12"
                             {!! 'style="min-width: ' . $trackMinWidth . 'px; width: max(100%, ' . $trackWidth . 'px);"' !!}>
                            
                            {{-- Continuous Sky-Blue Timeline Bar --}}
                            <div class="absolute top-[170px] left-8 right-8 h-[3.5px] bg-[#48CAE4] rounded-full -translate-y-1/2 z-0"></div>

                            {{-- Alternating Milestone Slots --}}
                            @foreach ($items as $index => $item)
                                @php
                                    $isObject = is_object($item);
                                    $isArray = is_array($item);
                                    $period = $isObject ? ($item->period ?? '') : ($isArray ? ($item['period'] ?? '') : '');
                                    $title = $isObject ? ($item->title ?? '') : ($isArray ? ($item['title'] ?? '') : '');
                                    $icon = $isObject ? ($item->icon ?? 'document') : ($isArray ? ($item['icon'] ?? 'document') : 'document');
                                    $customUrl = $isObject ? ($item->custom_icon_url ?? null) : ($isArray ? ($item['custom_icon_url'] ?? null) : null);
                                    $isHighlighted = $isObject ? (bool) ($item->is_highlighted ?? false) : (bool) ($isArray ? ($item['is_highlighted'] ?? false) : false);

                                    $isBottom = $index % 2 !== 0;
                                @endphp

                                <div class="relative w-[145px] h-full flex-shrink-0 flex items-center justify-center">
                                    {{-- Timeline Dot Indicator (centered directly on continuous bar) --}}
                                    @if ($isHighlighted)
                                        <div class="absolute top-[170px] left-1/2 -translate-x-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-[#F59E0B] border-2 border-white ring-2 ring-amber-300 shadow-xs z-10"></div>
                                    @else
                                        <div class="absolute top-[170px] left-1/2 -translate-x-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs z-10"></div>
                                    @endif
                                    
                                    {{-- Milestone Content Card (Fixed Width & Height with Full-Content Clamping) --}}
                                    <div class="absolute {{ $isBottom ? 'top-[188px]' : 'top-[24px]' }} left-1/2 -translate-x-1/2 w-[215px] h-[126px] bg-white rounded-2xl p-3 sm:p-3.5 shadow-[0_4px_16px_rgba(0,0,0,0.06)] border border-slate-200/90 hover:shadow-md transition-shadow z-20 flex flex-col justify-start">
                                        {{-- Tooltip Pointer pointing directly to Dot --}}
                                        @if ($isBottom)
                                            <div class="absolute -top-[7px] left-1/2 -translate-x-1/2 w-3.5 h-3.5 bg-white border-l border-t border-slate-200 rotate-45 transform"></div>
                                        @endif

                                        <div>
                                            <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100 shrink-0">
                                                <x-milestone-icon :icon="$icon" :custom-url="$customUrl" class="w-4 h-4 text-[#16A34A] shrink-0" />
                                                <span class="text-gray-300 font-light text-xs shrink-0">|</span>
                                                <span class="text-xs sm:text-[13px] font-bold text-[#0A1E3B] truncate" title="{{ $period }}">{{ $period }}</span>
                                            </div>
                                            <p class="text-[11.5px] text-slate-600 leading-[1.38] mt-1.5 line-clamp-4 overflow-hidden text-ellipsis break-words" title="{{ $title }}">
                                                {{ $title }}
                                            </p>
                                        </div>

                                        @if (! $isBottom)
                                            <div class="absolute -bottom-[7px] left-1/2 -translate-x-1/2 w-3.5 h-3.5 bg-white border-r border-b border-slate-200 rotate-45 transform"></div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                {{-- Responsive Vertical Timeline (Visible on Mobile, Tablet & Screens < xl) --}}
                <div class="xl:hidden relative max-w-2xl sm:max-w-3xl mx-auto"
                     x-data="{
                         vTrack: null,
                         canScrollDown: false,
                         init() {
                             this.vTrack = this.$refs.verticalTrack;
                             this.$nextTick(() => this.checkVScroll());
                         },
                         checkVScroll() {
                             if (!this.vTrack) return;
                             this.canScrollDown = this.vTrack.scrollTop < (this.vTrack.scrollHeight - this.vTrack.clientHeight - 15);
                         }
                     }">

                    {{-- Top Helper Badge when multiple milestones exist --}}
                    @if ($count > 3)
                        <div class="flex items-center justify-between text-[11px] text-slate-400 font-medium mb-3 px-2">
                            <span>Total {{ $count }} Milestones</span>
                            <span class="inline-flex items-center space-x-1 text-[#2E8B3D] font-bold">
                                <span>Scroll down</span>
                                <span>&darr;</span>
                            </span>
                        </div>
                    @endif

                    {{-- Scrollable Container with Max Height --}}
                    <div x-ref="verticalTrack"
                         @scroll.passive="checkVScroll()"
                         class="max-h-[480px] sm:max-h-[520px] overflow-y-auto scroll-smooth pr-3 sm:pr-4 py-2 relative border-l-2 border-[#48CAE4] ml-6 sm:ml-10 md:ml-14 pl-6 space-y-5 [scrollbar-width:thin] [scrollbar-color:#94a3b8_transparent]">
                        @foreach ($items as $item)
                            @php
                                $isObject = is_object($item);
                                $isArray = is_array($item);
                                $period = $isObject ? ($item->period ?? '') : ($isArray ? ($item['period'] ?? '') : '');
                                $title = $isObject ? ($item->title ?? '') : ($isArray ? ($item['title'] ?? '') : '');
                                $icon = $isObject ? ($item->icon ?? 'document') : ($isArray ? ($item['icon'] ?? 'document') : 'document');
                                $customUrl = $isObject ? ($item->custom_icon_url ?? null) : ($isArray ? ($item['custom_icon_url'] ?? null) : null);
                                $isHighlighted = $isObject ? (bool) ($item->is_highlighted ?? false) : (bool) ($isArray ? ($item['is_highlighted'] ?? false) : false);
                            @endphp

                            <div class="relative">
                                {{-- Dot Indicator --}}
                                @if ($isHighlighted)
                                    <div class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full bg-[#F59E0B] border-2 border-white ring-2 ring-amber-300 shadow-xs"></div>
                                @else
                                    <div class="absolute -left-[31px] top-1.5 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs"></div>
                                @endif

                                {{-- Card --}}
                                <div class="relative bg-white rounded-2xl p-4 shadow-xs border border-slate-200/90 hover:shadow-md transition-shadow">
                                    <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                                        <x-milestone-icon :icon="$icon" :custom-url="$customUrl" class="w-4 h-4 text-[#16A34A] shrink-0" />
                                        <span class="text-gray-300 font-light text-xs">|</span>
                                        <span class="text-sm font-bold text-[#0A1E3B]">{{ $period }}</span>
                                    </div>
                                    <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                                        {{ $title }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Bottom Fade Indicator --}}
                    <div x-show="canScrollDown" x-cloak class="absolute bottom-0 left-0 right-0 h-10 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
                </div>
            @else
                <div class="py-12 text-center text-xs text-gray-400">
                    No journey milestones published at this time.
                </div>
            @endif
        </div>

    </div>
</section>
