/**
 * Arunachal Gas - Admin Key Milestones Manager
 * Handles create, edit, icon preview, status toggle, and delete actions via Alpine.js & SweetAlert2
 */
import Swal from 'sweetalert2';

export function milestoneManager(config = {}) {
    try {
        const storeUrl = (config && config.storeUrl) || '/admin/milestones';
        const baseUrl = (config && config.baseUrl) || '/admin/milestones';
        const nextOrder = Math.max(1, ((config && config.totalCount) || 0) + 1);

        return {
            drawerOpen: false,
            drawerMode: 'create', // 'create' | 'edit'
            formAction: storeUrl,
            customIconPreview: null,
            isSubmitting: false,
            form: {
                period: '',
                title: '',
                icon: 'document',
                is_highlighted: false,
                order: 1,
                is_active: true,
            },

            openCreateDrawer() {
                try {
                    this.drawerMode = 'create';
                    this.formAction = storeUrl;
                    this.customIconPreview = null;
                    this.form = {
                        period: '',
                        title: '',
                        icon: 'document',
                        is_highlighted: false,
                        order: nextOrder,
                        is_active: true,
                    };
                    this.drawerOpen = true;
                } catch (error) {
                    console.error('[milestoneManager] Error opening create drawer:', error);
                }
            },

            openEditDrawer(milestone, customIconUrl) {
                try {
                    this.drawerMode = 'edit';
                    this.formAction = baseUrl + '/' + ((milestone && milestone.id) ? milestone.id : '');
                    this.customIconPreview = customIconUrl || (milestone && milestone.custom_icon_url) || null;

                    this.form = {
                        period: (milestone && milestone.period) || '',
                        title: (milestone && milestone.title) || '',
                        icon: (milestone && milestone.icon) || 'document',
                        is_highlighted: milestone ? (milestone.is_highlighted == 1 || milestone.is_highlighted === true) : false,
                        order: (milestone && milestone.order) || 1,
                        is_active: milestone ? (milestone.is_active == 1 || milestone.is_active === true) : true,
                    };
                    this.drawerOpen = true;
                } catch (error) {
                    console.error('[milestoneManager] Error opening edit drawer:', error);
                }
            },

            closeDrawer() {
                try {
                    this.drawerOpen = false;
                } catch (error) {
                    console.error('[milestoneManager] Error closing drawer:', error);
                }
            },

            handleCustomIconChange(e) {
                try {
                    const file = e && e.target && e.target.files && e.target.files[0];
                    if (file) {
                        this.customIconPreview = URL.createObjectURL(file);
                    }
                } catch (error) {
                    console.error('[milestoneManager] Error handling custom icon preview:', error);
                }
            },

            async submitForm(event) {
                if (this.isSubmitting) return;

                try {
                    const formEl = event && event.target;
                    if (!formEl) return;

                    if (!formEl.checkValidity()) {
                        formEl.reportValidity();
                        return;
                    }

                    const isEdit = this.drawerMode === 'edit';
                    const actionTitle = isEdit ? 'Save Changes?' : 'Add Key Milestone?';
                    const actionText = isEdit 
                        ? 'Are you sure you want to update this milestone event on the timeline?' 
                        : 'Are you sure you want to add this new milestone to the timeline track?';

                    const confirmResult = await Swal.fire({
                        title: actionTitle,
                        text: actionText,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#2E8B3D',
                        cancelButtonColor: '#64748B',
                        confirmButtonText: isEdit ? 'Yes, Save Changes' : 'Yes, Add Milestone',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true,
                        customClass: {
                            popup: 'rounded-2xl',
                            confirmButton: 'rounded-xl px-5 py-2.5 font-bold text-sm',
                            cancelButton: 'rounded-xl px-5 py-2.5 font-bold text-sm'
                        }
                    });

                    if (!confirmResult.isConfirmed) {
                        return;
                    }

                    Swal.fire({
                        title: 'Saving...',
                        text: 'Please wait while we save milestone details.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    this.isSubmitting = true;
                    const formData = new FormData(formEl);
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                    const response = await fetch(this.formAction, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                        }
                    });

                    const data = await response.json().catch(() => null);
                    this.isSubmitting = false;

                    if (response.ok && data && data.success !== false) {
                        await Swal.fire({
                            icon: 'success',
                            title: 'Saved Successfully!',
                            text: data.message || 'Milestone saved successfully.',
                            timer: 1800,
                            showConfirmButton: false,
                            customClass: { popup: 'rounded-2xl' }
                        });

                        this.closeDrawer();
                        window.location.reload();
                    } else {
                        let errorMessage = (data && data.message) || 'Failed to save milestone. Please check the inputs.';
                        if (data && data.errors) {
                            const errorList = Object.values(data.errors).flat().join('<br>');
                            if (errorList) {
                                errorMessage = errorList;
                            }
                        }

                        await Swal.fire({
                            icon: 'error',
                            title: 'Save Failed',
                            html: errorMessage,
                            confirmButtonColor: '#2E8B3D',
                            customClass: { popup: 'rounded-2xl' }
                        });
                    }
                } catch (error) {
                    this.isSubmitting = false;
                    console.error('[milestoneManager] submitForm error:', error);
                    await Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: (error && error.message) || 'An unexpected network error occurred while saving.',
                        confirmButtonColor: '#2E8B3D',
                        customClass: { popup: 'rounded-2xl' }
                    });
                }
            },

            async toggleStatus(id, toggleUrl) {
                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                    const response = await fetch(toggleUrl || `${baseUrl}/${id}/toggle`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                        },
                    });

                    const result = await response.json().catch(() => null);

                    if (response.ok && result && result.success !== false) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            customClass: { popup: 'rounded-2xl' }
                        });
                        Toast.fire({
                            icon: 'success',
                            title: result.message || 'Milestone status updated.',
                        });
                    } else {
                        throw new Error((result && result.message) || 'Status update failed.');
                    }
                } catch (error) {
                    console.error('[milestoneManager] Error toggling status:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Could not toggle milestone status.',
                        confirmButtonColor: '#2E8B3D',
                        customClass: { popup: 'rounded-2xl' }
                    });
                }
            },

            async deleteMilestone(id, deleteUrl, title) {
                try {
                    const confirmResult = await Swal.fire({
                        title: 'Delete Milestone?',
                        text: `Are you sure you want to remove "${title || 'this milestone'}" from the timeline? This action cannot be undone.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#DC2626',
                        cancelButtonColor: '#64748B',
                        confirmButtonText: 'Yes, Delete',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true,
                        customClass: {
                            popup: 'rounded-2xl',
                            confirmButton: 'rounded-xl px-5 py-2.5 font-bold text-sm',
                            cancelButton: 'rounded-xl px-5 py-2.5 font-bold text-sm'
                        }
                    });

                    if (!confirmResult.isConfirmed) return;

                    Swal.fire({
                        title: 'Deleting...',
                        text: 'Removing milestone from timeline...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                    const response = await fetch(deleteUrl || `${baseUrl}/${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                        },
                        body: JSON.stringify({
                            _method: 'DELETE'
                        })
                    });

                    const result = await response.json().catch(() => null);

                    if (response.ok && result && result.success !== false) {
                        await Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: result.message || 'Milestone deleted successfully.',
                            timer: 1800,
                            showConfirmButton: false,
                            customClass: { popup: 'rounded-2xl' }
                        });
                        window.location.reload();
                    } else {
                        throw new Error((result && result.message) || 'Failed to delete milestone.');
                    }
                } catch (error) {
                    console.error('[milestoneManager] Error deleting milestone:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Delete Failed',
                        text: error.message || 'An error occurred while deleting.',
                        confirmButtonColor: '#2E8B3D',
                        customClass: { popup: 'rounded-2xl' }
                    });
                }
            },
        };
    } catch (criticalError) {
        console.error('[milestoneManager] Critical initialization failure:', criticalError);
        return {};
    }
}
