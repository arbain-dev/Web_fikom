<?php

session_start();
require_once '../config/database.php';
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

/* ============================================================
   HELPER UPLOAD FILE
   ============================================================ */
function uploadFile($fileInputName, $targetSubDir, &$errorMsg)
{
    $errorMsg = '';
    if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === 0) {

        $target_dir = "../uploads/" . $targetSubDir . "/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);

        $ext = strtolower(pathinfo($_FILES[$fileInputName]['name'], PATHINFO_EXTENSION));
        $allowed = ['pdf', 'doc', 'docx'];

        if (!in_array($ext, $allowed)) {
            $errorMsg = "Format file tidak valid untuk $fileInputName.";
            return [false, null];
        }

        $newName = time() . "-" . uniqid() . "." . $ext;
        $target_file = $target_dir . $newName;

        if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $target_file)) {
            return [true, $newName];
        } else {
            $errorMsg = "Gagal upload file $fileInputName.";
            return [false, null];
        }
    }
    return [true, null];
}

/* ============================================================
   PROSES HAPUS
   ============================================================ */
if (isset($_GET['aksi']) && $_GET['aksi'] === "hapus" && isset($_GET['id'])) {

    $id = (int)$_GET['id'];

    try {
        $sqlOld = $conn->prepare("SELECT file_proposal, file_laporan FROM penelitian WHERE id=?");
        $sqlOld->bind_param("i", $id);
        $sqlOld->execute();
        $old = $sqlOld->get_result()->fetch_assoc();

        $del = $conn->prepare("DELETE FROM penelitian WHERE id=?");
        $del->bind_param("i", $id);

        if ($del->execute()) {

            if (!empty($old['file_proposal'])) {
                $fp = "../uploads/penelitian_proposal/" . $old['file_proposal'];
                if (file_exists($fp)) @unlink($fp);
            }
            if (!empty($old['file_laporan'])) {
                $fl = "../uploads/penelitian_laporan/" . $old['file_laporan'];
                if (file_exists($fl)) @unlink($fl);
            }

            header("Location: admin_kelola_penelitian.php?status=hapus_sukses");
            exit;
        } else {
            header("Location: admin_kelola_penelitian.php?status=hapus_gagal&msg=" . urlencode($del->error));
            exit;
        }
    } catch (Exception $e) {
        header("Location: admin_kelola_penelitian.php?status=hapus_gagal&msg=" . urlencode($e->getMessage()));
        exit;
    }
}

/* ============================================================
   PROSES TAMBAH & EDIT
   ============================================================ */
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['mode_penelitian'])) {

    $mode = $_POST['mode_penelitian'];
    $id   = $_POST['id'] ?? 0;

    $judul           = $_POST['judul'];
    $peneliti        = $_POST['peneliti'];
    $tahun           = $_POST['tahun'];
    $status          = $_POST['status'];
    $skim            = $_POST['skim_penelitian'];
    $kelompok        = $_POST['kelompok_bidang'];
    $nomor_sk        = $_POST['nomor_sk'];
    $lama_kegiatan   = $_POST['lama_kegiatan'];
    $sumber_dana     = $_POST['sumber_dana'];
    $jumlah_dana     = $_POST['jumlah_dana'];
    $tanggal_mulai   = $_POST['tanggal_mulai'] ?: null;
    $tanggal_selesai = $_POST['tanggal_selesai'] ?: null;
    $lokasi          = $_POST['lokasi_penelitian'];
    $afiliasi        = $_POST['afiliasi'];
    $link_publikasi  = $_POST['link_publikasi'];

    $old_proposal = $_POST['old_file_proposal'] ?? '';
    $old_laporan  = $_POST['old_file_laporan'] ?? '';

    $err1 = $err2 = "";

    list($ok1, $f_proposal) = uploadFile("file_proposal", "penelitian_proposal", $err1);
    list($ok2, $f_laporan)  = uploadFile("file_laporan",  "penelitian_laporan",  $err2);

    if (!$ok1 || !$ok2) {
        $err = !$ok1 ? $err1 : $err2;
        header("Location: admin_kelola_penelitian.php?status=gagal_file&msg=" . urlencode($err));
        exit;
    }

    if ($mode === "edit") {
        if ($f_proposal === null) $f_proposal = $old_proposal;
        if ($f_laporan  === null) $f_laporan  = $old_laporan;
    }

    try {
        if ($mode === "tambah") {

            $sql = $conn->prepare("
                INSERT INTO penelitian
                (judul, peneliti, tahun, status, skim_penelitian, kelompok_bidang, nomor_sk, lama_kegiatan,
                sumber_dana, jumlah_dana, tanggal_mulai, tanggal_selesai, lokasi_penelitian, afiliasi,
                file_proposal, file_laporan, link_publikasi)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $sql->bind_param(
                "ssissssssisssssss",
                $judul, $peneliti, $tahun, $status, $skim, $kelompok, $nomor_sk, $lama_kegiatan,
                $sumber_dana, $jumlah_dana, $tanggal_mulai, $tanggal_selesai, $lokasi,
                $afiliasi, $f_proposal, $f_laporan, $link_publikasi
            );

            if ($sql->execute()) {
                header("Location: admin_kelola_penelitian.php?status=tambah_sukses");
                exit;
            } else {
                header("Location: admin_kelola_penelitian.php?status=tambah_gagal&msg=" . urlencode($sql->error));
                exit;
            }

        } elseif ($mode === "edit") {

            $sql = $conn->prepare("
                UPDATE penelitian SET
                judul=?, peneliti=?, tahun=?, status=?, skim_penelitian=?, kelompok_bidang=?, nomor_sk=?, lama_kegiatan=?,
                sumber_dana=?, jumlah_dana=?, tanggal_mulai=?, tanggal_selesai=?, lokasi_penelitian=?, afiliasi=?,
                file_proposal=?, file_laporan=?, link_publikasi=?
                WHERE id=?
            ");

            $sql->bind_param(
                "ssissssssisssssssi",
                $judul, $peneliti, $tahun, $status, $skim, $kelompok, $nomor_sk, $lama_kegiatan,
                $sumber_dana, $jumlah_dana, $tanggal_mulai, $tanggal_selesai, $lokasi, $afiliasi,
                $f_proposal, $f_laporan, $link_publikasi, $id
            );

            if ($sql->execute()) {
                header("Location: admin_kelola_penelitian.php?status=edit_sukses");
                exit;
            } else {
                header("Location: admin_kelola_penelitian.php?status=edit_gagal&msg=" . urlencode($sql->error));
                exit;
            }
        }

    } catch (Exception $e) {
        header("Location: admin_kelola_penelitian.php?status=gagal&msg=" . urlencode($e->getMessage()));
        exit;
    }
}

/* ============================================================
   AMBIL DATA UNTUK TABEL
   ============================================================ */
$filter_tahun = $_GET['filter_tahun'] ?? "";
$filter_status = $_GET['filter_status'] ?? "";

$where = [];

if ($filter_tahun != "") $where[] = "tahun = '$filter_tahun'";
if ($filter_status != "") $where[] = "status = '$filter_status'";

$sql = "SELECT * FROM penelitian";
if (!empty($where)) $sql .= " WHERE " . implode(" AND ", $where);
$sql .= " ORDER BY tahun DESC, judul ASC";

$res = $conn->query($sql);
$penelitian_list = [];
if ($res && $res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $penelitian_list[] = $row;
    }
}

/* ============================================================
   STATUS NOTIFIKASI
   ============================================================ */
$msg = "";
$type = "";

if (isset($_GET['status'])) {
    $s = $_GET['status'];

    if ($s === "tambah_sukses") { $msg = "Berhasil menambahkan penelitian."; $type="success"; }
    elseif ($s === "edit_sukses") { $msg = "Berhasil memperbarui penelitian."; $type="success"; }
    elseif ($s === "hapus_sukses") { $msg = "Berhasil menghapus penelitian."; $type="success"; }
    elseif ($s === "tambah_gagal" || $s === "edit_gagal" || $s === "hapus_gagal") {
        $msg = $_GET['msg'] ?? "Terjadi kesalahan.";
        $type="error";
    }
    elseif ($s === "gagal_file") { $msg = $_GET['msg']; $type="error"; }
}
/* ============================================================
   PANGGIL HEADER
   ============================================================ */
include 'includes/admin_header.php';
?>

    <!-- Purple Banner -->
    <div class="page-banner">
        <h1 class="banner-title">Penelitian</h1>
    </div>

    <?php if ($msg != ""): ?>
        <div class="alert alert-<?= $type === 'success' ? 'success' : 'error' ?>" style="margin-top: 20px;">
            <i class="fas fa-<?= $type === 'success' ? 'check-circle' : 'exclamation-circle' ?>"></i>
            <?= htmlspecialchars($msg) ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header flex-between" style="flex-wrap:wrap; gap:10px;">
            <div style="display:flex; align-items:center; gap:15px;">
                <h2 class="card-title" style="margin:0;">Daftar Penelitian</h2>
                <form method="GET" class="filter-bar" style="display:flex; gap:10px; margin:0;">
                    <select name="filter_tahun" class="form-select-sm" style="padding:5px; border-radius:4px; border:1px solid #ddd;">
                        <option value="">— Semua Tahun —</option>
                        <?php
                            $y = date('Y');
                            for ($i=$y; $i>=$y-5; $i--) {
                                $sel = ($filter_tahun==$i) ? "selected" : "";
                                echo "<option value='$i' $sel>$i</option>";
                            }
                        ?>
                    </select>
                    <select name="filter_status" class="form-select-sm" style="padding:5px; border-radius:4px; border:1px solid #ddd;">
                        <option value="">— Semua Status —</option>
                        <option value="Draft" <?= $filter_status=="Draft"?"selected":"" ?>>Draft</option>
                        <option value="Sedang Berjalan" <?= $filter_status=="Sedang Berjalan"?"selected":"" ?>>Sedang Berjalan</option>
                        <option value="Selesai" <?= $filter_status=="Selesai"?"selected":"" ?>>Selesai</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-secondary">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </form>
            </div>
            
            <button type="button" id="btnOpenTambah" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Baru
            </button>
        </div>



        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Peneliti</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($penelitian_list)): $i=1; foreach ($penelitian_list as $p): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($p['judul']) ?></td>
                            <td><?= htmlspecialchars($p['peneliti']) ?></td>
                            <td><?= $p['tahun'] ?></td>
                            <td>
                                <?php
                                    $badge = strtolower($p['status']) === "selesai" ? "badge-aktif" :
                                            (strtolower($p['status']) === "sedang berjalan" ? "badge-info" : "badge-nonaktif");
                                ?>
                                <span class="badge <?= $badge ?>"><?= $p['status'] ?></span>
                            </td>
                            <td class="action-links">
                                <button class="btn-icon edit btn-edit-penelitian"
                                    type="button"
                                    data-id="<?= $p['id'] ?>"
                                    data-judul="<?= htmlspecialchars($p['judul'], ENT_QUOTES) ?>"
                                    data-peneliti="<?= htmlspecialchars($p['peneliti'], ENT_QUOTES) ?>"
                                    data-tahun="<?= $p['tahun'] ?>"
                                    data-status="<?= $p['status'] ?>"
                                    data-skim_penelitian="<?= htmlspecialchars($p['skim_penelitian'], ENT_QUOTES) ?>"
                                    data-kelompok_bidang="<?= htmlspecialchars($p['kelompok_bidang'], ENT_QUOTES) ?>"
                                    data-nomor_sk="<?= htmlspecialchars($p['nomor_sk'], ENT_QUOTES) ?>"
                                    data-lama_kegiatan="<?= htmlspecialchars($p['lama_kegiatan'], ENT_QUOTES) ?>"
                                    data-sumber_dana="<?= htmlspecialchars($p['sumber_dana'], ENT_QUOTES) ?>"
                                    data-jumlah_dana="<?= $p['jumlah_dana'] ?>"
                                    data-tanggal_mulai="<?= $p['tanggal_mulai'] ?>"
                                    data-tanggal_selesai="<?= $p['tanggal_selesai'] ?>"
                                    data-lokasi_penelitian="<?= htmlspecialchars($p['lokasi_penelitian'], ENT_QUOTES) ?>"
                                    data-afiliasi="<?= htmlspecialchars($p['afiliasi'], ENT_QUOTES) ?>"
                                    data-link_publikasi="<?= htmlspecialchars($p['link_publikasi'], ENT_QUOTES) ?>"
                                    data-file_proposal="<?= htmlspecialchars($p['file_proposal'], ENT_QUOTES) ?>"
                                    data-file_laporan="<?= htmlspecialchars($p['file_laporan'], ENT_QUOTES) ?>"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <a href="admin_kelola_penelitian.php?aksi=hapus&id=<?= $p['id'] ?>"
                                   onclick="return confirm('Yakin ingin menghapus?')"
                                   class="btn-icon delete"
                                   title="Hapus">
                                   <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="6" class="text-center">Tidak ada data penelitian.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

<!-- ======================== MODAL TAMBAH / EDIT ======================== -->
<div id="modalPenelitian" class="modal modal-xl modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalPenelitianTitle">TAMBAH PENELITIAN</h2>
            <span class="close-btn" onclick="window.modalHide('modalPenelitian')">&times;</span>
        </div>

        <form id="formPenelitian" action="admin_kelola_penelitian.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="mode_penelitian" id="mode_penelitian" value="tambah">
            <input type="hidden" name="id" id="id_penelitian">
            <input type="hidden" name="old_file_proposal" id="old_file_proposal">
            <input type="hidden" name="old_file_laporan" id="old_file_laporan">

            <div class="modal-body">
                <!-- Identitas -->
                <h3 style="font-size: 1.1rem; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px; margin-bottom: 15px; color: var(--primary-600);">
                    <i class="fas fa-info-circle"></i> Identitas & Detail
                </h3>
                
                <div class="input-box">
                    <label class="required">Judul Penelitian</label>
                    <textarea id="judul" name="judul" rows="2" required></textarea>
                </div>
                
                <div class="grid-3-cols">
                    <div class="input-box">
                        <label class="required">Nama Peneliti</label>
                        <input type="text" id="peneliti" name="peneliti" required>
                    </div>
                    <div class="input-box">
                        <label class="required">Tahun</label>
                        <input type="number" id="tahun" name="tahun" min="2000" max="2099" required>
                    </div>
                    <div class="input-box">
                        <label class="required">Status</label>
                        <select id="status" name="status" required>
                            <option value="Draft">Draft</option>
                            <option value="Sedang Berjalan">Sedang Berjalan</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                </div>

                <div class="grid-3-cols">
                    <div class="input-box">
                        <label>Skim Penelitian</label>
                        <input type="text" id="skim_penelitian" name="skim_penelitian">
                    </div>
                    <div class="input-box">
                        <label>Kelompok Bidang</label>
                        <input type="text" id="kelompok_bidang" name="kelompok_bidang">
                    </div>
                    <div class="input-box">
                        <label>Nomor SK</label>
                        <input type="text" id="nomor_sk" name="nomor_sk">
                    </div>
                </div>
                
                <div class="grid-3-cols">
                    <div class="input-box">
                        <label>Lama Kegiatan</label>
                        <input type="text" id="lama_kegiatan" name="lama_kegiatan">
                    </div>
                    <div class="input-box">
                        <label>Sumber Dana</label>
                        <select id="sumber_dana" name="sumber_dana">
                            <option value="Internal">Internal</option>
                            <option value="Eksternal (Kemdikbud)">Eksternal (Kemdikbud)</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <label>Jumlah Dana (Rp)</label>
                        <input type="number" id="jumlah_dana" name="jumlah_dana" min="0">
                    </div>
                </div>

                <!-- Lokasi & Dokumen -->
                <h3 style="font-size: 1.1rem; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px; margin: 25px 0 15px 0; color: var(--primary-600);">
                     <i class="fas fa-folder"></i> Pelaksanaan & Dokumen
                </h3>

                <div class="grid-3-cols">
                     <div class="input-box">
                        <label>Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai">
                    </div>
                    <div class="input-box">
                        <label>Tanggal Selesai</label>
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai">
                    </div>
                    <div class="input-box">
                        <label>Lokasi Penelitian</label>
                        <input type="text" id="lokasi_penelitian" name="lokasi_penelitian">
                    </div>
                </div>

                <div class="grid-2-cols">
                    <div class="input-box">
                        <label>Afiliasi</label>
                        <input type="text" id="afiliasi" name="afiliasi">
                    </div>
                     <div class="input-box">
                        <label>Link Publikasi</label>
                        <input type="url" id="link_publikasi" name="link_publikasi" placeholder="https://...">
                    </div>
                </div>

                <div class="grid-2-cols">
                    <div class="input-box">
                        <label>Upload Proposal (PDF/DOC)</label>
                        <input type="file" id="file_proposal" name="file_proposal" accept=".pdf,.doc,.docx">
                        <small class="text-muted" id="info_proposal_text"></small>
                    </div>
                    <div class="input-box">
                        <label>Upload Laporan (PDF/DOC)</label>
                        <input type="file" id="file_laporan" name="file_laporan" accept=".pdf,.doc,.docx">
                        <small class="text-muted" id="info_laporan_text"></small>
                    </div>
                </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="window.modalHide('modalPenelitian')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>


<?php include 'includes/admin_footer.php'; ?>