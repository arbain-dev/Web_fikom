<?php
require 'config/database.php';
$result = $conn->query("SELECT id, judul, foto FROM galeri_foto ORDER BY id DESC LIMIT 5");
while ($row = $result->fetch_assoc()) {
    echo "ID: {$row['id']} | Judul: {$row['judul']} | Foto: {$row['foto']}\n";
}
?>
