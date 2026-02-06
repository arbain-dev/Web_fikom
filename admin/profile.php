<?php
// File: admin/profile

session_start();
require_once '../config/database.php';

// Cek Login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login");
    exit;
}

$message = '';
$message_type = '';

$user_id = $_SESSION['user_id'];

// PROSES FORM
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. UPDATE PROFIL (Username & Email)
    if (isset($_POST['update_profile'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);


        // Validasi sederhana
        if (empty($username) || empty($email)) {
            $message = "Username dan Email wajib diisi.";
            $message_type = 'error';
        } else {
            // Cek apakah username/email sudah dipakai user lain
            $cek = $conn->query("SELECT id FROM users WHERE (username='$username' OR email='$email') AND id != $user_id");
            if ($cek && $cek->num_rows > 0) {
                $message = "Username atau Email sudah digunakan oleh akun lain.";
                $message_type = 'error';
            } else {
                $stmt = $conn->prepare("UPDATE users SET username=?, email=? WHERE id=?");
                $stmt->bind_param("ssi", $username, $email, $user_id);
                if ($stmt->execute()) {
                    $message = "Profil berhasil diperbarui.";
                    $message_type = 'success';
                    // Update session
                    $_SESSION['username'] = $username;
                } else {
                    $message = "Gagal memperbarui profil.";
                    $message_type = 'error';
                }
            }
        }
    }

    // 2. GANTI PASSWORD
    if (isset($_POST['change_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
            $message = "Semua kolom password wajib diisi.";
            $message_type = 'error';
        } elseif ($new_password !== $confirm_password) {
            $message = "Konfirmasi password baru tidak cocok.";
            $message_type = 'error';
        } else {
            // Ambil password lama dari DB
            $q = $conn->query("SELECT password FROM users WHERE id=$user_id");
            $user = $q->fetch_assoc();
            
            if (password_verify($current_password, $user['password'])) {
                // Hash password baru
                $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
                $stmt->bind_param("si", $new_hash, $user_id);
                if ($stmt->execute()) {
                    $message = "Password berhasil diubah.";
                    $message_type = 'success';
                } else {
                    $message = "Gagal mengubah password.";
                    $message_type = 'error';
                }
            } else {
                $message = "Password saat ini salah.";
                $message_type = 'error';
            }
        }
    }
}

// AMBIL DATA USER
$q_user = $conn->query("SELECT * FROM users WHERE id=$user_id");
$user_data = $q_user->fetch_assoc();

include 'includes/admin_header.php';
?>

    <!-- Banner Ungu -->
    <div class="page-banner">
        <h1 class="banner-title">Pengaturan Profil</h1>
    </div>

    <?php if ($message): ?>
        <div class="alert alert-<?= $message_type ?> mb-4">
            <i class="fas <?= $message_type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle' ?>"></i>
            <?= $message ?>
        </div>
    <?php endif; ?>

    <div class="row" style="display: flex; gap: 20px; flex-wrap: wrap;">
        
        <!-- CARD 1: EDIT PROFIL -->
        <div class="card" style="flex: 1; min-width: 300px;">
            <div class="card-header">
                <h2 class="card-title"><i class="fas fa-user-edit"></i> Edit Data Diri</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label class="form-label required">Username</label>
                        <input type="text" name="username" class="form-input" value="<?= htmlspecialchars($user_data['username']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label required">Email</label>
                        <input type="email" name="email" class="form-input" value="<?= htmlspecialchars($user_data['email'] ?? '') ?>" required>
                    </div>
                    <button type="submit" name="update_profile" class="btn btn-primary w-full mt-4">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        <!-- CARD 2: GANTI PASSWORD -->
        <div class="card" style="flex: 1; min-width: 300px;">
            <div class="card-header">
                <h2 class="card-title text-warning"><i class="fas fa-lock"></i> Ganti Password</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label class="form-label required">Password Saat Ini</label>
                        <input type="password" name="current_password" class="form-input" placeholder="Masukkan password lama" required>
                    </div>
                    <hr class="mb-4" style="border-top: 1px dashed var(--gray-300);">
                    <div class="form-group">
                        <label class="form-label required">Password Baru</label>
                        <input type="password" name="new_password" class="form-input" placeholder="Masukkan password baru" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label required">Konfirmasi Password Baru</label>
                        <input type="password" name="confirm_password" class="form-input" placeholder="Ulangi password baru" required>
                    </div>
                    <button type="submit" name="change_password" class="btn btn-warning w-full" style="color:white;">
                        <i class="fas fa-key"></i> Perbarui Password
                    </button>
                </form>
            </div>
        </div>

    </div>

<?php include 'includes/admin_footer.php'; ?>

