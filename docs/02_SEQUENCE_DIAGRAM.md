# Diagram Urutan (Sequence Diagram) — Website Fakultas Ilmu Komputer UNISAN

## Pengertian Sequence Diagram

*Sequence Diagram* adalah salah satu jenis diagram dalam UML (*Unified Modeling Language*) yang digunakan untuk menggambarkan urutan interaksi antar komponen sistem secara kronologis. Diagram ini memperlihatkan bagaimana objek atau komponen saling bertukar pesan dari atas ke bawah sesuai urutan waktu. Dalam sistem Web FIKOM, tiga komponen utama yang saling berinteraksi adalah **Frontend** (Browser pengguna/admin), **Backend** (Server PHP), dan **Database** (MySQL `db_web_fikom`).

---

## 2.1 Sequence Diagram — Login Administrator

```mermaid
sequenceDiagram
    participant FE as Frontend (Browser)
    participant BE as Backend (PHP)
    participant DB as Database (MySQL)

    FE->>BE: POST /admin/login [username/email, password]
    BE->>BE: Validasi field tidak kosong
    alt Field kosong
        BE-->>FE: Redirect ke /admin/login [error: "Wajib diisi"]
    else Field terisi
        BE->>DB: SELECT id, username, password FROM users WHERE username=? OR email=?
        DB-->>BE: Data user / null
        alt User tidak ditemukan
            BE-->>FE: Pesan "Username atau Password salah"
        else User ditemukan
            BE->>BE: password_verify(input, hash_bcrypt)
            alt Password tidak cocok
                BE-->>FE: Pesan "Username atau Password salah"
            else Password cocok
                BE->>BE: Set $_SESSION['admin_logged_in'] = true
                BE-->>FE: Redirect ke /admin/dashboard
            end
        end
    end
```

***Gambar 2.1** Login Administrator*

&nbsp;&nbsp;&nbsp;&nbsp;Gambar 2.1 di atas menjelaskan alur interaksi saat administrator melakukan login ke sistem. Admin mengisi form username/email dan password, lalu sistem memvalidasi data tersebut ke database menggunakan *Prepared Statement*. Jika data cocok, sistem membuat sesi login dan mengarahkan admin ke halaman dashboard. Jika tidak cocok, sistem menampilkan pesan kesalahan tanpa memberi tahu detail mana yang salah demi keamanan.

---

## 2.2 Sequence Diagram — Tambah Data Berita

```mermaid
sequenceDiagram
    participant FE as Frontend (Admin Browser)
    participant BE as Backend (PHP)
    participant FS as File System
    participant DB as Database (MySQL)

    FE->>BE: POST /admin/kelola_berita [judul, kategori, tanggal, konten, foto]
    BE->>BE: Validasi field wajib tidak kosong
    alt Validasi gagal
        BE-->>FE: Tampilkan pesan error
    else Validasi berhasil
        alt Ada file foto
            BE->>BE: generateSafeFileName(namaFile)
            BE->>FS: Simpan foto ke /uploads/berita/
            FS-->>BE: Berhasil
        end
        BE->>DB: INSERT INTO berita (judul, kategori, tanggal_publish, link, konten, foto)
        DB-->>BE: Berhasil
        BE-->>FE: Pesan "Berita berhasil ditambahkan"
    end
```

***Gambar 2.2** Tambah Data Berita*

&nbsp;&nbsp;&nbsp;&nbsp;Gambar 2.2 di atas menjelaskan alur interaksi saat admin menambahkan data berita baru. Admin mengisi form berita beserta foto opsional, kemudian sistem memvalidasi kelengkapan data. Jika ada foto yang diunggah, sistem membuat nama file unik secara otomatis sebelum menyimpannya ke server. Setelah semua proses selesai, data berita disimpan ke database dan admin mendapat konfirmasi keberhasilan.

---

## 2.3 Sequence Diagram — Edit Data Berita

```mermaid
sequenceDiagram
    participant FE as Frontend (Admin Browser)
    participant BE as Backend (PHP)
    participant FS as File System
    participant DB as Database (MySQL)

    FE->>BE: POST /admin/kelola_berita [action=edit, id, judul, foto_lama, foto_baru?]
    BE->>BE: Validasi field wajib
    alt Ada foto baru
        BE->>BE: generateSafeFileName(namaFileBaru)
        BE->>FS: Simpan foto baru ke /uploads/berita/
        FS-->>BE: Berhasil
        BE->>FS: Hapus foto lama (safeDeleteFile)
        FS-->>BE: Berhasil
    end
    BE->>DB: UPDATE berita SET judul=?, kategori=?, tanggal_publish=?, konten=?, foto=? WHERE id=?
    DB-->>BE: Berhasil
    BE-->>FE: Pesan "Berita berhasil diperbarui"
```

***Gambar 2.3** Edit Data Berita*

&nbsp;&nbsp;&nbsp;&nbsp;Gambar 2.3 di atas menjelaskan alur interaksi saat admin mengubah data berita yang sudah ada. Jika admin mengganti foto, sistem terlebih dahulu menyimpan foto baru ke server, kemudian menghapus foto lama. Urutan ini sengaja dirancang demikian agar foto lama tidak terhapus sebelum foto baru benar-benar tersimpan dengan aman. Setelah itu, data berita diperbarui di database.

---

## 2.4 Sequence Diagram — Hapus Data Berita

```mermaid
sequenceDiagram
    participant FE as Frontend (Admin Browser)
    participant BE as Backend (PHP)
    participant FS as File System
    participant DB as Database (MySQL)

    FE->>BE: GET /admin/kelola_berita?action=hapus&id=42
    Note over FE: Setelah konfirmasi dialog confirm()
    BE->>BE: $id = intval($_GET['id'])
    BE->>DB: SELECT foto FROM berita WHERE id = 42
    DB-->>BE: ['foto' => 'namafile.jpg']
    BE->>DB: DELETE FROM berita WHERE id = 42
    DB-->>BE: Berhasil
    alt Foto ada
        BE->>FS: Hapus file foto dari /uploads/berita/
        FS-->>BE: Berhasil
    end
    BE-->>FE: Pesan "Berita berhasil dihapus"
```

***Gambar 2.4** Hapus Data Berita*

&nbsp;&nbsp;&nbsp;&nbsp;Gambar 2.4 di atas menjelaskan alur interaksi saat admin menghapus data berita. Sebelum menghapus, sistem terlebih dahulu mengambil nama file foto yang terkait agar bisa dihapus dari server setelah data di database berhasil dihapus. Pendekatan ini memastikan tidak ada data yang tertinggal secara tidak konsisten, baik di database maupun di penyimpanan file server.

---

## 2.5 Sequence Diagram — Tambah dan Edit Data Dosen

```mermaid
sequenceDiagram
    participant FE as Frontend (Admin Browser)
    participant BE as Backend (PHP)
    participant FS as File System
    participant DB as Database (MySQL)

    FE->>BE: POST /admin/kelola_dosen [nama, nidn, email, prodi, status, foto?]
    BE->>BE: Validasi field wajib
    alt Ada file foto
        BE->>BE: Cek ekstensi: jpg/jpeg/png/webp
        BE->>BE: Cek ukuran: <= 2MB
        alt Foto valid
            BE->>FS: Simpan foto ke /uploads/dosen/
            FS-->>BE: Berhasil
            alt Action = edit DAN ada foto lama
                BE->>FS: Hapus foto lama
            end
        else Foto tidak valid
            BE-->>FE: Error "Format tidak valid atau ukuran melebihi 2MB"
        end
    end
    alt Action = tambah
        BE->>DB: INSERT INTO dosen (nidn, nama, prodi, keahlian, pendidikan, jabatan, status, email, foto)
    else Action = edit
        BE->>DB: UPDATE dosen SET ... WHERE id=?
    end
    DB-->>BE: Berhasil
    BE-->>FE: Redirect dengan status sukses
```

***Gambar 2.5** Tambah dan Edit Data Dosen*

&nbsp;&nbsp;&nbsp;&nbsp;Gambar 2.5 di atas menjelaskan alur interaksi saat admin mengelola data dosen, baik menambah maupun mengubah. Sistem memvalidasi foto yang diunggah dengan memeriksa jenis file dan ukurannya (maksimal 2MB). Setelah semua validasi lolos, data disimpan atau diperbarui di database dan sistem mengarahkan kembali ke halaman daftar dosen dengan pesan konfirmasi keberhasilan.

---

## 2.6 Sequence Diagram — Kelola Penelitian

```mermaid
sequenceDiagram
    participant FE as Frontend (Admin Browser)
    participant BE as Backend (PHP)
    participant FS as File System
    participant DB as Database (MySQL)

    FE->>BE: POST /admin/kelola_penelitian [judul, peneliti, tahun, status, file_proposal?, file_laporan?]
    BE->>BE: Validasi field wajib (judul, peneliti, tahun)
    alt Ada file dokumen
        BE->>BE: Cek ekstensi: pdf/doc/docx
        BE->>BE: Cek ukuran: <= 5MB
        alt File valid
            BE->>FS: Simpan ke /uploads/penelitian_proposal/ atau /penelitian_laporan/
            FS-->>BE: Berhasil
        else File tidak valid
            BE-->>FE: Error "Format atau ukuran file tidak valid"
        end
    end
    BE->>DB: INSERT INTO penelitian (judul, peneliti, tahun, status, skim, ...)
    DB-->>BE: Berhasil
    BE-->>FE: Redirect dengan status sukses
```

***Gambar 2.6** Kelola Penelitian*

&nbsp;&nbsp;&nbsp;&nbsp;Gambar 2.6 di atas menjelaskan alur interaksi saat admin menambahkan data penelitian dosen. Admin dapat mengunggah dua file sekaligus yaitu file proposal dan file laporan akhir ke folder yang berbeda di server. Sistem memvalidasi setiap file yang diunggah sebelum menyimpannya. Setelah semua data tersimpan, admin diarahkan kembali ke halaman daftar penelitian dengan notifikasi sukses.

---

## 2.7 Sequence Diagram — Kelola Pengabdian

```mermaid
sequenceDiagram
    participant FE as Frontend (Admin Browser)
    participant BE as Backend (PHP)
    participant FS as File System
    participant DB as Database (MySQL)

    FE->>BE: POST /admin/kelola_pengabdian [judul, pelaksana, deskripsi, tanggal, file_pdf?]
    BE->>BE: Validasi field wajib (judul, pelaksana)
    alt Ada file dokumen
        BE->>BE: Cek ekstensi dan ukuran (maks 5MB)
        BE->>FS: Simpan ke /uploads/pengabdian_file/
        FS-->>BE: Berhasil
    end
    BE->>DB: INSERT INTO pengabdian (judul, pelaksana, deskripsi, file_pdf, tanggal_kegiatan)
    DB-->>BE: Berhasil
    BE-->>FE: Redirect dengan status sukses
```

***Gambar 2.7** Kelola Pengabdian*

&nbsp;&nbsp;&nbsp;&nbsp;Gambar 2.7 di atas menjelaskan alur interaksi saat admin mencatat kegiatan pengabdian kepada masyarakat. Data yang wajib diisi adalah judul dan nama pelaksana, sedangkan file laporan bersifat opsional. Jika ada file yang diunggah, sistem memvalidasinya terlebih dahulu sebelum menyimpan ke server. Seluruh data kemudian disimpan ke tabel pengabdian di database.

---

## 2.8 Sequence Diagram — Akses Halaman Publik Frontend

```mermaid
sequenceDiagram
    participant PV as Pengunjung (Browser)
    participant BE as Backend (PHP)
    participant DB as Database (MySQL)

    PV->>BE: GET /web_fikom/index.php
    BE->>BE: Load config/database.php dan config/constants.php
    alt Halaman Home
        BE->>DB: SELECT * FROM hero_slider WHERE is_active = 1
        DB-->>BE: Data slider
        BE->>DB: SELECT * FROM berita ORDER BY tanggal_publish DESC LIMIT 6
        DB-->>BE: Data berita terbaru
        BE->>DB: SELECT * FROM tb_fakta ORDER BY urutan ASC
        DB-->>BE: Data statistik
        BE->>DB: SELECT * FROM kerjasama
        DB-->>BE: Data mitra
    else Halaman Dosen
        BE->>DB: SELECT * FROM dosen ORDER BY nama ASC
        DB-->>BE: Daftar dosen
    else Halaman Penelitian
        BE->>DB: SELECT * FROM penelitian ORDER BY tahun DESC
        DB-->>BE: Daftar penelitian
    end
    BE->>BE: Render HTML dengan data
    BE-->>PV: HTTP 200 — Halaman lengkap dikirim ke browser
```

***Gambar 2.8** Akses Halaman Publik Frontend*

&nbsp;&nbsp;&nbsp;&nbsp;Gambar 2.8 di atas menjelaskan alur interaksi saat pengunjung membuka halaman website. Sistem secara otomatis mengambil data dari database sesuai halaman yang dibuka, kemudian merender seluruh konten menjadi halaman HTML lengkap sebelum dikirimkan ke browser pengunjung. Proses ini terjadi sepenuhnya di sisi server (*Server-Side Rendering*) sehingga pengunjung langsung menerima halaman yang sudah berisi data terbaru tanpa memerlukan proses tambahan di sisi browser.

---

## 2.9 Sequence Diagram — Validasi Sesi Admin

```mermaid
sequenceDiagram
    participant FE as Admin Browser
    participant BE as Backend (PHP)
    participant DB as Database (MySQL)

    FE->>BE: GET /admin/kelola_berita (atau halaman admin lainnya)
    BE->>BE: session_start()
    BE->>BE: Cek $_SESSION['admin_logged_in'] === true
    alt Sesi tidak ada atau sudah habis
        BE-->>FE: Redirect ke /admin/login
    else Sesi valid
        BE->>DB: Query data untuk halaman yang diminta
        DB-->>BE: Data hasil query
        BE->>BE: Render halaman admin
        BE-->>FE: HTTP 200 — Halaman admin ditampilkan
    end
```

***Gambar 2.9** Validasi Sesi Admin*

&nbsp;&nbsp;&nbsp;&nbsp;Gambar 2.9 di atas menjelaskan alur interaksi saat admin mengakses halaman panel admin. Setiap halaman admin selalu memeriksa sesi login terlebih dahulu sebelum menampilkan apapun. Jika sesi tidak ditemukan atau sudah habis masa berlakunya, sistem langsung mengarahkan pengguna ke halaman login. Mekanisme ini memastikan seluruh halaman admin tidak dapat diakses oleh siapapun yang belum terautentikasi.

---

## 2.10 Sequence Diagram — Pendaftaran Mahasiswa Baru

```mermaid
sequenceDiagram
    participant PV as Calon Mahasiswa (Browser)
    participant BE as Backend (PHP)
    participant DB as Database (MySQL)
    participant ADM as Admin

    PV->>BE: GET /pages/pendaftaran — Buka halaman formulir
    BE-->>PV: HTTP 200 — Tampilkan form pendaftaran

    PV->>BE: POST /pages/pendaftaran [nama, nik, email, hp, prodi, jalur, ...]
    BE->>BE: sanitize_input() pada semua field
    BE->>BE: Validasi kelengkapan data
    alt Data tidak valid
        BE-->>PV: Tampilkan pesan error
    else Data valid
        BE->>DB: INSERT INTO pendaftaran (nama, nik, email, hp, prodi, jalur, ...)
        DB-->>BE: Berhasil
        BE-->>PV: Pesan "Pendaftaran berhasil diterima"
    end

    ADM->>BE: GET /admin/kelola_pendaftaran
    BE->>DB: SELECT * FROM pendaftaran ORDER BY id DESC
    DB-->>BE: Daftar semua pendaftar
    BE-->>ADM: Tampilkan tabel data pendaftar
```

***Gambar 2.10** Pendaftaran Mahasiswa Baru*

&nbsp;&nbsp;&nbsp;&nbsp;Gambar 2.10 di atas menjelaskan alur interaksi antara calon mahasiswa yang mendaftar secara online dan administrator yang memverifikasi data. Calon mahasiswa mengisi formulir di halaman publik, lalu sistem membersihkan dan memvalidasi data sebelum menyimpannya ke database. Setelah pendaftaran berhasil, administrator dapat melihat seluruh data pendaftar melalui panel admin dan menindaklanjutinya sesuai prosedur penerimaan mahasiswa baru.

---

## 2.11 Sequence Diagram — Dashboard Statistik Admin

```mermaid
sequenceDiagram
    participant FE as Admin Browser
    participant BE as Backend (PHP)
    participant DB as Database (MySQL)

    FE->>BE: GET /admin/dashboard
    BE->>BE: Validasi sesi login admin
    BE->>DB: SELECT COUNT(id) FROM dosen
    DB-->>BE: Jumlah dosen
    BE->>DB: SELECT COUNT(id) FROM berita
    DB-->>BE: Jumlah berita
    BE->>DB: SELECT COUNT(*) FROM penelitian
    DB-->>BE: Jumlah penelitian
    BE->>DB: SELECT COUNT(*) FROM pengabdian
    DB-->>BE: Jumlah pengabdian
    BE->>DB: SELECT * FROM penelitian ORDER BY tahun DESC LIMIT 5
    DB-->>BE: 5 penelitian terbaru
    BE->>DB: SELECT * FROM berita ORDER BY tanggal_publish DESC LIMIT 5
    DB-->>BE: 5 berita terbaru
    BE->>BE: Render halaman dashboard dengan semua data
    BE-->>FE: HTTP 200 — Dashboard ditampilkan
```

***Gambar 2.11** Dashboard Statistik Admin*

&nbsp;&nbsp;&nbsp;&nbsp;Gambar 2.11 di atas menjelaskan alur interaksi saat admin membuka halaman dashboard. Sistem secara berurutan melakukan beberapa query ke database untuk mendapatkan data statistik jumlah dosen, berita, penelitian, dan pengabdian. Selain angka statistik, dashboard juga menampilkan daftar penelitian dan berita terbaru sebagai ringkasan aktivitas sistem. Semua data ini kemudian dikirimkan ke tampilan (*View*) untuk dirender menjadi informasi visual berupa kartu statistik dan tabel yang informatif bagi admin.

---

*Dokumen Sequence Diagram ini merupakan bagian dari dokumentasi teknis skripsi Website Fakultas Ilmu Komputer Universitas Muhammadiyah Sidenreng Rappang (UNISAN).*
