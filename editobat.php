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

    // Query untuk mendapatkan data obat berdasarkan ID
    $query = "SELECT * FROM obat WHERE idObat = $idObat";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Error: " . mysqli_error($connection));
    }

    if (mysqli_num_rows($result) === 1) {
        $obat = mysqli_fetch_assoc($result);
    } else {
        die("Data obat tidak ditemukan.");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_obat'])) {
    $idObat = $_POST['idObat'];
    $nama = $_POST['nama'];
    $ket = $_POST['ket'];
    $stok = $_POST['stok'];

    // Lakukan validasi data yang masuk, misalnya periksa apakah semua field diisi dengan benar.

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Drug</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <!-- Tambahkan bagian header, navigasi, dan formulir untuk mengedit obat -->
    <div class="container">
        <h2>Edit Drug</h2>
        <form method="POST" action="edit_obat.php">
            <input type="hidden" name="idObat" value="<?php echo $obat['idObat']; ?>">
            <div class="form-group">
                <label for="nama">Drug Name:</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $obat['nama']; ?>">
            </div>
            <div class="form-group">
                <label for="ket">Description:</label>
                <textarea name="ket" class="form-control"><?php echo $obat['ket']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="stok">Stock:</label>
                <input type="number" name="stok" class="form-control" value="<?php echo $obat['stok']; ?>">
            </div>
            <button type="submit" name="edit_obat" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</body>

</html>