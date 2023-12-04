<?php
// Include your database connection file here
include 'connection.php'; // Replace with your actual file name

// Include the functions file
include 'function.php';

// Get the total notification count
$totalNotificationCount = getTotalNotificationCount($conn);

// Output the total notification count
echo $totalNotificationCount;
?>
