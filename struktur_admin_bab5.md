# Dokumentasi dan Struktur Kode Admin (Bab 5)

Dokumen ini disusun untuk menjelaskan struktur teknis dan fungsionalitas sistem administrator pada Bab 5 (Implementasi dan Pengujian). Penjelasan dibagi menjadi dua bagian utama: pengelompokan struktur file dan deskripsi rinci fungsi setiap menu.

## 1. Struktur Navigasi dan Modul Admin

Berdasarkan fungsionalitasnya, modul-modul dalam direktori admin dikelompokkan ke dalam empat kategori utama sesuai dengan arsitektur sistem: **Main** (Utama), **Sistem** (Keamanan & Akun), **Content** (Konten Website), dan **Data** (Basis Data Akademik).

Berikut adalah tabel pemetaan file terhadap fungsinya dalam sistem:

| Kategori | Nama Modul / File | Fungsi Utama |
| :--- | :--- | :--- |
| **MAIN (UTAMA)** | `dashboard.php` | **Pusat Informasi:** Menampilkan ringkasan statistik dan akses cepat. |
| **SISTEM (AKSES)** | `login.php`, `proses_login.php` | **Autentikasi:** Menangani validasi login dan keamanan sesi. |
| | `profile.php`, `logout.php` | **Manajemen Akun:** Pengaturan profil admin dan keluar sistem. |
| **CONTENT (KONTEN)** | `kelola_berita.php`, `kelola_galeri.php` | **Publikasi:** Mengelola artikel berita, galeri foto, dan slider. |
| | `kelola_visimisi.php`, dll. | **Profil Web:** Mengelola informasi statis profil fakultas. |
| **DATA (AKADEMIK)** | `kelola_dosen.php`, `kelola_bem.php` | **Data SDM:** Mengelola data dosen dan organisasi mahasiswa. |
| | `kelola_kurikulum.php`, `kelola_lab.php` | **Akademik & Fasilitas:** Mengatur kurikulum dan fasilitas kampus. |
| | `kelola_penelitian.php` | **Tridharma:** Arsip penelitian dan pengabdian masyarakat. |

---

## 2. Penjelasan Fungsional Menu Sidebar

Bagian ini menjabarkan fungsi dari setiap menu yang terdapat pada *sidebar* (panel samping) halaman administrator. Penjelasan disusun dalam bentuk paragraf untuk memberikan gambaran komprehensif mengenai cara kerja sistem kepada pengguna.

### A. Kelompok Menu Utama (*Main*)

**Dashboard**
Halaman Dashboard merupakan tampilan awal yang disambut oleh administrator setelah berhasil melakukan *login*. Fungsi utama dari halaman ini adalah menyajikan ringkasan data statistik terkini, seperti jumlah dosen aktif, total berita yang telah dipublikasikan, serta ringkasan kegiatan penelitian. Selain itu, dashboard juga menyediakan akses cepat (*shortcuts*) ke fitur-fitur yang sering digunakan, sehingga memudahkan administrator dalam memantau kondisi data fakultas secara *real-time*.

### B. Kelompok Manajemen Konten

**Kelola Profil**
Menu ini berfungsi sebagai pusat kendali untuk informasi identitas fakultas. Di dalamnya terdapat sub-menu yang memungkinkan administrator untuk memperbarui Visi dan Misi, Struktur Organisasi, Data Civitas Akademika, serta sejarah singkat fakultas. Setiap perubahan yang dilakukan pada menu ini akan secara otomatis memperbarui halaman profil pada situs web publik, memastikan informasi yang diterima masyarakat selalu akurat dan mutakhir.

**Kelola Slider**
Fitur ini dirancang untuk mengelola gambar spanduk (*banner*) yang tampil di halaman beranda utama website. Administrator dapat mengunggah gambar promosi atau informasi penting dengan resolusi tinggi, serta mengatur urutan penampilannya. Slider yang menarik sangat krusial untuk memberikan kesan pertama yang profesional bagi pengunjung website.

**Kelola Berita**
Layanan ini memfasilitasi publikasi informasi terkini seputar kegiatan dan pencapaian fakultas. Melalui menu ini, admin dapat menulis artikel berita, menyertakan foto kegiatan, menentukan kategori berita, dan menetapkan tanggal publikasi. Sistem ini mendukung manajemen konten yang dinamis, memungkinkan penyebaran informasi secara cepat kepada mahasiswa dan khalayak umum.

**Kelola Galeri**
Modul ini didedikasikan untuk mendokumentasikan kegiatan-kegiatan visual fakultas. Administrator dapat mengelompokkan foto-foto kegiatan ke dalam album tertentu. Hal ini berfungsi sebagai arsip digital sekaligus sarana promosi visual yang menampilkan atmosfer akademik dan non-akademik di lingkungan kampus.

**Kelola Dosen**
Menu ini mengelola pangkalan data tenaga pengajar. Administrator dapat melakukan input data dosen secara lengkap, meliputi Nama, NIDN (Nomor Induk Dosen Nasional), Jabatan Akademik, hingga foto profil. Data ini terintegrasi dengan halaman direktori dosen di website utama, memudahkan mahasiswa atau pihak luar untuk mencari profil tenaga pengajar.

**Kelola Fasilitas (Ruangan & Laboratorium)**
Sub-menu ini bertugas untuk menginventarisasi sarana dan prasarana pendidikan. Administrator dapat mendata ruang kelas dan laboratorium yang tersedia, beserta deskripsi dan kapasitasnya. Informasi ini penting sebagai bentuk transparansi fasilitas penunjang akademik kepada calon mahasiswa maupun pemangku kepentingan (*stakeholders*).

### C. Kelompok Akademik

**Kelola Akademik (Kurikulum & Kalender)**
Bagian ini mengatur informasi vital terkait proses belajar mengajar. Pada menu Kurikulum, admin dapat mempublikasikan daftar mata kuliah dan sebarannya. Sedangkan pada menu Kalender Akademik, admin dapat mengunggah agenda kegiatan tahunan. Fitur ini sangat esensial bagi mahasiswa dalam merencanakan studi mereka.

**Kelola Kerjasama & Kemahasiswaan**
Menu ini memiliki dua fungsi strategis. Pertama, untuk mengelola data Badan Eksekutif Mahasiswa (BEM) dan struktur organisasinya. Kedua, untuk mendata mitra kerjasama instansi, baik dalam maupun luar negeri. Pendataan ini menunjukkan jejaring dan aktivitas kemahasiswaan yang aktif di fakultas.

**Kelola Penelitian & Pengabdian**
Merupakan implementasi dari Tridharma Perguruan Tinggi, menu ini digunakan untuk mengarsipkan publikasi ilmiah dan kegiatan pengabdian masyarakat yang dilakukan oleh civitas akademika. Data ini seringkali menjadi rujukan prestasi akademik dan kontribusi sosial fakultas.

**Kelola Dokumen Mutu**
Menu ini berfungsi sebagai repositori dokumen resmi fakultas, seperti Rencana Strategis (Renstra), Rencana Operasional (Renop), dan Standar Operasional Prosedur (SOP). Ketersediaan dokumen ini secara digital mendukung transparansi tata kelola dan memudahkan akses bagi pihak yang membutuhkan referensi regulasi internal.

### D. Kelompok Lainnya

**Data Pendaftaran**
Menu ini diperuntukkan bagi pengelolaan formulir digital yang masuk melalui website, seperti pendaftaran kegiatan seminar atau rekrutmen terbuka. Administrator dapat melihat, memverifikasi, dan mengelola data pendaftar yang masuk secara terpusat.

**Pengaturan (Profile & Keamanan)**
Fitur ini memberikan akses kepada administrator untuk mengelola akun pribadinya. Admin dapat mengubah informasi profil seperti nama dan email, serta melakukan penggantian kata sandi (*password*) secara berkala demi menjaga keamanan akses sistem dari pihak yang tidak berwenang.
