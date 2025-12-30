<?php
require_once '../config/database.php'; 
session_start();
$pesan = "";

// Hapus slider + file fisik
if (isset($_GET['hapus'])) {
    $id_hapus = (int) $_GET['hapus'];

    // ambil nama file
    $stmt = $conn->prepare("SELECT gambar FROM hero_slider WHERE id = ?");
    $stmt->bind_param("i", $id_hapus);
    $stmt->execute();
    $stmt->bind_result($namaFile);
    $stmt->fetch();
    $stmt->close();

    if (!empty($namaFile)) {
        $pathFile = '../uploads/slider/' . $namaFile;
        if (file_exists($pathFile)) { @unlink($pathFile); }
    }

    $stmt = $conn->prepare("DELETE FROM hero_slider WHERE id = ?");
    $stmt->bind_param("i", $id_hapus);
    $stmt->execute();
    $stmt->close();

    $pesan = "Data slider berhasil dihapus.";
}

// Toggle aktif / nonaktif
if (isset($_GET['toggle'])) {
    $id_toggle = (int) $_GET['toggle'];
    $conn->query("UPDATE hero_slider 
                  SET is_active = IF(is_active = 1, 0, 1) 
                  WHERE id = {$id_toggle}");
    $pesan = "Status slider diperbarui.";
}

// Upload slider baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {

        $nama_file = $_FILES['gambar']['name'];
        $tmp       = $_FILES['gambar']['tmp_name'];

        $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
        $nama_baru = 'slider_' . time() . '_' . rand(1000,9999) . '.' . $ext;

        $folder_upload = '../uploads/slider/';

        if (!is_dir($folder_upload)) mkdir($folder_upload, 0777, true);

        $path_tujuan = $folder_upload . $nama_baru;

        if (move_uploaded_file($tmp, $path_tujuan)) {
            $insert = $conn->prepare("INSERT INTO hero_slider (gambar, is_active) VALUES (?, 1)");
            $insert->bind_param("s", $nama_baru);
            $insert->execute();
            $insert->close();

            $pesan = "Foto slider berhasil diupload!";
        } else {
            $pesan = "Gagal mengupload file.";
        }
    }
}

// Ambil semua slider
$data_slider = $conn->query("SELECT * FROM hero_slider ORDER BY id DESC");

// HEADER
include 'includes/admin_header.php';
?>
<style>
    /* Local overrides for slider page specific elements */
    .table-wrapper {
        overflow-x: auto;
        background: #fff;
        border-radius: 10px;
        padding: 10px;
        margin-top: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 650px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
    }

    th {
        background: #f0f0f0;
        text-align: left;
    }

    img.thumb {
        max-width: 140px;
        border-radius: 6px;
        cursor: pointer;
    }

    .msg {
        background: #dff0d8;
        color: #3c763d;
        padding: 10px 15px;
        border-radius: 6px;
        margin-bottom: 15px;
        display: inline-block;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 10px;
        color: white;
        font-size: 12px;
    }

    .badge-aktif { background: #27ae60; }
    .badge-nonaktif { background: #7f8c8d; }
</style>

<!-- Purple Banner -->
<div class="page-banner">
    <h1 class="banner-title">Kelola Slider Homepage</h1>
</div>

<?php if (!empty($pesan)): ?>
    <div class="msg"><?= htmlspecialchars($pesan) ?></div>
<?php endif; ?>

<!-- Card Upload -->
<div class="card mb-4">
    <div class="card-header">
        <h2 class="card-title">Upload Slider Baru</h2>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" class="flex-end" style="gap:10px;">
            <div>
                <label class="d-block" style="font-weight:bold; margin-bottom:5px;">Pilih Foto:</label>
                <input type="file" name="gambar" required>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-upload"></i> Upload
            </button>
        </form>
    </div>
</div>

<!-- Card Daftar -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Daftar Slider</h2>
    </div>
    <div class="card-body">
        <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Preview</th>
                    <th>Nama File</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data_slider && $data_slider->num_rows > 0): ?>
                    <?php while ($row = $data_slider->fetch_assoc()):
                        $path = '../uploads/slider/' . $row['gambar'];
                        $ada = file_exists($path);
                    ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td>
                            <?php if ($ada): ?>
                                <img src="<?= $path ?>" class="thumb js-preview" data-src="<?= $path ?>">
                            <?php else: ?>
                                <i>File hilang</i>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['gambar']) ?></td>
                        <td>
                            <?php if ($row['is_active']): ?>
                                <span class="badge badge-aktif">Aktif</span>
                            <?php else: ?>
                                <span class="badge badge-nonaktif">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td class="action-links" style="text-align: center;">
                            <a class="delete"
                               href="?hapus=<?= $row['id'] ?>"
                               onclick="return confirm('Yakin ingin menghapus slider ini?');"
                               title="Hapus">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">Belum ada data slider.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL PREVIEW -->
<div id="imageModal" class="modal">
    <div class="modal-content" style="max-width: 800px; width: auto;">
        <div class="modal-header">
            <h2>PREVIEW SLIDER</h2>
            <span class="close-btn" onclick="window.modalHide('imageModal')">&times;</span>
        </div>
        <div class="modal-body" style="text-align: center; padding: 20px;">
            <img id="modalImage" src="" style="max-width: 100%; max-height: 70vh; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-btn" onclick="window.modalHide('imageModal')">Tutup</button>
        </div>
    </div>
</div>

<!-- Inline script for this page specific modal -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modalImage = document.getElementById('modalImage');

    document.querySelectorAll('.js-preview').forEach(el => {
        el.addEventListener('click', () => {
            const src = el.getAttribute('data-src');
            if(src) {
                modalImage.src = src;
                window.modalShow('imageModal');
            }
        });
    });
});
</script>

<?php include 'includes/admin_footer.php'; ?>
