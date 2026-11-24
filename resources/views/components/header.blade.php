<header class="w-full bg-white relative z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex justify-between items-center">
        
        {{-- Brand Logo & Text Lockup using asset/AGPL LOGO 1.png --}}
        <a href="/" class="flex items-center space-x-2 sm:space-x-3 group">
            <img src="{{ asset('images/assets/AGPL LOGO 1.png') }}" 
                 alt="AGPL - Arunachal Gas Private Limited" 
                 class="h-10 sm:h-12 w-auto object-contain">
            
            <div class="flex flex-col">
                <span class="text-base sm:text-lg font-bold text-[#1E3A8A] leading-tight group-hover:text-agpl-green transition-colors">
                    Arunachal Gas Private Limited
                </span>
                <span class="text-[10px] sm:text-[11px] font-semibold text-[#15803D] tracking-wide">
                    A Joint Venture of BPCL &amp; OIL India Limited
                </span>
            </div>
        </a>

        {{-- Action CTA Button matching Figma 1:1 --}}
        <div>
            <a href="#enquiry" class="inline-flex items-center justify-center px-4 sm:px-5 py-2 rounded-lg text-xs font-semibold text-white bg-[#0B5CAB] hover:bg-[#094785] shadow-xs hover:shadow-md transition-all duration-200">
                <span>New Connection</span>
            </a>
        </div>
    </div>
</header>
