# BAB II — DIAGRAM URUTAN

Bagian ini mendeskripsikan secara teknis dan formal urutan pengiriman pesan antar-objek atau pilar arsitektur sistem. Interaksi diuraikan menggunakan pendekatan kerangka kerja Arsitektur Lapis Tiga (Frontend, Sistem Pengendali Pusat, Database) dengan narasi deskriptif berbentuk paragraf baku.

## 2.1 Lingkungan Pengunjung
Bagian ini memvisualisasikan interaksi yang terjadi saat antarmuka publik atau pengunjung berinteraksi dengan sistem peladen.

### 2.1.1 Sequence Diagram: Halaman Utama
Proses pada Halaman Utama dimulai ketika pengguna membuka halaman beranda melalui peramban web. Antarmuka Layar menerima permintaan tersebut dan meneruskannya ke Sistem Pengendali. Sistem Pengendali kemudian mengirimkan beberapa permintaan data sekaligus ke Pangkalan Data, yaitu meminta data *Slider* banner, data berita terbaru, data fakta fakultas, deskripsi tentang fakultas, serta data mitra kerja sama. Pangkalan Data memberikan seluruh data yang diminta kembali ke Sistem Pengendali. Setelah semua data terkumpul, Sistem Pengendali menggabungkan dan menyusun data-data tersebut menjadi satu tampilan halaman web yang utuh, lalu mengirimkannya ke Antarmuka Layar untuk ditampilkan kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Buka Halaman Home
    Frontend->>Backend: Meminta semua data utama
    
    Backend->>Database: Meminta data Slider
    Backend->>Database: Meminta data Berita Terbaru
    Backend->>Database: Meminta data Fakta Fakultas
    Backend->>Database: Meminta data Tentang Fakultas
    Backend->>Database: Meminta data Mitra Kerja Sama
    
    Backend-->>Frontend: Menggabungkan dan menyusun Tampilan Web
    Frontend-->>User: Tampilkan Data Di Halaman Home
```

---

### 2.1.2 Sequence Diagram: Halaman Data Civitas Akademika
Proses dimulai ketika pengguna mengklik menu atau mengakses langsung halaman Data Civitas Akademika. Antarmuka Layar menerima permintaan tersebut dan meneruskannya ke Sistem Pengendali dengan meminta susunan data civitas. Sistem Pengendali kemudian mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan himpunan rekaman data civitas yang mencakup informasi dosen dan staf kependidikan. Setelah data diterima, Sistem Pengendali menggabungkan dan menyusun data tersebut menjadi tampilan web yang utuh, kemudian mengirimkannya ke Antarmuka Layar untuk ditampilkan secara lengkap kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Akses / Klik menu Civitas Akademika
    Frontend->>Backend: Meminta susunan data Civitas
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Mengembalikan himpunan rekaman data civitas
    
    Backend-->>Frontend: Menggabungkan dan menyusun Tampilan Web utuh
    Frontend-->>User: Tampilkan Halaman Data Civitas utuh
```

---

### 2.1.3 Sequence Diagram: Halaman Struktur Organisasi
Proses dimulai ketika pengguna mengklik menu atau mengakses halaman Struktur Organisasi. Antarmuka Layar meneruskan permintaan tersebut ke Sistem Pengendali untuk meminta bagan struktur organisasi. Sistem Pengendali kemudian mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan data teks struktur organisasi, termasuk susunan hierarki jabatan dan nama-nama pimpinan yang terdaftar. Setelah data diterima, Sistem Pengendali menggabungkan dan menyusunnya menjadi tampilan halaman web yang siap ditampilkan, lalu Antarmuka Layar menayangkan halaman Struktur Organisasi tersebut kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Akses / Klik menu Struktur Organisasi
    Frontend->>Backend: Meminta bagan Struktur Organisasi
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Mengembalikan teks data struktur organisasi
    
    Backend-->>Frontend: Menggabungkan dan menyusun Tampilan Web
    Frontend-->>User: Tampilkan Halaman Struktur Organisasi
```

---

### 2.1.4 Sequence Diagram: Halaman Tentang Fakultas
Proses dimulai ketika pengguna mengklik menu atau mengakses halaman Tentang Fakultas. Antarmuka Layar meneruskan permintaan tersebut ke Sistem Pengendali untuk meminta rincian narasi profil fakultas. Sistem Pengendali kemudian mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan teks deskripsi fakultas yang mencakup sejarah singkat, gambaran umum, dan informasi profil yang relevan. Setelah data diterima, Sistem Pengendali menyusun data tersebut menjadi tampilan web yang siap saji, kemudian Antarmuka Layar menampilkan halaman Tentang Fakultas secara lengkap kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Akses / Klik menu Tentang Fakultas
    Frontend->>Backend: Meminta rincian narasi Profil Fakultas
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Mengembalikan teks deskripsi fakultas
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Siap Jadi
    Frontend-->>User: Tampilkan Halaman Tentang Fakultas
```

---

### 2.1.5 Sequence Diagram: Halaman Visi dan Misi
Proses dimulai ketika pengguna mengklik menu atau mengakses halaman Visi dan Misi. Antarmuka Layar meneruskan permintaan tersebut ke Sistem Pengendali untuk meminta susunan teks visi dan misi. Sistem Pengendali kemudian mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan naskah penjabaran visi dan misi yang tersimpan, mencakup pernyataan visi serta butir-butir misi yang berlaku. Setelah menerima data tersebut, Sistem Pengendali menyusunnya menjadi tampilan halaman web yang siap ditampilkan, dan Antarmuka Layar kemudian menayangkan halaman Visi dan Misi secara lengkap kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Akses / Klik Visi dan Misi
    Frontend->>Backend: Meminta susunan teks Visi Misi
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Mengembalikan naskah penjabaran visi misi
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Siap Jadi
    Frontend-->>User: Tampilkan Halaman Visi & Misi
```

---

### 2.1.6 Sequence Diagram: Halaman Profil Dosen
Proses dimulai ketika pengguna mengklik menu Profil Dosen. Antarmuka Layar meneruskan permintaan tersebut ke Sistem Pengendali untuk meminta rincian direktori riwayat dosen. Sistem Pengendali kemudian mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan data profil setiap dosen yang meliputi nama, NIDN, jabatan fungsional, serta referensi foto profil. Setelah data diterima, Sistem Pengendali menyusunnya menjadi tampilan web yang siap ditampilkan, kemudian Antarmuka Layar menayangkan halaman Profil Dosen dalam tampilan kartu grid yang rapi kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Klik menu Profil Dosen
    Frontend->>Backend: Meminta rincian direktori riwayat Dosen
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Mengembalikan profil nama, NIDN, jabatan, foto internal
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Siap Jadi
    Frontend-->>User: Tampilkan Grid Kartu Profil Para Dosen
```

---

### 2.1.7 Sequence Diagram: Halaman Pendaftaran Mahasiswa Baru
Proses dimulai ketika calon pendaftar mengisi formulir pendaftaran dan melampirkan berkas seperti KTP atau ijazah, kemudian menekan tombol "Kirim Pendaftaran". Antarmuka Layar meneruskan seluruh data formulir dan berkas lampiran tersebut ke Sistem Pengendali. Sistem Pengendali kemudian memeriksa dan menyimpan berkas fisik secara lokal di server. Apabila berkas yang diunggah valid sesuai syarat sistem, Sistem Pengendali mengirimkan perintah penyimpanan data pendaftar ke Pangkalan Data. Pangkalan Data mengkonfirmasi bahwa data berhasil tersimpan, dan Sistem Pengendali mengarahkan tampilan kembali ke notifikasi sukses yang memberitahukan pengguna bahwa pendaftaran sedang menunggu verifikasi admin. Sebaliknya, apabila sistem mendeteksi berkas yang tidak valid atau tipe file yang tidak sesuai, Sistem Pengendali menolak proses dan mengirimkan pesan peringatan kepada pengguna agar memperbaiki dokumen yang diunggah.

```mermaid
sequenceDiagram
    autonumber
    actor User as Calon Pendaftar
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Isi Form Pendaftaran & Lampirkan File Fisik KTP atau Ijazah
    User->>Frontend: Klik Tombol "Kirim Pendaftaran"
    Frontend->>Backend: Meneruskan Formulir Pendaftaran dan Berkas Lampiran
    Backend->>Backend: Memeriksa dan Menyimpan File Fisik Internal secara lokal
    
    alt Berkas Pengajuan Valid Sesuai Syarat Sistem
        Backend->>Database: Perintah Simpan Data Pendaftar ke Tabel Cadangan Internal
        Database-->>Backend: Pencatatan rekaman berhasil ditancapkan kuat
        Backend-->>Frontend: Mengarahkan layar kembali ke wujud Notifikasi Sukses
        Frontend-->>User: Tampilan pendaftaran usai / Mengharapkan verfikasi balasan admin
    else Sistem Mendeteksi Pelanggaran Manipulasi Tipe File
        Backend-->>Frontend: Menolak penerusan proses transmisi form, menerbitkan Peringatan Gagal
        Frontend-->>User: Peringatkan Pengguna untuk merombak rincian dokumen muatannya
    end
```

---

### 2.1.8 Sequence Diagram: Halaman Program Studi TI (Teknik Informatika)
Proses dimulai ketika pengguna mengakses halaman profil Program Studi Teknik Informatika. Antarmuka Layar meneruskan permintaan ke Sistem Pengendali untuk meminta perincian data keilmuan Prodi TI. Sistem Pengendali kemudian mengirimkan tiga permintaan data secara spesifik ke Pangkalan Data, yaitu meminta ringkasan profil Teknik Informatika, daftar kepengurusan atau perwakilan prodi TI, dan daftar kurikulum yang berlaku. Setelah seluruh data diterima, Sistem Pengendali menggabungkan dan menyusunnya menjadi tampilan halaman Prodi TI yang lengkap, kemudian Antarmuka Layar menampilkan halaman tersebut secara utuh kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Mengeksplorasi Profil Program Studi TI
    Frontend->>Backend: Meminta perincian paket data keilmuan Prodi TI
    
    Backend->>Database: Ambil spesifik ringkasan Profil Teknik Informatika
    Backend->>Database: Ambil spesifik perwakilan jajaran Kepengurusan TI
    Backend->>Database: Ambil spesifik daftar acuan Kurikulum TI
    
    Backend-->>Frontend: Menyusun dan membangun Tampilan Web jurusan Teknik Informatika
    Frontend-->>User: Tampilkan Halaman Antarmuka Penjabaran Prodi TI utuh
```

---

### 2.1.9 Sequence Diagram: Halaman Program Studi PTI (Pendidikan Teknologi Informasi)
Proses ini berjalan dengan pola yang sama seperti halaman Prodi TI, namun dengan data yang spesifik untuk Program Studi Pendidikan Teknologi Informasi (PTI). Alur dimulai ketika pengguna mengakses halaman profil Prodi PTI. Antarmuka Layar meneruskan permintaan ke Sistem Pengendali untuk meminta data keilmuan Prodi PTI. Sistem Pengendali mengirimkan tiga permintaan ke Pangkalan Data secara terpisah, yaitu meminta ringkasan profil PTI, daftar pengurus PTI, dan daftar kurikulum silabus PTI. Setelah semua data diterima, Sistem Pengendali menyusunnya menjadi tampilan halaman Prodi PTI yang lengkap dan mengirimkannya ke Antarmuka Layar untuk ditampilkan kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Mengeksplorasi Profil Program Studi PTI
    Frontend->>Backend: Meminta perincian paket data keilmuan Prodi PTI
    
    Backend->>Database: Ekstrak tunggal ringkasan Profil entri wilayah PTI
    Backend->>Database: Ekstrak senarai pengurus eksklusif afiliasi PTI
    Backend->>Database: Ekstrak barisan daftar Kurikulum silabus PTI
    
    Backend-->>Frontend: Menyusun dan membangun Tampilan Web jurusan Pendidikan TI
    Frontend-->>User: Sajikan Pesona Layar Profil utuh Prodi Pend. Teknologi Informasi
```

---

### 2.1.10 Sequence Diagram: Halaman Fasilitas Ruangan
Proses dimulai ketika pengguna ingin melihat sarana fasilitas ruangan yang tersedia di kampus. Antarmuka Layar meneruskan permintaan ke Sistem Pengendali untuk meminta rincian inventaris daftar ruangan. Sistem Pengendali mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan data semua ruangan yang mencakup nama ruangan, deskripsi, kapasitas, dan referensi foto. Setelah data diterima, Sistem Pengendali menyusun data tersebut menjadi tampilan web yang informatif, kemudian Antarmuka Layar menampilkan galeri fasilitas ruangan kelas kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Ingin melihat-lihat Sarana Fasilitas Ruangan
    Frontend->>Backend: Meminta rincian inventaris aset daftar Ruangan
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Serahkan susunan rekaman prasarana fisik kampus
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Prasarana Ruangan
    Frontend-->>User: Paparkan Layar Galeri Estetis Fasilitas Ruang Kelas ke Pandangan
```

---

### 2.1.11 Sequence Diagram: Halaman Fasilitas Laboratorium
Proses dimulai ketika pengguna mengunjungi halaman Laboratorium. Antarmuka Layar meneruskan permintaan ke Sistem Pengendali untuk meminta informasi fasilitas laboratorium. Sistem Pengendali mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan data laboratorium yang mencakup nama setiap lab, daftar inventaris peralatan, serta koleksi foto fasilitas. Setelah menerima data tersebut, Sistem Pengendali menyusunnya menjadi tampilan web fasilitas laboratorium yang lengkap, lalu Antarmuka Layar menampilkan etalase galeri mesin dan fasilitas Laboratorium Komputer kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Mengunjungi Halaman Laboratorium
    Frontend->>Backend: Meminta informasi fasilitas mesin internal Laboratorium
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Kembalikan nama profil Lab, inventaris, beserta daftar koleksinya
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Fasilitas Lab utuh
    Frontend-->>User: Tampilkan Etalase Galeri Mesin Laboratorium Komputer Terpadu
```

---

### 2.1.12 Sequence Diagram: Halaman Kalender Akademik
Proses dimulai ketika pengguna mengakses halaman Kalender Akademik. Antarmuka Layar meneruskan permintaan ke Sistem Pengendali untuk meminta data kalender akademik terkini. Sistem Pengendali mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan data yang mencakup nama semester dan tautan atau foto ilustrasi kalender akademik. Setelah menerima data tersebut, Sistem Pengendali menyusunnya menjadi tampilan halaman kalender yang rapi, kemudian Antarmuka Layar menampilkan susunan Kalender Akademik Fakultas kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Mengeksplorasi laman Kalender Akademik Resmi
    Frontend->>Backend: Memanggil rilis pemaparan Kalender Aktivitas Terkini
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Mengembalikan teks desklumat serta tautan ilustrasi grafis Kalender
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web rilis jadwal Kalender
    Frontend-->>User: Sajikan Tampilan utuh Susunan Kalender Akademik Fakultas
```

---

### 2.1.13 Sequence Diagram: Halaman Dokumen Kurikulum
Proses dimulai ketika pengguna membuka halaman Dokumen Kurikulum. Antarmuka Layar meneruskan permintaan ke Sistem Pengendali untuk meminta sajian materi referensi berkas silabus dan kurikulum. Sistem Pengendali mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan data yang memuat judul-judul dokumen kurikulum beserta tautan unduhan berkas dalam format PDF atau DOC. Setelah data diterima, Sistem Pengendali menyusunnya menjadi tampilan etalase kurikulum yang informatif, kemudian Antarmuka Layar menampilkan daftar pengunduhan kurikulum kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Membuka direktori akses Dokumen Kurikulum Dasar
    Frontend->>Backend: Meminta sajian materi referensi berkas silabus
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Kembalikan tajuk naskah & tautan Unduhan File PDF/DOC
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Susunan Etalase Kurikulum
    Frontend-->>User: Suguhkan Antarmuka Daftar Pengunduhan Tata Aturan Kurikulum 
```

---

### 2.1.14 Sequence Diagram: Halaman Dokumen Fakultas
Proses dimulai ketika pengguna membuka halaman Dokumen Fakultas untuk menelusuri arsip-arsip dokumen yang tersedia untuk publik. Antarmuka Layar meneruskan permintaan ke Sistem Pengendali untuk memuat ulang daftar dokumen. Sistem Pengendali mengirimkan perintah ke Pangkalan Data untuk mengambil seluruh daftar nama dokumen beserta lokasi tautan unduhan berkas fisiknya. Setelah Pangkalan Data mengembalikan data tersebut, Sistem Pengendali menyusunnya menjadi tampilan tabel pengunduhan yang rapi, dan Antarmuka Layar menampilkan daftar arsip dokumen kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Menyusuri indeks halaman Dokumen Ketetapan Fakultas
    Frontend->>Backend: Meminta muat ulang wujud Dokumen Ketatapan Publik
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Serahkan susunan pemetaan letak tautan fail penyimpanan dokumen 
    
    Backend-->>Frontend: Mengikat tatanan pemuatan wujud Tampilan Web Daftar Unduhan Fakultas
    Frontend-->>User: Tampilkan Tabel Etalase Pengunduhan Arsip Hukum Publik secara utuh
```

---

### 2.1.15 Sequence Diagram: Halaman Rencana Strategis (Renstra)
Proses dimulai ketika pengguna mengklik menu halaman Rencana Strategis (Renstra). Antarmuka Layar meneruskan permintaan ke Sistem Pengendali untuk memuat laporan Renstra Fakultas. Sistem Pengendali mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan data yang berisi deskripsi paragraf wawasan strategis beserta tautan akses berkas dokumen Renstra. Setelah data diterima, Sistem Pengendali menyusunnya menjadi tampilan halaman Rencana Strategis yang siap dibaca, kemudian Antarmuka Layar menampilkan informasi acuan strategis fakultas secara lengkap kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Mengeklik menu halaman Rencana Strategis
    Frontend->>Backend: Memanggil rilis wujud laporan Renstra Fakultas
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Serahkan deskripsi paragraf wawasan serta link akses Berkas Dokumen 
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Rencana Strategis Siap Dibaca
    Frontend-->>User: Tampilkan Antarmuka utuh Informasi Acuan Strategis Fakultas
```

---

### 2.1.16 Sequence Diagram: Halaman Standar Operasional Prosedur (SOP)
Proses dimulai ketika pengguna membuka direktori halaman SOP (Standar Operasional Prosedur) Fakultas. Antarmuka Layar meneruskan permintaan ke Sistem Pengendali untuk memuat daftar SOP. Sistem Pengendali mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan data yang berisi nama-nama dokumen SOP beserta tautan lokasi berkas unduhan masing-masing. Setelah data diterima, Sistem Pengendali menyusunnya menjadi tampilan halaman daftar SOP, kemudian Antarmuka Layar menampilkan tabel unduhan arsip operasional kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Menengok direktori penelusuran Ketetapan SOP
    Frontend->>Backend: Meminta sajian susunan urutan kepatuhan aturan SOP
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Mengembalikan wujud nama instruktur layanan serta tautannya ke layar
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Rantai Standar SOP
    Frontend-->>User: Suguhkan Layar Tabel Unduhan Arsip Operasional Ke Ruang Pandang
```

---

### 2.1.17 Sequence Diagram: Halaman Data Penelitian
Proses dimulai ketika pengguna mengakses halaman Data Penelitian untuk menelusuri karya riset civitas akademika. Antarmuka Layar meneruskan permintaan ke Sistem Pengendali untuk meminta daftar riwayat penelitian. Sistem Pengendali mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan data yang memuat judul setiap penelitian, abstrak singkat, serta tautan ke sumber jurnal atau dokumen aslinya. Setelah data diterima, Sistem Pengendali menyusunnya menjadi tampilan daftar artikel penelitian, kemudian Antarmuka Layar menampilkan kompilasi karya keilmuan para peneliti kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Membuka Laman Direktori Tulisan Jurnal / Hasil Riset
    Frontend->>Backend: Meminta daftar kumpulan pelacakan riwayat aktivitas Penelitian Sivitas
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Membalas kembalian pemaparan tajuk abstrak judul jurnal dan tautannya
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Kompilasi Karya Kajian Penelitian
    Frontend-->>User: Sajikan Daftar Artikel Riwayat Keilmuan Para Peneliti ke Hadapan Pengunjung
```

---

### 2.1.18 Sequence Diagram: Halaman Data Pengabdian Masyarakat
Proses dimulai ketika pengguna mengakses halaman Data Pengabdian Masyarakat. Antarmuka Layar meneruskan permintaan ke Sistem Pengendali untuk memuat dokumentasi rekaman aktivitas sosial pengabdian. Sistem Pengendali mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan data yang berisi deskripsi singkat setiap kegiatan pengabdian serta tautan ke berkas laporan dokumentasinya. Setelah data diterima, Sistem Pengendali menyusunnya menjadi tampilan album karya pengabdian masyarakat, kemudian Antarmuka Layar menayangkan dokumentasi kegiatan pengabdian kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Menelurusi Laman Rekam Jejak Kiprah Pengabdian Sosial
    Frontend->>Backend: Meminta muatan dokumentasi rekaman aktivitas sosial Pengabdian
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Mewakili penarikan esai pengenalan aktivitas serta laporannya kembali merapat 
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Album Karya Berbakti Masyarakat
    Frontend-->>User: Munculkan Tayangan Dokumenter Pengabdian Ke dalam Ruang Baca Khalayak Luas
```

---

### 2.1.19 Sequence Diagram: Halaman Profil Organisasi (BEM)
Proses dimulai ketika pengguna mengklik menu untuk melihat profil kepengurusan BEM (Badan Eksekutif Mahasiswa). Antarmuka Layar meneruskan permintaan ke Sistem Pengendali untuk mengambil data struktur dan silsilah kabinet mahasiswa BEM. Sistem Pengendali mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan data deskriptif yang mencakup informasi kepemimpinan, program kerja, dan identitas BEM. Setelah data diterima, Sistem Pengendali menyusunnya menjadi tampilan halaman identitas organisasi mahasiswa, kemudian Antarmuka Layar menampilkan profil dan skema kepengurusan BEM kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Mengeklik lajur identitas kepengurusan BEM (Badan Eksekutif)
    Frontend->>Backend: Menagih riwayat penataan struktur silsilah kabinet mahasiswa BEM pelaporan 
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Pertukaran pengakuan perihal wujud deskriptif kepemimpinan disahkan mutlak
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Antarmuka Identitas Induk Mahasiswa
    Frontend-->>User: Paparkan Tampilan Pesona Skema Berbalut Identitas Anggun BEM ke Permukaan Layar
```

---

### 2.1.20 Sequence Diagram: Halaman Unit Kegiatan Mahasiswa (UKM)
Proses dimulai ketika pengguna mengklik menu untuk mengakses halaman Unit Kegiatan Mahasiswa (UKM). Antarmuka Layar meneruskan permintaan ke Sistem Pengendali untuk meminta data seluruh unit kegiatan yang terdaftar. Sistem Pengendali mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan data yang mencakup nama setiap UKM, deskripsi bidang kegiatan, serta lampiran foto atau logo UKM yang bersangkutan. Setelah data diterima, Sistem Pengendali menyusunnya menjadi tampilan galeri grid profil UKM, kemudian Antarmuka Layar menampilkan daftar Unit Kegiatan Mahasiswa kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Memicu klik tombol menu Unit Ekstrakurikuler (Galeri UKM)
    Frontend->>Backend: Meminta pembeberan eksistensi segenap atribut Unit Kegiatan terdaftar sah 
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Berikan wujud tajuk himpunan minor, profil ranah peminatan, serta lampiran fotonya
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Daftar Grid Etalase Profil Perkumpulan Kampus
    Frontend-->>User: Suguhkan Antarmuka Galeri Meriah Potret Keaktifan Pemuda UKM nan Dinamis Mutlak
```

---

### 2.1.21 Sequence Diagram: Halaman Himpunan Mahasiswa
Proses dimulai ketika pengguna mencari dan mengakses halaman Himpunan Mahasiswa per program studi. Antarmuka Layar meneruskan permintaan ke Sistem Pengendali untuk meminta data perwakilan setiap himpunan mahasiswa di bawah naungan BEM. Sistem Pengendali mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan data yang mencakup program kerja dan informasi spesifik setiap himpunan per program studi. Setelah data diterima, Sistem Pengendali menyusunnya menjadi tampilan halaman etalase himpunan mahasiswa, kemudian Antarmuka Layar menampilkan profil susunan kabinet himpunan tiap jurusan kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Mencari pangkalan letak susunan himpunan otoritatif prodi (Jurusan) eksklusif
    Frontend->>Backend: Meminta pengungkapan tata aturan perwakilan tiap jajaran HIMA di bawah naungan BEM
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Mewujudkan pertukaran penyerahan tabel Program Kerja spesifik per rumpun perwakilan  
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Etalase Kemerincian Susunan Kabinet Cabang Independen
    Frontend-->>User: Paparkan Profil Megah Relasional Aktivis Mahasiswa Pemegang Identitas Perjurusan Prodi
```

---

### 2.1.22 Sequence Diagram: Halaman Profil & Tracer Alumni
Proses dimulai ketika pengguna mengakses halaman Profil dan Tracer Alumni untuk menelusuri data para lulusan. Antarmuka Layar meneruskan permintaan ke Sistem Pengendali untuk mengambil data direktori kelulusan dan informasi karir alumni. Sistem Pengendali mengirimkan perintah pengambilan data ke Pangkalan Data. Pangkalan Data mengembalikan data kompilasi yang mencakup informasi karir, penempatan kerja, dan catatan masa penyelesaian studi para alumni. Setelah data diterima, Sistem Pengendali menyusunnya menjadi tampilan riwayat alumni yang informatif, kemudian Antarmuka Layar menampilkan lembar catatan perjalanan dan keaktifan anggota lulusan kepada pengguna.

```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Database as Pangkalan Data

    User->>Frontend: Singgah merunut pelacakan riwayat kelulusan pemuda cendekia (Ruang Pencarian Alumni)
    Frontend->>Backend: Mengajukan penarikan data wujud Direktori Kelulusan serta kiprah sukses riwayat Purna Kampus
    
    Backend->>Database: Perintah Ambil Data
    Database-->>Backend: Hadirkan rentetan kompilasi wawasan data karir penempatan serta rekam masa pelepasan ke tangan server
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Riwayat Lintas Waktu para Pemegang Takhta Kesuksesan Belajar 
    Frontend-->>User: Tampilkan Lembar Kebanggaan Perjalanan Waktu Catatan Karier dan Keaktifan Anggota Purna Lulusan Web 
```

---

## 2.2 Lingkungan Administrator
Bagian ini menggambarkan pengelolaan data rahasia dan fungsional yang dijalankan secara eksklusif oleh pengelola admin web.

### 2.2.1 Sequence Diagram: Login Administrator
Proses Login Administrator dimulai ketika admin membuka halaman login dan sistem menampilkan formulir isian. Admin memasukkan *Username* dan *Password*, kemudian menekan tombol Login. Antarmuka Layar mengirimkan data formulir tersebut secara aman ke Sistem Pengendali. Sistem Pengendali memeriksa kecocokan kombinasi kredensial tersebut dengan data yang tersimpan di Pangkalan Data. Apabila hasil pengecekan menunjukkan bahwa identitas dan kata sandi yang dimasukkan valid dan cocok, sistem membuat sesi login yang aktif dan mengarahkan admin menuju halaman Dashboard. Sebaliknya, apabila kombinasi yang dimasukkan tidak sesuai atau salah, sistem menampilkan pesan kesalahan dan admin harus kembali mengisi formulir login dari awal.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Admin
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant DB as "Database"

    Admin->>Frontend: Buka halaman login
    Frontend-->>Admin: Tampilkan form login
    
    Admin->>Frontend: Ketik Username & Password, tekan Login
    Frontend->>Backend: Kirim form data (jalur komunikasi aman)
    
    Backend->>DB: Cek kecocokan User/Pass
    DB-->>Backend: Validasi kredensial
    
    alt Login Berhasil
        Backend->>Backend: Set Sesi kunjungan Login Aktif
        Backend-->>Frontend: Redirect ke Dashboard Admin
    else Login Gagal
        Backend-->>Frontend: Tampilkan pesan Error Login
    end
```

---

### 2.2.2 Sequence Diagram: Kelola Slider Beranda
Proses dimulai ketika admin membuka menu Kelola Slider Beranda. Sistem secara otomatis menarik semua data slider yang tersimpan dari Pangkalan Data dan menampilkannya dalam bentuk tabel kepada admin sebagai tampilan awal.

Apabila admin ingin menambah data baru atau mengedit data yang sudah ada, admin menekan tombol **Tambah** atau **Edit**, lalu mengisi formulir yang tersedia dengan Teks Judul Utama, Subjudul, dan mengunggah Foto *Slider*. Setelah menekan tombol **Simpan**, data dikirimkan ke Sistem Pengendali yang memeriksa format dan ukuran berkas. Apabila berkas valid, sistem menyimpan file foto ke folder server (`/uploads/slider`). Khusus untuk proses Edit, file lama dari data sebelumnya dihapus terlebih dahulu. Setelah penyimpanan berkas berhasil, teks dan referensi nama file disimpan secara permanen ke Pangkalan Data, kemudian admin diarahkan kembali ke tabel dengan notifikasi keberhasilan. Apabila format atau ukuran berkas tidak sesuai, sistem menolak proses dan menampilkan pesan kesalahan.

Apabila admin ingin menghapus sebuah data, admin menekan tombol **Hapus** pada baris yang diinginkan. Sistem mengambil referensi nama file foto dari Pangkalan Data, menghapus file fisik tersebut dari folder server (`/uploads/slider`), lalu menghapus rekaman data dari Pangkalan Data. Setelah selesai, halaman dimuat ulang dengan notifikasi konfirmasi penghapusan berhasil.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Buka halaman menu Kelola Slider Beranda
    Frontend->>Backend: Request Halaman & Data
    Backend->>DB: Tarik semua riwayat arsip data
    DB-->>Backend: Return Data
    Backend-->>Frontend: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>Frontend: Lengkapi isian form & Upload Foto Pemandangan Kampus beranda
        Admin->>Frontend: Konfirmasi persetujuan tombol "Simpan"
        Frontend->>Backend: Kirim input form menuju sistem (jalur komunikasi aman)

        Backend->>Backend: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                Backend->>Server: Simpan fisik file masuk ke folder peladen uploads/slider
                opt Jika menimpa data warisan usang pengeditan
                    Backend->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            Backend->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Pangkalan Data
            DB-->>Backend: Peladen menyematkan pertanda konfirmasi data terekam permanen
            Backend-->>Frontend: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            Backend-->>Frontend: Singkirkan lalu buang permohonan bersisian peringatan Error
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>Frontend: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        Frontend->>Backend: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        Backend->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        Backend->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/slider
        Backend->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Pangkalan Data
        DB-->>Backend: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        Backend-->>Frontend: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

---

### 2.2.3 Sequence Diagram: Kelola Berita
Proses dimulai ketika admin membuka menu Kelola Berita. Sistem otomatis mengambil semua data berita dari Pangkalan Data dan menampilkannya dalam tabel kepada admin.

Apabila admin ingin menambah atau mengedit berita, admin mengisi formulir yang memuat Judul Berita, Konten, serta mengunggah Foto Sampul. Setelah tombol **Simpan** ditekan, Sistem Pengendali memeriksa format dan ukuran berkas yang diunggah. Jika valid, sistem menyimpan file foto ke folder server (`/uploads/`), menghapus file lama untuk proses Edit, lalu menyimpan seluruh data teks beserta referensi file ke Pangkalan Data. Admin diarahkan kembali ke tabel dengan notifikasi sukses. Jika berkas tidak valid, sistem menampilkan pesan kesalahan.

Apabila admin menghapus sebuah berita, sistem mencari dan menghapus file foto dari folder server (`/uploads/`), kemudian menghapus rekaman data dari Pangkalan Data. Halaman dimuat ulang dengan notifikasi penghapusan berhasil.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Buka halaman menu Kelola Berita
    Frontend->>Backend: Request Halaman & Data
    Backend->>DB: Tarik semua riwayat arsip data
    DB-->>Backend: Return Data
    Backend-->>Frontend: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>Frontend: Lengkapi isian form & Upload Foto Sampul
        Admin->>Frontend: Konfirmasi persetujuan tombol "Simpan"
        Frontend->>Backend: Kirim input form menuju sistem (jalur komunikasi aman)

        Backend->>Backend: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                Backend->>Server: Simpan fisik file masuk ke folder peladen uploads/
                opt Jika menimpa data warisan usang pengeditan
                    Backend->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            Backend->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Pangkalan Data
            DB-->>Backend: Peladen menyematkan pertanda konfirmasi data terekam permanen
            Backend-->>Frontend: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            Backend-->>Frontend: Singkirkan lalu buang permohonan bersisian peringatan Error
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>Frontend: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        Frontend->>Backend: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        Backend->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        Backend->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/
        Backend->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Pangkalan Data
        DB-->>Backend: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        Backend-->>Frontend: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

---

### 2.2.4 Sequence Diagram: Kelola Dosen
Proses dimulai ketika admin membuka menu Kelola Dosen. Sistem otomatis mengambil semua data dosen dari Pangkalan Data dan menampilkannya dalam tabel kepada admin.

Apabila admin ingin menambah atau mengedit data dosen, admin mengisi formulir yang memuat Nama, NIDN, Jabatan Akademik, serta mengunggah Foto Profil. Setelah tombol **Simpan** ditekan, Sistem Pengendali memeriksa format dan ukuran berkas. Jika valid, sistem menyimpan file foto ke folder server (`/uploads/dosen`), menghapus file lama untuk proses Edit, lalu menyimpan data teks beserta referensi file ke Pangkalan Data. Admin diarahkan kembali ke tabel dengan notifikasi sukses. Jika berkas tidak valid, sistem menampilkan pesan kesalahan.

Apabila admin menghapus data dosen, sistem mencari dan menghapus file foto dari folder server (`/uploads/dosen`), kemudian menghapus rekaman data dari Pangkalan Data. Halaman dimuat ulang dengan notifikasi penghapusan berhasil.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Buka halaman menu Kelola Dosen
    Frontend->>Backend: Request Halaman & Data
    Backend->>DB: Tarik semua riwayat arsip data
    DB-->>Backend: Return Data
    Backend-->>Frontend: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>Frontend: Lengkapi isian form & Upload Foto Profil
        Admin->>Frontend: Konfirmasi persetujuan tombol "Simpan"
        Frontend->>Backend: Kirim input form menuju sistem (jalur komunikasi aman)

        Backend->>Backend: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                Backend->>Server: Simpan fisik file masuk ke folder peladen uploads/dosen
                opt Jika menimpa data warisan usang pengeditan
                    Backend->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            Backend->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Pangkalan Data
            DB-->>Backend: Peladen menyematkan pertanda konfirmasi data terekam permanen
            Backend-->>Frontend: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            Backend-->>Frontend: Singkirkan lalu buang permohonan bersisian peringatan Error
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>Frontend: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        Frontend->>Backend: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        Backend->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        Backend->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/dosen
        Backend->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Pangkalan Data
        DB-->>Backend: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        Backend-->>Frontend: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

---

### 2.2.5 Sequence Diagram: Kelola Fasilitas Ruangan
Proses dimulai ketika admin membuka menu Kelola Fasilitas Ruangan. Sistem otomatis mengambil semua data ruangan dari Pangkalan Data dan menampilkannya dalam tabel kepada admin.

Apabila admin ingin menambah atau mengedit data ruangan, admin mengisi formulir yang memuat Nama Ruang, Kapasitas, Fasilitas, serta mengunggah Foto Kelas/Ruangan. Setelah tombol **Simpan** ditekan, Sistem Pengendali memeriksa format dan ukuran berkas. Jika valid, sistem menyimpan file foto ke folder server (`/uploads/ruangan`), menghapus file lama untuk proses Edit, lalu menyimpan data teks beserta referensi file ke Pangkalan Data. Admin diarahkan kembali ke tabel dengan notifikasi sukses. Jika berkas tidak valid, sistem menampilkan pesan kesalahan.

Apabila admin menghapus data ruangan, sistem mencari dan menghapus file foto dari folder server (`/uploads/ruangan`), kemudian menghapus rekaman data dari Pangkalan Data. Halaman dimuat ulang dengan notifikasi penghapusan berhasil.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Buka halaman menu Kelola Fasilitas Ruangan
    Frontend->>Backend: Request Halaman & Data
    Backend->>DB: Tarik semua riwayat arsip data
    DB-->>Backend: Return Data
    Backend-->>Frontend: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>Frontend: Lengkapi isian form & Upload Foto Kelas/Ruangan
        Admin->>Frontend: Konfirmasi persetujuan tombol "Simpan"
        Frontend->>Backend: Kirim input form menuju sistem (jalur komunikasi aman)

        Backend->>Backend: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                Backend->>Server: Simpan fisik file masuk ke folder peladen uploads/ruangan
                opt Jika menimpa data warisan usang pengeditan
                    Backend->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            Backend->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Pangkalan Data
            DB-->>Backend: Peladen menyematkan pertanda konfirmasi data terekam permanen
            Backend-->>Frontend: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            Backend-->>Frontend: Singkirkan lalu buang permohonan bersisian peringatan Error
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>Frontend: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        Frontend->>Backend: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        Backend->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        Backend->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/ruangan
        Backend->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Pangkalan Data
        DB-->>Backend: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        Backend-->>Frontend: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

---

### 2.2.6 Sequence Diagram: Kelola Fasilitas Laboratorium
Proses dimulai ketika admin membuka menu Kelola Fasilitas Laboratorium. Sistem otomatis mengambil semua data laboratorium dari Pangkalan Data dan menampilkannya dalam tabel kepada admin.

Apabila admin ingin menambah atau mengedit data lab, admin mengisi formulir yang memuat Nama Lab, Daftar Inventaris Peralatan, serta mengunggah Foto Laboratorium. Setelah tombol **Simpan** ditekan, Sistem Pengendali memeriksa format dan ukuran berkas. Jika valid, sistem menyimpan file foto ke folder server (`/uploads/laboratorium`), menghapus file lama untuk proses Edit, lalu menyimpan data teks beserta referensi file ke Pangkalan Data. Admin diarahkan kembali ke tabel dengan notifikasi sukses. Jika berkas tidak valid, sistem menampilkan pesan kesalahan.

Apabila admin menghapus data laboratorium, sistem mencari dan menghapus file foto dari folder server (`/uploads/laboratorium`), kemudian menghapus rekaman data dari Pangkalan Data. Halaman dimuat ulang dengan notifikasi penghapusan berhasil.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Buka halaman menu Kelola Fasilitas Laboratorium
    Frontend->>Backend: Request Halaman & Data
    Backend->>DB: Tarik semua riwayat arsip data
    DB-->>Backend: Return Data
    Backend-->>Frontend: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>Frontend: Lengkapi isian form & Upload Foto Laboratorium
        Admin->>Frontend: Konfirmasi persetujuan tombol "Simpan"
        Frontend->>Backend: Kirim input form menuju sistem (jalur komunikasi aman)

        Backend->>Backend: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                Backend->>Server: Simpan fisik file masuk ke folder peladen uploads/laboratorium
                opt Jika menimpa data warisan usang pengeditan
                    Backend->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            Backend->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Pangkalan Data
            DB-->>Backend: Peladen menyematkan pertanda konfirmasi data terekam permanen
            Backend-->>Frontend: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            Backend-->>Frontend: Singkirkan lalu buang permohonan bersisian peringatan Error
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>Frontend: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        Frontend->>Backend: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        Backend->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        Backend->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/laboratorium
        Backend->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Pangkalan Data
        DB-->>Backend: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        Backend-->>Frontend: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

---

### 2.2.7 Sequence Diagram: Kelola Kalender Akademik
Proses dimulai ketika admin membuka menu Kelola Kalender Akademik. Sistem otomatis mengambil semua data kalender dari Pangkalan Data dan menampilkannya dalam tabel kepada admin.

Apabila admin ingin menambah atau mengedit data kalender, admin mengisi formulir yang memuat Tahun Akademik, Deskripsi, serta mengunggah Gambar Kalender. Setelah tombol **Simpan** ditekan, Sistem Pengendali memeriksa format dan ukuran berkas. Jika valid, sistem menyimpan file gambar ke folder server (`/uploads/kalender`), menghapus file lama untuk proses Edit, lalu menyimpan data teks beserta referensi file ke Pangkalan Data. Admin diarahkan kembali ke tabel dengan notifikasi sukses. Jika berkas tidak valid, sistem menampilkan pesan kesalahan.

Apabila admin menghapus data kalender, sistem mencari dan menghapus file gambar dari folder server (`/uploads/kalender`), kemudian menghapus rekaman data dari Pangkalan Data. Halaman dimuat ulang dengan notifikasi penghapusan berhasil.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Buka halaman menu Kelola Kalender Akademik
    Frontend->>Backend: Request Halaman & Data
    Backend->>DB: Tarik semua riwayat arsip data
    DB-->>Backend: Return Data
    Backend-->>Frontend: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>Frontend: Lengkapi isian form & Upload Gambar Kalender
        Admin->>Frontend: Konfirmasi persetujuan tombol "Simpan"
        Frontend->>Backend: Kirim input form menuju sistem (jalur komunikasi aman)

        Backend->>Backend: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                Backend->>Server: Simpan fisik file masuk ke folder peladen uploads/kalender
                opt Jika menimpa data warisan usang pengeditan
                    Backend->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            Backend->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Pangkalan Data
            DB-->>Backend: Peladen menyematkan pertanda konfirmasi data terekam permanen
            Backend-->>Frontend: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            Backend-->>Frontend: Singkirkan lalu buang permohonan bersisian peringatan Error
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>Frontend: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        Frontend->>Backend: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        Backend->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        Backend->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/kalender
        Backend->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Pangkalan Data
        DB-->>Backend: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        Backend-->>Frontend: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

---

### 2.2.8 Sequence Diagram: Kelola Dokumen Kurikulum
Proses dimulai ketika admin membuka menu Kelola Dokumen Kurikulum. Sistem otomatis mengambil semua data dokumen kurikulum dari Pangkalan Data dan menampilkannya dalam tabel kepada admin.

Apabila admin ingin menambah atau mengedit data, admin mengisi formulir yang memuat Judul, Deskripsi Kurikulum, serta mengunggah Dokumen Asli. Setelah tombol **Simpan** ditekan, Sistem Pengendali memeriksa format dan ukuran berkas. Jika valid, sistem menyimpan file dokumen ke folder server (`/docs/kurikulum`), menghapus file lama untuk proses Edit, lalu menyimpan data teks beserta referensi file ke Pangkalan Data. Admin diarahkan kembali ke tabel dengan notifikasi sukses. Jika berkas tidak valid, sistem menampilkan pesan kesalahan.

Apabila admin menghapus data dokumen kurikulum, sistem mencari dan menghapus file dari folder server (`/docs/kurikulum`), kemudian menghapus rekaman data dari Pangkalan Data. Halaman dimuat ulang dengan notifikasi penghapusan berhasil.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Buka halaman menu Kelola Dokumen Kurikulum
    Frontend->>Backend: Request Halaman & Data
    Backend->>DB: Tarik semua riwayat arsip data
    DB-->>Backend: Return Data
    Backend-->>Frontend: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>Frontend: Lengkapi isian form & Upload Dokumen Asli
        Admin->>Frontend: Konfirmasi persetujuan tombol "Simpan"
        Frontend->>Backend: Kirim input form menuju sistem (jalur komunikasi aman)

        Backend->>Backend: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                Backend->>Server: Simpan fisik file masuk ke folder peladen docs/kurikulum
                opt Jika menimpa data warisan usang pengeditan
                    Backend->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            Backend->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Pangkalan Data
            DB-->>Backend: Peladen menyematkan pertanda konfirmasi data terekam permanen
            Backend-->>Frontend: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            Backend-->>Frontend: Singkirkan lalu buang permohonan bersisian peringatan Error
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>Frontend: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        Frontend->>Backend: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        Backend->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        Backend->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah docs/kurikulum
        Backend->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Pangkalan Data
        DB-->>Backend: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        Backend-->>Frontend: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

---

### 2.2.9 Sequence Diagram: Kelola Mitra Kerjasama
Proses dimulai ketika admin membuka menu Kelola Mitra Kerjasama. Sistem otomatis mengambil semua data mitra dari Pangkalan Data dan menampilkannya dalam tabel kepada admin.

Apabila admin ingin menambah atau mengedit data mitra, admin mengisi formulir yang memuat Nama Mitra, Deskripsi MoU, serta mengunggah Logo Kemitraan. Setelah tombol **Simpan** ditekan, Sistem Pengendali memeriksa format dan ukuran berkas. Jika valid, sistem menyimpan file logo ke folder server (`/uploads/kerjasama`), menghapus file lama untuk proses Edit, lalu menyimpan data teks beserta referensi file ke Pangkalan Data. Admin diarahkan kembali ke tabel dengan notifikasi sukses. Jika berkas tidak valid, sistem menampilkan pesan kesalahan.

Apabila admin menghapus data mitra kerjasama, sistem mencari dan menghapus file logo dari folder server (`/uploads/kerjasama`), kemudian menghapus rekaman data dari Pangkalan Data. Halaman dimuat ulang dengan notifikasi penghapusan berhasil.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Buka halaman menu Kelola Mitra Kerjasama
    Frontend->>Backend: Request Halaman & Data
    Backend->>DB: Tarik semua riwayat arsip data
    DB-->>Backend: Return Data
    Backend-->>Frontend: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>Frontend: Lengkapi isian form & Upload Logo Kemitraan
        Admin->>Frontend: Konfirmasi persetujuan tombol "Simpan"
        Frontend->>Backend: Kirim input form menuju sistem (jalur komunikasi aman)

        Backend->>Backend: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                Backend->>Server: Simpan fisik file masuk ke folder peladen uploads/kerjasama
                opt Jika menimpa data warisan usang pengeditan
                    Backend->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            Backend->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Pangkalan Data
            DB-->>Backend: Peladen menyematkan pertanda konfirmasi data terekam permanen
            Backend-->>Frontend: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            Backend-->>Frontend: Singkirkan lalu buang permohonan bersisian peringatan Error
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>Frontend: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        Frontend->>Backend: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        Backend->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        Backend->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/kerjasama
        Backend->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Pangkalan Data
        DB-->>Backend: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        Backend-->>Frontend: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

---

### 2.2.10 Sequence Diagram: Kelola Data Penelitian
Proses dimulai ketika admin membuka menu Kelola Data Penelitian. Sistem otomatis mengambil semua data penelitian dari Pangkalan Data dan menampilkannya dalam tabel kepada admin.

Apabila admin ingin menambah atau mengedit data penelitian, admin mengisi formulir yang memuat Judul Riset, Abstrak Singkat, serta mengunggah Dokumen Laporan Publikasi. Setelah tombol **Simpan** ditekan, Sistem Pengendali memeriksa format dan ukuran berkas. Jika valid, sistem menyimpan file dokumen ke folder server (`/docs/penelitian`), menghapus file lama untuk proses Edit, lalu menyimpan data teks beserta referensi file ke Pangkalan Data. Admin diarahkan kembali ke tabel dengan notifikasi sukses. Jika berkas tidak valid, sistem menampilkan pesan kesalahan.

Apabila admin menghapus data penelitian, sistem mencari dan menghapus file dokumen dari folder server (`/docs/penelitian`), kemudian menghapus rekaman data dari Pangkalan Data. Halaman dimuat ulang dengan notifikasi penghapusan berhasil.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Buka halaman menu Kelola Data Penelitian
    Frontend->>Backend: Request Halaman & Data
    Backend->>DB: Tarik semua riwayat arsip data
    DB-->>Backend: Return Data
    Backend-->>Frontend: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>Frontend: Lengkapi isian form & Upload Dokumen Laporan Publikasi
        Admin->>Frontend: Konfirmasi persetujuan tombol "Simpan"
        Frontend->>Backend: Kirim input form menuju sistem (jalur komunikasi aman)

        Backend->>Backend: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                Backend->>Server: Simpan fisik file masuk ke folder peladen docs/penelitian
                opt Jika menimpa data warisan usang pengeditan
                    Backend->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            Backend->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Pangkalan Data
            DB-->>Backend: Peladen menyematkan pertanda konfirmasi data terekam permanen
            Backend-->>Frontend: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            Backend-->>Frontend: Singkirkan lalu buang permohonan bersisian peringatan Error
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>Frontend: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        Frontend->>Backend: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        Backend->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        Backend->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah docs/penelitian
        Backend->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Pangkalan Data
        DB-->>Backend: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        Backend-->>Frontend: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

---

### 2.2.11 Sequence Diagram: Kelola Data Pengabdian
Proses dimulai ketika admin membuka menu Kelola Data Pengabdian. Sistem otomatis mengambil semua data pengabdian dari Pangkalan Data dan menampilkannya dalam tabel kepada admin.

Apabila admin ingin menambah atau mengedit data pengabdian, admin mengisi formulir yang memuat Judul Kegiatan, Ringkasan, serta mengunggah Laporan Dokumentasi. Setelah tombol **Simpan** ditekan, Sistem Pengendali memeriksa format dan ukuran berkas. Jika valid, sistem menyimpan file dokumen ke folder server (`/docs/pengabdian`), menghapus file lama untuk proses Edit, lalu menyimpan data teks beserta referensi file ke Pangkalan Data. Admin diarahkan kembali ke tabel dengan notifikasi sukses. Jika berkas tidak valid, sistem menampilkan pesan kesalahan.

Apabila admin menghapus data pengabdian, sistem mencari dan menghapus file laporan dari folder server (`/docs/pengabdian`), kemudian menghapus rekaman data dari Pangkalan Data. Halaman dimuat ulang dengan notifikasi penghapusan berhasil.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Buka halaman menu Kelola Data Pengabdian
    Frontend->>Backend: Request Halaman & Data
    Backend->>DB: Tarik semua riwayat arsip data
    DB-->>Backend: Return Data
    Backend-->>Frontend: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>Frontend: Lengkapi isian form & Upload Laporan Dokumentasi
        Admin->>Frontend: Konfirmasi persetujuan tombol "Simpan"
        Frontend->>Backend: Kirim input form menuju sistem (jalur komunikasi aman)

        Backend->>Backend: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                Backend->>Server: Simpan fisik file masuk ke folder peladen docs/pengabdian
                opt Jika menimpa data warisan usang pengeditan
                    Backend->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            Backend->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Pangkalan Data
            DB-->>Backend: Peladen menyematkan pertanda konfirmasi data terekam permanen
            Backend-->>Frontend: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            Backend-->>Frontend: Singkirkan lalu buang permohonan bersisian peringatan Error
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>Frontend: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        Frontend->>Backend: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        Backend->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        Backend->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah docs/pengabdian
        Backend->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Pangkalan Data
        DB-->>Backend: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        Backend-->>Frontend: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

---

### 2.2.12 Sequence Diagram: Kelola Dokumen Fakultas
Proses dimulai ketika admin membuka menu Kelola Dokumen Fakultas. Sistem otomatis mengambil semua data dokumen dari Pangkalan Data dan menampilkannya dalam tabel kepada admin.

Apabila admin ingin menambah atau mengedit dokumen, admin mengisi formulir yang memuat Judul, Teks Deskripsi, serta mengunggah Dokumen Publikasi. Setelah tombol **Simpan** ditekan, Sistem Pengendali memeriksa format dan ukuran berkas. Jika valid, sistem menyimpan file ke folder server (`/docs/fakultas`), menghapus file lama untuk proses Edit, lalu menyimpan data teks beserta referensi file ke Pangkalan Data. Admin diarahkan kembali ke tabel dengan notifikasi sukses. Jika berkas tidak valid, sistem menampilkan pesan kesalahan.

Apabila admin menghapus data dokumen, sistem mencari dan menghapus file dari folder server (`/docs/fakultas`), kemudian menghapus rekaman data dari Pangkalan Data. Halaman dimuat ulang dengan notifikasi penghapusan berhasil.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Buka halaman menu Kelola Dokumen Fakultas
    Frontend->>Backend: Request Halaman & Data
    Backend->>DB: Tarik semua riwayat arsip data
    DB-->>Backend: Return Data
    Backend-->>Frontend: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>Frontend: Lengkapi isian form & Upload Dokumen Publikasi
        Admin->>Frontend: Konfirmasi persetujuan tombol "Simpan"
        Frontend->>Backend: Kirim input form menuju sistem (jalur komunikasi aman)

        Backend->>Backend: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                Backend->>Server: Simpan fisik file masuk ke folder peladen docs/fakultas
                opt Jika menimpa data warisan usang pengeditan
                    Backend->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            Backend->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Pangkalan Data
            DB-->>Backend: Peladen menyematkan pertanda konfirmasi data terekam permanen
            Backend-->>Frontend: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            Backend-->>Frontend: Singkirkan lalu buang permohonan bersisian peringatan Error
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>Frontend: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        Frontend->>Backend: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        Backend->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        Backend->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah docs/fakultas
        Backend->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Pangkalan Data
        DB-->>Backend: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        Backend-->>Frontend: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

---

### 2.2.13 Sequence Diagram: Kelola Rencana Strategis
Proses dimulai ketika admin membuka menu Kelola Rencana Strategis. Sistem otomatis mengambil semua data dari Pangkalan Data dan menampilkannya dalam tabel kepada admin.

Apabila admin ingin menambah atau mengedit data Renstra, admin mengisi formulir yang memuat Tahun Periode, Visi Renstra, serta mengunggah Naskah Renstra. Setelah tombol **Simpan** ditekan, Sistem Pengendali memeriksa format dan ukuran berkas. Jika valid, sistem menyimpan file ke folder server (`/docs/renstra`), menghapus file lama untuk proses Edit, lalu menyimpan data teks beserta referensi file ke Pangkalan Data. Admin diarahkan kembali ke tabel dengan notifikasi sukses. Jika berkas tidak valid, sistem menampilkan pesan kesalahan.

Apabila admin menghapus data Renstra, sistem mencari dan menghapus file dari folder server (`/docs/renstra`), kemudian menghapus rekaman data dari Pangkalan Data. Halaman dimuat ulang dengan notifikasi penghapusan berhasil.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Buka halaman menu Kelola Rencana Strategis
    Frontend->>Backend: Request Halaman & Data
    Backend->>DB: Tarik semua riwayat arsip data
    DB-->>Backend: Return Data
    Backend-->>Frontend: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>Frontend: Lengkapi isian form & Upload Naskah Renstra
        Admin->>Frontend: Konfirmasi persetujuan tombol "Simpan"
        Frontend->>Backend: Kirim input form menuju sistem (jalur komunikasi aman)

        Backend->>Backend: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                Backend->>Server: Simpan fisik file masuk ke folder peladen docs/renstra
                opt Jika menimpa data warisan usang pengeditan
                    Backend->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            Backend->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Pangkalan Data
            DB-->>Backend: Peladen menyematkan pertanda konfirmasi data terekam permanen
            Backend-->>Frontend: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            Backend-->>Frontend: Singkirkan lalu buang permohonan bersisian peringatan Error
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>Frontend: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        Frontend->>Backend: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        Backend->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        Backend->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah docs/renstra
        Backend->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Pangkalan Data
        DB-->>Backend: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        Backend-->>Frontend: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

---

### 2.2.14 Sequence Diagram: Kelola Standar Operasional Prosedur (SOP)
Proses dimulai ketika admin membuka menu Kelola SOP. Sistem otomatis mengambil semua data SOP dari Pangkalan Data dan menampilkannya dalam tabel kepada admin.

Apabila admin ingin menambah atau mengedit data SOP, admin mengisi formulir yang memuat Nama SOP, Rincian Prosedur, serta mengunggah Dokumen Pedoman SOP. Setelah tombol **Simpan** ditekan, Sistem Pengendali memeriksa format dan ukuran berkas. Jika valid, sistem menyimpan file ke folder server (`/docs/sop`), menghapus file lama untuk proses Edit, lalu menyimpan data teks beserta referensi file ke Pangkalan Data. Admin diarahkan kembali ke tabel dengan notifikasi sukses. Jika berkas tidak valid, sistem menampilkan pesan kesalahan.

Apabila admin menghapus data SOP, sistem mencari dan menghapus file dari folder server (`/docs/sop`), kemudian menghapus rekaman data dari Pangkalan Data. Halaman dimuat ulang dengan notifikasi penghapusan berhasil.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Buka halaman menu Kelola Standar Operasional Prosedur (SOP)
    Frontend->>Backend: Request Halaman & Data
    Backend->>DB: Tarik semua riwayat arsip data
    DB-->>Backend: Return Data
    Backend-->>Frontend: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>Frontend: Lengkapi isian form & Upload Dokumen Pedoman SOP
        Admin->>Frontend: Konfirmasi persetujuan tombol "Simpan"
        Frontend->>Backend: Kirim input form menuju sistem (jalur komunikasi aman)

        Backend->>Backend: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                Backend->>Server: Simpan fisik file masuk ke folder peladen docs/sop
                opt Jika menimpa data warisan usang pengeditan
                    Backend->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            Backend->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Pangkalan Data
            DB-->>Backend: Peladen menyematkan pertanda konfirmasi data terekam permanen
            Backend-->>Frontend: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            Backend-->>Frontend: Singkirkan lalu buang permohonan bersisian peringatan Error
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>Frontend: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        Frontend->>Backend: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        Backend->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        Backend->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah docs/sop
        Backend->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Pangkalan Data
        DB-->>Backend: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        Backend-->>Frontend: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

---

### 2.2.15 Sequence Diagram: Kelola Data Organisasi BEM
Proses dimulai ketika admin membuka menu Kelola Data Organisasi BEM. Sistem otomatis mengambil semua data BEM dari Pangkalan Data dan menampilkannya dalam tabel kepada admin.

Apabila admin ingin menambah atau mengedit data BEM, admin mengisi formulir yang memuat Nama Departemen, Program Kerja, serta mengunggah Logo atau Foto Profil BEM. Setelah tombol **Simpan** ditekan, Sistem Pengendali memeriksa format dan ukuran berkas. Jika valid, sistem menyimpan file ke folder server (`/uploads/bem`), menghapus file lama untuk proses Edit, lalu menyimpan data teks beserta referensi file ke Pangkalan Data. Admin diarahkan kembali ke tabel dengan notifikasi sukses. Jika berkas tidak valid, sistem menampilkan pesan kesalahan.

Apabila admin menghapus data BEM, sistem mencari dan menghapus file dari folder server (`/uploads/bem`), kemudian menghapus rekaman data dari Pangkalan Data. Halaman dimuat ulang dengan notifikasi penghapusan berhasil.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Buka halaman menu Kelola Data Organisasi BEM
    Frontend->>Backend: Request Halaman & Data
    Backend->>DB: Tarik semua riwayat arsip data
    DB-->>Backend: Return Data
    Backend-->>Frontend: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>Frontend: Lengkapi isian form & Upload Logo atau Foto Profil BEM
        Admin->>Frontend: Konfirmasi persetujuan tombol "Simpan"
        Frontend->>Backend: Kirim input form menuju sistem (jalur komunikasi aman)

        Backend->>Backend: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                Backend->>Server: Simpan fisik file masuk ke folder peladen uploads/bem
                opt Jika menimpa data warisan usang pengeditan
                    Backend->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            Backend->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Pangkalan Data
            DB-->>Backend: Peladen menyematkan pertanda konfirmasi data terekam permanen
            Backend-->>Frontend: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            Backend-->>Frontend: Singkirkan lalu buang permohonan bersisian peringatan Error
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>Frontend: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        Frontend->>Backend: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        Backend->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        Backend->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/bem
        Backend->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Pangkalan Data
        DB-->>Backend: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        Backend-->>Frontend: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

---

### 2.2.16 Sequence Diagram: Verifikasi Pendaftaran
Halaman Verifikasi Pendaftaran berfungsi khusus untuk admin meninjau dan memvalidasi antrean data pendaftar yang masuk, tanpa adanya fitur tambah data baru dari sisi admin.

Proses dimulai ketika admin membuka halaman antrean validasi. Sistem otomatis mengambil daftar semua pendaftar dari Pangkalan Data dan menampilkannya dalam tabel. Admin dapat meninjau kelengkapan berkas setiap pendaftar, termasuk melihat foto dokumen lampiran seperti KTP atau ijazah yang tersimpan di server. Setelah melakukan pengecekan, admin memutuskan status pendaftar dengan memilih **Diterima** atau **Ditolak**. Keputusan tersebut dikirimkan ke Sistem Pengendali yang kemudian memperbarui status validasi di Pangkalan Data. Halaman ditampilkan ulang dengan data terbaru dan notifikasi sukses.

Jika terdapat pendaftar yang datanya terbukti tidak valid atau fiktif, admin dapat menekan tombol **Hapus**. Sistem kemudian mencari referensi file lampiran di Pangkalan Data, menghapus file tersebut dari server, lalu menghapus rekaman data pendaftar dari Pangkalan Data. Halaman dimuat ulang bersih dengan notifikasi konfirmasi penghapusan berhasil.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Buka halaman antrean validasi
    Frontend->>Backend: Request Halaman & Data
    Backend->>DB: Tarik senarai pendaftar
    DB-->>Backend: Return Data
    Backend-->>Frontend: Tampilkan tabel urutan pendaftar masuk

    opt Tinjau Pendaftar
        Admin->>Frontend: Cek kelengkapan fisik file pendaftar
        Admin->>Frontend: Putuskan status diterima atau ditolak
        Frontend->>Backend: Kirim konfirmasi putusan status
        
        Backend->>DB: Update Status Validasi Pendaftar di DB
        DB-->>Backend: Status Validasi Mutakhir
        Backend-->>Frontend: Tabel Segar dengan Notifikasi Sukses
    end

    opt Hapus Data / Pendaftar Bohong
        Admin->>Frontend: Klik tombol hapus khusus
        Frontend->>Backend: Minta Hapus baris Pendaftar
        Backend->>DB: Cari referensi lokasi file lampiran
        Backend->>Server: Musnahkan file lampiran dari Server
        Backend->>DB: Lenyapkan data pendaftar
        DB-->>Backend: Proses pemusnahan sukses
        Backend-->>Frontend: Halaman ditarik bersih memunculkan Konfirmasi Sukses
    end
```

---

### 2.2.17 Sequence Diagram: Pengaturan Sistem
Halaman Pengaturan Sistem hanya memiliki satu baris data konfigurasi yang selalu diperbarui, bukan ditambah atau ditumpuk sebagai riwayat baru.

Proses dimulai ketika admin mengakses menu Pengaturan Sistem. Sistem langsung mengambil baris data profil pengaturan yang tersimpan di Pangkalan Data dan mengisinya ke dalam formulir di layar admin secara otomatis, sehingga admin dapat langsung melihat nilai konfigurasi saat ini. Apabila admin ingin mengubah pengaturan, admin memodifikasi teks pada formulir atau mengunggah gambar Logo atau Favicon baru, kemudian menekan tombol **Simpan**. Data formulir dikirimkan ke Sistem Pengendali yang memeriksa ekstensi file gambar. Jika spesifikasi gambar valid, sistem menyimpan file logo baru ke direktori internal server dan menghapus file logo lama. Setelah itu, Sistem Pengendali memperbarui baris pengaturan di Pangkalan Data pada tabel tunggal yang bersangkutan. Halaman kemudian disegarkan dengan notifikasi sukses. Apabila file yang diunggah memiliki ekstensi yang tidak diizinkan, sistem menolak proses dan menampilkan pesan kesalahan.

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant Frontend as Antarmuka Layar
    participant Backend as Sistem Pengendali
    participant Server as "Storage"
    participant DB as "Database"

    Admin->>Frontend: Akses menu Pengaturan Sistem
    View->>DB: Ambil baris profil pengaturan
    DB-->>View: Sajikan isian ke form

    opt Jika Klik Ubah/Simpan Profil
        Admin->>Frontend: Modifikasi teks/Upload gambar Logo favicon
        Admin->>Frontend: Konfirmasi "Simpan"
        Frontend->>Backend: Kirim paketan form (jalur komunikasi aman)

        Backend->>Backend: Cek ekstensi aman file logo
        
        alt Spesifikasi Gambar Valid
            opt Jika Logo Website ikut diganti
                Backend->>Server: Simpan fisik Logo baru ke direktori internal
                Backend->>Server: Kuras riwayat aset logo lama
            end
            
            Backend->>DB: Update relasi pengaturan di tabel baris tunggal
            DB-->>Backend: Relasi bahasa sandi pengolah data berhasil dirajut permanen
            Backend-->>Frontend: Segarkan halaman dengan rilis Notifikasi Sukses
        else Spesifikasi Gambar Ilegal
            Backend-->>Frontend: Tolak dan keluarkan Pesan Error Peringatan
        end
    end
```

---

