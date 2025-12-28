<?php
require_once 'config/database.php';
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
        <div class="document-grid stagger-container">
            <?php if (count($renstra_list) > 0): ?>
                <?php foreach ($renstra_list as $item): ?>
                    <?php
                        $nama = htmlspecialchars($item['nama_dokumen']);
                        $deskripsi = htmlspecialchars($item['deskripsi']);
                        $file = htmlspecialchars($item['file_pdf']);
                        $path = "uploads/renstra/" . $file;
                        $ada_file = (!empty($file) && file_exists($path));
                    ?>
                    <div class="document-card stagger-item">
                        <div class="document-icon" style="background: var(--success-50); color: var(--success-600);">
                            <i class="fas fa-chess-knight"></i>
                        </div>
                        <div class="document-info">
                            <h3 class="document-title"><?= $nama ?></h3>
                            <p class="text-sm text-gray-600 mb-2"><?= $deskripsi ?></p>
                            <?php if ($ada_file): ?>
                                <a href="<?= $path ?>" class="btn btn-sm btn-outline" download>
                                    <i class="fas fa-download"></i> Download PDF
                                </a>
                            <?php else: ?>
                                <span class="text-xs text-muted">File tidak tersedia</span>
                            <?php endif; ?>
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
