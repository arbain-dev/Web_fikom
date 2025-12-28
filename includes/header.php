<?php
/**
 * Frontend Header - Complete Document Head + Navigation
 * Clean & Modern Design System
 */

// Get current page for active state
$currentPage = basename($_SERVER['PHP_SELF']);

// Helper functions for active state
function isActive($pageName, $currentPage) {
    return $pageName == $currentPage ? 'active' : '';
}

function isParentActive($pages, $currentPage) {
    return in_array($currentPage, $pages) ? 'active' : '';
}

// Page title mapping
$pageTitles = [
    'index.php' => 'Beranda',
    'alumni.php' => 'Tracer Study Alumni',
    'bem.php' => 'Struktur BEM',
    'dosen.php' => 'Dosen',
    'berita_semua.php' => 'Berita',
    'detail-berita.php' => 'Detail Berita',
    'kalender.php' => 'Kalender Akademik',
    'kurikulum.php' => 'Kurikulum',
    'laboratorium.php' => 'Laboratorium',
    'ruangan.php' => 'Ruangan',
    'penelitian.php' => 'Penelitian',
    'pengabdian.php' => 'Pengabdian',
    'visi-misi.php' => 'Visi & Misi',
    'struktur.php' => 'Struktur Organisasi',
    'himpunan_mahasiswa.php' => 'Himpunan Mahasiswa',
    'berita-ukm.php' => 'UKM',
    'rencana_operasional.php' => 'Rencana Operasional',
    'rencana_strategis.php' => 'Rencana Strategis',
    'sop.php' => 'SOP',
    'pendaftaran.php' => 'Pendaftaran Mahasiswa Baru',
];

$pageTitle = $pageTitles[$currentPage] ?? 'FIKOM UNISAN';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> - FIKOM UNISAN</title>
    <meta name="description" content="Website resmi Fakultas Ilmu Komputer UNISAN Sidenreng Rappang">
    <link rel="icon" href="assets/img/pp.png" type="image/png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Main Stylesheet (Consolidated) -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/main.css">
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar" id="navbar">
    <div class="navbar-container">
        <!-- Logo -->
        <a href="index.php" class="navbar-logo">
            <img src="assets/img/pp.png" alt="Logo FIKOM">
            <span>FIKOM</span>
        </a>

        <!-- Hamburger Menu (Mobile) -->
        <div class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </div>

        <!-- Navigation Menu -->
        <ul class="nav-menu" id="navMenu">
            <!-- Profil Dropdown -->
            <li class="nav-item <?= isParentActive(['visi-misi.php', 'dosen.php', 'struktur.php'], $currentPage) ?>">
                <a href="#" class="nav-link">
                    Profil
                    <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <ul class="nav-dropdown">
                    <li><a href="visi-misi.php" class="nav-dropdown-item <?= isActive('visi-misi.php', $currentPage) ?>">Visi & Misi</a></li>
                    <li><a href="dosen.php" class="nav-dropdown-item <?= isActive('dosen.php', $currentPage) ?>">Dosen</a></li>
                    <li><a href="struktur.php" class="nav-dropdown-item <?= isActive('struktur.php', $currentPage) ?>">Struktur Organisasi</a></li>
                    <li><a href="pendaftaran.php" class="nav-dropdown-item <?= isActive('pendaftaran.php', $currentPage) ?>">Pendaftaran</a></li>
                </ul>
            </li>

            <!-- Program Studi Dropdown -->
            <li class="nav-item <?= isParentActive(['index_ti.php', 'index_pti.php'], $currentPage) ?>">
                <a href="#" class="nav-link">
                    Program Studi
                    <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <ul class="nav-dropdown">
                    <li><a href="index_ti.php" class="nav-dropdown-item <?= isActive('index_ti.php', $currentPage) ?>">Informatika</a></li>
                    <li><a href="index_pti.php" class="nav-dropdown-item <?= isActive('index_pti.php', $currentPage) ?>">Pend. Teknologi Informasi</a></li>
                </ul>
            </li>

            <!-- Fasilitas Dropdown -->
            <li class="nav-item <?= isParentActive(['ruangan.php', 'laboratorium.php'], $currentPage) ?>">
                <a href="#" class="nav-link">
                    Fasilitas
                    <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <ul class="nav-dropdown">
                    <li><a href="ruangan.php" class="nav-dropdown-item <?= isActive('ruangan.php', $currentPage) ?>">Ruangan</a></li>
                    <li><a href="laboratorium.php" class="nav-dropdown-item <?= isActive('laboratorium.php', $currentPage) ?>">Laboratorium</a></li>
                </ul>
            </li>

            <!-- Akademik Dropdown -->
            <li class="nav-item <?= isParentActive(['kurikulum.php', 'kalender.php'], $currentPage) ?>">
                <a href="#" class="nav-link">
                    Akademik
                    <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <ul class="nav-dropdown">
                    <li><a href="kurikulum.php" class="nav-dropdown-item <?= isActive('kurikulum.php', $currentPage) ?>">Kurikulum</a></li>
                    <li><a href="kalender.php" class="nav-dropdown-item <?= isActive('kalender.php', $currentPage) ?>">Kalender Akademik</a></li>
                </ul>
            </li>

            <!-- Dokumen Dropdown -->
            <li class="nav-item <?= isParentActive(['rencana_operasional.php', 'rencana_strategis.php', 'sop.php'], $currentPage) ?>">
                <a href="#" class="nav-link">
                    Dokumen
                    <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <ul class="nav-dropdown">
                    <li><a href="rencana_operasional.php" class="nav-dropdown-item <?= isActive('rencana_operasional.php', $currentPage) ?>">Rencana Operasional</a></li>
                    <li><a href="rencana_strategis.php" class="nav-dropdown-item <?= isActive('rencana_strategis.php', $currentPage) ?>">Rencana Strategis</a></li>
                    <li><a href="sop.php" class="nav-dropdown-item <?= isActive('sop.php', $currentPage) ?>">Standar Operasional Prosedur</a></li>
                </ul>
            </li>

            <!-- Penelitian & Pengabdian Dropdown -->
            <li class="nav-item <?= isParentActive(['penelitian.php', 'pengabdian.php'], $currentPage) ?>">
                <a href="#" class="nav-link">
                    Riset
                    <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <ul class="nav-dropdown">
                    <li><a href="penelitian.php" class="nav-dropdown-item <?= isActive('penelitian.php', $currentPage) ?>">Penelitian</a></li>
                    <li><a href="pengabdian.php" class="nav-dropdown-item <?= isActive('pengabdian.php', $currentPage) ?>">Pengabdian</a></li>
                </ul>
            </li>

            <!-- Organisasi Mahasiswa Dropdown -->
            <li class="nav-item <?= isParentActive(['bem.php', 'berita-ukm.php', 'himpunan_mahasiswa.php'], $currentPage) ?>">
                <a href="#" class="nav-link">
                    Kemahasiswaan
                    <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <ul class="nav-dropdown">
                    <li><a href="bem.php" class="nav-dropdown-item <?= isActive('bem.php', $currentPage) ?>">BEM</a></li>
                    <li><a href="berita-ukm.php" class="nav-dropdown-item <?= isActive('berita-ukm.php', $currentPage) ?>">UKM</a></li>
                    <li><a href="himpunan_mahasiswa.php" class="nav-dropdown-item <?= isActive('himpunan_mahasiswa.php', $currentPage) ?>">Himpunan</a></li>
                </ul>
            </li>

            <!-- Alumni (No Dropdown) -->
            <li class="nav-item <?= isActive('alumni.php', $currentPage) ?>">
                <a href="alumni.php" class="nav-link">Alumni</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Mobile Overlay -->
<div class="mobile-overlay" id="mobileOverlay" onclick="toggleMobileMenu()"></div>


