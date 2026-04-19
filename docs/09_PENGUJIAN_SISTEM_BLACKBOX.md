# 4.4.2 Pengujian Black Box

Berikut ini merupakan rincian dari hasil pengujian fungsional sistem menggunakan metode Black Box. Pengujian ini dilakukan untuk memastikan bahwa seluruh fitur pada website FIKOM dapat beroperasi dengan semestinya, baik dari sisi pengunjung (publik) maupun dari sisi pengelola (admin).

---

## A. Daftar Pengujian Halaman Publik

**a. Konten Halaman Beranda**

*Tabel 4.1 Uji Fungsi Halaman Beranda*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses website utama | Memasukkan URL website ke browser | Tampilan beranda, slider, dan berita muncul dengan benar | Muncul sesuai dengan alamat URL | Valid |

**b. Halaman Sambutan Dekan**

*Tabel 4.2 Uji Fungsi Halaman Sambutan*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Membaca profil dekan | Masuk menu Profil > Sambutan Dekan | Muncul foto dekan beserta teks sambutannya | Sesuai harapan | Valid |

**c. Halaman Visi & Misi**

*Tabel 4.3 Uji Fungsi Halaman Visi Misi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Cek data visi misi | Masuk menu Profil > Visi & Misi | Muncul poin-poin visi dan misi fakultas | Data tampil lengkap | Valid |

**d. Daftar Dosen & Tendik**

*Tabel 4.4 Uji Fungsi Halaman Dosen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Melihat data pengajar | Klik navigasi Profil > Dosen & Tendik | Tampil daftar dosen beserta jabatan mereka | Berhasil ditampilkan | Valid |

**e. Struktur Organisasi**

*Tabel 4.5 Uji Fungsi Struktur Organisasi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Melihat bagan pimpinan | Pilih menu Profil > Struktur Organisasi | Muncul file gambar bagan organisasi fakultas | Gambar tampil jernih | Valid |

**f. Form Pendaftaran PMB**

*Tabel 4.6 Uji Form Pendaftaran Mahasiswa Baru*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Input data valid | Mengisi form lengkap dan upload berkas | Muncul notifikasi sukses dan data tersimpan | Sesuai rancangan | Valid |
| 2 | Input data kosong | Klik kirim tanpa mengisi kolom nama | Muncul peringatan agar data dilengkapi | Berhasil diingatkan | Valid |
| 3 | Salah format file | Upload file aplikasi (.exe) ke kolom berkas | Sistem menolak pengiriman file tersebut | Akses ditolak sistem | Valid |

**g. Menu Kurikulum**

*Tabel 4.7 Uji Fungsi Halaman Kurikulum*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Membaca daftar matkul | Klik menu Akademik > Kurikulum | Muncul daftar mata kuliah tiap prodi | Tabel tampil rapi | Valid |
| 2 | Unduh kurikulum | Klik tombol download pada tabel | File PDF berhasil terdownload ke PC | Berhasil diunduh | Valid |

**h. Kalender Akademik**

*Tabel 4.8 Uji Fungsi Halaman Kalender*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pantau jadwal kuliah | Klik menu Akademik > Kalender Akademik | Muncul rincian jadwal agenda kampus | Data tampil akurat | Valid |

**i. Prodi S1 Teknik Informatika**

*Tabel 4.9 Uji Halaman Prodi TI*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Baca profil TI | Klik Program Studi > S1 Teknik Informatika | Keluar teks keunggulan dan profil prodi TI | Muncul dengan baik | Valid |

**j. S1 Pendidikan Teknologi Informasi**

*Tabel 4.10 Uji Halaman Prodi PTI*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Baca profil PTI | Klik navigasi S1 Pendidikan Tek. Informasi | Keluar teks penjelasan mengenai prodi PTI | Sesuai harapan | Valid |

**k. Sarana & Prasarana**

*Tabel 4.11 Uji Fungsi Sarana Prasarana*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Cek foto gedung | Klik Fasilitas > Sarana Prasarana | Muncul galeri foto fasilitas fakultas | Foto-foto tampil | Valid |
| 2 | Zoom gambar | Klik salah satu foto di galeri | Foto membesar memenuhi layar | Berhasil diperbesar | Valid |

**l. Fasilitas Laboratorium**

*Tabel 4.12 Uji Fungsi Halaman Lab*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Rincian alat lab | Klik Fasilitas > Laboratorium | Muncul list rincian jumlah komputer di lab | Data tampil valid | Valid |

**m. Dokumen Akademik**

*Tabel 4.13 Uji Fungsi Download Dokumen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Ambil file aturan | Klik tombol download dokumen | File PDF tersimpan ke folder download | Sukses terunduh | Valid |

**n. Rencana Strategis (Renstra)**

*Tabel 4.14 Uji Halaman Dokumen Renstra*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Buka daftar renstra | Klik Menu Dokumen > Rencana Strategis | Tabel daftar file renstra muncul | Sesuai dengan yang ada | Valid |

**o. Rencana Operasional (Renop)**

*Tabel 4.15 Uji Halaman Dokumen Renop*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Buka daftar renop | Klik Menu Dokumen > Rencana Operasional | Tabel daftar file renop fakultas muncul | Berhasil muncul | Valid |

**p. Standar Operasional (SOP)**

*Tabel 4.16 Uji Halaman Dokumen SOP*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Unduh file SOP | Klik tombol download pada list SOP | Berkas PDF berhasil terdownload | File tersimpan di PC | Valid |

**q. Penelitian Dosen**

*Tabel 4.17 Uji Halaman Riset Dosen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses rujukan jurnal | Klik judul penelitian atau link sinta | Terbuka halaman jurnal di tab browser baru | Berhasil diarahkan | Valid |

**r. Pengabdian Masyarakat**

*Tabel 4.18 Uji Halaman Pengabdian*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Cek riwayat pengabdian | Klik Riset > Pengabdian Masyarakat | Muncul tabel daerah lokasi pengabdian | Tampil dengan benar | Valid |

**s. Organisasi BEM**

*Tabel 4.19 Uji Halaman Profil BEM*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Cek profil pengurus | Klik Kemahasiswaan > BEM | Tampil foto gubernur dan struktur BEM | Muncul sesuai data | Valid |

**t. UKM & HMPS**

*Tabel 4.20 Uji Halaman Himpunan Mahasiswa*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Daftar organisasi | Klik Kemahasiswaan > Himpunan UKM | Muncul daftar organisasi beserta logonya | Data tampil rapi | Valid |

**u. Artikel Berita**

*Tabel 4.21 Uji Halaman Baca Berita*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Baca berita lengkap | Klik judul atau tombol baca selengkapnya | Muncul halaman artikel berita secara utuh | Berhasil dimuat | Valid |

---

## B. Daftar Pengujian Halaman Administrator

**a. Proses Login Admin**

*Tabel 4.22 Uji Fitur Login Pengelola*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Input login benar | Isi user `admin` dan password yang tepat | Sistem masuk ke halaman dashboard utama | Login sukses | Valid |
| 2 | Input login salah | Mengarang username atau sandi asal | Muncul notifikasi bahwa akses ditolak | Gagal masuk | Valid |

**b. Ringkasan Dashboard**

*Tabel 4.23 Uji Statistik Dashboard*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Cek total data | Masuk ke menu Beranda Admin | Angka statistik dosen, berita, dll muncul | Tampil otomatis | Valid |

**c. Pengelolaan Slider**

*Tabel 4.24 Uji Menu Kelola Slider*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah gambar slider | Klik tambah, pilih foto dan simpan | Gambar baru masuk ke tabel dan web depan | Berhasil ditambah | Valid |
| 2 | Hapus gambar slider | Klik tombol hapus pada baris gambar | Data terhapus dan file foto hilang dari host | Data hilang | Valid |

**d. Sambutan Dekan (Admin)**

*Tabel 4.25 Uji Update Sambutan Dekan*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Ganti teks sambutan | Edit narasi dekan lalu klik perbarui | Teks di halaman profil fakultas berubah | Berhasil diganti | Valid |

**e. Fakta Kampus**

*Tabel 4.26 Uji Kelola Fakta Kampus*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah poin fakta | Input nama fakta dan nominal angkanya | Data baru masuk ke daftar tabel fakta | Berhasil disimpan | Valid |
| 2 | Edit nilai fakta | Klik edit, ubah angka lalu simpan | Nominal angka berubah sesuai inputan baru | Nilai terupdate | Valid |
| 3 | Hapus poin fakta | Klik hapus pada salah satu baris data | Baris data fakta hilang dari database | Berhasil dihapus | Valid |

**f. Visi & Misi (Admin)**

*Tabel 4.27 Uji Kelola Visi Misi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah poin baru | Tulis teks visi/misi baru lalu klik simpan | Poin baru tampil di urutan tabel | Berhasil ditambah | Valid |
| 2 | Edit isi visi/misi | Ubah kata-kata pada poin visi misi lama | Teks visi misi berubah sesuai dengan ralat | Berhasil diubah | Valid |
| 3 | Hapus poin visi/misi | Klik tombol hapus pada salah satu poin | Data tersebut hilang dari pangkalan data | Sesuai harapan | Valid |

**g. Struktur Organisasi (Admin)**

*Tabel 4.28 Uji Update Struktur Organisasi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Ganti gambar struktur | Upload foto bagan baru dan klik Update | Bagan lama diganti dengan file foto terbaru | Sukses diganti | Valid |

**h. Kelola Data Dosen**

*Tabel 4.29 Uji Menu Kelola Dosen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pendaftaran dosen baru | Isi data lengkap dan upload foto dosen | Profil dosen tersimpan dan muncul di tabel | Berhasil ditambah | Valid |
| 2 | Perbaikan biodata | Klik edit, ubah gelar lalu klik Update | Data dosen terupdate tanpa merusak fotonya | Berhasil diperbarui | Valid |
| 3 | Penghapusan data | Klik hapus pada seorang dosen | Akun terhapus dan fotonya hilang dari server | Berhasil dihapus | Valid |

**i. Kelola Pendaftar PMB**

*Tabel 4.30 Uji Menu Kelola PMB*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Verifikasi pendaftar | Ganti status pendaftar menjadi "Diterima" | Warna label di tabel berubah menjadi hijau | Sesuai harapan | Valid |
| 2 | Lihat berkas ijazah | Klik tombol view berkas mahasiswa | Muncul gambar hasil scan ijazah pendaftar | Lampiran muncul | Valid |
| 3 | Hapus pendaftar gugur | Klik hapus pada baris mahasiswa yang ditolak | Seluruh data pendaftar hilang dari sistem | Berhasil dihapus | Valid |

**j. Kelola Kurikulum**

*Tabel 4.31 Uji Menu Kurikulum (Admin)*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Input kurikulum baru | Masukkan prodi dan upload file PDF silabus | Tabel kurikulum bertambah satu baris baru | Berhasil ditambah | Valid |
| 2 | Edit info kurikulum | Ubah judul atau upload file PDF pengganti | Data kurikulum terupdate dengan file baru | Sukses diupdate | Valid |
| 3 | Hapus kurikulum | Klik hapus pada baris kurikulum terkait | Data dan file fisiknya hilang dari folder host | Berhasil dihapus | Valid |

**k. Kelola Kalender Akademik**

*Tabel 4.32 Uji Manu Kalender*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Plot agenda baru | Isi nama agenda dan pilih tanggal di form | Event masuk ke tabel kalender akademik | Berhasil ditambah | Valid |
| 2 | Ralat jadwal acara | Klik edit, ganti tanggal lalu simpan | Tanggal acara berubah di tampilan kalender | Sesuai harapan | Valid |
| 3 | Bersihkan agenda | Klik hapus pada baris kegiatan lama | Agenda menghilang dari tampilan web | Berhasil dihapus | Valid |

**l. Kelola Sarana / Ruangan**

*Tabel 4.33 Uji Menu Inventaris Ruangan*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah aset gedung | Isi deskripsi ruang dan upload foto ruang | Unit fasilitas baru masuk dalam galeri web | Berhasil ditambah | Valid |
| 2 | Edit data ruangan | Ubah nama atau ganti foto gedung tersebut | Info sarana prasarana terupdate di depan | Berhasil diubah | Valid |
| 3 | Hapus data ruangan | Pilih tombol hapus pada unit gedung tadi | Data dan file fotonya lenyap dari sistem | Berhasil dihapus | Valid |

**m. Kelola Inventaris Laboratorium**

*Tabel 4.34 Uji Menu Inventaris Lab*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Input unit komputer | Masukkan spesifikasi alat dan jumlah unit | Daftar inventaris lab tersimpan di sistem | Berhasil disimpan | Valid |
| 2 | Update stok alat | Edit nominal jumlah alat yang tersedia | Angka jumlah unit terupdate di tabel | Hasil sesuai | Valid |
| 3 | Hapus baris peralatan | Klik hapus pada salah satu baris item lab | Item lab tersebut hilang dari daftar admin | Berhasil dihilangkan | Valid |

**n. Kelola Dokumen SOP**

*Tabel 4.35 Uji Kelola Dokumen SOP*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah file SOP | Upload PDF baru dan beri judul dokumen | Data tampil di tabel dokumen publik | Berhasil disimpan | Valid |
| 2 | Perbaikan judul SOP | Klik edit, ganti judul dokumen lalu simpan | Nama dokumen SOP berhasil diperbarui | Berhasil diubah | Valid |
| 3 | Penghapusan SOP | Pilih aksi hapus pada baris file SOP | Dokumen dan file PDF-nya hilang dari server | Berhasil dihapus | Valid |

**o. Kelola Rencana Strategis (Renstra)**

*Tabel 4.36 Uji Kelola Dokumen Renstra*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Masukkan draf Renstra | Isi nama dokumen dan lampirkan file draf | Berkas renstra tersimpan dan tampil di list | Berhasil ditambah | Valid |
| 2 | Ubah draf Renstra | Lakukan edit nama atau lampiran PDF baru | Data renstra terupdate dengan dokumen baru | Sukses diperbarui | Valid |
| 3 | Hapus draf Renstra | Klik tombol hapus pada baris renstra | Dokumen renstra terhapus secara permanen | Berhasil dihapus | Valid |

**p. Kelola Rencana Operasional (Renop)**

*Tabel 4.37 Uji Kelola Dokumen Renop*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Simpan file Renop | Tambahkan file PDF operasional baru | Berkas operasional tersimpan di database | Berhasil masuk | Valid |
| 2 | Ganti berkas Renop | Upload file PDF baru untuk menindih draf lama | File lama diganti dengan file versi terbaru | Berhasil diupdate | Valid |
| 3 | Hapus data Renop | Pilih tombol hapus pada baris renop | Data dan file PDF operasional hilang | Berhasil dihapus | Valid |

**q. Kelola Penelitian**

*Tabel 4.38 Uji Kelola Data Riset*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah riwayat riset | Input judul riset dan tempel alamat link sinta | Judul riset tampil di web depan admin | Berhasil ditambah | Valid |
| 2 | Ralat info penelitian | Edit teks pada judul yang salah ketik | Judul riset berubah sesuai hasil ralat | Sesuai harapan | Valid |
| 3 | Hapus riwayat riset | Klik hapus pada salah satu baris riset | Baris penelitian hilang dari daftar admin | Berhasil dihapus | Valid |

**r. Kelola Pengabdian**

*Tabel 4.39 Uji Kelola Data Pengabdian*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah log kegiatan | Isi instansi dan daerah lokasi penelitian | Data pengabdian masuk ke rekap log admin | Berhasil ditambah | Valid |
| 2 | Update log kegiatan | Ganti rincian lokasi atau tanggal acara | Info pengabdian terupdate sesuai laporan baru | Berhasil diubah | Valid |
| 3 | Buang log kegiatan | Klik hapus pada baris agenda pengabdian | Data menghilang dari pangkalan sistem | Berhasil dihapus | Valid |

**s. Kelola Profil BEM & UKM**

*Tabel 4.40 Uji Kelola Organisasi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah profil Ormawa | Masukkan nama UKM dan upload logonya | Profil organisasi baru tampil di web publik | Berhasil ditambah | Valid |
| 2 | Edit profil Ormawa | Update visi misi atau ganti foto pengurus | Info organisasi terupdate dengan data baru | Berhasil diubah | Valid |
| 3 | Hapus profil Ormawa | Klik tombol hapus pada baris organisasi | Organisasi tersebut hilang dari daftar | Berhasil dihapus | Valid |

**t. Kelola Artikel Berita**

*Tabel 4.41 Uji Kelola Berita Utama*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tulis postingan berita | Ketik judul, isi, dan pilih gambar sampul | Berita terbit di halaman beranda depan web | Berhasil diterbitkan | Valid |
| 2 | Ralat isi postingan | Edit teks berita yang sudah sempat terbit | Isi teks berita berubah sesuai hasil editan | Berhasil diubah | Valid |
| 3 | Hapus berita lama | Klik hapus pada postingan berita terkait | Berita hilang dan file sampulnya ikut terhapus | Berhasil dihapus | Valid |

**u. Kelola Kerjasama (MoU)**

*Tabel 4.42 Uji Kelola File Kerjasama*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Masukkan data mitra | Isi nama instansi dan upload draf MoU PDF | Data kerjasama tersimpan di tabel admin | Berhasil masuk | Valid |
| 2 | Update data mitra | Edit nama instansi atau lampirkan file PDF baru | Info mitra terupdate dengan dokumen terbaru | Berhasil diperbarui | Valid |
| 3 | Hapus data mitra | Klik tombol hapus pada mitra kerjasama terkait | Data dan file MoU-nya hilang dari pangkalan | Berhasil dihapus | Valid |

---

## 4.4.3 Kesimpulan Hasil Pengujian

Berdasarkan seluruh pengujian fungsional yang telah dilakukan terhadap **42 menu utama** sistem, maka dapat disimpulkan bahwa website FIKOM ini telah bebas dari hambatan teknis yang berarti. Seluruh manajemen data mulai dari pendaftaran hingga pengelolaan dokumen digital berjalan dengan baik melalui fungsi CRUD yang terintegrasi secara utuh antara halaman administrator dan halaman publik.
