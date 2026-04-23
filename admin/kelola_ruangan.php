<?php
// File: admin/kelola_ruangan

// 1. PANGGIL SEMUA YANG WAJIB DI ATAS
session_start();
// Pastikan path koneksi ini benar (naik satu level ke root proyek)
require_once '../config/database.php'; 

// 2. CEK LOGIN
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login");
    exit;
}

// Inisialisasi variabel pesan, dll.
$message = '';
$message_type = '';
$upload_dir = '../uploads/ruangan/'; // Folder upload foto (Relatif dari admin/)

// ==========================================================
// BAGIAN 3: LOGIKA PROSES HAPUS RUANGAN
// ==========================================================
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'hapus') {
    $ruangan_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    if ($ruangan_id > 0) {
        try {
            if (!isset($conn) || !$conn->ping()) {
                throw new Exception("Koneksi database terputus atau tidak terdefinisi.");
            }
            
            // Cari data ruangan untuk mendapatkan nama foto
            $sql = "SELECT foto FROM ruangan WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $ruangan_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $foto_file = $row['foto'];
                
                // Hapus data dari database
                $sql_delete = "DELETE FROM ruangan WHERE id = ?";
                $stmt_delete = $conn->prepare($sql_delete);
                $stmt_delete->bind_param("i", $ruangan_id);
                
                if ($stmt_delete->execute()) {
                    // Hapus file foto jika ada
                    if ($foto_file) {
                        $file_path = $upload_dir . $foto_file;
                        if (file_exists($file_path)) {
                            unlink($file_path);
                        }
                    }
                    
                    $stmt_delete->close();
                    $stmt->close();
                    
                    // Redirect dengan status sukses
                    header("Location: kelola_ruangan?status=hapus_sukses");
                    exit;
                } else {
                    throw new Exception("Gagal menghapus data dari database: " . $stmt_delete->error);
                }
            } else {
                throw new Exception("Data ruangan tidak ditemukan.");
            }
            
            $stmt->close();
        } catch (Exception $e) {
            header("Location: kelola_ruangan?status=hapus_gagal&error=" . urlencode($e->getMessage()));
            exit;
        }
    } else {
        header("Location: kelola_ruangan?status=hapus_gagal&error=ID%20tidak%20valid");
        exit;
    }
}

// ==========================================================
// BAGIAN 4: LOGIKA PROSES TAMBAH & EDIT (POPUP DI-SUBMIT)
// ==========================================================
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {

    $action = $_POST['action'];
    $ruangan_id = isset($_POST['ruangan_id']) ? intval($_POST['ruangan_id']) : 0; 

    // Ambil data dari form dan dibersihkan
    $nama_ruangan = trim($_POST['nama_ruangan']); 
    $deskripsi = trim($_POST['deskripsi']);

    $nama_foto_db = NULL;
    $target_file = '';
    $current_foto = $_POST['current_foto'] ?? NULL; 

    // Proses Upload Foto (jika ada)
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0 && !empty($_FILES['foto']['name'])) {
        if (!is_dir($upload_dir)) { mkdir($upload_dir, 0755, true); }

        $file_ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png'];

        if (in_array($file_ext, $allowed_types) && $_FILES['foto']['size'] <= 2000000) { // Max 2MB
            $nama_foto_db = md5(time() . uniqid()) . '.' . $file_ext; 
            $target_file = $upload_dir . $nama_foto_db;
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                $nama_foto_db = NULL; 
                $message = "Gagal memindahkan file foto baru.";
                $message_type = "error";
            }
        } else {
            $message = "File foto baru tidak valid (hanya JPG/PNG, max 2MB).";
            $message_type = "error";
        }
    } else {
        // Jika tidak ada upload foto baru saat EDIT, gunakan foto lama
        if ($action == 'edit_ruangan') {
            $nama_foto_db = $current_foto;
        }
    }

    // Simpan ke Database
    if (empty($message)) {
        try {
            // Re-koneksi jika koneksi terputus
            if (!isset($conn) || !$conn->ping()) {
                throw new Exception("Koneksi database terputus atau tidak terdefinisi.");
            }
            
            if ($action == 'tambah_ruangan') {
                $sql = "INSERT INTO ruangan (nama_ruangan, deskripsi, foto) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $nama_ruangan, $deskripsi, $nama_foto_db);
                $sukses_msg = 'tambah_sukses';
            } elseif ($action == 'edit_ruangan' && $ruangan_id > 0) {
                
                $is_new_photo_uploaded = ($nama_foto_db !== $current_foto && $nama_foto_db !== NULL);
                
                if ($is_new_photo_uploaded && $current_foto) {
                    $old_file_path = $upload_dir . $current_foto;
                    if (file_exists($old_file_path)) { 
                        unlink($old_file_path); // Hapus foto lama
                    }
                }
                
                $sql = "UPDATE ruangan SET nama_ruangan = ?, deskripsi = ?, foto = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssi", $nama_ruangan, $deskripsi, $nama_foto_db, $ruangan_id);
                $sukses_msg = 'edit_sukses';
            } else {
                $message = "Aksi tidak valid atau ID Ruangan tidak ditemukan.";
                $message_type = "error";
            }

            if (isset($stmt) && $stmt->execute()) {
                header("Location: kelola_ruangan?status=" . $sukses_msg);
                exit;
            } elseif (isset($stmt)) {
                 $message = "Gagal simpan/update ke DB: " . $stmt->error;
                 $message_type = "error";
                 if ($nama_foto_db && file_exists($target_file)) { unlink($target_file); } // Rollback foto
            }
            if (isset($stmt)) { $stmt->close(); }
        } catch (Exception $e) {
            $message = "Database Error: " . $e->getMessage();
            $message_type = "error";
            if ($nama_foto_db && file_exists($target_file)) { unlink($target_file); } // Rollback foto
        }
    }
}
// ==========================================================


// 5. CEK STATUS DARI URL (UNTUK NOTIFIKASI)
$status_get = $_GET['status'] ?? '';
if (empty($message)) { 
    if ($status_get == 'tambah_sukses') {
        $message = "Data ruangan baru berhasil ditambahkan! ✨";
        $message_type = "success";
    } elseif ($status_get == 'edit_sukses') {
        $message = "Data ruangan berhasil di-update! ✏️";
        $message_type = "success";
    } elseif ($status_get == 'hapus_sukses') {
        $message = "Data ruangan berhasil dihapus. 🗑️";
        $message_type = "success";
    } elseif ($status_get == 'hapus_gagal') {
        $error_msg = $_GET['error'] ?? 'Terjadi kesalahan saat menghapus data.';
        $message = "Gagal menghapus ruangan: " . htmlspecialchars($error_msg);
        $message_type = "error";
    }
}

// 6. AMBIL DATA RUANGAN DARI DATABASE
$ruangan_list = [];
if (isset($conn) && $conn->ping()) {
    $sql = "SELECT id, nama_ruangan, deskripsi, foto FROM ruangan ORDER BY nama_ruangan ASC";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { $ruangan_list[] = $row; }
    }
} 

// 7. Siapkan data untuk JavaScript
$ruangan_data_json = json_encode($ruangan_list);

$post_error_data = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($message_type) && $message_type == 'error') {
    $post_error_data = [
        'is_error' => true,
        'action' => $_POST['action'] ?? 'tambah_ruangan',
        'id' => $_POST['ruangan_id'] ?? '0',
        'nama_ruangan' => $_POST['nama_ruangan'] ?? '',
        'deskripsi' => $_POST['deskripsi'] ?? '',
        'current_foto' => $_POST['current_foto'] ?? ''
    ];
}

// Tutup koneksi dengan pengecekan aman
if (isset($conn) && $conn->ping()) { $conn->close(); }

// 8. PANGGIL HEADER (HTML Mulai)
include 'includes/admin_header.php';
?>


    <!-- Banner Ungu -->
    <div class="page-banner">
        <h1 class="banner-title">Ruangan</h1>
    </div>

    <?php if (!empty($message)): ?>
        <div class="alert alert-<?= $message_type == 'success' ? 'success' : 'error' ?> mb-6">
            <?= $message ?>
        </div>
    <?php endif; ?>



    <div class="card">
        <div class="card-header flex-between">
            <h2 class="card-title">Daftar Ruangan</h2>
            <button type="button" id="openModalBtn" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Ruangan
            </button>
        </div>
        <div class="card-body">
            <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; padding-bottom: 5px;">
                <table class="data-table" style="min-width: 600px;">
                    <thead>
                        <tr>
                            <th>No</th> <th>Foto</th> <th>Nama Ruangan</th> <th>Deskripsi</th> <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($ruangan_list) > 0): $i = 1; ?>
                        <?php foreach ($ruangan_list as $item): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td>
                                <?php
                                $foto_file = !empty($item['foto']) ? htmlspecialchars($item['foto']) : 'default-placeholder.png';
                                $foto_src = '../uploads/ruangan/' . $foto_file; // Path relatif untuk browser
                                ?>
                                <img src="<?= $foto_src ?>" alt="<?= htmlspecialchars($item['nama_ruangan']) ?>" class="table-foto">
                            </td>
                            <td><?= htmlspecialchars($item['nama_ruangan']) ?></td>
                            <td><?= htmlspecialchars(substr($item['deskripsi'], 0, 100)) ?><?= (strlen($item['deskripsi']) > 100) ? '...' : '' ?></td>
                            <td class="action-links">
                                <a href="#" class="edit btn-edit-ruangan" data-id="<?= $item['id'] ?>" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="delete btn-hapus-ruangan" data-id="<?= $item['id'] ?>" data-nama="<?= htmlspecialchars(addslashes($item['nama_ruangan'])) ?>" title="Hapus"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center">Belum ada data ruangan.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

<!-- Modal untuk tambah / edit ruangan -->
<div id="ruanganModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle">Tambah Ruangan Baru</h2>
            <span class="close-btn closeModalBtn" data-modal-id="ruanganModal">&times;</span>
        </div>

        <form id="ruanganForm" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" id="formAction" value="tambah_ruangan">
            <input type="hidden" name="ruangan_id" id="ruanganId" value="0">
            <input type="hidden" name="current_foto" id="currentFoto" value="">

            <div class="modal-body">
                <div class="input-box">
                    <label for="nama_ruangan">Nama Ruangan *</label>
                    <input type="text" id="nama_ruangan" name="nama_ruangan" placeholder="Contoh: Ruang Rapat Utama" required value="<?= htmlspecialchars($_POST['nama_ruangan'] ?? '') ?>">
                </div>
                <div class="input-box">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" placeholder="Tulis deskripsi singkat ruangan..."><?= htmlspecialchars($_POST['deskripsi'] ?? '') ?></textarea>
                </div>

                <div class="foto-preview-box" id="fotoPreviewBox">
                </div>

                <div class="input-box">
                    <label for="foto">Upload Foto Baru (JPG/PNG, Max 2MB)</label>
                    <input type="file" id="foto" name="foto" accept="image/png, image/jpeg">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="modalHide('ruanganModal')">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<!-- Data Container for Ruangan -->
<div id="ruangan-page-data" 
     data-items='<?= htmlspecialchars($ruangan_data_json, ENT_QUOTES, 'UTF-8') ?>'
     data-upload-dir="../uploads/ruangan/"
     class="hidden">
</div>

<?php include 'includes/admin_footer.php'; ?>

