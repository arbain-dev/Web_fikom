# Sequence Diagram: Kelola Standar Operasional Prosedur / SOP (Admin Web FIKOM)

Diagram sekuensial ini dipersembahkan guna mendeskripsikan secara mendetail tata kelola mekanisme pengunggahan dokumen formal Standar Operasional Prosedur (SOP) di kanal pengurus aplikasi (administrator). 

## Penjelasan Alur

Menyemarakkan kesarjanaan struktural dan tata kelola berorientasi akuntabilitas fakultas disandarkan mutlak pada akses penyaluran pustaka SOP berkualitas di bilik khusus "Kelola SOP". Proses serba dinamis ini diembuskan kencang begitu modulnya terpanggil menyambar kueri permintaan daftar dokumen eksisting dari jajaran memori *database MySQL*. Dari pijakan penyampaian inilah administrator didapuk sebagai hulu pertanggungjawaban buat mengeksekusi pemasukan instrumen aturan termutakhir, mencadangkan lembar revisi di atas dokumen regulasi konvensional, maupun menebas riwayat fail yang sudah membusuk ditarik wewenangnya. 

Sebagai wujud sirkulasi transisi rilis formal, pencatatan berkas SOP selalu mengharuskan perwujudan deskripsi pedoman, dikalibrasikan bersama tempelan orisinalitas dalam balutan berkas *document-basis* (berformat murni PDF atau DOCX). Terbukanya pintu keran unggul serangkaian data tersebut difasilitasi penuh melintasi parameter sinyal sandi komputasional berbalut identitas logis `HTTP POST`. Lapis gerbang pelindung internal sistem (PHP basis) mencegat sejenak kedatangan tamu lampiran berkas guna menghunjam filter deteksi uji tipe *mime format* serta menyensor batas kewajarannya melampaui ukuran ruang toleransi beban peladen maksimal. Begitu pindaian berkas membuktikan kesucian spesifikasinya, perwujudan file itu lantas dibawa rebah menyatu ke dalam asuhan *directory space records*. Menandakan sah diterimanya pedoman struktural SOP ke hadapan warga kampus ini, untaian SQL relasional dirapal buat melabel identitas nama aturan serentak memasang posisi lokasi rujukan filenya (`peta penyimpanan URL`) seirama ke rongga gudang *MySQL*. 

Prinsip perampingan memori eklektif tak kunjung luput diperhitungkan saat tombol Pemusnahan/Aksi Hapus diaktivasi secara masif. Berbalut tembakan memori peretas (*HTTP GET Delete*), pos peladen mengartikulasikan manuver tembakan dwiganda mematikan: sasaran perdana diluncurkan langsung kepada akar serabut nama fail yang direngkuh, menjarah dan membedahnya hancur menyublim dalam ketiadaan memori disk (`using unlink procedure`); pelampiasan target penutupan dititahkan di atas jembatan MySQL menggunakan rentetan sabda perusak tatanan lema `DELETE FROM`. Perjuangan sengit algoritma penyirnakan dokumen kelasa pengikat hukum prosedural itu diakhiri meriah lewati pengembalian kilat peramban admin (*redirect to table list*) berselimut warna gembira keberhasilan tanpa secuilpun komplikasi tersisa. 

## Diagram

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Antarmuka Modul Standar Operasional (SOP)"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Brankas Edaran Formal (Docs/PDF)"
    participant DB as "Database (MySQL)"

    Admin->>View: Menapak Penelusuran URL Prosedural SOP (/admin/kelola_sop)
    View->>DB: Kueri Inventarisasi Fail Dokumen Pendataan Pengaturan
    DB-->>View: Gelar Paparan Katalog Tabel Rekam Papan Aturan Terpusat
    
    %% Proses Tambah / Format Unggahan Dokumen
    opt Mewadahi Rilis Laporan Ketetapan Edaran SOP Resmi Akademis
        Admin->>View: Rincikan Parameter Penamaan SOP Penuh, Judul Pedoman, & Unggah Fail Fisik Format Murni (PDF/DOC)
        Admin->>View: Setujui Konfirmasi Pembaptisan Penambatan Hak Akses ("Unggah")
        View->>System: Kargo Titipan Serah-Rekam Dokumen Terekspedisi Lintasan Bebas (Penguncian Integrasi Rute HTTP POST)

        System->>System: Sinkronkan Toleransi Validasi Ketelitian Kesesuaian Batasan Ukuran Dokumen (Penakar Threshold Beban Sistem Server)
        
        alt Restu Ketentuan Ekstensi Fail Absolut Menyandang Identifikasi Standar Resmi Peladen
            opt Bilamana Hadir Tangkapan Sosok Eksistensial Rekaman Baru
                System->>Server: Rebahkan Segenap Ragam Dokumentasi Resmi Prosedur Aturan di Kolong Ruang Katalog Situs Fakultas 
                opt Manipulasi Mutasi Edit Lema (Revisi Pedoman SOP Hukum)
                    System->>Server: Kuras Eksistensi Rekam Arsip Silam Menjadi Tiada Rupa (Eksekusi Kinerja Unlink Lenyap)
                end
            end
            
            System->>DB: Lepaskan Tali Kueri (SQL INSERT / UPDATE) Demi Mencatat Transisi Pengunggahan Dokumen SOP
            DB-->>System: Mematri Bukti Keberlangsungan Transisi Pangkalan Data Tabel Valid
            System-->>View: Lintasan Kendali Dikendalikan Kembali Dihiasi Gemerlap Perasaan Lega (Pemantul Redirect Konfirmasi Menyempurnakan) 
        else Spesifikasi Fail Menyalahi Limit Ambang / Batasan Tipe Ekstensi File Dilanggar Keji
            System-->>View: Terbangkan Balik Kesibukan Pengurusan Perihal Error, Tolak Halus Pendudukan Resolusi Beban Pindaian
        end
    end

    %% Proses Hapus Rekan
    opt Pencabutan Mandat Pedoman Standar Operasi SOP Permanen 
        Admin->>View: Sentuhan Perintah Resolusi Pemusnahan Hak Rekam Sistem (Titah Aksi "Hapus")
        View->>System: Terbang Mengitari Pemancar Perintah Eliminasi Penayang Peran SOP Dokumen Eksisting (Titah Permintaan Singkat Berantai GET)
        System->>DB: Menyusur Titik Sandi Jejak Eksistensial Penempatan Alamat Lokasi Fisik Rujukan Arsip Tersemat 
        
        alt Jurus Penahanan Aset Disk Server Host Ruang Penyimpanan Relasional Sistem Server
            System->>Server: Penetrasi Akar Letak Dokumentasi Server (Penebasan Langsung Ekstraksi Akar Unlink Fisik Membasmi)
            System->>DB: Ledakkan Kueri Penyirnakan Tautan Rekaman Registrasi Berkas Resmi Aturan SOP Terpusat (Binasakan TBL Baris Lewat Skrip DELETE)
            DB-->>System: Absolut Persetujuan Amputasi Diserahkan Kembali
        end
        
        System-->>View: Perintah Sinyal Kelegaan Menghempas Papan Pelayar Administrator Sepenuhnya Memandu Arah Sempurna Kesuksesan (Terima Perubahan Akhir Visual Dashboard)
    end
```
