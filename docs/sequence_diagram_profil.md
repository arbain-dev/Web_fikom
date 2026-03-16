# Sequence Diagram: Halaman Profil dan Informasi Fakultas

Diagram sekuensial ini memvisualisasikan alur kerja interaksi sistem ketika pengguna (pengunjung) mengakses kelompok halaman profil fakultas, yang meliputi halaman **Visi dan Misi**, **Struktur Organisasi**, **Data Civitas Akademika**, serta **Tentang Fakultas**.

## Penjelasan Alur

Diagram sekuensial berikut menjabarkan alur interaksi sistem ketika seorang pengguna mengakses kelompok halaman profil fakultas. Pada tahap awal, pengunjung menginisiasi permintaan melalui peramban (browser) untuk membuka salah satu tautan halaman spesifik. Permintaan ini pertama kali diterima oleh berkas indeks utama yang berfungsi sebagai pengatur rute (*router*) dan pusat inisialisasi konfigurasi sistem. Berdasar pada rute yang diminta, berkas indeks kemudian memuat dan mengeksekusi berkas halaman spesifik (misalnya halaman visi dan misi, struktur organisasi, dan lain sebagainya). Setelah itu, berkas halaman tersebut akan membangun koneksi dengan basis data guna melakukan penarikan informasi yang paling relevan. Sistem secara dinamis akan mengeksekusi kueri yang berbeda secara spesifik bergantung pada halaman yang sedang dibuka; misalnya mengambil teks penjabaran visi dan misi, memuat rincian data pejabat untuk struktur organisasi, menarik daftar nama beserta jabatan untuk data civitas akademika, atau mengambil narasi profil dan sejarah untuk halaman tentang fakultas. Begitu data yang diperlukan berhasil diletakkan pada memori, sistem mulai menyusun antarmuka visual dengan memuat komponen navigasi atas (*header*), menyematkan data-data tersebut ke dalam kerangka tata letak konten utama, hingga akhirnya memuat komponen penutup bawah (*footer*). Seluruh rangkaian komponen tersebut digabungkan menjadi sebuah dokumen HTML yang padu dan utuh, untuk kemudian dikirimkan kembali sebagai respons HTTP dan ditampilkan secara paripurna pada layar peramban pengguna.

## Diagram

```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung/User
    participant Browser
    participant Index as index.php
    participant Page as Halaman Profil<br/>(Visi Misi / Struktur dll.)
    participant DB as Database (MySQL)
    participant Header as includes/header.php
    participant Footer as includes/footer.php

    User->>Browser: Klik menu/tautan halaman profil
    Browser->>Index: HTTP GET Request (/profil/...)
    
    Index->>Index: Inisialisasi konfigurasi & routing
    Index->>Page: Mengarahkan dan memuat (include) halaman spesifik
    
    Page->>Page: Memuat konfigurasi koneksi basis data
    
    alt Halaman Visi & Misi
        Page->>DB: Eksekusi kueri data visi dan misi fakultas
        DB-->>Page: Mengembalikan teks data visi & misi
    else Halaman Struktur Organisasi
        Page->>DB: Eksekusi kueri data pimpinan dan bagan organisasi
        DB-->>Page: Mengembalikan data struktur organisasi
    else Halaman Data Civitas
        Page->>DB: Eksekusi kueri data dosen dan tenaga kependidikan
        DB-->>Page: Mengembalikan rincian data civitas
    else Halaman Tentang Fakultas
        Page->>DB: Eksekusi kueri profil, deskripsi, dan sejarah
        DB-->>Page: Mengembalikan data tentang fakultas
    end
    
    Page->>Header: Include includes/header.php
    Header-->>Page: Render komponen Header (Navigasi & Logo)
    
    Note over Page: Sistem merangkai data dinamis<br/>ke dalam kerangka antarmuka utama (HTML)
    
    Page->>Footer: Include includes/footer.php
    Footer-->>Page: Render komponen Footer (Informasi kontak & Skrip)
    
    Page-->>Index: Proses penyusunan halaman selesai
    Index-->>Browser: HTTP Response (Dokumen HTML)
    Browser-->>User: Halaman profil ditampilkan secara utuh
```
