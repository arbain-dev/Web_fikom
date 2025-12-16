<?php
// File: reset_password.php (Dengan Debugging)

require '../database/db_connect.php'; // Pastikan path ini benar!

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
    <style>
        /* (CSS masih sama persis, tidak perlu diubah) */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { display: flex; justify-content: center; align-items: center; min-height: 100vh; background: url('img/a1.png') no-repeat; background-size: cover; background-position: center; }
        .wrapper { width: 400px; background: #fff; border-radius: 12px; padding: 30px 40px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); }
        .wrapper h1 { font-size: 32px; text-align: center; margin-bottom: 25px; color: #333; }
        .input-box { width: 100%; margin-bottom: 20px; }
        .input-box label { display: block; margin-bottom: 8px; font-weight: 500; color: #555; }
        .input-box input { width: 100%; height: 50px; background: #f7f7f7; border: 1px solid #ddd; outline: none; border-radius: 8px; font-size: 16px; color: #333; padding: 0 20px; }
        .input-box input:focus { border-color: #9D2235; }
        .btn { width: 100%; height: 50px; background: #9D2235; border: none; outline: none; border-radius: 8px; cursor: pointer; font-size: 16px; color: #fff; font-weight: 600; }
        .message { margin-bottom: 15px; padding: 10px; border-radius: 8px; text-align: center; font-size: 0.9rem; }
        .message.success { color: #155724; background-color: #d4edda; border: 1px solid #c3e6cb; }
        .message.error { color: #c62828; background-color: #ffebee; border: 1px solid #ef9a9a;}
        .login-link { font-size: 14px; text-align: center; margin-top: 25px; color: #555; }
        .login-link a { color: #9D2235; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="wrapper">
        <form action="reset_password.php?token=<?= htmlspecialchars($token) ?>" method="POST"> 
            <h1>Buat Password Baru</h1>
            
            <?php if (!empty($message)): ?>
                <div class="message <?= $message_type ?>"><?= $message ?></div>
            <?php endif; ?>

            <?php if ($token_valid): ?> 
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>"> 
                
                <div class="input-box">
                    <label for="password">Password Baru (min. 6 karakter)</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-box">
                    <label for="confirm_password">Konfirmasi Password Baru</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                
                <button type="submit" class="btn">Update Password</button>
            
            <?php elseif (!empty($message)): ?> 
                 <div class="login-link">
                    <?php if ($message_type == 'success'): ?>
                        <p><a href="login.php">Kembali ke Login</a></p>
                    <?php else: ?>
                        <p><a href="forgot_password.php">Minta link reset baru</a></p>
                    <?php endif; ?>
                 </div>
            <?php endif; ?>

        </form>
    </div>
</body>
</html>