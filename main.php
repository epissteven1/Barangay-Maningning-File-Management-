<?php  include 'includes/session.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportStock Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="admin-styles.css">
    <style>
        /* Sidebar Styles */
        .main-content {
            transition: margin-left 0.3s;
        }

        .main-content.sidebar-open {
            margin-left: 225px; /* Adjust this value according to your sidebar width */
        }
   </style>
<body>
    <header>
        <!-- Button to toggle the sidebar -->
        <button id="toggleSidebarButton" class="toggle-button"><i class="fas fa-bars"></i></button>
      
    </header>
    <!-- Sidebar -->
    <div class="sidebar">
        <div style="width: 125px; height: 125px; overflow: hidden; border-radius: 50%; position: relative; margin: 0 auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <img class="img-circle" src="image/maningning.jpg" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <center><p style="position: relative; margin: 0 auto; padding: 5px;">Hi! <?php echo $row['fullname'];?></p></center>
        <a href="dashboard.php" id="home-button" class="active" style=" border-top: 4px solid #80522F;"><i class="fas fa-home"></i> Home</a>
        <a href="profile_card.php" id="equipment-button"><i class="fas fa-dumbbell"></i>Profile</a>
        <a href="document_list.php" id="user-button"><i class="fas fa-users"></i>Documents</a>
        <a href="applicant_request.php" id="borrowing-button"><i class="fas fa-chart-bar"></i> Request Documents</a>
        <a href="applicant_activity_log.php" id="settings-button"><i class="fas fa-running"></i> Activity Log</a>
        <a id="logout-button" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        <button id="closeSidebarButton" class="close-button"><i class="fas fa-times"></i></button>
    </div>
    <main class="main-content">
    <div class="overlay"></div>
    </main> 
    
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




const toggleButton = document.querySelector('.toggle-button');
const closeButton = document.querySelector('.close-button');
const body = document.body;

toggleButton.addEventListener('click', function () {
  if (body.classList.contains('sidebar-open')) {
    body.classList.remove('sidebar-open');
  } else {
    body.classList.add('sidebar-open');
  }
});

closeButton.addEventListener('click', function () {
  body.classList.remove('sidebar-open');
});
  
    closeButton.addEventListener('click', function() {
      body.classList.remove('sidebar-open');
    });
// Sidebar code
  
const toggleSidebarButton = document.getElementById("toggleSidebarButton");
const closeSidebarButton = document.getElementById("closeSidebarButton");
const sidebar = document.querySelector(".sidebar");
const mainContent = document.querySelector(".main-content");

toggleSidebarButton.addEventListener("click", function () {
    sidebar.style.left = "0";
    closeSidebarButton.style.display = "block";
    mainContent.style.marginLeft = "225px";
    mainContent.style.marginRight = "-225px";
});

closeSidebarButton.addEventListener("click", function () {
    sidebar.style.left = "-250px";
    closeSidebarButton.style.display = "none";
    mainContent.style.marginLeft = "0";
    mainContent.style.marginRight = "0";
});

const sidebarButtons = [
    document.getElementById("home-button"),
    document.getElementById("equipment-button"),
    document.getElementById("user-button"),
    document.getElementById("borrowing-button"),
    document.getElementById("settings-button"),
    document.getElementById("logout-button")
];

sidebarButtons.forEach(function (button) {
    button.addEventListener("click", function () {
        sidebar.style.left = "-250px";
        closeSidebarButton.style.display = "none";
        mainContent.style.marginLeft = "0";
        mainContent.style.marginRight = "0";
    });
});
</script>
</body>
</html>
