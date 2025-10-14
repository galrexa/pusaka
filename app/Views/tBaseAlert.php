<!-- SweetAlert2 Library -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Toast Container for Bootstrap -->
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <div id="globalToast" class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toastMessage"></div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script type="text/javascript">
// ============================================
// HELPER GLOBAL UNTUK ALERT & TOAST
// ============================================

/**
 * Show Success Alert (SweetAlert2)
 * @param {string} message - Pesan yang akan ditampilkan
 * @param {string} title - Judul (optional, default: 'Berhasil!')
 */
function showSuccess(message, title = 'Berhasil!') {
    Swal.fire({
        icon: 'success',
        title: title,
        text: message,
        confirmButtonText: 'OK',
        confirmButtonColor: '#28a745'
    });
}

/**
 * Show Error Alert (SweetAlert2)
 * @param {string} message - Pesan yang akan ditampilkan
 * @param {string} title - Judul (optional, default: 'Gagal!')
 */
function showError(message, title = 'Gagal!') {
    Swal.fire({
        icon: 'error',
        title: title,
        text: message,
        confirmButtonText: 'OK',
        confirmButtonColor: '#dc3545'
    });
}

/**
 * Show Warning Alert (SweetAlert2)
 * @param {string} message - Pesan yang akan ditampilkan
 * @param {string} title - Judul (optional, default: 'Perhatian!')
 */
function showWarning(message, title = 'Perhatian!') {
    Swal.fire({
        icon: 'warning',
        title: title,
        text: message,
        confirmButtonText: 'OK',
        confirmButtonColor: '#ffc107'
    });
}

/**
 * Show Info Alert (SweetAlert2)
 * @param {string} message - Pesan yang akan ditampilkan
 * @param {string} title - Judul (optional, default: 'Informasi')
 */
function showInfo(message, title = 'Informasi') {
    Swal.fire({
        icon: 'info',
        title: title,
        text: message,
        confirmButtonText: 'OK',
        confirmButtonColor: '#17a2b8'
    });
}

/**
 * Show Confirmation Dialog (SweetAlert2)
 * @param {string} message - Pesan konfirmasi
 * @param {function} callbackYes - Fungsi callback jika user klik Yes
 * @param {function} callbackNo - Fungsi callback jika user klik No (optional)
 * @param {string} title - Judul (optional, default: 'Konfirmasi')
 */
function showConfirm(message, callbackYes, callbackNo = null, title = 'Konfirmasi') {
    Swal.fire({
        icon: 'question',
        title: title,
        text: message,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#dc3545',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed && callbackYes) {
            callbackYes();
        } else if (result.isDismissed && callbackNo) {
            callbackNo();
        }
    });
}

/**
 * Show Toast Notification (Bootstrap Toast)
 * @param {string} message - Pesan yang akan ditampilkan
 * @param {string} type - Tipe toast: 'success', 'error', 'warning', 'info' (default: 'info')
 * @param {number} duration - Durasi tampil dalam ms (default: 3000)
 */
function showToast(message, type = 'info', duration = 3000) {
    const toastEl = document.getElementById('globalToast');
    const toastBody = document.getElementById('toastMessage');
    
    // Set background color based on type
    const bgColors = {
        'success': 'bg-success text-white',
        'error': 'bg-danger text-white',
        'warning': 'bg-warning text-dark',
        'info': 'bg-info text-white'
    };
    
    // Remove all previous background classes
    toastEl.classList.remove('bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'text-white', 'text-dark');
    
    // Add new background class
    const bgClass = bgColors[type] || bgColors['info'];
    bgClass.split(' ').forEach(cls => toastEl.classList.add(cls));
    
    // Set message
    toastBody.textContent = message;
    
    // Show toast
    const toast = new bootstrap.Toast(toastEl, {
        autohide: true,
        delay: duration
    });
    toast.show();
}

/**
 * Show Loading Alert (SweetAlert2)
 * @param {string} message - Pesan loading (optional, default: 'Memproses...')
 */
function showLoading(message = 'Memproses...') {
    Swal.fire({
        title: message,
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

/**
 * Close/Hide Loading Alert
 */
function hideLoading() {
    Swal.close();
}

/**
 * Show Alert with Custom HTML (SweetAlert2)
 * @param {string} html - HTML content
 * @param {string} title - Judul (optional)
 */
function showCustomAlert(html, title = '') {
    Swal.fire({
        title: title,
        html: html,
        confirmButtonText: 'OK'
    });
}

// ============================================
// AUTO SHOW TOAST UNTUK FLASHDATA
// ============================================
$(document).ready(function() {
    // Jika ada flashdata message, tampilkan sebagai toast
    const flashMessage = $('#flashdata_message').text().trim();
    if (flashMessage) {
        showToast(flashMessage, 'info', 5000);
        $('#flashdata_message').hide(); // Sembunyikan alert default
    }
});
</script>
