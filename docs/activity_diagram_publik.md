# Activity Diagram - Tampilan Publik (Public View)

Dokumen ini berisi activity diagram untuk alur pengguna pada tampilan publik website Fakultas Ilmu Komputer. Setiap diagram disertai dengan penjelasan langkah-langkah logikanya.

---

## 1. Diagram Navigasi Umum (General Navigation)

Diagram ini menggambarkan bagaimana pengunjung berinteraksi dengan website mulai dari halaman utama hingga menelusuri berbagai menu informasi yang tersedia.

```mermaid
flowchart TD
    Start([Start]) --> OpenURL[Pengunjung membuka URL Website]
    OpenURL --> ShowHome[Sistem menampilkan Halaman Beranda]
    
    ShowHome --> Choice{Ingin apa?}
    
    Choice -- "Melihat Profil" --> Profil[Pilih Menu Profil]
    Profil --> ShowProfil[Sistem menampilkan Sambutan/Visi-Misi/Dosen/Struktur]
    
    Choice -- "Akademik" --> Akad[Pilih Menu Akademik/Prodi]
    Akad --> ShowAkad[Sistem menampilkan Kurikulum/Program Studi/Kalender]
    
    Choice -- "Berita" --> Berita[Scroll ke bagian Berita / Pilih Menu Berita]
    Berita --> ClickBerita[Klik pada salah satu Judul Berita]
    ClickBerita --> ShowDetail[Sistem menampilkan Halaman Detail Berita]
    
    Choice -- "Mendaftar" --> Daftar[Klik tombol Pendaftaran / Pilih Menu Pendaftaran]
    Daftar --> ShowForm[Sistem menampilkan Form Pendaftaran]
    
    ShowProfil --> End([End])
    ShowAkad --> End
    ShowDetail --> End
    ShowForm --> End
```

### Penjelasan Diagram Navigasi Umum:
1.  **Start**: Pengguna mengakses website melalui browser.
2.  **Halaman Beranda**: Sistem menyajikan slider utama, statistik, dan ringkasan informasi.
3.  **Pengambilan Keputusan**: Pengguna dapat memilih berbagai jalur navigasi:
    *   **Profil**: Untuk mengetahui informasi dasar fakultas.
    *   **Akademik**: Untuk melihat kurikulum, jadwal, dan profil prodi.
    *   **Berita**: Untuk mendapatkan update kegiatan terkini.
    *   **Pendaftaran**: Jalur khusus untuk calon mahasiswa baru.
4.  **End**: Pengguna mendapatkan informasi yang dicari.

---

## 2. Diagram Alur Pendaftaran (Registration Flow)

Diagram ini merinci proses teknis saat calon mahasiswa melakukan pendaftaran online melalui form yang tersedia.

```mermaid
flowchart TD
    Start([Start]) --> OpenPendaftaran[Pengunjung membuka Halaman Pendaftaran]
    OpenPendaftaran --> ShowForm[Sistem menampilkan Form Pendaftaran & CSRF Token]
    
    ShowForm --> InputData[Pengguna mengisi data diri & unggah dokumen]
    InputData --> ClickSubmit[Klik tombol Kirim Pendaftaran]
    
    ClickSubmit --> Validation{Data Lengkap & Valid?}
    
    Validation -- "Ya" --> SaveData[Sistem memvalidasi & simpan ke Database]
    SaveData --> SuccessMsg[Sistem menampilkan Pesan Sukses]
    SuccessMsg --> AdminProcess[Admin menerima data & Menghubungi pendaftar]
    AdminProcess --> End([End])
    
    Validation -- "Tidak" --> ErrorMsg[Sistem menampilkan Pesan Error]
    ErrorMsg --> FixData[Perbaiki data]
    FixData --> InputData
```

### Penjelasan Diagram Pendaftaran:
1.  **Persiapan**: Sistem menghasilkan CSRF token untuk keamanan form.
2.  **Input Data**: Pengguna mengisi berbagai field wajib (bertanda *).
3.  **Validasi Sistem**:
    *   Mengecek apakah semua field wajib sudah terisi.
    *   Memvalidasi format file yang diunggah (JPG/PNG/PDF).
    *   Memastikan keamanan melalui token CSRF.
4.  **Penyimpanan**: Jika valid, data dimasukkan ke tabel `pendaftaran`.
5.  **Konfirmasi**: Pengguna menerima notifikasi bahwa data telah tersimpan, dan proses berpindah ke sisi admin secara offline (menghubungi via WA/Email).

---

## 3. Diagram Penemuan Konten (Content Discovery - Berita)

Diagram ini menjelaskan alur sistem saat pengguna mencari dan membaca detail berita atau informasi riset.

```mermaid
flowchart TD
    Start([Start]) --> OpenBerita[Pengguna membuka Halaman Berita]
    OpenBerita --> FetchNews[Sistem mengambil daftar berita dari Database]
    FetchNews --> ShowGrid[Sistem menampilkan Grid Kartu Berita]
    
    ShowGrid --> ClickNews[Pengguna memilih/klik berita tertentu]
    ClickNews --> SendID[Sistem mengirim ID Berita via URL]
    
    SendID --> CheckID{Berita ditemukan?}
    
    CheckID -- "Ya" --> ShowDetail[Sistem menampilkan Halaman Detail Berita]
    ShowDetail --> Sidebar[Sistem mengambil berita terkait untuk Sidebar]
    
    CheckID -- "Tidak" --> Redirect[Sistem mengalihkan kembali ke Daftar Berita]
    
    Sidebar --> Share{Ingin membagikan?}
    Share -- "Ya" --> OpenShare[Membuka URL Share Platform]
    OpenShare --> End([End])
    
    Share -- "Tidak" --> End
    Redirect --> End
```

### Penjelasan Diagram Penemuan Konten:
1.  **Daftar Berita**: Sistem melakukan query ke database untuk menampilkan ringkasan berita terbaru.
2.  **Interaksi**: Pengguna memilih berita yang menarik perhatiannya.
3.  **Proses Detail**:
    *   Sistem memvalidasi ID yang dikirim melalui parameter URL.
    *   Jika valid, konten lengkap berita ditampilkan beserta gambar dan meta data.
    *   Jika ID tidak valid atau berita dihapus, sistem secara otomatis melakukan redirect demi kenyamanan pengguna.
4.  **Fitur Tambahan**: Pengguna dapat langsung membagikan konten ke media sosial atau melihat berita populer lainnya di bagian sidebar.
