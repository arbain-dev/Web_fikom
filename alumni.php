<?php
// File: alumni.php
// Panggil header (harus memuat <head>, font & FontAwesome ideally)
include 'includes/header.php';

// -- Database connection (sesuaikan credential jika perlu)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_web_fikom";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("<div style='padding:20px;background:#fee;border:1px solid #f99;'>Connection failed: " . htmlspecialchars($conn->connect_error) . "</div>");
}
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

<style>
  :root{
    --bg-1:#051636;
    --bg-2:#020d20;
    --glass-bg: rgba(255,255,255,0.06);
    --glass-border: rgba(255,255,255,0.12);
    --accent: #3498db;
    --accent-2: #f1c40f;
    --muted: rgba(255,255,255,0.7);
    --card-shadow: 0 10px 30px rgba(2,6,23,0.6);
    --radius: 14px;
    --max-width: 1200px;
    font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
  }

  /* page base */
  html,body{height:100%;margin:0;background:linear-gradient(135deg,var(--bg-1),var(--bg-2));color:#fff;-webkit-font-smoothing:antialiased;}
  .container{width:90%;max-width:var(--max-width);margin:0 auto;padding:28px 12px;}

  /* soft glowing blobs (background) */
  .color-bg{position:fixed;inset:0;z-index:0;pointer-events:none}
  .color-bg .color{position:absolute;border-radius:50%;filter:blur(160px);opacity:0.25;transform:translateZ(0)}
  .color-bg .c1{width:600px;height:600px;left:-200px;top:-200px;background:#ff359b}
  .color-bg .c2{width:500px;height:500px;right:-120px;bottom:-120px;background:#00d2ff}
  .color-bg .c3{width:420px;height:420px;left:80px;bottom:-150px;background:#ffd76b}

  /* hero */
  .hero{position:relative;z-index:5;background:var(--glass-bg);backdrop-filter:blur(8px);border:1px solid var(--glass-border);box-shadow:var(--card-shadow);border-radius:18px;padding:60px 28px;margin-top:24px}
  .hero h1{font-size:2.6rem;margin:0 0 8px}
  .hero p{color:var(--muted);margin:0 0 16px}

  /* stats */
  .stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:18px;margin:28px 0}
  .stat-card{background:linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02));border-radius:12px;padding:18px;border:1px solid var(--glass-border);box-shadow:0 6px 22px rgba(0,0,0,0.5);text-align:center}
  .stat-card .icon{width:56px;height:56px;border-radius:50%;display:inline-grid;place-items:center;margin:0 auto 10px;background:linear-gradient(135deg,var(--accent),#0d5bb9);font-size:20px}
  .stat-card h3{font-size:1.8rem;margin:6px 0;color:var(--accent-2)}
  .stat-card p{color:var(--muted);margin:0}

  /* alumni cards grid */
  .alumni-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:20px;margin-top:18px}
  .alumni-card{position:relative;background:linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02));border-radius:12px;padding:18px;border:1px solid var(--glass-border);box-shadow:0 12px 30px rgba(0,0,0,0.6);overflow:hidden;transition:transform .28s,box-shadow .28s}
  .alumni-card:hover{transform:translateY(-8px);box-shadow:0 22px 60px rgba(0,0,0,0.7)}
  .alumni-top{display:flex;gap:14px;align-items:center;margin-bottom:10px}
  .alumni-photo{width:84px;height:84px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:28px;color:#fff;border:3px solid rgba(255,255,255,0.08);box-shadow:0 10px 30px rgba(0,0,0,0.5);background:linear-gradient(135deg,var(--accent),#9b59ff)}
  .alumni-info h4{margin:0;font-size:1.05rem}
  .alumni-info .prodi{color:var(--accent-2);font-weight:600;margin-top:6px}
  .alumni-meta{margin-top:12px;display:flex;gap:8px;flex-wrap:wrap;align-items:center}
  .status-pill{padding:6px 12px;border-radius:999px;font-size:0.85rem;font-weight:700;border:1px solid rgba(255,255,255,0.08)}
  .status-bekerja{background:rgba(46,204,113,0.12);color:#2ecc71;border-color:#2ecc71}
  .status-wirausaha{background:rgba(241,196,15,0.12);color:var(--accent-2);border-color:var(--accent-2)}
  .status-melanjutkan{background:rgba(155,89,182,0.12);color:#9b59b6;border-color:#9b59b6}
  .status-lain{background:rgba(255,255,255,0.04);color:var(--muted);border-color:rgba(255,255,255,0.06)}

  .alumni-quote{margin-top:12px;color:var(--muted);font-size:0.95rem}

  /* empty state */
  .empty-state{padding:28px;border-radius:12px;background:rgba(255,255,255,0.03);border:1px solid var(--glass-border);text-align:center;color:var(--muted);}

  /* small helpers */
  .muted{color:var(--muted)}
  .right{margin-left:auto}
  a.btn{display:inline-block;background:var(--accent);color:#fff;padding:10px 16px;border-radius:10px;text-decoration:none;font-weight:700}

  /* animation helpers (use class .show to reveal) */
  .fade{opacity:0;transform:translateY(18px);transition:all .6s cubic-bezier(.2,.9,.2,1)}
  .fade.show{opacity:1;transform:none}

  @media (max-width:800px){
    .hero{padding:36px 16px}
    .hero h1{font-size:1.8rem}
    .alumni-top{align-items:flex-start}
  }
</style>

<div class="color-bg" aria-hidden="true">
  <div class="color c1"></div>
  <div class="color c2"></div>
  <div class="color c3"></div>
</div>

<section class="container" style="padding-top:28px;z-index:5;position:relative;">
  <!-- HERO / header short -->
  <div class="hero fade">
    <h1>Tracer Study — Alumni FIKOM</h1>
    <p class="muted">Pantau perkembangan karir alumni, masa tunggu, dan statistik penting lulusan Fakultas Ilmu Komputer.</p>

    <!-- Stats -->
    <div class="stats-grid" style="margin-top:20px;">
      <div class="stat-card fade">
        <div class="icon"><i class="fas fa-user-graduate" aria-hidden="true"></i></div>
        <h3><?php echo number_format((int)$stats['total_alumni']); ?></h3>
        <p>Total Alumni</p>
      </div>

      <div class="stat-card fade">
        <div class="icon"><i class="fas fa-briefcase" aria-hidden="true"></i></div>
        <h3><?php echo number_format((int)$stats['jumlah_bekerja']); ?></h3>
        <p>Alumni Bekerja</p>
      </div>

      <div class="stat-card fade">
        <div class="icon"><i class="fas fa-clock" aria-hidden="true"></i></div>
        <h3><?php echo $stats['avg_tunggu'] ? number_format(floatval($stats['avg_tunggu']),1) : '0'; ?> Bln</h3>
        <p>Rata-rata Masa Tunggu</p>
      </div>

      <div class="stat-card fade">
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

<script>
  // IntersectionObserver reveal (adds class .show by toggling inline class)
  document.addEventListener('DOMContentLoaded', function(){
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('show');
          // add small timeout to chain animations nicely
          entry.target.style.transitionDelay = (entry.target.datasetDelay || '0') + 's';
          obs.unobserve(entry.target);
        }
      });
    }, {threshold: 0.12});

    // observe elements with class fade
    const fades = document.querySelectorAll('.fade');
    fades.forEach((el, idx) => {
      // small stagger
      el.datasetDelay = (idx * 0.04).toFixed(2);
      observer.observe(el);
    });

    // simple parallax for color blobs
    const colors = document.querySelectorAll('.color-bg .color');
    let ticking = false;
    window.addEventListener('scroll', () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          const y = window.scrollY;
          colors.forEach((c, i) => {
            const speed = 0.08 + i*0.06;
            c.style.transform = `translateY(${y * speed}px)`;
          });
          ticking = false;
        });
        ticking = true;
      }
    }, {passive:true});
  });
</script>

<?php
// tutup koneksi dan panggil footer
$conn->close();
include 'includes/footer.php';
?>
