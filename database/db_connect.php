<?php
// File: db_connect.php
// LOKASI: C:\xampp\htdocs\web_fikom\db_connect.php

$DB_SERVER = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = ""; 
$DB_NAME = "db_web_fikom";

// Buat koneksi (Nama variabelnya $conn)
$conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi ke database GAGAL: " . $conn->connect_error);
}
?>