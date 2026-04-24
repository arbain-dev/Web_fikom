<?php
include 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';

$sql = "SELECT id, judul, kategori, meta, konten, foto, tanggal_publish 
        FROM berita 
        ORDER BY tanggal_publish DESC";
$result = $conn->query($sql);
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Berita & Informasi</h1>
        <p class="page-subtitle">Kabar terbaru seputar kegiatan dan prestasi FIKOM</p>
    </div>
</header>

<!-- Main Content -->
<section class="section-content">
    <div class="container">
        <div class="grid grid-auto-fit gap-6 stagger-container">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <?php 
                        $foto = !empty($row['foto']) ? 'uploads/berita/' . $row['foto'] : 'assets/img/placeholder.jpg';
                        $tanggal = date('d M Y', strtotime($row['tanggal_publish']));
                    ?>
                    <article class="news-card stagger-item">
                        <img src="<?= htmlspecialchars($foto) ?>" alt="<?= htmlspecialchars($row['judul']) ?>" class="news-card-image">
                        <div class="news-card-body">
                            <span class="news-card-category"><?= htmlspecialchars($row['kategori'] ?? 'Berita') ?></span>
                            <h3 class="news-card-title">
                                <a href="detail-berita?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['judul']) ?></a>
                            </h3>
                            <div class="news-card-meta">
                                <span><i class="far fa-calendar"></i> <?= $tanggal ?></span>
                            </div>
                            <p class="news-card-excerpt"><?= substr(strip_tags($row['konten']), 0, 100) ?>...</p>
                            <a href="detail-berita?id=<?= $row['id'] ?>" class="news-card-link">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-12 text-gray-500">
                    <i class="far fa-newspaper text-4xl mb-3"></i>
                    <p>Belum ada berita yang tersedia saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
