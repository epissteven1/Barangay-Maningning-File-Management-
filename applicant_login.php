<?php
include 'connection.php';
session_start();
function logActivity($conn, $logMessage) {
    $timestamp = date("Y-m-d H:i:s");
    $logMessage = mysqli_real_escape_string($conn, $logMessage);

    // Insert log entry into the activity_log table
    $sql = "INSERT INTO app_activity_log (timestamp, activity_message) VALUES ('$timestamp', '$logMessage')";
    
    if (mysqli_query($conn, $sql)) {
        // Log entry was successfully inserted
        return true;
    } else {
        // Log entry insertion failed
        return false;
    }
}

if (isset($_POST['applicantlogin'])) {
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	// Get user from database
	$sql = "SELECT * FROM applicants WHERE username='$username'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	if ($row) {
		// Check if user is approved
		if ($row['status'] == 'approved') {
			// Verify password
			if (password_verify($password, $row['password'])) {
				// Start session and redirect to homepage
				$_SESSION['id'] = $row['applicant_id'];
				echo '<script>alert("Login Successfully!")</script>';
                 // Log the activity
                 logActivity($conn, "Successful login for username: $username");
				header("Location: dashboard	.php");
				exit();
			} else {
				echo '<script>alert("Invalid username or password")</script>';
				echo '<script>window.location.href = "index.php?"</script>';
				exit();
			}
		} else {
			echo '<script>alert("Your account has not been approved yet.")</script>';
			echo '<script>window.location.href = "index.php?"</script>';
			exit();
		}
	} else {
		echo '<script>alert("Invalid username or password")</script>';
		echo '<script>window.location.href = "index.php?"</script>';
		exit();
	}
}
?>
