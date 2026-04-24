<?php
/**
 * Admin Header - Layout Dashboard
 * Sistem Desain Bersih & Modern
 */

// Mulai sesi jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Sertakan konfigurasi
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/constants.php';
require_once __DIR__ . '/../../includes/functions.php';

// Cek Keamanan - Verifikasi admin sudah login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login");
    exit;
}

// Ambil username admin dan halaman saat ini
$nama_admin = $_SESSION['username'] ?? "Admin";
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?php echo SITE_TITLE; ?></title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Favicon -->
    <link rel="icon" href="<?= BASE_URL ?>/assets/img/pp.png" type="image/png">

    <!-- Admin Stylesheet (Digabungkan) -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css?v=<?= time() ?>">
</head>
<body>

<div class="admin-wrapper">
    <!-- Sidebar -->
    <aside class="admin-sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="<?= BASE_URL ?>/assets/img/pp.png" alt="Logo">
            <h2>Admin Fakultas</h2>
        </div>
        
        <ul class="sidebar-menu">
            <!-- Utama -->
            <li class="sidebar-title">Utama</li>
            <li class="sidebar-item <?php if($currentPage == 'dashboard.php') echo 'active'; ?>">
                <a href="dashboard" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
                    </div>
                </a>
            </li>

            <!-- Manajemen Konten -->
            <li class="sidebar-title">Manajemen Konten</li>
            
            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_visimisi.php', 'admin_kelola_struktur.php','admin_kelola_fakta.php','admin_kelola_tentangfak.php', 'kelola_visimisi.php', 'kelola_struktur.php', 'kelola_fakta.php', 'kelola_tentangfak.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-id-card"></i> <span>Kelola Profil</span>
                    </div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="kelola_visimisi" class="sidebar-link <?php if(strpos($currentPage, 'visimisi') !== false) echo 'active'; ?>">Visi Misi</a></li>
                    <li><a href="kelola_struktur" class="sidebar-link <?php if(strpos($currentPage, 'struktur') !== false) echo 'active'; ?>">Struktur Organisasi</a></li>
                    <li><a href="kelola_fakta" class="sidebar-link <?php if(strpos($currentPage, 'fakta') !== false) echo 'active'; ?>">Data Civitas</a></li>
                    <li><a href="kelola_tentangfak" class="sidebar-link <?php if(strpos($currentPage, 'tentangfak') !== false) echo 'active'; ?>">Tentang Fakultas</a></li>
                </ul>
            </li>

            <li class="sidebar-item <?php if(strpos($currentPage, 'slider') !== false) echo 'active'; ?>">
                <a href="kelola_slider" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-image"></i> <span>Kelola Slider</span>
                    </div>
                </a>
            </li>

            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_berita.php', 'kelola_berita.php', 'kelola_galeri_video.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-newspaper"></i> <span>Berita & Galeri</span>
                    </div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="kelola_berita" class="sidebar-link <?php if(strpos($currentPage, 'berita') !== false) echo 'active'; ?>">Semua Berita</a></li>
                    <li><a href="kelola_galeri_video" class="sidebar-link <?php if(strpos($currentPage, 'galeri_video') !== false) echo 'active'; ?>">Galeri Video</a></li>
                </ul>
            </li>



            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_dosen.php', 'kelola_dosen.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-users"></i> <span>Kelola Dosen</span>
                    </div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="kelola_dosen" class="sidebar-link <?php if(strpos($currentPage, 'dosen') !== false) echo 'active'; ?>">Daftar Dosen</a></li>
                </ul>
            </li>

            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_ruangan.php', 'admin_kelola_lab.php', 'kelola_ruangan.php', 'kelola_lab.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-building"></i> <span>Kelola Fasilitas</span>
                    </div> 
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="kelola_ruangan" class="sidebar-link <?php if(strpos($currentPage, 'ruangan') !== false) echo 'active'; ?>">Ruangan</a></li>
                    <li><a href="kelola_lab" class="sidebar-link <?php if(strpos($currentPage, 'kelola_lab') !== false) echo 'active'; ?>">Laboratorium</a></li>
                </ul>
            </li>

            <!-- Akademik -->
            <li class="sidebar-title">Akademik</li>

            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_kurikulum.php', 'admin_kelola_kalender.php', 'kelola_kurikulum.php', 'kelola_kalender.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                     <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-graduation-cap"></i> <span>Kelola Akademik</span>
                     </div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="kelola_kurikulum" class="sidebar-link <?php if(strpos($currentPage, 'kurikulum') !== false) echo 'active'; ?>">Kurikulum</a></li>
                    <li><a href="kelola_kalender" class="sidebar-link <?php if(strpos($currentPage, 'kalender') !== false) echo 'active'; ?>">Kalender</a></li>
                </ul>
            </li>

            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_bem.php', 'admin_kelola_kerjasama.php', 'kelola_bem.php', 'kelola_kerjasama.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-handshake"></i> <span>Kelola Kemahasiswaan & Kerjasama</span>
                    </div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="kelola_bem" class="sidebar-link <?php if(strpos($currentPage, 'bem') !== false) echo 'active'; ?>">BEM</a></li>
                    <li><a href="kelola_kerjasama" class="sidebar-link <?php if(strpos($currentPage, 'kerjasama') !== false) echo 'active'; ?>">Kerjasama</a></li>
                </ul>
            </li>

            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_penelitian.php', 'kelola_penelitian.php', 'admin_kelola_pengabdian.php', 'kelola_pengabdian.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-flask"></i> <span>Riset</span>
                    </div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="kelola_penelitian" class="sidebar-link <?php if(strpos($currentPage, 'penelitian') !== false) echo 'active'; ?>">Penelitian</a></li>
                    <li><a href="kelola_pengabdian" class="sidebar-link <?php if(strpos($currentPage, 'pengabdian') !== false) echo 'active'; ?>">Pengabdian</a></li>
                </ul>
            </li>

            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_renop.php', 'admin_kelola_renstra.php', 'admin_kelola_sop.php', 'kelola_renop.php', 'kelola_renstra.php', 'kelola_sop.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                     <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-university"></i> <span>Kelola Dokumen</span>
                     </div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="kelola_renop" class="sidebar-link <?php if(strpos($currentPage, 'renop') !== false) echo 'active'; ?>">Dokumen Fakultas</a></li>
                    <li><a href="kelola_renstra" class="sidebar-link <?php if(strpos($currentPage, 'renstra') !== false) echo 'active'; ?>">Rencana Strategis</a></li>
                    <li><a href="kelola_sop" class="sidebar-link <?php if(strpos($currentPage, 'sop') !== false) echo 'active'; ?>">SOP</a></li>
                </ul>
            </li>

            <!-- Data Pendaftaran (Disembunyikan/Dipindahkan) -->
            <li class="sidebar-title">Lainnya</li>
            <li class="sidebar-item <?php if(strpos($currentPage, 'pendaftaran') !== false) echo 'active'; ?>">
                <a href="kelola_pendaftaran" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-file-signature"></i> <span>Data Pendaftaran</span>
                    </div>
                </a>
            </li>

            <!-- Item Sidebar Logout -->
            <li class="sidebar-item <?php if(strpos($currentPage, 'profile') !== false) echo 'active'; ?>">
                <a href="profile" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-cog"></i> <span>Pengaturan</span>
                    </div>
                </a>
            </li>
            
             <li class="sidebar-item" style="margin-top: auto;">
                <a href="logout" class="sidebar-link text-error">
                    <div style="display:flex; align-items:center; gap:12px; color: var(--error-600);">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </div>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Konten Utama -->
    <div class="admin-main" id="main-content">
        <!-- Topbar -->
        <!-- Topbar -->
        <!-- Toggle Hamburger Mobile (Hanya terlihat di mobile) -->
        <div class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </div>

        <!-- Area Konten -->
        <main class="content-area">
            <!-- Konten halaman akan masuk di sini -->
