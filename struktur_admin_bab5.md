# Dokumentasi dan Struktur Kode Admin (Bab 5)

Dokumen ini disusun untuk menjelaskan struktur teknis, fungsionalitas, dan alur kerja sistem administrator pada Bab 5 (Implementasi dan Pengujian). Penjelasan ini disatukan dalam satu dokumen lengkap mencakup struktur navigasi, detail fungsi menu, dan alur sistem.

## 1. Struktur Navigasi Dashboard

Berdasarkan arsitektur aplikasi, fitur-fitur pada halaman administrator dikelompokkan menjadi empat segmen utama: **Sistem**, **Content**, **Data**, dan **Main**. Berikut adalah diagram struktur menu admin:

| **Sistem** | **Content** | **Data** | **Main** |
| :--- | :--- | :--- | :--- |
| **User Management**<br>• Pengaturan (Profile)<br>• Login / Logout<br><br>**Feedback**<br>• Data Pendaftaran | **Artikel & Berita**<br>• Kelola Berita<br><br>**Profil Web**<br>• Kelola Profil (Visi Misi, Sejarah)<br>• Kelola Slider<br><br>**Media**<br>• Kelola Galeri | **Akademik & SDM**<br>• Kelola Dosen<br>• Kelola Akademik (Kurikulum)<br>• Kelola Fasilitas (Ruangan/Lab)<br><br>**Tridharma**<br>• Penelitian & Pengabdian<br>• Kerjasama<br><br>**Arsip**<br>• Kelola Dokumen (SOP/Renstra) | **Overview**<br>• Dashboard Statistik<br>• Ringkasan Aktivitas |

---

## 2. Penjelasan Fungsional Menu (Detail)

Bagian ini menjabarkan fungsi secara rinci dari setiap menu yang terdapat dalam panel admin.

### A. Bagian Main (Utama)
*   **Dashboard**:
    Halaman muka (*homepage*) admin yang menyajikan ringkasan eksekutif. Fitur ini menampilkan *counter* jumlah data (Total Dosen, Total Berita, Jumlah Penelitian) dan tabel aktivitas terbaru. Tujuannya adalah memberikan gambaran cepat mengenai volume data yang dikelola sistem tanpa harus masuk ke menu masing-masing.

### B. Bagian Content (Manajemen Konten)
Kelompok menu ini berfokus pada pengelolaan informasi publik. Simpanan data di sini akan tampil di halaman depan website yang diakses pengunjung.

1.  **Kelola Profil**:
    *   **Visi Misi**: Formulir *text editor* untuk memperbarui visi dan misi fakultas.
    *   **Sejarah / Tentang Fakultas**: Mengelola narasi sejarah singkat fakultas.
    *   **Struktur Organisasi**: Mengunggah gambar bagan struktur organisasi terbaru.
    *   **Data Fakta**: Mengatur angka-angka fakta (Jumlah Mahasiswa, Alumni, Prodi) yang tampil di beranda.

2.  **Kelola Slider**:
    Modul untuk mengelola gambar spanduk (*banner*) yang berputar otomatis di halaman utama. Admin dapat mengunggah gambar promosi resolusi tinggi (1920x600px) dan memberikan judul/keterangan singkat.

3.  **Kelola Berita**:
    Modul jurnalistik untuk mempublikasikan artikel.
    *   **Fitur**: Tambah berita baru, edit konten, atau hapus berita lama.
    *   **Input**: Judul, Kategori (Akademik/Kegiatan), Tanggal, Gambar Utama, dan Isi Berita.
    *   **Tampilan**: Menggunakan tabel data yang dilengkapi pencarian dan *pagination*.

4.  **Kelola Galeri**:
    Modul dokumentasi visual kegiatan kampus.
    *   **Fitur**: *Upload* foto massal (*bulk*) untuk kegiatan tertentu.
    *   **Input**: Judul Kegiatan, Deskripsi Singkat, dan File Foto.

### C. Bagian Data (Basis Data Akademik)
Kelompok menu ini mengelola data inti (*core data*) yang berkaitan dengan operasional akademik dan sumber daya fakultas.

1.  **Kelola Dosen & SDM**:
    Mengelola pangkalan data tenaga pengajar.
    *   **Input Data**: Nama Lengkap, NIDN/NIP, Prodi Homebase, Jabatan Akademik, Pendidikan Terakhir, dan Foto Profil.
    *   **Integrasi**: Data ini otomatis tampil pada menu "Direktori Dosen" di website publik.

2.  **Kelola Akademik (Kurikulum & Kalender)**:
    *   **Kurikulum**: Mengelola daftar mata kuliah per semester, bobot SKS, dan kode mata kuliah.
    *   **Kalender Akademik**: Mengunggah file atau gambar jadwal kegiatan akademik semester berjalan.

3.  **Kelola Fasilitas**:
    Inventarisasi sarana prasarana pendidikan.
    *   **Ruangan**: Mendata ruang kelas, kapasitas, dan fasilitas didalamnya (AC/Proyektor).
    *   **Laboratorium**: Mendata lab komputer atau praktik, beserta deskripsi peralatan utama.

4.  **Tridharma (Penelitian & Pengabdian)**:
    Repositori karya ilmiah dosen.
    *   **Penelitian**: Mencatat judul penelitian, tahun pelaksanaan, sumber dana, dan tim peneliti.
    *   **Pengabdian**: Mencatat kegiatan PkM (Pengabdian kepada Masyarakat), lokasi, dan tanggal kegiatan.

5.  **Kelola Kerjasama**:
    Database mitra eksternal fakultas.
    *   **Input**: Nama Mitra, Jenis Kerjasama (MoU/MoA), Bidang Kerjasama, dan Masa Berlaku.

6.  **Kelola Dokumen**:
    Pusat unduhan (*download center*) regulasi.
    *   **Fitur**: Mengunggah file PDF untuk Renstra (Rencana Strategis), Renop (Rencana Operasional), dan SOP Layanan Akademik agar dapat diunduh oleh mahasiswa/dosen.

### D. Bagian Sistem (Pengaturan & Keamanan)

1.  **Data Pendaftaran (Feedback)**:
    Kotak masuk (*inbox*) dari formulir pendaftaran atau kontak yang ada di website. Admin dapat melihat daftar nama pendaftar, kontak, dan pesan yang mereka kirimkan.

2.  **Pengaturan Akun**:
    Fitur keamanan personal admin. Memungkinkan pengelola untuk mengubah *Username*, *Email*, dan *Password* untuk mencegah akses ilegal.

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
