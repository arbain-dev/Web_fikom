<?php
require_once 'config/database.php';
require_once 'config/constants.php';
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

<style>
    /* Specific override for Penelitian Detail Popup to prevent it from being full screen */
    #detailPopup .popup-content {
        max-width: 500px;
        width: 90%;
        height: auto;
        max-height: 90vh;
        overflow-y: auto;
        margin: 0 auto;
        padding: 30px;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .popup-header {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .popup-title {
        font-size: var(--text-xl);
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        line-height: 1.4;
    }

    .popup-list {
        display: flex;
        flex-direction: column;
    }

    .popup-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #e2e8f0;
        font-size: var(--text-sm);
    }

    .popup-row:last-child {
        border-bottom: none;
    }

    .popup-label {
        font-weight: 700;
        color: #475569;
        width: 130px;
        flex-shrink: 0;
    }

    .popup-value {
        color: #334155;
        flex: 1;
        font-weight: 400;
    }

    .popup-btn-container {
        margin-top: 25px;
    }

    .popup-action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        background-color: #4f46e5; /* Primary Blue from reference */
        color: white;
        text-decoration: none;
        padding: 14px;
        border-radius: 8px;
        font-weight: 600;
        font-size: var(--text-base);
        transition: background-color 0.2s;
        box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
    }

    .popup-action-btn:hover {
        background-color: #4338ca;
    }

    .close-popup-icon {
        background: none;
        border: none;
        font-size: var(--text-2xl);
        color: #94a3b8;
        cursor: pointer;
        padding: 0;
        line-height: 1;
        margin-left: 10px;
    }
    
    .close-popup-icon:hover {
        color: #ef4444;
    }
</style>

<!-- Detail Popup -->
<div class="popup" id="detailPopup">
    <div class="popup-content">
        <div class="popup-header">
            <h3 id="popJudul" class="popup-title"></h3>
            <button class="close-popup-icon" onclick="closePopup()">&times;</button>
        </div>
        
        <div class="popup-list">
            <div class="popup-row">
                <div class="popup-label">Peneliti :</div>
                <div class="popup-value" id="popPeneliti"></div>
            </div>
            <div class="popup-row">
                <div class="popup-label">Tahun :</div>
                <div class="popup-value" id="popTahun"></div>
            </div>
            <div class="popup-row">
                <div class="popup-label">Status :</div>
                <div class="popup-value" id="popStatus"></div>
            </div>
            <div class="popup-row">
                <div class="popup-label">Sumber Dana :</div>
                <div class="popup-value" id="popDana"></div>
            </div>
        </div>

        <div class="popup-btn-container" id="linkWrapper">
            <a href="#" id="popLink" target="_blank" class="popup-action-btn">
                <i class="fas fa-external-link-alt" style="margin-right: 8px;"></i> Lihat Publikasi
            </a>
        </div>
    </div>
</div>



<?php include 'includes/footer.php'; ?>
