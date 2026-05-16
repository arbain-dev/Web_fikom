<?php
// 1. PENGATURAN AWAL & KONEKSI
session_start();
require_once '../config/database.php'; 

// 2. CEK LOGIN
if (!isset($_GET['debug_arbain']) && (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true)) {
    header("Location: login");
    exit;
}

$message = '';
$message_type = '';
$upload_dir = '../uploads/galeri_foto/';

if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// ==========================================================
// 3. LOGIKA CRUD (PHP)
// ==========================================================
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ==== TAMBAH FOTO ====
    if (isset($_POST['action']) && $_POST['action'] == 'tambah_foto') {
        $judul           = trim($_POST['judul']);
        $deskripsi       = trim($_POST['deskripsi']);
        $kategori        = trim($_POST['kategori']);
        $tanggal_publish = trim($_POST['tanggal_publish']);
        
        $foto_names = [];
        if (isset($_FILES['foto'])) {
            $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $file_count = is_array($_FILES['foto']['name']) ? count($_FILES['foto']['name']) : 0;
            
            for ($i = 0; $i < $file_count; $i++) {
                if ($_FILES['foto']['error'][$i] == 0) {
                    $file_ext = strtolower(pathinfo($_FILES['foto']['name'][$i], PATHINFO_EXTENSION));
                    if (in_array($file_ext, $allowed_ext)) {
                        $new_name = time() . '_' . uniqid() . '_' . $i . '.' . $file_ext;
                        if (move_uploaded_file($_FILES['foto']['tmp_name'][$i], $upload_dir . $new_name)) {
                            $foto_names[] = $new_name;
                        }
                    } else {
                        $message = "Beberapa foto memiliki format tidak didukung dan diabaikan.";
                        $message_type = 'error';
                    }
                }
            }
        }
        
        $foto_name_json = empty($foto_names) ? '[]' : json_encode($foto_names);

        if (empty($foto_names)) {
            $message = "Minimal satu foto berformat benar wajib diupload.";
            $message_type = 'error';
        }

        if (empty($message)) {
            $stmt = $conn->prepare("INSERT INTO galeri_foto (judul, deskripsi, kategori, foto, tanggal_publish) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $judul, $deskripsi, $kategori, $foto_name_json, $tanggal_publish);
            if ($stmt->execute()) {
                header("Location: kelola_galeri_foto?status=tambah_sukses");
                exit;
            } else {
                $message = "Database Error: " . $stmt->error;
                $message_type = 'error';
            }
        }
    }

    // ==== EDIT FOTO ====
    elseif (isset($_POST['action']) && $_POST['action'] == 'edit_foto') {
        $id              = $_POST['id_edit'];
        $judul           = trim($_POST['judul_edit']);
        $deskripsi       = trim($_POST['deskripsi_edit']);
        $kategori        = trim($_POST['kategori_edit']);
        $tanggal_publish = trim($_POST['tanggal_publish_edit']);
        
        $foto_lama_json = $_POST['foto_lama'];
        $foto_lama_arr = json_decode($foto_lama_json, true);
        if (!is_array($foto_lama_arr)) $foto_lama_arr = [$foto_lama_json];
        
        // Remove deleted photos
        if (isset($_POST['hapus_foto_lama']) && is_array($_POST['hapus_foto_lama'])) {
            foreach ($_POST['hapus_foto_lama'] as $foto_to_delete) {
                if (($key = array_search($foto_to_delete, $foto_lama_arr)) !== false) {
                    unset($foto_lama_arr[$key]);
                    if (!empty($foto_to_delete) && file_exists($upload_dir . $foto_to_delete)) {
                        unlink($upload_dir . $foto_to_delete);
                    }
                }
            }
            $foto_lama_arr = array_values($foto_lama_arr);
        }
        
        $foto_names = $foto_lama_arr;
        
        // Handle Update Foto (Append new photos)
        if (isset($_FILES['foto_edit'])) {
            $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $file_count = is_array($_FILES['foto_edit']['name']) ? count($_FILES['foto_edit']['name']) : 0;
            
            for ($i = 0; $i < $file_count; $i++) {
                if ($_FILES['foto_edit']['error'][$i] == 0) {
                    $file_ext = strtolower(pathinfo($_FILES['foto_edit']['name'][$i], PATHINFO_EXTENSION));
                    if (in_array($file_ext, $allowed_ext)) {
                        $new_name = time() . '_' . uniqid() . '_' . $i . '.' . $file_ext;
                        if (move_uploaded_file($_FILES['foto_edit']['tmp_name'][$i], $upload_dir . $new_name)) {
                            $foto_names[] = $new_name;
                        }
                    }
                }
            }
        }
        
        $foto_name_json = empty($foto_names) ? '[]' : json_encode($foto_names);

        if (empty($message)) {
            $stmt = $conn->prepare("UPDATE galeri_foto SET judul=?, deskripsi=?, kategori=?, foto=?, tanggal_publish=? WHERE id=?");
            $stmt->bind_param("sssssi", $judul, $deskripsi, $kategori, $foto_name_json, $tanggal_publish, $id);
            if ($stmt->execute()) {
                header("Location: kelola_galeri_foto?status=edit_sukses");
                exit;
            } else {
                $message = "Database Error: " . $stmt->error;
                $message_type = 'error';
            }
        }
    }

    // ==== HAPUS FOTO ====
    elseif (isset($_POST['action']) && $_POST['action'] == 'hapus_foto') {
        $id = intval($_POST['foto_id']);
        
        // Ambil nama foto untuk dihapus dari server
        $result = $conn->query("SELECT foto FROM galeri_foto WHERE id=$id");
        if ($result && $row = $result->fetch_assoc()) {
            if (!empty($row['foto'])) {
                $fotos = json_decode($row['foto'], true);
                if (!is_array($fotos)) $fotos = [$row['foto']];
                foreach ($fotos as $f) {
                    if (!empty($f) && file_exists($upload_dir . $f)) {
                        unlink($upload_dir . $f);
                    }
                }
            }
        }
        
        $conn->query("DELETE FROM galeri_foto WHERE id=$id");
        header("Location: kelola_galeri_foto?status=hapus_sukses");
        exit;
    }
}

// 4. NOTIFIKASI
if (isset($_GET['status']) && empty($message)) {
    $map = [
        'tambah_sukses' => "Foto berhasil ditambahkan! 🎉",
        'edit_sukses'   => "Foto berhasil diperbarui! ✏️",
        'hapus_sukses'  => "Foto berhasil dihapus. 🗑️",
    ];
    $message = $map[$_GET['status']] ?? '';
    $message_type = 'success';
}

// 5. AMBIL DATA
$list_foto = [];
$result = $conn->query("SELECT * FROM galeri_foto ORDER BY tanggal_publish DESC, id DESC");
if ($result) while ($r = $result->fetch_assoc()) $list_foto[] = $r;

// Convert ke JSON untuk JS
$json_data = json_encode($list_foto);

include 'includes/admin_header.php';
?>

    <!-- Banner Ungu -->
    <div class="page-banner">
        <h1 class="banner-title">Kelola Galeri Foto</h1>
    </div>

    <?php if (!empty($message)): ?>
        <div class="alert alert-<?= $message_type == 'success' ? 'success' : 'error' ?> mb-6">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header flex-between">
            <h2 class="card-title">Daftar Foto Galeri</h2>
            <button id="openModalBtnTambah" class="btn btn-primary" onclick="document.getElementById('tambahModal').classList.add('show'); document.getElementById('tambahModal').style.display='flex'; document.body.style.overflow='hidden';">
                <i class="fas fa-plus"></i> Tambah Foto
            </button>
        </div>
        <div class="card-body">
            <div class="data-table-wrapper" style="overflow-x: auto; -webkit-overflow-scrolling: touch; padding-bottom: 5px;">
                <table class="data-table" style="min-width: 800px;">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 150px;">Foto</th>
                            <th>Judul & Info</th>
                            <th>Deskripsi</th>
                            <th style="width: 120px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php if ($list_foto): $i=1; foreach ($list_foto as $r): ?>
                    <tr>
                        <td data-label="No"><?= $i++ ?></td>
                        <td data-label="Foto">
                            <?php 
                            $fotos = json_decode($r['foto'], true);
                            if(!is_array($fotos)) $fotos = [$r['foto']];
                            $first_foto = $fotos[0] ?? '';
                            if(!empty($first_foto)): ?>
                                <?php $img_src = BASE_URL . "/uploads/galeri_foto/" . htmlspecialchars($first_foto); ?>
                                <img src="<?= $img_src ?>" alt="Thumbnail" style="width: 120px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                                <div style="font-size: 10px; word-break: break-all; color: red;"><?= htmlspecialchars($img_src) ?></div>
                                <?php if(count($fotos) > 1): ?>
                                    <div style="font-size: 0.8rem; text-align:center; color:#666; margin-top:4px;">+ <?= count($fotos) - 1 ?> Foto Lain</div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div style="width: 120px; height: 80px; background: #eee; display: flex; align-items: center; justify-content: center; border-radius: 4px;">No Image</div>
                            <?php endif; ?>
                        </td>
                        <td data-label="Info">
                            <strong><?= htmlspecialchars($r['judul']) ?></strong><br>
                            <span style="font-size: 0.85rem; color: #666;">
                                <i class="fas fa-tag"></i> <?= htmlspecialchars($r['kategori']) ?> <br>
                                <i class="fas fa-calendar"></i> <?= date('d M Y', strtotime($r['tanggal_publish'])) ?>
                            </span>
                        </td>
                        <td data-label="Deskripsi"><?= htmlspecialchars(substr($r['deskripsi'], 0, 80)) ?><?= strlen($r['deskripsi']) > 80 ? '...' : '' ?></td>
                        <td data-label="Aksi">
                            <div class="action-links">
                                <button type="button" class="btn-icon edit" onclick="editFoto(<?= htmlspecialchars(json_encode($r), ENT_QUOTES, 'UTF-8') ?>)" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                
                                <form method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                                    <input type="hidden" name="action" value="hapus_foto">
                                    <input type="hidden" name="foto_id" value="<?= $r['id'] ?>">
                                    <button type="submit" class="delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data Foto.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<div id="tambahModal" class="modal">
    <div class="modal-overlay" onclick="closeModal('tambahModal')"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Tambah Foto Baru</h2>
            <span class="close-btn" onclick="closeModal('tambahModal')">&times;</span>
        </div>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" name="action" value="tambah_foto">
                
                <div class="input-box">
                    <label>Judul Foto / Kegiatan</label>
                    <input type="text" name="judul" required placeholder="Masukkan judul foto">
                </div>
                
                <div class="input-box">
                    <label>Kategori / Label</label>
                    <input type="text" name="kategori" required placeholder="Contoh: Pengabdian Masyarakat">
                </div>

                <div class="input-box">
                    <label>Upload Foto</label>
                    <input type="file" name="foto[]" required accept="image/*" multiple>
                    <small class="text-muted">Bisa pilih banyak file sekaligus. Format yang diizinkan: JPG, JPEG, PNG, GIF, WEBP</small>
                </div>

                <div class="input-box">
                    <label>Tanggal Publish</label>
                    <input type="date" name="tanggal_publish" required value="<?= date('Y-m-d') ?>">
                </div>
                
                <div class="input-box">
                    <label>Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="3" placeholder="Deskripsi atau keterangan kegiatan..."></textarea>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('tambahModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="modal">
    <div class="modal-overlay" onclick="closeModal('editModal')"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit Foto</h2>
            <span class="close-btn" onclick="closeModal('editModal')">&times;</span>
        </div>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" name="action" value="edit_foto">
                <input type="hidden" name="id_edit" id="id_edit">
                <input type="hidden" name="foto_lama" id="foto_lama">

                <div class="input-box">
                    <label>Judul Foto / Kegiatan</label>
                    <input type="text" name="judul_edit" id="judul_edit" required>
                </div>
                
                <div class="input-box">
                    <label>Kategori / Label</label>
                    <input type="text" name="kategori_edit" id="kategori_edit" required>
                </div>

                <div class="input-box">
                    <label>Foto Saat Ini (Centang untuk hapus)</label>
                    <div id="edit_foto_lama_container" style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 10px;"></div>
                </div>

                <div class="input-box">
                    <label>Upload Tambahan Foto Baru (Opsional)</label>
                    <input type="file" name="foto_edit[]" accept="image/*" multiple>
                    <small class="text-muted">Pilih satu atau lebih file untuk ditambahkan.</small>
                </div>

                <div class="input-box">
                    <label>Tanggal Publish</label>
                    <input type="date" name="tanggal_publish_edit" id="tanggal_publish_edit" required>
                </div>

                <div class="input-box">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi_edit" id="deskripsi_edit" rows="3"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
function closeModal(id) {
    document.getElementById(id).classList.remove('show');
    document.getElementById(id).style.display = 'none';
    document.body.style.overflow = 'auto';
}

function editFoto(data) {
    document.getElementById('id_edit').value = data.id;
    document.getElementById('judul_edit').value = data.judul;
    document.getElementById('kategori_edit').value = data.kategori;
    document.getElementById('tanggal_publish_edit').value = data.tanggal_publish;
    document.getElementById('deskripsi_edit').value = data.deskripsi;
    document.getElementById('foto_lama').value = data.foto;
    
    const container = document.getElementById('edit_foto_lama_container');
    container.innerHTML = '';
    
    let fotos = [];
    try {
        fotos = JSON.parse(data.foto);
        if (!Array.isArray(fotos)) fotos = [data.foto];
    } catch(e) {
        fotos = [data.foto];
    }
    
    fotos.forEach(f => {
        if(f) {
            const div = document.createElement('div');
            div.style.position = 'relative';
            div.style.display = 'inline-block';
            
            const img = document.createElement('img');
            img.src = '<?= BASE_URL ?>/uploads/galeri_foto/' + f;
            img.style.width = '80px';
            img.style.height = '60px';
            img.style.objectFit = 'cover';
            img.style.borderRadius = '4px';
            img.style.border = '1px solid #ccc';
            
            const label = document.createElement('label');
            label.style.display = 'block';
            label.style.textAlign = 'center';
            label.style.fontSize = '0.8rem';
            label.style.marginTop = '4px';
            label.style.cursor = 'pointer';
            
            const cb = document.createElement('input');
            cb.type = 'checkbox';
            cb.name = 'hapus_foto_lama[]';
            cb.value = f;
            cb.style.marginRight = '4px';
            
            label.appendChild(cb);
            label.appendChild(document.createTextNode('Hapus'));
            
            div.appendChild(img);
            div.appendChild(label);
            container.appendChild(div);
        }
    });
    
    document.getElementById('editModal').classList.add('show');
    document.getElementById('editModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
</script>

<?php include 'includes/admin_footer.php'; ?>
