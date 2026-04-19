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
| 1 | Otentikasi dengan kredensial valid | Memasukkan username `admin` dan password yang sesuai ke dalam form login | Sistem memvalidasi akun, membuat sesi (session), dan mengarahkan pengguna ke halaman dashboard utama | Akses diberikan dan diarahkan ke dashboard | Valid |
| 2 | Otentikasi dengan kredensial tidak valid | Memasukkan username/password yang salah atau mengosongkan kolom | Sistem menolak permintaan, menampilkan pesan error/notifikasi kegagalan, dan tetap berada di halaman login | Pesan kesalahan muncul, akses ditolak | Valid |

**b. Ringkasan Dashboard**

*Tabel 4.23 Uji Statistik Dashboard*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Verifikasi akumulasi data statistik | Mengakses antarmuka Dashboard utama | Sistem melakukan query data secara real-time dan menampilkan jumlah total dosen, pendaftar, berita, dan mitra kerjasama dalam bentuk widget | Metrik statistik tampil sesuai data di database | Valid |

**c. Pengelolaan Slider**

*Tabel 4.24 Uji Menu Kelola Slider*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Penambahan aset gambar pada slider | Memilih file gambar (.jpg/.png/webp) melalui tombol upload dan menyimpan data | File terunggah ke direktori server, direktori slider di basis data diperbarui, dan gambar tampil di carousel beranda | Data tersimpan dan gambar diperbarui | Valid |
| 2 | Manajemen status visibilitas slider | Menekan tombol toggle 'Aktifkan/Nonaktifkan' pada salah satu baris data slider | Status `is_active` di basis data berubah, dan gambar tersebut akan ditampilkan atau disembunyikan pada halaman publik | Status berhasil diperbarui secara dinamis | Valid |
| 3 | Penghapusan aset gambar slider | Menekan tombol hapus dan mengonfirmasi dialog validasi | Baris data dihapus dari database dan file fisik gambar di direktori `/uploads/slider/` ikut terhapus secara permanen | Data dan file berhasil dihilangkan | Valid |

**d. Sambutan Dekan (Admin)**

*Tabel 4.25 Uji Update Sambutan Dekan*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pembaruan konten narasi sambutan dekan | Mengubah teks pada editor narasi dan menekan tombol 'Perbarui' | Konten narasi pada tabel basis data diperbarui dan perubahan langsung tercermin pada halaman profil sambutan di sisi publik | Teks sambutan berhasil diperbarui | Valid |

**e. Fakta Kampus**

*Tabel 4.26 Uji Kelola Fakta Kampus*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Entri data metrik fakta kampus baru | Mengisi formulir tambah (judul fakta, jumlah angka, dan urutan tampil) | Data baru tersimpan di tabel `tb_fakta` dan urutan statistik di halaman beranda tersinkronisasi otomatis | Penambahan fakta berhasil dilakukan | Valid |
| 2 | Pembaruan informasi fakta kampus | Membuka modal edit, mengubah judul atau nominal angka fakta, lalu menekan tombol simpan | Nilai pada field terkait diperbarui di basis data dan tingkat akurasi data di halaman depan tetap terjaga | Informasi fakta berhasil diperbarui | Valid |

**f. Visi & Misi (Admin)**

*Tabel 4.27 Uji Kelola Visi Misi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pembaruan klausa visi utama | Mengubah teks pada area editor Visi dan menekan tombol 'Simpan Visi' | Rekaman data kategori 'Visi' pada tabel diperbarui, memastikan platform publik menampilkan visi terbaru | Visi utama berhasil diperbarui | Valid |
| 2 | Penambahan item Misi/Tujuan/Sasaran | Mengisi formulir tambah (teks konten dan urutan) pada kategori yang dipilih | Item baru ditambahkan ke dalam daftar deskripsi akademik fakultas dengan penomoran yang sesuai | Penambahan item berhasil dilakukan | Valid |
| 3 | Eliminasi item Misi/Tujuan/Sasaran | Menekan tombol hapus pada baris item yang tidak lagi relevan | Rekaman data dihapus dari basis data dan daftar pada tampilan profil publik langsung menyusut | Item berhasil dihapus secara permanen | Valid |

**g. Struktur Organisasi (Admin)**

*Tabel 4.28 Uji Update Struktur Organisasi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Re-upload dokumen bagan organisasi | Memilih file gambar bagan organisasi terbaru (.png/.jpg) dan menekan aksi 'Update' | File lama diganti dengan file baru di direktori server dan visualisasi struktur organisasi di halaman depan diperbarui | Gambar struktur berhasil diperbarui | Valid |

**h. Kelola Data Dosen**

*Tabel 4.29 Uji Menu Kelola Dosen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Registrasi data dosen baru | Mengisi formulir (NIDN, Nama, Prodi, Foto, dll) dan menekan 'Simpan' | Sistem melakukan validasi tipe file dan ukuran foto, menyimpan data di tabel `dosen`, dan menampilkan profil dosen di daftar pengajar | Registrasi berhasil dan profil dosen tampil | Valid |
| 2 | Pembaruan biodata/profil dosen | Mengakses fitur edit, memodifikasi informasi (seperti gelar atau jabatan), lalu menekan 'Update' | Rekaman data diperbarui di basis data tanpa merusak atau menghilangkan file foto yang sudah ada sebelumnya | Informasi dosen berhasil diperbarui | Valid |
| 3 | Eliminasi permanen data dosen | Menekan tombol hapus pada baris data dosen terpilih | Data dihapus dari sistem dan file foto di direktori `/uploads/dosen/` ikut dihapus untuk efisiensi ruang penyimpanan | Data dan aset digital berhasil dihapus | Valid |

**i. Kelola Pendaftar PMB**

*Tabel 4.30 Uji Menu Kelola PMB*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Modifikasi status pendaftaran mahasiswa | Mengubah dropdown status menjadi 'Diterima' atau 'Ditolak' pada antarmuka manajemen PMB | Status pendaftar diperbarui di basis data, dan label indikator warna pada tabel berubah secara dinamis | Status diperbarui dengan indikator warna | Valid |
| 2 | Verifikasi lampiran dokumen pendaftar | Menekan icon mata (view) pada baris data pendaftar | Sistem menampilkan modal detail yang berisi informasi lengkap serta preview dokumen hasil scan (KTP/Ijazah) | Detail dan lampiran muncul dengan benar | Valid |
| 3 | Penghapusan catatan pendaftar | Menekan aksi hapus pada data pendaftar | Seluruh record pendaftar beserta lampiran file fisiknya di server dihapus secara permanen dari sistem | Data pendaftaran berhasil dieliminasi | Valid |

**j. Kelola Kurikulum**

*Tabel 4.31 Uji Menu Kurikulum (Admin)*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Publikasi kurikulum program studi | Memilih program studi dan mengunggah dokumen silabus berformat PDF | Rekaman data tersimpan, file terarsip di server, dan muncul sebagai baris baru di tabel kurikulum publik | Dokumen berhasil dipublikasikan | Valid |
| 2 | Pembaruan berkas/informasi kurikulum | Melakukan edit pada judul atau mengunggah file PDF versi terbaru sebagai pengganti | Judul diperbarui dan file lama di server digantikan secara otomatis oleh file versi terbaru | Konten kurikulum berhasil diupdate | Valid |
| 3 | Penghapusan data kurikulum | Menekan tombol hapus pada item kurikulum tertentu | Record data dihapus dari database dan file fisik PDF dibersihkan dari direktori penyimpanan server | Data dan file berhasil dieliminasi | Valid |

**k. Kelola Kalender Akademik**

*Tabel 4.32 Uji Manu Kalender*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Penjadwalan agenda akademik baru | Mengisi formulir (nama event dan tanggal) pada antarmuka kelola kalender | Data agenda tersimpan di tabel `tb_kalender` dan muncul pada visualisasi kalender/tabel di halaman depan | Agenda akademik berhasil dijadwalkan | Valid |
| 2 | Penyesuaian jadwal/konten agenda | Mengakses fitur edit, mengubah detail acara atau tanggal pelaksanaan, lalu menyimpan perubahan | Detail agenda diperbarui di sistem, memastikan informasi yang diterima mahasiswa tetap akurat | Informasi agenda berhasil disesuaikan | Valid |
| 3 | Eliminasi agenda akademik | Menekan aksi hapus pada baris kegiatan yang sudah selesai atau dibatalkan | Baris data dihapus secara permanen dari basis data dan daftar aktif di sistem publik | Agenda berhasil dibersihkan dari sistem | Valid |

**l. Kelola Sarana / Ruangan**

*Tabel 4.33 Uji Menu Inventaris Ruangan*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Penambahan database inventaris ruangan | Mengisi deskripsi fasilitas ruangan dan mengunggah foto representatif | Unit sarana baru ditambahkan ke galeri fasilitas fakultas di halaman depan | Aset ruangan berhasil didaftarkan | Valid |
| 2 | Modifikasi informasi sarana prasarana | Mengubah detail nama ruangan atau mengganti aset foto melalui fitur edit | Sinkronisasi data berhasil, menampilkan informasi sarana terbaru kepada seluruh pengunjung | Informasi sarana berhasil diperbarui | Valid |
| 3 | Penghapusan aset inventaris ruangan | Menekan tombol hapus pada unit gedung/ruangan tertentu | Menghapus record dari basis data dan menghapus file foto dari server untuk menjaga integritas data | Data sarana berhasil dieliminasi | Valid |

**m. Kelola Inventaris Laboratorium**

*Tabel 4.34 Uji Menu Inventaris Lab*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pendataan unit peralatan laboratorium | Menginput spesifikasi teknis dan kuantitas unit peralatan yang tersedia | Daftar inventaris tersimpan di sistem, memudahkan pemantauan ketersediaan alat praktikum | Data peralatan berhasil disimpan | Valid |
| 2 | Sinkronisasi volume stok peralatan | Melakukan penyesuaian (update) pada nominal angka jumlah unit yang tersedia | Menghasilkan angka akumulasi terbaru pada tabel inventaris laboratorium | Stok peralatan berhasil diperbarui | Valid |
| 3 | Eliminasi item inventaris laboratorium | Menekan aksi hapus pada baris item peralatan yang sudah tidak aktif | Record item dihapus dari pangkalan data sistem informasi laboratorium | Item inventaris berhasil dihilangkan | Valid |

**n. Kelola Dokumen SOP**

*Tabel 4.35 Uji Kelola Dokumen SOP*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Publikasi dokumen operasional (SOP) | Mengunggah file PDF dan memberikan judul formal pada dokumen | Dokumen dipetakan ke dalam daftar publik dan dapat diakses/diunduh oleh pengguna berwenang | Penambahan dokumen berhasil dilakukan | Valid |
| 2 | Revisi nomenklatur dokumen SOP | Mengubah judul dokumen melalui antarmuka edit dan memvalidasi perubahan | Nama dokumen diperbarui secara instan di seluruh antarmuka yang merujuk pada file tersebut | Judul SOP berhasil diperbarui | Valid |
| 3 | Eliminasi dokumen SOP | Menekan kontrol hapus pada baris file SOP yang tidak lagi berlaku| Record dihapus dan file PDF di server dibersihkan secara otomatis | Dokumen berhasil dihapus secara permanen | Valid |

**o. Kelola Rencana Strategis (Renstra)**

*Tabel 4.36 Uji Kelola Dokumen Renstra*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pengarsipan dokumen Renstra | Mengisi judul dokumen dan melampirkan berkas PDF rencana strategis | Sistem memvalidasi input, mengunggah file ke direktori server, dan menampilkan data pada list dokumen akademik | Berkas Renstra berhasil diarsipkan | Valid |
| 2 | Pembaruan data/berkas Renstra | Melakukan revisi pada judul atau mengunggah draf PDF terbaru melalui modul edit | Informasi metadata diperbarui dan file PDF lama diganti dengan versi terbaru secara atomik | Data Renstra berhasil diperbarui | Valid |
| 3 | Eliminasi dokumen Renstra | Menekan tombol hapus pada baris data Renstra yang dipilih | Record dihapus dari tabel basis data dan file fisik dibersihkan dari storage server | Dokumen berhasil dihapus secara permanen | Valid |

**p. Kelola Rencana Operasional (Renop)**

*Tabel 4.37 Uji Kelola Dokumen Renop*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Registrasi dokumen rencana operasional | Mengunggah file PDF operasional baru beserta klasifikasi judulnya | File terenkripsi/tersimpan di server dan record data muncul pada antarmuka manajemen dokumen | Berkas operasional berhasil diregistrasi | Valid |
| 2 | Sinkronisasi revisi dokumen Renop | Mengunggah file PDF pengganti untuk memperbarui draf operasional yang sudah ada | Sistem menimpa file lama dengan file versi terbaru dan memperbarui timestamp modifikasi | Berkas berhasil diperbarui | Valid |
| 3 | Eliminasi record dokumen Renop | Menekan aksi hapus pada baris dokumen operasional terkait | Menghapus keterkaitan data di database serta menghapus file fisik PDF dari storage | Data dan file berhasil dieliminasi | Valid |

**q. Kelola Penelitian**

*Tabel 4.38 Uji Kelola Data Riset*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pendataan rekam jejak penelitian | Menginput judul riset dan tautan URL (seperti Sinta/Google Scholar) | Judul penelitian terdaftar dalam sistem dan link referensi dapat diakses melalui antarmuka publik | Riwayat riset berhasil didaftarkan | Valid |
| 2 | Koreksi metadata publikasi riset | Melakukan perbaikan pada tipografi judul atau pembaruan tautan URL penelitian | Informasi riset diperbarui di basis data, memastikan akurasi data referensi akademik | Informasi riset berhasil diperbaiki | Valid |
| 3 | Eliminasi catatan publikasi riset | Menekan kontrol hapus pada salah satu baris riwayat penelitian | Record penelitian dihilangkan dari tabel manajemen riset dan tampilan publik | Baris penelitian berhasil dihapus | Valid |

**r. Kelola Pengabdian**

*Tabel 4.39 Uji Kelola Data Pengabdian*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pencatatan log pengabdian masyarakat | Mengisi informasi instansi mitra, lokasi daerah, dan deskripsi kegiatan | Data log ditambahkan ke dalam sistem rekapitulasi pengabdian dosen | Log kegiatan berhasil dicatatkan | Valid |
| 2 | Pembaruan rincian log pengabdian | Memodifikasi detail lokasi atau tanggal pelaksanaan kegiatan melalui fitur edit | Informasi rekapitulasi diperbarui, menyajikan laporan pengabdian yang akurat dan mutakhir | Detail log berhasil diperbarui | Valid |
| 3 | Eliminasi log kegiatan pengabdian | Menekan aksi hapus pada baris agenda pengabdian yang dipilih | Record pengabdian dieliminasi dari basis data sistem informasi riset dan pengabdian | Log data berhasil dihilangkan | Valid |

**s. Kelola Profil BEM & UKM**

*Tabel 4.40 Uji Kelola Organisasi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Registrasi profil organisasi mahasiswa | Menginput nama UKM/BEM, visi-misi, dan mengunggah aset logo/foto pengurus | Profil organisasi terdaftar dipetakan ke halaman kemahasiswaan dengan visualisasi yang lengkap | Profil organisasi berhasil diregistrasi | Valid |
| 2 | Pembaruan informasi/struktur organisasi | Melakukan update pada konten profil atau mengganti aset citra visual pengurus | Sinkronisasi data berhasil, memperbarui profil organisasi di antarmuka publik secara real-time | Konten profil organisasi berhasil diperbarui | Valid |
| 3 | Eliminasi permanen profil organisasi | Menekan tombol hapus pada baris data organisasi mahasiswa tertentu | Record dan seluruh aset gambar yang terkait dihapus dari server dan pangkalan data | Data organisasi berhasil dihapus | Valid |

**t. Kelola Artikel Berita**

*Tabel 4.41 Uji Kelola Berita Utama*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Publikasi artikel berita utama | Menginput judul, kategori, tanggal, konten, dan mengunggah gambar sampul | Artikel terbit di sistem, dipetakan ke halaman beranda dan detail berita dengan format yang rapi | Berita berhasil diterbitkan secara publik | Valid |
| 2 | Revisi konten/redaksional berita | Melakukan pengeditan pada teks berita atau mengganti gambar sampul melalui modul edit | Perubahan redaksional tersimpan dan tampilan artikel di sisi publik langsung diperbarui | Isi berita berhasil diperbarui | Valid |
| 3 | Eliminasi artikel berita lama | Menekan tombol hapus pada baris berita yang dipilih | Record berita dihapus dan file gambar sampul dibersihkan dari direktori `/uploads/berita/` | Artikel berhasil dihapus permanen | Valid |

**u. Kelola Kerjasama (MoU)**

*Tabel 4.42 Uji Kelola File Kerjasama*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Registrasi mitra kerjasama (Partner) | Input nama instansi, link website, bulan/tahun kerjasama, dan mengunggah logo mitra | Data partner tersimpan dan logo tampil pada dynamic carousel di halaman beranda | Mitra kerjasama berhasil diregistrasi | Valid |
| 2 | Pembaruan metadata/logo mitra | Melakukan update pada informasi instansi atau mengganti file logo mitra | Informasi partner disinkronkan dan visualisasi logo pada carousel diperbarui | Data partner berhasil diperbarui | Valid |
| 3 | Eliminasi keterkaitan mitra | Menekan tombol hapus pada baris mitra kerjasama terpilih | Record kemitraan dihapus dan file logo di server dibersihkan secara permanen | Data mitra berhasil dieliminasi | Valid |

**v. Tentang Fakultas**

*Tabel 4.43 Uji Update Tentang Fakultas*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Sinkronisasi informasi profil fakultas | Memodifikasi teks deskripsi 'Tentang Kami' dan mengganti aset gambar representatif | Konten naratif dan visual pada landing page beranda diperbarui secara real-time | Informasi fakultas berhasil diperbarui | Valid |

**w. Pengaturan Profil Admin**

*Tabel 4.44 Uji Pengaturan Profil*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pembaruan kredensial profil pengelola | Mengubah username atau email pada antarmuka pengaturan profil | Metadata akun admin diperbarui di sistem, data session diperbarui secara otomatis | Profil admin berhasil diperbarui | Valid |
| 2 | Modifikasi otentikasi (Ganti Password) | Memasukkan password lama sebagai validasi, diikuti dengan entri password baru | Kata sandi di-hash ulang dan diperbarui di database, memastikan keamanan akses tetap terjaga | Password berhasil diubah | Valid |

---

## 4.4.3 Kesimpulan Hasil Pengujian

Berdasarkan seluruh pengujian fungsional yang telah dilakukan terhadap **44 menu utama** sistem (termasuk profil dan informasi fakultas), maka dapat disimpulkan bahwa website FIKOM ini telah bebas dari hambatan teknis yang berarti. Seluruh manajemen data mulai dari pendaftaran hingga pengelolaan dokumen digital berjalan dengan baik melalui fungsi CRUD yang terintegrasi secara utuh antara halaman administrator dan halaman publik.
