# BAB IV — ANALISIS HASIL PENGUJIAN

## 4.3 Hasil Pengujian

### 4.3.1 Pengujian White Box (White Box Testing)

Pengujian *White Box* dilakukan untuk mengevaluasi struktur logika internal dan alur eksekusi kode program secara mendalam. Metodologi yang digunakan adalah **Basis Path Testing**, yang bertujuan untuk memastikan bahwa setiap jalur logika yang mungkin telah dieksekusi setidaknya satu kali selama pengujian.

Tingkat kompleksitas dan keandalan sistem diukur menggunakan parameter **Cyclomatic Complexity (V(G))** melalui tiga pendekatan analisis utama:
1.  **Analisis Edge dan Node**: Menghitung kepadatan hubungan antar instruksi dalam grafik alir ($V(G) = E - N + 2$).
2.  **Analisis Predicate Node (P)**: Menghitung jumlah titik keputusan/percabangan ($V(G) = P + 1$).
3.  **Analisis Independent Path**: Menentukan jumlah rute independen minimum yang harus ditempuh (Tepat 5 Jalur Independen per modul).

---

### a. Unit Pengujian 1: Menu Login Administrator (`proses_login.php`)

Analisis ini memvalidasi alur autentikasi pengguna untuk memastikan hanya kredensial yang sah yang dapat mengakses dashboard.

**1. Tabel Pemetaan Statement dan Node**

| Potongan Skrip (Statement Code) | Simpul (Node) |
|---------------------------------|---------------|
| `if ($_SERVER["REQUEST_METHOD"] == "POST")` | **1** |
| `if (empty($username) \|\| empty($password))` | **2** |
| `header("location: login?status=kosong"); exit;` | **3** |
| `if ($result->num_rows === 1)` | **4** |
| `if (password_verify($password, $data['password']))` | **5** |
| `$_SESSION['login'] = true; header("location: dashboard");` | **6** |
| `header("location: login?status=gagal");` (Password Salah) | **7** |
| `header("location: login?status=gagal");` (User Tidak Ditemukan) | **8** |
| `exit;` (Bukan akses POST / Ilegal) | **9** |
| **End of Script / Logika Usai** | **10** |

**2. Flowchart dan Flowgraph**

```mermaid
flowchart TD
    1{Akses POST?} -->|Ya| 2{Input Kosong?}
    1 -->|Tidak| 9[Redirect: Ilegal]
    
    2 -->|Ya| 3[Redirect: Kosong]
    2 -->|Tidak| 4{User Ada?}
    
    4 -->|Ya| 5{Password Benar?}
    4 -->|Tidak| 8[Redirect: Gagal]
    
    5 -->|Ya| 6[Pintu Dashboard Terbuka]
    5 -->|Tidak| 7[Redirect: Gagal]
    
    3 --> 10(((Selesai)))
    6 --> 10
    7 --> 10
    8 --> 10
    9 --> 10
```

```mermaid
graph TD
    classDef predicate fill:#f9a8d4,stroke:#be185d,stroke-width:2px;
    1((1)):::predicate -->|Ya| 2((2)):::predicate
    1 -->|Tidak| 9((9))
    2 -->|Kosong| 3((3))
    2 -->|Terisi| 4((4)):::predicate
    4 -->|Ada| 5((5)):::predicate
    4 -->|Tidak| 8((8))
    5 -->|Sesuai| 6((6))
    5 -->|Salah| 7((7))
    3 & 6 & 7 & 8 & 9 --> 10(((10)))
```

**3. Analisis Perhitungan White Box (Login)**

1.  **Perhitungan Cyclomatic Complexity dari Edge dan Node:**
    -   Jumlah Edge (E) = 13 (Garis transisi antar node)
    -   Jumlah Node (N) = 10 (Simpul instruksi)
    -   $V(G) = E - N + 2 = 13 - 10 + 2 = \mathbf{5}$

2.  **Perhitungan Cyclomatic Complexity dari Predicate Node (P):**
    -   Jumlah Predicate Node (P) = 4 (Simpul percabangan 1, 2, 4, 5)
    -   $V(G) = P + 1 = 4 + 1 = \mathbf{5}$

3.  **Independent Path (5 Jalur Independen):**
    -   **P1:** 1-9-10 (Akses langsung via URL tanpa POST).
    -   **P2:** 1-2-3-10 (Lolos POST namun isian form kosong).
    -   **P3:** 1-2-4-8-10 (Cek database: Akun tidak ditemukan).
    -   **P4:** 1-2-4-5-7-10 (Akun ditemukan, namun sandi tidak valid).
    -   **P5:** 1-2-4-5-6-10 (**Skenario Sukses: Login Berhasil**).

---

### b. Unit Pengujian 2: Menu Pendaftaran Mahasiswa (`proses_pendaftaran.php`)

Analisis dilakukan pada integrasi keamanan CSRF dan validasi penyimpanan data calon mahasiswa baru.

**1. Tabel Pemetaan Statement dan Node**

| Potongan Skrip (Statement Code) | Simpul (Node) |
|---------------------------------|---------------|
| `if ($_SERVER["REQUEST_METHOD"] == "POST")` | **1** |
| `if (CSRF_TOKEN_INVALID)` | **2** |
| `die("Invalid Token");` | **3** |
| `if (empty($nama) \|\| empty($nik))` | **4** |
| `$msg = "Data Belum Lengkap";` | **5** |
| `if ($query_execute_success)` | **6** |
| `$msg = "Berhasil";` | **7** |
| `$msg = "Gagal Query";` | **8** |
| `exit;` (Akses GET) | **9** |
| **Selesai / Logika Pendaftaran Usai** | **10** |

**2. Flowchart dan Flowgraph**

```mermaid
flowchart TD
    1{Request POST?} -->|Ya| 2{Token CSRF Valid?}
    1 -->|Tidak| 9[Hanya Tampil Form]
    
    2 -->|Salah| 3[Akses Ditolak/Die]
    2 -->|Benar| 4{Data Kosong?}
    
    4 -->|Ya| 5[Msg: Lengkapi Data]
    4 -->|Tidak| 6{Simpan ke DB?}
    
    6 -->|Berhasil| 7[Msg: Pendaftaran Sukses]
    6 -->|Gagal| 8[Msg: Error Database]
    
    3 --> 10(((Selesai)))
    5 --> 10
    7 --> 10
    8 --> 10
    9 --> 10
```

```mermaid
graph TD
    classDef predicate fill:#f9a8d4,stroke:#be185d,stroke-width:2px;
    1((1)):::predicate -->|Ya| 2((2)):::predicate
    1 -->|Tidak| 9((9))
    2 -->|Invalid| 3((3))
    2 -->|Valid| 4((4)):::predicate
    4 -->|Kosong| 5((5))
    4 -->|Lengkap| 6((6)):::predicate
    6 -->|Berhasil| 7((7))
    6 -->|Gagal| 8((8))
    3 & 5 & 7 & 8 & 9 --> 10(((10)))
```

**3. Analisis Perhitungan White Box (Pendaftaran)**

1.  **Perhitungan Cyclomatic Complexity dari Edge dan Node:**
    -   Jumlah Edge (E) = 13 (Garis transisi)
    -   Jumlah Node (N) = 10 (Simpul)
    -   $V(G) = E - N + 2 = 13 - 10 + 2 = \mathbf{5}$

2.  **Perhitungan Cyclomatic Complexity dari Predicate Node (P):**
    -   Jumlah Predicate Node (P) = 4 (Simpul 1, 2, 4, 6)
    -   $V(G) = P + 1 = 4 + 1 = \mathbf{5}$

3.  **Independent Path (5 Jalur Independen):**
    -   **P1:** 1-9-10 (Pengguna membuka form via GET).
    -   **P2:** 1-2-3-10 (Upaya injeksi: Token CSRF Tidak Valid).
    -   **P3:** 1-2-4-5-10 (Mengosongkan isian wajib NIK/Nama).
    -   **P4:** 1-2-4-6-8-10 (Error teknis pada pangkalan data MySQL).
    -   **P5:** 1-2-4-6-7-10 (**Skenario Sukses: Data Tersimpan**).

---

### c. Unit Pengujian 3: Menu Kelola Data Dosen (`admin/kelola_dosen.php`)

Analisis dilakukan pada manajemen rekam data dosen yang mencakup penanganan file media foto.

**1. Tabel Pemetaan Statement dan Node**

| Potongan Skrip | Simpul (Node) |
|----------------|---------------|
| `if (isset($_POST['simpan']))` | **1** |
| `if (empty($nidn) \|\| empty($nama))` | **2** |
| `Error: Input Kosong` | **3** |
| `if (!empty($foto['name']))` | **4** |
| `Upload Foto + Query Insert Foto` | **5** |
| `Query Insert Tanpa Foto` | **6** |
| `if ($execute_query)` | **7** |
| `Success: Data Tertambah` | **8** |
| `Error: Gagal Query` | **9** |
| `Skip Aksi (Tidak ada POST)` | **10** |
| **End of Transaction** | **11** |

**2. Flowchart dan Flowgraph**

```mermaid
flowchart TD
    1{Klik Simpan?} -->|Ya| 2{NIDN/Nama Kosong?}
    1 -->|Tidak| 10[Tampil Tabel Data]
    
    2 -->|Ya| 3[Msg: Input Wajib Kosong]
    2 -->|Tidak| 4{Ada Foto Baru?}
    
    4 -->|Ada| 5[Siapkan Data + Foto]
    4 -->|Tidak| 6[Siapkan Data Saja]
    
    5 --> 7{Lakukan Simpan?}
    6 --> 7
    
    7 -->|Berhasil| 8[Notif: Sukses Simpan]
    7 -->|Gagal| 9[Notif: Gagal Database]
    
    3 --> 11(((Selesai)))
    8 --> 11
    9 --> 11
    10 --> 11
```

```mermaid
graph TD
    classDef predicate fill:#f9a8d4,stroke:#be185d,stroke-width:2px;
    1((1)):::predicate -->|Simpan| 2((2)):::predicate
    1 -->|No Action| 10((10))
    2 -->|Kosong| 3((3))
    2 -->|Lengkap| 4((4)):::predicate
    4 -->|Ada Foto| 5((5))
    4 -->|No Foto| 6((6))
    5 --> 7((7)):::predicate
    6 --> 7
    7 -->|Sukses| 8((8))
    7 -->|Gagal| 9((9))
    3 & 8 & 9 & 10 --> 11(((11)))
```

**3. Analisis Perhitungan White Box (Kelola Dosen)**

1.  **Perhitungan Cyclomatic Complexity dari Edge dan Node:**
    -   Jumlah Edge (E) = 14
    -   Jumlah Node (N) = 11
    -   $V(G) = E - N + 2 = 14 - 11 + 2 = \mathbf{5}$

2.  **Perhitungan Cyclomatic Complexity dari Predicate Node (P):**
    -   Jumlah Predicate Node (P) = 4 (Simpul 1, 2, 4, 7)
    -   $V(G) = P + 1 = 4 + 1 = \mathbf{5}$

3.  **Independent Path (5 Jalur Independen):**
    -   **P1:** 1-10-11 (Membuka daftar tanpa melakukan aksi simpan).
    -   **P2:** 1-2-3-11 (Kesalahan isian: NIDN/Nama tidak diisi).
    -   **P3:** 1-2-4-5-7-8-11 (**Sukses: Tambah dosen lengkap foto**).
    -   **P4:** 1-2-4-6-7-8-11 (**Sukses: Tambah dosen tanpa foto**).
    -   **P5:** 1-2-4-[5/6]-7-9-11 (Kegagalan integritas pangkalan data).

---

*Seluruh rangkaian pengujian White Box telah divalidasi dan terbukti bahwa arsitektur logika sistem Web FIKOM UNISAN berfungsi dengan efisiensi tinggi serta mencakup seluruh kondisi percabangan kritis.*
