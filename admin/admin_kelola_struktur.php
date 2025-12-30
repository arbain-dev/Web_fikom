<?php
session_start();
include 'includes/admin_header.php';

// Tampilkan error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Koneksi DB
require_once '../config/database.php'; 

// Cek login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); 
    exit;
}

$message = ''; 
$message_type = '';
$target_dir = "../uploads/profil/";

// PROSES FORM
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql_old = "SELECT gambar_path FROM halaman_statis WHERE nama_halaman = 'struktur_organisasi'";
    $result_old = $conn->query($sql_old);
    $data_old = $result_old->fetch_assoc();
    $foto_lama = $data_old['gambar_path'] ?? '';

    $foto_nama_baru = $foto_lama;

    // Upload foto baru
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $ext = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));

        if (!in_array($ext, ["jpg", "jpeg", "png", "svg"])) {
            $message_type = "error";
            $message = "Error: Hanya file JPG, PNG, & SVG yang diizinkan.";
        } else {
            $foto_nama_baru = "struktur-organisasi-" . time() . '.' . $ext;
            $target_file = $target_dir . $foto_nama_baru;

            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {

                if (!empty($foto_lama) && $foto_lama != 'default_struktur.jpg' && file_exists($target_dir.$foto_lama)) {
                    unlink($target_dir.$foto_lama);
                }

                $stmt = $conn->prepare("UPDATE halaman_statis SET gambar_path = ? WHERE nama_halaman = 'struktur_organisasi'");
                $stmt->bind_param("s", $foto_nama_baru);

                if ($stmt->execute()) {
                    $message_type = "success";
                    $message = "Gambar struktur organisasi berhasil di-update!";
                } else {
                    $message_type = "error";
                    $message = "Gagal update database.";
                }
                $stmt->close();

            } else {
                $message_type = "error";
                $message = "Gagal meng-upload foto baru.";
            }
        }
    } else {
        $message_type = "error";
        $message = "Anda tidak memilih file baru untuk di-upload.";
    }
}

// Ambil gambar terbaru
$sql = "SELECT gambar_path FROM halaman_statis WHERE nama_halaman = 'struktur_organisasi'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
$gambar_sekarang = $data['gambar_path'] ?? 'default_struktur.jpg';

$conn->close();
?>

    <!-- Purple Banner -->
    <div class="page-banner">
        <h1 class="banner-title">Struktur Organisasi</h1>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Edit Struktur Organisasi</h2>
        </div>
        <div class="card-body">
            <form action="admin_kelola_struktur.php" method="POST" enctype="multipart/form-data">
                
                <?php if (!empty($message)): ?>
                    <div class="message-box <?= $message_type === 'success' ? 'success' : 'error' ?> mb-4">
                        <i class="fas <?= $message_type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle' ?>"></i>
                        <?= $message ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label class="form-label required" for="foto">Upload Gambar Baru (JPG, PNG, SVG)</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="foto" name="foto" accept="image/png, image/jpeg, image/svg+xml" class="form-input" required>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Gambar
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Gambar Saat Ini:</label>
                    <div class="file-preview-box">
                        <img src="../uploads/profil/<?= htmlspecialchars($gambar_sekarang) ?>" alt="Struktur Organisasi Saat Ini" style="max-width: 100%; height: auto; border-radius: 8px;">
                    </div>
                </div>

            </form>
        </div>
    </div>

<?php include 'includes/admin_footer.php'; ?>
