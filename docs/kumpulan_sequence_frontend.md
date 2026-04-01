# Kumpulan Diagram Frontend

## Sequence Diagram: Halaman Utama (Home)
```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung
    participant Frontend
    participant Backend as Backend (control)
    participant DB as Database

    User->>Frontend: Buka Halaman Home
    Frontend->>Backend: Request semua data utama
    
    Backend->>DB: Ambil data Slider
    Backend->>DB: Ambil data Berita Terbaru
    Backend->>DB: Ambil data Fakta Fakultas
    Backend->>DB: Ambil data Tentang Fakultas
    Backend->>DB: Ambil data Mitra Kerja Sama
    
    Backend-->>Frontend: Kirim Semua data gabungan (Web Render HTML)
    Frontend-->>User: Tampilkan Data Di Halaman Home
```

## Sequence Diagram: Halaman Data Civitas Akademika
```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung/User
    participant Browser
    participant Index as index.php
    participant Page as Halaman Data Civitas
    participant DB as Database (MySQL)
    participant Header as includes/header.php
    participant Footer as includes/footer.php

    User->>Browser: Akses URL / Klik menu Civitas Akademika
    Browser->>Index: HTTP GET Request (/profil/civitas)
    
    Index->>Index: Setup inisialisasi dasar situs & routing
    Index->>Page: Memuat sistem halaman civitas
    
    Page->>Page: Pembentukan sesi basis data lanjutan
    
    Page->>DB: Query daftar dosen & tendik (profil, gelar, dll.)
    DB-->>Page: Return himpunan data civitas
    
    Page->>Header: Include includes/header.php
    Header-->>Page: Render Header (Navigasi situs)
    
    Note over Page: Transformasi data array menjadi<br/>kartu profil grid sivitas dalam HTML
    
    Page->>Footer: Include includes/footer.php
    Footer-->>Page: Render Footer (Elemen kaki & Scripts)
    
    Page-->>Index: Penyatuan dokumen telah beres
    Index-->>Browser: HTTP Response 200 (HTML Valid)
    Browser-->>User: Halaman Data Civitas tersaji ke layar
```

## Sequence Diagram: Halaman Struktur Organisasi
```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung/User
    participant Browser
    participant Index as index.php
    participant Page as Halaman Struktur Organisasi
    participant DB as Database (MySQL)
    participant Header as includes/header.php
    participant Footer as includes/footer.php

    User->>Browser: Akses URL / Klik menu Struktur Organisasi
    Browser->>Index: HTTP GET Request (/profil/struktur)
    
    Index->>Index: Inisialisasi setelan & routing
    Index->>Page: Include halaman struktur organisasi
    
    Page->>Page: Inisiasi konfigurasi & koneksi DB
    
    Page->>DB: Query data pejabat pimpinan & bagan struktur
    DB-->>Page: Return data struktur organisasi
    
    Page->>Header: Include includes/header.php
    Header-->>Page: Render Header (Navigasi)
    
    Note over Page: Menyusun data struktur pimpinan<br/>ke dalam templat UI utama
    
    Page->>Footer: Include includes/footer.php
    Footer-->>Page: Render Footer (Informasi Kontak & JS)
    
    Page-->>Index: Proses rendering halaman beres
    Index-->>Browser: HTTP Response (Dokumentasi HTML)
    Browser-->>User: Tampilan Struktur Organisasi sempurna
```

## Sequence Diagram: Halaman Tentang Fakultas
```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung/User
    participant Browser
    participant Index as index.php
    participant Page as Halaman Tentang Fakultas
    participant DB as Database (MySQL)
    participant Header as includes/header.php
    participant Footer as includes/footer.php

    User->>Browser: Akses URL / Klik menu Tentang Fakultas
    Browser->>Index: HTTP GET Request (/profil/tentang)
    
    Index->>Index: Routing URL & pembacaan konfigurasi inti
    Index->>Page: Memuat penanganan khusus halaman tentang fakultas
    
    Page->>Page: Implementasi sambungan ke Basis Data
    
    Page->>DB: Query sejarah, narasi profil, dan ikhtisar fakultas
    DB-->>Page: Return kumpulan elemen data "tentang"
    
    Page->>Header: Include includes/header.php
    Header-->>Page: Render layout Header atas
    
    Note over Page: Rekonstruksi data profil beserta sejarah<br/>sebagai presentasi dokumen teks naratif (HTML)
    
    Page->>Footer: Include includes/footer.php
    Footer-->>Page: Render tata letak Footer bawah
    
    Page-->>Index: Penyesuaian antarmuka final diketok palu
    Index-->>Browser: HTTP Response (Output HTML utuh)
    Browser-->>User: Pengguna membaca Halaman Tentang Fakultas
```

## Sequence Diagram: Halaman Visi dan Misi
```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung/User
    participant Browser
    participant Index as index.php
    participant Page as Halaman Visi Misi
    participant DB as Database (MySQL)
    participant Header as includes/header.php
    participant Footer as includes/footer.php

    User->>Browser: Akses URL / Klik menu Visi & Misi
    Browser->>Index: HTTP GET Request (/profil/visi-misi)
    
    Index->>Index: Inisialisasi konfigurasi & routing
    Index->>Page: Include halaman visi & misi
    
    Page->>Page: Memuat koneksi basis data
    
    Page->>DB: Query data teks visi & misi fakultas
    DB-->>Page: Return data visi & misi
    
    Page->>Header: Include includes/header.php
    Header-->>Page: Render komponen Header (Navigasi & CSS)
    
    Note over Page: Menyematkan data visi dan misi<br/>ke dalam struktur tata letak (HTML)
    
    Page->>Footer: Include includes/footer.php
    Footer-->>Page: Render komponen Footer (Script & Informasi)
    
    Page-->>Index: Proses penyusunan halaman selesai
    Index-->>Browser: HTTP Response (Dokumen HTML)
    Browser-->>User: Halaman Visi & Misi ditampilkan utuh
```


