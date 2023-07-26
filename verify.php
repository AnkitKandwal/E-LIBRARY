<?php
session_start();
$showError = false;
include 'connection.php';

if (isset($_POST['verify-code']) && isset($_GET['email'])) {
    $email = $_GET['email'];
    $enteredVerifyCode = $_POST['verify-code'];

    $email = mysqli_real_escape_string($con, $email);

 
    $sql = "SELECT verification_code FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $storedVerifyCode = $row['verification_code'];

      
        echo "Stored Verification Code: " . $storedVerifyCode . "<br>";
        echo "Entered Verification Code: " . $enteredVerifyCode . "<br>";

        if ($enteredVerifyCode === $storedVerifyCode) {
            $_SESSION['verification_success'] = true;
            header("Location: login.php");
            exit();
        } else {
            $showError = true;
        }
    } else {
        // Debugging: Display any database query errors
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Verify</title>
</head>

<body>
    <div class="container mt-5 rounded" style="background-color: #F5E9E9; width: 500px; height: 300px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mt-4">
                    <h2 class="text-center" style="color:#282058; font-size: x-large;">Verification page</h2>
                </div>
                <form method="post">
                    <div class="form-group mt-5">
                        <label for="username">Verification code</label>
                        <input type="text" class="form-control" id="" name="verify-code" placeholder="Enter verification code" required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #007bff;">Verify</button>
                </form>
            </div>
        </div>

        <?php if ($showError) : ?>
            <div id="error-msg" class="alert alert-danger alert-dismissible text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>OOPS...</strong> Invalid code
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
