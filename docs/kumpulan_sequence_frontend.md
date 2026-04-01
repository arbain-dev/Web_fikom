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
    
    actor User as Pengunjung
    participant Frontend
    participant Backend as Backend (control)
    participant DB as Database

    User->>Frontend: Akses / Klik menu Civitas Akademika
    Frontend->>Backend: Request data Civitas (HTTP GET)
    
    Backend->>DB: Query daftar dosen & tendik (profil, gelar, dll.)
    DB-->>Backend: Return himpunan data civitas
    
    Backend-->>Frontend: Kirim Data Gabungan (Render HTML)
    Frontend-->>User: Tampilkan Halaman Data Civitas utuh
```

## Sequence Diagram: Halaman Struktur Organisasi
```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung
    participant Frontend
    participant Backend as Backend (control)
    participant DB as Database

    User->>Frontend: Akses / Klik menu Struktur Organisasi
    Frontend->>Backend: Request data Struktur Organisasi
    
    Backend->>DB: Query pejabat pimpinan & bagan struktur
    DB-->>Backend: Return data struktur organisasi
    
    Backend-->>Frontend: Kirim HTML / Data Gabungan
    Frontend-->>User: Tampilkan Halaman Struktur Organisasi
```

## Sequence Diagram: Halaman Tentang Fakultas
```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung
    participant Frontend
    participant Backend as Backend (control)
    participant DB as Database

    User->>Frontend: Akses / Klik menu Tentang Fakultas
    Frontend->>Backend: Request rincian Profil Fakultas
    
    Backend->>DB: Query sejarah, narasi profil, dan ikhtisar
    DB-->>Backend: Return deskripsi fakultas
    
    Backend-->>Frontend: Konversi ke HTML siap sedia
    Frontend-->>User: Tampilkan Halaman Tentang Fakultas
```

## Sequence Diagram: Halaman Visi dan Misi
```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung
    participant Frontend
    participant Backend as Backend (control)
    participant DB as Database

    User->>Frontend: Akses / Klik Visi dan Misi
    Frontend->>Backend: Request teks Visi Misi
    
    Backend->>DB: Query data visi, misi, dan tujuan fakultas
    DB-->>Backend: Return teks konfigurasi visi misi
    
    Backend-->>Frontend: Berikan dokumen HTML utuh
    Frontend-->>User: Tampilkan Halaman Visi & Misi
```


