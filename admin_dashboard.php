  <?php include 'connection.php';

session_start(); // Start the session

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    
    // Now $admin_id contains the admin_id of the logged-in user
    // You can use this ID to fetch the user's data from the database

    $query = "SELECT * FROM admin_tb WHERE admin_id = $admin_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>

    <meta charset="UTF-8">
    <title>Admin Dashboard</title>



    <link rel="stylesheet" href="styles/normalize.css">
    <!-- <link rel="stylesheet" href="styles/style.css"> -->
    <script src="scripts/generate-elements.js" defer></script>
  </head>
  <body>
    

  
    <header id="main-header">
      <nav id="topbar">
        <img src="images/magnify.svg" alt="Search icon, a magnifying glass.">
        <input type="text" name="search" id="search-bar">
        <img src="images/bell-outline.svg" alt="Alert icon, a bell.">
        <img class="profile-picture" src="<?php echo $row['admin_profile_pic']; ?>"alt="A profile picture">
        <div class="dropdown">
    <button onclick="myFunction()" class="dropbtn"><?php echo $row['fullname']; ?></button>
    <div id="myDropdown" class="dropdown-content">
      <a href="#">Wapa</a>
      <a href="#">Wapa</a>
      <a href="#" onclick="confirmLogout()">Logout</a>
    </div>
  </div>

      </nav>  
      <section id="opener">
        <img class="profile-picture" src="<?php echo $row['admin_profile_pic']; ?>" alt="A profile picture ">
        <div id="greeting">
          <h5>Hi there,</h5>
          <h1>Admin (@<?php echo $row['fullname']; ?>)</h1>
        </div>
        <button type="button">New</button>
        <button type="button">Upload</button>

      </section>
    </header>
    <main>
      <section id="projects">
        <h2>Projects</h2>
        <div id ="project-preview">
          <article>
            <h3>Total OF Users</h3>
            <p>500.</p>
          </article>
          <article>
            <h3>Total Project</h3>
            <p>50.</p>
          </article>
          <article>
            <h3>Total Document</h3>
            <p>100</p>
          </article>
          <article>
            <h3>Total financial Records</h3>
            <p>50</p>
          </article>
          <article>
            <h3>Ad Blocker</h3>
            <br>
            <p>Pag Premium</p>
          </article>
          <article>
            <h3>Random</h3>
            <p>huwat sah tah kay libog pa aria dapita hah</p>
          </article>
        </div>
      </section>
      <section id="announcements">
        <h2>SLSU</h2>
        <div id="announcement-preview">
          <article>
            <h3>Vision</h3>
          <h2> <p>By 2040, Southern Leyte State University is a </p> 
          <p> higher education institution that advances knowledge and will be known for </p>
          <p>  innovation and compassion for humanity, creating an inclusive society and a sustainable world.</p></h2>
          </article>
          
          </article>
        </div>
      </section>
      <section id="trending">
          <h2>Mission</h2>
          <div id="trending-preview">
            
          </div>
      </section>
      
    </main>
  </body>

  <script>
  /* When the user clicks on the button, 
  toggle between hiding and showing the dropdown content */
  function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }

  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
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

  </html>
