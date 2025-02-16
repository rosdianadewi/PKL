<?php
session_start();
include 'config.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $asal_universitas = $_POST['asal_universitas'];
    $prodi = $_POST['prodi'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];

    // Menggunakan Prepared Statement
    $query = "INSERT INTO data_pkl (nama, nim, jenis_kelamin, asal_universitas, prodi, tanggal_mulai, tanggal_selesai) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssss", $nama, $nim, $jenis_kelamin, $asal_universitas, $prodi, $tanggal_mulai, $tanggal_selesai);

    if ($stmt->execute()) {
        header("Location: data_pkl.php");
        exit();
    } else {
        echo "<script>alert('Gagal menyimpan data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Peserta PKL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Tambah Data Peserta PKL</h2>
    <form method="POST">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label>NIM:</label>
            <input type="text" name="nim" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Jenis Kelamin:</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label>Asal Universitas:</label>
            <input type="text" name="asal_universitas" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Prodi:</label>
            <input type="text" name="prodi" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Mulai:</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Selesai:</label>
            <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="data_pkl.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>
