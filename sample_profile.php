<?php  
include 'modal/admin_view_modal.php';
include  'modal/admin_edit_modal.php';
include 'includes/admin_session.php';


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



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    // Include the database connection
    include 'connection.php';

    // Handle profile picture update
    if ($_FILES["applicant_profile"]["size"] > 0) {
        $uploadDir = "uploads/"; // Specify your desired upload directory
        $uploadFile = $uploadDir . basename($_FILES["applicant_profile"]["name"]);

        // Check if the file is a valid image
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $allowedExtensions)) {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["applicant_profile"]["tmp_name"], $uploadFile)) {
                // Check if the user already has a profile picture in the database
                $checkSql = "SELECT * FROM applicants WHERE applicant_id = $id";
                $result = $conn->query($checkSql);

                if ($result) {
                    if ($result->num_rows > 0) {
                        // User already has a profile picture, update the record
                        $updateSql = "UPDATE applicants SET applicant_profile = ? WHERE applicant_id = ?";
                        $updateStmt = $conn->prepare($updateSql);
                        $updateStmt->bind_param("si", $uploadFile, $id);
                        $updateStmt->execute();

                        echo "Profile picture updated successfully!";
                        
                        // Close the update statement
                        $updateStmt->close();
                    } else {
                        // User doesn't have a profile picture, insert a new record
                        $insertSql = "INSERT INTO applicants (applicant_id, applicant_profile) VALUES (?, ?)";
                        $insertStmt = $conn->prepare($insertSql);

                        if ($insertStmt) {
                            $insertStmt->bind_param("is", $id, $uploadFile);
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
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $civil_status = $_POST['civil_status'];

    $sql = "UPDATE applicants SET fullname=?, username=?, email=?, contact=?, gender=?, age=?, civilstatus=? WHERE applicant_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssi', $name, $username, $email, $contact, $gender, $age, $civil_status, $id);
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
  <style>
        .far.fa-edit:hover{
            background-color: chocolate;
        }
        </style>
  
        <title>Document</title>
</head>
    <body class="bg-light">
      <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-lg">
        <div class="container-fluid position-relative ml-5 ">
            <div class="row d-flex justify-content-end">
                <div class="col-md-9 mt-5 pt-5" >
                    <div class="row z-depth-3">
                        <div class="col-md-3.5 mr-2 bg-info">
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
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="bi bi-eye" id="toggleDisplayedPassword"></i>
            </span>
        </div>
    </div>
</div>


                            </div>
                        
                            <hr class="bg-primary">
                                   <ul class="list-unstyled d-flex justify-content-center mt-4 mr-5">
                                    <li><button class="btn btn-success mr-4" onclick="readInfo()" data-bs-toggle="modal" data-bs-target="#readData "><i class="bi bi-eye "></i></button>
                                    </i></a></li>
                                    <li><button class="btn btn-primary mr-4" onclick="editInfo()" data-bs-toggle="modal" data-bs-target="#userForm"><i class="bi bi-pencil-square"></i></button></i></a></li>
                                    <li><button class="btn btn-danger " onclick="openChangePasswordModal()" data-bs-toggle="modal" data-bs-target="#modal"><i class="fa-solid fa-unlock"></i></i></button></i></a></li>
                                </ul>
                          

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.umd.min.js"></script>

<script>
    function editInfo() {
    // Create a FormData object from the form with the id 'profileForm'
    var formData = new FormData($('#profileForm')[0]);

    // Use jQuery AJAX to send the form data to 'profile_card.php'
    $.ajax({
        type: 'POST',
        url: 'profile_card.php',
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

$(document).ready(function () {
    $("#toggleDisplayedPassword").on("click", function () {
        var displayedPassword = $("#displayedPassword");
        var type = displayedPassword.attr("data-type");

        if (type === "password") {
            displayedPassword.text("<?php echo $row['password']; ?>");
            displayedPassword.attr("data-type", "text");
            $(this).removeClass("bi-eye").addClass("bi-eye-slash");
        } else {
            displayedPassword.text("********");
            displayedPassword.attr("data-type", "password");
            $(this).removeClass("bi-eye-slash").addClass("bi-eye");
        }
    });
});



</script>
</html>