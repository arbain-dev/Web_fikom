<?php
require 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';

$query_dosen = "SELECT * FROM dosen WHERE program_studi = 'Informatika'";
$result_dosen = $conn->query($query_dosen);
?>

<!-- Page Header -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">INFORMATIKA</h1>
        <p class="page-subtitle">Selamat datang di Prodi Informatika, tempat Anda belajar pemrograman, analisis, dan pemecahan masalah untuk karier teknologi yang sukses.</p>
    </div>
</header>

<!-- Main Content -->
<section class="section-content">
    <div class="container">
        
        <!-- About Section -->
        <div class="prodi-about-grid stagger-container">
            <div class="prodi-about-text stagger-item">
                <h2>Tentang Informatika</h2>
                <p>
                    Program Studi Pendidikan Teknologi Informasi (PTI) merupakan wadah akademis yang secara unik menyinergikan keahlian teknis di bidang
                    informatika dengan kompetensi pedagogik kependidikan. Di sini, mahasiswa tidak hanya dibentuk menjadi ahli dalam pemrograman,
                    pengembangan perangkat lunak, dan manajemen jaringan, tetapi juga ditempa untuk memiliki keterampilan mengajar dan komunikasi yang efektif.
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
                    "Menjadi fakultas berkelas dunia pada 2028 yang unggul dalam bidang informatika dan komputer serta berkontribusi dalam mendukung
                    pencapaian National Excellence Entrepreneurial University untuk meningkatkan daya saing bangsa dan pemenuhan tujuan pembangunan
                    berkelanjutan (sustainable development goals)."
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
                        <p class="vm-item-text">Menyelenggarakan dan mengembangkan pendidikan di bidang informatika dan komputer yang berkelas dunia, dan berwawasan kewirausahaan.</p>
                    </li>
                    <li class="vm-list-item">
                        <span class="vm-number">2</span>
                        <p class="vm-item-text">Mengembangkan, menghasilkan, dan menyebarluaskan pengetahuan baru dan karya intelektual di bidang informatika dan komputer yang berkontribusi pada pemenuhan SDGs.</p>
                    </li>
                    <li class="vm-list-item">
                        <span class="vm-number">3</span>
                        <p class="vm-item-text">Berkolaborasi dengan industri dan pemangku kepentingan lain dalam pengembangan inovasi di bidang informatika dan komputer yang berkontribusi pada pertumbuhan ekonomi bangsa.</p>
                    </li>
                </ol>
            </div>
        </div>

        <!-- Dosen Section -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-center mb-8">Dosen Prodi Informatika</h2>
            
            <div class="dosen-grid stagger-container">
                <?php if ($result_dosen && $result_dosen->num_rows > 0): ?>
                    <?php while ($d = $result_dosen->fetch_assoc()): ?>
                        <?php include 'includes/part_dosen_card.php'; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-span-full text-center py-12 bg-gray-50 rounded-xl">
                        <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Belum ada data dosen Informatika.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>
