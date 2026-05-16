<?php
require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';

$renstra_list = [];
$sql  = "SELECT id, nama_dokumen, deskripsi, file_pdf, tanggal_upload 
         FROM rencana_strategis 
         ORDER BY nama_dokumen ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $renstra_list[] = $row;
    }
}
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Rencana Strategis (Renstra)</h1>
        <p class="page-subtitle">Dokumen perencanaan strategis jangka panjang</p>
    </div>
</header>

<!-- Main Content -->
<section class="section-content">
    <div class="container">
        <div class="custom-doc-grid stagger-container">
            <?php if (count($renstra_list) > 0): ?>
                <?php foreach ($renstra_list as $item): ?>
                    <?php
                        $nama = htmlspecialchars($item['nama_dokumen']);
                        $deskripsi = htmlspecialchars($item['deskripsi']);
                        $file = htmlspecialchars($item['file_pdf']);
                        $path = "uploads/renstra/" . $file;
                        $ada_file = (!empty($file) && file_exists($path));
                    ?>
                    <div class="custom-doc-card stagger-item">
                        <div class="custom-doc-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <div class="custom-doc-content">
                            <h3 class="custom-doc-title"><?= $nama ?></h3>
                            <div class="custom-doc-desc">
                                <?= $deskripsi ?>
                            </div>
                            <div class="custom-doc-action">
                                <?php if ($ada_file): ?>
                                    <a href="<?= $path ?>" class="custom-doc-btn" download>DOWNLOAD PDF <i class="fas fa-arrow-right"></i></a>
                                <?php else: ?>
                                    <span class="custom-doc-btn" style="opacity:0.5; cursor:not-allowed;">DOWNLOAD PDF <i class="fas fa-arrow-right"></i></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-12">
                    <div class="text-6xl text-gray-300 mb-4"><i class="fas fa-folder-open"></i></div>
                    <h3 class="text-xl font-bold text-gray-600">Belum ada dokumen</h3>
                    <p class="text-gray-500">Data rencana strategis belum tersedia saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
