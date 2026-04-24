<?php
// 1. PENGATURAN AWAL & KONEKSI
session_start();
require_once '../config/database.php'; 

// 2. CEK LOGIN
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login");
    exit;
}

$message = '';
$message_type = '';

// Fungsi untuk mendapatkan YouTube Video ID
function getYouTubeId($url) {
    $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i';
    if (preg_match($pattern, $url, $match)) {
        return $match[1];
    }
    return false;
}

// ==========================================================
// 3. LOGIKA CRUD (PHP)
// ==========================================================
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ==== TAMBAH VIDEO ====
    if (isset($_POST['action']) && $_POST['action'] == 'tambah_video') {
        $judul           = trim($_POST['judul']);
        $deskripsi       = trim($_POST['deskripsi']);
        $kategori        = trim($_POST['kategori']);
        $tanggal_publish = trim($_POST['tanggal_publish']);
        $link_youtube    = trim($_POST['link_youtube']);
        
        $youtube_id = getYouTubeId($link_youtube);
        
        if (!$youtube_id) {
            $message = "URL YouTube tidak valid. Harap masukkan link yang benar.";
            $message_type = 'error';
        } else {
            $embed_link = "https://www.youtube.com/embed/" . $youtube_id;
            
            $stmt = $conn->prepare("INSERT INTO galeri_video (judul, deskripsi, kategori, link_youtube, tanggal_publish) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $judul, $deskripsi, $kategori, $embed_link, $tanggal_publish);
            if ($stmt->execute()) {
                header("Location: kelola_galeri_video?status=tambah_sukses");
                exit;
            } else {
                $message = "Database Error: " . $stmt->error;
                $message_type = 'error';
            }
        }
    }

    // ==== EDIT VIDEO ====
    elseif (isset($_POST['action']) && $_POST['action'] == 'edit_video') {
        $id              = $_POST['id_edit'];
        $judul           = trim($_POST['judul_edit']);
        $deskripsi       = trim($_POST['deskripsi_edit']);
        $kategori        = trim($_POST['kategori_edit']);
        $tanggal_publish = trim($_POST['tanggal_publish_edit']);
        $link_youtube    = trim($_POST['link_youtube_edit']);
        
        $youtube_id = getYouTubeId($link_youtube);
        
        // Cek jika ID tidak ditemukan, asumsikan itu mungkin sudah berupa link embed sebelumnya
        if (!$youtube_id && strpos($link_youtube, 'embed/') !== false) {
            $embed_link = $link_youtube;
        } elseif ($youtube_id) {
            $embed_link = "https://www.youtube.com/embed/" . $youtube_id;
        } else {
            $message = "URL YouTube tidak valid.";
            $message_type = 'error';
        }

        if (empty($message)) {
            $stmt = $conn->prepare("UPDATE galeri_video SET judul=?, deskripsi=?, kategori=?, link_youtube=?, tanggal_publish=? WHERE id=?");
            $stmt->bind_param("sssssi", $judul, $deskripsi, $kategori, $embed_link, $tanggal_publish, $id);
            if ($stmt->execute()) {
                header("Location: kelola_galeri_video?status=edit_sukses");
                exit;
            } else {
                $message = "Database Error: " . $stmt->error;
                $message_type = 'error';
            }
        }
    }

    // ==== HAPUS VIDEO ====
    elseif (isset($_POST['action']) && $_POST['action'] == 'hapus_video') {
        $id = intval($_POST['video_id']);
        $conn->query("DELETE FROM galeri_video WHERE id=$id");
        header("Location: kelola_galeri_video?status=hapus_sukses");
        exit;
    }
}

// 4. NOTIFIKASI
if (isset($_GET['status']) && empty($message)) {
    $map = [
        'tambah_sukses' => "Video berhasil ditambahkan! 🎉",
        'edit_sukses'   => "Video berhasil diperbarui! ✏️",
        'hapus_sukses'  => "Video berhasil dihapus. 🗑️",
    ];
    $message = $map[$_GET['status']] ?? '';
    $message_type = 'success';
}

// 5. AMBIL DATA
$list_video = [];
$result = $conn->query("SELECT * FROM galeri_video ORDER BY tanggal_publish DESC, id DESC");
if ($result) while ($r = $result->fetch_assoc()) $list_video[] = $r;

// Convert ke JSON untuk JS
$json_data = json_encode($list_video);

include 'includes/admin_header.php';
?>

    <!-- Banner Ungu -->
    <div class="page-banner">
        <h1 class="banner-title">Kelola Galeri Video</h1>
    </div>

    <?php if (!empty($message)): ?>
        <div class="alert alert-<?= $message_type == 'success' ? 'success' : 'error' ?> mb-6">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header flex-between">
            <h2 class="card-title">Daftar Video YouTube</h2>
            <button id="openModalBtnTambah" class="btn btn-primary" onclick="document.getElementById('tambahModal').classList.add('show'); document.getElementById('tambahModal').style.display='flex'; document.body.style.overflow='hidden';">
                <i class="fas fa-plus"></i> Tambah Video
            </button>
        </div>
        <div class="card-body">
            <div class="data-table-wrapper" style="overflow-x: auto; -webkit-overflow-scrolling: touch; padding-bottom: 5px;">
                <table class="data-table" style="min-width: 800px;">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 150px;">Thumbnail</th>
                            <th>Judul & Info</th>
                            <th>Deskripsi</th>
                            <th style="width: 120px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php if ($list_video): $i=1; foreach ($list_video as $r): ?>
                    <tr>
                        <td data-label="No"><?= $i++ ?></td>
                        <td data-label="Thumbnail">
                            <iframe width="120" height="68" src="<?= htmlspecialchars($r['link_youtube']) ?>" frameborder="0" allowfullscreen style="border-radius: 4px;"></iframe>
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
                                <button type="button" class="btn-icon edit" onclick='editVideo(<?= json_encode($r) ?>)' title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                
                                <form method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus video ini?');">
                                    <input type="hidden" name="action" value="hapus_video">
                                    <input type="hidden" name="video_id" value="<?= $r['id'] ?>">
                                    <button type="submit" class="delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data Video.</td>
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
            <h2>Tambah Video Baru</h2>
            <span class="close-btn" onclick="closeModal('tambahModal')">&times;</span>
        </div>
        
        <form method="POST">
            <div class="modal-body">
                <input type="hidden" name="action" value="tambah_video">
                
                <div class="input-box">
                    <label>Judul Video</label>
                    <input type="text" name="judul" required placeholder="Masukkan judul video">
                </div>
                
                <div class="input-box">
                    <label>Kategori / Label</label>
                    <input type="text" name="kategori" required placeholder="Contoh: Pengabdian Masyarakat">
                </div>

                <div class="input-box">
                    <label>Link YouTube</label>
                    <input type="text" name="link_youtube" required placeholder="https://www.youtube.com/watch?v=...">
                    <small class="text-muted">Masukkan link video YouTube, sistem akan otomatis menjadikannya player (embed).</small>
                </div>

                <div class="input-box">
                    <label>Tanggal Publish</label>
                    <input type="date" name="tanggal_publish" required value="<?= date('Y-m-d') ?>">
                </div>
                
                <div class="input-box">
                    <label>Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat..."></textarea>
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
            <h2>Edit Video</h2>
            <span class="close-btn" onclick="closeModal('editModal')">&times;</span>
        </div>
        
        <form method="POST">
            <div class="modal-body">
                <input type="hidden" name="action" value="edit_video">
                <input type="hidden" name="id_edit" id="id_edit">

                <div class="input-box">
                    <label>Judul Video</label>
                    <input type="text" name="judul_edit" id="judul_edit" required>
                </div>
                
                <div class="input-box">
                    <label>Kategori / Label</label>
                    <input type="text" name="kategori_edit" id="kategori_edit" required>
                </div>

                <div class="input-box">
                    <label>Link YouTube (Embed URL saat ini)</label>
                    <input type="text" name="link_youtube_edit" id="link_youtube_edit" required>
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

function editVideo(data) {
    document.getElementById('id_edit').value = data.id;
    document.getElementById('judul_edit').value = data.judul;
    document.getElementById('kategori_edit').value = data.kategori;
    document.getElementById('link_youtube_edit').value = data.link_youtube;
    document.getElementById('tanggal_publish_edit').value = data.tanggal_publish;
    document.getElementById('deskripsi_edit').value = data.deskripsi;
    
    document.getElementById('editModal').classList.add('show');
    document.getElementById('editModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
</script>

<?php include 'includes/admin_footer.php'; ?>
