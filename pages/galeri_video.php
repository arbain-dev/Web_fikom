<?php 
require 'config/database.php'; 
require_once 'config/constants.php';
include 'includes/header.php';

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 12;
$offset = ($page - 1) * $limit;

$whereClause = "";
if (!empty($search)) {
    $whereClause = "WHERE judul LIKE '%$search%' OR deskripsi LIKE '%$search%' OR kategori LIKE '%$search%'";
}

$countSql = "SELECT COUNT(id) as total FROM galeri_video $whereClause";
$countResult = mysqli_query($conn, $countSql);
$totalRows = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalRows / $limit);

$sql = "SELECT id, judul, deskripsi, kategori, link_youtube, tanggal_publish 
        FROM galeri_video 
        $whereClause
        ORDER BY tanggal_publish DESC, id DESC
        LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Galeri Video</h1>
        <p class="page-subtitle">Kumpulan Video Dokumentasi dan Kegiatan FIKOM</p>
    </div>
</header>

<div class="container" style="max-width: 1200px; margin: 0 auto;">
    <div class="main-content" style="padding: clamp(2rem, 6vw, 4rem) 0;">
        
        <!-- Search Form -->
        <div class="search-container" style="margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            <form action="" method="GET" style="display: flex; gap: 0.5rem; box-shadow: var(--shadow-sm); border-radius: var(--radius-md); overflow: hidden;">
                <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari video lama atau baru..." style="flex: 1; padding: 0.875rem 1.25rem; border: 1px solid var(--gray-300); border-right: none; outline: none; border-radius: var(--radius-md) 0 0 var(--radius-md);">
                <button type="submit" class="btn btn-primary" style="padding: 0.875rem 1.5rem; border: none; border-radius: 0 var(--radius-md) var(--radius-md) 0; cursor: pointer; display: flex; align-items: center; gap: 0.5rem;"><i class="fas fa-search"></i> Cari</button>
            </form>
            <?php if(!empty($search)): ?>
                <div style="margin-top: 1rem; text-align: center;">
                    <a href="galeri_video" style="color: var(--gray-600); text-decoration: none; font-size: 0.9rem;"><i class="fas fa-times-circle"></i> Hapus Pencarian</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="grid gap-6 stagger-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">
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
        
        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <div class="pagination" style="display: flex; justify-content: center; gap: 0.5rem; margin-top: 4rem;">
                <?php if($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" style="padding: 0.5rem 1rem; border-radius: var(--radius-md); background: var(--gray-100); color: var(--gray-700); text-decoration: none; border: 1px solid var(--gray-200);"><i class="fas fa-chevron-left"></i></a>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" 
                       style="padding: 0.5rem 1rem; border-radius: var(--radius-md); <?php echo $i === $page ? 'background: var(--primary-600); color: white; border: 1px solid var(--primary-600);' : 'background: white; color: var(--gray-700); text-decoration: none; border: 1px solid var(--gray-200);'; ?> transition: all 0.2s;">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" style="padding: 0.5rem 1rem; border-radius: var(--radius-md); background: var(--gray-100); color: var(--gray-700); text-decoration: none; border: 1px solid var(--gray-200);"><i class="fas fa-chevron-right"></i></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
