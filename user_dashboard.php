<?php
session_start();
session_regenerate_id(true); // Mencegah session fixation attack
include 'config.php'; // Pastikan file koneksi database tersedia

// Periksa apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Simpan username dalam variabel
$username = htmlspecialchars($_SESSION['username']);

// Periksa apakah koneksi database tersedia
if (!isset($conn) || !$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Fungsi untuk menjalankan query dengan pengecekan error
function getData($conn, $query) {
    $result = mysqli_query($conn, $query);
    return $result ? mysqli_fetch_assoc($result) : ['total' => 0];
}

// Ambil data jumlah PKL dari data_pkl
$data_total_pkl = getData($conn, "SELECT COUNT(*) AS total_pkl FROM data_pkl");
$total_pkl = $data_total_pkl['total_pkl'] ?? 0;

// Ambil total pengajuan PKL dari pengajuan_pkl
$data_pengajuan = getData($conn, "SELECT COUNT(*) AS total_pengajuan FROM pengajuan_pkl");
$total_pengajuan = $data_pengajuan['total_pengajuan'] ?? 0;

// Ambil jumlah pengajuan PKL yang masih menunggu verifikasi
$data_menunggu = getData($conn, "SELECT COUNT(*) AS total_menunggu FROM pengajuan_pkl WHERE status = 'Menunggu'");
$total_menunggu = $data_menunggu['total_menunggu'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index.php" class="nav-link">Home</a>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light">Dashboard User</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="img-circle elevation-2" alt="User Image" width="35">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= strtoupper($username); ?></a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Profil</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="verifikasi_pengajuan.php" class="nav-link">
                            <i class="nav-icon fas fa-file"></i>
                            <p>Verifikasi Judul</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">SELAMAT DATANG, <?= strtoupper($username); ?>!</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Total Verifikasi Judul PKL -->
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?= $total_menunggu; ?></h3>
                                <p>Verifikasi Judul PKL</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file"></i>
                            </div>
                            <a href="verifikasi_pengajuan.php" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Daftar Pengajuan PKL -->
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $total_pengajuan; ?></h3>
                                <p>Daftar Pengajuan Judul PKL</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file"></i>
                            </div>
                            <a href="lihat_pengajuan.php" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="main-footer text-center">
        <strong>&copy; 2025 Diskominfo Kabupaten Cirebon.</strong> All rights reserved.
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
</body>
</html>
