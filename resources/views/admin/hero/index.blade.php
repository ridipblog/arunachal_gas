@extends('layouts.admin')

@section('page_title', 'Hero Slider')
@section('page_subtitle', 'Manage the full-width carousel slides and cover photos displayed on the homepage')

@section('content')
@if (!empty($error))
    <x-admin.error 
        title="Failed to Load Hero Slides" 
        :message="$error" 
        :details="$errorDetails ?? null" 
    />
@else
<div x-data="heroManager({
    storeUrl: '{{ route('admin.hero-slides.store') }}',
    baseUrl: '{{ url('admin/hero-slides') }}',
    totalCount: {{ $slides?->count() ?? 0 }}
})" class="space-y-6">

    {{-- Top Action Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl shadow-xs border border-slate-200/80">
        <div>
            <h2 class="text-base sm:text-lg font-bold text-slate-900">
                Active Homepage Slides
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Total {{ $slides?->count() ?? 0 }} slides configured in the full-screen hero carousel.
            </p>
        </div>
        <button type="button" 
                @click="openCreateDrawer()"
                class="inline-flex items-center justify-center space-x-2 px-5 py-2.5 rounded-xl bg-[#2E8B3D] hover:bg-[#257332] text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer">
            <svg class="w-4 h-4 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            <span>Add New Slide</span>
        </button>
    </div>

    {{-- Hero Slides Table --}}
    <div class="bg-white rounded-2xl shadow-xs border border-slate-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-4 sm:px-6 w-16">#</th>
                        <th class="py-3.5 px-4">Slide Image</th>
                        <th class="py-3.5 px-4 text-center w-28">Status</th>
                        <th class="py-3.5 px-4 sm:px-6 text-right w-36">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse (($slides ?? []) as $slide)
                        <tr class="hover:bg-slate-50/60 transition-colors group">
                            {{-- Order --}}
                            <td class="py-4 px-4 sm:px-6 font-bold text-slate-400 text-xs">
                                {{ $slide?->order ?? 0 }}
                            </td>

                            {{-- Image Thumbnail --}}
                            <td class="py-4 px-4">
                                <div class="w-48 sm:w-60 h-24 rounded-xl overflow-hidden bg-slate-100 border border-slate-200 shadow-2xs shrink-0 relative">
                                    <img src="{{ $slide?->image_url ?? asset('images/assets/Group 1000002719.png') }}" 
                                         alt="{{ $slide?->image_alt ?? $slide?->title ?? 'Hero Slide' }}" 
                                         class="w-full h-full object-cover">
                                </div>
                            </td>

                            {{-- Active Status Toggle --}}
                            <td class="py-4 px-4 text-center">
                                <form action="{{ $slide ? route('admin.hero-slides.toggle', $slide) : '#' }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            title="Click to toggle active status"
                                            class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-full text-xs font-bold transition-all cursor-pointer {{ ($slide?->is_active ?? false) ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ ($slide?->is_active ?? false) ? 'bg-green-600' : 'bg-slate-400' }}"></span>
                                        <span>{{ ($slide?->is_active ?? false) ? 'Active' : 'Draft' }}</span>
                                    </button>
                                </form>
                            </td>

                            {{-- Action Buttons --}}
                            <td class="py-4 px-4 sm:px-6 text-right space-x-1">
                                {{-- Edit Button (Opens Slide-over Drawer) --}}
                                <button type="button" 
                                        @click="openEditDrawer({{ json_encode($slide ?? (object)[]) }}, '{{ $slide?->image_url ?? '' }}')"
                                        class="p-2 rounded-lg text-slate-600 hover:text-[#2E8B3D] hover:bg-emerald-50 transition-colors cursor-pointer"
                                        title="Edit Slide">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                    </svg>
                                </button>

                                {{-- Delete Button --}}
                                <button type="button" 
                                        @click="confirmDelete('{{ $slide ? route('admin.hero-slides.destroy', $slide) : '#' }}', 'Slide #{{ $slide?->order ?? 1 }}')"
                                        class="p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors cursor-pointer"
                                        title="Delete Slide">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-slate-400 text-sm">
                                No hero slides found. Click "Add New Slide" above to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ───────────────────────────────────────────────────────────── --}}
    {{-- UNIFIED SLIDE-OVER DRAWER (Alpine.js)                        --}}
    {{-- ───────────────────────────────────────────────────────────── --}}
    <div x-show="drawerOpen" 
         x-cloak
         class="fixed inset-0 z-50 overflow-hidden" 
         style="display: none;">
        
        {{-- Backdrop --}}
        <div x-show="drawerOpen" 
             x-transition:enter="ease-in-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in-out duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="closeDrawer()"
             class="absolute inset-0 bg-slate-900/50 backdrop-blur-xs transition-opacity"></div>

        <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
            
            {{-- Slide-Over Panel --}}
            <div x-show="drawerOpen" 
                 x-transition:enter="transform transition ease-in-out duration-300 sm:duration-400"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transform transition ease-in-out duration-300 sm:duration-400"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 class="w-screen max-w-xl bg-white shadow-2xl flex flex-col justify-between">
                
                {{-- Drawer Header --}}
                <div class="px-6 py-5 bg-[#0A1E3B] text-white flex items-center justify-between border-b border-white/10">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#2E8B3D] block">
                            Homepage Hero Manager
                        </span>
                        <h3 class="text-lg font-extrabold text-white" x-text="drawerMode === 'create' ? 'Add New Hero Slide' : 'Edit Hero Slide (#' + (form.order || '') + ')'"></h3>
                    </div>
                    <button type="button" 
                            @click="closeDrawer()" 
                            class="text-slate-400 hover:text-white p-2 rounded-xl hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Drawer Form Body --}}
                <form :action="formAction" 
                      method="POST" 
                      enctype="multipart/form-data" 
                      @submit.prevent="submitForm($event)"
                      class="flex-1 overflow-y-auto p-6 space-y-5">
                    @csrf
                    <input type="hidden" name="_method" :value="drawerMode === 'edit' ? 'PUT' : 'POST'">

                    {{-- 1. Photo Uploader with Live Preview --}}
                    <div class="bg-slate-50/80 p-4 rounded-2xl border border-slate-200/80 space-y-3">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Hero Slide Photo <span x-show="drawerMode === 'create'" class="text-red-500">*</span>
                        </label>

                        <div class="space-y-3">
                            {{-- Image Preview Container --}}
                            <div class="w-full h-44 rounded-xl overflow-hidden bg-white border border-slate-200 shadow-xs relative">
                                <template x-if="imagePreview">
                                    <img :src="imagePreview" alt="Preview" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!imagePreview">
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 text-xs">
                                        <svg class="w-8 h-8 text-slate-300 mb-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                                        </svg>
                                        <span>No image selected</span>
                                    </div>
                                </template>
                            </div>

                            {{-- File Picker --}}
                            <label class="block">
                                <span class="sr-only">Choose image</span>
                                <input type="file" 
                                       name="image" 
                                       accept="image/png,image/jpeg,image/webp,image/svg+xml"
                                       @change="handleImageChange"
                                       :required="drawerMode === 'create'"
                                       class="block w-full text-xs text-slate-500
                                              file:mr-3 file:py-2 file:px-4
                                              file:rounded-xl file:border-0
                                              file:text-xs file:font-bold
                                              file:bg-[#0B5CAB] file:text-white
                                              hover:file:bg-[#094785] file:cursor-pointer cursor-pointer"/>
                            </label>
                            <p class="text-[11px] text-slate-400 leading-relaxed">
                                High-resolution photo recommended: 2141 &times; 928px (or 16:9 ratio). Max size: 5MB.
                            </p>
                        </div>
                    </div>

                    {{-- 4. Display Order & Published Status --}}
                    <div class="flex items-center justify-between pt-2 border-t border-slate-100">
                        <div class="flex items-center space-x-2">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                                Order:
                            </label>
                            <input type="number" 
                                   name="order" 
                                   x-model="form.order" 
                                   min="1"
                                   class="w-20 px-3 py-1.5 rounded-lg border border-slate-200 text-sm font-bold">
                        </div>

                        <label class="inline-flex items-center space-x-2 cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" 
                                   name="is_active" 
                                   value="1" 
                                   x-model="form.is_active" 
                                   class="w-4 h-4 rounded-md border-slate-300 text-[#2E8B3D] focus:ring-[#2E8B3D]/30">
                            <span class="text-xs font-bold text-slate-700">Published / Active</span>
                        </label>
                    </div>

                    {{-- Drawer Footer Actions --}}
                    <div class="pt-5 border-t border-slate-200 flex items-center justify-end space-x-3">
                        <button type="button" 
                                @click="closeDrawer()" 
                                class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                :disabled="isSubmitting"
                                class="px-6 py-2.5 rounded-xl bg-[#2E8B3D] hover:bg-[#257332] text-white font-bold text-xs shadow-md hover:shadow-lg transition-all flex items-center space-x-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                            <span x-text="isSubmitting ? 'Saving...' : 'Save Changes'"></span>
                            <span x-show="!isSubmitting">&rarr;</span>
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
@endif

@endsection
