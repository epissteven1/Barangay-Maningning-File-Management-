<?php
session_start();

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];

include_once 'connection.php';

	// Prepare and bind the SQL statement
	$stmt = $mysqli->prepare("INSERT INTO users (username, email, password, status) VALUES (?, ?, ?, 'pending')");
	$stmt->bind_param("sss", $username, $email, $password);

	// Execute the SQL statement
	if ($stmt->execute()) {
		echo "<div class='form'> <h3>You are registered successfully. Please wait for approval.</h3> <br/>Click here to <a href='login.php'>Login</a></div>";
	} else {
		echo "Error: " . $stmt->error;
	}

	$stmt->close();
	$mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
</head>
<body>
	<h1>Registration</h1>
	<form name="registration" action="" method="post">
		<label for="username">Username:</label>
		<input type="text" name="username" placeholder="Username" required /><br>
		<label for="email">Email:</label>
		<input type="email" name="email" placeholder="Email" required /><br>
		<label for="password">Password:</label>
		<input type="password" name="password" placeholder="Password" required /><br>
		<input type="submit" name="submit" value="Register" />
	</form>
</body>
</html>
