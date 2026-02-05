<?php
// Script to create 'galeri' table
require_once 'config/database.php';

// Drop table if exists (optional, careful in production)
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

// Create uploads directory if not exists
$upload_dir = 'uploads/galeri';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
    echo "Folder '$upload_dir' berhasil dibuat.<br>";
}

// Security: Prevent directory listing
$index_file = $upload_dir . '/index.php';
if (!file_exists($index_file)) {
    file_put_contents($index_file, '<?php // Silence is golden ?>');
    echo "File index protection created.<br>";
}

?>
