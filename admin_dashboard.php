<?php
session_start();
include 'config.php'; // Koneksi ke database

// Periksa apakah user sudah login
if (!isset($_SESSION['nama_user'])) {
    $_SESSION['nama_user'] = "Administrator"; // Nama default jika sesi tidak tersedia
}

$nama_user = $_SESSION['nama_user'];
$role = isset($_SESSION['role']) ? $_SESSION['role'] : "user";

// Menampilkan pesan selamat datang sesuai dengan peran
$welcome_message = ($role == "admin") ? "<h1>SELAMAT DATANG ADMIN</h1>" : "<h1>SELAMAT DATANG $nama_user</h1>";

// Mengambil data jumlah pengguna, data PKL, dan laporan dari database
$total_pengguna = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];
$total_pkl = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM data_pkl"))['total'];
$total_laporan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM laporan_kegiatan"))['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- AdminLTE CSS -->
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
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light">Dashboard Admin</span>
        </a>
        <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="img-circle elevation-2" alt="User Image" width="35">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= strtoupper($nama_user); ?></a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
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
                        <a href="manage_users.php" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Kelola Pengguna</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="data_pkl.php" class="nav-link">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>Data PKL</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="report.php" class="nav-link">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>Laporan</p>
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
                        <?php echo $welcome_message; ?>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo $total_pengguna; ?></h3>
                                <p>Total Pengguna</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="manage_users.php" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo $total_pkl; ?></h3>
                                <p>Data PKL</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-folder"></i>
                            </div>
                            <a href="data_pkl.php" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo $total_laporan; ?></h3>
                                <p>Laporan Baru</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <a href="report.php" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
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

<!-- AdminLTE Scripts -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
</body>
</html>
