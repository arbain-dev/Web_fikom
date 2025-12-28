<?php
require_once 'config/database.php';
include 'includes/header.php';

$query = "SELECT * FROM ruangan ORDER BY id DESC";
$result = $conn->query($query);
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Ruangan Kelas & Fasilitas</h1>
        <p class="page-subtitle">Fasilitas pendukung kegiatan belajar mengajar</p>
    </div>
</header>

<!-- Main Content -->
<section class="section-content">
    <div class="container">
        <div class="gallery-grid stagger-container">
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nama = htmlspecialchars($row['nama_ruangan']);
                    $deskripsi = nl2br(htmlspecialchars($row['deskripsi']));
                    $foto_db = $row['foto'];
                    $path_foto = 'uploads/ruangan/' . $foto_db;
                    
                    $foto_tampil = (!empty($foto_db) && file_exists($path_foto)) 
                        ? $path_foto 
                        : 'https://via.placeholder.com/600x400?text=Foto+Ruangan';
                    ?>
                    <div class="card gallery-card stagger-item">
                        <div class="gallery-image-wrapper">
                            <img src="<?= $foto_tampil ?>" alt="<?= $nama ?>" class="gallery-image" onclick="showPopup('<?= $nama ?>', '<?= $foto_tampil ?>')">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><?= $nama ?></h3>
                            <p class="text-sm text-gray-600"><?= $deskripsi ?></p>
                        </div>
                    </div>
                <?php
                }
            } else {
                echo '<div class="empty-state text-center"><p>Belum ada data ruangan.</p></div>';
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
