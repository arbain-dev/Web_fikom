# Struktur Lengkap Tabel Database (Kamus Data)

Berikut adalah rincian struktur dari seluruh tabel yang ada di dalam database `db_web_fikom` beserta keterangannya, merepresentasikan tampilan _Structure_ di phpMyAdmin.

### Tabel: `bem_struktur`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `nama` | `varchar(150)` | No |  | NULL |  |
| `jabatan` | `varchar(100)` | No |  | NULL |  |
| `prodi` | `varchar(100)` | Yes |  | NULL |  |
| `foto` | `varchar(255)` | Yes |  | NULL |  |
| `kategori` | `enum('inti','sekben','departemen')` | No |  | NULL |  |
| `urutan` | `int(11)` | Yes |  | `0` |  |

### Tabel: `berita`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `judul` | `varchar(255)` | No |  | NULL |  |
| `slug` | `varchar(255)` | Yes |  | NULL |  |
| `kategori` | `varchar(100)` | Yes |  | NULL |  |
| `meta` | `varchar(150)` | Yes |  | NULL |  |
| `konten` | `text` | No |  | NULL |  |
| `foto` | `varchar(255)` | Yes |  | NULL |  |
| `tanggal_publish` | `datetime` | No |  | `current_timestamp()` |  |
| `link` | `varchar(255)` | Yes |  | NULL |  |

### Tabel: `dosen`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `nidn` | `varchar(20)` | Yes | Unique | NULL |  |
| `nama` | `varchar(150)` | No |  | NULL |  |
| `program_studi` | `varchar(100)` | Yes |  | NULL |  |
| `keahlian` | `varchar(255)` | Yes |  | NULL |  |
| `pendidikan` | `varchar(20)` | Yes |  | NULL |  |
| `jabatan` | `varchar(50)` | Yes |  | NULL |  |
| `status` | `varchar(50)` | Yes |  | `Tetap` |  |
| `email` | `varchar(100)` | No | Unique | NULL |  |
| `foto` | `varchar(255)` | Yes |  | NULL |  |

### Tabel: `halaman_statis`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `nama_halaman` | `varchar(50)` | No | Unique | NULL |  |
| `konten_html` | `text` | Yes |  | NULL |  |
| `gambar_path` | `varchar(255)` | Yes |  | NULL |  |

### Tabel: `hero_slider`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(10) unsigned` | No | PK (Primary) | NULL | auto_increment |
| `gambar` | `varchar(255)` | No |  | NULL |  |
| `is_active` | `tinyint(1)` | No |  | `1` |  |
| `created_at` | `timestamp` | No |  | `current_timestamp()` |  |

### Tabel: `kalender_akademik`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `nama_kalender` | `varchar(150)` | No |  | NULL |  |
| `deskripsi` | `text` | Yes |  | NULL |  |
| `gambar` | `varchar(255)` | Yes |  | NULL |  |
| `tahun_akademik` | `varchar(20)` | Yes |  | NULL |  |
| `tanggal_upload` | `timestamp` | No |  | `current_timestamp()` |  |

### Tabel: `kerjasama`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `nama_instansi` | `varchar(255)` | No |  | NULL |  |
| `logo` | `varchar(255)` | No |  | NULL |  |
| `link_website` | `varchar(255)` | Yes |  | NULL |  |
| `tanggal_input` | `timestamp` | No |  | `current_timestamp()` |  |
| `bulan` | `varchar(20)` | Yes |  | NULL |  |
| `tahun` | `int(11)` | Yes |  | NULL |  |

### Tabel: `kurikulum`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `nama_kurikulum` | `varchar(150)` | No |  | NULL |  |
| `deskripsi` | `text` | Yes |  | NULL |  |
| `file_pdf` | `varchar(255)` | Yes |  | NULL |  |

### Tabel: `laboratorium`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `nama_lab` | `varchar(100)` | No |  | NULL |  |
| `deskripsi` | `text` | Yes |  | NULL |  |
| `foto` | `varchar(255)` | Yes |  | NULL |  |

### Tabel: `mahasiswa`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `nama` | `varchar(150)` | No |  | NULL |  |
| `nim` | `varchar(20)` | No | Unique | NULL |  |
| `prodi` | `varchar(100)` | Yes |  | NULL |  |
| `angkatan` | `int(4)` | Yes |  | NULL |  |

### Tabel: `pendaftaran`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `nama` | `varchar(100)` | No |  | NULL |  |
| `nik` | `varchar(20)` | No |  | NULL |  |
| `email` | `varchar(100)` | No |  | NULL |  |
| `hp` | `varchar(20)` | No |  | NULL |  |
| `tempat_lahir` | `varchar(100)` | No |  | NULL |  |
| `tanggal_lahir` | `date` | No |  | NULL |  |
| `jk` | `enum('Laki-laki','Perempuan')` | No |  | NULL |  |
| `asal_sekolah` | `varchar(100)` | No |  | NULL |  |
| `prodi` | `varchar(50)` | No |  | NULL |  |
| `jalur` | `varchar(50)` | No |  | NULL |  |
| `alamat` | `text` | No |  | NULL |  |
| `file_ktp` | `varchar(255)` | Yes |  | NULL |  |
| `file_ijazah` | `varchar(255)` | Yes |  | NULL |  |
| `catatan` | `text` | Yes |  | NULL |  |
| `status` | `enum('Pending','Diterima','Ditolak')` | Yes |  | `Pending` |  |
| `created_at` | `timestamp` | No |  | `current_timestamp()` |  |

### Tabel: `penelitian`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `judul` | `varchar(255)` | No |  | NULL |  |
| `peneliti` | `varchar(200)` | Yes |  | NULL |  |
| `tahun` | `int(4)` | Yes |  | NULL |  |
| `sumber_dana` | `varchar(100)` | Yes |  | NULL |  |
| `jumlah_dana` | `bigint(20)` | Yes |  | `0` |  |
| `tanggal_mulai` | `date` | Yes |  | NULL |  |
| `tanggal_selesai` | `date` | Yes |  | NULL |  |
| `status` | `varchar(50)` | Yes |  | `Draft` |  |
| `skim_penelitian` | `varchar(150)` | Yes |  | NULL |  |
| `kelompok_bidang` | `varchar(150)` | Yes |  | NULL |  |
| `nomor_sk` | `varchar(100)` | Yes |  | NULL |  |
| `lama_kegiatan` | `varchar(50)` | Yes |  | NULL |  |
| `lokasi_penelitian` | `varchar(255)` | Yes |  | NULL |  |
| `afiliasi` | `varchar(200)` | Yes |  | NULL |  |
| `link_publikasi` | `varchar(255)` | Yes |  | NULL |  |
| `file_proposal` | `varchar(255)` | Yes |  | NULL |  |
| `file_laporan` | `varchar(255)` | Yes |  | NULL |  |

### Tabel: `pengabdian`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `judul` | `varchar(255)` | No |  | NULL |  |
| `pelaksana` | `varchar(255)` | Yes |  | NULL |  |
| `deskripsi` | `text` | Yes |  | NULL |  |
| `file_pdf` | `varchar(255)` | Yes |  | NULL |  |
| `tanggal_kegiatan` | `date` | Yes |  | NULL |  |

### Tabel: `rencana_operasional`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `nama_dokumen` | `varchar(255)` | No |  | NULL |  |
| `deskripsi` | `text` | Yes |  | NULL |  |
| `file_pdf` | `varchar(255)` | Yes |  | NULL |  |
| `tanggal_upload` | `timestamp` | No |  | `current_timestamp()` |  |

### Tabel: `rencana_strategis`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `nama_dokumen` | `varchar(255)` | No |  | NULL |  |
| `deskripsi` | `text` | Yes |  | NULL |  |
| `file_pdf` | `varchar(255)` | Yes |  | NULL |  |
| `tanggal_upload` | `timestamp` | No |  | `current_timestamp()` |  |

### Tabel: `ruangan`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `nama_ruangan` | `varchar(100)` | No |  | NULL |  |
| `deskripsi` | `text` | Yes |  | NULL |  |
| `foto` | `varchar(255)` | Yes |  | NULL |  |

### Tabel: `sop`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `nama_sop` | `varchar(255)` | No |  | NULL |  |
| `deskripsi` | `text` | Yes |  | NULL |  |
| `file_pdf` | `varchar(255)` | Yes |  | NULL |  |
| `tanggal_upload` | `timestamp` | No |  | `current_timestamp()` |  |

### Tabel: `tabel_dosen`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `nidn` | `varchar(20)` | No | Unique | NULL |  |
| `nama_dosen` | `varchar(100)` | No |  | NULL |  |
| `email` | `varchar(100)` | Yes |  | NULL |  |
| `keahlian` | `text` | Yes |  | NULL |  |

### Tabel: `tb_fakta`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `judul` | `varchar(255)` | No |  | NULL |  |
| `angka` | `int(11)` | No |  | NULL |  |
| `urutan` | `int(11)` | Yes |  | `0` |  |

### Tabel: `tentang_fikom`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `judul` | `varchar(255)` | No |  | NULL |  |
| `deskripsi` | `text` | No |  | NULL |  |
| `gambar` | `varchar(255)` | Yes |  | NULL |  |

### Tabel: `users`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `username` | `varchar(50)` | No | Unique | NULL |  |
| `password` | `varchar(255)` | No |  | NULL |  |
| `email` | `varchar(100)` | No |  | NULL |  |
| `role` | `varchar(50)` | Yes |  | `mahasiswa` |  |
| `foto` | `varchar(255)` | Yes |  | NULL |  |
| `reset_token` | `varchar(64)` | Yes |  | NULL |  |
| `token_expiry` | `datetime` | Yes |  | NULL |  |
| `bulan` | `varchar(20)` | Yes |  | NULL |  |
| `tahun` | `int(11)` | Yes |  | NULL |  |

### Tabel: `visi_misi`
| Field | Type | Null | Key | Default | Extra |
|-------|------|------|-----|---------|-------|
| `id` | `int(11)` | No | PK (Primary) | NULL | auto_increment |
| `kategori` | `varchar(50)` | No |  | NULL |  |
| `konten` | `text` | No |  | NULL |  |
| `urutan` | `int(11)` | No |  | `0` |  |

