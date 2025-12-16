<?php
// 1. PENGATURAN AWAL & KONEKSI
session_start();
require_once '../database/db_connect.php'; 

// 2. CEK LOGIN
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$message = '';
$message_type = '';
$upload_dir = '../uploads/sop/';

// ==========================================================
// 3. LOGIKA CRUD (PHP)
// ==========================================================
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ==== TAMBAH SOP ====
    if (isset($_POST['action']) && $_POST['action'] == 'tambah_sop') {
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
            $message = "File SOP wajib diupload.";
            $message_type = 'error';
        }

        if (empty($message)) {
            $stmt = $conn->prepare("INSERT INTO sop (nama_sop, deskripsi, file_pdf) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nama_dokumen, $deskripsi, $nama_file_db);
            if ($stmt->execute()) {
                header("Location: admin_kelola_sop.php?status=tambah_sukses");
                exit;
            } else {
                $message = "Database Error: " . $stmt->error;
                $message_type = 'error';
            }
        }
    }

    // ==== EDIT SOP ====
    elseif (isset($_POST['action']) && $_POST['action'] == 'edit_sop') {
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
                    // Hapus file lama
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
            $stmt = $conn->prepare("UPDATE sop SET nama_sop=?, deskripsi=?, file_pdf=? WHERE id=?");
            $stmt->bind_param("sssi", $nama_dokumen, $deskripsi, $nama_file_db, $id);
            if ($stmt->execute()) {
                header("Location: admin_kelola_sop.php?status=edit_sukses");
                exit;
            } else {
                $message = "Database Error: " . $stmt->error;
                $message_type = 'error';
            }
        }
    }

    // ==== HAPUS SOP ====
    elseif (isset($_POST['action']) && $_POST['action'] == 'hapus_sop') {
        $id = intval($_POST['sop_id']);
        
        $check = $conn->query("SELECT file_pdf FROM sop WHERE id=$id");
        if ($check && $check->num_rows > 0) {
            $row = $check->fetch_assoc();
            if ($row['file_pdf'] && file_exists($upload_dir . $row['file_pdf'])) {
                unlink($upload_dir . $row['file_pdf']);
            }
        }
        
        $conn->query("DELETE FROM sop WHERE id=$id");
        header("Location: admin_kelola_sop.php?status=hapus_sukses");
        exit;
    }
}

// 4. NOTIFIKASI
if (isset($_GET['status']) && empty($message)) {
    $map = [
        'tambah_sukses' => "SOP berhasil ditambahkan! 🎉",
        'edit_sukses'   => "SOP berhasil diperbarui! ✏️",
        'hapus_sukses'  => "SOP berhasil dihapus. 🗑️",
    ];
    $message = $map[$_GET['status']] ?? '';
    $message_type = 'success';
}

// 5. AMBIL DATA
$list_dokumen = [];
$result = $conn->query("SELECT * FROM sop ORDER BY id DESC");
if ($result) while ($r = $result->fetch_assoc()) $list_dokumen[] = $r;

// Convert ke JSON untuk JS
$json_data = json_encode($list_dokumen);

include 'includes/admin_header.php';
?>

<main class="content-area">
    
    <div class="page-header">
        <h1>Standar Operasional Prosedur (SOP)</h1>
        <button id="openModalBtnTambah" class="btn-tambah">
            <i class="fas fa-plus"></i> Tambah SOP
        </button>
    </div>

    <?php if (!empty($message)): ?>
        <div class="message <?= $message_type ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="content-box">
        <div class="data-table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama SOP</th>
                        <th>Deskripsi</th>
                        <th>File</th>
                        <th style="width: 120px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($list_dokumen): $i=1; foreach ($list_dokumen as $r): ?>
                    <tr>
                        <td data-label="No"><?= $i++ ?></td>
                        <td data-label="Nama SOP"><strong><?= htmlspecialchars($r['nama_sop']) ?></strong></td>
                        <td data-label="Deskripsi"><?= htmlspecialchars(substr($r['deskripsi'], 0, 80)) ?><?= strlen($r['deskripsi']) > 80 ? '...' : '' ?></td>
                        <td data-label="File">
                            <?php if ($r['file_pdf']): ?>
                                <a href="<?= $upload_dir . htmlspecialchars($r['file_pdf']) ?>" target="_blank" style="color: var(--primary); text-decoration: none;">
                                    <i class="fas fa-file-pdf"></i> Download
                                </a>
                            <?php else: ?> 
                                <span style="color: #999;">-</span> 
                            <?php endif; ?>
                        </td>
                        <td data-label="Aksi">
                            <div class="action-links">
                                <button type="button" class="btn-aksi-edit" onclick="openEditModal(<?= $r['id'] ?>)" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                
                                <form method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus SOP ini?');">
                                    <input type="hidden" name="action" value="hapus_sop">
                                    <input type="hidden" name="sop_id" value="<?= $r['id'] ?>">
                                    <button type="submit" class="delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center; padding: 20px;">Belum ada data SOP.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<div id="tambahModal" class="modal">
    <div class="modal-overlay" onclick="closeModal('tambahModal')"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Tambah SOP Baru</h2>
            <button class="close-btn" onclick="closeModal('tambahModal')">&times;</button>
        </div>
        
        <form method="POST" enctype="multipart/form-data" id="tambahForm">
            <div class="modal-body">
                <input type="hidden" name="action" value="tambah_sop">
                
                <div class="input-box">
                    <label>Nama SOP</label>
                    <input type="text" name="nama_dokumen" required placeholder="Masukkan nama SOP">
                </div>
                
                <div class="input-box">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat..."></textarea>
                </div>
                
                <div class="input-box">
                    <label>Upload File (PDF/DOC/XLS)</label>
                    <input type="file" name="file_pdf" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
                    <small style="color: #888;">Maksimal 10MB.</small>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn-tutup" onclick="closeModal('tambahModal')">Batal</button>
                <button type="submit" class="btn-simpan">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="modal">
    <div class="modal-overlay" onclick="closeModal('editModal')"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit SOP</h2>
            <button class="close-btn" onclick="closeModal('editModal')">&times;</button>
        </div>
        
        <form method="POST" enctype="multipart/form-data" id="editForm">
            <div class="modal-body">
                <input type="hidden" name="action" value="edit_sop">
                <input type="hidden" name="id_edit" id="id_edit">
                <input type="hidden" name="file_lama_edit" id="file_lama_edit">

                <div class="input-box">
                    <label>Nama SOP</label>
                    <input type="text" name="nama_dokumen_edit" id="nama_dokumen_edit" required>
                </div>

                <div class="input-box">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi_edit" id="deskripsi_edit" rows="3"></textarea>
                </div>

                <div class="input-box">
                    <label>File Saat Ini</label>
                    <div id="file_status_edit" class="file-preview-box">
                        </div>
                </div>

                <div class="input-box">
                    <label>Ganti File (Opsional)</label>
                    <input type="file" name="file_pdf_edit" id="file_pdf_edit" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                    <small style="color: #888;">Biarkan kosong jika tidak ingin mengubah file.</small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-tutup" onclick="closeModal('editModal')">Batal</button>
                <button type="submit" class="btn-simpan">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    window.sopData = <?= $json_data ?>;
</script>
<script src="../assets/js/admin_global.js"></script>
