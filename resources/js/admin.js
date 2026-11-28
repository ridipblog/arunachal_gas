import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import { serviceManager } from './admin/services.js';
import { heroManager } from './admin/hero.js';

window.Alpine = Alpine;
window.Swal = Swal;

// Register admin Alpine components
Alpine.data('serviceManager', serviceManager);
Alpine.data('heroManager', heroManager);

// Start Alpine for the admin panel
Alpine.start();
