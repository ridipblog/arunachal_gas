@extends('layouts.admin')

@section('page_title', 'News, Events & Notices')
@section('page_subtitle', 'Manage announcement cards, compliance updates, safety circulars and event schedules on the homepage')

@section('content')
@if (!empty($error))
    <x-admin.error 
        title="Failed to Load Notices" 
        :message="$error" 
        :details="$errorDetails ?? null" 
    />
@else
<div x-data="noticeManager({
    storeUrl: '{{ route('admin.notices.store') }}',
    baseUrl: '{{ url('admin/notices') }}',
    totalCount: {{ $notices?->count() ?? 0 }}
})" class="space-y-6">

    {{-- Top Action Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl shadow-xs border border-slate-200/80">
        <div>
            <h2 class="text-base sm:text-lg font-bold text-slate-900">
                Active Notices &amp; Announcements
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Total {{ $notices?->count() ?? 0 }} announcements and schedules published in the homepage pipeline section.
            </p>
        </div>
        <button type="button" 
                @click="openCreateDrawer()"
                class="inline-flex items-center justify-center space-x-2 px-5 py-2.5 rounded-xl bg-[#2E8B3D] hover:bg-[#257332] text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer">
            <svg class="w-4 h-4 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            <span>Add New Notice</span>
        </button>
    </div>

    {{-- Notices Table --}}
    <div class="bg-white rounded-2xl shadow-xs border border-slate-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-4 sm:px-6 w-16">#</th>
                        <th class="py-3.5 px-4 w-20">Icon</th>
                        <th class="py-3.5 px-4">Title &amp; Summary</th>
                        <th class="py-3.5 px-4 w-44 hidden md:table-cell">Date &amp; Category</th>
                        <th class="py-3.5 px-4 text-center w-28">Badge</th>
                        <th class="py-3.5 px-4 text-center w-28">Status</th>
                        <th class="py-3.5 px-4 sm:px-6 text-right w-36">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse (($notices ?? []) as $notice)
                        <tr class="hover:bg-slate-50/60 transition-colors group">
                            {{-- Order --}}
                            <td class="py-4 px-4 sm:px-6 font-bold text-slate-400 text-xs">
                                {{ $notice?->order ?? 0 }}
                            </td>

                            {{-- Icon / Logo Preview --}}
                            <td class="py-4 px-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center p-1.5 shadow-2xs shrink-0">
                                    <img src="{{ $notice?->icon_url }}" 
                                         alt="{{ $notice?->title ?? 'Notice Icon' }}" 
                                         class="w-full h-full object-contain">
                                </div>
                            </td>

                            {{-- Title & Description --}}
                            <td class="py-4 px-4">
                                <span class="font-bold text-slate-900 block leading-snug">
                                    {{ $notice?->title ?? 'Untitled Notice' }}
                                </span>
                                <span class="text-xs text-slate-500 block mt-1 line-clamp-2 leading-relaxed">
                                    {{ $notice?->description ?? '' }}
                                </span>
                            </td>

                            {{-- Date & Category Type --}}
                            <td class="py-4 px-4 hidden md:table-cell">
                                <span class="text-xs font-semibold text-slate-700 block">
                                    {{ $notice?->date_text ?? 'No Date' }}
                                </span>
                                <span class="text-[11px] text-slate-400 block mt-0.5 font-medium">
                                    {{ $notice?->type?->label() ?? 'General' }}
                                </span>
                            </td>

                            {{-- Badge Tag --}}
                            <td class="py-4 px-4 text-center">
                                @if ($notice?->badge)
                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-extrabold tracking-wider border {{ $notice->badge->colorClasses() }}">
                                        {{ $notice->badge->value }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-300">&mdash;</span>
                                @endif
                            </td>

                            {{-- Active Status Toggle --}}
                            <td class="py-4 px-4 text-center">
                                <form action="{{ $notice ? route('admin.notices.toggle', $notice) : '#' }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            title="Click to toggle active status"
                                            class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-full text-xs font-bold transition-all cursor-pointer {{ ($notice?->is_active ?? false) ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ ($notice?->is_active ?? false) ? 'bg-green-600' : 'bg-slate-400' }}"></span>
                                        <span>{{ ($notice?->is_active ?? false) ? 'Active' : 'Draft' }}</span>
                                    </button>
                                </form>
                            </td>

                            {{-- Action Buttons --}}
                            <td class="py-4 px-4 sm:px-6 text-right space-x-1">
                                {{-- Edit Button (Opens Slide-over Drawer) --}}
                                <button type="button" 
                                        @click="openEditDrawer({{ json_encode($notice ?? (object)[]) }}, '{{ $notice?->icon_url ?? '' }}')"
                                        class="p-2 rounded-lg text-slate-600 hover:text-[#2E8B3D] hover:bg-emerald-50 transition-colors cursor-pointer"
                                        title="Edit Notice">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                    </svg>
                                </button>

                                {{-- Delete Button --}}
                                <button type="button" 
                                        @click="confirmDelete('{{ $notice ? route('admin.notices.destroy', $notice) : '#' }}', '{{ addslashes($notice?->title ?? '') }}')"
                                        class="p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors cursor-pointer"
                                        title="Delete Notice">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400 text-sm">
                                No notices or announcements found. Click "Add New Notice" above to publish one.
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
                            Homepage Pipeline Manager
                        </span>
                        <h3 class="text-lg font-extrabold text-white" x-text="drawerMode === 'create' ? 'Add New Notice / Event' : 'Edit Notice: ' + (form.title || 'Untitled')"></h3>
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

                    {{-- 1. Notice Title --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Notice Title / Event Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               x-model="form.title" 
                               required 
                               placeholder="e.g. Quarterly Safety Audit or Town Hall Meeting"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-[#2E8B3D] focus:ring-2 focus:ring-[#2E8B3D]/20 outline-hidden text-sm font-semibold">
                    </div>

                    {{-- 2. Short Summary / Description --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Summary Description <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" 
                                  x-model="form.description" 
                                  rows="3" 
                                  required 
                                  placeholder="Short 1-2 sentence overview for the card..."
                                  class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-[#2E8B3D] focus:ring-2 focus:ring-[#2E8B3D]/20 outline-hidden text-sm"></textarea>
                    </div>

                    {{-- 3. Category Type & Badge Tag (2 Columns) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Notice Type Enum --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Category Type <span class="text-red-500">*</span>
                            </label>
                            <select name="type" 
                                    x-model="form.type" 
                                    required 
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-[#2E8B3D] focus:ring-2 focus:ring-[#2E8B3D]/20 outline-hidden text-sm bg-white font-medium">
                                @foreach ($types as $type)
                                    <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Notice Badge Enum --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Highlight Badge
                            </label>
                            <select name="badge" 
                                    x-model="form.badge" 
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-[#2E8B3D] focus:ring-2 focus:ring-[#2E8B3D]/20 outline-hidden text-sm bg-white font-medium">
                                <option value="">-- No Badge --</option>
                                @foreach ($badges as $badge)
                                    <option value="{{ $badge->value }}">{{ $badge->value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 4. Date & Time String --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Display Date &amp; Time (Optional)
                        </label>
                        <input type="text" 
                               name="date_text" 
                               x-model="form.date_text" 
                               placeholder="e.g. 23 Oct 2026 - 10:00 AM (leave blank for current time)"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-[#2E8B3D] focus:ring-2 focus:ring-[#2E8B3D]/20 outline-hidden text-sm">
                        <p class="text-[11px] text-slate-400 mt-1">
                            Leave empty to automatically stamp with the current date &amp; time.
                        </p>
                    </div>

                    {{-- 5. Icon Uploader with Smart Fallback Preview --}}
                    <div class="bg-slate-50/80 p-4 rounded-2xl border border-slate-200/80 space-y-3">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Custom Icon / Logo (Optional)
                        </label>

                        <div class="flex items-center space-x-4">
                            {{-- Icon Preview Container --}}
                            <div class="w-16 h-16 rounded-xl bg-white border border-slate-200 shadow-xs flex items-center justify-center p-2 shrink-0">
                                <template x-if="iconPreview">
                                    <img :src="iconPreview" alt="Icon Preview" class="w-full h-full object-contain">
                                </template>
                                <template x-if="!iconPreview">
                                    <div class="text-[10px] text-slate-400 text-center font-bold">
                                        Default Icon
                                    </div>
                                </template>
                            </div>

                            <div class="flex-1 min-w-0">
                                <label class="block">
                                    <span class="sr-only">Choose icon</span>
                                    <input type="file" 
                                           name="icon" 
                                           accept="image/png,image/jpeg,image/webp,image/svg+xml"
                                           @change="handleIconChange"
                                           class="block w-full text-xs text-slate-500
                                                  file:mr-3 file:py-1.5 file:px-3
                                                  file:rounded-xl file:border-0
                                                  file:text-xs file:font-bold
                                                  file:bg-[#0B5CAB] file:text-white
                                                  hover:file:bg-[#094785] file:cursor-pointer cursor-pointer"/>
                                </label>
                                <p class="text-[11px] text-slate-400 mt-1 leading-snug">
                                    Square PNG / SVG recommended: 64 &times; 64px. If left blank, our system uses the matching category default icon!
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- 6. Optional URL Link --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            External Link / Download URL (Optional)
                        </label>
                        <input type="url" 
                               name="link_url" 
                               x-model="form.link_url" 
                               placeholder="https://... or internal portal link"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-[#2E8B3D] focus:ring-2 focus:ring-[#2E8B3D]/20 outline-hidden text-sm">
                    </div>

                    {{-- 7. Display Order & Published Status --}}
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
