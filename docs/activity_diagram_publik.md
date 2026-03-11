# Activity Diagram - Tampilan Publik (Public View)

Dokumen ini berisi activity diagram untuk alur pengguna pada tampilan publik website Fakultas Ilmu Komputer. Setiap diagram disertai dengan penjelasan langkah-langkah logikanya.

---

## 1. Diagram Navigasi Umum (General Navigation)

Diagram ini menggambarkan bagaimana pengunjung berinteraksi dengan website mulai dari halaman utama hingga menelusuri berbagai menu informasi yang tersedia.

```mermaid
flowchart TD
    Mulai([Mulai]) --> OpenURL[Pengunjung membuka URL Website]
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
Alur navigasi umum website ini dirancang untuk memberikan kemudahan bagi pengunjung dalam mengakses berbagai informasi penting mengenai Fakultas Ilmu Komputer. Begitu pengunjung membuka URL website, sistem akan menyuguhkan halaman beranda yang kaya akan informasi, mulai dari slider interaktif hingga statistik fakta fakultas. Dari titik ini, pengunjung dihadapkan pada beberapa pilihan utama: menelusuri profil fakultas untuk memahami visi dan struktur organisasi, mengakses informasi akademik yang mencakup kurikulum dan kalender pendidikan, membaca berita terbaru untuk tetap terinformasi tentang kegiatan kampus, atau langsung menuju jalur pendaftaran jika mereka adalah calon mahasiswa baru. Setiap jalur ini telah dioptimalkan untuk memberikan respons cepat dan informasi yang akurat guna memenuhi kebutuhan setiap pengunjung.

---

## 2. Diagram Alur Pendaftaran (Registration Flow)

Diagram ini merinci proses teknis saat calon mahasiswa melakukan pendaftaran online melalui form yang tersedia.

```mermaid
flowchart TD
    Mulai([Mulai]) --> OpenPendaftaran[Pengunjung membuka Halaman Pendaftaran]
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
Proses pendaftaran mahasiswa baru dilakukan secara digital untuk efisiensi dan transparansi. Alur dimulai dengan pengunjung mengakses halaman pendaftaran, di mana sistem secara otomatis menyiapkan form yang dilengkapi dengan token keamanan CSRF untuk melindungi data pengguna. Calon mahasiswa kemudian mengisi data diri secara lengkap dan mengunggah dokumen pendukung yang diperlukan. Begitu tombol kirim diklik, sistem melakukan validasi menyeluruh baik dari sisi kelengkapan field maupun format berkas yang diupload. Jika data valid dan berhasil disimpan ke database, sistem akan menampilkan pesan sukses. Setelah tahap ini, data akan diproses lebih lanjut oleh panitia pendaftaran (admin) untuk dilakukan verifikasi lanjutan dan komunikasi personal melalui platform digital.

---

## 3. Diagram Penemuan Konten (Content Discovery - Berita)

Diagram ini menjelaskan alur sistem saat pengguna mencari dan membaca detail berita atau informasi riset.

```mermaid
flowchart TD
    Mulai([Mulai]) --> OpenBerita[Pengguna membuka Halaman Berita]
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
Sistem penemuan konten, khususnya pada modul berita, dirancang agar pengunjung dapat dengan mudah menelusuri arsip berita yang ada. Saat halaman berita dibuka, sistem secara aktif menarik data terbaru dari database dan menyajikannya dalam bentuk grid kartu yang menarik secara visual. Pengguna dapat memilih berita tertentu untuk dibaca detailnya. Sistem kemudian melakukan verifikasi ID berita melalui parameter URL untuk memastikan konten yang diminta tersedia secara sah. Jika berhasil ditemukan, halaman detail berita akan ditampilkan lengkap dengan elemen pendukung seperti sidebar yang berisi rekomendasi berita terkait. Fitur ini bertujuan untuk meningkatkan keterikatan pengguna (user engagement) dan memastikan arus informasi di lingkungan fakultas tetap dinamis.

---

## 4. Diagram Profil & Struktur (Profile & Structure)

Diagram ini menggambarkan bagaimana pengguna mengakses informasi profil kepemimpinan dan data dosen.

```mermaid
flowchart TD
    Mulai([Mulai]) --> OpenMenuProfil[Pengguna membuka Menu Profil]
    OpenMenuProfil --> SelectSubMenu{Pilih Sub-Menu}
    
    SelectSubMenu -- "Sambutan Dekan" --> Sambutan[Tampilkan Sambutan Dekan]
    SelectSubMenu -- "Visi-Misi" --> VisiMisi[Tampilkan Visi, Misi, Tujuan & Sasaran]
    SelectSubMenu -- "Data Dosen" --> Dosen[Tampilkan Direktori Dosen dari DB]
    SelectSubMenu -- "Struktur Orgn." --> Struktur[Tampilkan Bagan Organisasi]
    
    Sambutan --> End([End])
    VisiMisi --> End
    Dosen --> End
    Struktur --> End
```

### Penjelasan:
Halaman Profil dan Struktur Organisasi merupakan pusat informasi mengenai identitas fakultas. Pengguna dapat memilih berbagai sub-menu mulai dari Sambutan Dekan yang berisi visi kepemimpinan, hingga Visi-Misi sebagai landasan operasional pendidikan. Selain itu, sistem menyediakan direktori dosen yang datanya diambil langsung dari database untuk menjamin akurasi profil akademik pengajar. Struktur organisasi juga disajikan secara visual untuk memberikan kejelasan mengenai hierarki dan pembagian tugas di lingkungan fakultas, sehingga pengunjung mendapatkan gambaran menyeluruh tentang tata kelola Fakultas Ilmu Komputer.

---

## 5. Diagram Program Studi & Akademik (Academic & Departments)

Diagram ini merinci alur penelusuran informasi akademik dan detail program studi.

```mermaid
flowchart TD
    Mulai([Mulai]) --> OpenAkademik[Pengguna membuka Menu Akademik/Prodi]
    OpenAkademik --> Choice{Pilih Informasi}
    
    Choice -- "Detail Prodi" --> Prodi[Tampilkan Profil Informatika/PTI]
    Choice -- "Kurikulum" --> Kurikulum[Tampilkan Daftar Mata Kuliah & SKS]
    Choice -- "Kalender" --> Kalender[Tampilkan Jadwal Kegiatan Akademik]
    Choice -- "Fasilitas" --> Fasilitas[Tampilkan Lab & Sarpras]
    
    Prodi --> End([End])
    Kurikulum --> End
    Kalender --> End
    Fasilitas --> End
```

### Penjelasan:
- **Prodi**: Memberikan gambaran kompetensi lulusan dan prospek karir di bidang Informatika atau Pendidikan TI.
- **Fasilitas**: Dokumentasi fisik laboratorium untuk meyakinkan pengguna tentang kesiapan teknis pembelajaran.

---

## 6. Diagram Dokumen & Riset (Documents & Research)

Diagram ini menunjukkan alur akses dokumen strategis dan hasil karya ilmiah civitas akademika.

```mermaid
flowchart TD
    Mulai([Mulai]) --> OpenRiset[Pengguna membuka Menu Riset/Dokumen]
    OpenRiset --> Action{Pilih Konten}
    
    Action -- "Daftar Penelitian" --> Penelitian[Tampilkan Judul & Abstrak Riset]
    Action -- "Pengabdian" --> Pengabdian[Tampilkan Kegiatan Sosial Masyarakat]
    Action -- "Dokumen (SOP/Renstra)" --> Dokumen[Tampilkan Link Download/View PDF]
    
    Penelitian --> End([End])
    Pengabdian --> End
    Dokumen --> End
```

---

## 7. Diagram Kemahasiswaan & Organisasi (Student Affairs)

Diagram ini menggambarkan interaksi dengan lembaga kemahasiswaan.

```mermaid
flowchart TD
    Mulai([Mulai]) --> OpenMhs[Pengguna membuka Menu Kemahasiswaan]
    OpenMhs --> SelectOrg{Pilih Organisasi}
    
    SelectOrg -- "BEM" --> BEM[Tampilkan Struktur & Program BEM]
    SelectOrg -- "Himpunan" --> Hima[Tampilkan Aktivitas Hima Jurusan]
    SelectOrg -- "UKM" --> UKM[Tampilkan Unit Kegiatan Mahasiswa]
    
    BEM --> End([End])
    Hima --> End
    UKM --> End
```

---

---

## 8. Diagram Alumni

Alur melihat jaringan lulusan dan penelusuran karir.

```mermaid
flowchart TD
    Mulai([Mulai]) --> OpenAlumni[Pengguna membuka Menu Alumni]
    OpenAlumni --> FetchAlumni[Sistem mengambil data Alumni & Tracer Study]
    FetchAlumni --> ShowAlumni[Tampilkan Info Alumni & Tracer Study]
    ShowAlumni --> End([End])
```

### Penjelasan:
Modul Alumni difokuskan untuk membangun jejaring yang kuat antara fakultas dengan para lulusannya. Melalui menu ini, pengunjung dapat melihat hasil tracer study yang menggambarkan sebaran karir alumni serta kontribusi mereka di dunia industri. Data ini sangat krusial sebagai indikator keberhasilan program pendidikan sekaligus sebagai platform bagi mahasiswa aktif untuk mendapatkan inspirasi dari jejak langkah para senior mereka.
