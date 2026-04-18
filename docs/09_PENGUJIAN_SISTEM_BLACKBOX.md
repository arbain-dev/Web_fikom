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
| 1 | Kirim form data valid | Mengisi seluruh *field* identitas dan unggah gambar bukti sah | Sistem menyimpan form pendaftaran dan memunculkan notifikasi sukses | Sesuai dengan yang diharapkan | Valid |
| 2 | Kirim tanpa input wajib | Mengosongkan isian form (*Blank*), dan menekan *Submit* | Sistem memblokir eksekusi pengiriman dan menandai info wajib isi | Sesuai dengan yang diharapkan | Valid |
| 3 | Upload ekstensi ditolak | Kolom unggah diisi file `script.php` yang dilarang peladen | Sistem mengirim balik peringatan jenis format dilarang (Validasi) | Sesuai dengan yang diharapkan | Valid |

**g. Pengujian pada Menu Kurikulum**

*Tabel 4.7 Pengujian Fungsional Menu Kurikulum*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses daftar kurikulum | Klik navigasi Akademik > "Kurikulum" | Sistem memuat parameter tabel mata kuliah prodi | Sesuai dengan yang diharapkan | Valid |
| 2 | Unduh dokumen silabus | Klik tombol "Unduh PDF" pada aksi baris prodi | Sistem mendelegasikan perintah transfer HTTP *Download file* (.pdf) | Sesuai dengan yang diharapkan | Valid |

**h. Pengujian pada Menu Kalender Akademik**

*Tabel 4.8 Pengujian Fungsional Menu Kalender Akademik*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses tabel Kalender | Klik navigasi Akademik > "Kalender Akademik" | Sistem menayangkan detail tabel agenda semesteran tanpa *timeout* | Sesuai dengan yang diharapkan | Valid |

**i. Pengujian pada Menu S1 Teknik Informatika**

*Tabel 4.9 Pengujian Fungsional Menu Teknik Informatika*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Lihat profil keahlian | Klik Program Studi > "S1 Teknik Informatika" | Tampilan ulasan *output* S1 TI sukses dimunculkan di halaman klien | Sesuai dengan yang diharapkan | Valid |

**j. Pengujian pada Menu S1 Pendidikan Teknologi Informasi**

*Tabel 4.10 Pengujian Fungsional Menu Pend. Tek. Informasi (PTI)*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Lihat identitas prodi PTI | Klik Program Studi > "S1 Pend. Tek. Informasi" | Sistem merender tampilan profil lulusan Keguruan PTI transparan | Sesuai dengan yang diharapkan | Valid |

**k. Pengujian pada Menu Sarana & Prasarana**

*Tabel 4.11 Pengujian Fungsional Menu Sarana & Prasarana*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses *list* sarpras | Klik Fasilitas > "Sarana Prasarana" | *Grid* dokumentasi aset ruang kelas berhasil dilukis ke layar *Browser* | Sesuai dengan yang diharapkan | Valid |
| 2 | Pop-up resolusi tajam | Klik pratinjau aset gambar pada galeri sarpras | Mekanisme *Lightbox Modal* muncul merefleksikan resolusi unggulan | Sesuai dengan yang diharapkan | Valid |

**l. Pengujian pada Menu Laboratorium**

*Tabel 4.12 Pengujian Fungsional Menu Laboratorium*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Rincian inventaris Lab | Klik Fasilitas > "Laboratorium" | Rincian perangkat *hardware* dan galeri sentral laboratorium termuat | Sesuai dengan yang diharapkan | Valid |

**m. Pengujian pada Menu Dokumen Fakultas**

*Tabel 4.13 Pengujian Fungsional Menu Dokumen Fakultas*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Penelusuran arsip | Menekan tombol "Unduh" untuk arsip reguler fakultas | Mesin *Routing* mengonfirmasi ekspor ke repositori penyimpanan | Sesuai dengan yang diharapkan | Valid |

**n. Pengujian pada Menu Rencana Strategis (Renstra)**

*Tabel 4.14 Pengujian Fungsional Menu Rencana Strategis*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Navigasi tabel Renstra | Klik navigasi "Dokumen" > "Rencana Strategis" | Relasi dokumen dari memori SQL berhasil dikemas di matriks publik | Sesuai dengan yang diharapkan | Valid |

**o. Pengujian pada Menu Rencana Operasional (Renop)**

*Tabel 4.15 Pengujian Fungsional Menu Rencana Operasional*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Verifikasi PDF Renop | Menekan aksi baca parameter tabel Renop | File direksi dokumen terekspor transparan ke aplikasi eksternal pembaca | Sesuai dengan yang diharapkan | Valid |

**p. Pengujian pada Menu Standar Operasional Prosedur (SOP)**

*Tabel 4.16 Pengujian Fungsional Menu SOP*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | *Download Procedure* | Menekan klik pada tombol Unduh salah satu Dokumen SOP | Siklus aliran balik jaringan membongkar lampiran unduhan .pdf akurat | Sesuai dengan yang diharapkan | Valid |

**q. Pengujian pada Menu Penelitian**

*Tabel 4.17 Pengujian Fungsional Menu Penelitian Dosen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Referensi Jurnal Riset | Menekan tautan Jurnal / Sitasi eksternal riset rujukan | Arah peladen membuka jendela baru menuju basis penerbit (mis: Sinta) | Sesuai dengan yang diharapkan | Valid |

**r. Pengujian pada Menu Pengabdian Masyarakat**

*Tabel 4.18 Pengujian Fungsional Menu Pengabdian*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Peninjauan skema PKM | Klik menu utama navigasi web terkait Pengabdian | Barisan senarai waktu kegiatan beserta rekap lokasinya valid terekstrak | Sesuai dengan yang diharapkan | Valid |

**s. Pengujian pada Menu BEM**

*Tabel 4.19 Pengujian Fungsional Menu BEM*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Visualisasi profil BEM | Akses navigasi "Badan Eksekutif Mahasiswa" | Komparasi resolusi logo kabinet bersama foto gubernur dimuat utuh | Sesuai dengan yang diharapkan | Valid |

**t. Pengujian pada Menu UKM & HMPS**

*Tabel 4.20 Pengujian Fungsional Menu UKM & HMPS*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Senarai susunan UKM | Mengklik identitas menu "Himpunan Organisasi / UKM" | Logo entitas komunitas disandingkan konsisten dengan deskripsi visinya | Sesuai dengan yang diharapkan | Valid |

**u. Pengujian pada Menu Berita / Artikel**

*Tabel 4.21 Pengujian Fungsional Menu Berita*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Akses rincian narasi | Menekan salah satu blok *Thumbnail* atau baca rincian | Sistem menjejaki ID referensial URL slug guna memaparkan bacaan rinci | Sesuai dengan yang diharapkan | Valid |

---

## B. Pengujian Halaman Administrator (Backend Dasbor)

**a. Pengujian pada Proses Login Admin**

*Tabel 4.22 Pengujian Fungsional Proses Login Admin*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Login dengan data valid | Username `admin` dan password diisi spesifikasi akurat | Sistem berhasil login, melegitimasi aksi Sesi (Session), beralih rute Dasbor | Sesuai dengan yang diharapkan | Valid |
| 2 | Form Username terlewat | Kolom atribut nama pengguna (*Blank*), password diisi | Sistem menolak pengiriman dan mencetak keterangan isian diwajibkan | Sesuai dengan yang diharapkan | Valid |
| 3 | Form Password terlewat | Username dikonfigurasi, kunci sandi form dibiarkan kosong (*Blank*) | Sistem tidak melanjutkan *Post Request*, mengirim pengingat *Required* | Sesuai dengan yang diharapkan | Valid |
| 4 | Kredensial kombinasi cacat | Tebakan kombinasi password tidak akurat / sembarang | Sistem mengembalikan notifikasi kredensial dilarang oleh lapisan sekuritas | Sesuai dengan yang diharapkan | Valid |

**b. Pengujian pada Menu Dashboard**

*Tabel 4.23 Pengujian Fungsional Menu Dashboard*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | *Generate Counter* matriks | Indeks antarmuka modul komputasi melancarkan SQL agregat | Layar *Info Boxes* menangkap variabel perhitungan langsung mutakhir | Sesuai dengan yang diharapkan | Valid |

**c. Pengujian pada Menu Kelola Slider Beranda**

*Tabel 4.24 Pengujian Fungsional Menu Kelola Slider*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah Data Slider | Memilih fail gambar promosi JPG pada form dan klik "Simpan" | Gambar berhasil terekstrak ke pangkalan folder `uploads` *server* | Sesuai dengan yang diharapkan | Valid |
| 2 | Eksekusi Hapus Slider | Menemukan baris fail SPK usang, memilih tombol "Hapus" | Sistem mencerabut baris rekaman, plus aksi *drop fail fisikal* divalidasi mutlak | Sesuai dengan yang diharapkan | Valid |

**d. Pengujian pada Menu Kelola Sambutan Fakultas**

*Tabel 4.25 Pengujian Fungsional Menu Kelola Sambutan Dekan*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pembaruan teks sambutan | Memodifikasi variabel deskriptif form teks, luahkan klik "Update" | Rekonstruksi kalimat sukses tersimpan, *view output* pengunjung berubah instan | Sesuai dengan yang diharapkan | Valid |

**e. Pengujian pada Menu Kelola Fakta Institusi**

*Tabel 4.26 Pengujian Fungsional Menu Kelola Fakta*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Penambahan Metrik | Mengisi parameter keterangan nominal baru lalu *Create* | Variabel deret hitungan ditambahkan ke lumbung arsitektur tabel | Sesuai dengan yang diharapkan | Valid |
| 2 | Pembaruan Angka (*Edit*) | Menekan Edit pada *record* spesifik, substitusi angka > Simpan | Tabel menolak duplikasi row, justru menimpa entitas usang sukses | Sesuai dengan yang diharapkan | Valid |
| 3 | Pembongkaran Metrik (*Delete*) | Peluncuran modifikasi memusnahkan ID relasional (Hapus) | Matriks berkurang rasionya, terelminasi dari pandangan klien antarmuka | Sesuai dengan yang diharapkan | Valid |

**f. Pengujian pada Menu Kelola Visi Misi**

*Tabel 4.27 Pengujian Fungsional Menu Kelola Visi Misi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Distribusi Entri Baru | Menyisipkan untai alinea baru visi/misi > Simpan Baru | Entri mendarat menempatkan diri menyesuaikan ID Auto-Increment tabel | Sesuai dengan yang diharapkan | Valid |
| 2 | Penyuntingan Konten | Merubah susunan klausa poin spesifik, serahkan klik pembaruan | Nilai parameter digantikan luwes dengan perlindungan *Safe Edit string* | Sesuai dengan yang diharapkan | Valid |
| 3 | Pelepasan Entri (*Delete*) | Konfirmasi pencabutan *Warning Alert* aksi penghapusan | Eksekusi Hapus disetujui, mencabut tuntas pangkalan visibilitas halaman | Sesuai dengan yang diharapkan | Valid |

**g. Pengujian pada Menu Kelola Struktur Organisasi**

*Tabel 4.28 Pengujian Fungsional Menu Kelola Struktur Organisasi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Mengganti Bagan Gambar | Sediakan substitusi unggahan fail `.jpg` Bagan Fakultas Mutakhir | Fail lawas digugurkan (*Delete Unlink*), ditimpa permanen struktur barunya | Sesuai dengan yang diharapkan | Valid |

**h. Pengujian pada Menu Kelola Dosen**

*Tabel 4.29 Pengujian Fungsional Menu Kelola Dosen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Create / Tambah NIDN Baru | Input Biodata utuh (Nama, NIDN, Jabatan) disertakan Pas Foto | Log parameter tercetak, swafoto dirender tabel memori berhasil diamankan | Sesuai dengan yang diharapkan | Valid |
| 2 | Update / Edit Narasi Riwayat | Penyesuaian nama gelar tanpa modifikasi pengunduhan File gambar | *Update query string* mengolah modifikasi teks tanpa menuduh error rujukan foto | Sesuai dengan yang diharapkan | Valid |
| 3 | Delete / Hapus Target | Eksternalisasi aksi pencabutan ID Dosen (Hapus Data) | Sinkronisasi relasional gambar miliknya di folder ikut lenyap membersihkan lajur | Sesuai dengan yang diharapkan | Valid |

**i. Pengujian pada Menu Kelola Pendaftaran PMB**

*Tabel 4.30 Pengujian Fungsional Menu Kelola Pendaftaran (PMB)*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Modifikasi Status Penerimaan | Dropdown indikator (Misal: dari *"Pending"* menjadi *"Diterima"*) | Lencana matriks PMB mekar *Hijau* transparan meresmikan konfirmasi di sisi peladen | Sesuai dengan yang diharapkan | Valid |
| 2 | Aksi Tinjau Dokumen Calon | Tombol "Lihat File/Berkas Lampiran" diklik Admin | Aplikasi mencetus resolusi pop-up interaktif memperlihatkan scan ID ijazahnya | Sesuai dengan yang diharapkan | Valid |
| 3 | Pembersihan Riwayat Gugur | Operasional eksekusi *Hapus Target* PMB kedaluwarsa | Pemusnahan data *record* MySQL dikonfirmasi usai, membersihkan lumbung kuota | Sesuai dengan yang diharapkan | Valid |

**j. Pengujian pada Menu Kelola Kurikulum**

*Tabel 4.31 Pengujian Fungsional Menu Kelola Kurikulum*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Peluncuran File Silabus | Entri lampiran file berkas PDF Kurikulum S1 dan simpan | *Storage constraint* mengunci fail secara resmi pada peladen basis pengunduh | Sesuai dengan yang diharapkan | Valid |
| 2 | Edit Deskripsi Kurikulum | Rincian nama prodi atau judul disunting form `Ubah` | Identifikasi nama modul termutakhir tanpa merusak relasi penyimpanan file lamanya | Sesuai dengan yang diharapkan | Valid |
| 3 | Penarikan (*Drop*) Silabus | Eliminasi ID relasi tabel dari Dasbor Kurikulum | Mesin otomatis mencabut entitas baris beserta berkas fisik kurikulum bersangkutan | Sesuai dengan yang diharapkan | Valid |

**k. Pengujian pada Menu Kelola Kalender Akademik**

*Tabel 4.32 Pengujian Fungsional Menu Kelola Kalender Akademik*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Injeksi Agenda Semester | Tambah form nama kegiatan & tanggal kalender | Riwayat logis dicangkokkan mulus di matriks dan siap dihamparkan di klien Publik | Sesuai dengan yang diharapkan | Valid |
| 2 | Pembaruan Rentang Tanggal | Koreksi/Edit kekeliruan atribut kalender jadwal | Penyuntikan modifikasi *integer tanggal* ditampung stabil memicu perbaikan tabel | Sesuai dengan yang diharapkan | Valid |
| 3 | Pembatalan Matriks Jadwal | Pemotongan/Hapus matriks agenda libur/ujian lawas | Pemutusan sinkronasi tabel dikonfirmasi bersih seiring konfirmasi peringatan sukses | Sesuai dengan yang diharapkan | Valid |

**l. Pengujian pada Menu Kelola Ruangan (Sarpras)**

*Tabel 4.33 Pengujian Fungsional Menu Sarana & Prasarana*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Enkripsi Tambah Gedung | Integrasi form kapasitas ruang & foto rujukan fisik | Rintisan aset berhasil dimuat pada galeri antarmuka depan secara estetikal | Sesuai dengan yang diharapkan | Valid |
| 2 | Ubah Deskripsi / Gambar | Manipulasi letak teks nama kelas atau foto terbaru | Relasi *Update Constraint* mengecilkan resolusi merampungkan transisi pergantian aman | Sesuai dengan yang diharapkan | Valid |
| 3 | Hapus Target Bangunan | Pemutusan rantai identitas Gedung dari basis sistem | Sinkronasi penghapusan mengeksekusi penarikan memori tabel dan relasi folder mutlak | Sesuai dengan yang diharapkan | Valid |

**m. Pengujian pada Menu Kelola Laboratorium**

*Tabel 4.34 Pengujian Fungsional Menu Laboratorium*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pendataan Instrumen Lab | Menambah perlengkapan/inventaris alat tabel laborat | Mesin mendaftarkan komponen ke pangkalan tabel rincian lab yang stabil | Sesuai dengan yang diharapkan | Valid |
| 2 | Sunting Koreksi Spesifikasi| Menyesuaikan nama merk *hardware*/kapasitas komponen | Pengkinian parameter instrumen tersalin luwes ditengah himpunan matriks | Sesuai dengan yang diharapkan | Valid |
| 3 | Penghapusan Inventaris | Tekan *drop row* instrumen komputer lab tak terpakai | Baris perangkat dihilangkan sistem menyesuaikan aset *inventory server* yang ada | Sesuai dengan yang diharapkan | Valid |

**n. Pengujian pada Menu Kelola SOP**

*Tabel 4.35 Pengujian Fungsional Menu Kelola SOP*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Impor Ekstensi SOP | Melempar File berekstensi *PDF* ke gerbang kelola SOP | Penjaga sistem *(Mime Validator)* menerima parameter dan membentengi di server | Sesuai dengan yang diharapkan | Valid |
| 2 | Koreksi Tajuk Prosedur | Merubah rincian abjad judul narasi SOP di form | Form modifikasi sukses meralat pangkalan rekam nama tabel logis aslinya | Sesuai dengan yang diharapkan | Valid |
| 3 | Hapus Berkas Standar | Lakukan penarikan instrumen (Delete file) dari Admin | Rantai logis diputus tuntas beriringan ditiadakannya duplikat fail pada lokal | Sesuai dengan yang diharapkan | Valid |

**o. Pengujian pada Menu Kelola Renstra**

*Tabel 4.36 Pengujian Fungsional Menu Kelola Renstra*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Enlisting Arsip Renstra | Unggah penempatan dokumen Strategis rujukan (.pdf) | Peladen mengatur repositori dengan valid menindak permintaan memori form | Sesuai dengan yang diharapkan | Valid |
| 2 | Pemusnahan Tabel Strategis | *Delisting* fail terlama dengan melempar parameter Hapus | Modul membatalkan identitas rekos dan membakar duplikatnya memulihkan pangkalan | Sesuai dengan yang diharapkan | Valid |

**p. Pengujian pada Menu Kelola Renop**

*Tabel 4.37 Pengujian Fungsional Menu Kelola Renop*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Upload Operasional | Memberikan pasokan log dokumen Renop di antarmuka | Berkas termuat sempurna direkapsulasi antarmuka *(PDF vault)* tabel | Sesuai dengan yang diharapkan | Valid |
| 2 | Hapus Riwayat Operasional | Eliminasi perwakilan dokumen Renop lewat pemicu khusus | Sel-sel relasi memori digembok ditutup aksesnya via pemotongan *ID array* utuh | Sesuai dengan yang diharapkan | Valid |

**q. Pengujian pada Menu Kelola Penelitian**

*Tabel 4.38 Pengujian Fungsional Menu Kelola Penelitian*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Enlisting Tautan Karya Ilmiah | Menyerahkan matriks form judul riset + link URL sitasi | Referensi taut masuk basis *hyperlink text* dengan format yang siap dipicu eksternal | Sesuai dengan yang diharapkan | Valid |
| 2 | Pembaruan Jurnal Link | Menambal / *Edit URL* yang cacat, tekan *Update* form | Pangkalan peladen mengatur kembali susunan target link dengan adaptasi seketika | Sesuai dengan yang diharapkan | Valid |
| 3 | Pemberangusan Baris Tabel | Menekan *Row deletion target* (Hapus parameter tabel) | Penayangan riset bersangkutan diberhentikan dan dicabut presisi oleh MySQL | Sesuai dengan yang diharapkan | Valid |

**r. Pengujian pada Menu Kelola Pengabdian**

*Tabel 4.39 Pengujian Fungsional Menu Kelola Pengabdian*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Insersi Log Baris PKM | Pendaftaran rute lokasi, rentang hari aktivitas komunitas | Catatan rekam mendarat logis memicu peresapan antarmuka tabel Publikasi | Sesuai dengan yang diharapkan | Valid |
| 2 | Edit Variabel Tanggal | Pelurusan penyuntingan spesifik letak / durasi PKM | Modifikasi pelurusan terekam mencerminkan susunan *Query Output* valid | Sesuai dengan yang diharapkan | Valid |
| 3 | Pembatalan Logis Row | Hapus kolom baris PKM rintisan usang | Pembersihan pangkalan dieksekusi menyeimbangkan relasi tontonan matriks depan | Sesuai dengan yang diharapkan | Valid |

**s. Pengujian pada Menu Kelola BEM / UKM**

*Tabel 4.40 Pengujian Fungsional Menu Kelola Organisasi (BEM/UKM)*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Register Profil BEM/UKM Baru | Impor logo grafis organisasi (.png) dipadu rincian deskriptif | Asosiasi logo dengan bagan lembaga kepengurusan dibangkitkan berimbang | Sesuai dengan yang diharapkan | Valid |
| 2 | Pemutakhiran Visi HMPS | Form edit mengunggah pergantian kepengurusan naskah | Pembaruan merekam tulisan/resolusi form tak mendistorsi eksistensi Logo | Sesuai dengan yang diharapkan | Valid |
| 3 | Terminasi Profil UKM | Singkirkan (*Drop*) form himpunan non-aktif dari matriks | Penyusutan referensi direalisasikan serempak file Gambar terkait dibersihkan peladen | Sesuai dengan yang diharapkan | Valid |

**t. Pengujian pada Menu Kelola Artikel Berita**

*Tabel 4.41 Pengujian Fungsional Menu Kelola Artikel Berita*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Impor Naskah Publikasi Baru | Pengaturan elemen redaksional berteks panjang/ *Rich formatting* plus Gambar *Thumbnail* sampul | Komputasi menjaga spasi paragraf dan tautan relasi parameter *slug/URL* dirender teguh | Sesuai dengan yang diharapkan | Valid |
| 2 | Edit / Sunting Kesalahan Tajuk| Sinkronisasi pengeditan baris tulisan di rincian (*Edit*) | Pengetikan ralat menaikkan referensi penulisan tanpa merusak ekstensi pangkalan Cover | Sesuai dengan yang diharapkan | Valid |
| 3 | Pembongkaran/Delete Rubrik | Konfirmasi pembunuhan artikel lama di Dasbor | Perkara eksekusi penarikan sukses memberangus memori beserta file pelampirannya spesifik | Sesuai dengan yang diharapkan | Valid |

**u. Pengujian pada Menu Kelola Kerjasama (MoU)**

*Tabel 4.42 Pengujian Fungsional Menu Kelola Kerjasama*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Rintisan Berkas Kerja Sama | Pasokan rincian nama kolega instansi bersama dokumen lampiran MoU (.pdf) | Pelarasan sinkronisasi mengesahkan ikatan fail tersebut teregistrasi dengan status OK | Sesuai dengan yang diharapkan | Valid |
| 2 | Ralat Identifikasi Relasi | Membongkar (*Edit*) kesalahan input form mitra | Adaptasi perbaikan form ditujukan ke arah yang logis memulihkan korelasi tontonnya | Sesuai dengan yang diharapkan | Valid |
| 3 | Perombakan Arsip File MoU | Melancarkan parameter Drop (Hapus) kesepahaman lawas | Berkas usang digugurkan memutus aliran pelenturan MySQL beserta file-nya secara riil | Sesuai dengan yang diharapkan | Valid |

---

## 4.4.3 Kesimpulan Akhir Pematangan Pengujian Black Box

Berdasarkan paparan masif ekosistem instrumen matrikulator antarmuka (**Total 42 Menu Sistem Fungsional**), rekapitulasi disimpulkan menapak pencapaian fungsionalisasi mutlak **100% VALIDASI TUNTAS / OPTIMAL**. Segala skenario integrasi *CRUD Data Handling* (Penambahan, Penyuntingan, hingga Peluruhan) di sisi arsitektur dasbor relasional mengesahkan sinkronitas dengan perlindungan presisi antarmuka. Pelarangan input liyan (*Mime-Type Guarding/Null input blocking*) direspons sempurna, menjamin peladen ini siap meluncur ke fase produksi sivitas akademik dengan tangguh.
