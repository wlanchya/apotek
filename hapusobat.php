<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['idUser'])) {
    header('Location: ../login/index.php');
    exit();
}

include('../config.php'); // Menginclude file config.php

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $idObat = $_GET['id'];

    // Periksa apakah obat dengan ID yang diberikan ada dalam database
    $query = "SELECT * FROM obat WHERE idObat = $idObat";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        // Obat ditemukan, lanjutkan proses penghapusan
        $queryDelete = "DELETE FROM obat WHERE idObat = $idObat";
        $resultDelete = mysqli_query($connection, $queryDelete);

        if ($resultDelete) {
            // Penghapusan berhasil, alihkan kembali ke halaman data obat
            header('Location: index.php');
            exit();
        } else {
            die("Query Error: " . mysqli_error($connection));
        }
    } else {
        // Obat tidak ditemukan, alihkan kembali ke halaman data obat
        header('Location: index.php');
        exit();
    }
}
?>