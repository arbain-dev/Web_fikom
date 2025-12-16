<?php
session_start();

include 'includes/admin_header.php';
require_once '../database/db_connect.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
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

<main class="content-area">
    <div class="breadcrumbs">
        <a href="dashboard.php">Admin</a> &gt; <span>Kelola Berita</span>
    </div>

    <div class="page-header">
        <h1>Daftar Berita</h1>
        <button class="btn-tambah" onclick="beritaModule.bukaPopup('tambah')">
            <i class="fas fa-plus"></i> Tambah Berita
        </button>
    </div>

    <?php if (!empty($message)): ?>
        <div class="kb-alert kb-alert-<?= $msg_type; ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <div class="content-box">
        <table class="data-table kb-data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Link</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php if (!empty($berita_list)): $i=1;
            foreach ($berita_list as $b): ?>

                <tr>
                    <td><?= $i++; ?></td>
                    <td>
                        <?php if (!empty($b['foto'])): ?>
                            <img src="../uploads/berita/<?= $b['foto']; ?>" width="60"
                                 onclick="beritaModule.previewImage('../uploads/berita/<?= $b['foto']; ?>')">
                        <?php else: ?> - <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($b['judul']); ?></td>
                    <td><?= htmlspecialchars($b['kategori']); ?></td>
                    <td><?= date('d M Y', strtotime($b['tanggal_publish'])); ?></td>
                    <td>
                        <?php if (!empty($b['link'])): ?>
                            <a href="<?= $b['link']; ?>" target="_blank">Buka</a>
                        <?php else: ?> - <?php endif; ?>
                    </td>
                    <td class="action-links">
                            <a href="#" class="edit"onclick='beritaModule.bukaPopup("edit", <?= json_encode($b); ?>)'>
                                <i class="fas fa-edit"></i></a>
                                 <a class="delete"
                                href="?action=hapus&id=<?= $b['id']; ?>"
                            onclick="return confirm('Yakin mau hapus berita ini?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>

            <?php endforeach; else: ?>
                <tr><td colspan="7" style="text-align:center;">Belum ada data</td></tr>
            <?php endif; ?>

            </tbody>
        </table>
    </div>
</main>
<div class="kb-popup-bg" id="kbPopupForm">
    <div class="kb-popup-box">
        <div class="kb-popup-header">
            <h2 id="kbPopupTitle">Tambah Berita</h2>
            <button class="kb-popup-close-x" onclick="beritaModule.tutupPopup()">×</button>
        </div>

        <form method="POST" enctype="multipart/form-data" id="kbFormBerita">

            <input type="hidden" name="action" id="kbFormAction">
            <input type="hidden" name="id" id="kbBeritaId">
            <input type="hidden" name="foto_lama" id="kbFotoLama">

            <div class="kb-form-group">
                <label>Judul Berita *</label>
                <input type="text" name="judul" id="kbJudul" required>
            </div>

            <div class="kb-form-group">
                <label>Kategori *</label>
                <select name="kategori" id="kbKategori" required>
                    <option value="">-- Pilih --</option>
                    <option>Informasi</option>
                    <option>Pengumuman</option>
                    <option>Kampus</option>
                    <option>Kegiatan UKM</option>
                    <option>Akademik</option>
                </select>
            </div>

            <div class="kb-form-group">
                <label>Tanggal Publish *</label>
                <input type="date" name="tanggal_publish" id="kbTanggal" required>
            </div>

            <div class="kb-form-group">
                <label>Link</label>
                <input type="text" name="link" id="kbLink">
            </div>

            <div class="kb-form-group">
                <label>Konten</label>
                <textarea name="konten" id="kbKonten"></textarea>
            </div>

            <div class="kb-form-group">
                <label>Upload Foto</label>
                <input type="file" name="foto" id="kbFotoInput" accept="image/*">
                <img id="kbPreviewFotoKecil" style="width:80px;margin-top:10px;display:none;">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-tutup" onclick="beritaModule.tutupPopup()">Tutup</button>
                <button type="submit" class="btn btn-simpan">Simpan Data</button>
            </div>

        </form>
    </div>
</div>
<div class="kb-popup-bg" id="kbPopupImagePreview">
    <div class="kb-preview-img-box">
        <img id="kbImgFull" src="">
    </div>
</div>
<script src="../assets/js/admin_global.js"></script>
</body>
</html>
