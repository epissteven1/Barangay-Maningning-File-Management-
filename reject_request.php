<?php
include 'connection.php';

$response = array();

if (isset($_GET['request_id'])) {
    $request_id = $_GET['request_id'];
    // Delete applicant from the database
    $deleteQuery = "DELETE FROM permission_requests WHERE request_id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param('i', $request_id);
    
    if ($deleteStmt->execute()) {
        $response['success'] = true;
        // Redirect back to applicant_request.php
        header('Location: pending_request.php');
        exit(); // Ensure that no further code is executed after the redirect
    } else {
        $response['success'] = false;
        $response['error'] = $conn->error; // Add this line to get the specific error
    }
} else {
    $response['success'] = false;
    $response['error'] = 'Missing applicant ID';
}

echo json_encode($response);
?>
