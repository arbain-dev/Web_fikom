# Activity Diagram & Penjelasan - Admin Web FIKOM

Dokumen ini berisi **Activity Diagram** secara detail untuk setiap modul pengelolaan data di halaman Administrator.

> **Catatan:** Diagram di bawah ini menggunakan format **Mermaid Flowchart** yang kompatibel dengan GitHub.

---

## 1. Login Admin

Proses autentikasi administrator untuk masuk ke dalam sistem.

```mermaid
flowchart TD
    Start([Mulai]) --> A[Buka Halaman Login]
    A --> B[/Input Username & Password/]
    B --> C[Klik Tombol Login]
    C --> D{Username Ada?}
    D -- Tidak --> E[Tampilkan Pesan Error: Username tidak ditemukan]
    E --> A
    D -- Ya --> F{Password Valid?}
    F -- Tidak --> G[Tampilkan Pesan Error: Password salah]
    G --> A
    F -- Ya --> H[Buat Session Admin]
    H --> I[Redirect ke Dashboard]
    I --> End([Selesai])
```

**Penjelasan:**
1.  Admin mengakses halaman login.
2.  Sistem menerima input username dan password.
3.  Sistem mengecek ketersediaan username di database.
4.  Jika username ada, sistem memverifikasi kesesuaian password (hashed).
5.  Jika valid, session `admin_logged_in` dibuat dan admin diarahkan ke Dashboard.

---

## 2. Kelola Data Dosen

Modul untuk manajemen data dosen tetap/tidak tetap, termasuk upload foto profil.

```mermaid
flowchart TD
    Start([Mulai]) --> Menu[Buka Menu Kelola Dosen]
    Menu --> List[Tampil Daftar Dosen]
    
    List --> Branch{Pilih Aksi}
    
    %% Tambah
    Branch -- Tambah Dosen --> FormAdd[Isi Form: NIDN, Nama, Prodi]
    FormAdd --> UploadAdd[Upload Foto]
    UploadAdd --> SimpanAdd[Klik Simpan]
    SimpanAdd --> CekFoto{Foto Valid?}
    CekFoto -- Ya --> SaveDB[Simpan ke Database & Upload Server]
    CekFoto -- Tidak --> ErrVal[Tampilkan Error Validasi]
    SaveDB --> SuksesAdd[Tampilkan Pesan Sukses]
    
    %% Edit
    Branch -- Edit Dosen --> FormEdit[Ubah Data Dosen]
    FormEdit --> CekGanti{Ganti Foto?}
    CekGanti -- Ya --> UpNew[Upload Foto Baru & Hapus Lama]
    CekGanti -- Tidak --> Skip[Pertahankan Foto Lama]
    UpNew --> UpdateDB[Update Database]
    Skip --> UpdateDB
    UpdateDB --> SuksesEdit[Tampilkan Pesan Sukses]
    
    %% Hapus
    Branch -- Hapus Dosen --> Confirm[Konfirmasi Hapus?]
    Confirm -- Ya --> DelFile[Hapus Foto Fisik]
    DelFile --> DelDB[Hapus Data Database]
    DelDB --> SuksesDel[Tampilkan Pesan Sukses]
    Confirm -- Tidak --> List

    SuksesAdd --> List
    SuksesEdit --> List
    SuksesDel --> List
```

**Penjelasan:**
*   **Tambah**: Admin menginput NIDN, Nama, Prodi, Jabatan, dan upload Foto. Sistem memvalidasi ekstensi foto (JPG/PNG).
*   **Edit**: Admin dapat mengubah data. Jika foto baru diupload, foto lama dihapus secara otomatis.
*   **Hapus**: Menghapus baris data di database sekaligus file fisik foto di folder `uploads/dosen/`.

---

## 3. Kelola Berita

Modul untuk mempublikasikan berita, pengumuman, atau artikel kegiatan kampus.

```mermaid
flowchart TD
    Start([Mulai]) --> A[Buka Menu Kelola Berita]
    A --> B[Tampil Tabel Berita]
    B --> C{Pilih Aksi}
    
    %% Tambah
    C -- Tambah --> D[Isi Judul, Kategori, Konten]
    D --> E[Upload Thumbnail]
    E --> F[Klik Simpan]
    F --> G[Insert Data & Upload File]
    
    %% Edit
    C -- Edit --> H[Update Konten / Ganti Foto]
    H --> I[Klik Simpan Perubahan]
    I --> J[Update Data di Database]
    
    %% Hapus
    C -- Hapus --> K[Konfirmasi Hapus]
    K -- Ya --> L[Hapus File Foto & Data]
    
    G --> End([Selesai / Refresh Tabel])
    J --> End
    L --> End
```

**Penjelasan:**
*   Admin wajib mengisi Judul, Kategori, dan Tanggal Publish.
*   Konten berita dapat berupa teks panjang.
*   Foto yang diupload akan menjadi *thumbnail* berita di halaman depan.

---

## 4. Kelola Pendaftaran Mahasiswa

Modul untuk memverifikasi data calon mahasiswa yang mendaftar secara online.

```mermaid
flowchart TD
    Start([Mulai]) --> A[Buka Halaman Pendaftaran]
    A --> B[Lihat List Pendaftar Masuk]
    B --> C{Pilih Aksi}
    
    C -- Lihat Detail --> D[Popup Biodata Lengkap]
    D --> E[Review Nilai & Berkas]
    
    C -- Update Status --> F[Pilih Status: Diterima/Ditolak]
    F --> G[Update Database via Ajax/Post]
    G --> H[Warna Status Berubah]
    
    C -- Hapus --> I[Konfirmasi Hapus]
    I -- Ya --> J[Hapus File KTP/Ijazah & Data]
    
    E --> B
    H --> B
    J --> B
```

**Penjelasan:**
*   Admin **tidak menginput** data, melainkan **memproses** data yang masuk dari form pendaftaran publik.
*   Fokus utama aktivitas adalah **Verifikasi** (Melihat Bukti Nilai/Ijazah) dan **Update Status** (Diterima/Ditolak).

---

## 5. Kelola Kerjasama (Partner)

Modul untuk menampilkan logo instansi yang bekerja sama dengan fakultas.

```mermaid
flowchart TD
    Start([Mulai]) --> A[Buka Menu Kerjasama]
    A --> B[Klik Tambah Partner]
    B --> C[Input Nama Instansi & Link]
    C --> D[Input Bulan & Tahun]
    D --> E[Upload Logo Instansi]
    E --> F{Format Gambar Valid?}
    
    F -- Tidak --> G[Tampilkan Error]
    F -- Ya --> H[Upload ke Server]
    H --> I[Simpan Data ke Database]
    I --> J[Tampilkan Pesan Sukses]
    J --> End([Selesai])
```

**Penjelasan:**
*   Digunakan untuk menampilkan logo mitra di footer atau halaman kerjasama.
*   Validasi file gambar sangat penting agar tampilan logo rapi.

---

## 6. Kelola Visi, Misi, & Tujuan

Modul *Multi-Section* yang mengelola beberapa jenis data dalam satu halaman.

```mermaid
flowchart TD
    Start([Mulai]) --> A[Buka Halaman Visi Misi]
    A --> Ops{Bagian Mana?}
    
    Ops -- Visi Utama --> B[Edit Textarea Visi]
    B --> C[Klik Simpan Visi]
    C --> D[Update Tabel visi_misi]
    
    Ops -- Misi / Tujuan --> E[Input Text Baru]
    E --> F[Input Nomor Urut]
    F --> G[Klik Tambah]
    G --> H[Insert ke Database]
    
    Ops -- Hapus Item --> I[Klik Ikon Hapus di List]
    I --> J[Delete Item dari Database]
    
    D --> End([Selesai])
    H --> End
    J --> End
```

**Penjelasan:**
*   Halaman ini unik karena menggabungkan form update tunggal (untuk Visi) dan list CRUD (untuk Misi/Tujuan) dalam satu tampilan.

---

## 7. Kelola Galeri & Dokumen

Modul umum untuk upload file (Gambar Kegiatan atau Dokumen Akademik).

```mermaid
flowchart TD
    Start([Mulai]) --> A[Buka Menu Galeri/Dokumen]
    A --> B[Klik Tambah]
    B --> C[Input Judul/Nama]
    C --> D[Upload File (Gambar/PDF)]
    D --> E{Ukuran Sesuai?}
    
    E -- Tidak --> F[Tolak Upload]
    E -- Ya --> G[Upload File ke Server]
    G --> H[Simpan info ke Database]
    H --> End([Selesai])
```

**Penjelasan:**
*   **Galeri**: Untuk foto kegiatan kampus.
*   **Dokumen**: Untuk SOP, Renstra, dan Kurikulum (File PDF).
