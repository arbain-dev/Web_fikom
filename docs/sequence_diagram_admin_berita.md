# Sequence Diagram: Kelola Berita (Admin Web FIKOM)

Diagram sekuensial ini menjelaskan langkah-langkah yang terjadi pada sistem ketika Admin mengelola data berita (menambah, mengubah, atau menghapus berita).

## Penjelasan Alur

Berikut adalah urutan proses yang terjadi ketika admin berinteraksi dengan halaman Kelola Berita:

1. **Melihat Daftar Berita**: 
   Saat admin membuka menu "Kelola Berita", sistem akan langsung mengambil semua data berita yang tersimpan di dalam *Database* (MySQL) dan menampilkannya ke layar dalam bentuk tabel.

2. **Proses Tambah / Edit Berita**: 
   - Ketika admin menekan tombol **Tambah** atau **Edit**, formulir isian akan muncul. Admin memasukkan Judul, Isi Berita, dan mengunggah Foto Sampul (*Cover*).
   - Setelah admin menekan tombol **Simpan**, data tersebut dikirimkan ke sistem (*Controller / PHP*).
   - Sistem akan mengecek apakah foto yang diunggah memiliki format yang benar (misalnya `.jpg` atau `.png`) dan ukurannya tidak terlalu besar.
   - Jika foto valid, sistem akan memindahkan file foto tersebut ke dalam folder penyimpanan server (`/uploads`).
   - Khusus untuk proses **Edit**, sistem akan otomatis mencari file foto berita yang lama di dalam server dan menghapusnya agar memori tidak penuh.
   - Setelah foto tersimpan, judul dan isi berita berserta nama file fotonya akan dimasukkan dan dirangkum secara permanen ke dalam *Database*.
   - Terakhir, sistem akan mengembalikan (*redirect*) tampilan layar ke tabel berita dengan memunculkan pesan pop-up sukses.

3. **Proses Hapus Berita**:
   - Jika admin menekan tombol **Hapus** pada salah satu berita, sistem akan mencari tahu letak penyimpanan file foto sampul berita tersebut.
   - Sistem segera menghapus file fisik foto tersebut secara langsung dari folder server.
   - Setelah fotonya lenyap, sistem lalu menghapus baris tulisan beritanya dari *Database*.
   - Tampilan akan ditutup dengan kembalinya admin ke layar tabel berita yang membawa pesan konfirmasi bahwa data sudah musnah.

## Diagram

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
