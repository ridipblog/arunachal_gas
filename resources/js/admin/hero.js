/**
 * Arunachal Gas - Admin Hero Slider Manager
 * Handles create, edit, image preview and delete actions via Alpine.js & SweetAlert2
 */
import Swal from 'sweetalert2';

export function heroManager(config = {}) {
    try {
        const storeUrl = (config && config.storeUrl) || '/admin/hero-slides';
        const baseUrl = (config && config.baseUrl) || '/admin/hero-slides';
        const nextOrder = ((config && config.totalCount) || 0) + 1;

        return {
            drawerOpen: false,
            drawerMode: 'create', // 'create' | 'edit'
            formAction: storeUrl,
            imagePreview: null,
            isSubmitting: false,
            form: {
                order: 1,
                is_active: true,
            },

            openCreateDrawer() {
                try {
                    this.drawerMode = 'create';
                    this.formAction = storeUrl;
                    this.imagePreview = null;
                    this.form = {
                        order: nextOrder,
                        is_active: true,
                    };
                    this.drawerOpen = true;
                } catch (error) {
                    console.error('[heroManager] Error opening create drawer:', error);
                }
            },

            openEditDrawer(slide, imageUrl) {
                try {
                    this.drawerMode = 'edit';
                    this.formAction = baseUrl + '/' + ((slide && slide.id) ? slide.id : '');
                    this.imagePreview = imageUrl || (slide && slide.image_url) || null;

                    this.form = {
                        order: (slide && slide.order) || 1,
                        is_active: slide ? (slide.is_active == 1 || slide.is_active === true) : true,
                    };
                    this.drawerOpen = true;
                } catch (error) {
                    console.error('[heroManager] Error opening edit drawer:', error);
                }
            },

            closeDrawer() {
                try {
                    this.drawerOpen = false;
                } catch (error) {
                    console.error('[heroManager] Error closing drawer:', error);
                }
            },

            handleImageChange(e) {
                try {
                    const file = e && e.target && e.target.files && e.target.files[0];
                    if (file) {
                        this.imagePreview = URL.createObjectURL(file);
                    }
                } catch (error) {
                    console.error('[heroManager] Error loading image preview:', error);
                }
            },

            async confirmDelete(action, title) {
                try {
                    const result = await Swal.fire({
                        title: 'Delete Hero Slide?',
                        text: `Are you sure you want to delete "${title || 'this slide'}"? This action cannot be undone.`,
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
                        text: 'Removing slide from database...',
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
                            text: data.message || 'Hero slide deleted successfully.',
                            timer: 1800,
                            showConfirmButton: false,
                            customClass: { popup: 'rounded-2xl' }
                        });

                        window.location.reload();
                    } else {
                        await Swal.fire({
                            icon: 'error',
                            title: 'Delete Failed',
                            text: (data && data.message) || 'Failed to delete slide. Please try again.',
                            confirmButtonColor: '#2E8B3D',
                            customClass: { popup: 'rounded-2xl' }
                        });
                    }
                } catch (error) {
                    console.error('[heroManager] confirmDelete error:', error);
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
                    const actionTitle = isEdit ? 'Save Changes?' : 'Add New Slide?';
                    const actionText = isEdit 
                        ? 'Are you sure you want to update this hero slide?' 
                        : 'Are you sure you want to publish this new hero slide?';

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
                        text: 'Please wait while we save the hero slide details.',
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
                            text: data.message || 'Hero slide saved successfully.',
                            timer: 1800,
                            showConfirmButton: false,
                            customClass: { popup: 'rounded-2xl' }
                        });

                        this.closeDrawer();
                        window.location.reload();
                    } else {
                        let errorMessage = (data && data.message) || 'Failed to save slide. Please check the inputs.';
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
                    console.error('[heroManager] submitForm error:', error);
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
        console.error('[heroManager] Fatal initialization error:', err);
        return {
            drawerOpen: false,
            openCreateDrawer() {},
            openEditDrawer() {},
            closeDrawer() {},
            handleImageChange() {},
            confirmDelete() {},
            submitForm() {},
        };
    }
}

// Attach globally for Alpine.js in browser
if (typeof window !== 'undefined') {
    window.heroManager = heroManager;
    if (window.Alpine) {
        window.Alpine.data('heroManager', heroManager);
    }
}

export default heroManager;
