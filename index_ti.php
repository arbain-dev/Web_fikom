<?php
require 'database/db_connect.php';
include 'includes/header.php';

$query_dosen = "SELECT * FROM dosen WHERE program_studi = 'Informatika'";
$result_dosen = $conn->query($query_dosen);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>fikom-unisan-sidrap.co.id</title>
  <link rel="stylesheet" href="assets/css/prodi.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

  <div class="color-bg" aria-hidden="true">
    <div class="color"></div>
    <div class="color"></div>
    <div class="color"></div>
  </div>

  <!-- HERO -->
  <section class="hero">
    <div class="container hero-content">
      <h1 class="fade-in-up">INFORMATIKA</h1>
      <p class="fade-in-up delay-1">
        Selamat datang di Prodi Informatika, tempat Anda belajar pemrograman, analisis, dan pemecahan masalah untuk karier teknologi yang sukses.
      </p>
    </div>
  </section>

  <!-- TENTANG -->
  <section id="tentang" class="about-tentang-section section">
    <div class="container">
      <div class="about-grid">
        <div class="about-text fade-in-up">
          <h2>Tentang Pendidikan Teknologi Informasi</h2>
          <p>
            Program Studi Pendidikan Teknologi Informasi (PTI) merupakan wadah akademis yang secara unik menyinergikan keahlian teknis di bidang
            informatika dengan kompetensi pedagogik kependidikan. Di sini, mahasiswa tidak hanya dibentuk menjadi ahli dalam pemrograman,
            pengembangan perangkat lunak, dan manajemen jaringan, tetapi juga ditempa untuk memiliki keterampilan mengajar dan komunikasi yang efektif.
          </p>
        </div>

        <div class="about-image fade-in-up delay-1">
          <img src="img/pp.png" alt="Ilustrasi Prodi Informatika">
        </div>
      </div>
    </div>
  </section>

  <!-- VISI MISI -->
  <section class="visi-misi-section section">
    <div class="visi-misi-bg"></div>

    <div class="container">
      <div class="section-title fade-in-up">
        <h2>Visi</h2>
        <p>
          Menjadi fakultas berkelas dunia pada 2028 yang unggul dalam bidang informatika dan komputer serta berkontribusi dalam mendukung
          pencapaian National Excellence Entrepreneurial University untuk meningkatkan daya saing bangsa dan pemenuhan tujuan pembangunan
          berkelanjutan (sustainable development goals).
        </p>
      </div>
      <div class="section-title fade-in-up delay-1">
        <h2>Misi</h2>
      </div>
      <div class="misi-grid">
        <div class="misi-card fade-in-up delay-1">
          <div class="misi-icon">🛡️</div>
          <p>Menyelenggarakan dan mengembangkan pendidikan di bidang informatika dan komputer yang berkelas dunia, dan berwawasan kewirausahaan.</p>
        </div>
        <div class="misi-card fade-in-up delay-2">
          <div class="misi-icon">🛡️</div>
          <p>Mengembangkan, menghasilkan, dan menyebarluaskan pengetahuan baru dan karya intelektual di bidang informatika dan komputer yang berkontribusi pada pemenuhan SDGs.</p>
        </div>
        <div class="misi-card fade-in-up delay-3">
          <div class="misi-icon">🛡️</div>
          <p>Mengembangkan, menghasilkan, dan menyebarluaskan pengetahuan baru dan karya intelektual di bidang informatika dan komputer yang berkontribusi pada pemenuhan SDGs.</p>
        </div>
        <div class="misi-card fade-in-up delay-4">
          <div class="misi-icon">🛡️</div>
          <p>Berkolaborasi dengan industri dan pemangku kepentingan lain dalam pengembangan inovasi di bidang informatika dan komputer yang berkontribusi pada pertumbuhan ekonomi bangsa.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- DOSEN -->
  <section id="dosen" class="section">
    <div class="container">
      <div class="section-title">
        <h2>Dosen Prodi Informatika</h2>
      </div>
      <div class="dosen-grid">
        <?php if ($result_dosen && $result_dosen->num_rows > 0): ?>
          <?php while ($row = $result_dosen->fetch_assoc()): ?>
            <?php
              $foto = $row["foto"] ?? '';
              $path_server = "uploads/dosen/" . $foto;
              if (!empty($foto) && file_exists($path_server)) {
                $img = $path_server;
              } else {
                $img = "https://via.placeholder.com/400?text=No+Image";
              }
            ?>
            <div class="dosen-card fade-in-up">
              <div class="dosen-image">
                <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($row['nama'] ?? 'Dosen') ?>">
              </div>
              <div class="dosen-content">
                <h3><?= htmlspecialchars($row['nama'] ?? '-') ?></h3>
                <div class="jabatan"><?= htmlspecialchars($row['jabatan'] ?? '-') ?></div>
                <p><?= htmlspecialchars($row['keahlian'] ?: 'Keahlian belum diisi') ?></p>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="empty-state">Belum ada data dosen Informatika.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <script>
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          const anim = entry.target.className.match(/fade-in-up|slide-in-left|slide-in-right/);
          if (anim) entry.target.style.animation = anim[0] + ' 0.8s ease-out forwards';
        }
      });
    }, observerOptions);
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.fade-in-up, .slide-in-left, .slide-in-right')
        .forEach(el => observer.observe(el));
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
          e.preventDefault();
          const target = document.querySelector(anchor.getAttribute('href'));
          if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
      });
    });
  </script>
  <?php include 'includes/footer.php'; ?>
</body>
</html>
