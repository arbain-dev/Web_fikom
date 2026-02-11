<?php
require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';

// Prepare stats data
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

<!-- Header/Hero Section -->
<header class="page-header-section">
    <div class="container reveal-on-scroll">
        <h1 class="page-title">Alumni & Tracer Study</h1>
        <p class="page-subtitle">Pusat data dan informasi sebaran alumni Fakultas Ilmu Komputer. Mari berkontribusi untuk pengembangan akademik yang lebih baik.</p>
    </div>
</header>
        <!-- CTA Section -->
        <div class="cta-section fade-in-up delay-5" style="margin-top: 80px; text-align: center; background: white; padding: 60px; border-radius: var(--radius-2xl); border: 1px solid var(--gray-200);">
            <div style="max-width: 600px; margin: 0 auto;">
                <div style="width: 80px; height: 80px; background: var(--primary-100); color: var(--primary-600); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 24px;">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h2 style="font-size: 2rem; font-weight: 700; color: var(--gray-900); margin-bottom: 16px;">
                    Anda Alumni FIKOM?
                </h2>
                <p style="font-size: 1.125rem; color: var(--gray-600); margin-bottom: 32px; line-height: 1.6;">
                    Bantu kami meningkatkan kualitas pendidikan dengan mengisi kuesioner Tracer Study. 
                    Data Anda sangat berharga untuk akreditasi dan pengembangan fakultas.
                </p>
                <a href="https://tracerstudy.kemdikbud.go.id/kuesioner" target="_blank" class="btn btn-primary btn-lg" style="padding: 16px 48px; font-size: 1.125rem; border-radius: 50px; box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);">
                    <i class="fas fa-pen-to-square" style="margin-right: 8px;"></i> Isi Form Tracer Study
                </a>
                <p style="margin-top: 16px; font-size: 0.875rem; color: var(--gray-500);">
                    <i class="fas fa-lock" style="margin-right: 4px;"></i> Data Anda aman dan terlindungi
                </p>
            </div>
        </div>

    </div>
</section>

<?php
$conn->close();
include 'includes/footer.php';
?>
