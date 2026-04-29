# LAPORAN PENGUJIAN WHITE BOX (WHITE BOX TESTING)

## 01. PENGANTAR PENGUJIAN

Pengujian *White Box* (*Glass Box Testing*) adalah metode pengujian perangkat lunak yang fokus pada verifikasi struktur internal, desain algoritma, dan alur kerja kode program. Tujuan utamanya adalah untuk memastikan bahwa seluruh jalur logika telah dieksekusi setidaknya satu kali, serta mendeteksi adanya kesalahan penulisan maupun celah logika pada percabangan.

Dalam laporan ini, tingkat kompleksitas logika diukur menggunakan metode **Cyclomatic Complexity (V(G))**. Nilai ukuran matematika ini menentukan jumlah jalur independen minimum yang harus diuji untuk menjamin cakupan kode yang lengkap.

---

## 02. UNIT PENGUJIAN 1: MENU LOGIN ADMINISTRATOR (`proses_login.php`)

### 1. Pemetaan Statement dan Node
| Potongan Kode PHP (Statement Code) | Simpul (Node) |
|:---|:---:|
| `if ($_SERVER["REQUEST_METHOD"] == "POST") {` | **1** |
| `$username = $_POST['username']; $password = $_POST['password'];` | **2** |
| `if (empty($username) \|\| empty($password)) {` | **3** |
| `header("location: login?status=kosong"); exit;` | **4** |
| `$sql = "SELECT * FROM users WHERE username = ?"; ... if ($result->num_rows === 1) {` | **5** |
| `if (password_verify($password, $data['password'])) {` | **6** |
| `$_SESSION['login'] = true; header("location: dashboard");` | **7** |
| `header("location: login?status=gagal");` (Password Salah) | **8** |
| `header("location: login?status=gagal");` (User Tidak Ditemukan) | **9** |
| `exit;` (Bukan akses POST / Direct URL) | **10** |
| **End of Script / Logika Usai** | **11** |

### 2. Flowchart
```mermaid
flowchart TD
    1{Akses POST?} -->|Ya| 2[/Input Username & Password/]
    1 -->|Tidak| 10[/Redirect: Ilegal/]
    
    2 --> 3{Input Kosong?}
    3 -->|Ya| 4[/Redirect: Kosong/]
    3 -->|Tidak| 5{User Ditemukan?}
    
    5 -->|Ya| 6{Password Cocok?}
    5 -->|Tidak| 9[/Redirect: Gagal/]
    
    6 -->|Ya| 7[/Akses Dashboard/]
    6 -->|Tidak| 8[/Redirect: Gagal/]
    
    4 --> 11(((Stop)))
    7 --> 11
    8 --> 11
    9 --> 11
    10 --> 11
```

### 3. Flowgraph
```mermaid
graph TD
    classDef predicate fill:#f9a8d4,stroke:#be185d,stroke-width:2px;
    classDef region fill:#fff4dd,stroke:#d4a017,stroke-dasharray: 5 5;

    1((1)):::predicate -->|Ya| 2((2))
    1 -->|Tidak / R1| 10((10))
    2 --> 3((3)):::predicate
    3 -->|Ya / R2| 4((4))
    3 -->|Tidak| 5((5)):::predicate
    5 -->|Ya| 6((6)):::predicate
    5 -->|Tidak / R3| 9((9))
    6 -->|Ya / R5| 7((7))
    6 -->|Tidak / R4| 8((8))
    4 & 7 & 8 & 9 & 10 --> 11(((11)))

    subgraph Region_Analisis
        R1[Region 1]:::region
        R2[Region 2]:::region
        R3[Region 3]:::region
        R4[Region 4]:::region
        R5[Region 5]:::region
    end
```

Dari flowgraph tersebut didapatkan:

**Diketahui:**
* Region (R) = 5
* Node (N) = 11
* Edge (E) = 14
* Predicate Node (P) = 4

#### 4. Perhitungan Cyclomatic Complexity dari Edge dan Node
**Diketahui:**
* Edge (E) = 14
* Node (N) = 11

**Rumus:**
$$V(G) = E - N + 2$$

**Perhitungan:**
$$V(G) = 14 - 11 + 2 = \mathbf{5}$$

Jadi, nilai Cyclomatic Complexity dari flowgraph tersebut adalah **5**.

#### 5. Perhitungan Cyclomatic Complexity dari Predicate Node (P)
**Diketahui:**
* Predicate Node (P) = 4 (yaitu Node 1, Node 3, Node 5, dan Node 6)

**Rumus:**
$$V(G) = P + 1$$

**Perhitungan:**
$$V(G) = 4 + 1 = \mathbf{5}$$

#### 6. Independent Path (5 Jalur Independen)
Karena nilai V(G) = 5, maka terdapat 5 Independent Path, yaitu:

**Tabel 4.10 Independent Path Autentikasi Login**

| Region | Independent Path |
|:---:|:---|
| **R1** | Start → 1 → 10 → 11 → End |
| **R2** | Start → 1 → 2 → 3 → 4 → 11 → End |
| **R3** | Start → 1 → 2 → 3 → 5 → 9 → 11 → End |
| **R4** | Start → 1 → 2 → 3 → 5 → 6 → 8 → 11 → End |
| **R5** | Start → 1 → 2 → 3 → 5 → 6 → 7 → 11 → End |

Berdasarkan hasil perhitungan Cyclomatic Complexity dan pengujian terhadap lima jalur independen yang ada, dapat disimpulkan bahwa seluruh alur logika dalam modul login telah berjalan dengan benar dan tidak ditemukan kesalahan pada struktur kontrolnya. Dengan demikian, pengujian white-box terhadap modul ini dinyatakan **berhasil**.

---

## 03. UNIT PENGUJIAN 2: MENU PENDAFTARAN MAHASISWA (`proses_pendaftaran.php`)

### 1. Pemetaan Statement dan Node
| Potongan Kode PHP (Statement Code) | Simpul (Node) |
|:---|:---:|
| `if ($_SERVER["REQUEST_METHOD"] == "POST") {` | **1** |
| `if (CSRF_TOKEN_INVALID) {` | **2** |
| `die("Invalid Token");` | **3** |
| `$nama = $_POST['nama']; $nik = $_POST['nik']; dll` | **4** |
| `if (empty($nama) \|\| empty($nik)) {` | **5** |
| `$msg = "Lengkapi data wajib!";` | **6** |
| `if ($query_execute) {` | **7** |
| `$msg = "Berhasil";` | **8** |
| `$msg = "Gagal Query";` | **9** |
| `exit;` (Akses GET) | **10** |
| **Selesai** | **11** |

### 2. Flowchart
```mermaid
flowchart TD
    1{Akses POST?} -->|Ya| 2{Token Valid?}
    1 -->|Tidak| 10[/Tampil Form/]
    
    2 -->|Tidak| 3[/Sistem Die/]
    2 -->|Ya| 4[/Input Data Pendaftaran/]
    
    4 --> 5{Input Kosong?}
    5 -->|Ya| 6[/Pesan: Error/]
    5 -->|Tidak| 7{Simpan DB?}
    
    7 -->|Ya| 8[/Pesan: Sukses/]
    7 -->|Tidak| 9[/Pesan: Gagal/]
    
    3 --> 11(((Stop)))
    6 --> 11
    8 --> 11
    9 --> 11
    10 --> 11
```

### 3. Flowgraph
```mermaid
graph TD
    classDef predicate fill:#f9a8d4,stroke:#be185d,stroke-width:2px;
    classDef region fill:#fff4dd,stroke:#d4a017,stroke-dasharray: 5 5;

    1((1)):::predicate -->|Ya| 2((2)):::predicate
    1 -->|Tidak / R1| 10((10))
    2 -->|Salah / R2| 3((3))
    2 -->|Benar| 4((4))
    4 --> 5((5)):::predicate
    5 -->|Ya / R3| 6((6))
    5 -->|Tidak| 7((7)):::predicate
    7 -->|Ya / R5| 8((8))
    7 -->|Tidak / R4| 9((9))
    3 & 6 & 8 & 9 & 10 --> 11(((11)))

    subgraph Region_Analisis
        R1[Region 1]:::region
        R2[Region 2]:::region
        R3[Region 3]:::region
        R4[Region 4]:::region
        R5[Region 5]:::region
    end
```

Dari flowgraph tersebut didapatkan:

**Diketahui:**
* Region (R) = 5
* Node (N) = 11
* Edge (E) = 14
* Predicate Node (P) = 4

#### 4. Perhitungan Cyclomatic Complexity dari Edge dan Node
**Diketahui:**
* Edge (E) = 14
* Node (N) = 11

**Rumus:**
$$V(G) = E - N + 2$$

**Perhitungan:**
$$V(G) = 14 - 11 + 2 = \mathbf{5}$$

Jadi, nilai Cyclomatic Complexity dari flowgraph tersebut adalah **5**.

#### 5. Perhitungan Cyclomatic Complexity dari Predicate Node (P)
**Diketahui:**
* Predicate Node (P) = 4 (yaitu Node 1, Node 2, Node 5, dan Node 7)

**Rumus:**
$$V(G) = P + 1$$

**Perhitungan:**
$$V(G) = 4 + 1 = \mathbf{5}$$

#### 6. Independent Path (5 Jalur Independen)
Karena nilai V(G) = 5, maka terdapat 5 Independent Path, yaitu:

**Tabel 4.11 Independent Path Pendaftaran Mahasiswa**

| Region | Independent Path |
|:---:|:---|
| **R1** | Start → 1 → 10 → 11 → End |
| **R2** | Start → 1 → 2 → 3 → 11 → End |
| **R3** | Start → 1 → 2 → 4 → 5 → 6 → 11 → End |
| **R4** | Start → 1 → 2 → 4 → 5 → 7 → 9 → 11 → End |
| **R5** | Start → 1 → 2 → 4 → 5 → 7 → 8 → 11 → End |

Berdasarkan hasil pengujian terhadap lima jalur independen di atas, disimpulkan bahwa alur logika modul pendaftaran telah berjalan sesuai rancangan sistem. Pengamanan token dan validasi data berhasil menangani setiap kondisi input dengan benar. Dengan demikian, pengujian white-box dinyatakan **berhasil**.

---

## 04. UNIT PENGUJIAN 3: MENU KELOLA DATA DOSEN (`kelola_dosen.php`)

### 1. Pemetaan Statement dan Node
| Potongan Kode PHP (Statement Code) | Simpul (Node) |
|:---|:---:|
| `if (isset($_POST['simpan'])) {` | **1** |
| `$nidn = $_POST['nidn']; $nama = $_POST['nama']; dll` | **2** |
| `if (empty($nidn) \|\| empty($nama)) {` | **3** |
| `Error: Input Kosong` | **4** |
| `if (ADA_FOTO)` | **5** |
| `Upload Foto + SQL` | **6** |
| `SQL Tanpa Foto` | **7** |
| `if ($execute)` | **8** |
| `Success Message` | **9** |
| `Error Message` | **10** |
| `No POST Action` | **11** |
| **End** | **12** |

### 2. Flowchart
```mermaid
flowchart TD
    1{Simpan?} -->|Ya| 2[/Input Data Dosen/]
    1 -->|Tidak| 11[/Tetap Tampil/]
    
    2 --> 3{Kosong?}
    3 -->|Ya| 4[/Pesan: Error/]
    3 -->|Tidak| 5{Ada Foto?}
    
    5 -->|Ya| 6[Proses Foto]
    5 -->|Tidak| 7[Proses Biasa]
    
    6 --> 8{Eksekusi?}
    7 --> 8
    
    8 -->|Ya| 9[/Notif: Sukses/]
    8 -->|Tidak| 10[/Notif: Gagal/]
    
    4 --> 12(((Stop)))
    9 --> 12
    10 --> 12
    11 --> 12
```

### 3. Flowgraph
```mermaid
graph TD
    classDef predicate fill:#f9a8d4,stroke:#be185d,stroke-width:2px;
    classDef region fill:#fff4dd,stroke:#d4a017,stroke-dasharray: 5 5;

    1((1)):::predicate -->|Simpan| 2((2))
    1 -->|Batal / R1| 11((11))
    2 --> 3((3)):::predicate
    3 -->|Kosong / R2| 4((4))
    3 -->|Isi| 5((5)):::predicate
    5 -->|Foto| 6((6))
    5 -->|No Foto| 7((7))
    6 --> 8((8)):::predicate
    7 --> 8
    8 -->|Ya / R5| 9((9))
    8 -->|Tidak / R4| 10((10))
    4 & 9 & 10 & 11 --> 12(((12)))

    subgraph Region_Analisis
        R1[Region 1]:::region
        R2[Region 2]:::region
        R3[Region 3]:::region
        R4[Region 4]:::region
        R5[Region 5]:::region
    end
```

Dari flowgraph tersebut didapatkan:

**Diketahui:**
* Region (R) = 5
* Node (N) = 12
* Edge (E) = 15
* Predicate Node (P) = 4

#### 4. Perhitungan Cyclomatic Complexity dari Edge dan Node
**Diketahui:**
* Edge (E) = 15
* Node (N) = 12

**Rumus:**
$$V(G) = E - N + 2$$

**Perhitungan:**
$$V(G) = 15 - 12 + 2 = \mathbf{5}$$

Jadi, nilai Cyclomatic Complexity dari flowgraph tersebut adalah **5**.

#### 5. Perhitungan Cyclomatic Complexity dari Predicate Node (P)
**Diketahui:**
* Predicate Node (P) = 4 (yaitu Node 1, Node 3, Node 5, dan Node 8)

**Rumus:**
$$V(G) = P + 1$$

**Perhitungan:**
$$V(G) = 4 + 1 = \mathbf{5}$$

#### 6. Independent Path (5 Jalur Independen)
Karena nilai V(G) = 5, maka terdapat 5 Independent Path, yaitu:

**Tabel 4.12 Independent Path Kelola Data Dosen**

| Region | Independent Path |
|:---:|:---|
| **R1** | Start → 1 → 11 → 12 → End |
| **R2** | Start → 1 → 2 → 3 → 4 → 12 → End |
| **R3** | Start → 1 → 2 → 3 → 5 → [6/7] → 8 → 10 → 12 → End |
| **R4** | Start → 1 → 2 → 3 → 5 → 7 → 8 → 9 → 12 → End |
| **R5** | Start → 1 → 2 → 3 → 5 → 6 → 8 → 9 → 12 → End |

Berdasarkan analisis terhadap modul kelola data dosen, seluruh jalur eksekusi kritis telah diuji dan menunjukkan hasil yang konsisten. Penanganan file upload dan integrasi database berjalan optimal sesuai dengan jalur independen yang ditetapkan. Pengujian white-box dinyatakan **berhasil**.

---

## 05. KESIMPULAN AKHIR

| Modul Pengujian | Skor V(G) | Jalur Independen | Status |
|:---|:---:|:---:|:---:|
| **Menu Login Administrator** | 5 | 5 Jalur | **Sukses** |
| **Menu Pendaftaran Mahasiswa** | 5 | 5 Jalur | **Sukses** |
| **Menu Kelola Data Dosen** | 5 | 5 Jalur | **Sukses** |

**Kesimpulan:** Seluruh alur logika program dinyatakan **VALID** dan **BERHASIL**. Sistem telah terbebas dari kesalahan struktur kontrol dan sanggup menangani setiap kondisi input pengguna secara akurat.
