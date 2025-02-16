<?php
// Pastikan session hanya dimulai jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$host = "localhost";  // Sesuaikan dengan server Anda
$user = "root";       // Sesuaikan dengan username database
$pass = "";           // Kosongkan jika tidak ada password
$db   = "pkl"; // Ganti dengan nama database yang benar

$conn = new mysqli($host, $user, $pass, $db);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>

