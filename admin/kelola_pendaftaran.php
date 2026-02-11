<?php
session_start();

include 'includes/admin_header.php';
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login");
    exit;
}

$message = "";
$msg_type = "";

// HAPUS
if (isset($_GET['action']) && $_GET['action'] == 'hapus' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Get filenames to delete
    $stmt = $conn->prepare("SELECT file_ktp, file_ijazah FROM pendaftaran WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $files = $res->fetch_assoc();
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM pendaftaran WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        if (!empty($files['file_ktp'])) @unlink("../uploads/pendaftaran/" . $files['file_ktp']);
        if (!empty($files['file_ijazah'])) @unlink("../uploads/pendaftaran/" . $files['file_ijazah']);
        $message = "Data pendaftaran berhasil dihapus!";
        $msg_type = "success";
    } else {
        $message = "Gagal menghapus data.";
        $msg_type = "error";
    }
    $stmt->close();
}

// UPDATE STATUS
if (isset($_POST['action']) && $_POST['action'] == 'update_status') {
    $id = intval($_POST['id']);
    $status = $_POST['status'];
    
    $stmt = $conn->prepare("UPDATE pendaftaran SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    if ($stmt->execute()) {
        $message = "Status berhasil diperbarui!";
        $msg_type = "success";
    } else {
        $message = "Gagal update status.";
        $msg_type = "error";
    }
    $stmt->close();
}

$result = $conn->query("SELECT * FROM pendaftaran ORDER BY created_at DESC");
$pendaftar_list = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) $pendaftar_list[] = $row;
}
?>

    <!-- Banner Ungu -->
    <div class="page-banner">
        <h1 class="banner-title">Data Pendaftaran Mahasiswa</h1>
    </div>

    <?php if (!empty($message)): ?>
        <div class="alert alert-<?= $msg_type == 'success' ? 'success' : 'error' ?> mb-6">
            <?= $message ?>
        </div>
    <?php endif; ?>



    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Daftar Pendaftar</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Prodi & Jalur</th>
                            <th>Kontak</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pendaftar_list)): $i=1; foreach($pendaftar_list as $row): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td>
                                <strong><?= htmlspecialchars($row['nama']) ?></strong><br>
                                <small class="text-muted">NIK: <?= htmlspecialchars($row['nik']) ?></small>
                            </td>
                            <td>
                                <?= htmlspecialchars($row['prodi']) ?><br>
                                <small class="text-muted"><?= htmlspecialchars($row['jalur']) ?></small>
                            </td>
                            <td>
                                <a href="https://wa.me/<?= preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $row['hp'])) ?>" target="_blank" class="text-success">
                                    <i class="fab fa-whatsapp"></i> <?= htmlspecialchars($row['hp']) ?>
                                </a>
                            </td>
                            <td>
                                <form method="POST" class="m-0">
                                    <input type="hidden" name="action" value="update_status">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <select name="status" onchange="this.form.submit()" class="status-select" 
                                        style="background: <?= $row['status']=='Diterima'?'#dcfce7':($row['status']=='Ditolak'?'#fee2e2':'#fef9c3') ?>; 
                                               color: <?= $row['status']=='Diterima'?'#166534':($row['status']=='Ditolak'?'#991b1b':'#854d0e') ?>;
                                               border:1px solid #ddd; padding:4px; border-radius:4px; font-size:12px;">
                                        <option value="Pending" <?= $row['status']=='Pending'?'selected':'' ?>>Pending</option>
                                        <option value="Diterima" <?= $row['status']=='Diterima'?'selected':'' ?>>Diterima</option>
                                        <option value="Ditolak" <?= $row['status']=='Ditolak'?'selected':'' ?>>Ditolak</option>
                                    </select>
                                </form>
                            </td>
                            <td class="action-links">
                                <button class="btn-icon edit btn-detail-pendaftaran" 
                                        data-item='<?= htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') ?>' 
                                        title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="?action=hapus&id=<?= $row['id'] ?>" 
                                   onclick="return confirm('Hapus data ini?')" 
                                   class="btn-icon delete" 
                                   title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="6" class="text-center">Belum ada data pendaftaran.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Modal Detail -->
<div id="modalDetail" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="detailNama">DETAIL PENDAFTAR</h2>
            <span class="close-btn" onclick="tutupDetail()">&times;</span>
        </div>
        
        <div class="modal-body">
            <table class="table-detail" id="tableDetail" style="width:100%; border-collapse: separate; border-spacing: 0;">
                <!-- Content via JS -->
            </table>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="tutupDetail()">Tutup</button>
        </div>
    </div>
</div>

<!-- Data Container for Pendaftaran -->
<div id="pendaftaran-page-data" class="hidden"></div>

<?php include 'includes/admin_footer.php'; ?>

