# Sequence Diagram: Kelola Slider Beranda (Admin Web FIKOM)

Diagram sekuensial ini memvisualisasikan langkah-langkah praktis pada sistem ketika Admin mengelola data slider beranda.

## Penjelasan Alur

Proses dimulai ketika admin membuka menu Kelola Slider Beranda. Begitu halaman diakses, sistem secara otomatis menarik seluruh riwayat data slider yang tersimpan di dalam *Database* MySQL untuk langsung disajikan ke layar admin dalam wujud tabel yang rapi. Tampilan awal ini berfungsi sebagai pantauan sebelum admin memutuskan tindakan selanjutnya.

Apabila admin membutuhkan penambahan data baru atau perbaikan data lama, mereka dapat menekan tombol **Tambah** atau **Edit**. Tindakan ini akan memunculkan sebuah formulir tempat admin bisa mengetikkan kemasan visual Teks Judul Utama dan Subjudul Pendek serta melampirkan Foto Pemandangan Kampus (Slider). Usai admin menekan tombol **Simpan**, peramban akan memaketkan data-data tersebut dan mengirimkannya ke sistem pengendali (PHP). Secara sigap, sistem lalu memeriksa apakah ukuran file dan format ekstensinya memenuhi standar keamanan. Jika wujud berkas tersebut difilter valid, mesin akan seketika menyimpan fisik file tersebut di dalam keranjang penyimpanan server (`/uploads/slider`). Khusus pada skenario **Edit**, pangkalan sistem akan langsung memberangus file foto lawas bawaan data tersebut agar memori penyimpanan tidak terbebani. Tepat saat fisik berkas dikamarkan dengan aman, teks ketikan admin beserta rujukan penamaan file tadi akan dijahit secara permanen ke dalam *Database*. Pengguna lantas digiring kembali menatap tabel utama lewat muatan ulang halaman (*refresh*) disuguhi pemberitahuan berwarna penanda keberhasilan proses simpan.

Di sisi lain, mekanisme kebersihan lingkungan data dijaga dengan ketersediaan tombol **Hapus**. Bilamana admin memutus letikan ikon hapus pada salah satu baris, sistem segera memusatkan pelacakan ke arah rujukan fisik nama file tipipannya. Fail fisis tersebut dicongkel keluar dan dimusnahkan dari server (`/uploads/slider`). Setelah meyakini ketiadaan fail, rentetan aksi perusak di *Database* bergerak melenyapkan barisan rekaman jejak catatan itu seutuhnya. Rangkaian perampingan usai seturut kembalinya putaran rotasi layar antarmuka memaparkan tabel yang telah terbebas dari baris data buangan tersebut diiringi pesan konfirmasi sukses terhapusnya data.

## Diagram
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