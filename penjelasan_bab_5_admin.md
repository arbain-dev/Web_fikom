# Implementasi Antarmuka Backend (Administrator)

Berikut adalah draf penjelasan Bab 5: Hasil dan Pembahasan untuk bagian implementasi antarmuka halaman administrator (*backend*).

---

## 5.1 Deskripsi Umum Sistem Backend

Halaman administrator (*backend*) pada website Fakultas Ilmu Komputer dirancang secara khusus sebagai *Content Management System* (CMS) yang berfungsi untuk mengelola seluruh data dan informasi yang ditampilkan pada halaman utama (*frontend*). Tujuan utama dari pembangunan sistem antarmuka berbasis web ini adalah untuk memberikan kemudahan bagi staf pengelola fakultas dalam melakukan pembaruan konten secara mandiri tanpa memerlukan intervensi teknis atau koding ulang. Antarmuka backend ini dibangun dengan mengedepankan prinsip desain yang bersih dan navigasi yang intuitif, serta didukung oleh mekanisme keamanan berbasis sesi (*session-based authentication*) untuk memastikan bahwa akses pengelolaan data hanya diberikan kepada pengguna yang memiliki hak otoritas.

## 5.2 Implementasi Halaman Login

Halaman Login berfungsi sebagai gerbang keamanan utama sistem yang bertugas memverifikasi identitas pengguna sebelum memberikan hak akses ke dalam dashboard. Secara visual, antarmuka halaman ini didominasi oleh panel login interaktif yang terletak di tengah layar dengan latar belakang gedung fakultas yang diberi efek buram (*blur effect*) untuk menonjolkan area input. Identitas sistem dipertegas melalui penempatan logo universitas dan judul "Login Admin" di bagian atas panel.

Dari sisi fungsionalitas, sistem login ini bekerja dengan menerima input kredensial berupa username dan password dari pengguna. Data yang dimasukkan akan divalidasi dan dicocokkan dengan rekaman data yang tersimpan di tabel `users` pada database. Untuk aspek keamanan, sistem menggunakan algoritma *hashing* dalam memverifikasi kata sandi, sehingga password asli pengguna tidak pernah tersimpan dalam bentuk teks terang (*plain text*) yang rentan. Jika proses autentikasi berhasil, sistem akan membuat variabel sesi `$_SESSION['admin_logged_in']` sebagai token akses resmi, namun jika kredensial tidak sesuai atau kolom input dikosongkan, sistem akan secara otomatis menolak akses dan menampilkan pesan peringatan (*alert*) yang relevan kepada pengguna.

## 5.3 Implementasi Dashboard Utama

Dashboard Utama merupakan halaman pusat informasi yang pertama kali diakses oleh administrator setelah berhasil melewati proses login. Halaman ini dirancang untuk menyajikan gambaran cepat (*overview*) mengenai status terkini sistem. Di bagian atas halaman, terdapat deretan kartu statistik (*Stats Cards*) yang menampilkan ringkasan jumlah data penting secara *real-time*, seperti total dosen aktif, jumlah berita yang terpublikasi, statistik penelitian, serta data fasilitas yang tersedia, dengan setiap kategori dibedakan menggunakan ikon representatif dan kode warna yang unik.

Selain ringkasan angka, dashboard juga dilengkapi dengan tabel aktivitas yang terletak di bagian bawah, yang menampilkan daftar entri data terbaru seperti "Berita Terbaru" dan "Penelitian Terbaru". Fitur pemantauan ini memungkinkan administrator untuk mengetahui pembaruan data terakhir tanpa harus membuka menu secara manual satu per satu. Untuk navigasi, tersedia *sidebar* di sebelah kiri yang menyediakan akses pintas (*shortcut*) menuju seluruh modul pengelolaan sistem, memudahkan pengguna berpindah antar fitur dengan cepat dan efisien.

## 5.4 Manajemen Konten Informasi

Menu ini terdiri dari beberapa sub-menu yang berfungsi untuk mengelola seluruh informasi publik yang akan ditampilkan di website.

### a. Sub-Menu Kelola Berita

Sub-menu Kelola Berita berfungsi sebagai modul utama untuk mempublikasikan berbagai jenis informasi, mulai dari berita harian, pengumuman akademik, hingga artikel kegiatan kemahasiswaan. Modul ini mendukung operasi CRUD (*Create, Read, Update, Delete*) secara lengkap. Administrator dapat menambahkan berita baru dengan mengisi judul, memilih kategori (seperti Berita atau Pengumuman), menentukan tanggal publikasi, menyematkan tautan eksternal, menulis konten berita, serta mengunggah foto *thumbnail* yang relevan. Sistem juga menyediakan tabel rekapitulasi untuk melihat daftar berita yang telah ada, fitur penyuntingan untuk memperbarui konten berita yang sudah terbit, serta opsi penghapusan data yang secara otomatis akan menghapus rekaman di database sekaligus membersihkan file gambar fisik dari direktori server.

### b. Sub-Menu Kelola Slider (Hero Image)

Sub-menu Kelola Slider didedikasikan untuk pengaturan tampilan visual utama atau spanduk (*banner*) yang muncul di bagian paling atas halaman beranda website. Melalui antarmuka ini, admin dapat mengunggah gambar-gambar resolusi tinggi yang merepresentasikan wajah fakultas atau mempromosikan kegiatan unggulan. Fitur khusus yang disematkan pada modul ini adalah adanya sakelar status (*toggle switch*), yang memungkinkan admin untuk menyembunyikan atau menampilkan slider tertentu sewaktu-waktu tanpa harus menghapus datanya secara permanen, memberikan fleksibilitas dalam mengatur materi promosi visual sesuai kebutuhan.

### c. Sub-Menu Kelola Visi & Misi

Sub-menu ini digunakan untuk mengelola konten statis yang berkaitan dengan profil fundamental fakultas, yaitu Visi, Misi, dan Tujuan. Pengelolaan data dilakukan melalui formulir input yang disesuaikan dengan jenis datanya. Untuk Visi yang berupa narasi tunggal, sistem menyediakan *text area* untuk penyuntingan. Sementara untuk Misi dan Tujuan yang terdiri atas beberapa poin, sistem mengimplementasikan tabel dinamis yang memungkinkan administrator menambah, mengedit, atau menghapus poin-poin items satu per satu. Pendekatan ini memastikan bahwa tampilan data di sisi *frontend* tetap terstruktur rapi dan mudah dibaca oleh pengunjung.

### d. Sub-Menu Kelola Struktur Organisasi

Sub-menu Struktur Organisasi berfungsi untuk memperbarui bagan hierarki kepemimpinan fakultas. Mengingat kompleksitas visual dari sebuah bagan organisasi, sistem ini menggunakan mekanisme berbasis unggah gambar (*image upload*). Administrator cukup mengunggah file gambar bagan terbaru dalam format JPG atau PNG, dan sistem akan secara otomatis menggantikan gambar lama di database dan direktori penyimpanan. Hal ini menyederhanakan proses update struktur organisasi tanpa perlu menyusun ulang elemen visual menggunakan kode HTML/CSS secara manual.

### e. Sub-Menu Kelola Data Fakta (Counter)

Sub-menu Kelola Data Fakta bertanggung jawab untuk mengelola widget "Counter Angka" yang tampil secara dinamis di halaman beranda. Administrator dapat memperbarui data kuantitatif strategis yang menjadi indikator capaian fakultas, seperti jumlah total mahasiswa aktif, jumlah lulusan/alumni yang telah dicetak, serta jumlah program studi yang tersedia. Angka-angka ini ditampilkan dengan efek animasi penghitung (*counter animation*) pada antarmuka *front-end*, memberikan kesan profesional dan menunjukkan kredibilitas institusi dalam bentuk data nyata.

## 5.5 Manajemen Data Akademik & Kemahasiswaan

Menu ini difokuskan pada pengelolaan data operasional akademik dan data terkait kemahasiswaan yang bersifat dinamis.

### a. Sub-Menu Kelola Dosen

Sub-menu Kelola Dosen merupakan basis data digital untuk profil seluruh tenaga pengajar di lingkungan fakultas. Sistem menyimpan atribut data yang lengkap untuk setiap dosen, mencakup Nama Lengkap, Nomor Induk Dosen Nasional (NIDN), Program Studi naungan, Jenjang Pendidikan Terakhir (S2/S3), Jabatan Akademik, Status Kepegawaian (Tetap/Kontrak), alamat email resmi, serta foto profil. Mengingat banyaknya jumlah data dosen, halaman ini dilengkapi dengan fitur filter berdasarkan "Program Studi" yang memudahkan administrator mencari dosen tertentu. Selain itu, terdapat panel statistik di bagian atas halaman yang memvisualisasikan komposisi SDM dosen berdasarkan kualifikasi pendidikannya (Doktor vs Magister), membantu pimpinan dalam analisis data SDM.

### b. Sub-Menu Kelola Kurikulum

Sub-menu Kurikulum dirancang untuk mendistribusikan dokumen pedoman akademik kepada mahasiswa dan publik. Melalui fitur ini, administrator dapat mengunggah file dokumen kurikulum dalam format PDF dan melabelinya sesuai dengan Program Studi masing-masing. Sistem akan melakukan pemetaan (*mapping*) otomatis, sehingga file kurikulum yang diunggah akan tampil di halaman prodi yang relevan di sisi *frontend* dan tersedia untuk diunduh (*download*) oleh pengunjung yang membutuhkan informasi mengenai sebaran mata kuliah.

### c. Sub-Menu Kelola Kalender Akademik

Sub-menu Kalender Akademik digunakan untuk mempublikasikan jadwal kegiatan akademik tahunan. Administrator dapat memasukkan data periode tahun akademik (misalnya 2025/2026), deskripsi kegiatan, serta mengunggah representasi visual kalender dalam format gambar. Fitur ini sangat krusial bagi mahasiswa untuk mengetahui linimasa penting perkuliahan, mulai dari jadwal pembayaran, periode perwalian, hingga jadwal ujian, yang disajikan secara informatif dan mudah diakses.

### d. Sub-Menu Kelola Penelitian & Pengabdian

Sub-menu ini berfungsi sebagai repositori digital untuk mengarsipkan rekam jejak pelaksanaan Tridharma Perguruan Tinggi, khususnya bidang penelitian dan pengabdian masyarakat. Dalam modul ini, sistem tidak hanya menyimpan metadata kegiatan seperti Judul, Nama Peneliti, dan Tahun Pelaksanaan, tetapi juga mewajibkan pengunggahan dokumen bukti fisik berupa file "Proposal" dan "Laporan Akhir". Administrator juga disediakan kolom khusus untuk menyematkan tautan URL menuju publikasi jurnal eksternal, sehingga data penelitian dosen terintegrasi dengan baik dan mudah diakses untuk keperluan akreditasi.

### e. Sub-Menu Kelola Kerjasama

Sub-menu Kerjasama digunakan untuk mendata dan menampilkan daftar mitra strategis fakultas, baik dari kalangan industri maupun sesama institusi pendidikan. Fitur utamanya meliputi manajemen logo mitra, di mana admin dapat mengunggah gambar logo instansi untuk ditampilkan dalam galeri kerjasama di website. Sistem juga mencatat periode mula kerjasama (bulan dan tahun), yang berguna bagi administrator untuk memonitor masa berlaku *Memorandum of Understanding* (MoU) dengan masing-masing mitra.

### f. Sub-Menu Kelola BEM (Badan Eksekutif Mahasiswa)

Sub-menu Kelola BEM memfasilitasi pengelolaan informasi struktur organisasi kemahasiswaan. Melalui halaman ini, administrator dapat memperbarui susunan pengurus BEM dengan menambahkan data personal anggota, termasuk nama lengkap, jabatan (seperti Ketua, Sekretaris, atau Kepala Departemen), program studi asal, serta foto diri. Tujuannya adalah untuk memberikan transparansi mengenai kepengurusan organisasi mahasiswa kepada seluruh civitas akademika, sehingga profil pengurus BEM dapat ditampilkan secara visual dan terorganisir di halaman organisasi.

### g. Sub-Menu Pendaftaran Mahasiswa (PMB)

Sub-menu Pendaftaran Mahasiswa berfungsi sebagai panel kendali (*control panel*) untuk memantau proses Penerimaan Mahasiswa Baru yang masuk melalui website. Halaman ini menampilkan tabel data pelamar yang komprehensif, mencakup NIK, Nama, dan Pilihan Program Studi. Salah satu fitur unggulannya adalah integrasi dengan WhatsApp API, di mana nomor handphone pelamar dikonversi secara otomatis menjadi tautan interaktif yang memungkinkan admin menghubungi calon mahasiswa melalui WhatsApp hanya dengan satu klik. Selain itu, admin memiliki otoritas penuh untuk memverifikasi berkas persyaratan (seperti KTP dan Ijazah) yang diunggah serta mengubah status kelulusan pelamar menjadi "Diterima", "Ditolak", atau "Pending", yang akan langsung tercermin pada antarmuka pengguna melalui indikator warna status.

## 5.6 Manajemen Dokumen & Sarana

Bagian ini mencakup pengelolaan arsip dokumen resmi fakultas serta data sarana prasarana kampus.

### a. Sub-Menu Kelola Dokumen Rencana (Renstra & Renop)

Sub-menu ini terbagi menjadi dua bagian untuk mengelola dokumen perencanaan strategis fakultas. Bagian **Renstra** (Rencana Strategis) digunakan untuk mengarsipkan dokumen perencanaan jangka panjang (5 tahunan), sedangkan bagian **Renop** (Rencana Operasional) digunakan untuk dokumen perencanaan tahunan. Administrator dapat mengunggah file dokumen dalam format PDF dan memberikan deskripsi singkat mengenai periode berlakunya dokumen tersebut. Fitur ini memastikan transparansi arah kebijakan fakultas yang dapat diakses oleh publik maupun pihak internal yang berkepentingan.

### b. Sub-Menu Kelola SOP (Standar Operasional Prosedur)

Sub-menu Kelola SOP berfungsi sebagai perpustakaan digital untuk kumpulan prosedur baku yang berlaku di lingkungan fakultas. Setiap SOP, seperti prosedur pendaftaran skripsi atau pengajuan cuti, dapat diunggah dan diberi nama spesifik agar mudah dicari. Hal ini bertujuan untuk menyediakan akses mandiri bagi mahasiswa dan dosen terhadap pedoman-pedoman akademik, mengurangi ketergantungan pada pelayanan informasi tatap muka di sekretariat.

### c. Sub-Menu Kelola Fasilitas (Ruangan & Lab)

Sub-menu Kelola Fasilitas bertujuan untuk mempromosikan sarana pembelajaran yang dimiliki oleh kampus. Administrator dapat mengelola inventaris ruangan kelas dan laboratorium komputer dengan memasukkan detail nama ruangan, spesifikasi peralatan yang tersedia, serta foto kondisi ruangan terkini. Informasi visual ini sangat penting untuk memberikan gambaran nyata mengenai kualitas sarana pendidikan kepada calon mahasiswa dan orang tua sebagai bagian dari upaya promosi fasilitas.

## 5.7 Pengaturan dan Utilitas

Bagian terakhir ini mencakup fitur-fitur pendukung untuk manajemen akun dan keamanan sistem. Fitur "Kelola Akun Admin" memfasilitasi pengguna untuk memperbarui informasi kredensial mereka, seperti mengubah *username* dan *password* secara berkala demi menjaga keamanan akun. Selain itu, terdapat fitur "Logout" yang berfungsi untuk mengakhiri sesi kerja administrator secara aman, memastikan bahwa seluruh data sesi di *browser* dihapus untuk mencegah risiko penyalahgunaan akses oleh pihak yang tidak berwenang.
