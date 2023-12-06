<?php
// Include your database connection file
include 'connection.php';



 $searchQuery = isset($_REQUEST['search']) ? $_REQUEST['search'] : '';

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
// Check if no records were found
if (mysqli_num_rows($result) == 0) {
    echo "<tr>
            <td colspan='3' style='text-align:center; font-weight: bold; color: red'>No Record Found</td>
          </tr>";
} else {
    // Display records
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['applicant_id']}</td>
                <td>{$row['message']}</td>
                <td>";

        if ($row['status'] === 'Accepted') {
            echo '<a href="download.php?file_id=' . $row['file_id'] . '" class="btn btn-success">Download</a>';
            
            echo "<button class='btn btn-danger' onclick=\"deleteApproveDocument(" . $row['request_id'] . ")\">Delete</button>";
        } elseif ($row['status'] === 'Pending') {
            // Display delete button if status is 'Pending'
            echo "<button class='btn btn-danger' onclick=\"deleteDocument(" . $row['request_id'] . ")\">Delete</button>";
        }

        echo "</td></tr>";
    }
}

// Free the result set
mysqli_free_result($result);

// Close the database connection
mysqli_close($conn);
?>
<script>
function deleteDocument(request_id) {
    if (confirm('Are you sure you want to remove this Pending Request Document?')) {
    window.location.href = "delete_request.php?request_id=" +   request_id;

     // Use the applicantId in the data for the AJAX request
     $.ajax({
            type: 'GET',
            url: 'delete_request.php',
            data: { request_id: applicantId },
            success: function(response) { 
              
                var data = JSON.parse(response);
                console.log(data); // Add this line to log the response
                console.log(applicantId);

                if (data.success) {
                    // Use the applicantId in the redirect URL
                    window.location.href = 'applicant_requests.php';
                } else {
                    alert('Failed to delete Document.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
            
        });
    }
}
function deleteApproveDocument(request_id) {
    if (confirm('Are you sure you want to Remove this Approved Request Document?')) {
    window.location.href = "delete_request.php?request_id=" +   request_id;

     // Use the applicantId in the data for the AJAX request
     $.ajax({
            type: 'GET',
            url: 'delete_request.php',
            data: { request_id: applicantId },
            success: function(response) { 
              
                var data = JSON.parse(response);
                console.log(data); // Add this line to log the response
                console.log(applicantId);

                if (data.success) {
                    // Use the applicantId in the redirect URL
                    window.location.href = 'applicant_requests.php';
                } else {
                    alert('Failed to delete Document.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
            
        });
    }
}

                    
</script>
