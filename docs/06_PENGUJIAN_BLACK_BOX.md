# 🧪 LAPORAN PENGUJIAN BLACK BOX — WEBSITE FIKOM UNISAN

## 4.3.2 Pengujian Black Box

Berikut adalah rincian pengujian *Black Box* untuk memastikan seluruh fungsionalitas sistem berjalan sesuai dengan kebutuhan pengguna, baik pada sisi Administrator maupun Pengguna Publik.

---

### A. Pengujian pada Menu Publik (Frontend)

(Bagian pengujian publik dipertahankan sesuai format sebelumnya)

---

### B. Pengujian pada Menu Administrator (Backend)

Pengujian ini mencakup seluruh fungsionalitas manajemen data yang dapat dioperasikan oleh administrator melalui panel kontrol.

#### 1. Pengujian pada Proses Login & Dashboard

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Login dengan data valid (Admin) | Username dan password Admin diisi benar, role dipilih Admin | Sistem berhasil login dan menampilkan halaman dashboard Admin | Sesuai dengan yang diharapkan | Valid |
| 2 | Menampilkan statistik data | Membuka halaman dashboard | Sistem menampilkan jumlah total Berita dan Dosen secara akurat | Sesuai dengan yang diharapkan | Valid |

#### 2. Pengujian Manajemen Profil (Sub-menu Profil)

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Manajemen Visi Misi | Update teks Visi dan Misi fakultas | Perubahan Visi Misi tersimpan dan tampil di frontend | Sesuai dengan yang diharapkan | Valid |
| 2 | Upload Struktur Orgnisasi | Ganti berkas gambar struktur organisasi | Gambar baru berhasil diunggah dan terupdate | Sesuai dengan yang diharapkan | Valid |
| 3 | Kelola Data Civitas | Tambah jumlah data statistik civitas (fakta) | Angka statistik baru muncul di halaman utama | Sesuai dengan yang diharapkan | Valid |
| 4 | Update Tentang Fakultas | Edit deskripsi profil fakultas | Deskripsi baru tersimpan di database | Sesuai dengan yang diharapkan | Valid |

#### 3. Pengujian Kelola Slider (Banner Utama)

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Tambah Slider Baru | Unggah gambar banner beranda | Banner baru aktif dan tampil di halaman beranda | Sesuai dengan yang diharapkan | Valid |
| 2 | Hapus Slider | Klik tombol hapus pada salah satu banner | Banner terhapus dan tidak tampil lagi di carousell | Sesuai dengan yang diharapkan | Valid |

#### 4. Pengujian Manajemen Berita

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Menambah berita baru | Isi form data berita dan upload foto | Berita baru berhasil diterbitkan | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengedit konten berita | Ubah judul atau isi berita | Perubahan berita berhasil diperbarui | Sesuai dengan yang diharapkan | Valid |
| 3 | Menghapus data berita | Klik ikon hapus pada berita terkait | Data berita dan file gambar terhapus permanen | Sesuai dengan yang diharapkan | Valid |

#### 5. Pengujian Manajemen Dosen

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Tambah Data Dosen | Isi NIDN, Nama, dan upload foto dosen | Data profil dosen terdaftar di sistem | Sesuai dengan yang diharapkan | Valid |
| 2 | Update Profil Dosen | Edit riwayat pendidikan/jabatan dosen | Informasi dosen terupdate di daftar dosen publik | Sesuai dengan yang diharapkan | Valid |
| 3 | Hapus Data Dosen | Klik hapus pada salah satu profil dosen | Akun profil dosen ditiadakan dari sistem | Sesuai dengan yang diharapkan | Valid |

#### 6. Pengujian Kelola Fasilitas (Ruangan & Lab)

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Tambah Data Ruangan | Isi nama dan kapasitas ruangan baru | Daftar ruangan bertambah dan tampil di frontend | Sesuai dengan yang diharapkan | Valid |
| 2 | Tambah Data Laboratorium | Isi profil laboratorium dan alat | Informasi lab baru aktif dan dapat diakses | Sesuai dengan yang diharapkan | Valid |

#### 7. Pengujian Manajemen Akademik (Kurikulum & Kalender)

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Upload Kurikulum | Pilih berkas PDF kurikulum terbaru | File berhasil diunggah dan tersedia untuk diklik | Sesuai dengan yang diharapkan | Valid |
| 2 | Update Kalender Akademik | Tambah agenda akademik fakultas | Agenda baru tampil di tabel kalender frontend | Sesuai dengan yang diharapkan | Valid |

#### 8. Pengujian Manajemen Kemahasiswaan & Kerjasama (BEM & Mitra)

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Kelola Profil BEM | Update data kabinet atau organisasi BEM | Profil BEM terupdate di halaman kemahasiswaan | Sesuai dengan yang diharapkan | Valid |
| 2 | Tambah Mitra Kerjasama | Input nama instansi dan upload logo mitra | Logo kerjasama baru tampil di carousel footer | Sesuai dengan yang diharapkan | Valid |

#### 9. Pengujian Riset (Penelitian & Pengabdian)

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Input Judul Penelitian | Tambah data riset dosen | Judul penelitian dosen terpublikasi di halaman riset | Sesuai dengan yang diharapkan | Valid |
| 2 | Input Pengabdian | Tambah data pengabdian masyarakat | Laporan pengabdian tampil di menu pengabdian | Sesuai dengan yang diharapkan | Valid |

#### 10. Pengujian Manajemen Dokumen (Dokumen Fak, Renstra, SOP)

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Upload Dokumen Fakultas | Unggah berkas PDF dokumen resmi | Dokumen tampil dan dapat diunduh oleh publik | Sesuai dengan yang diharapkan | Valid |
| 2 | Kelola Dokumen SOP | Tambah atau hapus berkas SOP | Repositori SOP fakultas selalu mutakhir | Sesuai dengan yang diharapkan | Valid |

#### 11. Pengujian Manajemen Data Pendaftaran (PMB)

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Melihat Daftar Pendaftar | Membuka menu data PMB | Sistem menampilkan list calon pendaftar dari frontend | Sesuai dengan yang diharapkan | Valid |
| 2 | Detail Data Pendaftar | Melihat rincian file yang diupload pendaftar | Berkas (pas foto, KTP, Ijazah) terpilih dapat ditampilkan | Sesuai dengan yang diharapkan | Valid |

#### 12. Pengujian Pengaturan & Keamanan

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Update Profil Saya | Edit nama atau email administrator | Kredensial administrator berhasil diperbarui | Sesuai dengan yang diharapkan | Valid |
| 2 | Ganti Password | Input password lama dan password baru | Password login admin berhasil diubah secara aman | Sesuai dengan yang diharapkan | Valid |
| 3 | Keluar Dari Sistem | Klik tombol "Keluar" / "Logout" | Sesi admin berakhir dan diarahkan ke form login | Sesuai dengan yang diharapkan | Valid |

---

*Laporan pengujian Black Box ini disusun sebagai bagian dari validitas teknis skripsi Website Fakultas Ilmu Komputer UNISAN Sidenreng Rappang.*
