<?php
session_start();
include 'config.php'; // Pastikan file koneksi database ada

// Periksa apakah koneksi database tersedia
if (!isset($conn) || !$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Ambil data pengajuan PKL yang statusnya "Ditolak"
$query_ditolak = "SELECT * FROM pengajuan_pkl WHERE status = 'Ditolak'";
$result_ditolak = mysqli_query($conn, $query_ditolak);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengajuan PKL Ditolak</title>
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
                        <h1 class="m-0">Data Pengajuan PKL Ditolak</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header bg-danger text-white d-flex justify-content-between">
                        <h3 class="card-title">Daftar Pengajuan yang Ditolak</h3>
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
                                    <th>Alasan Penolakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result_ditolak)) { ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row['nama_mahasiswa']); ?></td>
                                        <td><?= htmlspecialchars($row['nim']); ?></td>
                                        <td><?= htmlspecialchars($row['judul_pkl']); ?></td>
                                        <td><?= htmlspecialchars($row['tanggal_pengajuan']); ?></td>
                                        <td><?= htmlspecialchars($row['alasan_penolakan']); ?></td>
                                    </tr>
                                <?php } ?>
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
