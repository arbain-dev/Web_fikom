# Kumpulan Diagram Backend

## Sequence Diagram: Login Administrator (Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Admin
    participant View as "Halaman Login"
    participant System as "Sistem / PHP"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman login
    View-->>Admin: Tampilkan form login
    
    Admin->>View: Ketik Username & Password, tekan Login
    View->>System: Kirim form data (HTTP POST)
    
    System->>DB: Cek kecocokan User/Pass
    DB-->>System: Validasi kredensial
    
    alt Login Berhasil
        System->>System: Set Session Login Aktif
        System-->>View: Redirect ke Dashboard Admin
    else Login Gagal
        System-->>View: Tampilkan pesan Error Login
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
    actor Admin as Administrator
    participant View as "Halaman Pendaftaran"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder Aset)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka halaman antrean validasi
    View->>DB: Tarik senarai pendaftar
    DB-->>View: Tampilkan tabel urutan pendaftar masuk

    opt Tinjau Pendaftar
        Admin->>View: Cek kelengkapan fisik file pendaftar
        Admin->>View: Putuskan status (Diterima/Ditolak)
        View->>System: Kirim konfirmasi putusan status
        
        System->>DB: Update Status Validasi Pendaftar di DB
        DB-->>System: Status Validasi Mutakhir
        System-->>View: Tabel Segar dengan Notifikasi Sukses
    end

    opt Hapus Data / Pendaftar Bohong
        Admin->>View: Klik tombol hapus khusus
        View->>System: Minta Hapus baris Pendaftar
        System->>DB: Cari referensi lokasi file lampiran
        System->>Server: Musnahkan file lampiran dari Server
        System->>DB: Lenyapkan data pendaftar (Hapus baris)
        DB-->>System: Proses pemusnahan sukses
        System-->>View: Halaman ditarik bersih memunculkan Konfirmasi Sukses
    end
```

## Sequence Diagram: Pengaturan Sistem (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Pengaturan"
    participant System as "Sistem / PHP"
    participant Server as "Storage (Folder Aset Logo)"
    participant DB as "Database (MySQL)"

    Admin->>View: Akses menu Pengaturan Sistem
    View->>DB: Ambil baris profil pengaturan
    DB-->>View: Sajikan isian ke form

    opt Jika Klik Ubah/Simpan Profil
        Admin->>View: Modifikasi teks/Upload gambar Logo favicon
        Admin->>View: Konfirmasi "Simpan"
        View->>System: Kirim paketan form (HTTP POST)

        System->>System: Cek ekstensi aman file logo
        
        alt Spesifikasi Gambar Valid
            opt Jika Logo Website ikut diganti
                System->>Server: Simpan fisik Logo baru ke direktori internal
                System->>Server: Kuras riwayat aset logo lama (Unlink)
            end
            
            System->>DB: Update relasi pengaturan di tabel baris tunggal
            DB-->>System: Relasi SQL berhasil dirajut permanen
            System-->>View: Segarkan halaman dengan rilis Notifikasi Sukses
        else Spesifikasi Gambar Ilegal
            System-->>View: Tolak dan keluarkan Pesan Error Peringatan
        end
    end
```


