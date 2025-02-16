<?php
session_start();
include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: manage_users.php");
    exit();
}

$id = $_GET['id'];

// Ambil data user
$query = "SELECT * FROM users WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "Pengguna tidak ditemukan!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Periksa apakah password diubah
    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']); // Sebaiknya gunakan password_hash()
        $query = "UPDATE users SET username=?, password=?, role=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $username, $password, $role, $id);
    } else {
        $query = "UPDATE users SET username=?, role=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $username, $role, $id);
    }

    if ($stmt->execute()) {
        header("Location: manage_users.php");
        exit();
    } else {
        echo "Gagal mengedit pengguna!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
</head>
<body>
<div class="wrapper">
    <?php include 'sidebar.php'; ?>

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h1 class="mt-3">Edit Pengguna</h1>
                <form method="POST">
                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Password (kosongkan jika tidak ingin mengubah):</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Role:</label>
                        <select name="role" class="form-control">
                            <option value="admin1" <?php if ($user['role'] == 'admin1') echo 'selected'; ?>>Admin 1</option>
                            <option value="admin2" <?php if ($user['role'] == 'admin2') echo 'selected'; ?>>Admin 2</option>
                            <option value="user1" <?php if ($user['role'] == 'user1') echo 'selected'; ?>>User 1</option>
                            <option value="user2" <?php if ($user['role'] == 'user2') echo 'selected'; ?>>User 2</option>
                            <option value="mahasiswa" <?php if ($user['role'] == 'mahasiswa') echo 'selected'; ?>>Mahasiswa</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="manage_users.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </section>
    </div>
</div>
</body>
</html>
