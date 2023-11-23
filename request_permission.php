<?php
// Start the session
session_start();

// Include your database connection file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have sanitized and validated the input for security
    $file_id = $_POST['file_id'];
    $reason = $_POST['reason'];

    // Get the applicant_id from the session
    $applicant_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
           
  
    // Check if applicant_id is set
    if ($applicant_id !== null) {
        // Insert the permission request into the database using prepared statements
        $insertQuery = "INSERT INTO permission_requests (applicant_id, file_id, reason, status) VALUES (?, ?, ?, 'Pending')";
        $stmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmt, "iss", $applicant_id, $file_id, $reason);
        $insertResult = mysqli_stmt_execute($stmt);

        if ($insertResult) {
            $sql = "SELECT * FROM documents";
            $result = mysqli_query($conn, $sql);
      
            // Insert a message into the database for the pending request
            $message = "Your permission request for file <?php echo ['file_uploads']; ?> is pending review.  We appreciate your patience.";
            $insertMessageQuery = "INSERT INTO permission_messages (applicant_id, message) VALUES (?, ?)";
            $stmtMessage = mysqli_prepare($conn, $insertMessageQuery);
            mysqli_stmt_bind_param($stmtMessage, "is", $applicant_id, $message);
            mysqli_stmt_execute($stmtMessage);

            echo 'Permission request submitted successfully. The admin will review your request.';
            header("Location: success1.php");
            exit();
        } else {
            echo 'Error submitting permission request: ' . mysqli_error($conn);
        }

        // Close the statements
        mysqli_stmt_close($stmt);
        mysqli_stmt_close($stmtMessage);
    } else {
        echo 'Error: User not authenticated.';
    }
} else {
    echo 'Invalid request';
}

// Check if the file download request is submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['download_file'])) {
    // ... (unchanged)
}

// Close the database connection
mysqli_close($conn);
?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>

    <form action="#" method="post">
        <input type="hidden" name="file_id" > 
        <input type="text" name="reason" placeholder="Reason for request" required>
        <input type="submit" value="Submit">
    </form>

    </body>
    </html>
