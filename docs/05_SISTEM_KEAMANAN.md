# BAB VII — SISTEM KEAMANAN WEB FIKOM

## 7.1 Filosofi Keamanan Dasar
Sistem Informasi **Web FIKOM** diterapkan dengan model pertahanan siber preventif ganda. Mengingat aplikasi web merangkum dan mengelola fungsionalitas pengisian masukan data krusial—termasuk di dalamnya riwayat dokumen pendaftaran identitas calon mahasiswa, pendataan kegiatan jurnal staf pengajar, serta integrasi persuratan struktural—maka penerapan proteksi berlapis untuk menangkis celah eksploitasi dari sisi lapis aplikasi (*Application Level Layer*) menggunakan spesifikasi bawaan kerangka bahasa (*Native Language Security*) adalah syarat fundamental prasyarat keutuhan aplikasi.

Berikut merupakan rincian lima teknik terminologi logis pencegahan peretasan struktural eksploitasi dominan yang ditanamkan secara aktif di balik lapisan kerangka sistem aplikasi Web FIKOM:

---

### 1. Pelacakan Traversal Direktori Eksternal (Pencegahan Directory Traversal)
Kelemahan *Directory Traversal* merupakan metode perintasan direktori di mana pihak asing (*hacker*) mengeksploitasi cacat sistem sistem file untuk menyisipkan manipulasi pembacaan alamat URL lokasi situs, acapkali menggunakan parameter `.` atau simbol `../` demi menyelidiki letak spesifik *script* konfigurasi basis penyimpanan (*Database Configuration Files*) di luar kontrol izin layanan antarmuka.

Pada implementasi arsitektur Web FIKOM, pengetatan terhadap akses ini dicegah langsung pada level penerimaan perutean pintu depan layanan (`index.php`). Metode proteksinya memproses tiap lema *query parameter* kueri peramban melalui pilar proses pembersihan *String Filter* (penghapusan titik dan pembuangan *slash*). Prosedur rute tersebut mengeksklusi setiap perintah anomali eksekusi URL dan menolak akses fiktif langsung menampilkan respons pelemparan "404 Not Found", mematikan pemantulan akses rahasianya seketika.

---

### 2. Formulasi Kriptografi Kredensial Akses (Password Hashing)
Prosedur pengokoh integritas informasi tidak pernah mengizinkan peletakan penyusunan persandian operasional administrasi pada entri basis data dalam format teks mentah yang lumrah terbaca (*Plaintext*).

Penerapan keamanan memproses hal tersebut menuju *Cryptographic Hashing* fungsional (memanfaatkan implementasi algoritma persandian standar termutakhir *Bcrypt / password_hash* di server PHP), dengan tujuan melebur setiap struktur inputan kredensial sang administrator pengelola ke dalam wujud deret komputasi acak berkuantisasi ekstrem (*Contoh enkripsi string: $2y$10$wT/Yy...*). Modus ini krusial menangkal metode rekayasa *reverse engineering*, sekaligus memastikan ekspektasi validasi kata sandinya terkunci permanen walaupun skema pangkalan data sewaktu-waktu dibajak oknum luar (*Data Breach Leak*).

---

### 3. Sterilisasi Lapisan Tampilan Injeksi Jaringan (Cross-Site Scripting / XSS Prevention)
Tipikal invasi *Cross-Site Scripting* (XSS) mendelegasikan perintah sintaks bahaya semacam skrip *JavaScript* gelap yang dikuburkan melalui masukan form isian halaman web. Eksekusi ilegal pada fungsi skrip tersebut aktif setibanya kueri dibaca pemantau komputer pengguna.

Taktik kebersihan antarmuka dari ancaman injeksi pelengkap tampilan web dieksekusi menuruti protokol pensterilan *Native PHP*. Implementasinya mengatur output *rendering* agar tidak terelakkan dan termanipulasi dari rujukan data, dikontrol total via restriksi bawaan fungsi fungsi peredam `htmlspecialchars()`. Fungsi preventif ini merekonstruksi *simbol inisisasi render tag* operasional HTML (*misal komando pelatuk kurung siku khusus seperti lambang ekssekusi `<` didegradasi merubah struktur pembacanya secara lugas mendapatinya layaknya tanda literal murni `&lt;`*) sehingganya mencegah sintaks siluman dibaca peladen browser di klien. 

---

### 4. Parameterisasi Evaluasi Basis Kueri (Pencegahan SQL Injection)
Konsepsi pembobolan struktur SQL memfasilitasi campur tangan kelemahan terburuk skema sistem karena perintah sintaks manipulasi pangkalan data disisipkan melalui modifikasi pemalsuan entri transaksi layanan form eksternal, yang merusak struktur pembacaan tabel dan mengambil alih tata kendali *database*.

Keseluruhan integrasi konektivitas relasi data MySQL pada arsitektur Web FIKOM mendasari transaksinya pada prinsip pembungkusan *Prepared Statements* (*Parameter Binding* fungsional melalui kover MySQLi). Melalui pengikatan variabel terpisah berlapis di sisi server peladen ini, prosedur pemisah mengevaluasi komando perintah deklarasi logika kueri sebelum rincian nilai parameternya mengintervensi program *query statement*. Oleh hal demikian, ancaman sintaks perintah nakal dibaca semata-mata sebagai rentetan parameter masukan alfanumerik biasa tanpa kapabilitas perombakan struktur basis tabel utamanya.

---

### 5. Validasi Pertukaran Token Data Rahasia (Session Security Authentication)
Integrasi kerahasiaan kepemerintahan kendali internal aplikasi (*Dashboard / Admin Level*) diperumit skema proteksi pelacakan lalu-lintas izin berbasis pengelolaan siklus riwayat masuk (*Session Data Authentication*), di mana persinggungan level administrator hanya aktif semasa konfirmasi tiket verifikasi terawasi per tautan.

Misalkan intervensi *path* paksa diaplikasikan menuju panel kendali URL (contohnya peramban diarahkan menyasar laman kontrol rahasia admin langsung `admin/index.php`), maka fungsi sekuritas terpusat *controller* pengawal pelacak akan memberlakukan verifikasi prasyarat status nilai *array SESSION login*. Nihilnya identitas pemegang kapabilitas penanda sesi tersebut, memicu otoritas mesin aplikasi menyita pendaftaran *browser session* seraya melabuhkannya dengan pemutusan paksa releransi dan mengalihkannya kembali menuju perutean beranda antarmuka publik *(URL Redirect)*.
