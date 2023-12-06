<?php include 'connection.php' ; 
include 'function.php';
include 'document_counts.php'; 
include 'get_time_request.php';
include 'includes/session.php';?> 

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
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="admindashboard.php">BMFMS</a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="image/Sogod.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-view-list"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
              <i class="ti-bell mx-0"></i>
              <span class="count ml-3
              "></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <span class="mb-0 font-weight-normal float-left dropdown-header ml-2"><h4> <?php echo getTotalNotificationCount($conn); ?> Notifications</h4></span>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-success">
                    <i class="ti-files menu-icon "></i>
                  </div>
          
                  <?php
            list($permissionCount, $documentCount) = getRealTimeNotificationsCount($conn);
        ?>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal mr-2"> <?php echo $permissionCount; ?> new messages</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                  <?php echo timeElapsedString($timestamp); ?>
                  </p>
                </div>
              </a>
              
          
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                  <div class="item-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="item-content">
                  <h6 class="font-weight-normal"><?php echo $documentCount; ?> documents uploaded</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                  <?php echo timeElapsedString($datetime); ?>
                  </p>
                </div>
              </a>
            </div>
          </li>
   <script>
         setInterval(function() {
    // Use AJAX to fetch new notifications counts from the server
    // Update the notification count and content
    fetch('function.php') // Create a new PHP file for real-time updates
        .then(response => response.json())
        .then(data => {
            document.getElementById('notification-count').innerHTML = data.totalCount;

            // Check if there are unseen notifications
            if (data.totalCount > 0) {
                // Display some visual indicator for unseen notifications if needed
            }
        });
        }, 5000); // Refresh every 5 seconds (adjust as needed)
        </script>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img class="" src="<?php echo  $row['applicant_profile'];?>" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
                <a  href="#" class="dropdown-item" onclick="confirmLogout()" >
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-view-list"></span>
        </button>
      </div>
    </nav>
    <script>
function confirmLogout() {
            var confirmLogout = confirm("Are you sure you want to logout?");
            if (confirmLogout) {
                // Use AJAX to send a request to the server
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "logout.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                     
                        // Optionally, you can redirect the user to another page
                        window.location.href = "index.php";
                    }
                };
                xhr.send("logout=true");
            }
        }
</script>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item mt-3">
            <a class="nav-link" href="applicant_index.php">
              <i class="ti-shield menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item mt-3">
            <a class="nav-link" href="profile_card.php">
              <i class=" ti-user menu-icon"></i>
              <span class="menu-title">Profile</span>
            </a>
          </li>
          <li class="nav-item mt-3">
            <a class="nav-link" href="document_list.php">
              <i class="ti-file menu-icon"></i>
              <span class="menu-title">Documents</span>
            </a>
          </li>
          <li class="nav-item mt-3">
            <a class="nav-link" href="applicant_request.php">
              <i class="ti-files menu-icon"></i>
              <span class="menu-title">Request Documents</span>
            </a>
          </li>
          <li class="nav-item mt-3">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="ti-settings menu-icon"></i>
              <span class="menu-title">Manage Activity Logs</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
               
              <li class="nav-item"> <a class="nav-link" href="applicant_log.php">My Logs</a></li>

              </ul>
            </div>
          </li>
        </ul>
      </nav>