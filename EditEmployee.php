<?php
session_start();

if (!isset($_SESSION['idUser'])) {
    header('Location: ../login/index.php');
    exit();
}

include('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPegawai = $_POST['idPegawai'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $alamat = $_POST['alamat'];


    $query = "UPDATE pegawai SET nama = '$nama', jabatan = '$jabatan', alamat = '$alamat' WHERE idPegawai = $idPegawai";
    mysqli_query($connection, $query);

    header('Location: index.php');
    exit();
}

$idUser = $_SESSION['idUser'];
$username = $_SESSION['username'];


$idToEdit = $_GET['id'];
$query = "SELECT * FROM pegawai WHERE idPegawai = $idToEdit";
$result = mysqli_query($connection, $query);
$employeeData = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Employee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Edit Employee</a>
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
        <h2>Edit Employee</h2>
        <form method="post">
            <input type="hidden" name="idPegawai" value="<?php echo $idToEdit; ?>">
            <div class="form-group">
                <label for="nama">Name:</label>
                <input type="text" class="form-control" id="nama" name="nama"
                    value="<?php echo $employeeData['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="jabatan">Position:</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan"
                    value="<?php echo $employeeData['jabatan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Address:</label>
                <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"
                    value="<?php echo $employeeData['alamat']; ?>" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Employee</button>
        </form>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>