<?php
session_start();
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hapus'])) {
    $id_hapus = intval($_POST['hapus']);

    // Debugging - Cek apakah ID diterima
    echo "ID yang akan dihapus: " . $id_hapus;
    exit(); // Hapus ini setelah debugging

    $query = "DELETE FROM laporan_kegiatan WHERE id = $id_hapus";
    if (mysqli_query($conn, $query)) {
        $_SESSION['pesan'] = "Laporan berhasil dihapus.";
    } else {
        $_SESSION['pesan'] = "Gagal menghapus laporan.";
    }
}

header("Location: report.php");
exit();
?>
