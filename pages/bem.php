<?php
$bodyClass = "bem-struktur-page";

require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';

$inti = [];
$sekben = [];
$departemen = [];

$sql = "SELECT * FROM bem_struktur ORDER BY urutan ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['kategori'] === 'inti') {
            $inti[] = $row;
        } elseif ($row['kategori'] === 'sekben') {
            $sekben[] = $row;
        } elseif ($row['kategori'] === 'departemen') {
            $departemen[] = $row;
        }
    }
}

function getInitials($string = '') {
    return array_reduce(
        explode(' ', $string),
        fn($initials, $word) => $initials . strtoupper(substr($word, 0, 1)),
        ''
    );
}
?>
<!-- Background Blur is handled by CSS on page-wrapper or body if global -->
<main class="bem-page-wrapper">
    <!-- Background Elements -->
    <div class="color-bg">
        <div class="color"></div>
        <div class="color"></div>
        <div class="color"></div>
    </div>

<!-- HERO -->
<section class="hero">
    <div class="container hero-content">
        <h1 class="fade-in-up">Struktur Organisasi BEM FIKOM</h1>
        <p class="fade-in-up delay-1">
            Kepengurusan Badan Eksekutif Mahasiswa Periode 2024/2025
        </p>
    </div>
</section>

<!-- CONTENT -->
<section class="section">
    <div class="container">
        <div class="struktur-container">

            <!-- ================= PIMPINAN INTI ================= -->
            <div class="level-section fade-in">
                <div class="section-label">PIMPINAN INTI</div>
                <div class="pimpinan-section">
                    <?php if (!empty($inti)): ?>
                        <?php foreach ($inti as $i => $item): ?>
                            <div class="person-card fade-in-up delay-<?= $i + 1 ?>">
                                <div class="person-photo">
                                    <?php if (!empty($item['foto']) && file_exists("uploads/bem/".$item['foto'])): ?>
                                        <img src="uploads/bem/<?= htmlspecialchars($item['foto']) ?>" alt="Foto">
                                    <?php else: ?>
                                        <?= substr(getInitials($item['nama']), 0, 2) ?>
                                    <?php endif; ?>
                                </div>
                                <div class="person-name"><?= htmlspecialchars($item['nama']) ?></div>
                                <div class="person-position"><?= htmlspecialchars($item['jabatan']) ?></div>
                                <div class="person-prodi"><?= htmlspecialchars($item['prodi']) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="empty-text">Belum ada data Pimpinan Inti.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="connector fade-in"></div>

            <!-- ================= SEKRETARIS & BENDAHARA ================= -->
            <div class="level-section fade-in">
                <div class="section-label">SEKRETARIS & BENDAHARA</div>
                <div class="pimpinan-section">
                    <?php if (!empty($sekben)): ?>
                        <?php foreach ($sekben as $i => $item): ?>
                            <div class="person-card fade-in-up delay-<?= $i + 1 ?>">
                                <div class="person-photo">
                                    <?php if (!empty($item['foto']) && file_exists("uploads/bem/".$item['foto'])): ?>
                                        <img src="uploads/bem/<?= htmlspecialchars($item['foto']) ?>" alt="Foto">
                                    <?php else: ?>
                                        <?= substr(getInitials($item['nama']), 0, 2) ?>
                                    <?php endif; ?>
                                </div>
                                <div class="person-name"><?= htmlspecialchars($item['nama']) ?></div>
                                <div class="person-position"><?= htmlspecialchars($item['jabatan']) ?></div>
                                <div class="person-prodi"><?= htmlspecialchars($item['prodi']) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="empty-text">Belum ada data Sekretaris & Bendahara.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="connector-horizontal fade-in"></div>

            <!-- ================= DEPARTEMEN ================= -->
            <div class="level-section fade-in">
                <div class="section-label">DEPARTEMEN</div>
                <div class="departemen-grid">
                    <?php if (!empty($departemen)): ?>
                        <?php foreach ($departemen as $i => $item): ?>
                            <div class="person-card fade-in-up delay-<?= ($i % 5) + 1 ?>">
                                <div class="person-photo">
                                    <?php if (!empty($item['foto']) && file_exists("uploads/bem/".$item['foto'])): ?>
                                        <img src="uploads/bem/<?= htmlspecialchars($item['foto']) ?>" alt="Foto">
                                    <?php else: ?>
                                        <?= substr(getInitials($item['nama']), 0, 2) ?>
                                    <?php endif; ?>
                                </div>
                                <div class="person-name"><?= htmlspecialchars($item['nama']) ?></div>
                                <div class="person-position"><?= htmlspecialchars($item['jabatan']) ?></div>
                                <div class="person-prodi"><?= htmlspecialchars($item['prodi']) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="empty-text full">Belum ada data Departemen.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>

</main>

<?php include 'includes/footer.php'; ?>
