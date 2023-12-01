<?php
include('connection.php');


// Get the search query
$query = isset($_REQUEST['search']) ? $_REQUEST['search'] : '';

// Perform a search query
$sql = "SELECT  permission_requests.applicant_id, permission_requests.request_id, applicants.fullname, applicants.username, permission_requests.request_date
FROM applicants
INNER JOIN permission_requests ON applicants.applicant_id = permission_requests.applicant_id 
WHERE (applicants.applicant_id LIKE '%$query%' OR applicants.fullname LIKE '%$query%' OR applicants.username LIKE '%$query%') AND permission_requests.status = 'Pending'";


$result = $conn->query($sql);

// Display search results
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>{$row['applicant_id']}</td>
        <td>{$row['fullname']}</td>
        <td>{$row['username']}</td>
        <td>{$row['request_date']}</td>
        <td>
         <a href='accept_request.php?action=accept&request_id= {$row['request_id']}'class='btn btn-success'>Accept</a> 
         <a href='reject_request.php?action=reject&request_id= {$row['request_id']}' class='btn btn-danger'>Reject</a>
         <td>
        <tr>";
        
       
       
    }
} else {
    echo "No results found.";
}

$conn->close();
?>
