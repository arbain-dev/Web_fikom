<?php
include 'config/database.php';
require_once 'config/constants.php';
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

<style>
    :root {
        --primary-color: #4f46e5;
        --secondary-color: #64748b;
        --bg-color: #f8fafc;
        --card-bg: #ffffff;
        --text-main: #1e293b;
        --text-muted: #94a3b8;
        --spacing-md: 2rem;
        --spacing-lg: 3rem;
    }

    body.detail-berita-page {
        background-color: var(--bg-color);
        color: var(--text-main);
        font-family: 'Poppins', sans-serif;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 40px;
    }

    /* Main Content */
    .main-content {
        min-width: 0; /* Prevent overflow */
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        margin-bottom: 20px;
        transition: transform 0.2s;
    }

    .back-link:hover {
        transform: translateX(-5px);
    }

    .article-glass-card {
        background: var(--card-bg);
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .article-image {
        position: relative;
        width: 100%;
        height: 400px;
        overflow: hidden;
    }

    .article-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .category-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: var(--primary-color);
        color: #fff;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .article-content {
        padding: 40px;
    }

    .article-title {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 20px;
        color: #111827;
    }

    .article-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        color: var(--secondary-color);
        font-size: 0.95rem;
        margin-bottom: 30px;
        padding-bottom: 30px;
        border-bottom: 1px solid #e2e8f0;
    }

    .article-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .article-body {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #334155;
        margin-bottom: 40px;
    }
    
    .article-body p {
        margin-bottom: 1.5rem;
    }

    /* Share Section */
    .share-section {
        background: #f1f5f9;
        padding: 24px;
        border-radius: 12px;
    }

    .share-section h4 {
        margin: 0 0 16px 0;
        font-size: 1.1rem;
        color: #334155;
    }

    .share-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .share-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 8px;
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: transform 0.2s, opacity 0.2s;
    }

    .share-btn:hover {
        transform: translateY(-2px);
        opacity: 0.9;
    }

    .share-btn.facebook { background: #1877f2; }
    .share-btn.twitter { background: #1da1f2; }
    .share-btn.whatsapp { background: #25d366; }

    /* Sidebar */
    .sidebar-widget {
        background: var(--card-bg);
        padding: 24px;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 100px; /* Adjust based on sticky header height */
    }

    .sidebar-widget h3 {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f1f5f9;
        color: #1e293b;
    }

    .recent-news-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .recent-news-item {
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f8fafc;
    }

    .recent-news-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .recent-news-item a {
        display: block;
        font-weight: 600;
        color: #334155;
        text-decoration: none;
        margin-bottom: 6px;
        line-height: 1.4;
        transition: color 0.2s;
    }

    .recent-news-item a:hover {
        color: var(--primary-color);
    }

    .recent-news-date {
        font-size: 0.85rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    @media (max-width: 900px) {
        .container {
            grid-template-columns: 1fr;
        }

        .article-image {
            height: 300px;
        }

        .article-title {
            font-size: 2rem;
        }
        
        .sidebar-widget {
            position: static;
        }
    }
</style>

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
                <!-- Konten diproses untuk paragraph formatting jika perlu -->
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
