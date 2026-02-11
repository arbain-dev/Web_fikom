<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';

$query = "SELECT * FROM ruangan ORDER BY id DESC";
$result = $conn->query($query);
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container">
        <h1 class="page-title">Ruangan Kelas & Fasilitas</h1>
        <p class="page-subtitle">Fasilitas pendukung kegiatan belajar mengajar</p>
    </div>
</header>

<!-- Main Content -->
<section class="section-content">
    <div class="container">
        <div class="gallery-grid">
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
                    <div class="card gallery-card">
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
