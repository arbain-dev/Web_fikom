# Activity Diagram - Penelitian Dosen

Dokumen ini memetakan alur kerja untuk modul **Penelitian Dosen**, mencakup akses publik untuk melihat hasil riset dan pengelolaan data oleh admin.

---

## 1. Alur Tampilan Publik (Public View)

Diagram ini menggambarkan interaksi pengguna saat mengakses daftar penelitian dosen dan melihat detail spesifiknya.

```mermaid
flowchart TD
    Start([Pengguna Buka Menu Penelitian]) --> FetchList[Sistem Mengambil Seluruh Data dari Database]
    FetchList --> RenderCards[Sistem Merender Grid Kartu Penelitian]
    
    RenderCards --> UserAction{Pengguna Klik Kartu?}
    
    UserAction -- "Ya" --> TriggerJS["JavaScript showDetail(json_data) Terpanggil"]
    TriggerJS --> PopulateModal[JS Mengisi Data ke dalam Elemen Modal/Popup DOM]
    PopulateModal --> CheckLink{Ada Link Publikasi/Dokumen?}
    
    CheckLink -- "Ya" --> ShowMenuLink[Tampilkan Tombol 'Lihat Publikasi/Selengkapnya']
    CheckLink -- "Tidak" --> HideMenuLink[Sembunyikan Tombol Link]
    
    ShowMenuLink --> DisplayModal["Tampilkan Modal Secara Visual (display: flex)"]
    HideMenuLink --> DisplayModal
    
    DisplayModal --> WatchClose{Klik Tutup / Klik Luar?}
    WatchClose -- "Ya" --> HideModal["Sembunyikan Modal (display: none)"]
    HideModal --> RenderCards
    
    UserAction -- "Tidak" --> Scroll[Pengguna Scroll / Tinggalkan Halaman]
    Scroll --> End([Selesai])
```

---

## 2. Alur Pengelolaan Admin (Admin Management CRUD)

Fitur CRUD untuk modul ini melibatkan pengisian form identitas detail, serta opsi mengunggah dokumen fisik (PDF/DOC) seperti Proposal dan Laporan Penelitian.

```mermaid
flowchart TD
    Start([Admin Akses Kelola Penelitian]) --> ShowTable[Sistem Menampilkan Tabel Data Penelitian]
    
    %% Fitur Filter Data
    ShowTable --> FilterAction{Pilih Filter?}
    FilterAction -- "Filter Tahun/Status" --> SubmitFilter[Klik Filter]
    SubmitFilter --> RefreshTable[Sistem Reload dengan Parameter Filter URL]
    RefreshTable --> ShowTable
    
    FilterAction -- "Abaikan" --> Action{Pilih Aksi CRUD}
    
    %% Alur Tambah & Edit
    Action -- "Tambah/Edit Data" --> ModalForm[Sistem Buka Form Pop-Up Input Berjenjang]
    ModalForm --> FillData[Admin Isi Inputan Teks & Pilihan Select]
    FillData --> UploadDocs["Admin Upload File Proposal dan/atau Laporan (Opsional untuk Edit)"]
    UploadDocs --> SubmitForm[Klik Simpan]
    
    SubmitForm --> ValidateExt{"Ekstensi Dokumen Valid? (PDF/DOC)"}
    ValidateExt -- "Tidak" --> ErrorExt[Notifikasi Gagal Upload File]
    ValidateExt -- "Ya" --> MoveFiles[Pindahkan File Tervalidasi ke Server]
    
    MoveFiles --> ProcessDB{Mode Tambah/Edit?}
    ProcessDB -- "Tambah" --> DBInsert[Eksekusi SQL INSERT]
    ProcessDB -- "Edit" --> DBUpdate[Eksekusi SQL UPDATE, Simpan File Lama Jika Tidak Diganti]
    
    DBInsert --> NoticeSuccess[Sistem Notifikasi: Sukses]
    DBUpdate --> NoticeSuccess
    
    %% Alur Hapus
    Action -- "Hapus Data" --> ClickDelete[Klik Ikon Hapus]
    ClickDelete --> ConfirmDelete{Konfirmasi Setuju?}
    ConfirmDelete -- "Batal" --> Return[Batal, Kembali Ke Tabel]
    ConfirmDelete -- "Setuju" --> FetchFiles[Sistem Mencari Nama File Proposal/Laporan Terkait Data Ini]
    FetchFiles --> ExecDelete[Unlink File Fisik & Eksekusi SQL DELETE]
    ExecDelete --> NoticeSuccess
    
    NoticeSuccess --> RefreshTable
    ErrorExt --> ModalForm
    Return --> ShowTable
```

---

### Penjelasan Teknis Modul Penelitian:
1.  **Keamanan File Upload**: Sistem sisi server secara ketat memvalidasi variabel ekstensinya: **hanya mengizinkan `pdf`, `doc`, `docx`** untuk dokumen penelitian, sekaligus merename nama file menggunakan enkripsi `uniqid()` untuk mencegah bentrok/tertabraknya nama file di direktori publik server.
2.  **Manajemen Pop-Up Publik**: Semua modul pop-up informasi detail (modal) di halaman publik tidak perlu me-reload halaman atau nge-hit AJAX API. Semua elemen dirender awal jadi atribut HTML berformat *JSON Strings* (`htmlspecialchars(json_encode())`), kemudian ditangkap JavaScript klien murni untuk mempercepat rendering (Zero Latency Modal).
