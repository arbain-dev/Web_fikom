<?php

$host = "localhost"; $user = "root"; $pass = ""; $db = "db_web_fikom";
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) { die("Koneksi gagal: " . mysqli_connect_error()); }

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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi&Misi-Fikom-UNISAN</title>
</head>
<body>

<div class="color-bg"><div class="color"></div><div class="color"></div><div class="color"></div></div>

<main class="container">
    <div class="page-title">
        <h1>Visi & Misi</h1>
        <p>Fakultas Ilmu Komputer Universitas Ichsan Sidenreng Rappang</p>
    </div>

    <div class="glass-card">
        <div class="vm-section">
            <div class="vm-header">
                <span class="vm-icon"><i class="fas fa-eye"></i></span>
                <h3>Visi</h3>
            </div>
            <div class="vm-content">
                <p>"<?= htmlspecialchars($visi_teks); ?>"</p>
            </div>
        </div>

        <div class="vm-section">
            <div class="vm-header">
                <span class="vm-icon"><i class="fas fa-bullseye"></i></span>
                <h3>Misi</h3>
            </div>
            <div class="vm-content">
                <ol>
                    <?php if (count($misi_list) > 0): ?>
                        <?php foreach ($misi_list as $misi): ?>
                            <li><?= htmlspecialchars($misi); ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>Data misi belum diisi.</li>
                    <?php endif; ?>
                </ol>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>