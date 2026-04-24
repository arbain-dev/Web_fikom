<?php
require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Himpunan Mahasiswa FIKOM</h1>
        <p class="page-subtitle">Organisasi kemahasiswaan yang menaungi mahasiswa berdasarkan program studi</p>
    </div>
</header>

<section class="section-content bg-white">
    <div class="container">
        <div class="section-title text-center">
            <p>Himpunan mahasiswa di lingkungan Fakultas Ilmu Komputer</p>
        </div>

        <div class="himpunan-grid">
            <div class="himpunan-card zoom-in delay-1">
                <div class="himpunan-logo">
                    <i class="fas fa-code"></i>
                </div>
                <div class="himpunan-name">
                    <h3>HMTI</h3>
                    <p class="full-name">Himpunan Mahasiswa Informatika</p>
                </div>
                <div class="prodi-badge">Informatika</div>
                <div class="himpunan-desc">
                    Wadah aspirasi dan kreativitas mahasiswa Informatika dalam mengembangkan kompetensi di bidang programming dan teknologi.
                </div>
            </div>

            <div class="himpunan-card zoom-in delay-3">
                <div class="himpunan-logo">
                    <i class="fas fa-network-wired"></i>
                </div>
                <div class="himpunan-name">
                    <h3>HMPTI</h3>
                    <p class="full-name">Himpunan Mahasiswa Pendidikan Teknologi Informasi</p>
                </div>
                <div class="prodi-badge">Pendidikan Teknologi Informasi</div>
                <div class="himpunan-desc">
                    Himpunan mahasiswa yang berfokus pada infrastruktur IT, jaringan komputer, dan keamanan siber.
                </div>
            </div>
        </div>
    </div>
</section>


<?php
include 'includes/footer.php';
?>
