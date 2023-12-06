<?php
// Include your database connection file here
include 'connection.php'; // Replace with your actual file name

// Function to get real-time document request and registration count
function getRealTimeAdminNotificationsCount($conn) {
    $queryDocumentRequests = "SELECT COUNT(*) as count FROM document_requests WHERE status = 'pending'";
    $resultDocumentRequests = mysqli_query($conn, $queryDocumentRequests);
    $rowDocumentRequests = mysqli_fetch_assoc($resultDocumentRequests);

    $queryRegistrationRequests = "SELECT COUNT(*) as count FROM registration_requests WHERE status = 'pending'";
    $resultRegistrationRequests = mysqli_query($conn, $queryRegistrationRequests);
    $rowRegistrationRequests = mysqli_fetch_assoc($resultRegistrationRequests);

    echo json_encode(['requestDocCount' => $rowDocumentRequests['count'], 'requestRegCount' => $rowRegistrationRequests['count']]);
}
?>

