# BAB IV — ANALISIS HASIL PENGUJIAN

## 4.3 Hasil Pengujian

### 4.3.1 Pengujian White Box

Pengujian *White Box* dilakukan untuk mengamati alur logika internal pada kode program. Fokus pengujian ini adalah memastikan setiap jalur (*path*) yang ada di dalam program telah teruji dan berjalan sesuai dengan fungsi yang diharapkan. Dalam pengujian ini, digunakan metode **Cyclomatic Complexity (V(G))** untuk menghitung tingkat kerumitan logika sistem melalui tiga pendekatan rumus:

1.  **Rumus 1 (Edge-Node)**: $V(G) = E - N + 2$
2.  **Rumus 2 (Predicate Node)**: $V(G) = P + 1$
3.  **Rumus 3 (Region)**: $V(G) = R$ (Jumlah region/wilayah tertutup pada flowgraph)

---

### a. Pengujian Autentikasi Login

Analisis dilakukan pada file `admin/proses_login.php`.

**Tabel 4.12 Pemetaan Statement dan Node — Autentikasi Login**

| STATEMENT | NODE |
|:----------|:----:|
| `$username = $_POST['username']; $password = $_POST['password']; $role = $_POST['role'];` | 1 |
| `if (empty($username))` | 2 |
| `if (empty($password))` | 3 |
| `if (empty($role))` | 4 |
| `switch ($role) { case 'admin': ... }` | 5 |
| `switch ($role) { case 'dosen': ... }` | 6 |
| `switch ($role) { case 'mahasiswa': ... }` | 7 |
| `$sql = "SELECT ..."; $stmt->execute();` | 8 |
| `if ($result->num_rows == 1)` | 9 |
| `if (password_verify($password, $data['password']))` | 10 |
| `header("Location: login.php?status=gagal"); exit();` (Error Handler) | 11 |
| `$_SESSION['login'] = true; header("Location: $dashboard"); exit();` | 12 |
| `End` | 13 |

**Gambar 4.26 Flowchart Autentikasi Login**

```mermaid
flowchart TD
    A([Mulai]) --> B[/Input: User, Pass, Role/]
    B --> C{"$username<br/>Kosong?"}
    C -- Ya --> D[Redirect: status=kosong]
    C -- Tidak --> E{"$password<br/>Kosong?"}
    E -- Ya --> D
    E -- Tidak --> F{"$role<br/>Kosong?"}
    F -- Ya --> D
    F -- Tidak --> G{"Switch Case:<br/>Admin?"}
    G -- Ya --> H[Query: Tabel Users]
    G -- Tidak --> I{"Switch Case:<br/>Dosen?"}
    I -- Ya --> J[Query: Tabel Dosen]
    I -- Tidak --> K{"Switch Case:<br/>Mahasiswa?"}
    K -- Ya --> L[Query: Tabel Mahasiswa]
    K -- Tidak --> M[Redirect: status=gagal]
    H & J & L --> N[Eksekusi Query]
    N --> O{"User ditemukan?<br/>(num_rows == 1)"}
    O -- Tidak --> P[Redirect: status=gagal]
    O -- Ya --> Q{"Password<br/>Cocok?"}
    Q -- Tidak --> R[Redirect: status=gagal]
    Q -- Ya --> S[Set Session & Redirect Dashboard]
    D & M & P & R & S --> T([Selesai])
```

**Gambar 4.27 Flowgraph Autentikasi Login**

```mermaid
graph TD
    N1((1)) --> N2{2}
    N2 -- "Ya" --> N11((11))
    N2 -- "Tidak" --> N3{3}
    N3 -- "Ya" --> N11
    N3 -- "Tidak" --> N4{4}
    N4 -- "Ya" --> N11
    N4 -- "Tidak" --> N5{5}
    N5 -- "Admin" --> N8((8))
    N5 -- "Bukan" --> N6{6}
    N6 -- "Dosen" --> N8
    N6 -- "Bukan" --> N7{7}
    N7 -- "Mahasiswa" --> N8
    N7 -- "Bukan" --> N11
    N8 --> N9{9}
    N9 -- "Tidak" --> N11
    N9 -- "Ya" --> N10{10}
    N10 -- "Tidak" --> N11
    N10 -- "Ya" --> N12((12))
    N11 & N12 --> N13((13))

    style N2 fill:#fff,stroke:#000
    style N3 fill:#fff,stroke:#000
    style N4 fill:#fff,stroke:#000
    style N5 fill:#fff,stroke:#000
    style N6 fill:#fff,stroke:#000
    style N7 fill:#fff,stroke:#000
    style N9 fill:#fff,stroke:#000
    style N10 fill:#fff,stroke:#000
```

**Hasil Perhitungan Modul Login:**
1.  **V(G) = E — N + 2** = 20 — 13 + 2 = **9**
2.  **V(G) = P + 1** = 8 + 1 = **9**
3.  **V(G) = R** (Jumlah Region) = **9**

**Tabel 4.15 Jalur Independen Modul Login**

| Region | Independent Path | Keterangan |
|:------:|:-----------------|:-----------|
| R1 | Start → 1 → 2 → 11 → 13 | Username kosong |
| R2 | Start → 1 → 2 → 3 → 11 → 13 | Password kosong |
| R3 | Start → 1 → 2 → 3 → 4 → 11 → 13 | Role kosong |
| R4 | Start → 1 → 2 → 3 → 4 → 5 → 6 → 7 → 11 → 13 | Role invalid |
| R5 | Start → 1 → 2 → 3 → 4 → 5 → 8 → 9 → 11 → 13 | Admin, tidak ditemukan |
| R6 | Start → 1 → 2 → 3 → 4 → 5 → 8 → 9 → 10 → 11 → 13 | Admin, password salah |
| R7 | Start → 1 → 2 → 3 → 4 → 5 → 6 → 8 → 9 → 11 → 13 | Dosen, tidak ditemukan |
| R8 | Start → 1 → 2 → 3 → 4 → 5 → 6 → 7 → 8 → 9 → 11 → 13 | Mahasiswa, tidak ada |
| R9 | Start → 1 → 2 → 3 → 4 → 5 → 8 → 9 → 10 → 12 → 13 | **Login BERHASIL** |

---

### b. Pengujian Proses Pendaftaran (PMB)

Analisis dilakukan pada file `pages/pendaftaran.php`.

**Tabel 4.16 Pemetaan Statement dan Node — Pendaftaran PMB**

| STATEMENT | NODE |
|:----------|:----:|
| `if ($_SERVER['REQUEST_METHOD'] == 'POST')` | 1 |
| `if ($_POST['csrf_token'] !== $_SESSION['csrf_token'])` | 2 |
| `if (empty($nama) \|\| empty($nik))` | 3 |
| `if ($nik_exists)` | 4 |
| `if ($email_exists)` | 5 |
| `if ($foto_error)` | 6 |
| `if ($ijazah_error)` | 7 |
| `if ($stmt->execute())` | 8 |
| `header("Location: pendaftaran?sukses"); exit();` | 9 |
| `End` | 10 |

**Gambar 4.28 Flowchart Pendaftaran PMB**

```mermaid
flowchart TD
    A([Mulai]) --> B{Request POST?}
    B -- Tidak --> C([Tampilkan Form])
    B -- Ya --> D{"Check CSRF<br/>Token Valid?"}
    D -- Tidak --> E[Stop / Error]
    D -- Ya --> F{"Field Wajib<br/>Kosong?"}
    F -- Ya --> G[Redirect: status=kosong]
    F -- Tidak --> H{"NIK Sudah<br/>Terdaftar?"}
    H -- Ya --> I[Redirect: status=nik_exists]
    H -- Tidak --> J{"Upload Foto<br/>Berhasil?"}
    J -- Tidak --> K[Redirect: status=foto_error]
    J -- Ya --> L{"Upload Ijazah<br/>Berhasil?"}
    L -- Tidak --> M[Redirect: status=ijazah_error]
    L -- Ya --> N{"Eksekusi<br/>Query Berhasil?"}
    N -- Ya --> O[Redirect: status=sukses]
    N -- Tidak --> P[Redirect: status=error_db]
    C & E & G & I & K & M & O & P --> Q([Selesai])
```

**Gambar 4.29 Flowgraph Pendaftaran PMB**

```mermaid
graph TD
    N1((1)) --> N2{2}
    N1 -- "Akses GET" --> N10((10))
    N2 -- "Token Invalid" --> N10
    N2 -- "Token Valid" --> N3{3}
    N3 -- "Input Kosong" --> N10
    N3 -- "Lengkap" --> N4{4}
    N4 -- "NIK Ada" --> N10
    N4 -- "NIK Baru" --> N5{5}
    N5 -- "Foto Error" --> N10
    N5 -- "Foto OK" --> N6{6}
    N6 -- "Ijazah Error" --> N10
    N6 -- "Ijazah OK" --> N7{7}
    N7 -- "Query Gagal" --> N10
    N7 -- "Query Sukses" --> N8((8))
    N8 --> N9((9))
    N9 --> N10

    style N2 fill:#fff,stroke:#000
    style N3 fill:#fff,stroke:#000
    style N4 fill:#fff,stroke:#000
    style N5 fill:#fff,stroke:#000
    style N6 fill:#fff,stroke:#000
    style N7 fill:#fff,stroke:#000
```

**Hasil Perhitungan Modul Pendaftaran:**
1.  **V(G) = E — N + 2** = 17 — 10 + 2 = **9**
2.  **V(G) = P + 1** = 8 + 1 = **9**
3.  **V(G) = R** (Jumlah Region) = **9**

**Tabel 4.17 Jalur Independen Modul Pendaftaran**

| Region | Independent Path | Keterangan |
|:------:|:-----------------|:-----------|
| R1 | Start → 1 → 10 | Akses form via GET |
| R2 | Start → 1 → 2 → 10 | Token CSRF invalid |
| R3 | Start → 1 → 2 → 3 → 10 | Isian wajib kosong |
| R4 | Start → 1 → 2 → 3 → 4 → 10 | NIK sudah terdaftar |
| R5 | Start → 1 → 2 → 3 → 4 → 5 → 10 | Format foto tidak valid |
| R6 | Start → 1 → 2 → 3 → 4 → 5 → 6 → 10 | Ijazah belum diunggah |
| R7 | Start → 1 → 2 → 3 → 4 → 5 → 6 → 7 → 10 | Gagal simpan ke database |
| R8 | Start → 1 → 2 → 3 → 4 → 5 → 6 → 7 → 8 → 9 → 10 | **Pendaftaran SUKSES** |
| R9 | Start → 1 → 2 → 4 → 5 → 7 → 9 → 10 | Skenario data duplikat |

---

### c. Pengujian Kelola Data Dosen

Analisis pada `admin/kelola_dosen.php`.

**Tabel 4.18 Pemetaan Statement dan Node — Kelola Dosen**

| STATEMENT | NODE |
|:----------|:----:|
| `if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']))` | 1 |
| `if (empty($nama) \|\| ...)` | 2 |
| `if (isset($_FILES['foto']))` | 3 |
| `if (!valid_format \|\| size > 2MB)` | 4 |
| `if ($action === 'tambah_dosen')` | 5 |
| `if ($nidn_exists)` | 6 |
| `if ($stmt->execute())` | 7 |
| `header("Location: kelola_dosen?sukses"); exit();` | 8 |
| `End` | 9 |

**Gambar 4.30 Flowchart Kelola Dosen**

```mermaid
flowchart TD
    A([Mulai]) --> B{"Request POST<br/>& action exist?"}
    B -- Tidak --> C([Tampilkan Tabel])
    B -- Ya --> D{"Validasi<br/>Field Kosong?"}
    D -- Ya --> E[Redirect: status=kosong]
    D -- Tidak --> F{"Ada File<br/>Foto Baru?"}
    F -- Ya --> G{"Format/Ukuran<br/>Valid?"}
    G -- Tidak --> H[Redirect: status=foto_error]
    G -- Ya --> I{Cek Action}
    F -- Tidak --> I
    I -- Tambah --> J{"NIDN Sudah<br/>Terdaftar?"}
    J -- Ya --> K[Redirect: status=nidn_exists]
    J -- Tidak --> L[Insert Data]
    I -- Edit --> M[Update Data]
    L & M --> N{"Eksekusi<br/>Query Berhasil?"}
    N -- Ya --> O[Redirect: status=sukses]
    N -- Tidak --> P[Redirect: status=error_db]
    C & E & H & K & O & P --> Q([Selesai])
```

**Gambar 4.31 Flowgraph Kelola Dosen**

```mermaid
graph TD
    N1((1)) --> N2{2}
    N1 -- "Akses GET" --> N9((9))
    N2 -- "Masukan Kosong" --> N9
    N2 -- "Data Lengkap" --> N3{3}
    N3 -- "Ada Foto" --> N4{4}
    N4 -- "Foto Invalid" --> N9
    N4 -- "Foto Valid" --> N5{5}
    N3 -- "No Foto" --> N5
    N5 -- "Tambah" --> N6{6}
    N6 -- "NIDN Duplikat" --> N9
    N6 -- "NIDN Baru" --> N7{7}
    N5 -- "Edit" --> N7
    N7 -- "Query Gagal" --> N9
    N7 -- "Query Sukses" --> N8((8))
    N8 --> N9

    style N2 fill:#fff,stroke:#000
    style N3 fill:#fff,stroke:#000
    style N4 fill:#fff,stroke:#000
    style N5 fill:#fff,stroke:#000
    style N6 fill:#fff,stroke:#000
    style N7 fill:#fff,stroke:#000
```

**Hasil Perhitungan Modul Dosen:**
1.  **V(G) = E — N + 2** = 15 — 8 + 2 = **9**
2.  **V(G) = P + 1** = 8 + 1 = **9**
3.  **V(G) = R** (Jumlah Region) = **9**

**Tabel 4.19 Jalur Independen Modul Dosen**

| Region | Independent Path | Keterangan |
|:------:|:-----------------|:-----------|
| R1 | Start → 1 → 9 | Tampilan tabel utama |
| R2 | Start → 1 → 2 → 9 | Input wajib kosong |
| R3 | Start → 1 → 2 → 3 → 4 → 9 | Foto format tidak valid |
| R4 | Start → 1 → 2 → 3 → 5 → 6 → 9 | NIDN sudah dipakai |
| R5 | Start → 1 → 2 → 3 → 5 → 7 → 9 | Gagal INSERT ke database |
| R6 | Start → 1 → 2 → 3 → 5 → 7 → 8 → 9 | TAMBAH DATA SUKSES |
| R7 | Start → 1 → 2 → 3 → 4 → 5 → 7 → 9 | Gagal UPDATE data ke DB |
| R8 | Start → 1 → 2 → 3 → 4 → 5 → 7 → 8 → 9 | UPDATE DATA SUKSES |
| R9 | Start → 1 → 2 → 3 → 4 → 5 → 6 → 8 → 9 | Update data tanpa foto |

---

*Laporan pengujian teknis White Box ini disusun secara komprehensif untuk memastikan validitas alur logika pada sistem Website FIKOM UNISAN.*
