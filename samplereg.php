<?php
include 'connection.php'; 
if(isset($_POST['submit'])) {

  // Get form data
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

  // Validate password match
  if($password !== $confirm_password){
      $password_err = "Passwords do not match";
  }

  // Validate password length
  if(strlen($password) < 6){
      $password_err = "Password must be at least 6 characters";
  }
  
  // Hash password
  $password = password_hash($password, PASSWORD_DEFAULT);
  echo "Hashed Password: " . $hashed_password;
  // Insert user into database
  $sql = "INSERT INTO applicants (username, email, password) VALUES ('$username', '$email', '$password')";

  if(mysqli_query($conn, $sql)){
    header("Location: samplelog.php");
  } else {
    echo "Error: " . mysqli_error($conn);
  }

}
?>


<!DOCTYPE html>
<html>
<head>
<title>Registration</title>
</head>
<body>

<?php if(!empty($password_err)): ?>
  <p><?php echo $password_err; ?></p>
<?php endif; ?>

<form method="post">
  <input type="text" name="username" placeholder="Username" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="password" name="confirm_password" placeholder="Confirm password" required>
  <input type="submit" name="submit" value="Register">
</form>

</body>
</html>