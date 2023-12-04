   <?php 
   include_once 'includes/session.php';
  include 'includes/forscript.php'; 
  include 'includes/forsearch.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
  <!-- Include Lottie library from CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.6/lottie.min.js"></script>
</head>

    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        #sidebar-container {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1;
        }

        #sidebar {
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

        #sidebar a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 20px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        #sidebar a:hover {
            color: #f1f1f1;
        }

        .submenu {
            display: none;
        }

        #sidebar .submenu a {
            padding-left: 40px;
        }

        #content {
            
            /* Adjust this value to match the width of the sidebar */
            transition: margin-left 0.5s;
        }

        .toggle-button {
            font-size: 30px;
            cursor: pointer;
            position: fixed;
            z-index: 2;
            /* Ensure the toggle button is above other content */
            margin-left: 20px;
            margin-top: 20px;
            font-size: 20px;
            cursor: pointer;
            background-color: #e8e4c9;
            color: black;
            padding: 10px 15px;
            border: none;
        }
        .page-content {
            transition: margin-left 0.5s;
        }
    </style>
</head>

<body>

    <div id="sidebar-container">
        <div id="sidebar">
        <div style="width: 125px; height: 125px; overflow: hidden; border-radius: 50%; position: relative; margin: 0 auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <img class="img-circle" src="image/maningning.jpg" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
            <a id="home-button" href="dashboard.php">Home</a>
            <a id="equipment-button" href="profile_card.php">Profile</a>
            <a id="user-button" href="document_list.php">Document</a>
            <a id="borrowing-button" href="applicant_request.php">Request Documents</a>
            <a id="borrowing-button" href="applicant_activity_log.php">History</a>
            <a id="settings-button" href="#" onclick="toggleSubMenu()">Setting</a>
            <div class="submenu">
                <a id="logout-button" onclick="confirmLogout()" href="#">Logout</a>
            </div>
        </div>
        <div class="toggle-button" onclick="toggleSidebar()">&#9776;</div>
    </div>

    <div id="content"  class="page-content">

        <!-- Content area where you can display information when the sidebar is open -->
    </div>


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


    function toggleSidebar() {
        var sidebar = document.getElementById('sidebar');
        var toggleButton = document.querySelector('.toggle-button');
        var content = document.getElementById('content');

        if (sidebar.style.width === '250px') {
            sidebar.style.width = '0';
            toggleButton.style.marginLeft = '20px';
            content.style.marginLeft = '0'; // Adjust the margin to keep the content visible
        } else {
            sidebar.style.width = '250px';
            toggleButton.style.marginLeft = '270px';
            content.style.marginLeft = '250px'; // Adjust the margin to make space for the sidebar
        }
    }

    function toggleSubMenu() {
        var submenu = document.querySelector('.submenu');
        submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
    }
</script>
</body>
</html>
