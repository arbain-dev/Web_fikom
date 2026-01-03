<?php
session_start();

require_once '../config/database.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

/* ===============================
   LOGIKA POST
================================ */
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $action = $_POST['action'];
    $judul  = trim($_POST['judul']);
    $angka  = intval($_POST['angka']);
    $urut   = intval($_POST['urutan']);
    if ($action === "tambah") {
        $stmt = $conn->prepare("INSERT INTO tb_fakta (judul, angka, urutan) VALUES (?,?,?)");
        $stmt->bind_param("sii", $judul, $angka, $urut);
        $stmt->execute();
        header("Location: admin_kelola_fakta.php?msg=tambah_ok");
        exit;
    }
    if ($action === "edit") {
        $id = intval($_POST['id']);
        $stmt = $conn->prepare("UPDATE tb_fakta SET judul=?, angka=?, urutan=? WHERE id=?");
        $stmt->bind_param("siii", $judul, $angka, $urut, $id);
        $stmt->execute();
        header("Location: admin_kelola_fakta.php?msg=edit_ok");
        exit;
    }
}
include 'includes/admin_header.php';

$data = $conn->query("SELECT * FROM tb_fakta ORDER BY urutan ASC");
?>

    <!-- Purple Banner -->
    <div class="page-banner">
        <h1 class="banner-title">Fakta Fakultas</h1>
    </div>

    <?php 
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == 'tambah_ok') {
            echo '<div class="alert alert-success"><i class="fas fa-check-circle"></i> Fakta berhasil ditambahkan!</div>';
        }
        if ($_GET['msg'] == 'edit_ok') {
            echo '<div class="alert alert-success"><i class="fas fa-check-circle"></i> Fakta berhasil diperbarui!</div>';
        }
    }
    ?>

    <div class="card">
        <div class="card-header flex-between">
            <h2 class="card-title">Daftar Fakta</h2>
            <button class="btn btn-primary btn-sm" onclick="faktaModule.bukaPopup('tambah')">
                <i class="fas fa-plus"></i> Tambah Fakta
            </button>
        </div>
        <div class="card-body p-0">
            <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; padding-bottom: 5px;">
                <table class="data-table" style="min-width: 600px;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Fakta</th>
                            <th>Angka</th>
                            <th>Urutan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                    $i = 1;
                    while ($row = $data->fetch_assoc()): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($row['judul']) ?></td>
                            <td><span class="badge info"><?= $row['angka'] ?></span></td>
                            <td><?= $row['urutan'] ?></td>

                            <td class="action-links">
                                <button 
                                   class="edit" 
                                   onclick='faktaModule.bukaPopup("edit", <?= json_encode($row) ?>)'>
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="?action=hapus&id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Yakin hapus fakta ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- STANDARD MODAL -->
<div class="modal" id="faktaModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="faktaTitle">TAMBAH FAKTA</h2>
            <span class="close-btn" onclick="faktaModule.tutupPopup()">&times;</span>
        </div>

        <form method="POST" id="faktaForm">
            <input type="hidden" name="action" id="faktaAction">
            <input type="hidden" name="id" id="faktaId">

            <div class="modal-body">
                <div class="input-box">
                    <label class="required">Judul Fakta</label>
                    <input type="text" name="judul" id="faktajudul" placeholder="Contoh: Dosen, Mahasiswa, dll" required>
                </div>

                <div class="input-row">
                    <div class="input-box">
                        <label class="required">Angka</label>
                        <input type="number" name="angka" id="faktaangka" required>
                    </div>

                    <div class="input-box">
                        <label class="required">Urutan</label>
                        <input type="number" name="urutan" id="faktaurutan" required>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" onclick="faktaModule.tutupPopup()">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>



<?php include 'includes/admin_footer.php'; ?>
