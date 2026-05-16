<?php
require_once 'config/database.php';
$res = $conn->query("SELECT id, judul, foto FROM berita LIMIT 10");
$data = [];
while ($row = $res->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data, JSON_PRETTY_PRINT);
