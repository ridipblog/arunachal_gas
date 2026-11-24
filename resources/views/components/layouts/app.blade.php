<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    @include('partials.head')
</head>
<body class="bg-white text-agpl-charcoal font-sans antialiased selection:bg-agpl-green selection:text-white" x-data="fontScaler">

    {{-- Reusable Header (Top Utility Bar & Brand Lockup) --}}
    <x-header />

    {{-- Reusable Ribbon Navbar with Dropdowns --}}
    <x-navbar />

    {{-- Page Body / Slot --}}
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    {{-- Reusable Cultural Mountain Footer --}}
    <x-footer />

    @include('partials.scripts')
</body>
</html>
