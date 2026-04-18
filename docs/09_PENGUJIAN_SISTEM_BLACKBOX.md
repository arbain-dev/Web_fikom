# 4.4.2 Pengujian Black Box

Pengujian fungsional sistem (Black Box Testing) ini dibagi menjadi dua bagian, yaitu pengujian antarmuka halaman publik (pengunjung) dan antarmuka halaman administrator (*backend*).

---

## A. Pengujian Halaman Publik (Frontend)

**a. Pengujian pada Halaman Beranda**

*Tabel 4.1 Pengujian Fungsional Halaman Beranda*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses rute utama website | URL basis `/` diakses langsung di *browser* | Sistem memuat *slider banner*, fakta, dan berita terbaru secara utuh | Sesuai dengan yang diharapkan | Valid |

**b. Pengujian pada Menu Sambutan Dekan**

*Tabel 4.2 Pengujian Fungsional Menu Sambutan Dekan*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses halaman Sambutan | Klik navigasi Profil > "Sambutan Dekan" | Sistem menampilkan foto dan sambutan dekan secara penuh | Sesuai dengan yang diharapkan | Valid |

**c. Pengujian pada Menu Visi & Misi**

*Tabel 4.3 Pengujian Fungsional Menu Visi & Misi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses halaman Visi Misi | Klik navigasi Profil > "Visi & Misi" | Sistem memuat poin-poin Visi, Misi, dan Tujuan Fakultas | Sesuai dengan yang diharapkan | Valid |

**d. Pengujian pada Menu Daftar Dosen**

*Tabel 4.4 Pengujian Fungsional Menu Daftar Dosen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses daftar profil dosen | Klik navigasi Profil > "Dosen & Tendik" | Sistem menampilkan *grid* foto profil dosen beserta keterangan jabatannya | Sesuai dengan yang diharapkan | Valid |

**e. Pengujian pada Menu Struktur Organisasi**

*Tabel 4.5 Pengujian Fungsional Menu Struktur Organisasi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses bagan organisasi | Klik navigasi Profil > "Struktur Organisasi" | Sistem merender gambar bagan hierarki fakultas dengan resolusi penuh | Sesuai dengan yang diharapkan | Valid |

**f. Pengujian pada Menu Pendaftaran PMB**

*Tabel 4.6 Pengujian Fungsional Menu Pendaftaran PMB*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Kirim form dengan data valid | Mengisi seluruh *field* identitas dan unggah gambar bukti valid | Sistem menyimpan data pendaftaran dan memunculkan notifikasi "Berhasil" | Sesuai dengan yang diharapkan | Valid |
| 2 | Kirim form tanpa input wajib | Mengosongkan isian nama/email, dan *submit* | Sistem memblokir pengiriman dan menandai info wajib diisi | Sesuai dengan yang diharapkan | Valid |
| 3 | Upload ekstensi tidak valid | Kolom unggah bukti diisi dengan file berbahaya (`.exe`) | Sistem menolak file tersebut dan memberikan peringatan ekstensi dilarang | Sesuai dengan yang diharapkan | Valid |

**g. Pengujian pada Menu Kurikulum**

*Tabel 4.7 Pengujian Fungsional Menu Kurikulum*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses daftar kurikulum | Klik navigasi Akademik > "Kurikulum" | Sistem memuat parameter tabel kurikulum sesuai tahun akademik berjalan | Sesuai dengan yang diharapkan | Valid |
| 2 | Unduh dokumen silabus | Klik tombol "Unduh PDF" pada salah satu prodi | Peramban *browser* merespon dengan perintah *download* file `.pdf` | Sesuai dengan yang diharapkan | Valid |

**h. Pengujian pada Menu Kalender Akademik**

*Tabel 4.8 Pengujian Fungsional Menu Kalender Akademik*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses tabel Kalender | Klik navigasi Akademik > "Kalender Akademik" | Sistem menayangkan detail tabel agenda semesteran | Sesuai dengan yang diharapkan | Valid |

**i. Pengujian pada Menu S1 Teknik Informatika**

*Tabel 4.9 Pengujian Fungsional Menu Teknik Informatika*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Lihat profil keahlian | Klik Program Studi > "S1 Teknik Informatika" | Tampilan halaman rujukan akreditasi dan konsentrasi TI stabil terbuka | Sesuai dengan yang diharapkan | Valid |

**j. Pengujian pada Menu S1 Pendidikan Teknologi Informasi**

*Tabel 4.10 Pengujian Fungsional Menu Pend. Tek. Informasi (PTI)*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Lihat identitas prodi PTI | Klik Program Studi > "S1 Pend. Tek. Informasi" | Sistem merender tampilan profil lulusan pendidikan secara stabil | Sesuai dengan yang diharapkan | Valid |

**k. Pengujian pada Menu Sarana & Prasarana**

*Tabel 4.11 Pengujian Fungsional Menu Sarana & Prasarana*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses *list* sarpras | Klik Fasilitas > "Sarana Prasarana" | Senarai gambar per-ruangan kelas dan fasilitas kampus dirender | Sesuai dengan yang diharapkan | Valid |
| 2 | Pop-up pratinjau | Klik pada salah satu gambar galeri sarpras | Pemantik *Lightbox/Modal* mekar memperlihatkan gambar resolusi tajam | Sesuai dengan yang diharapkan | Valid |

**l. Pengujian pada Menu Laboratorium**

*Tabel 4.12 Pengujian Fungsional Menu Laboratorium*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses rincian inventaris | Klik Fasilitas > "Laboratorium" | Menampilkan deskripsi lab komputer beserta perangkat *hardware*-nya | Sesuai dengan yang diharapkan | Valid |

**m. Pengujian pada Menu Dokumen Fakultas**

*Tabel 4.13 Pengujian Fungsional Menu Dokumen Fakultas*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pencarian dokumen | Masukkan parameter tahun pada tabel Dokumen | *Grid* tabel menyeleksi dan menyembunyikan berkas rentang tahun lain | Sesuai dengan yang diharapkan | Valid |
| 2 | Unduh fail spesifik | Klik tombol *"Download"* pada tabel | Sistem menarik duplikat PDF dari *server* dikirim ke memori klien | Sesuai dengan yang diharapkan | Valid |

**n. Pengujian pada Menu Rencana Strategis (Renstra)**

*Tabel 4.14 Pengujian Fungsional Menu Rencana Strategis*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses tabel file Renstra | Klik Dokumen > "Rencana Strategis" | Matriks tabel merespon menampilkan daftar *vault* dari database | Sesuai dengan yang diharapkan | Valid |

**o. Pengujian pada Menu Rencana Operasional (Renop)**

*Tabel 4.15 Pengujian Fungsional Menu Rencana Operasional*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Verifikasi *fetching* PDF | Menekan tombol pratinjau/baca tabel Renop | Halaman bergeser mengirim bacaan rujukan dokumen secara valid | Sesuai dengan yang diharapkan | Valid |

**p. Pengujian pada Menu Standar Operasional Prosedur (SOP)**

*Tabel 4.16 Pengujian Fungsional Menu SOP*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | *Request Force DL* | Menekan tombol Unduh di sebuah tabel SOP | Format penamaan .pdf SOP terdeteksi, unduhan sukses memicu | Sesuai dengan yang diharapkan | Valid |

**q. Pengujian pada Menu Penelitian**

*Tabel 4.17 Pengujian Fungsional Menu Penelitian Dosen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Verifikasi *Hyperlink* | Menekan tautan referensi Jurnal dari tabel Publikasi | Browser membuka [*tab baru*] tepat menuju halaman karya ilmiah Dosen | Sesuai dengan yang diharapkan | Valid |

**r. Pengujian pada Menu Pengabdian Masyarakat**

*Tabel 4.18 Pengujian Fungsional Menu Pengabdian*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses rekap pengabdian | Klik Riset > "Pengabdian" | Daftar waktu, lokasi pelaksanaan PKM ditampilkan sempurna. | Sesuai dengan yang diharapkan | Valid |

**s. Pengujian pada Menu BEM**

*Tabel 4.19 Pengujian Fungsional Menu BEM*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses Kabinet Organisasi | Klik Kemahasiswaan > "BEM" | Bagian teks nama kabinet, logo dan foto gubernur dimuat bersih | Sesuai dengan yang diharapkan | Valid |

**t. Pengujian pada Menu UKM & HMPS**

*Tabel 4.20 Pengujian Fungsional Menu UKM & HMPS*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses profil UKM | Klik Kemahasiswaan > "Himpunan / UKM" | Senarai struktur logo unit himpunan diposisikan tanpa bertindihan | Sesuai dengan yang diharapkan | Valid |

**u. Pengujian pada Menu Berita / Artikel**

*Tabel 4.21 Pengujian Fungsional Menu Berita*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Membaca berita tunggal | Menekan pemicu tautan *"Baca Selengkapnya"* | Mesin *routing* mencocokkan parameter slug ID artikel mendarat valid | Sesuai dengan yang diharapkan | Valid |

---

## B. Pengujian Halaman Administrator (Backend Dasbor)

**a. Pengujian pada Proses Login Admin**

*Tabel 4.22 Pengujian Fungsional Proses Login Admin*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Login dengan data valid | Username `admin` dan password diisi benar | Sistem berhasil login dan menampilkan dashboard sesuai spesifikasi | Sesuai dengan yang diharapkan | Valid |
| 2 | Username kosong | Username kosong, password diisi | Sistem menampilkan pesan kesalahan bahwa username wajib diisi | Sesuai dengan yang diharapkan | Valid |
| 3 | Password kosong | Username diisi, password kosong | Sistem menampilkan pesan kesalahan bahwa password wajib diisi | Sesuai dengan yang diharapkan | Valid |
| 4 | Kredensial tidak logis | Memasukkan tebakan sembarang password | Sistem mengembalikan notifikasi kredensial salah / ditolak *backend* | Sesuai dengan yang diharapkan | Valid |

**b. Pengujian pada Menu Dashboard**

*Tabel 4.23 Pengujian Fungsional Menu Dashboard*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Integrasi *Counter* matrik | Hitungan dasar relasional *Database* | *Info Boxes* merefleksikan hitungan langsung (*Total Pendaftar* dll) stabil | Sesuai dengan yang diharapkan | Valid |

**c. Pengujian pada Menu Kelola Slider**

*Tabel 4.24 Pengujian Fungsional Menu Kelola Slider*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah Transisi Utama | Menyertakan *.JPG* besar di kolom `Tambah` | Ekstrak fail dieksekusi sah memasuki sistem rotasi utama beranda | Sesuai dengan yang diharapkan | Valid |
| 2 | Menghapus File Slider | Menekan operasi *hapus (Delete)* baris aset | Rekam *database* rontok serempak fail fisikal musnah dari `uploads/` | Sesuai dengan yang diharapkan | Valid |

**d. Pengujian pada Menu Kelola Sambutan Fakultas**

*Tabel 4.25 Pengujian Fungsional Menu Kelola Sambutan Dekan*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Sunting deskriptif dekan | Menulis rubahan narasi lalu klik "Simpan" | Pergantian terminologi teks sukses menimpa isi halaman publik seketika | Sesuai dengan yang diharapkan | Valid |

**e. Pengujian pada Menu Kelola Fakta Institusi**

*Tabel 4.26 Pengujian Fungsional Menu Kelola Fakta*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Revaluasi angka lulusan | Menyediakan form *update* dengan angka '1500' | Atribut entitas berganti di tabel, antarmuka publik turut berganti angka riil | Sesuai dengan yang diharapkan | Valid |

**f. Pengujian pada Menu Kelola Visi Misi**

*Tabel 4.27 Pengujian Fungsional Menu Kelola Visi Misi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah / Rubah Visi | Mengetik karakter spesial (`<script>`) | Form menerima dengan penetralan *XSS*, tabel termutakhir dengan aman | Sesuai dengan yang diharapkan | Valid |

**g. Pengujian pada Menu Kelola Struktur Organisasi**

*Tabel 4.28 Pengujian Fungsional Menu Kelola Struktur Organisasi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Ganti *Cover* Bagan | Lempar dokumen gambar form *update* | *Unlink* file usang mengeksekusi mulus, disisip penimpaan fail mutakhir | Sesuai dengan yang diharapkan | Valid |

**h. Pengujian pada Menu Kelola Dosen**

*Tabel 4.29 Pengujian Fungsional Menu Kelola Dosen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Ciptakan Profil / *NIDN* | Menyerahkan atribut nama, jabatan, NIDN | Seluruh korelasi form mendarat pada *log* memori dan matriks disegarkan | Sesuai dengan yang diharapkan | Valid |
| 2 | *Delete Action Target* | Menekan klik pada *badge hapus* parameter | Referensi baris entitas terhapus permanen dari relasi rekam *database* | Sesuai dengan yang diharapkan | Valid |

**i. Pengujian pada Menu Kelola Pendaftaran PMB**

*Tabel 4.30 Pengujian Fungsional Menu Kelola Pendaftaran (PMB)*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Analisa Berkas Masuk | Menekan rincian "Detail/Ijazah" | Administrator disediakan paparan interaktif isi dokumen PMB di *Modal View* | Sesuai dengan yang diharapkan | Valid |
| 2 | Rotasi Status Persetujuan | Parameter rintisan "Pending" dirubah "Diterima" | Lencana peninjau tergantikan (hijau), rekam basis log tercetak mutakhir | Sesuai dengan yang diharapkan | Valid |

**j. Pengujian pada Menu Kelola Kurikulum**

*Tabel 4.31 Pengujian Fungsional Menu Kelola Kurikulum*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Penanaman Arsip PDF | Menyerahkan `.pdf` silabus S1-TI pada *add* | Validasi mendeteksi tipe lampiran aman, dan memarkir file di *Directory* lokal | Sesuai dengan yang diharapkan | Valid |

**k. Pengujian pada Menu Kelola Kalender Akademik**

*Tabel 4.32 Pengujian Fungsional Menu Kelola Kalender*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Edit rentang hari UTS | Merubah atribut *Date Picker* operasional jadwal | Sinkronasi nilai modifikasi baru menyebrang aktual di papan *frontend* | Sesuai dengan yang diharapkan | Valid |

**l. Pengujian pada Menu Kelola Ruangan (Sarpras)**

*Tabel 4.33 Pengujian Fungsional Menu Sarana & Prasarana*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah aset ruang kelas | Mendaftarkan ruang + pratinjau gambarnya | Basis matriks mencanangkan *Create row*, memosisikan ruangan tanpa disrupsi. | Sesuai dengan yang diharapkan | Valid |

**m. Pengujian pada Menu Kelola Laboratorium**

*Tabel 4.34 Pengujian Fungsional Menu Laboratorium*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Hapus koleksi *hardware* | Membunuh referensi *Delete Target* lab sentral | Pencabutan ID melunturkan rekam log dan mensterilisasi memori *path server* fail. | Sesuai dengan yang diharapkan | Valid |

**n. Pengujian pada Menu Kelola SOP**

*Tabel 4.35 Pengujian Fungsional Menu Kelola SOP*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Masukkan berkas operasional | Lampirkan dokumen baru berekstensi *PDF* | Validasi menangkap wujud form utuh menyimpan pangkalan repositori resmi. | Sesuai dengan yang diharapkan | Valid |

**o. Pengujian pada Menu Kelola Renstra**

*Tabel 4.36 Pengujian Fungsional Menu Kelola Renstra*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Manajemen pembaruan fail | Ganti dokumen lama dengan PDF rujukan anyar | Perangkat sistem membongkar dokumen *file stream* lawas ditindih eksistensi terbaru | Sesuai dengan yang diharapkan | Valid |

**p. Pengujian pada Menu Kelola Renop**

*Tabel 4.37 Pengujian Fungsional Menu Kelola Renop*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Manajemen arsip tabel | Pemusnahan data *Delete* dari Dasbor operator | Pelunturan ID menenggelamkan sinkronasi data *Renop* dengan rapi pada *frontend* | Sesuai dengan yang diharapkan | Valid |

**q. Pengujian pada Menu Kelola Penelitian**

*Tabel 4.38 Pengujian Fungsional Menu Kelola Penelitian*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Rekam *URL Hyperlink* Publikasi | Berikan form rujukan alamat URL https://.. | URL terikat presisi dan siap dialihkan kembali saat parameter ditekan publik | Sesuai dengan yang diharapkan | Valid |

**r. Pengujian pada Menu Kelola Pengabdian**

*Tabel 4.39 Pengujian Fungsional Menu Kelola Pengabdian*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pelaksanaan riset PKM | Pemberian form isian lokasi, waktu & tanggal | Pemutakhiran berformat deskriptif teregister sah menumpuk matriks bacaan | Sesuai dengan yang diharapkan | Valid |

**s. Pengujian pada Menu Kelola BEM / UKM**

*Tabel 4.40 Pengujian Fungsional Menu Kelola Organisasi (BEM/UKM)*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pembaharuan foto *Logo* | Serahkan *.PNG* lambang organisasi BEM mutakhir | File logo masuk rotasi pembaruan dan menggantung stabil pada susunan UI depan | Sesuai dengan yang diharapkan | Valid |

**t. Pengujian pada Menu Kelola Artikel Berita**

*Tabel 4.41 Pengujian Fungsional Menu Kelola Berita*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Susun redaksi publikasi | Tumbuhkan artikel panjang bertipe *Rich Text* | Rekam komputasi melestarikan entri spasi peliputan (*formatting*) secara sinkron | Sesuai dengan yang diharapkan | Valid |
| 2 | Pemenggalan *drop record* | Eksekusi tombol aksi "Hapus" berita lama | Perkara modifikasi merealisasikan *Unlink image cover* beserta *drop* pangkalan dasar | Sesuai dengan yang diharapkan | Valid |

**u. Pengujian pada Menu Kelola Kerjasama (MoU)**

*Tabel 4.42 Pengujian Fungsional Menu Kelola Kerjasama*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pemeliharaan berkas mitra eksternal | Menyematkan ID nama korporasi dan PDF MOU | Sinkronasi form terekam mantap memperlihatkan barisan korporat afiliasi peladen | Sesuai dengan yang diharapkan | Valid |
