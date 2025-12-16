    <?php
 include 'includes/header.php';
require 'database/db_connect.php';

$query_dosen = "SELECT * FROM dosen WHERE program_studi = 'Pendidikan Teknologi Informasi'";
$result_dosen = $conn->query($query_dosen);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fikom-unisan-sidrap.co.id</title>
    <link rel="stylesheet" href="assets/css/prodi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="color-bg">
        <div class="color"></div>
        <div class="color"></div>
        <div class="color"></div>
    </div>
    <section class="hero">
        <div class="container hero-content">
            <h1 class="fade-in-up">Pendidikan Teknologi Informasi </h1>
            <p class="fade-in-up delay-1">Selamat Datang di Program Studi Pendidikan Teknologi Informasi. Kami berdedikasi mencetak lulusan yang tidak hanya ahli dalam teknologi, tetapi juga cakap dalam mendidik generasi digital.</p>
        </div>
    </section>
    <section id="tentang" class="about-tentang-section section">
        <div class="container">
            <div class="about-grid">
                <div class="about-text fade-in-up">
                    <h2>Tentang Pendidikan Teknologi Informasi</h2>
                    <p>Program Studi Pendidikan Teknologi Informasi (PTI) merupakan wadah akademis yang secara unik menyinergikan keahlian teknis di bidang informatika dengan kompetensi pedagogik kependidikan. Di sini, mahasiswa tidak hanya dibentuk menjadi ahli dalam pemrograman, pengembangan perangkat lunak, dan manajemen jaringan, tetapi juga ditempa untuk memiliki keterampilan mengajar dan komunikasi yang efektif. Kurikulum kami dirancang responsif terhadap perkembangan zaman, memastikan lulusan PTI siap berkarier ganda: sebagai tenaga pendidik profesional yang mampu melahirkan generasi melek digital, maupun sebagai praktisi IT handal yang mampu menghadirkan solusi teknologi inovatif di berbagai industri.</p>
                </div>
                <div class="about-image fade-in-up delay-1">
                    <img src="img/pp.png">
                </div>
            </div>
        </div>
    </section>
    <section class="visi-misi-section section">
    <div class="visi-misi-bg"></div>
    <div class="container">
        <div class="section-title fade-in-up">
            <h2>Visi</h2>
            <p>
                Menjadikan program studi pendidikan teknologi informasi menjadi program studi pendidikan teknologi informasi bertaraf nasional ditahun2026 yang menghasilkan lulusan yang unggul, profesional, berkarakter, bermoral Edupreneurship, dann mampu bersaing di era digital. 
            </p>
        </div>
        <div class="section-title fade-in-up delay-1">
            <h2>Misi</h2>
        </div>
        <div class="misi-grid">
            <div class="misi-card fade-in-up delay-1">
                <div class="misi-icon">🛡️</div>
                <p>
                    Menyelenggarakan pendidikan dan pengajaran yang berkualitas dan pembinaan untuk menghasilkan tenaga pendidik yang unggul, profesional dan bertakwa kepada tuhan yang maha esa.
                </p>
            </div>
            <div class="misi-card fade-in-up delay-2">
                <div class="misi-icon">🛡️</div>
                <p>
                    Menyelenggarakan peneitian dibidang penggrmbangan pembelajaran berbasis teknologi informasi untuk meningkatkan kompetensi dosen dan mahasiswa.
                </p>
            </div>
            <div class="misi-card fade-in-up delay-3">
                <div class="misi-icon">🛡️</div>
                <p>
                    Menyelenggarakan pengabdian kepada masyarakat sebagai bentuk kontribusi dalam mewujudkan masyarakat berwawasan ilmu pengetahuan dan teknologi.
                </p>
            </div>
            <div class="misi-card fade-in-up delay-4">
                <div class="misi-icon">🛡️</div>
                <p>
                    Menyelenggarakan kerjasama Tridarma perguruan tinggi dalam pengembangan pembelajaran berbasis teknologi informasi pada lembaga pendidikan serta membangun kerja sama dunia usaha dan dunia industri(stakeholders) dibidang teknologi.
                </p>
            </div>
        </div>
    </div>
</section>



<section id="dosen" class="section">
    <div class="container">
        <div class="section-title">
            <h2>Dosen Prodi Informatika</h2>
        </div>
        <div class="dosen-grid">
<?php
$sql_dosen = "SELECT * FROM dosen WHERE program_studi = 'Pendidikan Teknologi Informasi' ORDER BY nama ASC";
$result_dosen = mysqli_query($conn, $sql_dosen);
if ($result_dosen && mysqli_num_rows($result_dosen) > 0):
    while ($d = mysqli_fetch_assoc($result_dosen)):
        $foto = !empty($d['foto']) && file_exists("uploads/dosen/" . $d['foto'])
            ? "uploads/dosen/" . $d['foto']
            : "https://via.placeholder.com/300x350?text=Foto+Dosen";
            ?>
            <div class="dosen-card fade-in-up">
                <div class="dosen-image">
                    <img src="<?= $foto ?>" alt="<?= $d['nama']; ?>">
                </div>
                <div class="dosen-content">
                    <h3><?= $d['nama']; ?></h3>
                    <div class="jabatan"><?= $d['jabatan']; ?></div>
                    <p><?= !empty($d['keterangan']) ? $d['keterangan'] : 'Dosen PTI'; ?></p>
                </div>
            </div>
                <?php
                    endwhile;
                    else:
            echo "<p style='color:#fff; text-align:center; grid-column:1/-1;'>Belum ada dosen PTI.</p>";
                    endif;
                ?>
                </div>
            </div>
        </section>
    <script>
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.animation = entry.target.className.match(/fade-in-up|slide-in-left|slide-in-right/)[0] + ' 0.8s ease-out forwards';
                }
            });
        }, observerOptions);
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.fade-in-up, .slide-in-left, .slide-in-right');
            animatedElements.forEach(el => observer.observe(el));
        });
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
<?php
include 'includes/footer.php'; 
?>