<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <title>Document</title>
</head>
<body>
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
                                <th>APPLICANT_ID</th>
                                <th>Fullname</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
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
                                echo "<tr>";
                                echo "<td>{$row['applicant_id']}</td>";
                                echo "<td>{$row['fullname']}</td>";
                                echo "<td>{$row['username']}</td>";
                                echo "<td>{$row['email']}</td>";
                                echo "<td>
                                        <a href='edit.php?id={$row['applicant_id']}' class='btn btn-primary btn-sm'>Edit</a>
                                        <button class='btn btn-danger btn-sm' onclick='deleteApplicant({$row['applicant_id']})'>Delete</button>
                                      </td>";
                                echo "</tr>";
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
       function deleteApplicant(applicantId) {
    if (confirm('Are you sure you want to delete this applicant?')) {
        // Use the applicantId in the URL for the window.location.href
        window.location.href = 'delete_applicant.php?id=' + applicantId;

        // Use the applicantId in the data for the AJAX request
        $.ajax({
            type: 'GET',
            url: 'delete_applicant.php',
            data: { id: applicantId },
            success: function(response) { 
              
                var data = JSON.parse(response);
                console.log(data); // Add this line to log the response
                console.log(applicantId);

                if (data.success) {
                    // Use the applicantId in the redirect URL
                    window.location.href = 'admin_index.php';
                } else {
                    alert('Failed to delete applicant.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
            
        });
    }
}


    </script>
</body>
</html>
