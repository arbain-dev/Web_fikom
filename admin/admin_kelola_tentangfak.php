<?php
ob_start();
session_start();

require_once '../config/database.php';
include 'includes/admin_header.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$id = 1;

/* ===========================================
   PROSES UPDATE DATA
=========================================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    // Cek jika ada upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {

        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $namaBaru = "fakultas_" . time() . "." . $ext;

        move_uploaded_file($_FILES['gambar']['tmp_name'], "../uploads/tentang/" . $namaBaru);

        // Update dengan gambar
        $update = $conn->prepare("UPDATE tentang_fikom SET judul=?, deskripsi=?, gambar=? WHERE id=?");
        $update->bind_param("sssi", $judul, $deskripsi, $namaBaru, $id);

    } else {

        // Update tanpa gambar
        $update = $conn->prepare("UPDATE tentang_fikom SET judul=?, deskripsi=? WHERE id=?");
        $update->bind_param("ssi", $judul, $deskripsi, $id);
    }

    $update->execute();

    header("Location: admin_kelola_tentangfak.php?success=1");
    exit;
}

/* ===========================================
   AMBIL DATA
=========================================== */

$query = "SELECT * FROM tentang_fikom WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    $data = ['judul' => '', 'deskripsi' => '', 'gambar' => ''];
}
?>


    <div class="page-header">
        <h1 class="page-title">Kelola Tentang Fakultas</h1>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="msg success">
            ✔ Data berhasil diperbarui
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Edit Informasi Fakultas</h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">

                <div class="input-box">
                    <label>Judul</label>
                    <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" required>
                </div>

                <div class="input-box">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="textarea-lg"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                </div>

                <div class="input-box">
                    <label>Upload Gambar Baru</label>
                    <input type="file" name="gambar" onchange="previewImage(event)" accept="image/*">
                    
                    <div class="image-preview-box mt-3">
                        <label class="d-block text-muted" style="font-size: 0.9em; margin-bottom: 5px;">Preview Gambar:</label>
                        <img id="imgPreview"
                            src="../uploads/tentang/<?= htmlspecialchars($data['gambar']) ?>"
                            alt="Current Image"
                            style="width:100%; max-width: 300px; border-radius:8px; border: 1px solid #ddd; padding: 5px;">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn-simpan">Simpan Perubahan</button>
                </div>

            </form>
        </div>
    </div>

<script>
function previewImage(event) {
    const imgPreview = document.getElementById('imgPreview');
    if(event.target.files && event.target.files[0]) {
        imgPreview.src = URL.createObjectURL(event.target.files[0]);
        imgPreview.style.display = 'block';
    }
}
</script>

<?php 
include 'includes/admin_footer.php'; 
ob_end_flush(); 
?>
