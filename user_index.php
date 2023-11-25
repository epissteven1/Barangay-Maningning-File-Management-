
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="user_styles/dash.css">
    <link rel="stylesheet" href="user_styles/applicant_profile.css">
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
            overflow-y: scroll;
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
            background-color: #111;
            color: white;
            padding: 10px 15px;
            border: none;
        }
                        .submenu {
                    display: none;

                    padding-top: 10px;
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

                .submenu a:hover {
                    background-color: #555;
                }
    </style>
</head>
<body>

    <div id="mySidebar" class="sidebar">
        <a href="#" class="closebtn" onclick="closeNav()">×</a>
        <img id="sidebar-logo" src="image/maningning.jpg" alt="Dashboard logo,">
        <a href="#" onclick="loadContent('dashboard.php')">Home</a>
        <a href="#" onclick="loadContent('applicant_profile.php')">Profile</a>
        <a href="#" onclick="loadContent('document_list.php')">Document</a>      
        <a href="#" onclick="loadContent('applicant_request.php')">Request Documents</a>  
        <a href="#" onclick="loadContent('applicant_activity_log.php')">History</a>
        <a class="menu-start" href="#" onclick="toggleSubMenu()">Settings</a>
        <div id="submenu" class="submenu">
        <a href="#" onclick="openChangePasswordModal()">Change Password</a>
        <a href="#" onclick="confirmLogout()">Logout</a>
        <!-- Add more submenu items as needed -->
</div>
    </div>

    <div id="main">
       
        <div id="content-container">
            <?php include 'dashboard.php'; ?>
            <!-- Include your content here -->
        </div>
          <?php include 'change_password_form.php'; ?>
        <button class="openbtn" onclick="toggleNav()">☰</button>
    </div>
    



<!-- Include your script with initializeDashboardJS -->
<script src="../File Management/scripts/initializeDashboardJS.js"></script>

<!-- Include your script with initializeButtons -->
<script src="../File Management/scripts/initializeButtonsScript.js"></script>
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
                        window.location.href = "applicant_form.php";
                    }
                };
                xhr.send("logout=true");
            }
        }


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
    submenu.style.display = (submenu.style.display === "block") ? "none" : "block";
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
                    $('#content-container').css('overflow-y', 'scroll');

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
