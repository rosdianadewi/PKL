<?php
session_start();
include 'config.php';

$id = $_GET['id'];
$query = "DELETE FROM data_pkl WHERE id=$id";

if (mysqli_query($conn, $query)) {
    header("Location: data_pkl.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
