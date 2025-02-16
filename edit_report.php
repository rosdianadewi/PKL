<?php
session_start();
include 'config.php';

// Pastikan pengguna masuk sebelum mengakses halaman ini
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Pastikan ada ID yang dikirim
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['pesan'] = "ID laporan tidak valid.";
    header("Location: report.php");
    exit();
}

$id = intval($_GET['id']);

// Ambil data laporan dari database
$query = "SELECT * FROM laporan_kegiatan WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$laporan = $result->fetch_assoc();

if (!$laporan) {
    $_SESSION['pesan'] = "Laporan tidak ditemukan.";
    header("Location: report.php");
    exit();
}

// Jika form dikirim (Update laporan)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = trim($_POST['judul']);
    $deskripsi = trim($_POST['deskripsi']);
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    // Validasi input kosong
    if (empty($judul) || empty($deskripsi) || empty($tanggal) || empty($status)) {
        $_SESSION['pesan'] = "Semua kolom harus diisi.";
    } else {
        // Update ke database
        $updateQuery = "UPDATE laporan_kegiatan SET judul = ?, deskripsi = ?, tanggal = ?, status = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ssssi", $judul, $deskripsi, $tanggal, $status, $id);

        if ($stmt->execute()) {
            $_SESSION['pesan'] = "Laporan berhasil diperbarui.";
            header("Location: report.php");
            exit();
        } else {
            $_SESSION['pesan'] = "Gagal memperbarui laporan: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laporan</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include 'sidebar.php'; ?>
    
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h1 class="mt-3">Edit Laporan Kegiatan</h1>
                
                <!-- Notifikasi -->
                <?php if (isset($_SESSION['pesan'])): ?>
                    <div class="alert alert-info alert-dismissible fade show">
                        <?php echo htmlspecialchars($_SESSION['pesan']); unset($_SESSION['pesan']); ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" value="<?php echo htmlspecialchars($laporan['judul']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" required><?php echo htmlspecialchars($laporan['deskripsi']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo $laporan['tanggal']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="Pending" <?php echo ($laporan['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="Diproses" <?php echo ($laporan['status'] == 'Diproses') ? 'selected' : ''; ?>>Diproses</option>
                            <option value="Selesai" <?php echo ($laporan['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="report.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </form>
            </div>
        </section>
    </div>

    <footer class="main-footer text-center">
        <strong>Copyright &copy; <?php echo date("Y"); ?> Diskominfo Kabupaten Cirebon.</strong> All rights reserved.
    </footer>
</div>
</body>
</html>
