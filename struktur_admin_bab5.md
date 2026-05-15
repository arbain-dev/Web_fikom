# Dokumentasi dan Struktur Kode Admin (Bab 5)

Dokumen ini disusun untuk menjelaskan struktur teknis, fungsionalitas, dan alur kerja sistem administrator pada Bab 5 (Implementasi dan Pengujian). Penjelasan ini disatukan dalam satu dokumen lengkap mencakup struktur navigasi, detail fungsi menu, dan alur sistem.

## 1. Struktur Navigasi Dashboard

Berdasarkan arsitektur aplikasi, fitur-fitur pada halaman administrator dikelompokkan menjadi empat segmen utama: **Sistem**, **Content**, **Data**, dan **Main**.

| **Sistem** | **Content** | **Data** | **Main** |
| :--- | :--- | :--- | :--- |
| **User Management**<br>• Pengaturan (Profile)<br>• Login / Logout<br><br>**Feedback**<br>• Data Pendaftaran | **Artikel & Berita**<br>• Kelola Berita<br><br>**Media**<br>• Galeri Foto & Video<br><br>**Profil Web**<br>• Visi Misi<br>• Struktur Organisasi<br>• Data Civitas<br>• Tentang Fakultas<br>• Kelola Slider<br><br> | **Akademik & SDM**<br>• Kelola Dosen<br>• Kurikulum<br>• Kalender<br>• Ruangan<br>• Laboratorium<br><br>**Tridharma**<br>• Penelitian & Pengabdian<br>• BEM<br>• Kerjasama<br><br>**Arsip**<br>• Dokumen Fakultas<br>• Rencana Strategis<br>• SOP | **Overview**<br>• Dashboard Statistik<br>• Ringkasan Aktivitas |

---

## 2. Penjelasan Detail Fungsi Menu dan Sub-Menu

Berikut adalah penjelasan mendalam mengenai fungsi dan kegunaan dari setiap halaman dan menu yang terdapat pada panel administrator, dimulai dari akses masuk hingga pengelolaan data.

### A. Halaman Login Administrator

Halaman Login merupakan pintu masuk utama bagi administrator untuk mengelola konten website. Tampilan halaman ini dirancang dengan estetika modern, menampilkan form input yang bersih dengan latar belakang visual gedung fakultas. Keamanan menjadi prioritas utama pada halaman ini untuk mencegah akses yang tidak sah.

**Langkah-langkah Mengakses Sistem:**
1.  Buka browser dan akses alamat URL admin (misal: `domain.com/admin/login.php`).
2.  Masukkan **Username** dan **Password** yang telah terdaftar pada kolom yang tersedia.
3.  Klik ikon **"Mata"** pada kolom password untuk memastikan kata sandi yang diketik sudah benar.
4.  Klik tombol **"Login"**. Jika data valid, sistem akan mengarahkan Anda ke Dashboard utama.

---

### B. Dashboard Utama (Overview)

Setelah berhasil login, administrator akan disambut oleh halaman Dashboard. Halaman ini berfungsi sebagai pusat kontrol yang memberikan ringkasan informasi secara cepat melalui kartu statistik. Administrator dapat melihat jumlah total berita, dosen, penelitian, dan pendaftar mahasiswa baru tanpa harus membuka menu satu per satu.

**Fungsi Utama Dashboard:**
*   **Statistik Ringkas**: Menampilkan jumlah data penting dalam bentuk box berwarna yang menarik.
*   **Akses Cepat**: Memudahkan navigasi ke modul-modul yang paling sering digunakan.
*   **Notifikasi**: Memberikan informasi jika ada data pendaftaran baru yang masuk.

---

### C. Kelompok Menu Profil (Kelola Profil)

**1. Sub-menu: Visi Misi**
Halaman ini digunakan untuk mengelola visi dan misi fakultas agar tetap selaras dengan tujuan institusi. Tampilan halaman ini didominasi oleh *Rich Text Editor* yang memungkinkan pemformatan teks secara dinamis.

*   **Langkah Menginput/Memperbarui Data**: Masukkan atau tempel teks visi dan misi pada kotak editor yang tersedia. Gunakan *toolbar* di atasnya untuk menebalkan teks atau membuat poin-poin (bullet points).
*   **Langkah Mengedit Data**: Klik pada bagian teks yang ingin diubah di dalam editor, lakukan revisi, lalu klik tombol **"Simpan Perubahan"** di bagian bawah.
*   **Langkah Menghapus Data**: Untuk mengosongkan data, hapus semua teks di dalam editor dan klik **"Simpan"**. Sistem akan mengosongkan tampilan di halaman depan.

**2. Sub-menu: Struktur Organisasi**
Halaman ini difokuskan pada manajemen visual bagan kepemimpinan. Admin dapat mengunggah gambar hierarki jabatan dari Dekan hingga unit terkecil.

*   **Langkah Menginput Data**: Klik tombol **"Pilih File"** atau **"Browse"**, cari file gambar struktur (JPG/PNG) di komputer Anda, lalu klik **"Upload"**.
*   **Langkah Mengedit Data**: Untuk mengganti gambar lama, cukup lakukan proses unggah kembali dengan file gambar yang baru. Sistem secara otomatis akan menimpa (replace) file lama dengan yang baru.
*   **Langkah Menghapus Data**: Klik tombol **"Hapus"** jika ingin menghilangkan bagan struktur dari halaman publik.

**3. Sub-menu: Data Civitas (Fakta Fakultas)**
Menampilkan data angka yang mencerminkan kekuatan fakultas, seperti jumlah mahasiswa aktif, jumlah dosen, dan jumlah alumni.

*   **Langkah Menginput Data**: Klik tombol **"Tambah Data"**, masukkan nama kategori (misal: "Alumni") dan jumlahnya, lalu simpan.
*   **Langkah Mengedit Data**: Klik ikon **"Pena/Edit"** pada baris data yang ingin diubah, masukkan angka terbaru pada kolom jumlah, lalu klik **"Update"**.
*   **Langkah Menghapus Data**: Klik ikon **"Tempat Sampah"** pada baris yang tidak lagi diperlukan, kemudian konfirmasi penghapusan pada pop-up yang muncul.

**Tampilan Antarmuka Formulir (Modal Popup):**
Ketika administrator menekan tombol tambah atau edit, akan muncul jendela *pop-up* (modal) di tengah layar. Formulir ini memiliki kolom isian yang bersih dengan label yang jelas, mencakup kolom untuk **Nama Fakta/Kategori** dan **Jumlah/Kuantitas**. Terdapat tombol **"Simpan Data"** berwarna biru untuk memproses data dan tombol **"Batal"** untuk membatalkan aksi.

**4. Sub-menu: Tentang Fakultas**
Halaman ini menyimpan narasi sejarah dan deskripsi umum fakultas. Menggunakan editor teks yang sama dengan menu Visi Misi untuk memudahkan pengelolaan konten panjang.

*   **Langkah Menginput Data**: Tuliskan sejarah lengkap atau profil fakultas pada editor teks, tambahkan gambar jika diperlukan melalui fitur *insert image*.
*   **Langkah Mengedit Data**: Buka halaman ini, ubah bagian narasi yang memerlukan perbaikan, lalu tekan tombol **"Simpan"**.
*   **Langkah Menghapus Data**: Hapus seluruh konten di dalam editor jika ingin meniadakan deskripsi profil di halaman depan.

---

### D. Kelompok Menu Konten (Media & Publikasi)

**5. Sub-menu: Kelola Berita**
Modul ini adalah jantung dari publikasi informasi terkini. Admin dapat mengelola artikel berita, pengumuman, dan kegiatan kampus.

*   **Langkah Menginput Data**: Klik **"Tambah Berita"**, isi judul, pilih kategori, unggah foto utama sebagai thumbnail, dan ketik isi berita lengkap di kolom konten. Klik **"Terbitkan"**.
*   **Langkah Mengedit Data**: Pilih berita dari daftar, klik **"Edit"**, ubah judul atau isi berita, dan ganti foto jika perlu. Klik **"Simpan Perubahan"**.
*   **Langkah Menghapus Data**: Cari berita yang ingin dihapus, klik tombol **"Hapus"**, dan konfirmasi. Sistem akan menghapus data di database serta file foto di server.

**Tampilan Antarmuka Formulir (Modal Popup):**
Halaman ini menggunakan jendela modal dengan judul **"TAMBAH BERITA"** atau **"EDIT BERITA"**. Formulir mencakup kolom:
1.  **Judul Berita**: Input teks untuk judul utama artikel.
2.  **Kategori**: Menu *dropdown* untuk memilih jenis berita (misal: Berita, Pengumuman, atau Kegiatan).
3.  **Tanggal Publish**: Input penanggalan (*date picker*) untuk menentukan waktu rilis.
4.  **Link Eksternal (Opsional)**: Kolom untuk menyematkan tautan luar jika berita bersumber dari portal lain.
5.  **Konten Berita**: Kotak editor teks luas untuk mengetik narasi berita secara lengkap.
Di bagian bawah tersedia tombol **"Simpan Data"** dengan aksen warna biru dan tombol **"Batal"**.

**6. Sub-menu: Kelola Slider**
Digunakan untuk mengelola gambar spanduk (*banner*) yang berputar di halaman utama website.

*   **Langkah Menginput Data**: Klik **"Tambah Slider"**, unggah gambar beresolusi tinggi (disarankan 1920x1080 px), dan tambahkan teks keterangan singkat jika diperlukan.
*   **Langkah Mengedit Data**: Klik **"Edit"** pada item slider untuk mengganti gambar atau mengubah teks promosinya.
*   **Langkah Menghapus Data**: Klik ikon **"Hapus"** pada gambar slider yang sudah tidak relevan (misal: promo acara yang sudah lewat).

**Tampilan Antarmuka Formulir (Modal Popup):**
Jendela modal pada menu ini dirancang sederhana dengan fokus pada manajemen gambar. Terdapat kolom input untuk mengunggah file gambar (Format JPG/PNG) dan kolom teks opsional untuk menambahkan keterangan yang akan muncul di atas slider.

**7. Sub-menu: Galeri Foto & Video**
Manajemen dokumentasi visual dalam bentuk album foto dan tautan video.

*   **Langkah Menginput Data**: Untuk foto, unggah satu atau beberapa gambar sekaligus ke dalam satu album/judul kegiatan. Untuk video, masukkan judul dan tempelkan tautan (link) dari YouTube.
*   **Langkah Mengedit Data**: Klik **"Edit"** untuk menambah/mengurangi foto dalam album atau mengubah tautan video.
*   **Langkah Menghapus Data**: Klik **"Hapus"** untuk melenyapkan satu album galeri atau satu entri video secara permanen.

**Tampilan Antarmuka Formulir (Modal Popup):**
Modal pada galeri foto mendukung unggahan multi-file, sehingga admin dapat memilih banyak foto sekaligus. Untuk galeri video, modal menyediakan kolom input **"Judul Video"** dan **"Link Video"** untuk menyematkan kode ID dari YouTube.

---

### E. Kelompok Menu Akademik & Fasilitas

**8. Sub-menu: Kelola Dosen**
Manajemen profil tenaga pengajar profesional di lingkungan fakultas.

*   **Langkah Menginput Data**: Klik **"Tambah Dosen"**, isi Nama Lengkap, NIDN, Jabatan Fungsional, dan unggah foto profil formal. Klik **"Simpan"**.
*   **Langkah Mengedit Data**: Cari nama dosen, klik **"Edit"**, perbarui data seperti gelar atau jabatan terbaru, lalu klik **"Update"**.
*   **Langkah Menghapus Data**: Klik **"Hapus"** jika dosen sudah tidak aktif atau pensiun dari institusi.

**Tampilan Antarmuka Formulir (Modal Popup):**
Jendela modal **"KELOLA DOSEN"** menampilkan banyak kolom input untuk kelengkapan profil, meliputi: **Nama Lengkap & Gelar**, **NIDN**, **Bidang Keahlian**, **Jabatan Fungsional**, dan kolom unggah **Foto Profil**. Tata letak form diatur secara vertikal agar mudah diisi.

**9. Sub-menu: Kurikulum & Kalender**
Manajemen daftar mata kuliah dan jadwal kegiatan tahunan.

*   **Langkah Menginput Data**: Untuk Kurikulum, masukkan kode MK, nama MK, dan SKS ke dalam form semester terkait. Untuk Kalender, unggah file PDF atau gambar kalender akademik terbaru.
*   **Langkah Mengedit Data**: Klik **"Edit"** pada mata kuliah untuk mengubah bobot SKS. Untuk kalender, unggah file baru untuk menggantikan file yang lama.
*   **Langkah Menghapus Data**: Klik **"Hapus"** untuk menghilangkan mata kuliah yang sudah tidak masuk dalam kurikulum berjalan.

**Tampilan Antarmuka Formulir (Modal Popup):**
Pada bagian kurikulum, modal pop-up menampilkan kolom **"Kode MK"**, **"Nama Mata Kuliah"**, **"Bobot SKS"**, dan pilihan **"Semester"**. Hal ini memudahkan admin dalam memetakan mata kuliah tanpa harus berpindah halaman.

**10. Sub-menu: Ruangan & Laboratorium**
Inventarisasi fasilitas fisik untuk mendukung kegiatan belajar mengajar.

*   **Langkah Menginput Data**: Masukkan nama ruangan/lab, kapasitas, dan daftar fasilitas (AC, Proyektor, dll). Klik **"Simpan"**.
*   **Langkah Mengedit Data**: Klik **"Edit"** untuk memperbarui daftar fasilitas atau kapasitas ruangan jika ada renovasi.
*   **Langkah Menghapus Data**: Klik **"Hapus"** pada entri ruangan yang sudah dialihfungsikan.

**Tampilan Antarmuka Formulir (Modal Popup):**
Modal input mencakup kolom **"Nama Ruangan"**, **"Lantai"**, **"Kapasitas"**, dan kotak teks luas untuk merinci **"Fasilitas"**. Desainnya serupa dengan modal Berita, memberikan konsistensi visual di seluruh sistem.

---

### F. Kelompok Menu Tridharma, Organisasi, & Kemitraan

**11. Sub-menu: Penelitian & Pengabdian**
Mendata rekam jejak riset dan kontribusi sosial oleh civitas akademika.

*   **Langkah Menginput Data**: Klik **"Tambah Kegiatan"**, isi judul penelitian, nama ketua peneliti, tahun pelaksanaan, dan unggah file laporan/dokumen pendukung.
*   **Langkah Mengedit Data**: Klik **"Edit"** untuk memperbarui status penelitian atau melengkapi data yang kurang.
*   **Langkah Menghapus Data**: Klik **"Hapus"** untuk menghapus record kegiatan beserta file lampirannya.

**Tampilan Antarmuka Formulir (Modal Popup):**
Halaman ini menggunakan modal dengan formulir yang cukup kompleks, mencakup kolom **"Judul Riset"**, **"Nama Peneliti"**, **"Tahun"**, **"Sumber Dana"**, dan tombol unggah untuk dokumen laporan akhir.

**12. Sub-menu: Kerjasama & BEM**
Mengelola daftar mitra institusi dan profil organisasi mahasiswa.

*   **Langkah Menginput Data**: Unggah logo mitra kerja sama dan masukkan nama instansinya. Untuk BEM, masukkan struktur kepengurusan periode terbaru.
*   **Langkah Mengedit Data**: Perbarui logo mitra jika ada perubahan branding atau perbarui nama pengurus BEM.
*   **Langkah Menghapus Data**: Klik **"Hapus"** jika masa kerjasama berakhir atau untuk menghapus arsip pengurus lama.

**Tampilan Antarmuka Formulir (Modal Popup):**
Modal kerjasama menyediakan kolom sederhana untuk **"Nama Institusi/Mitra"** dan kolom unggah file untuk **"Logo Mitra"**. Untuk BEM, modal mencakup kolom untuk **"Nama Pengurus"**, **"Jabatan"**, dan **"Foto Pengurus"**.

---

### G. Kelompok Menu Arsip & Feedback

**13. Sub-menu: Dokumen Fakultas (SOP & Renstra)**
Penyimpanan digital untuk dokumen resmi, Standar Operasional Prosedur, dan Rencana Strategis dalam format PDF.

*   **Langkah-langkah Menginput Data**: Klik tombol **"Tambah Dokumen"**, beri judul yang jelas (contoh: "SOP Pengajuan Cuti Mahasiswa"), pilih kategori dokumen, lalu unggah file PDF dari penyimpanan lokal Anda.
*   **Langkah-langkah Mengedit Data**: Jika terdapat kesalahan judul atau ingin mengganti file dengan versi revisi terbaru, klik ikon **"Edit"**. Lakukan perubahan data atau unggah file baru, lalu klik **"Update"**.
*   **Langkah-langkah Menghapus Data**: Klik tombol **"Hapus"** pada dokumen yang sudah tidak berlaku. Sistem akan secara otomatis menghapus catatan di database dan file fisik PDF dari server.

**Tampilan Antarmuka Formulir (Modal Popup):**
Jendela modal menyajikan kolom **"Judul Dokumen"**, menu *dropdown* untuk **"Jenis Dokumen"**, dan kolom unggah file PDF. Tombol **"Simpan Data"** tersedia untuk mengonfirmasi unggahan file ke server.

**14. Halaman Data Pendaftaran (Feedback)**
Pusat pengelolaan data calon mahasiswa baru yang mendaftar melalui formulir online di website.

*   **Langkah-langkah Membaca Data**: Administrator dapat memantau pendaftar baru melalui tabel daftar pendaftaran. Klik tombol **"Detail"** (ikon mata) untuk melihat informasi profil lengkap pendaftar.
*   **Langkah-langkah Tindak Lanjut (Follow-up)**: Gunakan tombol **"WhatsApp"** yang terintegrasi untuk menghubungi nomor pendaftar secara langsung guna keperluan verifikasi atau wawancara.
*   **Langkah-langkah Menghapus Data**: Untuk menjaga kualitas data, hapus entri yang bersifat ganda atau spam dengan menekan tombol **"Hapus"** dan konfirmasi tindakan tersebut.

---

## 3. Alur Kerja Sistem (System Workflow)

Bagian ini menjelaskan mekanisme teknis bagaimana pengguna berinteraksi dengan sistem dalam bentuk narasi alur.

### 1. Alur Autentikasi (Sistem)
Proses dimulai ketika pengguna mengakses alamat panel admin. Sistem akan secara otomatis memeriksa status otorisasi pengguna. Jika pengguna belum melakukan *login*, sistem akan mengalihkan tampilan ke halaman Login. Pengguna kemudian memasukkan nama pengguna dan kata sandi. Sistem akan memverifikasi kredensial tersebut dengan data di basis data. Jika cocok, sistem membuat sesi keamanan unik dan mengizinkan pengguna masuk ke Dashboard.

### 2. Alur Operasi Manajemen Data Terpadu (Konsep CRUD)
Keseluruhan sistem pengelolaan data pada panel administrator dibangun secara dinamis menggunakan prinsip fundamental **CRUD** (Create, Read, Update, Delete). Mekanisme ini memastikan keakuratan dan keteraturan aliran informasi. Berikut adalah penjabaran operasionalisasinya:

*   **Create (Menambah Data Baru):** Ketika administrator menekan tombol "Tambah" (misalnya pada halaman Dosen atau Berita), antarmuka akan memunculkan sebuah jendela formulir dinamis (*Modal Popup*) di atas layar aktif tanpa perlu berpindah halaman (*no page reload*). Setelah admin mengisi semua *field* (termasuk unggahan file jika ada) dan menyimpannya, sistem PHP akan mengeksekusi *query* `INSERT INTO` untuk memasukkan data tersebut sebagai rekam jejak (*record*) baru di dalam basis data (MySQL).
*   **Read (Menampilkan & Membaca Data):** Setiap kali administrator membuka suatu halaman menu, sistem secara otomatis mengeksekusi perintah `SELECT` ke basis data. Data yang berhasil ditarik (*fetch*) kemudian dirender dan disajikan dalam bentuk tabel yang interaktif dan responsif (sering kali diperkuat oleh *library* seperti DataTables). Hal ini memungkinkan admin untuk mencari, mengurutkan, dan melakukan paginasi data dengan sangat mulus.
*   **Update (Memperbarui Data):** Untuk memperbaiki kesalahan ketik atau memperbarui status data (seperti kenaikan jabatan dosen), administrator cukup menekan tombol berikon "Edit" pada baris data terkait. Sistem akan menarik data *existing* berdasarkan ID unik dan meletakkannya kembali ke dalam formulir *Modal*. Setelah dilakukan perubahan, perintah `UPDATE` SQL dikirim ke *server* untuk menimpa data lama secara presisi.
*   **Delete (Menghapus Data Secara Aman):** Setiap baris data dilengkapi dengan tombol "Hapus" (ikon tempat sampah). Sebagai langkah mitigasi risiko kesalahan manusia (human error), sistem akan menampilkan *pop-up* peringatan konfirmasi sebelum data benar-benar dihilangkan. Jika dikonfirmasi, sistem mengirimkan perintah `DELETE` ke *database*. **Keunggulan sistem ini:** Jika data tersebut memiliki *file* media lampiran (contoh: foto profil, dokumen PDF, atau *thumbnail* gambar berita), kode program (melalui fungsi `unlink` di PHP) akan secara pintar menelusuri dan menghapus *file* fisiknya dari dalam folder penyimpanan di *server* (`uploads/`). Mekanisme ini mencegah penumpukan berkas sampah (*junk files*) yang dapat menguras kapasitas penyimpanan *hosting*.---

## 4. Struktur File & Database

Secara teknis, kode program disusun sebagai berikut:

| Kategori Struktur | File Terkait | Tabel Database Utama |
| :--- | :--- | :--- |
| **Main** | `dashboard.php`, `index.php` | - |
| **Sistem** | `login.php`, `logout.php`, `profile.php`, `kelola_pendaftaran.php` | `users`, `pendaftaran` |
| **Content** | `kelola_berita.php`, `kelola_slider.php`, `kelola_visimisi.php`, `kelola_struktur.php`, `kelola_fakta.php`, `kelola_tentangfak.php`, `kelola_galeri_foto.php`, `kelola_galeri_video.php` | `berita`, `slider`, `halaman_statis`, `galeri_foto`, `galeri_video` |
| **Data** | `kelola_dosen.php`, `kelola_kurikulum.php`, `kelola_ruangan.php`, `kelola_lab.php`, `kelola_penelitian.php`, `kelola_bem.php`, `kelola_kerjasama.php` | `dosen`, `matakuliah`, `ruangan`, `penelitian`, `pengabdian`, `dokumen`, `kerjasama` |

