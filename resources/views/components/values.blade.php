<section id="journey-milestones" class="py-16 sm:py-24 relative z-20 overflow-hidden bg-white border-b border-gray-100">
    {{-- Parallax Background Image Layer (Pipeline & Scenic Hills) --}}
    <div class="absolute inset-0 w-full h-full pointer-events-none overflow-hidden z-0">
        <img src="{{ asset('images/assets/Eco Energy Pipeline Landscape 1.png') }}" 
             alt="Eco Energy Pipeline Landscape" 
             class="milestones-bg-parallax w-full h-auto min-h-[320px] object-cover object-bottom absolute bottom-0 left-0 right-0 will-change-transform">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Section Title (Enters first smoothly) --}}
        <div class="text-center mb-14 sm:mb-16 milestones-title-parallax will-change-transform">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                Journey So Far <span class="font-normal text-gray-400">–</span> <span class="text-[#2E8B3D]">Key Milestones</span>
            </h2>
        </div>

        {{-- Timeline Content Track (Rises smoothly from bottom to top with parallax scrub) --}}
        <div class="milestones-timeline-parallax will-change-transform">
            {{-- Horizontal Alternating Timeline (Desktop Wide Only: >= xl) --}}
            <div class="hidden xl:block relative py-6 max-w-7xl mx-auto px-2 sm:px-4 lg:px-6">
            <div class="relative w-full h-[330px]">
                
                {{-- Continuous Sky-Blue Timeline Bar --}}
                <div class="absolute top-[155px] left-[6%] right-[6%] h-[3.5px] bg-[#48CAE4] rounded-full -translate-y-1/2 z-0"></div>

                {{-- Milestone 1: Dec 2023 (Top Row) --}}
                <div class="absolute" style="left: 8%;">
                    {{-- Dot 1 --}}
                    <div class="absolute top-[155px] left-0 -translate-x-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs z-10"></div>
                    
                    {{-- Card 1 (Top) --}}
                    <div class="absolute top-[16px] left-0 -translate-x-1/2 w-[205px] xl:w-[225px] min-h-[124px] h-auto bg-white rounded-2xl p-3 sm:p-3.5 shadow-[0_4px_16px_rgba(0,0,0,0.06)] border border-slate-200/90 hover:shadow-md transition-shadow z-20 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                                {{-- Document Checklist Icon --}}
                                <svg class="w-5 h-5 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                </svg>
                                <span class="text-gray-300 font-light text-xs">|</span>
                                <span class="text-sm font-bold text-[#0A1E3B]">Dec 2023</span>
                            </div>
                            <p class="text-[11.5px] sm:text-xs text-slate-600 leading-[1.38] mt-1.5">
                                BPCL Board approves bid strategy for CGD Round 12 &amp; 12A
                            </p>
                        </div>
                        {{-- Tooltip Pointer pointing directly to Dot 1 --}}
                        <div class="absolute -bottom-[7px] left-1/2 -translate-x-1/2 w-3.5 h-3.5 bg-white border-r border-b border-slate-200 rotate-45 transform"></div>
                    </div>
                </div>

                {{-- Milestone 2: Apr 2024 (Bottom Row) --}}
                <div class="absolute" style="left: calc(8% + 1 * (84% / 7));">
                    {{-- Dot 2 --}}
                    <div class="absolute top-[155px] left-0 -translate-x-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs z-10"></div>
                    
                    {{-- Card 2 (Bottom) --}}
                    <div class="absolute top-[172px] left-0 -translate-x-1/2 w-[205px] xl:w-[225px] min-h-[124px] h-auto bg-white rounded-2xl p-3 sm:p-3.5 pb-4 shadow-[0_4px_16px_rgba(0,0,0,0.06)] border border-slate-200/90 hover:shadow-md transition-shadow z-20 flex flex-col justify-between">
                        {{-- Tooltip Pointer pointing directly to Dot 2 --}}
                        <div class="absolute -top-[7px] left-1/2 -translate-x-1/2 w-3.5 h-3.5 bg-white border-l border-t border-slate-200 rotate-45 transform"></div>
                        <div>
                            <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                                {{-- Gavel Icon --}}
                                <svg class="w-5 h-5 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 6l4 4M9 11l4 4m-8 5l5-5m3-3l3-3a2.121 2.121 0 00-3-3l-3 3m0 0L4 16l4 4 6-6z" />
                                </svg>
                                <span class="text-gray-300 font-light text-xs">|</span>
                                <span class="text-sm font-bold text-[#0A1E3B]">Apr 2024</span>
                            </div>
                            <p class="text-[11.5px] sm:text-xs text-slate-600 leading-[1.38] mt-1.5">
                                PNGRB grants CGD authorisation for GA-12.01 to BPCL–OIL Consortium
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Milestone 3: Oct–Nov 2024 (Top Row) --}}
                <div class="absolute" style="left: calc(8% + 2 * (84% / 7));">
                    {{-- Dot 3 --}}
                    <div class="absolute top-[155px] left-0 -translate-x-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs z-10"></div>
                    
                    {{-- Card 3 (Top) --}}
                    <div class="absolute top-[16px] left-0 -translate-x-1/2 w-[205px] xl:w-[225px] min-h-[124px] h-auto bg-white rounded-2xl p-3 sm:p-3.5 shadow-[0_4px_16px_rgba(0,0,0,0.06)] border border-slate-200/90 hover:shadow-md transition-shadow z-20 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                                {{-- Handshake Icon --}}
                                <svg class="w-5 h-5 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="m11 17 2 2a1 1 0 0 0 1.4 0l4.3-4.3a1 1 0 0 0 0-1.4l-3.3-3.3a1 1 0 0 0-1.4 0L11 13"/>
                                    <path d="m18 10 3.3-3.3a1 1 0 0 0 0-1.4l-2.6-2.6a1 1 0 0 0-1.4 0L14 6"/>
                                    <path d="m2 14 3.3 3.3a1 1 0 0 0 1.4 0L10 14"/>
                                    <path d="M9 7 5.7 3.7a1 1 0 0 0-1.4 0L1.7 6.3a1 1 0 0 0 0 1.4L5 11"/>
                                </svg>
                                <span class="text-gray-300 font-light text-xs">|</span>
                                <span class="text-sm font-bold text-[#0A1E3B]">Oct–Nov 2024</span>
                            </div>
                            <p class="text-[11.5px] sm:text-xs text-slate-600 leading-[1.38] mt-1.5">
                                BPCL &amp; OIL Boards approve JVA; DIPAM/MoPNG guidelines followed
                            </p>
                        </div>
                        <div class="absolute -bottom-[7px] left-1/2 -translate-x-1/2 w-3.5 h-3.5 bg-white border-r border-b border-slate-200 rotate-45 transform"></div>
                    </div>
                </div>

                {{-- Milestone 4: Jun 2025 (Bottom Row) --}}
                <div class="absolute" style="left: calc(8% + 3 * (84% / 7));">
                    {{-- Dot 4 --}}
                    <div class="absolute top-[155px] left-0 -translate-x-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs z-10"></div>
                    
                    {{-- Card 4 (Bottom) --}}
                    <div class="absolute top-[172px] left-0 -translate-x-1/2 w-[205px] xl:w-[225px] min-h-[124px] h-auto bg-white rounded-2xl p-3 sm:p-3.5 pb-4 shadow-[0_4px_16px_rgba(0,0,0,0.06)] border border-slate-200/90 hover:shadow-md transition-shadow z-20 flex flex-col justify-between">
                        <div class="absolute -top-[7px] left-1/2 -translate-x-1/2 w-3.5 h-3.5 bg-white border-l border-t border-slate-200 rotate-45 transform"></div>
                        <div>
                            <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                                {{-- Document Badge Icon --}}
                                <svg class="w-5 h-5 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-300 font-light text-xs">|</span>
                                <span class="text-sm font-bold text-[#0A1E3B]">Jun 2025</span>
                            </div>
                            <p class="text-[11.5px] sm:text-xs text-slate-600 leading-[1.38] mt-1.5">
                                DIPAM concurrence &amp; MoPNG approval received for JV formation
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Milestone 5: 2025–26 (Top Row) --}}
                <div class="absolute" style="left: calc(8% + 4 * (84% / 7));">
                    {{-- Dot 5 --}}
                    <div class="absolute top-[155px] left-0 -translate-x-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs z-10"></div>
                    
                    {{-- Card 5 (Top) --}}
                    <div class="absolute top-[16px] left-0 -translate-x-1/2 w-[205px] xl:w-[225px] min-h-[124px] h-auto bg-white rounded-2xl p-3 sm:p-3.5 shadow-[0_4px_16px_rgba(0,0,0,0.06)] border border-slate-200/90 hover:shadow-md transition-shadow z-20 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                                {{-- Users Group Icon --}}
                                <svg class="w-5 h-5 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                                <span class="text-gray-300 font-light text-xs">|</span>
                                <span class="text-sm font-bold text-[#0A1E3B]">2025–26</span>
                            </div>
                            <p class="text-[11.5px] sm:text-xs text-slate-600 leading-[1.38] mt-1.5">
                                AGPL incorporated; Board, CEO, CFO and core team operationalised
                            </p>
                        </div>
                        <div class="absolute -bottom-[7px] left-1/2 -translate-x-1/2 w-3.5 h-3.5 bg-white border-r border-b border-slate-200 rotate-45 transform"></div>
                    </div>
                </div>

                {{-- Milestone 6: Jun 2026 (Bottom Row) --}}
                <div class="absolute" style="left: calc(8% + 5 * (84% / 7));">
                    {{-- Dot 6 --}}
                    <div class="absolute top-[155px] left-0 -translate-x-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs z-10"></div>
                    
                    {{-- Card 6 (Bottom) --}}
                    <div class="absolute top-[172px] left-0 -translate-x-1/2 w-[205px] xl:w-[225px] min-h-[124px] h-auto bg-white rounded-2xl p-3 sm:p-3.5 pb-4 shadow-[0_4px_16px_rgba(0,0,0,0.06)] border border-slate-200/90 hover:shadow-md transition-shadow z-20 flex flex-col justify-between">
                        <div class="absolute -top-[7px] left-1/2 -translate-x-1/2 w-3.5 h-3.5 bg-white border-l border-t border-slate-200 rotate-45 transform"></div>
                        <div>
                            <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                                {{-- Megaphone Icon --}}
                                <svg class="w-5 h-5 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                                <span class="text-gray-300 font-light text-xs">|</span>
                                <span class="text-sm font-bold text-[#0A1E3B]">Jun 2026</span>
                            </div>
                            <p class="text-[11.5px] sm:text-xs text-slate-600 leading-[1.38] mt-1.5">
                                Stakeholder outreach launched — DC-ICR, Director (Earth Sciences), Hon'ble Home Minister, Arunachal Pradesh
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Milestone 7: Aug 2026 (Top Row) --}}
                <div class="absolute" style="left: calc(8% + 6 * (84% / 7));">
                    {{-- Dot 7 --}}
                    <div class="absolute top-[155px] left-0 -translate-x-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs z-10"></div>
                    
                    {{-- Card 7 (Top) --}}
                    <div class="absolute top-[16px] left-0 -translate-x-1/2 w-[205px] xl:w-[225px] min-h-[124px] h-auto bg-white rounded-2xl p-3 sm:p-3.5 shadow-[0_4px_16px_rgba(0,0,0,0.06)] border border-slate-200/90 hover:shadow-md transition-shadow z-20 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                                {{-- Map Pin Icon --}}
                                <svg class="w-5 h-5 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <span class="text-gray-300 font-light text-xs">|</span>
                                <span class="text-sm font-bold text-[#0A1E3B]">Aug 2026</span>
                            </div>
                            <p class="text-[11.5px] sm:text-xs text-slate-600 leading-[1.38] mt-1.5">
                                Namsai district engagement — Hon'ble MLA &amp; DC Namsai; Namsai proposed as role-model district
                            </p>
                        </div>
                        <div class="absolute -bottom-[7px] left-1/2 -translate-x-1/2 w-3.5 h-3.5 bg-white border-r border-b border-slate-200 rotate-45 transform"></div>
                    </div>
                </div>

                {{-- Milestone 8: Aug 2026 (Bottom Row - Amber Dot) --}}
                <div class="absolute" style="left: 92%;">
                    {{-- Dot 8 (Amber) --}}
                    <div class="absolute top-[155px] left-0 -translate-x-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-[#F59E0B] border-2 border-white ring-2 ring-amber-300 shadow-xs z-10"></div>
                    
                    {{-- Card 8 (Bottom) --}}
                    <div class="absolute top-[172px] left-0 -translate-x-1/2 w-[205px] xl:w-[225px] min-h-[124px] h-auto bg-white rounded-2xl p-3 sm:p-3.5 pb-4 shadow-[0_4px_16px_rgba(0,0,0,0.06)] border border-slate-200/90 hover:shadow-md transition-shadow z-20 flex flex-col justify-between">
                        <div class="absolute -top-[7px] left-1/2 -translate-x-1/2 w-3.5 h-3.5 bg-white border-l border-t border-slate-200 rotate-45 transform"></div>
                        <div>
                            <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                                {{-- Cog / Settings Icon --}}
                                <svg class="w-5 h-5 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-gray-300 font-light text-xs">|</span>
                                <span class="text-sm font-bold text-[#0A1E3B]">Aug 2026</span>
                            </div>
                            <p class="text-[11.5px] sm:text-xs text-slate-600 leading-[1.38] mt-1.5">
                                Management Review — governance, procurement and financing workstreams active
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Responsive Vertical Timeline (Visible on Mobile, Tablet & Screens < xl matching 2nd screenshot) --}}
        <div class="xl:hidden relative border-l-2 border-[#48CAE4] ml-6 sm:ml-10 md:ml-14 pl-6 space-y-6 max-w-2xl sm:max-w-3xl">
            
            <div class="relative">
                <div class="absolute -left-[31px] top-1.5 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs"></div>
                <div class="relative bg-white rounded-2xl p-4 shadow-sm border border-slate-200/90">
                    <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                        <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                        <span class="text-gray-300 font-light text-xs">|</span>
                        <span class="text-sm font-bold text-[#0A1E3B]">Dec 2023</span>
                    </div>
                    <p class="text-xs text-slate-600 mt-2">BPCL Board approves bid strategy for CGD Round 12 &amp; 12A</p>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -left-[31px] top-1.5 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs"></div>
                <div class="relative bg-white rounded-2xl p-4 shadow-sm border border-slate-200/90">
                    <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                        <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 6l4 4M9 11l4 4m-8 5l5-5m3-3l3-3a2.121 2.121 0 00-3-3l-3 3m0 0L4 16l4 4 6-6z" />
                        </svg>
                        <span class="text-gray-300 font-light text-xs">|</span>
                        <span class="text-sm font-bold text-[#0A1E3B]">Apr 2024</span>
                    </div>
                    <p class="text-xs text-slate-600 mt-2">PNGRB grants CGD authorisation for GA-12.01 to BPCL–OIL Consortium</p>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -left-[31px] top-1.5 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs"></div>
                <div class="relative bg-white rounded-2xl p-4 shadow-sm border border-slate-200/90">
                    <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                        <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="m11 17 2 2a1 1 0 0 0 1.4 0l4.3-4.3a1 1 0 0 0 0-1.4l-3.3-3.3a1 1 0 0 0-1.4 0L11 13"/>
                            <path d="m18 10 3.3-3.3a1 1 0 0 0 0-1.4l-2.6-2.6a1 1 0 0 0-1.4 0L14 6"/>
                            <path d="m2 14 3.3 3.3a1 1 0 0 0 1.4 0L10 14"/>
                            <path d="M9 7 5.7 3.7a1 1 0 0 0-1.4 0L1.7 6.3a1 1 0 0 0 0 1.4L5 11"/>
                        </svg>
                        <span class="text-gray-300 font-light text-xs">|</span>
                        <span class="text-sm font-bold text-[#0A1E3B]">Oct–Nov 2024</span>
                    </div>
                    <p class="text-xs text-slate-600 mt-2">BPCL &amp; OIL Boards approve JVA; DIPAM/MoPNG guidelines followed</p>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -left-[31px] top-1.5 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs"></div>
                <div class="relative bg-white rounded-2xl p-4 shadow-sm border border-slate-200/90">
                    <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                        <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-gray-300 font-light text-xs">|</span>
                        <span class="text-sm font-bold text-[#0A1E3B]">Jun 2025</span>
                    </div>
                    <p class="text-xs text-slate-600 mt-2">DIPAM concurrence &amp; MoPNG approval received for JV formation</p>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -left-[31px] top-1.5 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs"></div>
                <div class="relative bg-white rounded-2xl p-4 shadow-sm border border-slate-200/90">
                    <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                        <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                        <span class="text-gray-300 font-light text-xs">|</span>
                        <span class="text-sm font-bold text-[#0A1E3B]">2025–26</span>
                    </div>
                    <p class="text-xs text-slate-600 mt-2">AGPL incorporated; Board, CEO, CFO and core team operationalised</p>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -left-[31px] top-1.5 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs"></div>
                <div class="relative bg-white rounded-2xl p-4 shadow-sm border border-slate-200/90">
                    <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                        <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                        <span class="text-gray-300 font-light text-xs">|</span>
                        <span class="text-sm font-bold text-[#0A1E3B]">Jun 2026</span>
                    </div>
                    <p class="text-xs text-slate-600 mt-2">Stakeholder outreach launched — DC-ICR, Director (Earth Sciences), Hon'ble Home Minister, Arunachal Pradesh</p>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -left-[31px] top-1.5 w-3.5 h-3.5 rounded-full bg-[#16A34A] border-2 border-white shadow-xs"></div>
                <div class="relative bg-white rounded-2xl p-4 shadow-sm border border-slate-200/90">
                    <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                        <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        <span class="text-gray-300 font-light text-xs">|</span>
                        <span class="text-sm font-bold text-[#0A1E3B]">Aug 2026</span>
                    </div>
                    <p class="text-xs text-slate-600 mt-2">Namsai district engagement — Hon'ble MLA &amp; DC Namsai; Namsai proposed as role-model district</p>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -left-[31px] top-1.5 w-3.5 h-3.5 rounded-full bg-[#F59E0B] border-2 border-white ring-2 ring-amber-300 shadow-xs"></div>
                <div class="relative bg-white rounded-2xl p-4 shadow-sm border border-slate-200/90">
                    <div class="flex items-center space-x-2 pb-1.5 border-b border-gray-100">
                        <svg class="w-4 h-4 text-[#16A34A] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-gray-300 font-light text-xs">|</span>
                        <span class="text-sm font-bold text-[#0A1E3B]">Aug 2026</span>
                    </div>
                    <p class="text-xs text-slate-600 mt-2">Management Review — governance, procurement and financing workstreams active</p>
                </div>
            </div>

        </div>

        {{-- End Timeline Content Track --}}
        </div>

    </div>
</section>
