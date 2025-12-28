<?php
require_once 'config/database.php';
include 'includes/header.php';

$query = "SELECT * FROM laboratorium ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Laboratorium Komputer</h1>
        <p class="page-subtitle">Sarana praktikum dan riset teknologi informasi</p>
    </div>
</header>

<!-- Main Content -->
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
<div class="popup" id="imagePopup">
    <div class="popup-content gallery-popup-content">
        <div class="relative">
            <button class="close-btn" onclick="closePopup()">
                <i class="fas fa-times"></i>
            </button>
            <img id="popupImg" src="" alt="" class="gallery-popup-image">
        </div>
        <div class="gallery-popup-caption">
            <h3 id="popupCaption"></h3>
        </div>
    </div>
</div>



<?php include 'includes/footer.php'; ?>
