# Sequence Diagram: Halaman Struktur Organisasi

Diagram sekuensial ini memvisualisasikan alur kerja interaksi sistem ketika seorang pengguna mengakses halaman **Struktur Organisasi** fakultas.

## Penjelasan Alur

Rangkaian interaksi skema Struktur Organisasi bermula di titik ketika pengguna mencetuskan kunjungan sistemnya melalui perpindahan navigasi menuju halaman struktur. Layaknya sistem manajemen rute satu pintu, pengelola `index.php` senantiasa mencatat dan mengolah permintaan (*request*) ini supaya dapat menyerahkan wewenang kontrol pemrosesan kepada unit berkas yang secara dedikatif dirancang untuk membacakan struktur organisasi fakultas. Sejak unit ini menerima beban kerja, konfigurasi *framework* dan modul ikatan basis data MySQL pun seketika dibangun guna merembuk kesepakatan penarikan informasi antara *server* dan *database*.

Dengan meluncurkan baris perintah *query select*, sistem lantas membongkar koleksi tabel data untuk mengekstraksi senarai pimpinan pemegang mandat struktural fakultas dan mengambil rincian grafis terkait urutan eselon bagan hierarki tersebut. Bersamaan dengan pangkalan data yang menggulirkan balikan nilai data, sistem membagi kerangka *front-end* dengan menganyam batas navigasi pucuk situs (`includes/header.php`), mengisi badan templat web HTML dengan hasil pementasan daftar bagan pemimpin, serta melampirkan modul pengaya yang ada pada lantai kaki elemen (`includes/footer.php`). Lewat penggabungan tripartit inilah, sebuah arsitektur dokumen web terwujud paripurna lalu dipersembahkan ke arah layar peramban audiens.

## Diagram

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
