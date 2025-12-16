<?php
session_start();

require_once '../database/db_connect.php';
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

<main class="content-area">
    <div class="breadcrumbs">
        <a href="dashboard.php">Admin</a> &gt; <span>Kelola Fakta Fakultas</span>
    </div>

    <div class="page-header">
        <h1>Fakta Fakultas</h1>
        <button class="btn-tambah" onclick="faktaModule.bukaPopup('tambah')">
            <i class="fas fa-plus"></i> Tambah Fakta
        </button>
    </div>

    <?php 
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == 'tambah_ok') {
            echo '<div class="kb-alert kb-alert-success">✓ Fakta berhasil ditambahkan!</div>';
        }
        if ($_GET['msg'] == 'edit_ok') {
            echo '<div class="kb-alert kb-alert-success">✓ Fakta berhasil diperbarui!</div>';
        }
    }
    ?>

    <div class="content-box">
        <table class="data-table kb-data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Fakta</th>
                    <th>Angka</th>
                    <th>Urutan</th>
                    <th>Edit</th>
                </tr>
            </thead>

            <tbody>
            <?php 
            $i = 1;
            while ($row = $data->fetch_assoc()): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($row['judul']) ?></td>
                    <td><?= $row['angka'] ?></td>
                    <td><?= $row['urutan'] ?></td>

                    <td class="action-links">
                        <a href="#" 
                           class="edit" 
                           onclick='faktaModule.bukaPopup("edit", <?= json_encode($row) ?>)'>
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
            <?php endwhile ?>
            </tbody>

        </table>
    </div>
</main>

<div class="kb-popup-bg" id="faktaPopup">
    <div class="kb-popup-box">
        <div class="kb-popup-header">
            <h2 id="faktaTitle"></h2>
            <button class="kb-popup-close-x" onclick="faktaModule.tutupPopup()">×</button>
        </div>

        <form method="POST" id="faktaForm">
            <input type="hidden" name="action" id="faktaAction">
            <input type="hidden" name="id" id="faktaId">

            <div class="kb-form-group">
                <label>Judul Fakta *</label>
                <input type="text" name="judul" id="faktaJudul" required>
            </div>

            <div class="kb-form-group">
                <label>Angka *</label>
                <input type="number" name="angka" id="faktaAngka" required>
            </div>

            <div class="kb-form-group">
                <label>Urutan *</label>
                <input type="number" name="urutan" id="faktaUrutan" required>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-tutup" onclick="faktaModule.tutupPopup()">Tutup</button>
                <button type="submit" class="btn btn-simpan">Simpan Data</button>
            </div>

        </form>
    </div>
</div>

<script>
const faktaModule = {
    bukaPopup(mode, data = null) {
        document.getElementById("faktaPopup").style.display = "flex";
        document.getElementById("faktaAction").value = mode;

        if (mode === "tambah") {
            document.getElementById("faktaTitle").innerText = "Tambah Fakta";
            document.getElementById("faktaForm").reset();
            document.getElementById("faktaId").value = "";
        }

        if (mode === "edit") {
            document.getElementById("faktaTitle").innerText = "Edit Fakta";
            document.getElementById("faktaId").value = data.id;
            document.getElementById("faktaJudul").value = data.judul;
            document.getElementById("faktaAngka").value = data.angka;
            document.getElementById("faktaUrutan").value = data.urutan;
        }
    },

    tutupPopup() {
        document.getElementById("faktaPopup").style.display = "none";
    }
};
</script>

</body>
</html>
