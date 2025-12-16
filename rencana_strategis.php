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
$renop_list = [];
$sql  = "SELECT id, nama_dokumen, deskripsi, file_pdf, tanggal_upload 
         FROM rencana_strategis 
         ORDER BY nama_dokumen ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $renop_list[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rencana Operasional (Renop)</title>
</head>
<body>

<div class="color-bg">
    <div class="color"></div>
    <div class="color"></div>
    <div class="color"></div>
</div>

<main>
<div class="content-container">

    <h1 class="page-title">Rencana Strategis (Renstra)</h1>

    <div class="glass-table-box">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dokumen</th>
                    <th>Deskripsi</th>
                    <th>File PDF</th>
                </tr>
            </thead>

            <tbody>
                <?php if (count($renop_list) > 0): $no = 1; ?>
                    <?php foreach ($renop_list as $item): ?>

                        <?php
                            $nama = htmlspecialchars($item['nama_dokumen']);
                            $deskripsi = htmlspecialchars($item['deskripsi']);
                            $file = htmlspecialchars($item['file_pdf']);
                            $path = "uploads/renstra/" . $file; 
                            $ada_file = (!empty($file) && file_exists($path)); 
                        ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $nama ?></td>
                            <td><?= $deskripsi ?></td>
                            <td>
                                <?php if ($ada_file): ?>
                                    <a href="<?= $path ?>" class="btn-table" download>
                                        Download <i class="fas fa-download"></i>
                                    </a>
                                <?php else: ?>
                                    <span class="btn-disabled">Tidak Ada File</span>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align:center; padding:20px;">
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html>
