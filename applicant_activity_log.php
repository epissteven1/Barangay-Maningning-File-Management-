<?php
include 'idk.php';

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/acti_logs.css">
      <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <style>
        .container {
            width: 800px!important;
            height:fit-content;
            margin: 50px auto!important;
            background-color: #f9f9f9;
            padding: 20px!important;
            max-height:fit-content;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #333;
            padding: 8px 16px;
            text-decoration: none;
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 0 4px;
            cursor: pointer;
        }

        .pagination a:hover {
            background-color: #ddd;
        }

        .pagination .active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
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

        <div class="pagination">
            <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $page) {
                    echo '<a class="active" href="?page=' . $i . '">' . $i . '</a>';
                } else {
                    echo '<a href="?page=' . $i . '">' . $i . '</a>';
                }
            }
            ?>
        </div>

    </div>
    
<script src="assets/plugins/jquery/jquery.min.js"></script>

<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


<script src="assets/dist/js/adminlte.min.js?v=3.2.0"></script>
</body>
</html>
