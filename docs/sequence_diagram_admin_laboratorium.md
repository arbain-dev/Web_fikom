# Sequence Diagram: Kelola Fasilitas Laboratorium (Admin Web FIKOM)

Diagram sekuensial ini menjelaskan langkah-langkah praktis pada sistem ketika Admin mengelola data fasilitas laboratorium.

## Penjelasan Alur

Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Fasilitas Laboratorium:

1. **Melihat Daftar Data**:
   Saat admin membuka menu "Kelola Fasilitas Laboratorium", sistem akan langsung mengambil semua data yang tersimpan di *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Data**:
   - Ketika admin menekan tombol **Tambah** atau **Edit**, muncul formulir isian. Admin memasukkan Nama Lab, Daftar Inventaris Peralatan dan mengunggah Foto Laboratorium.
   - Setelah menekan tombol **Simpan**, data dikirimkan ke sistem pengendali (PHP).
   - Sistem akan mengecek apakah format file benar dan ukurannya tidak terlalu besar.
   - Jika valid, sistem menyimpan file fisik tersebut ke dalam folder penyimpanan server (`/uploads/laboratorium`).
   - Khusus untuk **Edit**, sistem akan mendeteksi keberadaan file lama milik data tersebut dan otomatis menghapusnya agar memori (*storage*) tidak penuh.
   - Setelah file tersimpan, sistem menyisipkan (menyimpan) rincian dari form teks admin beserta rujukan penamaan file tadi secara permanen ke dalam *Database*.
   - Terakhir, halaman memuat ulang (di-*refresh*) dan tabel tampil dengan memunculkan pesan Sukses kepada sang Admin.

3. **Proses Hapus Data**:
   - Jika tombol / ikon **Hapus** diklik pada salah satu baris, sistem akan mendedah referensi nama Foto Laboratorium yang dimilikinya.
   - Sistem lalu menghapus file fisik tersebut langsung dari folder server (`/uploads/laboratorium`).
   - Setelah fisik fail dihapus bersih, sistem menghapus seutuhnya jejak baris rekam data tersebut dari *Database*.
   - Tabel dimuat ulang tanpa memunculkan baris data yang dihapus tadi, disertai pesan notifikasi keberhasilan operasional.

## Diagram

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