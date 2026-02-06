<?php
session_start();

require '../config/database.php';
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login");
    exit;
}
$message = '';
$message_type = '';
$upload_dir = '../uploads/kurikulum/';

// ================ LOGIKA HAPUS ========================
if (isset($_GET['hapus_id'])) {
    $id = intval($_GET['hapus_id']);

    $cek = $conn->query("SELECT file_pdf FROM kurikulum WHERE id=$id");
    if ($cek && $cek->num_rows > 0) {
        $row = $cek->fetch_assoc();
        if (!empty($row['file_pdf'])) {
            $path = $upload_dir . $row['file_pdf'];
            if (file_exists($path)) unlink($path);
        }
        $conn->query("DELETE FROM kurikulum WHERE id=$id");

        header("Location: kelola_kurikulum?status=hapus_sukses");
        exit;
    }
}
// ================ LOGIKA TAMBAH / EDIT ================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $id = intval($_POST['kurikulum_id'] ?? 0);
    $nama = $_POST['nama_kurikulum'];
    $deskripsi = $_POST['deskripsi'];
    $file_lama = $_POST['current_file'] ?? '';
    $file_baru = $file_lama;

    if (isset($_FILES['file_pdf']) && $_FILES['file_pdf']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['file_pdf']['name'], PATHINFO_EXTENSION));
        if ($ext !== 'pdf') {
            $message = "File harus PDF!";
            $message_type = "error";
        } elseif ($_FILES['file_pdf']['size'] > 10000000) {
            $message = "Ukuran file maksimal 10MB!";
            $message_type = "error";
        } else {
            $file_baru = time() . '-' . uniqid() . '.pdf';
            move_uploaded_file($_FILES['file_pdf']['tmp_name'], $upload_dir . $file_baru);
            if ($action == 'edit_kurikulum' && !empty($file_lama)) {
                $path_old = $upload_dir . $file_lama;
                if (file_exists($path_old)) unlink($path_old);
            }
        }
    }

    if (empty($message)) {
        if ($action == 'tambah_kurikulum') {

            $stmt = $conn->prepare("INSERT INTO kurikulum (nama_kurikulum, deskripsi, file_pdf) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nama, $deskripsi, $file_baru);
            $stmt->execute();

            header("Location: kelola_kurikulum?status=tambah_sukses");
            exit;

        } elseif ($action == 'edit_kurikulum') {

            $stmt = $conn->prepare("UPDATE kurikulum SET nama_kurikulum=?, deskripsi=?, file_pdf=? WHERE id=?");
            $stmt->bind_param("sssi", $nama, $deskripsi, $file_baru, $id);
            $stmt->execute();

            header("Location: kelola_kurikulum?status=edit_sukses");
            exit;
        }
    }
}

// ================ NOTIFIKASI STATUS ===================
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'tambah_sukses') {
        $message = "Kurikulum berhasil ditambahkan!";
        $message_type = "success";
    } elseif ($_GET['status'] == 'edit_sukses') {
        $message = "Kurikulum berhasil diupdate!";
        $message_type = "success";
    } elseif ($_GET['status'] == 'hapus_sukses') {
        $message = "Kurikulum berhasil dihapus!";
        $message_type = "success";
    }
}
// ================ AMBIL DATA TABEL ====================
$list_kurikulum = [];
$q = $conn->query("SELECT * FROM kurikulum ORDER BY id DESC");
while ($r = $q->fetch_assoc()) $list_kurikulum[] = $r;
$kurikulum_json = json_encode($list_kurikulum);
include 'includes/admin_header.php';
?>



    <!-- Banner Ungu -->
    <div class="page-banner">
        <h1 class="banner-title">Kelola Kurikulum</h1>
    </div>

    <?php if (!empty($message)): ?>
        <div class="alert alert-<?= $message_type == 'success' ? 'success' : 'error' ?> mb-6">
            <?= $message ?>
        </div>
    <?php endif; ?>



    <!-- Layout Kartu Terpadu -->
    <div class="card">
        <div class="card-header flex-between mb-4">
            <h2 class="card-title">Daftar Kurikulum</h2>
            <button class="btn btn-primary" id="btnAddKurikulum">
                <i class="fas fa-plus"></i> Tambah Kurikulum
            </button>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kurikulum</th>
                            <th>Deskripsi</th>
                            <th>File PDF</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($list_kurikulum)): $i=1; foreach ($list_kurikulum as $k): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($k['nama_kurikulum']) ?></td>
                            <td><?= htmlspecialchars($k['deskripsi']) ?></td>
                            <td>
                                <?php if ($k['file_pdf']): ?>
                                    <a href="<?= $upload_dir . $k['file_pdf'] ?>" target="_blank" class="text-red-500 hover:underline">
                                        <i class="fas fa-file-pdf"></i> Download
                                    </a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td class="action-links">
                                <a class="btn-icon edit btn-edit-kurikulum" data-id="<?= $k['id'] ?>" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn-icon delete"
                                   href="kelola_kurikulum?hapus_id=<?= $k['id'] ?>"
                                   onclick="return confirm('Yakin ingin menghapus?')"
                                   title="Hapus">
                                   <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center">Belum ada data kurikulum.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<div id="modalKurikulum" class="modal">
    <div class="modal-content">

        <div class="modal-header">
            <h2 id="modalTitle">TAMBAH KURIKULUM</h2>
            <span class="close-btn" onclick="modalHide('modalKurikulum')">&times;</span>
        </div>

        <form id="formKurikulum" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="action" id="formAction" value="tambah_kurikulum">
            <input type="hidden" name="kurikulum_id" id="kurikulumId">
            <input type="hidden" name="current_file" id="currentFile">

            <div class="modal-body">
                <div class="input-box">
                    <label>Nama Kurikulum <span class="text-error">*</span></label>
                    <input type="text" name="nama_kurikulum" id="nama_kurikulum" required>
                </div>

                <div class="input-box">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3"></textarea>
                </div>

                <div class="input-box">
                    <label>Upload PDF</label>
                    <input type="file" name="file_pdf" id="file_pdf" accept="application/pdf">
                    <div id="pdfPreview" class="file-preview-box" style="display:none;"></div>
                    <small class="text-muted">Format: PDF, Max 10MB</small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="modalHide('modalKurikulum')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>

        </form>
    </div>
</div>
<?php include 'includes/admin_footer.php'; ?>

<!-- Data Container for Kurikulum -->
<div id="kurikulum-page-data" 
     data-items='<?= htmlspecialchars($kurikulum_json, ENT_QUOTES, 'UTF-8') ?>'
     class="hidden">
</div>

