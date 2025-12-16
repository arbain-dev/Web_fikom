<?php
include 'includes/header.php'; 
require 'database/db_connect.php'; 

$dosen_all = [];
$sql = "SELECT id, nama, nidn, program_studi, keahlian, jabatan, pendidikan, status, email, foto FROM dosen"; 
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $dosen_all[] = $row;
    }
}
$conn->close();
$pimpinan = [];
$dosen_tetap = [];

foreach ($dosen_all as $d) {
    $jabatan_cek = strtolower(trim($d['jabatan'] ?? ''));
    if (strpos($jabatan_cek, 'dekan') !== false || strpos($jabatan_cek, 'ketua') !== false || strpos($jabatan_cek, 'kaprodi') !== false) {
        $pimpinan[] = $d;
    } else {
        $dosen_tetap[] = $d;
    }
}
?>


<h2 class="page-dosen-title">Pimpinan Fakultas</h2>
<div class="pimpinan-container">
    <?php
    foreach ($pimpinan as $d) {
        $nama = htmlspecialchars($d['nama'] ?? '', ENT_QUOTES);
        $nidn = htmlspecialchars($d['nidn'] ?? '-', ENT_QUOTES);
        $jabatan = htmlspecialchars($d['jabatan'] ?? '-', ENT_QUOTES);
        $prodi = htmlspecialchars($d['program_studi'] ?? '-', ENT_QUOTES);
        $keahlian = htmlspecialchars($d['keahlian'] ?? '-', ENT_QUOTES);
        $pendidikan = htmlspecialchars($d['pendidikan'] ?? '-', ENT_QUOTES);
        $status = htmlspecialchars($d['status'] ?? '-', ENT_QUOTES);
        $email = htmlspecialchars($d['email'] ?? '-', ENT_QUOTES);
        $foto = htmlspecialchars($d['foto'] ?? '', ENT_QUOTES);
        
        $foto_path = (!empty($foto) && file_exists('uploads/dosen/' . $foto)) ? 'uploads/dosen/' . $foto : 'https://via.placeholder.com/220x240?text=No+Image';

        echo "
        <div class='dosen-card' onclick=\"showDosenPopup('$nama', '$nidn', '$jabatan', '$prodi', '$keahlian', '$pendidikan', '$status', '$email', '$foto_path')\">
            <img src='{$foto_path}' alt='{$nama}'>
            <div class='dosen-info'>
                <h4>{$nama}</h4>
                <p class='jabatan'>{$jabatan}</p>
                <p>{$nidn}</p>
            </div>
        </div>";
    }
    ?>
</div>

<h2 class="page-dosen-title">Dosen Tetap Prodi</h2>
<div class="dosen-grid-container">
    <?php
    foreach ($dosen_tetap as $d) {
        $nama = htmlspecialchars($d['nama'] ?? '', ENT_QUOTES);
        $nidn = htmlspecialchars($d['nidn'] ?? '-', ENT_QUOTES);
        $jabatan = htmlspecialchars($d['jabatan'] ?? '-', ENT_QUOTES);
        $prodi = htmlspecialchars($d['program_studi'] ?? '-', ENT_QUOTES);
        $keahlian = htmlspecialchars($d['keahlian'] ?? '-', ENT_QUOTES);
        $pendidikan = htmlspecialchars($d['pendidikan'] ?? '-', ENT_QUOTES);
        $status = htmlspecialchars($d['status'] ?? '-', ENT_QUOTES);
        $email = htmlspecialchars($d['email'] ?? '-', ENT_QUOTES);
        $foto = htmlspecialchars($d['foto'] ?? '', ENT_QUOTES);
        $foto_path = (!empty($foto) && file_exists('uploads/dosen/' . $foto)) ? 'uploads/dosen/' . $foto : 'https://via.placeholder.com/220x240?text=No+Image';
        echo "
        <div class='dosen-card' onclick=\"showDosenPopup('$nama', '$nidn', '$jabatan', '$prodi', '$keahlian', '$pendidikan', '$status', '$email', '$foto_path')\">
            <img src='{$foto_path}' alt='{$nama}'>
            <div class='dosen-info'>
                <h4>{$nama}</h4>
                <p class='jabatan'>{$jabatan}</p>
                <p>{$nidn}</p>
            </div>
        </div>";
    }
    ?>
</div>

<div class="popup" id="dosenPopup">
    <div class="popup-content">
        <img id="popFoto" src="" alt="">
        <h3 id="popNama"></h3>
        <div class="popup-details">
            <p><strong>Jabatan</strong> <span id="popJabatan"></span></p>
            <p><strong>NIDN</strong> <span id="popNidn"></span></p>
            <p><strong>Program Studi</strong> <span id="popProdi"></span></p>
            <p><strong>Keahlian</strong> <span id="popKeahlian"></span></p>
            <p><strong>Pendidikan</strong> <span id="popPendidikan"></span></p>
            <p><strong>Status</strong> <span id="popStatus"></span></p>
            <p><strong>Email</strong> <span id="popEmail"></span></p>
        </div>
        <button class="close-btn" onclick="closeDosenPopup()">Tutup</button>
    </div>
</div>
<?php
include 'includes/footer.php';
?>