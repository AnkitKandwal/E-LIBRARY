<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Registration Page</title>
</head>
<body>
  
  <div class="container mt-5 rounded" style="background-color: #F5E9E9; width: 500px; height: 500px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="mt-4">
              <h2 class="text-center" style="color:#282058 ; font-size: x-large;">Registration Page</h2>
            </div>
        <form>
          <div class="form-group mt-5">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Create a password">
          </div>
          <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm-password" placeholder="Confirm your password">
          </div>
          <button type="submit" class="btn btn-primary" style="background-color: #007bff;">Register</button>
        </form>
        
        <p style="font-size: smaller;text-align: center;" class="mt-4">Already have an account? <a href="login.php">Login</a></p>
         </div>
       </div>
  </div>
</div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>