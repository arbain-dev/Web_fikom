# Activity Diagram Admin - Web FIKOM

Dokumen ini berisi **Activity Diagram** untuk seluruh proses pengelolaan data di Administrator Web FIKOM. Mengingat banyaknya modul yang memiliki logika serupa (CRUD), diagram dikelompokkan berdasarkan **Pola Logika** masing-masing fitur.

---

## 1. Autentikasi Admin

### A. Login
Proses masuk ke sistem admin.

```mermaid
activityDiagram
    start
    :Buka Halaman Login;
    :Input Username & Password;
    :Klik Login;
    if (Username Valid?) then (TIDAK)
        :Tampilkan "Username tidak ditemukan";
        stop
    else (YA)
        if (Password Valid?) then (TIDAK)
             :Tampilkan "Password salah";
             stop
        else (YA)
            :Set Session Admin;
            :Redirect ke Dashboard;
            stop
        endif
    endif
```

### B. Logout
Proses keluar dari sistem.

```mermaid
activityDiagram
    start
    :Klik Tombol Logout;
    :Hapus Session;
    :Redirect ke Login Page;
    stop
```

---

## 2. Pola "Standard CRUD" (Create, Read, Update, Delete)

**Berlaku untuk Modul:**
*   **Kelola Berita** (`kelola_berita.php`)
*   **Kelola Dosen** (`kelola_dosen.php`) - *Ada Upload Foto*
*   **Kelola Kerjasama** (`kelola_kerjasama.php`) - *Ada Upload Logo*
*   **Kelola Galeri** (`kelola_galeri.php`)
*   **Kelola Slider** (`kelola_slider.php`)
*   **Kelola SOP/Dokumen** (`kelola_sop.php`, `kelola_renstra.php`, `kelola_renop.php`, `kelola_kurikulum.php`, `kelola_fakta.php`, `kelola_lab.php`, `kelola_ruangan.php`, `kelola_penelitian.php`, `kelola_pengabdian.php`)

### A. Alur Tambah Data (Create)
```mermaid
activityDiagram
    start
    :Buka Halaman Kelola [Modul];
    :Klik Tombol "Tambah Data";
    :Isi Form Input;
    note right
      (Nama, Deskripsi, Tanggal, dll)
    end note
    if (Ada Upload File/Foto?) then (YA)
        :Pilih File dari Komputer;
        :Validasi Ekstensi & Ukuran;
        if (File Valid?) then (TIDAK)
            :Tampilkan Error File;
            stop
        else (YA)
            :Upload File ke Server;
        endif
    endif
    :Simpan ke Database (INSERT);
    :Tampilkan Pesan Sukses;
    stop
```

### B. Alur Edit & Hapus (Update & Delete)
```mermaid
activityDiagram
    start
    :Admin melihat Tabel Data;
    fork
        :Klik Tombol **Edit**;
        :Form terisi data lama;
        :Ubah Data;
        if (Upload File Baru?) then (YA)
            :Upload File Baru;
            :Hapus File Lama dari Server;
        else (TIDAK)
            :Pertahankan File Lama;
        endif
        :Update Database (UPDATE);
        :Tampilkan Pesan Sukses;
    fork again
        :Klik Tombol **Hapus**;
        :Konfirmasi "Yakin Hapus?";
        if (Ya) then (YES)
            :Cek File di Server;
            if (Ada File?) then (YA)
                :Hapus File Fisik;
            endif
            :Hapus Data Database (DELETE);
            :Tampilkan Pesan Sukses;
        else (NO)
            :Batal;
        endif
    end fork
    stop
```

---

## 3. Pola "Verifikasi & Status" (List Only)

**Berlaku untuk Modul:**
*   **Kelola Pendaftaran** (`kelola_pendaftaran.php`)

Modul ini tidak menambahkan data secara manual, melainkan menerima data dari form pendaftaran user (Mahasiswa). Admin hanya mengubah status atau menghapus.

```mermaid
activityDiagram
    start
    :Buka Halaman Pendaftaran;
    :Lihat Tabel Pendaftar Masuk;
    fork
        :Klik **Lihat Detail**;
        :Muncul Popup Biodata Lengkap;
        :Admin Review Data;
    fork again
        :Ubah **Status**;
        note right
          Pending -> Diterima / Ditolak
        end note
        :Otomatis Update Database (Ajax/Form);
        :Warna Status Berubah;
    fork again
        :Klik **Hapus**;
        :Konfirmasi Hapus;
        if (Ya) then (YES)
            :Hapus File (KTP/Ijazah);
            :Hapus Data Pendaftar;
        endif
    end fork
    stop
```

---

## 4. Pola "Single Page Update" (Satu Data)

**Berlaku untuk Modul:**
*   **Kelola Struktur Organisasi** (`kelola_struktur.php`)
*   **Kelola Tentang Fakultas** (`kelola_tentangfak.php`)

Halaman ini hanya mengelola satu baris data (atau satu file) yang terus diperbarui.

```mermaid
activityDiagram
    start
    :Buka Halaman Kelola;
    :Sistem Load Data Saat Ini;
    :Admin Mengubah Konten / Upload Gambar Baru;
    :Klik Tombol **Simpan / Update**;
    :Update Database (UPDATE WHERE...);
    if (Ada Gambar Baru?) then (YA)
        :Hapus Gambar Lama;
        :Simpan Gambar Baru;
    endif
    :Reload Halaman dengan Data Baru;
    stop
```

---

## 5. Pola "Multi-Section Management"

**Berlaku untuk Modul:**
*   **Kelola Visi Misi** (`kelola_visimisi.php`)

Modul ini memiliki beberapa bagian dalam satu halaman (Visi [Single], Misi [List], Tujuan [List], Sasaran [List]).

```mermaid
activityDiagram
    start
    :Buka Halaman Visi Misi;
    fork
        :Edit **Visi** (Textarea);
        :Klik Simpan Visi;
        :Update Tabel Visi;
    fork again
        :Tambah **Misi/Tujuan/Sasaran**;
        :Isi Text & Urutan;
        :Klik Tambah;
        :Insert ke Database;
    fork again
        :Hapus **Misi/Tujuan/Sasaran**;
        :Klik Tombol Hapus di Tabel;
        :Delete dari Database;
    end fork
    :Tampilkan Notifikasi Sukses;
    stop
```

---
**Catatan:**
Diagram ini mencakup logika teknis dari seluruh file PHP di folder `/admin` proyek Web FIKOM. Pengecekan sesi (`session_start` dan `!isset($_SESSION)`) dilakukan di awal setiap proses (Start Node).
