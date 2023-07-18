<?php
session_start();

include 'connection.php';
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_email = "SELECT * FROM registration WHERE email = '$email'";
    $result = mysqli_query($con, $check_email);
    $check = mysqli_num_rows($result);

    if ($check == 1) {
      $data = mysqli_fetch_assoc($result); 
      if($data['is_verified']==1){
          $record = array($data['user_role'], $data['full_name'], $data['email'], $data['password']);
  
          $_SESSION['record'] = $record;
          $role = $data['user_role'];
          if ($role == 'admin') {

            $cpass = $data['password'];
            $pass = password_verify($password, $cpass);
        
            if ($pass == true) {
                header("location:mainpage.php");
            } else {
                ?>
                <script>
                    alert("Incorrect password. Please try again.");
                    window.location.href='login.php';
                </script>
                <?php
            }
        } elseif($role == 'user') {
        
            $cpass = $data['password'];
            $pass = password_verify($password, $cpass);
        
            if ($pass == true) {
                header("location:mainpage.php");
            } else {
                ?>
                <script>
                    alert("Incorrect password. Please try again.");
                    window.location.href='login.php';
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("Invalid role. Please try again.");
                window.location.href='login.php';
            </script>
            <?php
        }
                
      } 
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" type="text/css" href="../style.css" />
    <title>E-Library</title>
  </head>
  <body>
    <div>
    <nav class="navbar navbar-expand-lg navbar-transparent">
        <div class="container-fluid">
          <a class="navbar-brand mx-auto"style="text-shadow: 2px 2px 2px #888888;">Explore the world of books</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>
    </div>
    <div class="container mt-5">
  <div class="row justify-content-center">  
    <div class="col-lg-6">
      <div class="card" style="border: 1px solid black;box-shadow: 2px 2px 2px #888888;"">
        <div class="card-header text-center ">LOG IN HERE</div>
        <div class="card-body">
          <form action="" method="POST">
            <div class="mb-3 text-center">
              <label for="email" class="form-login  times-new-roman">Email address</label>
              <input type="email" class="form-control" style="border:1px solid black;" placeholder="Enter email" name="email" />
            </div>
            <div class="mb-3 text-center">
              <label for="password" class="form-login times-new-roman">Password</label>
              <input type="password" class="form-control" style="border:1px solid black;"placeholder="Password" name="password" />
            </div>
            <h6 class="text-right "><a href="forgotpassword.php"class="text-decoration-none">Forgot password?</a></h6>
            <div class="card-body text-center">
              <button type="submit" class="btn btn-primary" name="submit">LOG IN</button>
            </div>
            <h6 class="text-center ">Not account?<a href="registrationpage.php"class="text-decoration-none">Register here</a></h6>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
</body>
</html>