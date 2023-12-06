<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = 'approved';

    $stmt = $conn->prepare("UPDATE applicants SET status = ? WHERE applicant_id = ?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        header("Location: authentication_request.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
