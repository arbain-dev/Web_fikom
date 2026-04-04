# Pengujian Black Box (Black Box Testing)

Pengujian Black Box berfokus pada fungsionalitas aplikasi tanpa melihat struktur kode internal. Pengujian ini dilakukan untuk memastikan input yang diberikan menghasilkan output yang diharapkan.

## 1. Skenario Pengujian: Login Admin

| No | Skenario Pengujian | Langkah Pengujian | Data Input | Hasil yang Diharapkan | Hasil Pengujian | Status |
|----|-------------------|-------------------|------------|-----------------------|-----------------|--------|
| 1 | Login dengan data valid | 1. Buka halaman login<br>2. Masukkan username valid<br>3. Masukkan password valid<br>4. Pilih role 'Administrator'<br>5. Klik Login | Username: `admin`<br>Password: `admin123`<br>Role: `Administrator` | Berhasil login dan diarahkan ke Dashboard Admin | Sesuai Harapan | **Valid** |
| 2 | Login dengan password salah | 1. Buka halaman login<br>2. Masukkan username valid<br>3. Masukkan password salah<br>4. Pilih role 'Administrator'<br>5. Klik Login | Username: `admin`<br>Password: `salah`<br>Role: `Administrator` | Muncul pesan error "Password salah" atau "Login gagal" | Sesuai Harapan | **Valid** |
| 3 | Login dengan username tidak terdaftar | 1. Buka halaman login<br>2. Masukkan username tidak valid<br>3. Masukkan password sembarang<br>4. Pilih role 'Administrator'<br>5. Klik Login | Username: `unknown`<br>Password: `123`<br>Role: `Administrator` | Muncul pesan error "User tidak ditemukan" | Sesuai Harapan | **Valid** |
| 4 | Login tanpa mengisi form | 1. Kosongkan semua field<br>2. Klik Login | [Kosong] | Muncul pesan peringatan bahwa form wajib diisi | Sesuai Harapan | **Valid** |

## 2. Skenario Pengujian: Kelola Berita

| No | Skenario Pengujian | Langkah Pengujian | Data Input | Hasil yang Diharapkan | Hasil Pengujian | Status |
|----|-------------------|-------------------|------------|-----------------------|-----------------|--------|
| 1 | Tambah Berita Baru | 1. Masuk menu Kelola Berita<br>2. Klik "Tambah Berita"<br>3. Isi Judul, Kategori, Tanggal, Konten<br>4. Upload Foto<br>5. Klik Simpan | Judul: "Berita Test"<br>Kategori: "Kampus"<br>Tanggal: [Hari Ini]<br>Foto: [file.jpg] | Data tersimpan dan muncul di tabel daftar berita | Sesuai Harapan | **Valid** |
| 2 | Edit Berita | 1. Klik tombol Edit pada salah satu berita<br>2. Ubah Judul menjadi "Berita Edit"<br>3. Klik Simpan | Judul Baru: "Berita Edit" | Data berhasil diperbarui dengan judul baru | Sesuai Harapan | **Valid** |
| 3 | Hapus Berita | 1. Klik tombol Hapus pada salah satu berita<br>2. Konfirmasi alert hapus | - | Data terhapus dari tabel dan file foto terhapus dari server | Sesuai Harapan | **Valid** |

## 3. Skenario Pengujian: Kelola Data Dosen

| No | Skenario Pengujian | Langkah Pengujian | Data Input | Hasil yang Diharapkan | Hasil Pengujian | Status |
|----|-------------------|-------------------|------------|-----------------------|-----------------|--------|
| 1 | Tambah Dosen | 1. Klik "Tambah Dosen"<br>2. Isi Nama, NIDN, Prodi, Email, dll<br>3. Klik Simpan | Nama: "Budi Santoso"<br>NIDN: "123456"<br>Prodi: "Informatika" | Data dosen baru muncul di daftar dosen | Sesuai Harapan | **Valid** |
| 2 | Validasi File Foto | 1. Coba upload file bukan gambar (misal .pdf) saat tambah dosen<br>2. Klik Simpan | File: dokumen.pdf | Muncul pesan error "Format file tidak valid" | Sesuai Harapan | **Valid** |

## 4. Skenario Pengujian: Verifikasi Pendaftaran

| No | Skenario Pengujian | Langkah Pengujian | Data Input | Hasil yang Diharapkan | Hasil Pengujian | Status |
|----|-------------------|-------------------|------------|-----------------------|-----------------|--------|
| 1 | Update Status Pendaftaran | 1. Buka menu Pendaftaran<br>2. Ubah status dari "Pending" menjadi "Diterima"<br>3. Sistem memproses | Status: `Diterima` | Status berubah menjadi "Diterima" dan warna indikator berubah hijau | Sesuai Harapan | **Valid** |
| 2 | Lihat Detail Pendaftar | 1. Klik tombol "Detail" (ikon mata)<br>2. Tunggu modal muncul | - | Modal terbuka menampilkan detail biodata pendaftar | Sesuai Harapan | **Valid** |

## Kesimpulan
Berdasarkan pengujian Black Box di atas, fungsi-fungsi utama sistem (Login, CRUD Data, Validasi Input) telah berjalan sesuai dengan spesifikasi kebutuhan pengguna.
