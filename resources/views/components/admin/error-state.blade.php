@props([
    'title' => null,
    'message' => null,
    'details' => null,
    'retryUrl' => null,
    'actionText' => 'Refresh Page',
    'showDashboardLink' => true,
    'compact' => false,
])

@php
    use Illuminate\Support\Str;

    $finalRetryUrl = $retryUrl ?? request()?->fullUrl() ?? url('/admin');

    // Smart detection: check if $message is actually a raw database / PHP exception string
    $rawMessage = $message ?? '';
    $isTechnical = Str::contains($rawMessage, [
        'SQLSTATE', 'Exception', 'Error', 'Stack trace', 'Connection refused', 
        'Column not found', 'Unknown column', 'Syntax error', 'Table', 'Illuminate\\'
    ]);

    $displayTitle = $title ?? 'Something went wrong';
    
    // Human-readable friendly message
    if (!empty($rawMessage) && !$isTechnical) {
        $displayMessage = $rawMessage;
    } else {
        $displayMessage = 'We encountered an unexpected issue while retrieving data from the server. No data was lost. Please try refreshing the page.';
    }

    // Capture technical details for the extend button
    $technicalDetails = $details ?? ($isTechnical ? $rawMessage : null);
@endphp

@if ($compact)
    {{-- Sleek Compact Banner --}}
    <div {{ $attributes->merge(['class' => 'rounded-2xl border border-rose-200/80 bg-rose-50/90 p-4 text-slate-800 shadow-2xs flex items-center justify-between gap-4']) }} role="alert">
        <div class="flex items-center space-x-3 min-w-0">
            <div class="w-8 h-8 rounded-xl bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                </svg>
            </div>
            <div class="min-w-0">
                <h4 class="text-xs font-bold text-red-900 truncate">{{ $displayTitle }}</h4>
                <p class="text-xs text-slate-600 mt-0.5 line-clamp-1">{{ $displayMessage }}</p>
            </div>
        </div>
        <a href="{{ $finalRetryUrl }}" 
           class="shrink-0 px-3.5 py-1.5 rounded-xl bg-red-600 hover:bg-red-700 text-white text-xs font-bold transition-all shadow-2xs cursor-pointer">
            {{ $actionText ?? 'Retry' }}
        </a>
    </div>
@else
    {{-- Modern Cool Error Card --}}
    <div {{ $attributes->merge(['class' => 'relative max-w-xl mx-auto my-10 bg-white rounded-3xl border border-slate-200/90 shadow-xl shadow-slate-200/60 p-8 sm:p-10 text-center overflow-hidden']) }}
         x-data="{ showDetails: false, copied: false }">
        
        {{-- Top Accent Gradient Bar --}}
        <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-red-500 via-rose-500 to-amber-500"></div>

        {{-- Glowing Icon Badge --}}
        <div class="relative w-16 h-16 mx-auto mb-5">
            <div class="absolute inset-0 rounded-2xl bg-red-400/20 blur-md animate-pulse"></div>
            <div class="relative w-16 h-16 rounded-2xl bg-gradient-to-br from-red-50 to-rose-100 border border-red-200/80 text-red-600 flex items-center justify-center shadow-xs">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                </svg>
            </div>
        </div>

        {{-- Heading & Human-Readable Friendly Message --}}
        <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">
            {{ $displayTitle }}
        </h3>
        <p class="text-xs sm:text-sm text-slate-600 mt-2 max-w-md mx-auto leading-relaxed">
            {{ $displayMessage }}
        </p>

        {{-- Action Buttons --}}
        <div class="flex flex-wrap items-center justify-center gap-3 mt-6">
            <a href="{{ $finalRetryUrl }}" 
               class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-[#2E8B3D] hover:bg-[#257332] text-white text-xs sm:text-sm font-bold shadow-md hover:shadow-lg transition-all cursor-pointer">
                <svg class="w-4 h-4 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
                </svg>
                <span>{{ $actionText ?? 'Refresh Page' }}</span>
            </a>

            @if ($showDashboardLink)
                <a href="{{ route('admin.dashboard') }}" 
                   class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl border border-slate-200 hover:border-slate-300 bg-white hover:bg-slate-50 text-slate-700 text-xs sm:text-sm font-bold transition-all">
                    <span>Back to Dashboard</span>
                    <span>&rarr;</span>
                </a>
            @endif
        </div>

        {{-- Expandable Technical Error Section --}}
        @if (!empty($technicalDetails))
            <div class="mt-6 pt-5 border-t border-slate-100">
                <button type="button" 
                        @click="showDetails = !showDetails" 
                        class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full text-xs font-semibold text-slate-500 hover:text-slate-800 bg-slate-100 hover:bg-slate-200/80 transition-all cursor-pointer">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                    <span x-text="showDetails ? 'Hide Error Details' : 'View Technical Error'"></span>
                    <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="showDetails ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="showDetails" 
                     x-cloak 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="mt-4 rounded-2xl bg-slate-950 border border-slate-800 text-left overflow-hidden shadow-2xl">
                    
                    {{-- Console Header Bar --}}
                    <div class="px-4 py-2.5 bg-slate-900/90 border-b border-slate-800/80 flex items-center justify-between text-xs text-slate-400">
                        <div class="flex items-center space-x-2">
                            <div class="flex space-x-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-red-500/80"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500/80"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-green-500/80"></span>
                            </div>
                            <span class="text-[11px] font-mono text-slate-400 pl-2">exception.log</span>
                        </div>
                        <button type="button" 
                                @click="navigator.clipboard.writeText($refs.errCode.innerText); copied = true; setTimeout(() => copied = false, 2000)"
                                class="text-[11px] font-mono text-slate-400 hover:text-white px-2.5 py-0.5 rounded-md hover:bg-slate-800 transition-colors flex items-center space-x-1 cursor-pointer">
                            <span x-text="copied ? '✓ Copied' : 'Copy'"></span>
                        </button>
                    </div>

                    {{-- Console Error Body --}}
                    <div class="p-4 max-h-48 overflow-y-auto font-mono text-[11px] text-rose-300 leading-relaxed select-all">
                        <pre x-ref="errCode" class="whitespace-pre-wrap break-all">{{ $technicalDetails }}</pre>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endif
