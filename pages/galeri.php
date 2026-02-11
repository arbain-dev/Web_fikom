<?php
/**
 * Halaman Galeri
 * Menampilkan dokumentasi kegiatan fakultas
 */

require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';

// Pagination Setup
$limit = 12; // Foto per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Count Total
$count_query = "SELECT COUNT(*) as total FROM galeri";
$count_result = $conn->query($count_query);
$total_row = $count_result->fetch_assoc();
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $limit);

// Fetch Data
$query = "SELECT * FROM galeri ORDER BY id DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($query);
?>

<!-- Headers -->
<header class="page-header-section">
    <div class="container">
        <h1 class="page-title">Galeri Kegiatan</h1>
        <p class="page-subtitle">Dokumentasi aktivitas dan momen penting Fakultas Ilmu Komputer</p>
    </div>
</header>

<!-- Main Gallery Content -->
<section class="section-content">
    <div class="container">
        
        <?php if ($result && $result->num_rows > 0): ?>
            <div class="gallery-grid">
                <?php while ($row = $result->fetch_assoc()): 
                    $img_path = 'uploads/galeri/' . $row['gambar'];
                    $img_src = file_exists($img_path) ? $img_path : 'https://via.placeholder.com/400x300?text=No+Image';
                ?>
                <div class="card gallery-card">
                    <div class="gallery-image-wrapper">
                        <!-- Lazy Load added -->
                        <img src="<?= $img_src ?>" 
                             alt="<?= htmlspecialchars($row['judul']) ?>" 
                             class="gallery-image" 
                             loading="lazy"
                             onclick="showPopup('<?= htmlspecialchars($row['judul']) ?>', '<?= $img_src ?>')">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title" style="font-size: 1rem; margin-bottom: 0.5rem;"><?= htmlspecialchars($row['judul']) ?></h3>
                        <?php if(!empty($row['deskripsi'])): ?>
                            <p class="text-sm text-gray-600"><?= htmlspecialchars($row['deskripsi']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
            <div class="pagination-container" style="margin-top: 3rem; display: flex; justify-content: center; gap: 10px;">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>" class="btn btn-outline btn-sm">&laquo; Sebelumnya</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?= $i ?>" class="btn btn-sm <?= ($i == $page) ? 'btn-primary' : 'btn-outline' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?= $page + 1 ?>" class="btn btn-outline btn-sm">Berikutnya &raquo;</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="empty-state text-center py-12">
                <div style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"><i class="fas fa-images"></i></div>
                <h3>Belum ada foto di galeri</h3>
                <p>Dokumentasi kegiatan akan segera diupdate.</p>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- Lightbox Popup (Reusing existing structure from main.js) -->
<div class="popup" id="imagePopup">
    <div class="popup-content gallery-popup-content" style="padding: 0; background: transparent; box-shadow: none; max-width: 90vw;">
        <div style="position: relative;">
            <button onclick="closePopup()" style="position: absolute; top: -40px; right: 0; background: rgba(0,0,0,0.5); color: #fff; border: none; padding: 8px 15px; border-radius: 50px; cursor: pointer; font-weight: bold;">
                <i class="fas fa-times"></i> Tutup
            </button>
            <img id="popupImg" src="" alt="" style="max-height: 85vh; max-width: 100%; border-radius: 8px; box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
            <div id="popupCaption" style="background: rgba(0,0,0,0.8); color: #fff; padding: 10px 20px; text-align: center; border-radius: 0 0 8px 8px; margin-top: -5px;"></div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
