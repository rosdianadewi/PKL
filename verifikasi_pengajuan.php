<?php
session_start();
include 'config.php'; // Pastikan ini ada di awal untuk menghubungkan ke database

// Periksa apakah koneksi database sudah dibuat
if (!isset($conn) || !$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Contoh query yang menyebabkan error
$query = "SELECT * FROM pengajuan_pkl";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

// Proses update status pengajuan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $alasan_penolakan = isset($_POST['alasan_penolakan']) ? $_POST['alasan_penolakan'] : NULL;

    // Update status di database
    $query = "UPDATE pengajuan_pkl SET status = ?, alasan_penolakan = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $status, $alasan_penolakan, $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Status berhasil diperbarui!";
    } else {
        $_SESSION['error'] = "Gagal memperbarui status!";
    }

    mysqli_stmt_close($stmt);
    header("Location: verifikasi_pengajuan.php");
    exit;
}

// Ambil data pengajuan yang berstatus 'Menunggu'
$query = "SELECT * FROM pengajuan_pkl WHERE status = 'Menunggu'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pengajuan PKL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">Verifikasi Pengajuan PKL</h1>

                <!-- Tombol Kembali ke Dashboard -->
                <a href="user_dashboard.php" class="btn btn-secondary mb-3">
                    🔙 Kembali ke Dashboard
                </a>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php elseif (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header bg-primary text-white">Daftar Pengajuan Menunggu</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Mahasiswa</th>
                                    <th>NIM</th>
                                    <th>Judul PKL</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Aksi</th>
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
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                <input type="hidden" name="status" value="Disetujui">
                                                <button type="submit" class="btn btn-success">Setujui</button>
                                            </form>
                                            <button class="btn btn-danger tolak-btn" data-id="<?= $row['id']; ?>">Tolak</button>
                                        </td>
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

<!-- Script untuk menampilkan SweetAlert saat menolak -->
<script>
document.querySelectorAll('.tolak-btn').forEach(button => {
    button.addEventListener('click', function () {
        let id = this.getAttribute('data-id');
        
        Swal.fire({
            title: 'Tolak Pengajuan?',
            input: 'text',
            inputLabel: 'Masukkan alasan penolakan',
            showCancelButton: true,
            confirmButtonText: 'Tolak',
            cancelButtonText: 'Batal',
            preConfirm: (alasan) => {
                if (!alasan) {
                    Swal.showValidationMessage('Alasan penolakan harus diisi!');
                }
                return alasan;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.style.display = 'none';
                
                let inputId = document.createElement('input');
                inputId.name = 'id';
                inputId.value = id;
                form.appendChild(inputId);
                
                let inputStatus = document.createElement('input');
                inputStatus.name = 'status';
                inputStatus.value = 'Ditolak';
                form.appendChild(inputStatus);

                let inputAlasan = document.createElement('input');
                inputAlasan.name = 'alasan_penolakan';
                inputAlasan.value = result.value;
                form.appendChild(inputAlasan);

                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
</body>
</html>
