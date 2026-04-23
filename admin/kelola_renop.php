<?php
// ==========================================================
// 1. PENGATURAN AWAL & KONEKSI
// ==========================================================
session_start();
// Pastikan path ini benar sesuai struktur folder Anda
require_once '../config/database.php'; 

// 2. CEK LOGIN
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login");
    exit;
}

$message = '';
$message_type = '';
$upload_dir = '../uploads/renop/';

// ==========================================================
// 3. LOGIKA CRUD (PHP)
// ==========================================================
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ==== TAMBAH ====
    if (isset($_POST['action']) && $_POST['action'] == 'tambah_renop') {
        $nama_dokumen = trim($_POST['nama_dokumen']);
        $deskripsi    = trim($_POST['deskripsi']);

        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

        $nama_file_db = null;

        if (isset($_FILES['file_pdf']) && $_FILES['file_pdf']['error'] == 0) {
            $ext = strtolower(pathinfo($_FILES['file_pdf']['name'], PATHINFO_EXTENSION));
            $allowed = ['pdf','doc','docx','xls','xlsx','ppt','pptx'];
            
            if (in_array($ext, $allowed) && $_FILES['file_pdf']['size'] <= 10000000) { // 10MB
                $nama_file_db = time() . '-' . uniqid() . '.' . $ext;
                if (!move_uploaded_file($_FILES['file_pdf']['tmp_name'], $upload_dir . $nama_file_db)) {
                    $message = "Gagal upload file ke server.";
                    $message_type = 'error';
                }
            } else {
                $message = "Format file tidak valid atau terlalu besar (Max 10MB).";
                $message_type = 'error';
            }
        } else {
            $message = "File wajib diupload.";
            $message_type = 'error';
        }

        if (empty($message)) {
            $stmt = $conn->prepare("INSERT INTO rencana_operasional (nama_dokumen, deskripsi, file_pdf) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nama_dokumen, $deskripsi, $nama_file_db);
            if ($stmt->execute()) {
                header("Location: kelola_renop?status=tambah_sukses");
                exit;
            } else {
                $message = "Database Error: " . $stmt->error;
                $message_type = 'error';
            }
        }
    }

    // ==== EDIT ====
    elseif (isset($_POST['action']) && $_POST['action'] == 'edit_renop') {
        $id           = $_POST['id_edit'];
        $nama_dokumen = trim($_POST['nama_dokumen_edit']);
        $deskripsi    = trim($_POST['deskripsi_edit']);
        $old_file     = $_POST['file_lama_edit'];
        $nama_file_db = $old_file;

        // Cek jika ada file baru diupload
        if (isset($_FILES['file_pdf_edit']) && $_FILES['file_pdf_edit']['error'] == 0) {
            $ext = strtolower(pathinfo($_FILES['file_pdf_edit']['name'], PATHINFO_EXTENSION));
            $allowed = ['pdf','doc','docx','xls','xlsx','ppt','pptx'];
            
            if (in_array($ext, $allowed) && $_FILES['file_pdf_edit']['size'] <= 10000000) {
                $nama_file_baru = time() . '-' . uniqid() . '.' . $ext;
                if (move_uploaded_file($_FILES['file_pdf_edit']['tmp_name'], $upload_dir . $nama_file_baru)) {
                    // Hapus file lama jika ada dan file baru berhasil upload
                    if ($old_file && file_exists($upload_dir . $old_file)) {
                        unlink($upload_dir . $old_file);
                    }
                    $nama_file_db = $nama_file_baru;
                }
            } else {
                $message = "Format file baru tidak valid atau terlalu besar.";
                $message_type = 'error';
            }
        }

        if (empty($message)) {
            $stmt = $conn->prepare("UPDATE rencana_operasional SET nama_dokumen=?, deskripsi=?, file_pdf=? WHERE id=?");
            $stmt->bind_param("sssi", $nama_dokumen, $deskripsi, $nama_file_db, $id);
            if ($stmt->execute()) {
                header("Location: kelola_renop?status=edit_sukses");
                exit;
            } else {
                $message = "Database Error: " . $stmt->error;
                $message_type = 'error';
            }
        }
    }

    // ==== HAPUS ====
    elseif (isset($_POST['action']) && $_POST['action'] == 'hapus_renop') {
        $id = intval($_POST['renop_id']);
        
        // Ambil info file dulu untuk dihapus fisik filenya
        $check = $conn->query("SELECT file_pdf FROM rencana_operasional WHERE id=$id");
        if ($check && $check->num_rows > 0) {
            $row = $check->fetch_assoc();
            if ($row['file_pdf'] && file_exists($upload_dir . $row['file_pdf'])) {
                unlink($upload_dir . $row['file_pdf']);
            }
        }
        
        $conn->query("DELETE FROM rencana_operasional WHERE id=$id");
        header("Location: kelola_renop?status=hapus_sukses");
        exit;
    }
}

// 4. NOTIFIKASI VIA URL
if (isset($_GET['status']) && empty($message)) {
    $map = [
        'tambah_sukses' => "RenOp berhasil ditambahkan! 🎉",
        'edit_sukses'   => "RenOp berhasil diperbarui! ✏️",
        'hapus_sukses'  => "RenOp berhasil dihapus. 🗑️",
    ];
    $message = $map[$_GET['status']] ?? '';
    $message_type = 'success';
}

// 5. AMBIL DATA
$list_dokumen = [];
$result = $conn->query("SELECT * FROM rencana_operasional ORDER BY id DESC");
if ($result) while ($r = $result->fetch_assoc()) $list_dokumen[] = $r;

// Convert ke JSON untuk dipakai JavaScript
$json_data = json_encode($list_dokumen);

include 'includes/admin_header.php';
?>

  <!-- Banner Ungu -->
  <div class="page-banner">
    <h1 class="banner-title">Dokumen Fakultas</h1>
  </div>

  <?php if (!empty($message)): ?>
    <div class="alert alert-<?= $message_type == 'success' ? 'success' : 'error' ?> mb-6">
        <?= $message ?>
    </div>
  <?php endif; ?>



  <div class="card">
    <div class="card-header flex-between">
        <h2 class="card-title">Daftar Dokumen RenOp</h2>
        <button id="openModalBtnTambah" class="btn btn-primary">
          <i class="fas fa-plus"></i> Tambah Dokumen
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
      <table class="data-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Dokumen</th>
            <th>Deskripsi</th>
            <th>File</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($list_dokumen): $i=1; foreach ($list_dokumen as $r): ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($r['nama_dokumen']) ?></td>
            <td><?= htmlspecialchars(substr($r['deskripsi'], 0, 80)) ?><?= strlen($r['deskripsi']) > 80 ? '...' : '' ?></td>
            <td>
              <?php if ($r['file_pdf']): ?>
                <a href="../uploads/renop/<?= htmlspecialchars($r['file_pdf']) ?>" target="_blank">
                  <i class="fas fa-file-alt"></i> Lihat
                </a>
              <?php else: ?> - <?php endif; ?>
            </td>
            <td class="action-links">
              <button type="button" class="edit btn-edit-renop" data-id="<?= $r['id'] ?>">
                <i class="fas fa-edit"></i> 
              </button>
              
              <form method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                <input type="hidden" name="action" value="hapus_renop">
                <input type="hidden" name="renop_id" value="<?= $r['id'] ?>">
                <button type="submit" class="delete"><i class="fas fa-trash"></i></button>
              </form>
            </td>
          </tr>
          <?php endforeach; else: ?>
          <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div id="tambahModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Tambah Dokumen</h2>
      <span class="close-btn" onclick="modalHide('tambahModal')">&times;</span>
    </div>
    <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="action" value="tambah_renop">
      <div class="modal-body">
        <div class="input-box">
          <label>Nama Dokumen</label>
          <input type="text" name="nama_dokumen" required>
        </div>
        <div class="input-box">
          <label>Deskripsi</label>
          <textarea name="deskripsi"></textarea>
        </div>
        <div class="input-box">
          <label>Upload File (PDF/DOC/XLS, Max 10MB)</label>
          <input type="file" name="file_pdf" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="modalHide('tambahModal')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
      </div>
    </form>
  </div>
</div>

<div id="editModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Edit Dokumen</h2>
      <span class="close-btn" onclick="modalHide('editModal')">&times;</span>
    </div>
    <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="action" value="edit_renop">
      <input type="hidden" name="id_edit" id="id_edit">
      <input type="hidden" name="file_lama_edit" id="file_lama_edit">

      <div class="modal-body">
        <div class="input-box">
          <label>Nama Dokumen</label>
          <input type="text" name="nama_dokumen_edit" id="nama_dokumen_edit" required>
        </div>
        <div class="input-box">
          <label>Deskripsi</label>
          <textarea name="deskripsi_edit" id="deskripsi_edit"></textarea>
        </div>
        <div class="input-box">
          <label>File Saat Ini</label>
          <div id="file_status_edit" style="font-size:0.9em; margin-bottom:5px; color:#555;">Tidak ada file.</div>
        </div>
        <div class="input-box">
          <label>Ganti File (Opsional)</label>
          <input type="file" name="file_pdf_edit" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
          <small style="color:red;">Biarkan kosong jika tidak ingin mengubah file.</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="modalHide('editModal')">Batal</button>
        <button type="submit" class="btn btn-primary">Update Data</button>
      </div>
    </form>
  </div>
</div>

<!-- Data Container for Renop -->
<div id="renop-page-data" 
     data-items='<?= htmlspecialchars($json_data, ENT_QUOTES, 'UTF-8') ?>'
     class="hidden">
</div>

<?php include 'includes/admin_footer.php'; ?>

