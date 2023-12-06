<?php
include('connection.php');


// Get the search query
$query = isset($_REQUEST['search']) ? $_REQUEST['search'] : '';

// Perform a search query
$sql = "SELECT * FROM applicants WHERE (applicant_id LIKE '%$query%' OR fullname LIKE '%$query%' OR username LIKE '%$query%') AND status = 'Pending' ORDER BY applicant_id DESC";       


$result = $conn->query($sql);

// Display search results
if (mysqli_num_rows($result) == 0) {
    echo "<tr>
            <td colspan='5' style='text-align:center; font-weight: bold; color: red'>No Record Found</td>
          </tr>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                <td>{$row['applicant_id']}</td>
                <td>{$row['fullname']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>
                 <a href='approve.php?action=approve&id=  {$row['applicant_id']}' class='btn btn-success'>Approve</a> 
                 <a href='reject.php?action=reject&id= {$row['applicant_id']}'onclick= 'Reject()' class='btn btn-danger'>Reject</a>
                 
                 <td>
                 
                <tr>";
                
               
               
            }
        }
        

   

$conn->close();
?>

<script>
function Reject(applicant_id) {
    if (confirm('Are you sure you want to Cancel this Registration?')) {
    window.location.href = "reject.php?id=" +applicant_id;

     // Use the applicantId in the data for the AJAX request
     $.ajax({
            type: 'GET',
            url: 'reject.php',
            data: { applicant_id: applicantId },
            success: function(response) { 
              
                var data = JSON.parse(response);
                console.log(data); // Add this line to log the response
                console.log(applicantId);

                if (data.success) {
                    // Use the applicantId in the redirect URL
                    window.location.href = 'authentication_request.php';
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


