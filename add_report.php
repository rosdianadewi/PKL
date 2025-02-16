<?php
session_start();
include 'config.php'; // Koneksi database

// Periksa koneksi database
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Proses form jika dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];
    $nama_peserta = mysqli_real_escape_string($conn, $_POST['nama_peserta']);

    $query = "INSERT INTO laporan_kegiatan (judul, deskripsi, tanggal, status, nama_peserta) VALUES ('$judul', '$deskripsi', '$tanggal', '$status', '$nama_peserta')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['pesan'] = "Laporan berhasil ditambahkan.";
    } else {
        $_SESSION['pesan'] = "Gagal menambahkan laporan.";
    }

    header("Location: report.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Laporan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php include 'sidebar.php'; ?>

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h1 class="mt-3">Tambah Laporan Kegiatan</h1>
                
                <form method="POST">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Pending">Pending</option>
                            <option value="Diproses">Diproses</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Peserta</label>
                        <input type="text" name="nama_peserta" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="report.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </section>
    </div>
</div>
</body>
</html>
