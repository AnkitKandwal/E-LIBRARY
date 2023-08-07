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

   
    $check_query = "SELECT * FROM users WHERE email='$email' OR username='$username'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "
                <script>
                alert('email or username already exist');
                window.location.href = 'registration.php';
                </script>";
    } else {
       
        $verify_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        date_default_timezone_set('Asia/Kolkata');
        $expiry_date = date("Y-m-d H:i:s", strtotime('+60 minutes'));

   
        $mail = new PHPMailer(true);

        $mail->SMTPDebug = 0;

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

        $mail->Subject = 'Email verification from ANKIT';
        $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verify_code . '</b></p>';

    
        if (!$mail->send()) {
            $showError = 'Email sending failed. Please try again later.';
        } else {
          
            $hash = password_hash($password, PASSWORD_DEFAULT);

        
            $sql = "INSERT INTO users (username, password, email, verification_code,  is_verified) VALUES ('$username', '$hash', '$email', '$verify_code', '0')";
            $result = mysqli_query($con, $sql);

            if ($result) {
                $showAlert = true;
                echo "
                <script>
                alert('Please check your email for the verification code.');
                window.location.href = 'verify.php?email=$email'; // Redirect to the verify page
                </script>";
            } else {
                $showError = 'Registration failed. Please try again later.';
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
    <title>Login Page</title>
</head>

<body>
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