# Penjelasan Detail Fitur Halaman Publik (2 Paragraf)

Dokumentasi ini memberikan penjabaran fungsional dan teknis untuk setiap menu pada antarmuka publik Website FIKOM.

### 1. Halaman Beranda (Home)
Halaman Beranda berfungsi sebagai pusat informasi utama yang menyajikan ringkasan visual mengenai aktivitas dan profil fakultas. Pengunjung dapat melihat banner informasi melalui *slider*, berita terbaru, statistik fakta fakultas, hingga daftar mitra kerjasama sebagai bentuk impresi pertama terhadap kredibilitas institusi.

Secara teknis, proses pemuatan halaman ini melibatkan permintaan data kolektif dari Frontend kepada Backend yang kemudian mengeksekusi serangkaian kueri ke Database. Backend menarik data dari tabel slider, berita, fakta, dan mitra secara simultan sebelum mengirimkannya kembali ke Frontend untuk disusun menjadi tampilan antarmuka yang dinamis dan aktual.

### 2. Tentang FIKOM (Profil)
Menu Tentang FIKOM menyajikan narasi sejarah, latar belakang pendirian, dan peran strategis fakultas dalam dunia pendidikan. Informasi ini bertujuan untuk memberikan pemahaman mendalam bagi publik mengenai alasan berdirinya lembaga serta kontribusinya dalam pengembangan sumber daya manusia di bidang teknologi informasi.

Dari sisi sistem, permintaan kunjungan ke halaman ini diproses oleh Backend dengan melakukan kueri spesifik pada tabel halaman statis atau profil fakultas di Database. Setelah data deskriptif berbentuk teks dan aset gambar berhasil ditarik, Frontend merendernya menjadi halaman artikel profil yang informatif dan estetis bagi pengunjung.

### 3. Visi dan Misi
Halaman Visi dan Misi menjabarkan landasan filosofis dan langkah-langkah strategis yang dijalankan oleh fakultas guna mencapai standar kualitas lulusan yang unggul. Penyajian ini bertujuan untuk menegaskan komitmen institusi terhadap mutu pendidikan dan riset yang berdaya saing global kepada seluruh pemangku kepentingan.

Proses teknisnya melibatkan pengambilan naskah visi dan poin-poin misi dari pangkalan data melalui perantara Backend. Data tersebut kemudian dipetakan secara terstruktur oleh Frontend untuk disajikan dalam bentuk narasi visi utama diikuti dengan daftar misi yang sistematis, memastikan pesan filosofis fakultas tersampaikan secara jelas dan otoritatif.

### 4. Sasaran Strategis
Sasaran Strategis merinci indikator kinerja utama dan target pencapaian institusi dalam periode tertentu. Penjelasan ini memberikan transparansi bagi publik dan civitas akademika mengenai parameter keberhasilan yang ingin dicapai fakultas dalam proses pengembangan akademik dan tata kelola organisasi.

Sistem memproses antarmuka ini dengan menarik barisan data poin sasaran dari tabel kategori visi-misi pada Database. Backend bertanggung jawab untuk memastikan bahwa setiap sasaran yang diambil adalah data terbaru yang telah disahkan oleh pimpinan, sebelum Frontend mempresentasikannya dalam format yang mudah dipahami oleh pembaca.

### 5. Sambutan Dekan
Menu Sambutan Dekan menyajikan sapaan resmi dan orientasi pimpinan fakultas kepada khalayak luas. Kehadiran narasi ini bertujuan untuk membangun kedekatan komunikasi antar pimpinan lembaga dengan pengunjung website sekaligus menyampaikan visi besar kepemimpinan yang sedang berjalan.

Secara operasional, sistem melakukan pengambilan data teks sambutan dan path lokasi foto pimpinan dari pangkalan data melalui Backend. Frontend kemudian menyatukan elemen teks dan visual tersebut menjadi satu kesatuan halaman sambutan yang representatif, memberikan gambaran profil pimpinan fakultas secara profesional.

### 6. Struktur Organisasi
Halaman Struktur Organisasi memvisualisasikan garis komando dan koordinasi di lingkungan manajerial fakultas. Visualisasi ini memudahkan pengunjung dalam mengenali jajaran pimpinan mulai dari Dekanat, Program Studi, hingga Kepala Laboratorium sebagai bagian dari transparansi tata kelola lembaga.

Sistem bekerja dengan melakukan pemanggilan data bagan organisasi yang disimpan dalam bentuk file gambar atau diagram pada direktori server. Backend menarik referensi path gambar tersebut dari Database, lalu Frontend menyajikannya dalam komponen pratinjau yang memungkinkan pengunjung melihat hierarki organisasi fakultas secara utuh dan jelas.

### 7. Profil Dosen
Menu Profil Dosen merupakan direktori tenaga pendidik yang berisi informasi mengenai keahlian akademik dan kualifikasi profesional dosen. Fitur ini dirancang untuk memudahkan mahasiswa dalam mengenal pengajarnya serta memfasilitasi peneliti eksternal untuk melakukan pemetaan pakar di lingkungan FIKOM.

Mekanisme penarikan data melibatkan kueri pada tabel dosen untuk mendapatkan atribut nama lengkap, NIDN, jabatan fungsional, dan foto internal melalui Backend. Data yang terkumpul kemudian dikomunikasikan ke Frontend untuk disusun menjadi grid kartu profil yang interaktif, memungkinkan pengunjung melihat rincian setiap dosen secara mandiri.

### 8. Data Staff & Civitas
Halaman Data Staff menyajikan profil jajaran tenaga kependidikan yang mendukung operasional administrasi fakultas. Bagian ini memperlihatkan kekuatan sumber daya manusia di sisi layanan birokrasi, memberikan kepastian kepada pengunjung mengenai personil yang bertanggung jawab pada unit-unit layanan tertentu.

Secara teknis, Backend mengekstraksi data staff dari pangkalan data dan mengirimkannya ke antarmuka pengguna dalam bentuk daftar kolektif. Frontend mengolah paket data tersebut agar tersaji dengan rapi, memudahkan koordinasi internal maupun pengenalan bagi pengunjung yang memerlukan layanan administratif di kantor fakultas.

### 9. Program Studi Teknik Informatika
Halaman Program Studi Teknik Informatika menjabarkan profil lulusan, kurikulum, dan fokus keilmuan yang ditawarkan kepada calon mahasiswa. Penjelasan ini bertujuan memberikan gambaran mengenai atmosfer akademik dan standar kompetensi yang akan diperoleh mahasiswa selama menempuh pendidikan di bidang informatika.

Proses penyajian data dilakukan dengan menarik paket informasi spesifik prodi TI dari Database, mencakup teks pendahuluan dan data pendukung lainnya melalui Backend. Frontend kemudian membangun antarmuka penjabaran prodi yang komprehensif, mengintegrasikan visi misi internal prodi dengan direktori pengajar khusus bidang teknik informatika.

### 10. Program Studi Pendidikan TI
Menu Program Studi Pendidikan TI mendetailkan peran prodi dalam mencetak tenaga pendidik profesional yang memiliki kualifikasi di bidang teknologi informasi. Informasi ini sangat berguna bagi calon mahasiswa yang berorientasi pada karir sebagai guru atau instruktur TI dengan landasan pedagogik yang kuat.

Sistem memproses permintaan ini dengan mengekstraksi data tunggal profil prodi PTI dari pangkalan data. Backend memastikan sinkronisasi data kurikulum dan pengurus spesifik afiliasi PTI sebelum Frontend menyajikannya ke layar, memberikan presentasi yang kredibel mengenai keunggulan akademik yang dimiliki oleh program studi tersebut.

### 11. Fasilitas Ruangan Kelas
Halaman Fasilitas Ruangan memberikan transparansi mengenai sarana fisik yang mendukung proses belajar mengajar teori. Galeri foto yang estetis pada menu ini bertujuan untuk meyakinkan publik mengenai kenyamanan dan kelengkapan fasilitas ruang kelas yang disediakan oleh FIKOM bagi para mahasiswanya.

Sistem merespons permintaan pemuatan galeri dengan menarik daftar inventaris sarana fisik beserta dokumentasi fotonya dari server melalui Backend. Frontend mengolah barisan rekaman prasarana tersebut menjadi galeri interaktif, memungkinkan pengunjung membesarkan gambar untuk melihat detail fasilitas setiap ruangan secara saksama.

### 12. Fasilitas Laboratorium
Menu Fasilitas Laboratorium menonjolkan aspek teknologi dan ketersediaan mesin-mesin canggih pendukung riset praktikum. Informasi ini memposisikan fakultas sebagai lembaga pendidikan yang memiliki standar perangkat keras mumpuni guna mengakomodasi kebutuhan eksperimen digital dan praktikum pemrograman.

Secara operasional, Backend menarik data nama profil lab, daftar perangkat, serta galeri foto laboratorium komputer terpadu dari Database. Paket data tersebut kemudian ditransmisikan ke Frontend untuk dipaparkan sebagai etalase laboratorium yang dinamis, menunjukkan kesiapan teknologi fakultas dalam menunjang kegiatan akademik mahasiswa.

### 13. Kalender Akademik
Kalender Akademik menyediakan jadwal aktivitas tahunan mulai dari masa perkuliahan hingga jadwal ujian sebagai rujukan kronologis bagi seluruh sivitas. Keberadaan kalender ini bertujuan untuk memberikan kepastian waktu pelaksanaan operasional pendidikan demi kelancaran manajemen studi pada setiap semester.

Sistem bekerja dengan menarik naskah deskripsi jadwal dan tautan grafis kalender semester terbaru dari pangkalan data melalui Backend. Frontend menampilkan rilis jadwal tersebut dalam bentuk kartu informasi atau pratinjau dokumen yang memudahkan mahasiswa memerhatikan tenggat waktu penting dalam agenda akademik.

### 14. Dokumen Kurikulum
Menu Dokumen Kurikulum menyajikan akses terhadap struktur pendidikan dan silabus yang berlaku di setiap program studi. Penyelenggaraan informasi ini bertujuan agar mahasiswa dan masyarakat dapat memahami distribusi beban mata kuliah dan standar kompetensi yang diajarkan pada institusi pendidikan terkait.

Proses teknisnya melibatkan permintaan sajian materi referensi berkas silabus dari Frontend kepada Backend. Setelah Backend menarik tajuk naskah dan path unduhan file PDF dari Database, Frontend menyuguhkan antarmuka daftar pengunduhan yang memungkinkan pengguna mempelajari tata aturan kurikulum secara mandiri.

### 15. Dokumen Fakultas
Halaman Dokumen Fakultas merupakan repositori regulasi tingkat fakultas yang bersifat publik bagi seluruh sivitas akademika. Ketersediaan dokumen digital ini bertujuan mendukung transparansi kebijakan pimpinan dekanat dan memberikan kemudahan akses terhadap prosedur-prosedur administratif resmi berpayung hukum.

Secara sistematis, sistem melakukan pemetaan letak tautan file penyimpanan dokumen legal pada server melalui kueri pada Database. Backend memastikan sinkronisasi file dokumen fakultas yang ditarik, untuk kemudian dipresentasikan oleh Frontend menjadi tabel indeks unduhan arsip hukum yang otoritatif bagi pengunjung website.

### 16. Rencana Strategis (Renstra)
Halaman Rencana Strategis memaparkan peta jalan pengembangan institusi dalam jangka waktu menengah hingga panjang. Dokumen ini bertujuan untuk mengomunikasikan arah kebijakan, rencana aksi, dan target pengembangan fakultas kepada calon mitra kerjasama serta pemangku kepentingan institusi lainnya.

Sistem memproses antarmuka ini dengan memanggil rilis laporan renstra fakultas yang tersimpan di pangkalan data melalui Backend. Backend menyerahkan narasi wawasan strategis beserta tautan akses berkas dokumen fisiknya ke Frontend, sehingga memunculkan tampilan utuh informasi acuan strategis fakultas yang siap dibaca secara publik.

### 17. Standar Operasional Prosedur (SOP)
Menu SOP menyediakan panduan kepatuhan aturan dalam setiap layanan administrasi dan akademik di lingkungan fakultas. Penjabaran prosedur ini bertujuan untuk meminimalisir kesalahan operasional dan menjamin efisiensi birokrasi melalui standarisasi alur kerja yang dapat diakses oleh siapa saja.

Mekanisme teknisnya melibatkan penarikan susunan urutan kepatuhan aturan SOP dari Database melalui Backend. Backend mengembalikan wujud nama instruktur layanan beserta tautan file pedomannya, yang kemudian disusun oleh Frontend menjadi layar tabel unduhan arsip operasional yang tertata rapi dalam ruang pandang pengunjung.

### 18. Data Penelitian Dosen
Direktori Penelitian Dosen mendokumentasikan hasil karya ilmiah dan riset yang telah dilakukan oleh tenaga pendidik fakultas. Publikasi daftar riset ini bertujuan untuk mempromosikan kapabilitas akademik lembaga serta menyediakan referensi ilmiah bagi peneliti eksternal yang tertarik pada bidang teknologi informasi.

Sistem bekerja dengan mengumpulkan kompilasi hasil penelitian, mencakup tajuk abstrak, judul jurnal, dan tautan publikasi asli dari Database melalui Backend. Data riwayat keilmuan tersebut ditransmisikan ke Frontend untuk disajikan sebagai katalog riset artikel keilmuan dosen yang informatif dan mudah ditelusuri oleh pengunjung.

### 19. Data Pengabdian Masyarakat
Halaman Pengabdian Masyarakat menyajikan dokumentasi kiprah sosial civitas akademika dalam memberikan dampak nyata pada lingkungan sekitar. Informasi ini memperlihatkan tanggung jawab sosial institusi dalam menerapkan ilmu pengetahuan guna membantu menyelesaikan permasalahan praktis di tengah masyarakat.

Proses penyajiannya melibatkan penarikan narasi pengenalan aktivitas sosial dan berkas laporan dokumenter dari Database oleh Backend. Frontend menyusun data tersebut menjadi album karya berbakti masyarakat yang memungkinkan khalayak melihat dan mengamati kontribusi riil yang telah dilakukan oleh fakultas secara berkelanjutan.

### 20. Badan Eksekutif Mahasiswa (BEM)
Menu BEM menyajikan profil lembaga kemahasiswaan tertinggi di tingkat fakultas beserta visi kepemimpinannya. Penjelasan ini bertujuan memperkenalkan jajaran pengurus BEM FIKOM sebagai representasi aspirasi mahasiswa dalam menjalankan program kerja yang mendukung atmosfer akademik dan sosial kampus.

Sistem memproses halaman ini dengan menarik data riwayat kabinet dan silsilah struktur kepengurusan BEM dari pangkalan data melalui Backend. Backend menyajikan deskripsi administratif kepemimpinan tersebut kepada Frontend untuk kemudian divisualisasikan menjadi antarmuka identitas induk mahasiswa yang elegan di permukaan layar pengunjung.

### 21. Himpunan Mahasiswa (HIMA)
Halaman Himpunan Mahasiswa merinci jajaran organisasi kemahasiswaan di tingkat program studi (HMTI dan HMPTI). Kehadiran profil ini bertujuan untuk memfasilitasi kebutuhan pengembangan minat profesional mahasiswa sesuai dengan bidang keilmuan spesifik yang ditekuni pada masing-masing jurusan.

Secara teknis, Backend menarik tabel program kerja spesifik dan identitas kepengurusan tiap rumpun perwakilan per prodi dari Database. Frontend menyusun data tersebut menjadi etalase perincian susunan kabinet independen, memaparkan profil relasional aktivis mahasiswa di tingkat prodi dalam kesatuan antarmuka yang kohesif.

### 22. Unit Kegiatan Mahasiswa (UKM)
Menu Unit Kegiatan Mahasiswa menampilkan keberagaman wadah pengembangan bakat dan kreativitas mahasiswa di luar bidang akademik rutin. Informasi ini bertujuan untuk menarik minat calon mahasiswa agar bergabung dalam komunitas-komunitas dinamis yang mendukung pertumbuhan karakter dan keterampil tambahan.

Mekanisme sistemnya melibatkan ekstraksi profil ranah peminatan dan lampiran foto keaktifan tiap unit dari Database melalui Backend. Backend mengirimkan himpunan data unit terdaftar tersebut ke Frontend, yang kemudian menyuguhkan antarmuka galeri grid etalase profil perkumpulan kampus yang dinamis mutlak kepada para pengunjung.

### 23. Alumni & Tracer Study
Menu Alumni menyediakan data statistik riwayat kelulusan dan sukses karir para lulusan sebagai bukti produktivitas pendidikan di FIKOM. Fungsi ini bertujuan membangun jejaring profesional alumni sekaligus memberikan data objektif mengenai kualitas lulusan fakultas kepada publik dan calon mahasiswa baru.

Sistem bekerja dengan menarik kompilasi wawasan data karir, penempatan kerja, dan statistik kelulusan dari Database melalui Backend. Backend mengirimkan paket data rekam masa pelepasan tersebut ke Frontend agar disusun menjadi lembar kebanggaan catatan karier dan keaktifan anggota purna lulusan fakultas yang informatif secara statistik.

### 24. Pendaftaran Mahasiswa Baru
Halaman Pendaftaran Maba merupakan fitur interaktif yang memungkinkan calon mahasiswa melakukan entri data diri secara mandiri. Proses ini bertujuan untuk mendigitalisasi mekanisme pendaftaran awal guna meningkatkan efisiensi pendaftaran mahasiswa baru dan akurasi pengumpulan data awal bagi panitia administrasi.

Secara teknis, Frontend menyediakan formulir pendaftaran serta fasilitas unggah berkas KTP/Ijazah yang kemudian diteruskan oleh Backend untuk divalidasi. Backend menyimpan data pendaftar yang valid ke Database dan menaruh file fisik lampiran ke server internal, sebelum akhirnya Frontend menyajikan notifikasi keberhasilan pendaftaran kepada pengguna.
