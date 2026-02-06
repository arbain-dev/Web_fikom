<?php
session_start();

require_once '../config/database.php';
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login");
    exit;
}

$message = '';
$message_type = '';
$upload_dir = '../uploads/labolatorium/';

// 1️⃣ LOGIKA TAMBAH / EDIT / HAPUS
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];
    $lab_id = intval($_POST['lab_id'] ?? 0);
    $nama = $_POST['nama_lab'] ?? ''; // Fix: Match form input name="nama_lab"
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
        header("Location: kelola_lab?status=tambah_sukses");
        exit;
    }

    // === EDIT ===
    elseif ($action == 'edit_lab' && $lab_id > 0) {
        $stmt = $conn->prepare("UPDATE laboratorium SET nama_lab=?, deskripsi=?, foto=? WHERE id=?");
        $stmt->bind_param("sssi", $nama, $deskripsi, $nama_foto_db, $lab_id);
        $stmt->execute();
        header("Location: kelola_lab?status=edit_sukses");
        exit;
    }

    // === HAPUS ===
    elseif ($action == 'hapus_lab' && $lab_id > 0) {
        // Ambil data lama
        $foto_old = $conn->query("SELECT foto FROM laboratorium WHERE id=$lab_id")->fetch_assoc()['foto'] ?? '';
        if ($foto_old && file_exists($upload_dir . $foto_old)) unlink($upload_dir . $foto_old);
        $conn->query("DELETE FROM laboratorium WHERE id=$lab_id");
        header("Location: kelola_lab?status=hapus_sukses");
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


    <!-- Banner Ungu -->
    <div class="page-banner">
        <h1 class="banner-title">Laboratorium</h1>
    </div>

    <?php if ($message): ?>
        <div class="alert alert-<?= $message_type == 'success' ? 'success' : 'error' ?> mb-6">
            <?= $message ?>
        </div>
    <?php endif; ?>



    <!-- Layout Kartu Terpadu -->
    <div class="card">
        <div class="card-header flex-between mb-4">
            <h2 class="card-title">Daftar Lab Komputer</h2>
            <button class="btn btn-primary" id="openModalBtn"><i class="fas fa-plus"></i> Tambah Lab</button>
        </div>


        <div class="card-body">
            <div class="table-responsive">
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
                    <?php if ($lab_list): $i=1; foreach ($lab_list as $lab): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td>
                                <img src="<?= $upload_dir . ($lab['foto'] ?: 'default-placeholder.png') ?>" 
                                     class="table-img-sm" style="width: 100px; height: 60px; object-fit: cover; border-radius: 6px;">
                            </td>
                            <td><?= htmlspecialchars($lab['nama_lab']) ?></td>
                            <td><?= htmlspecialchars($lab['deskripsi']) ?></td>
                            <td class="action-links">
                                <a href="#" class="btn-icon edit btn-edit-lab" 
                                   data-id="<?= $lab['id'] ?>"
                                   data-nama="<?= htmlspecialchars($lab['nama_lab']) ?>"
                                   data-deskripsi="<?= htmlspecialchars($lab['deskripsi']) ?>"
                                   data-foto="<?= htmlspecialchars($lab['foto']) ?>"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus lab ini?')">
                                    <input type="hidden" name="lab_id" value="<?= $lab['id'] ?>">
                                    <input type="hidden" name="action" value="hapus_lab">
                                    <button type="submit" class="btn-icon delete" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center">Belum ada data laboratorium.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- MODAL -->
<div id="labModal" class="modal">
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
                    <input type="text" id="nama_lab" name="nama_lab" required>
                </div>
                <div class="input-box">
                    <label>Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"></textarea>
                </div>
                <div class="input-box">
                    <label>Upload Foto (JPG/PNG)</label>
                    <input type="file" id="foto" name="foto" accept="image/png, image/jpeg">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
<!-- Data Container for Lab -->
<div id="lab-page-data" 
     data-items='<?= htmlspecialchars(json_encode($lab_list), ENT_QUOTES, 'UTF-8') ?>'
     class="hidden">
</div>
    <?php include 'includes/admin_footer.php'; ?>

