/**
 * Admin JavaScript
 * Cleaned & Optimized
 * Handles sidebar, dropdowns, and interactions
 */

document.addEventListener('DOMContentLoaded', function () {

    // ============================================
    // 1. SIDEBAR & MOBILE TOGGLE
    // ============================================
    const sidebar = document.getElementById('sidebar');
    const hamburger = document.getElementById('hamburger');

    if (hamburger && sidebar) {
        hamburger.addEventListener('click', function (e) {
            e.stopPropagation();
            sidebar.classList.toggle('show');
            toggleOverlay();
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function (e) {
        if (window.innerWidth <= 1024 &&
            sidebar &&
            sidebar.classList.contains('show') &&
            !sidebar.contains(e.target) &&
            !hamburger.contains(e.target)) {
            sidebar.classList.remove('show');
            toggleOverlay();
        }
    });

    function toggleOverlay() {
        let overlay = document.getElementById('sidebar-overlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.id = 'sidebar-overlay';
            overlay.style.cssText = `
                position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                background: rgba(0, 0, 0, 0.5); z-index: 250; display: none;
            `;
            document.body.appendChild(overlay);
        }

        if (sidebar && sidebar.classList.contains('show')) {
            overlay.style.display = 'block';
        } else {
            overlay.style.display = 'none';
        }
    }

    // ============================================
    // 2. SUBMENU ACCORDION
    // ============================================
    const submenuTriggers = document.querySelectorAll('.sidebar-item.has-submenu > .sidebar-link');
    submenuTriggers.forEach(trigger => {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            const parent = this.parentElement;

            // Close others
            document.querySelectorAll('.sidebar-item.has-submenu').forEach(item => {
                if (item !== parent) item.classList.remove('open');
            });

            parent.classList.toggle('open');
        });
    });

    // ============================================
    // 3. USER DROPDOWN (NEW)
    // ============================================
    const userProfile = document.querySelector('.user-dropdown-container');
    if (userProfile) {
        // Toggle on click for mobile or if desired (hover handled by CSS usually, but click is safer for touch)
        // With current CSS: .user-dropdown-container:hover .dropdown-menu { opacity: 1 ... } 
        // For mobile support, add click listener:
        userProfile.addEventListener('click', function () {
            const menu = this.querySelector('.dropdown-menu');
            if (menu) menu.classList.toggle('show');
        });

        // Close when clicking outside
        document.addEventListener('click', function (e) {
            if (!userProfile.contains(e.target)) {
                const menu = userProfile.querySelector('.dropdown-menu');
                if (menu) menu.classList.remove('show');
            }
        });
    }

    // ============================================
    // 4. MODAL UTILITIES (GLOBAL)
    // ============================================
    window.modalShow = function (id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.add('show');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            // Animation reset if needed
            const content = modal.querySelector('.modal-content');
            if (content) {
                content.style.animation = 'none'; // reset
                content.offsetHeight; // trigger reflow
                content.style.animation = 'modalSlideIn 0.3s forwards';
            }
        }
    };

    window.modalHide = function (id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('show');
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }
    };

    // Close modal on specific buttons or overlay
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('modal-overlay') || e.target.classList.contains('modal-close')) {
            const modal = e.target.closest('.modal');
            if (modal) window.modalHide(modal.id);
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal.show').forEach(m => window.modalHide(m.id));
        }
    });

    // ============================================
    // 5. AUTO HIDE ALERTS
    // ============================================
    const alerts = document.querySelectorAll('.alert');
    if (alerts.length > 0) {
        setTimeout(() => {
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    }

    // ============================================
    // 6. IMAGE PREVIEWS (SAFE CHECK)
    // ============================================
    const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]');
    imageInputs.forEach(input => {
        input.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (evt) {
                    // Try to find a preview element
                    // Strategy 1: Look for ID based on input name
                    // Strategy 2: Look for next sibling or previous sibling

                    // Specific fix for "Berita" page which uses 'kbPreviewFotoKecil'
                    if (input.id === 'kbFotoInput') {
                        const prev = document.getElementById('kbPreviewFotoKecil');
                        if (prev) { prev.src = evt.target.result; prev.style.display = 'block'; }
                    }

                    // Generic fallback
                    const parent = input.parentElement;
                    let preview = parent.querySelector('img.preview');
                    if (preview) preview.src = evt.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    });

    // ============================================
    // 7. SPECIFIC PAGE LOGIC WRAPPERS
    // ============================================

    // --- Berita ---
    if (document.getElementById('kbPopupForm')) {
        window.beritaModule = {
            bukaPopup: function (mode, data) {
                const modal = document.getElementById('kbPopupForm');
                const form = document.getElementById('kbFormBerita');
                const title = document.getElementById('kbPopupTitle');

                if (!modal || !form) return;

                // Reset Form
                form.reset();
                document.getElementById('kbFormAction').value = mode;

                if (mode === 'tambah') {
                    title.textContent = 'Tambah Berita';
                    document.getElementById('kbBeritaId').value = '';
                    document.getElementById('kbFotoLama').value = '';
                    if (document.getElementById('imgPreview')) document.getElementById('imgPreview').style.display = 'none';
                } else if (mode === 'edit' && data) {
                    title.textContent = 'Edit Berita';
                    document.getElementById('kbBeritaId').value = data.id;
                    document.getElementById('kbJudul').value = data.judul;
                    document.getElementById('kbKategori').value = data.kategori;
                    document.getElementById('kbTanggal').value = data.tanggal_publish; // Format must be YYYY-MM-DD
                    document.getElementById('kbLink').value = data.link;
                    document.getElementById('kbKonten').value = data.konten;
                    document.getElementById('kbFotoLama').value = data.foto;

                    // Preview existing image
                    /* 
                       Note: Since we don't have a direct img source for safe preview without full path, 
                       we rely on backend or simple text info. 
                       If you want to show existing image, you need to construct the path.
                    */
                }

                window.modalShow('kbPopupForm');
            },

            tutupPopup: function () {
                window.modalHide('kbPopupForm');
            },

            previewImage: function (src) {
                const modal = document.getElementById('kbPopupImagePreview');
                const img = document.getElementById('kbImgFull');
                if (modal && img) {
                    img.src = src;
                    modal.style.display = 'flex'; // Custom flex as it might be simple div
                }
            }
        };
    }

    // --- Dosen ---
    window.openAddDosenModal = function () {
        const modal = document.getElementById('dosenModal');
        const form = document.getElementById('dosenForm');
        if (!modal || !form) return;

        form.reset();
        document.getElementById('formAction').value = 'tambah_dosen';
        document.getElementById('dosenId').value = '0';
        document.getElementById('modalTitle').textContent = 'Tambah Dosen';
        const preview = document.getElementById('previewFotoBox');
        if (preview) preview.style.display = 'none';

        window.modalShow('dosenModal');
    };

    window.setupEditDosen = function (id) {
        const d = window.dosenData.find(item => item.id == id);
        if (!d) return;

        document.getElementById('formAction').value = 'edit_dosen';
        document.getElementById('dosenId').value = d.id;
        document.getElementById('nama').value = d.nama;
        document.getElementById('nidn').value = d.nidn || '';
        document.getElementById('email').value = d.email;
        document.getElementById('program_studi').value = d.program_studi;
        document.getElementById('status').value = d.status;
        document.getElementById('pendidikan').value = d.pendidikan;
        document.getElementById('jabatan').value = d.jabatan || '';
        document.getElementById('keahlian').value = d.keahlian || '';
        document.getElementById('fotoLama').value = d.foto || '';
        document.getElementById('modalTitle').textContent = 'Edit Data Dosen';

        if (d.foto) {
            const previewBox = document.getElementById('previewFotoBox');
            const img = document.getElementById('imgPreview');
            if (previewBox && img) {
                previewBox.style.display = 'block';
                img.src = '../uploads/dosen/' + d.foto;
            }
        } else {
            const previewBox = document.getElementById('previewFotoBox');
            if (previewBox) previewBox.style.display = 'none';
        }

        window.modalShow('dosenModal');
    };

});
