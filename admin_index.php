<?php include 'connection.php'; 
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="assets/plugins/fontawesome-free/css">
 <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
<link rel="stylesheet" href="styles/admin_index.css">
<style>
    /* Add this style to position the open button */
    .openbtn {
      position: fixed;
      top: 15px; /* Adjust the top position as needed */
      left: 30px; /* Adjust the left position as needed */
      z-index: 2; /* Ensure the button is above other elements */
    }
  </style>
</head>
<body>

<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <img id="sidebar-logo" src="image/maningning.jpg" alt="Dashboard logo,."> 

    <!--function of sidebar  -->
  <a href="javascript:void(0)" onclick="loadContent('admin_dashboard.php')">Home</a>
  <a href="javascript:void(0)" onclick="loadContent('admin_profile.php')">Profile</a>
  <a href="javascript:void(0)" onclick="loadContent('admin_docs.php')">Document</a>      
  <a href="javascript:void(0)" onclick="loadContent('admin_pending_reg.php')">Permission</a>  
  <a href="javascript:void(0)" onclick="loadContent('admin_app_list.php')">Applicants</a>
  <a href="javascript:void(0)" onclick="loadContent('admin_activity_log.php')">Activity Log</a>
  <a class="menu-start" href="javascript:void(0)" onclick="loadContent('settings.php')">Settings</a>
   
</div>

<div id="main">
  <button class="openbtn" onclick="openNav()">☰</button>
  <div id="content-container">
    <?php include 'admin_dashboard.php'; ?>
  </div>
</div>
<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.getElementsByClassName("openbtn")[0].style.display = "none"; // Hide open button
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
  document.getElementsByClassName("openbtn")[0].style.display = "block"; // Show open button
}

// Function to load content
function loadContent(page) {
  
  $.ajax({
    url: page,
    type: 'GET',
    success: function(data) {
      $('#content-container').html(data);
    }
  });
}
</script>
</body>
</html>