# Sequence Diagram: Kelola Kalender Akademik (Admin Web FIKOM)

Diagram sekuensial ini mendokumentasikan serangkaian alur komputasional teknis dalam manajemen mengunggah dan merilis edaran wujud pedoman waktu (Kalender Akademik) kepada khalayak antarmuka.

## Penjelasan Alur

Dalam kerangka lalu-lintas web Fakultas Ilmu Komputer, modul "Kelola Kalender Akademik" disusun ringkas untuk menghandel rilis pementasan media visual atau grafik lembar penunjuk waktu pendaftaran, ujian, hingga operasional edukatif tahunan. Mengingat kalender ini merupakan tongsi krusial yang perlu senantiasa diremajakan di setiap pergantian semesta perkuliahan, administrator cukup menjajaki alamat pengelola untuk meninjau kepingan potret penanggalan yang disuguhkan mesin *database* di papan penelusuran. Melalui antarmuka visual sederhana tersebut, tugas administrator ditekankan pada dua pokok fundamental: mengunggah susunan baru piktogram kalender yang dikemas dalam gambar, serta melakukan penyortiran pencabutan arsip dokumentasi tahun pengajaran yang kadaluwarsa.

Selayaknya modul pemuat aset berwujud visual lainnya, siklus administrasi dipacu kala admin menetapkan judul semester penanggalan terkini dan mulai menyelundupkan hasil cetak biru file gambar kalender tersebut di borang pengisian. Menekan tombol pasak eksekusi segera mengirim formulasi *multipart HTTP POST* ini mengarungi lorong aplikasi (*PHP backend*). Sistem akan menyeleksi resolusi dan kualitas *jpg/png* agar proporsi bentangan grafis tersebut tetap cemerlang tanpa menekan ketersediaan penyimpanan peladen fisik utama. Menyadari keabsahannya, barisan perintah peladen menempatkan gambar pada rak arsip web `/uploads` atau keranjang publik yang ditugaskan. Tak lama kelang penyerahan mandat keamanan fisik berkas, kueri skrip memproyeksikan lintasan tautan URL (*path string*) dan judul periode perkuliahan ke kerangka struktur rekam jejak lajur kalender (*insert/update*) ke pangkalan *MySQL*. 

Demi terhindarnya tumpukan boros gambar visual pedoman pengajaran tahunan, admin disediakan juga dengan fitur amputasi aset (Hapus Kalender Eksisting). Saat ekuitas data ditabrak perintah `Delete Action Get Request`, mekanisme perampingan server berjalan cepat menyerang nama tabel kalender terkait. Lapis operasional peladen tanpa ampun membakar presensi bayangan jejak potret kalender kuno (*unlink command*) sebelum perusak basis data berlanjut memberantas rekaman isian lajur kalender pada MySQL. Pertarungan komputasi ini lekas diakhiri dengan peredaman konflik (*redirect*) untuk mendapuk kembali administrasi web menampilkan status bersih sukses terangkut kepada hadapan layar peramban.

## Diagram

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Kelola Kalender"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Storage (Media Kalender)"
    participant DB as "Database (MySQL)"

    Admin->>View: Menelusuri Modul (/admin/kelola_kalender)
    View->>DB: Rutinitas Penarikan Katalog Tabel Sejarah Kalender
    DB-->>View: Suguhkan Daftar Rujukan Kalender Berjalan
    
    %% Proses Tambah / Edit Kalender
    opt Meregistrasikan Rilis Kalender Semester Terbaru
        Admin->>View: Bubuhi Titel Tahun Akademik, Teks Ringkas, & Upload Grafis Kalender
        Admin->>View: Pancangkan Eksekusi Penyimpanan Form (Update/Save Record)
        View->>System: Kargo Titipan Pengiriman Melintas via Akses (HTTP POST MULTIPART)

        System->>System: Analisa Uji Ekstensi Keamanan & Toleransi Gambar Visual Kalender
        
        alt Filter Batasan File Mulus Dilewati
            opt Apabila Terdapat Bongkahan Grafik File Foto Baru
                System->>Server: Timpa Arsip Baru Penampakan Kalender Masuk ke Rak Repositori 
                opt Rejuvenasi Tabel (Modus Edit Jadwal)
                    System->>Server: Habisi Jejak Bayangan Gambar Kalender Akademik Lama (Unlink)
                end
            end
            
            System->>DB: Luncurkan Eksekusi Tali Kueri (SQL INSERT / UPDATE) Merasuk ke Tabel
            DB-->>System: Akuisi Penerimaan Catatan Kalender Memori MySQL
            System-->>View: Kembalikan Kemudi Pentalan Layar Memakai Sinyal Sukses Hijau 
        else Dimensi atau Ekstensi Siluman Terendus
            System-->>View: Tampik Permintaan & Singkapkan Tirai Rilis Error Resolusi
        end
    end

    %% Proses Hapus Kalender Terlewat
    opt Menyortir Membuang Media Eksemplar Kalender Tenggelam
        Admin->>View: Sentuh Opsi Perintah Aksi Hapus Permanen
        View->>System: Lontarkan Permintaan Pelenyapan Item (HTTP GET Action Delete)
        System->>DB: Telusuri Sandi Indeks Nama Rujukan File Terdahulu
        System->>Server: Langsung Runtuhkan Penampakan Arsip Fisik Menuju Penghapusan (Unlink)
        System->>DB: Lontarkan Perusak Entitas Baris Database (Kueri DELETE)
        DB-->>System: Restui Kesetujuan Penebasan Rekam Jejak Sukses
        System-->>View: Giring Pelayar Mundur Menyegarkan Tabel Teriring Kotak Kesuksesan
    end
```
