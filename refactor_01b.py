import re

# The new formal descriptions
descriptions = [
    "Alur dimulai saat pengguna membuka halaman utama beranda. Sistem mengevaluasi apakah pengguna memilih menu navigasi atas. Jika memilih menu navigasi, sistem akan menampilkan halaman terkait lalu proses berakhir. Jika tidak, pengguna akan menggulir ke bawah untuk melihat slider banner utama. Selanjutnya, terdapat pilihan untuk memilih tombol program studi atau berita; jika dipilih, sistem mengalihkan ke halaman yang sesuai. Jika tidak, alur berlanjut menampilkan statistik fakultas dan daftar berita terbaru. Pengguna yang memilih baca artikel akan dialihkan ke halaman detail berita. Apabila diabaikan, sistem akan menampilkan profil singkat fakultas dengan tombol rincian visi misi, opsi pemilihan prodi, informasi akademik, dan berakhir dengan menampilkan daftar logo mitra kerja sama institusi.",
    "Alur dimulai ketika pengguna mengakses halaman visi dan misi fakultas. Sistem akan menampilkan judul halaman. Selanjutnya, pengguna dapat memilih untuk berfokus membaca teks bagian visi fakultas, membaca daftar misi fakultas, atau menuju bagian poin sasaran strategis. Setelah pengguna selesai membaca salah satu atau semua bagian tersebut, proses aktivitas pada halaman ini berakhir.",
    "Alur dimulai sewaktu pengguna membuka halaman sambutan pimpinan. Sistem kemudian memuat halaman teks beserta foto pimpinan fakultas. Pengguna dapat mengerucutkan perhatian untuk membaca teks sambutan lengkap pimpinan atau melihat rincian kontak dan profil singkat yang tersedia. Kegiatan berakhir setelah pengguna selesai mendapatkan informasi dari halaman tersebut.",
    "Alur dimulai pada saat pengguna mengunjungi halaman direktori dosen. Sistem memunculkan daftar susunan dosen pengajar. Jika pengguna memilih untuk mengeklik salah satu susunan dosen, sistem akan merespon dengan menampilkan jendela pop-up berisi informasi detail dosen. Pada pop-up tersebut, pengguna memiliki pilihan ganda untuk menghubungi dosen melalui surel (email) yang terintegrasi dengan perangkat, atau langsung menutup pop-up tersebut. Jika pengguna tidak memilih kartu dosen sejak awal, alur proses selesai.",
    "Alur dimulai saat pengguna mengakses halaman struktur organisasi fakultas. Sistem menampilkan deskripsi awal beserta bagan struktur organisasi. Jika pengguna berkemauan untuk menelusuri pengecekan posisi pimpinan dari jabatan teratas hingga urutan di bawahnya, mereka dapat melacak alur garis dari bagan tersebut. Jika pengguna tidak ingin melacak lebih detail, proses kunjungan pada halaman ini berujung pada penyelesaian (End).",
    "Alur aktivitas dimulai ketika pengunjung masuk ke halaman formulir pendaftaran mahasiswa baru. Pengguna diharuskan mengisi atribut data yang wajib serta mengunggah fail pendaftaran berupa KTP/Ijazah apabila dibutuhkan. Setelah selesai, pengguna mengeklik tombol kirim lamaran. Sistem selanjutnya akan melakukan identifikasi keabsahan; apabila ditemukan kolom kosong atau kesalahan, sistem akan memberikan peringatan dan mengembalikan fokus form kepada pengguna. Jika keseluruhan data tervalidasi benar, sistem mengotomatisasi penyimpanan data ke dalam basis data dan menampilkan pesan berhasil kepada pengguna.",
    "Alur diawali sewaktu pengguna memasuki halaman program studi Informatika. Pengguna membaca teks pendahuluan yang menjelaskan profil jurusan. Jika pengguna memilih untuk melanjutkan cek ke visi misi, sistem akan mengarahkan pada teks rincian visi misi Fakultas lalu memvalidasi apakah pengguna ingin lanjut menelusuri data dosen. Jika pengguna memilih melanjutkan, sistem akan membukakan matriks grid informasi susunan dosen khusus program studi tersebut. Apabila pengguna memutuskan untuk meninggalkan area pengecekan, maka aktivitas pada halaman tuntas.",
    "Alur dimulai ketika pengunjung membuka halaman pengenalan program studi Pendidikan Teknologi Informasi (PTI). Alur ini sangat menyerupai program studi sebelumnya; pengguna membaca narasi pendahuluan prodi, dihadapkan dengan pilihan memeriksa visi dan misi fakultas, serta ditawarkan opsi merunut pendalaman untuk melihat susunan matriks dosen spesialis pada prodi tersebut. Kegiatan ditutup secara utuh tatkala pilihan telah selesai dijalankan atau ditolak.",
    "Pengguna memulai aktivitas dengan mengakses lokasi rincian menu ruangan kelas. Sistem bertugas memampangkan jajaran daftar galeri gambar dari kartu ruangan. Jika pengunjung mempertimbangkan untuk mengeklik salah satu gambar dari ruangan tersebut, sistem otomatis memberikan lemparan respon bentuk memunculkan wujud pop-up besar gambar jendela ruang. Pengguna menuntaskan alur aktivitasnya hanya dengan menekan tuas tanda silang pada jendela tersebut.",
    "Alur diagram berjalan sewaktu pengunjung mengekspansi kursor membuka menu Laboratorium Komputer. Sistem menayangkan rangkaian daftar dokumentasi gambar fasilitas yang ada pada tiap lab. Apabila pengunjung mengharapkan resolusi pantauan yang optimal dan menekan keliru satu referensi gambarnya, sistem memperbesar visualisasinya melalui lapisan pop-up pantul resolusi tinggi. Sesi ditutup saat opsi tekan tombol silang ditekan pengamat.",
    "Alur dimulai ketika sub menu info spesifikasi kurikulum akademis dibentangkan pengguna. Pengunjung mengkonsumsi panel-panel data dari keterangan tersebut. Seandainya pengguna memperkirakan kebutuhan konfirmasi lampiran format dokumen fisik dan memilih klik unduh PDF, aplikasi atau sistem kemudian merilis kotak visual berupa modal pratinjau dokumen. Evaluasi disudahi mana kala jendela penampil tersebut dibatalkan rongsokan layarnya.",
    "Diagram diinisiasi sesaat pengunjung masuk di peraduan lokasi penjadwalan akademik. Pengguna mengamati rentetan daftar panel kartu kalender aktivitas. Pergerakan keputusan diluncurkan apabila sasaran kursor menyentuh area spesifik sektor poster untuk melebarkan bentangannya sebagai bingkai pop-up sentral. Aksi usai ketika penekanan saklar tutup dilakukan oleh sang pengunjung.",
    "Alur berawal saat pengguna memuat halaman terkait dokumen Rencana Operasional (Renop). Sistem menampilkan blok dokumen acuan dan mengajukan persimpangan keputusan bagi pengguna. Jika pengunjung membutuhkan kepemilikan salinan arsip dokumen, mereka memantulkan penekanan unduh PDF, memaksa layanan merespon mentransfer berkas fisik PDF masuk memori pirantinya. Jika pembaca abai atau tidak ingin bermaksud mengunduh berkasnya, rute menyentuh batas simpulnya.",
    "Alur berlaku sebagaimana dokumen Renop; ketika pencarian pengunjung berlabuh pada pekarangan dokumen Rencana Strategis (Renstra), sistem meletakkan deretan tawaran salinan direktori serupa. Subjek diperbolehkan membacanya, dan tatkala perolehan salinan murni diminta, tombol unduh menata instruksi pendistribusian langsung rekaman PDF tersebut menuju pekarangan komputer sang pemakai sekaligus melengkapi keseluruhan sirkulasi aksinya.",
    "Prosedur penjelajahan dimulai kala audiens mengetuk portal halaman SOP (Standar Operasional Prosedur) tingkat Fakultas. Pengunjung disuguhi sajian daftar rujukan manual pelaksanaannya. Seketika desakan mereplika dokumen terhimpun, fokus pada pemacu download menerjemahkan pengembalian fungsi transfer PDF ke arah sarana internal unduhan perangkat mereka. Seluruhnya tuntas dan usai seiring rampungnya penyalinan.",
    "Sirkulasi operasional lahir begitu audiens menerobos pelataran tabel daftar penelitian dosen pendidik. Modul web mengenalkan susunan pelaporan tajuk riset tersebut. Pada momen penikmat memilih untuk mengakuisisi rincian lebih komplit sebuah capaian riset, platform merespon tancap membangun layar jendela berlapis menampung kompilasi seluk-beluk datanya. Dari sinilah percabangan pamungkas dirajut; mendesak klik navigasi url web luar mengoper navigasi merujuk situs jurnal asal, sedang pembungkaman tab layer mengusir pamitan aktivitasnya.",
    "Pengguna tiba di alamat pengumuman catatan aksi kemanusiaan atau Pengabdian Masyarakat civitas. Tampilan warta kegiatan ditertontonkan meluas. Jika gairah mendorong pemakai mengutak-atik isi perihal yang tercatat, respon penekanannya menghidupkan panel pratinjau dokumen dari sistem. Aktivitas diringkas tutup dan purna apabila instrumen pembungkus (viewer) layar tersebut dicabut oleh inisiasi pengunjung.",
    "Kunjungan berpusat saat laman kemahasiswaan Kepengurusan BEM ditekan muatannya. Bagan skema merangkak jatuh berulir tanpa ada saklar percabangan; mendebutkan suguhan deskripsi dasar di panggung pertama, beranjak pada sketsa profil kabinet tingkatan Inti serta pimpinan Bendahara, sebelum bermuara menceritakan jajaran lapisan terluar departemennya dan menjumpai jalan mati sirkulasi navigasi.",
    "Akses diklik melawat ke pojok arsip warta aktivitas Unit Kegiatan Kampus (UKM). Penikmat konten mendarat membaca variasi susunan warta berita di grid menu. Sewaktu pemicu opsi selera menuntut penceritaan lebih mendalam terhadap satu artikel, penekanan tautan spesifik itu mengizinkan sistem web merekayasa pembelokan menuju lembaran detail ulasan selengkapnyanya. Ketiadaan minat murni menutup perputaran opsinya disitu.",
    "Lintasan inisiasi dibuka tat kala alamat pilar ikatan identitas lembaga Program Ti diakses. Diagram aktivitas mengonsep kerangka mengalir tegak lurus seimbang. Serasi mengamati sambutan, bola mata dijejalkan etalase himpunan HMTI selanjutnya berotasi fokus ke susunan himpunan ke dua yakni HMPTI tanpa pemantik distraksi lainnya guna mencapai klimaks penjelajahan lamannya."
]

import re

# Read the file
file_path = "docs/01B_DIAGRAM_AKTIVITAS_PUBLIK.md"
try:
    with open(file_path, "r", encoding="utf-8") as f:
        content = f.read()

    # Split into parts by **Penjelasan:**
    parts = re.split(r'\*\*Penjelasan:\*\*\s*\n', content)
    
    if len(parts) != 21:
        print(f"Error: Found {len(parts) - 1} explanations instead of 20.")
        with open("error_log.txt", "w") as f:
            f.write(f"Parts found: {len(parts)}\n")
    else:
        new_content = parts[0]
        # Reconstruct the text
        for i in range(1, 21):
            desc = descriptions[i-1]
            old_desc_part = parts[i]
            # Strip the old paragraph (everything until '---' or EOF)
            split_next = old_desc_part.split('\n\n---', 1)
            
            # Add the new description
            new_content += "**Penjelasan:**\n" + desc + "\n\n"
            
            if len(split_next) > 1:
                new_content += "---" + split_next[1]
            else:
                pass # EOF reached

        with open(file_path, "w", encoding="utf-8") as f:
            f.write(new_content)
        
        print("Success: Refactored all 20 explanations.")
except Exception as e:
    print(f"Exception: {e}")
