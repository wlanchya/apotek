<?php
include('../config.php'); // Menginclude file config.php

// Mendapatkan data dari formulir login
$username = $_POST['username'];
$password = $_POST['password'];

// Cek apakah username dan password sesuai
$checkUserQuery = "SELECT idUser, username, password, role FROM user WHERE username = '$username'";
$result = mysqli_query($connection, $checkUserQuery);

if ($result) {
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $hashedPassword = $user['password'];

        if (password_verify($password, $hashedPassword)) {
            // Periksa peran pengguna apakah "admin"
            if ($user['role'] === 'admin') {
                // Login berhasil
                session_start();
                $_SESSION['idUser'] = $user['idUser'];
                $_SESSION['username'] = $user['username'];
                header('Location: ../dashboard/'); // Ganti dengan halaman dashboard setelah login sukses
            } else {
                header('Location: ../login/index.php?error=not_admin');
                exit;
            }
        } else {
            header('Location: ../login/index.php?error=username_and_password_mismatch');
            exit;
        }
    } else {
        header('Location: ../login/index.php?error=username_not_found');
        exit;
    }
} else {
    echo "Error: " . $checkUserQuery . "<br>" . mysqli_error($connection);
}

// Tutup koneksi database
mysqli_close($connection);
?>