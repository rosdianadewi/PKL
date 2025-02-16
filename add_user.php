<?php
session_start();
include 'config.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Sebaiknya gunakan password_hash()
    $role = $_POST['role'];

    $query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $password, $role);
    if ($stmt->execute()) {
        header("Location: manage_users.php");
        exit();
    } else {
        echo "Gagal menambahkan pengguna!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

            <div class="container mt-5">
                <h1 class="mt-3">Tambah Pengguna</h1>
                <form method="POST">
                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Role:</label>
                        <select name="role" class="form-control">
                            <option value="admin1">Admin 1</option>
                            <option value="admin2">Admin 2</option>
                            <option value="user1">User 1</option>
                            <option value="user2">User 2</option>
                            <option value="mahasiswa">Mahasiswa</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="manage_users.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </section>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
</body>
</html>
