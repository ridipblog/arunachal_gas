/**
 * Arunachal Gas - Admin Capturing Our Journey Manager
 * Handles create, edit, image preview, and delete actions via Alpine.js & SweetAlert2
 */
import Swal from 'sweetalert2';

export function journeyManager(config = {}) {
    try {
        const storeUrl = (config && config.storeUrl) || '/admin/journey-cards';
        const baseUrl = (config && config.baseUrl) || '/admin/journey-cards';
        const nextOrder = Math.min(5, ((config && config.totalCount) || 0) + 1);

        return {
            drawerOpen: false,
            drawerMode: 'create', // 'create' | 'edit'
            formAction: storeUrl,
            imagePreview: null,
            isSubmitting: false,
            form: {
                title: '',
                description: '',
                order: 1,
                image_alt: '',
                link_url: '',
                is_active: true,
            },

            openCreateDrawer() {
                try {
                    this.drawerMode = 'create';
                    this.formAction = storeUrl;
                    this.imagePreview = null;
                    this.form = {
                        title: '',
                        description: '',
                        order: nextOrder,
                        image_alt: '',
                        link_url: '',
                        is_active: true,
                    };
                    this.drawerOpen = true;
                } catch (error) {
                    console.error('[journeyManager] Error opening create drawer:', error);
                }
            },

            openEditDrawer(card, imageUrl) {
                try {
                    this.drawerMode = 'edit';
                    this.formAction = baseUrl + '/' + ((card && card.id) ? card.id : '');
                    this.imagePreview = imageUrl || (card && card.image_url) || null;

                    this.form = {
                        title: (card && card.title) || '',
                        description: (card && card.description) || '',
                        order: (card && card.order) || 1,
                        image_alt: (card && card.image_alt) || '',
                        link_url: (card && card.link_url) || '',
                        is_active: card ? (card.is_active == 1 || card.is_active === true) : true,
                    };
                    this.drawerOpen = true;
                } catch (error) {
                    console.error('[journeyManager] Error opening edit drawer:', error);
                }
            },

            closeDrawer() {
                try {
                    this.drawerOpen = false;
                } catch (error) {
                    console.error('[journeyManager] Error closing drawer:', error);
                }
            },

            handleImageChange(e) {
                try {
                    const file = e && e.target && e.target.files && e.target.files[0];
                    if (file) {
                        this.imagePreview = URL.createObjectURL(file);
                    }
                } catch (error) {
                    console.error('[journeyManager] Error loading image preview:', error);
                }
            },

            async confirmDelete(action, title) {
                try {
                    const result = await Swal.fire({
                        title: 'Delete Journey Card?',
                        text: `Are you sure you want to delete "${title || 'this card'}"? This action cannot be undone.`,
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
                        text: 'Removing card from showcase...',
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
                            text: data.message || 'Journey card deleted successfully.',
                            timer: 1800,
                            showConfirmButton: false,
                            customClass: { popup: 'rounded-2xl' }
                        });

                        window.location.reload();
                    } else {
                        await Swal.fire({
                            icon: 'error',
                            title: 'Delete Failed',
                            text: (data && data.message) || 'Failed to delete card. Please try again.',
                            confirmButtonColor: '#2E8B3D',
                            customClass: { popup: 'rounded-2xl' }
                        });
                    }
                } catch (error) {
                    console.error('[journeyManager] confirmDelete error:', error);
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
                    const actionTitle = isEdit ? 'Save Changes?' : 'Add Journey Card?';
                    const actionText = isEdit 
                        ? 'Are you sure you want to update this journey card?' 
                        : 'Are you sure you want to add this card to the showcase?';

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
                        text: 'Please wait while we upload the photo and save details.',
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
                            text: data.message || 'Journey card saved successfully.',
                            timer: 1800,
                            showConfirmButton: false,
                            customClass: { popup: 'rounded-2xl' }
                        });

                        this.closeDrawer();
                        window.location.reload();
                    } else {
                        let errorMessage = (data && data.message) || 'Failed to save card. Please check the inputs.';
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
                    console.error('[journeyManager] submitForm error:', error);
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
        console.error('[journeyManager] Fatal initialization error:', err);
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
    window.journeyManager = journeyManager;
    if (window.Alpine) {
        window.Alpine.data('journeyManager', journeyManager);
    }
}

export default journeyManager;
