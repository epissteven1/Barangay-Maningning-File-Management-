<?php
// Include your database connection file
include 'connection.php';

// Get the search query from Ajax
$searchQuery = $_POST['search'];

// Query the database to get the filtered list of documents
$query = "SELECT pr.request_id, pr.applicant_id, pr.reason, pr.status, pr.request_date, pm.message, a.applicant_id AS applicant_id, pr.file_id
    FROM permission_requests pr
    LEFT JOIN applicants a ON pr.applicant_id = a.applicant_id
    LEFT JOIN (
        SELECT applicant_id, MAX(timestamp) AS max_message_date
        FROM permission_messages
        GROUP BY applicant_id
    ) pm_max ON pr.applicant_id = pm_max.applicant_id
    LEFT JOIN permission_messages pm ON pr.applicant_id = pm.applicant_id AND pm.timestamp = pm_max.max_message_date
    LEFT JOIN documents d ON pr.file_id = d.file_id
    WHERE  pm.message LIKE '%$searchQuery%' OR a.applicant_id LIKE '%$searchQuery%' AND pr.status IN ('Accepted', 'Pending')";

$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['applicant_id']}</td>
                <td>{$row['message']}</td>
                <td>";

        if ($row['status'] === 'Accepted') {
            echo '<a href="download.php?file_id=' . $row['file_id'] . '" class="btn btn-success">Download</a>';
        } elseif ($row['status'] === 'Pending') {
            // Display delete button if status is 'Pending'
            echo '<a href="delete_request.php?request_id=' . $row['request_id'] . '" class="btn btn-danger">Delete</a>';



        }

        echo "</td></tr>";
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    echo "<tr>
            <td colspan='4'>No Record Found</td>
          </tr>";
}

// Close the database connection
mysqli_close($conn);
?>
