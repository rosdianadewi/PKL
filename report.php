<?php
session_start();
include 'config.php';

// Periksa koneksi database
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Tangani penghapusan laporan jika ada request POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hapus'])) {
    $id_hapus = intval($_POST['hapus']); // Pastikan ID berupa angka
    $stmt = $conn->prepare("DELETE FROM laporan_kegiatan WHERE id = ?");
    $stmt->bind_param("i", $id_hapus);

    if ($stmt->execute()) {
        $_SESSION['pesan'] = "Laporan berhasil dihapus.";
    } else {
        $_SESSION['pesan'] = "Gagal menghapus laporan: " . $conn->error;
    }

    $stmt->close();
    header("Location: report.php");
    exit();
}

// Ambil data dari tabel laporan_kegiatan
$query = "SELECT id, judul, deskripsi, tanggal, status, nama_peserta FROM laporan_kegiatan ORDER BY tanggal DESC";
$result = $conn->query($query);

if (!$result) {
    die("Query Error: " . $conn->error);
}

// Ambil notifikasi jika ada
$pesan = $_SESSION['pesan'] ?? '';
unset($_SESSION['pesan']); // Hapus setelah ditampilkan
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kegiatan</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include 'sidebar.php'; ?>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h1 class="mt-3">Laporan Kegiatan PKL</h1>
                
                <!-- Notifikasi -->
                <?php if (!empty($pesan)): ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($pesan); ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif; ?>
                
                <a href="add_report.php" class="btn btn-success mb-3">
                    <i class="fas fa-plus-circle"></i> Tambah Laporan
                </a>
                <a href="admin_dashboard.php" class="btn btn-primary mb-3">
                    <i class="fas fa-home"></i> Dashboard
                </a>

                <table class="table table-bordered" id="laporanTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Nama Peserta</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['judul']); ?></td>
                            <td><?php echo htmlspecialchars($row['deskripsi'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                            <td>
                                <?php 
                                if ($row['status'] === 'Pending') {
                                    echo '<span class="badge badge-warning">Pending</span>';
                                } elseif ($row['status'] === 'Diproses') {
                                    echo '<span class="badge badge-primary">Diproses</span>';
                                } else {
                                    echo '<span class="badge badge-success">Selesai</span>';
                                }
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['nama_peserta']); ?></td>
                            <td>
                                <a href="edit_report.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="btn btn-danger btn-sm btn-hapus" data-id="<?php echo $row['id']; ?>">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus laporan ini?
                </div>
                <div class="modal-footer">
                    <form method="POST" action="report.php">
                        <input type="hidden" name="hapus" id="hapusID">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer text-center">
        <strong>Copyright &copy; <?php echo date("Y"); ?> Diskominfo Kabupaten Cirebon.</strong> All rights reserved.
    </footer>
</div>

<script>
    $(document).ready(function () {
        $('#laporanTable').DataTable();
        
        // Menangani klik tombol hapus
        $('.btn-hapus').on('click', function () {
            let id = $(this).data('id');
            $('#hapusID').val(id);
            $('#modalHapus').modal('show');
        });
    });
</script>
</body>
</html>