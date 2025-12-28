<?php
session_start();

require_once '../config/database.php';
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$message = '';
$message_type = '';
$upload_dir = '../uploads/labolatorium/';

// 1️⃣ LOGIKA TAMBAH / EDIT / HAPUS
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];
    $lab_id = intval($_POST['lab_id'] ?? 0);
    $nama = $_POST['nama'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $current_foto = $_POST['current_foto'] ?? NULL;
    $nama_foto_db = $current_foto;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0 && !empty($_FILES['foto']['name'])) {
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png']) && $_FILES['foto']['size'] <= 2000000) {
            $nama_foto_db = time() . '-' . uniqid() . '.' . $ext;
            $target = $upload_dir . $nama_foto_db;
            move_uploaded_file($_FILES['foto']['tmp_name'], $target);
            if ($action == 'edit_lab' && $current_foto && file_exists($upload_dir . $current_foto)) {
                unlink($upload_dir . $current_foto);
            }
        }
    }

    // === TAMBAH ===
    if ($action == 'tambah_lab') {
        $stmt = $conn->prepare("INSERT INTO laboratorium (nama_lab, deskripsi, foto) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $deskripsi, $nama_foto_db);
        $stmt->execute();
        header("Location: admin_kelola_lab.php?status=tambah_sukses");
        exit;
    }

    // === EDIT ===
    elseif ($action == 'edit_lab' && $lab_id > 0) {
        $stmt = $conn->prepare("UPDATE laboratorium SET nama_lab=?, deskripsi=?, foto=? WHERE id=?");
        $stmt->bind_param("sssi", $nama, $deskripsi, $nama_foto_db, $lab_id);
        $stmt->execute();
        header("Location: admin_kelola_lab.php?status=edit_sukses");
        exit;
    }

    // === HAPUS ===
    elseif ($action == 'hapus_lab' && $lab_id > 0) {
        // Ambil data lama
        $foto_old = $conn->query("SELECT foto FROM laboratorium WHERE id=$lab_id")->fetch_assoc()['foto'] ?? '';
        if ($foto_old && file_exists($upload_dir . $foto_old)) unlink($upload_dir . $foto_old);
        $conn->query("DELETE FROM laboratorium WHERE id=$lab_id");
        header("Location: admin_kelola_lab.php?status=hapus_sukses");
        exit;
    }
}

// ==========================================================
// 2️⃣ NOTIFIKASI
// ==========================================================
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'tambah_sukses': $message = "Lab berhasil ditambahkan!"; $message_type = "success"; break;
        case 'edit_sukses': $message = "Lab berhasil diperbarui!"; $message_type = "success"; break;
        case 'hapus_sukses': $message = "Lab berhasil dihapus."; $message_type = "success"; break;
    }
}

// ==========================================================
// 3️⃣ AMBIL DATA LAB
// ==========================================================
$lab_list = [];
$result = $conn->query("SELECT * FROM laboratorium ORDER BY id DESC");
if ($result) while ($row = $result->fetch_assoc()) $lab_list[] = $row;
$conn->close();

include 'includes/admin_header.php';
?>


    <div class="breadcrumbs"><a href="dashboard.php">Admin</a> &gt; <span>Fasilitas</span> &gt; <span>Lab Komputer</span></div>

    <div class="page-header">
        <h1>Kelola Lab Komputer</h1>
        <button class="btn-tambah" id="openModalBtn"><i class="fas fa-plus"></i> Tambah Lab</button>
    </div>

    <?php if ($message): ?>
        <div class="message <?= $message_type ?>"><?= $message ?></div>
    <?php endif; ?>

    <div class="content-box">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Lab</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($lab_list): $no=1; foreach ($lab_list as $lab): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><img src="<?= $upload_dir . ($lab['foto'] ?: 'default-placeholder.png') ?>" class="table-foto"></td>
                        <td><?= htmlspecialchars($lab['nama_lab']) ?></td>
                        <td><?= htmlspecialchars(substr($lab['deskripsi'], 0, 100)) ?><?= strlen($lab['deskripsi'])>100?'...':'' ?></td>
                        <td class="action-buttons">
                            <a href="#" class="edit" onclick="openEditModal(<?= $lab['id'] ?>)"><i class="fas fa-edit"></i></a>
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus lab ini?')">
                                <input type="hidden" name="lab_id" value="<?= $lab['id'] ?>">
                                <input type="hidden" name="action" value="hapus_lab">
                                <button type="submit" class="delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="5" style="text-align:center;">Belum ada data laboratorium.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<!-- MODAL -->
<div id="labModal" class="modal">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle">Tambah Lab</h2>
            <span class="close-btn" id="closeModalBtn">&times;</span>
        </div>
        <form id="labForm" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" id="formAction" value="tambah_lab">
            <input type="hidden" name="lab_id" id="labId">
            <input type="hidden" name="current_foto" id="currentFoto">
            <div class="modal-body">
                <div class="input-box">
                    <label>Nama Lab *</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                <div class="input-box">
                    <label>Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi"></textarea>
                </div>
                <div class="foto-preview-box" id="fotoPreviewBox"></div>
                <div class="input-box">
                    <label>Upload Foto (JPG/PNG)</label>
                    <input type="file" id="foto" name="foto" accept="image/png, image/jpeg">
                </div>
            </div>
                <div class="input-box">
                <button type="button" class="btn btn-tutup" id="tutupModalBtnBawah">Tutup</button>
                <button type="submit" class="btn btn-simpan">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    window.labData = <?= json_encode($lab_list) ?>;
</script>
    <?php include 'includes/admin_footer.php'; ?>
