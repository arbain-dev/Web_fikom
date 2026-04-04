# 🧪 Laporan Pengujian Black Box — Website Fakultas Ilmu Komputer UNISAN

## 6.1 Pengantar Black Box Testing

*Black Box Testing* atau pengujian kotak hitam adalah metode pengujian perangkat lunak yang berfokus pada fungsionalitas aplikasi tanpa perlu mengetahui struktur internal kode programnya. Pengujian ini dilakukan dari sudut pandang pengguna akhir (*end-user*) untuk memastikan bahwa setiap input yang diberikan ke dalam sistem menghasilkan output yang sesuai dengan persyaratan fungsional yang telah ditetapkan.

Fokus utama dari pengujian ini adalah:
1.  **Validasi Fungsi**: Memastikan tombol, form, dan navigasi berfungsi sebagaimana mestinya.
2.  **Kesesuaian Output**: Memastikan data tersimpan, terhapus, atau diperbarui dengan benar di basis data.
3.  **Penanganan Kesalahan**: Memastikan sistem memberikan pesan peringatan yang tepat jika terjadi kesalahan input.

---

## 6.2 Skenario Pengujian Per Menu Admin

### 6.2.1 Modul — Sistem Autentikasi (Login & Logout)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Login dengan field kosong | Klik login tanpa isi username/password | Muncul pesan "Field wajib diisi!" | Sesuai Harapan | **Valid** |
| 2 | Login dengan password salah | Username benar, password acak | Muncul pesan "Username atau Password salah!" | Sesuai Harapan | **Valid** |
| 3 | Login dengan username tidak terdaftar | Username acak, password acak | Muncul pesan "Username atau Password salah!" | Sesuai Harapan | **Valid** |
| 4 | Login sukses (Admin) | Username & Password benar (Role Admin) | Redirect ke Halaman Dashboard Admin | Sesuai Harapan | **Valid** |
| 5 | Logout Sistem | Klik tombol "Keluar" | Sesi dihancurkan, redirect ke form login | Sesuai Harapan | **Valid** |
| 6 | Lupa Kata Sandi | Memasukkan email terdaftar | Link instruksi dikirim ke email | Sesuai Harapan | **Valid** |

### 6.2.2 Modul — Halaman Dashboard

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Menampilkan Statistik | Mengakses menu Dashboard | Angka jumlah Dosen, Berita, & Riset tampil akurat | Sesuai Harapan | **Valid** |
| 2 | Menampilkan Data Terbaru | Melihat tabel aktivitas | Menampilkan 5 data berita & penelitian terbaru | Sesuai Harapan | **Valid** |

### 6.2.3 Modul — Kelola Berita (CRUD)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Tambah Berita (Lengkap) | Isi Judul, Kategori, Konten, & Foto | Data tersimpan, pesan sukses tampil | Sesuai Harapan | **Valid** |
| 2 | Tambah Berita (Tanpa Foto) | Isi Judul, Kategori, Konten saja | Data tersimpan tanpa foto, pesan sukses | Sesuai Harapan | **Valid** |
| 3 | Ubah Data Berita | Mengganti judul atau gambar | Data terupdate, file lama terhapus otomatis | Sesuai Harapan | **Valid** |
| 4 | Hapus Data Berita | Klik tombol hapus & konfirmasi | Rekaman DB & file foto di server terhapus | Sesuai Harapan | **Valid** |
| 5 | Pencarian Berita | Ketik kata kunci di kolom pencarian | Daftar berita memfilter sesuai keyword | Sesuai Harapan | **Valid** |

### 6.2.4 Modul — Kelola Dosen

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Tambah Data Dosen | Isi NIDN, Nama, Prodi, & Foto | Data dosen tersimpan di tabel `dosen` | Sesuai Harapan | **Valid** |
| 2 | Filter Program Studi | Pilih "Informatika" di dropdown filter | Hanya menampilkan dosen prodi Informatika | Sesuai Harapan | **Valid** |
| 3 | Edit Foto Dosen | Upload foto baru | Foto lama diganti dengan foto baru | Sesuai Harapan | **Valid** |
| 4 | Hapus Data Dosen | Konfirmasi hapus | Data terhapus secara permanen | Sesuai Harapan | **Valid** |

### 6.2.5 Modul — Kelola Penelitian & Pengabdian

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Input Data Penelitian | Isi judul & upload file PDF proposal | Data & file proposal tersimpan | Sesuai Harapan | **Valid** |
| 2 | Update Status Selesai | Ubah status ke "Selesai" & upload Laporan | Status berganti, file laporan tersimpan | Sesuai Harapan | **Valid** |
| 3 | Hapus Data Riset | Klik hapus | Data & seluruh file PDF terkait terhapus | Sesuai Harapan | **Valid** |

### 6.2.6 Modul — Kelola Fasilitas (Ruangan & Laboratorium)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Tambah Data Ruangan | Nama ruangan, kapasitas, foto | Data & foto tampil di halaman publik | Sesuai Harapan | **Valid** |
| 2 | Tambah Data Lab | Nama lab, spesifikasi, foto | Data & foto tersimpan dengan benar | Sesuai Harapan | **Valid** |
| 3 | Ubah Spesifikasi Lab | Edit deskripsi fasilitas | Perubahan langsung tercermin di frontend | Sesuai Harapan | **Valid** |

### 6.2.7 Modul — Dokumentasi Resmi (SOP, Renstra, Renop)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Upload Dokumen SOP | Judul SOP & file PDF | Dokumen tersedia untuk didownload publik | Sesuai Harapan | **Valid** |
| 2 | Ganti File Renstra | Upload file PDF baru | Versi dokumen diupdate ke file terbaru | Sesuai Harapan | **Valid** |
| 3 | Hapus Dokumen Renop | Klik hapus | Dokumen hilang dari daftar publik | Sesuai Harapan | **Valid** |

### 6.2.8 Modul — Kelola Profil (Visi Misi & Tentang Fak)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Update Visi Misi | Menyunting poin-poin misi | Teks misi terupdate secara real-time | Sesuai Harapan | **Valid** |
| 2 | Ganti Gambar Gedung | Upload foto baru di "Tentang Fak" | Gambar latar belakang halaman profil berubah | Sesuai Harapan | **Valid** |

### 6.2.9 Modul — Pendaftaran PMB (Public & Admin)

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Submit Form (Public) | Isi form lengkap & upload KTP | Pesan "Pendaftaran Berhasil" tampil | Sesuai Harapan | **Valid** |
| 2 | Cek Data Pendaftar (Admin) | Akses menu 'Kelola Pendaftaran' | Data pendaftar terbaru muncul di urutan atas | Sesuai Harapan | **Valid** |
| 3 | Lihat Detail Pendaftar | Klik ikon mata (detail) | Seluruh info pendaftar tampil dalam modal | Sesuai Harapan | **Valid** |
| 4 | Hapus Data Pendaftar | Klik hapus | Data pendaftar & file KTP/Ijazah terhapus | Sesuai Harapan | **Valid** |

### 6.2.10 Modul — Pengaturan Profil Admin

| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Update Info Profil | Ganti nama atau username | Data akun admin diperbarui | Sesuai Harapan | **Valid** |
| 2 | Ganti Password | Isi pass lama & pass baru | Password di-hash ulang & berhasil diubah | Sesuai Harapan | **Valid** |
| 3 | Ganti Password (Pass Lama Salah) | Password lama tidak cocok | Muncul peringatan "Password lama salah!" | Sesuai Harapan | **Valid** |

---

## 6.3 Tabel Kesimpulan Pengujian Black Box

Berikut adalah rekapitulasi dari seluruh skenario pengujian fungsionalitas sistem yang telah dilakukan:

| Kategori Pengujian | Jumlah Skenario | Skenario Valid | Skenario Tidak Valid | Presentase Keberhasilan |
|:-------------------|:---------------:|:--------------:|:--------------------:|:-----------------------:|
| Autentikasi | 6 | 6 | 0 | 100% |
| Dashboard | 2 | 2 | 0 | 100% |
| Kelola Berita | 5 | 5 | 0 | 100% |
| Kelola Dosen | 4 | 4 | 0 | 100% |
| Kelola Riset | 3 | 3 | 0 | 100% |
| Fasilitas (Ruang/Lab)| 3 | 3 | 0 | 100% |
| Dokumen Resmi | 3 | 3 | 0 | 100% |
| Profil Fakultas | 2 | 2 | 0 | 100% |
| Pendaftaran PMB | 4 | 4 | 0 | 100% |
| Profil Admin | 3 | 3 | 0 | 100% |
| **TOTAL** | **35** | **35** | **0** | **100%** |

**Kesimpulan Akhir:** Berdasarkan hasil pengujian di atas, seluruh fitur utama pada halaman Admin dan halaman Publik Web FIKOM UNISAN telah berjalan dengan baik dan sesuai dengan fungsi yang diharapkan (**Valid**).

---

*Dokumen Laporan Black Box ini merupakan bagian dari dokumentasi teknis skripsi Website Fakultas Ilmu Komputer Universitas Muhammadiyah Sidenreng Rappang (UNISAN).*
