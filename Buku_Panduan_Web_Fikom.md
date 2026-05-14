# Buku Panduan Penggunaan Website Fakultas Ilmu Komputer (FIKOM)

Buku panduan ini disusun untuk memberikan pemahaman mengenai alur kerja dan penggunaan website Fakultas Ilmu Komputer. Panduan ini dibagi menjadi dua bagian utama: **Alur Pengunjung (Front-end)** dan **Alur Administrator (Back-end)**.

---

## Bagian 1: Alur Pengunjung (Front-end)

Bagian ini menjelaskan informasi dan fitur yang dapat diakses oleh publik (calon mahasiswa, mahasiswa aktif, dosen, dan masyarakat umum).

### 1. Halaman Beranda (Home)
Halaman utama yang pertama kali dilihat oleh pengunjung. Terdiri dari:
- **Slider Utama:** Menampilkan informasi penting dan *call-to-action* untuk navigasi cepat.
- **Statistik Fakultas:** Data kuantitatif civitas (Jumlah mahasiswa, dosen, dll) yang memberikan bukti sosial.
- **Berita Terbaru:** Jendela informasi terkini seputar kegiatan dan prestasi fakultas.
- **Sekilas Tentang Fakultas:** Profil ringkas yang memberikan gambaran umum fakultas dan akses detail prodi.
- **Informasi Akademik Cepat:** *Shortcut* langsung ke Kalender Akademik, Kurikulum, Dosen, dan Laboratorium.
- **Mitra Kerja Sama:** Menampilkan logo-logo instansi mitra dalam bentuk korsel bergulir otomatis.

### 2. Navigasi Utama (Menu Header)
Pengunjung dapat menelusuri website melalui hierarki menu navigasi berikut:
- **Profil:** Meliputi Sambutan Dekan, Visi Misi Tujuan dan Sasaran, Profil Dosen, Struktur Organisasi, dan Pendaftaran Mahasiswa Baru.
- **Program Studi:** Rincian informasi mengenai S1 Informatika dan S1 Pendidikan Teknologi Informasi (kurikulum, prospek karir).
- **Fasilitas:** Informasi mengenai Sarana Prasarana (fasilitas fisik umum) dan Laboratorium (fasilitas praktikum spesifik).
- **Akademik:** Mengakses Kalender Akademik (jadwal kuliah) dan Kurikulum perkuliahan.
- **Dokumen:** Arsip dokumen perencanaan seperti Rencana Operasional (Renop), Rencana Strategis (Renstra), dan SOP Layanan.
- **Riset:** Menampilkan dokumentasi karya ilmiah melalui menu Penelitian dan Pengabdian Masyarakat.
- **Kemahasiswaan:** Mewadahi aktivitas kemahasiswaan dengan sub-menu BEM, UKM, dan Himpunan Mahasiswa.
- **Alumni:** Wadah silaturahmi alumni yang berisi portal informasi dan formulir pendaftaran.

### 3. Alur Pendaftaran Mahasiswa Baru (Integrasi Front-end ke Back-end)
1. Calon mahasiswa mengakses menu **Profil > Pendaftaran**.
2. Membaca persyaratan dan mengisi formulir pendaftaran secara online.
3. Data yang dikirimkan akan terekam ke dalam database dan secara *real-time* masuk ke panel Administrator untuk ditinjau lebih lanjut.

---

## Bagian 2: Alur Administrator (Back-end)

Sistem admin digunakan untuk mengelola seluruh konten dinamis pada website front-end secara efisien tanpa harus merubah kode pemrograman website.

### 1. Proses Autentikasi (Login dan Keamanan)
- Admin mengakses URL direktori `/admin`.
- Sistem akan meminta *Username* serta *Password* (dilengkapi fitur mata (*toggle visibility*) untuk melihat password).
- Jika kredensial tervalidasi dengan database, admin akan diizinkan masuk ke **Dashboard Administrator**.
- Tersedia fitur Lupa Kata Sandi untuk pemulihan, dan fitur *Logout* untuk mengakhiri sesi pengelolaan demi keamanan.

### 2. Manajemen Dashboard dan Navigasi Admin
Sistem navigasi admin terbagi menjadi beberapa kelompok manajemen utama:

#### A. Kelola Konten & Profil Sistem
- **Visi Misi & Tentang Fakultas:** Mengedit dan memformat teks narasi visi misi serta sejarah institusi menggunakan kelengkapan *text-editor*.
- **Struktur Organisasi & Slider:** Mengunggah file gambar (JPG/PNG) terkini mengenai struktur organisasi dan *banner* depan (slider).
- **Data Civitas (Fakta Fakultas):** Mengelola langsung angka-angka statistik yang akan ditampilkan di Beranda.
- **Kelola Berita:** Administrator memiliki otoritas menambah, memodifikasi isi, serta mencabut penayangan sebuah artikel berita.

#### B. Kelola Akademik & Fasilitas Fisik
- **Kurikulum & Dosen:** Mendata setiap mata kuliah per semester serta mengelola daftar nama, kompetensi, dan profil seluruh dosen.
- **Ruangan & Laboratorium:** Inventarisasi fasilitas dengan menyebutkan spesifikasi lengkap serta peruntukkannya.
- **Kalender Akademik:** Mengunggah edaran jadwal atau lini masa kegiatan dalam bentuk dokumen/gambar per semester.

#### C. Kelola Tridharma, BEM, & Kerjasama
- **Penelitian & Pengabdian:** Menginput basis data kegiatan tridharma dosen yang memuat judul, pelaksanaan, anggaran, serta bisa disertakan laporan fisik (PDF).
- **BEM:** Merubah rincian kabinet BEM yang sedang bertugas.
- **Kerjasama:** Menambah deretan logo dan nama instansi swasta/pemerintah yang berkolaborasi dengan fakultas.

#### D. Kelola Dokumen, Arsip, SOP & Regulasi
- **Dokumen Fakultas, Renstra, dan SOP:** Manajemen file terpusat untuk menyimpan serta membagikan dokumen-dokumen surat keputusan, renstra 5 tahunan, dan SOP akademik agar dapat diakses oleh publik (khususnya untuk kepentingan akreditasi).

#### E. Kelola Pendaftaran (Menu Feedback/Interaksi)
- **Data Pendaftaran:** Panel verifikasi bagi admin (terutama kepanitiaan PMB) untuk meninjau data calon mahasiswa yang masuk dari web publik.
- Administrator bisa melihat riwayat pendaftar secara menyeluruh, memantau rincian kontak (bahkan berinteraksi ke WhatsApp pendaftar via klik langsung), memvalidasi status, serta menghapus rekaman data yang dianggap *spam*.

### 3. Cara Mengelola Data (Standar Operasional Input Admin)
Sistem administrasi dirancang untuk mempermudah administrator dalam melakukan CRUD (Create, Read, Update, Delete) melalui implementasi antar-muka *Modal Popup*:
1. **Tambah Data (Create):** Administrator menekan tombol hijau **"Tambah"** atau **"Add"**. Formulir kotak (*popup*) akan muncul melayang di layar. Admin cukup mengisi data lalu menekan tombol "Simpan". Tabel akan memuat data terbaru secara otomatis.
2. **Lihat/Detail Data (Read):** Pada tabel baris terkait, admin bisa menekan ikon mata/detail untuk membaca riwayat data secara komplit.
3. **Edit Data (Update):** Administrator dapat menekan tombol pensil/edit pada baris data, menyesuaikan rincian pada formulir yang timbul, kemudian "Simpan" kembali.
4. **Hapus Data (Delete):** Admin menekan tombol tempat sampah berwarna merah untuk memusnahkan data; sistem akan meminta konfirmasi final sebelum mengeksekusi penghapusan dari database untuk menghindari *human error*.

---
*Dokumen Buku Panduan ini dipublikasikan untuk menjadi rujukan resmi bagi civitas akademika Fakultas Ilmu Komputer guna memahami, menavigasi, serta mengelola tata letak dan informasi Website secara berkesinambungan.*
