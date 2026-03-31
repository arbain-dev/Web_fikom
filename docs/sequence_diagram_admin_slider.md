# Sequence Diagram: Kelola Slider (Admin Web FIKOM)

Diagram sekuensial ini merunut jalur interaksi teknis untuk keseluruhan skenario *Create, Read, Update,* dan *Delete* (CRUD) pada modul pengelola *slider* beranda.

## Penjelasan Alur

Diagram sekuensial ini merunut alur operasional komprehensif dari modul Kelola Slider pada antarmuka administrator, yang menaungi proses manipulasi dinamis panel spanduk (sorotan bergerak) di beranda utama Web FIKOM. Pada fase inisiasi ketika skrip muatan muka pertama kali dibaca, sistem lekas menyusun dan membentangkan riwayat matriks tabel tata letak grafis *slider* yang isinya telah ditarik seketika dari ruang simpan tabel pangkalan data (MySQL). Rentang interaksi perombakan panel tersebut dikelompokkan ke dalam empat siklus fundamental; meliputi operasi Penambahan (Tambah Gambar), Penyesuaian Dokumen (Edit), Manipulasi Akses Status (Aktif/Tidak Aktif), serta perintah radikal Penghapusan.

Tatkala sang admin berniat mengunggah *slider* murni yang baru—ataupun memugar potret lama pada entitas yang sudah eksis—peramban web akan menghimpun serangkaian teks tajuk, uraian singkat, beserta pecahan ekstensi *file* gambar yang terpilih, lantas menumpangkannya di atas rel pengiriman lalu-lintas bersandi `HTTP POST`. Lapis kendali internal pemroses peladen kemudian menyeleksi pengajuan ini dengan melaksanakan validasi ketat, guna menjamin muatan tak melanggar ketentuan resolusi dan hanya memercayai jenis arsip grafis yang diizinkan sistem. Sekiranya jaring filter tersebut dilampaui mulus, sistem serentak mengarahkan mesin repositori penyimpanan (*storage server*) buat menginapkan berkas digital orisinal itu merasuk ke dalam relung *folder upload* web. Segaris dengan pencapaian presisi relokasi *file* itu, jembatan pengendali sejenak berkoordinasi secara asinkron dengan mesin MySQL guna membukukan rincian teks berserta alamat pemanggilan *file* anyar pada hamparan lajur tabel yang relevan (*Insert/Update Query*).

Pola siklus bertolak belakang terjadi sewaktu administrator menekan tombol eliminasi (Hapus). Instruksi pencabutan tersebut diluncurkan instan memakai mode pemanggilan *request URL* (*HTTP GET*). Merespons hal itu, peladen lekas melenyapkan tapak *file* gambar fisik dari relung memori peladen (layaknya fungsi pisau bedah *unlink*), dikuti operasi amputasi langsung yang menggugurkan keabsahan sel *record* berkas identitasnya dari skema *database*. Begitu pula untuk *switch* status penampilan, sistem hanya menukar variabel visibilitasnya (*toggle activate*). Di paruh penghujung seluruh transisi keberhasilan tata letak ini, rutinitas algoritma bakal diakhiri lewat pengarahan paksa sirkulit visual halaman pendamping (*redirect*), menayangkan gelembung kilasan notifikasi sukses sembari secara bersamaan meregang perbarui ulang deretan tabel *slider* di hadapan layar administrator. 

## Diagram

```mermaid
sequenceDiagram
    autonumber
    actor Admin as Administrator
    participant View as "Halaman Manajemen Kelola Slider"
    participant System as "Sistem/Controller (PHP)"
    participant Server as "Direktori Storage (Uploads/)"
    participant DB as "Database (MySQL)"

    Admin->>View: Akses Antarmuka (/admin/kelola_slider)
    View->>DB: Rutinitas Penarikan Riwayat Data Slider
    DB-->>View: Sajikan Kumpulan Tabel Slider

    %% Proses Penambahan Data atau Update
    opt Menambah/Mengedit Slider
        Admin->>View: Mengisi Form Teks + Mengunggah Potret Slider
        Admin->>View: Mengirim Persetujuan Eksekusi "Simpan"
        View->>System: Kompilasi Ekspedisi Data (HTTP POST Multiform)

        System->>System: Uji Validasi Parameter Skala dan Tipe File
        
        alt Filter Keamanan File Valid Terpenuhi
            opt Kondisi File Baru Hadir
                System->>Server: Titipkan Gambar di Direktori Penampungan (Move_Upload)
                opt Update Data (Skenario Edit)
                    System->>Server: Musnahkan dan Bakar Artefak Potret Lama (Unlink)
                end
            end
            
            System->>DB: Rumusan Kueri INSERT / UPDATE (rekaman teks + path gambar)
            DB-->>System: Labeli Kesuksesan Modifikasi
            System-->>View: Pentalan Rute (Redirect) Berbalut Pesan Sukses  
        else Pelanggaran Ekstensi / Resolusi
            System-->>View: Tarik Kembali Serahan & Beri Pesan Penolakan
        end
    end

    %% Proses Hapus Data
    opt Penghapusan Slider Publik
        Admin->>View: Sepakati Konfirmasi Penghapusan Item
        View->>System: Kirim Arahan Singkat Hapus (HTTP GET Action Delete)
        System->>DB: Ekstrak Lokasi Path File dari Database
        System->>Server: Cabut File Potret Aktual Tersebut (Unlink File)
        System->>DB: Tembakkan Kueri Amputasi Penghapusan(DELETE)
        DB-->>System: Pemusnahan Telah Diakui
        System-->>View: Tarikan Pengarah Ulang Beserta Rilis Pesan Notifikasi Sukses
    end
    
    %% Proses Ganti Status Aktif/Tidak Aktif
    opt Atur Kondisi Tampil/Sembunyi
        Admin->>View: Ubah Status Terlihat (Tombol Aktif/Inaktif)
        View->>System: Lempar Titik Kueri (GET status Update)
        System->>DB: Kueri UPDATE Mengganti Variabel Bool_Status
        DB-->>System: Laporan Selesai
        System-->>View: Segarkan Ulang Tabel Secara Paripurna
    end
```
