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



## Sequence Diagram: Halaman Profil Dosen
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend
    participant Backend as Backend (control)
    participant DB as Database

    User->>Frontend: Klik menu Profil Dosen
    Frontend->>Backend: Request direktori data Dosen
    
    Backend->>DB: Query relasi tabel daftar Dosen
    DB-->>Backend: Return profil nama, NIDN, jabatan, foto pangkalan
    
    Backend-->>Frontend: Berikan data utuh HTML / JSON Profil
    Frontend-->>User: Tampilkan Grid Kartu Profil Para Dosen
```

## Sequence Diagram: Halaman Pendaftaran Mahasiswa Baru
```mermaid
sequenceDiagram
    autonumber
    actor User as Calon Pendaftar
    participant Frontend
    participant Backend as Backend (control)
    participant Server as Storage (Brankas File)
    participant DB as Database

    User->>Frontend: Isi Form Pendaftaran & Lampirkan File (KTP/Ijazah)
    User->>Frontend: Klik "Kirim Pendaftaran"
    Frontend->>Backend: Post Data Form + Lampiran File Berkas

    Backend->>Backend: Verifikasi ekstensi file & standar keamanan
    
    alt Berkas Pengajuan Valid Sesuai Ketentuan
        Backend->>Server: Simpan fisik file pendaftar selamat ke piringan Server
        Backend->>DB: Injeksi rekaman isian form ke Database (Status: Pending)
        DB-->>Backend: Rekam berstatus tereksekusi tersimpan
        Backend-->>Frontend: Arahkan layar kembali dibubuhi Notifikasi Sukses Daftar
        Frontend-->>User: Tampilan pendaftaran terselesaikan / Menanti Konfirmasi Admin
    else Syarat Berkas Dianggap Ilegal Tak Sesuai
        Backend-->>Frontend: Tolak Post, sampaikan Pesan Error
        Frontend-->>User: Peringatkan Pengguna Perbaiki Muatan File atau Form
    end
```

## Sequence Diagram: Halaman Program Studi TI (Teknik Informatika)
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend
    participant Backend as Backend (control)
    participant DB as Database

    User->>Frontend: Mengeksplorasi Profil Prodi TI
    Frontend->>Backend: Request paket kelengkapan data Prodi TI
    
    Backend->>DB: Ambil spesifik Visi-Misi Teknik Informatika
    Backend->>DB: Ambil spesifik jajaran Dosen TI
    Backend->>DB: Ambil daftar Kurikulum resmi TI
    
    Backend-->>Frontend: Kumpul & Restorasi perpaduan Data TI (Render Output)
    Frontend-->>User: Tampilkan Halaman Antarmuka Keilmuan Prodi TI
```

## Sequence Diagram: Halaman Program Studi PTI (Pendidikan Teknologi Informasi)
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend
    participant Backend as Backend (control)
    participant DB as Database

    User->>Frontend: Masuk menyurvei Profil Prodi PTI
    Frontend->>Backend: Request bongkahan spesifikasi data Prodi PTI
    
    Backend->>DB: Ekstrak tunggal Visi-Misi entri wilayah PTI
    Backend->>DB: Ekstrak senarai pengurus & Dosen afiliasi PTI
    Backend->>DB: Ekstrak barisan Kurikulum spesifik PTI
    
    Backend-->>Frontend: Konstruksi penyatuan Data PTI solid (Render Tampilan Web)
    Frontend-->>User: Sajikan Pesona Layar Profil Prodi PTI secara utuh
```

## Sequence Diagram: Halaman Fasilitas Ruangan
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend
    participant Backend as Backend (control)
    participant DB as Database

    User->>Frontend: Ingin melihat-lihat Sarana Fasilitas Ruangan
    Frontend->>Backend: Tuntutan muat ulang data inventaris Ruangan
    
    Backend->>DB: Query tabel nama ruang, letak, detail kapasitas
    DB-->>Backend: Serahkan susunan rekaman prasarana fisik
    
    Backend-->>Frontend: Menyelaraskan daftar HTML/JSON Ruangan
    Frontend-->>User: Paparkan Layar Galeri Estetis Fasilitas Ruangan ke Pandangan
```
## Sequence Diagram: Halaman Fasilitas Laboratorium
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend
    participant Backend as Backend (control)
    participant DB as Database

    User->>Frontend: Mengunjungi Halaman Laboratorium
    Frontend->>Backend: Request info fasilitas Laboratorium
    
    Backend->>DB: Query daftar lengkap ruang Lab beserta perlengkapan
    DB-->>Backend: Return profil Lab, inventaris alat, dan foto prasarana
    
    Backend-->>Frontend: Limpahkan seluruh paket Data (Format Terender)
    Frontend-->>User: Tampilkan Galeri Pesona Fasilitas Laboratorium ke layar
```

## Sequence Diagram: Halaman Kalender Akademik
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend
    participant Backend as Backend (control)
    participant DB as Database

    User->>Frontend: Mengeksplorasi laman Kalender Akademik
    Frontend->>Backend: Memanggil rilis Data Kalender Terkini
    
    Backend->>DB: Tarik spesifik kalender tahun ajaran aktif
    DB-->>Backend: Return teks deskripsi dan aset visual Gambar Kalender
    
    Backend-->>Frontend: Berikan kompilasi kemasan output dokumen Kalender
    Frontend-->>User: Sajikan Tampilan utuh Kalender Akademik Fakultas
```

## Sequence Diagram: Halaman Dokumen Kurikulum
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend
    participant Backend as Backend (control)
    participant DB as Database

    User->>Frontend: Buka direktori akses Dokumen Kurikulum
    Frontend->>Backend: Request sajian materi kurikulum standar
    
    Backend->>DB: Ekstrak catatan profil Kurikulum Fakultas Universal
    DB-->>Backend: Kembalikan deskripsi singkat teks & Link Berkas PDF/DOC
    
    Backend-->>Frontend: Restorasi wujud rilis tabel Kurikulum siap muat
    Frontend-->>User: Suguhkan Antarmuka Dokumen Kurikulum ke khalayak
```

## Sequence Diagram: Halaman Dokumen Fakultas
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend
    participant Backend as Backend (control)
    participant DB as Database

    User->>Frontend: Lintasi indeks halaman Dokumen Fakultas
    Frontend->>Backend: Tuntunan muat ulang daftar indeks Dokumen Publik
    
    Backend->>DB: Kueri pelacakan relasi tabel deret Dokumen Fakultas
    DB-->>Backend: Serahkan susunan judul dan jalur Letak Fail fisis unduhan
    
    Backend-->>Frontend: Ikat tatanan rilis struktur Dokumen Fakultas rilis web
    Frontend-->>User: Tampilkan Tabel Etalase Pengunduhan Dokumen Publik secara anggun
```