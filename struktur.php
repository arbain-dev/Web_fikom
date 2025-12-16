<?php
include 'includes/header.php';
require 'database/db_connect.php';

$main_title = "Struktur Organisasi";
$sub_title = "STRUKTUR ORGANISASI FAKULTAS ILMU KOMPUTER";
$deskripsi = "Berikut ini adalah bagan struktur organisasi...";
$gambar_default = "uploads/profil/";
$struktur_gambar_path = $gambar_default;

$sql = "SELECT * FROM halaman_statis WHERE nama_halaman = 'struktur_organisasi'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();
    
    $nama_file_db = $data['gambar_path'] ?? '';
    $path_lengkap = 'uploads/profil/' . $nama_file_db;
    
    if (!empty($nama_file_db) && file_exists($path_lengkap)) {
        $struktur_gambar_path = $path_lengkap;
    }
}
$conn->close(); 
?>

<script>
    document.body.classList.add('page-dosen');
</script>

<div class="color-blob"></div>
<div class="color-blob"></div>
<div class="color-blob"></div>

<section class="ruangan-section"> <h1><?= htmlspecialchars($main_title) ?></h1>
    <div class="struktur-container">
        <div class="struktur-card">
             <h2><?= htmlspecialchars($sub_title) ?></h2>
             <p><?= htmlspecialchars($deskripsi) ?></p>
             
             <img src="<?= htmlspecialchars($struktur_gambar_path) ?>" alt="Bagan Struktur Organisasi" class="struktur-chart">
        </div>
    </div>

</section>

<?php
include 'includes/footer.php';
?>