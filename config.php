<?php
$host = 'localhost'; // Ganti sesuai dengan host MySQL Anda
$username = 'root'; // Ganti dengan username database
$password = ''; // Ganti dengan password database
$database = 'ClientAppDB'; // Ganti dengan nama database

// Membuat koneksi ke database
$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>