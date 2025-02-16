<?php
session_start();
include 'config.php'; // Koneksi ke database

// Debug 1: Cek isi session
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    die("DEBUG: user_id di session kosong! <br>" . var_export($_SESSION, true));
}

// Debug 2: Cek koneksi database
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set timeout session (30 menit)
$timeout = 1800;
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    session_unset();
    session_destroy();
    die("DEBUG: Session timeout! Redirect dicegah.");
}
$_SESSION['last_activity'] = time();

// Regenerasi session ID untuk keamanan
if (!isset($_SESSION['session_regenerated'])) {
    session_regenerate_id(true);
    $_SESSION['session_regenerated'] = true;
}

// Ambil user_id dari sesi
$user_id = $_SESSION['user_id'];

// Debug 3: Pastikan user_id tidak hilang
if (empty($user_id)) {
    die("DEBUG: user_id NULL sebelum query! Pastikan login berhasil.");
}

// Query untuk mendapatkan data profil pengguna
$sql = "SELECT username, email, telepon, alamat, bio, role FROM user_profile WHERE user_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Kesalahan pada query: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Debug 4: Cek hasil query
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("DEBUG: Profil tidak ditemukan di database! user_id: $user_id");
}

// Debug 5: Cek session sebelum redirect ke dashboard
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    die("DEBUG: user_id di session tiba-tiba hilang!");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        p {
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Profil Pengguna</h2>
    <p><strong>Username:</strong> <?php echo htmlspecialchars($row['username']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
    <p><strong>Telepon:</strong> <?php echo htmlspecialchars($row['telepon']); ?></p>
    <p><strong>Alamat:</strong> <?php echo htmlspecialchars($row['alamat']); ?></p>
    <p><strong>Bio:</strong> <?php echo htmlspecialchars($row['bio']); ?></p>
    <p><strong>Role:</strong> <?php echo htmlspecialchars($row['role']); ?></p>
</div>

</body>
</html>
