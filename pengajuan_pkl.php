<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $judul = $_POST['judul'];
    $tanggal = date("Y-m-d");

    $query = "INSERT INTO pengajuan_pkl (nama_mahasiswa, nim, judul_pkl, tanggal_pengajuan) 
              VALUES ('$nama', '$nim', '$judul', '$tanggal')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pengajuan PKL berhasil!'); window.location='pengajuan_pkl.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pengajuan PKL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
</head>
<body>
    <div class="container mt-5">
    <a href="mahasiswa_dashboard.php" class="btn btn-primary mb-3">
        <i class="fa-solid fa-home"></i> Dashboard </a>
        <h2>Form Pengajuan PKL</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label>Nama Mahasiswa</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="nim" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Judul PKL</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajukan</button>
        </form>
    </div>
</body>
</html>
