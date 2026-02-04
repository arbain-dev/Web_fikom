# Dokumentasi dan Struktur Kode Admin (Bab 5)

Dokumen ini disusun untuk menjelaskan struktur teknis, fungsionalitas, dan alur kerja sistem administrator pada Bab 5 (Implementasi dan Pengujian). Penjelasan ini disatukan dalam satu dokumen lengkap mencakup struktur navigasi, detail fungsi menu, dan alur sistem.

## 1. Struktur Navigasi Dashboard

Berdasarkan arsitektur aplikasi, fitur-fitur pada halaman administrator dikelompokkan menjadi empat segmen utama: **Sistem**, **Content**, **Data**, dan **Main**. Berikut adalah diagram struktur menu admin:

| **Sistem** | **Content** | **Data** | **Main** |
| :--- | :--- | :--- | :--- |
| **User Management**<br>• Pengaturan (Profile)<br>• Login / Logout<br><br>**Feedback**<br>• Data Pendaftaran | **Artikel & Berita**<br>• Kelola Berita<br><br>**Profil Web**<br>• Kelola Profil (Visi Misi, Sejarah)<br>• Kelola Slider<br><br>**Media**<br>• Kelola Galeri | **Akademik & SDM**<br>• Kelola Dosen<br>• Kelola Akademik (Kurikulum)<br>• Kelola Fasilitas (Ruangan/Lab)<br><br>**Tridharma**<br>• Penelitian & Pengabdian<br>• Kerjasama<br><br>**Arsip**<br>• Kelola Dokumen (SOP/Renstra) | **Overview**<br>• Dashboard Statistik<br>• Ringkasan Aktivitas |

---

## 2. Penjelasan Fungsional Menu (Detail)

Bagian ini menjabarkan fungsi dari setiap menu yang terdapat dalam blok struktur di atas.

### A. Bagian Main (Utama)
*   **Dashboard**: Halaman yang pertama kali muncul saat login. Berfungsi sebagai pusat informasi yang menampilkan kartu statistik (jumlah dosen, berita, dll) dan tabel ringkasan data terbaru untuk pemantauan cepat.

### B. Bagian Content (Manajemen Konten)
Kelompok ini berfokus pada apa yang tampil bagi pengunjung website (front-end).
*   **Kelola Profil**: Mengatur informasi statis identitas fakultas seperti Visi Misi, Struktur Organisasi, dan Sejarah.
*   **Kelola Slider**: Mengelola gambar spanduk utama (*banner*) di halaman beranda untuk keperluan promosi atau informasi penting.
*   **Kelola Berita**: Modul untuk menulis dan mempublikasikan artikel kegiatan kampus, pengumuman, atau info akademik terbaru.
*   **Kelola Galeri**: Fitur untuk mengunggah dan mengelompokkan dokumentasi foto kegiatan fakultas.

### C. Bagian Data (Basis Data Akademik)
Kelompok ini berfokus pada pengelolaan data mentah yang mendukung operasional fakultas.
*   **Kelola Dosen**: Database profil tenaga pengajar (NIDN, Jabatan, Pendidikan) yang terintegrasi dengan direktori staf.
*   **Kelola Fasilitas**: Inventarisasi sarana prasarana seperti Ruang Kelas dan Laboratorium Komputer.
*   **Kelola Akademik**: Mengatur Kalender Akademik dan Daftar Mata Kuliah (Kurikulum) yang berlaku.
*   **Penelitian & Pengabdian**: Mengarsipkan judul dan data publikasi ilmiah serta kegiatan sosial para dosen/mahasiswa.
*   **Kerjasama**: Mendata mitra instansi pemerintah atau swasta yang bekerjasama dengan fakultas.
*   **Kelola Dokumen**: Repositori file digital seperti Renstra (Rencana Strategis) dan SOP yang bisa diunduh publik.

### D. Bagian Sistem (Pengaturan & Keamanan)
Kelompok ini berkaitan dengan kontrol akses dan interaksi pengguna.
*   **Data Pendaftaran**: Mengelola data masuk dari formulir pendaftaran online (feedback/input dari luar).
*   **Pengaturan (Profile)**: Fitur bagi admin untuk mengubah nama, email, dan kata sandi akun sendiri.
*   **Login / Logout**: Gerbang autentikasi keamanan sistem untuk memastikan hanya pengguna berhak yang dapat mengakses panel admin.

---

## 3. Alur Kerja Sistem (System Workflow)

Bagian ini menjelaskan mekanisme teknis bagaimana pengguna berinteraksi dengan sistem.

### 1. Alur Autentikasi (Sistem)
*   **Login**: Pengguna mengakses `/admin`. Sistem memverifikasi *username* dan *password* terenkripsi dari tabel `users`. Jika valid, sesi login dibuat.
*   **Security Check**: Setiap halaman memiliki skrip `admin_header.php` yang mengecek apakah sesi valid tersedia. Jika tidak, pengguna ditendang peluar ke halaman login.

### 2. Alur Manajemen Data via Modal (Content & Data)
Pada modul seperti **Berita** dan **Dosen**, sistem menggunakan antarmuka *Modal Popup* (jendela layar ganda):
*   **Langkah 1**: Admin klik tombol "Tambah".
*   **Langkah 2**: Formulir muncul di atas halaman tanpa *refresh*. Admin mengisi data.
*   **Langkah 3**: Saat disimpan, data dikirim ke server. Foto (jika ada) diupload ke folder khusus, dan informasi teks disimpan ke MySQL.

### 3. Alur Upload Cepat (Media)
Pada modul **Galeri**, sistem menggunakan formulir *inline* (langsung di halaman):
*   **Mekanisme**: Formulir upload tersedia langsung di bagian atas tabel data.
*   **Proses**: Admin memilih foto -> Klik Upload -> Foto langsung tampil di daftar bawahnya. Metode ini dipilih untuk mempercepat proses dokumentasi banyak foto.

---

## 4. Struktur File & Database

Secara teknis, kode program disusun sebagai berikut:

| Kategori Struktur | File Terkait | Tabel Database Utama |
| :--- | :--- | :--- |
| **Main** | `dashboard.php`, `index.php` | - |
| **Sistem** | `login.php`, `logout.php`, `profile.php`, `kelola_pendaftaran.php` | `users`, `pendaftaran` |
| **Content** | `kelola_berita.php`, `kelola_slider.php`, `kelola_galeri.php`, `kelola_visimisi.php` | `berita`, `slider`, `galeri`, `halaman_statis` |
| **Data** | `kelola_dosen.php`, `kelola_kurikulum.php`, `kelola_fasilitas.php`, `kelola_penelitian.php` | `dosen`, `matakuliah`, `ruangan`, `penelitian`, `pengabdian`, `dokumen` |
