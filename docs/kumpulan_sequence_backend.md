# Kumpulan Diagram Backend

## Sequence Diagram: Halaman Login Admin
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as Halaman Login
    participant System as Sistem (PHP)
    participant DB as Database (MySQL)

    Admin->>View: Akses URL /admin/login
    View-->>Admin: Menampilkan Form Login
    
    Admin->>View: Input Username & Password
    Admin->>View: Klik Tombol "Login"
    View->>System: Mengirimkan Data Kredensial (POST)

    System->>DB: Query Cek Keberadaan Username
    DB-->>System: Return Hasil Pengecekan User

    alt Username Terdaftar / Ditemukan
        System->>System: Validasi Kecocokan (password_verify)
        alt Password Valid & Cocok
            System->>System: Aktifkan Session ($_SESSION['admin_logged_in'])
            System-->>Admin: Autentikasi Sukses, Redirect ke Dashboard
        else Password Salah
            System-->>View: Kembalikan Tampilan + Pesan Error (Password Salah)
        end
    else Username Tidak Ditemukan
        System-->>View: Kembalikan Tampilan + Pesan Error (Akun Tak Dikenal)
    end
```

## Sequence Diagram: Kelola Slider (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Kelola Slider"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Storage (Uploads/)"
    participant DB as "Database (MySQL)"

    Admin->>View: Akses Antarmuka (/admin/kelola_slider)
    View->>DB: Rutinitas Penarikan Riwayat Data Slider
    DB-->>View: Sajikan Kumpulan Tabel Slider

    %% Proses Penambahan Data atau Update
    opt Menambah/Mengedit Slider
        Admin->>View: Mengisi Form Teks + Mengunggah Potret Slider
        Admin->>View: Mengirim Persetujuan Eksekusi "Simpan"
        View->>System: Kompilasi Ekspedisi Data (HTTP POST Multiform)

        System->>System: Uji Validasi Parameter Skala dan Tipe File
        
        alt Filter Keamanan File Valid Terpenuhi
            opt Kondisi File Baru Hadir
                System->>Server: Titipkan Gambar di Direktori Penampungan (Move_Upload)
                opt Update Data (Skenario Edit)
                    System->>Server: Musnahkan dan Bakar Artefak Potret Lama (Unlink)
                end
            end
            
            System->>DB: Rumusan Kueri INSERT / UPDATE (rekaman teks + path gambar)
            DB-->>System: Labeli Kesuksesan Modifikasi
            System-->>View: Pentalan Rute (Redirect) Berbalut Pesan Sukses  
        else Pelanggaran Ekstensi / Resolusi
            System-->>View: Tarik Kembali Serahan & Beri Pesan Penolakan
        end
    end

    %% Proses Hapus Data
    opt Penghapusan Slider Publik
        Admin->>View: Sepakati Konfirmasi Penghapusan Item
        View->>System: Kirim Arahan Singkat Hapus (HTTP GET Action Delete)
        System->>DB: Ekstrak Lokasi Path File dari Database
        System->>Server: Cabut File Potret Aktual Tersebut (Unlink File)
        System->>DB: Tembakkan Kueri Amputasi Penghapusan(DELETE)
        DB-->>System: Pemusnahan Telah Diakui
        System-->>View: Tarikan Pengarah Ulang Beserta Rilis Pesan Notifikasi Sukses
    end
    
    %% Proses Ganti Status Aktif/Tidak Aktif
    opt Atur Kondisi Tampil/Sembunyi
        Admin->>View: Ubah Status Terlihat (Tombol Aktif/Inaktif)
        View->>System: Lempar Titik Kueri (GET status Update)
        System->>DB: Kueri UPDATE Mengganti Variabel Bool_Status
        DB-->>System: Laporan Selesai
        System-->>View: Segarkan Ulang Tabel Secara Paripurna
    end
```

## Sequence Diagram: Kelola Berita (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Berita"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Storage (Uploads/)"
    participant DB as "Database (MySQL)"

    Admin->>View: Akses Antarmuka Utama (/admin/kelola_berita)
    View->>DB: Kueri Penarikan Rekam Jejak Berita
    DB-->>View: Sajikan Kompilasi Tabel Artikel Berita

    %% Proses Tambah / Edit Berita
    opt Pembuatan Rilis/Pengeditan Berita
        Admin->>View: Input Judul, Konten Teks, dan File Foto Sampul
        Admin->>View: Konfirmasi Aksi Publikasi "Simpan"
        View->>System: Kompilasi Ekspedisi Data (HTTP POST)

        System->>System: Pemeriksaan Standar Validasi Ekstensi dan Resolusi File
        
        alt Validasi Ekstensi Gambar Mulus
            opt Terdapat File Gambar yang Baru Diunggah
                System->>Server: Titipkan Gambar Sampul di Direktori (Move_Upload)
                opt Pengeditan (Update) Bukan Data Baru
                    System->>Server: Lenyapkan Artefak Gambar Sampul Lama (Unlink)
                end
            end
            
            System->>DB: Eksekusi Kueri INSERT / UPDATE (teks narasi + alamat gambar)
            DB-->>System: Labeli Kesuksesan Modifikasi Data
            System-->>View: Pentalan Rute (Redirect) Berbalut Pesan Sukses  
        else Terdeteksi Pelanggaran Format File
            System-->>View: Tolak Penyimpanan dan Rilis Notifikasi Penolakan
        end
    end

    %% Proses Hapus Berita
    opt Penghapusan Artikel Berita
        Admin->>View: Setujui Konfirmasi Penghapusan Artikel
        View->>System: Luncurkan Permintaan Hapus (HTTP GET Action Delete)
        System->>DB: Ekstrak Alamat Lokasi File Sampul
        System->>Server: Eksekusi Pencabutan File Fisik Sampul Berita (Unlink)
        System->>DB: Tembakkan Kueri Musnahkan Record Berita (DELETE)
        DB-->>System: Laporan Pemusnahan Diterima
        System-->>View: Kembalikan Rute dengan Notifikasi Penghapusan Tuntas
    end
```

## Sequence Diagram: Kelola Data Dosen (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Data Dosen"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Storage (Uploads/Dosen)"
    participant DB as "Database (MySQL)"

    Admin->>View: Singgah di Antarmuka Utama (/admin/kelola_dosen)
    View->>DB: Eksekusi Tuntutan Daftar Susunan Dosen
    DB-->>View: Alirkan Tabel Rekam Jejak Civitas

    %% Proses Tambah / Edit Dosen
    opt Menambah Baru/Meremajakan Profil Dosen
        Admin->>View: Entri Nomor NIDN, Nama, Jabatan Akademik, dan File Pasfoto
        Admin->>View: Menancapkan Persetujuan "Simpan Profil"
        View->>System: Kompilasi Perjalanan Paket Data (HTTP POST)

        System->>System: Sidak Investigasi Format Berkas Pasfoto
        
        alt Filter Keamanan File Pasfoto Lolos
            opt Apabila Terdapat Aktualisasi File Pasfoto Baru
                System->>Server: Semayamkan Identitas Fisik Pasfoto di Folder 
                opt Di Tengah Proses Update Data
                    System->>Server: Bakar File Rupa Pasfoto Lawas (Unlink)
                end
            end
            
            System->>DB: Luncurkan Eksekusi SQL INSERT / UPDATE ke Tabel
            DB-->>System: Buktikan Restu Modifikasi Tabel Tertanam
            System-->>View: Lontarkan Pergeseran Pengarah Rute (*Redirect*) Sukses  
        else Gagal Uji Resolusi dan Ekstensi
            System-->>View: Hambat Pengarsipan & Paparkan Pesan Kesalahan
        end
    end

    %% Proses Hapus Dosen
    opt Pemusnahan Daftar Rekam Staf Pengajar
        Admin->>View: Berikan Verifikasi Penarikan Data (Hapus Dosen)
        View->>System: Utus Instruksi Maut Perampingan (HTTP GET Action Delete)
        System->>DB: Jemput Posisi Alamat Pasfoto dari Laci Tabel
        System->>Server: Tindak Lanjut Pemusnahan Entitas Fisik Potret (Unlink)
        System->>DB: Letupkan Tembakan Amputasi Basis Data (DELETE TBL)
        DB-->>System: Akui Pemusnahan Sempurna
        System-->>View: Kembalikan Tampilan bersama Pemberitahuan Konfirmasi
    end
```

## Sequence Diagram: Kelola Fasilitas Ruangan (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Kelola Ruangan"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Storage (Uploads/Fasilitas)"
    participant DB as "Database (MySQL)"

    Admin->>View: Sambangi Pintu Akses Pengelolaan (/admin/kelola_ruangan)
    View->>DB: Eksekusi Tuntutan Daftar Ketersediaan Fasilitas Ruang
    DB-->>View: Distribusikan Tabel Susunan Aset Fasilitas Kampus

    %% Proses Tambah / Edit Ruangan
    opt Mencatat Ruang Baru/Merombak Fasilitas Lokasi
        Admin->>View: Bubuhkan Teks Kode Ruang, Nama, Kapasitas Fasilitas, & Foto Ruangan
        Admin->>View: Setujui Eksekusi Pengusulan Aset ("Simpan")
        View->>System: Gulirkan Pelayaran Paket Identitas (HTTP POST MULTIPART)

        System->>System: Uji Kelayakan Standarisasi Gambar Fisik
        
        alt Cek Filter Uji Tipe File Valid Menghijau
            opt Terdeteksi Pintu Unggahan Foto Penampakan Anyar
                System->>Server: Kandangkan Wujud Fisis Foto ke Lingkar Repositori
                opt Update (Realisasi Edit Aset Lawas)
                    System->>Server: Enyahkan Tapak Visual Potret Ruangan Terdahulu (Unlink)
                end
            end
            
            System->>DB: Luncurkan Panah Kueri SQL INSERT / UPDATE Pada Laci Fasilitas
            DB-->>System: Yakinkan Interogasi Mutasi Tabel Telah Terekam
            System-->>View: Kembalikan Rute Pemantul (Redirect) & Restui Pesan Sukses  
        else Terpeleset Uji Spek Resolusi & Ekstensi
            System-->>View: Hambat Pengayaan Data & Peringatkan Melalui Layar
        end
    end

    %% Proses Hapus Ruangan
    opt Mengakhiri Status Kepemilikan (Penghapusan Data Fasilitas)
        Admin->>View: Menarik Ketetapan Pembersihan Ruang (Tombol Hapus)
        View->>System: Terbangkan Instruksi Pembabatan Data (HTTP GET Delete)
        System->>DB: Seret Identitas Nama File Berdasarkan Sel Rujukan Ruang
        System->>Server: Tindak Tegas Enyahkan Fisik File Penampakan (Unlink Function)
        System->>DB: Eksekusi Suntikan Penghangusan Kueri Tabel (DELETE)
        DB-->>System: Respon Deklarasi Pemusnahan Usai
        System-->>View: Lintasi Ulang Rute dengan Rilis Kilat Label Konfirmasi Tuntas
    end
```

## Sequence Diagram: Kelola Fasilitas Laboratorium (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Lab"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Storage (Uploads/Lab)"
    participant DB as "Database (MySQL)"

    Admin->>View: Akses Ruang Kendali Lab (/admin/kelola_lab)
    View->>DB: Eksekusi Tuntutan Tabel Daftar Laboratorium
    DB-->>View: Bentangkan Tabel Aset Fasilitas Lab
    
    %% Proses Tambah / Edit Lab
    opt Menginisiasi Rekaman Lab Baru/Mengedit Fakta Fasilitas
        Admin->>View: Masukkan Form Identitas Lab, Spek Kapasitas, & Potret Laboratorium
        Admin->>View: Setujui Usulan Perekaman "Simpan"
        View->>System: Kargo Paket Data Dihempaskan (HTTP POST MULTIPART)

        System->>System: Menimbang Kelegalan Ekstensi & Resolusi File Gambar
        
        alt Validasi Spesifikasi Pemilahan Gambar Sah
            opt Ditemukan Selipan File Fisis Potret Terbaru
                System->>Server: Taburkan Gambar pada Kolam Folder Repositori Server
                opt Update (Kondisi Pengeditan Aset Lama)
                    System->>Server: Musnahkan dan Bakar Potret Peninggalan Lama (Unlink)
                end
            end
            
            System->>DB: Panah Menembus Tabel Eksekusi SQL INSERT / UPDATE
            DB-->>System: Verifikasi bahwa Tabel Terdampak Perubahan Modifikasi
            System-->>View: Kembalikan Jalur Pentalan Layar (Redirect) & Restui Pesan Sukses  
        else Menyimpang dari Parameter Aman File
            System-->>View: Tampik Pengajuan & Peringatkan Admin dari Layar
        end
    end

    %% Proses Hapus Lab
    opt Pembersihan Identitas Ruangan Lab Permanen
        Admin->>View: Mencabut Status Registrasi Aset Lab (Aksi Hapus)
        View->>System: Terbangkan Instruksi Pembabatan Rekam Jejak (HTTP GET Action Delete)
        System->>DB: Incar Alamat Rujukan File Potret Berlandaskan Nama Lab
        System->>Server: Amputasi Keberadaan Fisik Lampiran (Unlink System)
        System->>DB: Tancapkan Tusukan Kueri Ganyang Basis Data (DELETE TBL)
        DB-->>System: Deklarasi Kehancuran Lema Selesai
        System-->>View: Meluncurkan Kembalian Halaman bersama Konfirmasi Keberhasilan
    end
```

## Sequence Diagram: Kelola Kalender Akademik (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Kelola Kalender"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Storage (Media Kalender)"
    participant DB as "Database (MySQL)"

    Admin->>View: Menelusuri Modul (/admin/kelola_kalender)
    View->>DB: Rutinitas Penarikan Katalog Tabel Sejarah Kalender
    DB-->>View: Suguhkan Daftar Rujukan Kalender Berjalan
    
    %% Proses Tambah / Edit Kalender
    opt Meregistrasikan Rilis Kalender Semester Terbaru
        Admin->>View: Bubuhi Titel Tahun Akademik, Teks Ringkas, & Upload Grafis Kalender
        Admin->>View: Pancangkan Eksekusi Penyimpanan Form (Update/Save Record)
        View->>System: Kargo Titipan Pengiriman Melintas via Akses (HTTP POST MULTIPART)

        System->>System: Analisa Uji Ekstensi Keamanan & Toleransi Gambar Visual Kalender
        
        alt Filter Batasan File Mulus Dilewati
            opt Apabila Terdapat Bongkahan Grafik File Foto Baru
                System->>Server: Timpa Arsip Baru Penampakan Kalender Masuk ke Rak Repositori 
                opt Rejuvenasi Tabel (Modus Edit Jadwal)
                    System->>Server: Habisi Jejak Bayangan Gambar Kalender Akademik Lama (Unlink)
                end
            end
            
            System->>DB: Luncurkan Eksekusi Tali Kueri (SQL INSERT / UPDATE) Merasuk ke Tabel
            DB-->>System: Akuisi Penerimaan Catatan Kalender Memori MySQL
            System-->>View: Kembalikan Kemudi Pentalan Layar Memakai Sinyal Sukses Hijau 
        else Dimensi atau Ekstensi Siluman Terendus
            System-->>View: Tampik Permintaan & Singkapkan Tirai Rilis Error Resolusi
        end
    end

    %% Proses Hapus Kalender Terlewat
    opt Menyortir Membuang Media Eksemplar Kalender Tenggelam
        Admin->>View: Sentuh Opsi Perintah Aksi Hapus Permanen
        View->>System: Lontarkan Permintaan Pelenyapan Item (HTTP GET Action Delete)
        System->>DB: Telusuri Sandi Indeks Nama Rujukan File Terdahulu
        System->>Server: Langsung Runtuhkan Penampakan Arsip Fisik Menuju Penghapusan (Unlink)
        System->>DB: Lontarkan Perusak Entitas Baris Database (Kueri DELETE)
        DB-->>System: Restui Kesetujuan Penebasan Rekam Jejak Sukses
        System-->>View: Giring Pelayar Mundur Menyegarkan Tabel Teriring Kotak Kesuksesan
    end
```

## Sequence Diagram: Kelola Kurikulum (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Arsip Kurikulum"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Dokumen Formal (Docs/Files)"
    participant DB as "Database (MySQL)"

    Admin->>View: Menapak Penelusuran URL Kurikuler (/admin/kelola_kurikulum)
    View->>DB: Kueri Inventarisasi Fail Dokumen Pendataan
    DB-->>View: Gelar Paparan Katalog Tabel Rekam Kurikulum
    
    %% Proses Tambah / Format Unggahan Dokumen
    opt Mengedarkan Berkas Dokumen Kurikulum Akademik Termutakhir
        Admin->>View: Masukkan Penamaan Kurikuler, Rangkuman, & Unggah Dokumen Asli (PDF/DOC)
        Admin->>View: Ketuk Validasi Penambatan ("Upload Dokumen")
        View->>System: Kapalkan Integrasi Rumpun Lampiran di Rute HTTP POST Berkerah Rahasia

        System->>System: Eksekusi Deteksi Keamanan Format PDF/DOCX (Max: 10MB Threshold)
        
        alt Ambang Rasional & Kelegalan Tipe Pindaian Valid
            opt Bila Terdapat Deteksi Penyusupan File Arsip Baru
                System->>Server: Inapkan Dokumen Legal Kurikulum Memasuki Laci Publik Repositori 
                opt Pengaduan Modifikasi Update (Menimpa Dokumen Induk Lawas)
                    System->>Server: Kikis Keberadaan Dokumen Peraturan Silam Tak Bertuan (Unlink)
                end
            end
            
            System->>DB: Tembuskan Lembaran Skema Sinkronisasi (INSERT/UPDATE TBL Kueri)
            DB-->>System: Nyatakan Pembaruan Basis Kepustakaan Web Mulus Disetujui
            System-->>View: Seret Balik Tampilan Layar Memakai Simbol Notifikasi Sukses Emas 
        else Tumpukan File Tersangkut Bobot Rakasa (Over-Sized/Invalid Type)
            System-->>View: Lontarkan Tetesan Pesan Penolakan ke Hadapan Mimbar Admin
        end
    end

    %% Proses Unduh (Download) & Hapus
    opt Manajemen Ekstraksi dan Pemusnahan Naskah Kurikulum
        Admin->>View: Seleksi Aksi Sentuh Pintu Lenyapan / Tautan "Hapus Dokumen"
        View->>System: Kargo Titipan Suruhan Pemusnahan Bertolak (HTTP GET Action Delete)
        System->>DB: Konfirmasi Tali Rujukan Titik Koordinat Naskah Formal File Eksisting
        
        alt Rantai Perampingan Disk Pemusnahan File
            System->>Server: Bedah Titik Akar Ruang Folder Dokumentasi (Amputasi via Unlink)
            System->>DB: Letupkan Ranjau Kueri Pemutihan Skema Lema Catatan (Skrip DELETE)
            DB-->>System: Tundukkan Pendaftaran Akhir Pemusnahan Telah Berlalu
        end
        
        System-->>View: Bentangkan Tirai Beranda Dihiasi Label Hijau Keberhasilan Pembersihan
    end
```

## Sequence Diagram: Kelola Mitra Kerjasama (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Kelola Kerjasama"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Storage (Logo Mitra/Uploads)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka Pelataran Modul Kerjasama (/admin/kelola_kerjasama)
    View->>DB: Rutinitas Penarikan Histori Kolaborator
    DB-->>View: Gelar Suguhan Etalase Indeks Tabel Kemitraan
    
    %% Proses Tambah / Format Unggahan Dokumen
    opt Mewujudkan Kemitraan Anyar / Reparasi Atribut
        Admin->>View: Tik Parameter Instansi Kerjasama, Detil Ringkas, serta Pasang Aset Logo
        Admin->>View: Jatuhkan Pilihan Aksi Serah-Rekam ("Simpan")
        View->>System: Kargo Meluncur pada Rel Kecepatan Sinkron Ekspedisi HTTP POST

        System->>System: Bentangkan Jaring Penakar Torsi Resolusi Gambar Visual Logo Mitra
        
        alt Filter Batasan Uji Standarisasi Aset Mulus
            opt Tertangkap Basah Keberadaan Injeksi File Gambar Fresh
                System->>Server: Sematkan Berkas Fisis Representasi Logo Lurus Ke Arsip 
                opt Manipulasi Mutasi Edit Lema
                    System->>Server: Kuras Eksistensi Rupa Visual Logo Rekan Lawas (Unlink Delete)
                end
            end
            
            System->>DB: Lepaskan Rentetan Tembakan Skema Tabel INSERT / UPDATE Relasional
            DB-->>System: Tandai Konfirmasi Modifikasi Tercatat Nyata
            System-->>View: Tolak Balik Kemudi Pengarah Laju (Redirect) Bercap Sukses  
        else Ditolak Kriteria Tipe File
            System-->>View: Tendang Suruhan & Munculkan Larik Tangkisan Error Resolusi
        end
    end

    %% Proses Hapus Rekan
    opt Pencabutan Tanda Penayang Hubungan Institusi Purna 
        Admin->>View: Konfirmasi Sentuh Aksi "Hapus Kemitraan" Permanen
        View->>System: Utus Perintah Delegasi Lenyapkan (Tali GET Action Delete)
        System->>DB: Lacak Pelataran Letak Rujukan File Logo Termutakhir Milik Institusi
        System->>Server: Langsung Pangkas Fisik Logo Peninggalan Relasi (Perintah Unlink)
        System->>DB: Hujam Rangka Kueri Pembasmi Pendaftaran Garis Relasi MySQL (DELETE TBL)
        DB-->>System: Persetujuan Pengguguran Memorie Tuntas
        System-->>View: Pentalan Perihal Penyelesaian Bersama Sorak Pemberitahuan Keberhasilan
    end
```

## Sequence Diagram: Kelola Data Penelitian (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Arsip Penelitian"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Lumbung Brankas Ekstensi Dokumen (Docs/Files)"
    participant DB as "Database (MySQL)"

    Admin->>View: Sentuh URL Pangkalan Rekam Penelitian Riset (/admin/kelola_penelitian)
    View->>DB: Kueri Inventarisasi Sejarah Panjang Dokumentasi Terdata
    DB-->>View: Tumpahkan Paparan Lembaran Jejak Tabel Riwayat Riset 
    
    %% Proses Tambah / Format Unggahan Dokumen
    opt Mewadahi Rilis Laporan Baru & Menjejalkan Berkas Keilmuan
        Admin->>View: Ketik Rincian Riset, Ringkasan, Sematkan Eksemplar Pindaian Murni (PDF/DOC)
        Admin->>View: Sahkan Penyerahan Ketuk Simpan "Upload Arsip"
        View->>System: Kargo Titipan Lepas Landas Berkendara HTTP POST

        System->>System: Bentangkan Jaring Filtrasi Kualifikasi Bobot (Threshold 10MB) & Hak Tipe Ekstensi
        
        alt Standar Toleransi Berkas Riset Mengalir Lolos Validasi
            opt Tangkap Serahan Susupan Sinkron File Eksemplar Teranyar
                System->>Server: Kandangkan Tubuh Fail Laporan Langsung di Palung Penyimpanan Publik Pusat 
                opt Realisasi Peremajaan Judul/Modus Revisi Menimpa 
                    System->>Server: Hapus Akar Tapak Dokumentasi Karya Silam Tak Bertuan (Unlink Path)
                end
            end
            
            System->>DB: Semburkan Injeksi Jarum Tabel (INSERT / UPDATE Peneliti Data)
            DB-->>System: Restu Nyatakan Pemecahan Jejak Terjalin Halus
            System-->>View: Kemudi Pentalan Kembali Dipercantik Kotak Keberhasilan Proses (Redirect Success)
        else Mendobrak Pakem Limitasi Resolusi/Kategori Ekstensi (Dilepaskan)
            System-->>View: Tendang Ajuan dan Hamburkan Notifikasi Peringatan Kasar 
        end
    end

    %% Proses Unduh Dokumen dan Hapus Permanen
    opt Titah Perampingan Aset Cabut Laporan Kedaluwarsa
        Admin->>View: Ketuk Perintah Permusuhan Status Registrasi Arsip ("Hapus")
        View->>System: Berangkatkan Eksekusi Permintaan Pemusnahan Instan (HTTP GET Action Delete)
        System->>DB: Tuntut Ekstraksi Informasi Presisi Lintasan Geofisikal File Asal Berkaitan 
        
        alt Babat Habis Jejak Arsip Disk Lapis Ganda
            System->>Server: Mutilasi Segenap Tubuh Wujud Fail Riset Fisik di Disk Web (Unlink)
            System->>DB: Letupkan Granat Skrip Pemusnah Rekaman Baris Basis Data Tabel Lema (DELETE TBL)
            DB-->>System: Konfirmasi Validasi Operasi Gugur Diserahkan
        end
        
        System-->>View: Tampilkan Laman Paripurna Mulus Bertaut Simbol Keriangan Tuntas Kerja
    end
```

## Sequence Diagram: Kelola Data Pengabdian (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Laporan Data Pengabdian"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Lumbung Pelestarian Arsip Dokumen Formal"
    participant DB as "Database (MySQL)"

    Admin->>View: Titipkan Langkah Kunjungan Antarmuka (/admin/kelola_pengabdian)
    View->>DB: Rutinitas Membedah Inventarisasi Sejarah Panjang Dokumentasi Terdata PKM
    DB-->>View: Gelar Suguhan Etalase Indeks Tabel Perjalanan Pengabdian 
    
    %% Proses Tambah / Format Unggahan Dokumen
    opt Mewadahi Rilis Laporan Baru & Menjejalkan Berkas Dokumentasi Praktik Lapangan
        Admin->>View: Rincikan Parameter Tajuk Abstrak, Serta Selipkan Pindaian Murni Format Paten (PDF/DOC)
        Admin->>View: Anggukkan Persetujuan Penyerahan Serah-Rekam "Upload Tuntas"
        View->>System: Kargo Titipan Laporan Mengorbit via Jembatan HTTP POST

        System->>System: Terjunkan Jembatan Penilaian Skala Batas Resolusi Beban & Izin Perlintasan Hak Ekstensi Berkas
        
        alt Verifikasi Toleransi Ekstensi Batas File Berjabat Tangan Mulus
            opt Singkap Kehadiran Pertukaran/Sumbangan Beban Berkas File Laporan Segar
                System->>Server: Rebahkan Sosok Fisik Dokumen Masuk Tepat ke Gudang Kepustakaan Publik Peladen 
                opt Manipulasi Mutasi Edit Timpa Lembaran Lawas
                    System->>Server: Berangus Memori Presensi Naskah Aturan Silam Agar Sirna (Instruksi Bedah Unlink)
                end
            end
            
            System->>DB: Panah Langsung Tembus Memahat Skema Tabel SQL (Kueri INSERT / UPDATE Data Sosok Pengabdi)
            DB-->>System: Nyatakan Penerimaan Pembaruan Bukti Telah Diakui Mesin Abstrak
            System-->>View: Tendang Ulang Kemudi Arah Bersatu Gelembung Riang Sukses Perihal Resolusi Transaksi 
        else Dimensi atau Spesifikasi Fail Liar Diblokir Melampaui Syarat Ketetapan Tipe
            System-->>View: Lontarkan Tetesan Pesan Penolakan Berbalut Ketegasan Keamanan Laman
        end
    end

    %% Proses Hapus Rekan
    opt Pembersihan Status Penyelenggaraan Lapuk (Cabut Daftar Arsip)
        Admin->>View: Lontarkan Perintah Cabut Registrasi Laporan Abdi Permanen (Titah Hapus)
        View->>System: Kirim Keputusan Final Permintaan Ekstirpasi Berjejak HTTP GET (Action Delete)
        System->>DB: Intai Presisi Kumpulan Koordinat Relasi File Salinan Fisik Milik Entitas Sasaran
        
        alt Kombinasi Pukulan Serang Habis Aset Jejak Disk Memori Host Server
            System->>Server: Mutilasi Deteksi Sisi Sisa Kehidupan Kehadiran File Di Lapis Gudang Arsip Peladen (Unlink Sistem)
            System->>DB: Lumat Tubuh Susunan Identifikasi Dokumen Lewat Tembakan Eksekutor Database MySQL (DELETE Query)
            DB-->>System: Pelunasan Kesepakatan Lapor Gugur Memori Tersertifikasi Absolut
        end
        
        System-->>View: Singkap Pentalan Resolusi Pemutar Tampilan (Redirect Beriring Indikator Hijau Menyenangkan Hati)
    end
```

## Sequence Diagram: Kelola Dokumen Fakultas (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Antarmuka Modul Dokumen Fakultas"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Lumbung Pelestarian Arsip Dokumen Formal"
    participant DB as "Database (MySQL)"

    Admin->>View: Titipkan Kunjungan Pintu Akses Kelola Dokumen
    View->>DB: Eksekusi Tuntutan Pembedahan Inventarisasi Arsip Dokumen
    DB-->>View: Bentangkan Tabel Sinkronisasi Riwayat Dokumen
    
    %% Proses Tambah / Format Unggahan Dokumen
    opt Meresmikan Rilis Bukti Dokumen Baru & Jejal Lampiran Fisik Berkas
        Admin->>View: Rincikan Parameter Penamaan Dokumen & Selipkan Format Murni Pindaian (PDF/DOC)
        Admin->>View: Tegakkan Konfirmasi Pengunggahan Fail ("Simpan Dokumen")
        View->>System: Muatan Ekspedisi Lampiran Berkendara Mengorbit Atas Perintah HTTP POST

        System->>System: Bentangkan Tameng Proteksi Ekstensi dan Resolusi Quota Bobot Dokumen
        
        alt Standar Toleransi Parameter Resolusi Berada Pada Limit Sah
            opt Verifikasi Kehadiran Transaksi Pemasukan Bukti File Lampiran
                System->>Server: Kandangkan Wujud Fisis File Laporan Tembus Repositori Umum
                opt Realisasi Pengeditan Modus Update Timpa (Revisi)
                    System->>Server: Cukur Habis Jejak Laporan Dokumen Pengganti Peninggalan Silam (Skrip Unlink)
                end
            end
            
            System->>DB: Semburkan Injeksi Lema Registrasi File ke Laci (Kueri INSERT / UPDATE)
            DB-->>System: Labeli Kesuksesan Rantai Pemrosesan Pencatatan Laci 
            System-->>View: Lontarkan Pentalan Balik Arah Bersama Payung Kilas Hijau Sukses Mutlak 
        else Tercatat Pendobrakan Ambang Batas Ekstensi Liar Bertubuh Over-Sized
            System-->>View: Tangkis Secara Disiplin Penawaran File Seraya Tampilkan Penolakan Berisiko
        end
    end

    %% Proses Hapus Dan Perampingan Berkas
    opt Rutinitas Pendisiplinan Perampingan Arsip Status Kadaluwarsa
        Admin->>View: Ketuk Fitur Pemusnahan Instan Fail Publikasi
        View->>System: Terjunkan Mandat Kebutuhan Lenyapkan Keberadaan Arsip (Mode HTTP GET Action Delete)
        System->>DB: Cabut Lembar Koordinat Relasional Dokumen Penampaknya
        
        alt Rantai Perampingan Dobel Mesin Host Database
            System->>Server: Libas Ganyang Ketersediaan Berkas Nyata Pada Rak Direktori (Amputasi Lewat Unlink)
            System->>DB: Hujam Ranjau Penghapus Status Identifikasi Arsip Dokumen (Skrip Eksekusi DELETE)
            DB-->>System: Pelaksanaan Penghapusan Tuntas Diakui Serangkaian Utuh
        end
        
        System-->>View: Kemudi Pentalan Kembali Rapi Menyuguhkan Papan Peringatan Rampung (Redirect Konfirmasi)
    end
```

## Sequence Diagram: Kelola Rencana Strategis (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Arsip Renstra"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Brankas Laporan Formal (Docs/Files)"
    participant DB as "Database (MySQL)"

    Admin->>View: Menelusuri Akses Antarmuka Utama (/admin/kelola_renstra)
    View->>DB: Eksekusi Bongkar Tuntutan Ketersediaan Histori Dokumen Kebijakan
    DB-->>View: Tabel Representasi Rencana Strategis Tersuguh 
    
    %% Proses Tambah / Format Unggahan Dokumen
    opt Pembuatan Rilis Salinan Panduan Strategi Anyar
        Admin->>View: Isi Borang Identitas Target Renstra, Penamaan, dan Pasak Lampiran PDF Pindaian Asli
        Admin->>View: Dorong Komitmen Terekam Rilis Keputusan ("Upload Dokumen")
        View->>System: Laju Penjemputan Parameter Ekspedisi Data Dirajut (Via Integrasi Transaksi HTTP POST)

        System->>System: Sisi Peladen Menyelidiki Standar Kualifikasi File Berdasar Konvensi Izin Kapasitas Memori
        
        alt Ekstensi File Berlaku Standar & Kapasitas Merunduk Sah
            opt Deteksi Ada Kiriman Tambahan Bongkah Eksemplar File Fresh
                System->>Server: Semayamkan Identitas Fisik Eksemplar Mulus ke Kolong Folder Publik Direktori
                opt Modus Perombakan Perincian Atribut Berkas (Revisi Dokumen)
                    System->>Server: Tumpas Dokumen Konvensi Riwayat Pendahulu Agar Bersih Sempurna (Cukur Unlink)
                end
            end
            
            System->>DB: Semburkan Injeksi Rantai Baris SQL (Eksekusi Kueri INSERT / UPDATE Pendaftaran Renstra)
            DB-->>System: Tangkap Pembuktian Modifikasi Restu Perubahan Tercatat Valid 
            System-->>View: Luncurkan Pentalan Resolusi Rute Bertabur Kesan Pesan Kedatangan Rilis Hijau Notifikasi 
        else Tumbukan Beban Tertahan Tolak Keamanan (Melompat Pagup Batasan Limit)
            System-->>View: Kembalikan Antrean Barisan Pengisian & Peringatkan Admin Mengenai Hambatan Kapasitas Server 
        end
    end

    %% Proses Pengguguran Rekam Jejak
    opt Penghapusan Renstra Tanpa Masa Ekstirpasi
        Admin->>View: Tetapkan Sentuhan Titah Mencabut Resolusi Berkas ("Hapus")
        View->>System: Angkut Pesan Delegasikan Letupan Eksekutorial Modus (Panggilan GET HTTP Aksi Hapus)
        System->>DB: Lacak Keberadaan Parameter Geometris File Pada Posisi Rak Gudang 
        
        alt Aksi Kolaborasi Hancur Ganda Berskenario Instan
            System->>Server: Musnahkan dan Kikis Total Selimut File Renstra dari Rak Sistem Internal (Operasi Mutlak Unlink)
            System->>DB: Eksekusi Bedil Letupan Penarikan Hak Identifikasi Lema Database Pangkalan (DELETE Kueri Binasakan)
            DB-->>System: Proses Mutilasi Penyirnakan Telah Paripurna Direspons
        end
        
        System-->>View: Giring Komandan Balik Bersamaan Pembersihan Tautan Melekatkan Kesempurnaan Garis Akhir Kemenangan 
    end
```

## Sequence Diagram: Kelola Standar Operasional Prosedur / SOP (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Antarmuka Modul Standar Operasional (SOP)"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Brankas Edaran Formal (Docs/PDF)"
    participant DB as "Database (MySQL)"

    Admin->>View: Menapak Penelusuran URL Prosedural SOP (/admin/kelola_sop)
    View->>DB: Kueri Inventarisasi Fail Dokumen Pendataan Pengaturan
    DB-->>View: Gelar Paparan Katalog Tabel Rekam Papan Aturan Terpusat
    
    %% Proses Tambah / Format Unggahan Dokumen
    opt Mewadahi Rilis Laporan Ketetapan Edaran SOP Resmi Akademis
        Admin->>View: Rincikan Parameter Penamaan SOP Penuh, Judul Pedoman, & Unggah Fail Fisik Format Murni (PDF/DOC)
        Admin->>View: Setujui Konfirmasi Pembaptisan Penambatan Hak Akses ("Unggah")
        View->>System: Kargo Titipan Serah-Rekam Dokumen Terekspedisi Lintasan Bebas (Penguncian Integrasi Rute HTTP POST)

        System->>System: Sinkronkan Toleransi Validasi Ketelitian Kesesuaian Batasan Ukuran Dokumen (Penakar Threshold Beban Sistem Server)
        
        alt Restu Ketentuan Ekstensi Fail Absolut Menyandang Identifikasi Standar Resmi Peladen
            opt Bilamana Hadir Tangkapan Sosok Eksistensial Rekaman Baru
                System->>Server: Rebahkan Segenap Ragam Dokumentasi Resmi Prosedur Aturan di Kolong Ruang Katalog Situs Fakultas 
                opt Manipulasi Mutasi Edit Lema (Revisi Pedoman SOP Hukum)
                    System->>Server: Kuras Eksistensi Rekam Arsip Silam Menjadi Tiada Rupa (Eksekusi Kinerja Unlink Lenyap)
                end
            end
            
            System->>DB: Lepaskan Tali Kueri (SQL INSERT / UPDATE) Demi Mencatat Transisi Pengunggahan Dokumen SOP
            DB-->>System: Mematri Bukti Keberlangsungan Transisi Pangkalan Data Tabel Valid
            System-->>View: Lintasan Kendali Dikendalikan Kembali Dihiasi Gemerlap Perasaan Lega (Pemantul Redirect Konfirmasi Menyempurnakan) 
        else Spesifikasi Fail Menyalahi Limit Ambang / Batasan Tipe Ekstensi File Dilanggar Keji
            System-->>View: Terbangkan Balik Kesibukan Pengurusan Perihal Error, Tolak Halus Pendudukan Resolusi Beban Pindaian
        end
    end

    %% Proses Hapus Rekan
    opt Pencabutan Mandat Pedoman Standar Operasi SOP Permanen 
        Admin->>View: Sentuhan Perintah Resolusi Pemusnahan Hak Rekam Sistem (Titah Aksi "Hapus")
        View->>System: Terbang Mengitari Pemancar Perintah Eliminasi Penayang Peran SOP Dokumen Eksisting (Titah Permintaan Singkat Berantai GET)
        System->>DB: Menyusur Titik Sandi Jejak Eksistensial Penempatan Alamat Lokasi Fisik Rujukan Arsip Tersemat 
        
        alt Jurus Penahanan Aset Disk Server Host Ruang Penyimpanan Relasional Sistem Server
            System->>Server: Penetrasi Akar Letak Dokumentasi Server (Penebasan Langsung Ekstraksi Akar Unlink Fisik Membasmi)
            System->>DB: Ledakkan Kueri Penyirnakan Tautan Rekaman Registrasi Berkas Resmi Aturan SOP Terpusat (Binasakan TBL Baris Lewat Skrip DELETE)
            DB-->>System: Absolut Persetujuan Amputasi Diserahkan Kembali
        end
        
        System-->>View: Perintah Sinyal Kelegaan Menghempas Papan Pelayar Administrator Sepenuhnya Memandu Arah Sempurna Kesuksesan (Terima Perubahan Akhir Visual Dashboard)
    end
```

## Sequence Diagram: Kelola Data BEM / Organisasi (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Organisasi BEM"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Brankas Visual Profil (Uploads)"
    participant DB as "Database (MySQL)"

    Admin->>View: Menapak Kunjungan URL Organisasi Kemahasiswaan (/admin/kelola_bem)
    View->>DB: Eksekusi Tuntutan Penelusuran Tabel Rekaman Organisasi
    DB-->>View: Sajikan Kompilasi Susunan Manajemen Berkas BEM
    
    %% Proses Tambah / Update Dokumentasi BEM
    opt Mengarsip Rilis Pengukuhan Profil Oraganisasi Anyar / Rekontruksi Data Eksisting
        Admin->>View: Pasak Borang Penamaan Teks Deskriptif Serta Pasang Resolusi Potret (Logo/Foto BEM)
        Admin->>View: Setujui Eksekusi Rilis Penilaian Pangkalan ("Simpan")
        View->>System: Kompilasi Ekspedisi Keorganisasian Lemparkan Diri (Sandiwara Kargo HTTP POST)

        System->>System: Ekskavasi Pendalaman Uji Muatan Maksimal Skala Resolusi Beserta Tipe Gambar Fisis
        
        alt Tes Parameter Ekstensi Fisis Dokumen Lulus (Tidak Kadaluwarsa Resolusi)
            opt Bilamana Hadir Tangkapan Sosok File Susupan Baru Mengisi Slot Lampiran
                System->>Server: Semayamkan Kehadiran Format Visual Baru pada Brankas Folder 
                opt Manipulasi Revisi Timpa Potret Dokumentasi Usang (Update Mode)
                    System->>Server: Musnahkan dan Bakar Visual Lampiran Berkas Sejarah Terdahulu (Operasikan Skrip Unlink Serang)
                end
            end
            
            System->>DB: Luncurkan Tali Panah Skema INSERT / UPDATE Tabel Relasi Oragnisasi
            DB-->>System: Labeli Integrasi Kemenangan Tersemat Nyata
            System-->>View: Kemudi Pentalan Kembali Utuh Berbalas Label Cemerlang Kemenangan (Redirect Berhasil) 
        else Dimensi Menahan Batas Kesempurnaan Hak Ukuran & Format Berkas Terlanggar
            System-->>View: Pelintir Balik Ke Laman Usulan & Hamparkan Notifikasi Kekerasan Resolusi Merah
        end
    end

    %% Proses Penghapusan Keanggotaan BEM Permanen
    opt Mendisiplinkan Pengecilan Registrasi Ormas (Hapuskan Berkas BEM)
        Admin->>View: Sentuh Aksi Penarikan Resolusi Pembatalan Jejak (Ikon Hapus)
        View->>System: Pancangkan Delegasi Tembakan Aksi GET Action Membasmi Total 
        System->>DB: Lacak Keberadaan Parameter Alamat Rujukan File Pada Bilik Relasional Tabel BEM Terkait
        
        alt Jurus Ganda Pembedahan Server Bebas Artefak
            System->>Server: Pangkas Habisan Selongsong Bentuk Jasmaniah Fotografi Ormas Pada Bingkai Folder (Pemusnahan via Unlink PHP)
            System->>DB: Eksekusi Suntikan Penghangusan Kueri Lema Tabel Pangkalan Identitas (Skrip Tembak Letupkan DELETE)
            DB-->>System: Akui Pernyataan Sinyal Tembakan Gugur Sudah Lunas Berjalan
        end
        
        System-->>View: Berlayar Kembali Menyusuri Antarmuka BEM Bebas Lema Menyuguhkan Rona Kebesaran Selesai Paripurna
    end
```

## Sequence Diagram: Verifikasi Pendaftaran (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator (Verifikator)
    participant View as "Halaman Pusat Seleksi Pendapatan/Validasi"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Brankas Keamanan Dokumen Diri (Uploads)"
    participant DB as "Database (MySQL)"

    Admin->>View: Menembus Masuk Pemantau Modul Administrasi Pendaftaran (/admin/kelola_pendaftaran)
    View->>DB: Rutinitas Pendobrakan Cek Ketersediaan Antrean Panjang Kalangan Pendaftar
    DB-->>View: Sajikan Kepastian Berupa Lembar Tabel Lema Calon Tersortir
    
    %% Proses Update Status Verifikasi Penerimaan
    opt Mengeksekusi Audit Pemeriksaan Detail Bukti Legalitas Pendaftaran
        Admin->>View: Perintahkan Sinkronisasi Detail (Ketuk Ikon Detail Calon)
        View->>DB: Raih Tuntutan Baris Status File Pendukung Tertempel (Rujukan Pindaian File KTP / Ijazah)
        DB-->>View: Kembalikan Sandi Jalur Repositorinya Sebagai Rupa Visual Muka Jendela (Popup Details)
        
        Admin->>View: Jatuhkan Keputusan Penetapan Hakim Aksi Penetapan (Tombol "Diterima / Ditolak")
        View->>System: Kargo Titipan Serah-Rekam Dokumen Keputusan Dikirimkan Rute Akses HTTP POST 
        System->>DB: Tancapkan Suntikan Kueri Pembaharuan (UPDATE pendaftaran SET Status='...')
        DB-->>System: Absolut Restu Keabsahan Laporan Status Memengaruhi Pangkalan Data Selesai Disetujui 
        
        System-->>View: Berlayar Kembali Menyusuri Rute Muat Ulang Pemantul Penyegaran Rilis Kategori Seleksi Terverifikasi Hijau Cemerlang Terkini
    end

    %% Proses Pembersihan Sisa Anantomi Calon Peserta Gugur/Spam
    opt Melikuidasi Pertimbangan Kepusnahan Memori Registrasi Batal Permanen
        Admin->>View: Setujui Konfirmasi Tombol Resolusi Penghapusan Calon Pendaftar Radikal
        View->>System: Merobek Garis Instruksi Pemusnahan Instan Delegasi Pelintasan Pemutusan Sinyal Binasakan Total (GET Action Delete)
        System->>DB: Selidiki Alamat Resolusi Perkara Bekas Bukti Titipan Fail Keberadaannya
        
        alt Jurus Penyisiran Menyeluruh Sapu Rata Mesin Tanpa Beban Host Disk
            System->>Server: Ganyang Potongan Lampiran Unggahan Kertas Persyaratan Diri Pada Jantung Peladen Langsung Hilangkan Secara Fisis (Mutilasi Unlink)
            System->>DB: Eksekusi Bedil Letupan Penarikan Hak Identifikasi Lema Registrasi Rekaman Pada Pangkalan Data Tabel Memori Utama (Amputasi Lewat Skrip DELETE)
            DB-->>System: Pelaksanaan Sempurna Menabuhkan Deklarasi Ganyang Pendaftar Ditiadakan 
        end
        
        System-->>View: Perintah Sinyal Kelegaan Menghempas Tampilan Pelayar Membawa Bendera Penghargaan Rona Kesuksesan Validasi Layak Tanpa Kutu Berlebih 
    end
```

## Sequence Diagram: Pengaturan Sistem (Admin Web FIKOM)
```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator (Pemegang Otoritas Utama Konfigurasi)
    participant View as "Antarmuka Modul Pengaturan Situs Inti"
    participant System as "Sistem/Controller Pengawal Batas (PHP)"
    participant Server as "Direktori Pelestarian Grafis Dasar Ekstensi Visual Web (Images/Assets)"
    participant DB as "Database Tersentralistik (MySQL)"

    Admin->>View: Mengorbitkan Layar Kendali Pangkalan Antarmuka Setelan Induk Konfigurasi Situs Penuai (/admin/kelola_pengaturan)
    View->>DB: Kueri Inventarisasi Sejarah Panjang Identitas Sentral Profil Inti Pendataan Web (Load Config Record)
    DB-->>View: Gelar Suguhan Etalase Indeks Seluruh Deretan Sel Teks Tersortir Identitas Portal Laman
    
    %% Proses Peremajaan Pemutakhiran Database Tunggal
    opt Meregistrasikan Rilis Peremajaan Penyesuaian Komposisi Atribut Modul Pengaturan Induk Aplikasi
        Admin->>View: Modifikasi Pengisian Bawaan Judul Web, Email Rujukan, Deskripsi Profil Singkat, & Susupkan Beban Gambar Lampiran Wujud (Logo Situs Baru/Favicon)
        Admin->>View: Tancapkan Eksekusi Menyerahkan Persetujuan Kepemilikan Putusan Pengikatan Pembaruan Aksi Terus Terang ("Simpan Konfigurasi")
        View->>System: Kargo Meluncur pada Rel Kecepatan Sinkron Sandiwara Ekspedisi Bertopeng Pengemasan (HTTP POST Transaksi Sentral)

        System->>System: Menakar Bobot Standar Kelegalan Toleransi Muatan Fisis Dimensi Gambar Sesuai Ketepatan Syarat (Filter Validation)
        
        alt Restu Filter Taraf Proporsional Melayang Sempurna Keadaan (Mulus Syarat Penuh)
            opt Bilamana Hadir Tangkapan Pelampiran File Sosok Sisipan Tipe Visual Berwujud (Identifikasi Logo Utama Anyar)
                System->>Server: Semayamkan Representasional Beban Baru Lampiran Eksemplar Masuk Pada Kolong Direktori Pusat (Setel Mengganti Replace Overwrite)
                System->>Server: Bersihkan Seluruh Ruang Residu Dokumen Bayangan Logo Silam Tak Bertuan Supaya Sirna Memori Disk (Singkirkan Menusuk Unlink Penghancur)
            end
            
            System->>DB: Lontarkan Perusak Entitas Tunggal Kueri (Injeksi UPDATE Tabel Parameter Setelan Sentralistik Inti Lema)
            DB-->>System: Labeli Kesepakatan Serah-Terima Kepustakaan Integrasi Rekam Identitas Mematuhi Pelaporan Rampung Sejati
            System-->>View: Pemantul Kilat Pentalan Kembali Rapi Ke Laman Utama Beriring Pelontaran Pengumuman Hijau Cemerlang Pembaruan
        else Spesifikasi Dimensi Atau Formatan Berkas Diintai Menyelinap Menantang Limitasi Resolusi Ambang Kepercayaan
            System-->>View: Pelintir Sisi Kendali Memutar Rute Kembali Menghantarkan Tangkisan Cacat Perihal Eror Pemberitahuan Ketidaksesuaian Visual Memerah 
        end
    end
```


