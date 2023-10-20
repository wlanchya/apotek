<?php
include('../config.php');

$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Cek apakah username sudah digunakan sebelumnya
$checkUsernameQuery = "SELECT username FROM user WHERE username = '$username'";
$result = mysqli_query($connection, $checkUsernameQuery);

if (mysqli_num_rows($result) > 0) {
    // Jika username sudah digunakan, tampilkan pesan kesalahan
    header('Location: ../register/index.php?error=username_exists');
    exit;
}

// Pastikan password dan konfirmasi password cocok
if ($password !== $confirm_password) {
    header('Location: ../register/index.php?error=password_mismatch');
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$balance = 1000;

$insertUserQuery = "INSERT INTO user (username, password, role) VALUES ('$username', '$hashedPassword', 'admin')";

if (mysqli_query($connection, $insertUserQuery)) {
    header('Location: ../register/index.php?success=true');
} else {
    header('Location: ../register/index.php?error=registration_failed');
    // Anda juga dapat menyimpan pesan kesalahan di session dan menampilkannya di halaman register
    // $_SESSION['registration_error'] = "Registration failed: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
0 comments on commit c677105