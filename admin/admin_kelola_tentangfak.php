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

<style>
/* ==============================
   RESET & BASE
================================*/
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: "Poppins", sans-serif;
    background: #eef1f7;
    color: #333;
    line-height: 1.6;
}


/* ==============================
   CARD WRAPPER (Satu Kartu)
================================*/
.card-tentang {
    max-width: 900px;
    margin: 40px auto;
    background: #ffffff;
    border-radius: 14px;
    padding: 30px;
    box-shadow: 0 6px 25px rgba(0,0,0,0.10);
    border-left: 6px solid #1a73e8;  /* efek elegan */
}


/* ==============================
   HEADER
================================*/
.card-tentang h2 {
    font-size: 1.7rem;
    color: #1a237e;
    margin-bottom: 20px;
    font-weight: 600;
}


/* ==============================
   FORM FIELD
================================*/
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 7px;
    font-weight: 500;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #c9c9c9;
    border-radius: 10px;
    font-size: 0.95rem;
    transition: 0.2s ease;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: #1a73e8;
    box-shadow: 0 0 0 3px rgba(26,115,232,0.15);
    outline: none;
}


/* ==============================
   TEXTAREA JUSTIFY
================================*/
.form-group textarea {
    min-height: 180px;
    text-align: justify;
}


/* ==============================
   BUTTON
================================*/
.btn-save {
    background: #1a73e8;
    color: #fff;
    padding: 12px 20px;
    font-size: 1rem;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    transition: 0.2s;
    margin-top: 5px;
}

.btn-save:hover {
    background: #0d47a1;
}


/* ==============================
   RESPONSIVE
================================*/
@media (max-width: 768px) {
    .card-tentang {
        padding: 22px;
        margin: 25px;
    }

    .card-tentang h2 {
        font-size: 1.5rem;
    }
}

@media (max-width: 480px) {
    .card-tentang {
        padding: 18px;
    }

    .btn-save {
        width: 100%;
    }
}

</style>

<div class="content-wrapper">

    <div class="page-title">Kelola Tentang Fakultas</div>

    <?php if (isset($_GET['success'])): ?>
        <div style="background:#d4edda;padding:10px;border-left:5px solid #28a745;margin-bottom:15px;border-radius:5px;">
            ✔ Data berhasil diperbarui
        </div>
    <?php endif; ?>

    <div class="card-tentang">
    <h2>Tentang Fakultas</h2>

    <!-- FORM YANG BENAR -->
    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']) ?>">
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
        </div>

        <div class="form-group">
            <label>Upload Gambar Baru</label>
            <input type="file" name="gambar" onchange="previewImage(event)">

            <div class="image-preview">
                <img id="imgPreview"
                    src="../uploads/tentang/<?= htmlspecialchars($data['gambar']) ?>"
                    alt="Current Image"
                    style="width:180px;border-radius:10px;margin-top:10px;">
            </div>
        </div>

        <button type="submit" class="btn-save">Simpan Perubahan</button>

    </form>
    </div>

</div>

<script>
function previewImage(event) {
    const imgPreview = document.getElementById('imgPreview');
    imgPreview.src = URL.createObjectURL(event.target.files[0]);
}
</script>

<?php 
include 'includes/admin_footer.php'; 
ob_end_flush(); 
?>
