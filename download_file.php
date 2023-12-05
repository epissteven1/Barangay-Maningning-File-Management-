
<?php 
include 'connection.php';

                // Check  the action parameter is set
                 if (isset($_GET['action']) && isset($_GET['file_id'])) {
             $action = $_GET['action'];
             $file_id = $_GET['file_id'];

                // Query the database to get the file information
                $query = "SELECT * FROM documents WHERE file_id = $file_id";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                 $row = mysqli_fetch_assoc($result);
                        $file_path = $row['file_uploads'];

                if ($action == 'view') {
                    // Implement logic to display the file content
                    // For example, you can use file_get_contents and echo it
                    $file_content = file_get_contents($file_path);
                    echo $file_content;
                } elseif ($action == 'download') {
                    // Check if the user has permission to download
                    $applicant_id = 1; // Replace with the actual user ID (you might get it from your authentication system)
                    $file_owner_id = $row['file_id']; // Assuming there is a user_id column in your documents table

                    if ($applicant_id == $file_owner_id || is_admin($applicant_id)) {
                        // User is the owner of the file or is an admin, allow download
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
                        readfile($file_path);
                    } 
                        } else {
                            echo 'Invalid action';
                        }
                    } else {
                        echo 'File not found';
                    }

                    // Free the result set
                    mysqli_free_result($result);
                } else {
                    echo 'Invalid request';
                }

                // Close the database connection
                mysqli_close($conn);

                // Function to check if a user is an admin (you can adjust this based on your user roles system)
                function is_admin($applicant_id) {
                    // Implement logic to check if the user is an admin
                    // For example, you might have a 'roles' table with 'admin' role
                    // and you can check if the user has the 'admin' role.
                    // Return true if the user is an admin, false otherwise.
                    // This is just a placeholder, replace it with your actual implementation.
                    return false;
                }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <title>Download</title>
</head>
<body>

</div>
              <!-- /.card -->
             
              <div class= "modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content col-sm-5 ml-5"  >
            <div class="modal-header">
              <h4 class="modal-title">Request Form</h4>
              <button type="button" class="close" data-Sdismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="request_permission.php" method="post">
            <div class="form-group">
                <label for="reason">Reason:</label>
                <input class="form-control" type="text" name="reason" required="">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                <button type="submit" name="reason" class="btn btn-primary">Request Permission</button>
            </div>
        </form>

            </div>
          </div>
            </div>
</body>
<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<script>
   function openDownloadFileModal() {
    $('#modal-default').modal('show');
}


</script>
</html>
