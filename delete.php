<?php
include 'connection.php';

$response = array();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Delete applicant from the database
    $deleteQuery = "DELETE FROM documents WHERE file_id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param('i', $id);
    
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

