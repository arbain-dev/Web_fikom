# Audit & Bedah Kode Teknis: Web Fikom

Dokumen ini berisi analisis teknis mendalam terhadap proyek `web_fikom` berdasarkan kode sumber yang ada.

## 1. Identifikasi Stack Teknologi

| Komponen | Teknologi | Keterangan |
| :--- | :--- | :--- |
| **Bahasa Pemrograman** | **PHP Native** (Pure PHP) | Versi syntax kompatibel dengan PHP 7.4 - 8.2 |
| **Database** | **MySQL** | Menggunakan driver `mysqli` (Object Oriented style) |
| **Frontend Framework** | Tidak Ada (Custom CSS) | Menggunakan CSS murni (`main.css`), bukan Bootstrap/Tailwind |
| **JavaScript Library** | Tidak Ada Library Besar | Hanya vanilla JS sederhana untuk slider & toggle menu |
| **Icon Library** | **Font Awesome 6.5.1** | Di-load via CDN |
| **Font** | **Inter** (Google Fonts) | Di-load via CDN |

> [!NOTE]
> Proyek ini **TIDAK MENGGUNAKAN FRAMEWORK PHP** apapun (seperti Laravel atau CI). Kode ditulis dengan gaya prosedural klasik yang dicampur dengan HTML.

---

## 2. Struktur Folder & Arsitektur

Arsitektur yang digunakan adalah **Monolithic Structure** sederhana tanpa pola MVC yang ketat. File views dan logic seringkali bercampur dalam satu file.

| Folder/File | Fungsi Utama |
| :--- | :--- |
| **Root /** | Halaman publik yang diakses pengunjung (Frontend). |
| **/admin** | Folder khusus halaman administrator (Backend). Berisi file CRUD. |
| **/config** | Konfigurasi inti sistem (Koneksi Database, Konstanta URL). |
| **/includes** | Potongan kode modular (Header, Footer, Navbar) untuk Frontend. |
| **/assets** | File statis (CSS, Gambar, JavaScript). |
| **/uploads** | Direktori penyimpanan file dinamis yang diupload user (Foto dosen, berita, dll). |

---

## 3. Analisis Logika Inti (Core Logic)

### Workflow Aplikasi
1.  **Request User**: Browser meminta halaman, misalnya `dosen.php`.
2.  **Inisialisasi**: File memuat `config/database.php` untuk koneksi DB.
3.  **Proses Data**: Script PHP langsung menjalankan query SQL (`SELECT * FROM ...`) di baris yang sama.
4.  **Rendering**: Data hasil query langsung di-*looping* (`foreach`/`while`) di dalam tag HTML untuk ditampilkan.

### Komponen Utama
*   **Koneksi Database**: Menggunakan `new mysqli()` di `config/database.php`. Koneksi dibuka setiap kali halaman dimuat.
*   **Routing**: **File-based Routing**. URL `web_fikom/berita.php` langsung memetakan ke file fisik `berita.php`. Tidak ada router sentral.
*   **Autentikasi**:
    *   Menggunakan PHP Session standar (`session_start()`).
    *   Login admin membuat session variabel `$_SESSION['admin_logged_in'] = true`.
    *   Setiap halaman admin mengecek variabel ini di baris paling atas (via `admin_header.php`). Jika tidak ada, di-redirect ke `login.php`.

---

## 4. Penjelasan File Spesifik

Berikut adalah bedah kode untuk 3 file paling krusial:

### A. `config/database.php` (Jantung Koneksi)
```php
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$conn->set_charset("utf8mb4");
```
*   **Fungsi**: Membuat objek koneksi global `$conn` yang dipakai di seluruh file lain.
*   **Penting**: `utf8mb4` diset agar database bisa menyimpan karakter emoji atau simbol khusus dengan benar.

### B. `admin/proses_login.php` (Gatekeeper)
File ini menangani logika saat tombol "Login" ditekan.
*   **Input Sanitization**: Mengambil `$_POST['username']` dan `password`.
*   **Prepared Statement**: Menggunakan `prepare()` dan `bind_param()` untuk mencegah SQL Injection (`SELECT * FROM users WHERE username = ?`).
*   **Password Verify**: Menggunakan `password_verify()` untuk mencocokkan password input dengan hash di database.
*   **Session Creation**: Jika sukses, membuat session `$_SESSION['admin_logged_in']` yang menjadi "tiket masuk" admin.

### C. `admin/includes/admin_header.php` (Security & Layout)
File ini di-*include* di setiap halaman admin.
*   **Security Check**: Baris 18-21 mengecek `!isset($_SESSION['admin_logged_in'])`. Jika user belum login tapi mencoba akses halaman admin secara langsung (bypass), script memaksa redirect ke `login.php` dan `exit`.
*   **Layouting**: Memuat struktur HTML awal (`<head>`, CSS) dan Sidebar menu, sehingga kita tidak perlu menulis ulang menu di setiap halaman admin.

---

## 5. Fitur & Fungsionalitas
Berdasarkan audit kode, berikut fitur yang tersedia:

1.  **Frontend Publik**:
    *   Beranda dengan Hero Slider & Statistik Animasi.
    *   Berita & Pengumuman (List & Detail).
    *   Profil Fakultas (Visi Misi, Struktur, Dosen).
    *   Informasi Akademik (Kalender, Kurikulum).
    *   Fasilitas (Ruangan, Lab).
2.  **Backend Admin (CMS)**:
    *   **Dashboard**: Ringkasan statistik (Total Dosen, Berita).
    *   **Manajemen Dosen**: CRUD data dosen + Upload Foto.
    *   **Manajemen Berita**: Tulis berita + Upload Thumbnail.
    *   **Manajemen Fasilitas**: Input data ruangan/lab.
    *   **Manajemen Dokumen**: Upload file PDF (Renstra/SOP).
    *   **Autentikasi**: Login & Logout Admin.

---

## 6. Analisis Keamanan & Performa

### ✅ Positif (Good Practices)
*   **Prepared Statements**: Login menggunakan `prepare()` statement, ini sudah sangat bagus untuk mencegah SQL Injection dasar.
*   **Session Checks**: Setiap halaman admin dilindungi pengecekan session di bagian paling atas file header.
*   **Password Hashing**: Kode login menggunakan `password_verify()`, mengindikasikan password di DB disimpan dalam bentuk hash (bukan plain text).

### ⚠️ Area Pengembangan (Optimization)
*   **Duplicate Code**: Logika koneksi dan include file diulang-ulang di banyak tempat.
*   **Error Reporting**: Di file `proses_login.php`, `display_errors` diaktifkan (`1`). Ini berbahaya di tahap Produksi (Live) karena bisa membocorkan path error server ke pengunjung. Sebaiknya dimatikan saat website sudah online.
*   **No CSRF Protection**: Saya belum melihat mekanisme token CSRF pada form input. Ini berarti jika admin mengklik link jahat saat sedang login, penyerang bisa berpotensi melakukan submit form atas nama admin tanpa sepengetahuannya.
*   **Hardcoded Credentials**: Jika nanti di-deploy, pastikan file `database.php` tidak terekspos atau permission-nya diamankan.
