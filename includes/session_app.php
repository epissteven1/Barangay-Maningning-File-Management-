<?php
include 'connection.php';


// Check if a session is already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];




    $query = "SELECT * FROM applicants WHERE applicant_id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        $requestCount = getTotalRequestDocumentCount($conn, $id);

    } else {
        // Handle query error, e.g., log the error, redirect, or display a message
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Redirect to login page if session 'id' is not set
    header("Location: index.php");
    exit();
}
?>
