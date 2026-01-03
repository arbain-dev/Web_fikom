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
        <div class="document-grid stagger-container">
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
                    <div class="document-card stagger-item">
                        <div class="document-icon" style="background: var(--warning-50); color: var(--warning-600);">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <div class="document-info">
                            <h3 class="document-title"><?= $judul ?></h3>
                            <p class="text-xs font-bold text-primary-700 mb-1">Oleh: <?= $pelaksana ?></p>
                            <p class="text-sm text-gray-600 mb-3"><?= $desc ?></p>
                            <?php if ($file_exists): ?>
                                <button onclick="showPdf('<?= $judul ?>', '<?= $file_path ?>')" class="btn btn-sm btn-outline">
                                    <i class="fas fa-eye"></i> Lihat Laporan
                                </button>
                            <?php else: ?>
                                <span class="text-xs text-muted">Laporan belum tersedia</span>
                            <?php endif; ?>
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
