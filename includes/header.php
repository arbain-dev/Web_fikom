<?php
// File: includes/header.php
$currentPage = basename($_SERVER['PHP_SELF']);

// Helper function untuk cek active state
function isActive($pageName, $currentPage) {
    if ($pageName == $currentPage) return 'active';
    return '';
}

function isParentActive($pages, $currentPage) {
    if (in_array($currentPage, $pages)) return 'active open'; // Tambah class 'open' agar menu terbuka otomatis
    return '';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/frontend.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
    :root {
        --navbar-height: 80px;
        --brand-blue: #0056b3;
        --brand-blue-dark: #003d80;
        --active-bg: #e3f2fd;
        --text-dark: #333;
        --text-light: #fff;
        --border-color: #eee;
    }

    body {
        padding-top: var(--navbar-height);
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }

    .navbar {
        background-color: #fff;
        height: var(--navbar-height);
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        display: flex;
        justify-content: center;
    }

    .nav-container {
        width: 100%;
        max-width: 1200px;
        height: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
    }

    .nav-logo img {
        height: 45px;
        transition: transform 0.3s;
    }
    .nav-logo:hover img {
        transform: scale(1.05);
    }
    ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .nav-menu {
        display: flex;
        height: 100%;
        margin: 0;
        padding: 0;
        gap: 5px;
        align-items: center; 
    }
    .nav-item {
        position: relative;
        height: 100%;
        display: flex;
        align-items: center;
    }
    .nav-link {
        display: flex;
        align-items: center;   
        flex-direction: row;    
        flex-wrap: nowrap;       
        gap: 8px;                
        height: 100%;
        padding: 0 15px;
        text-decoration: none;
        color: var(--text-dark);
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        white-space: nowrap;    
    }
    .nav-link:hover, 
    .nav-item.active > .nav-link {
        color: var(--brand-blue);
    }
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 3px;
        background-color: var(--brand-blue);
        transition: width 0.3s ease;
        border-radius: 2px;
    }
    .dropdown-toggle::after {
        display: none; 
    }

    .dropdown-toggle::before { 
        display: none; 
    }
    .has-dropdown > .nav-link::after {
        display: none; 
    }
    .dropdown-toggle::after {
        content: '\f107'; 
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 0.8rem;
        transition: transform 0.3s;
        display: block; 
        margin-left: 0; 
        position: static; 
        width: auto;      
        height: auto;     
        background: none; 
    }
    .nav-item:hover .dropdown-toggle::after {
        transform: rotate(180deg);
    }
    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        min-width: 240px;
        background-color: #fff;
        border-top: 3px solid var(--brand-blue);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-radius: 0 0 8px 8px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.3s ease;
        list-style: none;
        padding: 10px 0;
        margin: 0;
        z-index: 1001;
    }
    .nav-item:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .dropdown-menu a {
        display: block;
        padding: 10px 20px;
        color: var(--text-dark);
        text-decoration: none;
        font-size: 0.9rem;
        transition: 0.2s;
    }
    .dropdown-menu a:hover {
        background-color: #f8f9fa;
        color: var(--brand-blue);
        padding-left: 25px;
    }
    .dropdown-menu a.active {
        background-color: var(--active-bg);
        color: var(--brand-blue);
        font-weight: 600;
    }
    .hamburger {
        display: none;
        font-size: 24px;
        cursor: pointer;
        color: var(--text-dark);
        padding: 5px;
    }
    .mobile-overlay {
        display: none;
        position: fixed;
        top: var(--navbar-height);
        left: 0;
        width: 100%;
        height: calc(100vh - var(--navbar-height));
        background: rgba(0,0,0,0.5);
        z-index: 998;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .mobile-overlay.show {
        display: block;
        opacity: 1;
    }
    @media (max-width: 992px) {
        .hamburger { display: block; }
        .nav-menu {
            position: fixed;
            top: var(--navbar-height);
            right: -100%;
            width: 300px;
            height: calc(100vh - var(--navbar-height));
            background: #fff;
            flex-direction: column;
            box-shadow: -5px 0 15px rgba(0,0,0,0.1);
            transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            z-index: 999;
            display: block;
            padding: 0;
        }
        .nav-menu.show { 
            right: 0; }
        .nav-item {
            display: flex;
            flex-direction: column;
            height: auto;
            width: 100%;
            border-bottom: 1px solid var(--border-color);
        }
        .nav-link {
            width: 100%;
            padding: 15px 20px;
            font-weight: 600;
            box-sizing: border-box;
            justify-content: space-between; 
        }
        .dropdown-menu {
            position: static;
            width: 100%;
            box-shadow: none;
            border-top: none;
            border-radius: 0;
            background-color: #f9f9f9;
            max-height: 0;
            overflow: hidden;
            opacity: 1;
            visibility: visible;
            transform: none;
            transition: max-height 0.4s ease-out;
            padding: 0;
        }
        .nav-item.open .dropdown-menu {
            max-height: 500px;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }
        .nav-item.open .dropdown-toggle::after {
            transform: rotate(180deg);
        }
        .dropdown-menu a {
            padding: 12px 20px 12px 40px;
            font-size: 0.9rem;
            font-weight: 400;
            color: #555;
        }
        .dropdown-menu a::before {
            content: '•';
            margin-right: 8px;
            color: var(--brand-blue);
        }
        .nav-item.active > .nav-link {
            color: var(--brand-blue);
            background-color: #f0f7ff;
        }
        
        .nav-item.active.open .dropdown-menu {
            max-height: 600px;
        }
    }
</style>
</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <a href="index.php" class="nav-logo">
            <img src="img/pp.png" alt="Logo FIKOM">
        </a>

        <div class="hamburger" onclick="toggleMobileMenu()">
            <i class="fas fa-bars"></i>
        </div>

        <ul class="nav-menu" id="navMenu">
            
            <li class="nav-item has-dropdown <?php echo isParentActive(['visi-misi.php', 'dosen.php', 'struktur.php'], $currentPage); ?>">
                <a href="#" class="nav-link dropdown-toggle">Profil</a>
                <ul class="dropdown-menu">
                    <li><a href="visi-misi.php" class="<?php echo isActive('visi-misi.php', $currentPage); ?>">Visi Misi</a></li>
                    <li><a href="dosen.php" class="<?php echo isActive('dosen.php', $currentPage); ?>">Dosen</a></li>
                    <li><a href="struktur.php" class="<?php echo isActive('struktur.php', $currentPage); ?>">Struktur Organisasi</a></li>
                </ul>
            </li>

            <li class="nav-item has-dropdown <?php echo isParentActive(['index_ti.php', 'index_pti.php'], $currentPage); ?>">
                <a href="#" class="nav-link dropdown-toggle">Program Studi</a>
                <ul class="dropdown-menu">
                    <li><a href="index_ti.php" class="<?php echo isActive('index_ti.php', $currentPage); ?>">Informatika</a></li>
                    <li><a href="index_pti.php" class="<?php echo isActive('index_pti.php', $currentPage); ?>">Pend. Teknologi Informasi</a></li>
                </ul>
            </li>

            <li class="nav-item has-dropdown <?php echo isParentActive(['ruangan.php','laboratorium.php'], $currentPage); ?>">
                <a href="#" class="nav-link dropdown-toggle">Fasilitas</a>
                <ul class="dropdown-menu">
                    <li><a href="ruangan.php" class="<?php echo isActive('ruangan.php', $currentPage); ?>">Ruangan</a></li>
                    <li><a href="laboratorium.php" class="<?php echo isActive('laboratorium.php', $currentPage); ?>">Laboratorium</a></li>
                </ul>
            </li>

            <li class="nav-item has-dropdown <?php echo isParentActive(['kurikulum.php','kalender.php'], $currentPage); ?>">
                <a href="#" class="nav-link dropdown-toggle">Akademik</a>
                <ul class="dropdown-menu">
                    <li><a href="kurikulum.php" class="<?php echo isActive('kurikulum.php', $currentPage); ?>">Kurikulum</a></li>
                    <li><a href="kalender.php" class="<?php echo isActive('kalender.php', $currentPage); ?>">Kalender Akademik</a></li>
                </ul>
            </li>

            <li class="nav-item has-dropdown <?php echo isParentActive(['rencana_operasional.php','sop.php','rencana_strategis.php'], $currentPage); ?>">
                <a href="#" class="nav-link dropdown-toggle">Dokumen</a>
                <ul class="dropdown-menu">
                    <li><a href="rencana_operasional.php" class="<?php echo isActive('rencana_operasional.php', $currentPage); ?>">Rencana Operasional</a></li>
                    <li><a href="rencana_strategis.php" class="<?php echo isActive('rencana_strategis.php', $currentPage); ?>">Rencana Strategis</a></li>
                    <li><a href="sop.php" class="<?php echo isActive('sop.php', $currentPage); ?>">Standar Operasional Prosedur</a></li>
                </ul>
            </li>

             <li class="nav-item has-dropdown <?php echo isParentActive(['penelitian.php','pengabdian.php'], $currentPage); ?>">
                <a href="#" class="nav-link dropdown-toggle">Penelitian & Pengabdian</a>
                <ul class="dropdown-menu">
                    <li><a href="penelitian.php" class="<?php echo isActive('penelitian.php', $currentPage); ?>">Penelitian</a></li>
                    <li><a href="pengabdian.php" class="<?php echo isActive('pengabdian.php', $currentPage); ?>">Pengabdian</a></li>
                </ul>
            </li>

             <li class="nav-item has-dropdown <?php echo isParentActive(['bem.php','berita-ukm.php','himpunan_mahasiswa.php'], $currentPage); ?>">
                <a href="#" class="nav-link dropdown-toggle">Organisasi Mahasiswa</a>
                <ul class="dropdown-menu">
                    <li><a href="bem.php" class="<?php echo isActive('bem.php', $currentPage); ?>">BEM</a></li>
                    <li><a href="berita-ukm.php" class="<?php echo isActive('berita-ukm.php', $currentPage); ?>">UKM</a></li>
                    <li><a href="himpunan_mahasiswa.php" class="<?php echo isActive('himpunan_mahasiswa.php', $currentPage); ?>">Himpunan Mahasiswa</a></li>
                </ul>
            </li>

            <li class="nav-item <?php echo isActive('alumni.php', $currentPage); ?>">
                <a href="alumni.php" class="nav-link">Alumni</a>
            </li>

        </ul>
    </div>
</nav>

<div class="mobile-overlay" id="mobileOverlay" onclick="toggleMobileMenu()"></div>

<script>
    function toggleMobileMenu() {
        const navMenu = document.getElementById('navMenu');
        const overlay = document.getElementById('mobileOverlay');
        const icon = document.querySelector('.hamburger i');
        
        navMenu.classList.toggle('show');
        overlay.classList.toggle('show');
        if(navMenu.classList.contains('show')){
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    }
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownToggles = document.querySelectorAll('.has-dropdown > .dropdown-toggle');

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                if(window.innerWidth <= 992) {
                    e.preventDefault(); 
                    const parentItem = this.parentElement;
                    document.querySelectorAll('.nav-item.has-dropdown').forEach(item => {
                        if(item !== parentItem) {
                            item.classList.remove('open');
                        }
                    });
                    parentItem.classList.toggle('open');
                }
            });
        });
        window.addEventListener('resize', function() {
            if(window.innerWidth > 992) {
                document.getElementById('navMenu').classList.remove('show');
                document.getElementById('mobileOverlay').classList.remove('show');
                document.querySelectorAll('.nav-item').forEach(item => item.classList.remove('open'));
                document.querySelector('.hamburger i').classList.remove('fa-times');
                document.querySelector('.hamburger i').classList.add('fa-bars');
            }
        });
    });
</script>

</body>
</html>