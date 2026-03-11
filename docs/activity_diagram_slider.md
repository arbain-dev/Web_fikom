# Activity Diagram - Fitur Slider Beranda

Dokumen ini menjelaskan alur kerja sistem untuk fitur **Slider Beranda (Banner)**, baik dari sisi pengunjung website (publik) maupun dari sisi administrator yang mengelolanya.

---

## 1. Alur Tampilan Publik (Public View)

Diagram ini menggambarkan bagaimana sistem merender slider pada halaman beranda utama (`home.php`), termasuk logika penarikan data yang hanya menampilkan slider dengan status aktif.

```mermaid
flowchart TD
    Start(["Pengunjung Buka Beranda"]) --> DBQuery["Sistem Query DB: SELECT * FROM hero_slider WHERE is_active = 1"]
    
    DBQuery --> CheckData{"Data Ditemukan?"}
    
    CheckData -- "Ya" --> Loop["Loop Data Slider"]
    Loop --> ValidateFile{"File Fisik Ada?"}
    
    ValidateFile -- "Ya" --> RenderSlide["Tampilkan Gambar dalam Elemen Slider"]
    ValidateFile -- "Tidak" --> Fallback["Abaikan/Gunakan Default"]
    
    RenderSlide --> CheckMore{"Masih Ada Data?"}
    Fallback --> CheckMore
    
    CheckMore -- "Ya" --> Loop
    CheckMore -- "Tidak" --> InitJS["Inisialisasi JavaScript main.js"]
    
    CheckData -- "Tidak" --> InitJS
    
    InitJS --> AutoChange["Slider Bergerak Otomatis Tiap 5 Detik"]
    AutoChange --> End(["Selesai Merender"])
```

**Catatan Publik:**
*   Hanya gambar dengan flag `is_active = 1` yang akan ditarik dari database ke halaman publik.
*   Logika rotasi otomatis (`setInterval`), navigasi next/prev, dan indikator (dots) dirender dan ditangani di sisi klien oleh fungsi `initHeroSlider()` dalam file `assets/js/main.js`.

---

## 2. Alur Pengelolaan Admin (Admin Management)

Diagram ini merinci bagaimana administrator menambahkan slider baru, menghapus slider lama, dan mengubah status tampilannya (Aktif/Nonaktif).

```mermaid
flowchart TD
    Start(["Admin Akses Kelola Slider"]) --> ShowTable["Sistem Tampilkan Tabel Semua Slider"]
    
    ShowTable --> Action{"Pilih Aksi Admin"}
    
    %% Alur Upload / Tambah Baru
    Action -- "Upload Baru" --> SelectFile["Pilih File Gambar"]
    SelectFile --> UploadSubmit["Klik Tombol Upload"]
    UploadSubmit --> Validation{"Validasi File?"}
    Validation -- "Sukses" --> CopyFile["Pindahkan File ke Folder 'uploads/slider/'"]
    CopyFile --> InsertDB["Insert DB dengan is_active = 1"]
    InsertDB --> NoticeSuccess["Tampilkan Pesan Berhasil"]
    Validation -- "Gagal" --> NoticeFail["Tampilkan Pesan Gagal"]
    
    %% Alur Hapus
    Action -- "Hapus Data" --> ClickDelete["Klik Ikon Tong Sampah"]
    ClickDelete --> ConfirmDelete{"Konfirmasi Hapus?"}
    ConfirmDelete -- "Ya" --> FetchImage["Ambil Nama File dari DB"]
    FetchImage --> Unlink["Hapus File Fisik Server & Delete DB"]
    Unlink --> NoticeSuccess
    ConfirmDelete -- "Batal" --> CancelAction["Batal Eksekusi"]
    
    %% Alur Toggle Status
    Action -- "Ubah Status" --> ClickToggle["Klik Tombol Aktifkan/Nonaktifkan"]
    ClickToggle --> UpdateStatus["Update DB: Toggle is_active 0 jadi 1, atau 1 jadi 0"]
    UpdateStatus --> NoticeSuccess
    
    NoticeSuccess --> Refresh["Muat Ulang Halaman Kelola"]
    NoticeFail --> Refresh
    CancelAction --> ShowTable
    Refresh --> End(["Proses Selesai"])
```

**Catatan Administrasi:**
1.  **Status Default**: Saat admin mengunggah (`upload`) gambar slider baru, sistem secara otomatis mengaturnya sebagai "Aktif" (`is_active = 1`).
2.  **Penghapusan Bersih**: Proses penghapusan tidak hanya menghapus referensi di *database*, tetapi juga menghapus (`unlink()`) file fisik gambar dari map penyimpanan server untuk mencegah pemborosan ruang disk.
3.  **Toggle Cepat**: Tombol ubah status langsung melakukan `query UPDATE` membalikkan nilai `is_active` tanpa memerlukan pengisian formulir tambahan.
