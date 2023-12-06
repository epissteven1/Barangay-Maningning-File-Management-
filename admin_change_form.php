<?php   include 'connection.php';  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">


    <title>Document</title>
</head>
<body>

</div>
              <!-- /.card -->
            </div>
            </div>
        </div>
            <div class="modal fade" id="modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Change Password</h4>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <div class="inputField">  
            <div class="modal-body">
            <form action="admin_change_pass.php" method="post">
            <div class="form-group">
    <label for="current_password">Current Password:</label>
    <div class="input-group">
        <input class="form-control" type="password" name="current_password" id="current_password" required>
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="bi bi-eye" id="toggleCurrentPassword"></i>
            </span>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="new_password">New Password:</label>
    <div class="input-group">
        <input class="form-control" type="password" name="new_password" id="new_password" required>
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="bi bi-eye" id="toggleNewPassword"></i>
            </span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="confirm_new_password">Confirm New Password:</label>
    <div class="input-group">
        <input class="form-control" type="password" name="confirm_new_password" id="confirm_new_password" required>
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="bi bi-eye" id="toggleConfirmNewPassword"></i>
            </span>
        </div>
    </div>
</div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
            </div>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
</body>
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

<script>
   function openChangePasswordModal() {
    $('#modal').modal('show');
};

    $(document).ready(function () {
        function togglePasswordVisibility(passwordField, toggleIcon) {
            var type = passwordField.attr("type");
            if (type === "password") {
                passwordField.attr("type", "text");
                toggleIcon.removeClass("bi-eye").addClass("bi-eye-slash");
            } else {
                passwordField.attr("type", "password");
                toggleIcon.removeClass("bi-eye-slash").addClass("bi-eye");
            }
        }

        $("#toggleCurrentPassword").on("click", function () {
            togglePasswordVisibility($("#current_password"), $(this));
        });

        $("#toggleNewPassword").on("click", function () {
            togglePasswordVisibility($("#new_password"), $(this));
        });

        $("#toggleConfirmNewPassword").on("click", function () {
            togglePasswordVisibility($("#confirm_new_password"), $(this));
        });
    });
</script>

</html>