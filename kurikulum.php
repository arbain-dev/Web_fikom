<?php
require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';

$sql = "SELECT * FROM kurikulum ORDER BY nama_kurikulum DESC";
$result = mysqli_query($conn, $sql);
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Kurikulum Fakultas</h1>
        <p class="page-subtitle">Daftar kurikulum yang berlaku di lingkungan Fakultas Ilmu Komputer</p>
    </div>
</header>

<!-- Main Content -->
<section class="section-content">
    <div class="container">
        <div class="document-grid stagger-container">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <?php
                        $nama = htmlspecialchars($row['nama_kurikulum']);
                        $desc = htmlspecialchars($row['deskripsi']);
                        $file = htmlspecialchars($row['file_pdf']);
                        $file_path = "uploads/kurikulum/" . $file;
                        $ada_file = (!empty($file) && file_exists($file_path));
                    ?>
                    <div class="document-card stagger-item">
                        <div class="document-icon" style="background: var(--success-50); color: var(--success-600);">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="document-info">
                            <h3 class="document-title">Kurikulum <?= $nama ?></h3>
                            <p class="text-sm text-muted mb-3"><?= $desc ?></p>
                            <?php if ($ada_file): ?>
                                <button onclick="showPdf('Kurikulum <?= $nama ?>', '<?= $file_path ?>')" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> Lihat PDF
                                </button>
                            <?php else: ?>
                                <span class="text-xs text-error">File tidak tersedia</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-span-2 text-center py-12">
                    <div class="text-6xl text-gray-300 mb-4"><i class="fas fa-folder-open"></i></div>
                    <h3 class="text-xl font-bold text-gray-600">Belum ada kurikulum</h3>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'includes/part_pdf_modal.php'; ?>
<?php include 'includes/footer.php'; ?>
