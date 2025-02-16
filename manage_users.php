<?php
session_start();
include 'config.php'; // Koneksi database

// Ambil data dari tabel users
$query = "SELECT * FROM users";
$result = $conn->query($query);

// Hapus pengguna
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id=$id");
    header("Location: manage_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<div class="wrapper">
    <?php include 'sidebar.php'; ?>

    <div class="content-wrapper">
       
    <section class="content">
            <div class="container-fluid">
                <h1 class="mt-3">Kelola Pengguna</h1>
                <a href="add_user.php" class="btn btn-success mb-3"><i class="fas fa-user-plus"></i> Tambah Pengguna</a>
                <a href="admin_dashboard.php" class="btn btn-primary mb-3">
                    <i class="fa-solid fa-home"></i> Dashboard
                </a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-pencil-alt"></i> <!-- Ikon pensil -->
                            </a>
                            <a href="manage_users.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">
                            <i class="fas fa-trash-alt"></i> <!-- Ikon tong sampah -->
                            </a>
                        </td>

                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"></script>
</body>
</html>
