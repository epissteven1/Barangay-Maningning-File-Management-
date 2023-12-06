<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
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
            <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="ti-search"></i>
                </span>
              </div>
              <input type="search" id="searchInput" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
            
              
            </div>
          </li>
        </ul>
            <div class="col-lg-12 stretch-card">
              <div class="card">
              <div class="card-body">
                  <h4 class="card-title">Pending Request</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                            <thead>
                            <tr>
                            <th>Applicant ID</th>
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>Request Date</th>
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="tableBody">
                                <!-- Dynamic search results will be inserted here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


  
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

  <script>
    $(document).ready(function () {
        // Function to load and display data initially
        function loadData() {
            $.ajax({
                url: "authentication_search.php", // Replace with the actual URL for fetching data
                type: "GET", // Change to GET if that's how your backend is configured
                success: function (response) {
                    // Update the table body with the data
                    $("#tableBody").html(response);
                }
            });
        }

        // Call the function on document ready
        loadData();

        // Listen for changes in the search input
        $("#searchInput").on("input", function () {
            // Get the search query
            var searchQuery = $(this).val();

            // Make an Ajax request to search.php with the search query
            $.ajax({
                url: "authentication_search.php",
                type: "POST",
                data: { search: searchQuery },
                success: function (response) {
                    // Update the table body with the search results
                    $("#tableBody").html(response);
                }
            });
        });
    });
</script>
</body>
</html>