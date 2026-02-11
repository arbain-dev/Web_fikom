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

$tujuan_list = [];
$q_tujuan = $conn->query("SELECT konten FROM visi_misi WHERE kategori = 'Tujuan' ORDER BY urutan ASC");
if ($q_tujuan && $q_tujuan->num_rows > 0) {
    while ($row = $q_tujuan->fetch_assoc()) {
        $tujuan_list[] = $row['konten'];
    }
}

$sasaran_list = [];
$q_sasaran = $conn->query("SELECT konten FROM visi_misi WHERE kategori = 'Sasaran' ORDER BY urutan ASC");
if ($q_sasaran && $q_sasaran->num_rows > 0) {
    while ($row = $q_sasaran->fetch_assoc()) {
        $sasaran_list[] = $row['konten'];
    }
}
$conn->close();
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Visi, Misi, Tujuan & Sasaran</h1>
        <p class="page-subtitle">Fakultas Ilmu Komputer Universitas Ichsan Sidenreng Rappang</p>
    </div>
</header>

<!-- Main Content -->
<section class="section-content">
    <div class="container">
        <div class="grid gap-8 stagger-container" style="grid-template-columns: 1fr;">
            <!-- Visi Section -->
            <div class="card p-8 h-full stagger-item border-l-4 border-primary-500">
                <div class="flex items-center justify-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-primary-50 flex items-center justify-center text-primary-600 text-xl">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h2 class="vm-title">Visi</h2>
                </div>
                <div class="text-lg text-gray-700 italic leading-relaxed text-center">
                    "<?= htmlspecialchars($visi_teks); ?>"
                </div>
            </div>
            
            <!-- Spacer for mobile stacking -->
            <div class="h-12 w-full md:hidden"></div>

            <!-- Misi Section -->
            <div class="card p-8 h-full stagger-item border-l-4 border-success-500 mt-8">
                <div class="flex items-center justify-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-success-50 flex items-center justify-center text-success-600 text-xl">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h2 class="vm-title">Misi</h2>
                </div>
                <div class="text-gray-700">
                    <ul class="misi-list">
                        <?php if (count($misi_list) > 0): ?>
                            <?php foreach ($misi_list as $index => $misi): ?>
                                <li class="misi-item">
                                    <div class="misi-number">
                                        <?= ($index + 1) ?>
                                    </div>
                                    <p class="misi-text">
                                        <?= htmlspecialchars($misi); ?>
                                    </p>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="text-gray-500 italic p-4 text-center bg-gray-50 rounded-lg">Data misi belum diisi.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Tujuan Section -->
            <div class="card p-8 h-full stagger-item border-l-4 border-warning-500 mt-8">
                <div class="flex items-center justify-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-warning-50 flex items-center justify-center text-warning-600 text-xl">
                        <i class="fas fa-flag"></i>
                    </div>
                    <h2 class="vm-title">Tujuan</h2>
                </div>
                <div class="text-gray-700">
                    <ul class="misi-list">
                        <?php if (count($tujuan_list) > 0): ?>
                            <?php foreach ($tujuan_list as $index => $tujuan): ?>
                                <li class="misi-item">
                                    <div class="misi-number" style="background: var(--warning-100); color: var(--warning-700);">
                                        <?= ($index + 1) ?>
                                    </div>
                                    <p class="misi-text">
                                        <?= htmlspecialchars($tujuan); ?>
                                    </p>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="text-gray-500 italic p-4 text-center bg-gray-50 rounded-lg">Data tujuan belum diisi.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Sasaran Strategis Section -->
            <div class="card p-8 h-full stagger-item border-l-4 border-info-500 mt-8">
                <div class="flex items-center justify-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-info-50 flex items-center justify-center text-info-600 text-xl">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                    <h2 class="vm-title">Sasaran Strategis</h2>
                </div>
                <div class="text-gray-700">
                    <ul class="misi-list">
                        <?php if (count($sasaran_list) > 0): ?>
                            <?php foreach ($sasaran_list as $index => $sasaran): ?>
                                <li class="misi-item">
                                    <div class="misi-number" style="background: var(--info-100); color: var(--info-700);">
                                        <?= ($index + 1) ?>
                                    </div>
                                    <p class="misi-text">
                                        <?= htmlspecialchars($sasaran); ?>
                                    </p>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="text-gray-500 italic p-4 text-center bg-gray-50 rounded-lg">Data sasaran belum diisi.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
