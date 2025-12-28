<?php
require_once 'config/database.php';
include 'includes/header.php';

$penelitian_list = [];
$sql = "SELECT * FROM penelitian ORDER BY tahun DESC, judul ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $penelitian_list[] = $row; 
    }
}
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Penelitian Dosen</h1>
        <p class="page-subtitle">Hasil riset dan publikasi ilmiah dosen</p>
    </div>
</header>

<!-- Main Content -->
<section class="section-content">
    <div class="container">
        <div class="document-grid stagger-container">
            <?php if (count($penelitian_list) > 0): ?>
                <?php foreach ($penelitian_list as $p): ?>
                    <?php
                        $judul = htmlspecialchars($p['judul']);
                        $peneliti = htmlspecialchars($p['peneliti']);
                        $tahun = htmlspecialchars($p['tahun']);
                        $link = $p['link_publikasi'];
                        $json = htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8');
                    ?>
                    <div class="document-card stagger-item cursor-pointer hover:bg-gray-50 from-card-action" onclick="showDetail(<?= $json ?>)">
                        <div class="document-icon" style="background: var(--info-50); color: var(--info-600);">
                            <i class="fas fa-microscope"></i>
                        </div>
                        <div class="document-info">
                            <h3 class="document-title"><?= $judul ?></h3>
                            <p class="text-xs font-bold text-primary-700 mb-1">Peneliti: <?= $peneliti ?></p>
                            <p class="text-sm text-gray-500">Tahun: <?= $tahun ?></p>
                        </div>
                        <div class="text-gray-400">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-2 text-center py-12">
                     <h3 class="text-xl text-gray-500">Belum ada data penelitian.</h3>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Detail Popup -->
<div class="popup" id="detailPopup">
    <div class="popup-content">
        <button class="close-btn" onclick="closePopup()">×</button>
        <h3 id="popJudul" class="text-xl font-bold mb-4 text-primary-800"></h3>
        
        <div class="space-y-3 text-sm">
            <div>
                <strong class="block text-gray-500">Peneliti</strong>
                <span id="popPeneliti" class="text-gray-800"></span>
            </div>
            <div>
                <strong class="block text-gray-500">Tahun</strong>
                <span id="popTahun" class="text-gray-800"></span>
            </div>
            <div>
                <strong class="block text-gray-500">Status</strong>
                <span id="popStatus" class="tag-badge"></span>
            </div>
            <div>
                <strong class="block text-gray-500">Sumber Dana</strong>
                <span id="popDana" class="text-gray-800"></span>
            </div>
        </div>

        <div class="mt-6 pt-4 border-t" id="linkWrapper">
            <a href="#" id="popLink" target="_blank" class="btn btn-primary w-full justify-center">
                <i class="fas fa-external-link-alt"></i> Lihat Publikasi
            </a>
        </div>
    </div>
</div>



<?php include 'includes/footer.php'; ?>
