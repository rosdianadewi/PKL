<?php
session_start();
// Koneksi ke database
$host = 'localhost';
$user = 'root'; // Ganti dengan username database Anda
$pass = ''; // Ganti dengan password database Anda
$db = 'pkl';

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari tabel data_pkl
$sql = "SELECT * FROM data_pkl";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data PKL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

            <div class="container-fluid">
                <h1 class="mt-3">Kelola Data Peserta PKL</h1>
                <a href="add_pkl.php" class="btn btn-success mb-3">
                    <i class="fas fa-user-plus"></i> Tambah Data
                </a>
                <a href="admin_dashboard.php" class="btn btn-primary mb-3">
                    <i class="fa-solid fa-home"></i> Dashboard
                </a>
                
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Jenis Kelamin</th>
                            <th>Asal Universitas</th>
                            <th>Prodi</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id']) ?></td>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td><?= htmlspecialchars($row['nim']) ?></td>
                                    <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                                    <td><?= htmlspecialchars($row['asal_universitas']) ?></td>
                                    <td><?= htmlspecialchars($row['prodi']) ?></td>
                                    <td><?= htmlspecialchars($row['tanggal_mulai']) ?></td>
                                    <td><?= htmlspecialchars($row['tanggal_selesai']) ?></td>
                                    <td>
                                        <a href="edit_pkl.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                        <a href="delete_pkl.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data PKL tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbod
