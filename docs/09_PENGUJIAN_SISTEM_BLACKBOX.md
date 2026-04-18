# BAB IX — LAPORAN PENGUJIAN BLACK BOX SETIAP MENU (BLACK BOX TESTING)

## 9.1 Pengantar Black Box Testing
Pengujian *Black Box* merupakan metode pengujian sistem yang berpusat pada pemberian masukan (input) pada antarmuka dan memvalidasi apakah keluaran (output) per-menu sesuai dengan spesifikasi yang diharapkan. Dokumen ini mendemonstrasikan pengujian fungsi detail dari **42 Komponen Menu** yang terbagi rata pada tampilan Publik (Pengunjung) dan modul Dasbor Administrator (Backend).

## 9.2 Pengujian Tampilan Publik (Frontend Pengunjung)

Pada bagian ini, ditekankan pengujian dari perspektif pengguna tamu atau mahasiswa untuk seluruh 21 cabang halaman website.

| No | Modul / Menu Publik | Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:--:|:--------------------|:-------------|:-----------------------|:--------------|:------:|
| 1 | **Beranda** (Home) | Memuat URL basis `/` untuk memastikan elemen utama muncul. | Tampilan termuat sempurna tanpa kerusakan desain (*broken layout*). | **Sesuai dengan yang diharapkan** | **Valid** |
| 2 | **Sambutan Dekan** | Menekan navigasi Dropdown Profil menu "Sambutan Dekan". | Sistem berhasil menampilkan foto Dekan & teks narasi secara penuh. | **Sesuai dengan yang diharapkan** | **Valid** |
| 3 | **Visi & Misi** | Menekan navigasi Dropdown Profil menu "Visi & Misi". | Menampilkan senarai poin-poin visi, misi, dan tujuan fakultas. | **Sesuai dengan yang diharapkan** | **Valid** |
| 4 | **Daftar Dosen** | Menekan navigasi Dropdown Profil menu "Dosen & Tendik". | Grid daftar seluruh nama dosen, jabatan, dan gambar ditayangkan. | **Sesuai dengan yang diharapkan** | **Valid** |
| 5 | **Struktur Organisasi** | Menekan navigasi Profil menu "Struktur Organisasi". | Bagan gambar struktur rektorat/fakultas yang relevan dirender utuh. | **Sesuai dengan yang diharapkan** | **Valid** |
| 6 | **Pendaftaran PMB** | Mengisi dan mengirim form dari Profil menu "Pendaftaran". | Sistem berhasil memvalidasi input wajib registrasi beserta upload ID. | **Sesuai dengan yang diharapkan** | **Valid** |
| 7 | **Kurikulum** | Menekan menu Utama Akademik lalu pilih "Kurikulum". | Sistem merender tabel mata kuliah per semester dengan tombol Unduh. | **Sesuai dengan yang diharapkan** | **Valid** |
| 8 | **Kalender Akademik** | Menekan menu Utama Akademik > "Kalender Akademik". | Informasi jadwal perkuliahan semesteran tercetak rapi ke layar. | **Sesuai dengan yang diharapkan** | **Valid** |
| 9 | **S1 Teknik Informatika** | Menekan Dropdown Program Studi > "S1 Teknik Informatika". | Sistem menampilkan spesifikasi peminatan keahlian S1 TI. | **Sesuai dengan yang diharapkan** | **Valid** |
| 10 | **S1 Pend. Tek. Informasi** | Menekan Dropdown Program Studi > "S1 Pend. Tek. Informasi". | Sistem melampirkan keterangan profil dan prospek lulusan S1 PTI. | **Sesuai dengan yang diharapkan** | **Valid** |
| 11 | **Sarana & Prasarana** | Menekan menu Utama Fasilitas > "Sarana Prasarana". | Galeri prasarana ruangan diklik dan mengorbit pratinjau *Lightbox*. | **Sesuai dengan yang diharapkan** | **Valid** |
| 12 | **Laboratorium** | Menekan menu Utama Fasilitas > "Laboratorium". | Sistem memaparkan spesifikasi Lab beserta daftar Inventarisnya. | **Sesuai dengan yang diharapkan** | **Valid** |
| 13 | **Dokumen Fakultas** | Menekan Navigasi Dokumen > "Dokumen Fakultas". | Tersedia senarai arsip fakultas dengan fungsi unduh (.pdf) wajar. | **Sesuai dengan yang diharapkan** | **Valid** |
| 14 | **Renstra** | Menekan Navigasi Dokumen > "Rencana Strategis". | Tampilan tabel antarmuka bisa di-klik yang memancing *download PDF*. | **Sesuai dengan yang diharapkan** | **Valid** |
| 15 | **Renop** | Menekan Navigasi Dokumen > "Rencana Operasional". | PDF Dokumen Operasional tercatat logis tanpa gagal tautan (*404*). | **Sesuai dengan yang diharapkan** | **Valid** |
| 16 | **Standar Operasional** | Menekan Navigasi Dokumen > "Standar Operasional (SOP)". | Tabel matriks daftar SOP beserta fungsional pengunduhannya sukses. | **Sesuai dengan yang diharapkan** | **Valid** |
| 17 | **Penelitian Dosen** | Menekan Navigasi Riset > "Penelitian". | Matriks karya publikasi beserta tautan sitasi diarahkan transparan. | **Sesuai dengan yang diharapkan** | **Valid** |
| 18 | **Pengabdian Masyarakat** | Menekan Navigasi Riset > "Pengabdian". | Senarai pelaksanaan kegiatan kemasyarakatan (PKM) tampak stabil. | **Sesuai dengan yang diharapkan** | **Valid** |
| 19 | **Organisasi BEM** | Menekan Navigasi Kemahasiswaan > "BEM". | Deskripsi profil BEM beserta bagan kabinet tertata pada layout resolusi. | **Sesuai dengan yang diharapkan** | **Valid** |
| 20 | **UKM & HMPS** | Menekan Navigasi Kemahasiswaan > "Himpunan / UKM". | Logo komunitas Unit Kegiatan Mahasiswa (UKM) terdistribusi dinamis. | **Sesuai dengan yang diharapkan** | **Valid** |
| 21 | **Berita Publikasi** | Klik pada Header Menu "Berita" & Klik "Baca Selengkapnya". | *Thumbnail*, parameter tanggal, penulis, dan narasi dimuat rinci. | **Sesuai dengan yang diharapkan** | **Valid** |

## 9.3 Pengujian Tampilan Administrator (Dasbor Backend)

Pengujian fungsi internal CRUD (Create, Read, Update, Delete) pada 21 menu operasional Administrator guna memastikan validitas pangkalan entri.

| No | Modul / Menu Administrator | Skenario Uji (Action) | Output yang Diharapkan | Output Aktual | Status |
|:--:|:---------------------------|:----------------------|:-----------------------|:--------------|:------:|
| 22 | **Otentikasi (Login Admin)** | Uji *submit* username & pass untuk masuk Dasbor. | Akses ditolak jika cacat kredensial; diizinkan Dasbor bila benar. | **Sesuai dengan yang diharapkan** | **Valid** |
| 23 | **Ringkasan Dasbor** | Visualisasi metrik nilai di laman `dashboard.php`. | Kartu Total Mahasiswa/Pendaftar/Berita terhitung dari hitungan asli *Database*. | **Sesuai dengan yang diharapkan** | **Valid** |
| 24 | **Kelola Slider Beranda** | Uji *Upload Cover Image* untuk slider. | Foto baru tersimpan di folder `uploads/` dan masuk sirkulasi Slider depan. | **Sesuai dengan yang diharapkan** | **Valid** |
| 25 | **Kelola Sambutan Fakultas** | Uji pembaruan paragraf dekan di `kelola_tentangfak.php`. | Manipulasi teks ter-replikasi di tampilan pengunjung secara seketika. | **Sesuai dengan yang diharapkan** | **Valid** |
| 26 | **Kelola Fakta Institusi** | Uji Manajemen Tambah Angka di `kelola_fakta.php`. | Kombinasi kolom nominal masuk dan dirender tanpa ketimpangan angka basis. | **Sesuai dengan yang diharapkan** | **Valid** |
| 27 | **Kelola Visi Misi** | Uji Rubah Teks List pada `kelola_visimisi.php`. | Pembaruan poin poin Visi/Misi mencegah anomali (*XSS escaping*) aman disajikan. | **Sesuai dengan yang diharapkan** | **Valid** |
| 28 | **Kelola Struktur Organisasi** | Uji Timpa Bagan Gambar pada `kelola_struktur.php`. | File visual struktur organisasi lawas di-*unlink* utuh tatkala bagan baru diserahkan. | **Sesuai dengan yang diharapkan** | **Valid** |
| 29 | **Kelola Profil Dosen** | Uji simpan CRUD Identitas di `kelola_dosen.php`. | Biodata terkirim sempurna & pemecahan ID pemutakhiran terhindar malfungsi komputasi. | **Sesuai dengan yang diharapkan** | **Valid** |
| 30 | **Kelola Registrasi PMB** | Uji Rubah Aksi Status Form Pendaftar PMB. | Admin sanggup meninjau pratinjau lampiran PDF Ijazah masuk; rubah status lancar. | **Sesuai dengan yang diharapkan** | **Valid** |
| 31 | **Kelola Rekam Kurikulum** | Uji Dokumen Silabus pada `kelola_kurikulum.php`. | Pemutakhiran berformat PDF (.pdf) distor stabil mendeskripsikan tabel kuliah prodi. | **Sesuai dengan yang diharapkan** | **Valid** |
| 32 | **Kelola Kalender Akademik** | Uji Tambah agenda harian Terjadwal. | Rekam jejak temporal akademis terkalkulasi mantap menyeberang matriks *Frontend*. | **Sesuai dengan yang diharapkan** | **Valid** |
| 33 | **Kelola Ruangan/Sarpras** | Uji Aset Gambar Ruang Gedung pada `kelola_ruangan.php`. | Kapasitas deskriptif kelas dan aset foto dirantai utuh mengorbit di klien web UI. | **Sesuai dengan yang diharapkan** | **Valid** |
| 34 | **Kelola Fasilitas Laboratorium**| Uji Inventaris Hardware Lab via `kelola_lab.php`. | Pemutusan (*Delete*) item membersihkan relasi row beserta gambar fisikal terkait utuh. | **Sesuai dengan yang diharapkan** | **Valid** |
| 35 | **Kelola Direktori SOP** | Uji Distribusi Repositori SOP via `kelola_sop.php`. | File prosedur operasional dipertahankan dengan opsi *Force PDF DL* pada kolom aksinya. | **Sesuai dengan yang diharapkan** | **Valid** |
| 36 | **Kelola Arsip Renstra** | Uji Manipulasi Dokumen pada `kelola_renstra.php`. | Penghapusan menghancurkan entitas baris tertinggal di lumbung database relasional. | **Sesuai dengan yang diharapkan** | **Valid** |
| 37 | **Kelola Arsip Renop** | Uji Rencana Operasional via form `kelola_renop.php`. | Sinkronisasi perampingan ekstensi arsip yang lawas tak membentrok unggahan PDF teranyar. | **Sesuai dengan yang diharapkan** | **Valid** |
| 38 | **Kelola Indeks Penelitian** | Uji Integrasi Jurnal Karya Ilmiah via matriks administrator. | Pemuatan taut balik/hyperlink ke web riset dosen valid teringeksi bersih tanpa terpenggal. | **Sesuai dengan yang diharapkan** | **Valid** |
| 39 | **Kelola Riwayat Pengabdian** | Uji Catatan Laporan aktivitas PKM `kelola_pengabdian.php`. | Informasi durasi dan letak masyarakat/komunitas tervisualisasi riil ke *grid user* depan. | **Sesuai dengan yang diharapkan** | **Valid** |
| 40 | **Kelola Organisasi BEM/UKM**| Uji Komputasi Tabel di antarmuka `kelola_bem.php`. | Modifikasi input ketua kepengurusan serta *upload image Logo* beradaptasi normal logis. | **Sesuai dengan yang diharapkan** | **Valid** |
| 41 | **Kelola Pemberitaan (Artikel)**| Uji Publikasi teks jurnalistik pada `kelola_berita.php`. | *String* baris panjang *rich-text*, *Cover Image*, dan rekam *timestamps* teregister konsisten. | **Sesuai dengan yang diharapkan** | **Valid** |
| 42 | **Kelola Kerjasama/MOU** | Uji Input MoU relasi mitra eksternal di `kelola_kerjasama.php`. | Entri pangkalan pelaporan kerja sama dicabut / dimutakhirkan mulus di *storage lokal* PHP. | **Sesuai dengan yang diharapkan** | **Valid** |

## 9.4 Kesimpulan Akhir Skala Pengujian Black Box

Berdasarkan paparan eksperimen mendalam terhadap **42 Entitas Modul Menu** (*21 Cabang Sisi Klien Publik* dikombinasikan *21 Konfigurasi Sisi Administrator*), eksekusi pemodelan disimpulkan memegang status fungsional **100% VALID DAN OPTIMAL**. Transmisi pertukaran antara modul komputasi *(Request/Response Lifecycle)* sistem menakar ekspektasi logis *(Logic Tolerance)* dengan matang, menolak injeksi liyan yang memicu malfungsi antarmuka, menon-aktifkan komparasi direktori file haram (selain *.PNG/.JPG/.PDF*), dan secara sukses memegang kendali preservasi fungsional dari peladen sistem informasi akademik ini.
