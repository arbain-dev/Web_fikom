# Activity Diagram & Penjelasan - Admin Web FIKOM

Dokumen ini berisi **Activity Diagram** secara detail untuk setiap modul pengelolaan data di halaman Administrator, dilengkapi dengan penjelasan alur sistem.

---

## 1. Login Admin

Proses autentikasi administrator untuk masuk ke dalam sistem.

```mermaid
activityDiagram
    start
    :Buka Halaman Login;
    :Input Username & Password;
    :Klik Tombol Login;
    if (Username Ada?) then (TIDAK)
        :Sistem Menampilkan Pesan Error
        "Username tidak ditemukan";
        stop
    else (YA)
        if (Password Cocok?) then (TIDAK)
             :Sistem Menampilkan Pesan Error
             "Password salah";
             stop
        else (YA)
            :Sistem Membuat Session Admin;
            :Redirect ke Dashboard;
            stop
        endif
    endif
```

**Penjelasan:**
1.  Admin mengakses halaman login.
2.  Sistem menerima input username dan password.
3.  Sistem mengecek ketersediaan username di database.
4.  Jika username ada, sistem memverifikasi kesesuaian password (hashed).
5.  Jika valid, session `admin_logged_in` dibuat dan admin diarahkan ke Dashboard.

---

## 2. Kelola Data Dosen

Modul untuk manajemen data dosen tetap/tidak tetap, termasuk upload foto profil.

```mermaid
activityDiagram
    start
    :Buka Menu "Kelola Dosen";
    :Sistem Menampilkan Daftar Dosen;
    fork
        :Klik "Tambah Dosen";
        :Isi Form (NIDN, Nama, Prodi, Foto);
        :Klik Simpan;
        if (Foto Valid?) then (YA)
            :Upload Foto ke Server;
            :Simpan Data ke Database;
            :Tampilkan Pesan Sukses;
        else (TIDAK)
            :Tampilkan Error Validasi;
        endif
    fork again
        :Klik "Edit" pada Data Dosen;
        :Ubah Data (Jabatan, Pendidikan, dll);
        if (Ganti Foto?) then (YA)
            :Upload Foto Baru;
            :Hapus Foto Lama;
        endif
        :Update Database;
        :Tampilkan Pesan Sukses;
    fork again
        :Klik "Hapus";
        :Konfirmasi Penghapusan;
        if (Ya) then (YES)
            :Hapus Foto dari Server;
            :Hapus Data dari Database;
        endif
    end fork
    stop
```

**Penjelasan:**
*   **Tambah**: Admin menginput NIDN, Nama, Prodi, Jabatan, dan upload Foto. Sistem memvalidasi ekstensi foto (JPG/PNG).
*   **Edit**: Admin dapat mengubah data. Jika foto baru diupload, foto lama dihapus secara otomatis.
*   **Hapus**: Menghapus baris data di database sekaligus file fisik foto di folder `uploads/dosen/`.

---

## 3. Kelola Berita

Modul untuk mempublikasikan berita, pengumuman, atau artikel kegiatan kampus.

```mermaid
activityDiagram
    start
    :Buka Menu "Kelola Berita";
    :Tampil Tabel Berita;
    if (Aksi Admin?) then (TAMBAH)
        :Klik "Tambah Berita";
        :Isi Judul, Kategori, Konten, Foto;
        :Simpan;
        :Sistem Upload Foto & Insert Data;
    else (EDIT)
        :Pilih Berita -> Klik Edit;
        :Update Konten / Ganti Foto;
        :Simpan Perubahan;
    else (HAPUS)
        :Pilih Berita -> Klik Hapus;
        :Konfirmasi;
        :Hapus Data & Foto;
    endif
    :Refresh Tabel Data;
    stop
```

**Penjelasan:**
*   Admin wajib mengisi Judul, Kategori, dan Tanggal Publish.
*   Konten berita dapat berupa teks panjang.
*   Foto yang diupload akan menjadi *thumbnail* berita di halaman depan.

---

## 4. Kelola Pendaftaran Mahasiswa

Modul untuk memverifikasi data calon mahasiswa yang mendaftar secara online.

```mermaid
activityDiagram
    start
    :Buka Menu "Pendaftaran";
    :Sistem Menampilkan List Pendaftar Masuk;
    :Pilih Salah Satu Pendaftar;
    fork
        :Klik "Lihat Detail";
        :Sistem Menampilkan Biodata Lengkap
        (Data Diri, Sekolah, Nilai);
    fork again
        :Ubah Status Pendaftaran;
        note right
          Pilihan: Pending, Diterima, Ditolak
        end note
        :Sistem Mengupdate Status di Database;
        :Warna Status Berubah di Tabel;
    fork again
        :Hapus Data Pendaftar;
        :Sistem Menghapus File KTP & Ijazah;
        :Hapus Record Database;
    end fork
    stop
```

**Penjelasan:**
*   Admin **tidak menginput** data, melainkan **memproses** data yang masuk dari form pendaftaran publik.
*   Fokus utama aktivitas adalah **Verifikasi** (Melihat Bukti Nilai/Ijazah) dan **Update Status** (Diterima/Ditolak).

---

## 5. Kelola Kerjasama (Partner)

Modul untuk menampilkan logo instansi yang bekerja sama dengan fakultas.

```mermaid
activityDiagram
    start
    :Buka Menu "Kerjasama";
    :Klik "Tambah Partner";
    :Input Nama Instansi & Link Website;
    :Input Bulan & Tahun Kerjasama;
    :Upload Logo Instansi;
    if (Format Logo Valid?) then (YA)
        :Upload File ke `uploads/kerjasama`;
        :Simpan Data;
        :Tampilkan Pesan Sukses;
    else (TIDAK)
        :Tampilkan Error;
    endif
    stop
```

**Penjelasan:**
*   Digunakan untuk menampilkan logo mitra di footer atau halaman kerjasama.
*   Validasi file gambar sangat penting agar tampilan logo rapi.

---

## 6. Kelola Visi, Misi, & Tujuan

Modul *Multi-Section* yang mengelola beberapa jenis data dalam satu halaman.

```mermaid
activityDiagram
    start
    :Buka Halaman "Visi Misi";
    partition "Kelola Visi" {
        :Edit Textarea Visi;
        :Klik Simpan Visi;
        :Update Tabel `visi_misi` (Kategori='Visi');
    }
    partition "Kelola Misi/Tujuan" {
        :Input Teks Misi & Nomor Urut;
        :Klik Tambah;
        :Insert ke Database;
    }
    partition "Hapus Item" {
        :Klik Ikon Hapus pada Item Misi/Tujuan;
        :Konfirmasi;
        :Delete Item dari Database;
    }
    stop
```

**Penjelasan:**
*   Halaman ini unik karena menggabungkan form update tunggal (untuk Visi) dan list CRUD (untuk Misi/Tujuan) dalam satu tampilan.

---

## 7. Kelola Galeri & Slider (Media)

Modul sederhana untuk menampilkan gambar kegiatan atau banner utama.

```mermaid
activityDiagram
    start
    :Buka Menu Galeri / Slider;
    :Klik Tambah Gambar;
    :Isi Judul/Caption (Opsional);
    :Upload File Gambar;
    :Simpan;
    note right
      File masuk ke `uploads/galeri`
      atau `uploads/slider`
    end note
    :Data Muncul di Tabel;
    stop
```

**Penjelasan:**
*   Fokus pada manajemen aset visual.
*   Slider digunakan untuk *Hero Section* di beranda utama.
*   Galeri digunakan untuk halaman dokumentasi kegiatan.

---

## 8. Kelola Dokumen (SOP, Renstra, Kurikulum)

Modul untuk mengupload file PDF/Dokumen yang bisa didownload pengunjung.

```mermaid
activityDiagram
    start
    :Buka Menu Kelola Dokumen (SOP/Renstra);
    :Klik Tambah Dokumen;
    :Input Nama Dokumen;
    :Upload File (PDF/DOC);
    if (Ukuran File < 10MB?) then (YA)
        :Upload Sukses;
        :Simpan Info File ke Database;
    else (TIDAK)
        :Tolak Upload (File Terlalu Besar);
    endif
    stop
```

**Penjelasan:**
*   Mengelola file-file akademik seperti Standar Operasional Prosedur (SOP), Rencana Strategis (Renstra), dan Kurikulum.
*   File yang diupload bisa didownload oleh publik di menu "Penjaminan Mutu" atau "Akademik".
