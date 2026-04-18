# BAB IX — LAPORAN PENGUJIAN BLACK BOX SETIAP MENU (BLACK BOX TESTING)

## 9.1 Pengantar Black Box Testing
Pengujian *Black Box* merupakan metode pengujian sistem yang berpusat pada pemberian masukan (input) pada antarmuka dan memvalidasi apakah keluaran (output) per-menu sesuai dengan spesifikasi yang diharapkan. Dokumen ini mendemonstrasikan pengujian fungsi detail dari **42 Komponen Menu** yang terbagi rata pada tampilan Publik (Pengunjung) dan modul Dasbor Administrator (Backend).

## 9.2 Pengujian Tampilan Publik (Frontend Pengunjung)

Pada bagian ini, ditekankan pengujian dari perspektif pengguna tamu atau mahasiswa untuk seluruh 21 cabang halaman website. Masing-masing menu diuji secara spesifik dan dipisahkan menjadi tabel individual.

### 1. Menu Beranda (Home)
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Memuat URL basis `/` untuk memastikan elemen utama muncul. | Tampilan termuat sempurna tanpa kerusakan desain (*broken layout*). | **Sesuai dengan yang diharapkan** | **Valid** |

### 2. Menu Sambutan Dekan
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan navigasi Dropdown Profil menu "Sambutan Dekan". | Sistem berhasil menampilkan foto Dekan & teks narasi secara penuh. | **Sesuai dengan yang diharapkan** | **Valid** |

### 3. Menu Visi & Misi
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan navigasi Dropdown Profil menu "Visi & Misi". | Menampilkan senarai poin-poin visi, misi, dan tujuan fakultas. | **Sesuai dengan yang diharapkan** | **Valid** |

### 4. Menu Daftar Dosen & Tendik
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan navigasi Dropdown Profil menu "Dosen & Tendik". | Grid daftar seluruh nama dosen, jabatan, dan gambar ditayangkan. | **Sesuai dengan yang diharapkan** | **Valid** |

### 5. Menu Struktur Organisasi
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan navigasi Profil menu "Struktur Organisasi". | Bagan gambar struktur rektorat/fakultas yang relevan dirender utuh. | **Sesuai dengan yang diharapkan** | **Valid** |

### 6. Menu Pendaftaran PMB
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Mengisi dan mengirim form dari Profil menu "Pendaftaran". | Sistem berhasil memvalidasi input wajib registrasi beserta upload ID. | **Sesuai dengan yang diharapkan** | **Valid** |

### 7. Menu Kurikulum Akademik
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan menu Utama Akademik lalu pilih "Kurikulum". | Sistem merender tabel mata kuliah per semester dengan tombol Unduh. | **Sesuai dengan yang diharapkan** | **Valid** |

### 8. Menu Kalender Akademik
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan menu Utama Akademik > "Kalender Akademik". | Informasi jadwal perkuliahan semesteran tercetak rapi ke layar. | **Sesuai dengan yang diharapkan** | **Valid** |

### 9. Menu S1 Teknik Informatika
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan Dropdown Program Studi > "S1 Teknik Informatika". | Sistem menampilkan spesifikasi peminatan keahlian S1 TI. | **Sesuai dengan yang diharapkan** | **Valid** |

### 10. Menu S1 Pendidikan Teknologi Informasi
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan Dropdown Program Studi > "S1 Pend. Tek. Informasi". | Sistem melampirkan keterangan profil dan prospek lulusan S1 PTI. | **Sesuai dengan yang diharapkan** | **Valid** |

### 11. Menu Sarana & Prasarana
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan menu Utama Fasilitas > "Sarana Prasarana". | Galeri prasarana ruangan diklik dan mengorbit pratinjau *Lightbox*. | **Sesuai dengan yang diharapkan** | **Valid** |

### 12. Menu Laboratorium
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan menu Utama Fasilitas > "Laboratorium". | Sistem memaparkan spesifikasi Lab beserta daftar Inventarisnya. | **Sesuai dengan yang diharapkan** | **Valid** |

### 13. Menu Dokumen Fakultas
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan Navigasi Dokumen > "Dokumen Fakultas". | Tersedia senarai arsip fakultas dengan fungsi unduh (.pdf) wajar. | **Sesuai dengan yang diharapkan** | **Valid** |

### 14. Menu Rencana Strategis (Renstra)
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan Navigasi Dokumen > "Rencana Strategis". | Tampilan tabel antarmuka bisa di-klik yang memancing *download PDF*. | **Sesuai dengan yang diharapkan** | **Valid** |

### 15. Menu Rencana Operasional (Renop)
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan Navigasi Dokumen > "Rencana Operasional". | PDF Dokumen Operasional tercatat logis tanpa gagal tautan (*404*). | **Sesuai dengan yang diharapkan** | **Valid** |

### 16. Menu Standar Operasional Prosedur (SOP)
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan Navigasi Dokumen > "Standar Operasional (SOP)".| Tabel matriks daftar SOP beserta fungsional pengunduhannya sukses. | **Sesuai dengan yang diharapkan** | **Valid** |

### 17. Menu Penelitian Dosen
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan Navigasi Riset > "Penelitian". | Matriks karya publikasi beserta tautan sitasi diarahkan transparan. | **Sesuai dengan yang diharapkan** | **Valid** |

### 18. Menu Pengabdian Masyarakat
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan Navigasi Riset > "Pengabdian". | Senarai pelaksanaan kegiatan kemasyarakatan (PKM) tampak stabil. | **Sesuai dengan yang diharapkan** | **Valid** |

### 19. Menu Organisasi BEM
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan Navigasi Kemahasiswaan > "BEM". | Deskripsi profil BEM beserta bagan kabinet tertata pada layout resolusi. | **Sesuai dengan yang diharapkan** | **Valid** |

### 20. Menu UKM & HMPS
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Menekan Navigasi Kemahasiswaan > "Himpunan / UKM". | Logo komunitas Unit Kegiatan Mahasiswa (UKM) terdistribusi dinamis. | **Sesuai dengan yang diharapkan** | **Valid** |

### 21. Menu Berita Publikasi
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Klik pada Header Menu "Berita" & Klik "Baca Selengkapnya".| *Thumbnail*, parameter tanggal, penulis, dan narasi dimuat rinci. | **Sesuai dengan yang diharapkan** | **Valid** |

---

## 9.3 Pengujian Tampilan Administrator (Dasbor Backend)

Pengujian fungsi internal CRUD (Create, Read, Update, Delete) pada 21 menu operasional Administrator guna memastikan validitas pangkalan entri. Masing-masing menu diuji lewat tabel individual.

### 22. Menu Login Administrator
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji *submit* username & pass untuk masuk Dasbor. | Akses ditolak jika cacat kredensial; diizinkan Masuk bila aman. | **Sesuai dengan yang diharapkan** | **Valid** |

### 23. Menu Ringkasan Dasbor
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Visualisasi metrik nilai di laman `dashboard.php`. | Kartu Total Mahasiswa/Pendaftar/Berita terhitung dari hitungan MySQL. | **Sesuai dengan yang diharapkan** | **Valid** |

### 24. Menu Kelola Slider Beranda
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji *Upload Cover Image* untuk slider. | Foto transisi baru tersimpan utuh dan masuk sirkulasi Slider depan. | **Sesuai dengan yang diharapkan** | **Valid** |

### 25. Menu Kelola Sambutan Fakultas
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji pembaruan paragraf dekan di laman kelola. | Manipulasi teks ter-replikasi di tampilan pengunjung secara seketika. | **Sesuai dengan yang diharapkan** | **Valid** |

### 26. Menu Kelola Fakta Institusi
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji Manajemen Tambah Angka fakta fakultas. | Kombinasi kolom nominal angka masuk dan dirender secara aman. | **Sesuai dengan yang diharapkan** | **Valid** |

### 27. Menu Kelola Visi Misi
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji Rubah Teks List Visi, Misi, Tujuan. | Pembaruan poin-poin mencegah anomali *XSS escaping* & utuh. | **Sesuai dengan yang diharapkan** | **Valid** |

### 28. Menu Kelola Struktur Organisasi
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji Timpa file Aset Bagan Gambar Organisasi. | File struktur terlama di-*unlink* utuh saat bagan baru diserahkan. | **Sesuai dengan yang diharapkan** | **Valid** |

### 29. Menu Kelola Profil Dosen
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji simpan CRUD Identitas profil pengajar. | Biodata terkirim sempurna menghindari malfungsi pembacaan *Database*. | **Sesuai dengan yang diharapkan** | **Valid** |

### 30. Menu Kelola Registrasi PMB
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji Tinjau PDF Berkas & Rubah Aksi Status Form. | Admin memverifikasi lampiran layar-penuh; perubahan status terekam permanen. | **Sesuai dengan yang diharapkan** | **Valid** |

### 31. Menu Kelola Rekam Kurikulum
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji Tambah Dokumen Silabus beserta lampirannya. | Pemutakhiran berformat `.pdf` spesialis prodi distor secara wajar. | **Sesuai dengan yang diharapkan** | **Valid** |

### 32. Menu Kelola Kalender Akademik
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji Entri agenda temporal Terjadwal Akademis. | Rekam tabel agenda mendarat teguh lalu menyinkronkan *Frontend*. | **Sesuai dengan yang diharapkan** | **Valid** |

### 33. Menu Kelola Ruangan/Sarpras
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji Aset Gambar Ruang Gedung Fakultas. | Kapasitas deskriptif kelas dan aset gambar ditransmisi tanpa kendala. | **Sesuai dengan yang diharapkan** | **Valid** |

### 34. Menu Kelola Fasilitas Laboratorium
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji Hapus Inventaris Hardware Lab. | Tindakan drop *Delete* membersihkan relasi beserta file fisikal terkait. | **Sesuai dengan yang diharapkan** | **Valid** |

### 35. Menu Kelola Direktori SOP
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji Tambah Baru prosedur operasional (SOP). | File prosedur tersimpan beserta pemicu *Force download* disematkan. | **Sesuai dengan yang diharapkan** | **Valid** |

### 36. Menu Kelola Arsip Renstra
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji Hapus Entitas file Renstra (Strategis). | Aksi penghapusan menembalkan pelenyapan berkas sinkron dari folder lokal. | **Sesuai dengan yang diharapkan** | **Valid** |

### 37. Menu Kelola Arsip Renop
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji Edit Narasi Dokumen (Operasional). | Sinkronisasi perampingan nama modul merespon transisi *Update* data. | **Sesuai dengan yang diharapkan** | **Valid** |

### 38. Menu Kelola Indeks Penelitian
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji Publikasi & Penyusunan tautan Karya Jurnal. | Penanaman tautan URL referensi ke sistem terindeks berhasil mulus. | **Sesuai dengan yang diharapkan** | **Valid** |

### 39. Menu Kelola Riwayat Pengabdian
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji pencatatan riwayat durasi pelaksanaan PKM. | Informasi lokasi kegiatan komunitas ditarik sempurna dari *backend form*. | **Sesuai dengan yang diharapkan** | **Valid** |

### 40. Menu Kelola Organisasi BEM/UKM
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji Modifikasi detail visi misi UKM / BEM. | Rekonstruksi struktur himpunan serta unggahan *Logo/Gambar* beradaptasi normal. | **Sesuai dengan yang diharapkan** | **Valid** |

### 41. Menu Kelola Berita / Artikel
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji Unggahan Naskah Berita *rich-text* & Cover. | Untaian peliputan redaksi, jejak *timestamps*, diregister konsisten ke memori. | **Sesuai dengan yang diharapkan** | **Valid** |

### 42. Menu Kelola Kerjasama / MoU
| Skenario Uji | Output yang Diharapkan | Output Aktual | Status |
|:-------------|:-----------------------|:--------------|:------:|
| Uji Simpan / Detasering riwayat mitra eksternal. | Berkas cetak biru kemitraan beserta relasi datanya stabil terintegrasi tanpa error. | **Sesuai dengan yang diharapkan** | **Valid** |

---

## 9.4 Kesimpulan Akhir Skala Pengujian Black Box

Berdasarkan paparan eksperimen mendalam terhadap **42 Entitas Modul Menu** (*21 Cabang Sisi Klien Publik* dikombinasikan *21 Konfigurasi Sisi Administrator*), eksekusi pemodelan disimpulkan memegang status fungsional **100% VALID DAN OPTIMAL**. Transmisi pertukaran antara modul komputasi *(Request/Response Lifecycle)* sistem menakar ekspektasi logis *(Logic Tolerance)* dengan matang, menolak injeksi liyan yang memicu malfungsi antarmuka, menon-aktifkan komparasi direktori file haram (selain *.PNG/.JPG/.PDF*), dan secara sukses memegang kendali preservasi fungsional dari peladen sistem informasi akademik ini.
