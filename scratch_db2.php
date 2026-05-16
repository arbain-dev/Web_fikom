<?php
require 'config/database.php';
$result = $conn->query("SELECT id, judul, foto FROM galeri_foto ORDER BY id DESC LIMIT 5");
while ($row = $result->fetch_assoc()) {
    $fotos = json_decode($row['foto'], true);
    if(!is_array($fotos)) $fotos = [$row['foto']];
    $first_foto = $fotos[0] ?? '';
    echo "ID: {$row['id']} | Judul: {$row['judul']}\n";
    echo "  DB Foto: {$row['foto']}\n";
    echo "  First Foto: {$first_foto}\n";
    $filepath = __DIR__ . '/uploads/galeri_foto/' . $first_foto;
    echo "  File exists? " . (file_exists($filepath) ? 'YES' : 'NO') . "\n\n";
}
?>
