<?php
require '../config/database.php';
require '../config/constants.php';
$message = '';
$message_type = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    // 1. Cek dulu usernamenya ada atau tidak
    $stmt = $conn->prepare("SELECT email FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // 2. Jika user ada, buat token unik
        $token = bin2hex(random_bytes(32)); // Kode acak super aman
        $expiry = date("Y-m-d H:i:s", time() + 3600); // Token berlaku 1 jam

        // 3. Simpan token ini ke database
        $update_stmt = $conn->prepare("UPDATE users SET reset_token = ?, token_expiry = ? WHERE username = ?");
        $update_stmt->bind_param("sss", $token, $expiry, $username);
        $update_stmt->execute();

        // 4. (SIMULASI) Tampilkan link reset di layar
        $reset_link = BASE_URL . "/admin/reset_password.php?token=" . $token;
        $message_type = "success";
        $message = "<strong>(PURA-PURANYA DIKIRIM KE EMAIL)</strong><br>Klik link ini untuk reset password:<br><a href='$reset_link' style='word-wrap:break-word;'>$reset_link</a>";

    } else {
        // Demi keamanan, kita kasih pesan yang sama
        $message_type = "success";
        $message = "Jika username terdaftar, link reset password telah dikirim.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css?v=<?= time() ?>">
</head>
<body class="auth-body">
    <div class="glass-box animate-fadeInUp">
        <div class="auth-header">
            <h2>Lupa Password</h2>
            <p>Masukkan username Anda untuk mereset password</p>
        </div>

        <?php if (!empty($message)): ?>
            <div class="message-box <?= $message_type ?>">
                <?php if ($message_type === 'success'): ?>
                    <i class="fas fa-check-circle"></i>
                <?php else: ?>
                    <i class="fas fa-exclamation-circle"></i>
                <?php endif; ?>
                <span><?= $message ?></span>
            </div>
        <?php endif; ?>

        <form action="forgot_password.php" method="POST" class="auth-form">
            <div class="input-group">
                <input type="text" id="username" name="username" class="auth-input" placeholder="Masukkan Username" required>
                <i class="fas fa-user input-icon"></i>
            </div>
            
            <button type="submit" class="auth-btn">
                Kirim Link Reset <i class="fas fa-paper-plane" style="margin-left: 8px;"></i>
            </button>
        </form>

        <div class="auth-footer">
            <a href="login.php"><i class="fas fa-arrow-left" style="margin-right: 5px;"></i> Kembali ke Login</a>
        </div>
    </div>
</body>
</html>
