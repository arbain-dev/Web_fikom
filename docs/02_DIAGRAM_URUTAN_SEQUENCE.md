# BAB II — DIAGRAM URUTAN (SEQUENCE DIAGRAMS) LINGKUNGAN ADMINISTRATOR

Bagian ini mendeskripsikan secara teknis dan formal urutan pengiriman pesan (*message passing*) antar-objek atau pilar arsitektur sistem khusus untuk pilar manajemen operasional profil instansi di ranah Administrator. Interaksi ini murni menggunakan pendekatan kerangka kerja Arsitektur Lapis Tiga (Frontend, Backend, Database).

## 2.1 Diagram Sequence Manajemen Visi dan Misi Fakultas
**Deskripsi Alur:**
Administrator memulai sesi dengan mengirim draf pembaruan teks statis visi dan misi instansi lewat halaman panel antarmuka dasbor. Frontend meneruskan formulir data yang telah diisi utuh ke arah Backend. Backend kemudian mengeksekusi pemeriksaan sesi (*Session*) administrator pengakses. Bila mendapat izin autentikasi, Backend langsung menjalankan perintah pembaruan data untuk menimpa barisan tulisan basi di tabel Database. Usai Database mengamankan modifikasi barisnya, status pembaruan sah diumpan balik kepada Backend untuk dicetak menjadi notifikasi pemberitahuan (*Alert Success*) di layar Frontend sang Administrator.

```mermaid
sequenceDiagram
    actor Admin
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database
    
    Admin->>Frontend: Mengetik perubahan naskah Visi & Misi dan menekan Simpan
    Frontend->>Backend: Meneruskan formulir naskah teks ke peladen
    Backend->>Backend: Validasi keabsahan input data dan pengecekan Otoritas
    Backend->>Database: Perintah Perbarui Data (Menyimpan naskah baru ke tabel profil)
    Database-->>Backend: Mengembalikan status modifikasi penyimpanan berhasil
    Backend-->>Frontend: Relokasi rute halaman awal & deklarasi pesan pemberitahuan
    Frontend-->>Admin: Menampilkan notifikasi visual pengubahan berhasil dicetak abadi
```

## 2.2 Diagram Sequence Manajemen Struktur Organisasi (Upload Direktori Aset)
**Deskripsi Alur:**
Berbeda dengan sirkuit pengelolaan tulisan semata, manajemen sketsa grafis struktur kepemimpinan organisasi mengikutsertakan pertukaran rekaman fisik. Administrator mengunggah berkas foto (*File Upload*). Backend mutlak memeriksa validasi keamanan tipe bawaan file serta membatasi ukuran maksimalnya. Setelelahnya disetujui sah, Backend mengambil data gambar basi dari Database untuk menjalankan perintah hapus (*Unlink*) rekaman foto lama pada perantara penyimpanannya secara internal logis. Berlanjut menjalankan penyalinan grafis mutakhir *(Move_Uploaded_File)*. Backend mentransmisikan alamat letak direktori foto baru untuk diabadikan oleh sang Database.

```mermaid
sequenceDiagram
    actor Admin
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database
    
    Admin->>Frontend: Mengunggah berkas resolusi (.jpg/.png) & memicu aksi konfirmasi
    Frontend->>Backend: Meneruskan berkas foto dan rincian formulir ke peladen
    Backend->>Backend: Pengecekan tipe berkas anti-virus & menahan ekstensi batas ukuran maksimal
    Backend->>Database: Perintah Ambil Data (Mencari letak jejak gambar sketsa lama)
    Database-->>Backend: Pelaporan rujukan URL letak eksistensi gambar lampau usang
    Backend->>Backend: Perintah Internal: Pelenyapan wujud fisik file foto bekas
    Backend->>Backend: Perintah Internal: Penempelan wujud fisik fail foto pendatang baru
    Backend->>Database: Perintah Perbarui Data (Menyimpan alamat letak foto baru ke kolom tabel)
    Database-->>Backend: Laporan keberhasilan mutlak atas sinkronisasi tabel gambar teraktual
    Backend-->>Frontend: Melakukan pemuatan instan antarmuka disertai pemanggil gambar terbaru
    Frontend-->>Admin: Pameran grafis pemberitahuan keberhasilan transaksional gambar terbaru
```

## 2.3 Diagram Sequence Manajemen Fakta Sivitas Ekademika (CRUD Angka)
**Deskripsi Alur:**
Rancang bangun antarmuka pengelolaan matriks kalkulasi sivitas mahasiswa maupun jurnal (Fakta Fakultas) dioperasikan memakai prosedur silang baca tulisan Tambah / Modifikasi angka. Administrator mendikte penetapan identitas entitas berupa nama judul fakta, jumlah angka anggota, dan ketertiban tata urutan (*sorting order*). Usai melewati penapisan pelindung dari nilai keliru di Backend, data diteruskan lewat perintah penyimpanan spesifik Database MYSQL. Sesampainya perputaran status rekam sempurna terespons, rujukan matriks daftar tampilan tabel Frontend dideklarasikan secara otomatis.

```mermaid
sequenceDiagram
    actor Admin
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database
    
    Admin->>Frontend: Menyuntikkan masukan judul agregat, nilai total, & urutan daftar
    Frontend->>Backend: Meneruskan formulir penyampaian (Aksi Tambah atau Pembaruan Khusus)
    Backend->>Backend: Pemeriksaan kesesuaian parameter angka deret logis mutlak
    Backend->>Database: Perintah Simpan Data (Menambah / Memperbarui rekaman fakta ke tabel)
    Database-->>Backend: Konfirmasi balasan berhasil menyangkut pencatatan rekaman matriks
    Backend->>Database: Perintah Ambil Data (Meminta penarikan daftar fakta terbaru secara sinkron)
    Database-->>Backend: Kembalikan serentetan rekam data susunan angka komplit
    Backend-->>Frontend: Restorasi tabel bentuk grid berbaris utuh ke tampilan rujukan panel
    Frontend-->>Admin: Mentransformasikan tayangan matriks data secara mutakhir
```

## 2.4 Diagram Sequence Manajemen Tentang Fakultas 
**Deskripsi Alur:**
Kompleksitas pemeliharaan rangkuman deskriptif narasi murni sejarah instansi bertumpu utuh di perantara *Form Text Editor*. Pengguna otoritatif admin mendedikasikan penuangan gagasan reka pemaparan pada lajur isian Frontend. Eksekusi pengiriman isian menembus Backend validasi agar tiada pencemaran huruf berbahaya, barulah Backend memohon restu perintah pembaruan naratif ke Database untuk disimpan dan dibaca secara eksklusif berulang-ulang sampai masa revisi dicanangkan kelak.

```mermaid
sequenceDiagram
    actor Admin
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database
    
    Admin->>Frontend: Mengekspos komposisi teks informasi deskripsi organisasi lengkap dan menekan Konfirmasi
    Frontend->>Backend: Meneruskan formulir utuh berisi naskah tentang pelaporan institusi fakultas
    Backend->>Backend: Uji saring kebersihan kalimat agar bebas karsinogen kode jahat (*Text XSS Filtering*)
    Backend->>Database: Perintah Perbarui Data (Menyimpan naskah narasi entitas baru seutuhnya)
    Database-->>Backend: Transmisikan persetujuan perizinan suksesnya mutasi penyusupan data tabel
    Backend-->>Frontend: Reorganisasi mendikte penataan antarmuka dasbor agar pulih berwibawa pasca transisi kueri
    Frontend-->>Admin: Pemberian validasi umpan silang akan suksesnya penaungan narasi absolut organisasi 
```
