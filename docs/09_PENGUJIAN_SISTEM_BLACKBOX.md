# 4.4.2 Pengujian Black Box

Laporan pengujian sistem dengan metode Black Box ini dibagi menjadi dua kelompok besar, yaitu pengujian fitur pada halaman publik untuk pengunjung dan pengujian menu pada halaman dashboard untuk administrator.

---

## A. Pengujian Halaman Publik

**a. Pengujian Halaman Beranda**

*Tabel 4.1 Pengujian Halaman Beranda*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Membuka website utama | Memasukkan alamat URL website | Muncul tampilan beranda, slider, dan berita terbaru | Sesuai dengan yang diharapkan | Valid |

**b. Pengujian Menu Sambutan Dekan**

*Tabel 4.2 Pengujian Halaman Sambutan*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Membuka teks sambutan dekan | Klik menu Profil lalu pilih Sambutan Dekan | Muncul halaman profil dekan dan teks sambutannya | Sesuai harapan | Valid |

**c. Pengujian Menu Visi & Misi**

*Tabel 4.3 Pengujian Halaman Visi Misi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Melihat daftar visi misi | Klik menu Profil lalu pilih Visi & Misi | Muncul poin-poin visi dan misi fakultas secara lengkap | Hasil sesuai harapan | Valid |

**d. Pengujian Menu Daftar Dosen**

*Tabel 4.4 Pengujian Halaman Daftar Dosen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menampilkan foto pengajar | Klik menu Profil > Dosen & Tendik | Muncul daftar guru besar beserta jabatan akademik mereka | Sesuai dengan yang diharapkan | Valid |

**e. Pengujian Menu Struktur Organisasi**

*Tabel 4.5 Pengujian Halaman Struktur Organisasi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Melihat bagan pimpinan | Pilih menu Profil > Struktur Organisasi | Muncul gambar bagan struktur organisasi fakultas | Berhasil tampil | Valid |

**f. Pengujian Menu Pendaftaran PMB**

*Tabel 4.6 Pengujian Form Pendaftaran PMB*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Mengisi data dengan benar | Isi form lengkap dan upload bukti berkas | Muncul info sukses dan data tersimpan ke sistem | Sesuai harapan | Valid |
| 2 | Mengisi data tidak lengkap | Kosongkan kolom nama, lalu klik kirim | Muncul peringatan bahwa data wajib diisi | Sesuai dengan rancangan | Valid |
| 3 | Upload file format salah | Pilih file selain gambar atau PDF (.exe) | Sistem menolak file dan memunculkan pesan error | Berhasil diblokir | Valid |

**g. Pengujian Menu Kurikulum**

*Tabel 4.7 Pengujian Menu Kurikulum*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Melihat daftar mata kuliah | Klik menu Akademik > Kurikulum | Muncul tabel kurikulum setiap program studi | Sesuai harapan | Valid |
| 2 | Mengunduh file kurikulum | Klik tombol download pada baris data | File berhasil didownload ke perangkat dalam format PDF | Berhasil didownload | Valid |

**h. Pengujian Menu Kalender Akademik**

*Tabel 4.8 Pengujian Halaman Kalender*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Mengecek jadwal kegiatan | Klik menu Akademik > Kalender Akademik | Muncul tabel rincian jadwal kuliah dan hari libur | Sesuai dengan yang diharapkan | Valid |

**i. Pengujian Menu Prodi S1 Teknik Informatika**

*Tabel 4.9 Pengujian Halaman Prodi TI*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Melihat profil teknik informatika | Klik Program Studi > S1 Teknik Informatika | Muncul profil lengkap mengenai jurusan Informatika | Berhasil tampil | Valid |

**j. Pengujian Menu S1 Pendidikan Teknologi Informasi**

*Tabel 4.10 Pengujian Halaman Prodi PTI*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Melihat profil kependidikan | Klik Program Studi > S1 Pendidikan Teknologi Informasi | Muncul penjelasan mengenai profil lulusan guru PTI | Sesuai harapan | Valid |

**k. Pengujian Menu Sarana & Prasarana**

*Tabel 4.11 Pengujian Halaman Fasilitas*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Melihat daftar gedung | Klik menu Fasilitas > Sarana Prasarana | Muncul galeri foto ruangan dan fasilitas kampus | Hasil sesuai harapan | Valid |
| 2 | Melihat rincian foto | Klik salah satu gambar di galeri | Gambar muncul dalam ukuran besar/zoom | Berhasil diperbesar | Valid |

**l. Pengujian Menu Laboratorium**

*Tabel 4.12 Pengujian Halaman Laboratorium*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Cek data alat laboratorium | Klik menu Fasilitas > Laboratorium | Muncul rincian jumlah komputer dan alat lainnya | Sesuai dengan yang diharapkan | Valid |

**m. Pengujian Menu Dokumen Fakultas**

*Tabel 4.13 Pengujian Download Dokumen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menarik file aturan fakultas | Klik tombol unduh dokumen | File PDF berhasil tersimpan ke folder download | Berhasil diunduh | Valid |

**n. Pengujian Menu Rencana Strategis (Renstra)**

*Tabel 4.14 Pengujian Menu Dokumen Renstra*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Melihat tabel renstra | Klik Menu Dokumen > Rencana Strategis | Muncul draf arsip dokumen strategis fakultas | Sesuai harapan | Valid |

**o. Pengujian Menu Rencana Operasional (Renop)**

*Tabel 4.15 Pengujian Menu Dokumen Renop*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Melihat tabel renop | Klik Menu Dokumen > Rencana Operasional | Muncul file draf dokumen draf operasional fakultas | Hasil sesuai | Valid |

**p. Pengujian Menu SOP**

*Tabel 4.16 Pengujian Menu Dokumen SOP*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Mengunduh file prosedur | Klik download pada baris dokumen SOP | File format PDF berhasil terunduh dengan baik | Berhasil diunduh | Valid |

**q. Pengujian Menu Penelitian Dosen**

*Tabel 4.17 Pengujian Menu Publikasi Riset*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Mengklik link jurnal | Klik judul artikel atau link sinta | Browser membuka tab baru berisi halaman publikasi jurnal | Sesuai dengan yang diharapkan | Valid |

**r. Pengujian Menu Pengabdian Masyarakat**

*Tabel 4.18 Pengujian Menu Rekap Pengabdian*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Melihat lokasi kegiatan | Klik Menu Riset > Pengabdian Masyarakat | Muncul tabel daerah mana saja yang sudah dilakukan pengabdian | Berhasil muncul | Valid |

**s. Pengujian Menu Profil BEM**

*Tabel 4.19 Pengujian Halaman BEM*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Melihat pengurus organisasi | Klik Kemahasiswaan > BEM | Muncul teks profil gubernur dan bagan pengurus BEM | Sesuai harapan | Valid |

**t. Pengujian Menu Himpunan (UKM & HMPS)**

*Tabel 4.20 Pengujian Halaman Himpunan*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Melihat logo setiap UKM | Klik Kemahasiswaan > Himpunan UKM | Muncul daftar UKM beserta logo dan visi mereka | Sesuai dengan yang diharapkan | Valid |

**u. Pengujian Menu Artikel Berita**

*Tabel 4.21 Pengujian Menu Berita*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Membaca berita selengkapnya | Klik tombol baca atau thumbnail berita | Muncul halaman detail berita yang berisi teks lengkap | Berhasil ditampilkan | Valid |

---

## B. Pengujian Dashboard Admin (Backend)

**a. Pengujian Fitur Login**

*Tabel 4.22 Pengujian Menu Login*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Login dengan akun valid | Input username `admin` dan password yang tepat | Admin berhasil masuk ke halaman utama dashboard | Sesuai dengan yang diharapkan | Valid |
| 2 | Login tanpa username | Klik login tapi kolom nama tidak diisi | Muncul pesan peringatan agar username diisi | Berhasil diblokir | Valid |
| 3 | Login tanpa password | Klik login tapi kolom sandi dikosongkan | Muncul peringatan bahwa password wajib dimasukkan | Hasil sesuai | Valid |
| 4 | Login dengan info salah | Memasukkan password atau username asal-asalan | Muncul notifikasi bahwa draf login salah | Sesuai harapan | Valid |

**b. Pengujian Statistik Dashboard**

*Tabel 4.23 Pengujian Tampilan Dashboard*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Mengecek angka statistik | Membuka menu Beranda Admin | Angka jumlah dosen, berita, dan lainnya muncul otomastis | Sesuai dengan yang diharapkan | Valid |

**c. Pengujian Kelola Slider**

*Tabel 4.24 Pengujian Pengaturan Slider*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah gambar baru | Pilih file foto dan klik tomol Simpan | Gambar baru muncul di daftar tabel dan halaman depan | Berhasil tersimpan | Valid |
| 2 | Menghapus data slider | Klik tombol hapus pada salah satu baris foto | Data hilang dari daftar dan file di server ikut terhapus | Sesuai harapan | Valid |

**d. Pengujian Kelola Sambutan Dekan**

*Tabel 4.25 Pengujian Update Sambutan*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Mengubah teks profil dekan | Tulis narasi baru dan klik Update | Teks pada halaman profil publik otomatis berganti | Berhasil diupdate | Valid |

**e. Pengujian Kelola Fakta Kampus**

*Tabel 4.26 Pengujian Data Statistik (Fakta)*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah fakta baru | Masukkan judul fakta (misal: Ruang Lab) dan jumlahnya | Data baru tersimpan dan masuk ke daftar tabel | Berhasil ditambah | Valid |
| 2 | Mengubah nilai data | Ubah angka jumlah pada data yang sudah ada | Nilai pada tabel berubah sesuai angka yang baru dimasukan | Sesuai dengan yang diharapkan | Valid |
| 3 | Menghapus baris data | Klik hapus pada baris fakta yang ingin dibuang | Baris tersebut hilang secara permanen dari sistem | Berhasil dihapus | Valid |

**f. Pengujian Kelola Visi & Misi**

*Tabel 4.27 Pengujian Pengaturan Visi Misi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah poin visi baru | Tulis poin visi terbaru dan simpan | Poin tersebut muncul di urutan paling bawah tabel | Berhasil tersimpan | Valid |
| 2 | Menghapus poin lama | Pilih salah satu poin misi lalu klik hapus | Poin misi tersebut hilang dari daftar database | Sesuai harapan | Valid |

**g. Pengujian Update Bagan Organisasi**

*Tabel 4.28 Pengujian Update Struktur Organisasi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Mengganti gambar bagan | Pilih file foto struktur baru lalu klik Simpan | Gambar bagan lama terhapus dan diganti dengan yang baru | Berhasil diganti | Valid |

**h. Pengujian Kelola Data Dosen**

*Tabel 4.29 Pengujian Menu Kelola Dosen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah profil pengajar | Isi nama, NIDN, jabatan, dan upload foto | Data dosen baru berhasil tersimpan dan tampil di tabel | Berhasil ditambah | Valid |
| 2 | Simpan tanpa mengisi nama | Klik simpan namun kolom nama dibiarkan kosong | Sistem memunculkan peringatan wajib diisi (validasi) | Muncul peringatan | Valid |
| 3 | Mengedit gelar dosen | Ubah teks gelar atau jabatan lalu klik Update | Penulisan nama/gelar berubah tapi foto tidak hilang | Berhasil diubah | Valid |
| 4 | Menghapus dosen | Klik hapus pada salah satu pengajar | Akun dosen tersebut dihapus dan fotonya hilang dari server | Berhasil dihapus | Valid |

**i. Pengujian Pendaftar PMB**

*Tabel 4.30 Pengujian Kelola Calon Mahasiswa*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Mengganti status pendaftaran | Pilih dropdown dari "Menunggu" ke "Diterima" | Label status di tabel berubah warna menjadi hijau | Sesuai harapan | Valid |
| 2 | Cek berkas pendaftar | Klik tombol lihat berkas pada kolom pendaftar | Aplikasi menampilkan foto scan ijazah pemohon | Berhasil tampil | Valid |
| 3 | Menghapus data pendaftar | Klik hapus pada baris pelamar yang gugur | Data dan file lampiran mahasiswa terhapus permanen | Berhasil dihapus | Valid |

**j. Pengujian Kelola Kurikulum**

*Tabel 4.31 Pengujian Pengaturan Silabus*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah dokumen PDF baru | Upload file kurikulum berformat .pdf | File berhasil tersimpan dan siap didownload pengunjung | Berhasil tersimpan | Valid |
| 2 | Ubah nama jurusan | Ganti isi teks nama prodi lalu simpan | Judul pada tabel berubah tetapi file PDF tidak rusak | Hasil sesuai | Valid |
| 3 | Hapus file kurikulum | Klik tombol hapus baris data kurikulum | Data dan file PDF fisiknya ikut hilang dari memori | Berhasil dihapus | Valid |

**k. Pengujian Agenda Kalender**

*Tabel 4.32 Pengujian Pengaturan Jadwal*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah tanggal libur | Isi agenda dan pilih tanggal pada form | Kegiatan baru masuk ke daftar kalender akademik | Sesuai harapan | Valid |
| 2 | Mengubah jadwal acara | Edit kolom tanggal atau nama acara yang salah | Jadwal terbaru tersimpan dan tampil di halaman depan | Berhasil diupdate | Valid |

**l. Pengujian Kelola Sarana & Ruangan**

*Tabel 4.33 Pengujian Fasilitas Gedung*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Input unit fasilitas baru | Isi detail ruangan dan upload foto pendukung | Unit tersebut tampil di galeri foto fakultas | Berhasil ditambah | Valid |
| 2 | Hapus data ruangan | Klik simbol hapus pada ruangan yang sudah tidak ada | Ruangan hilang dari daftar dan gambar terhapus otomatis | Berhasil dihapus | Valid |

**m. Pengujian Kelola Inventaris Lab**

*Tabel 4.34 Pengujian Perlengkapan Laboratorium*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah daftar PC baru | Masukkan spek komputer dan jumlahnya | Daftar alat lab bertambah dan tampil di halaman publik | Berhasil ditambah | Valid |
| 2 | Koreksi jumlah alat | Ubah angka jumlah PC yang sudah ada di tabel | Angka stok alat pada database terupdate sesuai input baru | Sesuai harapan | Valid |

*(Selanjutnya, pengujian untuk Menu 4.35 (Kelola SOP) sampai 4.42 (Kelola Kerja Sama) dilakukan dengan prosedur yang sama yaitu Tambah, Edit, dan Hapus data, dan seluruhnya memberikan hasil yang Valid).*

---

## 4.4.3 Kesimpulan Akhir

Berdasarkan hasil pengujian yang dilakukan terhadap **42 menu** di halaman publik maupun admin, dapat disรimpulkan bahwa seluruh fungsional sistem berjalan dengan baik. Semua fitur mulai dari pendaftaran, update informasi, hingga manajemen file sudah sesuai dengan kebutuhan dan tidak ditemukan kesalahan fatal pada alur program.
