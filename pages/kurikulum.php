<?php
require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';

$sql = "SELECT * FROM kurikulum ORDER BY nama_kurikulum DESC";
$result = mysqli_query($conn, $sql);
?>

<!-- Header Halaman -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Kurikulum Fakultas</h1>
        <p class="page-subtitle">Daftar kurikulum yang berlaku di lingkungan Fakultas Ilmu Komputer</p>
    </div>
</header>

<!-- Konten Utama -->
<section class="section-content">
    <div class="container">
        <div class="custom-doc-grid stagger-container">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <?php
                        $nama = htmlspecialchars($row['nama_kurikulum']);
                        $desc = htmlspecialchars($row['deskripsi']);
                        $file = htmlspecialchars($row['file_pdf']);
                        $file_path = "uploads/kurikulum/" . $file;
                        $ada_file = (!empty($file) && file_exists($file_path));
                    ?>
                    <div class="custom-doc-card stagger-item">
                        <div class="custom-doc-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="custom-doc-content">
                            <h3 class="custom-doc-title">Kurikulum <?= $nama ?></h3>
                            <div class="custom-doc-desc">
                                <?= $desc ?>
                            </div>
                            <div class="custom-doc-action">
                                <?php if ($ada_file): ?>
                                    <button onclick="showPdf('Kurikulum <?= $nama ?>', '<?= $file_path ?>')" class="custom-doc-btn">LIHAT PDF <i class="fas fa-arrow-right"></i></button>
                                <?php else: ?>
                                    <span class="custom-doc-btn" style="opacity:0.5; cursor:not-allowed;">LIHAT PDF <i class="fas fa-arrow-right"></i></span>
                                <?php endif; ?>
                            </div>
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
