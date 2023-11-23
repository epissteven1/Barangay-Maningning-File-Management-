<?php
include "connection.php";

function logActivity($conn, $logMessage) {
    $timestamp = date("Y-m-d H:i:s");
    $logMessage = mysqli_real_escape_string($conn, "$logMessage");
    
    $sql = "INSERT INTO activity_log (timestamp, activity_message) VALUES ('$timestamp', '$logMessage')";
    
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error in logActivity: " . mysqli_error($conn);
        return false;
    }
}

session_start();

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $query = "SELECT * FROM applicants WHERE applicant_id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: applicant_login.php");
    exit();
}

// Handle the form submission to update the profile picture
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $profilePicture = $_FILES['applicant_profile'];

    if ($profilePicture['name']) {
        $targetDirectory = 'applicant_uploads/';
        $targetFile = $targetDirectory . basename($profilePicture['name']);

        move_uploaded_file($profilePicture['tmp_name'], $targetFile);

        $logMessage = "Applicants ID $id uploaded a new profile picture.";
        logActivity($conn, $logMessage);

        $updateQuery = "UPDATE applicants SET applicant_profile = '$targetFile' WHERE applicant_id = $id";
        mysqli_query($conn, $updateQuery);

        // Return a response to the AJAX request
        echo json_encode(['success' => true, 'profilePicture' => $targetFile]);
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="user_styles/applicant_profile.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<div class="container">
    <div class="profile-info">
        <img src="<?php echo $row['applicant_profile']; ?>" alt="Profile Picture" id="profile-picture">
        <h2><?php echo $row['fullname']; ?></h2>
        <p><?php echo $row['email']; ?></p>
    </div>
    <form id="profile-form" enctype="multipart/form-data" class="profile-form">
        <div class="file-upload">
            <input type="file" name="applicant_profile" id="profile-picture-input" style="display: none;" required>
            <button class="upload" type="button" onclick="changeProfilePicture()">Choose File</button>
        </div>
        <button class="update" type="button" onclick="updateProfile()">Update</button>
    </form>
</div>

<script>
function changeProfilePicture() {
    document.getElementById('profile-picture-input').click();
}

function updateProfile() {
    var formData = new FormData($('#profile-form')[0]);

    $.ajax({
        type: 'POST',
        url: 'applicant_profile.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) { 
            var data = JSON.parse(response);
            
            if (data.success) {
                $('#profile-picture').attr('src', data.profilePicture);
            } else {
                alert('Failed to update profile picture.');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
}
</script>
</body>
</html>
