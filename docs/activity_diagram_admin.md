# Activity Diagram & Penjelasan - Admin Web FIKOM

Dokumen ini berisi **Activity Diagram** secara detail untuk setiap modul pengelolaan data di halaman Administrator.

> **Catatan:** Diagram di bawah ini menggunakan format **Mermaid Flowchart** yang kompatibel dengan GitHub. label teks menggunakan tanda kutip untuk mencegah error parsing.

---

## 1. Login Admin

Proses autentikasi administrator untuk masuk ke dalam sistem.

```mermaid
flowchart TD
    Start(["Mulai"]) --> A["Buka Halaman Login"]
    A --> B[/"Input Username & Password"/]
    B --> C["Klik Tombol Login"]
    C --> D{"Username Ada?"}
    D -- Tidak --> E["Tampilkan Pesan Error: Username tidak ditemukan"]
    E --> A
    D -- Ya --> F{"Password Valid?"}
    F -- Tidak --> G["Tampilkan Pesan Error: Password salah"]
    G --> A
    F -- Ya --> H["Buat Session Admin"]
    H --> I["Redirect ke Dashboard"]
    I --> End(["Selesai"])
```

**Penjelasan:**
Proses login administrator merupakan gerbang utama keamanan sistem. Admin memulai dengan mengakses halaman login dan memasukkan kredensial berupa username serta password. Sistem kemudian melakukan pengecekan ganda secara berurutan: pertama memvalidasi keberadaan username di database, dan kedua memverifikasi validitas password menggunakan teknik hashing yang aman. Jika kedua tahap verifikasi ini berhasil, sistem akan menginisialisasi session admin untuk menjaga status login pengguna selama berinteraksi dengan dashboard. Seluruh proses ini dirancang untuk mencegah akses tidak sah sambil tetap memberikan kemudahan navigasi bagi administrator yang sah.

---

## 2. Kelola Data Dosen

Modul untuk manajemen data dosen tetap/tidak tetap, termasuk upload foto profil.

```mermaid
flowchart TD
    Start(["Mulai"]) --> Menu["Buka Menu Kelola Dosen"]
    Menu --> List["Tampil Daftar Dosen"]
    
    List --> Branch{"Pilih Aksi"}
    
    %% Tambah
    Branch -- Tambah Dosen --> FormAdd["Isi Form: NIDN, Nama, Prodi"]
    FormAdd --> UploadAdd["Upload Foto"]
    UploadAdd --> SimpanAdd["Klik Simpan"]
    SimpanAdd --> CekFoto{"Foto Valid?"}
    CekFoto -- Ya --> SaveDB["Simpan ke Database & Upload Server"]
    CekFoto -- Tidak --> ErrVal["Tampilkan Error Validasi"]
    SaveDB --> SuksesAdd["Tampilkan Pesan Sukses"]
    
    %% Edit
    Branch -- Edit Dosen --> FormEdit["Ubah Data Dosen"]
    FormEdit --> CekGanti{"Ganti Foto?"}
    CekGanti -- Ya --> UpNew["Upload Foto Baru & Hapus Lama"]
    CekGanti -- Tidak --> Skip["Pertahankan Foto Lama"]
    UpNew --> UpdateDB["Update Database"]
    Skip --> UpdateDB
    UpdateDB --> SuksesEdit["Tampilkan Pesan Sukses"]
    
    %% Hapus
    Branch -- Hapus Dosen --> Confirm["Konfirmasi Hapus?"]
    Confirm -- Ya --> DelFile["Hapus Foto Fisik"]
    DelFile --> DelDB["Hapus Data Database"]
    DelDB --> SuksesDel["Tampilkan Pesan Sukses"]
    Confirm -- Tidak --> List

    SuksesAdd --> List
    SuksesEdit --> List
    SuksesDel --> List
```

**Penjelasan:**
Modul manajemen dosen memungkinkan administrator untuk menjaga kemutakhiran data pengajar dengan kontrol yang presisi. Saat menambahkan dosen baru, admin menginput informasi dasar seperti NIDN dan kualifikasi akademik serta mengunggah foto profil yang akan divalidasi sistem agar sesuai standar. Fitur edit dirancang cerdas untuk menangani pembaruan foto, di mana sistem akan secara otomatis menghapus file fisik foto lama jika foto baru diunggah untuk menghindari penumpukan data sampah. Demikian pula pada proses penghapusan, sistem menjamin sinkronisasi antara record di database dan file fisik di server, memastikan integritas data tetap terjaga dengan baik.

---

## 3. Kelola Berita

Modul untuk mempublikasikan berita, pengumuman, atau artikel kegiatan kampus.

```mermaid
flowchart TD
    Start(["Mulai"]) --> A["Buka Menu Kelola Berita"]
    A --> B["Tampil Tabel Berita"]
    B --> C{"Pilih Aksi"}
    
    %% Tambah
    C -- Tambah --> D["Isi Judul, Kategori, Konten"]
    D --> E["Upload Thumbnail"]
    E --> F["Klik Simpan"]
    F --> G["Insert Data & Upload File"]
    
    %% Edit
    C -- Edit --> H["Update Konten / Ganti Foto"]
    H --> I["Klik Simpan Perubahan"]
    I --> J["Update Data di Database"]
    
    %% Hapus
    C -- Hapus --> K["Konfirmasi Hapus"]
    K -- Ya --> L["Hapus File Foto & Data"]
    
    G --> End(["Selesai / Refresh Tabel"])
    J --> End
    L --> End
```

**Penjelasan:**
Pengelolaan berita fakultas dilakukan melalui antarmuka yang intuitif bagi administrator. Setiap berita yang dipublikasikan memerlukan informasi krusial seperti judul yang deskriptif, kategori untuk pengelompokan, dan konten lengkap yang informatif. Foto atau thumbnail yang diunggah berperan sebagai daya tarik visual utama di halaman depan website. Sistem menangani proses penyimpanan data dan manajemen file secara transparan, memungkinkan admin untuk melakukan pembaruan konten atau penggantian gambar kapan saja guna memastikan informasi yang sampai ke publik selalu terupdate dan relevan dengan perkembangan terkini di kampus.

---

## 4. Kelola Pendaftaran Mahasiswa

Modul untuk memverifikasi data calon mahasiswa yang mendaftar secara online.

```mermaid
flowchart TD
    Start(["Mulai"]) --> A["Buka Halaman Pendaftaran"]
    A --> B["Lihat List Pendaftar Masuk"]
    B --> C{"Pilih Aksi"}
    
    C -- Lihat Detail --> D["Popup Biodata Lengkap"]
    D --> E["Review Nilai & Berkas"]
    
    C -- Update Status --> F["Pilih Status: Diterima/Ditolak"]
    F --> G["Update Database via Ajax/Post"]
    G --> H["Warna Status Berubah"]
    
    C -- Hapus --> I["Konfirmasi Hapus"]
    I -- Ya --> J["Hapus File KTP/Ijazah & Data"]
    
    E --> B
    H --> B
    J --> B
```

**Penjelasan:**
Modul ini berfungsi sebagai pusat kendali untuk memantau arus pendaftaran mahasiswa baru. Berbeda dengan modul lainnya, di sini administrator lebih bersifat responsif terhadap data yang masuk dari calon mahasiswa. Admin dapat meninjau detail biodata, memeriksa berkas administrasi yang diunggah, dan melakukan verifikasi nilai. Pengambilan keputusan dilakukan dengan memperbarui status pendaftaran menjadi diterima atau ditolak, yang secara otomatis akan memberikan umpan balik visual dan memicu proses administratif selanjutnya. Sistem juga menyediakan opsi penghapusan data untuk membersihkan record pendaftaran yang tidak valid atau sudah lewat masa berlakunya.

---

## 5. Kelola Kerjasama (Partner)

Modul untuk menampilkan logo instansi yang bekerja sama dengan fakultas.

```mermaid
flowchart TD
    Start(["Mulai"]) --> A["Buka Menu Kerjasama"]
    A --> B["Klik Tambah Partner"]
    B --> C["Input Nama Instansi & Link"]
    C --> D["Input Bulan & Tahun"]
    D --> E["Upload Logo Instansi"]
    E --> F{"Format Gambar Valid?"}
    
    F -- Tidak --> G["Tampilkan Error"]
    F -- Ya --> H["Upload ke Server"]
    H --> I["Simpan Data ke Database"]
    I --> J["Tampilkan Pesan Sukses"]
    J --> End(["Selesai"])
```

**Penjelasan:**
Kerjasama strategis dengan pihak eksternal didokumentasikan melalui modul mitra ini guna memperkuat reputasi fakultas. Administrator menginput nama instansi, tautan website resmi mitra, serta detail waktu dimulainya kerjasama. Aspek visual dikelola melalui unggahan logo instansi yang divalidasi secara sistematis untuk menjamin presisi tampilan di halaman publik. Setiap mitra yang ditambahkan akan memperkaya portofolio kolaborasi fakultas yang ditampilkan secara dinamis, memberikan informasi yang transparan kepada pengunjung mengenai luasnya jejaring kerjasama yang dimiliki Fakultas Ilmu Komputer.

---

## 6. Kelola Visi, Misi, & Tujuan

Modul *Multi-Section* yang mengelola beberapa jenis data dalam satu halaman.

```mermaid
flowchart TD
    Start(["Mulai"]) --> A["Buka Halaman Visi Misi"]
    A --> Ops{"Bagian Mana?"}
    
    Ops -- Visi Utama --> B["Edit Textarea Visi"]
    B --> C["Klik Simpan Visi"]
    C --> D["Update Tabel visi_misi"]
    
    Ops -- Misi / Tujuan --> E["Input Text Baru"]
    E --> F["Input Nomor Urut"]
    F --> G["Klik Tambah"]
    G --> H["Insert ke Database"]
    
    Ops -- Hapus Item --> I["Klik Ikon Hapus di List"]
    I --> J["Delete Item dari Database"]
    
    D --> End(["Selesai"])
    H --> End
    J --> End
```

**Penjelasan:**
*   Halaman ini unik karena menggabungkan form update tunggal (untuk Visi) dan list CRUD (untuk Misi/Tujuan) dalam satu tampilan.

---

---

## 7. Kelola Dokumen

Modul untuk manajemen file dokumen akademik dan strategis fakultas.

```mermaid
flowchart TD
    Start(["Mulai"]) --> A["Buka Menu Dokumen"]
    A --> B["Klik Tambah"]
    B --> C["Input Judul/Nama"]
    C --> D["Upload File (PDF)"]
    D --> E{"Ukuran Sesuai?"}
    
    E -- Tidak --> F["Tolak Upload"]
    E -- Ya --> G["Upload File ke Server"]
    G --> H["Simpan info ke Database"]
    H --> End(["Selesai"])
```

**Penjelasan:**
Modul pengelolaan dokumen dirancang untuk memudahkan administrasi file-file penting seperti SOP, Rencana Strategis, dan Kurikulum. Administrator dapat mengunggah file baru dalam format PDF, di mana sistem akan melakukan pengecekan ukuran file untuk menjaga kinerja server. Setiap dokumen yang berhasil diunggah akan tercatat secara sistematis di database, memungkinkan akses yang mudah dan terorganisir baik bagi internal fakultas maupun bagi publik yang memerlukan akses terhadap dokumen-dokumen resmi tersebut.
