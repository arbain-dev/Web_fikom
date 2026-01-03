<?php
session_start();
require_once '../config/database.php';
require_once '../config/constants.php';

// Security check: Must have come from forgot_password verification
if (!isset($_SESSION['allow_reset_password']) || !isset($_SESSION['reset_user_id'])) {
    header("Location: login.php");
    exit;
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($password) || empty($confirm_password)) {
        $error = "Semua kolom wajib diisi.";
    } elseif ($password !== $confirm_password) {
        $error = "Konfirmasi password tidak cocok.";
    } elseif (strlen($password) < 6) {
         $error = "Password minimal 6 karakter.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $user_id = $_SESSION['reset_user_id'];

        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $user_id);
        
        if ($stmt->execute()) {
            // Clear session
            unset($_SESSION['allow_reset_password']);
            unset($_SESSION['reset_user_id']);
            
            // Redirect with success flag (or handle message on login page if query params supported)
            // For now, simpler to show a success page or redirect with a script alert? 
            // Better: Redirect to login and maybe login logic can show message? 
            // Current login.php doesn't handle success msgs from GET params well (only shows errors).
            // I will update login.php later or just assume user knows. 
            // Let's create a simple success view here before redirecting or show a link.
            $success = "Password berhasil diubah. Silakan login kembali using password baru.";
            // Auto redirect after 3 seconds
            header("refresh:3;url=login.php");
        } else {
            $error = "Terjadi kesalahan saat mengupdate password. Silakan coba lagi.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css?v=<?= time() ?>">
</head>
<body class="auth-body">

<div class="glass-box animate-fadeInUp">
    <div class="auth-header">
         <img src="<?= BASE_URL ?>/assets/img/pp.png" alt="Logo FIKOM" class="auth-logo">
        <h2>Buat Password Baru</h2>
        <p>Silakan masukkan password baru Anda.</p>
    </div>

    <?php if ($error): ?>
        <div class="message-box error">
            <i class="fas fa-exclamation-circle"></i> <span><?= htmlspecialchars($error) ?></span>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success" style="background:var(--success-50); color:var(--success-700); padding:1rem; border-radius:0.5rem; text-align:center;">
            <i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?>
            <p style="font-size:0.8rem; margin-top:5px;">Mengalihkan ke halaman login...</p>
        </div>
    <?php else: ?>

    <form method="POST" class="auth-form">
        <div class="input-group">
            <input type="password" name="password" id="newPassword" class="auth-input" placeholder="Password Baru" required>
            <i class="fas fa-lock input-icon"></i>
            <i class="fas fa-eye toggle-password" id="toggleNewPassword" onclick="togglePassword('newPassword', 'toggleNewPassword')"></i>
        </div>

         <div class="input-group">
            <input type="password" name="confirm_password" id="confirmPassword" class="auth-input" placeholder="Konfirmasi Password" required>
            <i class="fas fa-lock input-icon"></i>
            <i class="fas fa-eye toggle-password" id="toggleConfirmPassword" onclick="togglePassword('confirmPassword', 'toggleConfirmPassword')"></i>
        </div>
        
        <button type="submit" class="auth-btn">
            Ubah Password <i class="fas fa-save"></i>
        </button>
    </form>
    <?php endif; ?>

</div>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

</body>
</html>
