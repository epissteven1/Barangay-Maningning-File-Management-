<?php 
  include_once 'connection.php';
  session_start();
  

  if (isset($_SESSION['id'])) {
      $id = $_SESSION['id'];


      $query = "SELECT * FROM applicants WHERE applicant_id = $id";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);

          // Debugging statements
  } else {
      header("Location: index.php");
      exit();
  }
  ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="admin-styles.css">

</link>
    <style>

</style>
    <title>Document</title>
</head>
<body>
<!-- Button to toggle the sidebar -->
<button id="toggleSidebarButton" class="toggle-button"><i class="fas fa-bars"></i></button>
    <!-- Sidebar -->
    <div class="sidebar">
    
    <div class="sidebar">
   <!-- Move profile image and name inside this div -->
   <div style="width: 125px; height: 125px; overflow: hidden; border-radius: 50%; position: relative; margin: 0 auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
      <img class="img-circle" src="<?php echo $row['applicant_profile']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
   </div>
   <!-- Move name here -->
   <center><p style="position: relative; margin: 0 auto; padding: 5px;">Hi! <?php echo $row['fullname'];?></p></center>
        <a id="home-button" class="active" style=" border-top: 4px solid #80522F;"><i class="fas fa-home"></i> Home</a>
        <a id="equipment-button"><i class="fas fa-dumbbell"></i> Manage Equipment</a>
        <a id="user-button"><i class="fas fa-users"></i> User Management</a>
        <a id="borrowing-button"><i class="fas fa-chart-bar"></i> Borrowing Records</a>
        <a id="settings-button"><i class="fas fa-running"></i> Activity Log</a>
        <a id="logout-button"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        <button id="closeSidebarButton" class="close-button"><i class="fas fa-times"></i></button>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
      console.log('DOM is fully loaded');
    const toggleButton = document.querySelector('.toggle-button');
    const closeButton = document.querySelector('.close-button');
    const body = document.body;
  
    // Your sidebar buttons
    const homeButton = document.getElementById('home-button');
    const equipmentsButton = document.getElementById('equipment-button');
    const itemsButton = document.getElementById('user-button');
    const profileButton = document.getElementById('borrowing-button');
    const logButton = document.getElementById('settings-button');
    const logoutButton = document.getElementById('logout-button');
  
    toggleButton.addEventListener('click', function() {
      if (body.classList.contains('sidebar-open')) {
        body.classList.remove('sidebar-open');
      } else {
        body.classList.add('sidebar-open');
      }
    });
  
    closeButton.addEventListener('click', function() {
      body.classList.remove('sidebar-open');
    });
  
    // Add event listeners to the sidebar buttons
    const sidebarButtons = [
      homeButton,
      equipmentsButton,
      itemsButton,
      profileButton,
      logButton,
      logoutButton,
    ];
  
    sidebarButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        body.classList.remove('sidebar-open');
      });
    });
  });
</script>
</body>

</html>
