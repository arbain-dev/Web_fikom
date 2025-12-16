<?php
require 'database/db_connect.php';
include 'includes/header.php';

$query = "SELECT * FROM kalender_akademik ORDER BY tahun_akademik DESC";
$result = mysqli_query($conn, $query);
?>

<body class="kalender-akademik-page">
<div class="color-bg">
    <div class="color"></div>
    <div class="color"></div>
    <div class="color"></div>
</div>

<main>
<div class="content-container">
    <h1 class="page-title">Kalender Akademik</h1>
    <div class="calendar-grid">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php
                    $nama  = htmlspecialchars($row['nama_kalender']);
                    $tahun = htmlspecialchars($row['tahun_akademik']);
                    $desc  = htmlspecialchars($row['deskripsi']);
                    $img   = !empty($row['gambar'])
                             ? "uploads/kalender/".$row['gambar']
                             : "uploads/kalender/default.jpg";
                ?>
                <div class="calendar-card js-calendar-trigger" data-img="<?= $img ?>">
                    <img src="<?= $img ?>" alt="Kalender <?= $tahun ?>">
                    <div class="calendar-body">
                        <h3><?= $nama ?> (<?= $tahun ?>)</h3>
                        <p><?= $desc ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="calendar-no-data">Belum ada kalender akademik.</p>
        <?php endif; ?>
    </div>
</div>
</main>

<div class="popup" id="calendarPopup">
    <div class="popup-img-box">
        <button class="popup-close" id="popupCloseBtn">Tutup</button>
        <img id="popupImg" src="">
    </div>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
