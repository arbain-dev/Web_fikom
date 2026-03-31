# Sequence Diagram: Kelola Mitra Kerjasama (Admin Web FIKOM)

Diagram sekuensial ini mengerucut pada alur komunikasi antarmuka sistem ketika administrator melakukan pengarsipan, perbaikan data, hingga pembatalan rekam jejak relasi institusional pada modul Kelola Mitra Kerjasama.

## Penjelasan Alur

Jalinan instansi dan rupa logo kemitraan yang silih berganti dipampang pada bentangan serambi utama website fakultas berhulu dari dalam laci modul manajemen admin ini. Begitu rute pengelola "Kelola Kerjasama" disentuh peramban, seruan tak kasat mata diutus dari peladen perantara (PHP) menuju jantung ruang tabel MySQL guna menyerok seluruh riwayat histori institusi relasi. Setibanya lembaran indeks mitra ini diantarkan kepada admin, mereka sewaktu-waktu dibebaskan mengendalikan instrumen tambah (*create*), tinjau mutasi spesifikasi (*update*), hingga likuidasi kontrak pajangan mitra (*delete*).

Skema penanaman institusi pionir bermula dari kewajiban entri deskriptif. Admin bakal memahat sederet tajuk pengenal mitra (misal: "Universitas X", "Industri Y"), menguraikan deskripsi payung ikatan kolaborasinya, seraya tak terlewat memautkan selembar file grafis visual (lazimnya berformat *PNG/JPG*) sebagai repereksentasi wajah jalinan tersebut (logo). Seusai administrator menyegel pengajuannya, kereta paket dokumen HTTP POST bermanuver melintasi penjagaan rute web. Filter keamanan lekas dipasang guna menakar batas ukuran bobot serta kelayakan ekstensi fail pelacak (*image validation*) agar terhindar dari kargo penyusup bawaan yang dapat melumpuhkan pangkalan sistem fakultas. Apabila rupa fail berhak divalidasi, lapis disk terhamparkan menjemput fail itu untuk dikekang ke ranah lokasi `uploads/kerjasama`. Sebagai bentuk persetujuan komplit, panah pangkalan data `INSERT/UPDATE` melesat memahat identitas mitra menyilang indeks wujud letak gambarnya. 

Pola putaran bedah aset dan pemusanahannya pun menganut rutinitas seragam yang lugas. Andai kelak logo mitra diubah (*update file*), prosedur pemotongan otomatis menyayat leher eksistensi fail fisik kuno agar luruh ke jurang ketiadaan komputasi (*unlink system function*). Pembasmian hingga pucuk akar itu direplikasi tanpa tolerir setiap kali eksekutor penghapus menekan panel 'Hapus' pada daftar pajang. Bersandarkan utusan pemicu rute mematikan berlapis `HTTP GET`, gerbong mesin *server* sekonyong-konyong akan menyemburkan racun ke dua titik: luruh memusnahkan potret fisis logo dari bingkai *folder*, selaras mencerabut riwayat kemitraan dari lumbung rujukan pangkalan data selamanya. Prosesi perampingan aset ini digenapi dengan pelemparan paksa kembali laman tersebut (*redirect*) yang langsung terias senyuman sapaan kotak peringatan notifikasi penyelesaian eksekusi warna cemerlang.

## Diagram

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
