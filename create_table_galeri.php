<?php
// Script untuk membuat tabel 'galeri' (Database Schema)
require_once 'config/database.php';

// Hapus tabel jika ada (opsional, hati-hati di produksi)
// $conn->query("DROP TABLE IF EXISTS galeri"); 

$query = "CREATE TABLE IF NOT EXISTS galeri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255) NOT NULL,
    tanggal_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($query) === TRUE) {
    echo "Tabel 'galeri' berhasil dibuat atau sudah ada.<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Buat direktori unggahan jika belum ada
$upload_dir = 'uploads/galeri';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
    echo "Folder '$upload_dir' berhasil dibuat.<br>";
}

// Keamanan: Mencegah listing direktori
$index_file = $upload_dir . '/index.php';
if (!file_exists($index_file)) {
    file_put_contents($index_file, '<?php // Mencegah akses langsung ?>');
    echo "File index protection created.<br>";
}

?>
