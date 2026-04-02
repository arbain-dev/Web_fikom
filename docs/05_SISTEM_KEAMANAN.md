# BAB VII — SISTEM KEAMANAN WEB FIKOM

## 7.1 Filosofi Keamanan Dasar
Layaknya sebuah keraton atau markas yang melindungi data pendaftaran jiwa calon mahasiswa dan puluhan surat keputusan kampus, **Web FIKOM** dibangun dengan benteng pengamanan berlapis. Hebatnya, pengamanan ini ditanamkan langsung tanpa meminjam alat pertahanan pihak ketiga penambah beban. Segala celah yang sering dimanfaatkan oleh peretas (*Hacker*) tingkat pemula maupun menengah telah disumbat lewat kecerdasan baris kode bawaan (*Native PHP Security*).

Berikut ini adalah lima perisai utama yang membentengi situs secara gaib dari balik layar:

---

### 1. Pelindung Rute Navigasi (Pencegah Terobosan Folder Utama)
Banyak penjahat siber amatir gemar meraba-raba kelemahan web dengan mengetik paksa jalur-jalur ganjil di bilik alamat *Link Browser* (seperti mengetik `.../pages/../config/database.php` demi mencuri nyawa sistem). 

Di Web FIKOM, aksi pengelabuan yang secara teknis disebut ancaman ***Directory Traversal*** ini dihancurkan langsung di gerbang masuk `index.php`. Sistem dengan tegas akan **melucuti dan membersihkan setiap simbol titik (.) dan garis miring (/)** pada ketikan pemohon, sehingga penjelajah gelap akan terlempar buntu dan ditertawakan oleh halaman "404 Penelusuran Tidak Ditemukan" pada porsi publiknya.

---

### 2. Penyamar Sandi Otomatis (*Password Hashing*)
Seluruh kata sandi para pimpinan dan operator staf tidak pernah disimpan mentah-mentah (*Plaintext*) ke dalam mesin brankas MySQL. 
Sebaliknya, sistem menerapkan ilmu sandi berputar otomatis *(Cryptographic Hash)*. Tiap sandi yang diinput saat pendaftaran akan **digiling hancur menjadi rentetan huruf acak tak bermakna** yang tidak bisa dikembalikan lagi ke wujud aslinya (contoh: kata sandi "admin123" hancur menjadi "*$2y$10$wT/Yy..*.").

Berkat ini, seandai peretas berhasil menjebol brankas dan mencuri kertas sandi sekali pun, mereka tetap kebingungan lantaran kodenya sama sekali tak bisa dibaca mulut manusia.

---

### 3. Pembersih Racun Tulisan Palsu (Penangkal *XSS / Cross-Site Scripting*)
Ada kalanya orang tak bertanggung jawab mengisi formulir isian (seperti alamat atau pendaftaran) dengan memalsukannya menggunakan kode penipu yang memancing layarnya melompat *(Scripting Injection)*.

Sistem Web FIKOM memberlakukan protokol kebersihan steril yang memaksa semua teks dari lumbung sebelum ditayangkan ke mata publik, harus disaring lewat gerbang *"Kode Filter Penghalus"* (*Fungsi `htmlspecialchars`*). Fungsi ajaib ini akan membuang taring dari simbol-simbol berbahaya seperti tanda kurung sudut `<` menjadi sekadar teks bodoh ketikan `&lt;`.  Walhasil, racun penipu gagal teraktivasi menjadi perintah membangkang pada komputer korban.

---

### 4. Pelucut Senjata Pertanyaan Siluman (Pencegahan *SQL Injection*)
Ini adalah jenis sihir peretas tertua sekaligus terparah di dataran internet di mana penipu mendaratkan perintah modifikasi paksa saat berkedok mencari (*Querying*) atau masuk sistem.

Sistem arsitektur Web FIKOM mengatasinya dengan memakai taktik formulir kedap udara *(Prepared Statements dari MySQLi)*. Teknik pertahanan murni ini memisahkan kerangka baja gerbang sistem dengan serahan ketikan data milik pengguna sesungguhnya. Akibatnya, perintah gaib SQL jahat milik peretas selalu diperlakukan sekadar sebagai *"Teks Jawaban Biasa"* tanpa pernah diizinkan campur tangan dalam setir komando mesin.

---

### 5. Jimat Identitas Rahasia Ruang Kendali (*Session Security*)
Bilik belakang / Dasbor Administrator sangat tertutup rapat. Begitu ada pengguna memaksa akses langsung ke tautan rahasia (*Misalnya diam-diam mengetik `/admin/dashboard.php` langsung*), penjaga lapis gerbang akan otomatis memindai kantong mereka untuk mencari kartu idetitas gaib yang dinamakan bilik *Session*. 

Tanpa jimat riwayat absensi Login (*Login Token*) di tangannya, layar otomatis menggelapkan diri dan menendang pelancong liar tersebut balik ke pekarangan depan. Modul ini menjadi jaminan tidur nyenyak pengelola meski markas ditinggalkan begitu saja di ujung lorong virtual.
