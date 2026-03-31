# Sequence Diagram: Halaman Data Civitas Akademika

Diagram sekuensial ini menjelaskan alur operasional di balik layar ketika pengguna melihat halaman informasi **Data Civitas Akademika** (seperti profil dosen maupun tenaga kependidikan).

## Penjelasan Alur

Alur komunikasi pada diagram sekuensial ini bermula tatkala pengguna mengeklik menu atau langsung mengarahkan tautan URL untuk mengakses halaman Data Civitas Akademika. Panggilan antarmuka tersebut ditangkap terlebih dahulu oleh tulang punggung aplikasi (`index.php`), yang berperan meretas rute agar sistem dapat memanggil skrip fungsional yang berkaitan dengan halaman data (*civitas*). Setelah skrip diinisiasi, sebuah sesi negosiasi kepada lapis *database* (MySQL) pun disiapkan supaya situs web dapat bertukar informasi dengan aman.

Melalui saluran penghubung basis data inilah, halaman Data Civitas secara aktif menghantarkan sekumpulan instruksi kueri untuk membentangkan profil para tenaga pengajar (dosen) berserta staf kependidikan yang terekam pada tabel sistem. Data rincian yang antara lain memuat potret jabatan dan latar belakang akademik tersebut lantas direkam sejenak di sisi *server*. Tak lama setelahnya, kerangka visual atas navigasi halaman (`includes/header.php`) diproses. Sistem merakit profil tiap-tiap entitas sivitas ini dalam tata letak yang berkesinambungan layaknya sebuah presentasi balok matriks (HTML *grid* statis), menyelaraskannya dengan blok ujung (`includes/footer.php`), hingga terbentuk sebuah keluaran tanggapan kode respons (HTML) yang dikirim dan dicetak ke peramban pengguna.

## Diagram

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
