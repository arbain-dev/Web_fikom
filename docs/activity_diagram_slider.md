# Activity Diagram - Fitur Slider Beranda

Dokumen ini menjelaskan alur kerja sistem untuk fitur **Slider Beranda (Banner)**, baik dari sisi pengunjung website (publik) maupun dari sisi administrator yang mengelolanya.

---

## 1. Alur Tampilan Publik (Public View)

Diagram ini menggambarkan bagaimana sistem merender slider pada halaman beranda utama (`home.php`), termasuk logika penarikan data yang hanya menampilkan slider dengan status aktif.

```mermaid
flowchart TD
    Mulai([Mulai]) --> DBQuery["Sistem Query DB:<br>SELECT * FROM hero_slider<br>WHERE is_active = 1"]
    
    DBQuery --> CheckData{"Data Ditemukan?"}
    
    CheckData -- "Ya" --> Loop["Loop Data Slider"]
    Loop --> ValidateFile{"File Fisik Ada?"}
    
    ValidateFile -- "Ya" --> RenderSlide["Tampilkan Gambar<br>dalam Elemen Slider"]
    ValidateFile -- "Tidak" --> Fallback["Abaikan / Gunakan Default"]
    
    RenderSlide --> CheckMore{"Masih Ada Data?"}
    Fallback --> CheckMore
    
    CheckMore -- "Ya" --> Loop
    CheckMore -- "Tidak" --> InitJS["Inisialisasi JavaScript main.js"]
    
    CheckData -- "Tidak" --> InitJS
    
    InitJS --> AutoChange["Slider Bergerak<br>Otomatis Tiap 5 Detik"]
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
    Mulai([Mulai]) --> ShowTable["Sistem Tampilkan Tabel Semua Slider"]
    
    ShowTable --> Action{"Pilih Aksi Admin"}
    
    %% Alur Upload / Tambah Baru
    Action -- "Upload Baru" --> SelectFile["Pilih Berkas Gambar"]
    SelectFile --> UploadSubmit["Klik Tombol Unggah"]
    UploadSubmit --> Validation{"Validasi Berkas?"}
    Validation -- "Sukses" --> CopyFile["Simpan Berkas ke Direktori<br>uploads/slider/"]
    CopyFile --> InsertDB["Simpan Data ke Database<br>(Status = Aktif)"]
    InsertDB --> NoticeSuccess["Tampilkan Pesan Berhasil"]
    Validation -- "Gagal" --> NoticeFail["Tampilkan Pesan Kesalahan"]
    
    %% Alur Hapus
    Action -- "Hapus Data" --> ClickDelete["Klik Ikon Hapus"]
    ClickDelete --> ConfirmDelete{"Konfirmasi Penghapusan?"}
    ConfirmDelete -- "Ya" --> FetchImage["Ambil Nama Berkas dari Database"]
    FetchImage --> Unlink["Hapus Berkas dari Server<br>& Hapus Data dari Database"]
    Unlink --> NoticeSuccess
    ConfirmDelete -- "Batal" --> CancelAction["Batalkan Proses"]
    
    %% Alur Ubah Status
    Action -- "Ubah Status" --> ClickToggle["Klik Tombol<br>Aktifkan / Nonaktifkan"]
    ClickToggle --> UpdateStatus["Perbarui Status di Database<br>(Aktif menjadi Nonaktif / Sebaliknya)"]
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
