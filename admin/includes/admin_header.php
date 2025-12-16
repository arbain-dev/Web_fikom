<?php
// File: admin/includes/admin_header.php

// Periksa apakah admin sudah login.
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Ambil nama user untuk sapaan
$nama_admin = $_SESSION['username'] ?? "Admin";
// Dapatkan nama file saat ini untuk menandai link yang aktif
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FIKOM</title>
    
    <!-- GLOBAL ADMIN CSS -->
    <link rel="stylesheet" href="../assets/css/admin-global.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <!-- ICON & FONT -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2>Admin FIKOM</h2>
        </div>
        
        <ul class="nav-menu">
            <!-- MAIN -->
            <li class="nav-title">Main</li>
            <li class="<?php if($currentPage == 'dashboard.php') echo 'active'; ?>">
                <a href="dashboard.php">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>

            <!-- MANAJEMEN KONTEN -->
            <li class="nav-title">Manajemen Konten</li>
            
            <li class="<?php if($currentPage == 'admin_kelola_slider.php') echo 'active'; ?>">
                <a href="admin_kelola_slider.php">
                    <i class="fas fa-image"></i> Kelola Slider
                </a>
            </li>

            <li class="has-submenu <?php if(in_array($currentPage, ['admin_kelola_visimisi.php', 'admin_kelola_struktur.php','admin_kelola_fakta.php','admin_kelola_tentangfak.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);">
                    <i class="fas fa-id-card"></i> Kelola Profil 
                    <i class="fas fa-chevron-right arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="admin_kelola_visimisi.php" class="<?php if($currentPage == 'admin_kelola_visimisi.php') echo 'active'; ?>">Visi Misi</a></li>
                    <li><a href="admin_kelola_struktur.php" class="<?php if($currentPage == 'admin_kelola_struktur.php') echo 'active'; ?>">Struktur Organisasi</a></li>
                    <li><a href="admin_kelola_fakta.php" class="<?php if($currentPage == 'admin_kelola_fakta.php') echo 'active'; ?>">Data Civitas</a></li>
                    <li><a href="admin_kelola_tentangfak.php" class="<?php if($currentPage == 'admin_kelola_tentangfak.php') echo 'active'; ?>">Tentang Fakultas</a></li>
                    <li><a href="admin_kelola_pendaftaran.php" class="<?php if($currentPage == 'admin_kelola_pendaftaran.php') echo 'active'; ?>">Pendaftaran</a></li>
                </ul>
            </li>

            <li class="has-submenu <?php if(in_array($currentPage, ['admin_kelola_berita.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);">
                    <i class="fas fa-newspaper"></i> Kelola Berita 
                    <i class="fas fa-chevron-right arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="admin_kelola_berita.php" class="<?php if($currentPage == 'admin_kelola_berita.php') echo 'active'; ?>">Lihat Semua Berita</a></li>
                </ul>
            </li>

            <li class="has-submenu <?php if(in_array($currentPage, ['admin_kelola_dosen.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);">
                    <i class="fas fa-users"></i> Kelola Dosen 
                    <i class="fas fa-chevron-right arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="admin_kelola_dosen.php" class="<?php if($currentPage == 'admin_kelola_dosen.php') echo 'active'; ?>">Lihat Daftar Dosen</a></li>
                </ul>
            </li>

            <li class="has-submenu <?php if(in_array($currentPage, ['admin_kelola_ruangan.php', 'admin_kelola_lab.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);">
                    <i class="fas fa-building"></i> Kelola Fasilitas <i class="fas fa-chevron-right arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="admin_kelola_ruangan.php" class="<?php if($currentPage == 'admin_kelola_ruangan.php') echo 'active'; ?>">Ruangan</a></li>
                    <li><a href="admin_kelola_lab.php" class="<?php if($currentPage == 'admin_kelola_lab.php') echo 'active'; ?>">Lab Komputer</a></li>
                </ul>
            </li>

            <!-- AKADEMIK -->
            <li class="nav-title">Akademik</li>

            <li class="has-submenu <?php if(in_array($currentPage, ['admin_kelola_kurikulum.php', 'admin_kelola_kalender.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);">
                    <i class="fas fa-graduation-cap"></i> Kelola Akademik 
                    <i class="fas fa-chevron-right arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="admin_kelola_kurikulum.php" class="<?php if($currentPage == 'admin_kelola_kurikulum.php') echo 'active'; ?>">Kurikulum</a></li>
                    <li><a href="admin_kelola_kalender.php" class="<?php if($currentPage == 'admin_kelola_kalender.php') echo 'active'; ?>">Kalender</a></li>
                </ul>
            </li>

            <li class="<?php if($currentPage == 'admin_kelola_kerjasama.php') echo 'active'; ?>">
                <a href="admin_kelola_kerjasama.php">
                    <i class="fas fa-handshake"></i> Kelola Kerjasama
                </a>
            </li>

            <li class="<?php if($currentPage == 'admin_kelola_penelitian.php') echo 'active'; ?>">
                <a href="admin_kelola_penelitian.php">
                    <i class="fas fa-flask"></i> Kelola Penelitian
                </a>
            </li>

            <li class="<?php if($currentPage == 'admin_kelola_pengabdian.php') echo 'active'; ?>">
                <a href="admin_kelola_pengabdian.php">
                    <i class="fas fa-hands-helping"></i> Kelola Pengabdian
                </a>
            </li>

            <li class="has-submenu <?php if(in_array($currentPage, ['admin_kelola_renop.php', 'admin_kelola_renstra.php', 'admin_kelola_sop.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);">
                    <i class="fas fa-file-alt"></i> Kelola Dokumen 
                    <i class="fas fa-chevron-right arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="admin_kelola_renop.php" class="<?php if($currentPage == 'admin_kelola_renop.php') echo 'active'; ?>">Rencana Operasi</a></li>
                    <li><a href="admin_kelola_renstra.php" class="<?php if($currentPage == 'admin_kelola_renstra.php') echo 'active'; ?>">Rencana Strategis</a></li>
                    <li><a href="admin_kelola_sop.php" class="<?php if($currentPage == 'admin_kelola_sop.php') echo 'active'; ?>">Standar Operasi Prosedur</a></li>
                </ul>
            </li>

            <!-- MAHASISWA & ALUMNI -->
            <li class="nav-title">Mahasiswa & Alumni</li>

            <li class="has-submenu <?php if(in_array($currentPage, ['admin_kelola_bem.php', 'admin_kelola_ukm.php', 'admin_kelola_hima.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);">
                    <i class="fas fa-sitemap"></i> Organisasi Mahasiswa 
                    <i class="fas fa-chevron-right arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="admin_kelola_bem.php" class="<?php if($currentPage == 'admin_kelola_bem.php') echo 'active'; ?>">BEM Fakultas</a></li>
                </ul>
            </li>

            <!-- LAINNYA -->
            <li class="nav-title">Lainnya</li>
            <li class="has-submenu <?php if(in_array($currentPage, ['login.php', 'register.php'])) echo 'open active'; ?>">
                <a href="javascript:void(0);">
                    <i class="fas fa-lock"></i> Authentication 
                    <i class="fas fa-chevron-right arrow"></i>
                </a>
                <ul class="submenu">
                    <li><a href="login.php">Login</a></li> 
                    <li><a href="register.php">Register</a></li>
                </ul>
            </li>

            <li>
                <a href="logout.php" style="color: #ffb8b8;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>
    
    <!-- MAIN CONTENT WRAPPER -->
    <div class="main-content" id="main-content">
        <header class="topbar">
            <div class="topbar-left">
                <i class="fas fa-bars hamburger" id="hamburger"></i>
            </div>
            <div class="topbar-right">
                <div class="user-profile">
                    <img src="https://i.pravatar.cc/150?img=3" alt="Foto Profil">
                    <span><?= htmlspecialchars($nama_admin) ?></span>
                </div>
            </div>
        </header>

        <main class="content-area">
            <!-- Konten halaman akan dimuat di sini -->


<script src="../assets/js/sidebar.js"></script>