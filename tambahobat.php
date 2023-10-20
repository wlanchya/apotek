<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['idUser'])) {
    header('Location: ../login/index.php');
    exit();
}

include('../config.php'); // Menginclude file config.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Drug</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Add new drug</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../dashboard/">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../client/">Client</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../drug/">Drug</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../employee/">Employee</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2>Add new drug</h2>
        <form method="POST" action="crudDrug.php">
            <div class="form-group">
                <label for="nama">Drug Name:</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="ket">Description:</label>
                <textarea name="ket" id="ket" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="stok">Stock:</label>
                <input type="number" name="stok" id="stok" class="form-control" required>
            </div>
            <button type="submit" name="tambah_obat" class="btn btn-primary">Add Drug</button>
        </form>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</body>

</html>