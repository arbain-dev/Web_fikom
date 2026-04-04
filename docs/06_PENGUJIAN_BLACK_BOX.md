# BAB IV — Pengujian Black Box (Black Box Testing)

## 4.1 Pengertian Black Box Testing

*Black Box Testing* adalah metode pengujian perangkat lunak yang berfokus pada pengujian fungsionalitas sistem dari sudut pandang pengguna akhir, tanpa memperhatikan struktur internal kode program. Pengujian ini dilakukan dengan cara memberikan masukan (*input*) tertentu kepada sistem dan mengamati apakah keluaran (*output*) yang dihasilkan sesuai dengan yang diharapkan berdasarkan spesifikasi kebutuhan sistem.

Pada pengujian ini, penguji memperlakukan sistem sebagai sebuah "kotak hitam" yang hanya diamati dari sisi luar — yaitu antarmuka dan perilaku sistem — tanpa mengetahui detail implementasi logika di dalamnya. Metode ini efektif untuk memvalidasi apakah setiap fitur sistem telah berjalan sesuai dengan kebutuhan fungsional yang telah ditetapkan.

**Tujuan pengujian Black Box pada sistem Web FIKOM:**
- Memverifikasi bahwa seluruh fitur sistem berfungsi sesuai spesifikasi
- Memastikan sistem menangani masukan valid maupun tidak valid dengan benar
- Mengidentifikasi ketidaksesuaian antara perilaku aktual dan perilaku yang diharapkan

---

## 4.2 Modul Pengujian: Autentikasi Administrator (Login)

Pengujian modul autentikasi mencakup seluruh skenario kemungkinan masukan pada formulir login administrator, termasuk kondisi batas dan kondisi normal.

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Form login dikosongkan | Username: *(kosong)*, Password: *(kosong)* | Muncul pesan validasi "Username/email dan password wajib diisi" | Sesuai dengan yang diharapkan | **Valid** |
| 2 | Username diisi, password dikosongkan | Username: `admin`, Password: *(kosong)* | Muncul pesan validasi "Password wajib diisi" | Sesuai dengan yang diharapkan | **Valid** |
| 3 | Username dikosongkan, password diisi | Username: *(kosong)*, Password: `admin123` | Muncul pesan validasi "Username/email wajib diisi" | Sesuai dengan yang diharapkan | **Valid** |
| 4 | Username tidak terdaftar di sistem | Username: `user_tidak_ada`, Password: `admin123` | Muncul pesan "Username atau Password salah" | Sesuai dengan yang diharapkan | **Valid** |
| 5 | Username benar, password salah | Username: `admin`, Password: `passwordsalah` | Muncul pesan "Username atau Password salah" | Sesuai dengan yang diharapkan | **Valid** |
| 6 | Login menggunakan email yang benar | Username: `admin@fikom.ac.id`, Password: `admin123` | Sistem menerima login dan redirect ke dashboard | Sesuai dengan yang diharapkan | **Valid** |
| 7 | Login dengan kredensial yang benar | Username: `admin`, Password: `admin123` | Berhasil login, redirect ke `/admin/dashboard` | Sesuai dengan yang diharapkan | **Valid** |
| 8 | Mengakses halaman admin tanpa login | Akses langsung URL `/admin/dashboard` | Sistem redirect ke halaman login | Sesuai dengan yang diharapkan | **Valid** |
| 9 | Logout dari sistem | Klik tombol "Logout" | Sesi dihapus, redirect ke halaman login | Sesuai dengan yang diharapkan | **Valid** |

---

## 4.3 Modul Pengujian: Manajemen Data Berita

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 10 | Tambah berita dengan data lengkap | Judul, kategori, tanggal, konten, foto | Data berita tersimpan, muncul di daftar berita | Sesuai dengan yang diharapkan | **Valid** |
| 11 | Tambah berita tanpa judul | Judul: *(kosong)*, field lain diisi | Muncul pesan error "Judul wajib diisi" | Sesuai dengan yang diharapkan | **Valid** |
| 12 | Tambah berita tanpa foto | Judul, kategori, tanggal, konten (tanpa foto) | Data berita tersimpan tanpa foto | Sesuai dengan yang diharapkan | **Valid** |
| 13 | Tambah berita dengan foto berformat tidak valid | Foto: `dokumen.pdf` | Muncul pesan error validasi format file | Sesuai dengan yang diharapkan | **Valid** |
| 14 | Tambah berita dengan foto berukuran > batas | Foto: file > 5MB | Muncul pesan error "Ukuran file melebihi batas" | Sesuai dengan yang diharapkan | **Valid** |
| 15 | Membaca / menampilkan daftar berita | Akses halaman kelola berita | Daftar berita tampil dalam tabel terurut | Sesuai dengan yang diharapkan | **Valid** |
| 16 | Edit berita dengan mengganti judul | Judul diubah ke judul baru | Data berita berhasil diperbarui | Sesuai dengan yang diharapkan | **Valid** |
| 17 | Edit berita dengan mengganti foto | Upload foto baru saat edit | Foto baru tersimpan, foto lama terhapus otomatis | Sesuai dengan yang diharapkan | **Valid** |
| 18 | Hapus berita | Klik hapus pada berita tertentu | Berita terhapus dari daftar dan foto dihapus dari server | Sesuai dengan yang diharapkan | **Valid** |

---

## 4.4 Modul Pengujian: Manajemen Data Dosen

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 19 | Tambah dosen dengan data lengkap | Nama, NIDN, prodi, keahlian, pendidikan, jabatan, status, email, foto | Data dosen tersimpan dan tampil di daftar | Sesuai dengan yang diharapkan | **Valid** |
| 20 | Tambah dosen tanpa nama | Nama: *(kosong)*, field lain diisi | Muncul pesan error "Nama wajib diisi" | Sesuai dengan yang diharapkan | **Valid** |
| 21 | Tambah dosen dengan foto > 2MB | Foto: file > 2MB | Muncul pesan error "Ukuran foto maksimal 2MB" | Sesuai dengan yang diharapkan | **Valid** |
| 22 | Tambah dosen dengan format foto tidak valid | Foto: `file.pdf` | Muncul pesan error validasi format file | Sesuai dengan yang diharapkan | **Valid** |
| 23 | Membaca / menampilkan daftar dosen | Akses halaman kelola dosen | Daftar dosen tampil dengan informasi lengkap | Sesuai dengan yang diharapkan | **Valid** |
| 24 | Edit data dosen | Ubah jabatan dosen | Data dosen berhasil diperbarui | Sesuai dengan yang diharapkan | **Valid** |
| 25 | Hapus data dosen | Klik hapus pada dosen tertentu | Dosen terhapus dari daftar | Sesuai dengan yang diharapkan | **Valid** |

---

## 4.5 Modul Pengujian: Manajemen Penelitian

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 26 | Tambah penelitian dengan data lengkap | Judul, peneliti, tahun, status, skim, nomor SK, sumber dana, file proposal, file laporan | Data penelitian tersimpan | Sesuai dengan yang diharapkan | **Valid** |
| 27 | Tambah penelitian tanpa judul | Judul: *(kosong)* | Muncul pesan error validasi | Sesuai dengan yang diharapkan | **Valid** |
| 28 | Upload file proposal format tidak valid | File: `gambar.jpg` | Muncul pesan error "Format file harus PDF/DOC/DOCX" | Sesuai dengan yang diharapkan | **Valid** |
| 29 | Upload file laporan > 5MB | File laporan > 5MB | Muncul pesan error "Ukuran file melebihi 5MB" | Sesuai dengan yang diharapkan | **Valid** |
| 30 | Membaca daftar penelitian | Akses halaman kelola penelitian | Daftar penelitian tampil terurut berdasarkan tahun | Sesuai dengan yang diharapkan | **Valid** |
| 31 | Edit data penelitian | Ubah status penelitian dari "Draft" ke "Selesai" | Data berhasil diperbarui | Sesuai dengan yang diharapkan | **Valid** |
| 32 | Hapus data penelitian | Klik hapus pada penelitian tertentu | Data terhapus, file terkait dihapus dari server | Sesuai dengan yang diharapkan | **Valid** |

---

## 4.6 Modul Pengujian: Manajemen Pengabdian

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 33 | Tambah pengabdian dengan data lengkap | Judul, pelaksana, deskripsi, tanggal, file PDF | Data pengabdian tersimpan | Sesuai dengan yang diharapkan | **Valid** |
| 34 | Tambah pengabdian tanpa judul | Judul: *(kosong)* | Muncul pesan error validasi | Sesuai dengan yang diharapkan | **Valid** |
| 35 | Tambah pengabdian tanpa file | Semua field diisi, file: *(kosong)* | Data tersimpan tanpa file | Sesuai dengan yang diharapkan | **Valid** |
| 36 | Edit data pengabdian | Ubah tanggal kegiatan | Data berhasil diperbarui | Sesuai dengan yang diharapkan | **Valid** |
| 37 | Hapus data pengabdian | Klik hapus | Data terhapus beserta file terkait | Sesuai dengan yang diharapkan | **Valid** |

---

## 4.7 Modul Pengujian: Manajemen BEM & Kemahasiswaan

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 38 | Tambah anggota BEM dengan data lengkap | Nama, jabatan, prodi, kategori, urutan, foto | Data anggota tersimpan dan tampil sesuai hierarki | Sesuai dengan yang diharapkan | **Valid** |
| 39 | Tambah anggota BEM tanpa foto | Nama, jabatan, kategori (tanpa foto) | Muncul pesan error "Foto wajib diupload" | Sesuai dengan yang diharapkan | **Valid** |
| 40 | Edit data anggota BEM | Ubah jabatan anggota | Data berhasil diperbarui | Sesuai dengan yang diharapkan | **Valid** |
| 41 | Hapus anggota BEM | Klik hapus | Data terhapus beserta foto dari server | Sesuai dengan yang diharapkan | **Valid** |
| 42 | Tambah kalender akademik | Nama kegiatan, deskripsi, tahun akademik, gambar | Data kalender tersimpan | Sesuai dengan yang diharapkan | **Valid** |
| 43 | Edit kalender akademik | Ubah tahun akademik | Data berhasil diperbarui | Sesuai dengan yang diharapkan | **Valid** |
| 44 | Hapus kalender akademik | Klik hapus | Data terhapus beserta gambar dari server | Sesuai dengan yang diharapkan | **Valid** |

---

## 4.8 Modul Pengujian: Pendaftaran Mahasiswa Baru

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 45 | Isi formulir pendaftaran lengkap | Nama, NIK, email, HP, prodi, jalur, alamat, file KTP, file Ijazah | Pendaftaran berhasil, data tersimpan di database | Sesuai dengan yang diharapkan | **Valid** |
| 46 | Kirim formulir dengan field wajib kosong | Nama: *(kosong)*, field lain diisi | Muncul pesan error validasi | Sesuai dengan yang diharapkan | **Valid** |
| 47 | Isi formulir tanpa upload dokumen | Semua field teks diisi, file: *(kosong)* | Data tersimpan tanpa file | Sesuai dengan yang diharapkan | **Valid** |
| 48 | Admin melihat daftar pendaftar | Akses halaman kelola pendaftaran | Seluruh data pendaftar tampil dalam tabel | Sesuai dengan yang diharapkan | **Valid** |
| 49 | Admin menghapus data pendaftar | Klik hapus pada data pendaftar | Data terhapus dari sistem | Sesuai dengan yang diharapkan | **Valid** |

---

## 4.9 Modul Pengujian: Konten Profil Fakultas

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 50 | Perbarui konten Tentang FIKOM | Judul baru, deskripsi baru, gambar baru | Konten berhasil diperbarui di halaman publik | Sesuai dengan yang diharapkan | **Valid** |
| 51 | Tambah item Visi/Misi | Kategori: Misi, konten teks, urutan | Item baru tersimpan dan tampil di halaman visi misi | Sesuai dengan yang diharapkan | **Valid** |
| 52 | Edit item Visi/Misi | Ubah konten teks | Data berhasil diperbarui | Sesuai dengan yang diharapkan | **Valid** |
| 53 | Hapus item Visi/Misi | Klik hapus | Item terhapus dari daftar | Sesuai dengan yang diharapkan | **Valid** |
| 54 | Tambah gambar Hero Slider | Upload gambar baru, set status aktif | Gambar slider tersimpan dan tampil di beranda | Sesuai dengan yang diharapkan | **Valid** |
| 55 | Nonaktifkan Hero Slider | Set `is_active = 0` pada slider tertentu | Slider tidak tampil di beranda | Sesuai dengan yang diharapkan | **Valid** |
| 56 | Perbarui gambar halaman statis | Upload gambar struktur organisasi baru | Gambar berhasil diperbarui di halaman publik | Sesuai dengan yang diharapkan | **Valid** |

---

## 4.10 Modul Pengujian: Dokumen Resmi (SOP, Renstra, Renop)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 57 | Unggah dokumen SOP baru | Nama SOP, deskripsi, file PDF | Dokumen tersimpan dan dapat diunduh | Sesuai dengan yang diharapkan | **Valid** |
| 58 | Unggah SOP dengan format tidak valid | File: `gambar.jpg` | Muncul pesan error validasi format file | Sesuai dengan yang diharapkan | **Valid** |
| 59 | Edit nama dokumen SOP | Ubah nama dokumen | Data berhasil diperbarui | Sesuai dengan yang diharapkan | **Valid** |
| 60 | Hapus dokumen SOP | Klik hapus | Dokumen terhapus beserta file PDF dari server | Sesuai dengan yang diharapkan | **Valid** |
| 61 | Unggah dokumen Renstra | Nama dokumen, deskripsi, file PDF | Dokumen tersimpan dan dapat diunduh | Sesuai dengan yang diharapkan | **Valid** |
| 62 | Unggah dokumen Renop | Nama dokumen, deskripsi, file PDF | Dokumen tersimpan dan dapat diunduh | Sesuai dengan yang diharapkan | **Valid** |

---

## 4.11 Modul Pengujian: Akses Halaman Publik Frontend

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 63 | Akses halaman beranda | Buka URL `/` atau `index.php` | Halaman beranda tampil dengan slider, berita, statistik, dan mitra kerjasama | Sesuai dengan yang diharapkan | **Valid** |
| 64 | Akses halaman profil dosen | Buka halaman daftar dosen | Seluruh dosen tampil dengan foto dan informasi | Sesuai dengan yang diharapkan | **Valid** |
| 65 | Akses halaman berita | Buka halaman daftar berita | Daftar berita tampil terurut berdasarkan tanggal | Sesuai dengan yang diharapkan | **Valid** |
| 66 | Akses halaman penelitian | Buka halaman penelitian | Daftar penelitian tampil beserta filter tahun | Sesuai dengan yang diharapkan | **Valid** |
| 67 | Akses halaman pendaftaran | Buka halaman pendaftaran online | Formulir pendaftaran tampil dengan lengkap | Sesuai dengan yang diharapkan | **Valid** |
| 68 | Akses halaman visi & misi | Buka halaman visi misi | Konten visi, misi, tujuan, dan sasaran tampil | Sesuai dengan yang diharapkan | **Valid** |
| 69 | Akses halaman struktur organisasi | Buka halaman struktur | Gambar struktur organisasi tampil | Sesuai dengan yang diharapkan | **Valid** |
| 70 | Akses halaman dengan URL tidak valid | Akses URL halaman yang tidak ada | Sistem menampilkan halaman 404 | Sesuai dengan yang diharapkan | **Valid** |

---

## 4.12 Tabel Kesimpulan Pengujian Black Box

| No | Modul yang Diuji | Jumlah Skenario | Valid | Tidak Valid |
|:--:|:-----------------|:---------------:|:-----:|:-----------:|
| 1 | Autentikasi Administrator (Login) | 9 | 9 | 0 |
| 2 | Manajemen Data Berita | 9 | 9 | 0 |
| 3 | Manajemen Data Dosen | 7 | 7 | 0 |
| 4 | Manajemen Penelitian | 7 | 7 | 0 |
| 5 | Manajemen Pengabdian | 5 | 5 | 0 |
| 6 | Manajemen BEM & Kemahasiswaan | 7 | 7 | 0 |
| 7 | Pendaftaran Mahasiswa Baru | 5 | 5 | 0 |
| 8 | Konten Profil Fakultas | 7 | 7 | 0 |
| 9 | Dokumen Resmi (SOP, Renstra, Renop) | 6 | 6 | 0 |
| 10 | Akses Halaman Publik Frontend | 8 | 8 | 0 |
| | **TOTAL** | **70** | **70** | **0** |

**Persentase Keberhasilan:** $\frac{70}{70} \times 100\% = \textbf{100\%}$

### Kesimpulan

Berdasarkan hasil pengujian *Black Box Testing* yang telah dilaksanakan terhadap sistem Web FIKOM Universitas Muhammadiyah Sidenreng Rappang (UNISAN), seluruh **70 skenario pengujian** yang mencakup **10 modul fungsional** dinyatakan **Valid**. Hal ini menunjukkan bahwa sistem telah berfungsi sesuai dengan spesifikasi kebutuhan fungsional yang telah ditetapkan. Setiap masukan yang diberikan menghasilkan keluaran yang tepat, baik untuk kondisi normal maupun kondisi batas, sehingga sistem dinyatakan **lulus pengujian fungsionalitas** dan siap untuk digunakan.

---

*Dokumen Pengujian Black Box ini merupakan bagian dari dokumentasi teknis skripsi Website Fakultas Ilmu Komputer Universitas Muhammadiyah Sidenreng Rappang (UNISAN).*
