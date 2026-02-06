<?php
session_start();
require_once '../config/database.php';
require_once '../config/constants.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $identifier = trim($_POST['identifier'] ?? '');

    if (empty($identifier)) {
        $error = "Silakan masukkan username atau email.";
    } else {
        $stmt = $conn->prepare("SELECT id, username FROM users WHERE username = ? OR email = ? LIMIT 1");
        $stmt->bind_param("ss", $identifier, $identifier);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Dalam aplikasi produksi nyata, kita akan membuat token unik, menyimpannya ke DB, dan mengirimkannya melalui email.
            // Untuk lingkungan/permintaan lokal ini, kami akan mensimulasikan verifikasi dan mengizinkan reset segera.
            $_SESSION['allow_reset_password'] = true;
            $_SESSION['reset_user_id'] = $user['id'];
            
            // Arahkan ke formulir reset
            header("Location: reset_password");
            exit;
        } else {
            $error = "Data tidak ditemukan.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Kata Sandi - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css?v=<?= time() ?>">
</head>
<body class="auth-body">

<div class="glass-box animate-fadeInUp">
    <div class="auth-header">
         <img src="<?= BASE_URL ?>/assets/img/pp.png" alt="Logo FIKOM" class="auth-logo">
        <h2>Lupa Kata Sandi?</h2>
        <p>Masukkan username atau email Anda untuk mereset kata sandi.</p>
    </div>

    <?php if ($error): ?>
        <div class="message-box error">
            <i class="fas fa-exclamation-circle"></i> <span><?= htmlspecialchars($error) ?></span>
        </div>
    <?php endif; ?>

    <form method="POST" class="auth-form">
        <div class="input-group">
            <input type="text" name="identifier" class="auth-input" placeholder="Username atau Email" required>
            <i class="fas fa-user input-icon"></i>
        </div>
        
        <button type="submit" class="auth-btn">
            Verifikasi Akun <i class="fas fa-arrow-right"></i>
        </button>
    </form>

    <div class="auth-footer">
        <a href="login"><i class="fas fa-arrow-left"></i> Kembali ke Login</a>
    </div>
</div>

</body>
</html>

