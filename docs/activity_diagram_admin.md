# Activity Diagram - Panel Admin

Dokumen ini berisi activity diagram untuk berbagai fitur administratif pada panel admin Website Fakultas Ilmu Komputer.

---

## 1. Diagram Otentikasi (Login & Logout)

Diagram ini menggambarkan alur keamanan saat administrator masuk ke sistem.

```mermaid
flowchart TD
    Start([Start]) --> OpenLogin[Admin membuka Halaman Login]
    OpenLogin --> InputCreds[Input Username & Password]
    InputCreds --> ClickLogin[Klik Tombol Login]
    
    ClickLogin --> Verify{Cek Database}
    
    Verify -- "Data Cocok" --> CreateSession[Sistem membuat Session]
    CreateSession --> RedirectDash[Redirect ke Dashboard Admin]
    RedirectDash --> End([End])
    
    Verify -- "Tidak Cocok" --> ShowError[Tampilkan Pesan Error]
    ShowError --> InputCreds
    
    Logout([Logout Action]) --> DestroySession[Sistem menghapus Session]
    DestroySession --> RedirectLogin[Redirect ke Halaman Login]
    RedirectLogin --> LogoutEnd([End])
```

---

## 2. Diagram Manajemen Konten (CRUD Berita/Slider)

Alur umum untuk menambah, mengubah, atau menghapus konten dinamis.

```mermaid
flowchart TD
    Start([Start]) --> OpenModule[Pilih Menu Kelola Berita/Slider]
    OpenModule --> ShowList[Sistem menampilkan Tabel Data]
    
    ShowList --> Action{Pilih Aksi}
    
    Action -- "Tambah" --> FormTambah[Sistem menampilkan Form Input]
    FormTambah --> InputData[Admin mengisi data & upload file]
    InputData --> SaveData[Sistem menyimpan ke Database]
    SaveData --> SuccessMsg[Tampilkan Notifikasi Berhasil]
    
    Action -- "Edit" --> FormEdit[Sistem menampilkan Form dengan Data Lama]
    FormEdit --> UpdateData[Admin memperbarui data]
    UpdateData --> SaveUpdate[Sistem mengupdate Database]
    SaveUpdate --> SuccessMsg
    
    Action -- "Hapus" --> Confirm[Konfirmasi Penghapusan]
    Confirm --> DeleteDB[Sistem menghapus data dari Database]
    DeleteDB --> SuccessMsg
    
    SuccessMsg --> RefreshList[Refresh Tabel Data]
    RefreshList --> End([End])
```

---

## 3. Diagram Pengelolaan Data Akademik & Dosen

Diagram khusus untuk pengelolaan aset pendidik dan kurikulum.

```mermaid
flowchart TD
    Start([Start]) --> OpenAkad[Buka Menu Kelola Dosen/Kurikulum]
    OpenAkad --> FetchData[Sistem mengambil data dari DB]
    FetchData --> ShowData[Tampilkan Daftar Dosen/Mata Kuliah]
    
    ShowData --> Manage{Kelola Data}
    
    Manage -- "Input Baru" --> Validate[Validasi Input & Format File]
    Validate --> DBWrite[Tulis ke Database]
    
    Manage -- "Non-aktifkan/Hapus" --> DBUpdate[Update Status di Database]
    
    DBWrite --> Notify[Kirim Notifikasi Sukses ke UI]
    DBUpdate --> Notify
    Notify --> End([End])
```

---

## 4. Diagram Verifikasi Pendaftaran Mahasiswa Baru

Alur admin saat memproses data pendaftar yang masuk dari sisi publik.

```mermaid
flowchart TD
    Start([Start]) --> OpenReg[Buka Menu Kelola Pendaftaran]
    OpenReg --> ListReg[Sistem menampilkan daftar pendaftar terbaru]
    
    ListReg --> DetailReg[Admin klik Detail Pendaftar]
    DetailReg --> ReviewData[Admin memeriksa berkas & data diri]
    
    ReviewData --> Action{Tindak Lanjut}
    
    Action -- "Valid" --> Contact[Hubungi Pendaftar via WhatsApp/Email]
    Contact --> UpdateStatus[Update Status: Terverifikasi]
    
    Action -- "Tidak Valid" --> DeleteReg[Hapus/Arsip Data]
    
    UpdateStatus --> End([End])
    DeleteReg --> End
```

---

## 5. Diagram Manajemen Kelembagaan (Visi-Misi & Struktur)

```mermaid
flowchart TD
    Start([Start]) --> OpenInst[Buka Menu Visi-Misi/Struktur]
    OpenInst --> ShowEditor[Tampilkan Teks Editor / Upload Gambar]
    
    ShowEditor --> EditContent[Admin memperbarui konten Kelembagaan]
    EditContent --> ClickSave[Klik Simpan Perubahan]
    
    ClickSave --> UpdateLive[Sistem memperbarui tampilan Publik secara Real-time]
    UpdateLive --> End([End])
```

---

### Penjelasan Umum:
Semua proses administratif di atas dilindungi oleh middleware session. Jika session tidak valid atau telah berakhir, sistem secara otomatis akan mengalihkan admin kembali ke halaman login (Flow 1). Setiap perubahan data (Flow 2, 3, 5) akan langsung berdampak pada database dan tercermin pada tampilan pengunjung website.
