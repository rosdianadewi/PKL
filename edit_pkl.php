<?php
session_start();
include 'config.php'; // Pastikan file koneksi sesuai

// Validasi ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = "SELECT * FROM data_pkl WHERE id = $id";
$result = mysqli_query($conn, $query);

// Cek apakah data ditemukan
if (mysqli_num_rows($result) == 0) {
    die("Data tidak ditemukan!");
}

$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $asal_universitas = $_POST['asal_universitas'];
    $prodi = $_POST['prodi'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];

    // Query Update Data
    $query = "UPDATE data_pkl SET 
              nama='$nama', nim='$nim', jenis_kelamin='$jenis_kelamin', 
              asal_universitas='$asal_universitas', prodi='$prodi', 
              tanggal_mulai='$tanggal_mulai', tanggal_selesai='$tanggal_selesai' 
              WHERE id=$id";

    if (mysqli_query($conn, $query)) {
        header("Location: data_pkl.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data PKL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

</head>
<body>
<body>
<div class="wrapper">
    <?php include 'sidebar.php'; ?>

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h1 class="mt-3">Edit Data Peserta PKL</h1>
    <form method="POST">
        Nama: <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required><br>
        NIM: <input type="text" name="nim" value="<?= htmlspecialchars($data['nim']); ?>" required><br>
        Jenis Kelamin:
        <select name="jenis_kelamin">
            <option value="laki-laki" <?= ($data['jenis_kelamin'] == 'laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
            <option value="perempuan" <?= ($data['jenis_kelamin'] == 'perempuan') ? 'selected' : ''; ?>>Perempuan</option>
        </select><br>
        Asal Universitas: <input type="text" name="asal_universitas" value="<?= htmlspecialchars($data['asal_universitas']); ?>" required><br>
        Prodi: <input type="text" name="prodi" value="<?= htmlspecialchars($data['prodi']); ?>" required><br>
        Tanggal Mulai: <input type="date" name="tanggal_mulai" value="<?= $data['tanggal_mulai']; ?>" required><br>
        Tanggal Selesai: <input type="date" name="tanggal_selesai" value="<?= $data['tanggal_selesai']; ?>" required><br>
        <button type="submit" name="submit">Update</button>
    </form>
</body>
</html>
