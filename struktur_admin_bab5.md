# Dokumentasi dan Struktur Kode Admin (Bab 5)

Dokumen ini disusun untuk menjelaskan struktur teknis, fungsionalitas, dan alur kerja sistem administrator pada Bab 5 (Implementasi dan Pengujian). Penjelasan ini disatukan dalam satu dokumen lengkap mencakup struktur navigasi, detail fungsi menu, dan alur sistem.

## 1. Struktur Navigasi Dashboard

Berdasarkan arsitektur aplikasi, fitur-fitur pada halaman administrator dikelompokkan menjadi empat segmen utama: **Sistem**, **Content**, **Data**, dan **Main**.

| **Sistem** | **Content** | **Data** | **Main** |
| :--- | :--- | :--- | :--- |
| **User Management**<br>• Pengaturan (Profile)<br>• Login / Logout<br><br>**Feedback**<br>• Data Pendaftaran | **Artikel & Berita**<br>• Kelola Berita<br><br>**Profil Web**<br>• Visi Misi<br>• Struktur Organisasi<br>• Data Civitas<br>• Tentang Fakultas<br>• Kelola Slider<br><br> | **Akademik & SDM**<br>• Kelola Dosen<br>• Kurikulum<br>• Kalender<br>• Ruangan<br>• Laboratorium<br><br>**Tridharma**<br>• Penelitian & Pengabdian<br>• BEM<br>• Kerjasama<br><br>**Arsip**<br>• Dokumen Fakultas<br>• Rencana Strategis<br>• SOP | **Overview**<br>• Dashboard Statistik<br>• Ringkasan Aktivitas |

---

## 2. Penjelasan Detail Fungsi Menu dan Sub-Menu

Berikut adalah penjelasan mendalam mengenai fungsi dan kegunaan dari setiap halaman dan menu yang terdapat pada panel administrator, dimulai dari akses masuk hingga pengelolaan data.

### A. Halaman Login Administrator

Halaman Login merupakan gerbang keamanan utama untuk mengakses sistem backend administrator. Antarmuka halaman ini didesain dengan gaya modern dan minimalis, menggunakan latar belakang gedung fakultas yang diburamkan (*blur*) untuk memberikan fokus visual pada panel login di tengah layar.

Elemen-elemen kunci pada halaman ini meliputi:
1.  **Identitas Visual**: Menampilkan logo resmi fakultas di bagian atas panel untuk validasi institusi.
2.  **Formulir Autentikasi**: Menyediakan kolom input untuk *username* dan *password*. Kolom sandi dilengkapi dengan fitur *toggle visibility* (ikon mata) yang memungkinkan pengguna memeriksa input sandi mereka sebelum dikirim, meningkatkan kenyamanan pengguna (User Experience).
3.  **Link Lupa Kata Sandi**: Fitur bantuan bagi admin yang mengalami kendala akses akun.
4.  **Navigasi Kembali**: Tautan "Kembali ke Beranda" di bagian bawah memungkinkan pengguna untuk membatalkan proses login dan kembali ke halaman utama pengunjung (Front-end).

### B. Kelompok Menu Profil (Kelola Profil)

**1. Sub-menu: Visi Misi**
Halaman ini adalah editor konten vital yang menampilkan visi dan misi resmi fakultas.
*   **Tambah/Edit Data:** Karena visi misi bersifat tetap, operasi utamanya adalah Pembaruan (Update). Administrator menyunting teks visi dan misi menggunakan fitur *Rich Text Editor* layaknya Microsoft Word, lalu menekan tombol "Simpan" untuk langsung mengubah teks di halaman publik.
*   **Hapus Data:** Penghapusan dilakukan dengan mengosongkan *text editor* dan menyimpannya, meskipun secara praktis data ini selalu dipertahankan.

**2. Sub-menu: Struktur Organisasi**
Sub-menu ini berfungsi sebagai manajemen tampilan hierarki kepemimpinan di fakultas.
*   **Edit/Update Data:** Admin dapat mengklik tombol form untuk mengunggah (Update) gambar bagan struktur organisasi terbaru (biasanya format JPG atau PNG). Begitu diunggah, gambar lama otomatis tergantikan dengan bagan kepemimpinan yang baru menjabat.

**3. Sub-menu: Data Civitas (Fakta Fakultas)**
Modul pengelolaan data statistik kuantitatif yang menjadi indikator performa fakultas.
*   **Edit Data:** Angka seperti Jumlah Mahasiswa atau Dosen sudah disediakan barisnya. Admin cukup menekan tombol **"Edit"**, memasukkan angka kuantitas yang baru, dan menyimpannya untuk meng-*update* *database*.

**4. Sub-menu: Tentang Fakultas**
Halaman dedikasi untuk narasi sejarah dan latar belakang berdirinya fakultas.
*   **Edit Data:** Menggunakan mekanisme *Rich Text Editor*. Admin dapat menyunting artikel sejarah, menambah poin baru, atau memperbaiki narasi tanpa perlu membuat entri baru dari nol.

---

### C. Kelompok Menu Fasilitas (Kelola Fasilitas)

**5. Sub-menu: Ruangan**
Sistem inventaris aset ruangan kelas dan aula.
*   **Tambah Data:** Admin menekan tombol "Tambah Ruangan", lalu mengisi nama ruangan, kapasitas, letak lantai, dan kelengkapannya, kemudian menyimpannya ke sistem.
*   **Edit Data:** Menekan ikon "Pena" untuk mengubah spesifikasi, misal menambahkan fasilitas AC yang baru dipasang di ruang tersebut.
*   **Hapus Data:** Menekan ikon "Tempat Sampah" untuk menghapus data ruangan dari sistem jika ruangan tersebut dialihfungsikan secara permanen.

**6. Sub-menu: Laboratorium**
Sistem manajemen profil laboratorium praktikum.
*   **Tambah Data:** Mengisi form penambahan fasilitas laboratorium beserta jenis peralatan yang dimiliki.
*   **Edit Data:** Meng-update daftar *software* atau perangkat keras jika laboratorium baru saja mendapatkan komputer baru.
*   **Hapus Data:** Menghapus entri laboratorium yang sudah tidak dioperasikan.

---

### D. Kelompok Menu Akademik (Kelola Akademik)

**7. Sub-menu: Kurikulum**
Halaman pengelola basis data mata kuliah tiap program studi.
*   **Tambah Data:** Admin mengisi form "Tambah Mata Kuliah" dengan memasukkan Kode MK, Nama MK, Bobot SKS, dan memetakannya ke Semester yang tepat.
*   **Edit Data:** Memperbarui bobot SKS atau mengubah nama mata kuliah jika terjadi revisi kurikulum standar nasional.
*   **Hapus Data:** Menghapus mata kuliah yang sudah tidak relevan atau ditiadakan dari sistem kurikulum.

**8. Sub-menu: Kalender Akademik**
Papan pengumuman jadwal kegiatan akademik semester berjalan.
*   **Tambah/Update Data:** Admin tidak mengetik jadwal, melainkan mengunggah *file* gambar atau PDF Kalender Akademik resmi. File ini akan menimpa file lama dan langsung bisa diunduh/dilihat mahasiswa di halaman depan.

---

### E. Kelompok Menu Tridharma, Organisasi, dan Kemitraan

**9. Sub-menu: Kelola Berita & Slider (Tambahan Manajerial Konten)**
*   **Tambah Data:** Admin membuat artikel berita dengan menginput Judul, mengunggah satu Foto Utama (*Thumbnail*), mengetik isi berita di editor, lalu menekan Publish. Untuk Slider, admin mengunggah gambar spanduk promosi beresolusi tinggi.
*   **Edit Data:** Admin merevisi narasi berita (typo) atau mengganti gambar *thumbnail*-nya.
*   **Hapus Data:** Menghapus berita kadaluwarsa atau gambar slider lama; sistem akan pintar menghapus file fotonya dari *storage* server.

**10. Sub-menu: Penelitian & Pengabdian Masyarakat**
*   **Tambah Data:** Admin mencatat aktivitas tridharma dengan memasukkan Judul, Nama Pelaksana (Dosen/Mahasiswa), Tahun, dan mengunggah dokumen luaran riset.
*   **Edit Data:** Mengubah status proyek (dari *Ongoing* menjadi *Selesai*) atau memperbarui besaran dana.
*   **Hapus Data:** Menghapus rekam jejak kegiatan beserta *file* laporannya.

**11. Sub-menu: BEM (Badan Eksekutif Mahasiswa)**
*   **Tambah/Edit Data:** Memperbarui struktur kabinet kepengurusan mahasiswa setiap pergantian tahun akademik, termasuk visi misi dan foto pengurus baru.

**12. Sub-menu: Kerjasama**
*   **Tambah Data:** Memasukkan nama perusahaan mitra baru beserta logo resminya untuk ditampilkan di beranda.
*   **Edit Data:** Memperbaiki nama institusi mitra atau mengganti logo yang sudah *rebranding*.
*   **Hapus Data:** Menghapus entri jika masa berlaku MoU kerja sama telah usai.

---

### F. Kelompok Menu Arsip Dokumen (Kelola Dokumen)

**13. Sub-menu: Dokumen Fakultas, Rencana Strategis (Renstra), & SOP**
*   **Tambah Data:** Admin menekan "Tambah Dokumen", mengetik judul dokumen (misal: "SOP Skripsi"), lalu mengunggah *file* asli (PDF) ke *server*.
*   **Edit Data:** Mengganti judul file dokumen atau mengunggah *file* revisi terbaru (misal: "SOP Skripsi Revisi 2024").
*   **Hapus Data:** Menekan tombol "Hapus". Sistem tidak hanya menghapus nama di *database*, tetapi akan langsung mendelete *file* PDF tersebut dari *folder server* secara permanen untuk membebaskan memori.

---

### G. Kelompok Menu Data Pendaftaran (Feedback)

**14. Halaman Data Pendaftaran Mahasiswa**
Pusat pengelolaan formulir pendaftaran calon mahasiswa baru.
*   **Read (Lihat Data):** Admin tidak menambahkan pendaftar dari sini; admin sekadar membaca daftar calon mahasiswa yang masuk, dan bisa mengklik tombol "Detail" untuk membaca biodata lengkap (alamat, nama orang tua, dll).
*   **Aksi (Follow-up WA):** Terdapat tombol konfirmasi berbasis WhatsApp. Admin cukup menekannya untuk membuka ruang *chat* otomatis dengan pendaftar tersebut guna verifikasi berkas.
*   **Hapus Data:** Jika terdapat data ganda (pendaftar submit dua kali), data fiktif/spam, atau pembatalan, admin dapat menekan tombol Hapus untuk membersihkan daftar antrean penerimaan.

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
| **Content** | `kelola_berita.php`, `kelola_slider.php`, `kelola_visimisi.php`, `kelola_struktur.php`, `kelola_fakta.php`, `kelola_tentangfak.php` | `berita`, `slider`, `halaman_statis` |
| **Data** | `kelola_dosen.php`, `kelola_kurikulum.php`, `kelola_ruangan.php`, `kelola_lab.php`, `kelola_penelitian.php`, `kelola_bem.php`, `kelola_kerjasama.php` | `dosen`, `matakuliah`, `ruangan`, `penelitian`, `pengabdian`, `dokumen`, `kerjasama` |

