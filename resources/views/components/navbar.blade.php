<nav class="bg-[#2E8B3D] sticky top-0 z-30 shadow-xs" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center h-12">
            
            {{-- Desktop Navigation Links (Visible on >= lg) --}}
            <div class="hidden lg:flex items-center space-x-6 text-[13px] font-medium text-white">
                {{-- Home --}}
                <a href="/" class="hover:text-emerald-100 transition-colors">
                    Home
                </a>

                {{-- About Us Dropdown --}}
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="inline-flex items-center hover:text-emerald-100 transition-colors">
                        <span>About Us</span>
                        <svg class="ml-1 w-3 h-3 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-1 w-52 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100 divide-y divide-gray-50 text-xs text-gray-700">
                        <a href="#about" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">Corporate Profile</a>
                        <a href="#jv-partners" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">Joint Venture (BPCL &amp; OIL)</a>
                        <a href="#timeline" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">Journey &amp; Key Milestones</a>
                        <a href="#values" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">Our Values &amp; Vision</a>
                    </div>
                </div>

                {{-- Products Dropdown --}}
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="inline-flex items-center hover:text-emerald-100 transition-colors">
                        <span>Products</span>
                        <svg class="ml-1 w-3 h-3 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-1 w-60 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100 divide-y divide-gray-50 text-xs text-gray-700">
                        <a href="#services" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">Domestic PNG (Home Cooking)</a>
                        <a href="#services" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">Commercial &amp; Industrial PNG</a>
                        <a href="#services" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">CNG for Transportation</a>
                        <a href="#targets" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">CGD Pipeline Network</a>
                    </div>
                </div>

                {{-- Documents & Policies --}}
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="inline-flex items-center hover:text-emerald-100 transition-colors">
                        <span>Documents &amp; Policies</span>
                        <svg class="ml-1 w-3 h-3 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-1 w-52 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100 divide-y divide-gray-50 text-xs text-gray-700">
                        <a href="#documents" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">PNGRB Authorization</a>
                        <a href="#documents" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">HSE &amp; Safety Policy</a>
                        <a href="#documents" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">Citizen Charter &amp; Tariffs</a>
                    </div>
                </div>

                {{-- Vendors Zone --}}
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="inline-flex items-center hover:text-emerald-100 transition-colors">
                        <span>Vendors Zone</span>
                        <svg class="ml-1 w-3 h-3 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-1 w-52 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100 divide-y divide-gray-50 text-xs text-gray-700">
                        <a href="#tenders" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">Active Tenders &amp; EOIs</a>
                        <a href="#tenders" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">Vendor Empanelment</a>
                        <a href="#tenders" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">Procurement Guidelines</a>
                    </div>
                </div>

                {{-- Customers Zone --}}
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="inline-flex items-center hover:text-emerald-100 transition-colors">
                        <span>Customers Zone</span>
                        <svg class="ml-1 w-3 h-3 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-1 w-52 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100 divide-y divide-gray-50 text-xs text-gray-700">
                        <a href="#enquiry" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">Apply for Connection</a>
                        <a href="#faq" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">Customer FAQs</a>
                        <a href="#services" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">24x7 Emergency Help</a>
                    </div>
                </div>

                {{-- Gallery --}}
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="inline-flex items-center hover:text-emerald-100 transition-colors">
                        <span>Gallery</span>
                        <svg class="ml-1 w-3 h-3 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-1 w-48 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100 divide-y divide-gray-50 text-xs text-gray-700">
                        <a href="#gallery" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">Infrastructure Photos</a>
                        <a href="#gallery" class="block px-4 py-2 hover:bg-green-50 hover:text-agpl-green">Events &amp; Releases</a>
                    </div>
                </div>

                {{-- Contact Us --}}
                <a href="#contact" class="hover:text-emerald-100 transition-colors">
                    Contact Us
                </a>
            </div>

            {{-- Mobile & Tablet Menu Button (Visible on < lg) --}}
            <div class="flex lg:hidden items-center justify-between w-full">
                <span class="text-xs font-semibold text-white">Menu</span>
                <button type="button" 
                        @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-emerald-700/80 active:bg-emerald-800 transition-colors focus:outline-none focus:ring-2 focus:ring-white/40 cursor-pointer"
                        :aria-expanded="mobileMenuOpen"
                        aria-label="Toggle navigation menu">
                    <span class="sr-only">Toggle navigation menu</span>
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        {{-- Hamburger Icon (Visible when closed) --}}
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                        {{-- Close X Icon (Visible when open) --}}
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile & Tablet Menu Dropdown --}}
    <div class="lg:hidden bg-[#247031] border-t border-emerald-600" x-show="mobileMenuOpen" x-transition>
        <div class="px-3 pt-2 pb-4 space-y-1 text-xs text-white">
            <a href="/" class="block px-3 py-2 rounded-md font-medium hover:bg-emerald-700">Home</a>
            <a href="#about" class="block px-3 py-2 rounded-md font-medium hover:bg-emerald-700">About Us</a>
            <a href="#services" class="block px-3 py-2 rounded-md font-medium hover:bg-emerald-700">Products</a>
            <a href="#documents" class="block px-3 py-2 rounded-md font-medium hover:bg-emerald-700">Documents &amp; Policies</a>
            <a href="#tenders" class="block px-3 py-2 rounded-md font-medium hover:bg-emerald-700">Vendors Zone</a>
            <a href="#enquiry" class="block px-3 py-2 rounded-md font-medium hover:bg-emerald-700">Customers Zone</a>
            <a href="#gallery" class="block px-3 py-2 rounded-md font-medium hover:bg-emerald-700">Gallery</a>
            <a href="#contact" class="block px-3 py-2 rounded-md font-medium hover:bg-emerald-700">Contact Us</a>
            <div class="pt-2 border-t border-emerald-700">
                <a href="#enquiry" class="block w-full text-center px-4 py-2 rounded-md font-bold text-white bg-[#0B5CAB]">
                    New Connection
                </a>
            </div>
        </div>
    </div>
</nav>
