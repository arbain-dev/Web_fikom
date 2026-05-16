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

$countSql = "SELECT COUNT(id) as total FROM galeri_foto $whereClause";
$countResult = mysqli_query($conn, $countSql);
$totalRows = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalRows / $limit);

$sql = "SELECT id, judul, deskripsi, kategori, foto, tanggal_publish 
        FROM galeri_foto 
        $whereClause
        ORDER BY tanggal_publish DESC, id DESC
        LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Galeri Foto</h1>
        <p class="page-subtitle">Kumpulan Foto Dokumentasi dan Kegiatan FIKOM</p>
    </div>
</header>

<div class="container" style="max-width: 1200px; margin: 0 auto;">
    <div class="main-content" style="padding: clamp(2rem, 6vw, 4rem) 0;">
        
        <!-- Search Form -->
        <div class="search-container" style="margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            <form action="" method="GET" style="display: flex; gap: 0.5rem; box-shadow: var(--shadow-sm); border-radius: var(--radius-md); overflow: hidden;">
                <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Cari foto lama atau baru..." style="flex: 1; padding: 0.875rem 1.25rem; border: 1px solid var(--gray-300); border-right: none; outline: none; border-radius: var(--radius-md) 0 0 var(--radius-md);">
                <button type="submit" class="btn btn-primary" style="padding: 0.875rem 1.5rem; border: none; border-radius: 0 var(--radius-md) var(--radius-md) 0; cursor: pointer; display: flex; align-items: center; gap: 0.5rem;"><i class="fas fa-search"></i> Cari</button>
            </form>
            <?php if(!empty($search)): ?>
                <div style="margin-top: 1rem; text-align: center;">
                    <a href="galeri_foto" style="color: var(--gray-600); text-decoration: none; font-size: 0.9rem;"><i class="fas fa-times-circle"></i> Hapus Pencarian</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="grid gap-6 stagger-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <article class="news-card stagger-item">
                        <div class="image-wrapper" style="position: relative; padding-bottom: 75%; height: 0; overflow: hidden; border-radius: var(--radius-lg) var(--radius-lg) 0 0; background: #f1f5f9;">
                            <?php 
                            $fotos = json_decode($row['foto'], true);
                            if(!is_array($fotos)) $fotos = [$row['foto']];
                            $first_foto = $fotos[0] ?? '';
                            $fotos_json = htmlspecialchars(json_encode($fotos), ENT_QUOTES, 'UTF-8');
                            if(!empty($first_foto)): ?>
                                <img src="<?php echo BASE_URL; ?>/uploads/galeri_foto/<?php echo htmlspecialchars($first_foto); ?>" 
                                     alt="<?php echo htmlspecialchars($row['judul']); ?>"
                                     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; cursor: pointer;"
                                     onmouseover="this.style.transform='scale(1.05)'"
                                     onmouseout="this.style.transform='scale(1)'"
                                     onclick="openGalleryModal(<?php echo $fotos_json; ?>, 0)">
                                <?php if(count($fotos) > 1): ?>
                                     <div style="position: absolute; bottom: 10px; right: 10px; background: rgba(0,0,0,0.6); color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; pointer-events: none;">
                                         <i class="fas fa-images"></i> +<?= count($fotos)-1 ?>
                                     </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--gray-400);">
                                    <i class="fas fa-image" style="font-size: 3rem;"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="news-card-body" style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                            <h2 class="news-title" style="font-size: 1.15rem; font-weight: 700; margin-bottom: 0.5rem; line-height: 1.4;">
                                <?php echo htmlspecialchars($row['judul']); ?>
                            </h2>
                            
                            <?php if(!empty($row['deskripsi'])): ?>
                            <p class="news-excerpt" style="color: var(--gray-600); font-size: 0.9rem; line-height: 1.6; margin-bottom: 1rem; flex-grow: 1;">
                                <?php echo htmlspecialchars($row['deskripsi']); ?>
                            </p>
                            <?php endif; ?>

                            <div class="news-meta" style="display: flex; gap: 0.5rem; font-size: 0.85rem; color: var(--gray-500); border-top: 1px solid var(--gray-200); padding-top: 1rem; margin-top: auto;">
                                <div class="news-meta-item">
                                    <i class="fas fa-tag"></i> <?php echo htmlspecialchars($row['kategori']); ?>
                                </div>
                                <span>&bull;</span>
                                <div class="news-meta-item">
                                    <i class="far fa-calendar-alt"></i> 
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
                <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 1rem; background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
                    <i class="fas fa-images" style="font-size: 3rem; color: var(--gray-400); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.5rem; color: var(--gray-800); margin-bottom: 0.5rem;">Belum Ada Foto</h3>
                    <p style="color: var(--gray-600);">Foto dokumentasi kegiatan belum tersedia saat ini.</p>
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

<!-- Modal untuk View Image Fullscreen -->
<div id="imageModal" style="display: none; position: fixed; z-index: 9999; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.9); align-items: center; justify-content: center; flex-direction: column;">
    <span style="position: absolute; top: 15px; right: 35px; color: #f1f1f1; font-size: 40px; font-weight: bold; cursor: pointer; z-index: 10001;" onclick="closeImageModal()">&times;</span>
    
    <div style="position: relative; width: 90%; height: 80%; display: flex; align-items: center; justify-content: center;">
        <span id="prevBtn" style="position: absolute; left: 0; color: white; font-size: 3rem; cursor: pointer; user-select: none; padding: 20px; z-index: 10001;" onclick="changeImage(-1)">&#10094;</span>
        <img id="modalImage" style="max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 8px;">
        <span id="nextBtn" style="position: absolute; right: 0; color: white; font-size: 3rem; cursor: pointer; user-select: none; padding: 20px; z-index: 10001;" onclick="changeImage(1)">&#10095;</span>
    </div>
    <div id="imageCounter" style="color: white; margin-top: 15px; font-size: 1.2rem;"></div>
</div>

<script>
let currentPhotos = [];
let currentIndex = 0;

function openGalleryModal(photos, index) {
    if (!photos || photos.length === 0) return;
    currentPhotos = photos;
    currentIndex = index;
    
    var modal = document.getElementById("imageModal");
    modal.style.display = "flex";
    
    updateModalView();
}

function updateModalView() {
    var modalImg = document.getElementById("modalImage");
    modalImg.src = "<?php echo BASE_URL; ?>/uploads/galeri_foto/" + currentPhotos[currentIndex];
    
    document.getElementById("imageCounter").innerText = (currentIndex + 1) + " / " + currentPhotos.length;
    
    document.getElementById("prevBtn").style.display = currentPhotos.length > 1 ? "block" : "none";
    document.getElementById("nextBtn").style.display = currentPhotos.length > 1 ? "block" : "none";
}

function changeImage(step) {
    currentIndex += step;
    if (currentIndex >= currentPhotos.length) currentIndex = 0;
    if (currentIndex < 0) currentIndex = currentPhotos.length - 1;
    updateModalView();
}

function closeImageModal() {
    var modal = document.getElementById("imageModal");
    modal.style.display = "none";
    currentPhotos = [];
}

// Close modal on escape key press or arrow keys for navigation
document.addEventListener('keydown', function(event) {
    var modal = document.getElementById("imageModal");
    if (modal.style.display === "flex") {
        if (event.key === "Escape") {
            closeImageModal();
        } else if (event.key === "ArrowRight") {
            changeImage(1);
        } else if (event.key === "ArrowLeft") {
            changeImage(-1);
        }
    }
});

// Close modal when clicking outside the image
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this || e.target.closest('div') === this && e.target.id !== 'prevBtn' && e.target.id !== 'nextBtn' && e.target.id !== 'modalImage') {
        closeImageModal();
    }
});
</script>

<?php include 'includes/footer.php'; ?>
