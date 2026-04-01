# BAB IV — PERANCANGAN SISTEM: 4.1.2 Activity Diagram (Publik)

## 4.1.2 Pengertian *Activity Diagram* Sisi Pengunjung
*Activity Diagram* (Diagram Aktivitas) berikut ini menjabarkan urutan proses pada sistem saat diakses secara terbuka oleh **Sivitas Akademika, Calon Mahasiswa, maupun Masyarakat Umum**. Tidak seperti struktur Administrator, akses di ranah Publik ini (*Frontend*) tidak membutuhkan tahapan *login*, melainkan memodelkan interaksi nyata antara antarmuka (*User Interface*) dengan pilihan navigasi pengunjung (seperti kehendak mengklik tombol, membaca rincian, atau melakukan *scroll*). Lingkaran penuh berwarna solid menandai *Start Node* (titik permulaan pengguna membuka halaman), *Decision Node* (bentuk ketupat) merepresentasikan persimpangan pilihan pengguna, dan lingkaran dengan batas garis ganda menunjukkan *End Node* (titik akhir kegiatan di suatu halaman).

---

## 4.3 Alur Aktivitas Publik (Pengunjung)

### 4.3.1 Activity Diagram Interaksi Halaman Beranda (Home)

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Utama Beranda]
    A --> B{Pilih Aksi / Navigasi Interaksi}
    
    B -- Klik Navigasi Atas --> C1[Pindah ke Menu Navbar Profil/Akademik]
    B -- Klik Tombol Slider --> C2[Lihat Program / Berita Lain]
    B -- Pilih Daftar Berita --> C3[Lihat Detail Berita Pilihan]
    B -- Klik Tentang Fakultas --> C4[Dialihkan ke Halaman Visi Misi]
    B -- Cek Info Akademik --> C5[Ke Kurikulum, Dosen, atau Lab]
    B -- Abaikan Semua --> C6[Gulir Bebas Hingga Footer Mitra Kerja]
    
    C1 --> End((( )))
    C2 --> End
    C3 --> End
    C4 --> End
    C5 --> End
    C6 --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.22** Activity Diagram Interaksi Halaman Beranda (Home)*

**Penjelasan:**  
Bagan mendatar (*fan-out*) di atas merunut jejak pilihan pengguna di Beranda. Karena sistem menampung banyak porsi, alur interaksi tidak berjalan menukik ke bawah, melainkan disebar berjajar menyamping. Pengguna dihadapkan seketika pada berbagai pintu cabang: menu atas, *slider*, berita, info akademik, hingga sekadar menggulir ke bawah tanpa hambatan. Tiap pintu berdiri sejajar mengarah penyelesaian yang bersangkutan.

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
flowchart LR
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
flowchart LR
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
flowchart LR
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
flowchart LR
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
flowchart LR
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
flowchart LR
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
flowchart LR
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
flowchart LR
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
flowchart LR
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
