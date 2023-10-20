<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Register Client</title>
    <style>
    /* Latar belakang gelap */
    body {
        background-color: #111;
        color: #fff;
    }

    .container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #444;
        background-color: #222;
        margin-top: 100px;
    }

    .form-group label {
        color: white;
    }

    .form-control {
        background-color: #333;
        color: white;
        border: 1px solid #444;
    }

    .btn {
        background-color: #007bff;
        color: #fff;
    }

    .btn:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Register</h2>

        <form action="regisProses.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <p>Have an account? <a href="../login/">Login</a></p>
            <button type="submit" class="btn btn-block mb-4">Register</button>
            <?php
            if (isset($_GET['error']) && $_GET['error'] === 'username_exists') {
                echo '<div class="alert alert-danger">Username already exists. Please choose a different username.</div>';
            } elseif (isset($_GET['error']) && $_GET['error'] === 'password_mismatch') {
                echo '<div class="alert alert-danger">Password and confirmation do not match. Please try again.</div>';
            } elseif (isset($_GET['error']) && $_GET['error'] === 'registration_failed') {
                echo '<div class="alert alert-danger">Registration failed. Please try again later.</div>';
            }
            ?>
        </form>


    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>