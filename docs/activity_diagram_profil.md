# Activity Diagram - Fitur Profil FIKOM

Dokumen ini menyajikan alur kerja mendalam untuk fitur-fitur yang tergabung dalam modul **Profil** pada Website Fakultas Ilmu Komputer.

---

## 1. Navigasi Profil (Public Perspective)

Menggambarkan bagaimana pengguna berinteraksi dengan menu profil untuk mendapatkan informasi fakultas.

```mermaid
flowchart TD
    Start([Start]) --> UserAction[Pengguna klik Menu Profil di Navbar]
    UserAction --> Dropdown[Sistem menampilkan Dropdown Profil]
    
    Dropdown --> SubMenu{Pilih Sub-Menu}
    SubMenu -- "Sambutan Dekan" --> OpenSambutan[Buka Halaman Sambutan]
    SubMenu -- "Visi & Misi" --> OpenVM[Buka Halaman Visi Misi]
    SubMenu -- "Dosen" --> OpenDosen[Buka Halaman Daftar Dosen]
    SubMenu -- "Struktur" --> OpenStruktur[Buka Halaman Struktur Organisasi]
    SubMenu -- "Pendaftaran" --> OpenDaftar[Buka Form Pendaftaran]
    
    OpenSambutan --> ViewContent[Sistem mengambil data dari Database]
    OpenVM --> ViewContent
    OpenStruktur --> ViewContent
    
    ViewContent --> Render[Sistem menampilkan konten secara visual]
    Render --> End([End])
```

---

## 2. Fitur Visi, Misi, Tujuan & Sasaran (Admin CRUD)

Fitur ini memungkinkan pengelolaan poin-poin strategis fakultas dengan urutan tertentu.

```mermaid
flowchart TD
    Start([Start]) --> OpenModule[Admin buka Kelola Visi Misi]
    OpenModule --> Fetch[Sistem memuat Visi Utama & List Misi/Tujuan]
    
    Fetch --> Interaction{Aksi Admin}
    
    %% Alur Update Visi Utama
    Interaction -- "Update Visi" --> EditVisi[Ubah teks dalam Textarea Visi]
    EditVisi --> SaveVisi[Klik Simpan Visi]
    SaveVisi --> UpdateDB1[Sistem update tabel visi_misi kategori='Visi']
    
    %% Alur Kelola List
    Interaction -- "Tambah Misi/Tujuan" --> InputForm[Input Teks Item & Nomor Urutan]
    InputForm --> AddItem[Klik Tombol Tambah]
    AddItem --> InsertDB[Sistem Simpan Item Baru ke DB]
    
    Interaction -- "Hapus Item" --> Confirm[Klik Hapus & Konfirmasi Dialog]
    Confirm --> DeleteDB[Sistem Hapus Item berdasarkan ID]
    
    UpdateDB1 --> Notify[Notifikasi Berhasil & Refresh]
    InsertDB --> Notify
    DeleteDB --> Notify
    Notify --> End([End])
```

---

## 3. Fitur Struktur Organisasi (Admin Media Update)

Fokus pada pengelolaan dokumen visual struktur organisasi.

```mermaid
flowchart TD
    Start([Start]) --> OpenStruktur[Admin buka Kelola Struktur]
    OpenStruktur --> ShowImage[Sistem menampilkan Gambar Struktur Aktif]
    
    ShowImage --> Interaction{Aksi}
    Interaction -- "Ganti Gambar" --> SelectFile[Pilih file baru JPG/PNG/SVG]
    SelectFile --> ClickUpdate[Klik Update Gambar]
    
    ClickUpdate --> CheckFile{Validasi Format?}
    CheckFile -- "Valid" --> Process[Upload file & Hapus file lama]
    Process --> UpdateDB2[Sistem update path di tabel halaman_statis]
    CheckFile -- "Tidak Valid" --> Error[Tampilkan Pesan Peringatan]
    
    UpdateDB2 --> Success[Notifikasi Sukses]
    Error --> ShowImage
    Success --> End([End])
```

---

## 4. Fitur Fakta & Statistik (High-Impact Data)

Mengelola data angka yang ditampilkan secara dinamis di Beranda.

```mermaid
flowchart TD
    Start([Start]) --> OpenFakta[Admin masuk Kelola Fakta]
    OpenFakta --> Table[Tampilkan Daftar Angka & Label]
    
    Table --> CRUD{Pilih Operasi}
    CRUD -- "Tambah/Edit" --> Modal[Buka Modal Form]
    Modal --> Input[Input Judul, Angka & No Urut]
    Input --> Save[Klik Simpan]
    Save --> DBUpdate[Update tabel tb_fakta]
    
    CRUD -- "Hapus" --> Del[Click Delete]
    Del --> DBDelete[Hapus Record]
    
    DBUpdate --> Finish[Refresh UI & End]
    DBDelete --> Finish
```

---

## 5. Fitur Tentang Fakultas (Representasi Identitas)

Fitur ini diperuntukkan bagi admin untuk mengelola narasi profil fakultas yang tampil pada halaman Beranda utama, mencakup pembaruan teks (judul & deskripsi) serta dokumentasi visual (gambar).

```mermaid
flowchart TD
    %% Alur Admin
    StartAdmin([Admin Mengakses Kelola Tentang Fakultas]) --> FetchData["Sistem Mengambil Data<br>(Tabel tentang_fikom baris ke-1)"]
    FetchData --> DisplayForm["Tampilkan Formulir Edit<br>(Judul, Deskripsi, Preview Gambar)"]
    
    DisplayForm --> AdminEdit["Admin Memperbarui Teks / Memilih Gambar Baru"]
    AdminEdit --> Submit["Klik Tombol Simpan Perubahan"]
    
    Submit --> CheckImg{"Apakah Ada Unggahan<br>Gambar Baru?"}
    
    CheckImg -- "Ya" --> UploadProcess["Unggah dan Pindahkan Berkas ke<br>Direktori uploads/tentang/"]
    UploadProcess --> UpdateAll["Perbarui Teks dan Nama Berkas<br>Gambar di Database"]
    
    CheckImg -- "Tidak" --> UpdateText["Perbarui Hanya Teks<br>(Judul & Deskripsi) di Database"]
    
    UpdateAll --> Notify["Tampilkan Notifikasi Berhasil"]
    UpdateText --> Notify
    Notify --> EndAdmin([Selesai])
```

---

### Catatan Teknis Fitur Profil:
- **Optimasi Gambar**: Fitur Struktur Organisasi mendukung format **SVG** untuk memastikan diagram tetap tajam pada semua ukuran layar tanpa pecah (lossless scaling).
- **UX Counter**: Data dari fitur Fakta diintegrasikan dengan `animateCounters` di `main.js`, memberikan efek visual angka yang berhitung naik saat pengguna men-scroll ke bagian tersebut.
- **Relasi Data**: Semua fitur profil terikat dengan user ID administrator yang melakukan perubahan untuk keperluan audit sistem (log aktivitas).
