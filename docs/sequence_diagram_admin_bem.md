# Sequence Diagram: Kelola Data BEM / Organisasi (Admin Web FIKOM)

Diagram sekuensial ini merinci pemetaan alur komputasi di dalam modul administrasi laman "Kelola BEM" (Badan Eksekutif Mahasiswa) yang difungsikan guna memanipulasi etalase portofolio pergerakan organisasi kemahasiswaan.

## Penjelasan Alur

Sorotan apresiasi kegiatan sivitas mahasiswa tergambarkan di pelataran publik situs FIKOM melalui corong pengendali "Kelola BEM". Pola kerangka kerja antarmukanya beradaptasi sempurna dengan mekanisme master data profil lainnya. Pintu kedatangan rutinitas ini terbuka sewaktu administrator menjajaki tautannya. Sistem dengan cekatan meraup himpunan daftar nama pengurus, divisi, atau bahkan dokumentasi visual kegiatan dari lapis *database* MySQL untuk dibariskan ke papan etalase pandangan pengelola web.

Dalam mengemban kewajiban memugar portofolio BEM, administrator dibekali kapasitas unggul layaknya arsitek ruang publik—berwewenang menyunting atau mendirikan organisasi/pengurus baru (*Create/Update*) serta leluasa membubarkan catatan organisasi terdahulu (*Delete*). Setiap deklarasi susunan keorganisasian mensyaratkan deskripsi naratif padat dan kerap disempurnakan sisipan unggahan logo departemen atau arsip rupa kegiatan (*image format*). Kumpulan informasi itu diberangkatkan lewati kargo tertutup `HTTP POST`. Unit pelindung server (*PHP handler*) mengambil peran eksekutor filter, senantiasa menepis paksa lampiran fail bila ketahuan melampaui ukuran ruang aman dan menyasar rasio format asing. Memenuhi takaran resolusi, pindaian wajah organisasi ini langsung ditanam dalam wadah *folder system public*. Pada ketukan waktu bersamaan, skrip `SQL (INSERT/UPDATE)` disuntikkan ke bilik memori agar data deskriptifnya menyilang padu bersama tautan lokasi rupa file eksak tersebut di tabel pangkalan MySQL. 

Pemotongan nafas catatan organisasi masa lampau tak dibiarkan mencederai kesehatan ruang diska memori. Seumpama admin mendelegasikan perintah tebang (*Action Hapus lewat perintah pemutus GET*), sepasukan mesin peretas akan menggeruduk direktori memori untuk mencongkel akar eksistensi file foto ormas (`unlink routine`), seketika menyalurkan ledakan penghancuran terakhir untuk menamatkan garis keberadaannya pada baris pangkalan (*DELETE* record pada MySQL). Proses sirkulasi perampingan catatan organisasi ini selalu menemukan titik kedamaian dengan memantulkan administrator balik pada gerbang antarmuka awal diselimuti lencana biru kesuksesan mutlak.

## Diagram

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Organisasi BEM"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Brankas Visual Profil (Uploads)"
    participant DB as "Database (MySQL)"

    Admin->>View: Menapak Kunjungan URL Organisasi Kemahasiswaan (/admin/kelola_bem)
    View->>DB: Eksekusi Tuntutan Penelusuran Tabel Rekaman Organisasi
    DB-->>View: Sajikan Kompilasi Susunan Manajemen Berkas BEM
    
    %% Proses Tambah / Update Dokumentasi BEM
    opt Mengarsip Rilis Pengukuhan Profil Oraganisasi Anyar / Rekontruksi Data Eksisting
        Admin->>View: Pasak Borang Penamaan Teks Deskriptif Serta Pasang Resolusi Potret (Logo/Foto BEM)
        Admin->>View: Setujui Eksekusi Rilis Penilaian Pangkalan ("Simpan")
        View->>System: Kompilasi Ekspedisi Keorganisasian Lemparkan Diri (Sandiwara Kargo HTTP POST)

        System->>System: Ekskavasi Pendalaman Uji Muatan Maksimal Skala Resolusi Beserta Tipe Gambar Fisis
        
        alt Tes Parameter Ekstensi Fisis Dokumen Lulus (Tidak Kadaluwarsa Resolusi)
            opt Bilamana Hadir Tangkapan Sosok File Susupan Baru Mengisi Slot Lampiran
                System->>Server: Semayamkan Kehadiran Format Visual Baru pada Brankas Folder 
                opt Manipulasi Revisi Timpa Potret Dokumentasi Usang (Update Mode)
                    System->>Server: Musnahkan dan Bakar Visual Lampiran Berkas Sejarah Terdahulu (Operasikan Skrip Unlink Serang)
                end
            end
            
            System->>DB: Luncurkan Tali Panah Skema INSERT / UPDATE Tabel Relasi Oragnisasi
            DB-->>System: Labeli Integrasi Kemenangan Tersemat Nyata
            System-->>View: Kemudi Pentalan Kembali Utuh Berbalas Label Cemerlang Kemenangan (Redirect Berhasil) 
        else Dimensi Menahan Batas Kesempurnaan Hak Ukuran & Format Berkas Terlanggar
            System-->>View: Pelintir Balik Ke Laman Usulan & Hamparkan Notifikasi Kekerasan Resolusi Merah
        end
    end

    %% Proses Penghapusan Keanggotaan BEM Permanen
    opt Mendisiplinkan Pengecilan Registrasi Ormas (Hapuskan Berkas BEM)
        Admin->>View: Sentuh Aksi Penarikan Resolusi Pembatalan Jejak (Ikon Hapus)
        View->>System: Pancangkan Delegasi Tembakan Aksi GET Action Membasmi Total 
        System->>DB: Lacak Keberadaan Parameter Alamat Rujukan File Pada Bilik Relasional Tabel BEM Terkait
        
        alt Jurus Ganda Pembedahan Server Bebas Artefak
            System->>Server: Pangkas Habisan Selongsong Bentuk Jasmaniah Fotografi Ormas Pada Bingkai Folder (Pemusnahan via Unlink PHP)
            System->>DB: Eksekusi Suntikan Penghangusan Kueri Lema Tabel Pangkalan Identitas (Skrip Tembak Letupkan DELETE)
            DB-->>System: Akui Pernyataan Sinyal Tembakan Gugur Sudah Lunas Berjalan
        end
        
        System-->>View: Berlayar Kembali Menyusuri Antarmuka BEM Bebas Lema Menyuguhkan Rona Kebesaran Selesai Paripurna
    end
```
