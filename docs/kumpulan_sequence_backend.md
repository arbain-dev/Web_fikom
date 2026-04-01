# Kumpulan Diagram Backend

## Sequence Diagram: Login Administrator (Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Calon Pengurus Admin
    participant View as "Borang Halaman Login Depan"
    participant System as "Sistem Pengawas Kredensial PHP"
    participant DB as "Laci Sinkronisasi Identitas Tabel Admin Database"

    Admin->>View: Ketuk pijakan pertama pembuka portal sandi di laman antarmuka
    View-->>Admin: Tebarkan pandangan borang identitas berformulir dua input isian
    
    Admin->>View: Tik kesesuaian sandi *Username* & sisipan *Password*, Kunci di opsi klik tuas "Login"
    View->>System: Antarkan rute gerbong titipan permohonan melintasi rute rahasia berkedok (HTTP POST)
    
    System->>DB: Komparasi sinkron keabsahan kombinasi nama terhadap tumpukan log rekam laci pengguna di pangkalan data
    DB-->>System: Kembalikan validasi bersuara bulat seputar ketepatan seratus persen atas sandi pelamar atau tidak merestui kebenarannya
    
    alt Logika Parameter Mendasar Pembuktian Diterima Sempurna
        System->>System: Ikat pengangkatan derajat wewenang kekuasan Login User Session aktif menyusul persetujuan tulus admin tersebut
        System-->>View: Helat layangan sambutan menggotong peramban mendarat jauh ke bilik nyaman Ruangan Kontrol Utama Pangkalan Dashboard 
    else Kondisi Logika Kredensial Fiktif Salah Kaprah
        System-->>View: Hempaskan penolakan keras mengantarkan pemohon berbalik arah pulang ke wujud formulir pendaftaran bertali rilis Peringatan Teriak Error Akun Salah Tatanan
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
        Admin->>View: Lengkapi isian form & Upload Foto Pemandangan Kampus (Slider)
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim input form menuju sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen uploads/slider
                opt Jika menimpa data warisan usang pengeditan (Update)
                    System->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            System->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Database
            DB-->>System: Peladen menyematkan pertanda konfirmasi data terekam permanen
            System-->>View: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            System-->>View: Singkirkan lalu buang permohonan bersisian peringatan Error (Gagal Format File)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        View->>System: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        System->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        System->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/slider
        System->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Database
        DB-->>System: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        System-->>View: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

## Sequence Diagram: Kelola Berita (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Berita"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder uploads/)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman menu Kelola Berita
    View->>DB: Tarik semua riwayat arsip data
    DB-->>View: Tampilkan daftar tabel data ke beranda layar

    %% Proses Tambah / Edit
    opt Klik Tombol Tambah / Edit Baris Data
        Admin->>View: Lengkapi isian form & Upload Foto Sampul
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim input form menuju sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen uploads/
                opt Jika menimpa data warisan usang pengeditan (Update)
                    System->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            System->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Database
            DB-->>System: Peladen menyematkan pertanda konfirmasi data terekam permanen
            System-->>View: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            System-->>View: Singkirkan lalu buang permohonan bersisian peringatan Error (Gagal Format File)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        View->>System: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        System->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        System->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/
        System->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Database
        DB-->>System: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        System-->>View: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
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
        Admin->>View: Lengkapi isian form & Upload Foto Profil
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim input form menuju sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen uploads/dosen
                opt Jika menimpa data warisan usang pengeditan (Update)
                    System->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            System->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Database
            DB-->>System: Peladen menyematkan pertanda konfirmasi data terekam permanen
            System-->>View: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            System-->>View: Singkirkan lalu buang permohonan bersisian peringatan Error (Gagal Format File)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        View->>System: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        System->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        System->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/dosen
        System->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Database
        DB-->>System: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        System-->>View: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
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
        Admin->>View: Lengkapi isian form & Upload Foto Kelas/Ruangan
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim input form menuju sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen uploads/ruangan
                opt Jika menimpa data warisan usang pengeditan (Update)
                    System->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            System->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Database
            DB-->>System: Peladen menyematkan pertanda konfirmasi data terekam permanen
            System-->>View: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            System-->>View: Singkirkan lalu buang permohonan bersisian peringatan Error (Gagal Format File)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        View->>System: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        System->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        System->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/ruangan
        System->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Database
        DB-->>System: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        System-->>View: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
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
        Admin->>View: Lengkapi isian form & Upload Foto Laboratorium
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim input form menuju sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen uploads/laboratorium
                opt Jika menimpa data warisan usang pengeditan (Update)
                    System->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            System->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Database
            DB-->>System: Peladen menyematkan pertanda konfirmasi data terekam permanen
            System-->>View: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            System-->>View: Singkirkan lalu buang permohonan bersisian peringatan Error (Gagal Format File)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        View->>System: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        System->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        System->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/laboratorium
        System->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Database
        DB-->>System: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        System-->>View: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
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
        Admin->>View: Lengkapi isian form & Upload Gambar Kalender
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim input form menuju sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen uploads/kalender
                opt Jika menimpa data warisan usang pengeditan (Update)
                    System->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            System->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Database
            DB-->>System: Peladen menyematkan pertanda konfirmasi data terekam permanen
            System-->>View: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            System-->>View: Singkirkan lalu buang permohonan bersisian peringatan Error (Gagal Format File)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        View->>System: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        System->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        System->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/kalender
        System->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Database
        DB-->>System: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        System-->>View: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
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
        Admin->>View: Lengkapi isian form & Upload Dokumen Asli (Format PDF/DOC)
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim input form menuju sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen docs/kurikulum
                opt Jika menimpa data warisan usang pengeditan (Update)
                    System->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            System->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Database
            DB-->>System: Peladen menyematkan pertanda konfirmasi data terekam permanen
            System-->>View: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            System-->>View: Singkirkan lalu buang permohonan bersisian peringatan Error (Gagal Format File)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        View->>System: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        System->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        System->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah docs/kurikulum
        System->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Database
        DB-->>System: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        System-->>View: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
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
        Admin->>View: Lengkapi isian form & Upload Logo Kemitraan
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim input form menuju sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen uploads/kerjasama
                opt Jika menimpa data warisan usang pengeditan (Update)
                    System->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            System->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Database
            DB-->>System: Peladen menyematkan pertanda konfirmasi data terekam permanen
            System-->>View: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            System-->>View: Singkirkan lalu buang permohonan bersisian peringatan Error (Gagal Format File)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        View->>System: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        System->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        System->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/kerjasama
        System->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Database
        DB-->>System: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        System-->>View: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
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
        Admin->>View: Lengkapi isian form & Upload Dokumen Laporan Publikasi (PDF/DOC)
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim input form menuju sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen docs/penelitian
                opt Jika menimpa data warisan usang pengeditan (Update)
                    System->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            System->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Database
            DB-->>System: Peladen menyematkan pertanda konfirmasi data terekam permanen
            System-->>View: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            System-->>View: Singkirkan lalu buang permohonan bersisian peringatan Error (Gagal Format File)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        View->>System: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        System->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        System->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah docs/penelitian
        System->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Database
        DB-->>System: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        System-->>View: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
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
        Admin->>View: Lengkapi isian form & Upload Laporan Dokumentasi (PDF/DOC)
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim input form menuju sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen docs/pengabdian
                opt Jika menimpa data warisan usang pengeditan (Update)
                    System->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            System->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Database
            DB-->>System: Peladen menyematkan pertanda konfirmasi data terekam permanen
            System-->>View: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            System-->>View: Singkirkan lalu buang permohonan bersisian peringatan Error (Gagal Format File)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        View->>System: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        System->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        System->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah docs/pengabdian
        System->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Database
        DB-->>System: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        System-->>View: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
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
        Admin->>View: Lengkapi isian form & Upload Dokumen Publikasi (PDF/DOC)
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim input form menuju sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen docs/fakultas
                opt Jika menimpa data warisan usang pengeditan (Update)
                    System->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            System->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Database
            DB-->>System: Peladen menyematkan pertanda konfirmasi data terekam permanen
            System-->>View: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            System-->>View: Singkirkan lalu buang permohonan bersisian peringatan Error (Gagal Format File)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        View->>System: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        System->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        System->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah docs/fakultas
        System->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Database
        DB-->>System: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        System-->>View: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
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
        Admin->>View: Lengkapi isian form & Upload Naskah Renstra (PDF/DOC)
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim input form menuju sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen docs/renstra
                opt Jika menimpa data warisan usang pengeditan (Update)
                    System->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            System->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Database
            DB-->>System: Peladen menyematkan pertanda konfirmasi data terekam permanen
            System-->>View: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            System-->>View: Singkirkan lalu buang permohonan bersisian peringatan Error (Gagal Format File)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        View->>System: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        System->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        System->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah docs/renstra
        System->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Database
        DB-->>System: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        System-->>View: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
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
        Admin->>View: Lengkapi isian form & Upload Dokumen Pedoman SOP (PDF/DOC)
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim input form menuju sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen docs/sop
                opt Jika menimpa data warisan usang pengeditan (Update)
                    System->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            System->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Database
            DB-->>System: Peladen menyematkan pertanda konfirmasi data terekam permanen
            System-->>View: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            System-->>View: Singkirkan lalu buang permohonan bersisian peringatan Error (Gagal Format File)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        View->>System: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        System->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        System->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah docs/sop
        System->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Database
        DB-->>System: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        System-->>View: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
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
        Admin->>View: Lengkapi isian form & Upload Logo atau Foto Profil BEM
        Admin->>View: Konfirmasi persetujuan tombol "Simpan"
        View->>System: Kirim input form menuju sistem (HTTP POST)

        System->>System: Cek kesesuaian parameter format berkas dan ukurannya
        
        alt Jika klasifikasi parameter file Valid / Benar
            opt Jika tedapat lampiran berkas baru yang diunggah
                System->>Server: Simpan fisik file masuk ke folder peladen uploads/bem
                opt Jika menimpa data warisan usang pengeditan (Update)
                    System->>Server: Hapus permanen file peninggalan lawas
                end
            end
            
            System->>DB: Sisipkan detail baris isian ketikan teks & integrasikan link lokasinya ke Database
            DB-->>System: Peladen menyematkan pertanda konfirmasi data terekam permanen
            System-->>View: Dialihkan kembali ke tabel dibarengi rilis Menampilkan Konfirmasi Pesan Sukses
        else Terdeteksi Format File Salah / Skala Muatan Overload Besar
            System-->>View: Singkirkan lalu buang permohonan bersisian peringatan Error (Gagal Format File)
        end
    end

    %% Proses Hapus
    opt Klik Ikon / Tombol Hapus pada Baris
        Admin->>View: Sentuh pengajuan pembasmian mutlak baris rekaman spesifik
        View->>System: Eksekusi sanksi lemparan pembersihan mendesak pangkalan perampingan
        System->>DB: Lacak letak kedudukan koordinat alamat letak nama spesifik file 
        System->>Server: Congkel hancurkan secara fisis fail bawaan eksisting di laci wadah uploads/bem
        System->>DB: Runtuhkan catatan nama jejak spesifik itu terbakar bersih melenggang jauh dari Database
        DB-->>System: Penarikan silsilah daftar terhapuskan mutakhir dipastikan tersingkir
        System-->>View: Melemparkan pengawal administrasi memuat rupa jernih diiringi Papan Pemberitahuan Lapor Sukses 
    end
```

## Sequence Diagram: Verifikasi Pendaftaran (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Panitia Pengayom Hakim Kepastian Standar Berkas Evaluator (Verifikator Tunggal)
    participant View as "Antarmuka Pos Lembar Kemudi Status Validasi Saringan Tinjauan Kepastian Antrean Berkas Pendaftar Mendaftar"
    participant System as "Sistem Jantung Otak Pengawas Inteligensia Putusan Skema Validasi Sentral Eksekutor Laman Cerdas Peladen (PHP Back-End Kinerja Server Rotasi Terukur Dinamis Responsif Langsung Merangkul Rujukan Integrasi Mumpuni Membawa Penentu Beban Rangka Sinkron Memadukan Parameter Cek Silang Presisi Kendali Menata Hak Valid)"
    participant Server as "Direktori Titipan Berankas Saksi Bisu Kumpulan Serpihan Lampiran Dokumen Fotocopy Tumpukan Kepemilikan Hak Aset Persyaratan Calon Pemohon Mengamankan Berdiam Aman Membentengi Akar Letak Orisinalitas Laci Server Fisis Salinan Rekam Sedia Dokumen Terarsip Disembunyikan Kuat Dilindungi Akses Menyudahi Persediaan Folder Melampirkannya di Publik Tanpa Sela Cacat Penyimpanan Aman Tangguh Sedia Menerjang Ketersediaan Salinan Orisinil (Folder Direktori Host Root Aman Mengurungkannya Murni Bebas Menyusut Melayani Unggahan Publik Perambahan)"
    participant DB as "Lembayung Pangkalan Muara Puncak Sinkronisasi Skema Barisan Entri Rekam Tabel Penamaan Registran Menyematkan Lajur Rerangkai Entri Database Tersusun Tabel Calon Berkepanjangan Relasional Tersortir di Penantian Menjamin Penobatan Sah Tidaknya Parameter SQL Terikat Sedia Memangku Data MySQL Keabadian Sel Pendaftaran Sinkron Parameter Terstruktur Mulus Rapi Merajut Kemurnian Valid Merenggut Tuntas Tanpa Lenyap Setitikpun Pendaftaran Berjejak Keabadian)"

    Admin->>View: Bimbing sentuhan klik ketuk merapat pada penelusuran beranda panduan Modul Utama Pengurusan Seleksi Panel Pendaftaran Pelamar Situs
    View->>DB: Rutinitas kargo penyortiran bongkar letak penarik tuntutan jajaran padat merekap letupan penayangan tumpukan panjang memadati pemanggilan urutan barisan tabel relasional SQL entri di laci rekaman pendaftar pangkalan MySQL siap sedia disodorkan maju menyeruak pangkalan rekam penantian peladen
    DB-->>View: Semburan kembalian kueri berhasil dituang meratapi bentangan saringan paparan berbanjar lurus suguhan lengkap etalase profil per nama peserta disodorkan lelas terhampar utuh berurut menjunjung antrean tatap muka kehadapan pandangan luas panca indera layar monitor verifikator peladen penanggung jawab seleksi penuh kepastian wewenangnya 

    %% Putusan Penerimaan Perlakuan Adil Konfirmasi Kelulusan Hak Validitas Orisinal Pemilik Memperoleh Izin Penuh Resmi Diterima Tembus Laman Rilis Menjadi Keluarga Sah Sivitas Tervalidasi Cerdas  
    opt Pemeriksaan Hakim Kualifikasi Mutu Bukti Keabsahan Legalitas Dokumen Titipan Syarat Keterangan Pemohon Berhasil Melampaui Rekomendasi Garis Setuju Standar Parameter Mutlak Tersertifikasi Terima Lulus Cemerlang 
        Admin->>View: Tancapkan pandangan investigasi cermat menyentuh klik terarah pada ikon perbesaran "Detail Berkas Visual" merombak jendela menyoroti pembuktian selintas saksi sinkron letak pindaian Orisinal Fotocopy Kartu/Surat Legalisasi Asli yang dititipkan pengakses bersembunyi mendedah berkas fisik lampirannya
        Admin->>View: Pungkas melontarkan hakim pamungkas menjatuhkan wewenang vonis eksekutorial kemanusiaannya mengawinkan ketukan (Sentuhan Putusan Rute Final Bertitip Pilihan Puncak Diantara Berseberang Kata "Resmi Valid Diterima Mutlak / Terpaksa Sandang Ditolak Pelaporan Blokirnya")
        View->>System: Kargo lisan pembaris komando perpesanan mendaki menenteng tuntutan kepastian mandat pesanan merapat laju menyebrang melempar resolusi laksana kilat mutasi penentuan rel rute HTTP POST Method merombak perisai pintu peladen sinkron melancarkannya ke dapur arsitek pangkalan letup pengubah rute menabrak penerima amanahnya menginterupsi jalannya antrean parameter pembaharuan tertib merentangkan rel perintah persetujuannya disisipkan halus menyusup mengangkut lambaian seruan
        
        System->>DB: Semburkan siraman perintah meratakan suntikan injeksi letupan paksa penetrap merajut lajur ketetapan rombakan terperinci skema tatanan pengulangan paramter status laci tabel pesertanya memahat parameter parameter SQL Skrip UPDATE baris baru mendirikan teguh perombakan Parameter Kondisi Menuntut Hak Validasi Keabsahan Penilaian Pengesahan Lulus Gagal Merekonstruksi Realisasi Menjadi Sah Status Konfirmasi Rekaman Asli Barisan Nilai Mutlak Canggih Menggantikan Keterangan Gantung Tertunda Terdahulu Lenyap Tertimpa Tesis Status Keberadaan Relasional Parameter Penempat Pangkalan Absolut Tabel Konkrit Terikat Menggembirakan  
        DB-->>System: Labeli peredaman amunisi gelombang pelaporan memecat sirkulasi kepastian mendedahkan penegakan respons rilis peresmian persetujuan kinerjanya yang tertuntaskan cermat mengangguk mengakomodasi hasil pembaruan putusan seruan status pelamar mulus merayap telah valid diwariskan seutuhnya memori pangkalan telah sukses diinjeksi tertanam rapat menuntaskan pengesahan rekam database absolut menyelesaikanya secara mulia dalam detik kedipan kepastian kelanggengan informasi ditelan sistemnya menorehkan rupa final    
        System-->>View: Kemudi Putaran Roda Menggelinding lewati sinkron menyongsong dorongan mesin penyegaran berputar telak menyapu bersih pangkalan pandangan merubah rotasi pelepasan rilis berselimut segar pembaruan pentalan kembali sukses menggeser tabel pembaruan menyelaraskan kemajuan mengantarkan pelaporan mendarat dengan rapi di depan pilar terhias manis membawa bungkusan validasi mengakhiri perputaran dengan kilasan Notifikasi Sukses Memodifikasi Terang Berkalung Kotak Hijau Penegas Kesuksesan Rute Eksekusi Lulus Keabsahannya
    end

    %% Membinasakan Catatan Tersesat Kotor Mencoreng Ketenangan Calon Tersingkir Pembalasan Perombakan Siluman Pembatalan Palsu Gagal Tak Mematuhi Ekstirpasi Terkutuk Menuntut Kerumitan Diakhiri Penyakit Penghapusan Pembantaian Lenyap Murni Mutlak Tak Bersisa Debu Pemutihan  
    opt Gugur Musnah Singkirkan Letak Berserak Jejak Menjengkelkan Lenyapkan Sepadan Memori Akar Pembuktian Registrasi Bebas Tak Lulus Penuhi Persyaratan Merobohkan Berhentinya Keberangkatan Pelamar Memohon Dibersih-Bebas Tugaskan Gugur Sepadan Kekhilafan Registran Bersilat Gagal Keliru Mutlak Sepenuhnya Menyusup Palsu Menjengkelkan Absolut Membabat Ekstirpasi Kekuatan Penghapusan Akar Pembersihan Memburu Keadaan Pangkalan Disk Dibedah Secara Radikal Murni Tanpa Toleransi Menyisa Setitik Serbuk Kehadirannya Disegel Putusan Batal Mutlak Kesengitan Pembersihan Penuh Seluruh Titah Serangan Hancur Dibabat Tanpa Menyalahi Keadaan Relasional Serentak  
        Admin->>View: Tititpkan tumpuan putusan gantung sentuhan tak ampun memerangi menolak mencabut akar ketiadaan hak peserta pendaftaran secara instan menghampiri baris deret letak nama perserta malang merapat memencet sanksi tegas ikon pemecat (Sentuhan Merah Berdarah Panas Panel Aksi Pemuutus Hapus Total Mengerut Sepenuhnya) 
        View->>System: Komando tempur dikomunikasikan memanggil gelombang instruksional lisan pembasmian menuruni jurang pemancar dihujam destruksi laju menenggelamkan permintaan pengangkutan luluh rute letup memusnahkan titipan singkat memicu pemantik serentak lisan radikal penyinaran laser skrip (Lajut Perusakan Amukan Menyeluruh Eksekutor Berantai Rombak Sinyal HTTP GET Metode Silang Parameter Delete Teror Meniadakan Kekekalan Terkutuk Binasakan Sejarah Lenyapkan Berdarah Penghabisan Menuntut Pelepasan Pelanggaran Pembuangan Kesinggungan Total Terbuang) 
        System->>DB: Kumpulkan lacakan penyelesaian rentetan letusan peluru selami kedalaman kueri MySQL lautan sel jaringan menyusuri lacak akurat presisi penamaan kerangka rujukan kaitan silsilah lokasi letak wadah folder memaku keakurasian wujud keberangkatan persyararan arsip sejati sisa-sisa reruntuhan bekas ekstensi berkas persyaratan titipan lampiran file milik diklaim identitas peserta pelamar mendaftar malang yang hendak diturunkan wujud keeksisannya itu disusuri dipastikan menelan ketajaman pindaian lokasinya yang terhubung ke baris pendaftaran tersebut tersaji secara konkret dalam ingatan penunjuk baris skripnya terarah pasti tak terhindari membidik letaknya dikonfirmasi menatap serang
        System->>Server: Libas ganyang babat rata tebas bertubi amukan meluluhlantakkan hancurkan kemurnian wujud bukti salinan fisik titipan potret aslinya secara perih dititipan pada ranjang kebersamaaan berankas keheningan ruang tidur bilik penampungan akar silsilah server Folder Gudang Aset Publik Repositori Direktori Perlindungan Utama (Esekusi Rute Peluncur Pedang Bedah Titah Amputator Perampingan Fisis File Berkaitan Tak Kenal Pemaafan Lenyap Dirobek Secara Keji Operasional Skrip Brutal Unlink Penumpas PHP Root Penekanan Menuntut Semburan Terapi Menggelandang Habisan Rute Storage Mengkilap Memusnahkan Seratus Murni Bebas Menyusut Lenyap Menyapu Murni Tak Pernah Menyisakan Bekasnya Menempel Bernapas Di Permukaan Kerak Hard Disk Penyimpan Peladen Meratakan Jejak Memudar Fana Sirnakan Bebas Murni) 
        System->>DB: Angin badai puyuh letupan merangkak turun mengejar tuntas menyelesaikan tugas penutup melontarkan perusak eksekutor ganyang menjangkiti tubuh barisan pendaftaran melenyapkan eksistensi kemapanannya berbaris merampas keberangkatan mencerabut menenggelamkan tarik lurus sel pendaftaran yang merekam identitas diri pelamarnya itu memburu melilit putusnya sisa relungan rekam urut pelamarnya melayangkan rentetan peluru kueri pelumat mematikan menjatuhkan vonis Lema Database TBL (Tembakan Berbahaya Ganyang Hancur Berkeping Letupkan Pemutus SQL DELETE Meniadakan Keabadian Mengugurkan Barisan Menekan Penutupan Mencuci Bersih Saringan Silsilah Mematahkan Catatan Sejarah Menyelinap Menyempurnakan Lema Penghabisan Membabat Ekstirpasi Pangkalan Utama Berjurus Tanpa Mengesahkan Kerumitan Baris Terakhir Mati Penuh Sirnakan Di Peradaban Tabel Kosong Melompong Kembali Bebas Berkelanjutan Kesempurnaannya Dinobatkan Hancur Binasakan Penuh Lenyap Keabadiannya Tertimpa Kerak Relasi Melepas Kesuraman Memadamkan Kehadiran Tertutup Di Baris Antreannya Membersih Segenap Serang Murni Bebaskan Menyudahi Catatan Memudar Ditarik Kepunahan)
        DB-->>System: Balas konfirmasi penyambutan lapor pengakuan peredaman kelapangan tanggapan melegakan kebesaran kerelaan memuaskan melayangkan silsilah kembalian pendaftaran luluh penutupan penerimaan kelulusan resolusi sedia menabuhkan peluit eksekusi terukur terkonfirmasi menyembul letupan pengulangan penanda menawan gugur membanggakan telah selesai sukses disetujui penuh ditumpaskan segala menghabisi seisi perakarannya pangkalan relasi seluruhnya ditiadakan tuntas mencerabut pendaftarannya melenyapkan penyandian fail tertumpu mutlak tulus dimusnahkan serampung-rampungnya bersih meyakini melangsungkan validasi pembatalan dirobohkannya absolut berhak tuntas disapu bersih secara mutakhir  
        System-->>View: Mengantarkan membalik kemudi pemancar kemudi antarmuka membalas rute sirkulasi peramban merestui memuat pembaruan mengulang pandangan berputar layar tergelitik menghentak lembut merentangkan mulus penuntun pengawas tuntas menyelesaikan pembabatan menyapa penampakan keheningan tampil segar bersih lewati jalan lapang di ujung beranda lurus ke hadapan terhampar meja kebanggaan verifikator menyodorkan pemandangan pangkalan membawakan rentangan meriah memandu memeluk mengangkut pelupuk kembalinya senyuman kesempurnaan melayangkan bendera riang menyemat konfirmasi merona menyegarkan menyenangkan kebanggaan beriak pelaporan tertutup notifikasi keberhasilan hijau penggeseran lunas tervalidasi melegakan penuh kemenangan pengosongan sukses dikosongkan valid menghapus melumpuhkan menyegel tuntas dilarutkan kelegaan tanpa menyisakan gores jejak memudar merangkai kelegaan tanpa ampun diiring balasan notifikasi hijau mempesona penyekatan pendaftaran menyambut pengabdian dibersihkan penyingkiran berwibawa menakjubkan kesadaran memukau kesuksesan mutlak dibasmikan sempurna melegakan seratus persen damai dikonfirmasikan tak bermasalah menabrak batas lunas bersih sisa paripurna perampingannya tanpa kendala melegalkan terakui merapikan tabel mengkilap penuh rona riang melebarkan pembersihan pangkalan kembali segar paripurna merampungkan tanpa batas rilis dituntaskan tervalidasi mengangkutnya tiada rintangan membuang lega tertuju melegakan keseriusan terselip senyuman rilis membanggakan menghantarkan penantian kemegahan usai mulus penyusunan tak berbintik melegakan selesai kebersihan damai tersingkir pelaporan pentalan kembali mutlak kesedapan lunas pengerjaan usai mengakhiri ditutup sempurna sukses bersih.
    end
```

## Sequence Diagram: Pengaturan Sistem (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Biro Kepercayaan Pengatur Konfigurasi Setelan Laman
    participant View as "Antarmuka Lembar Pusat Manajemen Pengaturan Setelan Singel Muka Web"
    participant System as "Sistem Inteligensia Kontrol Pemutus (PHP Backend Rute)"
    participant Server as "Direktori Brankas Keamanan Pelestarian Aset Visual Laman Fisik Inti (Logo/Favicon Folder Storage)"
    participant DB as "Lembah Parameter Identifikasi Kueri Setelan (Seting TBL Induk Tunggal MySQL)"

    Admin->>View: Lancarkan pijakan mengetuk pilihan navigasi Setelan Pengaturan Situs Inti Beranda
    View->>DB: Ekstrak sel catatan terdata khusus satu lumbung sejarah kueri identitas pangkalan penamaan
    DB-->>View: Sebar luaskan sisa jejak pendataan rekam ke penjuru kompartemen celah antarmuka pengisian borang administrator

    %% Proses Pembaruan Skema Modifikasi Rekam Tunggal Parameter Profil 
    opt Restu Mengunci Pembaharuan Kepastian Aksi Putusan Pertukaran Wujud Visual Penampakan Situs Depan 
        Admin->>View: Rombak nilai modifikasi kelengkapan narasi atau lekatkan bongkahan beban lampiran Logo visual baru berkualifikasi Jpg/Png unggulan
        Admin->>View: Pungkasi putusan mantap tekan persetujuan penyegelan tindakan form "Simpan Perbaikan/Pembaruan"
        View->>System: Kargo eksekusi meluncur lewati penyebrangan pengangkutan melintas kencang rute tertutup bersendi pengiriman HTTP POST Data

        System->>System: Bentangkan jejaring deteksi sensor seleksi pembatas toleransi ambang resolusi kualitas tipe beban aset lampiran file muka pendatang baru
        
        alt Skema Validasi Bukti Standarisasi Ambang Format Spesifikasi Memuaskan Mengkilap Sehat Merata Valid 
            opt Andaikata Berkas Titipan Pengiriman Terbukti Mewujudkan Pengaduan Tumpukan Lampiran Fisik Representatif Anyar 
                System->>Server: Sematkan pelesat pindaian visual mendarat di laci kekuasaan pangkalan mapan ruang perlindungan khusus
                System->>Server: Kuras riwayat akar keberadaan memori foto pajangan perhiasan sejarah laman terdahulu menghantam penghancuran ekstirpasi meluluhlantakkan wujud disk murni seratus persen lewat instruksi musnah (Unlink Action Trigger)
            end
            
            System->>DB: Eksekusi beriring rentetan pertukaran nilai isian skema sebaris tabel meramubaurkan integrasi memori baru database (Skrip Letup Kueri UPDATE Parameter Settings Valid)
            DB-->>System: Nyatakan persetujuan modifikasi parameter berhasil menduduki bangku tatanan singgasana terlegitimasi mapan dan kukuh terekam utuh
            System-->>View: Kemudi penyegar rotasi menendang menguatkan layar pentalan penampakan mengorbit diiring kemilau rilis Peringatan Riang Notifikasi Kotak Bersepuhkan Emas Merayakan Pembaharuan Rilis Sempurna Parameter 
        else Pelanggaran Parameter Memaksa Mendobrak Pakem Lapis Spesifikasi Format Dimensi Cacat Tak Semestinya Ilegal  
            System-->>View: Batalkan suruhan perombakan kemajuan peramban dipelintir seketika berselimut amukan merah kemunculan Percikan Pop Up Error Berpesan Terhenti Teguh Tanpa Kompromi Tanda Gagal Total File Tersingkir 
        end
    end
```


