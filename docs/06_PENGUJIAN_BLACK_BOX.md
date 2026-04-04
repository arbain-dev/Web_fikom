# 🧪 LAPORAN PENGUJIAN BLACK BOX — WEBSITE FIKOM UNISAN

## 4.3.2 Pengujian Black Box

Berikut adalah rincian pengujian *Black Box* untuk memastikan seluruh fungsionalitas sistem berjalan sesuai dengan kebutuhan pengguna.

---

### a. Pengujian pada Proses Login

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Login dengan data valid (Admin) | Username dan password Admin diisi benar, role dipilih Admin | Sistem berhasil login dan menampilkan halaman dashboard Admin | Sesuai dengan yang diharapkan | Valid |
| 2 | Login dengan data valid (Dosen) | NIDN dan password Dosen diisi benar, role dipilih Dosen | Sistem berhasil login dan menampilkan halaman dashboard Dosen | Sesuai dengan yang diharapkan | Valid |
| 3 | Login dengan data valid (Mahasiswa) | NIM dan password Mahasiswa diisi benar, role dipilih Mahasiswa | Sistem berhasil login dan menampilkan halaman dashboard Mahasiswa | Sesuai dengan yang diharapkan | Valid |
| 4 | Login dengan password salah | Input data benar namun password diketik salah | Sistem menolak akses dan menampilkan pesan error login | Sesuai dengan yang diharapkan | Valid |

---

### b. Pengujian pada Menu Dashboard

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Menampilkan statistik data | Membuka halaman dashboard | Sistem menampilkan jumlah total Berita dan Dosen secara akurat | Sesuai dengan yang diharapkan | Valid |
| 2 | Menampilkan daftar data terbaru | Melihat tabel data terbaru | Sistem menampilkan daftar 5 entri terbaru dari database | Sesuai dengan yang diharapkan | Valid |

---

### c. Pengujian pada Sub-menu Visi Misi

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Menambah data visi misi | Mengisi form visi/misi baru dan klik simpan | Data berhasil tersimpan ke database | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengubah data visi misi | Mengedit teks visi/misi dan klik simpan | Perubahan data berhasil diperbarui di sistem | Sesuai dengan yang diharapkan | Valid |
| 3 | Menghapus data visi misi | Klik ikon hapus pada salah satu data | Data terpilih berhasil dihapus dari database | Sesuai dengan yang diharapkan | Valid |

---

### d. Pengujian pada Sub-menu Struktur Organisasi

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Unggah gambar struktur | Memilih file gambar dan klik simpan | File gambar berhasil terunggah dan tampil di halaman admin | Sesuai dengan yang diharapkan | Valid |
| 2 | Menghapus gambar struktur | Klik tombol hapus pada gambar | Gambar berhasil dihapus dari server dan database | Sesuai dengan yang diharapkan | Valid |

---

### e. Pengujian pada Sub-menu Data Civitas (Fakta)

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Menambah fakta statistik | Mengisi judul dan angka fakta, klik simpan | Statistik baru berhasil ditambahkan | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengubah fakta statistik | Edit angka/judul fakta dan simpan | Data statistik berhasil diperbarui | Sesuai dengan yang diharapkan | Valid |
| 3 | Menghapus fakta statistik | Klik ikon hapus pada data fakta | Data fakta berhasil dihapus dari daftar | Sesuai dengan yang diharapkan | Valid |

---

### f. Pengujian pada Sub-menu Tentang Fakultas

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Memperbarui profil fakultas | Mengedit deskripsi dan sejarah fakultas | Konten deskripsi berhasil diperbarui di halaman publik | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengganti foto fakultas | Upload foto baru dan simpan | Foto profil fakultas berhasil diganti | Sesuai dengan yang diharapkan | Valid |

---

### g. Pengujian pada Menu Kelola Slider

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Menambah slider baru | Upload gambar slider dan klik simpan | Gambar slider baru aktif di halaman utama | Sesuai dengan yang diharapkan | Valid |
| 2 | Menghapus gambar slider | Klik tombol hapus pada salah satu slider | Gambar slider terpilih berhasil dihapus | Sesuai dengan yang diharapkan | Valid |

---

### h. Pengujian pada Sub-menu Semua Berita

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Menambah berita baru | Isi form judul, isi, dan upload foto | Berita baru berhasil diterbitkan di portal web | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengedit konten berita | Ubah judul atau isi berita | Perubahan berita berhasil disimpan | Sesuai dengan yang diharapkan | Valid |
| 3 | Menghapus data berita | Klik ikon hapus pada berita terkait | Berita dan file foto berhasil dihapus permanen | Sesuai dengan yang diharapkan | Valid |

---

### i. Pengujian pada Sub-menu Daftar Dosen

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Menambah profil dosen | Isi NIDN, nama, dan foto dosen | Data dosen baru terdaftar di database | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengubah info dosen | Edit spesialisasi atau jabatan | Informasi dosen berhasil diperbarui | Sesuai dengan yang diharapkan | Valid |
| 3 | Menghapus data dosen | Klik ikon hapus pada nama dosen | Rekaman dosen berhasil dihapus dari sistem | Sesuai dengan yang diharapkan | Valid |

---

### j. Pengujian pada Sub-menu Ruangan

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Menambah data ruangan | Isi nama ruangan dan kapasitas | Ruangan baru berhasil ditambahkan | Sesuai dengan yang diharapkan | Valid |
| 2 | Menghapus foto ruangan | Klik hapus pada gambar ruangan | Ruangan ditiadakan dari inventaris publik | Sesuai dengan yang diharapkan | Valid |

---

### k. Pengujian pada Sub-menu Laboratorium

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Menambah laboratorium | Isi nama lab dan fasilitas, klik simpan | Data laboratorium baru berhasil tersimpan | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengubah deskripsi lab | Edit daftar alat/fasilitas lab | Info fasilitas laboratorium diperbarui | Sesuai dengan yang diharapkan | Valid |

---

### l. Pengujian pada Sub-menu Kurikulum

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Unggah file kurikulum | Pilih file PDF kurikulum prodi | File kurikulum berhasil tersedia untuk diunduh | Sesuai dengan yang diharapkan | Valid |
| 2 | Menghapus kurikulum | Klik tombol hapus file | Berkas kurikulum lama berhasil dihapus dari server | Sesuai dengan yang diharapkan | Valid |

---

### m. Pengujian pada Sub-menu Kalender

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Input agenda akademik | Isi nama kegiatan dan tanggal jadwal | Agenda baru muncul di kalender akademik | Sesuai dengan yang diharapkan | Valid |
| 2 | Hapus agenda akademik | Klik ikon hapus pada kegiatan | Kegiatan akademik berhasil dihapuskan | Sesuai dengan yang diharapkan | Valid |

---

### n. Pengujian pada Sub-menu BEM

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Update profil kabinet | Mengisi visi-misi kabinet baru | Profil organisasi BEM berhasil diperbarui | Sesuai dengan yang diharapkan | Valid |
| 2 | Tambah pengurus BEM | Isi nama dan jabatan anggota | Daftar pengurus BEM bertambah | Sesuai dengan yang diharapkan | Valid |

---

### o. Pengujian pada Sub-menu Kerjasama

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Menambah mitra kerja | Upload logo mitra dan nama instansi | Logo kerjasama baru tampil di carousel beranda | Sesuai dengan yang diharapkan | Valid |
| 2 | Menghapus data mitra | Klik hapus pada data kerjasama | Data afiliasi mitra berhasil dihilangkan | Sesuai dengan yang diharapkan | Valid |

---

### p. Pengujian pada Sub-menu Penelitian

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Input data penelitian | Isi judul riset dan nama dosen peneliti | Jurnal penelitian berhasil terdata di sistem | Sesuai dengan yang diharapkan | Valid |
| 2 | Unggah laporan riset | Pilih berkas PDF hasil penelitian | File laporan akhir penelitian berhasil diunggah | Sesuai dengan yang diharapkan | Valid |

---

### q. Pengujian pada Sub-menu Pengabdian

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Tambah pengabdian | Isi deskripsi kegiatan sosial masyarakat | Rekapitulasi pengabdian civitas berhasil tersimpan | Sesuai dengan yang diharapkan | Valid |
| 2 | Menghapus pengabdian | Klik hapus pada judul kegiatan | Dokumentasi pengabdian berhasil dihapus | Sesuai dengan yang diharapkan | Valid |

---

### r. Pengujian pada Sub-menu Dokumen Fakultas

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Unggah Dokumen Fakultas | Pilih file PDF dokumen fakultatif | Dokumen Fakultas berhasil tampil di repositori publik | Sesuai dengan yang diharapkan | Valid |
| 2 | Ganti file dokumen | Upload file baru untuk dokumen lama | File dokumen lama otomatis tergantikan oleh baru | Sesuai dengan yang diharapkan | Valid |

---

### s. Pengujian pada Sub-menu Rencana Strategis

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Input data Renstra | Isi judul dan unggah file PDF Renstra | Dokumen Renstra berhasil dipublikasikan di web | Sesuai dengan yang diharapkan | Valid |
| 2 | Menghapus data renstra | Klik ikon hapus pada file terpilih | Berkas dokumen dan data Renstra dihapus permanen | Sesuai dengan yang diharapkan | Valid |

---

### t. Pengujian pada Sub-menu SOP

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Unggah SOP Baru | Isi judul SOP dan upload berkas PDF | Daftar SOP akademik berhasil ditambahkan | Sesuai dengan yang diharapkan | Valid |
| 2 | Menghapus data SOP | Klik ikon hapus pada repositori SOP | File pedoman SOP berhasil ditiadakan | Sesuai dengan yang diharapkan | Valid |

---

### u. Pengujian pada Menu Data Pendaftaran

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Tampil data pendaftar | Membuka menu pendaftaran Maba | Sistem menampilkan list calon mahasiswa baru | Sesuai dengan yang diharapkan | Valid |
| 2 | Lihat detail pendaftar | Klik ikon mata/detail pada baris data | Sistem menampilkan biodata lengkap & file KTP/Ijazah | Sesuai dengan yang diharapkan | Valid |
| 3 | Menghapus pendaftar | Klik hapus pada data sampah/uji coba | Data pendaftaran berhasil dibersihkan dari DB | Sesuai dengan yang diharapkan | Valid |

---

### v. Pengujian pada Menu Pengaturan (Profil Saya)

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Memperbarui nama/email | Ubah nama admin dan klik simpan | Informasi personal administrator berhasil diupdate | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengubah kata sandi | Masukkan password lama dan baru | Kredensial login admin berhasil diperbarui | Sesuai dengan yang diharapkan | Valid |

---

### w. Pengujian pada Menu Logout

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Keluar dari sistem | Klik tombol logout | Sesi berakhir dan diarahkan kembali ke form login | Sesuai dengan yang diharapkan | Valid |

---

*Laporan pengujian Black Box ini disusun sebagai bagian dari validitas teknis skripsi Website Fakultas Ilmu Komputer UNISAN Sidenreng Rappang.*
