<?php
session_start();

require_once '../config/database.php';
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login");
    exit;
}

$message = '';
$message_type = '';

/* ============================================================
   FUNGSI UPLOAD FILE
============================================================ */
function uploadPengabdianFile($inputName, $subdir = 'pengabdian_file', $allowedExt = ['pdf','doc','docx']) {
    if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
        return [true, null];
    }

    $uploadDir = "../uploads/{$subdir}/";
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $fileName = $_FILES[$inputName]['name'];
    $fileTmp  = $_FILES[$inputName]['tmp_name'];
    $fileSize = $_FILES[$inputName]['size'];
    $ext      = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowedExt)) return [false, "Ekstensi tidak diizinkan ($ext)."];
    if ($fileSize > 5*1024*1024) return [false, "Ukuran file maksimal 5MB."];

    $newName = time() . '-' . uniqid() . '.' . $ext;
    if (!move_uploaded_file($fileTmp, $uploadDir.$newName)) {
        return [false, "Gagal upload file."];
    }

    return [true, $newName];
}

/* ============================================================
   PROSES CRUD
============================================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    $action = $_POST['action'];

    if ($action === 'hapus_pengabdian') {
        $id = (int)$_POST['pengabdian_id'];

        $cek = $conn->prepare("SELECT file_pdf FROM pengabdian WHERE id=?");
        $cek->bind_param("i", $id);
        $cek->execute();
        $r = $cek->get_result()->fetch_assoc();

        if ($r && $r['file_pdf']) @unlink("../uploads/pengabdian_file/".$r['file_pdf']);

        $hapus = $conn->prepare("DELETE FROM pengabdian WHERE id=?");
        $hapus->bind_param("i",$id);
        $hapus->execute();

        header("Location: kelola_pengabdian?status=hapus_sukses");
        exit;
    }

    // TAMBAH / EDIT
    $judul = trim($_POST['judul']);
    $pelaksana = trim($_POST['pelaksana']);
    $deskripsi = trim($_POST['deskripsi']);
    $tanggal = $_POST['tanggal_kegiatan'] ?? null;

    if ($judul === '' || $pelaksana === '') {
        $message = "Judul dan Pelaksana wajib diisi.";
        $message_type = "error";
    } else {
        if ($action === 'tambah_pengabdian') {
            list($ok, $file_pdf) = uploadPengabdianFile('file_pdf');
            if (!$ok) {
                $message = $file_pdf; $message_type="error";
            } else {
                $stmt = $conn->prepare("
                    INSERT INTO pengabdian (judul, pelaksana, deskripsi, file_pdf, tanggal_kegiatan)
                    VALUES (?, ?, ?, ?, ?)
                ");
                $stmt->bind_param("sssss",$judul,$pelaksana,$deskripsi,$file_pdf,$tanggal);
                $stmt->execute();
                header("Location: kelola_pengabdian?status=tambah_sukses");
                exit;
            }
        } elseif ($action === 'edit_pengabdian') {
            $id = (int)$_POST['edit_id'];
            $old_file = $_POST['old_file_pdf'];
            $file_pdf = $old_file;
            list($ok,$newFile) = uploadPengabdianFile('file_pdf');
            if ($newFile) {
                $file_pdf = $newFile;
                if ($old_file && file_exists("../uploads/pengabdian_file/".$old_file)) {
                    @unlink("../uploads/pengabdian_file/".$old_file);
                }
            }
            $stmt = $conn->prepare("
                UPDATE pengabdian SET 
                judul=?, pelaksana=?, deskripsi=?, file_pdf=?, tanggal_kegiatan=? 
                WHERE id=?
            ");
            $stmt->bind_param("sssssi",$judul,$pelaksana,$deskripsi,$file_pdf,$tanggal,$id);
            $stmt->execute();
            header("Location: kelola_pengabdian?status=edit_sukses");
            exit;
        }
    }
}

/* ============================================================
   NOTIFIKASI
============================================================ */
if (isset($_GET['status']) && $message === '') {
    $map = [
        "tambah_sukses" => "Data pengabdian berhasil ditambahkan!",
        "edit_sukses"   => "Data pengabdian berhasil diperbarui!",
        "hapus_sukses"  => "Data pengabdian berhasil dihapus!",
    ];
    if (isset($map[$_GET['status']])) {
        $message = $map[$_GET['status']];
        $message_type = "success";
    }
}

/* ============================================================
   TAMPILKAN DATA
============================================================ */
$list=[];
$rows=$conn->query("SELECT * FROM pengabdian ORDER BY id DESC");
while($r=$rows->fetch_assoc()) $list[]=$r;

include 'includes/admin_header.php';
?>

    <!-- Banner Ungu -->
    <div class="page-banner">
        <h1 class="banner-title">Pengabdian</h1>
    </div>
    
    <?php if ($message): ?>
    <div class="alert alert-<?= $message_type ?>">
        <?= $message ?>
    </div>
    <?php endif; ?>
    


    <div class="card"> 
    <div class="card-header flex-between mb-4">
        <h2 class="card-title">Daftar Pengabdian</h2>
        <button id="openTambah" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Pelaksana</th>
                        <th>Tanggal</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list)): $i=1; foreach($list as $row): ?>
                    <tr data-id="<?= $row['id'] ?>" 
                        data-judul="<?= htmlspecialchars($row['judul']) ?>" 
                        data-pelaksana="<?= htmlspecialchars($row['pelaksana']) ?>" 
                        data-deskripsi="<?= htmlspecialchars($row['deskripsi']) ?>" 
                        data-tanggal="<?= $row['tanggal_kegiatan'] ?>" 
                        data-file="<?= $row['file_pdf'] ?>">
                        <td><?= $i++ ?></td>
                        <td>
                            <strong><?= htmlspecialchars($row['judul']) ?></strong><br>
                            <small class="text-muted"><i class="fas fa-user-tie"></i> <?= htmlspecialchars($row['pelaksana']) ?></small>
                        </td>
                        <td><?= htmlspecialchars(substr($row['deskripsi'], 0, 80)) ?><?= strlen($row['deskripsi']) > 80 ? '...' : '' ?></td>
                        <td><?= $row['tanggal_kegiatan'] ? date('d M Y', strtotime($row['tanggal_kegiatan'])) : '-' ?></td>
                        <td>
                            <?php if ($row['file_pdf']): ?>
                                <a href="../uploads/pengabdian_file/<?= $row['file_pdf'] ?>" target="_blank" class="text-primary hover:underline">
                                    <i class="fas fa-file-pdf"></i> Lihat PDF
                                </a>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="action-links">
                            <button type="button" class="btn-icon edit btn-edit-pengabdian" title="Edit Data">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                <input type="hidden" name="action" value="hapus_pengabdian">
                                <input type="hidden" name="pengabdian_id" value="<?= $row['id'] ?>">
                                <button type="submit" class="btn-icon delete" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="6" class="text-center">Belum ada data pengabdian.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>

<div id="modalTambah" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>TAMBAH PENGABDIAN</h2>
            <span class="close-btn" onclick="modalHide('modalTambah')">&times;</span>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
            <input type="hidden" name="action" value="tambah_pengabdian">
            <div class="input-box">
                <label>Judul *</label>
                <input type="text" name="judul" required>
            </div>
            <div class="input-box">
                <label>Pelaksana *</label>
                <input type="text" name="pelaksana" required>
            </div>
            <div class="input-box">
                <label>Deskripsi</label>
                <textarea name="deskripsi"></textarea>
            </div>
            <div class="input-box">
                <label>Tanggal Kegiatan</label>
                <input type="date" name="tanggal_kegiatan">
            </div>
            <div class="input-box">
                <label>File Dokumen</label>
                <input type="file" name="file_pdf" accept=".pdf,.doc,.docx">
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="modalHide('modalTambah')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEdit" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>EDIT PENGABDIAN</h2>
            <span class="close-btn" onclick="modalHide('modalEdit')">&times;</span>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
            <input type="hidden" name="action" value="edit_pengabdian">
            <input type="hidden" id="edit_id" name="edit_id">
            <input type="hidden" id="old_file_pdf" name="old_file_pdf">
            <div class="input-box">
                <label>Judul *</label>
                <input type="text" id="edit_judul" name="judul" required>
            </div>
            <div class="input-box">
                <label>Pelaksana *</label>
                <input type="text" id="edit_pelaksana" name="pelaksana" required>
            </div>
            <div class="input-box">
                <label>Deskripsi</label>
                <textarea id="edit_deskripsi" name="deskripsi"></textarea>
            </div>
            <div class="input-box">
                <label>Tanggal Kegiatan</label>
                <input type="date" id="edit_tanggal" name="tanggal_kegiatan">
            </div>
            <div class="input-box">
                <label>Ganti File</label>
                <input type="file" name="file_pdf" accept=".pdf,.doc,.docx">
                <div id="info_file" style="margin-top:5px; font-size:0.85rem;"></div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="modalHide('modalEdit')">Batal</button>
                <button type="submit" class="btn btn-primary">Update Data</button>
            </div>
        </form>
    </div>
<!-- Data Container (if needed) -->

<?php include 'includes/admin_footer.php'; ?>

