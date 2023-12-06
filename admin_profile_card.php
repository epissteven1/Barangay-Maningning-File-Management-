<?php  
include 'modal/admin_view_modal.php';
include  'modal/admin_edit_modal.php';
include 'includes/admin_session.php';
include 'admin_change_form.php';


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



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];

    // Include the database connection
    include 'connection.php';

    // Handle profile picture update
    if ($_FILES["admin_profile_pic"]["size"] > 0) {
        $uploadDir = "admin_uploads/"; // Specify your desired upload directory
        $uploadFile = $uploadDir . basename($_FILES["admin_profile_pic"]["name"]);

        // Check if the file is a valid image
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $allowedExtensions)) {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["admin_profile_pic"]["tmp_name"], $uploadFile)) {
                // Check if the user already has a profile picture in the database
                $checkSql = "SELECT * FROM admin_tb WHERE admin_id = $admin_id";
                $result = $conn->query($checkSql);

                if ($result) {
                    if ($result->num_rows > 0) {
                        // User already has a profile picture, update the record
                        $updateSql = "UPDATE admin_tb SET admin_profile_pic = ? WHERE admin_id = ?";
                        $updateStmt = $conn->prepare($updateSql);
                        $updateStmt->bind_param("si", $uploadFile, $admin_id);
                        $updateStmt->execute();

                        echo "Profile picture updated successfully!";
                        
                        // Close the update statement
                        $updateStmt->close();
                    } else {
                        // User doesn't have a profile picture, insert a new record
                        $insertSql = "INSERT INTO admin_tb (admin_id, admin_profile_pic) VALUES (?, ?)";
                        $insertStmt = $conn->prepare($insertSql);

                        if ($insertStmt) {
                            $insertStmt->bind_param("is", $admin_id, $uploadFile);
                            $insertStmt->execute();

                            echo "Profile picture uploaded successfully!";
                            
                            // Close the insert statement
                            $insertStmt->close();
                        } else {
                            echo "Error preparing the INSERT statement: " . $conn->error;
                        }
                    }
                } else {
                    echo "Error executing the SELECT query: " . $conn->error;
                }
            } else {
                echo "Error uploading the profile picture.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    }

    // Handle user information update
    $name = $_POST['firstname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    

    $sql = "UPDATE admin_tb SET fullname=?, username=?, email=? WHERE admin_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $name, $username, $email, $admin_id);
    $stmt->execute();
    
    // Close the update statement
    $stmt->close();
    
    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">

  <link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>

<!--Bootstrap 5 icons CDN-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  
        <title>Document</title>
</head>
    <body>
        <div class="container-scroller">
            <?php include  'includes/admin_sidebar.php';?>
  
    
            <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-lg" style="width: 100%; position: fixed; top: 0; left: 10px; z-index: 1000;">
  <!-- Your content here -->
</div>

<div class="content-fluid" style="margin-left: 20px; width: 80%; height: 90vh;"> <!-- Adjust padding-top to match the header's height -->
 
            <div class="row">
                <div class="col-lg-12 mt-5 pt-5" >
                    <div class="row z-depth-3">
                        <div class="col-md-3  bg-info">
                            <div class="card-block text-center text-white">
                            <img class="mask ml-3 mr-3 mt-4" style="background-color: hsla(0, 0%, 0%, 0.6); border-radius: 50%; width: 150px; height: 150px; object-fit: cover;" src="<?php echo $row['admin_profile_pic']; ?>" alt="A profile picture">

                                <h2 class="font-weight-bold mt-2 pt-5"><?php echo $row['fullname']; ?></h2>
                                <h4><p>Admin</p></h4>   
     
                  
                            
                            </div> 
                        </div>
                        <div class="col-sm-8 bg-white rounded-right">
                            <h1 class="text-center font-weight-bold mt-3 mb-5 ">Information</h1>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <p class="font-weight-bold">Name:</p>
                                    <h6 class="text-muted"><?php echo $row['fullname']; ?></h6>
                                
                                </div>
                                <div class="col-sm-6">
                                    <p class="font-weight-bold">UserName:</p>
                                    <h6 class="text-muted"><?php echo $row['username']; ?></h6>
                              
                                </div>
                            
                                <div class="col-sm-6">
                                    <p class="font-weight-bold">Email:</p>
                                    <h6 class="text-muted"><?php echo $row['email']; ?></h6>
                              
                                </div>
                            

                                <div class="col-sm-6">
                            <p class="font-weight-bold">Password:</p>
                            <div class="input-group">
                                <h6 class="text-muted" id="displayedPassword" data-type="password">********</h6>
                                
                            </div>
                        </div>


                            </div>
                        
                            <hr class="bg-primary">
                                   <ul class="list-unstyled d-flex justify-content-center mt-4 mr-5">
                                    <li><button class="btn btn-success mr-4" onclick="readInfo()" data-bs-toggle="modal" data-bs-target="#readData "><i class="ti-eye "></i></button>
                                    </i></a></li>
                                    <li><button class="btn btn-primary mr-4" onclick="editInfo()" data-bs-toggle="modal" data-bs-target="#userForm"><i class="ti-pencil-alt"></i></button></i></a></li>
                                    <li><button class="btn btn-danger " onclick="openChangePasswordModal()" data-bs-toggle="modal" data-bs-target="#modal"><i class="ti-unlock"></i></i></button></i></a></li>
                                </ul>
                          

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    
</body>
 <!-- plugins:js -->
 <script src="template/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="template/vendors/chart.js/Chart.min.js"></script>
  <script src="template/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="template/js/off-canvas.js"></script>
  <script src="template/js/hoverable-collapse.js"></script>
  <script src="template/js/template.js"></script>
  <script src="template/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="template/js/dashboard.js"></script>
  <!-- End custom js for this page-->

 

<script>
    function editInfo() {
    // Create a FormData object from the form with the id 'profileForm'
    var formData = new FormData($('#profileForm')[0]);

    // Use jQuery AJAX to send the form data to 'profile_card.php'
    $.ajax({
        type: 'POST',
        url: 'admin_profile_card.php',
        data: formData,
        contentType: false, // To prevent jQuery from automatically setting the content type
        processData: false, // To prevent jQuery from automatically processing the data
        success: function(response) { 
            // Parse the JSON response from the server
            var data = JSON.parse(response);

            // Check if the update was successful
            if (data.success) {
                // Update the profile picture on the page
                $('#profile-picture').attr('src', data.profilePicture);
            } else {
                // Display an alert if the update fails
                alert('Failed to update profile information.');
            }
        },
        error: function(xhr, status, error) {
            // Log an error message if the AJAX request encounters an error
            console.error('AJAX Error:', status, error);
        }
    });
}

</script>
</html>