# BAB IV — ANALISIS HASIL PENGUJIAN

Dokumen ini berisi rangkuman seluruh tahapan pengujian yang dilakukan pada sistem Website FIKOM Universitas Sains dan Teknologi (UNISAN). Pengujian mencakup verifikasi fungsionalitas antarmuka melalui *Black Box Testing* dan validasi struktur logika internal melalui *White Box Testing*.

---

## 4.1 Pengantar Pengujian
Tujuan dari tahap pengujian ini adalah untuk memastikan bahwa sistem yang telah dibangun memenuhi spesifikasi fungsional yang diharapkan serta memiliki struktur kode yang efisien dan bebas dari kesalahan logika. Pengujian dilakukan secara bertahap mulai dari unit terkecil hingga integrasi antarmuka.

## 4.2 Hasil Pengujian Black Box
Pengujian *Black Box* difokuskan pada pengujian fungsionalitas sistem dari sudut pandang pengguna tanpa melihat struktur kode program.

### 4.2.1 Rekapitulasi Uji Halaman Publik
Berikut adalah ringkasan hasil pengujian pada modul-modul utama halaman publik:

| Modul | Skenario | Hasil Harapan | Status |
|---|---|---|---|
| **Beranda** | Akses URL Utama | Menampilkan Slider & Berita | Valid |
| **Visi Misi** | Klik Menu Profil | Menampilkan Konten Visi Misi | Valid |
| **Daftar Dosen** | Klik Menu Dosen | Menampilkan Grid Profil Dosen | Valid |
| **Pendaftaran** | Akses Form PMB | Menampilkan Form Input Mhs | Valid |
| **Fasilitas** | Klik Lab/Ruangan | Menampilkan Foto & Detail | Valid |
| **Dokumen** | Klik SOP/Renstra | Menampilkan Daftar Unduhan | Valid |

---

## 4.3 Hasil Pengujian White Box
Pengujian *White Box* dilakukan untuk mengamati alur logika internal pada kode program menggunakan metode **Basis Path Testing**.

### 4.3.1 Metodologi Perhitungan
Tingkat kerumitan logika sistem dihitung menggunakan **Cyclomatic Complexity (V(G))** dengan 3 poin parameter utama:
1.  **Rumus 1 (Edge-Node)**: $V(G) = E - N + 2$
2.  **Rumus 2 (Predicate Node)**: $V(G) = P + 1$
3.  **Rumus 3 (Independent Path)**: Penyisiran jalur logika (Tepat 5 Jalur Independen).

### 4.3.2 Unit Pengujian: Autentikasi Login (`proses_login.php`)

**A. Pemetaan Node**
| Potongan Skrip | Simpul (Node) |
|---|---|
| `if POST Method` | 1 |
| `if empty input` | 2 |
| `if user found` | 4 |
| `if password verify` | 5 |
| `Response: Success/Error` | 3, 6, 7, 8, 9 |
| `End` | 10 |

**B. Perhitungan Cyclomatic Complexity**
- **Edge (E):** 13, **Node (N):** 10, **Predicate (P):** 4
- $V(G) = E - N + 2 = 13 - 10 + 2 = \mathbf{5}$
- $V(G) = P + 1 = 4 + 1 = \mathbf{5}$

**C. Independent Path (5 Jalur)**
1. **P1:** Akses Non-POST (Ditolak Langsung).
2. **P2:** Input Berupa Nilai Kosong.
3. **P3:** Database Tidak Menemukan Akun.
4. **P4:** Akun Ada, Namun Sandi Salah.
5. **P5:** **Akses Berhasil (Skenario Utama).**

### 4.3.3 Unit Pengujian: Pendaftaran Mahasiswa (`proses_pendaftaran.php`)

**A. Perhitungan Kompleksitas**
- **Edge (E):** 13, **Node (N):** 10, **Predicate (P):** 4
- $V(G) = E - N + 2 = 13 - 10 + 2 = \mathbf{5}$
- $V(G) = P + 1 = 4 + 1 = \mathbf{5}$

**B. Jalur Independent (5 Jalur)**
1. **P1:** Akses via GET (Hanya View).
2. **P2:** Kegagalan Verifikasi Token CSRF.
3. **P3:** Validasi Form (Data Mandatori Kosong).
4. **P4:** Kesalahan Eksekusi Query Database.
5. **P5:** **Pendaftaran Berhasil Terinput.**

### 4.3.4 Unit Pengujian: Kelola Data Dosen (`kelola_dosen.php`)

**A. Perhitungan Kompleksitas**
- **Edge (E):** 14, **Node (N):** 11, **Predicate (P):** 4
- $V(G) = E - N + 2 = 14 - 11 + 2 = \mathbf{5}$
- $V(G) = P + 1 = 4 + 1 = \mathbf{5}$

**B. Jalur Independent (5 Jalur)**
1. **P1:** Membuka Halaman Tanpa Simpan Data.
2. **P2:** Simpan Data dengan Input Identitas Kosong.
3. **P3:** Tambah Data + Upload Foto (Berhasil).
4. **P4:** Tambah Data Tanpa Foto (Berhasil).
5. **P5:** Kegagalan Teknis Penyimpanan (SQL Error).

---

## 4.4 Kesimpulan Hasil Pengujian
Berdasarkan hasil pengujian *Black Box* dan *White Box*, sistem dinyatakan **LULUS UJI** dengan hasil valid 100% pada seluruh modul utama. Perhitungan *Cyclomatic Complexity* menunjukkan skor yang rendah dan efisien (skor 5), menandakan struktur kode yang sehat dan mudah dipelihara.
