<?php
/**
 * Halaman Kelola Galeri
 * Admin Dashboard - Manage Gallery
 */

// Include admin header
include 'includes/admin_header.php';

// Handle Delete
$success_msg = '';
$error_msg = '';

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    // Get image path
    $q_img = $conn->query("SELECT gambar FROM galeri WHERE id = $id");
    if ($q_img && $q_img->num_rows > 0) {
        $row = $q_img->fetch_assoc();
        $file_path = '../uploads/galeri/' . $row['gambar'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        
        if ($conn->query("DELETE FROM galeri WHERE id = $id")) {
            $success_msg = "Foto berhasil dihapus.";
        } else {
            $error_msg = "Gagal menghapus data.";
        }
    }
}

// Handle Upload
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $conn->real_escape_string($_POST['judul']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $filename = $_FILES['gambar']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        
        if (in_array(strtolower($filetype), $allowed)) {
            $new_filename = uniqid('galeri_') . '.' . $filetype;
            $target = '../uploads/galeri/' . $new_filename;
            
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
                $query = "INSERT INTO galeri (judul, deskripsi, gambar) VALUES ('$judul', '$deskripsi', '$new_filename')";
                if ($conn->query($query)) {
                    $success_msg = "Foto berhasil ditambahkan!";
                } else {
                    $error_msg = "Database error: " . $conn->error;
                }
            } else {
                $error_msg = "Gagal mengupload file.";
            }
        } else {
            $error_msg = "Format file tidak didukung.";
        }
    } else {
        $error_msg = "Pilih foto terlebih dahulu.";
    }
}
?>

<!-- Page Banner -->
<div class="page-banner">
    <h1 class="banner-title">Kelola Galeri Foto</h1>
</div>

<?php if ($success_msg): ?>
    <div class="alert alert-success"><?= $success_msg ?></div>
<?php endif; ?>
<?php if ($error_msg): ?>
    <div class="alert alert-danger"><?= $error_msg ?></div>
<?php endif; ?>

<!-- Upload Form Card -->
<div class="card mb-4">
    <div class="card-header">
        <h2 class="card-title">Upload Foto Baru</h2>
    </div>
    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            <div style="display: flex; gap: 20px; flex-wrap: wrap; align-items: flex-start;">
                <!-- Left Side: Inputs -->
                <div style="flex: 1; min-width: 300px;">
                    <div class="form-group mb-3">
                        <label class="form-label" style="font-weight: bold;">Judul Foto</label>
                        <input type="text" name="judul" class="form-control" required placeholder="Judul kegiatan...">
                    </div>
                    <div class="form-group">
                        <label class="form-label" style="font-weight: bold;">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" placeholder="Keterangan singkat (opsional)...">
                    </div>
                </div>

                <!-- Right Side: File & Button -->
                <div style="flex: 0 0 300px;">
                    <label class="form-label" style="font-weight: bold;">Pilih Foto:</label>
                    <div style="display: flex; gap: 10px; align-items: flex-start;">
                        <input type="file" name="gambar" class="form-control" required accept="image/*" style="flex: 1;">
                        <button type="submit" class="btn btn-primary" style="white-space: nowrap;">
                            <i class="fas fa-upload"></i> Upload
                        </button>
                    </div>
                    <small class="text-muted d-block mt-2">Format: JPG, PNG, WebP.</small>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Gallery List Card (Table Layout) -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Daftar Galeri</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th width="150">Foto</th>
                        <th>Info Galeri</th>
                        <th width="150">Tanggal</th>
                        <th width="100" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM galeri ORDER BY id DESC");
                    if ($result && $result->num_rows > 0):
                        while ($row = $result->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td>
                                <img src="../uploads/galeri/<?= $row['gambar'] ?>" alt="Thumb" style="width: 120px; height: 80px; object-fit: cover; border-radius: 6px; border: 1px solid #eee;">
                            </td>
                            <td>
                                <strong style="font-size: 1.1em; color: #333; display: block; margin-bottom: 5px;"><?= htmlspecialchars($row['judul']) ?></strong>
                                <?php if($row['deskripsi']): ?>
                                    <p class="text-muted" style="margin: 0; font-size: 0.9em;"><?= htmlspecialchars($row['deskripsi']) ?></p>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <i class="far fa-calendar-alt text-muted"></i> <?= date('d/m/Y', strtotime($row['tanggal_upload'])) ?>
                            </td>
                            <td class="text-center">
                                <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus foto ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php 
                        endwhile;
                    else:
                    ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data galeri.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/admin_footer.php'; ?>

