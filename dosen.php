<?php
require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';

// Fetch Data
$pimpinan = [];
$dosen = [];

$sql = "SELECT * FROM dosen ORDER BY nama ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $jabatan = strtolower(trim($row['jabatan']));
        // Improved detection for leaders
        if (strpos($jabatan, 'dekan') !== false || strpos($jabatan, 'ketua') !== false || strpos($jabatan, 'kaprodi') !== false) {
            $pimpinan[] = $row;
        } else {
            $dosen[] = $row;
        }
    }
}
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Dosen & Staff Pengajar</h1>
        <p class="page-subtitle">Tenaga pengajar profesional dan berpengalaman</p>
    </div>
</header>

<!-- Pimpinan Section -->
<section class="section-content bg-white">
    <div class="container">
        <h2 class="section-title text-center">Pimpinan Fakultas</h2>
        <div class="dosen-grid pimpinan-grid stagger-container">
            <?php foreach ($pimpinan as $d): ?>
                <?php include 'includes/part_dosen_card.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Dosen Section -->
<section class="section-content bg-gray-50">
    <div class="container">
        <h2 class="section-title text-center">Dosen Tetap Program Studi</h2>
        <div class="dosen-grid stagger-container">
            <?php foreach ($dosen as $d): ?>
                <?php include 'includes/part_dosen_card.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- Popup Detail Dosen -->
<div class="popup" id="dosenPopup">
    <div class="popup-content dosen-popup-content">

        <div class="dosen-popup-layout">
            <div class="dosen-popup-image">
                <img id="popFoto" src="" alt="Foto Dosen">
            </div>
            <div class="dosen-popup-info relative">
                <button class="close-btn-custom" onclick="closePopup()">
                    <i class="fas fa-times"></i>
                </button>
                <h3 id="popNama"></h3>
                <div class="dosen-popup-details">
                    <p><strong>Jabatan</strong> <span id="popJabatan"></span></p>
                    <p><strong>NIDN</strong> <span id="popNidn"></span></p>
                    <p><strong>Program Studi</strong> <span id="popProdi"></span></p>
                    <p><strong>Keahlian</strong> <span id="popKeahlian"></span></p>
                    <p><strong>Pendidikan</strong> <span id="popPendidikan"></span></p>
                    <p><strong>Status</strong> <span id="popStatus"></span></p>
                </div>
                <div class="dosen-popup-action">
                    <a id="popEmail" href="" class="btn btn-primary w-full">
                        <i class="fas fa-envelope"></i> Kirim Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'includes/footer.php'; ?>
