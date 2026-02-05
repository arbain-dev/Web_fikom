<?php
/**
 * Main Router (Front Controller)
 * 
 * Handles all incoming requests and routes them to the appropriate page
 * in the 'pages/' directory.
 */

// Include configuration if needed globally (optional, but good practice)
define('DB_CONFIG', true);
require_once 'config/constants.php';
require_once 'config/database.php';

// Get the requested path
$request = $_SERVER['REQUEST_URI'];
$script_name = $_SERVER['SCRIPT_NAME']; // e.g., /web_fikom/index.php

// Determine the base path of the application
$base_path = dirname($script_name);

// Remove the base path from the request URI to get the relative path
// Example: Request /web_fikom/dosen -> Relative: /dosen
$path = str_replace($base_path, '', $request);

// Clean up the path (remove query strings and trailing slashes)
$path = parse_url($path, PHP_URL_PATH);
$path = trim($path, '/');

// Default page
if (empty($path)) {
    $path = 'home';
}

// Security: Prevent directory traversal
$path = str_replace(['.', '/'], '', $path);

// Define the target file
$file = 'pages/' . $path . '.php';

// Check if file exists
if (file_exists($file)) {
    // Current Page variable for header/nav active states
    // We map 'home' back to 'index.php' for compatibility with existing isActive() logic if needed,
    // OR we update isActive() logic. Let's keep consistency.
    $currentPage = ($path === 'home') ? 'index.php' : $path . '.php';
    
    // Include the page
    include $file;
} else {
    // 404 Not Found
    http_response_code(404);
    // You can create a pages/404.php if you want
    echo "<h1>404 - Halaman Tidak Ditemukan</h1>";
    echo "<p>Halaman yang Anda cari ($path) tidak ada.</p>";
    echo "<a href='" . BASE_URL . "'>Kembali ke Beranda</a>";
}
