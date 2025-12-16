<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_web_fikom";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
include 'includes/header.php';
$sql = "SELECT * FROM kurikulum ORDER BY nama_kurikulum DESC";
$result = mysqli_query($conn, $sql) or die("Query gagal: " . mysqli_error($conn));
?>

<body>
<div class="color-bg">
    <div class="color"></div>
    <div class="color"></div>
    <div class="color"></div>
</div>
<section class="content-section">
    <h1 class="page-title">Kurikulum Fakultas</h1>
    <div class="content-grid">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $nama = htmlspecialchars($row['nama_kurikulum']);
                $desc = htmlspecialchars($row['deskripsi']);
                $file = htmlspecialchars($row['file_pdf']);
                $file_path = "uploads/kurikulum/" . $file;
                ?>
                <div class="content-card kurikulum-card">
                    <div class="kurikulum-icon">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <h3 class="content-title-sm">Kurikulum <?= $nama ?></h3>
                    <p class="content-text"><?= $desc ?></p>
                    <?php if (!empty($file) && file_exists($file_path)) { ?>
                        <button 
                            class="content-btn" 
                            data-file="<?= $file_path ?>" 
                            data-nama="<?= $nama ?>"
                        >
                            Lihat File <i class="fas fa-eye"></i>
                        </button>
                    <?php } else { ?>
                        <button class="content-btn-disabled">File Tidak Tersedia</button>
                    <?php } ?>
                </div>
                <?php
            }
        } else {
            echo "<p style='grid-column:1/-1; text-align:center; color:#fff;'>Belum ada data kurikulum.</p>";
        }
        ?>
    </div>
</section>

<div class="popup" id="pdfPopup">
    <div class="popup-box">
        <div class="popup-header">
            <h2 id="popupTitle">Kurikulum</h2>
            <button class="popup-close" id="closePopup">Tutup</button>
        </div>
        <div class="popup-body">
            <iframe id="pdfFrame" src=""></iframe>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
