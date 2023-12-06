<?php
include 'connection.php';

function logActivity($conn, $logMessage) {
    // Insert log entry into the activity_log table
    $timestamp = date("Y-m-d H:i:s");
    $logMessage = mysqli_real_escape_string($conn, $logMessage);

    $sql = "INSERT INTO activity_log (timestamp, activity_message) VALUES ('$timestamp', '$logMessage')";
    mysqli_query($conn, $sql);
}

if (isset($_POST['submit'])) {
    $targetDirectory = "file_uploads/";

    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $allowedExtensions = array("pdf", "doc", "docx", "txt");

    if (!in_array($fileType, $allowedExtensions)) {
        echo "<script>alert('Sorry, only PDF, DOC, DOCX, and TXT files are allowed.');</script>";
        header("Location: admin_docs.php");
        $uploadOk = 0;
        exit();
    }

    // Check if the file already exists in the database
    $fileName = basename($_FILES["fileToUpload"]["name"]);
    $checkDuplicateQuery = "SELECT * FROM documents WHERE file_uploads ='$fileName'";
    $resultDuplicate = mysqli_query($conn, $checkDuplicateQuery);

    if (mysqli_num_rows($resultDuplicate) > 0) {
        echo "<script>alert('Sorry, the file already exists.');</script>";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "<script>alert('Sorry, your file is too large.');</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your document was not uploaded.');</script>";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            // Insert information into the documents table
            $sql = "INSERT INTO documents (file_uploads, upload_date) VALUES ('$fileName', NOW())";
            if (mysqli_query($conn, $sql)) {
                // Log the activity
                $logMessage = "File uploaded: $fileName";
                logActivity($conn, $logMessage);
    
                echo "<script>alert('File information inserted into the database.');</script>";
                header('Location: success.php');
                exit();
            } else {
                echo "<script>alert('Error: " . $sql . "\\n" . mysqli_error($conn) . "');</script>";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>BMFM SYSTEM</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="template/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="template/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="image/Sogod.png" />
</head>
<body>

  <div class="container-scroller">
   <?php include 'includes/admin_sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold mb-0"> Documents</h4>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">UPLOAD DOCUMENTS</h4>
                  <p class="card-description">

                  <form action="#" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <input type="file" name="fileToUpload" id="fileToUpload" class="file-upload-default" required>
                          <div class="input-group col-xs-2">
                            <input type="text"  name="fileToUpload" id="fileToUpload" class="form-control file-upload-info" disabled="" placeholder="Upload Document" >
                            <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">
                                <i class="ti-upload btn-icon-prepend"></i>                                                    
                          Upload</button>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                      <button type="submit" name="submit" class="btn btn-outline-success btn-icon-text">
                          <i class="ti-save-alt"></i>
                          Submit
                        </button>
                    </div>
                  </form> 
                  </p>
                  <h4 class="card-title">DOCUMENT LISTS</h4>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered table-striped">
                      <thead class="table-info">
                        <tr>
                          <th>File Name</th>
                          <th>Upload Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        include 'connection.php';
  
                        // Retrieve the document information from the database
                        $sql = "SELECT * FROM documents ORDER BY upload_date DESC";
                        $result = mysqli_query($conn, $sql);
                        if (!$result) {
                          die("Query failed: " . mysqli_error($conn));
                      }
                        
                       
                          // Display the document information in the table
                          while ($row = mysqli_fetch_assoc($result)) {
                          
                          
                            echo "<tr>";
                            echo "<td>" . $row['file_uploads'] . "</td>";
                            echo "<td>" . $row['upload_date'] . "</td>";
                            echo "<td>";
                            echo "<button class='btn btn-info  btn-fw ' onclick='editDocument(" . $row['file_id'] . ")'><i class='ti-pencil-alt'></i> Edit</button>";
                            echo "<button class='btn btn-danger  btn-fw' onclick=\"deleteDocument(" . $row['file_id'] . ")\"><i class='ti-trash'></i> Delete</button>";
                            echo "</td>";
                            echo "</tr>";
                
                          }
                        ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>

        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="#" >GROUP 5 </a>2023-2024</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">BMFMS SYSTEM <a href="#" > ADDB </a> projects</span>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
 <script>
// Function to handle the "Edit" button click
function editDocument(id) {
    // Redirect to the edit document page with the document ID as a parameter
    window.location.href = "update.php?id=" + id;
}

// Function to handle the "Delete" button click
function deleteDocument(id) {
    window.location.href = "delete.php?id=" +id;
}

// Function to handle the "Delete" button click
function deleteDocument(id) {
    if (confirm('Are you sure you want to delete this File?')) {
    window.location.href = "delete.php?id=" +id;

     // Use the applicantId in the data for the AJAX request
     $.ajax({
            type: 'GET',
            url: 'delete_file.php',
            data: { id: applicantId },
            success: function(response) { 
              
                var data = JSON.parse(response);
                console.log(data); // Add this line to log the response
                console.log(applicantId);

                if (data.success) {
                    // Use the applicantId in the redirect URL
                    window.location.href = 'admin_index.php';
                } else {
                    alert('Failed to delete Document.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
            
        });
    }
}
</script>
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
  <script src="template/js/file-upload.js"></script>
</body>

</html>

