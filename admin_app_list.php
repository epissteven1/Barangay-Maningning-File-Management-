<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>BMFM SYSTEM</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="template/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="template/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="image/Sogod.png" />
</head>
<body>
  <div class="container-scroller">
   <?php include 'includes/admin_sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold mb-0"> Applicant</h4>
                </div>
              </div>
            </div>
            <!-- kuwag ug search -->
          </div>
          <div class="col-lg-12 stretch-card">
              <div class="card">
              <div class="card-body">
                  <h4 class="card-title">REGISTERED APPLICANT</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
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
                            $query = "SELECT * FROM applicants WHERE fullname LIKE ? OR username LIKE ? OR email LIKE ? ORDER BY applicant_id DESC";
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
                                        <a href='edit.php?id={$row['applicant_id']}' class='btn btn-primary btn-md'><i class='ti-pencil-alt'></i> Edit</a>
                                        <button class='btn btn-danger btn-md' onclick='deleteApplicant({$row['applicant_id']})'><i class='ti-trash'></i> Delete</button>
                                      </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="#" >GROUP 5 </a>2023-2024</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">BMFMS SYSTEM <a href="#" > ADDB </a> projects</span>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="template/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="template/vendors/chart.js/Chart.min.js"></script>
  <script src="template/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="template/js/off-canvas.js"></script>
  <script src="template/js/hoverable-collapse.js"></script>
  <script src="template/js/template.js"></script>
  <script src="template/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="template/js/dashboard.js"></script>
  <!-- End custom js for this page-->
  <script src="template/js/file-upload.js"></script>
</body>
<script>
  function deleteApplicant(id) {
    if (confirm('Are you sure you want to delete this File?')) {
    window.location.href = "delete.php?id=" +id;

     // Use the applicantId in the data for the AJAX request
     $.ajax({
            type: 'GET',
            url: 'delete.php',
            data: { id: applicantId },
            success: function(response) { 
              
                var data = JSON.parse(response);
                console.log(data); // Add this line to log the response
                console.log(applicantId);

                if (data.success) {
                    // Use the applicantId in the redirect URL
                    window.location.href = 'admin_index.php';
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
</html>

