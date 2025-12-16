<?php
require 'database/db_connect.php'; 
include 'includes/header.php';

$sql = "SELECT * FROM pengabdian ORDER BY judul ASC";
$result = mysqli_query($conn, $sql);
?>

<div class="color-bg">
    <div class="color"></div>
    <div class="color"></div>
    <div class="color"></div>
</div>
<div class="content-container">
    <h1>Pengabdian Fakultas</h1>
    
    <div class="pengabdian-container">
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php
                    $judul = htmlspecialchars($row['judul']);
                    $pelaksana = htmlspecialchars($row['pelaksana']);
                    $desc = htmlspecialchars($row['deskripsi']);
                    $file_name = $row['file_pdf'] ?? $row['file_doc'] ?? '';
                    $file_path = "uploads/pengabdian_file/" . $file_name;
                    $file_exists = (!empty($file_name) && file_exists($file_path));
                ?>
                <div class="pengabdian-card">
                    <div>
                        <i class="fas fa-hand-holding-heart icon"></i>
                        <h3><?= $judul ?></h3>
                        <p class="pelaksana">Oleh: <?= $pelaksana ?></p>
                        <p><?= $desc ?></p>
                    </div>
                    <?php if ($file_exists): ?>
                        <button type="button" class="btn-lihat" 
                                data-file="<?= $file_path ?>" 
                                data-nama="<?= $judul ?>">
                            Lihat Laporan <i class="fas fa-eye"></i>
                        </button>
                    <?php else: ?>
                        <span class="btn-disabled">File Tidak Tersedia</span>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 50px;">
                <h3>Belum ada data pengabdian.</h3>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="popup" id="pdfPopup">
    <div class="popup-content">
        <div class="popup-header">
            <h2 id="popupTitle">Dokumen Laporan</h2>
            <button class="close-btn" id="closePopup">Tutup</button>
        </div>
        <div class="popup-body">
            <iframe id="pdfFrame" src="" allow="autoplay"></iframe>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>