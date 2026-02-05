<?php
session_start();
require_once 'config/database.php';
require_once 'config/constants.php';
include 'includes/header.php';

// CSRF Token Generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$message = "";
$msg_type = "";

// Helper Upload File (Enhanced Security)
function uploadFile($file, $destination) {
    if ($file['error'] !== UPLOAD_ERR_OK) return null;
    
    // 1. Check Extension
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $allowed_ext = ['jpg', 'jpeg', 'png', 'pdf'];
    if (!in_array(strtolower($ext), $allowed_ext)) return false;

    // 2. Check MIME Type (Real Content)
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    $allowed_mime = [
        'image/jpeg', 
        'image/png', 
        'application/pdf'
    ];
    if (!in_array($mime, $allowed_mime)) return false;

    $filename = time() . '_' . uniqid() . '.' . $ext;
    if (move_uploaded_file($file['tmp_name'], $destination . '/' . $filename)) {
        return $filename;
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CSRF Check
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Security violation: Invalid CSRF Token.");
    }

    $nama = trim($_POST['nama']);
    $nik = trim($_POST['nik']);
    $email = trim($_POST['email']);
    $hp = trim($_POST['hp']);
    $tempat_lahir = trim($_POST['tempat_lahir']);
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jk = $_POST['jk'];
    $asal_sekolah = trim($_POST['asal_sekolah']);
    $prodi = $_POST['prodi'];
    $jalur = $_POST['jalur'];
    $alamat = trim($_POST['alamat']);
    $catatan = trim($_POST['catatan']);

    // Validasi sederhana
    if (empty($nama) || empty($nik) || empty($email) || empty($hp)) {
        $message = "Mohon lengkapi data wajib!";
        $msg_type = "error";
    } else {
        // Upload Files
        $uploadDir = 'uploads/pendaftaran';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $file_ktp = null;
        if (!empty($_FILES['file_ktp']['name'])) {
            $file_ktp = uploadFile($_FILES['file_ktp'], $uploadDir);
        }

        $file_ijazah = null;
        if (!empty($_FILES['file_ijazah']['name'])) {
            $file_ijazah = uploadFile($_FILES['file_ijazah'], $uploadDir);
        }

        // Insert Database
        $stmt = $conn->prepare("INSERT INTO pendaftaran (nama, nik, email, hp, tempat_lahir, tanggal_lahir, jk, asal_sekolah, prodi, jalur, alamat, file_ktp, file_ijazah, catatan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssssss", $nama, $nik, $email, $hp, $tempat_lahir, $tanggal_lahir, $jk, $asal_sekolah, $prodi, $jalur, $alamat, $file_ktp, $file_ijazah, $catatan);

        if ($stmt->execute()) {
            $message = "Pendaftaran berhasil! Data Anda telah tersimpan. Admin kami akan segera menghubungi Anda.";
            $msg_type = "success";
            // Reset form logic could be here (redirect or clear vars)
        } else {
            $message = "Terjadi kesalahan: " . $conn->error;
            $msg_type = "error";
        }
        $stmt->close();
    }
}
?>

<!-- Custom Styles -->


<div class="color-bg">
    <div class="color"></div>
    <div class="color"></div>
    <div class="color"></div>
</div>

<div class="wrap">
    
    <!-- HEADER ALERT -->
    <?php if ($message): ?>
        <div class="toast-msg <?= $msg_type ?>">
            <i class="fa-solid <?= $msg_type == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle' ?>"></i>
            <?= $message ?>
        </div>
    <?php endif; ?>

    <div class="hero-registration centered">
        <h1 class="registration-hero-title">
            Pendaftaran<br>
            <span class="text-gradient">Mahasiswa Baru —</span><br>
            <span class="text-gradient">UNISAN Sidrap</span>
        </h1>
        <p class="hero-sub text-center max-w-2xl mx-auto mt-4 mb-8 text-gray-600">
            Isi data pendaftaran dengan benar. Setelah klik <b>Kirim Pendaftaran</b>, admin akan memverifikasi data dan menghubungi kamu.
        </p>
        
        <div class="hero-badges flex justify-center gap-4 mb-12">
            <div class="badge-pill">
                <i class="fa-solid fa-shield-halved text-warning-500"></i> 
                <span>Data aman & terenkripsi</span>
            </div>
            <div class="badge-pill">
                <i class="fa-solid fa-bolt text-warning-500"></i>
                <span>Proses cepat & mudah</span>
            </div>
        </div>
    </div>

    <div class="grid-registration">
        <!-- FORM -->
        <div class="card-pendaftaran main-form">
            <div class="card-header-simple">
                <div class="header-icon">
                    <i class="fa-solid fa-pen-nib"></i>
                </div>
                <div class="header-text">
                    <h3>Form Pendaftaran Online</h3>
                    <p>Lengkapi data diri anda dibawah ini</p>
                </div>
            </div>

            <!-- Progress Bar (Optional, keeping it simple for now or hidden if not needed) -->
            <div class="progress-line-container">
                 <div class="progress-line" id="progressBar"></div>
            </div>

            <div class="card-body-pendaftaran">
                <form id="formDaftar" action="" method="POST" enctype="multipart/form-data" autocomplete="on" spellcheck="false">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

            <div class="form-grid">
                <div>
                <label>Nama Lengkap *</label>
                <input class="input req" type="text" name="nama" placeholder="Contoh: Andi Saputra" required spellcheck="false">
                </div>

                <div>
                <label>NIK *</label>
                <input class="input req" type="text" name="nik" inputmode="numeric" placeholder="16 digit" maxlength="16" required>
                <div class="hint">Pastikan NIK sesuai KTP.</div>
                </div>

                <div>
                <label>Email *</label>
                <input class="input req" type="email" name="email" placeholder="nama@email.com" required>
                </div>

                <div>
                <label>No. HP/WhatsApp *</label>
                <input class="input req" type="tel" name="hp" placeholder="08xxxxxxxxxx" required>
                </div>

                <div>
                <label>Tempat Lahir *</label>
                <input class="input req" type="text" name="tempat_lahir" required spellcheck="false">
                </div>

                <div>
                <label>Tanggal Lahir *</label>
                <input class="input req" type="date" name="tanggal_lahir" required>
                </div>

                <div>
                <label class="form-label">Jenis Kelamin *</label>
                <select class="input req" name="jk" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                </div>

                <div>
                <label>Asal Sekolah *</label>
                <input class="input req" type="text" name="asal_sekolah" required spellcheck="false">
                </div>

                <div>
                <label class="form-label">Program Studi Pilihan *</label>
                <select class="input req" name="prodi" required>
                    <option value="">-- Pilih Prodi --</option>
                    <option value="Informatika">Informatika</option>
                    <option value="Pendidikan Teknologi Informasi">Pendidikan Teknologi Informasi</option>
                </select>
                <div class="hint">Silakan sesuaikan daftar prodi UNISAN.</div>
                </div>

                <div>
                <label class="form-label">Jalur Masuk *</label>
                <select class="input req" name="jalur" required>
                    <option value="">-- Pilih Jalur --</option>
                    <option value="Reguler">Reguler</option>
                    <option value="Prestasi">Prestasi</option>
                    <option value="KIP Kuliah">KIP Kuliah</option>
                    <option value="Transfer">Transfer</option>
                </select>
                </div>

                <div class="full">
                <label class="form-label">Alamat Lengkap *</label>
                <textarea class="input req" name="alamat" placeholder="Alamat sesuai domisili..." required spellcheck="false"></textarea>
                </div>

                <div>
                <label>Upload KTP (opsional)</label>
                <input class="input" type="file" name="file_ktp" accept=".jpg,.jpeg,.png,.pdf">
                <div class="hint">Format: JPG/PNG/PDF (maks 5MB).</div>
                </div>

                <div>
                <label>Upload Ijazah / SKL (opsional)</label>
                <input class="input" type="file" name="file_ijazah" accept=".jpg,.jpeg,.png,.pdf">
                <div class="hint">Format: JPG/PNG/PDF (maks 5MB).</div>
                </div>

                <div class="full">
                <label class="form-label">Catatan Tambahan (opsional)</label>
                <textarea class="input" name="catatan" placeholder="Misal: info beasiswa, kebutuhan khusus, dll..." spellcheck="false"></textarea>
                </div>
            </div>

            <div class="toast" id="toastOk">
                <i class="fa-solid fa-circle-check"></i> Form sudah lengkap. Siap dikirim!
            </div>

            <div class="actions">
                <button type="reset" class="btn btn-outline"><i class="fa-solid fa-rotate-left"></i> Reset</button>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> Kirim Pendaftaran</button>
            </div>

            </form>
        </div>
        </div>

        <!-- INFO SAMPING -->
        <div class="side-box">
        <div class="card-pendaftaran">
            <div class="card-header-pendaftaran">
            <h2><i class="fa-solid fa-circle-info"></i> Petunjuk Singkat</h2>
            </div>
            <div class="card-body-pendaftaran">
            <div class="info">
                <i class="fa-solid fa-check"></i>
                <div>
                <strong>Isi data wajib</strong>
                <p>Kolom bertanda (*) wajib diisi, pastikan tidak ada typo.</p>
                </div>
            </div>

            <div class="info">
                <i class="fa-solid fa-file-arrow-up"></i>
                <div>
                <strong>Upload dokumen</strong>
                <p>KTP & Ijazah/SKL opsional. Bisa diunggah sekarang atau menyusul.</p>
                </div>
            </div>

            <div class="info">
                <i class="fa-solid fa-phone"></i>
                <div>
                <strong>Konfirmasi admin</strong>
                <p>Admin akan menghubungi lewat WhatsApp/Email setelah verifikasi.</p>
                </div>
            </div>
            </div>
        </div>

        <div class="card-pendaftaran" style="margin-top: 20px;">
            <div class="card-header-pendaftaran">
            <h2><i class="fa-solid fa-headset"></i> Kontak PMB</h2>
            </div>
            <div class="card-body-pendaftaran">
            <div class="info">
                <i class="fa-brands fa-whatsapp"></i>
                <div>
                <strong>WhatsApp</strong>
                <p>08xx-xxxx-xxxx</p>
                </div>
            </div>
            <div class="info">
                <i class="fa-solid fa-envelope"></i>
                <div>
                <strong>Email</strong>
                <p>pmb@unisan-sidrap.co.id</p>
                </div>
            </div>
            </div>
        </div>

        </div>
    </div>
</div>

<script src="assets/js/pendaftaran.js"></script>

<?php include 'includes/footer.php'; ?>
