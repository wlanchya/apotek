<?php
session_start();

if (!isset($_SESSION['idUser'])) {
    header('Location: ../login/index.php');
    exit();
}

include('../config.php');

$idUser = $_SESSION['idUser'];
$username = $_SESSION['username'];

$idToDelete = $_GET['id'];

// Hapus klien dari database
$query = "DELETE FROM user WHERE idUser = $idToDelete";
mysqli_query($connection, $query);

header('Location: index.php');
exit();
?>