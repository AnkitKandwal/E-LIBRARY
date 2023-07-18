<?php
session_start();
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connection.php';

    $username = $_POST["username"];
    $usertype = $_POST["user_type"];
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];
        $dbUserType = $row['user_type'];

        if (password_verify($password, $hashedPassword) && $usertype == $dbUserType) {
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = $usertype;
            header("Location: booklisting.php");
            exit();
        }
    }

    $showError = true;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Login Page</title>
</head>

<body>
    <div class="container mt-5 rounded" style="background-color: #F5E9E9; width: 500px; height: 500px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mt-4">
                    <h2 class="text-center" style="color:#282058 ; font-size: x-large;">Login Page</h2>
                </div>
                <form method="post">
                    <div class="form-group mt-5">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="form-group">
                        <label for="user_type">User Type</label>
                        <select class="form-control" id="user_type" name="user_type" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" style="background-color: #007bff;">Login</button>
                </form>
            </div>
        </div>
        <div class="mt-4">
            <h1 class="mt-2" style="font-size: 12px;text-align-last: center;">Click Here to <a href="registration.php" class="text-center" style="font-size: 12px;">Register</a></h1>
        </div>

        <?php if ($showError) : ?>
            <div id="error-msg" class="alert alert-danger alert-dismissible text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>OOPS...</strong> Invalid credentials
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
