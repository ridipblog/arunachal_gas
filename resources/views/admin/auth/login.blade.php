<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - Arunachal Gas (AGPL)</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex items-center justify-center p-4 sm:p-6 font-sans text-slate-800 antialiased selection:bg-[#2E8B3D] selection:text-white">

    <div class="w-full max-w-md">
        
        {{-- Card Container --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            
            {{-- Header with Brand Branding --}}
            <div class="bg-gradient-to-br from-[#0A1E3B] via-[#0D2D59] to-[#0A1E3B] px-8 pt-9 pb-8 text-white text-center relative overflow-hidden">
                {{-- Decorative Glow Circles --}}
                <div class="absolute -top-12 -right-12 w-36 h-36 bg-[#2E8B3D]/25 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-[#0B5CAB]/30 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col items-center">
                    {{-- Logo / Icon Badge --}}
                    <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center mb-3 shadow-inner">
                        <img src="{{ asset('images/assets/AGPL Logo SVG.svg') }}" 
                             alt="AGPL Logo" 
                             class="w-10 h-10 object-contain drop-shadow"
                             onerror="this.onerror=null; this.parentElement.innerHTML='<span class=\'text-2xl font-black text-white\'>AG</span>';">
                    </div>
                    <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight">
                        Arunachal Gas
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-300 mt-1 font-medium">
                        Content Management &amp; Administration
                    </p>
                </div>
            </div>

            {{-- Body / Form --}}
            <div class="p-7 sm:p-8 space-y-6">
                
                {{-- Session Flash Alerts --}}
                @if (session('success'))
                    <div class="p-3.5 rounded-xl bg-green-50 border border-green-200 text-green-800 text-xs sm:text-sm flex items-center space-x-2">
                        <svg class="w-4 h-4 text-green-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs sm:text-sm flex items-center space-x-2">
                        <svg class="w-4 h-4 text-red-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs sm:text-sm">
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- Email Input --}}
                    <div>
                        <label for="email" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                            Admin Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                </svg>
                            </div>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email', 'admin@agpl.in') }}" 
                                   required 
                                   autofocus
                                   placeholder="admin@agpl.in"
                                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 focus:border-[#2E8B3D] focus:ring-2 focus:ring-[#2E8B3D]/20 outline-hidden text-sm transition-all bg-slate-50/50 hover:bg-white focus:bg-white">
                        </div>
                    </div>

                    {{-- Password Input with Alpine Show/Hide --}}
                    <div x-data="{ show: false }">
                        <label for="password" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                                </svg>
                            </div>
                            <input :type="show ? 'text' : 'password'" 
                                   name="password" 
                                   id="password" 
                                   required 
                                   placeholder="Enter your password"
                                   class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-slate-200 focus:border-[#2E8B3D] focus:ring-2 focus:ring-[#2E8B3D]/20 outline-hidden text-sm transition-all bg-slate-50/50 hover:bg-white focus:bg-white">
                            <button type="button" 
                                    @click="show = !show" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-hidden">
                                <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center justify-between pt-1">
                        <label class="inline-flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" 
                                   name="remember" 
                                   value="1" 
                                   class="w-4 h-4 rounded-md border-slate-300 text-[#2E8B3D] focus:ring-[#2E8B3D]/30">
                            <span class="text-xs text-slate-600 font-medium">Keep me signed in</span>
                        </label>
                        <a href="{{ url('/') }}" class="text-xs text-[#0B5CAB] hover:underline font-semibold flex items-center space-x-1">
                            <span>Back to Website</span>
                            <span>&rarr;</span>
                        </a>
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-3">
                        <button type="submit" 
                                class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-[#2E8B3D] to-[#257332] hover:from-[#257332] hover:to-[#1e5e29] text-white font-bold text-sm shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center space-x-2 cursor-pointer">
                            <span>Sign in to Dashboard</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </button>
                    </div>

                </form>

            </div>

            {{-- Footer Note --}}
            <div class="bg-slate-50 px-8 py-3.5 border-t border-slate-100 text-center">
                <p class="text-[11px] text-slate-400">
                    Arunachal Gas Private Limited &copy; {{ date('Y') }} &middot; Authorized Access Only
                </p>
            </div>

        </div>

    </div>

</body>
</html>
