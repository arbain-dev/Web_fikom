<?php
include 'includes/header.php';
require 'database/db_connect.php';

$query = "SELECT * FROM ruangan ORDER BY id DESC";
$result = $conn->query($query);
?>
<body>
<div class="color-bg">
    <div class="color"></div>
    <div class="color"></div>
    <div class="color"></div>
</div>
     <div class="page-title">
        <h1>Ruangan Kelas</h1>
    </div>
    <div class="ruangan-container">
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nama = htmlspecialchars($row['nama_ruangan'], ENT_QUOTES);
                $deskripsi_raw = htmlspecialchars($row['deskripsi'], ENT_QUOTES); 
                $foto_db = $row['foto'];
                $path_foto = 'uploads/ruangan/' . $foto_db;
                
                if (!empty($foto_db) && file_exists($path_foto)) {
                    $foto_tampil = $path_foto;
                } else {
                    $foto_tampil = 'https://via.placeholder.com/400x220?text=Foto+Ruangan'; 
                }
                echo "
                <div class='ruangan-card' onclick=\"showRuanganPopup('$nama', '$deskripsi_raw', '$foto_tampil')\">
                    <img src='$foto_tampil' alt='$nama'>
                    <div class='ruangan-info'>
                        <h3>$nama</h3>
                        <p>" . nl2br($row['deskripsi']) . "</p>
                    </div>
                </div>";
            }
        } else {
            echo '<p style="grid-column: 1 / -1; text-align:center; color: #fff; font-size: 1.2rem;">Belum ada data ruangan yang tersedia.</p>';
        }
        $conn->close(); 
        ?>
    </div>
</div>
</section>
<?php
include 'includes/footer.php';
?>