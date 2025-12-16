<?php
require 'database/db_connect.php'; 

$query_berita = "SELECT * FROM berita ORDER BY tanggal_publish DESC LIMIT 6";
$result_berita = $conn->query($query_berita);
$fact = $conn->query("SELECT * FROM tb_fakta ORDER BY urutan ASC");
$query_slider = "SELECT * FROM hero_slider 
                WHERE is_active = 1 
                ORDER BY id ASC";
$result_slider = $conn->query($query_slider);
$q_about = $conn->query("SELECT * FROM tentang_fikom LIMIT 1");
$about = $q_about->fetch_assoc();

include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fikom-unisan-sidrap.co.id</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="hero-slider-full" id="heroSlider">
    <?php
    $slides = $conn->query("SELECT * FROM hero_slider WHERE is_active=1 ORDER BY id ASC");
    if ($slides->num_rows > 0):
        $i = 0;
        while ($row = $slides->fetch_assoc()):
            $file = $row['gambar'];
            $path = 'uploads/slider/' . $file;
            if (!file_exists($path)) {
                $path = 'https://via.placeholder.com/1600x600?text=Slider';
            }
    ?>
        <div class="slide fade <?= $i === 0 ? 'active' : '' ?>"
             style="background-image: url('<?= $path ?>');">
        </div>
    <?php
        $i++;
        endwhile;
    ?>
    <?php endif; ?>

    <button class="nav-btn prev" id="btnPrev">...</button>
    <button class="nav-btn next" id="btnNext">...</button>

    <div class="hero-content">
        <h1>FAKULTAS ILMU KOMPUTER</h1>
        <p>Selamat datang di website Fakultas Ilmu Komputer...</p>
    </div>
</div>


    <!-- ===== STATISTIK SECTION ===== -->
    <section class="fact-section">
        <h2 class="fact-title">Fakta Fakultas Ilmu Komputer</h2>
            <div class="stats-container">
                <?php while ($f = $fact->fetch_assoc()): ?>
                    <div class="stat">
                        <span class="stat-angka" data-target="<?= $f['angka'] ?>">0</span>
                        <span class="stat-label"><?= htmlspecialchars($f['judul']) ?></span>
                    </div>
                <?php endwhile; ?>
            </div>
    </section>


   <!-- ===== TENTANG FAKULTAS SECTION (DINAMIS) ===== -->
<section class="about-fakultas-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-text fade-in-up">

                <h2><?= $about ? htmlspecialchars($about['judul']) : "Tentang Fakultas" ?></h2>

                <p>
                    <?= $about ? nl2br(htmlspecialchars($about['deskripsi'])) 
                              : "Belum ada deskripsi fakultas yang ditambahkan." ?>
                </p>

            </div>

            <div class="about-image fade-in-up delay-1">
                <?php
                $img = ($about && !empty($about['gambar']) && file_exists("uploads/tentang/" . $about['gambar']))
                        ? "uploads/tentang/" . $about['gambar']
                        : "https://via.placeholder.com/400x300?text=Tentang+Fakultas";
                ?>
                <img src="<?= $img ?>" alt="Tentang Fakultas">
            </div>
        </div>
    </div>
</section>



    <!-- ===== PROGRAM STUDI SECTION ===== -->
    <section class="programs" id="program">
        <h2 class="section-title">Program Studi Kami</h2>
        <div class="program-grid">
            <div class="program-card">
                <div class="program-image"><i class="fas fa-laptop-code"></i></div>
                <div class="program-content">
                    <h3 class="program-title">Informatika</h3>
                    <p class="program-description">Teknik Informatika adalah bidang ilmu yang mempelajari penggunaan teknologi komputer untuk mengolah data secara logis...</p>
                    <a href="index_ti.php" class="program-link">Selengkapnya →</a>
                </div>
            </div>
            <div class="program-card">
                <div class="program-image"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="program-content">
                    <h3 class="program-title">Pendidikan Teknologi Informasi</h3>
                    <p class="program-description">Pendidikan Teknologi Informasi (PTI) menggabungkan ilmu TI dengan kemampuan mengajar...</p>
                    <a href="index_pti.php" class="program-link">Selengkapnya →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== INFO AKADEMIK SECTION ===== -->
    <section class="info-section">
        <div class="container">
            <h2 class="section-title">Akademik</h2>
            <p class="section-subtitle">Mempersiapkan mahasiswa untuk memberikan kontribusi yang berarti pada masyarakat, bangsa dan dunia.</p>
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-icon"><i class="fas fa-question"></i></div>
                    <h3>Mengapa Unisan Sidrap</h3>
                    <p>Unisan menjadi Perguruan Tinggi Swasta Terbaik di Indonesia yang telah terakreditasi Unggul.</p>
                </div>
                <div class="info-card">
                    <div class="info-icon"><i class="fas fa-building-columns"></i></div>
                    <h3>Tentang Fakultas</h3>
                    <p>Terdapat 4 Fakultas dan 14 Program Studi terdiri atas Program Sarjana, Sarjana Terapan, dan Diploma.</p>
                </div>
                <div class="info-card">
                    <div class="info-icon"><i class="fas fa-user-graduate"></i></div>
                    <h3>Berkuliah di Unisan Sidrap</h3>
                    <p>Unisan memiliki layanan sistem akademik berbasis digital yang telah terintegrasi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== BERITA SECTION ===== -->
    <section class="berita-section">
        <div class="berita-header">
            <h2>Berita Kampus</h2>
            <a href="berita_semua.php" class="lihat-semua">Lihat Semua</a>
        </div>

        <div class="berita-grid">
            <?php if ($result_berita && $result_berita->num_rows > 0): ?>
                <?php while($berita = $result_berita->fetch_assoc()): ?>
                    <?php 
                        $foto_db = $berita['foto'];
                        $path_foto = 'uploads/berita/' . $foto_db;
                        
                        if (!empty($foto_db) && file_exists($path_foto)) {
                            $foto_tampil = $path_foto;
                        } else {
                            $foto_tampil = 'https://via.placeholder.com/400x250?text=Berita+Unisan';
                        }
                    ?>
                    <div class="berita-item">
                        <img src="<?= $foto_tampil ?>" alt="<?= htmlspecialchars($berita['judul']) ?>">
                        <div class="berita-content">
                            <span class="kategori"><?= htmlspecialchars($berita['kategori']) ?></span>
                            <h3>
                                <a href="detail-berita.php?id=<?= $berita['id'] ?>">
                                    <?= htmlspecialchars($berita['judul']) ?>
                                </a>
                            </h3>
                            <p class="tanggal">
                                <i class="far fa-calendar-alt"></i> 
                                <?= date('d F Y', strtotime($berita['tanggal_publish'])) ?>
                            </p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- ===== KERJASAMA SECTION ===== -->
    <section class="kerjasama-wrapper">
        <h2 class="kerjasama-title">KERJA SAMA</h2>

        <div class="glass-container">
            <div class="slider-track">
                <?php 
                $q_kerjasama = mysqli_query($conn, "SELECT * FROM kerjasama ORDER BY id DESC");
                
                if ($q_kerjasama && mysqli_num_rows($q_kerjasama) > 0) {
                    $partners = [];
                    while ($row = mysqli_fetch_assoc($q_kerjasama)) {
                        $partners[] = $row;
                    }

                    for ($k = 0; $k < 2; $k++) { 
                        foreach ($partners as $item) {
                            $nama_instansi = htmlspecialchars($item['nama_instansi']);
                            $link_web = htmlspecialchars($item['link_website']);
                            $logo_file = $item['logo'];
                            $tahun_kerjasama = date('Y', strtotime($item['tanggal_input'])); 
                            
                            $logo_path = 'uploads/kerjasama/' . $logo_file;
                            if (empty($logo_file) || !file_exists($logo_path)) {
                                $logo_src = 'https://via.placeholder.com/150x80?text=' . urlencode($nama_instansi);
                            } else {
                                $logo_src = $logo_path;
                            }
                            
                            echo '<div class="partner-item">';
                            
                            if (!empty($link_web) && $link_web != '#') {
                                echo "<a href='$link_web' target='_blank' class='partner-logo-link'>
                                        <img src='$logo_src' alt='$nama_instansi'>
                                    </a>";
                            } else {
                                echo "<div class='partner-logo-link'>
                                        <img src='$logo_src' alt='$nama_instansi'>
                                    </div>";
                            }

                            echo "<div class='partner-info'>
                                    <span class='p-name'>$nama_instansi</span>
                                    <span class='p-year'>Since $tahun_kerjasama</span>
                                </div>";
                            
                            echo '</div>';
                        }
                    }

                } else {
                    echo "<p style='color: #ccc; font-style: italic;'>Belum ada data kerjasama.</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- ===== JAVASCRIPT ===== -->
    <script>
        let index = 0;
        const slides = document.querySelectorAll(".slide");
        const total = slides.length;

        function showSlide(i) {
            slides.forEach(slide => slide.classList.remove("active"));
            slides[i].classList.add("active");
        }

        function nextSlide() {
            index = (index + 1) % total;
            showSlide(index);
        }

        function prevSlide() {
            index = (index - 1 + total) % total;
            showSlide(index);
        }

        document.getElementById("btnNext").addEventListener("click", nextSlide);
        document.getElementById("btnPrev").addEventListener("click", prevSlide);

        setInterval(nextSlide, 4000);
        showSlide(index);

        // ===== STATISTIK COUNTER ===== 
        const counters = document.querySelectorAll(".stat-angka");
        let started = false;

        function startAllCounters() {
            let maxTarget = 0;

            counters.forEach(counter => {
                let t = +counter.getAttribute("data-target");
                if (t > maxTarget) maxTarget = t;
            });

            let current = 0;
            let speed = 100;

            function run() {
                let interval = setInterval(() => {
                    current++;

                    counters.forEach(counter => {
                        let target = +counter.getAttribute("data-target");

                        if (current <= target) {
                            counter.textContent = current;
                        }
                    });

                    if (current >= maxTarget) {
                        clearInterval(interval);

                        setTimeout(() => {
                            counters.forEach(c => (c.textContent = "0"));
                            current = 0;
                            run();
                        }, 1500);
                    }
                }, speed);
            }

            run();
        }

        const observer = new IntersectionObserver(
            entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !started) {
                        started = true;
                        startAllCounters();
                    }
                });
            },
            { threshold: 0.5 }
        );

        observer.observe(document.querySelector(".stats-container"));
    </script>

<?php
include 'includes/footer.php';
?>
</body>
</html>