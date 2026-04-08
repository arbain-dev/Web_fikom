# BAB IV — PERANCANGAN SISTEM: 4.1.2 Activity Diagram (Publik)

## 4.1.2 Pengertian *Activity Diagram* Sisi Pengunjung
*Activity Diagram* berikut menjabarkan urutan interaksi sistem saat diakses oleh pengunjung umum, sivitas akademika, maupun calon mahasiswa. Akses publik tidak memerlukan proses *login*, sehingga diagram ini berfokus pada alur navigasi dan pilihan yang dapat dilakukan pengguna pada setiap halaman. Simbol lingkaran hitam penuh menandai titik awal (*Start*), sedangkan lingkaran dengan batas ganda menandai titik akhir (*End*) dari setiap aktivitas.

---

## 4.3 Alur Aktivitas Publik (Pengunjung)

### 4.3.1 Activity Diagram Interaksi Halaman Beranda (Home)

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Utama Beranda]
    
    A --> B{Buka Menu\nNavigasi Atas?}
    B -- Iya --> C[Pindah ke Halaman\nProfile/Akademik]
    C --> End((( )))
    
    B -- Tidak/Scroll --> D[Melihat Bagian\nSlider Banner Utama]
    
    D --> E{Klik Tombol Prodi\nAtau Berita?}
    E -- Iya --> F[Pindah ke Halaman\nInformatika/Berita]
    F --> End
    
    E -- Tidak --> G[Memperhatikan Animasi\nFakta Fakultas]
    G --> H[Melihat Daftar\nBerita Terbaru]
    
    H --> I{Pilih Baca\nArtikel Berita?}
    I -- Iya --> J[Dialihkan ke Halaman\nDetail Berita Pilihan]
    J --> End
    
    I -- Tidak --> K[Membaca Deskripsi Singkat\nTentang Fakultas]
    K --> L{Klik Tombol\nSelengkapnya?}
    L -- Iya --> M[Dialihkan ke Halaman\nVisi Misi Fakultas]
    M --> End
    
    L -- Tidak --> N[Melihat Pilihan Program Studi\nInformatika dan Pendidikan TI]
    N --> O[Melihat Fitur Kelompok\nInformasi Akademik]
    
    O --> P{Akses Info\nAkademik?}
    P -- Iya --> Q[Dialihkan ke Kalender, Kurikulum,\nDosen, atau Lab]
    Q --> End
    
    P -- Tidak --> R[Memperhatikan Rentetan Logo\nMitra Kerja Sama Institusi]
    R --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.22** Activity Diagram Interaksi Halaman Beranda (Home)*

**Penjelasan:**
Pengguna membuka halaman beranda dan memiliki beberapa jalur interaksi. Jika pengguna menggunakan menu navigasi atas, sistem langsung memindahkan ke halaman tujuan. Jika pengguna menggulir ke bawah, sistem menampilkan konten secara berurutan mulai dari *slider*, fakta fakultas, berita terbaru, deskripsi fakultas, pilihan program studi, hingga logo mitra kerjasama. Pada setiap bagian, pengguna dapat mengklik untuk berpindah ke halaman yang lebih detail.

---

### 4.3.2 Activity Diagram Interaksi Halaman Visi dan Misi

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Visi Misi]
    A --> B[Sistem Menampilkan Judul Halaman]
    B --> C{Pilih Fokus\nBagian Bacaan}
    
    C -- Bagian Visi --> D1[Fokus Membaca Paragraf Visi Fakultas]
    C -- Bagian Misi --> D2[Pindah Membaca Barisan Nomor Poin Misi]
    C -- Bagian Sasaran --> D3[Lompat Membaca Poin Sasaran Strategis Akhir]
    
    D1 --> End((( )))
    D2 --> End
    D3 --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.23** Activity Diagram Interaksi Halaman Visi dan Misi*

**Penjelasan:**
Setelah halaman terbuka, pengguna dapat memilih untuk membaca salah satu dari tiga bagian konten yang tersedia, yaitu Visi, Misi, atau Sasaran Strategis Fakultas. Sistem menampilkan konten yang dipilih dan aktivitas berakhir setelah pengguna selesai membaca bagian tersebut.

---

### 4.3.3 Activity Diagram Interaksi Halaman Sambutan Pimpinan

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Sambutan]
    A --> B[Menampilkan Halaman Teks dan Foto Pimpinan]
    
    B --> C{Pemfokusan Lensa\nPerhatian Pembaca?}
    C -- Fokus Sudut Kiri --> D1[Membaca Teks Kelengkapan Sambutan Dekan]
    C -- Fokus Sudut Kanan --> D2[Memperhatikan Kontak Profil dan Pesan Singkat Dekan]
    
    D1 --> End((( )))
    D2 --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.24** Activity Diagram Interaksi Halaman Sambutan*

**Penjelasan:**
Sistem memuat halaman yang menampilkan teks sambutan lengkap dan foto pimpinan secara bersamaan. Pengguna dapat memilih untuk fokus membaca narasi sambutan Dekan di sisi kiri, atau melihat informasi kontak singkat Dekan di sisi kanan halaman.

---

### 4.3.4 Activity Diagram Interaksi Direktori Dosen

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Direktori Dosen]
    
    A --> B[Mengamati Daftar Susunan Dosen & Pimpinan]
    B --> C{Klik Kartu\nSalah Satu Dosen?}
    
    C -- Tidak --> End((( )))
    
    C -- Iya --> D[Tampilkan Jendela Detail Data Dosen]
    D --> E{Ingin Menghubungi\nLewat Email?}
    
    E -- Iya --> F[Buka Aplikasi Email Perangkat]
    F --> End
    
    E -- Tidak --> G[Tutup Jendela Detail Popup]
    G --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.25** Activity Diagram Interaksi Direktori Dosen*

**Penjelasan:**
Sistem menampilkan daftar kartu dosen dan pimpinan fakultas. Jika pengguna mengklik salah satu kartu, sistem memunculkan jendela *popup* berisi detail informasi dosen tersebut. Dari jendela *popup*, pengguna dapat langsung menghubungi dosen melalui email atau menutup jendela untuk kembali ke daftar.

---

### 4.3.5 Activity Diagram Interaksi Halaman Struktur Organisasi

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Struktur Organisasi]
    
    A --> B[Membaca Deskripsi & Memusatkan Pandangan pada Bagan Struktur]
    B --> C{Validasi Lanjut\nCek Posisi Pimpinan?}
    
    C -- Iya --> D[Melihat dan Melacak Alur Garis Jabatan dari Atas ke Bawah]
    D --> End((( )))
    
    C -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.26** Activity Diagram Interaksi Halaman Struktur Organisasi*

**Penjelasan:**
Sistem menampilkan bagan hierarki jabatan beserta deskripsi singkat struktur organisasi fakultas. Pengguna dapat menelusuri alur garis jabatan dari posisi tertinggi hingga ke bawah, atau cukup melihat sekilas bagan yang tersaji.

---

### 4.3.6 Activity Diagram Interaksi Halaman Pendaftaran Mahasiswa Baru

```mermaid
flowchart TD
    Start(( )) --> A[Akses Halaman Formulir Pendaftaran Maba]
    
    A --> B[Mengisi Data Wajib & Mengunggah File Opsional Berkas KTP/Ijazah]
    B --> C[Tekan Tombol Segmen Kirim Pendaftaran]
    C --> D{Sistem Identifikasi:\nAda Input Kosong / Error Sistem?}
    
    D -- Iya --> E[Tampilkan Peringatan Wajib Isi dan Pembersihan Kembali Fokus Form]
    E --> B
    
    D -- Tidak --> F[Simpan Data Pendaftaran secara Otomatis]
    F --> G[Sistem Membuat Kotak Pesan Sukses Mendaftar]
    G --> End((( )))
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.27** Activity Diagram Interaksi Halaman Pendaftaran Mahasiswa Baru*

**Penjelasan:**
Pengguna mengisi formulir pendaftaran beserta berkas pendukung, lalu menekan tombol kirim. Sistem memeriksa kelengkapan isian; jika ada data yang kosong atau tidak valid, sistem menampilkan peringatan agar diperbaiki. Jika semua data valid, sistem menyimpan data pendaftaran dan menampilkan notifikasi berhasil.

---

### 4.3.7 Activity Diagram Prodi TI (Informatika)

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Prodi Informatika]
    
    A --> B[Menggulir Laman & Membaca Teks Pendahuluan Prodi]
    B --> C{Lanjut Cek Bagian\nVisi Misi Fakultas?}
    
    C -- Iya --> D[Membaca Urutan Visi dan Misi]
    D --> E{Lanjut Turun Ke\nDaftar Susunan Dosen?}
    
    C -- Tidak --> F[Tinggalkan Area Pengecekan]
    F --> End((( )))
    
    E -- Iya --> G[Melihat Grid Kartu Daftar Pengajar Khusus Informatika]
    G --> End
    
    E -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.28** Activity Diagram Prodi TI (Informatika)*

**Penjelasan:**
Halaman Prodi Informatika menampilkan teks pendahuluan, lalu pengguna dapat melanjutkan ke bagian Visi dan Misi, kemudian ke daftar dosen yang ditampilkan dalam format kartu grid. Pengguna dapat berhenti di bagian mana saja sesuai kebutuhan.

---

### 4.3.8 Activity Diagram Prodi Pendidikan Teknologi Informasi (PTI)

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Prodi Pend. TI]
    
    A --> B[Menggulir Laman & Membaca Teks Pendahuluan Prodi]
    B --> C{Lanjut Memeriksa\nVisi Misi Fakultas?}
    
    C -- Iya --> D[Membaca Teks Urutan Cita-Cita Pendidikan]
    D --> E{Melanjutkan\nMelihat Dosen?}
    
    C -- Tidak --> End((( )))
    
    E -- Iya --> G[Memperhatikan Matriks Grid Dosen Spesialis Perguruan]
    G --> End
    
    E -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.29** Activity Diagram Prodi Pend. TI*

**Penjelasan:**
Halaman Prodi PTI memiliki alur yang sama dengan Prodi Informatika, namun menampilkan data khusus Program Studi Pendidikan Teknologi Informasi. Pengguna dapat menelusuri pendahuluan, visi misi, dan daftar dosen PTI secara berurutan sesuai kebutuhan.

---

### 4.3.9 Activity Diagram Menu Ruangan Kelas

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Ruangan Kelas]
    
    A --> B[Melihat Rentetan Daftar dan Gambar Kartu Ruangan]
    B --> C{Pilih dan Klik Mengetuk\nSalah Satu Gambar Ruangan?}
    
    C -- Iya --> D[Sistem Merespon Memunculkan Jendela Popup Gambar Lebar]
    D --> E[Pengunjung Mengeklik Silon Tutup Jendela Popup Kembali Keluar]
    E --> End((( )))
    
    C -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.30** Activity Diagram Menu Ruangan Kelas*

**Penjelasan:**
Sistem menampilkan daftar kartu gambar ruangan kelas yang tersedia. Jika pengguna mengklik salah satu gambar, sistem membuka jendela *popup* yang menampilkan gambar tersebut dalam ukuran penuh. Pengguna menutup jendela dengan mengklik tombol silang untuk kembali ke daftar.

---

### 4.3.10 Activity Diagram Menu Laboratorium

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Laboratorium Komputer]
    
    A --> B[Melihat Galeri Gambar Fasilitas Tiap Lab]
    B --> C{Berminat Klik Cek\nSalah Satu Gambar Lab?}
    
    C -- Iya --> D[Memantik Fitur Tumbukan Cahaya Jendela Resolusi Tinggi]
    D --> E[Mengakhiri dan Mengeklik Tombol Tutup Silang]
    E --> End((( )))
    
    C -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.31** Activity Diagram Menu Laboratorium*

**Penjelasan:**
Sistem menampilkan galeri foto fasilitas setiap laboratorium komputer yang ada di fakultas. Pengguna dapat mengklik foto untuk melihatnya dalam ukuran besar, kemudian menutup tampilan tersebut dengan tombol silang.

---

### 4.3.11 Activity Diagram Menu Kurikulum

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Kurikulum Fakultas]
    
    A --> B[Memperhatikan Panel Kotak Info Spesifikasi Kurikulum]
    B --> C{Klik Perintah Aksi\nLihat Lampiran PDF?}
    
    C -- Iya --> D[Sistem Memanggil Kotak Modal Pratinjau Dokumen Berkas]
    D --> E[Mengeklik Barisan Batal atau Tutup Keluar Bingkai PDF]
    E --> End((( )))
    
    C -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.32** Activity Diagram Menu Kurikulum*

**Penjelasan:**
Sistem menampilkan panel informasi kurikulum akademik yang berlaku. Pengguna dapat mengklik tombol untuk membuka pratinjau dokumen PDF kurikulum secara langsung di dalam halaman, lalu menutupnya jika sudah selesai membaca.

---

### 4.3.12 Activity Diagram Menu Kalender Akademik

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Kalender Akademik]
    
    A --> B[Melihat Panel Rentetan Daftar Kegiatan Kartu Kalender Tahunan]
    B --> C{Klik Sentuh\nSektor Poster Kalender?}
    
    C -- Iya --> D[Sistem Membesarkan Membentangkan Jendela Popup Kalender Utuh]
    D --> E[Menekan Klik Lensa Tutup Silang Kalender]
    E --> End((( )))
    
    C -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.33** Activity Diagram Menu Kalender Akademik*

**Penjelasan:**
Sistem menampilkan daftar kartu kalender akademik per semester atau tahun ajaran. Pengguna dapat mengklik poster kalender untuk melihatnya dalam tampilan penuh melalui jendela *popup*, kemudian menutupnya dengan tombol silang.

---

### 4.3.13 Activity Diagram Menu Dokumen Fakultas

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Dokumen Fakultas]
    
    A --> B[Sistem Menampilkan Daftar Kartu Dokumen]
    B --> C{Membutuhkan\nSalinan Dokumen?}
    
    C -- Iya --> D[Mengeklik Tombol Unduh PDF]
    D --> E[Sistem Menyimpan File ke Perangkat Pengunjung]
    E --> End((( )))
    
    C -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.34** Activity Diagram Menu Dokumen Fakultas*

**Penjelasan:**
Sistem menampilkan daftar dokumen resmi fakultas (seperti Renop, Renstra, atau SOP) yang tersedia. Jika pengguna membutuhkan salinan, pengguna mengklik tombol unduh dan sistem secara otomatis menyimpan berkas PDF ke perangkat pengguna.

---

### 4.3.14 Activity Diagram Menu Rencana Strategis (Renstra)

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Rencana Strategis]
    
    A --> B[Sistem Menampilkan Daftar Kartu Dokumen]
    B --> C{Membutuhkan\nSalinan Dokumen?}
    
    C -- Iya --> D[Mengeklik Tombol Unduh PDF]
    D --> E[Sistem Menyimpan File ke Perangkat Pengunjung]
    E --> End((( )))
    
    C -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.35** Activity Diagram Menu Rencana Strategis*

**Penjelasan:**
Sistem menampilkan daftar dokumen Rencana Strategis (Renstra) yang tersedia untuk diakses publik. Pengguna yang memerlukan salinan dapat langsung mengunduh berkas PDF yang dipilih ke perangkat mereka.

---

### 4.3.15 Activity Diagram Menu Standar Operasional Prosedur (SOP)

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman SOP Fakultas]
    
    A --> B[Sistem Menampilkan Rentetan Pedoman SOP]
    B --> C{Membutuhkan\nSalinan Pedoman?}
    
    C -- Iya --> D[Mengeklik Tombol Unduh SOP]
    D --> E[Sistem Menyimpan File ke Perangkat Pengunjung]
    E --> End((( )))
    
    C -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.36** Activity Diagram Menu SOP*

**Penjelasan:**
Sistem menampilkan daftar pedoman Standar Operasional Prosedur (SOP) yang berlaku di lingkungan fakultas. Pengguna yang memerlukan salinan pedoman dapat mengunduhnya langsung ke perangkat masing-masing.

---

### 4.3.16 Activity Diagram Menu Penelitian Dosen

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Penelitian Dosen]
    
    A --> B[Melihat Tabel Daftar Judul Riset]
    B --> C{Cek Rincian\nSatu Penelitian?}
    
    C -- Iya --> D[Sistem Menampilkan Jendela Melayang Informasi Detail]
    D --> E{Kunjungi Sumber\nJurnal Asli?}
    
    C -- Tidak --> End((( )))
    
    E -- Iya --> F[Mengeklik Tombol Lihat Publikasi]
    F --> G[Sistem Membuka Tab Baru menuju Web Induk Jurnal]
    G --> End
    
    E -- Tidak --> H[Tutup Jendela Informasi]
    H --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.37** Activity Diagram Menu Penelitian Dosen*

**Penjelasan:**
Sistem menampilkan tabel daftar judul penelitian dosen fakultas. Pengguna dapat mengklik salah satu judul untuk melihat detail penelitian melalui jendela *popup*. Dari jendela tersebut, pengguna juga dapat mengunjungi sumber jurnal asli yang akan dibuka di tab baru peramban.

---

### 4.3.17 Activity Diagram Menu Pengabdian Masyarakat

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Pengabdian Masyarakat]
    
    A --> B[Melihat Daftar Laporan Aksi Sosialisasi Dosen]
    B --> C{Ingin Mengamati\nIsi Laporannya?}
    
    C -- Iya --> D[Mengeklik Tombol Lihat Laporan]
    D --> E[Sistem Membangkitkan Layar Pratinjau Dokumen]
    E --> F[Menekan Silang untuk Menutup Layar Pratinjaunya]
    F --> End((( )))
    
    C -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.38** Activity Diagram Menu Pengabdian Masyarakat*

**Penjelasan:**
Sistem menampilkan daftar laporan kegiatan pengabdian masyarakat yang telah dilaksanakan oleh dosen. Pengguna dapat mengklik tombol "Lihat Laporan" untuk membuka pratinjau dokumen secara langsung, lalu menutupnya setelah selesai membaca.

---

### 4.3.18 Activity Diagram Menu Badan Eksekutif Mahasiswa (BEM)

```mermaid
flowchart TD
    Start(( )) --> A[Akses Kepengurusan BEM FIKOM]
    
    A --> B[Membaca Teks Sampul Kepengurusan]
    B --> C[Menggulir Laman Melihat Jajaran Pimpinan Inti]
    C --> D[Menggeser Turun Melihat Kotak Kabinet Sekretaris & Bendahara]
    D --> E[Turun Menyaksikan Bentangan Anggota Departemen Fungsional]
    E --> End((( )))
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.39** Activity Diagram Menu Badan Eksekutif Mahasiswa (BEM)*

**Penjelasan:**
Halaman BEM menampilkan konten secara berurutan dari atas ke bawah tanpa persimpangan pilihan. Pengguna melihat teks pengantar, jajaran pimpinan inti, susunan kabinet, hingga daftar anggota departemen fungsional BEM FIKOM.

---

### 4.3.19 Activity Diagram Menu Kegiatan UKM

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Berkas UKM]
    
    A --> B[Menatap Daftar Kartu Berita Kegiatan Mahasiswa]
    B --> C{Terpikat Membaca\nSatu Berita UKM?}
    
    C -- Iya --> D[Menekan Judul atau Tombol Baca Selengkapnya]
    D --> E[Sistem Membawa Pergi ke Halaman Rincian Berita]
    E --> End((( )))
    
    C -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.40** Activity Diagram Menu Kegiatan UKM*

**Penjelasan:**
Sistem menampilkan daftar kartu berita kegiatan Unit Kegiatan Mahasiswa (UKM). Jika pengguna tertarik membaca salah satu berita, pengguna mengklik judul atau tombol "Baca Selengkapnya" dan sistem mengarahkan ke halaman detail berita tersebut.

---

### 4.3.20 Activity Diagram Menu Himpunan Mahasiswa

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Himpunan Mahasiswa]
    
    A --> B[Membaca Teks Sambutan Pengenalan Himpunan]
    B --> C[Menggigit Fokus pada Kotak Himpunan HMTI]
    C --> D[Berpindah Menyaksikan Kotak Himpunan HMPTI]
    D --> End((( )))
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.41** Activity Diagram Menu Himpunan Mahasiswa*

**Penjelasan:**
Halaman Himpunan Mahasiswa menampilkan konten secara linear. Pengguna membaca teks pengantar, kemudian melihat informasi Himpunan Mahasiswa Teknik Informatika (HMTI), dilanjutkan dengan Himpunan Mahasiswa Pendidikan Teknologi Informasi (HMPTI).

---

### 4.3.21 Activity Diagram Menu Alumni (Tracer Study)

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Alumni & Tracer Study]
    
    A --> B[Sistem Menampilkan Statistik Sebaran Alumni]
    B --> C[Melihat Persentase Kebekerjaan & Masa Tunggu]
    
    C --> D{Ingin Mengisi\nTracer Study?}
    
    D -- Iya --> E[Mengeklik Tombol Isi Form Tracer Study]
    E --> F[Sistem Mengarahkan ke Web Eksternal Tracer Study]
    F --> End((( )))
    
    D -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.42** Activity Diagram Menu Alumni*

**Penjelasan:**
Sistem memuat halaman alumni yang menyajikan data statistik riwayat lulusan. Pengguna dapat melihat grafik atau angka pencapaian alumni. Jika pengguna adalah alumni yang ingin berkontribusi data, pengguna dapat mengklik tombol "Isi Form Tracer Study" yang akan mengarahkan ke platform eksternal resmi kemdikbud.
