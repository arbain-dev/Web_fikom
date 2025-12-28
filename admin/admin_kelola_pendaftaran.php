<?php
session_start();

include 'includes/admin_header.php';
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
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

    <div class="breadcrumbs">
        <a href="dashboard.php">Admin</a> &gt; <span>Data Pendaftaran</span>
    </div>

    <div class="page-header">
        <h1>Data Pendaftaran Mahasiswa</h1>
    </div>

    <?php if (!empty($message)): ?>
        <div class="kb-alert kb-alert-<?= $msg_type; ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <div class="content-box">
        <table class="data-table kb-data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>HP/WA</th>
                    <th>Tanggal Daftar</th>
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
                        <small>NIK: <?= htmlspecialchars($row['nik']) ?></small>
                    </td>
                    <td><?= htmlspecialchars($row['prodi']) ?> (<?= htmlspecialchars($row['jalur']) ?>)</td>
                    <td>
                        <a href="https://wa.me/<?= preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $row['hp'])) ?>" target="_blank">
                            <i class="fab fa-whatsapp"></i> <?= htmlspecialchars($row['hp']) ?>
                        </a>
                    </td>
                    <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="update_status">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <select name="status" onchange="this.form.submit()" style="padding:4px;border-radius:4px;
                                background: <?= $row['status']=='Diterima'?'#d4edda':($row['status']=='Ditolak'?'#f8d7da':'#fff3cd') ?>;">
                                <option value="Pending" <?= $row['status']=='Pending'?'selected':'' ?>>Pending</option>
                                <option value="Diterima" <?= $row['status']=='Diterima'?'selected':'' ?>>Diterima</option>
                                <option value="Ditolak" <?= $row['status']=='Ditolak'?'selected':'' ?>>Ditolak</option>
                            </select>
                        </form>
                    </td>
                    <td class="action-links">
                        <button onclick='lihatDetail(<?= json_encode($row) ?>)' class="btn-sm btn-info" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                        <a href="?action=hapus&id=<?= $row['id'] ?>" onclick="return confirm('Hapus data ini?')" class="delete" title="Hapus"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="7" style="text-align:center">Belum ada data pendaftaran</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<!-- Modal Detail -->
<div class="kb-popup-bg" id="modalDetail">
    <div class="kb-popup-box" style="max-width:600px;">
        <div class="kb-popup-header">
            <h2 id="detailNama">Detail Pendaftar</h2>
            <button class="kb-popup-close-x" onclick="tutupDetail()">×</button>
        </div>
        <div class="kb-popup-body" style="padding:20px; overflow-y:auto; max-height:70vh;">
            <table style="width:100%; border-collapse:collapse;" id="tableDetail">
                <!-- Content via JS -->
            </table>
        </div>
    </div>
</div>

<script>
function lihatDetail(data) {
    const table = document.getElementById('tableDetail');
    let html = '';
    const fields = {
        'Nama Lengkap': data.nama,
        'NIK': data.nik,
        'Email': data.email,
        'No HP': data.hp,
        'TTL': data.tempat_lahir + ', ' + data.tanggal_lahir,
        'Jenis Kelamin': data.jk,
        'Asal Sekolah': data.asal_sekolah,
        'Prodi Pilihan': data.prodi,
        'Jalur Masuk': data.jalur,
        'Alamat': data.alamat,
        'Catatan': data.catatan,
        'Status': data.status,
        'Tanggal Daftar': data.created_at
    };

    for (let key in fields) {
        html += `<tr>
            <td style="padding:8px; border-bottom:1px solid #eee; width:150px; font-weight:bold;">${key}</td>
            <td style="padding:8px; border-bottom:1px solid #eee;">${fields[key] || '-'}</td>
        </tr>`;
    }

    // Files
    html += `<tr>
        <td style="padding:8px; font-weight:bold;">Dokumen</td>
        <td style="padding:8px;">`;
    
    if(data.file_ktp) {
        html += `<a href="../uploads/pendaftaran/${data.file_ktp}" target="_blank" class="btn-sm btn-info" style="margin-right:5px;">Lihat KTP</a>`;
    } else {
        html += `<span style="color:red; margin-right:5px;">KTP Kosong</span>`;
    }

    if(data.file_ijazah) {
        html += `<a href="../uploads/pendaftaran/${data.file_ijazah}" target="_blank" class="btn-sm btn-info">Lihat Ijazah</a>`;
    } else {
        html += `<span style="color:red;">Ijazah Kosong</span>`;
    }
    
    html += `</td></tr>`;

    table.innerHTML = html;
    document.getElementById('modalDetail').style.display = 'flex';
}

function tutupDetail() {
    document.getElementById('modalDetail').style.display = 'none';
}
</script>

<?php include 'includes/admin_footer.php'; ?>
