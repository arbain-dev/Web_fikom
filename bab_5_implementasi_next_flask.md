# Implementasi Antarmuka Sistem (Next.js & Flask)

Berikut adalah penjelasan Bab 5: Hasil dan Pembahasan untuk implementasi sistem yang dibangun menggunakan arsitektur modern terpisah (*decoupled architecture*), dengan **Next.js** sebagai *frontend* dan **Flask (Python)** sebagai *backend*.

---

## 5.1 Deskripsi Umum Sistem
Sistem informasi Fakultas Ilmu Komputer ini dikembangkan dengan memisahkan logika antarmuka pengguna (*frontend*) dan logika pemrosesan data (*backend*). Sisi *frontend* dibangun menggunakan framework **Next.js** yang menawarkan performa tinggi dan interaktivitas yang responsif, sementara sisi *backend* menggunakan micro-framework **Flask** berbasis Python yang bertugas menyediakan layanan REST API (*Application Programming Interface*). Komunikasi antara kedua sisi ini dilakukan melalui protokol HTTP menggunakan format data JSON. Arsitektur ini dipilih untuk meningkatkan skalabilitas, kemudahan pemeliharaan, dan pengalaman pengguna yang lebih mulus dibandingkan aplikasi web tradisional.

## 5.2 Implementasi Halaman Login
Halaman Login merupakan gerbang keamanan utama yang membatasi akses ke dalam fitur manajerial sistem. Berbeda dengan sistem konvensional, proses autentikasi pada sistem ini menggunakan mekanisme **JSON Web Token (JWT)**.

Secara visual, antarmuka login dibangun menggunakan komponen React di Next.js dengan gaya modern. Saat administrator memasukkan *username* dan *password*, aplikasi *frontend* mengirimkan permintaan POST ke *endpoints* API `/api/auth/login` di server Flask. Di sisi *backend*, Flask memverifikasi kredensial tersebut dengan data di database MySQL. Jika valid, *backend* akan mengembalikan token akses (Access Token) yang terenkripsi. Token ini kemudian disimpan secara aman di sisi browser (biasanya dalam *HttpOnly Cookie* atau *Local Storage*) dan digunakan sebagai "kunci digital" untuk setiap permintaan data selanjutnya. Jika login gagal, sistem akan menampilkan notifikasi error secara *real-time* tanpa perlu memuat ulang halaman (*page reload*).

## 5.3 Implementasi Dashboard Utama
Dashboard Utama adalah pusat kendali yang menyajikan ringkasan visual dari keseluruhan sistem. Halaman ini di-*render* di sisi klien (*Client-Side Rendering*) oleh Next.js untuk kecepatan akses.

Data statistik yang ditampilkan, seperti jumlah dosen aktif, total berita, dan statistik penelitian, diambil secara asinkron (*asynchronous fetching*) dari *backend* Flask. Saat halaman dimuat, komponen dashboard (React Components) akan memanggil beberapa API statistik secara paralel. Data yang diterima kemudian ditampilkan dalam bentuk Kartu Statistik (*Stats Cards*) dan grafik interaktif. Keunggulan pendekatan ini adalah pengguna dapat melihat kerangka halaman (*skeleton loading*) terlebih dahulu sebelum data muncul sepenuhnya, memberikan kesan aplikasi yang sangat responsif. Sidebar navigasi dibuat dinamis, memungkinkan perpindahan antar menu secara instan tanpa *refresh* browser (Single Page Application behavior).

## 5.4 Manajemen Konten Informasi
Pengelolaan konten dilakukan melalui antarmuka admin yang terhubung ke *endpoints* CRUD (*Create, Read, Update, Delete*) pada API backend.

### a. Sub-Menu Kelola Berita
Modul ini memungkinkan admin mempublikasikan berita dan pengumuman. Sisi *frontend* menyediakan formulir input yang kaya fitur (*Rich Text Editor*) untuk penulisan konten. Saat berita disimpan, Next.js mengirimkan data teks beserta file gambar *thumbnail* ke *backend*. Flask menangani proses validasi input, penyimpanan file gambar ke direktori server, dan menyisipkan metadata berita ke tabel database. Respon status dari server kemudian ditangkap oleh *frontend* untuk menampilkan pesan sukses "Berita Berhasil Disimpan" lewat notifikasi *toast* yang elegan.

### b. Sub-Menu Kelola Slider (Hero Image)
Fitur ini mengelola gambar spanduk utama website. Implementasinya memanfaatkan fitur optimasi gambar dari Next.js (`next/image`) untuk menampilkan preview slider dengan kualitas tinggi namun ringan. Admin dapat mengunggah gambar baru yang akan diproses oleh Flask, serta mengaktifkan atau menonaktifkan slider tertentu melalui tombol *toggle switch*. Perubahan status ini dikirimkan via API request PATCH yang ringan, sehingga perubahan terjadi seketika tanpa jeda.

### c. Sub-Menu Kelola Visi & Misi
Pengelolaan Visi Misi menggunakan formulir dinamis di mana admin dapat menambah poin Misi atau Tujuan secara fleksibel. Data dikirim ke server dalam struktur array JSON. Backend Flask akan mem-parsing JSON tersebut dan menyimpannya ke database. Pemisahan data ini memastikan bahwa Visi Misi dapat ditampilkan dengan markup HTML yang terstruktur rapi pada halaman publik.

### d. Sub-Menu Kelola Data Fakta (Counter)
Widget "Counter Angka" dikelola melalui modul ini. Admin memperbarui angka indikator kinerja (misal: Jumlah Alumni). Next.js memastikan bahwa setiap perubahan angka yang disimpan akan langsung terekspos ke publik melalui API public, di mana komponen *counter* di halaman depan akan melakukan animasi penghitungan (*count-up animation*) berdasarkan data terbaru tersebut.

## 5.5 Manajemen Data Akademik & Kemahasiswaan
Fitur ini berfokus pada pengelolaan data entitas akademik yang kompleks dengan relasi database yang kuat.

### a. Sub-Menu Kelola Dosen
Modul Data Dosen menampilkan daftar pengajar dalam bentuk tabel data yang mendukung fitur pencarian (*search*) dan penyaringan (*filter*) di sisi klien. Hal ini membuat pencarian dosen spesifik menjadi sangat cepat karena tidak perlu selalu meminta data baru ke server saat melakukan filtering sederhana. Untuk operasi tambah/edit dosen, sistem menggunakan Modal Pop-up (Jendela Dialog) agar pengguna tetap berada di konteks halaman yang sama. Data NIDN, Nama, dan Kualifikasi dikirim ke *endpoint* `/api/dosen`, di mana Flask menggunakan ORM (Object Relational Mapping) SQLAlchemy untuk menyimpan data tersebut ke tabel MySQL secara aman dan terstruktur.

### b. Sub-Menu Kelola Kurikulum
Pada fitur ini, admin mengunggah dokumen PDF kurikulum. Backend Flask dikonfigurasi untuk menerima *multipart/form-data* guna menangani upload file dokumen. File disimpan dengan penamaan unik untuk mencegah duplikasi, sementara path/lokasi file disimpan di database. Di sisi frontend, Next.js menyediakan link unduhan yang aman menuju file tersebut.

### c. Sub-Menu Kelola Penelitian & Pengabdian
Modul ini mencatat rekam jejak Tri Dharma perguruan tinggi. Formulir input dirancang untuk menerima metadata penelitian (Judul, Tahun, Sumber Dana) serta link ke jurnal eksternal. Validasi data dilakukan dua lapis: validasi antarmuka di Next.js (seperti format email atau field wajib) dan validasi logika bisnis di Flask, menjamin integritas data yang masuk ke sistem.

### d. Sub-Menu Kelola BEM
Struktur organisasi mahasiswa dikelola dengan antarmuka *grid* yang menampilkan kartu profil pengurus BEM. Admin dapat mengurutkan atau mengubah hierarki pengurus. Foto pengurus yang diunggah akan di-*resize* otomatis oleh backend agar ukurannya optimal saat diakses melalui perangkat mobile.

### e. Sub-Menu Pendaftaran Mahasiswa (PMB)
Halaman ini berfungsi memantau data pelamar. Integrasi WhatsApp diimplementasikan dengan memformat nomor telepon pelamar menjadi link `wa.me` secara otomatis di frontend. Status kelulusan pelamar (Diterima/Ditolak) diubah melalui *dropdown* status yang memicu API update status. Backend memastikan bahwa perubahan status ini tercatat waktu dan admin yang mengubahnya (*audit trail*).

## 5.6 Manajemen Dokumen & Sarana

### a. Dokumen Rencana (Renstra & Renop) & SOP
Pengelolaan dokumen strategis menggunakan sistem repositori file. Backend Flask menyediakan *endpoint* khusus untuk melayani file-file statis ini dengan pengaturan *header* HTTP yang tepat, sehingga browser dapat menampilkan preview PDF langsung atau men-downloadnya sesuai preferensi pengguna.

### b. Kelola Fasilitas
Data ruangan dan laboratorium ditampilkan dengan galeri foto interaktif. Next.js mengoptimalkan tampilan galeri ini dengan teknik *lazy loading*, di mana gambar fasilitas baru akan dimuat ketika pengguna men-scroll ke area tersebut, menghemat penggunaan *bandwidth* internet.

## 5.7 Pengaturan dan Keamanan Akun
Fitur manajemen akun admin memungkinkan pembaruan *username* dan *password*. Keamanan menjadi prioritas utama di sini; kata sandi baru akan di-*hash* menggunakan algoritma kriptografi yang kuat (seperti Bcrypt atau Argon2) di sisi server Flask sebelum disimpan ke database. Fitur Logout bekerja dengan membatalkan validitas token JWT di sisi klien (menghapus cookie/storage), memastikan sesi benar-benar berakhir dan tidak dapat digunakan kembali oleh pihak yang tidak berwenang.
