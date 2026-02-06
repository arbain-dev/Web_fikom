<?php
require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';

$query = "SELECT * FROM laboratorium ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!-- Header Halaman -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Laboratorium Komputer</h1>
        <p class="page-subtitle">Sarana praktikum dan riset teknologi informasi</p>
    </div>
</header>

<!-- Konten Utama -->
<section class="section-content">
    <div class="container">
        <div class="gallery-grid stagger-container">
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $nama_lab = htmlspecialchars($row['nama_lab']);
                    $deskripsi = nl2br(htmlspecialchars($row['deskripsi']));
                    $foto_file = $row['foto'] ?? '';
                    $foto_path = 'uploads/labolatorium/' . $foto_file;
                    
                    $foto_tampil = (!empty($foto_file) && file_exists($foto_path))
                        ? $foto_path
                        : 'https://via.placeholder.com/600x400?text=Foto+Lab';
                    ?>
                    <div class="card gallery-card stagger-item">
                        <div class="gallery-image-wrapper">
                            <img src="<?= $foto_tampil ?>" alt="<?= $nama_lab ?>" class="gallery-image" onclick="showPopup('<?= $nama_lab ?>', '<?= $foto_tampil ?>')">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?= $nama_lab ?></h3>
                            <p class="text-sm text-gray-600"><?= $deskripsi ?></p>
                        </div>
                    </div>
                <?php
                }
            } else {
                echo '<div class="empty-state text-center"><p>Belum ada data laboratorium.</p></div>';
            }
            ?>
        </div>
    </div>
</section>

<!-- Lightbox / Popup -->
<!-- Lightbox / Popup -->
<div class="popup" id="imagePopup">
    <div class="popup-content gallery-popup-content" style="padding: 15px; background: #fff; border-radius: 12px; box-shadow: 0 25px 50px rgba(0,0,0,0.5); max-width: 900px; width: auto; position: relative;">
        <div class="relative" style="position: relative; display: inline-block;">
            <button onclick="closePopup()" style="position: absolute; top: 15px; right: 15px; background: #ef4444; color: #fff; border: none; padding: 6px 16px; border-radius: 6px; font-weight: 600; cursor: pointer; z-index: 50; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                Tutup
            </button>
            <img id="popupImg" src="" alt="" style="display: block; max-height: 80vh; max-width: 100%; border-radius: 4px;">
        </div>
    </div>
</div>



<?php include 'includes/footer.php'; ?>
