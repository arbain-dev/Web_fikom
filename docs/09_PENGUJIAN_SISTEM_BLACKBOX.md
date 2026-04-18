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
| 1 | Verifikasi *fetching* PDF | Menekan tombol pratinjau/baca tabel Renop | Halaman bergeser mengirim bacaan rujukan dokumen secara valid | Sesuai dengan yang diharapkan | Valid |

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
| 2 | Form Username terlewat | Kolom atribut nama pengguna (*Blank*), password diisi | Sistem menolak pengiriman dan mencetak pesan bahwa username wajib diisi | Sesuai dengan yang diharapkan | Valid |
| 3 | Form Password terlewat | Username dikonfigurasi, kunci sandi form dibiarkan kosong (*Blank*) | Sistem menolak proses login dan mencampur parameter password dilarang kosong | Sesuai dengan yang diharapkan | Valid |
| 4 | Kredensial kombinasi cacat | Tebakan kombinasi username/password salah atau tidak terdaftar | Sistem memblokir akses dan mengembalikan notifikasi kredensial gagal otentikasi | Sesuai dengan yang diharapkan | Valid |

**b. Pengujian pada Menu Dashboard**

*Tabel 4.23 Pengujian Fungsional Menu Dashboard*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | *Generate Counter* matriks | Indeks antarmuka modul komputasi melancarkan SQL agregat | Layar *Info Boxes* menangkap variabel perhitungan secara waktu nyata (*Real-time*) | Sesuai dengan yang diharapkan | Valid |

**c. Pengujian pada Menu Kelola Slider Beranda**

*Tabel 4.24 Pengujian Fungsional Menu Kelola Slider*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Tambah Data Slider | Memilih fail gambar promosi JPG pada form dan klik "Simpan" | Gambar berhasil terekstrak ke folder peladen dan termuat di *Frontend* | Sesuai dengan yang diharapkan | Valid |
| 2 | Uji Validasi Format File | Melampirkan berkas dokumen non-gambar (misal `.exe`) ke form | Sistem menangkis *upload* dan memberikan peringatan "Format file dilarang" | Sesuai dengan yang diharapkan | Valid |
| 3 | Eksekusi Hapus Slider | Menekan tombol aksi "Hapus" pada parameter visual usang | Sistem mencerabut baris rekaman sekaligus menarik fail fisiknya dari direktori lokal | Sesuai dengan yang diharapkan | Valid |

**d. Pengujian pada Menu Kelola Sambutan Fakultas**

*Tabel 4.25 Pengujian Fungsional Menu Kelola Sambutan Dekan*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pembaruan teks sambutan | Memodifikasi variabel teks narasi, lalu klik "Update" | Rekonstruksi kalimat sukses tersimpan, menimpa isi halaman publik seketika | Sesuai dengan yang diharapkan | Valid |
| 2 | Uji Form Kosong (*Blank*) | Mengosongkan paksa tajuk dekan dari form kemudian Simpan | Pencegahan sistem *(HTML require)* menandai input kolom wajib agar tak diakali | Sesuai dengan yang diharapkan | Valid |

**e. Pengujian pada Menu Kelola Fakta Institusi**

*Tabel 4.26 Pengujian Fungsional Menu Kelola Fakta*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Penambahan Metrik | Mengisi parameter keterangan nominal baru lalu "Simpan" | Nilai angka baru diabsahkan masuk memori basis tanpa menimbulkan interupsi | Sesuai dengan yang diharapkan | Valid |
| 2 | Uji Validasi Hampa | Memasukkan angka tanpa tajuk atribut judul | Pesan error tertuang mendesak kelengkapan form *(Validation Required)* | Sesuai dengan yang diharapkan | Valid |
| 3 | Pembaruan Angka (*Edit*) | Menekan Edit pada *record* spesifik, substitusi angka > Simpan | Parameter spesifik disesuaikan secara utuh (Update Query Stabil) | Sesuai dengan yang diharapkan | Valid |
| 4 | Pembongkaran Metrik (*Delete*) | Menekan hapus untuk melunturkan relasi spesifik metrik usang | Matriks berkurang rasionya, terelminasi tuntas dari UI pengunjung situs web | Sesuai dengan yang diharapkan | Valid |

**f. Pengujian pada Menu Kelola Visi Misi**

*Tabel 4.27 Pengujian Fungsional Menu Kelola Visi Misi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Distribusi Entri Baru | Menyisipkan untai alinea baru visi/misi > Simpan Baru | Entri mendarat menempatkan diri menyesuaikan ID Auto-Increment tabel | Sesuai dengan yang diharapkan | Valid |
| 2 | Pencegahan Logika Karakter | Simpan susunan berkarakter script HTML terlarang `<script>` | Penetralan *escaped string* berhasil, skrip aman dan tercetak tanpa eksploitasi | Sesuai dengan yang diharapkan | Valid |
| 3 | Penyuntingan Konten | Merubah susunan klausa poin spesifik, serahkan klik pembaruan | Nilai parameter tergabung mulus meng- *override* redaksi teks pendahulu | Sesuai dengan yang diharapkan | Valid |
| 4 | Pelepasan Entri (*Delete*) | Konfirmasi pencabutan aksi penghapusan pada menu kelola | Target ID musnah logis dan pangkalan publik dibersihkan dari *cache* relasinya | Sesuai dengan yang diharapkan | Valid |

**g. Pengujian pada Menu Kelola Struktur Organisasi**

*Tabel 4.28 Pengujian Fungsional Menu Kelola Struktur Organisasi*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Mengganti Bagan Gambar | Substitusi file `.jpg` / unggahan *Bagan Fakultas Mutakhir* | Fail asli lawas digugurkan (*Delete Unlink*), ditimpa permanen aset struktur baru | Sesuai dengan yang diharapkan | Valid |
| 2 | Uji Unggahan Format Cacat | Form bagan diumpan arsip berformat tipe dokumen (`.zip`) | Aplikasi meresisten pelampiran menolak form berwujud larangan sistem | Sesuai dengan yang diharapkan | Valid |

**h. Pengujian pada Menu Kelola Dosen**

*Tabel 4.29 Pengujian Fungsional Menu Kelola Dosen*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Create / Tambah NIDN Baru | Input Biodata utuh (Nama, NIDN, Jabatan) disertakan Pas Foto | Log parameter tercetak, gambar dirender dan matriks berhasil diamankan | Sesuai dengan yang diharapkan | Valid |
| 2 | Uji Validasi Atribut Kosong | Menekan "Simpan" dengan membiarkan kolom Nama tidak terisi | Aplikasi menarik *alert* merah peringatan "Semua field bertanda * harus diisi" | Sesuai dengan yang diharapkan | Valid |
| 3 | Update / Edit Narasi Riwayat | Penyesuaian nama gelar tanpa relasi pergantian unggahan foto | Parameter teks tervalidasi ralat utuh membopong profil foto pertamanya | Sesuai dengan yang diharapkan | Valid |
| 4 | Delete / Hapus Target | Menekan klik ikon "Sampah" (Hapus) ke parameter spesifik barisan | Sinkronisasi relasional gambar beserta matriks tabel musnah membersihkan lajur | Sesuai dengan yang diharapkan | Valid |

**i. Pengujian pada Menu Kelola Pendaftaran PMB**

*Tabel 4.30 Pengujian Fungsional Menu Kelola Pendaftaran (PMB)*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Modifikasi Status Penerimaan | Dropdown rubah status dari *"Pending"* dirubah ke *"Diterima"* | Lencana matriks terganti warna (*Acceptance*) meresmikan persetujuan dari dekan | Sesuai dengan yang diharapkan | Valid |
| 2 | Tinjau Dokumen *Null* | Administrasi memeriksa kolom pelamar tanpa entri *file* ijazah | Deteksi otomatis tabel mencetak keterangan "Error: Berkas tidak diserahkan" | Sesuai dengan yang diharapkan | Valid |
| 3 | Aksi Tinjau Dokumen Valid | Tombol *Action* "Lihat File/Berkas Lampiran" diakses klik | Aplikasi mencetus interaktif memunculkan pindaian Ijazah calon di tengah layar | Sesuai dengan yang diharapkan | Valid |
| 4 | Pembersihan Riwayat Gugur | Operasional intervensi *Hapus Data* PMB calon mahasiswa | Pemusnahan rekam rekap MySQL sukses membersihkan lumbung kuota beroperasi | Sesuai dengan yang diharapkan | Valid |

**j. Pengujian pada Menu Kelola Kurikulum**

*Tabel 4.31 Pengujian Fungsional Menu Kelola Kurikulum*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Peluncuran File Silabus | Entri file `.pdf` spesifikasi silabus Kurikulum lalu "Simpan" | Modul *PHP Upload* menitipkan file secara resmi ke folder *Directory* lokal web | Sesuai dengan yang diharapkan | Valid |
| 2 | Validasi Ekstensi Berbahaya | Form file dikawinkan pelampir persekusi berdimensi `doc.php` | Sistem mendeteksi parameter format tak resmi, dibubarkan dari akses instalasi | Sesuai dengan yang diharapkan | Valid |
| 3 | Edit Deskripsi Kurikulum | Rincian nama prodi atau tajuk tahun akademik disunting form | Pemutakhiran tercapai luwes mempertahankan keakuratan relasi dokumen lawasnya | Sesuai dengan yang diharapkan | Valid |
| 4 | Penarikan (*Drop*) Silabus | Eliminasi relasi *row* tabel kurikulum dari list dasbor | Baris kurikulum bersangkutan lenyap secara akurat, duplikat file didepak sistem | Sesuai dengan yang diharapkan | Valid |

**k. Pengujian pada Menu Kelola Kalender Akademik**

*Tabel 4.32 Pengujian Fungsional Menu Kelola Kalender Akademik*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Injeksi Agenda Semester | Menambah susunan kalender baru dan *date* hari spesifik | Riwayat kalender terekstrak rapi menuju tontonan jadwal tamu matriks depan | Sesuai dengan yang diharapkan | Valid |
| 2 | Intervensi Form Hampa | Memanipulasi isian keterangan riwayat acara bernilai serba *Null* | Kolom parameter *required* mempertahankan kewajiban inputan (*Prevent Default*) | Sesuai dengan yang diharapkan | Valid |
| 3 | Pembaruan Durasi Waktu | Merombak input rentang *tanggal* / bulan jadwal operasi | Sistem sukses mengekspresikan penyesuaian nilai baru yang sinkron ke klien UI | Sesuai dengan yang diharapkan | Valid |
| 4 | Pembatalan Matriks Jadwal | Memotong *row* agenda lama (Hapus Kalender Akademik) | *ID Database* musnah total memandulkan rekam libur pada pengunjung aktual | Sesuai dengan yang diharapkan | Valid |

**l. Pengujian pada Menu Kelola Ruangan (Sarpras)**

*Tabel 4.33 Pengujian Fungsional Menu Sarana & Prasarana*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Konstruksi Rintisan Ruang | Input formulir kapasitas Kelas dan upload parameter gambar visual | Galeri *Frontend* bertambah dengan estetika aset sarana prasarana anyar ruangan | Sesuai dengan yang diharapkan | Valid |
| 2 | Input Ketiadaan Foto | Simpan penamaan Sarpras tanpa disertai injeksi gambar gedung | Sistem komputasi melaporkan defisit lampiran dan mendesak re-orientasi file | Sesuai dengan yang diharapkan | Valid |
| 3 | Perombakan Deskripsi Aset | Perubahan parameter nama Kelas di panel Form *Update Modal* | Relasi pergantian terejawantah aman menyelaraskan *String* baru di matrik depan | Sesuai dengan yang diharapkan | Valid |
| 4 | Pemenggalan Sarana Master | Sinkronisasi permohonan "Hapus Data" ke gedung spesimen | Parameter identitas sarana dicincang sistem beserta peluruh file miliknya sah | Sesuai dengan yang diharapkan | Valid |

**m. Pengujian pada Menu Kelola Laboratorium**

*Tabel 4.34 Pengujian Fungsional Menu Laboratorium*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Instalasi Alat Riset Lab | Penambahan *hardware* rincian fasilitas inventaris laborat | Komponen baru mengorbit memperkuat daftar rincian utilitas spek komputer Lab | Sesuai dengan yang diharapkan | Valid |
| 2 | Uji Kegagalan Validasi | Form entri disubmit kala kolom merk instrumen kosong merana | Aplikasi tangkas meniadakan integrasi MySQL, peladen menangkap celah *blank* | Sesuai dengan yang diharapkan | Valid |
| 3 | Update Mutasi Instrumen | Koreksi pelurusan parameter jumlah RAM / kapasitas inventaris | Metrik termodikasi aman mempertahankan sinkronasi sirkulasi rute asalnya stabil | Sesuai dengan yang diharapkan | Valid |
| 4 | Destruksi Parameter Lab | Mencabut ID alat laboratorium yang cacat / *Drop Record* | Transisi melenyapkan eksistensi baris terkait membersihkan arsip tabel luwes | Sesuai dengan yang diharapkan | Valid |

**n. Pengujian pada Menu Kelola SOP**

*Tabel 4.35 Pengujian Fungsional Menu Kelola SOP*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Ingesti Direktori File SOP | Distribusi arsip baru bertipe operasional PDF | *Validation Constraint* menyetujui parameter utuh meresmikan *upload file* sistem | Sesuai dengan yang diharapkan | Valid |
| 2 | Tolak Unggahan Korup | Operator tanpa sengaja menyerahkan berkas arsip rar (`.zip`) | Peladen mengesampingkan perintah *insert query* mencekal ancaman pelampir liar | Sesuai dengan yang diharapkan | Valid |
| 3 | Redefinisi Tajuk Konteks | Menggeser *Update string title* tanpa mengubah *vault PDF* aslinya | Parameter teks SOP menata diri menyesuaikan revisinya terpadu tanpa distorsi | Sesuai dengan yang diharapkan | Valid |
| 4 | Pelumpuhan Arsip Sentral | Cabut parameter (Delete Data SOP) dari kolom administrator | Pertalian baris rekam disudahi mutlak dibarengi fungsi `unlink()` bersih sempurna | Sesuai dengan yang diharapkan | Valid |

**o. Pengujian pada Menu Kelola Renstra**

*Tabel 4.36 Pengujian Fungsional Menu Kelola Renstra*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pangkalan Dokumen Renstra | Unggah penempatan dokumen Strategis rujukan (.pdf) valid | Basis operasional SQL mencatat waktu unggah mendampingi pelestarian failnya | Sesuai dengan yang diharapkan | Valid |
| 2 | Anomali Tanpa Judul | Kolom nama berkas sengaja dibuat tidak tampak lalu dikirim | Perlindungan basis meregistrasi larangan (*Error handling*) cegah simpan hampa | Sesuai dengan yang diharapkan | Valid |
| 3 | Pemusnahan Indeks Strat | Pembuangan rute barisan dengan menekan "Hapus" parameter | Modul *Unlink File* membakar perwakilan fisikal file Renstra beserta data row ID | Sesuai dengan yang diharapkan | Valid |

**p. Pengujian pada Menu Kelola Renop**

*Tabel 4.37 Pengujian Fungsional Menu Kelola Renop*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Transmisi Dokumen Renop | Rekapsulasi file .pdf manual ditarik operasional Dasbor | Dokumen masuk rotasi tabel *Frontend* menanti tanggapan eksternal pengunduh | Sesuai dengan yang diharapkan | Valid |
| 2 | Ralat Deklarasi Dokumen | Mengunggah duplikat *Renop-V2.pdf* pada posisi *Edit* riwayat | *Query string* memberhentikan file lamanya diganti berkesinambungan file anyar | Sesuai dengan yang diharapkan | Valid |
| 3 | Penyusutan Log Dasbor | Eksekusikan perintah penghapusan Dokumen Operasional | Pelarut memori MySQL menghanguskan seluruh rentetan nama file & relasinya sah | Sesuai dengan yang diharapkan | Valid |

**q. Pengujian pada Menu Kelola Penelitian**

*Tabel 4.38 Pengujian Fungsional Menu Kelola Penelitian*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Ekstrasi Metrik Penelitian | Kirim alamat repositori `https://jurnal.ac.id/riset` | Parameter *hyperlink* tertanam menanti interaktivasi baca publik | Sesuai dengan yang diharapkan | Valid |
| 2 | Kesalahan URL Bodong | Form Link URL sengaja luput diketik *(Missing parameter)* | Tautan ditolak sistem mengharap string protokol *URL Pattern* yang sahih akurat | Sesuai dengan yang diharapkan | Valid |
| 3 | Pembaruan Jurnal Asosiasi | Restitusi arah tautan Jurnal menuju perbaikan rujukan valid | Sinkroniasi terbarui meng- *override* muatan taut usang tanpa menyebarkan defek | Sesuai dengan yang diharapkan | Valid |
| 4 | Penarikan Karya / Delete | Tekan intervensi aksi Hapus paramter riwayat penelitian | Pelacakan indeks dicabut MySQL mengembalikan senarai bebas dari data bersangkutan | Sesuai dengan yang diharapkan | Valid |

**r. Pengujian pada Menu Kelola Pengabdian**

*Tabel 4.39 Pengujian Fungsional Menu Kelola Pengabdian*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Dokumentasi Rute PKM | Penyerahan catatan alamat, tempat, instansi PKM berformat | Atribut terangkum menyumbang penelusuran rekam masyarakat matriks PKM stabil | Sesuai dengan yang diharapkan | Valid |
| 2 | Validasi Defisit Temporal | Mencegat *Save Post* disaat tanggal beroperasi dihilangkan | Fitur perlindungan mencegah eksekusi berargumen penangguhan waktu operasional | Sesuai dengan yang diharapkan | Valid |
| 3 | Modifikasi Rentang Waktu | Edit relasi variabel durasi parameter pengabdian PKM | Pengkinian parameter merangkul baris-baris form yang terkini dipamerkan mulus | Sesuai dengan yang diharapkan | Valid |
| 4 | Pembatalan Eksistensi PKM | Memusnahkan letak referensi parameter PKM usang | *Row Elimination* bertindak mendrop basis perhubungan tuntas dikonfirmasikan | Sesuai dengan yang diharapkan | Valid |

**s. Pengujian pada Menu Kelola BEM / UKM**

*Tabel 4.40 Pengujian Fungsional Menu Kelola Organisasi (BEM/UKM)*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Pendataan Logo Himpunan | Penyerapan grafik lambang UKM menyertai narasi lembaga | Visi misi keorganisasian terbaca seimbang bersanding profil Logo *Frontend* | Sesuai dengan yang diharapkan | Valid |
| 2 | Evaluasi *Blank Asset* | Mendaftar Himpunan Anyar tetapi menelantarkan file gambar | Parameter teradang menagih ketersediaan *(Require)* lampir fail lambang instansi | Sesuai dengan yang diharapkan | Valid |
| 3 | Mutasi Deklarasi Kabinet | Sunting identitas / ganti ketua organisasi pada tabel form ubah | Reformasi nama tanpa meruntuhkan stabilitas relasi Logo rintisan berhasil usai | Sesuai dengan yang diharapkan | Valid |
| 4 | Terminasi UKM Non-aktif | Mencerabut *Delete record* data ID komitas UKM spesifik | Rekam tersentral hapus musnah membawa relasi *File path* logo menghilang murni | Sesuai dengan yang diharapkan | Valid |

**t. Pengujian pada Menu Kelola Artikel Berita**

*Tabel 4.41 Pengujian Fungsional Menu Kelola Artikel Berita*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Konstruksi Redaksional | Pengutaraan redaksi berita form *Rich Text* berpadu Cover | Komputasi menakar spasi paragraf merender *routing permalink* publikasi mantap | Sesuai dengan yang diharapkan | Valid |
| 2 | Eksepsi Publikasi Kosong | Juru liput menerbitkan unggahan murni tanpa Judul Tajuk | Proses di-*kill* sistem tak meneruskan pelibatan MySQL sembari luapkan *Alert* | Sesuai dengan yang diharapkan | Valid |
| 3 | Revisi Uraian / Typo Berita | Pelurusan kata-kata perombakan modifikasi rincian naskah | Narasi dirombak menimpa rintisan lamanya tanpa memakan keruntuhan basis Cover | Sesuai dengan yang diharapkan | Valid |
| 4 | Pembersihan Berita Lama | Penarikan arsip "Delete/Hapus" Naskah tajuk artikel koran | Artikel bersangkutan mati suri terhapus sinkron memberhentikan tayangan bacaan | Sesuai dengan yang diharapkan | Valid |

**u. Pengujian pada Menu Kelola Kerjasama (MoU)**

*Tabel 4.42 Pengujian Fungsional Menu Kelola Kerjasama*

| No | Skenario Uji | Input | Output yang diharapkan | Output Aktual | Status |
|:---|:-------------|:------|:-----------------------|:--------------|:-------|
| 1 | Distribusi Dokumen MoU | Menyematkan kemitraan institusional beserta ekstensi MOU | Kemitraan terakui sistem beriringan menumbuhkan tabel *Download repository* | Sesuai dengan yang diharapkan | Valid |
| 2 | Kegagalan Interkoneksi | Membuka Form Add tapi Dokumen MOU tak dibekali form rujukan | Interaksi melontarkan kesalahan ekspektasi wajib disertakannya Dokumen ikatan | Sesuai dengan yang diharapkan | Valid |
| 3 | Penyuntingan Nama Relasi | Identifikasi pembetulan *Typo* perusahaan mitra yang terafiliasi | *Query parameter* mendesak ralat formasi tak mempengaruhi file PDF utamanya | Sesuai dengan yang diharapkan | Valid |
| 4 | Pengguguran Arsip Mitra | Menajamkan sanksi "Hapus/Drop" MOU mitra kedaluwarsa | ID perusahaan mitra dibersihkan, meresapkan penghancuran PDF file logis akurat | Sesuai dengan yang diharapkan | Valid |

---

## 4.4.3 Kesimpulan Akhir Pematangan Pengujian Black Box

Berdasarkan paparan masif ekosistem instrumen matrikulator antarmuka (**Total 42 Menu Sistem Fungsional**), rekapitulasi disimpulkan menapak pencapaian fungsionalisasi mutlak **100% VALIDASI TUNTAS / OPTIMAL**. Segala skenario integrasi *CRUD Data Handling* (Termasuk Uji Fungsilitas Error, Penambahan, Penyuntingan, hingga Peluruhan) di sisi arsitektur dasbor relasional mengesahkan sinkronitas tinggi dengan perlindungan taktis. Pelarangan tipe *input liyan* (*Mime-Type Guarding*) dan penjagaan atas atribut hampa (*Null Input Blocking*) direspons dengan perisai sempurna, menandakan aplikasi ini mumpuni melindungi keutuhan log perdataan produksi sivitas akademiknya.
