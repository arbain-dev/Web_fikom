# Dokumentasi dan Struktur Kode Admin (Bab 5)

Dokumen ini disusun untuk menjelaskan struktur teknis, fungsionalitas, dan alur kerja sistem administrator pada Bab 5 (Implementasi dan Pengujian). Penjelasan ini disatukan dalam satu dokumen lengkap mencakup struktur navigasi, detail fungsi menu, dan alur sistem.

## 1. Struktur Navigasi Dashboard

Berdasarkan arsitektur aplikasi, fitur-fitur pada halaman administrator dikelompokkan menjadi empat segmen utama: **Sistem**, **Content**, **Data**, dan **Main**.

| **Sistem** | **Content** | **Data** | **Main** |
| :--- | :--- | :--- | :--- |
| **User Management**<br>• Pengaturan (Profile)<br>• Login / Logout<br><br>**Feedback**<br>• Data Pendaftaran | **Artikel & Berita**<br>• Kelola Berita<br><br>**Profil Web**<br>• Visi Misi<br>• Struktur Organisasi<br>• Data Civitas<br>• Tentang Fakultas<br>• Kelola Slider<br><br>**Media**<br>• Kelola Galeri | **Akademik & SDM**<br>• Kelola Dosen<br>• Kurikulum<br>• Kalender<br>• Ruangan<br>• Laboratorium<br><br>**Tridharma**<br>• Penelitian & Pengabdian<br>• BEM<br>• Kerjasama<br><br>**Arsip**<br>• Dokumen Fakultas<br>• Rencana Strategis<br>• SOP | **Overview**<br>• Dashboard Statistik<br>• Ringkasan Aktivitas |

---

## 2. Penjelasan Detail Fungsi Menu dan Sub-Menu

Berikut adalah penjelasan mendalam mengenai fungsi dan kegunaan dari setiap halaman dan menu yang terdapat pada panel administrator, dimulai dari akses masuk hingga pengelolaan data.

### A. Halaman Login Administrator

Halaman Login merupakan gerbang keamanan utama untuk mengakses sistem backend administrator. Antarmuka halaman ini didesain dengan gaya modern dan minimalis, menggunakan latar belakang gedung fakultas yang diburamkan (*blur*) untuk memberikan fokus visual pada panel login di tengah layar.

Elemen-elemen kunci pada halaman ini meliputi:
1.  **Identitas Visual**: Menampilkan logo resmi fakultas di bagian atas panel untuk validasi institusi.
2.  **Formulir Autentikasi**: Menyediakan kolom input untuk *username* dan *password*. Kolom sandi dilengkapi dengan fitur *toggle visibility* (ikon mata) yang memungkinkan pengguna memeriksa input sandi mereka sebelum dikirim, meningkatkan kenyamanan pengguna (User Experience).
3.  **Link Lupa Kata Sandi**: Fitur bantuan bagi admin yang mengalami kendala akses akun.
4.  **Navigasi Kembali**: Tautan "Kembali ke Beranda" di bagian bawah memungkinkan pengguna untuk membatalkan proses login dan kembali ke halaman utama pengunjung (Front-end).

---

### B. Kelompok Menu Profil (Kelola Profil)

**1. Sub-menu: Visi Misi**
Halaman ini adalah editor konten vital yang menampilkan visi dan misi resmi fakultas. Melalui antarmuka ini, administrator diberikan wewenang untuk menyunting teks visi dan misi menggunakan fitur *text editor* yang lengkap. Fungsi ini sangat krusial karena visi misi merupakan identitas utama institusi yang menjadi acuan bagi seluruh sivitas akademika. Perubahan yang dilakukan di halaman ini akan secara otomatis memperbarui tampilan di halaman "Tentang Kami" pada website publik, memastikan masyarakat selalu mendapatkan informasi visi misi yang mutakhir tanpa perlu mengubah kode sumber website.

**2. Sub-menu: Struktur Organisasi**
Sub-menu ini berfungsi sebagai manajemen tampilan hierarki kepemimpinan di fakultas. Administrator dapat mengunggah gambar bagan struktur organisasi terbaru (biasanya dalam format JPG atau PNG) yang memuat posisi mulai dari Dekan, Wakil Dekan, hingga Kepala Program Studi. Fitur ini dirancang untuk mempermudah pembaruan informasi secara visual ketika terjadi pergantian pejabat struktural, sehingga pengunjung website dapat segera mengetahui susunan manajemen fakultas yang sedang menjabat tanpa adanya kekeliruan informasi.

**3. Sub-menu: Data Civitas**
Data Civitas (atau Data Fakta) adalah modul pengelolaan data statistik kuantitatif yang menjadi indikator performa fakultas. Di halaman ini, administrator dapat memperbarui angka-angka strategis seperti Jumlah Mahasiswa Aktif, Jumlah Dosen, Jumlah Program Studi, dan Jumlah Alumni. Data ini ditampilkan secara menonjol di halaman beranda website (*homepage*) sebagai "Fakta Fakultas" untuk memberikan gambaran cepat mengenai skala dan kapasitas institusi kepada calon mahasiswa maupun asesor akreditasi.

**4. Sub-menu: Tentang Fakultas**
Halaman ini didedikasikan untuk pengelolaan narasi profil, sejarah, dan latar belakang berdirinya fakultas. Administrator dapat menuliskan atau menyunting artikel panjang mengenai sejarah perkembangan fakultas dari masa ke masa, nilai-nilai yang dianut, serta tujuan pendidikan. Konten ini menjadi referensi utama bagi masyarakat umum yang ingin mengenal lebih dalam mengenai jati diri dan rekam jejak institusi pendidikan tersebut.

---

### C. Kelompok Menu Fasilitas (Kelola Fasilitas)

**5. Sub-menu: Ruangan**
Sub-menu ini merupakan sistem inventaris aset ruangan yang dimiliki oleh fakultas. Administrator bertugas mendata setiap ruang kelas, ruang seminar, dan aula, lengkap dengan atribut detailnya seperti kapasitas kursi, lokasi lantai, dan kelengkapan fasilitas (misalnya ketersediaan AC, Proyektor, dan Papan Tulis). Informasi ini ditampilkan di website agar mahasiswa dan dosen dapat mengetahui ketersediaan dan spesifikasi ruangan yang dapat digunakan untuk kegiatan perkuliahan maupun kegiatan kemahasiswaan.

**6. Sub-menu: Laboratorium**
Laboratorium adalah sarana penunjang utama kegiatan praktikum. Melalui sub-menu ini, administrator mengelola profil laboratorium komputer, laboratorium bahasa, atau laboratorium khusus lainnya. Penjelasan yang diinput meliputi nama laboratorium, jenis praktikum yang didukung, serta deskripsi perangkat keras atau lunak unggulan yang tersedia. Hal ini bertujuan untuk menunjukkan kesiapan unggulan infrastruktur praktikum fakultas kepada calon mahasiswa dan orang tua yang mencari jaminan kualitas pendidikan praktik.

---

### D. Kelompok Menu Akademik (Kelola Akademik)

**7. Sub-menu: Kurikulum**
Halaman ini mengelola basis data mata kuliah yang ditawarkan oleh setiap program studi. Administrator dapat menambah, menghapus, atau mengedit daftar mata kuliah per semester, lengkap dengan Kode Mata Kuliah, Nama Mata Kuliah, dan bobot SKS. Data kurikulum ini sangat transparan dan penting bagi mahasiswa untuk merencanakan pengambilan mata kuliah (KRS) serta bagi calon mahasiswa untuk melihat gambaran materi studi yang akan mereka pelajari selama kuliah.

**8. Sub-menu: Kalender**
Sub-menu Kalender Akademik berfungsi sebagai papan pengumuman jadwal kegiatan akademik semester berjalan dalam format digital. Administrator dapat mengunggah dokumen (PDF) atau gambar yang berisi lini masa kegiatan penting, seperti masa pembayaran SPP, masa pengisian KRS, jadwal Ujian Tengah Semester (UTS), dan Ujian Akhir Semester (UAS). Fitur ini memastikan seluruh dosen dan mahasiswa memiliki acuan waktu yang seragam dalam menjalankan aktivitas akademik pada semester tersebut.

---

### E. Kelompok Menu Tridharma & Kerjasama

**9. Sub-menu: Penelitian**
Sub-menu ini dirancang untuk mendata aktivitas penelitian yang dilakukan oleh dosen. Administrator dapat mencatat detail penelitian yang meliputi Judul Penelitian, Nama Peneliti, Tahun Pelaksanaan, Status (Draft, Sedang Berjalan, atau Selesai), serta sumber dan jumlah dana hibah. Selain itu, fitur ini mendukung pengunggahan dokumen digital berupa Proposal dan Laporan Akhir penelitian. Data ini penting untuk pemetaan roadmap penelitian fakultas serta pelaporan beban kerja dosen (BKD) setiap semester.

**10. Sub-menu: Pengabdian Masyarakat**
Fitur ini berfungsi untuk mendokumentasikan kegiatan Tri Dharma perguruan tinggi aspek pengabdian. Administrator menginput data kegiatan pengabdian meliputi Judul Kegiatan, Pelaksana, Tanggal Kegiatan, dan Deskripsi singkat. Sistem juga menyediakan fasilitas unggah laporan kegiatan (PDF/DOC) sebagai bukti fisik pelaksanaan. Database pengabdian ini menjadi arsip vital untuk kebutuhan akreditasi program studi maupun fakultas.

**11. Sub-menu: BEM (Badan Eksekutif Mahasiswa)**
Halaman ini dikhususkan untuk mengelola profil organisasi pemerintahan mahasiswa tingkat fakultas. Administrator dapat memperbarui deskripsi BEM, visi misi organisasi, logo kabinet, serta struktur pengurus BEM periode berjalan. Penampilan profil BEM di website fakultas merupakan bentuk dukungan institusi terhadap kegiatan ekstrakurikuler dan pengembangan *soft skill* mahasiswa dalam berorganisasi dan kepemimpinan.

**12. Sub-menu: Kerjasama**
Sub-menu ini berfungsi sebagai pangkalan data kemitraan strategis fakultas. Administrator mencatat daftar instansi, baik perusahaan swasta, instansi pemerintah, maupun perguruan tinggi lain, yang telah menandatangani nota kesepahaman (MoU) atau perjanjian kerjasama (MoA). Informasi ini penting untuk menunjukkan jejaring (*networking*) luas yang dimiliki fakultas dalam rangka penyaluran magang, penelitian bersama, atau rekruitmen lulusan.

---

### F. Kelompok Menu Arsip Dokumen (Kelola Dokumen)

**13. Sub-menu: Dokumen Fakultas**
Menu ini berfungsi sebagai repositori digital untuk menyimpan dan mempublikasikan dokumen-dokumen resmi fakultas. Pada halaman ini, administrator dapat mengelola daftar dokumen dengan informasi detail meliputi **Nama Dokumen** dan **Deskripsi** singkat mengenai isi dokumen tersebut. Jenis dokumen yang dapat diunggah bervariasi, mulai dari Surat Keputusan (SK) Kepanitiaan, Laporan Pertanggungjawaban Kegiatan, Laporan Pelaksanaan Ujian (UAS/UTS), hingga Surat Penetapan Mahasiswa Berprestasi. Setiap entri dokumen dilengkapi dengan fitur **Lihat** untuk mengunduh atau meninjau file asli, serta tombol aksi untuk mengubah atau menghapus data. Fungsionalitas ini memastikan arsip fakultas tersimpan rapi dan mudah diakses oleh pihak yang berkepentingan secara transparan.

**14. Sub-menu: Rencana Strategis (Renstra)**
Rencana Strategis (Renstra) adalah dokumen perencanaan jangka panjang (biasanya 5 tahunan) yang menjadi arah pengembangan fakultas. Melalui sub-menu ini, administrator mempublikasikan file Renstra agar dapat diakses oleh publik. Hal ini merupakan bentuk transparansi manajemen dan akuntabilitas fakultas dalam mencapai visi jangka panjangnya, serta menjadi dokumen wajib dalam proses visitasi akreditasi.

**15. Sub-menu: SOP (Standar Operasional Prosedur)**
Halaman ini memuat kumpulan dokumen prosedur baku layanan akademik dan administrasi. Administrator mengunggah file SOP untuk berbagai layanan, seperti SOP Pengajuan Judul Skripsi, SOP Cuti Akademik, atau SOP Peminjaman Alat. Ketersediaan dokumen SOP di website menjamin standar pelayanan yang konsisten dan memudahkan mahasiswa memahami alur birokrasi yang benar dalam mengurus administrasi perkuliahan.

---

### G. Kelompok Menu Data Pendaftaran (Feedback)

**16. Halaman Data Pendaftaran Mahasiswa**
Halaman Data Pendaftaran Mahasiswa dirancang khusus sebagai pusat pengelolaan data calon mahasiswa baru yang mendaftar melalui situs web. Pada halaman ini, administrator dapat mengakses tabel data responsif yang memuat informasi penting pendaftar, meliputi identitas diri (Nama Lengkap dan NIK), pilihan akademik (Program Studi dan Jalur Pendaftaran), serta informasi kontak berupa nomor WhatsApp yang terintegrasi dengan fitur *click-to-chat* untuk memudahkan komunikasi.

Selain itu, administrator dapat memantau status seleksi penerimaan setiap calon mahasiswa secara *real-time*. Untuk pengelolaan lebih lanjut, tersedia tombol aksi yang memungkinkan administrator melihat detail biodata lengkap melalui ikon detail (berwarna kuning), atau menghapus data yang tidak valid menggunakan ikon hapus (berwarna merah). Fitur ini memiliki fungsi vital bagi panitia Penerimaan Mahasiswa Baru (PMB) dalam melakukan verifikasi berkas dan pendataan ulang secara efisien dan terpusat.

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
| **Content** | `kelola_berita.php`, `kelola_slider.php`, `kelola_galeri.php`, `kelola_visimisi.php`, `kelola_struktur.php`, `kelola_fakta.php`, `kelola_tentangfak.php` | `berita`, `slider`, `galeri`, `halaman_statis` |
| **Data** | `kelola_dosen.php`, `kelola_kurikulum.php`, `kelola_ruangan.php`, `kelola_lab.php`, `kelola_penelitian.php`, `kelola_bem.php`, `kelola_kerjasama.php` | `dosen`, `matakuliah`, `ruangan`, `penelitian`, `pengabdian`, `dokumen`, `kerjasama` |

