# BAB IX — LAPORAN PENGUJIAN BLACK BOX (BLACK BOX TESTING)

## 9.1 Pengantar Black Box Testing
Pengujian *Black Box* (*Black Box Testing*) merupakan metode pengujian perangkat lunak di mana fokus pengujian terletak pada fungsionalitas sistem tanpa perlu mengetahui struktur kode atau logika internal dari program tersebut (*backend*). Pengujian ini dilakukan berdasarkan sudut pandang pengguna akhir (*end-user*), di mana interaksi berpusat pada pemberian masukan (input) pada antarmuka dan memvalidasi apakah keluaran (output) yang dihasilkan oleh sistem telah sesuai dengan spesifikasi yang diharapkan.

## 9.2 Skenario Pengujian Sistem

### A. Modul Otentikasi (Proses Login Administrator)
| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|----|--------------|-------|------------------------|---------------|--------|
| 1 | Menguji form login dengan semua field wajib kosong. | `username = ""` <br> `password = ""` | Sistem menolak proses dan mengarahkan kembali ke halaman login dengan pesan *error* "Data Kosong". | Sesuai dengan yang diharapkan | **Valid** |
| 2 | Menguji login dengan username yang belum terdaftar. | `username = "adminX"` <br> `password = "123"` | Sistem menolak login karena perpaduan *user/role* tidak ditemukan di *database*. | Sesuai dengan yang diharapkan | **Valid** |
| 3 | Menguji masuk sistem menggunakan password salah. | `username = "admin"` <br> `password = "salah123"` | Sistem menolak login dan menampilkan pesan peringatan kredensial gagal otentikasi. | Sesuai dengan yang diharapkan | **Valid** |
| 4 | Menguji percobaan login sah dari seluruh *Role*. | `username = "admin"` <br> `password = "benar123"` | Sistem menerima login, mengamankan identitas berwujud *Session*, membiarkan masuk halaman Dasbor. | Sesuai dengan yang diharapkan | **Valid** |

### B. Modul Registrasi (Proses Pendaftaran Mahasiswa Baru)
| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|----|--------------|-------|------------------------|---------------|--------|
| 5 | Mengisi form pendaftaran dengan isian kolom wajib kosong. | `nama = ""` <br> `email = "test@uns.ac.id"` | Sistem antarmuka membatalkan proses transmisi rekam jaringan dan mencetak penanda *Field Required*. | Sesuai dengan yang diharapkan | **Valid** |
| 6 | Memalsukan formulasi kunci `CSRF Token` dari rute peladen asing. | `csrf_token = "invalid_hash"` | Sistem meniadakan masukan utuh untuk mencegah *bypass form*, mencetak error kegagalan validasi log. | Sesuai dengan yang diharapkan | **Valid** |
| 7 | Mengunggah fail file ekstensi berpotensi melanggar ketentuan server. | `file_ktp = index.php` | Mesin *backend* memeriksa pembatasan spesifikasi file (*Mime Type*), kemudian menolak eksekusinya karena tidak berformat gambar. | Sesuai dengan yang diharapkan | **Valid** |
| 8 | Menyimpan parameter kelengkapan data registrasi final utuh dengan sah. | `nama = "Abud"` <br> `file_ktp = identitas.png` | Input transaksional basis data MySQL ditancapkan, mengembalikan visual halaman UI berupa keterangan "Pendaftaran Berhasil". | Sesuai dengan yang diharapkan | **Valid** |

### C. Manajemen Data Logis (Proses CRUD Lapis Admin)
| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|----|--------------|-------|------------------------|---------------|--------|
| 9 | Memproses simpanan Data Tabel *(Create/Add)* Master. | *Input: NIDN Lengkap, Penempatan Nama, & Status.* | Tercipta wujud entri tambahan tunggal relasi spesifik baru masuk memori sistem database peladen. | Sesuai dengan yang diharapkan | **Valid** |
| 10 | Eksekusi baca/pemaparan visualisasi matriks Tabel *(Read)*. | *Akses: Ekstensi URL menu `kelola_dosen`.* | Data riwayat sivitas direpresentasikan selaras sempurna menjadi tontonan tabel *grid* antarmuka aktual. | Sesuai dengan yang diharapkan | **Valid** |
| 11 | Penerapan substitusi atau modifikasi perubahan *(Update)*. | *Input: Penambahan Huruf Struktur Identitas.* | Rangkaian lama tergantikan entitas log baru terekam stabil, panel klien merespon seketika via tampilan depan. | Sesuai dengan yang diharapkan | **Valid** |
| 12 | Eksekusi pelepasan permanen (*Delete Record*). | *Input: Klik intervensi tautan "Hapus" pada ID=9.* | Kolom matriks tereksekusi pemusnahan total, menyisakan penyusutan kalkulasi di pangkalan parameter tanpa perusakan korelasi di sisi lain. | Sesuai dengan yang diharapkan | **Valid** |
| 13 | Uji pemetaan parameter filtrasi/metode pencarian terpusat (*Read-Search Constraint*). | *Akses: Mengetik deret '2023'.* | Pemotongan referensi penayangan laporan secara akurat, sistem mengisolasi tampilan UI untuk hanya memperlihatkan riwayat rekaman yang dibubuhkan deret tahun 2023. | Sesuai dengan yang diharapkan | **Valid** |

### D. Fitur Layanan Aplikasi Terpadu/Spesial
| No | Skenario Uji | Input | Output yang Diharapkan | Output Aktual | Status |
|----|--------------|-------|------------------------|---------------|--------|
| 14 | Menguji perintah cetak/unduhan transkripsi Dokumen Institusional (File Outputing). | *Klik tombol Unduh PDF di SOP* | Mesin merepsons secara internal mengemas duplikat fail ekstensi PDF rujukan dari peladen direktori penyimpanan menuju memori pengguna utuh. | Sesuai dengan yang diharapkan | **Valid** |
| 15 | Eksekusi aktivasi pemaparan *Light-Box Render Preview* / Pratinjau Resolusi. | *Klik pematik gambar foto fasilitas* | Mekanisme program mensinkronasikan kanvas belakang untuk blur dan membangun pemaparan pop-up besar menyajikan wujud fisik gambaran ruangan beresolusi spesifiknya. | Sesuai dengan yang diharapkan | **Valid** |

---

## 9.3 Kesimpulan Pengujian Black Box

Berikut ini dilampirkan rekapitulasi capaian matriks dari uji fungsionalitas di lingkup produksi *Front-End Output*:

| Kriteria Pengujian Sistem | Total Skenario Diujikan | Valid & Sesuai Ekspektasi | Gagal / Tidak Valid | Kalkulasi Sukses Komputasi |
|---------------------------|-------------------------|---------------------------|---------------------|----------------------------|
| Modul Lapisan Otentikasi  | 4 Skenario              | 4 Skenario                | 0                   | 100% Beroperasi Penuh      |
| Modul Registrasi/Formulir | 4 Skenario              | 4 Skenario                | 0                   | 100% Beroperasi Penuh      |
| Manajemen CRUD Master     | 5 Skenario              | 5 Skenario                | 0                   | 100% Beroperasi Penuh      |
| Fungsional Utilitas Mikro | 2 Skenario              | 2 Skenario                | 0                   | 100% Beroperasi Penuh      |
| **FINALISASI REKAP UJI**  | **15**                  | **15**                    | **0**               | **100% DITERIMA**          |

Berdasarkan paparan eksperimen di atas, eksekusi pemodelan terhadap **15 skenario observasi antarmuka klien** disimpulkan menyandang status fungsional **VALID**. Tiap-tiap umpan masuk pengguna selaras menyeimbangkan respons keluarannya serempak sempurna memenuhi desain interaksi arsitektur layanannya.
