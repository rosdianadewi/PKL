<?php
session_start();
include 'config.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Debug: Periksa koneksi database
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Query untuk mengambil data user berdasarkan username
    $sql = "SELECT user_id, username, password, role FROM user_profile WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error dalam query SQL: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah username ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Cek apakah password sesuai (jika di-hash, gunakan password_verify)
        if (password_verify($password, $row['password'])) { 
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['last_activity'] = time(); // Simpan waktu login

            // Debug: Pastikan user_id tidak NULL
            if (empty($_SESSION['user_id'])) {
                die("Error: user_id NULL. Periksa database!");
            }

            // Redirect berdasarkan role
            switch ($row['role']) {
                case 'admin1':
                case 'admin2':
                    header("Location: admin_dashboard.php");
                    break;
                case 'user1':
                case 'user2':
                    header("Location: user_dashboard.php");
                    break;
                case 'mahasiswa':
                    header("Location: mahasiswa_dashboard.php");
                    break;
                default:
                    echo "<script>alert('Role tidak valid!'); window.location.href='login.php';</script>";
                    exit();
            }
            exit();
        } else {
            echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location.href='login.php';</script>";
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Sistem PKL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>Si-PKL</b>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Masukkan Username dan Password</p>
            <form action="login.php" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
</body>
</html>
