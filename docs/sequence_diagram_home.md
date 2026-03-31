# Sequence Diagram: Halaman Utama (Home)

Diagram sekuensial ini menggambarkan alur kerja sistem ketika seorang pengunjung mengakses halaman utama (beranda/home) dari Web FIKOM.

## Penjelasan Alur

Secara garis besar, proses interaksi pada Halaman Utama dimulai ketika pengguna mengakses antarmuka penelusuran utama (*root URL*) melalui peramban web mereka. Permintaan awal tersebut segera diterima oleh sistem peladen utama (`index.php`) yang bertugas sebagai pengendali rute (*router*). Sistem ini selanjutnya akan mengarahkan dan memuat modul khusus untuk halaman beranda. Pada tahapan persiapan ini, halaman beranda (`pages/home.php`) akan terlebih dahulu memuat seluruh konfigurasi dasar, fungsi pelengkap, serta memulai sesi koneksi yang aman menuju pangkalan data fakultas (*database* MySQL).

Setelah simpul koneksi pangkalan data tersambung, sistem akan melanjutkan instruksi dengan melakukan serangkaian operasi pengambilan data secara komprehensif. Operasi penarikan ini mencakup pengambilan 6 (enam) rilis berita paling baru, pencatatan statistik dan fakta kampus, pemanggilan daftar media gambar untuk panel tata letak sorotan (*hero slider*) yang sedang berstatus aktif, hingga pencarian rincian singkatan profil fakultas dan rekaman entitas mitra kerja sama. Seluruh data mentah yang sukses diperingkas oleh *database* ini selanjutnya diracik untuk melengkapi komponen visual kerangka struktural web. Sistem akan mendirikan batas atas antarmuka (*header*) serta merangkai balok-balok informasi utama ke dalam *grid*, sebelum akhirnya menyudahi rangkuman halaman tersebut dengan pemuatan seksi penutup (*footer*) dan berkas interaktif JavaScript yang relevan. Pada ujung jalurnya, sistem melepas kompilasi struktur final dalam bentuk respons HTML penuh yang kemudian dibentangkan dengan tuntas pada layar pengguna.

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
