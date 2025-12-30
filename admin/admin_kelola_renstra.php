<?php
// 1. PANGGIL SEMUA YANG WAJIB DI ATAS
session_start();
require_once '../config/database.php'; 

// 2. CEK LOGIN
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$message = '';
$message_type = '';
$upload_dir = '../uploads/renstra/'; // Folder upload file PDF

// ==========================================================
// 3. CRUD: TAMBAH / EDIT / HAPUS
// ==========================================================
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ====== TAMBAH ======
    if ($_POST['action'] == 'tambah_renstra') {
        $nama_dokumen = $_POST['nama_dokumen'];
        $deskripsi = $_POST['deskripsi'];
        $upload_dir = '../uploads/renstra/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        $nama_file_db = null;

        if (isset($_FILES['file_pdf']) && $_FILES['file_pdf']['error'] == 0) {
            $ext = strtolower(pathinfo($_FILES['file_pdf']['name'], PATHINFO_EXTENSION));
            $allowed = ['pdf','doc','docx','xls','xlsx','ppt','pptx'];
            if (in_array($ext, $allowed) && $_FILES['file_pdf']['size'] <= 10000000) {
                $nama_file_db = time() . '-' . uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['file_pdf']['tmp_name'], $upload_dir . $nama_file_db);
            } else {
                $message = "File tidak valid (PDF/DOC/XLS/PPT, max 10MB)";
                $message_type = 'error';
            }
        } else {
            $message = "File wajib diupload.";
            $message_type = 'error';
        }

        if (empty($message)) {
            $stmt = $conn->prepare("INSERT INTO rencana_strategis (nama_dokumen, deskripsi, file_pdf) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nama_dokumen, $deskripsi, $nama_file_db);
            if ($stmt->execute()) {
                header("Location: admin_kelola_renstra.php?status=tambah_sukses");
                exit;
            } else {
                $message = "Gagal menyimpan ke database.";
                $message_type = 'error';
            }
        }
    }

    // ====== EDIT ======
    if ($_POST['action'] == 'edit_renstra') {
        $id = $_POST['id_edit'];
        $nama_dokumen = $_POST['nama_dokumen_edit'];
        $deskripsi = $_POST['deskripsi_edit'];
        $old_file = $_POST['file_lama_edit'];
        $upload_dir = '../uploads/renstra/';
        $nama_file_db = $old_file;

        if (isset($_FILES['file_pdf_edit']) && $_FILES['file_pdf_edit']['error'] == 0) {
            $ext = strtolower(pathinfo($_FILES['file_pdf_edit']['name'], PATHINFO_EXTENSION));
            $allowed = ['pdf','doc','docx','xls','xlsx','ppt','pptx'];
            if (in_array($ext, $allowed) && $_FILES['file_pdf_edit']['size'] <= 10000000) {
                $nama_file_baru = time() . '-' . uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['file_pdf_edit']['tmp_name'], $upload_dir . $nama_file_baru);
                if ($old_file && file_exists($upload_dir . $old_file)) unlink($upload_dir . $old_file);
                $nama_file_db = $nama_file_baru;
            } else {
                $message = "File tidak valid (PDF/DOC/XLS/PPT, max 10MB)";
                $message_type = 'error';
            }
        }

        if (empty($message)) {
            $stmt = $conn->prepare("UPDATE rencana_strategis SET nama_dokumen=?, deskripsi=?, file_pdf=? WHERE id=?");
            $stmt->bind_param("sssi", $nama_dokumen, $deskripsi, $nama_file_db, $id);
            if ($stmt->execute()) {
                header("Location: admin_kelola_renstra.php?status=edit_sukses");
                exit;
            } else {
                $message = "Gagal mengupdate data.";
                $message_type = 'error';
            }
        }
    }

    // ====== HAPUS ======
    if ($_POST['action'] == 'hapus_renstra') {
        $id = intval($_POST['renstra_id']);
        $check = $conn->query("SELECT file_pdf FROM rencana_strategis WHERE id=$id");
        if ($check->num_rows > 0) {
            $row = $check->fetch_assoc();
            if ($row['file_pdf'] && file_exists("../uploads/renstra/" . $row['file_pdf'])) {
                unlink("../uploads/renstra/" . $row['file_pdf']);
            }
        }
        $conn->query("DELETE FROM rencana_strategis WHERE id=$id");
        header("Location: admin_kelola_renstra.php?status=hapus_sukses");
        exit;
    }
}

// ==========================================================
// 4. STATUS NOTIFIKASI
// ==========================================================
if (isset($_GET['status'])) {
    $map = [
        'tambah_sukses' => "Rencana Strategis berhasil ditambahkan! 🎉",
        'edit_sukses'   => "Rencana Strategis berhasil diperbarui! ✏️",
        'hapus_sukses'  => "Rencana Strategis berhasil dihapus. 🗑️",
    ];
    $message = $map[$_GET['status']] ?? '';
    $message_type = 'success';
}

// ==========================================================
// 5. AMBIL DATA
// ==========================================================
$list_dokumen = [];
$result = $conn->query("SELECT * FROM rencana_strategis ORDER BY id DESC");
if ($result) while ($r = $result->fetch_assoc()) $list_dokumen[] = $r;

include 'includes/admin_header.php';
?>

  <!-- Purple Banner -->
  <div class="page-banner">
    <h1 class="banner-title">Kelola Rencana Strategis (Renstra)</h1>
  </div>

  <?php if ($message): ?>
    <div class="message <?= $message_type ?>"><?= $message ?></div>
  <?php endif; ?>

  <div class="card">
    <div class="card-header flex-between">
        <h2 class="card-title">Daftar Dokumen Renstra</h2>
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
                <a href="../uploads/renstra/<?= htmlspecialchars($r['file_pdf']) ?>" target="_blank">
                  <i class="fas fa-file-alt"></i> Lihat
                </a>
              <?php else: ?> - <?php endif; ?>
            </td>
            <td class="action-links">
              <button type="button" class="edit" onclick="openEditModal(<?= $r['id'] ?>)">
                <i class="fas fa-edit"></i>
              </button>
              <form method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus Renstra ini?');">
                <input type="hidden" name="action" value="hapus_renstra">
                <input type="hidden" name="renstra_id" value="<?= $r['id'] ?>">
                  <button type="submit" class="delete">
                    <i class="fas fa-trash"></i>
                  </button>
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

<!-- MODAL TAMBAH -->
<div id="tambahModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Tambah Rencana Strategis</h2>
      <span class="close-btn" onclick="modalHide('tambahModal')">&times;</span>
    </div>
    <form method="POST" enctype="multipart/form-data" id="tambahForm">
      <input type="hidden" name="action" value="tambah_renstra">
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
          <label>Upload File</label>
          <input type="file" name="file_pdf" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-btn" onclick="modalHide('tambahModal')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL EDIT -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Edit Rencana Strategis</h2>
      <span class="close-btn" onclick="modalHide('editModal')">&times;</span>
    </div>
    <form method="POST" enctype="multipart/form-data" id="editForm">
      <input type="hidden" name="action" value="edit_renstra">
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
          <p class="file-status" id="file_status_edit">Tidak ada file.</p>
        </div>
        <div class="input-box">
          <label>Ganti File</label>
          <input type="file" name="file_pdf_edit" id="file_pdf_edit" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-btn" onclick="modalHide('editModal')">Batal</button>
        <button type="submit" class="btn btn-primary">Update Data</button>
      </div>
    </form>
  </div>
</div>

<script>
    window.renstraData = <?= json_encode($list_dokumen) ?>;

    document.addEventListener('DOMContentLoaded', () => {
        // Add Button
        const btnAdd = document.getElementById('openModalBtnTambah'); 
        if (btnAdd) {
            btnAdd.addEventListener('click', () => {
                window.modalShow('tambahModal');
            });
        }
    });

    function openEditModal(id) {
        const data = window.renstraData.find(item => item.id == id);
        if(!data) return;

        document.getElementById('id_edit').value = data.id;
        document.getElementById('nama_dokumen_edit').value = data.nama_dokumen;
        document.getElementById('deskripsi_edit').value = data.deskripsi;
        document.getElementById('file_lama_edit').value = data.file_pdf;
        
        const fileStat = document.getElementById('file_status_edit');
        if(data.file_pdf) {
            fileStat.innerHTML = `File saat ini: <a href="../uploads/renstra/${data.file_pdf}" target="_blank">${data.file_pdf}</a>`;
        } else {
            fileStat.innerText = "Tidak ada file.";
        }

        window.modalShow('editModal');
    }
</script>

<?php include 'includes/admin_footer.php'; ?>
