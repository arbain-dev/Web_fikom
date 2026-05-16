<?php
session_start();

require_once '../config/database.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login");
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
        header("Location: kelola_fakta?msg=tambah_ok");
        exit;
    }
    if ($action === "edit") {
        $id = intval($_POST['id']);
        $stmt = $conn->prepare("UPDATE tb_fakta SET judul=?, angka=?, urutan=? WHERE id=?");
        $stmt->bind_param("siii", $judul, $angka, $urut, $id);
        $stmt->execute();
        header("Location: kelola_fakta?msg=edit_ok");
        exit;
    }
}
include 'includes/admin_header.php';

$data = $conn->query("SELECT * FROM tb_fakta ORDER BY urutan ASC");
?>

    <!-- Banner Ungu -->
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



    <!-- Layout Kartu Terpadu -->
    <div class="card">
        <div class="card-header flex-between mb-4">
            <h2 class="card-title">Daftar Fakta</h2>
            <button class="btn btn-primary" onclick="faktaModule.bukaPopup('tambah')">
                <i class="fas fa-plus"></i> Tambah Fakta
            </button>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Urutan</th>
                            <th>Judul</th>
                            <th>Angka</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $data->data_seek(0);
                    if ($data->num_rows > 0): 
                        while ($row = $data->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['urutan'] ?></td>
                            <td><?= htmlspecialchars($row['judul']) ?></td>
                            <td><?= $row['angka'] ?></td>
                            <td class="action-links">
                                <button class="btn-icon edit" 
                                       onclick="faktaModule.bukaPopup('edit', <?= htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') ?>)"
                                       title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; else: ?>
                        <tr><td colspan="4" class="text-center">Belum ada data fakta.</td></tr>
                    <?php endif; ?>
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
                <button type="button" class="btn btn-secondary" onclick="faktaModule.tutupPopup()">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>



<?php include 'includes/admin_footer.php'; ?>

