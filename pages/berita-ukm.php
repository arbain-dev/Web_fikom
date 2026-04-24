<?php 
require 'config/database.php'; 
require_once 'config/constants.php';
include 'includes/header.php';

$sql = "SELECT id, judul, kategori, meta, konten, foto, tanggal_publish 
        FROM berita 
        WHERE kategori = 'kegiatan UKM' 
        ORDER BY tanggal_publish DESC";
$result = mysqli_query($conn, $sql);
?>



<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Berita UKM</h1>
        <p class="page-subtitle">Informasi dan Kegiatan UKM Terkini FIKOM</p>
    </div>
</header>

<div class="container">
    <div class="main-content">
        <div class="news-grid">
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <article class="news-card">
                        <div class="news-card-image">
                            <?php if (!empty($row['foto'])): ?>
                                <?php $thumbPath = 'uploads/berita/' . $row['foto']; ?>
                                <img src="<?php echo htmlspecialchars($thumbPath); ?>"
                                     alt="<?php echo htmlspecialchars($row['judul']); ?>">
                            <?php else: ?>
                                <img src="assets/img/placeholder.jpg" alt="Foto Berita">
                            <?php endif; ?>
                        </div>

                        <div class="news-card-body">
                            <div class="news-meta">
                                <div class="news-meta-item">
                                    <i class="far fa-calendar"></i>
                                    <?php 
                                    $tanggal = date('d M Y', strtotime($row['tanggal_publish']));
                                    $bulan_inggris = array('January','February','March','April','May','June','July','August','September','October','November','December');
                                    $bulan_indonesia = array('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
                                    echo str_replace($bulan_inggris, $bulan_indonesia, $tanggal);
                                    ?>
                                </div>
                            </div>

                            <h2 class="news-title">
                                <a href="detail-berita?id=<?php echo $row['id']; ?>">
                                    <?php echo htmlspecialchars($row['judul']); ?>
                                </a>
                            </h2>

                            <a href="detail-berita?id=<?php echo $row['id']; ?>" class="read-more">
                                Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i class="far fa-newspaper"></i>
                    <p>Tidak ada berita UKM untuk ditampilkan.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
