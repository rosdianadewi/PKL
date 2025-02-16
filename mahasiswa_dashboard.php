<?php
session_start();
include 'config.php';

// Periksa koneksi database
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Periksa sesi pengguna
$nama_user = isset($_SESSION['nama_user']) ? htmlspecialchars($_SESSION['nama_user']) : "Mahasiswa";

// Ambil data jumlah PKL dari data_pkl
$query_total_pkl = "SELECT COUNT(*) AS total_pkl FROM data_pkl";
$result_total_pkl = mysqli_query($conn, $query_total_pkl);
$total_pkl = ($result_total_pkl && mysqli_num_rows($result_total_pkl) > 0) ? mysqli_fetch_assoc($result_total_pkl)['total_pkl'] : 0;

// Ambil data jumlah PKL yang Disetujui
$query_disetujui = "SELECT COUNT(*) AS total_disetujui FROM pengajuan_pkl WHERE status = 'Disetujui'";
$result_disetujui = mysqli_query($conn, $query_disetujui);
$total_disetujui = ($result_disetujui && mysqli_num_rows($result_disetujui) > 0) ? mysqli_fetch_assoc($result_disetujui)['total_disetujui'] : 0;

// Ambil data jumlah PKL yang Ditolak
$query_ditolak = "SELECT COUNT(*) AS total_ditolak FROM pengajuan_pkl WHERE status = 'Ditolak'";
$result_ditolak = mysqli_query($conn, $query_ditolak);
$total_ditolak = ($result_ditolak && mysqli_num_rows($result_ditolak) > 0) ? mysqli_fetch_assoc($result_ditolak)['total_ditolak'] : 0;

// Ambil total pengajuan PKL yang masih Menunggu
$query_pengajuan = "SELECT COUNT(*) AS total_pengajuan FROM pengajuan_pkl WHERE status = 'Menunggu'";
$result_pengajuan = mysqli_query($conn, $query_pengajuan);
$total_pengajuan = ($result_pengajuan && mysqli_num_rows($result_pengajuan) > 0) ? mysqli_fetch_assoc($result_pengajuan)['total_pengajuan'] : 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index.php" class="nav-link">Home</a>
            </li>
        </ul>
    </nav>
    
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light">Dashboard Mahasiswa</span>
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
                <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
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
                        <a href="pengajuan_pkl.php" class="nav-link">
                            <i class="nav-icon fas fa-upload"></i>
                            <p>Pengajuan PKL</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="report.php" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Laporan PKL</p>
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
                        <h1 class="m-0">SELAMAT DATANG, <?= strtoupper($nama_user); ?>!</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <?php
                    $dataBoxes = [
                        ['bg' => 'info', 'total' => $total_pkl, 'text' => 'Form Pengajuan PKL', 'icon' => 'fas fa-upload', 'link' => 'pengajuan_pkl.php'],
                        ['bg' => 'success', 'total' => $total_disetujui, 'text' => 'Judul PKL Disetujui', 'icon' => 'fas fa-check-circle', 'link' => 'data_disetujui.php'],
                        ['bg' => 'danger', 'total' => $total_ditolak, 'text' => 'Judul PKL Ditolak', 'icon' => 'fas fa-times-circle', 'link' => 'data_ditolak.php'],
                        ['bg' => 'primary', 'total' => $total_pengajuan, 'text' => 'Judul PKL Menunggu Respon', 'icon' => 'fas fa-file', 'link' => 'data_menunggu.php']
                    ];
                    
                    foreach ($dataBoxes as $box) {
                        echo "
                        <div class='col-lg-4 col-6'>
                            <div class='small-box bg-{$box['bg']}'>
                                <div class='inner'>
                                    <h3>{$box['total']}</h3>
                                    <p>{$box['text']}</p>
                                </div>
                                <div class='icon'>
                                    <i class='{$box['icon']}'></i>
                                </div>
                                <a href='{$box['link']}' class='small-box-footer'>Lihat Detail <i class='fas fa-arrow-circle-right'></i></a>
                            </div>
                        </div>";
                    }
                    ?>
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

<?php
// Tutup koneksi database
mysqli_close($conn);
?>
