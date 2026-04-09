# Penjelasan Detail Modul Dashboard Administrator (2 Paragraf)

Dokumentasi ini memberikan panduan teknis operasional bagi Administrator dalam mengelola ekosistem digital Website FIKOM melalui panel kontrol tingkat lanjut.

### 1. Autentikasi Admin (Login)
Proses Autentikasi Admin merupakan lapisan keamanan pertama yang harus dilalui untuk memastikan hanya personil berwenang yang dapat melakukan modifikasi data pada sistem. Fitur ini dirancang untuk melindungi kerahasiaan informasi dan integritas kontrol sistem dari potensi penyalahgunaan oleh pihak yang tidak bertanggung jawab.

Secara teknis, proses ini diawali dengan pengiriman kredensial (nama pengguna dan kata sandi) oleh Admin kepada Backend melalui jalur komunikasi yang aman. Backend kemudian melakukan verifikasi kecocokan data dengan rekaman yang terenkripsi di Database, lalu menginisiasi sesi kunjungan aktif dan mengarahkan pengguna ke dashboard utama jika validasi dinyatakan berhasil.

### 2. Dashboard Ringkasan
Dashboard Ringkasan berfungsi sebagai panel informasi terpusat yang menyajikan ringkasan kuantitatif mengenai status data yang tersimpan di dalam sistem. Melalui antarmuka ini, Administrator dapat memantau secara cepat total berita, pendaftar maba, serta jumlah direktori civitas sebagai landasan dalam pengambilan keputusan manajerial.

Sistem bekerja dengan memanggil fungsi penghitungan total rekaman (*count*) pada setiap tabel utama di Database melalui Backend saat halaman dashboard diakses. Hasil agregasi data tersebut kemudian ditransmisikan ke Frontend untuk divisualisasikan menjadi kartu-kartu statistik dinamis, memberikan gambaran operasional sistem secara *real-time* kepada administrator.

### 3. Kelola Slider
Modul Kelola Slider memberikan wewenang kepada Administrator untuk mengatur konten visual utama yang tampil pada banner halaman depan public. Pengelolaan ini mencakup pembaruan gambar bertema pemandangan kampus atau pengumuman strategis guna menjaga antarmuka depan website tetap menarik dan informatif.

Alur teknis pengelolaan slider melibatkan transmisi file gambar dan narasi teks dari Frontend ke Backend, yang kemudian divalidasi format serta ukurannya. Jika data valid, Backend akan menyimpan file fisik secara fisis di direktori server dan mencatat referensi path-nya ke Database, sekaligus menghapus aset gambar lama untuk mengoptimalkan ruang penyimpanan secara efisien.

### 4. Kelola Berita
Manajemen Berita memfasilitasi publikasi rilis informasi resmi dan agenda kegiatan yang berlangsung di lingkungan FIKOM. Administrator memegang kendali penuh dalam menyusun artikel, mengunggah foto sampul, dan menentukan status publikasi berita agar informasi tersampaikan kepada khalayak secara luas dan kredibel.

Proses simpan data berita diawali dengan penangkapan input formulir oleh Frontend yang kemudian dikomunikasikan ke Backend. Backend bertanggung jawab untuk menyematkan pertanda konfirmasi data terekam permanen di Database, menaruh aset visual ke folder peladen, serta menjamin bahwa penghapusan data berita akan turut serta menghapus file gambar penunjangnya agar sistem tetap ramping.

### 5. Kelola Fakta Statistik
Modul Fakta statistik memungkinkan Administrator untuk memodifikasi indikator angka pencapaian fakultas guna ditampilkan pada animasi penghitung di halaman publik. Fitur ini krusial untuk memperlihatkan pertumbuhan institusi secara objektif, mulai dari jumlah prestasi hingga perkembangan sumber daya manusia.

Secara teknis, Admin menginput judul fakta dan besaran nilai numerik pada form administrasi, yang kemudian diproses oleh Backend melalui kueri *insert* atau *update* ke tabel fakta di Database. Perubahan data ini secara otomatis akan ditarik oleh sistem Frontend publik untuk menggerakkan elemen animasi angka yang memberikan kesan dinamis pada tampilan beranda sistem.

### 6. Kelola Sambutan Dekan
Pusat penyuntingan pesan pimpinan ini memberikan kesempatan bagi Administrator untuk meredaksi narasi sapaan resmi dari pimpinan fakultas. Penyelarasan naskah sambutan secara berkala sangat penting untuk mencerminkan orientasi atau kebijakan dekanat terbaru kepada seluruh pengunjung website.

Mekanisme kerjanya melibatkan pengambilan rekaman data sambutan saat ini dari Database melalui kueri Backend. Saat Admin melakukan pembaruan narasi atau foto, Backend akan menimpa data lama dengan naskah terbaru dan mengelola penggantian aset visual foto pimpinan di penyimpanan server, memastikan responsivitas data pada antarmuka publik terjadi secara instan.

### 7. Kelola Info Profil Fakultas (Tentang)
Modul Kelola Profil Fakultas digunakan untuk memperbarui sejarah dan identitas lembaga sebagai bagian dari pembangunan citra institusi. Administrator memiliki fleksibilitas untuk menceritakan latar belakang berdirinya fakultas dan visi strategisnya dalam narasi teks yang didukung oleh elemen grafis pelengkap.

Sistem memproses antarmuka penyuntingan ini dengan menarik riwayat narasi profil dari tabel informasi tentang fakultas di Database. Setelah Admin mengirimkan perubahan data, Backend melakukan sinkronisasi antara isian teks format besar with aset gambar profil di server, menjamin bahwa representasi latar belakang institusi tersaji secara faktual dan inspiratif.

### 8. Kelola Visi Utama
Fasilitas ini memberikan kendali kepada Administrator untuk meredaksi naskah visi tunggal fakultas sesuai dengan ketetapan pimpinan dekanat. Kejelasan dan ketepatan diksi pada narasi visi sangat fundamental karena menjadi pedoman arah pengembangan fakultas yang dipublikasikan secara resmi di website.

Alur teknis penyuntingan visi melibatkan pengiriman data teks dari Frontend ke Backend melalui permintaan API yang terproteksi. Backend kemudian melakukan operasi penimpaan record (*update*) pada baris visi unik di Database, memastikan bahwa perubahan narasi tersebut tersimpan secara permanen dan siap disajikan kembali di seluruh halaman informasi fakultas terkait.

### 9. Kelola Misi, Tujuan, dan Sasaran
Modul Misi, Tujuan, dan Sasaran memungkinkan Administrator untuk mengelola poin-poin strategis pengembangan fakultas secara dinamis. Admin dibekali kemampuan untuk menambah poin baru, menyunting item eksisting, atau menghapus target-target yang sudah tidak relevan dengan kebijakan tahunan lembaga.

Mekanisme kerjanya berbasis pada manajemen daftar rekaman di tabel visi-misi pada Database. Backend menyediakan layanan penarikan data per kategori bagi Frontend, dan menangani parameter nomor urut penyajian agar susunan poin misi dan sasaran yang tampil selaras dengan struktur dokumen cetak resmi institusi yang telah disahkan.

### 10. Kelola Struktur Organisasi
Modul Struktur Organisasi digunakan oleh Administrator untuk memperbarui visualisasi hierarki jabatan di FIKOM. Dengan mengunggah bagan organisasi terbaru, Admin memastikan pengunjung mendapatkan informasi akurat mengenai susunan pengelola fakultas yang sedang menjabat di setiap periode kepemimpinan.

Secara operasional, Admin mengunggah berkas gambar diagram struktur dalam format yang diizinkan (seperti JPG atau PNG). Backend memvalidasi muatan file tersebut sebelum meletakkannya di folder profil peladen dan memperbarui path lokasinya di Database, secara otomatis memicu penggantian pratinjau visual di sisi publik tanpa memerlukan perubahan kode sumber.

### 11. Kelola Data Dosen
Modul Kelola Dosen merupakan pusat administrasi profil tenaga pendidik yang mencakup identitas akademik dan kualifikasi keprofesian. Administrator bertanggung jawab menjaga validitas data dosen, termasuk memperbarui jabatan fungsional dan pas foto resmi untuk mendukung kebutuhan akademik civitas.

Teknis pengelolaannya melibatkan pertukaran paket data antara form administrasi Frontend dengan Backend, yang kemudian diolah melalui kueri pada tabel dosen. Backend menjamin bahwa hanya lampiran berkas gambar yang memenuhi spesifikasi teknis yang dapat tersimpan, serta melakukan pembersihan aset visual dosen yang sudah tidak aktif dari pangkalan penyimpanan server.

### 12. Kelola Staff & Civitas
Modul manajemen data staff memberikan kemampuan bagi Administrator untuk mendata jajaran personil pendukung administratif di luar tenaga pendidik. Pengelolaan direktori staff kependidikan ini membantu dalam memetakan sumber daya manusia di bagian front office, administrasi keuangan, dan unit layanan kemahasiswaan.

Backend memfasilitasi operasi penarikan senarai data staff dari Database untuk ditampilkan dalam tabel manajerial di Frontend. Setiap kali Admin melakukan registrasi staff baru atau pembaruan riwayat jabatan, sistem memastikan data tersebut tersinkronisasi secara otoritatif sehingga informasi personil pendukung layanan di kantor dekanat tetap akurat.

### 13. Kelola Ruangan Kelas
Modul Kelola Ruangan Kelas bertujuan untuk mengarsip daftar prasarana fisik yang mendukung aktivitas perkuliahan teori. Administrator bertugas mencatat spesifikasi luas, kapasitas daya tampung, dan fasilitas internal setiap ruang kelas guna memberikan gambaran sarana belajar yang representatif bagi calon mahasiswa.

Sistem bekerja dengan mengintegrasikan data isian formulir ruangan bersama dengan unggahan foto fisik ruangan kelas ke dalam direktori server melalui Backend. Detail isian ketikan teks dan tautan lokasinya akan diikat kuat pada Database, memungkinkan sistem publik untuk memanggil dan memvisualisasikan galeri prasarana ruangan secara estetis lewat panduan data administrator.

### 14. Kelola Laboratorium
Khusus untuk pengelolaan sarana praktikum teknologi, modul Kelola Laboratorium memberikan wewenang kepada Administrator untuk mendeskripsikan setiap lab komputer terpadu. Admin dapat memperbarui profil laboran, spesifikasi perangkat keras lab, hingga mengelola galeri foto koleksi mesin praktikum unggulan.

Alur kerjanya melibatkan ekstrasi tunggal ringkasan profil lab dan lampiran foto fasilitasnya dari server melalui Backend. Backend bertanggung jawab untuk menyematkan pertanda konfirmasi pembaruan record pada pangkalan data laboratorium, menjamin bahwa representasi teknologi fakultas yang ditampilkan secara online mencerminkan kondisi riil di lapangan operasional lab.

### 15. Kelola Kalender Akademik
Administrator menggunakan modul ini untuk mempublikasikan agenda jadwal tahunan fakultas ke seluruh civitas akademika. Peran Admin sangat vital dalam memastikan bahwa rilis poster kalender akademik dan agenda penting lainnya segera diunggah mengikuti kebijakan rilis dari bagian akademik universitas.

Secara teknis, Admin mengunggah gambar ilustrasi grafis kalender semester ke sistem. Backend memvalidasi klasifikasi parameter file sebelum menempatkan fisik file masuk ke folder kalender dan mengintegrasikan link lokasinya ke Database, yang nantinya memicu sistem peladen untuk menyajikan rupa jernih susunan kalender kepada pengunjung website secara publik.

### 16. Kelola Dokumen Kurikulum
Modul manajemen dokumen kurikulum dirancang agar Administrator dapat mendistribusikan berkas silabus dan pedoman mata kuliah untuk tiap prodi secara mandiri. File yang diunggah biasanya berupa dokumen PDF otoritatif yang menjadi acuan standar kompetensi bagi mahasiswa di setiap angkatan.

Mekanisme kerjanya melibatkan pengelolaan direktori akses dokumen kurikulum pada server melalui Backend. Backend menarik tajuk naskah dan mengelola pembaruan berkas silabus ke folder penyimpanan yang aman, menjamin integritas materi referensi kurikulum dasar agar dapat diunduh oleh khalayak tanpa mengalami kendala aksesibilitas data.

### 17. Kelola Mitra Kerjasama
Modul Kelola Mitra memungkinkan Administrator mendokumentasikan kerjasama strategis fakultas dengan instansi atau perusahaan mitra. Administrator dapat mengelola portofolio profil mitra beserta logo perusahaan untuk memperlihatkan jaringan relasi institusi yang luas kepada khalayak publik dan calon mahasiswa.

Sistem memproses pengelolaan mitra dengan menggabungkan data deskriptif mitra dan transmisi berkas logo melalui Backend. Backend menaruh fisik file logo ke direktori kemitraan server dan melakukan pemetaan koordinat alamat letak nama spesifik ke Database, memastikan penampilan logo mitra pada grid kerjasama website publik tetap relevan dan harmonis.

### 18. Kelola Data Penelitian
Modul manajemen riset dosen membekali Administrator dengan kemampuan mengelola pangkalan data karya ilmiah yang telah dihasilkan oleh sivitas. Admin bertugas menginput rincian judul riset, abstrak, dan mengelola tautan publikasi serta file laporan penelitian dalam format PDF yang sah.

Teknisnya, Frontend mengirimkan rincian metadata penelitian ke Backend untuk disimpan pada tabel riset keilmuan di Database. Backend menjamin kelancaran penempatan dokumen laporan ke server, dan sistem akan mengikat daftar tersebut menjadi tabel direktori hasil riset yang memungkinkan pengunjung untuk mempelajari rekam jejak akademik para peneliti di FIKOM.

### 20. Kelola Data Pengabdian
Manajemen Data Pengabdian digunakan untuk mengelola portofolio kontribusi sosial institusi yang dilaksanakan oleh dosen dan mahasiswa. Administrator mengelola narasi laporan aksi sosial serta mengunggah dokumentasi berkas laporan untuk dibagikan sebagai bentuk pertanggungjawaban hibah atau publikasi kegiatan.

Backend memfasilitasi pemuatan laporan ini dengan menarik esai pengenalan aktivitas sosial dan berkas dokumenternya dari sistem penyimpanan fisis melalui Database. Peran admin di sini krusial dalam menyajikan album karya berbakti masyarakat yang inspiratif, memastikan setiap kiprah sosial fakultas terdokumentasi dengan baik di dalam ruang baca khalayak luas.

### 20. Kelola Dokumen Fakultas
Modul Kelola Dokumen Fakultas berfungsi sebagai pusat administrasi dokumen regulasi, surat keputusan, dan pedoman birokrasi yang bersifat terbuka bagi publik. Administrator mengelola metadata judul dokumen dan melakukan pembaruan berkas fisis surat ketetapan yang dikeluarkan oleh pihak dekanat atau universitas.

Secara operasional, Admin mengunggah arsip hukum publik melalui panel administrasi, di mana Backend secara otomatis melakukan pemetaan letak tautan file penyimpanan file pada server melalui kueri Database. Setiap penambahan arsip baru akan segera muncul dalam tabel etalase pengunduhan, mendukung keterbukaan informasi dan akuntabilitas birokrasi institusi secara digital.

### 21. Kelola Rencana Strategis (Renstra)
Manajemen Renstra digunakan untuk mempublikasikan dokumen perencanaan jangka panjang pengembangan fakultas dalam format digital. Administrator memastikan bahwa dokumen renstra yang tersedia adalah versi terbaru yang diputuskan dalam rapat pimpinan, menggantikan rencana aksi yang sudah usang atau kedaluwarsa.

Alur teknisnya melibatkan pengunggahan naskah laporan dokumen renstra fakultas ke server penyimpanan melalui Backend. Backend menyediakan layanan penggantian file fisis yang akan menimpa data warisan usang pengeditan di Database, sehingga memastikan bahwa pengunjung selalu membaca dokumen strategi acuan yang terverifikasi dan otoritatif dari pimpinan.

### 22. Kelola SOP
Modul Kelola SOP memberikan kendali bagi Administrator untuk mengatur prosedur baku pelayanan di FIKOM. Dengan mengunggah naskah SOP terbaru, Admin membantu menjaga efisiensi layanan administratif dan akademik serta memberikan kejelasan instruksi langkah kerja bagi seluruh sivitas akademika pengakses layanan.

Sistem bekerja melalui pemrosesan permintaan penyajian susunan instruksi SOP dari Frontend kepada Backend. Backend menyimpan berkas pedoman operasional ke direktori pedoman di server dan memperbarui referensi datanya di Database, memungkinkan rupa tabel unduhan arsip operasional di sisi pengunjung selalu menyajikan pedoman instruktur layanan yang paling mutakhir.

### 23. Kelola Organisasi BEM
Modul manajemen organisasi mahasiswa memberikan wewenang bagi Administrator untuk mempublikasikan identitas kabinet BEM yang sedang menjabat. Admin dapat menyunting visi kepengurusan mahasiswa dan memuat logo kabinet sebagai representasi profil lembaga kemahasiswaan tertinggi di tingkat fakultas.

Secara sistematis, Admin memperbarui tautan lokasinya di Database melalui Backend saat melakukan pengeditan profil BEM. Backend menangani proses sinkronisasi teks deskriptif kepemimpinan mahasiswa dan penempatan berkas logo profil ke folder organisasi, memastikan wujud visual organisasi mahasiswa induk tersaji anggun di permukaan layar pengunjung website.

### 24. Kelola Organisasi HIMA
Modul manajemen Himpunan Mahasiswa Jurusan memfasilitasi publikasi profil organisasi di tingkat prodi (HMTI dan HMPTI). Administrator bertugas mengawasi ketepatan data kabinet cabang independen tersebut guna mempererat koordinasi antara pihak dekanat dengan perwakilan aspirasi mahasiswa tiap jurusan.

Backend menyediakan fungsi penarikan dan pembaruan tabel program kerja spesifik per rumpun perwakilan HIMA bagi administrator. Dengan mengelola data ini, Admin menjamin hubungan relasional antara organisasi mahasiswa di tingkat jurusan dengan basis keilmuannya terdokumentasi dengan baik, memudahkan pencalonan kader harian mahasiswa prodi di masa mendatang.

### 25. Kelola Unit UKM
Modul Kelola UKM merupakan etalase manajemen bagi seluruh unit kegiatan mahasiswa yang terdaftar secara sah di fakultas. Administrator mengelola profil ranah peminatan tiap UKM dan diperkenankan mempublikasikan galeri foto keaktifan guna mempromosikan dinamika kreativitas pemuda di luar jam akademik.

Secara teknis, Admin mengunggah tajuk himpunan minor dan lampiran foto aktivitas pangkalan melalui Backend untuk disimpan di Database. Backend memastikan sinkronisasi data darsar perkumpulan kampus tetap terjaga, sehingga Frontend publik dapat menyuguhkan galeri meriah potret keaktifan pemuda UKM yang inspiratif secara akurat di pandangan mata pemangku kepentingan.

### 26. Kelola Data Alumni
Modul manajemen alumni digunakan untuk mengelola direktori lulusan dan hasil statistik survei riwayat kelulusan pemuda cendekia. Administrator bertanggung jawab menjaga validitas direktori kelulusan serta kiprah sukses riwayat purna kampus sebagai bahan evaluasi standar pendidikan di fakultas.

Mekanisme kerjanya melibatkan penarikan kompilasi wawasan data karir dan penempatan alumni dari Database ke dashboard administrator melalui Backend. Admin memperbarui catatan karier dan keaktifan para pemegang takhta kesuksesan belajar ini secara berkala, memastikan lembar kebanggaan alumni pada halaman publik memberikan data sebaran karir yang faktual bagi khalayak luas.

### 27. Verifikasi Pendaftar Maba
Modul ini merupakan alat bantu manajerial bagi Administrator untuk menyeleksi pendaftaran mahasiswa baru melalui jalur *online*. Admin melakukan peninjauan terhadap kelengkapan berkas pendaftar dan memberikan putusan status (Diterima atau Ditolak) terhadap setiap permohonan yang masuk melalui sistem.

Backend memfasilitasi penarikan senarai pendaftar dari antrean validasi pada Database guna diproses oleh administrator. Setiap keputusan status yang diambil akan memicu Backend untuk memperbarui status record pendaftar di Database, yang sekaligus menyediakan fitur pembersihan permanen data pendaftar fiktif dari sistem penyimpanan fisis peladen secara otomatis.

### 28. Pengaturan Identitas Sistem
Modul Pengaturan Sistem merupakan pusat konfigurasi global untuk menentukan Logo Website, Judul Situs, dan Favicon fakultas. Administrator menggunakan modul ini untuk menyelaraskan identitas merek (*branding*) fakultas di seluruh bagian website secara instan dan menyeluruh.

Secara teknis, Admin melakukan pengeditan profil pengaturan tunggal pada tabel pengaturan di Database melalui Backend. Backend memvalidasi ekstensi berkas visual yang diunggah sebelum menyimpan fisik file fisis ke direktori utama peladen, memastikan sinkronisasi logo website dan narasi identitas peladen berhasil dirajut permanen di seluruh komponen antarmuka aplikasi.
