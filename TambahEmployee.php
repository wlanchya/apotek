<?php
session_start();

if (!isset($_SESSION['idUser'])) {
    header('Location: ../login/index.php');
    exit();
}

include('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO pegawai (nama, jabatan, alamat) VALUES ('$nama', '$jabatan', '$alamat')";
    mysqli_query($connection, $query);

    header('Location: index.php');
    exit();
}

$idUser = $_SESSION['idUser'];
$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Employee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Add new Employee</a>
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
        <h2>Add Employee</h2>
        <form method="post">
            <div class="form-group">
                <label for="nama">Name:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="jabatan">Position:</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" required>
            </div>
            <div class="form-group">
                <label for="alamat">Address:</label>
                <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Employee</button>
        </form>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>