<?php
/**
 * Admin Header - Dashboard Layout
 * Clean & Modern Design System
 */

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include configuration
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/constants.php';
require_once __DIR__ . '/../../includes/functions.php';

// Security check - Verify admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Get admin username and current page
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
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Admin Stylesheet (Consolidated) -->
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
            <!-- Main -->
            <li class="sidebar-title">Main</li>
            <li class="sidebar-item <?php if($currentPage == 'dashboard.php') echo 'active'; ?>">
                <a href="dashboard.php" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
                    </div>
                </a>
            </li>

            <!-- Manajemen Konten -->
            <li class="sidebar-title">Manajemen Konten</li>
            
            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_visimisi.php', 'admin_kelola_struktur.php','admin_kelola_fakta.php','admin_kelola_tentangfak.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-id-card"></i> <span>Kelola Profil</span>
                    </div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="admin_kelola_visimisi.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_visimisi.php') echo 'active'; ?>">Visi Misi</a></li>
                    <li><a href="admin_kelola_struktur.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_struktur.php') echo 'active'; ?>">Struktur Organisasi</a></li>
                    <li><a href="admin_kelola_fakta.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_fakta.php') echo 'active'; ?>">Data Civitas</a></li>
                    <li><a href="admin_kelola_tentangfak.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_tentangfak.php') echo 'active'; ?>">Tentang Fakultas</a></li>
                </ul>
            </li>

            <li class="sidebar-item <?php if($currentPage == 'admin_kelola_slider.php') echo 'active'; ?>">
                <a href="admin_kelola_slider.php" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-image"></i> <span>Kelola Slider</span>
                    </div>
                </a>
            </li>

            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_berita.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-newspaper"></i> <span>Kelola Berita</span>
                    </div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="admin_kelola_berita.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_berita.php') echo 'active'; ?>">Semua Berita</a></li>
                </ul>
            </li>

            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_dosen.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-users"></i> <span>Kelola Dosen</span>
                    </div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="admin_kelola_dosen.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_dosen.php') echo 'active'; ?>">Daftar Dosen</a></li>
                </ul>
            </li>

            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_ruangan.php', 'admin_kelola_lab.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-building"></i> <span>Kelola Fasilitas</span>
                    </div> 
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="admin_kelola_ruangan.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_ruangan.php') echo 'active'; ?>">Ruangan</a></li>
                    <li><a href="admin_kelola_lab.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_lab.php') echo 'active'; ?>">Laboratorium</a></li>
                </ul>
            </li>

            <!-- Akademik Section Header in Screenshot -->
            <li class="sidebar-title">Akademik</li>

            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_kurikulum.php', 'admin_kelola_kalender.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                     <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-graduation-cap"></i> <span>Kelola Akademik</span>
                     </div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="admin_kelola_kurikulum.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_kurikulum.php') echo 'active'; ?>">Kurikulum</a></li>
                    <li><a href="admin_kelola_kalender.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_kalender.php') echo 'active'; ?>">Kalender</a></li>
                </ul>
            </li>

            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_bem.php', 'admin_kelola_kerjasama.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-handshake"></i> <span>Kelola Kerjasama</span>
                    </div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="admin_kelola_bem.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_bem.php') echo 'active'; ?>">BEM</a></li>
                    <li><a href="admin_kelola_kerjasama.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_kerjasama.php') echo 'active'; ?>">Kerjasama</a></li>
                </ul>
            </li>

            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_penelitian.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-flask"></i> <span>Kelola Penelitian</span>
                    </div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="admin_kelola_penelitian.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_penelitian.php') echo 'active'; ?>">Penelitian</a></li>
                </ul>
            </li>

            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_pengabdian.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-hands-helping"></i> <span>Kelola Pengabdian</span>
                    </div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="admin_kelola_pengabdian.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_pengabdian.php') echo 'active'; ?>">Pengabdian</a></li>
                </ul>
            </li>

            <li class="sidebar-item has-submenu <?php if(in_array($currentPage, ['admin_kelola_renop.php', 'admin_kelola_renstra.php', 'admin_kelola_sop.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);" class="sidebar-link">
                     <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-university"></i> <span>Kelola Dokumen</span>
                     </div>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="admin_kelola_renop.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_renop.php') echo 'active'; ?>">Rencana Operasional</a></li>
                    <li><a href="admin_kelola_renstra.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_renstra.php') echo 'active'; ?>">Rencana Strategis</a></li>
                    <li><a href="admin_kelola_sop.php" class="sidebar-link <?php if($currentPage == 'admin_kelola_sop.php') echo 'active'; ?>">SOP</a></li>
                </ul>
            </li>

            <!-- Data Pendaftaran hidden/moved as per screenshot usually implies ends here or scrolls -->
            <li class="sidebar-title">Lainnya</li>
            <li class="sidebar-item <?php if($currentPage == 'admin_kelola_pendaftaran.php') echo 'active'; ?>">
                <a href="admin_kelola_pendaftaran.php" class="sidebar-link">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <i class="fas fa-file-signature"></i> <span>Data Pendaftaran</span>
                    </div>
                </a>
            </li>

            <!-- Logout Sidebar Item -->
             <li class="sidebar-item" style="margin-top: auto;">
                <a href="logout.php" class="sidebar-link text-error">
                    <div style="display:flex; align-items:center; gap:12px; color: var(--error-600);">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </div>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="admin-main" id="main-content">
        <!-- Topbar -->
        <!-- Topbar -->
        <!-- Mobile Hamburger Toggle (Visible only on mobile) -->
        <div class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </div>

        <!-- Content Area -->
        <main class="content-area">
            <!-- Page content goes here -->
