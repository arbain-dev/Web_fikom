# Sequence Diagram: Pengaturan Sistem (Admin Web FIKOM)

Diagram sekuensial ini menjelaskan tahapan yang memandu pengoperasian ringkas halaman "Pengaturan", yang berfungsi mengurus rincian logo sampai judul fundamental Web FIKOM.

## Penjelasan Alur

Hal yang mengkhususkan fungsionalitas laman ini ketimbang tabel rekam jejak lain; pencatatan setingannya berada di *database* hanya diwakili sebaris rekam informasi inti (*Single configuration record*):

1. **Pemanggilan Laman Pengaturan**: 
   Sesaat admin mengetuk panel "Pengaturan Sistem", kueri sistem mengangkat satu *record* identitas pokok situs di pangkalan data. Pengisian tersebut akan merangkai formulir bawaan meliputi *Judul Situs*, Nomor Telpon Humas, sampai Email dan tersaji langsung menempati kolom isian layar.

2. **Perubahan & Klik Pembaruan Sinkron**:
   - Jika admin berniat memugar isian teks tersebut maupun mengganti lambang visual portal *Logo Favicon Web*, Admin bebas menghapus kolom isiannya lalu dikokohkan bersamaan ketukan simpan **Perbarui**.
   - Kiriman form ini dilimpahkan merapat menuju pos skrip pengaman pangkalan sistem (PHP).
   - Diandaikan pergantian simbol grafis/gambar dimanfaatkan melintasi toleransi ukuran batas memori berwewenang (*Batas megabyte max*). Mesin PHP secara halus memboyong logo anyar dan membanting posisi ke dalam saku penyimpanan lokasi file aset publik (*uploads atau img source*).
   - Bersamaan itu, rutinitas pengakhir menghanguskan dan menyapu foto logo pendahulunya ke arah tiada tersisa demi meringankan penumpukan data teronggok di sela penyimpanan *Server*.
   - Rangka logik kemudian menembuskan keping baris kueri bertingkat memutakhiran *SET UPDATE config* pada lapis saksi mata tabel pengaturan. Kesempurnaan putaran diakhiri memuat ulang laman admin di mana pemberitahuan segar ditimpakan ke sisi kanan atas layar: Sukses modifikasi!

## Diagram

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Pengaturan Umum"
    participant System as "Sistem Pengendali PHP"
    participant Server as "Storage Aset Simbol Sentral Identitas (Folders)"
    participant DB as "Lembah Pangkalan Atribut Website TBL Setings (MySQL)"

    Admin->>View: Masuki Ruang Beranda Pengaturan Situs Inti
    View->>DB: Ekstrak catatan info satu baris profil situs
    DB-->>View: Lengkapi segenap parameter dasar melengkapi celah masukan *input views*

    %% Proses Pembaruan Parameter Singel
    opt Klik Sepakati Ketetapan Menyimpan Sentuhan Identitas Terupdate Muka Laman
        Admin->>View: Ubah modifikasi pautan nomor/email berserta pindaian mutakhir logo web 
        Admin->>View: Konfirmasi persetujuan "Simpan Parameter Konfigurasi"
        View->>System: Terjunkan rute pengangkutan data menuju pangkalan pemrosesan (Transisi form terbungkus HTTP POST)

        System->>System: Cek limit rasio pemakaian berbatasan kapasitas pindaian foto file (Ekstensi Validation)
        
        alt Skema Ekstensi Gambar Mulus Tercapai 
            opt Andaikata Logo / Lambang Situs Dimodifikasi Digantikan Bongkahan File Terbaru
                System->>Server: Dudukkan sematan grafis visual anyar mendarat ke rak tumpukan folder khusus
                System->>Server: Bakar hingga bersih keping rekam aset logo sejarah yang dibilang kadaluwarsa (Titah Skrip Lenyapkan `unlink`)
            end
            
            System->>DB: Injeksi rentetan skema merombak tatanan tabel dasar pengaturan sebaris memori MySQL (Pembaruan Singkat UDPATE SET)
            DB-->>System: Nyatakan integritas perombakan dititipkan stabil berhasil mutlak
            System-->>View: Meregang layar antarmuka memuat pelonjakan Pentalan Notifikasi Sempurna (Pemberitahuan Sukses Di Layar Dasbor Kembali Menyala Terang)
        else Tampilan Parameter Batas Lolos Gambar Tercoreng Cacat Tipe Fail Liar
            System-->>View: Tendang suruhan perubahan data kembali pada layar disertai serpihan Merah Rilis Peringatan Pesan Error Gagal! 
        end
    end
```