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

<section class="hero-himpunan">
    <div class="container hero-content-himpunan">
        <h1 class="fade-in-up">Himpunan Mahasiswa FIKOM</h1>
        <p class="fade-in-up delay-1">Organisasi kemahasiswaan yang menaungi mahasiswa berdasarkan program studi</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-title fade-in-up">
            <h2>Daftar Himpunan Mahasiswa</h2>
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
                <div class="contact-info-himpunan">
                    <a href="https://instagram.com/hmif_unisan" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/6282215322757" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="mailto:hmif@fikom-unisan.ac.id" target="_blank">
                        <i class="fas fa-envelope"></i>
                    </a>
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
                <div class="contact-info-himpunan">
                    <a href="https://instagram.com/hmti_unisan" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/6281234567892" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="mailto:hmti@fikom-unisan.ac.id" target="_blank">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>
