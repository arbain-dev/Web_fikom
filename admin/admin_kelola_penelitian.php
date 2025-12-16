<?php

session_start();
require_once '../database/db_connect.php';
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

<main class="content-area">
    <div class="breadcrumbs">
        <a href="dashboard.php">Admin</a> &gt; <span>Kelola Penelitian</span>
    </div>
    <div class="content-box">
        <div class="box-header">
            <h4>Daftar Penelitian</h4>
            <form method="GET" class="filter-bar">
                <select name="filter_tahun">
                    <option value="">— Semua Tahun —</option>
                    <?php
                        $y = date('Y');
                        for ($i=$y; $i>=$y-5; $i--) {
                            $sel = ($filter_tahun==$i) ? "selected" : "";
                            echo "<option value='$i' $sel>$i</option>";
                        }
                    ?>
                </select>
                <select name="filter_status">
                    <option value="">— Semua Status —</option>
                    <option value="Draft" <?= $filter_status=="Draft"?"selected":"" ?>>Draft</option>
                    <option value="Sedang Berjalan" <?= $filter_status=="Sedang Berjalan"?"selected":"" ?>>Sedang Berjalan</option>
                    <option value="Selesai" <?= $filter_status=="Selesai"?"selected":"" ?>>Selesai</option>
                </select>
                <button type="submit">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <button type="button" id="btnOpenTambah" class="btn-tambah">
                    <i class="fas fa-plus"></i> Tambah Baru
                </button>
            </form>
        </div>

        <?php if ($msg != ""): ?>
            <div class="message <?= $type ?>"><?= $msg ?></div>
        <?php endif; ?>
       <table class="data-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Peneliti</th>
            <th>Tahun</th>
            <th>Status</th>
            <th>Sumber Dana</th>
            <th>Jumlah Dana</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($penelitian_list)): $i=1; ?>
            <?php foreach ($penelitian_list as $p): ?>
                <?php
                    $badge = strtolower($p['status']) === "selesai" ? "selesai" :
                             (strtolower($p['status']) === "sedang berjalan" ? "proses" : "draft");
                ?>
                <tr>
                    <td data-label="No"><?= $i++ ?></td>
                    <td data-label="Judul"><?= htmlspecialchars($p['judul']) ?></td>
                    <td data-label="Peneliti"><?= htmlspecialchars($p['peneliti']) ?></td>
                    <td data-label="Tahun"><?= $p['tahun'] ?></td>
                    <td data-label="Status">
                        <span class="badge <?= $badge ?>"><?= $p['status'] ?></span>
                    </td>
                    <td data-label="Sumber Dana"><?= $p['sumber_dana'] ?></td>
                    <td data-label="Jumlah Dana"><?= number_format($p['jumlah_dana']) ?></td>
                    <td class="action-buttons" data-label="Aksi">

                        <button class="edit"
                            onclick="openEditPenelitian(this)"
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
                            data-file_laporan="<?= htmlspecialchars($p['file_laporan'], ENT_QUOTES) ?>">
                            <i class="fas fa-edit"></i>
                        </button>

                        <a href="admin_kelola_penelitian.php?aksi=hapus&id=<?= $p['id'] ?>"
                           onclick="return confirm('Yakin ingin menghapus?')"
                           class="delete">
                           <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" style="text-align:center;">Tidak ada data.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


    </div>
</main>
<!-- ======================== MODAL TAMBAH / EDIT ======================== -->
<div class="modal-penelitian-overlay" id="modalPenelitianOverlay">
    <div class="modal-penelitian">

        <div class="modal-header-bar">
            <h2 id="modalPenelitianTitle">Tambah Penelitian</h2>
            <button class="modal-close-btn" onclick="closeModalPenelitian()">&times;</button>
        </div>

        <!-- ========================== FORM MULAI ========================== -->
        <form id="formPenelitian" action="admin_kelola_penelitian.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="mode_penelitian" id="mode_penelitian" value="tambah">
            <input type="hidden" name="id" id="id_penelitian">
            <input type="hidden" name="old_file_proposal" id="old_file_proposal">
            <input type="hidden" name="old_file_laporan" id="old_file_laporan">

            <div class="form-grid-penelitian">
                <div class="form-section">
                    <div class="form-section-header">
                        <i class="fas fa-info-circle"></i> Identitas Penelitian
                    </div>
                    <div class="form-section-body">
                        <div class="input-box">
                            <label for="judul">Judul Penelitian *</label>
                            <textarea id="judul" name="judul" rows="3" required></textarea>
                        </div>
                        <div class="input-box">
                            <label for="peneliti">Nama Peneliti *</label>
                            <input type="text" id="peneliti" name="peneliti" required>
                        </div>
                        <div class="input-grid-2">
                            <div class="input-box">
                                <label for="tahun">Tahun *</label>
                                <input type="number" id="tahun" name="tahun" min="2000" max="2099">
                            </div>
                            <div class="input-box">
                                <label for="status">Status *</label>
                                <select id="status" name="status">
                                    <option value="Draft">Draft</option>
                                    <option value="Sedang Berjalan">Sedang Berjalan</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-box">
                            <label for="skim_penelitian">Skim Penelitian</label>
                            <input type="text" id="skim_penelitian" name="skim_penelitian">
                        </div>
                        <div class="input-box">
                            <label for="kelompok_bidang">Kelompok Bidang</label>
                            <input type="text" id="kelompok_bidang" name="kelompok_bidang">
                        </div>
                        <div class="input-grid-2">
                            <div class="input-box">
                                <label for="nomor_sk">Nomor SK</label>
                                <input type="text" id="nomor_sk" name="nomor_sk">
                            </div>
                            <div class="input-box">
                                <label for="lama_kegiatan">Lama Kegiatan</label>
                                <input type="text" id="lama_kegiatan" name="lama_kegiatan">
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="form-section">
                        <div class="form-section-header header-pendanaan">
                            <i class="fas fa-dollar-sign"></i> Pendanaan & Periode
                        </div>
                        <div class="form-section-body">
                            <div class="input-grid-2">
                                <div class="input-box">
                                    <label for="sumber_dana">Sumber Dana</label>
                                    <select id="sumber_dana" name="sumber_dana">
                                        <option value="Internal">Internal</option>
                                        <option value="Eksternal (Kemdikbud)">Eksternal (Kemdikbud)</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="input-box">
                                    <label for="jumlah_dana">Jumlah Dana (Rp)</label>
                                    <input type="number" id="jumlah_dana" name="jumlah_dana" min="0">
                                </div>
                            </div>
                            <div class="input-grid-2">
                                <div class="input-box">
                                    <label for="tanggal_mulai">Tanggal Mulai</label>
                                    <input type="date" id="tanggal_mulai" name="tanggal_mulai">
                                </div>
                                <div class="input-box">
                                    <label for="tanggal_selesai">Tanggal Selesai</label>
                                    <input type="date" id="tanggal_selesai" name="tanggal_selesai">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section" style="margin-top:20px;">
                        <div class="form-section-header">
                            <i class="fas fa-folder"></i> Lokasi & Dokumen
                        </div>
                        <div class="form-section-body">
                            <div class="input-box">
                                <label for="lokasi_penelitian">Lokasi Penelitian</label>
                                <input type="text" id="lokasi_penelitian" name="lokasi_penelitian">
                            </div>
                            <div class="input-box">
                                <label for="afiliasi">Afiliasi</label>
                                <input type="text" id="afiliasi" name="afiliasi">
                            </div>
                            <div class="input-box">
                                <label for="file_proposal">Upload Proposal</label>
                                <input type="file" id="file_proposal" name="file_proposal" accept=".pdf,.doc,.docx">
                                <div id="info_file_proposal" class="file-format"></div>
                            </div>
                            <div class="input-box">
                                <label for="file_laporan">Upload Laporan</label>
                                <input type="file" id="file_laporan" name="file_laporan" accept=".pdf,.doc,.docx">
                                <div id="info_file_laporan" class="file-format"></div>
                            </div>
                            <div class="input-box">
                                <label for="link_publikasi">Link Publikasi</label>
                                <input type="url" id="link_publikasi" name="link_publikasi">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-simpan"><i class="fas fa-save"></i> Simpan</button>
                <button type="button" class="btn-tutup" onclick="closeModal('modalPenelitian')">Tutup</button>
                <button type="reset" class="btn-reset"><i class="fas fa-undo"></i> Reset</button>
            </div>
        </form>
    </div>
</div>
<script src="../assets/js/admin_global.js"></script>
