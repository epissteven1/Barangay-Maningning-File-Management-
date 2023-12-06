  
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include 'includes/applicant_sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold mb-0"><strong class="text-primary">BMFMS </strong> Dashboard</h4>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">applicants</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo getTotalApplicantCount($conn); ?></h3>
                    <i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-3 text-danger"></p>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Total Population</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">292</h3>
                    <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                    <p class="mb-0 mt-3 text-danger"></p>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Documents</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
              
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo getTotalDocumentCount($conn); ?></h3>
                    <i class="ti-folder icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-3 text-danger"></p>
                </div>
              </div>
            </div>
       
            
            <div class="col-md-3 grid-margin stretch-card ">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Total Requests</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo $requestCount;?></h3>
                    <i class="ti-files icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-3 text-danger"></p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  <p class="card-title">Total Population</p>
                  <div class="row">
                    <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-center">
                      <div class="ml-xl-4">
                        <h1>292</h1>
                        <h3 class="font-weight-light mb-xl-4">Maningning</h3>
                        <p class="text-muted mb-2 mb-xl-0">The total Population number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                      </div>  
                    </div>
                    <div class="col-md-12 col-xl-9">
                      <div class="row">
                        <div class="col-md-6 mt-3 col-xl-5">
                          <canvas id="north-america-chart"></canvas>
                          <div id="north-america-legend"></div>
                        </div>
                        <div class="col-md-6 col-xl-7">
                          <div class="table-responsive mb-3 mb-md-0">
                          <table class="table table-borderless report-table">
                              <tr>
                                <td class="text-muted">14 Below</td>
                                <td class="w-100 px-0">
                                  <div class="progress progress-md mx-4">
                                    <div class="progress-bar" role="progressbar" style="width: 70%; background-color: #FF6384;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </td>
                                <td><h5 class="font-weight-bold mb-0">48</h5></td>
                              </tr>
                              <tr>
                              <td class="text-muted">15-30</td>
                              <td class="w-100 px-0">
                                <div class="progress progress-md mx-4">
                                  <div class="progress-bar" role="progressbar" style="width: 30%; background-color: #36A2EB;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td><h5 class="font-weight-bold mb-0">59</h5></td>
                            </tr>
                            <tr>
                              <td class="text-muted">31-59</td>
                              <td class="w-100 px-0">
                                <div class="progress progress-md mx-4">
                                  <div class="progress-bar" role="progressbar" style="width: 95%; background-color: #FFCE56;" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td><h5 class="font-weight-bold mb-0">147</h5></td>
                            </tr>
                            <tr>
                              <td class="text-muted">Senior cititzen</td>
                              <td class="w-100 px-0">
                                <div class="progress progress-md mx-4">
                                  <div class="progress-bar" role="progressbar" style="width: 60%; background-color: #4CAF50;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td><h5 class="font-weight-bold mb-0">38</h5></td>
                            </tr>
                            <tr>
                              <td class="text-muted">No. Of Household</td>
                              <td class="w-100 px-0">
                                <div class="progress progress-md mx-4">
                                  <div class="progress-bar" role="progressbar" style="width: 40%; background-color: #FF9800;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td><h5 class="font-weight-bold mb-0">78</h5></td>
                            </tr>
                            <tr>
                              <td class="text-muted">No. Of family</td>
                              <td class="w-100 px-0">
                                <div class="progress progress-md mx-4">
                                  <div class="progress-bar" role="progressbar" style="width: 75%; background-color: #9C27B0;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td><h5 class="font-weight-bold mb-0">85 </h5></td>
                            </tr>
                          </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">BMFMS SYSTEM <a href="#" > ADB </a> projects</span>
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

  
<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Sample data from your table
    var data = {
     
      datasets: [{
        data: [48, 59, 147, 38, 78, 85],
        backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4CAF50", "#FF9800", "#9C27B0"],
        hoverBackgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4CAF50", "#FF9800", "#9C27B0"],
      }],
    };

    // Get the canvas element and render the doughnut chart
    var ctx = document.getElementById("north-america-chart").getContext("2d");
    var myDoughnutChart = new Chart(ctx, {
      type: "doughnut",
      data: data,
      options: {
        responsive: true,
        legend: {
          display: true,
          position: "bottom",
          labels: {
            boxWidth: 20,
          },
        },
      },
    });
  });
</script>

</body>


</html>