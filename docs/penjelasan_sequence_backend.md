# Kumpulan Penjelasan Alur Backend

## Sequence Diagram: Login Administrator (Web FIKOM)
Berikut rincian alur proses saat login admin dieksekusi:

1. **Mengunjungi Halaman Pintu Masuk**: 
   Awalnya, pengguna menapak pada `admin/login` untuk membuka formulir. Pintu panel sekadar menyediakan dua masukan: isian *Username* dan *Password*.

2. **Upaya Penyesuaian Sandi Layar**: 
   - Admin melengkapi data isian kredensial akun (*Username* bersanding *Password*), lantas mengeksekusinya di atas bingkai persetujuan tombol **"Login"**.
   - Input diserahkan mutlak pada skrip pos *backend*.
   - Kueri pemeriksaan sinkron dibangkitkan sistem kepada lapis memori *Database* MySQL untuk mengecek apakah kata sandinya cocok dan username dikenali.

3. **Deklarasi Penerimaan / Penolakan**:
   - Jika kombinasi Username atau Password salah, secara instan gerbang memantulkan peramban ke halaman yang sama. Halaman login menyajikan gertakan status peringatan bahwa "Password atau Akun salah".
   - Pengecualian telak didapat andai kata kecocokan sandi dibenarkan. Sistem membagikan identitas Kunci Sesi (*Session Key Login Aktif*) ke peramban. 
   - Pemandu diubah (mengalami *redirect*) agar admin dapat mendaratkan langkah suksesnya melenggang ke ruangan kendali peladen *Dashboard Utama* situs.

## Sequence Diagram: Kelola Slider Beranda (Admin Web FIKOM)
Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Slider Beranda:

1. **Melihat Daftar Data**:
   Saat admin membuka menu "Kelola Slider Beranda", sistem akan langsung mengambil semua data yang tersimpan di *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Data**:
   - Ketika admin menekan tombol **Tambah** atau **Edit**, muncul formulir isian. Admin memasukkan Teks Judul Utama, Subjudul Pendek dan mengunggah Foto Pemandangan Kampus (Slider).
   - Setelah menekan tombol **Simpan**, data dikirimkan ke sistem pengendali (PHP).
   - Sistem akan mengecek apakah format file benar dan ukurannya tidak terlalu besar.
   - Jika valid, sistem menyimpan file fisik tersebut ke dalam folder penyimpanan server (`/uploads/slider`).
   - Khusus untuk **Edit**, sistem akan mendeteksi keberadaan file lama milik data tersebut dan otomatis menghapusnya agar memori (*storage*) tidak penuh.
   - Setelah file tersimpan, sistem menyisipkan (menyimpan) rincian dari form teks admin beserta rujukan penamaan file tadi secara permanen ke dalam *Database*.
   - Terakhir, halaman memuat ulang (di-*refresh*) dan tabel tampil dengan memunculkan pesan Sukses kepada sang Admin.

3. **Proses Hapus Data**:
   - Jika tombol / ikon **Hapus** diklik pada salah satu baris, sistem akan mendedah referensi nama Foto Pemandangan Kampus (Slider) yang dimilikinya.
   - Sistem lalu menghapus file fisik tersebut langsung dari folder server (`/uploads/slider`).
   - Setelah fisik fail dihapus bersih, sistem menghapus seutuhnya jejak baris rekam data tersebut dari *Database*.
   - Tabel dimuat ulang tanpa memunculkan baris data yang dihapus tadi, disertai pesan notifikasi keberhasilan operasional.

## Sequence Diagram: Kelola Berita (Admin Web FIKOM)
Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Berita:

1. **Melihat Daftar Berita**: 
   Saat admin membuka menu "Kelola Berita", sistem akan langsung mengambil semua data berita yang tersimpan di dalam *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Berita**: 
   - Ketika admin menekan tombol **Tambah** atau **Edit**, formulir isian akan muncul. Admin memasukkan Judul, Isi Berita, dan mengunggah Foto Sampul (*Cover*).
   - Setelah admin menekan tombol **Simpan**, data tersebut dikirimkan ke sistem (*Controller / PHP*).
   - Sistem akan mengecek apakah foto yang diunggah memiliki format yang benar (misalnya `.jpg` atau `.png`) dan ukurannya tidak terlalu besar.
   - Jika foto valid, sistem akan memindahkan file foto tersebut ke dalam folder penyimpanan server (`/uploads`).
   - Khusus untuk proses **Edit**, sistem akan otomatis mencari file foto berita yang lama di dalam server dan menghapusnya agar memori tidak penuh.
   - Setelah foto tersimpan, judul dan isi berita berserta nama file fotonya akan dimasukkan dan dirangkum secara permanen ke dalam *Database*.
   - Terakhir, sistem akan mengembalikan (*redirect*) tampilan layar ke tabel berita dengan memunculkan pesan pop-up sukses.

3. **Proses Hapus Berita**:
   - Jika admin menekan tombol **Hapus** pada salah satu berita, sistem akan mencari tahu letak penyimpanan file foto sampul berita tersebut.
   - Sistem segera menghapus file fisik foto tersebut secara langsung dari folder server.
   - Setelah fotonya lenyap, sistem lalu menghapus baris tulisan beritanya dari *Database*.
   - Tampilan akan ditutup dengan kembalinya admin ke layar tabel berita yang membawa pesan konfirmasi bahwa data sudah musnah.

## Sequence Diagram: Kelola Dosen (Admin Web FIKOM)
Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Dosen:

1. **Melihat Daftar Data**:
   Saat admin membuka menu "Kelola Dosen", sistem akan langsung mengambil semua data yang tersimpan di *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Data**:
   - Ketika admin menekan tombol **Tambah** atau **Edit**, muncul formulir isian. Admin memasukkan Nama, NIDN, Jabatan Akademik dan mengunggah Foto Profil.
   - Setelah menekan tombol **Simpan**, data dikirimkan ke sistem pengendali (PHP).
   - Sistem akan mengecek apakah format file benar dan ukurannya tidak terlalu besar.
   - Jika valid, sistem menyimpan file fisik tersebut ke dalam folder penyimpanan server (`/uploads/dosen`).
   - Khusus untuk **Edit**, sistem akan mendeteksi keberadaan file lama milik data tersebut dan otomatis menghapusnya agar memori (*storage*) tidak penuh.
   - Setelah file tersimpan, sistem menyisipkan (menyimpan) rincian dari form teks admin beserta rujukan penamaan file tadi secara permanen ke dalam *Database*.
   - Terakhir, halaman memuat ulang (di-*refresh*) dan tabel tampil dengan memunculkan pesan Sukses kepada sang Admin.

3. **Proses Hapus Data**:
   - Jika tombol / ikon **Hapus** diklik pada salah satu baris, sistem akan mendedah referensi nama Foto Profil yang dimilikinya.
   - Sistem lalu menghapus file fisik tersebut langsung dari folder server (`/uploads/dosen`).
   - Setelah fisik fail dihapus bersih, sistem menghapus seutuhnya jejak baris rekam data tersebut dari *Database*.
   - Tabel dimuat ulang tanpa memunculkan baris data yang dihapus tadi, disertai pesan notifikasi keberhasilan operasional.

## Sequence Diagram: Kelola Fasilitas Ruangan (Admin Web FIKOM)
Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Fasilitas Ruangan:

1. **Melihat Daftar Data**:
   Saat admin membuka menu "Kelola Fasilitas Ruangan", sistem akan langsung mengambil semua data yang tersimpan di *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Data**:
   - Ketika admin menekan tombol **Tambah** atau **Edit**, muncul formulir isian. Admin memasukkan Nama Ruang, Kapasitas, Fasilitas dan mengunggah Foto Kelas/Ruangan.
   - Setelah menekan tombol **Simpan**, data dikirimkan ke sistem pengendali (PHP).
   - Sistem akan mengecek apakah format file benar dan ukurannya tidak terlalu besar.
   - Jika valid, sistem menyimpan file fisik tersebut ke dalam folder penyimpanan server (`/uploads/ruangan`).
   - Khusus untuk **Edit**, sistem akan mendeteksi keberadaan file lama milik data tersebut dan otomatis menghapusnya agar memori (*storage*) tidak penuh.
   - Setelah file tersimpan, sistem menyisipkan (menyimpan) rincian dari form teks admin beserta rujukan penamaan file tadi secara permanen ke dalam *Database*.
   - Terakhir, halaman memuat ulang (di-*refresh*) dan tabel tampil dengan memunculkan pesan Sukses kepada sang Admin.

3. **Proses Hapus Data**:
   - Jika tombol / ikon **Hapus** diklik pada salah satu baris, sistem akan mendedah referensi nama Foto Kelas/Ruangan yang dimilikinya.
   - Sistem lalu menghapus file fisik tersebut langsung dari folder server (`/uploads/ruangan`).
   - Setelah fisik fail dihapus bersih, sistem menghapus seutuhnya jejak baris rekam data tersebut dari *Database*.
   - Tabel dimuat ulang tanpa memunculkan baris data yang dihapus tadi, disertai pesan notifikasi keberhasilan operasional.

## Sequence Diagram: Kelola Fasilitas Laboratorium (Admin Web FIKOM)
Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Fasilitas Laboratorium:

1. **Melihat Daftar Data**:
   Saat admin membuka menu "Kelola Fasilitas Laboratorium", sistem akan langsung mengambil semua data yang tersimpan di *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Data**:
   - Ketika admin menekan tombol **Tambah** atau **Edit**, muncul formulir isian. Admin memasukkan Nama Lab, Daftar Inventaris Peralatan dan mengunggah Foto Laboratorium.
   - Setelah menekan tombol **Simpan**, data dikirimkan ke sistem pengendali (PHP).
   - Sistem akan mengecek apakah format file benar dan ukurannya tidak terlalu besar.
   - Jika valid, sistem menyimpan file fisik tersebut ke dalam folder penyimpanan server (`/uploads/laboratorium`).
   - Khusus untuk **Edit**, sistem akan mendeteksi keberadaan file lama milik data tersebut dan otomatis menghapusnya agar memori (*storage*) tidak penuh.
   - Setelah file tersimpan, sistem menyisipkan (menyimpan) rincian dari form teks admin beserta rujukan penamaan file tadi secara permanen ke dalam *Database*.
   - Terakhir, halaman memuat ulang (di-*refresh*) dan tabel tampil dengan memunculkan pesan Sukses kepada sang Admin.

3. **Proses Hapus Data**:
   - Jika tombol / ikon **Hapus** diklik pada salah satu baris, sistem akan mendedah referensi nama Foto Laboratorium yang dimilikinya.
   - Sistem lalu menghapus file fisik tersebut langsung dari folder server (`/uploads/laboratorium`).
   - Setelah fisik fail dihapus bersih, sistem menghapus seutuhnya jejak baris rekam data tersebut dari *Database*.
   - Tabel dimuat ulang tanpa memunculkan baris data yang dihapus tadi, disertai pesan notifikasi keberhasilan operasional.

## Sequence Diagram: Kelola Kalender Akademik (Admin Web FIKOM)
Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Kalender Akademik:

1. **Melihat Daftar Data**:
   Saat admin membuka menu "Kelola Kalender Akademik", sistem akan langsung mengambil semua data yang tersimpan di *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Data**:
   - Ketika admin menekan tombol **Tambah** atau **Edit**, muncul formulir isian. Admin memasukkan Tahun Akademik, Deskripsi dan mengunggah Gambar Kalender.
   - Setelah menekan tombol **Simpan**, data dikirimkan ke sistem pengendali (PHP).
   - Sistem akan mengecek apakah format file benar dan ukurannya tidak terlalu besar.
   - Jika valid, sistem menyimpan file fisik tersebut ke dalam folder penyimpanan server (`/uploads/kalender`).
   - Khusus untuk **Edit**, sistem akan mendeteksi keberadaan file lama milik data tersebut dan otomatis menghapusnya agar memori (*storage*) tidak penuh.
   - Setelah file tersimpan, sistem menyisipkan (menyimpan) rincian dari form teks admin beserta rujukan penamaan file tadi secara permanen ke dalam *Database*.
   - Terakhir, halaman memuat ulang (di-*refresh*) dan tabel tampil dengan memunculkan pesan Sukses kepada sang Admin.

3. **Proses Hapus Data**:
   - Jika tombol / ikon **Hapus** diklik pada salah satu baris, sistem akan mendedah referensi nama Gambar Kalender yang dimilikinya.
   - Sistem lalu menghapus file fisik tersebut langsung dari folder server (`/uploads/kalender`).
   - Setelah fisik fail dihapus bersih, sistem menghapus seutuhnya jejak baris rekam data tersebut dari *Database*.
   - Tabel dimuat ulang tanpa memunculkan baris data yang dihapus tadi, disertai pesan notifikasi keberhasilan operasional.

## Sequence Diagram: Kelola Dokumen Kurikulum (Admin Web FIKOM)
Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Dokumen Kurikulum:

1. **Melihat Daftar Data**:
   Saat admin membuka menu "Kelola Dokumen Kurikulum", sistem akan langsung mengambil semua data yang tersimpan di *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Data**:
   - Ketika admin menekan tombol **Tambah** atau **Edit**, muncul formulir isian. Admin memasukkan Judul, Deskripsi Kurikulum dan mengunggah Dokumen Asli (Format PDF/DOC).
   - Setelah menekan tombol **Simpan**, data dikirimkan ke sistem pengendali (PHP).
   - Sistem akan mengecek apakah format file benar dan ukurannya tidak terlalu besar.
   - Jika valid, sistem menyimpan file fisik tersebut ke dalam folder penyimpanan server (`/docs/kurikulum`).
   - Khusus untuk **Edit**, sistem akan mendeteksi keberadaan file lama milik data tersebut dan otomatis menghapusnya agar memori (*storage*) tidak penuh.
   - Setelah file tersimpan, sistem menyisipkan (menyimpan) rincian dari form teks admin beserta rujukan penamaan file tadi secara permanen ke dalam *Database*.
   - Terakhir, halaman memuat ulang (di-*refresh*) dan tabel tampil dengan memunculkan pesan Sukses kepada sang Admin.

3. **Proses Hapus Data**:
   - Jika tombol / ikon **Hapus** diklik pada salah satu baris, sistem akan mendedah referensi nama Dokumen Asli (Format PDF/DOC) yang dimilikinya.
   - Sistem lalu menghapus file fisik tersebut langsung dari folder server (`/docs/kurikulum`).
   - Setelah fisik fail dihapus bersih, sistem menghapus seutuhnya jejak baris rekam data tersebut dari *Database*.
   - Tabel dimuat ulang tanpa memunculkan baris data yang dihapus tadi, disertai pesan notifikasi keberhasilan operasional.

## Sequence Diagram: Kelola Mitra Kerjasama (Admin Web FIKOM)
Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Mitra Kerjasama:

1. **Melihat Daftar Data**:
   Saat admin membuka menu "Kelola Mitra Kerjasama", sistem akan langsung mengambil semua data yang tersimpan di *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Data**:
   - Ketika admin menekan tombol **Tambah** atau **Edit**, muncul formulir isian. Admin memasukkan Nama Mitra, Deskripsi MoU dan mengunggah Logo Kemitraan.
   - Setelah menekan tombol **Simpan**, data dikirimkan ke sistem pengendali (PHP).
   - Sistem akan mengecek apakah format file benar dan ukurannya tidak terlalu besar.
   - Jika valid, sistem menyimpan file fisik tersebut ke dalam folder penyimpanan server (`/uploads/kerjasama`).
   - Khusus untuk **Edit**, sistem akan mendeteksi keberadaan file lama milik data tersebut dan otomatis menghapusnya agar memori (*storage*) tidak penuh.
   - Setelah file tersimpan, sistem menyisipkan (menyimpan) rincian dari form teks admin beserta rujukan penamaan file tadi secara permanen ke dalam *Database*.
   - Terakhir, halaman memuat ulang (di-*refresh*) dan tabel tampil dengan memunculkan pesan Sukses kepada sang Admin.

3. **Proses Hapus Data**:
   - Jika tombol / ikon **Hapus** diklik pada salah satu baris, sistem akan mendedah referensi nama Logo Kemitraan yang dimilikinya.
   - Sistem lalu menghapus file fisik tersebut langsung dari folder server (`/uploads/kerjasama`).
   - Setelah fisik fail dihapus bersih, sistem menghapus seutuhnya jejak baris rekam data tersebut dari *Database*.
   - Tabel dimuat ulang tanpa memunculkan baris data yang dihapus tadi, disertai pesan notifikasi keberhasilan operasional.

## Sequence Diagram: Kelola Data Penelitian (Admin Web FIKOM)
Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Data Penelitian:

1. **Melihat Daftar Data**:
   Saat admin membuka menu "Kelola Data Penelitian", sistem akan langsung mengambil semua data yang tersimpan di *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Data**:
   - Ketika admin menekan tombol **Tambah** atau **Edit**, muncul formulir isian. Admin memasukkan Judul Riset, Abstrak Singkat dan mengunggah Dokumen / Laporan Publikasi (PDF/DOC).
   - Setelah menekan tombol **Simpan**, data dikirimkan ke sistem pengendali (PHP).
   - Sistem akan mengecek apakah format file benar dan ukurannya tidak terlalu besar.
   - Jika valid, sistem menyimpan file fisik tersebut ke dalam folder penyimpanan server (`/docs/penelitian`).
   - Khusus untuk **Edit**, sistem akan mendeteksi keberadaan file lama milik data tersebut dan otomatis menghapusnya agar memori (*storage*) tidak penuh.
   - Setelah file tersimpan, sistem menyisipkan (menyimpan) rincian dari form teks admin beserta rujukan penamaan file tadi secara permanen ke dalam *Database*.
   - Terakhir, halaman memuat ulang (di-*refresh*) dan tabel tampil dengan memunculkan pesan Sukses kepada sang Admin.

3. **Proses Hapus Data**:
   - Jika tombol / ikon **Hapus** diklik pada salah satu baris, sistem akan mendedah referensi nama Dokumen / Laporan Publikasi (PDF/DOC) yang dimilikinya.
   - Sistem lalu menghapus file fisik tersebut langsung dari folder server (`/docs/penelitian`).
   - Setelah fisik fail dihapus bersih, sistem menghapus seutuhnya jejak baris rekam data tersebut dari *Database*.
   - Tabel dimuat ulang tanpa memunculkan baris data yang dihapus tadi, disertai pesan notifikasi keberhasilan operasional.

## Sequence Diagram: Kelola Data Pengabdian (Admin Web FIKOM)
Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Data Pengabdian:

1. **Melihat Daftar Data**:
   Saat admin membuka menu "Kelola Data Pengabdian", sistem akan langsung mengambil semua data yang tersimpan di *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Data**:
   - Ketika admin menekan tombol **Tambah** atau **Edit**, muncul formulir isian. Admin memasukkan Judul Kegiatan Pengabdian, Ringkasan dan mengunggah Laporan Dokumentasi (PDF/DOC).
   - Setelah menekan tombol **Simpan**, data dikirimkan ke sistem pengendali (PHP).
   - Sistem akan mengecek apakah format file benar dan ukurannya tidak terlalu besar.
   - Jika valid, sistem menyimpan file fisik tersebut ke dalam folder penyimpanan server (`/docs/pengabdian`).
   - Khusus untuk **Edit**, sistem akan mendeteksi keberadaan file lama milik data tersebut dan otomatis menghapusnya agar memori (*storage*) tidak penuh.
   - Setelah file tersimpan, sistem menyisipkan (menyimpan) rincian dari form teks admin beserta rujukan penamaan file tadi secara permanen ke dalam *Database*.
   - Terakhir, halaman memuat ulang (di-*refresh*) dan tabel tampil dengan memunculkan pesan Sukses kepada sang Admin.

3. **Proses Hapus Data**:
   - Jika tombol / ikon **Hapus** diklik pada salah satu baris, sistem akan mendedah referensi nama Laporan Dokumentasi (PDF/DOC) yang dimilikinya.
   - Sistem lalu menghapus file fisik tersebut langsung dari folder server (`/docs/pengabdian`).
   - Setelah fisik fail dihapus bersih, sistem menghapus seutuhnya jejak baris rekam data tersebut dari *Database*.
   - Tabel dimuat ulang tanpa memunculkan baris data yang dihapus tadi, disertai pesan notifikasi keberhasilan operasional.

## Sequence Diagram: Kelola Dokumen Fakultas (Admin Web FIKOM)
Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Dokumen Fakultas:

1. **Melihat Daftar Data**:
   Saat admin membuka menu "Kelola Dokumen Fakultas", sistem akan langsung mengambil semua data yang tersimpan di *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Data**:
   - Ketika admin menekan tombol **Tambah** atau **Edit**, muncul formulir isian. Admin memasukkan Judul, Teks Deskriptif Panduan dan mengunggah Dokumen Publikasi (PDF/DOC).
   - Setelah menekan tombol **Simpan**, data dikirimkan ke sistem pengendali (PHP).
   - Sistem akan mengecek apakah format file benar dan ukurannya tidak terlalu besar.
   - Jika valid, sistem menyimpan file fisik tersebut ke dalam folder penyimpanan server (`/docs/fakultas`).
   - Khusus untuk **Edit**, sistem akan mendeteksi keberadaan file lama milik data tersebut dan otomatis menghapusnya agar memori (*storage*) tidak penuh.
   - Setelah file tersimpan, sistem menyisipkan (menyimpan) rincian dari form teks admin beserta rujukan penamaan file tadi secara permanen ke dalam *Database*.
   - Terakhir, halaman memuat ulang (di-*refresh*) dan tabel tampil dengan memunculkan pesan Sukses kepada sang Admin.

3. **Proses Hapus Data**:
   - Jika tombol / ikon **Hapus** diklik pada salah satu baris, sistem akan mendedah referensi nama Dokumen Publikasi (PDF/DOC) yang dimilikinya.
   - Sistem lalu menghapus file fisik tersebut langsung dari folder server (`/docs/fakultas`).
   - Setelah fisik fail dihapus bersih, sistem menghapus seutuhnya jejak baris rekam data tersebut dari *Database*.
   - Tabel dimuat ulang tanpa memunculkan baris data yang dihapus tadi, disertai pesan notifikasi keberhasilan operasional.

## Sequence Diagram: Kelola Rencana Strategis (Admin Web FIKOM)
Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Rencana Strategis:

1. **Melihat Daftar Data**:
   Saat admin membuka menu "Kelola Rencana Strategis", sistem akan langsung mengambil semua data yang tersimpan di *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Data**:
   - Ketika admin menekan tombol **Tambah** atau **Edit**, muncul formulir isian. Admin memasukkan Tahun Periode, Visi Renstra dan mengunggah Naskah Renstra (PDF/DOC).
   - Setelah menekan tombol **Simpan**, data dikirimkan ke sistem pengendali (PHP).
   - Sistem akan mengecek apakah format file benar dan ukurannya tidak terlalu besar.
   - Jika valid, sistem menyimpan file fisik tersebut ke dalam folder penyimpanan server (`/docs/renstra`).
   - Khusus untuk **Edit**, sistem akan mendeteksi keberadaan file lama milik data tersebut dan otomatis menghapusnya agar memori (*storage*) tidak penuh.
   - Setelah file tersimpan, sistem menyisipkan (menyimpan) rincian dari form teks admin beserta rujukan penamaan file tadi secara permanen ke dalam *Database*.
   - Terakhir, halaman memuat ulang (di-*refresh*) dan tabel tampil dengan memunculkan pesan Sukses kepada sang Admin.

3. **Proses Hapus Data**:
   - Jika tombol / ikon **Hapus** diklik pada salah satu baris, sistem akan mendedah referensi nama Naskah Renstra (PDF/DOC) yang dimilikinya.
   - Sistem lalu menghapus file fisik tersebut langsung dari folder server (`/docs/renstra`).
   - Setelah fisik fail dihapus bersih, sistem menghapus seutuhnya jejak baris rekam data tersebut dari *Database*.
   - Tabel dimuat ulang tanpa memunculkan baris data yang dihapus tadi, disertai pesan notifikasi keberhasilan operasional.

## Sequence Diagram: Kelola Standar Operasional Prosedur (SOP) (Admin Web FIKOM)
Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Standar Operasional Prosedur (SOP):

1. **Melihat Daftar Data**:
   Saat admin membuka menu "Kelola Standar Operasional Prosedur (SOP)", sistem akan langsung mengambil semua data yang tersimpan di *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Data**:
   - Ketika admin menekan tombol **Tambah** atau **Edit**, muncul formulir isian. Admin memasukkan Nama SOP, Rincian Prosedur dan mengunggah Dokumen Pedoman SOP (PDF/DOC).
   - Setelah menekan tombol **Simpan**, data dikirimkan ke sistem pengendali (PHP).
   - Sistem akan mengecek apakah format file benar dan ukurannya tidak terlalu besar.
   - Jika valid, sistem menyimpan file fisik tersebut ke dalam folder penyimpanan server (`/docs/sop`).
   - Khusus untuk **Edit**, sistem akan mendeteksi keberadaan file lama milik data tersebut dan otomatis menghapusnya agar memori (*storage*) tidak penuh.
   - Setelah file tersimpan, sistem menyisipkan (menyimpan) rincian dari form teks admin beserta rujukan penamaan file tadi secara permanen ke dalam *Database*.
   - Terakhir, halaman memuat ulang (di-*refresh*) dan tabel tampil dengan memunculkan pesan Sukses kepada sang Admin.

3. **Proses Hapus Data**:
   - Jika tombol / ikon **Hapus** diklik pada salah satu baris, sistem akan mendedah referensi nama Dokumen Pedoman SOP (PDF/DOC) yang dimilikinya.
   - Sistem lalu menghapus file fisik tersebut langsung dari folder server (`/docs/sop`).
   - Setelah fisik fail dihapus bersih, sistem menghapus seutuhnya jejak baris rekam data tersebut dari *Database*.
   - Tabel dimuat ulang tanpa memunculkan baris data yang dihapus tadi, disertai pesan notifikasi keberhasilan operasional.

## Sequence Diagram: Kelola Data Organisasi BEM (Admin Web FIKOM)
Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Data Organisasi BEM:

1. **Melihat Daftar Data**:
   Saat admin membuka menu "Kelola Data Organisasi BEM", sistem akan langsung mengambil semua data yang tersimpan di *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Data**:
   - Ketika admin menekan tombol **Tambah** atau **Edit**, muncul formulir isian. Admin memasukkan Nama Departemen, Program Kerja dan mengunggah Logo atau Foto Profil BEM.
   - Setelah menekan tombol **Simpan**, data dikirimkan ke sistem pengendali (PHP).
   - Sistem akan mengecek apakah format file benar dan ukurannya tidak terlalu besar.
   - Jika valid, sistem menyimpan file fisik tersebut ke dalam folder penyimpanan server (`/uploads/bem`).
   - Khusus untuk **Edit**, sistem akan mendeteksi keberadaan file lama milik data tersebut dan otomatis menghapusnya agar memori (*storage*) tidak penuh.
   - Setelah file tersimpan, sistem menyisipkan (menyimpan) rincian dari form teks admin beserta rujukan penamaan file tadi secara permanen ke dalam *Database*.
   - Terakhir, halaman memuat ulang (di-*refresh*) dan tabel tampil dengan memunculkan pesan Sukses kepada sang Admin.

3. **Proses Hapus Data**:
   - Jika tombol / ikon **Hapus** diklik pada salah satu baris, sistem akan mendedah referensi nama Logo atau Foto Profil BEM yang dimilikinya.
   - Sistem lalu menghapus file fisik tersebut langsung dari folder server (`/uploads/bem`).
   - Setelah fisik fail dihapus bersih, sistem menghapus seutuhnya jejak baris rekam data tersebut dari *Database*.
   - Tabel dimuat ulang tanpa memunculkan baris data yang dihapus tadi, disertai pesan notifikasi keberhasilan operasional.

## Sequence Diagram: Verifikasi Pendaftaran (Admin Web FIKOM)
Bedanya pada layar peladen Verifikasi di mana peranan Admin bukan membangun catatan formulir baru, namun utuh difokuskan **memproses antrean verifikasi** status orang:

1. **Memantau Gerak Daftar Pendaftar**: 
   Awal membuka rute menu status persetujuan Registrasi Pendaftar, rel pangkalan layar MySQL menjaminkan kemudahan menengok untaian memadat sederet profil pemohon siap dirombak untuk disetujui / dinonaktifkan.

2. **Titipan Ketetapan (Validasi Terima / Blokir Tolak)**:
   - Pengelola dengan lapang mengecek kesesuaian lampiran arsip calon pemohon. Lewat pencetan *Detail Viewer* layar memperlihatkan berkas pindaian jaminan identitas KTP mereka dari muatan tabung server.
   - Selesai pengawasan mata validnya dokumen, penegasan dilakukan melewati pertukaran klik aksi penyelesaian di tombol **Terima** maupun **Tolak**. Putusan itu ditiupkan menyebrangi pemungut jaringan server.
   - Mesin lantas mengubah status lema data *table pendaftaran* sang pemilik pemohon di dalam bilik sel basis MySQL jadi sah tervalidasi. 
   - Antarmuka mengayun layar menari kembali segar di titik pangkal tabel lengkap berpasang lencana penyelesaian kesuksesan status terpoles di peramban.

3. **Gugurnya Pendaftaran Batal Tersandung Hapus**:
   - Jika admin berniat mencerabut habis kotoran penumpukan antrean akun pendaftar yang tidak melintasi tenggat ketentuan maka pentalan menuntut pelemparan menu penghapusan total. Tombol pencabut **Hapus Status Pemohon** diartikulasikan ke antrian khusus baris profil mereka. 
   - Modus operandi penggusur memori mengepal kendali menyerang memori internal *Folder Storage Situs* tuk menghancurkan luluh lantak presensi pembuangan sampah lampiran identifikasi / Buket Pendaftaran dokumen asal milik terdakwa, secara telak memberangus fail mereka di server (*Unlink Files*).
   - Dihempas binasa tak terlacak sisa letikan teks keberadaannya pada susunan memori meja basis *Data Tabel MYSQL*. Laporan penutupan penyapuan lincah mengirim pentalan penyegaran *Refresh Window* mengabarkan ketuntasan proses pengosongan memori!

## Sequence Diagram: Pengaturan Sistem (Admin Web FIKOM)
Hal yang mengkhususkan fungsionalitas laman ini ketimbang tabel rekam jejak lain; pencatatan setingannya berada di *database* hanya diwakili sebaris rekam informasi inti (*Single configuration record*):

1. **Pemanggilan Laman Pengaturan**: 
   Sesaat admin mengetuk panel "Pengaturan Sistem", kueri sistem mengangkat satu *record* identitas pokok situs di pangkalan data. Pengisian tersebut akan merangkai formulir bawaan meliputi *Judul Situs*, Nomor Telpon Humas, sampai Email dan tersaji langsung menempati kolom isian layar.

2. **Perubahan & Klik Pembaruan Sinkron**:
   - Jika admin berniat memugar isian teks tersebut maupun mengganti lambang visual portal *Logo Favicon Web*, Admin bebas menghapus kolom isiannya lalu dikokohkan bersamaan ketukan simpan **Perbarui**.
   - Kiriman form ini dilimpahkan merapat menuju pos skrip pengaman pangkalan sistem (PHP).
   - Diandaikan pergantian simbol grafis/gambar dimanfaatkan melintasi toleransi ukuran batas memori berwewenang (*Batas megabyte max*). Mesin PHP secara halus memboyong logo anyar dan membanting posisi ke dalam saku penyimpanan lokasi file aset publik (*uploads atau img source*).
   - Bersamaan itu, rutinitas pengakhir menghanguskan dan menyapu foto logo pendahulunya ke arah tiada tersisa demi meringankan penumpukan data teronggok di sela penyimpanan *Server*.
   - Rangka logik kemudian menembuskan keping baris kueri bertingkat memutakhiran *SET UPDATE config* pada lapis saksi mata tabel pengaturan. Kesempurnaan putaran diakhiri memuat ulang laman admin di mana pemberitahuan segar ditimpakan ke sisi kanan atas layar: Sukses modifikasi!


