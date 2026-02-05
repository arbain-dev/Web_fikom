<?php
$bodyClass = "bem-struktur-page";
require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';
?>

<main class="bem-page-wrapper">
    <div class="color-bg">
        <div class="color"></div>
        <div class="color"></div>
        <div class="color"></div>
    </div>

<section class="hero">
    <div class="container hero-content">
        <h1 class="fade-in-up">Himpunan Mahasiswa FIKOM</h1>
        <p class="fade-in-up delay-1">Organisasi kemahasiswaan yang menaungi mahasiswa berdasarkan program studi</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-title fade-in-up" style="color: #fff;">
            <p style="color: rgba(255,255,255,0.8);">Himpunan mahasiswa di lingkungan Fakultas Ilmu Komputer</p>
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

</main>

<?php
include 'includes/footer.php';
?>
