<?php
// Include your database connection file
session_start();
include 'connection.php';

// Check if the request_id is provided in the URL
if (isset($_GET['request_id'])) {
    var_dump($_GET['request_id']);
    // Assuming you have sanitized and validated the input for security
    $request_id = $_GET['request_id'];
  
    $applicant_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
   

    if ($applicant_id !== null) {
        // Check if the request belongs to the current applicant and has 'Pending' status
        $checkRequestQuery = "SELECT * FROM permission_requests WHERE applicant_id = ? AND request_id = ? AND status = 'Pending'";
        $stmt = mysqli_prepare($conn, $checkRequestQuery);
        mysqli_stmt_bind_param($stmt, "ii", $applicant_id, $request_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Delete the request
            $deleteQuery = "DELETE FROM permission_requests WHERE request_id = ?";
            $stmt = mysqli_prepare($conn, $deleteQuery);
            mysqli_stmt_bind_param($stmt, "i", $request_id);
            $deleteResult = mysqli_stmt_execute($stmt);

            if ($deleteResult) {
                echo 'Request deleted successfully.';
            } else {
                echo 'Error deleting request: ' . mysqli_error($conn);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo 'Error: Invalid request or not in pending status.';
        }
    } else {
        echo 'Error: User not authenticated.';
    }
} else {
    echo 'Error: Request ID not provided.';
}

// Close the database connection
mysqli_close($conn);
?>
