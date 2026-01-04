<?php
session_start();

include 'includes/admin_header.php';
require_once '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
$base_url = '../';
$message  = "";
$msg_type = "";

// -------------------------
// Helper Delete File Aman
// -------------------------
function safeDeleteFile($filePath) {
    if (empty($filePath) || !file_exists($filePath)) return true;

    for ($i=0; $i<3; $i++) {
        try {
            if (is_file($filePath) && is_writable($filePath)) {
                if (@unlink($filePath)) return true;
            } elseif (is_file($filePath)) {
                @chmod($filePath, 0777);
                if (@unlink($filePath)) return true;
            }
        } catch (Exception $e) {}
        if ($i < 2) usleep(100000);
    }
    return false;
}

// -------------------------
// Helper Generate File Aman
// -------------------------
function generateSafeFileName($originalFileName) {
    $ext  = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $name = pathinfo($originalFileName, PATHINFO_FILENAME);
    $name = preg_replace('/[^A-Za-z0-9_-]/', '_', $name);
    return time() . '_' . md5(uniqid(rand(), true)) . '.' . $ext;
}


// -----------------------------------------------------------
// HAPUS DATA
// -----------------------------------------------------------
if (isset($_GET['action']) && $_GET['action'] == 'hapus' && isset($_GET['id'])) {
    $id_hapus = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT foto FROM berita WHERE id = ?");
    $stmt->bind_param("i", $id_hapus);
    $stmt->execute();
    $result = $stmt->get_result();
    $row    = $result->fetch_assoc();
    $foto   = $row['foto'] ?? '';
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM berita WHERE id = ?");
    $stmt->bind_param("i", $id_hapus);

    if ($stmt->execute()) {
        if (!empty($foto)) safeDeleteFile("../uploads/berita/" . $foto);
        $message  = "✓ Berita berhasil dihapus!";
        $msg_type = "success";
    } else {
        $message  = "Gagal menghapus data.";
        $msg_type = "error";
    }
    $stmt->close();
}


// -----------------------------------------------------------
// TAMBAH / EDIT
// -----------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action   = $_POST['action'];
    $judul    = trim($_POST['judul']);
    $kategori = trim($_POST['kategori']);
    $tanggal  = trim($_POST['tanggal_publish']);
    $link     = trim($_POST['link']);
    $konten   = trim($_POST['konten']);

    if (empty($judul) || empty($kategori) || empty($tanggal)) {
        $message = "Judul, kategori, dan tanggal wajib diisi!";
        $msg_type = "error";
    } else {
        $target_dir = "../uploads/berita/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        // =====================
        // TAMBAH
        // =====================
        if ($action == 'tambah') {

            $foto_nama = "";
            if (!empty($_FILES['foto']['name'])) {
                $foto_nama = generateSafeFileName($_FILES['foto']['name']);
                move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $foto_nama);
            }

            $stmt = $conn->prepare("
                INSERT INTO berita (judul, kategori, tanggal_publish, link, konten, foto)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->bind_param("ssssss", $judul, $kategori, $tanggal, $link, $konten, $foto_nama);

            if ($stmt->execute()) {
                $message = "✓ Berita berhasil ditambahkan!";
                $msg_type = "success";
            } else {
                $message = "Gagal menambah data!";
                $msg_type = "error";
            }
            $stmt->close();
        }

        // =====================
        // EDIT
        // =====================
        if ($action == 'edit') {
            $id        = intval($_POST['id']);
            $foto_lama = $_POST['foto_lama'];
            $foto_nama = $foto_lama;

            if (!empty($_FILES['foto']['name'])) {
                $foto_nama_baru = generateSafeFileName($_FILES['foto']['name']);

                if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $foto_nama_baru)) {
                    $foto_nama = $foto_nama_baru;
                    if (!empty($foto_lama)) safeDeleteFile($target_dir . $foto_lama);
                }
            }

            $stmt = $conn->prepare("
                UPDATE berita SET judul=?, kategori=?, tanggal_publish=?, link=?, konten=?, foto=? 
                WHERE id=?
            ");
            $stmt->bind_param("ssssssi", $judul, $kategori, $tanggal, $link, $konten, $foto_nama, $id);

            if ($stmt->execute()) {
                $message = "✓ Berita berhasil diperbarui!";
                $msg_type = "success";
            } else {
                $message = "Gagal memperbarui berita!";
                $msg_type = "error";
            }
            $stmt->close();
        }
    }
}


// AMBIL DATA TABEL
$berita_list = [];
$result = $conn->query("SELECT * FROM berita ORDER BY tanggal_publish DESC");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) $berita_list[] = $row;
}
?>

    <!-- Purple Banner -->
    <div class="page-banner">
        <h1 class="banner-title">Daftar Berita</h1>
    </div>

    <?php if (!empty($message)): ?>
        <div class="alert alert-<?= $msg_type == 'success' ? 'success' : 'error' ?> mb-6">
            <?= $message ?>
        </div>
    <?php endif; ?>



    <!-- Unified Card Layout -->
    <div class="card">
        <div class="card-header flex-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">Data Berita Terkini</h2>
            <button class="btn btn-primary" onclick="beritaModule.bukaPopup('tambah')">
                <i class="fas fa-plus mr-2"></i> Tambah Berita
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($berita_list)): $i=1; foreach ($berita_list as $b): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td>
                                <?php if (!empty($b['foto'])): ?>
                                    <img src="../uploads/berita/<?= $b['foto']; ?>" class="table-img-sm" style="width:50px; height:50px; object-fit:cover; border-radius:4px;" onclick="beritaModule.previewImage('../uploads/berita/<?= $b['foto']; ?>')">
                                <?php else: ?>
                                    <span class="text-muted"><i class="fas fa-image"></i></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($b['judul']); ?>
                                <?php if (!empty($b['link'])): ?>
                                    <br><a href="<?= $b['link']; ?>" target="_blank" class="text-xs text-blue-500"><i class="fas fa-external-link-alt"></i> External</a>
                                <?php endif; ?>
                            </td>
                            <td><span class="badge badge-category"><?= htmlspecialchars($b['kategori']); ?></span></td>
                            <td><?= date('d M Y', strtotime($b['tanggal_publish'])); ?></td>
                            <td class="action-links">
                                <button class="btn-icon edit" onclick='beritaModule.bukaPopup("edit", <?= json_encode($b); ?>)' title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="?action=hapus&id=<?= $b['id']; ?>" class="btn-icon delete" onclick="return confirm('Yakin mau hapus berita ini?')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="6" class="text-center">Belum ada data berita.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- MODAL FORM (FIXED CENTER) -->
<div id="kbPopupForm" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="kbPopupTitle">Tambah Berita</h2>
            <button type="button" class="close-btn" onclick="beritaModule.tutupPopup()">&times;</button>
        </div>

        <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" id="kbFormBerita">
                <input type="hidden" name="action" id="kbFormAction">
                <input type="hidden" name="id" id="kbBeritaId">
                <input type="hidden" name="foto_lama" id="kbFotoLama">

                <div class="input-box">
                    <label>Judul Berita <span class="text-error">*</span></label>
                    <input type="text" name="judul" id="kbJudul" required placeholder="Masukkan judul berita...">
                </div>

                <div class="input-row">
                    <div class="input-box">
                        <label>Kategori <span class="text-error">*</span></label>
                        <select name="kategori" id="kbKategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option>Informasi</option>
                            <option>Pengumuman</option>
                            <option>Kampus</option>
                            <option>Kegiatan UKM</option>
                            <option>Akademik</option>
                        </select>
                    </div>

                    <div class="input-box">
                        <label>Tanggal Publish <span class="text-error">*</span></label>
                        <input type="date" name="tanggal_publish" id="kbTanggal" required>
                    </div>
                </div>

                <div class="input-box">
                    <label>Link Eksternal (Opsional)</label>
                    <input type="url" name="link" id="kbLink" placeholder="https://...">
                </div>

                <div class="input-box">
                    <label>Konten Berita</label>
                    <textarea name="konten" id="kbKonten" rows="4" placeholder="Tulis isi berita..."></textarea>
                </div>

                <div class="input-box">
                    <label>Upload Foto</label>
                    <input type="file" name="foto" id="kbFotoInput" accept="image/*">
                    <div class="file-preview-box mt-3 hidden" id="previewContainer">
                        <img id="kbPreviewFotoKecil" class="img-preview-sm hidden">
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="beritaModule.tutupPopup()">Batal</button>
            <button type="button" class="btn btn-primary" onclick="document.getElementById('kbFormBerita').submit()">Simpan Data</button>
        </div>
    </div>
</div>

<!-- MODAL IMAGE PREVIEW -->
<div id="kbPopupImagePreview" class="modal modal-image-preview">
    <img id="kbImgFull" src="" class="modal-image-full">
    <button class="modal-close-absolute" onclick="beritaModule.tutupPopupImage()">&times;</button>
</div>


<?php include 'includes/admin_footer.php'; ?>
