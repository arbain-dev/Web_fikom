# Sequence Diagram - Admin Web FIKOM

Dokumentasi *Sequence Diagram* (diagram sekuensial) ini disusun untuk memberikan representasi visual yang komprehensif mengenai alur komunikasi dan interaksi antar entitas di dalam sistem panel administrator Web Fakultas Ilmu Komputer (FIKOM). Diagram ini secara spesifik menitikberatkan pada kronologi waktu dan urutan proses pengiriman pesan (*messages*) sejak administrator web menginisiasi sebuah aksi—seperti melakukan validasi '*login*', melangsungkan operasi penambahan, pembaharuan, hingga penghapusan *record* data inti (*master data*)—sampai dengan sistem memberikan respons akhir yang tepat. 

Pada skema-skema di bawah ini, proses logika internal berjalan konsisten antar subsistem; antarmuka dasbor akan secara rutin meneruskan format permintaan pos (*HTTP POST/GET Request*) dari admin ke ranah pemroses *backend* PHP. Mekanisme fungsional lalu mencocokkan kredensial sesi yang tengah aktif, mengamankan gerbang data, mengelola unggahan berkas ke peladen fisik, serta menjalin konektivitas ke *database* MySQL guna merekam jejak operasi basis data CRUD dengan tingkat presisi yang tinggi. Pada akhirnya, respons keberhasilan transaksi maupun lemparan galat operasional ditautkan kembali ke antarmuka untuk mencerminkan pangkalan data web secara utuh dan terjamin. Oleh karena itu, skema yang dirangkum menjadi satu dokumen sentral ini dibagi melintasi berbagai modul menurut pola arsitekturnya.

> **Catatan:** Diagram menggunakan format ekspresi **Mermaid Sequence Diagram**.

---

## 1. Autentikasi Admin

Meliputi: `login.php`, `logout.php`, `forgot_password.php`, `reset_password.php`.

### A. Login Admin

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant View as "Halaman Login"
    participant System as "Sistem (PHP)"
    participant DB as "Database (MySQL)"

    Admin->>View: Akses URL /admin/login
    View-->>Admin: Tampilkan Form Login
    
    Admin->>View: Input Username & Password
    Admin->>View: Klik Tombol Login
    View->>System: Kirim Data (POST)

    System->>DB: Query Cek Username (users)
    DB-->>System: Return Data User

    alt Username Ditemukan
        System->>System: Verifikasi Password (password_verify)
        alt Password Valid
            System->>System: Set Session $_SESSION['admin_logged_in']
            System-->>Admin: Redirect ke Dashboard
        else Password Salah
            System-->>View: Tampilkan Pesan Error
        end
    else Username Tidak Ditemukan
        System-->>View: Tampilkan Pesan Error
    end
```

### B. Lupa Password

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant View as "Halaman Forgot Password"
    participant System as "Sistem (PHP)"
    participant DB as "Database (MySQL)"

    Admin->>View: Input Username/Email
    Admin->>View: Klik Verifikasi
    View->>System: POST Identifier

    System->>DB: Cek User by Username/Email
    DB-->>System: Return User Data

    alt User Ditemukan
        System->>System: Set Session Reset (Allow Reset)
        System-->>Admin: Redirect ke Halaman Reset Password
    else User Tidak Ditemukan
        System-->>View: Tampilkan Pesan Error
    end
```

---

## 2. Dashboard & Profil

Meliputi: `dashboard.php`, `profile.php`.

### A. Dashboard (Load Statistik)

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant View as "Dashboard"
    participant System as "Sistem (PHP)"
    participant DB as "Database (MySQL)"

    Admin->>View: Akses Halaman Dashboard
    View->>System: Request Data Statistik
    
    par Load Counts
        System->>DB: Count Total Dosen
        System->>DB: Count Total Berita
        System->>DB: Count Total Penelitian & Pengabdian
        System->>DB: Count Total Ruangan & Lab
    and Load Recents
        System->>DB: Select 5 Berita Terbaru
        System->>DB: Select 5 Penelitian Terbaru
    end
    
    DB-->>System: Return Data
    System-->>View: Render Halaman Dashboard
```

### B. Edit Profil & Password

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant View as "Halaman Profil"
    participant System as "Sistem (PHP)"
    participant DB as "Database (MySQL)"

    alt Update Info (Username/Email)
        Admin->>View: Input Username/Email Baru
        View->>System: POST update_profile
        System->>DB: Cek Duplikasi Username/Email
        
        alt Tidak Ada Duplikasi
            System->>DB: UPDATE users SET ...
            DB-->>System: Success
            System-->>View: Tampilkan Pesan Sukses
        else Ada Duplikasi
            System-->>View: Tampilkan Error "Sudah Digunakan"
        end
        
    else Ganti Password
        Admin->>View: Input Pass Lama, Baru, Konfirmasi
        View->>System: POST change_password
        System->>DB: Ambil Password Hash Lama
        
        alt Password Lama Cocok
            System->>System: Hash Password Baru
            System->>DB: UPDATE users SET password=...
            System-->>View: Pesan Sukses
        else Password Lama Salah
            System-->>View: Pesan Error
        end
    end
```

---

## 3. Master Data (CRUD + Gambar)

Pola ini berlaku untuk file:
*   `kelola_berita.php`
*   `kelola_dosen.php`
*   `kelola_kerjasama.php`
*   `kelola_bem.php`
*   `kelola_kalender.php`

*   `kelola_slider.php`
*   `kelola_lab.php` (tambah/edit fasilitas)
*   `kelola_ruangan.php` (tambah/edit fasilitas)

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant View as "Halaman Kelola (Tabel)"
    participant System as "Sistem (PHP)"
    participant Server as "Storage (Uploads/)"
    participant DB as "Database (MySQL)"

    %% TAMBAH DATA
    opt Tambah Data
        Admin->>View: Klik Tambah -> Isi Form + Upload Foto
        View->>System: POST Action Check
        System->>System: Validasi Ekstensi Gambar
        
        alt Validasi OK
            System->>Server: move_uploaded_file()
            System->>DB: INSERT INTO tabel VALUES (...)
            System-->>View: Redirect Sukses
        else Validasi Gagal
            System-->>View: Tampilkan Error
        end
    end

    %% EDIT DATA
    opt Edit Data
        Admin->>View: Klik Edit -> Ubah Data
        View->>System: POST Action Check
        
        alt Upload Foto Baru?
            System->>Server: Upload Foto Baru
            System->>Server: Unlink Foto Lama
            System->>DB: UPDATE tabel SET data=..., foto=baru
        else Tidak Upload
            System->>DB: UPDATE tabel SET data=...
        end
        System-->>View: Redirect Sukses
    end

    %% HAPUS DATA
    opt Hapus Data
        Admin->>View: Klik Hapus -> Konfirmasi
        View->>System: GET ?action=delete&id=...
        System->>DB: SELECT foto FROM tabel WHERE id=...
        System->>Server: Unlink Foto (Hapus File)
        System->>DB: DELETE FROM tabel WHERE id=...
        System-->>View: Redirect Sukses
    end
```

---

## 4. Master Data (CRUD Dokumen)

Pola ini berlaku untuk file manajemen dokumen PDF/Doc:
*   `kelola_sop.php`
*   `kelola_renstra.php`
*   `kelola_renop.php`
*   `kelola_kurikulum.php`
*   `kelola_penelitian.php`
*   `kelola_pengabdian.php`

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant View as "Halaman Dokumen"
    participant System as "Sistem (PHP)"
    participant Server as "Storage (docs/)"
    participant DB as "Database (MySQL)"

    Admin->>View: Form Upload Dokumen (PDF/DOC)
    View->>System: POST Upload
    
    System->>System: Cek Ukuran & Tipe File (Max 10MB)
    
    alt File Valid
        System->>Server: Upload File
        System->>DB: INSERT data dokumen
        System-->>View: Pesan "Dokumen Berhasil Diupload"
    else File Invalid
        System-->>View: Pesan Error
    end

    opt Download / Hapus
        Admin->>View: Klik Link Download atau Hapus
        
        alt Hapus
            System->>Server: Hapus File Fisik
            System->>DB: DELETE record
        end
    end
```

---

## 5. Master Data Sederhana (Tanpa File)

Pola ini berlaku untuk file:
*   `kelola_fakta.php`

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant View as "Halaman Fakta"
    participant System as "Sistem (PHP)"
    participant DB as "Database (MySQL)"

    Admin->>View: Input Angka & Judul
    View->>System: POST Data
    
    System->>DB: INSERT / UPDATE tb_fakta
    DB-->>System: Success
    
    System-->>View: Reload Data Tabel
```

---

## 6. Single Page Update

Pola ini berlaku untuk halaman yang hanya mengelola SATU data statis:
*   `kelola_struktur.php` (Update Gambar Struktur)
*   `kelola_tentangfak.php` (Update Deskripsi/Sejarah)

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant View as "Halaman Statis"
    participant System as "Sistem (PHP)"
    participant Server as "Storage"
    participant DB as "Database (MySQL)"

    Admin->>View: Lihat Data Saat Ini
    Admin->>View: Edit Konten / Ganti Gambar
    View->>System: POST Update
    
    opt Ganti Gambar Struktur
        System->>Server: Replace File Lama
    end
    
    System->>DB: UPDATE halaman_statis SET kontent/gambar WHERE id=...
    System-->>View: Tampilkan Data Terupdate
```

---

## 7. Verifikasi Pendaftaran

Khusus file: `kelola_pendaftaran.php`

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant View as "List Pendaftaran"
    participant System as "Sistem (PHP)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka Detail Pendaftar
    View->>DB: Get Dat & File Pendukung (KTP/Ijazah)
    DB-->>View: Show Popup
    
    Admin->>View: Set Status (Diterima / Ditolak)
    View->>System: POST Update Status
    System->>DB: UPDATE pendaftaran SET status=...
    
    System-->>View: Refresh Status di Tabel
    
    opt Hapus Data
        Admin->>View: Hapus Pendaftar
        System->>System: Hapus File Uploads Pendaftar
        System->>DB: DELETE Record
    end
```

---

## 8. Multi-Section Management

Khusus file: `kelola_visimisi.php`

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant View as "Visi Misi Page"
    participant System as "Sistem (PHP)"
    participant DB as "Database (MySQL)"

    par Update Visi
        Admin->>View: Simpan Text Visi
        System->>DB: UPDATE visi_misi WHERE kategori='Visi'
    and Tambah Misi/Tujuan
        Admin->>View: Tambah Item Baru
        System->>DB: INSERT INTO visi_misi (kategori, konten)
    and Hapus Item
        Admin->>View: Hapus Item
        System->>DB: DELETE FROM visi_misi WHERE id=...
    end
    
    System-->>View: Reload Seluruh Halaman
```
