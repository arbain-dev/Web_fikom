# LAPORAN PENGUJIAN BLACK BOX — Website Fakultas Ilmu Komputer UNISAN

## 1. Pendahuluan

### 1.1 Pengertian Black Box Testing

*Black Box Testing* atau pengujian kotak hitam merupakan metode pengujian perangkat lunak yang berfokus pada verifikasi fungsionalitas sistem dari perspektif eksternal tanpa mempertimbangkan atau mengetahui struktur internal kode program. Pengujian ini sepenuhnya didasarkan pada spesifikasi kebutuhan sistem (*software requirements specification*), di mana penguji hanya mengamati respons sistem terhadap input yang diberikan tanpa mengetahui bagaimana sistem memproses input tersebut secara internal. Metode ini juga dikenal sebagai *Behavioral Testing* atau *Functional Testing*.

### 1.2 Teknik yang Digunakan

Pengujian ini menggunakan dua teknik utama:

1. **Equivalence Partitioning** — Membagi domain input menjadi kelas-kelas ekivalen di mana semua nilai dalam satu kelas diasumsikan menghasilkan perilaku sistem yang sama. Teknik ini meminimalisir jumlah kasus uji yang diperlukan sambil memaksimalkan cakupan pengujian.

2. **Boundary Value Analysis (BVA)** — Menguji nilai-nilai pada batas partisi (*boundary values*) karena kesalahan pemrograman paling sering terjadi pada nilai batas (nilai minimum, maksimum, dan nilai tepat di tepi batas). Teknik ini bersifat komplementer terhadap *Equivalence Partitioning*.

### 1.3 Tujuan Pengujian

1. **Verifikasi Fungsionalitas** — Memastikan seluruh fitur sistem bekerja sesuai dengan spesifikasi kebutuhan yang telah ditetapkan.
2. **Validasi Keamanan Input** — Memverifikasi bahwa sistem menolak input tidak valid dan menangani data *edge case* dengan benar tanpa mengalami kegagalan kritis.
3. **Identifikasi Defect** — Menemukan potensi cacat (*bug*) pada antarmuka pengguna dan logika bisnis sebelum sistem digunakan dalam lingkungan produksi.

### 1.4 Lingkup Pengujian

| No | Modul yang Diuji | Deskripsi |
|:--:|:-----------------|:----------|
| 1 | Autentikasi Login Admin | Proses login administrator ke panel admin |
| 2 | Kelola Berita | CRUD artikel dan pengumuman publik |
| 3 | Kelola Dosen | CRUD data dosen beserta upload foto |
| 4 | Kelola Penelitian | CRUD data kegiatan penelitian |
| 5 | Pendaftaran Mahasiswa | Formulir pendaftaran calon mahasiswa |
| 6 | Kelola Visi Misi | Update konten halaman visi dan misi |
| 7 | Upload File Dokumen | Validasi upload file berbagai tipe |
| 8 | Session Management | Perlindungan akses halaman admin |

---

## 2. Hasil Pengujian

### 2.1 Modul: Autentikasi Login Administrator

Modul ini memverifikasi proses autentikasi administrator melalui halaman `admin/login.php` yang mengimplementasikan *Prepared Statement* dan `password_verify()`.

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Login dengan username dan password valid | Username: `admin`, Password: `Admin@123` | Redirect ke `/admin/dashboard`, sesi dibuat | Berhasil redirect ke dashboard | ✅ **Valid** |
| 2 | Login dengan email dan password valid | Email: `admin@fikom.ac.id`, Password: `Admin@123` | Redirect ke `/admin/dashboard` | Berhasil login via email | ✅ **Valid** |
| 3 | Login username benar, password salah | Username: `admin`, Password: `salah123` | Pesan "Username atau Password salah!" | Pesan error ditampilkan, tidak redirect | ✅ **Valid** |
| 4 | Username tidak terdaftar | Username: `hacker`, Password: `test` | Pesan "Username atau Password salah!" | Pesan error generik ditampilkan | ✅ **Valid** |
| 5 | Field username kosong | Username: *(kosong)*, Password: `Admin@123` | Pesan error "Wajib diisi" / form tidak disubmit | Validasi HTML5 required mencegah submit | ✅ **Valid** |
| 6 | Field password kosong | Username: `admin`, Password: *(kosong)* | Pesan error / tidak dapat login | Validasi HTML5 required mencegah submit | ✅ **Valid** |
| 7 | Kedua field kosong | Username: *(kosong)*, Password: *(kosong)* | Form tidak disubmit | Validasi HTML5 mencegah pengiriman | ✅ **Valid** |
| 8 | SQL Injection pada username | Username: `admin' OR '1'='1`, Password: apa saja | Login gagal, tidak ada kebocoran data | Prepared Statement memblokir, login gagal | ✅ **Valid** |
| 9 | Karakter spesial pada password | Username: `admin`, Password: `P@$$w0rd!#%` | Login berhasil (karakter valid) | Login berhasil, semua karakter diproses | ✅ **Valid** |
| 10 | Login setelah sesi sudah ada | Admin sudah login, buka kembali halaman login | Redirect langsung ke dashboard | Sistem deteksi sesi aktif, redirect ke dashboard | ✅ **Valid** |

---

### 2.2 Modul: Kelola Berita (CRUD)

Modul ini memverifikasi pengelolaan artikel berita melalui `admin/kelola_berita.php` termasuk operasi tambah, edit, dan hapus beserta pengelolaan file foto.

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Tambah berita dengan semua field terisi | Judul: "Wisuda FIKOM 2025", Kategori: "Akademik", Tanggal: 2025-06-15, Konten: teks, Foto: wisuda.jpg (1.2MB) | Berita tersimpan, "✓ Berita berhasil ditambahkan!" | Berita muncul di tabel, foto tersimpan di `uploads/berita/` | ✅ **Valid** |
| 2 | Tambah berita tanpa foto (opsional) | Judul: "Pengumuman UTS", Kategori: "Pengumuman", Tanggal: 2025-05-01, tanpa foto | Berita tersimpan tanpa foto | Berita tersimpan, kolom foto NULL di database | ✅ **Valid** |
| 3 | Tambah berita tanpa judul | Judul: *(kosong)*, Kategori: "Informasi", Tanggal: ada | Pesan error "Judul, kategori, dan tanggal wajib diisi!" | Pesan error ditampilkan, data tidak tersimpan | ✅ **Valid** |
| 4 | Tambah berita tanpa kategori | Judul: ada, Kategori: *(tidak dipilih)*, Tanggal: ada | Pesan error validasi muncul | Error: field wajib diisi ditampilkan | ✅ **Valid** |
| 5 | Tambah berita tanpa tanggal | Judul: ada, Kategori: ada, Tanggal: *(kosong)* | Pesan error validasi muncul | Error ditampilkan, operasi dibatalkan | ✅ **Valid** |
| 6 | Edit berita — ubah judul dan konten | ID: 5, Judul baru: "Judul Diperbarui", Konten baru: teks berbeda | Berita diperbarui, "✓ Berita berhasil diperbarui!" | Tabel menampilkan data terbaru | ✅ **Valid** |
| 7 | Edit berita — ganti foto | ID: 5, Foto baru: foto_baru.jpg (800KB) | Foto lama dihapus, foto baru tersimpan | File lama dihapus dari server, foto baru tampil | ✅ **Valid** |
| 8 | Hapus berita dengan foto | ID: 5, ada foto terkait | Berita dihapus dari DB, "✓ Berita berhasil dihapus!", file foto ikut terhapus | Data terhapus dari tabel, file fisik terhapus | ✅ **Valid** |
| 9 | Hapus berita tanpa foto | ID: 9, kolom foto = NULL | Berita dihapus tanpa error file tidak ditemukan | Operasi hapus berhasil, tidak ada error | ✅ **Valid** |
| 10 | Input XSS pada judul berita | Judul: `<script>alert('XSS')</script>` | Script tidak dieksekusi, tersimpan sebagai teks | Ditampilkan sebagai literal string `&lt;script&gt;` | ✅ **Valid** |

---

### 2.3 Modul: Kelola Dosen (CRUD dengan Upload Foto)

Modul ini memverifikasi pengelolaan data dosen melalui `admin/kelola_dosen.php` dengan validasi khusus pada upload foto profil.

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Tambah dosen data lengkap | Nama: "Dr. Ahmad Rifai, S.Kom., M.T.", NIDN: "0001019001", Email: "ahmad@unisan.ac.id", Prodi: "Informatika", Status: "Tetap", Pendidikan: "S3" | Data tersimpan, redirect `?status=tambah_sukses` | Dosen muncul di tabel data | ✅ **Valid** |
| 2 | Tambah dosen tanpa nama | Nama: *(kosong)*, field lain terisi | Pesan error "Semua field bertanda * harus diisi" | Error ditampilkan, data tidak disimpan | ✅ **Valid** |
| 3 | Upload foto format valid (JPEG, 1.5MB) | File: foto_dosen.jpg ukuran 1.5MB | Foto tersimpan, nama file ter-generate otomatis | Foto tersimpan di `uploads/dosen/`, tampil di tabel | ✅ **Valid** |
| 4 | Upload foto melebihi batas ukuran (>2MB) | File: foto_besar.jpg ukuran 3.5MB | Pesan error "Foto tidak valid (Max 2MB, JPG/PNG/WEBP)" | Error ditampilkan, foto tidak tersimpan | ✅ **Valid** |
| 5 | Upload foto format tidak valid (PDF) | File: dokumen.pdf ukuran 500KB | Pesan error format tidak valid | Error ditampilkan, upload ditolak | ✅ **Valid** |
| 6 | Upload foto format valid (PNG, 500KB) | File: foto_png.png ukuran 500KB | Foto tersimpan | Upload berhasil | ✅ **Valid** |
| 7 | Upload foto format valid (WebP, 300KB) | File: foto_webp.webp ukuran 300KB | Foto tersimpan | Upload berhasil | ✅ **Valid** |
| 8 | Edit dosen — ganti foto | NIDN: "0001019001", Foto baru: foto2.jpg | Foto lama dihapus, foto baru tampil | File lama di-unlink, foto baru tersimpan | ✅ **Valid** |
| 9 | Tambah dosen dengan NIDN duplikat | NIDN: "0001019001" (sudah ada) | Error database unique constraint | Error ditangkap, pesan "Gagal memproses database" | ✅ **Valid** |
| 10 | Hapus dosen yang memiliki foto | ID dosen dengan foto | Dosen terhapus dari DB, foto fisik ikut terhapus | Data dan file berhasil dihapus | ✅ **Valid** |
| 11 | Filter dosen berdasarkan prodi | Filter: "Informatika" | Hanya dosen Informatika yang tampil | Tabel terfilter, dosen PTI tidak tampil | ✅ **Valid** |
| 12 | Filter dosen — semua prodi | Filter: *(tidak dipilih)* | Semua dosen tampil | Seluruh dosen dari semua prodi ditampilkan | ✅ **Valid** |

---

### 2.4 Modul: Formulir Pendaftaran Mahasiswa Baru

Modul ini memverifikasi formulir pendaftaran online yang dapat diakses oleh pengunjung publik melalui `pages/pendaftaran.php`.

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Pendaftaran data lengkap dan valid | Nama: "Budi Santoso", NIK: "7372034501010001", Prodi: "Informatika", Jalur: "Reguler", WA: "085234567890" | Konfirmasi "Pendaftaran berhasil diterima" | Data tersimpan di tabel `pendaftaran` | ✅ **Valid** |
| 2 | Pendaftaran tanpa nama | Nama: *(kosong)*, field lain terisi | Error atau form tidak tersubmit | HTML5 `required` mencegah submit | ✅ **Valid** |
| 3 | Pendaftaran tanpa NIK | NIK: *(kosong)*, field lain terisi | Validasi field wajib | HTML5 `required` mencegah submit | ✅ **Valid** |
| 4 | Pendaftaran tanpa program studi | Program Studi: *(tidak dipilih)* | Error field wajib | HTML5 `required` mencegah submit | ✅ **Valid** |
| 5 | Pendaftaran tanpa nomor WhatsApp | No. WhatsApp: *(kosong)* | Validasi field wajib | HTML5 `required` mencegah submit | ✅ **Valid** |
| 6 | Input XSS pada field nama | Nama: `<img src=x onerror=alert(1)>` | Tag HTML dinetralkan, tersimpan sebagai teks | `htmlspecialchars()` mengubah ke `&lt;img&gt;` | ✅ **Valid** |
| 7 | NIK dengan karakter spesial | NIK: "1234-5678-9012-3456" | Tersimpan atau divalidasi format | Data tersimpan, sanitasi menghapus karakter tidak valid | ✅ **Valid** |
| 8 | Nomor WhatsApp format internasional | WA: "+6285234567890" | Tersimpan sebagai string | Data tersimpan dengan awalan `+62` | ✅ **Valid** |
| 9 | Akses data pendaftar sebagai admin | Admin mengakses `admin/kelola_pendaftaran` | Tabel semua pendaftar ditampilkan | Data pendaftar tampil dengan aksi detail dan hapus | ✅ **Valid** |
| 10 | Hapus data pendaftar | Admin hapus ID: 3 | Pendaftar dihapus dari database | Data terhapus, tidak muncul lagi di tabel | ✅ **Valid** |

---

### 2.5 Modul: Kelola Penelitian

Modul ini memverifikasi pengelolaan data penelitian dosen melalui `admin/kelola_penelitian.php`.

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Tambah penelitian lengkap | Judul: "Implementasi CNN untuk Deteksi Wajah", Peneliti: "Dr. Ahmad", Tahun: 2024, Status: "Selesai", Dana: 15000000 | Data tersimpan, konfirmasi ditampilkan | Penelitian muncul di tabel | ✅ **Valid** |
| 2 | Tambah penelitian dengan dokumen PDF (2MB) | File: proposal.pdf ukuran 2MB | Dokumen tersimpan di `uploads/penelitian/` | Upload berhasil, nama file ter-encode | ✅ **Valid** |
| 3 | Upload dokumen melebihi batas 5MB | File: laporan_besar.pdf ukuran 8MB | Error "File size too large" | Upload ditolak, pesan error ditampilkan | ✅ **Valid** |
| 4 | Upload dokumen format gambar (JPG) | File: gambar.jpg untuk field dokumen | Ditolak, hanya PDF/DOC yang diizinkan | Upload ditolak oleh validasi tipe | ✅ **Valid** |
| 5 | Tambah penelitian tanpa judul | Judul: *(kosong)*, field lain ada | Validasi field wajib | Error ditampilkan, data tidak tersimpan | ✅ **Valid** |
| 6 | Edit status penelitian | Status dari "Draft" → "Selesai" | Status berhasil diperbarui | Database diperbarui, tabel menampilkan "Selesai" | ✅ **Valid** |
| 7 | Hapus penelitian dengan dokumen | ID dengan file dokumen terlampir | Data dan file fisik terhapus | Rekaman DB dan file di server terhapus | ✅ **Valid** |
| 8 | Tambah penelitian dengan dana 0 (boundary) | Dana: 0 | Data tersimpan (dana 0 = non-funded) | Tersimpan sebagai 0.00 di kolom DECIMAL | ✅ **Valid** |
| 9 | Tahun penelitian boundary (1900 dan 2099) | Tahun: 1900 / 2099 | Tersimpan jika valid secara format | Data tersimpan sesuai input | ✅ **Valid** |
| 10 | Penelitian tanpa file dokumen | Semua field terisi kecuali dokumen | Penelitian tersimpan, kolom dokumen NULL | Tersimpan tanpa error, dokumen opsional | ✅ **Valid** |

---

### 2.6 Modul: Session Management dan Kontrol Akses

Modul ini memverifikasi mekanisme perlindungan sesi yang menjamin hanya administrator terautentikasi yang dapat mengakses panel admin.

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Akses halaman dashboard tanpa login | URL: `/admin/dashboard` (tanpa sesi) | Redirect HTTP 302 ke `/admin/login` | Langsung dialihkan ke halaman login | ✅ **Valid** |
| 2 | Akses kelola_berita tanpa login | URL: `/admin/kelola_berita` (tanpa sesi) | Redirect ke `/admin/login` | Halaman tidak tampil, redirect ke login | ✅ **Valid** |
| 3 | Manipulasi sesi (`$_SESSION` manual) | Inject sesi via URL atau cookie palsu | Akses ditolak, redirect ke login | Sistem menolak, sesi tidak dapat diinjeksi via URL | ✅ **Valid** |
| 4 | Logout mengakhiri sesi | Admin klik Logout di `admin/logout.php` | Sesi dihancurkan, redirect ke login | `session_destroy()` dieksekusi, sesi terhapus | ✅ **Valid** |
| 5 | Akses setelah logout | Tekan tombol Back setelah logout | Redirect ke login (cache cleared) | HTTP 302 redirect ke login tanpa membuka halaman admin | ✅ **Valid** |
| 6 | Akses halaman admin via HTTP langsung | URL: `/admin/kelola_dosen` diakses tanpa sesi | Redirect ke login | Guard PHP mendeteksi tidak ada sesi, redirect | ✅ **Valid** |
| 7 | Sesi valid mengakses semua halaman admin | Admin login valid, navigasi ke semua menu | Semua halaman admin dapat diakses | Navigasi antar halaman admin berfungsi normal | ✅ **Valid** |

---

## 3. Tabel Kesimpulan Pengujian Black Box

| No | Modul | Total Skenario | ✅ Valid | ❌ Tidak Valid | Persentase Keberhasilan |
|:--:|:------|:--------------:|:-------:|:-------------:|:-----------------------:|
| 1 | Autentikasi Login Admin | 10 | 10 | 0 | **100%** |
| 2 | Kelola Berita (CRUD) | 10 | 10 | 0 | **100%** |
| 3 | Kelola Dosen (CRUD + Upload) | 12 | 12 | 0 | **100%** |
| 4 | Formulir Pendaftaran Mahasiswa | 10 | 10 | 0 | **100%** |
| 5 | Kelola Penelitian | 10 | 10 | 0 | **100%** |
| 6 | Session Management | 7 | 7 | 0 | **100%** |
| **Total** | **Keseluruhan Sistem** | **59** | **59** | **0** | **100%** |

---

## 4. Kesimpulan Pengujian Black Box

Berdasarkan hasil pengujian *Black Box* yang dilaksanakan terhadap 59 skenario uji yang mencakup enam modul fungsional utama, dapat ditarik kesimpulan sebagai berikut:

1. **Fungsionalitas Inti Berjalan Sempurna** — Seluruh operasi CRUD (*Create*, *Read*, *Update*, *Delete*) pada modul berita, dosen, dan penelitian berhasil dieksekusi dengan benar sesuai spesifikasi kebutuhan yang telah ditetapkan, dengan tingkat keberhasilan 100%.

2. **Validasi Input Berfungsi Efektif** — Sistem berhasil menolak seluruh input tidak valid, termasuk field kosong, format file yang tidak diizinkan, dan ukuran file melebihi batas yang ditentukan (`MAX_FILE_SIZE = 5MB`, foto dosen maks 2MB), tanpa menyebabkan kegagalan sistem.

3. **Keamanan Terlindungi** — Pengujian terhadap ancaman *SQL Injection* (melalui *Prepared Statement*) dan *Cross-Site Scripting* (melalui `htmlspecialchars()` dan `sanitize_input()`) membuktikan bahwa sistem mampu menangani serangan tersebut dengan benar tanpa kebocoran data atau eksekusi skrip berbahaya.

4. **Manajemen File Berfungsi Andal** — Mekanisme unggah file, enkoding nama file unik, penghapusan file lama saat edit (*safeDeleteFile()* dengan mekanisme *retry*), dan penghapusan file saat hapus data semuanya berfungsi dengan benar dan konsisten.

5. **Kontrol Akses Berbasis Sesi Aman** — *Session guard* berhasil memblokir seluruh akses tidak sah ke halaman administrator, memastikan hanya pengguna terautentikasi yang dapat mengakses dan memodifikasi data melalui panel admin.

---

*Dokumen Pengujian Black Box ini merupakan bagian dari dokumentasi teknis skripsi Website Fakultas Ilmu Komputer Universitas Muhammadiyah Sidenreng Rappang (UNISAN).*
