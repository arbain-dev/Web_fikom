# BAB IV — Pengujian Black Box (Black Box Testing)

## 4.1 Pengertian Black Box Testing

*Black Box Testing* adalah metode pengujian perangkat lunak yang berfokus pada pengujian fungsionalitas sistem dari sudut pandang pengguna akhir, tanpa memperhatikan struktur internal kode program. Pengujian ini dilakukan dengan cara memberikan masukan (*input*) tertentu kepada sistem dan mengamati apakah keluaran (*output*) yang dihasilkan sesuai dengan yang diharapkan berdasarkan spesifikasi kebutuhan sistem.

Pada pengujian ini, penguji memperlakukan sistem sebagai sebuah "kotak hitam" yang hanya diamati dari sisi luar — yaitu antarmuka dan perilaku sistem — tanpa mengetahui detail implementasi logika di dalamnya. Metode ini efektif untuk memvalidasi apakah setiap fitur sistem telah berjalan sesuai dengan kebutuhan fungsional yang telah ditetapkan.

**Tujuan pengujian Black Box pada sistem Web FIKOM:**
- Memverifikasi bahwa seluruh fitur sistem berfungsi sesuai spesifikasi.
- Memastikan sistem menangani masukan valid maupun tidak valid dengan benar.
- Mengidentifikasi ketidaksesuaian antara perilaku aktual dan perilaku yang diharapkan.

---

## 4.2 Modul 1: Autentikasi & Manajemen Akun Administrator

Pengujian ini mencakup proses masuk (*login*), keluar (*logout*), pemulihan kata sandi, dan pengelolaan profil akun administrator.

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Login form kosong | Username: *(kosong)*, Password: *(kosong)* | Pesan error: "Wajib diisi" | Sesuai | **Valid** |
| 2 | Login username salah | Username: `salah`, Password: `admin` | Pesan error: "Log In Gagal" | Sesuai | **Valid** |
| 3 | Login password salah | Username: `admin`, Password: `salah` | Pesan error: "Log In Gagal" | Sesuai | **Valid** |
| 4 | Login sukses | Username: `admin`, Password: `admin` | Redirect ke Dashboard, Nama muncul | Sesuai | **Valid** |
| 5 | Lupa Password (Email ada) | Email: `admin@gmail.com` | Instruksi/Token dikirim | Sesuai | **Valid** |
| 6 | Lupa Password (Email tidak ada) | Email: `acak@gmail.com` | Pesan: "Email tidak ditemukan" | Sesuai | **Valid** |
| 7 | Update Profil Admin | Nama Baru, Email Baru | Data akun diperbarui | Sesuai | **Valid** |
| 8 | Ganti Password Admin | Password Lama, Password Baru | Kata sandi berhasil diperbarui | Sesuai | **Valid** |
| 9 | Logout | Klik Tombol Logout | Sesi dihancurkan, kembali ke Login | Sesuai | **Valid** |
| 10 | Proteksi URL Admin | Akses langsung `/admin/dashboard.php` tanpa login | Redirect paksa ke `login.php` | Sesuai | **Valid** |

---

## 4.3 Modul 2: Dashboard & Widget Interaktif

Pengujian interaksi pada halaman utama panel administrator untuk memantau ringkasan data.

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 11 | Menampilkan Grafik/Statistik | Buka Dashboard | Grafik dan jumlah total data tampil akurat | Sesuai | **Valid** |
| 12 | Widget Berita Terbaru | Klik "Lihat Semua" di Berita | Navigasi ke halaman Kelola Berita | Sesuai | **Valid** |
| 13 | Widget Penelitian Terbaru | Klik "Lihat Semua" di Penelitian | Navigasi ke halaman Kelola Penelitian | Sesuai | **Valid** |
| 14 | Update Counter Statistik | Tambah 1 data dosen baru | Angka "Total Dosen" di dashboard meningkat | Sesuai | **Valid** |

---

## 4.4 Modul 3: Kelola Profil (Visi Misi, Struktur, Civitas, Tentang)

Fokus pada pengelolaan konten statis fakultas yang muncul di halaman profil.

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 15 | Update Visi Misi | Ubah teks Visi dan Misi | Konten diperbarui di halaman profil | Sesuai | **Valid** |
| 16 | Update Struktur Organisasi | Upload Gambar Struktur Baru | Gambar struktur berubah di frontend | Sesuai | **Valid** |
| 17 | Kelola Data Civitas | Masukan angka fakta (Jml Mhs, Dosen, Alumnus) | Angka statistik diperbarui otomatis | Sesuai | **Valid** |
| 18 | Update Tentang Fakultas | Ubah teks deskripsi fakultas | Narasi di halaman Tentang profil berubah | Sesuai | **Valid** |
| 19 | Validasi Gambar Struktur | Upload file teks (.txt) ke Struktur | Penolakan sistem: "Format tidak valid" | Sesuai | **Valid** |

---

## 4.5 Modul 4: Kelola Slider (Banner Utama)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 20 | Tambah Slider Baru | Judul, Deskripsi, Upload Gambar | Slider muncul di beranda utama | Sesuai | **Valid** |
| 21 | Edit Konten Slider | Judul diubah, Gambar tetap | Teks slider diperbarui | Sesuai | **Valid** |
| 22 | Nonaktifkan Slider | Set status: Nonaktif | Slider tidak muncul di beranda | Sesuai | **Valid** |
| 23 | Hapus Slider | Klik tombol Hapus | Data slider dan file gambar terhapus | Sesuai | **Valid** |

---

## 4.6 Modul 5: Manajemen Berita (CRUD & Konten)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 24 | Tambah Berita (Lengkap) | Judul, Konten, Kategori, Foto | Berita terbit di halaman Berita | Sesuai | **Valid** |
| 25 | Tambah Berita (Foto Kosong) | Deskripsi tanpa Lampiran Foto | Berita terbit dengan gambar default/kosong | Sesuai | **Valid** |
| 26 | Edit Judul & Konten Berita | Ubah paragraf isi berita | Perubahan langsung tercermin di web | Sesuai | **Valid** |
| 27 | Hapus Berita | Klik Konfirmasi Hapus | Berita hilang dari daftar dan database | Sesuai | **Valid** |
| 28 | Pencarian Berita | Input kata kunci judul | Menampilkan hasil yang relevan saja | Sesuai | **Valid** |

---

## 4.7 Modul 6: Manajemen Dosen (Biodata & Jabatan)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 29 | Tambah Data Dosen | Nama, NIDN, Pendidikan, Foto | Dosen terdaftar di Civitas Fak. | Sesuai | **Valid** |
| 30 | NIDN Duplikat | Input NIDN yang sudah ada | Sistem menolak: "NIDN sudah terdaftar" | Sesuai | **Valid** |
| 31 | Update Jabatan Dosen | Ubah dari "Lektor" ke "Asisten Ahli" | Data akademik dosen diperbarui | Sesuai | **Valid** |
| 32 | Hapus Data Dosen | Klik Hapus | Akun dosen dinonaktifkan/dihapus | Sesuai | **Valid** |

---

## 4.8 Modul 7: Kelola Fasilitas (Ruangan & Lab)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 33 | Tambah Data Ruangan | Nama Ruang, Kapasitas, Foto | Ruangan muncul di profil fasilitas | Sesuai | **Valid** |
| 34 | Tambah Inventaris Lab | Nama Lab, Alat Utama, Deskripsi | Data lab diperbarui | Sesuai | **Valid** |
| 35 | Edit Spesifikasi Ruangan | Perubahan jumlah kapasitas | Data diperbarui di tabel informasi | Sesuai | **Valid** |
| 36 | Hapus Data Fasilitas | Hapus data Lab | Informasi lab hilang dari website | Sesuai | **Valid** |

---

## 4.9 Modul 8: Akademik (Kurikulum & Kalender)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 37 | Update Kalender Akademik | Upload PDF/Gambar Kalender Baru | File kalender dapat diunduh mahasiswa | Sesuai | **Valid** |
| 38 | Input Mata Kuliah Baru | Kode MK, SKS, Semester | Muncul di buku kurikulum online | Sesuai | **Valid** |
| 39 | Edit Deskripsi Kurikulum | Ubah persyaratan kelulusan | Informasi akademik diperbarui | Sesuai | **Valid** |
| 40 | Hapus Komponen Akademik | Hapus salah satu mata kuliah | Pilihan MK hilang dari daftar | Sesuai | **Valid** |

---

## 4.10 Modul 9: Kelola Kerjasama & Mitra

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 41 | Tambah Logo Instansi Mitra | Nama Mitra, Logo, Link Website | Muncul di footer/halaman kerjasama | Sesuai | **Valid** |
| 42 | Tambah Deskripsi MoU | Nomor Jangka Waktu, Tanggal | Status kontrak kerjasama tersimpan | Sesuai | **Valid** |
| 43 | Hapus Mitra | Hapus kerjasama yang berakhir | Logo mitra hilang dari slide mitra | Sesuai | **Valid** |

---

## 4.11 Modul 10: Akademik - Penelitian & Pengabdian

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 44 | Input Judul Penelitian | Nama Peneliti, Judul, Tahun | Muncul di daftar Jurnal/Penelitian | Sesuai | **Valid** |
| 45 | Upload Laporan Pengabdian | Lampiran Dokumen PDF | Berkas dapat diakses publik/reviewer | Sesuai | **Valid** |
| 46 | Update Status Hibah | Edit dana penelitian | Nilai nominal dana diperbarui | Sesuai | **Valid** |
| 47 | Hapus Rekam Jejak | Klik Hapus Penelitian | Data hilang dari portofolio profil | Sesuai | **Valid** |

---

## 4.12 Modul 11: Kemahasiswaan (BEM & Pendaftaran)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 48 | Kelola Struktur BEM | Nama Ketua, Visi BEM, Foto | Halaman Organisasi Mahasiswa update | Sesuai | **Valid** |
| 49 | Terima Pendaftaran Maba | Klik "Verifikasi" pada pendaftar | Status pendaftar berubah (Terverifikasi) | Sesuai | **Valid** |
| 50 | Tolak Pendaftaran Maba | Masukan Alasan Penolakan | Notifikasi/Status pendaftaran Gagal | Sesuai | **Valid** |
| 51 | Export Data Pendaftar | Klik Tombol Export Excel/PDF | Berkas laporan pendaftar terunduh | Sesuai | **Valid** |

---

## 4.13 Modul 12: Manajemen Dokumen (SOP, Renstra, Renop)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 52 | Unggah SOP Baru | File PDF SOP Akademik | Dokumen tersedia di menu Unduhan | Sesuai | **Valid** |
| 53 | Update Renstra/Renop | Ganti file dokumen lama dengan baru | Link unduhan mengarah ke file baru | Sesuai | **Valid** |
| 54 | Hapus Dokumen | Klik Hapus | Tombol unduh hilang dari frontend | Sesuai | **Valid** |

---

## 4.14 Modul 13: Akses Halaman Publik (Frontend)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 55 | Navigasi Menu Profil | Klik Menu "Sejarah" | Pindah ke halaman Sejarah Fakultas | Sesuai | **Valid** |
| 56 | Buka Detail Berita | Klik Judul Berita | Muncul halaman baca berita lengkap | Sesuai | **Valid** |
| 57 | Cek Responsivitas | Ubah ukuran layar ke Mobile | Tampilan menyesuaikan (Responsive) | Sesuai | **Valid** |
| 58 | Kirim Form Kontak | Nama, Pesan, Submit | Pesan masuk ke Inbox Admin | Sesuai | **Valid** |

---

## 4.15 Tabel Rekapitulasi Kesimpulan

| No | Nama Modul | Jumlah Skenario | Status |
|:--:|:-----------|:---------------:|:------:|
| 1 | Autentikasi & Akun | 10 | **Valid** |
| 2 | Dashboard & Widget | 4 | **Valid** |
| 3 | Kelola Profil Fakultas | 5 | **Valid** |
| 4 | Kelola Slider | 4 | **Valid** |
| 5 | Manajemen Berita | 5 | **Valid** |
| 6 | Manajemen Dosen | 4 | **Valid** |
| 7 | Fasilitas (Ruangan/Lab) | 4 | **Valid** |
| 8 | Akademik (MK & Kalender) | 4 | **Valid** |
| 9 | Kerjasama & Mitra | 3 | **Valid** |
| 10 | Penelitian & Pengabdian | 4 | **Valid** |
| 11 | Kemahasiswaan & BEM | 4 | **Valid** |
| 12 | Manajemen Dokumen | 3 | **Valid** |
| 13 | Akses Halaman Publik | 4 | **Valid** |
| | **TOTAL KESELURUHAN** | **58** | **Valid (100%)** |

### Kesimpulan Akhir
Berdasarkan hasil pengujian fungsionalitas menggunakan metode **Black Box Testing** terhadap aplikasi **Web FIKOM UNISAN**, seluruh fitur yang terdapat pada panel administrasi dan halaman publik telah diuji secara menyeluruh. Hasil pengujian menunjukkan bahwa setiap masukan (*input*) yang diberikan mampu menghasilkan keluaran (*output*) serta perilaku sistem yang sesuai dengan spesifikasi fungsional yang diharapkan. Dengan tingkat keberhasilan **100%**, sistem dinyatakan sangat layak dan stabil untuk diimplementasikan secara penuh.

---
*Dokumen ini merupakan lampiran teknis resmi untuk Website Fakultas Ilmu Komputer UNISAN.*
