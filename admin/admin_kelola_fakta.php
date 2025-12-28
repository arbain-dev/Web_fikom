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

    <div class="breadcrumbs">
        <a href="dashboard.php">Admin</a> &gt; <span>Kelola Fakta Fakultas</span>
    </div>

    <div class="page-header">
        <h1 class="page-title">Fakta Fakultas</h1>
    </div>

    <?php 
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == 'tambah_ok') {
            echo '<div class="message-box success"><i class="fas fa-check-circle"></i> Fakta berhasil ditambahkan!</div>';
        }
        if ($_GET['msg'] == 'edit_ok') {
            echo '<div class="message-box success"><i class="fas fa-check-circle"></i> Fakta berhasil diperbarui!</div>';
        }
    }
    ?>

    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="card-title">Daftar Fakta</h2>
            <button class="btn btn-primary btn-sm" onclick="faktaModule.bukaPopup('tambah')">
                <i class="fas fa-plus"></i> Tambah Fakta
            </button>
        </div>
        <div class="card-body p-0">
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Judul Fakta</th>
                        <th>Angka</th>
                        <th>Urutan</th>
                        <th width="100" class="text-center">Aksi</th>
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

                        <td class="text-center">
                            <button 
                               class="btn btn-sm btn-outline" 
                               onclick='faktaModule.bukaPopup("edit", <?= json_encode($row) ?>)'>
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </td>
                    </tr>
                <?php endwhile ?>
                </tbody>

            </table>
        </div>
    </div>

<!-- STANDARD MODAL -->
<div class="modal" id="faktaModal">
    <div class="modal-overlay" onclick="faktaModule.tutupPopup()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="faktaTitle">Tambah Fakta</h2>
            <button class="close-btn" onclick="faktaModule.tutupPopup()">&times;</button>
        </div>

        <form method="POST" id="faktaForm">
            <div class="modal-body">
                <input type="hidden" name="action" id="faktaAction">
                <input type="hidden" name="id" id="faktaId">

                <div class="form-group">
                    <label class="form-label required">Judul Fakta</label>
                    <input type="text" name="judul" id="faktajudul" class="form-input" placeholder="Contoh: Dosen, Mahasiswa, dll" required>
                </div>

                <div class="row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label class="form-label required">Angka</label>
                        <input type="number" name="angka" id="faktaangka" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Urutan</label>
                        <input type="number" name="urutan" id="faktaurutan" class="form-input" required>
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

<script>
const faktaModule = {
    bukaPopup(mode, data = null) {
        const modal = document.getElementById("faktaModal");
        const form = document.getElementById("faktaForm");
        
        modal.classList.add("show");
        document.getElementById("faktaAction").value = mode;

        if (mode === "tambah") {
            document.getElementById("faktaTitle").innerText = "Tambah Fakta";
            form.reset();
            document.getElementById("faktaId").value = "";
        }

        if (mode === "edit") {
            document.getElementById("faktaTitle").innerText = "Edit Fakta";
            document.getElementById("faktaId").value = data.id;
            // Case sensitive ID fixing based on previous code form inputs
            document.getElementById("faktajudul").value = data.judul;
            document.getElementById("faktaangka").value = data.angka;
            document.getElementById("faktaurutan").value = data.urutan;
        }
    },

    tutupPopup() {
        document.getElementById("faktaModal").classList.remove("show");
    }
};
</script>

<?php include 'includes/admin_footer.php'; ?>
