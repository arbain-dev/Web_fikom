<?php
require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';

$main_title = "Struktur Organisasi";
$sub_title = "STRUKTUR ORGANISASI FAKULTAS ILMU KOMPUTER";
$deskripsi = "Berikut ini adalah bagan struktur organisasi Fakultas Ilmu Komputer Universitas Ichsan Sidenreng Rappang.";
$struktur_gambar_path = "uploads/profil/default.jpg"; // Fallback

// Ambil data dari database jika ada
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

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title"><?= htmlspecialchars($main_title) ?></h1>
        <p class="page-subtitle">Tata kelola dan struktur kepemimpinan fakultas</p>
    </div>
</header>

<!-- Main Content -->
<section class="section-content">
    <div class="container">
        <div class="card p-6 reveal-on-scroll">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold mb-2"><?= htmlspecialchars($sub_title) ?></h2>
                <p class="text-gray-600"><?= htmlspecialchars($deskripsi) ?></p>
            </div>
            
            <div class="w-full bg-gray-50 rounded-lg p-4 border border-gray-200">
                <img src="<?= htmlspecialchars($struktur_gambar_path) ?>" 
                     alt="Bagan Struktur Organisasi" 
                     class="w-full h-auto object-contain rounded shadow-sm">
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
