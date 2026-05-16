<?php
$mysqli = new mysqli('localhost', 'root', '', 'db_web_fikom');
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// 1. Create table
$sql = "CREATE TABLE IF NOT EXISTS galeri_foto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    kategori VARCHAR(100),
    foto VARCHAR(255) NOT NULL,
    tanggal_publish DATE NOT NULL
)";

if ($mysqli->query($sql) === TRUE) {
    echo "Table galeri_foto created successfully.\n";
} else {
    echo "Error creating table: " . $mysqli->error . "\n";
}

$mysqli->close();

// 2. Create upload directory
$dir = 'uploads/galeri_foto';
if (!file_exists($dir)) {
    if (mkdir($dir, 0777, true)) {
        echo "Directory created successfully.\n";
    } else {
        echo "Failed to create directory.\n";
    }
} else {
    echo "Directory already exists.\n";
}
?>
