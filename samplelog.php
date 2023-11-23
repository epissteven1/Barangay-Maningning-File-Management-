<?php
session_start();
include 'connection.php';

if(isset($_POST['submit'])){

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Get hashed password from database
  $sql = "SELECT password FROM applicants WHERE username='$username'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $hashed_password = $row['password'];
  
  // Verify password
  if(password_verify($password, $hashed_password)){
    
    // Set session variables
    // $_SESSION['id'] = $row['applicant_id'];
    header("Location: user_index.php");
  } else {
    $login_err = "Invalid username or password";
  }

}  
?>

<!DOCTYPE html>
<html>
<head>  
<title>Login</title>
</head>
<body>

<?php if(!empty($login_err)): ?>
  <p><?php echo $login_err; ?></p>  
<?php endif; ?>

<form method="post">
  <input type="text" name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="submit" name="submit" value="Login">
</form>

</body>
</html>