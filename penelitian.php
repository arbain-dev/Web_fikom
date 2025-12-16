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
$penelitian_list = [];
$sql = "SELECT * FROM penelitian ORDER BY tahun DESC, judul ASC";
$result = $conn->query($sql);
if ($result === false) {
    die("Query GAGAL: Cek tabel 'penelitian'. Error: " . $conn->error);
}
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $penelitian_list[] = $row; 
    }
}
$conn->close(); 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penelitian - Fikom UNISAN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
</head>
<body>

<div class="color-bg">
    <div class="color"></div>
    <div class="color"></div>
    <div class="color"></div>
</div>

<div class="content-container">
    <h1>Penelitian Dosen</h1>
    <div class="container" id="cardContainer">
        <?php
        foreach ($penelitian_list as $p) {
            $id = $p['id'];
            $judul = htmlspecialchars($p['judul'] ?? 'Tanpa Judul', ENT_QUOTES, 'UTF-8');
            $peneliti = htmlspecialchars($p['peneliti'] ?? '-', ENT_QUOTES, 'UTF-8');
            $tahun = htmlspecialchars($p['tahun'] ?? '-', ENT_QUOTES, 'UTF-8');
            $status = htmlspecialchars($p['status'] ?? '-', ENT_QUOTES, 'UTF-8');
            $sumber_dana = htmlspecialchars($p['sumber_dana'] ?? '-', ENT_QUOTES, 'UTF-8');
            $link_publikasi = htmlspecialchars($p['link_publikasi'] ?? '', ENT_QUOTES, 'UTF-8');
            echo "
            <div class='card js-popup-trigger' 
                 data-judul='{$judul}'
                 data-peneliti='{$peneliti}'
                 data-tahun='{$tahun}'
                 data-status='{$status}'
                 data-sumber_dana='{$sumber_dana}'
                 data-link_publikasi='{$link_publikasi}'
            >
                <div class='info'>
                    <h4>{$judul}</h4>
                    <p class='peneliti'>{$peneliti}</p>
                    <p class='tahun'>Tahun: {$tahun}</p>
                </div>
            </div>";
        }
        
        if (count($penelitian_list) == 0) {
            echo '<p style="grid-column: 1 / -1; text-align:center; color: #fff;">Belum ada data penelitian yang dipublikasi.</p>';
        }
        ?>
    </div>
</div>

<div class="popup" id="popup">
    <div class="popup-content">
        <h3 id="popupJudul"></h3>
        <div class="popup-details">
            <p><strong>Peneliti</strong> <span id="popupPeneliti"></span></p>
            <p><strong>Tahun</strong> <span id="popupTahun"></span></p>
            <p><strong>Status</strong> <span id="popupStatus"></span></p>
            <p><strong>Sumber Dana</strong> <span id="popupSumberDana"></span></p>
            <p class="link-wrapper" id="popupLinkWrapper" style="display: none;">
                <a href="#" id="popupLinkPublikasi" target="_blank" class="btn-link-publikasi">
                    Lihat Publikasi <i class="fas fa-external-link-alt"></i>
                </a>
            </p>
        </div>
        <button class="close-btn" onclick="closePopup()">Tutup</button>
    </div>
</div>
<?php
include 'includes/footer.php';
?>
</body>
</html>