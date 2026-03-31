# Sequence Diagram: Kelola Rencana Strategis (Admin Web FIKOM)

Diagram sekuensial ini memetakan garis interaksi antara administrator dan sistem khusus untuk penanganan modul Kelola Renstra (Rencana Strategis) dan pemetaan arah kebijakan dokumenter.

## Penjelasan Alur

Lapis tatanan Rencana Strategis (Renstra) fakultas dipilah dan direkam dengan presisi ke dalam etalase publik melalui kompartemen administrasi khusus "Kelola Renstra". Ketika modul dokumenter kepengurusan fakultas ini dipanggil dari tidur lelap pangkalan data, antarmuka segera melaporkan sajian indeks berkas pedoman Renstra tahun-tahun periode pengabdian akademis yang berhasil digali MySQL. Di papan pergerakan arus komputasi inilah administrator berkuasa menarik penambahan berkas baru (eksemplar resolusi rancangan baru di tahun ajaran berikutnya), memperbaiki cetakan revisi minor, atau melucuti eksistensi naskah kadaluwarsa. 

Setiap peluncuran rencana kemajuan periode yang mengudara senantiasa menaiki moda rute siber aman (`HTTP POST`). Sang administrator perlu menyematkan atribut perihal dokumen panduan strateginya dengan cermat, diikuti pendaratan salinan naskah asli PDF yang mengikat di dalam kolom panel pendaftar borang. Skrip penerjemah PHP lantas tidak serta merta membukakan brankas fasilitas *hosting*; muatan itu dihakimi demi kewajaran memori, lolosnya ekstensi tak diundang yang bisa berujung fatal, lalu menurunkannya mulus sesudah validasi tipe (*mime type*) terpenuhi. Ketika potret dokumen Renstra ini mendarat seutuhnya di pangkuan rak khusus direktori `/docs`, mesin peladen seketika meracik pelumas kueri basis data untuk merutekan (*insert relational query*) alamat tautan file tersebut bersanding erat ke lembar pendaftaran deskripsinya di relung tabel MySQL. 

Pemotongan wujud rilis tahunan pun menganut siklus bersih sempurna tanpa peninggalan artefak berkarat. Administrasi yang menginstruksikan pelemparan pembasmian (`action_delete` di pucuk URL `HTTP GET`), tidak hanya melepaskan letupan pemusnahan basis pengarsipan lajur (*table log data*). Melampaui hal tersebut, rute letusan menyelaraskan koordinat pembedah arsip server guna memberangus paksa eksistensi pindaian fail Renstra masa lampau (`unlink procedure`) menyatu binasa. Kesinambungan sirkulasi logis tersebut kemudian berbalik tenang menayangkan penyumbangan *redirect* menuju ruang indeks mutakhir seraya membawa konfirmasi visual perombakan pangkalan data berhasil terkonsolidasi rapi.

## Diagram

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Arsip Renstra"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Brankas Laporan Formal (Docs/Files)"
    participant DB as "Database (MySQL)"

    Admin->>View: Menelusuri Akses Antarmuka Utama (/admin/kelola_renstra)
    View->>DB: Eksekusi Bongkar Tuntutan Ketersediaan Histori Dokumen Kebijakan
    DB-->>View: Tabel Representasi Rencana Strategis Tersuguh 
    
    %% Proses Tambah / Format Unggahan Dokumen
    opt Pembuatan Rilis Salinan Panduan Strategi Anyar
        Admin->>View: Isi Borang Identitas Target Renstra, Penamaan, dan Pasak Lampiran PDF Pindaian Asli
        Admin->>View: Dorong Komitmen Terekam Rilis Keputusan ("Upload Dokumen")
        View->>System: Laju Penjemputan Parameter Ekspedisi Data Dirajut (Via Integrasi Transaksi HTTP POST)

        System->>System: Sisi Peladen Menyelidiki Standar Kualifikasi File Berdasar Konvensi Izin Kapasitas Memori
        
        alt Ekstensi File Berlaku Standar & Kapasitas Merunduk Sah
            opt Deteksi Ada Kiriman Tambahan Bongkah Eksemplar File Fresh
                System->>Server: Semayamkan Identitas Fisik Eksemplar Mulus ke Kolong Folder Publik Direktori
                opt Modus Perombakan Perincian Atribut Berkas (Revisi Dokumen)
                    System->>Server: Tumpas Dokumen Konvensi Riwayat Pendahulu Agar Bersih Sempurna (Cukur Unlink)
                end
            end
            
            System->>DB: Semburkan Injeksi Rantai Baris SQL (Eksekusi Kueri INSERT / UPDATE Pendaftaran Renstra)
            DB-->>System: Tangkap Pembuktian Modifikasi Restu Perubahan Tercatat Valid 
            System-->>View: Luncurkan Pentalan Resolusi Rute Bertabur Kesan Pesan Kedatangan Rilis Hijau Notifikasi 
        else Tumbukan Beban Tertahan Tolak Keamanan (Melompat Pagup Batasan Limit)
            System-->>View: Kembalikan Antrean Barisan Pengisian & Peringatkan Admin Mengenai Hambatan Kapasitas Server 
        end
    end

    %% Proses Pengguguran Rekam Jejak
    opt Penghapusan Renstra Tanpa Masa Ekstirpasi
        Admin->>View: Tetapkan Sentuhan Titah Mencabut Resolusi Berkas ("Hapus")
        View->>System: Angkut Pesan Delegasikan Letupan Eksekutorial Modus (Panggilan GET HTTP Aksi Hapus)
        System->>DB: Lacak Keberadaan Parameter Geometris File Pada Posisi Rak Gudang 
        
        alt Aksi Kolaborasi Hancur Ganda Berskenario Instan
            System->>Server: Musnahkan dan Kikis Total Selimut File Renstra dari Rak Sistem Internal (Operasi Mutlak Unlink)
            System->>DB: Eksekusi Bedil Letupan Penarikan Hak Identifikasi Lema Database Pangkalan (DELETE Kueri Binasakan)
            DB-->>System: Proses Mutilasi Penyirnakan Telah Paripurna Direspons
        end
        
        System-->>View: Giring Komandan Balik Bersamaan Pembersihan Tautan Melekatkan Kesempurnaan Garis Akhir Kemenangan 
    end
```
