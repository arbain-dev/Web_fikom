<?php
/**
 * Database Configuration
 * Improved database connection with error handling and security
 */

// Prevent direct access
defined('DB_CONFIG') or define('DB_CONFIG', true);

// Database credentials
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'db_web_fikom');

// Create connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Set charset to UTF-8 for proper Indonesian character support
$conn->set_charset("utf8mb4");

// Check connection
if ($conn->connect_error) {
    // Log error (in production, write to file instead of displaying)
    error_log("Database Connection Failed: " . $conn->connect_error);
    die("Maaf, terjadi kesalahan pada sistem. Silakan coba lagi nanti.");
}

// Optional: Set timezone
date_default_timezone_set('Asia/Makassar');

?>
