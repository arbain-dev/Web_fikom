<?php
/**
 * Router Utama (Front Controller)
 * 
 * Menangani semua permintaan masuk dan mengarahkannya ke halaman yang sesuai
 * di direktori 'pages/'.
 */

// Sertakan konfigurasi global
define('DB_CONFIG', true);
require_once 'config/constants.php';
require_once 'config/database.php';

// Ambil jalur permintaan
$request = $_SERVER['REQUEST_URI'];
$script_name = $_SERVER['SCRIPT_NAME']; // e.g., /web_fikom/index.php

// Tentukan jalur dasar aplikasi
$base_path = dirname($script_name);

// Hapus jalur dasar dari URI permintaan untuk mendapatkan jalur relatif
// Contoh: Request /web_fikom/dosen -> Relative: /dosen
$path = str_replace($base_path, '', $request);

// Bersihkan jalur (hapus query string dan slash di akhir)
$path = parse_url($path, PHP_URL_PATH);
$path = trim($path, '/');

// Halaman default
if (empty($path)) {
    $path = 'home';
}

// Keamanan: Mencegah directory traversal
$path = str_replace(['.', '/'], '', $path);

// Tentukan file target
$file = 'pages/' . $path . '.php';

// Cek apakah file ada
if (file_exists($file)) {
    // Variabel Current Page untuk status aktif header/navigasi
    // Kami memetakan 'home' kembali ke 'index.php' untuk konsistensi
    $currentPage = ($path === 'home') ? 'index.php' : $path . '.php';
    
    // Sertakan halaman
    include $file;
} else {
    // 404 Halaman Tidak Ditemukan
    http_response_code(404);
    // Anda bisa membuat pages/404.php jika diinginkan
    echo "<h1>404 - Halaman Tidak Ditemukan</h1>";
    echo "<p>Halaman yang Anda cari ($path) tidak ada.</p>";
    echo "<a href='" . BASE_URL . "'>Kembali ke Beranda</a>";
}
