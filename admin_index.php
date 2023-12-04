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
        body {
            margin: 0;
            font-family: "Lato", sans-serif;
        }

        #content-container {
          
            #content-container {
    height: auto; /* or set a specific height in pixels or another unit */
    max-height: 100vh; /* to ensure it doesn't exceed the viewport height */
    overflow-y: auto;
}

        }

        #main {
            transition: margin-left .5s;
        }

        #mySidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #e8e4c9;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            cursor: pointer;
        }

        #mySidebar a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 20px;
            color: black;
            display: block;
            transition: 0.3s;
        }

        #mySidebar a:hover {
            color: blue;
            
        }

        #mySidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        #main .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #e8e4c9 !important;
            color: rgb(31, 3, 3) !important;
            padding: 10px 15px;
            border: none;
                }
        .submenu {
    display: none;

            
}
.openbtn {
      position: fixed;
      top: 15px; /* Adjust the top position as needed */
      left: 30px; /* Adjust the left position as needed */
      z-index: 2; /* Ensure the button is above other elements */
    }

.submenu a {
    padding: 8px 16px;
    text-decoration: none;
    font-size: 18px;
    color: white;
    display: block;
}


#mySidebar .submenu-indicator {
    font-size: 15px;
    margin-left: 10px;
}

 .submenu-indicator.rotate {
    transform: rotate(90deg);
    transition: transform 0.3s ease-in-out;
}
#mySidebar .submenu a:hover {

    background-color: rgb(193, 201, 174);
}
.submenu a {
    background-color: bisque;
}

    </style>
</head>
<body>

    <div id="mySidebar" class="sidebar">
        <a href="#" class="closebtn" onclick="closeNav()">×</a>
        <img id="sidebar-logo" src="image/maningning.jpg" alt="Dashboard logo,">

         <!--function of sidebar  -->
  <a href="#" onclick="loadContent('admin_dashboard.php')">Home</a>
  <a href="#" onclick="loadContent('admin_profile.php')">Profile</a>
  <a href="#" onclick="loadContent('admin_docs.php')">Document</a>      
  <a href="#" onclick="loadContent('admin_app_list.php')">Applicants</a>     
  <a href="#" onclick="loadContent('admin_activity_log.php')">Activity Log</a>
  <a href="#" onclick="toggleSubMenu()">Permission
  <span id="submenu-indicator" class="submenu-indicator">&#9658;</span>
</a>
  <div id="submenu" class="submenu">
  <a href="#" onclick="loadContent('pending_request.php')">Pending Request</a>
  <a href="#" onclick="loadContent('Aunthentication_request.php')">Authentication Request</a>
        <!-- Add more submenu items as needed -->
</div>
    </div>

    <div id="main">
        <button class="openbtn" onclick="toggleNav()">☰</button>
        <div id="content-container">
            <?php include 'admin_dashboard.php'; ?>
            <!-- Include your content here -->
        </div>
    </div>

    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include your script with initializeDashboardJS -->
<script src="../File Management/scripts/initializeDashboardJS.js"></script>

<!-- Include your script with initializeButtons -->
<script src="../File Management/scripts/initializeButtonsScript.js"></script>
    <script>
      function toggleNav() {
      var sidebar = document.getElementById("mySidebar");
      var main = document.getElementById("main");
      var toggleBtn = document.getElementsByClassName("openbtn")[0];
      var submenu = document.getElementById("submenu");
  
      // Toggle sidebar and main content
      if (sidebar.style.width === "250px") {
          sidebar.style.width = "0";
          main.style.marginLeft = "0";
          toggleBtn.style.display = "block"; // Show the toggle button when sidebar is closed
      } else {
          sidebar.style.width = "250px";
          main.style.marginLeft = "250px";
          toggleBtn.style.display = "none"; // Hide the toggle button when sidebar is open
      }
  }
  function toggleSubMenu() {
    var submenu = document.getElementById("submenu");
    var indicator = document.getElementById("submenu-indicator");

    if (submenu.style.display === "none" || submenu.style.display === "") {
        submenu.style.display = "block";
        setTimeout(function () {
            indicator.classList.add("rotate");
        }, 10); // Add a small delay (e.g., 10 milliseconds)
    } else {
        submenu.style.display = "none";
        indicator.classList.remove("rotate");
    }
}


  function closeNav() {
      var toggleBtn = document.getElementsByClassName("openbtn")[0];
      var sidebar = document.getElementById("mySidebar");
      var main = document.getElementById("main");
  
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
      toggleBtn.style.display = "block"; // Show the toggle button when sidebar is closed
  }
  
  function loadContent(page) {
    var toggleBtn = document.getElementsByClassName("openbtn")[0];

                $.ajax({
                url: page,
                type: 'GET',
                success: function (data) {
                    $('#content-container').html(data);
                    $('#content-container').css('height', '100%');
                    $('#content-container').css('overflow-y', 'auto');

                    // Set scroll position to the top
                    $('#content-container').scrollTop(0);

                    // Reinitialize JavaScript for the specific content
                    if (page === 'dashboard.php') {
                        console.log('Initializing dashboard functionality...');
                        initializeDashboardJS();
                    }

                    // Show toggle button after content is loaded, and if the sidebar is closed
                    var sidebar = document.getElementById("mySidebar");
                    var toggleBtn = document.getElementById("toggleBtn");

                    if (sidebar.style.width === "0") {
                        toggleBtn.style.display = "block";
                    } else {
                        toggleBtn.style.display = "none";
                    }

                    // Reapply any necessary functionality for buttons or interactive elements
                    initializeButtons();

                    // Check if a specific condition is met (e.g., successful profile picture upload)
                    // and reload the page if needed
                    if (shouldReloadPage()) {
                        window.location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                },
                complete: function () {
                    // Ensure that all scripts are loaded and executed before considering the content fully loaded
                    $(document).trigger("contentloaded");
                }
            });

            function shouldReloadPage() {
                // You can implement your condition here, for example, check if a specific form is submitted
                // and return true if a reload is needed, otherwise return false.
                // Example: return $("#profilePictureForm").is(":submitted");
                return false;
            }

            }



</script>
</body>
</html>