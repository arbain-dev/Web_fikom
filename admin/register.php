// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../config/database.php';
require_once '../config/constants.php';

$message = '';
$message_type = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $email === '' || $password === '') {
        $message_type = "error";
        $message = "Semua field wajib diisi!";
    } else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO users (username, email, password) VALUES (?, ?, ?)"
        );

        if (!$stmt) {
            die("Query error: " . $conn->error);
        }

        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $message_type = "success";
            $message = "Akun admin berhasil dibuat. Silakan login.";
        } else {
            $message_type = "error";
            $message = ($conn->errno == 1062)
                ? "Username atau Email sudah digunakan!"
                : $stmt->error;
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
<title>Register Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css?v=<?= time() ?>">
</head>
<body class="auth-body">

<div class="glass-box animate-fadeInUp">
    <div class="auth-header">
        <img src="<?= BASE_URL ?>/assets/img/pp.png" alt="Logo FIKOM" style="width: 80px; display: block; margin: 0 auto 20px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));">
        <h2>Register Admin</h2>
        <p>Buat akun baru untuk akses admin</p>
    </div>

    <?php if ($message): ?>
        <div class="message-box <?= $message_type ?>">
            <?php if ($message_type === 'success'): ?>
                <i class="fas fa-check-circle"></i>
            <?php else: ?>
                <i class="fas fa-exclamation-circle"></i>
            <?php endif; ?>
            <span><?= $message ?></span>
            
            <?php if ($message_type === 'success'): ?>
                <br><br>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="auth-form">
        <div class="input-group">
            <input type="text" name="username" class="auth-input" placeholder="Username" required>
            <i class="fas fa-user input-icon"></i>
        </div>
        
        <div class="input-group">
            <input type="email" name="email" class="auth-input" placeholder="Email" required>
            <i class="fas fa-envelope input-icon"></i>
        </div>
        
        <div class="input-group">
            <input type="password" name="password" class="auth-input" placeholder="Password" required>
            <i class="fas fa-lock input-icon"></i>
        </div>
        
        <button type="submit" class="auth-btn">
            Daftar Admin <i class="fas fa-user-plus" style="margin-left: 8px;"></i>
        </button>
    </form>

    <div class="auth-footer">
        <a href="login.php"><i class="fas fa-sign-in-alt"></i> Kembali ke Login</a>
    </div>
</div>

</body>
</html>
