# Activity Diagram - Profil (Visi-Misi, Struktur, Fakta, Tentang)

Dokumen ini berisi activity diagram untuk alur penggunaan dan pengelolaan informasi profil fakultas pada Website Fakultas Ilmu Komputer.

---

## 1. Alur Tampilan Publik (Public View)

Diagram ini menggambarkan bagaimana pengunjung mengakses berbagai informasi profil fakultas.

```mermaid
flowchart TD
    Start([Start]) --> OpenProfile[Pengguna memilih Menu Profil]
    OpenProfile --> Choice{Pilih Sub-Menu}
    
    Choice -- "Visi & Misi" --> FetchVM[Sistem mengambil data Visi, Misi, Tujuan, Sasaran]
    Choice -- "Struktur Organisasi" --> FetchStruktur[Sistem mengambil gambar Struktur Organisasi]
    Choice -- "Fakta Fakultas" --> FetchFakta[Sistem mengambil data Statistik/Fakta]
    Choice -- "Tentang Fikom" --> FetchTentang[Sistem mengambil deskripsi & gambar Fakultas]
    
    FetchVM --> ShowVM[Tampilkan Halaman Visi Misi]
    FetchStruktur --> ShowStruktur[Tampilkan Gambar Struktur]
    FetchFakta --> ShowFakta[Tampilkan Animasi Angka/Fakta]
    FetchTentang --> ShowTentang[Tampilkan Informasi Tentang Fakultas]
    
    ShowVM --> End([End])
    ShowStruktur --> End
    ShowFakta --> End
    ShowTentang --> End
```

---

## 2. Alur Pengelolaan Admin (Admin Management)

Diagram ini merinci bagaimana administrator mengelola berbagai komponen profil.

### A. Alur Visi, Misi, Tujuan & Sasaran
```mermaid
flowchart TD
    Start([Start]) --> OpenVM[Admin buka Kelola Visi Misi]
    OpenVM --> Action{Pilih Aksi}
    
    Action -- "Update Visi" --> EditVisi[Ubah teks Visi di Form]
    EditVisi --> SaveVisi[Klik Simpan Visi]
    
    Action -- "Tambah Misi/Tujuan/Sasaran" --> InputItem[Isi Teks & Nomor Urutan]
    InputItem --> SaveItem[Klik Tombol Tambah]
    
    Action -- "Hapus Item" --> ConfirmHapus[Klik Ikon Sampah & Konfirmasi]
    
    SaveVisi --> Notify[Sistem tampilkan Notifikasi Sukses]
    SaveItem --> Notify
    ConfirmHapus --> Notify
    Notify --> End([End])
```

### B. Alur Struktur & Tentang Fakultas (Update Konten)
```mermaid
flowchart TD
    Start([Start]) --> OpenModule[Admin buka Kelola Struktur / Tentang]
    OpenModule --> ShowCurrent[Sistem tampilkan Form & Gambar Saat Ini]
    
    ShowCurrent --> UpdateContent[Admin ubah Teks / Pilih Gambar Baru]
    UpdateContent --> ClickSave[Klik Tombol Simpan/Update]
    
    ClickSave --> Validation{Validasi File?}
    Validation -- "Valid" --> Process[Sistem upload file & update DB]
    Validation -- "Tidak Valid" --> Error[Tampilkan Pesan Error]
    
    Process --> Notify[Tampilkan Notifikasi Berhasil]
    Error --> ShowCurrent
    Notify --> End([End])
```

### C. Alur Fakta Fakultas (CRUD)
```mermaid
flowchart TD
    Start([Start]) --> OpenFakta[Admin buka Kelola Fakta]
    OpenFakta --> ShowList[Tampilkan Tabel Daftar Fakta]
    
    ShowList --> Action{Pilih Aksi}
    Action -- "Tambah" --> ModalTambah[Input Judul, Angka & Urutan]
    Action -- "Edit" --> ModalEdit[Ubah data pada Modal]
    
    ModalTambah --> Save[Klik Simpan Data]
    ModalEdit --> Save
    
    Save --> Notify[Sistem update DB & Tampilkan Pesan Sukses]
    Notify --> Refresh[Refresh Tabel Fakta]
    Refresh --> End([End])
```

---

### Penjelasan Teknis:
1.  **Visi Misi**: Menggunakan tabel `visi_misi` dengan kolom `kategori` untuk membedakan jenis informasi. Admin dapat melakukan update langsung pada Visi utama atau menambah item list pada Misi/Tujuan.
2.  **Struktur Organisasi**: Menggunakan tabel `halaman_statis` (row: `struktur_organisasi`). Admin mengupload gambar yang akan menggantikan file lama di folder `uploads/profil/`.
3.  **Fakta Fakultas**: Menggunakan tabel `tb_fakta`. Data ini ditampilkan di halaman publik dengan animasi counter (angka bergerak) yang dikelola oleh `main.js`.
4.  **Tentang Fakultas**: Menggunakan tabel `tentang_fikom`. Admin dapat memperbarui deskripsi panjang menggunakan textarea dan mengupdate gambar utama fakultas.
