# Activity Diagram - Pengabdian Masyarakat

Dokumen ini memetakan alur kerja untuk modul **Pengabdian Masyarakat**, mencakup akses publik untuk melihat berbagai program pengabdian dan pengelolaan datanya oleh admin.

---

## 1. Alur Tampilan Publik (Public View)

Diagram ini menggambarkan interaksi pengguna saat mengakses daftar kegiatan pengabdian masyarakat beserta detail spesifiknya. Pada modul ini, pengguna dapat membaca ringkasan langsung di kartu, dan jika admin pernah mengunggah file laporannya (PDF), sistem akan menampilkan tombol khusus pembaca PDF.

```mermaid
flowchart TD
    Mulai([Mulai]) --> FetchList["Sistem Mengambil Seluruh Data Pengabdian (ORDER BY judul)"]
    FetchList --> RenderCards[Sistem Merender Grid Kartu Pengabdian]
    
    RenderCards --> UserRead["Pengguna Membaca Info Singkat (Judul, Pelaksana) di Kartu"]
    UserRead --> CheckFile{"Ada File Laporan (PDF)?"}
    
    CheckFile -- "Tidak Ada" --> DetailText[Hanya Muncul Teks 'Laporan belum tersedia']
    CheckFile -- "Ada File" --> ShowBtn[Muncul Tombol 'Lihat Laporan']
    
    ShowBtn --> ClickBtn{Pengguna Klik Tombol?}
    ClickBtn -- "Ya" --> TriggerJS["JavaScript showPdf(judul, url) Terpanggil"]
    
    TriggerJS --> OpenModal[Sistem Menampilkan PDF Viewer Modal]
    OpenModal --> UserReadPDF[Pengguna Membaca Dokumen Laporan Eksternal]
    
    UserReadPDF --> CloseModal[Klik Tutup Modal/Overlay]
    CloseModal --> EndRead[Kembali Ke Tampilan Grid]
    
    DetailText --> EndRead
    ClickBtn -- "Tidak" --> EndRead
    
    EndRead --> End([Selesai])
```

---

## 2. Alur Pengelolaan Admin (Admin Management CRUD)

Fitur CRUD untuk modul ini terpusat pada pengisian form identitas kegiatan (Judul, Pelaksana, Deskripsi, Tanggal) dan mengunggah dokumen tunggal PDF/DOC sebagai Laporan Kegiatan. Skema kueri di sini dirancang lebih sederhana namun presisi pada manajemen filenya.

```mermaid
flowchart TD
    Mulai([Mulai]) --> FetchData["Sistem Query Fetch Data (ORDER BY id DESC)"]
    FetchData --> ShowTable[Sistem Menampilkan Tabel Data]
    
    ShowTable --> Action{Pilih Aksi CRUD}
    
    %% Alur Tambah & Edit
    Action -- "Tambah/Edit Data" --> ModalForm[Sistem Buka Form Modal]
    ModalForm --> FillData["Admin Isi Inputan (Judul, Pelaksana, Deskripsi, Tanggal)"]
    FillData --> UploadDocs["Admin Upload Dokumen Laporan (Max 5MB)"]
    UploadDocs --> SubmitForm[Klik Simpan / Update]
    
    SubmitForm --> ValidateExt{"Ekstensi Valid (PDF/DOC) & Size < 5MB?"}
    ValidateExt -- "Tidak Valid" --> ErrorExt[Notifikasi Gagal: Format/Size Salah]
    ValidateExt -- "Abaikan (Mode Edit tanpa Ganti File)" --> ProcessDB
    ValidateExt -- "Valid" --> MoveFiles[Pindahkan File Tervalidasi ke Storage]
    
    MoveFiles --> ProcessDB{Pengecekan Mode Target}
    ProcessDB -- "tambah_pengabdian" --> DBInsert[Eksekusi SQL INSERT Data Baru]
    ProcessDB -- "edit_pengabdian" --> DBUpdate[Eksekusi SQL UPDATE, Hapus File Lama Server]
    
    DBInsert --> NoticeSuccess[Sistem Notifikasi: Sukses]
    DBUpdate --> NoticeSuccess
    
    %% Alur Hapus
    Action -- "Hapus Data" --> ClickDelete[Klik Ikon Hapus]
    ClickDelete --> ConfirmDelete{"Pilihan Konfirmasi (Alert JS)?"}
    ConfirmDelete -- "Batal" --> Return["Kembali Ke Tabel (Abaikan)"]
    ConfirmDelete -- "Setuju" --> FetchFiles[Sistem Seleksi Data file_pdf Terkait]
    FetchFiles --> ExecDelete["Unlink File Fisik (Jika Ada) & Eksekusi SQL DELETE"]
    ExecDelete --> NoticeSuccess
    
    NoticeSuccess --> RefreshTable[Redirect ke Halaman Sama + Status]
    RefreshTable --> FetchData
    ErrorExt --> ModalForm
    Return --> ShowTable
```

---

### Penjelasan Teknis Modul Pengabdian:
1.  **Format Inline Card Viewer**: Pemanggilan data publik modul ini sedikit berbeda dengan _Penelitian_. Alih-alih merender ulang data berupa string JSON untuk Pop-Up, ringkasan informasi langsung terlihat statis pada kartu grid, dan interaksi mendalam diserahkan pada file viewer khusus (terutama PDF) tanpa menduduki keseluruhan _viewport_.
2.  **Manajemen Dokumen Tunggal**: Berbeda dari sistem _Penelitian_ yang perlu memisahkan antara `file_proposal` dan `file_laporan`, mekanisme storage _Pengabdian_ mengkonsolidasi dokumen menjadi file laporannya saja. Validasi upload diperkuat dengan penjagaan ukuran berkas (size limit 5MB).
3.  **Clean Deletion Principle (Hapus Tuntas)**: Baik pada proses Edit (menggantikan file) maupun Hapus Record (menghapus baris pada _Database_), sistem menggunakan sintaks fungsional PHP `@unlink()` sehingga efisiensi ruang _drive_ dari aplikasi selalu dioptimalkan.
