# Sequence Diagram: Kelola Fasilitas Ruangan (Admin Web FIKOM)

Diagram sekuensial ini menerangkan rangkaian prosedur penanganan alur interaksi (*CRUD*) pada antarmuka administrator dalam manajemen tata letak sarana fasilitas dan ruang sivitas pada kawasan kampus (Kelola Ruangan).

## Penjelasan Alur

Runtutan prosesual dalam narasi ini mendasar atas arsitektur pergerakan data modul Kelola Ruangan (dan/atau Laboratorium). Modul antarmuka ini didedikasikan agar fungsionaris kampus/administrator secara presisi dapat mencatatkan ketersediaan tempat bernaung akademik beserat inventaris di dalamnya. Kala pertama penelusuran masuk halaman, skrip internal langsung menarik rentetan deret tabel yang merangkum ketersediaan wujud fasilitas ruang belajar/lab dari lorong pangkalan data (*database* MySQL). Pengelolaan lantas bertumpu kepada rangkaian pembaruan fana: pendaftaran bangsal ruangan baru, rekontruksi parameter kapabilitas eksisting, hingga perombakan yang diinisiasi pemusnahan aset ruang tak terpakai dari memori sistem.

Di persimpangan tata operasional, tatkala seorang administrator beriktikad meresmikan suatu letak ruang kampus untuk dipampang di etalase masyarakat, skema pengisian form pun dilemparkan. Pada ruas borang itu, admin mematri parameter identitas ruang—seperti singkatan Kode Ruangan, Nama Ruang representatif, kuantitas batasan kapasitas, serta rentetan sarana (*facilities*). Selembar berkas lampung potret penampakan visual ruang pun disematkan bersamaan. Kompilasi nilai masukan dirapat lalu dikapalkan menuju skrip ujung palung peladen (*backend controller*) bernavigasi lintasan `HTTP POST`. Unit sistem utama tersebut lalu mencegat keberadaan kepingan foto untuk mengevaluasi batasan kelayakannya: menyaring dimensi ekstrem serta ekstensi siluman yang tak kompatibel. Terpenuhinya tes ambang minimal itu akan membukakan karpet merah agar peladen fisik menyimpan rupa foto masuk mengisi lumbung gambar (*upload array directory*). Beriringan mulus dengan kepastian repositori file, unit pusat menggaungkan bahasa pemrograman *query base* (sekelas `INSERT/UPDATE`) agar mesin penabung MySQL tak terlewat mencatatkan sandi teks dan indeks rujukan nama rupa foto ke baris susunan tabel fasilitas tersebut.

Mekanisme bongkar-pasang (Update mutasi file) beserta keabsahan eksekusi bedah tuntas (*Delete record*) tidak luput berjalan beruntun dengan tertib. Skrip penata ini menjanjikan operasi bahwa pengakuan hadirnya lampiran citra baru (*upload ganti foto ruangan*) otomatis mewajibkan mesin komputasi untuk mengebiri rupa foto ruangan purba dan membunuh eksistensinya (*unlink function*). Perlakuan identik diulang saat fitur hapus permanen ditarik menggunakan tombol penghancur eksekusi URL (`GET action Delete`). Seluruh keberadaan entitas saksi yang mendiami pangkalan data dicabut dan artefak filenya dibabat bersih tanpa ampun dari lapis ruang mesin instalasi peladen. Paragraf alur transisi ini selalu diselipi kelegaan tatkala fungsional mengantarkan isyarat keberhasilan—meredirect admin menuju susunan indeks anyar ditandai munculnya pop-up notifikasi tuntas warna kesuksesan di latar depannya.

## Diagram

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Kelola Ruangan"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Storage (Uploads/Fasilitas)"
    participant DB as "Database (MySQL)"

    Admin->>View: Sambangi Pintu Akses Pengelolaan (/admin/kelola_ruangan)
    View->>DB: Eksekusi Tuntutan Daftar Ketersediaan Fasilitas Ruang
    DB-->>View: Distribusikan Tabel Susunan Aset Fasilitas Kampus

    %% Proses Tambah / Edit Ruangan
    opt Mencatat Ruang Baru/Merombak Fasilitas Lokasi
        Admin->>View: Bubuhkan Teks Kode Ruang, Nama, Kapasitas Fasilitas, & Foto Ruangan
        Admin->>View: Setujui Eksekusi Pengusulan Aset ("Simpan")
        View->>System: Gulirkan Pelayaran Paket Identitas (HTTP POST MULTIPART)

        System->>System: Uji Kelayakan Standarisasi Gambar Fisik
        
        alt Cek Filter Uji Tipe File Valid Menghijau
            opt Terdeteksi Pintu Unggahan Foto Penampakan Anyar
                System->>Server: Kandangkan Wujud Fisis Foto ke Lingkar Repositori
                opt Update (Realisasi Edit Aset Lawas)
                    System->>Server: Enyahkan Tapak Visual Potret Ruangan Terdahulu (Unlink)
                end
            end
            
            System->>DB: Luncurkan Panah Kueri SQL INSERT / UPDATE Pada Laci Fasilitas
            DB-->>System: Yakinkan Interogasi Mutasi Tabel Telah Terekam
            System-->>View: Kembalikan Rute Pemantul (Redirect) & Restui Pesan Sukses  
        else Terpeleset Uji Spek Resolusi & Ekstensi
            System-->>View: Hambat Pengayaan Data & Peringatkan Melalui Layar
        end
    end

    %% Proses Hapus Ruangan
    opt Mengakhiri Status Kepemilikan (Penghapusan Data Fasilitas)
        Admin->>View: Menarik Ketetapan Pembersihan Ruang (Tombol Hapus)
        View->>System: Terbangkan Instruksi Pembabatan Data (HTTP GET Delete)
        System->>DB: Seret Identitas Nama File Berdasarkan Sel Rujukan Ruang
        System->>Server: Tindak Tegas Enyahkan Fisik File Penampakan (Unlink Function)
        System->>DB: Eksekusi Suntikan Penghangusan Kueri Tabel (DELETE)
        DB-->>System: Respon Deklarasi Pemusnahan Usai
        System-->>View: Lintasi Ulang Rute dengan Rilis Kilat Label Konfirmasi Tuntas
    end
```
