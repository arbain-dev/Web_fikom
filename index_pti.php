<?php
require 'config/database.php';
include 'includes/header.php';

$query_dosen = "SELECT * FROM dosen WHERE program_studi = 'Pendidikan Teknologi Informasi'";
$result_dosen = $conn->query($query_dosen);
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Pendidikan Teknologi Informasi</h1>
        <p class="page-subtitle">Selamat Datang di Program Studi Pendidikan Teknologi Informasi. Kami berdedikasi mencetak lulusan yang tidak hanya ahli dalam teknologi, tetapi juga cakap dalam mendidik generasi digital.</p>
    </div>
</header>

<!-- Main Content -->
<section class="section-content">
    <div class="container">
        
        <!-- About Section -->
        <div class="prodi-about-grid stagger-container">
            <div class="prodi-about-text stagger-item">
                <h2>Tentang Pendidikan Teknologi Informasi</h2>
                <p>
                    Program Studi Pendidikan Teknologi Informasi (PTI) merupakan wadah akademis yang secara unik menyinergikan keahlian teknis di bidang
                    informatika dengan kompetensi pedagogik kependidikan. Di sini, mahasiswa tidak hanya dibentuk menjadi ahli dalam pemrograman,
                    pengembangan perangkat lunak, dan manajemen jaringan, tetapi juga ditempa untuk memiliki keterampilan mengajar dan komunikasi yang efektif.
                    Kurikulum kami dirancang responsif terhadap perkembangan zaman, memastikan lulusan PTI siap berkarier ganda: sebagai tenaga pendidik profesional
                    yang mampu melahirkan generasi melek digital, maupun sebagai praktisi IT handal yang mampu menghadirkan solusi teknologi inovatif di berbagai industri.
                </p>
            </div>
            <div class="prodi-about-image stagger-item text-center">
                <img src="assets/img/pp.png" alt="Ilustrasi Prodi">
            </div>
        </div>

        <!-- Unified Visi & Misi Section -->
        <div class="vm-card stagger-item">
            <!-- Visi -->
            <div class="mb-10 text-center">
                <div class="vm-header">
                    <div class="vm-icon primary">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h2 class="vm-title">Visi</h2>
                </div>
                <p class="vm-text">
                    "Menjadikan program studi pendidikan teknologi informasi menjadi program studi pendidikan teknologi informasi bertaraf nasional ditahun 2026 yang menghasilkan lulusan yang unggul, profesional, berkarakter, bermoral Edupreneurship, dan mampu bersaing di era digital."
                </p>
            </div>

            <div class="vm-divider"></div>

            <!-- Misi -->
            <div>
                <div class="vm-header">
                    <div class="vm-icon success">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h2 class="vm-title">Misi</h2>
                </div>
                
                <ol class="vm-list">
                    <li class="vm-list-item">
                        <span class="vm-number">1</span>
                        <p class="vm-item-text">Menyelenggarakan pendidikan dan pengajaran yang berkualitas dan pembinaan untuk menghasilkan tenaga pendidik yang unggul, profesional dan bertakwa kepada Tuhan YME.</p>
                    </li>
                    <li class="vm-list-item">
                        <span class="vm-number">2</span>
                        <p class="vm-item-text">Menyelenggarakan penelitian dibidang pengembangan pembelajaran berbasis teknologi informasi untuk meningkatkan kompetensi dosen dan mahasiswa.</p>
                    </li>
                    <li class="vm-list-item">
                        <span class="vm-number">3</span>
                        <p class="vm-item-text">Menyelenggarakan pengabdian kepada masyarakat sebagai bentuk kontribusi dalam mewujudkan masyarakat berwawasan ilmu pengetahuan dan teknologi.</p>
                    </li>
                    <li class="vm-list-item">
                        <span class="vm-number">4</span>
                        <p class="vm-item-text">Menyelenggarakan kerjasama Tridarma perguruan tinggi dalam pengembangan pembelajaran berbasis teknologi informasi pada lembaga pendidikan serta membangun kerja sama dunia usaha dan dunia industri (stakeholders).</p>
                    </li>
                </ol>
            </div>
        </div>

        <!-- Dosen Section -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-center mb-8">Dosen Prodi PTI</h2>
            
            <div class="dosen-grid stagger-container">
                <?php if ($result_dosen && $result_dosen->num_rows > 0): ?>
                    <?php while ($d = $result_dosen->fetch_assoc()): ?>
                        <?php include 'includes/part_dosen_card.php'; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-span-full text-center py-12 bg-gray-50 rounded-xl">
                        <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Belum ada data dosen PTI.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>
