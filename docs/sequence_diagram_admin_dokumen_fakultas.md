# Sequence Diagram: Kelola Dokumen Fakultas (Admin Web FIKOM)

Diagram sekuensial representatif berikut mendeskripsikan kerangka komputasional alur interaksi modul Kelola Dokumen Fakultas, tempat sirkulasi penarikan dan penempatan arsip legal publik berbasis berkas murni (*PDF / DOCX*) dikendalikan administrator.

## Penjelasan Alur

Di ruang pustaka digital "Kelola Dokumen Fakultas", skema eksekusi interaktif bermula tatkala skrip antarmuka menagih senarai deretan berkas pindaian publik. Penagih (*request handler*) menjangkau tabel pangkalan data (MySQL) sembari mengangkat ke permukaan indeks-indeks fail kebijakan formal, pedoman edukasi, maupun ragam edaran statis yang patut diketahui sivitas akademika. Perilaku operasional administrasi mencakup kuasa penuh menyebar berkas perdana (*Upload*), mendobrak masuk dengan dokumen perbaikan (*Update*), serta pelenyapan permanen lembar pedoman masa lalu (*Delete*).

Momen pendaftaran eksemplar arsip keilmuan yang baru diawali oleh pemasukan identitas judul dokumen berserta kelengkapan deskriptifnya. Beriringan, berkas lampiran asli direkatkan dalam wujud murni dokumen formal. Mengangkut muatan itu, perintah siber `HTTP POST payload` didaratkan ke pos keamanan skrip pemroses (PHP). Parameter keselamatan internal segera merentangkan tameng sensor tipe dokumen—hanya mensahihkan identitas format sah (berlaku batas rasional hingga 10MB per fail). Selama tidak meledakkan limit tersebut, peladen luluh merestui proses pindahan fail pindaian menuju palung peristirahatan direktori umum (`storage folders`). Kepindahan fail fisis itu seketika menstimulasi pemancangan perintah relasional untuk menandai tugu indeks pangkalan data (`SQL INSERT/UPDATE`); menautkan tautan lokasi dengan lema deskriptifnya agar siap diambil oleh penuai informasi publik.

Tak pelak, mekanisme penjagaan disk dari residu file usang wajib dikembangkan ketat lewat prosedur pembasmian (*deletion trigger*). Manakala insting administrator memutuskan penarikan status peredaran dari sebuah rilis dokumen, tombol `Hapus` dilabuhkan memanggil rute kiamat bersandi `HTTP GET Delete`. Peladen segera mengekstrak koordinat nama berkas, mengasah pisau memori bedah (*unlink operator*), dan menetak hilang fisik fail dari memori penyimpanan mesin penampung sistem tanpa celah toleransi. Titik klimaks ini dituntaskan persamaannya oleh semburan taktis eksekusi letup `DELETE FROM table`, membakar sisa coretan kenangan sejarah berkas terkait dari dalam jeroan MySQL. Kesigapan runtutan logis ini lalu melepaskan kendali balik layaknya sirkuit pental (*redirect*), menyodorkan antarmuka teriluminasi peringatan lunas pekerjaan secara damai kepada admin.

## Diagram

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
