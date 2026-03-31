# Sequence Diagram: Kelola Data Pengabdian (Admin Web FIKOM)

Diagram sekuensial representatif ini membedah rancang arsitektur interaksi antarmuka administrasi di dalam peladen fakultas bilamana modul Pengabdian Kepada Masyarakat dikelolakan untuk sirkulasi pertukaran fail eksemplar laporannya (*PDF/DOCX*).

## Penjelasan Alur

Menyemai ladang rekaman histori civitas yang menjamah lapisan masyarakat merupakan urat nadi pengayom "Kelola Pengabdian". Secara teknikal, perwujudan diagram beralur (*sequence*) pada entitas operasi administrator ini berjalan setali tiga uang dengan sistem pustaka pengelolaan dokumen riset. Pada tahap persapaan pertama peladen, rute panggil bakal membongkar secara acak lalu merangkum baris rekam catatan pengabdian bermutu di pangkalan data yang memuat tak hanya entri tajuk pelaksanaan maupun pengurusnya, namun merangkum jejak tuju simpanan (*storage path*) salinan lampiran bukti sahnya pada sistem (layaknya dokumen PDF/DOC).

Fase menghembuskan nafas nyawa entitas pelaporan abdi masyarakt dikonstruksikan sedemikian rupa sewaktu admin merangkai ringkasan abstraksi berserta sisipan lampiran beban pindaian laporan di atas bidang pendaftaran isian. Komponen muatan ditenggelamkan menyusuri lalu-lintas ekspedisi permohonan siber `HTTP POST` tempat filter perisai pelindung beroperasi tangkas. Menyadari besarnya risiko penyerangan siber beralas arsip kotor, sistem mensyaratkan bobot file wajar seraya menghalang paksa segala jenis formatan ekstensil liar, semata meloloskan *MIME Type DOC* dan sejenisnya. Lolosnya kargo dokumen di muka gerbang penyaringan ini spontan menstimulus pemindah fail ke rahim penyimpanan publik *folder system*/lokasi khusus pendata. Tidak berlalu lama, titah pangkalan logik peladen beralih membaptis sandi tajuk isian ringkasan terintegrasikan bersama alamat sandi fail orisinil menuju laci *database* MySQL.

Perspektif keluwesan (*control flexibility*) pun dijahitkan apik saat admin memerintahkan titah pemusnahan rute (*action delete*) terhadap riwayat lapuk tanpa masa berlaku. Momen eksekutor mendelegasikan perintah pencabutan seketika dikanalisasi pangkalan *server backend* demi memecah skrip tugas menyasar dua sasaran beda: peladen mengkalkulasi koordinat lokasi naskah pengabdian kuno di rongga gudang sistem agar segera dibinasakan wujud *byte* failnya tanpa kompromi (*unlink manipulation*), kemudian menginstruksikan peladen penampung *database* mencoret habis baris keberadaannya. Kesisteman serba selaras dan brutal ini menggaransi kelestarian bobot *memory disk space host* peladen tetap lengang. Siklus serajin perampingan komputasi ini dengan rutin melingsirkan admin menatap layar segar paripurna berisi letupan notifikasi lunas sebagai perwujudan kepastian fungsional kerjanya yang terselesaikan absolut mumpuni.

## Diagram

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Laporan Data Pengabdian"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Lumbung Pelestarian Arsip Dokumen Formal"
    participant DB as "Database (MySQL)"

    Admin->>View: Titipkan Langkah Kunjungan Antarmuka (/admin/kelola_pengabdian)
    View->>DB: Rutinitas Membedah Inventarisasi Sejarah Panjang Dokumentasi Terdata PKM
    DB-->>View: Gelar Suguhan Etalase Indeks Tabel Perjalanan Pengabdian 
    
    %% Proses Tambah / Format Unggahan Dokumen
    opt Mewadahi Rilis Laporan Baru & Menjejalkan Berkas Dokumentasi Praktik Lapangan
        Admin->>View: Rincikan Parameter Tajuk Abstrak, Serta Selipkan Pindaian Murni Format Paten (PDF/DOC)
        Admin->>View: Anggukkan Persetujuan Penyerahan Serah-Rekam "Upload Tuntas"
        View->>System: Kargo Titipan Laporan Mengorbit via Jembatan HTTP POST

        System->>System: Terjunkan Jembatan Penilaian Skala Batas Resolusi Beban & Izin Perlintasan Hak Ekstensi Berkas
        
        alt Verifikasi Toleransi Ekstensi Batas File Berjabat Tangan Mulus
            opt Singkap Kehadiran Pertukaran/Sumbangan Beban Berkas File Laporan Segar
                System->>Server: Rebahkan Sosok Fisik Dokumen Masuk Tepat ke Gudang Kepustakaan Publik Peladen 
                opt Manipulasi Mutasi Edit Timpa Lembaran Lawas
                    System->>Server: Berangus Memori Presensi Naskah Aturan Silam Agar Sirna (Instruksi Bedah Unlink)
                end
            end
            
            System->>DB: Panah Langsung Tembus Memahat Skema Tabel SQL (Kueri INSERT / UPDATE Data Sosok Pengabdi)
            DB-->>System: Nyatakan Penerimaan Pembaruan Bukti Telah Diakui Mesin Abstrak
            System-->>View: Tendang Ulang Kemudi Arah Bersatu Gelembung Riang Sukses Perihal Resolusi Transaksi 
        else Dimensi atau Spesifikasi Fail Liar Diblokir Melampaui Syarat Ketetapan Tipe
            System-->>View: Lontarkan Tetesan Pesan Penolakan Berbalut Ketegasan Keamanan Laman
        end
    end

    %% Proses Hapus Rekan
    opt Pembersihan Status Penyelenggaraan Lapuk (Cabut Daftar Arsip)
        Admin->>View: Lontarkan Perintah Cabut Registrasi Laporan Abdi Permanen (Titah Hapus)
        View->>System: Kirim Keputusan Final Permintaan Ekstirpasi Berjejak HTTP GET (Action Delete)
        System->>DB: Intai Presisi Kumpulan Koordinat Relasi File Salinan Fisik Milik Entitas Sasaran
        
        alt Kombinasi Pukulan Serang Habis Aset Jejak Disk Memori Host Server
            System->>Server: Mutilasi Deteksi Sisi Sisa Kehidupan Kehadiran File Di Lapis Gudang Arsip Peladen (Unlink Sistem)
            System->>DB: Lumat Tubuh Susunan Identifikasi Dokumen Lewat Tembakan Eksekutor Database MySQL (DELETE Query)
            DB-->>System: Pelunasan Kesepakatan Lapor Gugur Memori Tersertifikasi Absolut
        end
        
        System-->>View: Singkap Pentalan Resolusi Pemutar Tampilan (Redirect Beriring Indikator Hijau Menyenangkan Hati)
    end
```
