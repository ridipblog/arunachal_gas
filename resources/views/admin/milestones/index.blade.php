@extends('layouts.admin')

@section('page_title', 'Key Milestones Timeline')
@section('page_subtitle', 'Manage the alternating horizontal and mobile vertical timeline of AGPL journey milestones on the website')

@section('content')
@if (!empty($error))
    <x-admin.error 
        title="Failed to Load Milestones" 
        :message="$error" 
        :details="$errorDetails ?? null" 
    />
@else
<div x-data="milestoneManager({
    storeUrl: '{{ route('admin.milestones.store') }}',
    baseUrl: '{{ url('admin/milestones') }}',
    totalCount: {{ $milestones?->count() ?? 0 }}
})" class="space-y-6">

    {{-- Top Action Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl shadow-xs border border-slate-200/80">
        <div>
            <h2 class="text-base sm:text-lg font-bold text-slate-900">
                Active Journey Milestones
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Total {{ $milestones?->count() ?? 0 }} milestones configured along the journey timeline track.
            </p>
        </div>
        <button type="button" 
                @click="openCreateDrawer()"
                class="inline-flex items-center justify-center space-x-2 px-5 py-2.5 rounded-xl bg-[#2E8B3D] hover:bg-[#257332] text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer">
            <svg class="w-4 h-4 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            <span>Add Milestone</span>
        </button>
    </div>

    {{-- Milestones Table --}}
    <div class="bg-white rounded-2xl shadow-xs border border-slate-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3.5 px-4 sm:px-6 w-16">#</th>
                        <th class="py-3.5 px-4 w-36">Period / Date</th>
                        <th class="py-3.5 px-4">Milestone Description</th>
                        <th class="py-3.5 px-4 w-36">Icon</th>
                        <th class="py-3.5 px-4 text-center w-28">Indicator</th>
                        <th class="py-3.5 px-4 text-center w-28">Status</th>
                        <th class="py-3.5 px-4 sm:px-6 text-right w-36">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse (($milestones ?? []) as $milestone)
                        <tr class="hover:bg-slate-50/60 transition-colors group">
                            {{-- Order / # --}}
                            <td class="py-4 px-4 sm:px-6 font-bold text-slate-400 text-xs">
                                <span class="w-7 h-7 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center font-extrabold text-slate-700">
                                    {{ $milestone?->order ?? $loop->iteration }}
                                </span>
                            </td>

                            {{-- Period / Date --}}
                            <td class="py-4 px-4 font-bold text-slate-900 text-xs sm:text-sm">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 text-[#0A1E3B] border border-slate-200 font-bold text-xs">
                                    {{ $milestone?->period ?? 'N/A' }}
                                </span>
                            </td>

                            {{-- Title / Event Description --}}
                            <td class="py-4 px-4">
                                <span class="font-bold text-slate-900 block leading-snug">
                                    {{ $milestone?->title ?? 'Untitled Milestone' }}
                                </span>
                            </td>

                            {{-- Icon Preview --}}
                            <td class="py-4 px-4">
                                <div class="inline-flex items-center space-x-2 px-2.5 py-1.5 rounded-lg bg-slate-50 border border-slate-200">
                                    <x-milestone-icon :icon="$milestone?->icon" :custom-url="$milestone?->custom_icon_url" class="w-4 h-4 text-[#16A34A]" />
                                    <span class="text-xs text-slate-600 capitalize font-medium">
                                        {{ $milestone?->icon }}
                                    </span>
                                </div>
                            </td>

                            {{-- Dot Indicator Style (Green vs Amber) --}}
                            <td class="py-4 px-4 text-center">
                                @if ($milestone?->is_highlighted)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-2 h-2 rounded-full bg-[#F59E0B] mr-1.5 ring-2 ring-amber-300"></span>
                                        Active / Amber
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-[#16A34A] border border-emerald-200">
                                        <span class="w-2 h-2 rounded-full bg-[#16A34A] mr-1.5"></span>
                                        Standard
                                    </span>
                                @endif
                            </td>

                            {{-- Active Status Toggle --}}
                            <td class="py-4 px-4 text-center">
                                <label class="relative inline-flex items-center cursor-pointer select-none">
                                    <input type="checkbox" 
                                           {{ $milestone?->is_active ? 'checked' : '' }}
                                           @change="toggleStatus({{ $milestone?->id }}, '{{ route('admin.milestones.toggle', $milestone?->id) }}')"
                                           class="sr-only peer">
                                    <div class="w-9 h-5 bg-slate-200 peer-focus:outline-hidden rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#2E8B3D]"></div>
                                </label>
                            </td>

                            {{-- Actions --}}
                            <td class="py-4 px-4 sm:px-6 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <button type="button" 
                                            @click="openEditDrawer({{ json_encode($milestone) }}, '{{ $milestone?->custom_icon_url }}')"
                                            class="p-2 rounded-lg text-slate-500 hover:text-[#0B5CAB] hover:bg-slate-100 transition-colors"
                                            title="Edit Milestone">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                        </svg>
                                    </button>
                                    <button type="button" 
                                            @click="deleteMilestone({{ $milestone?->id }}, '{{ route('admin.milestones.destroy', $milestone?->id) }}', '{{ addslashes($milestone?->title ?? '') }}')"
                                            class="p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors"
                                            title="Delete Milestone">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400 text-sm">
                                <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <p class="font-bold text-slate-700">No milestones found</p>
                                <p class="text-xs text-slate-400 mt-1">Click "Add Milestone" to create the first chronological point on the timeline.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Slide-over Drawer for Create & Edit --}}
    <div x-cloak 
         x-show="drawerOpen" 
         class="fixed inset-0 z-50 overflow-hidden" 
         aria-labelledby="slide-over-title" 
         role="dialog" 
         aria-modal="true">
        <div class="absolute inset-0 overflow-hidden">
            {{-- Backdrop --}}
            <div x-show="drawerOpen" 
                 x-transition:enter="ease-in-out duration-300" 
                 x-transition:enter-start="opacity-0" 
                 x-transition:enter-end="opacity-100" 
                 x-transition:leave="ease-in-out duration-300" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0" 
                 @click="closeDrawer()" 
                 class="absolute inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"></div>

            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div x-show="drawerOpen" 
                     x-transition:enter="transform transition ease-in-out duration-300" 
                     x-transition:enter-start="translate-x-full" 
                     x-transition:enter-end="translate-x-0" 
                     x-transition:leave="transform transition ease-in-out duration-300" 
                     x-transition:leave-start="translate-x-0" 
                     x-transition:leave-end="translate-x-full" 
                     class="pointer-events-auto w-screen max-w-md bg-white shadow-2xl flex flex-col">
                    
                    {{-- Drawer Header --}}
                    <div class="p-6 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                        <div>
                            <h3 class="text-base font-bold text-slate-900" id="slide-over-title">
                                <span x-text="drawerMode === 'create' ? 'Add New Milestone' : 'Edit Milestone'"></span>
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Chronological milestone event for the timeline track
                            </p>
                        </div>
                        <button type="button" 
                                @click="closeDrawer()" 
                                class="rounded-xl p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-200/60 transition-colors">
                            <span class="sr-only">Close</span>
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
                        <input type="hidden" name="order" :value="form.order">

                        {{-- 1. Period / Date --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Period / Date Label <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="period" 
                                   x-model="form.period" 
                                   required 
                                   placeholder="e.g. Dec 2023, Oct–Nov 2024, or 2025–26"
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-[#2E8B3D] focus:ring-2 focus:ring-[#2E8B3D]/20 outline-hidden text-sm font-semibold">
                            <p class="text-[11px] text-slate-400 mt-1">Short month &amp; year displayed in the milestone header badge.</p>
                        </div>

                        {{-- 2. Milestone Description / Event Title --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Milestone Event Headline <span class="text-red-500">*</span>
                            </label>
                            <textarea name="title" 
                                      x-model="form.title" 
                                      required 
                                      rows="3"
                                      placeholder="e.g. PNGRB grants CGD authorisation for GA-12.01 to BPCL–OIL Consortium"
                                      class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-[#2E8B3D] focus:ring-2 focus:ring-[#2E8B3D]/20 outline-hidden text-sm leading-relaxed"></textarea>
                        </div>

                        {{-- 3. Icon Preset Selector --}}
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Icon Theme Preset <span class="text-red-500">*</span>
                            </label>
                            <select name="icon" 
                                    x-model="form.icon" 
                                    required 
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-[#2E8B3D] focus:ring-2 focus:ring-[#2E8B3D]/20 outline-hidden text-sm bg-white font-medium">
                                <option value="document">Document / Board Approval (Dec 2023)</option>
                                <option value="gavel">Gavel / Authorisation (Apr 2024)</option>
                                <option value="handshake">Handshake / JVA Partnership (Oct–Nov 2024)</option>
                                <option value="verified">Verified Badge / MoPNG Concurrence (Jun 2025)</option>
                                <option value="users">Team / AGPL Incorporated (2025–26)</option>
                                <option value="megaphone">Megaphone / Stakeholder Outreach (Jun 2026)</option>
                                <option value="map-pin">Map Pin / Namsai District Engagement (Aug 2026)</option>
                                <option value="settings">Settings &amp; Cog / Management Review (Aug 2026)</option>
                            </select>
                        </div>

                        {{-- 4. Dot Highlight Indicator (Amber vs Green) --}}
                        <div class="bg-amber-50/60 p-4 rounded-2xl border border-amber-200/80 space-y-2">
                            <label class="flex items-start space-x-3 cursor-pointer">
                                <input type="checkbox" 
                                       name="is_highlighted" 
                                       value="1" 
                                       x-model="form.is_highlighted" 
                                       class="w-4 h-4 mt-0.5 rounded-md border-amber-300 text-amber-600 focus:ring-amber-500/30">
                                <div>
                                    <span class="text-xs font-bold text-amber-900 block">
                                        Highlight as Current / In-Progress Milestone
                                    </span>
                                    <span class="text-[11px] text-amber-700/80 block mt-0.5 leading-snug">
                                        Displays an amber glowing dot with ring indicator (like Milestone 8) instead of the standard green dot on the timeline track.
                                    </span>
                                </div>
                            </label>
                        </div>

                        {{-- 5. Custom Icon Upload (Optional) --}}
                        <div class="bg-slate-50/80 p-4 rounded-2xl border border-slate-200/80 space-y-3">
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                                Custom Icon / Logo (Optional)
                            </label>

                            <div class="space-y-3">
                                <template x-if="customIconPreview">
                                    <div class="w-16 h-16 rounded-xl overflow-hidden bg-white border border-slate-200 p-2 flex items-center justify-center shadow-xs">
                                        <img :src="customIconPreview" alt="Icon Preview" class="w-full h-full object-contain">
                                    </div>
                                </template>

                                <label class="block">
                                    <span class="sr-only">Choose icon</span>
                                    <input type="file" 
                                           name="custom_icon" 
                                           accept="image/png,image/jpeg,image/webp,image/svg+xml"
                                           @change="handleCustomIconChange"
                                           class="block w-full text-xs text-slate-500
                                                  file:mr-3 file:py-2 file:px-4
                                                  file:rounded-xl file:border-0
                                                  file:text-xs file:font-bold
                                                  file:bg-[#0B5CAB] file:text-white
                                                  hover:file:bg-[#094785] file:cursor-pointer cursor-pointer"/>
                                </label>
                                <p class="text-[11px] text-slate-400">
                                    Leave blank to use the selected preset icon. Max size: 2MB.
                                </p>
                            </div>
                        </div>

                        {{-- 6. Published Status --}}
                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                                Milestone Visibility:
                            </span>

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
                                    class="px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer">
                                Cancel
                            </button>
                            <button type="submit" 
                                    :disabled="isSubmitting"
                                    class="inline-flex items-center space-x-2 px-6 py-2.5 rounded-xl bg-[#2E8B3D] hover:bg-[#257332] text-white text-xs font-bold shadow-md hover:shadow-lg transition-all disabled:opacity-50 cursor-pointer">
                                <span x-show="!isSubmitting" x-text="drawerMode === 'create' ? 'Create Milestone' : 'Save Changes'"></span>
                                <span x-show="isSubmitting">Saving...</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endif
@endsection
