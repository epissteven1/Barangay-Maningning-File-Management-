<?php
// Start the session
session_start();

// Include your database connection file
include 'connection.php';

// Check if the user is authenticated
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect to the login page if not authenticated
    exit();
}

// Check if request_id is set in the URL
if (!isset($_GET['applicant_id'])) {
    header("Location: pending_request.php"); // Redirect if request_id is not set
    exit();
}

// Get the request_id from the URL
$request_id = $_GET['request_id'];

// Delete the request from the database
$query = "DELETE FROM permission_requests WHERE request_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $request_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// Redirect back to the permission requests page
header("Location: pending_request.php");
exit();
?>
