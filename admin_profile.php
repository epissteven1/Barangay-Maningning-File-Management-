<?php
include "connection.php";


function logActivity($conn, $logMessage) {
    $timestamp = date("Y-m-d H:i:s");
    $logMessage = mysqli_real_escape_string($conn, "$logMessage");
    // Insert log entry into the activity_log table

    $sql = "INSERT INTO activity_log (timestamp, activity_message) VALUES ('$timestamp', '$logMessage')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error in logActivity: " . mysqli_error($conn);
        return false;
    }
}


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


// Handle the form submission to update the profile picture
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming the form has an input field named "admin_profile_pic"
    $profilePicture = $_FILES['admin_profile_pic'];

    // Check if a file was uploaded
    if ($profilePicture['name']) {
        // Assuming you have a folder named "admin_uploads" to store the profile pictures
        $targetDirectory = 'admin_uploads/';
        $targetFile = $targetDirectory . basename($profilePicture['name']);

        // Move the uploaded file to the target directory
        move_uploaded_file($profilePicture['tmp_name'], $targetFile);

          // Log the activity
          $logMessage = "Admin ID $admin_id uploaded a new profile picture.";
          logActivity($conn, $logMessage);
  
        // Update the user's profile picture in the database
        $updateQuery = "UPDATE admin_tb SET admin_profile_pic = '$targetFile' WHERE admin_id = $admin_id";
        mysqli_query($conn, $updateQuery);
        
        // Refresh the page to display the updated profile picture
        header("Location: admin_index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/admin_profile.css">
   
  

</head>
<body>
    <div class="container">
        <div class="card">
            <div class="profile-info">
                <img src="<?php echo $row['admin_profile_pic']; ?>" alt="Profile Picture" onclick="changeProfilePicture()">
                <h2><?php echo $row['fullname']; ?></h2>
                <p><?php echo $row['email']; ?></p>
            </div>
            <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div>
                    <input type="file" name="admin_profile_pic" id="profile-picture-input" style="display: none;" required>
                    
                    <!-- <button class="upload" type="button" onclick="changeProfilePicture()"></button> -->
                </div>
                <button class="update" type="submit">ChangeProfilePicture</button>
            </form>
        </div>
    </div>  
</body>
<script>
        function changeProfilePicture() {
            document.getElementById('profile-picture-input').click();
        }
        </script>
</html>
