# BAB IV — PERANCANGAN SISTEM: 4.1.2 Activity Diagram (Publik)

## 4.1.2 Pengertian *Activity Diagram* Sisi Pengunjung
*Activity Diagram* (Diagram Aktivitas) berikut ini menjabarkan urutan proses pada sistem saat diakses secara terbuka oleh **Sivitas Akademika, Calon Mahasiswa, maupun Masyarakat Umum**. Tidak seperti struktur Administrator, akses di ranah Publik ini (*Frontend*) tidak membutuhkan tahapan *login*, melainkan memodelkan interaksi nyata antara antarmuka (*User Interface*) dengan pilihan navigasi pengunjung (seperti kehendak mengklik tombol, membaca rincian, atau melakukan *scroll*). Lingkaran penuh berwarna solid menandai *Start Node* (titik permulaan pengguna membuka halaman), *Decision Node* (bentuk ketupat) merepresentasikan persimpangan pilihan pengguna, dan lingkaran dengan batas garis ganda menunjukkan *End Node* (titik akhir kegiatan di suatu halaman).

---

## 4.3 Alur Aktivitas Publik (Pengunjung)

### 4.3.1 Activity Diagram Interaksi Halaman Beranda (Home)

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Utama Beranda]
    
    A --> B{Akses Menu\nNavigasi Atas?}
    B -- Iya --> C[Pindah ke Halaman\nSesuai Pilihan Menu Profil/Akademik]
    C --> End((( )))
    
    B -- Tidak / Scroll --> D[Melewati Bagian\nSlider Banner Utama]
    
    D --> E{Klik Tombol Prodi\nAtau Berita?}
    E -- Iya --> F[Pindah ke Halaman\nProgram Studi / Berita Lainnya]
    F --> End
    
    E -- Tidak --> G[Memperhatikan Fakta\nStatistik Fakultas]
    G --> H[Melihat Daftar\nBerita Terbaru]
    
    H --> I{Pilih Baca\nArtikel Berita?}
    I -- Iya --> J[Dialihkan ke Halaman\nDetail Berita Pilihan]
    J --> End
    
    I -- Tidak --> K[Memperhatikan Ringkasan\nProfil Fakultas]
    K --> L{Klik Tombol\nSelengkapnya?}
    L -- Iya --> M[Dialihkan ke Halaman\nVisi Misi Fakultas]
    M --> End
    
    L -- Tidak --> N[Melihat Program Studi\nInformatika dan Pendidikan TI]
    N --> O[Melihat Kisi Fitur\nInformasi Akademik]
    
    O --> P{Klik Akses\nInfo Akademik?}
    P -- Iya --> Q[Dialihkan ke Kalender / Kurikulum\n/ Dosen / Laboratorium]
    Q --> End
    
    P -- Tidak --> R[Melihat Rentetan Logo\nMitra Kerja Sama Institusi]
    R --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.22** Activity Diagram Interaksi Halaman Beranda (Home)*

**Penjelasan:**  
Bagan di atas merunut jejak interaksi pengguna selagi mereka berada di Beranda (*Home*). Seusai *loading* selesai, pengguna dihadapkan pada pilihan menggunakan fasilitas tombol menu atas *(Navbar)* atau menggerakkan layar *(scroll)* menelusuri penampang bawah. Setiap area *section* halaman semisal *Slider*, Berita, Tentang Fakultas, dan Informasi Akademik menawarkan penawaran tombol lanjutan (Persimpangan *Decision*) yang memungkinkan pengguna menghentikan perjalanan bacanya untuk langsung dikirim ke halaman cabang lain. Bila satu pun tombol pelintas tidak dihiraukan, rute interaksi linier berlanjut hanya sekadar memandangi ringkasan komprehensif hingga memutari galeri logo mitra kerja di titik akhir *footer*.

---

### 4.3.2 Activity Diagram Interaksi Halaman Visi dan Misi

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Visi Misi]
    
    A --> B[Sistem Menampilkan Judul Halaman dan Pembuka]
    B --> C[Pengunjung Menggulir Laman Layar Membaca Visi]
    C --> D[Membaca Barisan Nomor Poin Misi]
    
    D --> E{Lanjut Cari Info\nTujuan/Sasaran?}
    E -- Tidak --> End((( )))
    
    E -- Iya --> F[Menggulir Layar Lanjut untuk Membaca Bagian Tujuan]
    F --> G[Membaca Poin Sasaran Strategis Akhir]
    G --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.23** Activity Diagram Interaksi Halaman Visi dan Misi*

**Penjelasan:**  
Halaman ini bersifat mutlak pembacaan statis dan memiliki pola pergerakan vertikal yang konsisten. Kehadiran pembaca berujung pada konsumsi naskah-teks yang disusun per petak (*card*). Setelah membuka URL Visi Misi, pengguna pertama kali mencerna judul dan tujuan halaman. Interaksi kognitif kemudian dipetakan searah seputar apakah figur pembaca itu mendedikasikan waktu sekadar menyerap makna Visi, bergeser memilah target di dalam balok daftar Misi, hingga bersedia mempertimbangkan sasaran strategis di segmen penutup yang bermuara menyelesaikan tur informasi halamannya.

---

### 4.3.3 Activity Diagram Interaksi Halaman Sambutan Pimpinan

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Sambutan]
    
    A --> B[Tampilkan Halaman Teks dan Foto Pimpinan]
    B --> C{Pengunjung\nMenggulir Layar?}
    
    C -- Tidak --> End((( )))
    
    C -- Iya --> D[Membaca Teks Sambutan Dekan]
    D --> E[Memperhatikan Kontak Profil dan Pesan Singkat Dekan di Sisi Kanan]
    E --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.24** Activity Diagram Interaksi Halaman Sambutan*

**Penjelasan:**  
Diagram interaksi area *Sambutan Dekan* tidak dikontrol serangkaian tombol rumit namun mengukur pengalaman persepsi *layout* responsif yang direkam ke dalam *database*. Setibanya pengguna, antarmuka mendatangkan kisi persilangan (*Grid Sidebar*) yang mengatur komposisi sosiokultural halaman. Andil pengunjung dikerucutkan pada aksi menyusuri paragraf pengantar di satu sisi layar (Kiri), sembari sesekali menoleh memeperhatikan penyeranta ringkasan petatah jabatan pimpinan dan potret fotonya di penadah bingkai (Kanan), yang kesemuanya dapat diselesaikan dalam durasi guliran pendek ke *End Node*.

---

### 4.3.4 Activity Diagram Interaksi Direktori Dosen

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Direktori Dosen]
    
    A --> B[Memperhatikan Susunan Pemimpin Fakultas Paling Atas]
    B --> C[Mengamati Jajaran Dosen Tetap Program Studi]
    
    C --> D{Pilih Interaksi\nKlik Kartu Dosen?}
    D -- Tidak --> End((( )))
    
    D -- Iya --> E[Tampilkan Jendela Detail Data Dosen]
    
    E --> F{Ingin Menghubungi\nDosen Tersebut?}
    
    F -- Iya --> G[Ketuk Tombol Opsi Kirim Email]
    G --> H[Buka Aplikasi Email di Perangkat]
    H --> End
    
    F -- Tidak --> I[Ketuk Tombol Silang atau Tutup Area Popup]
    I --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.25** Activity Diagram Interaksi Direktori Dosen*

**Penjelasan:**  
Pengalaman berselancar di hamparan etalase pengajar (*Dosen*) membawa pengayaan antarmuka *Popup* (tumpangan modul layar kecil). Diagram mendikte pengunjung melewati identifikasi struktur utama menuju pemindaian tumpukan muka edukator. Bila pembaca menemukan instrukturnya lalu memicu klik pada salah satu kartunya, sistem mengabulkan inisiatif itu lewat tebaran informasi mendalam berupa biodata di dalam kotak interaktif *Popup*. Rute terpecah menjadi eksekusi tombol komunikasi rujukan menuju layanan bersurat menyurat elektronik (*Email*), ataupun tindakan sepele menutup bingkai modul guna melanjutkan penyarian ke dosen-dosen lainnya menuju kesimpulan penelusuran.

---

### 4.3.5 Activity Diagram Interaksi Halaman Struktur Organisasi

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Utama Struktur Organisasi]
    
    A --> B[Membaca Teks Pendahuluan dan Deskripsi Halaman]
    B --> C[Menggeser Tampilan Menuju Gambar Pusat Bagan Struktur]
    
    C --> D{Validasi Lanjut\nCek Posisi Pimpinan?}
    D -- Iya --> E[Melihat Garis Jabatan dari Atas ke Bawah]
    E --> End((( )))
    
    D -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.26** Activity Diagram Interaksi Halaman Struktur Organisasi*

**Penjelasan:**  
Cakupan fungsi di menu struktural amat ringkas. Skenario diagram merunut perjalanan navigasi visual terhadap cetak penampang grafis (*image/picture*) yang termuat di pusat kanvas. Urutan alurnya dipukul rata mulai dari menangkap maklumat nama bagannya, lalu fokus membelah dan menerjemahkan hirarki jabatan (misal melacak alur wewenang pengawasan program dan dewan kepengurusan) pada jalinan anak panah yang melakat di gambar struktur tersebut menuju penutup kegiatan.

---

### 4.3.6 Activity Diagram Interaksi Halaman Pendaftaran Mahasiswa Baru

```mermaid
flowchart TD
    Start(( )) --> A[Akses Halaman Formulir Pendaftaran Maba]
    
    A --> B[Mempelajari Petunjuk Ringkas Pengisian di Kotak Panel Samping Kanan]
    B --> C[Mengisi Data Wajib Utama di Kolom Formulir Pendaftaran]
    C --> D[Ikut Serta Mengunggah File Format Opsional Serupa KTP dan Ijazah]
    
    D --> E[Tekan Tombol Segmen Kirim Pendaftaran]
    
    E --> F{Sistem Identifikasi:\nAda Input Kosong / Format Error?}
    
    F -- Iya --> G[Tampilkan Peringatan Wajib Isi dan Kembalikan Fokus ke Kotak Form Perbaikan]
    G --> C
    
    F -- Tidak --> H[Simpan Data Pendaftaran secara Otomatis]
    H --> I[Membuat dan Menampilkan Desain Kotak Pesan Sukses Mendaftar]
    I --> End((( )))
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.27** Activity Diagram Interaksi Halaman Pendaftaran Mahasiswa Baru*

**Penjelasan:**  
Memperagakan salah satu transaksi fungsional paling sibuk di panggung terdepan (*Frontend*), borang *Pendaftaran Mahasiswa Baru* meminta jaminan kepastian. *Flowchart* merekam kebebasan pembaca bersiap siaga mencocokkan wejangan pendaftaran sebelum akhirnya menceburkan data kependudukannya semisal NIK dan berkas PDF berlampir ke bilah kosongnya. Titik berat kehandalan sistem dipertontonkan kala tombol registrasi digenjrot. Bila kejanggalan format menaungi *(seperti sel pengisian masih rumpang atau terdeteksi cacat CSRF)*, siklus merendahkan putarannya menolak simpanan serta menandai blok eror guna direkayasa ulang partisipan (*Validasi*). Keluwesan lolos saringan meyakinkan pangkalan mematri identitas terpusat seiring munculnya sapaan selamat sukses berwujud plakat kecil di baris layarnya.

---

### 4.3.7 Activity Diagram Prodi TI (Informatika)

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Prodi Informatika]
    
    A --> B[Membaca Profil dan Visi Misi Prodi]
    B --> C[Menggulir Layar ke Bawah]
    
    C --> D{Ingin Melihat\nFasilitas Belajar?}
    D -- Iya --> E[Melihat Daftar Fasilitas Prodi]
    E --> F{Cek Kompetensi\nLulusan?}
    
    D -- Tidak --> F
    
    F -- Iya --> G[Membaca Daftar Keahlian Lulusan]
    G --> End((( )))
    
    F -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.28** Activity Diagram Prodi TI (Informatika)*

**Penjelasan:**  
Halaman ini menampilkan profil lengkap dari lingkup studi Teknik Informatika. Pengalaman pengujung dimulai dengan menyerap informasi inti seperti Visi dan Misi. Melalui mekanisme *scroll* ke bawah berulang kali, pengguna dihadapkan pada persimpangan opsi sederhana, yaitu memutuskan mengeksplorasi gambar fasilitas pembelajaran, sampai di ujungnya mempertimbangkan untuk menyerap target prospek kelulusannya.

---

### 4.3.8 Activity Diagram Prodi Pendidikan Teknologi Informasi (PTI)

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Prodi Pend. TI]
    
    A --> B[Membaca Tujuan dan Arah Lulusan]
    B --> C[Menggulir Layar ke Bawah]
    
    C --> D{Melihat Mata\nKuliah Unggulan?}
    D -- Iya --> E[Membaca Daftar Mata Kuliah Spesifik]
    E --> F{Mencari Peluang\nKerja?}
    
    D -- Tidak --> F
    
    F -- Iya --> G[Membaca Daftar Peluang Karir Guru/Praktisi]
    G --> End((( )))
    
    F -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.29** Activity Diagram Prodi Pend. TI*

**Penjelasan:**  
Serupa dengan alur program studi sebelumnya, halaman PTI dikemas memaparkan profil kompetensi sarjana pendidikan. Interaksi difokuskan pada pembacaan linier terhadap daftar mata kuliah khusus pendidikan teknologi yang ditawarkan, diakhiri dengan evaluasi pengguna untuk memindai prospek penyerapan kerja alumni.

---

### 4.3.9 Activity Diagram Menu Ruangan Kelas

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Ruangan Kuliah]
    
    A --> B[Melihat Gambar dan Daftar Ruangan]
    B --> C{Mencari Ruangan\nTertentu?}
    
    C -- Iya --> D[Memperhatikan Detail dan Fasilitas di Tiap Kelas]
    D --> End((( )))
    
    C -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.30** Activity Diagram Menu Ruangan Kelas*

**Penjelasan:**  
Aktivitas pencarian ruangan dirancang sangat ringkas. Begitu pengunjung memasuki halaman, rangkaian gambar dan nama kelas disajikan dalam deretan kartu. Pengguna yang memiliki inisiatif lebih dapat memfokuskan bacaannya pada komponen infrastruktur fisik yang melekat di tiap daftar ruangannya.

---

### 4.3.10 Activity Diagram Menu Laboratorium

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Laboratorium]
    
    A --> B[Melihat Daftar Laboratorium Tersedia]
    B --> C[Menggulir Layar ke Bawah]
    
    C --> D{Ingin Mengetahui\nSpesifikasi Komputer?}
    
    D -- Iya --> E[Membaca Daftar Alat dan Kapasitas Lab]
    E --> End((( )))
    
    D -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.31** Activity Diagram Menu Laboratorium*

**Penjelasan:**  
Pengenalan ruang praktek (*Laboratorium*) menekankan penayangan jenis-jenis lab. Jalur pengguna (*User Flow*) mensyaratkan keputusan spesifik bilamana pengunjung berkehendak mengecek spesifikasi piranti alat pendukung yang disediakan untuk praktikum mahasiswa, seperti komputer atau komponen jaringan.

---

### 4.3.11 Activity Diagram Menu Kurikulum

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Kurikulum Akademik]
    
    A --> B[Menampilkan Tabel Distribusi Mata Kuliah]
    B --> C{Mencari Jadwal\nSemester Tertentu?}
    
    C -- Iya --> D[Memilih Tabel Semester Pilihan]
    D --> E[Cek Jumlah SKS dan Prasyarat Mata Kuliah]
    E --> End((( )))
    
    C -- Tidak --> F[Hanya Menggulir Tampilan Tabel]
    F --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.32** Activity Diagram Menu Kurikulum*

**Penjelasan:**  
Halaman ini melayani kebutuhan pemetaan studi. Interaksi mendasar diawali terbukanya susunan besar tabel SKS per semester. Rute pengambilan keputusan mensyaratkan pembaca menukik memperhatikan satu seksi semester agar bisa memilah beban sks apa saja yang akan diambilnya.

---

### 4.3.12 Activity Diagram Menu Kalender Akademik

```mermaid
flowchart TD
    Start(( )) --> A[Membuka Halaman Kalender]
    
    A --> B[Menampilkan Tabel Tanggal Kegiatan Kampus]
    B --> C{Cari Tanggal\nUjian Atau KRS?}
    
    C -- Iya --> D[Membaca dan Mencatat Waktu Penting]
    D --> End((( )))
    
    C -- Tidak --> End
    
    style Start fill:#000,stroke:#000,color:#000
    style End fill:#fff,stroke:#000,stroke-width:2px
```
***Gambar 4.33** Activity Diagram Menu Kalender Akademik*

**Penjelasan:**  
Di muara informasi birokrasional kalender penanggalan, *flowchart* ditutup dengan rutinitas penjelajahan yang paling ringkas. Pengunjung sekadar dihadapkan pada tabel rentetan jadwal, di mana interaksi utamanya adalah membaca datar tabel dan menetapkan batas waktu kritis administrasi pendaftaran secara mandiri.
