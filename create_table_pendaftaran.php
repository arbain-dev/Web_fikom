<?php
require_once 'config/database.php';

$sql = "CREATE TABLE IF NOT EXISTS pendaftaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nik VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    hp VARCHAR(20) NOT NULL,
    tempat_lahir VARCHAR(100) NOT NULL,
    tanggal_lahir DATE NOT NULL,
    jk ENUM('Laki-laki', 'Perempuan') NOT NULL,
    asal_sekolah VARCHAR(100) NOT NULL,
    prodi VARCHAR(50) NOT NULL,
    jalur VARCHAR(50) NOT NULL,
    alamat TEXT NOT NULL,
    file_ktp VARCHAR(255),
    file_ijazah VARCHAR(255),
    catatan TEXT,
    status ENUM('Pending', 'Diterima', 'Ditolak') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'pendaftaran' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
?>
