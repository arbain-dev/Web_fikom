# BAB IV — PERANCANGAN SISTEM: 4.1.2 Activity Diagram (Publik)

## 4.1.2 Pengertian *Activity Diagram* Sisi Pengunjung
*Activity Diagram* (Diagram Aktivitas) berikut ini menjabarkan urutan proses pada sistem saat diakses secara terbuka oleh **Sivitas Akademika, Calon Mahasiswa, maupun Masyarakat Umum**. Tidak seperti struktur Administrator, akses di ranah Publik ini (*Frontend*) tidak membutuhkan tahapan *login*, melainkan memodelkan interaksi nyata antara antarmuka (*User Interface*) dengan pilihan navigasi pengunjung (seperti kehendak mengklik tombol, membaca rincian, atau melakukan *scroll*). Lingkaran penuh berwarna solid menandai *Start Node* (titik permulaan pengguna membuka halaman), *Decision Node* (bentuk ketupat) merepresentasikan persimpangan pilihan pengguna, dan lingkaran dengan batas garis ganda menunjukkan *End Node* (titik akhir kegiatan di suatu halaman).

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
Bagan di atas merunut jejak interaksi pengguna yang menggulir layar ke bawah secara bertahap murni (*waterfall*). Sesuai urutan penampang di *file* pemrograman, pengunjung yang tidak mengeklik menu atas akan melewati serangkaian penawaran secara berurutan: mengamati *Slider* Utama, melewati penghitung angka Statistik, melihat daftar Berita, profil awal Fakultas, kotak Program Studi, dan blok Informasi Akademik, lalu berujung pada logo mitra yang berputar. Setiap blok menawarkan persimpangan, yang bila diabaikan, akan terus merambat ke kotak berikutnya hingga paling bawah.

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
Halaman ini menyajikan teks informasi statis. Pembaca dapat menelusuri ketiga elemen bacaan utamanya (Visi, Misi, Sasaran Strategis) secara leluasa dan berjajar menyamping selonjor selagi mereka menggulir dinamis layarnya hingga dirasa cukup dan keluar dari sirkuit interaksi.

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
Skema area *Sambutan Dekan* memaparkan pengalaman relasi persepsi responsif. Setibanya pengguna, antarmuka mendatangkan kisi persilangan posisi kiri dan kanan. Andil pengunjung dibentangkan bercabang mengarah samping, menyusuri paragraf di satu sisi pandang, lalu memantau kutipan ringkas di seberangnya di waktu yang berdampingan.

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
Pengalaman di etalase pengajar dibentuk menjalur ke samping (*Left-to-Right*). Bila pembaca mendapati instrukturnya lalu mengeklik salah satu susunan muka dosen, antarmuka mencuatkan pop-up (*jendela lapisan*). Kehadiran fungsional rute ini terpecah menjadi interaksi pelunasan pesan melalui email perangkat bersurat, atau sekadar membuang lapisannya menuju akhir jalur horisontal.

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
Berdasarkan bagan berorientasi bentang menyamping ini, cakupan navigasi visual perhadapkan di pusat peta gambar struktural. Pengamatan bergerak linear dari membaca judul membelah fokus jabatan pada alur pengawasan institusional fakultas dalam bagannya secara lurus dan segera selesai di kanan.

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
Formulir Pendaftaran memodelkan untaian sekuensial yang merambat utuh lurus dari pelataran kiri menuju kanan agar menumpas ketebalan vertikal layar. Setelah menekan tombol konfirmasi, bila ada luput format, iterasi putaran berpelintir kembali pada pengisian. Jika keakuratan terisi pas, diagram bergulir menuju penyimpanan data dan disudahi laporan kesuksesan hijau melintang.

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
Pemodelan *Informatika* dilarikan horizontal persis pergerakan ular. Interaksinya menggugah dari penelaahan *header* riwayat sambutan lalu mencadangkan lintasan pilihan: berakselerasi putus awal atau meluncur menyelami *grid* pengumuman muka-muka dosen pengampu jurusan.

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
Menyulap urutan bertingkat jadi berjajar memanjang melukiskan rute jelajah halaman pendidikan vokasi ini. Lintasan setara presisinya dengan Informatika; meluncur dari profil, menyelami pendalaman materi visi sampai menemukan ujung galeri dewan lektor perguruan bersangkutan dengan arah ke samping.

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
Merunut ke samping guna pangkas kepadatan susunan, ruangan kelas dihidupkan via penempatan galeri foto. Jantung pengait visual ditekankan pada gestur penekanan foto memancing *lightbox popup*, dilanjutkan keharusan pembaca mengetuk penyelesaian persilangan layarnya agar pudar.

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
Diagram menjalar rebah yang menjernihkan simulasi fasilitas laborat komputasi. Begitu memasuki pelelangan foto peralatan praktik, simpul mengizinkan penarikan tirai lebar *(Popup Mode)* ketika disinggung tombol intip oleh partisipan situs menjorok mengayun rute interaksi.

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
Lintasan lateral *(kiri ke kanan)* melukis skenario ekstraksi dokumen kurikulum akademis. Bila tumpukan info kotak direkam mata, dorongan aksi "Lihat PDF" menginstruksi modul bayangan menampilkan berkas *inline frame*. Perputaran diagram dipungkasi sekalian pengunjung mematikan panggung proyektor layar pratinjau itu.

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
Skema pamungkas publik dirangkai horizontal berjejer. Pengunjung memasuki gerbang kalender dibebaskan menggali poster jadwal per tahun. Menyetuh bidang kalender mana pun seketika membangunkan proyektor poster makro penanggalan. Lalu, memusnahkan modul dengan menekan silang jadi palang penutup sirkulasi interaktinya yang utuh.

---

### 4.3.13 Activity Diagram Menu Rencana Operasional (Renop)

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Rencana Operasional]
    
    A --> B[Sistem Menampilkan Daftar Kartu Dokumen]
    B --> C{Membutuhkan\nSalinan Dokumen?}
    
    C -- Iya --> D[Mengeklik Tombol Unduh PDF]
    D --> E[Sistem Menyimpan File ke Perangkat Pengunjung]
    E --> End((( )))
    
    C -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.34** Activity Diagram Menu Rencana Operasional*

**Penjelasan:**  
Pengunjung yang masuk ke halaman ini langsung disuguhkan rincian dokumen pedoman fakultas yang spesifik pada operasional. Proses keputusannya bertumpu pada apakah pengunjung ingin murni membaca sekelebatan atau bertekat mengunduh salinan berkas fisiknya, di mana ketukan pada tautan unduhan akan memicu sistem merespon dengan menyimpan berkas PDF langsung ke perangkat pembacanya.

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
Menirukan arsitektur sistem pada diagram Renop, menu Rencana Strategis membentangkan koleksi berkas pedoman jangka panjang. Alurnya sangat ringkas untuk memonitor kotak-kotak daftarnya dan memutuskan eksekusi proses pengunduhan (*Download*) seandainya pengguna memerlukan arsip dokumen aslinya.

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
Halaman Standar Operasional menjejaki skema interaksi perwujudan berkas digital. Pengunjung bisa berselancar bebas membaca gambaran singkat pelaksanaannya. Jika berniat mendalami ketentuan kerjanya secara paripurna, sistem akan menghantarkan perpindahan fail salinannya lewat satu pijatan khusus pada pemicu unduhannya menuju lumbung muatan gawai (*Download Folder*).

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
Aktivitas di ruang publikasi riset dirancang sedemikian interaktif. Mengingat muatan riwayatnya yang padat, penelusuran berawal santai sekadar melihat bingkai judul. Bila disinggung kursornya lantas ditekan, panel penengadah *(Popup Layer)* barulah membentangkan informasi penyandang dana berserta statusnya. Peran krusial interaksinya adalah memerdekakan pemakai menyeberang mandiri ke bilik ranah jurnal asli lewat sambungan tembus (*Link Redirect*) antar tab peramban perantaranya.

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
Pada seksi catatan karya sosialisasi masyarakat, antarmuka peninjau *(Document Viewer)* diarusutamakan untuk meluputkan paksaan pengunduhan sisa tumpukan fail tak perlu. Saat kehendak menyela mengintip laporan timbul, sistem membikin gelap buram belakang halaman sekadar membentangkan perwajahan bacaannya dan sirna saat dicopot.

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
Bagian administrasi organisasi intra-kampus ini ditutup lewat rutinitas navigasional kaku murni ke bawah *(waterfall)*. Kerangka dirajut menguntai selaras tata letak struktur berjenjang kemahasiswaan. Tapak penjelajahan cukup dipetakan mengikut seretan usapan layar meluncur dari puncak kepemimpinan presidium berangsur sampai lapis anggota-anggota akar kepengurusannya.

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
Jejak aktivitas mengintai kabar Unit Kegiatan Mahasiswa (UKM) ditarik mengarah ke bawah. Ketika peserta mendapati tumpukan majalah beritanya, persilangan muncul bilamana ada topik spesifik yang menggoda mereka. Memecet tautan beritanya lantas akan memindahkan tubuh situs menuju rute baru untuk penjabaran cerita selengkapnya.

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
Peta alir wawasan pilar kelembagaan mahasiswa prodi ini bersifat mengalir lurus (*waterfall*). Rancangan menuntun audiens sebatas menggerakkan layar gulir membaca petunjuk muka organisasi. Tatapannya diarahkan menyantap pamflet identitas himpunan per prodi satu-persatu lalu berujung menyudahi perantauan tanpa benturan kerumitan layar lanjutan.
