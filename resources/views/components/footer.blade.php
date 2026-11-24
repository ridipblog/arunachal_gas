<footer id="contact" class="bg-white relative overflow-hidden text-slate-700">
    {{-- Main Footer Navigation Columns --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 sm:pt-14 pb-4 sm:pb-6 relative z-10">
        <div class="flex flex-col md:flex-row items-start justify-between">
            
            {{-- Column 1: Brand & Logo --}}
            <div class="w-full md:w-[20%] pr-4 lg:pr-6 pb-6 md:pb-0">
                <a href="/" class="inline-block group">
                    <img src="{{ asset('images/assets/AGPL LOGO 1.png') }}" alt="AGPL Logo" class="h-16 sm:h-20 w-auto object-contain transition-transform group-hover:scale-105">
                </a>
                <p class="mt-3 text-slate-500 font-medium text-xs sm:text-[13px] leading-relaxed">
                    Clean Energy for a<br>Greener Arunachal
                </p>
            </div>

            {{-- Column 2: Quick Links --}}
            <div class="w-full md:w-[18%] px-0 md:px-5 lg:px-6 py-6 md:py-0 border-t md:border-t-0 md:border-l border-slate-200">
                <h3 class="text-[15px] sm:text-base font-bold text-[#0A1E3B] mb-3.5 sm:mb-4">Quick Links</h3>
                <ul class="space-y-2.5 text-xs sm:text-[13px] text-slate-600">
                    <li><a href="/" class="hover:text-emerald-700 transition-colors">Home</a></li>
                    <li><a href="#about" class="hover:text-emerald-700 transition-colors">About Us</a></li>
                    <li><a href="#services" class="hover:text-emerald-700 transition-colors">Our Services</a></li>
                    <li><a href="#targets" class="hover:text-emerald-700 transition-colors">Projects</a></li>
                    <li><a href="#tenders" class="hover:text-emerald-700 transition-colors">Media &amp; Updates</a></li>
                    <li><a href="#contact" class="hover:text-emerald-700 transition-colors">Contact Us</a></li>
                </ul>
            </div>

            {{-- Column 3: Our Services --}}
            <div class="w-full md:w-[23%] px-0 md:px-5 lg:px-6 py-6 md:py-0 border-t md:border-t-0 md:border-l border-slate-200">
                <h3 class="text-[15px] sm:text-base font-bold text-[#0A1E3B] mb-3.5 sm:mb-4">Our Services</h3>
                <ul class="space-y-3 text-xs sm:text-[13px] text-slate-600">
                    <li class="flex items-center space-x-2.5">
                        <img src="{{ asset('images/assets/Gas tap.png') }}" alt="" class="w-[18px] h-[18px] object-contain flex-shrink-0">
                        <a href="#services" class="hover:text-emerald-700 transition-colors">Piped Natural Gas (PNG)</a>
                    </li>
                    <li class="flex items-center space-x-2.5">
                        <img src="{{ asset('images/assets/fuel.png') }}" alt="" class="w-[18px] h-[18px] object-contain flex-shrink-0">
                        <a href="#services" class="hover:text-emerald-700 transition-colors">Compressed Natural Gas (CNG)</a>
                    </li>
                    <li class="flex items-center space-x-2.5">
                        <img src="{{ asset('images/assets/users-round.png') }}" alt="" class="w-[18px] h-[18px] object-contain flex-shrink-0">
                        <a href="#enquiry" class="hover:text-emerald-700 transition-colors">Customer Enquiry</a>
                    </li>
                    <li class="flex items-center space-x-2.5">
                        <img src="{{ asset('images/assets/handshake.png') }}" alt="" class="w-[18px] h-[18px] object-contain flex-shrink-0">
                        <a href="#contact" class="hover:text-emerald-700 transition-colors">Business Partnership</a>
                    </li>
                </ul>
            </div>

            {{-- Column 4: Contact Us --}}
            <div class="w-full md:w-[23%] px-0 md:px-5 lg:px-6 py-6 md:py-0 border-t md:border-t-0 md:border-l border-slate-200">
                <h3 class="text-[15px] sm:text-base font-bold text-[#0A1E3B] mb-3.5 sm:mb-4">Contact Us</h3>
                <div class="space-y-3.5 text-xs sm:text-[13px] text-slate-600">
                    <div class="flex items-start space-x-2.5">
                        <img src="{{ asset('images/assets/map-pin.png') }}" alt="" class="w-[18px] h-[18px] object-contain flex-shrink-0 mt-0.5">
                        <span class="leading-snug">Itanagar, Arunachal Pradesh<br>India – 791111</span>
                    </div>
                    <div class="flex items-center space-x-2.5">
                        <img src="{{ asset('images/assets/phone.png') }}" alt="" class="w-[18px] h-[18px] object-contain flex-shrink-0">
                        <a href="tel:+911234567890" class="hover:text-emerald-700 transition-colors font-medium">+91 12345 67890</a>
                    </div>
                    <div class="flex items-center space-x-2.5">
                        <img src="{{ asset('images/assets/mail.png') }}" alt="" class="w-[18px] h-[18px] object-contain flex-shrink-0">
                        <a href="mailto:info@arunachalgas.in" class="hover:text-emerald-700 transition-colors">info@arunachalgas.in</a>
                    </div>
                </div>
            </div>

            {{-- Column 5: Follow Us --}}
            <div class="w-full md:w-[16%] pl-0 md:pl-5 lg:pl-6 pt-6 md:pt-0 border-t md:border-t-0 md:border-l border-slate-200">
                <h3 class="text-[15px] sm:text-base font-bold text-[#0A1E3B] mb-3.5 sm:mb-4">Follow Us</h3>
                <div class="flex items-center space-x-2.5">
                    <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="hover:opacity-85 hover:scale-105 transition duration-150 inline-block" title="LinkedIn">
                        <img src="{{ asset('images/assets/LinkedIn.png') }}" alt="LinkedIn" class="w-7 h-7 sm:w-8 sm:h-8 object-contain">
                    </a>
                    <a href="https://x.com" target="_blank" rel="noopener noreferrer" class="hover:opacity-85 hover:scale-105 transition duration-150 inline-block" title="X (Twitter)">
                        <img src="{{ asset('images/assets/X.png') }}" alt="X" class="w-7 h-7 sm:w-8 sm:h-8 object-contain">
                    </a>
                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="hover:opacity-85 hover:scale-105 transition duration-150 inline-block" title="Facebook">
                        <img src="{{ asset('images/assets/Facebook.png') }}" alt="Facebook" class="w-7 h-7 sm:w-8 sm:h-8 object-contain">
                    </a>
                    <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="hover:opacity-85 hover:scale-105 transition duration-150 inline-block" title="YouTube">
                        <img src="{{ asset('images/assets/YouTube.png') }}" alt="YouTube" class="w-7 h-7 sm:w-8 sm:h-8 object-contain">
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- Landscape Graphic at Bottom of Footer --}}
    <div class="w-full overflow-hidden leading-none relative z-0 -mt-6 sm:-mt-10 lg:-mt-12 pointer-events-none select-none">
        <img src="{{ asset('images/assets/footer_background.png') }}" alt="Arunachal Green Hills & Monastery" class="w-full h-auto min-h-[90px] sm:min-h-[130px] lg:min-h-[170px] max-h-[220px] object-cover object-right-bottom block">
    </div>

    {{-- Sub-Footer Copyright & Legal Bar --}}
    <div class="relative z-20 bg-[#054d31] text-white py-3 sm:py-3.5 px-4 sm:px-6 lg:px-8 -mt-px">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between text-[11px] sm:text-xs text-emerald-100/90 gap-2 font-normal">
            <div>
                &copy; {{ date('Y') }} Arunachal Pradesh Gas Distribution Company Ltd. (AGPL). All Rights Reserved.
            </div>

            <div class="flex items-center space-x-4 sm:space-x-5 text-[11px] sm:text-xs">
                <a href="#privacy" class="hover:text-white transition-colors">Privacy Policy</a>
                <span class="text-emerald-300/40">|</span>
                <a href="#terms" class="hover:text-white transition-colors">Terms of Use</a>
                <span class="text-emerald-300/40">|</span>
                <a href="#disclaimer" class="hover:text-white transition-colors">Disclaimer</a>
            </div>
        </div>
    </div>
</footer>
