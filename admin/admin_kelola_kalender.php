<?php
session_start();

require_once '../database/db_connect.php';
$upload_dir = '../uploads/kalender/';
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// ======================
// LOGIKA PROSES (TAMBAH / EDIT / HAPUS)
// ======================
$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action      = $_POST['action'];
    $kalender_id = isset($_POST['kalender_id']) ? intval($_POST['kalender_id']) : 0;

    $nama      = trim($_POST['nama_kalender'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $tahun     = trim($_POST['tahun_akademik'] ?? '');
    
    $current_gambar = $_POST['current_gambar'] ?? null;
    $gambar_final   = $current_gambar; 
    function uploadGambar($file, $dir) {
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp'];
        
        if (in_array($ext, $allowed) && $file['size'] <= 5000000) {
            $nama_file = time() . '-' . uniqid() . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], $dir . $nama_file)) {
                return ['status' => true, 'file' => $nama_file];
            }
        }
        return ['status' => false];
    }

    // ====== TAMBAH & EDIT (LOGIKA UPLOAD SAMA) ======
    if ($action === 'tambah_kalender' || $action === 'edit_kalender') {
        if (empty($nama) || empty($tahun)) {
            $message = 'Nama kalender dan tahun akademik wajib diisi.';
            $message_type = 'error';
        } else {
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0 && !empty($_FILES['gambar']['name'])) {
                $upload = uploadGambar($_FILES['gambar'], $upload_dir);
                if ($upload['status']) {
                    $gambar_final = $upload['file'];
                    if ($action === 'edit_kalender' && !empty($current_gambar)) {
                        @unlink($upload_dir . $current_gambar);
                    }
                } else {
                    $message = 'Gagal upload gambar (Format: jpg/png/webp, Max 5MB).';
                    $message_type = 'error';
                }
            }

            if (empty($message)) {
                try {
                    if ($action === 'tambah_kalender') {
                        $stmt = $conn->prepare("INSERT INTO kalender_akademik (nama_kalender, deskripsi, gambar, tahun_akademik) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param('ssss', $nama, $deskripsi, $gambar_final, $tahun);
                    } else {
                        $stmt = $conn->prepare("UPDATE kalender_akademik SET nama_kalender = ?, deskripsi = ?, gambar = ?, tahun_akademik = ? WHERE id = ?");
                        $stmt->bind_param('ssssi', $nama, $deskripsi, $gambar_final, $tahun, $kalender_id);
                    }

                    if ($stmt->execute()) {
                        $redirect_status = ($action === 'tambah_kalender') ? 'tambah_sukses' : 'edit_sukses';
                        header("Location: admin_kelola_kalender.php?status=" . $redirect_status);
                        exit;
                    } else {
                        throw new Exception($stmt->error);
                    }
                } catch (Exception $e) {
                    $message = "Database Error: " . $e->getMessage();
                    $message_type = 'error';
                }
            }
        }
    }

    // ====== HAPUS ======
    elseif ($action === 'hapus_kalender' && $kalender_id > 0) {
        try {
            $q = $conn->query("SELECT gambar FROM kalender_akademik WHERE id = $kalender_id");
            $row = $q->fetch_assoc();
            
            $stmt = $conn->prepare("DELETE FROM kalender_akademik WHERE id = ?");
            $stmt->bind_param('i', $kalender_id);
            
            if ($stmt->execute()) {
                if ($row && !empty($row['gambar']) && file_exists($upload_dir . $row['gambar'])) {
                    @unlink($upload_dir . $row['gambar']);
                }
                header("Location: admin_kelola_kalender.php?status=hapus_sukses");
                exit;
            } else {
                $message = "Gagal menghapus data.";
                $message_type = 'error';
            }
        } catch (Exception $e) {
            $message = "Database Error: " . $e->getMessage();
            $message_type = 'error';
        }
    }
}

// Notifikasi dari URL
if (isset($_GET['status']) && empty($message)) {
    if ($_GET['status'] == 'tambah_sukses') { $message = "Kalender berhasil ditambahkan! 🎉"; $message_type = 'success'; }
    if ($_GET['status'] == 'edit_sukses') { $message = "Kalender berhasil diperbarui! ✏️"; $message_type = 'success'; }
    if ($_GET['status'] == 'hapus_sukses') { $message = "Kalender berhasil dihapus. 🗑️"; $message_type = 'success'; }
}

// Ambil Data
$kalender = [];
$res = $conn->query("SELECT * FROM kalender_akademik ORDER BY id DESC");
while ($row = $res->fetch_assoc()) $kalender[] = $row;
$kalender_data_json = json_encode($kalender);

include 'includes/admin_header.php';
?>
<main class="content-area">
    <div class="breadcrumbs">
        <a href="dashboard.php">Admin</a> &gt; <span>Kalender Akademik</span>
    </div>

    <div class="page-header">
        <h1>Kelola Kalender Akademik</h1>
        <button id="openAddModalBtn" class="btn-tambah">
            <i class="fas fa-plus"></i> Tambah Kalender
        </button>
    </div>

    <?php if (!empty($message)): ?>
        <div class="message <?= $message_type ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="kalender-grid">
        <?php if (count($kalender) > 0): ?>
            <?php foreach ($kalender as $item): ?>
                <div class="card">
                    <?php 
                        $image_path = !empty($item['gambar']) ? $upload_dir . $item['gambar'] : '../assets/noimage.png';
                        $src = file_exists($image_path) ? $image_path : '../assets/noimage.png';
                    ?>
                    <img src="<?= $src ?>" alt="<?= htmlspecialchars($item['nama_kalender']) ?>" style="width:100%; height:150px; object-fit:cover;">

                    <div class="card-content">
                        <h3><?= htmlspecialchars($item['nama_kalender']) ?></h3>
                        <p class="tahun"><strong>Tahun:</strong> <?= htmlspecialchars($item['tahun_akademik']) ?></p>
                        <p class="deskripsi">
                            <?= htmlspecialchars(substr($item['deskripsi'], 0, 80)) . (strlen($item['deskripsi']) > 80 ? '...' : '') ?>
                        </p>

                        <div class="action-links">
                            <a href="#" class="btn-aksi btn-aksi-edit" onclick="openEditKalender(<?= $item['id'] ?>); return false;">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="#" class="btn-aksi btn-aksi-delete" onclick="hapusKalender(<?= $item['id'] ?>, '<?= htmlspecialchars($item['nama_kalender'], ENT_QUOTES) ?>'); return false;">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tidak ada data kalender akademik.</p>
        <?php endif; ?>
    </div>
</main>

<div id="kalenderModal" class="modal">
    <div class="modal-bg" style="position:absolute; width:100%; height:100%;" onclick="closeKalenderModal()"></div>

    <div class="modal-box">
        <div class="modal-header">
            <h2 id="modalTitle">Tambah Kalender Akademik</h2>
            <button type="button" class="close-btn" onclick="closeKalenderModal()">×</button>
        </div>

        <form id="kalenderForm" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" id="formAction" value="tambah_kalender">
            <input type="hidden" name="kalender_id" id="kalenderId" value="">
            <input type="hidden" name="current_gambar" id="currentGambar" value="">

            <div class="input-box">
                <label>Nama Kalender *</label>
                <input type="text" name="nama_kalender" id="nama_kalender" required>
            </div>

            <div class="input-box">
                <label>Tahun Akademik *</label>
                <input type="text" name="tahun_akademik" id="tahun_akademik" required placeholder="Contoh: 2023/2024">
            </div>

            <div class="input-box">
                <label>Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3"></textarea>
            </div>

            <div id="imagePreviewBox" class="current-image-preview" style="display:none; margin-bottom:10px;">
                <p style="font-size:0.9em; margin:0;">Gambar saat ini:</p>
                <img id="currentImageSrc" src="" alt="Preview">
            </div>

            <div class="input-box">
                <label id="labelGambar">Upload Gambar</label>
                <input type="file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png,.webp">
                <small style="color:#666; font-size:0.8em;">Max 5MB. Kosongkan jika tidak ingin mengubah gambar (saat edit).</small>
            </div>

            <div class="input-box">
                <button type="button" class="btn-tutup" onclick="modalHide('kalenderModal')">Tutup</button>
                <button type="submit" class="btn-simpan">Simpan</button>
            </div>
        </form>
    </div>
</div>

<form id="hapusForm" method="POST" style="display: none;">
    <input type="hidden" name="action" value="hapus_kalender">
    <input type="hidden" name="kalender_id" id="hapusKalenderId">
</form>

<script>
window.kalenderData = <?= $kalender_data_json ?>;
window.uploadDir = "<?= $upload_dir ?>";
</script>
<script src="../assets/js/admin_global.js"></script>