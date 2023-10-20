<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['idUser'])) {
    header('Location: ../login/index.php');
    exit();
}

include('../config.php'); // Menginclude file config.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tangani operasi tambah obat
    if (isset($_POST['tambah_obat'])) {
        $nama = $_POST['nama'];
        $ket = $_POST['ket'];
        $stok = $_POST['stok'];

        // Lakukan validasi data yang masuk, misalnya periksa apakah semua field diisi dengan benar.

        // Query untuk menambahkan obat ke database
        $query = "INSERT INTO obat (nama, ket, stok) VALUES ('$nama', '$ket', '$stok')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            header('Location: index.php');
            exit();
        } else {
            die("Query Error: " . mysqli_error($connection));
        }
    }

    // Tangani operasi edit obat
    if (isset($_POST['edit_obat'])) {
        $idObat = $_POST['idObat'];
        $nama = $_POST['nama'];
        $ket = $_POST['ket'];
        $stok = $_POST['stok'];

        // Query untuk mengupdate obat di database
        $query = "UPDATE obat SET nama='$nama', ket='$ket', stok='$stok' WHERE idObat='$idObat'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            header('Location: index.php');
            exit();
        } else {
            die("Query Error: " . mysqli_error($connection));
        }
    }

    // Tangani operasi hapus obat
    if (isset($_POST['hapus_obat'])) {
        $idObat = $_POST['idObat'];

        // Query untuk menghapus obat dari database
        $query = "DELETE FROM obat WHERE idObat='$idObat'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            header('Location: index.php');
            exit();
        } else {
            die("Query Error: " . mysqli_error($connection));
        }
    }
}
?>