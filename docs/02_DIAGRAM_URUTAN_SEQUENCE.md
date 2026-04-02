# BAB II — DIAGRAM URUTAN (SEQUENCE DIAGRAMS) LINGKUNGAN ADMINISTRATOR

Bagian ini mendeskripsikan secara teknis dan formal urutan pengiriman pesan (*message passing*) antar-objek atau pilar arsitektur sistem khusus untuk pilar manajemen operasional profil instansi di ranah Administrator. Interaksi ini menggunakan pendekatan kerangka kerja Arsitektur Lapis Tiga (Klien, Peladen, Pangkalan Data/Penyimpanan).

## 2.1 Diagram Sequence Manajemen Visi dan Misi Fakultas
**Deskripsi Alur:**
Administrator memulai sesi dengan mengirim draf pembaruan teks statis visi dan misi instansi lewat halaman panel antarmuka dasbor. Antarmuka meneruskan pemanggilan rute parameter berjenis `HTTP POST` utuh ke arah sistem pengendali (*Web Controller*). Sistem kemudian mengeksekusi pemeriksaan sesi (*Session*) administrator pengakses. Bila mendapat izin autentikasi, sistem langsung mengeksekusi kueri `UPDATE` untuk menimpa barisan tulisan basi di tabel basis data MySQL. Usai relasi pangkalan data mengamankan modifikasi barisnya, status pembaruan sah diumpan balik kepada sistem untuk dicetak menjadi notifikasi pemberitahuan (*Alert Success*) di layar sang Administrator.

```mermaid
sequenceDiagram
    actor Admin
    participant Antarmuka as Antarmuka Pengguna
    participant Sistem as Sistem Web Web_FIKOM
    participant Database as Database MySQL
    
    Admin->>Antarmuka: Mengetik perubahan naskah Visi & Misi dan menekan Simpan
    Antarmuka->>Sistem: Mengirim transmisi parameter naskah teks [HTTP POST]
    Sistem->>Sistem: Validasi keabsahan paket data kosong dan pengecekan Otoritas Murni
    Sistem->>Database: Execute Query (Prosedur relasional UPDATE tabel profil teks institusional)
    Database-->>Sistem: Mengembalikan perizinan status baris modifikasi logis berhasil
    Sistem-->>Antarmuka: Relokasi rute halaman awal & pelepasan deklarasi pesan pemberitahuan
    Antarmuka-->>Admin: Menampilkan notifikasi visual bahwasannya perombakan telah berhasil dicetak abadi
```

## 2.2 Diagram Sequence Manajemen Struktur Organisasi (Upload Direktori Aset)
**Deskripsi Alur:**
Berbeda dengan sirkuit pengelolaan tulisan semata, manajemen sketsa grafis struktur kepemimpinan organisasi mengikutsertakan intervensi pilar `Storage` (Direktori Arsip Penyimpanan Fisik Aset Mesin Eksekutor). Administrator mengunggah formulir lampiran rupa (*File Upload*). Sistem (*Peladen*) mutlak memeriksa validasi keamanan tipe bawaan file (*Mime-Type*) serta pembatasan pemuatan limit margin (*Max-Size*). Setelelahnya disetujui sah, sistem mencabut kueri gambar basi dari basis data untuk memusnahkan (*Unlink Delete*) rekaman wujud foto lama pada direktorat `Storage`. Berlanjut menanam penyalinan injeksi grafis mutakhir *(Move_Uploaded_File)*. Sistem murni mentransmisikan deret rentang direktori (Alamat URL/Path) letak foto untuk diabadikan oleh sang Pangkalan Relasional (MySQL) bukan bentuk wujud fisik foto mentahnya.

```mermaid
sequenceDiagram
    actor Admin
    participant Antarmuka as Antarmuka Pengguna
    participant Sistem as Sistem Web Web_FIKOM
    participant Storage as Storage (Direktori Aset Lokal)
    participant Database as Database MySQL
    
    Admin->>Antarmuka: Mengunggah ekstensi file resolusi (.jpg/.png) & memicu aksi konfirmasi
    Antarmuka->>Sistem: Transmisi enkripsi [Multipart Form-Data] HTTP Input Header
    Sistem->>Sistem: Pengecekan filtrat Tipe Bawaan Lapis Peretas & Ketahanan Ukuran Data Berlebihan
    Sistem->>Database: Execute Query (SELECT letak jejak gambar sketsa struktur lama)
    Database-->>Sistem: Pelaporan rujukan URL parameter eksistensi gambar lampau usang
    Sistem->>Storage: Pemicuan eksekusi pelenyapan memori file bekas (Unlink Command Action)
    Sistem->>Storage: Eksekusi penempelan cetak rilis fail grafis pendatang baru (Move Tmp File)
    Storage-->>Sistem: Respon verifikasi kapasitas penyimpanan memuat foto utuh
    Sistem->>Database: Execute Query (Mengedarkan UPDATE nama_path kolom gambar tabel statisnya saja)
    Database-->>Sistem: Laporan keberhasilan mutlak sinkronisasi basis matriks basisdata teraktual
    Sistem-->>Antarmuka: Melakukan pemuatan instan antarmuka disertai pemanggilan pemuatan gambar terbaru
    Antarmuka-->>Admin: Pameran grafis pemberitahuan keberhasilan transaksional + Menilik bagan relasi gambar terbaru
```

## 2.3 Diagram Sequence Manajemen Fakta Sivitas Ekademika (CRUD Angka)
**Deskripsi Alur:**
Rancang bangun antarmuka pengelolaan matriks kalkulasi sivitas mahasiswa maupun jurnal (Fakta Fakultas) dioperasikan memakai prosedur silang baca tulisan Tambah / Modifikasi numerologikal (*Integer Create/Update Schema*). Administrator mendikte penetapan identitas entitas berupa nama wujud judul fakta, penjabaran bilangan jumlah agregat anggota, dan ketertiban tata urutan (*sorting order*). Usai melewati penapisan (*filter*) tipe variabel di tingkat mesin perantara PHP, lalu lintas deklarasi diteruskan lewat injeksi *Statement Parametris* Database MYSQL. Sesampainya perputaran status rekam sempurna terespons, rujukan matriks daftar tampilan tabel antarmuka dideklarasikan secara otomatis.

```mermaid
sequenceDiagram
    actor Admin
    participant Antarmuka as Antarmuka Pengguna
    participant Sistem as Sistem Web Web_FIKOM
    participant Database as Database MySQL
    
    Admin->>Antarmuka: Menyuntikkan input penetapan rincian tipe judul agregat, margin desimal & relasi Urut
    Antarmuka->>Sistem: Transmisi peredaran parameter [Aksi Tambah] atau [Pemutakhiran Baris Eksklusif]
    Sistem->>Sistem: Pemeriksaan konversi paksa parameter kalkulasi deret numerologikal pasti
    Sistem->>Database: Eksekusi sirkuit Kueri Persilangan Cerdas (Sintaks Tertuang INSERT / UPDATE Tepat Guna)
    Database-->>Sistem: Konfirmasi balasan transaksional berhasil menyangkut di bilik pencatatan baris rekaman matriks
    Sistem->>Database: Penerbitan kueri SELECT penyaringan rekaman tabel agar daftar diantarkan sinkron waktu rilis mutakhir
    Database-->>Sistem: Kembalikan serentetan pemadatan rekam data agregat kalkulasi komplit ke tangan mesin Sistem
    Sistem-->>Antarmuka: Restorasi tabel grid berbaris utuh panel dasbor rujukan peluncuran ulang
    Antarmuka-->>Admin: Mentransformasikan visual matriks data yang diperbarui menyingkirkan penyajian rekam data purbakala
```

## 2.4 Diagram Sequence Manajemen Tentang Fakultas 
**Deskripsi Alur:**
Kompleksitas pemeliharaan rangkuman deksriptif narasi murni sejarah instansi bersertakan pemaparan filosofikal bertumpu utuh di perantara *Form Text Editor*. Pengguna otoritatif admin mendedikasikan penuangan gagasan reka pemaparan pada lajur isian tersebut. Eksekusi pengedaran parameter menembus *Middleware* keamanan mesin validasi agar tiada pencemaran tag naskah destruktif, barulah mesin Peladen memohon restu kueri barisan modifikasi *UPDATE* ke persinggahan tunggal pangkalan data peladen untuk dimuat rekam eksklusif selamanya sampai kedatangan waktu revisi masa seberang.

```mermaid
sequenceDiagram
    actor Admin
    participant Antarmuka as Antarmuka Pengguna
    participant Sistem as Sistem Web Web_FIKOM
    participant Database as Database MySQL
    
    Admin->>Antarmuka: Mengekspos paragraf komposisi teks informasi deskriptif absolut organisasi dan menekan Konfirmasi Update Teks
    Antarmuka->>Sistem: Mengantarkan utuh variabel paket penyampaian pembaruan isi pemaparan fakultas
    Sistem->>Sistem: Kalibrasi sanitansi pelucutan karsinogen anomali pembacaan *Text XSS Filtering* pencegat intrusi keamanan silang peladen
    Sistem->>Database: Memanggil protokol spesifik arsitektur eksekusi relasi UPDATE narasi entitas Tentang_Fakultas absolut 
    Database-->>Sistem: Transmisikan kode persetujuan kesuksesan mutasi pangkalan nilai rekaman
    Sistem-->>Antarmuka: Reorganisasi *Header Redirect* mendikte antarmuka pemantauan panel admin menata rupa kembali pasca transisi kueri
    Antarmuka-->>Admin: Pemberian validasi umpan silang kesuksesan tersematnya narasi informasional absolut organisasi
```
