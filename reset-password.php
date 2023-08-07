<?php

include 'connection.php';

if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($con, $_GET['email']);

    $query = "SELECT * FROM `users` WHERE `email` = '$email' ";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) == 1) {

        if (isset($_POST['update-password'])) {

            $newPassword = $_POST['password'];
            // var_dump($newPassword,$email);
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);


            $updateQuery = "UPDATE `users` SET `password` = '$hashedPassword' WHERE `email`='$email'";
            if (mysqli_query($con, $updateQuery)) {
                echo "
                        <script>
                        alert('Password updated successfully. You can now log in with your new password.');
                        window.location.href = 'login.php';
                        </script>";
            } else {
                echo "
                        <script>
                        alert('Password update failed. Please try again later.');
                        window.location.href = 'login.php';
                        </script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Reset Password</title>
</head>

<body>
    <div class="container mt-5 rounded" style="background-color: #F5E9E9; width: 500px; height: 300px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mt-4">
                    <h2 class="text-center" style="color:#282058 ; font-size: x-large;">Reset Password</h2>
                </div>
                <form method="post">
                    <div class="form-group mt-5">
                        <label for="password">Create a new password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="update-password" style="background-color: #007bff;">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>