# Activity Diagram - Fasilitas (Ruangan & Laboratorium)

Dokumen ini berisi activity diagram untuk alur penggunaan dan pengelolaan fasilitas fisik (Ruangan & Laboratorium) pada Website Fakultas Ilmu Komputer.

---

## 1. Alur Tampilan Publik (Public View)

Diagram ini menggambarkan bagaimana pengunjung melihat informasi fasilitas dan memperbesar foto melalui fitur popup/lightbox.

```mermaid
flowchart TD
    Start([Start]) --> OpenMenu[Pengguna memilih Menu Fasilitas]
    OpenMenu --> Choice{Pilih Kategori}
    
    Choice -- "Ruangan" --> FetchRuangan[Sistem mengambil data Ruangan dari DB]
    Choice -- "Laboratorium" --> FetchLab[Sistem mengambil data Lab dari DB]
    
    FetchRuangan --> ShowGrid[Sistem menampilkan Grid Kartu Fasilitas]
    FetchLab --> ShowGrid
    
    ShowGrid --> ClickImage[Pengguna klik Foto/Gambar Fasilitas]
    ClickImage --> ShowPopup[Sistem menampilkan Popup/Lightbox Gambar]
    
    ShowPopup --> Interaction{Aksi di Popup}
    Interaction -- "Klik Tombol Tutup/Overlay" --> ClosePopup[Popup Tertutup]
    ClosePopup --> End([End])
```

---

## 2. Alur Pengelolaan Admin (Admin Management - CRUD)

Diagram ini merinci bagaimana administrator mengelola data fasilitas, termasuk proses upload foto.

```mermaid
flowchart TD
    Start([Start]) --> Login[Admin Login ke Dashboard]
    Login --> OpenModule[Pilih Kelola Ruangan / Kelola Lab]
    OpenModule --> ShowTable[Sistem menampilkan Tabel Data Fasilitas]
    
    ShowTable --> Action{Pilih Aksi}
    
    %% Alur Tambah
    Action -- "Tambah Baru" --> OpenModalTambah[Sistem membuka Modal Form Kosong]
    OpenModalTambah --> InputData[Admin mengisi Nama, Deskripsi & Upload Foto]
    InputData --> SaveData[Sistem memvalidasi & simpan ke DB/Storage]
    
    %% Alur Edit
    Action -- "Edit Data" --> OpenModalEdit[Sistem membuka Modal dengan Data Lama]
    OpenModalEdit --> UpdateData[Admin mengubah data / ganti foto]
    UpdateData --> SaveUpdate[Sistem mengupdate data di DB]
    
    %% Alur Hapus
    Action -- "Hapus Data" --> Confirm[Admin konfirmasi hapus]
    Confirm --> DeleteProcess[Sistem hapus data di DB & file foto di storage]
    
    SaveData --> Notify[Tampilkan Notifikasi Berhasil]
    SaveUpdate --> Notify
    DeleteProcess --> Notify
    
    Notify --> Refresh[Refresh Tabel Data]
    Refresh --> End([End])
```

---

### Penjelasan Teknis:
1.  **Public View**: Sistem menggunakan `IntersectionObserver` (via `main.js`) untuk memberikan efek rimbun (reveal) saat kartu fasilitas muncul di layar. Fitur popup dikelola oleh fungsi `showPopup()` yang memicu modal visual sederhana.
2.  **Admin View**: Pengelolaan data menggunakan kombinasi PHP dan Modal Bootstrap-like. Proses upload foto dilengkapi dengan validasi format (JPG/PNG) dan ukuran file maksimal 2MB untuk menjaga performa server. Setiap aksi penghapusan akan secara otomatis membersihkan file fisik di folder `uploads/` untuk mencegah penumpukan file sampah.
