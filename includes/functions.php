<?php
/**
 * Fungsi Bantuan
 * Fungsi utilitas yang digunakan di seluruh aplikasi
 */

/**
 * Bersihkan input untuk mencegah serangan XSS
 */
function sanitize_input($data) {
    if (is_array($data)) {
        return array_map('sanitize_input', $data);
    }
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Format tanggal ke format Indonesia
 */
function format_date_indo($date, $include_time = false) {
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    
    $timestamp = strtotime($date);
    $day = date('d', $timestamp);
    $month = $bulan[(int)date('m', $timestamp)];
    $year = date('Y', $timestamp);
    
    $formatted = "$day $month $year";
    
    if ($include_time) {
        $time = date('H:i', $timestamp);
        $formatted .= " $time WIB";
    }
    
    return $formatted;
}

/**
 * Buat slug dari string
 */
function create_slug($string) {
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9-]/', '-', $string);
    $string = preg_replace('/-+/', '-', $string);
    $string = trim($string, '-');
    return $string;
}

/**
 * Potong teks dengan ellipsis
 */
function truncate_text($text, $length = 100, $ellipsis = '...') {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . $ellipsis;
}

/**
 * Tangani unggahan file dengan validasi
 */
function handle_upload($file, $upload_dir, $allowed_types = null) {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'File upload error'];
    }
    
    // Validasi tipe file
    if ($allowed_types && !in_array($file['type'], $allowed_types)) {
        return ['success' => false, 'message' => 'File type not allowed'];
    }
    
    // Validasi ukuran file
    if (defined('MAX_FILE_SIZE') && $file['size'] > MAX_FILE_SIZE) {
        return ['success' => false, 'message' => 'File size too large'];
    }
    
    // Buat nama file unik
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '_' . time() . '.' . $extension;
    $filepath = $upload_dir . '/' . $filename;
    
    // Buat direktori jika belum ada
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    // Pindahkan file yang diunggah
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return ['success' => true, 'filename' => $filename, 'filepath' => $filepath];
    }
    
    return ['success' => false, 'message' => 'Failed to move uploaded file'];
}

/**
 * Ambil kelas menu aktif
 */
function is_active_menu($page_name) {
    $current_page = basename($_SERVER['PHP_SELF']);
    return ($current_page === $page_name) ? 'active' : '';
}

/**
 * Cek apakah pengguna sudah login (admin)
 */
function is_logged_in() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Alihkan ke URL
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Dapatkan format "waktu yang lalu"
 */
function time_ago($datetime) {
    $timestamp = strtotime($datetime);
    $difference = time() - $timestamp;
    
    if ($difference < 60) {
        return 'Baru saja';
    } elseif ($difference < 3600) {
        $minutes = floor($difference / 60);
        return $minutes . ' menit yang lalu';
    } elseif ($difference < 86400) {
        $hours = floor($difference / 3600);
        return $hours . ' jam yang lalu';
    } elseif ($difference < 604800) {
        $days = floor($difference / 86400);
        return $days . ' hari yang lalu';
    } else {
        return format_date_indo($datetime);
    }
}

/**
 * Format angka gaya Indonesia
 */
function format_number_indo($number) {
    return number_format($number, 0, ',', '.');
}

/**
 * Buat string acak
 */
function generate_random_string($length = 10) {
    return bin2hex(random_bytes($length / 2));
}

?>
