<?php
// File: admin/admin_kelola_visimisi.php

session_start(); 
require_once '../database/db_connect.php'; 

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

<main class="content-area">
    <div class="breadcrumbs"><a href="dashboard.php">Admin</a> &gt; <span>Visi Misi</span></div>
    <h1>Kelola Visi Misi</h1>
    
    <?php if ($message): ?><div class="message"><?= $message ?></div><?php endif; ?>

    <div class="box-vm">
        <div class="box-header-vm">Visi Utama</div>
        <form method="POST">
            <textarea name="visi_konten" rows="3" required><?= htmlspecialchars($visi_sekarang) ?></textarea>
            <button type="submit" name="update_visi" class="btn-simpan">Simpan Visi</button>
        </form>
    </div>

    <div class="box-vm">
        <div class="box-header-vm">Daftar Misi</div>
        <table class="table-vm">
            <tr><th width="50">No</th><th>Isi Misi</th><th width="100">Aksi</th></tr>
            <?php while($row = $q_misi->fetch_assoc()): ?>
            <tr>
                <td><?= $row['urutan'] ?></td>
                <td><?= htmlspecialchars($row['konten']) ?></td>
                <td><a href="?hapus=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Hapus?')">Hapus</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
        
        <h4 style="margin-top: 20px;">Tambah Misi</h4>
        <form method="POST" style="display: flex; gap: 10px;">
            <input type="number" name="urutan" placeholder="No Urut" style="width: 80px;" required>
            <input type="text" name="misi_konten" placeholder="Isi Misi..." required>
            <button type="submit" name="tambah_misi" class="btn-simpan" style="background: #2ecc71;">Tambah</button>
        </form>
    </div>
</main>
