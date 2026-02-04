# Dokumentasi dan Struktur Kode Admin (Bab 5)

Dokumen ini disusun untuk menjelaskan struktur teknis, fungsionalitas, dan alur kerja sistem administrator pada Bab 5 (Implementasi dan Pengujian). Penjelasan ini disatukan dalam satu dokumen lengkap mencakup struktur navigasi, detail fungsi menu, dan alur sistem.

## 1. Struktur Navigasi Dashboard

Berdasarkan arsitektur aplikasi, fitur-fitur pada halaman administrator dikelompokkan menjadi empat segmen utama: **Sistem**, **Content**, **Data**, dan **Main**.

| **Sistem** | **Content** | **Data** | **Main** |
| :--- | :--- | :--- | :--- |
| **User Management**<br>• Pengaturan (Profile)<br>• Login / Logout<br><br>**Feedback**<br>• Data Pendaftaran | **Artikel & Berita**<br>• Kelola Berita<br><br>**Profil Web**<br>• Kelola Profil (Visi Misi, Sejarah, Struktur, Civitas)<br>• Kelola Slider<br><br>**Media**<br>• Kelola Galeri | **Akademik & SDM**<br>• Kelola Dosen<br>• Kelola Akademik (Kurikulum, Kalender)<br>• Kelola Fasilitas (Ruangan, Lab)<br><br>**Tridharma**<br>• Penelitian & Pengabdian<br>• Kerjasama (Mitra, BEM)<br><br>**Arsip**<br>• Kelola Dokumen (SOP, Renstra, Renop) | **Overview**<br>• Dashboard Statistik<br>• Ringkasan Aktivitas |

---

## 2. Penjelasan Fungsional Menu dan Sub-Menu

Bagian ini menjabarkan fungsi secara rinci dari setiap menu dan sub-menu yang terdapat dalam panel admin dalam bentuk narasi deskriptif.

### A. Bagian Main (Utama)

**Menu Dashboard**
Halaman Dashboard merupakan antarmuka utama yang pertama kali diakses oleh administrator setelah berhasil masuk ke sistem. Halaman ini dirancang untuk memberikan ringkasan eksekutif mengenai kondisi data terkini. Di dalamnya terdapat kartu statistik (*counter*) yang menampilkan jumlah total dosen, berita, penelitian, dan fasilitas secara *real-time*. Selain itu, terdapat tabel ringkasan aktivitas terbaru yang memudahkan admin memantau data yang baru saja ditambahkan tanpa perlu menelusuri menu satu per satu.

### B. Bagian Content (Manajemen Konten)

**Menu Kelola Profil**
Menu ini berfungsi sebagai pusat kendali identitas fakultas yang ditampilkan di website publik. Di dalamnya terdapat beberapa sub-menu dengan fungsi spesifik. Sub-menu **Visi Misi** menyediakan editor teks yang memungkinkan admin memperbarui naskah visi dan misi fakultas. Sub-menu **Struktur Organisasi** digunakan untuk mengunggah gambar bagan struktur organisasi terbaru. Sub-menu **Data Civitas** berfungsi untuk mengelola angka statistik fakultas seperti jumlah mahasiswa aktif dan alumni. Terakhir, sub-menu **Tentang Fakultas** digunakan untuk menyunting narasi sejarah dan profil singkat fakultas.

**Menu Kelola Slider**
Menu ini didedikasikan untuk pengelolaan visual halaman depan website. Administrator dapat menambah, menghapus, atau mengganti gambar spanduk (*banner*) utama yang berputar otomatis. Fitur ini memungkinkan admin untuk menjaga tampilan beranda tetap segar dan relevan dengan kegiatan atau promosi terbaru fakultas.

**Menu Kelola Berita**
Sebagai modul jurnalistik utama, menu ini memungkinkan administrator untuk mempublikasikan informasi terkini kepada masyarakat. Melalui sub-menu **Semua Berita**, admin dapat menulis artikel baru menggunakan fitur *Rich Text Editor*, menyematkan foto utama, serta menentukan kategori berita. Sistem ini juga memfasilitasi pengubahan atau penghapusan artikel yang sudah tidak relevan.

**Menu Kelola Galeri**
Menu ini dirancang untuk kebutuhan dokumentasi visual kegiatan kampus. Melalui modul ini, administrator dapat mengunggah foto-foto kegiatan dalam jumlah banyak sekaligus (*bulk upload*). Setiap album foto dapat diberikan judul dan deskripsi singkat, sehingga pengunjung website dapat melihat rekam jejak aktivitas akademik maupun non-akademik di lingkungan fakultas.

### C. Bagian Data (Basis Data Akademik)

**Menu Kelola Dosen**
Menu ini mengelola pangkalan data sumber daya manusia, khususnya tenaga pengajar. Melalui sub-menu **Daftar Dosen**, administrator dapat memasukkan dan memperbarui profil lengkap dosen, mulai dari Nomor Induk Dosen Nasional (NIDN), jabatan akademik, riwayat pendidikan terakhir, hingga foto profil. Data ini terintegrasi langsung dengan halaman direktori dosen di website publik.

**Menu Kelola Fasilitas**
Menu ini bertujuan untuk menginventarisasi sarana dan prasarana pendidikan. Pada sub-menu **Ruangan**, admin dapat mendata ruang kelas dan ruang serbaguna beserta kapasitas dan fasilitas pendukungnya. Sedangkan pada sub-menu **Laboratorium**, admin dapat mencatat daftar laboratorium komputer atau praktikum yang dimiliki fakultas untuk informasi calon mahasiswa.

**Menu Kelola Akademik**
Fitur ini mengatur informasi vital terkait proses belajar mengajar. Sub-menu **Kurikulum** digunakan untuk mengelola daftar mata kuliah yang ditawarkan, lengkap dengan kode mata kuliah dan bobot SKS-nya. Sub-menu **Kalender Akademik** memungkinkan admin mengunggah jadwal kegiatan akademik semester berjalan, baik dalam format dokumen maupun gambar.

**Menu Kelola Kerjasama**
Menu ini mencatat jejaring eksternal dan internal fakultas. Sub-menu **mitra Kerjasama** mendata daftar instansi pemerintah atau swasta yang memiliki perjanjian formal (MoU/MoA) dengan fakultas. Sementara itu, sub-menu **BEM** digunakan untuk mengelola profil dan struktur organisasi Badan Eksekutif Mahasiswa.

**Menu Tridharma (Penelitian & Pengabdian)**
Menu ini merupakan repositori digital kinerja akademik dosen. Sub-menu **Kelola Penelitian** mencatat judul-judul penelitian yang dilakukan dosen beserta tahun pelaksanaannya. Sub-menu **Kelola Pengabdian** mengarsipkan kegiatan pengabdian kepada masyarakat (PkM). Data ini penting sebagai bentuk transparansi kinerja akademik fakultas.

**Menu Kelola Dokumen**
Menu ini berfungsi sebagai pusat unduhan dokumen resmi. Administrator dapat mengunggah dokumen regulasi seperti Rencana Operasional (Renop), Rencana Strategis (Renstra), dan Standar Operasional Prosedur (SOP) layanan akademik. Dokumen-dokumen ini kemudian dapat diunduh secara bebas oleh dosen maupun mahasiswa yang membutuhkan.

### D. Bagian Sistem (Pengaturan & Keamanan)

**Menu Data Pendaftaran (Feedback)**
Menu ini berfungsi sebagai kotak masuk (*inbox*) untuk menampung interaksi dari pengguna website. Data yang masuk melalui formulir pendaftaran *online* atau halaman kontak akan tersimpan di sini. Administrator dapat memantau, memverifikasi, dan menindaklanjuti pesan atau pendaftaran yang masuk dari pihak luar.

**Menu Pengaturan Akun**
Menu ini memberikan kontrol privasi kepada administrator sistem. Di sini, pengguna admin dapat mengubah informasi akun mereka, seperti nama pengguna (*username*), alamat email, dan kata sandi (*password*). Fitur ini sangat krusial untuk menjaga keamanan sistem dari akses pihak yang tidak berwenang.

---

## 3. Alur Kerja Sistem (System Workflow)

Bagian ini menjelaskan mekanisme teknis bagaimana pengguna berinteraksi dengan sistem dalam bentuk narasi alur.

### 1. Alur Autentikasi (Sistem)
Proses dimulai ketika pengguna mengakses alamat panel admin. Sistem akan secara otomatis memeriksa status otorisasi pengguna. Jika pengguna belum melakukan *login*, sistem akan mengalihkan tampilan ke halaman Login. Pengguna kemudian memasukkan nama pengguna dan kata sandi. Sistem akan memverifikasi kredensial tersebut dengan data di basis data. Jika cocok, sistem membuat sesi keamanan unik dan mengizinkan pengguna masuk ke Dashboard.

### 2. Alur Manajemen Data via Modal
Untuk efisiensi antarmuka pengguna, modul-modul seperti Berita dan Dosen menggunakan mekanisme *Modal Popup*. Ketika admin menekan tombol "Tambah", sebuah jendela formulir akan muncul di atas halaman aktif tanpa memuat ulang (*reload*) keseluruhan halaman. Setelah admin mengisi data dan menyimpannya, sistem akan memproses data tersebut di latar belakang dan memperbarui tabel data secara otomatis.

### 3. Alur Dokumentasi Galeri
Pada modul Galeri, sistem menerapkan alur kerja unggah cepat. Formulir unggah foto ditempatkan langsung (*inline*) di bagian atas halaman data. Administrator cukup memilih file foto dari perangkat komputer, memberikan judul, dan menekan tombol unggah. Foto tersebut akan langsung diproses oleh server, disimpan dalam direktori penyimpanan, dan ditampilkan pada daftar galeri di bawah formulir dalam hitungan detik.

---

## 4. Struktur File & Database

Secara teknis, kode program disusun sebagai berikut:

| Kategori Struktur | File Terkait | Tabel Database Utama |
| :--- | :--- | :--- |
| **Main** | `dashboard.php`, `index.php` | - |
| **Sistem** | `login.php`, `logout.php`, `profile.php`, `kelola_pendaftaran.php` | `users`, `pendaftaran` |
| **Content** | `kelola_berita.php`, `kelola_slider.php`, `kelola_galeri.php`, `kelola_visimisi.php` | `berita`, `slider`, `galeri`, `halaman_statis` |
| **Data** | `kelola_dosen.php`, `kelola_kurikulum.php`, `kelola_fasilitas.php`, `kelola_penelitian.php` | `dosen`, `matakuliah`, `ruangan`, `penelitian`, `pengabdian`, `dokumen` |
