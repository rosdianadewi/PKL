<?php
session_start();
include 'config.php'; // Koneksi database

// Ambil semua data pengajuan PKL
$query = "SELECT * FROM pengajuan_pkl ORDER BY tanggal_pengajuan DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengajuan PKL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">Daftar Pengajuan Judul PKL</h1>

                <!-- Tombol Kembali ke Dashboard -->
                <a href="user_dashboard.php" class="btn btn-secondary mb-3">
                    🔙 Kembali ke Dashboard
                </a>

                <div class="card">
                    <div class="card-header bg-primary text-white">Data Pengajuan</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Mahasiswa</th>
                                    <th>NIM</th>
                                    <th>Judul PKL</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status</th>
                                    <th>Alasan Penolakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['nama_mahasiswa']); ?></td>
                                        <td><?= htmlspecialchars($row['nim']); ?></td>
                                        <td><?= htmlspecialchars($row['judul_pkl']); ?></td>
                                        <td><?= htmlspecialchars($row['tanggal_pengajuan']); ?></td>
                                        <td>
                                            <?php if ($row['status'] == 'Menunggu'): ?>
                                                <span class="badge badge-warning">Menunggu</span>
                                            <?php elseif ($row['status'] == 'Disetujui'): ?>
                                                <span class="badge badge-success">Disetujui</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Ditolak</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $row['alasan_penolakan'] ? htmlspecialchars($row['alasan_penolakan']) : '-'; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
</body>
</html>
