<?php
require_once 'config/database.php';
require_once 'config/constants.php';
// $conn is created in database.php

include 'includes/header.php';

$visi_teks = "Belum ada data visi.";
$q_visi = $conn->query("SELECT konten FROM visi_misi WHERE kategori = 'Visi' LIMIT 1");
if ($q_visi && $q_visi->num_rows > 0) {
    $visi_teks = $q_visi->fetch_assoc()['konten'];
}

$misi_list = [];
$q_misi = $conn->query("SELECT konten FROM visi_misi WHERE kategori = 'Misi' ORDER BY urutan ASC");
if ($q_misi && $q_misi->num_rows > 0) {
    while ($row = $q_misi->fetch_assoc()) {
        $misi_list[] = $row['konten'];
    }
}
$conn->close();
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Visi & Misi</h1>
        <p class="page-subtitle">Fakultas Ilmu Komputer Universitas Ichsan Sidenreng Rappang</p>
    </div>
</header>

<!-- Main Content -->
<section class="section-content">
    <div class="container">
        <div class="grid gap-8 stagger-container" style="grid-template-columns: 1fr;">
            <!-- Visi Section -->
            <div class="card p-8 h-full stagger-item border-l-4 border-primary-500">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-primary-50 flex items-center justify-center text-primary-600 text-xl">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 m-0">Visi</h2>
                </div>
                <div class="text-lg text-gray-700 italic leading-relaxed">
                    "<?= htmlspecialchars($visi_teks); ?>"
                </div>
            </div>
            
            <!-- Spacer for mobile stacking -->
            <div class="h-12 w-full md:hidden"></div>

            <!-- Misi Section -->
            <div class="card p-8 h-full stagger-item border-l-4 border-success-500 mt-8">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-success-50 flex items-center justify-center text-success-600 text-xl">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 m-0">Misi</h2>
                </div>
                <div class="text-gray-700">
                    <div class="space-y-4">
                        <?php if (count($misi_list) > 0): ?>
                            <?php foreach ($misi_list as $index => $misi): ?>
                                <div class="flex gap-3 leading-relaxed">
                                    <span class="font-bold text-success-600"><?= ($index + 1) ?>.</span>
                                    <span><?= htmlspecialchars($misi); ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-gray-500 italic">Data misi belum diisi.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
