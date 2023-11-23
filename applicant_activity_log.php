<?php
include('connection.php');

// Query the activity logs from the database
$query = "SELECT * FROM app_activity_log ORDER BY timestamp DESC";
$result = mysqli_query($conn, $query);

// Initialize an empty array to store log entries
$logEntries = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $logEntries[] = $row;
    }
}

mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/acti_logs.css">
    <title>Applicant Activity Log</title>
</head>
<body>
        <h1>History</h1>
        <div class="container">
        <table class="activity-table">
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Activity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($logEntries as $entry) {
                    echo '<tr>';
                    echo '<td class="timestamp">' . htmlspecialchars($entry['timestamp']) . '</td>';
                    echo '<td class="activity">' . htmlspecialchars($entry['activity_message']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>