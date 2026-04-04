# BAB VIII — DAFTAR PUSTAKA DAN DEPENDENSI

## 8.1 Referensi Perangkat Lunak Inti
Rekayasa Sistem Informasi Website FIKOM berdiri di atas fondasi pengembangan teknis secara mandiri (*Native Scripting*). Meskipun arsitekturnya diformulasikan murni tanpa intervensi kerangka kerja pihak ketiga guna memaksimalkan optimasi kecepatan muat, penjabaran aplikasi ini tidak terlepas dari utilisasi landasan platform mesin pangkalan berlisensi terbuka (*Open-Source Foundation*). Susunan pustaka intinya dijabarkan sebagai berikut:

1. **PHP (Hypertext Preprocessor) Versi 8.x**
   PHP merupakan mesin eksekutor pengolah pemrograman peladen (*Server-Side Scripting Protocol*) mutlak yang diandalkan menjadi tulang punggung penggerak sistem. Utilitas ini ditugaskan murni memastikan integrasi antara kueri interaktif pengunjung dengan verifikasi parameter otentikasi lapis administrasi.
2. **MySQL Database Management System**
   Pangkalan penyimpanan basis data relasional (*RDBMS*) yang ditunjuk khusus untuk mendeklarasikan wujud struktur tabel data, menjamin validasi penyimpanan persuratan, serta mengelola komputasi pengindeksan data secara tuntas dan stabil.
3. **Apache Web Server (Integrasi Paket Lingkungan XAMPP)**
   Wadah inkubator penyedia rute penyebaran protokol HTTP ini dirujuk sebagai fasilitator infrastruktur dasar. Kemampuannya mendukung lalu lintas penyampaian halaman peladen secara utuh menjadikan Apache garda komputasi pemeliharaan koneksi (*host*).

## 8.2 Dependensi Klien Antarmuka (Front-End Dependencies)
Memegang prinsip perakitan visual aplikasi super ringan (*Lightweight Custom UI*), spesifikasi sistem antarmuka halaman situs ini memberlakukan pengecualian absolut terhadap pemakaian alat bantu kelas berat sejenis *Bootstrap* maupun *TailwindCSS*. Pembangunan *Cascading Style Sheets* (CSS) serta *Vanilla JavaScript* ditegaskan seratus persen murni gubahan mandiri. Namun, perujukan dependensi minor luar secara selektif difungsikan lewat transmisi *Content Delivery Network* (CDN) demi kesempurnaan estetis:

1. **Google Fonts API (Klasifikasi *Font Inter*)**
   Kebutuhan tipografi modern disandarkan sistem pada modul layanan web korporasi Google. Adopsi jenis *Font Inter* dinilai relevan dalam menyuntikkan kejelasan legibilitas (kemudahan membaca) pada susunan baris dokumentasi antarmukanya. Penyematan antarmukanya langsung ditarik sistem lewat *link* peladen awan: `fonts.googleapis.com`.
2. **Font Awesome Library (Rilis Versi Khusus 6.5.1)**
   Akomodasi simbolisasi berupa ikon *vector* pada bagian menu navigasi, identifikasi antarmuka sosial media, serta aksen tata letak panel pemaparan dipanggil melintasi integrasi pustaka ikon daring Font Awesome. Hal tersebut mereduksi beban aset ukuran penyimpanan server. Integrasinya terhubung stabil memanfaatkan saluran lintas peladen lewat: `cdnjs.cloudflare.com`.

## 8.3 Rujukan Alat Bantu Dokumentasi 
Terkhusus pada ranah penyusunan dokumentasi arsitektur maupun perancangan diagram pelaporan grafis yang disertakan pada direktori manual sistem informasi ini, pengkaji memanfaatkan referensi standar skrip rujukan visualisasi dokumenter:

1. **Mermaid.js Diagram Syntaxes**
   Satu-satunya prosedur standarisasi penulisan model logika yang dipakai mencetak grafik visual alur *Activity Diagram* (*Alir Interaksi*), skema *Sequence Parameter* hingga pemetaan relasional *Database Concept* di seluruh dokumen panduan ini. Pengubahan ke depannya dikendalikan pada tataran modifikasi baris kode logis semata guna mengharamkan kesulitan pengeditan gambar diagram yang konvensional statis murni.

---
*Pencatatan rujukan pihak ke-tiga ini ditertibkan sekadar bagi keperluan keilmiahan pelaporan perangkat lunak sistem aplikasi Web FIKOM universitas secara absolut presisi serta ditujukan untuk mempermudah identifikasi pembaruan layanan pangkalan sistem bersangkutan pada skala masanya kelak.*
