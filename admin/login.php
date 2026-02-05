<?php
session_start();
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/database.php';
require_once '../config/constants.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $login_identifier = trim($_POST['login_identifier'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($login_identifier === '' || $password === '') {
        $error_message = "Username dan Password wajib diisi!";
    } else {

        $stmt = $conn->prepare(
            "SELECT id, username, password 
             FROM users 
             WHERE username = ? OR email = ?
             LIMIT 1"
        );

        if (!$stmt) {
            die("Query error: " . $conn->error);
        }

        $stmt->bind_param("ss", $login_identifier, $login_identifier);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header("Location: dashboard");
                exit;
            } else {
                $error_message = "Username atau Password salah!";
            }
        } else {
            $error_message = "Username atau Password salah!";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css?v=<?= time() ?>">
</head>
<body class="auth-body">

<div class="glass-box animate-fadeInUp">
    <div class="auth-header">
        <img src="<?= BASE_URL ?>/assets/img/pp.png" alt="Logo FIKOM" class="auth-logo">
        <h2>Login Admin</h2>
        <p>Masuk untuk mengelola website</p>
    </div>

    <?php if ($error_message): ?>
        <div class="message-box error">
            <i class="fas fa-exclamation-circle"></i>
            <span><?= $error_message ?></span>
        </div>
    <?php endif; ?>

    <form method="POST" class="auth-form">
        <div class="input-group">
            <input type="text" name="login_identifier" class="auth-input" placeholder="Username atau Email" required>
            <i class="fas fa-user input-icon"></i>
        </div>
        
        <div class="input-group">
            <input type="password" name="password" id="passwordInput" class="auth-input" placeholder="Password" required>
            <i class="fas fa-lock input-icon"></i>
            <i class="fas fa-eye toggle-password" id="togglePasswordIcon" onclick="togglePassword()"></i>
        </div>
        
        <div style="text-align: right; margin-bottom: 20px;">
            <a href="forgot_password" style="color: var(--primary-600); font-size: 0.9rem; text-decoration: none;">Lupa Kata Sandi?</a>
        </div>

        <button type="submit" class="auth-btn">
            Masuk <i class="fas fa-arrow-right"></i>
        </button>
    </form>

    <div class="auth-footer">
        <a href="../index"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('passwordInput');
    const toggleIcon = document.getElementById('togglePasswordIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>

</body>
</html>

