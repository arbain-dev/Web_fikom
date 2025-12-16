<?php
// File: register.php (BARU - DENGAN PILIHAN ROLE)
// LOKASI: C:\xampp\htdocs\web_fikom\register.php

// Panggil file koneksi (asumsi ada di folder 'database')
require '../database/db_connect.php'; 
$message = '';
$message_type = '';       

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // <-- Input ROLE BARU dari dropdown

    // Validasi role (biar aman)
    $allowed_roles = ['admin', 'prodi_ti', 'prodi_pti', ];
    if (!in_array($role, $allowed_roles)) {
        $message_type = "error";
        $message = "Error: Role tidak valid!";
    } else {
        // Enkripsi password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Query SQL di-update untuk memasukkan ROLE
        $stmt = $conn->prepare("INSERT INTO users ( username, email, password, role) VALUES ( ?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            $message_type = "success";
            $message = "Pendaftaran user '{$username}' (sebagai {$role}) berhasil! Silakan <a href='login.php'>login</a>.";
        } else {
            $message_type = "error";
            if ($conn->errno == 1062) {
                $message = "Error: Username atau Email sudah dipakai!";
            } else {
                $message = "Error: " . $stmt->error;
            }
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* (CSS-nya masih sama persis) */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        /* Pastikan path background image benar (../img/a1.png jika file ini di /admin) */
        /* Jika file ini di /web_fikom/, pathnya 'img/a1.png' */
        body { display: flex; justify-content: center; align-items: center; min-height: 100vh; background: url('../img/a1.png') no-repeat; background-size: cover; background-position: center; }
        .wrapper { width: 400px; background: #fff; border-radius: 12px; padding: 30px 40px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); }
        .wrapper h1 { font-size: 32px; text-align: center; margin-bottom: 25px; color: #333; }
        .input-box { width: 100%; margin-bottom: 20px; }
        .input-box label { display: block; margin-bottom: 8px; font-weight: 500; color: #555; }
        /* Style untuk <select> disamakan dengan <input> */
        .input-box input, .input-box select { 
            width: 100%; height: 50px; background: #f7f7f7; 
            border: 1px solid #ddd; outline: none; border-radius: 8px; 
            font-size: 16px; color: #333; padding: 0 20px; 
        }
        .input-box input:focus, .input-box select:focus { border-color: #9D2235; }
        .btn { width: 100%; height: 50px; background: #9D2235; border: none; outline: none; border-radius: 8px; cursor: pointer; font-size: 16px; color: #fff; font-weight: 600; }
        .login-link { font-size: 14px; text-align: center; margin-top: 25px; color: #555; }
        .login-link a { color: #9D2235; text-decoration: none; font-weight: 600; }
        .message { margin-bottom: 15px; padding: 10px; border-radius: 8px; text-align: center; font-size: 0.9rem; }
        .message.success { color: #155724; background-color: #d4edda; border: 1px solid #c3e6cb; }
        .message.error { color: #c62828; background-color: #ffebee; border: 1px solid #ef9a9a; }
    </style>
</head>
<body>
    <div class="wrapper">
        <form action="register.php" method="POST">
            <h1>Daftar Akun</h1>
            
            <?php if (!empty($message)): ?>
                <div class="message <?= $message_type ?>"><?= $message ?></div>
            <?php endif; ?>

            <div class="input-box">
                <label for="username">Username</label>
                <input type="text" id="username" name="username"  required>
            </div>
            
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-box">
                <label for="role">Daftar sebagai:</label>
                <select name="role" id="role" required>
                    <option value="admin">Admin Utama</option>
                    <option value="prodi_ti">Admin Prodi TI</option>
                    <option value="prodi_pti">Admin Prodi PTI</option>
                </select>
            </div>
            <div class="input-box">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn">Daftar</button>

            <div class="login-link">
                <p>Sudah punya akun? <a href="login.php">Masuk di sini</a></p>
            </div>
        </form>
    </div>
</body>
</html>