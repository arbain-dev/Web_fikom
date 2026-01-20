<?php
/**
 * Homepage - Web FIKOM
 * Clean & Modern Design
 */

// Include configuration
require_once 'config/database.php';
require_once 'config/constants.php';
require_once 'includes/functions.php';

// Fetch data
$query_berita = "SELECT * FROM berita ORDER BY tanggal_publish DESC LIMIT 6";
$result_berita = $conn->query($query_berita);

$fact = $conn->query("SELECT * FROM tb_fakta ORDER BY urutan ASC");

$query_slider = "SELECT * FROM hero_slider WHERE is_active = 1 ORDER BY id ASC";
$result_slider = $conn->query($query_slider);

$q_about = $conn->query("SELECT * FROM tentang_fikom LIMIT 1");
$about = $q_about->fetch_assoc();
?>

<?php include 'includes/header.php'; ?>

<!-- ===================================
     HERO SLIDER
     Auto-rotating image slider with navigation
     Controls: btnPrev, btnNext, sliderDots
     =================================== -->
<section class="hero-slider" id="heroSlider">
    <?php
    if ($result_slider && $result_slider->num_rows > 0):
        $i = 0;
        while ($row = $result_slider->fetch_assoc()):
            $file = $row['gambar'];
            $path = 'uploads/slider/' . $file;
            if (!file_exists($path)) {
            }
    ?>
    <div class="hero-slide <?= $i === 0 ? 'active' : '' ?>" style="background-image: url('<?= $path ?>');">
        <div class="hero-slide-content reveal-on-scroll">
            <h1>Fakultas Ilmu Komputer</h1>
            <p>UNISAN Sidenreng Rappang - Mencetak Generasi Digital yang Kompetitif</p>
            <div class="hero-actions">
                <a href="index_ti.php" class="btn btn-primary btn-lg">Program Studi</a>
                <a href="berita_semua.php" class="btn btn-outline-white btn-lg">Berita Terbaru</a>
            </div>
        </div>
    </div>
    <?php
        $i++;
        endwhile;
    endif;
    ?>
    
    <!-- Slider Navigation -->
    <button class="slider-nav prev" id="btnPrev" aria-label="Previous">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button class="slider-nav next" id="btnNext" aria-label="Next">
        <i class="fas fa-chevron-right"></i>
    </button>
    
    <!-- Slider Dots -->
    <div class="slider-dots" id="sliderDots"></div>
</section>

<!-- ===================================
     STATS SECTION
     Animated counter displaying faculty statistics
     Triggered by IntersectionObserver scroll animation
     =================================== -->
<section class="stats-section reveal-on-scroll">
    <div class="container">
        <h2 class="section-title text-center text-white mb-10">Fakta Fakultas Ilmu Komputer</h2>
        <div class="stats-grid">
            <?php while ($f = $fact->fetch_assoc()): ?>
            <div class="stat-item">
                <div class="stat-number" data-count="<?= $f['angka'] ?>">0</div>
                <div class="stat-label"><?= htmlspecialchars($f['judul']) ?></div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- ===================================
     ABOUT SECTION
     Displays faculty introduction with image
     =================================== -->
<section class="section section-white about-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-content reveal-left">
                <h2><?= $about ? htmlspecialchars($about['judul']) : "Tentang Fakultas" ?></h2>
                <p><?= $about ? nl2br(htmlspecialchars($about['deskripsi'])) : "Belum ada deskripsi fakultas." ?></p>
                <a href="visi-misi.php" class="btn btn-primary">Selengkapnya <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="about-image reveal-right">
                <?php
                $img = ($about && !empty($about['gambar']) && file_exists("uploads/tentang/" . $about['gambar']))
                        ? "uploads/tentang/" . $about['gambar']
                        : "https://images.unsplash.com/photo-1562774053-701939374585?w=600";
                ?>
                <img src="<?= $img ?>" alt="Tentang Fakultas">
            </div>
        </div>
    </div>
</section>

<!-- ===================================
     PROGRAM STUDI SECTION
     2-column grid showcasing study programs
     =================================== -->
<section class="section section-gray">
    <div class="container">
        <div class="section-header reveal-on-scroll">
            <h2 class="section-title">Program Studi</h2>
            <p class="section-subtitle">Pilihan program studi yang tersedia di Fakultas Ilmu Komputer</p>
        </div>
        
        <div class="grid grid-cols-2 gap-8">
            <!-- Informatika -->
            <div class="program-card">
                <div class="program-card-image">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <div class="program-card-body">
                    <h3>S1 Informatika</h3>
                    <p>Program studi yang mempelajari ilmu komputer, pemrograman, dan pengembangan perangkat lunak modern.</p>
                    <a href="index_ti.php" class="program-card-link">
                        Pelajari lebih lanjut <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <!-- Pendidikan TI -->
            <div class="program-card">
                <div class="program-card-image bg-gradient-success">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="program-card-body">
                    <h3>S1 Pendidikan Teknologi Informasi</h3>
                    <p>Program studi yang mempersiapkan tenaga pendidik profesional di bidang teknologi informasi.</p>
                    <a href="index_pti.php" class="program-card-link">
                        Pelajari lebih lanjut <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================================
     INFORMASI AKADEMIK SECTION
     4 feature cards with quick links
     =================================== -->
<section class="section section-white">
    <div class="container">
        <div class="section-header reveal-on-scroll">
            <h2 class="section-title">Informasi Akademik</h2>
            <p class="section-subtitle">Akses cepat ke informasi penting seputar akademik</p>
        </div>
        
        <div class="feature-grid stagger-container">
            <a href="kalender.php" class="feature-card stagger-item">
                <div class="feature-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>Kalender Akademik</h3>
                <p>Jadwal kegiatan akademik semester ini</p>
            </a>
            
            <a href="kurikulum.php" class="feature-card stagger-item">
                <div class="feature-icon icon-success">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3>Kurikulum</h3>
                <p>Struktur mata kuliah program studi</p>
            </a>
            
            <a href="dosen.php" class="feature-card stagger-item">
                <div class="feature-icon icon-warning">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Dosen</h3>
                <p>Profil dosen pengajar fakultas</p>
            </a>
            
            <a href="laboratorium.php" class="feature-card stagger-item">
                <div class="feature-icon icon-error">
                    <i class="fas fa-flask"></i>
                </div>
                <h3>Laboratorium</h3>
                <p>Fasilitas lab untuk praktikum</p>
            </a>
        </div>
    </div>
</section>

<!-- ===================================
     BERITA SECTION
     Latest 6 news articles in card grid
     =================================== -->
<section class="section section-gray">
    <div class="container">
        <div class="section-header section-header-flex">
            <div>
                <h2 class="section-title mb-2">Berita Terbaru</h2>
                <p class="section-subtitle m-0">Update terkini dari Fakultas Ilmu Komputer</p>
            </div>
            <a href="berita_semua.php" class="btn btn-outline">Lihat Semua</a>
        </div>
        
        <div class="grid grid-auto-fit gap-6 stagger-container">
            <?php if ($result_berita && $result_berita->num_rows > 0): ?>
                <?php while ($berita = $result_berita->fetch_assoc()): ?>
                    <?php
                    $db_img = $berita['foto'] ?? '';
                    $img_path = "uploads/berita/" . $db_img;
                    $img_berita = (!empty($db_img) && file_exists(__DIR__ . '/' . $img_path))
                        ? $img_path
                        : "https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=400";
                    ?>
                    <article class="news-card stagger-item">
                        <img src="<?= $img_berita ?>" alt="<?= htmlspecialchars($berita['judul']) ?>" class="news-card-image">
                        <div class="news-card-body">
                            <span class="news-card-category"><?= htmlspecialchars($berita['kategori'] ?? 'Berita') ?></span>
                            <h3 class="news-card-title">
                                <a href="detail-berita.php?id=<?= $berita['id'] ?>"><?= htmlspecialchars($berita['judul']) ?></a>
                            </h3>
                            <div class="news-card-date">
                                <i class="far fa-calendar"></i>
                                <?= date('d M Y', strtotime($berita['tanggal_publish'])) ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-state-icon"><i class="fas fa-newspaper"></i></div>
                    <h3>Belum ada berita</h3>
                    <p>Berita akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ===================================
     PARTNERSHIP CAROUSEL
     Infinite scrolling logo carousel
     Displays partner institutions (2x loop for seamless animation)
     =================================== -->
<section class="section section-white partnership-section">
    <div class="container">
        <div class="section-header reveal-on-scroll">
            <h2 class="section-title text-center">Mitra Kerja Sama</h2>
            <p class="section-subtitle text-center">Kolaborasi strategis dengan berbagai instansi dan industri</p>
        </div>

        <div class="carousel-container reveal-on-scroll">
            <div class="carousel-track">
                <?php
                // Fetch partnership data
                $query_kerjasama = "SELECT * FROM kerjasama ORDER BY id DESC";
                $result_kerjasama = $conn->query($query_kerjasama);
                $partners = [];

                if ($result_kerjasama && $result_kerjasama->num_rows > 0) {
                    while ($row = $result_kerjasama->fetch_assoc()) {
                        $partners[] = $row;
                    }
                } else {
                    // Fallback Placeholders if no data
                    $partners = [
                        ['nama_instansi' => 'Google Indonesia', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg', 'link_website' => '#'],
                        ['nama_instansi' => 'Microsoft', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/9/96/Microsoft_logo_%282012%29.svg', 'link_website' => '#'],
                        ['nama_instansi' => 'Telkom Indonesia', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/b/bc/Telkom_Indonesia_2013.svg', 'link_website' => '#'],
                        ['nama_instansi' => 'Tokopedia', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/a7/Tokopedia.svg', 'link_website' => '#'],
                        ['nama_instansi' => 'Gojek', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/9/9e/Gojek_logo_2019.svg', 'link_website' => '#'],
                        ['nama_instansi' => 'Traveloka', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/3/33/Traveloka_Primary_Logo.svg', 'link_website' => '#'],
                    ];
                }

                // Output DOUBLE loop for seamless infinite scroll
                for ($k = 0; $k < 2; $k++) {
                    foreach ($partners as $partner) {
                        $p_name = htmlspecialchars($partner['nama_instansi']);
                        $p_link = !empty($partner['link_website']) ? $partner['link_website'] : '#';
                        
                        // Handle logo path
                        if (strpos($partner['logo'], 'http') === 0) {
                            $p_img = $partner['logo']; // Url placeholder
                        } else {
                            $p_img = 'uploads/kerjasama/' . $partner['logo'];
                        }
                        
                        // Use Month & Year from DB
                        $p_bulan = $partner['bulan'] ?? '';
                        $p_tahun = $partner['tahun'] ?? '';
                        
                        if (!empty($p_bulan) && !empty($p_tahun)) {
                            $p_date = $p_bulan . ' ' . $p_tahun;
                        } elseif (!empty($p_tahun)) {
                            $p_date = $p_tahun;
                        } else {
                            // Fallback if empty (e.g. old data)
                            $p_date = "2024";
                        }
                        ?>
                        <a href="<?= $p_link ?>" class="partner-item" target="_blank" title="<?= $p_name ?>">
                            <div class="partner-logo-wrapper">
                                <img src="<?= $p_img ?>" alt="<?= $p_name ?>" class="partner-logo">
                            </div>
                            <span class="partner-year"> <?= $p_date ?></span>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<!-- Slider JavaScript -->
<!-- Logic Moved to assets/js/main.js -->
