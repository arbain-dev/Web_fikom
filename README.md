# Web Fakultas Ilmu Komputer (Web FIKOM)

Website resmi untuk Fakultas Ilmu Komputer yang dibangun menggunakan PHP Native. Proyek ini mencakup halaman publik (frontend) untuk pengunjung dan panel admin (backend) untuk pengelolaan data dinamis.

## 🚀 Fitur Utama

-   **Frontend Publik:**
    -   Halaman Beranda dengan slider dan berita terbaru.
    -   Profil Fakultas (Visi Misi, Sejarah, Struktur, dll).
    -   Informasi Akademik (Kurikulum, Kalender, Daftar Dosen).
    -   Informasi Fasilitas (Laboratorium, Ruangan).
    -   Pendaftaran Mahasiswa Baru.
    -   Halaman Berita dan Artikel.
    -   Responsive Design (Mobile-Friendly).

-   **Panel Admin:**
    -   Dashboard Statistik.
    -   Manajemen Berita (CRUD).
    -   Manajemen Data Dosen & Staf.
    -   Manajemen Fasilitas (Lab, Ruangan).
    -   Manajemen Dokumen (SOP, Kurikulum, Penelitian).
    -   Manajemen Galeri & Slider.
    -   Manajemen Partner Kerjasama.
    -   Autentikasi Admin yang aman.

## 🛠️ Teknologi yang Digunakan

-   **Backend:** PHP (Native)
-   **Database:** MySQL (MariaDB via XAMPP/Laragon)
-   **Frontend:** HTML5, CSS3 (Custom + FontAwesome), JavaScript (Vanilla)
-   **Server:** Apache (XAMPP/Laragon)

## 📂 Struktur Folder

```
web_fikom/
│
├── admin/                 # Halaman-halaman panel admin (Backend)
│   ├── includes/          # Header/Footer khusus admin
│   ├── login.php          # Halaman login admin
│   ├── dashboard.php      # Halaman utama admin
│   └── admin_kelola_*.php # File CRUD untuk setiap modul
│
├── assets/                # Aset statis
│   ├── css/               # File CSS (main.css, admin.css)
│   ├── js/                # File JavaScript (main.js)
│   ├── img/               # Gambar statis website
│   └── webfonts/          # Font icons
│
├── config/                # Konfigurasi sistem
│   ├── database.php       # Koneksi database MySQL
│   └── constants.php      # Konstanta global
│
├── includes/              # Komponen UI reusable (Frontend)
│   ├── header.php         # Navigasi & Head
│   └── footer.php         # Footer website
│
├── uploads/               # Direktori penyimpanan file upload (Gambar/PDF)
│   ├── dosen/
│   ├── berita/
│   ├── dokumen/
│   └── ... (subfolder lainnya)
│
├── index.php              # Halaman Beranda Utama
└── [pages].php            # Halaman publik lainnya (dosen.php, berita.php, dll)
```

## 💾 Struktur Database

Nama Database: `db_web_fikom`

Tabel-tabel utama:

1.  **users** - Menyimpan data akun admin (username, password hashed).
2.  **berita** - Menyimpan artikel berita dan pengumuman.
3.  **dosen** - Data profil dosen, NIDN, jabatan, dan foto.
4.  **tb_fakta** - Data statistik fakultas (jumlah mhs, dosen, lulusan).
5.  **laboratorium** - Daftar dan deskripsi fasilitas laboratorium.
6.  **ruangan** - Daftar fasilitas ruangan kelas/umum.
7.  **bem_struktur** - Anggota BEM, jabatan, dan foto.
8.  **kerjasama** - Partner industri dan universitas lain.
9.  **kurikulum** - File PDF dan deskripsi kurikulum.
10. **penelitian** - Data penelitian dosen/mahasiswa.
11. **sop** - Dokumen Standar Operasional Prosedur (PDF).
12. **pendaftaran** - Data calon mahasiswa baru.
13. **visimisi** - Konten visi dan misi fakultas.
14. **renstra** - Dokumen Rencana Strategis.
15. **renop** - Dokumen Rencana Operasional.
16. **pengabdian** - Data pengabdian masyarakat.

## ⚙️ Cara Instalasi

1.  **Clone / Download** repositori ini ke folder `htdocs` (XAMPP) atau `www` (Laragon) anda.
    ```bash
    git clone https://github.com/username-anda/web_fikom.git
    ```

2.  **Impor Database:**
    -   Buka phpMyAdmin (`localhost/phpmyadmin`).
    -   Buat database baru dengan nama `db_web_fikom`.
    -   Impor file `.sql` (jika tersedia) atau buat tabel sesuai struktur di atas.

3.  **Konfigurasi Koneksi:**
    -   Buka file `config/database.php`.
    -   Sesuaikan `DB_USERNAME`, `DB_PASSWORD`, dan `DB_NAME` jika berbeda.

4.  **Jalankan Website:**
    -   Buka browser dan akses `http://localhost/website/web_fikom`.
    -   Untuk akses admin: `http://localhost/website/web_fikom/admin`.

## 🔒 Akun Demo (Default)

-   **Username:** admin
-   **Password:** (Sesuai yang di-set di database / hash)

---
© 2026 Muhammad Arbain. All Rights Reserved.
