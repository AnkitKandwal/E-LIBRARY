<?php
include 'connection.php';

use PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../E-LIBRARY/vendor/autoload.php';
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $email = $_POST["email"];
    
    $mail = new PHPMailer(true);
    
    $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;
    
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'krishna.kandwal98@gmail.com';
    $mail->Password   = 'tjrcgokullasuaoi';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->setFrom('krishna.kandwal98@gmail.com', 'ANKIT');
    $mail->addAddress($email);
    $mail->isHTML(true);
    
    $verify_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
    date_default_timezone_set('Asia/kolkata');
    $expiry_date = date("Y-m-d H:i:s", strtotime('+60 minutes'));
    
    $mail->Subject = 'Email verification from ANKIT';
    $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $email . '&verify_code=' . $verify_code . '</b></p>';
    
    
    $mail->send();
    
  
    $Sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $Sql);
    
    if (mysqli_num_rows($result) > 0) {
        $showError = "Username already exists";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, email, verification_code, is_verified) VALUES ('$username', '$hash', '$email', '$verify_code', '0')";
        $result = mysqli_query($con, $sql);
    }
    
    if($result){
        header("Location: verify.php?email=$email");
    }
  
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Registration Page</title>
</head>

<body>
    <?php

    if ($showAlert) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }

    if ($showError) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }

    ?>

    <div class="container mt-5 rounded" style="background-color: #F5E9E9; width: 500px; height: 500px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mt-4">
                    <h2 class="text-center" style="color:#282058 ; font-size: x-large;">Registration Page</h2>
                </div>
                <form method="post">
                    <div class="form-group mt-5">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #007bff;">Register</button>
                </form>

                <p style="font-size: smaller;text-align: center;" class="mt-4">Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>