<?php
require 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';

$sql = "SELECT * FROM pengabdian ORDER BY judul ASC";
$result = mysqli_query($conn, $sql);
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Pengabdian Masyarakat</h1>
        <p class="page-subtitle">Kontribusi nyata civitas akademika untuk masyarakat</p>
    </div>
</header>

<!-- Main Content -->
<section class="section-content">
    <div class="container">
        <div class="custom-doc-grid stagger-container">
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <?php
                        $judul = htmlspecialchars($row['judul']);
                        $pelaksana = htmlspecialchars($row['pelaksana']);
                        $desc = htmlspecialchars($row['deskripsi']);
                        $file_name = $row['file_pdf'] ?? $row['file_doc'] ?? '';
                        $file_path = "uploads/pengabdian_file/" . $file_name;
                        $file_exists = (!empty($file_name) && file_exists($file_path));
                    ?>
                    <div class="custom-doc-card stagger-item">
                        <div class="custom-doc-icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <div class="custom-doc-content">
                            <h3 class="custom-doc-title"><?= $judul ?></h3>
                            <div class="custom-doc-desc">
                                <div style="margin-bottom: 8px;"><strong>Oleh:</strong> <?= $pelaksana ?></div>
                                <div><?= $desc ?></div>
                            </div>
                            <div class="custom-doc-action">
                                <?php if ($file_exists): ?>
                                    <button onclick="showPdf('<?= $judul ?>', '<?= $file_path ?>')" class="custom-doc-btn">LIHAT FILE <i class="fas fa-arrow-right"></i></button>
                                <?php else: ?>
                                    <span class="custom-doc-btn" style="opacity:0.5; cursor:not-allowed;">LIHAT FILE <i class="fas fa-arrow-right"></i></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-span-2 text-center py-12">
                    <h3 class="text-xl text-gray-500">Belum ada data pengabdian.</h3>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- PDF Viewer Popup -->
<!-- PDF Viewer Popup -->
<?php include 'includes/part_pdf_modal.php'; ?>



<?php include 'includes/footer.php'; ?>
