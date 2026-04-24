<?php
/**
 * Konfigurasi Database
 * Koneksi database yang ditingkatkan dengan penanganan error dan keamanan
 */

// Mencegah akses langsung
defined('DB_CONFIG') or define('DB_CONFIG', true);

// Kredensial Database
if (!defined('DB_SERVER')) {
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'db_web_fikom');
}

// Buat koneksi
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Atur charset ke UTF-8 untuk dukungan karakter Indonesia yang benar
$conn->set_charset("utf8mb4");
// Cek koneksi
if ($conn->connect_error) {
    error_log("Database Connection Failed: " . $conn->connect_error);
    die("Maaf, terjadi kesalahan pada sistem. Silakan coba lagi nanti.");
}
// Opsional: Atur zona waktu
date_default_timezone_set('Asia/Makassar');

?>
