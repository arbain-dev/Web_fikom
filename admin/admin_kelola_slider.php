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

    /* MODAL RESPONSIF */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .6);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .modal-content {
        background: white;
        padding: 15px;
        border-radius: 10px;
        max-width: 90%;
        max-height: 90vh;
        text-align: center;
        position: relative;
    }

    .modal-content img {
        max-width: 100%;
        max-height: 80vh;
        border-radius: 6px;
    }

    .modal-close {
        position: absolute;
        right: 12px;
        top: 8px;
        cursor: pointer;
        font-size: 22px;
        font-weight: bold;
    }
</style>

<div class="page-header">
    <h2>Kelola Slider Homepage</h2>
</div>

<?php if (!empty($pesan)): ?>
    <div class="msg"><?= htmlspecialchars($pesan) ?></div>
<?php endif; ?>

<div class="content-box">
    <form method="POST" enctype="multipart/form-data" class="mb-4">
        <label>Pilih Foto Slider:</label><br>
        <input type="file" name="gambar" required style="margin-top:8px;">
        <button type="submit" class="btn btn-primary" style="margin-top:8px;">Upload</button>
    </form>

    <h3>Daftar Slider</h3>
    
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
                        <td>
                            <?php if ($ada): ?>
                                <button type="button" class="btn-small btn-preview js-preview" data-src="<?= $path ?>">Lihat</button>
                            <?php endif; ?>
                            <a class="btn-small btn-toggle" 
                               href="?toggle=<?= $row['id'] ?>"
                               onclick="return confirm('Ubah status slider?');">
                               Toggle
                            </a>
                            <a class="btn-small btn-delete"
                               href="?hapus=<?= $row['id'] ?>"
                               onclick="return confirm('Yakin ingin menghapus slider ini?');">
                               Hapus
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
<div id="imageModal" class="modal-overlay">
    <div class="modal-content">
        <span class="modal-close" id="modalClose">&times;</span>
        <img id="modalImage" src="">
    </div>
</div>

<!-- Inline script for this page specific modal -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modalOverlay = document.getElementById('imageModal');
    const modalImage   = document.getElementById('modalImage');
    const modalClose   = document.getElementById('modalClose');

    document.querySelectorAll('.js-preview').forEach(el => {
        el.addEventListener('click', () => {
            const src = el.getAttribute('data-src');
            if(src) {
                modalImage.src = src;
                modalOverlay.style.display = 'flex';
            }
        });
    });

    if(modalClose) {
        modalClose.onclick = () => modalOverlay.style.display = 'none';
    }
    
    if(modalOverlay) {
        modalOverlay.onclick = e => {
            if (e.target === modalOverlay) modalOverlay.style.display = 'none';
        };
    }
});
</script>

<?php include 'includes/admin_footer.php'; ?>
