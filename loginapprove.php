<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Connect to the database
	include 'connection.php';

	// Prepare and bind the SQL statement
	$stmt = $mysqli->prepare("SELECT id FROM applicants WHERE username = ? AND password = ? AND status = 'approved'");
	$stmt->bind_param("ss", $username, $password);

	// Execute the SQL statement
	$stmt->execute();
	$stmt->store_result();

	// Check if the user exists and is approved
	if ($stmt->num_rows > 0) {
		// Bind the result to variables
		$stmt->bind_result($id, $username);

		// Fetch the result
		$stmt->fetch();

		// Store the user ID and name in the session
		$_SESSION['user_id'] = $id;
		$_SESSION['user_name'] = $username;

		// Redirect to the protected page
		header("Location: protected.php");
		exit();
	} else {
		// Display an error message
		echo "Invalid email address or password, or user is not approved.";
	}

	$stmt->close();
	$mysqli->close();
}
?>
