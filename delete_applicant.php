<?php
include 'connection.php';

$response = array();

if (isset($_GET['id'])) {
    $applicantId = $_GET['id'];

    // Delete applicant from the database
    $deleteQuery = "DELETE FROM applicants WHERE applicant_id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param('i', $applicantId);
    
    if ($deleteStmt->execute()) {
        $response['success'] = true;
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
