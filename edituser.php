<?php
session_start();

if (!isset($_SESSION['idUser'])) {
    header('Location: ../login/index.php');
    exit();
}

include('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idUser = $_POST['idUser'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Update kata sandi dengan kata sandi yang baru
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE user SET username = '$username', password = '$hashedPassword', role = '$role' WHERE idUser = $idUser";
    mysqli_query($connection, $query);

    header('Location: index.php');
    exit();
}

$idUser = $_SESSION['idUser'];
$username = $_SESSION['username'];

// Mendapatkan informasi klien yang akan diedit
$idToEdit = $_GET['id'];
$query = "SELECT * FROM user WHERE idUser = $idToEdit";
$result = mysqli_query($connection, $query);
$clientData = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Edit User</a>
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
        <h2>Edit User</h2>
        <form method="post">
            <input type="hidden" name="idUser" value="<?php echo $idToEdit; ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username"
                    value="<?php echo $clientData['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password"
                    value="<?php echo $clientData['password']; ?>" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" id="role" class="form-select form-select-lg mb-3"
                    aria-label=".form-select-lg example">
                    <?php
                    // Daftar peran yang mungkin, Anda bisa menggantinya sesuai dengan data Anda
                    $possibleRoles = ['admin', 'client'];

                    // Loop melalui setiap peran dan tampilkan sebagai opsi
                    foreach ($possibleRoles as $role) {
                        $selected = ($role == $clientData['role']) ? 'selected' : '';
                        echo "<option value='$role' $selected>$role</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Client</button>
        </form>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>