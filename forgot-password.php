<?php
include 'connection.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../E-LIBRARY/vendor/autoload.php';

function sendMail($con, $email, $reset_token)
{
    try {
        $mail = new PHPMailer(true);

        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'krishna.kandwal98@gmail.com';
        $mail->Password = 'tjrcgokullasuaoi';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->setFrom('krishna.kandwal98@gmail.com', 'ANKIT');
        $mail->addAddress($email);
        $mail->isHTML(true);

        $reset_token = bin2hex(random_bytes(32));
        date_default_timezone_set('Asia/Kolkata');
        $date = date("Y-m-d H:i:s");
        $query = "UPDATE `users` SET `resettoken`='$reset_token', `resettokenexpire`='$date' WHERE `email`='$email'";
        if (mysqli_query($con, $query)) {
            $mail->Subject = 'Password reset link from ANKIT';
            $mail->Body = '<p>We received a request from you to reset your password. Click the link below:</p>' .
                          "<a href='http://localhost/E-LIBRARY/reset-password.php?email=$email&reset_token=$reset_token'>Reset Password</a>";
            $mail->send();
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        return false;
    }
}

if (isset($_POST['send-reset-link'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $query = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) == 1) {
        $reset_token = bin2hex(random_bytes(32));
        date_default_timezone_set('Asia/Kolkata');
        $date = date("Y-m-d H:i:s");
        $query = "UPDATE `users` SET `resettoken`='$reset_token', `resettokenexpire`='$date' WHERE `email`='$email'";
        if (mysqli_query($con, $query) && sendMail($con, $email, $reset_token)) {
            echo "
            <script>
            alert('Password reset link sent to mail');
            window.location.href = 'login.php';
            </script>";
        } else {
            echo "
            <script>
            alert('Server down! Try again later');
            window.location.href = 'login.php';
            </script>";
        }
    } else {
        echo "
        <script>
        alert('Email not found');
        window.location.href = 'login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Forgot Password</title>
</head>

<body>
    <h1>forgot-password</h1>
    <div class="container mt-5 rounded" style="background-color: #F5E9E9; width: 500px; height: 300px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mt-4">
                    <h2 class="text-center" style="color:#282058 ; font-size: x-large;">Forgot Password</h2>
                </div>
                <form method="post">
                    <div class="form-group mt-5">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your registered email" required>
                    </div>
                    <button type="submit" class="reset-btn btn-primary" name="send-reset-link" style="background-color: #007bff;">Send link</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
