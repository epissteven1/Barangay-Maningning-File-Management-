<?php
include 'connection.php';

$sql = "SELECT * FROM permission_requests WHERE status = 'Pending'";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    // Initialize an indexed array for notifications
    $notifications = array();

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $notifications[] = array(
            'request_id' => $row["request_id"],
            'reason' => $row["reason"]
        );
    }

    // Add the indexed notifications array to the response
    $response['notifications'] = $notifications;
}

// Add the count to the response
$response['count'] = isset($notifications) ? count($notifications) : 0;

// Output the JSON response
echo json_encode($response);

$conn->close();
?>
