<?php
// ==========================================================
// BAGIAN 1: LOGIKA & KEAMANAN (WAJIB DI PALING ATAS)
// ==========================================================

session_start(); 
// PENTING: Pastikan path ke 'db_connect.php' ini betul
require_once '../database/db_connect.php'; 

// Logika Logout
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $_SESSION = array();
    session_destroy();
    // (Asumsi login.php ada di folder yang sama)
    header("Location: login.php?status=logout_sukses"); 
    exit;
}

// Cek login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // (Asumsi login.php ada di folder yang sama)
    header("Location: login.php"); 
    exit; 
}

// (Ambil data admin untuk sapaan, dll)
$nama_admin = $_SESSION['username'] ?? "Admin";
$currentPage = basename($_SERVER['PHP_SELF']);

// ==========================================================
// LOGIKA PENGAMBILAN DATA DASHBOARD
// ==========================================================

// 1. Jumlah Dosen
$q_dosen = $conn->query("SELECT COUNT(id) as total FROM dosen");
$total_dosen = ($q_dosen && $q_dosen->num_rows > 0) ? $q_dosen->fetch_assoc()['total'] : 0;

// 2. Jumlah Penelitian & Pengabdian (PERBAIKAN DARI KODE-TA')
$sql_penelitian_pengabdian = "(SELECT id FROM penelitian) UNION ALL (SELECT id FROM pengabdian)";
$q_penelitian = $conn->query("SELECT COUNT(*) as total FROM ($sql_penelitian_pengabdian) as gabungan");
if ($q_penelitian === false) {
    die("Query GAGAL: Cek apakah tabel 'penelitian' dan 'pengabdian' sudah ada. Error: " . $conn->error);
}
// Variabel-ta' di sini sudah saya perbaiki (q_penelitian, bukan q_pengabdian)
$total_penelitian = ($q_penelitian && $q_penelitian->num_rows > 0) ? $q_penelitian->fetch_assoc()['total'] : 0;

// 3. Jumlah Ruangan & Lab
$sql_ruangan_lab = "(SELECT id FROM ruangan) UNION ALL (SELECT id FROM laboratorium)";
$q_ruangan = $conn->query("SELECT COUNT(*) as total FROM ($sql_ruangan_lab) as gabungan");
if ($q_ruangan === false) {
    die("Query GAGAL: Cek apakah tabel 'ruangan' dan 'laboratorium' sudah ada. Error: " . $conn->error);
}
$total_ruangan = ($q_ruangan && $q_ruangan->num_rows > 0) ? $q_ruangan->fetch_assoc()['total'] : 0;

// 4. Daftar 5 Penelitian Terbaru
$penelitian_list = [];
$sql_penelitian = "SELECT * FROM penelitian ORDER BY tahun DESC, tanggal_mulai DESC LIMIT 5"; 
$result_penelitian = $conn->query($sql_penelitian);

if ($result_penelitian && $result_penelitian->num_rows > 0) {
    while($row = $result_penelitian->fetch_assoc()) { 
        $penelitian_list[] = $row; 
    }
}

include 'includes/admin_header.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-bg: #2c3e50;
            --sidebar-active: #3498db;
            --main-bg: #f4f7f6;
            --card-pink: #f56e8d;
            --card-purple: #8e65f3;
            --card-blue: #36a2eb;
            --card-teal: #4bc0c0;
            --text-dark: #333;
            --text-light: #ecf0f1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--main-bg);
            color: var(--text-dark);
        }
        
        /* Submenu */
        .submenu {
            list-style: none;
            padding-left: 25px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        .submenu a {
            font-size: 0.9rem;
            padding: 10px 15px;
            color: #bdc3c7;
        }
        .submenu a:hover {
            color: #fff;
            background-color: rgba(255,255,255,0.1);
        }
        li.open > .submenu {
            max-height: 500px; /* Buka submenu */
        }
        li.open > a .arrow {
            transform: rotate(90deg); /* Putar panah */
        }

        /* === MAIN CONTENT === */
        .main-content {
            margin-left: 260px;
            transition: margin-left 0.3s ease;
        }

        /* === TOPBAR === */
        .topbar {
            background-color: #fff;
            padding: 0 30px;
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 900;
        }
        .topbar-left { display: flex; align-items: center; gap: 20px; }
        .hamburger {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-dark);
        }
        .topbar-right { display: flex; align-items: center; gap: 25px; }
        .topbar-icon { font-size: 1.2rem; color: #555; cursor: pointer; }
        .user-profile { display: flex; align-items: center; gap: 10px; }
        .user-profile img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }
        .user-profile span { font-weight: 500; }

        /* === CONTENT AREA === */
        .content-area { padding: 30px; }
        .breadcrumbs { margin-bottom: 20px; font-size: 0.9rem; color: #777; }
        .breadcrumbs a { color: var(--sidebar-active); text-decoration: none; }

        /* Stat Cards */
        .stat-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .card {
            color: #fff;
            padding: 25px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-pink { background: linear-gradient(135deg, #f78ca0 0%, var(--card-pink) 100%); }
        .card-purple { background: linear-gradient(135deg, #ab87f5 0%, var(--card-purple) 100%); }
        .card-blue { background: linear-gradient(135deg, #6bc1f0 0%, var(--card-blue) 100%); }
        .card-teal { background: linear-gradient(135deg, #66d9d9 0%, var(--card-teal) 100%); }
        
        .card h5 { font-size: 0.9rem; font-weight: 500; opacity: 0.9; margin-bottom: 5px; }
        .card h2 { font-size: 2.2rem; }
        .card p { font-size: 0.85rem; opacity: 0.8; }
        .card-icon { font-size: 3rem; opacity: 0.3; }

        /* Main Grid (Charts, Tables) */
        .main-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
        }
        .content-box {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            overflow-x: auto; 
        }
        .box-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .box-header h4 { font-size: 1.2rem; }
        .box-header i { color: #999; cursor: pointer; }
        
        /* Tabel */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th, .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
            white-space: nowrap; /* Biar tidak terpotong */
        }
        .data-table thead th {
            background-color: #f9fafb;
            font-weight: 600;
        }
        .data-table tbody tr:hover { background-color: #fcfcfc; }
        
        /* CSS UNTUK STATUS PROYEK */
        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .status.selesai { background-color: #e0f8f0; color: #10b981; }
        .status.proses { background-color: #fff7e6; color: #f59e0b; }

        /* === RESPONSIVE === */
        @media (max-width: 992px) {
            .sidebar {
                left: -260px;
            }
            .sidebar.active {
                left: 0;
            }
            .main-content {
                margin-left: 0;
            }
            .hamburger {
                display: block;
            }
        }
        @media (max-width: 576px) {
            .topbar { padding: 0 15px; }
            .content-area { padding: 15px; }
            .stat-cards { grid-template-columns: 1fr; }
            .main-grid { grid-template-columns: 1fr; }
            .user-profile span { display: none; }
        }
    </style>
</head>
<body>

    <main class="content-area">
        <div class="breadcrumbs">
            <a href="#">Admin</a> &gt; <span>Dashboard</span>
        </div>

        <div class="stat-cards">
            <div class="card card-pink">
                <div class="card-info">
                    <h5>Jumlah Dosen</h5>
                    <h2><?= $total_dosen ?></h2>
                </div>
                <div class="card-icon">
                    <i class="fas fa-users"></i> 
                </div>
            </div>
            <div class="card card-purple">
                <div class="card-info">
                    <h5>Jumlah Penelitian & Pengabdian</h5>
                    <h2><?= $total_penelitian ?></h2>
                </div>
                <div class="card-icon">
                    <i class="fas fa-user-graduate"></i> 
                </div>
            </div>
            <div class="card card-blue">
                <div class="card-info">
                    <h5>Jumlah Ruangan & Lab</h5>
                    <h2><?= $total_ruangan ?></h2>
                </div>
                <div class="card-icon">
                    <i class="fas fa-door-open"></i> 
                </div>
            </div>
        </div>

        <div class="main-grid">
            <div class="content-box" style="grid-column: 1 / -1;">
                <div class="box-header">
                    <h4>Dosen yang Meneliti (5 Terbaru)</h4>
                    <i class="fas fa-ellipsis-h"></i>
                </div>
                
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Judul Penelitian</th>
                            <th>Peneliti</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Sumber Dana</th>
                            <th>Link Publikasi</th> </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($penelitian_list) > 0): ?>
                            <?php foreach ($penelitian_list as $penelitian): ?>
                            <tr>
                                <td><?= htmlspecialchars($penelitian['judul']) ?></td>
                                <td><?= htmlspecialchars($penelitian['peneliti']) ?></td>
                                <td><?= htmlspecialchars($penelitian['tahun']) ?></td>
                                <td>
                                    <?php 
                                    // Sesuaikan CSS Badge Status
                                    $status_class = 'proses'; // default
                                    if (strtolower($penelitian['status']) == 'selesai') $status_class = 'selesai';
                                    ?>
                                    <span class="status <?= $status_class ?>">
                                        <?= htmlspecialchars($penelitian['status']) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($penelitian['sumber_dana']) ?></td>
                            <td>
                                    <?php if (!empty($penelitian['link_publikasi'])): ?>
                                        <a href="<?= htmlspecialchars($penelitian['link_publikasi']) ?>" target="_blank" class="link-publikasi">
                                            Lihat Link <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    <?php else: ?>
                                        - <?php endif; ?>
                                </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">Belum ada data penelitian.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    </div> 
</body>
</html>