<?php
include 'connection.php';

$sql = "SELECT * FROM applicants WHERE status = 'pending'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Applicants Registration</h1>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Fullname</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        
        echo "<tr>";
        echo "<td>" . $row['fullname'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td><a href='approve.php?id=" . $row['applicant_id'] . "'>Approve</a> | <a href='reject.php?id=" . $row['applicant_id'] . "'>Reject</a></td>";
        echo "</tr>";
    }

    
    echo "</table>";
} else {
    echo "No pending registration requests.";
}

$conn->close();
?>
