# Sequence Diagram: Verifikasi Pendaftaran (Admin Web FIKOM)

Diagram sekuensial ini mendokumentasikan serangkaian pergerakan alur teknis admin dalam melayani proses autentikasi penyaringan atau peresmian status calon pendaftar via modul Pendaftaran.

## Penjelasan Alur

Terbit dan tenggelamnya alur pendaftaran sivitas akademika bertumpu seutuhnya pada kesigapan administrator dalam mengemudikan instrumen "Kelola Pendaftaran". Ciri esensial yang membedakan perhelatan komputasi pada modul ini dibandingkan modul pangkalan data lainnya adalah ketiadaan pengunggahan borang inisiasi mandiri (*create*) dari sisi admin. Fiturnya justru dikhususkan guna merespons pendaftar yang membanjiri antrean (antarmuka berawal memanen tabel data sivitas calom pendaftar beserta rujukan kepemilikan laci sertifikat kelengkapan/ijazah milik mereka dari bilik *database MySQL*). Berdasarkan rekrutan tabel calon sivitas inilah administrator memulai titah verifikator menatap layar kompilasinya.

Penelusuran administrasi pengabsahan dikerahkan sembari sistem mengangkat detil pendaftaran dan memicu skrip untuk menarik representasi bukti dokumen pendaftar secara langsung (menampilkan *image preview / pdf window* layaknya KTP atau Ijazah dari ruang server peramban `uploads`). Dengan melintangnya rupa perbandingan pendaftaran ini, administrator secara legal menobatkan keputusannya atas status validasi pendaftar—apakah ditahbiskan dengan ganjaran penolakan atau penerimaan mutlak (`Diterima/Ditolak`). Sehelai status putusan pembaruan meluncur berbalut kendaraan permohonan `HTTP POST Update Status`. Lapis basis data lekas mengartikannya dengan mereformasi rekor kueri pembaruan (`UPDATE pendaftaran SET status=...`), lalu melecut peramban buat meregangkan napas kembali memajang posisi tabel yang baru terpoles hasil validasinya tanpa kealpaan.

Skenario radikal tetap dimungkinkan manakala daftar riwayat registrasi telah sesak tak terbendung atau dianggap sekadar fail usil iseng. Kendali aksi saklar Hapus (*delete flow*) membukakan rute pelenyapan bersih permanen bagi tumpukan berkas yang menjamur. Sama brutalnya dengan metode lain, sinyal penghangusan menyeret mesin agar sigap membumihanguskan setiap sisa lampiran identitas foto/dokumen personal si pendaftar dari *directory memory server* (*mengais* `unlink` ekstirpasi), silih menyambung memberangus pendaftaran rekam jejak itu hingga tercabut tak bernisan dari liang baris sistem memori MySQL. Perombakan radikal ini segera digenapi pemantul rilis pemberitahuan (*redirect screen*), menjamin kejernihan halaman tersisa demi kenyamanan validasi penantian rilis berikutnya.

## Diagram

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
