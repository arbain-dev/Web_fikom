# Kumpulan Diagram Backend

## Sequence Diagram: Login Administrator (Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Pengurus Portal / Calon Admin
    participant View as "Form Halaman Login"
    participant System as "Sistem Pengawas Hak Akses (PHP Session)"
    participant DB as "Pangkalan Data Inti (MySQL)"

    Admin->>View: Buka halaman antarmuka login Admin
    View-->>Admin: Menampilkan form isian kredensial
    
    Admin->>View: Lengkapi ketikan *Username* & *Password*, Klik tombol "Login"
    View->>System: Berangkatkan lalu lintas pengecekan data form (Metode HTTP POST)
    
    System->>DB: Cari dan cocokkan sandi beradasarkan pangkalan data tabel user
    DB-->>System: Melaporkan bahwa sandi pelamar sah atau tidak sejalan
    
    alt Logika Sandi Diterima (100% Cocok) / Sukses
        System->>System: Pasaukan sinyal Status Aktif (*Set Login User Session = True*)
        System-->>View: Lemparkan layar pengelola meluncur bebas memasuki Ruang Kontrol Dashboard Utama Situs
    else Kondisi Logika Sandi Gagal / Asal-asalan
        System-->>View: Tolak masuk perlahan mengembalikan halaman form login lengkap berserat Peringatan "Sandi atau Akun Palsu/Salah"
    end
```

## Sequence Diagram: Kelola Slider Beranda (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Slider Beranda"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder uploads/slider)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman menu Kelola Slider Beranda
    View->>DB: Tarik semua riwayat arsip data
    DB-->>View: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>View: Isi kelengkapan Teks Judul Utama, Subjudul Pendek & Upload Foto Pemandangan Kampus (Slider)
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim inputan form masukan ke sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika terdapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen uploads/slider
                opt Jika sedang menimpa data lama waktu pengeditan (Update)
                    System->>Server: Hapus permanen file usang yang tergantikan
                end
            end
            
            System->>DB: Masukkan data isian masukan teks & nama laut link file menuju Database
            DB-->>System: Menyampaikan pencatatan data telah berhasil terekam
            System-->>View: Dialihkan kembali ke halaman tabel sambil Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Resolusi Terlalu Kasar
            System-->>View: Tampilkan peringatan Error (Tolak menyimpan dan beritahu Pengguna)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh ikon penghapusan data baris terkait
        View->>System: Utus parameter spesifik instruksi melenyapkan rekaman
        System->>DB: Cari detail penamaan spesifik referensi letak nama file peninggalannya
        System->>Server: Hapus secara fisis fail dari memori wadah uploads/slider
        System->>DB: Musnahkan bersih rekaman baris spesifik terkonfirmasi tersebut dari letak Database
        DB-->>System: Eksekusi selesai direkam (Tuntas di Database)
        System-->>View: Mengembalikan antarmuka layar tabel dengan menampilkan pesan Keberhasilan Selesai
    end
```

## Sequence Diagram: Kelola Berita (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Kelola Berita"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder Uploads)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman Kelola Berita
    View->>DB: Tarik semua data riwayat berita
    DB-->>View: Tampilkan daftar tabel berita ke layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Berita
        Admin->>View: Isi Judul, Konten Berita, & Upload Foto
        Admin->>View: Klik menu tombol "Simpan"
        View->>System: Kirim inputan form ke sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format dan ukuran foto
        
        alt Jika parameter foto Valid / Benar
            opt Jika tedapat file foto baru yang diunggah
                System->>Server: Simpan fisik foto ke dalam folder uploads/
                opt Jika sedang menimpa data berita lama (Edit)
                    System->>Server: Hapus permanen file foto berita yang usang
                end
            end
            
            System->>DB: Masukkan data tulisan berita & rujukan foto ke Database
            DB-->>System: Status data telah berhasil tersimpan
            System-->>View: Kembali ke halaman tabel sambil Menampilkan pesan Sukses
        else Format foto Salah / Resolusi Terlalu Besar
            System-->>View: Tampilkan peringatan pesan Error (Gagal Menyimpan)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus Berita
        Admin->>View: Klik status ikon "Hapus" pada salah satu berita
        View->>System: Kirim parameter hapus data pada sistem
        System->>DB: Cari referensi letak nama file foto terkait berita tersebut
        System->>Server: Hapus paksa fisik foto dari folder uploads/
        System->>DB: Musnahkan baris data berita dari Database
        DB-->>System: Konfirmasi data tuntas terhapus
        System-->>View: Kembali ke halaman tabel membawa pesan Sukses dihapus
    end
```

## Sequence Diagram: Kelola Dosen (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Dosen"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder uploads/dosen)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman menu Kelola Dosen
    View->>DB: Tarik semua riwayat arsip data
    DB-->>View: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>View: Isi kelengkapan Nama, NIDN, Jabatan Akademik & Upload Foto Profil
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim inputan form masukan ke sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika terdapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen uploads/dosen
                opt Jika sedang menimpa data lama waktu pengeditan (Update)
                    System->>Server: Hapus permanen file usang yang tergantikan
                end
            end
            
            System->>DB: Masukkan data isian masukan teks & nama laut link file menuju Database
            DB-->>System: Menyampaikan pencatatan data telah berhasil terekam
            System-->>View: Dialihkan kembali ke halaman tabel sambil Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Resolusi Terlalu Kasar
            System-->>View: Tampilkan peringatan Error (Tolak menyimpan dan beritahu Pengguna)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh ikon penghapusan data baris terkait
        View->>System: Utus parameter spesifik instruksi melenyapkan rekaman
        System->>DB: Cari detail penamaan spesifik referensi letak nama file peninggalannya
        System->>Server: Hapus secara fisis fail dari memori wadah uploads/dosen
        System->>DB: Musnahkan bersih rekaman baris spesifik terkonfirmasi tersebut dari letak Database
        DB-->>System: Eksekusi selesai direkam (Tuntas di Database)
        System-->>View: Mengembalikan antarmuka layar tabel dengan menampilkan pesan Keberhasilan Selesai
    end
```

## Sequence Diagram: Kelola Fasilitas Ruangan (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Fasilitas Ruangan"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder uploads/ruangan)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman menu Kelola Fasilitas Ruangan
    View->>DB: Tarik semua riwayat arsip data
    DB-->>View: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>View: Isi kelengkapan Nama Ruang, Kapasitas, Fasilitas & Upload Foto Kelas/Ruangan
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim inputan form masukan ke sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika terdapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen uploads/ruangan
                opt Jika sedang menimpa data lama waktu pengeditan (Update)
                    System->>Server: Hapus permanen file usang yang tergantikan
                end
            end
            
            System->>DB: Masukkan data isian masukan teks & nama laut link file menuju Database
            DB-->>System: Menyampaikan pencatatan data telah berhasil terekam
            System-->>View: Dialihkan kembali ke halaman tabel sambil Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Resolusi Terlalu Kasar
            System-->>View: Tampilkan peringatan Error (Tolak menyimpan dan beritahu Pengguna)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh ikon penghapusan data baris terkait
        View->>System: Utus parameter spesifik instruksi melenyapkan rekaman
        System->>DB: Cari detail penamaan spesifik referensi letak nama file peninggalannya
        System->>Server: Hapus secara fisis fail dari memori wadah uploads/ruangan
        System->>DB: Musnahkan bersih rekaman baris spesifik terkonfirmasi tersebut dari letak Database
        DB-->>System: Eksekusi selesai direkam (Tuntas di Database)
        System-->>View: Mengembalikan antarmuka layar tabel dengan menampilkan pesan Keberhasilan Selesai
    end
```

## Sequence Diagram: Kelola Fasilitas Laboratorium (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Fasilitas Laboratorium"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder uploads/laboratorium)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman menu Kelola Fasilitas Laboratorium
    View->>DB: Tarik semua riwayat arsip data
    DB-->>View: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>View: Isi kelengkapan Nama Lab, Daftar Inventaris Peralatan & Upload Foto Laboratorium
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim inputan form masukan ke sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika terdapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen uploads/laboratorium
                opt Jika sedang menimpa data lama waktu pengeditan (Update)
                    System->>Server: Hapus permanen file usang yang tergantikan
                end
            end
            
            System->>DB: Masukkan data isian masukan teks & nama laut link file menuju Database
            DB-->>System: Menyampaikan pencatatan data telah berhasil terekam
            System-->>View: Dialihkan kembali ke halaman tabel sambil Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Resolusi Terlalu Kasar
            System-->>View: Tampilkan peringatan Error (Tolak menyimpan dan beritahu Pengguna)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh ikon penghapusan data baris terkait
        View->>System: Utus parameter spesifik instruksi melenyapkan rekaman
        System->>DB: Cari detail penamaan spesifik referensi letak nama file peninggalannya
        System->>Server: Hapus secara fisis fail dari memori wadah uploads/laboratorium
        System->>DB: Musnahkan bersih rekaman baris spesifik terkonfirmasi tersebut dari letak Database
        DB-->>System: Eksekusi selesai direkam (Tuntas di Database)
        System-->>View: Mengembalikan antarmuka layar tabel dengan menampilkan pesan Keberhasilan Selesai
    end
```

## Sequence Diagram: Kelola Kalender Akademik (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Kalender Akademik"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder uploads/kalender)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman menu Kelola Kalender Akademik
    View->>DB: Tarik semua riwayat arsip data
    DB-->>View: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>View: Isi kelengkapan Tahun Akademik, Deskripsi & Upload Gambar Kalender
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim inputan form masukan ke sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika terdapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen uploads/kalender
                opt Jika sedang menimpa data lama waktu pengeditan (Update)
                    System->>Server: Hapus permanen file usang yang tergantikan
                end
            end
            
            System->>DB: Masukkan data isian masukan teks & nama laut link file menuju Database
            DB-->>System: Menyampaikan pencatatan data telah berhasil terekam
            System-->>View: Dialihkan kembali ke halaman tabel sambil Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Resolusi Terlalu Kasar
            System-->>View: Tampilkan peringatan Error (Tolak menyimpan dan beritahu Pengguna)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh ikon penghapusan data baris terkait
        View->>System: Utus parameter spesifik instruksi melenyapkan rekaman
        System->>DB: Cari detail penamaan spesifik referensi letak nama file peninggalannya
        System->>Server: Hapus secara fisis fail dari memori wadah uploads/kalender
        System->>DB: Musnahkan bersih rekaman baris spesifik terkonfirmasi tersebut dari letak Database
        DB-->>System: Eksekusi selesai direkam (Tuntas di Database)
        System-->>View: Mengembalikan antarmuka layar tabel dengan menampilkan pesan Keberhasilan Selesai
    end
```

## Sequence Diagram: Kelola Dokumen Kurikulum (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Dokumen Kurikulum"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder docs/kurikulum)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman menu Kelola Dokumen Kurikulum
    View->>DB: Tarik semua riwayat arsip data
    DB-->>View: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>View: Isi kelengkapan Judul, Deskripsi Kurikulum & Upload Dokumen Asli (Format PDF/DOC)
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim inputan form masukan ke sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika terdapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen docs/kurikulum
                opt Jika sedang menimpa data lama waktu pengeditan (Update)
                    System->>Server: Hapus permanen file usang yang tergantikan
                end
            end
            
            System->>DB: Masukkan data isian masukan teks & nama laut link file menuju Database
            DB-->>System: Menyampaikan pencatatan data telah berhasil terekam
            System-->>View: Dialihkan kembali ke halaman tabel sambil Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Resolusi Terlalu Kasar
            System-->>View: Tampilkan peringatan Error (Tolak menyimpan dan beritahu Pengguna)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh ikon penghapusan data baris terkait
        View->>System: Utus parameter spesifik instruksi melenyapkan rekaman
        System->>DB: Cari detail penamaan spesifik referensi letak nama file peninggalannya
        System->>Server: Hapus secara fisis fail dari memori wadah docs/kurikulum
        System->>DB: Musnahkan bersih rekaman baris spesifik terkonfirmasi tersebut dari letak Database
        DB-->>System: Eksekusi selesai direkam (Tuntas di Database)
        System-->>View: Mengembalikan antarmuka layar tabel dengan menampilkan pesan Keberhasilan Selesai
    end
```

## Sequence Diagram: Kelola Mitra Kerjasama (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Mitra Kerjasama"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder uploads/kerjasama)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman menu Kelola Mitra Kerjasama
    View->>DB: Tarik semua riwayat arsip data
    DB-->>View: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>View: Isi kelengkapan Nama Mitra, Deskripsi MoU & Upload Logo Kemitraan
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim inputan form masukan ke sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika terdapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen uploads/kerjasama
                opt Jika sedang menimpa data lama waktu pengeditan (Update)
                    System->>Server: Hapus permanen file usang yang tergantikan
                end
            end
            
            System->>DB: Masukkan data isian masukan teks & nama laut link file menuju Database
            DB-->>System: Menyampaikan pencatatan data telah berhasil terekam
            System-->>View: Dialihkan kembali ke halaman tabel sambil Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Resolusi Terlalu Kasar
            System-->>View: Tampilkan peringatan Error (Tolak menyimpan dan beritahu Pengguna)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh ikon penghapusan data baris terkait
        View->>System: Utus parameter spesifik instruksi melenyapkan rekaman
        System->>DB: Cari detail penamaan spesifik referensi letak nama file peninggalannya
        System->>Server: Hapus secara fisis fail dari memori wadah uploads/kerjasama
        System->>DB: Musnahkan bersih rekaman baris spesifik terkonfirmasi tersebut dari letak Database
        DB-->>System: Eksekusi selesai direkam (Tuntas di Database)
        System-->>View: Mengembalikan antarmuka layar tabel dengan menampilkan pesan Keberhasilan Selesai
    end
```

## Sequence Diagram: Kelola Data Penelitian (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Data Penelitian"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder docs/penelitian)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman menu Kelola Data Penelitian
    View->>DB: Tarik semua riwayat arsip data
    DB-->>View: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>View: Isi kelengkapan Judul Riset, Abstrak Singkat & Upload Dokumen / Laporan Publikasi (PDF/DOC)
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim inputan form masukan ke sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika terdapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen docs/penelitian
                opt Jika sedang menimpa data lama waktu pengeditan (Update)
                    System->>Server: Hapus permanen file usang yang tergantikan
                end
            end
            
            System->>DB: Masukkan data isian masukan teks & nama laut link file menuju Database
            DB-->>System: Menyampaikan pencatatan data telah berhasil terekam
            System-->>View: Dialihkan kembali ke halaman tabel sambil Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Resolusi Terlalu Kasar
            System-->>View: Tampilkan peringatan Error (Tolak menyimpan dan beritahu Pengguna)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh ikon penghapusan data baris terkait
        View->>System: Utus parameter spesifik instruksi melenyapkan rekaman
        System->>DB: Cari detail penamaan spesifik referensi letak nama file peninggalannya
        System->>Server: Hapus secara fisis fail dari memori wadah docs/penelitian
        System->>DB: Musnahkan bersih rekaman baris spesifik terkonfirmasi tersebut dari letak Database
        DB-->>System: Eksekusi selesai direkam (Tuntas di Database)
        System-->>View: Mengembalikan antarmuka layar tabel dengan menampilkan pesan Keberhasilan Selesai
    end
```

## Sequence Diagram: Kelola Data Pengabdian (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Data Pengabdian"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder docs/pengabdian)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman menu Kelola Data Pengabdian
    View->>DB: Tarik semua riwayat arsip data
    DB-->>View: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>View: Isi kelengkapan Judul Kegiatan Pengabdian, Ringkasan & Upload Laporan Dokumentasi (PDF/DOC)
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim inputan form masukan ke sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika terdapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen docs/pengabdian
                opt Jika sedang menimpa data lama waktu pengeditan (Update)
                    System->>Server: Hapus permanen file usang yang tergantikan
                end
            end
            
            System->>DB: Masukkan data isian masukan teks & nama laut link file menuju Database
            DB-->>System: Menyampaikan pencatatan data telah berhasil terekam
            System-->>View: Dialihkan kembali ke halaman tabel sambil Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Resolusi Terlalu Kasar
            System-->>View: Tampilkan peringatan Error (Tolak menyimpan dan beritahu Pengguna)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh ikon penghapusan data baris terkait
        View->>System: Utus parameter spesifik instruksi melenyapkan rekaman
        System->>DB: Cari detail penamaan spesifik referensi letak nama file peninggalannya
        System->>Server: Hapus secara fisis fail dari memori wadah docs/pengabdian
        System->>DB: Musnahkan bersih rekaman baris spesifik terkonfirmasi tersebut dari letak Database
        DB-->>System: Eksekusi selesai direkam (Tuntas di Database)
        System-->>View: Mengembalikan antarmuka layar tabel dengan menampilkan pesan Keberhasilan Selesai
    end
```

## Sequence Diagram: Kelola Dokumen Fakultas (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Dokumen Fakultas"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder docs/fakultas)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman menu Kelola Dokumen Fakultas
    View->>DB: Tarik semua riwayat arsip data
    DB-->>View: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>View: Isi kelengkapan Judul, Teks Deskriptif Panduan & Upload Dokumen Publikasi (PDF/DOC)
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim inputan form masukan ke sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika terdapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen docs/fakultas
                opt Jika sedang menimpa data lama waktu pengeditan (Update)
                    System->>Server: Hapus permanen file usang yang tergantikan
                end
            end
            
            System->>DB: Masukkan data isian masukan teks & nama laut link file menuju Database
            DB-->>System: Menyampaikan pencatatan data telah berhasil terekam
            System-->>View: Dialihkan kembali ke halaman tabel sambil Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Resolusi Terlalu Kasar
            System-->>View: Tampilkan peringatan Error (Tolak menyimpan dan beritahu Pengguna)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh ikon penghapusan data baris terkait
        View->>System: Utus parameter spesifik instruksi melenyapkan rekaman
        System->>DB: Cari detail penamaan spesifik referensi letak nama file peninggalannya
        System->>Server: Hapus secara fisis fail dari memori wadah docs/fakultas
        System->>DB: Musnahkan bersih rekaman baris spesifik terkonfirmasi tersebut dari letak Database
        DB-->>System: Eksekusi selesai direkam (Tuntas di Database)
        System-->>View: Mengembalikan antarmuka layar tabel dengan menampilkan pesan Keberhasilan Selesai
    end
```

## Sequence Diagram: Kelola Rencana Strategis (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Rencana Strategis"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder docs/renstra)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman menu Kelola Rencana Strategis
    View->>DB: Tarik semua riwayat arsip data
    DB-->>View: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>View: Isi kelengkapan Tahun Periode, Visi Renstra & Upload Naskah Renstra (PDF/DOC)
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim inputan form masukan ke sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika terdapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen docs/renstra
                opt Jika sedang menimpa data lama waktu pengeditan (Update)
                    System->>Server: Hapus permanen file usang yang tergantikan
                end
            end
            
            System->>DB: Masukkan data isian masukan teks & nama laut link file menuju Database
            DB-->>System: Menyampaikan pencatatan data telah berhasil terekam
            System-->>View: Dialihkan kembali ke halaman tabel sambil Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Resolusi Terlalu Kasar
            System-->>View: Tampilkan peringatan Error (Tolak menyimpan dan beritahu Pengguna)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh ikon penghapusan data baris terkait
        View->>System: Utus parameter spesifik instruksi melenyapkan rekaman
        System->>DB: Cari detail penamaan spesifik referensi letak nama file peninggalannya
        System->>Server: Hapus secara fisis fail dari memori wadah docs/renstra
        System->>DB: Musnahkan bersih rekaman baris spesifik terkonfirmasi tersebut dari letak Database
        DB-->>System: Eksekusi selesai direkam (Tuntas di Database)
        System-->>View: Mengembalikan antarmuka layar tabel dengan menampilkan pesan Keberhasilan Selesai
    end
```

## Sequence Diagram: Kelola Standar Operasional Prosedur (SOP) (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Standar Operasional Prosedur (SOP)"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder docs/sop)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman menu Kelola Standar Operasional Prosedur (SOP)
    View->>DB: Tarik semua riwayat arsip data
    DB-->>View: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>View: Isi kelengkapan Nama SOP, Rincian Prosedur & Upload Dokumen Pedoman SOP (PDF/DOC)
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim inputan form masukan ke sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika terdapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen docs/sop
                opt Jika sedang menimpa data lama waktu pengeditan (Update)
                    System->>Server: Hapus permanen file usang yang tergantikan
                end
            end
            
            System->>DB: Masukkan data isian masukan teks & nama laut link file menuju Database
            DB-->>System: Menyampaikan pencatatan data telah berhasil terekam
            System-->>View: Dialihkan kembali ke halaman tabel sambil Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Resolusi Terlalu Kasar
            System-->>View: Tampilkan peringatan Error (Tolak menyimpan dan beritahu Pengguna)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh ikon penghapusan data baris terkait
        View->>System: Utus parameter spesifik instruksi melenyapkan rekaman
        System->>DB: Cari detail penamaan spesifik referensi letak nama file peninggalannya
        System->>Server: Hapus secara fisis fail dari memori wadah docs/sop
        System->>DB: Musnahkan bersih rekaman baris spesifik terkonfirmasi tersebut dari letak Database
        DB-->>System: Eksekusi selesai direkam (Tuntas di Database)
        System-->>View: Mengembalikan antarmuka layar tabel dengan menampilkan pesan Keberhasilan Selesai
    end
```

## Sequence Diagram: Kelola Data Organisasi BEM (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Data Organisasi BEM"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder uploads/bem)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman menu Kelola Data Organisasi BEM
    View->>DB: Tarik semua riwayat arsip data
    DB-->>View: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>View: Isi kelengkapan Nama Departemen, Program Kerja & Upload Logo atau Foto Profil BEM
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim inputan form masukan ke sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika terdapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen uploads/bem
                opt Jika sedang menimpa data lama waktu pengeditan (Update)
                    System->>Server: Hapus permanen file usang yang tergantikan
                end
            end
            
            System->>DB: Masukkan data isian masukan teks & nama laut link file menuju Database
            DB-->>System: Menyampaikan pencatatan data telah berhasil terekam
            System-->>View: Dialihkan kembali ke halaman tabel sambil Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Resolusi Terlalu Kasar
            System-->>View: Tampilkan peringatan Error (Tolak menyimpan dan beritahu Pengguna)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh ikon penghapusan data baris terkait
        View->>System: Utus parameter spesifik instruksi melenyapkan rekaman
        System->>DB: Cari detail penamaan spesifik referensi letak nama file peninggalannya
        System->>Server: Hapus secara fisis fail dari memori wadah uploads/bem
        System->>DB: Musnahkan bersih rekaman baris spesifik terkonfirmasi tersebut dari letak Database
        DB-->>System: Eksekusi selesai direkam (Tuntas di Database)
        System-->>View: Mengembalikan antarmuka layar tabel dengan menampilkan pesan Keberhasilan Selesai
    end
```

## Sequence Diagram: Verifikasi Pendaftaran (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Panitia/Sekre Administrator (Verifikator Pendaftar)
    participant View as "Lembar Tinjauan Validasi Seleksi Calon Pemohon"
    participant System as "Sistem Pengawas Validasi (Kendali Parameter PHP)"
    participant Server as "Direktori Brankas Laci Salinan Dokumentasi Peserta Pendaftaran Asli"
    participant DB as "Lembayungan Skema Sinkronisasi Urutan Pendaftar Tertata di Database"

    Admin->>View: Seret penelurusan klik di Menu Utama Pelataran Pengurusan Pendaftar
    View->>DB: Rutinitas tuntutan pengkategorian urutan memadat di tabel calon antre
    DB-->>View: Tuangkan saringan suguhan etalase peserta ke hadapan verifikator 

    %% Putusan Penerimaan Hak Pemilik  
    opt Pemeriksaan Keabsahan & Rekomendasi Terima Dokumen Calon Mutlak
        Admin->>View: Pencet ikon tampilkan Detail, melihat bukti sinkron Dokumen Persyaratan
        Admin->>View: Lemparkan hakim penyelesaian (Tekan Sentuh Putusan Valid Beralaskan Pilihan "Diterima / Ditolak Laporan")
        View->>System: Kargo pesanan dituntut melintang pesat menuju parameter pembaruan penetapan pos peladen HTTP POST
        
        System->>DB: Rapalkan penetrap ketetapan skrip baris pengubahan Parameter Kepastian Status Konfirmasi Rekaman Asli 
        DB-->>System: Labeli penegakan rilis peresmian validasi putusan peserta tertumpu absolut menyelesaikanya    
        System-->>View: Putaran penyegaran menyapu rotasi rilis pemberitahuan berselimut sukses memperbarui kemajuan laporan validasi beriring Kotak Hijau 
    end

    %% Membinasakan Calon Berserakan Berakhir Pembatalan
    opt Lenyapkan Akar Bukti Registrasi Gagal Ekstirpasi Penghapusan Murni 
        Admin->>View: Tititpkan sentuhan tolak mencabut pendaftaran secara merapat baris peserta batal (Sentuh Merah Panel Hapus Total) 
        View->>System: Perintah lisan ditamburkan mendestruksi pengangkutan rute titipan singat pemicu peramban (Lajut Rombak HTTP GET Parameter Delete) 
        System->>DB: Kumpulkan lacakan kumpulan jejak penamaan tumpuan rujukan alamat presisi serpihan fotocopy persyaratan milik pendaftar itu tersaji
        System->>Server: Libas hancurkan kemurnian salinan dokumetansi tersebut dititipan bilik Server Folder Penyortiran (Esekusi Letup Titah Unlink Berbasis Direktori Menyapu Murni) 
        System->>DB: Angin letupan mengejar tuntas ganyang keberangkatan eksistensi pendaftaran mencabut rekam namanya dilarik TBL Memori MySQL mematangkan Lema Terkhi  
        DB-->>System: Balas konfirmasi kelegaan resolusi letupan gugur selesai menghabisis seluruh arsipnya
        System-->>View: Kemudi Penuntun Berlayar Peramban Mulus Tampil Di Ujung Lurus Membawa Bendera Riang Konfirmasi Menyenangkan Penyingkiran Valid Dibasmikan Sempurna
    end
```

## Sequence Diagram: Pengaturan Sistem (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Pengaturan Umum"
    participant System as "Sistem Pengendali PHP"
    participant Server as "Storage Aset Simbol Sentral Identitas (Folders)"
    participant DB as "Lembah Pangkalan Atribut Website TBL Setings (MySQL)"

    Admin->>View: Masuki Ruang Beranda Pengaturan Situs Inti
    View->>DB: Ekstrak catatan info satu baris profil situs
    DB-->>View: Lengkapi segenap parameter dasar melengkapi celah masukan *input views*

    %% Proses Pembaruan Parameter Singel
    opt Klik Sepakati Ketetapan Menyimpan Sentuhan Identitas Terupdate Muka Laman
        Admin->>View: Ubah modifikasi pautan nomor/email berserta pindaian mutakhir logo web 
        Admin->>View: Konfirmasi persetujuan "Simpan Parameter Konfigurasi"
        View->>System: Terjunkan rute pengangkutan data menuju pangkalan pemrosesan (Transisi form terbungkus HTTP POST)

        System->>System: Cek limit rasio pemakaian berbatasan kapasitas pindaian foto file (Ekstensi Validation)
        
        alt Skema Ekstensi Gambar Mulus Tercapai 
            opt Andaikata Logo / Lambang Situs Dimodifikasi Digantikan Bongkahan File Terbaru
                System->>Server: Dudukkan sematan grafis visual anyar mendarat ke rak tumpukan folder khusus
                System->>Server: Bakar hingga bersih keping rekam aset logo sejarah yang dibilang kadaluwarsa (Titah Skrip Lenyapkan `unlink`)
            end
            
            System->>DB: Injeksi rentetan skema merombak tatanan tabel dasar pengaturan sebaris memori MySQL (Pembaruan Singkat UDPATE SET)
            DB-->>System: Nyatakan integritas perombakan dititipkan stabil berhasil mutlak
            System-->>View: Meregang layar antarmuka memuat pelonjakan Pentalan Notifikasi Sempurna (Pemberitahuan Sukses Di Layar Dasbor Kembali Menyala Terang)
        else Tampilan Parameter Batas Lolos Gambar Tercoreng Cacat Tipe Fail Liar
            System-->>View: Tendang suruhan perubahan data kembali pada layar disertai serpihan Merah Rilis Peringatan Pesan Error Gagal! 
        end
    end
```


