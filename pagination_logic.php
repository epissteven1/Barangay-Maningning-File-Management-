<?php
include('connection.php');

// Define the number of logs to display per page
$logsPerPage = 20;

// Get the current page number from the URL parameter
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$page = max(1, $page); // Ensure the page number is not less than 1

// Calculate the offset for the database query
$offset = ($page - 1) * $logsPerPage;

// Query the activity logs from the database with pagination
$query = "SELECT * FROM app_activity_log ORDER BY timestamp DESC LIMIT $logsPerPage OFFSET $offset";
$result = mysqli_query($conn, $query);

// Initialize an empty array to store log entries
$logEntries = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $logEntries[] = $row;
    }
    mysqli_free_result($result); // Free the result set
}

// Query to count the total number of logs for pagination
$query = "SELECT COUNT(*) as total_logs FROM app_activity_log";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalLogs = $row['total_logs'];
$totalPages = ceil($totalLogs / $logsPerPage);

mysqli_close($conn); // Close the database connection
?>
