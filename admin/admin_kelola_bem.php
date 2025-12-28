<?php
session_start();
$page_title = "Kelola Struktur BEM";
require '../config/database.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$message = '';
$message_type = '';
$upload_dir = '../uploads/bem/'; 
if (!is_dir($upload_dir)) {
    @mkdir($upload_dir, 0777, true);
}
// =========================================================
// 1. PROSES HAPUS (GET ?action=delete&id=..)
// =========================================================
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    if ($id > 0) {
        $stmt = $conn->prepare("SELECT foto FROM bem_struktur WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($data) {
            $old_foto = $data['foto'] ?? '';
            $del = $conn->prepare("DELETE FROM bem_struktur WHERE id = ?");
            $del->bind_param("i", $id);
            if ($del->execute()) {
                if (!empty($old_foto) && file_exists($upload_dir . $old_foto)) {
                    @unlink($upload_dir . $old_foto);
                }
                $message = "Data BEM berhasil dihapus.";
                $message_type = "success";
            } else {
                $message = "Gagal menghapus data: " . $del->error;
                $message_type = "error";
            }
            $del->close();
        } else {
            $message = "Data BEM tidak ditemukan.";
            $message_type = "error";
        }
    }
}

// =========================================================
// 2. PROSES TAMBAH / EDIT (POST)
// =========================================================
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action'])) {
    $action   = $_POST['action'];
    $nama     = trim($_POST['nama'] ?? '');
    $jabatan  = trim($_POST['jabatan'] ?? '');
    $prodi    = trim($_POST['prodi'] ?? '');
    $kategori = $_POST['kategori'] ?? 'departemen';
    $urutan   = (int) ($_POST['urutan'] ?? 1);

    if ($nama === '' || $jabatan === '') {
        $message = "Nama dan Jabatan wajib diisi.";
        $message_type = "error";
    } else {

        // -------- LOGIKA UPLOAD FOTO --------
        $foto_baru = '';
        $upload_ok = true;

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
            $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png'];

            if (!in_array($ext, $allowed)) {
                $message = "Format gambar tidak valid. Gunakan JPG/PNG.";
                $message_type = "error";
                $upload_ok = false;
            } else {
                $foto_baru = time() . "_" . rand(100,999) . "." . $ext;
                if (!move_uploaded_file($_FILES['foto']['tmp_name'], $upload_dir . $foto_baru)) {
                    $message = "Gagal mengupload gambar.";
                    $message_type = "error";
                    $upload_ok = false;
                }
            }
        }
        if ($upload_ok) {
            // ---------- TAMBAH ----------
            if ($action === 'add') {
                if ($foto_baru == '') {
                    $message = "Foto wajib diupload untuk data baru.";
                    $message_type = "error";
                } else {
                    $stmt = $conn->prepare("
                        INSERT INTO bem_struktur (nama, jabatan, prodi, kategori, urutan, foto)
                        VALUES (?, ?, ?, ?, ?, ?)
                    ");
                    $stmt->bind_param("ssssis", $nama, $jabatan, $prodi, $kategori, $urutan, $foto_baru);

                    if ($stmt->execute()) {
                        $message = "Anggota BEM berhasil ditambahkan.";
                        $message_type = "success";
                    } else {
                        $message = "Gagal menambah data: " . $stmt->error;
                        $message_type = "error";
                        if ($foto_baru && file_exists($upload_dir . $foto_baru)) {
                            @unlink($upload_dir . $foto_baru);
                        }
                    }
                    $stmt->close();
                }

            // ---------- EDIT ----------
            } elseif ($action === 'edit') {
                $id = (int) ($_POST['id'] ?? 0);
                $foto_lama = $_POST['foto_lama'] ?? '';

                if ($id <= 0) {
                    $message = "ID tidak valid.";
                    $message_type = "error";
                } else {
                    if ($foto_baru !== '') {
                        if (!empty($foto_lama) && file_exists($upload_dir . $foto_lama)) {
                            @unlink($upload_dir . $foto_lama);
                        }
                        $sql = "
                            UPDATE bem_struktur 
                            SET nama=?, jabatan=?, prodi=?, kategori=?, urutan=?, foto=?
                            WHERE id=?
                        ";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ssssisi",
                            $nama, $jabatan, $prodi, $kategori, $urutan, $foto_baru, $id
                        );
                    } else {
                        $sql = "
                            UPDATE bem_struktur 
                            SET nama=?, jabatan=?, prodi=?, kategori=?, urutan=?
                            WHERE id=?
                        ";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ssssii",
                            $nama, $jabatan, $prodi, $kategori, $urutan, $id
                        );
                    }

                    if ($stmt->execute()) {
                        $message = "Data BEM berhasil diupdate.";
                        $message_type = "success";
                    } else {
                        $message = "Gagal update data: " . $stmt->error;
                        $message_type = "error";
                        if ($foto_baru && file_exists($upload_dir . $foto_baru)) {
                            @unlink($upload_dir . $foto_baru);
                        }
                    }
                    $stmt->close();
                }
            }
        }
    }
}

// =========================================================
// 3. AMBIL DATA BEM UNTUK TABEL
// =========================================================
$bem_list = [];
$sql = "SELECT * FROM bem_struktur 
        ORDER BY FIELD(kategori, 'inti', 'sekben', 'departemen'), urutan ASC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bem_list[] = $row;
    }
}
include 'includes/admin_header.php';
?>

<div class="breadcrumbs">
    <a href="dashboard.php">Admin</a> &gt; <span>Kelola Struktur BEM</span>
</div>

<div class="page-header">
    <h1>Struktur Organisasi BEM</h1>
    <button type="button" id="btnOpenTambah" class="btn-tambah">
        <i class="fas fa-plus"></i> Tambah Anggota
    </button>
</div>

<?php if (!empty($message)): ?>
    <div class="message <?= $message_type ?>">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>

<div class="content-box">
    <table class="data-table">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama & Jabatan</th>
                <th>Prodi</th>
                <th>Kategori</th>
                <th>Urutan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($bem_list) > 0): ?>
            <?php foreach ($bem_list as $item): 
                $fotoFile = !empty($item['foto']) ? $item['foto'] : '';
                $fotoUrl  = $fotoFile ? $upload_dir . $fotoFile : 'https://via.placeholder.com/50';
            ?>
                <tr>
                    <td data-label="Foto">
                        <img src="<?= htmlspecialchars($fotoUrl) ?>" alt="Foto" class="table-foto">
                    </td>
                    <td data-label="Nama & Jabatan">
                        <strong><?= htmlspecialchars($item['nama']) ?></strong><br>
                        <span class="jabatan-kecil">
                            <?= htmlspecialchars($item['jabatan']) ?>
                        </span>
                    </td>
                    <td data-label="Prodi">
                        <?= htmlspecialchars($item['prodi']) ?>
                    </td>
                    <td data-label="Kategori">
                        <?php 
                        $badgeClass = ($item['kategori'] == 'inti')
                            ? 'badge-bem badge-bem-inti'
                            : (($item['kategori'] == 'sekben')
                                ? 'badge-bem badge-bem-sekben'
                                : 'badge-bem badge-bem-departemen');
                        ?>
                        <span class="<?= $badgeClass ?>">
                            <?= strtoupper(htmlspecialchars($item['kategori'])) ?>
                        </span>
                    </td>
                    <td data-label="Urutan">
                        <?= (int)$item['urutan'] ?>
                    </td>
                    <td data-label="Aksi" class="action-links">
                        <button type="button"
                                class="btn-aksi btn-aksi-edit"
                                data-id="<?= $item['id'] ?>"
                                data-nama="<?= htmlspecialchars($item['nama'], ENT_QUOTES) ?>"
                                data-jabatan="<?= htmlspecialchars($item['jabatan'], ENT_QUOTES) ?>"
                                data-prodi="<?= htmlspecialchars($item['prodi'], ENT_QUOTES) ?>"
                                data-kategori="<?= htmlspecialchars($item['kategori'], ENT_QUOTES) ?>"
                                data-urutan="<?= (int)$item['urutan'] ?>"
                                data-foto="<?= htmlspecialchars($fotoFile, ENT_QUOTES) ?>">
                            <i class="fas fa-edit"></i>
                        </button>

                        <a href="admin_kelola_bem.php?action=delete&id=<?= $item['id'] ?>"
                           class="btn-aksi btn-aksi-delete"
                           onclick="return confirm('Hapus data ini?');">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">Belum ada data pengurus.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<div id="modalTambah" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Tambah Anggota BEM</h2>
            <button type="button" class="close-btn">&times;</button>
        </div>

        <div class="modal-body">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                
                <div class="input-box">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" required>
                </div>

                <div class="form-row">
                    <div class="input-box">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" required>
                    </div>
                    <div class="input-box">
                        <label>Prodi & Angkatan</label>
                        <input type="text" name="prodi" placeholder="Contoh: Informatika 2022">
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-box">
                        <label>Kategori</label>
                        <select name="kategori" required>
                            <option value="inti">Pimpinan Inti (Pres/Wapres)</option>
                            <option value="sekben">Sekretaris & Bendahara</option>
                            <option value="departemen">Departemen</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <label>Urutan Tampil</label>
                        <input type="number" name="urutan" value="1">
                    </div>
                </div>

                <div class="input-box">
                    <label>Foto</label>
                    <input type="file" name="foto" accept="image/*" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup">Batal</button>
                    <button type="submit" class="btn btn-primary btn-simpan">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="modalEdit" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit Anggota BEM</h2>
            <button type="button" class="close-btn">&times;</button>
        </div>

        <div class="modal-body">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" id="edit_id">
                <input type="hidden" name="foto_lama" id="edit_foto_lama">

                <div class="input-box">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" id="edit_nama" required>
                </div>

                <div class="form-row">
                    <div class="input-box">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" id="edit_jabatan" required>
                    </div>
                    <div class="input-box">
                        <label>Prodi & Angkatan</label>
                        <input type="text" name="prodi" id="edit_prodi">
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-box">
                        <label>Kategori</label>
                        <select name="kategori" id="edit_kategori" required>
                            <option value="inti">Pimpinan Inti</option>
                            <option value="sekben">Sekretaris & Bendahara</option>
                            <option value="departemen">Departemen</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <label>Urutan Tampil</label>
                        <input type="number" name="urutan" id="edit_urutan">
                    </div>
                </div>

                <div class="input-box">
                    <label>Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" accept="image/*">
                    <div class="preview-wrapper">
                        <small>Foto saat ini:</small><br>
                        <img src="" id="preview_foto" class="preview-img">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-tutup">Batal</button>
                    <button type="submit" class="btn btn-warning">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    window.bemData = <?= json_encode($bem_list) ?>;
    window.bemUploadDir = "<?= $upload_dir ?>";
</script>
<?php include 'includes/admin_footer.php'; ?>
