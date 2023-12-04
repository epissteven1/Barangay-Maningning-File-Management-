<?php include 'function.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">

    <title>Notifications</title>
</head>
<body>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span id="notification-count" class="badge badge-warning navbar-badge">
            <?php echo getTotalNotificationCount($conn); ?>
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">
            <?php echo getTotalNotificationCount($conn); ?> Notifications
        </span>
        <div class="dropdown-divider"></div>

        <!-- Fetch and display real-time notifications counts from the database -->
        <?php
            list($permissionCount, $documentCount) = getRealTimeNotificationsCount($conn);
        ?>
        <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <?php echo $permissionCount; ?> new messages
            <span class="float-right text-muted text-sm">Real-time</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> <?php echo $documentCount; ?> documents uploaded
            <span class="float-right text-muted text-sm">Real-time</span>
        </a>

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>
  </nav>
</div>

<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="assets/dist/js/adminlte.js"></script>

<script>
// Simulate real-time updates using JavaScript interval
setInterval(function() {
    // Use AJAX to fetch new notifications counts from the server
    // Update the notification count and content
    fetch('get_realtime_notifications.php') // Create a new PHP file for real-time updates
        .then(response => response.json())
        .then(data => {
            document.getElementById('notification-count').innerHTML = data.totalCount;
        });
}, 5000); // Refresh every 5 seconds (adjust as needed)
</script>



</body>
</html>
