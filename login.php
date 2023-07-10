<?php

$showAlert = false;
$login = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'connection.php';

    $username = $_POST["username"];
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    $sql = "Select * from users where username='$username'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        while($row=mysqli_fetch_assoc($result)){
         if(password_verify($password,$row['password'])){
         $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location:booklisting.php");
    }

      if($row["user_type"] == "user")
      {
        
         header("location:booklisting.php");
         

      }

      elseif($row["user_type"] == "admin")
      {
    
        header("location:booklisting.php");
      }




}

    }
    else {
        $showError = "Invalid Credentials";
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
                    <h2 class="text-center" style="color:#282058 ; font-size: x-large;">Login Page</h2>
                </div>
                <form method="post">
                    <div class="form-group mt-5">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                    </div>

                    <button type="submit" class="btn btn-primary" style="background-color: #007bff;">Login</button>
                </form>

            </div>
        </div>
        <div class="mt-4">
            <h1 class="mt-2" style="font-size: 12px;text-align-last: center;">Click Here to <a href="registration.php" class="text-center" style="font-size: 12px;">Register</a></h1>

        </div>

        <?php
if (!$login && isset($showError) && !isset($_SESSION['errorShown'])) {
    echo '<div id="error-msg" class="alert alert-danger alert-dismissible text-center" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>OOPS...</strong> ' . $showError . '
    </div>';
    $_SESSION['errorShown'] = true;
}
?>



    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        
    </script>
    
</body>

</html>"