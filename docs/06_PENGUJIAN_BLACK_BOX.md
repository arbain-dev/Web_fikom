# 🧪 LAPORAN PENGUJIAN BLACK BOX — WEBSITE FIKOM UNISAN

## 4.3.2 Pengujian Black Box

Berikut adalah rincian pengujian *Black Box* untuk memastikan seluruh fungsionalitas sistem berjalan sesuai dengan kebutuhan pengguna, baik pada sisi Administrator maupun Pengguna Publik.

---

### A. Pengujian pada Menu Publik (Frontend)

Pengujian ini bertujuan untuk memastikan seluruh informasi yang disajikan kepada publik dapat diakses dengan benar melalui navigasi utama.

#### 1. Pengujian Menu Profil

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Mengakses Sambutan Dekan | Klik menu "Sambutan Dekan" | Sistem menampilkan foto dan teks sambutan Dekan FIKOM | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengakses Visi & Misi | Klik menu "Visi & Misi" | Sistem menampilkan poin-poin visi dan misi fakultas | Sesuai dengan yang diharapkan | Valid |
| 3 | Mengakses Daftar Dosen | Klik menu "Dosen" | Sistem menampilkan grid profil seluruh dosen aktif | Sesuai dengan yang diharapkan | Valid |
| 4 | Mengakses Struktur Organisasi | Klik menu "Struktur Organisasi" | Sistem menampilkan gambar bagan organisasi fakultas | Sesuai dengan yang diharapkan | Valid |

#### 2. Pengujian Menu Program Studi

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Mengakses Prodi Informatika | Klik menu "Informatika" | Sistem menampilkan profil dan kompetensi lulusan Informatika | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengakses Prodi Pend. TI | Klik menu "Pend. Teknologi Informasi" | Sistem menampilkan profil dan prospek kerja lulusan PTI | Sesuai dengan yang diharapkan | Valid |

#### 3. Pengujian Menu Fasilitas

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Mengakses Sarana Prasarana | Klik menu "Sarana dan Prasarana" | Sistem menampilkan daftar ruangan (Kelas, Aula) | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengakses Laboratorium | Klik menu "Laboratorium" | Sistem menampilkan daftar laboratorium komputer | Sesuai dengan yang diharapkan | Valid |

#### 4. Pengujian Menu Akademik

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Mengakses Kurikulum | Klik menu "Kurikulum" | Sistem menampilkan tabel mata kuliah per semester | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengakses Kalender Akademik | Klik menu "Kalender Akademik" | Sistem menampilkan jadwal agenda pendidikan tahunan | Sesuai dengan yang diharapkan | Valid |

#### 5. Pengujian Menu Dokumen

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Mengakses Rencana Operasional | Klik menu "Rencana Operasional" | Sistem menampilkan daftar dokumen RENOP/fakultatif | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengakses Rencana Strategis | Klik menu "Rencana Strategis" | Sistem menampilkan daftar dokumen RENSTRA fakultas | Sesuai dengan yang diharapkan | Valid |
| 3 | Mengakses SOP | Klik menu "SOP" | Sistem menampilkan daftar Standar Operasional Prosedur | Sesuai dengan yang diharapkan | Valid |
| 4 | Mengunduh Dokumen | Klik tombol "Download" pada file | Berkas PDF berhasil terunduh ke perangkat pengguna | Sesuai dengan yang diharapkan | Valid |

#### 6. Pengujian Menu Riset

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Mengakses Penelitian | Klik menu "Penelitian" | Sistem menampilkan daftar judul penelitian dosen | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengakses Pengabdian | Klik menu "Pengabdian" | Sistem menampilkan daftar kegiatan pengabdian masyarakat | Sesuai dengan yang diharapkan | Valid |

#### 7. Pengujian Menu Kemahasiswaan

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Mengakses BEM | Klik menu "BEM" | Sistem menampilkan profil kabinet dan pengurus BEM | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengakses UKM | Klik menu "UKM" | Sistem menampilkan daftar Unit Kegiatan Mahasiswa | Sesuai dengan yang diharapkan | Valid |
| 3 | Mengakses Himpunan | Klik menu "Himpunan" | Sistem menampilkan profil HMPS tiap prodi | Sesuai dengan yang diharapkan | Valid |

#### 8. Pengujian Menu Alumni

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Mengakses Tracer Study | Klik menu "Alumni" | Sistem menampilkan informasi pendataan alumni | Sesuai dengan yang diharapkan | Valid |

#### 9. Pengujian Fitur Pendaftaran (PMB)

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Membuka Form Pendaftaran | Klik menu "Pendaftaran" | Sistem menampilkan form pengisian data calon maba | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengisi Form (Data Valid) | Input NIK, Nama, Prodi, pas foto | Pendaftaran diterima dan tombol submit aktif | Sesuai dengan yang diharapkan | Valid |
| 3 | Submit Pendaftaran | Klik tombol "Daftar Sekarang" | Sistem menyimpan data dan memberi notifikasi sukses | Sesuai dengan yang diharapkan | Valid |

---

### B. Pengujian pada Menu Administrator (Backend)

(Bagian pengujian administrator sebelumnya dipindahkan ke sini agar struktur dokumen rapi)

#### 1. Pengujian pada Proses Login

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Login dengan data valid (Admin) | Username dan password Admin diisi benar, role dipilih Admin | Sistem berhasil login dan menampilkan halaman dashboard Admin | Sesuai dengan yang diharapkan | Valid |
| 2 | Login dengan password salah | Input data benar namun password diketik salah | Sistem menolak akses dan menampilkan pesan error login | Sesuai dengan yang diharapkan | Valid |

#### 2. Pengujian pada Manajemen Konten (Semua Berita)

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:--:|:-------------|:------|:-----------------------|:--------------|:------:|
| 1 | Menambah berita baru | Isi form judul, isi, dan upload foto | Berita baru berhasil diterbitkan di portal web | Sesuai dengan yang diharapkan | Valid |
| 2 | Mengedit konten berita | Ubah judul atau isi berita | Perubahan berita berhasil disimpan | Sesuai dengan yang diharapkan | Valid |
| 3 | Menghapus data berita | Klik ikon hapus pada berita terkait | Berita dan file foto berhasil dihapus permanen | Sesuai dengan yang diharapkan | Valid |

---

*Laporan pengujian Black Box ini disusun sebagai bagian dari validitas teknis skripsi Website Fakultas Ilmu Komputer UNISAN Sidenreng Rappang.*
