# Implementasi Antarmuka Halaman Admin

Berikut adalah penjelasan detail mengenai tampilan dan fungsi dari setiap halaman pada dashboard administrator yang telah diimplementasikan dalam sistem website Fakultas Ilmu Komputer.

## 1. Halaman Dashboard Utama
**File:** `dashboard.php`

Halaman Dashboard merupakan tampilan antarmuka utama yang pertama kali diakses oleh administrator setelah berhasil melewati proses login. Halaman ini dirancang untuk memberikan gambaran umum atau *overview* mengenai kondisi terkini sistem melalui ringkasan data statistik. Di bagian atas, terdapat kartu-kartu statistik (*Stats Cards*) yang menampilkan jumlah total data penting secara *real-time*, seperti total dosen aktif, jumlah berita yang telah dipublikasikan, total judul penelitian yang terdata, serta jumlah fasilitas fisik (ruangan dan laboratorium) yang dimiliki fakultas. Penempatan informasi ini bertujuan agar pengelola dapat memantau volume data operasional secara cepat tanpa harus membuka menu satu per satu.

Selain ringkasan angka, dashboard juga dilengkapi dengan dua tabel aktivitas terbaru, yaitu tabel "Berita Terbaru" dan "Penelitian Terbaru". Tabel ini menampilkan lima data terakhir yang baru saja ditambahkan ke dalam sistem, memungkinkan administrator untuk segera melihat pembaruan atau input data yang baru masuk. Desain halaman ini mengutamakan keterbacaan dan kecepatan akses informasi, sehingga administrator dapat segera mengambil tindakan manajerial yang diperlukan.

## 2. Manajemen Konten Informasi
Modul ini berfungsi sebagai pusat kendali untuk mengelola seluruh informasi publik yang akan ditampilkan pada halaman depan (*front-end*) website fakultas.

### a. Kelola Berita
**File:** `admin_kelola_berita.php`

Halaman Kelola Berita memfasilitasi administrator dalam mempublikasikan berbagai jenis informasi, mulai dari berita kegiatan kampus, pengumuman akademik, hingga agenda fakultas. Melalui antarmuka ini, admin dapat melakukan operasi CRUD (*Create, Read, Update, Delete*) secara lengkap. Saat menambahkan berita baru, sistem menyediakan formulir yang meminta input judul artikel, kategori berita (misalnya Berita, Pengumuman, atau Kemahasiswaan), tanggal publikasi, tautan eksternal jika diperlukan, serta editor konten utama. Fitur unggulan lainnya adalah kemampuan untuk mengunggah foto utama (*thumbnail*) yang akan disimpan secara otomatis ke dalam direktori server, memastikan tampilan visual berita di halaman depan terlihat menarik dan profesional.

### b. Kelola Slider (Hero Image)
**File:** `admin_kelola_slider.php`

Fitur Kelola Slider bertanggung jawab atas pengaturan gambar spanduk utama (*hero image*) yang muncul di bagian paling atas halaman beranda. Administrator memiliki kendali penuh untuk mengunggah gambar promosi atau dokumentasi kegiatan terbaru yang ingin ditonjolkan kepada pengunjung website. Selain fitur unggah dan hapus, halaman ini menyediakan opsi untuk mengaktifkan atau menonaktifkan (*toggle*) status aktivitas slider tertentu tanpa harus menghapusnya, memberikan fleksibilitas dalam mengatur materi promosi visual sesuai dengan momentum atau acara yang sedang berlangsung di fakultas.

### c. Kelola Profil Fakultas
Sub-modul ini terdiri dari beberapa halaman yang saling terintegrasi untuk menyusun profil lengkap fakultas. Halaman **Tentang Fakultas** (`admin_kelola_tentangfak.php`) digunakan untuk menyunting narasi sejarah atau deskripsi singkat fakultas beserta gambar pendukungnya. Halaman **Visi Misi** (`admin_kelola_visimisi.php`) menyediakan editor khusus untuk memperbarui pernyataan visi organisasi, serta tabel interaktif untuk menambah, mengubah, atau menghapus poin-poin misi, tujuan, dan sasaran secara dinamis. Untuk memvisualisasikan hierarki manajemen, halaman **Struktur Organisasi** (`admin_kelola_struktur.php`) memungkinkan administrator mengunggah dan mengganti gambar bagan struktur organisasi terbaru. Terakhir, halaman **Data Fakta** (`admin_kelola_fakta.php`) mengelola angka-angka statistik pencapaian fakultas, seperti jumlah mahasiswa, alumni, dan dosen, yang nantinya ditampilkan dalam bentuk penghitung angka (*counter*) animasi di beranda untuk menunjukkan kredibilitas institusi.

## 3. Manajemen Akademik & Kemahasiswaan
Modul ini merupakan inti dari sistem administrasi yang menangani data operasional akademik serta kegiatan kemahasiswaan.

### a. Kelola Dosen
**File:** `admin_kelola_dosen.php`

Halaman Kelola Dosen berfungsi sebagai basis data utama untuk profil tenaga pengajar di fakultas. Administrator dapat mengelola informasi detail setiap dosen, yang mencakup Nomor Induk Dosen Nasional (NIDN), nama lengkap beserta gelar, jabatan fungsional akademik, riwayat pendidikan terakhir, hingga bidang keahlian spesifik. Selain data tekstual, sistem juga mendukung pengunggahan foto profil dosen untuk ditampilkan pada menu direktori staf di website publik. Halaman ini juga dilengkapi dengan panel statistik ringkas yang mengklasifikasikan jumlah dosen berdasarkan jenjang pendidikan (S2 dan S3), membantu pimpinan dalam memetakan kualitas sumber daya manusia (SDM) yang dimiliki.

### b. Kelola Kurikulum
**File:** `admin_kelola_kurikulum.php`

Fitur Kelola Kurikulum dirancang untuk mendistribusikan informasi mengenai struktur mata kuliah dan pedoman akademik kepada mahasiswa dan publik. Melalui halaman ini, administrator dapat mengunggah dokumen kurikulum dalam format PDF untuk setiap program studi, serta menyertakan nama kurikulum dan deskripsi singkatnya. File yang diunggah akan tersedia untuk diunduh (*download*) oleh pengunjung website, memastikan transparansi dan kemudahan akses terhadap informasi kurikulum yang berlaku saat ini.

### c. Kelola Kalender Akademik
**File:** `admin_kelola_kalender.php`

Halaman ini digunakan untuk mempublikasikan jadwal kegiatan akademik tahunan. Administrator dapat memasukkan data nama kalender, tahun akademik (seperti 2023/2024), serta deskripsi kegiatan. Selain itu, fitur ini mendukung pengunggahan representasi visual kalender dalam format gambar, sehingga mahasiswa dapat melihat linimasa kegiatan akademik—mulai dari periode perwalian, perkuliahan, hingga ujian—dengan lebih jelas dan menarik.

### d. Kelola Penelitian & Pengabdian
Sistem ini memisahkan pengelolaan data tridharma perguruan tinggi menjadi dua bagian. Halaman **Penelitian** (`admin_kelola_penelitian.php`) mengarsipkan data riset dosen, mencakup judul penelitian, nama peneliti, tahun pelaksanaan, sumber dana, serta tautan publikasi. Admin juga dapat mengunggah dokumen proposal dan laporan akhir sebagai arsip digital. Sementara itu, halaman **Pengabdian** (`admin_kelola_pengabdian.php`) khusus mencatat kegiatan Pengabdian Kepada Masyarakat (PKM), dengan kolom data untuk judul kegiatan, pelaksana, tanggal, deskripsi, serta fail laporan kegiatan, guna mendokumentasikan kontribusi sosial fakultas.

### e. Kelola Kerjasama
**File:** `admin_kelola_kerjasama.php`

Halaman Kelola Kerjasama didedikasikan untuk mendata mitra-mitra strategis fakultas, baik dari kalangan industri maupun institusi pendidikan lainnya. Pada halaman ini, administrator menginput nama instansi mitra, periode kerjasama (bulan dan tahun), tautan ke website resmi mitra, serta mengunggah logo instansi terkait. Logo-logo mitra yang telah diinput akan ditampilkan dalam bentuk galeri di bagian *footer* atau segmen kerjasama pada website utama, menegaskan jejaring luas yang dimiliki oleh fakultas.

### f. Kelola BEM (Kemahasiswaan)
**File:** `admin_kelola_bem.php`

Fitur ini memfasilitasi pengelolaan struktur organisasi Badan Eksekutif Mahasiswa (BEM). Administrator dapat memperbarui susunan kepengurusan dengan menambahkan data anggota baru yang meliputi nama lengkap, jabatan yang diemban, program studi, dan kategori kepengurusan (seperti Pimpinan Inti, Sekretaris/Bendahara, atau Departemen). Sistem juga memungkinkan pengunggahan foto diri pengurus, sehingga struktur organisasi BEM dapat ditampilkan secara visual dan transparan kepada seluruh mahasiswa.

### g. Data Pendaftaran Mahasiswa
**File:** `admin_kelola_pendaftaran.php`

Halaman ini berfungsi sebagai panel monitoring untuk proses Penerimaan Mahasiswa Baru (PMB) yang dilakukan secara daring. Administrator dapat melihat daftar calon mahasiswa yang masuk dalam tabel responsif yang memuat Nama, NIK, Program Studi pilihan, Jalur Masuk, dan Nomor HP yang terintegrasi langsung dengan perintah klik-ke-WhatsApp. Fitur utamanya adalah manajemen status seleksi, di mana admin dapat mengubah status pendaftaran pelamar menjadi "Pending", "Diterima", atau "Ditolak", yang ditandai dengan perubahan warna indikator status. Tersedia pula fitur *modal popup* untuk melihat detail biodata pelamar serta tautan untuk memeriksa dan mengunduh berkas persyaratan seperti KTP dan Ijazah.

## 4. Manajemen Dokumen & Sarana
Bagian ini menangani pengarsipan dokumen legalitas fakultas serta inventarisasi fasilitas fisik kampus.

### a. Dokumen Mutu (SPMI)
Pengelolaan dokumen penjaminan mutu terbagi menjadi tiga halaman spesifik untuk memastikan pengarsipan yang rapi. Halaman **RenOp** (`admin_kelola_renop.php`) digunakan untuk dokumen Rencana Operasional, **Renstra** (`admin_kelola_renstra.php`) untuk Rencana Strategis jangka panjang, dan **SOP** (`admin_kelola_sop.php`) untuk Standar Operasional Prosedur. Ketiga halaman ini memiliki kesamaan fungsi teknis, yaitu memungkinkan administrator untuk mengunggah dokumen resmi dalam format PDF, Word, atau Excel dengan batas ukuran file yang memadai, serta menyertakan judul dan deskripsi dokumen untuk memudahkan pencarian dan aksesibilitas publik.

### b. Fasilitas (Ruangan & Lab)
**File:** `admin_kelola_ruangan.php`

Halaman Kelola Fasilitas bertujuan untuk mempromosikan sarana dan prasarana pembelajaran yang dimiliki kampus. Administrator dapat mengelola data ruangan kelas dan laboratorium dengan memasukkan nama ruangan, deskripsi kegunaan atau peralatan yang tersedia, serta foto kondisi ruangan. Data ini penting untuk memberikan gambaran visual mengenai kelayakan dan kenyamanan fasilitas belajar kepada calon mahasiswa maupun orang tua.

## 5. Pengaturan Sistem
Modul terakhir ini berkaitan dengan personalisasi akun dan keamanan akses administrator.

### a. Profil Admin & Keamanan
**File:** `admin_profile.php`

Halaman Profil Admin memberikan akses kepada pengguna untuk mengelola informasi akun pribadi mereka. Terdapat formulir untuk memperbarui data identitas seperti Username dan Email. Selain itu, aspek keamanan sangat ditekankan melalui fitur **Ganti Password**, yang mewajibkan pengguna memasukkan kata sandi lama sebelum membuat kata sandi baru, untuk mencegah akses yang tidak sah. Terdapat pula tombol **Logout** yang berfungsi untuk mengakhiri sesi kerja administrator secara aman, memastikan tidak ada penyalahgunaan akun setelah pengguna selesai beraktivitas.
