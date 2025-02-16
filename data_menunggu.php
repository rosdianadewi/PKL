<?php
session_start();
include 'config.php'; // Pastikan file koneksi database tersedia

// Periksa apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Query untuk mengambil data pengajuan PKL yang berstatus "Menunggu"
$query = "SELECT * FROM pengajuan_pkl WHERE status = 'Menunggu'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengajuan Menunggu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Pengajuan PKL - Menunggu Verifikasi</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header bg-warning d-flex justify-content-between">
                        <h3 class="card-title">Daftar Pengajuan PKL Menunggu</h3>
                        <a href="mahasiswa_dashboard.php" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NIM</th>
                                    <th>Judul PKL</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$no}</td>";
                                    echo "<td>" . htmlspecialchars($row['nama_mahasiswa']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['judul_pkl']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['tanggal_pengajuan']) . "</td>";
                                    echo "<td>
                                            <a href='data_menunggu.php?id={$row['id']}' class='btn btn-primary btn-sm'>Verifikasi</a>
                                          </td>";
                                    echo "</tr>";
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
</body>
</html>
