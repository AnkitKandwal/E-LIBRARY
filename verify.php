<?php
include 'connection.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    if (isset($_POST['submit'])) {
        $verify = $_POST['verify-code'];

        // Retrieve user data from the database using the provided email and verification code
        $query = "SELECT * FROM users WHERE email='$email' AND verification_code='$verify'";
        $result = mysqli_query($con, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $result_fetch = mysqli_fetch_assoc($result);

                if ($result_fetch['is_verified'] == 0) {
                    // Update the 'is_verified' status to 1 (verified)
                    $update = "UPDATE users SET is_verified = 1 WHERE email='$email'";
                    if (mysqli_query($con, $update)) {
                        echo "
                        <script>
                        alert('Email verification successful! You can now login.');
                        window.location.href='login.php';
                        </script>";
                    } else {
                        echo "
                        <script>
                        alert('Cannot run query');
                        window.location.href='login.php';
                        </script>";
                    }
                } else {
                    echo "
                    <script>
                    alert('Email already verified! You can directly login.');
                    window.location.href='login.php';
                    </script>";
                }
            } else {
                echo "
                <script>
                alert('Invalid verification code');
                </script>";
            }
        } else {
            echo "
            <script>
            alert('Error in database query');
            window.location.href='login.php';
            </script>";
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
    <title>Verify Code</title>
</head>

<body>
    <div class="container mt-5 rounded" style="background-color: #F5E9E9; width: 500px; height: 300px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mt-4">
                    <h2 class="text-center" style="color:#282058 ; font-size: x-large;">Verify Code</h2>
                </div>
                <form method="post">
                    <div class="form-group mt-5">
                        <label for="verify-code">Enter verification code</label>
                        <input type="text" class="form-control" id="verify-code" name="verify-code" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary" style="background-color: #007bff;">Verify</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
