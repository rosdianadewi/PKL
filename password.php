<?php
$password1 = "admin123"; // Ganti dengan password yang diinginkan
$password2 = "user123";
$password3 = "mahasiswa123";
$hashed_password1 = password_hash($password1, PASSWORD_DEFAULT);
$hashed_password2 = password_hash($password2, PASSWORD_DEFAULT);
$hashed_password3 = password_hash($password3, PASSWORD_DEFAULT);
echo "Hash Password1: " . $hashed_password1;
echo "Hash Password2: " . $hashed_password2;
echo "Hash Password3: " . $hashed_password3;
?>
