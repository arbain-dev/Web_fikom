# Sequence Diagram: Kelola Kurikulum (Admin Web FIKOM)

Diagram sekuensial ini memetakan persimpangan garis interaksi antara administrator dan sistem peladen web, khususnya dalam pengembanan beban modul Kelola Kurikulum yang menaungi pendistribusian dokumen pengajaran berformat murni (*PDF / DOCX*).

## Penjelasan Alur

Sejatinya lalu-lintas pengumpulan rekap basis kurikulum dalam peladen antarmuka administrator berbeda tajam dibandingkan dengan modul grafis gambar statis terdahulunya. Fitur mutakhir "Kelola Kurikulum" disangga atas rancang bangun *database* MySQL guna mengurusi pertukaran dokumen akademis resmi bermodel pindaian PDF sampai naskah kerja formatan DOC. Begitu melompati ambang beranda kurikulum, peramban melempar jangkar penarikan kueri mengais pangkalan data merangkum tumpukan fail dan tajuk rekaman pedoman tahun pengajaran saat ini, menyediakan administrator akses instan untuk melampirkan *file*, membubuhkan deskriptif naskah pedoman, sampai dengan membersihkan fail dari brankas web.

Tataran teknis bertambah pelik tiap kali sang juru pengawas (*operator web*) mendirikan ketetapan untuk mengatrol pindaian kurikuler (*Create Upload Document*). Lapis komunikasi mengirim wujud borang ke rel `HTTP POST` tempat skrip pengendali berspesifikasi PHP merapalnya dengan proteksi tingkat keamanan tertinggi (*Max File Limit 10 MB, strict extension MIME*). Bila resolusi ukuran fail PDF/DOC melampaui pagar pembatas peladen komputasi, ia lekas dimuntahkan balik menuju halaman asal sembari ditalikan tulisan insiden error peringatan batas volume berkas. Akan tetapi, kala beban lampiran berhasil dipanggul ringan dan diakui legal, skrip instruksional spontan mengatur jembatan ke laci rak *folder documents/docs* server memindah simpannya sebelum beranjak menjungkit rel relasional MySQL untuk dititipkan alamat letak repositorinya pada sekumpulan sel di lajur rujukan kurikulum (`INSERT/UPDATE file_url`). 

Alur sekuensial penarikan hak peredaran berkas kurikulum juga tercatat komprehensif. Demi mencegah berserakannya pecahan rekam dokumen siluman pada ruang muatan server fakultas yang berharga, instruksi pemicu tombol Hapus mengartikulasikan manuver tembakan langsung pada pengawas peladen (*delete handler*). Permohonan berkedok perintah parameter silang `HTTP GET` mengangkut identitas *file* berantai merobek ikatan memori disk `unlink()`. Tinta naskah pangkalan data membasmi jejak pencatatan baris namanya seturunnya. Rangkaian pergumulan komputasional perampingan itu otomatis terkunci tenang lewat sinyal putaran kemudi melingsirkan admin menuju tabel berkas termutakhir tanpa gores masalah sama sekali di layarnya. Dalam pada ini pula, para khalayak akademik disediakan fasilitas tombol ekstrak berkas kurikulum dari modul *database*.

## Diagram

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Arsip Kurikulum"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Dokumen Formal (Docs/Files)"
    participant DB as "Database (MySQL)"

    Admin->>View: Menapak Penelusuran URL Kurikuler (/admin/kelola_kurikulum)
    View->>DB: Kueri Inventarisasi Fail Dokumen Pendataan
    DB-->>View: Gelar Paparan Katalog Tabel Rekam Kurikulum
    
    %% Proses Tambah / Format Unggahan Dokumen
    opt Mengedarkan Berkas Dokumen Kurikulum Akademik Termutakhir
        Admin->>View: Masukkan Penamaan Kurikuler, Rangkuman, & Unggah Dokumen Asli (PDF/DOC)
        Admin->>View: Ketuk Validasi Penambatan ("Upload Dokumen")
        View->>System: Kapalkan Integrasi Rumpun Lampiran di Rute HTTP POST Berkerah Rahasia

        System->>System: Eksekusi Deteksi Keamanan Format PDF/DOCX (Max: 10MB Threshold)
        
        alt Ambang Rasional & Kelegalan Tipe Pindaian Valid
            opt Bila Terdapat Deteksi Penyusupan File Arsip Baru
                System->>Server: Inapkan Dokumen Legal Kurikulum Memasuki Laci Publik Repositori 
                opt Pengaduan Modifikasi Update (Menimpa Dokumen Induk Lawas)
                    System->>Server: Kikis Keberadaan Dokumen Peraturan Silam Tak Bertuan (Unlink)
                end
            end
            
            System->>DB: Tembuskan Lembaran Skema Sinkronisasi (INSERT/UPDATE TBL Kueri)
            DB-->>System: Nyatakan Pembaruan Basis Kepustakaan Web Mulus Disetujui
            System-->>View: Seret Balik Tampilan Layar Memakai Simbol Notifikasi Sukses Emas 
        else Tumpukan File Tersangkut Bobot Rakasa (Over-Sized/Invalid Type)
            System-->>View: Lontarkan Tetesan Pesan Penolakan ke Hadapan Mimbar Admin
        end
    end

    %% Proses Unduh (Download) & Hapus
    opt Manajemen Ekstraksi dan Pemusnahan Naskah Kurikulum
        Admin->>View: Seleksi Aksi Sentuh Pintu Lenyapan / Tautan "Hapus Dokumen"
        View->>System: Kargo Titipan Suruhan Pemusnahan Bertolak (HTTP GET Action Delete)
        System->>DB: Konfirmasi Tali Rujukan Titik Koordinat Naskah Formal File Eksisting
        
        alt Rantai Perampingan Disk Pemusnahan File
            System->>Server: Bedah Titik Akar Ruang Folder Dokumentasi (Amputasi via Unlink)
            System->>DB: Letupkan Ranjau Kueri Pemutihan Skema Lema Catatan (Skrip DELETE)
            DB-->>System: Tundukkan Pendaftaran Akhir Pemusnahan Telah Berlalu
        end
        
        System-->>View: Bentangkan Tirai Beranda Dihiasi Label Hijau Keberhasilan Pembersihan
    end
```
