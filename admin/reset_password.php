<?php
// File: reset_password.php (Dengan Debugging)

require '../config/database.php'; // Pastikan path ini benar!

$message = '';
$message_type = '';
$token_valid = false;
$token = '';

// 1. Ambil token dari URL dan bersihkan
if (isset($_GET['token'])) {
    $token = trim($_GET['token']);
    error_log("DEBUG: Token from URL = " . $token); // Log token dari URL

    if (!empty($token)) {
        // 2. Cek token di database
        $stmt = $conn->prepare("SELECT id, username, token_expiry FROM users WHERE reset_token = ?");
        
        if ($stmt === false) {
            error_log("Prepare failed (select token): " . $conn->error);
            $message_type = "error";
            $message = "Terjadi kesalahan pada sistem (1).";
        } else {
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                $expiry_time = strtotime($user['token_expiry']); // Ubah waktu expiry jadi timestamp
                $current_time = time(); // Waktu sekarang (timestamp)

                error_log("DEBUG: Token found for user ID: " . $user['id'] . ". Expiry: " . $user['token_expiry'] . ". Current Time: " . date("Y-m-d H:i:s", $current_time));

                // Cek apakah sudah kedaluwarsa
                if ($expiry_time > $current_time) {
                    $token_valid = true; // Token valid dan belum expired
                } else {
                    error_log("DEBUG: Token EXPIRED.");
                    $message_type = "error";
                    $message = "Link reset password sudah kedaluwarsa.";
                }
            } else {
                error_log("DEBUG: Token NOT FOUND in database.");
                $message_type = "error";
                $message = "Link reset password tidak valid."; // Pesan dibedakan
            }
            $stmt->close();
        }
    } else {
        error_log("DEBUG: Token is EMPTY.");
        $message_type = "error";
        $message = "Token reset password tidak boleh kosong.";
    }
} else {
    error_log("DEBUG: Token NOT PRESENT in URL.");
    $message_type = "error";
    $message = "Token reset password tidak ditemukan di URL.";
}

// 3. Proses form ganti password (HANYA JIKA TOKEN VALID)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $token_from_form = $_POST['token'] ?? ''; 
    
    // Cek ulang token validitas saat POST
    if ($token_from_form === $token && $token_valid) { 
        // ... (Logika validasi & update password tetap sama seperti sebelumnya) ...
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if (empty($password) || empty($confirm_password)) {
             $message_type = "error"; $message = "Password baru dan konfirmasi tidak boleh kosong!";
        } elseif ($password !== $confirm_password) {
            $message_type = "error"; $message = "Password dan Konfirmasi Password tidak cocok!";
        } elseif (strlen($password) < 6) {
             $message_type = "error"; $message = "Password minimal harus 6 karakter!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $update_stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE reset_token = ?");
            
            if ($update_stmt === false) {
                error_log("Prepare failed (update password): " . $conn->error);
                $message_type = "error"; $message = "Gagal menyiapkan pembaruan password.";
            } else {
                $update_stmt->bind_param("ss", $hashed_password, $token_from_form);
                if ($update_stmt->execute()) {
                    $message_type = "success"; $message = "Password berhasil diubah! Silakan <a href='login.php'>login</a>.";
                    $token_valid = false; 
                } else {
                    error_log("Execute failed (update password): " . $update_stmt->error);
                    $message_type = "error"; $message = "Gagal memperbarui password: " . $update_stmt->error;
                }
                $update_stmt->close();
            }
        }
    } else {
        error_log("DEBUG: POST request with invalid/mismatched token. Form Token: " . $token_from_form . ", URL Token: " . $token . ", Token Valid Flag: " . ($token_valid ? 'true':'false'));
        $message_type = "error";
        $message = "Sesi reset password tidak valid saat mencoba update. Silakan minta link reset baru.";
        $token_valid = false;
    }
}

// Tutup koneksi hanya jika belum ditutup
if (isset($conn) && $conn) {
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css?v=<?= time() ?>">
</head>
<body class="auth-body">
    <div class="glass-box animate-fadeInUp">
        <div class="auth-header">
            <h2>Buat Password Baru</h2>
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

        <form action="reset_password.php?token=<?= htmlspecialchars($token) ?>" method="POST" class="auth-form"> 
            
            <?php if ($token_valid): ?> 
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>"> 
                
                <div class="input-group">
                    <input type="password" id="password" name="password" class="auth-input" placeholder="Password Baru (min. 6 karakter)" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>
                
                <div class="input-group">
                    <input type="password" id="confirm_password" name="confirm_password" class="auth-input" placeholder="Konfirmasi Password Baru" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>
                
                <button type="submit" class="auth-btn">
                    Update Password <i class="fas fa-save" style="margin-left: 8px;"></i>
                </button>
            
            <?php elseif (!empty($message)): ?> 
                 <div class="auth-footer">
                    <?php if ($message_type == 'success'): ?>
                        <a href="login.php"><i class="fas fa-sign-in-alt"></i> Kembali ke Login</a>
                    <?php else: ?>
                        <a href="forgot_password.php"><i class="fas fa-redo"></i> Minta link reset baru</a>
                    <?php endif; ?>
                 </div>
            <?php endif; ?>

        </form>
    </div>
</body>
</html>
