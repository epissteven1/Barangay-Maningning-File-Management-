<?php
// Start the session
session_start();

// Check if the user is logged in
if(isset($_SESSION['admin_id'])) {
    // Unset and destroy the session
    session_unset();
    session_destroy();
}
echo '<script>alert("You have been successfully logged out.");</script>';

// Redirect the user to the login page (you should replace 'login.php' with your actual login page)
header("Location: login.php");

// Display a logout message using JavaScript alert

?>
