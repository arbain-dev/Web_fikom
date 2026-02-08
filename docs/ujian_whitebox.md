# Pengujian White Box (White Box Testing)

Pengujian White Box berfokus pada analisa struktur logika internal kode program. Pengujian ini menggunakan metode **Basis Path Testing** untuk memastikan setiap jalur logika telah dieksekusi setidaknya satu kali.

---

## 1. Unit Pengujian: Autentikasi Login (`admin/proses_login.php`)

### A. Flowchart Logika
```mermaid
graph TD
    A([Start]) --> B{Request Method POST?};
    B -- No --> C[Redirect Login];
    B -- Yes --> D[Ambil Input Data];
    D --> E{Input Kosong?};
    E -- Yes --> F[Redirect Error: Kosong];
    E -- No --> G{Cek Role};
    
    G -- Admin --> H[Set Table users];
    G -- Dosen --> I[Set Table tb_dosen];
    G -- Mhs --> J[Set Table tb_mahasiswa];
    G -- Invalid --> K[Redirect Error: Gagal];
    
    H --> L[Prepare & Execute Query];
    I --> L;
    J --> L;
    
    L --> M{User Ditemukan?};
    M -- No --> N[Redirect Error: User Not Found];
    M -- Yes --> O{Password Verify?};
    
    O -- Invalid --> P[Redirect Error: Wrong Pass];
    O -- Valid --> Q[Set Session & Redirect Dashboard];
    
    C --> Z([End]);
    F --> Z;
    K --> Z;
    N --> Z;
    P --> Z;
    Q --> Z;
```

### B. Kompleksitas Siklomatik (Cyclomatic Complexity)
Rumus: `CC = Predicate Nodes + 1`

*   **Predicate Nodes:**
    1.  `if POST`
    2.  `if empty`
    3.  `if role == admin`
    4.  `elseif role == dosen`
    5.  `elseif role == mahasiswa`
    6.  `if num_rows == 1` (User Found)
    7.  `if password_verify`

**Perhitungan:** `CC = 7 + 1 = 8`

### C. Jalur Pengujian (Basis Path)
| Jalur | Kondisi | Hasil |
|-------|---------|-------|
| 1 | Bukan POST | Redirect Login |
| 2 | Input Kosong | Error "Data Kosong" |
| 3 | Role Tidak Valid | Error "Login Gagal" |
| 4 | User Tidak Ditemukan | Error "User Not Found" |
| 5 | Password Salah | Error "Password Salah" |
| 6 | Login Berhasil (Admin) | Masuk Dashboard Admin |
| 7 | Login Berhasil (Dosen) | Masuk Dashboard Dosen |
| 8 | Login Berhasil (Mhs) | Masuk Dashboard Mhs |

---

## 2. Unit Pengujian: Tambah & Edit Berita (`admin/kelola_berita.php`)

### A. Flowchart Logika (Blok POST)
```mermaid
graph TD
    A([Start POST]) --> B{Validasi Input Empty?};
    B -- Yes --> C[Set Error Message];
    B -- No --> D{Cek Folder Upload};
    D -- Belum Ada --> E[Buat Folder];
    D -- Ada --> F{Action = Tambah?};
    E --> F;
    
    F -- Yes --> G{Ada Foto Upload?};
    G -- Yes --> H[Simpan Foto Baru];
    G -- No --> I[Set Foto Kosong];
    H --> J[Insert Query];
    I --> J;
    
    F -- No (Edit) --> K{Ada Foto Baru?};
    K -- Yes --> L[Upload Foto & Hapus Lama];
    K -- No --> M[Pakai Foto Lama];
    L --> N[Update Query];
    M --> N;
    
    J --> O{Execute Success?};
    N --> O;
    O -- Yes --> P[Set Pesan Sukses];
    O -- No --> Q[Set Pesan Gagal];
    
    C --> Z([End]);
    P --> Z;
    Q --> Z;
```

### B. Kompleksitas Siklomatik
*   **Predicate Nodes:**
    1.  `if empty(judul/kategori)`
    2.  `if !is_dir`
    3.  `if action == tambah`
    4.  `if !empty(files)` (pada blok Tambah)
    5.  `if !empty(files)` (pada blok Edit)
    6.  `if execute`

**Perhitungan:** `CC = 6 + 1 = 7`

### C. Jalur Pengujian
| Jalur | Deskripsi | Hasil Harapan |
|-------|-----------|---------------|
| 1 | Input Kosong | Pesan Error Validasi |
| 2 | Tambah + Foto Ada + Sukses | Data Masuk & Foto Terupload |
| 3 | Tambah + Tanpa Foto + Sukses | Data Masuk (Foto Null) |
| 4 | Edit + Ganti Foto + Sukses | Data Update & Foto Lama Terhapus |
| 5 | Edit + Tanpa Ganti Foto | Data Update (Foto Tetap) |
| 6 | Query Gagal | Pesan Error Database |

---

## 3. Unit Pengujian: Kelola Dosen (`admin/kelola_dosen.php`)

### A. Flowchart Logika (Blok POST & Validasi File)
```mermaid
graph TD
    A([Start POST]) --> B{Validasi Field Wajib?};
    B -- Kosong --> C[Set Error: Field Wajib];
    B -- Lengkap --> D{Ada Upload Foto?};
    
    D -- Yes --> E{Cek Ext & Size?};
    E -- Invalid --> F[Set Error: File Invalid];
    E -- Valid --> G[Upload File];
    D -- No --> H[Pakai Foto Lama/Default];
    
    G --> I{Action = Tambah?};
    H --> I;
    
    I -- Yes --> J[Insert Query];
    I -- No --> K[Update Query];
    
    J --> L{Execute Success?};
    K --> L;
    
    L -- Yes --> M[Redirect Sukses];
    L -- No --> N[Set Error Database];
    
    C --> Z([End]);
    F --> Z;
    M --> Z;
    N --> Z;
```

### B. Kompleksitas Siklomatik
*   **Predicate Nodes:**
    1.  `if empty(input)`
    2.  `if isset(files)`
    3.  `if ext_valid && size_valid`
    4.  `if action == tambah`
    5.  `if execute`

**Perhitungan:** `CC = 5 + 1 = 6`

### C. Jalur Pengujian
| Jalur | Deskripsi | Hasil Harapan |
|-------|-----------|---------------|
| 1 | Input Wajib Kosong | Error Validasi Field |
| 2 | Upload File Salah (PDF/Exe) | Error Validasi File |
| 3 | Tambah Dosen Valid | Redirect Sukses |
| 4 | Edit Dosen Valid | Redirect Sukses |
| 5 | Query Gagal | Error Database |

---

## 4. Unit Pengujian: Update Status Pendaftaran (`admin/kelola_pendaftaran.php`)

### A. Flowchart Logika (Update Status)
```mermaid
graph TD
    A([Start POST Update]) --> B[Ambil ID & Status];
    B --> C[Prepare Query SQL];
    C --> D[Bind Param];
    D --> E{Execute Query?};
    
    E -- Yes --> F[Set Pesan Sukses];
    E -- No --> G[Set Pesan Gagal];
    
    F --> H([Selesai]);
    G --> H;
```

### B. Kompleksitas Siklomatik
*   **Predicate Nodes:**
    1.  `if execute`

**Perhitungan:** `CC = 1 + 1 = 2`

### C. Jalur Pengujian
| Jalur | Deskripsi | Hasil Harapan |
|-------|-----------|---------------|
| 1 | Update Berhasil | Pesan Sukses Muncul |
| 2 | Update Gagal (DB Error) | Pesan Error Muncul |

---

## Kesimpulan
Pengujian White Box telah dilakukan pada 4 modul krusial. Hasil perhitungan **Cyclomatic Complexity** menunjukkan angka rata-rata di bawah 10 (Login=8, Berita=7, Dosen=6, Pendaftaran=2), yang mengindikasikan bahwa struktur logika kode program **efisien, tidak terlalu kompleks, dan mudah untuk dipelihara (maintainable)**.
