# Kumpulan Diagram Frontend

## Sequence Diagram: Halaman Utama (Home)
```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

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

## Sequence Diagram: Halaman Data Civitas Akademika
```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Akses / Klik menu Civitas Akademika
    Frontend->>Backend: Meminta susunan data Civitas
    
    Backend->>Database: Perintah Ambil Data (daftar profil dosen & tendik)
    Database-->>Backend: Mengembalikan himpunan rekaman data civitas
    
    Backend-->>Frontend: Menggabungkan dan menyusun Tampilan Web utuh
    Frontend-->>User: Tampilkan Halaman Data Civitas utuh
```

## Sequence Diagram: Halaman Struktur Organisasi
```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Akses / Klik menu Struktur Organisasi
    Frontend->>Backend: Meminta bagan Struktur Organisasi
    
    Backend->>Database: Perintah Ambil Data (skema pejabat struktur pimpinan)
    Database-->>Backend: Mengembalikan teks data struktur organisasi
    
    Backend-->>Frontend: Menggabungkan dan menyusun Tampilan Web
    Frontend-->>User: Tampilkan Halaman Struktur Organisasi
```

## Sequence Diagram: Halaman Tentang Fakultas
```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Akses / Klik menu Tentang Fakultas
    Frontend->>Backend: Meminta rincian narasi Profil Fakultas
    
    Backend->>Database: Perintah Ambil Data (rekaman sejarah & profil institusi)
    Database-->>Backend: Mengembalikan teks deskripsi fakultas
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Siap Jadi
    Frontend-->>User: Tampilkan Halaman Tentang Fakultas
```

## Sequence Diagram: Halaman Visi dan Misi
```mermaid
sequenceDiagram
    autonumber
    
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Akses / Klik Visi dan Misi
    Frontend->>Backend: Meminta susunan teks Visi Misi
    
    Backend->>Database: Perintah Ambil Data (visi, misi, dan target fakultas)
    Database-->>Backend: Mengembalikan naskah penjabaran visi misi
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Siap Jadi
    Frontend-->>User: Tampilkan Halaman Visi & Misi
```

## Sequence Diagram: Halaman Profil Dosen
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Klik menu Profil Dosen
    Frontend->>Backend: Meminta rincian direktori riwayat Dosen
    
    Backend->>Database: Perintah Ambil Data (kumpulan jejak profil Dosen)
    Database-->>Backend: Mengembalikan profil nama, NIDN, jabatan, foto internal
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Siap Jadi
    Frontend-->>User: Tampilkan Grid Kartu Profil Para Dosen
```

## Sequence Diagram: Halaman Pendaftaran Mahasiswa Baru
```mermaid
sequenceDiagram
    autonumber
    actor User as Calon Pendaftar
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Isi Form Pendaftaran & Lampirkan File Fisik (KTP/Ijazah)
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

## Sequence Diagram: Halaman Program Studi TI (Teknik Informatika)
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Mengeksplorasi Profil Program Studi TI
    Frontend->>Backend: Meminta perincian paket data keilmuan Prodi TI
    
    Backend->>Database: Ambil spesifik ringkasan Profil Teknik Informatika
    Backend->>Database: Ambil spesifik perwakilan jajaran Kepengurusan TI
    Backend->>Database: Ambil spesifik daftar acuan Kurikulum TI
    
    Backend-->>Frontend: Menyusun dan membangun Tampilan Web jurusan Teknik Informatika
    Frontend-->>User: Tampilkan Halaman Antarmuka Penjabaran Prodi TI utuh
```

## Sequence Diagram: Halaman Program Studi PTI (Pendidikan Teknologi Informasi)
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Mengeksplorasi Profil Program Studi PTI
    Frontend->>Backend: Meminta perincian paket data keilmuan Prodi PTI
    
    Backend->>Database: Ekstrak tunggal ringkasan Profil entri wilayah PTI
    Backend->>Database: Ekstrak senarai pengurus eksklusif afiliasi PTI
    Backend->>Database: Ekstrak barisan daftar Kurikulum silabus PTI
    
    Backend-->>Frontend: Menyusun dan membangun Tampilan Web jurusan Pendidikan TI
    Frontend-->>User: Sajikan Pesona Layar Profil utuh Prodi Pend. Teknologi Informasi
```

## Sequence Diagram: Halaman Fasilitas Ruangan
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Ingin melihat-lihat Sarana Fasilitas Ruangan
    Frontend->>Backend: Meminta rincian inventaris aset daftar Ruangan
    
    Backend->>Database: Perintah Ambil Data (identifikasi ruang, kapasitas & letak fisiknya)
    Database-->>Backend: Serahkan susunan rekaman prasarana fisik kampus
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Prasarana Ruangan
    Frontend-->>User: Paparkan Layar Galeri Estetis Fasilitas Ruang Kelas ke Pandangan
```

## Sequence Diagram: Halaman Fasilitas Laboratorium
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Mengunjungi Halaman Laboratorium
    Frontend->>Backend: Meminta informasi fasilitas mesin internal Laboratorium
    
    Backend->>Database: Perintah Ambil Data (Ketersediaan mesin peranti & daftar Lab)
    Database-->>Backend: Kembalikan nama profil Lab, inventaris, beserta daftar koleksinya
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Fasilitas Lab utuh
    Frontend-->>User: Tampilkan Etalase Galeri Mesin Laboratorium Komputer Terpadu
```

## Sequence Diagram: Halaman Kalender Akademik
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Mengeksplorasi laman Kalender Akademik Resmi
    Frontend->>Backend: Memanggil rilis pemaparan Kalender Aktivitas Terkini
    
    Backend->>Database: Perintah Ambil Data (Riwayat kalender ajaran aktif terbaru)
    Database-->>Backend: Mengembalikan teks desklumat serta tautan ilustrasi grafis Kalender
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web rilis jadwal Kalender
    Frontend-->>User: Sajikan Tampilan utuh Susunan Kalender Akademik Fakultas
```

## Sequence Diagram: Halaman Dokumen Kurikulum
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Membuka direktori akses Dokumen Kurikulum Dasar
    Frontend->>Backend: Meminta sajian materi referensi berkas silabus
    
    Backend->>Database: Perintah Ambil Data (Riwayat matriks referensi Kurikulum)
    Database-->>Backend: Kembalikan tajuk naskah & tautan Unduhan (*Downloadable*) File PDF/DOC
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Susunan Etalase Kurikulum
    Frontend-->>User: Suguhkan Antarmuka Daftar Pengunduhan Tata Aturan Kurikulum 
```

## Sequence Diagram: Halaman Dokumen Fakultas
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Menyusuri indeks halaman Dokumen Ketetapan Fakultas
    Frontend->>Backend: Meminta muat ulang wujud Dokumen Ketatapan Publik
    
    Backend->>Database: Perintah Ambil Data (Menelisik jejak riwayat Fail SK)
    Database-->>Backend: Serahkan susunan pemetaan letak tautan fail penyimpanan dokumen 
    
    Backend-->>Frontend: Mengikat tatanan pemuatan wujud Tampilan Web Daftar Unduhan Fakultas
    Frontend-->>User: Tampilkan Tabel Etalase Pengunduhan Arsip Hukum Publik secara utuh
```

## Sequence Diagram: Halaman Rencana Strategis (Renstra)
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Mengeklik menu halaman Rencana Strategis
    Frontend->>Backend: Memanggil rilis wujud laporan Renstra Fakultas
    
    Backend->>Database: Perintah Ambil Data (Naskah catatan strategi jangka panjang organisasi)
    Database-->>Backend: Serahkan deskripsi paragraf wawasan serta link akses Berkas Dokumen 
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Rencana Strategis Siap Dibaca
    Frontend-->>User: Tampilkan Antarmuka utuh Informasi Acuan Strategis Fakultas
```

## Sequence Diagram: Halaman Standar Operasional Prosedur (SOP)
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Menengok direktori penelusuran Ketetapan SOP
    Frontend->>Backend: Meminta sajian susunan urutan kepatuhan aturan SOP
    
    Backend->>Database: Perintah Ambil Data (Menyingkap tabulasi direktori layanan SOP resmi)
    Database-->>Backend: Mengembalikan wujud nama instruktur layanan serta tautannya ke layar
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Rantai Standar SOP
    Frontend-->>User: Suguhkan Layar Tabel Unduhan Arsip Operasional Ke Ruang Pandang
```

## Sequence Diagram: Halaman Data Penelitian
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Membuka Laman Direktori Tulisan Jurnal / Hasil Riset
    Frontend->>Backend: Meminta daftar kumpulan pelacakan riwayat aktivitas Penelitian Sivitas
    
    Backend->>Database: Perintah Ambil Data (Menyisir tumpukan publikasi aktivitas akademik di perpus)
    Database-->>Backend: Membalas kembalian pemaparan tajuk abstrak judul jurnal dan tautannya
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Kompilasi Karya Kajian Penelitian
    Frontend-->>User: Sajikan Daftar Artikel Riwayat Keilmuan Para Peneliti ke Hadapan Pengunjung
```

## Sequence Diagram: Halaman Data Pengabdian Masyarakat
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Menelurusi Laman Rekam Jejak Kiprah Pengabdian Sosial
    Frontend->>Backend: Meminta muatan dokumentasi rekaman aktivitas sosial Pengabdian
    
    Backend->>Database: Perintah Ambil Data (Koleksi agenda dokumenter pengabdian masif di luar lapangan)
    Database-->>Backend: Mewakili penarikan esai pengenalan aktivitas serta laporannya kembali merapat 
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Album Karya Berbakti Masyarakat
    Frontend-->>User: Munculkan Tayangan Dokumenter Pengabdian Ke dalam Ruang Baca Khalayak Luas
```

## Sequence Diagram: Halaman Profil Organisasi (BEM)
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Mengeklik lajur identitas kepengurusan BEM (Badan Eksekutif)
    Frontend->>Backend: Menagih riwayat penataan struktur silsilah kabinet mahasiswa BEM pelaporan 
    
    Backend->>Database: Perintah Ambil Data (Mengabsen eksistensi tabel departemen, kepengurusan & identitas BEM)
    Database-->>Backend: Pertukaran pengakuan perihal wujud deskriptif kepemimpinan disahkan mutlak
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Antarmuka Identitas Induk Mahasiswa
    Frontend-->>User: Paparkan Tampilan Pesona Skema Berbalut Identitas Anggun BEM ke Permukaan Layar
```

## Sequence Diagram: Halaman Unit Kegiatan Mahasiswa (UKM)
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Memicu klik tombol menu Unit Ekstrakurikuler (Galeri UKM)
    Frontend->>Backend: Meminta pembeberan eksistensi segenap atribut Unit Kegiatan terdaftar sah 
    
    Backend->>Database: Perintah Ambil Data (Menarik ke atas kolektif barisan pendaftaran perkumpulan)
    Database-->>Backend: Berikan wujud tajuk himpunan minor, profil ranah peminatan, serta lampiran fotonya
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Daftar Grid Etalase Profil Perkumpulan Kampus
    Frontend-->>User: Suguhkan Antarmuka Galeri Meriah Potret Keaktifan Pemuda UKM nan Dinamis Mutlak
```

## Sequence Diagram: Halaman Himpunan Mahasiswa
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Mencari pangkalan letak susunan himpunan otoritatif prodi (Jurusan) eksklusif
    Frontend->>Backend: Meminta pengungkapan tata aturan perwakilan tiap jajaran HIMA di bawah naungan BEM
    
    Backend->>Database: Perintah Ambil Data (Menagih rincian struktural masing-masing kelompok perwakilan jurusan)
    Database-->>Backend: Mewujudkan pertukaran penyerahan tabel Program Kerja spesifik per rumpun perwakilan  
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Etalase Kemerincian Susunan Kabinet Cabang Independen
    Frontend-->>User: Paparkan Profil Megah Relasional Aktivis Mahasiswa Pemegang Identitas Perjurusan Prodi
```

## Sequence Diagram: Halaman Profil & Tracer Alumni
```mermaid
sequenceDiagram
    autonumber
    actor User as Pengunjung
    participant Frontend as Frontend
    participant Backend as Backend
    participant Database as Database

    User->>Frontend: Singgah merunut pelacakan riwayat kelulusan pemuda cendekia (Ruang Pencarian Alumni)
    Frontend->>Backend: Mengajukan penarikan data wujud Direktori Kelulusan serta kiprah sukses riwayat Purna Kampus
    
    Backend->>Database: Perintah Ambil Data (Menelisik susunan deretan daftar riwayat prestasi alumnus kebanggaan per tahun)
    Database-->>Backend: Hadirkan rentetan kompilasi wawasan data karir penempatan serta rekam masa pelepasan ke tangan server
    
    Backend-->>Frontend: Menyusun menjadi Tampilan Web Riwayat Lintas Waktu para Pemegang Takhta Kesuksesan Belajar 
    Frontend-->>User: Tampilkan Lembar Kebanggaan Perjalanan Waktu Catatan Karier dan Keaktifan Anggota Purna Lulusan Web 
```