<?php
require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';
// $conn is created in database.php
$sql = "SELECT * FROM tracer_study ORDER BY tahun_lulus DESC, tanggal_isi DESC";
$result = $conn->query($sql);
$sql_stats = "
  SELECT 
    COUNT(*) as total_alumni,
    COALESCE(AVG(NULLIF(masa_tunggu,0)),0) as avg_tunggu,
    COALESCE(AVG(NULLIF(gaji_pertama,0)),0) as avg_gaji,
    SUM(CASE WHEN status_pekerjaan = 'Bekerja' THEN 1 ELSE 0 END) as jumlah_bekerja
  FROM tracer_study
";
$stats_row = $conn->query($sql_stats);
$stats = $stats_row ? $stats_row->fetch_assoc() : ['total_alumni'=>0,'avg_tunggu'=>0,'avg_gaji'=>0,'jumlah_bekerja'=>0];
?>


<div class="color-bg" aria-hidden="true">
  <div class="color c1"></div>
  <div class="color c2"></div>
  <div class="color c3"></div>
</div>

<section class="container" style="padding-top:28px;z-index:5;position:relative;">
  <!-- HERO / header short -->
  <div class="hero-alumni fade">
    <h1>Tracer Study — Alumni FIKOM</h1>
    <p class="muted">Pantau perkembangan karir alumni, masa tunggu, dan statistik penting lulusan Fakultas Ilmu Komputer.</p>

    <!-- Stats -->
    <div class="stats-grid-alumni" style="margin-top:20px;">
      <div class="stat-card-alumni fade">
        <div class="icon"><i class="fas fa-user-graduate" aria-hidden="true"></i></div>
        <h3><?php echo number_format((int)$stats['total_alumni']); ?></h3>
        <p>Total Alumni</p>
      </div>

      <div class="stat-card-alumni fade">
        <div class="icon"><i class="fas fa-briefcase" aria-hidden="true"></i></div>
        <h3><?php echo number_format((int)$stats['jumlah_bekerja']); ?></h3>
        <p>Alumni Bekerja</p>
      </div>

      <div class="stat-card-alumni fade">
        <div class="icon"><i class="fas fa-clock" aria-hidden="true"></i></div>
        <h3><?php echo $stats['avg_tunggu'] ? number_format(floatval($stats['avg_tunggu']),1) : '0'; ?> Bln</h3>
        <p>Rata-rata Masa Tunggu</p>
      </div>

      <div class="stat-card-alumni fade">
        <div class="icon"><i class="fas fa-money-bill-wave" aria-hidden="true"></i></div>
        <h3>Rp <?php echo $stats['avg_gaji'] ? number_format(floatval($stats['avg_gaji'])/1000000,1) : '0'; ?> Jt</h3>
        <p>Rata-rata Gaji Pertama</p>
      </div>
    </div>
  </div>

  <!-- Title -->
  <div style="margin-top:24px;" class="fade">
    <h2 style="margin:0 0 8px;">Daftar Alumni</h2>
    <p class="muted" style="margin:0 0 18px;">Klik nama untuk melihat detail (fitur detail bisa ditambahkan nanti).</p>
  </div>

  <!-- Alumni grid / cards -->
  <?php if ($result && $result->num_rows > 0): ?>
    <div class="alumni-grid" id="alumniGrid">
      <?php while($row = $result->fetch_assoc()): 
        // sanitize
        $nama = htmlspecialchars($row['nama_alumni']);
        $prodi = htmlspecialchars($row['prodi'] ?? '');
        $tahun = htmlspecialchars($row['tahun_lulus'] ?? '');
        $status = htmlspecialchars($row['status_pekerjaan'] ?? '');
        $kesesuaian = htmlspecialchars($row['kesesuaian_kerja'] ?? '');
        // map status to class
        $status_key = 'status-lain';
        $s = strtolower(trim($status));
        if ($s === 'bekerja') $status_key = 'status-bekerja';
        elseif ($s === 'wirausaha') $status_key = 'status-wirausaha';
        elseif (strpos($s,'lanjut') !== false || $s === 'melanjutkan studi') $status_key = 'status-melanjutkan';

        // initials fallback (if no foto column available). You can plug image URL if DB has it.
        $initials = '';
        $parts = preg_split('/\s+/', $row['nama_alumni']);
        if ($parts && count($parts) > 0) {
          foreach(array_slice($parts,0,2) as $p) $initials .= strtoupper(substr($p,0,1));
        }
        if ($initials === '') $initials = 'AL';
      ?>
        <article class="alumni-card fade">
          <div class="alumni-top">
            <div class="alumni-photo" aria-hidden="true">
              <?php
                // If you have photo URL column e.g. $row['photo_url'], replace below logic
                echo $initials;
              ?>
            </div>

            <div class="alumni-info">
              <h4 title="<?php echo $nama; ?>"><?php echo $nama; ?></h4>
              <div class="prodi"><?php echo $prodi; ?></div>
              <div class="muted">Angkatan <?php echo $tahun; ?></div>
            </div>

            <div class="right">
              <div class="status-pill <?php echo $status_key; ?>"><?php echo $status; ?></div>
            </div>
          </div>

          <div class="alumni-quote">
            <?php
              // smart short description
              if (strtolower($status) === 'bekerja' && strtolower($kesesuaian) === 'sesuai') {
                echo "Bekerja sesuai bidang keahlian.";
              } elseif (strtolower($status) === 'wirausaha') {
                echo "Mengembangkan usaha mandiri.";
              } elseif (strtolower($status) === 'melanjutkan studi' || stripos($status,'lanjut') !== false) {
                echo "Melanjutkan ke jenjang pendidikan lebih tinggi.";
              } elseif (strtolower($status) === 'bekerja') {
                echo "Berkontribusi di dunia profesional.";
              } else {
                echo "Alumni aktif dan berprestasi.";
              }
            ?>
          </div>
        </article>
      <?php endwhile; ?>
    </div>

  <?php else: ?>
    <div class="empty-state fade">
      <p><strong>Belum ada data alumni.</strong></p>
      <p>Silakan tambahkan data tracer study melalui form.</p>
      <p style="margin-top:12px;"><a href="https://tracerstudy.kemdikbud.go.id/kuesioner" class="btn">Isi Form Tracer Study</a></p>
    </div>
  <?php endif; ?>

</section>

<?php
// tutup koneksi dan panggil footer
$conn->close();
include 'includes/footer.php';
?>
