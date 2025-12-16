<?php
include 'database/db_connect.php';
include 'includes/header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT id, judul, kategori, meta, konten, foto, tanggal_publish 
        FROM berita 
        WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$berita = $result->fetch_assoc();

if (!$berita) {
    header("Location: berita_semua.php");
    exit();
}
$sql_recent = "SELECT id, judul, tanggal_publish 
                FROM berita 
                WHERE id != ? 
                ORDER BY tanggal_publish DESC 
                LIMIT 5";
$stmt_recent = $conn->prepare($sql_recent);
$stmt_recent->bind_param("i", $id);
$stmt_recent->execute();
$recent_news = $stmt_recent->get_result();
?>

<body class="detail-berita-page">
<div class="container">
    <div class="main-content">
        <a href="berita_semua.php" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Berita
        </a>
        <article class="article-glass-card">
            <?php if (!empty($berita['foto'])): ?>
            <div class="article-image">
                <?php $imagePath = 'uploads/berita/' . $berita['foto']; ?>
                <img src="<?php echo htmlspecialchars($imagePath); ?>"
                     alt="<?php echo htmlspecialchars($berita['judul']); ?>">
                <div class="category-badge">
                    <?php echo htmlspecialchars($berita['kategori']); ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="article-content">
                <h1 class="article-title">
                    <?php echo htmlspecialchars($berita['judul']); ?>
                </h1>
                <div class="article-meta">
                    <div class="article-meta-item">
                        <i class="far fa-calendar"></i>
                        <?php 
                        $tanggal = date('d F Y', strtotime($berita['tanggal_publish']));
                        $bulan_inggris = array('January', 'February', 'March', 'April', 'May', 'June', 
                                              'July', 'August', 'September', 'October', 'November', 'December');
                        $bulan_indonesia = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                        $tanggal = str_replace($bulan_inggris, $bulan_indonesia, $tanggal);
                        echo $tanggal;
                        ?>
                    </div>
                </div>
                <div class="article-body">
                    <?php echo $berita['konten']; ?>
                </div>
                <div class="share-section">
                    <h4><i class="fas fa-share-alt"></i> Bagikan Berita Ini:</h4>
                    <div class="share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" 
                            target="_blank" class="share-btn facebook">
                            <i class="fab fa-facebook-f"></i>
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($berita['judul']); ?>" 
                            target="_blank" class="share-btn twitter">
                            <i class="fab fa-twitter"></i>
                            Twitter
                        </a>
                        <a href="https://wa.me/?text=<?php echo urlencode($berita['judul'] . ' - http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" 
                            target="_blank" class="share-btn whatsapp">
                            <i class="fab fa-whatsapp"></i>
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </article>
    </div>

    <aside class="sidebar">
        <div class="sidebar-widget">
            <h3>Berita Terbaru</h3>
            <ul class="recent-news-list">
                <?php if ($recent_news && $recent_news->num_rows > 0): ?>
                    <?php while($recent = $recent_news->fetch_assoc()): ?>
                        <li class="recent-news-item">
                            <a href="detail-berita.php?id=<?php echo $recent['id']; ?>">
                                <?php echo htmlspecialchars($recent['judul']); ?>
                            </a>
                            <div class="recent-news-date">
                                <i class="far fa-calendar-alt"></i>
                                <?php 
                                $tanggal_recent = date('d M Y', strtotime($recent['tanggal_publish']));
                                $tanggal_recent = str_replace($bulan_inggris, array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'), $tanggal_recent);
                                echo $tanggal_recent;
                                ?>
                            </div>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li class="recent-news-item">
                        <p style="color: #a0aec0;">Tidak ada berita lainnya</p>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </aside>
</div>

</body>
</html>