<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Panel' }} - Arunachal Gas (AGPL)</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/admin.js'])
</head>
<body class="h-full font-sans text-slate-800 antialiased bg-slate-100" x-data="{ sidebarOpen: false }">

    {{-- Toast Notification System (Auto dismiss after 4s) --}}
    @if (session('success') || session('error'))
        <div x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 4000)"
             x-transition:enter="transform ease-out duration-300 transition"
             x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
             x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed top-5 right-5 z-50 max-w-sm w-full bg-white rounded-2xl shadow-xl border p-4 flex items-start space-x-3 {{ session('success') ? 'border-green-200' : 'border-red-200' }}">
            <div class="shrink-0 mt-0.5">
                @if (session('success'))
                    <div class="w-6 h-6 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm">✓</div>
                @else
                    <div class="w-6 h-6 rounded-full bg-red-100 text-red-700 flex items-center justify-center font-bold text-sm">✕</div>
                @endif
            </div>
            <div class="flex-1">
                <h4 class="text-xs font-bold uppercase tracking-wider {{ session('success') ? 'text-green-800' : 'text-red-800' }}">
                    {{ session('success') ? 'Success' : 'Notice' }}
                </h4>
                <p class="text-xs sm:text-sm text-slate-600 mt-0.5">
                    {{ session('success') ?? session('error') }}
                </p>
            </div>
            <button type="button" @click="show = false" class="text-slate-400 hover:text-slate-600 text-base leading-none">
                &times;
            </button>
        </div>
    @endif

    <div class="min-h-full flex">
        
        {{-- Mobile Sidebar Backdrop --}}
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-xs lg:hidden" 
             style="display: none;"></div>

        {{-- Sidebar Component --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0A1E3B] text-white flex flex-col justify-between transition-transform duration-300 ease-in-out shadow-2xl lg:shadow-none">
            
            <div>
                {{-- Brand Logo & Title --}}
                <div class="h-20 px-6 flex items-center justify-between border-b border-white/10">
                    <a href="{{ route('admin.services.index') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center">
                            <img src="{{ asset('images/assets/AGPL Logo SVG.svg') }}" 
                                 alt="AGPL" 
                                 class="w-7 h-7 object-contain"
                                 onerror="this.onerror=null; this.parentElement.innerHTML='<span class=\'text-lg font-black text-white\'>AG</span>';">
                        </div>
                        <div>
                            <span class="text-base font-extrabold tracking-tight text-white block leading-tight">
                                Arunachal Gas
                            </span>
                            <span class="text-[10px] uppercase tracking-wider text-[#2E8B3D] font-bold">
                                Admin Dashboard
                            </span>
                        </div>
                    </a>
                    <button type="button" @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white p-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Navigation Links --}}
                <nav class="p-4 space-y-1.5">
                    <p class="px-3 pt-3 pb-1.5 text-[10.5px] font-bold uppercase tracking-wider text-slate-400">
                        Content Management
                    </p>

                    {{-- Services Manager --}}
                    <a href="{{ route('admin.services.index') }}" 
                       class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('admin.services.*') ? 'bg-[#2E8B3D] text-white shadow-md' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                        </svg>
                        <span>Our Services (6 Items)</span>
                    </a>

                    {{-- Live Website Quick Link --}}
                    <div class="pt-4 px-1">
                        <a href="{{ url('/') }}" target="_blank" 
                           class="flex items-center justify-between px-3.5 py-2.5 rounded-xl border border-white/15 bg-white/5 hover:bg-white/10 text-xs font-semibold text-slate-200 transition-all group">
                            <span class="flex items-center space-x-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span>View Live Website</span>
                            </span>
                            <span class="text-slate-400 group-hover:text-white transition-colors">&nearr;</span>
                        </a>
                    </div>
                </nav>
            </div>

            {{-- Bottom Admin Info & Logout --}}
            <div class="p-4 border-t border-white/10 bg-black/15">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2.5 min-w-0">
                        <div class="w-8 h-8 rounded-full bg-[#2E8B3D] text-white flex items-center justify-center font-bold text-xs uppercase shadow-xs">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-bold text-white truncate">
                                {{ auth()->user()->name ?? 'Administrator' }}
                            </p>
                            <p class="text-[10px] text-slate-400 truncate">
                                {{ auth()->user()->email ?? 'admin@agpl.in' }}
                            </p>
                        </div>
                    </div>
                    
                    {{-- Logout Form --}}
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" 
                                title="Sign Out" 
                                class="p-1.5 rounded-lg text-slate-400 hover:text-red-400 hover:bg-white/5 transition-colors cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

        </aside>

        {{-- Main Content Area --}}
        <div class="flex-1 lg:pl-64 flex flex-col min-w-0">
            
            {{-- Top Header Bar --}}
            <header class="h-20 bg-white border-b border-slate-200 sticky top-0 z-30 flex items-center justify-between px-4 sm:px-8">
                <div class="flex items-center space-x-4">
                    <button type="button" @click="sidebarOpen = true" class="lg:hidden text-slate-600 hover:text-slate-900 p-2 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                    </button>
                    <div>
                        <h1 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight">
                            @yield('page_title', 'Dashboard')
                        </h1>
                        <p class="text-xs text-slate-500">
                            @yield('page_subtitle', 'Manage website content, images and configurations')
                        </p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ url('/') }}" target="_blank" 
                       class="hidden sm:inline-flex items-center space-x-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors">
                        <span>View Live Website</span>
                        <span class="text-sm">&nearr;</span>
                    </a>
                </div>
            </header>

            {{-- Main Page Body --}}
            <main class="flex-1 p-4 sm:p-8">
                @yield('content')
            </main>

        </div>

    </div>

    @stack('scripts')
</body>
</html>
