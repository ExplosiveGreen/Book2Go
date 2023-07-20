<?php 
include "db.php";
if(!empty($_POST["email"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $query = "INSERT INTO tbl_218_users (email, password, first_name, last_name,user_type) VALUES ('$email', '$password', '$fname', '$lname','reader')";
  $result = mysqli_query($connection, $query);
  if($result) {
    header("Location: login.php");
  } else {
    $message = "Failed to insert data information!";
  }
  mysqli_free_result($result);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Book2Go - Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="css/style.css" rel="stylesheet">
  <script>
    function validateForm() {
      var passwordInput = document.getElementById("password");

      var password = passwordInput.value.trim();

      if (password === "") {
        passwordInput.classList.add("is-invalid");
        document.getElementById("password-feedback").style.display = "block";
        return false;
      } else {
        passwordInput.classList.remove("is-invalid");
        document.getElementById("password-feedback").style.display = "none";
      }

      return true;
    }
  </script>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5 register-container">
          <div class="card-body">
            <h1 class="text-center loginTitle mb-4">Create an Account</h1>
            <form onsubmit="return validateForm()" method="POST" action='#'>
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter your first name" required>
                <div id="fname-feedback" class="invalid-feedback">Please enter your first name</div>
              </div>
              <div class="form-group">
              <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" class="form-control" placeholder="Enter your last name" required>
                <div id="lname-feedback" class="invalid-feedback">Please enter your last name</div>
              </div>
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
              <button type="submit" class="btn btn-primary btn-block btnRegister">Register</button>
              <div class='error-message text-danger'><?php if(isset($message)) { echo $message; } ?></div>
            </form>
            <p class="text-center mt-3 login-link">Already have an account? <a href="login.php">Login</a></p>
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