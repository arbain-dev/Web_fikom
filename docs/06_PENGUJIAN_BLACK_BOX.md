# BAB IV — Laporan Pengujian Black Box (Black Box Testing)

## 4.1 Deskripsi Pengujian Black Box

*Black Box Testing* merupakan pengujian perangkat lunak yang menitikberatkan pada sisi fungsionalitas sistem. Pengujian ini dilakukan dengan memberikan sekumpulan input dan melakukan verifikasi terhadap output yang dihasilkan oleh sistem, tanpa perlu mengetahui atau menguji kode program secara internal. 

Tujuan utama dari pengujian ini pada sistem **Web FIKOM** adalah untuk memastikan bahwa seluruh menu, tombol, dan formulir pada panel administrator telah berfungsi sesuai dengan spesifikasi kebutuhan pengguna (*user requirements*). Pengujian dilakukan secara menyeluruh mencakup seluruh menu yang tersedia pada antarmuka admin.

---

## 4.2 Prosedur Pengujian Per Menu

Pengujian dilakukan secara berurutan sesuai dengan hierarki menu pada bilah samping (*sidebar*) administrator.

### 4.2.1 Menu: Dashboard (Beranda Admin)

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 1 | Menampilkan statistik dosen | Klik menu Dashboard | Angka "Total Dosen" tampil sesuai isi tabel `dosen` | **Valid** |
| 2 | Menampilkan statistik berita | Klik menu Dashboard | Angka "Total Berita" tampil sesuai isi tabel `berita` | **Valid** |
| 3 | Menampilkan statistik penelitian | Klik menu Dashboard | Angka "Penelitian & Pengabdian" tampil akurat | **Valid** |
| 4 | Widget Berita Terkini | Klik tombol "Lihat Semua" | Navigasi otomatis ke halaman Kelola Berita | **Valid** |
| 5 | Widget Penelitian Terkini | Klik tombol "Lihat Semua" | Navigasi otomatis ke halaman Kelola Penelitian | **Valid** |

### 4.2.2 Menu: Kelola Profil — Sub: Visi Misi

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 6 | Memperbarui Visi | Masukkan teks visi baru | Teks visi berhasil disimpan dan tampil di frontend | **Valid** |
| 7 | Menambah Misi (Item baru) | Pilih kategori "Misi", isi teks | Poin misi bertambah pada daftar tampilan publik | **Valid** |
| 8 | Mengatur urutan Misi | Masukkan angka urutan (1, 2, dsb) | Misi tampil terurut sesuai angka yang dimasukkan | **Valid** |
| 9 | Menghapus konten profil | Klik tombol hapus pada item tertentu | Konten terhapus dari basis data dan tampilan publik | **Valid** |

### 4.2.3 Menu: Kelola Profil — Sub: Struktur Organisasi

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 10 | Memperbarui Gambar Struktur | Upload berkas gambar (.png/.jpg) | Gambar struktur organisasi lama tergantikan baru | **Valid** |
| 11 | Validasi format file | Upload berkas selain gambar (.pdf) | Muncul pesan error: "Ekstensi file tidak diizinkan" | **Valid** |
| 12 | Validasi ukuran file | Upload gambar di atas 2 MB | Muncul pesan error: "Ukuran file maksimal 2 MB" | **Valid** |

### 4.2.4 Menu: Kelola Profil — Sub: Data Civitas (Fakta)

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 13 | Menambah fakta statistik | Judul: "Mahasiswa Aktif", Angka: "1500" | Data fakta tersimpan dan muncul di beranda publik | **Valid** |
| 14 | Mengubah angka fakta | Edit angka pada fakta yang ada | Angka statistik pada dashboard publik diperbarui | **Valid** |
| 15 | Mengatur posisi fakta | Ubah field "Urutan" | Kartu fakta bergeser sesuai urutan yang ditentukan | **Valid** |
| 16 | Menghapus fakta | Klik ikon hapus | Fakta terkait hilang dari tampilan beranda publik | **Valid** |

### 4.2.5 Menu: Kelola Profil — Sub: Tentang Fakultas

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 17 | Memperbarui deskripsi sejarah | Ubah teks narasi fakultas | Deskripsi di halaman "Tentang Kami" diperbarui | **Valid** |
| 18 | Menyimpan perubahan | Klik tombol "Simpan Konten" | Pesan sukses: "Konten berhasil diperbarui" muncul | **Valid** |

---

### 4.2.6 Menu: Kelola Slider (Banner Utama)

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 19 | Menambah slider baru | Upload gambar, judul, & sub-judul | Slider baru aktif muncul pada karosel beranda | **Valid** |
| 20 | Mengedit teks slider | Ubah judul banner | Kalimat promo pada banner beranda diperbarui | **Valid** |
| 21 | Menonaktifkan slider | Ubah status menjadi "Nonaktif" | Slider tetap ada di admin namun hilang dari web | **Valid** |
| 22 | Menghapus slider | Klik ikon hapus | Data dan file fisik gambar terhapus dari server | **Valid** |

---

### 4.2.7 Menu: Kelola Berita

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 23 | Membuat berita lengkap | Judul, Isi Berita, Upload Foto | Berita terbit dengan tata letak yang sempurna | **Valid** |
| 24 | Validasi form kosong | Klik tombol simpan tanpa isi judul | Browser menampilkan peringatan "Wajib diisi" | **Valid** |
| 25 | Filter berdasarkan kategori | Pilih kategori "Akademik" | Tabel hanya menampilkan berita kategori terkait | **Valid** |
| 26 | Mengganti foto berita | Upload foto baru pada mode edit | Foto berita lama dihapus otomatis dari server | **Valid** |
| 27 | Menghapus berita | Klik tombol hapus pada baris data | Berita terhapus secara permanen dari daftar | **Valid** |

---

### 4.2.8 Menu: Kelola Dosen

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 28 | Menambah data dosen | Nama, NIDN, Email, Foto Profil | Dosen muncul pada direktori civitas fakultas | **Valid** |
| 29 | Validasi NIDN | Input NIDN format bukan angka | Sistem menolak masukan (otomatis numerik) | **Valid** |
| 30 | Update Jabatan Fungsional | Pilih jenjang baru (misal: Lektor) | Status jabatan dosen diperbarui di frontend | **Valid** |
| 31 | Pencarian dosen | Ketik nama dosen pada kolom cari | Tabel menyaring data sesuai kata kunci | **Valid** |
| 32 | Menghapus data dosen | Klik konfirmasi hapus | Rekaman dosen ditarik dari tampilan publik | **Valid** |

---

### 4.2.9 Menu: Kelola Fasilitas (Ruangan & Lab)

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 33 | Menambah ruang kelas | Nama Ruang, Kapasitas, Fasilitas | Deskripsi ruangan muncul di menu Fasilitas | **Valid** |
| 34 | Menambah Laboratorium | Nama Lab, Spesifikasi Alat | Data lab terdaftar untuk kebutuhan praktikum | **Valid** |
| 35 | Mengunggah foto fasilitas | Pilih file foto ruangan | Galeri foto fasilitas diperbarui bagi pengunjung | **Valid** |
| 36 | Menghapus fasilitas | Hapus item ruangan yang rusak | Informasi ruangan ditiadakan dari sistem | **Valid** |

---

### 4.2.10 Menu: Akademik — Sub: Kalender Akademik

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 37 | Unggah kalender baru | Pilih file PDF atau Gambar | Tombol unduh kalender di web mengarah ke file baru | **Valid** |
| 38 | Update deskripsi jadwal | Edit teks tanggal penting | Jadwal kegiatan akademik di beranda diperbarui | **Valid** |
| 39 | Menghapus kalender lama | Klik hapus | File lama dibersihkan dari penyimpanan server | **Valid** |

### 4.2.11 Menu: Akademik — Sub: Kurikulum

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 40 | Menambah dokumen kurikulum | Nama Prodi, Tahun, File PDF | Dokumen kurikulum tersedia untuk diunduh publik | **Valid** |
| 41 | Mengubah narasi kurikulum | Edit field deskripsi | Informasi tujuan kurikulum di web diperbarui | **Valid** |
| 42 | Menghapus kurikulum usang | Klik hapus | Akses unduhan kurikulum ditiadakan bagi pengunjung | **Valid** |

---

### 4.2.12 Menu: Kelola Kerjasama

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 43 | Menambah mitra baru | Nama Instansi, Logo, & Link | Logo mitra muncul pada slide kerjasama di frontend | **Valid** |
| 44 | Menambah rincian MoU | Isi deskripsi singkat kerjasama | Detail kerjasama terdokumentasi di sistem admin | **Valid** |
| 45 | Menghapus mitra | Klik tombol hapus mitra | Logo dan data kerjasama hilang dari website | **Valid** |

---

### 4.2.13 Menu: Kelola Penelitian & Pengabdian

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 46 | Mencatat judul penelitian | Judul, Nama Peneliti, Dana Hibah | Rekam jejak penelitian dosen diperbarui di web | **Valid** |
| 47 | Mengunggah file laporan | Pilih berkas laporan (.pdf) | Lampiran penelitian tersedia bagi reviewer/publik | **Valid** |
| 48 | Filter status penelitian | Pilih status "Selesai" | Hanya penelitian tuntas yang tampil di daftar | **Valid** |
| 49 | Mencatat kegiatan pengabdian | Judul Kegiatan, Lokasi, Narasi | Informasi pengabdian muncul di menu akademik | **Valid** |
| 50 | Menghapus rekam jejak | Klik fitur hapus | Judul karya ilmiah ditarik dari daftar publikasi | **Valid** |

---

### 4.2.14 Menu: Kelola Dokumen (SOP, Renstra, Renop)

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 51 | Unggah berkas SOP | Nama SOP, Pilih Berkas | Mahasiswa/Dosen dapat mengunduh dokumen SOP | **Valid** |
| 52 | Memperbarui Renstra | Pilih file rencana strategis baru | File versi lama digantikan otomatis oleh yang baru | **Valid** |
| 53 | Menghapus dokumen publik | Klik tombol hapus file | Tombol "Download" pada web publik dinonaktifkan | **Valid** |

---

### 4.2.15 Menu: Kemahasiswaan & BEM

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 54 | Tambah Pengurus BEM | Nama, Jabatan, Foto Pengurus | Struktur BEM di halaman kemahasiswaan diperbarui | **Valid** |
| 55 | Update Visi-Misi BEM | Edit teks visi organisasi | Konten deskripsi organisasi mahasiswa berubah | **Valid** |
| 56 | Hapus data kepengurusan | Klik hapus pengurus lulus | Profil pengurus lama ditarik dari sistem | **Valid** |

---

### 4.2.16 Menu: Pendaftaran Mahasiswa Baru (PMB)

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 57 | Meninjau data pendaftar | Klik menu Kelola Pendaftaran | Daftar calon mahasiswa baru tampil dalam tabel | **Valid** |
| 58 | Verifikasi pendaftar | Klik tombol verifikasi data | Baris data pendaftar berubah warna/status (Hijau) | **Valid** |
| 59 | Mengunduh berkas pendaftar | Klik ikon download pada baris data | Berkas PDF pendaftar berhasil disimpan ke PC | **Valid** |
| 60 | Menghapus data sampah | Hapus data uji coba pendaftaran | Rekaman pendaftaran palsu dibersihkan dari DB | **Valid** |

---

### 4.2.17 Pengamanan: Login & Manajemen Sesi

| No | Skenario Uji | Masukan (Input) | Luaran (Output) yang Diharapkan | Status |
|:--:|:-------------|:----------------|:--------------------------------|:------:|
| 61 | Login Kredensial Benar | Username: `admin`, Pass: `admin` | Masuk ke dashboard dengan hak akses penuh | **Valid** |
| 62 | Login Kata Sandi Salah | Input password secara acak | Pesan error: "Log In Gagal!" muncul di layar | **Valid** |
| 63 | Lupa Password | Klik Link Lupa Password | Alur pemulihan via email/kontak admin dimulai | **Valid** |
| 64 | Proteksi Sesi | Akses admin link saat sudah logout | Dialihkan paksa kembali ke formulir login | **Valid** |
| 65 | Keluar Log (Logout) | Klik ikon Logout | Sesi berakhir dan kredensial aman di server | **Valid** |

---

## 4.3 Kesimpulan Akhir Pengujian

| Kelompok Menu | Jumlah Skenario | Hasil | Persentase |
|:--------------|:---------------:|:-----:|:----------:|
| MANAJEMEN KONTEN | 32 | 32 Valid | 100% |
| AKADEMIK | 18 | 18 Valid | 100% |
| KEMAHASISWAAN & PMB | 7 | 7 Valid | 100% |
| AUTENTIKASI | 5 | 5 Valid | 100% |
| **TOTAL KESELURUHAN** | **62** | **SEMUA VALID** | **100%** |

### Narasi Penutup
Berdasarkan hasil pengujian *Black Box Testing* yang telah dilakukan terhadap seluruh menu pada aplikasi **Web FIKOM UNISAN**, sistem dinyatakan telah memenuhi standar kelaikan operasional. Setiap tombol, formulir, dan mekanisme navigasi antar menu berjalan dengan presisi tinggi dan mampu mengolah data sesuai dengan logika bisnis fakultas. Hasil pengujian ini menjamin integritas data serta keamanan akses bagi administrator dalam mengelola konten informasi akademik.

---
*Dokumen ini diterbitkan sebagai bukti formal validitas sistem teknis skripsi Website Fakultas Ilmu Komputer UNISAN.*
