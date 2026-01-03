<?php
/**
 * Application Constants
 * Define constants for paths, URLs, and application settings
 */

// Prevent direct access
if (!defined('DB_CONFIG')) {
    die('Direct access not permitted');
}

// Base paths
define('BASE_PATH', dirname(__DIR__));
define('ADMIN_PATH', BASE_PATH . '/admin');
define('ASSETS_PATH', BASE_PATH . '/assets');
define('UPLOADS_PATH', BASE_PATH . '/uploads');
define('INCLUDES_PATH', BASE_PATH . '/includes');

// Base URL (Dynamic detection for Laragon/Localhost)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];

// Detect if running in a subdirectory
// Detect if running in a subdirectory
$script_name = dirname($_SERVER['SCRIPT_NAME']);
$script_name = str_replace('\\', '/', $script_name);
$path_parts = explode('/', trim($script_name, '/'));

// Known subdirectories to strip from the end
$exclude_dirs = ['admin', 'includes', 'config'];

// Remove known dirs if they are at the end of the path
while (!empty($path_parts) && in_array(strtolower(end($path_parts)), $exclude_dirs)) {
    array_pop($path_parts);
}

// Rebuild path
$script_name = '/' . implode('/', $path_parts);
// Ensure plain root is empty or single slash correct logic
if ($script_name === '/') $script_name = '';

$base_url = $protocol . "://" . $host . $script_name;

define('BASE_URL', $base_url);
define('ASSETS_URL', BASE_URL . '/assets');
define('UPLOADS_URL', BASE_URL . '/uploads');
define('ADMIN_URL', BASE_URL . '/admin');

// Application settings
define('SITE_NAME', 'Muhammad Arbain');
define('SITE_TITLE', 'Muhammad Arbain');
define('SITE_EMAIL', 'arbain@arbain.id');
define('SITE_PHONE', '+62 xxx xxxx xxxx');

// Upload settings
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp']);
define('ALLOWED_DOC_TYPES', ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);

// Pagination
define('ITEMS_PER_PAGE', 10);
define('ADMIN_ITEMS_PER_PAGE', 15);

// Session settings
define('SESSION_LIFETIME', 3600); // 1 hour

?>
