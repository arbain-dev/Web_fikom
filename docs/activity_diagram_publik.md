# Activity Diagram - Tampilan Publik (Public View)

Dokumen ini berisi activity diagram untuk alur pengguna pada tampilan publik website Fakultas Ilmu Komputer. Setiap diagram disertai dengan penjelasan langkah-langkah logikanya.

---

## 1. Diagram Navigasi Umum (General Navigation)

Diagram ini menggambarkan bagaimana pengunjung berinteraksi dengan website mulai dari halaman utama hingga menelusuri berbagai menu informasi yang tersedia.

```mermaid
activityDiagram
    start
    :Pengunjung membuka URL Website;
    :Sistem menampilkan Halaman Beranda;
    
    if (Ingin melihat profil?) then (Ya)
        :Pilih Menu Profil;
        :Sistem menampilkan (Sambutan/Visi-Misi/Dosen/Struktur);
    else if (Ingin melihat Akademik?) then (Ya)
        :Pilih Menu Akademik/Prodi;
        :Sistem menampilkan (Kurikulum/Program Studi/Kalender);
    else if (Mencari Berita Terbaru?) then (Ya)
        :Scroll ke bagian Berita / Pilih Menu Berita;
        :Klik pada salah satu Judul Berita;
        :Sistem menampilkan Halaman Detail Berita;
    else if (Ingin Mendaftar?) then (Ya)
        :Klik tombol Pendaftaran / Pilih Menu Pendaftaran;
        :Sistem menampilkan Form Pendaftaran;
    endif
    
    :Pengunjung membaca informasi;
    stop
```

### Penjelasan Diagram Navigasi Umum:
1.  **Start**: Pengguna mengakses website melalui browser.
2.  **Halaman Beranda**: Sistem menyajikan slider utama, statistik, dan ringkasan informasi.
3.  **Pengambilan Keputusan**: Pengguna dapat memilih berbagai jalur navigasi:
    *   **Profil**: Untuk mengetahui informasi dasar fakultas.
    *   **Akademik**: Untuk melihat kurikulum, jadwal, dan profil prodi.
    *   **Berita**: Untuk mendapatkan update kegiatan terkini.
    *   **Pendaftaran**: Jalur khusus untuk calon mahasiswa baru.
4.  **End**: Pengguna mendapatkan informasi yang dicari.

---

## 2. Diagram Alur Pendaftaran (Registration Flow)

Diagram ini merinci proses teknis saat calon mahasiswa melakukan pendaftaran online melalui form yang tersedia.

```mermaid
activityDiagram
    start
    :Pengunjung membuka Halaman Pendaftaran;
    :Sistem menampilkan Form Pendaftaran & CSRF Token;
    
    repeat
        :Pengguna mengisi data diri (Nama, NIK, Email, HP, dll);
        :Pengguna memilih Program Studi & Jalur Masuk;
        :Pengguna mengunggah dokumen (KTP/Ijazah) - Opsional;
        :Klik tombol "Kirim Pendaftaran";
        
        if (Data lengkap & Valid?) then (Ya)
            :Sistem memvalidasi CSRF & Keamanan File;
            :Sistem menyimpan data ke Database;
            :Sistem menampilkan Pesan Sukses;
        else (Tidak)
            :Sistem menampilkan Pesan Error (Data tidak lengkap);
        endif
    backward :Perbaiki data;
    until (Pendaftaran Berhasil)
    
    :Admin menerima data & Menghubungi pendaftar;
    stop
```

### Penjelasan Diagram Pendaftaran:
1.  **Persiapan**: Sistem menghasilkan CSRF token untuk keamanan form.
2.  **Input Data**: Pengguna mengisi berbagai field wajib (bertanda *).
3.  **Validasi Sistem**:
    *   Mengecek apakah semua field wajib sudah terisi.
    *   Memvalidasi format file yang diunggah (JPG/PNG/PDF).
    *   Memastikan keamanan melalui token CSRF.
4.  **Penyimpanan**: Jika valid, data dimasukkan ke tabel `pendaftaran`.
5.  **Konfirmasi**: Pengguna menerima notifikasi bahwa data telah tersimpan, dan proses berpindah ke sisi admin secara offline (menghubungi via WA/Email).

---

## 3. Diagram Penemuan Konten (Content Discovery - Berita)

Diagram ini menjelaskan alur sistem saat pengguna mencari dan membaca detail berita atau informasi riset.

```mermaid
activityDiagram
    start
    :Pengguna membuka Halaman Berita;
    :Sistem mengambil daftar berita dari Database;
    :Sistem menampilkan Grid Kartu Berita;
    
    :Pengguna memilih/klik berita tertentu;
    :Sistem mengirim ID Berita via URL (GET);
    
    :Sistem mencari detail berita berdasarkan ID;
    if (Berita ditemukan?) then (Ya)
        :Sistem menampilkan Halaman Detail Berita;
        :Sistem mengambil berita terkait/terbaru untuk Sidebar;
    else (Tidak)
        :Sistem mengalihkan kembali ke Daftar Berita;
    endif
    
    if (Ingin membagikan?) then (Ya)
        :Klik tombol Share (FB/WA/Twitter);
        :Membuka URL Share Platform terkait;
    endif
    
    stop
```

### Penjelasan Diagram Penemuan Konten:
1.  **Daftar Berita**: Sistem melakukan query ke database untuk menampilkan ringkasan berita terbaru.
2.  **Interaksi**: Pengguna memilih berita yang menarik perhatiannya.
3.  **Proses Detail**:
    *   Sistem memvalidasi ID yang dikirim melalui parameter URL.
    *   Jika valid, konten lengkap berita ditampilkan beserta gambar dan meta data.
    *   Jika ID tidak valid atau berita dihapus, sistem secara otomatis melakukan redirect demi kenyamanan pengguna.
4.  **Fitur Tambahan**: Pengguna dapat langsung membagikan konten ke media sosial atau melihat berita populer lainnya di bagian sidebar.
