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
?>
<body>
<div class="color-bg">
    <div class="color"></div>
    <div class="color"></div>
    <div class="color"></div>
</div>
<section class="content-section">
  <div class="page-title">
        <h1>Ruangan Labolatorium</h1>
    </div>
    <div class="content-grid">
        <?php
        $query = "SELECT * FROM laboratorium ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $nama_lab = htmlspecialchars($row['nama_lab']);
                $deskripsi = nl2br(htmlspecialchars($row['deskripsi']));
                $foto_file = $row['foto'] ?? 'default-placeholder.png';
                $foto_path = 'uploads/labolatorium/' . $foto_file;
                if (empty($row['foto']) || !file_exists($foto_path)) {
                    $foto_path = 'https://via.placeholder.com/400x220?text=Foto+Lab';
                }
        ?>
        <div class="content-card">
            <img src="<?= $foto_path ?>" alt="<?= $nama_lab ?>" class="content-image">
            <div class="content-body">
                <h3 class="content-title-sm"><?= $nama_lab ?></h3>
                <p class="content-text"><?= $deskripsi ?></p>
            </div>
        </div>
        <?php
            }
        } else {
            echo '<p style="grid-column:1/-1; text-align:center; color:#fff;">Belum ada data laboratorium yang tersedia.</p>';
        }
        ?>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
</body>
</html>
