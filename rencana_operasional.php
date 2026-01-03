<?php
require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';

$renop_list = [];
$sql  = "SELECT id, nama_dokumen, deskripsi, file_pdf, tanggal_upload 
         FROM rencana_operasional 
         ORDER BY nama_dokumen ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $renop_list[] = $row;
    }
}
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Rencana Operasional (Renop)</h1>
        <p class="page-subtitle">Dokumen perencanaan operasional Fakultas Ilmu Komputer</p>
    </div>
</header>

<!-- Main Content -->
<section class="section-content">
    <div class="container">
        <div class="document-grid stagger-container">
            <?php if (count($renop_list) > 0): ?>
                <?php foreach ($renop_list as $item): ?>
                    <?php
                        $nama = htmlspecialchars($item['nama_dokumen']);
                        $deskripsi = htmlspecialchars($item['deskripsi']);
                        $file = htmlspecialchars($item['file_pdf']);
                        $path = "uploads/renop/" . $file;
                        $ada_file = (!empty($file) && file_exists($path));
                    ?>
                    <div class="document-card stagger-item">
                        <div class="document-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <div class="document-info">
                            <h3 class="document-title"><?= $nama ?></h3>
                            <p class="text-sm text-muted mb-2"><?= $deskripsi ?></p>
                            <?php if ($ada_file): ?>
                                <a href="<?= $path ?>" class="btn btn-sm btn-outline" download>
                                    <i class="fas fa-download"></i> Download PDF
                                </a>
                            <?php else: ?>
                                <span class="text-xs text-error">File tidak tersedia</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-2 text-center py-12">
                    <div class="text-6xl text-gray-300 mb-4"><i class="fas fa-folder-open"></i></div>
                    <h3 class="text-xl font-bold text-gray-600">Belum ada dokumen</h3>
                    <p class="text-gray-500">Data rencana operasional belum tersedia saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
