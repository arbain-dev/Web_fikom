# Sequence Diagram: Halaman Tentang Fakultas

Diagram sekuensial ini merinci alur di dalam sistem tatkala seorang pengguna mencoba melihat halaman informasi detail histori maupun entitas **Tentang Fakultas**.

## Penjelasan Alur

Berikut rincian naratif tahapan pemanggilan atas halaman tentang fakultas:
1. **Interaksi Pengawal**: Pengguna mengunjungi situs dan mengarahkan navigasinya ke tautan "Tentang Fakultas" pada kumpulan menu beranda. 
2. **Pola Pengendalian Rute**: *Web server* melimpahkan permintaan (*request*) tersebut ke skrip peladen utama kita, yaitu berkas `index.php`. Skrip inilah yang menugaskan penanganan awal berdasarkan struktur antarmuka URL.
3. **Delegasi ke Modul Halaman**: Di bawah komando `index.php`, skrip fungsionalitas dari unit "Halaman Tentang Fakultas" dipanggil agar dieksekusi pemrosesannya.
4. **Pembukaan Gerbang Basis Data**: Konfigurasi sambungan instansial ke ruang server basis data (*MySQL*) diresmikan lewat inklusi (*include*) *config database*.
5. **Penggalian Substansi Sejarah**: Sistem menyampaikan kueri pemilahan informasi pada skema basis data dengan tujuan mengambil narasi panjang profil, deskripsi visi sejarah berdirinya, dan/atau citra estetis tentang fakultas.
6. **Basis Data Bersuara**: Basis data menanggapinya dengan mengirimkan luaran set (*result set*) dari profil dekanat/fakultas yang otentik kembali pada berkas peminta tersebut.
7. **Penyanderaan Header**: Tatanan kepala (*Header*) navigasi dan pengaya (*CSS*) dipetik dan dirawikan memakai `includes/header.php`.
8. **Asimilasi Teks Naratif**: Narasi sejarah, potret (*image*), serta pendahuluan (*overview*) dilebur menyatu menempati struktur badan kode (*body html*).
9. **Penjagaan Titik Akhir**: Perangkat `includes/footer.php` ditautkan buat menetapkan bingkai kaki yang paripurna (lengkap dengan hak cipta dan sambungan media sosial).
10. **Penggenapan Halaman**: Susunan padu yang final ini dikemas lalu dilontarkan lewat pintu keluar sebagai tanggapan web kepada pembaca, dengan seutuhnya menayangkan profil rinci mengenai pihak fakultas.

## Diagram

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
