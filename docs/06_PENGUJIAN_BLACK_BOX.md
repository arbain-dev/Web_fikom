# 🧪 LAPORAN PENGUJIAN BLACK BOX — WEBSITE FIKOM UNISAN

## 4.3.2 Rincian Pengujian Black Box

Berikut adalah rincian hasil pengujian *Black Box* untuk memastikan setiap menu dan fitur utama pada Website FIKOM UNISAN berjalan sesuai fungsionalitas yang diharapkan.

### A. Modul Otentikasi (Proses Login Administrator)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Menguji form login dengan semua field wajib kosong. | `username = ""` <br> `password = ""` | Sistem menolak proses dan mengarahkan kembali ke halaman login dengan pesan error "Data Kosong". | Sesuai dengan yang diharapkan | Valid |
| 2 | Menguji login dengan username yang belum terdaftar. | `username = "adminX"` <br> `password = "123"` | Sistem menolak login karena perpaduan user/role tidak ditemukan di database. | Sesuai dengan yang diharapkan | Valid |
| 3 | Menguji masuk sistem menggunakan password salah. | `username = "admin"` <br> `password = "salah123"` | Sistem menolak login dan menampilkan pesan peringatan kredensial gagal otentikasi. | Sesuai dengan yang diharapkan | Valid |
| 4 | Menguji percobaan login sah dari seluruh Role. | `username = "admin"` <br> `password = "benar123"` | Sistem menerima login, mengamankan identitas berwujud Session, membiarkan masuk halaman Dasbor. | Sesuai dengan yang diharapkan | Valid |

### B. Modul Registrasi (Proses Pendaftaran Mahasiswa Baru)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 5 | Mengisi form pendaftaran dengan isian kolom wajib kosong. | `nama = ""` <br> `email = "test@uns.ac.id"` | Sistem antarmuka membatalkan proses transmisi rekam jaringan dan mencetak penanda Field Required. | Sesuai dengan yang diharapkan | Valid |
| 6 | Mengunggah berkas pendaftaran melebihi batas ukuran (2MB). | `berkas = "file_3MB.pdf"` | Sistem menolak file dan memberikan informasi pembatasan ukuran unggahan. | Sesuai dengan yang diharapkan | Valid |
| 7 | Mengirim formulir pendaftaran dengan data lengkap dan valid. | `nama = "Nama Lengkap Maba"` <br> `nik = "1234567890"` | Sistem berhasil merekam data calon mahasiswa baru ke database dan memberikan notifikasi sukses. | Sesuai dengan yang diharapkan | Valid |

### C. Modul Profil (Visi Misi)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 8 | Menguji akses halaman Visi dan Misi fakultas. | `Klik Menu Visi & Misi` | Sistem menampilkan informasi poin-poin Visi dan Misi FIKOM UNISAN secara utuh. | Sesuai dengan yang diharapkan | Valid |

### D. Modul Struktur Organisasi

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 9 | Menguji akses halaman Struktur Organisasi. | `Klik Menu Struktur Organisasi` | Sistem menampilkan dokumentasi visual/bagan organisasi manajemen fakultas saat ini. | Sesuai dengan yang diharapkan | Valid |

### E. Modul Data Dosen

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 10 | Menguji akses halaman Daftar Dosen FIKOM. | `Klik Menu Dosen` | Sistem memuat grid profil seluruh dosen aktif lengkap dengan jabatan akademis. | Sesuai dengan yang diharapkan | Valid |

### F. Modul Program Studi (Informatika & PTI)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 11 | Menguji akses halaman S1 Informatika. | `Klik Menu Informatika` | Sistem menampilkan profil kurikulum dan kompetensi lulusan Teknik Informatika. | Sesuai dengan yang diharapkan | Valid |
| 12 | Menguji akses halaman S1 Pendidikan TI. | `Klik Menu Pendidikan TI` | Sistem menampilkan profil dan prospek lulusan Pendidikan Teknologi Informasi. | Sesuai dengan yang diharapkan | Valid |

### G. Modul Fasilitas (Ruangan & Lab)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 13 | Menguji akses halaman Sarana Prasarana. | `Klik Menu Sarana & Prasarana` | Sistem menampilkan galeri foto dan deskripsi ruangan kelas serta aula fakultas. | Sesuai dengan yang diharapkan | Valid |
| 14 | Menguji akses halaman Laboratorium. | `Klik Menu Laboratorium` | Sistem menampilkan spesifikasi alutsista teknologi dan daftar laboratorium aktif. | Sesuai dengan yang diharapkan | Valid |

### H. Modul Akademik (Kurikulum & Kalender)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 15 | Menguji akses dan pengunduhan Kurikulum. | `Klik link Kurikulum` | File kurikulum dalam format PDF berhasil dimuat dan tersedia untuk diunduh. | Sesuai dengan yang diharapkan | Valid |
| 16 | Menguji akses halaman Kalender Akademik. | `Klik Menu Kalender Akademik` | Sistem memuat jadwal agenda perkuliahan dan wisuda tahun akademik berjalan. | Sesuai dengan yang diharapkan | Valid |

### I. Modul Dokumen & Unduhan (Pelayanan Informasi Publik)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 17 | Menguji akses berkas standar operasional (SOP). | `Klik Menu SOP` | Sistem menampilkan direktori berkas SOP resmi yang dikeluarkan pihak fakultas. | Sesuai dengan yang diharapkan | Valid |
| 18 | Menguji akses Dokumen Fakultas (Renop/Renstra). | `Klik Menu Dokumen` | Sistem menampilkan repositori rencana strategis dan rencana operasional fakultas. | Sesuai dengan yang diharapkan | Valid |
| 19 | Menguji fungsi tombol unduh file PDF. | `Klik tombol Download` | Berkas digital berhasil ditransmisikan dan tersimpan ke perangkat lokal pengguna (Client). | Sesuai dengan yang diharapkan | Valid |

### J. Modul Riset & Kemahasiswaan

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 20 | Menguji akses halaman Penelitian Dosen. | `Klik Menu Penelitian` | Sistem menampilkan rekam jejak judul publikasi ilmiah dosen FIKOM. | Sesuai dengan yang diharapkan | Valid |
| 21 | Menguji akses halaman Organisasi (BEM/HMPS). | `Klik Menu Kemahasiswaan` | Sistem menampilkan profil organisasi mahasiswa resmi yang bernaung di bawah fakultas. | Sesuai dengan yang diharapkan | Valid |

---

*Laporan pengujian Black Box per modul ini disusun guna memastikan standar kualitas antarmuka dan fungsionalitas Website FIKOM UNISAN.*
