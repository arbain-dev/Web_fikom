<?php

session_start(); 

require_once '../config/database.php'; 
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit; 
}

$message         = ''; 
$message_type    = '';
$upload_dir_path = '../uploads/kerjasama/';

// ==========================================================
// 3. LOGIKA TAMBAH / EDIT DATA (POST)
// ==========================================================
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action'])) {
    
    $action       = $_POST['action'];
    $nama         = $conn->real_escape_string($_POST['nama_instansi'] ?? '');
    $link         = $conn->real_escape_string($_POST['link_website'] ?? '');
    $kerjasama_id = intval($_POST['kerjasama_id'] ?? 0); 
    $logo_lama    = $_POST['logo_lama'] ?? null; 
    
    $logo_db = $logo_lama; 
    if (isset($_FILES['logo_baru']) && $_FILES['logo_baru']['error'] === 0) {
        
        if (!is_dir($upload_dir_path)) {
            mkdir($upload_dir_path, 0755, true);
        }
        
        $file_ext = strtolower(pathinfo($_FILES['logo_baru']['name'], PATHINFO_EXTENSION));
        if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $logo_db = time() . '-' . uniqid() . '.' . $file_ext;
            
            if (move_uploaded_file($_FILES['logo_baru']['tmp_name'], $upload_dir_path . $logo_db)) {
                // Hapus logo lama saat EDIT
                if ($action === 'edit_kerjasama' && $logo_lama && file_exists($upload_dir_path . $logo_lama)) {
                    @unlink($upload_dir_path . $logo_lama); 
                }
            } else {
                $message      = "Gagal upload logo.";
                $message_type = "error";
            }
        } else {
            $message      = "Format file tidak valid (hanya JPG/JPEG/PNG/WEBP).";
            $message_type = "error";
        }
    }
    if (empty($message)) {
        if ($action === 'tambah_kerjasama' && !empty($logo_db)) {
            $stmt = $conn->prepare("INSERT INTO kerjasama (nama_instansi, logo, link_website) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nama, $logo_db, $link);
            if ($stmt->execute()) {
                header("Location: admin_kelola_kerjasama.php?status=tambah_sukses");
                exit;
            } else {
                $message      = "Gagal simpan ke database.";
                $message_type = "error";
            }
        } elseif ($action === 'edit_kerjasama' && $kerjasama_id > 0) {
            $stmt = $conn->prepare("UPDATE kerjasama SET nama_instansi = ?, logo = ?, link_website = ? WHERE id = ?");
            $stmt->bind_param("sssi", $nama, $logo_db, $link, $kerjasama_id);
            if ($stmt->execute()) {
                header("Location: admin_kelola_kerjasama.php?status=edit_sukses");
                exit;
            } else {
                $message      = "Gagal update data di database.";
                $message_type = "error";
            }
        } else {
            $message      = "Aksi tidak valid atau logo belum diunggah.";
            $message_type = "error";
        }
    }
}
// ==========================================================
// 4. LOGIKA HAPUS DATA (GET ?hapus_id=xx)
// ==========================================================
if (isset($_GET['hapus_id'])) {
    $hapus_id = intval($_GET['hapus_id']);

    if ($hapus_id > 0) {
        $stmt = $conn->prepare("SELECT logo FROM kerjasama WHERE id = ?");
        $stmt->bind_param("i", $hapus_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $stmt->close();

        if ($row) {
            $logo_file = $row['logo'] ?? null;
            $stmt_del = $conn->prepare("DELETE FROM kerjasama WHERE id = ?");
            $stmt_del->bind_param("i", $hapus_id);
            if ($stmt_del->execute()) {
                $stmt_del->close();
                if (!empty($logo_file)) {
                    $logo_path = $upload_dir_path . $logo_file;
                    if (file_exists($logo_path)) {
                        @unlink($logo_path);
                    }
                }

                header("Location: admin_kelola_kerjasama.php?status=hapus_sukses");
                exit;
            } else {
                $message      = "Gagal menghapus data dari database.";
                $message_type = "error";
            }
        } else {
            $message      = "Data kerjasama tidak ditemukan.";
            $message_type = "error";
        }
    }
}

// ==========================================================
// 5. LOGIKA NOTIFIKASI DARI URL
// ==========================================================
if (isset($_GET['status']) && empty($message)) {
    if ($_GET['status'] === 'tambah_sukses') {
        $message      = "Partner kerjasama berhasil ditambahkan! 🎉";
        $message_type = "success";
    } elseif ($_GET['status'] === 'edit_sukses') {
        $message      = "Data kerjasama berhasil diupdate! ✏️";
        $message_type = "success";
    } elseif ($_GET['status'] === 'hapus_sukses') {
        $message      = "Data kerjasama berhasil dihapus. 🗑️";
        $message_type = "success";
    }
}

// ==========================================================
// 6. AMBIL DATA UNTUK TABEL & JS
// ==========================================================
$list_kerjasama = [];
$kerjasama_map  = [];
$result = $conn->query("SELECT * FROM kerjasama ORDER BY id DESC");
if ($result) { 
    while ($row = $result->fetch_assoc()) { 
        $list_kerjasama[]          = $row; 
        $kerjasama_map[$row['id']] = $row; 
    } 
}
$kerjasama_json = json_encode($kerjasama_map);
include 'includes/admin_header.php'; 
?>

    <!-- Purple Banner -->
    <div class="page-banner">
        <h1 class="banner-title">Kelola Kerjasama</h1>
    </div>
    
    <?php if (!empty($message)): ?>
        <div class="message <?= htmlspecialchars($message_type) ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header flex-between">
            <h2 class="card-title">Daftar Partner Kerjasama</h2>
            <button id="openKerjasamaTambahBtn" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Partner
            </button>
        </div>

        <div class="card-body">
            <div class="data-table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Logo</th>
                            <th>Instansi</th>
                            <th>Link</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php if (count($list_kerjasama) > 0): ?>
                        <?php $i = 1; foreach ($list_kerjasama as $item): ?>
                            <tr>
                                <td data-label="No"><?= $i++ ?></td>
                                <td data-label="Logo">
                                    <img src="<?= $upload_dir_path . htmlspecialchars($item['logo']) ?>"
                                         class="table-img"
                                         alt="Logo <?= htmlspecialchars($item['nama_instansi']) ?>">
                                </td>
                                <td data-label="Instansi"><?= htmlspecialchars($item['nama_instansi']) ?></td>
                                <td data-label="Link">
                                    <?php if (!empty($item['link_website'])): ?>
                                        <a href="<?= htmlspecialchars($item['link_website']) ?>"
                                           target="_blank"
                                           title="Kunjungi Website">
                                            Kunjungi <i class="fas fa-external-link-alt" style="font-size:0.8em;"></i>
                                        </a>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td data-label="Aksi" class="action-links">
                                    <a href="#"
                                       class="btn-icon edit kerjasama-edit-btn"
                                       data-id="<?= $item['id'] ?>"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="admin_kelola_kerjasama.php?hapus_id=<?= $item['id'] ?>"
                                       class="btn-icon delete"
                                       title="Hapus"
                                       onclick="return confirm('Yakin ingin menghapus partner <?= htmlspecialchars($item['nama_instansi']) ?>?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" style="text-align:center;">Belum ada data kerjasama.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<div id="kerjasamaTambahModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>TAMBAH PARTNER KERJASAMA</h2>
            <span class="close-btn">&times;</span>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="tambah_kerjasama">

            <div class="modal-body">
                <div class="input-box">
                    <label>Nama Instansi *</label>
                    <input type="text" name="nama_instansi" required>
                </div>
                <div class="input-box">
                    <label>Link Website (Opsional)</label>
                    <input type="text" name="link_website">
                </div>
                <div class="input-box">
                    <label>Logo (PNG/JPG/WEBP, Transparan disarankan) *</label>
                    <input type="file" name="logo_baru" accept=".jpg,.jpeg,.png,.webp" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
<div id="kerjasamaEditModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>EDIT PARTNER KERJASAMA</h2>
            <span class="close-btn">&times;</span>
        </div>

        <form id="kerjasamaEditForm" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="edit_kerjasama">
            <input type="hidden" name="kerjasama_id" id="edit_kerjasama_id">
            <input type="hidden" name="logo_lama" id="edit_logo_lama">

            <div class="modal-body">
                <div class="input-box">
                    <label>Nama Instansi *</label>
                    <input type="text" name="nama_instansi" id="edit_nama_instansi" required>
                </div>
                <div class="input-box">
                    <label>Link Website (Opsional)</label>
                    <input type="text" name="link_website" id="edit_link_website">
                </div>

                <div class="file-preview-box" id="logoPreviewContainer">
                    <img id="currentLogoSrc" src="" alt="Logo Lama">
                    <small id="currentLogoName"></small>
                </div>

                <div class="input-box">
                    <label>Logo Baru (Kosongkan jika tidak ingin ganti)</label>
                    <input type="file" name="logo_baru" id="edit_logo_baru" accept=".jpg,.jpeg,.png,.webp">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn">Batal</button>
                <button type="submit" class="btn btn-primary">Update Data</button>
            </div>
        </form>
    </div>
</div>
<?php include 'includes/admin_footer.php'; ?>
<script>
    window.dataKerjasama = <?= $kerjasama_json ?>;
    window.uploadKerjasama = '<?= $upload_dir_path ?>';
</script>

<script>
    window.kerjasamaData = <?= json_encode($list_kerjasama) ?>;
    window.uploadDir = "<?= $upload_dir_path ?>";

    document.addEventListener('DOMContentLoaded', () => {
        // Add
        const btnAdd = document.getElementById('openKerjasamaTambahBtn');
        if(btnAdd) {
            btnAdd.addEventListener('click', () => {
                 window.modalShow('kerjasamaTambahModal');
            });
        }

        // Edit
        document.querySelectorAll('.kerjasama-edit-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const id = this.dataset.id;
                const data = window.kerjasamaData.find(item => item.id == id);
                if(!data) return;

                document.getElementById('edit_kerjasama_id').value = data.id;
                document.getElementById('edit_nama_instansi').value = data.nama_instansi;
                document.getElementById('edit_link_website').value = data.link_website;
                document.getElementById('edit_logo_lama').value = data.logo;

                const img = document.getElementById('currentLogoSrc');
                const name = document.getElementById('currentLogoName');
                if(data.logo) {
                    img.src = window.uploadDir + data.logo;
                    img.style.display = 'block';
                    name.innerText = data.logo;
                } else {
                    img.style.display = 'none';
                    name.innerText = 'Tidak ada logo';
                }

                 window.modalShow('kerjasamaEditModal');
            });
        });

        // Close buttons (Generic loop for this page)
        document.querySelectorAll('.close-btn, .btn-tutup').forEach(btn => {
            btn.addEventListener('click', function() {
                const modal = this.closest('.modal');
                if(modal) window.modalHide(modal.id);
            });
        });
    });
</script>
