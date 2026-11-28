/**
 * Arunachal Gas - Admin News, Events & Notices Manager
 * Handles create, edit, icon preview, and delete actions via Alpine.js & SweetAlert2
 */
import Swal from 'sweetalert2';

export function noticeManager(config = {}) {
    try {
        const storeUrl = (config && config.storeUrl) || '/admin/notices';
        const baseUrl = (config && config.baseUrl) || '/admin/notices';
        const nextOrder = ((config && config.totalCount) || 0) + 1;

        return {
            drawerOpen: false,
            drawerMode: 'create', // 'create' | 'edit'
            formAction: storeUrl,
            iconPreview: null,
            isSubmitting: false,
            form: {
                title: '',
                description: '',
                type: 'notice',
                badge: 'NEW',
                date_text: '',
                link_url: '',
                order: 1,
                is_active: true,
            },

            openCreateDrawer() {
                try {
                    this.drawerMode = 'create';
                    this.formAction = storeUrl;
                    this.iconPreview = null;
                    this.form = {
                        title: '',
                        description: '',
                        type: 'notice',
                        badge: 'NEW',
                        date_text: '',
                        link_url: '',
                        order: nextOrder,
                        is_active: true,
                    };
                    this.drawerOpen = true;
                } catch (error) {
                    console.error('[noticeManager] Error opening create drawer:', error);
                }
            },

            openEditDrawer(notice, iconUrl) {
                try {
                    this.drawerMode = 'edit';
                    this.formAction = baseUrl + '/' + ((notice && notice.id) ? notice.id : '');
                    this.iconPreview = iconUrl || (notice && notice.icon_url) || null;

                    this.form = {
                        title: (notice && notice.title) || '',
                        description: (notice && notice.description) || '',
                        type: (notice && (notice.type?.value || notice.type)) || 'notice',
                        badge: (notice && (notice.badge?.value || notice.badge)) || '',
                        date_text: (notice && notice.date_text) || '',
                        link_url: (notice && notice.link_url) || '',
                        order: (notice && notice.order) || 1,
                        is_active: notice ? (notice.is_active == 1 || notice.is_active === true) : true,
                    };
                    this.drawerOpen = true;
                } catch (error) {
                    console.error('[noticeManager] Error opening edit drawer:', error);
                }
            },

            closeDrawer() {
                try {
                    this.drawerOpen = false;
                } catch (error) {
                    console.error('[noticeManager] Error closing drawer:', error);
                }
            },

            handleIconChange(e) {
                try {
                    const file = e && e.target && e.target.files && e.target.files[0];
                    if (file) {
                        this.iconPreview = URL.createObjectURL(file);
                    }
                } catch (error) {
                    console.error('[noticeManager] Error loading icon preview:', error);
                }
            },

            async confirmDelete(action, title) {
                try {
                    const result = await Swal.fire({
                        title: 'Delete Notice?',
                        text: `Are you sure you want to delete "${title || 'this notice'}"? This action cannot be undone.`,
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

                    if (!result.isConfirmed) {
                        return;
                    }

                    Swal.fire({
                        title: 'Deleting...',
                        text: 'Removing notice from database...',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                    const response = await fetch(action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                        },
                        body: JSON.stringify({
                            _method: 'DELETE'
                        })
                    });

                    const data = await response.json().catch(() => null);

                    if (response.ok && data && data.success !== false) {
                        await Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: data.message || 'Notice deleted successfully.',
                            timer: 1800,
                            showConfirmButton: false,
                            customClass: { popup: 'rounded-2xl' }
                        });

                        window.location.reload();
                    } else {
                        await Swal.fire({
                            icon: 'error',
                            title: 'Delete Failed',
                            text: (data && data.message) || 'Failed to delete notice. Please try again.',
                            confirmButtonColor: '#2E8B3D',
                            customClass: { popup: 'rounded-2xl' }
                        });
                    }
                } catch (error) {
                    console.error('[noticeManager] confirmDelete error:', error);
                    await Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: (error && error.message) || 'An unexpected error occurred while deleting.',
                        confirmButtonColor: '#2E8B3D',
                        customClass: { popup: 'rounded-2xl' }
                    });
                }
            },

            async submitForm(event) {
                try {
                    const formEl = event && event.target;
                    if (!formEl) return;

                    if (!formEl.checkValidity()) {
                        formEl.reportValidity();
                        return;
                    }

                    const isEdit = this.drawerMode === 'edit';
                    const actionTitle = isEdit ? 'Save Changes?' : 'Publish Notice?';
                    const actionText = isEdit 
                        ? 'Are you sure you want to update this notice details?' 
                        : 'Are you sure you want to publish this new announcement?';

                    const confirmResult = await Swal.fire({
                        title: actionTitle,
                        text: actionText,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#2E8B3D',
                        cancelButtonColor: '#64748B',
                        confirmButtonText: 'Yes, Save Changes',
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
                        text: 'Please wait while we save the notice details.',
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
                            text: data.message || 'Notice saved successfully.',
                            timer: 1800,
                            showConfirmButton: false,
                            customClass: { popup: 'rounded-2xl' }
                        });

                        this.closeDrawer();
                        window.location.reload();
                    } else {
                        let errorMessage = (data && data.message) || 'Failed to save notice. Please check the inputs.';
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
                    console.error('[noticeManager] submitForm error:', error);
                    await Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: (error && error.message) || 'An unexpected error occurred while saving.',
                        confirmButtonColor: '#2E8B3D',
                        customClass: { popup: 'rounded-2xl' }
                    });
                }
            }
        };
    } catch (err) {
        console.error('[noticeManager] Fatal initialization error:', err);
        return {
            drawerOpen: false,
            openCreateDrawer() {},
            openEditDrawer() {},
            closeDrawer() {},
            handleIconChange() {},
            confirmDelete() {},
            submitForm() {},
        };
    }
}

// Attach globally for Alpine.js in browser
if (typeof window !== 'undefined') {
    window.noticeManager = noticeManager;
    if (window.Alpine) {
        window.Alpine.data('noticeManager', noticeManager);
    }
}

export default noticeManager;
