# Sequence Diagram: Halaman Utama (Home)

Diagram sekuensial ini menggambarkan alur kerja sistem ketika seorang pengunjung mengakses halaman utama (beranda/home) dari Web FIKOM.

## Penjelasan Alur

1. **Pengguna Mengakses Halaman**: Pengguna mengakses *root url* (`/`) melalui browser.
2. **Routing oleh `index.php`**: Permintaan diterima oleh `index.php` yang mengatur *routing* dasar dan memutuskan untuk memuat file `pages/home.php`.
3. **Persiapan Halaman & Koneksi**: `pages/home.php` memuat file konfigurasi, fungsi, dan koneksi ke *database*.
4. **Pengambilan Data (Query)**:
   - **Berita**: Mengambil 6 berita terbaru (`LIMIT 6`, diurutkan berdasarkan `tanggal_publish`).
   - **Fakta**: Mengambil seluruh fakta statistik fakultas.
   - **Slider**: Mengambil semua gambar *hero slider* yang berstatus aktif (`is_active = 1`).
   - **Tentang Fakultas**: Mengambil data deskripsi dan gambar tentang fakultas.
   - **Mitra Kerja Sama**: Mengambil iterasi logo dan data instansi kerja sama untuk menampilkannya ke dalam fitur *auto-scroll carousel*.
5. **Render Header**: Sistem memuat dan me-*render* tampilan awal atas halaman yang mencakup navigasi melalui komponen `includes/header.php`.
6. **Render Konten Utama**: Sistem mencetak kerangka konten dengan menyematkan data yang telah diambil sebelumnya: *Hero Slider*, Statistik Fakta, *Grid* Berita Terbaru, Bagian Profil / Tentang Fakultas, *Grid* Program Studi, dan *Grid* Informasi Akademik.
7. **Render Footer**: Tampilan bagian bawah (termasuk *scripts* interaktif) dimuat dari `includes/footer.php`.
8. **Respon ke Pengguna**: Seluruh proses *rendering* HTML dikembalikan ke browser dengan respons sukses (200 OK) untuk ditampilkan kepada pengguna.

## Diagram

```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung/User
    participant Browser
    participant Index as index.php
    participant Home as pages/home.php
    participant DB as Database (MySQL)
    participant Header as includes/header.php
    participant Footer as includes/footer.php

    User->>Browser: Mengakses halaman utama (/)
    Browser->>Index: HTTP GET Request (/)
    
    Index->>Index: Inisialisasi konfigurasi & routing
    Index->>Home: Include pages/home.php
    
    Home->>Home: Include config/database.php, constants.php, functions.php
    
    rect rgb(240, 248, 255)
        Note over Home, DB: Proses Pengambilan Data
        Home->>DB: Query 6 Berita Terbaru
        DB-->>Home: Return Data Berita
        
        Home->>DB: Query Data Fakta Fakultas
        DB-->>Home: Return Data Fakta
        
        Home->>DB: Query Slider Aktif
        DB-->>Home: Return Data Slider
        
        Home->>DB: Query Tentang Fakultas (Limit 1)
        DB-->>Home: Return Data Tentang Fakultas
        
        Home->>DB: Query Mitra Kerja Sama
        DB-->>Home: Return Data Kerja Sama
    end
    
    Home->>Header: Include includes/header.php
    Header-->>Home: Render komponen Header (Navbar, CSS)
    
    Note over Home: Proses Render ke HTML:<br/>1. Hero Slider<br/>2. Bagian Statistik<br/>3. Grid Berita Terbaru<br/>4. Section Tentang Fakultas<br/>5. Grid Program Studi<br/>6. Grid Informasi Akademik<br/>7. Carousel Mitra
    
    Home->>Footer: Include includes/footer.php
    Footer-->>Home: Render komponen Footer (Scripts, Hak Cipta)
    
    Home-->>Index: Proses Render Halaman Selesai
    Index-->>Browser: HTTP Response (HTML)
    Browser-->>User: Halaman Utama (Home) Ditampilkan secara utuh
```
