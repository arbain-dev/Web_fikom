<?php
require 'd:/xampp/htdocs/web_fikom/config/database.php';
$res = $conn->query('SELECT * FROM galeri_foto LIMIT 5');
while($r = $res->fetch_assoc()) {
    var_dump($r['foto']);
}
