<?php
// File: proses_login.php
// LOKASI: C:\xampp\htdocs\web_fikom\proses_login.php

// 1. TAMPILKAN ERROR
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. MULAI SESSION
session_start();

// 3. KONEKSI KE DATABASE (PERBAIKANNYA DI SINI)
// Panggil file koneksi.php yang ada di folder yang sama
// require_once '../database/db_connect.php'; 

// 4. CEK JIKA FORM SUDAH DI-SUBMIT
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 5. AMBIL DATA DARI FORM
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role     = $_POST['role'];

    // 6. VALIDASI DASAR (Cek jika ada yang kosong)
    if (empty($username) || empty($password) || empty($role)) {
        header("location: login.php?status=kosong");
        exit;
    }

    // 7. TENTUKAN PENGATURAN BERDASARKAN ROLE
    // GANTI NAMA TABEL & KOLOM DI BAWAH INI SESUAI DATABASE ANDA
    $tabel       = "";
    $kolom_user  = "";
    $kolom_pass  = "password"; // Biasanya nama kolom password sama
    $dashboard   = "";

    if ($role == 'admin') {
        $tabel       = "tb_admin";
        $kolom_user  = "username"; // Kolom untuk username admin
        $dashboard   = "dashboard_admin.php"; // Halaman dashboard admin
    } elseif ($role == 'dosen') {
        $tabel       = "tb_dosen";
        $kolom_user  = "nidn";     // Kolom untuk NIDN dosen
        $dashboard   = "dashboard_dosen.php"; // Halaman dashboard dosen
    } elseif ($role == 'mahasiswa') {
        $tabel       = "tb_mahasiswa";
        $kolom_user  = "nim";      // Kolom untuk NIM mahasiswa
        $dashboard   = "dashboard_mahasiswa.php"; // Halaman dashboard mhs
    } else {
        header("location: login.php?status=gagal");
        exit;
    }

    // 8. PROSES LOGIN (Menggunakan Prepared Statements)
    try {
        // Query untuk mencari user
        $sql = "SELECT * FROM $tabel WHERE $kolom_user = ?";
        $stmt = $koneksi->prepare($sql);

        if ($stmt === false) {
             die("Error: Gagal mempersiapkan query. Cek nama tabel '$tabel' atau kolom '$kolom_user'.");
        }
        
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // 9. CEK APAKAH USER DITEMUKAN
        if ($result->num_rows === 1) {
            $data = $result->fetch_assoc();

            // 10. VERIFIKASI PASSWORD
            // Pastikan password di database kamu di-HASH pakai password_hash()
            if (password_verify($password, $data[$kolom_pass])) {
                
                // --- LOGIN BERHASIL ---
                $_SESSION['login']    = true;
                $_SESSION['user_id']  = $data['id']; // Simpan ID user
                $_SESSION['username'] = $data[$kolom_user];
                $_SESSION['role']     = $role;
                
                // Arahkan ke dashboard yang sesuai
                header("location: $dashboard");
                exit;
                
            } else {
                // Password salah
                header("location: login.php?status=gagal");
                exit;
            }

        } else {
            // User tidak ditemukan
            header("location: login.php?status=gagal");
            exit;
        }

        $stmt->close();
        $koneksi->close();

    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }

} else {
    // Jika file diakses langsung (bukan via POST)
    // header("location: login.php");
    exit;
}
?>