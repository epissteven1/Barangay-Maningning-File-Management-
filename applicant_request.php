<?php
// Start the session
session_start();

// Include your database connection file
include 'connection.php';

// Check if the user is authenticated
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect to the login page if not authenticated
    exit();
}

// Get the current applicant_id from the session
$applicant_id = $_SESSION['id'];

// Fetch pending requests and associated messages from the database
$sql = "SELECT pr.request_id, pr.applicant_id, pr.reason, pr.status, pr.request_date, pm.message, a.applicant_id AS applicant_id, pr.file_id
    FROM permission_requests pr
    LEFT JOIN applicants a ON pr.applicant_id = a.applicant_id
    LEFT JOIN (
        SELECT applicant_id, MAX(timestamp) AS max_message_date
        FROM permission_messages
        GROUP BY applicant_id
    ) pm_max ON pr.applicant_id = pm_max.applicant_id
    LEFT JOIN permission_messages pm ON pr.applicant_id = pm.applicant_id AND pm.timestamp = pm_max.max_message_date
    LEFT JOIN documents d ON pr.file_id = d.file_id
    WHERE pr.status = 'Accepted' OR pr.status = 'Pending'";

     $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <title>Permission Requests</title>
    <style>
         body {
            font-family: Arial, sans-serif;
          
        
                }
        .container {
            width: 1000px;
            height: 1000px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
            
            
        }
        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
       
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
           
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        a:hover {
            color: #1e87db;
        }
    </style>
</head>
<body>
    


<h2>Permission Requests</h2>
  <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Applicant Registered</h3>

                    <div class="card-tools">
                        <form method="get">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search" value="<?php echo isset($_GET['table_search']) ? htmlspecialchars($_GET['table_search']) : ''; ?>">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
    
        <th>Message</th>
        <th>Action</th>
        /tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'connection.php';

                            // Handle search
                            $search = isset($_GET['table_search']) ? '%' . $_GET['table_search'] . '%' : '%';
                            $query = "SELECT * FROM applicants WHERE fullname LIKE ? OR username LIKE ? OR email LIKE ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('sss', $search, $search, $search);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($row = $result->fetch_assoc()) {
        echo '<tr>';
      
        echo '<td>' . $row['message'] . '</td>';
        
    
        echo '<td>';
      
        // Display download button if status is 'Accepted'
       // Display download button if status is 'Accepted'
if ($row['status'] === 'Accepted') {
    
    echo '<a href="download.php?file_id=' .$row['file_id']. '">Download</a>';
    
            
        } elseif ($row['status'] === 'Pending') {
            // Display delete button if status is 'Pending'
            echo '<a href="delete_request.php?request_id=' . $row['request_id'] . '">Delete</a>';
             
        }
        
        echo '</td>';
        echo '</tr>';
    }
    ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<script>


</script>
</html>