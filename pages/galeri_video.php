<?php 
require 'config/database.php'; 
require_once 'config/constants.php';
include 'includes/header.php';

$sql = "SELECT id, judul, deskripsi, kategori, link_youtube, tanggal_publish 
        FROM galeri_video 
        ORDER BY tanggal_publish DESC, id DESC";
$result = mysqli_query($conn, $sql);
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Galeri Video</h1>
        <p class="page-subtitle">Kumpulan Video Dokumentasi dan Kegiatan FIKOM</p>
    </div>
</header>

<div class="container">
    <div class="main-content" style="padding: clamp(2rem, 6vw, 4rem) 0;">
        <div class="grid grid-auto-fit gap-6 stagger-container">
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <article class="news-card stagger-item">
                        <div class="video-wrapper" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: var(--radius-lg) var(--radius-lg) 0 0;">
                            <iframe src="<?php echo htmlspecialchars($row['link_youtube']); ?>" 
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe>
                        </div>

                        <div class="news-card-body" style="padding: 1.5rem;">
                            <h2 class="news-title" style="font-size: 1.15rem; font-weight: 700; margin-bottom: 0.5rem; line-height: 1.4;">
                                <?php echo htmlspecialchars($row['judul']); ?>
                            </h2>
                            
                            <?php if(!empty($row['deskripsi'])): ?>
                            <p class="news-excerpt" style="color: var(--gray-600); font-size: 0.9rem; line-height: 1.6; margin-bottom: 1rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-transform: uppercase;">
                                <?php echo htmlspecialchars($row['deskripsi']); ?>
                            </p>
                            <?php endif; ?>

                            <div class="news-meta" style="display: flex; gap: 0.5rem; font-size: 0.85rem; color: var(--gray-500); border-top: 1px solid var(--gray-200); padding-top: 1rem; margin-top: auto;">
                                <div class="news-meta-item">
                                    <?php echo htmlspecialchars($row['kategori']); ?>
                                </div>
                                <span>&bull;</span>
                                <div class="news-meta-item">
                                    <?php 
                                    $tanggal = date('d M Y', strtotime($row['tanggal_publish']));
                                    $bulan_inggris = array('January','February','March','April','May','June','July','August','September','October','November','December');
                                    $bulan_indonesia = array('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
                                    echo str_replace($bulan_inggris, $bulan_indonesia, $tanggal);
                                    ?>
                                </div>
                            </div>

                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else: ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 1rem; background: white; border-radius: var(--radius-lg);">
                    <i class="fas fa-video-slash" style="font-size: 3rem; color: var(--gray-400); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.5rem; color: var(--gray-800); margin-bottom: 0.5rem;">Belum Ada Video</h3>
                    <p style="color: var(--gray-600);">Video dokumentasi belum tersedia saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
