
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>
<body>
    <div class="container-scroller">
        <?php include 'includes/applicant_sidebar.php';?>
<div class="container">
<div class="card">
<div class="card-header">
<h3 class="card-title">Documents</h3>
<section class="content"> 
    <div class="row">
            <div class="container-fluid">
                <div class="col-md-7 offset-md-4">
                        <div class="input-group">
                            <input type="search" id="searchInput"  class="form-control form-control-lg" placeholder="Type your keywords here">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="ti-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>

</div>

<div class="card-body">
    <table id="example1" class="table table-bordered">
        <thead>
        
   
        <th>Applicant ID</th>
        <th>Message</th>
        <th>Action</th>
    
        </tr>
        </thead>
        <tbody id="tableBody">
            <!-- Dynamic search results will be inserted here -->
            
        </tbody>
    </table>
</div>
</tfoot>
</table>
</div>
</section>
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
<script src="assets/plugins/jquery/jquery.min.js"></script>

<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


<script src="assets/dist/js/adminlte.min.js?v=3.2.0"></script>

<script>
   $(document).ready(function () {
        // Function to load and display data initially
        function loadData() {
            $.ajax({
                url: "search_req.php", // Replace with the actual URL for fetching data
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
                url: "search_req.php",
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