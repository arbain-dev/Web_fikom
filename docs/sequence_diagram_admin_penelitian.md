# Sequence Diagram: Kelola Data Penelitian (Admin Web FIKOM)

Diagram sekuensial ini merunut alur operasional komprehensif bagi prosedur pengarsipan rilis jurnal dan berkas laporan (*Research & Publication*) di dalam wadah modul Kelola Penelitian administrator pangkalan web Fakultas Ilmu Komputer.

## Penjelasan Alur

Manajemen perpustakaan riset jurnal pendidik berdiri sebagai pilar pertinggal riwayat keilmuan yang secara teknis mengusung alih wahana operasional pertukaran rupa fail berekstensi pelestarian utuh semacam pindaian *Portable Document Format* (PDF) maupun teks kompilasi (*DOC/DOCX*). Siklus pergerakan dimulai sederhana layaknya beranda administrator lain: sebuah ketukan pemanggilan sistem langsung memicu rentetan pembedahan arsip *database* demi menuai serapan tajuk, tanggal publikasi, beserta cantuman alamat dokumentasi hasil riset pengkaji terdahulu. Hadapan palka kontrol ini tak sekadar dijadikan etalase statis belaka melainkan juga ladang administratif menyusun dokumen yang mendesak untuk dibaptis, dipugar, atau sama sekali dikosongkan.

Bila kehendak penempatan tulisan baru mencuat, sistem memaksa si pangkal pengirim (admin) mengisikan sekelumit biografi riset seperti tajuk karangan ilmiah dan ikhtisar singkat abstrak, tidak luput menempatkan salinan aslinya di slot pemuatan lekat berkas (*upload panel*). Sepaket porsi informasi riset tersebut menunggangi roket perpindahan logis `HTTP POST`. Unit pos lalu mencegat dokumen. Lapis pemindai (*security filter checker*) menginterogasi keabsahan struktur muatannya—menakar pakem batas gundukan bobot (*limit quota size*) seraya menghalau muatan tipe yang bukan ditakdirkan selaku pedoman keilmuan sah (meloloskan fail kualifikasi dokumen murni saja). Andainya dokumen riset tersebut sah direngkuh, muatan peladen dengan sukarela membuka ruang kamar penyimpanan bagi fail bersangkutan demi mendiami area rak lumbung perpustakaan file statis web `/docs/penelitian`. Diiringi pendaratan aman tersebut, ikatan asinkron berlarut mengaitkan deskripsi abstrak dan rantai URL tujuannya selaku rekaman pertinggal baru menyongsong *database* relasional. 

Di simpang kebalikan, pemotongan eksistensi fail yang telah membusuk tak kalah krusial. Sistem dititahkan secara lisan (Lewat paramuka sirkuit pengawal berkode `Hapus`) membawa titah pencabutan berani. Tatkala alamat pemusnahan HTTP diketuk, pangkalan *server backend* mendelegasikan tugas dua cabang sekaligus: unit peladen mesin secara fisis menyerang wujud naskah dokumen lama guna diluluhlantakkan tak berbekas dari disk, silih berganti disusul tusukan kueri SQL dari *database* demi membabat bersih tapaknya dari tabel kepustakaan fakultas. Keampuhan alur penghapusan serempak nan brutal ini menghindarkan kepulauan wadah hosting aplikasi dari onggokan file usang misterius. Proses log komputasi dirangkai penyimpul status—layar ditolak mundur balik dan peramban mencuatkan bendera notifikasi yang menjamin ketenangan tugas penyunting. Administrator bahkan disediakan privilese opsional mencantum akses fitur ekstraksi (Unduh Dokumen) buat membedah dokumen pangkalan selayaknya pengunjung perpustakaan sungguhan.

## Diagram

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Arsip Penelitian"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Lumbung Brankas Ekstensi Dokumen (Docs/Files)"
    participant DB as "Database (MySQL)"

    Admin->>View: Sentuh URL Pangkalan Rekam Penelitian Riset (/admin/kelola_penelitian)
    View->>DB: Kueri Inventarisasi Sejarah Panjang Dokumentasi Terdata
    DB-->>View: Tumpahkan Paparan Lembaran Jejak Tabel Riwayat Riset 
    
    %% Proses Tambah / Format Unggahan Dokumen
    opt Mewadahi Rilis Laporan Baru & Menjejalkan Berkas Keilmuan
        Admin->>View: Ketik Rincian Riset, Ringkasan, Sematkan Eksemplar Pindaian Murni (PDF/DOC)
        Admin->>View: Sahkan Penyerahan Ketuk Simpan "Upload Arsip"
        View->>System: Kargo Titipan Lepas Landas Berkendara HTTP POST

        System->>System: Bentangkan Jaring Filtrasi Kualifikasi Bobot (Threshold 10MB) & Hak Tipe Ekstensi
        
        alt Standar Toleransi Berkas Riset Mengalir Lolos Validasi
            opt Tangkap Serahan Susupan Sinkron File Eksemplar Teranyar
                System->>Server: Kandangkan Tubuh Fail Laporan Langsung di Palung Penyimpanan Publik Pusat 
                opt Realisasi Peremajaan Judul/Modus Revisi Menimpa 
                    System->>Server: Hapus Akar Tapak Dokumentasi Karya Silam Tak Bertuan (Unlink Path)
                end
            end
            
            System->>DB: Semburkan Injeksi Jarum Tabel (INSERT / UPDATE Peneliti Data)
            DB-->>System: Restu Nyatakan Pemecahan Jejak Terjalin Halus
            System-->>View: Kemudi Pentalan Kembali Dipercantik Kotak Keberhasilan Proses (Redirect Success)
        else Mendobrak Pakem Limitasi Resolusi/Kategori Ekstensi (Dilepaskan)
            System-->>View: Tendang Ajuan dan Hamburkan Notifikasi Peringatan Kasar 
        end
    end

    %% Proses Unduh Dokumen dan Hapus Permanen
    opt Titah Perampingan Aset Cabut Laporan Kedaluwarsa
        Admin->>View: Ketuk Perintah Permusuhan Status Registrasi Arsip ("Hapus")
        View->>System: Berangkatkan Eksekusi Permintaan Pemusnahan Instan (HTTP GET Action Delete)
        System->>DB: Tuntut Ekstraksi Informasi Presisi Lintasan Geofisikal File Asal Berkaitan 
        
        alt Babat Habis Jejak Arsip Disk Lapis Ganda
            System->>Server: Mutilasi Segenap Tubuh Wujud Fail Riset Fisik di Disk Web (Unlink)
            System->>DB: Letupkan Granat Skrip Pemusnah Rekaman Baris Basis Data Tabel Lema (DELETE TBL)
            DB-->>System: Konfirmasi Validasi Operasi Gugur Diserahkan
        end
        
        System-->>View: Tampilkan Laman Paripurna Mulus Bertaut Simbol Keriangan Tuntas Kerja
    end
```
