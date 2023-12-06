<?php
include 'connection.php';

$response = array();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $reject = "DELETE FROM applicants WHERE applicant_id = ?";
    $rejectStmt = $conn->prepare($reject);
    $rejectStmt->bind_param('i', $id);
      
    if ($rejectStmt->execute()) {
        $response['success'] = true;
        // Redirect back to applicant_request.php
        header('Location: authentication_request.php');
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


