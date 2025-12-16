<?php
include 'database/db_connect.php';
include 'includes/header.php';

$sql = "SELECT id, judul, kategori, meta, konten, foto, tanggal_publish 
        FROM berita 
        ORDER BY tanggal_publish DESC";
$result = $conn->query($sql);
?>
<body class="berita-semua-page">

<div class="page-header">
    <h1>Berita Terbaru</h1>
    <p>Informasi dan Kegiatan Terkini FIKOM</p>
</div>

<div class="container">
    <div class="main-content">
        <div class="news-grid">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <article class="news-card">
                        <div class="news-card-image">
                            <?php if (!empty($row['foto'])): ?>
                                <?php $thumbPath = 'uploads/berita/' . $row['foto']; ?>
                                <img src="<?php echo htmlspecialchars($thumbPath); ?>"
                                     alt="<?php echo htmlspecialchars($row['judul']); ?>">
                            <?php else: ?>
                                <img src="img/placeholder.jpg" alt="Foto Berita">
                            <?php endif; ?>
                        </div>
                        <div class="news-card-body">
                            <div class="news-meta">
                                <div class="news-meta-item">
                                    <i class="far fa-calendar"></i>
                                    <?php 
                                    $tanggal = date('d M Y', strtotime($row['tanggal_publish']));
                                    $bulan_inggris = array('January', 'February', 'March', 'April', 'May', 'June', 
                                                        'July', 'August', 'September', 'October', 'November', 'December');
                                    $bulan_indonesia = array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 
                                                        'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');
                                    $tanggal = str_replace($bulan_inggris, $bulan_indonesia, $tanggal);
                                    echo $tanggal;
                                    ?>
                                </div>
                            </div>
                            <h2 class="news-title">
                                <a href="detail-berita.php?id=<?php echo $row['id']; ?>">
                                    <?php echo htmlspecialchars($row['judul']); ?>
                                </a>
                            </h2>
                            <a href="detail-berita.php?id=<?php echo $row['id']; ?>" class="read-more">
                                Baca Selengkapnya
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i class="far fa-newspaper"></i>
                    <p>Tidak ada berita untuk ditampilkan.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
include 'includes/footer.php';
?>
</body>
</html>