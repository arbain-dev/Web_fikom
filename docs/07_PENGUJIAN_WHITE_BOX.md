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
| `if (empty($username) \|\| empty($password)) {` | **2** |
| `header("location: login?status=kosong"); exit;` | **3** |
| `$sql = "SELECT * FROM users WHERE username = ?"; ... if ($result->num_rows === 1) {` | **4** |
| `if (password_verify($password, $data['password'])) {` | **5** |
| `$_SESSION['login'] = true; header("location: dashboard");` | **6** |
| `header("location: login?status=gagal");` (Password Salah) | **7** |
| `header("location: login?status=gagal");` (User Tidak Ditemukan) | **8** |
| `exit;` (Bukan akses POST / Direct URL) | **9** |
| **End of Script / Logika Usai** | **10** |

### 2. Flowchart
```mermaid
flowchart TD
    1{Akses POST?} -->|Ya| 2{Input Kosong?}
    1 -->|Tidak| 9[Redirect: Ilegal]
    
    2 -->|Ya| 3[Redirect: Kosong]
    2 -->|Tidak| 4{User Ditemukan?}
    
    4 -->|Ya| 5{Password Cocok?}
    4 -->|Tidak| 8[Redirect: Gagal]
    
    5 -->|Ya| 6[Akses Dashboard]
    5 -->|Tidak| 7[Redirect: Gagal]
    
    3 --> 10(((Stop)))
    6 --> 10
    7 --> 10
    8 --> 10
    9 --> 10
```

### 3. Flowgraph
```mermaid
graph TD
    classDef predicate fill:#f9a8d4,stroke:#be185d,stroke-width:2px;
    classDef region fill:#fff4dd,stroke:#d4a017,stroke-dasharray: 5 5;

    1((1)):::predicate -->|Ya| 2((2)):::predicate
    1 -->|Tidak / R1| 9((9))
    2 -->|Ya / R2| 3((3))
    2 -->|Tidak| 4((4)):::predicate
    4 -->|Ya| 5((5)):::predicate
    4 -->|Tidak / R3| 8((8))
    5 -->|Ya / R5| 6((6))
    5 -->|Tidak / R4| 7((7))
    3 & 6 & 7 & 8 & 9 --> 10(((10)))

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
* Node (N) = 10
* Edge (E) = 13
* Predicate Node (P) = 4

#### 4. Perhitungan Cyclomatic Complexity dari Edge dan Node
**Diketahui:**
* Edge (E) = 13
* Node (N) = 10

**Rumus:**
$$V(G) = E - N + 2$$

**Perhitungan:**
$$V(G) = 13 - 10 + 2 = \mathbf{5}$$

Jadi, nilai Cyclomatic Complexity dari flowgraph tersebut adalah **5**.

#### 5. Perhitungan Cyclomatic Complexity dari Predicate Node (P)
**Diketahui:**
* Predicate Node (P) = 4 (yaitu Node 1, Node 2, Node 4, dan Node 5)

**Rumus:**
$$V(G) = P + 1$$

**Perhitungan:**
$$V(G) = 4 + 1 = \mathbf{5}$$

> [!NOTE]
> Nilai V(G) menunjukkan jumlah jalur independen minimum yang harus diuji untuk memastikan cakupan logika yang lengkap. Dalam modul login ini, kedua metode menghasilkan nilai V(G) = 5 yang konsisten.

#### 6. Independent Path (5 Jalur Independen)
Karena nilai V(G) = 5, maka terdapat 5 Independent Path, yaitu:

**Tabel 4.10 Independent Path Autentikasi Login**

| Region | Independent Path |
|:---:|:---|
| **R1** | Start - 1 - 9 - 10 (Akses login ilegal via URL) |
| **R2** | Start - 1 - 2 - 3 - 10 (Gagal: Isian form kosong) |
| **R3** | Start - 1 - 2 - 4 - 8 - 10 (Gagal: User tidak ditemukan) |
| **R4** | Start - 1 - 2 - 4 - 5 - 7 - 10 (Gagal: Password salah) |
| **R5** | Start - 1 - 2 - 4 - 5 - 6 - 10 (**Berhasil: Login sukses**) |

Berdasarkan hasil perhitungan Cyclomatic Complexity dan pengujian terhadap lima jalur independen yang ada, dapat disimpulkan bahwa seluruh alur logika dalam modul login telah berjalan dengan benar dan tidak ditemukan kesalahan pada struktur kontrolnya. Dengan demikian, pengujian white-box terhadap modul ini dinyatakan **berhasil**.

---

## 03. UNIT PENGUJIAN 2: MENU PENDAFTARAN MAHASISWA (`proses_pendaftaran.php`)

### 1. Pemetaan Statement dan Node
| Potongan Kode PHP (Statement Code) | Simpul (Node) |
|:---|:---:|
| `if ($_SERVER["REQUEST_METHOD"] == "POST") {` | **1** |
| `if (CSRF_TOKEN_INVALID) {` | **2** |
| `die("Invalid Token");` | **3** |
| `if (empty($nama) \|\| empty($nik)) {` | **4** |
| `$msg = "Lengkapi data wajib!";` | **5** |
| `if ($query_execute) {` | **6** |
| `$msg = "Berhasil";` | **7** |
| `$msg = "Gagal Query";` | **8** |
| `exit;` (Akses GET) | **9** |
| **Selesai** | **10** |

### 2. Flowchart
```mermaid
flowchart TD
    1{Akses POST?} -->|Ya| 2{Token Valid?}
    1 -->|Tidak| 9[Tampil Form]
    
    2 -->|Tidak| 3[Sistem Die]
    2 -->|Ya| 4{Input Kosong?}
    
    4 -->|Ya| 5[Pesan: Error]
    4 -->|Tidak| 6{Simpan DB?}
    
    6 -->|Ya| 7[Pesan: Sukses]
    6 -->|Tidak| 8[Pesan: Gagal]
    
    3 --> 10(((Stop)))
    5 --> 10
    7 --> 10
    8 --> 10
    9 --> 10
```

### 3. Flowgraph
```mermaid
graph TD
    classDef predicate fill:#f9a8d4,stroke:#be185d,stroke-width:2px;
    classDef region fill:#fff4dd,stroke:#d4a017,stroke-dasharray: 5 5;

    1((1)):::predicate -->|Ya| 2((2)):::predicate
    1 -->|Tidak / R1| 9((9))
    2 -->|Salah / R2| 3((3))
    2 -->|Benar| 4((4)):::predicate
    4 -->|Ya / R3| 5((5))
    4 -->|Tidak| 6((6)):::predicate
    6 -->|Ya / R5| 7((7))
    6 -->|Tidak / R4| 8((8))
    3 & 5 & 7 & 8 & 9 --> 10(((10)))

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
* Node (N) = 10
* Edge (E) = 13
* Predicate Node (P) = 4

#### 4. Perhitungan Cyclomatic Complexity dari Edge dan Node
**Diketahui:**
* Edge (E) = 13
* Node (N) = 10

**Rumus:**
$$V(G) = E - N + 2$$

**Perhitungan:**
$$V(G) = 13 - 10 + 2 = \mathbf{5}$$

Jadi, nilai Cyclomatic Complexity dari flowgraph tersebut adalah **5**.

#### 5. Perhitungan Cyclomatic Complexity dari Predicate Node (P)
**Diketahui:**
* Predicate Node (P) = 4 (yaitu Node 1, Node 2, Node 4, dan Node 6)

**Rumus:**
$$V(G) = P + 1$$

**Perhitungan:**
$$V(G) = 4 + 1 = \mathbf{5}$$

#### 6. Independent Path (5 Jalur Independen)
Karena nilai V(G) = 5, maka terdapat 5 Independent Path, yaitu:

**Tabel 4.11 Independent Path Pendaftaran Mahasiswa**

| Region | Independent Path |
|:---:|:---|
| **R1** | Start - 1 - 9 - 10 (Akses form via GET) |
| **R2** | Start - 1 - 2 - 3 - 10 (Serangan CSRF / Token Ilegal) |
| **R3** | Start - 1 - 2 - 4 - 5 - 10 (Gagal: Isian data tidak lengkap) |
| **R4** | Start - 1 - 2 - 4 - 6 - 8 - 10 (Gagal: Kesalahan database) |
| **R5** | Start - 1 - 2 - 4 - 6 - 7 - 10 (**Berhasil: Pendaftaran selesai**) |

Berdasarkan hasil pengujian terhadap lima jalur independen di atas, disimpulkan bahwa alur logika modul pendaftaran telah berjalan sesuai rancangan sistem. Pengamanan token dan validasi data berhasil menangani setiap kondisi input dengan benar. Dengan demikian, pengujian white-box dinyatakan **berhasil**.

---

## 04. UNIT PENGUJIAN 3: MENU KELOLA DATA DOSEN (`kelola_dosen.php`)

### 1. Pemetaan Statement dan Node
| Potongan Kode PHP (Statement Code) | Simpul (Node) |
|:---|:---:|
| `if (isset($_POST['simpan'])) {` | **1** |
| `if (empty($nidn) \|\| empty($nama)) {` | **2** |
| `Error: Input Kosong` | **3** |
| `if (ADA_FOTO)` | **4** |
| `Upload Foto + SQL` | **5** |
| `SQL Tanpa Foto` | **6** |
| `if ($execute)` | **7** |
| `Success Message` | **8** |
| `Error Message` | **9** |
| `No POST Action` | **10** |
| **End** | **11** |

### 2. Flowchart
```mermaid
flowchart TD
    1{Simpan?} -->|Ya| 2{Kosong?}
    1 -->|Tidak| 10[Tetap Tampil]
    
    2 -->|Ya| 3[Pesan: Error]
    2 -->|Tidak| 4{Ada Foto?}
    
    4 -->|Ya| 5[Proses Foto]
    4 -->|Tidak| 6[Proses Biasa]
    
    5 --> 7{Eksekusi?}
    6 --> 7
    
    7 -->|Ya| 8[Notif: Sukses]
    7 -->|Tidak| 9[Notif: Gagal]
    
    3 --> 11(((Stop)))
    8 --> 11
    9 --> 11
    10 --> 11
```

### 3. Flowgraph
```mermaid
graph TD
    classDef predicate fill:#f9a8d4,stroke:#be185d,stroke-width:2px;
    classDef region fill:#fff4dd,stroke:#d4a017,stroke-dasharray: 5 5;

    1((1)):::predicate -->|Simpan| 2((2)):::predicate
    1 -->|Batal / R1| 10((10))
    2 -->|Kosong / R2| 3((3))
    2 -->|Isi| 4((4)):::predicate
    4 -->|Foto| 5((5))
    4 -->|No Foto| 6((6))
    5 --> 7((7)):::predicate
    6 --> 7
    7 -->|Ya / R4| 8((8))
    7 -->|Tidak / R3| 9((9))
    3 & 8 & 9 & 10 --> 11(((11)))

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
* Predicate Node (P) = 4 (yaitu Node 1, Node 2, Node 4, dan Node 7)

**Rumus:**
$$V(G) = P + 1$$

**Perhitungan:**
$$V(G) = 4 + 1 = \mathbf{5}$$

#### 6. Independent Path (5 Jalur Independen)
Karena nilai V(G) = 5, maka terdapat 5 Independent Path, yaitu:

**Tabel 4.12 Independent Path Kelola Data Dosen**

| Region | Independent Path |
|:---:|:---|
| **R1** | Start - 1 - 10 - 11 (Membuka tabel tanpa aksi simpan) |
| **R2** | Start - 1 - 2 - 3 - 11 (Gagal: NIDN atau Nama kosong) |
| **R3** | Start - 1 - 2 - 4 - [5/6] - 7 - 9 - 11 (Gagal: Error database) |
| **R4** | Start - 1 - 2 - 4 - 6 - 7 - 8 - 11 (**Berhasil: Simpan tanpa foto**) |
| **R5** | Start - 1 - 2 - 4 - 5 - 7 - 8 - 11 (**Berhasil: Simpan dengan foto**) |

Berdasarkan analisis terhadap modul kelola data dosen, seluruh jalur eksekusi kritis telah diuji dan menunjukkan hasil yang konsisten. Penanganan file upload dan integrasi database berjalan optimal sesuai dengan jalur independen yang ditetapkan. Pengujian white-box dinyatakan **berhasil**.

---

## 05. KESIMPULAN AKHIR

| Modul Pengujian | Skor V(G) | Jalur Independen | Status |
|:---|:---:|:---:|:---:|
| **Menu Login Administrator** | 5 | 5 Jalur | **Sukses** |
| **Menu Pendaftaran Mahasiswa** | 5 | 5 Jalur | **Sukses** |
| **Menu Kelola Data Dosen** | 5 | 5 Jalur | **Sukses** |

**Kesimpulan:** Seluruh alur logika program dinyatakan **VALID** dan **BERHASIL**. Sistem telah terbebas dari kesalahan struktur kontrol dan sanggup menangani setiap kondisi input pengguna secara akurat.
