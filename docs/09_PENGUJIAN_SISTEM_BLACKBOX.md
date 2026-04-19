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

## B. Dashboard Admin (Backend)

**a. Pengujian Fitur Login**

*Tabel 4.22 Pengujian Menu Login Admin*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Login kredensial benar | Input username `admin` dan password yang tepat | Admin berhasil masuk ke halaman dashboard utama | Sesuai dengan yang diharapkan | Valid |
| 2 | Login kredensial salah | Memasukkan password atau username asal-asalan | Muncul notifikasi bahwa data login salah/ditolak | Berhasil ditolak | Valid |

**b. Pengujian Statistik Dashboard**

*Tabel 4.23 Pengujian Tampilan Dashboard*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Mengecek ringkasan data | Membuka menu Beranda Admin | Menampilkan jumlah data dosen, PMB, dan berita otomatis | Sesuai harapan | Valid |

**c. Pengujian Kelola Slider**

*Tabel 4.24 Pengujian Pengaturan Slider*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah slider baru | Upload foto baru dan klik simpan | Foto baru tampil di tabel admin dan web depan | Berhasil ditambah | Valid |
| 2 | Menghapus data slider | Klik tombol hapus pada salah satu baris foto | Data hilang dari daftar dan file di server terhapus | Berhasil dihapus | Valid |

**d. Pengujian Kelola Sambutan Dekan**

*Tabel 4.25 Pengujian Update Sambutan*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Mengubah isi sambutan | Tulis teks baru pada form dekan dan klik update | Teks sambutan di halaman profil berubah otomatis | Berhasil diupdate | Valid |

**e. Pengujian Kelola Fakta Kampus**

*Tabel 4.26 Pengujian Data Statistik (Fakta)*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah fakta baru | Masukkan nama fakta dan jumlah angkanya | Data baru tersimpan dan masuk ke daftar tabel | Berhasil ditambah | Valid |
| 2 | Mengubah nilai fakta | Edit angka jumlah fakta yang sudah ada | Nilai fakta terupdate sesuai dengan inputan baru | Berhasil diubah | Valid |
| 3 | Menghapus baris fakta | Klik tombol hapus pada salah satu data fakta | Data fakta hilang dari daftar secara permanen | Berhasil dihapus | Valid |

**f. Pengujian Kelola Visi & Misi**

*Tabel 4.27 Pengujian Pengaturan Visi Misi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah poin visi/misi | Tulis teks visi atau misi baru lalu simpan | Poin baru muncul dalam daftar tabel visi misi | Berhasil ditambah | Valid |
| 2 | Mengubah teks visi/misi | Lakukan pengeditan pada teks visi misi lama | Isi teks visi/misi berubah sesuai dengan editan | Berhasil diubah | Valid |
| 3 | Menghapus poin visi/misi | Klik tombol hapus pada salah satu poin | Poin tersebut hilang dari daftar database | Berhasil dihapus | Valid |

**g. Pengujian Update Bagan Organisasi**

*Tabel 4.28 Pengujian Update Struktur Organisasi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Mengganti gambar bagan | Pilih file foto struktur baru lalu klik Update | Gambar lama digantikan oleh gambar versi terbaru | Berhasil diganti | Valid |

**h. Pengujian Kelola Data Dosen**

*Tabel 4.29 Pengujian Menu Kelola Dosen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah data dosen | Isi profil lengkap dan upload foto dosen | Profil dosen tersimpan dan muncul di tabel admin | Berhasil ditambah | Valid |
| 2 | Mengubah biodata dosen | Edit teks nama/gelar lalu klik tombol Update | Identitas dosen berubah tanpa merusak file fotonya | Berhasil diubah | Valid |
| 3 | Menghapus data dosen | Klik tombol hapus pada baris data dosen | Data terhapus dan file fotonya hilang dari server | Berhasil dihapus | Valid |

**i. Pengujian Pendaftar PMB**

*Tabel 4.30 Pengujian Kelola Calon Mahasiswa*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Memvalidasi pendaftar | Ubah status dari "Menunggu" ke "Diterima" | Label status di tabel berubah warna menjadi hijau | Sesuai harapan | Valid |
| 2 | Cek berkas pendaftar | Klik tombol lihat profil/berkas pelamar | Aplikasi menampilkan lampiran scan ijazah pemohon | Berhasil tampil | Valid |
| 3 | Menghapus data pelamar | Klik tombol hapus pada baris pendaftar | Data pelamar gugur hilang dari database sistem | Berhasil dihapus | Valid |

**j. Pengujian Kelola Kurikulum**

*Tabel 4.31 Pengujian Kelola Kurikulum*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah file kurikulum | Isi nama prodi dan upload file silabus PDF | Data tersimpan dan file siap didownload publik | Berhasil ditambah | Valid |
| 2 | Mengubah info kurikulum | Edit judul kurikulum atau ganti file PDFnya | Info kurikulum terupdate dengan file/teks baru | Berhasil diubah | Valid |
| 3 | Menghapus data kurikulum | Klik hapus pada baris data terkait | Data dan file fisiknya hilang dari folder server | Berhasil dihapus | Valid |

**k. Pengujian Agenda Kalender**

*Tabel 4.32 Pengujian Pengaturan Jadwal*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah agenda baru | Masukkan nama acara dan pilih tanggalnya | Event baru masuk ke daftar tabel kalender admin | Berhasil ditambah | Valid |
| 2 | Mengubah jadwal acara | Edit kolom tanggal atau deskripsi kegiatan | Jadwal kegiatan terupdate sesuai info terbaru | Berhasil diupdate | Valid |
| 3 | Menghapus agenda libur | Klik hapus pada kegiatan yang sudah lewat | Agenda tersebut hilang dari tampilan kalender web | Berhasil dihapus | Valid |

**l. Pengujian Kelola Sarana & Ruangan**

*Tabel 4.33 Pengujian Fasilitas Gedung*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Input fasilitas baru | Isi detail ruangan dan upload foto pendukung | Unit ruangan baru tampil di galeri foto fakultas | Berhasil ditambah | Valid |
| 2 | Mengubah info fasilitas | Edit deskripsi atau ganti foto ruangan | Informasi sarana prasarana terupdate di web | Berhasil diubah | Valid |
| 3 | Menghapus data ruangan | Pilih tombol hapus pada unit gedung tersebut | Data ruangan dan fotonya hilang dari sistem web | Berhasil dihapus | Valid |

**m. Pengujian Kelola Inventaris Lab**

*Tabel 4.34 Pengujian Perlengkapan Laboratorium*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah peranti lab | Masukkan nama alat dan jumlah stok barunya | Daftar inventaris lab bertambah di database admin | Berhasil ditambah | Valid |
| 2 | Update stok peralatan | Edit jumlah atau spesifikasi alat tersebut | Angka stok alat terupdate sesuai hasil editan | Sesuai harapan | Valid |
| 3 | Menghapus data inventaris | Klik hapus pada baris peralatan laboratorium | Data alat tersebut hilang dari daftar inventaris | Berhasil dihapus | Valid |

**n. Pengujian Kelola SOP**

*Tabel 4.35 Pengujian Dokumen SOP*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Upload dokumen SOP baru | Pilih file PDF SOP dan beri nama dokumen | Berkas tersimpan dan link unduh muncul di depan | Berhasil disimpan | Valid |
| 2 | Mengubah judul SOP | Edit penamaan dokumen SOP pada tabel | Nama dokumen SOP berhasil diperbarui di pangkalan | Berhasil diubah | Valid |
| 3 | Menghapus dokumen SOP | Klik tombol hapus pada baris dokumen SOP | Data dan file fisiknya hilang dari folder server | Berhasil dihapus | Valid |

**o. Pengujian Kelola Rencana Strategis (Renstra)**

*Tabel 4.36 Pengujian Dokumen Renstra*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah draf Renstra | Isi nama dokumen dan lampirkan file PDF | Dokumen renstra masuk ke dalam daftar arsip | Berhasil ditambah | Valid |
| 2 | Ubah draf Renstra | Lakukan perbaikan pada tajuk atau ganti file PDF | Informasi renstra terupdate dengan data terbaru | Berhasil diubah | Valid |
| 3 | Hapus draf Renstra | Klik tombol hapus pada baris renstra tersebut | Data dan file PDF arsip renstra terhapus bersih | Berhasil dihapus | Valid |

**p. Pengujian Kelola Rencana Operasional (Renop)**

*Tabel 4.37 Pengujian Dokumen Renop*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah file Renop | Masukkan judul renop dan upload dokumen PDF | Berkas operasional fakultas tersimpan di database | Berhasil disimpan | Valid |
| 2 | Ganti file Renop | Upload file PDF baru untuk mengganti draf lama | File renop lama diganti dengan file versi terbaru | Berhasil diupdate | Valid |
| 3 | Hapus file Renop | Pilih aksi hapus pada baris dokumen renop | Data dan file lampiran renop hilang dari server | Berhasil dihapus | Valid |

**q. Pengujian Kelola Penelitian Dosen**

*Tabel 4.38 Pengujian Daftar Riset Dosen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah data riset | Masukkan judul riset dan tempel link publikasi | Judul riset tampil dan link bisa diklik di web | Berhasil ditambah | Valid |
| 2 | Mengubah judul/link | Edit kesalahan pengetikan pada judul sinta dosen | Judul riset terupdate sesuai dengan perbaikan | Hasil sesuai | Valid |
| 3 | Menghapus data riset | Klik tombol hapus pada salah satu baris riset | Baris penelitian tersebut hilang dari pangkalan | Berhasil dihapus | Valid |

**r. Pengujian Kelola Pengabdian**

*Tabel 4.39 Pengujian Agenda Pengabdian*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah log pengabdian | Isi lokasi dan instansi pengabdian masyarakat | Data pengabdian masuk ke rekap tabel admin | Berhasil ditambah | Valid |
| 2 | Edit log pengabdian | Ubah rincian lokasi atau tanggal kegiatan | Detail pengabdian terupdate sesuai data baru | Berhasil diubah | Valid |
| 3 | Menghapus log pengabdian | Klik hapus pada baris agenda pengabdian itu | Data pengabdian tersebut hilang dari sistem | Berhasil dihapus | Valid |

**s. Pengujian Kelola BEM / UKM**

*Tabel 4.40 Pengujian Organisasi Mahasiswa*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah profil UKM | Masukkan nama UKM dan upload logo barunya | Profil UKM tampil di halaman kemahasiswaan | Berhasil ditambah | Valid |
| 2 | Update deskripsi Ormawa | Edit visi misi atau ganti foto pengurus UKM | Informasi organisasi terupdate di tampilan publik | Berhasil diubah | Valid |
| 3 | Menghapus data UKM | Klik tombol hapus pada baris organisasi UKM | Data organisasi dan logonya terhapus permanen | Berhasil dihapus | Valid |

**t. Pengujian Kelola Artikel Berita**

*Tabel 4.41 Pengujian Publikasi Berita*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah naskah berita | Tulis judul, isi berita, dan upload foto sampul | Berita terbit dan muncul di urutan teratas web | Berhasil terbit | Valid |
| 2 | Mengedit isi berita | Lakukan ralat/edit pada teks berita tersebut | Isi naskah berita berubah sesuai dengan editan | Berhasil diubah | Valid |
| 3 | Menghapus berita lama | Klik tombol hapus pada baris berita artikel | Berita hilang dari web dan fotonya ikut terhapus | Berhasil dihapus | Valid |

**u. Pengujian Kelola Kerjasama (MoU)**

*Tabel 4.42 Pengujian Dokumen Kerjasama*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Menambah draf kerjsama | Isi nama mitra dan lampirkan dokumen MoU PDF | Kerjasama tersimpan dan tercatat di database | Berhasil ditambah | Valid |
| 2 | Mengedit data mitra | Ubah nama instansi atau ganti file PDF MoU | Data mitra kerjasama terupdate dengan info baru | Berhasil diubah | Valid |
| 3 | Menghapus draf kerjasama | Pilih tombol hapus pada baris mitra kerjasama | Data kerjasama dan file MoU-nya terhapus bersih | Berhasil dihapus | Valid |

---

## 4.4.3 Kesimpulan Akhir

Berdasarkan hasil pengujian yang dilakukan terhadap **42 menu** (21 Halaman Publik dan 21 Halaman Admin), dapat disimpulkan bahwa sistem web FIKOM ini sudah bekerja sesuai dengan tujuan perancangannya. Fitur-fitur utama seperti pendaftaran mahasiswa baru, pengelolaan konten informasi, serta pemeliharaan file dokumen akademik dapat dioperasikan secara normal melalui manajemen data CRUD (Tambah, Edit, Hapus) yang stabil dan terintegrasi.
