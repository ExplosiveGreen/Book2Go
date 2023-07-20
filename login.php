<?php 
include "db.php";
session_start();//on logout session_destroy();
if(!empty($_POST["email"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $query = "SELECT * FROM tbl_218_users WHERE email='$email' and password='$password';";
  $result = mysqli_query($connection , $query);
  $row = mysqli_fetch_array($result);
        
  if(is_array($row)) {
    $_SESSION["user_id"] = $row['user_id'];
    $_SESSION["user_type"] = $row['user_type'];
    $_SESSION["first_name"] = $row['first_name'];
    $_SESSION["last_name"] = $row['last_name'];
    $_SESSION["img"] = $row['img'];
    header('Location: index.php');
  } else {
    $message = "Invalid email or Password!";
  }
  mysqli_free_result($result);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Book2Go - Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="css/style.css" rel="stylesheet">
  <script src="js/script.js"></script>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5 registerContainer">
          <div class="card-body">
            <h1 class="text-center loginTitle mb-4">Welcome to Book2Go</h1>
            <form onsubmit="return validateRegister()" method='POST' action='#'>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                <div id="email-feedback" class="invalid-feedback">Please enter your email</div>
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                <div id="password-feedback" class="invalid-feedback">Please enter your password</div>
              </div>
              <button type="submit" class="btn btn-primary btn-block btnRegister">Login</button>
              <div class='error-message text-danger'><?php if(isset($message)) { echo $message; } ?></div>
            </form>
            <p class="text-center mt-3 loginLink">Don't have an account? <a href="signup.php">Signup</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
mysqli_close($connection);
?>