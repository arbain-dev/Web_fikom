/* ==================================================
   SECTION A — HANDLER MODAL GLOBAL
   ================================================== */
function modalShow(id) {
    const m = document.getElementById(id);
    if (!m) return;
    m.classList.add("show");
    m.style.display = "flex";
    document.body.style.overflow = "hidden";
}
function modalHide(id) {
    const m = document.getElementById(id);
    if (!m) return;
    m.classList.remove("show");
    m.style.display = "none";
    document.body.style.overflow = "";
}
function closeModal(id) {
    modalHide(id);
}

document.addEventListener("click", function (e) {
    if (e.target.classList.contains("modal-overlay")) {
        const modal = e.target.closest(".modal");
        if (modal) modalHide(modal.id);
    }
});

document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
        document.querySelectorAll(".modal.show").forEach(m => modalHide(m.id));
    }
});

/* ============================================================
   FUNGSI UTILITAS MODAL (SAMA UNTUK SEMUA MODUL)
============================================================ */
window.modalShow = function (id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.add("show");
        document.body.style.overflow = "hidden";
    }
};
window.modalHide = function (id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.remove("show");
        document.body.style.overflow = "";
    }
};
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("modal")) {
        modalHide(e.target.id);
    }
});
document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
        document.querySelectorAll(".modal.show").forEach(m => {
            modalHide(m.id);
        });
    }
});

/* ============================================================
   SECTION G — MODULE KURIKULUM
   File: admin_kelola_kurikulum.php
============================================================ */

document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("modalKurikulum");
    const form  = document.getElementById("formKurikulum");
    // Hentikan jika bukan halaman kurikulum
    if (!modal || !form) return;
    const namaInput      = document.getElementById("nama_kurikulum");
    const deskripsiInput = document.getElementById("deskripsi");
    const pdfInput       = document.getElementById("file_pdf");
    const pdfPreview     = document.getElementById("pdfPreview");
    window.openAddKurikulum = function () {
        form.reset();
        document.getElementById("modalTitle").textContent = "Tambah Kurikulum";
        document.getElementById("formAction").value = "tambah_kurikulum";
        document.getElementById("kurikulumId").value = "";
        document.getElementById("currentFile").value = "";
        pdfPreview.style.display = "none";
        pdfPreview.innerHTML = "";
        modalShow("modalKurikulum");
    };

    window.openEditKurikulum = function (id) {
        const item = kurikulumData.find(x => x.id == id);
        if (!item) {
            alert("Data kurikulum tidak ditemukan!");
            return;
        }
        document.getElementById("modalTitle").textContent = "Edit Kurikulum";
        document.getElementById("formAction").value = "edit_kurikulum";
        document.getElementById("kurikulumId").value = item.id;
        namaInput.value      = item.nama_kurikulum;
        deskripsiInput.value = item.deskripsi;
        document.getElementById("currentFile").value = item.file_pdf;
        if (item.file_pdf) {
            pdfPreview.style.display = "block";
            pdfPreview.innerHTML = `
                <a href="${uploadDir}${item.file_pdf}" target="_blank" class="pdf-link">
                    Lihat PDF Saat Ini
                </a>
            `;
        } else {
            pdfPreview.style.display = "none";
            pdfPreview.innerHTML = "";
        }
        modalShow("modalKurikulum");
    };
});


/* ============================================================
   SECTION E — PENELITIAN MODAL
   File: admin_kelola_penelitian.php
   ============================================================ */

document.addEventListener("DOMContentLoaded", () => {
    const overlay = document.getElementById("modalPenelitianOverlay");
    if (!overlay) return; // bukan halaman penelitian
    const titleEl    = document.getElementById("modalPenelitianTitle");
    const modeField  = document.getElementById("mode_penelitian");
    const form       = document.getElementById("formPenelitian");
    const idField         = document.getElementById("id_penelitian");
    const oldFileProposal = document.getElementById("old_file_proposal");
    const oldFileLaporan  = document.getElementById("old_file_laporan");
    const infoProposal    = document.getElementById("info_file_proposal");
    const infoLaporan     = document.getElementById("info_file_laporan");
    const fields = {
        judul:            document.getElementById("judul"),
        peneliti:         document.getElementById("peneliti"),
        tahun:            document.getElementById("tahun"),
        status:           document.getElementById("status"),
        skim_penelitian:  document.getElementById("skim_penelitian"),
        kelompok_bidang:  document.getElementById("kelompok_bidang"),
        nomor_sk:         document.getElementById("nomor_sk"),
        lama_kegiatan:    document.getElementById("lama_kegiatan"),
        sumber_dana:      document.getElementById("sumber_dana"),
        jumlah_dana:      document.getElementById("jumlah_dana"),
        tanggal_mulai:    document.getElementById("tanggal_mulai"),
        tanggal_selesai:  document.getElementById("tanggal_selesai"),
        lokasi_penelitian:document.getElementById("lokasi_penelitian"),
        afiliasi:         document.getElementById("afiliasi"),
        link_publikasi:   document.getElementById("link_publikasi"),
        file_proposal:    document.getElementById("file_proposal"),
        file_laporan:     document.getElementById("file_laporan")
    };

    function openPenelitianModal() {
        overlay.style.display = "flex";
        document.body.style.overflow = "hidden";
    }
    function closePenelitianModal() {
        overlay.style.display = "none";
        document.body.style.overflow = "";
        if (form) form.reset();
        if (idField) idField.value = "";
        if (modeField) modeField.value = "tambah";
        if (oldFileProposal) oldFileProposal.value = "";
        if (oldFileLaporan)  oldFileLaporan.value  = "";
        if (infoProposal) infoProposal.textContent = "";
        if (infoLaporan)  infoLaporan.textContent  = "";
    }

    const btnTambah = document.getElementById("btnOpenTambah");
    if (btnTambah) {
        btnTambah.addEventListener("click", () => {
            if (form) form.reset();
            if (modeField) modeField.value = "tambah";
            if (titleEl)   titleEl.textContent = "Tambah Penelitian";
            const tahunSekarang = new Date().getFullYear();
            if (fields.tahun)  fields.tahun.value = tahunSekarang;
            if (fields.status) fields.status.value = "Draft";
            if (oldFileProposal) oldFileProposal.value = "";
            if (oldFileLaporan)  oldFileLaporan.value  = "";
            if (infoProposal) infoProposal.textContent = "";
            if (infoLaporan)  infoLaporan.textContent  = "";
            openPenelitianModal();
        });
    }

    window.openEditPenelitian = function (btn) {
        if (!btn) return;
        if (form) form.reset();
        if (modeField) modeField.value = "edit";
        if (titleEl)   titleEl.textContent = "Edit Penelitian";
        if (idField) idField.value = btn.dataset.id || "";
        if (fields.judul)            fields.judul.value            = btn.dataset.judul || "";
        if (fields.peneliti)         fields.peneliti.value         = btn.dataset.peneliti || "";
        if (fields.tahun)            fields.tahun.value            = btn.dataset.tahun || "";
        if (fields.status)           fields.status.value           = btn.dataset.status || "";
        if (fields.skim_penelitian)  fields.skim_penelitian.value  = btn.dataset.skim_penelitian || "";
        if (fields.kelompok_bidang)  fields.kelompok_bidang.value  = btn.dataset.kelompok_bidang || "";
        if (fields.nomor_sk)         fields.nomor_sk.value         = btn.dataset.nomor_sk || "";
        if (fields.lama_kegiatan)    fields.lama_kegiatan.value    = btn.dataset.lama_kegiatan || "";
        if (fields.sumber_dana)      fields.sumber_dana.value      = btn.dataset.sumber_dana || "";
        if (fields.jumlah_dana)      fields.jumlah_dana.value      = btn.dataset.jumlah_dana || "";
        if (fields.tanggal_mulai)    fields.tanggal_mulai.value    = btn.dataset.tanggal_mulai || "";
        if (fields.tanggal_selesai)  fields.tanggal_selesai.value  = btn.dataset.tanggal_selesai || "";
        if (fields.lokasi_penelitian)fields.lokasi_penelitian.value= btn.dataset.lokasi_penelitian || "";
        if (fields.afiliasi)         fields.afiliasi.value         = btn.dataset.afiliasi || "";
        if (fields.link_publikasi)   fields.link_publikasi.value   = btn.dataset.link_publikasi || "";
        const fileProposalLama = btn.dataset.file_proposal || "";
        const fileLaporanLama  = btn.dataset.file_laporan || "";
        if (oldFileProposal) oldFileProposal.value = fileProposalLama;
        if (oldFileLaporan)  oldFileLaporan.value  = fileLaporanLama;
        if (infoProposal) {
            infoProposal.textContent = fileProposalLama ? "File lama: " + fileProposalLama : "";
        }
        if (infoLaporan) {
            infoLaporan.textContent = fileLaporanLama ? "File lama: " + fileLaporanLama : "";
        }
        if (fields.file_proposal) fields.file_proposal.value = "";
        if (fields.file_laporan)  fields.file_laporan.value  = "";
        openPenelitianModal();
    };

    // ---------- EVENT TUTUP: overlay + tombol Batal/Tutup/X ----------

    overlay.addEventListener("click", (e) => {
        if (e.target === overlay) {
            closePenelitianModal();
        }
    });
    const closeButtons = overlay.querySelectorAll(".btn-tutup, .btn-cancel, .close-btn");
    closeButtons.forEach(btn => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            closePenelitianModal();
        });
    });
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && overlay.style.display === "flex") {
            closePenelitianModal();
        }
    });
});


/* ============================================================
   SECTION E — MODULE BERITA
   File: admin_kelola_berita.php
   ============================================================ */

document.addEventListener("DOMContentLoaded", () => {
    const popupForm = document.getElementById("kbPopupForm");
    if (!popupForm) return; // bukan halaman berita
    const beritaModule = {
        bukaPopup(mode, data = null) {
            popupForm.style.display = "flex";
            document.getElementById("kbFormAction").value = mode;
            if (mode === "tambah") {
                document.getElementById("kbPopupTitle").innerText = "Tambah Berita";
                document.getElementById("kbFormBerita").reset();
                document.getElementById("kbPreviewFotoKecil").style.display = "none";
            }
            if (mode === "edit" && data) {
                document.getElementById("kbPopupTitle").innerText = "Edit Berita";
                document.getElementById("kbBeritaId").value   = data.id;
                document.getElementById("kbJudul").value      = data.judul;
                document.getElementById("kbKategori").value   = data.kategori;
                document.getElementById("kbTanggal").value    = data.tanggal_publish;
                document.getElementById("kbLink").value       = data.link;
                document.getElementById("kbKonten").value     = data.konten;
                document.getElementById("kbFotoLama").value   = data.foto;
                if (data.foto) {
                    const prev = document.getElementById("kbPreviewFotoKecil");
                    prev.src = "../uploads/berita/" + data.foto;
                    prev.style.display = "block";
                }
            }
        },
        tutupPopup() {
            popupForm.style.display = "none";
        },
        previewImage(src) {
            const popupImg = document.getElementById("kbPopupImagePreview");
            document.getElementById("kbImgFull").src = src;
            popupImg.style.display = "flex";
        }
    };

    window.beritaModule = beritaModule;
    const imgPreviewBg = document.getElementById("kbPopupImagePreview");
    if (imgPreviewBg) {
        imgPreviewBg.addEventListener("click", function() {
            this.style.display = "none";
        });
    }
    const fotoInput = document.getElementById("kbFotoInput");
    if (fotoInput) {
        fotoInput.addEventListener("change", function(e) {
            const file = e.target.files[0];
            if (file) {
                const imgPrev = document.getElementById("kbPreviewFotoKecil");
                imgPrev.src = URL.createObjectURL(file);
                imgPrev.style.display = "block";
            }
        });
    }
    document.querySelectorAll(".btn-tutup, .closeModalBtn").forEach(btn => {
        btn.addEventListener("click", () => {
            beritaModule.tutupPopup();
        });
    });
});


/* ============================================================
   SECTION F — MODULE DOSEN
   File: admin_kelola_dosen.php
   ============================================================ */

document.addEventListener("DOMContentLoaded", function () {
    const dosenModal = document.getElementById("dosenModal");
    const dosenForm  = document.getElementById("dosenForm");
    if (!dosenModal || !dosenForm) return;
    const dosenData = Array.isArray(window.dosenData) ? window.dosenData : [];
    const uploadDir = "../uploads/dosen/";

    window.openAddDosenModal = function () {
        dosenForm.reset();
        document.getElementById('modalTitle').textContent = "Tambah Dosen";
        document.getElementById('formAction').value       = "tambah_dosen";
        document.getElementById('dosenId').value          = 0;
        document.getElementById('fotoLama').value         = "";
        const box = document.getElementById('previewFotoBox');
        const img = document.getElementById('imgPreview');
        if (box && img) {
            box.style.display = "none";
            img.src = "";
        }
        modalShow('dosenModal');
    };

    window.setupEditDosen = function (id) {
        const item = dosenData.find(d => Number(d.id) === Number(id));
        if (!item) {
            console.error("DATA DOSEN KOSONG / ID TIDAK DITEMUKAN:", id, dosenData);
            alert("Data dosen tidak ditemukan.");
            return;
        }
        document.getElementById('modalTitle').textContent = "Edit Dosen: " + item.nama;
        document.getElementById('formAction').value       = "edit_dosen";
        document.getElementById('dosenId').value          = item.id;
        document.getElementById('fotoLama').value         = item.foto || "";
        document.getElementById('nama').value             = item.nama || "";
        document.getElementById('nidn').value             = item.nidn || "";
        document.getElementById('email').value            = item.email || "";
        document.getElementById('program_studi').value    = item.program_studi || "";
        document.getElementById('status').value           = item.status || "";
        document.getElementById('pendidikan').value       = item.pendidikan || "";
        document.getElementById('jabatan').value          = item.jabatan || "";
        document.getElementById('keahlian').value         = item.keahlian || "";
        const box = document.getElementById('previewFotoBox');
        const img = document.getElementById('imgPreview');
        if (item.foto && box && img) {
            img.src = uploadDir + item.foto;
            box.style.display = "flex";
        } else {
            box.style.display = "none";
            img.src = "";
        }
        modalShow('dosenModal');
    };
    if (window.dosenErrorOpen === true) {
        modalShow("dosenModal");
    }
    
    const fotoInput = dosenForm.querySelector('input[name="foto"]');
    if (fotoInput) {
        fotoInput.addEventListener("change", function (e) {
            const file = e.target.files[0];
            if (!file) return;
            const box = document.getElementById('previewFotoBox');
            const img = document.getElementById('imgPreview');
            img.src = URL.createObjectURL(file);
            box.style.display = "flex";
        });
    }
});

/* ============================================================
   SECTION G — MODULE KALENDER AKADEMIK
   File source: admin_kelola_kalender.php
============================================================ */

document.addEventListener("DOMContentLoaded", function () {

    const modal = document.getElementById("kalenderModal");
    const form  = document.getElementById("kalenderForm");
    const btnAdd = document.getElementById("openAddModalBtn");
    if (!modal || !form || !btnAdd) return; // bukan halaman kalender
    const previewBox = document.getElementById("imagePreviewBox");
    const previewImg = document.getElementById("currentImageSrc");
    const fieldAction = document.getElementById("formAction");
    const fieldId = document.getElementById("kalenderId");
    const fieldGambar = document.getElementById("currentGambar");
    const kalenderData = window.kalenderData || [];
    const uploadDir = window.uploadDir || "../uploads/kalender/";
    window.openAddKalender = function () {
        form.reset();
        fieldAction.value = "tambah_kalender";
        fieldId.value = "";
        fieldGambar.value = "";
        previewBox.style.display = "none";
        previewImg.src = "";
        document.getElementById("modalTitle").textContent = "Tambah Kalender Akademik";
        modalShow("kalenderModal");
    };
    btnAdd.addEventListener("click", openAddKalender);

    window.openEditKalender = function (id) {
        const item = kalenderData.find(v => v.id == id);
        if (!item) {
            alert("Data tidak ditemukan!");
            return;
        }
        document.getElementById("nama_kalender").value = item.nama_kalender;
        document.getElementById("tahun_akademik").value = item.tahun_akademik;
        document.getElementById("deskripsi").value = item.deskripsi;
        fieldAction.value = "edit_kalender";
        fieldId.value = item.id;
        fieldGambar.value = item.gambar;
        if (item.gambar) {
            previewBox.style.display = "block";
            previewImg.src = uploadDir + item.gambar;
        } else {
            previewBox.style.display = "none";
            previewImg.src = "";
        }
        document.getElementById("modalTitle").textContent = "Edit Kalender";
        modalShow("kalenderModal");
    };

    window.hapusKalender = function (id, nama) {
        if (confirm(`Apakah Anda yakin ingin menghapus kalender "${nama}"?`)) {
            document.getElementById("hapusKalenderId").value = id;
            document.getElementById("hapusForm").submit();
        }
    };
    window.closeKalenderModal = function () {
        modalHide("kalenderModal");
    };

    const overlay = modal.querySelector(".modal-bg");
    if (overlay) {
        overlay.addEventListener("click", function () {
            modalHide("kalenderModal");
        });
    }
});

/* ============================================================
   SECTION H — MODULE KERJASAMA
   File source: admin_kelola_kerjasama.php
============================================================ */

document.addEventListener("DOMContentLoaded", function () {

    const tambahBtn = document.getElementById("openKerjasamaTambahBtn");
    const tambahModal = document.getElementById("kerjasamaTambahModal");
    const editModal = document.getElementById("kerjasamaEditModal");
    if (!tambahBtn || !tambahModal || !editModal) return;
    const dataKerjasama = window.dataKerjasama || {};
    const uploadDir = window.uploadKerjasama || "../uploads/kerjasama/";
    const editForm = document.getElementById("kerjasamaEditForm");

    window.openKerjasamaTambah = function () {
        tambahModal.classList.add("show");
    };
    tambahBtn.addEventListener("click", openKerjasamaTambah);
    window.openKerjasamaEdit = function (id) {
        const item = dataKerjasama[id];
        if (!item) {
            alert("Data kerjasama tidak ditemukan!");
            return;
        }
        document.getElementById("edit_kerjasama_id").value = item.id;
        document.getElementById("edit_nama_instansi").value = item.nama_instansi;
        document.getElementById("edit_link_website").value = item.link_website;
        document.getElementById("edit_logo_lama").value = item.logo;
        const oldImg = document.getElementById("currentLogoSrc");
        const oldName = document.getElementById("currentLogoName");

        oldImg.src = uploadDir + item.logo;
        oldName.textContent = item.logo;

        modalShow("kerjasamaEditModal");
    };


    document.querySelectorAll(".kerjasama-edit-btn").forEach(btn => {

        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const id = this.dataset.id;
            openKerjasamaEdit(id);
        });

    });


    document.querySelectorAll(".modal").forEach(modal => {

        const overlay = modal.querySelector(".modal-overlay");
        const closeX = modal.querySelector(".close-btn");
        const closeBtn = modal.querySelector(".btn-tutup");

        if (overlay) {
            overlay.addEventListener("click", () => modalHide(modal.id));
        }

        if (closeX) {
            closeX.addEventListener("click", () => modalHide(modal.id));
        }

        if (closeBtn) {
            closeBtn.addEventListener("click", () => modalHide(modal.id));
        }

    });

});

/* ============================================================
   SECTION G — MODULE LAB KOMPUTER
   File: admin_kelola_lab.php
   ============================================================ */

document.addEventListener("DOMContentLoaded", function () {

    const labModal = document.getElementById("labModal");
    const labForm  = document.getElementById("labForm");

    // Kalau bukan halaman lab, hentikan
    if (!labModal || !labForm || !window.labData) return; 

    const fotoPreview = document.getElementById("fotoPreviewBox");
    const uploadDir = "../uploads/labolatorium/";
    function labShow()  { labModal.classList.add("show"); }
    function labHide()  { labModal.classList.remove("show"); }

    window.openLabModal = labShow;
    window.closeLabModal = labHide;
    const btnTambah = document.getElementById("openModalBtn");
    if (btnTambah) {
        btnTambah.addEventListener("click", function () {

            labForm.reset();

            document.getElementById("modalTitle").innerText  = "Tambah Lab";
            document.getElementById("formAction").value      = "tambah_lab";
            document.getElementById("labId").value           = "";
            document.getElementById("currentFoto").value     = "";

            fotoPreview.innerHTML = "";
            labShow();
        });
    }
    window.openEditModal = function (id) {

        const item = window.labData.find(l => l.id == id);

        if (!item) {
            alert("Data lab tidak ditemukan!");
            return;
        }

        document.getElementById("modalTitle").innerText  = "Edit Lab";
        document.getElementById("formAction").value      = "edit_lab";
        document.getElementById("labId").value           = item.id;

        document.getElementById("nama").value            = item.nama_lab;
        document.getElementById("deskripsi").value       = item.deskripsi;
        document.getElementById("currentFoto").value     = item.foto;

        fotoPreview.innerHTML = `
            <p>Foto saat ini:</p>
            <img src="${uploadDir + item.foto}" class="table-foto-small">
        `;

        labShow();
    };
    function attachClose(selector) {
        const el = document.querySelector(selector);
        if (el) el.addEventListener("click", labHide);
    }

    attachClose("#closeModalBtn");
    attachClose("#tutupModalBtnBawah");
    attachClose("#labModal .modal-overlay");
});

/* ============================================================
   SECTION H — MODULE PENGABDIAN
   File: admin_kelola_pengabdian.php
   ============================================================ */
document.addEventListener("DOMContentLoaded", function () {

    const modalTambah = document.getElementById("modalTambah");
    const modalEdit   = document.getElementById("modalEdit");
    const tambahBtn   = document.getElementById("openTambah");

    if (!modalTambah || !modalEdit) return;

    function openModal(modal) {
        modal.style.display = "flex";
        document.body.style.overflow = "hidden";
    }

    function closeModal(modal) {
        modal.style.display = "none";
        document.body.style.overflow = "";
    }

    /* =======================
       TOMBOL TAMBAH
    ======================= */
    if (tambahBtn) {
        tambahBtn.addEventListener("click", function () {
            const form = modalTambah.querySelector("form");
            if (form) form.reset();
            openModal(modalTambah);
        });
    }

    /* =======================
       TOMBOL EDIT
    ======================= */
    document.querySelectorAll("table.data-table tbody tr").forEach(row => {
        const btnEdit = row.querySelector("a.edit");
        if (!btnEdit) return;

        btnEdit.addEventListener("click", function (e) {
            e.preventDefault();

            document.getElementById("edit_id").value        = row.dataset.id || "";
            document.getElementById("edit_judul").value     = row.dataset.judul || "";
            document.getElementById("edit_pelaksana").value = row.dataset.pelaksana || "";
            document.getElementById("edit_deskripsi").value = row.dataset.deskripsi || "";
            document.getElementById("edit_tanggal").value   = row.dataset.tanggal || "";
            document.getElementById("old_file_pdf").value   = row.dataset.file || "";

            const info = document.getElementById("info_file");
            if (row.dataset.file) {
                info.innerHTML = `
                    File saat ini:
                    <a href="../uploads/pengabdian_file/${row.dataset.file}" target="_blank">
                        ${row.dataset.file}
                    </a>`;
            } else {
                info.textContent = "Tidak ada file.";
            }

            openModal(modalEdit);
        });
    });

    /* =======================
       TOMBOL TUTUP
    ======================= */
    document.querySelectorAll(".close-btn, .btn-tutup").forEach(btn => {
        btn.addEventListener("click", function () {
            const id = btn.dataset.modal;
            if (id === "modalTambah") closeModal(modalTambah);
            if (id === "modalEdit") closeModal(modalEdit);
        });
    });

    /* =======================
       KLIK AREA LUAR MODAL
    ======================= */
    [modalTambah, modalEdit].forEach(modal => {
        modal.addEventListener("click", function (e) {
            if (e.target === modal) closeModal(modal);
        });
    });

    /* =======================
       ESC
    ======================= */
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closeModal(modalTambah);
            closeModal(modalEdit);
        }
    });

});


/* ============================================================
   SECTION RENOP — Admin Kelola RenOP
============================================================ */
document.addEventListener("DOMContentLoaded", function () {

    if (!window.renopData) return; // Bukan halaman RenOP

    const modalTambah = document.getElementById("tambahModal");
    const modalEdit   = document.getElementById("editModal");
    const btnTambah   = document.getElementById("openModalBtnTambah");

    if (btnTambah) {
        btnTambah.addEventListener("click", function () {
            const form = modalTambah.querySelector("form");
            if (form) form.reset();
            modalShow("tambahModal");
        });
    }
    window.openEditModal = function (id) {

        const item = window.renopData.find(r => String(r.id) === String(id));

        if (!item) {
            alert("Data RenOP tidak ditemukan!");
            return;
        }
        document.getElementById("id_edit").value = item.id;
        document.getElementById("nama_dokumen_edit").value = item.nama_dokumen;
        document.getElementById("deskripsi_edit").value = item.deskripsi;
        document.getElementById("file_lama_edit").value = item.file_pdf;
        const fileStatus = document.getElementById("file_status_edit");
        if (item.file_pdf) {
            fileStatus.innerHTML = `
                File saat ini: <b>${item.file_pdf}</b>
                <a href="../uploads/renop/${item.file_pdf}" target="_blank">[Lihat]</a>
            `;
        } else {
            fileStatus.textContent = "Belum ada file.";
        }
        document.querySelector("#editModal input[type='file']").value = "";
        modalShow("editModal");
    };
    [modalTambah, modalEdit].forEach(modal => {
        if (!modal) return;
        modal.addEventListener("click", function (e) {
            if (e.target === modal) modalHide(modal.id);
        });
    });
});



/* ============================================================
   SECTION B — MODULE RENSTRA
   Data tersedia jika: window.renstraData
============================================================ */
if (window.renstraData) {

    const btnTambah    = document.getElementById("openModalBtnTambah");
    const modalTambah  = document.getElementById("tambahModal");
    const modalEdit    = document.getElementById("editModal");
    if (btnTambah) {
        btnTambah.addEventListener("click", () => {
            const form = modalTambah.querySelector("form");
            if (form) form.reset();
            modalShow("tambahModal");
        });
    }
    window.openEditModal = function (id) {
        const item = renstraData.find(r => String(r.id) === String(id));
        if (!item) return alert("Data Renstra tidak ditemukan!");

        document.getElementById("id_edit").value             = item.id;
        document.getElementById("nama_dokumen_edit").value   = item.nama_dokumen;
        document.getElementById("deskripsi_edit").value      = item.deskripsi;
        document.getElementById("file_lama_edit").value      = item.file_pdf;

        const status = document.getElementById("file_status_edit");
        if (item.file_pdf) {
            status.innerHTML =
                `File saat ini: <b>${item.file_pdf}</b> 
                 <a href="../uploads/renstra/${item.file_pdf}" target="_blank">[Lihat]</a>`;
        } else {
            status.textContent = "Belum ada file diunggah.";
        }

        document.getElementById("file_pdf_edit").value = "";

        modalShow("editModal");
    };
    const closeBtns = document.querySelectorAll(
        "#tambahModal .btn-tutup, #tambahModal .close-btn, " +
        "#editModal .btn-tutup,  #editModal .close-btn"
    );

    closeBtns.forEach(btn => {
        btn.addEventListener("click", function () {
            const modal = this.closest(".modal");
            if (modal) modalHide(modal.id);
        });
    });
    const overlays = document.querySelectorAll(
        "#tambahModal .modal-overlay, #editModal .modal-overlay"
    );

    overlays.forEach(ov => {
        ov.addEventListener("click", function () {
            const modal = this.closest(".modal");
            if (modal) modalHide(modal.id);
        });
    });

}


/* ============================================================
   SECTION C — MODULE SOP
   Data tersedia jika: window.sopData
============================================================ */
if (window.sopData) {

    const btnTambah = document.getElementById("openModalBtnTambah");
    const modalTambah = document.getElementById("tambahModal");
    const modalEdit   = document.getElementById("editModal");
    if (btnTambah) {
        btnTambah.addEventListener("click", function () {
            const form = modalTambah.querySelector("form");
            if (form) form.reset();
            modalShow("tambahModal");
        });
    }
    window.openEditModal = function (id) {
        const item = sopData.find(r => String(r.id) === String(id));
        if (!item) return alert("Data SOP tidak ditemukan!");

        document.getElementById("id_edit").value               = item.id;
        document.getElementById("nama_dokumen_edit").value     = item.nama_sop;
        document.getElementById("deskripsi_edit").value        = item.deskripsi;
        document.getElementById("file_lama_edit").value        = item.file_pdf;

        const box = document.getElementById("file_status_edit");
        if (item.file_pdf) {
            box.innerHTML =
                `<i class="fas fa-file-alt" style="font-size:22px;"></i>
                 <div>
                     <b>${item.file_pdf}</b><br>
                     <a href="../uploads/sop/${item.file_pdf}" target="_blank">Lihat File</a>
                 </div>`;
        } else {
            box.innerHTML = "<span style='color:#888;'>Tidak ada file.</span>";
        }

        document.getElementById("file_pdf_edit").value = "";

        modalShow("editModal");
    };
}

/* ===================================================================
   MODULE: KELOLA RUANGAN
   File PHP: admin_kelola_ruangan.php
=================================================================== */

document.addEventListener("DOMContentLoaded", function () {

    if (!window.pageData || !window.pageData.ruanganList) return;

    console.log("%c[RUANGAN MODULE ACTIVE]", "color:#0a0");

    const btnTambah = document.getElementById("openModalBtn");
    const modalRuangan = document.getElementById("ruanganModal");
    const formRuangan = document.getElementById("ruanganForm");

    if (btnTambah) {
        btnTambah.addEventListener("click", () => {
            resetRuanganForm();
            document.getElementById("modalTitle").textContent = "Tambah Ruangan Baru";
            document.getElementById("formAction").value = "tambah_ruangan";
            modalShow("ruanganModal");
        });
    }

    window.openEditModal = function (id) {
        const list = window.pageData.ruanganList;
        const item = list.find(r => String(r.id) === String(id));

        if (!item) {
            alert("Data ruangan tidak ditemukan!");
            return;
        }

        document.getElementById("modalTitle").textContent = "Edit Ruangan";
        document.getElementById("formAction").value = "edit_ruangan";

        document.getElementById("ruanganId").value = item.id;
        document.getElementById("nama_ruangan").value = item.nama_ruangan;
        document.getElementById("deskripsi").value = item.deskripsi;
        document.getElementById("currentFoto").value = item.foto || "";

        const prevBox = document.getElementById("fotoPreviewBox");

        if (item.foto) {
            prevBox.innerHTML = `
                <div class="foto-preview">
                    <p>Foto Saat Ini:</p>
                    <img src="${window.pageData.uploadDirRuangan + item.foto}" style="max-width:100%; border-radius:6px;">
                </div>
            `;
        } else {
            prevBox.innerHTML = "";
        }

        modalShow("ruanganModal");
    };

    window.hapusRuangan = function (id, nama) {
        if (confirm(`Yakin ingin menghapus ruangan "${nama}"?\nProses ini tidak bisa dibatalkan.`)) {
            window.location.href = `admin_kelola_ruangan.php?action=hapus&id=${id}`;
        }
    };
    document.querySelectorAll(".closeModalBtn").forEach(btn => {
        btn.addEventListener("click", function () {
            const id = this.dataset.modalId;
            modalHide(id);
            resetRuanganForm();
        });
    });

    document.querySelectorAll(".modal-overlay").forEach(overlay => {
        overlay.addEventListener("click", function () {
            modalHide(this.closest(".modal").id);
            resetRuanganForm();
        });
    });
    function resetRuanganForm() {
        if (formRuangan) formRuangan.reset();
        document.getElementById("ruanganId").value = "0";
        document.getElementById("currentFoto").value = "";
        document.getElementById("fotoPreviewBox").innerHTML = "";
    }

    const fotoInput = document.getElementById("foto");

    if (fotoInput) {
        fotoInput.addEventListener("change", function (e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = ev => {
                document.getElementById("fotoPreviewBox").innerHTML = `
                    <div class="foto-preview">
                        <p>Preview Foto Baru:</p>
                        <img src="${ev.target.result}" style="max-width:100%; border-radius:6px;">
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        });
    }

});
document.addEventListener("DOMContentLoaded", function () {

    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) modal.style.display = "flex";
    }
    function closeModal(id) {
        const modal = document.getElementById(id);
        if (modal) modal.style.display = "none";
    }
    window.openModal = openModal;
    window.closeModal = closeModal;
    document.querySelectorAll(".close-btn, .btn-tutup").forEach(btn => {
        btn.addEventListener("click", function () {
            const modal = this.closest(".modal");
            if (modal) modal.style.display = "none";
        });
    });
    document.querySelectorAll(".modal").forEach(modal => {
        modal.addEventListener("click", function (e) {
            if (e.target === modal) closeModal(modal.id);
        });
    });

    const btnTambah = document.getElementById("btnOpenTambah");
    const modalTambah = document.getElementById("modalTambah");

    if (btnTambah && modalTambah) {
        btnTambah.addEventListener("click", function () {
            const form = modalTambah.querySelector("form");
            if (form) form.reset();
            openModal("modalTambah");
        });
    }


    window.openBemEdit = function (id) {
        const data = window.bemData.find(x => x.id == id);
        if (!data) return alert("Data BEM tidak ditemukan!");

        document.getElementById("edit_id").value = data.id;
        document.getElementById("edit_nama").value = data.nama;
        document.getElementById("edit_jabatan").value = data.jabatan;
        document.getElementById("edit_prodi").value = data.prodi;
        document.getElementById("edit_kategori").value = data.kategori;
        document.getElementById("edit_urutan").value = data.urutan;
        document.getElementById("edit_foto_lama").value = data.foto;

        const imgPrev = document.getElementById("preview_foto");
        imgPrev.src = data.foto ? (window.bemUploadDir + data.foto) : "";

        openModal("modalEdit");
    };

    document.querySelectorAll(".btn-aksi-edit").forEach(btn => {
        btn.addEventListener("click", function () {
            window.openBemEdit(this.dataset.id);
        });
    });
});

/* ==================================================
   GLOBAL MODAL SYSTEM (SATU SUMBER KEBENARAN)
   ================================================== */
(function () {
  "use strict";

  function modalShow(id) {
    const m = document.getElementById(id);
    if (!m) return;

    m.classList.add("show");
    m.style.display = "flex";
    document.body.style.overflow = "hidden";
  }

  function modalHide(id) {
    const m = document.getElementById(id);
    if (!m) return;

    m.classList.remove("show");
    m.style.display = "none";
    document.body.style.overflow = "";
  }

  window.modalShow = modalShow;
  window.modalHide = modalHide;

  window.closeModal = function (id) {
    modalHide(id);
  };

  window.openModal = modalShow;

  // -------- Global Close Handler --------
  document.addEventListener("click", function (e) {
    if (e.target.classList.contains("modal-overlay")) {
      const modal = e.target.closest(".modal");
      if (modal) modalHide(modal.id);
      return;
    }
    if (e.target.classList.contains("modal")) {
      modalHide(e.target.id);
      return;
    }
    const btn = e.target.closest(".close-btn, .btn-tutup, .closeModalBtn");
    if (btn) {
      e.preventDefault();
      const targetId =
        btn.dataset.modalId || btn.dataset.modal || btn.getAttribute("data-modal-id");
      if (targetId) {
        modalHide(targetId);
        return;
      }
      const modal = btn.closest(".modal");
      if (modal) modalHide(modal.id);
    }
  });

  document.addEventListener("keydown", function (e) {
    if (e.key !== "Escape") return;
    document.querySelectorAll(".modal.show").forEach((m) => {
      modalHide(m.id);
    });
    const kbPopup = document.getElementById("kbPopupForm");
    if (kbPopup && kbPopup.style.display === "flex") {
      kbPopup.style.display = "none";
      document.body.style.overflow = "";
    }
    const kbImg = document.getElementById("kbPopupImagePreview");
    if (kbImg && kbImg.style.display === "flex") {
      kbImg.style.display = "none";
    }
  });
})();

/* ============================================================
   MODULE: KURIKULUM
============================================================ */
document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("modalKurikulum");
  const form = document.getElementById("formKurikulum");
  if (!modal || !form) return;
  const namaInput = document.getElementById("nama_kurikulum");
  const deskripsiInput = document.getElementById("deskripsi");
  const pdfPreview = document.getElementById("pdfPreview");
  window.openAddKurikulum = function () {
    form.reset();
    document.getElementById("modalTitle").textContent = "Tambah Kurikulum";
    document.getElementById("formAction").value = "tambah_kurikulum";
    document.getElementById("kurikulumId").value = "";
    document.getElementById("currentFile").value = "";
    pdfPreview.style.display = "none";
    pdfPreview.innerHTML = "";
    modalShow("modalKurikulum");
  };

  window.openEditKurikulum = function (id) {
    const item = kurikulumData.find((x) => x.id == id);
    if (!item) return alert("Data kurikulum tidak ditemukan!");
    document.getElementById("modalTitle").textContent = "Edit Kurikulum";
    document.getElementById("formAction").value = "edit_kurikulum";
    document.getElementById("kurikulumId").value = item.id;
    namaInput.value = item.nama_kurikulum;
    deskripsiInput.value = item.deskripsi;
    document.getElementById("currentFile").value = item.file_pdf;
    if (item.file_pdf) {
      pdfPreview.style.display = "block";
      pdfPreview.innerHTML = `
        <a href="${uploadDir}${item.file_pdf}" target="_blank" class="pdf-link">
          Lihat PDF Saat Ini
        </a>
      `;
    } else {
      pdfPreview.style.display = "none";
      pdfPreview.innerHTML = "";
    }
    modalShow("modalKurikulum");
  };
});

/* ============================================================
   MODULE: PENELITIAN (punya sistem overlay sendiri, biarin)
============================================================ */
document.addEventListener("DOMContentLoaded", () => {
  const overlay = document.getElementById("modalPenelitianOverlay");
  if (!overlay) return;
  const titleEl = document.getElementById("modalPenelitianTitle");
  const modeField = document.getElementById("mode_penelitian");
  const form = document.getElementById("formPenelitian");
  const idField = document.getElementById("id_penelitian");
  const oldFileProposal = document.getElementById("old_file_proposal");
  const oldFileLaporan = document.getElementById("old_file_laporan");
  const infoProposal = document.getElementById("info_file_proposal");
  const infoLaporan = document.getElementById("info_file_laporan");
  const fields = {
    judul: document.getElementById("judul"),
    peneliti: document.getElementById("peneliti"),
    tahun: document.getElementById("tahun"),
    status: document.getElementById("status"),
    skim_penelitian: document.getElementById("skim_penelitian"),
    kelompok_bidang: document.getElementById("kelompok_bidang"),
    nomor_sk: document.getElementById("nomor_sk"),
    lama_kegiatan: document.getElementById("lama_kegiatan"),
    sumber_dana: document.getElementById("sumber_dana"),
    jumlah_dana: document.getElementById("jumlah_dana"),
    tanggal_mulai: document.getElementById("tanggal_mulai"),
    tanggal_selesai: document.getElementById("tanggal_selesai"),
    lokasi_penelitian: document.getElementById("lokasi_penelitian"),
    afiliasi: document.getElementById("afiliasi"),
    link_publikasi: document.getElementById("link_publikasi"),
    file_proposal: document.getElementById("file_proposal"),
    file_laporan: document.getElementById("file_laporan"),
  };

  function openPenelitianModal() {
    overlay.style.display = "flex";
    document.body.style.overflow = "hidden";
  }
  function closePenelitianModal() {
    overlay.style.display = "none";
    document.body.style.overflow = "";
    if (form) form.reset();
    if (idField) idField.value = "";
    if (modeField) modeField.value = "tambah";
    if (oldFileProposal) oldFileProposal.value = "";
    if (oldFileLaporan) oldFileLaporan.value = "";
    if (infoProposal) infoProposal.textContent = "";
    if (infoLaporan) infoLaporan.textContent = "";
  }

  const btnTambah = document.getElementById("btnOpenTambah");
  if (btnTambah) {
    btnTambah.addEventListener("click", () => {
      if (form) form.reset();
      if (modeField) modeField.value = "tambah";
      if (titleEl) titleEl.textContent = "Tambah Penelitian";
      const tahunSekarang = new Date().getFullYear();
      if (fields.tahun) fields.tahun.value = tahunSekarang;
      if (fields.status) fields.status.value = "Draft";
      if (oldFileProposal) oldFileProposal.value = "";
      if (oldFileLaporan) oldFileLaporan.value = "";
      if (infoProposal) infoProposal.textContent = "";
      if (infoLaporan) infoLaporan.textContent = "";
      openPenelitianModal();
    });
  }

  window.openEditPenelitian = function (btn) {
    if (!btn) return;
    if (form) form.reset();
    if (modeField) modeField.value = "edit";
    if (titleEl) titleEl.textContent = "Edit Penelitian";
    if (idField) idField.value = btn.dataset.id || "";
    if (fields.judul) fields.judul.value = btn.dataset.judul || "";
    if (fields.peneliti) fields.peneliti.value = btn.dataset.peneliti || "";
    if (fields.tahun) fields.tahun.value = btn.dataset.tahun || "";
    if (fields.status) fields.status.value = btn.dataset.status || "";
    if (fields.skim_penelitian) fields.skim_penelitian.value = btn.dataset.skim_penelitian || "";
    if (fields.kelompok_bidang) fields.kelompok_bidang.value = btn.dataset.kelompok_bidang || "";
    if (fields.nomor_sk) fields.nomor_sk.value = btn.dataset.nomor_sk || "";
    if (fields.lama_kegiatan) fields.lama_kegiatan.value = btn.dataset.lama_kegiatan || "";
    if (fields.sumber_dana) fields.sumber_dana.value = btn.dataset.sumber_dana || "";
    if (fields.jumlah_dana) fields.jumlah_dana.value = btn.dataset.jumlah_dana || "";
    if (fields.tanggal_mulai) fields.tanggal_mulai.value = btn.dataset.tanggal_mulai || "";
    if (fields.tanggal_selesai) fields.tanggal_selesai.value = btn.dataset.tanggal_selesai || "";
    if (fields.lokasi_penelitian) fields.lokasi_penelitian.value = btn.dataset.lokasi_penelitian || "";
    if (fields.afiliasi) fields.afiliasi.value = btn.dataset.afiliasi || "";
    if (fields.link_publikasi) fields.link_publikasi.value = btn.dataset.link_publikasi || "";

    const fileProposalLama = btn.dataset.file_proposal || "";
    const fileLaporanLama = btn.dataset.file_laporan || "";
    if (oldFileProposal) oldFileProposal.value = fileProposalLama;
    if (oldFileLaporan) oldFileLaporan.value = fileLaporanLama;
    if (infoProposal) infoProposal.textContent = fileProposalLama ? "File lama: " + fileProposalLama : "";
    if (infoLaporan) infoLaporan.textContent = fileLaporanLama ? "File lama: " + fileLaporanLama : "";
    if (fields.file_proposal) fields.file_proposal.value = "";
    if (fields.file_laporan) fields.file_laporan.value = "";
    openPenelitianModal();
  };

  overlay.addEventListener("click", (e) => {
    if (e.target === overlay) closePenelitianModal();
  });
  overlay.querySelectorAll(".btn-tutup, .btn-cancel, .close-btn").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      closePenelitianModal();
    });
  });
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && overlay.style.display === "flex") closePenelitianModal();
  });
});

/* ============================================================
   MODULE: BERITA (POPUP KHUSUS, BUKAN .modal)
============================================================ */
document.addEventListener("DOMContentLoaded", () => {
  const popupForm = document.getElementById("kbPopupForm");
  if (!popupForm) return;

  const beritaModule = {
    bukaPopup(mode, data = null) {
      popupForm.style.display = "flex";
      document.body.style.overflow = "hidden";

      document.getElementById("kbFormAction").value = mode;

      if (mode === "tambah") {
        document.getElementById("kbPopupTitle").innerText = "Tambah Berita";
        document.getElementById("kbFormBerita").reset();
        document.getElementById("kbPreviewFotoKecil").style.display = "none";
      }

      if (mode === "edit" && data) {
        document.getElementById("kbPopupTitle").innerText = "Edit Berita";

        document.getElementById("kbBeritaId").value = data.id;
        document.getElementById("kbJudul").value = data.judul;
        document.getElementById("kbKategori").value = data.kategori;
        document.getElementById("kbTanggal").value = data.tanggal_publish;
        document.getElementById("kbLink").value = data.link;
        document.getElementById("kbKonten").value = data.konten;
        document.getElementById("kbFotoLama").value = data.foto;

        if (data.foto) {
          const prev = document.getElementById("kbPreviewFotoKecil");
          prev.src = "../uploads/berita/" + data.foto;
          prev.style.display = "block";
        }
      }
    },

    tutupPopup() {
      popupForm.style.display = "none";
      document.body.style.overflow = "";
    },
    previewImage(src) {
      const popupImg = document.getElementById("kbPopupImagePreview");
      document.getElementById("kbImgFull").src = src;
      popupImg.style.display = "flex";
    },
  };
  window.beritaModule = beritaModule;
  const imgPreviewBg = document.getElementById("kbPopupImagePreview");
  if (imgPreviewBg) {
    imgPreviewBg.addEventListener("click", function () {
      this.style.display = "none";
    });
  }

  const fotoInput = document.getElementById("kbFotoInput");
  if (fotoInput) {
    fotoInput.addEventListener("change", function (e) {
      const file = e.target.files[0];
      if (file) {
        const imgPrev = document.getElementById("kbPreviewFotoKecil");
        imgPrev.src = URL.createObjectURL(file);
        imgPrev.style.display = "block";
      }
    });
  }
  popupForm.addEventListener("click", (e) => {
    const btn = e.target.closest(".btn-tutup, .closeModalBtn, .kb-popup-close-x");
    if (!btn) return;
    e.preventDefault();
    beritaModule.tutupPopup();
  });
});

/* ============================================================
   MODULE: DOSEN
============================================================ */
document.addEventListener("DOMContentLoaded", function () {
  const dosenModal = document.getElementById("dosenModal");
  const dosenForm = document.getElementById("dosenForm");
  if (!dosenModal || !dosenForm) return;

  const dosenData = Array.isArray(window.dosenData) ? window.dosenData : [];
  const uploadDir = "../uploads/dosen/";

  window.openAddDosenModal = function () {
    dosenForm.reset();

    document.getElementById("modalTitle").textContent = "Tambah Dosen";
    document.getElementById("formAction").value = "tambah_dosen";
    document.getElementById("dosenId").value = 0;
    document.getElementById("fotoLama").value = "";

    const box = document.getElementById("previewFotoBox");
    const img = document.getElementById("imgPreview");
    if (box && img) {
      box.style.display = "none";
      img.src = "";
    }

    modalShow("dosenModal");
  };

  window.setupEditDosen = function (id) {
    const item = dosenData.find((d) => Number(d.id) === Number(id));
    if (!item) return alert("Data dosen tidak ditemukan.");

    document.getElementById("modalTitle").textContent = "Edit Dosen: " + item.nama;
    document.getElementById("formAction").value = "edit_dosen";
    document.getElementById("dosenId").value = item.id;
    document.getElementById("fotoLama").value = item.foto || "";

    document.getElementById("nama").value = item.nama || "";
    document.getElementById("nidn").value = item.nidn || "";
    document.getElementById("email").value = item.email || "";
    document.getElementById("program_studi").value = item.program_studi || "";
    document.getElementById("status").value = item.status || "";
    document.getElementById("pendidikan").value = item.pendidikan || "";
    document.getElementById("jabatan").value = item.jabatan || "";
    document.getElementById("keahlian").value = item.keahlian || "";

    const box = document.getElementById("previewFotoBox");
    const img = document.getElementById("imgPreview");

    if (item.foto && box && img) {
      img.src = uploadDir + item.foto;
      box.style.display = "flex";
    } else if (box && img) {
      box.style.display = "none";
      img.src = "";
    }

    modalShow("dosenModal");
  };

  if (window.dosenErrorOpen === true) {
    modalShow("dosenModal");
  }

  const fotoInput = dosenForm.querySelector('input[name="foto"]');
  if (fotoInput) {
    fotoInput.addEventListener("change", function (e) {
      const file = e.target.files[0];
      if (!file) return;

      const box = document.getElementById("previewFotoBox");
      const img = document.getElementById("imgPreview");

      img.src = URL.createObjectURL(file);
      box.style.display = "flex";
    });
  }
});
