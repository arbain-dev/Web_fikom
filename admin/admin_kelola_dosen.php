<?php
require_once '../config/database.php'; 
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$upload_dir = '../uploads/dosen/';
$pesan_sukses = "";
$pesan_error = "";
$action_mode = "";

// 2. LOGIKA CREATE / EDIT (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $dosen_id = intval($_POST['dosen_id'] ?? 0);
    $foto_lama = $_POST['foto_lama'] ?? null;
    
    // Ambil data form
    $nidn = $conn->real_escape_string($_POST['nidn'] ?? '');
    $nama = $conn->real_escape_string($_POST['nama']);
    $prodi = $conn->real_escape_string($_POST['program_studi']);
    $pendidikan = $conn->real_escape_string($_POST['pendidikan']);
    $jabatan = $conn->real_escape_string($_POST['jabatan'] ?? '');
    $status = $conn->real_escape_string($_POST['status']);
    $email = $conn->real_escape_string($_POST['email']);
    $keahlian = $conn->real_escape_string($_POST['keahlian'] ?? '');
    $foto_file = $foto_lama; 

    // Validasi Sederhana
    if (empty($nama) || empty($email) || empty($prodi) || empty($pendidikan) || empty($status)) {
         $pesan_error = "Semua field bertanda * harus diisi.";
         $action_mode = $action;
    }

    // Upload Foto
    if (empty($pesan_error) && isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $fileExt = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($fileExt, ['jpg', 'jpeg', 'png', 'webp']) && $_FILES['foto']['size'] <= 2000000) {
            $newFileName = time() . '-' . uniqid() . '.' . $fileExt;
            if(move_uploaded_file($_FILES['foto']['tmp_name'], $upload_dir . $newFileName)) {
                $foto_file = $newFileName;
                if ($action === 'edit_dosen' && !empty($foto_lama) && file_exists($upload_dir . $foto_lama)) {
                    @unlink($upload_dir . $foto_lama);
                }
            }
        } else {
            $pesan_error = "Foto tidak valid (Max 2MB, JPG/PNG/WEBP).";
        }
    }
    
    // Eksekusi Database
    if (empty($pesan_error)) {
        if ($action === 'tambah_dosen') {
            $stmt = $conn->prepare("INSERT INTO dosen (nidn, nama, program_studi, keahlian, pendidikan, jabatan, status, email, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $nidn, $nama, $prodi, $keahlian, $pendidikan, $jabatan, $status, $email, $foto_file);
        } elseif ($action === 'edit_dosen' && $dosen_id > 0) {
            $stmt = $conn->prepare("UPDATE dosen SET nidn=?, nama=?, program_studi=?, keahlian=?, pendidikan=?, jabatan=?, status=?, email=?, foto=? WHERE id=?");
            $stmt->bind_param("sssssssssi", $nidn, $nama, $prodi, $keahlian, $pendidikan, $jabatan, $status, $email, $foto_file, $dosen_id);
        }

        if (isset($stmt) && $stmt->execute()) {
            $status_msg = ($action == 'tambah_dosen') ? 'tambah_sukses' : 'edit_sukses';
            header("Location: admin_kelola_dosen.php?status=" . $status_msg);
            exit;
        } else {
            $pesan_error = "Gagal memproses database.";
        }
    }
}

// 3. LOGIKA DELETE (Menghapus Data Dosen)
if (isset($_GET['hapus'])) {
    $id_hapus = (int) $_GET['hapus'];

    $stmt = $conn->prepare("SELECT foto FROM dosen WHERE id = ?");
    $stmt->bind_param("i", $id_hapus);
    $stmt->execute();
    $stmt->bind_result($foto);
    $stmt->fetch();
    $stmt->close();
    if (!empty($foto) && file_exists($upload_dir . $foto)) {
        @unlink($upload_dir . $foto);
    }
    $stmt = $conn->prepare("DELETE FROM dosen WHERE id = ?");
    $stmt->bind_param("i", $id_hapus);
    $stmt->execute();
    $stmt->close();

    $pesan_sukses = "Dosen berhasil dihapus.";
    header("Location: admin_kelola_dosen.php?status=hapus_sukses");
    exit;
}

// 4. LOGIKA READ (Mengambil Data untuk Tabel & Statistik)
$dosen_list = [];
$filter_prodi = $_GET['filter_prodi'] ?? ''; 
$sql_dosen = "SELECT * FROM dosen";

if (!empty($filter_prodi)) {
    $safe_prodi = $conn->real_escape_string($filter_prodi);
    $sql_dosen .= " WHERE program_studi = '$safe_prodi'"; 
}
$sql_dosen .= " ORDER BY nama ASC";

$result_dosen = $conn->query($sql_dosen);
if ($result_dosen) {
    while($row = $result_dosen->fetch_assoc()) { $dosen_list[] = $row; }
}

$total_dosen = $conn->query("SELECT COUNT(id) as total FROM dosen")->fetch_assoc()['total'] ?? 0;
$dosen_tetap = $conn->query("SELECT COUNT(id) as total FROM dosen WHERE status = 'Tetap'")->fetch_assoc()['total'] ?? 0;
$dosen_s3 = $conn->query("SELECT COUNT(id) as total FROM dosen WHERE pendidikan = 'S3'")->fetch_assoc()['total'] ?? 0;
$dosen_s2 = $conn->query("SELECT COUNT(id) as total FROM dosen WHERE pendidikan = 'S2'")->fetch_assoc()['total'] ?? 0;

$dosen_data_json = json_encode($dosen_list);

if (isset($_GET['status'])) {
    if ($_GET['status'] == 'tambah_sukses') $pesan_sukses = "Data dosen berhasil ditambahkan!";
    elseif ($_GET['status'] == 'edit_sukses') $pesan_sukses = "Data dosen berhasil diupdate!";
    elseif ($_GET['status'] == 'hapus_sukses') $pesan_sukses = "Data dosen berhasil dihapus!";
}

include 'includes/admin_header.php'; 
?>
        <!-- Purple Banner -->
        <div class="page-banner">
            <h1 class="banner-title">Kelola Data Dosen</h1>
        </div>

    <?php if ($pesan_sukses): ?>
        <div class="alert alert-success mb-6">
            <?= $pesan_sukses ?>
        </div>
    <?php endif; ?>
    <?php if ($pesan_error): ?>
        <div class="alert alert-error mb-6">
            <?= $pesan_error ?>
        </div>
    <?php endif; ?>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="info"><h3><?= $total_dosen ?></h3><p>Total Dosen</p></div>
            <div class="stat-icon blue"><i class="fas fa-users"></i></div> 
        </div>
        <div class="stat-card">
            <div class="info"><h3><?= $dosen_tetap ?></h3><p>Dosen Tetap</p></div>
            <div class="stat-icon teal"><i class="fas fa-user-check"></i></div>
        </div>
        <div class="stat-card">
            <div class="info"><h3><?= $dosen_s3 ?></h3><p>Doktor (S3)</p></div>
            <div class="stat-icon orange"><i class="fas fa-graduation-cap"></i></div> 
        </div>
        <div class="stat-card">
            <div class="info"><h3><?= $dosen_s2 ?></h3><p>Magister (S2)</p></div>
            <div class="stat-icon purple"><i class="fas fa-user-tie"></i></div>
        </div>
    </div>



    <!-- Unified Card Layout -->
    <div class="card">
        <div class="card-header flex-between mb-4">
            <h2 class="card-title">Daftar Dosen</h2>
            <button type="button" class="btn btn-primary" onclick="openAddDosenModal()">
                <i class="fas fa-plus"></i> Tambah Dosen
            </button>
        </div>
        
        <div class="card-body mb-6">
            <form action="" method="GET" class="filter-form">
                <select name="filter_prodi" class="form-select filter-select">
                    <option value="">— Semua Prodi —</option>
                    <option value="Informatika" <?= $filter_prodi == 'Informatika' ? 'selected' : '' ?>>Informatika</option>
                    <option value="Pendidikan Teknologi Informasi" <?= $filter_prodi == 'Pendidikan Teknologi Informasi' ? 'selected' : '' ?>>Pendidikan Teknologi Informasi</option>
                </select>
                <button type="submit" class="btn btn-sm btn-secondary">Filter</button>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama / NIDN</th>
                        <th>Prodi</th>
                        <th>Pendidikan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (count($dosen_list) > 0): ?>
                        <?php $no = 1; foreach ($dosen_list as $i => $dosen): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?php 
                                    $img_name = !empty($dosen['foto']) ? $dosen['foto'] : '';
                                    $img_path = '../uploads/dosen/' . $img_name;
                                    
                                    if (!empty($img_name) && file_exists(dirname(__DIR__) . '/uploads/dosen/' . $img_name)) {
                                        $display_img = $img_path;
                                    } else {
                                        $display_img = 'https://ui-avatars.com/api/?name=' . urlencode($dosen['nama']) . '&background=random';
                                    }
                                    ?>
                                    <img src="<?= $display_img ?>" class="table-img-sm avatar-img">
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($dosen['nama']) ?></strong><br>
                                    <small class="text-muted"><?= htmlspecialchars($dosen['nidn']) ?></small>
                                </td>
                                <td><?= htmlspecialchars($dosen['program_studi']) ?></td>
                                <td><?= htmlspecialchars($dosen['pendidikan']) ?></td>
                                <td>
                                    <span class="badge <?= strtolower($dosen['status']) == 'tetap' ? 'badge-aktif' : 'badge-nonaktif' ?>">
                                        <?= htmlspecialchars($dosen['status']) ?>
                                    </span>
                                </td>
                                <td class="action-links">
                                    <button class="btn-icon edit" onclick="setupEditDosen(<?= $dosen['id'] ?>); return false;" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="admin_kelola_dosen.php?hapus=<?= $dosen['id'] ?>" class="btn-icon delete" onclick="return confirm('Yakin hapus?');" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center">Tidak ada data dosen.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        </div>
    </div>
    
    <!-- MODAL DOSEN -->
    <div id="dosenModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Tambah Dosen</h2>
                <button class="close-btn" onclick="modalHide('dosenModal')">&times;</button>
            </div>
            
            <div class="modal-body">
                <form id="dosenForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" id="formAction" value="tambah_dosen">
                    <input type="hidden" name="dosen_id" id="dosenId" value="0">
                    <input type="hidden" name="foto_lama" id="fotoLama" value="">
                    
                    <div class="input-box">
                        <label>Nama Lengkap <span class="text-error">*</span></label>
                        <input type="text" name="nama" id="nama" required>
                    </div>
                    
                    <div class="input-row">
                        <div class="input-box">
                            <label>NIDN/NIP</label>
                            <input type="text" name="nidn" id="nidn">
                        </div>
                        <div class="input-box">
                            <label>Email <span class="text-error">*</span></label>
                            <input type="email" name="email" id="email" required>
                        </div>
                    </div>
    
                    <div class="input-row">
                        <div class="input-box">
                            <label>Program Studi <span class="text-error">*</span></label>
                            <select name="program_studi" id="program_studi" required>
                                <option value="">-- Pilih --</option>
                                <option value="Informatika">Informatika</option>
                                <option value="Pendidikan Teknologi Informasi">Pendidikan Teknologi Informasi</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <label>Status <span class="text-error">*</span></label>
                            <select name="status" id="status" required>
                                <option value="Tetap">Tetap</option>
                                <option value="Kontrak">Kontrak</option>
                                <option value="Tidak Tetap">Tidak Tetap</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="input-row">
                        <div class="input-box">
                            <label>Pendidikan <span class="text-error">*</span></label>
                            <select name="pendidikan" id="pendidikan" required>
                                <option value="S3">S3 (Doktor)</option>
                                <option value="S2">S2 (Magister)</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <label>Jabatan</label>
                            <select name="jabatan" id="jabatan">
                                <option value="">-- Pilih --</option>
                                <option value="Asisten Ahli">Asisten Ahli</option>
                                <option value="Lektor">Lektor</option>
                                <option value="Dekan">Dekan</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="input-box">
                        <label>Keahlian</label>
                        <input type="text" name="keahlian" id="keahlian">
                    </div>
    
                    <div class="input-box">
                        <label>Foto (Max 2MB)</label>
                        <input type="file" name="foto" accept="image/*">
                        <div id="previewFotoBox" class="file-preview-box hidden">
                            <img id="imgPreview" class="img-preview-sm">
                            <small class="text-muted block mt-2">Foto saat ini</small>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="modalHide('dosenModal')">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('dosenForm').submit()">Simpan</button>
            </div>
        </div>
    </div>
    
    <!-- Data Container for JS -->
    <div id="dosen-page-data" 
         data-dosen='<?= htmlspecialchars(json_encode($dosen_list, JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8') ?>' 
         data-error='<?= !empty($pesan_error) ? 'true' : 'false' ?>'
         class="hidden">
    </div>
    
    <?php include 'includes/admin_footer.php'; ?>
