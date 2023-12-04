<?php include 'includes/session.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

      
</div>
              <!-- /.card -->
            </div>
            </div>
        </div>  
            <div class="modal fade" id="userForm">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">Profile</h4>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-bod">
                <form action="profile_card.php" method="post" id="profileForm" enctype="multipart/form-data">
            
                <div class="card imgholder">
              <label for="imgInput" class="upload">
            <input type="file" name="applicant_profile" id="imgInput">
            <i class="bi bi-plus-circle-dotted"></i>
                  </label>
      <img src="<?php echo $row['applicant_profile']; ?>" alt="" width="200" height="200" class="img">
                        </div>
                      
         <div class="inputField">   
         <div class="form-group">
                <label for="firstname">firstname:</label>
                <input class="form-control" type="text" name="firstname"  value="<?php echo ($row['fullname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="username">UserName</label>
                <input  class="form-control" type="text" name="username" value="<?php echo ($row['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" type="email" name="email" value="<?php echo ($row['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="civil_status">Civil Status:</label>
                <input class="form-control" type="text" name="civil_status" value="<?php echo ($row['civilstatus']); ?>" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact:</label>
                <input class="form-control" type="text" minlength="11" maxlength="11" name="contact" value="<?php echo ($row['contact']); ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <input class="form-control" type="text" name="gender" value="<?php echo ($row['gender']); ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Age:</label>
                <input class="form-control" type="number" name="age" value="<?php echo ($row['age']); ?>" required>
            </div>




            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
     
            </div>
                        </div>
        </form>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->




      
    

</body>

<script>
   function editInfo() {
    $('#userForm').modal('show');
}
$(document).ready(function () {
        // Intercept the form submission
        $("#profileForm").submit(function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Perform AJAX submission
            $.ajax({
                type: "POST",
                url: "profile_card.php", // Replace with your actual script URL
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    // Display the server response (optional)
                    console.log(data);

                    // Reload the page after a successful submission
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Handle errors (optional)
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
</html>