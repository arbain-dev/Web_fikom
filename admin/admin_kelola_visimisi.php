<?php
// File: admin/admin_kelola_visimisi.php

session_start(); 
require_once '../config/database.php'; 

// Cek Login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); exit; 
}

$message = '';
$message_type = '';

// --- LOGIKA PROSES ---
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // UPDATE VISI
    if (isset($_POST['update_visi'])) {
        $konten = $_POST['visi_konten'];
        // Cek apakah visi ada
        $cek = $conn->query("SELECT id FROM visi_misi WHERE kategori = 'Visi'");
        if ($cek->num_rows > 0) {
            $stmt = $conn->prepare("UPDATE visi_misi SET konten = ? WHERE kategori = 'Visi'");
        } else {
            $stmt = $conn->prepare("INSERT INTO visi_misi (kategori, konten, urutan) VALUES ('Visi', ?, 0)");
        }
        $stmt->bind_param("s", $konten);
        if ($stmt->execute()) { $message = "Visi berhasil diperbarui!"; $message_type = "success"; }
        $stmt->close();
    }
    
    // TAMBAH MISI
    if (isset($_POST['tambah_misi'])) {
        $konten = $_POST['misi_konten'];
        $urutan = $_POST['urutan'];
        $stmt = $conn->prepare("INSERT INTO visi_misi (kategori, konten, urutan) VALUES ('Misi', ?, ?)");
        $stmt->bind_param("si", $konten, $urutan);
        if ($stmt->execute()) { $message = "Misi berhasil ditambahkan!"; $message_type = "success"; }
        $stmt->close();
    }
}

// HAPUS MISI
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $conn->prepare("DELETE FROM visi_misi WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) { $message = "Misi berhasil dihapus!"; $message_type = "success"; }
    $stmt->close();
}

// AMBIL DATA
$d_visi = $conn->query("SELECT konten FROM visi_misi WHERE kategori = 'Visi' LIMIT 1")->fetch_assoc();
$visi_sekarang = $d_visi ? $d_visi['konten'] : "";
$q_misi = $conn->query("SELECT * FROM visi_misi WHERE kategori = 'Misi' ORDER BY urutan ASC");

include 'includes/admin_header.php'; 
?>

    <!-- Purple Banner -->
    <div class="page-banner">
        <h1 class="banner-title">Kelola Visi Misi</h1>
    </div>
    
    <?php if ($message): ?>
        <div class="message-box <?= $message_type === 'success' ? 'success' : 'error' ?> mb-4">
            <i class="fas <?= $message_type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle' ?>"></i>
            <?= $message ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Card Visi -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Visi Utama</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <textarea name="visi_konten" class="form-input" rows="4" placeholder="Masukkan Visi Fakultas..." required><?= htmlspecialchars($visi_sekarang) ?></textarea>
                    </div>
                    <button type="submit" name="update_visi" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Visi
                    </button>
                </form>
            </div>
        </div>

        <!-- Card Misi -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Daftar Misi</h2>
            </div>
            <div class="card-body">
                
                <!-- Table Misi -->
                <div class="table-responsive mb-6">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th width="50">Urutan</th>
                                <th>Isi Misi</th>
                                <th width="100" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($q_misi->num_rows > 0): ?>
                                <?php while($row = $q_misi->fetch_assoc()): ?>
                                <tr>
                                    <td><span class="badge secondary"><?= $row['urutan'] ?></span></td>
                                    <td><?= htmlspecialchars($row['konten']) ?></td>
                                    <td class="text-center">
                                        <a href="?hapus=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus misi ini?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada data misi.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <hr class="mb-4">
                
                <h3 class="mb-3">Tambah Misi Baru</h3>
                <form method="POST" class="flex-between" style="gap: 15px;">
                    <div class="form-group">
                        <label class="form-label required">Urutan</label>
                        <input type="number" name="urutan" class="form-input" placeholder="No" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label required">Isi Misi</label>
                        <input type="text" name="misi_konten" class="form-input" placeholder="Masukkan teks misi..." required>
                    </div>
                    <button type="submit" name="tambah_misi" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </form>

            </div>
        </div>
    </div>

<?php include 'includes/admin_footer.php'; ?>
