# Diagram Urutan (Sequence Diagram) — Website Fakultas Ilmu Komputer UNISAN

## Pengertian Sequence Diagram

*Sequence Diagram* merupakan salah satu jenis diagram interaksi dalam *Unified Modeling Language* (UML) yang secara khusus bertujuan untuk merepresentasikan urutan pertukaran pesan (*message exchange*) antar objek atau komponen dalam suatu sistem secara kronologis. Diagram ini membaca alur interaksi dari atas ke bawah sesuai urutan waktu terjadinya, sehingga sangat efektif untuk memvisualisasikan skenario penggunaan (*use case*) tertentu beserta respons yang dihasilkan sistem pada setiap tahap. Penggunaan *Sequence Diagram* dalam dokumentasi teknis akademik bertujuan untuk menjelaskan protokol komunikasi antar lapisan arsitektur sistem secara rinci dan terstruktur.

Dalam sistem Web FIKOM, tiga komponen utama yang berinteraksi adalah: **Frontend** (Browser pengunjung/admin), **Backend** (Server PHP), dan **Database** (MySQL `db_web_fikom`).

---

## 2.1 Sequence Diagram — Autentikasi Login Administrator

```mermaid
sequenceDiagram
    participant FE as 🖥️ Frontend (Browser)
    participant BE as ⚙️ Backend (PHP)
    participant DB as 🗄️ Database (MySQL)

    FE->>BE: POST /admin/login [login_identifier, password]
    BE->>BE: Validasi field tidak kosong
    alt Field kosong
        BE-->>FE: Redirect → /admin/login [error: "Wajib diisi"]
    else Field terisi
        BE->>DB: SELECT id, username, password FROM users WHERE username=? OR email=? LIMIT 1
        DB-->>BE: Result row / null
        alt User tidak ditemukan
            BE-->>FE: Tampilkan pesan "Username atau Password salah"
        else User ditemukan
            BE->>BE: password_verify($password, $hash)
            alt Password tidak cocok
                BE-->>FE: Tampilkan pesan "Username atau Password salah"
            else Password cocok
                BE->>BE: Set $_SESSION['admin_logged_in'] = true
                BE->>BE: Set $_SESSION['user_id'], ['username']
                BE-->>FE: HTTP 302 Redirect → /admin/dashboard
            end
        end
    end
```

***Gambar 2.1** Sequence Diagram Autentikasi Login Administrator*

Diagram ini mengilustrasikan protokol autentikasi administrator sistem Web FIKOM. Proses dimulai dengan pengiriman data formulir menggunakan metode `POST` ke `admin/login.php` yang memuat `login_identifier` (dapat berupa *username* atau *email*) dan *password*. *Backend* PHP memvalidasi kelengkapan *field* terlebih dahulu sebelum mengeksekusi *query* `SELECT` ke tabel `users` menggunakan *Prepared Statement* untuk mencegah injeksi SQL. **Verifikasi kata sandi** dilakukan melalui fungsi `password_verify()` yang membandingkan input pengguna dengan nilai *hash* bcrypt yang tersimpan di basis data. Apabila seluruh tahap validasi berhasil, sesi PHP diregistrasi dan sistem mengembalikan respons HTTP 302 *redirect* ke halaman *dashboard*; pada setiap skenario kegagalan, sistem menampilkan pesan kesalahan generik yang tidak mengungkapkan detail kegagalan untuk alasan keamanan.

---

## 2.2 Sequence Diagram — Tambah Data Berita (Create)

```mermaid
sequenceDiagram
    participant FE as 🖥️ Frontend (Admin Browser)
    participant BE as ⚙️ Backend (PHP)
    participant FS as 📁 File System
    participant DB as 🗄️ Database (MySQL)

    FE->>BE: POST /admin/kelola_berita [judul, kategori, tanggal, konten, foto]
    BE->>BE: Validasi: judul, kategori, tanggal tidak kosong
    alt Validasi gagal
        BE-->>FE: Tampilkan pesan error validasi
    else Validasi berhasil
        alt Ada file foto
            BE->>BE: generateSafeFileName(originalName)
            Note right of BE: time() + md5(uniqid(rand()))
            BE->>FS: move_uploaded_file(tmp_name, /uploads/berita/safeName)
            FS-->>BE: true / false
        end
        BE->>DB: INSERT INTO berita (judul, kategori, tanggal_publish, link, konten, foto)
        DB-->>BE: Affected rows = 1
        BE-->>FE: Tampilkan "✓ Berita berhasil ditambahkan!"
    end
```

***Gambar 2.2** Sequence Diagram Tambah Data Berita*

Diagram ini merepresentasikan alur penambahan data berita baru ke sistem. *Backend* PHP menerima data formulir multipart yang berisi teks berita dan opsional file foto. Validasi dilakukan pada tiga *field* wajib: judul, kategori, dan tanggal publikasi. **Apabila foto diunggah**, sistem mengeksekusi fungsi `generateSafeFileName()` yang menghasilkan nama file unik berbasis gabungan `time()` dan `md5(uniqid(rand(), true))` untuk mencegah konflik penggantian nama file (*filename collision*). File kemudian dipindahkan ke direktori `uploads/berita/` menggunakan `move_uploaded_file()`. Data berita kemudian disimpan ke tabel `berita` melalui *query* `INSERT` dengan *Prepared Statement* yang mengikat enam parameter bertipe string secara berurutan.

---

## 2.3 Sequence Diagram — Edit Data Berita (Update)

```mermaid
sequenceDiagram
    participant FE as 🖥️ Frontend (Admin Browser)
    participant BE as ⚙️ Backend (PHP)
    participant FS as 📁 File System
    participant DB as 🗄️ Database (MySQL)

    FE->>BE: POST /admin/kelola_berita [action=edit, id, judul, foto_lama, foto_baru?]
    BE->>BE: Validasi field wajib
    alt Ada foto baru
        BE->>BE: generateSafeFileName(namaFileBaru)
        BE->>FS: move_uploaded_file ke /uploads/berita/namaFileBaru
        FS-->>BE: true
        BE->>FS: safeDeleteFile(/uploads/berita/foto_lama)
        Note right of FS: Retry sampai 3x dengan jeda 100ms
        FS-->>BE: true
    end
    BE->>DB: UPDATE berita SET judul=?, kategori=?, tanggal_publish=?, link=?, konten=?, foto=? WHERE id=?
    DB-->>BE: Affected rows = 1
    BE-->>FE: Tampilkan "✓ Berita berhasil diperbarui!"
```

***Gambar 2.3** Sequence Diagram Edit Data Berita*

Diagram ini menggambarkan alur pembaruan data berita yang sudah ada. Formulir mengirimkan referensi foto lama (`foto_lama`) sebagai *hidden input* untuk memungkinkan sistem mengambil keputusan penghapusan. **Mekanisme penggantian foto** mengimplementasikan strategi *replace-then-delete*: file baru lebih dahulu dipindahkan ke direktori tujuan, kemudian file lama dihapus menggunakan fungsi `safeDeleteFile()` yang mencoba penghapusan hingga tiga iterasi dengan jeda `usleep(100000)` (100ms) antar percobaan untuk menangani kemungkinan *file lock* pada sistem operasi Windows/*XAMPP*. Operasi `UPDATE` ke tabel `berita` menggunakan *Prepared Statement* dengan tujuh parameter untuk memastikan keamanan data.

---

## 2.4 Sequence Diagram — Upload Foto dan Hapus File Lama (Dosen)

```mermaid
sequenceDiagram
    participant FE as 🖥️ Frontend (Admin Browser)
    participant BE as ⚙️ Backend (PHP)
    participant FS as 📁 File System
    participant DB as 🗄️ Database (MySQL)

    FE->>BE: POST /admin/kelola_dosen [action=tambah_dosen/edit_dosen, data_dosen, foto?]
    BE->>BE: Validasi: nama, email, prodi, pendidikan, status wajib diisi
    alt Ada file foto
        BE->>BE: Cek ekstensi: in_array(ext, [jpg, jpeg, png, webp])
        BE->>BE: Cek ukuran: size <= 2,000,000 bytes (2MB)
        alt Foto valid
            BE->>BE: Generate: time() + '-' + uniqid() + '.ext'
            BE->>FS: move_uploaded_file ke /uploads/dosen/
            FS-->>BE: true
            alt Action = edit_dosen DAN ada foto_lama
                BE->>FS: @unlink(/uploads/dosen/foto_lama)
                FS-->>BE: true
            end
        else Foto tidak valid
            BE-->>FE: Error "Foto tidak valid (Max 2MB, JPG/PNG/WEBP)"
        end
    end
    alt Action = tambah_dosen
        BE->>DB: INSERT INTO dosen (nidn, nama, program_studi, keahlian, pendidikan, jabatan, status, email, foto)
    else Action = edit_dosen
        BE->>DB: UPDATE dosen SET ... WHERE id=?
    end
    DB-->>BE: success
    BE-->>FE: HTTP 302 → /admin/kelola_dosen?status=tambah_sukses
```

***Gambar 2.4** Sequence Diagram Upload Foto dan Manajemen File Dosen*

Diagram ini merepresentasikan mekanisme pengelolaan file foto pada modul data dosen yang mengimplementasikan validasi berlapis. Sistem memvalidasi dua aspek file secara berurutan: pertama memeriksa ekstensi file menggunakan `in_array()` terhadap array tipe yang diizinkan, kemudian memeriksa ukuran file tidak melebihi batas 2MB (2.000.000 *bytes*). **Nama file baru** dibangkitkan menggunakan gabungan `time()` dan `uniqid()` untuk menghasilkan nama yang unik secara kriptografis. Setelah operasi database berhasil, sistem tidak merender respons di halaman yang sama melainkan mengeksekusi *header redirect* dengan parameter status untuk mencegah pengiriman formulir berulang (*duplicate submission*) apabila pengguna me-*refresh* halaman.

---

## 2.5 Sequence Diagram — Hapus Data (Delete dengan File Cleanup)

```mermaid
sequenceDiagram
    participant FE as 🖥️ Frontend (Admin Browser)
    participant BE as ⚙️ Backend (PHP)
    participant FS as 📁 File System
    participant DB as 🗄️ Database (MySQL)

    FE->>BE: GET /admin/kelola_berita?action=hapus&id=42
    Note over FE: Setelah konfirmasi JavaScript confirm()
    BE->>BE: $id_hapus = intval($_GET['id'])
    BE->>DB: SELECT foto FROM berita WHERE id = 42
    DB-->>BE: ['foto' => '1712345678_abc123.jpg']
    BE->>DB: DELETE FROM berita WHERE id = 42
    DB-->>BE: Affected rows = 1
    alt File foto ada
        BE->>FS: safeDeleteFile('../uploads/berita/1712345678_abc123.jpg')
        Note right of FS: Loop hingga 3x jika file terkunci
        FS-->>BE: true
    end
    BE-->>FE: Tampilkan "✓ Berita berhasil dihapus!"
```

***Gambar 2.5** Sequence Diagram Hapus Data dengan File Cleanup*

Diagram ini mengilustrasikan prosedur penghapusan data yang memperhatikan integritas konsistensi antara basis data dan sistem berkas. Sebelum mengeksekusi perintah `DELETE`, sistem terlebih dahulu mengeksekusi `SELECT foto` untuk mendapatkan referensi nama file yang terkait dengan rekaman tersebut. **Urutan operasi dipilih secara hati-hati**: database dihapus terlebih dahulu, baru kemudian file fisik dihapus dari sistem berkas; strategi ini dipilih karena kehilangan referensi database dianggap lebih kritis daripada meninggalkan *orphaned file* yang sewaktu-waktu masih bisa dibersihkan secara manual. Parameter `id` yang diterima melalui `GET` dikonversi menggunakan fungsi `intval()` untuk mencegah injeksi SQL pada operasi `DELETE`.

---

## 2.6 Sequence Diagram — Akses Halaman Publik Frontend

```mermaid
sequenceDiagram
    participant PV as 👤 Pengunjung (Browser)
    participant BE as ⚙️ Backend (PHP)
    participant DB as 🗄️ Database (MySQL)

    PV->>BE: GET /web_fikom/index.php
    BE->>BE: include config/database.php
    BE->>BE: include config/constants.php
    BE->>DB: Deteksi: halaman yang diminta
    alt Halaman Home
        BE->>DB: SELECT * FROM slider ORDER BY id
        DB-->>BE: Data slider
        BE->>DB: SELECT * FROM berita ORDER BY tanggal_publish DESC LIMIT 6
        DB-->>BE: Data berita terbaru
        BE->>DB: SELECT * FROM fakta
        DB-->>BE: Data statistik fakultas
        BE->>DB: SELECT * FROM kerjasama
        DB-->>BE: Data mitra kerjasama
    else Halaman Dosen
        BE->>DB: SELECT * FROM dosen ORDER BY nama ASC
        DB-->>BE: Daftar dosen
    else Halaman Penelitian
        BE->>DB: SELECT * FROM penelitian ORDER BY tahun DESC
        DB-->>BE: Daftar penelitian
    end
    BE->>BE: include includes/header.php
    BE->>BE: Render konten HTML dinamis
    BE->>BE: include includes/footer.php
    BE-->>PV: HTTP 200 — HTML lengkap dikirimkan ke browser
```

***Gambar 2.6** Sequence Diagram Akses Halaman Publik Frontend*

Diagram ini merepresentasikan arsitektur *Server-Side Rendering* (SSR) yang digunakan pada seluruh halaman publik website. Setiap permintaan `GET` dari browser pengunjung ditangani oleh PHP yang mengeksekusi satu atau lebih *query* ke basis data `db_web_fikom` sesuai halaman yang diminta. File konfigurasi `config/database.php` menginstansiasi objek `$conn` (koneksi `mysqli`) dan `config/constants.php` mendefinisikan konstanta jalur dan URL dinamis. **Komponen *header* dan *footer*** disertakan (*include*) secara berulang dari file `includes/header.php` dan `includes/footer.php` untuk menjaga konsistensi navigasi dan tampilan di seluruh halaman. Sistem mengembalikan respons HTTP 200 dengan dokumen HTML lengkap yang telah dirender dengan data terbaru dari basis data.

---

## 2.7 Sequence Diagram — Validasi Sesi (Session Guard)

```mermaid
sequenceDiagram
    participant FE as 🖥️ Admin Browser
    participant BE as ⚙️ Backend (PHP)
    participant DB as 🗄️ Database (MySQL)

    FE->>BE: GET /admin/kelola_berita (atau halaman admin lainnya)
    BE->>BE: session_start()
    BE->>BE: Periksa: isset($_SESSION['admin_logged_in']) === true
    alt Sesi tidak ada / expired
        BE-->>FE: HTTP 302 Redirect → /admin/login
    else Sesi valid
        BE->>DB: Query data untuk halaman yang diminta
        DB-->>BE: Data hasil query
        BE->>BE: Render halaman admin dengan data
        BE-->>FE: HTTP 200 — Halaman admin berhasil ditampilkan
    end
```

***Gambar 2.7** Sequence Diagram Validasi Sesi (Session Guard)*

Diagram ini menggambarkan mekanisme *session guard* yang melindungi seluruh halaman panel administrator dari akses tidak sah. Setiap kali halaman admin dimuat, sistem memanggil `session_start()` dan memverifikasi keberadaan variabel sesi `$_SESSION['admin_logged_in']` yang harus bernilai `true`. **Apabila sesi tidak ditemukan** atau sudah kedaluwarsa (setelah `SESSION_LIFETIME` = 3600 detik sebagaimana didefinisikan di `config/constants.php`), sistem segera mengembalikan respons HTTP 302 dan mengarahkan ke halaman login tanpa mengeksekusi baris kode berikutnya. Mekanisme validasi sesi ini diimplementasikan pada seluruh halaman admin baik melalui pengecekan `$_SESSION['admin_logged_in']` secara langsung maupun melalui pemanggilan fungsi bantuan `is_logged_in()` yang didefinisikan di `includes/functions.php`.

---

## 2.8 Sequence Diagram — Kelola Pendaftaran Mahasiswa Baru

```mermaid
sequenceDiagram
    participant PV as 👤 Pengunjung (Browser)
    participant BE as ⚙️ Backend (PHP)
    participant DB as 🗄️ Database (MySQL)
    participant ADM as 🔐 Admin

    PV->>BE: GET /pages/pendaftaran — Muat formulir
    BE->>BE: include header, footer
    BE-->>PV: HTTP 200 — Render form pendaftaran

    PV->>BE: POST /pages/pendaftaran [nama, nik, prodi, jalur, whatsapp]
    BE->>BE: sanitize_input() pada semua field
    BE->>BE: Validasi kelengkapan dan format data
    alt Data tidak valid
        BE-->>PV: Tampilkan pesan error dan form kembali
    else Data valid
        BE->>DB: INSERT INTO pendaftaran (nama, nik, prodi, jalur_masuk, no_whatsapp, tanggal_daftar)
        DB-->>BE: Insert ID = 37
        BE-->>PV: Tampilkan konfirmasi "Pendaftaran berhasil diterima"
    end

    ADM->>BE: GET /admin/kelola_pendaftaran
    BE->>BE: Verifikasi sesi admin
    BE->>DB: SELECT * FROM pendaftaran ORDER BY id DESC
    DB-->>BE: Daftar semua pendaftar
    BE-->>ADM: Render tabel data pendaftar dengan aksi detail & hapus
```

***Gambar 2.8** Sequence Diagram Kelola Pendaftaran Mahasiswa Baru*

Diagram ini merepresentasikan dua perspektif interaksi yang terintegrasi: pengisian formulir oleh calon mahasiswa di *frontend* dan pengelolaan data oleh administrator di *backend*. Seluruh input dari formulir publik diproses melalui fungsi `sanitize_input()` yang mengeksekusi tiga operasi pembersihan secara berantai: `trim()` untuk menghapus spasi berlebih, `stripslashes()` untuk menghilangkan karakter *escape*, dan `htmlspecialchars()` dengan *flag* `ENT_QUOTES` untuk mengonversi karakter HTML spesial. **Data bersih kemudian disimpan** ke tabel `pendaftaran` menggunakan *Prepared Statement*. Dari sisi administrator, data pendaftar ditampilkan dalam tabel responsif dilengkapi tautan WhatsApp *click-to-chat* yang menggunakan nomor yang tersimpan di basis data, memfasilitasi komunikasi langsung antara panitia PMB dan calon mahasiswa.

---

## 2.9 Sequence Diagram — Kelola Penelitian dan Pengabdian

```mermaid
sequenceDiagram
    participant FE as 🖥️ Admin Browser
    participant BE as ⚙️ Backend (PHP)
    participant FS as 📁 File System
    participant DB as 🗄️ Database (MySQL)

    FE->>BE: POST /admin/kelola_penelitian [judul, peneliti, tahun, status, dana, dokumen?]
    BE->>BE: Validasi field wajib (judul, peneliti, tahun)
    alt Ada file dokumen
        BE->>BE: Cek tipe: ALLOWED_DOC_TYPES (PDF, DOC, DOCX)
        BE->>BE: Cek ukuran: MAX_FILE_SIZE (5MB)
        alt File valid
            BE->>FS: handle_upload() → upload ke /uploads/penelitian/
            FS-->>BE: ['success' => true, 'filename' => 'xyz_1712345678.pdf']
        else File tidak valid
            BE-->>FE: Error "Tipe file tidak diizinkan atau melebihi batas ukuran"
        end
    end
    BE->>DB: INSERT INTO penelitian (judul, peneliti, tahun, status, dana, dokumen, tanggal_mulai)
    DB-->>BE: Affected rows = 1
    BE-->>FE: Tampilkan konfirmasi sukses
```

***Gambar 2.9** Sequence Diagram Kelola Penelitian*

Diagram ini mengilustrasikan alur penyimpanan data kegiatan penelitian dosen yang mendukung unggahan dokumen pendukung. Validasi file dokumen menggunakan konstanta `ALLOWED_DOC_TYPES` dan `MAX_FILE_SIZE` yang didefinisikan terpusat di `config/constants.php` untuk kemudahan pemeliharaan. Fungsi `handle_upload()` dari `includes/functions.php` mengabstraksi logika pengunggahan file yang mencakup pengecekan tipe MIME, validasi ukuran, pembuatan direktori otomatis menggunakan `mkdir()` jika belum ada, dan pemindahan file dengan nama unik berbasis `uniqid() + time()`. **Data penelitian** yang tersimpan kemudian dapat diakses oleh pengunjung publik melalui halaman `pages/penelitian.php` sebagai portofolio riset fakultas.

---

## 2.10 Sequence Diagram — Dashboard Statistik Admin

```mermaid
sequenceDiagram
    participant FE as 🖥️ Admin Browser
    participant BE as ⚙️ Backend (PHP)
    participant DB as 🗄️ Database (MySQL)

    FE->>BE: GET /admin/dashboard
    BE->>BE: Verifikasi sesi: $_SESSION['admin_logged_in']
    BE->>DB: SELECT COUNT(id) as total FROM dosen
    DB-->>BE: total_dosen = N
    BE->>DB: SELECT COUNT(id) as total FROM berita
    DB-->>BE: total_berita = N
    BE->>DB: SELECT COUNT(*) FROM (penelitian UNION ALL pengabdian) AS gabungan
    DB-->>BE: total_penelitian = N
    BE->>DB: SELECT COUNT(*) FROM (ruangan UNION ALL laboratorium) AS gabungan
    DB-->>BE: total_ruangan = N
    BE->>DB: SELECT * FROM penelitian ORDER BY tahun DESC, tanggal_mulai DESC LIMIT 5
    DB-->>BE: Daftar 5 penelitian terbaru
    BE->>DB: SELECT * FROM berita ORDER BY tanggal_publish DESC LIMIT 5
    DB-->>BE: Daftar 5 berita terbaru
    BE->>BE: Render dashboard dengan semua data statistik
    BE-->>FE: HTTP 200 — Halaman dashboard ditampilkan
```

***Gambar 2.10** Sequence Diagram Dashboard Statistik Admin*

Diagram ini merepresentasikan alur pengambilan data agregat pada halaman *dashboard* administrator. Empat kartu statistik utama memerlukan empat *query* `COUNT` terpisah ke tabel `dosen`, `berita`, serta gabungan `penelitian UNION ALL pengabdian`, dan `ruangan UNION ALL laboratorium`. **Pendekatan `UNION ALL`** digunakan untuk menggabungkan hasil hitung dari dua tabel berbeda ke dalam satu nilai total tanpa overhead *subquery* yang kompleks. Selain statistik agregat, *dashboard* juga menampilkan dua tabel aktivitas terbaru (lima penelitian dan lima berita terbaru) yang diurutkan berdasarkan tanggal terbaru. Seluruh *query* dieksekusi secara sekuensial dalam satu siklus permintaan-respons HTTP sebelum halaman dirender.

---

## 2.11 Sequence Diagram — Pencarian Data Dosen dengan Filter Prodi

```mermaid
sequenceDiagram
    participant FE as 🖥️ Admin Browser
    participant BE as ⚙️ Backend (PHP)
    participant DB as 🗄️ Database (MySQL)

    FE->>BE: GET /admin/kelola_dosen?filter_prodi=Informatika
    BE->>BE: Verifikasi sesi admin
    BE->>BE: $filter_prodi = $_GET['filter_prodi'] ?? ''
    alt filter_prodi tidak kosong
        BE->>BE: $safe_prodi = $conn->real_escape_string($filter_prodi)
        BE->>DB: SELECT * FROM dosen WHERE program_studi = 'Informatika' ORDER BY nama ASC
    else filter_prodi kosong
        BE->>DB: SELECT * FROM dosen ORDER BY nama ASC
    end
    DB-->>BE: Daftar dosen (terfilter atau semua)
    BE->>DB: SELECT COUNT(id) as total FROM dosen
    BE->>DB: SELECT COUNT(id) as total FROM dosen WHERE status = 'Tetap'
    BE->>DB: SELECT COUNT(id) as total FROM dosen WHERE pendidikan = 'S3'
    BE->>DB: SELECT COUNT(id) as total FROM dosen WHERE pendidikan = 'S2'
    DB-->>BE: Data statistik dosen
    BE->>BE: json_encode($dosen_list) untuk data JavaScript
    BE-->>FE: HTTP 200 — Halaman dengan daftar terfilter
```

***Gambar 2.11** Sequence Diagram Filter Data Dosen*

Diagram ini menggambarkan mekanisme pemfilteran data dosen berdasarkan Program Studi melalui parameter `GET`. Nilai filter yang diterima dari *query string* diproses menggunakan `$conn->real_escape_string()` sebagai lapisan perlindungan tambahan terhadap injeksi SQL, meskipun sistem secara umum mengandalkan *Prepared Statement*. **Selain data daftar yang terfilter**, sistem juga mengeksekusi empat *query* statistik tambahan untuk kartu ringkasan (total dosen, dosen tetap, doktor S3, magister S2) yang ditampilkan di atas tabel. Data dosen secara keseluruhan juga diencode ke format JSON menggunakan `json_encode()` dan disisipkan ke atribut `data-dosen` di elemen HTML tersembunyi sebagai sumber data untuk manipulasi *modal popup* melalui JavaScript di sisi klien.

---

*Dokumen Sequence Diagram ini merupakan bagian dari dokumentasi teknis skripsi Website Fakultas Ilmu Komputer Universitas Muhammadiyah Sidenreng Rappang (UNISAN).*
