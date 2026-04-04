# 🧪 Laporan Pengujian Black Box — Website Fakultas Ilmu Komputer UNISAN

## 6.1 Pengantar Black Box Testing

*Black Box Testing* adalah cara menguji aplikasi dengan melihat fungsinya saja. Kita tidak perlu tahu isi kode programnya, yang penting kita cek apakah input yang dimasukkan menghasilkan output yang benar sesuai keinginan pengguna.

Tujuan utama pengujian ini:
1.  **Cek Fungsi**: Memastikan tombol, form, dan menu bekerja dengan benar.
2.  **Cek Data**: Memastikan data bisa disimpan, diubah, atau dihapus dari database.
3.  **Cek Pesan Error**: Memastikan muncul peringatan yang jelas jika ada salah input.

---

## 6.2 Skenario Pengujian Unit Menu Admin

### 6.2.1 Menu — Dashboard
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Tampil Statistik | Buka Dashboard | Angka Dosen & Berita muncul | **Valid** |
| 2 | Tampil Data Terbaru| Lihat tabel | Muncul 5 data terbaru | **Valid** |

### 6.2.2 Submenu — Visi Misi
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Ubah Visi Misi | Edit teks & Simpan | Teks visi misi berubah | **Valid** |
| 2 | Urutan Data | Ganti angka urutan | Posisi tampilan berubah | **Valid** |

### 6.2.3 Submenu — Struktur Organisasi
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Upload Gambar | Pilih file & Simpan | Gambar struktur terupdate | **Valid** |
| 2 | Hapus Gambar | Klik tombol hapus | Gambar struktur kosong | **Valid** |

### 6.2.4 Submenu — Data Civitas (Fakta)
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Tambah Data | Isi nama & angka | Angka statistik bertambah | **Valid** |
| 2 | Hapus Data | Klik ikon hapus | Data fakta hilang dari list | **Valid** |

### 6.2.5 Submenu — Tentang Fakultas
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Edit Deskripsi | Ubah teks profil | Deskripsi fakultas terupdate | **Valid** |
| 2 | Ganti Foto | Upload foto baru | Foto gedung fakultas berubah | **Valid** |

### 6.2.6 Menu — Kelola Slider
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Tambah Slider | Upload foto slider | Slide baru muncul di home | **Valid** |
| 2 | Hapus Slider | Klik hapus | Gambar slider hilang | **Valid** |

### 6.2.7 Submenu — Semua Berita
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Tambah Berita | Form berita & Foto | Berita baru terbit di web | **Valid** |
| 2 | Edit Berita | Ubah judul/isi | Konten berita diperbarui | **Valid** |
| 3 | Hapus Berita | Konfirmasi hapus | Berita & foto terhapus | **Valid** |

### 6.2.8 Submenu — Daftar Dosen
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Tambah Dosen | Isi NIDN & Nama | Dosen baru terdaftar di DB | **Valid** |
| 2 | Filter Prodi | Pilih prodi | Muncul dosen prodi terpilih | **Valid** |

### 6.2.9 Submenu — Ruangan
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Tambah Ruangan | Nama & Kapasitas | Ruangan baru tersimpan | **Valid** |
| 2 | Hapus Ruangan | Klik hapus | Ruangan ditiadakan | **Valid** |

### 6.2.10 Submenu — Laboratorium
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Tambah Lab | Nama & Fasilitas | Lab baru muncul di daftar | **Valid** |
| 2 | Edit Lab | Ubah deskripsi | Spesifikasi lab terupdate | **Valid** |

### 6.2.11 Submenu — Kurikulum
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Upload Kurikulum | File PDF kurikulum | File tersedia untuk didownload | **Valid** |
| 2 | Ganti File | Upload PDF baru | File lama terganti otomatis | **Valid** |

### 6.2.12 Submenu — Kalender
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Input Jadwal | Nama kegiatan & Tgl | Terjadwal di kalender akademik | **Valid** |
| 2 | Hapus Jadwal | Klik delete | Kegiatan akademik dihapus | **Valid** |

### 6.2.13 Submenu — BEM
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Update Kabinet | Nama kabinet & Visi | Profil BEM terupdate | **Valid** |
| 2 | Pengurus BEM | Tambah anggota | Daftar pengurus bertambah | **Valid** |

### 6.2.14 Submenu — Kerjasama
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Tambah Mitra | Logo & Nama Mitra | Logo mitra tampil di carousel | **Valid** |
| 2 | Hapus Mitra | Klik hapus | Data kerjasama ditiadakan | **Valid** |

### 6.2.15 Submenu — Penelitian
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Input Penelitian | Judul & Peneliti | Data penelitian tersimpan | **Valid** |
| 2 | Upload Laporan | File PDF laporan | Laporan akhir riset diunggah | **Valid** |

### 6.2.16 Submenu — Pengabdian
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Tambah Kegiatan | Judul & Deskripsi | Data pengabdian tersimpan | **Valid** |
| 2 | Hapus Pengabdian | Klik hapus | Data & file PDF terhapus | **Valid** |

### 6.2.17 Submenu — Rencana Operasional (Renop)
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Upload Renop | Dokumen PDF Renop | Renop tampil di halaman publik | **Valid** |
| 2 | Hapus Dokumen | Klik hapus | File dokumen dihapus permanen | **Valid** |

### 6.2.18 Submenu — Rencana Strategis (Renstra)
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Tambah Renstra | Judul & File PDF | Dokumen Renstra tersimpan | **Valid** |
| 2 | Update Metadata | Ganti judul dokumen | Nama dokumen terupdate | **Valid** |

### 6.2.19 Submenu — SOP
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Upload SOP Baru | Judul & PDF | Repositori SOP bertambah | **Valid** |
| 2 | Hapus SOP | Klik hapus | Dokumen SOP ditiadakan | **Valid** |

### 6.2.20 Menu — Data Pendaftaran
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Tampil Pendaftar | Buka Menu | Daftar calon mahasiswa muncul | **Valid** |
| 2 | Detail Pendaftaran| Klik detail | Data lengkap pendaftar tampil | **Valid** |
| 3 | Hapus Pendaftar | Klik Konfirmasi | Data & berkas KTP terhapus | **Valid** |

### 6.2.21 Menu — Pengaturan (Profile)
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Ubah Profil | Ganti nama/email | Info profil admin terupdate | **Valid** |
| 2 | Ganti Password | Masukkan pass baru | Kredensial login berubah | **Valid** |

### 6.2.22 Keamanan — Logout
| No | Skenario Uji | Input | Output yang Diharapkan | Status |
|:--:|:-------------|:------|:-----------------------|:------:|
| 1 | Logout | Klik Keluar | Sesi berakhir & balik ke Login | **Valid** |

---

## 6.3 Tabel Kesimpulan Pengujian Black Box

Berikut adalah rekapitulasi dari seluruh skenario pengujian fungsionalitas sistem:

| No | Modul / Menu yang Diuji | Status |
|:--:|:------------------------|:------:|
| 1 | Dashboard | **Valid** |
| 2 | Visi Misi | **Valid** |
| 3 | Struktur Organisasi | **Valid** |
| 4 | Data Civitas (Fakta) | **Valid** |
| 5 | Tentang Fakultas | **Valid** |
| 6 | Kelola Slider | **Valid** |
| 7 | Semua Berita | **Valid** |
| 8 | Daftar Dosen | **Valid** |
| 9 | Ruangan | **Valid** |
| 10 | Laboratorium | **Valid** |
| 11 | Kurikulum | **Valid** |
| 12 | Kalender | **Valid** |
| 13 | BEM | **Valid** |
| 14 | Kerjasama | **Valid** |
| 15 | Penelitian | **Valid** |
| 16 | Pengabdian | **Valid** |
| 17 | Rencana Operasional | **Valid** |
| 18 | Rencana Strategis | **Valid** |
| 19 | SOP | **Valid** |
| 20 | Data Pendaftaran | **Valid** |
| 21 | Pengaturan Profil | **Valid** |
| 22 | Logout | **Valid** |

**Kesimpulan Akhir:** Berdasarkan hasil pengujian di atas, seluruh fitur pada **setiap menu dan submenu** Admin telah berjalan dengan lancar dan sesuai fungsinya (**Valid**).

---

*Dokumen Laporan Black Box ini merupakan bagian dari dokumentasi teknis skripsi Website Fakultas Ilmu Komputer Universitas Muhammadiyah Sidenreng Rappang (UNISAN).*
