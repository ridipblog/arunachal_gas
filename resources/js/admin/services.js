/**
 * Arunachal Gas - Admin Services Slide-Over Drawer Manager
 * Handles create, edit, image preview and delete modals via Alpine.js
 */
import Swal from 'sweetalert2';

export function serviceManager(config = {}) {
    try {
        const storeUrl = (config && config.storeUrl) || '/admin/services';
        const baseUrl = (config && config.baseUrl) || '/admin/services';
        const nextOrder = ((config && config.totalCount) || 0) + 1;

        return {
            drawerOpen: false,
            drawerMode: 'create', // 'create' | 'edit'
            formAction: storeUrl,
            imagePreview: null,
            isSubmitting: false,
            deleteModalOpen: false,
            deleteAction: '',
            deleteTitle: '',
            form: {
                number_label: '01/',
                title: '',
                card_heading: '',
                badges_str: '',
                description: '',
                button_text: 'Know More',
                button_url: '#contact',
                order: 1,
                is_active: true,
            },

            openCreateDrawer() {
                try {
                    this.drawerMode = 'create';
                    this.formAction = storeUrl;
                    this.imagePreview = null;
                    this.form = {
                        number_label: '0' + nextOrder + '/',
                        title: '',
                        card_heading: '',
                        badges_str: '',
                        description: '',
                        button_text: 'Know More',
                        button_url: '#contact',
                        order: nextOrder,
                        is_active: true,
                    };
                    this.drawerOpen = true;
                } catch (error) {
                    console.error('[serviceManager] Error opening create drawer:', error);
                }
            },

            openEditDrawer(service, imageUrl) {
                try {
                    this.drawerMode = 'edit';
                    this.formAction = baseUrl + '/' + ((service && service.id) ? service.id : '');
                    this.imagePreview = imageUrl || (service && service.image_url) || null;

                    // Format badges array to comma-separated string
                    let badgesStr = '';
                    if (service && Array.isArray(service.badges)) {
                        badgesStr = service.badges.join(', ');
                    } else if (service && typeof service.badges === 'string') {
                        badgesStr = service.badges;
                    }

                    this.form = {
                        number_label: (service && service.number_label) || '',
                        title: (service && service.title) || '',
                        card_heading: (service && service.card_heading) || '',
                        badges_str: badgesStr,
                        description: (service && service.description) || '',
                        button_text: (service && service.button_text) || 'Know More',
                        button_url: (service && service.button_url) || '#contact',
                        order: (service && service.order) || 1,
                        is_active: service ? (service.is_active == 1 || service.is_active === true) : true,
                    };
                    this.drawerOpen = true;
                } catch (error) {
                    console.error('[serviceManager] Error opening edit drawer:', error);
                }
            },

            closeDrawer() {
                try {
                    this.drawerOpen = false;
                } catch (error) {
                    console.error('[serviceManager] Error closing drawer:', error);
                }
            },

            handleImageChange(e) {
                try {
                    const file = e && e.target && e.target.files && e.target.files[0];
                    if (file) {
                        this.imagePreview = URL.createObjectURL(file);
                    }
                } catch (error) {
                    console.error('[serviceManager] Error loading image preview:', error);
                }
            },

            async confirmDelete(action, title) {
                try {
                    const result = await Swal.fire({
                        title: 'Delete Service?',
                        text: `Are you sure you want to delete "${title || 'this service'}"? This action cannot be undone.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#DC2626',
                        cancelButtonColor: '#64748B',
                        confirmButtonText: 'Yes, Delete',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true,
                    });

                    if (!result.isConfirmed) {
                        return;
                    }

                    Swal.fire({
                        title: 'Deleting...',
                        text: 'Removing service from database...',
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
                            text: data.message || 'Service deleted successfully.',
                            timer: 1800,
                            showConfirmButton: false,
                        });

                        window.location.reload();
                    } else {
                        await Swal.fire({
                            icon: 'error',
                            title: 'Delete Failed',
                            text: (data && data.message) || 'Failed to delete service. Please try again.',
                            confirmButtonColor: '#2E8B3D',
                        });
                    }
                } catch (error) {
                    console.error('[serviceManager] confirmDelete error:', error);
                    await Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: (error && error.message) || 'An unexpected error occurred while deleting.',
                        confirmButtonColor: '#2E8B3D',
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
                    const actionTitle = isEdit ? 'Save Changes?' : 'Add New Service?';
                    const actionText = isEdit 
                        ? 'Are you sure you want to update this service?' 
                        : 'Are you sure you want to add this new service?';

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
                    });

                    if (!confirmResult.isConfirmed) {
                        return;
                    }

                    Swal.fire({
                        title: 'Saving...',
                        text: 'Please wait while we save the service details.',
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
                            text: data.message || 'The service details have been saved.',
                            timer: 1800,
                            showConfirmButton: false
                        });

                        this.closeDrawer();
                        window.location.reload();
                    } else {
                        let errorMessage = (data && data.message) || 'Failed to save changes. Please check the inputs and try again.';
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
                            confirmButtonColor: '#2E8B3D'
                        });
                    }
                } catch (error) {
                    this.isSubmitting = false;
                    console.error('[serviceManager] submitForm error:', error);
                    await Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: (error && error.message) || 'An unexpected error occurred while saving.',
                        confirmButtonColor: '#2E8B3D'
                    });
                }
            },
        };
    } catch (err) {
        console.error('[serviceManager] Fatal initialization error:', err);
        return {
            drawerOpen: false,
            openCreateDrawer() {},
            openEditDrawer() {},
            closeDrawer() {},
            handleImageChange() {},
            confirmDelete() {},
        };
    }
}

// Attach globally for Alpine.js in browser
if (typeof window !== 'undefined') {
    window.serviceManager = serviceManager;
    if (window.Alpine) {
        window.Alpine.data('serviceManager', serviceManager);
    }
}

export default serviceManager;
