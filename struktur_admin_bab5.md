# Dokumentasi dan Struktur Kode Admin (Bab 5)

Dokumen ini disusun untuk menjelaskan struktur teknis, fungsionalitas, dan alur kerja sistem administrator pada Bab 5 (Implementasi dan Pengujian).

## 1. Struktur Navigasi dan Modul Admin

Sistem administrator dibagi menjadi empat kelompok modul utama berdasarkan fungsinya:

| Kategori | Nama Modul / File | Fungsi Utama |
| :--- | :--- | :--- |
| **MAIN (UTAMA)** | `dashboard.php` | **Pusat Informasi:** Menampilkan ringkasan statistik dan akses cepat. |
| **SISTEM (AKSES)** | `login.php`, `proses_login.php` | **Autentikasi:** Menangani validasi login dan keamanan sesi. |
| | `profile.php`, `logout.php` | **Manajemen Akun:** Pengaturan profil admin dan keluar sistem. |
| **CONTENT (KONTEN)** | `kelola_berita.php` | **Publikasi:** Mengelola artikel berita dengan fitur *popup modal*. |
| | `kelola_galeri.php` | **Media:** Mengunggah foto kegiatan menggunakan *inline form*. |
| | `kelola_visimisi.php`, dll. | **Profil Web:** Mengelola informasi statis profil fakultas. |
| **DATA (AKADEMIK)** | `kelola_dosen.php` | **Data SDM:** Mengelola data dosen dengan fitur *popup modal*. |
| | `kelola_kurikulum.php`, `kelola_lab.php` | **Akademik & Fasilitas:** Mengatur kurikulum dan fasilitas kampus. |
| | `kelola_penelitian.php` | **Tridharma:** Arsip penelitian dan pengabdian masyarakat. |

---

## 2. Penjelasan Fungsional Menu Sidebar

Berikut adalah penjabaran rinci mengenai fitur yang tersedia pada setiap menu navigasi:

### A. Kelompok Menu Utama
**Dashboard**
Halaman ini adalah antarmuka pertama yang diakses setelah login. Dashboard menyajikan rangkuman data penting dalam bentuk kartu statistik (total dosen, berita, dll) serta tabel aktivitas terbaru, memungkinkan admin untuk memantau status sistem secara cepat.

### B. Kelompok Manajemen Konten
**Kelola Profil & Slider**
Menu ini digunakan untuk memperbarui konten statis seperti Visi Misi, Sejarah, dan spanduk utama (*slider*) website. Perubahan di sini berdampak langsung pada identitas visual website publik.

**Kelola Berita**
Modul ini memfasilitasi publikasi artikel. Admin dapat menambahkan judul, kategori, konten, dan foto. Fitur ini menggunakan antarmuka *modal popup* agar admin tidak perlu berpindah halaman saat menambah atau mengedit berita.

**Kelola Galeri**
Menu ini berfungsi sebagai album foto digital. Berbeda dengan berita, modul ini menyediakan formulir unggah langsung di bagian atas halaman untuk mempercepat proses dokumentasi kegiatan dalam jumlah banyak.

### C. Kelompok Akademik & Data
**Kelola Dosen & BEM**
Mengelola *database* civitas akademika. Pada modul Dosen, admin dapat memasukkan data rinci seperti NIDN, Jabatan, dan Riwayat Pendidikan. Data ini ditampilkan di website sebagai direktori staf pengajar.

**Kelola Fasilitas**
Menginventarisasi ruang kelas dan laboratorium. Informasi ini memberikan transparansi mengenai sarana penunjang pembelajaran yang dimiliki fakultas.

**Kelola Dokumen (Renstra/SOP)**
Menyediakan repositori untuk dokumen resmi fakultas yang dapat diunduh oleh pengunjung, mendukung prinsip keterbukaan informasi publik.

---

## 3. Alur Kerja Sistem (System Workflow)

Bagian ini menjelaskan langkah-langkah prosedural (*step-by-step*) penggunaan fitur utama dalam sistem. Penjelasan ini menggambarkan interaksi antara pengguna (*user*) dengan sistem.

### A. Alur Login Administrator
1.  **Akses Halaman**: Pengguna membuka URL `/admin`. Sistem mendeteksi status sesi; jika belum aktif, pengguna diarahkan ke halaman Login.
2.  **Input Kredensial**: Pengguna memasukkan *username* dan *password*.
3.  **Validasi Sistem**: Sistem melakukan pengecekan ke database `users`.
    *   Jika cocok: Sesi dibuat, pengguna diarahkan ke `dashboard.php`.
    *   Jika salah: Sistem menampilkan pesan "Username atau Password salah".

### B. Alur Manajemen Data dengan Modal (Contoh: Berita & Dosen)
Modul Berita dan Dosen menggunakan pendekatan *Single Page Application* sederhana dengan bantuan Modal (jendela *popup*).
1.  **Buka Menu**: Admin memilih menu "Kelola Berita" atau "Kelola Dosen".
2.  **Lihat Data**: Sistem menampilkan tabel daftar data yang diambil dari database.
3.  **Tambah Data**:
    *   Admin menekan tombol "Tambah".
    *   **Sistem**: Memunculkan formulir *popup* di tengah layar (tanpa memuat ulang halaman).
    *   Admin mengisi data dan mengunggah foto.
    *   Admin menekan "Simpan".
4.  **Proses Simpan**: Data dikirim ke server, divalidasi, dan disimpan ke database.
5.  **Umpan Balik**: Halaman diperbarui secara otomatis dan menampilkan pesan "Sukses menambahkan data".

### C. Alur Manajemen Data dengan Form Langsung (Contoh: Galeri)
Modul Galeri menggunakan pendekatan formulir statis untuk kemudahan unggah cepat.
1.  **Buka Menu**: Admin memilih menu "Kelola Galeri".
2.  **Input Data**: Admin langsung mengisi formulir yang tersedia di bagian atas halaman (Judul, Deskripsi, File Gambar).
3.  **Upload**: Admin menekan tombol "Upload".
4.  **Proses Sistem**: Server menerima file, menyimpannya ke folder `/uploads/galeri/`, dan mencatat informasinya ke database.
5.  **Hasil**: Foto baru langsung muncul pada tabel daftar galeri di bagian bawah halaman.

---

## 4. Penjelasan Teknis (Logika Kode)

**Pola CRUD (Create, Read, Update, Delete)**
Hampir seluruh modul admin dibangun menggunakan pola standar CRUD:
*   **Create (Tambah)**: Menggunakan perintah SQL `INSERT INTO` dan fungsi PHP `move_uploaded_file` untuk menangani gambar.
*   **Read (Tampil)**: Menggunakan perintah SQL `SELECT` dengan pengulangan `foreach` untuk merender baris tabel HTML.
*   **Update (Ubah)**: Menggunakan perintah SQL `UPDATE` berdasarkan ID unik data.
*   **Delete (Hapus)**: Menggunakan perintah SQL `DELETE` dan fungsi `unlink()` untuk menghapus file fisik dari server.

**Keamanan Sistem**
Setiap halaman admin dilindungi oleh skrip pengecekan sesi di bagian paling atas (`includes/admin_header.php`). Jika variabel `$_SESSION['admin_logged_in']` tidak ditemukan, sistem secara paksa menghentikan eksekusi kode dan melempar pengguna kembali ke halaman login.
