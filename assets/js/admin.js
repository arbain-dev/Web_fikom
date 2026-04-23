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
});

// ============================================
// GLOBAL MODAL UTILITIES (Must be outside DOMContentLoaded)
// ============================================
window.modalShow = function (id) {
    const modal = document.getElementById(id);
    if (modal) {
        // CLOSE ALL OTHER MODALS FIRST to prevent stacking
        document.querySelectorAll('.modal.show').forEach(m => {
            if (m.id !== id) {
                m.classList.remove('show');
                m.style.display = 'none';
            }
        });

        // CRITICAL FIX: Move to body to prevent Layout/Stacking Context issues
        if (modal.parentNode !== document.body) {
            modal.parentNode.removeChild(modal);
            document.body.appendChild(modal);
        }

        modal.classList.add('show');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        // Animation reset removed for stability
        /*
        const content = modal.querySelector('.modal-content');
        if (content) {
            content.style.animation = 'none';
            content.offsetHeight; // trigger reflow
            content.style.animation = 'modalSlideIn 0.3s forwards';
        }
        */
    }
};

window.modalHide = function (id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300); // Wait for transition
        document.body.style.overflow = '';
    }
};

window.tutupDetail = function() {
    window.modalHide('modalDetail');
};

document.addEventListener('DOMContentLoaded', function () {
    // ... existing event listeners ...


    // Close modal on specific buttons or overlay
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('modal-overlay') || e.target.classList.contains('modal-close') || e.target.classList.contains('close-btn')) {
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

    // --- Dosen Data Initialization ---
    const dosenDataEl = document.getElementById('dosen-page-data');
    if (dosenDataEl) {
        try {
            window.dosenData = JSON.parse(dosenDataEl.dataset.dosen || '[]');
            window.dosenErrorOpen = dosenDataEl.dataset.error === 'true';
        } catch (e) {
            console.error('Error parsing dosen data', e);
            window.dosenData = [];
        }
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

    // --- Fakta Fakultas ---
    if (document.getElementById("faktaModal")) {
        window.faktaModule = {
            bukaPopup(mode, data = null) {
                const modal = document.getElementById("faktaModal");
                const form = document.getElementById("faktaForm");

                document.getElementById("faktaAction").value = mode;

                if (mode === "tambah") {
                    document.getElementById("faktaTitle").innerText = "Tambah Fakta";
                    if (form) form.reset();
                    document.getElementById("faktaId").value = "";
                } else if (mode === "edit") {
                    document.getElementById("faktaTitle").innerText = "Edit Fakta";
                    document.getElementById("faktaId").value = data.id;
                    document.getElementById("faktajudul").value = data.judul;
                    document.getElementById("faktaangka").value = data.angka;
                    document.getElementById("faktaurutan").value = data.urutan;
                }

                if (typeof window.modalShow === 'function') {
                    window.modalShow("faktaModal");
                } else {
                    modal.classList.add("show");
                }
            },

            tutupPopup() {
                if (typeof window.modalHide === 'function') {
                    window.modalHide("faktaModal");
                } else {
                    document.getElementById("faktaModal").classList.remove("show");
                }
            }
        };
    }

    // --- Penelitian ---
    if (document.getElementById('modalPenelitian')) {
        const btnAdd = document.getElementById('btnOpenTambah');
        const form = document.getElementById('formPenelitian');

        if (btnAdd) {
            btnAdd.addEventListener('click', () => {
                if (form) form.reset();
                document.getElementById('mode_penelitian').value = 'tambah';
                document.getElementById('id_penelitian').value = '';
                document.getElementById('modalPenelitianTitle').innerText = 'TAMBAH PENELITIAN';
                if (document.getElementById('info_proposal_text')) document.getElementById('info_proposal_text').innerText = '';
                if (document.getElementById('info_laporan_text')) document.getElementById('info_laporan_text').innerText = '';
                window.modalShow('modalPenelitian');
            });
        }

        document.querySelectorAll('.btn-edit-penelitian').forEach(btn => {
            btn.addEventListener('click', function () {
                const d = this.dataset;
                document.getElementById('mode_penelitian').value = 'edit';
                document.getElementById('id_penelitian').value = d.id;

                document.getElementById('judul').value = d.judul;
                document.getElementById('peneliti').value = d.peneliti;
                document.getElementById('tahun').value = d.tahun;
                document.getElementById('status').value = d.status;
                document.getElementById('skim_penelitian').value = d.skim_penelitian;
                document.getElementById('kelompok_bidang').value = d.kelompok_bidang;
                document.getElementById('nomor_sk').value = d.nomor_sk;
                document.getElementById('lama_kegiatan').value = d.lama_kegiatan;
                document.getElementById('sumber_dana').value = d.sumber_dana;
                document.getElementById('jumlah_dana').value = d.jumlah_dana;
                document.getElementById('tanggal_mulai').value = d.tanggal_mulai;
                document.getElementById('tanggal_selesai').value = d.tanggal_selesai;
                document.getElementById('lokasi_penelitian').value = d.lokasi_penelitian;
                document.getElementById('afiliasi').value = d.afiliasi;

                // Files
                document.getElementById('old_file_proposal').value = d.file_proposal;
                document.getElementById('old_file_laporan').value = d.file_laporan;
                document.getElementById('link_publikasi').value = d.link_publikasi;

                const infoProp = document.getElementById('info_proposal_text');
                if (d.file_proposal) infoProp.innerHTML = `File saat ini: <a href="../uploads/penelitian_proposal/${d.file_proposal}" target="_blank">Lihat</a>`;
                else infoProp.innerText = 'Belum ada file.';

                const infoLap = document.getElementById('info_laporan_text');
                if (d.file_laporan) infoLap.innerHTML = `File saat ini: <a href="../uploads/penelitian_laporan/${d.file_laporan}" target="_blank">Lihat</a>`;
                else infoLap.innerText = 'Belum ada file.';

                document.getElementById('modalPenelitianTitle').innerText = 'EDIT PENELITIAN';
                window.modalShow('modalPenelitian');
            });
        });
    }

    // --- BEM ---
    const bemDataEl = document.getElementById('bem-page-data');
    if (bemDataEl) {
        const uploadDir = bemDataEl.dataset.uploadDir;

        // Tambah
        const btnOpen = document.getElementById('btnOpenTambah');
        if (btnOpen) {
            btnOpen.addEventListener('click', () => {
                window.modalShow('modalTambah');
            });
        }

        // Edit
        document.querySelectorAll('.edit').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const jabatan = this.dataset.jabatan;
                const prodi = this.dataset.prodi;
                const kategori = this.dataset.kategori;
                const urutan = this.dataset.urutan;
                const foto = this.dataset.foto;

                document.getElementById('edit_id').value = id;
                document.getElementById('edit_nama').value = nama;
                document.getElementById('edit_jabatan').value = jabatan;
                document.getElementById('edit_prodi').value = prodi;
                document.getElementById('edit_kategori').value = kategori;
                document.getElementById('edit_urutan').value = urutan;
                document.getElementById('edit_foto_lama').value = foto;

                const imgPreview = document.getElementById('preview_foto');
                if (foto) {
                    imgPreview.src = uploadDir + foto;
                    imgPreview.style.display = 'block';
                } else {
                    imgPreview.style.display = 'none';
                }

                window.modalShow('modalEdit');
            });
        });
    }

    // --- Kerjasama ---
    const kerjasamaDataEl = document.getElementById('kerjasama-page-data');
    if (kerjasamaDataEl) {
        const uploadDir = kerjasamaDataEl.dataset.uploadDir;
        try {
            window.kerjasamaData = JSON.parse(kerjasamaDataEl.dataset.items || '[]');
        } catch (e) { window.kerjasamaData = []; }

        const btnAdd = document.getElementById('openKerjasamaTambahBtn');
        if (btnAdd) {
            btnAdd.addEventListener('click', () => {
                window.modalShow('kerjasamaTambahModal');
            });
        }

        document.querySelectorAll('.kerjasama-edit-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const data = window.kerjasamaData.find(item => item.id == id);
                if (!data) return;

                document.getElementById('edit_kerjasama_id').value = data.id;
                document.getElementById('edit_nama_instansi').value = data.nama_instansi;
                document.getElementById('edit_link_website').value = data.link_website;
                document.getElementById('edit_bulan').value = data.bulan;
                document.getElementById('edit_tahun').value = data.tahun;
                document.getElementById('edit_logo_lama').value = data.logo;

                const img = document.getElementById('currentLogoSrc');
                const name = document.getElementById('currentLogoName');

                // If img element exists
                if (img && name) {
                    if (data.logo) {
                        img.src = uploadDir + data.logo;
                        img.style.display = 'block';
                        name.innerText = data.logo;
                    } else {
                        img.style.display = 'none';
                        name.innerText = 'Tidak ada logo';
                    }
                }

                window.modalShow('kerjasamaEditModal');
            });
        });
    }

    // --- Kalender Akademik ---
    const kalenderDataEl = document.getElementById('kalender-page-data');
    if (kalenderDataEl) {
        const uploadDir = kalenderDataEl.dataset.uploadDir;
        let kalenderData = [];
        try {
            kalenderData = JSON.parse(kalenderDataEl.dataset.items || '[]');
        } catch (e) { console.error(e); }

        const btnAdd = document.getElementById('openAddModalBtn');
        if (btnAdd) {
            btnAdd.addEventListener('click', () => {
                document.getElementById('kalenderForm').reset();
                document.getElementById('formAction').value = 'tambah_kalender';
                document.getElementById('kalenderId').value = '';
                document.getElementById('currentGambar').value = '';
                document.getElementById('modalTitle').innerText = 'Tambah Kalender Akademik';
                if (document.getElementById('imagePreviewBox')) document.getElementById('imagePreviewBox').style.display = 'none';
                window.modalShow('kalenderModal');
            });
        }

        // Edit Delegation
        document.querySelectorAll('.btn-edit-kalender').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const id = this.dataset.id;
                const item = kalenderData.find(d => d.id == id);
                if (!item) return;

                document.getElementById('formAction').value = 'edit_kalender';
                document.getElementById('kalenderId').value = item.id;
                document.getElementById('nama_kalender').value = item.nama_kalender;
                document.getElementById('tahun_akademik').value = item.tahun_akademik;
                document.getElementById('deskripsi').value = item.deskripsi;
                document.getElementById('currentGambar').value = item.gambar || '';

                document.getElementById('modalTitle').innerText = 'Edit Kalender Akademik';

                const previewBox = document.getElementById('imagePreviewBox');
                const prevBk = document.getElementById('currentImageSrc');
                if (item.gambar) {
                    prevBk.src = uploadDir + item.gambar;
                    previewBox.style.display = 'block';
                } else {
                    previewBox.style.display = 'none';
                }

                window.modalShow('kalenderModal');
            });
        });

        // Hapus Delegation
        document.querySelectorAll('.btn-hapus-kalender').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                if (confirm('Yakin ingin menghapus kalender "' + nama + '"?')) {
                    document.getElementById('hapusKalenderId').value = id;
                    document.getElementById('hapusForm').submit();
                }
            });
        });
    }

    // --- Kurikulum ---
    const kurikulumDataEl = document.getElementById('kurikulum-page-data');
    if (kurikulumDataEl) {
        let kurikulumData = [];
        try {
            kurikulumData = JSON.parse(kurikulumDataEl.dataset.items || '[]');
        } catch (e) { console.error(e); }

        const btnAdd = document.getElementById('btnAddKurikulum'); // Will add ID to button in PHP
        if (btnAdd) {
            btnAdd.addEventListener('click', () => {
                const form = document.getElementById('formKurikulum');
                form.reset();
                document.getElementById('formAction').value = 'tambah_kurikulum';
                document.getElementById('kurikulumId').value = '';
                document.getElementById('currentFile').value = '';
                document.getElementById('modalTitle').innerText = 'Tambah Kurikulum';
                window.modalShow('modalKurikulum');
            });
        }

        document.querySelectorAll('.btn-edit-kurikulum').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const data = kurikulumData.find(item => item.id == id);
                if (!data) return;

                document.getElementById('formAction').value = 'edit_kurikulum';
                document.getElementById('kurikulumId').value = data.id;
                document.getElementById('nama_kurikulum').value = data.nama_kurikulum;
                document.getElementById('deskripsi').value = data.deskripsi;
                document.getElementById('currentFile').value = data.file_pdf;
                document.getElementById('modalTitle').innerText = 'Edit Kurikulum';

                window.modalShow('modalKurikulum');
            });
        });
    }

    // --- Lab Komputer ---
    const labDataEl = document.getElementById('lab-page-data');
    if (labDataEl) {
        let labData = [];
        try {
            labData = JSON.parse(labDataEl.dataset.items || '[]');
        } catch (e) { console.error(e); }

        const btnTambah = document.getElementById('openModalBtn');
        if (btnTambah) {
            btnTambah.addEventListener('click', function () {
                const form = document.getElementById('labForm');
                if (form) form.reset();

                document.getElementById('formAction').value = 'tambah_lab';
                document.getElementById('labId').value = '';
                document.getElementById('modalTitle').textContent = 'Tambah Lab Komputer';

                window.modalShow('labModal');
            });
        }

        document.querySelectorAll('.btn-edit-lab').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const labItem = labData.find(item => item.id == id);
                if (!labItem) return;

                document.getElementById('formAction').value = 'edit_lab';
                document.getElementById('labId').value = labItem.id;
                document.getElementById('nama_lab').value = labItem.nama_lab;
                document.getElementById('deskripsi').value = labItem.deskripsi;
                document.getElementById('currentFoto').value = labItem.foto || '';
                document.getElementById('modalTitle').textContent = 'Edit Lab Komputer';

                window.modalShow('labModal');
            });
        });
    }

    // --- Pendaftaran (PMB) ---
    const pendaftaranDataEl = document.getElementById('pendaftaran-page-data');
    if (pendaftaranDataEl) {
        document.querySelectorAll('.btn-detail-pendaftaran').forEach(btn => {
            btn.addEventListener('click', function () {
                let data = {};
                try {
                    data = JSON.parse(this.dataset.item);
                } catch (e) { return; }

                const table = document.getElementById('tableDetail');
                let html = '';
                const fields = {
                    'Nama Lengkap': data.nama,
                    'NIK': data.nik,
                    'Email': data.email,
                    'No HP': data.hp,
                    'TTL': (data.tempat_lahir || '') + ', ' + (data.tanggal_lahir || ''),
                    'Jenis Kelamin': data.jk,
                    'Asal Sekolah': data.asal_sekolah,
                    'Prodi Pilihan': data.prodi,
                    'Jalur Masuk': data.jalur,
                    'Alamat': data.alamat,
                    'Catatan': data.catatan,
                    'Status': data.status,
                    'Tanggal Daftar': data.created_at
                };

                for (let key in fields) {
                    html += `<tr>
                        <td style="padding:12px; border-bottom:1px solid #f0f0f0; width:160px; font-weight:600; color:#555;">${key}</td>
                        <td style="padding:12px; border-bottom:1px solid #f0f0f0; color:#333;">${fields[key] || '-'}</td>
                    </tr>`;
                }

                // Files
                html += `<tr>
                    <td style="padding:12px; font-weight:600; color:#555;">Dokumen</td>
                    <td style="padding:12px;">`;

                if (data.file_ktp) {
                    html += `<a href="../uploads/pendaftaran/${data.file_ktp}" target="_blank" class="btn btn-sm btn-info" style="margin-right:8px; text-decoration:none;">Lihat KTP</a>`;
                } else {
                    html += `<span style="color:var(--error-500); margin-right:8px;">KTP Kosong</span>`;
                }

                if (data.file_ijazah) {
                    html += `<a href="../uploads/pendaftaran/${data.file_ijazah}" target="_blank" class="btn btn-sm btn-info" style="text-decoration:none;">Lihat Ijazah</a>`;
                } else {
                    html += `<span style="color:var(--error-500);">Ijazah Kosong</span>`;
                }

                html += `</td></tr>`;

                table.innerHTML = html;
                window.modalShow('modalDetail');
            });
        });

        // Close detail custom or use generic close-btn
        const btnClose = document.querySelector('.btn-close-detail');
        if (btnClose) {
            btnClose.addEventListener('click', () => { window.modalHide('modalDetail'); });
        }
    }

    // --- Pengabdian ---
    if (document.getElementById('modalTambah') && document.getElementById('modalEdit') && document.querySelector('table')) { // Heuristic check or use specific ID if added
        // Since I didn't add a specific wrapper ID yet, I will verify if I should relying on the generic structure or add a wrapper.
        // admin_kelola_pengabdian.php uses generic IDs. I'll rely on button class delegation and existence of modals.

        const btnTambah = document.getElementById('openTambah');
        if (btnTambah) {
            btnTambah.addEventListener('click', () => {
                window.modalShow('modalTambah');
            });
        }

        document.querySelectorAll('.btn-edit-pengabdian').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                
                // Get data from button dataset or closest tr dataset
                const tr = this.closest('tr');
                const dataset = this.dataset.id ? this.dataset : (tr ? tr.dataset : {});

                document.getElementById('edit_id').value = dataset.id || '';
                document.getElementById('edit_judul').value = dataset.judul || '';
                document.getElementById('edit_pelaksana').value = dataset.pelaksana || '';
                document.getElementById('edit_deskripsi').value = dataset.deskripsi || '';
                document.getElementById('edit_tanggal').value = dataset.tanggal || '';
                document.getElementById('old_file_pdf').value = dataset.file || '';

                const info = document.getElementById('info_file');
                if (dataset.file) {
                    info.innerHTML = `File saat ini: <a href="../uploads/pengabdian_file/${dataset.file}" target="_blank">${dataset.file}</a>`;
                } else {
                    info.innerHTML = 'Belum ada file.';
                }

                window.modalShow('modalEdit');
            });
        });
    }

    // --- Renop ---
    const renopDataEl = document.getElementById('renop-page-data');
    if (renopDataEl) {
        let renopData = [];
        try {
            renopData = JSON.parse(renopDataEl.dataset.items || '[]');
        } catch (e) { console.error(e); }

        const btnAdd = document.getElementById('openModalBtnTambah');
        if (btnAdd) {
            btnAdd.addEventListener('click', () => {
                const form = document.querySelector('#tambahModal form');
                if (form) form.reset();
                window.modalShow('tambahModal');
            });
        }

        document.querySelectorAll('.btn-edit-renop').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const data = renopData.find(item => item.id == id);
                if (!data) return;

                document.getElementById('id_edit').value = data.id;
                document.getElementById('nama_dokumen_edit').value = data.nama_dokumen;
                document.getElementById('deskripsi_edit').value = data.deskripsi;
                document.getElementById('file_lama_edit').value = data.file_pdf;

                const fileStat = document.getElementById('file_status_edit');
                if (data.file_pdf) {
                    fileStat.innerHTML = `File saat ini: <a href="../uploads/renop/${data.file_pdf}" target="_blank">${data.file_pdf}</a>`;
                } else {
                    fileStat.innerText = "Tidak ada file.";
                }

                window.modalShow('editModal');
            });
        });
    }

    // --- Renstra ---
    const renstraDataEl = document.getElementById('renstra-page-data');
    if (renstraDataEl) {
        let renstraData = [];
        try {
            renstraData = JSON.parse(renstraDataEl.dataset.items || '[]');
        } catch (e) { console.error(e); }

        const btnAdd = document.getElementById('openModalBtnTambah');
        if (btnAdd) {
            btnAdd.addEventListener('click', () => {
                window.modalShow('tambahModal');
            });
        }

        document.querySelectorAll('.btn-edit-renstra').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const data = renstraData.find(item => item.id == id);
                if (!data) return;

                document.getElementById('id_edit').value = data.id;
                document.getElementById('nama_dokumen_edit').value = data.nama_dokumen;
                document.getElementById('deskripsi_edit').value = data.deskripsi;
                document.getElementById('file_lama_edit').value = data.file_pdf;

                const fileStat = document.getElementById('file_status_edit');
                if (data.file_pdf) {
                    fileStat.innerHTML = `File saat ini: <a href="../uploads/renstra/${data.file_pdf}" target="_blank">${data.file_pdf}</a>`;
                } else {
                    fileStat.innerText = "Tidak ada file.";
                }

                window.modalShow('editModal');
            });
        });
    }

    // --- Ruangan ---
    const ruanganDataEl = document.getElementById('ruangan-page-data');
    if (ruanganDataEl) {
        let ruanganList = [];
        try {
            ruanganList = JSON.parse(ruanganDataEl.dataset.items || '[]');
        } catch (e) { console.error(e); }

        const uploadDirRuangan = ruanganDataEl.dataset.uploadDir;

        const btnTambah = document.getElementById('openModalBtn');
        if (btnTambah) {
            btnTambah.addEventListener('click', function () {
                const form = document.getElementById('ruanganForm');
                if (form) form.reset();

                document.getElementById('formAction').value = 'tambah_ruangan';
                document.getElementById('ruanganId').value = '';
                document.getElementById('modalTitle').textContent = 'Tambah Ruangan';

                window.modalShow('ruanganModal');
            });
        }

        document.querySelectorAll('.btn-edit-ruangan').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const id = this.dataset.id;
                const ruanganItem = ruanganList.find(item => item.id == id);
                if (!ruanganItem) return;

                document.getElementById('formAction').value = 'edit_ruangan';
                document.getElementById('ruanganId').value = ruanganItem.id;
                document.getElementById('nama_ruangan').value = ruanganItem.nama_ruangan;
                document.getElementById('deskripsi').value = ruanganItem.deskripsi;
                document.getElementById('currentFoto').value = ruanganItem.foto || '';
                document.getElementById('modalTitle').textContent = 'Edit Ruangan';

                window.modalShow('ruanganModal');
            });
        });

        document.querySelectorAll('.btn-hapus-ruangan').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                if (confirm('Yakin ingin menghapus ruangan "' + nama + '"?')) {
                    window.location.href = '?hapus=' + id;
                }
            });
        });

        // Modal close handled by generic handlers if IDs match, but specialized ones:
        document.querySelectorAll('.closeModalBtn').forEach(btn => {
            btn.addEventListener('click', function () {
                const modalId = this.getAttribute('data-modal-id');
                if (modalId) {
                    window.modalHide(modalId);
                }
            });
        });
    }

    // --- Slider & Generic Image Preview ---
    const modalImage = document.getElementById('modalImage');
    if (modalImage) {
        document.querySelectorAll('.js-preview').forEach(el => {
            el.addEventListener('click', () => {
                const src = el.getAttribute('data-src');
                if (src) {
                    modalImage.src = src;
                    window.modalShow('imageModal');
                }
            });
        });
    }






    // --- SOP ---
    const sopDataEl = document.getElementById('sop-page-data');
    if (sopDataEl) {
        let sopData = [];
        try {
            sopData = JSON.parse(sopDataEl.dataset.items || '[]');
        } catch (e) { console.error(e); }

        const btnAdd = document.getElementById('openModalBtnTambah');
        if (btnAdd) {
            btnAdd.addEventListener('click', () => {
                window.modalShow('tambahModal');
            });
        }

        document.querySelectorAll('.btn-edit-sop').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const data = sopData.find(item => item.id == id);
                if (!data) return;

                document.getElementById('id_edit').value = data.id;
                document.getElementById('nama_dokumen_edit').value = data.nama_sop;
                document.getElementById('deskripsi_edit').value = data.deskripsi;
                document.getElementById('file_lama_edit').value = data.file_pdf;

                const fileStat = document.getElementById('file_status_edit');
                if (data.file_pdf) {
                    fileStat.innerHTML = `File saat ini: <a href="../uploads/sop/${data.file_pdf}" target="_blank">${data.file_pdf}</a>`;
                } else {
                    fileStat.innerText = "Tidak ada file.";
                }

                window.modalShow('editModal');
            });
        });
    }

    // --- Generic Image/File Input Preview ---
    document.querySelectorAll('input[type="file"].preview-input').forEach(input => {
        input.addEventListener('change', function (e) {
            const targetId = this.dataset.previewTarget;
            if (!targetId) return;
            const targetEl = document.querySelector(targetId);
            if (!targetEl) return;

            if (this.files && this.files[0]) {
                targetEl.src = URL.createObjectURL(this.files[0]);
                targetEl.style.display = 'block';
            }
        });
    });

});
