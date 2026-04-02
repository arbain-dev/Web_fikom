# BAB II — DIAGRAM URUTAN (SEQUENCE DIAGRAMS) LINGKUNGAN ADMINISTRATOR

Bagian ini mendeskripsikan secara teknis dan formal urutan pengiriman pesan (*message passing*) antar-objek atau pilar arsitektur sistem khusus untuk pilar manajemen operasional profil instansi di ranah Administrator. Interaksi ini murni menggunakan pendekatan kerangka kerja Arsitektur Lapis Tiga (Frontend, Backend, Database).

## 2.1 Diagram Sequence Manajemen Visi dan Misi Fakultas
**Deskripsi Alur:**
Administrator memulai sesi dengan mengirim draf pembaruan teks statis visi dan misi instansi lewat halaman panel antarmuka dasbor. Frontend meneruskan pemanggilan rute parameter berjenis `HTTP POST` utuh ke arah Backend. Backend kemudian mengeksekusi pemeriksaan sesi (*Session*) administrator pengakses. Bila mendapat izin autentikasi, Backend langsung mengeksekusi kueri `UPDATE` untuk menimpa barisan tulisan basi di tabel Database. Usai Database mengamankan modifikasi barisnya, status pembaruan sah diumpan balik kepada Backend untuk dicetak menjadi notifikasi pemberitahuan (*Alert Success*) di layar Frontend sang Administrator.

```mermaid
sequenceDiagram
    actor Admin
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database
    
    Admin->>Frontend: Mengetik perubahan naskah Visi & Misi dan menekan Simpan
    Frontend->>Backend: Mengirim transmisi parameter naskah teks [HTTP POST]
    Backend->>Backend: Validasi keabsahan paket data kosong dan pengecekan Otoritas
    Backend->>Database: Execute Query (Prosedur relasional UPDATE tabel profil teks)
    Database-->>Backend: Mengembalikan perizinan status modifikasi logis berhasil
    Backend-->>Frontend: Relokasi rute halaman awal & pelepasan deklarasi pesan pemberitahuan
    Frontend-->>Admin: Menampilkan notifikasi visual pengubahan berhasil dicetak abadi
```

## 2.2 Diagram Sequence Manajemen Struktur Organisasi (Upload Direktori Aset)
**Deskripsi Alur:**
Berbeda dengan sirkuit pengelolaan tulisan semata, manajemen sketsa grafis struktur kepemimpinan organisasi mengikutsertakan pertukaran rekaman fisik. Administrator mengunggah formulir lampiran rupa (*File Upload*). Backend mutlak memeriksa validasi keamanan tipe bawaan file (*Mime-Type*) serta pembatasan pemuatan limit margin (*Max-Size*). Setelelahnya disetujui sah, Backend mencabut kueri gambar basi dari Database untuk mengeksekusi prosedur hapus (*Unlink*) rekaman wujud foto lama pada perantara penyimpanannya secara internal logis. Berlanjut menanam penyalinan injeksi grafis mutakhir *(Move_Uploaded_File)*. Backend mentransmisikan deret rentang direktori alamat URL foto untuk diabadikan oleh sang Database.

```mermaid
sequenceDiagram
    actor Admin
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database
    
    Admin->>Frontend: Mengunggah ekstensi file resolusi (.jpg/.png) & memicu aksi konfirmasi
    Frontend->>Backend: Transmisi enkripsi [Multipart Form-Data] HTTP Input Header
    Backend->>Backend: Pengecekan filtrat Tipe Bawaan Lapis Peretas & Ketahanan Ekstensi Max-Size
    Backend->>Database: Execute Query (SELECT letak jejak gambar sketsa struktur lama)
    Database-->>Backend: Pelaporan rujukan URL parameter eksistensi gambar lampau usang
    Backend->>Backend: Eksekusi pelenyapan memori wujud fisik file bekas (Unlink)
    Backend->>Backend: Eksekusi penempelan wujud fail grafis pendatang baru (Move_Uploaded_File)
    Backend->>Database: Execute Query (Mengedarkan UPDATE nama_path kolom gambar tabel)
    Database-->>Backend: Laporan keberhasilan mutlak sinkronisasi basis matriks teraktual
    Backend-->>Frontend: Melakukan pemuatan instan antarmuka disertai pemanggil gambar terbaru
    Frontend-->>Admin: Pameran grafis pemberitahuan keberhasilan transaksional gambar terbaru
```

## 2.3 Diagram Sequence Manajemen Fakta Sivitas Ekademika (CRUD Angka)
**Deskripsi Alur:**
Rancang bangun antarmuka pengelolaan matriks kalkulasi sivitas mahasiswa maupun jurnal (Fakta Fakultas) dioperasikan memakai prosedur silang baca tulisan Tambah / Modifikasi numerologikal (*Integer Create/Update Schema*). Administrator mendikte penetapan identitas entitas berupa nama wujud judul fakta, penjabaran bilangan jumlah agregat anggota, dan ketertiban tata urutan (*sorting order*). Usai melewati penapisan (*filter*) tipe variabel di tingkat Backend, lalu lintas deklarasi diteruskan lewat injeksi *Statement Parametris* Database MYSQL. Sesampainya perputaran status rekam sempurna terespons, rujukan matriks daftar tampilan tabel Frontend dideklarasikan secara otomatis.

```mermaid
sequenceDiagram
    actor Admin
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database
    
    Admin->>Frontend: Menyuntikkan input penetapan rincian tipe judul agregat, nilai & relasi Urut
    Frontend->>Backend: Transmisi peredaran parameter [Aksi Tambah] atau [Pemutakhiran Baris Eksklusif]
    Backend->>Backend: Pemeriksaan konversi paksa parameter kalkulasi deret numerologikal pasti
    Backend->>Database: Eksekusi sirkuit Kueri Persilangan Cerdas (Sintaks Tertuang INSERT / UPDATE)
    Database-->>Backend: Konfirmasi balasan transaksional berhasil menyangkut pencatatan rekaman matriks
    Backend->>Database: Penerbitan kueri SELECT penyaringan rekaman tabel agar daftar diantarkan sinkron
    Database-->>Backend: Kembalikan serentetan pemadatan rekam data agregat kalkulasi komplit
    Backend-->>Frontend: Restorasi tabel grid berbaris utuh panel dasbor rujukan peluncuran ulang
    Frontend-->>Admin: Mentransformasikan visual matriks data terbaharui secara mutakhir
```

## 2.4 Diagram Sequence Manajemen Tentang Fakultas 
**Deskripsi Alur:**
Kompleksitas pemeliharaan rangkuman deksriptif narasi murni sejarah instansi bersertakan pemaparan filosofikal bertumpu utuh di perantara *Form Text Editor*. Pengguna otoritatif admin mendedikasikan penuangan gagasan reka pemaparan pada lajur isian Frontend. Eksekusi pengedaran parameter menembus Backend validasi agar tiada pencemaran tag naskah destruktif, barulah Backend memohon restu kueri barisan modifikasi *UPDATE* ke Database untuk dimuat rekam eksklusif selamanya sampai kedatangan waktu revisi masa seberang.

```mermaid
sequenceDiagram
    actor Admin
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database
    
    Admin->>Frontend: Mengekspos komposisi teks informasi deskriptif absolut organisasi dan menekan Konfirmasi
    Frontend->>Backend: Mengantarkan utuh variabel paket penyampaian pembaruan isi pemaparan fakultas
    Backend->>Backend: Kalibrasi sanitansi pelucutan karsinogen anomali pembacaan *Text XSS Filtering*
    Backend->>Database: Memanggil protokol arsitektur eksekusi rute UPDATE narasi entitas absolut 
    Database-->>Backend: Transmisikan kode persetujuan kesuksesan mutasi pangkalan nilai rekaman
    Backend-->>Frontend: Reorganisasi mendikte penataan rupa antarmuka dasbor kembali utuh pasca transisi kueri
    Frontend-->>Admin: Pemberian validasi umpan silang kesuksesan tersematnya narasi informasional absolut
```
