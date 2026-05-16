<?php
require 'config/database.php';
require 'config/constants.php';

$res = $conn->query("SELECT id, judul, foto FROM galeri_foto WHERE judul LIKE '%Lisan%' LIMIT 5");
while($r = $res->fetch_assoc()) {
    $fotos = json_decode($r['foto'], true);
    if(!is_array($fotos)) $fotos = [$r['foto']];
    $first_foto = $fotos[0] ?? '';
    $src = BASE_URL . "/uploads/galeri_foto/" . htmlspecialchars($first_foto);
    echo "ID: {$r['id']} | Judul: {$r['judul']} | First Foto: {$first_foto} | SRC: {$src}\n";
    echo "Raw Foto DB: " . $r['foto'] . "\n\n";
}
