<?php
require '../database/db_connect.php';
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
        $reset_link = "http://localhost/web_fikom/reset_password.php?token=" . $token;
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
    <style>
        /* (Saya pakai style yang sama dengan login.php biar konsisten) */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { display: flex; justify-content: center; align-items: center; min-height: 100vh; background: url('img/a1.png') no-repeat; background-size: cover; background-position: center; }
        .wrapper { width: 400px; background: #fff; border-radius: 12px; padding: 30px 40px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); }
        .wrapper h1 { font-size: 32px; text-align: center; margin-bottom: 25px; color: #333; }
        .input-box { width: 100%; margin-bottom: 20px; }
        .input-box label { display: block; margin-bottom: 8px; font-weight: 500; color: #555; }
        .input-box input { width: 100%; height: 50px; background: #f7f7f7; border: 1px solid #ddd; outline: none; border-radius: 8px; font-size: 16px; color: #333; padding: 0 20px; }
        .input-box input:focus { border-color: #9D2235; }
        .btn { width: 100%; height: 50px; background: #9D2235; border: none; outline: none; border-radius: 8px; cursor: pointer; font-size: 16px; color: #fff; font-weight: 600; }
        .login-link { font-size: 14px; text-align: center; margin-top: 25px; color: #555; }
        .login-link a { color: #9D2235; text-decoration: none; font-weight: 600; }
        .message { margin-bottom: 15px; padding: 10px; border-radius: 8px; text-align: center; font-size: 0.9rem; }
        .message.success { color: #155724; background-color: #d4edda; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>
    <div class="wrapper">
        <form action="forgot_password.php" method="POST">
            <h1>Lupa Password</h1>
            
            <?php if (!empty($message)): ?>
                <div class="message <?= $message_type ?>"><?= $message ?></div>
            <?php endif; ?>

            <div class="input-box">
                <label for="username">Masukkan Username Anda</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <button type="submit" class="btn">Kirim Link Reset</button>

            <div class="login-link">
                <p><a href="login.php">Kembali ke Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>