<?php
/**
 * Admin Dashboard - Main Overview Page
 * Clean & Modern Design
 */

// Include admin header (handles session, security, and config)
include 'includes/admin_header.php';

// Fetch dashboard data
$q_dosen = $conn->query("SELECT COUNT(id) as total FROM dosen");
$total_dosen = ($q_dosen && $q_dosen->num_rows > 0) ? $q_dosen->fetch_assoc()['total'] : 0;

$q_berita = $conn->query("SELECT COUNT(id) as total FROM berita");
$total_berita = ($q_berita && $q_berita->num_rows > 0) ? $q_berita->fetch_assoc()['total'] : 0;

$sql_penelitian_pengabdian = "(SELECT id FROM penelitian) UNION ALL (SELECT id FROM pengabdian)";
$q_penelitian = $conn->query("SELECT COUNT(*) as total FROM ($sql_penelitian_pengabdian) as gabungan");
$total_penelitian = ($q_penelitian && $q_penelitian->num_rows > 0) ? $q_penelitian->fetch_assoc()['total'] : 0;

$sql_ruangan_lab = "(SELECT id FROM ruangan) UNION ALL (SELECT id FROM laboratorium)";
$q_ruangan = $conn->query("SELECT COUNT(*) as total FROM ($sql_ruangan_lab) as gabungan");
$total_ruangan = ($q_ruangan && $q_ruangan->num_rows > 0) ? $q_ruangan->fetch_assoc()['total'] : 0;

// Get recent penelitian
$penelitian_list = [];
$result_penelitian = $conn->query("SELECT * FROM penelitian ORDER BY tahun DESC, tanggal_mulai DESC LIMIT 5");
if ($result_penelitian && $result_penelitian->num_rows > 0) {
    while($row = $result_penelitian->fetch_assoc()) {
        $penelitian_list[] = $row;
    }
}

// Get recent berita
$berita_list = [];
$result_berita = $conn->query("SELECT * FROM berita ORDER BY tanggal_publish DESC LIMIT 5");
if ($result_berita && $result_berita->num_rows > 0) {
    while($row = $result_berita->fetch_assoc()) {
        $berita_list[] = $row;
    }
}
?>

<div class="breadcrumbs">
    <a href="dashboard.php">Dashboard</a>
</div>

<h1 class="page-title">Dashboard</h1>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon pink">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3><?= $total_dosen ?></h3>
            <p>Total Dosen</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon purple">
            <i class="fas fa-newspaper"></i>
        </div>
        <div class="stat-info">
            <h3><?= $total_berita ?></h3>
            <p>Total Berita</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fas fa-flask"></i>
        </div>
        <div class="stat-info">
            <h3><?= $total_penelitian ?></h3>
            <p>Penelitian & Pengabdian</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon teal">
            <i class="fas fa-building"></i>
        </div>
        <div class="stat-info">
            <h3><?= $total_ruangan ?></h3>
            <p>Ruangan & Lab</p>
        </div>
    </div>
</div>

<!-- Recent Content -->
<div class="dashboard-content-grid">
    
    <!-- Recent Berita -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Berita Terbaru</h2>
            <a href="admin_kelola_berita.php" class="btn btn-sm btn-outline">Lihat Semua</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($berita_list)): ?>
                    <?php foreach ($berita_list as $b): ?>
                    <tr>
                        <td><?= htmlspecialchars(substr($b['judul'], 0, 40)) ?>...</td>
                        <td><?= date('d M Y', strtotime($b['tanggal_publish'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="text-center text-muted">Belum ada berita</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Recent Penelitian -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Penelitian Terbaru</h2>
            <a href="admin_kelola_penelitian.php" class="btn btn-sm btn-outline">Lihat Semua</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tahun</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($penelitian_list)): ?>
                    <?php foreach ($penelitian_list as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars(substr($p['judul'], 0, 40)) ?>...</td>
                        <td><?= $p['tahun'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="text-center text-muted">Belum ada penelitian</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/admin_footer.php'; ?>
