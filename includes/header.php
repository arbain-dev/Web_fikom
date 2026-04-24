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
    'sambutan.php' => 'Sambutan Dekan',
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
    'rencana_operasional.php' => 'Dokumen Fakultas',
    'rencana_strategis.php' => 'Rencana Strategis',
    'sop.php' => 'SOP',
    'pendaftaran.php' => 'Pendaftaran Mahasiswa Baru',
    'galeri_video.php' => 'Galeri Video',
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
    <link rel="icon" href="<?= defined('BASE_URL') ? BASE_URL : '.' ?>/assets/img/pp.png" type="image/png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Main Stylesheet (Consolidated) -->
    <link rel="stylesheet" href="<?= defined('BASE_URL') ? BASE_URL : '.' ?>/assets/css/main.css?v=<?= time() ?>">
</head>
<body class="<?= isset($bodyClass) ? $bodyClass : '' ?>">

<!-- Navigation Bar -->
<nav class="navbar" id="navbar">
    <div class="navbar-container">
        <!-- Logo -->
        <a href="<?= BASE_URL ?>" class="navbar-logo">
            <img src="<?= BASE_URL ?>/assets/img/pp.png" alt="Logo FIKOM">
            <span>FIKOM</span>
        </a>

        <!-- Hamburger Menu (Mobile) -->
        <div class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </div>

        <!-- Navigation Menu -->
        <ul class="nav-menu" id="navMenu">
            <!-- Profil Dropdown -->
            <li class="nav-item <?= isParentActive(['sambutan.php', 'visi-misi.php', 'dosen.php', 'struktur.php'], $currentPage) ?>">
                <a href="#" class="nav-link">
                    Profil
                    <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <ul class="nav-dropdown">
                    <li><a href="sambutan" class="nav-dropdown-item <?= isActive('sambutan.php', $currentPage) ?>">Sambutan Dekan</a></li>
                    <li><a href="visi-misi" class="nav-dropdown-item <?= isActive('visi-misi.php', $currentPage) ?>">Visi & Misi</a></li>
                    <li><a href="dosen" class="nav-dropdown-item <?= isActive('dosen.php', $currentPage) ?>">Dosen</a></li>
                    <li><a href="struktur" class="nav-dropdown-item <?= isActive('struktur.php', $currentPage) ?>">Struktur Organisasi</a></li>
                    <li><a href="pendaftaran" class="nav-dropdown-item <?= isActive('pendaftaran.php', $currentPage) ?>">Pendaftaran</a></li>
                </ul>
            </li>

            <!-- Program Studi Dropdown -->
            <li class="nav-item <?= isParentActive(['informatika.php', 'pendidikan_teknologi_informasi.php'], $currentPage) ?>">
                <a href="#" class="nav-link">
                    Program Studi
                    <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <ul class="nav-dropdown">
                    <li><a href="informatika" class="nav-dropdown-item <?= isActive('informatika.php', $currentPage) ?>">Informatika</a></li>
                    <li><a href="pendidikan_teknologi_informasi" class="nav-dropdown-item <?= isActive('pendidikan_teknologi_informasi.php', $currentPage) ?>">Pend. Teknologi Informasi</a></li>
                </ul>
            </li>

            <!-- Fasilitas Dropdown -->
            <li class="nav-item <?= isParentActive(['ruangan.php', 'laboratorium.php'], $currentPage) ?>">
                <a href="#" class="nav-link">
                    Fasilitas
                    <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <ul class="nav-dropdown">
                    <li><a href="ruangan" class="nav-dropdown-item <?= isActive('ruangan.php', $currentPage) ?>">Sarana dan Prasarana</a></li>
                    <li><a href="laboratorium" class="nav-dropdown-item <?= isActive('laboratorium.php', $currentPage) ?>">Laboratorium</a></li>
                </ul>
            </li>

            <!-- Akademik Dropdown -->
            <li class="nav-item <?= isParentActive(['kurikulum.php', 'kalender.php'], $currentPage) ?>">
                <a href="#" class="nav-link">
                    Akademik
                    <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <ul class="nav-dropdown">
                    <li><a href="kurikulum" class="nav-dropdown-item <?= isActive('kurikulum.php', $currentPage) ?>">Kurikulum</a></li>
                    <li><a href="kalender" class="nav-dropdown-item <?= isActive('kalender.php', $currentPage) ?>">Kalender Akademik</a></li>
                </ul>
            </li>

            <!-- Dokumen Dropdown -->
            <li class="nav-item <?= isParentActive(['rencana_operasional.php', 'rencana_strategis.php', 'sop.php'], $currentPage) ?>">
                <a href="#" class="nav-link">
                    Dokumen
                    <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <ul class="nav-dropdown">
                    <li><a href="rencana_operasional" class="nav-dropdown-item <?= isActive('rencana_operasional.php', $currentPage) ?>">Dokumen Fakultas</a></li>
                    <li><a href="rencana_strategis" class="nav-dropdown-item <?= isActive('rencana_strategis.php', $currentPage) ?>">Rencana Strategis</a></li>
                    <li><a href="sop" class="nav-dropdown-item <?= isActive('sop.php', $currentPage) ?>">Standar Operasional Prosedur</a></li>
                </ul>
            </li>

            <!-- Penelitian & Pengabdian Dropdown -->
            <li class="nav-item <?= isParentActive(['penelitian.php', 'pengabdian.php'], $currentPage) ?>">
                <a href="#" class="nav-link">
                    Riset
                    <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <ul class="nav-dropdown">
                    <li><a href="penelitian" class="nav-dropdown-item <?= isActive('penelitian.php', $currentPage) ?>">Penelitian</a></li>
                    <li><a href="pengabdian" class="nav-dropdown-item <?= isActive('pengabdian.php', $currentPage) ?>">Pengabdian</a></li>
                </ul>
            </li>

            <!-- Organisasi Mahasiswa Dropdown -->
            <li class="nav-item <?= isParentActive(['bem.php', 'berita-ukm.php', 'himpunan_mahasiswa.php'], $currentPage) ?>">
                <a href="#" class="nav-link">
                    Kemahasiswaan
                    <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <ul class="nav-dropdown">
                    <li><a href="bem" class="nav-dropdown-item <?= isActive('bem.php', $currentPage) ?>">BEM</a></li>
                    <li><a href="berita-ukm" class="nav-dropdown-item <?= isActive('berita-ukm.php', $currentPage) ?>">UKM</a></li>
                    <li><a href="himpunan_mahasiswa" class="nav-dropdown-item <?= isActive('himpunan_mahasiswa.php', $currentPage) ?>">Himpunan</a></li>
                </ul>
            </li>



            <!-- Galeri (No Dropdown) -->
            <li class="nav-item <?= isActive('galeri_video.php', $currentPage) ?>">
                <a href="galeri_video" class="nav-link">Galeri</a>
            </li>

            <!-- Alumni (No Dropdown) -->
            <li class="nav-item <?= isActive('alumni.php', $currentPage) ?>">
                <a href="alumni" class="nav-link">Alumni</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Mobile Overlay -->
<div class="mobile-overlay" id="mobileOverlay" onclick="toggleMobileMenu()"></div>


