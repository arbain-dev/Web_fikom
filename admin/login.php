<?php
// File: login.php (Login Utama - SUDAH DIPERBAIKI)
// LOKASI: C:\xampp\htdocs\web_fikom\login.php

// 1. Mulai session
session_start();
    
// 2. Panggil file koneksi database
// (Pastikan path ini benar, sesuai lokasi file db_connect.php kamu)
require '../database/db_connect.php'; 

$error_message = '';

// Cek jika ada status error dari proses sebelumnya
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'gagal') {
        $error_message = 'Username atau Password salah!';
    } elseif ($_GET['status'] == 'kosong') {
        $error_message = 'Username dan Password tidak boleh kosong!';
    } elseif ($_GET['status'] == 'gagal_role') {
        $error_message = 'Anda tidak punya hak akses ke halaman tersebut!';
    }
}

// 3. Cek form login manual
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil input (bisa username atau email)
    $login_identifier = $_POST['login_identifier']; 
    $password = $_POST['password'];

    // Validasi dasar
    if (empty($login_identifier) || empty($password)) {
        header("Location: login.php?status=kosong");
        exit;
    }

    // 4. Siapkan statement SQL
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?"); 
    
    if ($stmt === false) {
        die("Error prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("ss", $login_identifier, $login_identifier); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // 5. VERIFIKASI PASSWORD
        if (password_verify($password, $user['password'])) {
            
            // --- LOGIN BERHASIL ---
            // Simpan semua data penting ke session
            $_SESSION['login_sukses'] = true; // Session login umum
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nama'] = $user['nama_lengkap'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Ini yang paling penting

            // 6. ALIHKAN HALAMAN BERDASARKAN ROLE
            switch ($user['role']) {
                case 'admin':
                    // Jika rolenya 'admin', lempar ke dashboard admin
                    $_SESSION['admin_logged_in'] = true; // Session khusus admin
                    header("Location: ../admin/dashboard.php");
                    break;
                
                case 'prodi_ti':
                case 'prodi_pti':
                    // Jika rolenya 'prodi_ti' ATAU 'prodi_pti'
                    $_SESSION['prodi_logged_in'] = true; // Session khusus prodi
                    // Simpan nama prodi biar bisa tampil di dashboard prodi
                    $_SESSION['prodi_nama'] = ($user['role'] == 'prodi_ti') ? 'Informatika' : 'Pendidikan Teknik Informasi';
                    header("Location: ../admin/prodi_dashboard.php");
                    break;
                
                case 'mahasiswa':
                default:
                    // Jika rolenya 'mahasiswa' atau role lain
                    header("Location: index.php"); // Lempar ke Halaman Depan
            }
            exit; // Stop script setelah redirect

        } else {
            // Password salah
            $error_message = 'Username/Email atau Password salah!';
        }
    } else {
        // Username/Email tidak ditemukan
        $error_message = 'Username/Email atau Password salah!';
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
    <title>Login Utama</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* (CSS masih sama persis, tidak perlu diubah) */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            background: url('../img/a1.png') no-repeat; 
            background-size: cover; 
            background-position: center; 
        }
        .wrapper { width: 400px; background: #fff; border-radius: 12px; padding: 30px 40px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); }
        .wrapper h1 { font-size: 32px; text-align: center; margin-bottom: 25px; color: #333; }
        .input-box { width: 100%; margin-bottom: 20px; }
        .input-box label { display: block; margin-bottom: 8px; font-weight: 500; color: #555; }
        .input-box input { width: 100%; height: 50px; background: #f7f7f7; border: 1px solid #ddd; outline: none; border-radius: 8px; font-size: 16px; color: #333; padding: 0 20px; }
        .input-box input:focus { border-color: #9D2235; }
        .forgot-pass { text-align: right; margin-top: -10px; margin-bottom: 20px; }
        .forgot-pass a { font-size: 14px; color: #9D2235; text-decoration: none; }
        .forgot-pass a:hover { text-decoration: underline; }
        .btn { width: 100%; height: 50px; background: #9D2235; border: none; outline: none; border-radius: 8px; cursor: pointer; font-size: 16px; color: #fff; font-weight: 600; }
        .btn:hover { background: #800000; }
        .register-link { font-size: 14px; text-align: center; margin-top: 25px; color: #555; }
        .register-link a { color: #9D2235; text-decoration: none; font-weight: 600; }
        .register-link a:hover { text-decoration: underline; }
        .error-message { margin-top: 15px; color: #c62828; background-color: #ffebee; padding: 10px; border-radius: 8px; text-align: center; font-size: 0.9rem; border: 1px solid #ef9a9a;}
    </style>
</head>
<body>
    <div class="wrapper">
        <form action="login.php" method="POST">
            <h1>Masuk</h1>
            
            <?php if (!empty($error_message)): ?>
                <div class="error-message"><?= htmlspecialchars($error_message) ?></div>
            <?php endif; ?>

            <div class="input-box">
                <label for="login_identifier">Username atau Email</label>
                <input type="text" id="login_identifier" name="login_identifier" required> 
            </div>
            
            <div class="input-box">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="forgot-pass">
                <a href="forgot_password.php">Lupa Kata Sandi?</a>
            </div>

            <button type="submit" class="btn">Masuk</button>

            <!-- <div class="register-link">
                <p>Belum punya akun?     <a href="register.php"> Beranda </a></p>
            </div> -->

            </form>
    </div>
</body>
</html>