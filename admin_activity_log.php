<?php
include 'connection.php';

// Define the number of logs to display per page
$logsPerPage = 10;

// Get the current page number from the URL parameter
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$page = max(1, $page); // Ensure the page number is not less than 1

// Calculate the offset for the database query
$offset = ($page - 1) * $logsPerPage;

// Query the activity logs from the database with pagination
$query = "SELECT * FROM activity_log ORDER BY timestamp DESC LIMIT $logsPerPage OFFSET $offset";
$result = mysqli_query($conn, $query);

// Initialize an empty array to store log entries
$logEntries = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $logEntries[] = $row;
    }
    mysqli_free_result($result); // Free the result set
}

// Query to count the total number of logs for pagination
$query = "SELECT COUNT(*) as total_logs FROM activity_log";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalLogs = $row['total_logs'];
$totalPages = ceil($totalLogs / $logsPerPage);

mysqli_close($conn); // Close the database connection

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <style>
        
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #333;
            padding: 8px 16px;
            text-decoration: none;
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 0 4px;
            cursor: pointer;
        }

        .pagination a:hover {
            background-color: #ddd;
        }

        .pagination .active {
            background-color: #4CAF50;
            color: white;
        }
                .current-page {
            font-weight: bold;
            background-color: yellowgreen;
            color: black;
            font-size: 16px;
            padding: 16px;
            /* Add any additional styling as needed */
        }
    </style>
  <title>BMFM SYSTEM</title>
</head>
<body>
  <div class="container-scroller">
     <?php include 'includes/admin_sidebar.php'; ?>
      <div class="main-panel ml-5">
        <div class="content-fluid ml-5">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold ml-4">Logs</h4>
                </div>
              </div>
            </div>
          </div>
                  <div class="table-responsive">
                    <h4 class="card-title">Applicant Logs</h4>
                    <table class="table table-striped  table-bordered">
                      <thead>
                        <tr>
                          <th>
                            Message
                          </th>
                          <th>
                            Date
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                foreach ($logEntries as $entry) {
                    echo '<tr>';
                    echo '<td class="timestamp">' . htmlspecialchars($entry['activity_message']) . '</td>';
                    echo '<td class="activity">' . htmlspecialchars($entry['timestamp']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        
 
          <div class="pagination">
          <?php
            if ($page > 1) {
                echo '<a href="?page=' . ($page - 1) . '">&laquo; Previous</a>';
            }

            for ($i = max(1, $page - 2); $i <= min($page + 2, $totalPages); $i++) {
                if ($page == $i) {
                    echo '<span class="current-page" onclick="changePageColor(' . $i . ')">' . $i . '</span>';
                } else {
                    echo '<a href="?page=' . $i . '">' . $i . '</a>';
                }
            }

            if ($page < $totalPages) {
                echo '<a href="?page=' . ($page + 1) . '">Next &raquo;</a>';
            }
         
            ?>
               </div>
               </div>
            <script>
    function changePageColor(pageNumber) {
        var currentPage = document.querySelector(".current-page");
        currentPage.style.backgroundColor = "yellow";
        currentPage.style.fontSize = "16px";
      
    }
</script>
 
            
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
</body>

</html>

