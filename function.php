<?php
// Include your database connection file here
include 'connection.php'; // Replace with your actual file name

// Function to get the notification count for permission messages
function getNotificationCount($conn) {
    $query = "SELECT COUNT(*) as count FROM permission_messages";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

// Function to get the notification count for documents
function getDocumentCount($conn) {
    $query = "SELECT COUNT(*) as count FROM documents";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

// Function to get the total notification count
function getTotalNotificationCount($conn) {
    $permissionCount = getNotificationCount($conn);
    $documentCount = getDocumentCount($conn);
    return $permissionCount + $documentCount;
}

// Function to get real-time notifications count
function getRealTimeNotificationsCount($conn) {
    $permissionCount = getNotificationCount($conn);
    $documentCount = getDocumentCount($conn);
    return [$permissionCount, $documentCount];
}
?>
