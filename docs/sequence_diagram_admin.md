# Sequence Diagram - Admin Web FIKOM

Dokumen ini berisi **Sequence Diagram** yang menggambarkan interaksi antar objek (Admin, Antarmuka, Sistem/Server, dan Database) dalam sistem Web FIKOM.

> **Catatan:** Diagram menggunakan format **Mermaid Sequence Diagram**.

---

## 1. Login Admin

Proses admin masuk ke dalam sistem.

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

    System->>DB: Query Cek Username
    DB-->>System: Return Data User

    alt Username Ditemukan
        System->>System: Verifikasi Password (Hash)
        alt Password Valid
            System->>System: Buat Session Admin
            System-->>Admin: Redirect ke Dashboard
        else Password Salah
            System-->>View: Tampilkan Pesan "Password Salah"
        end
    else Username Tidak Ditemukan
        System-->>View: Tampilkan Pesan "Username Tidak Ditemukan"
    end
```

---

## 2. Kelola Data (CRUD)

Contoh representatif untuk modul: **Berita, Dosen, Kerjasama, Galeri**.

### A. Tambah Data (Create)

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant View as "Halaman Kelola"
    participant System as "Sistem (PHP)"
    participant Server as "File Server (Uploads)"
    participant DB as "Database (MySQL)"

    Admin->>View: Klik Tombol "Tambah Data"
    View-->>Admin: Tampilkan Modal/Form
    
    Admin->>View: Isi Form & Pilih File (Foto)
    Admin->>View: Klik "Simpan"
    View->>System: Kirim Data & File (POST)

    alt Validasi Sukses
        System->>Server: Upload File Fisik
        Server-->>System: Return Nama File Baru
        
        System->>DB: INSERT Data (+Nama File)
        DB-->>System: Return Success
        
        System-->>View: Redirect/Reload dengan Pesan Sukses
        View-->>Admin: Tampilkan Data Baru di Tabel
    else Validasi Gagal
        System-->>View: Tampilkan Pesan Error
    end
```

### B. Edit Data (Update)

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant View as "Halaman Kelola"
    participant System as "Sistem (PHP)"
    participant Server as "File Server (Uploads)"
    participant DB as "Database (MySQL)"

    Admin->>View: Klik Tombol "Edit"
    View-->>Admin: Tampilkan Modal dengan Data Lama
    
    Admin->>View: Ubah Data & Upload Foto Baru (Opsional)
    Admin->>View: Klik "Simpan Perubahan"
    View->>System: Kirim Data Update (POST)

    opt Ada File Baru
        System->>Server: Upload File Baru
        System->>Server: Hapus File Lama
    end

    System->>DB: UPDATE Data
    DB-->>System: Return Success
    
    System-->>View: Redirect/Reload
    View-->>Admin: Tampilkan Data Terupdate
```

### C. Hapus Data (Delete)

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant View as "Halaman Kelola"
    participant System as "Sistem (PHP)"
    participant Server as "File Server (Uploads)"
    participant DB as "Database (MySQL)"

    Admin->>View: Klik Tombol "Hapus"
    View-->>Admin: Tampilkan Konfirmasi (Alert)
    
    alt Konfirmasi YA
        Admin->>View: Klik YA
        View->>System: Request Hapus (GET/POST)
        
        System->>DB: SELECT File Lama
        DB-->>System: Return Nama File
        
        opt Ada File Fisik
            System->>Server: Unlink/Delete File
        end
        
        System->>DB: DELETE Data
        DB-->>System: Return Success
        
        System-->>View: Redirect/Reload
        View-->>Admin: Data Hilang dari Tabel
    else Konfirmasi TIDAK
        Admin->>View: Klik TIDAK
        View-->>Admin: Batal Hapus
    end
```

---

## 3. Verifikasi Pendaftaran

Khusus untuk modul **Kelola Pendaftaran Mahasiswa**.

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant View as "Halaman Pendaftaran"
    participant System as "Sistem (PHP)"
    participant DB as "Database (MySQL)"

    Admin->>View: Buka Menu Pendaftaran
    View->>DB: SELECT * FROM pendaftaran
    DB-->>View: Tampilkan List Pendaftar

    Admin->>View: Klik "Lihat Detail"
    View-->>Admin: Tampilkan Popup Biodata & Berkas
    
    Admin->>View: Ubah Status (Misal: "Diterima")
    View->>System: Kirim Update Status (POST)
    System->>DB: UPDATE pendaftaran SET status='Diterima'
    DB-->>System: Return Success
    
    System-->>View: Update Tampilan Status
    View-->>Admin: Status Berubah Hijau (Diterima)
```

---

## 4. Kelola Visi Misi (Multi-Section)

Khusus untuk modul yang memiliki beberapa bagian form dalam satu halaman.

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant View as "Halaman Visi Misi"
    participant System as "Sistem (PHP)"
    participant DB as "Database (MySQL)"

    loop Update Visi
        Admin->>View: Edit Text Visi
        Admin->>View: Klik "Simpan Visi"
        View->>System: POST (update_visi)
        System->>DB: UPDATE visi_misi SET konten=...
        System-->>View: Reload Page
    end

    loop Tambah Misi/Tujuan
        Admin->>View: Input Misi Baru
        Admin->>View: Klik "Tambah"
        View->>System: POST (tambah_misi)
        System->>DB: INSERT INTO visi_misi
        System-->>View: Reload Page (List Bertambah)
    end

    loop Hapus Item
        Admin->>View: Klik Ikon Hapus
        View->>System: GET (hapus_id)
        System->>DB: DELETE FROM visi_misi
        System-->>View: Reload Page (List Berkurang)
    end
```
